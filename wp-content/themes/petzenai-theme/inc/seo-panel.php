<?php
/**
 * "PetZenAI SEO" control panel (WordPress admin > PetZenAI SEO).
 *
 * Lets the owner control, without code: which tool pages are indexed, each tool's focus keyword / SEO title /
 * meta description, the AdSense publisher id, an Ahrefs keyword import, and an IndexNow submission.
 * Logic lives in inc/seo-logic.php; the front-end reads the saved options through the filters in inc/seo-indexing.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'admin_menu', function () {
    add_menu_page( 'PetZenAI SEO', 'PetZenAI SEO', 'manage_options', 'pz-seo', 'pz_seo_render_page', 'dashicons-chart-area', 58 );
} );

function pz_seo_back( $msg ) {
    wp_safe_redirect( add_query_arg( [ 'page' => 'pz-seo', 'pz_msg' => $msg ], admin_url( 'admin.php' ) ) );
    exit;
}

/* ---------------- handlers ---------------- */

add_action( 'admin_post_pz_seo_save', function () {
    if ( ! current_user_can( 'manage_options' ) ) wp_die( 'Not allowed.' );
    check_admin_referer( 'pz_seo_save' );

    update_option( 'pz_noindex_generic', ! empty( $_POST['pz_noindex_generic'] ) ? '1' : '0', false );

    $pub = trim( sanitize_text_field( wp_unslash( $_POST['pz_adsense_id'] ?? '' ) ) );
    if ( $pub === '' ) remove_theme_mod( 'petzenai_adsense_publisher_id' );
    elseif ( preg_match( '/^(ca-)?(pub-\d{10,20})$/', $pub, $m ) ) set_theme_mod( 'petzenai_adsense_publisher_id', $m[2] );
    else pz_seo_back( 'bad_pub' );

    $changes = json_decode( wp_unslash( $_POST['pz_changes'] ?? '' ), true );
    if ( is_array( $changes ) ) {
        $tools = pz_seo_tools_by_slug();
        $all   = pz_seo_overrides();
        foreach ( $changes as $slug => $row ) {
            if ( ! isset( $tools[ $slug ] ) ) continue;                       // only real registry tools
            $clean = pz_seo_clean_override( $row );
            if ( $clean === null ) unset( $all[ $slug ] ); else $all[ $slug ] = $clean;
        }
        update_option( 'pz_seo_overrides', $all, false );
    }
    pz_seo_back( 'saved' );
} );

add_action( 'admin_post_pz_seo_import', function () {
    if ( ! current_user_can( 'manage_options' ) ) wp_die( 'Not allowed.' );
    check_admin_referer( 'pz_seo_import' );
    $f = $_FILES['pz_csv'] ?? null;
    if ( ! $f || ! is_uploaded_file( $f['tmp_name'] ?? '' ) || (int) $f['size'] <= 0 || (int) $f['size'] > 5 * 1024 * 1024 ) pz_seo_back( 'import_file' );
    $rows = pz_seo_parse_ahrefs_csv( (string) file_get_contents( $f['tmp_name'] ) );
    if ( ! $rows ) pz_seo_back( 'import_empty' );
    $res = pz_seo_match_keywords( $rows, max( 0, (int) ( $_POST['pz_min_volume'] ?? 100 ) ), max( 0, (int) ( $_POST['pz_max_kd'] ?? 30 ) ) );
    update_option( 'pz_seo_suggestions', $res['suggestions'], false );
    update_option( 'pz_seo_unmatched', $res['unmatched'], false );
    update_option( 'pz_seo_import_info', [ 'time' => time(), 'rows' => count( $rows ), 'matched' => count( $res['suggestions'] ) ], false );
    pz_seo_back( 'imported' );
} );

add_action( 'admin_post_pz_seo_indexnow', function () {
    if ( ! current_user_can( 'manage_options' ) ) wp_die( 'Not allowed.' );
    check_admin_referer( 'pz_seo_indexnow' );
    if ( get_transient( 'pz_indexnow_lock' ) ) pz_seo_back( 'indexnow_wait' );
    set_transient( 'pz_indexnow_lock', 1, 10 * MINUTE_IN_SECONDS );
    $urls = pz_seo_indexnow_urls();
    $code = 0;
    foreach ( array_chunk( $urls, 1000 ) as $chunk ) {
        $res  = wp_remote_post( 'https://api.indexnow.org/indexnow', [
            'timeout' => 25,
            'headers' => [ 'Content-Type' => 'application/json; charset=utf-8' ],
            'body'    => wp_json_encode( [ 'host' => wp_parse_url( home_url(), PHP_URL_HOST ), 'key' => PZ_INDEXNOW_KEY, 'keyLocation' => home_url( '/' . PZ_INDEXNOW_KEY . '.txt' ), 'urlList' => $chunk ] ),
        ] );
        $code = is_wp_error( $res ) ? 0 : (int) wp_remote_retrieve_response_code( $res );
        if ( $code < 200 || $code >= 300 ) break;
    }
    update_option( 'pz_indexnow_last', [ 'time' => time(), 'count' => count( $urls ), 'code' => $code ], false );
    pz_seo_back( $code >= 200 && $code < 300 ? 'indexnow_ok' : 'indexnow_fail' );
} );

/* ---------------- page ---------------- */

function pz_seo_render_page() {
    if ( ! current_user_can( 'manage_options' ) ) return;
    $tools     = pz_seo_tools_by_slug();
    $cats      = pz_get_tool_categories();
    $overrides = pz_seo_overrides();
    $sugg      = get_option( 'pz_seo_suggestions', [] );  $sugg = is_array( $sugg ) ? $sugg : [];
    $unmatched = get_option( 'pz_seo_unmatched', [] );    $unmatched = is_array( $unmatched ) ? $unmatched : [];
    $import    = get_option( 'pz_seo_import_info', [] );
    $inlast    = get_option( 'pz_indexnow_last', [] );

    $n_custom = $n_generic = $n_noindex = 0; $rows = [];
    foreach ( $tools as $slug => $t ) {
        $custom  = ! empty( $t['calc'] );
        $stub    = (object) [ 'post_name' => $slug, 'post_type' => 'page' ];
        $noindex = pz_tool_is_noindexed( $stub );
        $custom ? $n_custom++ : $n_generic++;
        if ( $noindex ) $n_noindex++;
        $rows[] = [ 'slug' => $slug, 't' => $t, 'custom' => $custom, 'noindex' => $noindex, 'ov' => pz_seo_override_for( $slug ) ];
    }

    $messages = [
        'saved' => [ 'ok', 'Saved. Changes are live; purge your cache so visitors and Google see them.' ],
        'bad_pub' => [ 'err', 'That AdSense publisher id is not valid. Use the form pub-1234567890123456.' ],
        'imported' => [ 'ok', 'Keywords imported. Suggestions now show in the tools table below.' ],
        'import_file' => [ 'err', 'Please choose a CSV file (up to 5 MB).' ],
        'import_empty' => [ 'err', 'No keywords were found in that file. It needs a "Keyword" column.' ],
        'indexnow_ok' => [ 'ok', 'Sent to IndexNow (Bing, Yandex and others). Google is not covered; use Search Console for Google.' ],
        'indexnow_fail' => [ 'err', 'IndexNow did not accept the request. Try again later.' ],
        'indexnow_wait' => [ 'err', 'IndexNow was used a moment ago. Please wait about 10 minutes.' ],
    ];
    $msg = isset( $_GET['pz_msg'] ) ? sanitize_key( wp_unslash( $_GET['pz_msg'] ) ) : '';
    ?>
    <div class="wrap pz-seo">
      <h1>PetZenAI SEO</h1>
      <p class="description">Control which tool pages Google can index, set keywords, titles and descriptions, import keywords from Ahrefs, and tell search engines about new pages.</p>

      <?php if ( isset( $messages[ $msg ] ) ) : ?>
        <div class="notice notice-<?php echo $messages[ $msg ][0] === 'ok' ? 'success' : 'error'; ?> is-dismissible"><p><?php echo esc_html( $messages[ $msg ][1] ); ?></p></div>
      <?php endif; ?>

      <div class="pz-cards">
        <div><b><?php echo count( $tools ); ?></b><span>Tool pages</span></div>
        <div><b><?php echo (int) $n_custom; ?></b><span>With their own content</span></div>
        <div><b><?php echo (int) $n_generic; ?></b><span>Shared template only</span></div>
        <div><b><?php echo (int) ( count( $tools ) - $n_noindex ); ?></b><span>Indexable now</span></div>
        <div><b><?php echo (int) $n_noindex; ?></b><span>Noindex now</span></div>
      </div>

      <form id="pz-main-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
        <?php wp_nonce_field( 'pz_seo_save' ); ?>
        <input type="hidden" name="action" value="pz_seo_save">
        <input type="hidden" name="pz_changes" id="pz-changes" value="">

        <h2>1. Settings</h2>
        <table class="form-table" role="presentation"><tbody>
          <tr><th scope="row">Templated tools</th><td>
            <label><input type="checkbox" name="pz_noindex_generic" value="1" <?php checked( pz_noindex_generic_enabled() ); ?>> Hide tools that have no content of their own from Google (<code>noindex</code>)</label>
            <p class="description">Recommended until those tools get unique content. Tools you set to “Index” in the table below always stay indexed.</p>
          </td></tr>
          <tr><th scope="row"><label for="pz_adsense_id">AdSense publisher id</label></th><td>
            <input type="text" id="pz_adsense_id" name="pz_adsense_id" class="regular-text" value="<?php echo esc_attr( 'pub-' === substr( (string) get_theme_mod( 'petzenai_adsense_publisher_id', '' ), 0, 4 ) ? get_theme_mod( 'petzenai_adsense_publisher_id', '' ) : '' ); ?>" placeholder="pub-4379837532366669">
            <p class="description">Leave empty to use the id in <code>ads.txt</code> (<?php echo esc_html( function_exists( 'pz_adsense_client' ) ? pz_adsense_client() : '' ); ?>).</p>
          </td></tr>
        </tbody></table>
        <p><button type="submit" class="button button-primary button-large" id="pz-save-top">Save settings and table changes</button></p>
      </form>

      <h2>2. Import keywords from Ahrefs</h2>
      <form method="post" enctype="multipart/form-data" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" class="pz-box">
        <?php wp_nonce_field( 'pz_seo_import' ); ?>
        <input type="hidden" name="action" value="pz_seo_import">
        <p><input type="file" name="pz_csv" accept=".csv,.txt,.tsv" required>
           &nbsp; Min volume <input type="number" name="pz_min_volume" value="100" min="0" style="width:80px">
           &nbsp; Max KD <input type="number" name="pz_max_kd" value="30" min="0" max="100" style="width:70px">
           &nbsp; <button class="button">Import and match</button></p>
        <p class="description">Upload the CSV from Ahrefs Keywords Explorer (Matching terms or Questions). The best keyword per tool shows as a suggestion below; you decide what to apply. Nothing changes until you press Save.</p>
        <?php if ( ! empty( $import['time'] ) ) : ?>
          <p><b>Last import:</b> <?php echo esc_html( wp_date( 'j M Y H:i', $import['time'] ) ); ?>: <?php echo (int) $import['rows']; ?> keywords read, <?php echo (int) $import['matched']; ?> tools got a suggestion.</p>
        <?php endif; ?>
        <?php if ( $unmatched ) : ?>
          <details><summary><b>Keywords with no matching tool (<?php echo count( $unmatched ); ?>)</b>: ideas for new pages or blog posts</summary>
            <table class="widefat striped" style="max-width:640px;margin-top:8px"><thead><tr><th>Keyword</th><th>Volume</th><th>KD</th></tr></thead><tbody>
            <?php foreach ( array_slice( $unmatched, 0, 40 ) as $u ) : ?>
              <tr><td><?php echo esc_html( $u['keyword'] ); ?></td><td><?php echo (int) $u['volume']; ?></td><td><?php echo (int) $u['kd']; ?></td></tr>
            <?php endforeach; ?>
            </tbody></table>
          </details>
        <?php endif; ?>
      </form>

      <h2>3. Tell search engines about new or changed pages</h2>
      <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" class="pz-box">
        <?php wp_nonce_field( 'pz_seo_indexnow' ); ?>
        <input type="hidden" name="action" value="pz_seo_indexnow">
        <p><button class="button">Submit all indexable pages to IndexNow</button></p>
        <p class="description">Reaches Bing, Yandex and similar engines. <b>Google does not use IndexNow:</b> submit the sitemap and use “Request indexing” in Google Search Console.</p>
        <?php if ( ! empty( $inlast['time'] ) ) : ?>
          <p><b>Last submission:</b> <?php echo esc_html( wp_date( 'j M Y H:i', $inlast['time'] ) ); ?>: <?php echo (int) $inlast['count']; ?> URLs, response <?php echo (int) $inlast['code']; ?>.</p>
        <?php endif; ?>
      </form>

      <h2>4. Tool pages</h2>
      <p class="description">Change anything, then press <b>Save</b> (top or bottom). Only the rows you edit are saved. Empty title/description keep the automatic ones.</p>
      <p>
        <input type="search" id="pz-filter" placeholder="Search tools…" style="min-width:240px">
        <select id="pz-kind"><option value="">All tools</option><option value="generic">Shared template only</option><option value="custom">Own content</option><option value="noindex">Noindex now</option><option value="edited">Edited this session</option></select>
        <span id="pz-count" class="description"></span>
      </p>
      <div class="pz-tablewrap">
      <table class="widefat striped" id="pz-table">
        <thead><tr><th>Tool</th><th>Content</th><th>Index</th><th>Focus keyword</th><th>SEO title <small>(≤60)</small></th><th>Meta description <small>(≤160)</small></th></tr></thead>
        <tbody>
        <?php foreach ( $rows as $r ) :
            $slug = $r['slug']; $t = $r['t']; $ov = $r['ov']; $s = $sugg[ $slug ] ?? null; ?>
          <tr data-slug="<?php echo esc_attr( $slug ); ?>" data-kind="<?php echo $r['custom'] ? 'custom' : 'generic'; ?>" data-noindex="<?php echo $r['noindex'] ? '1' : '0'; ?>" data-text="<?php echo esc_attr( strtolower( $t['title'] . ' ' . $slug . ' ' . ( $cats[ $t['cat'] ]['label'] ?? '' ) ) ); ?>">
            <td><a href="<?php echo esc_url( home_url( '/tools/' . $slug . '/' ) ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $t['title'] ); ?></a><br><small><?php echo esc_html( $cats[ $t['cat'] ]['label'] ?? $t['cat'] ); ?> · <?php echo esc_html( $t['type'] ); ?></small></td>
            <td><span class="pz-badge <?php echo $r['custom'] ? 'ok' : 'warn'; ?>"><?php echo $r['custom'] ? 'Own content' : 'Shared template'; ?></span></td>
            <td>
              <select data-f="index">
                <option value="auto" <?php selected( $ov['index'], 'auto' ); ?>>Auto (follow setting 1)</option>
                <option value="index" <?php selected( $ov['index'], 'index' ); ?>>Index</option>
                <option value="noindex" <?php selected( $ov['index'], 'noindex' ); ?>>Noindex</option>
              </select>
              <br><small class="pz-state <?php echo $r['noindex'] ? 'no' : 'yes'; ?>"><?php echo $r['noindex'] ? 'Hidden from Google' : 'Indexable'; ?></small>
            </td>
            <td>
              <input type="text" data-f="keyword" value="<?php echo esc_attr( $ov['keyword'] ); ?>" placeholder="<?php echo esc_attr( $t['kw'] ?? '' ); ?>" maxlength="120">
              <?php if ( $s && strtolower( $s['keyword'] ) !== strtolower( $ov['keyword'] ) ) : ?>
                <br><small>Ahrefs: <a href="#" class="pz-use" data-kw="<?php echo esc_attr( $s['keyword'] ); ?>"><?php echo esc_html( $s['keyword'] ); ?></a> (vol <?php echo (int) $s['volume']; ?>, KD <?php echo (int) $s['kd']; ?>)</small>
              <?php endif; ?>
            </td>
            <td><input type="text" data-f="title" value="<?php echo esc_attr( $ov['title'] ); ?>" placeholder="automatic" maxlength="120"><br><small class="pz-len" data-for="title"></small></td>
            <td><textarea data-f="description" rows="2" maxlength="320" placeholder="automatic"><?php echo esc_textarea( $ov['description'] ); ?></textarea><br><small class="pz-len" data-for="description"></small></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
      </div>
      <p><button type="submit" form="pz-main-form" class="button button-primary button-large" id="pz-save-bottom">Save settings and table changes</button></p>
    </div>

    <style>
      .pz-seo .pz-cards{display:flex;flex-wrap:wrap;gap:12px;margin:16px 0}
      .pz-seo .pz-cards div{background:#fff;border:1px solid #dcdcde;border-radius:8px;padding:12px 18px;min-width:130px}
      .pz-seo .pz-cards b{display:block;font-size:26px;line-height:1.2}.pz-seo .pz-cards span{color:#50575e}
      .pz-seo .pz-box{background:#fff;border:1px solid #dcdcde;border-radius:8px;padding:14px 18px;max-width:900px}
      .pz-seo .pz-tablewrap{overflow-x:auto}
      .pz-seo #pz-table td,.pz-seo #pz-table th{vertical-align:top}
      .pz-seo #pz-table input[type=text],.pz-seo #pz-table textarea{width:100%;min-width:200px}
      .pz-seo .pz-badge{display:inline-block;padding:2px 8px;border-radius:99px;font-size:12px;font-weight:600}
      .pz-seo .pz-badge.ok{background:#d7f0e3;color:#116932}.pz-seo .pz-badge.warn{background:#fcf0cd;color:#7a5200}
      .pz-seo .pz-state.yes{color:#116932}.pz-seo .pz-state.no{color:#b32d2e}
      .pz-seo tr.pz-edited{outline:2px solid #2271b1;outline-offset:-2px}
      .pz-seo .pz-len.bad{color:#b32d2e;font-weight:600}
    </style>
    <script>
    (function () {
      var rows = [].slice.call(document.querySelectorAll('#pz-table tbody tr'));
      var edited = {};
      var q = document.getElementById('pz-filter'), kind = document.getElementById('pz-kind'), count = document.getElementById('pz-count');
      function val(tr, f) { var el = tr.querySelector('[data-f="' + f + '"]'); return el ? el.value : ''; }
      function lens(tr) {
        [].forEach.call(tr.querySelectorAll('.pz-len'), function (s) {
          var f = s.getAttribute('data-for'), n = val(tr, f).length, max = f === 'title' ? 60 : 160;
          s.textContent = n ? n + ' / ' + max : ''; s.classList.toggle('bad', n > max);
        });
      }
      function mark(tr) {
        edited[tr.getAttribute('data-slug')] = { index: val(tr, 'index'), keyword: val(tr, 'keyword'), title: val(tr, 'title'), description: val(tr, 'description') };
        tr.classList.add('pz-edited'); lens(tr); apply();
      }
      function apply() {
        var term = (q.value || '').toLowerCase().trim(), k = kind.value, shown = 0;
        rows.forEach(function (tr) {
          var ok = (!term || tr.getAttribute('data-text').indexOf(term) > -1);
          if (ok && k === 'generic') ok = tr.getAttribute('data-kind') === 'generic';
          if (ok && k === 'custom')  ok = tr.getAttribute('data-kind') === 'custom';
          if (ok && k === 'noindex') ok = tr.getAttribute('data-noindex') === '1';
          if (ok && k === 'edited')  ok = !!edited[tr.getAttribute('data-slug')];
          tr.style.display = ok ? '' : 'none'; if (ok) shown++;
        });
        count.textContent = shown + ' of ' + rows.length + ' shown · ' + Object.keys(edited).length + ' edited';
      }
      rows.forEach(function (tr) {
        lens(tr);
        [].forEach.call(tr.querySelectorAll('[data-f]'), function (el) { el.addEventListener('input', function () { mark(tr); }); el.addEventListener('change', function () { mark(tr); }); });
        [].forEach.call(tr.querySelectorAll('.pz-use'), function (a) {
          a.addEventListener('click', function (e) { e.preventDefault(); tr.querySelector('[data-f="keyword"]').value = a.getAttribute('data-kw'); mark(tr); });
        });
      });
      q.addEventListener('input', apply); kind.addEventListener('change', apply); apply();
      document.getElementById('pz-main-form').addEventListener('submit', function () {
        document.getElementById('pz-changes').value = JSON.stringify(edited);   // one field: avoids PHP's max_input_vars limit
      });
    })();
    </script>
    <?php
}
