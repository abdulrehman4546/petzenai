<?php
/**
 * Template Name: 🤖 Auto Tool Page
 * Template Post Type: page
 * Description: Dynamic tool page — auto-renders from tool registry by page slug.
 */
if ( ! defined('ABSPATH') ) exit;
require_once get_template_directory() . '/inc/tool-renderer.php';

get_header();

// Get tool data based on current page slug
global $post;
$slug = $post ? $post->post_name : '';
$tool = pz_get_tool_data( $slug );

if ( ! $tool ) {
    // Fallback if slug not in registry
    ?>
    <section class="section">
      <div class="container" style="text-align:center;padding:80px 0">
        <div style="font-size:64px;margin-bottom:20px">🐾</div>
        <h1>Tool Not Found</h1>
        <p style="color:#666;margin:16px 0">This tool page is not configured yet. Check back soon!</p>
        <a href="<?php echo home_url('/tools/'); ?>" class="btn-primary">← Back to All Tools</a>
      </div>
    </section>
    <?php
    get_footer();
    return;
}

// Render the full tool page
pz_render_tool_page( $tool );

get_footer();
?>

<style>
/* ══════════════════════════════════════════
   AUTO TOOL PAGE — STYLES
══════════════════════════════════════════ */

/* Hero */
.pz-tool-hero{background:linear-gradient(135deg,#1A1A2E 0%,#16213E 60%,#0F3460 100%);padding:120px 0 60px;position:relative;overflow:hidden}
.pz-tool-hero-bg{position:absolute;inset:0;background:radial-gradient(ellipse at 70% 50%,rgba(255,107,26,.12) 0%,transparent 70%);pointer-events:none}
.pz-tool-hero-inner{position:relative;z-index:1;max-width:800px}
.pz-tool-hero-badge{display:inline-flex;align-items:center;gap:8px;background:rgba(255,107,26,.15);border:1px solid rgba(255,107,26,.3);color:var(--orange);padding:6px 16px;border-radius:50px;font-size:13px;font-weight:700;margin-bottom:20px}
.pz-tool-hero-title{font-size:clamp(26px,4vw,44px);font-weight:900;color:#fff;line-height:1.15;margin-bottom:16px}
.pz-tool-hero-desc{font-size:16px;color:rgba(255,255,255,0.65);line-height:1.7;margin-bottom:28px;max-width:640px}
.pz-tool-hero-actions{display:flex;gap:14px;flex-wrap:wrap;margin-bottom:24px}
.pz-pdf-btn{display:inline-flex;align-items:center;gap:8px;padding:14px 24px;border:2px solid rgba(255,255,255,0.2);border-radius:50px;background:transparent;color:#fff;font-size:15px;font-weight:700;cursor:pointer;transition:all .2s}
.pz-pdf-btn:hover{border-color:var(--orange);color:var(--orange)}
.pz-tool-hero-trust{display:flex;flex-wrap:wrap;gap:12px}
.pz-tool-hero-trust span{font-size:13px;color:rgba(255,255,255,0.55);font-weight:600}

/* Layout */
.pz-auto-tool-article{padding:60px 0}
.pz-auto-tool-layout{display:grid;grid-template-columns:1fr 300px;gap:60px;align-items:start}
@media(max-width:960px){.pz-auto-tool-layout{grid-template-columns:1fr}}
.pz-auto-tool-main{min-width:0}
.pz-auto-tool-sidebar{position:sticky;top:100px}

/* Sections */
.pz-tool-section{margin-bottom:48px;padding-bottom:48px;border-bottom:2px solid #F5F5F5}
.pz-tool-section:last-child{border-bottom:none}
.pz-tool-section h2{font-size:24px;font-weight:900;color:#0D0D0D;margin-bottom:20px}

/* ══ Advanced Interactive Tool ══ */
.pz-int-wrap{border-radius:20px;overflow:hidden;border:1.5px solid #E8E8E8;box-shadow:0 4px 24px rgba(0,0,0,.06)}
.pz-int-header{display:flex;align-items:center;justify-content:space-between;padding:20px 24px;background:linear-gradient(135deg,#0D0D1A,#1A1A35);flex-wrap:wrap;gap:12px}
.pz-int-header-left{display:flex;align-items:center;gap:14px}
.pz-int-big-icon{font-size:44px;line-height:1}
.pz-int-label{font-size:16px;font-weight:800;color:#fff}
.pz-int-sublabel{font-size:12px;color:rgba(255,255,255,.5);margin-top:2px}
.pz-int-badges{display:flex;gap:8px;flex-wrap:wrap}
.pz-int-badge{font-size:11px;font-weight:700;padding:4px 10px;border-radius:50px}
.pz-int-badge--green{background:rgba(76,175,80,.2);color:#4CAF50;border:1px solid rgba(76,175,80,.3)}
.pz-int-badge--blue{background:rgba(59,130,246,.2);color:#60A5FA;border:1px solid rgba(59,130,246,.3)}
.pz-int-badge--orange{background:rgba(255,107,26,.2);color:#FF6B1A;border:1px solid rgba(255,107,26,.3)}
.pz-int-badge--purple{background:rgba(139,92,246,.2);color:#A78BFA;border:1px solid rgba(139,92,246,.3)}

.pz-int-body{padding:24px;background:#fff}
.pz-int-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px 20px;margin-bottom:24px}
@media(max-width:600px){.pz-int-grid{grid-template-columns:1fr}}

.pz-int-field{display:flex;flex-direction:column;gap:6px}
.pz-int-label-txt{font-size:12px;font-weight:700;color:#555;text-transform:uppercase;letter-spacing:.05em;display:flex;align-items:center;gap:8px}
.pz-int-optional{font-weight:400;text-transform:none;color:#aaa;font-size:11px}
.pz-int-input-wrap{position:relative;display:flex;align-items:center}
.pz-int-input{width:100%;padding:11px 14px;border:1.5px solid #E0E0E0;border-radius:10px;font-size:14px;color:#0D0D0D;outline:none;transition:border-color .2s;background:#FAFAFA}
.pz-int-input:focus{border-color:var(--orange);background:#fff}
.pz-int-input--prefix{padding-left:40px}
.pz-int-input-prefix{position:absolute;left:12px;font-size:18px;pointer-events:none}
.pz-int-input-suffix{position:absolute;right:12px;font-size:12px;font-weight:700;color:#999;pointer-events:none}
.pz-int-select{width:100%;padding:11px 14px;border:1.5px solid #E0E0E0;border-radius:10px;font-size:14px;color:#0D0D0D;outline:none;cursor:pointer;background:#FAFAFA;transition:border-color .2s}
.pz-int-select:focus{border-color:var(--orange)}

/* Unit toggle */
.pz-int-unit-toggle{display:inline-flex;gap:2px;margin-left:6px;background:#F0F0F0;border-radius:6px;padding:2px}
.pz-unit-btn{padding:2px 8px;border:none;border-radius:4px;font-size:11px;font-weight:700;cursor:pointer;color:#777;background:transparent;transition:all .15s}
.pz-unit-btn.active{background:#fff;color:#FF6B1A;box-shadow:0 1px 4px rgba(0,0,0,.1)}

/* Activity chips */
.pz-activity-chips{display:flex;gap:8px;flex-wrap:wrap}
.pz-chip{padding:7px 14px;border:1.5px solid #E0E0E0;border-radius:50px;font-size:12px;font-weight:700;cursor:pointer;background:#FAFAFA;color:#555;transition:all .2s}
.pz-chip.active,.pz-chip:hover{background:var(--orange);border-color:var(--orange);color:#fff}

/* Button */
.pz-int-btn{width:100%;padding:16px 24px;background:linear-gradient(135deg,#FF6B1A,#e55a0d);border:none;border-radius:12px;color:#fff;font-size:16px;font-weight:800;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:10px;transition:all .2s;margin-top:8px}
.pz-int-btn:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(255,107,26,.35)}
.pz-int-btn-icon{font-size:20px}

/* Checker step-by-step */
.pz-checker-progress-wrap{display:flex;align-items:center;gap:12px;margin-bottom:24px}
.pz-checker-progress-bar{flex:1;height:6px;background:#F0F0F0;border-radius:50px;overflow:hidden}
.pz-checker-progress-fill{height:100%;background:linear-gradient(90deg,#FF6B1A,#FFB347);border-radius:50px;transition:width .4s}
.pz-checker-progress-txt{font-size:12px;font-weight:700;color:#888;white-space:nowrap}
.pz-checker-step{display:none}.pz-checker-step.active{display:block}
.pz-checker-q-num{font-size:11px;font-weight:700;color:var(--orange);text-transform:uppercase;letter-spacing:.06em;margin-bottom:8px}
.pz-checker-q-text{font-size:16px;font-weight:800;color:#0D0D0D;margin-bottom:16px;line-height:1.4}
.pz-checker-cards{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:8px}
@media(max-width:500px){.pz-checker-cards{grid-template-columns:1fr}}
.pz-checker-card{display:flex;flex-direction:column;align-items:center;gap:8px;padding:14px 12px;border:2px solid #E8E8E8;border-radius:12px;cursor:pointer;transition:all .2s;text-align:center;background:#FAFAFA}
.pz-checker-card:hover{border-color:var(--orange);background:#FFF5F0}
.pz-checker-card input{display:none}
.pz-checker-card input:checked ~ .pz-checker-card-icon,.pz-checker-card:has(input:checked){border-color:var(--orange);background:rgba(255,107,26,.07)}
.pz-checker-card-icon{font-size:28px}
.pz-checker-card-txt{font-size:13px;font-weight:600;color:#333}

/* Results */
#pz-calc-result,#pz-checker-result,#pz-guide-result{margin-top:20px;border-radius:16px;overflow:hidden}
.pz-result-hero{padding:24px;text-align:center}
.pz-result-hero h3{font-size:20px;font-weight:900;margin-bottom:6px}
.pz-result-hero p{font-size:14px;opacity:.8;margin:0}
.pz-result-number{font-size:48px;font-weight:900;line-height:1;margin-bottom:4px}
.pz-result-unit{font-size:16px;opacity:.7}
.pz-result-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1px;background:#E8E8E8}
.pz-result-cell{padding:16px;background:#fff;text-align:center}
.pz-result-cell-label{font-size:11px;font-weight:700;color:#888;text-transform:uppercase;letter-spacing:.04em;margin-bottom:4px}
.pz-result-cell-val{font-size:17px;font-weight:800;color:#0D0D0D}
.pz-result-tips{padding:16px 20px;background:#FFFBF8;border-top:1px solid #F0E8E0}
.pz-result-tips h4{font-size:13px;font-weight:800;color:#0D0D0D;margin-bottom:10px;text-transform:uppercase;letter-spacing:.04em}
.pz-result-tips ul{margin:0;padding-left:18px}
.pz-result-tips ul li{font-size:13px;color:#555;margin-bottom:6px;line-height:1.5}
.pz-result-success{background:linear-gradient(135deg,#E8F5E9,#F1F8E9);border:2px solid #4CAF50}
.pz-result-warning{background:linear-gradient(135deg,#FFF8E1,#FFFDE7);border:2px solid #FF9800}
.pz-result-danger{background:linear-gradient(135deg,#FFEBEE,#FCE4EC);border:2px solid #F44336}

/* Info box */
.pz-info-box{background:rgba(255,107,26,.07);border-left:4px solid var(--orange);padding:16px 20px;border-radius:0 12px 12px 0;font-size:15px;color:#333;margin:20px 0}

/* Steps */
.pz-steps-list{list-style:none;padding:0;margin:0;counter-reset:steps}
.pz-steps-list li{display:flex;gap:20px;margin-bottom:24px;align-items:flex-start}
.pz-step-num{width:36px;height:36px;border-radius:50%;background:var(--orange);color:#fff;font-size:15px;font-weight:900;display:flex;align-items:center;justify-content:center;flex-shrink:0;counter-increment:steps}
.pz-step-body strong{font-size:16px;color:#0D0D0D;display:block;margin-bottom:4px}
.pz-step-body p{font-size:14px;color:#555;line-height:1.7;margin:0}

/* Tips */
.pz-tips-list{margin:0 0 0 4px;padding-left:20px}
.pz-tips-list li{margin-bottom:12px;font-size:15px;color:#333;line-height:1.7}

/* Mistakes */
.pz-mistakes-grid{display:flex;flex-direction:column;gap:16px}
.pz-mistake-item{display:flex;gap:16px;align-items:flex-start;padding:18px 20px;background:#FFF8F8;border-radius:14px;border:1px solid #FFE0E0}
.pz-mistake-icon{font-size:24px;flex-shrink:0}
.pz-mistake-item strong{font-size:15px;color:#0D0D0D;display:block;margin-bottom:4px}
.pz-mistake-item p{font-size:14px;color:#555;margin:0;line-height:1.6}

/* Why grid */
.pz-why-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-top:20px}
@media(max-width:600px){.pz-why-grid{grid-template-columns:1fr}}
.pz-why-item{display:flex;gap:14px;padding:20px;background:#F7F7F7;border-radius:14px}
.pz-why-icon{font-size:28px;flex-shrink:0}
.pz-why-item strong{font-size:15px;color:#0D0D0D;display:block;margin-bottom:4px}
.pz-why-item p{font-size:13px;color:#555;margin:0;line-height:1.6}

/* Warning grid */
.pz-warning-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-top:16px}
@media(max-width:800px){.pz-warning-grid{grid-template-columns:1fr}}
.pz-warning-item{border-radius:16px;padding:20px}
.pz-warning-red{background:#FFEBEE;border:1.5px solid #FFCDD2}
.pz-warning-yellow{background:#FFF8E1;border:1.5px solid #FFE082}
.pz-warning-green{background:#F1F8E9;border:1.5px solid #C5E1A5}
.pz-warning-item h4{font-size:14px;font-weight:800;margin-bottom:12px;color:#0D0D0D}
.pz-warning-item ul{margin:0 0 0 16px;padding:0}
.pz-warning-item li{font-size:13px;color:#333;margin-bottom:6px;line-height:1.5}

/* Breed table */
.pz-breed-table-wrap{overflow-x:auto;margin-top:16px}
.pz-breed-table{width:100%;border-collapse:collapse;font-size:14px}
.pz-breed-table th{background:#0D0D0D;color:#fff;padding:12px 14px;text-align:left;font-size:12px;text-transform:uppercase;letter-spacing:.04em}
.pz-breed-table td{padding:12px 14px;border-bottom:1px solid #F0F0F0;vertical-align:top}
.pz-breed-table tr:nth-child(even) td{background:#FAFAFA}

/* Products */
.pz-products-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-top:16px}
@media(max-width:600px){.pz-products-grid{grid-template-columns:1fr}}
.pz-product-card{background:#F7F7F7;border-radius:14px;padding:20px;text-align:center}
.pz-product-icon{font-size:32px;margin-bottom:10px}
.pz-product-card h4{font-size:15px;font-weight:800;color:#0D0D0D;margin-bottom:8px}
.pz-product-card p{font-size:13px;color:#555;line-height:1.6;margin:0}

/* Vet section */
.pz-vet-disclaimer{display:flex;gap:16px;background:#FFF8E1;border:1.5px solid #FFE082;border-radius:16px;padding:20px 24px;margin-bottom:24px}
.pz-vet-disclaimer-icon{font-size:32px;flex-shrink:0}
.pz-vet-disclaimer strong{display:block;font-size:15px;color:#0D0D0D;margin-bottom:6px}
.pz-vet-disclaimer p{font-size:14px;color:#555;margin:0;line-height:1.6}
.pz-vet-list{list-style:none;padding:0;margin:16px 0}
.pz-vet-list li{padding:10px 0;border-bottom:1px solid #F0F0F0;font-size:15px;color:#333;line-height:1.6}
.pz-vet-list li:last-child{border-bottom:none}

/* FAQ */
.pz-faq-item{border:1.5px solid #F0F0F0;border-radius:14px;margin-bottom:12px;overflow:hidden}
.pz-faq-q{width:100%;text-align:left;padding:18px 20px;background:#fff;border:none;font-size:15px;font-weight:700;color:#0D0D0D;cursor:pointer;display:flex;justify-content:space-between;align-items:center;gap:12px;transition:background .15s}
.pz-faq-q:hover{background:#FAFAFA}
.pz-faq-q[aria-expanded="true"]{background:#FFF8F4;color:var(--orange)}
.pz-faq-arrow{font-size:18px;transition:transform .2s;flex-shrink:0}
.pz-faq-q[aria-expanded="true"] .pz-faq-arrow{transform:rotate(180deg)}
.pz-faq-a{padding:0 20px 18px;font-size:14px;color:#555;line-height:1.7}
.pz-faq-a p{margin:0}

/* TOC */
#pz-auto-toc{background:#F7F7F7;border-radius:16px;padding:24px;margin-bottom:40px;border:1.5px solid #E8E8E8}
#pz-auto-toc-list{margin:0;padding-left:20px}
#pz-auto-toc-list li{margin-bottom:6px}
#pz-auto-toc-list a{color:var(--orange);font-size:14px;font-weight:600;text-decoration:none}
#pz-auto-toc-list a:hover{text-decoration:underline}

/* ── Tool Sidebar (dark theme) ── */
.pz-auto-tool-sidebar .pz-sidebar-widget{background:#13131F;border:1px solid rgba(255,255,255,.08);border-radius:14px;margin-bottom:16px}
.pz-auto-tool-sidebar .pz-sidebar-title{font-size:12px;font-weight:800;color:rgba(255,255,255,.5);text-transform:uppercase;letter-spacing:.06em}
.pz-auto-tool-sidebar .pz-sidebar-tool{display:flex;align-items:center;gap:8px;padding:8px 10px;border-radius:8px;font-size:12px;font-weight:600;color:rgba(255,255,255,.75);transition:all .2s;border:1px solid transparent;text-decoration:none;margin-bottom:2px}
.pz-auto-tool-sidebar .pz-sidebar-tool:hover{background:rgba(255,107,26,.1);border-color:rgba(255,107,26,.3);color:var(--orange)}
.pz-auto-tool-sidebar .pz-sidebar-tool-icon{font-size:16px;flex-shrink:0;width:28px;height:28px;background:rgba(255,255,255,.06);border-radius:6px;display:flex;align-items:center;justify-content:center}
.pz-auto-tool-sidebar .pz-sidebar-tool-title{flex:1;line-height:1.3}
.pz-auto-tool-sidebar .pz-sidebar-tool-arrow{margin-left:auto;opacity:0;color:var(--orange);transition:opacity .2s;flex-shrink:0}
.pz-auto-tool-sidebar .pz-sidebar-tool:hover .pz-sidebar-tool-arrow{opacity:1}

/* Sidebar Search */
.pz-sb-search-wrap{display:flex;gap:6px;align-items:center}
.pz-sb-search{flex:1;padding:8px 12px;background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.12);border-radius:8px;color:#fff;font-size:12px;outline:none;transition:border-color .2s}
.pz-sb-search:focus{border-color:var(--orange)}
.pz-sb-search::placeholder{color:rgba(255,255,255,.3)}
.pz-sb-search-btn{padding:8px 12px;background:var(--orange);border:none;border-radius:8px;color:#fff;font-size:13px;font-weight:700;cursor:pointer;transition:opacity .2s;flex-shrink:0}
.pz-sb-search-btn:hover{opacity:.85}
.pz-sb-results{margin-top:8px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:8px;overflow:hidden}
.pz-sb-result-item{display:flex;align-items:center;gap:8px;padding:8px 10px;font-size:12px;color:rgba(255,255,255,.75);text-decoration:none;border-bottom:1px solid rgba(255,255,255,.05);transition:background .2s}
.pz-sb-result-item:last-child{border-bottom:none}
.pz-sb-result-item:hover{background:rgba(255,107,26,.1);color:var(--orange)}
.pz-sb-no-results{padding:10px;font-size:12px;color:rgba(255,255,255,.4);text-align:center}

/* PDF Print */
@media print {
  .navbar,.pz-tool-hero-actions,.pz-pdf-btn,.pz-share-bar,.pz-auto-tool-sidebar,
  .pz-ad-slot,footer,.pz-related-tools,.pz-breadcrumb{display:none!important}
  .pz-auto-tool-layout{grid-template-columns:1fr!important}
  .pz-tool-hero{background:#0D0D0D!important;-webkit-print-color-adjust:exact}
  body{font-size:12px}
}
</style>

<script>
// ── Unit toggle
var pzUnit = 'lbs';
function pzSetUnit(u, btn) {
  pzUnit = u;
  document.querySelectorAll('.pz-unit-btn').forEach(function(b){ b.classList.remove('active'); });
  btn.classList.add('active');
  document.querySelectorAll('#pz-unit-label,#pz-unit-label2').forEach(function(el){ el.textContent = u; });
}

// ── Chip selector
function pzSelectChip(el, field) {
  el.closest('.pz-activity-chips').querySelectorAll('.pz-chip').forEach(function(c){ c.classList.remove('active'); });
  el.classList.add('active');
  var inp = document.getElementById('pz_'+field);
  if (inp) inp.value = el.dataset.val;
}

// ── Checker: step-by-step navigation
function pzCheckerNext(current, total) {
  var steps = document.querySelectorAll('.pz-checker-step');
  var next = current + 1;
  var fill = document.getElementById('pz-prog-fill');
  var txt  = document.getElementById('pz-prog-txt');
  var submitBtn = document.getElementById('pz-checker-submit');
  // Highlight selected card
  var cards = steps[current].querySelectorAll('.pz-checker-card');
  cards.forEach(function(c){ c.style.opacity='0.6'; });
  var checked = steps[current].querySelector('input:checked');
  if(checked) checked.closest('.pz-checker-card').style.cssText += ';opacity:1;border-color:var(--orange);background:rgba(255,107,26,.08)';
  // Move to next after short delay
  setTimeout(function(){
    steps[current].classList.remove('active');
    if (next <= total) {
      steps[next].classList.add('active');
      var pct = Math.round((next/(total+1))*100);
      if(fill) fill.style.width = pct+'%';
      if(txt) txt.textContent = 'Question '+(next+1)+' of '+(total+1);
    }
    if (next === total && submitBtn) {
      if(fill) fill.style.width='90%';
      if(txt) txt.textContent = 'Almost done!';
      setTimeout(function(){ submitBtn.style.display='flex'; },300);
    }
  }, 350);
}

// ── Calculator
function pzCalcTool() {
  var weightRaw = parseFloat(document.getElementById('pz_weight')?.value) || 0;
  var activity  = document.getElementById('pz_activity')?.value || 'moderate';
  var health    = document.getElementById('pz_health')?.value || 'healthy';
  var goal      = document.getElementById('pz_goal')?.value || 'maintain';
  var result    = document.getElementById('pz-calc-result');
  if (!result) return;
  if (!weightRaw || weightRaw <= 0) {
    result.style.display='block';
    result.innerHTML='<div class="pz-result-warning" style="border-radius:12px;padding:16px;text-align:center"><strong>⚠️ Please enter your pet\'s weight.</strong></div>'; return;
  }
  var weightKg = pzUnit==='kg' ? weightRaw : weightRaw * 0.453592;
  var weightLbs = pzUnit==='lbs' ? weightRaw : weightRaw * 2.20462;
  var rer = 70 * Math.pow(weightKg, 0.75);
  var mults = {low:1.2, moderate:1.6, high:1.8, working:3.0};
  var hmult = {healthy:1, overweight:0.8, underweight:1.4, pregnant:3.0, medical:1.1};
  var goalMult = {maintain:1, lose:0.8, gain:1.2};
  var daily = Math.round(rer * (mults[activity]||1.6) * (hmult[health]||1) * (goalMult[goal]||1));
  var perMeal2 = Math.round(daily/2);
  var perMeal3 = Math.round(daily/3);
  var bcs = health==='overweight'?7:(health==='underweight'?3:5);
  result.style.display='block';
  result.innerHTML =
    '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
    +'<div class="pz-result-hero" style="background:linear-gradient(135deg,#1B5E20,#2E7D32);color:#fff;padding:28px">'
    +'<div style="font-size:13px;font-weight:700;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">✅ Your Results Are Ready</div>'
    +'<div class="pz-result-number">'+daily+'</div>'
    +'<div class="pz-result-unit">calories needed per day</div>'
    +'</div>'
    +'<div class="pz-result-grid">'
    +'<div class="pz-result-cell"><div class="pz-result-cell-label">Per Meal (2x)</div><div class="pz-result-cell-val">'+perMeal2+' kcal</div></div>'
    +'<div class="pz-result-cell"><div class="pz-result-cell-label">Per Meal (3x)</div><div class="pz-result-cell-val">'+perMeal3+' kcal</div></div>'
    +'<div class="pz-result-cell"><div class="pz-result-cell-label">Base RER</div><div class="pz-result-cell-val">'+Math.round(rer)+' kcal</div></div>'
    +'</div>'
    +'<div class="pz-result-tips"><h4>📋 Vet-Reviewed Recommendations</h4><ul>'
    +'<li>Divide daily calories into 2–3 meals for best digestion</li>'
    +'<li>Adjust by ±10% based on weight change over 4 weeks</li>'
    +'<li>Treats should not exceed 10% of daily calories</li>'
    +'<li>Always provide fresh water alongside meals</li>'
    +'<li>Confirm with your vet especially for medical conditions</li>'
    +'</ul></div></div>';
}

// ── Checker
function pzRunChecker() {
  var result = document.getElementById('pz-checker-result');
  if (!result) return;
  var questions = document.querySelectorAll('[name^="pzq_"]');
  var answered = new Set(); var score = 0;
  questions.forEach(function(q) {
    if (q.checked) {
      answered.add(q.name);
      if (['no','severe','frequent','very_low'].indexOf(q.value)>-1) score += 3;
      else if (['less','once','lower','mild','more'].indexOf(q.value)>-1) score += 1;
    }
  });
  var uniqueQ = document.querySelectorAll('.pz-checker-step').length;
  var fill = document.getElementById('pz-prog-fill');
  if(fill) fill.style.width='100%';
  result.style.display='block';
  if (score >= 7) {
    result.innerHTML='<div class="pz-result-danger" style="border-radius:16px;overflow:hidden">'
      +'<div style="background:linear-gradient(135deg,#B71C1C,#C62828);color:#fff;padding:24px;text-align:center">'
      +'<div style="font-size:40px;margin-bottom:8px">🚨</div>'
      +'<div style="font-size:20px;font-weight:900;margin-bottom:6px">Urgent: See Your Vet Today</div>'
      +'<div style="font-size:13px;opacity:.8">Multiple concerning signs detected</div></div>'
      +'<div class="pz-result-tips"><ul>'
      +'<li>Contact your veterinarian immediately or visit an emergency clinic</li>'
      +'<li>Do not wait to see if symptoms improve on their own</li>'
      +'<li>Bring notes of all symptoms and when they started</li>'
      +'</ul></div></div>';
  } else if (score >= 3) {
    result.innerHTML='<div class="pz-result-warning" style="border-radius:16px;overflow:hidden">'
      +'<div style="background:linear-gradient(135deg,#E65100,#FF9800);color:#fff;padding:24px;text-align:center">'
      +'<div style="font-size:40px;margin-bottom:8px">⚠️</div>'
      +'<div style="font-size:20px;font-weight:900;margin-bottom:6px">Monitor Closely — Vet Visit Recommended</div>'
      +'<div style="font-size:13px;opacity:.8">Some concerning signs detected</div></div>'
      +'<div class="pz-result-tips"><ul>'
      +'<li>Schedule a vet appointment within 24–48 hours</li>'
      +'<li>Monitor food intake, water consumption, and energy levels</li>'
      +'<li>Take photos or video of any abnormal behavior to show your vet</li>'
      +'</ul></div></div>';
  } else {
    result.innerHTML='<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
      +'<div style="background:linear-gradient(135deg,#1B5E20,#2E7D32);color:#fff;padding:24px;text-align:center">'
      +'<div style="font-size:40px;margin-bottom:8px">✅</div>'
      +'<div style="font-size:20px;font-weight:900;margin-bottom:6px">Your Pet Looks Healthy!</div>'
      +'<div style="font-size:13px;opacity:.8">No major concerns detected</div></div>'
      +'<div class="pz-result-tips"><ul>'
      +'<li>Continue your regular feeding and care routine</li>'
      +'<li>Schedule an annual wellness check-up with your vet</li>'
      +'<li>Keep up with vaccinations and parasite prevention</li>'
      +'</ul></div></div>';
  }
}

// ── Guide generator
function pzGenGuide() {
  var name   = document.getElementById('pz_pet_name')?.value || 'Your Pet';
  var age    = document.getElementById('pz_pet_age')?.value || '';
  var breed  = document.getElementById('pz_breed')?.value || '';
  var weight = document.getElementById('pz_weight2')?.value || '';
  var goal   = document.getElementById('pz_goal2')?.value || 'health';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  var goalLabels = {health:'Overall Health',weight:'Weight Management',grooming:'Grooming & Coat',behavior:'Behavior & Training',nutrition:'Better Nutrition'};
  result.style.display='block';
  result.innerHTML =
    '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
    +'<div style="background:linear-gradient(135deg,#1B5E20,#2E7D32);color:#fff;padding:24px">'
    +'<div style="font-size:13px;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px">🎯 Personalized Guide Ready</div>'
    +'<div style="font-size:22px;font-weight:900;margin-bottom:4px">'+name+'\'s Care Plan</div>'
    +'<div style="font-size:13px;opacity:.75">Goal: '+goalLabels[goal]+(breed?' · Breed: '+breed:'')+(age?' · Age: '+age+' yrs':'')+'</div>'
    +'</div>'
    +'<div class="pz-result-grid">'
    +(age?'<div class="pz-result-cell"><div class="pz-result-cell-label">Age</div><div class="pz-result-cell-val">'+age+' yrs</div></div>':'')
    +(weight?'<div class="pz-result-cell"><div class="pz-result-cell-label">Weight</div><div class="pz-result-cell-val">'+weight+' '+pzUnit+'</div></div>':'')
    +(breed?'<div class="pz-result-cell"><div class="pz-result-cell-label">Breed</div><div class="pz-result-cell-val" style="font-size:13px">'+breed+'</div></div>':'')
    +'</div>'
    +'<div class="pz-result-tips"><h4>📋 Your Personalized Action Plan</h4><ul>'
    +'<li>Read all guide sections below — tailored for '+name+'\'s profile</li>'
    +'<li>Focus especially on the "'+goalLabels[goal]+'" tips in each section</li>'
    +'<li>Check the breed-specific section for '+( breed||'your breed')+' recommendations</li>'
    +'<li>Download this guide as PDF to keep it handy at home</li>'
    +'<li>Review progress monthly and adjust your routine as needed</li>'
    +'</ul></div></div>';
}

// ── FAQ Toggle
function pzToggleFaq(btn) {
  var expanded = btn.getAttribute('aria-expanded') === 'true';
  var answer = btn.nextElementSibling;
  btn.setAttribute('aria-expanded', !expanded);
  answer.hidden = expanded;
}

// ── PDF / Print
function pzPrintTool() {
  window.print();
}

// ── Sidebar Search
var pzAllTools = <?php
    require_once get_template_directory() . '/inc/tool-registry.php';
    $tools_js = array_map(fn($t) => ['s'=>$t['slug'],'t'=>$t['title'],'i'=>$t['icon']], pz_get_all_tools());
    echo json_encode($tools_js);
?>;

function pzSbDoSearch() {
  var q = document.getElementById('pz-sb-search').value.toLowerCase().trim();
  var box = document.getElementById('pz-sb-results');
  if (!q || q.length < 2) { box.style.display='none'; return; }
  var hits = pzAllTools.filter(function(t){
    return t.t.toLowerCase().indexOf(q) > -1 || t.s.indexOf(q) > -1;
  }).slice(0,6);
  box.style.display = 'block';
  if (!hits.length) {
    box.innerHTML = '<div class="pz-sb-no-results">No tools found</div>';
    return;
  }
  box.innerHTML = hits.map(function(t){
    return '<a href="/' + <?php echo json_encode(ltrim(parse_url(home_url('/tools/'), PHP_URL_PATH) ?: '/tools/', '/')); ?> + t.s + '/" class="pz-sb-result-item">'
      + '<span style="font-size:16px">' + t.i + '</span>'
      + '<span>' + t.t + '</span>'
      + '</a>';
  }).join('');
}

document.addEventListener('DOMContentLoaded', function(){
  var inp = document.getElementById('pz-sb-search');
  if (!inp) return;
  inp.addEventListener('keyup', function(e){
    if (e.key === 'Enter') pzSbDoSearch();
    else if (this.value.length >= 2) pzSbDoSearch();
    else if (this.value.length === 0) {
      document.getElementById('pz-sb-results').style.display='none';
    }
  });
});

// ── Auto-generate TOC
document.addEventListener('DOMContentLoaded', function() {
  var main = document.querySelector('.pz-auto-tool-main');
  var toc = document.getElementById('pz-auto-toc');
  var list = document.getElementById('pz-auto-toc-list');
  if (!main || !toc || !list) return;
  var headings = main.querySelectorAll('h2');
  if (headings.length < 3) { toc.hidden = true; return; }
  headings.forEach(function(h, i) {
    if (!h.id) h.id = 'sec-' + i;
    var li = document.createElement('li');
    li.innerHTML = '<a href="#' + h.id + '">' + h.textContent + '</a>';
    list.appendChild(li);
  });
});
</script>
