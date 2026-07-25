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

/* Hero — product/tool-first layout: calculator card sits directly in the hero */
.pz-tool-hero{background:linear-gradient(135deg,#1A1A2E 0%,#16213E 60%,#0F3460 100%);padding:70px 0;position:relative;overflow:hidden}
.pz-tool-hero-bg{position:absolute;inset:0;background:radial-gradient(ellipse at 70% 50%,rgba(255,107,26,.12) 0%,transparent 70%);pointer-events:none}

/* Per-tool hero "feel" — dog_bathing_frequency: floating soap bubbles, brand colors only */
.pz-hero-bubbles{position:absolute;inset:0;overflow:hidden;pointer-events:none;z-index:0}
.pz-bubble{position:absolute;border-radius:50%;
  background:radial-gradient(circle at 30% 30%,rgba(255,255,255,.4),rgba(255,255,255,.05) 55%,transparent 72%);
  border:1px solid rgba(255,255,255,.18);
  animation:pzBubbleFloat 11s ease-in-out infinite}
.pz-bubble-1{width:64px;height:64px;left:6%;top:62%;animation-delay:0s;animation-duration:13s}
.pz-bubble-2{width:26px;height:26px;left:16%;top:18%;animation-delay:1.2s;animation-duration:9s}
.pz-bubble-3{width:42px;height:42px;left:34%;top:78%;animation-delay:2.4s;animation-duration:12s}
.pz-bubble-4{width:18px;height:18px;left:47%;top:12%;animation-delay:.6s;animation-duration:8s}
.pz-bubble-5{width:54px;height:54px;left:88%;top:22%;animation-delay:1.8s;animation-duration:14s}
.pz-bubble-6{width:30px;height:30px;left:94%;top:68%;animation-delay:3s;animation-duration:10s}
@keyframes pzBubbleFloat{0%,100%{transform:translateY(0) translateX(0);opacity:.55}50%{transform:translateY(-26px) translateX(8px);opacity:1}}
@media(max-width:960px){.pz-bubble-4,.pz-bubble-5{display:none}}
@media(prefers-reduced-motion:reduce){.pz-bubble{animation:none}}

/* Per-tool hero "feel" — dog_grooming_schedule: scattered brush-bristle dots, gentle rise */
.pz-hero-bristles{position:absolute;inset:0;overflow:hidden;pointer-events:none;z-index:0}
.pz-bristle-dot{position:absolute;width:5px;height:16px;border-radius:3px;
  background:linear-gradient(180deg,rgba(255,255,255,.5),rgba(255,255,255,.08));
  animation:pzBristleDrift 9s ease-in-out infinite}
.pz-bd-1{left:5%;top:20%;animation-delay:0s;animation-duration:8s;transform:rotate(-12deg)}
.pz-bd-2{left:14%;top:70%;animation-delay:1s;animation-duration:10s;transform:rotate(8deg)}
.pz-bd-3{left:28%;top:35%;animation-delay:2s;animation-duration:7.5s;transform:rotate(-6deg)}
.pz-bd-4{left:40%;top:80%;animation-delay:.5s;animation-duration:9.5s;transform:rotate(14deg)}
.pz-bd-5{left:60%;top:15%;animation-delay:1.8s;animation-duration:8.5s;transform:rotate(-10deg)}
.pz-bd-6{left:82%;top:55%;animation-delay:2.5s;animation-duration:11s;transform:rotate(6deg)}
.pz-bd-7{left:90%;top:20%;animation-delay:.8s;animation-duration:9s;transform:rotate(-8deg)}
.pz-bd-8{left:95%;top:75%;animation-delay:1.4s;animation-duration:7s;transform:rotate(10deg)}
@keyframes pzBristleDrift{0%,100%{transform:translateY(0) rotate(var(--r,0deg));opacity:.5}50%{transform:translateY(-18px) rotate(var(--r,0deg));opacity:.9}}
@media(max-width:960px){.pz-bd-6,.pz-bd-7,.pz-bd-8{display:none}}
@media(prefers-reduced-motion:reduce){.pz-bristle-dot{animation:none}}
.pz-tool-hero-grid{position:relative;z-index:1;display:grid;grid-template-columns:1fr 480px;gap:48px;align-items:start}
@media(max-width:960px){.pz-tool-hero-grid{grid-template-columns:1fr;gap:32px}}
.pz-tool-hero-content{padding-top:12px}
.pz-tool-hero-badge{display:inline-flex;align-items:center;gap:8px;background:rgba(255,107,26,.15);border:1px solid rgba(255,107,26,.3);color:var(--orange);padding:6px 16px;border-radius:50px;font-size:13px;font-weight:700;margin-bottom:20px}
.pz-tool-hero-title{font-size:clamp(24px,3.4vw,38px);font-weight:900;color:#fff;line-height:1.18;margin-bottom:14px}
.pz-tool-hero-desc{font-size:15px;color:rgba(255,255,255,0.65);line-height:1.7;margin-bottom:24px;max-width:520px}
.pz-pdf-btn{display:inline-flex;align-items:center;gap:8px;padding:12px 22px;border:2px solid rgba(255,255,255,0.2);border-radius:50px;background:transparent;color:#fff;font-size:14px;font-weight:700;cursor:pointer;transition:all .2s}
.pz-pdf-btn:hover{border-color:var(--orange);color:var(--orange)}
.pz-tool-hero-trust{display:flex;flex-wrap:wrap;gap:12px}
.pz-tool-hero-trust span{font-size:13px;color:rgba(255,255,255,0.55);font-weight:600}
/* The tool card sitting inside the dark hero — force full width, keep its own white/elevated look */
.pz-tool-hero-toolcard{width:100%}
.pz-tool-hero-toolcard .pz-int-wrap{box-shadow:0 24px 60px -12px rgba(0,0,0,.5)}
/* Learn More divider — marks the shift from the tool (in the hero) to the article below */
.pz-learn-more-divider{display:flex;align-items:center;gap:16px;margin:0 0 32px;color:#999;font-size:13px;font-weight:800;text-transform:uppercase;letter-spacing:.08em}
.pz-learn-more-divider::before,.pz-learn-more-divider::after{content:"";flex:1;height:1.5px;background:#EEE}

/* Hero Quick Answer box (AEO-friendly extractable summary) */
.pz-hero-quickanswer{background:rgba(255,255,255,.06);border-left:3px solid var(--orange);border-radius:0 10px 10px 0;padding:14px 18px;margin:20px 0;font-size:13.5px;color:rgba(255,255,255,.75);line-height:1.6}
.pz-hero-quickanswer-label{font-size:10.5px;font-weight:800;color:var(--orange);text-transform:uppercase;letter-spacing:.06em;margin-bottom:6px}
.pz-hero-quickanswer p{margin:0}
.pz-hero-quickanswer strong{color:#fff}

/* "AI is thinking" transitional state — shown briefly inside the result card before the real result renders */
.pz-analyzing{padding:36px 20px;text-align:center;background:#fff;border-radius:16px;border:1px solid #EEE}
.pz-analyzing-spinner{width:34px;height:34px;margin:0 auto 14px;border:3px solid #EEE;border-top-color:var(--orange);border-radius:50%;animation:pzSpin .8s linear infinite}
.pz-analyzing-text{font-size:14px;font-weight:700;color:#555;animation:pzPulse 1.4s ease-in-out infinite}
@keyframes pzSpin{to{transform:rotate(360deg)}}
@keyframes pzPulse{0%,100%{opacity:.55}50%{opacity:1}}

/* Methodology section */
.pz-methodology-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px}
@media(max-width:800px){.pz-methodology-grid{grid-template-columns:1fr 1fr}}
@media(max-width:500px){.pz-methodology-grid{grid-template-columns:1fr}}
.pz-methodology-card{background:#F7F7F7;border-radius:14px;padding:18px}
.pz-methodology-icon{font-size:24px;margin-bottom:8px}
.pz-methodology-card strong{display:block;font-size:14px;color:#0D0D0D;margin-bottom:6px}
.pz-methodology-card p{font-size:12.5px;color:#666;line-height:1.6;margin:0}

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

/* ══ Multi-step Wizard (breed/coat calculators) ══ */
.pz-wizard-head{padding:24px 24px 20px;background:#fff;border-bottom:1px solid #F0F0F0}
.pz-wizard-title{font-size:17px;font-weight:900;color:#0D0D0D;margin-bottom:4px}
.pz-wizard-sub{font-size:12.5px;color:#888;margin-bottom:16px}
.pz-wizard-progress-bar{height:4px;background:#F0F0F0;border-radius:50px;overflow:hidden;margin-bottom:10px}
.pz-wizard-progress-fill{height:100%;width:25%;background:linear-gradient(90deg,#FF6B1A,#FFB347);border-radius:50px;transition:width .35s}
.pz-wizard-steps-label{display:flex;justify-content:space-between;gap:6px}
@media(max-width:380px){.pz-wizard-steps-label{font-size:9px}.pz-wiz-steplabel{font-size:9px}}
.pz-wiz-steplabel{font-size:10.5px;font-weight:700;color:#bbb;text-transform:uppercase;letter-spacing:.04em}
.pz-wiz-steplabel.active{color:var(--orange)}
.pz-wiz-steplabel.done{color:#4CAF50}

.pz-wizard-body{padding:24px;background:#fff;min-height:260px}
.pz-wizard-step{display:none}
.pz-wizard-step.active{display:block;animation:pzFadeIn .25s ease}
@keyframes pzFadeIn{from{opacity:0;transform:translateY(6px)}to{opacity:1;transform:translateY(0)}}

.pz-breed-search-wrap{position:relative;margin-top:8px}
.pz-breed-results{position:absolute;top:calc(100% + 4px);left:0;right:0;background:#fff;border:1.5px solid #E8E8E8;border-radius:10px;box-shadow:0 8px 24px rgba(0,0,0,.1);max-height:220px;overflow-y:auto;z-index:5}
.pz-breed-result-item{padding:10px 14px;font-size:13px;font-weight:600;color:#333;cursor:pointer;border-bottom:1px solid #F5F5F5;display:flex;justify-content:space-between}
.pz-breed-result-item:last-child{border-bottom:none}
.pz-breed-result-item:hover{background:#FFF5F0;color:var(--orange)}
.pz-breed-result-item span{color:#999;font-weight:400;font-size:11px}
.pz-wizard-or{text-align:center;font-size:11px;font-weight:700;color:#aaa;text-transform:uppercase;letter-spacing:.05em;margin:18px 0 14px;position:relative}
.pz-wizard-or::before,.pz-wizard-or::after{content:"";position:absolute;top:50%;width:38%;height:1px;background:#EEE}
.pz-wizard-or::before{left:0}.pz-wizard-or::after{right:0}

.pz-coat-grid{display:grid;grid-template-columns:1fr 1fr;gap:10px}
@media(max-width:420px){.pz-coat-grid{grid-template-columns:1fr}}
.pz-coat-card{text-align:left;padding:12px 14px;border:1.5px solid #E0E0E0;border-radius:10px;background:#FAFAFA;cursor:pointer;transition:all .15s;display:flex;flex-direction:column;gap:2px}
.pz-coat-card strong{font-size:13px;color:#0D0D0D}
.pz-coat-card span{font-size:11px;color:#999}
.pz-coat-card:hover{border-color:var(--orange)}
.pz-coat-card.active{border-color:var(--orange);background:#FFF5F0}
.pz-coat-card.active strong{color:var(--orange)}

.pz-wizard-nav{display:flex;gap:12px;padding:0 24px 24px;background:#fff}
.pz-wizard-back{padding:14px 24px;border:1.5px solid #E0E0E0;border-radius:12px;background:#fff;color:#777;font-size:14px;font-weight:700;cursor:pointer;transition:all .15s}
.pz-wizard-back:hover:not(:disabled){border-color:#ccc;color:#333}
.pz-wizard-back:disabled{opacity:.4;cursor:not-allowed}
.pz-wizard-next{margin-top:0}
#pz-calc-result{padding:0 24px 24px}
#pz-calc-result:empty{padding:0}

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
@media(max-width:560px){.pz-result-grid{grid-template-columns:1fr 1fr}}
@media(max-width:360px){.pz-result-grid{grid-template-columns:1fr}}
.pz-result-cell{padding:16px;background:#fff;text-align:center}
.pz-result-cell-label{font-size:11px;font-weight:700;color:#888;text-transform:uppercase;letter-spacing:.04em;margin-bottom:4px}
.pz-result-cell-val{font-size:17px;font-weight:800;color:#0D0D0D}
.pz-result-recap{padding:16px 20px;background:#fff;border-top:1px solid #E8E8E8}
.pz-result-recap h4{font-size:13px;font-weight:800;color:#0D0D0D;margin-bottom:10px;text-transform:uppercase;letter-spacing:.04em}
.pz-result-recap ul{margin:0;padding:0;list-style:none;display:grid;grid-template-columns:1fr 1fr;gap:6px 16px}
@media(max-width:420px){.pz-result-recap ul{grid-template-columns:1fr}}
.pz-result-recap ul li{font-size:12.5px;color:#555}
.pz-result-recap ul li strong{color:#0D0D0D}
.pz-result-tips{padding:16px 20px;background:#FFFBF8;border-top:1px solid #F0E8E0}
.pz-result-tips h4{font-size:13px;font-weight:800;color:#0D0D0D;margin-bottom:10px;text-transform:uppercase;letter-spacing:.04em}
.pz-result-tips ul{margin:0;padding-left:18px}
.pz-result-tips ul li{font-size:13px;color:#555;margin-bottom:6px;line-height:1.5}
.pz-result-success{background:linear-gradient(135deg,#E8F5E9,#F1F8E9);border:2px solid #4CAF50}
.pz-result-warning{background:linear-gradient(135deg,#FFF8E1,#FFFDE7);border:2px solid #FF9800}
.pz-result-danger{background:linear-gradient(135deg,#FFEBEE,#FCE4EC);border:2px solid #F44336}

/* Info box */
.pz-info-box{background:rgba(255,107,26,.07);border-left:4px solid var(--orange);padding:16px 20px;border-radius:0 12px 12px 0;font-size:15px;color:#333;margin:20px 0}
.pz-inline-related{font-size:14.5px;color:#555;font-style:italic;margin:16px 0 0;padding-top:4px}
.pz-inline-related a{color:var(--orange);font-weight:700;font-style:normal;text-decoration:none}
.pz-inline-related a:hover{text-decoration:underline}

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

/* TOC — collapsed by default, click to open, 2-column on desktop */
#pz-auto-toc{background:#F7F7F7;border-radius:16px;padding:16px 24px;margin-bottom:40px;border:1.5px solid #E8E8E8}
#pz-auto-toc[open]{padding-bottom:20px}
#pz-auto-toc .pz-toc-title{font-size:14px;font-weight:800;color:#0D0D0D;text-transform:uppercase;letter-spacing:.04em;cursor:pointer;list-style:none;padding:8px 0}
#pz-auto-toc .pz-toc-title::-webkit-details-marker{display:none}
#pz-auto-toc .pz-toc-title::after{content:"▾";float:right;transition:transform .2s;color:var(--orange)}
#pz-auto-toc[open] .pz-toc-title::after{transform:rotate(180deg)}
#pz-auto-toc-list{margin:12px 0 0;padding-left:20px;columns:2;column-gap:24px}
#pz-auto-toc-list li{margin-bottom:8px;break-inside:avoid}
#pz-auto-toc-list a{color:var(--orange);font-size:14px;font-weight:600;text-decoration:none}
#pz-auto-toc-list a:hover{text-decoration:underline}
@media(max-width:600px){#pz-auto-toc-list{columns:1}}

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

/* Print-only branded header/footer — invisible on screen, shown only inside @media print below */
.pz-print-header,.pz-print-footer{display:none}

/* PDF Print */
@media print {
  .navbar,.pz-tool-hero-actions,.pz-pdf-btn,.pz-share-bar,.pz-auto-tool-sidebar,
  .pz-ad-slot,footer,.pz-related-tools,.pz-breadcrumb,#preloader{display:none!important}
  .pz-auto-tool-layout{grid-template-columns:1fr!important}
  .pz-tool-hero{background:#0D0D0D!important;-webkit-print-color-adjust:exact}
  body{font-size:12px}

  .pz-print-header{display:flex!important;align-items:center;justify-content:space-between;
    gap:16px;padding:0 0 14px;margin:0 0 20px;border-bottom:3px solid #FF6B1A}
  .pz-print-logo{font-size:20px;font-weight:900;color:#0D0D0D}
  .pz-print-logo span{color:#FF6B1A}
  .pz-print-meta{text-align:right;font-size:12px;color:#555;line-height:1.6}
  .pz-print-footer{display:block!important;margin-top:28px;padding-top:14px;
    border-top:1px solid #ddd;font-size:11px;color:#777;line-height:1.7}
  .pz-print-footer p{margin:0 0 4px}

  /* Result-only PDF: triggered by the "Download This Result as PDF" button inside a result card.
     The calculator (and its result) now lives INSIDE the hero, so we can't hide the whole hero —
     only the parts of it that aren't the result: headline/description/quick-answer/trust/PDF-btn
     on the left, and the input form (wizard or generic) on the right. The step-by-step guide
     section is deliberately kept so the saved PDF is a self-contained reference, not just a number. */
  body.pz-printing-result-only .pz-tool-hero-content,
  body.pz-printing-result-only .pz-tool-hero-bg,
  body.pz-printing-result-only #pz-auto-toc,
  body.pz-printing-result-only .pz-tool-section:not(:has(#pz-calc-result)):not(:has(#pz-checker-result)):not(:has(#pz-guide-result)):not(#pz-steps-section),
  body.pz-printing-result-only .pz-int-header,
  body.pz-printing-result-only .pz-int-grid,
  body.pz-printing-result-only .pz-wizard-head,
  body.pz-printing-result-only .pz-wizard-body,
  body.pz-printing-result-only .pz-wizard-nav,
  body.pz-printing-result-only .pz-int-btn:not([onclick*="pzPrintResult"]){display:none!important}
  body.pz-printing-result-only .pz-tool-hero{background:#fff!important;padding:24px 0!important}
  body.pz-printing-result-only .pz-tool-hero-grid{display:block!important}
  body.pz-printing-result-only .pz-int-wrap{border:none;box-shadow:none}
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

// ── Shared "AI analyzing" transitional state, used by every calculator/guide result
function pzShowAnalyzing(resultId, label) {
  var result = document.getElementById(resultId);
  if (!result) return;
  result.style.display = 'block';
  result.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  result.innerHTML = '<div class="pz-analyzing"><div class="pz-analyzing-spinner"></div><div class="pz-analyzing-text">' + (label || 'Analyzing your pet’s profile…') + '</div></div>';
}

// ── Calculator
function pzCalcTool() {
  var weightRaw = parseFloat(document.getElementById('pz_weight')?.value) || 0;
  var activity  = document.getElementById('pz_activity')?.value || 'moderate';
  var health    = document.getElementById('pz_health')?.value || 'healthy';
  var goal      = document.getElementById('pz_goal')?.value || 'maintain';
  var result    = document.getElementById('pz-calc-result');
  if (!result) return;
  pzShowAnalyzing('pz-calc-result', 'Analyzing your pet’s calorie needs…');
  setTimeout(function() {
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
  }, 650);
}

// ── Checker
function pzRunChecker() {
  var result = document.getElementById('pz-checker-result');
  if (!result) return;
  pzShowAnalyzing('pz-checker-result', 'Analyzing your pet’s symptoms…');
  setTimeout(function() {
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
  }, 650);
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
  pzShowAnalyzing('pz-guide-result', 'Building your personalized care plan…');
  setTimeout(function() {
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
  }, 650);
}

// ── Dog Nail Trimming Guide
function pzGenNailTrimming() {
  var surface = document.getElementById('pz_nail_surface')?.value || 'mixed';
  var click = document.getElementById('pz_nail_click')?.value || 'no';
  var lastTrim = document.getElementById('pz_nail_last_trim')?.value || '';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Calculating nail trim schedule…');
  setTimeout(function() {

  var baseWeeks = {pavement:6, mixed:4, soft:3}[surface];
  if (click === 'yes') baseWeeks = Math.max(2, baseWeeks - 2);
  else if (click === 'unsure') baseWeeks = Math.max(2, baseWeeks - 1);
  var lowWeeks = Math.max(2, baseWeeks - 1), highWeeks = baseWeeks + 1;

  var nextDateStr = '', calendarLink = '';
  if (lastTrim) {
    var d = new Date(lastTrim + 'T12:00:00');
    d.setDate(d.getDate() + baseWeeks * 7);
    nextDateStr = d.toLocaleDateString('en-US', { month:'long', day:'numeric', year:'numeric' });
    var y=d.getFullYear(), m=('0'+(d.getMonth()+1)).slice(-2), day=('0'+d.getDate()).slice(-2);
    var dEnd = new Date(d); dEnd.setDate(dEnd.getDate()+1);
    var y2=dEnd.getFullYear(), m2=('0'+(dEnd.getMonth()+1)).slice(-2), d2=('0'+dEnd.getDate()).slice(-2);
    calendarLink = 'https://calendar.google.com/calendar/render?action=TEMPLATE&text='
      + encodeURIComponent("✂️ Trim dog's nails")
      + '&dates=' + y+m+day + '/' + y2+m2+d2
      + '&details=' + encodeURIComponent('Reminder from PetZenAI Nail Trimming Guide');
  }

  result.style.display = 'block';
  result.innerHTML =
    '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:linear-gradient(135deg,#1B5E20,#2E7D32);color:#fff;padding:28px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">✅ Your Nail Trim Schedule</div>'
    + '<div class="pz-result-number">' + lowWeeks + '–' + highWeeks + '</div>'
    + '<div class="pz-result-unit">weeks between trims</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Surface</div><div class="pz-result-cell-val" style="font-size:13px">' + {pavement:'Pavement',mixed:'Mixed',soft:'Grass/Carpet'}[surface] + '</div></div>'
    + (nextDateStr ? '<div class="pz-result-cell"><div class="pz-result-cell-label">Next Trim Due</div><div class="pz-result-cell-val" style="font-size:13px">' + nextDateStr + '</div></div>' : '<div class="pz-result-cell"><div class="pz-result-cell-label">Recommended</div><div class="pz-result-cell-val">Every ' + baseWeeks + ' wks</div></div>')
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Click Test</div><div class="pz-result-cell-val" style="font-size:13px">' + {yes:'Overdue',no:'On track',unsure:'Check soon'}[click] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Trim Tips</h4><ul>'
    + (click === 'yes' ? "<li>Your dog's nails are already clicking — schedule a trim within the next few days to catch up.</li>" : '')
    + '<li>Trim small amounts frequently rather than big cuts occasionally — this lets the quick recede gradually.</li>'
    + '<li>Check dewclaws separately — they get no natural filing from walking and can overgrow into the paw.</li>'
    + '<li>Keep styptic powder on hand in case you nick the quick.</li>'
    + '</ul></div>'
    + (calendarLink ? '<div style="padding:0 20px 12px"><a href="' + calendarLink + '" target="_blank" rel="noopener" class="pz-int-btn" style="margin-top:0;text-decoration:none;display:block;text-align:center">📅 Add Reminder to Calendar</a></div>' : '')
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';
  }, 650);
}

// ── Dog Shedding Guide
function pzGenShedding() {
  var breedInput = document.getElementById('pz_shed_breed');
  var breedName = (breedInput?.value || '').trim();
  var coat = document.getElementById('pz_shed_coat')?.value || 'short';
  var season = document.getElementById('pz_shed_season')?.value || 'off';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Matching your dog’s coat profile…');
  setTimeout(function() {

  if (breedName && breedInput.dataset.breeds) {
    try {
      var map = JSON.parse(breedInput.dataset.breeds);
      var match = Object.keys(map).find(function(n){ return n.toLowerCase() === breedName.toLowerCase(); });
      if (match) coat = map[match];
    } catch(e) {}
  }

  var brushing = {short:'Weekly', double: season === 'peak' ? 'Daily (peak shedding season)' : '3–4x per week', long:'Daily', curly:'Every other day', wire:'Weekly', hairless:'N/A — minimal shedding'}[coat] || 'Weekly';
  var toolRec = {short:'Rubber curry brush', double:'Undercoat rake or deshedding comb', long:'Slicker brush + wide-tooth comb', curly:'Slicker brush + detangling spray', wire:'Slicker brush + hand-stripping', hairless:'Soft cloth for skin care'}[coat] || 'Slicker brush';

  result.style.display = 'block';
  result.innerHTML =
    '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
    + '<div style="background:linear-gradient(135deg,#1B5E20,#2E7D32);color:#fff;padding:24px">'
    + '<div style="font-size:13px;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px">🎯 Your Brushing Routine' + (breedName ? ' — ' + breedName : '') + '</div>'
    + '<div style="font-size:20px;font-weight:900">' + brushing + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Coat Type</div><div class="pz-result-cell-val" style="font-size:13px;text-transform:capitalize">' + coat + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Season</div><div class="pz-result-cell-val" style="font-size:13px">' + (season === 'peak' ? 'Peak Shedding' : 'Off-Season') + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Best Tool</div><div class="pz-result-cell-val" style="font-size:12px">' + toolRec + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Shedding Control Tips</h4><ul>'
    + (coat === 'double' && season === 'peak' ? '<li>You\'re in peak "coat blow" season — daily brushing for 2–3 weeks will clear it much faster than the normal routine.</li>' : '')
    + '<li>Never shave a double coat to reduce shedding — it disrupts insulation and can permanently damage regrowth.</li>'
    + '<li>An omega-3 rich diet supports skin health and can reduce excess shedding caused by dryness.</li>'
    + '<li>Brush in a well-ventilated area or outdoors during peak season — it gets messy.</li>'
    + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';
  }, 650);
}

// ── Dog Ear Cleaning Guide
function pzGenEarCleaning() {
  var shape = document.getElementById('pz_ear_shape')?.value || 'floppy';
  var water = document.getElementById('pz_ear_water')?.value || 'no';
  var history = document.getElementById('pz_ear_history')?.value || 'no';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', "Matching your dog's ear care needs…");
  setTimeout(function() {

  var baseWeeks = shape === 'floppy' ? 2 : 4;
  if (water === 'yes') baseWeeks = Math.max(1, baseWeeks - 1);
  if (history === 'yes') baseWeeks = Math.max(1, baseWeeks - 1);
  var checkFreq = shape === 'floppy' ? 'Weekly' : 'Every 2–4 weeks';

  result.style.display = 'block';
  result.innerHTML =
    '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:linear-gradient(135deg,#1B5E20,#2E7D32);color:#fff;padding:28px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">✅ Your Ear Care Schedule</div>'
    + '<div class="pz-result-number">' + baseWeeks + '</div>'
    + '<div class="pz-result-unit">week' + (baseWeeks > 1 ? 's' : '') + ' between cleanings</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Ear Type</div><div class="pz-result-cell-val" style="font-size:13px;text-transform:capitalize">' + shape + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Check Frequency</div><div class="pz-result-cell-val" style="font-size:12px">' + checkFreq + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Risk Level</div><div class="pz-result-cell-val" style="font-size:13px">' + (water==='yes'||history==='yes' ? 'Elevated' : 'Standard') + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Ear Care Notes</h4><ul>'
    + (history === 'yes' ? '<li>With a past infection history, ask your vet about a vet-formulated preventive ear cleaner rather than a generic one.</li>' : '')
    + (water === 'yes' ? '<li>Dry ears thoroughly with a towel after every swim or bath — trapped moisture is the #1 infection trigger.</li>' : '')
    + '<li>Use a vet-formulated ear cleaner — never cotton swabs, which can push debris deeper into the canal.</li>'
    + "<li>Watch for head shaking, odor, or redness between cleanings — these mean don't wait for the schedule, check now.</li>"
    + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';
  }, 650);
}

// ── Dog Teeth Brushing Guide
function pzGenTeethBrushing() {
  var current = document.getElementById('pz_teeth_current')?.value || 'never';
  var age = document.getElementById('pz_teeth_age')?.value || 'adult';
  var tartar = document.getElementById('pz_teeth_tartar')?.value || 'no';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Building your dental care plan…');
  setTimeout(function() {

  var plans = {
    never: ['Week 1–2: Finger-rub gums daily (no brush yet)', 'Week 3–4: Introduce dog toothpaste on your finger', 'Week 5+: Add a soft brush, aim for every other day', 'Ongoing goal: daily brushing'],
    rare: ['Week 1–2: Add dog toothpaste to your current sessions', 'Week 3+: Increase to every other day', 'Ongoing goal: daily brushing'],
    weekly: ['This week: add one more session to reach every other day', 'Ongoing goal: daily brushing'],
    daily: ["You're already at the ideal frequency — keep it up", 'Consider a dental chew as a supplement, not a replacement']
  };
  var plan = plans[current] || plans.never;

  result.style.display = 'block';
  result.innerHTML =
    '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
    + '<div style="background:linear-gradient(135deg,#1B5E20,#2E7D32);color:#fff;padding:24px">'
    + '<div style="font-size:13px;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px">🎯 Your Dental Care Plan</div>'
    + '<div style="font-size:20px;font-weight:900">' + (current === 'daily' ? 'Maintain Daily Brushing' : 'Build Toward Daily Brushing') + '</div>'
    + '</div>'
    + (tartar === 'yes' ? '<div class="pz-result-warning" style="margin:16px 20px;border-radius:12px;padding:16px"><strong>⚠️ Visible tartar detected —</strong> a professional vet dental cleaning is recommended before home brushing can catch up. Brushing prevents new tartar; it can\'t remove what\'s already hardened.</div>' : '')
    + '<div class="pz-result-tips"><h4>📋 Your Step-Up Plan</h4><ul>'
    + plan.map(function(p){ return '<li>' + p + '</li>'; }).join('')
    + (age === 'senior' ? '<li>Senior dogs carry more accumulated dental risk — ask your vet about a dental check at your next visit.</li>' : '')
    + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';
  }, 650);
}

// ── Puppy First Grooming Guide
function pzGenPuppyGrooming() {
  var age = document.getElementById('pz_puppy_age')?.value || '12to16';
  var coat = document.getElementById('pz_puppy_coat')?.value || 'short';
  var vaccinated = document.getElementById('pz_puppy_vaccinated')?.value || 'no';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Checking grooming readiness…');
  setTimeout(function() {

  var coatLabel = {short:'Short & Smooth', double:'Double Coat', long:'Long & Silky', curly:'Curly / Wire'}[coat] || 'Short & Smooth';
  var brushRec = {short:'a soft-bristle brush', double:'a soft slicker brush', long:'a wide-tooth comb', curly:'a soft slicker brush'}[coat] || 'a soft-bristle brush';

  result.style.display = 'block';

  if (age === 'under8') {
    result.innerHTML =
      '<div class="pz-result-warning" style="border-radius:16px;overflow:hidden">'
      + '<div style="background:linear-gradient(135deg,#E65100,#FF9800);color:#fff;padding:24px;text-align:center">'
      + '<div style="font-size:40px;margin-bottom:8px">⏳</div>'
      + '<div style="font-size:20px;font-weight:900;margin-bottom:6px">Not Ready for a Real Grooming Session Yet</div>'
      + '<div style="font-size:13px;opacity:.85">Under 8 weeks — handling practice only</div></div>'
      + '<div class="pz-result-tips"><h4>📋 What to Do Instead</h4><ul>'
      + '<li>Gently touch and handle paws, ears, and mouth daily for a few minutes to build comfort with future grooming.</li>'
      + '<li>No bathing or clippers yet — puppies this young can\'t regulate body temperature well and stress easily.</li>'
      + '<li>Check with your vet before any bathing, especially if your puppy came from a shelter or breeder with an unclear health history.</li>'
      + '<li>Pair every handling session with a small treat to build a positive association early.</li>'
      + '</ul></div>'
      + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
      + '</div>';
    return;
  }

  var headline = '', notes = [];
  if (age === '8to12') {
    if (vaccinated === 'yes') {
      headline = 'Ready for a Gentle First Bath & Brush Intro';
      notes.push('Your puppy\'s first shots are done, so a short, gentle bath with lukewarm water and puppy-safe shampoo is okay.');
      notes.push('Keep the first bath under 5 minutes and make it as calm and positive as possible.');
    } else {
      headline = 'Handling & Brushing Only — Wait on the Full Bath';
      notes.push('Hold off on a full bath until your puppy\'s first vaccinations are done — check the exact timing with your vet.');
      notes.push('Continue gentle handling and short brushing sessions with ' + brushRec + ' in the meantime.');
    }
  } else if (age === '12to16') {
    headline = 'Ready for a First Real Grooming Session';
    notes.push('Keep the first full session short (10–15 minutes) with plenty of praise and treats.');
    notes.push('Use ' + brushRec + ' for a ' + coatLabel.toLowerCase() + ' coat, and stop before your puppy gets overwhelmed.');
  } else {
    headline = 'Ready for the Regular Adult Routine';
    notes.push('Your puppy can now transition into the standard adult grooming routine for a ' + coatLabel.toLowerCase() + ' coat.');
    notes.push('Use PetZenAI\'s bathing-frequency calculator and shedding & brushing estimator to dial in the exact schedule for their coat type.');
  }

  var ageLabel = {'8to12':'8–12 weeks', '12to16':'12–16 weeks', '16plus':'16+ weeks'}[age] || age;

  result.innerHTML =
    '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
    + '<div style="background:linear-gradient(135deg,#1B5E20,#2E7D32);color:#fff;padding:24px">'
    + '<div style="font-size:13px;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px">🎯 Your Puppy\'s Grooming Readiness</div>'
    + '<div style="font-size:20px;font-weight:900">' + headline + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Age Group</div><div class="pz-result-cell-val" style="font-size:13px">' + ageLabel + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Coat Type</div><div class="pz-result-cell-val" style="font-size:13px">' + coatLabel + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Vaccine Status</div><div class="pz-result-cell-val" style="font-size:12px">' + (vaccinated === 'yes' ? 'First shots done' : 'Not yet') + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Next Steps</h4><ul>'
    + notes.map(function(n){ return '<li>' + n + '</li>'; }).join('')
    + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';
  }, 650);
}

// ── Dog Coat Type Guide
function pzGenCoatType() {
  var breedInput = document.getElementById('pz_ct_breed');
  var breedName = (breedInput?.value || '').trim();
  var manual = document.getElementById('pz_ct_manual')?.value || 'short';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', "Identifying your dog's coat type…");
  setTimeout(function() {

  var coat = manual, matchedBreed = '';
  if (breedName && breedInput.dataset.breeds) {
    try {
      var map = JSON.parse(breedInput.dataset.breeds);
      var match = Object.keys(map).find(function(n){ return n.toLowerCase() === breedName.toLowerCase(); });
      if (match) { coat = map[match]; matchedBreed = match; }
    } catch(e) {}
  }

  var info = {
    short:    { label:'Short & Smooth', brush:'Weekly', bath:'Every 6–8 weeks', trim:'Rarely needed', trait:'Low-maintenance — natural oils largely self-clean this coat, so over-bathing is the bigger risk than under-brushing.' },
    double:   { label:'Double Coat', brush:'3–4x per week (daily in shedding season)', bath:'Every 6–8 weeks', trim:'Not recommended', trait:'Never shave a double coat — it removes the insulation that regulates both heat and cold and can permanently damage regrowth.' },
    long:     { label:'Long & Silky', brush:'Daily', bath:'Every 3–4 weeks', trim:'Every 6–8 weeks for hygiene areas', trait:'Mats form quickly without daily brushing, especially behind the ears and under the legs.' },
    curly:    { label:'Curly / Wool', brush:'Every other day', bath:'Every 4–6 weeks', trim:'Every 6–8 weeks', trait:'Grows continuously rather than shedding out, so it mats close to the skin fast without regular professional trims.' },
    wire:     { label:'Wire-Haired', brush:'Weekly', bath:'Every 4–6 weeks', trim:'Hand-stripping every 4–6 weeks (preferred over clipping alone)', trait:'Regular clipping alone softens the harsh wire texture over time — hand-stripping preserves it.' },
    hairless: { label:'Hairless', brush:'Minimal — soft cloth only', bath:'Every 1–2 weeks', trim:'Not applicable', trait:'Needs a daily skin moisturizer and sunscreen for sun exposure — skin care replaces coat care entirely.' }
  };
  var d = info[coat] || info.short;

  result.style.display = 'block';
  result.innerHTML =
    '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
    + '<div style="background:linear-gradient(135deg,#1B5E20,#2E7D32);color:#fff;padding:24px">'
    + '<div style="font-size:13px;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px">🎯 Coat Type' + (matchedBreed ? ' — ' + matchedBreed : '') + '</div>'
    + '<div style="font-size:22px;font-weight:900">' + d.label + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Brushing</div><div class="pz-result-cell-val" style="font-size:12px">' + d.brush + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Bathing</div><div class="pz-result-cell-val" style="font-size:12px">' + d.bath + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Pro Trims</div><div class="pz-result-cell-val" style="font-size:12px">' + d.trim + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Care Notes</h4><ul>'
    + '<li>' + d.trait + '</li>'
    + (!matchedBreed && breedName ? '<li>We couldn\'t match "' + breedName + '" to a breed in our list, so this plan uses your manually selected coat type instead.</li>' : '')
    + '<li>For your exact bathing schedule and brushing routine by season, use PetZenAI\'s bathing-frequency calculator and shedding & brushing estimator.</li>'
    + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';
  }, 650);
}

// ── Dog Eye Cleaning Guide
function pzGenEyeCleaning() {
  var face = document.getElementById('pz_eye_face')?.value || 'flat';
  var color = document.getElementById('pz_eye_color')?.value || 'clear';
  var freq = document.getElementById('pz_eye_freq')?.value || 'daily';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Reviewing eye care needs…');
  setTimeout(function() {

  var recFreq = face === 'flat' ? 'Daily' : '2–3x per week';
  var faceLabel = face === 'flat' ? 'Flat-Faced / Brachycephalic' : 'Normal Muzzle';

  var warningHtml = '';
  if (color === 'yellow_green') {
    warningHtml =
      '<div class="pz-result-warning" style="margin:16px 20px;border-radius:12px;padding:16px">'
      + '<strong>⚠️ See your vet —</strong> yellow or green discharge is different from routine tear staining and can signal an eye infection or irritation. Book a vet visit regardless of the cleaning schedule below.'
      + '</div>';
  }

  result.style.display = 'block';
  result.innerHTML =
    '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
    + '<div style="background:linear-gradient(135deg,#1B5E20,#2E7D32);color:#fff;padding:24px">'
    + '<div style="font-size:13px;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px">✅ Your Eye Cleaning Schedule</div>'
    + '<div style="font-size:22px;font-weight:900">' + recFreq + '</div>'
    + '</div>'
    + warningHtml
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Face Shape</div><div class="pz-result-cell-val" style="font-size:12px">' + faceLabel + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Discharge</div><div class="pz-result-cell-val" style="font-size:12px">' + {clear:'Clear / light staining', brown:'Brown staining', yellow_green:'Yellow / green'}[color] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Current Routine</div><div class="pz-result-cell-val" style="font-size:12px">' + {daily:'Already daily', occasional:'Occasional', never:'Never cleaned'}[freq] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Cleaning Tips</h4><ul>'
    + (face === 'flat' ? '<li>Flat-faced breeds trap tears against facial folds — a daily wipe helps prevent both staining and skin irritation underneath.</li>' : '<li>A normal muzzle sheds tears more freely, so 2–3x a week is usually enough unless staining bothers you.</li>')
    + (color === 'brown' ? '<li>For brown staining, use a designated tear-stain remover or wipe — water alone doesn\'t remove the pigment (porphyrin) that causes the discoloration.</li>' : '')
    + '<li>Always wipe outward, away from the corner of the eye, using a fresh section of cloth or wipe for each eye.</li>'
    + (freq === 'never' ? '<li>Starting from zero is fine — begin with the frequency above and watch for any redness or irritation as you introduce cleaning.</li>' : '')
    + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';
  }, 650);
}

// ── Dog Paw Care Guide
function pzGenPawCare() {
  var season = document.getElementById('pz_paw_season')?.value || 'mild';
  var terrain = document.getElementById('pz_paw_terrain')?.value || 'mixed';
  var condition = document.getElementById('pz_paw_condition')?.value || 'no';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Building your paw care routine…');
  setTimeout(function() {

  var seasonLabel = {hot:'Hot Weather', cold:'Cold Weather', mild:'Mild Weather'}[season];
  var terrainLabel = {pavement:'Pavement', trail:'Trails', mixed:'Mixed Terrain'}[terrain];

  var headline = 'Standard Paw Care Routine';
  if (season === 'hot') headline = 'Hot-Weather Paw Protection Routine';
  else if (season === 'cold') headline = 'Cold-Weather Paw Protection Routine';
  if (condition === 'yes') headline = 'Daily Healing Routine for Dry/Cracked Paws';

  var warningHtml = '';
  if (season === 'hot' && (terrain === 'pavement' || terrain === 'mixed')) {
    warningHtml =
      '<div class="pz-result-warning" style="margin:16px 20px;border-radius:12px;padding:16px">'
      + '<strong>⚠️ Pavement burn risk —</strong> hot asphalt can burn paw pads within seconds. Press the back of your hand on the pavement for 5 seconds — if it\'s too hot for your hand, it\'s too hot for your dog\'s paws. Walk early morning or evening instead.'
      + '</div>';
  }

  var tips = [];
  if (season === 'hot') {
    tips.push('Stick to early morning or evening walks when pavement has had time to cool.');
    tips.push('Apply a paw balm before walks to add a layer of protection against hot surfaces.');
  } else if (season === 'cold') {
    tips.push('Apply a paw wax or balm before walks to protect against cold, ice, and road salt.');
    tips.push('Rinse and dry paws after every walk — road salt is an irritant and can be toxic if licked off.');
    tips.push('Check between the toes for ice balls forming, which can be painful and cause limping.');
  } else {
    tips.push('Do a quick visual paw check after walks and apply moisturizer if pads look dry.');
  }
  if (terrain === 'trail') {
    tips.push('Check paws for cuts, thorns, or embedded debris after every trail walk, regardless of season.');
  }
  if (condition === 'yes') {
    tips.push('Apply a dog-safe moisturizing paw balm daily until the cracking clears up.');
    tips.push('If cracking or dryness doesn\'t improve within 1–2 weeks, have your vet check for an allergy or infection — persistent cracking isn\'t always just dryness.');
  } else {
    tips.push('Paws currently look healthy — keep up routine checks after walks so any changes get caught early.');
  }

  result.style.display = 'block';
  result.innerHTML =
    '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
    + '<div style="background:linear-gradient(135deg,#1B5E20,#2E7D32);color:#fff;padding:24px">'
    + '<div style="font-size:13px;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px">🎯 Your Paw Care Plan</div>'
    + '<div style="font-size:20px;font-weight:900">' + headline + '</div>'
    + '</div>'
    + warningHtml
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Season</div><div class="pz-result-cell-val" style="font-size:13px">' + seasonLabel + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Terrain</div><div class="pz-result-cell-val" style="font-size:13px">' + terrainLabel + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Paw Condition</div><div class="pz-result-cell-val" style="font-size:12px">' + (condition === 'yes' ? 'Needs care' : 'Healthy') + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Your Paw Care Tips</h4><ul>'
    + tips.map(function(t){ return '<li>' + t + '</li>'; }).join('')
    + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';
  }, 650);
}

// ── Dog Anal Gland Guide
function pzGenAnalGland() {
  var size = document.getElementById('pz_ag_size')?.value || 'medium';
  var scooting = document.getElementById('pz_ag_scooting')?.value || 'never';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Assessing anal gland care needs…');
  setTimeout(function() {

  var sizeLabel = {small:'Small (under 25 lbs)', medium:'Medium (25–60 lbs)', large:'Large (60+ lbs)'}[size];
  var scootLabel = {never:'Never / rarely', occasional:'Occasionally', frequent:'Frequently'}[scooting];
  var actionLabel = {never:'None needed', occasional:'Monitor + diet check', frequent:'Vet/groomer visit'}[scooting];

  var headline, warningHtml = '';
  if (scooting === 'frequent') {
    headline = 'Book a Vet or Groomer Appointment Soon';
    warningHtml =
      '<div class="pz-result-warning" style="margin:16px 20px;border-radius:12px;padding:16px">'
      + '<strong>⚠️ Leave this to a professional —</strong> frequent scooting or licking is your dog\'s own signal of discomfort. Manual expression done incorrectly can bruise or injure the glands, so this is a job for a vet or professional groomer, not a DIY attempt at home.'
      + '</div>';
  } else if (scooting === 'occasional') {
    headline = 'Monitor & Consider a Diet Check';
  } else {
    headline = 'No Action Needed — Just Stay Aware';
  }

  var tips = ['Most dogs\' anal glands express naturally with firm, regular bowel movements and never need manual help.'];
  if (size === 'small') tips.push('Small breeds are statistically more prone to anal gland issues than large breeds, so it\'s worth staying a little more alert to the signs.');
  if (scooting === 'occasional') tips.push('Ask your vet about a fiber-rich diet or supplement — firmer stool naturally expresses the glands during normal bowel movements.');
  if (scooting === 'frequent') tips.push('Do not attempt manual expression yourself — incorrect technique can cause pain, bruising, or injury. A vet or groomer can do this safely in a couple of minutes.');
  if (scooting === 'never') tips.push('Keep an eye out for the warning signs going forward: scooting, licking or biting near the tail base, or a strong fishy odor.');

  result.style.display = 'block';
  result.innerHTML =
    '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
    + '<div style="background:linear-gradient(135deg,#1B5E20,#2E7D32);color:#fff;padding:24px">'
    + '<div style="font-size:13px;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px">🎯 Your Anal Gland Guidance</div>'
    + '<div style="font-size:20px;font-weight:900">' + headline + '</div>'
    + '</div>'
    + warningHtml
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Breed Size</div><div class="pz-result-cell-val" style="font-size:12px">' + sizeLabel + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Scooting/Licking</div><div class="pz-result-cell-val" style="font-size:12px">' + scootLabel + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Action</div><div class="pz-result-cell-val" style="font-size:12px">' + actionLabel + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 What to Know</h4><ul>'
    + tips.map(function(t){ return '<li>' + t + '</li>'; }).join('')
    + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';
  }, 650);
}

// ── Dog Haircut Styles Guide
function pzGenHaircutStyle() {
  var coat = document.getElementById('pz_style_coat')?.value || 'short';
  var climate = document.getElementById('pz_style_climate')?.value || 'moderate';
  var time = document.getElementById('pz_style_time')?.value || 'medium';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Finding the right haircut style…');
  setTimeout(function() {

  var style, interval, tips = [];

  if (coat === 'double') {
    style = 'Deshedding Treatment, No Cut';
    interval = 'Every 8–10 weeks (plus daily brushing during seasonal shedding)';
    tips.push('Never shave a double coat — it removes the insulation that regulates both heat and cold, doesn\'t actually cool the dog effectively, and can permanently damage how the coat regrows.');
    if (climate === 'hot') tips.push('In hot climates, a professional deshedding treatment clears out the undercoat that traps heat — this does more for cooling than a shave-down ever would.');
  } else if (coat === 'curly') {
    if (time === 'low') { style = 'Puppy Cut'; interval = 'Every 6–8 weeks'; tips.push('A short, even puppy cut keeps a curly coat mat-free with only occasional brushing between visits.'); }
    else if (time === 'medium') { style = 'Teddy Bear Trim'; interval = 'Every 6–8 weeks'; tips.push('The Teddy Bear Trim keeps a bit more length on the face and legs while staying manageable with a few brushing sessions a week.'); }
    else { style = 'Longer Curly Trim (Show-Length)'; interval = 'Every 5–6 weeks'; tips.push('Keeping the curls longer looks great but mats faster — daily brushing and a shorter interval between trims are what make it work.'); }
  } else if (coat === 'long') {
    if (time === 'high') { style = 'Breed-Standard Length (Natural Long Coat)'; interval = 'Every 8–10 weeks (sanitary trim only)'; tips.push('With daily brushing, you can maintain the coat at its natural long length — the professional visit is just for hygiene-area trims, not a haircut.'); }
    else { style = 'Teddy Bear Trim (Shorter Practical Length)'; interval = 'Every 6–8 weeks'; tips.push('A shorter, even trim is far more forgiving than a full long coat if daily brushing isn\'t realistic for you.'); }
  } else {
    style = 'Natural Short Coat (No Cut Needed)';
    interval = 'N/A — hygiene trim only if needed, every 8–10 weeks';
    tips.push('Short coats don\'t need a "style" — they keep their natural length and just need regular brushing and bathing.');
  }

  if (climate === 'cold' && coat !== 'short') tips.push('In cold climates, avoid clipping too short right before winter — a bit of extra length adds warmth.');
  if (climate === 'hot' && coat !== 'double') tips.push('In hot climates, avoid shaving down to bare skin — it removes sun protection and can lead to sunburn.');

  var coatLabel = {short:'Short & Smooth', double:'Double Coat', long:'Long & Silky', curly:'Curly / Wire'}[coat] || coat;
  var climateLabel = {hot:'Hot', cold:'Cold', moderate:'Moderate'}[climate] || climate;

  result.style.display = 'block';
  result.innerHTML =
    '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
    + '<div style="background:linear-gradient(135deg,#1B5E20,#2E7D32);color:#fff;padding:24px">'
    + '<div style="font-size:13px;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px">🎯 Recommended Style</div>'
    + '<div style="font-size:22px;font-weight:900">' + style + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Coat Type</div><div class="pz-result-cell-val" style="font-size:12px">' + coatLabel + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Climate</div><div class="pz-result-cell-val" style="font-size:12px">' + climateLabel + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Pro Visit Interval</div><div class="pz-result-cell-val" style="font-size:11px">' + interval + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Style Notes</h4><ul>'
    + tips.map(function(tp){ return '<li>' + tp + '</li>'; }).join('')
    + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';
  }, 650);
}

// ── Long-Haired Dog Grooming Guide
function pzGenLongHairedGrooming() {
  var texture = document.getElementById('pz_lh_texture')?.value || 'silky';
  var mats = document.getElementById('pz_lh_mats')?.value || 'rare';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Planning your coat maintenance…');
  setTimeout(function() {

  var textureInfo = {
    silky: { label: 'Silky', base: 'Daily', technique: 'Use a metal comb after a light detangling spray.' },
    wooly: { label: 'Wooly / Cottony', base: 'Daily', technique: 'Mats fastest of the three — use line-brushing: brush in sections down to the skin, not just the surface.' },
    double_long: { label: 'Long Double Coat', base: 'Every other day', technique: 'Focus on the feathering areas — ears, legs, tail, and britches — where mats form first.' }
  };
  var t = textureInfo[texture] || textureInfo.silky;
  var interval = mats === 'frequent' ? 'Daily' : t.base;

  var warningHtml = '';
  if (mats === 'frequent') {
    warningHtml =
      '<div class="pz-result-warning" style="margin:16px 20px;border-radius:12px;padding:16px">'
      + '<strong>⚠️ Book a professional de-matting session —</strong> frequent or large mats close to the skin can hide irritation or infection underneath, and pulling them out at home risks hurting your dog. Shorten your brushing interval to daily starting now and let a groomer handle the existing mats.'
      + '</div>';
  }

  result.style.display = 'block';
  result.innerHTML =
    '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
    + '<div style="background:linear-gradient(135deg,#1B5E20,#2E7D32);color:#fff;padding:24px">'
    + '<div style="font-size:13px;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px">🎯 Your Brushing Plan — ' + t.label + '</div>'
    + '<div style="font-size:22px;font-weight:900">' + interval + ' Brushing</div>'
    + '</div>'
    + warningHtml
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Coat Texture</div><div class="pz-result-cell-val" style="font-size:12px">' + t.label + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Mat Frequency</div><div class="pz-result-cell-val" style="font-size:12px">' + {rare:'Rare', occasional:'Occasional', frequent:'Frequent'}[mats] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Interval</div><div class="pz-result-cell-val" style="font-size:12px">' + interval + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Technique & Tips</h4><ul>'
    + '<li>' + t.technique + '</li>'
    + '<li>Always brush in the direction of hair growth, working in layers/sections — never just the top coat.</li>'
    + (mats === 'occasional' ? '<li>Occasional small mats are normal — catch them early with a comb before they tighten against the skin.</li>' : '')
    + (mats === 'rare' ? '<li>You\'re on a good routine — keep it consistent, especially in high-friction spots like behind the ears and under the collar.</li>' : '')
    + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';
  }, 650);
}

// ── Dog Deshedding Guide
function pzGenDeshedding() {
  var coat = document.getElementById('pz_ds_coat')?.value || 'short';
  var severity = document.getElementById('pz_ds_severity')?.value || 'moderate';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Matching deshedding tools…');
  setTimeout(function() {

  var coatLabel = {short:'Short & Smooth', double:'Double Coat', long:'Long & Silky', curly:'Curly / Wire'}[coat] || coat;
  var toolRec = {
    short: 'Rubber curry brush or grooming glove',
    double: 'Undercoat rake or deshedding comb (never a blade near skin)',
    long: 'Slicker brush + wide-tooth comb — avoid deshedding blades, they can cut the topcoat',
    curly: "Slicker brush — deshedding tools aren't very effective since curly coats don't shed out the same way, regular trims matter more"
  }[coat] || 'Slicker brush';
  var freqLabel = {light:'Weekly', moderate:'2–3x per week', heavy:'Daily'}[severity] || '2–3x per week';
  var severityLabel = {light:'Light', moderate:'Moderate', heavy:'Heavy'}[severity] || 'Moderate';

  var tips = [];
  tips.push('Your best-matched tool: ' + toolRec + '.');
  if (severity === 'heavy') tips.push("Heavy shedding usually eases up after a couple of weeks of daily attention — it doesn't have to stay this frequent forever.");
  if (coat === 'double') tips.push('Never shave a double coat to deal with shedding — it removes the insulation that regulates both heat and cold and can permanently change how the coat regrows.');
  tips.push('Deshedding rakes or blades can nick skin or damage a single coat if used incorrectly — ask a groomer to demo the proper technique the first time you use one.');

  result.style.display = 'block';
  result.innerHTML =
    '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
    + '<div style="background:linear-gradient(135deg,#1B5E20,#2E7D32);color:#fff;padding:24px">'
    + '<div style="font-size:13px;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px">🎯 Your Deshedding Routine</div>'
    + '<div style="font-size:20px;font-weight:900">' + freqLabel + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Coat Type</div><div class="pz-result-cell-val" style="font-size:13px">' + coatLabel + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Severity</div><div class="pz-result-cell-val" style="font-size:13px">' + severityLabel + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Best Tool</div><div class="pz-result-cell-val" style="font-size:11px">' + toolRec.split(' — ')[0].split(' (')[0] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Deshedding Tips</h4><ul>'
    + tips.map(function(t){ return '<li>' + t + '</li>'; }).join('')
    + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';
  }, 650);
}

// ── Dog Grooming Tools (Kit Builder) Guide
function pzGenGroomingTools() {
  var coat = document.getElementById('pz_gt_coat')?.value || 'short';
  var budget = document.getElementById('pz_gt_budget')?.value || 'standard';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Building your grooming kit…');
  setTimeout(function() {

  var coatLabel = {short:'Short & Smooth', double:'Double Coat', long:'Long & Silky', curly:'Curly / Wire'}[coat] || coat;
  var brush = {short:'Slicker brush or rubber curry brush', double:'Undercoat rake', long:'Slicker brush + wide-tooth comb', curly:'Slicker brush + detangling spray'}[coat] || 'Slicker brush';

  var basicItems = [brush, 'Nail clippers or grinder', 'Dog-specific shampoo'];
  var standardItems = ['Ear cleaning solution & cotton balls', 'Dog toothbrush & dog-safe toothpaste', 'Detangling spray'];
  var premiumItems = ['Clipper/trimmer set', 'Grooming table or non-slip mat', 'High-velocity dryer'];

  var items = basicItems.slice();
  if (budget === 'standard' || budget === 'premium') items = items.concat(standardItems);
  if (budget === 'premium') items = items.concat(premiumItems);

  var budgetLabel = {basic:'Basic', standard:'Standard', premium:'Premium'}[budget] || 'Standard';
  var listHtml = '<li><strong>Basic —</strong> ' + basicItems.join(', ') + '</li>';
  if (budget === 'standard' || budget === 'premium') listHtml += '<li><strong>Standard —</strong> ' + standardItems.join(', ') + '</li>';
  if (budget === 'premium') listHtml += '<li><strong>Premium —</strong> ' + premiumItems.join(', ') + '</li>';

  var tips = [];
  tips.push('This checklist is matched to your dog\'s coat type — using the wrong brush is the #1 reason home grooming tools feel like they don\'t work.');
  if (budget === 'basic') tips.push('A basic kit covers routine upkeep between grooming appointments — move up to standard or premium for full at-home hygiene and haircuts.');
  if (budget === 'premium') tips.push('This is a complete home-grooming setup — with practice you can maintain nearly everything at home.');
  if (coat === 'curly') tips.push('Curly coats grow continuously and need a professional trim on a schedule regardless of how complete your home kit is.');

  result.style.display = 'block';
  result.innerHTML =
    '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
    + '<div style="background:linear-gradient(135deg,#1B5E20,#2E7D32);color:#fff;padding:24px">'
    + '<div style="font-size:13px;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px">🛒 Your Grooming Kit</div>'
    + '<div style="font-size:20px;font-weight:900">' + budgetLabel + ' Kit — ' + items.length + ' Items</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Coat Type</div><div class="pz-result-cell-val" style="font-size:13px">' + coatLabel + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Budget Tier</div><div class="pz-result-cell-val" style="font-size:13px">' + budgetLabel + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Total Items</div><div class="pz-result-cell-val">' + items.length + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>🧰 Your Checklist</h4><ul>' + listHtml + '</ul></div>'
    + '<div class="pz-result-tips"><h4>📋 Notes</h4><ul>'
    + tips.map(function(t){ return '<li>' + t + '</li>'; }).join('')
    + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';
  }, 650);
}

// ── Dog Winter Coat Care Guide
function pzGenWinterCoatCare() {
  var coat = document.getElementById('pz_wc_coat')?.value || 'short';
  var outdoor = document.getElementById('pz_wc_outdoor')?.value || 'moderate';
  var heating = document.getElementById('pz_wc_heating')?.value || 'no';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Planning winter coat care…');
  setTimeout(function() {

  var coatLabel = {short:'Short & Smooth', double:'Double Coat', long:'Long & Silky', curly:'Curly / Wire'}[coat] || coat;
  var outdoorLabel = {minimal:'Minimal', moderate:'Moderate', extensive:'Extensive'}[outdoor] || 'Moderate';
  var heatingLabel = heating === 'yes' ? 'Dries the air' : 'Not an issue';

  var tips = [];
  tips.push('Stretch your normal bathing interval by about 2 weeks in winter and add a moisturizing conditioner — cold air combined with frequent bathing dries and cracks skin.');

  if (outdoor === 'extensive') {
    tips.push('Apply a paw wax or balm before walks and rinse paws after — road salt and ice-melt chemicals irritate skin and are mildly toxic if licked off.');
    tips.push('Check between the toe pads for ice balls after walks' + (coat === 'long' || coat === 'curly' ? ' — this matters even more with a ' + coatLabel.toLowerCase() + ', where ice clings to the longer fur.' : '.'));
  } else if (outdoor === 'moderate') {
    tips.push('Even with regular walks, a quick paw wax before outings and a rinse after helps guard against salt and ice irritation.');
  } else {
    tips.push('With mostly quick bathroom breaks, paw protection matters less, but still wipe paws if they\'ve touched salted sidewalks.');
  }

  if (heating === 'yes') tips.push("Dry indoor heating air can flake and irritate skin — a humidifier near your dog's bed or an omega-3 supplement both help combat this.");
  if (coat === 'double') tips.push("Your dog's undercoat is natural winter insulation — never shave or cut it short in winter, it's doing exactly the job it's meant to.");

  result.style.display = 'block';
  result.innerHTML =
    '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
    + '<div style="background:linear-gradient(135deg,#1B5E20,#2E7D32);color:#fff;padding:24px">'
    + '<div style="font-size:13px;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px">❄️ Your Winter Care Plan</div>'
    + '<div style="font-size:20px;font-weight:900">Bathe Less, Protect Paws More</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Coat Type</div><div class="pz-result-cell-val" style="font-size:13px">' + coatLabel + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Outdoor Cold Time</div><div class="pz-result-cell-val" style="font-size:13px">' + outdoorLabel + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Indoor Air</div><div class="pz-result-cell-val" style="font-size:12px">' + heatingLabel + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Winter Care Tips</h4><ul>'
    + tips.map(function(t){ return '<li>' + t + '</li>'; }).join('')
    + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';
  }, 650);
}

// ── Dog Summer Grooming Guide
function pzGenSummerGrooming() {
  var coat = document.getElementById('pz_sg_coat')?.value || 'short';
  var climate = document.getElementById('pz_sg_climate')?.value || 'moderate';
  var activity = document.getElementById('pz_sg_activity')?.value || 'low';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Planning summer cooling routine…');
  setTimeout(function() {

  var coatLabel = {short:'Short & Smooth', double:'Double Coat', long:'Long & Silky', curly:'Curly / Wire'}[coat] || coat;
  var climateLabel = {hot_humid:'Hot & Humid', hot_dry:'Hot & Dry', moderate:'Moderate Summer'}[climate] || climate;
  var activityLabel = activity === 'high' ? 'Lots of Outdoor Activity' : 'Mostly Indoor/Shaded';
  var isHot = climate === 'hot_humid' || climate === 'hot_dry';

  var headline = coat === 'double' ? 'Brush More, Never Shave' : 'Your Summer Grooming Plan';

  var warningHtml = '';
  if (activity === 'high' && isHot) {
    warningHtml =
      '<div class="pz-result-warning" style="margin:16px 20px;border-radius:12px;padding:16px">'
      + '<strong>⚠️ Heat safety check —</strong> press the back of your hand on the pavement for 5 seconds; if it\'s too hot for your hand, it\'s too hot for your dog\'s paws. Walk in the early morning or evening instead. Watch for heatstroke signs: excessive panting, drooling, weakness, or collapse — get your dog to shade and water immediately, and see a vet if it doesn\'t resolve quickly.'
      + '</div>';
  }

  var tips = [];
  if (coat === 'double') {
    tips.push("Shaving doesn't cool a double-coated dog effectively — it removes UV protection and insulation, and can cause permanent damage to how the coat regrows (sometimes called clipper alopecia).");
    tips.push('Brush more often instead to clear loose undercoat and improve natural airflow, and shorten your bathing interval modestly.');
  }
  if (climate === 'hot_humid') {
    tips.push('Watch for hot spots from trapped moisture in humid heat — dry the coat thoroughly after any bath or swim.');
  }
  if (activity === 'high' && isHot) {
    tips.push('Stick to early morning or evening walks when pavement has had time to cool.');
  }
  if (!tips.length) tips.push('Keep up your normal coat-appropriate brushing and bathing routine — no special summer adjustments needed for this combination.');

  result.style.display = 'block';
  result.innerHTML =
    '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
    + '<div style="background:linear-gradient(135deg,#1B5E20,#2E7D32);color:#fff;padding:24px">'
    + '<div style="font-size:13px;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px">☀️ Your Summer Plan</div>'
    + '<div style="font-size:20px;font-weight:900">' + headline + '</div>'
    + '</div>'
    + warningHtml
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Coat Type</div><div class="pz-result-cell-val" style="font-size:13px">' + coatLabel + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Climate</div><div class="pz-result-cell-val" style="font-size:12px">' + climateLabel + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Activity</div><div class="pz-result-cell-val" style="font-size:11px">' + activityLabel + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Summer Grooming Tips</h4><ul>'
    + tips.map(function(t){ return '<li>' + t + '</li>'; }).join('')
    + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';
  }, 650);
}

// ── Dog Mat Removal Guide
function pzGenMatRemoval() {
  var size = document.getElementById('pz_mat_size')?.value || 'medium';
  var location = document.getElementById('pz_mat_location')?.value || 'body';
  var coat = document.getElementById('pz_mat_coat')?.value || 'short';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Assessing mat severity…');
  setTimeout(function() {

  var sizeLabel = {small:'Small', medium:'Medium', large:'Large'}[size] || 'Medium';
  var locationLabel = {body:'On the Body', ears_legs:'Ears/Legs/Armpits', widespread:'Widespread'}[location] || 'On the Body';
  var coatLabel = {short:'Short & Smooth', double:'Double Coat', long:'Long & Silky', curly:'Curly / Wire'}[coat] || coat;

  var needsPro = size === 'large' || location === 'widespread';
  var isDiy = size === 'small' && !needsPro;

  var preventionTip = (coat === 'double' || coat === 'long' || coat === 'curly')
    ? ('A ' + coatLabel.toLowerCase() + ' mats more easily than a short coat, so more frequent brushing is the best way to prevent this from recurring — check your coat\'s brushing routine to catch mats before they set in.')
    : 'Short coats rarely mat, but keep an eye on friction zones like the collar area and under the legs.';

  result.style.display = 'block';

  if (needsPro) {
    result.innerHTML =
      '<div class="pz-result-warning" style="border-radius:16px;overflow:hidden">'
      + '<div style="background:linear-gradient(135deg,#E65100,#FF9800);color:#fff;padding:24px;text-align:center">'
      + '<div style="font-size:40px;margin-bottom:8px">⚠️</div>'
      + '<div style="font-size:20px;font-weight:900;margin-bottom:6px">See a Professional Groomer</div>'
      + '<div style="font-size:13px;opacity:.85">' + sizeLabel + ' mat(s) · ' + locationLabel + '</div></div>'
      + '<div class="pz-result-grid">'
      + '<div class="pz-result-cell"><div class="pz-result-cell-label">Mat Size</div><div class="pz-result-cell-val" style="font-size:13px">' + sizeLabel + '</div></div>'
      + '<div class="pz-result-cell"><div class="pz-result-cell-label">Location</div><div class="pz-result-cell-val" style="font-size:11px">' + locationLabel + '</div></div>'
      + '<div class="pz-result-cell"><div class="pz-result-cell-label">Coat Type</div><div class="pz-result-cell-val" style="font-size:13px">' + coatLabel + '</div></div>'
      + '</div>'
      + '<div class="pz-result-tips"><h4>📋 Why a Professional</h4><ul>'
      + '<li>Pelted coats matted close to the skin can hide skin infections or hot spots underneath that you can\'t see from the outside.</li>'
      + '<li>Removing large or widespread mats at home risks cutting or injuring your dog — a professional groomer\'s clippers can safely do what scissors or combs can\'t.</li>'
      + '<li>' + preventionTip + '</li>'
      + '</ul></div>'
      + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
      + '</div>';
    return;
  }

  var headline = isDiy ? 'Safe to Remove at Home' : 'DIY Possible — Go Slow & Careful';
  var tips = [];
  if (isDiy) {
    tips.push('Loosen the mat from the edges inward using your fingers first, then use a mat comb or dematting tool.');
    tips.push('Work over several short sessions rather than forcing it in one sitting, and never cut close to the skin.');
  } else {
    tips.push('A detangling spray helps loosen the fibers before combing through medium-sized mats.');
    tips.push('If you use scissors, hold them PARALLEL to the skin, never perpendicular — matted skin often tents upward inside the mat and is easy to nick.');
    tips.push('Work in several short sessions rather than one long one, and stop if your dog seems uncomfortable.');
  }
  tips.push(preventionTip);

  result.innerHTML =
    '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
    + '<div style="background:linear-gradient(135deg,#1B5E20,#2E7D32);color:#fff;padding:24px">'
    + '<div style="font-size:13px;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px">🎯 Mat Assessment</div>'
    + '<div style="font-size:20px;font-weight:900">' + headline + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Mat Size</div><div class="pz-result-cell-val" style="font-size:13px">' + sizeLabel + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Location</div><div class="pz-result-cell-val" style="font-size:11px">' + locationLabel + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Coat Type</div><div class="pz-result-cell-val" style="font-size:13px">' + coatLabel + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Removal & Prevention Tips</h4><ul>'
    + tips.map(function(t){ return '<li>' + t + '</li>'; }).join('')
    + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';
  }, 650);
}

// ── Dog Tail Grooming Guide
function pzGenTailGrooming() {
  var coat = document.getElementById('pz_tail_coat')?.value || 'short';
  var density = document.getElementById('pz_tail_density')?.value || 'light';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Building your tail care plan…');
  setTimeout(function() {

  var coatLabel = {short:'Short & Smooth', double:'Double Coat', long:'Long & Silky', curly:'Curly / Wire'}[coat] || coat;
  var densityLabel = density === 'heavy' ? 'Heavy Feathering' : 'Light Coat';
  var isHeavy = density === 'heavy';

  var headline = isHeavy ? 'Extra Attention Needed at the Tail Base' : 'Minimal Tail-Specific Care Needed';
  var focus = isHeavy ? 'Base of tail + underside' : 'Normal body routine';

  var tips = [];
  if (isHeavy) {
    tips.push('Brush the base of the tail and the spot that touches the ground when sitting more often than the rest of the body, even if your body coat is on a longer brushing interval — this is the highest mat-risk area on a heavily feathered tail.');
    tips.push('Check and clean the fur just under the tail, near the anus, for tangles or trapped debris — this matters even more after any loose-stool episode, to prevent skin irritation.');
  } else {
    tips.push('A light coat has minimal mat risk at the tail — a quick check during your regular brushing session is enough, no separate routine needed.');
    tips.push('Still worth a glance under the tail occasionally for cleanliness, especially after a looser stool.');
  }

  result.style.display = 'block';
  result.innerHTML =
    '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
    + '<div style="background:linear-gradient(135deg,#1B5E20,#2E7D32);color:#fff;padding:24px">'
    + '<div style="font-size:13px;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px">🎯 Your Tail Care Plan</div>'
    + '<div style="font-size:20px;font-weight:900">' + headline + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Coat Type</div><div class="pz-result-cell-val" style="font-size:13px">' + coatLabel + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Tail Density</div><div class="pz-result-cell-val" style="font-size:12px">' + densityLabel + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Focus Area</div><div class="pz-result-cell-val" style="font-size:11px">' + focus + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Tail Care Tips</h4><ul>'
    + tips.map(function(t){ return '<li>' + t + '</li>'; }).join('')
    + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';
  }, 650);
}

// ── Professional vs Home Grooming Guide
function pzGenProVsHome() {
  var coat = document.getElementById('pz_pvh_coat')?.value || 'short';
  var time = document.getElementById('pz_pvh_time')?.value || 'medium';
  var budget = document.getElementById('pz_pvh_budget')?.value || 'medium';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Comparing your grooming options…');
  setTimeout(function() {

  var coatLabel = {short:'Short & Smooth', double:'Double Coat', long:'Long & Silky', curly:'Curly / Wire'}[coat] || coat;
  var timeLabel = {low:'Under 30 min/week', medium:'30–60 min/week', high:'1+ hour/week'}[time] || time;
  var budgetLabel = {low:'Minimize Cost', medium:'Moderate Budget', high:'Budget Flexible'}[budget] || budget;
  var highDependency = (coat === 'curly' || coat === 'long');

  var rec, reasoning;
  if (time === 'low' && highDependency) {
    if (budget === 'low') {
      rec = 'Hybrid';
      reasoning = 'With low time and a tight budget, a hybrid approach makes the most sense — a good coat-appropriate brush is the single best investment either way, professional or hybrid.';
    } else {
      rec = 'Professional';
      reasoning = 'With under 30 minutes a week for a ' + coatLabel.toLowerCase() + ', professional grooming (roughly $40–90 per visit, typically every 4–8 weeks) keeps up with what this coat actually needs.';
    }
  } else if (time === 'high') {
    rec = 'Home';
    reasoning = 'With an hour or more a week, mostly home care — with occasional professional visits just for nail trims or a haircut — is realistic and the cheapest long-term option.';
  } else if (time === 'medium') {
    rec = 'Hybrid';
    reasoning = 'With 30–60 minutes a week, mixing home maintenance brushing and bathing with periodic professional trims is the most balanced fit.';
  } else if (time === 'low' && coat === 'double') {
    rec = 'Hybrid';
    reasoning = 'With limited time, home brushing plus an occasional professional deshedding session keeps a double coat manageable without a full professional commitment.';
  } else {
    rec = 'Home';
    reasoning = 'Short coats need very little upkeep, so home care alone comfortably covers it even with limited time.';
  }

  var costCells = [
    { key: 'Home', val: '~$50–150 one-time + supplies' },
    { key: 'Professional', val: '~$480–1,200/year' },
    { key: 'Hybrid', val: '~$200–500/year' }
  ];

  var gridHtml = costCells.map(function(c) {
    var isRec = c.key === rec;
    return '<div class="pz-result-cell"><div class="pz-result-cell-label">' + (isRec ? '✅ ' : '') + c.key + '</div><div class="pz-result-cell-val" style="font-size:12px">' + c.val + '</div></div>';
  }).join('');

  var tips = [];
  if (coat === 'curly' || coat === 'long') tips.push('Curly and long coats have higher "professional dependency" — they need periodic professional trims or deshedding no matter how much home effort goes in.');
  else if (coat === 'double') tips.push('Double coats are DIY-able for brushing, but benefit from an occasional professional deshedding session.');
  else tips.push('Short coats are the most fully DIY-able coat type of all.');
  tips.push('Your time budget (' + timeLabel + ') and cost preference (' + budgetLabel + ') were both factored into this recommendation.');

  result.style.display = 'block';
  result.innerHTML =
    '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
    + '<div style="background:linear-gradient(135deg,#1B5E20,#2E7D32);color:#fff;padding:24px;text-align:center">'
    + '<div style="font-size:13px;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px">🎯 Recommended Approach</div>'
    + '<div style="font-size:28px;font-weight:900">' + rec + '</div>'
    + '<div style="font-size:13px;opacity:.85;margin-top:10px;max-width:480px;margin-left:auto;margin-right:auto">' + reasoning + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">' + gridHtml + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Why This Fits</h4><ul>'
    + tips.map(function(t){ return '<li>' + t + '</li>'; }).join('')
    + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';
  }, 650);
}

// ── Bathing Wizard: step navigation
var pzWizCurrentStep = 0;
var pzWizTotalSteps = 4;
function pzWizStep(dir) {
  var wizard = document.getElementById('pz-wizard');
  if (!wizard) return;
  var next = pzWizCurrentStep + dir;
  if (next < 0) return;

  if (next >= pzWizTotalSteps) {
    pzCalcBathingFrequency();
    return;
  }

  wizard.querySelector('.pz-wizard-step[data-step="' + pzWizCurrentStep + '"]').classList.remove('active');
  wizard.querySelector('.pz-wizard-step[data-step="' + next + '"]').classList.add('active');

  wizard.querySelectorAll('.pz-wiz-steplabel').forEach(function(el) {
    var s = parseInt(el.dataset.step, 10);
    el.classList.toggle('active', s === next);
    el.classList.toggle('done', s < next);
  });

  var fill = document.getElementById('pz-wiz-fill');
  if (fill) fill.style.width = Math.round(((next + 1) / pzWizTotalSteps) * 100) + '%';

  var backBtn = document.getElementById('pz-wiz-back');
  var nextBtn = document.getElementById('pz-wiz-next');
  if (backBtn) backBtn.disabled = (next === 0);
  if (nextBtn) nextBtn.innerHTML = (next === pzWizTotalSteps - 1) ? '<span class="pz-int-btn-icon">🛁</span> Get My Bath Schedule' : 'Next';

  pzWizCurrentStep = next;
  var result = document.getElementById('pz-calc-result');
  if (result) { result.style.display = 'none'; result.innerHTML = ''; }
}

// ── Coat type card selection
function pzSelectCoat(el) {
  document.querySelectorAll('#pz_coat_grid .pz-coat-card').forEach(function(c){ c.classList.remove('active'); });
  el.classList.add('active');
  document.getElementById('pz_coat_type').value = el.dataset.val;
}

// ── Breed search (60+ breeds, embedded via data-breeds on #pz-wizard)
function pzBreedSearchInit() {
  var input = document.getElementById('pz_breed_search');
  var wizard = document.getElementById('pz-wizard');
  var box = document.getElementById('pz_breed_results');
  if (!input || !wizard || !box) return;
  var breeds;
  try { breeds = JSON.parse(wizard.dataset.breeds); } catch(e) { breeds = {}; }
  var names = Object.keys(breeds);

  input.addEventListener('input', function() {
    var q = input.value.toLowerCase().trim();
    if (q.length < 2) { box.hidden = true; return; }
    var hits = names.filter(function(n){ return n.toLowerCase().indexOf(q) > -1; }).slice(0, 6);
    if (!hits.length) { box.innerHTML = '<div class="pz-breed-result-item">No match — pick a coat type below</div>'; box.hidden = false; return; }
    box.innerHTML = hits.map(function(n) {
      return '<div class="pz-breed-result-item" data-breed="' + n.replace(/"/g,'') + '" data-coat="' + breeds[n] + '">' + n + '<span>' + breeds[n] + '</span></div>';
    }).join('');
    box.hidden = false;
    box.querySelectorAll('.pz-breed-result-item[data-coat]').forEach(function(item) {
      item.addEventListener('click', function() {
        input.value = item.dataset.breed;
        var coat = item.dataset.coat;
        document.getElementById('pz_coat_type').value = coat;
        document.querySelectorAll('#pz_coat_grid .pz-coat-card').forEach(function(c) {
          c.classList.toggle('active', c.dataset.val === coat);
        });
        box.hidden = true;
      });
    });
  });
  document.addEventListener('click', function(e) {
    if (!box.contains(e.target) && e.target !== input) box.hidden = true;
  });
}
document.addEventListener('DOMContentLoaded', pzBreedSearchInit);

// ── Dog Bathing Frequency Calculator — full wizard result
function pzCalcBathingFrequency() {
  var coat    = document.getElementById('pz_coat_type')?.value || 'short';
  var life    = document.getElementById('pz_lifestyle')?.value || 'outdoor';
  var season  = document.getElementById('pz_season')?.value || 'mild';
  var skin    = document.getElementById('pz_skin_condition')?.value || 'normal';
  var weightRaw = parseFloat(document.getElementById('pz_weight')?.value) || 0;
  var age     = document.getElementById('pz_age')?.value || 'adult';
  var lastBath = document.getElementById('pz_last_bath')?.value || '';
  var allergy = document.getElementById('pz_allergies')?.value || 'no';
  var breedName = document.getElementById('pz_breed_search')?.value || '';
  var result  = document.getElementById('pz-calc-result');
  if (!result) return;
  pzShowAnalyzing('pz-calc-result', "Analyzing your dog's bathing profile…");
  setTimeout(function() {

  // Very young puppies: safety note instead of a numeric schedule
  if (age === 'puppy_young') {
    result.style.display = 'block';
    result.innerHTML = '<div class="pz-result-warning" style="border-radius:16px;padding:24px;text-align:center">'
      + '<div style="font-size:32px;margin-bottom:8px">⚠️</div>'
      + '<strong>Hold off on a full bath.</strong><br><span style="font-size:14px;color:#555">Puppies under 12 weeks aren\'t fully temperature-regulating yet — check with your vet before the first bath, and spot-clean with a damp cloth in the meantime.</span></div>';
    return;
  }

  var baseWeeks   = {short:6, double:8, long:4, curly:4, wire:6, hairless:2}[coat];
  var lifeAdj     = {indoor:1, outdoor:0, muddy:-3}[life];
  var seasonAdj   = {mild:0, hot_humid:-1, cold_dry:1}[season];
  var skinAdj     = {normal:0, dry:2, oily:-2}[skin];
  var allergyAdj  = allergy === 'yes' ? -1 : 0;
  var weeks = Math.max(1, Math.min(10, baseWeeks + lifeAdj + seasonAdj + skinAdj + allergyAdj));
  var lowWeeks = Math.max(1, weeks - 1);
  var highWeeks = weeks + 1;

  var coatLabels = {short:'short/smooth', double:'double-coated', long:'long-haired', curly:'curly/wool', wire:'wire-haired', hairless:'hairless'};

  // Shampoo dosage — diluted 1:4, by weight bracket
  var weightLbs = weightRaw ? (pzUnit === 'kg' ? weightRaw * 2.20462 : weightRaw) : 0;
  var dosage = '';
  if (weightLbs) {
    if (weightLbs < 20) dosage = '1–2 tbsp diluted shampoo';
    else if (weightLbs < 50) dosage = '2–4 tbsp diluted shampoo';
    else if (weightLbs < 90) dosage = '4–6 tbsp diluted shampoo';
    else dosage = '6–8 tbsp diluted shampoo';
  }

  // Next bath date + Google Calendar link
  var nextDateStr = '', calendarLink = '';
  if (lastBath) {
    var d = new Date(lastBath + 'T12:00:00');
    d.setDate(d.getDate() + weeks * 7);
    nextDateStr = d.toLocaleDateString('en-US', { month:'long', day:'numeric', year:'numeric' });
    var y = d.getFullYear(), m = ('0'+(d.getMonth()+1)).slice(-2), day = ('0'+d.getDate()).slice(-2);
    var dEnd = new Date(d); dEnd.setDate(dEnd.getDate()+1);
    var y2=dEnd.getFullYear(), m2=('0'+(dEnd.getMonth()+1)).slice(-2), d2=('0'+dEnd.getDate()).slice(-2);
    calendarLink = 'https://calendar.google.com/calendar/render?action=TEMPLATE&text='
      + encodeURIComponent('🛁 Bathe ' + (breedName || 'your dog'))
      + '&dates=' + y+m+day + '/' + y2+m2+d2
      + '&details=' + encodeURIComponent('Reminder from PetZenAI Bathing Frequency Calculator');
  }

  var notes = [];
  if (skin === 'dry') notes.push('Use a moisturizing, oatmeal-based shampoo — frequent bathing on dry skin can worsen irritation if the product is too harsh.');
  if (skin === 'oily') notes.push('A clarifying or deodorizing shampoo helps manage odor between baths without over-drying the coat.');
  if (life === 'muddy') notes.push('Quick rinses after muddy walks don\'t count as full baths — plain water rinses are fine more often than the shampoo schedule above.');
  if (coat === 'double') notes.push('Never shave a double coat to "reduce bathing" — it disrupts natural insulation and can permanently damage the coat texture.');
  if (coat === 'hairless') notes.push('Hairless breeds have no coat to absorb skin oils, so they need more frequent washing plus daily moisturizer or sunscreen for exposed skin.');
  if (season === 'cold_dry') notes.push('Cold, dry air pulls moisture from skin faster — space out baths and follow with a leave-in conditioner if flaking appears.');
  if (allergy === 'yes') notes.push('Bathing reduces loose dander short-term, but for real allergy relief, pair this with frequent brushing and a HEPA air purifier.');

  result.style.display = 'block';
  result.innerHTML =
    '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:linear-gradient(135deg,#1B5E20,#2E7D32);color:#fff;padding:28px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">✅ Your Bathing Schedule' + (breedName ? ' — ' + breedName : '') + '</div>'
    + '<div class="pz-result-number">' + lowWeeks + '–' + highWeeks + '</div>'
    + '<div class="pz-result-unit">weeks between baths</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Coat Type</div><div class="pz-result-cell-val" style="font-size:13px;text-transform:capitalize">' + coatLabels[coat] + '</div></div>'
    + (dosage ? '<div class="pz-result-cell"><div class="pz-result-cell-label">Shampoo Dose</div><div class="pz-result-cell-val" style="font-size:13px">' + dosage + '</div></div>' : '<div class="pz-result-cell"><div class="pz-result-cell-label">Base Frequency</div><div class="pz-result-cell-val">Every ' + baseWeeks + ' wks</div></div>')
    + (nextDateStr ? '<div class="pz-result-cell"><div class="pz-result-cell-label">Next Bath Due</div><div class="pz-result-cell-val" style="font-size:13px">' + nextDateStr + '</div></div>' : '<div class="pz-result-cell"><div class="pz-result-cell-label">Adjusted For You</div><div class="pz-result-cell-val">Every ' + weeks + ' wks</div></div>')
    + '</div>'
    + '<div class="pz-result-recap"><h4>📝 Your Details</h4><ul>'
    + (breedName ? '<li><strong>Breed:</strong> ' + breedName + '</li>' : '')
    + '<li><strong>Coat Type:</strong> ' + coatLabels[coat] + '</li>'
    + '<li><strong>Lifestyle:</strong> ' + {indoor:'Mostly indoor', outdoor:'Regular outdoor time', muddy:'Frequently muddy / wet'}[life] + '</li>'
    + '<li><strong>Season:</strong> ' + {mild:'Mild', hot_humid:'Hot & humid', cold_dry:'Cold & dry'}[season] + '</li>'
    + '<li><strong>Skin Condition:</strong> ' + {normal:'Normal', dry:'Dry / sensitive', oily:'Oily'}[skin] + '</li>'
    + (weightLbs ? '<li><strong>Weight:</strong> ' + Math.round(weightLbs) + ' lbs</li>' : '')
    + '<li><strong>Age Group:</strong> ' + {puppy_young:'Puppy under 12 weeks', puppy:'Puppy', adult:'Adult', senior:'Senior'}[age] + '</li>'
    + (allergy === 'yes' ? '<li><strong>Allergies / Sensitivities:</strong> Yes</li>' : '')
    + '</ul></div>'
    + '<div class="pz-result-tips"><h4>📋 Notes For Your Dog</h4><ul>'
    + (notes.length ? notes.map(function(n){ return '<li>' + n + '</li>'; }).join('') : '<li>This range fits your dog\'s profile well — no special adjustments needed.</li>')
    + '<li>Between baths, brush regularly to keep the coat clean and distribute natural oils.</li>'
    + '</ul></div>'
    + '<div style="padding:0 20px 20px;display:flex;gap:10px;flex-wrap:wrap">'
    + (calendarLink ? '<a href="' + calendarLink + '" target="_blank" rel="noopener" class="pz-int-btn" style="margin-top:0;text-decoration:none;flex:1">📅 Add Reminder to Calendar</a>' : '')
    + '<button class="pz-int-btn" style="margin-top:0;flex:1;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button>'
    + '</div>'
    + '</div>';
  }, 650);
}

// ── Dog Grooming Schedule Calculator
function pzCalcGroomingSchedule() {
  var coat = document.getElementById('pz_coat_type2')?.value || 'short';
  var size = document.getElementById('pz_breed_size2')?.value || 'medium';
  var ear  = document.getElementById('pz_ear_type')?.value || 'upright';
  var life = document.getElementById('pz_lifestyle2')?.value || 'outdoor';
  var result = document.getElementById('pz-calc-result');
  if (!result) return;
  pzShowAnalyzing('pz-calc-result', 'Building your grooming calendar…');
  setTimeout(function() {

  var brushing = {short:'Weekly', double:'3–4x/week (daily during seasonal shedding)', long:'Daily', curly:'Every other day'}[coat];
  var bathBase = {short:6, double:8, long:4, curly:4}[coat];
  var bathAdj = {indoor:1, outdoor:-2, muddy:-4}[life];
  var bathWeeks = Math.max(1, Math.min(10, bathBase + bathAdj));
  var nailWeeks = (life === 'outdoor' || life === 'muddy') ? '4–6 weeks (regular walking on pavement naturally files nails)' : '3–4 weeks';
  var earFreq = ear === 'floppy' ? 'Weekly check, clean as needed' : 'Monthly check';
  var teeth = 'Daily brushing ideal — minimum 2–3x/week';

  result.style.display = 'block';
  result.innerHTML =
    '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
    + '<div style="background:linear-gradient(135deg,#1B5E20,#2E7D32);color:#fff;padding:24px">'
    + '<div style="font-size:13px;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px">🎯 Your Full Grooming Schedule</div>'
    + '<div style="font-size:20px;font-weight:900">Based on ' + coat + ' coat, ' + size + ' size</div>'
    + '</div>'
    + '<table style="width:100%;border-collapse:collapse;font-size:14px">'
    + '<tr><td style="padding:14px 20px;border-bottom:1px solid #eee;font-weight:700">🖌️ Brushing</td><td style="padding:14px 20px;border-bottom:1px solid #eee;text-align:right">' + brushing + '</td></tr>'
    + '<tr><td style="padding:14px 20px;border-bottom:1px solid #eee;font-weight:700">🛁 Bathing</td><td style="padding:14px 20px;border-bottom:1px solid #eee;text-align:right">Every ' + bathWeeks + ' weeks</td></tr>'
    + '<tr><td style="padding:14px 20px;border-bottom:1px solid #eee;font-weight:700">💅 Nail Trim</td><td style="padding:14px 20px;border-bottom:1px solid #eee;text-align:right">' + nailWeeks + '</td></tr>'
    + '<tr><td style="padding:14px 20px;border-bottom:1px solid #eee;font-weight:700">👂 Ear Cleaning</td><td style="padding:14px 20px;border-bottom:1px solid #eee;text-align:right">' + earFreq + '</td></tr>'
    + '<tr><td style="padding:14px 20px;font-weight:700">🦷 Teeth Brushing</td><td style="padding:14px 20px;text-align:right">' + teeth + '</td></tr>'
    + '</table>'
    + '<div class="pz-result-recap"><h4>📝 Your Details</h4><ul>'
    + '<li><strong>Coat Type:</strong> ' + {short:'Short & smooth', double:'Double coat', long:'Long & silky', curly:'Curly / wool'}[coat] + '</li>'
    + '<li><strong>Breed Size:</strong> ' + {small:'Toy / Small (under 25 lbs)', medium:'Medium (25–60 lbs)', large:'Large / Giant (60+ lbs)'}[size] + '</li>'
    + '<li><strong>Ear Type:</strong> ' + {upright:'Upright', floppy:'Floppy'}[ear] + '</li>'
    + '<li><strong>Lifestyle:</strong> ' + {indoor:'Mostly indoor', outdoor:'Regular outdoor time', muddy:'Frequently muddy / wet'}[life] + '</li>'
    + '</ul></div>'
    + '<div class="pz-result-tips"><h4>📋 Tips</h4><ul>'
    + '<li>Set calendar reminders for bathing and nail trims — brushing and teeth are easiest to keep on a daily habit.</li>'
    + (ear === 'floppy' ? '<li>Floppy ears trap moisture and reduce airflow — check weekly for odor or redness, both early signs of infection.</li>' : '')
    + (coat === 'double' ? '<li>Never shave a double coat — it disrupts insulation and can cause permanent coat damage.</li>' : '')
    + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0" onclick="pzPrintResult()">📥 Download This Result as PDF</button></div>'
    + '</div>';
  }, 650);
}

// ── Print just the result card (used by calculator "Download This Result as PDF" buttons)
function pzPrintResult() {
  document.body.classList.add('pz-printing-result-only');
  window.print();
  setTimeout(function(){ document.body.classList.remove('pz-printing-result-only'); }, 500);
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
  toc.hidden = false;
});
</script>
