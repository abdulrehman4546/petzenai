<?php
/**
 * Template Name: 🗂️ Tool Category Listing
 * Shows all tools for a given category passed via ?cat=slug
 */
if ( ! defined('ABSPATH') ) exit;

require_once get_template_directory() . '/inc/tool-registry.php';
require_once get_template_directory() . '/inc/tool-images.php';

$cat_slug  = sanitize_key( get_query_var('pz_cat', $_GET['cat'] ?? '' ) );
$cats      = pz_get_tool_categories();
$all_tools = pz_get_all_tools();

$show_all  = empty($cat_slug) || ! isset($cats[$cat_slug]);
$cat_info  = $show_all ? null : $cats[$cat_slug];

$tools_in_cat = $show_all
    ? $all_tools
    : array_values( array_filter($all_tools, fn($t) => $t['cat'] === $cat_slug) );

$page_title = $show_all ? 'All 300 Pet Care Tools' : $cat_info['label'] . ' Tools';
$page_desc  = $show_all
    ? 'Browse all 300 free, vet-reviewed pet care tools — calculators, guides, checkers, and trackers for dogs, cats, birds, rabbits, fish, reptiles, and more.'
    : 'Free vet-reviewed ' . strtolower($cat_info['label']) . ' tools — calculators, guides, checkers, and trackers. 100% free, no sign-up needed.';

$type_icons  = ['calculator'=>'🔢','guide'=>'📖','checker'=>'✅','tracker'=>'📊'];
$type_labels = ['calculator'=>'Calculator','guide'=>'Guide','checker'=>'Checker','tracker'=>'Tracker'];
$cat_counts  = array_count_values( array_column($all_tools,'cat') );


get_header();
?>

<style>
/* ── Tool Category Page ── */
.pzc-hero{background:linear-gradient(135deg,#0D0D1A 0%,#1A1A35 100%);padding:80px 24px 60px;text-align:center;border-bottom:1px solid rgba(255,255,255,.08);position:relative;overflow:hidden}
.pzc-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 70% 60% at 50% 0%,rgba(255,107,26,.12),transparent);pointer-events:none}
.pzc-hero-icon{font-size:56px;margin-bottom:16px;display:block}
.pzc-hero h1{font-size:clamp(28px,5vw,48px);font-weight:900;color:#fff;margin-bottom:12px;line-height:1.15}
.pzc-hero h1 span{color:var(--orange,#FF6B1A)}
.pzc-hero p{font-size:16px;color:rgba(255,255,255,.65);max-width:620px;margin:0 auto 28px;line-height:1.7}
.pzc-hero-stats{display:flex;gap:32px;justify-content:center;flex-wrap:wrap}
.pzc-stat{text-align:center}
.pzc-stat strong{display:block;font-size:24px;font-weight:900;color:var(--orange,#FF6B1A)}
.pzc-stat span{font-size:12px;color:rgba(255,255,255,.5);text-transform:uppercase;letter-spacing:.05em}

.pzc-breadcrumb{background:#0D0D1A;border-bottom:1px solid rgba(255,255,255,.08);padding:12px 24px}
.pzc-breadcrumb ul{display:flex;gap:8px;list-style:none;max-width:1400px;margin:0 auto;flex-wrap:wrap;align-items:center;font-size:13px;color:rgba(255,255,255,.45)}
.pzc-breadcrumb a{color:rgba(255,255,255,.45);text-decoration:none}.pzc-breadcrumb a:hover{color:var(--orange,#FF6B1A)}
.pzc-breadcrumb li+li::before{content:'›';margin-right:8px}

.pzc-filter-wrap{background:#0D0D1A;padding:16px 24px;border-bottom:1px solid rgba(255,255,255,.08);position:sticky;top:0;z-index:50;backdrop-filter:blur(12px)}
.pzc-filter-inner{max-width:1400px;margin:0 auto;display:flex;gap:8px;flex-wrap:wrap;align-items:center}
.pzc-filter-label{font-size:11px;font-weight:700;color:rgba(255,255,255,.4);text-transform:uppercase;letter-spacing:.08em;margin-right:4px;flex-shrink:0}
.pzc-tab{display:inline-flex;align-items:center;gap:5px;padding:6px 12px;border-radius:50px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);color:rgba(255,255,255,.7);font-size:12px;font-weight:600;cursor:pointer;transition:all .2s;text-decoration:none;white-space:nowrap}
.pzc-tab:hover,.pzc-tab.active{background:var(--orange,#FF6B1A);border-color:var(--orange,#FF6B1A);color:#fff}
.pzc-tab-count{background:rgba(255,255,255,.2);border-radius:50px;padding:1px 6px;font-size:10px}

.pzc-main{max-width:1400px;margin:0 auto;padding:32px 24px 80px}
.pzc-top-bar{display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;flex-wrap:wrap;gap:12px}
.pzc-search{padding:9px 16px 9px 40px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:50px;color:#fff;font-size:14px;outline:none;transition:border-color .2s;min-width:260px;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='rgba(255,255,255,.4)' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:14px center}
.pzc-search:focus{border-color:var(--orange,#FF6B1A)}.pzc-search::placeholder{color:rgba(255,255,255,.3)}
.pzc-type-filter{display:flex;gap:8px;flex-wrap:wrap}
.pzc-type-btn{padding:6px 14px;border-radius:50px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);color:rgba(255,255,255,.6);font-size:12px;font-weight:600;cursor:pointer;transition:all .2s}
.pzc-type-btn.active,.pzc-type-btn:hover{background:rgba(255,107,26,.15);border-color:var(--orange,#FF6B1A);color:var(--orange,#FF6B1A)}
.pzc-count{font-size:13px;color:rgba(255,255,255,.45)}.pzc-count strong{color:#fff}

.pzc-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:20px;margin-top:24px}
.pzc-card{background:#13131F;border:1px solid rgba(255,255,255,.08);border-radius:16px;overflow:hidden;transition:all .25s;text-decoration:none;display:flex;flex-direction:column}
.pzc-card:hover{border-color:var(--orange,#FF6B1A);transform:translateY(-5px);box-shadow:0 16px 40px rgba(255,107,26,.2)}

/* Card visual area */
.pzc-card-visual{position:relative;height:140px;flex-shrink:0;overflow:hidden}
.pzc-card-visual img{width:100%;height:100%;object-fit:cover;transition:transform .4s}
.pzc-card:hover .pzc-card-visual img{transform:scale(1.08)}
.pzc-card-img-overlay{position:absolute;inset:0;background:linear-gradient(to bottom,rgba(0,0,0,.15) 0%,rgba(0,0,0,.72) 100%)}
.pzc-card-big-icon{position:absolute;bottom:10px;left:12px;font-size:32px;z-index:2;filter:drop-shadow(0 2px 6px rgba(0,0,0,.7));transition:transform .3s}
.pzc-card:hover .pzc-card-big-icon{transform:scale(1.2)}
.pzc-card-type-badge{position:absolute;top:10px;right:10px;display:inline-flex;align-items:center;gap:4px;font-size:9px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;padding:3px 9px;border-radius:50px;color:#fff;z-index:2}

/* Card body */
.pzc-card-top{padding:14px 16px 10px;flex:1}
.pzc-card-title{font-size:13px;font-weight:800;color:#fff;line-height:1.4;margin-bottom:6px}
.pzc-card-desc{font-size:11px;color:rgba(255,255,255,.5);line-height:1.6}
.pzc-card-bottom{padding:10px 16px;border-top:1px solid rgba(255,255,255,.06);display:flex;align-items:center;justify-content:space-between;background:rgba(255,255,255,.02)}
.pzc-card-kw{font-size:10px;color:rgba(255,255,255,.28);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;flex:1;margin-right:8px}
.pzc-card-arrow{color:var(--orange,#FF6B1A);font-size:15px;flex-shrink:0;transition:transform .2s}
.pzc-card:hover .pzc-card-arrow{transform:translateX(5px)}

/* Type buttons */
.pzc-type-btn{display:inline-flex;align-items:center;gap:5px;white-space:nowrap}

.pzc-back{display:inline-flex;align-items:center;gap:8px;padding:9px 18px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:50px;color:rgba(255,255,255,.7);font-size:13px;font-weight:600;text-decoration:none;transition:all .2s;margin-bottom:28px}
.pzc-back:hover{border-color:var(--orange,#FF6B1A);color:var(--orange,#FF6B1A)}
#pzc-no-results{display:none;text-align:center;padding:60px 24px;color:rgba(255,255,255,.4);font-size:15px;margin-top:24px}

@media(max-width:900px){.pzc-grid{grid-template-columns:repeat(auto-fill,minmax(240px,1fr))}}
@media(max-width:600px){
  .pzc-hero{padding:50px 16px 36px}.pzc-hero-stats{gap:20px}
  .pzc-grid{grid-template-columns:1fr 1fr;gap:12px}
  .pzc-main{padding:20px 16px 60px}
  .pzc-top-bar{flex-direction:column;align-items:flex-start}
  .pzc-search{width:100%}
}
@media(max-width:400px){.pzc-grid{grid-template-columns:1fr}}
</style>

<!-- ── Breadcrumb ── -->
<nav class="pzc-breadcrumb" aria-label="Breadcrumb">
  <ul>
    <li><a href="<?php echo home_url('/'); ?>">🏠 Home</a></li>
    <li><a href="<?php echo home_url('/tools/'); ?>">All Tools</a></li>
    <?php if ( ! $show_all && $cat_info ) : ?>
      <li><?php echo esc_html($cat_info['label']); ?></li>
    <?php endif; ?>
  </ul>
</nav>

<!-- ── Hero ── -->
<section class="pzc-hero">
  <?php if ( $show_all ) : ?>
    <span class="pzc-hero-icon">🐾</span>
    <h1>All <span>300</span> Free Pet Care Tools</h1>
    <p><?php echo esc_html($page_desc); ?></p>
    <div class="pzc-hero-stats">
      <div class="pzc-stat"><strong>300</strong><span>Free Tools</span></div>
      <div class="pzc-stat"><strong>15</strong><span>Categories</span></div>
      <div class="pzc-stat"><strong>50K+</strong><span>Users/Month</span></div>
      <div class="pzc-stat"><strong>100%</strong><span>Free</span></div>
    </div>
  <?php else : ?>
    <span class="pzc-hero-icon"><?php echo $cat_info['icon']; ?></span>
    <h1><?php echo esc_html($cat_info['label']); ?> <span>Tools</span></h1>
    <p><?php echo esc_html($page_desc); ?></p>
    <div class="pzc-hero-stats">
      <div class="pzc-stat"><strong><?php echo count($tools_in_cat); ?></strong><span>Free Tools</span></div>
      <div class="pzc-stat"><strong>Vet</strong><span>Reviewed</span></div>
      <div class="pzc-stat"><strong>100%</strong><span>Free</span></div>
      <div class="pzc-stat"><strong>0</strong><span>Sign-Up</span></div>
    </div>
  <?php endif; ?>
</section>

<!-- ── Category Filter Tabs ── -->
<div class="pzc-filter-wrap">
  <div class="pzc-filter-inner">
    <span class="pzc-filter-label">Category:</span>
    <a href="<?php echo home_url('/tools/'); ?>" class="pzc-tab <?php echo $show_all ? 'active' : ''; ?>">
      🐾 All <span class="pzc-tab-count">300</span>
    </a>
    <?php foreach($cats as $key => $c) :
      $count = $cat_counts[$key] ?? 0;
    ?>
    <a href="<?php echo esc_url(home_url('/tools/'.$key.'/'));  ?>"
       class="pzc-tab <?php echo ($cat_slug===$key) ? 'active' : ''; ?>">
      <?php echo $c['icon']; ?> <?php echo esc_html($c['label']); ?>
      <span class="pzc-tab-count"><?php echo $count; ?></span>
    </a>
    <?php endforeach; ?>
  </div>
</div>
  </div>
</div>

<!-- ── Main Content ── -->
<div class="pzc-main">

  <?php if ( ! $show_all ) : ?>
  <a href="<?php echo home_url('/tools/'); ?>" class="pzc-back">← Back to All Tools</a>
  <?php endif; ?>

  <div class="pzc-top-bar">
    <div>
      <input type="search" id="pzc-search" class="pzc-search"
             placeholder="Search tools by name or keyword…" autocomplete="off">
    </div>
    <div class="pzc-type-filter">
      <button class="pzc-type-btn active" data-type="all">All Types</button>
      <button class="pzc-type-btn" data-type="calculator"><span>🔢</span> Calculators</button>
      <button class="pzc-type-btn" data-type="guide"><span>📖</span> Guides</button>
      <button class="pzc-type-btn" data-type="checker"><span>✅</span> Checkers</button>
      <button class="pzc-type-btn" data-type="tracker"><span>📊</span> Trackers</button>
    </div>
    <div class="pzc-count">
      Showing <strong id="pzc-visible-count"><?php echo count($tools_in_cat); ?></strong> tools
    </div>
  </div>

  <div class="pzc-grid" id="pzc-grid">
    <?php
    // Multiple images per category — tools cycle through them so no two adjacent cards look the same
    $cat_img_pool = [
        'dog-grooming'  => ['photo-1587300003388-59208cc962cb','photo-1583511655857-d19b40a7a54e','photo-1601758125946-6ec2ef64daf8','photo-1543466835-00a7907e9de1','photo-1477884213360-7e9d7dcc1e48'],
        'dog-health'    => ['photo-1548199973-03cce0bbc87b','photo-1507146426996-ef05306b995a','photo-1584820927498-cfe5211fd8bf','photo-1543466835-00a7907e9de1','photo-1558929996-da64ba858215'],
        'dog-nutrition' => ['photo-1568640347023-a616a30bc3bd','photo-1587300003388-59208cc962cb','photo-1601758125946-6ec2ef64daf8','photo-1548199973-03cce0bbc87b','photo-1477884213360-7e9d7dcc1e48'],
        'dog-training'  => ['photo-1587300003388-59208cc962cb','photo-1477884213360-7e9d7dcc1e48','photo-1543466835-00a7907e9de1','photo-1601758125946-6ec2ef64daf8','photo-1507146426996-ef05306b995a'],
        'cat-grooming'  => ['photo-1514888286974-6c03e2ca1dba','photo-1573865526739-10659fec78a5','photo-1574144611937-0df059b5ef3e','photo-1561948955-570b270e7c36','photo-1533743983669-94fa5c4338ec'],
        'cat-health'    => ['photo-1573865526739-10659fec78a5','photo-1514888286974-6c03e2ca1dba','photo-1561948955-570b270e7c36','photo-1574144611937-0df059b5ef3e','photo-1533743983669-94fa5c4338ec'],
        'cat-nutrition' => ['photo-1574144611937-0df059b5ef3e','photo-1533743983669-94fa5c4338ec','photo-1573865526739-10659fec78a5','photo-1514888286974-6c03e2ca1dba','photo-1561948955-570b270e7c36'],
        'bird-care'     => ['photo-1552728089-57bdde30beb3','photo-1444464666168-49d633b86797','photo-1548767797-d8c844163c4a','photo-1452570053594-1b985d6ea890','photo-1522858547137-f1dcec554f55'],
        'rabbit-care'   => ['photo-1585110396000-c9ffd4e4b308','photo-1559214369-a6b1d7919865','photo-1516467508483-a7212febe31a','photo-1481349518771-20055b2a7b24','photo-1518796745738-41048802f99a'],
        'fish-aquarium' => ['photo-1524704654690-b56c05c78a00','photo-1535591273668-578e31182c4f','photo-1497206365907-f5e630693df0','photo-1557456170-0cf4f4d0d362','photo-1545816250-e12bedba4c0f'],
        'reptile-care'  => ['photo-1551189014-8398c7f2b09e','photo-1496713653228-f40f06068ec3','photo-1518020382113-a7e8fc38eac9','photo-1504450874802-0ba2bcd9b5ae','photo-1475776408506-9a5371e7a068'],
        'small-pets'    => ['photo-1425082661705-1834bfd09dca','photo-1548767797-d8c844163c4a','photo-1589927986089-35812388d1f4','photo-1497206365907-f5e630693df0','photo-1559214369-a6b1d7919865'],
        'general-pet'   => ['photo-1450778869180-41d0601e046e','photo-1587300003388-59208cc962cb','photo-1514888286974-6c03e2ca1dba','photo-1548199973-03cce0bbc87b','photo-1543466835-00a7907e9de1'],
        'pet-behavior'  => ['photo-1583511655857-d19b40a7a54e','photo-1573865526739-10659fec78a5','photo-1587300003388-59208cc962cb','photo-1514888286974-6c03e2ca1dba','photo-1548199973-03cce0bbc87b'],
        'pet-safety'    => ['photo-1584820927498-cfe5211fd8bf','photo-1450778869180-41d0601e046e','photo-1548199973-03cce0bbc87b','photo-1573865526739-10659fec78a5','photo-1507146426996-ef05306b995a'],
    ];
    ?>
    <?php foreach($tools_in_cat as $i => $t) :
      $type_icon  = $type_icons[$t['type']] ?? '🔧';
      $type_label = $type_labels[$t['type']] ?? ucfirst($t['type']);
      $animal_lbl = ucfirst($t['animal'] === 'all' ? 'All Pets' : $t['animal']);
      $type_colors = ['calculator'=>'#3B82F6','guide'=>'#10B981','checker'=>'#F59E0B','tracker'=>'#8B5CF6'];
      $type_color  = $type_colors[$t['type']] ?? '#FF6B1A';
      $pool  = $cat_img_pool[$t['cat']] ?? ['photo-1450778869180-41d0601e046e'];
      $photo = $pool[$i % count($pool)];
      $img   = 'https://images.unsplash.com/' . $photo . '?w=400&q=75&auto=format&fit=crop';
    ?>
    <a href="<?php echo esc_url(home_url('/tools/'.$t['slug'].'/')); ?>"
       class="pzc-card"
       data-type="<?php echo esc_attr($t['type']); ?>"
       data-title="<?php echo esc_attr(strtolower($t['title'])); ?>"
       data-kw="<?php echo esc_attr(strtolower($t['kw'])); ?>">
      <div class="pzc-card-visual">
        <img src="<?php echo esc_url($img); ?>"
             alt="<?php echo esc_attr($t['title']); ?>"
             loading="lazy" width="400" height="130">
        <div class="pzc-card-img-overlay"></div>
        <div class="pzc-card-big-icon"><?php echo $t['icon']; ?></div>
        <div class="pzc-card-type-badge" style="background:<?php echo $type_color; ?>">
          <?php echo $type_icon; ?> <?php echo $type_label; ?>
        </div>
      </div>
      <div class="pzc-card-top">
        <div class="pzc-card-title"><?php echo esc_html($t['title']); ?></div>
        <p class="pzc-card-desc"><?php echo esc_html("Free vet-reviewed {$animal_lbl} {$type_label}. Science-based, instant results."); ?></p>
      </div>
      <div class="pzc-card-bottom">
        <span class="pzc-card-kw"><?php echo esc_html($t['kw']); ?></span>
        <span class="pzc-card-arrow">→</span>
      </div>
    </a>
    <?php endforeach; ?>
    <?php unset($i); ?>
  </div>

  <div id="pzc-no-results">
    <span style="font-size:48px;display:block;margin-bottom:12px">🔍</span>
    No tools found. Try a different search or filter.
  </div>

</div>

<script>
(function(){
  var cards    = [].slice.call(document.querySelectorAll('.pzc-card'));
  var search   = document.getElementById('pzc-search');
  var typeBtns = [].slice.call(document.querySelectorAll('.pzc-type-btn'));
  var countEl  = document.getElementById('pzc-visible-count');
  var noRes    = document.getElementById('pzc-no-results');
  var activeType = 'all';

  function filter(){
    var q = search.value.toLowerCase().trim();
    var visible = 0;
    cards.forEach(function(c){
      var ok = (!q || c.dataset.title.indexOf(q)>-1 || c.dataset.kw.indexOf(q)>-1)
            && (activeType==='all' || c.dataset.type===activeType);
      c.style.display = ok ? '' : 'none';
      if(ok) visible++;
    });
    countEl.textContent = visible;
    noRes.style.display = visible===0 ? 'block' : 'none';
  }

  search.addEventListener('input', filter);
  typeBtns.forEach(function(btn){
    btn.addEventListener('click', function(){
      typeBtns.forEach(function(b){b.classList.remove('active');});
      btn.classList.add('active');
      activeType = btn.dataset.type;
      filter();
    });
  });
})();
</script>

<?php get_footer(); ?>
