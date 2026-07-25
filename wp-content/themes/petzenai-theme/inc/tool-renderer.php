<?php
if ( ! defined('ABSPATH') ) exit;

require_once get_template_directory() . '/inc/tool-registry.php';

/* ─────────────────────────────────────────────
   Get single tool data by slug
───────────────────────────────────────────── */
function pz_get_tool_data( $slug ) {
    foreach ( pz_get_all_tools() as $t ) {
        if ( $t['slug'] === $slug ) return $t;
    }
    return null;
}

/* ─────────────────────────────────────────────
   Related tools (same category, exclude self)
───────────────────────────────────────────── */
function pz_get_related_tools( $slug, $cat, $limit = 4 ) {
    $related = [];
    foreach ( pz_get_all_tools() as $t ) {
        if ( $t['slug'] === $slug ) continue;
        if ( $t['cat'] === $cat ) {
            $related[] = $t;
            if ( count($related) >= $limit ) break;
        }
    }
    return $related;
}

/* ─────────────────────────────────────────────
   MAIN RENDERER — outputs full tool page HTML
───────────────────────────────────────────── */
function pz_render_tool_page( $tool ) {
    $cats   = pz_get_tool_categories();
    $cat    = $cats[ $tool['cat'] ] ?? ['label'=>'Pet Care','icon'=>'🐾','animal'=>'all'];
    $animal = ucfirst( $tool['animal'] === 'all' ? 'Pet' : $tool['animal'] );
    $title  = esc_html( $tool['title'] );
    $icon   = $tool['icon'] ?? '🐾';
    $type   = $tool['type'];
    $kw     = esc_html( $tool['kw'] );
    $slug   = $tool['slug'];

    // ── Breadcrumb ──
    $bc_schema = [
        '@context' => 'https://schema.org',
        '@type'    => 'BreadcrumbList',
        'itemListElement' => [
            ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>home_url('/')],
            ['@type'=>'ListItem','position'=>2,'name'=>'Tools','item'=>home_url('/tools/')],
            ['@type'=>'ListItem','position'=>3,'name'=>esc_html($cat['label']),'item'=>home_url('/tools/'.esc_attr($tool['cat']).'/')],
            ['@type'=>'ListItem','position'=>4,'name'=>$title,'item'=>get_permalink()],
        ],
    ];
    echo '<script type="application/ld+json">' . wp_json_encode($bc_schema, JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
    ?>
    <div style="height:64px;background:#1A1A2E"></div>
    <nav class="pz-breadcrumb" aria-label="Breadcrumb">
      <div class="container">
        <ol class="pz-breadcrumb-list" itemscope itemtype="https://schema.org/BreadcrumbList">
          <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <a href="<?php echo home_url('/'); ?>" itemprop="item"><span itemprop="name">Home</span></a>
            <meta itemprop="position" content="1">
          </li>
          <span class="pz-bc-sep" aria-hidden="true">›</span>
          <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <a href="<?php echo home_url('/tools/'); ?>" itemprop="item"><span itemprop="name">Tools</span></a>
            <meta itemprop="position" content="2">
          </li>
          <span class="pz-bc-sep" aria-hidden="true">›</span>
          <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <a href="<?php echo home_url('/tools/' . esc_attr($tool['cat']) . '/'); ?>" itemprop="item">
              <span itemprop="name"><?php echo esc_html($cat['label']); ?></span>
            </a>
            <meta itemprop="position" content="3">
          </li>
          <span class="pz-bc-sep" aria-hidden="true">›</span>
          <li><span><?php echo $title; ?></span></li>
        </ol>
      </div>
    </nav>

    <!-- ══ HERO — tool card embedded, product-first layout ══ -->
    <section class="pz-tool-hero" aria-label="Tool Header">
      <div class="pz-tool-hero-bg" aria-hidden="true"></div>
      <?php if (!empty($tool['calc']) && function_exists('pz_hero_bg_extra_' . $tool['calc'])): call_user_func('pz_hero_bg_extra_' . $tool['calc']); endif; ?>
      <div class="container pz-tool-hero-grid">
        <div class="pz-tool-hero-content">
          <div class="pz-tool-hero-badge">
            <span><?php echo $cat['icon']; ?></span> <?php echo esc_html($cat['label']); ?>
          </div>
          <h1 class="pz-tool-hero-title"><?php echo $icon; ?> <?php echo $title; ?></h1>
          <p class="pz-tool-hero-desc"><?php echo esc_html( pz_tool_intro($tool) ); ?></p>
          <?php if (!empty($tool['calc']) && function_exists('pz_hero_quickanswer_' . $tool['calc'])): call_user_func('pz_hero_quickanswer_' . $tool['calc']); endif; ?>
          <div class="pz-tool-hero-trust">
            <?php if (!empty($tool['calc']) && function_exists('pz_hero_trust_' . $tool['calc'])): call_user_func('pz_hero_trust_' . $tool['calc']); else: ?>
            <span>✅ Vet-Reviewed</span>
            <span>✅ Science-Based</span>
            <span>✅ Free Forever</span>
            <span>✅ No Sign-Up</span>
            <?php endif; ?>
          </div>
          <div class="hero-btns" style="margin-top:24px">
            <a href="<?php echo home_url('/contact/'); ?>" class="btn-primary">📞 Get a Free Consultation</a>
            <a href="<?php echo home_url('/#reviews'); ?>" class="btn-secondary">⭐ Check Our Success Stories</a>
          </div>
        </div>
        <div class="pz-tool-hero-toolcard" id="pz-tool-interactive">
          <?php pz_render_interactive($tool); ?>
        </div>
      </div>
    </section>

    <!-- ══ AD SLOT — TOP ══ -->
    <?php petzenai_ad('petzenai_adsense_ad_tools','tool-top'); ?>

    <article class="pz-auto-tool-article" itemscope itemtype="https://schema.org/HowTo">
      <meta itemprop="name" content="<?php echo $title; ?>">

      <!-- PRINT-ONLY HEADER — branded PDF banner, hidden on screen -->
      <div class="pz-print-header">
        <div class="pz-print-logo">🐾 PetZen<span>AI</span></div>
        <div class="pz-print-meta">
          <strong><?php echo $title; ?></strong><br>
          Generated <?php echo esc_html( date_i18n('F j, Y') ); ?> · petzenai.com
        </div>
      </div>

      <div class="container pz-auto-tool-layout">
        <div class="pz-auto-tool-main">

          <!-- TABLE OF CONTENTS -->
          <details class="pz-toc" id="pz-auto-toc" hidden>
            <summary class="pz-toc-title">📋 Table of Contents</summary>
            <ul id="pz-auto-toc-list"></ul>
          </details>

          <!-- LEARN MORE DIVIDER — marks the shift from tool (above, in hero) to article (below) -->
          <div class="pz-learn-more-divider">
            <span>📚 Everything Else You Need to Know</span>
          </div>

          <?php if (!empty($tool['calc']) && function_exists('pz_methodology_' . $tool['calc'])): ?>
          <!-- METHODOLOGY — how the calculator's result is built (trust + AEO) -->
          <section class="pz-tool-section pz-methodology-section">
            <div class="pz-tool-hero-badge" style="margin-bottom:12px">🐾 How the Recommendation Is Built</div>
            <h2><?php echo esc_html( function_exists('pz_methodology_heading_' . $tool['calc']) ? call_user_func('pz_methodology_heading_' . $tool['calc']) : 'How This Recommendation Is Built' ); ?></h2>
            <?php call_user_func('pz_methodology_' . $tool['calc']); ?>
          </section>
          <?php endif; ?>

          <!-- SECTION 2: WHAT IS -->
          <section class="pz-tool-section">
            <h2>📖 What Is <?php echo $title; ?><?php echo (substr(trim($title), -1) === '?') ? '' : '?'; ?></h2>
            <?php echo pz_section_what_is($tool); ?>
          </section>

          <!-- SECTION 3: WHY IMPORTANT -->
          <section class="pz-tool-section">
            <h2>⭐ Why <?php echo esc_html($animal); ?> Owners Need This</h2>
            <?php echo pz_section_why_important($tool); ?>
          </section>

          <!-- SECTION 4: HOW TO USE / STEP BY STEP -->
          <section class="pz-tool-section" id="pz-steps-section">
            <h2>📋 Step-by-Step Guide</h2>
            <?php echo pz_section_steps($tool); ?>
          </section>

          <!-- AD SLOT — MIDDLE -->
          <?php petzenai_ad('petzenai_adsense_ad_blog_mid','tool-mid'); ?>

          <!-- SECTION 5: PRO TIPS -->
          <section class="pz-tool-section">
            <h2>💡 Expert Tips & Best Practices</h2>
            <?php echo pz_section_tips($tool); ?>
            <?php echo pz_inline_related_reading($tool); ?>
          </section>

          <!-- SECTION 6: COMMON MISTAKES -->
          <section class="pz-tool-section">
            <h2>⚠️ Common Mistakes to Avoid</h2>
            <?php echo pz_section_mistakes($tool); ?>
          </section>

          <!-- SECTION 7: SIGNS & SYMPTOMS / WHEN TO WORRY -->
          <section class="pz-tool-section">
            <h2>🔍 Warning Signs to Watch For</h2>
            <?php echo pz_section_warning_signs($tool); ?>
          </section>

          <!-- SECTION 8: BREED / SIZE VARIATIONS -->
          <section class="pz-tool-section">
            <h2>🐾 Breed & Size Considerations</h2>
            <?php echo pz_section_breed_variations($tool); ?>
          </section>

          <!-- SECTION 9: PRODUCTS & TOOLS GUIDE -->
          <section class="pz-tool-section">
            <h2>🛒 Recommended Products & Supplies</h2>
            <?php echo pz_section_products($tool); ?>
          </section>

          <!-- SECTION 10: VET ADVICE -->
          <section class="pz-tool-section pz-vet-section">
            <h2>🏥 When to Consult Your Vet</h2>
            <?php echo pz_section_vet_advice($tool); ?>
          </section>

          <!-- SECTION 11: FAQ -->
          <section class="pz-tool-section" itemscope itemtype="https://schema.org/FAQPage">
            <h2>❓ Frequently Asked Questions</h2>
            <?php echo pz_section_faq($tool); ?>
          </section>

          <!-- PRINT-ONLY FOOTER — branded PDF footer with contact info, hidden on screen -->
          <div class="pz-print-footer">
            <p>This report was generated using the free <strong><?php echo $title; ?></strong> at petzenai.com/tools/<?php echo esc_html($slug); ?>/</p>
            <p>Questions? Contact us at <?php echo esc_html( get_theme_mod('petzenai_contact_email','support@petzenai.com') ); ?> — this information is for general guidance only and does not replace professional veterinary advice.</p>
            <p>© <?php echo esc_html( date_i18n('Y') ); ?> PetZenAI · petzenai.com</p>
          </div>

          <!-- SHARE BAR -->
          <div class="pz-share-bar" style="margin-top:40px">
            <span class="pz-share-label">Share this guide:</span>
            <?php
            $url   = urlencode(get_permalink());
            $ttl   = urlencode($title);
            $socials = [
              ['Facebook','https://www.facebook.com/sharer/sharer.php?u='.$url,'📘'],
              ['Twitter', 'https://twitter.com/intent/tweet?text='.$ttl.'&url='.$url,'🐦'],
              ['Pinterest','https://pinterest.com/pin/create/button/?url='.$url.'&description='.$ttl,'📌'],
            ];
            foreach($socials as $s):
            ?>
            <a href="<?php echo esc_url($s[1]); ?>" class="pz-share-btn" target="_blank" rel="noopener noreferrer">
              <?php echo $s[0]; ?> <?php echo $s[2]; ?>
            </a>
            <?php endforeach; ?>
          </div>

        </div><!-- /main -->

        <!-- SIDEBAR -->
        <aside class="pz-auto-tool-sidebar">

          <!-- Search Widget -->
          <div class="pz-sidebar-widget" style="padding:14px 16px">
            <h3 class="pz-sidebar-title" style="margin-bottom:10px">🔍 Search Tools</h3>
            <div class="pz-sb-search-wrap">
              <input type="search" id="pz-sb-search" class="pz-sb-search"
                     placeholder="Search 300+ tools…" autocomplete="off">
              <button onclick="pzSbDoSearch()" class="pz-sb-search-btn">→</button>
            </div>
            <div id="pz-sb-results" class="pz-sb-results" style="display:none"></div>
          </div>

          <!-- Quick Facts -->
          <div class="pz-sidebar-widget" style="padding:14px 16px">
            <h3 class="pz-sidebar-title" style="margin-bottom:10px">⚡ Quick Facts</h3>
            <?php echo pz_sidebar_quick_facts($tool); ?>
          </div>

          <!-- Related Tools -->
          <?php $related_tools = pz_get_related_tools($slug, $tool['cat']); ?>
          <div class="pz-sidebar-widget" style="padding:14px 16px">
            <h3 class="pz-sidebar-title" style="margin-bottom:10px">🔗 Related Tools</h3>
            <?php foreach( $related_tools as $rt ): ?>
            <a href="<?php echo home_url('/tools/'.$rt['slug'].'/'); ?>" class="pz-sidebar-tool">
              <span class="pz-sidebar-tool-icon"><?php echo $rt['icon'] ?? '🐾'; ?></span>
              <span class="pz-sidebar-tool-title"><?php echo esc_html($rt['title']); ?></span>
              <span class="pz-sidebar-tool-arrow">→</span>
            </a>
            <?php endforeach; ?>
            <a href="<?php echo home_url('/tools/'.$tool['cat'].'/'); ?>"
               style="display:block;text-align:center;margin-top:12px;font-size:12px;color:var(--orange);text-decoration:none;font-weight:700">
              View All <?php echo esc_html(pz_get_tool_categories()[$tool['cat']]['label'] ?? ''); ?> Tools →
            </a>
          </div>
          <?php if ( ! empty( $related_tools ) ):
            $il_items = [];
            foreach ( $related_tools as $i => $rt ) {
                $il_items[] = [
                    '@type'    => 'ListItem',
                    'position' => $i + 1,
                    'url'      => home_url('/tools/'.$rt['slug'].'/'),
                    'name'     => $rt['title'],
                ];
            }
            $il_schema = [
                '@context'        => 'https://schema.org',
                '@type'           => 'ItemList',
                'itemListElement' => $il_items,
            ];
          ?>
          <script type="application/ld+json"><?php echo wp_json_encode( $il_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ); ?></script>
          <?php endif; ?>

          <!-- PDF CTA -->
          <div class="pz-sidebar-widget" style="text-align:center;background:linear-gradient(135deg,#1A1A2E,#16213E);padding:16px">
            <div style="font-size:32px;margin-bottom:8px">📥</div>
            <div style="color:#fff;font-weight:800;font-size:14px;margin-bottom:6px">Save as PDF</div>
            <div style="color:rgba(255,255,255,0.55);font-size:12px;margin-bottom:12px">Free forever, no sign-up</div>
            <button onclick="pzPrintTool()" class="btn-primary" style="width:100%;font-size:13px;padding:9px">Download PDF</button>
          </div>

          <!-- Ad -->
          <?php petzenai_ad('petzenai_adsense_ad_sidebar','tool-sidebar'); ?>

        </aside>
      </div>
    </article>

    <!-- RELATED TOOLS SECTION -->
    <section class="section section-alt pz-related-tools" aria-label="More Tools">
      <div class="container">
        <div class="section-header" style="margin-bottom:40px">
          <span class="section-tag"><?php echo esc_html($cat['label']); ?></span>
          <h2 class="section-title" style="font-size:28px">More <span><?php echo esc_html($cat['label']); ?> Tools</span></h2>
        </div>
        <div class="tools-grid">
          <?php foreach( pz_get_related_tools($slug, $tool['cat'], 3) as $rt ): ?>
          <article class="tool-card" style="padding:28px">
            <div class="tool-card-glow" aria-hidden="true"></div>
            <div class="tool-icon-wrap" style="width:60px;height:60px;font-size:28px;margin-bottom:16px">
              <span class="tool-icon"><?php echo $rt['icon'] ?? '🐾'; ?></span>
            </div>
            <h3 class="tool-title" style="font-size:16px;margin-bottom:8px"><?php echo esc_html($rt['title']); ?></h3>
            <a href="<?php echo home_url('/tools/'.$rt['slug'].'/'); ?>" class="tool-link" style="font-size:13px">
              View Guide <span class="tool-link-arrow">→</span>
            </a>
            <div class="tool-card-paw" aria-hidden="true">🐾</div>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <?php
}

/* ─────────────────────────────────────────────
   CONTENT GENERATORS
───────────────────────────────────────────── */

function pz_tool_intro( $tool ) {
    $a = strtolower($tool['animal'] === 'all' ? 'pet' : $tool['animal']);
    $type_labels = ['guide'=>'guide','calculator'=>'calculator','checker'=>'checker','tracker'=>'tracker'];
    $type_label = $type_labels[$tool['type']] ?? 'guide';
    $kw = !empty($tool['kw']) ? $tool['kw'] : "{$a} care";
    $suffix = (stripos($kw, $type_label) !== false) ? '' : " {$type_label}";
    return "Free, vet-reviewed {$kw}{$suffix} — science-based, instant results, no sign-up required. Used by thousands of {$a} owners across the USA.";
}

function pz_tool_cta_label( $type ) {
    $map = ['calculator'=>'Use Calculator','checker'=>'Use Checker','tracker'=>'Start Tracking','guide'=>'Read Full Guide'];
    return $map[$type] ?? 'View Tool';
}

function pz_section1_title( $tool ) {
    $map = ['calculator'=>'Interactive Calculator','checker'=>'Symptom Checker','tracker'=>'Tracking Tool','guide'=>'Interactive Guide Tool'];
    return $map[$tool['type']] ?? 'Try the Tool';
}

function pz_render_interactive( $tool ) {
    $animal = ucfirst($tool['animal'] === 'all' ? 'pet' : $tool['animal']);
    $animalL = strtolower($animal);
    $type   = $tool['type'];
    $icon   = $tool['icon'] ?? '🐾';
    $opts_age = ['dog'=>['Puppy (0-1 yr)'=>'puppy','Adult (1-7 yrs)'=>'adult','Senior (7+ yrs)'=>'senior'],
                 'cat'=>['Kitten (0-1 yr)'=>'kitten','Adult (1-10 yrs)'=>'adult','Senior (10+ yrs)'=>'senior'],
                 'bird'=>['Young (0-1 yr)'=>'young','Adult'=>'adult','Senior'=>'senior'],
                 'rabbit'=>['Young (0-6 mo)'=>'young','Adult (6mo-5 yrs)'=>'adult','Senior (5+ yrs)'=>'senior'],
                 'all'=>['Baby/Puppy/Kitten'=>'baby','Adult'=>'adult','Senior'=>'senior']];
    $age_list = $opts_age[$tool['animal']] ?? $opts_age['all'];
    ?>
    <div class="pz-int-wrap" id="pz-int-tool">

    <?php if ($type === 'calculator' && !empty($tool['calc']) && function_exists('pz_render_calc_' . $tool['calc'])):
        call_user_func('pz_render_calc_' . $tool['calc'], $tool);
    elseif ($type === 'calculator'): ?>
    <!-- ══ CALCULATOR (generic food/calorie) ══ -->
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Free <?php echo $animal; ?> Calculator</div>
          <div class="pz-int-sublabel">Vet-reviewed · Instant results · 100% free</div>
        </div>
      </div>
      <div class="pz-int-badges">
        <span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span>
        <span class="pz-int-badge pz-int-badge--blue">🔬 Science-Based</span>
      </div>
    </div>

    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt"><?php echo $animal; ?> Life Stage</label>
          <select id="pz_animal_type" class="pz-int-select">
            <?php foreach($age_list as $label=>$val): ?>
            <option value="<?php echo $val; ?>"><?php echo $label; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Weight
            <span class="pz-int-unit-toggle">
              <button type="button" class="pz-unit-btn active" onclick="pzSetUnit('lbs',this)">lbs</button>
              <button type="button" class="pz-unit-btn" onclick="pzSetUnit('kg',this)">kg</button>
            </span>
          </label>
          <div class="pz-int-input-wrap">
            <input type="number" id="pz_weight" class="pz-int-input" placeholder="e.g. 25" min="0.1" max="300" step="0.1">
            <span class="pz-int-input-suffix" id="pz-unit-label">lbs</span>
          </div>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Activity Level</label>
          <div class="pz-activity-chips">
            <button type="button" class="pz-chip" data-val="low" onclick="pzSelectChip(this,'activity')">😴 Low</button>
            <button type="button" class="pz-chip active" data-val="moderate" onclick="pzSelectChip(this,'activity')">🚶 Moderate</button>
            <button type="button" class="pz-chip" data-val="high" onclick="pzSelectChip(this,'activity')">🏃 High</button>
            <button type="button" class="pz-chip" data-val="working" onclick="pzSelectChip(this,'activity')">⚡ Athletic</button>
          </div>
          <input type="hidden" id="pz_activity" value="moderate">
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Health Status</label>
          <select id="pz_health" class="pz-int-select">
            <option value="healthy">✅ Healthy</option>
            <option value="overweight">⚖️ Overweight</option>
            <option value="underweight">📉 Underweight</option>
            <option value="pregnant">🤰 Pregnant / Nursing</option>
            <option value="medical">💊 Medical Condition</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Breed Size <span class="pz-int-optional">(optional)</span></label>
          <select id="pz_breed_size" class="pz-int-select">
            <option value="">Select size…</option>
            <option value="toy">Toy / Mini (under 10 lbs)</option>
            <option value="small">Small (10–25 lbs)</option>
            <option value="medium">Medium (25–60 lbs)</option>
            <option value="large">Large (60–100 lbs)</option>
            <option value="giant">Giant (100+ lbs)</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Goal</label>
          <select id="pz_goal" class="pz-int-select">
            <option value="maintain">Maintain weight</option>
            <option value="lose">Lose weight</option>
            <option value="gain">Gain weight</option>
          </select>
        </div>
      </div>

      <button class="pz-int-btn" onclick="pzCalcTool()">
        <span class="pz-int-btn-icon"><?php echo $icon; ?></span>
        Calculate Now — Free &amp; Instant
      </button>
      <div id="pz-calc-result" style="display:none" aria-live="polite"></div>
    </div>

    <?php elseif ($type === 'checker'): ?>
    <!-- ══ CHECKER ══ -->
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Free <?php echo $animal; ?> Health Checker</div>
          <div class="pz-int-sublabel">Answer 5 quick questions · Get instant assessment</div>
        </div>
      </div>
      <div class="pz-int-badges">
        <span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span>
        <span class="pz-int-badge pz-int-badge--orange">⚡ Instant Results</span>
      </div>
    </div>

    <div class="pz-int-body">
      <div class="pz-checker-progress-wrap">
        <div class="pz-checker-progress-bar"><div class="pz-checker-progress-fill" id="pz-prog-fill" style="width:0%"></div></div>
        <span class="pz-checker-progress-txt" id="pz-prog-txt">Question 1 of 5</span>
      </div>

      <?php
      $qs = pz_get_checker_questions($tool);
      foreach($qs as $i=>$q): ?>
      <div class="pz-checker-step <?php echo $i===0?'active':''; ?>" id="pz-step-<?php echo $i; ?>">
        <div class="pz-checker-q-num">Question <?php echo $i+1; ?> / <?php echo count($qs); ?></div>
        <p class="pz-checker-q-text"><?php echo esc_html($q['q']); ?></p>
        <div class="pz-checker-cards">
          <?php foreach($q['opts'] as $val=>$label):
            $emoji = ['yes'=>'✅','no'=>'❌','none'=>'✅','once'=>'⚠️','frequent'=>'🚨',
                      'normal'=>'✅','lower'=>'⚠️','very_low'=>'🚨','more'=>'⚠️','less'=>'⚠️',
                      'mild'=>'⚠️','severe'=>'🚨','healthy'=>'✅','less'=>'⚠️'][$val] ?? '🔹';
          ?>
          <label class="pz-checker-card">
            <input type="radio" name="pzq_<?php echo $i; ?>" value="<?php echo esc_attr($val); ?>"
                   onchange="pzCheckerNext(<?php echo $i; ?>, <?php echo count($qs)-1; ?>)">
            <span class="pz-checker-card-icon"><?php echo $emoji; ?></span>
            <span class="pz-checker-card-txt"><?php echo esc_html($label); ?></span>
          </label>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endforeach; ?>

      <button class="pz-int-btn" id="pz-checker-submit" onclick="pzRunChecker()" style="display:none">
        🔍 Get My Health Assessment
      </button>
      <div id="pz-checker-result" style="display:none" aria-live="polite"></div>
    </div>

    <?php elseif (!empty($tool['calc']) && function_exists('pz_render_guide_' . $tool['calc'])):
        call_user_func('pz_render_guide_' . $tool['calc'], $tool);
    else: /* guide / tracker */ ?>
    <!-- ══ GUIDE / TRACKER ══ -->
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Personalized <?php echo $animal; ?> <?php echo ucfirst($type); ?></div>
          <div class="pz-int-sublabel">Tailored to your pet · Science-based · Free forever</div>
        </div>
      </div>
      <div class="pz-int-badges">
        <span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span>
        <span class="pz-int-badge pz-int-badge--purple">🎯 Personalized</span>
      </div>
    </div>

    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Your <?php echo $animal; ?>'s Name</label>
          <div class="pz-int-input-wrap">
            <span class="pz-int-input-prefix"><?php echo $icon; ?></span>
            <input type="text" id="pz_pet_name" class="pz-int-input pz-int-input--prefix" placeholder="e.g. Max">
          </div>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Age (years)</label>
          <input type="number" id="pz_pet_age" class="pz-int-input" placeholder="e.g. 3" min="0" max="30" step="0.5">
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Breed / Type</label>
          <input type="text" id="pz_breed" class="pz-int-input" placeholder="e.g. Golden Retriever">
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Weight
            <span class="pz-int-unit-toggle">
              <button type="button" class="pz-unit-btn active" onclick="pzSetUnit('lbs',this)">lbs</button>
              <button type="button" class="pz-unit-btn" onclick="pzSetUnit('kg',this)">kg</button>
            </span>
          </label>
          <div class="pz-int-input-wrap">
            <input type="number" id="pz_weight2" class="pz-int-input" placeholder="e.g. 45" min="0.1" max="300" step="0.1">
            <span class="pz-int-input-suffix" id="pz-unit-label2">lbs</span>
          </div>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Life Stage</label>
          <div class="pz-activity-chips">
            <?php foreach($age_list as $label=>$val): ?>
            <button type="button" class="pz-chip <?php echo $val==='adult'?'active':''; ?>"
                    data-val="<?php echo $val; ?>" onclick="pzSelectChip(this,'life_stage')"><?php echo $label; ?></button>
            <?php endforeach; ?>
          </div>
          <input type="hidden" id="pz_life_stage" value="adult">
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Primary Goal</label>
          <select id="pz_goal2" class="pz-int-select">
            <option value="health">Overall Health & Wellness</option>
            <option value="weight">Weight Management</option>
            <option value="grooming">Grooming & Coat Care</option>
            <option value="behavior">Behavior & Training</option>
            <option value="nutrition">Better Nutrition</option>
          </select>
        </div>
      </div>

      <button class="pz-int-btn" onclick="pzGenGuide()">
        <span class="pz-int-btn-icon"><?php echo $icon; ?></span>
        Generate My Personalized <?php echo ucfirst($type); ?>
      </button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php endif; ?>
    </div>
    <?php
}

/* ─────────────────────────────────────────────
   TOOL-SPECIFIC CALCULATORS
   Each renders its own form + calls its own JS calc function
   (defined in templates/pages/auto-tool.php). Falls back to the
   generic food/calorie calculator when no match is registered.
───────────────────────────────────────────── */

/* 65 common dog breeds mapped to coat type — powers the breed search in the
   bathing-frequency wizard. Reused wherever breed->coat lookups are needed. */
function pz_get_dog_breed_coat_map() {
    return [
        // short / smooth
        'Beagle'=>'short','Boxer'=>'short','Dachshund (Smooth)'=>'short','Boston Terrier'=>'short',
        'Chihuahua (Smooth)'=>'short','Pug'=>'short','Dalmatian'=>'short','Great Dane'=>'short',
        'Weimaraner'=>'short','Vizsla'=>'short','Doberman Pinscher'=>'short','Bull Terrier'=>'short',
        'Basenji'=>'short','Whippet'=>'short','Italian Greyhound'=>'short','French Bulldog'=>'short',
        'Bulldog (English)'=>'short','Staffordshire Bull Terrier'=>'short','Rhodesian Ridgeback'=>'short','Pointer'=>'short',
        // double-coated
        'Labrador Retriever'=>'double','Golden Retriever'=>'double','German Shepherd'=>'double','Siberian Husky'=>'double',
        'Alaskan Malamute'=>'double','Pomeranian'=>'double','Pembroke Welsh Corgi'=>'double','Cardigan Welsh Corgi'=>'double',
        'Border Collie'=>'double','Australian Shepherd'=>'double','Bernese Mountain Dog'=>'double','Newfoundland'=>'double',
        'Chow Chow'=>'double','Akita'=>'double','Samoyed'=>'double','Rottweiler'=>'double',
        'American Eskimo Dog'=>'double','Shiba Inu'=>'double','Norwegian Elkhound'=>'double','Australian Cattle Dog'=>'double',
        // long & silky
        'Shih Tzu'=>'long','Maltese'=>'long','Yorkshire Terrier'=>'long','Afghan Hound'=>'long',
        'Lhasa Apso'=>'long','Havanese'=>'long','Papillon'=>'long','Rough Collie'=>'long',
        'Cocker Spaniel (American)'=>'long','Cocker Spaniel (English)'=>'long','Cavalier King Charles Spaniel'=>'long','Pekingese'=>'long',
        'Silky Terrier'=>'long',
        // curly / wool
        'Poodle (Standard)'=>'curly','Poodle (Miniature)'=>'curly','Poodle (Toy)'=>'curly','Bichon Frise'=>'curly',
        'Portuguese Water Dog'=>'curly','Labradoodle'=>'curly','Goldendoodle'=>'curly','Cockapoo'=>'curly',
        'Irish Water Spaniel'=>'curly','Curly-Coated Retriever'=>'curly',
        // wire-haired
        'Wire Fox Terrier'=>'wire','Airedale Terrier'=>'wire','Miniature Schnauzer'=>'wire','Standard Schnauzer'=>'wire',
        'Giant Schnauzer'=>'wire','Border Terrier'=>'wire','Scottish Terrier'=>'wire','Wirehaired Pointing Griffon'=>'wire',
        'Brussels Griffon'=>'wire','West Highland White Terrier'=>'wire','Cairn Terrier'=>'wire',
        // hairless
        'Xoloitzcuintli'=>'hairless','Chinese Crested (Hairless)'=>'hairless','American Hairless Terrier'=>'hairless',
    ];
}

function pz_hero_quickanswer_dog_bathing_frequency() { ?>
    <div class="pz-hero-quickanswer">
      <div class="pz-hero-quickanswer-label">⚡ Quick Answer</div>
      <p>Most adult dogs do well with a bath every <strong>4–6 weeks</strong>. Short-coated, low-activity dogs can stretch to 6–8 weeks. Dogs with oily skin, allergies, or heavy outdoor/muddy activity often need a bath every <strong>1–2 weeks</strong>. Use the calculator for your dog's exact number.</p>
    </div>
<?php }

function pz_hero_trust_dog_bathing_frequency() { ?>
      <span>✅ 77 breeds recognized</span>
      <span>✅ Shampoo dosage included</span>
      <span>✅ Free calendar reminder</span>
<?php }

function pz_hero_bg_extra_dog_bathing_frequency() { ?>
      <div class="pz-hero-bubbles" aria-hidden="true">
        <span class="pz-bubble pz-bubble-1"></span>
        <span class="pz-bubble pz-bubble-2"></span>
        <span class="pz-bubble pz-bubble-3"></span>
        <span class="pz-bubble pz-bubble-4"></span>
        <span class="pz-bubble pz-bubble-5"></span>
        <span class="pz-bubble pz-bubble-6"></span>
      </div>
<?php }

function pz_methodology_heading_dog_bathing_frequency() { return 'What Decides How Often to Bathe Your Dog'; }

function pz_methodology_dog_bathing_frequency() { ?>
    <p style="color:#555;margin-bottom:20px">The calculator starts from a coat-type baseline (auto-detected from breed), then adjusts it based on activity, season, skin, and age — the same logic groomers use when building a client's grooming plan.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🐕</div>
        <strong>Breed &amp; Coat</strong>
        <p>Double and wire coats hold protective oils that frequent washing strips away. Long, silky, and hairless coats get dirty faster and need shorter gaps.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🏃</div>
        <strong>Activity &amp; Season</strong>
        <p>Mud, water, and rough terrain shorten the ideal gap. Hot, humid weather increases sweat and allergens; cold, dry weather dries out skin faster.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🧴</div>
        <strong>Skin &amp; Weight</strong>
        <p>Dry or sensitive skin needs fewer, gentler baths. Weight determines a fair shampoo dosage estimate so you're not over- or under-applying product.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">📅</div>
        <strong>Age &amp; Timing</strong>
        <p>Very young puppies need vet clearance first. Add your last bath date and the calculator tells you exactly when the next one is due.</p>
      </div>
    </div>
<?php }

function pz_faq_dog_bathing_frequency() {
    return [
        ["How often should I bathe my dog?", "Most adult dogs should be bathed every 4 to 6 weeks. Short-coated, low-activity dogs can go 6–8 weeks between baths, while dogs with oily skin, allergies, or high outdoor activity often need a bath every 1–2 weeks. Breed, coat type, activity level, season, skin condition, and age are the main factors — use the calculator above for a number tailored to your dog."],
        ["Can I bathe my dog too often?", "Yes. Bathing more than once a week without a medical reason can strip natural oils from the skin, leading to dryness, irritation, and a dull coat — even with a gentle shampoo. If your dog needs frequent washing for odor or allergy control, ask your vet about a shampoo formulated for frequent use."],
        ["How often should I bathe a puppy?", "Puppies under 12 weeks shouldn't have a full bath yet — they can't fully regulate their body temperature, so spot-clean with a damp cloth and check with your vet first. Puppies over 12 weeks generally follow the same coat-type guidance as adults, though many need baths a bit more often simply from being messier."],
        ["Does the season change how often I should bathe my dog?", "Yes. Hot, humid weather increases sweat, allergens, and outdoor debris, which can shorten the ideal gap between baths. Cold, dry weather pulls moisture from the skin faster, so stretching the interval and adding a moisturizing conditioner helps prevent flaking."],
        ["How much shampoo should I use when bathing my dog?", "As a general guide for shampoo diluted 1:4 with water: 1–2 tablespoons for dogs under 20 lbs, 2–4 tablespoons for 20–50 lbs, 4–6 tablespoons for 50–90 lbs, and 6–8 tablespoons for dogs over 90 lbs. Always check your specific shampoo's label, since concentration varies by brand."],
        ["Do double-coated dogs need to be bathed less often?", "Generally yes — double coats (Huskies, Labs, German Shepherds, Golden Retrievers) hold protective oils that frequent washing strips away, so every 6–8 weeks is typical. Never shave a double coat to reduce bathing frequency — it disrupts insulation and can permanently damage how the coat grows back."],
    ];
}

function pz_breed_rows_dog_bathing_frequency() {
    return [
        ['Short Coat (Lab, Beagle, Boxer)', 'Every 6-8 weeks', 'Natural oils self-clean well; over-bathing dries out the skin'],
        ['Double Coat (Husky, Golden, GSD)', 'Every 6-8 weeks', 'Never shave to "reduce" bathing — it damages the insulating undercoat'],
        ['Long / Silky Coat (Yorkie, Shih Tzu)', 'Every 3-4 weeks', 'Prevents matting; brush between baths to keep tangles down'],
        ['Curly / Wire Coat (Poodle, Terrier)', 'Every 4-6 weeks', 'Pair bath timing with a professional trim every 6-8 weeks'],
    ];
}

function pz_render_calc_dog_bathing_frequency( $tool ) {
    $icon    = $tool['icon'] ?? '🛁';
    $breeds  = pz_get_dog_breed_coat_map();
    $coatTypes = [
        'short'    => ['Short &amp; smooth', 'Beagle, Lab, Boxer'],
        'double'   => ['Double coat', 'Husky, GSD, Golden'],
        'long'     => ['Long &amp; silky', 'Yorkie, Shih Tzu'],
        'curly'    => ['Curly / wool', 'Poodle, Doodle'],
        'wire'     => ['Wire-haired', 'Terrier types'],
        'hairless' => ['Hairless', 'Xolo, Crested'],
    ];
    ?>
    <div class="pz-wizard" id="pz-wizard" data-breeds='<?php echo json_encode($breeds, JSON_UNESCAPED_SLASHES); ?>'>
      <div class="pz-wizard-head">
        <div class="pz-wizard-title"><?php echo $icon; ?> Build Your Dog's Bath Schedule</div>
        <div class="pz-wizard-sub">4 short steps · takes under a minute</div>
        <div class="pz-wizard-progress">
          <div class="pz-wizard-progress-bar"><div class="pz-wizard-progress-fill" id="pz-wiz-fill"></div></div>
          <div class="pz-wizard-steps-label">
            <span class="pz-wiz-steplabel active" data-step="0">Breed</span>
            <span class="pz-wiz-steplabel" data-step="1">Activity</span>
            <span class="pz-wiz-steplabel" data-step="2">Skin &amp; Weight</span>
            <span class="pz-wiz-steplabel" data-step="3">Age &amp; Timing</span>
          </div>
        </div>
      </div>

      <div class="pz-wizard-body">
        <!-- STEP 0 — Breed -->
        <div class="pz-wizard-step active" data-step="0">
          <label class="pz-int-label-txt">Search your breed <span class="pz-int-optional">(optional)</span></label>
          <div class="pz-breed-search-wrap">
            <input type="text" id="pz_breed_search" class="pz-int-input" placeholder="e.g. Golden Retriever, Poodle, Husky…" autocomplete="off">
            <div id="pz_breed_results" class="pz-breed-results" hidden></div>
          </div>
          <div class="pz-wizard-or">or pick coat type manually</div>
          <div class="pz-coat-grid" id="pz_coat_grid">
            <?php foreach ($coatTypes as $val => $meta): ?>
            <button type="button" class="pz-coat-card<?php echo $val==='short'?' active':''; ?>" data-val="<?php echo $val; ?>" onclick="pzSelectCoat(this)">
              <strong><?php echo $meta[0]; ?></strong><span><?php echo $meta[1]; ?></span>
            </button>
            <?php endforeach; ?>
          </div>
          <input type="hidden" id="pz_coat_type" value="short">
        </div>

        <!-- STEP 1 — Activity & Season -->
        <div class="pz-wizard-step" data-step="1">
          <label class="pz-int-label-txt">Lifestyle</label>
          <div class="pz-activity-chips" id="pz_lifestyle_chips">
            <button type="button" class="pz-chip" data-val="indoor" onclick="pzSelectChip(this,'lifestyle')">🏠 Mostly Indoor</button>
            <button type="button" class="pz-chip active" data-val="outdoor" onclick="pzSelectChip(this,'lifestyle')">🌳 Regular Outdoor Play</button>
            <button type="button" class="pz-chip" data-val="muddy" onclick="pzSelectChip(this,'lifestyle')">💦 Swims / Very Muddy</button>
          </div>
          <input type="hidden" id="pz_lifestyle" value="outdoor">
          <label class="pz-int-label-txt" style="margin-top:20px">Current Season</label>
          <div class="pz-activity-chips" id="pz_season_chips">
            <button type="button" class="pz-chip active" data-val="mild" onclick="pzSelectChip(this,'season')">🌤️ Mild</button>
            <button type="button" class="pz-chip" data-val="hot_humid" onclick="pzSelectChip(this,'season')">☀️ Hot &amp; Humid</button>
            <button type="button" class="pz-chip" data-val="cold_dry" onclick="pzSelectChip(this,'season')">❄️ Cold &amp; Dry</button>
          </div>
          <input type="hidden" id="pz_season" value="mild">
        </div>

        <!-- STEP 2 — Skin & Weight -->
        <div class="pz-wizard-step" data-step="2">
          <div class="pz-int-field">
            <label class="pz-int-label-txt">Skin Condition</label>
            <select id="pz_skin_condition" class="pz-int-select">
              <option value="normal">Normal</option>
              <option value="dry">Sensitive / Dry Skin</option>
              <option value="oily">Oily / Odor-Prone</option>
            </select>
          </div>
          <div class="pz-int-field" style="margin-top:16px">
            <label class="pz-int-label-txt">Weight <span class="pz-int-optional">(for shampoo dosage)</span>
              <span class="pz-int-unit-toggle">
                <button type="button" class="pz-unit-btn active" onclick="pzSetUnit('lbs',this)">lbs</button>
                <button type="button" class="pz-unit-btn" onclick="pzSetUnit('kg',this)">kg</button>
              </span>
            </label>
            <div class="pz-int-input-wrap">
              <input type="number" id="pz_weight" class="pz-int-input" placeholder="e.g. 45" min="1" max="250" step="0.5">
              <span class="pz-int-input-suffix" id="pz-unit-label">lbs</span>
            </div>
          </div>
        </div>

        <!-- STEP 3 — Age & Timing -->
        <div class="pz-wizard-step" data-step="3">
          <div class="pz-int-field">
            <label class="pz-int-label-txt">Age</label>
            <select id="pz_age" class="pz-int-select">
              <option value="puppy_young">Puppy — under 12 weeks</option>
              <option value="puppy_older">Puppy — 12+ weeks</option>
              <option value="adult" selected>Adult</option>
              <option value="senior">Senior</option>
            </select>
          </div>
          <div class="pz-int-field" style="margin-top:16px">
            <label class="pz-int-label-txt">Last Bath Date <span class="pz-int-optional">(optional — for your next-bath date)</span></label>
            <input type="date" id="pz_last_bath" class="pz-int-input">
          </div>
          <div class="pz-int-field" style="margin-top:16px">
            <label class="pz-int-label-txt">Allergies in Household? <span class="pz-int-optional">(optional)</span></label>
            <select id="pz_allergies" class="pz-int-select">
              <option value="no">No</option>
              <option value="yes">Yes — reduce dander</option>
            </select>
          </div>
        </div>
      </div>

      <div class="pz-wizard-nav">
        <button type="button" class="pz-wizard-back" id="pz-wiz-back" onclick="pzWizStep(-1)" disabled>Back</button>
        <button type="button" class="pz-int-btn pz-wizard-next" id="pz-wiz-next" onclick="pzWizStep(1)">Next</button>
      </div>
      <div id="pz-calc-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

function pz_hero_quickanswer_dog_grooming_schedule() { ?>
      <div class="pz-hero-quickanswer">
        <strong>Quick answer:</strong> Most dogs need brushing weekly to daily (by coat type), a bath every 4–8 weeks, nail trims every 3–6 weeks, and a weekly ear check. Coat type and lifestyle shift each of these — use the calculator for your dog's exact calendar.
      </div>
<?php }

function pz_hero_trust_dog_grooming_schedule() { ?>
      <span>✅ 5 routines in one plan</span>
      <span>✅ Coat &amp; lifestyle aware</span>
      <span>✅ Free printable schedule</span>
<?php }

function pz_methodology_heading_dog_grooming_schedule() { return "What Decides Your Dog's Grooming Schedule"; }

function pz_methodology_dog_grooming_schedule() { ?>
    <p style="color:#555;margin-bottom:20px">The calculator builds a full grooming calendar by running your dog's coat type, size, ear shape, and lifestyle through five separate schedules — brushing, bathing, nails, ears, and teeth — the same categories a professional groomer plans around.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🖌️</div>
        <strong>Coat Type</strong>
        <p>Double and long coats need far more frequent brushing than short coats to prevent mats and manage shedding.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">👂</div>
        <strong>Ear Shape</strong>
        <p>Floppy ears trap moisture and airflow poorly, so they need more frequent checks than upright ears.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🏃</div>
        <strong>Lifestyle</strong>
        <p>Outdoor and muddy dogs naturally file down nails faster but need more frequent bathing and paw checks.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">📏</div>
        <strong>Breed Size</strong>
        <p>Larger dogs tend to have tougher nails and skin, which shifts trim and bathing intervals slightly longer.</p>
      </div>
    </div>
<?php }

function pz_faq_dog_grooming_schedule() {
    return [
        ["How often should I groom my dog overall?", "It depends on the routine: brushing ranges from daily (long or double coats) to weekly (short coats); bathing is typically every 4–8 weeks; nails every 3–6 weeks; ears weekly for floppy-eared dogs and monthly for upright ears; teeth ideally daily. Use the calculator above for a schedule matched to your dog's coat, size, ears, and lifestyle."],
        ["Do I need a professional groomer or can I do this all at home?", "Brushing, ear checks, and teeth brushing are easy to do at home with the right tools. Nail trims and haircuts for curly/double coats are often safer or easier with a professional, especially if your dog is nervous about the process or has a coat type prone to matting."],
        ["What happens if I skip brushing for a few weeks?", "Skipped brushing lets loose fur mat, especially around ears, armpits, and behind legs. Mats pull on skin and can trap moisture that leads to hot spots. Once a mat is tight against the skin, it usually needs a professional groomer rather than home brushing."],
        ["Does an outdoor, active dog need a different schedule than an indoor dog?", "Yes. Outdoor and muddy-lifestyle dogs need more frequent bathing and paw checks, but their nails often wear down naturally from walking on hard surfaces, so trims can be less frequent than for a mostly-indoor dog."],
        ["Why does ear shape affect the schedule?", "Floppy ears (Cocker Spaniels, Basset Hounds, Retrievers) block airflow and trap moisture, which creates a warm, damp environment bacteria and yeast thrive in — so they need weekly checks. Upright ears (Shepherds, Huskies, Corgis) get more airflow and can usually go a full month between checks."],
    ];
}

function pz_hero_bg_extra_dog_grooming_schedule() { ?>
      <div class="pz-hero-bristles" aria-hidden="true">
        <span class="pz-bristle-dot pz-bd-1"></span><span class="pz-bristle-dot pz-bd-2"></span>
        <span class="pz-bristle-dot pz-bd-3"></span><span class="pz-bristle-dot pz-bd-4"></span>
        <span class="pz-bristle-dot pz-bd-5"></span><span class="pz-bristle-dot pz-bd-6"></span>
        <span class="pz-bristle-dot pz-bd-7"></span><span class="pz-bristle-dot pz-bd-8"></span>
      </div>
<?php }

function pz_breed_rows_dog_grooming_schedule() {
    return [
        ['Toy / Small (under 25 lbs)', 'Nails every 3-4 weeks', 'Softer nails wear less from walking; more frequent trims needed'],
        ['Medium (25-60 lbs)', 'Standard 5-routine schedule', 'Most versatile; follow the calculator\'s default guidance'],
        ['Large / Giant (60+ lbs)', 'Nails every 5-6 weeks', 'Tougher nails and more paw-ground contact wear them down naturally'],
        ['Floppy-Eared Breeds', 'Ear checks weekly', 'Poor airflow under the ear flap traps moisture — check regardless of size'],
    ];
}

function pz_render_calc_dog_grooming_schedule( $tool ) {
    $icon = $tool['icon'] ?? '📅';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Dog Grooming Schedule Calculator</div>
          <div class="pz-int-sublabel">A full maintenance calendar — bathing, brushing, nails, ears &amp; teeth</div>
        </div>
      </div>
      <div class="pz-int-badges">
        <span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span>
        <span class="pz-int-badge pz-int-badge--purple">🎯 Personalized</span>
      </div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Coat Type</label>
          <select id="pz_coat_type2" class="pz-int-select">
            <option value="short">Short / Smooth (Beagle, Boxer, Dachshund)</option>
            <option value="double">Double-Coated (Husky, Lab, Shepherd, Golden)</option>
            <option value="long">Long-Haired (Shih Tzu, Maltese, Collie)</option>
            <option value="curly">Curly / Wavy (Poodle, Doodle, Bichon)</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Breed Size</label>
          <select id="pz_breed_size2" class="pz-int-select">
            <option value="small">Toy / Small (under 25 lbs)</option>
            <option value="medium" selected>Medium (25–60 lbs)</option>
            <option value="large">Large / Giant (60+ lbs)</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Ear Type</label>
          <select id="pz_ear_type" class="pz-int-select">
            <option value="floppy">Floppy / Drop Ears (Cocker, Basset, Retriever)</option>
            <option value="upright">Upright Ears (Shepherd, Husky, Corgi)</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Lifestyle</label>
          <select id="pz_lifestyle2" class="pz-int-select">
            <option value="indoor">Mostly Indoor / Low Mess</option>
            <option value="outdoor" selected>Regular Outdoor Play</option>
            <option value="muddy">Swims Often / Very Muddy</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzCalcGroomingSchedule()">
        <span class="pz-int-btn-icon"><?php echo $icon; ?></span>
        Generate My Grooming Schedule
      </button>
      <div id="pz-calc-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ═══════════════════════════════════════════════════════════
   GUIDE-TYPE INTERACTIVE TOOLS — dog-grooming category
═══════════════════════════════════════════════════════════ */

/* ── Dog Nail Trimming ── */
function pz_hero_quickanswer_dog_nail_trimming() { ?>
      <div class="pz-hero-quickanswer">
        <strong>Quick answer:</strong> Most dogs need a nail trim every 3–4 weeks. If you can hear nails clicking on hard floors, you're overdue. Pavement-walking dogs can often stretch to 5–6 weeks since walking naturally files nails down.
      </div>
<?php }
function pz_hero_trust_dog_nail_trimming() { ?>
      <span>✅ Quick-safe technique</span>
      <span>✅ Surface-aware timing</span>
      <span>✅ Free reminder schedule</span>
<?php }
function pz_methodology_heading_dog_nail_trimming() { return 'What Decides Your Dog\'s Nail Trim Schedule'; }
function pz_methodology_dog_nail_trimming() { ?>
    <p style="color:#555;margin-bottom:20px">Nail growth is fairly constant, but how fast nails need trimming depends on how much natural filing they get from daily walking — the same logic a groomer uses when they ask "does your dog walk on pavement or grass?"</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🚶</div><strong>Walking Surface</strong><p>Pavement and concrete file nails down naturally. Grass, carpet, and sand provide no filing at all.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🔊</div><strong>The Click Test</strong><p>If you can hear nails clicking on a hard floor when your dog walks, they're already too long.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🩸</div><strong>The Quick</strong><p>The quick (blood vessel) grows out with overly long nails, which is why gradual, frequent trims matter more than occasional big cuts.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🐾</div><strong>Breed & Paw Size</strong><p>Larger breeds and dewclaws (which never touch the ground) often need separate attention from the main nail schedule.</p></div>
    </div>
<?php }
function pz_faq_dog_nail_trimming() {
    return [
        ["How often should I trim my dog's nails?", "Most dogs need a trim every 3–4 weeks. Dogs that walk daily on pavement can often go 5–6 weeks since the surface files nails naturally, while dogs that mostly walk on grass or carpet may need trims closer to every 2–3 weeks."],
        ["How do I know if my dog's nails are too long?", "The clearest sign is hearing a clicking sound when your dog walks on a hard floor. You can also check visually from the side — nails that curve downward and touch the ground when standing are overdue."],
        ["What if I accidentally cut the quick?", "It happens even to experienced owners. Apply styptic powder (or cornstarch/flour in a pinch) with firm pressure for 30–60 seconds to stop the bleeding. It looks worse than it is, but keep an eye out for infection over the next couple of days."],
        ["Why won't my dog let me trim their nails?", "Most nail-shyness comes from a past bad experience or the vibration/sound of clippers or grinders. Go slow — trim one nail at a time over several short sessions, pair it with treats, and consider a grinder tool, which many dogs tolerate better than clippers."],
        ["Do dewclaws need trimming too?", "Yes — dewclaws never touch the ground, so they get zero natural filing and can grow into a curl that snags on things or even curves into the paw pad. Check them every time you trim the main nails."],
    ];
}
function pz_render_guide_dog_nail_trimming( $tool ) {
    $icon = $tool['icon'] ?? '✂️';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div><div class="pz-int-label">Nail Trim Frequency Calculator</div><div class="pz-int-sublabel">Surface-aware schedule · Free · Instant</div></div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--blue">🔬 Science-Based</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Main Walking Surface</label>
          <select id="pz_nail_surface" class="pz-int-select">
            <option value="pavement">Mostly Pavement / Concrete</option>
            <option value="mixed" selected>Mixed (Pavement &amp; Grass)</option>
            <option value="soft">Mostly Grass / Carpet / Sand</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Do Nails Click on Hard Floors?</label>
          <select id="pz_nail_click" class="pz-int-select">
            <option value="no">No, they're quiet</option>
            <option value="yes">Yes, I can hear them</option>
            <option value="unsure">Not sure</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Last Trim Date <span class="pz-int-optional">(optional)</span></label>
          <input type="date" id="pz_nail_last_trim" class="pz-int-input">
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenNailTrimming()"><span class="pz-int-btn-icon"><?php echo $icon; ?></span> Get My Trim Schedule</button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ── Dog Shedding ── */
function pz_hero_quickanswer_dog_shedding() { ?>
      <div class="pz-hero-quickanswer">
        <strong>Quick answer:</strong> Brushing frequency for shedding control depends on coat type — weekly for short coats, 3–4x/week for double coats (daily during spring/fall "blowing coat" season), and daily for long coats. Use the estimator below for your dog's exact routine.
      </div>
<?php }
function pz_hero_trust_dog_shedding() { ?>
      <span>✅ Coat-type matched</span>
      <span>✅ Shedding-season aware</span>
      <span>✅ Tool recommendations included</span>
<?php }
function pz_methodology_heading_dog_shedding() { return 'What Decides Your Dog\'s Shedding & Brushing Routine'; }
function pz_methodology_dog_shedding() { ?>
    <p style="color:#555;margin-bottom:20px">Shedding is normal hair-cycle turnover, not a problem to eliminate — the goal is managing loose hair before it ends up on your furniture. The routine below is built the way professional groomers plan a deshedding schedule.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🐕</div><strong>Coat Type</strong><p>Double coats shed the most volume; long coats shed less volume but mat faster without brushing.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🍂</div><strong>Seasonal "Coat Blow"</strong><p>Double-coated breeds shed their undercoat heavily in spring and fall — brushing needs jump sharply during these windows.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🧴</div><strong>Diet & Skin Health</strong><p>Omega-3 fatty acids and a balanced diet reduce excessive shedding tied to dry skin.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🪮</div><strong>Right Tool for the Coat</strong><p>Undercoat rakes work for double coats; slicker brushes suit long/curly coats — the wrong tool means more shedding, not less.</p></div>
    </div>
<?php }
function pz_faq_dog_shedding() {
    return [
        ["How often should I brush my dog to control shedding?", "It depends on coat type: short coats need weekly brushing, double coats need 3–4 times a week (daily during seasonal shedding), and long coats need daily brushing to prevent both loose hair buildup and matting."],
        ["Why does my dog shed so much in spring and fall?", "This is called 'blowing coat' — double-coated breeds (Huskies, Labs, Golden Retrievers, German Shepherds) shed their dense undercoat heavily twice a year as the seasons change. Daily brushing during these 2–3 week windows makes a big difference."],
        ["What's the best tool for heavy shedding?", "An undercoat rake or deshedding tool (like a Furminator-style comb) works best for double coats by pulling loose undercoat hair without cutting the topcoat. Slicker brushes are better suited to long or curly coats."],
        ["Can diet actually reduce shedding?", "Yes, to a degree. Diets rich in omega-3 and omega-6 fatty acids support healthy skin and a stronger coat, which can reduce excessive shedding caused by dry, irritated skin — though breed-normal seasonal shedding will still happen regardless of diet."],
        ["Should I ever shave a heavily-shedding double-coated dog?", "No. Shaving a double coat doesn't reduce shedding and can permanently damage how the coat regrows, plus it removes the insulation that protects against both heat and cold. Frequent brushing, not shaving, is the correct fix."],
    ];
}
function pz_render_guide_dog_shedding( $tool ) {
    $icon = $tool['icon'] ?? '🪮';
    $breeds = pz_get_dog_breed_coat_map();
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div><div class="pz-int-label">Shedding & Brushing Estimator</div><div class="pz-int-sublabel">Coat-type matched · Free · Instant</div></div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--blue">🔬 Science-Based</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field" style="grid-column:1/-1">
          <label class="pz-int-label-txt">Breed <span class="pz-int-optional">(optional — auto-fills coat type)</span></label>
          <input type="text" id="pz_shed_breed" class="pz-int-input" placeholder="Start typing a breed…" autocomplete="off" data-breeds='<?php echo json_encode($breeds, JSON_UNESCAPED_SLASHES); ?>'>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Coat Type</label>
          <select id="pz_shed_coat" class="pz-int-select">
            <option value="short">Short &amp; Smooth</option>
            <option value="double">Double Coat</option>
            <option value="long">Long &amp; Silky</option>
            <option value="curly">Curly / Wire</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Current Season</label>
          <select id="pz_shed_season" class="pz-int-select">
            <option value="peak">Spring / Fall (Peak Shedding)</option>
            <option value="off" selected>Summer / Winter</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenShedding()"><span class="pz-int-btn-icon"><?php echo $icon; ?></span> Get My Brushing Routine</button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ── Dog Ear Cleaning ── */
function pz_hero_quickanswer_dog_ear_cleaning() { ?>
      <div class="pz-hero-quickanswer">
        <strong>Quick answer:</strong> Floppy-eared dogs need a weekly check and cleaning every 1–2 weeks; upright-eared dogs usually only need a monthly check. Dogs that swim often or have had past infections need more frequent cleaning regardless of ear shape.
      </div>
<?php }
function pz_hero_trust_dog_ear_cleaning() { ?>
      <span>✅ Ear-shape matched</span>
      <span>✅ Infection-history aware</span>
      <span>✅ Vet-safe technique</span>
<?php }
function pz_methodology_heading_dog_ear_cleaning() { return 'What Decides Your Dog\'s Ear Cleaning Schedule'; }
function pz_methodology_dog_ear_cleaning() { ?>
    <p style="color:#555;margin-bottom:20px">Ear infections thrive in warm, moist, low-airflow environments — so the schedule below is built around exactly the three factors that control airflow and moisture in your dog's ear canal.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card"><div class="pz-methodology-icon">👂</div><strong>Ear Shape</strong><p>Floppy ears trap heat and moisture against the canal; upright ears get constant airflow.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">💦</div><strong>Water Exposure</strong><p>Swimming or frequent baths introduce moisture that needs drying and cleaning to prevent bacterial growth.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🩺</div><strong>Infection History</strong><p>Dogs with past infections have a disrupted ear microbiome and need closer monitoring going forward.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🧴</div><strong>Cleaning Solution</strong><p>Over-cleaning with the wrong product can irritate the canal just as much as under-cleaning — vet-formulated solutions matter.</p></div>
    </div>
<?php }
function pz_faq_dog_ear_cleaning() {
    return [
        ["How often should I clean my dog's ears?", "Floppy-eared dogs generally need a weekly check with cleaning every 1–2 weeks. Upright-eared dogs can usually go a full month between cleanings. Dogs that swim often or have a history of ear infections need more frequent attention regardless of ear shape."],
        ["What are the signs of an ear infection?", "Watch for head shaking, scratching at the ear, a strong odor, redness or swelling inside the ear flap, dark discharge, or signs of pain when the ear is touched. Any of these warrant a vet visit rather than home cleaning."],
        ["What should I use to clean my dog's ears?", "Use a vet-formulated dog ear cleaner, never water alone, cotton swabs (which can push debris deeper), or human ear products. Apply the solution, massage the base of the ear, then let your dog shake before wiping visible debris with a cotton ball."],
        ["Can swimming cause ear infections in dogs?", "Yes — trapped water creates the warm, moist environment bacteria and yeast need to multiply. Dogs that swim regularly should have their ears dried thoroughly afterward and cleaned more often than the general schedule suggests."],
        ["Are floppy-eared breeds really more prone to infections?", "Yes. Breeds like Cocker Spaniels, Basset Hounds, and Retrievers have ear flaps that block airflow to the canal, creating conditions bacteria and yeast thrive in. This is a real anatomical risk factor, not just anecdotal."],
    ];
}
function pz_render_guide_dog_ear_cleaning( $tool ) {
    $icon = $tool['icon'] ?? '👂';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div><div class="pz-int-label">Ear Cleaning Frequency Calculator</div><div class="pz-int-sublabel">Ear-shape matched · Free · Instant</div></div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--blue">🔬 Science-Based</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Ear Type</label>
          <select id="pz_ear_shape" class="pz-int-select">
            <option value="floppy">Floppy / Drop Ears</option>
            <option value="upright">Upright Ears</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Swims or Bathes Often?</label>
          <select id="pz_ear_water" class="pz-int-select">
            <option value="no">No, rarely</option>
            <option value="yes">Yes, regularly</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">History of Ear Infections?</label>
          <select id="pz_ear_history" class="pz-int-select">
            <option value="no">No history</option>
            <option value="yes">Yes, has happened before</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenEarCleaning()"><span class="pz-int-btn-icon"><?php echo $icon; ?></span> Get My Ear Care Schedule</button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ── Dog Teeth Brushing ── */
function pz_hero_quickanswer_dog_teeth_brushing() { ?>
      <div class="pz-hero-quickanswer">
        <strong>Quick answer:</strong> Daily brushing is ideal for dogs; a minimum of 2–3 times a week still provides real benefit. If you're starting from zero, build up gradually — and if tartar is already visible, a vet dental cleaning should come first.
      </div>
<?php }
function pz_hero_trust_dog_teeth_brushing() { ?>
      <span>✅ Beginner-friendly ramp-up</span>
      <span>✅ Age-aware guidance</span>
      <span>✅ Tartar red-flag check</span>
<?php }
function pz_methodology_heading_dog_teeth_brushing() { return 'What Decides Your Dog\'s Dental Care Routine'; }
function pz_methodology_dog_teeth_brushing() { ?>
    <p style="color:#555;margin-bottom:20px">Dental disease is one of the most under-treated issues in dogs — over 80% show signs by age 3. The routine below is built around how quickly plaque hardens into tartar and how much catch-up is needed.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🦷</div><strong>Starting Point</strong><p>Going from zero brushing straight to daily is unrealistic — a gradual ramp-up gets better long-term compliance.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">📅</div><strong>Plaque Timeline</strong><p>Plaque hardens into tartar within roughly 24–72 hours, which is why "a few times a week" beats occasional deep cleans.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🐾</div><strong>Age</strong><p>Senior dogs carry more accumulated risk and benefit most from catching up to a consistent routine now.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🩺</div><strong>Visible Tartar</strong><p>Hardened tartar can't be brushed away — it signals a professional vet cleaning is needed before home care can keep up.</p></div>
    </div>
<?php }
function pz_faq_dog_teeth_brushing() {
    return [
        ["How often should I brush my dog's teeth?", "Daily is ideal, since plaque begins hardening into tartar within 24–72 hours. If daily isn't realistic, aim for a minimum of 2–3 times a week — still far better than not brushing at all."],
        ["My dog won't let me brush their teeth — what do I do?", "Start without a brush at all: just touch and rub the gums with your finger for a few days until it's normal. Then introduce dog-safe toothpaste on your finger, and only bring in a brush once your dog tolerates that. Go slow over 1–2 weeks rather than forcing it."],
        ["Can I use human toothpaste on my dog?", "No — human toothpaste often contains xylitol and fluoride, both toxic to dogs if swallowed (and dogs can't spit). Always use a toothpaste made specifically for dogs, which is also flavored to be more appealing."],
        ["What if I already see tartar buildup?", "Visible tartar (a hard, yellow-brown crust) can't be removed by brushing alone — it needs a professional dental cleaning under the vet's care first. After that, a consistent home brushing routine keeps new tartar from forming."],
        ["Do dental chews and water additives actually work?", "They help but don't replace brushing. Chews provide mechanical scraping action and additives reduce bacterial load, making them a good supplement to a brushing routine — not a substitute for one, especially for plaque already near the gumline."],
    ];
}
function pz_render_guide_dog_teeth_brushing( $tool ) {
    $icon = $tool['icon'] ?? '🦷';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div><div class="pz-int-label">Dental Care Routine Builder</div><div class="pz-int-sublabel">Personalized ramp-up plan · Free · Instant</div></div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--purple">🎯 Personalized</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Current Brushing Frequency</label>
          <select id="pz_teeth_current" class="pz-int-select">
            <option value="never">Never brushed</option>
            <option value="rare">A few times a month</option>
            <option value="weekly">Once or twice a week</option>
            <option value="daily">Already daily</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Age Group</label>
          <select id="pz_teeth_age" class="pz-int-select">
            <option value="puppy">Puppy</option>
            <option value="adult" selected>Adult</option>
            <option value="senior">Senior</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Visible Tartar (yellow/brown crust)?</label>
          <select id="pz_teeth_tartar" class="pz-int-select">
            <option value="no">No visible tartar</option>
            <option value="yes">Yes, I can see some</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenTeethBrushing()"><span class="pz-int-btn-icon"><?php echo $icon; ?></span> Build My Dental Routine</button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ── Puppy First Grooming ── */
function pz_hero_quickanswer_puppy_first_grooming() { ?>
      <div class="pz-hero-quickanswer">
        <strong>Quick answer:</strong> Puppies under 8 weeks aren't ready for a real grooming session — stick to gentle handling and touch desensitization. From 8–12 weeks you can introduce brushing and a first gentle bath once vaccinated. By 12–16 weeks most puppies are ready for a real first grooming session, and by 16+ weeks they can move into their regular adult, coat-type routine.
      </div>
<?php }
function pz_hero_trust_puppy_first_grooming() { ?>
      <span>✅ Age-stage matched</span>
      <span>✅ Vaccine-aware timing</span>
      <span>✅ Vet-safe guidance</span>
<?php }
function pz_methodology_heading_puppy_first_grooming() { return 'What Decides When Your Puppy Is Ready for Grooming'; }
function pz_methodology_puppy_first_grooming() { ?>
    <p style="color:#555;margin-bottom:20px">Puppies aren't just small adult dogs — their body temperature regulation, immune system, and stress tolerance are still developing. The checker below walks through the same age, vaccine, and coat-type factors a groomer checks before booking a puppy's first appointment.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🐾</div><strong>Age &amp; Development</strong><p>Puppies under 8 weeks can't yet regulate body temperature well and stress easily — handling practice only, no bathing or clippers.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">💉</div><strong>Vaccination Status</strong><p>A puppy's immune system isn't fully protected until their first vaccine series is complete, which affects when a full bath is safe.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🧸</div><strong>Coat Type</strong><p>Coat type determines which brush and how much desensitization work is needed before the first real grooming session.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">😊</div><strong>Positive First Experiences</strong><p>How a puppy's first few sessions go shapes how they feel about grooming for life — short, positive, reward-based sessions matter more than getting it "done" fast.</p></div>
    </div>
<?php }
function pz_faq_puppy_first_grooming() {
    return [
        ["When can I start grooming my puppy?", "Gentle handling and touch desensitization (paws, ears, mouth) can start as soon as you bring your puppy home, even under 8 weeks. A real grooming session with brushing and bathing is usually appropriate from 12–16 weeks, once your puppy has had at least their first round of vaccines."],
        ["Can I bathe my puppy before they're fully vaccinated?", "A full bath is best held off until your puppy has had their first vaccinations, generally around 8–12 weeks — check the exact timing with your vet. Before that, spot-clean with a damp cloth instead of a full bath."],
        ["How do I get my puppy used to grooming?", "Start with short daily handling sessions — touch their paws, look in their ears, lift their lips to look at teeth — and pair each with a treat. This desensitization work is the single biggest predictor of whether an adult dog tolerates grooming calmly."],
        ["What if my puppy is scared during their first grooming session?", "Keep sessions very short (a few minutes), stop before they get overwhelmed, and end on a calm note with a treat. Forcing a scared puppy through a full groom can create a lasting fear response — several short positive sessions beat one long stressful one."],
        ["Do I need a professional groomer for a puppy's first grooming?", "It's not required, but many groomers offer a 'puppy introduction' visit — a short, no-pressure session just to get your puppy comfortable with the sounds, tools, and environment before their first full groom. This can pay off for the rest of their grooming life."],
    ];
}
function pz_render_guide_puppy_first_grooming( $tool ) {
    $icon = $tool['icon'] ?? '🐶';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div><div class="pz-int-label">Puppy Grooming Readiness Checker</div><div class="pz-int-sublabel">Age-stage matched · Free · Instant</div></div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--purple">🎯 Age-Matched</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Puppy Age</label>
          <select id="pz_puppy_age" class="pz-int-select">
            <option value="under8">Under 8 weeks</option>
            <option value="8to12">8–12 weeks</option>
            <option value="12to16" selected>12–16 weeks</option>
            <option value="16plus">16+ weeks</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Coat Type</label>
          <select id="pz_puppy_coat" class="pz-int-select">
            <option value="short">Short &amp; Smooth</option>
            <option value="double">Double Coat</option>
            <option value="long">Long &amp; Silky</option>
            <option value="curly">Curly / Wire</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Had First Vet Visit / Vaccines?</label>
          <select id="pz_puppy_vaccinated" class="pz-int-select">
            <option value="no" selected>Not yet</option>
            <option value="yes">Yes, first shots done</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenPuppyGrooming()"><span class="pz-int-btn-icon"><?php echo $icon; ?></span> Check Grooming Readiness</button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ── Dog Coat Type ── */
function pz_hero_quickanswer_dog_coat_type() { ?>
      <div class="pz-hero-quickanswer">
        <strong>Quick answer:</strong> Your dog's coat type — not breed alone — determines almost everything about their grooming routine: how often to brush, how often to bathe, and whether they need professional trims. Search your breed below, or pick your coat type manually, for a care plan built around that specific coat.
      </div>
<?php }
function pz_hero_trust_dog_coat_type() { ?>
      <span>✅ 77 breeds recognized</span>
      <span>✅ 6 coat types covered</span>
      <span>✅ Instant care plan</span>
<?php }
function pz_methodology_heading_dog_coat_type() { return 'How Coat Type Drives Your Dog\'s Care Plan'; }
function pz_methodology_dog_coat_type() { ?>
    <p style="color:#555;margin-bottom:20px">Groomers plan every routine — brushing, bathing, trimming — around coat type first, breed second. The tool below matches your dog's coat structure to the brushing, bathing, and trimming plan that actually works for it.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🪮</div><strong>Brushing Needs</strong><p>How fast a coat mats or sheds decides brushing frequency — daily for long/curly coats, weekly or less for short coats.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🛁</div><strong>Bathing Interval</strong><p>Oily double and wire coats hold protective oils that frequent washing strips away; silky and hairless coats get dirty faster.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">✂️</div><strong>Professional Trims</strong><p>Curly and wire coats keep growing and need a professional trim on a schedule; short and double coats rarely need one at all.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">⚠️</div><strong>Coat-Specific Risks</strong><p>Each coat type has one care mistake that causes the most damage — like shaving a double coat or skipping mat checks on a curly coat.</p></div>
    </div>
<?php }
function pz_faq_dog_coat_type() {
    return [
        ["How do I know my dog's coat type?", "Coat type is based on hair structure, not just length: short & smooth (single layer, close to the skin), double (a soft undercoat plus a coarser topcoat), long & silky (fine, flowing hair), curly/wool (dense, springy curls), wire (coarse, broken-textured), or hairless. Search your breed above or compare your dog's coat to these descriptions."],
        ["Can I shave my double-coated dog to help with shedding or heat?", "No — shaving a double coat removes the insulation that protects against both heat and cold, doesn't meaningfully reduce shedding, and can permanently change how the coat regrows, sometimes patchy or the wrong texture. Deshedding treatments, not shaving, are the correct fix."],
        ["Why does my curly-coated dog need trims so often?", "Curly and wool coats (Poodles, Bichons, Doodles) grow continuously like human hair instead of shedding out on a cycle. Without a trim every 6–8 weeks, the coat mats close to the skin, which is uncomfortable and can hide skin problems underneath."],
        ["What's special about wire coats?", "Wire coats (terriers, Schnauzers) have a harsh, broken outer texture that clipping alone tends to soften over time. Hand-stripping — pulling dead hairs by hand or tool — preserves the correct wire texture and coloring; regular clipping alone changes both."],
        ["Do hairless dogs need any coat care at all?", "Yes — hairless breeds need more skin care than coated breeds: a regular moisturizer to prevent dryness, sunscreen for sun exposure, and protection from cold. Brushing is minimal to none since there's no coat, but skin care essentially replaces it."],
    ];
}
function pz_render_guide_dog_coat_type( $tool ) {
    $icon   = $tool['icon'] ?? '🐩';
    $breeds = pz_get_dog_breed_coat_map();
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div><div class="pz-int-label">Coat Type Identifier &amp; Care Plan</div><div class="pz-int-sublabel">Breed-matched · Free · Instant</div></div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--blue">🔬 Science-Based</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field" style="grid-column:1/-1">
          <label class="pz-int-label-txt">Breed <span class="pz-int-optional">(optional — auto-fills coat type)</span></label>
          <input type="text" id="pz_ct_breed" class="pz-int-input" placeholder="Start typing a breed…" autocomplete="off" data-breeds='<?php echo json_encode($breeds, JSON_UNESCAPED_SLASHES); ?>'>
        </div>
        <div class="pz-int-field" style="grid-column:1/-1">
          <label class="pz-int-label-txt">Manual Coat Type <span class="pz-int-optional">(used only if breed isn't found above)</span></label>
          <select id="pz_ct_manual" class="pz-int-select">
            <option value="short">Short &amp; Smooth</option>
            <option value="double">Double Coat</option>
            <option value="long">Long &amp; Silky</option>
            <option value="curly">Curly / Wool</option>
            <option value="wire">Wire-Haired</option>
            <option value="hairless">Hairless</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenCoatType()"><span class="pz-int-btn-icon"><?php echo $icon; ?></span> Get My Coat Care Plan</button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ── Dog Eye Cleaning ── */
function pz_hero_quickanswer_dog_eye_cleaning() { ?>
      <div class="pz-hero-quickanswer">
        <strong>Quick answer:</strong> Flat-faced breeds usually need a daily eye wipe due to their facial structure; normal-muzzled dogs are often fine with 2–3 times a week. Yellow or green discharge is different from routine tear staining and should be checked by a vet, regardless of your dog's face shape.
      </div>
<?php }
function pz_hero_trust_dog_eye_cleaning() { ?>
      <span>✅ Face-shape matched</span>
      <span>✅ Discharge color guide</span>
      <span>✅ Vet red-flag check</span>
<?php }
function pz_methodology_heading_dog_eye_cleaning() { return 'What Decides Your Dog\'s Eye Cleaning Routine'; }
function pz_methodology_dog_eye_cleaning() { ?>
    <p style="color:#555;margin-bottom:20px">Not all eye discharge is the same, and not all dogs need the same cleaning schedule. The guide below separates routine tear staining — a cosmetic, face-shape-driven issue — from discharge that's actually a sign something needs a vet's attention.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card"><div class="pz-methodology-icon">👃</div><strong>Face Shape</strong><p>Flat-faced (brachycephalic) breeds have shallow eye sockets and skin folds that trap tears, making daily wiping the norm rather than the exception.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🎨</div><strong>Discharge Color</strong><p>Clear or light brown tearing is usually cosmetic. Yellow or green discharge usually signals infection or irritation and needs a vet, not just a wipe.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🧻</div><strong>Wiping Technique</strong><p>Always wipe outward and away from the eye's inner corner, using a fresh section of cloth or wipe for each eye to avoid spreading anything between them.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🧴</div><strong>The Right Product</strong><p>Water alone doesn't remove the porphyrin pigment that causes brown staining — a designated tear-stain remover does a better job.</p></div>
    </div>
<?php }
function pz_faq_dog_eye_cleaning() {
    return [
        ["How often should I clean my dog's eyes?", "Flat-faced breeds typically need a daily wipe due to their facial structure trapping tears. Dogs with a normal muzzle usually only need cleaning 2–3 times a week, or as needed if you notice staining or discharge building up."],
        ["What does yellow or green eye discharge mean?", "Yellow or green discharge is different from routine tear staining and can indicate an eye infection, conjunctivitis, or another irritation. This warrants a vet visit rather than home cleaning alone, regardless of your dog's breed or face shape."],
        ["Why does my dog have brown stains under their eyes?", "Brown tear staining comes from a pigment called porphyrin in tears, which oxidizes to a rust-brown color when exposed to air — it's most visible on light-colored coats. It's usually cosmetic, not a health problem, though persistent heavy staining is worth mentioning to your vet."],
        ["How do I clean my dog's eyes properly?", "Use a damp, clean cloth, cotton pad, or a designated dog tear-stain wipe (not just water for stubborn staining). Wipe gently outward and away from the inner corner of the eye, using a fresh section for each eye so you don't transfer anything between them."],
        ["Are flat-faced breeds more prone to eye problems in general?", "Yes. Breeds like Pugs, Bulldogs, and Shih Tzus have shallow eye sockets, prominent eyes, and facial folds — this anatomy makes them more prone to tear staining, corneal irritation, and other eye issues, so regular monitoring matters more for these breeds."],
    ];
}
function pz_render_guide_dog_eye_cleaning( $tool ) {
    $icon = $tool['icon'] ?? '👁️';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div><div class="pz-int-label">Eye Discharge Cleaning Frequency Guide</div><div class="pz-int-sublabel">Face-shape matched · Free · Instant</div></div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--blue">🔬 Science-Based</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Face Shape</label>
          <select id="pz_eye_face" class="pz-int-select">
            <option value="flat">Flat-Faced / Brachycephalic (Pug, Bulldog, Shih Tzu)</option>
            <option value="normal">Normal Muzzle</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Discharge Color</label>
          <select id="pz_eye_color" class="pz-int-select">
            <option value="clear">Clear or light tear-staining</option>
            <option value="brown">Brown/rust tear stains</option>
            <option value="yellow_green">Yellow or green discharge</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">How Often Now</label>
          <select id="pz_eye_freq" class="pz-int-select">
            <option value="daily">Already cleaning daily</option>
            <option value="occasional">Occasionally / as needed</option>
            <option value="never">Never cleaned</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenEyeCleaning()"><span class="pz-int-btn-icon"><?php echo $icon; ?></span> Get My Eye Care Schedule</button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ── Dog Paw Care ── */
function pz_hero_quickanswer_dog_paw_care() { ?>
      <div class="pz-hero-quickanswer">
        <strong>Quick answer:</strong> Hot pavement can burn paw pads within seconds — test it with the back of your hand for 5 seconds before a walk. Cold weather calls for paw wax and rinsing off road salt. Trail walkers should check paws for cuts and debris after every walk, in any season.
      </div>
<?php }
function pz_hero_trust_dog_paw_care() { ?>
      <span>✅ Season-aware guidance</span>
      <span>✅ Terrain-specific checks</span>
      <span>✅ Vet red-flag included</span>
<?php }
function pz_methodology_heading_dog_paw_care() { return 'What Decides Your Dog\'s Paw Care Routine'; }
function pz_methodology_dog_paw_care() { ?>
    <p style="color:#555;margin-bottom:20px">Paw pads take more daily abuse than any other part of a dog's body — heat, cold, chemicals, and rough terrain all leave a mark. The routine below matches the season and terrain your dog actually walks on, and flags when dryness needs more than just a balm.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card"><div class="pz-methodology-icon">☀️</div><strong>Hot Weather &amp; Pavement</strong><p>Asphalt can be far hotter than the air temperature and cause burns within seconds — the 5-second hand test tells you if it's too hot to walk on.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">❄️</div><strong>Cold Weather &amp; Salt</strong><p>Road salt and de-icing chemicals irritate paw pads and are toxic if licked off; snow and ice can also ball up painfully between toes.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🥾</div><strong>Terrain</strong><p>Trails and rough ground carry a real risk of cuts, thorns, and debris that a quick paw check after each walk catches early.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🩺</div><strong>Cracked or Dry Pads</strong><p>Persistent cracking that doesn't improve with a moisturizing routine within 1–2 weeks can signal an allergy or infection needing a vet's attention.</p></div>
    </div>
<?php }
function pz_faq_dog_paw_care() {
    return [
        ["How do I know if pavement is too hot for my dog's paws?", "Press the back of your hand firmly onto the pavement and hold it for 5 seconds. If it's too hot for your hand to comfortably stay there, it's too hot for your dog's paws. Walk early morning or evening instead, or stick to grass."],
        ["Do I need to protect my dog's paws in winter?", "Yes — road salt and de-icing chemicals irritate paw pads and are toxic if your dog licks them off, and snow/ice can ball up painfully between the toes. A paw wax or balm before walks and rinsing paws afterward both help."],
        ["What can I do about my dog's cracked or dry paw pads?", "Apply a dog-safe moisturizing paw balm daily until the cracking improves, and avoid walking on rough or hot/cold extreme surfaces while healing. If cracking doesn't improve within 1–2 weeks, or keeps recurring, have your vet check for an allergy or infection."],
        ["Should I trim the hair between my dog's paw pads?", "For many breeds, yes — overgrown hair between the pads collects ice, mud, and debris, and can cause slipping on smooth floors. Trim carefully with blunt-tip scissors or ask your groomer to include it in a regular grooming visit."],
        ["What should I check for after a walk on trails?", "Check between the toes and pads for cuts, thorns, small stones, or embedded debris, regardless of season. Trail walking carries a higher risk of paw injury than pavement, so a quick post-walk check should become a habit."],
    ];
}
function pz_render_guide_dog_paw_care( $tool ) {
    $icon = $tool['icon'] ?? '🐾';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div><div class="pz-int-label">Paw Care Routine Builder</div><div class="pz-int-sublabel">Season &amp; terrain matched · Free · Instant</div></div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--blue">🔬 Science-Based</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Season</label>
          <select id="pz_paw_season" class="pz-int-select">
            <option value="hot">Hot Weather / Pavement</option>
            <option value="cold">Cold Weather / Snow &amp; Salt</option>
            <option value="mild" selected>Mild Weather</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Terrain</label>
          <select id="pz_paw_terrain" class="pz-int-select">
            <option value="pavement">Mostly Pavement</option>
            <option value="trail">Trails / Rough Ground</option>
            <option value="mixed" selected>Mixed</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Cracked or Dry Paws Now?</label>
          <select id="pz_paw_condition" class="pz-int-select">
            <option value="no">No, paws look healthy</option>
            <option value="yes">Yes, some cracking or dryness</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenPawCare()"><span class="pz-int-btn-icon"><?php echo $icon; ?></span> Build My Paw Care Routine</button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ── Dog Anal Gland ── */
function pz_hero_quickanswer_dog_anal_gland() { ?>
      <div class="pz-hero-quickanswer">
        <strong>Quick answer:</strong> Most dogs' anal glands express naturally with firm, regular bowel movements and never need manual help. Frequent scooting or licking is your dog's way of signaling discomfort and is best handled by a vet or groomer — not a DIY job at home.
      </div>
<?php }
function pz_hero_trust_dog_anal_gland() { ?>
      <span>✅ Vet-safe guidance</span>
      <span>✅ Breed-size aware</span>
      <span>✅ No DIY risk</span>
<?php }
function pz_methodology_heading_dog_anal_gland() { return 'What Decides Your Dog\'s Anal Gland Attention Needs'; }
function pz_methodology_dog_anal_gland() { ?>
    <p style="color:#555;margin-bottom:20px">Most dogs never need a human involved in this process at all — firm, regular stool does the job naturally. This estimator focuses on the two signals that actually matter: breed size and the presence of scooting or licking.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card"><div class="pz-methodology-icon">📏</div><strong>Breed Size</strong><p>Smaller breeds are statistically more prone to anal gland issues than large breeds, though any dog can be affected.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🚨</div><strong>Scooting &amp; Licking</strong><p>These are your dog's own signal that something's uncomfortable back there — not a habit or behavior issue to train away.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🥗</div><strong>Diet &amp; Stool Firmness</strong><p>Firm, well-formed stool applies natural pressure that expresses the glands during normal bowel movements; soft stool doesn't.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">👩‍⚕️</div><strong>Leave Expression to a Professional</strong><p>Manual expression done incorrectly can bruise or injure the glands — this is one grooming task best left to a vet or professional groomer.</p></div>
    </div>
<?php }
function pz_faq_dog_anal_gland() {
    return [
        ["How often do dogs need their anal glands expressed?", "Most dogs never need manual expression at all — firm, regular bowel movements naturally express the glands during defecation. Only dogs showing signs of discomfort (scooting, licking, a fishy odor) typically need help, and how often varies dog to dog."],
        ["Should I express my dog's anal glands at home myself?", "It's not recommended for most owners. Done incorrectly, manual expression can bruise or injure the glands. If your dog is scooting or licking frequently, book a vet or professional groomer appointment instead of attempting it yourself."],
        ["What breeds are more prone to anal gland problems?", "Smaller breeds — like Chihuahuas, Poodles, and Cocker Spaniels — tend to have more anal gland issues than larger breeds, though any dog of any size can develop problems, especially with soft stool or obesity."],
        ["What are the signs my dog's anal glands need attention?", "Watch for scooting across the floor, excessive licking or biting at the area under the tail, a strong fishy odor, or visible swelling near the anus. Frequent or worsening signs warrant a vet visit rather than waiting it out."],
        ["Can diet help prevent anal gland problems?", "Yes, to a degree. A fiber-rich diet that produces firm, well-formed stool applies natural pressure that helps express the glands during normal bowel movements. If your dog has recurring issues, ask your vet about a fiber supplement or diet change."],
    ];
}
function pz_render_guide_dog_anal_gland( $tool ) {
    $icon = $tool['icon'] ?? '🔬';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div><div class="pz-int-label">Anal Gland Expression Frequency Estimator</div><div class="pz-int-sublabel">Vet-safe guidance · Free · Instant</div></div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--blue">🔬 Science-Based</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Breed Size</label>
          <select id="pz_ag_size" class="pz-int-select">
            <option value="small">Small (under 25 lbs)</option>
            <option value="medium" selected>Medium (25–60 lbs)</option>
            <option value="large">Large (60+ lbs)</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Scooting or Licking</label>
          <select id="pz_ag_scooting" class="pz-int-select">
            <option value="never">Never / rarely</option>
            <option value="occasional">Occasionally</option>
            <option value="frequent">Frequently</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenAnalGland()"><span class="pz-int-btn-icon"><?php echo $icon; ?></span> Get My Guidance</button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ── Dog Haircut Styles ── */
function pz_hero_quickanswer_dog_haircut_styles() { ?>
      <div class="pz-hero-quickanswer">
        <strong>Quick answer:</strong> Your dog's coat type, climate, and how much brushing time you realistically have determine the right haircut — never a shave-down for double coats, a low-maintenance "puppy cut" for curly coats on a budget, and longer natural lengths only when you can commit to daily brushing.
      </div>
<?php }
function pz_hero_trust_dog_haircut_styles() { ?>
      <span>✅ Coat-safe recommendations</span>
      <span>✅ Climate matched</span>
      <span>✅ Named style + interval</span>
<?php }
function pz_methodology_heading_dog_haircut_styles() { return 'What Decides the Right Haircut Style for Your Dog'; }
function pz_methodology_dog_haircut_styles() { ?>
    <p style="color:#555;margin-bottom:20px">The best haircut for a dog balances three things: what their coat is actually built to handle, the climate they live in, and how much upkeep you can realistically commit to between professional visits. Get any of the three wrong and the coat suffers.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🐕</div><strong>Coat Type Limits</strong><p>Some coats should never be shaved (double coats) while others need regular cutting to avoid matting (curly/wool coats) — the coat itself sets the boundaries.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🌡️</div><strong>Climate</strong><p>Double coats already regulate temperature in both directions — shaving them for "cooling" backfires. Climate matters more for how a style is maintained than whether a coat can be shaved.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">⏱️</div><strong>Maintenance Time</strong><p>A style that needs daily brushing but only gets weekly attention will mat regardless of how good the initial cut was.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">📅</div><strong>Professional Interval</strong><p>Every recommended style comes with a typical number of weeks between professional visits to keep it looking — and functioning — right.</p></div>
    </div>
<?php }
function pz_faq_dog_haircut_styles() {
    return [
        ["Should I shave my double-coated dog in summer?", "No. Shaving a double coat doesn't cool the dog effectively — the undercoat actually insulates against heat as well as cold — and it can permanently damage how the coat regrows, sometimes coming back patchy or the wrong texture. A deshedding treatment is the better summer fix."],
        ["What's a 'puppy cut' and which dogs suit it?", "A puppy cut trims the coat to a short, even length all over (usually 1–2 inches), dramatically cutting down on brushing and matting. It suits curly or wool-coated dogs whose owners have low daily maintenance time, and is typically redone every 6–8 weeks."],
        ["Can I keep my long-haired dog's coat long without much work?", "Not really — long, silky coats need daily brushing to stay mat-free regardless of style. If daily brushing isn't realistic, a shorter, lower-maintenance cut will keep your dog more comfortable than a neglected long coat."],
        ["How often should I get my dog professionally groomed for their style?", "It depends on the style: low-maintenance short cuts on curly/wool coats need a redo every 6–8 weeks, longer curly show-length trims every 5–6 weeks, and natural long coats mainly need trims for hygiene areas every 8–10 weeks."],
        ["What's the difference between a haircut and a deshedding treatment?", "A haircut actually cuts the coat's length and shape — appropriate for coats that grow continuously like curly, wool, or long coats. A deshedding treatment removes loose undercoat without cutting length, which is the correct choice for double coats instead of a haircut."],
    ];
}
function pz_render_guide_dog_haircut_styles( $tool ) {
    $icon = $tool['icon'] ?? '✂️';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div><div class="pz-int-label">Haircut Style Finder</div><div class="pz-int-sublabel">Coat-safe · Climate matched · Free</div></div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--purple">🎯 Personalized</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Coat Type</label>
          <select id="pz_style_coat" class="pz-int-select">
            <option value="short">Short &amp; Smooth</option>
            <option value="double">Double Coat</option>
            <option value="long">Long &amp; Silky</option>
            <option value="curly">Curly / Wire</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Climate</label>
          <select id="pz_style_climate" class="pz-int-select">
            <option value="hot">Hot Climate</option>
            <option value="cold">Cold Climate</option>
            <option value="moderate" selected>Moderate</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Maintenance Time Available</label>
          <select id="pz_style_time" class="pz-int-select">
            <option value="low">Low — brush occasionally</option>
            <option value="medium" selected>Medium — brush a few times/week</option>
            <option value="high">High — daily brushing is fine</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenHaircutStyle()"><span class="pz-int-btn-icon"><?php echo $icon; ?></span> Find My Dog's Style</button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ── Long-Haired Dog Grooming ── */
function pz_hero_quickanswer_long_haired_dog_grooming() { ?>
      <div class="pz-hero-quickanswer">
        <strong>Quick answer:</strong> Silky and wooly coats need daily brushing to stay mat-free; long double coats can go every other day if you focus on the feathering areas (ears, legs, tail). Frequent or large mats mean it's time for daily brushing and a professional de-matting session — pulling mats out at home can hurt your dog.
      </div>
<?php }
function pz_hero_trust_long_haired_dog_grooming() { ?>
      <span>✅ Texture-matched routine</span>
      <span>✅ Line-brushing technique</span>
      <span>✅ Mat-safety guidance</span>
<?php }
function pz_methodology_heading_long_haired_dog_grooming() { return 'What Decides Your Long-Haired Dog\'s Maintenance Plan'; }
function pz_methodology_long_haired_dog_grooming() { ?>
    <p style="color:#555;margin-bottom:20px">Long coats aren't all the same — silky, wooly, and long double coats mat at very different speeds and need different brushing techniques. The planner below matches your dog's actual coat texture to a realistic brushing schedule.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🧵</div><strong>Coat Texture</strong><p>Wooly/cottony coats mat the fastest of all long coat types; silky coats mat less but still tangle without daily attention.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🪮</div><strong>Line-Brushing Technique</strong><p>Brushing only the top layer misses mats forming against the skin — sectioning the coat and brushing layer by layer is what actually prevents them.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🪢</div><strong>Mat Frequency</strong><p>Frequent or large mats are a sign the current routine isn't enough, not just bad luck — the interval needs to shorten immediately.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">👩‍⚕️</div><strong>When to Call a Professional</strong><p>Mats pulled tight against the skin can hide irritation or infection underneath, and removing large mats at home risks hurting your dog — that's a groomer's job past a certain point.</p></div>
    </div>
<?php }
function pz_faq_long_haired_dog_grooming() {
    return [
        ["How often should I brush a long-haired dog?", "Silky coats (Yorkies, Maltese) and wooly coats (Poodle mixes, Bichons) both need daily brushing to stay mat-free — wooly coats mat the fastest of any texture. Long double coats (Collies, Golden Retriever feathering) can often go every other day if you focus on the feathering areas."],
        ["What is line-brushing and why does it matter?", "Line-brushing means parting the coat into sections and brushing each layer down to the skin, rather than just brushing over the top. Surface-only brushing leaves mats forming against the skin completely undetected until they're already large."],
        ["Is it okay to cut out a mat myself?", "For small, loose mats, careful at-home work with a mat splitter or comb can be fine. For large or skin-tight mats, it's safer to book a professional de-matting session — mats pulled tight against the skin can hide irritation underneath, and removing them incorrectly can cut or hurt your dog."],
        ["Which direction should I brush my dog's coat?", "Always brush in the direction of hair growth, working in layers from the skin outward. Brushing against the grain or only skimming the top coat feels productive but leaves the undercoat and skin-level tangles completely unaddressed."],
        ["Do long-haired dogs need a detangling spray?", "It helps, especially for silky coats. A light detangling or leave-in spray reduces friction and static, making the comb glide through more easily and reducing hair breakage — apply before brushing, not as a substitute for it."],
    ];
}
function pz_render_guide_long_haired_dog_grooming( $tool ) {
    $icon = $tool['icon'] ?? '🪮';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div><div class="pz-int-label">Long Coat Maintenance Planner</div><div class="pz-int-sublabel">Texture-matched · Free · Instant</div></div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--blue">🔬 Science-Based</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Coat Texture</label>
          <select id="pz_lh_texture" class="pz-int-select">
            <option value="silky">Silky (Yorkie, Maltese, Afghan)</option>
            <option value="wooly">Wooly / Cottony (Poodle-mix, Bichon)</option>
            <option value="double_long">Long Double Coat (Collie, Golden Retriever feathering)</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Current Mat Frequency</label>
          <select id="pz_lh_mats" class="pz-int-select">
            <option value="rare">Rarely gets mats</option>
            <option value="occasional">Occasional small mats</option>
            <option value="frequent">Frequent or large mats</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenLongHairedGrooming()"><span class="pz-int-btn-icon"><?php echo $icon; ?></span> Build My Brushing Plan</button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ── Dog Deshedding ── */
function pz_hero_quickanswer_dog_deshedding() { ?>
      <div class="pz-hero-quickanswer">
        <strong>Quick answer:</strong> The right deshedding tool depends on coat type — a rubber curry brush for short coats, an undercoat rake for double coats, a slicker brush + comb for long coats, and mostly a slicker brush plus regular trims for curly coats (deshedding tools don't work the same way on curls). Match your tool and frequency to your dog's shedding severity below.
      </div>
<?php }
function pz_hero_trust_dog_deshedding() { ?>
      <span>✅ Coat-matched tool pick</span>
      <span>✅ Severity-based frequency</span>
      <span>✅ Safe-technique caution</span>
<?php }
function pz_methodology_heading_dog_deshedding() { return 'What Decides Your Dog\'s Deshedding Tool & Routine'; }
function pz_methodology_dog_deshedding() { ?>
    <p style="color:#555;margin-bottom:20px">Not every deshedding tool works on every coat — a blade built for a double coat can cut a long coat's topcoat, and deshedding tools barely help curly coats at all. The matcher below pairs the right tool with the right coat, then adjusts frequency for how heavily your dog is shedding right now.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🐕</div><strong>Coat Type</strong><p>Double coats need an undercoat rake; long coats need a slicker + comb instead of a blade; curly coats rely more on trims than deshedding tools.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">📊</div><strong>Shedding Severity</strong><p>Light shedders need a weekly pass; heavy shedders need daily attention to keep loose hair off furniture and floors.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🪮</div><strong>Right Tool, Right Coat</strong><p>Using a rake or blade on the wrong coat type is the most common cause of accidental skin nicks and damaged topcoats.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">⚠️</div><strong>Technique Safety</strong><p>Deshedding rakes and blades can nick skin if angled wrong — ask a groomer to demo the correct technique the first time.</p></div>
    </div>
<?php }
function pz_faq_dog_deshedding() {
    return [
        ["What's the best deshedding tool for my dog's coat?", "It depends on coat type: a rubber curry brush or grooming glove works well for short coats, an undercoat rake or deshedding comb for double coats, a slicker brush plus wide-tooth comb for long coats, and a slicker brush for curly coats (deshedding tools are less effective on curls since they don't shed out the same way)."],
        ["How often should I use a deshedding tool?", "It depends on how heavily your dog is shedding right now: about once a week for light shedding, 2–3 times a week for moderate shedding, and daily for heavy shedding until it settles back down."],
        ["Is it safe to use a deshedding rake or blade myself?", "It can be, but rakes and blades can nick skin or damage a single coat if the angle or pressure is wrong. If it's your first time using one, ask a groomer to show you the correct technique before using it at home."],
        ["Why doesn't my curly-coated dog's deshedding tool seem to work?", "Curly and wool coats don't shed out in a cycle the way straight coats do, so deshedding tools have much less to grab onto. A slicker brush plus regular professional trims does more for a curly coat than a deshedding tool ever will."],
        ["Can I use a deshedding blade on a long-haired dog?", "It's not recommended — deshedding blades are built for dense double coats and can cut a long coat's topcoat. Stick with a slicker brush and a wide-tooth comb for long, silky coats instead."],
    ];
}
function pz_render_guide_dog_deshedding( $tool ) {
    $icon = $tool['icon'] ?? '🐕';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div><div class="pz-int-label">Deshedding Tool & Routine Matcher</div><div class="pz-int-sublabel">Coat-matched · Free · Instant</div></div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--blue">🔬 Science-Based</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Coat Type</label>
          <select id="pz_ds_coat" class="pz-int-select">
            <option value="short">Short &amp; Smooth</option>
            <option value="double">Double Coat</option>
            <option value="long">Long &amp; Silky</option>
            <option value="curly">Curly / Wire</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Shedding Severity</label>
          <select id="pz_ds_severity" class="pz-int-select">
            <option value="light">Light — barely notice it</option>
            <option value="moderate" selected>Moderate — regular vacuuming needed</option>
            <option value="heavy">Heavy — hair everywhere daily</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenDeshedding()"><span class="pz-int-btn-icon"><?php echo $icon; ?></span> Match My Deshedding Tool</button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ── Dog Grooming Tools (Kit Builder) ── */
function pz_hero_quickanswer_dog_grooming_tools() { ?>
      <div class="pz-hero-quickanswer">
        <strong>Quick answer:</strong> A basic home grooming kit needs a coat-appropriate brush, nail clippers, and dog shampoo. A standard kit adds ear cleaning solution, a dog toothbrush &amp; toothpaste, and detangling spray. A premium kit adds a clipper/trimmer set, a grooming table or non-slip mat, and a high-velocity dryer. Build your exact checklist below.
      </div>
<?php }
function pz_hero_trust_dog_grooming_tools() { ?>
      <span>✅ Coat-matched brush pick</span>
      <span>✅ Budget-tiered checklist</span>
      <span>✅ Full home-kit ready</span>
<?php }
function pz_methodology_heading_dog_grooming_tools() { return 'What Decides Your Dog\'s Grooming Tool Kit'; }
function pz_methodology_dog_grooming_tools() { ?>
    <p style="color:#555;margin-bottom:20px">A useful grooming kit is built two ways at once — the brush has to match your dog's actual coat, and the rest of the kit scales up with how much you're ready to invest. The checklist below builds tier by tier, so a premium kit still includes every basic essential.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🪮</div><strong>Coat-Matched Brush</strong><p>The single most important item in any kit — the wrong brush type barely helps, regardless of how much it costs.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">💰</div><strong>Budget Tier</strong><p>Basic covers routine upkeep; standard adds hygiene items; premium builds toward a fully self-sufficient home setup.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🧰</div><strong>Home vs Professional Balance</strong><p>Even a premium kit doesn't fully replace a professional groomer for coats that need regular trims, like curly or wire coats.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">✅</div><strong>Tool Quality</strong><p>A handful of well-matched tools used consistently beats a large kit of mismatched or rarely-used ones.</p></div>
    </div>
<?php }
function pz_faq_dog_grooming_tools() {
    return [
        ["What's in a basic dog grooming kit?", "A basic kit covers the essentials: a brush matched to your dog's coat type, nail clippers or a grinder, and a dog-specific shampoo. This is enough for routine at-home maintenance between grooming appointments."],
        ["What should I add to a standard grooming kit?", "On top of the basics, a standard kit adds an ear cleaning solution with cotton balls, a dog toothbrush and dog-safe toothpaste, and a detangling spray — covering the hygiene areas a basic kit skips."],
        ["What do I need for a full premium home grooming setup?", "A premium kit builds on basic and standard with a clipper/trimmer set, a grooming table or non-slip mat to keep your dog steady, and a high-velocity dryer to speed up drying and help release loose undercoat."],
        ["Does the brush really need to match my dog's coat type?", "Yes — a slicker brush does little for a double coat's undercoat, and a deshedding rake can damage a long coat's topcoat. Matching the brush to the coat type matters more than any other item in the kit."],
        ["Can a full home kit fully replace a professional groomer?", "For short and double coats, mostly yes. For curly or wire coats, no — those coats grow continuously and need a professional trim on a schedule regardless of how complete your home kit is."],
    ];
}
function pz_render_guide_dog_grooming_tools( $tool ) {
    $icon = $tool['icon'] ?? '🛒';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div><div class="pz-int-label">Grooming Kit Builder</div><div class="pz-int-sublabel">Coat &amp; budget matched · Free · Instant</div></div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--purple">🎯 Personalized</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Coat Type</label>
          <select id="pz_gt_coat" class="pz-int-select">
            <option value="short">Short &amp; Smooth</option>
            <option value="double">Double Coat</option>
            <option value="long">Long &amp; Silky</option>
            <option value="curly">Curly / Wire</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Budget Level</label>
          <select id="pz_gt_budget" class="pz-int-select">
            <option value="basic">Basic — essentials only</option>
            <option value="standard" selected>Standard — a full home kit</option>
            <option value="premium">Premium — ready for full home grooming</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenGroomingTools()"><span class="pz-int-btn-icon"><?php echo $icon; ?></span> Build My Kit</button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ── Dog Winter Coat Care ── */
function pz_hero_quickanswer_dog_winter_coat_care() { ?>
      <div class="pz-hero-quickanswer">
        <strong>Quick answer:</strong> Winter calls for less frequent bathing, not more — cold air combined with regular baths dries and cracks skin, so stretch your normal bathing interval by about 2 weeks and add a moisturizing conditioner. Dogs with lots of outdoor cold exposure need paw wax and a post-walk rinse to protect against road salt and ice.
      </div>
<?php }
function pz_hero_trust_dog_winter_coat_care() { ?>
      <span>✅ Coat-safe winter care</span>
      <span>✅ Salt &amp; ice paw protection</span>
      <span>✅ Dry-skin relief tips</span>
<?php }
function pz_methodology_heading_dog_winter_coat_care() { return 'What Decides Your Dog\'s Winter Coat Care Plan'; }
function pz_methodology_dog_winter_coat_care() { ?>
    <p style="color:#555;margin-bottom:20px">Winter care isn't just "brush less" — cold air, road salt, and dry indoor heating each create their own risks. The planner below adjusts for all three, plus a coat-specific reminder for double-coated dogs whose undercoat is doing real winter work.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🛁</div><strong>Bathing Interval</strong><p>Cold air plus frequent bathing dries and cracks skin faster than in warmer months — stretching the interval and adding conditioner helps.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🧂</div><strong>Outdoor Cold Exposure</strong><p>Road salt and ice-melt chemicals irritate paw pads and are mildly toxic if licked off — paw wax and rinsing matter more the more time is spent outside.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🏠</div><strong>Indoor Heating</strong><p>Dry indoor air from heating systems can flake and irritate skin just as much as the cold outside.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">❄️</div><strong>Double Coat Insulation</strong><p>A double coat's undercoat is natural winter insulation — shaving or cutting it short in winter removes protection your dog actually needs.</p></div>
    </div>
<?php }
function pz_faq_dog_winter_coat_care() {
    return [
        ["Should I bathe my dog less often in winter?", "Yes — stretch your normal bathing interval by about 2 weeks and use a moisturizing conditioner. Cold air combined with frequent bathing dries out and cracks skin faster than in warmer months."],
        ["How do I protect my dog's paws from road salt and ice?", "Apply a paw wax or balm before walks, and rinse and dry your dog's paws afterward. Road salt and ice-melt chemicals irritate paw pads and are mildly toxic if licked off, so rinsing matters even on short walks."],
        ["Should I shave my double-coated dog's undercoat in winter?", "No — the undercoat is natural winter insulation. Shaving or cutting it short in winter removes the protection your dog needs against the cold, and it doesn't grow back the same way."],
        ["Can indoor heating affect my dog's skin?", "Yes — heating systems dry out indoor air, which can leave skin flaky and irritated the same way cold outdoor air does. A humidifier near your dog's bed or an omega-3 supplement can both help."],
        ["What should I check for after winter walks?", "Check between the toe pads for ice balls, which can be painful and cause limping, especially on long or curly coats where ice clings to the fur more easily. Wipe paws clean of any salt residue too."],
    ];
}
function pz_render_guide_dog_winter_coat_care( $tool ) {
    $icon = $tool['icon'] ?? '❄️';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div><div class="pz-int-label">Winter Coat Care Planner</div><div class="pz-int-sublabel">Season-safe · Free · Instant</div></div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--blue">🔬 Science-Based</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Coat Type</label>
          <select id="pz_wc_coat" class="pz-int-select">
            <option value="short">Short &amp; Smooth</option>
            <option value="double">Double Coat</option>
            <option value="long">Long &amp; Silky</option>
            <option value="curly">Curly / Wire</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Outdoor Time in Cold</label>
          <select id="pz_wc_outdoor" class="pz-int-select">
            <option value="minimal">Minimal — quick bathroom breaks</option>
            <option value="moderate" selected>Moderate — regular walks</option>
            <option value="extensive">Extensive — long walks or outdoor play</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Indoor Heating Dries the Air?</label>
          <select id="pz_wc_heating" class="pz-int-select">
            <option value="no">Not really</option>
            <option value="yes">Yes, air feels dry</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenWinterCoatCare()"><span class="pz-int-btn-icon"><?php echo $icon; ?></span> Build My Winter Care Plan</button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ── Dog Summer Grooming ── */
function pz_hero_quickanswer_dog_summer_grooming() { ?>
      <div class="pz-hero-quickanswer">
        <strong>Quick answer:</strong> Never shave a double coat to cool it down — it doesn't cool the dog effectively, removes UV protection and insulation, and can permanently damage how the coat regrows. Brush more often instead to clear loose undercoat and improve natural airflow. In hot, humid climates watch for hot spots from trapped moisture; with lots of outdoor activity in the heat, test pavement first and know the signs of heatstroke.
      </div>
<?php }
function pz_hero_trust_dog_summer_grooming() { ?>
      <span>✅ No-shave double-coat safe</span>
      <span>✅ Climate-matched plan</span>
      <span>✅ Heatstroke warning signs</span>
<?php }
function pz_methodology_heading_dog_summer_grooming() { return 'What Decides Your Dog\'s Summer Cooling & Grooming Plan'; }
function pz_methodology_dog_summer_grooming() { ?>
    <p style="color:#555;margin-bottom:20px">Summer grooming mistakes are usually about heat, not hygiene — shaving a double coat to "cool it down" is the most common one. The planner below builds a coat-safe, climate-aware routine and flags real heatstroke risk for active dogs in hot weather.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🚫</div><strong>The Shaving Myth</strong><p>Shaving a double coat removes UV protection and insulation without actually cooling the dog — and can cause permanent regrowth damage (clipper alopecia).</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">💧</div><strong>Humidity</strong><p>Hot, humid climates trap moisture against the skin, raising the risk of hot spots — thorough drying after baths and swims matters more.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🏃</div><strong>Activity Level</strong><p>Active dogs in hot climates face real heatstroke risk — pavement heat and exertion combine fast, especially midday.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🚨</div><strong>Heatstroke Signs</strong><p>Excessive panting, drooling, weakness, or collapse mean immediate shade and water, and a vet visit if it doesn't resolve quickly.</p></div>
    </div>
<?php }
function pz_faq_dog_summer_grooming() {
    return [
        ["Should I shave my double-coated dog in summer to keep them cool?", "No. Shaving doesn't cool a double-coated dog effectively — the undercoat actually provides insulation against heat as well as cold, and shaving removes UV protection too. It can also cause permanent damage to how the coat regrows, sometimes called clipper alopecia. Brush more often instead to clear loose undercoat and improve airflow."],
        ["Why does my dog get hot spots in summer?", "Hot, humid weather traps moisture against the skin, especially after baths, swimming, or heavy panting, creating the warm, damp environment bacteria need to cause hot spots. Drying the coat thoroughly after any bath or swim reduces the risk."],
        ["How do I know if pavement is too hot for my dog's paws in summer?", "Press the back of your hand firmly onto the pavement for 5 seconds — if it's too hot for your hand, it's too hot for your dog's paws. Walk in the early morning or evening instead when pavement has cooled."],
        ["What are the warning signs of heatstroke in dogs?", "Watch for excessive panting, drooling, weakness, or collapse. If you see any of these, get your dog to shade and water immediately — if symptoms don't resolve quickly, treat it as a vet emergency."],
        ["Do I need to bathe my dog more often in summer?", "A modestly shorter bathing interval than usual can help, especially for double coats shedding out their undercoat or dogs that swim often. Just make sure the coat is dried thoroughly afterward, particularly in humid climates, to avoid trapping moisture against the skin."],
    ];
}
function pz_render_guide_dog_summer_grooming( $tool ) {
    $icon = $tool['icon'] ?? '☀️';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div><div class="pz-int-label">Summer Cooling & Grooming Planner</div><div class="pz-int-sublabel">Climate-matched · Free · Instant</div></div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--blue">🔬 Science-Based</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Coat Type</label>
          <select id="pz_sg_coat" class="pz-int-select">
            <option value="short">Short &amp; Smooth</option>
            <option value="double">Double Coat</option>
            <option value="long">Long &amp; Silky</option>
            <option value="curly">Curly / Wire</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Climate</label>
          <select id="pz_sg_climate" class="pz-int-select">
            <option value="hot_humid">Hot &amp; Humid</option>
            <option value="hot_dry">Hot &amp; Dry</option>
            <option value="moderate" selected>Moderate Summer</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Outdoor Activity Level</label>
          <select id="pz_sg_activity" class="pz-int-select">
            <option value="low">Mostly indoor/shaded</option>
            <option value="high">Lots of outdoor activity</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenSummerGrooming()"><span class="pz-int-btn-icon"><?php echo $icon; ?></span> Build My Summer Plan</button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ── Dog Mat Removal ── */
function pz_hero_quickanswer_dog_mat_removal() { ?>
      <div class="pz-hero-quickanswer">
        <strong>Quick answer:</strong> Small, coin-sized mats can usually be worked out at home with your fingers and a mat comb. Medium mats need more patience and a detangling spray — if you use scissors, hold them parallel to the skin, never perpendicular. Large mats or a widespread, pelted coat should go to a professional groomer — matted skin can hide infections underneath, and removing it at home risks injuring your dog.
      </div>
<?php }
function pz_hero_trust_dog_mat_removal() { ?>
      <span>✅ Size-based safety check</span>
      <span>✅ DIY vs professional guidance</span>
      <span>✅ Prevention tips included</span>
<?php }
function pz_methodology_heading_dog_mat_removal() { return 'What Decides Whether a Mat Is DIY-Safe'; }
function pz_methodology_dog_mat_removal() { ?>
    <p style="color:#555;margin-bottom:20px">Not all mats are equal — size, location, and how close they sit to the skin decide whether it's a safe five-minute fix or a job for a professional groomer's clippers. The assessor below walks through the same checks a groomer uses before deciding.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card"><div class="pz-methodology-icon">📏</div><strong>Mat Size</strong><p>Small mats loosen easily from the edges inward; large mats are often pelted close to the skin and much harder to remove safely.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">📍</div><strong>Location</strong><p>Ears, legs, and armpits mat against thin, sensitive skin; widespread pelting across the coat is a different problem entirely.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🐕</div><strong>Coat Type</strong><p>Double, long, and curly coats mat far more easily than short coats, and need more frequent brushing to prevent recurrence.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">👩‍⚕️</div><strong>When to Call a Professional</strong><p>Skin tents upward inside a mat, hiding it from view — a professional groomer's clippers can safely remove mats that scissors and combs can't.</p></div>
    </div>
<?php }
function pz_faq_dog_mat_removal() {
    return [
        ["Can I remove my dog's mats myself?", "Small, coin-sized mats can usually be worked out at home — loosen from the edges with your fingers, then use a mat comb or dematting tool over several short sessions. Medium mats are doable too but need more patience and a detangling spray. Large mats or a widespread pelted coat are safer left to a professional groomer."],
        ["Is it safe to cut a mat out with scissors?", "Only with real care. If you use scissors, hold them parallel to the skin, never perpendicular — matted skin often tents upward inside the mat, making it very easy to nick the skin if the scissors point downward toward it."],
        ["Why shouldn't I try to remove large mats at home?", "Pelted coats matted close to the skin can hide skin infections or hot spots underneath that you can't see from the outside. Removing large mats at home risks cutting or injuring your dog — a professional groomer's clippers can safely do what scissors or combs can't."],
        ["How do I stop mats from coming back?", "Prevention comes down to brushing frequency matched to coat type — double, long, and curly coats mat far more easily than short coats and need more frequent brushing to keep mats from forming again, especially in high-friction spots like behind the ears and under the legs."],
        ["Does mat location matter for how I remove it?", "Yes. Mats on the ears, legs, or armpits sit against thinner, more sensitive skin and need extra care even at a small size. Widespread matting across the coat usually points to a brushing routine that needs to change, not just a one-time removal."],
    ];
}
function pz_render_guide_dog_mat_removal( $tool ) {
    $icon = $tool['icon'] ?? '✂️';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div><div class="pz-int-label">Mat Severity Assessor</div><div class="pz-int-sublabel">Safety-first · Free · Instant</div></div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--blue">🔬 Science-Based</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Mat Size</label>
          <select id="pz_mat_size" class="pz-int-select">
            <option value="small">Small — coin-sized or smaller</option>
            <option value="medium" selected>Medium — a few inches</option>
            <option value="large">Large or multiple large mats</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Location</label>
          <select id="pz_mat_location" class="pz-int-select">
            <option value="body">On the body (back, sides)</option>
            <option value="ears_legs">Ears, legs, or armpits</option>
            <option value="widespread">Widespread / pelted coat</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Coat Type</label>
          <select id="pz_mat_coat" class="pz-int-select">
            <option value="short">Short &amp; Smooth</option>
            <option value="double">Double Coat</option>
            <option value="long">Long &amp; Silky</option>
            <option value="curly">Curly / Wire</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenMatRemoval()"><span class="pz-int-btn-icon"><?php echo $icon; ?></span> Assess My Dog's Mats</button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ── Dog Tail Grooming ── */
function pz_hero_quickanswer_dog_tail_grooming() { ?>
      <div class="pz-hero-quickanswer">
        <strong>Quick answer:</strong> Heavy tail feathering (Golden, Setter, Husky-type tails) mats most at the base of the tail and where it touches the ground when sitting — brush that spot more often than the rest of the body. Light-coated tails need little beyond a quick check during your regular brushing sessions.
      </div>
<?php }
function pz_hero_trust_dog_tail_grooming() { ?>
      <span>✅ Density-matched routine</span>
      <span>✅ Base-of-tail mat prevention</span>
      <span>✅ Hygiene check included</span>
<?php }
function pz_methodology_heading_dog_tail_grooming() { return 'What Decides Your Dog\'s Tail Coat Care'; }
function pz_methodology_dog_tail_grooming() { ?>
    <p style="color:#555;margin-bottom:20px">The tail is easy to overlook during a regular brushing session, but heavy feathering mats at the base faster than almost anywhere else on the body. The planner below adjusts specifically for how much feathering your dog's tail carries.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🪶</div><strong>Feathering Density</strong><p>Heavy plumes (Golden, Setter, Husky-type tails) mat far more easily than a light, close coat.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">📍</div><strong>Base-of-Tail Friction</strong><p>Where the tail touches the ground when sitting takes constant friction — a hotspot for mats that the rest of the body doesn't get.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🧼</div><strong>Hygiene Area Check</strong><p>Fur just under the tail can trap tangles or debris, especially after a loose-stool episode — worth a specific check, not just a brush pass.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🪮</div><strong>Coat Type</strong><p>Coat type still sets the baseline brushing routine — the tail simply needs extra attention layered on top of it.</p></div>
    </div>
<?php }
function pz_faq_dog_tail_grooming() {
    return [
        ["Why does my dog's tail mat more than the rest of their body?", "Heavy feathering (like on a Golden Retriever, Setter, or Husky-type tail) mats faster because of friction where the tail touches the ground when sitting, plus the density of the plume itself. That spot at the base of the tail needs brushing more often than the rest of the body."],
        ["How often should I brush my dog's tail?", "It depends on feathering density — heavy plumes benefit from brushing the base of the tail more frequently than your normal body-brushing schedule, even if the rest of the coat is on a longer interval. Light-coated tails just need a quick check during regular sessions."],
        ["What should I check for under my dog's tail?", "Check the fur just under the tail, near the anus, for tangles or trapped debris — this matters even more after a loose-stool episode, since trapped debris there can cause skin irritation if left unaddressed."],
        ["Do short-coated dogs need special tail care?", "Not really — a light, close coat has minimal mat risk at the tail, so a quick check during your regular brushing session is enough. There's no need for a separate tail-specific routine."],
        ["Can a matted tail base cause skin problems?", "Yes — like matting anywhere else, a mat pulled tight at the base of the tail can irritate or hide irritated skin underneath. Checking and brushing that spot regularly, especially on heavily feathered tails, helps catch it before it becomes a bigger mat."],
    ];
}
function pz_render_guide_dog_tail_grooming( $tool ) {
    $icon = $tool['icon'] ?? '🐕';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div><div class="pz-int-label">Tail Coat Care Planner</div><div class="pz-int-sublabel">Density-matched · Free · Instant</div></div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--blue">🔬 Science-Based</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Coat Type</label>
          <select id="pz_tail_coat" class="pz-int-select">
            <option value="short">Short &amp; Smooth</option>
            <option value="double">Double Coat</option>
            <option value="long">Long &amp; Silky</option>
            <option value="curly">Curly / Wire</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Tail Coat Density</label>
          <select id="pz_tail_density" class="pz-int-select">
            <option value="light">Light coat, minimal feathering</option>
            <option value="heavy">Heavy feathering/plume (Golden, Setter, Husky-type tails)</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenTailGrooming()"><span class="pz-int-btn-icon"><?php echo $icon; ?></span> Build My Tail Care Plan</button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ── Professional vs Home Grooming ── */
function pz_hero_quickanswer_pro_vs_home_grooming() { ?>
      <div class="pz-hero-quickanswer">
        <strong>Quick answer:</strong> Short coats are the most fully DIY-able. Curly and long coats have higher "professional dependency" — they need periodic professional trims or deshedding no matter how much home effort goes in. With under 30 minutes a week and a curly or long coat, professional (or a budget-conscious hybrid) usually wins; with an hour or more a week, mostly-home care is the cheapest long-term option.
      </div>
<?php }
function pz_hero_trust_pro_vs_home_grooming() { ?>
      <span>✅ Time &amp; budget matched</span>
      <span>✅ Coat-dependency aware</span>
      <span>✅ Annual cost comparison</span>
<?php }
function pz_methodology_heading_pro_vs_home_grooming() { return 'What Decides Home vs Professional Grooming for Your Dog'; }
function pz_methodology_pro_vs_home_grooming() { ?>
    <p style="color:#555;margin-bottom:20px">This isn't a strict formula — it's a genuine trade-off between how much "professional dependency" your dog's coat has, how much time you realistically have each week, and how you'd rather spend your budget. The comparison below weighs all three together.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card"><div class="pz-methodology-icon">🐕</div><strong>Coat Dependency</strong><p>Curly and long coats need periodic professional attention regardless of home effort; short coats are the most fully DIY-able of all.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">⏱️</div><strong>Time Available</strong><p>Under 30 minutes a week limits what's realistic at home, especially for higher-maintenance coats; an hour or more opens up mostly-home care.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">💰</div><strong>Budget Comfort</strong><p>A tight budget shifts the recommendation toward hybrid care, where a good coat-appropriate brush is the single best investment either way.</p></div>
      <div class="pz-methodology-card"><div class="pz-methodology-icon">📊</div><strong>Total Cost of Ownership</strong><p>Home care has a mostly one-time tool cost; professional grooming is a recurring annual cost; hybrid blends the two.</p></div>
    </div>
<?php }
function pz_faq_pro_vs_home_grooming() {
    return [
        ["Is it cheaper to groom my dog at home or professionally?", "Home care is cheaper long-term — mostly a one-time tool cost of roughly $50–150 plus ongoing shampoo and supplies, versus $480–1,200/year for professional grooming depending on frequency. A hybrid approach lands in between, roughly $200–500/year."],
        ["Which coat types need a professional groomer the most?", "Curly and long coats have the highest professional dependency — they need periodic professional trims or deshedding regardless of how much home effort goes in. Short coats are the most fully DIY-able, and double coats are DIY-able for brushing but benefit from an occasional professional deshedding session."],
        ["How much time does home grooming actually take per week?", "It depends on coat type, but a rough guide is under 30 minutes a week for low-maintenance coats and 30–60+ minutes a week for higher-maintenance long or curly coats. If you can't realistically hit that, leaning more professional or hybrid makes sense."],
        ["What is a hybrid grooming approach?", "Hybrid means mixing home maintenance — regular brushing and bathing — with periodic professional visits for trims, deshedding, or nail care. It's often the most balanced option for moderate time and budget, roughly $200–500/year."],
        ["Can I do all my dog's grooming at home if I have the time?", "For short and double coats, yes, mostly. For curly or long coats, even with an hour or more a week, most owners still book occasional professional visits for a trim, deshedding, or nail care — the coat itself sets a floor on professional need."],
    ];
}
function pz_render_guide_pro_vs_home_grooming( $tool ) {
    $icon = $tool['icon'] ?? '⚖️';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div><div class="pz-int-label">Professional vs Home: Cost &amp; Time Comparison</div><div class="pz-int-sublabel">Personalized · Free · Instant</div></div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--purple">🎯 Personalized</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Coat Type</label>
          <select id="pz_pvh_coat" class="pz-int-select">
            <option value="short">Short &amp; Smooth</option>
            <option value="double">Double Coat</option>
            <option value="long">Long &amp; Silky</option>
            <option value="curly">Curly / Wire</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">DIY Time Available Per Week</label>
          <select id="pz_pvh_time" class="pz-int-select">
            <option value="low">Under 30 min/week</option>
            <option value="medium" selected>30–60 min/week</option>
            <option value="high">1+ hour/week</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Budget Comfort for Grooming</label>
          <select id="pz_pvh_budget" class="pz-int-select">
            <option value="low">Prefer to minimize cost</option>
            <option value="medium" selected>Moderate budget is fine</option>
            <option value="high">Budget isn't the main concern</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenProVsHome()"><span class="pz-int-btn-icon"><?php echo $icon; ?></span> Compare My Options</button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ── Dog Bathing Frequency — What Is / Why / Steps / Tips / Mistakes ── */

function pz_what_is_dog_bathing_frequency() {
    ob_start(); ?>
    <p>The Dog Bathing Frequency Calculator tells you how often to bathe your dog by starting from your dog's coat-type baseline — short, double, long/silky, curly/wire, or hairless — and then adjusting that baseline for activity level, season, skin condition, and age. Rather than guessing between a bath every week and a bath every two months, you get a specific weeks-between-baths range built the same way a groomer scopes out a new client's coat.</p>
    <p>Getting bathing frequency wrong runs in both directions, and neither is harmless. Bathe too often and you strip the natural oils that keep your dog's skin barrier intact, leading to dry, flaky, itchy skin and — over time — irritation that can look enough like an allergy to send you to the vet unnecessarily. Wait too long between baths and dirt, dander, and allergens build up in the coat, odor sets in, and loose undercoat mats into the topcoat, especially around the ears, armpits, and hindquarters where friction is highest.</p>
    <p>Run the calculator above to get your dog's exact range and shampoo amount, then scroll down for the reasoning behind each adjustment and the FAQ, which answers the specific bathing questions dog owners search for most — including puppy bathing, seasonal changes, and how much shampoo to actually use.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_bathing_frequency() {
    ob_start(); ?>
    <p>Bathing frequency isn't a one-size-fits-all number — get it wrong and you either damage your dog's skin or let dirt and allergens build up. Here's what actually changes the right answer for your dog:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🧴</span>
        <div>
          <strong>Skin Barrier Health</strong>
          <p>Bathing too often strips the natural oils your dog's skin needs to stay protected, which is one of the most common causes of dry, flaky, itchy skin that owners mistake for an allergy.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🐕‍🦺</span>
        <div>
          <strong>Coat-Specific Needs</strong>
          <p>Double-coated breeds like Huskies and Golden Retrievers hold protective oils in their undercoat that frequent washing removes — they typically need far fewer baths than a short-coated dog.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💰</span>
        <div>
          <strong>Cost Savings</strong>
          <p>Knowing the right shampoo amount for your dog's weight avoids waste, and keeping bathing frequency in the right range reduces skin-irritation vet visits caused by over-bathing.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🌦️</span>
        <div>
          <strong>Seasonal Awareness</strong>
          <p>A muddy, humid summer and a dry, cold winter call for different bathing intervals — the calculator adjusts for both so your schedule doesn't stay static year-round.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_bathing_frequency() {
    return [
        ['title'=>"Identify Your Dog's Coat Type", 'desc'=>"Search your dog's breed in the tool above or pick a coat type manually — short, double, long/silky, curly/wire, or hairless. This sets the baseline the rest of the calculator adjusts from."],
        ['title'=>'Enter Lifestyle, Season, Skin, and Age', 'desc'=>"Tell the calculator how active and muddy your dog's routine is, the current season, any skin sensitivity, and their age bracket. Each of these shifts the baseline up or down."],
        ['title'=>'Get Your Weeks Range and Shampoo Dosage', 'desc'=>"You'll get a specific bathing interval — for example, every 4-6 weeks — plus a shampoo dosage estimate based on your dog's weight, so you're not over- or under-applying product."],
        ['title'=>'Set Your Last Bath Date', 'desc'=>"Enter the date of your dog's most recent bath and the calculator tells you the exact next-due date, so you're not relying on memory or a rough guess."],
        ['title'=>'Add a Calendar Reminder', 'desc'=>"Put the next-due date in your phone or household calendar. This is the single easiest way to actually stick to a frequency instead of drifting back to guesswork."],
        ['title'=>'Recheck Each Season Change', 'desc'=>"Rerun the calculator when the season shifts or your dog's activity level changes significantly — a dog that goes from daily park visits to mostly-indoor winter days needs a different interval."],
    ];
}

function pz_tips_dog_bathing_frequency() {
    return [
        ['Brush Before, Not After', "Give your dog a thorough shedding brush-out before bath day, not after — wet loose hair mats and tangles much more easily than dry hair."],
        ['Lukewarm Water Only', "Hot water feels good to us but dries out and irritates dog skin. Stick to lukewarm water for the whole bath, including the rinse."],
        ['Rinse Until the Water Runs Clear', "Leftover shampoo residue is one of the most common causes of post-bath itching. Keep rinsing past the point where the coat looks clean."],
        ['Dry Fully, Especially Skin Folds', "Trapped moisture in a double coat's undercoat or in skin folds breeds bacteria and yeast. Towel-dry thoroughly and use a dryer on low heat if your dog tolerates it."],
        ['Patch-Test a New Shampoo', "Before using a new shampoo across the whole body, apply a small amount to one patch of skin and wait 24 hours to check for a reaction."],
    ];
}

function pz_mistakes_dog_bathing_frequency() {
    return [
        ['❌ Bathing on a Fixed Weekly Schedule', "A calendar-based weekly bath ignores coat type, season, and skin condition entirely — it's one of the fastest ways to over-bathe and strip protective oils regardless of what your dog actually needs."],
        ['❌ Using Human Shampoo', "Human skin sits around pH 5.5; dog skin is closer to pH 7.5. Human shampoo disrupts that balance and leaves skin dry, irritated, and more prone to infection."],
        ['❌ Not Rinsing Thoroughly', "Shampoo left in the coat continues to irritate skin long after the bath is over. Rinse well past the point it looks clean, especially in dense or double coats."],
        ['❌ Letting Water Get in the Ears', "Water trapped in the ear canal creates a warm, moist environment that promotes infection, especially in floppy-eared breeds. Use cotton balls loosely in the outer ear or tilt the head back during rinsing."],
        ['❌ Over-Bathing an Itchy or Anxious Dog', "It feels intuitive to wash an itchy dog more, but frequent bathing usually worsens itching by stripping the oils that protect the skin barrier — a vet visit to find the actual cause is more effective."],
    ];
}

/* ── Dog Grooming Schedule — What Is / Why / Steps / Tips / Mistakes ── */

function pz_what_is_dog_grooming_schedule() {
    ob_start(); ?>
    <p>The Dog Grooming Schedule Calculator builds a single master calendar covering all five core grooming routines — brushing, bathing, nail trims, ear checks, and teeth brushing — based on your dog's coat type, size, ear shape, and lifestyle. Instead of tracking five separate routines in your head, you get one combined schedule with a specific interval for each.</p>
    <p>Without a consolidated schedule, routines fall through the cracks in a predictable order: nail trims get forgotten until you hear clicking on the floor, and ear checks get skipped until there's already a smell or your dog is shaking their head — at which point what would have been a two-minute check has become a vet visit. The routines that get remembered are the ones with a schedule attached to them; the ones that don't have a schedule are the ones that get neglected.</p>
    <p>Fill in your dog's details above to generate your five-part calendar, then scroll down for the reasoning behind each interval and the FAQ covering the questions owners most often ask about balancing multiple grooming routines.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_grooming_schedule() {
    ob_start(); ?>
    <p>Most dogs don't have one grooming need — they have five running on different clocks. Here's why tracking them together matters:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🗂️</span>
        <div>
          <strong>Consolidation</strong>
          <p>Brushing, bathing, nails, ears, and teeth each run on a different interval. One combined calendar replaces five separate mental trackers you'd otherwise have to keep straight.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🐾</span>
        <div>
          <strong>Coat- and Lifestyle-Aware</strong>
          <p>A short-haired indoor dog and a double-coated dog that swims daily need genuinely different schedules — this isn't a single national-average routine stretched across every dog.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⚠️</span>
        <div>
          <strong>Prevents "Cascade Neglect"</strong>
          <p>When one routine gets skipped, the others tend to slip too — a missed brushing session often means a missed nail check the same week. A single schedule interrupts that pattern.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">👨‍👩‍👧</span>
        <div>
          <strong>Shareable With Family or Pet-Sitters</strong>
          <p>A written five-part schedule is something you can hand to a partner, family member, or pet-sitter so grooming doesn't lapse just because you're not the one home that week.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_grooming_schedule() {
    return [
        ['title'=>"Select Your Dog's Coat Type", 'desc'=>"Choose the coat type that matches your dog — this drives the brushing and bathing intervals, since coat density and length are the biggest factors in both."],
        ['title'=>'Select Breed Size', 'desc'=>"Pick your dog's size category. Larger dogs generally need more frequent nail trims since more weight lands on each nail during walking."],
        ['title'=>'Select Ear Type', 'desc'=>"Floppy ears trap moisture and airflow differently than upright ears, which changes how often ear checks should happen."],
        ['title'=>'Select Lifestyle', 'desc'=>"Tell the calculator how active, muddy, or water-exposed your dog's routine typically is — this shifts bathing and ear-check intervals together."],
        ['title'=>"Get Your Five-Part Calendar", 'desc'=>"You'll receive a combined schedule listing the recommended interval for brushing, bathing, nail trims, ear checks, and teeth brushing side by side."],
        ['title'=>'Set Reminders for Each Interval', 'desc'=>"Add each of the five intervals to your calendar app separately, since they don't share the same frequency — a single reminder won't cover all five."],
    ];
}

function pz_tips_dog_grooming_schedule() {
    return [
        ['Pair Nail Trims With a Treat', "Nail trims are the most-resisted routine for most dogs. Keeping treats on hand specifically for trim sessions builds a positive association that makes each session easier than the last."],
        ['Check Ears During Bath Time', "You're already handling your dog's head and face during a bath — use that moment to do a quick ear check rather than treating it as a separate task."],
        ['Brush Before Bathing, Not After', "Brushing out tangles before a bath prevents mats from tightening when the coat gets wet, which is much harder to undo afterward."],
        ['Use a Simple Wall Calendar or App', "With five routines running on different clocks, a shared wall calendar or phone app keeps the schedule visible to everyone in the household, not just the person who set it up."],
        ['Redo the Calculator Each Season', "Activity level and coat needs shift with the seasons — rerun the calculator when the weather changes rather than assuming last season's schedule still fits."],
    ];
}

function pz_mistakes_dog_grooming_schedule() {
    return [
        ['❌ Doing All Five Routines the Same Day', "Bundling brushing, bathing, nails, ears, and teeth into one long session overwhelms most dogs and makes the whole experience something they start to dread. Spread routines across the week instead."],
        ['❌ Skipping Ear Checks Because There\'s No Smell Yet', "Early-stage ear infections are often symptom-free — by the time there's an odor, the infection has already progressed. Checks need to happen on schedule, not in response to a smell."],
        ['❌ Using a Generic National-Average Schedule', "A schedule built for an \"average dog\" ignores your specific dog's coat, size, and ear type — the intervals that matter are the ones adjusted to your dog, not a general estimate."],
        ['❌ Letting Nail Trims Lapse the Longest', "Nails are the easiest routine to forget because overgrowth is gradual and easy to not notice day to day — it's consistently the most-neglected of the five routines."],
        ['❌ Not Adjusting as a Puppy Grows Into Its Adult Coat', "A puppy's coat and needs change substantially in the first year. A schedule set once at 4 months old won't fit the same dog at 14 months — recheck as they mature."],
    ];
}

/* ── Dog Nail Trimming — What Is / Why / Steps / Tips / Mistakes ── */

function pz_what_is_dog_nail_trimming() {
    ob_start(); ?>
    <p>The Dog Nail Trimming Guide calculates how often your dog needs a nail trim using two concrete signals: the surface your dog walks on most (which naturally wears nails down at different rates) and the click test — whether you can hear nails clicking on a hard floor. Combining both gives a far more accurate interval than a flat "trim every month" rule.</p>
    <p>Nail trimming has real risk in both directions. Overgrown nails push against the ground with every step, forcing the toe joint out of its natural alignment — over months this changes how your dog stands and walks, adding stress to the joints and sometimes causing the toes to splay outward. Trim too aggressively or too often, on the other hand, and you risk cutting into the quick — the nerve and blood vessel inside the nail — which is painful, bleeds, and can make a dog nail-shy for months afterward.</p>
    <p>Use the assessment above to get your dog's exact trim interval, then scroll down for technique guidance and the FAQ covering the questions dog owners ask most about trimming safely.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_nail_trimming() {
    ob_start(); ?>
    <p>Nail length affects more than appearance — it changes how your dog stands, walks, and feels day to day. Here's what's actually at stake:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🦴</span>
        <div>
          <strong>Posture and Joint Health</strong>
          <p>Overgrown nails push against the ground with every step, forcing toe joints out of their natural alignment. Over months this changes gait and adds ongoing stress to the joints.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">😖</span>
        <div>
          <strong>Pain Prevention — Both Directions</strong>
          <p>Nails left too long become painful to walk on, but nails trimmed too aggressively risk cutting the quick — the goal is a schedule that avoids both, not just the overgrowth side.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🩹</span>
        <div>
          <strong>Injury Reduction</strong>
          <p>Long nails catch on carpet, fabric, and uneven ground far more easily than properly trimmed ones, and a caught nail can tear partway off — a painful injury that's entirely preventable.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🤝</span>
        <div>
          <strong>Builds Lasting Trust</strong>
          <p>A properly-paced trimming schedule — not rushed, not painful — keeps most dogs cooperative for life. Dogs that associate trims with pain become nail-shy and fight every session afterward.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_nail_trimming() {
    return [
        ['title'=>'Assess Surface and Run the Click Test', 'desc'=>"Note what surface your dog walks on most (pavement wears nails down faster than grass or carpet) and check whether you can hear clicking when they walk on a hard floor."],
        ['title'=>'Get Your Weeks Range', 'desc'=>"Based on surface and click-test results, you'll get a specific trim interval — dogs on soft surfaces with audible clicking generally need more frequent trims than dogs that self-wear on pavement."],
        ['title'=>'Gather Your Tools', 'desc'=>"Have a proper dog nail clipper or grinder ready, along with styptic powder on hand in case you nick the quick. Trying to trim without styptic powder nearby is a common reason sessions turn stressful."],
        ['title'=>'Trim in a Calm, Well-Lit Setting', 'desc'=>"Take small amounts off at a time rather than one large cut, especially on dark nails where the quick isn't visible. Good lighting matters more than people expect."],
        ['title'=>'Reward After Each Paw', 'desc'=>"Rather than waiting until the whole session is done, reward your dog after each paw is finished — this keeps a fidgety or anxious dog engaged through the full trim."],
        ['title'=>'Log the Date and Set a Reminder', 'desc'=>"Record the trim date and set a reminder for your dog's specific interval, so the next trim happens on schedule rather than whenever you notice the clicking again."],
    ];
}

function pz_tips_dog_nail_trimming() {
    return [
        ['Trim After a Walk', "Nails are slightly softer and easier to cut cleanly right after a walk, compared to trimming cold."],
        ['Use a Grinder for Anxious Dogs', "A grinder removes the sudden \"snap\" sensation of a clipper, which is often what triggers anxiety in nail-shy dogs — many dogs tolerate grinding far better than clipping."],
        ['Split Stressed Sessions Into 2-3 Nails at a Time', "If your dog gets visibly stressed, trim 2-3 nails in a short session rather than forcing all of them at once — you can finish the rest later the same day or the next."],
        ['Keep Styptic Powder Within Reach', "Have styptic powder open and accessible before you start, not stored away — if you nick the quick, you need to stop the bleeding within seconds, not after searching a cabinet."],
        ['Check the Dewclaws Every Session', "Dewclaws don't touch the ground, so they never self-wear and are easy to forget — check and trim them at every session, not just occasionally."],
    ];
}

function pz_mistakes_dog_nail_trimming() {
    return [
        ['❌ Waiting for the Click Sound as the Only Signal', "By the time you can consistently hear clicking on hard floors, nails are usually already past the ideal trim point — early overgrowth isn't audible yet, which is why the surface-based interval matters more than waiting for a sound."],
        ['❌ Trimming All Nails in One Long Session', "Forcing a full 18-nail session on a dog that's getting stressed teaches them to dread trimming. Shorter, calmer sessions build cooperation; long forced ones erode it."],
        ['❌ Using Human Nail Clippers', "Human clippers are built for a flat nail shape and crush a dog's rounder, denser nail rather than cutting it cleanly — this crushing action is more likely to cause pain and splitting."],
        ['❌ Cutting Straight Across Thick Nails', "A straight cut across a thick nail concentrates pressure and increases the chance of splitting. A slight angled cut, following the nail's natural curve, is cleaner and safer."],
        ['❌ Skipping Dewclaws Entirely', "Because dewclaws don't touch the ground, they're easy to forget — but left untrimmed, they can curl and grow into the paw pad, which is both painful and easy to prevent."],
    ];
}

/* ── Dog Shedding — What Is / Why / Steps / Tips / Mistakes ── */

function pz_what_is_dog_shedding() {
    ob_start(); ?>
    <p>The Dog Shedding Guide estimates how often to brush your dog based on coat type and current season, since both determine how quickly loose hair builds up in the coat. It's built around a simple principle: shedding itself is a normal hair growth cycle, not a problem to solve — brushing frequency is what actually needs adjusting.</p>
    <p>Under-brushing lets loose undercoat build up against the skin, where it traps moisture and creates the conditions for mats and hot spots — localized areas of irritated, inflamed skin that can become infected if left untreated. On the other side, some owners over-worry about shedding itself, treating a normal seasonal coat-blow as if something's wrong, when in most cases the coat is simply doing what it's supposed to do and just needs more frequent brushing to manage the volume.</p>
    <p>Enter your dog's coat type and current season above to get your brushing frequency and tool recommendation, then scroll down for technique tips and the FAQ answering the shedding questions dog owners search for most.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_shedding() {
    ob_start(); ?>
    <p>Shedding is normal, but how you manage it changes both your dog's skin health and your home. Here's what to know:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🩹</span>
        <div>
          <strong>Skin Health</strong>
          <p>Loose undercoat trapped against the skin holds moisture and can lead to irritation and hot spots — regular brushing removes it before it becomes a skin problem, not just a mess problem.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🧹</span>
        <div>
          <strong>Home Cleanliness</strong>
          <p>Proactive brushing on a schedule keeps loose hair contained to a brush and a low-traffic area, which beats reactive vacuuming after hair has already spread through the house.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🔍</span>
        <div>
          <strong>Normal vs. Abnormal Shedding</strong>
          <p>Knowing your dog's typical seasonal shedding pattern makes it easier to notice when something's actually different — a sudden change in pattern, texture, or bald patches can be an early signal worth a vet visit.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">❤️</span>
        <div>
          <strong>Bonding Time</strong>
          <p>Regular brushing is one of the easiest routines to turn into a calm, trust-building ritual — most dogs come to genuinely enjoy it once it's a predictable part of their week.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_shedding() {
    return [
        ['title'=>'Identify Breed and Coat Type', 'desc'=>"Determine your dog's coat type — this is the single biggest factor in how much they shed and how often they need brushing."],
        ['title'=>'Note the Current Season', 'desc'=>"Tell the tool what season it currently is where you live — shedding volume changes significantly during seasonal coat-blow windows, especially for double-coated breeds."],
        ['title'=>'Get Your Brushing Frequency and Tool Recommendation', 'desc'=>"You'll receive a specific brushing interval along with the tool type best suited to your dog's coat — slicker brush, undercoat rake, or deshedding tool."],
        ['title'=>'Brush in a Low-Traffic Area', 'desc'=>"Set up wherever hair flying around won't be a problem — outdoors, a garage, or a bathroom with a door that closes. This step reliably gets messy."],
        ['title'=>'Increase Frequency During Coat-Blow Windows', 'desc'=>"Spring and fall coat-blow periods for double-coated breeds call for daily or near-daily brushing temporarily, well above the normal baseline."],
        ['title'=>'Watch for Bald Patches or Abnormal Shedding', 'desc'=>"If you notice bald patches, uneven shedding, or hair loss well outside the normal seasonal pattern, that's a signal to check with your vet rather than just brushing more."],
    ];
}

function pz_tips_dog_shedding() {
    return [
        ['Brush Before Bathing, Not After', "Loose hair and tangles mat more tightly once wet — brushing first prevents that and makes the bath itself go faster."],
        ['Work in Layers for Double Coats', "A surface-only pass misses the undercoat, which is where most of the shedding volume actually is. Part the coat in sections and brush down to the skin."],
        ['Use a Vacuum With a Pet-Hair Attachment During Peak Season', "During coat-blow windows, a dedicated pet-hair vacuum attachment saves real time compared to a standard attachment or broom."],
        ['Support Coat Health With Omega-3s', "Omega-3 fatty acids in the diet support skin and coat health, which can reduce excessive shedding tied to dry skin — ask your vet about an appropriate supplement or food."],
        ['Dry a Wet Double Coat Partially Before Slicker-Brushing', "Brushing a fully wet double coat with only a slicker brush can miss tangles in the dense undercoat — towel- or partially blow-dry first, then brush."],
    ];
}

function pz_mistakes_dog_shedding() {
    return [
        ['❌ Shaving to "Reduce" Shedding', "Shaving a double coat doesn't reduce shedding and can permanently damage how the coat regrows, sometimes resulting in a patchy, uneven coat that no longer insulates properly."],
        ['❌ Using a Human Hairbrush', "Human hairbrushes have the wrong bristle spacing and density for dog coats — they miss the undercoat entirely and can be uncomfortable for your dog to sit through."],
        ['❌ Brushing Only the Visible Topcoat', "The bulk of shedding volume comes from the undercoat, not the topcoat. A brush that only skims the surface leaves the actual source of the mess untouched."],
        ['❌ Assuming a Groomer "Handles It"', "Professional grooming appointments happen every 6-8 weeks at most — without brushing at home in between, loose hair and mats build up well before the next appointment."],
        ['❌ Panicking at Normal Seasonal Coat-Blow', "A heavy shed during a seasonal coat-blow window is normal, not a sign of illness — the response is more frequent brushing, not concern, unless it comes with bald patches or skin changes."],
    ];
}

/* ── Dog Ear Cleaning — What Is / Why / Steps / Tips / Mistakes ── */

function pz_what_is_dog_ear_cleaning() {
    ob_start(); ?>
    <p>The Dog Ear Cleaning Guide calculates how often to clean your dog's ears based on ear shape and risk factors like water exposure and past infection history. Ear shape alone changes airflow and moisture retention enough that a floppy-eared dog and an upright-eared dog can need meaningfully different cleaning schedules.</p>
    <p>Getting the frequency wrong carries real cost either way. Under-cleaning lets moisture, wax, and debris build up in the ear canal — conditions that floppy-eared breeds in particular are prone to turning into infection, since their ear shape restricts airflow. Over-cleaning, on the other hand, irritates the delicate skin of the ear canal and disrupts the ear's healthy natural flora, which can actually increase infection risk rather than prevent it.</p>
    <p>Use the tool above to get your dog's cleaning frequency, then scroll down for technique guidance and the FAQ covering the ear care questions dog owners ask most often.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_ear_cleaning() {
    ob_start(); ?>
    <p>Ear infections are one of the most common — and most preventable — reasons dogs end up at the vet. Here's why the right cleaning frequency matters:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🦻</span>
        <div>
          <strong>Infection Prevention</strong>
          <p>Ear infections are among the most common reasons floppy-eared breeds visit the vet. A cleaning schedule matched to ear shape and risk factors is the most effective prevention available.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">😣</span>
        <div>
          <strong>Pain Avoidance</strong>
          <p>Ear infections aren't just itchy — they're notably painful, often affecting balance and appetite by the time they're advanced. Prevention avoids that level of discomfort entirely.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💰</span>
        <div>
          <strong>Cost Savings</strong>
          <p>Chronic or recurring ear infections require repeat vet visits, medication, and sometimes specialist referral — all of which cost far more over time than routine preventive cleaning.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🔍</span>
        <div>
          <strong>Early Detection Habit</strong>
          <p>Regular scheduled checks catch a developing problem within days of it starting, rather than weeks later once odor or visible redness has already set in.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_ear_cleaning() {
    return [
        ['title'=>'Identify Ear Shape', 'desc'=>"Select your dog's ear shape — floppy, upright, or semi-erect. This is the single biggest factor in how much airflow reaches the ear canal."],
        ['title'=>'Note Water Exposure and Infection History', 'desc'=>"Tell the tool whether your dog swims regularly and whether they've had ear infections before — both meaningfully raise the recommended cleaning frequency."],
        ['title'=>'Get Your Check and Clean Frequency', 'desc'=>"You'll receive two numbers: how often to do a quick check, and how often to do a full clean — these aren't always the same interval."],
        ['title'=>'Use a Vet-Formulated Solution and Cotton-Ball Technique', 'desc'=>"Apply a vet-formulated ear cleaning solution and wipe the visible ear canal with a cotton ball — never a cotton swab, which pushes debris deeper rather than removing it."],
        ['title'=>'Let Your Dog Shake After Application', 'desc'=>"Letting your dog shake their head after applying solution helps work debris up and out of the canal naturally before you wipe."],
        ['title'=>'Watch for Odor or Redness Between Cleanings', 'desc'=>"A noticeable odor, redness, or head-shaking between scheduled cleanings is worth checking regardless of where you are in the schedule — don't wait for the next cleaning date."],
    ];
}

function pz_tips_dog_ear_cleaning() {
    return [
        ['Never Use Cotton Swabs', "Cotton swabs push wax and debris deeper into the ear canal instead of removing them, and risk injuring the eardrum. Stick to cotton balls or gauze on the visible outer portion only."],
        ['Dry Ears Fully After Swimming', "Trapped moisture after swimming is one of the biggest infection triggers for floppy-eared dogs. Dry the outer ear thoroughly before it has a chance to sit."],
        ["Learn Your Dog's Normal Ear Smell", "A quick sniff-check before cleaning helps you learn what's normal for your dog specifically, so you notice faster when something's off."],
        ['Warm the Solution Slightly', "Cold cleaning solution straight from storage can startle a dog and make them head-shy about the whole process. Warming it slightly (body temperature) makes application go more smoothly."],
        ['Make It a Two-Person Job at First', "For wriggly or nervous dogs, having one person hold and reassure while the other applies solution makes the first several sessions far less stressful for everyone."],
    ];
}

function pz_mistakes_dog_ear_cleaning() {
    return [
        ['❌ Cleaning Too Aggressively or Frequently', "Over-cleaning out of caution disrupts the ear's protective natural flora and irritates the delicate canal skin — it can increase infection risk rather than lower it."],
        ['❌ Using Water Alone Instead of a Cleanser', "Plain water doesn't break down wax and debris the way a proper cleanser does, and can leave residual moisture behind that actually promotes infection."],
        ['❌ Dismissing a Single Head-Shake Episode', "One head shake can be nothing, but it's also often the earliest visible sign of irritation or infection — worth a quick check rather than an automatic dismissal."],
        ['❌ Using Human Ear Drops', "Human ear products aren't formulated for a dog's ear pH or canal structure and can cause irritation. Only use products labeled for veterinary use."],
        ['❌ Skipping Ear Checks on Upright-Eared Breeds', "Better airflow lowers infection risk for upright-eared dogs, but it doesn't eliminate it — skipping checks entirely on the assumption of immunity means problems get caught later than they should."],
    ];
}

/* ── Dog Teeth Brushing — What Is / Why / Steps / Tips / Mistakes ── */

function pz_what_is_dog_teeth_brushing() {
    ob_start(); ?>
    <p>The Dog Teeth Brushing Guide builds a personalized ramp-up plan based on your dog's current brushing frequency, age, and visible tartar level — moving gradually from wherever you're starting toward a daily brushing habit, rather than expecting a dog with no brushing history to tolerate a full routine on day one.</p>
    <p>The stakes here are higher than they seem: over 80% of dogs show signs of dental disease by age 3. Left unaddressed, that starts as painful gum infection and progresses to tooth loss — and the bacteria involved don't stay contained to the mouth, they can enter the bloodstream and affect the heart and kidneys. A consistent brushing routine is one of the most effective preventive habits available, and one of the most commonly skipped.</p>
    <p>Answer the questions above to get your dog's ramp-up plan, then scroll down for technique tips and the FAQ covering the dental care questions dog owners ask most.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_teeth_brushing() {
    ob_start(); ?>
    <p>Dental disease affects the vast majority of dogs by adulthood, but it's also one of the most preventable conditions in veterinary care. Here's why brushing matters this much:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🫀</span>
        <div>
          <strong>Prevents Systemic Health Risk</strong>
          <p>Oral bacteria from advanced dental disease can enter the bloodstream and affect major organs, including the heart and kidneys — this isn't limited to the mouth.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💵</span>
        <div>
          <strong>Avoids Expensive Dental Surgery</strong>
          <p>Treating advanced dental disease typically means anesthetic dental surgery with extractions — a significant expense that routine brushing largely prevents.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">😊</span>
        <div>
          <strong>Preserves Quality of Life</strong>
          <p>Dogs instinctively hide dental pain, but it quietly affects eating comfort, mood, and energy — brushing protects a part of their wellbeing they can't easily show you is suffering.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">😮</span>
        <div>
          <strong>Fresh Breath Is an Early Motivator</strong>
          <p>Noticeably fresher breath is often the first visible win from a new brushing routine, and it's a good reason to keep going while the deeper dental benefits build over months.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_teeth_brushing() {
    return [
        ['title'=>'Assess Current Frequency, Age, and Tartar', 'desc'=>"Tell the tool how often (if ever) you currently brush, your dog's age, and how much visible tartar buildup they have — this determines your realistic starting point."],
        ['title'=>'Get Your Personalized Ramp-Up Plan', 'desc'=>"You'll receive a week-by-week plan that starts wherever your dog currently is, rather than assuming everyone can jump straight to full daily brushing."],
        ['title'=>'Start With Finger-Only Desensitization if New', 'desc'=>"If your dog has no brushing history, begin with just a finger (or finger brush) and no toothpaste — the goal is comfort with mouth handling before any tool is introduced."],
        ['title'=>'Introduce Dog Toothpaste Flavor', 'desc'=>"Once your dog tolerates finger handling, let them taste dog-specific toothpaste (poultry or beef flavor) on its own, building a positive association before the brush appears."],
        ['title'=>'Add the Brush Once Tolerated', 'desc'=>"When your dog is comfortable with flavor and finger handling, introduce the actual brush — starting with just a few teeth rather than the full mouth."],
        ['title'=>'Track Weekly Until Daily Is Reached', 'desc'=>"Log your progress week to week as you build up frequency, aiming for daily brushing as the end goal — the pace of the ramp-up matters more than the speed."],
    ];
}

function pz_tips_dog_teeth_brushing() {
    return [
        ['Pick a Consistent Time of Day', "Brushing after a calm walk, when your dog is relaxed rather than wound up, makes each session go more smoothly and builds a predictable routine."],
        ['Use Poultry or Beef-Flavored Dog Toothpaste', "Flavor is what makes brushing tolerable, even enjoyable, for most dogs — it's the single biggest factor in whether a dog accepts the routine."],
        ['Angle the Brush 45° Toward the Gumline', "Plaque forms fastest right at the gumline, not on the flat tooth surface — angling the brush there targets where it actually matters most."],
        ['Reward Heavily in the First Two Weeks', "Generous rewards during the introduction period build the positive association that makes every future session easier — this investment pays off for years."],
        ['Keep Sessions Short — 30 to 60 Seconds', "Short, successful sessions beat long, stressful ones. It's better to brush a few teeth well and stop than to push through resistance for a longer session."],
    ];
}

function pz_mistakes_dog_teeth_brushing() {
    return [
        ['❌ Using Human Toothpaste', "Human toothpaste often contains xylitol and fluoride, both of which are toxic to dogs. Only use toothpaste labeled specifically for dogs."],
        ['❌ Expecting Full Cooperation on Day One', "A dog with no brushing history won't tolerate a full routine immediately — starting there almost always backfires and makes the dog resistant to future attempts."],
        ['❌ Only Brushing the Front Teeth', "The back molars accumulate the most tartar but are the easiest to skip since they're harder to reach — a routine that misses them misses where dental disease usually starts."],
        ['❌ Giving Up After One Resistant Session', "A single bad session doesn't mean brushing won't work — it means the pace needs to slow down, not stop. Most resistant dogs come around with a slower ramp-up."],
        ['❌ Relying on Dental Chews Alone', "Dental chews help but aren't a full substitute for brushing — they don't reach every tooth surface the way a brush does, and shouldn't replace an actual brushing routine."],
    ];
}

/* ── Puppy First Grooming — What Is / Why / Steps / Tips / Mistakes ── */

function pz_what_is_puppy_first_grooming() {
    ob_start(); ?>
    <p>The Puppy First Grooming Guide checks whether your puppy is ready to start grooming routines based on their age and vaccination status, since both determine what's actually safe to introduce right now versus what needs to wait a few more weeks.</p>
    <p>Timing matters in both directions here. Start too early — a full bath on a very young puppy, for example — and you risk a puppy that can't yet regulate their own body temperature through the process, plus a negative early experience that can create lifelong grooming fear. Wait too long, on the other hand, and you miss the critical socialization window, roughly weeks 3 through 14, when puppies are most naturally open to new experiences and least likely to develop lasting fear responses to handling.</p>
    <p>Answer the questions above to get your puppy's readiness level, then scroll down for the reasoning behind each stage and the FAQ covering the questions new puppy owners ask most about starting grooming safely.</p>
    <?php return ob_get_clean();
}

function pz_why_important_puppy_first_grooming() {
    ob_start(); ?>
    <p>How and when you introduce grooming shapes your puppy's relationship with it for their entire life. Here's what's at stake:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🐶</span>
        <div>
          <strong>Critical Socialization Window</strong>
          <p>Roughly weeks 3 through 14 are when puppies are most naturally open to new experiences — positive grooming exposure during this window shapes lifelong tolerance far more easily than trying to build it later.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🌡️</span>
        <div>
          <strong>Safety</strong>
          <p>Very young puppies can't fully regulate body temperature through a complete bath the way an adult dog can, which makes timing a genuine safety consideration, not just a comfort one.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🎯</span>
        <div>
          <strong>Sets the Tone for Life</strong>
          <p>A rushed or overwhelming first grooming experience can create a groomer-avoidant adult dog — one bad early session can outweigh months of later positive ones.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🧥</span>
        <div>
          <strong>Coat-Appropriate Start</strong>
          <p>Different coat types need different first routines — what's appropriate to introduce first for a short-coated puppy isn't the same as for a puppy that will grow a long or double coat.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_puppy_first_grooming() {
    return [
        ['title'=>'Confirm Age Bracket and Vaccination Status', 'desc'=>"Enter your puppy's age and where they are in their vaccination schedule — these two factors together determine what's currently safe to introduce."],
        ['title'=>'Get Your Readiness Level', 'desc'=>"You'll receive a readiness level telling you exactly what stage of grooming introduction is appropriate right now, from handling-only through full sessions."],
        ['title'=>'Start With Handling Only if Too Young', 'desc'=>"If your puppy isn't ready for tools or water yet, begin with gentle handling of paws, ears, and mouth — this is pure desensitization and can start well before any actual grooming does."],
        ['title'=>'Progress to Brush Introduction', 'desc'=>"Once handling is comfortable, introduce a soft brush briefly and positively, without any expectation of a full grooming session yet."],
        ['title'=>'Move to a First Short Bath or Session Once Cleared', 'desc'=>"When age and vaccination status clear your puppy for it, introduce a short, gentle first bath or grooming session — kept brief and calm rather than thorough."],
        ['title'=>'Build Toward the Adult Routine at 16+ Weeks', 'desc'=>"From around 16 weeks, gradually extend session length and introduce the full adult grooming routine your puppy's coat type will need long-term."],
    ];
}

function pz_tips_puppy_first_grooming() {
    return [
        ['Touch Paws, Ears, and Mouth Daily From Week One', "This can start regardless of grooming-readiness level — daily gentle handling is pure desensitization that pays off for every future vet visit, nail trim, and grooming session."],
        ['Keep First Sessions Under Five Minutes', "Short sessions that end on a good note build far more trust than longer ones that push into a puppy's frustration or fatigue."],
        ['Use Puppy-Specific Shampoo', "A puppy's skin pH differs from an adult dog's, and puppy-specific shampoo is formulated to match it — adult shampoo can be too harsh for young skin."],
        ['Never Force — End on a Calm Note', "If your puppy is struggling, stop and end the session on whatever calm moment you can find, even if it's incomplete — forcing through resistance teaches fear, not tolerance."],
        ['Treat Throughout the Session, Not Just at the End', "Rewarding continuously during the session — not only when it's finished — helps a puppy associate the process itself, not just the end of it, with something positive."],
    ];
}

function pz_mistakes_puppy_first_grooming() {
    return [
        ['❌ Full Bath Before Vet Clearance', "Bathing before your puppy has appropriate vaccination coverage and vet clearance carries real health risk — confirm readiness before a full bath, not just age."],
        ['❌ Long First Sessions That Overwhelm', "A first session that runs too long pushes a puppy past their tolerance and turns grooming into something to dread rather than something neutral or positive."],
        ['❌ Skipping Handling Desensitization', "Jumping straight to brushes, clippers, or water without first building comfort with basic handling skips the foundation that makes every later step easier."],
        ['❌ Using Adult-Strength Products', "Adult shampoo and grooming products are formulated for a different skin pH and coat density — too harsh for a puppy's more sensitive skin."],
        ['❌ Punishing Squirming Instead of Pausing', "A squirming puppy is communicating discomfort, not defiance. Pausing and resetting builds trust; punishing the squirming teaches a puppy to fear the whole process."],
    ];
}

/* ── Dog Coat Type — What Is / Why / Steps / Tips / Mistakes ── */

function pz_what_is_dog_coat_type() {
    ob_start(); ?>
    <p>The Dog Coat Type Guide identifies your dog's exact coat type — short & smooth, double, long & silky, curly/wool, wire, or hairless — either by searching your breed or by comparing your dog's coat to a manual description, and translates that identification into the brushing, bathing, and trimming approach that actually matches it. Coat type, not breed name, is what determines almost every grooming decision that follows.</p>
    <p>Getting the coat type wrong leads directly to tool-misuse damage: running a deshedding blade meant for a double coat across a wire or silky coat shreds guard hairs it wasn't designed to cut, while under-grooming a double coat because it "doesn't look that thick" lets the undercoat mat against the skin unnoticed. Both mistakes come from treating grooming as one-size-fits-all instead of starting with an accurate coat identification.</p>
    <p>Search your breed or select a manual coat description above to get your identification and care plan, then scroll down for the reasoning behind each coat type and the FAQ covering the questions dog owners ask most about coat-specific care.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_coat_type() {
    ob_start(); ?>
    <p>Coat type isn't just a label — it's the starting point every other grooming decision builds on. Here's why it matters this much:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🧭</span>
        <div>
          <strong>Foundation for Every Grooming Decision</strong>
          <p>Bathing frequency, brush choice, and trim schedule all cascade from coat type — get this one identification right and every other grooming decision downstream gets easier.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🛡️</span>
        <div>
          <strong>Prevents Tool-Misuse Damage</strong>
          <p>Using the wrong brush or blade for a coat type doesn't just fail to help — it can shred guard hairs or miss the undercoat entirely, causing damage that takes months to grow out.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🧬</span>
        <div>
          <strong>Especially Useful for Mixed Breeds</strong>
          <p>Breed name alone doesn't reliably predict coat texture in mixed-breed dogs — a hands-on identification catches what genetics alone won't tell you.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🔗</span>
        <div>
          <strong>Connects to Every Other Care Routine</strong>
          <p>Once you know your dog's coat type, this site's bathing frequency and deshedding tools can give you exact schedules built on that same identification.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_coat_type() {
    return [
        ['title'=>'Search Your Breed or Compare Manually', 'desc'=>"Type your dog's breed into the search box for an instant match, or — if you're unsure of the breed or working with a mix — compare your dog's coat directly against the six manual descriptions above."],
        ['title'=>'Get Your Identified Coat Type', 'desc'=>"You'll receive your dog's specific coat type along with the core care needs tied to it — this identification is what every later grooming decision should build on."],
        ['title'=>'Note the "Never Do" Warning for That Coat', 'desc'=>"Each coat type comes with one specific mistake that causes real damage, like shaving a double coat or skipping mat checks on a curly coat. Read and remember this warning before doing anything else."],
        ['title'=>'Follow Up With Bathing and Shedding Tools', 'desc'=>"Use your identified coat type in this site's bathing frequency and deshedding tools to get exact schedules built specifically around it, rather than generic advice."],
        ['title'=>"Recheck a Developing Puppy's Coat", 'desc'=>"A mixed-breed puppy's adult coat often isn't set yet — plan to recheck the identification at 6 to 12 months as the true texture comes in."],
        ['title'=>'Reassess if Texture Changes With Age', 'desc'=>"Some dogs' coats shift noticeably in texture or density as they mature or age — if brushing suddenly feels different than it used to, run the identification again."],
    ];
}

function pz_tips_dog_coat_type() {
    return [
        ['Recheck at 6-12 Months for Puppies', "A puppy's coat can look and feel different from what it becomes as an adult; recheck the identification around 6 to 12 months once the adult coat is in."],
        ['Go by Texture, Not Assumed Parentage', "Mixed breeds blend coat traits unpredictably; identify by the texture you actually feel on your dog, not by what you assume the parent breeds contributed."],
        ['Test Close to the Skin, Not Just Guard Hairs', "Surface guard hairs can be misleading; part the coat and feel close to the skin to correctly identify double and wire coats."],
        ["Ask a Groomer if You're Still Unsure", "A professional groomer can usually identify coat type in under a minute — worth a quick ask if the manual descriptions still leave you uncertain."],
        ['Photograph the Coat Now as a Baseline', "Take a few close-up photos of your dog's current coat so you have something concrete to compare against if texture seems to change later."],
    ];
}

function pz_mistakes_dog_coat_type() {
    return [
        ['❌ Assuming Coat Type From Breed Name Alone', "Mixed breeds especially vary widely in actual coat texture; always check the real dog in front of you rather than assuming based on breed labels."],
        ['❌ Using the Same Brush Across Different Coat Types', "A tool that works well on a silky coat can be entirely wrong for a double or wire coat, doing little good or actively causing damage."],
        ['❌ Shaving a Double Coat Because "It Looks Like It Needs a Cut"', "Shaving removes insulation, doesn't reduce shedding, and can permanently change how the coat regrows, sometimes patchy or the wrong texture."],
        ["❌ Not Adjusting Technique as a Puppy's Coat Matures", "Sticking with the same puppy-coat routine after the adult coat comes in means the technique is no longer matched to what's actually there."],
        ['❌ Ignoring Differences Between Body Coat and Feathering', "The feathering on ears, legs, and tail often has a different texture and mat-risk than the main body coat, and needs its own attention."],
    ];
}

/* ── Dog Eye Cleaning — What Is / Why / Steps / Tips / Mistakes ── */

function pz_what_is_dog_eye_cleaning() {
    ob_start(); ?>
    <p>The Dog Eye Cleaning Guide matches your dog's face shape and current eye discharge color to a specific cleaning frequency and wiping technique, because flat-faced (brachycephalic) breeds and normal-muzzled dogs have genuinely different eye care needs, and discharge color itself is a meaningful signal worth reading correctly rather than a purely cosmetic detail.</p>
    <p>Getting this wrong causes two different problems depending on which side you land on. Flat-faced breeds left unwiped develop persistent tear staining, and because that stained fur stays damp against the skin, it creates real risk of a secondary skin infection underneath it. On any dog, a discharge color that quietly shifts from clear to yellow or green without anyone noticing can go unaddressed for days — and that color change is often the first visible sign of an eye infection or a blocked tear duct.</p>
    <p>Select your dog's face shape and current discharge color above to get your cleaning frequency and urgency flag, then scroll down for wiping technique and the FAQ covering the eye care questions dog owners ask most.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_eye_cleaning() {
    ob_start(); ?>
    <p>Eye cleaning affects your dog's daily comfort and can be your earliest warning sign of a developing problem. Here's what's actually at stake:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">😌</span>
        <div>
          <strong>Genuine Comfort</strong>
          <p>Discharge and matted fur around the eyes is physically irritating, not just unsightly; regular cleaning removes a source of real daily discomfort.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🩹</span>
        <div>
          <strong>Prevents Secondary Skin Infection</strong>
          <p>Fur kept damp by ongoing tear staining creates conditions for skin infection underneath it, especially in the folds around a flat-faced breed's eyes.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🚨</span>
        <div>
          <strong>Early Illness Signal</strong>
          <p>A change in discharge color or consistency is frequently the first visible symptom of infection or a blocked tear duct, often showing up before any other sign.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">✨</span>
        <div>
          <strong>Appearance</strong>
          <p>Persistent staining is especially noticeable on white or light-coated breeds, and it's one of the easiest cosmetic issues to prevent with a consistent routine.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_eye_cleaning() {
    return [
        ["title"=>"Note Your Dog's Face Shape", 'desc'=>"Identify whether your dog is flat-faced (brachycephalic, like a Pug, Bulldog, or Shih Tzu) or has a normal muzzle — this alone changes the baseline cleaning frequency significantly."],
        ['title'=>'Note Current Discharge Color and Pattern', 'desc'=>"Look closely at today's discharge — clear, brown/rust staining, or yellow/green — since color is the detail that determines whether this is routine maintenance or something to flag for a vet."],
        ['title'=>'Get Your Frequency and Urgency Flag', 'desc'=>"Based on face shape and discharge color, you'll get a specific cleaning frequency along with an urgency flag if the color you entered warrants veterinary attention."],
        ['title'=>'Wipe Outward From the Inner Corner', 'desc'=>"Using a damp cloth, cotton pad, or tear-stain wipe, wipe gently outward and away from the inner corner of the eye — never inward, where you risk pushing debris toward the eye itself."],
        ['title'=>'Use a Fresh Pad for Each Eye', 'desc'=>"Never use the same cloth or pad on both eyes in one session — this is the single most common way owners accidentally spread irritation or infection from one eye to the other."],
        ['title'=>'Escalate to a Vet if Discharge Turns Yellow or Green', 'desc'=>"If discharge color changes to yellow or green, or it's paired with squinting or redness, that's outside routine cleaning and needs a vet visit rather than a wipe."],
    ];
}

function pz_tips_dog_eye_cleaning() {
    return [
        ['Dedicate a Pad Per Eye', "Keep cleaning materials for the left and right eye mentally (or physically) separate so you never cross-contaminate between them."],
        ['Trim Fur Short Around the Eyes on Flat-Faced Breeds', "Shorter fur around the eyes traps less debris and makes daily wiping faster and more effective on brachycephalic breeds."],
        ['Use Warm Water or a Tear-Stain Formulated Wipe', "Warm, not hot, water works for routine wiping; a tear-stain-formulated wipe does a better job on set-in staining than water alone."],
        ["Check Daily Even if You Don't Clean Daily", "A quick daily glance lets you catch a discharge color change early, even on the days your dog's routine doesn't call for a full wipe."],
        ['Keep a Photo Baseline', "A reference photo of your dog's normal eye area makes it much easier to notice a real change later, rather than relying on memory."],
    ];
}

function pz_mistakes_dog_eye_cleaning() {
    return [
        ['❌ Using the Same Pad on Both Eyes', "Reusing one cotton ball or cloth on both eyes risks transferring bacteria or irritation from one eye to the other."],
        ['❌ Using Human Eye Products', "Products formulated for human eyes aren't tested or appropriate for dogs; stick to dog-specific or vet-recommended eye wipes and solutions."],
        ['❌ Dismissing Yellow or Green Discharge as "Just Tear Stains"', "Routine tear staining is brown or rust-colored; yellow or green is a different signal and shouldn't be waved off as cosmetic."],
        ['❌ Letting Fur Around the Eyes Grow Long and Matted', "Long fur around the eyes traps more debris and moisture, making both staining and irritation worse over time."],
        ['❌ Scrubbing at Dried Stains Instead of Soaking First', "Aggressively scrubbing dried, set-in staining irritates the skin; soak the area gently first to loosen it before wiping."],
    ];
}

/* ── Dog Paw Care — What Is / Why / Steps / Tips / Mistakes ── */

function pz_what_is_dog_paw_care() {
    ob_start(); ?>
    <p>The Dog Paw Care Guide builds a season- and terrain-specific paw routine, because pavement in summer heat, salted sidewalks in winter, and rough trail ground each put a different, specific kind of stress on paw pads, and the right routine depends on knowing which one your dog actually faces.</p>
    <p>Neglecting paw care isn't abstract — hot summer pavement causes real pad burns, winter road salt causes irritation and cracking (and dogs make it worse by licking it off, ingesting the irritant in the process), and rough trail terrain can hide a cut or embedded debris that goes undetected until your dog is visibly limping.</p>
    <p>Select your season and terrain above to get your personalized paw routine, then scroll down for the reasoning behind it and the FAQ covering the paw care questions dog owners ask most.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_paw_care() {
    ob_start(); ?>
    <p>Paws take on more direct physical stress than almost any other part of your dog's body, and most of that stress is invisible until damage is already done. Here's why the routine matters:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🐾</span>
        <div>
          <strong>Paws Bear 100% of Body Weight in Motion</strong>
          <p>Any paw injury directly limits mobility, since there's no way for your dog to shift weight away from a hurting paw during normal activity.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">👁️</span>
        <div>
          <strong>Environmental Damage Is Often Invisible</strong>
          <p>Hot pavement and road salt cause harm you can't easily see coming — by the time it's obvious, the burn or irritation has already happened.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💰</span>
        <div>
          <strong>Prevention Is Cheap; Treatment Isn't</strong>
          <p>A protective balm costs little and takes seconds to apply; treating a burned or cracked pad often means a vet visit and restricted activity while it heals.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🔄</span>
        <div>
          <strong>Paw Pad Skin Heals Slower Than Body Skin</strong>
          <p>Pad tissue doesn't regenerate as quickly as skin elsewhere on the body, so damage there tends to take longer to fully resolve.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_paw_care() {
    return [
        ['title'=>'Select Your Current Season', 'desc'=>"Choose the season you're in — summer heat and winter salt/ice each create a specific paw risk that changes what your routine needs to focus on."],
        ['title'=>'Select Your Typical Terrain', 'desc'=>"Identify the surface your dog walks on most — pavement, trail, or mixed — since terrain changes both the risk type and how often you need to check paws."],
        ['title'=>'Note Current Paw Condition', 'desc'=>"Take a quick look at your dog's paw pads now — smooth, dry, cracked, or already showing irritation — so the routine accounts for where you're actually starting from."],
        ['title'=>'Get Your Personalized Paw Routine', 'desc'=>"Based on season, terrain, and current condition, you'll receive specific timing, balm recommendations, and a check frequency built around your dog's actual exposure."],
        ['title'=>'Do the 5-Second Hand Test Before Hot Walks', 'desc'=>"Press the back of your hand to the pavement for five seconds — if it's too hot for your hand, it's too hot for your dog's paws, and the walk should wait or move to grass."],
        ['title'=>'Check Between the Pads After Rough-Terrain Walks', 'desc'=>"Spread the toes and check between the pads for embedded debris, small cuts, or matted fur after any walk on trail or rough ground, where damage is easiest to miss."],
    ];
}

function pz_tips_dog_paw_care() {
    return [
        ['Walk Early Morning or Late Evening in Summer Heat', "Pavement temperature peaks hours after the air does; walking when the ground is coolest avoids the worst of the risk entirely."],
        ['Apply Balm Before Winter Walks, Not Just After', "Applying a protective balm before heading out creates a barrier against salt and ice, rather than only treating irritation after it's already happened."],
        ['Keep Fur Between the Pads Trimmed', "Trimmed fur between the pads reduces ice-ball buildup in winter and debris-trapping year-round."],
        ["Check That Nail Length Isn't Distorting Gait", "Overly long nails force an abnormal gait that puts uneven pressure on paw pads — a quick nail check is part of a real paw-care routine."],
        ['Make a Post-Walk Paw Wipe a Routine Anchor', "A quick wipe-down after every walk is a natural moment to spot problems early, not just a cleanliness step."],
    ];
}

function pz_mistakes_dog_paw_care() {
    return [
        ['❌ Assuming Paws Are "Tough Enough" for Any Surface', "Paw pads have real limits; skipping the pavement hand-test on the assumption that paws can handle anything leads to preventable burns."],
        ['❌ Skipping the Salt Rinse in Winter', "Dogs lick their paws after a walk, which means unrinsed road salt gets ingested, not just left irritating the skin."],
        ['❌ Waiting for Visible Limping Before Checking', "Limping means damage has already happened; checking paws proactively catches problems before they reach that point."],
        ['❌ Using Human Foot Creams', "Products formulated for human feet aren't designed for paw pad skin and may contain ingredients that aren't safe if licked off."],
        ['❌ Forgetting Nail Length Affects Paw Pressure', "Long nails change how weight distributes across the pad, adding a stress factor that's easy to overlook in a paw-care routine."],
    ];
}

/* ── Dog Anal Gland — What Is / Why / Steps / Tips / Mistakes ── */

function pz_what_is_dog_anal_gland() {
    ob_start(); ?>
    <p>The Dog Anal Gland Guide estimates your dog's actual risk level for anal gland issues based on breed size and how often you're seeing scooting or licking, since structural risk genuinely varies by size and most dogs never need manual intervention at all.</p>
    <p>The real risk here runs in two directions — a truly impacted gland is painful and can abscess if left neglected, but the far more common problem is owners over-worrying and attempting unnecessary or poorly-executed home expression, which itself carries injury risk to a healthy dog that didn't need intervention in the first place.</p>
    <p>Answer the questions above to get your dog's risk assessment, then scroll down for what the assessment means and the FAQ covering the anal gland questions dog owners ask most.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_anal_gland() {
    ob_start(); ?>
    <p>Anal gland care is one of the most over-worried-about topics in dog ownership — here's what actually matters:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">✅</span>
        <div>
          <strong>Most Dogs Self-Express Naturally</strong>
          <p>Firm, regular stool applies enough pressure during normal bowel movements for most dogs to empty their glands on their own, without any intervention needed.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">📏</span>
        <div>
          <strong>Small Breeds Carry Genuinely Higher Risk</strong>
          <p>Smaller breeds have a structural anatomy that makes impaction more common, so size is a legitimate factor in how closely to watch for symptoms.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🚦</span>
        <div>
          <strong>Scooting Is a Clear Signal Worth Taking Seriously</strong>
          <p>Scooting is your dog's own direct communication that something's uncomfortable back there — it's worth addressing, not something to feel embarrassed about.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⚠️</span>
        <div>
          <strong>DIY Expression Done Wrong Can Injure Your Dog</strong>
          <p>Manual expression by an inexperienced hand can cause real injury; knowing when to defer to a groomer or vet is as important as recognizing symptoms.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_anal_gland() {
    return [
        ["title"=>"Note Your Dog's Breed Size", 'desc'=>"Enter your dog's breed size category — small breeds carry a genuinely higher structural risk for anal gland issues than larger dogs."],
        ['title'=>'Note Scooting or Licking Frequency', 'desc'=>"Tell the tool how often you've noticed scooting or excessive licking at the area — frequency is the clearest behavioral signal available to you at home."],
        ['title'=>'Get Your Risk Assessment', 'desc'=>"Based on size and symptom frequency, you'll receive a risk level indicating whether this looks like normal variation or something worth a professional check."],
        ['title'=>'Book a Groomer or Vet Visit if Frequent', 'desc'=>"If your assessment flags frequent symptoms, schedule a professional appointment rather than attempting expression yourself — this is the safest path when intervention is actually needed."],
        ['title'=>'Ask About Fiber if Issues Recur', 'desc'=>"For dogs with recurring issues, ask your vet whether a fiber adjustment could help — firmer stool supports the natural self-expression process going forward."],
        ['title'=>'Reassess After the Appointment', 'desc'=>"Once a groomer or vet has addressed the current issue, note whether frequency changes — this gives you useful context for whether it's a one-off or a pattern worth monitoring."],
    ];
}

function pz_tips_dog_anal_gland() {
    return [
        ['Support Natural Expression With a High-Fiber Diet', "Firm stool from adequate dietary fiber is what drives natural gland expression during normal bowel movements."],
        ['Watch for a Fishy Odor as a Companion Sign', "A distinct fishy odor alongside scooting is another key sign worth noting, not just the scooting behavior on its own."],
        ["Don't Assume Every Scoot Means Glands", "Intestinal worms can cause similar scooting behavior; mention the pattern to your vet so they can rule out other causes too."],
        ['Ask for a Quick Check at Routine Vet Visits', "A gland check takes moments during a regular visit, even without symptoms present, and costs nothing extra to ask for."],
        ['Track Frequency if It Becomes Recurring', "Note dates if scooting keeps coming back — a documented pattern is more useful context for your vet than a vague \"it happens sometimes.\""],
    ];
}

function pz_mistakes_dog_anal_gland() {
    return [
        ['❌ Attempting DIY Expression Without Guidance', "Manual expression done incorrectly can injure the gland tissue; this is a skill worth learning from a professional first, not guessing at from a video."],
        ['❌ Ignoring Frequent Scooting as "Just a Habit"', "Regular scooting is communication, not a quirky habit — frequent occurrences deserve a proper check rather than being written off."],
        ['❌ Assuming All Dogs Need Periodic Manual Expression', "Most dogs never need manual intervention at all; routine \"just in case\" expression isn't necessary or recommended for a dog with no symptoms."],
        ['❌ Confusing Anal Gland Symptoms With a Worm-Related Itch', "Both can look like similar scooting behavior; ruling out worms with your vet avoids treating the wrong problem."],
        ['❌ Delaying Care for a Genuinely Impacted Gland', "Once impaction is confirmed, delaying professional care raises the risk of a painful abscess that needs more involved treatment."],
    ];
}

/* ── Dog Haircut Styles — What Is / Why / Steps / Tips / Mistakes ── */

function pz_what_is_dog_haircut_styles() {
    ob_start(); ?>
    <p>The Dog Haircut Styles Guide matches your dog's coat type, local climate, and the maintenance time you realistically have to a named haircut style and trim interval, because the right style is a function of all three factors together — not just which cut looks best in a photo.</p>
    <p>Choosing a style by looks alone backfires in specific ways — shaving a double coat for "cooling" removes insulation and can permanently alter regrowth, while picking a high-maintenance long style without the daily brushing time to support it just means matting between appointments instead of the low-effort look you were hoping for.</p>
    <p>Select your coat type, climate, and available time above to get your named style recommendation, then scroll down for the reasoning behind it and the FAQ covering the styling questions dog owners ask most.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_haircut_styles() {
    ob_start(); ?>
    <p>A haircut style is a functional decision, not just an aesthetic one. Here's what determines whether a style actually works for your dog:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🎯</span>
        <div>
          <strong>Function Over Trend Photos</strong>
          <p>Climate and realistic maintenance time matter more to a style's success than how it looks in a photo of a different dog in a different climate.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🔁</span>
        <div>
          <strong>The Wrong Style Creates More Work, Not Less</strong>
          <p>A "cute" long style chosen without the daily brushing time to maintain it results in mats between appointments, undoing any time it seemed to save.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🧥</span>
        <div>
          <strong>Protects Coat-Specific Health Needs</strong>
          <p>Some styles compromise the insulation or skin protection a coat type is built to provide — the right style respects what that coat is actually for.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💬</span>
        <div>
          <strong>Better Groomer Conversations</strong>
          <p>Walking in with a named target style, rather than a vague idea, makes the conversation with your groomer faster and the result closer to what you actually wanted.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_haircut_styles() {
    return [
        ["title"=>"Select Your Dog's Coat Type", 'desc'=>"Choose the coat type your dog actually has — this narrows the field to styles that are structurally appropriate before climate or time even come into play."],
        ['title'=>'Select Your Local Climate', 'desc'=>"Tell the tool the climate you live in — hot, cold, or variable — since climate changes which styles genuinely serve your dog's comfort and health."],
        ['title'=>'Select Your Realistic Maintenance Time', 'desc'=>"Be honest about how much daily or weekly brushing time you actually have, not how much you'd like to have — this is what keeps a chosen style from turning into mats."],
        ['title'=>'Get Your Named Style and Trim Interval', 'desc'=>"Based on your three inputs, you'll receive a specific named style along with the trim interval it needs to stay looking and functioning as intended."],
        ['title'=>'Bring the Recommendation to Your Groomer', 'desc'=>"Use the named style as a starting conversation with your groomer — they can adjust the specifics to your individual dog while keeping the same functional target."],
        ['title'=>'Reassess Each Season if Climate Shifts', 'desc'=>"If you move, or your local climate swings significantly between seasons, run the tool again — the right style for summer isn't always right for winter."],
    ];
}

function pz_tips_dog_haircut_styles() {
    return [
        ['Bring Reference Photos Even With a Named Style', "Groomer interpretation of the same style name varies; a few reference photos alongside the named style keeps everyone aligned."],
        ['Ease Into Shorter Styles Gradually', "For a first-timer or a nervous dog, transition to a shorter style over a couple of visits rather than one drastic first cut."],
        ['Ask About a Maintenance Trim Between Full Cuts', "A quick maintenance trim between full appointments can extend the interval between full grooms without letting the coat get out of hand."],
        ['Budget Time for the Style You Actually Chose', "Commit to the real maintenance time a style needs, not the amount you're hoping will be enough — this is what prevents matting between visits."],
        ['Keep Curly Coats on a Consistent Interval', 'Curly and wool coats need trims on a set schedule, not "whenever it looks like it needs it" — waiting too long lets matting set in first.'],
    ];
}

function pz_mistakes_dog_haircut_styles() {
    return [
        ['❌ Shaving a Double Coat "to Help With Heat"', "This is counterproductive: it removes insulation that helps regulate temperature in both directions and can damage how the coat regrows."],
        ['❌ Picking a Style on Looks Alone', "Choosing a style without being honest about the maintenance time it needs sets you up for matting and a look that doesn't hold between appointments."],
        ['❌ Going Too Short Too Fast on a Nervous First-Timer', "A dramatic first cut on a dog unused to grooming can create lasting fear of the groomer; easing in works better."],
        ['❌ Skipping Brushing Between Appointments', 'Assuming the cut itself "handles" maintenance skips the brushing a style still needs to stay mat-free between visits.'],
        ['❌ Not Communicating Allergies or Sensitivities Upfront', "A new groomer needs to know about skin sensitivities or product allergies before a style change, not after a reaction occurs."],
    ];
}

/* ── Long-Haired Dog Grooming — What Is / Why / Steps / Tips / Mistakes ── */

function pz_what_is_long_haired_dog_grooming() {
    ob_start(); ?>
    <p>The Long-Haired Dog Grooming Guide builds a maintenance plan around your dog's specific long-coat texture — silky, wooly, or double-long — since each mats differently and needs a distinct brushing technique, not a single generic "brush regularly" instruction.</p>
    <p>The real risk with long coats is that surface-only brushing can look completely fine while mats are quietly forming underneath, against the skin, invisible until they're already severe. By the time a mat like that is caught, a shave-down is often the only real fix, undoing months of coat growth in one appointment.</p>
    <p>Select your coat texture above to get your brushing frequency and technique, then scroll down for the reasoning behind it and the FAQ covering the long-coat questions dog owners ask most.</p>
    <?php return ob_get_clean();
}

function pz_why_important_long_haired_dog_grooming() {
    ob_start(); ?>
    <p>Long coats fail in a specific, predictable way — understanding it is most of what prevents it:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🕵️</span>
        <div>
          <strong>Mats Form From the Skin Outward, Invisibly</strong>
          <p>A long coat can look smooth on the surface while mats are already forming at the skin underneath — by the time it's visible, it's already established.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🪮</span>
        <div>
          <strong>Line-Brushing Is Non-Negotiable</strong>
          <p>Brushing only the surface layer misses the undercoat entirely; long coats need to be brushed in sections, down to the skin, not just across the top.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">👂</span>
        <div>
          <strong>Feathering Areas Mat Fastest</strong>
          <p>Ears, legs, and tail feathering experience the most friction and mat faster than the body coat, but get skipped in a quick, surface-level brush.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⏱️</span>
        <div>
          <strong>Prevention Beats De-Matting Every Time</strong>
          <p>Regular line-brushing takes minutes; de-matting an established mat is time-consuming, sometimes painful for the dog, and sometimes requires a professional shave-down.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_long_haired_dog_grooming() {
    return [
        ["title"=>"Identify Your Dog's Long-Coat Texture", 'desc'=>"Determine whether your dog's long coat is silky, wooly, or double-long — each texture mats differently and needs its own specific brushing approach."],
        ['title'=>'Note Current Mat Frequency', 'desc'=>"Think honestly about how often you're currently finding mats and where — this tells the tool whether your current routine is actually keeping pace with your dog's coat."],
        ['title'=>'Get Your Brushing Frequency and Technique', 'desc'=>"Based on texture and current mat frequency, you'll receive a specific brushing schedule along with the line-brushing technique note that applies to your dog's coat."],
        ['title'=>'Section the Coat and Brush in Layers', 'desc'=>"Part the coat into sections and brush each one down to the skin before moving to the next — a single top-to-bottom pass over the whole coat misses the undercoat."],
        ['title'=>'Apply Detangling Spray Before Brushing', 'desc'=>"Spray detangler onto the coat before you start, not partway through on a resistant tangle — it needs time to work into the hair before the brush meets it."],
        ['title'=>'Escalate to Professional De-Matting When Needed', 'desc'=>"If mats are frequent, large, or close to the skin, book a professional de-matting session rather than forcing it at home — done wrong, de-matting can be painful and risks nicking the skin."],
    ];
}

function pz_tips_long_haired_dog_grooming() {
    return [
        ['Always Brush Before Bathing, Never After', "Water tightens existing tangles into true mats; brushing out tangles before a bath prevents the bath from making them worse."],
        ['Use a Metal Comb as a "Did I Reach the Skin" Check', "After slicker-brushing, run a metal comb through the same section — if it catches, you haven't actually reached the skin yet."],
        ['Focus Extra Time on Friction Zones', "Behind the ears, armpits, and under the collar experience the most friction and need more brushing attention than the rest of the coat."],
        ['Use a Light Leave-In Conditioner Between Sessions', "A light leave-in reduces static and tangling day to day, making each brushing session easier than starting from scratch."],
        ['Keep a Standing Professional Trim Interval', "Even with good home care, a regular professional trim interval keeps length and feathering areas manageable long-term."],
    ];
}

function pz_mistakes_long_haired_dog_grooming() {
    return [
        ['❌ Brushing Only the Visible Surface Layer', "A surface-only brush leaves the undercoat, where mats actually form against the skin, completely untouched."],
        ['❌ Forcing a Dry Brush Through Resistant Tangles', "Skipping detangling spray and forcing a brush through a resistant tangle pulls at the skin and can turn a tangle into a full mat."],
        ['❌ Bathing Over Unbrushed Tangled Fur', "Water tightens existing tangles into set mats; always brush thoroughly before, not after, a bath."],
        ['❌ Underestimating Feathering-Area Mat Speed', "Ears, tail, and leg feathering mat faster than the body coat but are frequently the first area skipped in a rushed brushing session."],
        ['❌ Waiting Until a Mat Is Large or Pelted', "Addressing a mat early, while it's small, is far easier and less uncomfortable for the dog than waiting until it's large or pelted against the skin."],
    ];
}

/* ── Dog Deshedding — What Is / Why / Steps / Tips / Mistakes ── */

function pz_what_is_dog_deshedding() {
    ob_start(); ?>
    <p>The Dog Deshedding Guide matches your dog's coat type and current shedding severity to the right deshedding tool and frequency, because the tool matters as much as the effort — a tool built for the wrong coat type doesn't just underperform, it can actively damage the coat.</p>
    <p>Using the wrong tool causes real, specific damage: a deshedding blade run across a single or long coat cuts into the topcoat instead of pulling loose undercoat the way it's designed to, and pressing too hard with any deshedding tool can irritate the skin underneath, turning a routine grooming task into a source of discomfort.</p>
    <p>Select your coat type and current shedding severity above to get your matched tool and frequency, then scroll down for correct technique and the FAQ covering the deshedding questions dog owners ask most.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_deshedding() {
    ob_start(); ?>
    <p>Deshedding is one of the clearest cases where technique and tool choice matter more than effort alone. Here's why:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🛠️</span>
        <div>
          <strong>The Right Tool Makes the Real Difference</strong>
          <p>Technique and tool match matter as much as how often you brush — the same effort with the wrong tool produces worse results.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⚠️</span>
        <div>
          <strong>Wrong Tools Genuinely Damage Coat and Skin</strong>
          <p>This isn't just inefficiency: a mismatched deshedding tool can cut guard hairs or irritate skin, not just waste your time.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">📅</span>
        <div>
          <strong>Severity-Matched Frequency Avoids Both Extremes</strong>
          <p>Matching frequency to actual shedding severity prevents both under-managing (hair everywhere) and over-brushing (skin irritation from doing it too often).</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🍂</span>
        <div>
          <strong>Seasonal Awareness Prevents Wasted Effort</strong>
          <p>Knowing when your dog's coat-blow window is means you apply the right intensity at the right time instead of guessing year-round.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_deshedding() {
    return [
        ["title"=>"Identify Your Dog's Coat Type", 'desc'=>"Select your dog's coat type — this determines which category of deshedding tool is actually appropriate, since the wrong category can cut hair rather than pull it."],
        ['title'=>'Rate Current Shedding Severity', 'desc'=>"Rate how much your dog is currently shedding — this calibrates the frequency recommendation to what you're actually dealing with right now, not a generic average."],
        ['title'=>'Get Your Matched Tool and Frequency', 'desc'=>"Based on coat type and severity, you'll receive a specific tool recommendation along with how often to use it for your dog's current situation."],
        ['title'=>'Learn the Correct Direction and Pressure', 'desc'=>"Every deshedding tool has a correct direction and pressure for the coat it's designed for — learn this before your first session so you're using the tool as intended, not just running it across the coat."],
        ['title'=>'Increase Frequency During Seasonal Coat-Blow', 'desc'=>"During the 2-3 week seasonal coat-blow window, increase your session frequency temporarily well above the normal baseline to keep pace with the volume."],
        ['title'=>'Reassess Severity Each Season', 'desc'=>"Shedding severity changes with the seasons — revisit your rating periodically so your tool and frequency recommendation stays matched to what's actually happening."],
    ];
}

function pz_tips_dog_deshedding() {
    return [
        ['Always Brush a Dry Coat for Deshedding Tools', "Wet coat behaves differently and most deshedding tools work less effectively on it; brush dry for the intended result."],
        ['Favor Short, Frequent Sessions Over One Long One', "Especially during peak shedding, several short sessions are less exhausting for your dog and more effective than one long marathon session."],
        ['Vacuum Immediately After a Deshedding Session', "Loose hair keeps falling for a while after a session ends, so vacuuming right after catches more of it than waiting."],
        ['Pair With a Diet Check if Shedding Seems Excessive', "If shedding seems beyond a normal seasonal pattern, ask your vet whether a diet or supplement adjustment could help."],
        ['Ask a Groomer to Demo Technique in Person', "A quick in-person demo of blade or rake technique from a groomer is worth more than any written description of direction and pressure."],
    ];
}

function pz_mistakes_dog_deshedding() {
    return [
        ['❌ Using a Deshedding Blade on the Wrong Coat Type', "A blade designed for double coats can cut guard hairs on coats it's not built for, causing damage instead of removing loose undercoat."],
        ['❌ Pressing Too Hard, Assuming More Pressure Works Better', "Extra pressure doesn't remove more loose hair — it just increases the risk of skin irritation."],
        ['❌ Brushing a Wet or Damp Coat With a Deshedding Tool', "These tools are designed for dry coat; using them wet reduces effectiveness and changes how the coat responds to the tool."],
        ['❌ Skipping the Tool Entirely and Relying on Baths', "Bathing alone doesn't remove loose undercoat the way a properly matched deshedding tool does — it just delays where the loose hair ends up."],
        ['❌ Not Increasing Frequency During Coat-Blow', "Sticking to the normal baseline frequency during the 2-3 week seasonal blow window lets loose hair build up faster than you're removing it."],
    ];
}

/* ── Dog Grooming Tools (Grooming Kit Builder) — What Is / Why / Steps / Tips / Mistakes ── */

function pz_what_is_dog_grooming_tools() {
    ob_start(); ?>
    <p>The Grooming Kit Builder matches your dog's coat type and your budget tier to a specific, prioritized list of dog grooming tools, because a coat-appropriate kit is what actually gets used — a generic "starter kit" bought off a shelf often isn't matched to the coat it needs to work on.</p>
    <p>Buying the wrong tools wastes real money and solves nothing: a slicker brush bought for a smooth-coated dog does little, a dematting rake bought for a coat that never mats sits unused, and owners end up overspending on extras while the one tool their dog's coat actually needs never gets purchased.</p>
    <p>Select your dog's coat type and budget tier above to get your matched checklist, then scroll down for the reasoning behind the priority order and the FAQ covering the grooming tool questions owners ask most.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_grooming_tools() {
    ob_start(); ?>
    <p>The right basic kit prevents most grooming problems before they start, and getting the priority order right matters as much as the tools themselves. Here's why a matched kit beats a generic one:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🧰</span>
        <div>
          <strong>The Right Kit Prevents Problems Early</strong>
          <p>Most matting, shedding overload, and nail-related issues are far easier to prevent with the correct tools than to fix after they've developed.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🎯</span>
        <div>
          <strong>Coat-Appropriate Tools Actually Work</strong>
          <p>A brush designed for the wrong coat type glides over problems instead of solving them — the tool has to match the coat to do its job.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💵</span>
        <div>
          <strong>Budget Tiers Avoid Both Extremes</strong>
          <p>Thinking in tiers stops you from under-equipping with tools too basic to work, or overspending on extras before the essentials are covered.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">✂️</span>
        <div>
          <strong>Fewer Trips to a Professional for Routine Tasks</strong>
          <p>A complete-enough home kit means routine brushing, nail care, and touch-ups don't require a groomer appointment every time.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_grooming_tools() {
    return [
        ['title'=>"Select Your Dog's Coat Type", 'desc'=>"Choose the coat type that matches your dog — smooth, double, curly, wire, or long — since this is the single biggest factor in which tools will actually work."],
        ['title'=>'Select Your Budget Tier', 'desc'=>"Pick the budget range you're comfortable with so the checklist stays realistic rather than recommending tools you won't actually buy."],
        ['title'=>'Get Your Matched Checklist', 'desc'=>"Based on coat type and budget, you'll receive a specific, prioritized list of tools built for your dog's actual grooming needs."],
        ['title'=>'Acquire Items in Priority Order', 'desc'=>"Buy the coat-matched brush and clippers first — these have the highest impact — and treat extras like dryers or grooming tables as later additions."],
        ['title'=>'Learn Correct Use of Each Tool', 'desc'=>"A tool used incorrectly underperforms even when it's the right one — ask a groomer for a quick technique demo or watch a short instructional video for each new tool."],
        ['title'=>'Replace Worn Tools Promptly', 'desc'=>"Dull clipper blades and bent or splayed brush pins stop doing their job well before they look obviously broken — replace them as soon as performance drops."],
    ];
}

function pz_tips_dog_grooming_tools() {
    return [
        ['Prioritize the Coat-Matched Brush First', "The right brush for your dog's specific coat is the single highest-impact purchase in any kit — prioritize it even on a tight budget before anything else."],
        ['Sharp Clippers Matter More Than Brand', "A dull nail clipper crushes the nail rather than cutting it cleanly, regardless of how premium the brand name is — sharpness is what counts."],
        ['Store Tools Clean and Dry', "Rinsing and fully drying brushes and clippers after use extends their working life significantly compared to tossing them away damp or dirty."],
        ['Consistency Beats a Premium Kit', "A basic kit used every week outperforms an expensive kit that sits in a drawer — consistency of use matters more than the price tag."],
        ['Ask Your Groomer What They\'d Prioritize', "A professional groomer who's seen your specific dog can tell you which single tool would make the biggest difference for that coat."],
    ];
}

function pz_mistakes_dog_grooming_tools() {
    return [
        ['❌ Buying a Generic "One Size Fits All" Brush', "A brush marketed as universal typically suits no coat type particularly well — coat-matched tools consistently outperform generic ones."],
        ['❌ Prioritizing Extras Before Basics Are Covered', "Buying a dryer or grooming table before a proper coat-matched brush and clippers are in place means the foundational tools are still missing."],
        ['❌ Using Dull or Worn Tools Past Their Useful Life', "A clipper or brush past its prime performs poorly even in skilled hands — worn tools should be replaced, not pushed further."],
        ['❌ Buying Human-Grade Products Instead of Pet-Formulated Ones', "Products made for human hair or skin aren't formulated for a dog's coat or pH and often underperform or cause irritation."],
        ['❌ Not Budgeting for Consumables Alongside Tools', "Shampoo, ear cleaning solution, and other consumables are ongoing costs that a one-time tool purchase doesn't cover — budget for both."],
    ];
}

/* ── Dog Winter Coat Care (Winter Coat Care Planner) — What Is / Why / Steps / Tips / Mistakes ── */

function pz_what_is_dog_winter_coat_care() {
    ob_start(); ?>
    <p>The Winter Coat Care Planner builds a season-adjusted grooming routine from your dog's coat type, how much cold exposure they get outdoors, and how dry your indoor heating runs, because winter changes what a coat and its skin actually need — and the right adjustment depends on all three factors together.</p>
    <p>Getting winter coat care wrong has real consequences: over-bathing in cold weather strips natural oils and dries and cracks skin faster than in warmer months, and unprotected paws exposed to road salt and ice-melt suffer genuine chemical irritation and cracking that's easy to prevent but painful once it happens.</p>
    <p>Select your coat type, cold-exposure level, and indoor heating dryness above to get your winter-adjusted routine, then scroll down for the reasoning behind it and the FAQ covering the winter care questions dog owners ask most.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_winter_coat_care() {
    ob_start(); ?>
    <p>Winter puts a coat and skin under a specific kind of stress that most owners don't fully account for. Here's why a season-adjusted routine matters:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🔥</span>
        <div>
          <strong>Cold Air and Indoor Heating Both Dry Skin</strong>
          <p>Dry winter air outside and heated dry air inside create a double exposure to dehydration that most owners don't realize is happening from both directions at once.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🧂</span>
        <div>
          <strong>Road Salt Is a Genuine Chemical Irritant</strong>
          <p>Ice-melt and road salt aren't just messy — they irritate paw pads directly and are mildly toxic if licked off, which dogs reliably do without protection.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🧥</span>
        <div>
          <strong>Double Coats Provide Real Insulation</strong>
          <p>The undercoat is functional insulation, not just volume — interfering with it in winter removes protection right when your dog needs it most.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🐾</span>
        <div>
          <strong>Winter Paw Injuries Are Common but Preventable</strong>
          <p>Cracked pads and ice-ball buildup between toes happen often in winter, but a few simple protective habits prevent nearly all of them.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_winter_coat_care() {
    return [
        ['title'=>"Select Your Dog's Coat Type", 'desc'=>"Choose your dog's coat type — double, single, or curly coats each respond differently to cold air and indoor heating."],
        ['title'=>'Select Your Outdoor Cold-Exposure Level', 'desc'=>"Indicate how much time your dog spends outdoors in cold conditions, since exposure level changes how much paw and skin protection is needed."],
        ['title'=>'Note Your Indoor Heating Dryness', 'desc'=>"Let the planner know how dry your indoor heating runs — this affects how much the bathing interval and skin-support routine should shift."],
        ['title'=>'Get Your Winter-Adjusted Routine', 'desc'=>"Based on coat, cold exposure, and indoor heating, you'll receive a specific bathing interval, paw protection plan, and skin-support recommendations."],
        ['title'=>'Apply Paw Protection Before Cold Walks', 'desc'=>"Apply a protective balm before heading out into cold or salted conditions, not just after signs of irritation appear."],
        ['title'=>'Rinse Paws After Any Salted-Surface Walk', 'desc'=>"Rinse and dry paws after walking on any salted or ice-melt-treated surface to prevent irritation and stop your dog from licking the residue off."],
    ];
}

function pz_tips_dog_winter_coat_care() {
    return [
        ['Extend Bathing Interval by About 2 Weeks in Winter', "Stretching the interval between baths and adding a moisturizing conditioner helps counter the season's extra dryness."],
        ['Run a Humidifier Near Sleeping Areas', "A humidifier helps counter the drying effect of indoor heating specifically where your dog spends the most time resting."],
        ['Check Between Toe Pads for Ice Balls', "On longer-coated dogs, check between the toes for ice ball buildup after any snow walk — these are uncomfortable and easy to miss."],
        ['Never Shave a Double Coat for Winter', "The undercoat is the insulation itself — shaving it for winter removes the exact protection your dog needs most during cold months."],
        ['Consider Omega-3 Supplementation', "Omega-3 supplementation supports the skin barrier through the dry winter season — ask your vet about an appropriate dose for your dog."],
    ];
}

function pz_mistakes_dog_winter_coat_care() {
    return [
        ['❌ Keeping the Same Bathing Frequency Year-Round', "Using the same bathing schedule regardless of season ignores how much drier winter air and indoor heating make the skin."],
        ['❌ Skipping Paw Protection for "Just a Quick Walk"', "Even short walks on cold or salted surfaces expose paws to irritants — protection matters regardless of walk length."],
        ['❌ Not Rinsing Off Road Salt', "Leaving road salt on paws means your dog can lick it off later, ingesting a mild irritant along with tracking it through the house."],
        ['❌ Assuming Double-Coated Dogs "Don\'t Feel the Cold"', "Even naturally cold-tolerant breeds benefit from winter-specific adjustments — the coat helps, but it doesn't make winter care unnecessary."],
        ['❌ Over-Bathing to Deal With Winter Mud', "Bathing more often to manage mud tracked in from walks only compounds the dryness winter is already causing — spot-cleaning is often the better call."],
    ];
}

/* ── Dog Summer Grooming (Summer Cooling & Grooming Planner) — What Is / Why / Steps / Tips / Mistakes ── */

function pz_what_is_dog_summer_grooming() {
    ob_start(); ?>
    <p>The Summer Cooling & Grooming Planner builds a heat-season routine from your dog's coat type, your local climate, and their activity level, because effective summer cooling comes from a specific set of grooming and safety habits — not from cutting the coat shorter, which is the single most common misconception in summer dog care.</p>
    <p>Getting summer grooming wrong carries real risk: shaving a double coat for "cooling" actually backfires, providing no real cooling benefit while stripping away UV and insulation protection and creating a risk of abnormal, patchy regrowth, and combined with hot pavement or overexertion in heat and humidity, the result can escalate to genuine heatstroke.</p>
    <p>Select your coat type, climate, and activity level above to get your summer-adjusted routine, then scroll down for the reasoning behind it and the FAQ covering the summer care questions dog owners ask most.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_summer_grooming() {
    ob_start(); ?>
    <p>Summer heat creates specific, serious risks that a proper grooming and activity routine directly addresses. Here's why it matters:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🚫</span>
        <div>
          <strong>Shaving Double Coats Is a Harmful Myth</strong>
          <p>Shaving a double coat for cooling doesn't work as intended and actually removes real UV and insulation protection — this misconception needs direct correction, not repetition.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🔴</span>
        <div>
          <strong>Hot Spots Develop Fast in Summer</strong>
          <p>Trapped moisture from swimming or humidity creates ideal conditions for hot spots to develop quickly, often within a day of the moisture exposure.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🥵</span>
        <div>
          <strong>Hot Pavement Causes Real Paw Burns</strong>
          <p>Pavement temperature climbs well above air temperature in direct sun, and most owners underestimate how quickly it can burn unprotected paw pads.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🚨</span>
        <div>
          <strong>Heatstroke Is a Genuine Emergency Risk</strong>
          <p>High activity in hot, humid climates raises real heatstroke risk — this is a medical emergency, not just a discomfort issue.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_summer_grooming() {
    return [
        ['title'=>"Select Your Dog's Coat Type", 'desc'=>"Choose your dog's coat type — double, single, or curly coats each need a different summer grooming approach."],
        ['title'=>'Select Your Climate', 'desc'=>"Indicate your local summer climate, including humidity level, since humidity directly affects how well panting cools your dog."],
        ['title'=>'Select Your Activity Level', 'desc'=>"Choose how active your dog typically is outdoors in summer — higher activity in heat raises the stakes on every other recommendation."],
        ['title'=>'Get Your Summer-Adjusted Routine', 'desc'=>"Based on coat, climate, and activity, you'll receive a specific brushing schedule and heat-safety guidance built for your dog's situation."],
        ['title'=>'Increase Brushing to Clear Undercoat', 'desc'=>"Instead of shaving, increase brushing frequency to actively clear loose undercoat — this is the grooming step that genuinely helps with cooling."],
        ['title'=>'Apply Pavement and Heatstroke Safety Checks', 'desc'=>"Before any hot-weather outing, run the pavement hand-test and know the early heatstroke warning signs before heading out."],
    ];
}

function pz_tips_dog_summer_grooming() {
    return [
        ['Brush Out Loose Undercoat Aggressively', "Thorough brushing to remove loose undercoat is the real cooling lever in summer — not cutting the coat shorter."],
        ['Dry Thoroughly After Swimming', "Dry your dog fully after swimming, paying particular attention to skin folds and ears, where trapped moisture causes the most problems."],
        ['Walk During Cooler Parts of the Day', "Early morning or late evening walks avoid peak pavement and air temperature, reducing both paw burn and heatstroke risk."],
        ['Bring Water on Any Extended Outdoor Activity', "Always carry water for activities longer than a short walk — hydration is a key part of heat regulation."],
        ['Know the Early Heatstroke Signs', "Heavy panting, excessive drooling, and weakness are early signs worth knowing before they escalate into an emergency."],
    ];
}

function pz_mistakes_dog_summer_grooming() {
    return [
        ['❌ Shaving a Double Coat "to Help With Heat"', "This widely repeated myth causes real harm — it removes UV and insulation protection without providing the cooling benefit owners expect."],
        ['❌ Walking on Hot Pavement Without Testing It First', "Skipping the hand-test before a summer walk means finding out the pavement is too hot only after your dog's paws are already burned."],
        ['❌ Underestimating Humidity\'s Role in Cooling', "Dogs cool primarily through panting, and high humidity reduces how effectively panting can dissipate heat — humidity matters as much as temperature."],
        ['❌ Skipping Post-Swim Drying', "Leaving your dog's coat and skin folds wet after swimming creates the trapped-moisture conditions that lead directly to hot spots."],
        ['❌ Pushing Normal Exercise Levels During a Heat Wave', "Sticking to a normal activity routine when temperatures spike significantly raises heatstroke risk — activity should scale down with the heat."],
    ];
}

/* ── Dog Mat Removal (Mat Severity Assessor) — What Is / Why / Steps / Tips / Mistakes ── */

function pz_what_is_dog_mat_removal() {
    ob_start(); ?>
    <p>The Mat Severity Assessor evaluates a mat's size, location, and your dog's coat type to tell you whether it's safe to handle at home or needs a professional groomer, because mat severity genuinely changes what technique is safe — this isn't advice that applies the same way to every mat.</p>
    <p>Attempting to cut out a large or pelted mat at home carries real risk: skin under a tight mat tents upward, invisible from outside, which means scissors can cut skin without any warning sign beforehand, and leaving a mat untreated makes it worse over time while potentially hiding a skin infection developing underneath it.</p>
    <p>Enter the mat's size, location, and your dog's coat type above to get your DIY-safe or professional recommendation, then scroll down for the reasoning behind it and the FAQ covering the mat removal questions dog owners ask most.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_mat_removal() {
    ob_start(); ?>
    <p>Not every mat is the same, and treating them all the same way is where the real risk comes in. Here's why severity assessment matters before you reach for scissors:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">📏</span>
        <div>
          <strong>Mat Severity Genuinely Determines Safe Technique</strong>
          <p>A small, loose mat and a large, pelted one call for completely different approaches — severity isn't a minor detail, it's the deciding factor.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⚠️</span>
        <div>
          <strong>Skin Under Mats Tents Upward, Invisibly</strong>
          <p>Tight mats pull skin up with them, so scissors that look like they're cutting only hair can cut skin without any visible warning beforehand.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🦠</span>
        <div>
          <strong>Pelted Coats Can Hide Skin Infection</strong>
          <p>Dense matting traps moisture and bacteria against the skin, which means an infection can be developing underneath without any outward sign until the mat is removed.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⏱️</span>
        <div>
          <strong>Early Action Prevents Escalation</strong>
          <p>Correctly handling a small mat now prevents it from growing into a large, professional-only situation later.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_mat_removal() {
    return [
        ['title'=>"Assess the Mat's Size", 'desc'=>"Estimate how large the mat is — small, medium, or large — since size is one of the primary factors in whether home removal is safe."],
        ['title'=>"Assess the Mat's Location", 'desc'=>"Note where the mat is located — matts near sensitive areas like the groin or behind the ears carry more risk than mats on the body."],
        ['title'=>"Note Your Dog's Coat Type", 'desc'=>"Identify your dog's coat type, since some coats mat more severely and pelted sections form differently depending on coat texture."],
        ['title'=>'Get Your DIY-Safe or Professional Recommendation', 'desc'=>"Based on size, location, and coat type, you'll receive a clear recommendation on whether this mat is safe to handle at home."],
        ['title'=>'If DIY, Loosen From the Edges First', 'desc'=>"Work the mat loose gradually from its outer edges using fingers and a comb, treating patience across more than one session as the safer approach."],
        ['title'=>"If Large or Widespread, Book a Professional", 'desc'=>"For large or pelted mats, book a professional groomer rather than attempting scissors — this is where the skin-injury risk is highest."],
    ];
}

function pz_tips_dog_mat_removal() {
    return [
        ['Work in Short Sessions With Treats', "Mat removal is stressful for most dogs — short sessions paired with treats keep the experience manageable for both of you."],
        ['Always Apply Detangling Spray First', "Detangling spray softens the mat before combing, making it meaningfully easier and safer to work loose."],
        ['Hold Scissors Parallel to Skin, Never Perpendicular', "If any cutting is genuinely needed, scissors held parallel to the skin avoid the risk of cutting into tented skin underneath."],
        ['Check for Skin Issues Once a Mat Is Removed', "Look for redness or odor once a mat comes out — mats often hide skin problems that need separate attention."],
        ['Prevent Through Regular Brushing', "Consistent brushing is far less work over time than any mat removal method, and it stops most mats from forming in the first place."],
    ];
}

function pz_mistakes_dog_mat_removal() {
    return [
        ['❌ Cutting Into a Mat With Scissors Held Perpendicular', "Scissors angled into the skin rather than parallel to it carry a real risk of cutting skin that's tented up inside the mat."],
        ['❌ Trying to Fully Remove a Large Mat in One Session', "Attempting to finish a large or pelted mat in a single home session increases stress on your dog and the risk of rushed, unsafe cutting."],
        ['❌ Ignoring What\'s Underneath Once a Mat Is Removed', "Skin under a removed mat often needs its own attention — skipping this check misses redness, irritation, or infection."],
        ['❌ Using a Dry Comb With No Detangling Product', "Combing a tight mat with no detangling spray first makes the process harder and more likely to hurt or stress your dog."],
        ['❌ Delaying Action on a Small Mat', "A small mat left untreated tends to grow larger over time, eventually becoming a situation that needs a professional instead of a quick fix."],
    ];
}

/* ── Dog Tail Grooming (Tail Coat Care Planner) — What Is / Why / Steps / Tips / Mistakes ── */

function pz_what_is_dog_tail_grooming() {
    ob_start(); ?>
    <p>The Tail Coat Care Planner builds a tail-specific brushing routine from your dog's coat type and feathering density, because the tail base and under-tail area is a commonly overlooked mat zone that needs its own attention separate from general body-coat brushing.</p>
    <p>Neglecting tail-specific care has a real, specific consequence: feathered tails mat at the base and near the anus, and because owners typically focus their attention on the body coat, this trapped fur causes skin irritation and hygiene issues that go unnoticed until they're already uncomfortable for your dog.</p>
    <p>Select your dog's coat type and feathering density above to get your tail-specific routine, then scroll down for the reasoning behind it and the FAQ covering the tail care questions dog owners ask most.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_tail_grooming() {
    ob_start(); ?>
    <p>The tail is easy to overlook during a normal grooming routine, but it has specific needs of its own. Here's why it deserves deliberate attention:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🙈</span>
        <div>
          <strong>A Commonly Overlooked Mat Zone</strong>
          <p>The tail base and under-tail area mat easily but rarely get the same brushing attention as the more visible parts of the body coat.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🧼</span>
        <div>
          <strong>Hygiene Matters Specifically Here</strong>
          <p>Fecal matter and debris trapped in under-tail fur cause irritation in a way that's specific to this area and easy to miss without a direct check.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🪶</span>
        <div>
          <strong>Heavy Feathering Needs Standalone Attention</strong>
          <p>Feathered tails often need more frequent brushing than the body coat interval alone would suggest, even on otherwise low-maintenance dogs.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">✅</span>
        <div>
          <strong>Often the Last Area Checked</strong>
          <p>Because it's out of sight during normal handling, the tail deserves a deliberate spot on your routine rather than being left to chance.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_tail_grooming() {
    return [
        ['title'=>"Select Your Dog's Coat Type", 'desc'=>"Choose your dog's coat type, since coat texture affects how quickly the tail area tangles or mats."],
        ['title'=>'Select Feathering Density', 'desc'=>"Indicate how much feathering your dog's tail has — light, moderate, or heavy — since this drives how much standalone attention the tail needs."],
        ['title'=>'Get Your Tail-Specific Brushing Focus', 'desc'=>"Based on coat type and feathering density, you'll receive a specific brushing focus and frequency for the tail area."],
        ['title'=>'Brush Base and Under-Tail Even Between Full-Body Sessions', 'desc'=>"Give the tail base and under-tail area brushing attention on its own schedule, not only when you're doing a full-body session."],
        ['title'=>'Check for Trapped Debris After Loose Stool', 'desc'=>"After any loose-stool episode, check the under-tail area specifically for trapped debris that a normal glance might miss."],
        ['title'=>'Trim Excess Fur if Hygiene Issues Recur', 'desc'=>"If hygiene problems keep coming back, a light trim of excess fur under the tail can reduce how often debris gets trapped there."],
    ];
}

function pz_tips_dog_tail_grooming() {
    return [
        ['Check Under-Tail Fur After Diarrhea Episodes', "This is a commonly overlooked hygiene moment — a quick check after any loose-stool episode catches trapped debris early."],
        ['Consider a Light Hygiene Trim on Heavy Feathering', "Even on an otherwise long-coat dog, a light trim around the hygiene area reduces how often debris and moisture get trapped there."],
        ['Brush the Tail Base Separately', "The tail base is a common blind spot during full-body sessions — give it deliberate, separate attention."],
        ['Use Detangling Spray on Feathered Tails', "Feathered tails are prone to static and tangling — a detangling spray makes brushing noticeably easier."],
        ['Watch for Scooting', "Scooting can indicate tail-area irritation, not just anal glands — check the tail and under-tail area as part of ruling out the cause."],
    ];
}

function pz_mistakes_dog_tail_grooming() {
    return [
        ['❌ Only Brushing the Visible Top of the Tail', "Focusing on the top of the tail while missing the base and underside leaves the areas most prone to matting unaddressed."],
        ['❌ Assuming Light Coats Need Zero Tail Attention', "Even light-coated dogs benefit from an occasional tail check — minimal fur doesn't mean the area can be skipped entirely."],
        ['❌ Not Checking Under-Tail Fur After Loose Stool', "Skipping a check after diarrhea means trapped debris can sit against the skin unnoticed, causing irritation."],
        ['❌ Letting Heavy Feathering Go as Long as the Body Coat', "Heavy feathering often needs more frequent attention than the general body-coat interval — treating them the same lets tangles build up."],
        ['❌ Missing Tail-Base Mats During Normal Brushing', "The tail base is harder to see during routine brushing, which means mats there are easy to miss until they're already established."],
    ];
}

/* ── Professional vs Home Dog Grooming (Cost & Time Comparison) — What Is / Why / Steps / Tips / Mistakes ── */

function pz_what_is_pro_vs_home_grooming() {
    ob_start(); ?>
    <p>The Professional vs Home: Cost & Time Comparison tool weighs your dog's coat type against your available weekly time and budget comfort to give you a named recommendation — Home, Professional, or Hybrid — because this decision genuinely depends on your specific situation, not just personal preference.</p>
    <p>Choosing the wrong path has a real cost: going all-home for a high-maintenance coat without enough actual available time leads to matting and neglect that ends up needing a professional anyway, while going all-professional for a low-maintenance coat means spending money on visits your dog's coat didn't really require.</p>
    <p>Select your coat type, weekly time, and budget comfort above to get your named recommendation, then scroll down for the reasoning behind it and the FAQ covering the questions dog owners ask most when weighing this decision.</p>
    <?php return ob_get_clean();
}

function pz_why_important_pro_vs_home_grooming() {
    ob_start(); ?>
    <p>This isn't a decision with one right answer for every owner — it depends on real factors that are worth being honest about. Here's why the comparison matters:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🐕</span>
        <div>
          <strong>Coat Type Genuinely Changes the Calculus</strong>
          <p>A low-maintenance smooth coat and a high-maintenance double or curly coat need very different amounts of ongoing attention — this isn't just personal preference.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⏰</span>
        <div>
          <strong>Time-Honesty Prevents the Most Common Failure</strong>
          <p>The most common failure mode is starting home-only, then falling behind as life gets busy — being honest about actual available time upfront avoids this.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🔀</span>
        <div>
          <strong>Hybrid Is Rarely Considered as a Named Option</strong>
          <p>A hybrid approach — home maintenance between periodic professional visits — is often the optimal choice but rarely gets considered as its own distinct path.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💲</span>
        <div>
          <strong>Cost Transparency Beats Vague Assumptions</strong>
          <p>Seeing real annual numbers side by side helps a decision that's often made on rough guesses about what each path actually costs.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_pro_vs_home_grooming() {
    return [
        ['title'=>"Select Your Dog's Coat Type", 'desc'=>"Choose your dog's coat type, since maintenance needs vary significantly between smooth, double, curly, and wire coats."],
        ['title'=>'Select Your Available Weekly Time', 'desc'=>"Be honest about how much time you can realistically commit to grooming each week — not how much you'd like to have, but what you actually have."],
        ['title'=>'Select Your Budget Comfort', 'desc'=>"Indicate how comfortable you are with recurring professional grooming costs versus a lower ongoing spend on home tools and supplies."],
        ['title'=>'Get Your Named Recommendation and Reasoning', 'desc'=>"Based on coat, time, and budget, you'll receive a specific Home, Professional, or Hybrid recommendation along with the reasoning behind it."],
        ['title'=>'See the 3-Way Annual Cost Comparison', 'desc'=>"Review the estimated annual cost for all three approaches side by side to understand the real financial picture, not just the per-visit sticker price."],
        ['title'=>'Revisit if Circumstances Change', 'desc'=>"Re-run the comparison if your available time or budget changes significantly — the right answer for you now may not be the right answer in a year."],
    ];
}

function pz_tips_pro_vs_home_grooming() {
    return [
        ['Brush at Home Even With a "Professional" Recommendation', "Even when Professional is the right call, basic home brushing between visits keeps the coat in better condition and can space out appointments."],
        ['Buy a Coat-Matched Brush Regardless of Path', "A good, coat-appropriate brush is worth owning no matter which path you choose — it supports whichever routine you settle on."],
        ['Ask Your Groomer for a Technique Demo', "Request a quick demo of one technique during a professional visit to build home skills gradually over time."],
        ['Re-Run This Comparison When Life Changes', "A new job, a new baby, or any major schedule shift is a good reason to revisit this decision rather than sticking with an outdated answer."],
        ['Consider Hybrid Before Defaulting to All-or-Nothing', "Most owners default to thinking in all-home or all-professional terms — Hybrid is underrated and often the best practical fit."],
    ];
}

function pz_mistakes_pro_vs_home_grooming() {
    return [
        ['❌ Choosing All-Home for a High-Maintenance Coat Without Enough Time', "Committing to home-only grooming for a coat that needs frequent attention, without being honest about available time, is a common path to matting and neglect."],
        ['❌ Assuming Professional Grooming Replaces All Home Care', "Professional visits don't eliminate the need for brushing between appointments — home maintenance still matters even on a Professional plan."],
        ['❌ Not Budgeting for the Real Annual Cost', "Committing to a path without estimating its true yearly cost often leads to an unpleasant surprise once visits or supplies add up."],
        ['❌ Treating the Choice as Permanent', "This decision doesn't need to be made once and never revisited — circumstances change, and the right path can change with them."],
        ['❌ Comparing Only Sticker Cost Per Visit', "Looking at cost per visit alone, without factoring in how often that visit needs to happen, gives a misleading picture of the real annual cost."],
    ];
}

function pz_get_checker_questions($tool) {
    $a = $tool['animal'] ?? 'pet';

    $questions = [
        'fish' => [
            ['q' => 'Is your fish eating normally?', 'opts' => ['yes' => 'Yes, eating well', 'less' => 'Eating less than usual', 'no' => 'Refusing all food', 'unknown' => 'Haven\'t checked']],
            ['q' => 'How is your fish swimming?', 'opts' => ['normal' => 'Normal and active', 'sluggish' => 'Sluggish or slow', 'abnormal' => 'Floating, sinking, or spinning', 'bottom' => 'Staying at bottom or surface']],
            ['q' => 'Any visible physical changes?', 'opts' => ['none' => 'No visible changes', 'spots' => 'Spots, patches, or discoloration', 'fins' => 'Fin damage or rot', 'bloat' => 'Bloating or unusual shape']],
            ['q' => 'What do the droppings look like?', 'opts' => ['normal' => 'Normal (dark, short strings)', 'white' => 'White or stringy', 'unusual' => 'Unusual color', 'unchecked' => 'Haven\'t noticed']],
            ['q' => 'How is the water quality?', 'opts' => ['good' => 'Tested recently — all good', 'untested' => 'Haven\'t tested recently', 'off' => 'Parameters are off', 'cloudy' => 'Tank looks cloudy']],
        ],
        'bird' => [
            ['q' => 'Is your bird eating and drinking normally?', 'opts' => ['yes' => 'Yes, normal appetite', 'less' => 'Eating less than usual', 'no' => 'Refusing food or water', 'unknown' => 'Hard to tell']],
            ['q' => 'How is your bird\'s energy and behavior?', 'opts' => ['normal' => 'Active and vocal as usual', 'quiet' => 'Quieter than normal', 'fluffed' => 'Fluffed up and sleepy', 'still' => 'Not moving much']],
            ['q' => 'What do the droppings look like?', 'opts' => ['normal' => 'Normal (dark green/white)', 'watery' => 'Watery or very loose', 'unusual' => 'Unusual color (yellow, red, black)', 'unchecked' => 'Haven\'t checked']],
            ['q' => 'Any physical signs of illness?', 'opts' => ['none' => 'No visible signs', 'discharge' => 'Nasal or eye discharge', 'feathers' => 'Feather loss or over-preening', 'swelling' => 'Swelling or injury']],
            ['q' => 'Is your bird breathing normally?', 'opts' => ['yes' => 'Yes, breathing normally', 'tail' => 'Tail bobbing when breathing', 'open' => 'Open-beak breathing', 'wheeze' => 'Wheezing or clicking sounds']],
        ],
        'reptile' => [
            ['q' => 'Is your reptile eating normally?', 'opts' => ['yes' => 'Yes, eating on schedule', 'skipped' => 'Skipped one feeding', 'refusing' => 'Refusing food for 2+ weeks', 'brumation' => 'In brumation/normal fast']],
            ['q' => 'How is your reptile\'s activity level?', 'opts' => ['normal' => 'Active and responsive', 'low' => 'Slightly less active', 'lethargic' => 'Very lethargic or unresponsive', 'mobility' => 'Unable to move normally']],
            ['q' => 'Any shedding problems?', 'opts' => ['good' => 'Shed went well', 'partial' => 'Partial shed or stuck pieces', 'cloudy' => 'Eyes cloudy without upcoming shed', 'none' => 'No recent shed']],
            ['q' => 'How do the droppings look?', 'opts' => ['normal' => 'Normal for this species', 'runny' => 'Runny or unusual color', 'none' => 'No droppings in 2+ weeks', 'unchecked' => 'Haven\'t checked']],
            ['q' => 'Are temperatures and humidity correct?', 'opts' => ['yes' => 'Yes, checked recently', 'unsure' => 'Not sure — need to check', 'off' => 'Equipment seems off', 'unchecked' => 'Haven\'t checked in a while']],
        ],
        'rabbit' => [
            ['q' => 'Is your rabbit eating hay and drinking water?', 'opts' => ['yes' => 'Yes, eating hay and drinking normally', 'less' => 'Eating less hay than usual', 'no' => 'Refusing food completely', 'unknown' => 'Hard to tell']],
            ['q' => 'Are you seeing normal droppings?', 'opts' => ['yes' => 'Yes, normal round pellets', 'fewer' => 'Fewer droppings than usual', 'none' => 'No droppings for several hours', 'soft' => 'Soft or misshapen droppings']],
            ['q' => 'How is your rabbit\'s energy and behavior?', 'opts' => ['normal' => 'Active and curious', 'quiet' => 'Quieter than usual', 'hiding' => 'Hiding and hunched posture', 'flat' => 'Lying flat and unresponsive']],
            ['q' => 'Any physical signs to report?', 'opts' => ['none' => 'No visible signs', 'discharge' => 'Runny nose or wet eyes', 'wet' => 'Wet chin or dewlap', 'tilt' => 'Tilted head or loss of balance']],
            ['q' => 'Does your rabbit\'s belly feel normal?', 'opts' => ['normal' => 'Feels normal when gently touched', 'gassy' => 'Seems gassy or bloated', 'pain' => 'Tooth grinding or signs of pain', 'unchecked' => 'Haven\'t checked']],
        ],
    ];

    // Default (dog, cat, general)
    $default_questions = [
        ['q' => 'Is your pet eating normally?', 'opts' => ['yes' => 'Yes, normal appetite', 'less' => 'Eating less than usual', 'no' => 'Refusing all food', 'unknown' => 'Hard to tell']],
        ['q' => 'How is your pet\'s energy level?', 'opts' => ['normal' => 'Normal and active', 'lower' => 'Slightly low energy', 'very_low' => 'Very lethargic', 'unable' => 'Unable to stand or move']],
        ['q' => 'Any vomiting or diarrhea in the last 24 hours?', 'opts' => ['none' => 'No symptoms', 'once' => 'Once or twice', 'frequent' => 'Multiple times', 'blood' => 'Vomiting with blood']],
        ['q' => 'Is your pet drinking water normally?', 'opts' => ['normal' => 'Yes, drinking normally', 'less' => 'Drinking less than usual', 'more' => 'Drinking much more than usual', 'none' => 'Not drinking at all']],
        ['q' => 'Any visible injuries, swelling, or discharge?', 'opts' => ['none' => 'No visible signs', 'mild' => 'Minor discharge from eyes or nose', 'swelling' => 'Swelling or limping', 'severe' => 'Open wound or severe injury']],
    ];

    return isset($questions[$a]) ? $questions[$a] : $default_questions;
}

function pz_section_what_is($tool) {
    if (!empty($tool['calc']) && function_exists('pz_what_is_' . $tool['calc'])) {
        return call_user_func('pz_what_is_' . $tool['calc']);
    }
    $a    = $tool['animal'] === 'all' ? 'pet' : $tool['animal'];
    $al   = ucfirst($a);
    $t    = esc_html($tool['title']);
    $kw   = ! empty($tool['kw']) ? esc_html($tool['kw']) : strtolower($t);
    $type = $tool['type'] ?? 'guide';

    // Secondary keyword lookup by animal + type
    $secondary_kw_map = [
        'dog' => [
            'calculator' => 'how much should I feed my dog per day',
            'checker'    => 'dog health symptoms checker',
            'guide'      => 'dog care tips for owners',
            'tracker'    => 'dog health tracking',
        ],
        'cat' => [
            'calculator' => 'cat feeding guide by weight',
            'checker'    => 'cat illness symptoms',
            'guide'      => 'cat care advice',
            'tracker'    => 'cat health log',
        ],
        'fish' => [
            'calculator' => 'aquarium water parameters',
            'checker'    => 'fish disease symptoms',
            'guide'      => 'fish tank care guide',
            'tracker'    => 'fish tank maintenance log',
        ],
        'bird' => [
            'calculator' => 'pet bird diet calculator',
            'checker'    => 'sick bird symptoms',
            'guide'      => 'pet bird care tips',
            'tracker'    => 'bird health log',
        ],
        'reptile' => [
            'calculator' => 'reptile habitat requirements',
            'checker'    => 'sick reptile signs',
            'guide'      => 'reptile care for beginners',
            'tracker'    => 'reptile feeding log',
        ],
        'rabbit' => [
            'calculator' => 'rabbit diet and feeding guide',
            'checker'    => 'rabbit health symptoms',
            'guide'      => 'rabbit care tips',
            'tracker'    => 'rabbit health log',
        ],
        'all' => [
            'calculator' => 'pet care calculator',
            'checker'    => 'pet health symptoms',
            'guide'      => 'pet care guide',
            'tracker'    => 'pet health tracker',
        ],
    ];

    $animal_key = isset($secondary_kw_map[$a]) ? $a : 'all';
    $secondary  = esc_html($secondary_kw_map[$animal_key][$type] ?? 'pet care guide');

    // Paragraph 1 — define the tool, use focus keyword in first sentence
    $p1_map = [
        'calculator' => "The <strong>{$t}</strong> helps {$a} owners calculate <em>{$kw}</em> quickly and accurately. Whether you're working this out for the first time or rechecking after a change in your {$a}'s weight, age, or activity level, this tool gives you a vet-informed starting point based on established veterinary formulas.",
        'checker'    => "The <strong>{$t}</strong> is a structured, vet-informed resource for {$a} owners who want to evaluate <em>{$kw}</em> without guesswork. Instead of searching through unreliable forums, this checker walks you through the key questions vets ask first — giving you a proportionate, level-headed assessment in under two minutes.",
        'guide'      => "The <strong>{$t}</strong> is a comprehensive, vet-reviewed resource covering every aspect of <em>{$kw}</em> for {$a} owners. Whether you're brand new to owning a {$a} or looking to sharpen your existing care routine, this guide gives you structured, species-appropriate information built on current veterinary best practices.",
        'tracker'    => "The <strong>{$t}</strong> helps {$a} owners monitor <em>{$kw}</em> consistently over time. Tracking key health indicators — rather than relying on memory — is one of the most practical things you can do to catch gradual changes before they become serious health concerns.",
    ];
    $p1 = $p1_map[$type] ?? $p1_map['guide'];

    // Paragraph 2 — animal-specific, use secondary keyword naturally
    $consequence_map = [
        'dog'     => [
            'calculator' => 'overfeeding and obesity — the leading preventable health problem in dogs',
            'checker'    => 'delayed diagnosis of conditions that are treatable when caught early',
            'guide'      => 'inconsistent care that causes preventable health and behavioral problems',
            'tracker'    => 'missing gradual changes that only become visible in trend data',
        ],
        'cat'     => [
            'calculator' => 'chronic overweight conditions and related diseases like diabetes and joint disease',
            'checker'    => 'missing serious illness — cats hide pain and discomfort instinctively',
            'guide'      => 'common but preventable issues like urinary disease, obesity, and dental disease',
            'tracker'    => 'slow health decline that shows in trends long before obvious symptoms appear',
        ],
        'fish'    => [
            'calculator' => 'poor water quality from excess waste — the number one cause of fish disease',
            'checker'    => 'rapid disease spread through the tank before you can intervene',
            'guide'      => 'avoidable losses from water quality issues, incompatible species, or incorrect setup',
            'tracker'    => 'missing early parameter shifts that signal tank health problems',
        ],
        'bird'    => [
            'calculator' => 'nutritional deficiencies that develop gradually and are often irreversible by the time symptoms show',
            'checker'    => 'missing the early, subtle signs birds show before becoming critically ill',
            'guide'      => 'preventable issues like feather destruction, nutritional disease, and toxin exposure',
            'tracker'    => 'missing behavioral and physical changes that appear slowly over weeks',
        ],
        'reptile' => [
            'calculator' => 'incorrect feeding that causes obesity, impaction, or nutritional deficiencies',
            'checker'    => 'delayed treatment of conditions like metabolic bone disease or respiratory infection',
            'guide'      => 'husbandry errors — temperature, humidity, and lighting mistakes cause most reptile illness',
            'tracker'    => 'missing the gradual decline that precedes most serious reptile health events',
        ],
        'rabbit'  => [
            'calculator' => 'gut imbalances and GI stasis — a life-threatening emergency that develops from improper diet',
            'checker'    => 'missing early warning signs of GI stasis, which becomes critical within hours',
            'guide'      => 'preventable problems including GI stasis, dental disease, and housing-related injuries',
            'tracker'    => 'missing the subtle changes in eating and droppings that signal GI trouble early',
        ],
        'all'     => [
            'calculator' => 'errors that affect your pet\'s long-term health',
            'checker'    => 'delayed diagnosis of treatable conditions',
            'guide'      => 'preventable health and behavioral problems',
            'tracker'    => 'missing gradual health changes that trends reveal',
        ],
    ];
    $consequence = esc_html($consequence_map[$animal_key][$type] ?? 'preventable health problems');

    $p2_map = [
        'calculator' => "For {$a} owners, <em>{$secondary}</em> is one of the most common questions — and one of the most important to get right. Getting it wrong can lead to {$consequence}. This calculator removes the guesswork by applying the same weight-and-activity formulas used in veterinary practice, adjusted for your {$a}'s specific profile.",
        'checker'    => "For {$a} owners, knowing how to assess <em>{$secondary}</em> accurately is an essential skill. Getting this wrong can lead to {$consequence}. This checker provides a structured framework — the kind of systematic observation vets use — so you can respond proportionately rather than either panicking or dismissing something serious.",
        'guide'      => "For {$a} owners, understanding <em>{$secondary}</em> thoroughly is what separates reactive care from proactive care. Gaps in care knowledge can lead to {$consequence}. This guide covers the full picture — from daily routines to warning signs — so you have a reliable reference for every stage of your {$a}'s life.",
        'tracker'    => "For {$a} owners, consistent <em>{$secondary}</em> is one of the highest-value habits you can build. Without it, you're relying on memory and impression rather than data. Missing gradual changes can mean {$consequence}. This tracker gives you a simple, repeatable system to build that habit.",
    ];
    $p2 = $p2_map[$type] ?? $p2_map['guide'];

    // Paragraph 3 — how to use, CTA-style
    $p3_map = [
        'calculator' => "Use the calculator above to get your personalized result, then scroll down for vet-backed tips specific to {$a} owners, a complete warning signs reference, and answers to the most common questions {$a} owners ask about {$kw}.",
        'checker'    => "Use the checker above to complete your assessment, then read on for vet-backed guidance on the warning signs that need immediate attention, common mistakes {$a} owners make, and a detailed FAQ written for the questions people actually type into search engines.",
        'guide'      => "Work through this guide from top to bottom for the most complete picture, or use the Table of Contents to jump to the section most relevant to you right now. The FAQ at the bottom answers the specific questions {$a} owners ask most often about {$kw}.",
        'tracker'    => "Set up your tracking routine using the tool above, then read through the tips and warning signs sections below — they'll help you know what to track, what changes matter, and when a trend warrants a call to your vet.",
    ];
    $p3 = $p3_map[$type] ?? $p3_map['guide'];

    $html  = '<p>' . $p1 . '</p>';
    $html .= '<p>' . $p2 . '</p>';
    $html .= '<p>' . $p3 . '</p>';

    return $html;
}

function pz_section_why_important($tool) {
    if (!empty($tool['calc']) && function_exists('pz_why_important_' . $tool['calc'])) {
        return call_user_func('pz_why_important_' . $tool['calc']);
    }
    $a = ucfirst($tool['animal'] === 'all' ? 'pet' : $tool['animal']);
    ob_start(); ?>
    <p>Many <?php echo strtolower($a); ?> owners rely on guesswork or outdated information when it comes to their pet's care. This can lead to preventable health problems, unnecessary vet bills, and a lower quality of life for your companion.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">💰</span>
        <div>
          <strong>Save Money</strong>
          <p>Prevent costly vet visits by catching issues early and following proper care routines.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">❤️</span>
        <div>
          <strong>Longer, Healthier Life</strong>
          <p>Pets with attentive owners who follow consistent, science-based care routines tend to stay healthier and catch problems earlier.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🔬</span>
        <div>
          <strong>Vet-Approved Methods</strong>
          <p>All information in this guide is reviewed by licensed veterinary professionals.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⚡</span>
        <div>
          <strong>Early Detection</strong>
          <p>Knowing what's normal for your <?php echo strtolower($a); ?> helps you spot health problems before they become serious.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_section_steps($tool) {
    $a     = ucfirst($tool['animal'] === 'all' ? 'pet' : $tool['animal']);
    $steps = pz_get_steps_for_tool($tool);

    ob_start();
    ?>
    <p>Follow these vet-recommended steps for the best results with your <?php echo strtolower($a); ?>:</p>
    <ol class="pz-steps-list">
      <?php foreach($steps as $i=>$step): ?>
      <li itemprop="step" itemscope itemtype="https://schema.org/HowToStep">
        <div class="pz-step-num"><?php echo $i+1; ?></div>
        <div class="pz-step-body">
          <strong itemprop="name"><?php echo esc_html($step['title']); ?></strong>
          <p itemprop="text"><?php echo esc_html($step['desc']); ?></p>
        </div>
      </li>
      <?php endforeach; ?>
    </ol>
    <?php return ob_get_clean();
}

function pz_get_steps_for_tool($tool) {
    if (!empty($tool['calc']) && function_exists('pz_steps_' . $tool['calc'])) {
        return call_user_func('pz_steps_' . $tool['calc']);
    }
    $a = ucfirst($tool['animal'] === 'all' ? 'pet' : $tool['animal']);
    $type = $tool['type'];
    if ($type === 'calculator') {
        return [
            ['title'=>"Gather Your {$a}'s Information", 'desc'=>"Have your pet's weight, age, breed, and activity level ready. Accuracy of inputs directly affects the quality of your results."],
            ['title'=>'Enter Details into the Calculator Above', 'desc'=>"Fill in all fields in the interactive calculator. If you're unsure about any field, choose the closest option and consult your vet."],
            ['title'=>'Review Your Results', 'desc'=>"Read the personalized results carefully. Pay attention to the recommended ranges and any specific notes for your pet's profile."],
            ['title'=>'Create a Routine', 'desc'=>"Use the results to establish a consistent routine. Consistency is key to your pet's long-term health and wellbeing."],
            ['title'=>'Monitor and Adjust', 'desc'=>"Track your pet's response over 2-4 weeks. Adjust as needed based on changes in weight, energy, or health status."],
            ['title'=>'Schedule a Vet Check-In', 'desc'=>"Share your results with your veterinarian at your next visit. Professional guidance ensures your plan is appropriate for your individual pet."],
        ];
    } elseif ($type === 'checker') {
        return [
            ['title'=>'Observe Your Pet Calmly', 'desc'=>"Before answering the checker questions, spend 5-10 minutes observing your pet's behavior, appetite, and physical appearance in a calm environment."],
            ['title'=>'Answer All Questions Honestly', 'desc'=>"Complete the symptom checker above as accurately as possible. Choose the option that best describes what you've observed in the past 24-48 hours."],
            ['title'=>'Review the Risk Assessment', 'desc'=>"Read the checker results carefully. The color-coded risk level (green/yellow/red) indicates urgency of veterinary attention needed."],
            ['title'=>'Note Down Symptoms', 'desc'=>"Write down all symptoms you've noticed, including when they started, frequency, and any possible triggers or changes in environment."],
            ['title'=>'Contact Your Vet if Indicated', 'desc'=>"If the checker recommends veterinary attention, call your vet immediately. Provide them with your noted symptoms for faster diagnosis."],
            ['title'=>'Follow Up', 'desc'=>"After treatment or monitoring, re-run the checker after 24-48 hours to track improvement or worsening of symptoms."],
        ];
    } else {
        return [
            ['title'=>'Gather Your Pet Information', 'desc'=>"Enter your pet's name, age, breed, and weight into the guide tool above to receive personalized recommendations."],
            ['title'=>'Review Your Personalized Guide', 'desc'=>"Read through the customized guide generated for your specific pet. Every recommendation is tailored to your inputs."],
            ['title'=>'Download or Print the Guide', 'desc'=>"Use the PDF download button to save your personalized guide. Keep it handy for quick reference or share it with family members who help care for your pet."],
            ['title'=>'Create a Schedule', 'desc'=>"Based on the guide's recommendations, set up a care schedule. Use calendar reminders for recurring tasks."],
            ['title'=>'Implement Gradually', 'desc'=>"Don't change everything at once. Introduce new care routines gradually over 1-2 weeks to allow your pet to adjust comfortably."],
            ['title'=>'Track Progress', 'desc'=>"Keep a simple log of your pet's responses to new routines. Note improvements or any concerns that arise."],
            ['title'=>'Consult Your Veterinarian', 'desc'=>"Share this guide with your vet at your next appointment. They can validate the recommendations for your specific pet's health status."],
        ];
    }
}

function pz_inline_related_reading( $tool ) {
    $related = pz_get_related_tools( $tool['slug'], $tool['cat'], 2 );
    if ( empty( $related ) ) return '';

    $links = [];
    foreach ( $related as $rt ) {
        $links[] = '<a href="' . home_url( '/tools/' . $rt['slug'] . '/' ) . '">' . esc_html( $rt['title'] ) . '</a>';
    }
    $links_str = implode( ' and ', $links );

    $templates = [
        'For a fuller routine, pair this with LINKS — many owners use both together.',
        "Once you've got this dialed in, LINKS covers the next piece of the puzzle.",
        'This pairs naturally with LINKS if you want the complete picture.',
        'Many readers also check LINKS alongside this guide.',
        'See also: LINKS for related care steps.',
        'Worth reading next: LINKS.',
    ];
    // Deterministic per-tool pick so the same page always shows the same sentence, but different tools vary.
    $idx  = crc32( $tool['slug'] ) % count( $templates );
    $text = str_replace( 'LINKS', $links_str, $templates[ $idx ] );

    return '<p class="pz-inline-related">' . $text . '</p>';
}

function pz_section_tips($tool) {
    if (!empty($tool['calc']) && function_exists('pz_tips_' . $tool['calc'])) {
        $items = call_user_func('pz_tips_' . $tool['calc']);
        $html  = '<ul class="pz-tips-list">';
        foreach ($items as $tip) {
            $html .= '<li><strong>' . esc_html($tip[0]) . '</strong> — ' . esc_html($tip[1]) . '</li>';
        }
        $html .= '</ul>';
        $html .= '<div class="pz-info-box" style="margin-top:20px"><strong>💡 Pro Tip:</strong> The best pet care is preventive, not reactive. Building consistent habits now saves you stress, money, and unnecessary vet visits later.</div>';
        return $html;
    }
    $a    = ucfirst($tool['animal'] === 'all' ? 'pet' : $tool['animal']);
    $al   = strtolower($a);
    $type = $tool['type'] ?? 'guide';

    // Tips keyed by tool type so calculator/checker/guide/tracker each get relevant advice
    $tips_by_type = [
        'calculator' => [
            ['📏 Measure First, Input Second', "Get accurate measurements before using any calculator — estimated inputs produce estimated outputs. For weight-based tools, weigh your {$al} on a reliable pet scale rather than estimating."],
            ['🔄 Recalculate Regularly', "Results change as your {$al} ages, gains or loses weight, or changes activity levels. Revisit this calculator every 3 months or after any significant life change."],
            ['📋 Share Results With Your Vet', "Bring your calculator result to your next vet appointment. Vets appreciate when owners come prepared with specific numbers — it makes the conversation faster and more productive."],
            ['⚖️ Use as a Baseline, Not a Prescription', "Calculators give you a science-based starting point — your vet adjusts for your individual {$al}'s health history, medications, and breed-specific factors."],
            ['📱 Bookmark This Page', "Save this page so you can quickly recalculate whenever your {$al}'s needs change. A few minutes each quarter keeps your care plan accurate."],
        ],
        'checker' => [
            ['🕐 Time Your Observations', "Before checking symptoms, note when they started and how frequently they occur. Duration and frequency are the first things your vet will ask — have these details ready."],
            ['📸 Document With Photos or Video', "If your {$al} is showing physical symptoms, photograph them. Video is even better for behavioral or movement symptoms — it shows things that are hard to describe in words."],
            ['🧾 Keep a Simple Health Log', "Write down: date, symptom, severity (mild/moderate/severe), and what changed. This log becomes invaluable at vet appointments and helps you spot patterns over time."],
            ['🚫 Don\'t Search Symptoms Alone', "Search engines surface worst-case scenarios first. Use structured tools like this checker to get proportionate, level-headed guidance based on what you actually observe."],
            ['📞 When in Doubt, Call', "Most vets offer a quick phone consultation for symptom questions. A 5-minute call is always worth it when you're unsure whether to come in."],
        ],
        'guide' => [
            ['📖 Read All the Way Through First', "Skim the entire guide before acting on any one section. Context matters — a tip in section 4 might change how you approach section 2."],
            ['🗓️ Build Routines, Not One-Off Actions', "The best {$al} care happens on a consistent schedule. Use this guide to build weekly and monthly habits, not just one-time actions or emergency responses."],
            ['🤝 Involve Your Whole Household', "Everyone in the home who interacts with your {$al} should know the basics in this guide. Inconsistent care confuses animals and creates unnecessary stress."],
            ['📝 Annotate What Works For Your ' . $a, "Every {$al} is different. Note which tips work best for yours so you build a personalized care reference over time — one that reflects your specific animal."],
            ['🔗 Share With Your Vet', "Send your vet a link to this guide and ask which recommendations apply most strongly to your specific {$al}. This kind of preparation makes vet visits more efficient."],
        ],
        'tracker' => [
            ['📅 Set a Tracking Reminder', "Tracking only works if it's consistent. Set a weekly phone reminder to record your {$al}'s data — consistency is what turns individual data points into useful trends."],
            ['📊 Look for Trends, Not Just Numbers', "A single data point means little. After 4 weeks of tracking, look for trends — gradual changes often reveal health shifts before symptoms appear."],
            ['🏥 Bring Your Tracking Data to Vet Visits', "A month of logged data is worth more than your memory. Vets make better decisions with objective trend data than with your best recollection of recent changes."],
            ['🔔 Set Thresholds for Action', "Decide in advance: if X changes by more than Y, I will call the vet. This removes the guesswork and hesitation when something shifts — and makes you more likely to act early."],
            ['💾 Back Up Your Records', "Screenshot or export your tracking data regularly. Health records have long-term value — previous trends become important context at future vet appointments."],
        ],
    ];

    $tips = isset($tips_by_type[$type]) ? $tips_by_type[$type] : $tips_by_type['guide'];

    ob_start();
    echo '<ul class="pz-tips-list">';
    foreach ($tips as $tip) {
        echo '<li><strong>' . esc_html($tip[0]) . '</strong> — ' . esc_html($tip[1]) . '</li>';
    }
    echo '</ul>';
    echo '<div class="pz-info-box" style="margin-top:20px"><strong>💡 Pro Tip:</strong> The best pet care is preventive, not reactive. Building consistent habits now saves you stress, money, and unnecessary vet visits later.</div>';
    return ob_get_clean();
}

function pz_section_mistakes($tool) {
    if (!empty($tool['calc']) && function_exists('pz_mistakes_' . $tool['calc'])) {
        $items = call_user_func('pz_mistakes_' . $tool['calc']);
        $html  = '<div class="pz-mistakes-grid">';
        foreach ($items as $item) {
            $html .= '<div class="pz-mistake-card">';
            $html .= '<h3 class="pz-mistake-title">' . esc_html($item[0]) . '</h3>';
            $html .= '<p>' . esc_html($item[1]) . '</p>';
            $html .= '</div>';
        }
        $html .= '</div>';
        return $html;
    }
    $a = $tool['animal'] ?? 'pet';

    $mistakes_map = [
        'dog' => [
            ['❌ Overfeeding Based on Bag Guidelines', 'Feeding instructions on dog food bags are set by manufacturers — they tend to run high. Most dogs need 10-20% less than what the bag recommends, especially if they are spayed or neutered.'],
            ['❌ Skipping Dental Care', 'Over 80% of dogs show signs of dental disease by age 3. Daily tooth brushing or dental chews prevent painful infections that affect the heart and kidneys too.'],
            ['❌ Ignoring Weight Creep', 'A few extra pounds on a dog equals significant health strain. An overweight Labrador at 85 lbs vs. an ideal 70 lbs has 50% more stress on its joints.'],
            ['❌ Using Human Shampoo or Products', 'Human skin is pH 5.5; dog skin is pH 7.5. Human shampoos disrupt the skin barrier and lead to dryness, itching, and infection. Always use dog-specific grooming products.'],
            ['❌ Punishing Instead of Redirecting', 'Punishment-based training increases anxiety and aggression. Positive reinforcement (reward the behavior you want) is faster, kinder, and produces lasting results.'],
        ],
        'cat' => [
            ['❌ Free-Feeding Dry Kibble All Day', 'Cats are obligate carnivores designed to eat small, protein-rich meals. Constant access to dry food leads to obesity, urinary tract disease, and diabetes.'],
            ['❌ Skipping the Litter Box Cleaning', 'Cats are extremely clean animals. A dirty litter box is the number one cause of inappropriate elimination. Scoop daily; full change weekly.'],
            ['❌ Ignoring Water Intake', 'Cats evolved in deserts and have a low thirst drive. Most cats on dry food are chronically dehydrated. Add wet food or a cat water fountain to increase hydration.'],
            ['❌ Assuming Hiding Means "Fine"', 'Cats hide pain. A cat that hides more than usual, stops grooming, or loses interest in play may be ill — not just moody. Any behavioral change lasting 48+ hours warrants a vet call.'],
            ['❌ Declawing as a Solution', 'Declawing removes the last bone of each toe — equivalent to cutting human fingers at the first knuckle. It causes chronic pain, litter box avoidance, and increased biting.'],
        ],
        'bird' => [
            ['❌ Seed-Only Diet', 'A seed-only diet is the leading cause of malnutrition in pet birds. Seeds are high in fat and low in vitamins A, D, and calcium. Pellets plus fresh vegetables should make up 70-80% of the diet.'],
            ['❌ Non-Stick Cookware Fumes', 'PTFE (Teflon) coating releases fumes when overheated that are odorless to humans but fatal to birds within minutes. Use stainless steel, cast iron, or ceramic cookware in any home with birds.'],
            ['❌ Keeping Bird in Draft or Direct Sun', 'Birds are sensitive to temperature extremes. Avoid placing cages near air vents, windows with direct afternoon sun, or exterior walls.'],
            ['❌ Ignoring Beak and Nail Overgrowth', 'Overgrown beaks prevent eating; overgrown nails lead to perching injuries. Provide proper perch textures and schedule regular grooming.'],
            ['❌ Leaving Bird Alone for Long Hours Daily', 'Parrots and budgies are highly social. Consistent isolation leads to feather-destructive behavior, screaming, and self-mutilation. Birds need daily interaction or a companion bird.'],
        ],
        'fish' => [
            ['❌ Overstocking the Tank', 'Too many fish per gallon is the most common beginner mistake. A general rule: 1 inch of adult fish per gallon of water. Overstocking spikes ammonia and causes chronic stress.'],
            ['❌ Skipping the Nitrogen Cycle', 'Adding fish to an uncycled tank exposes them to lethal ammonia spikes. Cycle a new tank for 4-6 weeks before adding fish — test for 0 ammonia, 0 nitrite, and low nitrate.'],
            ['❌ Overfeeding', 'Uneaten food decomposes and spikes ammonia within hours. Feed only what your fish can eat in 2-3 minutes, once or twice daily. Remove uneaten food promptly.'],
            ['❌ Doing 100% Water Changes', 'Complete water changes crash your tank\'s beneficial bacteria colony. Do partial water changes of 20-30% weekly using a siphon to remove debris.'],
            ['❌ Mixing Incompatible Species', 'Researching compatibility before buying saves lives. Cichlids eat small fish. Betta fish attack other bettas. Goldfish are coldwater fish that do poorly in tropical tanks.'],
        ],
        'reptile' => [
            ['❌ Wrong Temperature Gradient', 'Reptiles are ectothermic — they need a warm side and a cool side to thermoregulate. A uniform temperature causes chronic stress, poor digestion, and immune suppression.'],
            ['❌ Feeding Prey Larger Than the Head Width', 'Prey items should be no wider than the widest part of your reptile\'s head. Oversized prey causes regurgitation and can injure or kill your animal.'],
            ['❌ Inadequate UVB Lighting', 'Most reptiles require UVB light to synthesize vitamin D3. Without it, they develop metabolic bone disease — a slow, painful, preventable condition. Replace UVB bulbs every 6-12 months even if they still glow.'],
            ['❌ Handling Too Soon After Feeding', 'Wait 48-72 hours after feeding before handling your reptile. Premature handling causes stress-induced regurgitation, which wastes energy and can cause esophageal damage.'],
            ['❌ Ignoring Humidity Requirements', 'Every reptile species has specific humidity needs. Too low causes stuck sheds and dehydration; too high causes respiratory infections and scale rot.'],
        ],
        'rabbit' => [
            ['❌ Too Little Hay', 'Hay should make up 80-90% of a rabbit\'s diet — not pellets. Unlimited timothy hay keeps the gut moving (critical — GI stasis is a life-threatening emergency) and wears down constantly-growing teeth.'],
            ['❌ Housing on Wire-Bottom Cages', 'Wire flooring causes sore hocks (painful ulcerated foot pads). Rabbits need solid flooring with soft bedding — fleece blankets, hay, or wooden boards work well.'],
            ['❌ Too Many Sugary Treats or Fruit', 'Rabbits have sensitive digestive systems. More than one tablespoon of fruit per day causes cecal dysbiosis — dangerous bacterial overgrowth in the gut.'],
            ['❌ Assuming Rabbits Are Low-Maintenance', 'Rabbits are the third most surrendered pet. They live 8-12 years, need daily social interaction, cannot be left alone for days, and require a rabbit-savvy vet. They are not starter pets.'],
            ['❌ Bathing a Rabbit', 'Rabbits groom themselves like cats. Bathing causes extreme stress and can trigger fatal shock. Spot-clean with a damp cloth only if absolutely necessary.'],
        ],
    ];

    $default_mistakes = [
        ['❌ Ignoring Subtle Early Signs', 'Behavioral and physical changes are often the first signs of illness. Knowing your pet\'s normal baseline makes early detection possible.'],
        ['❌ Using Human Products on Pets', 'Many medications, shampoos, and foods safe for humans are toxic to pets. Always use species-specific products.'],
        ['❌ Skipping Routine Vet Visits', 'Annual or biannual wellness checks catch health issues before they become emergencies. Senior pets benefit from twice-yearly exams.'],
        ['❌ Following Generic Online Advice', 'Not all advice fits every species, breed, age, or health condition. When in doubt, your vet is the most reliable source.'],
        ['❌ Delaying Vet Care When Worried', 'If something feels off, it usually is. A quick vet call costs less than a delayed diagnosis.'],
    ];

    $items = isset($mistakes_map[$a]) ? $mistakes_map[$a] : $default_mistakes;
    $animal_label = strtolower($a === 'all' ? 'pet' : $a);

    $html = '<p class="pz-section-intro">Even experienced ' . $animal_label . ' owners make these mistakes. Knowing what to avoid is just as important as knowing what to do.</p>';
    $html .= '<div class="pz-mistakes-grid">';

    foreach ($items as $item) {
        $html .= '<div class="pz-mistake-card">';
        $html .= '<h3 class="pz-mistake-title">' . esc_html($item[0]) . '</h3>';
        $html .= '<p>' . esc_html($item[1]) . '</p>';
        $html .= '</div>';
    }

    $html .= '</div>';
    return $html;
}

function pz_section_warning_signs($tool) {
    $a = $tool['animal'] ?? 'pet';

    $signs = [
        'dog' => [
            'emergency' => ['Difficulty breathing or labored breathing', 'Collapse or inability to stand', 'Seizures lasting more than 2 minutes', 'Suspected poisoning or toxin ingestion', 'Severe bleeding or deep wounds', 'Extreme bloating or distended belly (GDH risk)'],
            'vet_soon' => ['Vomiting or diarrhea lasting more than 24 hours', 'Refusing food for more than 48 hours', 'Limping or reluctance to bear weight', 'Excessive drinking or urination', 'Swollen or painful abdomen', 'Eye discharge or cloudiness'],
            'monitor' => ['Mild lethargy or low energy', 'Soft stool without blood', 'Minor scratching or licking', 'Small appetite reduction for under 24 hours']
        ],
        'cat' => [
            'emergency' => ['Open-mouth breathing or panting (cats rarely pant)', 'Collapse or sudden weakness', 'Suspected poisoning (lilies, antifreeze, etc.)', 'Urinary blockage (straining, crying in litter box)', 'Seizures', 'Pale, white, blue or yellow gums'],
            'vet_soon' => ['Not urinating for over 24 hours', 'Hiding and refusing all food for 24+ hours', 'Third eyelid visible', 'Sneezing with thick nasal discharge', 'Rapid unexplained weight loss', 'Crying out when touched'],
            'monitor' => ['Mild sneezing without discharge', 'Slightly reduced appetite', 'Occasional hairball', 'Mild lethargy for under 12 hours']
        ],
        'bird' => [
            'emergency' => ['Fluffed feathers with eyes closed (severe illness sign)', 'Breathing with tail bobbing or open beak', 'Bleeding from any body part', 'Collapse or inability to perch', 'Suspected toxin exposure (fumes, lead, zinc)', 'Seizures or loss of balance'],
            'vet_soon' => ['Nasal discharge or crusty nares', 'Changes in droppings for more than 24 hours', 'Feather destruction or over-preening', 'Regurgitating repeatedly (different from normal feeding)', 'Voice changes or loss of vocalization', 'Swollen eye or eyelid'],
            'monitor' => ['Mild change in droppings for less than 24 hours', 'Slightly reduced seed intake', 'Quieter than normal for one day']
        ],
        'fish' => [
            'emergency' => ['Floating upside down or sideways', 'Gasping at the surface continuously', 'Severe fin rot reaching the body', 'Visible parasites covering large body area', 'Rapid mass die-off in tank', 'Tank ammonia or nitrite spike above 0.5 ppm'],
            'vet_soon' => ['White spots covering body (Ich)', 'Clamped fins lasting more than 24 hours', 'Visible fungal growth (white cotton-like patches)', 'Not eating for 3+ days', 'Abnormal swimming pattern (spinning, sinking)', 'Popeye (bulging eyes)'],
            'monitor' => ['Slightly reduced appetite', 'Minor fin fraying', 'Hiding more than usual for 1-2 days', 'Mild color fading']
        ],
        'reptile' => [
            'emergency' => ['Inability to close mouth (mouth gaping)', 'Respiratory infection signs (wheezing, mucus)', 'Prolapsed organ (tissue outside body)', 'Seizures or loss of muscle control', 'Suspected impaction (no bowel movement 2+ weeks)', 'Retained shed covering eyes or constricting limbs'],
            'vet_soon' => ['Not eating for 4+ weeks (outside brumation)', 'Swollen limbs or joints', 'Abnormal skin coloring or dark patches', 'Runny or unusual droppings', 'Labored breathing', 'Cloudy or sunken eyes outside shed'],
            'monitor' => ['Skipping one or two meals (normal for some species)', 'Hiding more than usual', 'Mild color changes during shed', 'Reduced activity during cooler months']
        ],
        'rabbit' => [
            'emergency' => ['Complete loss of appetite (GI stasis — life threatening within hours)', 'No droppings for 12+ hours', 'Labored breathing or blue-tinged lips', 'Head tilt with loss of balance (E. cuniculi)', 'Suspected fly strike (maggots on skin)', 'Paralyzed or dragging hind legs'],
            'vet_soon' => ['Reduced droppings or very small/misshapen pellets', 'Teeth grinding (pain signal)', 'Eye or nasal discharge', 'Wet dewlap or chin (dental or drinking issue)', 'Uneaten cecotropes (soft night droppings)', 'Limping or reluctance to move'],
            'monitor' => ['Slightly reduced veggie intake', 'Mild soft cecotropes', 'Less grooming than usual for 1 day', 'Quieter than normal']
        ],
    ];

    // Default for general/unknown animals
    $default = [
        'emergency' => ['Difficulty breathing', 'Collapse or inability to stand', 'Seizures', 'Suspected poisoning', 'Severe bleeding', 'Extreme pain or vocalizing'],
        'vet_soon' => ['Vomiting or diarrhea lasting 24+ hours', 'Refusing food for 48+ hours', 'Unexplained weight loss', 'Swelling or lumps', 'Changes in drinking or urination', 'Eye or nasal discharge'],
        'monitor' => ['Mild lethargy', 'Slight appetite reduction under 24 hours', 'Minor behavior changes', 'Soft stool without blood']
    ];

    $w = isset($signs[$a]) ? $signs[$a] : $default;
    $animal_label = strtolower($a === 'all' ? 'pet' : $a);

    // Build the HTML output
    $html = '<p class="pz-section-intro">Knowing when to call the vet versus when to monitor at home is one of the most important skills for any ' . $animal_label . ' owner. Use this guide as a reference — when in doubt, always call your vet.</p>';

    $html .= '<div class="pz-warning-grid">';

    // Emergency
    $html .= '<div class="pz-warning-card pz-warning-emergency">';
    $html .= '<h3>🚨 Emergency — Call Vet Immediately</h3><ul>';
    foreach ($w['emergency'] as $s) $html .= '<li>' . esc_html($s) . '</li>';
    $html .= '</ul></div>';

    // Vet Soon
    $html .= '<div class="pz-warning-card pz-warning-soon">';
    $html .= '<h3>⚠️ Vet Visit Soon — Within 24-48 Hours</h3><ul>';
    foreach ($w['vet_soon'] as $s) $html .= '<li>' . esc_html($s) . '</li>';
    $html .= '</ul></div>';

    // Monitor
    $html .= '<div class="pz-warning-card pz-warning-monitor">';
    $html .= '<h3>👀 Monitor at Home — Watch Closely</h3><ul>';
    foreach ($w['monitor'] as $s) $html .= '<li>' . esc_html($s) . '</li>';
    $html .= '</ul></div>';

    $html .= '</div>'; // grid
    $html .= '<p class="pz-warning-disclaimer"><strong>Important:</strong> This guide is for informational purposes only. It is not a substitute for professional veterinary advice. If your ' . $animal_label . ' shows any concerning signs, contact your vet or an emergency animal hospital immediately.</p>';

    return $html;
}

function pz_section_breed_variations($tool) {
    $a = ucfirst($tool['animal'] === 'all' ? 'pet' : $tool['animal']);
    ob_start(); ?>
    <p>Care needs vary significantly based on your <?php echo strtolower($a); ?>'s breed, size, and genetic background. Here's what to keep in mind:</p>
    <div class="pz-breed-table-wrap">
      <table class="pz-breed-table">
        <thead>
          <tr><th>Size / Type</th><th>Frequency</th><th>Special Notes</th></tr>
        </thead>
        <tbody>
          <?php
          $rows = pz_get_breed_rows($tool);
          foreach($rows as $r) {
              echo '<tr><td><strong>' . esc_html($r[0]) . '</strong></td><td>' . esc_html($r[1]) . '</td><td>' . esc_html($r[2]) . '</td></tr>';
          }
          ?>
        </tbody>
      </table>
    </div>
    <p style="margin-top:16px;color:#666;font-size:14px">* Always consult your vet for breed-specific recommendations. Purebred animals often have unique health predispositions that affect care needs.</p>
    <?php return ob_get_clean();
}

function pz_get_breed_rows($tool) {
    if (!empty($tool['calc']) && function_exists('pz_breed_rows_' . $tool['calc'])) {
        return call_user_func('pz_breed_rows_' . $tool['calc']);
    }
    $animal = $tool['animal'];
    if ($animal === 'dog') return [
        ['Small Breeds (under 20 lbs)', 'Faster metabolism & handling', 'More temperature-sensitive; smaller frame needs gentler handling'],
        ['Medium Breeds (20-60 lbs)',   'Standard care applies',  'Most versatile; follow general guidelines'],
        ['Large Breeds (60-100 lbs)',   'More joint & weight monitoring',  'More prone to joint issues; monitor weight carefully'],
        ['Giant Breeds (100+ lbs)',     'Extra care & slower growth',   'Slower maturity; higher risk of bloat and joint disease'],
    ];
    if ($animal === 'cat') return [
        ['Domestic Shorthair',   'Standard care schedule',     'Generally robust; maintain regular vet checks'],
        ['Long-Haired Breeds',   'More frequent grooming',     'Persian, Maine Coon need daily brushing'],
        ['Senior Cats (10+)',    'Increased monitoring',       'More frequent vet visits; watch for kidney and thyroid issues'],
        ['Outdoor Cats',         'Additional parasite care',   'More frequent flea/tick/worm prevention needed'],
    ];
    return [
        ['Young / Juvenile',  'More frequent monitoring',    'Growing animals need more attention and nutrition monitoring'],
        ['Adult',             'Standard recommendations',    'Follow guidelines for species and size'],
        ['Senior',            'Increased frequency',         'More prone to health issues; vet visits every 6 months recommended'],
        ['Special Needs',     'Customized per condition',    'Always follow veterinarian\'s specific instructions'],
    ];
}

function pz_section_products($tool) {
    ob_start(); ?>
    <p>These are the types of products most commonly recommended by veterinarians for this care area. Always choose products appropriate for your pet's species, age, and size:</p>
    <div class="pz-products-grid">
      <?php
      $products = [
        ['🏆','Vet-Approved Brands','Look for products with AAFCO, VOHC, or veterinary endorsement seals. These indicate the product has been tested and meets quality standards.'],
        ['🌿','Natural Ingredients','Choose products with clearly listed, recognizable ingredients. Avoid artificial preservatives, colors, and fillers where possible.'],
        ['📏','Size-Appropriate','Always match product to your pet\'s size. Using undersized or oversized tools/products can cause harm or be ineffective.'],
        ['🔬','Science-Backed Formula','Prioritize products with clinical studies or veterinary research supporting their efficacy, especially for health-related items.'],
      ];
      foreach($products as $p): ?>
      <div class="pz-product-card">
        <div class="pz-product-icon"><?php echo $p[0]; ?></div>
        <h4><?php echo esc_html($p[1]); ?></h4>
        <p><?php echo esc_html($p[2]); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
    <div class="pz-info-box" style="margin-top:20px">
      <strong>💡 Budget Tip:</strong> Ask your vet for product recommendations before purchasing. Many vets offer products at clinic pricing, and they can steer you away from expensive items that won't benefit your specific pet.
    </div>
    <?php return ob_get_clean();
}

function pz_section_vet_advice($tool) {
    $a = ucfirst($tool['animal'] === 'all' ? 'pet' : $tool['animal']);
    ob_start(); ?>
    <div class="pz-vet-disclaimer">
      <div class="pz-vet-disclaimer-icon">⚕️</div>
      <div>
        <strong>Important Medical Disclaimer</strong>
        <p>The information provided in this guide is for educational purposes only and is not a substitute for professional veterinary advice, diagnosis, or treatment. Always consult a licensed veterinarian for your pet's specific health needs.</p>
      </div>
    </div>
    <p>While this guide covers general best practices, certain situations always require professional veterinary evaluation:</p>
    <ul class="pz-vet-list">
      <li>📅 <strong>Annual wellness exams</strong> — even if your <?php echo strtolower($a); ?> appears healthy</li>
      <li>🔍 <strong>New symptoms</strong> — any new behavior change, physical change, or health concern</li>
      <li>💊 <strong>Before starting supplements or new diet</strong> — some supplements interact with medications</li>
      <li>🐣 <strong>Life stage transitions</strong> — puppy/kitten to adult, adult to senior</li>
      <li>🤰 <strong>Pregnancy or breeding</strong> — specialized care is essential</li>
      <li>⚕️ <strong>Chronic conditions</strong> — pets with diabetes, kidney disease, or heart conditions need customized plans</li>
    </ul>
    <p>Your veterinarian is your most valuable partner in your <?php echo strtolower($a); ?>'s health journey. Regular check-ups allow early detection of issues that can't be spotted at home.</p>
    <?php return ob_get_clean();
}

function pz_section_faq($tool) {
    $t    = $tool['title'];
    $a    = $tool['animal'] ?? 'pet';
    $al   = ucfirst($a === 'all' ? 'pet' : $a);
    $kw   = $tool['kw'] ?? strtolower($t);
    $type = $tool['type'] ?? 'guide';

    // Animal + type specific FAQ sets — written as people actually ask on ChatGPT/voice search
    $faqs_by_animal_type = [
        'dog_calculator' => [
            ["How accurate is the {$t}?", "The {$t} uses established veterinary formulas as a baseline. Results are accurate for healthy adult dogs with typical activity levels. Individual variation — breed genetics, health conditions, metabolism — means your vet should always validate the output for your specific dog."],
            ["How often should I use the {$t}?", "Recalculate every 3 months for adult dogs, monthly for puppies under 12 months, and any time your dog's weight changes by more than 5%, their activity level changes significantly, or they start or stop medication."],
            ["Can I use the {$t} for puppies?", "Most calculators include a puppy mode or age input. Puppies have very different nutritional and physiological needs from adult dogs — always check that the tool is set for your dog's life stage before acting on the result."],
            ["What if the {$kw} result seems too high or too low?", "Double-check your inputs first — weight in the right unit, correct age, correct activity level. If the result still seems off after verifying your inputs, bring it to your vet. They can validate or adjust based on your dog's individual health history."],
            ["Is the {$t} free to use?", "Yes — all PetZenAI tools are completely free. No signup, no subscription, no hidden cost. Save the page so you can return and recalculate whenever your dog's needs change."],
        ],
        'cat_calculator' => [
            ["How do I use the {$t} correctly?", "Enter your cat's current weight, age (in years and months for kittens), and activity level. For indoor cats, select 'low activity.' For cats with outdoor access, select 'moderate.' Review your result and cross-check with your vet at your next appointment."],
            ["Does the {$t} work for senior cats?", "Yes. Senior cats (7+ years) have different metabolic rates and nutritional needs. The tool accounts for age — be sure to enter your cat's actual age so the tool applies age-appropriate formulas."],
            ["My cat's result seems higher than what the food bag recommends — which is right?", "Food bag guidelines are set by manufacturers and tend to be generous. Calculator results based on your cat's actual weight and activity level are often more precise. When in doubt, ask your vet — they know your cat's history."],
            ["Can I use this for a kitten?", "Yes, but kitten calculations differ significantly from adult cat calculations. Kittens need more calories per pound of body weight. Make sure to enter the correct age so the tool applies kitten-appropriate formulas."],
            ["How often should I recalculate?", "Monthly for kittens under 12 months. Every 3-6 months for healthy adults. After any weight change of more than 0.5 kg, illness, pregnancy, or after spaying or neutering."],
        ],
        'fish_guide' => [
            ["What is the most important thing to know about {$kw}?", "Water quality is the foundation of all fish health. Before worrying about diet, decor, or diseases, get your water parameters stable — ammonia 0, nitrite 0, nitrate below 20 ppm, and pH appropriate for your species."],
            ["How often should I do water changes for my fish tank?", "Most freshwater tanks need a 20-30% water change weekly. Heavily stocked tanks may need twice weekly. Marine tanks vary — follow species-specific guidelines. Always treat tap water with a dechlorinator before adding it to the tank."],
            ["Can different fish species share the same tank?", "Only if they have compatible water parameters, temperament, and size ratios. Research each species before combining them. Aggressive fish will stress and injure peaceful species even when water parameters match perfectly."],
            ["How do I know if my fish is sick?", "Early signs: clamped fins, color change, reduced appetite, abnormal swimming, hiding more than usual. Immediate concern: white spots (Ich), cotton-like patches (fungus), gasping at the surface, or floating sideways."],
            ["Is {$kw} difficult for beginners?", "It depends on the species. Some fish (betta, guppies, goldfish) tolerate beginner mistakes better than others (discus, saltwater reef fish). Start with hardy species and a stable setup before advancing to more sensitive species."],
        ],
        'reptile_guide' => [
            ["What temperature should I keep for {$kw}?", "Reptiles are ectothermic and require a temperature gradient — a warm basking spot and a cooler retreat. The exact range depends on species. Always research the specific requirements for your reptile — incorrect temperatures are the leading cause of illness in captive reptiles."],
            ["How often should I feed my reptile?", "Frequency depends on species and age. Juvenile reptiles generally eat more frequently than adults. Many reptiles eat every 2-7 days. Overfeeding causes obesity; underfeeding stunts growth. Research your specific species' recommended feeding schedule."],
            ["Why is my reptile not eating?", "Common causes: incorrect temperatures (most common), stress from a new environment, shedding cycle, seasonal slowdown (brumation), illness, or prey that is too large. Rule out temperature issues first — they cause the majority of feeding refusals."],
            ["Do reptiles need UVB lighting?", "Most reptiles — especially lizards and many turtles — require UVB light to synthesize Vitamin D3. Without it, they develop Metabolic Bone Disease over time. Replace UVB bulbs every 6-12 months even if they still produce visible light."],
            ["How do I know if my reptile is healthy?", "Signs of a healthy reptile: clear eyes (except during shed), clean nostrils, firm and consistent body weight, regular feeding, normal shedding, regular waste production, and alert behavior when awake."],
        ],
        'bird_guide' => [
            ["What should I feed my {$al}?", "The foundation of a healthy {$al} diet is high-quality pellets (not seeds alone), fresh vegetables, and limited fruit. Seeds are high in fat and nutritionally incomplete as a sole diet. A pellet and veggie foundation provides the vitamins, minerals, and protein birds need."],
            ["How do I know if my bird is sick?", "Birds hide illness instinctively — by the time symptoms are obvious, they may have been sick for days. Early warning signs: fluffed feathers, eyes closed during the day, tail bobbing when breathing, nasal discharge, or changes in droppings. Any of these warrants a vet call."],
            ["How much attention does a {$al} need daily?", "Parrots and other social species need 2-4 hours of out-of-cage interaction daily. Finches and canaries are more independent but still need daily visual interaction and environmental enrichment. Isolation leads to feather-destructive behavior and chronic stress."],
            ["Are non-stick pans dangerous to birds?", "Yes — this is a life-threatening hazard. Non-stick coatings (PTFE/Teflon) release invisible fumes when overheated that cause acute respiratory failure in birds within minutes. Use stainless steel, cast iron, or ceramic cookware in any home with birds."],
            ["How long do {$al}s live?", "Lifespan varies greatly by species. Budgies: 5-10 years. Cockatiels: 15-20 years. African Grey Parrots: 40-60 years. Macaws: 50-80 years. Research your specific species — many parrots outlive their owners and require long-term life planning."],
        ],
        'rabbit_guide' => [
            ["What should rabbits eat every day?", "Unlimited timothy hay (80-90% of diet), fresh leafy greens (1-2 cups per 5 lbs body weight), a small amount of high-quality pellets (1/4 cup per 5 lbs), and unlimited fresh water. Fruit and treats should be limited to a teaspoon per day."],
            ["How do I know if my rabbit is sick?", "The most critical warning sign is GI stasis — if your rabbit stops eating and stops producing droppings, this is a medical emergency. Go to a vet immediately, even at night. Other warning signs: tooth grinding, hunched posture, hiding, and labored breathing."],
            ["Do rabbits need to go to the vet?", "Yes. Rabbits need an annual wellness exam with a rabbit-savvy vet. They also need spaying or neutering, which dramatically reduces cancer risk — especially in females. Find a vet who specializes in exotic animals, as not all small animal vets have rabbit expertise."],
            ["Can rabbits live alone?", "Rabbits are highly social and generally do better with a companion rabbit. A lone rabbit needs significantly more human interaction to remain mentally healthy. If you can only have one rabbit, plan for multiple hours of daily interaction and enrichment."],
            ["Are rabbits good pets for children?", "Rabbits are often misrepresented as easy starter pets. They are not — they live 8-12 years, require daily interaction, a specialized diet, and a rabbit-savvy vet. Most rabbits dislike being held. They suit calm, patient households where an adult manages their primary care."],
        ],
    ];

    // Build lookup key from animal + type
    $a_key      = $a === 'all' ? 'pet' : $a;
    $lookup_key = $a_key . '_' . $type;

    // Default FAQs for animal/type combinations not specifically covered above
    $default_faqs = [
        ["What is the {$t} and how does it work?", "The {$t} is a free, vet-informed {$type} designed to help {$al} owners make better care decisions. It provides structured guidance based on species-appropriate veterinary knowledge — use it as a starting point, then discuss results with your vet."],
        ["Is the {$t} free to use?", "Yes — completely free. No account, no signup, no subscription required. All PetZenAI tools are free for {$al} owners worldwide."],
        ["How accurate is the information in this {$type}?", "Content is based on established veterinary guidelines and current best practices in {$al} care. It is reviewed for accuracy but is not a substitute for professional veterinary advice. Your vet knows your specific {$al} and should always be the final authority on their care."],
        ["How often should I use the {$t}?", "Use it whenever your {$al}'s situation changes — new symptoms, age milestones, diet changes, or any time you have a new question. Bookmark it for easy access so it's there when you need it."],
        ["Can I share this {$type} with my vet?", "Absolutely. Many owners share PetZenAI tool results during vet appointments as a conversation starter. Your vet can validate, adjust, or build on the guidance provided here."],
        ["What should I do if my {$al}'s situation doesn't match what this {$type} describes?", "Every {$al} is an individual. If your {$al}'s situation feels different from what's described here, trust your instincts and consult your vet. This tool covers typical cases — your vet handles the specific."],
    ];

    if (!empty($tool['calc']) && function_exists('pz_faq_' . $tool['calc'])) {
        $faqs = call_user_func('pz_faq_' . $tool['calc']);
    } else {
        $faqs = isset($faqs_by_animal_type[$lookup_key]) ? $faqs_by_animal_type[$lookup_key] : $default_faqs;
    }

    // Build FAQ JSON-LD schema for GEO/AI search and Google rich results
    $schema_faqs = [];
    foreach ($faqs as $faq) {
        $schema_faqs[] = [
            '@type' => 'Question',
            'name'  => $faq[0],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq[1]],
        ];
    }
    $schema = json_encode([
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => $schema_faqs,
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

    ob_start();
    echo '<script type="application/ld+json">' . $schema . '</script>';
    foreach ($faqs as $faq): ?>
    <div class="pz-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
      <button class="pz-faq-q" onclick="pzToggleFaq(this)" aria-expanded="false" itemprop="name">
        <?php echo esc_html($faq[0]); ?>
        <span class="pz-faq-arrow" aria-hidden="true">▾</span>
      </button>
      <div class="pz-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" hidden>
        <p itemprop="text"><?php echo esc_html($faq[1]); ?></p>
      </div>
    </div>
    <?php endforeach;
    return ob_get_clean();
}

/* ─────────────────────────────────────────────
   META DESCRIPTION GENERATOR
   Called from functions.php for tool pages
───────────────────────────────────────────── */
function pz_get_meta_description($tool) {
    $t    = $tool['title'];
    $kw   = $tool['kw'] ?? strtolower($t);
    $a    = $tool['animal'] === 'all' ? 'pet' : $tool['animal'];
    $type = $tool['type'] ?? 'guide';

    $templates = [
        'calculator' => "Use our free {$kw} to get instant, vet-informed results for your {$a}. No signup required — accurate, science-based {$a} care calculators trusted by owners worldwide.",
        'checker'    => "Check your {$a}'s symptoms with our free {$kw}. Get vet-backed guidance on when to worry, when to monitor, and when to call the vet immediately.",
        'guide'      => "Complete {$kw} for {$a} owners. Vet-reviewed tips, warning signs, common mistakes, and step-by-step guidance — all free on PetZenAI.",
        'tracker'    => "Track your {$a}'s health with our free {$kw}. Log changes, spot trends early, and bring accurate records to your next vet visit.",
    ];

    return $templates[$type] ?? "Free {$kw} for {$a} owners. Vet-reviewed guidance, practical tips, and science-based care advice — all free on PetZenAI.";
}

function pz_sidebar_quick_facts($tool) {
    $a = ucfirst($tool['animal'] === 'all' ? 'pet' : $tool['animal']);
    $facts = [
        ['Category', esc_html(pz_get_tool_categories()[$tool['cat']]['label'] ?? 'Pet Care')],
        ['Animal Type', $a],
        ['Tool Type', ucfirst($tool['type'])],
        ['Vet Reviewed', '✅ Yes'],
        ['Last Updated', date('M Y')],
        ['Cost', '100% Free'],
    ];
    $out = '<ul style="list-style:none;padding:0;margin:0">';
    foreach($facts as $f) {
        $out .= '<li style="display:flex;justify-content:space-between;align-items:center;padding:6px 0;border-bottom:1px solid rgba(255,255,255,.06);font-size:12px">';
        $out .= '<span style="color:rgba(255,255,255,.45);font-weight:600">' . esc_html($f[0]) . '</span>';
        $out .= '<span style="color:#fff;font-weight:700;font-size:12px">' . $f[1] . '</span>';
        $out .= '</li>';
    }
    $out .= '</ul>';
    return $out;
}
