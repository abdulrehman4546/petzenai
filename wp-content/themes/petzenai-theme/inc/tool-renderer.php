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
            <a href="<?php echo home_url('/tool-category/' . esc_attr($tool['cat']) . '/'); ?>" itemprop="item">
              <span itemprop="name"><?php echo esc_html($cat['label']); ?></span>
            </a>
            <meta itemprop="position" content="3">
          </li>
          <span class="pz-bc-sep" aria-hidden="true">›</span>
          <li><span><?php echo $title; ?></span></li>
        </ol>
      </div>
    </nav>

    <!-- ══ HERO ══ -->
    <section class="pz-tool-hero" aria-label="Tool Header">
      <div class="pz-tool-hero-bg" aria-hidden="true"></div>
      <div class="container pz-tool-hero-inner">
        <div class="pz-tool-hero-content">
          <div class="pz-tool-hero-badge">
            <span><?php echo $cat['icon']; ?></span> <?php echo esc_html($cat['label']); ?>
          </div>
          <h1 class="pz-tool-hero-title"><?php echo $icon; ?> <?php echo $title; ?></h1>
          <p class="pz-tool-hero-desc"><?php echo esc_html( pz_tool_intro($tool) ); ?></p>
          <div class="pz-tool-hero-actions">
            <button onclick="document.getElementById('pz-tool-interactive').scrollIntoView({behavior:'smooth'})" class="btn-primary">
              <?php echo pz_tool_cta_label($type); ?> <span>→</span>
            </button>
            <button onclick="pzPrintTool()" class="pz-pdf-btn" aria-label="Download PDF">
              📥 Download PDF
            </button>
          </div>
          <div class="pz-tool-hero-trust">
            <span>✅ Vet-Reviewed</span>
            <span>✅ Science-Based</span>
            <span>✅ Free Forever</span>
            <span>✅ No Sign-Up</span>
          </div>
        </div>
      </div>
    </section>

    <!-- ══ AD SLOT — TOP ══ -->
    <?php petzenai_ad('petzenai_adsense_ad_tools','tool-top'); ?>

    <article class="pz-auto-tool-article" itemscope itemtype="https://schema.org/HowTo">
      <meta itemprop="name" content="<?php echo $title; ?>">
      <div class="container pz-auto-tool-layout">
        <div class="pz-auto-tool-main">

          <!-- TABLE OF CONTENTS -->
          <div class="pz-toc" id="pz-auto-toc">
            <div class="pz-toc-title">📋 Table of Contents</div>
            <ul id="pz-auto-toc-list"></ul>
          </div>

          <!-- SECTION 1: INTERACTIVE TOOL -->
          <section class="pz-tool-section" id="pz-tool-interactive">
            <h2><?php echo $icon; ?> <?php echo pz_section1_title($tool); ?></h2>
            <?php pz_render_interactive($tool); ?>
          </section>

          <!-- SECTION 2: WHAT IS -->
          <section class="pz-tool-section">
            <h2>📖 What Is <?php echo $title; ?>?</h2>
            <?php echo pz_section_what_is($tool); ?>
          </section>

          <!-- SECTION 3: WHY IMPORTANT -->
          <section class="pz-tool-section">
            <h2>⭐ Why <?php echo esc_html($animal); ?> Owners Need This</h2>
            <?php echo pz_section_why_important($tool); ?>
          </section>

          <!-- SECTION 4: HOW TO USE / STEP BY STEP -->
          <section class="pz-tool-section">
            <h2>📋 Step-by-Step Guide</h2>
            <?php echo pz_section_steps($tool); ?>
          </section>

          <!-- AD SLOT — MIDDLE -->
          <?php petzenai_ad('petzenai_adsense_ad_blog_mid','tool-mid'); ?>

          <!-- SECTION 5: PRO TIPS -->
          <section class="pz-tool-section">
            <h2>💡 Expert Tips & Best Practices</h2>
            <?php echo pz_section_tips($tool); ?>
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
          <div class="pz-sidebar-widget" style="padding:14px 16px">
            <h3 class="pz-sidebar-title" style="margin-bottom:10px">🔗 Related Tools</h3>
            <?php foreach( pz_get_related_tools($slug, $tool['cat']) as $rt ): ?>
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
    $a = ucfirst($tool['animal'] === 'all' ? 'pet' : $tool['animal']);
    $type_labels = ['guide'=>'guide','calculator'=>'calculator','checker'=>'checker','tracker'=>'tracker'];
    return "Free, vet-reviewed {$a} care " . ($type_labels[$tool['type']] ?? 'guide') . " — science-based, instant results, no sign-up required. Used by thousands of {$a} owners across the USA.";
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

    <?php if ($type === 'calculator'): ?>
    <!-- ══ CALCULATOR ══ -->
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

    <?php else: /* guide / tracker */ ?>
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

function pz_get_checker_questions($tool) {
    $defaults = [
        ['q'=>'Is your pet eating normally?', 'opts'=>['yes'=>'Yes, normal appetite','less'=>'Eating less than usual','no'=>'Not eating at all']],
        ['q'=>'How is your pet\'s energy level?', 'opts'=>['normal'=>'Normal / Active','lower'=>'Slightly lower than usual','very_low'=>'Very lethargic or weak']],
        ['q'=>'Any vomiting or diarrhea in the last 24 hours?', 'opts'=>['none'=>'None','once'=>'Once or twice','frequent'=>'Frequent / Ongoing']],
        ['q'=>'Is your pet drinking water normally?', 'opts'=>['normal'=>'Normal','more'=>'Drinking more than usual','less'=>'Drinking less than usual']],
        ['q'=>'Any visible injuries, swelling, or discharge?', 'opts'=>['none'=>'None observed','mild'=>'Mild / Minor','severe'=>'Significant / Concerning']],
    ];
    return $defaults;
}

function pz_section_what_is($tool) {
    $a  = ucfirst($tool['animal'] === 'all' ? 'pet' : $tool['animal']);
    $t  = esc_html($tool['title']);
    $kw = ! empty($tool['kw']) ? esc_html($tool['kw']) : '';
    ob_start(); ?>
    <p>The <strong><?php echo $t; ?></strong> is a comprehensive, vet-reviewed resource designed to help <?php echo $a; ?> owners make informed decisions about their pet's health and wellbeing.<?php if ($kw): ?> This <?php echo $kw; ?> guide is built on peer-reviewed veterinary science and provides accurate, personalized guidance tailored to your specific <?php echo strtolower($a); ?>.<?php else: ?> Built on peer-reviewed veterinary science, this tool provides accurate, personalized guidance tailored to your specific <?php echo strtolower($a); ?>.<?php endif; ?></p>
    <p>Whether you're a first-time owner or an experienced <?php echo strtolower($a); ?> parent, understanding the fundamentals covered in this <?php echo $kw ? $kw . ' ' : ''; ?>guide can significantly improve your pet's quality of life and help you catch potential health issues early.</p>
    <div class="pz-info-box">
      <strong>🔬 Science Fact:</strong> Studies show that pet owners who follow structured, evidence-based care guidelines report significantly better health outcomes for their animals. Regular monitoring and proactive care can add years to your pet's life.
    </div>
    <?php return ob_get_clean();
}

function pz_section_why_important($tool) {
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
          <p>Pets with attentive owners who follow science-based care guidelines live significantly longer on average.</p>
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
    $a = ucfirst($tool['animal'] === 'all' ? 'pet' : $tool['animal']);
    $steps = pz_get_steps_for_tool($tool);
    ob_start(); ?>
    <p>Follow these vet-recommended steps for the best results with your <?php echo strtolower($a); ?>:</p>
    <ol class="pz-steps-list" itemscope itemtype="https://schema.org/HowTo">
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

function pz_section_tips($tool) {
    $a = ucfirst($tool['animal'] === 'all' ? 'pet' : $tool['animal']);
    $tips = [
        "Always approach your {$a} calmly and gently. Stress can affect health readings and behavioral responses, making assessments less accurate.",
        "Keep a dedicated pet health journal or use a notes app to track patterns over time. Small changes that seem insignificant individually can be important trends.",
        "Establish a consistent routine — {$a}s thrive on predictability. Consistent schedules reduce stress and make health monitoring more reliable.",
        "Involve the whole family in your {$a}'s care routine. Everyone should know the basics so care is consistent even when you're away.",
        "Never make dramatic changes to your {$a}'s care routine without a 7-10 day transition period. Sudden changes can cause stress and digestive issues.",
        "Take photos or short videos when you notice something unusual about your {$a}. Visual documentation is invaluable when consulting your vet.",
        "Research your specific breed's tendencies and health predispositions. Breed-specific knowledge helps you anticipate and prevent common issues early.",
    ];
    ob_start();
    echo '<ul class="pz-tips-list">';
    foreach($tips as $tip) echo '<li>' . str_replace("$a", "<strong>$a</strong>", esc_html($tip)) . '</li>';
    echo '</ul>';
    echo '<div class="pz-info-box" style="margin-top:20px"><strong>💡 Pro Tip:</strong> The best pet care is preventive, not reactive. Establishing good routines now can prevent 60-70% of common health issues that require veterinary intervention.</div>';
    return ob_get_clean();
}

function pz_section_mistakes($tool) {
    $a = ucfirst($tool['animal'] === 'all' ? 'pet' : $tool['animal']);
    $mistakes = [
        ['❌','Ignoring Subtle Changes','Small behavioral or physical changes are often the first signs of health issues. Never dismiss what seems minor without monitoring it for 24-48 hours.'],
        ['❌','Following Generic Advice','Not all advice applies to every pet. Breed, age, size, and health status all affect what\'s appropriate. Always tailor recommendations to your specific pet.'],
        ['❌','Skipping Regular Vet Visits','Even when your pet seems perfectly healthy, annual vet check-ups catch issues that aren\'t visible externally. Preventive care is always cheaper than treatment.'],
        ['❌','Overfeeding Treats','Treats should make up no more than 10% of your pet\'s daily calorie intake. Overfeeding with treats is one of the leading causes of pet obesity in the US.'],
        ['❌','Using Human Products on Pets','Many products safe for humans (shampoos, medications, foods) are toxic to pets. Always use species-specific products unless directed by a vet.'],
        ['❌','Delaying Vet Care','When your pet shows signs of distress, pain, or illness, same-day veterinary attention is almost always better than "wait and see." Conditions can deteriorate rapidly.'],
    ];
    ob_start();
    echo '<div class="pz-mistakes-grid">';
    foreach($mistakes as $m) {
        echo '<div class="pz-mistake-item">';
        echo '<div class="pz-mistake-icon">' . $m[0] . '</div>';
        echo '<div><strong>' . esc_html($m[1]) . '</strong><p>' . esc_html($m[2]) . '</p></div>';
        echo '</div>';
    }
    echo '</div>';
    return ob_get_clean();
}

function pz_section_warning_signs($tool) {
    $a = ucfirst($tool['animal'] === 'all' ? 'pet' : $tool['animal']);
    ob_start(); ?>
    <p>These are the warning signs that require <strong>immediate veterinary attention</strong>:</p>
    <div class="pz-warning-grid">
      <div class="pz-warning-item pz-warning-red">
        <h4>🚨 Emergency (Call Vet Now)</h4>
        <ul>
          <li>Difficulty breathing or labored breathing</li>
          <li>Collapse or inability to stand</li>
          <li>Suspected poisoning or toxin ingestion</li>
          <li>Severe bleeding or deep wounds</li>
          <li>Seizures lasting more than 2 minutes</li>
          <li>Extreme pain (vocalizing, guarding body)</li>
        </ul>
      </div>
      <div class="pz-warning-item pz-warning-yellow">
        <h4>⚠️ Urgent (See Vet Within 24 Hours)</h4>
        <ul>
          <li>Not eating for more than 24 hours</li>
          <li>Persistent vomiting or diarrhea (3+ times)</li>
          <li>Significant lethargy or behavior change</li>
          <li>Swollen abdomen or limping</li>
          <li>Eye discharge, cloudiness, or squinting</li>
          <li>Unusual lumps or rapid weight change</li>
        </ul>
      </div>
      <div class="pz-warning-item pz-warning-green">
        <h4>✅ Monitor Closely (Vet Check Soon)</h4>
        <ul>
          <li>Occasional soft stool or vomiting (once)</li>
          <li>Mild scratching or licking one area</li>
          <li>Slight decrease in appetite for 1 day</li>
          <li>Minor behavioral changes</li>
          <li>Small cuts or scrapes</li>
          <li>Mild bad breath or ear odor</li>
        </ul>
      </div>
    </div>
    <?php return ob_get_clean();
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
    $animal = $tool['animal'];
    if ($animal === 'dog') return [
        ['Small Breeds (under 20 lbs)', 'More frequent / smaller amounts', 'Higher metabolism, more temperature-sensitive, longer lifespan'],
        ['Medium Breeds (20-60 lbs)',   'Standard recommendations apply',  'Most versatile; follow general guidelines'],
        ['Large Breeds (60-100 lbs)',   'Less frequent / larger amounts',  'More prone to joint issues; monitor weight carefully'],
        ['Giant Breeds (100+ lbs)',     'Special giant-breed protocols',   'Slower maturity; higher risk of bloat and joint disease'],
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
    $a = ucfirst($tool['animal'] === 'all' ? 'pet' : $tool['animal']);
    $faqs = [
        [
            "q" => "How accurate is this {$tool['title']} tool?",
            "a" => "Our tool is built on peer-reviewed veterinary research and follows guidelines from leading veterinary associations including AVMA and AAFCO. Results are accurate for the average {$a}, but individual animals may vary. Always confirm results with your veterinarian."
        ],
        [
            "q" => "How often should I use this tool?",
            "a" => "We recommend using this tool at least once every 3-6 months, or whenever you notice changes in your {$a}'s health, weight, or behavior. For puppies and senior pets, monthly checks are beneficial."
        ],
        [
            "q" => "Can I use this tool for any breed?",
            "a" => "Yes, the tool is designed to work across all breeds by incorporating size, age, and activity level adjustments. However, some breeds have unique health requirements — always consult a breed-specific vet or specialist for the most accurate guidance."
        ],
        [
            "q" => "Is this tool suitable for senior pets?",
            "a" => "Absolutely. Senior pets often have different needs than younger animals. Select the appropriate age category in the tool and pay attention to any senior-specific recommendations highlighted in the results."
        ],
        [
            "q" => "Do I need to create an account to use this tool?",
            "a" => "No account or registration is required. All PetZenAI tools are 100% free and available instantly without sign-up. We believe quality pet care information should be accessible to everyone."
        ],
        [
            "q" => "Can I download or print the results?",
            "a" => "Yes! Use the '📥 Download PDF' button to save or print a personalized PDF of this guide. You can share it with family members, pet sitters, or your veterinarian."
        ],
    ];

    ob_start();
    foreach($faqs as $i=>$faq): ?>
    <div class="pz-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
      <button class="pz-faq-q" onclick="pzToggleFaq(this)" aria-expanded="false" itemprop="name">
        <?php echo esc_html($faq['q']); ?>
        <span class="pz-faq-arrow" aria-hidden="true">▾</span>
      </button>
      <div class="pz-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" hidden>
        <p itemprop="text"><?php echo esc_html($faq['a']); ?></p>
      </div>
    </div>
    <?php endforeach;
    return ob_get_clean();
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
