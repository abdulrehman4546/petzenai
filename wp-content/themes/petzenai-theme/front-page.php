<?php get_header();

// — Helper: get customizer mod with fallback
function pz( $key, $fallback = '' ) {
    return esc_html( get_theme_mod( $key, $fallback ) );
}
function pz_url( $key, $fallback = '' ) {
    return esc_url( get_theme_mod( $key, $fallback ) );
}

$hero_img = pz_url( 'petzenai_hero_image' ) ?: 'https://images.unsplash.com/photo-1587300003388-59208cc962cb?w=700&q=80&auto=format&fit=crop';
$why_img  = pz_url( 'petzenai_why_image'  ) ?: 'https://images.unsplash.com/photo-1548199973-03cce0bbc87b?w=600&q=80&auto=format&fit=crop';
?>

<!-- ===================== HERO ===================== -->
<section class="hero" aria-label="Hero" itemscope itemtype="https://schema.org/WPHeader">

  <div class="hero-particles" aria-hidden="true">
    <?php
    $emojis = ['🐶','🐱','🐰','🐦','🐾','🦴','🐠','🐹','❤️','⭐','🌿','🎾'];
    for($i=0;$i<24;$i++){
      $e = $emojis[array_rand($emojis)];
      $l = rand(3,97); $dur = rand(14,32); $delay = rand(0,25);
      echo "<span class='particle' style='left:{$l}%;animation-duration:{$dur}s;animation-delay:-{$delay}s' aria-hidden='true'>{$e}</span>";
    } ?>
  </div>
  <div class="hero-glow hero-glow-1" aria-hidden="true"></div>
  <div class="hero-glow hero-glow-2" aria-hidden="true"></div>
  <div class="hero-glow hero-glow-3" aria-hidden="true"></div>

  <div class="hero-container">
    <div class="hero-text">
      <div class="hero-badge">
        <span class="badge-dot" aria-hidden="true"></span>
        <?php echo pz('petzenai_hero_badge','Trusted by 50,000+ Pet Owners Across America'); ?>
      </div>

      <h1 class="hero-title" itemprop="headline">
        <?php echo pz('petzenai_hero_title_1','Science-Based'); ?><br>
        <span class="hero-title-highlight"><?php echo pz('petzenai_hero_title_2','Pet Nutrition'); ?></span><br>
        <?php echo pz('petzenai_hero_title_3','Tools & Planners'); ?>
      </h1>

      <p class="hero-desc" itemprop="description">
        <?php echo esc_html( get_theme_mod('petzenai_hero_desc','Empower your pet\'s health with free, vet-formulated calculators, diet planners, and vaccination trackers — trusted by over 50,000 pet owners across the USA.') ); ?>
      </p>

      <div class="hero-btns">
        <a href="<?php echo pz_url('petzenai_hero_btn1_link') ?: home_url('/tools/'); ?>" class="btn-primary">
          <?php echo pz('petzenai_hero_btn1_text','Explore Tools'); ?> <span class="btn-arrow">→</span>
        </a>
        <a href="<?php echo pz_url('petzenai_hero_btn2_link') ?: home_url('/tools/pet-food-portion-calculator/'); ?>" class="btn-outline">
          <?php echo pz('petzenai_hero_btn2_text','🍽️ Food Calculator'); ?>
        </a>
      </div>

      <div class="hero-stats">
        <div class="hero-stat">
          <span class="hero-stat-num" data-count="<?php echo esc_attr(get_theme_mod('petzenai_hero_stat1_num','50000')); ?>">0</span>
          <span class="hero-stat-label"><?php echo pz('petzenai_hero_stat1_label','Pet Owners'); ?></span>
        </div>
        <div class="hero-stat-divider" aria-hidden="true"></div>
        <div class="hero-stat">
          <span class="hero-stat-num" data-count="<?php echo esc_attr(get_theme_mod('petzenai_hero_stat2_num','300')); ?>">0</span>
          <span class="hero-stat-label"><?php echo pz('petzenai_hero_stat2_label','Tools'); ?></span>
        </div>
        <div class="hero-stat-divider" aria-hidden="true"></div>
        <div class="hero-stat">
          <span class="hero-stat-num" data-count="<?php echo esc_attr(get_theme_mod('petzenai_hero_stat3_num','10000')); ?>">0</span>
          <span class="hero-stat-label"><?php echo pz('petzenai_hero_stat3_label','Pet Names'); ?></span>
        </div>
      </div>
    </div><!-- /hero-text -->

    <div class="hero-visual" aria-hidden="true">
      <div class="hero-img-frame">
        <div class="hero-img-ring hero-img-ring-1"></div>
        <div class="hero-img-ring hero-img-ring-2"></div>
        <div class="hero-img-blob"></div>
        <img src="<?php echo $hero_img; ?>"
             alt="Happy pet with PetZenAI nutrition tools"
             width="620" height="480" loading="eager" class="hero-img">
        <div class="hero-paw-trail" aria-hidden="true">
          <span>🐾</span><span>🐾</span><span>🐾</span>
        </div>
      </div>
      <div class="hero-float-card hero-float-card-1">
        <span class="float-card-icon">🍽️</span>
        <div>
          <div class="float-card-title">Perfect Portions</div>
          <div class="float-card-sub">Calculated instantly</div>
        </div>
      </div>
      <div class="hero-float-card hero-float-card-2">
        <span class="float-card-icon">✅</span>
        <div>
          <div class="float-card-title">Vaccines Tracked</div>
          <div class="float-card-sub">Never miss a shot</div>
        </div>
      </div>
      <div class="hero-float-card hero-float-card-3">
        <span class="float-card-icon">🏆</span>
        <div>
          <div class="float-card-title">Vet Approved</div>
          <div class="float-card-sub">Science-based</div>
        </div>
      </div>
    </div>
  </div><!-- /hero-container -->

  <div class="hero-scroll-hint" aria-label="Scroll down">
    <span></span><span></span><span></span>
  </div>
</section>

<!-- ===================== MARQUEE STRIP ===================== -->
<div class="marquee-strip" aria-hidden="true">
  <div class="marquee-track">
    <?php
    $items = ['🐶 Dog Nutrition','🐱 Cat Diet Plans','🐰 Rabbit Care','🐦 Bird Feeding','🐠 Fish Wellness','🐾 Science-Based','❤️ Trusted by 50K+','🧬 Vet-Formulated','🏥 Vet-Approved','🌟 100% Free','🐾 No Sign-Up','⚡ Instant Results'];
    $all = array_merge($items,$items,$items);
    foreach($all as $item) echo "<span class='marquee-item'>{$item}</span>";
    ?>
  </div>
</div>

<!-- ===================== TOOLS ===================== -->
<section class="section" id="tools" aria-label="Pet Care Tools">
  <div class="container">
    <div class="section-header" data-aos>
      <span class="section-tag"><?php echo pz('petzenai_tools_tag','Free Tools'); ?></span>
      <h2 class="section-title"><?php echo pz('petzenai_tools_title','6 Powerful Pet Care Tools'); ?> <span>Completely Free</span></h2>
      <p class="section-desc"><?php echo esc_html( get_theme_mod('petzenai_tools_desc','Everything your pet needs — built on veterinary science and evidence-based research.') ); ?></p>
    </div>
    <div class="tools-grid">
      <?php
      $tools = [
        ['🍽️','Pet Food Portion Calculator','Calculate the perfect daily food portions for dogs, cats, birds, rabbits and more based on weight & activity.','Try Calculator →','/tools/pet-food-portion-calculator/','food'],
        ['🎂','Pet Age Calculator','Convert your pet\'s age to human years with our breed-specific, science-backed formula.','Check Age →','/tools/pet-age-calculator/','age'],
        ['💉','Vaccination Schedule Tracker','Never miss a vaccine. Get a full immunization schedule tailored to your pet\'s age and type.','Track Vaccines →','/tools/pet-vaccination-schedule/','vaccine'],
        ['✨','AI Pet Name Generator','10,000+ unique AI-generated pet names filtered by gender, breed, and personality traits.','Get Names →','/tools/ai-pet-name-generator/','names'],
        ['🏃','Pet Exercise Calculator','Discover how much daily exercise your pet needs based on breed, age, weight, and health status.','Plan Exercise →','/tools/pet-exercise-calculator/','exercise'],
        ['❓','What Pet Should I Get?','Answer 10 quick questions and our AI recommends your perfect pet match.','Take Quiz →','/tools/what-pet-should-i-get/','quiz'],
      ];
      foreach($tools as $i => $t): ?>
      <article class="tool-card" data-aos data-aos-delay="<?php echo $i*80; ?>" itemscope itemtype="https://schema.org/SoftwareApplication" onclick="window.location='<?php echo home_url($t[4]); ?>'" style="cursor:pointer">
        <div class="tool-card-glow" aria-hidden="true"></div>
        <div class="tool-icon-wrap" aria-hidden="true">
          <span class="tool-icon"><?php echo $t[0]; ?></span>
        </div>
        <h3 class="tool-title" itemprop="name"><?php echo esc_html($t[1]); ?></h3>
        <p class="tool-desc" itemprop="description"><?php echo esc_html($t[2]); ?></p>
        <a href="<?php echo home_url($t[4]); ?>" class="tool-link" itemprop="url" aria-label="<?php echo esc_attr($t[1]); ?>" style="position:relative;z-index:2">
          <?php echo esc_html($t[3]); ?> <span class="tool-link-arrow">→</span>
        </a>
        <div class="tool-card-paw" aria-hidden="true">🐾</div>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ===================== TOOL CATEGORIES ===================== -->
<section class="section section-dark" id="categories" aria-label="Tool Categories">
  <div class="container">
    <div class="section-header" data-aos>
      <span class="section-tag">Browse by Category</span>
      <h2 class="section-title">300+ Tools Across <span>15 Categories</span></h2>
      <p class="section-desc">Find the perfect care guide for every pet — dogs, cats, birds, fish, reptiles and more.</p>
    </div>
    <?php
    require_once get_template_directory() . '/inc/tool-registry.php';
    $cats      = pz_get_tool_categories();
    $all_tools = pz_get_all_tools();
    $cat_counts = array_count_values( array_column($all_tools,'cat') );

    $cat_images = [
      'dog-grooming'  => 'https://images.unsplash.com/photo-1587300003388-59208cc962cb?w=400&q=80&auto=format&fit=crop',
      'dog-health'    => 'https://images.unsplash.com/photo-1548199973-03cce0bbc87b?w=400&q=80&auto=format&fit=crop',
      'dog-nutrition' => 'https://images.unsplash.com/photo-1601758228041-f3b2795255f1?w=400&q=80&auto=format&fit=crop',
      'dog-training'  => 'https://images.unsplash.com/photo-1587300003388-59208cc962cb?w=400&q=80&auto=format&fit=crop',
      'cat-grooming'  => 'https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?w=400&q=80&auto=format&fit=crop',
      'cat-health'    => 'https://images.unsplash.com/photo-1533743983669-94fa5c4338ec?w=400&q=80&auto=format&fit=crop',
      'cat-nutrition' => 'https://images.unsplash.com/photo-1574158622682-e40e69881006?w=400&q=80&auto=format&fit=crop',
      'bird-care'     => 'https://images.unsplash.com/photo-1552728089-57bdde30beb3?w=400&q=80&auto=format&fit=crop',
      'rabbit-care'   => 'https://images.unsplash.com/photo-1585110396000-c9ffd4e4b308?w=400&q=80&auto=format&fit=crop',
      'fish-aquarium' => 'https://images.unsplash.com/photo-1535591273668-578e31182c4f?w=400&q=80&auto=format&fit=crop',
      'reptile-care'  => 'https://images.unsplash.com/photo-1504450874802-0ba2bcd9b5ae?w=400&q=80&auto=format&fit=crop',
      'small-pets'    => 'https://images.unsplash.com/photo-1425082661705-1834bfd09dca?w=400&q=80&auto=format&fit=crop',
      'general-pet'   => 'https://images.unsplash.com/photo-1450778869180-41d0601e046e?w=400&q=80&auto=format&fit=crop',
      'pet-behavior'  => 'https://images.unsplash.com/photo-1587300003388-59208cc962cb?w=400&q=80&auto=format&fit=crop',
      'pet-safety'    => 'https://images.unsplash.com/photo-1548199973-03cce0bbc87b?w=400&q=80&auto=format&fit=crop',
    ];
    ?>
    <div class="pz-cat-section-grid">
      <?php foreach($cats as $key => $cat):
        $count    = $cat_counts[$key] ?? 0;
        $img      = $cat_images[$key] ?? 'https://images.unsplash.com/photo-1450778869180-41d0601e046e?w=400&q=80&auto=format&fit=crop';
        $cat_url  = home_url('/tools/' . $key . '/');
      ?>
      <a href="<?php echo esc_url($cat_url); ?>" class="pz-cat-card-hp" data-aos data-aos-delay="<?php echo (array_search($key,array_keys($cats))%5)*80; ?>" aria-label="<?php echo esc_attr($cat['label']); ?> tools">
        <div class="pz-cat-card-img">
          <img src="<?php echo esc_url($img); ?>"
               alt="<?php echo esc_attr($cat['label']); ?> — PetZenAI pet care tools"
               width="280" height="180" loading="lazy">
          <div class="pz-cat-card-overlay" aria-hidden="true"></div>
        </div>
        <div class="pz-cat-card-body">
          <span class="pz-cat-card-icon"><?php echo $cat['icon']; ?></span>
          <div>
            <div class="pz-cat-card-name"><?php echo esc_html($cat['label']); ?></div>
            <div class="pz-cat-card-count"><?php echo $count; ?> Free Tools</div>
          </div>
          <span class="pz-cat-card-arrow">→</span>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
    <div class="section-cta-wrap" data-aos style="margin-top:48px">
      <a href="<?php echo home_url('/tools/'); ?>" class="btn-primary">Browse All 300 Tools →</a>
    </div>
  </div>
</section>

<style>
.pz-cat-section-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:16px}
@media(max-width:1100px){.pz-cat-section-grid{grid-template-columns:repeat(4,1fr)}}
@media(max-width:800px){.pz-cat-section-grid{grid-template-columns:repeat(3,1fr)}}
@media(max-width:540px){.pz-cat-section-grid{grid-template-columns:repeat(2,1fr)}}
.pz-cat-card-hp{display:flex;flex-direction:column;border-radius:16px;overflow:hidden;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.08);transition:all .3s;text-decoration:none}
.pz-cat-card-hp:hover{transform:translateY(-6px);border-color:var(--orange);box-shadow:0 16px 40px rgba(255,107,26,0.2)}
.pz-cat-card-img{position:relative;height:130px;overflow:hidden;flex-shrink:0}
.pz-cat-card-img img{width:100%;height:100%;object-fit:cover;transition:transform .4s}
.pz-cat-card-hp:hover .pz-cat-card-img img{transform:scale(1.08)}
.pz-cat-card-overlay{position:absolute;inset:0;background:linear-gradient(to bottom,transparent 30%,rgba(0,0,0,.6))}
.pz-cat-card-body{display:flex;align-items:center;gap:10px;padding:12px 14px}
.pz-cat-card-icon{font-size:22px;flex-shrink:0}
.pz-cat-card-name{font-size:13px;font-weight:800;color:#fff;line-height:1.2}
.pz-cat-card-count{font-size:11px;color:var(--orange);font-weight:700;margin-top:2px}
.pz-cat-card-arrow{margin-left:auto;color:rgba(255,255,255,0.4);font-size:16px;transition:all .2s;flex-shrink:0}
.pz-cat-card-hp:hover .pz-cat-card-arrow{color:var(--orange);transform:translateX(4px)}
</style>

<!-- ===================== WHY PETZENAI ===================== -->
<section class="section section-alt" id="why" aria-label="Why Choose PetZenAI">
  <div class="container">
    <div class="why-grid">
      <div class="why-img-col" data-aos="fade-right">
        <div class="why-img-wrap">
          <img src="<?php echo $why_img; ?>"
               alt="Dogs playing — PetZenAI wellness"
               width="560" height="500" loading="lazy">
          <div class="why-img-overlay" aria-hidden="true"></div>
          <div class="why-badge-float">
            <?php echo esc_html( get_theme_mod('petzenai_why_badge','🏆 Vet-Approved Tools') ); ?>
          </div>
          <div class="why-paw-decor" aria-hidden="true">🐾🐾🐾</div>
        </div>
      </div>
      <div class="why-content-col" data-aos="fade-left">
        <span class="section-tag">Why PetZenAI</span>
        <h2 class="section-title why-title">
          <?php
          $why_t = get_theme_mod('petzenai_why_title','Your Pet Deserves Science, Not Guesswork');
          $parts = explode(',', $why_t, 2);
          echo esc_html($parts[0]);
          if(!empty($parts[1])) echo ',<br><span>' . esc_html(ltrim($parts[1])) . '</span>';
          ?>
        </h2>
        <div class="why-features">
          <?php
          $feats = [
            ['🔬', get_theme_mod('petzenai_why_feat1_title','Veterinary Science Backed'), get_theme_mod('petzenai_why_feat1_desc','All our tools are built on peer-reviewed nutritional research and veterinary guidelines.')],
            ['🤖', get_theme_mod('petzenai_why_feat2_title','Science-Based Accuracy'),    get_theme_mod('petzenai_why_feat2_desc','Our calculators adapt to your pet\'s breed, weight, age, and activity level for personalized, evidence-based recommendations.')],
            ['🆓', get_theme_mod('petzenai_why_feat3_title','100% Free Forever'),         get_theme_mod('petzenai_why_feat3_desc','No subscriptions, no hidden fees. Every tool on PetZenAI is completely free.')],
            ['⚡', get_theme_mod('petzenai_why_feat4_title','Instant Results'),           get_theme_mod('petzenai_why_feat4_desc','Get science-backed answers in seconds. No sign-up required.')],
          ];
          foreach($feats as $f): ?>
          <div class="why-feature-item">
            <div class="why-feature-icon" aria-hidden="true"><?php echo $f[0]; ?></div>
            <div class="why-feature-body">
              <h3 class="why-feature-title"><?php echo esc_html($f[1]); ?></h3>
              <p class="why-feature-desc"><?php echo esc_html($f[2]); ?></p>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===================== PETS WE COVER ===================== -->
<section class="section section-dark" id="pets" aria-label="Pets We Cover">
  <div class="container">
    <div class="section-header" data-aos>
      <span class="section-tag">All Pets Welcome</span>
      <h2 class="section-title">Tools For <span>Every Pet</span></h2>
      <p class="section-desc">From fluffy cats to singing birds — our tools are built for every companion you love.</p>
    </div>
    <div class="pets-grid">
      <?php
      $pets = [
        ['Dogs',     'https://images.unsplash.com/photo-1587300003388-59208cc962cb?w=400&q=80&auto=format&fit=crop',  '80+ Tools',  '/tools/dog-grooming/'],
        ['Cats',     'https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?w=400&q=80&auto=format&fit=crop',  '35+ Tools',  '/tools/cat-grooming/'],
        ['Birds',    'https://images.unsplash.com/photo-1552728089-57bdde30beb3?w=400&q=80&auto=format&fit=crop',     '15+ Tools',  '/tools/bird-care/'],
        ['Rabbits',  'https://images.unsplash.com/photo-1585110396000-c9ffd4e4b308?w=400&q=80&auto=format&fit=crop',  '12+ Tools',  '/tools/rabbit-care/'],
        ['Fish',     'https://images.unsplash.com/photo-1535591273668-578e31182c4f?w=400&q=80&auto=format&fit=crop',  '10+ Tools',  '/tools/fish-aquarium/'],
        ['Reptiles', 'https://images.unsplash.com/photo-1504450874802-0ba2bcd9b5ae?w=400&q=80&auto=format&fit=crop',  '10+ Tools',  '/tools/reptile-care/'],
      ];
      foreach($pets as $i => $p): ?>
      <article class="pet-card" data-aos data-aos-delay="<?php echo $i*80; ?>">
        <a href="<?php echo home_url($p[3]); ?>" class="pet-card-inner" aria-label="<?php echo esc_attr($p[0]); ?> tools">
          <div class="pet-card-img">
            <img src="<?php echo $p[1]; ?>"
                 alt="<?php echo esc_attr($p[0]); ?> — PetZenAI tools"
                 width="300" height="200" loading="lazy">
            <div class="pet-card-overlay" aria-hidden="true"></div>
          </div>
          <div class="pet-card-body">
            <h3 class="pet-card-name"><?php echo esc_html($p[0]); ?></h3>
            <p class="pet-card-tools"><?php echo esc_html($p[2]); ?></p>
            <span class="pet-card-cta">Explore →</span>
          </div>
        </a>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ===================== TRUSTED BY PET OWNERS ===================== -->
<section class="section" id="reviews" aria-label="Trusted By Pet Owners">
  <div class="container">
    <div class="section-header" data-aos>
      <span class="section-tag">By The Numbers</span>
      <h2 class="section-title">Trusted By <span>Pet Owners</span></h2>
      <p class="section-desc">Real numbers from a platform built on science, not guesswork.</p>
    </div>

    <div class="testimonials-grid">
      <?php
      $trust_stats = [
        ['🐾', '50,000+', 'Pet Owners Served', 'Families across America use PetZenAI tools every month for science-based pet care guidance.'],
        ['🛠️', '300+',    'Free Tools',         'Calculators, trackers, and guides covering nutrition, health, grooming, training, and more.'],
        ['🐶', '6',       'Pet Species Covered', 'Dogs, cats, birds, rabbits, fish, and reptiles — expert care tools for every companion.'],
        ['✅', '100%',    'Free, Always',        'No subscriptions, no hidden fees, no sign-up required. Every tool on PetZenAI is completely free.'],
      ];
      foreach($trust_stats as $i => $s): ?>
      <article class="testimonial-card" data-aos data-aos-delay="<?php echo $i*100; ?>" style="text-align:center;padding:36px 28px">
        <div class="t-card-top" style="justify-content:center;margin-bottom:12px">
          <div style="font-size:40px"><?php echo $s[0]; ?></div>
        </div>
        <div style="font-size:42px;font-weight:900;color:var(--orange);line-height:1;margin-bottom:6px"><?php echo esc_html($s[1]); ?></div>
        <div style="font-size:16px;font-weight:800;color:#0D0D0D;margin-bottom:10px"><?php echo esc_html($s[2]); ?></div>
        <p style="font-size:13px;color:#666;line-height:1.6;margin:0"><?php echo esc_html($s[3]); ?></p>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ===================== BLOG ===================== -->
<section class="section section-alt" id="blog" aria-label="Blog Posts">
  <div class="container">
    <div class="section-header" data-aos>
      <span class="section-tag">Pet Health Blog</span>
      <h2 class="section-title">Latest <span>Pet Care Tips</span></h2>
      <p class="section-desc">Expert-written articles on pet nutrition, health, and wellness — updated weekly.</p>
    </div>
    <div class="blog-grid">
      <?php
      $q = new WP_Query(['posts_per_page'=>3,'post_status'=>'publish','orderby'=>'date','order'=>'DESC']);
      $fallback_posts = [
        ['How Much Should I Feed My Cat? A Complete Calorie Guide','Everything you need about calculating daily calorie needs for cats of all breeds.','Cat Nutrition','https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?w=600&q=80&auto=format&fit=crop'],
        ['Dog Vaccination Schedule: Complete Vet-Recommended Guide','A complete guide to puppy and adult dog vaccination schedules with timing.','Dog Health','https://images.unsplash.com/photo-1587300003388-59208cc962cb?w=600&q=80&auto=format&fit=crop'],
        ['How Old Is My Cat in Human Years? The Real Calculation','Forget the old 7-year rule. Here\'s the science-backed formula for cat age.','Cat Care','https://images.unsplash.com/photo-1548199973-03cce0bbc87b?w=600&q=80&auto=format&fit=crop'],
      ];
      if($q->have_posts()):
        while($q->have_posts()): $q->the_post(); ?>
        <article class="blog-card" data-aos itemscope itemtype="https://schema.org/BlogPosting">
          <a href="<?php the_permalink(); ?>" class="blog-card-img-wrap" aria-label="<?php the_title_attribute(); ?>">
            <?php if(has_post_thumbnail()): ?>
              <?php the_post_thumbnail('petzenai-thumb',['itemprop'=>'image','loading'=>'lazy']); ?>
            <?php else: ?>
              <img src="https://images.unsplash.com/photo-1450778869180-41d0601e046e?w=600&q=80&auto=format&fit=crop" alt="<?php the_title_attribute(); ?>" loading="lazy" width="600" height="280">
            <?php endif; ?>
            <div class="blog-card-overlay" aria-hidden="true"></div>
          </a>
          <div class="blog-card-body">
            <?php $cats = get_the_category(); $cat_name = !empty($cats) ? esc_html($cats[0]->name) : 'Pet Care'; ?>
            <span class="blog-card-cat"><?php echo $cat_name; ?></span>
            <h3 class="blog-card-title" itemprop="headline"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <p class="blog-card-desc"><?php echo wp_trim_words(get_the_excerpt(),18); ?></p>
            <div class="blog-card-footer">
              <span class="blog-card-date" itemprop="datePublished">📅 <?php echo get_the_date('M j, Y'); ?></span>
              <a href="<?php the_permalink(); ?>" class="blog-read-more">Read More →</a>
            </div>
          </div>
        </article>
        <?php endwhile; wp_reset_postdata();
      else:
        foreach($fallback_posts as $i => $fp): ?>
        <article class="blog-card" data-aos data-aos-delay="<?php echo $i*80; ?>">
          <a href="<?php echo home_url('/blog/'); ?>" class="blog-card-img-wrap">
            <img src="<?php echo $fp[3]; ?>" alt="<?php echo esc_attr($fp[0]); ?>" loading="lazy" width="600" height="280">
            <div class="blog-card-overlay" aria-hidden="true"></div>
          </a>
          <div class="blog-card-body">
            <span class="blog-card-cat"><?php echo esc_html($fp[2]); ?></span>
            <h3 class="blog-card-title"><a href="<?php echo home_url('/blog/'); ?>"><?php echo esc_html($fp[0]); ?></a></h3>
            <p class="blog-card-desc"><?php echo esc_html($fp[1]); ?></p>
            <div class="blog-card-footer">
              <span class="blog-card-date">📅 <?php echo date('Y'); ?></span>
              <a href="<?php echo home_url('/blog/'); ?>" class="blog-read-more">Read More →</a>
            </div>
          </div>
        </article>
        <?php endforeach;
      endif; ?>
    </div>
    <div class="section-cta-wrap" data-aos>
      <a href="<?php echo home_url('/blog/'); ?>" class="btn-primary">View All Articles →</a>
    </div>
  </div>
</section>

<!-- ===================== CTA ===================== -->
<section class="cta-section" aria-label="Call to Action">
  <div class="cta-paw-bg" aria-hidden="true">🐾</div>
  <div class="cta-paw-bg cta-paw-bg-2" aria-hidden="true">🐾</div>
  <div class="container">
    <div class="cta-content" data-aos>
      <div class="cta-icon" aria-hidden="true">🐾</div>
      <h2 class="cta-title">
        <?php echo esc_html( get_theme_mod('petzenai_cta_title',"Your Pet's Health Starts Here 🐾") ); ?>
      </h2>
      <p class="cta-desc">
        <?php echo esc_html( get_theme_mod('petzenai_cta_desc',"Join 50,000+ pet owners using PetZenAI's free science-based tools.") ); ?>
      </p>
      <a href="<?php echo pz_url('petzenai_cta_btn_link') ?: home_url('/tools/'); ?>" class="btn-white">
        <?php echo pz('petzenai_cta_btn_text',"🚀 Get Started — It's Free"); ?>
      </a>
      <div class="cta-trust-badges">
        <span>✅ 100% Free</span>
        <span>✅ No Sign-Up</span>
        <span>✅ Vet-Approved</span>
        <span>✅ Science-Based</span>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
