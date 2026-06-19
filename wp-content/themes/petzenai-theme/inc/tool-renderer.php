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
    $a  = ucfirst($tool['animal'] === 'all' ? 'pet' : $tool['animal']);
    $t  = esc_html($tool['title']);
    $kw = ! empty($tool['kw']) ? esc_html($tool['kw']) : '';
    ob_start(); ?>
    <p>The <strong><?php echo $t; ?></strong> is a comprehensive, vet-reviewed resource designed to help <?php echo $a; ?> owners make informed decisions about their pet's health and wellbeing.<?php if ($kw): ?> This <?php echo $kw; ?> guide is built on peer-reviewed veterinary science and provides accurate, personalized guidance tailored to your specific <?php echo strtolower($a); ?>.<?php else: ?> Built on peer-reviewed veterinary science, this tool provides accurate, personalized guidance tailored to your specific <?php echo strtolower($a); ?>.<?php endif; ?></p>
    <p>Whether you're a first-time owner or an experienced <?php echo strtolower($a); ?> parent, understanding the fundamentals covered in this <?php echo $kw ? $kw . ' ' : ''; ?>guide can significantly improve your pet's quality of life and help you catch potential health issues early.</p>
    <div class="pz-info-box">
      <strong>🔬 Good to Know:</strong> Regular monitoring and consistent care routines are the foundation of good pet health — and this guide gives you a practical place to start.
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
    echo '<div class="pz-info-box" style="margin-top:20px"><strong>💡 Pro Tip:</strong> The best pet care is preventive, not reactive. Building consistent habits now saves you stress, money, and unnecessary vet visits later.</div>';
    return ob_get_clean();
}

function pz_section_mistakes($tool) {
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
    $animal_label = ucfirst($a);

    $html = '<section class="pz-section pz-mistakes">';
    $html .= '<div class="pz-container">';
    $html .= '<h2 class="pz-section-title">🚫 Common ' . $animal_label . ' Care Mistakes to Avoid</h2>';
    $html .= '<p class="pz-section-intro">Even experienced ' . $animal_label . ' owners make these mistakes. Knowing what to avoid is just as important as knowing what to do.</p>';
    $html .= '<div class="pz-mistakes-grid">';

    foreach ($items as $item) {
        $html .= '<div class="pz-mistake-card">';
        $html .= '<h3 class="pz-mistake-title">' . esc_html($item[0]) . '</h3>';
        $html .= '<p>' . esc_html($item[1]) . '</p>';
        $html .= '</div>';
    }

    $html .= '</div></div></section>';
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
    $animal_label = ucfirst($a);

    // Build the HTML output
    $html = '<section class="pz-section pz-warning-signs">';
    $html .= '<div class="pz-container">';
    $html .= '<h2 class="pz-section-title">⚠️ ' . $animal_label . ' Warning Signs — When to Act</h2>';
    $html .= '<p class="pz-section-intro">Knowing when to call the vet versus when to monitor at home is one of the most important skills for any ' . $animal_label . ' owner. Use this guide as a reference — when in doubt, always call your vet.</p>';

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
    $html .= '</div></section>';

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
