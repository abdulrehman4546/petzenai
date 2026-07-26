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

    <?php elseif ($type === 'checker' && !empty($tool['calc']) && function_exists('pz_render_checker_' . $tool['calc'])):
        call_user_func('pz_render_checker_' . $tool['calc'], $tool);
    elseif ($type === 'checker'): ?>
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

/* ═══════════════════════════════════════════════════════════
   DOG-HEALTH CALCULATORS — 6 tools × 10 functions
   Weight, BCS, Lifespan, Deworming, Pregnancy, Vet-Visit Frequency
═══════════════════════════════════════════════════════════ */

/* ══ 1. Dog Ideal Weight Calculator (dog_weight_calc) ══ */

function pz_hero_quickanswer_dog_weight_calc() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> A healthy weight depends entirely on your dog's breed-size category — a Toy breed tops out around 10 lbs while a Giant breed can top 100 lbs. Enter your dog's size category, current weight, and age above to see how they compare to the typical healthy range for dogs their size.</div>
<?php }

function pz_hero_trust_dog_weight_calc() { ?>
      <span>✅ 5 breed-size categories</span>
      <span>✅ Puppy-safe logic</span>
      <span>✅ Free vet-ready summary</span>
<?php }

function pz_methodology_heading_dog_weight_calc() { return "What Decides Your Dog's Ideal Weight"; }

function pz_methodology_dog_weight_calc() { ?>
    <p style="color:#555;margin-bottom:20px">There's no single healthy weight number for "a dog" — the calculator starts from your dog's breed-size category, then checks whether their current weight and age put them within, above, or below the typical range for dogs that size.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">📏</div>
        <strong>Breed Size Category</strong>
        <p>Toy, Small, Medium, Large, and Giant breeds have completely different healthy weight ranges — comparing a Chihuahua and a Great Dane to the same number would be meaningless.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🐶</div>
        <strong>Age &amp; Growth Stage</strong>
        <p>Puppies aren't measured against adult ranges at all — they're still growing toward their eventual adult size, so the calculator shows their target range instead of flagging over- or underweight.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">⚖️</div>
        <strong>Distance From Range</strong>
        <p>Being a little outside the ideal range reads very differently than being far outside it — the calculator estimates roughly how far over or under so you know how much attention it needs.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🩺</div>
        <strong>Individual Variation</strong>
        <p>Two dogs in the same size category can have different healthy weights depending on frame, muscle mass, and build — this is a starting estimate, not the final word.</p>
      </div>
    </div>
<?php }

function pz_faq_dog_weight_calc() {
    return [
        ["What's a healthy weight range for my dog's breed size?", "As a general guide: Toy breeds 4–10 lbs, Small breeds 10–25 lbs, Medium breeds 25–60 lbs, Large breeds 60–100 lbs, and Giant breeds roughly 100–180 lbs. These are population ranges — your dog's individual ideal weight depends on their specific frame and build, which is why a hands-on vet body condition check is the most accurate method."],
        ["My dog is a mixed breed — how do I pick a size category?", "Use your dog's expected or current adult weight to pick the closest category rather than trying to match a specific breed. If you're unsure where a mixed-breed puppy will land as an adult, your vet can often estimate this from paw size and growth pattern at an early check-up."],
        ["My puppy weighs less than the adult range — is that a problem?", "No — this is completely expected. Puppies grow into their adult weight gradually, so comparing a growing puppy to an adult target range isn't meaningful. Ask your vet to track your puppy's weight on a breed-appropriate growth chart instead, which shows whether they're growing at a healthy pace."],
        ["How much over the ideal range is actually a concern?", "A small percentage over — roughly under 10% — is often minor and worth simply monitoring. Being 15 to 20% or more over the ideal range is associated with meaningfully higher risk for joint strain, diabetes, and other weight-related conditions, and is worth a conversation with your vet about a gradual weight-loss plan."],
        ["Does this calculator replace a vet weight check?", "No. This is a starting estimate based on breed-size averages. Your vet can physically assess body condition — feeling for ribs, waist, and belly tuck — which is more accurate for your individual dog than any weight-only number, since two dogs at the same weight can have very different body compositions."],
    ];
}

function pz_render_calc_dog_weight_calc( $tool ) {
    $icon = $tool['icon'] ?? '⚖️';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Dog Ideal Weight Calculator by Breed</div>
          <div class="pz-int-sublabel">Compare your dog's weight to a healthy breed-size range</div>
        </div>
      </div>
      <div class="pz-int-badges">
        <span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span>
        <span class="pz-int-badge pz-int-badge--blue">📏 Breed-Size Based</span>
      </div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Breed Size Category</label>
          <select id="pz_dw_size" class="pz-int-select">
            <option value="toy">Toy (adult target 4–10 lbs)</option>
            <option value="small">Small (adult target 10–25 lbs)</option>
            <option value="medium" selected>Medium (adult target 25–60 lbs)</option>
            <option value="large">Large (adult target 60–100 lbs)</option>
            <option value="giant">Giant (adult target 100+ lbs)</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Current Weight</label>
          <div class="pz-int-input-wrap">
            <input type="number" id="pz_dw_weight" class="pz-int-input" placeholder="e.g. 42" min="0.5" max="250" step="0.1">
            <span class="pz-int-input-suffix">lbs</span>
          </div>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Age Group</label>
          <select id="pz_dw_age" class="pz-int-select">
            <option value="puppy">Puppy (under 1 year)</option>
            <option value="adult" selected>Adult (1–7 years)</option>
            <option value="senior">Senior (7+ years)</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzCalcDogWeight()">
        <span class="pz-int-btn-icon"><?php echo $icon; ?></span>
        Check My Dog's Weight
      </button>
      <div id="pz-calc-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

function pz_what_is_dog_weight_calc() {
    ob_start(); ?>
    <p>The Dog Ideal Weight Calculator compares your dog's current weight to the typical healthy range for their breed-size category — Toy, Small, Medium, Large, or Giant — and tells you whether they're within, above, or below that range. Rather than relying on a single one-size-fits-all number, it starts from the size category your dog actually belongs to, since a healthy Chihuahua and a healthy Great Dane weigh in completely different worlds.</p>
    <p>Weight is one of the clearest early signals of a dog's overall health, and errors in either direction carry real consequences. Dogs that drift over their ideal range face higher long-term risk of joint strain, arthritis, diabetes, and reduced mobility, while dogs that sit well under range may not be getting adequate nutrition or could have an underlying issue that hasn't been investigated yet. Neither extreme is something to guess about.</p>
    <p>Enter your dog's breed-size category, current weight, and age above to get your result, then scroll down for the reasoning behind the ranges and the FAQ covering the specific weight questions dog owners ask most — including what to do about mixed breeds and how much "over" actually matters.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_weight_calc() {
    ob_start(); ?>
    <p>Weight is one of the easiest health indicators to measure at home — and one of the most commonly misjudged, because owners often compare their dog to a generic number instead of their actual breed-size category.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🦴</span>
        <div>
          <strong>Joint &amp; Mobility Health</strong>
          <p>Excess weight puts direct mechanical strain on joints and is one of the most preventable contributors to arthritis and reduced mobility, especially in larger breeds already prone to hip and joint issues.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🩺</span>
        <div>
          <strong>Disease Risk</strong>
          <p>Carrying excess weight is strongly linked to higher rates of diabetes, heart strain, and reduced lifespan in dogs — knowing where your dog stands is a simple, actionable first step.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">📏</span>
        <div>
          <strong>Breed-Size Accuracy</strong>
          <p>A weight that's perfectly healthy for a Labrador would be dangerously low for a Chihuahua and dangerously high for a Yorkie — comparing to the right category avoids both false alarms and missed concerns.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🐶</span>
        <div>
          <strong>Puppy-Safe Logic</strong>
          <p>Growing puppies are never compared against adult ranges — doing so would create needless worry over completely normal growth, so the calculator treats puppies differently from adults and seniors.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_weight_calc() {
    return [
        ['title'=>"Identify Your Dog's Breed-Size Category", 'desc'=>"Choose Toy, Small, Medium, Large, or Giant based on your dog's breed or, for mixed breeds, their expected adult weight. This sets the healthy range the rest of the result is built from."],
        ['title'=>'Weigh Your Dog Accurately', 'desc'=>"Use a reliable pet scale, or for smaller dogs, weigh yourself holding your dog and subtract your own weight. Vet clinic scales are the most accurate option if you're unsure."],
        ['title'=>'Select the Correct Age Group', 'desc'=>"Puppies are treated differently from adults and seniors — selecting the right age group determines whether you get a target growth range or an over/under comparison."],
        ['title'=>'Review Your Result', 'desc'=>"Read whether your dog falls within, above, or below the ideal range for their size category, along with the rough percentage if they're outside it."],
        ['title'=>'Note the Guidance For Your Result', 'desc'=>"Over-range and under-range results each come with specific next-step guidance — read it rather than just the headline number."],
        ['title'=>'Bring the Result to Your Next Vet Visit', 'desc'=>"Share your result at your dog's next check-up so your vet can confirm it with a hands-on body condition assessment, which is more precise than weight alone."],
    ];
}

function pz_tips_dog_weight_calc() {
    return [
        ['Weigh at the Same Time of Day', "Weight can fluctuate slightly through the day. For the most consistent tracking, weigh your dog at roughly the same time each time — first thing in the morning before breakfast works well."],
        ['Recheck Every 4–8 Weeks', "Weight changes gradually. Rechecking every 4–8 weeks (more often for puppies) lets you catch a drifting trend early, before it becomes a larger gap to close."],
        ["Pair Weight With a Body Condition Look", "Weight alone can't tell the difference between muscle and fat. Combine your weight result with a quick look at your dog's waist and rib coverage — our Body Condition Score calculator covers this in detail."],
        ['Adjust Food Gradually, Not Drastically', "If your dog needs to gain or lose weight, change portions gradually over several weeks rather than making a sudden large cut or increase, which can cause digestive upset."],
        ["Don't Override Your Vet's Specific Target", "If your vet has already set a target weight for your dog based on their individual health history, follow that number over this calculator's general breed-size range."],
    ];
}

function pz_mistakes_dog_weight_calc() {
    return [
        ['❌ Comparing All Dogs to One Universal Number', "Treating every dog against one flat ideal-weight number ignores that Toy and Giant breeds differ by a factor of 20 or more — always compare within the correct breed-size category."],
        ['❌ Judging Puppies Against Adult Ranges', "A growing puppy will always weigh less than the adult range — that's expected, not a red flag. Puppies should be tracked against a growth curve, not an adult target."],
        ['❌ Making Sudden, Large Feeding Changes', "Cutting or increasing food drastically to hit a target weight fast can cause digestive upset and nutrient imbalances — gradual changes over weeks are safer and more sustainable."],
        ['❌ Relying on Weight Alone Without a Body Check', "Two dogs at the identical weight can have very different body compositions — a lean, muscular dog and a soft, out-of-condition dog can weigh the same. A physical body condition check catches what the scale can't."],
        ['❌ Ignoring a Steady Weight Drift', "A slow creep of a pound every few months adds up over a year. Catching the trend early with regular rechecks is far easier than reversing a large gap later."],
    ];
}

/* ══ 2. Dog Body Condition Score / BCS Calculator (dog_bmi_calc) ══ */

function pz_hero_quickanswer_dog_bmi_calc() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Vets use a 9-point Body Condition Score (BCS) — not the bathroom scale — to judge whether a dog is at a healthy weight. Answer three quick questions about rib feel, waist, and belly tuck above to get your dog's estimated BCS and category.</div>
<?php }

function pz_hero_trust_dog_bmi_calc() { ?>
      <span>✅ Vet-standard 9-point scale</span>
      <span>✅ 3 quick questions</span>
      <span>✅ Free category guidance</span>
<?php }

function pz_methodology_heading_dog_bmi_calc() { return "How the Body Condition Score Is Built"; }

function pz_methodology_dog_bmi_calc() { ?>
    <p style="color:#555;margin-bottom:20px">Body Condition Score (BCS) is the veterinary-standard way to judge a dog's weight — more informative than the bathroom scale alone, because it measures body composition directly through touch and visual checks rather than a number that can't tell frame from fat.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🖐️</div>
        <strong>Rib Feel</strong>
        <p>How easily you can feel your dog's ribs under the coat, and how much padding sits over them, is the single strongest signal in the whole scale.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">⏳</div>
        <strong>Waist From Above</strong>
        <p>Looking down at your dog from above, a visible "waist" indentation behind the ribs is a hallmark of a healthy body condition.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">📐</div>
        <strong>Belly Tuck From Side</strong>
        <p>Viewed from the side, a healthy dog's belly should tuck upward behind the ribcage rather than hang level with or below the chest.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🔢</div>
        <strong>Combined Scoring</strong>
        <p>No single sign is used alone — the calculator combines all three into the same 1–9 scale vets use, then maps your score to a standard category with tailored guidance.</p>
      </div>
    </div>
<?php }

function pz_faq_dog_bmi_calc() {
    return [
        ["What is a Body Condition Score (BCS)?", "BCS is a 9-point scale veterinarians use to assess a dog's body fat and muscle condition by touch and sight, rather than weight alone. A score of 4 to 5 out of 9 is considered ideal for most dogs; scores below that indicate thinness, and scores above indicate excess weight."],
        ["How is BCS different from a weight-based calculation?", "A weight number alone can't tell the difference between muscle and fat, and it doesn't account for your dog's individual frame. BCS solves this by physically checking rib coverage, waist definition, and belly tuck — the same three checks a vet performs during an exam."],
        ["What does it mean if my dog scores Very Thin or Thin?", "A low score can be normal for some naturally lean, athletic breeds, but it can also signal inadequate nutrition or an underlying illness. Rather than simply feeding more, a vet visit to rule out a medical cause is the recommended next step for a low score."],
        ["What does it mean if my dog scores Overweight or Obese?", "Higher scores are linked to increased risk of joint disease, diabetes, and a shorter lifespan. A vet-guided, gradual weight-loss plan — rather than a sudden diet change — is the safest way to bring a dog back toward the ideal range."],
        ["Can I do a BCS check reliably at home?", "Yes, with practice — running your hands along the ribs is the most useful check you can do yourself. Thick, long, or curly coats can visually hide a dog's true shape, though, so a vet's hands-on confirmation is worth getting periodically, especially for heavily coated breeds."],
    ];
}

function pz_render_calc_dog_bmi_calc( $tool ) {
    $icon = $tool['icon'] ?? '📊';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Dog Body Condition Score (BCS) Calculator</div>
          <div class="pz-int-sublabel">The vet-standard 9-point scale — 3 quick touch-and-look checks</div>
        </div>
      </div>
      <div class="pz-int-badges">
        <span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span>
        <span class="pz-int-badge pz-int-badge--blue">🔬 9-Point Scale</span>
      </div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Rib Feel</label>
          <select id="pz_bcs_ribs" class="pz-int-select">
            <option value="visible">Ribs visible, no fat cover</option>
            <option value="easy">Ribs easily felt, minimal fat cover</option>
            <option value="slight_press" selected>Ribs felt with slight pressure</option>
            <option value="mod_press">Ribs felt only with moderate pressure</option>
            <option value="hard">Ribs very hard to feel under fat</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Waist From Above</label>
          <select id="pz_bcs_waist" class="pz-int-select">
            <option value="dramatic">Dramatic hourglass waist</option>
            <option value="defined">Well-defined waist</option>
            <option value="slight" selected>Slight waist visible</option>
            <option value="none">No waist, straight or barrel-shaped</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Belly Tuck From Side</label>
          <select id="pz_bcs_tuck" class="pz-int-select">
            <option value="severe">Severe tuck, ribs/hips prominent</option>
            <option value="good" selected>Good tuck, abdomen rises to waist</option>
            <option value="slight">Slight or no tuck</option>
            <option value="none">No tuck, belly may hang below chest</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzCalcDogBmi()">
        <span class="pz-int-btn-icon"><?php echo $icon; ?></span>
        Get My Dog's BCS
      </button>
      <div id="pz-calc-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

function pz_what_is_dog_bmi_calc() {
    ob_start(); ?>
    <p>The Dog Body Condition Score (BCS) Calculator applies the same 9-point scale veterinarians use in exam rooms to assess whether your dog is at a healthy weight — based on how their ribs feel, whether they have a visible waist from above, and whether their belly tucks up from the side. This is more informative than a weight number alone, since it directly measures body composition rather than a figure that can't distinguish muscle from fat.</p>
    <p>Getting body condition wrong in either direction has real consequences. Dogs scoring in the overweight or obese range face meaningfully higher risk of joint disease, diabetes, and a shortened lifespan, while dogs scoring very thin or thin may be dealing with inadequate nutrition or an underlying illness that a vet needs to investigate — simply feeding more isn't always the right fix.</p>
    <p>Answer the three questions above to get your dog's estimated score and category, then scroll down for the reasoning behind each check and the FAQ covering the questions dog owners ask most about body condition scoring.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_bmi_calc() {
    ob_start(); ?>
    <p>Body Condition Score catches what a bathroom scale can't — because it's a direct read of body composition, not just a number that changes for many reasons.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🩺</span>
        <div>
          <strong>Vet-Standard Accuracy</strong>
          <p>This is the exact scoring system used in veterinary exam rooms — learning to read it yourself means you can catch changes between annual visits, not just at them.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⚠️</span>
        <div>
          <strong>Early Illness Detection</strong>
          <p>A dropping score in a dog that hasn't changed diet can be an early sign of illness — catching it through routine checks often means earlier, more effective treatment.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">❤️</span>
        <div>
          <strong>Obesity-Linked Disease Prevention</strong>
          <p>Obesity is one of the most preventable contributors to joint disease, diabetes, and reduced lifespan in dogs — a body condition check is a simple way to catch the drift before it becomes a diagnosis.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🧥</span>
        <div>
          <strong>Coat-Independent Assessment</strong>
          <p>Thick or fluffy coats can visually hide a dog's true shape — the hands-on rib and waist checks see through the coat in a way that eyeballing your dog across the room can't.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_bmi_calc() {
    return [
        ['title'=>"Feel Along Your Dog's Ribs", 'desc'=>"Run your fingers gently along your dog's rib cage with light pressure. Note whether ribs are visible, easily felt, felt with slight pressure, felt only with moderate pressure, or barely felt at all."],
        ['title'=>'Look at the Waist From Above', 'desc'=>"Standing over your dog and looking straight down, check for an hourglass indentation behind the ribs versus a straight or barrel-shaped outline."],
        ['title'=>'Check the Belly Tuck From the Side', 'desc'=>"Viewed from the side, see whether the belly rises up sharply behind the ribcage (a tuck) or hangs level with or below the chest."],
        ['title'=>'Select the Closest Matching Answers', 'desc'=>"Choose the option for each question that best matches what you felt and saw — exact precision matters less than an honest, closest-match answer."],
        ['title'=>'Review Your Score and Category', 'desc'=>"Read your estimated BCS number and category — Very Thin, Thin, Ideal, Overweight, or Obese — along with the guidance specific to that category."],
        ['title'=>'Share an Out-of-Range Score With Your Vet', 'desc'=>"If your score lands outside the Ideal range, bring it to your next vet visit. They can confirm it hands-on and rule out or address any underlying cause."],
    ];
}

function pz_tips_dog_bmi_calc() {
    return [
        ['Use Your Hands, Not Just Your Eyes', "A thick or fluffy coat can make a dog look leaner or heavier than they are. Always run your hands along the ribs and waist rather than judging by sight alone."],
        ['Recheck Monthly for Dogs Mid-Adjustment', "If your dog is on a vet-guided weight-loss or weight-gain plan, rechecking BCS monthly gives you an early read on whether the plan is working before the scale confirms it."],
        ['Compare Against Your Own Dog Over Time', "Body condition varies naturally between individual dogs and breeds. Tracking your own dog's score over months is often more useful than comparing to a single universal target."],
        ["Check Puppies and Seniors With Extra Care", "Growing puppies and older dogs can show body condition changes for very different reasons — growth spurts versus muscle loss — so mention their age when discussing a score change with your vet."],
        ['Pair BCS With a Weight Log', "BCS and weight tell you different things — combining a body condition check with a logged weight number gives your vet the fullest picture at your next visit."],
    ];
}

function pz_mistakes_dog_bmi_calc() {
    return [
        ['❌ Judging Body Condition by Eye Alone', "Coat thickness and length can completely disguise a dog's true shape. Always use hands-on rib and waist checks rather than relying on how your dog looks from across the room."],
        ["❌ Feeding a Thin Dog More Without a Vet Check", "A low score isn't automatically solved by more food — it can signal an underlying illness. Rule out a medical cause with your vet before assuming the fix is simply more calories."],
        ['❌ Treating a High Score as Just a Cosmetic Issue', "Overweight and obese scores carry real medical risk — joint disease, diabetes, and shortened lifespan — not just an appearance concern. Treat an elevated score as a health signal worth addressing."],
        ['❌ Using Human Body Standards as the Benchmark', "A visibly lean, almost gaunt look is not the healthy target for dogs — the ideal BCS range still includes a light, even fat covering over the ribs, not a fully visible skeleton."],
        ['❌ Only Checking Once a Year at the Vet', "Body condition can shift gradually over months without anyone noticing day to day. A quick self-check every few weeks catches drift far earlier than an annual exam alone."],
    ];
}

/* ══ 3. Dog Lifespan Calculator (dog_lifespan_calc) ══ */

function pz_hero_quickanswer_dog_lifespan_calc() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Average lifespan tracks closely with breed size — toy and small breeds average 12–16 years, medium breeds 10–14, large breeds 8–12, and giant breeds 6–10. This is a population average for planning purposes, not a prediction for your individual dog — genetics, diet, and veterinary care matter more than any general number.</div>
<?php }

function pz_hero_trust_dog_lifespan_calc() { ?>
      <span>✅ Population-average ranges</span>
      <span>✅ Spay/neuter &amp; health aware</span>
      <span>✅ Calm, planning-focused framing</span>
<?php }

function pz_methodology_heading_dog_lifespan_calc() { return "How the Lifespan Range Is Estimated"; }

function pz_methodology_dog_lifespan_calc() { ?>
    <p style="color:#555;margin-bottom:20px">This calculator uses population-level veterinary data — not a prediction about any individual dog — to give you a general range that's useful for long-term planning and preventive care scheduling.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">📏</div>
        <strong>Breed Size</strong>
        <p>Smaller dogs consistently average longer lifespans than larger and giant breeds across veterinary population studies — one of the most well-established patterns in canine health data.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">✂️</div>
        <strong>Spay/Neuter Status</strong>
        <p>Population data shows spayed and neutered dogs average roughly one to one and a half years longer than intact dogs, largely tied to reduced risk of certain cancers and reproductive illness.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">❤️</div>
        <strong>Overall Health</strong>
        <p>Dogs managing one or more chronic conditions may see the general range shift — which is exactly why your vet's specific guidance always outweighs a population average.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🎂</div>
        <strong>Current Life Stage</strong>
        <p>Where your dog sits in their life stage today — puppy, young adult, adult, or senior — shapes what kind of preventive care matters most right now.</p>
      </div>
    </div>
<?php }

function pz_faq_dog_lifespan_calc() {
    return [
        ["How accurate is a breed-size lifespan average for my dog?", "It's a population statistic drawn from many dogs of similar size, not a measurement of your specific dog. Individual lifespan varies widely based on genetics, diet, weight management, and the quality of veterinary care a dog receives throughout life."],
        ["Does spaying or neutering really add years?", "Population studies consistently show spayed and neutered dogs averaging roughly one to one and a half years longer than intact dogs, largely linked to reduced risk of certain reproductive cancers and illnesses. Talk to your vet about the right timing for your individual dog."],
        ["Why do giant breeds have shorter average lifespans?", "This is a well-documented pattern in veterinary research — larger dogs tend to grow faster and experience more age-related wear earlier than smaller breeds. It's a population-level finding, not a statement about any one giant-breed dog."],
        ["My dog has a chronic condition — does that mean a shorter life?", "Not necessarily. Many chronic conditions are well-managed for years with consistent veterinary guidance, medication, and monitoring. Your vet's specific plan for your dog's condition is a far better guide than any general number."],
        ["Is this calculator predicting when my dog will pass away?", "No. This tool is built for planning and preventive care — helping you think about vaccination schedules, senior bloodwork timing, and general life-stage care. It is not a prediction about any individual dog's future, and genetics and care matter far more than a breed average."],
    ];
}

function pz_render_calc_dog_lifespan_calc( $tool ) {
    $icon = $tool['icon'] ?? '📅';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Dog Lifespan Calculator by Breed &amp; Size</div>
          <div class="pz-int-sublabel">A population-average range for planning and preventive care</div>
        </div>
      </div>
      <div class="pz-int-badges">
        <span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span>
        <span class="pz-int-badge pz-int-badge--blue">📊 Population Data</span>
      </div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Breed Size Category</label>
          <select id="pz_ls_size" class="pz-int-select">
            <option value="toy">Toy (adult target 4–10 lbs)</option>
            <option value="small">Small (adult target 10–25 lbs)</option>
            <option value="medium" selected>Medium (adult target 25–60 lbs)</option>
            <option value="large">Large (adult target 60–100 lbs)</option>
            <option value="giant">Giant (adult target 100+ lbs)</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Current Age</label>
          <div class="pz-int-input-wrap">
            <input type="number" id="pz_ls_age" class="pz-int-input" placeholder="e.g. 4" min="0" max="25" step="0.5">
            <span class="pz-int-input-suffix">years</span>
          </div>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Spayed / Neutered</label>
          <select id="pz_ls_fixed" class="pz-int-select">
            <option value="yes" selected>Yes</option>
            <option value="no">No</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Overall Health</label>
          <select id="pz_ls_health" class="pz-int-select">
            <option value="excellent" selected>Excellent, no known issues</option>
            <option value="good">Good, minor issues managed</option>
            <option value="fair">Fair, one or more chronic conditions</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzCalcDogLifespan()">
        <span class="pz-int-btn-icon"><?php echo $icon; ?></span>
        See My Dog's Lifespan Range
      </button>
      <div id="pz-calc-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

function pz_what_is_dog_lifespan_calc() {
    ob_start(); ?>
    <p>The Dog Lifespan Calculator gives you a general population-average lifespan range for your dog's breed-size category, adjusted for spay/neuter status and overall health, so you can plan preventive care around the life stages ahead. It draws on established veterinary population data — the same kind of pattern vets reference when timing vaccine schedules, senior wellness visits, and bloodwork.</p>
    <p>This is intentionally framed as a planning tool, not a prediction. Genetics, diet, weight management, and the quality of veterinary care a dog receives shape an individual dog's actual lifespan far more than any breed-size average ever could. The number this calculator gives you is a starting point for thinking about what kind of preventive care matters at each stage of your dog's life — nothing more, and nothing to worry over.</p>
    <p>Enter your dog's breed size, current age, spay/neuter status, and health status above to see your result, then scroll down for the reasoning behind the ranges and a calmly-written FAQ covering the questions dog owners most often have about breed lifespan averages.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_lifespan_calc() {
    ob_start(); ?>
    <p>A general lifespan range isn't about predicting the future — it's a practical planning tool that helps you time preventive care to the stage your dog is actually in.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🗓️</span>
        <div>
          <strong>Preventive Care Planning</strong>
          <p>Knowing roughly where your dog sits on their expected life-stage timeline helps you and your vet plan when to start senior bloodwork, joint support, and more frequent wellness visits.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">✂️</span>
        <div>
          <strong>Spay/Neuter Context</strong>
          <p>Understanding the population-level benefit of spaying or neutering can help inform that conversation with your vet, alongside your dog's individual health and breed considerations.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🎯</span>
        <div>
          <strong>Life-Stage-Appropriate Care</strong>
          <p>A giant breed and a toy breed reach "senior" status at very different ages — knowing your dog's life stage helps you and your vet apply age-appropriate care rather than a one-size-fits-all schedule.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🙂</span>
        <div>
          <strong>Calm, Realistic Framing</strong>
          <p>This tool is built to inform planning, not to alarm. Population averages are just that — averages — and your individual dog's genetics and care matter far more than any general number.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_lifespan_calc() {
    return [
        ['title'=>"Select Your Dog's Breed-Size Category", 'desc'=>"Choose Toy, Small, Medium, Large, or Giant. This sets the population-average baseline range the rest of the result builds from."],
        ['title'=>"Enter Your Dog's Current Age", 'desc'=>"This determines their current life stage — puppy, young adult, adult, or senior — which is shown alongside the lifespan range."],
        ['title'=>'Note Spay/Neuter Status', 'desc'=>"Spayed and neutered dogs average a slightly longer lifespan at the population level — enter this accurately for the most relevant range."],
        ['title'=>'Select Overall Health Status', 'desc'=>"Choose the option that best reflects your dog's current health. Dogs managing chronic conditions get gentler framing that points toward their vet's specific guidance."],
        ['title'=>'Review Your Range and Life Stage', 'desc'=>"Read the average range for your dog's profile along with their current life-stage label — this is your planning reference, not a countdown."],
        ['title'=>'Use It to Plan, Not to Worry', 'desc'=>"Use your result to think about preventive care timing — senior bloodwork, joint support, more frequent checkups — rather than as a prediction to dwell on."],
    ];
}

function pz_tips_dog_lifespan_calc() {
    return [
        ['Schedule Wellness Visits by Life Stage, Not Just Age', "A senior-stage dog benefits from more frequent wellness visits than a young adult, regardless of the exact number of years — use life stage, not age alone, to set your visit schedule."],
        ['Start Senior Bloodwork Earlier for Giant Breeds', "Giant breeds often benefit from starting senior-level bloodwork and joint support around age 5 to 6, well before the age a small-breed dog would need the same shift."],
        ['Weight Management Extends Healthy Years', "Keeping your dog at a healthy body condition score is one of the most impactful, controllable factors in supporting a longer healthy lifespan — more so than breed size alone."],
        ["Dental Care Matters More Than Owners Expect", "Untreated dental disease can affect organs beyond the mouth over time. Regular dental care is a straightforward, often-overlooked way to support long-term health."],
        ['Research Breed-Specific Health Risks Before Adopting', "If you're choosing a breed, understanding common breed-specific health conditions ahead of time helps you plan preventive care from day one rather than reacting later."],
    ];
}

function pz_mistakes_dog_lifespan_calc() {
    return [
        ['❌ Treating the Average as a Guarantee', "A breed-size lifespan range is a population statistic, not a promise about any individual dog. Many dogs live well beyond their breed average with good genetics and consistent care."],
        ['❌ Skipping Preventive Care While a Dog Is "Still Young"', "Preventive habits — dental care, weight management, regular checkups — matter most when started early, well before any age-related issue would show up on its own."],
        ["❌ Waiting Too Long to Start Senior-Level Care in Giant Breeds", "Giant breeds age faster than the numbers alone suggest — waiting until a dog is chronologically 7 to start senior care means starting years later than their body actually needs."],
        ['❌ Comparing Your Dog Anxiously to the Average Number', "A dog living near or slightly under a breed average is not automatically a cause for worry — individual variation is normal and expected. Focus on your vet's assessment of your specific dog over the general number."],
        ['❌ Ignoring Your Vet\'s Individual Guidance in Favor of a General Range', "If your vet has given you a specific outlook based on your dog's actual health history, that individualized guidance should always take priority over any population-average calculator."],
    ];
}

/* ══ 4. Dog Deworming Schedule Calculator (dog_deworming_schedule) ══ */

function pz_hero_quickanswer_dog_deworming_schedule() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Puppies need deworming every 2 weeks until 12 weeks old, then monthly until 6 months. Adult dogs on a monthly parasite preventive typically need a check every 3 months, shifting to monthly if they hunt, scavenge, or have high outdoor exposure. Enter your dog's details above for their exact schedule.</div>
<?php }

function pz_hero_trust_dog_deworming_schedule() { ?>
      <span>✅ Vet-protocol based</span>
      <span>✅ Exposure-level aware</span>
      <span>✅ Free calendar reminder</span>
<?php }

function pz_methodology_heading_dog_deworming_schedule() { return "What Decides Your Dog's Deworming Schedule"; }

function pz_methodology_dog_deworming_schedule() { ?>
    <p style="color:#555;margin-bottom:20px">The calculator follows the standard veterinary deworming protocol, adjusted for how much parasite exposure your dog realistically gets day to day.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🐶</div>
        <strong>Age &amp; Growth Stage</strong>
        <p>Puppies are dewormed most frequently of all because they can be born with roundworms passed from their mother, or pick them up through nursing — frequent early treatment breaks that cycle.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🌳</div>
        <strong>Lifestyle Exposure</strong>
        <p>Dogs that hunt, scavenge, or eat wildlife or feces face substantially higher reinfection risk than dogs with limited outdoor access, which is why exposure level shifts the recommended frequency.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">💊</div>
        <strong>Parasite Preventive Use</strong>
        <p>Many monthly heartworm and parasite preventives also control common intestinal parasites, which is part of why a quarterly check is often enough for lower-risk adult dogs already on one.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🔬</div>
        <strong>Fecal Testing</strong>
        <p>Your vet's fecal exam result and knowledge of local parasite prevalence should always fine-tune this general schedule for your specific dog and area.</p>
      </div>
    </div>
<?php }

function pz_faq_dog_deworming_schedule() {
    return [
        ["Why do puppies need deworming so often?", "Puppies can be born with roundworms passed from their mother across the placenta, or pick them up through nursing shortly after birth. Frequent early treatment — every 2 weeks until 12 weeks, then monthly until 6 months — breaks the parasite life cycle before it causes health problems."],
        ["Does my adult dog still need routine deworming if they're on heartworm prevention?", "Many monthly heartworm preventives also treat or control common intestinal parasites, but not every product covers every parasite type. A periodic dewormer or fecal check — typically quarterly for low-exposure dogs — is still generally recommended as a safety net."],
        ["What if my dog hunts or eats wild animal droppings?", "Dogs with this kind of exposure face meaningfully higher reinfection risk, since they're repeatedly exposed to parasite eggs and larvae in the environment. Shifting to a monthly schedule is the standard adjustment for high-exposure lifestyles."],
        ["How do I know if my dog has worms?", "Possible signs include visible worms or segments in stool, a bloated or pot-bellied appearance in puppies, unexplained weight loss, a dull coat, or scooting. That said, dogs can carry a parasite load without obvious symptoms — a fecal test is the only reliable way to know for sure."],
        ["Can I just deworm on a fixed schedule without a fecal test?", "A fixed schedule is a reasonable general baseline, but it isn't a substitute for testing. Your vet's fecal exam result and knowledge of local parasite prevalence should fine-tune both the frequency and the specific product used for your dog."],
    ];
}

function pz_render_calc_dog_deworming_schedule( $tool ) {
    $icon = $tool['icon'] ?? '💊';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Dog Deworming Schedule Calculator</div>
          <div class="pz-int-sublabel">Vet-protocol timing based on age and lifestyle exposure</div>
        </div>
      </div>
      <div class="pz-int-badges">
        <span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span>
        <span class="pz-int-badge pz-int-badge--blue">📅 Next-Due Date</span>
      </div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Age Group</label>
          <select id="pz_dw2_age" class="pz-int-select">
            <option value="puppy_young">Puppy under 12 weeks</option>
            <option value="puppy_older">Puppy 12 weeks – 6 months</option>
            <option value="adult" selected>Adult (6 months+)</option>
            <option value="senior">Senior</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Lifestyle Exposure</label>
          <select id="pz_dw2_exposure" class="pz-int-select">
            <option value="low">Mostly indoor, low exposure</option>
            <option value="moderate" selected>Regular outdoor access</option>
            <option value="high">Hunts, scavenges, or eats wildlife/feces</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Last Deworming Date <span class="pz-int-optional">(optional — for your next-due date)</span></label>
          <input type="date" id="pz_dw2_last" class="pz-int-input">
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzCalcDewormingSchedule()">
        <span class="pz-int-btn-icon"><?php echo $icon; ?></span>
        Get My Dog's Deworming Schedule
      </button>
      <div id="pz-calc-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

function pz_what_is_dog_deworming_schedule() {
    ob_start(); ?>
    <p>The Dog Deworming Schedule Calculator applies the standard veterinary deworming protocol to your dog's specific age group and lifestyle exposure, giving you a concrete frequency — and, if you enter your last deworming date, an exact next-due date — instead of a vague "regularly" recommendation.</p>
    <p>Intestinal parasites are extremely common, especially in puppies, and some — including roundworms and hookworms — can even spread to people, particularly children, making consistent deworming a household health matter and not just a dog health one. Skipping or spacing out deworming too far apart lets reinfection cycles continue, especially for dogs with meaningful outdoor exposure.</p>
    <p>Select your dog's age group and lifestyle exposure above to get your schedule, then scroll down for the reasoning behind each interval and the FAQ covering the deworming questions dog owners ask most often.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_deworming_schedule() {
    ob_start(); ?>
    <p>Deworming frequency isn't one-size-fits-all — a schedule built for age and exposure catches parasites more reliably than a generic reminder.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">👶</span>
        <div>
          <strong>Zoonotic Risk to People</strong>
          <p>Some intestinal parasites, including roundworms and hookworms, can spread to humans — especially children who play in soil or grass frequented by dogs — making a consistent schedule a household health matter.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🐶</span>
        <div>
          <strong>Puppy Vulnerability</strong>
          <p>Puppies are especially vulnerable since they can be born with parasites or infected through nursing, and heavy parasite loads can affect their growth and development if not addressed early.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🔁</span>
        <div>
          <strong>Reinfection Cycles From Exposure</strong>
          <p>Dogs that hunt, scavenge, or spend a lot of time outdoors are repeatedly exposed to parasite eggs and larvae in soil and other animals' waste, which is why exposure level — not just age — belongs in the schedule.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💰</span>
        <div>
          <strong>Prevention Costs Less Than Treatment</strong>
          <p>Routine deworming is inexpensive compared to treating a heavy parasite burden or the secondary health issues it can cause — a consistent schedule is the cost-effective path.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_deworming_schedule() {
    return [
        ['title'=>"Select Your Dog's Age Group", 'desc'=>"Choose the option that matches your dog's current age — puppy under 12 weeks, puppy 12 weeks to 6 months, adult, or senior. This sets the baseline interval."],
        ['title'=>'Select Lifestyle Exposure', 'desc'=>"Be honest about how much outdoor, hunting, or scavenging exposure your dog gets — this is what shifts an adult dog from a quarterly to a monthly schedule."],
        ['title'=>'Enter Your Last Deworming Date If Known', 'desc'=>"Adding this optional date lets the calculator show you an exact next-due date instead of just a general interval."],
        ['title'=>'Review Your Recommended Frequency', 'desc'=>"Read your interval and, if provided, your next-due date, along with the reasoning specific to your dog's age and exposure level."],
        ['title'=>'Add a Calendar Reminder', 'desc'=>"Use the calendar link to set a reminder for the next-due date so you're not relying on memory for a recurring task."],
        ['title'=>"Confirm With a Fecal Test at Your Vet", 'desc'=>"Bring a fresh stool sample to your next vet visit — a fecal test confirms whether this general schedule needs to be adjusted for your dog specifically."],
    ];
}

function pz_tips_dog_deworming_schedule() {
    return [
        ['Bring a Fresh Stool Sample to Checkups', "A fecal test is the most reliable way to know whether your dog currently has a parasite burden — bring a same-day sample to your vet visit for the most accurate result."],
        ['Clean Up Yard Waste Promptly', "Picking up feces quickly, both in your yard and on walks, reduces the amount of parasite eggs that can survive in the environment and cause reinfection."],
        ["Monthly Preventives Don't Replace Every Check", "Even dogs on a monthly heartworm and parasite preventive can benefit from periodic fecal testing, since not every product controls every parasite type equally."],
        ['Keep Dogs From Scavenging When Possible', "Discouraging your dog from eating found items, wildlife carcasses, or other animals' feces on walks meaningfully lowers their reinfection risk."],
        ['Treat All Household Pets on the Same Schedule', "If you have multiple dogs or cats, treating them together rather than staggered helps prevent pets from reinfecting each other between treatments."],
    ];
}

function pz_mistakes_dog_deworming_schedule() {
    return [
        ['❌ Stopping After the Puppy Series Ends', "The puppy deworming series breaks the early-life parasite cycle, but it doesn't provide lifetime protection — adult dogs still need an ongoing schedule based on their exposure level."],
        ['❌ Assuming Heartworm Prevention Covers All Worm Types', "Not every monthly heartworm preventive controls every intestinal parasite. Check your specific product's label and confirm coverage with your vet rather than assuming full protection."],
        ['❌ Skipping Fecal Tests Because the Dog Seems Fine', "Dogs can carry a parasite burden without obvious symptoms. Relying on visible signs alone means many cases go undetected until the load is significant."],
        ["❌ Treating Only One Pet in a Multi-Pet Household", "Pets in the same household can reinfect each other through shared spaces. Deworming on a staggered or partial basis often undoes the benefit of treating any one pet."],
        ['❌ Not Adjusting for a New High-Exposure Lifestyle', "A dog that starts hunting, visiting dog parks heavily, or spending more time outdoors needs a more frequent schedule than one still following an old, lower-exposure routine."],
    ];
}

/* ══ 5. Dog Pregnancy Calculator (dog_pregnancy_calc) ══ */

function pz_hero_quickanswer_dog_pregnancy_calc() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Canine pregnancy lasts about 63 days from ovulation. Since the exact ovulation date is rarely known, this calculator estimates a due-date window of 61 to 65 days from the mating date you enter. Add the date above to see your estimated due-date range and current trimester.</div>
<?php }

function pz_hero_trust_dog_pregnancy_calc() { ?>
      <span>✅ 61–65 day due window</span>
      <span>✅ Trimester &amp; vet-checkpoint guide</span>
      <span>✅ Free calendar reminder</span>
<?php }

function pz_methodology_heading_dog_pregnancy_calc() { return "How the Due Date Range Is Estimated"; }

function pz_methodology_dog_pregnancy_calc() { ?>
    <p style="color:#555;margin-bottom:20px">Canine gestation length is remarkably consistent across breeds — the range in this calculator comes from the uncertainty around exactly when mating led to ovulation, not from breed differences.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">📆</div>
        <strong>Gestation Length</strong>
        <p>Canine pregnancy runs about 63 days from ovulation, consistently across toy through giant breeds — gestation length itself doesn't vary meaningfully by size.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🔬</div>
        <strong>Ovulation vs. Mating Date</strong>
        <p>Because mating can happen a few days before or after ovulation, and sperm can survive inside the female for several days, a due-date range is more honest than a single exact date.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🐾</div>
        <strong>Trimester Milestones</strong>
        <p>Each third of the pregnancy lines up with a different stage of puppy development and a different vet checkpoint — ultrasound confirmation, then an X-ray puppy count, then whelping preparation.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🐕</div>
        <strong>Breed Size &amp; Litter Size</strong>
        <p>Litter size tends to track loosely with breed size, though this is a general tendency for context — gestation length itself stays the same across all sizes.</p>
      </div>
    </div>
<?php }

function pz_faq_dog_pregnancy_calc() {
    return [
        ["How long are dogs pregnant?", "Canine gestation is about 63 days from ovulation. Since the exact ovulation date is rarely known from the mating date alone, this calculator gives you a due-date window of 61 to 65 days from the mating date you enter, which covers the normal range of when ovulation likely occurred."],
        ["When can a vet confirm my dog is pregnant?", "An ultrasound can typically confirm pregnancy starting around day 28 from mating. This is the earliest reliable confirmation point — earlier tests are generally not accurate enough to rely on."],
        ["When can I find out how many puppies to expect?", "An X-ray from around day 45 onward, once puppy skeletons have started to calcify, gives a much more accurate puppy count than an ultrasound. This is the standard way vets estimate litter size before whelping."],
        ["What should I prepare before the due date?", "Set up a quiet, clean whelping box in a low-traffic area a week or two before the due-date window begins. Learn the signs of approaching labor — nesting behavior, restlessness, and a temperature drop — and keep your vet's contact information easily accessible."],
        ["What if my dog goes past 65 days without labor starting?", "If more than 65 days have passed since the mating date without labor starting, contact your vet promptly. It's a reasonable, precautionary step to have mom and the pregnancy checked rather than waiting indefinitely."],
    ];
}

function pz_render_calc_dog_pregnancy_calc( $tool ) {
    $icon = $tool['icon'] ?? '🤰';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Dog Pregnancy Calculator &amp; Whelping Guide</div>
          <div class="pz-int-sublabel">Due-date window, current trimester, and vet checkpoints</div>
        </div>
      </div>
      <div class="pz-int-badges">
        <span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span>
        <span class="pz-int-badge pz-int-badge--blue">📅 61–65 Day Window</span>
      </div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Breeding / Mating Date</label>
          <input type="date" id="pz_preg_date" class="pz-int-input" required>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Breed Size <span class="pz-int-optional">(for typical litter size reference)</span></label>
          <select id="pz_preg_size" class="pz-int-select">
            <option value="toy">Toy (adult target 4–10 lbs)</option>
            <option value="small">Small (adult target 10–25 lbs)</option>
            <option value="medium" selected>Medium (adult target 25–60 lbs)</option>
            <option value="large">Large (adult target 60–100 lbs)</option>
            <option value="giant">Giant (adult target 100+ lbs)</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzCalcDogPregnancy()">
        <span class="pz-int-btn-icon"><?php echo $icon; ?></span>
        Calculate My Due-Date Window
      </button>
      <div id="pz-calc-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

function pz_what_is_dog_pregnancy_calc() {
    ob_start(); ?>
    <p>The Dog Pregnancy Calculator estimates your dog's due-date window from the mating date you enter, using the well-established fact that canine gestation runs about 63 days from ovulation. Because the exact ovulation date usually isn't known, the calculator gives you a 61-to-65-day range rather than pretending to know one precise date, along with your dog's current estimated day of pregnancy and trimester.</p>
    <p>Knowing roughly where your dog is in pregnancy helps you plan the right things at the right time — scheduling an ultrasound confirmation around day 28, an X-ray puppy count from day 45 onward, and having a whelping box ready well before the due-date window opens. Preparation matters here, and a calm, informed timeline beats guesswork.</p>
    <p>Enter your dog's mating date above to see your due-date window and current trimester, then scroll down for the vet-checkpoint timeline and the FAQ covering the questions owners ask most during this exciting stretch of waiting.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_pregnancy_calc() {
    ob_start(); ?>
    <p>Knowing an approximate timeline turns an uncertain waiting period into a set of clear, plannable steps.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🩺</span>
        <div>
          <strong>Prenatal Care Timing</strong>
          <p>Knowing roughly what day of pregnancy your dog is on helps you schedule the ultrasound confirmation and X-ray puppy count at the right points, rather than too early to be useful or too late to be helpful.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">📦</span>
        <div>
          <strong>Whelping Preparedness</strong>
          <p>A due-date window gives you a realistic timeframe to set up a quiet whelping area and gather supplies well ahead of time, rather than scrambling once labor starts.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">📞</span>
        <div>
          <strong>Knowing When to Call the Vet</strong>
          <p>Understanding the normal 61-to-65-day window means you'll recognize promptly if your dog goes meaningfully past it — a clear signal to check in with your vet rather than wait indefinitely.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🐾</span>
        <div>
          <strong>Realistic Litter Expectations</strong>
          <p>General breed-size litter size tendencies help set reasonable expectations ahead of the X-ray count, while you wait for the more accurate day-45-plus confirmation.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_pregnancy_calc() {
    return [
        ['title'=>'Enter the Mating Date', 'desc'=>"Enter the date mating occurred as accurately as you can — this is the single most important input, since the whole due-date window is calculated from it."],
        ['title'=>"Note Breed Size for Litter Context", 'desc'=>"Select your dog's breed size to see a general litter-size tendency for context — this doesn't affect the due-date calculation itself, only the reference framing."],
        ['title'=>'Review Your Due-Date Window', 'desc'=>"Read your estimated 61-to-65-day due-date range along with your dog's current estimated day of pregnancy and trimester."],
        ['title'=>'Mark the Day-28 Ultrasound Checkpoint', 'desc'=>"Schedule an ultrasound around day 28 from the mating date to get vet confirmation of pregnancy."],
        ['title'=>'Mark the Day-45+ X-ray Checkpoint', 'desc'=>"Plan an X-ray from around day 45 onward for a much more accurate puppy count than an early ultrasound can provide."],
        ['title'=>'Prepare the Whelping Box in the Final Week', 'desc'=>"Set up a quiet, clean whelping area before the due-date window opens, and review the signs of approaching labor so you recognize them when they start."],
    ];
}

function pz_tips_dog_pregnancy_calc() {
    return [
        ['Record the Mating Date Precisely', "Write down the exact mating date as soon as it happens rather than estimating later from memory — this single date drives the entire due-date window."],
        ["Increase Food Gradually in the Final Third", "Under your vet's guidance, pregnant dogs typically need increased calories in the final third of pregnancy as puppies grow rapidly — avoid sudden large diet changes."],
        ['Set Up the Whelping Area Early, Not Last-Minute', "Introduce your dog to the whelping box a week or two before the due-date window so she's comfortable with it once labor begins."],
        ['Keep Your Vet\'s After-Hours Number Handy', "Labor can start at any hour. Having your vet's regular and after-hours or emergency contact information easy to find removes one source of stress if you need it."],
        ['Track Behavior Changes as the Due Date Approaches', "Nesting behavior, restlessness, and appetite changes often appear in the days before labor — noting them helps you recognize when things are progressing normally."],
    ];
}

function pz_mistakes_dog_pregnancy_calc() {
    return [
        ['❌ Treating the Due Date as One Exact Day', "Because ovulation timing relative to mating varies, a single exact due date is misleading — plan around the full 61-to-65-day window instead of one specific date."],
        ["❌ Skipping the Day-45+ X-ray, Relying on Ultrasound Alone", "An early ultrasound confirms pregnancy but is not reliable for counting puppies. An X-ray from day 45 onward, once skeletons calcify, gives a far more accurate count."],
        ['❌ Setting Up the Whelping Box at the Last Minute', "Introducing the whelping box only once labor starts can leave a dog unfamiliar and unsettled with the space right when calm surroundings matter most."],
        ["❌ Not Knowing the Signs of Labor Complications", "Understanding what's normal during labor versus signs that warrant an urgent call to your vet — such as prolonged straining without progress — matters more once the due-date window arrives."],
        ['❌ Waiting Indefinitely Past 65 Days', "If more than 65 days have passed since mating without labor starting, that's a clear signal to contact your vet promptly rather than continuing to wait it out."],
    ];
}

/* ══ 6. How Often Should Dogs Visit the Vet? Calculator (dog_vet_visit_frequency) ══ */

function pz_hero_quickanswer_dog_vet_visit_frequency() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Puppies need vet visits every 3–4 weeks until their vaccine series finishes around 16 weeks. Healthy adults typically need one visit a year, while healthy seniors (7+) benefit from checkups every 6 months. Dogs managing a chronic condition usually need more frequent visits — enter your dog's details above for a specific cadence.</div>
<?php }

function pz_hero_trust_dog_vet_visit_frequency() { ?>
      <span>✅ Age &amp; health aware</span>
      <span>✅ Vet-protocol cadence</span>
      <span>✅ Free calendar reminder</span>
<?php }

function pz_methodology_heading_dog_vet_visit_frequency() { return "What Decides How Often Your Dog Needs Vet Visits"; }

function pz_methodology_dog_vet_visit_frequency() { ?>
    <p style="color:#555;margin-bottom:20px">The right visit cadence changes based on life stage and health status — the calculator combines both to give you a general recommended frequency, not a one-size-fits-all annual reminder.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">💉</div>
        <strong>Vaccine Series Timing</strong>
        <p>Puppies need a tightly spaced series of visits to build immunity in stages before their maternal antibody protection fades — spacing these too far apart can leave gaps in protection.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🎂</div>
        <strong>Life Stage</strong>
        <p>Senior dogs experience health changes faster than young adults, which is why the recommended visit cadence shortens as dogs move into their senior years.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🩺</div>
        <strong>Chronic Condition Management</strong>
        <p>An ongoing condition needs closer, more frequent monitoring than a standard annual wellness exam can provide — your vet's specific plan should guide the exact cadence.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🧪</div>
        <strong>Preventive Bloodwork</strong>
        <p>Routine bloodwork at senior and chronic-condition visits often catches issues before symptoms appear, when they're generally easiest and least costly to address.</p>
      </div>
    </div>
<?php }

function pz_faq_dog_vet_visit_frequency() {
    return [
        ["How often should a healthy adult dog see the vet?", "Once a year for most healthy adult dogs under 7, covering a wellness exam, vaccine boosters as needed, and preventive care review. This annual rhythm is the standard baseline for dogs without ongoing health concerns."],
        ["Why do senior dogs need more frequent visits?", "Health changes happen faster in senior dogs, and catching a developing issue at 6 months rather than 12 makes a meaningful difference in how early it can be treated. Biannual visits — roughly every 6 months — are the standard recommendation for healthy seniors."],
        ["How often do puppies need to go to the vet?", "Roughly every 3 to 4 weeks until their vaccine series completes around 16 weeks of age. This spacing builds immunity in stages while their maternal antibody protection naturally fades."],
        ["My dog has a chronic condition — how often should we go?", "A general cadence of every 3 to 6 months is common for dogs managing an ongoing condition, but this varies significantly by the specific condition. Your vet's individualized monitoring plan should always take priority over this general guideline."],
        ["What happens at a routine senior wellness visit?", "A typical senior visit includes bloodwork, a weight and body condition check, joint and organ function screening, a dental check, and a general physical exam — aimed at catching age-related changes before they become symptomatic."],
    ];
}

function pz_render_calc_dog_vet_visit_frequency( $tool ) {
    $icon = $tool['icon'] ?? '📅';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">How Often Should Dogs Visit the Vet? Calculator</div>
          <div class="pz-int-sublabel">A recommended visit cadence based on age and health status</div>
        </div>
      </div>
      <div class="pz-int-badges">
        <span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span>
        <span class="pz-int-badge pz-int-badge--blue">📅 Next-Visit Date</span>
      </div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Age Group</label>
          <select id="pz_vv_age" class="pz-int-select">
            <option value="puppy">Puppy (under 4 months, still vaccinating)</option>
            <option value="young_adult" selected>Adult under 7 years</option>
            <option value="senior">Senior (7+ years)</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Health Status</label>
          <select id="pz_vv_health" class="pz-int-select">
            <option value="healthy" selected>Healthy, no known issues</option>
            <option value="chronic">One or more chronic conditions</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Last Vet Visit Date <span class="pz-int-optional">(optional — for your next-visit date)</span></label>
          <input type="date" id="pz_vv_last" class="pz-int-input">
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzCalcVetVisitFrequency()">
        <span class="pz-int-btn-icon"><?php echo $icon; ?></span>
        Get My Recommended Visit Schedule
      </button>
      <div id="pz-calc-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

function pz_what_is_dog_vet_visit_frequency() {
    ob_start(); ?>
    <p>The "How Often Should Dogs Visit the Vet?" Calculator gives you a recommended check-up cadence based on your dog's age group and health status — from the tightly spaced puppy vaccine series, to an annual visit for healthy adults, to the more frequent monitoring senior and chronic-condition dogs typically benefit from.</p>
    <p>Visit frequency isn't a fixed number that applies to every dog at every stage of life — a schedule built for a healthy 3-year-old under-serves a senior dog managing a chronic condition, while over-scheduling a young healthy dog wastes time and money without added benefit. Matching cadence to life stage and health status is how vets actually plan recall schedules.</p>
    <p>Select your dog's age group and health status above to get your recommended cadence, then scroll down for the reasoning behind each interval and the FAQ covering the vet-visit-frequency questions dog owners ask most.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_vet_visit_frequency() {
    ob_start(); ?>
    <p>Getting the visit cadence right — not too sparse, not unnecessarily frequent — is how routine care actually catches problems early.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🔍</span>
        <div>
          <strong>Early Disease Detection</strong>
          <p>Many conditions are far easier and less costly to treat when caught early at a routine visit than once symptoms become obvious enough to prompt an unplanned trip to the vet.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💉</span>
        <div>
          <strong>Vaccine Timing Windows</strong>
          <p>Puppy vaccines are given in a specific sequence timed around when maternal antibodies fade — spacing visits too far apart can leave gaps where a puppy isn't fully protected.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🎂</span>
        <div>
          <strong>Age-Adjusted Care</strong>
          <p>A healthy young adult and a healthy senior have genuinely different monitoring needs — matching visit frequency to life stage means neither over- nor under-scheduling care.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">📈</span>
        <div>
          <strong>Chronic Condition Monitoring</strong>
          <p>Ongoing conditions can shift gradually — more frequent visits let your vet catch and adjust for those shifts before they become a bigger problem.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_vet_visit_frequency() {
    return [
        ['title'=>"Select Your Dog's Age Group", 'desc'=>"Choose puppy, adult under 7, or senior (7+). This sets the baseline recommended visit cadence."],
        ['title'=>'Select Health Status', 'desc'=>"Indicate whether your dog is healthy or managing one or more chronic conditions — this can meaningfully shorten the recommended interval."],
        ['title'=>'Enter Your Last Vet Visit Date If Known', 'desc'=>"Adding this optional date lets the calculator show an exact next-recommended-visit date rather than just a general cadence."],
        ['title'=>'Review Your Recommended Cadence', 'desc'=>"Read your recommended visit frequency and, if provided, your next-recommended-visit date."],
        ['title'=>'Add a Calendar Reminder', 'desc'=>"Use the calendar link to set a reminder for the next-recommended visit — annual and biannual visits are easy to let slip without one."],
        ['title'=>"Follow Your Vet's Individualized Plan If Given One", 'desc'=>"If your vet has already set a specific monitoring schedule for a chronic condition, follow that plan over this general cadence."],
    ];
}

function pz_tips_dog_vet_visit_frequency() {
    return [
        ['Keep a Running List of Questions Between Visits', "Jot down questions or small concerns as they come up rather than trying to remember them at the appointment — this makes each visit more productive."],
        ["Bring a Stool or Urine Sample If Requested", "If your vet's office asks for a sample ahead of a visit, bringing a fresh one saves an extra trip and speeds up results."],
        ['Log Appetite, Weight, and Behavior Changes', "A simple running note of any changes between visits gives your vet objective information that's far more useful than trying to recall details from memory."],
        ['Get Baseline Bloodwork While Your Dog Is Healthy', "Senior dogs especially benefit from a baseline bloodwork panel done while healthy — it gives your vet a comparison point that makes future results much more meaningful."],
        ['Set a Recurring Reminder for Annual and Biannual Visits', "Wellness visits without acute symptoms are the easiest to let slip. A standing calendar reminder helps keep routine care on schedule."],
    ];
}

function pz_mistakes_dog_vet_visit_frequency() {
    return [
        ['❌ Stopping Regular Visits Once Puppy Vaccines Are Complete', "Finishing the puppy vaccine series doesn't mean visits are done — annual wellness exams remain important for healthy adult dogs going forward."],
        ['❌ Waiting for Symptoms Before Scheduling Senior Visits', "Senior dogs benefit from routine biannual visits regardless of whether anything seems wrong — many age-related changes are easiest to catch before obvious symptoms appear."],
        ["❌ Not Increasing Frequency After a Chronic Diagnosis", "A new chronic condition usually calls for more frequent monitoring than the standard annual visit — check with your vet about an adjusted schedule rather than defaulting to once a year."],
        ['❌ Assuming a Healthy-Looking Dog Doesn\'t Need Bloodwork', "Dogs can look and act completely normal while bloodwork reveals an early developing issue — routine bloodwork at senior and chronic-condition visits catches what a visual check alone can't."],
        ['❌ Treating Dental Checks as Optional', "Dental health is a standard part of routine visits, not an add-on — untreated dental disease can affect more than just the mouth over time."],
    ];
}


/* ═══════════════════════════════════════════════════════════
   NEW DOG-HEALTH TOOLS — Fever Checker, Allergy Checker,
   Parasite Prevention, Puppy Checklist, Spay/Neuter, Joint Health
═══════════════════════════════════════════════════════════ */

/* ══ 1. Dog Fever Checker (dog_fever_checker) ══ */

function pz_hero_quickanswer_dog_fever_checker() { ?>
    <div class="pz-hero-quickanswer">
      <div class="pz-hero-quickanswer-label">⚡ Quick Answer</div>
      <p>A normal dog's temperature is <strong>101°F–102.5°F</strong>, and only a rectal thermometer can confirm a true fever — this checker can't take your dog's temperature for you. What it can do is help you gauge how urgently to act based on the pattern of signs you're seeing. Answer the 5 questions below for a clear next step.</p>
    </div>
<?php }

function pz_hero_trust_dog_fever_checker() { ?>
      <span>✅ Vet-informed triage logic</span>
      <span>⚡ 5 quick questions</span>
      <span>🚨 Flags emergencies first</span>
<?php }

function pz_methodology_heading_dog_fever_checker() { return "How This Fever Risk Assessment Works"; }

function pz_methodology_dog_fever_checker() { ?>
    <p style="color:#555;margin-bottom:20px">This checker doesn't guess your dog's temperature — it can't. Instead, it works the way a vet phone-triage line does: weighing the combination and severity of signs you're seeing to judge how urgently your dog needs to be seen, with any single severe sign — like pale gums or breathing trouble — taking priority over the overall total rather than being averaged away.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🌡️</div>
        <strong>Warmth &amp; Touch</strong>
        <p>A hands-on check of ears, paws, and belly, since heat distribution changes noticeably as internal temperature climbs.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">⚡</div>
        <strong>Energy &amp; Responsiveness</strong>
        <p>Lethargy and unwillingness to get up are some of the most reliable indicators of how sick a feverish dog actually feels.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🍽️</div>
        <strong>Appetite &amp; Thirst</strong>
        <p>Reduced appetite is common with fever; refusing water too is a more urgent combination that changes the result.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🚨</div>
        <strong>Associated Symptoms &amp; Duration</strong>
        <p>Vomiting, diarrhea, breathing difficulty, and how long signs have persisted change the urgency dramatically — a single severe symptom is weighted independently, not just averaged in.</p>
      </div>
    </div>
<?php }

function pz_faq_dog_fever_checker() {
    return [
        ["What is a normal temperature for a dog?", "A healthy dog's normal body temperature is typically 101°F to 102.5°F (38.3°C to 39.2°C). A rectal reading meaningfully above that range is generally considered a fever. Ear and touch checks can suggest warmth but can't confirm an exact number."],
        ["Can I tell if my dog has a fever just by touching their ears or nose?", "Not reliably. A warm nose or ears can be normal after sleeping, playing, or being in a warm room, and a cool nose doesn't rule out fever. Touch can suggest something's off, but only a rectal thermometer reading confirms a true fever."],
        ["How can I safely take my dog's temperature at home?", "A digital rectal thermometer, lubricated and inserted about an inch, gives the most accurate reading. If you're not comfortable doing this or don't have a thermometer, use this checker's symptom pattern instead to judge urgency, and let your vet take the actual reading."],
        ["What temperature is an emergency in dogs?", "A temperature above 103.5°F (39.7°C) is generally a concern, and above 106°F (41°C) is a life-threatening emergency requiring immediate veterinary care. If you can't get a reading and your dog shows severe signs — pale or dark gums, labored breathing, or collapse — treat it as an emergency regardless of the number."],
        ["What can cause a fever in dogs besides infection?", "Infections are the most common cause, but fever can also come from vaccine reactions (usually mild and short-lived), inflammation, certain toxins, heatstroke, or less commonly some cancers. A vet visit is the only reliable way to identify the actual cause."],
    ];
}

function pz_what_is_dog_fever_checker() {
    ob_start(); ?>
    <p>The Dog Fever Checker walks through five quick questions about warmth, energy, appetite, other symptoms, and duration to give you a proportionate read on how urgently your dog needs veterinary attention — without requiring you to already own a thermometer or know what a "concerning" symptom looks like.</p>
    <p>Fever itself is a symptom, not a diagnosis — it's the body's response to infection, inflammation, or another underlying issue, and the truly informative part isn't the fever alone but what's paired with it. A mildly warm, still-playful, still-eating dog is a very different situation from a hot, lethargic dog refusing food and water, even though both might technically have "a fever."</p>
    <p>Answer the questions above for your result, then scroll down for what a true fever reading actually means and the FAQ covering the questions dog owners ask most — this checker is a guide for urgency, not a replacement for a thermometer or a vet exam.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_fever_checker() {
    ob_start(); ?>
    <p>Fever is one of the most common reasons dog owners reach out to a vet — and one of the easiest to either dangerously ignore or unnecessarily panic over. Getting the urgency level right matters:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🚨</span>
        <div>
          <strong>Some Fevers Are Emergencies</strong>
          <p>High or rapidly climbing fevers, especially paired with pale gums or breathing trouble, can indicate sepsis, heatstroke, or another life-threatening process that needs immediate care.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🏠</span>
        <div>
          <strong>Most Mild Cases Can Be Monitored</strong>
          <p>A dog that feels slightly warm but has normal energy, appetite, and behavior often just needs monitoring and a recheck in a few hours — treating every warm ear as an emergency creates unnecessary stress and cost.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🩺</span>
        <div>
          <strong>Only a Thermometer Confirms It</strong>
          <p>Touch alone can't distinguish a genuinely feverish dog from one that's simply warm from sleeping in the sun — an actual reading removes the guesswork.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⏱️</span>
        <div>
          <strong>Duration Changes the Picture</strong>
          <p>A symptom pattern that's tolerable at the 2-hour mark becomes far more concerning at the 2-day mark, which is why how long it's been going on is weighted into the result.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_fever_checker() {
    return [
        ['title'=>'Observe Before You Touch', 'desc'=>"Watch your dog's general behavior for a few minutes first — energy, posture, willingness to move — before doing a hands-on warmth check, since behavior often tells you more than touch alone."],
        ['title'=>'Check Warmth at Ears, Paws, and Belly', 'desc'=>"These areas reflect internal temperature changes more noticeably than the nose. Compare to how your dog normally feels if you can."],
        ['title'=>'Note Appetite and Thirst', 'desc'=>"Whether your dog is eating and drinking normally — or refusing one or both — is one of the strongest signals of how unwell they actually feel."],
        ['title'=>'Scan for Other Symptoms', 'desc'=>"Check gum color, breathing rate, and look for vomiting, diarrhea, or shivering. Pale or dark gums and labored breathing are signs that override everything else."],
        ['title'=>'Answer the 5 Questions Above', 'desc'=>"Work through the checker honestly rather than optimistically — an accurate answer, even an uncomfortable one, gives you a more useful result."],
        ['title'=>'Follow the Urgency Guidance', 'desc'=>"Whether your result says monitor, call today, or go now, act on it rather than waiting to see if things change on their own, especially with any high-severity result."],
    ];
}

function pz_tips_dog_fever_checker() {
    return [
        ['Confirm With a Real Thermometer', "If you own a digital rectal thermometer, use it — 101–102.5°F is the normal range for most adult dogs. A confirmed reading is always more useful than a touch-based guess."],
        ["Track How Symptoms Change Over a Few Hours", "A single snapshot can be misleading. If your result says monitor at home, recheck your dog's energy, appetite, and warmth every couple of hours rather than only once."],
        ['Keep Your Dog Hydrated', "Fever increases fluid loss. Keep fresh water available and easy to reach, especially if your dog seems reluctant to get up."],
        ["Don't Give Human Fever Medication", "Never give a dog acetaminophen (Tylenol) or ibuprofen for a suspected fever — both are toxic to dogs, even at doses that seem small. Only vet-prescribed medication is safe."],
        ['Write Down When Symptoms Started', "Vets will ask about timeline first. Noting when you first noticed warmth, lethargy, or appetite changes makes your vet call or visit faster and more useful."],
    ];
}

function pz_mistakes_dog_fever_checker() {
    return [
        ['❌ Assuming a Warm Nose Means Fever', "A warm, dry nose is often just from sleeping, sun exposure, or normal variation — it's one of the least reliable fever indicators on its own."],
        ["❌ Giving Human Medication to \"Help\"", "Tylenol and ibuprofen are toxic to dogs and can cause serious organ damage. Never medicate a feverish dog without your vet's specific guidance."],
        ['❌ Waiting Out Severe Symptoms', "Pale or dark gums, labored breathing, or an unresponsive dog are emergencies regardless of how the rest of the picture looks — waiting to see if it passes can cost critical time."],
        ["❌ Ignoring a Fever Because the Dog \"Seems Fine Otherwise\"", "Some dogs mask discomfort well. A confirmed elevated temperature is worth a vet call even if energy and appetite seem only mildly affected."],
        ['❌ Skipping the Thermometer Confirmation', "Touch and behavior are useful for judging urgency, but they can't replace an actual reading — get a confirmed number when you can, especially before any vet call so you can report it."],
    ];
}

function pz_render_checker_dog_fever_checker( $tool ) {
    $icon = $tool['icon'] ?? '🌡️';
    $questions = [
        ['q' => "Does your dog feel warm to the touch (ears, paws, belly)?", 'opts' => [
            'no'            => ['✅', 'No / unsure'],
            'warm'          => ['⚠️', 'Yes, slightly warm'],
            'hot'           => ['🚨', 'Yes, noticeably hot'],
            'hot_lethargic' => ['🚨', 'Yes, and shivering or lethargic'],
        ]],
        ['q' => "How is your dog's energy level right now?", 'opts' => [
            'normal'        => ['✅', 'Normal / active'],
            'slightly_less' => ['⚠️', 'Slightly less energetic'],
            'lethargic'     => ['🚨', 'Noticeably lethargic'],
            'unresponsive'  => ['🚨', "Won't get up / unresponsive"],
        ]],
        ['q' => "Is your dog eating and drinking normally?", 'opts' => [
            'normal'        => ['✅', 'Yes, normal'],
            'eating_less'   => ['⚠️', 'Eating less than usual'],
            'refusing_food' => ['⚠️', 'Refusing food but drinking'],
            'refusing_both' => ['🚨', 'Refusing both food and water'],
        ]],
        ['q' => "Any other symptoms present?", 'opts' => [
            'none'      => ['✅', 'None of these'],
            'gi'        => ['⚠️', 'Vomiting or diarrhea'],
            'shivering' => ['⚠️', 'Shivering or trembling'],
            'severe'    => ['🚨', 'Pale or dark gums, or difficulty breathing'],
        ]],
        ['q' => "How long has this been going on?", 'opts' => [
            'just_noticed'  => ['✅', 'Just noticed, under 2 hours'],
            'few_hours'     => ['⚠️', 'A few hours'],
            'over_24h'      => ['⚠️', 'Over 24 hours'],
            'two_plus_days' => ['🚨', '2+ days'],
        ]],
    ];
    $total = count($questions);
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Dog Fever Checker</div>
          <div class="pz-int-sublabel">5 quick questions · Get a clear next step</div>
        </div>
      </div>
      <div class="pz-int-badges">
        <span class="pz-int-badge pz-int-badge--green">✅ Vet-Informed Triage</span>
        <span class="pz-int-badge pz-int-badge--orange">🚨 Flags Emergencies First</span>
      </div>
    </div>
    <div class="pz-int-body">
      <div class="pz-checker-progress-wrap">
        <div class="pz-checker-progress-bar"><div class="pz-checker-progress-fill" id="pz-prog-fill" style="width:0%"></div></div>
        <span class="pz-checker-progress-txt" id="pz-prog-txt">Question 1 of <?php echo $total; ?></span>
      </div>
      <?php foreach ($questions as $i => $q): ?>
      <div class="pz-checker-step <?php echo $i===0?'active':''; ?>" id="pz-step-<?php echo $i; ?>">
        <div class="pz-checker-q-num">Question <?php echo $i+1; ?> / <?php echo $total; ?></div>
        <p class="pz-checker-q-text"><?php echo esc_html($q['q']); ?></p>
        <div class="pz-checker-cards">
          <?php foreach ($q['opts'] as $val => $opt): ?>
          <label class="pz-checker-card">
            <input type="radio" name="pzq_<?php echo $i; ?>" value="<?php echo esc_attr($val); ?>"
                   onchange="pzCheckerNext(<?php echo $i; ?>, <?php echo $total-1; ?>)">
            <span class="pz-checker-card-icon"><?php echo $opt[0]; ?></span>
            <span class="pz-checker-card-txt"><?php echo esc_html($opt[1]); ?></span>
          </label>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endforeach; ?>
      <button class="pz-int-btn" id="pz-checker-submit" onclick="pzCheckDogFever()" style="display:none">
        🔍 Get My Fever Risk Assessment
      </button>
      <div id="pz-checker-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ══ 2. Dog Allergy Symptoms Checker (dog_allergy_checker) ══ */

function pz_hero_quickanswer_dog_allergy_checker() { ?>
    <div class="pz-hero-quickanswer">
      <div class="pz-hero-quickanswer-label">⚡ Quick Answer</div>
      <p>Most allergic reactions in dogs are uncomfortable but not dangerous — itching, redness, occasional hot spots. A small minority progress fast into an emergency. This checker helps tell the two apart: answer the 5 questions below to find out whether you're likely looking at a manageable environmental or food allergy, or a reaction that needs a vet call today — or an emergency clinic right now.</p>
    </div>
<?php }

function pz_hero_trust_dog_allergy_checker() { ?>
      <span>✅ Distinguishes allergy types</span>
      <span>🚨 Flags anaphylaxis risk</span>
      <span>⚡ 5 quick questions</span>
<?php }

function pz_methodology_heading_dog_allergy_checker() { return "How This Allergy Risk Assessment Works"; }

function pz_methodology_dog_allergy_checker() { ?>
    <p style="color:#555;margin-bottom:20px">Most allergic reactions in dogs are uncomfortable but not dangerous — itching, redness, occasional hot spots. A small minority progress quickly and become emergencies. This checker is built to tell those apart fast, weighting facial swelling and breathing difficulty far more heavily than routine itching, because a true allergic emergency can escalate within minutes.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🩹</div>
        <strong>Symptom Type &amp; Severity</strong>
        <p>Itching alone is very different from facial swelling or hives, which is why symptom type carries the most weight in the result.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">📅</div>
        <strong>Timing Pattern</strong>
        <p>Seasonal timing points toward environmental allergens; a reaction right after a new food or treat points toward a food allergy; sudden onset out of nowhere gets flagged for closer attention.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">📍</div>
        <strong>Location on the Body</strong>
        <p>Paws and ears are the classic environmental-allergy pattern; facial or muzzle swelling is a different, far more urgent category entirely.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🫁</div>
        <strong>Breathing &amp; GI Signs</strong>
        <p>Any breathing difficulty alongside skin symptoms is treated as a possible emergency regardless of how mild everything else looks, since this is the hallmark of a serious allergic reaction.</p>
      </div>
    </div>
<?php }

function pz_faq_dog_allergy_checker() {
    return [
        ["What's the difference between a food allergy and an environmental allergy in dogs?", "Food allergies typically cause year-round itching (often with GI symptoms) and are linked to a specific ingredient — commonly chicken, beef, dairy, or wheat. Environmental allergies (pollen, dust mites, mold, fleas) often follow a seasonal pattern and tend to affect paws, ears, and the belly first. Many dogs have some combination of both, which is why a vet-guided elimination diet or allergy testing is the reliable way to pin down the exact trigger."],
        ["Can I give my dog Benadryl for allergies?", "Some vets do recommend diphenhydramine (Benadryl) for dogs, but dosing is weight-based and formulation matters — many Benadryl products contain other ingredients that are unsafe for dogs. Never give a human antihistamine without confirming the dose and product with your vet first."],
        ["What does facial swelling in a dog mean?", "Facial or muzzle swelling, especially if it comes on suddenly, can indicate a serious allergic reaction (angioedema) that can progress to anaphylaxis. This is treated as an emergency — head to a vet or emergency clinic immediately rather than waiting to see if it goes down on its own."],
        ["How long does a dog allergy flare-up usually last?", "A mild environmental flare can settle in a few days with reduced exposure and vet-guided treatment. Food allergy symptoms typically take 8–12 weeks of a strict elimination diet to fully resolve and confirm the trigger. Chronic, unmanaged allergies can persist indefinitely without identifying and addressing the actual cause."],
        ["Are some dog breeds more prone to allergies?", "Yes — breeds like French Bulldogs, Retrievers, Bulldogs, Terriers, and Shar-Peis are statistically more prone to environmental and food allergies, often related to skin barrier differences. That said, any dog of any breed can develop allergies at any age."],
    ];
}

function pz_what_is_dog_allergy_checker() {
    ob_start(); ?>
    <p>The Dog Allergy Symptoms Checker asks five questions about what symptoms you're seeing, when they happen, where they're located, and whether any breathing or GI signs are present alongside them — then gives you a proportionate next step, from home management to an emergency vet visit.</p>
    <p>Most dog allergies are environmental or food-related and, while uncomfortable, aren't dangerous — they're a quality-of-life issue to manage with your vet's guidance. But a small number of allergic reactions are true emergencies: facial swelling, hives with breathing difficulty, or a sudden severe reaction can be the start of anaphylaxis, which can become life-threatening within minutes. This checker is built to flag that difference immediately rather than averaging it into a routine "manage at home" result.</p>
    <p>Answer the questions above for your result, then scroll down for guidance on identifying and managing common allergy triggers, plus the FAQ covering the questions dog owners ask most about allergies.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_allergy_checker() {
    ob_start(); ?>
    <p>Getting the urgency right on a dog allergy matters in both directions — under-reacting to a true emergency is dangerous, and over-reacting to routine itching creates unnecessary stress and cost:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🚨</span>
        <div>
          <strong>Anaphylaxis Is Rare But Fast-Moving</strong>
          <p>True allergic emergencies in dogs can progress from first sign to life-threatening within minutes, which is why facial swelling or breathing difficulty is treated as urgent regardless of anything else in the picture.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🏠</span>
        <div>
          <strong>Most Allergies Are Manageable</strong>
          <p>The large majority of dog allergies are chronic-but-livable conditions, well controlled with trigger identification, diet changes, or vet-guided medication — not emergencies.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🔍</span>
        <div>
          <strong>Identifying the Trigger Takes Structure</strong>
          <p>Guessing at food or environmental triggers rarely works — a proper elimination diet or allergy test, done with your vet, is what actually pinpoints the cause.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💊</span>
        <div>
          <strong>Self-Medicating Carries Real Risk</strong>
          <p>Human antihistamines and other over-the-counter products can be unsafe at the wrong dose or formulation — a vet's specific guidance protects against both under- and over-treating.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_allergy_checker() {
    return [
        ['title'=>'Observe the Full Symptom Picture', 'desc'=>"Look beyond just itching — check for redness, hair loss, swelling (especially around the face), hives, and whether your dog seems otherwise normal or is showing breathing changes or vomiting."],
        ['title'=>'Note When It Started', 'desc'=>"Seasonal patterns, a recent new food or treat, or a sudden onset out of nowhere each point toward a different type of trigger — write down what changed recently."],
        ['title'=>'Check the Location', 'desc'=>"Paws and ears are the classic environmental-allergy pattern. Widespread itching or facial/muzzle swelling are different categories that need different responses."],
        ['title'=>'Watch for Breathing or GI Involvement', 'desc'=>"Any breathing difficulty alongside skin symptoms is the single most important thing to catch — this is treated as a possible emergency regardless of how mild the skin symptoms look."],
        ['title'=>'Answer the 5 Questions Above', 'desc'=>"Work through the checker for a proportionate, level-headed read on urgency based on the actual pattern you're seeing, not just the first symptom you noticed."],
        ['title'=>'Follow the Guidance and Track Response', 'desc'=>"Whether your result points to home management or a vet visit, follow it — and if you start a new diet or treatment, track your dog's response over the following weeks to help confirm what's actually working."],
    ];
}

function pz_tips_dog_allergy_checker() {
    return [
        ['Photograph Skin Changes Over Time', "Redness, hot spots, and hair loss patterns are much easier for your vet to assess from photos taken over several days than from your description alone."],
        ['Try an Elimination Diet Only Under Vet Guidance', "A proper elimination diet takes 8–12 strict weeks and reintroduces ingredients one at a time — done informally or too fast, it rarely gives a reliable answer."],
        ['Keep a Trigger Log', "Note flare-ups alongside season, recent food changes, new products, and location (indoor vs. outdoor) — patterns often become obvious after a few weeks of logging."],
        ['Ask About Year-Round Flea Prevention', "Flea allergy dermatitis is one of the most common and most overlooked triggers — consistent flea prevention rules this out as a contributing factor."],
        ['Never Give Human Antihistamines Without Vet Dosing Guidance', "Even when a human antihistamine is appropriate, the dose is weight-based and the specific product matters — confirm both with your vet before giving anything."],
    ];
}

function pz_mistakes_dog_allergy_checker() {
    return [
        ['❌ Waiting Out Facial Swelling', "Facial or muzzle swelling can be the start of a rapidly progressing allergic reaction — this is treated as an emergency, not something to watch and wait on."],
        ['❌ Guessing at Food Triggers Without a Structured Diet', "Randomly swapping foods rarely identifies the actual allergen and can drag the problem out for months. A proper vet-guided elimination diet is far more reliable."],
        ['❌ Giving Human Antihistamines at a Guessed Dose', "Dosing by guesswork, or using a combination product with other active ingredients, can be unsafe. Confirm the specific product and dose with your vet first."],
        ["❌ Assuming It's \"Just Seasonal\" Every Time", "A dog with a known seasonal allergy can still develop a new food allergy or a genuine emergency reaction — don't let a past pattern wave off new or different symptoms."],
        ['❌ Ignoring Mild Vomiting Alongside Skin Symptoms', "GI symptoms paired with skin symptoms can indicate a more significant reaction than skin symptoms alone — this combination is worth a vet call even if each symptom individually seems minor."],
    ];
}

function pz_render_checker_dog_allergy_checker( $tool ) {
    $icon = $tool['icon'] ?? '🤧';
    $questions = [
        ['q' => "What symptoms are you seeing?", 'opts' => [
            'itch_only'     => ['✅', 'Itching / scratching only'],
            'itch_red'      => ['⚠️', 'Itching plus red skin or hot spots'],
            'itch_hairloss' => ['⚠️', 'Itching plus hair loss'],
            'severe'        => ['🚨', 'Facial swelling, hives, or sudden severe symptoms'],
        ]],
        ['q' => "When do symptoms happen?", 'opts' => [
            'seasonal'     => ['✅', 'Seasonally / certain times of year'],
            'year_round'   => ['⚠️', 'Year-round'],
            'after_food'   => ['⚠️', 'Right after a new food or treat'],
            'sudden_today' => ['🚨', 'Suddenly today, never before'],
        ]],
        ['q' => "Where on the body?", 'opts' => [
            'paws_ears'     => ['✅', 'Paws / ears mainly'],
            'widespread'    => ['⚠️', 'Widespread, all over'],
            'face_swelling' => ['🚨', 'Face / muzzle swelling'],
            'after_sting'   => ['🚨', 'Just started after a bee sting or new medication'],
        ]],
        ['q' => "Any breathing difficulty or vomiting alongside the skin symptoms?", 'opts' => [
            'no'        => ['✅', 'No'],
            'vomiting'  => ['⚠️', 'Mild vomiting only'],
            'breathing' => ['🚨', 'Any breathing difficulty'],
        ]],
        ['q' => "How long has this been going on?", 'opts' => [
            'chronic' => ['✅', 'Chronic, weeks to months'],
            'days'    => ['⚠️', 'Days'],
            'hours'   => ['⚠️', 'Just started, under a few hours'],
        ]],
    ];
    $total = count($questions);
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Dog Allergy Symptoms Checker</div>
          <div class="pz-int-sublabel">5 quick questions · Get a clear next step</div>
        </div>
      </div>
      <div class="pz-int-badges">
        <span class="pz-int-badge pz-int-badge--green">✅ Vet-Informed Triage</span>
        <span class="pz-int-badge pz-int-badge--orange">🚨 Flags Emergencies First</span>
      </div>
    </div>
    <div class="pz-int-body">
      <div class="pz-checker-progress-wrap">
        <div class="pz-checker-progress-bar"><div class="pz-checker-progress-fill" id="pz-prog-fill" style="width:0%"></div></div>
        <span class="pz-checker-progress-txt" id="pz-prog-txt">Question 1 of <?php echo $total; ?></span>
      </div>
      <?php foreach ($questions as $i => $q): ?>
      <div class="pz-checker-step <?php echo $i===0?'active':''; ?>" id="pz-step-<?php echo $i; ?>">
        <div class="pz-checker-q-num">Question <?php echo $i+1; ?> / <?php echo $total; ?></div>
        <p class="pz-checker-q-text"><?php echo esc_html($q['q']); ?></p>
        <div class="pz-checker-cards">
          <?php foreach ($q['opts'] as $val => $opt): ?>
          <label class="pz-checker-card">
            <input type="radio" name="pzq_<?php echo $i; ?>" value="<?php echo esc_attr($val); ?>"
                   onchange="pzCheckerNext(<?php echo $i; ?>, <?php echo $total-1; ?>)">
            <span class="pz-checker-card-icon"><?php echo $opt[0]; ?></span>
            <span class="pz-checker-card-txt"><?php echo esc_html($opt[1]); ?></span>
          </label>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endforeach; ?>
      <button class="pz-int-btn" id="pz-checker-submit" onclick="pzCheckDogAllergy()" style="display:none">
        🔍 Get My Allergy Risk Assessment
      </button>
      <div id="pz-checker-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ══ 3. Dog Parasite Prevention Guide (dog_parasite_prevention) ══ */

function pz_hero_quickanswer_dog_parasite_prevention() { ?>
    <div class="pz-hero-quickanswer">
      <div class="pz-hero-quickanswer-label">⚡ Quick Answer</div>
      <p>A complete prevention plan has three parts: monthly heartworm preventive (blood test required first), monthly flea &amp; tick protection, and a deworming schedule set with your vet. Dogs with frequent outdoor exposure or in warm year-round climates need all three running with no gaps. Answer the 3 questions above for a plan scaled to your dog.</p>
    </div>
<?php }

function pz_hero_trust_dog_parasite_prevention() { ?>
      <span>✅ Vet-informed priority order</span>
      <span>🦟 Flea, tick &amp; heartworm covered</span>
      <span>📋 Free personalized plan</span>
<?php }

function pz_methodology_heading_dog_parasite_prevention() { return "How This Prevention Plan Is Built"; }

function pz_methodology_dog_parasite_prevention() { ?>
    <p style="color:#555;margin-bottom:20px">Parasite prevention isn't one product — it's three separate categories (heartworm, flea/tick, and intestinal worms) that need their own schedules. The guide scales each one based on your dog's exposure, your region's climate, and how much of the plan you already have in place.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🐾</div>
        <strong>Lifestyle &amp; Exposure</strong>
        <p>Dogs with frequent woods, trail, or dog-park exposure face meaningfully higher parasite risk than mostly-indoor dogs and need tighter coverage.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🌡️</div>
        <strong>Regional Climate</strong>
        <p>Warm year-round climates keep fleas, ticks, and mosquitoes (which spread heartworm) active every month — cold winters reduce but don't eliminate the risk.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">📋</div>
        <strong>Current Coverage Gaps</strong>
        <p>The plan identifies exactly which of the three protection types is missing or inconsistent, rather than repeating generic advice you may already be following.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🩺</div>
        <strong>Vet-Set Priority Order</strong>
        <p>When multiple gaps exist, heartworm prevention comes first — heartworm treatment is far more dangerous and expensive than prevention — followed by flea/tick, then deworming.</p>
      </div>
    </div>
<?php }

function pz_faq_dog_parasite_prevention() {
    return [
        ["Do indoor dogs need parasite prevention?", "Yes, though the risk is lower than for dogs with regular outdoor exposure. Fleas hitch rides indoors on humans, other pets, or through screens, and mosquitoes (which spread heartworm) can get inside too. Most vets still recommend at least baseline monthly heartworm and flea/tick prevention for indoor dogs, especially in warmer climates."],
        ["Why does heartworm prevention need a blood test first?", "Giving heartworm preventive to a dog that's already infected can trigger a dangerous, sometimes fatal reaction as the medication rapidly affects existing worms and larvae. A quick vet blood test confirms your dog is heartworm-negative before starting or restarting monthly prevention."],
        ["Can I skip parasite prevention in winter?", "It depends on your climate. In regions with hard freezes, flea, tick, and mosquito activity drops significantly in winter, and some vets allow a seasonal pause. In warm year-round climates, or for dogs with any indoor flea history, most vets recommend continuing monthly prevention through winter too."],
        ["How is deworming different from heartworm and flea/tick prevention?", "Deworming targets intestinal parasites (roundworms, hookworms, tapeworms, whipworms) picked up through contaminated soil, feces, or prey — a separate category from heartworm (spread by mosquitoes) and fleas/ticks (external parasites). Many monthly heartworm products include some intestinal parasite coverage, but your vet can confirm what your specific product covers."],
        ["What happens if my dog gets heartworm?", "Heartworm treatment involves a series of injections, strict activity restriction for weeks to months, and carries real risk and significant cost — far more of all three than monthly prevention. This is why closing a heartworm prevention gap is treated as the top priority whenever multiple gaps exist."],
    ];
}

function pz_what_is_dog_parasite_prevention() {
    ob_start(); ?>
    <p>The Dog Parasite Prevention Guide builds a three-part protection plan — heartworm, flea/tick, and deworming — scaled to your dog's lifestyle, your region's climate, and what you already have in place. Rather than a generic "use monthly prevention" line, it tells you specifically which gaps to close first and why.</p>
    <p>Parasite prevention is really three separate systems working together: a monthly heartworm preventive (which requires a vet blood test before starting), monthly external parasite protection against fleas and ticks, and a periodic deworming schedule for intestinal parasites. Skipping or being inconsistent with any one of the three leaves a real gap, even if the other two are covered.</p>
    <p>Answer the questions above for your personalized plan, then scroll down for the reasoning behind the priority order and the FAQ covering the parasite prevention questions dog owners ask most.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_parasite_prevention() {
    ob_start(); ?>
    <p>Parasites aren't just an itching nuisance — several of them cause serious, expensive, and sometimes fatal disease if prevention lapses. Here's what's actually at stake:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">❤️</span>
        <div>
          <strong>Heartworm Is Preventable But Dangerous Untreated</strong>
          <p>Heartworm disease damages the heart and lungs and can be fatal. Monthly prevention is inexpensive and highly effective; treatment after infection is risky, restrictive, and far more costly.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🦟</span>
        <div>
          <strong>Fleas and Ticks Spread Disease, Not Just Itching</strong>
          <p>Beyond skin irritation and flea allergy dermatitis, ticks transmit Lyme disease, ehrlichiosis, and other serious infections — consistent prevention is what actually blocks transmission.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🪱</span>
        <div>
          <strong>Intestinal Worms Affect Nutrition and Growth</strong>
          <p>Untreated intestinal parasites can cause weight loss, poor coat condition, and in puppies, stunted growth — regular deworming keeps this in check.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">👪</span>
        <div>
          <strong>Some Parasites Are Zoonotic</strong>
          <p>Certain intestinal parasites and fleas can be transmitted to humans, particularly children — consistent prevention protects your household, not just your dog.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_parasite_prevention() {
    return [
        ['title'=>"Identify Your Dog's Exposure Level", 'desc'=>"Mostly indoor, regular outdoor/yard time, or frequent woods, trails, and other dogs — this sets the baseline risk the rest of the plan scales from."],
        ['title'=>"Note Your Region's Climate", 'desc'=>"Warm year-round climates keep parasites active every month; seasonal climates with hard winters reduce but don't eliminate the risk."],
        ['title'=>"Review What You Currently Have Covered", 'desc'=>"Be honest about whether you're on nothing, some inconsistent products, or full monthly prevention — the plan is built around closing your actual gaps."],
        ['title'=>"Get Your Personalized 3-Part Plan", 'desc'=>"Review your heartworm, flea/tick, and deworming recommendations, prioritized in the order that matters most for your dog's situation."],
        ['title'=>"Book a Vet Visit for the Heartworm Blood Test", 'desc'=>"If heartworm prevention isn't already running, this blood test is required before starting — it confirms your dog isn't already infected."],
        ['title'=>"Set Monthly Reminders", 'desc'=>"Once your plan is running, monthly consistency is what actually protects your dog — a reminder each month prevents gaps from creeping back in."],
    ];
}

function pz_tips_dog_parasite_prevention() {
    return [
        ['Give Preventives on the Same Date Each Month', "Picking a fixed date — like the 1st of the month — makes monthly prevention far easier to stay consistent with than trying to remember a rolling date."],
        ["Check Your Dog After Every Outdoor Outing in Tick Season", "A quick hands-on check for ticks after hikes or tall-grass walks catches them before they've had time to attach and transmit disease."],
        ['Treat the Yard, Not Just the Dog', "Fleas and ticks live in yard vegetation and shaded areas, not just on your dog — treating the yard alongside your dog's prevention reduces overall exposure."],
        ["Don't Assume One Product Covers Everything", "Not every monthly product covers heartworm, fleas, ticks, and intestinal worms all at once — check your specific product's label or ask your vet exactly what it protects against."],
        ['Keep Prevention Records', "Note the date and product for each dose given — this avoids double-dosing or missed months and gives your vet a clear history at checkups."],
    ];
}

function pz_mistakes_dog_parasite_prevention() {
    return [
        ['❌ Starting Heartworm Prevention Without a Blood Test', "Giving heartworm preventive to an already-infected dog can trigger a dangerous reaction. Always confirm heartworm-negative status with a vet blood test first."],
        ['❌ Stopping Prevention Over Winter in a Mild Climate', "Fleas, ticks, and mosquitoes can remain active through mild winters or survive indoors — a full seasonal pause carries real risk outside of genuinely hard-freeze climates."],
        ['❌ Treating Deworming as a One-Time Event', "Intestinal parasites can be picked up repeatedly from soil, feces, or prey — deworming is an ongoing schedule set with your vet, not a single treatment you complete once."],
        ['❌ Assuming Indoor Dogs Are Fully Protected', "Fleas travel indoors on people and other pets, and mosquitoes get inside too — indoor-only dogs still carry meaningful risk and generally need baseline prevention."],
        ['❌ Mixing Products Without Checking Compatibility', "Combining certain flea/tick and heartworm products without vet guidance can lead to overdosing or gaps in coverage — check with your vet before layering multiple products."],
    ];
}

function pz_render_guide_dog_parasite_prevention( $tool ) {
    $icon = $tool['icon'] ?? '🦟';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Dog Parasite Prevention Plan Builder</div>
          <div class="pz-int-sublabel">Flea, tick &amp; heartworm · Free · Instant</div>
        </div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--blue">🦟 3-Part Plan</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Lifestyle</label>
          <select id="pz_pp_lifestyle" class="pz-int-select">
            <option value="indoor">Mostly indoor</option>
            <option value="outdoor" selected>Regular outdoor / yard time</option>
            <option value="high_exposure">Frequent woods / trails / other dogs</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Current Prevention</label>
          <select id="pz_pp_current" class="pz-int-select">
            <option value="none">Nothing currently</option>
            <option value="some" selected>Some products, not consistent</option>
            <option value="full">Full monthly prevention year-round</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Region Climate</label>
          <select id="pz_pp_climate" class="pz-int-select">
            <option value="warm_yearround">Warm year-round (parasites active all year)</option>
            <option value="seasonal" selected>Seasonal (cold winters reduce risk)</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenParasitePrevention()">
        <span class="pz-int-btn-icon"><?php echo $icon; ?></span>
        Build My Prevention Plan
      </button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ══ 4. Puppy Health Checklist (puppy_health_checklist) ══ */

function pz_hero_quickanswer_puppy_health_checklist() { ?>
    <div class="pz-hero-quickanswer">
      <div class="pz-hero-quickanswer-label">⚡ Quick Answer</div>
      <p>What your puppy needs changes fast in the first year: deworming and no vaccines yet under 8 weeks, a 3-round core vaccine series between 8–16 weeks, boosters and a spay/neuter conversation around 4–6 months, and a rabies booster plus first adult wellness exam by 6–12 months. Select your puppy's age and vaccination status above for a checklist matched to their exact stage.</p>
    </div>
<?php }

function pz_hero_trust_puppy_health_checklist() { ?>
      <span>✅ Age-stage specific</span>
      <span>💉 Vaccine timeline included</span>
      <span>🚩 Flags mismatched vaccine status</span>
<?php }

function pz_methodology_heading_puppy_health_checklist() { return "How This Checklist Is Built"; }

function pz_methodology_puppy_health_checklist() { ?>
    <p style="color:#555;margin-bottom:20px">A puppy's health needs shift every few weeks during the first year — what's appropriate at 6 weeks (no vaccines yet, first vet visit) is very different from what's appropriate at 10 months (rabies booster, adult food transition). This checklist matches your puppy's current age window to the tasks that actually apply right now, and separately checks whether their vaccination status lines up with what's expected for that age.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">📅</div>
        <strong>Age Window</strong>
        <p>Under 8 weeks, 8–16 weeks, 4–6 months, and 6–12 months each carry a distinct set of appropriate tasks and milestones.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">💉</div>
        <strong>Vaccination Status</strong>
        <p>The core vaccine series is typically given across three rounds through the 8–16 week window — status is checked against what's typical for the current age.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🚩</div>
        <strong>Mismatch Detection</strong>
        <p>If vaccination status looks behind schedule for the selected age, the checklist flags it gently as worth an urgent vet call, rather than silently showing the generic list.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🐕</div>
        <strong>Whole-Year Coverage</strong>
        <p>From the first vet visit through the first "adult" wellness exam around 12 months, the checklist walks the full first-year arc, not just vaccines.</p>
      </div>
    </div>
<?php }

function pz_faq_puppy_health_checklist() {
    return [
        ["When should my puppy get their first vaccines?", "The core vaccine series (typically covering parvovirus, distemper, and adenovirus, among others your vet may add) usually starts around 6–8 weeks and is given across three rounds through roughly 16 weeks. Your vet sets the exact schedule based on your puppy's specific situation."],
        ["When can my puppy go to the dog park?", "Most vets recommend waiting until the core vaccine series is fully complete, typically around 16 weeks, before visiting dog parks or other areas with unknown-vaccination dogs. Before that, controlled socialization with known, healthy, vaccinated dogs is safer."],
        ["When should I spay or neuter my puppy?", "This varies by breed size — many vets recommend around 6 months for small/medium breeds, while large and giant breeds increasingly wait closer to 12–18 months for growth plate and joint health reasons. The 4–6 month window is a good time to start this conversation with your vet."],
        ["What if my puppy is behind on vaccines for their age?", "It's worth an urgent call to your vet rather than waiting for the next routine visit — being unvaccinated or under-vaccinated past the typical window leaves a puppy vulnerable to serious, preventable diseases during a high-risk period."],
        ["When does my puppy need a rabies vaccine?", "Timing is set by local law and varies by location, but it's often given toward the end of the core series or by 6 months to a year of age. Your vet will confirm the exact required timing for your area."],
    ];
}

function pz_what_is_puppy_health_checklist() {
    ob_start(); ?>
    <p>The Puppy Health Checklist gives you an age-appropriate list of what should be done, in progress, or coming up for your puppy's current stage — from the first vet visit under 8 weeks through the first "adult" wellness exam around 12 months.</p>
    <p>Puppies go through more health milestones in their first year than at any other point in their life: deworming, a multi-round core vaccine series, a spay/neuter conversation, teething, and eventually a transition to adult food and care. Missing or delaying the wrong milestone at the wrong time — especially vaccines — carries real risk, which is why this checklist also checks whether your puppy's vaccination status matches what's typical for their age.</p>
    <p>Select your puppy's age and vaccination status above for your checklist, then scroll down for the reasoning behind each stage and the FAQ covering the questions new puppy owners ask most.</p>
    <?php return ob_get_clean();
}

function pz_why_important_puppy_health_checklist() {
    ob_start(); ?>
    <p>The first year sets the foundation for your puppy's lifelong health — getting the timing right on a few key milestones matters more than people expect:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">💉</span>
        <div>
          <strong>Vaccine Timing Protects Against Serious Disease</strong>
          <p>Puppies are especially vulnerable to parvovirus and distemper before their immune system and vaccine series are complete — timing gaps leave a real window of risk.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🐕‍🦺</span>
        <div>
          <strong>Socialization Has a Critical Window</strong>
          <p>The early weeks are a key developmental period for social confidence, but need to be balanced carefully against infection risk until vaccines are complete.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🦴</span>
        <div>
          <strong>Growth-Stage Decisions Matter</strong>
          <p>Spay/neuter timing and activity levels during growth affect joint and skeletal development, especially in larger breeds — the right timing depends on breed size.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">📋</span>
        <div>
          <strong>Early Habits Set the Long-Term Baseline</strong>
          <p>The wellness exam around 12 months establishes your dog's adult health baseline — showing up prepared and on schedule makes that exam far more useful.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_puppy_health_checklist() {
    return [
        ['title'=>"Identify Your Puppy's Current Age Window", 'desc'=>"Under 8 weeks, 8–16 weeks, 4–6 months, or 6–12 months — this determines which tasks and milestones actually apply right now."],
        ['title'=>'Confirm Vaccination Status', 'desc'=>"Not started, started but not complete, or core series complete — this is checked against what's typical for your puppy's age."],
        ['title'=>'Review Your Age-Matched Checklist', 'desc'=>"Read through the specific tasks and milestones for your puppy's current stage, rather than a generic one-size-fits-all puppy list."],
        ['title'=>'Address Any Mismatch Flag Immediately', 'desc'=>"If your puppy's vaccine status looks behind schedule for their age, treat it as an urgent vet call rather than something to handle at the next routine visit."],
        ['title'=>'Schedule Upcoming Milestones', 'desc'=>"Book appointments for the next vaccine round, spay/neuter conversation, or booster before you need them, not after you realize you're behind."],
        ['title'=>'Recheck the Checklist as Your Puppy Grows', 'desc'=>"Come back and re-select the age group every few weeks through the first year to stay ahead of the next stage's tasks."],
    ];
}

function pz_tips_puppy_health_checklist() {
    return [
        ['Keep a Vaccine Record Card', "Ask your vet for a written vaccine record and keep it accessible — many boarding facilities, groomers, and dog parks require proof, and it helps track exactly what's been given."],
        ["Don't Skip the First Vet Visit Even If Your Puppy Seems Healthy", "The first visit establishes a health baseline, starts deworming, and sets the vaccine schedule — waiting until something looks wrong means starting behind."],
        ['Balance Socialization With Infection Risk', "Controlled exposure to healthy, vaccinated dogs and calm new environments during the early weeks supports development without the risk of unvaccinated-area exposure."],
        ['Start the Spay/Neuter Conversation Early', "Bring it up around 4–6 months even if you plan to wait — breed-size-specific timing takes planning, and starting the conversation early avoids a rushed decision later."],
        ['Track Growth, Not Just Weight', "Puppies grow in spurts. Tracking general growth trend and body condition with your vet matters more than chasing a specific number on any given week."],
    ];
}

function pz_mistakes_puppy_health_checklist() {
    return [
        ['❌ Taking an Under-Vaccinated Puppy to Dog Parks', "Visiting dog parks or high-traffic dog areas before the core vaccine series is complete exposes a vulnerable puppy to serious, preventable diseases like parvovirus."],
        ['❌ Assuming One Vaccine Visit Is the Whole Series', "The core series is typically given across three rounds, not one — stopping after the first shot leaves real gaps in protection."],
        ['❌ Isolating a Puppy Completely Until Vaccines Are Done', "Skipping socialization entirely to avoid infection risk can create long-term behavioral issues — controlled, careful socialization with healthy dogs can and should still happen."],
        ['❌ Waiting Too Long to Start the Spay/Neuter Conversation', "Breed-size-specific timing recommendations take planning — bringing it up for the first time at 10 months leaves little room to plan appropriately."],
        ['❌ Ignoring a Vaccine Schedule That Falls Behind', "If vaccination status doesn't match what's typical for your puppy's age, treat it as urgent rather than assuming it will catch up on its own at the next routine visit."],
    ];
}

function pz_render_guide_puppy_health_checklist( $tool ) {
    $icon = $tool['icon'] ?? '✅';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Puppy Health Checklist</div>
          <div class="pz-int-sublabel">Age-matched · Free · Instant</div>
        </div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--blue">💉 Vaccine-Aware</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Puppy Age</label>
          <select id="pz_phc_age" class="pz-int-select">
            <option value="under8">Under 8 weeks</option>
            <option value="8to16" selected>8–16 weeks</option>
            <option value="4to6mo">4–6 months</option>
            <option value="6to12mo">6–12 months</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Vaccination Status</label>
          <select id="pz_phc_vax" class="pz-int-select">
            <option value="none">Not started</option>
            <option value="partial" selected>Started, not complete</option>
            <option value="complete">Core series complete</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenPuppyHealthChecklist()">
        <span class="pz-int-btn-icon"><?php echo $icon; ?></span>
        Get My Puppy's Checklist
      </button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ══ 5. Dog Spay & Neuter Guide (dog_spay_neuter) ══ */

function pz_hero_quickanswer_dog_spay_neuter() { ?>
    <div class="pz-hero-quickanswer">
      <div class="pz-hero-quickanswer-label">⚡ Quick Answer</div>
      <p>Many vets recommend spaying/neutering small and medium breeds around 6 months, while for large and giant breeds many vets now recommend waiting closer to 12–18 months for growth plate and joint health reasons. This is a general talking point, not an absolute rule — your vet's recommendation for your specific dog always takes priority. Enter your dog's details above for guidance matched to their size and age.</p>
    </div>
<?php }

function pz_hero_trust_dog_spay_neuter() { ?>
      <span>✅ Size-specific timing</span>
      <span>🔬 Current, evidence-based guidance</span>
      <span>🩹 Recovery basics included</span>
<?php }

function pz_methodology_heading_dog_spay_neuter() { return "How This Timing Guidance Is Built"; }

function pz_methodology_dog_spay_neuter() { ?>
    <p style="color:#555;margin-bottom:20px">Spay/neuter timing advice has genuinely evolved. The old one-size-fits-all "6 months for every dog" rule has been refined as research linked early spay/neuter in large and giant breeds to a higher rate of certain joint issues tied to open growth plates. This guide reflects that more current, size-aware thinking — while being clear that the final call always belongs to your dog's individual vet.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🐕</div>
        <strong>Breed Size</strong>
        <p>Small and medium breeds mature and reach skeletal maturity faster than large and giant breeds, which is the main driver behind the different timing windows.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🦴</div>
        <strong>Growth Plate Closure</strong>
        <p>In large and giant breeds, growth plates stay open longer — many vets now recommend waiting until they're closer to closed before spaying or neutering.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">📅</div>
        <strong>Current Age</strong>
        <p>Your dog's current age is compared to the typical window for their size to tell you where they stand — and reassures you it's not "too late" if you're past it.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🩺</div>
        <strong>Your Vet Has the Final Say</strong>
        <p>Individual health history, behavior, and specific breed all factor into your vet's actual recommendation — this guide is a starting point for that conversation, not a replacement for it.</p>
      </div>
    </div>
<?php }

function pz_faq_dog_spay_neuter() {
    return [
        ["What's the best age to spay or neuter my dog?", "It depends mainly on breed size. Many vets recommend around 6 months for small and medium breeds, while for large and giant breeds many vets now recommend waiting until closer to 12–18 months to support growth plate and joint health. This is general guidance — your vet's recommendation for your specific dog takes priority."],
        ["Why do large breeds need to wait longer?", "Research has linked early spay/neuter in large and giant breeds to a somewhat higher rate of certain joint conditions, linked to how spay/neuter affects growth plate closure timing. Waiting until closer to skeletal maturity is now a common recommendation for these breeds, though it's an evolving area and your vet may weigh other factors too."],
        ["Is it too late to spay/neuter my adult dog?", "No — it's essentially never \"too late\" in a general sense. If your dog is past the typical window for their size, it's still worth discussing with your vet, who can advise based on your dog's specific age, health, and history."],
        ["What is recovery like after spay or neuter surgery?", "Most dogs need about 10–14 days of restricted activity to heal properly, along with an e-collar or recovery suit to prevent licking the incision. Watch the incision site daily for redness, discharge, or swelling, which can indicate infection and should be checked by your vet."],
        ["Does spaying or neutering change my dog's behavior?", "It commonly reduces or eliminates certain hormone-driven behaviors like roaming, marking, and some aggression, though individual results vary and it's not a guaranteed behavior fix. Training and environment still play a major role in behavior regardless of spay/neuter status."],
    ];
}

function pz_what_is_dog_spay_neuter() {
    ob_start(); ?>
    <p>The Dog Spay &amp; Neuter Guide gives you a current, size-aware read on typical timing — small/medium breeds are often spayed or neutered around 6 months, while large and giant breeds increasingly wait until closer to 12–18 months, reflecting growth plate and joint health considerations that have become part of mainstream vet guidance in recent years.</p>
    <p>This is genuinely more nuanced than the old blanket "6 months for every dog" advice, and it's framed here as "many vets now recommend," not an absolute rule — plenty of individual factors (breed, health history, behavior, living situation) can shift your vet's specific recommendation for your dog. If your dog is already past the typical window, that's not a problem this guide will tell you to worry about — it's still worth a conversation with your vet, never "too late" in a general sense.</p>
    <p>Enter your dog's sex, breed size, and current age above for guidance, then scroll down for recovery basics and the FAQ covering the questions dog owners ask most about spay/neuter timing.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_spay_neuter() {
    ob_start(); ?>
    <p>Spay/neuter timing affects more than just population control — it intersects with growth, joint health, and long-term behavior in ways that are genuinely size-dependent:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🦴</span>
        <div>
          <strong>Joint Health Is Size-Dependent</strong>
          <p>For large and giant breeds, timing relative to growth plate closure is now a real factor vets weigh — a one-size-fits-all timing rule ignores this.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🏥</span>
        <div>
          <strong>Health Benefits Are Real</strong>
          <p>Spaying and neutering reduce or eliminate the risk of certain reproductive cancers and infections, alongside population control benefits.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🩹</span>
        <div>
          <strong>Recovery Needs Real Planning</strong>
          <p>10–14 days of restricted activity and consistent e-collar use directly affect how smoothly recovery goes — going in prepared matters.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🐕</span>
        <div>
          <strong>Behavior Can Shift, But Isn't Guaranteed</strong>
          <p>Some hormone-driven behaviors often improve, but spay/neuter isn't a substitute for training — setting realistic expectations avoids disappointment.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_spay_neuter() {
    return [
        ['title'=>"Confirm Your Dog's Breed Size Category", 'desc'=>"Small/medium (under 60 lbs adult) or large/giant (60+ lbs adult) — this is the main factor driving the recommended timing window."],
        ['title'=>"Enter Your Dog's Current Age", 'desc'=>"This compares your dog's age to the typical window for their size, showing whether they're ahead of, within, or past the common range."],
        ['title'=>'Review Your Personalized Guidance', 'desc'=>"Read the size-specific timing recommendation, remembering it's framed as common current practice, not an absolute rule for every individual dog."],
        ['title'=>'Discuss With Your Vet', 'desc'=>"Bring this guidance to your vet, who will factor in your dog's specific health history, behavior, and living situation for a final recommendation."],
        ['title'=>'Schedule the Procedure', 'desc'=>"Once you and your vet settle on timing, book the surgery and ask about pre-op requirements like fasting instructions."],
        ['title'=>'Plan for a 10–14 Day Recovery', 'desc'=>"Prepare a quiet, restricted-activity space, have an e-collar ready, and know what incision changes to watch for before surgery day."],
    ];
}

function pz_tips_dog_spay_neuter() {
    return [
        ["Prepare the Recovery Space Before Surgery Day", "Set up a quiet, low-traffic area with easy access to water, away from stairs or jumping opportunities, before your dog comes home from surgery."],
        ['Use the E-Collar Consistently', "Licking or chewing at the incision is one of the most common causes of complications — consistent e-collar or recovery-suit use, even when your dog seems fine, prevents this."],
        ['Restrict Activity for the Full 10–14 Days', "Resuming normal activity too early is a common cause of complications like incision reopening — stick to the full restricted period even once your dog seems back to normal."],
        ['Check the Incision Daily', "Look for redness, discharge, swelling, or odor once a day during recovery — catching an infection early makes it far easier to treat."],
        ["Ask Your Vet About Pre-Op Bloodwork", "A pre-surgical blood panel can catch underlying issues before anesthesia, adding an extra layer of safety, especially for adult or senior dogs."],
    ];
}

function pz_mistakes_dog_spay_neuter() {
    return [
        ['❌ Applying the Same Timing to Every Breed Size', 'Using a flat "6 months for every dog" rule ignores that large and giant breeds often benefit from waiting longer for growth plate and joint health reasons.'],
        ["❌ Letting Activity Resume Too Early", "Normal-looking behavior a few days after surgery doesn't mean healing is complete — early activity is a common cause of incision complications."],
        ['❌ Skipping the E-Collar Because "They Seem Fine"', "Even calm dogs can lick or chew at an incision the moment they're unsupervised — consistent e-collar use isn't optional just because your dog seems relaxed."],
        ['❌ Assuming It\'s "Too Late" for an Adult Dog', "There's no general age cutoff that makes spay/neuter off the table — if your dog is past the typical window, it's still worth a vet conversation, not something to rule out."],
        ['❌ Not Checking the Incision Site Daily', "Infections are far easier to treat when caught early — skipping the daily check means problems like redness or discharge can progress before you notice."],
    ];
}

function pz_render_guide_dog_spay_neuter( $tool ) {
    $icon = $tool['icon'] ?? '🏥';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Dog Spay &amp; Neuter Timing Guide</div>
          <div class="pz-int-sublabel">Size-aware guidance · Free · Instant</div>
        </div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--blue">🔬 Current Guidance</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Sex</label>
          <select id="pz_sn_sex" class="pz-int-select">
            <option value="male">Male</option>
            <option value="female">Female</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Breed Size</label>
          <select id="pz_sn_size" class="pz-int-select">
            <option value="small">Small / Medium (under 60 lbs adult)</option>
            <option value="large">Large / Giant (60+ lbs adult)</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Current Age</label>
          <div class="pz-int-input-wrap">
            <input type="number" id="pz_sn_age" class="pz-int-input" placeholder="e.g. 7" min="1" max="240" step="1">
            <span class="pz-int-input-suffix">months</span>
          </div>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenSpayNeuter()">
        <span class="pz-int-btn-icon"><?php echo $icon; ?></span>
        Get My Timing Guidance
      </button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ══ 6. Dog Joint Health & Arthritis Prevention Guide (dog_joint_health) ══ */

function pz_hero_quickanswer_dog_joint_health() { ?>
    <div class="pz-hero-quickanswer">
      <div class="pz-hero-quickanswer-label">⚡ Quick Answer</div>
      <p>Excess weight is one of the single biggest modifiable risk factors for joint stress and arthritis progression in dogs. Young dogs with no signs benefit most from prevention; senior dogs or any dog with noticeable limping should see a vet for an actual joint assessment. Select your dog's age, weight status, and current signs above for guidance matched to their stage.</p>
    </div>
<?php }

function pz_hero_trust_dog_joint_health() { ?>
      <span>✅ Weight-risk aware</span>
      <span>🦴 Age-stage specific</span>
      <span>🚫 No unsafe human medication advice</span>
<?php }

function pz_methodology_heading_dog_joint_health() { return "How This Joint Health Guidance Is Built"; }

function pz_methodology_dog_joint_health() { ?>
    <p style="color:#555;margin-bottom:20px">Joint health guidance changes with three things: how old your dog is (prevention vs. management), whether they're carrying excess weight (the single biggest modifiable risk factor), and whether any signs are already present. The guide combines all three rather than giving the same generic advice to a healthy 1-year-old and a limping 10-year-old.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">📅</div>
        <strong>Age Group</strong>
        <p>Young dogs benefit most from prevention habits; senior dogs need a management-focused approach since age itself increases arthritis risk.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">⚖️</div>
        <strong>Weight Status</strong>
        <p>Excess weight is one of the most significant, modifiable contributors to joint stress and arthritis progression — flagged prominently whenever it applies.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">👀</div>
        <strong>Current Signs</strong>
        <p>No signs, occasional stiffness, or noticeable limping each call for a different level of urgency, from prevention habits to a vet assessment.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🩺</div>
        <strong>Safe Management Options</strong>
        <p>Supplements, weight management, and low-impact exercise are covered as real options — alongside a clear warning against unsafe human pain medications.</p>
      </div>
    </div>
<?php }

function pz_faq_dog_joint_health() {
    return [
        ["What are the early signs of joint problems in dogs?", "Occasional stiffness after rest, slower to get up, hesitation before jumping or using stairs, and reduced interest in activity are common early signs. These are worth mentioning at your dog's next routine vet visit rather than waiting for them to become noticeable limping."],
        ["Can I give my dog human pain medication for joint pain?", "No — never give human NSAIDs like ibuprofen or naproxen to a dog; they're toxic and can cause serious stomach ulcers, kidney damage, or worse. If your dog is diagnosed with arthritis, your vet can prescribe a dog-safe pain management option."],
        ["Does being overweight really affect a dog's joints that much?", "Yes — excess weight is one of the single biggest modifiable risk factors for joint stress and arthritis progression. Every extra pound adds mechanical load to the joints with every step, and weight loss alone can meaningfully reduce pain in overweight arthritic dogs."],
        ["What supplements help with dog joint health?", "Glucosamine, chondroitin, and omega-3 fatty acids are commonly recommended and have reasonable supporting evidence for joint support, though they work gradually and aren't a substitute for veterinary diagnosis and treatment if arthritis is already present."],
        ["Is swimming good exercise for a dog with joint issues?", "Yes — swimming is a classic low-impact exercise that builds and maintains muscle around the joints without the repetitive impact of running or jumping, making it a commonly recommended option for dogs with existing joint concerns."],
    ];
}

function pz_what_is_dog_joint_health() {
    ob_start(); ?>
    <p>The Dog Joint Health &amp; Arthritis Prevention Guide gives you age-stage-specific guidance — prevention-focused for young, sign-free dogs, and management-focused for senior dogs or any dog already showing stiffness or limping — while flagging excess weight prominently whenever it applies, since it's one of the biggest modifiable risk factors for joint stress.</p>
    <p>Joint health sits on a spectrum from pure prevention to active management: a healthy young dog benefits from maintaining ideal weight and avoiding repetitive high-impact activity, while a senior dog or one already showing signs needs an actual vet assessment to determine whether arthritis or another joint condition is present and what treatment options make sense.</p>
    <p>Select your dog's age group, weight status, and current signs above for guidance, then scroll down for prevention and management detail plus the FAQ covering the joint health questions dog owners ask most.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_joint_health() {
    ob_start(); ?>
    <p>Joint health affects a dog's comfort and mobility every single day — and several of the biggest risk factors are things owners can actually influence:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">⚖️</span>
        <div>
          <strong>Weight Is the Biggest Modifiable Factor</strong>
          <p>Excess weight adds direct mechanical strain to every joint with every step — it's one of the most significant, and most controllable, contributors to arthritis progression.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⏱️</span>
        <div>
          <strong>Early Intervention Changes the Trajectory</strong>
          <p>Occasional stiffness caught early and mentioned to a vet can be managed proactively, rather than waiting for it to progress into noticeable, painful limping.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🏃</span>
        <div>
          <strong>Exercise Type Matters As Much As Amount</strong>
          <p>Repetitive high-impact activity, especially excessive jumping in growing large breeds, stresses developing joints differently than steady, low-impact movement.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💊</span>
        <div>
          <strong>Safe Pain Management Requires a Vet</strong>
          <p>Human NSAIDs are toxic to dogs — real pain relief for a diagnosed joint condition has to come from a vet-prescribed, dog-safe option.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_joint_health() {
    return [
        ['title'=>"Identify Your Dog's Age Group", 'desc'=>"Young (under 2), adult (2–7), or senior (7+) — this determines whether the focus is prevention or active management."],
        ['title'=>"Assess Current Weight Status Honestly", 'desc'=>"Overweight is one of the biggest modifiable risk factors for joint stress — an honest assessment here changes the guidance meaningfully."],
        ['title'=>'Note Any Current Signs', 'desc'=>"No signs, occasional stiffness after rest, or noticeable limping each call for a different level of urgency in the guidance you receive."],
        ['title'=>'Review Your Personalized Guidance', 'desc'=>"Read the prevention or management recommendations matched to your dog's specific combination of age, weight, and signs."],
        ['title'=>'Address Weight First If Flagged', 'desc'=>"If overweight is flagged, treat it as a priority — pair this guide with our Dog Ideal Weight or Body Condition Score calculators to get started."],
        ['title'=>'Schedule a Vet Visit If Indicated', 'desc'=>"For senior dogs or any noticeable signs, book an actual joint assessment rather than relying on supplements or home management alone."],
    ];
}

function pz_tips_dog_joint_health() {
    return [
        ['Keep Your Dog at an Ideal Weight', "This is the single most impactful thing most owners can control — even modest weight loss in an overweight dog measurably reduces joint stress and often improves comfort."],
        ['Favor Low-Impact Exercise', "Swimming and steady leash walks build and maintain muscle around the joints without the repetitive impact of running, jumping, or hard stops on pavement."],
        ['Avoid Excessive Jumping in Growing Large Breeds', "Repeated jumping on and off furniture or out of vehicles adds real stress to developing joints in large-breed puppies — moderate it during the growth period."],
        ['Ask About Joint Supplements Early', "Glucosamine, chondroitin, and omega-3s work gradually and are more useful started proactively than only after signs appear — ask your vet what's appropriate for your dog."],
        ['Use Ramps or Steps for Furniture and Vehicles', "A small ramp reduces repetitive jumping impact for dogs of any age, and is an easy habit to build before signs ever appear."],
    ];
}

function pz_mistakes_dog_joint_health() {
    return [
        ['❌ Giving Human NSAIDs for Joint Pain', "Ibuprofen, naproxen, and other human NSAIDs are toxic to dogs and can cause serious stomach ulcers or kidney damage. Only vet-prescribed, dog-safe pain medication is appropriate."],
        ['❌ Ignoring Excess Weight as "Just Extra Padding"', "Excess weight is one of the biggest modifiable contributors to joint stress and arthritis progression — it's not a cosmetic issue, it's a direct mechanical load on every joint."],
        ["❌ Waiting for Noticeable Limping Before Mentioning It to a Vet", "Occasional stiffness after rest is worth an early mention at a routine visit — waiting until limping is obvious means starting management later than necessary."],
        ["❌ Over-Exercising a Dog With Existing Signs", "Pushing through stiffness or limping with normal exercise levels can worsen joint irritation — dogs with signs need a vet assessment before adjusting activity, not more of the same."],
        ["❌ Relying on Supplements Alone Once Signs Appear", "Glucosamine, chondroitin, and omega-3s support joint health but aren't a substitute for a vet diagnosis once noticeable signs are present — get an actual assessment first."],
    ];
}

function pz_render_guide_dog_joint_health( $tool ) {
    $icon = $tool['icon'] ?? '🦴';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Dog Joint Health &amp; Arthritis Guide</div>
          <div class="pz-int-sublabel">Prevention &amp; management · Free · Instant</div>
        </div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--blue">🦴 Age-Stage Specific</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Age Group</label>
          <select id="pz_jh_age" class="pz-int-select">
            <option value="young">Young (under 2 years)</option>
            <option value="adult" selected>Adult (2–7 years)</option>
            <option value="senior">Senior (7+ years)</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Weight Status</label>
          <select id="pz_jh_weight" class="pz-int-select">
            <option value="ideal">At ideal weight</option>
            <option value="overweight">Overweight</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Current Signs</label>
          <select id="pz_jh_signs" class="pz-int-select">
            <option value="none">No signs noticed</option>
            <option value="mild">Occasional stiffness, especially after rest</option>
            <option value="noticeable">Noticeable limping or reluctance to move</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenJointHealth()">
        <span class="pz-int-btn-icon"><?php echo $icon; ?></span>
        Get My Joint Health Guidance
      </button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ══ 7. Senior Dog Health Guide (senior_dog_health) ══ */

function pz_hero_quickanswer_senior_dog_health() { ?>
    <div class="pz-hero-quickanswer">
      <div class="pz-hero-quickanswer-label">⚡ Quick Answer</div>
      <p>"Senior" isn't the same age for every dog — giant breeds age faster and are typically senior by around 6 years, large breeds by 7–8, while small and medium breeds usually aren't senior until 10–12. Select your dog's age, breed size, and current health concerns above for focus areas matched to their actual life stage, not a one-size-fits-all number.</p>
    </div>
<?php }

function pz_hero_trust_senior_dog_health() { ?>
      <span>✅ Size-adjusted senior age</span>
      <span>🧠 Cognitive change awareness</span>
      <span>🦴 Mobility &amp; diet guidance</span>
<?php }

function pz_methodology_heading_senior_dog_health() { return "How This Senior Care Guidance Is Built"; }

function pz_methodology_senior_dog_health() { ?>
    <p style="color:#555;margin-bottom:20px">Senior dog care isn't determined by calendar age alone. This guidance combines whether your dog is actually in the senior range for their specific breed size — since giant breeds age much faster than small ones — with any current health concerns you've noticed, to point you toward the focus areas that matter most right now.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">📏</div>
        <strong>Size-Adjusted Age</strong>
        <p>A 6-year-old giant breed is already a senior; a 6-year-old small breed likely has years to go. Size changes what "senior" means.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🩺</div>
        <strong>Vet Visit Cadence</strong>
        <p>True seniors benefit from biannual vet visits rather than the annual schedule appropriate for younger, healthy dogs.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🧠</div>
        <strong>Cognitive Changes</strong>
        <p>Disorientation, altered sleep-wake cycles, and house-training lapses can signal canine cognitive dysfunction — not just "getting old."</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🤝</div>
        <strong>Coordinated Care</strong>
        <p>Multiple chronic conditions call for a vet-led care plan that considers how issues interact, rather than piecemeal home fixes.</p>
      </div>
    </div>
<?php }

function pz_faq_senior_dog_health() {
    return [
        ["At what age is my dog actually considered a senior?", "It depends heavily on breed size. Small and medium breeds are typically senior around 10–12 years, large breeds around 7–8 years, and giant breeds as early as 6 years. A giant breed ages noticeably faster than a small one, so the same calendar age means something different for each."],
        ["How often should a senior dog see the vet?", "Most vets recommend biannual (twice yearly) wellness visits for true senior dogs, compared to annual visits for younger healthy adults. More frequent checkups catch age-related changes — in bloodwork, joints, organ function — while they're still manageable."],
        ["Is it normal for an older dog to seem confused or have house-training accidents?", "Occasional lapses can happen, but disorientation, pacing at night, altered sleep-wake cycles, or new house-training accidents can be early signs of canine cognitive dysfunction — a real, manageable condition, not just \"getting old.\" It's worth a specific conversation with your vet rather than assuming nothing can be done."],
        ["Should I change my senior dog's food?", "Many senior dogs benefit from a senior-formula diet, and easier-to-chew options if dental issues are present. Weight management matters even more in senior dogs, since extra weight compounds joint strain on already-aging joints. Ask your vet for a recommendation based on your dog's specific health profile."],
        ["My senior dog has multiple health conditions — where do I start?", "When several chronic conditions are present, coordinated vet-led care planning matters more than managing each one separately at home. Treatments can interact, so a vet who sees the whole picture is better positioned to prioritize and sequence care than piecemeal home management."],
    ];
}

function pz_what_is_senior_dog_health() {
    ob_start(); ?>
    <p>The Senior Dog Health Guide gives you age-stage-specific focus areas by first determining whether your dog is actually in the senior range for their breed size — since giant breeds age faster than small ones, the same calendar age can mean very different life stages — and then matching guidance to that stage plus any current health concerns you've noted.</p>
    <p>Senior care spans several areas that become more important with age: how often to see the vet, keeping weight in check since extra pounds compound joint strain, diet adjustments including senior formulas and easier-to-chew options, watching for cognitive changes like disorientation or altered sleep patterns, and supporting mobility with ramps and orthopedic bedding rather than stairs and jumping.</p>
    <p>Select your dog's current age, breed size, and any health concerns above for guidance, then scroll down for detail on each focus area plus the FAQ covering the questions senior dog owners ask most.</p>
    <?php return ob_get_clean();
}

function pz_why_important_senior_dog_health() {
    ob_start(); ?>
    <p>Aging changes a dog's needs gradually — owners who adjust their care approach as those changes appear tend to catch problems earlier and keep their senior dogs more comfortable:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🩺</span>
        <div>
          <strong>More Frequent Vet Visits Catch More</strong>
          <p>Biannual checkups for true seniors catch age-related bloodwork, joint, and organ changes earlier than an annual visit would.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⚖️</span>
        <div>
          <strong>Weight Compounds Joint Strain</strong>
          <p>Extra weight on an already-aging joint accelerates discomfort — weight management matters more in seniors, not less.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🧠</span>
        <div>
          <strong>Cognitive Changes Are Often Missed</strong>
          <p>Disorientation and house-training lapses get written off as "just old age" when they can signal a manageable condition worth discussing with a vet.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🐾</span>
        <div>
          <strong>Mobility Support Prevents Injury</strong>
          <p>Ramps and orthopedic bedding reduce strain on aging joints, lowering the risk of a fall or an overexertion injury.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_senior_dog_health() {
    return [
        ['title'=>"Determine Your Dog's True Senior Status", 'desc'=>"Match current age against your dog's breed size — giant breeds are senior around 6, large breeds around 7–8, small/medium breeds around 10–12."],
        ['title'=>'Note Any Current Health Concerns', 'desc'=>"None, mobility/joint issues, or multiple chronic conditions — this determines whether the focus is prevention or coordinated management."],
        ['title'=>'Review Your Focus Areas', 'desc'=>"Read the vet visit cadence, weight, diet, cognitive, and mobility guidance matched to your dog's specific age-size-concern combination."],
        ['title'=>'Adjust Your Vet Visit Schedule', 'desc'=>"If your dog is a true senior, move from annual to biannual wellness visits so age-related changes are caught earlier."],
        ['title'=>'Make Mobility and Diet Adjustments', 'desc'=>"Add ramps instead of stairs or jumping, supportive orthopedic bedding, and consider a senior formula or easier-to-chew diet if needed."],
        ['title'=>'Watch for Cognitive Changes', 'desc'=>"Disorientation, altered sleep-wake cycles, or new house-training lapses are worth a specific vet conversation, not dismissal as normal aging."],
    ];
}

function pz_tips_senior_dog_health() {
    return [
        ['Move to Biannual Vet Visits', "True senior dogs benefit from twice-yearly wellness exams rather than annual visits — more frequent checkups catch age-related changes while they're still manageable."],
        ["Keep Weight in Check", "Extra weight compounds joint strain on aging joints more than it does on a younger dog — weight management is one of the highest-value things you can control."],
        ['Add Ramps Instead of Stairs or Jumping', "A ramp for the couch, bed, or car reduces repetitive strain and fall risk on aging joints — pair it with supportive orthopedic bedding for daily comfort."],
        ["Don't Dismiss Behavior Changes as \"Just Old Age\"", "Disorientation, altered sleep-wake cycles, or house-training lapses can signal canine cognitive dysfunction — a real, manageable condition worth a vet conversation."],
        ['Coordinate Care If Multiple Conditions Are Present', "When several chronic conditions overlap, a vet-led care plan that considers how treatments interact works better than managing each one separately at home."],
    ];
}

function pz_mistakes_senior_dog_health() {
    return [
        ['❌ Using One "Senior" Age for Every Dog', "Giant breeds are senior around 6 years, large breeds around 7–8, and small/medium breeds not until 10–12 — treating every dog the same way ignores this real difference in aging pace."],
        ['❌ Writing Off Confusion or Accidents as "Just Getting Old"', "Disorientation, altered sleep-wake cycles, and new house-training lapses can point to canine cognitive dysfunction, a condition worth discussing with a vet rather than dismissing."],
        ['❌ Sticking to Annual Vet Visits for a True Senior', "Biannual visits catch age-related bloodwork, joint, and organ changes earlier — waiting a full year between checkups means changes can progress further before they're caught."],
        ['❌ Letting Weight Creep Up "Because They\'re Older Now"', "Extra weight compounds joint strain on already-aging joints — weight management matters more in seniors, not less, even though activity naturally slows."],
        ['❌ Managing Multiple Conditions Piecemeal at Home', "When several chronic conditions are present, treatments can interact — a coordinated, vet-led care plan works better than addressing each issue in isolation."],
    ];
}

function pz_render_guide_senior_dog_health( $tool ) {
    $icon = $tool['icon'] ?? '👴';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Senior Dog Health Guide</div>
          <div class="pz-int-sublabel">Size-adjusted senior age · Free · Instant</div>
        </div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--blue">👴 Age-Stage Specific</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Current Age</label>
          <div class="pz-int-input-wrap">
            <input type="number" id="pz_sdh_age" class="pz-int-input" placeholder="e.g. 8" min="0" max="30" step="0.5">
            <span class="pz-int-input-suffix">years</span>
          </div>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Breed Size</label>
          <select id="pz_sdh_size" class="pz-int-select">
            <option value="small">Small/Medium (senior ~10-12 yrs)</option>
            <option value="large">Large (senior ~7-8 yrs)</option>
            <option value="giant">Giant (senior ~6 yrs)</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Current Health Concerns</label>
          <select id="pz_sdh_concerns" class="pz-int-select">
            <option value="none">None noticed</option>
            <option value="mobility">Mobility/joint issues</option>
            <option value="multiple">Multiple chronic conditions</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenSeniorHealth()">
        <span class="pz-int-btn-icon"><?php echo $icon; ?></span>
        Get My Senior Care Guidance
      </button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ══ 8. Dog Heat Stroke: Signs, Prevention & First Aid (dog_heat_stroke) ══ */

function pz_hero_quickanswer_dog_heat_stroke() { ?>
    <div class="pz-hero-quickanswer">
      <div class="pz-hero-quickanswer-label">⚡ Quick Answer</div>
      <p>A dog left in a parked car, even briefly, is a time-critical emergency — cars heat up dangerously fast even with windows cracked. A collapsed, wobbly, or vomiting dog needs a vet immediately. Heavy panting alone while resting usually means move to a cool area and monitor. Select your dog's symptoms and situation above for guidance matched to the actual urgency.</p>
    </div>
<?php }

function pz_hero_trust_dog_heat_stroke() { ?>
      <span>🚨 Emergency-aware guidance</span>
      <span>❄️ Safe cooling methods only</span>
      <span>🐕 Brachycephalic-risk aware</span>
<?php }

function pz_methodology_heading_dog_heat_stroke() { return "How This Heat Stroke Guidance Is Built"; }

function pz_methodology_dog_heat_stroke() { ?>
    <p style="color:#555;margin-bottom:20px">Heat stroke guidance is built around two things: what situation your dog was in, and what symptoms they're currently showing. A parked car is treated as an emergency regardless of symptoms, because cars heat up dangerously fast even with windows cracked. Symptoms are then triaged from prevention-only through immediate-emergency, so you get guidance proportionate to actual risk.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🚗</div>
        <strong>Situation First</strong>
        <p>A parked car is always flagged as an emergency scenario — vehicle interiors heat up to dangerous levels within minutes, even with windows cracked.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🌡️</div>
        <strong>Symptom Severity</strong>
        <p>None, panting-only, confused/vomiting, or collapsed each call for a distinctly different response — from prevention tips to immediate emergency care.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">❄️</div>
        <strong>Safe Cooling Methods</strong>
        <p>Cool — not ice-cold — water is used throughout. Ice water can cause shock via rapid vasoconstriction, so this guide never recommends it.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🐕</div>
        <strong>Higher-Risk Groups</strong>
        <p>Flat-faced (brachycephalic) breeds, seniors, and overweight dogs are flagged as higher-risk since they cool themselves less effectively.</p>
      </div>
    </div>
<?php }

function pz_faq_dog_heat_stroke() {
    return [
        ["How long can a dog be left in a parked car safely?", "Never — not even briefly. Car interiors heat up dangerously fast, even with windows cracked, and temperatures can climb to dangerous levels within just a few minutes on a warm day. There is no safe duration for leaving a dog in a parked car."],
        ["What are the first signs of heat stroke in dogs?", "Heavy panting, excessive drooling, bright red gums, and restlessness are early signs. As it progresses, dogs may become wobbly, confused, or start vomiting. Collapse or unresponsiveness is a critical emergency requiring immediate veterinary care."],
        ["Should I use ice water to cool down an overheated dog?", "No — use cool, not ice-cold, water on the paw pads, groin, armpits, and ears, along with wet towels and a fan if available. Ice-cold water can cause blood vessels to constrict rapidly, which can actually trap heat inside the body and lead to shock."],
        ["Which dogs are at higher risk of heat stroke?", "Flat-faced (brachycephalic) breeds like Bulldogs and Pugs are at significantly elevated risk because their airway shape reduces their ability to pant-cool effectively. Senior dogs and overweight dogs are also higher-risk and need extra caution in heat."],
        ["My dog is just panting heavily but seems alert — is that an emergency?", "Heavy panting or drooling while otherwise alert is usually a sign to move your dog to a cool area, offer water, and monitor closely for escalation. It's still reasonable to call your vet, especially for flat-faced breeds, seniors, or overweight dogs, but it's not automatically a collapse-level emergency."],
    ];
}

function pz_what_is_dog_heat_stroke() {
    ob_start(); ?>
    <p>The Dog Heat Stroke Guide helps you recognize the signs of overheating, understand which situations are automatically dangerous regardless of symptoms, and know exactly what to do — from prevention tips for a healthy dog on a hot day to immediate first-aid steps for a dog showing serious symptoms.</p>
    <p>Heat stroke risk depends heavily on situation, not just symptoms: a dog that was in a parked car, even briefly, is treated as an emergency because vehicle interiors heat up to dangerous levels within minutes, even with windows cracked. Symptoms then range from none (prevention-focused) through heavy panting, to confusion or vomiting, to collapse — each requiring a meaningfully different response.</p>
    <p>Select your dog's current symptoms and situation above for guidance, then scroll down for prevention detail, safe cooling methods, and the FAQ covering the heat stroke questions dog owners ask most.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_heat_stroke() {
    ob_start(); ?>
    <p>Heat stroke can progress from mild warning signs to a life-threatening emergency quickly — knowing what to watch for and how to respond correctly matters:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🚗</span>
        <div>
          <strong>Parked Cars Are Always Dangerous</strong>
          <p>Vehicle interiors heat up dangerously fast, even with windows cracked — there is no safe duration for leaving a dog in a parked car, even briefly.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⏱️</span>
        <div>
          <strong>Speed of Progression Matters</strong>
          <p>Heat stroke can move from heavy panting to collapse quickly — recognizing escalating symptoms early changes the outcome.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">❄️</span>
        <div>
          <strong>The Wrong Cooling Method Can Harm</strong>
          <p>Ice-cold water can cause shock via rapid vasoconstriction — cool water and airflow are the safe approach for cooling an overheated dog.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🐕</span>
        <div>
          <strong>Some Dogs Are at Much Higher Risk</strong>
          <p>Flat-faced breeds, seniors, and overweight dogs cool themselves less effectively and need extra caution and a lower threshold for concern.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_heat_stroke() {
    return [
        ['title'=>"Assess the Situation", 'desc'=>"Was your dog in a parked car, active outdoors, or resting in shade? A parked car is always treated as an emergency, regardless of symptoms."],
        ['title'=>'Check Current Symptoms', 'desc'=>"None, heavy panting/drooling, wobbly/confused/vomiting, or collapsed — each level calls for a different, proportionate response."],
        ['title'=>'Move to a Cool Area Immediately', 'desc'=>"If any concerning symptoms are present, get your dog to shade or air conditioning right away, before anything else."],
        ['title'=>'Begin Safe Cooling If Needed', 'desc'=>"Use cool — not ice-cold — water on paw pads, groin, armpits, and ears, plus wet towels and a fan if available."],
        ['title'=>'Go to a Vet for Anything Beyond Mild', 'desc'=>"Confusion, vomiting, or collapse need a vet immediately — do not wait to see if it improves on its own."],
        ['title'=>'Review Prevention for Next Time', 'desc'=>"Never leave a dog in a parked car, avoid peak-heat exercise, and know if your dog is in a higher-risk group like flat-faced breeds."],
    ];
}

function pz_tips_dog_heat_stroke() {
    return [
        ['Never Leave a Dog in a Parked Car', "Not even briefly, not even with windows cracked — vehicle interiors heat up to dangerous levels within minutes, and there is no safe duration."],
        ['Avoid Exercise During Peak Heat', "Walk or exercise your dog during cooler morning or evening hours in hot weather, and avoid strenuous activity during midday heat."],
        ['Ensure Constant Shade and Water Outdoors', "Any dog spending time outside in heat needs continuous access to shade and fresh water, not just occasional checks."],
        ["Know Your Dog's Risk Level", "Flat-faced (brachycephalic) breeds, seniors, and overweight dogs are at significantly elevated risk and need extra caution and a lower threshold for concern."],
        ['Use Cool Water, Never Ice-Cold, to Cool Down', "If cooling is needed, cool water on paw pads, groin, armpits, and ears is safe — ice-cold water can cause shock via rapid vasoconstriction."],
    ];
}

function pz_mistakes_dog_heat_stroke() {
    return [
        ['❌ Leaving a Dog in a Parked Car "Just for a Minute"', "Car interiors heat up dangerously fast, even with windows cracked — there is no safe duration, and this remains one of the most preventable causes of heat stroke."],
        ['❌ Using Ice-Cold Water to Cool Down Quickly', "Ice-cold water can cause blood vessels to constrict rapidly, potentially trapping heat inside and leading to shock. Cool — not cold — water is the safer choice."],
        ['❌ Waiting to See If Symptoms Improve On Their Own', "Confusion, vomiting, or collapse need a vet immediately — heat stroke can progress quickly, and delaying care to \"wait and see\" costs valuable time."],
        ['❌ Exercising Heavily During Midday Heat', "Peak-heat exercise, especially in flat-faced, senior, or overweight dogs, is one of the most common preventable triggers for heat stroke."],
        ['❌ Underestimating Risk for Flat-Faced Breeds', "Brachycephalic breeds like Bulldogs and Pugs have a significantly reduced ability to pant-cool effectively — what's mild heat stress for one breed can be dangerous for these dogs."],
    ];
}

function pz_render_guide_dog_heat_stroke( $tool ) {
    $icon = $tool['icon'] ?? '🌡️';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Dog Heat Stroke Guide</div>
          <div class="pz-int-sublabel">Signs, prevention &amp; first aid · Free · Instant</div>
        </div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--blue">🚨 Emergency-Aware</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Current Symptoms</label>
          <select id="pz_hs_symptoms" class="pz-int-select">
            <option value="none">None — just checking prevention tips</option>
            <option value="panting">Heavy panting/drooling, otherwise alert</option>
            <option value="confused">Wobbly, confused, or vomiting</option>
            <option value="collapsed">Collapsed or unresponsive</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Situation</label>
          <select id="pz_hs_situation" class="pz-int-select">
            <option value="resting">Hot day, resting in shade</option>
            <option value="active">Hot day, was exercising/active</option>
            <option value="car">Was in a parked car, even briefly</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenHeatStroke()">
        <span class="pz-int-btn-icon"><?php echo $icon; ?></span>
        Get My Heat Stroke Guidance
      </button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ══ 9. Dog Heart Health: Signs & Prevention Guide (dog_heart_health) ══ */

function pz_hero_quickanswer_dog_heart_health() { ?>
    <div class="pz-hero-quickanswer">
      <div class="pz-hero-quickanswer-label">⚡ Quick Answer</div>
      <p>Fainting or pale/blue-tinged gums are serious cardiac warning signs that need prompt vet evaluation. A cough combined with reduced exercise tolerance is worth a vet visit soon, especially in senior small breeds or predisposed large breeds. An occasional cough alone often has non-cardiac causes. Select your dog's age, breed size, and symptoms above for guidance matched to actual risk.</p>
    </div>
<?php }

function pz_hero_trust_dog_heart_health() { ?>
      <span>❤️ Symptom-severity aware</span>
      <span>🐕 Breed-predisposition aware</span>
      <span>🩺 Prevention &amp; warning-sign guidance</span>
<?php }

function pz_methodology_heading_dog_heart_health() { return "How This Heart Health Guidance Is Built"; }

function pz_methodology_dog_heart_health() { ?>
    <p style="color:#555;margin-bottom:20px">Heart health guidance is built from three inputs: age group, breed size, and any symptoms noticed. Symptoms drive the urgency level — from prevention-only through a vet-visit recommendation to an urgent flag — while age and breed size add context, since certain heart conditions are more common in specific combinations, like mitral valve disease in aging small breeds or dilated cardiomyopathy predisposition in some large and giant breeds.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🔍</div>
        <strong>Symptom Severity Drives Urgency</strong>
        <p>None, cough alone, cough with reduced tolerance, or fainting/pale gums each call for a distinctly different level of concern.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">📅</div>
        <strong>Age Group Context</strong>
        <p>Senior dogs are more likely to develop age-related heart conditions, adding relevant context to any symptoms noticed.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🐕</div>
        <strong>Breed Predisposition</strong>
        <p>Small breeds are more prone to mitral valve disease with age; some large and giant breeds are predisposed to dilated cardiomyopathy.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🛡️</div>
        <strong>Prevention Habits</strong>
        <p>Annual auscultation, healthy weight, and regular moderate exercise are covered as the foundation for dogs showing no symptoms.</p>
      </div>
    </div>
<?php }

function pz_faq_dog_heart_health() {
    return [
        ["What are the warning signs of heart disease in dogs?", "A persistent cough, reduced exercise tolerance, fainting, and pale or blue-tinged gums are key warning signs. Fainting or pale/blue-tinged gums are especially serious and need prompt veterinary evaluation, not a wait-and-see approach."],
        ["Is an occasional cough in my dog something to worry about?", "Not automatically — many non-cardiac causes exist too, including kennel cough and allergies. An occasional cough alone is worth mentioning at your dog's next routine vet visit, but it isn't a red flag by itself unless paired with reduced exercise tolerance or other symptoms."],
        ["Which dog breeds are more prone to heart disease?", "Mitral valve disease is common in aging small breeds like Cavalier King Charles Spaniels and Chihuahuas. Some large and giant breeds, including Dobermans and Great Danes, are predisposed to dilated cardiomyopathy. Knowing your breed's predisposition helps you know what to watch for."],
        ["Do vets check for heart problems during routine exams?", "Yes — a heart listen (auscultation) is a standard part of annual vet exams for dogs showing no symptoms. This is one of the simplest and most effective ways heart murmurs and irregular rhythms get caught early."],
        ["Can diet and exercise really affect my dog's heart health?", "Yes — maintaining a healthy weight reduces strain on the cardiovascular system, and regular moderate exercise supports heart health over time. These are two of the most controllable factors in long-term cardiovascular health for dogs."],
    ];
}

function pz_what_is_dog_heart_health() {
    ob_start(); ?>
    <p>The Dog Heart Health Guide helps you understand what your dog's symptoms — or lack of symptoms — mean for their cardiovascular health, from prevention habits for a symptom-free dog to an urgent vet flag for serious warning signs like fainting or pale gums.</p>
    <p>Heart disease risk in dogs is shaped by age, breed size, and current symptoms together: mitral valve disease is common in aging small breeds, some large and giant breeds are predisposed to dilated cardiomyopathy, and symptoms ranging from an occasional cough to fainting each carry a different level of urgency that this guide helps you interpret correctly.</p>
    <p>Select your dog's age group, breed size, and any symptoms noticed above for guidance, then scroll down for prevention detail plus the FAQ covering the heart health questions dog owners ask most.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_heart_health() {
    ob_start(); ?>
    <p>Heart disease often develops gradually and silently — knowing what's normal and what's a warning sign changes when a dog gets help:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🚨</span>
        <div>
          <strong>Some Signs Are Genuinely Urgent</strong>
          <p>Fainting and pale or blue-tinged gums are serious cardiac warning signs that need prompt veterinary evaluation, not a wait-and-see approach.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🐕</span>
        <div>
          <strong>Breed Predisposition Matters</strong>
          <p>Mitral valve disease in aging small breeds and dilated cardiomyopathy predisposition in some large breeds mean knowing your breed's risk changes what to watch for.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🩺</span>
        <div>
          <strong>Annual Screening Catches Problems Early</strong>
          <p>A heart listen at routine vet exams is a standard, simple way heart murmurs and irregular rhythms get caught before symptoms appear.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⚖️</span>
        <div>
          <strong>Weight and Exercise Are Controllable</strong>
          <p>Maintaining a healthy weight and regular moderate exercise both reduce strain on the cardiovascular system over a dog's lifetime.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_heart_health() {
    return [
        ['title'=>"Identify Your Dog's Age Group", 'desc'=>"Young (under 5), middle-aged (5-9), or senior (10+) — heart disease risk generally rises with age."],
        ['title'=>'Note Breed Size and Predisposition', 'desc'=>"Small breeds are more prone to mitral valve disease with age; some large/giant breeds are predisposed to dilated cardiomyopathy."],
        ['title'=>'Check for Symptoms Honestly', 'desc'=>"None, occasional cough only, cough plus reduced exercise tolerance, or fainting/pale gums — each calls for a different response."],
        ['title'=>'Review Your Personalized Guidance', 'desc'=>"Read the prevention or vet-visit recommendation matched to your dog's specific age, size, and symptom combination."],
        ['title'=>'Act on Urgent Flags Immediately', 'desc'=>"Fainting or pale/blue-tinged gums need prompt veterinary evaluation — don't wait for a routine appointment slot."],
        ['title'=>'Schedule Annual (or Biannual) Heart Screening', 'desc'=>"Make sure your vet includes a heart listen at every routine exam, especially as your dog enters a higher-risk age or breed category."],
    ];
}

function pz_tips_dog_heart_health() {
    return [
        ['Keep Your Dog at a Healthy Weight', "Excess weight strains the cardiovascular system directly — maintaining an ideal weight is one of the most controllable factors in long-term heart health."],
        ['Support Regular Moderate Exercise', "Consistent, moderate exercise supports cardiovascular health over a dog's lifetime — sudden intense exertion in an unconditioned dog is not the goal."],
        ["Know Your Breed's Predisposition", "Mitral valve disease is common in aging small breeds; some large and giant breeds are predisposed to dilated cardiomyopathy. Ask your vet what to watch for in your specific breed."],
        ['Make Sure Annual Exams Include a Heart Listen', "Auscultation is a standard part of a routine exam — confirm it's happening so murmurs and irregular rhythms get caught early, before symptoms appear."],
        ["Don't Dismiss a Cough Paired With Reduced Activity", "A cough alone is often benign, but cough plus reduced exercise tolerance together is a combination worth a vet visit soon, not a wait-and-see approach."],
    ];
}

function pz_mistakes_dog_heart_health() {
    return [
        ['❌ Assuming Fainting Is "Just Overexcitement"', "Fainting is a serious cardiac warning sign that needs prompt veterinary evaluation — it should never be dismissed as simple excitement or heat, especially alongside other symptoms."],
        ['❌ Ignoring Pale or Blue-Tinged Gums', "Gum color changes indicate a real oxygenation or circulation problem — this is one of the clearest urgent warning signs and needs immediate veterinary attention."],
        ['❌ Treating Every Cough as Kennel Cough', "A cough combined with reduced exercise tolerance is a combination that can indicate early heart disease, especially in predisposed breeds — it's worth ruling out, not assuming."],
        ['❌ Skipping Routine Exams Because "Nothing Seems Wrong"', "Heart disease often develops silently — the annual heart listen at a routine exam is often how murmurs and irregular rhythms are caught before any symptoms appear."],
        ["❌ Not Knowing Your Breed's Predisposition", "Mitral valve disease in small breeds and dilated cardiomyopathy risk in some large breeds are well-documented — not knowing your dog's risk profile means missing early warning signs that matter for that breed."],
    ];
}

function pz_render_guide_dog_heart_health( $tool ) {
    $icon = $tool['icon'] ?? '❤️';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Dog Heart Health Guide</div>
          <div class="pz-int-sublabel">Signs &amp; prevention · Free · Instant</div>
        </div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--blue">❤️ Symptom-Aware</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Age Group</label>
          <select id="pz_hh_age" class="pz-int-select">
            <option value="young">Young (under 5)</option>
            <option value="middle">Middle-aged (5-9)</option>
            <option value="senior">Senior (10+)</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Breed Size</label>
          <select id="pz_hh_size" class="pz-int-select">
            <option value="small">Small breed</option>
            <option value="large">Large/Giant breed</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Symptoms Noticed</label>
          <select id="pz_hh_symptoms" class="pz-int-select">
            <option value="none">None noticed</option>
            <option value="cough">Occasional cough only</option>
            <option value="exercise">Coughing plus reduced exercise tolerance</option>
            <option value="severe">Fainting or pale/blue-tinged gums</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenHeartHealth()">
        <span class="pz-int-btn-icon"><?php echo $icon; ?></span>
        Get My Heart Health Guidance
      </button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ══ 10. Common Dog Skin Conditions: Guide & Treatment (dog_skin_conditions) ══ */

function pz_hero_quickanswer_dog_skin_conditions() { ?>
    <div class="pz-hero-quickanswer">
      <div class="pz-hero-quickanswer-label">⚡ Quick Answer</div>
      <p>Hives can signal an allergic reaction — check for facial swelling or breathing difficulty and treat as more urgent if present. Scabs often mean infection or parasites and need a vet look, especially if not improving within a few days. Hair loss has several possible causes, including contagious ringworm, so it needs a vet diagnosis rather than a guess. Select your dog's symptom and duration above for guidance.</p>
    </div>
<?php }

function pz_hero_trust_dog_skin_conditions() { ?>
      <span>🔬 Symptom-specific guidance</span>
      <span>🧴 No guess-and-treat advice</span>
      <span>🐾 Allergy &amp; parasite aware</span>
<?php }

function pz_methodology_heading_dog_skin_conditions() { return "How This Skin Condition Guidance Is Built"; }

function pz_methodology_dog_skin_conditions() { ?>
    <p style="color:#555;margin-bottom:20px">Skin conditions in dogs have overlapping symptoms but very different causes — allergies, parasites, infection, and hormonal issues can all look similar at first glance. This guidance is built around the specific symptom type you've noticed and how long it's been present, pointing you toward the right next step rather than a generic "try this cream" answer.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🔍</div>
        <strong>Symptom Type</strong>
        <p>Itching, redness, hair loss, scabs, and hives each point toward a different set of likely causes and next steps.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">⏱️</div>
        <strong>Duration</strong>
        <p>New, ongoing for weeks, or chronic/recurring changes the likely cause — chronic itching often points to an underlying allergy.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🦠</div>
        <strong>Contagion Awareness</strong>
        <p>Hair loss patches can indicate ringworm, which is contagious to humans and other pets — this is flagged rather than assumed benign.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🩺</div>
        <strong>When a Vet Diagnosis Is Needed</strong>
        <p>Several skin symptoms look identical across very different causes — this guide is honest about when self-treating isn't the safe option.</p>
      </div>
    </div>
<?php }

function pz_faq_dog_skin_conditions() {
    return [
        ["Should I worry if my dog suddenly gets hives?", "Hives can indicate an allergic reaction. If it's sudden or severe, check for other allergy signs like facial swelling or breathing difficulty — treat it as more urgent if those are present. For a fuller assessment, our dedicated dog allergy symptoms checker can help walk through the full picture."],
        ["My dog has scabs — is this an infection?", "Scabs can indicate infection or parasites like mites or fleas. A vet visit is recommended, especially if they're not improving within a few days. Avoid using over-the-counter products without knowing the actual cause — treating the wrong issue can delay real relief."],
        ["What causes hair loss patches in dogs?", "Several things can cause hair loss: allergies, parasites, hormonal imbalance, or ringworm. Ringworm is contagious to humans and other pets, which makes getting an accurate vet diagnosis important rather than guessing and self-treating."],
        ["My dog has been itchy for months with no visible rash — what's going on?", "Chronic itching without obvious skin changes often points to an underlying allergy, whether environmental or food-related. An elimination diet or allergy testing, guided by your vet, is typically the next step to identify the actual trigger."],
        ["Are there general skin care habits that help prevent problems?", "Yes — regular brushing and grooming helps you catch skin issues early, omega-3 fatty acids support the skin barrier, and human skincare products should be avoided on dogs since dog skin has a different pH than human skin."],
    ];
}

function pz_what_is_dog_skin_conditions() {
    ob_start(); ?>
    <p>The Common Dog Skin Conditions Guide helps you make sense of symptoms like itching, redness, hair loss, scabs, and hives — several very different underlying causes can produce similar-looking symptoms, so this guide points you toward what's likely going on and whether it needs a vet visit.</p>
    <p>Skin symptoms in dogs span a wide range of causes: allergic reactions (sometimes showing as hives, sometimes as chronic itching), parasites like mites or fleas, infections that need targeted treatment, hormonal imbalances, and contagious conditions like ringworm. Duration matters too — something that's just started is treated differently than a chronic, recurring issue.</p>
    <p>Select your dog's symptom type and how long it's been present above for guidance, then scroll down for prevention tips and the FAQ covering the skin condition questions dog owners ask most.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_skin_conditions() {
    ob_start(); ?>
    <p>Skin symptoms often look similar on the surface but come from very different causes — getting the right read matters for choosing the right next step:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🤧</span>
        <div>
          <strong>Hives Can Signal a Real Allergic Reaction</strong>
          <p>Sudden or severe hives, especially alongside facial swelling or breathing trouble, should be treated as more urgent, not just an odd rash.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🦠</span>
        <div>
          <strong>Some Causes Are Contagious</strong>
          <p>Ringworm, a common cause of hair loss patches, is contagious to humans and other pets — worth knowing before assuming it's "just dry skin."</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🚫</span>
        <div>
          <strong>Guessing and Self-Treating Can Delay Relief</strong>
          <p>Scabs, hair loss, and persistent redness can come from infection, parasites, or hormonal causes — treating the wrong one wastes time and can make things worse.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🧴</span>
        <div>
          <strong>Dog Skin Has a Different pH Than Human Skin</strong>
          <p>Human skincare products can disrupt a dog's skin barrier — using dog-appropriate products and habits protects skin health long-term.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_skin_conditions() {
    return [
        ['title'=>'Identify the Symptom Type', 'desc'=>"Itching alone, redness or rash, hair loss patches, scabs or sores, or hives — each points toward a different set of likely causes."],
        ['title'=>"Note How Long It's Been Present", 'desc'=>"Just started, a few weeks, or chronic/recurring — duration changes both the likely cause and the recommended next step."],
        ['title'=>'Check for Related Signs', 'desc'=>"With hives, check for facial swelling or breathing difficulty. With hair loss, note if it's spreading, since ringworm is contagious."],
        ['title'=>'Review Your Personalized Guidance', 'desc'=>"Read the likely-cause and recommended-action guidance matched to your dog's specific symptom and duration combination."],
        ['title'=>'Avoid Guessing With Over-the-Counter Products', 'desc'=>"Without knowing the actual cause, the wrong product can mask symptoms or delay real treatment — get a vet diagnosis first when indicated."],
        ['title'=>'Build Preventive Skin Care Habits', 'desc'=>"Regular brushing, omega-3 fatty acids, and dog-specific grooming products support skin health and help you catch issues early."],
    ];
}

function pz_tips_dog_skin_conditions() {
    return [
        ['Brush and Groom Regularly', "Regular brushing helps you catch skin issues — redness, scabs, hot spots — early, before they progress into something more serious."],
        ['Consider Omega-3 Fatty Acids', "Omega-3s support the skin barrier and are commonly recommended as part of a broader skin health routine — ask your vet for a dosing recommendation."],
        ['Never Use Human Skincare Products on Dogs', "Dog skin has a different pH than human skin — human shampoos and lotions can disrupt the skin barrier and worsen irritation or dryness."],
        ["Don't Self-Treat Scabs or Sores With Random Products", "Scabs can mean infection or parasites — using the wrong over-the-counter product without knowing the actual cause can delay real treatment."],
        ['Watch for Spreading With Hair Loss', "If a hair loss patch is spreading or new patches appear, consider ringworm as a possibility — it's contagious to humans and other pets."],
    ];
}

function pz_mistakes_dog_skin_conditions() {
    return [
        ['❌ Dismissing Hives as "Just a Weird Rash"', "Hives can indicate an allergic reaction — sudden or severe cases, especially with facial swelling or breathing difficulty, should be treated as more urgent."],
        ['❌ Using Leftover or Human Skincare Products', "Dog skin has a different pH than human skin. Using human shampoos, or leftover medicated products from a different issue, can worsen irritation or mask what's actually going on."],
        ['❌ Assuming Hair Loss Is "Just Shedding"', "Hair loss patches can stem from allergies, parasites, hormonal imbalance, or ringworm — which is contagious to humans and other pets. A vet diagnosis rules these apart rather than assuming the benign explanation."],
        ["❌ Waiting Too Long on Scabs That Aren't Healing", "Scabs that don't improve within a few days can indicate infection or parasites that need vet-guided treatment, not just continued home care."],
        ['❌ Treating Chronic Itching as a One-Time Issue', "Itching without visible changes that persists chronically often points to an underlying allergy — repeatedly treating flare-ups without addressing the root cause means it keeps coming back."],
    ];
}

function pz_render_guide_dog_skin_conditions( $tool ) {
    $icon = $tool['icon'] ?? '🔬';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Dog Skin Conditions Guide</div>
          <div class="pz-int-sublabel">Symptom-specific · Free · Instant</div>
        </div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--blue">🔬 Symptom-Specific</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Symptom Type</label>
          <select id="pz_sc_symptom" class="pz-int-select">
            <option value="itch_only">Itching, no visible skin changes</option>
            <option value="redness">Redness or rash</option>
            <option value="hairloss">Hair loss patches</option>
            <option value="scabs">Scabs or sores</option>
            <option value="hives">Hives or sudden swelling</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Duration</label>
          <select id="pz_sc_duration" class="pz-int-select">
            <option value="new">Just started, days</option>
            <option value="weeks">A few weeks</option>
            <option value="chronic">Chronic or recurring</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenSkinConditions()">
        <span class="pz-int-btn-icon"><?php echo $icon; ?></span>
        Get My Skin Condition Guidance
      </button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ══ 11. Dog Eye Problems: Symptoms & Treatment Guide (dog_eye_problems) ══ */

function pz_hero_quickanswer_dog_eye_problems() { ?>
    <div class="pz-hero-quickanswer">
      <div class="pz-hero-quickanswer-label">⚡ Quick Answer</div>
      <p>Squinting or signs of sudden vision loss need a same-day vet visit — eye conditions can worsen quickly and squinting signals real pain. Cloudiness could be normal age-related change or something more serious, so it needs a vet check either way. Watery discharge alone is often a minor irritant response. Select your dog's symptom and which eye(s) are affected above for guidance.</p>
    </div>
<?php }

function pz_hero_trust_dog_eye_problems() { ?>
      <span>👁️ Urgency-aware guidance</span>
      <span>🚫 No guess-and-treat advice</span>
      <span>🩺 Vet-diagnosis focused</span>
<?php }

function pz_methodology_heading_dog_eye_problems() { return "How This Eye Problem Guidance Is Built"; }

function pz_methodology_dog_eye_problems() { ?>
    <p style="color:#555;margin-bottom:20px">Eye problems are treated with more caution than most skin or coat issues, because the eye can be genuinely and quickly damaged. This guidance is built from the specific symptom you've noticed and whether one or both eyes are affected — since a single affected eye often points toward a localized cause, while both eyes more often suggests something allergic or systemic.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🚨</div>
        <strong>Pain and Vision Signs Are Urgent</strong>
        <p>Squinting (a pain signal) and sudden vision loss both trigger a same-day vet recommendation — these can worsen quickly if left unaddressed.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">👁️</div>
        <strong>One Eye vs. Both</strong>
        <p>One affected eye often points to a localized cause like a scratch or irritant; both eyes more often suggests an allergic or systemic cause.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">☁️</div>
        <strong>Cloudiness Needs a Look</strong>
        <p>Cloudiness could be normal age-related lenticular sclerosis or something more serious like cataracts — only a vet exam can tell these apart.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">💧</div>
        <strong>Discharge Type Matters</strong>
        <p>Watery discharge is often minor; thick or colored discharge more often signals an active infection needing vet-guided treatment.</p>
      </div>
    </div>
<?php }

function pz_faq_dog_eye_problems() {
    return [
        ["My dog is squinting — how urgent is that?", "Squinting is a pain signal and should be treated as urgent — see a vet the same day if possible. Eye conditions can worsen quickly, and pain in the eye is not something to wait out at home."],
        ["Is cloudy eyes in my senior dog just normal aging?", "It could be — nuclear (lenticular) sclerosis is a common, usually harmless age-related haze that doesn't significantly impair vision. But cloudiness can also mean cataracts or something more serious. A vet exam is needed to tell these apart, so don't assume it's \"just aging\" without a check."],
        ["What does thick or colored eye discharge mean?", "Thick or colored discharge usually points to an active infection like conjunctivitis. Bacterial and viral causes are treated differently, so vet-guided treatment matters. Avoid using old or leftover eye drops — including human ones — as they can make things worse."],
        ["Is watery eye discharge always a problem?", "Not always — it's often a minor irritant response to dust or allergens. But persistent watering needs a check. Also worth knowing: flat-faced breeds often have breed-normal tear-staining, which is cosmetic, not medical."],
        ["Should I worry more if both of my dog's eyes are affected?", "It depends on the symptom, but generally: one eye affected often points to a localized cause like a scratch, irritant, or foreign body, while both eyes more often suggests an allergic or systemic cause. Either way, our routine dog eye cleaning guide covers daily care, while this guide is specifically for identifying problems."],
    ];
}

function pz_what_is_dog_eye_problems() {
    ob_start(); ?>
    <p>The Dog Eye Problems Guide helps you interpret eye symptoms — from watery discharge to sudden vision changes — and understand which ones are minor and which need a prompt vet visit, since the eye can be damaged quickly if a genuine problem is left unaddressed.</p>
    <p>Eye symptoms range widely in urgency: watery discharge is often a minor irritant response, thick or colored discharge usually signals an active infection, cloudiness could be normal aging or something more serious, and squinting or sudden vision loss are pain and urgency signals that warrant same-day veterinary attention. Whether one eye or both are affected adds further context about the likely cause.</p>
    <p>Select your dog's specific symptom and which eye(s) are affected above for guidance, then scroll down for detail and the FAQ covering the eye problem questions dog owners ask most. Note this guide is about identifying problems — for routine eye-area cleaning, see our dedicated dog eye cleaning guide.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_eye_problems() {
    ob_start(); ?>
    <p>Eyes are delicate and can be damaged quickly — recognizing which symptoms are urgent changes how fast a dog gets the help they need:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🚨</span>
        <div>
          <strong>Squinting Signals Real Pain</strong>
          <p>Squinting isn't just discomfort — it's a clear pain signal, and eye conditions causing it can worsen quickly without prompt treatment.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">👀</span>
        <div>
          <strong>Sudden Vision Loss Needs Fast Action</strong>
          <p>A dog suddenly bumping into things is a serious sign — prompt evaluation gives the best chance of identifying and addressing the cause.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">☁️</span>
        <div>
          <strong>Cloudiness Isn't Always "Just Age"</strong>
          <p>Age-related haze and cataracts can look similar to an owner — only a vet exam reliably tells them apart.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💧</span>
        <div>
          <strong>The Wrong Eye Drop Can Make Things Worse</strong>
          <p>Old, leftover, or human eye drops used on an infected eye can worsen the problem — vet-guided treatment matters for discharge that looks infected.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_eye_problems() {
    return [
        ['title'=>'Identify the Symptom', 'desc'=>"Watery discharge, thick/colored discharge, redness or squinting, cloudiness, or sudden vision loss signs — each carries a different urgency level."],
        ['title'=>'Check How Many Eyes Are Affected', 'desc'=>"One eye often points to a localized cause like a scratch or irritant; both eyes more often suggests an allergic or systemic cause."],
        ['title'=>'Treat Pain and Vision Signs as Urgent', 'desc'=>"Squinting or signs of sudden vision loss warrant a same-day vet visit — don't wait to see if it resolves on its own."],
        ['title'=>'Review Your Personalized Guidance', 'desc'=>"Read the likely-cause and recommended-action guidance matched to your dog's specific symptom and eyes-affected combination."],
        ['title'=>'Avoid Old or Leftover Eye Drops', 'desc'=>"Using human eye drops or leftover prescriptions from a past issue can make an active infection worse — get a vet-guided treatment instead."],
        ['title'=>'Distinguish From Routine Cleaning Needs', 'desc'=>"If this is just everyday tear-staining or debris with no other symptoms, our dog eye cleaning guide covers routine care separately."],
    ];
}

function pz_tips_dog_eye_problems() {
    return [
        ['Treat Squinting as a Same-Day Concern', "Squinting is a pain signal — eye conditions causing it can worsen quickly, so same-day veterinary attention is the safest approach."],
        ["Don't Assume Cloudiness Is Just Aging", "Nuclear sclerosis is common and usually harmless, but cataracts can look similar to an owner — only a vet exam reliably tells them apart."],
        ['Never Use Old or Human Eye Drops', "Leftover prescriptions or human eye drops can worsen an active infection — get a fresh, vet-guided diagnosis and treatment instead."],
        ['Note One Eye vs. Both', "One eye affected often points to a localized cause like a scratch; both eyes more often suggests an allergic or systemic cause — mention this to your vet."],
        ['Distinguish Tear-Staining From a Medical Issue', "Flat-faced breeds often have breed-normal tear-staining that's cosmetic, not medical — but persistent watering beyond that still deserves a check."],
    ];
}

function pz_mistakes_dog_eye_problems() {
    return [
        ['❌ Waiting Out Squinting or Redness', "Squinting is a pain signal, and eye conditions can worsen quickly. Waiting to see if it resolves risks losing the window for the most effective, least invasive treatment."],
        ['❌ Assuming All Cloudiness Is "Just Old Age"', "Age-related haze and cataracts can look similar — assuming it's benign without a vet exam means a treatable condition could be missed."],
        ['❌ Reusing Old or Leftover Eye Drops', "Using a leftover prescription from a past issue, or human eye drops, on a new problem can worsen an active infection rather than help it."],
        ['❌ Ignoring Sudden Bumping-Into-Things Behavior', "Signs of sudden vision loss need prompt evaluation — dismissing clumsiness as random behavior risks missing a genuinely urgent issue."],
        ['❌ Confusing Breed-Normal Tear-Staining With a Medical Problem (or Vice Versa)', "Flat-faced breeds often have cosmetic tear-staining, but persistent watery discharge beyond that baseline still deserves a proper check rather than being dismissed either way."],
    ];
}

function pz_render_guide_dog_eye_problems( $tool ) {
    $icon = $tool['icon'] ?? '👁️';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Dog Eye Problems Guide</div>
          <div class="pz-int-sublabel">Symptoms &amp; treatment · Free · Instant</div>
        </div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--blue">👁️ Urgency-Aware</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Symptom</label>
          <select id="pz_ep_symptom" class="pz-int-select">
            <option value="watery">Watery discharge</option>
            <option value="colored">Thick or colored discharge</option>
            <option value="red_squint">Redness or squinting (pain signs)</option>
            <option value="cloudy">Cloudiness or visible change to the eye</option>
            <option value="vision">Signs of sudden vision loss (bumping into things)</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Eyes Affected</label>
          <select id="pz_ep_eyes" class="pz-int-select">
            <option value="one">One eye</option>
            <option value="both">Both eyes</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenEyeProblems()">
        <span class="pz-int-btn-icon"><?php echo $icon; ?></span>
        Get My Eye Problem Guidance
      </button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ══ 12. Dog Ear Infection: Symptoms, Causes & Treatment (dog_ear_infection) ══ */

function pz_hero_quickanswer_dog_ear_infection() { ?>
    <div class="pz-hero-quickanswer">
      <div class="pz-hero-quickanswer-label">⚡ Quick Answer</div>
      <p>Head tilt or shaking is more urgent — it can mean the infection has reached the middle or inner ear, a more serious situation than a surface infection. Redness or discharge usually needs vet diagnosis since bacterial vs. yeast infections are treated differently. Recurring infections are often driven by an underlying allergy that needs addressing, not just repeated treatment. Select your dog's symptoms and history above for guidance.</p>
    </div>
<?php }

function pz_hero_trust_dog_ear_infection() { ?>
      <span>👂 Severity-aware guidance</span>
      <span>🔁 Recurring-cause focused</span>
      <span>🩺 No guess-and-treat advice</span>
<?php }

function pz_methodology_heading_dog_ear_infection() { return "How This Ear Infection Guidance Is Built"; }

function pz_methodology_dog_ear_infection() { ?>
    <p style="color:#555;margin-bottom:20px">Ear infection guidance is built from current symptoms and history together. Symptoms range from mild odor through to pain and swelling, with head tilt or shaking flagged as more urgent since it can signal the infection has spread beyond the outer ear. History matters separately — a first-time issue points toward early treatment and reviewing your cleaning routine, while a recurring issue points toward finding and addressing the underlying cause, often allergies.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🚨</div>
        <strong>Head Tilt Is a Red Flag</strong>
        <p>Head shaking or tilt can mean the infection has reached the middle or inner ear — a more serious situation than a surface infection.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🦠</div>
        <strong>Bacterial vs. Yeast Matters</strong>
        <p>These need different treatments — using the wrong product, or a leftover one from a past infection, can prolong or mask the real problem.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🔁</div>
        <strong>Recurring Points to Root Cause</strong>
        <p>Allergies are a very common driver of recurring ear infections — treating only the current infection without addressing this means it returns.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🧼</div>
        <strong>First-Time vs. Routine Prevention</strong>
        <p>A first-time mild issue is a good moment to review your ear-cleaning routine before it becomes a recurring pattern.</p>
      </div>
    </div>
<?php }

function pz_faq_dog_ear_infection() {
    return [
        ["My dog is tilting their head — how serious is that?", "Head tilt is more urgent than typical ear infection symptoms — it can indicate the infection has reached the middle or inner ear, which is a more serious situation than a surface infection. This warrants a prompt vet visit, not home treatment."],
        ["Can I just clean my dog's ears at home to treat an infection?", "If there's redness or discharge, it likely needs vet diagnosis rather than home cleaning alone — bacterial and yeast infections require different treatments, and typically a prescription. Using the wrong product, or a leftover one from a past infection, can prolong the problem."],
        ["Why does my dog keep getting ear infections?", "Recurring ear infections are very commonly driven by an underlying allergy — environmental or food-related. Treating only the current infection without addressing the underlying cause with your vet means it's likely to keep coming back."],
        ["My dog just has a mild odor and occasional scratching — do I need a vet?", "For a first-time, mild issue, a vet visit before it progresses is still recommended, along with reviewing your ear-cleaning routine. Our dedicated dog ear cleaning guide covers routine prevention if this turns out to be early-stage or preventable."],
        ["What does pain or swelling in the ear mean?", "Pain when touched or visible swelling is a more urgent presentation and needs a prompt vet visit — these signs suggest a more advanced or more serious infection than mild odor or scratching alone."],
    ];
}

function pz_what_is_dog_ear_infection() {
    ob_start(); ?>
    <p>The Dog Ear Infection Guide helps you interpret ear symptoms — from mild odor to head tilt — and understand what they likely mean, whether home care or a vet visit is the right next step, and why recurring infections need a different approach than a first-time issue.</p>
    <p>Ear infections range in severity and cause: mild odor or occasional scratching can be early-stage, redness or discharge usually signals an active infection needing vet diagnosis since bacterial and yeast infections are treated differently, and head shaking or tilt is a more urgent sign that the infection may have reached the middle or inner ear. Recurring infections point toward an underlying cause — very often allergies — that needs to be addressed directly.</p>
    <p>Select your dog's symptoms and whether this is a first-time or recurring issue above for guidance, then scroll down for detail and the FAQ covering the ear infection questions dog owners ask most. For routine prevention, see our dedicated dog ear cleaning guide.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_ear_infection() {
    ob_start(); ?>
    <p>Ear infections range from mild and easily managed to genuinely serious — knowing the difference changes how quickly a dog needs help:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🚨</span>
        <div>
          <strong>Head Tilt Can Mean It's Spread</strong>
          <p>Head shaking or tilt can indicate the infection has reached the middle or inner ear — a more serious situation than a surface infection.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🦠</span>
        <div>
          <strong>The Wrong Treatment Can Prolong It</strong>
          <p>Bacterial and yeast infections need different treatments — using the wrong product, or a leftover one, can mask or worsen the real issue.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🔁</span>
        <div>
          <strong>Recurring Infections Have a Root Cause</strong>
          <p>Allergies very commonly drive recurring ear infections — treating symptoms alone without addressing this means the cycle keeps repeating.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🧼</span>
        <div>
          <strong>Early Attention Prevents Progression</strong>
          <p>A mild, first-time issue caught early and paired with a reviewed cleaning routine is far easier to manage than a progressed infection.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_ear_infection() {
    return [
        ['title'=>'Identify Current Symptoms', 'desc'=>"Mild odor/scratching, redness/discharge, head shaking/tilt, or pain/swelling — each level calls for a different response."],
        ['title'=>'Note Whether This Is First-Time or Recurring', 'desc'=>"A first-time mild issue points to early treatment; a recurring issue points to finding and addressing an underlying cause."],
        ['title'=>'Treat Head Tilt as Urgent', 'desc'=>"Head shaking or tilt can mean the infection has reached the middle or inner ear — this warrants a prompt vet visit."],
        ['title'=>'Get a Vet Diagnosis for Discharge', 'desc'=>"Redness or discharge likely needs vet-guided treatment, since bacterial and yeast infections are treated differently."],
        ['title'=>'Review Your Personalized Guidance', 'desc'=>"Read the recommended next step matched to your dog's specific symptom and history combination."],
        ['title'=>'Discuss Root Causes If Recurring', 'desc'=>"If this keeps happening, talk to your vet about underlying allergies rather than just treating each infection as it comes."],
    ];
}

function pz_tips_dog_ear_infection() {
    return [
        ['Treat Head Tilt as an Urgent Sign', "Head shaking or tilt can mean the infection has reached the middle or inner ear — this is more serious than a surface infection and needs prompt attention."],
        ["Don't Reuse Leftover Ear Products", "Using a product left over from a past infection, without knowing if this is bacterial or yeast, can prolong the problem or mask what's really going on."],
        ['Ask About Underlying Allergies If Recurring', "Recurring ear infections are very commonly driven by allergies — addressing the root cause with your vet is more effective than treating each flare-up alone."],
        ['Review Your Ear-Cleaning Routine Early', "For a first-time, mild issue, checking that your ear-cleaning routine is appropriate can help prevent progression — see our dog ear cleaning guide for prevention."],
        ['Get Discharge Diagnosed, Not Guessed At', "Bacterial and yeast infections look similar to an owner but need different treatments — a vet diagnosis avoids wasted time on the wrong product."],
    ];
}

function pz_mistakes_dog_ear_infection() {
    return [
        ['❌ Dismissing Head Tilt as Just "Shaking Off Water"', "Head tilt can indicate the infection has reached the middle or inner ear — a more serious situation than a surface infection that needs prompt evaluation."],
        ['❌ Using a Leftover Product From a Past Infection', "Bacterial and yeast infections require different treatments — reusing an old product without a current diagnosis can prolong the problem or mask what's happening."],
        ['❌ Treating Each Recurrence Without Asking Why', "Recurring infections are very commonly driven by an underlying allergy — treating only the current infection each time means it's likely to keep coming back."],
        ['❌ Waiting Through Pain or Visible Swelling', "Pain when touched or visible swelling is a more advanced presentation that needs a prompt vet visit, not continued home monitoring."],
        ['❌ Over-Cleaning Ears as a "Just in Case" Habit', "Excessive cleaning can irritate the ear canal and disrupt its natural balance — a reviewed, appropriate routine matters more than frequency alone."],
    ];
}

function pz_render_guide_dog_ear_infection( $tool ) {
    $icon = $tool['icon'] ?? '👂';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Dog Ear Infection Guide</div>
          <div class="pz-int-sublabel">Symptoms, causes &amp; treatment · Free · Instant</div>
        </div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--blue">👂 Severity-Aware</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Symptoms</label>
          <select id="pz_ei_symptom" class="pz-int-select">
            <option value="mild">Mild odor or occasional scratching</option>
            <option value="discharge">Redness or discharge</option>
            <option value="tilt">Head shaking or head tilt</option>
            <option value="severe">Pain when touched or visible swelling</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">History</label>
          <select id="pz_ei_history" class="pz-int-select">
            <option value="first">First time noticing this</option>
            <option value="recurring">Recurring issue</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenEarInfection()">
        <span class="pz-int-btn-icon"><?php echo $icon; ?></span>
        Get My Ear Infection Guidance
      </button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ══ Dog Diabetes: Signs, Management & Diet Guide (dog_diabetes) ══ */

function pz_hero_quickanswer_dog_diabetes() { ?>
    <div class="pz-hero-quickanswer">
      <div class="pz-hero-quickanswer-label">⚡ Quick Answer</div>
      <p>Increased thirst and urination, or weight loss despite a normal appetite, are the classic early warning signs of diabetes in dogs — either one on its own is worth a vet visit for bloodwork and a urinalysis without delay. Vomiting, lethargy, and not eating together can signal diabetic ketoacidosis, a genuine emergency complication — this needs a vet visit now, not a wait-and-see approach. No symptoms at all just means prevention and routine bloodwork matter, especially for overweight, senior, or predisposed-breed dogs. Select your dog's symptoms and risk factors above for guidance.</p>
    </div>
<?php }

function pz_hero_trust_dog_diabetes() { ?>
      <span>💉 Symptom-severity aware</span>
      <span>⚖️ Risk-factor aware</span>
      <span>🩺 Testing-focused, not diagnostic</span>
<?php }

function pz_methodology_heading_dog_diabetes() { return "How This Diabetes Guidance Is Built"; }

function pz_methodology_dog_diabetes() { ?>
    <p style="color:#555;margin-bottom:20px">Diabetes guidance is built from symptoms noticed and known risk factors together. Symptoms drive the urgency level — from prevention-only through a bloodwork recommendation to an urgent flag for possible diabetic ketoacidosis — while risk factors like being overweight, senior age, or a predisposed breed add context for dogs showing no symptoms yet.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🔍</div>
        <strong>Symptom Severity Drives Urgency</strong>
        <p>None, increased thirst/urination, weight loss, or vomiting-lethargy-not eating together each call for a distinctly different response.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">⚖️</div>
        <strong>Risk Factor Context</strong>
        <p>Being overweight, senior age, and certain breed predispositions all raise baseline risk, even before any symptoms appear.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🩸</div>
        <strong>Testing, Not Guessing</strong>
        <p>Bloodwork and a urinalysis are the actual way to confirm diabetes — this guide points you toward testing, not a diagnosis by symptom list alone.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">💊</div>
        <strong>Diagnosed Dogs Follow Their Vet's Plan</strong>
        <p>If your dog is already diagnosed, this tool defers entirely to your vet's specific insulin and diet plan.</p>
      </div>
    </div>
<?php }

function pz_faq_dog_diabetes() {
    return [
        ["What are the early warning signs of diabetes in dogs?", "Increased thirst and urination, and weight loss despite a normal appetite, are the two most common early signs. Either one on its own is worth a vet visit for bloodwork and a urinalysis — these are the most common early presentation of diabetes and shouldn't be waited out."],
        ["My dog is vomiting, lethargic, and not eating — is this an emergency?", "Yes, treat this combination as urgent. It can indicate diabetic ketoacidosis, a genuine emergency complication of diabetes, and needs a vet visit now rather than a wait-and-see approach."],
        ["Which dogs are at higher risk for diabetes?", "Overweight dogs, senior dogs, and dogs of certain predisposed breeds all carry a higher baseline risk. None of these guarantee diabetes will develop, but they're a good reason to keep up with routine annual bloodwork."],
        ["My dog isn't showing any symptoms — do I still need to do anything?", "Not urgently, but maintaining a healthy weight and keeping up with routine annual bloodwork is worthwhile, especially if your dog has a risk factor. Bloodwork can catch early signs before symptoms ever appear."],
        ["My dog is already diagnosed with diabetes — does this tool help manage it?", "Not directly — this tool isn't a substitute for your vet's specific insulin and diet plan. It's meant to help decide whether symptoms warrant getting tested in the first place, not to manage an existing diagnosis."],
    ];
}

function pz_what_is_dog_diabetes() {
    ob_start(); ?>
    <p>The Dog Diabetes Guide helps you interpret symptoms — or the absence of symptoms — and understand whether they warrant getting your dog tested for diabetes, from prevention habits for a symptom-free dog to an urgent flag for possible diabetic ketoacidosis.</p>
    <p>Diabetes in dogs typically shows up first as increased thirst and urination, or weight loss despite a normal appetite — these are the two most common early signs and are worth bloodwork and a urinalysis without delay. Vomiting, lethargy, and not eating together are more serious and can signal diabetic ketoacidosis, a genuine emergency. Risk factors like being overweight, senior age, or a predisposed breed matter most when no symptoms are present yet, since they point toward the value of routine screening.</p>
    <p>Select your dog's symptoms and risk factors above for guidance, then scroll down for detail and the FAQ covering the diabetes questions dog owners ask most. If your dog is already diagnosed, always defer to your vet's specific management plan.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_diabetes() {
    ob_start(); ?>
    <p>Diabetes symptoms range from easy to miss to a genuine emergency — knowing the difference changes how quickly a dog gets help:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🚨</span>
        <div>
          <strong>Diabetic Ketoacidosis Is a Real Emergency</strong>
          <p>Vomiting, lethargy, and not eating together can indicate this serious complication — it needs a vet visit now, not monitoring at home.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💧</span>
        <div>
          <strong>Thirst and Weight Loss Are the Classic Early Signs</strong>
          <p>Increased thirst/urination and unexplained weight loss are the most common early presentation — both deserve prompt bloodwork.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⚖️</span>
        <div>
          <strong>Weight Management Lowers Risk</strong>
          <p>Maintaining a healthy weight is one of the most controllable factors in reducing a dog's baseline diabetes risk.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🩺</span>
        <div>
          <strong>Routine Bloodwork Catches It Early</strong>
          <p>Annual bloodwork can catch early signs of diabetes before symptoms ever appear, especially in at-risk dogs.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_diabetes() {
    return [
        ['title'=>'Note Any Symptoms Noticed', 'desc'=>"None, increased thirst/urination, weight loss despite normal appetite, or vomiting-lethargy-not eating together — each calls for a different response."],
        ['title'=>"Consider Your Dog's Risk Factors", 'desc'=>"Being overweight, senior age, or a known breed predisposition all raise baseline risk, even with no symptoms yet."],
        ['title'=>'Treat Severe Symptoms as an Emergency', 'desc'=>"Vomiting, lethargy, and not eating together can indicate diabetic ketoacidosis — this needs a vet visit now."],
        ['title'=>'Get Bloodwork for Early Warning Signs', 'desc'=>"Increased thirst/urination or weight loss on their own are worth a vet visit for bloodwork and a urinalysis without delay."],
        ['title'=>'Review Your Personalized Guidance', 'desc'=>"Read the recommendation matched to your dog's specific symptom and risk factor combination."],
        ['title'=>'Build Prevention Habits If No Symptoms', 'desc'=>"Maintain a healthy weight and keep up with routine annual bloodwork, especially if a risk factor is present."],
    ];
}

function pz_tips_dog_diabetes() {
    return [
        ['Keep Your Dog at a Healthy Weight', "Excess weight is one of the most controllable risk factors for diabetes — maintaining an ideal weight lowers baseline risk meaningfully."],
        ['Schedule Annual Bloodwork, Especially If At-Risk', "Routine bloodwork can catch early signs of diabetes before symptoms ever appear — this matters most for overweight, senior, or predisposed-breed dogs."],
        ['Know the Early Warning Signs', "Increased thirst and urination, and weight loss despite normal appetite, are the two most common early signs — don't dismiss either one."],
        ["Don't Wait Out Vomiting, Lethargy, and Not Eating Together", "This combination can indicate diabetic ketoacidosis, a genuine emergency complication that needs a vet visit now."],
        ["Follow Your Vet's Specific Plan If Already Diagnosed", "This tool helps decide whether to get tested — it isn't a substitute for your vet's individualized insulin and diet plan once diagnosed."],
    ];
}

function pz_mistakes_dog_diabetes() {
    return [
        ['❌ Dismissing Increased Thirst as "Just the Weather"', "Increased thirst and urination is one of the two most common early signs of diabetes — it deserves a vet visit for bloodwork, not an assumption about the heat."],
        ['❌ Waiting to See If Vomiting and Lethargy Pass', "Vomiting, lethargy, and not eating together can indicate diabetic ketoacidosis, a genuine emergency — this combination needs a vet visit now."],
        ['❌ Assuming Only Overweight Dogs Get Diabetes', "Senior age and certain breed predispositions also raise risk independent of weight — knowing your dog's full risk profile matters."],
        ['❌ Skipping Annual Bloodwork in At-Risk Dogs', "Routine bloodwork is one of the most reliable ways to catch diabetes before symptoms appear, especially for overweight, senior, or predisposed dogs."],
        ["❌ Using General Guidance as a Substitute for Your Vet's Plan", "If your dog is already diagnosed with diabetes, this tool isn't a substitute for your vet's specific insulin and diet plan — it's meant to help decide whether symptoms warrant getting tested in the first place."],
    ];
}

function pz_render_guide_dog_diabetes( $tool ) {
    $icon = $tool['icon'] ?? '💉';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Dog Diabetes Guide</div>
          <div class="pz-int-sublabel">Signs, management &amp; diet · Free · Instant</div>
        </div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--blue">💉 Symptom-Aware</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Symptoms Noticed</label>
          <select id="pz_db_symptoms" class="pz-int-select">
            <option value="none">None — just learning</option>
            <option value="thirst">Increased thirst and urination</option>
            <option value="weightloss">Weight loss despite normal appetite</option>
            <option value="severe">Vomiting, lethargy, and not eating</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Risk Factors</label>
          <select id="pz_db_risk" class="pz-int-select">
            <option value="none">None known</option>
            <option value="overweight">Overweight</option>
            <option value="senior">Senior age</option>
            <option value="breed">Known breed predisposition</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenDiabetes()">
        <span class="pz-int-btn-icon"><?php echo $icon; ?></span>
        Get My Diabetes Guidance
      </button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ══ Dog Cancer Early Warning Signs Guide (dog_cancer_signs) ══ */

function pz_hero_quickanswer_dog_cancer_signs() { ?>
    <div class="pz-hero-quickanswer">
      <div class="pz-hero-quickanswer-label">⚡ Quick Answer</div>
      <p>Most new lumps and bumps in dogs are benign — but appearance and feel alone can't confirm that, so any new lump still deserves a vet check. Multiple signs together, or a single change that's persisted a month or more, are worth a proper diagnostic workup soon, since early detection generally means more treatment options. Weight loss and non-healing wounds have several possible causes beyond cancer, but persistent changes are worth checking regardless of the cause. Select what you've noticed and how long it's been present above for guidance.</p>
    </div>
<?php }

function pz_hero_trust_dog_cancer_signs() { ?>
      <span>🔍 Calm, non-alarming guidance</span>
      <span>🩺 Diagnosis-focused, not guesswork</span>
      <span>📋 Awareness checklist included</span>
<?php }

function pz_methodology_heading_dog_cancer_signs() { return "How This Cancer Sign Guidance Is Built"; }

function pz_methodology_dog_cancer_signs() { ?>
    <p style="color:#555;margin-bottom:20px">This guidance starts from an important fact: most lumps, bumps, and skin changes in dogs are benign. But because you can't reliably tell benign from something that needs attention just by looking or feeling, any new or persistent change is worth a vet check. Duration and whether multiple signs are present together both raise how soon that check should happen.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🔍</div>
        <strong>Benign Is Common, But Not Guaranteed</strong>
        <p>Lipomas and similar benign lumps are common — but look and feel alone can't confirm that, which is why a check matters regardless.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">⏱️</div>
        <strong>Duration Changes the Recommendation</strong>
        <p>A change that's persisted a month or more moves from "keep an eye on it" to "worth a vet visit soon."</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🧩</div>
        <strong>Multiple Signs Together Matter More</strong>
        <p>Several signs appearing at once raises the priority of a full diagnostic workup, compared to any one sign alone.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">📋</div>
        <strong>What Vets Watch For</strong>
        <p>Even with nothing noticed yet, knowing the general categories vets screen for helps you catch changes early at routine visits.</p>
      </div>
    </div>
<?php }

function pz_faq_dog_cancer_signs() {
    return [
        ["I found a new lump on my dog — does that mean cancer?", "No — most new lumps and bumps in dogs, like lipomas, are benign and harmless. But appearance and feel alone can't confirm that, so it's still worth having a vet check it, often with a quick cytology sample, just to be sure."],
        ["How urgent is it if my dog has multiple signs together, or something that's lasted over a month?", "This combination is worth a vet visit soon for a proper diagnostic workup. It doesn't mean cancer is confirmed — it means the combination is significant enough that finding out matters, and early detection generally improves treatment options if anything does need addressing."],
        ["My dog has lost weight but seems to be eating fine otherwise — should I worry?", "Weight loss has many possible causes beyond cancer, including dental issues, GI problems, and thyroid changes. Whatever the underlying cause turns out to be, a persistent unexplained change is worth a vet visit to find out what's going on."],
        ["What if my dog just has a wound or swelling that won't heal?", "Most minor wounds heal within a week or two. One that persists beyond that, or unusual swelling that doesn't resolve, is worth a vet look — this is about ruling things out with a proper exam, not a sign of anything specific on its own."],
        ["What general signs do vets watch for even if my dog seems fine right now?", "Lumps that grow or change, sores that don't heal, unexplained weight loss, decreased appetite, unusual bleeding or discharge, persistent lameness, difficulty breathing, eating, or swallowing, and an unusual odor are all worth a mention at your next routine visit. Regular vet exams catch most things early."],
    ];
}

function pz_what_is_dog_cancer_signs() {
    ob_start(); ?>
    <p>The Dog Cancer Early Warning Signs Guide helps you understand what a lump, a weight change, a wound, or several signs together are likely to mean — and calmly walks through why any of them are worth a vet check, without assuming the worst.</p>
    <p>It's worth saying plainly: most lumps and bumps dogs develop are benign, and there are many non-cancer explanations for weight loss, appetite changes, and slow-healing wounds. The reason any of these still deserve a vet visit is simple — you can't reliably tell benign from something that needs attention just by looking or feeling it. A vet exam, sometimes with a quick cytology sample, is what actually tells them apart. Multiple signs together, or a change that's persisted a month or more, raise how soon that visit should happen.</p>
    <p>Select what you've noticed and how long it's been present above for guidance, then scroll down for the general warning-sign categories worth knowing and the FAQ covering the questions dog owners ask most about this topic.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_cancer_signs() {
    ob_start(); ?>
    <p>Getting a calm, accurate read on a new sign — rather than panicking or dismissing it — changes both peace of mind and outcomes:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🔍</span>
        <div>
          <strong>Look and Feel Alone Aren't Diagnostic</strong>
          <p>Benign and concerning lumps can feel similar to an owner's hand — a vet exam is the only reliable way to tell them apart.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🧩</span>
        <div>
          <strong>Multiple or Persistent Signs Raise Priority</strong>
          <p>Several signs together, or something that's lasted a month or more, are worth a proper diagnostic workup sooner rather than later.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⏱️</span>
        <div>
          <strong>Early Detection Improves Options</strong>
          <p>If something does need treatment, catching it earlier generally means more treatment options and better outcomes.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">📋</span>
        <div>
          <strong>Awareness Helps You Catch Changes Early</strong>
          <p>Knowing the general categories vets watch for means you're more likely to notice and mention a change at your next routine visit.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_cancer_signs() {
    return [
        ['title'=>"Identify What You've Noticed", 'desc'=>"A new lump, weight loss or appetite change, a non-healing wound or swelling, multiple signs together, or nothing at all yet."],
        ['title'=>"Note How Long It's Been Present", 'desc'=>"Just noticed, a few weeks, or a month or more — duration changes how soon a vet visit is recommended."],
        ['title'=>'Treat Multiple Signs or Long Duration as a Priority', 'desc'=>"Several signs together, or anything that's persisted a month or more, is worth a proper diagnostic workup soon."],
        ['title'=>'Remember Most Lumps Are Benign, But Still Get Checked', 'desc'=>"The large majority of new lumps are harmless — but only a vet exam can confirm that reliably, not appearance alone."],
        ['title'=>'Review Your Personalized Guidance', 'desc'=>"Read the recommendation matched to what you've noticed and how long it's been present."],
        ['title'=>'Bring the General Warning Sign List to Routine Visits', 'desc'=>"Even with nothing noticed now, mentioning the general categories vets screen for at checkups helps catch changes early."],
    ];
}

function pz_tips_dog_cancer_signs() {
    return [
        ['Get New Lumps Checked, Even If They Seem Harmless', "Most lumps are benign, but appearance alone can't confirm that — a quick vet check, sometimes with a cytology sample, settles it either way."],
        ['Track Duration and Any Changes', "Note when you first noticed something and whether it's grown, changed, or stayed the same — this detail helps your vet assess it accurately."],
        ["Don't Wait Out Multiple Signs Together", "Several signs appearing at once is worth a vet visit soon for a full diagnostic workup, rather than watching each one individually."],
        ['Keep Up With Regular Vet Exams', "Routine exams catch most early changes before an owner would notice them at home — consistency matters more than any single check."],
        ['Know the General Categories Vets Watch For', "Lumps that change, non-healing sores, weight loss, appetite changes, unusual discharge, lameness, and breathing or swallowing difficulty are all worth mentioning at checkups."],
    ];
}

function pz_mistakes_dog_cancer_signs() {
    return [
        ['❌ Assuming a Lump "Looks Benign" Is Enough', "Appearance and feel alone can't reliably tell benign from something that needs attention — a vet check is the only way to actually know."],
        ["❌ Waiting Out a Wound That Isn't Healing", "Most minor wounds heal within a week or two — one that persists beyond that is worth a vet look rather than continued home care."],
        ['❌ Dismissing Weight Loss Because Appetite Seems Normal', "Weight loss despite normal eating has several possible causes, and a persistent unexplained change is worth checking regardless of what's behind it."],
        ['❌ Ignoring Multiple Signs Because Each One Seems Minor Alone', "Signs that would each seem small individually carry more weight when they show up together — this combination is worth a vet visit soon."],
        ['❌ Skipping Routine Exams Because "Nothing Seems Wrong"', "Regular vet exams are how most early changes get caught — waiting for obvious symptoms means missing the window when options are broadest."],
    ];
}

function pz_render_guide_dog_cancer_signs( $tool ) {
    $icon = $tool['icon'] ?? '🔬';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Dog Cancer Early Warning Signs Guide</div>
          <div class="pz-int-sublabel">Calm, vet-reviewed guidance · Free · Instant</div>
        </div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--blue">🔬 Non-Alarming Guidance</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Signs Noticed</label>
          <select id="pz_cs_signs" class="pz-int-select">
            <option value="none">None — just learning what to watch for</option>
            <option value="lump">A new lump or bump</option>
            <option value="weightloss">Weight loss or appetite change</option>
            <option value="wound">A non-healing wound or unusual swelling</option>
            <option value="multiple">Multiple signs together</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Duration</label>
          <select id="pz_cs_duration" class="pz-int-select">
            <option value="new">Just noticed</option>
            <option value="weeks">A few weeks</option>
            <option value="months">A month or more</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenCancerSigns()">
        <span class="pz-int-btn-icon"><?php echo $icon; ?></span>
        Get My Guidance
      </button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ══ Dog Anxiety: Types, Triggers & Solutions Guide (dog_anxiety) ══ */

function pz_hero_quickanswer_dog_anxiety() { ?>
    <div class="pz-hero-quickanswer">
      <div class="pz-hero-quickanswer-label">⚡ Quick Answer</div>
      <p>Severe anxiety — destructive behavior or self-harm — warrants a vet or veterinary behaviorist visit; medication alongside behavior modification may genuinely help at this level, not as a last resort. Separation, noise, and social triggers each respond best to a specific gradual desensitization approach, never punishment. Anxiety with no clear trigger can sometimes stem from an underlying medical cause, like chronic pain or a thyroid imbalance, worth ruling out first. Select your dog's trigger pattern and severity above for guidance.</p>
    </div>
<?php }

function pz_hero_trust_dog_anxiety() { ?>
      <span>😰 Trigger-specific protocols</span>
      <span>🚫 No punishment-based advice</span>
      <span>🩺 Medical-cause aware</span>
<?php }

function pz_methodology_heading_dog_anxiety() { return "How This Anxiety Guidance Is Built"; }

function pz_methodology_dog_anxiety() { ?>
    <p style="color:#555;margin-bottom:20px">Anxiety guidance is built from the trigger pattern and severity together. Separation, noise, and social triggers each call for a specific desensitization protocol, while severity decides how urgently professional help is needed — from a consistent at-home approach for mild cases up to a vet or veterinary behaviorist visit for severe, destructive, or self-harming behavior. Anxiety with no clear trigger is treated differently, since it can sometimes have an underlying medical cause.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🎯</div>
        <strong>Trigger Pattern Shapes the Approach</strong>
        <p>Separation, noise, and social anxiety each respond best to a different, specific desensitization protocol — not a one-size-fits-all fix.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">📊</div>
        <strong>Severity Drives the Recommendation</strong>
        <p>Mild and moderate anxiety are typically manageable at home; severe, destructive, or self-harming behavior needs professional involvement.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🚫</div>
        <strong>Punishment Backfires</strong>
        <p>Punishing anxiety-driven behavior worsens the underlying anxiety rather than fixing it — this guidance never recommends it.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🩺</div>
        <strong>Undifferentiated Anxiety Gets a Medical Check</strong>
        <p>Constant anxiety with no clear trigger can sometimes mimic an underlying medical issue — ruling that out comes first.</p>
      </div>
    </div>
<?php }

function pz_faq_dog_anxiety() {
    return [
        ["My dog is anxious whenever I leave — what actually helps?", "Gradual desensitization to departure cues (keys, shoes, grabbing your bag) helps break the association with you leaving for good. Never use punishment for anxiety-driven behavior — it worsens things. Crate training can help if your dog already finds the crate comforting, and calming aids can help mild cases."],
        ["My dog panics during storms and fireworks — what can I do?", "The same gradual desensitization approach helps, along with giving your dog a safe, quiet space during events. For severe storm or fireworks anxiety, situational vet-discussed medication is a reasonable option — not a last resort to feel guilty about."],
        ["Is it ever okay to use medication for my dog's anxiety?", "Yes. For severe anxiety, or situational triggers like fireworks, medication alongside behavior modification can be genuinely appropriate and effective. This is a decision to make with your vet, not something to avoid out of guilt."],
        ["My dog seems anxious all the time with no clear trigger — what does that mean?", "Constant, undifferentiated anxiety can sometimes have an underlying medical cause, like chronic pain or a thyroid imbalance, that mimics behavioral anxiety. A vet exam to rule out medical causes is the recommended first step before assuming it's purely behavioral."],
        ["My dog is destructive or hurts itself when anxious — is this normal?", "No — this level of severity shouldn't just be waited out. A vet or veterinary behaviorist visit is recommended, and medication alongside behavior modification may be appropriate to help your dog make progress."],
    ];
}

function pz_what_is_dog_anxiety() {
    ob_start(); ?>
    <p>The Dog Anxiety Guide helps you match your dog's specific trigger pattern and severity level to the right approach — from a gradual at-home desensitization protocol to knowing when a vet or veterinary behaviorist visit is the right next step.</p>
    <p>Anxiety in dogs shows up differently depending on the trigger: separation anxiety responds to desensitizing departure cues, noise anxiety benefits from a safe space plus gradual exposure, and social anxiety needs gentle, positive-reinforcement exposure rather than forcing interaction. Anxiety with no clear trigger is a different case — it can sometimes point to an underlying medical cause that needs ruling out first. Severity matters too: mild and moderate anxiety are typically manageable with a consistent approach, while severe, destructive, or self-harming behavior needs professional support.</p>
    <p>Select your dog's trigger pattern and severity above for guidance, then scroll down for detail and the FAQ covering the anxiety questions dog owners ask most.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_anxiety() {
    ob_start(); ?>
    <p>Getting the right approach for the right type and severity of anxiety changes how effectively — and how kindly — it gets addressed:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🚨</span>
        <div>
          <strong>Severe Anxiety Needs Professional Help</strong>
          <p>Destructive behavior or self-harm shouldn't just be waited out — a vet or veterinary behaviorist visit, sometimes with medication, is appropriate.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🚫</span>
        <div>
          <strong>Punishment Makes Anxiety Worse</strong>
          <p>Punishing anxiety-driven behavior worsens the underlying anxiety rather than resolving it — positive, gradual methods work better.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🩺</span>
        <div>
          <strong>Medical Causes Can Mimic Behavioral Anxiety</strong>
          <p>Chronic pain or a thyroid imbalance can look like constant anxiety with no clear trigger — ruling this out matters before assuming it's behavioral.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🎯</span>
        <div>
          <strong>The Right Protocol Depends on the Trigger</strong>
          <p>Separation, noise, and social anxiety each respond to a specific approach — using the wrong one wastes time and can worsen fear.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_anxiety() {
    return [
        ['title'=>'Identify the Trigger Pattern', 'desc'=>"Separation, noise, social situations, or no clear trigger at all — each points toward a different approach."],
        ['title'=>'Rate the Severity Honestly', 'desc'=>"Mild and occasional, moderate and fairly regular, or severe with destructive or self-harming behavior — severity changes the recommendation."],
        ['title'=>"Rule Out Medical Causes If There's No Clear Trigger", 'desc'=>"Constant, undifferentiated anxiety can sometimes stem from chronic pain or a thyroid imbalance — a vet exam comes first."],
        ['title'=>'Apply the Trigger-Specific Protocol', 'desc'=>"Gradual desensitization for separation and noise, gentle positive-reinforcement exposure for social anxiety."],
        ['title'=>'Avoid Punishment-Based Responses', 'desc'=>"Punishing anxiety-driven behavior worsens it — redirect and reward calm behavior instead."],
        ['title'=>'Escalate to a Vet or Behaviorist for Severe Cases', 'desc'=>"Destructive behavior or self-harm needs professional involvement — medication alongside behavior modification may be appropriate."],
    ];
}

function pz_tips_dog_anxiety() {
    return [
        ['Use Gradual Desensitization, Not Forced Exposure', "Slowly building tolerance to departure cues, noise, or new situations works far better than forcing your dog through overwhelming exposure."],
        ['Never Punish Anxiety-Driven Behavior', "Punishment for chewing, accidents, or barking caused by anxiety increases the underlying anxiety rather than fixing the behavior."],
        ['Consider Situational Medication Without Guilt', "For severe or event-specific anxiety like fireworks, vet-discussed medication alongside behavior modification is a legitimate, effective option."],
        ["Rule Out Medical Causes for Undifferentiated Anxiety", "If there's no clear trigger and anxiety seems constant, a vet exam to check for chronic pain or thyroid imbalance is the right first step."],
        ['Give Anxious Dogs a Safe Retreat Space', "A quiet, den-like space to retreat to during stressful events — like storms — helps dogs self-soothe rather than escalate."],
    ];
}

function pz_mistakes_dog_anxiety() {
    return [
        ['❌ Punishing Destructive or Anxious Behavior', "Punishment for anxiety-driven behavior worsens the underlying anxiety — it doesn't teach the dog anything except that you're now also a source of stress."],
        ['❌ Forcing Exposure ("Flooding") to Fix Social Fear', "Forcing a fearful dog into an overwhelming social situation typically worsens fear rather than resolving it — gradual, positive exposure works better."],
        ["❌ Waiting Out Severe or Self-Harming Anxiety", "Destructive behavior or self-harm shouldn't just be waited out — a vet or veterinary behaviorist visit, sometimes with medication, is the appropriate response."],
        ['❌ Assuming Constant Anxiety Is "Just Personality"', "Undifferentiated anxiety with no clear trigger can sometimes have an underlying medical cause, like chronic pain or thyroid imbalance, worth ruling out."],
        ["❌ Feeling Guilty About Situational Medication", "Vet-discussed medication for severe or event-specific anxiety is a legitimate tool alongside behavior modification, not a sign of giving up."],
    ];
}

function pz_render_guide_dog_anxiety( $tool ) {
    $icon = $tool['icon'] ?? '😰';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Dog Anxiety Guide</div>
          <div class="pz-int-sublabel">Types, triggers &amp; solutions · Free · Instant</div>
        </div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--blue">😰 Trigger-Specific</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Trigger Pattern</label>
          <select id="pz_anx_trigger" class="pz-int-select">
            <option value="separation">Anxious when left alone</option>
            <option value="noise">Loud noises (storms, fireworks)</option>
            <option value="social">New people or places</option>
            <option value="general">Seems anxious most of the time, no clear trigger</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Severity</label>
          <select id="pz_anx_severity" class="pz-int-select">
            <option value="mild">Mild, occasional</option>
            <option value="moderate">Moderate, fairly regular</option>
            <option value="severe">Severe — destructive behavior or self-harm</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenAnxiety()">
        <span class="pz-int-btn-icon"><?php echo $icon; ?></span>
        Get My Anxiety Guidance
      </button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ══ Kennel Cough in Dogs: Symptoms & Treatment (dog_kennel_cough) ══ */

function pz_hero_quickanswer_dog_kennel_cough() { ?>
    <div class="pz-hero-quickanswer">
      <div class="pz-hero-quickanswer-label">⚡ Quick Answer</div>
      <p>Severe breathing difficulty needs a vet visit right now — it can indicate a pneumonia complication or a different, more serious respiratory issue. A cough paired with lethargy or appetite loss is worth a vet visit too, since a secondary bacterial infection is possible. A dry, honking cough after recent boarding, daycare, or dog park exposure is the classic kennel cough presentation — usually self-limiting in 1-3 weeks, but still worth a vet visit for puppies, seniors, or dogs with weaker immune systems. Select your dog's symptoms and recent exposure above for guidance.</p>
    </div>
<?php }

function pz_hero_trust_dog_kennel_cough() { ?>
      <span>🤧 Symptom-severity aware</span>
      <span>🫁 Breathing-difficulty flagged</span>
      <span>🩺 Exposure-history aware</span>
<?php }

function pz_methodology_heading_dog_kennel_cough() { return "How This Kennel Cough Guidance Is Built"; }

function pz_methodology_dog_kennel_cough() { ?>
    <p style="color:#555;margin-bottom:20px">Kennel cough guidance is built from current symptoms and recent exposure history together. Symptoms range from a dry, honking cough while otherwise acting normal, through cough plus lethargy or appetite loss, up to severe breathing difficulty flagged as urgent. Recent exposure to boarding, daycare, or a dog park supports a classic kennel cough diagnosis; no known exposure with a persistent cough points toward ruling out other causes entirely.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🚨</div>
        <strong>Breathing Difficulty Is Urgent</strong>
        <p>Severe breathing difficulty can indicate a pneumonia complication or a different, more serious respiratory issue — this needs a vet visit now.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🦠</div>
        <strong>Secondary Infection Risk</strong>
        <p>Cough plus lethargy or appetite loss can mean a secondary bacterial infection on top of kennel cough — treatable, but needs diagnosis.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🐕</div>
        <strong>Exposure History Matters</strong>
        <p>Recent boarding, daycare, or dog park exposure supports a classic kennel cough presentation, typically self-limiting in 1-3 weeks.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🫀</div>
        <strong>Ruling Out Other Causes</strong>
        <p>A persistent cough with no known exposure could be heart disease, a collapsing trachea, or allergies rather than kennel cough at all.</p>
      </div>
    </div>
<?php }

function pz_faq_dog_kennel_cough() {
    return [
        ["How urgent is it if my dog is having breathing difficulty?", "Treat this as urgent — severe breathing difficulty could indicate a pneumonia complication or a different, more serious respiratory issue. See a vet now rather than waiting to see if it passes."],
        ["My dog has a cough plus lethargy — is that normal kennel cough?", "It's worth a vet visit. A secondary bacterial infection on top of kennel cough is possible when lethargy or appetite loss join the cough, and while it's treatable, it needs an actual diagnosis rather than continued home monitoring."],
        ["My dog was just at daycare and now has a dry, honking cough — is this kennel cough?", "That's the classic presentation — a dry, honking cough after recent boarding, daycare, or dog park exposure, typically self-limiting in 1-3 weeks. A vet visit is still recommended, especially for puppies, seniors, or dogs with weaker immune systems. Use a harness instead of a collar, run a humidifier, rest, and isolate from other dogs since it's contagious."],
        ["My dog has a persistent cough but no known exposure to other dogs — what could it be?", "Worth a vet visit to rule out other causes entirely. Heart disease, a collapsing trachea (common in small breeds), or allergies can all cause a chronic cough that isn't kennel cough at all."],
        ["How long does kennel cough usually last?", "Typically 1-3 weeks and self-limiting in otherwise healthy adult dogs. It's contagious, so isolating from other dogs during that time matters, and a vet visit is still worthwhile, especially for puppies, seniors, or immune-compromised dogs."],
    ];
}

function pz_what_is_dog_kennel_cough() {
    ob_start(); ?>
    <p>The Kennel Cough Guide helps you interpret cough-related symptoms in dogs — from a mild, classic case to signs that point toward something more serious — and understand what recent exposure history adds to the picture.</p>
    <p>Kennel cough classically shows up as a dry, honking cough in a dog that's otherwise acting normal, often after recent boarding, daycare, or dog park exposure, and typically resolves on its own within 1-3 weeks. Cough combined with lethargy or appetite loss raises the possibility of a secondary bacterial infection needing diagnosis and treatment. Severe breathing difficulty is a different situation entirely and needs a vet visit right now. A persistent cough with no known exposure history is worth investigating for other causes, like heart disease, a collapsing trachea, or allergies.</p>
    <p>Select your dog's symptoms and recent exposure above for guidance, then scroll down for supportive care tips and the FAQ covering the kennel cough questions dog owners ask most.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_kennel_cough() {
    ob_start(); ?>
    <p>Most coughs in dogs are mild and self-limiting, but a few specific signs change that — knowing which is which matters:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🚨</span>
        <div>
          <strong>Breathing Difficulty Signals Something More Serious</strong>
          <p>Severe breathing difficulty can indicate a pneumonia complication or a different respiratory issue — this needs prompt veterinary attention.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🦠</span>
        <div>
          <strong>Lethargy Can Mean a Secondary Infection</strong>
          <p>Cough plus lethargy or appetite loss raises the possibility of a treatable secondary bacterial infection that still needs diagnosis.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🐕</span>
        <div>
          <strong>Exposure History Points to the Likely Cause</strong>
          <p>Recent boarding, daycare, or dog park visits make a classic kennel cough diagnosis far more likely than an unrelated cause.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🫀</span>
        <div>
          <strong>A Chronic Cough Isn't Always Kennel Cough</strong>
          <p>Heart disease, a collapsing trachea, or allergies can all cause a persistent cough — especially with no known contagious exposure.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_kennel_cough() {
    return [
        ['title'=>"Identify Your Dog's Main Symptom", 'desc'=>"A dry, honking cough alone, cough plus lethargy or appetite loss, or severe breathing difficulty — each calls for a different response."],
        ['title'=>'Note Recent Exposure History', 'desc'=>"Recent boarding, daycare, or dog park visits support a classic kennel cough diagnosis; no known exposure points elsewhere."],
        ['title'=>'Treat Breathing Difficulty as an Emergency', 'desc'=>"Severe breathing difficulty needs a vet visit now — it can indicate a pneumonia complication or another serious respiratory issue."],
        ['title'=>'Get Lethargy Paired With Cough Checked', 'desc'=>"A secondary bacterial infection is possible and treatable, but it needs an actual diagnosis rather than continued home monitoring."],
        ['title'=>'Apply Supportive Care for a Classic Case', 'desc'=>"Use a harness instead of a collar, run a humidifier, ensure rest, and isolate from other dogs since kennel cough is contagious."],
        ['title'=>"Rule Out Other Causes If There's No Exposure", 'desc'=>"A persistent cough with no known exposure could be heart disease, a collapsing trachea, or allergies rather than kennel cough."],
    ];
}

function pz_tips_dog_kennel_cough() {
    return [
        ['Use a Harness Instead of a Collar', "A collar puts direct pressure on an already irritated throat — a harness reduces throat irritation while your dog recovers."],
        ['Run a Humidifier', "A humidifier can help soothe irritated airways, making the cough a bit more comfortable while it runs its course."],
        ['Isolate From Other Dogs While Contagious', "Kennel cough spreads easily between dogs — keeping your dog away from daycare, boarding, and dog parks during recovery protects others."],
        ['Still See a Vet for Puppies, Seniors, or Weaker Immune Systems', "Even a classic, mild-looking case is worth a vet visit for dogs in these groups, since complications are more likely."],
        ["Don't Assume Every Cough Is Kennel Cough", "A persistent cough with no known exposure history could be heart disease, a collapsing trachea, or allergies instead — worth ruling out."],
    ];
}

function pz_mistakes_dog_kennel_cough() {
    return [
        ['❌ Waiting Out Breathing Difficulty', "Severe breathing difficulty can indicate a pneumonia complication or a more serious respiratory issue — this needs a vet visit now, not monitoring at home."],
        ['❌ Ignoring Lethargy Paired With a Cough', "A secondary bacterial infection is possible when lethargy or appetite loss joins a cough — it's treatable, but needs an actual diagnosis."],
        ["❌ Using a Collar Instead of a Harness During Recovery", "A collar puts pressure directly on an irritated throat — switching to a harness reduces unnecessary irritation while your dog heals."],
        ["❌ Assuming No Exposure Means It Can't Be Contagious", "A persistent cough with no known exposure history is actually a reason to look elsewhere — at heart disease, a collapsing trachea, or allergies."],
        ["❌ Not Ruling Out Heart Disease or Tracheal Issues for a Chronic Cough", "Small breeds especially can develop a collapsing trachea that causes a chronic cough easily mistaken for kennel cough — a vet visit tells them apart."],
    ];
}

function pz_render_guide_dog_kennel_cough( $tool ) {
    $icon = $tool['icon'] ?? '🤧';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Kennel Cough Guide</div>
          <div class="pz-int-sublabel">Symptoms &amp; treatment · Free · Instant</div>
        </div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--blue">🤧 Severity-Aware</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Symptoms</label>
          <select id="pz_kc_symptoms" class="pz-int-select">
            <option value="dry_cough">Dry, honking cough, otherwise acting normal</option>
            <option value="lethargy">Cough plus lethargy or appetite loss</option>
            <option value="breathing">Severe breathing difficulty</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Recent Exposure</label>
          <select id="pz_kc_exposure" class="pz-int-select">
            <option value="yes">Recent boarding, daycare, or dog park</option>
            <option value="no">No known exposure</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenKennelCough()">
        <span class="pz-int-btn-icon"><?php echo $icon; ?></span>
        Get My Kennel Cough Guidance
      </button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ══ Dog Hypothyroidism: Symptoms & Management (dog_hypothyroidism) ══ */

function pz_hero_quickanswer_dog_hypothyroidism() { ?>
    <div class="pz-hero-quickanswer">
      <div class="pz-hero-quickanswer-label">⚡ Quick Answer</div>
      <p>Multiple signs together, or any single sign in a middle-aged, medium-to-large breed dog, are worth a thyroid blood panel (T4/TSH) — good news first: it's a simple test, and hypothyroidism is very manageable with daily medication once diagnosed. Weight gain despite a normal diet and coat thinning are both recognized signs on their own, though coat changes have other possible causes too and need bloodwork to confirm. Select your dog's symptoms and risk profile above for guidance.</p>
    </div>
<?php }

function pz_hero_trust_dog_hypothyroidism() { ?>
      <span>🏥 Risk-profile aware</span>
      <span>🩸 Simple-test framing</span>
      <span>💊 Manageable-condition focus</span>
<?php }

function pz_methodology_heading_dog_hypothyroidism() { return "How This Hypothyroidism Guidance Is Built"; }

function pz_methodology_dog_hypothyroidism() { ?>
    <p style="color:#555;margin-bottom:20px">Hypothyroidism is most commonly diagnosed in middle-aged, medium-to-large breed dogs — a real epidemiological pattern that shapes this guidance alongside symptoms noticed. Multiple signs together, or any single sign in a higher-risk dog, point toward a thyroid blood panel. Single signs in a lower-risk profile are treated more cautiously, since several have other possible causes too.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🐕</div>
        <strong>Middle-Aged, Medium-Large Breeds Are the Typical Profile</strong>
        <p>This is the demographic hypothyroidism is most commonly diagnosed in — worth knowing even before any symptoms appear.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🧩</div>
        <strong>Multiple Signs Raise Priority</strong>
        <p>Several signs together, or one sign in a higher-risk dog, move this from "keep an eye on it" to "get a blood panel."</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🩸</div>
        <strong>A Simple Blood Panel Confirms It</strong>
        <p>A T4/TSH thyroid panel is a straightforward, routine blood test — not an invasive or complicated diagnostic process.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">💊</div>
        <strong>Very Manageable Once Diagnosed</strong>
        <p>Hypothyroidism is one of the more manageable chronic conditions in dogs — daily medication typically controls it well.</p>
      </div>
    </div>
<?php }

function pz_faq_dog_hypothyroidism() {
    return [
        ["What are the signs of hypothyroidism in dogs?", "Weight gain despite a normal diet, lethargy and unusual cold intolerance, and coat thinning or skin changes are the main signs. Multiple signs appearing together are more indicative than any one sign alone."],
        ["Which dogs are most likely to develop hypothyroidism?", "Hypothyroidism is most commonly diagnosed in middle-aged, medium-to-large breed dogs. Young, small-breed dogs can develop it too, but it's less typical for that profile."],
        ["Is testing for hypothyroidism complicated?", "No — it's a simple thyroid blood panel (T4/TSH), the kind of routine bloodwork your vet can run without any special preparation."],
        ["Is hypothyroidism a serious, hard-to-manage condition?", "Not once diagnosed — it's actually good news in that sense. Hypothyroidism is very manageable with daily medication, and most dogs do very well long-term on treatment."],
        ["My dog's coat is thinning but nothing else seems different — is this hypothyroidism?", "It could be — symmetrical coat thinning and a dull coat are recognized signs. But allergies and parasites can cause similar changes, so bloodwork is needed to confirm the actual cause rather than assuming."],
    ];
}

function pz_what_is_dog_hypothyroidism() {
    ob_start(); ?>
    <p>The Dog Hypothyroidism Guide helps you understand what your dog's symptoms — and risk profile — mean for their likelihood of having an underactive thyroid, and what a straightforward diagnosis and treatment path looks like.</p>
    <p>Hypothyroidism is most commonly diagnosed in middle-aged, medium-to-large breed dogs, though it can occur outside that profile too. Weight gain despite a normal diet, lethargy with unusual cold intolerance, and coat thinning or skin changes are the recognized signs — with multiple signs together, or any single sign in a higher-risk dog, pointing toward getting a thyroid blood panel done. The good news, worth leading with: it's a simple test, and the condition is very manageable with daily medication once diagnosed.</p>
    <p>Select your dog's symptoms and risk profile above for guidance, then scroll down for detail and the FAQ covering the hypothyroidism questions dog owners ask most.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_hypothyroidism() {
    ob_start(); ?>
    <p>Recognizing hypothyroidism's typical profile and signs means getting a simple test done sooner rather than living with unexplained symptoms:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🐕</span>
        <div>
          <strong>Breed and Age Profile Matters</strong>
          <p>Hypothyroidism is most commonly diagnosed in middle-aged, medium-to-large breed dogs — worth knowing your dog's baseline risk.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🧩</span>
        <div>
          <strong>Multiple Signs Together Are More Telling</strong>
          <p>Weight gain, lethargy, cold intolerance, and coat changes appearing together point more strongly toward getting tested.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🩸</span>
        <div>
          <strong>Diagnosis Is a Simple Blood Test</strong>
          <p>A T4/TSH thyroid panel is routine bloodwork — there's no reason to put off testing out of concern it will be complicated.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💊</span>
        <div>
          <strong>Daily Medication Manages It Well</strong>
          <p>Once diagnosed, hypothyroidism is one of the more manageable chronic conditions — most dogs do very well on daily treatment.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_hypothyroidism() {
    return [
        ['title'=>'Identify Symptoms Noticed', 'desc'=>"None, weight gain, lethargy and cold intolerance, coat thinning, or multiple signs together — each calls for a different response."],
        ['title'=>"Note Your Dog's Risk Profile", 'desc'=>"Young, small breed is lower risk; middle-aged, medium-large breed is the profile hypothyroidism is most commonly diagnosed in."],
        ['title'=>'Recognize the Typical Age and Breed Pattern', 'desc'=>"Knowing this pattern helps you take a single sign more seriously if your dog fits the higher-risk profile."],
        ['title'=>'Get a Thyroid Panel If Indicated', 'desc'=>"Multiple signs together, or any sign in a higher-risk dog, are worth a simple T4/TSH blood panel."],
        ['title'=>'Review Your Personalized Guidance', 'desc'=>"Read the recommendation matched to your dog's specific symptom and risk profile combination."],
        ['title'=>"Follow Your Vet's Medication Plan Once Diagnosed", 'desc'=>"Hypothyroidism is very manageable with daily medication — most dogs do very well on treatment long-term."],
    ];
}

function pz_tips_dog_hypothyroidism() {
    return [
        ['Know the Typical Risk Profile', "Hypothyroidism is most commonly diagnosed in middle-aged, medium-to-large breed dogs — worth knowing if your dog fits that pattern."],
        ["Don't Dismiss Weight Gain With No Diet Change", "Weight gain despite a normal diet is a common early sign — worth a blood panel rather than just adjusting food further."],
        ['Get Coat Changes Confirmed, Not Assumed', "Coat thinning is a recognized sign, but allergies and parasites cause similar changes — bloodwork confirms the actual cause."],
        ['Ask for a Thyroid Panel If Multiple Signs Appear', "Weight gain, lethargy, cold intolerance, and coat changes together are a strong indication a simple T4/TSH test is worthwhile."],
        ['Expect a Manageable Path Once Diagnosed', "Hypothyroidism responds very well to daily medication — this is one of the more straightforward chronic conditions to manage long-term."],
    ];
}

function pz_mistakes_dog_hypothyroidism() {
    return [
        ['❌ Assuming Weight Gain Is Just Diet or Age', "Weight gain despite a normal diet is a recognized early sign of hypothyroidism — worth a blood panel rather than assuming it's simply aging."],
        ['❌ Blaming Coat Thinning on Allergies Without Testing', "Coat thinning can be a hypothyroidism sign, but allergies and parasites look similar — bloodwork tells them apart rather than a guess."],
        ["❌ Not Knowing Your Dog's Risk Profile", "Middle-aged, medium-to-large breed dogs are the typical profile — not knowing this means taking a single sign less seriously than you should."],
        ['❌ Treating Multiple Signs as Unrelated Coincidences', "Weight gain, lethargy, cold intolerance, and coat changes together are more indicative when they appear as a group, not separately."],
        ["❌ Worrying That Hypothyroidism Is Untreatable", "It's actually one of the more manageable chronic conditions — daily medication controls it well, and most dogs do very well long-term."],
    ];
}

function pz_render_guide_dog_hypothyroidism( $tool ) {
    $icon = $tool['icon'] ?? '🏥';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Dog Hypothyroidism Guide</div>
          <div class="pz-int-sublabel">Symptoms &amp; management · Free · Instant</div>
        </div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--blue">🏥 Risk-Profile Aware</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Symptoms</label>
          <select id="pz_ht_symptoms" class="pz-int-select">
            <option value="none">None — just learning</option>
            <option value="weightgain">Weight gain despite a normal diet</option>
            <option value="lethargy">Lethargy and unusual cold intolerance</option>
            <option value="coat">Coat thinning or skin changes</option>
            <option value="multiple">Multiple signs together</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Risk Profile</label>
          <select id="pz_ht_risk" class="pz-int-select">
            <option value="lower">Young, small breed</option>
            <option value="higher">Middle-aged, medium-large breed</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenHypothyroidism()">
        <span class="pz-int-btn-icon"><?php echo $icon; ?></span>
        Get My Hypothyroidism Guidance
      </button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ══ Dog First Aid Guide: Emergency Situations (dog_first_aid) ══ */

function pz_hero_quickanswer_dog_first_aid() { ?>
    <div class="pz-hero-quickanswer">
      <div class="pz-hero-quickanswer-label">⚡ Quick Answer</div>
      <p>Choking, bleeding, suspected poisoning, and seizures each need a different immediate response — get it right first, then always follow up with your vet or an emergency clinic. Never do a blind finger-sweep on a choking dog, never induce vomiting for suspected poisoning without being told to by a vet or poison control, and never restrain a seizing dog. Select the scenario you're preparing for above for step-by-step guidance.</p>
    </div>
<?php }

function pz_hero_trust_dog_first_aid() { ?>
      <span>🚑 Scenario-specific steps</span>
      <span>🚫 No guesswork on stabilization</span>
      <span>📞 Emergency-contact ready</span>
<?php }

function pz_methodology_heading_dog_first_aid() { return "How This First Aid Guidance Is Built"; }

function pz_methodology_dog_first_aid() { ?>
    <p style="color:#555;margin-bottom:20px">This guide is built as a preparedness and reference resource, not a diagnostic tool. Each scenario — choking, bleeding, suspected poisoning, and seizures — gets its own clear, ordered set of immediate steps, along with the specific things not to do that can make an emergency worse. General preparedness guidance covers building a first aid kit before you need one.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🚑</div>
        <strong>Scenario-Matched Steps</strong>
        <p>Choking, bleeding, poisoning, and seizures each need a specific response — this guide matches steps to the actual situation.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🚫</div>
        <strong>What Not to Do Matters Just as Much</strong>
        <p>A blind finger-sweep, inducing vomiting without guidance, or restraining a seizing dog can all make things worse — these are flagged clearly.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🎒</div>
        <strong>Preparedness Before an Emergency Happens</strong>
        <p>A basic first aid kit and saved emergency numbers mean you're not scrambling to find them in the middle of a crisis.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">📞</div>
        <strong>Stabilization, Then Professional Care</strong>
        <p>Every scenario here is about immediate stabilization — always followed by a vet visit or emergency clinic for anything serious.</p>
      </div>
    </div>
<?php }

function pz_faq_dog_first_aid() {
    return [
        ["My dog is choking — what do I do?", "Check the mouth for a visible object and remove it carefully only if it's visible and easily reachable — a blind finger-sweep can push it deeper, so don't do that. If it isn't visible or reachable, use back blows or modified chest thrusts. Get to a vet immediately even after the object comes out, to check for internal injury."],
        ["My dog is bleeding — what's the right first step?", "Apply firm direct pressure with a clean cloth and elevate the injured area if possible. Do not remove an embedded object — removing it can worsen the bleeding. Anything beyond a minor cut needs a vet visit."],
        ["I think my dog ate something poisonous — should I make them vomit?", "No — do not induce vomiting unless directed by a vet or poison control. Some substances are caustic or corrosive and cause additional damage coming back up. Call ASPCA Animal Poison Control or your vet immediately, and bring the substance's packaging or label if possible to help identify it."],
        ["My dog is having a seizure — what should I do?", "Do not restrain your dog, and move nearby objects out of the way to prevent injury. Time the seizure's duration, and keep your hands away from the mouth — there's a bite risk, and the old advice about dogs swallowing their tongue is a myth that doesn't actually happen. Seek vet care especially if a single seizure lasts over 5 minutes, or if multiple seizures occur close together."],
        ["What should be in a dog first aid kit?", "Gauze and vet wrap, a digital thermometer, hydrogen peroxide (only to be used to induce vomiting if directed by a vet or poison control — never self-administered otherwise), a muzzle for safely handling an injured or frightened dog, and your vet's plus a 24-hour emergency clinic's phone numbers saved and easily findable."],
    ];
}

function pz_what_is_dog_first_aid() {
    ob_start(); ?>
    <p>The Dog First Aid Guide is a preparedness and reference resource covering the immediate steps for the emergency situations dog owners are most likely to face: choking, bleeding, suspected poisoning, and seizures — plus what to have ready before any of them happen.</p>
    <p>Each scenario has its own specific immediate response, and just as importantly, its own specific things not to do — a blind finger-sweep on a choking dog, inducing vomiting without guidance for suspected poisoning, or restraining a seizing dog can all make an emergency worse rather than better. This guide is for immediate stabilization only; it isn't a substitute for professional veterinary care.</p>
    <p>Select the scenario you want steps for above, or choose general preparedness to build a first aid kit before you need one, then scroll down for detail and the FAQ covering the first aid questions dog owners ask most.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_first_aid() {
    ob_start(); ?>
    <p>The first few minutes of a dog emergency matter — knowing the right immediate response, and avoiding the wrong instinct, changes outcomes:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🚫</span>
        <div>
          <strong>The Wrong First Instinct Can Make Things Worse</strong>
          <p>A blind finger-sweep, removing an embedded object, or restraining a seizing dog are natural instincts that can actually cause more harm.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🐍</span>
        <div>
          <strong>Poisoning Needs a Call, Not a Guess</strong>
          <p>Inducing vomiting without guidance can cause additional damage with caustic substances — calling poison control or your vet first is the safe step.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🧠</span>
        <div>
          <strong>Seizure Myths Can Cause Injury</strong>
          <p>Reaching toward the mouth during a seizure risks a bite — the "swallowed tongue" myth has led to unnecessary injuries for both dogs and owners.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🎒</span>
        <div>
          <strong>A Kit Ready Before You Need It Saves Time</strong>
          <p>Gauze, a thermometer, a muzzle, and saved emergency numbers mean you're acting immediately instead of searching during a crisis.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_first_aid() {
    return [
        ['title'=>"Identify the Scenario You're Facing (or Preparing For)", 'desc'=>"Choking, bleeding, suspected poisoning, seizure, or general preparedness — each has its own specific set of steps."],
        ['title'=>'Follow the Scenario-Specific Immediate Steps', 'desc'=>"Read and apply the ordered steps matched to your exact situation above."],
        ['title'=>'Know What NOT to Do for Each Scenario', 'desc'=>"A blind finger-sweep, removing an embedded object, inducing vomiting without guidance, or restraining a seizing dog can all worsen the situation."],
        ['title'=>'Call Your Vet or Poison Control When Indicated', 'desc'=>"For suspected poisoning especially, call before acting — some substances need specific guidance rather than a generic response."],
        ['title'=>'Build or Check Your First Aid Kit', 'desc'=>"Gauze, vet wrap, a digital thermometer, hydrogen peroxide, a muzzle, and saved emergency numbers should all be ready in advance."],
        ['title'=>'Always Follow Up With Professional Care', 'desc'=>"This guide is for immediate stabilization only — always follow up with your vet or head to an emergency clinic for anything serious."],
    ];
}

function pz_tips_dog_first_aid() {
    return [
        ['Save Emergency Numbers Now, Not During a Crisis', "Your vet's number and a 24-hour emergency clinic's number should be saved and easily findable before you ever need them."],
        ["Learn the \"Don'ts\" Before You Need Them", "Knowing not to finger-sweep blindly, induce vomiting without guidance, or restrain a seizing dog matters as much as knowing what to do."],
        ['Build a Basic First Aid Kit', "Gauze and vet wrap, a digital thermometer, and hydrogen peroxide (for vet or poison-control-directed use only) cover the basics."],
        ["A Muzzle Isn't Just for Aggressive Dogs", "Even friendly dogs may bite when injured or frightened — a muzzle lets you safely handle and help a dog in pain."],
        ['Time Any Seizure', "Knowing exactly how long a seizure lasted helps your vet assess it — seek care especially if it goes over 5 minutes or seizures cluster close together."],
    ];
}

function pz_mistakes_dog_first_aid() {
    return [
        ['❌ Blind Finger-Sweeping for a Choking Dog', "Reaching in without seeing the object can push it deeper — only remove it carefully if it's visible and easily reachable."],
        ["❌ Inducing Vomiting Without Being Told To", "Some substances are caustic or corrosive and cause additional damage coming back up — always call a vet or poison control first."],
        ['❌ Restraining a Seizing Dog', "This doesn't stop a seizure and risks injury to both of you — move objects out of the way and let it run its course instead."],
        ['❌ Removing an Embedded Object From a Wound', "Removing it can worsen the bleeding — apply firm pressure around it instead and get to a vet."],
        ['❌ Not Having Emergency Numbers Saved in Advance', "Searching for your vet's number or a 24-hour clinic's number during an actual emergency wastes critical time."],
    ];
}

function pz_render_guide_dog_first_aid( $tool ) {
    $icon = $tool['icon'] ?? '🚑';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Dog First Aid Guide</div>
          <div class="pz-int-sublabel">Emergency situations · Free · Instant</div>
        </div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--blue">🚑 Scenario-Specific</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Scenario Focus</label>
          <select id="pz_fa_scenario" class="pz-int-select">
            <option value="general">General preparedness</option>
            <option value="choking">Choking</option>
            <option value="bleeding">Bleeding or a wound</option>
            <option value="poison">Suspected poisoning</option>
            <option value="seizure">Seizure</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Have a First Aid Kit?</label>
          <select id="pz_fa_kit" class="pz-int-select">
            <option value="yes">Yes</option>
            <option value="no">No</option>
            <option value="unsure">Not sure what to include</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenFirstAid()">
        <span class="pz-int-btn-icon"><?php echo $icon; ?></span>
        Get My First Aid Guidance
      </button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ══ Dog Hip Dysplasia: Signs, Breeds & Management (dog_hip_dysplasia) ══ */

function pz_hero_quickanswer_dog_hip_dysplasia() { ?>
    <div class="pz-hero-quickanswer">
      <div class="pz-hero-quickanswer-label">⚡ Quick Answer</div>
      <p>A "bunny-hopping" gait or noticeable limping are classic enough signs to warrant a vet visit for an exam on their own — severe difficulty rising or getting around calls for an orthopedic exam and X-rays without delay. Occasional stiffness after rest in a large or giant breed is worth mentioning to your vet early, since weight management and appropriate low-impact exercise can meaningfully slow progression. Hip dysplasia has a real, well-documented genetic component in certain large and giant breeds, so prevention-minded owners of at-risk puppies should focus on lean body condition and avoiding high-impact exercise during the growth period. Select your dog's breed risk, age, and signs above for guidance.</p>
    </div>
<?php }

function pz_hero_trust_dog_hip_dysplasia() { ?>
      <span>🦴 Breed-risk aware</span>
      <span>🐕 Gait-pattern specific</span>
      <span>⚖️ Weight-management focus</span>
<?php }

function pz_methodology_heading_dog_hip_dysplasia() { return "How This Hip Dysplasia Guidance Is Built"; }

function pz_methodology_dog_hip_dysplasia() { ?>
    <p style="color:#555;margin-bottom:20px">This guidance combines your dog's breed-size risk category, age, and the specific signs noticed — since hip dysplasia has a real genetic component in certain large and giant breeds, and its presentation and urgency both shift meaningfully with severity. A "bunny-hopping" gait and noticeable limping are classically recognized signs treated with real priority, while a puppy showing no signs at all gets prevention-focused guidance instead.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🧬</div>
        <strong>Genetic Risk Is Real and Well-Documented</strong>
        <p>Certain large and giant breeds have a well-documented genetic predisposition to hip dysplasia — worth knowing before any signs appear.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🐇</div>
        <strong>Gait Pattern Is a Named, Recognized Sign</strong>
        <p>The "bunny-hopping" gait is a classically-recognized hip dysplasia sign, not a vague description — it's specific enough to act on.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">⚖️</div>
        <strong>Weight Is the Biggest Modifiable Factor</strong>
        <p>Extra weight is one of the biggest modifiable factors in both onset and progression — lean body condition matters at every age.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🩻</div>
        <strong>Severity Determines the Path Forward</strong>
        <p>From prevention through management to surgical options like FHO or total hip replacement — guidance is matched to actual severity.</p>
      </div>
    </div>
<?php }

function pz_faq_dog_hip_dysplasia() {
    return [
        ["What is hip dysplasia in dogs?", "Hip dysplasia is a malformation of the hip joint where the ball and socket don't fit together properly, leading to wear, instability, and eventually arthritis. It has a well-documented genetic component in certain large and giant breeds, though it can occur in smaller dogs too."],
        ["What does a 'bunny-hopping' gait look like, and does it always mean hip dysplasia?", "It's when a dog moves both back legs together in a hopping motion rather than alternating them normally — a classically-recognized hip dysplasia sign. It's specific enough to be worth a vet visit, though your vet will still confirm with an exam and X-rays rather than diagnosing from the gait alone."],
        ["My puppy is a large breed with no signs yet — is there anything I should do now?", "Yes — avoid excessive high-impact exercise and jumping during the growth period, and maintain a lean body condition throughout your dog's life, since extra weight is one of the biggest modifiable risk factors. Some breeders also screen breeding dogs with OFA or PennHIP hip evaluations, which is worth asking about if you're choosing a puppy."],
        ["Does hip dysplasia always require surgery?", "No — management often starts with weight control, joint supplements, low-impact exercise, and pain management. Surgical options like a femoral head osteotomy (FHO) or total hip replacement exist for more severe cases, but they're not the first step for every dog."],
        ["My dog is just a little stiff after resting — is that hip dysplasia?", "It could be an early sign, especially in a large or giant breed, but occasional stiffness has other possible causes too. It's worth mentioning at a vet visit rather than assuming either way — early intervention can meaningfully slow progression if it is hip dysplasia."],
    ];
}

function pz_what_is_dog_hip_dysplasia() {
    ob_start(); ?>
    <p>The Dog Hip Dysplasia Guide helps you understand what your dog's breed risk, age, and current signs mean for their likelihood of having this joint condition, and what a sensible next step looks like — from prevention to a vet-guided management plan.</p>
    <p>Hip dysplasia is a malformation of the hip joint with a real, well-documented genetic component in certain large and giant breeds. Signs range from none at all, through occasional stiffness after rest, to noticeable limping or the classically-recognized "bunny-hopping" gait, to severe difficulty rising or getting around — each level calling for a different response, from prevention-focused habits to an orthopedic exam and X-rays.</p>
    <p>Select your dog's breed risk, age, and signs noticed above for guidance, then scroll down for detail and the FAQ covering the hip dysplasia questions dog owners ask most.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_hip_dysplasia() {
    ob_start(); ?>
    <p>Recognizing hip dysplasia's genetic risk pattern and its recognizable signs means catching it — or preventing it — sooner rather than watching a dog's mobility decline unexplained:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🧬</span>
        <div>
          <strong>Genetic Risk Is Real in Certain Breeds</strong>
          <p>Large and giant breeds carry a well-documented genetic predisposition — worth knowing your dog's baseline risk before signs ever appear.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🐇</span>
        <div>
          <strong>The "Bunny-Hop" Gait Is a Named Warning Sign</strong>
          <p>This specific gait pattern is classically recognized enough to justify a vet visit on its own, not just a "wait and see" observation.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⚖️</span>
        <div>
          <strong>Weight Is the Biggest Modifiable Factor</strong>
          <p>Keeping a lean body condition throughout your dog's life is one of the most effective things you can control, at any risk level.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🩻</span>
        <div>
          <strong>Early Intervention Can Slow Progression</strong>
          <p>Weight management and appropriate low-impact exercise, started early, can meaningfully slow how much a dog's hip dysplasia progresses.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_hip_dysplasia() {
    return [
        ['title'=>"Note Your Dog's Breed Risk", 'desc'=>"Large and giant breeds carry a well-documented genetic predisposition to hip dysplasia; small and medium breeds are lower risk but not immune."],
        ['title'=>"Identify Your Dog's Age Stage", 'desc'=>"Puppy, adult, or senior — this shapes whether the focus is prevention, monitoring, or active management."],
        ['title'=>'Check for Current Signs', 'desc'=>"None, occasional stiffness after rest, noticeable limping or a 'bunny-hopping' gait, or severe difficulty rising — each calls for a different response."],
        ['title'=>'Review Your Personalized Guidance', 'desc'=>"Read the recommendation matched to your dog's specific breed risk, age, and signs combination."],
        ['title'=>'See a Vet for an Orthopedic Exam If Indicated', 'desc'=>"Limping, the 'bunny-hop' gait, or severe difficulty warrant an actual exam and X-rays rather than guessing at home."],
        ['title'=>'Apply Prevention or Management Steps', 'desc'=>"Lean body condition, appropriate exercise, joint supplements, or — in more severe cases — surgical options like FHO or total hip replacement."],
    ];
}

function pz_tips_dog_hip_dysplasia() {
    return [
        ['Keep a Lean Body Condition for Life', "Extra weight is one of the biggest modifiable risk factors for both hip dysplasia onset and progression — this matters at every age."],
        ['Go Easy on High-Impact Exercise in Growing Puppies', "Avoid excessive jumping and high-impact activity during the growth period in large and giant breed puppies, especially if there's a known family history."],
        ["Take the \"Bunny-Hop\" Gait Seriously", "This specific gait pattern is a classically-recognized hip dysplasia sign — it's specific enough to warrant a vet visit rather than a wait-and-see approach."],
        ['Ask Breeders About OFA or PennHIP Screening', "Reputable breeders often screen breeding dogs' hips through OFA or PennHIP evaluations — worth asking about if you're choosing a puppy from an at-risk breed."],
        ['Mention Early Stiffness at a Routine Vet Visit', "Occasional stiffness after rest in a higher-risk breed is worth flagging early — early intervention can meaningfully slow progression."],
    ];
}

function pz_mistakes_dog_hip_dysplasia() {
    return [
        ['❌ Assuming Only Giant Breeds Get Hip Dysplasia', "It's most common in large and giant breeds, but smaller dogs can develop it too — breed risk shifts the odds, it doesn't rule it out."],
        ['❌ Letting a Growing Puppy Do Excessive High-Impact Exercise', "Excessive jumping and high-impact activity during the growth period can work against a large or giant breed puppy's joint development."],
        ["❌ Dismissing the \"Bunny-Hop\" Gait as Just a Quirky Walk", "This is a classically-recognized hip dysplasia sign, not a harmless habit — it's worth a vet visit rather than assuming it's nothing."],
        ['❌ Letting Weight Creep Up "Since the Joints Are Already a Problem"', "The opposite is true — weight management matters even more once hip dysplasia is a concern, since extra weight accelerates progression."],
        ['❌ Assuming Surgery Is the Only Option', "Weight control, joint supplements, and low-impact exercise manage many cases well — surgical options like FHO or total hip replacement are for more severe cases, not a default first step."],
    ];
}

function pz_render_guide_dog_hip_dysplasia( $tool ) {
    $icon = $tool['icon'] ?? '🦴';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Dog Hip Dysplasia Guide</div>
          <div class="pz-int-sublabel">Signs, breeds &amp; management · Free · Instant</div>
        </div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--blue">🦴 Breed-Risk Aware</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Breed Risk</label>
          <select id="pz_hd_risk" class="pz-int-select">
            <option value="high">Large/giant breed (higher genetic risk)</option>
            <option value="lower">Small/medium breed (lower risk)</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Age</label>
          <select id="pz_hd_age" class="pz-int-select">
            <option value="puppy">Puppy, under 2 years</option>
            <option value="adult">Adult</option>
            <option value="senior">Senior</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Signs Noticed</label>
          <select id="pz_hd_signs" class="pz-int-select">
            <option value="none">None noticed</option>
            <option value="stiff">Occasional stiffness, especially after rest</option>
            <option value="limp">Noticeable limping or a "bunny-hopping" gait</option>
            <option value="severe">Severe difficulty rising or getting around</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenHipDysplasia()">
        <span class="pz-int-btn-icon"><?php echo $icon; ?></span>
        Get My Hip Dysplasia Guidance
      </button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ══ Dog Bloat (GDV): Signs, Prevention & Emergency (dog_bloat_gdv) ══ */

function pz_hero_quickanswer_dog_bloat_gdv() { ?>
    <div class="pz-hero-quickanswer">
      <div class="pz-hero-quickanswer-label">⚡ Quick Answer</div>
      <p><strong>If your dog has a distended, hard belly with restlessness and unproductive retching (trying to vomit with nothing coming up), this is a life-threatening emergency — go to an emergency vet immediately.</strong> Do not wait, do not try home remedies, and do not give it a few hours to see if it passes. GDV (Gastric Dilatation-Volvulus) can be fatal within hours without emergency surgery. Collapse or pale/white gums mean the same thing — drive to the nearest emergency vet right now. Select your dog's current symptoms above.</p>
    </div>
<?php }

function pz_hero_trust_dog_bloat_gdv() { ?>
      <span>🚨 True emergency awareness</span>
      <span>⏱️ Minutes-matter framing</span>
      <span>🐕 Deep-chested breed aware</span>
<?php }

function pz_methodology_heading_dog_bloat_gdv() { return "How This Bloat (GDV) Guidance Is Built"; }

function pz_methodology_dog_bloat_gdv() { ?>
    <p style="color:#555;margin-bottom:20px">This guide treats GDV for what it is: a true medical emergency with no safe "wait and see" option. Any dog showing the classic triad — a distended, hard belly, restlessness, and unproductive retching — gets unambiguous instructions to seek emergency care immediately, with no hedging. Dogs with no current symptoms get evidence-based prevention information instead, framed honestly about what is and isn't settled science.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🚨</div>
        <strong>No Hedging on the Emergency Signs</strong>
        <p>A distended belly, restlessness, and unproductive retching together mean go now — this guide never suggests waiting to see.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🐕</div>
        <strong>Deep-Chested Breeds Carry Real Risk</strong>
        <p>Great Danes, Standard Poodles, German Shepherds, and similar deep-chested body types are at documented elevated risk.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🍽️</div>
        <strong>Feeding Pattern Is a Modifiable Factor</strong>
        <p>Eating one large meal quickly, versus smaller frequent meals, is a well-studied risk factor you can actually control.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🔬</div>
        <strong>Honest About What's Unsettled</strong>
        <p>Elevated feeding bowls are often mentioned as prevention, but current veterinary understanding of their actual effect is mixed — this guide says so rather than overstating it.</p>
      </div>
    </div>
<?php }

function pz_faq_dog_bloat_gdv() {
    return [
        ["What is bloat (GDV) in dogs?", "GDV — Gastric Dilatation-Volvulus — is when a dog's stomach fills with gas and then twists on itself, cutting off blood flow. It is a true medical emergency that can be fatal within hours without emergency surgery. It is not something to monitor at home."],
        ["What are the emergency signs of GDV I need to recognize immediately?", "A distended or hard belly, restlessness, and unproductive retching — trying to vomit with nothing coming up — together are the classic GDV presentation. Collapse or pale/white gums are also emergency signs and may mean the dog is already in shock. Any of these means go to an emergency vet immediately — do not wait."],
        ["Which dogs are most at risk for bloat?", "Deep-chested large and giant breeds — Great Danes, Standard Poodles, German Shepherds, and similar body types — carry elevated risk. Eating one large meal quickly rather than smaller frequent meals, vigorous exercise right before or after eating, and a family or breed history of GDV are all well-studied risk factors."],
        ["Do elevated food bowls prevent bloat?", "This has historically been suggested, but current veterinary understanding of their actual effect on GDV risk is mixed and unclear — it isn't settled science, so it shouldn't be relied on as a proven prevention step on its own."],
        ["Is there a surgery that can prevent bloat before it happens?", "Yes — a preventive gastropexy, which surgically tacks the stomach in place, is something some vets recommend for high-risk breeds. It's often performed during another procedure, like a spay or neuter, to avoid a separate anesthesia event."],
    ];
}

function pz_what_is_dog_bloat_gdv() {
    ob_start(); ?>
    <p>The Dog Bloat (GDV) Guide covers Gastric Dilatation-Volvulus, a true life-threatening emergency where the stomach fills with gas and twists on itself, cutting off blood flow. It can be fatal within hours without emergency surgery — this guide is built to help you recognize the emergency signs instantly and act on them without hesitation, plus understand the real, evidence-based prevention factors for dogs not currently showing symptoms.</p>
    <p><strong>If your dog is showing the classic triad right now — a distended, hard belly, restlessness, and unproductive retching — or has collapsed or has pale/white gums, stop reading and get to an emergency vet immediately.</strong> There is no home remedy and no safe waiting period for GDV.</p>
    <p>Select your dog's current symptoms above for guidance, then scroll down for prevention detail and the FAQ covering the bloat/GDV questions dog owners ask most.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_bloat_gdv() {
    ob_start(); ?>
    <p>GDV moves from first sign to life-threatening within hours — knowing the emergency signs cold, and acting on them instantly, is what actually saves lives with this condition:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">⏱️</span>
        <div>
          <strong>Hours, Not Days, Matter</strong>
          <p>GDV can be fatal within hours without emergency surgery — there is no safe window to "wait and see" if the signs are there.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🚨</span>
        <div>
          <strong>The Classic Triad Is Specific and Recognizable</strong>
          <p>A distended, hard belly, restlessness, and unproductive retching together are specific enough to act on immediately, not just watch.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🐕</span>
        <div>
          <strong>Deep-Chested Breeds Carry Real, Documented Risk</strong>
          <p>Great Danes, Standard Poodles, German Shepherds, and similar body types are known to be at elevated risk — worth knowing in advance.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🩺</span>
        <div>
          <strong>Preventive Gastropexy Is a Real Option for High-Risk Dogs</strong>
          <p>Surgically tacking the stomach in place, often during a spay/neuter, is something worth discussing with your vet for high-risk breeds.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_bloat_gdv() {
    return [
        ['title'=>'Know the Emergency Signs Before You Ever Need Them', 'desc'=>"A distended, hard belly, restlessness, and unproductive retching together are the classic GDV presentation — memorize this triad now."],
        ['title'=>'Recognize Collapse or Pale Gums as the Same Emergency', 'desc'=>"These may mean your dog is already in shock — the same immediate action applies: go to an emergency vet right now."],
        ['title'=>'Act Immediately — Do Not Wait or Try Home Remedies', 'desc'=>"GDV can be fatal within hours without emergency surgery. There is no safe waiting period and no home treatment."],
        ['title'=>'Know Your Deep-Chested Breed Risk', 'desc'=>"Great Danes, Standard Poodles, German Shepherds, and similar deep-chested breeds carry documented elevated risk."],
        ['title'=>'Apply Feeding and Exercise Prevention Habits', 'desc'=>"Smaller, more frequent meals instead of one large fast meal, and avoiding vigorous exercise right before or after eating, are well-studied risk reducers."],
        ['title'=>'Discuss Preventive Gastropexy for High-Risk Breeds', 'desc'=>"Some vets recommend this stomach-tacking surgery for high-risk dogs, often performed alongside a spay/neuter."],
    ];
}

function pz_tips_dog_bloat_gdv() {
    return [
        ['Memorize the Emergency Triad Now', "A distended, hard belly, restlessness, and unproductive retching together mean go to an emergency vet immediately — knowing this cold before it happens saves critical time."],
        ['Feed Smaller, More Frequent Meals', "One large meal eaten quickly is a well-studied risk factor — smaller, more frequent meals are a genuinely useful prevention habit."],
        ['Avoid Vigorous Exercise Right Before or After Eating', "Give your dog time to settle before and after meals rather than vigorous exercise immediately around feeding time."],
        ['Ask About Preventive Gastropexy for High-Risk Breeds', "If your dog is a deep-chested large or giant breed, ask your vet about a preventive gastropexy — often done during a spay/neuter to avoid a separate procedure."],
        ["Don't Rely on Elevated Bowls as Proven Prevention", "Current veterinary understanding of elevated feeding bowls' actual effect on GDV risk is mixed and unclear — don't treat it as a settled prevention step."],
    ];
}

function pz_mistakes_dog_bloat_gdv() {
    return [
        ['❌ Waiting "A Few Hours to See" With Emergency Signs Present', "GDV can be fatal within hours without surgery — waiting to see if a distended belly, restlessness, and unproductive retching resolve on their own can cost a dog's life."],
        ['❌ Trying Home Remedies for Suspected Bloat', "There is no home remedy for GDV — inducing burping, walking it off, or waiting are not treatments, and none of them address the underlying twisted stomach."],
        ["❌ Assuming Only Great Danes Get Bloat", "Any deep-chested large or giant breed — Standard Poodles, German Shepherds, and similar body types included — carries elevated risk, not just one breed."],
        ['❌ Feeding One Large Meal Quickly', "This is a well-studied risk factor — smaller, more frequent meals are safer than one large fast meal, especially in at-risk breeds."],
        ["❌ Treating Elevated Bowls as Guaranteed Prevention", "Current veterinary understanding of elevated bowls' actual effect on GDV risk is mixed — relying on them alone while ignoring feeding pattern and exercise timing is a mistake."],
    ];
}

function pz_render_guide_dog_bloat_gdv( $tool ) {
    $icon = $tool['icon'] ?? '🚨';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Dog Bloat (GDV) Guide</div>
          <div class="pz-int-sublabel">Signs, prevention &amp; emergency · Free · Instant</div>
        </div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--blue">🚨 Emergency-Aware</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Symptoms Right Now</label>
          <select id="pz_bg_symptoms" class="pz-int-select">
            <option value="none">None — just learning prevention</option>
            <option value="classic">Distended/hard belly, restless, unproductive retching (trying to vomit, nothing comes up)</option>
            <option value="collapse">Collapse or pale/white gums</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenBloatGDV()">
        <span class="pz-int-btn-icon"><?php echo $icon; ?></span>
        Check My Dog's Bloat/GDV Risk
      </button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ══ Parvovirus in Dogs: Symptoms, Treatment & Prevention (dog_parvovirus) ══ */

function pz_hero_quickanswer_dog_parvovirus() { ?>
    <div class="pz-hero-quickanswer">
      <div class="pz-hero-quickanswer-label">⚡ Quick Answer</div>
      <p>Bloody diarrhea, severe lethargy, and not eating need an emergency vet visit now — this is especially urgent in puppies or partially vaccinated dogs, since parvovirus can be fatal within 48-72 hours without treatment. Vomiting, diarrhea, and lethargy in an unvaccinated or partially vaccinated dog also need urgent attention — a fecal ELISA snap test is quick and shouldn't be delayed. In fully vaccinated dogs, these symptoms are still worth a vet visit, but parvo itself is much less likely. Select your dog's vaccination status and symptoms above for guidance.</p>
    </div>
<?php }

function pz_hero_trust_dog_parvovirus() { ?>
      <span>💉 Vaccination-status aware</span>
      <span>🧫 Fast-test framing</span>
      <span>☣️ Contagion-conscious</span>
<?php }

function pz_methodology_heading_dog_parvovirus() { return "How This Parvovirus Guidance Is Built"; }

function pz_methodology_dog_parvovirus() { ?>
    <p style="color:#555;margin-bottom:20px">This guidance is built around two factors that both matter for parvovirus: vaccination status and current symptoms. Severe symptoms are always urgent, but the urgency compounds sharply in puppies and partially vaccinated dogs, where parvo is a much more likely cause. Fully vaccinated dogs with similar symptoms still need a vet visit, but with a much lower likelihood of parvo specifically — that context changes how you should respond.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">💉</div>
        <strong>Vaccination Status Changes the Odds</strong>
        <p>Full vaccination makes parvo much less likely; puppies and partially vaccinated dogs are at real, significant risk.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">⏱️</div>
        <strong>Speed Matters — 48 to 72 Hours</strong>
        <p>Parvovirus can be fatal within 48-72 hours without treatment, which is why severe symptoms call for immediate action, not a wait-and-see approach.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🧫</div>
        <strong>Testing Is Fast — No Reason to Delay</strong>
        <p>A fecal ELISA snap test for parvo is quick and should be done without delay once it's a real possibility.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">☣️</div>
        <strong>Highly Contagious and Environmentally Hardy</strong>
        <p>The virus can persist in the environment for months, which is why isolating a suspected case matters immediately, not just for treatment reasons.</p>
      </div>
    </div>
<?php }

function pz_faq_dog_parvovirus() {
    return [
        ["What are the symptoms of parvovirus in dogs?", "Vomiting, diarrhea (which can become bloody), lethargy, and loss of appetite are the main symptoms. Bloody diarrhea combined with severe lethargy and not eating is a medical emergency, especially in puppies or partially vaccinated dogs."],
        ["How urgent is parvovirus, really?", "Very — parvovirus can be fatal within 48-72 hours without treatment. It typically requires IV fluids and hospitalization. Any dog showing severe symptoms, especially an unvaccinated or partially vaccinated one, needs an emergency vet visit now, not a wait-and-see approach."],
        ["My dog is fully vaccinated but has vomiting and diarrhea — could it still be parvo?", "It's much less likely with full vaccination, but many illnesses cause similar symptoms, so a vet visit is still worthwhile to investigate the actual cause. This is a case for investigating calmly rather than panicking."],
        ["How is parvovirus tested and treated?", "A fecal ELISA snap test can confirm parvovirus quickly, right in a vet clinic. Treatment is largely supportive — IV fluids, anti-nausea medication, and hospitalization in most moderate-to-severe cases — since there's no drug that directly kills the virus itself."],
        ["How do I protect my puppy from parvovirus before they're fully vaccinated?", "Keep puppies away from dog parks, other dogs' waste, and high-traffic dog areas until their full vaccine series is complete. This is exactly why the puppy vaccine schedule timing matters so much — protection builds with each round of shots."],
    ];
}

function pz_what_is_dog_parvovirus() {
    ob_start(); ?>
    <p>The Parvovirus Guide helps you understand what your dog's vaccination status and current symptoms mean for their risk of this highly contagious, potentially fatal virus, and what to do next — from urgent testing and treatment to prevention for a puppy still completing their vaccine series.</p>
    <p>Parvovirus causes vomiting, diarrhea, lethargy, and loss of appetite, progressing to bloody diarrhea and severe lethargy in serious cases — it can be fatal within 48-72 hours without treatment, and it's highly contagious, with the virus able to persist in the environment for months. Vaccination status changes the odds significantly: fully vaccinated dogs are much less likely to have parvo even with similar symptoms, while puppies and partially vaccinated dogs face real, significant risk.</p>
    <p>Select your dog's vaccination status and symptoms above for guidance, then scroll down for detail and the FAQ covering the parvovirus questions dog owners ask most.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_parvovirus() {
    ob_start(); ?>
    <p>Parvovirus can move from first symptoms to critical within a couple of days — knowing your dog's real risk based on vaccination status changes how quickly you need to act:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">⏱️</span>
        <div>
          <strong>48-72 Hours Without Treatment Can Be Fatal</strong>
          <p>This is a genuinely fast-moving disease — severe symptoms need an emergency vet visit now, not a wait-and-see approach.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💉</span>
        <div>
          <strong>Vaccination Status Changes the Real Risk</strong>
          <p>Puppies and partially vaccinated dogs face significant risk; fully vaccinated dogs are much less likely to have parvo specifically.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🧫</span>
        <div>
          <strong>Testing Is Fast — Don't Wait to "See"</strong>
          <p>A fecal ELISA snap test gives a quick answer — there's no reason to delay testing once parvo is a real possibility.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">☣️</span>
        <div>
          <strong>It's Highly Contagious and Hardy in the Environment</strong>
          <p>The virus can persist for months in the environment, which is why isolating a suspected case immediately matters for other dogs too.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_parvovirus() {
    return [
        ['title'=>"Check Your Dog's Vaccination Status", 'desc'=>"Fully vaccinated, partial/unvaccinated, or a puppy still completing their series — this changes how likely parvo actually is."],
        ['title'=>'Assess Current Symptoms', 'desc'=>"None, vomiting/diarrhea/lethargy, or bloody diarrhea with severe lethargy and not eating — severity drives urgency."],
        ['title'=>'Act Immediately on Severe Symptoms', 'desc'=>"Bloody diarrhea, severe lethargy, and not eating need an emergency vet visit now — parvo can be fatal within 48-72 hours untreated."],
        ['title'=>'Isolate a Suspected Case From Other Dogs', 'desc'=>"Parvovirus is highly contagious and the virus can persist in the environment for months — isolate immediately, don't wait for test results."],
        ['title'=>'Get a Fecal ELISA Snap Test Without Delay', 'desc'=>"This is quick and should be done right away for moderate symptoms in puppies or partially vaccinated dogs — don't wait to see if it gets better."],
        ['title'=>'Protect Unvaccinated Puppies Proactively', 'desc'=>"Keep them away from dog parks, other dogs' waste, and high-traffic areas until their full vaccine series is complete."],
    ];
}

function pz_tips_dog_parvovirus() {
    return [
        ['Complete the Full Puppy Vaccine Series', "Puppies aren't fully protected until the complete series is done — this is exactly why the vaccine schedule timing matters so much."],
        ["Don't \"Wait to See\" With Severe Symptoms", "Bloody diarrhea, severe lethargy, and not eating need an emergency vet visit now — parvo can be fatal within 48-72 hours without treatment."],
        ['Get a Fecal ELISA Snap Test Early, Not Late', "This test is quick and gives a fast answer — there's no reason to delay it once parvo is a real possibility given symptoms and vaccination status."],
        ['Isolate a Suspected Case Immediately', "Parvovirus is highly contagious and the virus can persist in the environment for months — isolate from other dogs right away, before test results even come back."],
        ["Keep Unvaccinated Puppies Away From High-Traffic Dog Areas", "Dog parks, other dogs' waste, and high-traffic areas are real exposure risks until your puppy's vaccine series is complete."],
    ];
}

function pz_mistakes_dog_parvovirus() {
    return [
        ["❌ Waiting to \"See If It Gets Better\" With Vomiting and Diarrhea in an Unvaccinated Puppy", "Given how fast parvo can progress, a fecal ELISA snap test should be done without delay rather than waiting a day or two to see."],
        ["❌ Assuming a Fully Vaccinated Dog Can't Get Sick", "Vaccination makes parvo much less likely, but other illnesses can cause similar symptoms — a vet visit is still worthwhile to find the actual cause."],
        ["❌ Not Isolating a Suspected Case From Other Dogs", "Parvovirus is highly contagious and can persist in the environment for months — isolating immediately protects other dogs, not just your own."],
        ['❌ Letting an Unvaccinated Puppy Visit Dog Parks Too Early', "Puppies aren't protected until their full vaccine series is complete — high-traffic dog areas are real exposure risk before then."],
        ["❌ Underestimating How Fast Parvo Can Progress", "It can be fatal within 48-72 hours without treatment — severe symptoms need an emergency vet visit now, not a same-day-or-tomorrow plan."],
    ];
}

function pz_render_guide_dog_parvovirus( $tool ) {
    $icon = $tool['icon'] ?? '🦠';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Parvovirus in Dogs Guide</div>
          <div class="pz-int-sublabel">Symptoms, treatment &amp; prevention · Free · Instant</div>
        </div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--blue">🦠 Vaccination-Aware</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Vaccination Status</label>
          <select id="pz_pv_vax" class="pz-int-select">
            <option value="full">Fully vaccinated</option>
            <option value="partial">Partial or unvaccinated</option>
            <option value="puppy">Puppy, not yet fully vaccinated</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Symptoms</label>
          <select id="pz_pv_symptoms" class="pz-int-select">
            <option value="none">None — just learning</option>
            <option value="moderate">Vomiting, diarrhea, lethargy</option>
            <option value="severe">Bloody diarrhea, severe lethargy, not eating</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenParvovirus()">
        <span class="pz-int-btn-icon"><?php echo $icon; ?></span>
        Get My Parvovirus Guidance
      </button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ══ Dog Heartworm Prevention: Complete Guide (dog_heartworm_prevention) ══ */

function pz_hero_quickanswer_dog_heartworm_prevention() { ?>
    <div class="pz-hero-quickanswer">
      <div class="pz-hero-quickanswer-label">⚡ Quick Answer</div>
      <p>If your dog isn't currently on prevention and hasn't been tested recently, see a vet for a heartworm test before starting any preventive — testing first matters, since starting certain preventives in an already-infected dog can trigger a dangerous reaction. Inconsistent or seasonal-only dosing is riskier in warm climates, where mosquitoes (heartworm's transmission vector) may be active nearly year-round. If you're already on monthly prevention and tested negative within the past year, you're doing it right — keep the annual test going too, since no preventive is 100% effective. Select your current prevention, climate, and testing status above for guidance.</p>
    </div>
<?php }

function pz_hero_trust_dog_heartworm_prevention() { ?>
      <span>🦟 Climate-aware risk</span>
      <span>🧪 Test-before-treat safety</span>
      <span>💊 Consistency-focused</span>
<?php }

function pz_methodology_heading_dog_heartworm_prevention() { return "How This Heartworm Prevention Guidance Is Built"; }

function pz_methodology_dog_heartworm_prevention() { ?>
    <p style="color:#555;margin-bottom:20px">This guidance combines three factors: your dog's current prevention status, your regional climate, and recent testing. A dog not on any prevention and not recently tested needs testing first — a genuine safety matter, not just a formality, since starting certain preventives in an already-infected dog can cause a dangerous reaction. Warm, year-round climates raise the stakes on any gaps in consistent dosing, since mosquitoes may be active nearly all year there.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🧪</div>
        <strong>Test Before You Treat</strong>
        <p>Starting prevention in an already-infected dog can trigger a dangerous reaction — testing first is a real safety step, not a formality.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🌡️</div>
        <strong>Climate Changes the Real Risk Window</strong>
        <p>Mosquitoes — heartworm's transmission vector — may be active nearly year-round in warm climates, making gaps in dosing riskier there.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">📅</div>
        <strong>Consistency Beats Seasonal Dosing</strong>
        <p>True year-round, gap-free dosing is the standard recommendation over seasonal-only prevention, even in colder climates.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">⚠️</div>
        <strong>Treatment Is Far Harder Than Prevention</strong>
        <p>Heartworm treatment involves an arsenic-based injectable drug and months of strict crate rest — prevention is dramatically easier and safer.</p>
      </div>
    </div>
<?php }

function pz_faq_dog_heartworm_prevention() {
    return [
        ["Why does my dog need a heartworm test before starting prevention?", "Starting certain heartworm preventives in a dog that's already infected can cause a dangerous reaction. Testing first confirms your dog is heartworm-negative, so prevention can be started safely."],
        ["Does my dog need heartworm prevention in winter?", "In warm, year-round climates where mosquitoes stay active, yes — consistent, gap-free dosing matters just as much in winter. In seasonal climates with cold winters, risk drops in the coldest months, but most vets still recommend true year-round dosing for consistency and to avoid missed doses."],
        ["My dog is on monthly prevention — do I still need an annual test?", "Yes. No preventive is 100% effective, so an annual heartworm test confirms your dog is actually negative even while on prevention. It's a quick, worthwhile check, not a redundant step."],
        ["What does heartworm treatment actually involve if a dog gets infected?", "It's far more arduous than prevention — typically an arsenic-based injectable drug given in stages, plus months of strict crate rest and activity restriction, since exertion can be dangerous while worms are dying off. This is exactly why prevention is so strongly emphasized."],
        ["I've been inconsistent with prevention — what should I do?", "Get back on a true year-round schedule with no seasonal gaps, and get a heartworm test done, especially if you live in a warm climate where mosquitoes may have been active during the gap."],
    ];
}

function pz_what_is_dog_heartworm_prevention() {
    ob_start(); ?>
    <p>The Dog Heartworm Prevention Guide helps you understand what your current prevention habits, regional climate, and testing history mean for your dog's actual heartworm risk, and what to do next — whether that's getting tested before starting prevention, tightening up an inconsistent schedule, or simply confirming you're on the right track.</p>
    <p>Heartworm is transmitted by mosquito bites, so climate matters: warm, year-round climates keep mosquitoes active nearly all the time, while seasonal climates with cold winters see lower risk in the coldest months. Testing before starting prevention is a genuine safety step, not a formality — some preventives can cause a dangerous reaction in an already-infected dog. And once on prevention, an annual test remains worthwhile, since no preventive is 100% effective.</p>
    <p>Select your current prevention status, regional climate, and recent testing above for guidance, then scroll down for detail and the FAQ covering the heartworm prevention questions dog owners ask most.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_heartworm_prevention() {
    ob_start(); ?>
    <p>Heartworm prevention is one of the more consequential routine decisions in dog care — largely because treatment, if it's ever needed, is so much harder than prevention ever is:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🧪</span>
        <div>
          <strong>Testing First Is a Genuine Safety Step</strong>
          <p>Starting certain preventives in an already-infected dog can cause a dangerous reaction — testing first isn't just a formality.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🌡️</span>
        <div>
          <strong>Warm Climates Mean Near Year-Round Risk</strong>
          <p>Mosquitoes may stay active nearly all year in warm climates, making inconsistent or seasonal-only dosing genuinely riskier there.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">📅</span>
        <div>
          <strong>Annual Testing Still Matters on Prevention</strong>
          <p>No preventive is 100% effective — an annual test confirms your dog is actually negative, even while doing everything right.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💉</span>
        <div>
          <strong>Treatment Is Arduous — Prevention Is Not</strong>
          <p>An arsenic-based injectable drug and months of strict crate rest make treatment far harder on a dog than monthly prevention ever is.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_heartworm_prevention() {
    return [
        ['title'=>'Check Your Current Prevention Status', 'desc'=>"Monthly year-round, inconsistent/seasonal, or none at all — this determines your dog's real exposure window."],
        ['title'=>'Consider Your Regional Climate', 'desc'=>"Warm year-round climates keep mosquitoes active nearly all year; seasonal climates see lower risk in the coldest months."],
        ['title'=>'Get Tested Before Starting Any New Prevention', 'desc'=>"If not currently on prevention and not recently tested, get a heartworm test first — starting prevention in an infected dog can cause a dangerous reaction."],
        ['title'=>'Close Any Gaps in Dosing', 'desc'=>"Switch from inconsistent or seasonal-only to true year-round, gap-free monthly dosing, especially in warm climates."],
        ['title'=>'Keep Annual Testing Going Even While on Prevention', 'desc'=>"No preventive is 100% effective — an annual test confirms your dog is actually heartworm-negative."],
        ['title'=>'Understand Why Prevention Is Worth the Consistency', 'desc'=>"Heartworm treatment is arduous — an arsenic-based injectable and months of strict crate rest — far harder than any preventive routine."],
    ];
}

function pz_tips_dog_heartworm_prevention() {
    return [
        ['Test Before You Start Prevention', "Starting certain preventives in an already-infected dog can cause a dangerous reaction — always test first if your dog isn't currently protected."],
        ['Go Year-Round, Even in Cold Climates', "Most vets recommend true year-round dosing over seasonal-only prevention, even where winters are cold, to avoid missed doses and maintain consistency."],
        ["Don't Skip the Annual Test Just Because You're on Prevention", "No preventive is 100% effective — an annual heartworm test confirms your dog is actually negative, which matters even with perfect dosing."],
        ['Take Warm-Climate Risk Seriously', "Mosquitoes — heartworm's transmission vector — may be active nearly year-round in warm climates, so gaps in dosing carry more real risk there."],
        ['Remember Treatment Is Far Harder Than Prevention', "An arsenic-based injectable drug and months of strict crate rest make heartworm treatment dramatically more arduous than monthly prevention ever is."],
    ];
}

function pz_mistakes_dog_heartworm_prevention() {
    return [
        ['❌ Starting Prevention Without Testing First', "Starting certain preventives in an already-infected dog can trigger a dangerous reaction — testing first is a real safety step, not a formality."],
        ['❌ Treating Prevention as Seasonal in a Warm Climate', "Mosquitoes may be active nearly year-round in warm climates — seasonal-only dosing leaves real gaps in exposure windows there."],
        ["❌ Skipping the Annual Test While on Monthly Prevention", "No preventive is 100% effective — skipping the annual test means a rare breakthrough case could go undetected longer than it should."],
        ['❌ Assuming Cold Winters Mean No Prevention Needed', "Most vets recommend true year-round dosing even in seasonal climates, since missed seasonal restarts are a common source of gaps."],
        ["❌ Underestimating How Hard Heartworm Treatment Really Is", "An arsenic-based injectable drug and months of strict crate rest and activity restriction make treatment far more arduous, expensive, and hard on a dog than prevention ever is."],
    ];
}

function pz_render_guide_dog_heartworm_prevention( $tool ) {
    $icon = $tool['icon'] ?? '❤️';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Dog Heartworm Prevention Guide</div>
          <div class="pz-int-sublabel">Complete guide · Free · Instant</div>
        </div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--blue">❤️ Climate-Aware</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Current Prevention</label>
          <select id="pz_hw_current" class="pz-int-select">
            <option value="monthly">On monthly preventive, year-round</option>
            <option value="inconsistent">Inconsistent or seasonal only</option>
            <option value="none">Not currently on prevention</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Region Climate</label>
          <select id="pz_hw_climate" class="pz-int-select">
            <option value="warm">Warm year-round (mosquitoes active most/all of the year)</option>
            <option value="seasonal">Seasonal, with cold winters</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Tested Recently</label>
          <select id="pz_hw_tested" class="pz-int-select">
            <option value="yes">Yes, within the past year</option>
            <option value="no">No, not recently or never</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenHeartwormPrevention()">
        <span class="pz-int-btn-icon"><?php echo $icon; ?></span>
        Get My Heartworm Prevention Guidance
      </button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ══ Lyme Disease in Dogs: Ticks, Signs & Treatment (dog_lyme_disease) ══ */

function pz_hero_quickanswer_dog_lyme_disease() { ?>
    <div class="pz-hero-quickanswer">
      <div class="pz-hero-quickanswer-label">⚡ Quick Answer</div>
      <p>Shifting-leg lameness plus fever, lethargy, and swollen joints is the classically-recognized Lyme presentation in dogs — get a vet test (a 4Dx-style snap test checks for Lyme antibodies) rather than dismissing it as "just some limping," since it's treatable with antibiotics when caught, but untreated Lyme can rarely lead to kidney complications. Lameness that shifts between legs on its own is also suggestive and worth testing. If your dog has high tick exposure and isn't on prevention, start a tick preventive and add daily tick checks — ticks typically need 24-48 hours attached to transmit Lyme, so catching and removing them early is a genuinely effective extra layer. Select your dog's tick exposure, symptoms, and prevention status above for guidance.</p>
    </div>
<?php }

function pz_hero_trust_dog_lyme_disease() { ?>
      <span>🦟 Exposure-level aware</span>
      <span>🦵 Shifting-lameness specific</span>
      <span>🧪 Testable &amp; treatable framing</span>
<?php }

function pz_methodology_heading_dog_lyme_disease() { return "How This Lyme Disease Guidance Is Built"; }

function pz_methodology_dog_lyme_disease() { ?>
    <p style="color:#555;margin-bottom:20px">This guidance combines tick exposure level, current symptoms, and prevention status. Shifting-leg lameness — lameness that moves between different legs rather than staying in one — is a classically-recognized Lyme sign on its own, and becomes higher priority when paired with fever, lethargy, and swollen joints. Dogs with no symptoms but high tick exposure and no prevention get concrete, evidence-based prevention steps instead, including the actual attachment-time window that makes daily tick checks effective.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🦵</div>
        <strong>Shifting-Leg Lameness Is a Named Sign</strong>
        <p>Lameness that moves between different legs is a classically-recognized Lyme presentation, specific enough to test for rather than just watch.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">⏱️</div>
        <strong>The 24-48 Hour Attachment Window Is Real</strong>
        <p>Ticks typically need roughly 24-48 hours attached to transmit Lyme — daily tick checks in that window are a genuinely effective prevention layer.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🧪</div>
        <strong>Testing Is Simple and Treatment Works</strong>
        <p>A 4Dx-style snap test checks for Lyme antibodies, and the disease is treatable with antibiotics when caught — reassurance backed by a clear path.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">💉</div>
        <strong>A Vaccine Exists for High-Exposure Dogs</strong>
        <p>Worth discussing with your vet specifically for dogs with high exposure in Lyme-endemic regions, alongside tick preventives.</p>
      </div>
    </div>
<?php }

function pz_faq_dog_lyme_disease() {
    return [
        ["What are the signs of Lyme disease in dogs?", "Lameness that shifts between different legs is a classically-recognized sign. When it's paired with fever, lethargy, and swollen joints, that combination is even more strongly indicative of Lyme disease and worth testing for right away."],
        ["Is Lyme disease serious for dogs?", "It's treatable with antibiotics when caught, which is reassuring — but untreated Lyme can rarely lead to kidney complications, so it shouldn't be dismissed as \"just some limping.\" Getting tested rather than waiting is the safer approach."],
        ["How long does a tick need to be attached to transmit Lyme?", "Roughly 24-48 hours in most cases. This is why daily tick checks after any outdoor time in high-exposure areas are a genuinely effective additional layer of prevention, not just a nice-to-have — catching and removing a tick within that window can prevent transmission."],
        ["Is there a Lyme disease vaccine for dogs?", "Yes, a Lyme vaccine exists and is worth discussing with your vet, especially for dogs with high tick exposure in Lyme-endemic regions. It's typically used alongside, not instead of, a tick preventive."],
        ["My dog has lameness that moves between legs but seems otherwise fine — should I worry?", "It's still worth getting tested rather than waiting to see if more symptoms appear. Shifting-leg lameness on its own is suggestive enough of Lyme disease to check with a vet, using a quick antibody snap test."],
    ];
}

function pz_what_is_dog_lyme_disease() {
    ob_start(); ?>
    <p>The Lyme Disease Guide helps you understand what your dog's tick exposure level, current symptoms, and prevention status mean for their Lyme disease risk, and what to do next — from getting a quick antibody test to closing the gaps in your tick prevention routine.</p>
    <p>Lyme disease is transmitted through tick bites, and shifting-leg lameness — lameness that moves between different legs — is a classically-recognized sign, especially when paired with fever, lethargy, and swollen joints. It's treatable with antibiotics when caught with a simple 4Dx-style antibody snap test, though untreated cases can rarely lead to kidney complications. Ticks typically need roughly 24-48 hours attached to transmit the disease, which is exactly why daily tick checks are a genuinely effective prevention layer for dogs with high outdoor exposure.</p>
    <p>Select your dog's tick exposure, symptoms, and current prevention status above for guidance, then scroll down for detail and the FAQ covering the Lyme disease questions dog owners ask most.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_lyme_disease() {
    ob_start(); ?>
    <p>Recognizing Lyme's classic sign and understanding the real transmission window changes both how quickly you test and how effectively you prevent it:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🦵</span>
        <div>
          <strong>Shifting-Leg Lameness Is Specific Enough to Act On</strong>
          <p>This classically-recognized pattern is distinct enough to warrant testing rather than a "let's watch it" approach.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⏱️</span>
        <div>
          <strong>The 24-48 Hour Window Makes Tick Checks Effective</strong>
          <p>Since ticks typically need that long attached to transmit Lyme, daily checks after outdoor time genuinely prevent transmission, not just reduce it slightly.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🧪</span>
        <div>
          <strong>Untreated Cases Can Rarely Affect the Kidneys</strong>
          <p>This is uncommon, but real — it's why Lyme shouldn't be dismissed as "just some limping" even though it's usually very treatable.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💉</span>
        <div>
          <strong>A Vaccine Adds a Layer for High-Exposure Dogs</strong>
          <p>Worth a specific conversation with your vet for dogs in Lyme-endemic regions with regular high tick exposure.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_lyme_disease() {
    return [
        ['title'=>"Assess Your Dog's Tick Exposure Level", 'desc'=>"High (wooded areas, tall grass, hiking), moderate, or low — this shapes how seriously to take prevention."],
        ['title'=>'Check for Symptoms', 'desc'=>"None, shifting-leg lameness alone, or shifting lameness plus fever, lethargy, and swollen joints — each level calls for a different response."],
        ['title'=>'Get Tested If Symptoms Are Present', 'desc'=>"A 4Dx-style snap test checks for Lyme antibodies quickly — don't wait to see if more symptoms appear."],
        ['title'=>'Start or Maintain Tick Prevention', 'desc'=>"A topical or oral tick preventive is the baseline for any dog with regular outdoor exposure."],
        ['title'=>'Do Daily Tick Checks After Outdoor Time', 'desc'=>"Ticks typically need roughly 24-48 hours attached to transmit Lyme — same-day removal is a genuinely effective extra layer."],
        ['title'=>'Ask Your Vet About the Lyme Vaccine If High-Exposure', 'desc'=>"Worth discussing specifically for dogs with high tick exposure in Lyme-endemic regions."],
    ];
}

function pz_tips_dog_lyme_disease() {
    return [
        ['Do Daily Tick Checks After Outdoor Time', "Ticks typically need roughly 24-48 hours attached to transmit Lyme — same-day removal after hiking, tall grass, or wooded areas is a genuinely effective extra layer of prevention."],
        ["Don't Dismiss Shifting-Leg Lameness", "Lameness that moves between different legs is a classically-recognized Lyme sign — it's worth testing rather than waiting to see if it resolves."],
        ['Ask About the Lyme Vaccine If Exposure Is High', "A Lyme vaccine exists and is worth discussing with your vet specifically for dogs with high tick exposure in Lyme-endemic regions."],
        ['Use a Tick Preventive as Your Baseline', "A topical or oral tick preventive should be the standard for any dog with regular outdoor time in wooded areas, tall grass, or on hikes."],
        ["Get Tested — Don't Assume It's \"Just Limping\"", "A quick 4Dx-style antibody snap test is worth doing when shifting lameness appears, since untreated Lyme can rarely lead to kidney complications."],
    ];
}

function pz_mistakes_dog_lyme_disease() {
    return [
        ['❌ Assuming Shifting Lameness Will "Just Go Away"', "This is a classically-recognized Lyme sign — testing rather than waiting is the safer approach, especially since it's very treatable when caught."],
        ["❌ Skipping Daily Tick Checks in High-Exposure Areas", "Since ticks typically need 24-48 hours attached to transmit Lyme, skipping same-day checks after hiking or wooded-area time removes a genuinely effective layer of prevention."],
        ['❌ Relying on Tick Prevention Alone Without Checks', "A tick preventive helps, but daily physical tick checks catch what prevention alone might miss — the two work best together."],
        ["❌ Dismissing Lyme as \"Just Some Limping\"", "Untreated Lyme can rarely lead to kidney complications — it's usually very treatable, but that's a reason to test and treat, not a reason to ignore it."],
        ['❌ Not Asking About the Lyme Vaccine for a High-Exposure Dog', "For dogs with regular high tick exposure in Lyme-endemic regions, the vaccine is a real additional layer worth a specific vet conversation."],
    ];
}

function pz_render_guide_dog_lyme_disease( $tool ) {
    $icon = $tool['icon'] ?? '🦟';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Lyme Disease in Dogs Guide</div>
          <div class="pz-int-sublabel">Ticks, signs &amp; treatment · Free · Instant</div>
        </div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--blue">🦟 Exposure-Aware</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Tick Exposure</label>
          <select id="pz_ld_exposure" class="pz-int-select">
            <option value="high">High — wooded areas, tall grass, hiking</option>
            <option value="moderate">Moderate — occasional outdoor time</option>
            <option value="low">Low — mostly urban/indoor</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Symptoms</label>
          <select id="pz_ld_symptoms" class="pz-int-select">
            <option value="none">None — just learning</option>
            <option value="shifting">Lameness that shifts between different legs</option>
            <option value="severe">Shifting lameness plus fever, lethargy, and swollen joints</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Current Prevention</label>
          <select id="pz_ld_prevention" class="pz-int-select">
            <option value="yes">On tick prevention</option>
            <option value="no">Not currently on tick prevention</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenLymeDisease()">
        <span class="pz-int-btn-icon"><?php echo $icon; ?></span>
        Get My Lyme Disease Guidance
      </button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}

/* ══ Cushing's Disease in Dogs: Symptoms & Management (dog_cushing_disease) ══ */

function pz_hero_quickanswer_dog_cushing_disease() { ?>
    <div class="pz-hero-quickanswer">
      <div class="pz-hero-quickanswer-label">⚡ Quick Answer</div>
      <p>Cushing's disease (hyperadrenocorticism) most commonly develops in middle-aged to senior dogs. Multiple signs together — especially in a typical-onset-age dog — are worth a vet visit for proper testing, which involves more than a routine blood panel (typically an ACTH stimulation test or low-dose dexamethasone suppression test). It's manageable with daily medication (commonly trilostane) once diagnosed, though it needs careful ongoing vet monitoring. Increased thirst, urination, and appetite alone is a common early sign, but it's also seen in diabetes and kidney disease, so it needs a proper workup rather than assuming. A pot-bellied appearance with thinning hair or skin changes is more classic and often later-stage — worth a vet visit on its own. Select your dog's symptoms and age above for guidance.</p>
    </div>
<?php }

function pz_hero_trust_dog_cushing_disease() { ?>
      <span>🏥 Age-pattern aware</span>
      <span>🧪 Proper-testing framing</span>
      <span>💊 Manageable-condition focus</span>
<?php }

function pz_methodology_heading_dog_cushing_disease() { return "How This Cushing's Disease Guidance Is Built"; }

function pz_methodology_dog_cushing_disease() { ?>
    <p style="color:#555;margin-bottom:20px">Cushing's disease (hyperadrenocorticism) most commonly develops in middle-aged to senior dogs — a real epidemiological pattern woven throughout this guidance alongside symptoms noticed. Multiple signs together in a typical-onset-age dog point most strongly toward proper testing, while single early signs are treated more cautiously, since they overlap with other conditions like diabetes and kidney disease.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">📅</div>
        <strong>Middle-Aged to Senior Is the Typical Onset</strong>
        <p>This is the age range Cushing's most commonly develops in — relevant context even for a single sign.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🧩</div>
        <strong>Early Signs Overlap With Other Conditions</strong>
        <p>Increased thirst, urination, and appetite are also seen in diabetes and kidney disease — a proper workup distinguishes them, not assumption.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🧪</div>
        <strong>Testing Goes Beyond Routine Bloodwork</strong>
        <p>An ACTH stimulation test or low-dose dexamethasone suppression test is typically needed — more involved than a standard blood panel.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">💊</div>
        <strong>Manageable With Careful Ongoing Monitoring</strong>
        <p>Daily medication, commonly trilostane, manages Cushing's well once diagnosed, though it needs consistent vet-guided monitoring.</p>
      </div>
    </div>
<?php }

function pz_faq_dog_cushing_disease() {
    return [
        ["What is Cushing's disease in dogs?", "Cushing's disease, medically called hyperadrenocorticism, happens when the body produces too much cortisol. It most commonly develops in middle-aged to senior dogs and causes a recognizable set of signs, from increased thirst and appetite to more classic physical changes like a pot-bellied appearance."],
        ["What are the early signs of Cushing's disease?", "Increased thirst, urination, and appetite are common early signs. On their own, though, they're also seen in diabetes and kidney disease, so a proper vet workup is needed to tell them apart rather than assuming it's Cushing's specifically."],
        ["What does testing for Cushing's disease actually involve?", "More than a routine blood panel — typically an ACTH stimulation test or a low-dose dexamethasone suppression test, both performed by a vet. These are the standard ways to confirm a Cushing's diagnosis."],
        ["Is Cushing's disease treatable?", "Yes — it's manageable with daily medication, commonly trilostane, once properly diagnosed. It does need careful, ongoing vet monitoring to keep dosing right, but most dogs do well on treatment."],
        ["My dog has a pot-bellied appearance and thinning hair — is that Cushing's?", "These are more classic, often later-stage physical signs of Cushing's disease, and worth a vet visit. Your vet will confirm with proper testing rather than diagnosing from appearance alone."],
    ];
}

function pz_what_is_dog_cushing_disease() {
    ob_start(); ?>
    <p>The Cushing's Disease Guide helps you understand what your dog's symptoms and age mean for their likelihood of having this hormonal condition, and what proper testing and management actually look like once it's suspected.</p>
    <p>Cushing's disease (hyperadrenocorticism) most commonly develops in middle-aged to senior dogs. Increased thirst, urination, and appetite are common early signs, though they overlap with diabetes and kidney disease, so they need a proper workup rather than an assumption. A pot-bellied appearance, thinning hair, and skin changes are more classic, often later-stage physical signs. Multiple signs together, especially in a typical-onset-age dog, point most strongly toward getting tested — which involves more than routine bloodwork, typically an ACTH stimulation test or low-dose dexamethasone suppression test. The good news: it's manageable with daily medication, commonly trilostane, once diagnosed, though it needs careful ongoing vet monitoring.</p>
    <p>Select your dog's symptoms and age above for guidance, then scroll down for detail and the FAQ covering the Cushing's disease questions dog owners ask most.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dog_cushing_disease() {
    ob_start(); ?>
    <p>Recognizing Cushing's typical onset age and its overlapping early signs means getting the right test done instead of guessing or dismissing symptoms:</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">📅</span>
        <div>
          <strong>Age Pattern Matters</strong>
          <p>Cushing's most commonly develops in middle-aged to senior dogs — useful context for weighing any single sign.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🧩</span>
        <div>
          <strong>Early Signs Look Like Other Conditions</strong>
          <p>Increased thirst, urination, and appetite also point to diabetes and kidney disease — a proper workup tells them apart.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🧪</span>
        <div>
          <strong>Confirming It Takes More Than Routine Bloodwork</strong>
          <p>An ACTH stimulation test or low-dose dexamethasone suppression test is the real path to a diagnosis, not a standard panel.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💊</span>
        <div>
          <strong>It's Manageable Once Diagnosed</strong>
          <p>Daily medication, commonly trilostane, controls Cushing's well with careful, consistent vet monitoring.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dog_cushing_disease() {
    return [
        ['title'=>"Note Your Dog's Age", 'desc'=>"Middle-aged or senior is the typical onset range for Cushing's disease; young dogs can develop it too, but it's less typical."],
        ['title'=>'Check Current Symptoms', 'desc'=>"None, increased thirst/urination/appetite, pot-bellied appearance and coat changes, or multiple signs together — each calls for a different response."],
        ['title'=>'Rule Out Overlapping Conditions for Early Signs', 'desc'=>"Increased thirst, urination, and appetite alone also point to diabetes and kidney disease — a proper vet workup distinguishes them."],
        ['title'=>'See a Vet for Proper Testing If Indicated', 'desc'=>"An ACTH stimulation test or low-dose dexamethasone suppression test — more involved than routine bloodwork — confirms the diagnosis."],
        ['title'=>'Review Your Personalized Guidance', 'desc'=>"Read the recommendation matched to your dog's specific symptom and age combination."],
        ['title'=>'Start Daily Medication and Ongoing Monitoring If Diagnosed', 'desc'=>"Commonly trilostane — manageable long-term with careful, consistent vet-guided monitoring."],
    ];
}

function pz_tips_dog_cushing_disease() {
    return [
        ["Know the Typical Onset Age", "Cushing's disease most commonly develops in middle-aged to senior dogs — worth knowing as your dog ages, even before signs appear."],
        ["Don't Assume Increased Thirst Means Cushing's Specifically", "It's a common early sign, but diabetes and kidney disease cause the same thing — a proper vet workup is needed to tell them apart."],
        ['Take Physical Changes Seriously', "A pot-bellied appearance, thinning hair, and skin changes are more classic, often later-stage signs — worth a vet visit rather than waiting further."],
        ['Expect More Than a Routine Blood Panel for Diagnosis', "An ACTH stimulation test or low-dose dexamethasone suppression test is the actual path to confirming Cushing's — ask your vet about these specifically."],
        ['Expect a Manageable Path With Careful Monitoring', "Daily medication, commonly trilostane, controls Cushing's well once diagnosed, though it needs consistent vet-guided monitoring to keep dosing right."],
    ];
}

function pz_mistakes_dog_cushing_disease() {
    return [
        ["❌ Assuming Increased Thirst Is Just Normal Aging", "It's a common early sign of several conditions, including Cushing's, diabetes, and kidney disease — worth a proper vet workup rather than assuming any one of them, or none at all."],
        ['❌ Waiting for Physical Signs Before Testing', "Pot-bellied appearance and coat changes are more classic but often later-stage — earlier signs like increased thirst and appetite are worth investigating sooner."],
        ["❌ Expecting a Routine Blood Panel to Diagnose It", "Confirming Cushing's typically needs an ACTH stimulation test or low-dose dexamethasone suppression test — a standard panel alone usually isn't enough."],
        ["❌ Thinking Cushing's Is Untreatable", "It's actually manageable with daily medication, commonly trilostane, once properly diagnosed — most dogs do well with consistent monitoring."],
        ["❌ Skipping Ongoing Monitoring Once on Medication", "Cushing's treatment needs careful, ongoing vet monitoring to keep dosing right — it isn't a one-and-done prescription."],
    ];
}

function pz_render_guide_dog_cushing_disease( $tool ) {
    $icon = $tool['icon'] ?? '🏥';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Cushing's Disease in Dogs Guide</div>
          <div class="pz-int-sublabel">Symptoms &amp; management · Free · Instant</div>
        </div>
      </div>
      <div class="pz-int-badges"><span class="pz-int-badge pz-int-badge--green">✅ Vet Reviewed</span><span class="pz-int-badge pz-int-badge--blue">🏥 Age-Pattern Aware</span></div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Symptoms</label>
          <select id="pz_cd_symptoms" class="pz-int-select">
            <option value="none">None — just learning</option>
            <option value="early">Increased thirst, urination, and appetite</option>
            <option value="physical">Pot-bellied appearance, thinning hair, skin changes</option>
            <option value="multiple">Multiple signs together</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt">Age</label>
          <select id="pz_cd_age" class="pz-int-select">
            <option value="typical">Middle-aged or senior (typical onset)</option>
            <option value="atypical">Young (less typical for this condition)</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenCushingDisease()">
        <span class="pz-int-btn-icon"><?php echo $icon; ?></span>
        Get My Cushing's Disease Guidance
      </button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
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
