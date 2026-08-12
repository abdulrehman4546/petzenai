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

// ── Dog Ideal Weight Calculator
function pzCalcDogWeight() {
  var size = document.getElementById('pz_dw_size')?.value || 'medium';
  var weightRaw = parseFloat(document.getElementById('pz_dw_weight')?.value) || 0;
  var age = document.getElementById('pz_dw_age')?.value || 'adult';
  var result = document.getElementById('pz-calc-result');
  if (!result) return;
  pzShowAnalyzing('pz-calc-result', "Comparing your dog's weight to breed-size ranges…");
  setTimeout(function() {

  if (!weightRaw || weightRaw <= 0) {
    result.style.display = 'block';
    result.innerHTML = '<div class="pz-result-warning" style="border-radius:12px;padding:16px;text-align:center"><strong>⚠️ Please enter your dog\'s current weight.</strong></div>';
    return;
  }

  var ranges = {toy:[4,10], small:[10,25], medium:[25,60], large:[60,100], giant:[100,180]};
  var sizeLabels = {toy:'Toy', small:'Small', medium:'Medium', large:'Large', giant:'Giant'};
  var range = ranges[size] || ranges.medium;
  var min = range[0], max = range[1];
  var mid = Math.round((min + max) / 2);

  result.style.display = 'block';

  if (age === 'puppy') {
    result.innerHTML =
      '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
      + '<div class="pz-result-hero" style="background:linear-gradient(135deg,#1B5E20,#2E7D32);color:#fff;padding:28px">'
      + '<div style="font-size:13px;font-weight:700;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">🎯 Target Adult Weight Range</div>'
      + '<div class="pz-result-number">' + min + '–' + max + '</div>'
      + '<div class="pz-result-unit">lbs at full adult size (' + sizeLabels[size] + ')</div>'
      + '</div>'
      + '<div class="pz-result-grid">'
      + '<div class="pz-result-cell"><div class="pz-result-cell-label">Current Weight</div><div class="pz-result-cell-val">' + weightRaw + ' lbs</div></div>'
      + '<div class="pz-result-cell"><div class="pz-result-cell-label">Size Category</div><div class="pz-result-cell-val" style="font-size:15px">' + sizeLabels[size] + '</div></div>'
      + '<div class="pz-result-cell"><div class="pz-result-cell-label">Adult Midpoint</div><div class="pz-result-cell-val">~' + mid + ' lbs</div></div>'
      + '</div>'
      + '<div class="pz-result-warning" style="margin:16px 20px;padding:14px;border-radius:10px"><strong>⚠️ Puppies aren\'t compared to adult targets.</strong> <span style="font-size:13px;color:#555">Growing puppies naturally sit well below adult weight — a vet growth chart tracking your puppy\'s trajectory over time matters far more than comparing today\'s weight to an adult range.</span></div>'
      + '<div class="pz-result-tips"><h4>📋 What To Do Instead</h4><ul>'
      + "<li>Ask your vet to plot your puppy's weight on a breed-appropriate growth curve at each check-up.</li>"
      + '<li>Feed a puppy-formulated food portioned for their current weight and expected adult size, not the adult range above.</li>'
      + "<li>Recheck this calculator once your puppy reaches adulthood to see how they compare.</li>"
      + '</ul></div>'
      + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
      + '</div>';
    return;
  }

  var status, pct = 0, statusLabel;
  if (weightRaw > max) {
    status = 'over';
    pct = Math.round(((weightRaw - max) / max) * 100);
    statusLabel = pct + '% Above Ideal Range';
  } else if (weightRaw < min) {
    status = 'under';
    pct = Math.round(((min - weightRaw) / min) * 100);
    statusLabel = pct + '% Below Ideal Range';
  } else {
    status = 'within';
    statusLabel = 'Within Healthy Range';
  }

  var boxClass = status === 'within' ? 'pz-result-success' : 'pz-result-warning';
  var heroBg = status === 'within' ? 'linear-gradient(135deg,#1B5E20,#2E7D32)' : 'linear-gradient(135deg,#E65100,#FF9800)';
  var icon = status === 'within' ? '✅' : '⚖️';

  result.innerHTML =
    '<div class="' + boxClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroBg + ';color:#fff;padding:28px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + icon + ' Your Result</div>'
    + '<div style="font-size:26px;font-weight:900">' + statusLabel + '</div>'
    + '<div class="pz-result-unit">Ideal range for ' + sizeLabels[size] + ' dogs: ' + min + '–' + max + ' lbs</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Current Weight</div><div class="pz-result-cell-val">' + weightRaw + ' lbs</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Ideal Range</div><div class="pz-result-cell-val" style="font-size:15px">' + min + '–' + max + ' lbs</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Target Midpoint</div><div class="pz-result-cell-val">~' + mid + ' lbs</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Notes</h4><ul>'
    + (status === 'over' ? '<li>Being meaningfully over the ideal range increases strain on joints and raises long-term risk for conditions like arthritis and diabetes — a gradual, vet-guided weight loss plan is safest.</li>' : '')
    + (status === 'under' ? '<li>Being under the ideal range can be normal for a lean, athletic build, but it can also signal inadequate nutrition or an underlying issue — worth mentioning at your next vet visit.</li>' : '')
    + (status === 'within' ? '<li>Keep up your current feeding and activity routine, and recheck every few months as your dog ages.</li>' : '')
    + "<li>This is a starting estimate based on breed size — ask your vet to assess body condition directly, since ideal weight varies within any size category.</li>"
    + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';
  }, 650);
}

// ── Dog Body Condition Score (BCS) Calculator
function pzCalcDogBmi() {
  var ribs = document.getElementById('pz_bcs_ribs')?.value || 'slight_press';
  var waist = document.getElementById('pz_bcs_waist')?.value || 'slight';
  var tuck = document.getElementById('pz_bcs_tuck')?.value || 'good';
  var result = document.getElementById('pz-calc-result');
  if (!result) return;
  pzShowAnalyzing('pz-calc-result', "Scoring your dog's body condition…");
  setTimeout(function() {

  var ribsScore = {visible:1, easy:3, slight_press:5, mod_press:7, hard:9}[ribs];
  var waistScore = {dramatic:1, defined:3, slight:5.5, none:8}[waist];
  var tuckScore = {severe:1, good:4, slight:5.5, none:8}[tuck];
  var avg = (ribsScore + waistScore + tuckScore) / 3;
  var bcs = Math.round(avg);
  if (bcs < 1) bcs = 1;
  if (bcs > 9) bcs = 9;

  var category, guidance, boxClass, heroBg, icon;
  if (bcs <= 2) {
    category = 'Very Thin';
    boxClass = 'pz-result-warning'; heroBg = 'linear-gradient(135deg,#E65100,#FF9800)'; icon = '⚠️';
    guidance = "A Very Thin score can be normal for some lean, athletic breeds, but it can also point to inadequate nutrition or an underlying illness. Rather than just feeding more, a vet visit to rule out a medical cause is the recommended next step.";
  } else if (bcs === 3) {
    category = 'Thin';
    boxClass = 'pz-result-warning'; heroBg = 'linear-gradient(135deg,#E65100,#FF9800)'; icon = '⚠️';
    guidance = "A Thin score is worth a vet check before assuming the fix is simply more food — your vet can confirm whether this reflects a lean build or something that needs addressing.";
  } else if (bcs <= 5) {
    category = 'Ideal';
    boxClass = 'pz-result-success'; heroBg = 'linear-gradient(135deg,#1B5E20,#2E7D32)'; icon = '✅';
    guidance = "Your dog is in the ideal body condition range. Maintain your current feeding routine and activity level, and recheck every few months to keep this on track as your dog ages.";
  } else if (bcs <= 7) {
    category = 'Overweight';
    boxClass = 'pz-result-warning'; heroBg = 'linear-gradient(135deg,#E65100,#FF9800)'; icon = '⚖️';
    guidance = "Carrying extra weight is linked to a higher risk of joint disease, diabetes, and a shortened lifespan. A gradual, vet-guided weight loss plan — not a sudden diet change — is the safest way to bring this back toward the ideal range.";
  } else {
    category = 'Obese';
    boxClass = 'pz-result-warning'; heroBg = 'linear-gradient(135deg,#C62828,#E65100)'; icon = '🚨';
    guidance = "Obesity is strongly linked to joint disease, diabetes, and a meaningfully shortened lifespan. This is worth discussing with your vet soon so they can guide a safe, gradual weight-loss plan tailored to your dog.";
  }

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + boxClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroBg + ';color:#fff;padding:28px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + icon + ' Your Dog\'s Body Condition Score</div>'
    + '<div class="pz-result-number">' + bcs + '<span style="font-size:22px;opacity:.7">/9</span></div>'
    + '<div class="pz-result-unit">' + category + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Rib Feel</div><div class="pz-result-cell-val" style="font-size:13px">' + {visible:'Visible', easy:'Easily felt', slight_press:'Slight pressure', mod_press:'Moderate pressure', hard:'Very hard to feel'}[ribs] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Waist</div><div class="pz-result-cell-val" style="font-size:13px">' + {dramatic:'Dramatic', defined:'Well-defined', slight:'Slight', none:'None'}[waist] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Belly Tuck</div><div class="pz-result-cell-val" style="font-size:13px">' + {severe:'Severe', good:'Good', slight:'Slight/none', none:'None'}[tuck] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Guidance For ' + category + '</h4><ul>'
    + '<li>' + guidance + '</li>'
    + "<li>This is an estimate based on your answers — your vet's hands-on check is the most accurate way to confirm your dog's body condition score.</li>"
    + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';
  }, 650);
}

// ── Dog Lifespan Calculator
function pzCalcDogLifespan() {
  var size = document.getElementById('pz_ls_size')?.value || 'medium';
  var ageRaw = parseFloat(document.getElementById('pz_ls_age')?.value);
  var age = isNaN(ageRaw) ? 0 : ageRaw;
  var fixed = document.getElementById('pz_ls_fixed')?.value || 'yes';
  var health = document.getElementById('pz_ls_health')?.value || 'excellent';
  var result = document.getElementById('pz-calc-result');
  if (!result) return;
  pzShowAnalyzing('pz-calc-result', "Building your dog's lifespan planning range…");
  setTimeout(function() {

  var baseRanges = {toy:[12,16], small:[12,16], medium:[10,14], large:[8,12], giant:[6,10]};
  var sizeLabels = {toy:'Toy', small:'Small', medium:'Medium', large:'Large', giant:'Giant'};
  var range = baseRanges[size] || baseRanges.medium;
  var min = range[0], max = range[1];
  var avg = (min + max) / 2;
  var adjAvg = fixed === 'yes' ? avg + 1.25 : avg;

  var stage;
  if (size === 'giant') {
    stage = age < 1 ? 'Puppy' : age < 2 ? 'Young Adult' : age < 5 ? 'Adult' : 'Senior';
  } else {
    stage = age < 1 ? 'Puppy' : age < 3 ? 'Young Adult' : age < 7 ? 'Adult' : 'Senior';
  }

  result.style.display = 'block';
  result.innerHTML =
    '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:linear-gradient(135deg,#1B5E20,#2E7D32);color:#fff;padding:28px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">📅 Average Lifespan Range</div>'
    + '<div class="pz-result-number">' + min + '–' + max + '</div>'
    + '<div class="pz-result-unit">years, typical for ' + sizeLabels[size] + ' breeds</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Current Life Stage</div><div class="pz-result-cell-val" style="font-size:15px">' + stage + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Population Average</div><div class="pz-result-cell-val">~' + adjAvg.toFixed(1) + ' yrs</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Spayed/Neutered</div><div class="pz-result-cell-val" style="font-size:15px">' + (fixed === 'yes' ? 'Yes (+1–1.5 yrs avg)' : 'No') + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 What This Means For Planning</h4><ul>'
    + (health === 'fair' ? "<li>Managing one or more chronic conditions can shift this general range — your vet's specific guidance for your dog's condition matters more than this population number.</li>" : '<li>Use this range to plan preventive care timing — senior wellness visits, joint support, and bloodwork — around your dog\'s life stage.</li>')
    + (stage === 'Senior' ? '<li>Since your dog is in their senior years, biannual vet checkups and routine bloodwork are generally recommended to catch age-related changes early.</li>' : '<li>Regular wellness visits now build the foundation for a smooth transition into senior care later.</li>')
    + '<li>This is a population average for planning and preventive care — not a prediction for your individual dog. Genetics, diet, and veterinary care all matter more than breed averages.</li>'
    + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';
  }, 650);
}

// ── Dog Deworming Schedule Calculator
function pzCalcDewormingSchedule() {
  var age = document.getElementById('pz_dw2_age')?.value || 'adult';
  var exposure = document.getElementById('pz_dw2_exposure')?.value || 'moderate';
  var last = document.getElementById('pz_dw2_last')?.value || '';
  var result = document.getElementById('pz-calc-result');
  if (!result) return;
  pzShowAnalyzing('pz-calc-result', "Building your dog's deworming schedule…");
  setTimeout(function() {

  var intervalDays, cadenceLabel, note;
  if (age === 'puppy_young') {
    intervalDays = 14;
    cadenceLabel = 'Every 2 weeks until 12 weeks old';
    note = 'Puppies can be born with roundworms or infected through nursing — this frequent early schedule breaks the parasite cycle before it affects growth.';
  } else if (age === 'puppy_older') {
    intervalDays = 30;
    cadenceLabel = 'Monthly until 6 months old';
    note = "Continue monthly treatment through the rest of your puppy's first 6 months as their immune system matures.";
  } else {
    if (exposure === 'high') {
      intervalDays = 30;
      cadenceLabel = 'Monthly';
      note = 'High exposure to wildlife, scavenging, or hunting raises reinfection risk substantially, which is why a monthly schedule is recommended instead of the standard quarterly baseline.';
    } else {
      intervalDays = 90;
      cadenceLabel = 'Every 3 months (quarterly)';
      note = "This baseline assumes your dog is on a monthly broad-spectrum heartworm/parasite preventive — quarterly deworming acts as an additional safety net alongside it.";
    }
  }

  var nextDateStr = '', calendarLink = '';
  if (last) {
    var d = new Date(last + 'T12:00:00');
    d.setDate(d.getDate() + intervalDays);
    nextDateStr = d.toLocaleDateString('en-US', { month:'long', day:'numeric', year:'numeric' });
    var y = d.getFullYear(), m = ('0'+(d.getMonth()+1)).slice(-2), day = ('0'+d.getDate()).slice(-2);
    var dEnd = new Date(d); dEnd.setDate(dEnd.getDate()+1);
    var y2 = dEnd.getFullYear(), m2 = ('0'+(dEnd.getMonth()+1)).slice(-2), d2 = ('0'+dEnd.getDate()).slice(-2);
    calendarLink = 'https://calendar.google.com/calendar/render?action=TEMPLATE&text='
      + encodeURIComponent("💊 Deworm your dog")
      + '&dates=' + y+m+day + '/' + y2+m2+d2
      + '&details=' + encodeURIComponent('Reminder from PetZenAI Deworming Schedule Calculator');
  }

  result.style.display = 'block';
  result.innerHTML =
    '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:linear-gradient(135deg,#1B5E20,#2E7D32);color:#fff;padding:28px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">✅ Recommended Deworming Frequency</div>'
    + '<div style="font-size:24px;font-weight:900">' + cadenceLabel + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Age Group</div><div class="pz-result-cell-val" style="font-size:13px">' + {puppy_young:'Puppy under 12 wks', puppy_older:'Puppy 12wk–6mo', adult:'Adult', senior:'Senior'}[age] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Exposure</div><div class="pz-result-cell-val" style="font-size:13px">' + {low:'Low', moderate:'Moderate', high:'High'}[exposure] + '</div></div>'
    + (nextDateStr ? '<div class="pz-result-cell"><div class="pz-result-cell-label">Next Due</div><div class="pz-result-cell-val" style="font-size:13px">' + nextDateStr + '</div></div>' : '<div class="pz-result-cell"><div class="pz-result-cell-label">Interval</div><div class="pz-result-cell-val">Every ' + intervalDays + ' days</div></div>')
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Notes</h4><ul>'
    + '<li>' + note + '</li>'
    + '<li>This is a general schedule — your vet may adjust it based on fecal test results and local parasite risk in your area.</li>'
    + '</ul></div>'
    + '<div style="padding:0 20px 20px;display:flex;gap:10px;flex-wrap:wrap">'
    + (calendarLink ? '<a href="' + calendarLink + '" target="_blank" rel="noopener" class="pz-int-btn" style="margin-top:0;text-decoration:none;flex:1">📅 Add Reminder to Calendar</a>' : '')
    + '<button class="pz-int-btn" style="margin-top:0;flex:1;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button>'
    + '</div>'
    + '</div>';
  }, 650);
}

// ── Dog Pregnancy Calculator
function pzCalcDogPregnancy() {
  var matingDateStr = document.getElementById('pz_preg_date')?.value || '';
  var size = document.getElementById('pz_preg_size')?.value || 'medium';
  var result = document.getElementById('pz-calc-result');
  if (!result) return;
  pzShowAnalyzing('pz-calc-result', "Calculating your dog's due-date window…");
  setTimeout(function() {

  if (!matingDateStr) {
    result.style.display = 'block';
    result.innerHTML = '<div class="pz-result-warning" style="border-radius:12px;padding:16px;text-align:center"><strong>⚠️ Please enter the breeding/mating date.</strong></div>';
    return;
  }

  var matingDate = new Date(matingDateStr + 'T12:00:00');
  var today = new Date();
  today = new Date(today.getFullYear(), today.getMonth(), today.getDate(), 12, 0, 0);
  var daysSince = Math.floor((today - matingDate) / 86400000);

  result.style.display = 'block';

  if (daysSince < 0) {
    result.innerHTML = '<div class="pz-result-warning" style="border-radius:16px;padding:24px;text-align:center">'
      + '<div style="font-size:32px;margin-bottom:8px">📅</div>'
      + '<strong>That date is in the future.</strong><br><span style="font-size:14px;color:#555">Please select a past or today\'s mating date so we can calculate an accurate due-date window.</span></div>';
    return;
  }

  if (daysSince > 70) {
    result.innerHTML = '<div class="pz-result-warning" style="border-radius:16px;padding:24px;text-align:center">'
      + '<div style="font-size:32px;margin-bottom:8px">⚠️</div>'
      + '<strong>It has been ' + daysSince + ' days since the mating date.</strong><br><span style="font-size:14px;color:#555">Canine pregnancies typically resolve within 61–65 days. If more than 65 days have passed without labor, contact your vet promptly to check on mom and pups.</span></div>';
    return;
  }

  var dueMin = new Date(matingDate); dueMin.setDate(dueMin.getDate() + 61);
  var dueMax = new Date(matingDate); dueMax.setDate(dueMax.getDate() + 65);
  var dueMinStr = dueMin.toLocaleDateString('en-US', { month:'long', day:'numeric', year:'numeric' });
  var dueMaxStr = dueMax.toLocaleDateString('en-US', { month:'long', day:'numeric', year:'numeric' });

  var currentDay = daysSince + 1;
  var trimester = currentDay <= 21 ? '1st' : currentDay <= 42 ? '2nd' : '3rd';
  var trimesterLabel = trimester + ' Trimester';

  var litterMap = {
    toy: 'Toy breeds typically have smaller litters, often 1–4 puppies.',
    small: 'Small breeds typically have litters of around 1–4 puppies.',
    medium: 'Medium breeds typically have litters of around 4–6 puppies.',
    large: 'Large breeds typically have litters of around 6–8 puppies.',
    giant: 'Giant breeds typically have larger litters, often 8–12 puppies or more.'
  };

  var y = dueMin.getFullYear(), m = ('0'+(dueMin.getMonth()+1)).slice(-2), day = ('0'+dueMin.getDate()).slice(-2);
  var dEnd = new Date(dueMin); dEnd.setDate(dEnd.getDate()+1);
  var y2 = dEnd.getFullYear(), m2 = ('0'+(dEnd.getMonth()+1)).slice(-2), d2 = ('0'+dEnd.getDate()).slice(-2);
  var calendarLink = 'https://calendar.google.com/calendar/render?action=TEMPLATE&text='
    + encodeURIComponent('🐕 Dog due-date window begins')
    + '&dates=' + y+m+day + '/' + y2+m2+d2
    + '&details=' + encodeURIComponent('Reminder from PetZenAI Pregnancy Calculator — due window runs through ' + dueMaxStr);

  result.innerHTML =
    '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:linear-gradient(135deg,#1B5E20,#2E7D32);color:#fff;padding:28px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">🐕 Estimated Due-Date Window</div>'
    + '<div style="font-size:20px;font-weight:900">' + dueMinStr + ' – ' + dueMaxStr + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Current Day</div><div class="pz-result-cell-val">Day ' + currentDay + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Trimester</div><div class="pz-result-cell-val" style="font-size:15px">' + trimesterLabel + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Breed Size</div><div class="pz-result-cell-val" style="font-size:15px;text-transform:capitalize">' + size + '</div></div>'
    + '</div>'
    + '<div class="pz-result-recap"><h4>📝 Litter Size Reference</h4><ul style="grid-template-columns:1fr"><li>' + litterMap[size] + ' This is a general tendency, not a count — an X-ray from day 45+ gives an accurate number.</li></ul></div>'
    + '<div class="pz-result-tips"><h4>📋 Vet Checkpoints</h4><ul>'
    + '<li><strong>Day 28:</strong> An ultrasound can confirm pregnancy.</li>'
    + '<li><strong>Day 45+:</strong> An X-ray can give an accurate puppy count once skeletons calcify.</li>'
    + "<li><strong>Final week:</strong> Prepare a quiet whelping box and review the signs of approaching labor.</li>"
    + '<li>If more than 65 days pass from the mating date without labor starting, contact your vet promptly.</li>'
    + '</ul></div>'
    + '<div style="padding:0 20px 20px;display:flex;gap:10px;flex-wrap:wrap">'
    + '<a href="' + calendarLink + '" target="_blank" rel="noopener" class="pz-int-btn" style="margin-top:0;text-decoration:none;flex:1">📅 Add Reminder to Calendar</a>'
    + '<button class="pz-int-btn" style="margin-top:0;flex:1;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button>'
    + '</div>'
    + '</div>';
  }, 650);
}

// ── How Often Should Dogs Visit the Vet? Calculator
function pzCalcVetVisitFrequency() {
  var age = document.getElementById('pz_vv_age')?.value || 'young_adult';
  var health = document.getElementById('pz_vv_health')?.value || 'healthy';
  var last = document.getElementById('pz_vv_last')?.value || '';
  var result = document.getElementById('pz-calc-result');
  if (!result) return;
  pzShowAnalyzing('pz-calc-result', "Building your dog's recommended visit schedule…");
  setTimeout(function() {

  var intervalDays, cadenceLabel, note;
  if (age === 'puppy') {
    intervalDays = 25;
    cadenceLabel = 'Every 3–4 weeks';
    note = "Puppy visits are spaced closely to complete the vaccine series in stages, which typically finishes around 16 weeks of age.";
  } else if (age === 'young_adult') {
    if (health === 'chronic') {
      intervalDays = 120;
      cadenceLabel = 'Every 3–6 months';
      note = "Managing a chronic condition usually calls for closer monitoring than the standard annual exam — this general cadence should defer to your vet's specific plan for your dog's condition.";
    } else {
      intervalDays = 365;
      cadenceLabel = 'Annually';
      note = 'A yearly wellness exam is the standard baseline for healthy adult dogs under 7, covering vaccines as needed and a general preventive care review.';
    }
  } else { // senior
    if (health === 'chronic') {
      intervalDays = 105;
      cadenceLabel = 'Every 3–4 months';
      note = 'Senior dogs managing a chronic condition benefit from closer monitoring than a standard senior wellness schedule — follow your vet\'s specific plan alongside this general cadence.';
    } else {
      intervalDays = 182;
      cadenceLabel = 'Every 6 months (biannual)';
      note = 'Health can change faster in senior dogs, so biannual visits catch developing issues earlier than an annual-only schedule would.';
    }
  }

  var nextDateStr = '', calendarLink = '';
  if (last) {
    var d = new Date(last + 'T12:00:00');
    d.setDate(d.getDate() + intervalDays);
    nextDateStr = d.toLocaleDateString('en-US', { month:'long', day:'numeric', year:'numeric' });
    var y = d.getFullYear(), m = ('0'+(d.getMonth()+1)).slice(-2), day = ('0'+d.getDate()).slice(-2);
    var dEnd = new Date(d); dEnd.setDate(dEnd.getDate()+1);
    var y2 = dEnd.getFullYear(), m2 = ('0'+(dEnd.getMonth()+1)).slice(-2), d2 = ('0'+dEnd.getDate()).slice(-2);
    calendarLink = 'https://calendar.google.com/calendar/render?action=TEMPLATE&text='
      + encodeURIComponent("🏥 Dog vet visit due")
      + '&dates=' + y+m+day + '/' + y2+m2+d2
      + '&details=' + encodeURIComponent('Reminder from PetZenAI Vet Visit Frequency Calculator');
  }

  result.style.display = 'block';
  result.innerHTML =
    '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:linear-gradient(135deg,#1B5E20,#2E7D32);color:#fff;padding:28px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">✅ Recommended Visit Frequency</div>'
    + '<div style="font-size:24px;font-weight:900">' + cadenceLabel + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Age Group</div><div class="pz-result-cell-val" style="font-size:13px">' + {puppy:'Puppy', young_adult:'Adult under 7', senior:'Senior (7+)'}[age] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Health Status</div><div class="pz-result-cell-val" style="font-size:13px">' + {healthy:'Healthy', chronic:'Chronic condition(s)'}[health] + '</div></div>'
    + (nextDateStr ? '<div class="pz-result-cell"><div class="pz-result-cell-label">Next Visit Due</div><div class="pz-result-cell-val" style="font-size:13px">' + nextDateStr + '</div></div>' : '<div class="pz-result-cell"><div class="pz-result-cell-label">Cadence</div><div class="pz-result-cell-val" style="font-size:13px">' + cadenceLabel + '</div></div>')
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Notes</h4><ul>'
    + '<li>' + note + '</li>'
    + ((age === 'senior' || health === 'chronic') ? '<li>Routine bloodwork at these visits often catches issues before symptoms appear, when they\'re easiest to treat.</li>' : '<li>Bring any questions or small concerns you\'ve noticed since the last visit — they\'re easier to address at a routine appointment than to remember later.</li>')
    + '</ul></div>'
    + '<div style="padding:0 20px 20px;display:flex;gap:10px;flex-wrap:wrap">'
    + (calendarLink ? '<a href="' + calendarLink + '" target="_blank" rel="noopener" class="pz-int-btn" style="margin-top:0;text-decoration:none;flex:1">📅 Add Reminder to Calendar</a>' : '')
    + '<button class="pz-int-btn" style="margin-top:0;flex:1;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button>'
    + '</div>'
    + '</div>';
  }, 650);
}


// ── Dog Fever Checker
function pzCheckDogFever() {
  var result = document.getElementById('pz-checker-result');
  if (!result) return;
  pzShowAnalyzing('pz-checker-result', "Analyzing your dog's fever signs…");
  setTimeout(function() {

  var q1 = (document.querySelector('[name="pzq_0"]:checked') || {}).value || '';
  var q2 = (document.querySelector('[name="pzq_1"]:checked') || {}).value || '';
  var q3 = (document.querySelector('[name="pzq_2"]:checked') || {}).value || '';
  var q4 = (document.querySelector('[name="pzq_3"]:checked') || {}).value || '';
  var q5 = (document.querySelector('[name="pzq_4"]:checked') || {}).value || '';
  var fill = document.getElementById('pz-prog-fill');
  if (fill) fill.style.width = '100%';
  result.style.display = 'block';

  if (!q1 || !q2 || !q3 || !q4 || !q5) {
    result.innerHTML = '<div class="pz-result-warning" style="border-radius:12px;padding:16px;text-align:center"><strong>⚠️ Please answer all 5 questions.</strong></div>';
    return;
  }

  var w1 = {no:0, warm:1, hot:3, hot_lethargic:4}[q1] || 0;
  var w2 = {normal:0, slightly_less:1, lethargic:3, unresponsive:4}[q2] || 0;
  var w3 = {normal:0, eating_less:1, refusing_food:2, refusing_both:4}[q3] || 0;
  var w4 = {none:0, gi:2, shivering:2, severe:5}[q4] || 0;
  var w5 = {just_noticed:0, few_hours:1, over_24h:2, two_plus_days:3}[q5] || 0;
  var score = w1 + w2 + w3 + w4 + w5;
  var hasHighFlag = (q1 === 'hot_lethargic' || q2 === 'unresponsive' || q3 === 'refusing_both');
  var isEmergency = (q4 === 'severe');

  var tier = 'low';
  if (isEmergency || score >= 9) tier = 'high';
  else if (score >= 4 || hasHighFlag) tier = 'moderate';

  var heroColor = {low:'linear-gradient(135deg,#1B5E20,#2E7D32)', moderate:'linear-gradient(135deg,#E65100,#FF9800)', high:'linear-gradient(135deg,#B71C1C,#C62828)'}[tier];
  var heroIcon  = {low:'✅', moderate:'⚠️', high:'🚨'}[tier];
  var heroTitle = {low:'Likely OK to Monitor at Home', moderate:'Contact Your Vet Today', high:'Seek Vet or Emergency Care Now'}[tier];
  var heroSub   = {low:'No high-urgency signs detected', moderate:'Schedule a same-day or next-day visit', high:'Do not wait — this pattern needs prompt attention'}[tier];
  var wrapClass = {low:'pz-result-success', moderate:'pz-result-warning', high:'pz-result-danger'}[tier];

  var tips;
  if (tier === 'high') {
    tips = '<li>Call an emergency vet clinic now, especially with pale or dark gums, or labored breathing.</li>'
      + '<li>Keep your dog calm and cool on the way — do not force food or water if they are refusing.</li>'
      + "<li>Take a rectal temperature reading before you leave if you can, and bring the number with you.</li>";
  } else if (tier === 'moderate') {
    tips = '<li>Call your vet today to schedule a same-day or next-day visit rather than waiting it out.</li>'
      + "<li>Take a rectal temperature reading if you have a thermometer — 101–102.5°F is normal.</li>"
      + '<li>Keep food, water, and a quiet space available, and recheck energy every couple of hours until seen.</li>';
  } else {
    tips = '<li>Monitor your dog and recheck energy, appetite, and warmth in a few hours.</li>'
      + "<li>Confirm with a rectal thermometer if you have one — 101–102.5°F is normal for most adult dogs.</li>"
      + '<li>Call your vet if any new symptom appears or things have not improved by tomorrow.</li>';
  }

  result.innerHTML = '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div style="background:' + heroColor + ';color:#fff;padding:24px;text-align:center">'
    + '<div style="font-size:40px;margin-bottom:8px">' + heroIcon + '</div>'
    + '<div style="font-size:20px;font-weight:900;margin-bottom:6px">' + heroTitle + '</div>'
    + '<div style="font-size:13px;opacity:.85">' + heroSub + '</div></div>'
    + '<div class="pz-result-tips"><h4>📋 What To Do Now</h4><ul>' + tips + '</ul></div>'
    + '<div style="padding:14px 20px;background:#FFF8E1;border-top:1px solid #FFE0B2;font-size:13px;color:#7A5C00"><strong>Important:</strong> This tool cannot confirm a fever — only a thermometer reading (101–102.5°F is normal) can. Use this as a guide for how urgently to act, not a diagnosis.</div>'
    + '<div style="padding:16px 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Dog Allergy Symptoms Checker
function pzCheckDogAllergy() {
  var result = document.getElementById('pz-checker-result');
  if (!result) return;
  pzShowAnalyzing('pz-checker-result', "Analyzing your dog's allergy symptoms…");
  setTimeout(function() {

  var q1 = (document.querySelector('[name="pzq_0"]:checked') || {}).value || '';
  var q2 = (document.querySelector('[name="pzq_1"]:checked') || {}).value || '';
  var q3 = (document.querySelector('[name="pzq_2"]:checked') || {}).value || '';
  var q4 = (document.querySelector('[name="pzq_3"]:checked') || {}).value || '';
  var q5 = (document.querySelector('[name="pzq_4"]:checked') || {}).value || '';
  var fill = document.getElementById('pz-prog-fill');
  if (fill) fill.style.width = '100%';
  result.style.display = 'block';

  if (!q1 || !q2 || !q3 || !q4 || !q5) {
    result.innerHTML = '<div class="pz-result-warning" style="border-radius:12px;padding:16px;text-align:center"><strong>⚠️ Please answer all 5 questions.</strong></div>';
    return;
  }

  var w1 = {itch_only:0, itch_red:2, itch_hairloss:2, severe:6}[q1] || 0;
  var w2 = {seasonal:0, year_round:1, after_food:2, sudden_today:3}[q2] || 0;
  var w3 = {paws_ears:1, widespread:2, face_swelling:6, after_sting:5}[q3] || 0;
  var w4 = {no:0, vomiting:2, breathing:6}[q4] || 0;
  var w5 = {chronic:1, days:2, hours:1}[q5] || 0;
  var score = w1 + w2 + w3 + w4 + w5;
  var isEmergency = (q1 === 'severe' || q3 === 'face_swelling' || q3 === 'after_sting' || q4 === 'breathing');

  var tier = 'low';
  if (isEmergency || score >= 10) tier = 'high';
  else if (score >= 4) tier = 'moderate';

  var heroColor = {low:'linear-gradient(135deg,#1B5E20,#2E7D32)', moderate:'linear-gradient(135deg,#E65100,#FF9800)', high:'linear-gradient(135deg,#B71C1C,#C62828)'}[tier];
  var heroIcon  = {low:'✅', moderate:'⚠️', high:'🚨'}[tier];
  var heroTitle = {low:'Likely a Manageable Allergy', moderate:'See Your Vet Within a Few Days', high:'Seek Emergency Vet Care Now'}[tier];
  var heroSub   = {low:'Environmental or food allergy pattern', moderate:'Identify the trigger and get relief', high:'Possible severe allergic reaction'}[tier];
  var wrapClass = {low:'pz-result-success', moderate:'pz-result-warning', high:'pz-result-danger'}[tier];

  var tips;
  if (tier === 'high') {
    tips = '<li>Head to a vet or emergency clinic immediately — facial swelling or breathing difficulty can progress to anaphylaxis within minutes.</li>'
      + '<li>Keep your dog as calm and still as possible on the way.</li>'
      + "<li>If you know a recent trigger (new food, medication, insect sting), mention it to the vet team right away.</li>";
  } else if (tier === 'moderate') {
    tips = '<li>Schedule a vet visit within a few days to help identify the trigger and get relief.</li>'
      + "<li>Don't self-medicate with human antihistamines without your vet confirming the product and dose.</li>"
      + '<li>Note when symptoms happen and what changed recently (new food, season, products) to help your vet narrow down the cause.</li>';
  } else {
    tips = '<li>This pattern looks like a manageable environmental or food allergy — common culprits include chicken, beef, dairy, or wheat (food) and pollen, dust mites, or fleas (environmental).</li>'
      + '<li>A vet-guided elimination diet or allergy testing is the reliable way to confirm the exact trigger.</li>'
      + '<li>Keep a symptom log — timing and location patterns often reveal the trigger over a few weeks.</li>';
  }

  result.innerHTML = '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div style="background:' + heroColor + ';color:#fff;padding:24px;text-align:center">'
    + '<div style="font-size:40px;margin-bottom:8px">' + heroIcon + '</div>'
    + '<div style="font-size:20px;font-weight:900;margin-bottom:6px">' + heroTitle + '</div>'
    + '<div style="font-size:13px;opacity:.85">' + heroSub + '</div></div>'
    + '<div class="pz-result-tips"><h4>📋 What To Do Now</h4><ul>' + tips + '</ul></div>'
    + '<div style="padding:14px 20px;background:#FFF8E1;border-top:1px solid #FFE0B2;font-size:13px;color:#7A5C00"><strong>Important:</strong> This tool cannot diagnose an allergy. It is a guide for how urgently to act — a vet visit is the only way to confirm the actual trigger and get a treatment plan.</div>'
    + '<div style="padding:16px 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Dog Parasite Prevention Guide
function pzGenParasitePrevention() {
  var lifestyle = document.getElementById('pz_pp_lifestyle')?.value || 'outdoor';
  var current    = document.getElementById('pz_pp_current')?.value || 'some';
  var climate    = document.getElementById('pz_pp_climate')?.value || 'seasonal';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Building your parasite prevention plan…');
  setTimeout(function() {

  var highExposure = (lifestyle === 'high_exposure' || climate === 'warm_yearround');
  var lifestyleLabel = {indoor:'Mostly indoor', outdoor:'Regular outdoor/yard time', high_exposure:'Frequent woods/trails/other dogs'}[lifestyle];
  var currentLabel = {none:'Nothing currently', some:'Some products, not consistent', full:'Full monthly prevention year-round'}[current];
  var climateLabel = {warm_yearround:'Warm year-round', seasonal:'Seasonal'}[climate];

  var heartwormNote = "Monthly heartworm preventive — a vet blood test is required before starting (or restarting after a gap) to confirm your dog isn't already infected.";
  var fleaTickNote = highExposure
    ? 'Monthly flea &amp; tick protection (topical or oral), running every month with no seasonal gaps — your exposure level and/or climate keep parasites active year-round.'
    : 'Monthly flea &amp; tick protection through the active season at minimum — many vets now recommend year-round coverage since fleas can survive indoors even through cold winters.';
  var dewormNote = "Routine deworming on a schedule set by your vet (see our Dog Deworming Schedule Calculator) — more frequent if your dog spends time in high-exposure environments like dog parks or wooded trails.";

  var onTrack = (current === 'full');
  var wrapClass = onTrack ? 'pz-result-success' : 'pz-result-warning';
  var heroColor = onTrack ? 'linear-gradient(135deg,#1B5E20,#2E7D32)' : 'linear-gradient(135deg,#E65100,#FF9800)';
  var heroIcon = onTrack ? '✅' : '⚠️';
  var heroTitle = onTrack ? "You're On Track" : 'Close These Gaps — In Priority Order';
  var heroSub = onTrack
    ? (highExposure ? 'Keep it running with no gaps — your exposure level needs it' : 'Full monthly prevention matches your lifestyle and climate')
    : 'Heartworm first, then flea/tick, then deworming';

  var body;
  if (onTrack) {
    body = '<li>' + heartwormNote + ' Since you\'re already on full prevention, just confirm with your vet that this stays current.</li>'
      + '<li>' + fleaTickNote + '</li>'
      + '<li>' + dewormNote + '</li>';
  } else {
    body = '<li><strong>1. Heartworm (highest priority):</strong> ' + heartwormNote + ' Heartworm treatment after infection is far more dangerous and expensive than prevention, which is why this comes first.</li>'
      + '<li><strong>2. Flea &amp; Tick:</strong> ' + fleaTickNote + '</li>'
      + '<li><strong>3. Deworming:</strong> ' + dewormNote + '</li>';
  }

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + heroSub + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Lifestyle</div><div class="pz-result-cell-val" style="font-size:13px">' + lifestyleLabel + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Current Coverage</div><div class="pz-result-cell-val" style="font-size:13px">' + currentLabel + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Climate</div><div class="pz-result-cell-val" style="font-size:13px">' + climateLabel + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Your 3-Part Plan</h4><ul>' + body + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Puppy Health Checklist
function pzGenPuppyHealthChecklist() {
  var age = document.getElementById('pz_phc_age')?.value || '8to16';
  var vax = document.getElementById('pz_phc_vax')?.value || 'partial';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', "Building your puppy's checklist…");
  setTimeout(function() {

  var ageLabels = {under8:'Under 8 weeks', '8to16':'8–16 weeks', '4to6mo':'4–6 months', '6to12mo':'6–12 months'};
  var vaxLabels = {none:'Not started', partial:'Started, not complete', complete:'Core series complete'};

  var checklists = {
    under8: [
      'First vet visit (if not done yet) — deworming typically starts here',
      'Deworming, usually starting around 2–3 weeks and repeated every 2–3 weeks until 12 weeks',
      "No core vaccines yet — puppies are generally too young; your vet will set the exact start date",
      'Avoid dog parks and areas with unknown-vaccination dogs — the immune system is still developing',
      'Focus on gentle socialization in controlled, low-risk settings (home, familiar people)'
    ],
    '8to16': [
      'Core vaccine series (parvovirus, distemper, adenovirus, and others per your vet) — typically given across 3 rounds through this window',
      'Rabies vaccine, timed per your local law (often toward the end of this window)',
      'Careful, controlled socialization can begin — avoid unvaccinated-dog areas until the core series is complete',
      "Continue deworming on your vet's schedule",
      'Start basic handling exercises (paws, mouth, ears) to build comfort with grooming and vet exams'
    ],
    '4to6mo': [
      "Spay/neuter conversation with your vet — timing varies by breed size",
      'Final vaccine boosters to complete the core series if not already done',
      'Teething monitoring — permanent teeth come in around this window; watch for retained baby teeth',
      'Adjust food portions as growth rate starts to slow',
      'Continue socialization and basic obedience training'
    ],
    '6to12mo': [
      'Rabies booster per your local law, if not already given',
      'Begin planning the transition to adult food (timing varies by breed size — large breeds transition later)',
      "Schedule the first \"adult\" wellness exam around 12 months",
      'Confirm spay/neuter timing with your vet if not already done',
      'Monitor growth plate closure in large/giant breeds before increasing high-impact exercise'
    ]
  };

  var items = checklists[age] || checklists['8to16'];
  var urgentFlag = (age === '6to12mo' && vax !== 'complete') || (age === '4to6mo' && vax === 'none');
  var softNote = (age === '8to16' && vax === 'none');

  var wrapClass = urgentFlag ? 'pz-result-warning' : 'pz-result-success';
  var heroColor = urgentFlag ? 'linear-gradient(135deg,#E65100,#FF9800)' : 'linear-gradient(135deg,#1B5E20,#2E7D32)';
  var heroIcon = urgentFlag ? '⚠️' : '✅';
  var heroTitle = 'Checklist for ' + ageLabels[age];

  var listHtml = '';
  items.forEach(function(item){ listHtml += '<li>' + item + '</li>'; });

  var flagHtml = '';
  if (urgentFlag) {
    flagHtml = '<div style="padding:14px 20px;background:#FFF3E0;border-top:1px solid #FFCC80;font-size:13px;color:#8A4B00"><strong>⚠️ Worth an urgent vet call:</strong> Your puppy\'s vaccination status ("' + vaxLabels[vax] + '") looks behind what\'s typical for ' + ageLabels[age] + '. This is gentle guidance, not a diagnosis — check in with your vet soon rather than waiting for the next routine visit.</div>';
  } else if (softNote) {
    flagHtml = '<div style="padding:14px 20px;background:#FFF8E1;border-top:1px solid #FFE0B2;font-size:13px;color:#7A5C00"><strong>Note:</strong> Vaccines should typically be starting in this age window if they haven\'t already — check with your vet soon if you haven\'t scheduled the first round.</div>';
  }

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' Puppy Health Checklist</div>'
    + '<div style="font-size:20px;font-weight:900">' + heroTitle + '</div>'
    + '<div style="font-size:13px;opacity:.8;margin-top:4px">Vaccination status: ' + vaxLabels[vax] + '</div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 What Applies Right Now</h4><ul>' + listHtml + '</ul></div>'
    + flagHtml
    + '<div style="padding:16px 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Dog Spay & Neuter Guide
function pzGenSpayNeuter() {
  var sex  = document.getElementById('pz_sn_sex')?.value || 'male';
  var size = document.getElementById('pz_sn_size')?.value || 'small';
  var ageMonths = parseFloat(document.getElementById('pz_sn_age')?.value) || 0;
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Building your spay/neuter timing guidance…');
  setTimeout(function() {

  if (!ageMonths || ageMonths <= 0) {
    result.style.display = 'block';
    result.innerHTML = '<div class="pz-result-warning" style="border-radius:12px;padding:16px;text-align:center"><strong>⚠️ Please enter your dog\'s current age in months.</strong></div>';
    return;
  }

  var procedure = sex === 'female' ? 'spay' : 'neuter';
  var sizeLabel = size === 'large' ? 'Large / Giant' : 'Small / Medium';
  var windowMin = size === 'large' ? 12 : 5;
  var windowMax = size === 'large' ? 18 : 6;

  var status, statusNote;
  if (ageMonths < windowMin) {
    status = 'ahead';
    statusNote = "You have time before the typical window for a dog of this size — a good time to start the conversation with your vet so you're not deciding at the last minute.";
  } else if (ageMonths <= windowMax) {
    status = 'within';
    statusNote = "This is right in the typical window many vets cite for a dog of this size — a great time to have this conversation with your vet if you haven't already.";
  } else {
    status = 'past';
    statusNote = "This is past the typical window many vets cite — that doesn't mean it's \"too late.\" It's still worth discussing with your vet, who can advise based on your dog's individual health and history.";
  }

  var sizeGuidance = size === 'large'
    ? 'For large and giant breeds, many vets now recommend waiting until closer to 12–18 months rather than the traditional 6-month mark, to support growth plate and joint health as your dog reaches skeletal maturity. This is a common current talking point, not an absolute rule — the final call is your vet\'s, based on your specific dog.'
    : 'For small and medium breeds, many vets recommend spaying/neutering around 6 months, though this can vary based on your dog\'s individual health and your vet\'s specific guidance.';

  result.style.display = 'block';
  result.innerHTML =
    '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:linear-gradient(135deg,#1B5E20,#2E7D32);color:#fff;padding:28px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">✅ Your Timing Guidance</div>'
    + '<div style="font-size:22px;font-weight:900">' + windowMin + '–' + windowMax + ' months</div>'
    + '<div class="pz-result-unit">typical window for ' + sizeLabel.toLowerCase() + ' breeds</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Procedure</div><div class="pz-result-cell-val" style="font-size:13px;text-transform:capitalize">' + procedure + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Breed Size</div><div class="pz-result-cell-val" style="font-size:13px">' + sizeLabel + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Current Age</div><div class="pz-result-cell-val" style="font-size:13px">' + ageMonths + ' months</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 What This Means For Your Dog</h4><ul>'
    + '<li>' + statusNote + '</li>'
    + '<li>' + sizeGuidance + '</li>'
    + '</ul></div>'
    + '<div class="pz-result-tips"><h4>🩹 Recovery Basics</h4><ul>'
    + '<li>Most dogs need about 10–14 days of restricted activity to heal properly.</li>'
    + '<li>Consistent e-collar or recovery-suit use prevents licking or chewing the incision.</li>'
    + '<li>Check the incision daily for redness, discharge, or swelling — these can indicate infection and should be checked by your vet.</li>'
    + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Dog Joint Health & Arthritis Prevention Guide
function pzGenJointHealth() {
  var age    = document.getElementById('pz_jh_age')?.value || 'adult';
  var weight = document.getElementById('pz_jh_weight')?.value || 'ideal';
  var signs  = document.getElementById('pz_jh_signs')?.value || 'none';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', "Building your dog's joint health guidance…");
  setTimeout(function() {

  var ageLabels = {young:'Young (under 2)', adult:'Adult (2–7)', senior:'Senior (7+)'};
  var overweight = (weight === 'overweight');
  var needsVetVisit = (age === 'senior' || signs === 'noticeable');

  var tips = [];
  if (overweight) {
    tips.push("<strong>Weight is flagged as a priority:</strong> excess weight is one of the single biggest modifiable risk factors for joint stress and arthritis progression. Pair this guide with our Dog Ideal Weight or Body Condition Score calculators to build a plan.");
  }
  if (age === 'young' && signs === 'none') {
    tips.push('Focus on prevention: maintain an ideal weight, keep exercise appropriate for age, and avoid repetitive high-impact activity like excessive jumping, especially in growing large breeds.');
  }
  if (signs === 'mild') {
    tips.push("Don't wait for this to become noticeable limping — occasional stiffness after rest is worth mentioning at your dog's next routine vet visit as early intervention.");
  }
  if (needsVetVisit) {
    tips.push('A vet visit for an actual joint assessment (X-rays if warranted) is recommended — your vet can discuss joint supplements (glucosamine, chondroitin, omega-3), weight management, low-impact exercise like swimming, and prescription pain management if arthritis is diagnosed.');
  }
  tips.push('Never give human NSAIDs (like ibuprofen or naproxen) for joint pain — they are toxic to dogs. Only vet-prescribed, dog-safe medication is appropriate.');

  var wrapClass = needsVetVisit ? 'pz-result-warning' : 'pz-result-success';
  var heroColor = needsVetVisit ? 'linear-gradient(135deg,#E65100,#FF9800)' : 'linear-gradient(135deg,#1B5E20,#2E7D32)';
  var heroIcon = needsVetVisit ? '⚠️' : '✅';
  var heroTitle = needsVetVisit ? 'Vet Assessment Recommended' : 'Prevention-Focused Guidance';

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + ageLabels[age] + (overweight ? ' · Overweight flagged' : ' · At ideal weight') + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Age Group</div><div class="pz-result-cell-val" style="font-size:13px">' + ageLabels[age] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Weight Status</div><div class="pz-result-cell-val" style="font-size:13px">' + (overweight ? 'Overweight' : 'Ideal') + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Current Signs</div><div class="pz-result-cell-val" style="font-size:12px">' + {none:'None noticed', mild:'Occasional stiffness', noticeable:'Noticeable limping'}[signs] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Your Guidance</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Senior Dog Health Guide
function pzGenSeniorHealth() {
  var age = parseFloat(document.getElementById('pz_sdh_age')?.value) || 0;
  var size = document.getElementById('pz_sdh_size')?.value || 'small';
  var concerns = document.getElementById('pz_sdh_concerns')?.value || 'none';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', "Building your dog's senior care guidance…");
  setTimeout(function() {

  if (!age || age <= 0) {
    result.style.display = 'block';
    result.innerHTML = '<div class="pz-result-warning" style="border-radius:12px;padding:16px;text-align:center"><strong>⚠️ Please enter your dog\'s current age.</strong></div>';
    return;
  }

  var thresholds = {small: 10, large: 7, giant: 6};
  var sizeLabels = {small: 'Small/Medium', large: 'Large', giant: 'Giant'};
  var threshold = thresholds[size];
  var isSenior = age >= threshold;
  var concernLabels = {none: 'None noticed', mobility: 'Mobility/joint issues', multiple: 'Multiple chronic conditions'};

  var tips = [];

  if (isSenior) {
    tips.push("<strong>Vet visit cadence:</strong> Move to biannual (twice yearly) wellness visits — the standard recommendation once a dog reaches the senior range for their size. More frequent checkups catch age-related changes while they're still manageable.");
  } else {
    tips.push("<strong>Vet visit cadence:</strong> Your dog isn't yet in the typical senior range for their size (around " + threshold + "+ years for " + sizeLabels[size].toLowerCase() + " breeds) — annual wellness visits are still appropriate for now.");
  }

  tips.push("<strong>Weight management:</strong> Extra weight compounds joint strain in aging dogs — keeping a lean body condition matters even more as your dog gets older.");
  tips.push("<strong>Diet considerations:</strong> A senior-formula diet, and easier-to-chew options if any dental issues are present, are worth discussing with your vet.");
  tips.push("<strong>Cognitive changes to watch for:</strong> Disorientation, altered sleep-wake cycles, or house-training lapses can signal canine cognitive dysfunction — worth a specific vet conversation, not just \"getting old.\"");
  tips.push("<strong>Mobility support:</strong> Ramps instead of stairs or jumping, and supportive orthopedic bedding, ease strain on aging joints.");

  if (concerns === 'multiple') {
    tips.push("<strong>Coordinated care matters here:</strong> With multiple chronic conditions present, coordinated vet-led care planning is more effective than managing each issue separately at home — treatments can interact.");
  } else if (concerns === 'mobility') {
    tips.push("<strong>Mobility/joint issues noted:</strong> Prioritize the mobility support tips above, and ask your vet about joint supplements or pain management options appropriate for your dog.");
  }

  var wrapClass = concerns === 'multiple' ? 'pz-result-warning' : 'pz-result-success';
  var heroColor = concerns === 'multiple' ? 'linear-gradient(135deg,#E65100,#FF9800)' : 'linear-gradient(135deg,#1B5E20,#2E7D32)';
  var heroIcon = concerns === 'multiple' ? '⚠️' : (isSenior ? '👴' : '✅');
  var heroTitle = concerns === 'multiple' ? 'Coordinated Vet-Led Care Recommended' : (isSenior ? 'Senior Care Focus Areas' : 'Approaching Senior Care — Focus Areas');

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + (isSenior ? 'True Senior' : 'Not Yet Senior') + ' · ' + sizeLabels[size] + ' · Age ' + age + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Senior Status</div><div class="pz-result-cell-val" style="font-size:13px">' + (isSenior ? 'True Senior' : 'Not Yet Senior') + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Breed Size</div><div class="pz-result-cell-val" style="font-size:13px">' + sizeLabels[size] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Health Concerns</div><div class="pz-result-cell-val" style="font-size:12px">' + concernLabels[concerns] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Your Focus Areas</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Dog Heat Stroke Guide
function pzGenHeatStroke() {
  var symptoms = document.getElementById('pz_hs_symptoms')?.value || 'none';
  var situation = document.getElementById('pz_hs_situation')?.value || 'resting';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', "Assessing your dog's heat stroke risk…");
  setTimeout(function() {

  var carFlag = (situation === 'car');
  var symptomLabels = {none: 'None — checking prevention', panting: 'Heavy panting/drooling', confused: 'Wobbly, confused, or vomiting', collapsed: 'Collapsed or unresponsive'};
  var situationLabels = {resting: 'Hot day, resting in shade', active: 'Hot day, active/exercising', car: 'Was in a parked car'};

  var tips = [];
  var wrapClass, heroColor, heroIcon, heroTitle;

  if (carFlag) {
    tips.push("Your dog was in a parked car — treat this as an emergency regardless of how they seem right now. Car interiors heat up dangerously fast, even with windows cracked, and there is no safe duration for this.");
  }

  if (symptoms === 'collapsed') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#C62828,#E65100)';
    heroIcon = '🚨';
    heroTitle = 'Emergency — Go To A Vet Immediately';
    tips.push('Move your dog to shade or air conditioning immediately.');
    tips.push("Use cool — not ice-cold — water on the paw pads, groin, armpits, and ears. Ice-cold water can cause shock via rapid vasoconstriction.");
    tips.push('Use wet towels and a fan if available while you get ready to leave.');
    tips.push('Go to an emergency vet now — do not wait to see if it improves.');
  } else if (symptoms === 'confused') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#C62828,#E65100)';
    heroIcon = '🚨';
    heroTitle = 'Urgent — Begin Cooling & Go To A Vet';
    tips.push('Wobbliness, confusion, or vomiting are urgent signs — begin cooling measures immediately.');
    tips.push("Use cool — not ice-cold — water on the paw pads, groin, armpits, and ears, plus a fan if available.");
    tips.push('Go to a vet without delay — do not wait to see if it resolves on its own.');
  } else if (symptoms === 'panting') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '⚠️';
    heroTitle = 'Move To A Cool Area & Monitor';
    tips.push('Move your dog to a cool area and offer water.');
    tips.push('Monitor closely for escalation — wobbliness, vomiting, or collapse means going to a vet immediately.');
    tips.push("A vet call is still reasonable, especially for flat-faced breeds, seniors, or overweight dogs, who are at higher risk.");
  } else {
    wrapClass = 'pz-result-success';
    heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
    heroIcon = '✅';
    heroTitle = 'Prevention Tips';
    tips.push('Never leave a dog in a parked car, even briefly.');
    tips.push('Avoid exercise during peak heat or midday sun.');
    tips.push('Ensure constant access to shade and water outdoors.');
    tips.push("Flat-faced (brachycephalic) breeds are at significantly elevated risk due to reduced ability to pant-cool effectively.");
  }

  if (carFlag) {
    wrapClass = 'pz-result-warning';
    if (symptoms !== 'collapsed' && symptoms !== 'confused') {
      heroColor = 'linear-gradient(135deg,#C62828,#E65100)';
      heroIcon = '🚨';
      heroTitle = 'Emergency — Get To A Vet Now';
    }
  }

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + symptomLabels[symptoms] + ' · ' + situationLabels[situation] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Symptoms</div><div class="pz-result-cell-val" style="font-size:12px">' + symptomLabels[symptoms] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Situation</div><div class="pz-result-cell-val" style="font-size:12px">' + situationLabels[situation] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 What To Do</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Dog Heart Health Guide
function pzGenHeartHealth() {
  var age = document.getElementById('pz_hh_age')?.value || 'young';
  var size = document.getElementById('pz_hh_size')?.value || 'small';
  var symptoms = document.getElementById('pz_hh_symptoms')?.value || 'none';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', "Reviewing your dog's heart health profile…");
  setTimeout(function() {

  var ageLabels = {young: 'Young (under 5)', middle: 'Middle-aged (5-9)', senior: 'Senior (10+)'};
  var sizeLabels = {small: 'Small breed', large: 'Large/Giant breed'};
  var symptomLabels = {none: 'None noticed', cough: 'Occasional cough only', exercise: 'Cough + reduced exercise tolerance', severe: 'Fainting or pale/blue-tinged gums'};

  var tips = [];
  var wrapClass, heroColor, heroIcon, heroTitle;

  if (symptoms === 'severe') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#C62828,#E65100)';
    heroIcon = '🚨';
    heroTitle = 'Urgent — Prompt Vet Evaluation Needed';
    tips.push("Fainting or pale/blue-tinged gums are serious cardiac warning signs that need prompt veterinary evaluation, not a wait-and-see approach.");
  } else if (symptoms === 'exercise') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '⚠️';
    heroTitle = 'Vet Visit Recommended Soon';
    tips.push('A cough combined with reduced exercise tolerance can indicate early heart disease — a vet visit soon is recommended.');
    if (age === 'senior' && size === 'small') {
      tips.push('This combination is especially relevant for aging small breeds, where mitral valve disease is common.');
    }
    if (size === 'large') {
      tips.push("Some large and giant breeds are predisposed to dilated cardiomyopathy — this combination is worth ruling out.");
    }
  } else if (symptoms === 'cough') {
    wrapClass = 'pz-result-success';
    heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
    heroIcon = '🩺';
    heroTitle = 'Mention At Your Next Vet Visit';
    tips.push("An occasional cough alone is often not cardiac — kennel cough and allergies are common non-cardiac causes — but it's worth mentioning at your dog's next routine vet visit.");
  } else {
    wrapClass = 'pz-result-success';
    heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
    heroIcon = '✅';
    heroTitle = 'Prevention-Focused Guidance';
    tips.push("Annual vet exams include a heart listen (auscultation) as standard — confirm it's happening at your dog's checkups.");
    tips.push('Maintain a healthy weight — excess weight strains the cardiovascular system.');
    tips.push('Regular moderate exercise supports heart health over time.');
    if (size === 'small') {
      tips.push('Small breeds are more prone to mitral valve disease with age — know what to watch for as your dog gets older.');
    } else {
      tips.push('Some large and giant breeds are predisposed to dilated cardiomyopathy — ask your vet what to watch for in your specific breed.');
    }
  }

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + ageLabels[age] + ' · ' + sizeLabels[size] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Age Group</div><div class="pz-result-cell-val" style="font-size:13px">' + ageLabels[age] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Breed Size</div><div class="pz-result-cell-val" style="font-size:13px">' + sizeLabels[size] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Symptoms</div><div class="pz-result-cell-val" style="font-size:12px">' + symptomLabels[symptoms] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Your Guidance</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Common Dog Skin Conditions Guide
function pzGenSkinConditions() {
  var symptom = document.getElementById('pz_sc_symptom')?.value || 'itch_only';
  var duration = document.getElementById('pz_sc_duration')?.value || 'new';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', "Reviewing your dog's skin symptoms…");
  setTimeout(function() {

  var symptomLabels = {itch_only: 'Itching, no visible changes', redness: 'Redness or rash', hairloss: 'Hair loss patches', scabs: 'Scabs or sores', hives: 'Hives or sudden swelling'};
  var durationLabels = {new: 'Just started (days)', weeks: 'A few weeks', chronic: 'Chronic or recurring'};

  var tips = [];
  var needsVet, heroTitle, heroIcon;

  if (symptom === 'hives') {
    needsVet = true;
    heroTitle = 'Possible Allergic Reaction';
    heroIcon = (duration === 'new') ? '🚨' : '🤧';
    tips.push('Hives can indicate an allergic reaction. Check for other allergy signs — facial swelling or breathing difficulty — and treat it as more urgent if either is present.');
    tips.push('For a fuller assessment, our dedicated dog allergy symptoms checker can help walk through the full picture.');
  } else if (symptom === 'scabs') {
    needsVet = (duration !== 'new');
    heroTitle = needsVet ? 'Vet Visit Recommended' : 'Monitor Closely';
    heroIcon = needsVet ? '⚠️' : '🔍';
    tips.push('Scabs can indicate infection or parasites like mites or fleas.');
    tips.push("A vet visit is recommended, especially if they're not improving within a few days.");
    tips.push('Avoid over-the-counter products without knowing the actual cause — treating the wrong issue can delay real relief.');
  } else if (symptom === 'hairloss') {
    needsVet = true;
    heroTitle = 'Vet Diagnosis Recommended';
    heroIcon = '🔬';
    tips.push('Hair loss patches can stem from allergies, parasites, hormonal imbalance, or ringworm.');
    tips.push('Ringworm is contagious to humans and other pets — worth knowing before assuming a benign cause.');
    tips.push("A vet diagnosis is the way to tell these apart — it's best not to guess and self-treat.");
  } else if (symptom === 'redness') {
    needsVet = (duration !== 'new');
    heroTitle = needsVet ? 'Persistent Redness — Vet Check Recommended' : 'Likely Minor Reaction';
    heroIcon = needsVet ? '⚠️' : '🔍';
    tips.push('Redness or rash is a common allergic or irritant reaction.');
    if (needsVet) {
      tips.push("Redness that's persisted beyond a few days is worth a vet check rather than continued waiting.");
    } else {
      tips.push("If it doesn't clear up within a few days, that's the point to get it checked.");
    }
  } else {
    needsVet = (duration === 'chronic');
    heroTitle = needsVet ? 'Likely Underlying Allergy' : 'Monitor — Often Minor';
    heroIcon = needsVet ? '🔍' : '✅';
    if (needsVet) {
      tips.push('Chronic itching without visible skin changes often points to an underlying allergy, environmental or food-related.');
      tips.push('An elimination diet or allergy testing, guided by your vet, is typically the next step to identify the actual trigger.');
    } else {
      tips.push('Itching without visible changes is often a minor, short-term reaction — keep an eye on it.');
      tips.push('If it continues for weeks or becomes chronic, an underlying allergy becomes more likely and is worth a vet conversation.');
    }
  }

  var generalTips = [
    'Regular brushing and grooming helps you catch skin issues early, before they progress.',
    'Omega-3 fatty acids support the skin barrier — ask your vet for a dosing recommendation.',
    "Avoid human skincare products on dogs — dog skin has a different pH than human skin."
  ];

  var wrapClass = needsVet ? 'pz-result-warning' : 'pz-result-success';
  var heroColor = needsVet
    ? (symptom === 'hives' && duration === 'new' ? 'linear-gradient(135deg,#C62828,#E65100)' : 'linear-gradient(135deg,#E65100,#FF9800)')
    : 'linear-gradient(135deg,#1B5E20,#2E7D32)';

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });
  var generalHtml = '';
  generalTips.forEach(function(t){ generalHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + symptomLabels[symptom] + ' · ' + durationLabels[duration] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Symptom</div><div class="pz-result-cell-val" style="font-size:12px">' + symptomLabels[symptom] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Duration</div><div class="pz-result-cell-val" style="font-size:13px">' + durationLabels[duration] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Your Guidance</h4><ul>' + listHtml + '</ul></div>'
    + '<div class="pz-result-tips"><h4>🧴 General Skin Care</h4><ul>' + generalHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Dog Eye Problems Guide
function pzGenEyeProblems() {
  var symptom = document.getElementById('pz_ep_symptom')?.value || 'watery';
  var eyes = document.getElementById('pz_ep_eyes')?.value || 'one';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', "Reviewing your dog's eye symptoms…");
  setTimeout(function() {

  var symptomLabels = {watery: 'Watery discharge', colored: 'Thick or colored discharge', red_squint: 'Redness or squinting', cloudy: 'Cloudiness / visible change', vision: 'Signs of sudden vision loss'};
  var eyesLabels = {one: 'One eye', both: 'Both eyes'};

  var tips = [];
  var wrapClass, heroColor, heroIcon, heroTitle;

  if (symptom === 'vision' || symptom === 'red_squint') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#C62828,#E65100)';
    heroIcon = '🚨';
    heroTitle = 'Same-Day Vet Visit Recommended';
    if (symptom === 'red_squint') {
      tips.push('Squinting is a pain signal and should be treated as urgent — eye conditions can worsen quickly.');
    } else {
      tips.push('Signs of sudden vision loss, like bumping into things, need prompt evaluation.');
    }
    tips.push("See a vet the same day if possible — pain or vision loss in the eye is not something to wait out at home.");
  } else if (symptom === 'cloudy') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '☁️';
    heroTitle = 'Vet Exam Recommended';
    tips.push('Cloudiness could be normal age-related lenticular sclerosis, which is common in seniors and usually harmless.');
    tips.push("It could also be cataracts or something more serious — a vet exam is needed to tell these apart, so don't assume it's \"just aging\" without a check.");
  } else if (symptom === 'colored') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '⚠️';
    heroTitle = 'Likely Active Infection';
    tips.push('Thick or colored discharge usually points to an active infection, such as conjunctivitis.');
    tips.push('Bacterial and viral causes are treated differently, so vet-guided treatment matters.');
    tips.push('Avoid using old or leftover eye drops — including human ones — as they can make things worse.');
  } else {
    wrapClass = 'pz-result-success';
    heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
    heroIcon = '✅';
    heroTitle = 'Likely Minor — Monitor';
    tips.push('Watery discharge is often a minor irritant response to dust or allergens.');
    tips.push('Persistent watering still needs a check.');
    tips.push('Flat-faced breeds often have breed-normal tear-staining, which is cosmetic, not medical.');
  }

  if (eyes === 'one') {
    tips.push('One eye affected often points to a localized cause — a scratch, irritant, or foreign body.');
  } else {
    tips.push('Both eyes affected more often suggests an allergic or systemic cause.');
  }

  tips.push("This guide is about identifying problems — for routine eye-area care, see our dedicated dog eye cleaning guide.");

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + symptomLabels[symptom] + ' · ' + eyesLabels[eyes] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Symptom</div><div class="pz-result-cell-val" style="font-size:12px">' + symptomLabels[symptom] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Eyes Affected</div><div class="pz-result-cell-val" style="font-size:13px">' + eyesLabels[eyes] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Your Guidance</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Dog Ear Infection Guide
function pzGenEarInfection() {
  var symptom = document.getElementById('pz_ei_symptom')?.value || 'mild';
  var history = document.getElementById('pz_ei_history')?.value || 'first';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', "Reviewing your dog's ear symptoms…");
  setTimeout(function() {

  var symptomLabels = {mild: 'Mild odor / occasional scratching', discharge: 'Redness or discharge', tilt: 'Head shaking or tilt', severe: 'Pain or visible swelling'};
  var historyLabels = {first: 'First time noticing this', recurring: 'Recurring issue'};

  var tips = [];
  var wrapClass, heroColor, heroIcon, heroTitle;

  if (symptom === 'severe' || symptom === 'tilt') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#C62828,#E65100)';
    heroIcon = '🚨';
    if (symptom === 'tilt') {
      heroTitle = 'Urgent — Possible Middle/Inner Ear Involvement';
      tips.push('Head shaking or tilt can mean the infection has reached the middle or inner ear — a more serious situation than a surface infection.');
    } else {
      heroTitle = 'Urgent — Prompt Vet Visit Needed';
      tips.push('Pain when touched or visible swelling is a more advanced presentation that needs a prompt vet visit.');
    }
    tips.push('This warrants a prompt vet visit rather than home treatment.');
  } else if (symptom === 'discharge') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '⚠️';
    heroTitle = 'Vet Diagnosis Recommended';
    tips.push('Redness or discharge likely needs vet diagnosis rather than home cleaning alone.');
    tips.push('Bacterial and yeast infections require different treatments, typically a prescription.');
    tips.push("Using the wrong product, or a leftover one from a past infection, can prolong the problem.");
  } else {
    wrapClass = 'pz-result-success';
    heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
    heroIcon = 'ℹ️';
    heroTitle = (history === 'recurring') ? 'Discuss The Root Cause With Your Vet' : 'Vet Visit Before It Progresses';
    tips.push('Mild odor or occasional scratching could be early-stage — a vet visit before it progresses is still recommended.');
    tips.push("Review your ear-cleaning routine — see our dedicated dog ear cleaning guide for routine prevention.");
  }

  if (history === 'recurring') {
    tips.push("Recurring ear infections are very commonly driven by an underlying allergy. Treating only the current infection without addressing the underlying cause with your vet means it's likely to keep coming back.");
  }

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + symptomLabels[symptom] + ' · ' + historyLabels[history] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Symptoms</div><div class="pz-result-cell-val" style="font-size:12px">' + symptomLabels[symptom] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">History</div><div class="pz-result-cell-val" style="font-size:13px">' + historyLabels[history] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Your Guidance</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Dog Diabetes Guide
function pzGenDiabetes() {
  var symptoms = document.getElementById('pz_db_symptoms')?.value || 'none';
  var risk = document.getElementById('pz_db_risk')?.value || 'none';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', "Reviewing your dog's diabetes risk profile…");
  setTimeout(function() {

  var symptomLabels = {none: 'None — just learning', thirst: 'Increased thirst and urination', weightloss: 'Weight loss despite normal appetite', severe: 'Vomiting, lethargy, and not eating'};
  var riskLabels = {none: 'None known', overweight: 'Overweight', senior: 'Senior age', breed: 'Known breed predisposition'};

  var tips = [];
  var wrapClass, heroColor, heroIcon, heroTitle;

  if (symptoms === 'severe') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#C62828,#E65100)';
    heroIcon = '🚨';
    heroTitle = 'Urgent — Vet Visit Now';
    tips.push("Vomiting, lethargy, and not eating together can indicate diabetic ketoacidosis, a genuine emergency complication of diabetes — this needs a vet visit now, not a wait-and-see approach.");
  } else if (symptoms === 'thirst' || symptoms === 'weightloss') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '⚠️';
    heroTitle = 'Vet Visit Recommended — Get Bloodwork Done';
    tips.push("This is one of the two most common early presentations of diabetes — it's worth a vet visit for bloodwork and a urinalysis without delay.");
    tips.push('Testing now, rather than waiting for more symptoms to appear, gives you the clearest and earliest answer.');
  } else {
    wrapClass = 'pz-result-success';
    heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
    if (risk !== 'none') {
      heroIcon = '🛡️';
      heroTitle = 'Prevention-Focused Guidance';
      tips.push('Maintaining a healthy weight is one of the most controllable factors in reducing diabetes risk.');
      tips.push('Routine annual bloodwork catches early signs before symptoms ever appear — this matters especially with a known risk factor.');
      if (risk === 'overweight') {
        tips.push('Being overweight is a meaningful, modifiable risk factor — a vet-guided weight loss plan helps on multiple fronts, not just diabetes risk.');
      } else if (risk === 'senior') {
        tips.push('Senior dogs benefit from twice-yearly wellness exams, which typically include bloodwork that can catch early metabolic changes.');
      } else if (risk === 'breed') {
        tips.push("Ask your vet whether your dog's breed carries a documented diabetes predisposition, and how often they'd recommend screening bloodwork.");
      }
    } else {
      heroIcon = '✅';
      heroTitle = 'No Symptoms — General Awareness';
      tips.push('No known risk factors and no symptoms noticed — routine annual bloodwork as part of regular checkups is still the best general habit.');
      tips.push('Increased thirst/urination and weight loss despite normal appetite are the two signs most worth watching for going forward.');
    }
  }

  tips.push("If your dog is already diagnosed with diabetes, this tool isn't a substitute for your vet's specific insulin and diet plan — it's meant to help decide whether symptoms warrant getting tested in the first place.");

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + symptomLabels[symptoms] + ' · ' + riskLabels[risk] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Symptoms</div><div class="pz-result-cell-val" style="font-size:12px">' + symptomLabels[symptoms] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Risk Factors</div><div class="pz-result-cell-val" style="font-size:13px">' + riskLabels[risk] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Your Guidance</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Dog Cancer Early Warning Signs Guide
function pzGenCancerSigns() {
  var signs = document.getElementById('pz_cs_signs')?.value || 'none';
  var duration = document.getElementById('pz_cs_duration')?.value || 'new';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', "Reviewing what you've noticed…");
  setTimeout(function() {

  var signLabels = {none: 'None — just learning', lump: 'A new lump or bump', weightloss: 'Weight loss or appetite change', wound: 'Non-healing wound or swelling', multiple: 'Multiple signs together'};
  var durationLabels = {new: 'Just noticed', weeks: 'A few weeks', months: 'A month or more'};

  var tips = [];
  var wrapClass, heroColor, heroIcon, heroTitle;

  if (signs === 'multiple' || (duration === 'months' && signs !== 'none')) {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '🩺';
    heroTitle = 'Vet Visit Recommended Soon';
    tips.push('Multiple signs together, or a change that has persisted a month or more, is worth a proper diagnostic workup — cytology or a biopsy can tell benign from something that needs treatment.');
    tips.push("Early detection generally improves treatment options and outcomes — that's the main reason this combination is worth checking soon rather than waiting further.");
  } else if (signs === 'lump') {
    wrapClass = 'pz-result-success';
    heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
    heroIcon = '🔍';
    heroTitle = 'Get It Checked — Most Lumps Are Benign';
    tips.push('The large majority of new lumps and bumps in dogs, like lipomas, are benign and harmless.');
    tips.push("But appearance and feel alone can't reliably confirm that — a vet check, sometimes with a quick cytology sample, is the only way to know for sure.");
  } else if (signs === 'weightloss') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '🔍';
    heroTitle = 'Vet Visit Recommended';
    tips.push('Weight loss or an appetite change has many possible causes beyond cancer — dental issues, GI problems, and thyroid changes are all common explanations.');
    tips.push('Whatever the underlying cause turns out to be, a persistent unexplained change is worth a vet visit to find out what is actually going on.');
  } else if (signs === 'wound') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '🔍';
    heroTitle = 'Vet Visit Recommended';
    tips.push("Most minor wounds heal within a week or two — one that isn't healing on that timeline, or unusual swelling, is worth a vet look.");
    tips.push('This is about ruling things out with a proper exam, not a sign of anything specific on its own.');
  } else {
    wrapClass = 'pz-result-success';
    heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
    heroIcon = '👀';
    heroTitle = 'Awareness — Nothing Urgent Right Now';
    tips.push('Worth a mention at your next routine visit: lumps that grow or change, sores that do not heal, unexplained weight loss, decreased appetite, unusual bleeding or discharge, persistent lameness, difficulty breathing, eating, or swallowing, and an unusual odor.');
    tips.push('Regular vet exams catch most things early — there is no urgency implied here, just useful awareness.');
  }

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + signLabels[signs] + ' · ' + durationLabels[duration] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Signs Noticed</div><div class="pz-result-cell-val" style="font-size:12px">' + signLabels[signs] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Duration</div><div class="pz-result-cell-val" style="font-size:13px">' + durationLabels[duration] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Your Guidance</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Dog Anxiety Guide
function pzGenAnxiety() {
  var trigger = document.getElementById('pz_anx_trigger')?.value || 'separation';
  var severity = document.getElementById('pz_anx_severity')?.value || 'mild';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', "Reviewing your dog's anxiety pattern…");
  setTimeout(function() {

  var triggerLabels = {separation: 'Anxious when left alone', noise: 'Loud noises (storms, fireworks)', social: 'New people or places', general: 'Anxious most of the time, no clear trigger'};
  var severityLabels = {mild: 'Mild, occasional', moderate: 'Moderate, fairly regular', severe: 'Severe — destructive or self-harming'};

  var tips = [];
  var wrapClass, heroColor, heroIcon, heroTitle;

  if (severity === 'severe') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#C62828,#E65100)';
    heroIcon = '🚨';
    heroTitle = 'Vet or Behaviorist Visit Recommended';
    tips.push("Destructive behavior or self-harm shouldn't just be waited out — a vet or veterinary behaviorist visit is recommended.");
    tips.push('Medication alongside behavior modification may be appropriate at this level, and can make the behavior modification training actually effective.');
  } else if (trigger === 'general') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '🩺';
    heroTitle = 'Vet Exam Recommended First';
    tips.push('Constant, undifferentiated anxiety with no clear trigger can sometimes have an underlying medical cause — chronic pain or a thyroid imbalance can mimic behavioral anxiety.');
    tips.push('A vet exam to rule out medical causes is the recommended first step before assuming this is purely behavioral.');
  } else if (severity === 'moderate') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#F9A825,#FFB300)';
    heroIcon = '📋';
    heroTitle = 'Structured Plan Recommended';
  } else {
    wrapClass = 'pz-result-success';
    heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
    heroIcon = '✅';
    heroTitle = 'Manageable With a Consistent Approach';
  }

  if (trigger === 'separation') {
    tips.push('Use gradual desensitization to departure cues — keys, shoes, grabbing your bag — so they stop predicting you are about to leave for good.');
    tips.push('Avoid punishment for anxiety-driven behavior — chewing or accidents caused by anxiety get worse with punishment, not better.');
    tips.push('Crate training can help if your dog already finds the crate comforting — never introduce it as a punishment.');
    if (severity === 'mild') {
      tips.push('Calming aids like pheromone diffusers or vet-approved supplements can help mild cases.');
    }
  } else if (trigger === 'noise') {
    tips.push('Gradual desensitization — playing storm or firework sounds at low volume and slowly building up — can reduce reactivity over time.');
    tips.push('Give your dog a safe, quiet, den-like space to retreat to during loud events.');
    if (severity === 'severe' || severity === 'moderate') {
      tips.push('For significant storm or fireworks anxiety, situational vet-discussed medication is a reasonable option, not a last resort to feel guilty about.');
    }
  } else if (trigger === 'social') {
    tips.push('Gradual, positive-reinforcement socialization — short, low-pressure exposures paired with rewards — works better than forcing interaction.');
    tips.push('Avoid "flooding" — forcing exposure to overwhelming situations typically worsens fear rather than fixing it.');
  }

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + triggerLabels[trigger] + ' · ' + severityLabels[severity] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Trigger</div><div class="pz-result-cell-val" style="font-size:12px">' + triggerLabels[trigger] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Severity</div><div class="pz-result-cell-val" style="font-size:13px">' + severityLabels[severity] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Your Guidance</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Kennel Cough Guide
function pzGenKennelCough() {
  var symptoms = document.getElementById('pz_kc_symptoms')?.value || 'dry_cough';
  var exposure = document.getElementById('pz_kc_exposure')?.value || 'yes';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', "Reviewing your dog's cough symptoms…");
  setTimeout(function() {

  var symptomLabels = {dry_cough: 'Dry, honking cough, otherwise normal', lethargy: 'Cough plus lethargy or appetite loss', breathing: 'Severe breathing difficulty'};
  var exposureLabels = {yes: 'Recent boarding, daycare, or dog park', no: 'No known exposure'};

  var tips = [];
  var wrapClass, heroColor, heroIcon, heroTitle;

  if (symptoms === 'breathing') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#C62828,#E65100)';
    heroIcon = '🚨';
    heroTitle = 'Urgent — Vet Visit Now';
    tips.push('Severe breathing difficulty could indicate a pneumonia complication or a different, more serious respiratory issue — see a vet now.');
  } else if (symptoms === 'lethargy') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '⚠️';
    heroTitle = 'Vet Visit Recommended';
    tips.push('A secondary bacterial infection on top of kennel cough is possible when lethargy or appetite loss joins the cough — it is treatable, but needs an actual diagnosis.');
  } else if (exposure === 'yes') {
    wrapClass = 'pz-result-success';
    heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
    heroIcon = '🩺';
    heroTitle = 'Classic Kennel Cough Presentation';
    tips.push('This is the classic kennel cough presentation, typically self-limiting in 1-3 weeks.');
    tips.push('A vet visit is still recommended, especially for puppies, seniors, or dogs with weaker immune systems.');
    tips.push('Use a harness instead of a collar to reduce throat irritation, run a humidifier to soothe airways, ensure rest, and isolate from other dogs since it is contagious.');
  } else {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '🫀';
    heroTitle = 'Vet Visit Recommended — Rule Out Other Causes';
    tips.push('With no known exposure, a persistent cough is worth a vet visit to rule out other causes entirely.');
    tips.push('Heart disease, a collapsing trachea (common in small breeds), or allergies can all cause a chronic cough that is not kennel cough at all.');
  }

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + symptomLabels[symptoms] + ' · ' + exposureLabels[exposure] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Symptoms</div><div class="pz-result-cell-val" style="font-size:12px">' + symptomLabels[symptoms] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Exposure</div><div class="pz-result-cell-val" style="font-size:13px">' + exposureLabels[exposure] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Your Guidance</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Dog Hypothyroidism Guide
function pzGenHypothyroidism() {
  var symptoms = document.getElementById('pz_ht_symptoms')?.value || 'none';
  var risk = document.getElementById('pz_ht_risk')?.value || 'lower';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', "Reviewing your dog's thyroid risk profile…");
  setTimeout(function() {

  var symptomLabels = {none: 'None — just learning', weightgain: 'Weight gain despite a normal diet', lethargy: 'Lethargy and cold intolerance', coat: 'Coat thinning or skin changes', multiple: 'Multiple signs together'};
  var riskLabels = {lower: 'Young, small breed', higher: 'Middle-aged, medium-large breed'};

  var tips = [];
  var wrapClass, heroColor, heroIcon, heroTitle;

  if (symptoms === 'multiple' || (risk === 'higher' && symptoms !== 'none')) {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '🩸';
    heroTitle = 'Thyroid Blood Panel Recommended';
    tips.push('Good news first: hypothyroidism is very manageable with daily medication once diagnosed.');
    tips.push('This combination is worth a thyroid blood panel (T4/TSH) — a simple, routine test your vet can run without special preparation.');
    tips.push('Hypothyroidism is most commonly diagnosed in middle-aged, medium-to-large breed dogs, which adds relevant context here.');
  } else if (symptoms === 'weightgain') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '🔍';
    heroTitle = 'Blood Panel Worth Considering';
    tips.push('Weight gain despite a normal diet is a common early sign, especially if nothing else about feeding has changed.');
    tips.push('A simple thyroid blood panel (T4/TSH) can confirm or rule this out.');
  } else if (symptoms === 'coat') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '🔍';
    heroTitle = 'Bloodwork Recommended to Confirm';
    tips.push('Symmetrical coat thinning and a dull coat are recognized hypothyroidism signs.');
    tips.push('But allergies and parasites can cause similar changes — bloodwork confirms the actual cause rather than assuming.');
  } else if (symptoms === 'lethargy') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '🔍';
    heroTitle = 'Blood Panel Worth Considering';
    tips.push('Lethargy and unusual cold intolerance are recognized hypothyroidism signs worth a simple thyroid blood panel to check.');
  } else {
    wrapClass = 'pz-result-success';
    heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
    heroIcon = '✅';
    heroTitle = 'No Symptoms — Awareness Only';
    tips.push('No action is needed right now unless signs develop.');
    if (risk === 'higher') {
      tips.push("Worth knowing: hypothyroidism is most commonly diagnosed in middle-aged, medium-to-large breed dogs, which is your dog's general profile.");
    } else {
      tips.push('Hypothyroidism is most commonly diagnosed in middle-aged, medium-to-large breed dogs — a lower-risk profile for now, but worth knowing as your dog ages.');
    }
  }

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + symptomLabels[symptoms] + ' · ' + riskLabels[risk] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Symptoms</div><div class="pz-result-cell-val" style="font-size:12px">' + symptomLabels[symptoms] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Risk Profile</div><div class="pz-result-cell-val" style="font-size:13px">' + riskLabels[risk] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Your Guidance</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Dog First Aid Guide
function pzGenFirstAid() {
  var scenario = document.getElementById('pz_fa_scenario')?.value || 'general';
  var kit = document.getElementById('pz_fa_kit')?.value || 'unsure';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Preparing your first aid guidance…');
  setTimeout(function() {

  var scenarioLabels = {general: 'General preparedness', choking: 'Choking', bleeding: 'Bleeding or a wound', poison: 'Suspected poisoning', seizure: 'Seizure'};
  var kitLabels = {yes: 'Yes', no: 'No', unsure: 'Not sure what to include'};

  var tips = [];
  var heroIcon, heroTitle;

  if (scenario === 'choking') {
    heroIcon = '🚨';
    heroTitle = 'Choking — Immediate Steps';
    tips.push('Check the mouth for a visible object.');
    tips.push('Remove it carefully only if it is visible and easily reachable — a blind finger-sweep can push it deeper, so do not do this.');
    tips.push('If the object is not visible or reachable, use back blows or modified chest thrusts.');
    tips.push('Get to a vet immediately even after the object comes out, to check for internal injury.');
  } else if (scenario === 'bleeding') {
    heroIcon = '🩹';
    heroTitle = 'Bleeding or a Wound — Immediate Steps';
    tips.push('Apply firm direct pressure with a clean cloth.');
    tips.push('Elevate the injured area if possible.');
    tips.push('Do not remove an embedded object — removing it can worsen the bleeding.');
    tips.push('Anything beyond a minor cut needs a vet visit.');
  } else if (scenario === 'poison') {
    heroIcon = '☠️';
    heroTitle = 'Suspected Poisoning — Immediate Steps';
    tips.push('Do not induce vomiting unless directed by a vet or poison control — some substances are caustic or corrosive and cause additional damage coming back up.');
    tips.push('Call ASPCA Animal Poison Control or your vet immediately.');
    tips.push("Bring the substance's packaging or label if possible to help identify it.");
  } else if (scenario === 'seizure') {
    heroIcon = '⚡';
    heroTitle = 'Seizure — Immediate Steps';
    tips.push('Do not restrain the dog.');
    tips.push('Move nearby objects out of the way to prevent injury.');
    tips.push("Time the seizure's duration.");
    tips.push('Do not put your hands near the mouth — there is a bite risk, and the old advice about dogs swallowing their tongue is a myth that does not actually happen.');
    tips.push('Seek vet care especially if a single seizure lasts over 5 minutes, or if multiple seizures occur close together — cluster seizures are a genuine emergency.');
  } else {
    heroIcon = '🎒';
    heroTitle = 'General Preparedness';
    tips.push('Build a pet first aid kit with gauze and vet wrap, and a digital thermometer.');
    tips.push('Include hydrogen peroxide, only to be used to induce vomiting if directed by a vet or poison control — never self-administered otherwise.');
    tips.push('Add a muzzle for safely handling an injured or frightened dog — even friendly dogs may bite when in pain.');
    tips.push("Save your vet's number plus a 24-hour emergency clinic's number where they are easily findable.");
  }

  if (kit !== 'yes') {
    tips.push('You mentioned you do not have a first aid kit ready — building one now, before an emergency happens, is one of the most useful things you can do today.');
  }

  tips.push('This guide is for immediate stabilization only — always follow up with your vet, or head straight to an emergency clinic for anything serious.');

  var wrapClass = (scenario === 'choking' || scenario === 'poison' || scenario === 'seizure') ? 'pz-result-warning' : 'pz-result-success';
  var heroColor = (scenario === 'choking' || scenario === 'poison' || scenario === 'seizure')
    ? 'linear-gradient(135deg,#C62828,#E65100)'
    : (scenario === 'bleeding' ? 'linear-gradient(135deg,#E65100,#FF9800)' : 'linear-gradient(135deg,#1B5E20,#2E7D32)');

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + scenarioLabels[scenario] + ' · Kit: ' + kitLabels[kit] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Scenario</div><div class="pz-result-cell-val" style="font-size:12px">' + scenarioLabels[scenario] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">First Aid Kit</div><div class="pz-result-cell-val" style="font-size:13px">' + kitLabels[kit] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>🚑 Immediate Steps</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}


// ── Dog Hip Dysplasia Guide
function pzGenHipDysplasia() {
  var risk = document.getElementById('pz_hd_risk')?.value || 'lower';
  var age = document.getElementById('pz_hd_age')?.value || 'adult';
  var signs = document.getElementById('pz_hd_signs')?.value || 'none';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', "Reviewing your dog's hip dysplasia risk…");
  setTimeout(function() {

  var riskLabels = {high: 'Large/giant breed (higher genetic risk)', lower: 'Small/medium breed (lower risk)'};
  var ageLabels = {puppy: 'Puppy, under 2 years', adult: 'Adult', senior: 'Senior'};
  var signsLabels = {none: 'None noticed', stiff: 'Occasional stiffness after rest', limp: 'Limping / "bunny-hop" gait', severe: 'Severe difficulty rising'};

  var tips = [];
  var wrapClass, heroColor, heroIcon, heroTitle;

  if (signs === 'severe') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '⚠️';
    heroTitle = 'Vet Visit Recommended — Orthopedic Exam';
    tips.push('Severe difficulty rising or getting around calls for a vet visit for an orthopedic exam and X-rays to see exactly what is happening in the joint.');
    tips.push('Management options your vet may discuss include weight management, joint supplements, and pain management.');
    tips.push('In more severe cases, surgical options exist — including a femoral head osteotomy (FHO) or total hip replacement — though these are not the first step for every dog.');
    tips.push('Hip dysplasia has a well-documented genetic component in certain large and giant breeds, which is useful context regardless of the path forward.');
  } else if (signs === 'limp') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '🐇';
    heroTitle = 'Vet Visit Recommended — Classic Gait Sign';
    tips.push('Noticeable limping, or the classically-recognized "bunny-hopping" gait (both back legs moving together in a hop rather than alternating), are specific enough signs to warrant a vet visit.');
    tips.push('Your vet will likely recommend an exam and X-rays to confirm hip dysplasia rather than diagnosing from the gait alone.');
    tips.push('Weight management and appropriate low-impact exercise are worth discussing regardless of what the exam finds.');
  } else if (signs === 'stiff') {
    if (risk === 'high') {
      wrapClass = 'pz-result-warning';
      heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
      heroIcon = '🔍';
      heroTitle = 'Worth a Vet Mention';
      tips.push('Occasional stiffness after rest, in a large or giant breed, is worth mentioning at your dog\'s next vet visit rather than waiting for it to become more noticeable.');
      tips.push('Early intervention — weight management and appropriate low-impact exercise — can slow progression meaningfully if this is early hip dysplasia.');
      tips.push('Hip dysplasia has a well-documented genetic component in large and giant breeds, which fits your dog\'s profile.');
    } else {
      wrapClass = 'pz-result-success';
      heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
      heroIcon = '👀';
      heroTitle = 'Keep an Eye On It';
      tips.push('Occasional stiffness after rest has several possible causes, and your dog\'s breed size puts them at lower genetic risk for hip dysplasia specifically.');
      tips.push('It is still worth mentioning at a routine vet visit, especially if it becomes more frequent or noticeable.');
      tips.push('Maintaining a lean body condition is a good habit regardless of cause.');
    }
  } else {
    if (risk === 'high' && age === 'puppy') {
      wrapClass = 'pz-result-success';
      heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
      heroIcon = '🌱';
      heroTitle = 'Prevention-Focused Guidance';
      tips.push('No signs noticed — a great time to focus on prevention rather than treatment.');
      tips.push('Avoid excessive high-impact exercise and jumping during the growth period; this is when a large or giant breed puppy\'s joints are most vulnerable to added stress.');
      tips.push('Maintain a lean body condition throughout your dog\'s life — extra weight is one of the biggest modifiable factors in both onset and progression.');
      tips.push('Some breeders screen breeding dogs\' hips through OFA or PennHIP evaluations — worth knowing about if you\'re choosing a future puppy.');
      tips.push('Genetic predisposition is real and well-documented in certain large and giant breeds — this does not guarantee your dog will develop it, but it is why prevention habits matter here.');
    } else if (risk === 'high') {
      wrapClass = 'pz-result-success';
      heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
      heroIcon = '✅';
      heroTitle = 'No Signs — Stay Proactive';
      tips.push('No signs noticed right now — good news, and worth maintaining the habits that help keep it that way.');
      tips.push('Keep a lean body condition and appropriate, low-impact exercise as ongoing habits given your dog\'s breed risk.');
      if (age === 'senior') {
        tips.push('Routine vet checkups are a good time to mention breed risk so mobility changes get caught early.');
      }
      tips.push('Hip dysplasia has a well-documented genetic component in large and giant breeds — useful context even without symptoms.');
    } else {
      wrapClass = 'pz-result-success';
      heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
      heroIcon = '✅';
      heroTitle = 'Low Risk — Awareness Only';
      tips.push('No signs noticed, and your dog\'s breed size puts them at lower genetic risk for hip dysplasia specifically.');
      tips.push('Maintaining a lean body condition and regular appropriate exercise are good habits for joint health at any risk level.');
    }
  }

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + riskLabels[risk] + ' · ' + ageLabels[age] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Breed Risk</div><div class="pz-result-cell-val" style="font-size:12px">' + riskLabels[risk] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Age</div><div class="pz-result-cell-val" style="font-size:13px">' + ageLabels[age] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Signs</div><div class="pz-result-cell-val" style="font-size:12px">' + signsLabels[signs] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Your Guidance</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Dog Bloat (GDV) Guide
function pzGenBloatGDV() {
  var symptoms = document.getElementById('pz_bg_symptoms')?.value || 'none';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', "Assessing your dog's bloat/GDV risk…");
  setTimeout(function() {

  var symptomLabels = {none: 'None — just learning prevention', classic: 'Distended/hard belly, restless, unproductive retching', collapse: 'Collapse or pale/white gums'};

  var tips = [];
  var wrapClass, heroColor, heroIcon, heroTitle;

  if (symptoms === 'classic' || symptoms === 'collapse') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#B71C1C,#C62828)';
    heroIcon = '🚨';
    heroTitle = symptoms === 'collapse' ? 'LIFE-THREATENING EMERGENCY — Go Now' : 'LIFE-THREATENING EMERGENCY — Go Now';
    tips.push('<strong>This is a life-threatening emergency. Go to an emergency vet immediately — do not wait.</strong>');
    if (symptoms === 'classic') {
      tips.push('A distended or hard belly, restlessness, and unproductive retching (trying to vomit with nothing coming up) together are the classic presentation of GDV (Gastric Dilatation-Volvulus).');
    }
    if (symptoms === 'collapse') {
      tips.push('Collapse or pale/white gums may mean your dog is already in shock — drive to the nearest emergency vet immediately.');
    }
    tips.push('Do not wait to "see if it passes." Do not try home remedies. GDV can be fatal within hours without emergency surgery.');
    tips.push('Call the emergency vet on your way if you can, so they can prepare for your arrival.');
  } else {
    wrapClass = 'pz-result-success';
    heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
    heroIcon = '🛡️';
    heroTitle = 'Prevention-Focused Guidance';
    tips.push('Deep-chested large and giant breeds — Great Danes, Standard Poodles, German Shepherds, and similar body types — carry documented elevated risk.');
    tips.push('Feed smaller, more frequent meals rather than one large meal eaten quickly, and avoid vigorous exercise right before or after eating.');
    tips.push('Family or breed history of GDV also raises risk — worth knowing if you know your dog\'s lineage.');
    tips.push('Elevated feeding bowls have historically been suggested as prevention, but current veterinary understanding of their actual effect is mixed and unclear — do not treat this as settled.');
    tips.push('Some vets recommend a preventive gastropexy (surgically tacking the stomach in place) for high-risk breeds, often performed during another procedure like a spay or neuter.');
    tips.push('<strong>Most important: knowing the emergency signs cold — and acting on them immediately without waiting — is what saves lives with this condition, more than any single prevention step.</strong>');
  }

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + symptomLabels[symptoms] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Symptoms</div><div class="pz-result-cell-val" style="font-size:12px">' + symptomLabels[symptoms] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Your Guidance</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Parvovirus in Dogs Guide
function pzGenParvovirus() {
  var vax = document.getElementById('pz_pv_vax')?.value || 'full';
  var symptoms = document.getElementById('pz_pv_symptoms')?.value || 'none';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', "Reviewing your dog's parvovirus risk…");
  setTimeout(function() {

  var vaxLabels = {full: 'Fully vaccinated', partial: 'Partial or unvaccinated', puppy: 'Puppy, not yet fully vaccinated'};
  var symptomLabels = {none: 'None — just learning', moderate: 'Vomiting, diarrhea, lethargy', severe: 'Bloody diarrhea, severe lethargy, not eating'};

  var tips = [];
  var wrapClass, heroColor, heroIcon, heroTitle;

  if (symptoms === 'severe') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#C62828,#E65100)';
    heroIcon = '🚨';
    heroTitle = (vax !== 'full') ? 'EMERGENCY — Go To A Vet Now' : 'Urgent — Vet Visit Now';
    tips.push('<strong>Go to an emergency vet now.</strong> Parvovirus can be fatal within 48-72 hours without treatment.');
    if (vax !== 'full') {
      tips.push('This is especially urgent given your dog\'s vaccination status — puppies and partially vaccinated dogs face real, significant risk.');
    } else {
      tips.push('Parvo is much less likely given full vaccination, but symptoms this severe need emergency care regardless of cause — investigate rather than wait.');
    }
    tips.push('Treatment typically requires IV fluids and hospitalization in most cases.');
    tips.push('Isolate your dog from other dogs immediately — parvovirus is highly contagious, and the virus can persist in the environment for months.');
  } else if (symptoms === 'moderate') {
    if (vax !== 'full') {
      wrapClass = 'pz-result-warning';
      heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
      heroIcon = '⚠️';
      heroTitle = 'Urgent Vet Visit Recommended';
      tips.push('Given your dog\'s vaccination status, a fecal ELISA snap test for parvo is quick and should be done without delay.');
      tips.push('Do not wait to "see if it gets better" — parvo can progress fast, especially in puppies and partially vaccinated dogs.');
      tips.push('Isolating from other dogs is a sensible precaution while you get this checked, since the virus is highly contagious.');
    } else {
      wrapClass = 'pz-result-warning';
      heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
      heroIcon = '🔍';
      heroTitle = 'Vet Visit Recommended — Investigate, Don\'t Panic';
      tips.push('Still worth a vet visit — many illnesses cause similar symptoms.');
      tips.push('Parvo is much less likely given full vaccination, so this is a case for investigating calmly rather than panicking.');
    }
  } else {
    wrapClass = 'pz-result-success';
    heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
    heroIcon = '🛡️';
    heroTitle = 'Prevention-Focused Guidance';
    tips.push('Vaccination is highly effective at preventing parvovirus.');
    if (vax !== 'full') {
      tips.push('Keep your puppy or partially vaccinated dog away from dog parks, other dogs\' waste, and high-traffic dog areas until the full vaccine series is complete.');
      tips.push('This is exactly why the puppy vaccine schedule timing matters so much — protection builds with each round.');
    } else {
      tips.push('Your dog is fully vaccinated — keep boosters on schedule as recommended by your vet.');
    }
  }

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + vaxLabels[vax] + ' · ' + symptomLabels[symptoms] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Vaccination</div><div class="pz-result-cell-val" style="font-size:12px">' + vaxLabels[vax] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Symptoms</div><div class="pz-result-cell-val" style="font-size:12px">' + symptomLabels[symptoms] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Your Guidance</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Dog Heartworm Prevention Guide
function pzGenHeartwormPrevention() {
  var current = document.getElementById('pz_hw_current')?.value || 'monthly';
  var climate = document.getElementById('pz_hw_climate')?.value || 'seasonal';
  var tested = document.getElementById('pz_hw_tested')?.value || 'yes';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', "Building your dog's heartworm prevention guidance…");
  setTimeout(function() {

  var currentLabels = {monthly: 'On monthly preventive, year-round', inconsistent: 'Inconsistent or seasonal only', none: 'Not currently on prevention'};
  var climateLabels = {warm: 'Warm year-round', seasonal: 'Seasonal, cold winters'};
  var testedLabels = {yes: 'Yes, within the past year', no: 'No, not recently or never'};

  var tips = [];
  var wrapClass, heroColor, heroIcon, heroTitle;

  if (current === 'none') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '🧪';
    if (tested === 'no') {
      heroTitle = 'Get Tested Before Starting Prevention';
      tips.push('See a vet for a heartworm test before starting any preventive — this matters because starting certain preventives in an already-infected dog can cause a dangerous reaction.');
      tips.push('Once you have a negative result, begin monthly prevention right away.');
    } else {
      heroTitle = 'Start Monthly Prevention Now';
      tips.push('You are not currently on prevention, but you have a recent negative test — good news. Begin monthly prevention now rather than waiting.');
    }
    if (climate === 'warm') {
      tips.push('Your warm-climate mosquito exposure may be nearly year-round, so there is no "off season" to delay starting.');
    } else {
      tips.push('Even with cold winters, most vets recommend starting and maintaining true year-round dosing rather than waiting for a "mosquito season."');
    }
  } else if (current === 'inconsistent') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '📅';
    heroTitle = (climate === 'warm') ? 'Switch to Consistent Year-Round Dosing' : 'Close the Gaps in Your Dosing';
    tips.push('Gaps in prevention create real windows of risk.');
    if (climate === 'warm') {
      tips.push('This is especially important in your climate — mosquitoes may be active nearly year-round, so seasonal or inconsistent dosing leaves meaningful exposure.');
      tips.push('Switch to consistent, true year-round monthly dosing with no seasonal gaps.');
    } else {
      tips.push('Even with cold winters, most vets recommend true year-round dosing over seasonal-only prevention — it is easy to miss the seasonal restart.');
    }
    if (tested === 'no') {
      tips.push('Get a heartworm test given the gaps in your dosing history, just to confirm your dog is currently negative.');
    }
  } else {
    wrapClass = 'pz-result-success';
    heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
    heroIcon = '✅';
    heroTitle = 'You\'re Doing It Right';
    tips.push('Monthly, year-round prevention is exactly the recommended approach — well done.');
    if (tested === 'yes') {
      tips.push('An annual test remains worthwhile even while on prevention, since no preventive is 100% effective — confirming your dog is heartworm-negative is still important.');
    } else {
      tips.push('Get an annual heartworm test done if it has been a while — worthwhile even on consistent prevention, since no preventive is 100% effective.');
    }
    tips.push('Heartworm treatment, when needed, is far more arduous, expensive, and physically hard on a dog than prevention ever is — an arsenic-based injectable drug plus months of strict crate rest and activity restriction. This is why prevention is so strongly emphasized.');
  }

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + currentLabels[current] + ' · ' + climateLabels[climate] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Prevention</div><div class="pz-result-cell-val" style="font-size:12px">' + currentLabels[current] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Climate</div><div class="pz-result-cell-val" style="font-size:13px">' + climateLabels[climate] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Tested</div><div class="pz-result-cell-val" style="font-size:13px">' + testedLabels[tested] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Your Guidance</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Lyme Disease in Dogs Guide
function pzGenLymeDisease() {
  var exposure = document.getElementById('pz_ld_exposure')?.value || 'moderate';
  var symptoms = document.getElementById('pz_ld_symptoms')?.value || 'none';
  var prevention = document.getElementById('pz_ld_prevention')?.value || 'no';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', "Reviewing your dog's Lyme disease risk…");
  setTimeout(function() {

  var exposureLabels = {high: 'High — wooded/tall grass/hiking', moderate: 'Moderate — occasional outdoor time', low: 'Low — mostly urban/indoor'};
  var symptomLabels = {none: 'None — just learning', shifting: 'Shifting-leg lameness', severe: 'Shifting lameness + fever/lethargy/swollen joints'};
  var preventionLabels = {yes: 'On tick prevention', no: 'Not currently on tick prevention'};

  var tips = [];
  var wrapClass, heroColor, heroIcon, heroTitle;

  if (symptoms === 'severe') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '🩺';
    heroTitle = 'Vet Testing Recommended';
    tips.push('Shifting-leg lameness together with fever, lethargy, and swollen joints is the classically-recognized Lyme presentation in dogs.');
    tips.push('Get a vet visit for testing — a 4Dx-style snap test checks for Lyme antibodies quickly.');
    tips.push('It is treatable with antibiotics when caught — that is genuinely reassuring.');
    tips.push('But untreated Lyme can rarely lead to kidney complications, so it should not be dismissed as "just some limping."');
  } else if (symptoms === 'shifting') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '🔍';
    heroTitle = 'Testing Recommended';
    tips.push('Lameness that shifts between different legs is also suggestive of Lyme disease on its own.');
    tips.push('Recommend testing now rather than waiting to see if more symptoms appear — a quick antibody snap test gives a clear answer.');
  } else {
    if (exposure === 'high' && prevention === 'no') {
      wrapClass = 'pz-result-warning';
      heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
      heroIcon = '🦟';
      heroTitle = 'Start Tick Prevention';
      tips.push('With high tick exposure and no current prevention, start a tick preventive (topical or oral) now.');
      tips.push('Ticks typically need roughly 24-48 hours attached to transmit Lyme, so daily tick checks after any outdoor time are a genuinely effective additional layer, not just a nice-to-have.');
      tips.push('A Lyme vaccine also exists and is worth discussing with your vet specifically given your high-exposure situation.');
    } else if (exposure === 'high') {
      wrapClass = 'pz-result-success';
      heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
      heroIcon = '✅';
      heroTitle = 'Good Prevention Habits — Keep Them Up';
      tips.push('You are already on tick prevention, which is the right baseline for your dog\'s high exposure level.');
      tips.push('Keep up daily tick checks too — ticks typically need roughly 24-48 hours attached to transmit Lyme, so same-day removal matters.');
      tips.push('Ask your vet about the Lyme vaccine as an additional layer, given the high exposure.');
    } else if (exposure === 'moderate') {
      wrapClass = 'pz-result-success';
      heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
      heroIcon = '🛡️';
      heroTitle = 'General Prevention Recommended';
      tips.push('Moderate outdoor exposure still carries some tick risk — a tick preventive is worth using if not already.');
      tips.push('Quick tick checks after outdoor time are a simple, effective habit regardless of exposure level.');
      if (prevention === 'no') {
        tips.push('Since you are not currently on tick prevention, this is worth starting given at least occasional outdoor exposure.');
      }
    } else {
      wrapClass = 'pz-result-success';
      heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
      heroIcon = '✅';
      heroTitle = 'Lower Risk — Awareness Only';
      tips.push('Mostly urban/indoor dogs face lower tick exposure, though it is not zero.');
      tips.push('Tick prevention and occasional checks are still reasonable, especially with any outdoor time.');
    }
  }

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + exposureLabels[exposure] + ' · ' + symptomLabels[symptoms] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Tick Exposure</div><div class="pz-result-cell-val" style="font-size:12px">' + exposureLabels[exposure] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Symptoms</div><div class="pz-result-cell-val" style="font-size:12px">' + symptomLabels[symptoms] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Prevention</div><div class="pz-result-cell-val" style="font-size:13px">' + preventionLabels[prevention] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Your Guidance</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Cushing's Disease in Dogs Guide
function pzGenCushingDisease() {
  var symptoms = document.getElementById('pz_cd_symptoms')?.value || 'none';
  var age = document.getElementById('pz_cd_age')?.value || 'typical';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', "Reviewing your dog's Cushing's disease risk…");
  setTimeout(function() {

  var symptomLabels = {none: 'None — just learning', early: 'Increased thirst, urination, appetite', physical: 'Pot-bellied appearance, thinning hair, skin changes', multiple: 'Multiple signs together'};
  var ageLabels = {typical: 'Middle-aged or senior (typical onset)', atypical: 'Young (less typical)'};

  var tips = [];
  var wrapClass, heroColor, heroIcon, heroTitle;

  if (symptoms === 'multiple') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '🧪';
    heroTitle = 'Vet Testing Recommended';
    tips.push('Multiple signs together are the strongest indication here — worth a vet visit for proper testing.');
    tips.push('This involves more than a routine blood panel — typically an ACTH stimulation test or a low-dose dexamethasone suppression test, both performed by a vet.');
    if (age === 'typical') {
      tips.push('Cushing\'s disease most commonly develops in middle-aged to senior dogs, which fits your dog\'s profile.');
    } else {
      tips.push('Cushing\'s is less typical in a younger dog, but multiple signs together still warrant the same proper workup — atypical presentations happen and should not be dismissed due to age.');
    }
    tips.push('Good news: it is manageable with daily medication, commonly trilostane, once diagnosed, though it needs careful ongoing vet monitoring.');
  } else if (symptoms === 'physical') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '🔍';
    heroTitle = 'Vet Visit Recommended';
    tips.push('A pot-bellied appearance, thinning hair, and skin changes are more classic, often later-stage physical signs of Cushing\'s disease.');
    tips.push('Worth a vet visit for proper testing rather than waiting for more signs to appear.');
    if (age === 'typical') {
      tips.push('This fits the typical middle-aged-to-senior onset pattern for Cushing\'s.');
    }
  } else if (symptoms === 'early') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '🔎';
    heroTitle = 'Worth a Proper Vet Workup';
    tips.push('Increased thirst, urination, and appetite is a common early Cushing\'s sign.');
    tips.push('But it is also seen in diabetes and kidney disease, so it needs a proper vet workup to distinguish the actual cause rather than assuming Cushing\'s specifically.');
    if (age === 'typical') {
      tips.push('Your dog\'s middle-aged-to-senior age fits the typical onset pattern, which is useful context for your vet.');
    }
  } else {
    wrapClass = 'pz-result-success';
    heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
    heroIcon = '✅';
    heroTitle = 'No Signs — Awareness Only';
    tips.push('No action is needed right now unless signs develop.');
    if (age === 'typical') {
      tips.push('Worth knowing: Cushing\'s disease (hyperadrenocorticism) most commonly develops in middle-aged to senior dogs, which is your dog\'s general age range.');
    } else {
      tips.push('Worth knowing: Cushing\'s disease (hyperadrenocorticism) most commonly develops in middle-aged to senior dogs, though your dog is currently in a less typical, younger range.');
    }
  }

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + symptomLabels[symptoms] + ' · ' + ageLabels[age] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Symptoms</div><div class="pz-result-cell-val" style="font-size:12px">' + symptomLabels[symptoms] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Age</div><div class="pz-result-cell-val" style="font-size:13px">' + ageLabels[age] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Your Guidance</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Dog Daily Calorie Calculator
function pzCalcDogCalorie() {
  var weightRaw = parseFloat(document.getElementById('pz_cal_weight')?.value) || 0;
  var stage = document.getElementById('pz_cal_stage')?.value || 'adult';
  var neuter = document.getElementById('pz_cal_neuter')?.value || 'neutered';
  var activity = document.getElementById('pz_cal_activity')?.value || 'moderate';
  var result = document.getElementById('pz-calc-result');
  if (!result) return;
  pzShowAnalyzing('pz-calc-result', "Calculating your dog's daily calorie target…");
  setTimeout(function() {

  if (!weightRaw || weightRaw <= 0) {
    result.style.display = 'block';
    result.innerHTML = '<div class="pz-result-warning" style="border-radius:12px;padding:16px;text-align:center"><strong>⚠️ Please enter your dog\'s weight.</strong></div>';
    return;
  }

  var weightKg = pzUnit === 'kg' ? weightRaw : weightRaw * 0.453592;
  var rer = 70 * Math.pow(weightKg, 0.75);

  var mult, stageLabel;
  if (stage === 'puppy') {
    stageLabel = 'Puppy';
    mult = activity === 'low' ? 2.2 : (activity === 'high' ? 2.8 : 2.5);
  } else if (stage === 'senior') {
    stageLabel = 'Senior';
    mult = activity === 'low' ? 1.2 : (activity === 'high' ? 1.4 : 1.3);
  } else {
    stageLabel = 'Adult';
    if (activity === 'high') {
      mult = 2.2;
    } else if (neuter === 'intact') {
      mult = 1.8;
    } else {
      mult = activity === 'low' ? 1.4 : 1.6;
    }
  }

  var daily = rer * mult;
  var low = Math.round(daily * 0.9);
  var high = Math.round(daily * 1.1);
  var mid = Math.round(daily);
  var treatBudget = Math.round(daily * 0.1);

  result.style.display = 'block';
  result.innerHTML =
    '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:linear-gradient(135deg,#1B5E20,#2E7D32);color:#fff;padding:28px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">✅ Daily Calorie Target</div>'
    + '<div class="pz-result-number">' + low + '–' + high + '</div>'
    + '<div class="pz-result-unit">calories per day (kcal)</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Base RER</div><div class="pz-result-cell-val">' + Math.round(rer) + ' kcal</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Life Stage</div><div class="pz-result-cell-val" style="font-size:15px">' + stageLabel + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Point Estimate</div><div class="pz-result-cell-val">~' + mid + ' kcal</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 What This Means</h4><ul>'
    + "<li>This target is built from your dog's Resting Energy Requirement (RER = 70 × weight in kg^0.75), shown above, then multiplied by a life-stage and activity factor.</li>"
    + '<li>Treats should stay under about 10% of this total — roughly <strong>' + treatBudget + ' kcal/day</strong>. Try our Dog Daily Treat Limit Calculator to turn that into an actual treat count.</li>'
    + "<li>Recheck this calculator every few months or after any change in your dog's weight, activity, or spay/neuter status.</li>"
    + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';
  }, 650);
}

// ── Dog Weight Loss Plan Calculator
function pzCalcDogWeightLoss() {
  var current = parseFloat(document.getElementById('pz_wl_current')?.value) || 0;
  var target = parseFloat(document.getElementById('pz_wl_target')?.value) || 0;
  var activity = document.getElementById('pz_wl_activity')?.value || 'moderate';
  var result = document.getElementById('pz-calc-result');
  if (!result) return;
  pzShowAnalyzing('pz-calc-result', "Building your dog's weight loss plan…");
  setTimeout(function() {

  if (!current || current <= 0 || !target || target <= 0) {
    result.style.display = 'block';
    result.innerHTML = '<div class="pz-result-warning" style="border-radius:12px;padding:16px;text-align:center"><strong>⚠️ Please enter both your dog\'s current and target weight.</strong></div>';
    return;
  }

  if (target >= current) {
    result.style.display = 'block';
    result.innerHTML =
      '<div class="pz-result-warning" style="border-radius:16px;overflow:hidden">'
      + '<div class="pz-result-hero" style="background:linear-gradient(135deg,#E65100,#FF9800);color:#fff;padding:28px">'
      + '<div style="font-size:13px;font-weight:700;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">ℹ️ No Weight Loss Needed</div>'
      + '<div style="font-size:20px;font-weight:900">Target Is At or Above Current Weight</div>'
      + '</div>'
      + '<div class="pz-result-tips"><h4>📋 What To Do Instead</h4><ul>'
      + "<li>This tool is built specifically for dogs who need to lose weight — your target should be below your dog's current weight.</li>"
      + '<li>If you\'re looking for a daily maintenance calorie target instead, try our Dog Daily Calorie Calculator.</li>'
      + '</ul></div>'
      + '</div>';
    return;
  }

  var toLose = current - target;
  var weeksFast = Math.ceil(toLose / (current * 0.02));
  var weeksPoint = Math.ceil(toLose / (current * 0.015));
  var weeksSlow = Math.ceil(toLose / (current * 0.01));
  var weeklyLossLbs = Math.round(current * 0.015 * 100) / 100;

  var weightKg = current * 0.453592;
  var rer = 70 * Math.pow(weightKg, 0.75);
  var dailyCal = Math.round(rer * 1.0);

  result.style.display = 'block';
  result.innerHTML =
    '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:linear-gradient(135deg,#1B5E20,#2E7D32);color:#fff;padding:28px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">🎯 Estimated Time to Goal</div>'
    + '<div class="pz-result-number">~' + weeksPoint + '</div>'
    + '<div class="pz-result-unit">weeks (range ' + weeksFast + '–' + weeksSlow + ' weeks depending on pace)</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Daily Calorie Target</div><div class="pz-result-cell-val">' + dailyCal + ' kcal</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Weekly Loss Rate</div><div class="pz-result-cell-val">~' + weeklyLossLbs + ' lbs/wk</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Total To Lose</div><div class="pz-result-cell-val">' + (Math.round(toLose * 10) / 10) + ' lbs</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Notes On This Plan</h4><ul>'
    + "<li>The daily calorie target is calculated from your dog's <strong>current</strong> weight (not the target), deliberately, to avoid an overly aggressive calorie cut.</li>"
    + '<li>A safe weight-loss pace is roughly 1–2% of body weight per week — this plan uses 1.5% as the point estimate.</li>'
    + '<li>Re-weigh your dog every 2 weeks. If progress stalls for 2+ rechecks in a row, check in with your vet to adjust the plan.</li>'
    + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';
  }, 650);
}

// ── Dog Protein Requirements Calculator
function pzCalcDogProtein() {
  var weightRaw = parseFloat(document.getElementById('pz_pr_weight')?.value) || 0;
  var stage = document.getElementById('pz_pr_stage')?.value || 'adult';
  var diet = document.getElementById('pz_pr_diet')?.value || 'commercial';
  var result = document.getElementById('pz-calc-result');
  if (!result) return;
  pzShowAnalyzing('pz-calc-result', "Estimating your dog's daily protein needs…");
  setTimeout(function() {

  if (!weightRaw || weightRaw <= 0) {
    result.style.display = 'block';
    result.innerHTML = '<div class="pz-result-warning" style="border-radius:12px;padding:16px;text-align:center"><strong>⚠️ Please enter your dog\'s weight.</strong></div>';
    return;
  }

  var weightKg = weightRaw * 0.453592;
  var factors = {puppy:5.2, adult:4.5, senior:4.8, active:6.0};
  var aafco = {puppy:'22.5% (AAFCO growth minimum)', adult:'18% (AAFCO adult maintenance minimum)', senior:'18%+ (no routine restriction advised)', active:'25–30%+ (typical for working dogs)'};
  var stageLabels = {puppy:'Puppy (Growth)', adult:'Adult (Maintenance)', senior:'Senior', active:'Active/Working Dog'};
  var factor = factors[stage] || factors.adult;
  var grams = weightKg * factor;
  var low = Math.round(grams * 0.9);
  var high = Math.round(grams * 1.15);

  result.style.display = 'block';
  result.innerHTML =
    '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:linear-gradient(135deg,#1B5E20,#2E7D32);color:#fff;padding:28px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">💪 Approximate Daily Protein Target</div>'
    + '<div class="pz-result-number">' + low + '–' + high + '</div>'
    + '<div class="pz-result-unit">grams of protein per day</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">AAFCO Reference</div><div class="pz-result-cell-val" style="font-size:13px">' + aafco[stage] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Life Stage</div><div class="pz-result-cell-val" style="font-size:15px">' + stageLabels[stage] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Body Weight</div><div class="pz-result-cell-val">' + weightRaw + ' lbs</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 What This Means</h4><ul>'
    + (diet === 'homemade'
        ? "<li>Since you're feeding homemade or raw, hitting this gram target consistently matters — consider running your recipe past a board-certified veterinary nutritionist to confirm it's complete and balanced.</li>"
        : "<li>Complete-and-balanced commercial dog foods are already formulated to meet these needs — this estimate is mainly useful for double-checking a food label's guaranteed analysis against your dog's size.</li>")
    + "<li>These figures scale AAFCO's minimum protein guidelines to your dog's body weight — they're a reasonable baseline, not a hard ceiling.</li>"
    + '<li>If your vet has diagnosed kidney disease, protein needs change significantly — see our Dog Kidney Disease Diet Guide instead of using this general calculator.</li>'
    + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';
  }, 650);
}

// ── Dog Water Intake Calculator
function pzCalcDogHydration() {
  var weightRaw = parseFloat(document.getElementById('pz_hy_weight')?.value) || 0;
  var diet = document.getElementById('pz_hy_diet')?.value || 'dry';
  var climate = document.getElementById('pz_hy_climate')?.value || 'normal';
  var result = document.getElementById('pz-calc-result');
  if (!result) return;
  pzShowAnalyzing('pz-calc-result', "Estimating your dog's daily water needs…");
  setTimeout(function() {

  if (!weightRaw || weightRaw <= 0) {
    result.style.display = 'block';
    result.innerHTML = '<div class="pz-result-warning" style="border-radius:12px;padding:16px;text-align:center"><strong>⚠️ Please enter your dog\'s weight.</strong></div>';
    return;
  }

  var dietFactor = {dry:1.0, wet:0.75, mixed:0.875}[diet];
  if (!dietFactor) dietFactor = 1.0;
  var climateFactor = {normal:1.0, hot_active:1.25}[climate];
  if (!climateFactor) climateFactor = 1.0;
  var dietLabels = {dry:'Dry Kibble', wet:'Wet/Canned Food', mixed:'Mixed Dry & Wet'};
  var climateLabels = {normal:'Normal Activity, Mild Climate', hot_active:'Hot Weather / High Activity'};

  var ozPerLb = 1.0 * dietFactor * climateFactor;
  var totalOz = weightRaw * ozPerLb;
  var ozLow = Math.round(totalOz * 0.9 * 10) / 10;
  var ozHigh = Math.round(totalOz * 1.1 * 10) / 10;
  var mlLow = Math.round(ozLow * 29.5735);
  var mlHigh = Math.round(ozHigh * 29.5735);
  var lLow = Math.round((mlLow / 1000) * 10) / 10;
  var lHigh = Math.round((mlHigh / 1000) * 10) / 10;

  result.style.display = 'block';
  result.innerHTML =
    '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:linear-gradient(135deg,#0277BD,#0288D1);color:#fff;padding:28px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">💧 Daily Water Intake</div>'
    + '<div class="pz-result-number">' + ozLow + '–' + ozHigh + '</div>'
    + '<div class="pz-result-unit">fluid oz per day (roughly ' + lLow + '–' + lHigh + ' L / ' + mlLow + '–' + mlHigh + ' ml)</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Diet Type</div><div class="pz-result-cell-val" style="font-size:14px">' + dietLabels[diet] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Conditions</div><div class="pz-result-cell-val" style="font-size:13px">' + climateLabels[climate] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Body Weight</div><div class="pz-result-cell-val">' + weightRaw + ' lbs</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Notes &amp; Warning Signs</h4><ul>'
    + "<li>This is roughly how much water bowl consumption to expect — dogs on wet or mixed food get meaningful hydration from their meals, so they'll drink less from the bowl.</li>"
    + '<li>Pregnant or nursing dogs need meaningfully more water than this baseline — check with your vet for a nursing-specific estimate.</li>'
    + "<li>Dehydration warning signs worth a vet call: dry or tacky gums, skin that stays 'tented' when gently pinched, and unusual lethargy.</li>"
    + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';
  }, 650);
}

// ── Dog Daily Treat Limit Calculator
function pzCalcDogTreat() {
  var weightRaw = parseFloat(document.getElementById('pz_tr_weight')?.value) || 0;
  var activity = document.getElementById('pz_tr_activity')?.value || 'moderate';
  var size = document.getElementById('pz_tr_size')?.value || 'medium';
  var result = document.getElementById('pz-calc-result');
  if (!result) return;
  pzShowAnalyzing('pz-calc-result', "Working out your dog's daily treat budget…");
  setTimeout(function() {

  if (!weightRaw || weightRaw <= 0) {
    result.style.display = 'block';
    result.innerHTML = '<div class="pz-result-warning" style="border-radius:12px;padding:16px;text-align:center"><strong>⚠️ Please enter your dog\'s weight.</strong></div>';
    return;
  }

  var weightKg = weightRaw * 0.453592;
  var rer = 70 * Math.pow(weightKg, 0.75);
  var mults = {low:1.4, moderate:1.6, high:2.2};
  var dailyCal = rer * (mults[activity] || 1.6);
  var treatBudget = Math.round(dailyCal * 0.10);
  var calPerTreat = {small:4, medium:25, large:75}[size];
  if (!calPerTreat) calPerTreat = 25;
  var sizeLabels = {small:'Small training treats (~3–5 cal each)', medium:'Medium biscuits (~20–30 cal each)', large:'Large treats/chews (~50–100+ cal each)'};
  var maxTreats = Math.floor(treatBudget / calPerTreat);
  if (maxTreats < 1) maxTreats = 1;

  result.style.display = 'block';
  result.innerHTML =
    '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:linear-gradient(135deg,#6D4C41,#8D6E63);color:#fff;padding:28px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">🦴 Daily Treat Budget</div>'
    + '<div class="pz-result-number">' + treatBudget + '</div>'
    + '<div class="pz-result-unit">calories/day (about 10% of daily intake)</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Max Treats/Day</div><div class="pz-result-cell-val">~' + maxTreats + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Est. Daily Calories</div><div class="pz-result-cell-val">' + Math.round(dailyCal) + ' kcal</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Treat Size</div><div class="pz-result-cell-val" style="font-size:12px">' + sizeLabels[size] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Notes</h4><ul>'
    + "<li>Vets widely recommend keeping treats under 10% of a dog's total daily calories, with the remaining 90% coming from a complete-and-balanced main diet.</li>"
    + '<li>Training with lots of repetitions? Break treats into smaller pieces, or use a portion of your dog\'s regular kibble as training rewards to stay within budget.</li>'
    + "<li>This max-treat count is approximate — bigger treats within a size category will use up the budget faster, so check the calorie count on the package when you can.</li>"
    + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';
  }, 650);
}


// ── Puppy Feeding Guide
function pzGenPuppyFeeding() {
  var age = document.getElementById('pz_pf_age')?.value || '8to12wk';
  var size = document.getElementById('pz_pf_size')?.value || 'medium';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', "Building your puppy's feeding schedule…");
  setTimeout(function() {

  var ageLabels = {'8to12wk': '8–12 weeks', '3to6mo': '3–6 months', '6to12mo': '6–12 months', '12moplus': '12+ months'};
  var sizeLabels = {small: 'Small (under 25 lbs)', medium: 'Medium (25–60 lbs)', large: 'Large (60–100 lbs)', giant: 'Giant (100+ lbs)'};
  var isBig = (size === 'large' || size === 'giant');

  var meals, heroTitle, tips = [];

  if (age === '8to12wk') {
    meals = 4;
    heroTitle = '4 Meals a Day';
    tips.push('At 8–12 weeks, 4 meals a day supports your puppy\'s fast metabolism and small stomach capacity.');
  } else if (age === '3to6mo') {
    meals = 3;
    heroTitle = '3 Meals a Day';
    tips.push('At 3–6 months, most puppies are ready to drop from 4 meals a day to 3.');
  } else if (age === '6to12mo') {
    meals = 2;
    heroTitle = '2 Meals a Day';
    tips.push('At 6–12 months, 2 meals a day is the standard recommendation for nearly all puppies, regardless of eventual size.');
  } else {
    if (isBig) {
      meals = 2;
      heroTitle = '2 Meals a Day — Stay on Puppy Food';
      tips.push('Large and giant breeds often stay on puppy food and 2 meals a day well past 12 months.');
      tips.push('Plan to transition to adult food around 18–24 months, not before — growth plates close later in large and giant breeds, and rapid early growth is itself a joint-health risk factor, so there is no benefit to rushing the switch.');
    } else {
      meals = '1–2';
      heroTitle = '1–2 Meals a Day';
      tips.push('Small and medium breeds can typically transition to 1–2 meals a day around now, along with moving toward adult food.');
    }
  }

  tips.push("Portion amount should follow your specific puppy food bag's calorie guidance for your puppy's current weight — not a generic number, since calorie density varies a lot by brand.");
  tips.push('Your vet checks body condition at every puppy visit — this is the earliest and most reliable way to catch over- or under-feeding before it becomes a pattern.');

  var wrapClass = 'pz-result-success';
  var heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
  var heroIcon = '🍼';

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:28px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' Recommended Meal Frequency</div>'
    + '<div class="pz-result-number">' + meals + '</div>'
    + '<div class="pz-result-unit">meals per day</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Age</div><div class="pz-result-cell-val" style="font-size:13px">' + ageLabels[age] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Est. Adult Size</div><div class="pz-result-cell-val" style="font-size:13px">' + sizeLabels[size] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>🍼 ' + heroTitle + '</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Raw Diet for Dogs Guide
function pzGenRawDiet() {
  var reason = document.getElementById('pz_rd_reason')?.value || 'general_health';
  var prep = document.getElementById('pz_rd_prep')?.value || 'commercial';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Weighing the raw diet evidence for your situation…');
  setTimeout(function() {

  var reasonLabels = {general_health: 'General health/coat', allergies: 'Suspected food allergies', picky_eater: 'Picky eater'};
  var prepLabels = {commercial: 'Commercial ready-to-feed raw', diy: 'DIY prep from scratch'};

  var tips = [];
  tips.push('Owner-reported benefits like coat and energy exist anecdotally, but the controlled veterinary nutrition evidence behind them is genuinely mixed, not settled.');
  tips.push('Bacterial contamination — Salmonella, E. coli, Listeria — is a real handling and zoonotic risk with raw meat, especially relevant if anyone in the household is immunocompromised, very young, or elderly.');
  tips.push('Any raw diet has to be complete-and-balanced just like any other diet — calcium:phosphorus ratio, taurine, and specific vitamins are real deficiency risks if it is not properly formulated.');

  if (prep === 'commercial') {
    tips.push('Reputable commercial ready-to-feed raw brands formulate to AAFCO standards, which makes this generally the safer starting point compared to DIY.');
  } else {
    tips.push("DIY \"meat and bones\" without a properly formulated recipe risks real deficiencies — work with a board-certified veterinary nutritionist for a properly formulated recipe rather than following a random recipe found online.");
  }

  if (reason === 'allergies') {
    tips.push('Raw is not inherently hypoallergenic just because it is raw. A proper elimination diet trial — ideally vet-guided, often using a novel protein or a hydrolyzed prescription diet — is the actual diagnostic gold standard for food allergies.');
  }

  var wrapClass = (prep === 'diy') ? 'pz-result-warning' : 'pz-result-success';
  var heroColor = (prep === 'diy') ? 'linear-gradient(135deg,#E65100,#FF9800)' : 'linear-gradient(135deg,#1B5E20,#2E7D32)';
  var heroIcon = (prep === 'diy') ? '⚠️' : '🥩';
  var heroTitle = (prep === 'diy') ? 'DIY Raw Needs a Formulated Recipe' : 'Commercial Raw: A Reasonable Starting Point';

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + reasonLabels[reason] + ' · ' + prepLabels[prep] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Reason</div><div class="pz-result-cell-val" style="font-size:12px">' + reasonLabels[reason] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Preparation</div><div class="pz-result-cell-val" style="font-size:12px">' + prepLabels[prep] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>🥩 What Matters for Your Situation</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Homemade Dog Food Guide
function pzGenHomemadeFood() {
  var goal = document.getElementById('pz_hf_goal')?.value || 'general';
  var time = document.getElementById('pz_hf_time')?.value || 'low';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Building your homemade food guidance…');
  setTimeout(function() {

  var goalLabels = {general: 'General homemade diet', condition: 'Managing a specific health condition', picky: 'Picky eater/appetite issues'};
  var timeLabels = {low: 'Limited — need simple/batchable', high: 'Flexible — can prep more involved meals'};

  var tips = [];

  if (goal === 'condition') {
    tips.push("A condition-specific homemade diet needs to be designed with your vet for that specific condition — general homemade advice does not apply here, since the right nutrient balance depends entirely on the condition being managed.");
  } else {
    tips.push('The single most important principle: homemade diets must be complete-and-balanced, not just "meat and rice" or whatever looks healthy.');
    tips.push('Nutrient deficiencies — especially calcium:phosphorus ratio, taurine, zinc, vitamin D, and essential fatty acids — are a real, well-documented risk in ad-hoc homemade diets, even ones that look reasonable.');
  }

  tips.push('Use a properly formulated recipe from a board-certified veterinary nutritionist — services like balanceit.com are a real example of what "properly formulated" looks like, not a random blog recipe.');

  if (time === 'low') {
    tips.push('With limited cooking time, batch-cook a larger quantity on one day, then portion and freeze meals — the practical way to sustain a homemade diet without cooking daily.');
  } else {
    tips.push('With more flexible time, you can still batch a portion of your cooking to build in a buffer for busier weeks.');
  }

  if (goal === 'picky') {
    tips.push('For appetite issues, work any recipe changes into a diet that is still complete-and-balanced — introducing variety within a formulated recipe, rather than ad-hoc additions, keeps nutrition on track.');
  }

  var wrapClass = (goal === 'condition') ? 'pz-result-warning' : 'pz-result-success';
  var heroColor = (goal === 'condition') ? 'linear-gradient(135deg,#E65100,#FF9800)' : 'linear-gradient(135deg,#1B5E20,#2E7D32)';
  var heroIcon = (goal === 'condition') ? '🩺' : '🍲';
  var heroTitle = (goal === 'condition') ? 'Talk to Your Vet First' : 'Complete-and-Balanced Is the Goal';

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + goalLabels[goal] + ' · ' + timeLabels[time] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Goal</div><div class="pz-result-cell-val" style="font-size:12px">' + goalLabels[goal] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Cooking Time</div><div class="pz-result-cell-val" style="font-size:12px">' + timeLabels[time] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>🍲 Your Homemade Food Guidance</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Best Dog Food Guide
function pzGenBestDogFood() {
  var priority = document.getElementById('pz_bf_priority')?.value || 'budget';
  var size = document.getElementById('pz_bf_size')?.value || 'medium';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Evaluating what matters most for your dog food search…');
  setTimeout(function() {

  var priorityLabels = {budget: 'Budget-friendly', premium: 'Premium ingredients', health: 'Specific health need'};
  var sizeLabels = {small: 'Small (under 25 lbs)', medium: 'Medium (25–60 lbs)', large: 'Large (60–100 lbs)', giant: 'Giant (100+ lbs)'};

  var tips = [];
  tips.push('Check the AAFCO "complete and balanced" statement for the correct life stage first — it is a legal nutritional adequacy claim, not marketing.');
  tips.push('Ingredient order matters somewhat, but named meat listed first is not the only valid signal — meat meal is a concentrated, legitimate protein source, not automatically inferior to fresh meat, which is mostly water by weight.');
  tips.push('Be skeptical of marketing terms like "grain-free," "human-grade," or "holistic" without nutritional adequacy evidence behind them.');
  tips.push('Check whether the company ran actual AAFCO feeding trials (stronger evidence) or relied only on nutrient-profile formulation (weaker, though still compliant).');
  tips.push('WSAVA (World Small Animal Veterinary Association) publishes real, respected guidelines for evaluating pet food companies — a qualified nutritionist on staff, owned manufacturing, and published nutrient analyses on request.');

  if (priority === 'budget') {
    tips.push('A solid, AAFCO-compliant mainstream food from a company with good quality control is nutritionally fine — expensive is not automatically better.');
  } else if (priority === 'health') {
    tips.push('For a specific health need, general food-quality guidance is not enough — talk to your vet for a condition-specific recommendation rather than choosing based on general guidance alone.');
  }

  if (size === 'large' || size === 'giant') {
    tips.push('For large and giant breeds, also confirm the food is labeled for your dog\'s correct life stage — large breed puppy formulas in particular are calcium-controlled to support slower, joint-friendly growth.');
  }

  var wrapClass = (priority === 'health') ? 'pz-result-warning' : 'pz-result-success';
  var heroColor = (priority === 'health') ? 'linear-gradient(135deg,#E65100,#FF9800)' : 'linear-gradient(135deg,#1B5E20,#2E7D32)';
  var heroIcon = (priority === 'health') ? '🩺' : '🛒';
  var heroTitle = (priority === 'health') ? 'Talk to Your Vet for This One' : 'What to Check First';

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + priorityLabels[priority] + ' · ' + sizeLabels[size] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Priority</div><div class="pz-result-cell-val" style="font-size:12px">' + priorityLabels[priority] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Dog Size</div><div class="pz-result-cell-val" style="font-size:12px">' + sizeLabels[size] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>🛒 Your Dog Food Checklist</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Foods Toxic to Dogs Guide (safety-critical: per-food, per-amount urgency)
function pzGenToxicFoods() {
  var food = document.getElementById('pz_tf_food')?.value || 'other';
  var amount = document.getElementById('pz_tf_amount')?.value || 'unknown';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', "Checking your dog's specific risk level…");
  setTimeout(function() {

  var foodLabels = {
    chocolate: 'Chocolate',
    grapes: 'Grapes or Raisins',
    onion_garlic: 'Onions or Garlic',
    xylitol: 'Xylitol (sugar-free gum/candy/some peanut butters)',
    alcohol: 'Alcohol',
    macadamia: 'Macadamia Nuts',
    other: 'Something else / not sure'
  };
  var amountLabels = {small: 'A small amount / lick', large: 'A significant amount', unknown: 'Not sure how much'};

  var tips = [];
  var urgencyLabel, wrapClass, heroColor, heroIcon, heroTitle;

  if (food === 'xylitol') {
    urgencyLabel = 'HIGH — Call Now';
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#B71C1C,#E65100)';
    heroIcon = '🚨';
    heroTitle = 'Call Poison Control or an Emergency Vet Now';
    tips.push('Xylitol is extremely dangerous even in small amounts — this does not change based on how much was eaten.');
    tips.push('It causes a rapid release of insulin, leading to dangerous hypoglycemia (low blood sugar), and can cause liver failure.');
    tips.push('Call ASPCA Animal Poison Control or an emergency vet immediately — do not wait for symptoms to appear.');
  } else if (food === 'grapes') {
    urgencyLabel = 'HIGH — Call Now';
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#B71C1C,#E65100)';
    heroIcon = '🚨';
    heroTitle = 'Call Poison Control or Your Vet Now — Any Amount';
    tips.push('Grapes and raisins can cause acute kidney failure in dogs.');
    tips.push('There is no established "safe amount" — this is one of the few toxic foods where the amount eaten does not change the recommendation.');
    tips.push('Any ingestion warrants an immediate call to your vet or ASPCA Animal Poison Control.');
  } else if (food === 'chocolate') {
    if (amount === 'large' || amount === 'unknown') {
      urgencyLabel = 'HIGH — Call Now';
      wrapClass = 'pz-result-warning';
      heroColor = 'linear-gradient(135deg,#B71C1C,#E65100)';
      heroIcon = '🚨';
      heroTitle = 'Call Poison Control or Your Vet Now';
      tips.push('A significant or uncertain amount of chocolate warrants an immediate call to poison control or your vet.');
    } else {
      urgencyLabel = 'CHECK — Better Safe Than Sorry';
      wrapClass = 'pz-result-warning';
      heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
      heroIcon = '⚠️';
      heroTitle = 'Better to Check Than Wait';
      tips.push('Even a small amount is worth a quick call to check, based on the exact chocolate type and your dog\'s size.');
    }
    tips.push('Dark or baking chocolate is far more dangerous than milk chocolate, because it contains much more theobromine.');
    tips.push('Small dogs are at higher risk than large dogs from the exact same amount of chocolate.');
  } else if (food === 'onion_garlic') {
    tips.push('Onion and garlic damage red blood cells, and the effect is cumulative — a single small taste is lower risk than a repeated or large exposure.');
    if (amount === 'large' || amount === 'unknown') {
      urgencyLabel = 'ELEVATED — Vet Call Recommended';
      wrapClass = 'pz-result-warning';
      heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
      heroIcon = '⚠️';
      heroTitle = 'Vet Call Recommended';
      tips.push('A significant or uncertain amount is worth a call to your vet rather than just monitoring.');
    } else {
      urgencyLabel = 'MONITOR — Watch for 24–48 Hours';
      wrapClass = 'pz-result-success';
      heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
      heroIcon = '👀';
      heroTitle = 'Monitor Over the Next 24–48 Hours';
      tips.push('For a small amount, monitor for lethargy, pale gums, or vomiting over the next 24–48 hours, and call your vet if any of these appear.');
    }
  } else if (food === 'alcohol') {
    urgencyLabel = 'HIGH — Call Now';
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#B71C1C,#E65100)';
    heroIcon = '🚨';
    heroTitle = 'Call Your Vet Now';
    tips.push('Dogs are much more sensitive to alcohol than humans by body weight — even a small amount can be dangerous.');
    tips.push('Call your vet or ASPCA Animal Poison Control now rather than waiting to see if symptoms develop.');
  } else if (food === 'macadamia') {
    urgencyLabel = 'HIGH — Call Now';
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#B71C1C,#E65100)';
    heroIcon = '🚨';
    heroTitle = 'Call Your Vet Now';
    tips.push('Macadamia nuts can cause weakness, tremors, and hyperthermia in dogs — the exact toxic mechanism is not fully understood, but the effect is well-documented.');
    tips.push('Call your vet for guidance for any real amount eaten.');
  } else {
    urgencyLabel = 'CHECK — Don\'t Guess';
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '📞';
    heroTitle = "When You're Not Sure, Call to Check";
    tips.push("If you're unsure whether something is toxic, call ASPCA Animal Poison Control (a real, actual 24/7 resource) or your vet with the specific item name — do not guess.");
  }

  tips.push("Having the food's packaging or label on hand helps whoever you call assess the situation faster.");

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + foodLabels[food] + ' · ' + amountLabels[amount] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Food Eaten</div><div class="pz-result-cell-val" style="font-size:12px">' + foodLabels[food] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Urgency</div><div class="pz-result-cell-val" style="font-size:12px">' + urgencyLabel + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>☠️ What to Do Now</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Grain-Free Dog Food Guide
function pzGenGrainFree() {
  var reason = document.getElementById('pz_gf_reason')?.value || 'preference';
  var current = document.getElementById('pz_gf_current')?.value || 'no';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Reviewing the current grain-free evidence for your dog…');
  setTimeout(function() {

  var reasonLabels = {diagnosed: 'Vet-diagnosed grain allergy', preference: 'General preference', trend: "Heard it's healthier"};
  var currentLabels = {yes: 'Yes', no: 'No'};

  var tips = [];
  tips.push('True grain allergies in dogs are actually uncommon — protein sources like beef, chicken, dairy, and egg are far more common canine food allergens than grains.');
  tips.push('The FDA has investigated a potential association between certain grain-free diets — particularly those where legumes, peas, or lentils are primary ingredients replacing grains — and DCM (dilated cardiomyopathy, a serious heart condition), including in breeds not typically predisposed to it. This is not fully settled science, but it is a genuine, current area of veterinary caution.');

  if (reason === 'diagnosed') {
    tips.push('Grain-free is appropriate for a genuine diagnosed grain allergy — but not all "grain-free" foods are equal. Some replace grains with legume-heavy formulas relevant to the DCM concern above, so it is worth discussing the specific food with your vet.');
  } else {
    tips.push('Without a diagnosed need, it is worth discussing with your vet before switching — a genuine grain allergy is uncommon, and there is often no nutritional need to avoid grains at all.');
  }

  if (current === 'yes') {
    tips.push("Since you're currently feeding grain-free, mention it to your vet at your next visit — especially worth flagging if you've noticed any reduced stamina, coughing, or exercise intolerance, as routine due diligence rather than an alarm.");
  }

  var needsCare = (reason !== 'diagnosed') || (current === 'yes');
  var wrapClass = needsCare ? 'pz-result-warning' : 'pz-result-success';
  var heroColor = needsCare ? 'linear-gradient(135deg,#E65100,#FF9800)' : 'linear-gradient(135deg,#1B5E20,#2E7D32)';
  var heroIcon = needsCare ? '❤️' : '🌾';
  var heroTitle = needsCare ? 'Worth a Vet Conversation' : 'Grain-Free Fits Your Situation';

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + reasonLabels[reason] + ' · Currently grain-free: ' + currentLabels[current] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Reason</div><div class="pz-result-cell-val" style="font-size:12px">' + reasonLabels[reason] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Currently Grain-Free</div><div class="pz-result-cell-val" style="font-size:13px">' + currentLabels[current] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>🌾 Your Grain-Free Guidance</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Senior Dog Diet Guide
function pzGenSeniorDiet() {
  var age = document.getElementById('pz_sd_age')?.value || '7to10';
  var weight = document.getElementById('pz_sd_weight')?.value || 'ideal';
  var health = document.getElementById('pz_sd_health')?.value || 'none';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', "Building your senior dog's diet plan…");
  setTimeout(function() {

  var ageLabels = {'7to10': '7–10 years', '10plus': '10+ years'};
  var weightLabels = {ideal: 'At ideal weight', overweight: 'Overweight', underweight: 'Underweight'};
  var healthLabels = {none: 'None known', joint: 'Joint stiffness/arthritis', kidney: 'Kidney disease (vet-diagnosed)', dental: 'Dental issues'};

  var tips = [];
  tips.push("Current veterinary guidance has moved away from routinely restricting protein in healthy senior dogs — that's appropriate only for a vet-diagnosed kidney condition, not just because a dog is getting older.");
  tips.push('Healthy seniors generally need similar, or even slightly higher, protein density relative to calories to help maintain muscle mass, since age-related muscle loss (sarcopenia) is a real concern.');

  if (age === '10plus') {
    tips.push("At 10+ years, muscle maintenance and slower metabolism both matter more — a calorie-appropriate, protein-adequate food is worth prioritizing over a generic \"senior formula.\"");
  } else {
    tips.push("At 7–10 years, this is the early senior stage — total calorie needs typically start easing down while protein needs stay steady.");
  }

  var wrapClass = 'pz-result-success';
  var heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
  var heroIcon = '🐕';
  var heroTitle = "Your Senior Diet Game Plan";

  if (health === 'kidney') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '🏥';
    heroTitle = 'Kidney-Specific Diet Needed — See Your Vet';
    tips.push("A vet-diagnosed kidney condition is exactly the situation where protein restriction becomes appropriate — but the specifics are individual and vet-prescribed, not something general guidance should attempt.");
    tips.push('Please see our dedicated Dog Kidney Disease Diet guide and work directly with your vet on the right formula and protein target for your dog.');
  } else if (health === 'joint') {
    tips.push('Omega-3 fatty acids and glucosamine/chondroitin are commonly beneficial for joint stiffness — the evidence is reasonably supportive, though the effect is typically modest rather than dramatic.');
    tips.push('See our Dog Supplements guide for more on what evidence supports and what to look for in a quality product.');
  } else if (health === 'dental') {
    tips.push('Smaller kibble or softened food can genuinely help if dental discomfort is making eating harder.');
    tips.push("Dental issues are worth a vet check regardless of diet changes — discomfort while eating often has a fixable underlying cause.");
  }

  if (weight === 'overweight') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '⚖️';
    heroTitle = 'Calorie-Aware Senior Feeding Plan';
    tips.push('Seniors typically need somewhat fewer total calories as metabolism and activity slow — for a dog already overweight, see our Dog Weight Loss Plan calculator for a structured approach.');
  } else if (weight === 'underweight') {
    if (health !== 'kidney') {
      wrapClass = 'pz-result-warning';
      heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
      heroIcon = '📈';
      heroTitle = 'Extra Calories &amp; a Vet Check Recommended';
    }
    tips.push("Unexplained weight loss in a senior dog is worth a vet check rather than assuming it's normal aging — it can signal dental pain, inadequate calories, or an underlying illness.");
  } else {
    tips.push("At an ideal weight, keep portions steady and recheck body condition every few months, since senior calorie needs can drift gradually.");
  }

  tips.push('Bring this result to your next vet visit — it gives you a concrete starting point for the conversation.');

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + ageLabels[age] + ' · ' + weightLabels[weight] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Age</div><div class="pz-result-cell-val" style="font-size:13px">' + ageLabels[age] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Weight Status</div><div class="pz-result-cell-val" style="font-size:13px">' + weightLabels[weight] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Health Issues</div><div class="pz-result-cell-val" style="font-size:11px">' + healthLabels[health] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>🐕 Your Senior Diet Guidance</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Dog Food Allergies Guide
function pzGenFoodAllergies() {
  var symptoms = document.getElementById('pz_fa_symptoms')?.value || 'skin';
  var timeframe = document.getElementById('pz_fa_timeframe')?.value || 'recent';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', "Reviewing your dog's symptom pattern…");
  setTimeout(function() {

  var symptomLabels = {skin: 'Skin itching, ear infections, or paw licking', gi: 'GI upset (vomiting/diarrhea)', both: 'Both skin and GI symptoms'};
  var timeframeLabels = {recent: 'Started after a recent diet/treat change', chronic: 'Chronic, ongoing for months'};

  var tips = [];
  tips.push('True food allergies are most commonly triggered by specific protein sources — beef, dairy, chicken, egg, and lamb are the most frequently cited culprits — not grains.');

  if (symptoms === 'skin' || symptoms === 'both') {
    tips.push('Skin-focused signs like itching, recurrent ear infections, and paw licking or chewing are frequently the leading symptoms in documented food allergy cases — even more than GI upset.');
  }
  if (symptoms === 'gi' || symptoms === 'both') {
    tips.push('GI signs like vomiting or diarrhea occur too, sometimes alongside skin symptoms and sometimes on their own.');
  }

  var wrapClass, heroColor, heroIcon, heroTitle;

  if (timeframe === 'recent') {
    wrapClass = 'pz-result-success';
    heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
    heroIcon = '🔎';
    heroTitle = 'The Recent Change Is Your Prime Suspect';
    tips.push('Since symptoms started after a recent diet or treat change, that new ingredient is the prime suspect — reverting to the prior diet and observing is a reasonable first step.');
    tips.push("If symptoms don't clear up after reverting, or they return, that's a sign to move on to a proper vet-guided elimination trial.");
  } else {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '🩺';
    heroTitle = 'This Needs a Proper Elimination Trial';
    tips.push("Chronic, ongoing symptoms need a proper vet-guided elimination diet trial, not more guessing — that means an 8–12 week trial using a single novel protein source or a hydrolyzed prescription diet.");
  }

  tips.push("Skip the at-home blood or saliva \"food allergy\" test kits — they're not well-validated scientifically and shouldn't be relied on for diagnosis.");
  tips.push('The genuine diagnostic gold standard remains an 8–12 week elimination diet trial done under veterinary guidance.');

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + symptomLabels[symptoms] + ' · ' + timeframeLabels[timeframe] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Symptoms</div><div class="pz-result-cell-val" style="font-size:12px">' + symptomLabels[symptoms] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Timeframe</div><div class="pz-result-cell-val" style="font-size:12px">' + timeframeLabels[timeframe] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>🤧 Your Food Allergy Guidance</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Dog Supplements Guide
function pzGenSupplements() {
  var concern = document.getElementById('pz_sup_concern')?.value || 'general';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', "Checking the evidence for your dog's supplement needs…");
  setTimeout(function() {

  var concernLabels = {joint: 'Joint health', skin_coat: 'Skin & coat', digestive: 'Digestive health', general: 'General wellness'};

  var tips = [];
  var heroIcon, heroTitle, heroColor;

  if (concern === 'joint') {
    heroIcon = '🦴'; heroTitle = 'Joint Support: Real but Modest Evidence'; heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
    tips.push('Glucosamine/chondroitin has reasonably supportive evidence for joint health, though the effect size tends to be modest rather than dramatic.');
    tips.push("Omega-3 fatty acids also have anti-inflammatory benefit that's relevant to joint health, alongside their other benefits.");
  } else if (concern === 'skin_coat') {
    heroIcon = '✨'; heroTitle = 'Skin & Coat: Strong Supporting Evidence'; heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
    tips.push('Omega-3 fatty acids (fish oil, EPA/DHA) have good supporting evidence specifically for skin and coat health — one of the better-evidenced supplement categories overall.');
  } else if (concern === 'digestive') {
    heroIcon = '🦠'; heroTitle = 'Digestive Health: Growing Evidence'; heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
    tips.push('Probiotics have growing supportive evidence for digestive health in dogs — a reasonable, evidence-informed choice for this concern.');
  } else {
    heroIcon = '➕'; heroTitle = 'Diet First, Supplements Additive'; heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    tips.push('A complete and balanced diet already covers most nutritional needs — supplements are additive, not foundational.');
    tips.push("A healthy dog already eating a good, complete diet often doesn't need a general \"multivitamin\" type product.");
  }

  tips.push('Pet supplements are not FDA-regulated for quality and purity the way drugs are — look for the NASC (National Animal Supplement Council) seal as a real, meaningful third-party quality signal.');
  tips.push('Supplements are not a substitute for a complete and balanced diet.');
  tips.push('Always discuss any supplement with your vet first, especially if your dog takes other medications — interaction risk is real.');

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">Primary Concern: ' + concernLabels[concern] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Concern</div><div class="pz-result-cell-val" style="font-size:13px">' + concernLabels[concern] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Quality Signal</div><div class="pz-result-cell-val" style="font-size:13px">NASC Seal</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>💊 Your Supplement Guidance</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Pregnant Dog Nutrition Guide
function pzGenPregnantNutrition() {
  var stage = document.getElementById('pz_pn_stage')?.value || 'early';
  var litter = document.getElementById('pz_pn_litter')?.value || 'unknown';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', "Building your pregnant dog's feeding plan…");
  setTimeout(function() {

  var stageLabels = {early: 'Early (weeks 1–4)', mid: 'Mid (weeks 5–6)', late: 'Late (weeks 7–9)', nursing: 'Nursing/Lactating'};
  var litterLabels = {unknown: 'Not sure yet', few: 'Small litter (1–3)', average: 'Average litter (4–6)', many: 'Large litter (7+)'};

  var tips = [];
  var wrapClass = 'pz-result-success';
  var heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
  var heroIcon = '🐕';
  var heroTitle = 'Your Feeding Plan for This Stage';

  if (stage === 'early') {
    tips.push("Calorie needs stay close to normal during early pregnancy (weeks 1–4) — contrary to the popular \"eating for the litter\" idea, no dramatic diet change is needed yet.");
    tips.push('This is a good time to plan the transition to a calorie-dense puppy/growth-formula food for week 5 onward.');
  } else if (stage === 'mid') {
    wrapClass = 'pz-result-warning'; heroColor = 'linear-gradient(135deg,#E65100,#FF9800)'; heroIcon = '📈'; heroTitle = 'Calorie Needs Are Rising Now';
    tips.push('From week 5 onward, calorie needs increase more meaningfully — this is the point to be feeding a calorie-dense puppy/growth-formula food.');
  } else if (stage === 'late') {
    wrapClass = 'pz-result-warning'; heroColor = 'linear-gradient(135deg,#E65100,#FF9800)'; heroIcon = '📈'; heroTitle = 'Late Pregnancy: Elevated Needs Continue';
    tips.push('Late pregnancy keeps calorie needs elevated on a calorie-dense puppy/growth formula — but nursing, just ahead, will demand even more.');
  } else {
    wrapClass = 'pz-result-warning'; heroColor = 'linear-gradient(135deg,#B71C1C,#E65100)'; heroIcon = '🍼'; heroTitle = 'Nursing: The Peak-Demand Stage';
    tips.push('Nursing is often the highest-demand period of the entire cycle — sometimes higher than even late pregnancy — and can require roughly 2–4x normal maintenance calories depending on litter size.');
  }

  tips.push("A calorie-dense puppy/growth-formula food is the standard recommendation, appropriately balanced for the calcium, phosphorus, and calorie density these stages require — a distinct \"pregnancy-specific\" product usually doesn't exist as its own category.");

  if (litter === 'many' && stage === 'nursing') {
    tips.push('With a large litter during peak nursing, demand is especially high — free-feeding (constant food access) is often recommended here, since scheduled meals may not keep pace with her appetite.');
  } else if (litter === 'many') {
    tips.push('A large litter (7+) will push calorie demand toward the higher end once nursing begins — worth planning food quantity ahead of time.');
  } else if (litter === 'unknown') {
    tips.push('A vet ultrasound or X-ray can give a litter size estimate that helps plan food quantity more precisely, especially heading into nursing.');
  }

  tips.push('Keep fresh water constantly available — fluid needs rise alongside calorie needs, especially during nursing.');

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + stageLabels[stage] + ' · ' + litterLabels[litter] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Stage</div><div class="pz-result-cell-val" style="font-size:13px">' + stageLabels[stage] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Litter Size</div><div class="pz-result-cell-val" style="font-size:12px">' + litterLabels[litter] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>🐕 Your Pregnancy Feeding Guidance</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Working Dog Nutrition Guide
function pzGenWorkingDogNutrition() {
  var type = document.getElementById('pz_wn_type')?.value || 'moderate';
  var intensity = document.getElementById('pz_wn_intensity')?.value || 'moderate';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', "Calculating your working dog's nutrition needs…");
  setTimeout(function() {

  var typeLabels = {endurance: 'Endurance (sledding, herding, long-distance)', power: 'Power/short-burst (protection, detection)', moderate: 'Moderate (hunting, active companion)'};
  var intensityLabels = {light: 'Light', moderate: 'Moderate', heavy: 'Heavy/Daily intensive'};

  var tips = [];
  tips.push('Working and high-performance dogs have substantially elevated caloric, protein, and fat needs compared to typical pet dogs — performance-formula foods commonly run 30%+ protein and 20%+ fat.');

  if (type === 'endurance') {
    tips.push("For endurance-type work, fat is the primary fuel source for sustained effort — sled dogs are the classic veterinary nutrition research case study for this. It's a genuinely different model from the \"carb-loading\" approach often associated with human endurance athletes.");
  } else if (type === 'power') {
    tips.push('Power/short-burst work has elevated demands too, but the fat-as-primary-fuel emphasis is less central here than for true endurance work.');
  } else {
    tips.push('Moderate work still calls for a performance-oriented diet above standard maintenance, though the demands are less extreme than true endurance or heavy power work.');
  }

  var wrapClass = 'pz-result-success';
  var heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
  var heroIcon = '🏋️';
  var heroTitle = 'Your Working Dog Nutrition Plan';

  if (intensity === 'heavy') {
    wrapClass = 'pz-result-warning'; heroColor = 'linear-gradient(135deg,#E65100,#FF9800)'; heroIcon = '⚡'; heroTitle = 'Heavy Intensity: Needs Are Dramatically Elevated';
    tips.push('At heavy, daily-intensive training, caloric needs can be dramatically elevated — some heavily-worked sled dogs eat 2–3x+ typical maintenance calories during peak season.');
    tips.push('Hydration and electrolyte considerations matter more at this level too, not just raw calorie count.');
  } else if (intensity === 'moderate') {
    tips.push("At moderate training intensity, calorie needs are meaningfully above a typical pet dog's, though not yet at the dramatic heavy-intensity level.");
  } else {
    tips.push("At light training intensity, needs are elevated above a sedentary pet dog's but don't yet require true performance-level feeding.");
  }

  tips.push('Genuinely high-performance working dogs benefit from working directly with a vet or veterinary nutritionist, since generic pet calculators meaningfully underestimate their actual needs.');

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + typeLabels[type] + ' · ' + intensityLabels[intensity] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Work Type</div><div class="pz-result-cell-val" style="font-size:12px">' + typeLabels[type] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Intensity</div><div class="pz-result-cell-val" style="font-size:13px">' + intensityLabels[intensity] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>🏋️ Your Working Dog Nutrition Guidance</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Dog Digestive Health Guide
function pzGenDigestiveHealth() {
  var issue = document.getElementById('pz_dh_issue')?.value || 'none';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', "Reviewing your dog's digestive health needs…");
  setTimeout(function() {

  var issueLabels = {occasional: 'Occasional mild upset', chronic: 'Chronic loose stool', gas: 'Gas or bloating', none: 'None — preventive interest'};

  var tips = [];
  var wrapClass, heroColor, heroIcon, heroTitle;

  if (issue === 'occasional') {
    wrapClass = 'pz-result-success'; heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)'; heroIcon = '🍚'; heroTitle = 'A Short-Term Bland Diet Usually Helps';
    tips.push('Occasional mild upset usually resolves with a short-term bland diet — plain boiled chicken and white rice is the classic, standard vet-recommended option.');
    tips.push("If it doesn't resolve within a few days, or symptoms worsen, that's a signal to see your vet rather than continuing the bland diet indefinitely.");
  } else if (issue === 'chronic') {
    wrapClass = 'pz-result-warning'; heroColor = 'linear-gradient(135deg,#E65100,#FF9800)'; heroIcon = '🩺'; heroTitle = 'This Warrants an Actual Vet Visit';
    tips.push("Chronic, ongoing loose stool warrants an actual vet visit to rule out underlying causes — parasites, food intolerance, or inflammatory bowel disease — rather than continuing to adjust diet indefinitely on your own.");
    tips.push("Chronic issues shouldn't be managed by trial-and-error diet changes alone.");
  } else if (issue === 'gas') {
    wrapClass = 'pz-result-warning'; heroColor = 'linear-gradient(135deg,#E65100,#FF9800)'; heroIcon = '💨'; heroTitle = "Often Diet-Related — Here's What to Check";
    tips.push('Gas or bloating is often diet-related — low-quality fillers, an underlying food intolerance, or eating too fast are the common causes.');
    tips.push('If eating too fast seems to be the cause, a slow-feeder bowl is a genuinely practical, specific fix worth trying.');
  } else {
    wrapClass = 'pz-result-success'; heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)'; heroIcon = '✅'; heroTitle = 'Good Preventive Practices to Keep Up';
    tips.push('A consistent feeding schedule, gradual food transitions, and quality fiber sources are the core of ongoing good digestive practice.');
  }

  tips.push('Dietary fiber — both soluble and insoluble — supports healthy digestion and stool quality generally.');
  tips.push('Probiotics and prebiotics have growing supportive evidence for gut health.');
  tips.push('Whenever you switch foods, transition gradually over 7–10 days, mixing increasing proportions of new food with the old — sudden diet changes are a common, often-overlooked cause of digestive upset.');

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">Current Issue: ' + issueLabels[issue] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Issue</div><div class="pz-result-cell-val" style="font-size:13px">' + issueLabels[issue] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Transition Rule</div><div class="pz-result-cell-val" style="font-size:13px">7–10 Days</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>🫀 Your Digestive Health Guidance</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Dog Kidney Disease Diet Guide
function pzGenKidneyDiseaseDiet() {
  var stage = document.getElementById('pz_kd_stage')?.value || 'unsure';
  var diet = document.getElementById('pz_kd_diet')?.value || 'regular';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', "Building your dog's kidney diet guidance…");
  setTimeout(function() {

  var stageLabels = {early: 'Early (IRIS Stage 1–2)', advanced: 'Advanced (IRIS Stage 3–4)', unsure: 'Not sure / recently diagnosed'};
  var dietLabels = {prescription: 'On a prescription renal diet', regular: 'Still on regular food'};

  var tips = [];
  tips.push('Two things matter most for a kidney-friendly diet: restricting phosphorus, the single most evidence-backed lever for slowing CKD progression, and moderate — not eliminated — high-quality protein.');

  var wrapClass = 'pz-result-warning';
  var heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
  var heroIcon = '🏥';
  var heroTitle = 'Talk to Your Vet About a Prescription Renal Diet';

  if (diet === 'prescription') {
    wrapClass = 'pz-result-success';
    heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
    heroIcon = '✅';
    heroTitle = "You're on the Right Track";
    tips.push('Prescription renal diets are formulated to hit precise phosphorus and protein targets — staying consistent with it is one of the most impactful things you can do.');
    tips.push("Avoid mixing in regular food, even small amounts — it can meaningfully raise phosphorus intake and work against the diet's purpose.");
  } else {
    tips.push('A prescription renal diet is genuinely the right tool here — trying to formulate a home kidney diet without professional guidance risks getting the phosphorus/protein balance wrong in either direction.');
    tips.push('Ask your vet about a prescription renal diet as soon as possible, and transition gradually over 7–10 days once you have one to avoid GI upset.');
  }

  if (stage === 'advanced') {
    tips.push('At an advanced stage, closer vet monitoring and strict diet adherence matter even more — small deviations have more impact now than they would earlier on.');
  } else if (stage === 'early') {
    tips.push('At an early stage, getting diet management right now can meaningfully help slow further progression.');
  } else {
    tips.push('If staging is unclear, ask your vet about IRIS staging at your next visit — it helps calibrate exactly how much dietary change is needed.');
  }

  tips.push('Keep fresh water always available — CKD dogs often drink and urinate more, and consistent hydration is a real part of management, not an afterthought.');
  tips.push('Bring this result to your next vet visit as a starting point for the conversation.');

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + stageLabels[stage] + ' · ' + dietLabels[diet] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">CKD Stage</div><div class="pz-result-cell-val" style="font-size:12px">' + stageLabels[stage] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Current Diet</div><div class="pz-result-cell-val" style="font-size:12px">' + dietLabels[diet] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Key Focus</div><div class="pz-result-cell-val" style="font-size:12px">Phosphorus &amp; Protein</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>🏥 Your Kidney Diet Guidance</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Best Joint Supplements for Dogs Guide
function pzGenJointSupplement() {
  var purpose = document.getElementById('pz_js_purpose')?.value || 'senior';
  var weight = document.getElementById('pz_js_weight')?.value || 'ideal';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', "Matching joint supplement guidance to your dog…");
  setTimeout(function() {

  var purposeLabels = {prevention: 'Prevention (young large/giant breed)', arthritis: 'Managing diagnosed arthritis', senior: 'General senior joint support'};
  var weightLabels = {ideal: 'At ideal weight', overweight: 'Overweight'};

  var tips = [];
  tips.push('Glucosamine/chondroitin has the most research behind it among joint supplements, though the effect is typically modest, not dramatic.');
  tips.push('Omega-3 fatty acids have good evidence for reducing joint-relevant inflammation, alongside skin and coat benefits.');

  var wrapClass = 'pz-result-success';
  var heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
  var heroIcon = '💊';
  var heroTitle = 'Your Joint Supplement Game Plan';

  if (purpose === 'arthritis') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '🏥';
    heroTitle = 'Supplements + Vet Treatment, Not Supplements Alone';
    tips.push('For diagnosed arthritis, supplements are complementary to vet-prescribed pain management, not a replacement for it — use both together.');
  } else if (purpose === 'prevention') {
    tips.push('For a young large or giant breed, avoiding excessive high-impact exercise — repeated jumping, hard surfaces — during the growth period matters at least as much as any supplement.');
  } else {
    tips.push('For general senior support, consistent use over time matters more than any single product choice.');
  }

  if (weight === 'overweight') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '⚖️';
    heroTitle = 'Weight Loss Is Your Highest-Impact Step';
    tips.push('Excess weight adds direct, mechanical joint stress — for an overweight dog, reaching an ideal weight typically has more impact on joint comfort than any supplement. See our Dog Weight Loss Plan calculator for a structured approach.');
  } else {
    tips.push('At an ideal weight, you\'re already ahead on the biggest joint-health lever there is — supplements can add genuine additional support from here.');
  }

  tips.push('Look for the NASC (National Animal Supplement Council) quality seal when choosing a brand — pet supplements aren\'t FDA-regulated for purity the way drugs are, so this is a real, meaningful quality signal.');
  tips.push('Check with your vet before starting, especially if your dog takes other medications.');

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + purposeLabels[purpose] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Purpose</div><div class="pz-result-cell-val" style="font-size:12px">' + purposeLabels[purpose] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Weight Status</div><div class="pz-result-cell-val" style="font-size:13px">' + weightLabels[weight] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Top Evidence</div><div class="pz-result-cell-val" style="font-size:12px">Glucosamine + Omega-3</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>💊 Your Joint Supplement Guidance</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Puppy to Adult Food Transition Guide
function pzGenPuppyAdultTransition() {
  var age = parseFloat(document.getElementById('pz_pat_age')?.value) || 0;
  var size = document.getElementById('pz_pat_size')?.value || 'medium';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', "Calculating your puppy's transition window…");
  setTimeout(function() {

  var sizeLabels = {small: 'Small (under 25 lbs)', medium: 'Medium (25–60 lbs)', large: 'Large (60–100 lbs)', giant: 'Giant (100+ lbs)'};
  var windows = {small: [9, 12], medium: [11, 13], large: [12, 18], giant: [18, 24]};
  var w = windows[size];

  var status, wrapClass, heroColor, heroIcon, heroTitle;
  if (age <= 0) {
    status = "Enter your puppy's current age above to get a specific estimate.";
    wrapClass = 'pz-result-success';
    heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
    heroIcon = '🔄';
    heroTitle = 'Enter Your Puppy\'s Age';
  } else if (age < w[0]) {
    var monthsLeft = Math.round(w[0] - age);
    status = 'Not yet — based on typical timing for a ' + sizeLabels[size].toLowerCase() + ' dog, you have roughly ' + monthsLeft + ' more month' + (monthsLeft === 1 ? '' : 's') + ' of puppy food ahead before the usual transition window opens.';
    wrapClass = 'pz-result-success';
    heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
    heroIcon = '🐶';
    heroTitle = 'Still in the Puppy Food Stage';
  } else if (age <= w[1]) {
    status = "You're in the typical transition window right now for a " + sizeLabels[size].toLowerCase() + ' dog — a good time to start a gradual switch if your puppy\'s growth is on track.';
    wrapClass = 'pz-result-success';
    heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
    heroIcon = '✅';
    heroTitle = 'In the Typical Transition Window';
  } else {
    status = "You're past the typical window for a " + sizeLabels[size].toLowerCase() + ' dog. If growth has clearly plateaued, it\'s fine to switch now (or already have) — if you haven\'t yet, check with your vet to confirm growth is actually complete.';
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '📈';
    heroTitle = 'Past the Typical Window — Check Growth Status';
  }

  var tips = [];
  tips.push(status);
  tips.push('Small breeds transition earliest (around 9–12 months); giant breeds latest (18–24 months), since their growth plates close much later.');
  tips.push('A visible growth plateau — weight and height stabilizing — is just as valid a signal as hitting the typical age window.');
  tips.push('Whenever you make the switch, do it gradually over 7–10 days, mixing in increasing proportions of adult food to avoid GI upset.');
  tips.push('Ask your vet to confirm growth completion at your next routine visit if you\'re unsure.');

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + (age > 0 ? age + ' months old · ' : '') + sizeLabels[size] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Current Age</div><div class="pz-result-cell-val">' + (age > 0 ? age + ' mo' : '—') + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Adult Size</div><div class="pz-result-cell-val" style="font-size:12px">' + sizeLabels[size] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Typical Window</div><div class="pz-result-cell-val" style="font-size:13px">' + w[0] + '–' + w[1] + ' mo</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>🔄 Your Transition Guidance</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Dog Separation Anxiety Training Guide
function pzGenSepAnxiety() {
  var severity = document.getElementById('pz_tf_severity')?.value || 'mild';
  var stage = document.getElementById('pz_tf_stage')?.value || 'new';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Building your desensitization plan…');
  setTimeout(function() {

  var severityLabels = {mild: 'Mild — some whining/pacing', moderate: 'Moderate — destruction or accidents when alone', severe: "Severe — self-injury, non-stop panic, can't leave at all"};
  var stageLabels = {new: 'Just noticed the problem', tried: 'Already tried some training'};

  var tips = [];
  var wrapClass = 'pz-result-success';
  var heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
  var heroIcon = '🐾';
  var heroTitle = 'Your Graduated Desensitization Plan';

  if (severity === 'severe') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#B71C1C,#E65100)';
    heroIcon = '🚨';
    heroTitle = 'Get a Veterinary Behaviorist or Certified Trainer Involved';
    tips.push('Self-injury, non-stop panic, or being unable to leave at all are signs that DIY training alone is unlikely to be enough right now.');
    tips.push('A veterinary behaviorist or certified separation-anxiety trainer can build a structured plan and evaluate whether anti-anxiety medication alongside training makes sense — this is a legitimate, common approach for severe cases, not a last resort.');
    tips.push('You can still start fake-departure practice while you arrange professional support, but avoid real absences that push your dog into full panic in the meantime.');
  } else if (severity === 'moderate') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '⚠️';
    heroTitle = 'Structured Plan, With Extra Support Worth Considering';
    tips.push('Practice "fake departures" — picking up your keys or putting on your shoes without actually leaving — repeated until those cues stop predicting you\'ll disappear.');
    tips.push('Start real absences at just a few seconds, increasing duration only once your dog stays calm at the current length.');
    tips.push('Never punish the destruction or accidents — your dog is panicking, not misbehaving, and punishment makes the anxiety worse.');
    tips.push('If you don\'t see steady improvement within a few weeks of consistent practice, a certified separation-anxiety trainer or veterinary behaviorist is worth bringing in.');
  } else {
    tips.push('Practice "fake departures" — picking up your keys or putting on your shoes without actually leaving — repeated until those cues stop predicting you\'ll disappear.');
    tips.push('Start real absences at just a few seconds, increasing duration gradually only once your dog stays calm at the current length.');
    tips.push('Tire your dog out with exercise and mental stimulation before you leave — a tired dog copes better with alone time.');
    tips.push('Keep departures and returns low-key, not dramatic, to avoid amplifying the emotional contrast.');
  }

  if (stage === 'new') {
    tips.push("Since you're just starting, begin with the fake-departure step before attempting any real absences — skipping it undermines the rest of the plan.");
  } else {
    tips.push('Since you\'ve already tried some training, double-check you haven\'t increased absence duration faster than your dog could handle — rushing duration is the most common reason DIY training stalls.');
  }

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + severityLabels[severity] + ' · ' + stageLabels[stage] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Severity</div><div class="pz-result-cell-val" style="font-size:12px">' + severityLabels[severity] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Stage</div><div class="pz-result-cell-val" style="font-size:13px">' + stageLabels[stage] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>😟 Your Training Plan</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── How to Stop Dog Barking Guide
function pzGenBarkTraining() {
  var trigger = document.getElementById('pz_tf_trigger')?.value || 'door';
  var frequency = document.getElementById('pz_tf_frequency')?.value || 'few';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', "Matching a method to your dog's barking…");
  setTimeout(function() {

  var triggerLabels = {door: 'At the door/window (people or dogs passing)', attention: 'Wants attention or food from me', bored: 'Seems bored or under-exercised', reactive: 'Barks at other dogs/people, seems scared or reactive'};
  var frequencyLabels = {few: 'A few times a day', constant: 'Constant / most of the day'};

  var tips = [];
  var wrapClass = 'pz-result-success';
  var heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
  var heroIcon = '🔇';
  var heroTitle = 'Your Bark Training Method';

  if (trigger === 'door') {
    heroTitle = 'Manage the Trigger, Then Teach Quiet';
    tips.push('Block the view of common triggers — frosted window film, closing blinds, or moving furniture — or use white noise to reduce how often the trigger occurs.');
    tips.push('Teach a "quiet" cue by rewarding silence after a few acknowledgment barks, rather than expecting instant silence.');
  } else if (trigger === 'attention') {
    heroTitle = 'Stop Rewarding the Barking, Reward the Quiet';
    tips.push('Consistently withhold attention — even negative attention like saying "no" — for demand barking, and reward calm, quiet moments instead.');
    tips.push('Expect the barking to get briefly worse before it improves — this is a normal "extinction burst," not a sign the plan is failing. Staying consistent through it is what makes the fix stick.');
  } else if (trigger === 'bored') {
    heroTitle = 'Add Exercise and Mental Stimulation';
    tips.push('Repetitive barking from under-stimulation responds to more physical and mental exercise, not more correction.');
    tips.push('Puzzle feeders, sniff walks, and structured play sessions give your dog an outlet that reduces the boredom driving the barking.');
  } else {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '⚠️';
    heroTitle = 'Go Gradual — Punishment Can Backfire Here';
    tips.push('Fear or reactive barking needs distance-based counter-conditioning — reward calm behavior at a distance your dog can handle, then slowly decrease that distance over time.');
    tips.push('Avoid correcting the reaction directly — punishment can strengthen the association between the trigger and fear, making the reaction worse rather than better.');
    tips.push('For a strong or frequent reaction, a trainer experienced in reactivity is worth involving rather than working through this alone.');
  }

  if (frequency === 'constant') {
    tips.push('Since this is happening most of the day, managing the environment (blocking triggers, more structured exercise) while you train will reduce practice opportunities for the unwanted behavior and make faster progress possible.');
  } else {
    tips.push('At a few times a day, consistent short training reps around each occurrence should show progress within a couple of weeks.');
  }

  tips.push('Bark collars (shock, spray, or ultrasonic) are generally discouraged as a first approach — they suppress the symptom without addressing the actual cause, and can increase anxiety-linked barking.');
  tips.push('Get everyone in the household responding the same way — inconsistent reactions to barking make it harder to change for everyone.');

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + triggerLabels[trigger] + ' · ' + frequencyLabels[frequency] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Trigger</div><div class="pz-result-cell-val" style="font-size:12px">' + triggerLabels[trigger] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Frequency</div><div class="pz-result-cell-val" style="font-size:13px">' + frequencyLabels[frequency] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>🔇 Your Bark Training Method</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Dog Bite Prevention Training Guide
function pzGenBitePrevention() {
  var agegroup = document.getElementById('pz_tf_agegroup')?.value || 'puppy';
  var context = document.getElementById('pz_tf_context')?.value || 'general';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Matching guidance to your situation…');
  setTimeout(function() {

  var agegroupLabels = {puppy: 'Puppy under 6 months (normal mouthing)', adolescent: 'Adolescent/adult dog, mild nipping', bitten: 'Adult dog, has actually bitten or growled seriously'};
  var contextLabels = {general: 'General handling/play', children: 'Around children', guarding: 'Resource guarding (food/toys/space)'};

  var tips = [];
  var needsWarning = (agegroup === 'bitten') || (context === 'children' && agegroup !== 'puppy');
  var wrapClass = needsWarning ? 'pz-result-warning' : 'pz-result-success';
  var heroColor = needsWarning ? 'linear-gradient(135deg,#B71C1C,#E65100)' : 'linear-gradient(135deg,#1B5E20,#2E7D32)';
  var heroIcon = needsWarning ? '🚨' : '🛡️';
  var heroTitle = needsWarning ? 'Get Professional Evaluation, Not Just Home Training' : 'Your Bite Prevention Guidance';

  if (agegroup === 'puppy') {
    tips.push('Puppy mouthing is normal development — puppies explore with their mouths and haven\'t learned bite inhibition yet, this isn\'t aggression.');
    tips.push('The instant teeth touch skin, yelp and briefly withdraw attention, then immediately redirect to an appropriate chew toy — this mimics how littermates teach bite inhibition.');
    tips.push('Never physically punish mouthing (no hitting or tapping the nose) — it doesn\'t teach bite inhibition and can increase fear-based biting later.');
    tips.push('Most puppies improve significantly by around 6 months with consistent redirection and yelping.');
    if (context === 'children') {
      tips.push('Even with normal puppy mouthing, actively supervise interactions with children and teach kids not to approach the puppy while it eats, sleeps, or guards something — good habits started early prevent problems later.');
    }
  } else if (agegroup === 'bitten') {
    tips.push('A dog that has actually bitten or growled seriously needs evaluation from a certified professional (CPDT-KA) or veterinary behaviorist — this is genuinely not a DIY-only situation.');
    tips.push('If this is out-of-character for a previously reliable adult dog, a vet check to rule out pain or a medical cause is a sensible first step before behavioral work.');
    tips.push('Never punish growling — it\'s a warning, and punishing it removes that warning signal while the underlying discomfort remains, making a bite without warning more likely.');
    if (context === 'children') {
      tips.push('Because this involves a child, treat it as an immediate safety priority — arrange professional evaluation right away and keep the dog and child separated with active supervision in the meantime.');
    }
  } else {
    tips.push('Mild nipping in an adolescent or adult dog often responds to the same redirection principles as puppy mouthing, but pay closer attention to warning signals — stiffening, whale eye, lip licking, turning away, growling — since these matter more in an older dog.');
    tips.push('Never punish growling — address what\'s causing the discomfort instead, since punishing the growl removes your early warning system.');
    if (context === 'children') {
      tips.push('Because this involves children, supervise every interaction actively regardless of bite history, and teach kids not to approach the dog while it eats, sleeps, or guards something. If nipping continues or escalates around kids, get a certified trainer involved promptly.');
    }
  }

  if (context === 'guarding') {
    tips.push('For resource guarding specifically, use a structured trade-up approach — offering something better in exchange rather than taking items away — ideally guided by a certified trainer, since mismanaged resource guarding can escalate.');
  }

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + agegroupLabels[agegroup] + ' · ' + contextLabels[context] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Age/Situation</div><div class="pz-result-cell-val" style="font-size:12px">' + agegroupLabels[agegroup] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Context</div><div class="pz-result-cell-val" style="font-size:12px">' + contextLabels[context] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>🛡️ Your Bite Prevention Guidance</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── 10 Basic Dog Commands Guide
function pzGenBasicCommands() {
  var experience = document.getElementById('pz_tf_experience')?.value || 'none';
  var priority = document.getElementById('pz_tf_priority')?.value || 'allround';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Building your suggested command order…');
  setTimeout(function() {

  var experienceLabels = {none: 'Never trained before (start from scratch)', some: 'Knows a few basics, want to add more', distraction: 'Knows basics, want reliability around distractions'};
  var priorityLabels = {safety: 'Safety commands first (come, leave it, wait)', manners: 'Everyday manners (sit, down, off)', allround: 'All-around foundation'};

  var tips = [];

  if (experience === 'none') {
    tips.push('Start with attention/name recognition, then Sit (lure with a treat up and back over the head, marking the instant the rear touches the ground).');
    tips.push('Keep sessions to 5-10 minutes, a few times a day, and always end on a success.');
  } else if (experience === 'some') {
    tips.push('Build on what your dog already knows by adding Stay (duration first, then distance — not both at once) and Down using the same lure-and-mark method.');
    tips.push('Mark the exact right moment with a clicker or a consistent word like "yes," then reward — timing matters more than most owners expect.');
  } else {
    tips.push('Since the basics are solid, focus on proofing them against distraction: practice in the yard, then a quiet outdoor spot, then busier environments, raising treat value as distraction increases.');
    tips.push('A command that\'s reliable at home hasn\'t automatically generalized outside — that reliability needs its own deliberate practice.');
  }

  if (priority === 'safety') {
    tips.push('Prioritize Come, Leave It, and Wait — these carry real safety value. Practice recall in low-distraction settings first, use a long line outdoors before trusting it off-leash, and never call your dog to something unpleasant like a bath, which poisons the cue.');
  } else if (priority === 'manners') {
    tips.push('Focus on Sit, Down, and Off for everyday manners — these make daily life smoother and are typically quicker to teach than the safety-critical commands.');
  } else {
    tips.push('Aim for a balanced rotation across sessions — a safety command, a manners command, and reinforcement of something already known — so no single skill lags behind the others.');
  }

  tips.push('Say each cue once, then help your dog succeed rather than repeating the word — repeating teaches your dog the first instance doesn\'t count.');
  tips.push('Match treat value to difficulty: save high-value treats for harder commands or distracting environments, everyday treats for easy home practice.');

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:linear-gradient(135deg,#1B5E20,#2E7D32);color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">✋ Your Suggested Training Order</div>'
    + '<div style="font-size:15px;opacity:.9">' + experienceLabels[experience] + ' · ' + priorityLabels[priority] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Experience</div><div class="pz-result-cell-val" style="font-size:12px">' + experienceLabels[experience] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Priority</div><div class="pz-result-cell-val" style="font-size:12px">' + priorityLabels[priority] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>✋ Your Command Training Plan</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Clicker Training for Dogs Guide
function pzGenClickerTraining() {
  var experience = document.getElementById('pz_tf_experience')?.value || 'new';
  var dogtype = document.getElementById('pz_tf_dogtype')?.value || 'adult_new';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Building your clicker training next steps…');
  setTimeout(function() {

  var experienceLabels = {new: 'Brand new to clicker training', charged: 'Have charged the clicker, ready to teach behaviors', tricks: 'Want to use it for tricks/advanced training'};
  var dogtypeLabels = {puppy: 'Puppy', adult_new: 'Adult dog, new to clicker', adult_knows: 'Adult dog, already knows basic commands'};

  var tips = [];
  var heroTitle = 'Your Clicker Training Next Steps';

  if (experience === 'new') {
    heroTitle = 'Start by Charging the Clicker';
    tips.push('Click once, immediately give a treat, and repeat 10-15 times in a session — no behavior expected yet, just building the click-equals-reward association.');
    tips.push('Keep charging sessions short and always treat after every click — skipping the treat even occasionally weakens the association you\'re building.');
    tips.push('Once your dog perks up or looks for a treat right after hearing the click, the clicker is charged and you\'re ready to mark an actual behavior.');
  } else if (experience === 'charged') {
    heroTitle = 'Start Marking and Shaping a Behavior';
    tips.push('Choose a simple first behavior — Sit or a hand touch are easy starting points.');
    tips.push('Click the exact instant the behavior happens, not a beat before or after — timing precision is the whole point of the method — then treat.');
    tips.push('Once your dog reliably offers the behavior, add a verbal cue by saying it just before the behavior starts, so the word attaches to a dependable action.');
  } else {
    heroTitle = 'Shaping Tricks and Advanced Behaviors';
    tips.push('The same precise timing that teaches Sit makes clicker training well-suited to shaping complex behaviors in small increments — break tricks or agility foundations into small steps and click each successive approximation.');
    tips.push('Keep clicking for genuinely new or refining criteria, but avoid clicking every rep of something already fluent — save the precision for what\'s still being taught.');
    tips.push('Chain simple shaped behaviors together gradually once each piece is solid on its own.');
  }

  if (dogtype === 'puppy') {
    tips.push('For a puppy, keep charging and shaping sessions especially short — a few minutes at a time — since attention spans are shorter at this age.');
  } else if (dogtype === 'adult_new') {
    tips.push('An adult dog new to the clicker charges just as easily as a puppy — the mechanics don\'t change with age, only your dog\'s existing habits might need a little patience to work around.');
  } else {
    tips.push('Since your dog already knows basic commands, you can use the clicker to sharpen precision on existing behaviors or introduce it fresh for new tricks — either way, expect faster progress since your dog already understands rewarded training.');
  }

  tips.push('Avoid clicking without treating — it breaks the click-equals-reward association and can "poison" the marker, making it less effective going forward.');

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="pz-result-success" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:linear-gradient(135deg,#1B5E20,#2E7D32);color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">🎯 ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + experienceLabels[experience] + ' · ' + dogtypeLabels[dogtype] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Experience</div><div class="pz-result-cell-val" style="font-size:12px">' + experienceLabels[experience] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Dog Type</div><div class="pz-result-cell-val" style="font-size:12px">' + dogtypeLabels[dogtype] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>🎯 Your Clicker Training Steps</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Puppy Training Schedule Guide
function pzGenPuppySchedule() {
  var age = document.getElementById('pz_tf_age')?.value || '3_4mo';
  var focus = document.getElementById('pz_tf_focus')?.value || 'allaround';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Building your puppy\'s age-matched training checklist…');
  setTimeout(function() {

  var ageLabels = {
    '8_10wk': '8–10 weeks',
    '10_12wk': '10–12 weeks',
    '3_4mo': '3–4 months (12–16 weeks)',
    '4_6mo': '4–6 months',
    '6_12mo': '6–12 months',
    '12_24mo': '12–24 months'
  };
  var focusLabels = {
    potty: 'Potty training',
    commands: 'Basic commands',
    socialization: 'Socialization',
    allaround: 'All-around training'
  };

  var tips = [];
  var wrapClass = 'pz-result-success';
  var heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
  var heroIcon = '📋';
  var heroTitle = 'Your Age-Matched Training Checklist';

  if (age === '8_10wk') {
    tips.push('Start with name recognition and gentle handling exposure — short, positive sessions build trust before anything else.');
    tips.push('Begin a potty schedule now: out every 1–2 hours plus immediately after waking, eating, and play.');
    tips.push('Introduce the crate gradually with short, positive sessions — this is the age to build a good association, not force long stays.');
    tips.push('Hold off on public leash walks until your vet clears your puppy on vaccines, and avoid areas with unvaccinated or unknown-status dogs until then.');
  } else if (age === '10_12wk') {
    tips.push('Layer in sit and come basics using a food lure, in short sessions throughout the day.');
    tips.push('Keep the potty schedule consistent — this is still the stage where consistency matters more than speed.');
    tips.push('Begin controlled socialization: calm, healthy, vaccinated dogs you know, varied people, and household sounds like the vacuum or doorbell.');
  } else if (age === '3_4mo') {
    tips.push('This is peak critical socialization window — it narrows sharply and effectively closes around 14 weeks, so prioritize varied positive exposures now over anything else on this list.');
    tips.push('Start leash introduction indoors, and layer in sit, down, come, and name response in 5-minute sessions spread across the day.');
    tips.push('Teething often begins here — keep appropriate chew items on hand and redirect rather than punish.');
  } else if (age === '4_6mo') {
    tips.push('Adolescence is beginning — your puppy may seem to "forget" training temporarily. This is normal; stay consistent rather than starting over.');
    tips.push('Move loose-leash walking practice outdoors, and extend training sessions gradually as focus improves.');
    tips.push('Once fully vaccinated per your vet, public leash walks can begin — pair them with impulse-control games.');
  } else if (age === '6_12mo') {
    tips.push('This is peak adolescence — expect distractibility spikes, especially between 6–9 months, and boundary-testing even on commands that were solid before.');
    tips.push('Reinforce every basic command specifically around distractions, not just at home — this is where reliability actually gets built.');
    tips.push('A group class is worth considering here if you want structured practice around other dogs and people.');
  } else {
    tips.push('Most behaviors should be reliable by now with consistent training — this stage is about refinement, not starting new fundamentals.');
    tips.push('Small breeds are often fully mature around 12 months; large and giant breeds can take until 18–24 months for full behavioral maturity — adjust expectations to your dog\'s size.');
    tips.push('Advanced commands and off-leash reliability are optional next steps once the basics are solid.');
  }

  if (focus === 'potty') {
    tips.unshift('Potty training priority: keep the schedule tight (every 1–2 hours for young puppies) and reward within seconds of eliminating outside — timing is what makes it stick.');
  } else if (focus === 'commands') {
    tips.unshift('Basic commands priority: keep sessions short (5 minutes, several times a day) and always end on a success, even a small one.');
  } else if (focus === 'socialization') {
    tips.unshift('Socialization priority: aim for quality over quantity — calm, positive exposures your puppy chooses to approach beat overwhelming them with too much at once.');
  }

  var underFourMonths = (age === '8_10wk' || age === '10_12wk' || age === '3_4mo');
  if (underFourMonths) {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '⏳';
    heroTitle = 'Time-Sensitive: Socialization Window Closing';
    tips.push('Reminder: the critical socialization window is roughly 3–14 weeks and narrows sharply after 12 weeks — exposures now have an outsized, lasting effect on adult temperament that gets harder to replicate later.');
  }

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + ageLabels[age] + ' · Focus: ' + focusLabels[focus] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Age Stage</div><div class="pz-result-cell-val" style="font-size:12px">' + ageLabels[age] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Focus</div><div class="pz-result-cell-val" style="font-size:12px">' + focusLabels[focus] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📋 Your Priorities Right Now</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Dog Potty Training Guide
function pzGenPottyTraining() {
  var age = document.getElementById('pz_tf_age')?.value || 'puppy_8_16wk';
  var stage = document.getElementById('pz_tf_stage')?.value || 'starting';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Building your dog\'s potty training plan…');
  setTimeout(function() {

  var ageLabels = {
    puppy_8_16wk: '8–16 week puppy',
    puppy_4_6mo: '4–6 month puppy',
    adult_new: 'Adult dog (new to household)',
    adult_regressing: 'Previously trained adult, now regressing'
  };
  var stageLabels = {
    starting: 'Just starting',
    occasional: 'Occasional accidents',
    refining: 'Mostly reliable, refining'
  };

  var tips = [];
  var wrapClass = 'pz-result-success';
  var heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
  var heroIcon = '🚽';
  var heroTitle = 'Your Potty Training Plan';
  var timeline = '';

  if (age === 'adult_regressing') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '🩺';
    heroTitle = 'Rule Out a Medical Cause First';
    timeline = 'Check with your vet before retraining';
    tips.push('Sudden accidents in a previously reliable adult dog are often medical, not behavioral — a UTI is a common, easily missed cause. A vet check is the right first step, especially if the regression came on suddenly.');
    tips.push('If your vet rules out a medical cause, look at recent changes: a new schedule, a move, a new pet or person in the household, or stress can all trigger temporary regression.');
    tips.push('Once medical causes are ruled out, go back to basics briefly: tighten the schedule and reward timing for a couple of weeks rather than assuming your dog needs to relearn everything from scratch.');
  } else {
    if (age === 'puppy_8_16wk') {
      timeline = 'Typical full house-training: 4–6 months, with young puppies needing the tightest schedule right now';
      tips.push('Take your puppy out every 1–2 hours, plus immediately after waking, eating, and play — this age needs the tightest schedule on the whole timeline.');
      tips.push('Use crate or confinement between outings — sized so your puppy can stand, turn, and lie down, but not so large they can use one end as a bathroom.');
    } else if (age === 'puppy_4_6mo') {
      timeline = 'Typical full house-training: 4–6 months — bladder control is improving, so intervals can start stretching';
      tips.push('Bladder control is improving now — you can start stretching intervals between outings, but keep the after-waking/eating/play triggers non-negotiable.');
      tips.push('This is a good stage to start recognizing your dog\'s specific signals (circling, sniffing, heading to the door) rather than relying purely on the clock.');
    } else {
      timeline = 'Adult dogs new to a household often adjust within a few weeks with a consistent schedule, faster than a puppy learning from scratch';
      tips.push('An adult dog new to your household may already understand the general concept — focus on teaching your specific schedule and cues rather than starting from zero.');
      tips.push('Use confinement or close supervision for the first couple of weeks while you learn each other\'s signals.');
    }

    if (stage === 'starting') {
      tips.push('Reward within seconds of elimination outside, every single time right now — consistent immediate reward is what builds the habit fastest at this stage.');
    } else if (stage === 'occasional') {
      tips.push('Occasional accidents at this stage usually mean the schedule needs tightening slightly, not that training has failed — look for a pattern (time of day, after specific activities) and adjust the schedule around it.');
    } else {
      tips.push('At the refining stage, start stretching intervals gradually and reducing reliance on the schedule clock in favor of watching for your dog\'s own signals.');
    }

    tips.push('Never punish an accident you find after the fact — clean it with an enzymatic cleaner (not ammonia-based) and just tighten the schedule going forward.');
  }

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + ageLabels[age] + ' · ' + stageLabels[stage] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Estimated Timeline</div><div class="pz-result-cell-val" style="font-size:12px">' + timeline + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Current Stage</div><div class="pz-result-cell-val" style="font-size:12px">' + stageLabels[stage] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>🚽 Your Top Priorities</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Dog Crate Training Guide
function pzGenCrateTraining() {
  var reaction = document.getElementById('pz_tf_reaction')?.value || 'never_used';
  var agegroup = document.getElementById('pz_tf_agegroup')?.value || 'puppy';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Matching crate guidance to your dog\'s reaction…');
  setTimeout(function() {

  var reactionLabels = {
    never_used: 'Never used a crate before',
    resists: 'Resists entering / avoids it',
    whines_barks: 'Whines or barks when placed in it',
    calm_longer: 'Enters calmly, needs longer duration'
  };
  var agegroupLabels = { puppy: 'Puppy', adult: 'Adult dog' };

  var tips = [];
  var wrapClass = 'pz-result-success';
  var heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
  var heroIcon = '🏠';
  var heroTitle = 'Your Crate Training Plan';

  if (reaction === 'never_used') {
    tips.push('Start with the door open — toss treats or feed meals inside so your dog enters on their own, with zero pressure to stay.');
    tips.push('Only close the door for short periods once your dog is calm and comfortable entering voluntarily, and build duration gradually from there.');
    tips.push('Remember the one rule that matters most: the crate is never punishment — a single use as a consequence can undo this whole process.');
  } else if (reaction === 'resists') {
    tips.push('Go back a step: leave the door open with no expectation of entering, and let treats and meals do the work of building a positive association before trying to close the door again.');
    tips.push('Resistance often means the process moved faster than your dog was ready for, or the crate got linked to something negative at some point — patience now saves time later.');
    tips.push('Never physically force your dog into the crate — this reinforces exactly the resistance you\'re trying to overcome.');
  } else if (reaction === 'whines_barks') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '🩺';
    heroTitle = 'Check Which Kind of Whining This Is';
    tips.push('Ordinary adjustment whining in the early days is normal — the key is never releasing your dog while they\'re actively whining or barking, since that reinforces the behavior. Wait for a pause, even a brief one, before opening the door.');
    tips.push('But if what you\'re seeing includes drooling, your dog injuring themselves trying to escape, or non-stop distress well beyond the first few nights, that\'s genuine crate anxiety, not normal adjustment — it needs a slower, different approach (or a professional trainer), not "crying it out."');
    tips.push('If you\'re unsure which one this is, err toward the slower approach: shorter closed-door periods, more positive association time with the door open, and reassess in a few days.');
  } else {
    tips.push('Since your dog already enters calmly, extend duration in small increments rather than jumping straight to a long stretch — this keeps the positive association intact.');
    tips.push('Continue confirming the crate is still sized correctly as your dog grows or if their weight has changed — comfortable sizing supports longer comfortable stays.');
  }

  if (agegroup === 'puppy') {
    tips.push('As a rule of thumb, puppies shouldn\'t be crated much longer than their age in months plus one hour during the day — check that your current routine fits within that.');
  } else {
    tips.push('Adult dogs generally shouldn\'t be crated more than 6–8 hours — if your routine regularly exceeds that, look at a midday break or a dog walker.');
  }

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + reactionLabels[reaction] + ' · ' + agegroupLabels[agegroup] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Current Reaction</div><div class="pz-result-cell-val" style="font-size:12px">' + reactionLabels[reaction] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Age Group</div><div class="pz-result-cell-val" style="font-size:12px">' + agegroupLabels[agegroup] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>🏠 Your Next Steps</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Dog Leash Training Guide
function pzGenLeashTraining() {
  var severity = document.getElementById('pz_tf_severity')?.value || 'mild';
  var size = document.getElementById('pz_tf_size')?.value || 'medium';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Matching a leash training plan to your dog…');
  setTimeout(function() {

  var severityLabels = {
    mild: 'Mild — occasional pulling',
    moderate: 'Moderate — pulls regularly',
    severe: 'Severe — hard to control, lunges/drags'
  };
  var sizeLabels = {
    small: 'Small dog (under 25 lbs)',
    medium: 'Medium dog (25–60 lbs)',
    large: 'Large/strong dog (60+ lbs)'
  };

  var tips = [];
  var wrapClass = 'pz-result-success';
  var heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
  var heroIcon = '🐕';
  var heroTitle = 'Your Leash Training Plan';
  var timeline = '';

  tips.push('Use the "stop and go" method: the instant the leash goes tight, stop walking completely and wait for slack before continuing.');
  tips.push('Skip the retractable leash during training — it rewards pulling with more leash, the opposite of the lesson you want.');

  if (severity === 'mild') {
    timeline = 'Often improves in 1–2 weeks of daily practice';
    tips.push('Mild, occasional pulling usually responds quickly to consistent stop-and-go practice — daily short sessions should show progress within a couple of weeks.');
  } else if (severity === 'moderate') {
    timeline = 'Typically several weeks of consistent daily practice';
    tips.push('Regular pulling benefits from starting practice in a low-distraction space (house or yard) before testing it on busy streets, to build the habit before it\'s challenged.');
  } else {
    timeline = 'Longer timeline — often benefits from professional guidance alongside daily practice';
    tips.push('Severe pulling that\'s hard to control is worth pairing with professional trainer guidance alongside daily practice, both for faster progress and for safety on walks.');
  }

  var equipmentNote = '';
  if (size === 'large' || severity === 'severe') {
    equipmentNote = 'A front-clip harness is strongly recommended here — it redirects a strong puller\'s forward motion and gives you meaningfully more control than a flat collar or back-clip harness alone.';
  } else if (size === 'medium') {
    equipmentNote = 'A front-clip harness is a solid choice for extra control, though a well-fitted back-clip harness can also work for lighter pulling.';
  } else {
    equipmentNote = 'A standard harness generally works well for a small dog, though a front-clip style can still help if pulling is more than occasional.';
  }
  tips.push(equipmentNote);

  var severeAndLarge = (severity === 'severe' && size === 'large');
  if (severeAndLarge) {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '⚠️';
    heroTitle = 'Prioritize a Front-Clip Harness and Professional Help';
    tips.push('This combination — a large, strong dog that\'s hard to control on leash — is worth treating as a safety priority, not just a training inconvenience. A front-clip harness plus a session or two with a professional trainer can make walks safe again much faster than DIY practice alone.');
  }

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + severityLabels[severity] + ' · ' + sizeLabels[size] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Estimated Timeline</div><div class="pz-result-cell-val" style="font-size:12px">' + timeline + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Dog Size</div><div class="pz-result-cell-val" style="font-size:12px">' + sizeLabels[size] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>🐕 Your Method &amp; Equipment</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Dog Socialization Guide
function pzGenSocialization() {
  var agegroup = document.getElementById('pz_tf_agegroup')?.value || 'puppy_under14';
  var level = document.getElementById('pz_tf_level')?.value || 'not_started';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Building your dog\'s socialization plan…');
  setTimeout(function() {

  var agegroupLabels = {
    puppy_under14: 'Puppy under 14 weeks',
    puppy_14wk_6mo: 'Puppy 14 weeks – 6 months',
    adult_well: 'Adult dog, well-adjusted',
    adult_fearful: 'Adult dog, fearful/reactive/under-socialized'
  };
  var levelLabels = {
    not_started: 'Not started yet',
    some: 'Some exposure so far',
    well_socialized: 'Well socialized, want to maintain/expand'
  };

  var tips = [];
  var wrapClass = 'pz-result-success';
  var heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
  var heroIcon = '🤝';
  var heroTitle = 'Your Socialization Plan';

  if (agegroup === 'puppy_under14') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '⏳';
    heroTitle = 'Time-Sensitive: Window Closing Around 14 Weeks';
    tips.push('The critical socialization window is roughly 3–14 weeks and narrows sharply after 12 weeks — exposures right now have an outsized, lasting effect on adult temperament that gets harder to replicate later.');
    tips.push('Full vaccine series often aren\'t complete until around 16 weeks, after the window narrows — ask your vet specifically about controlled, lower-risk socialization now (vet-approved puppy classes, healthy vaccinated adult dogs, carrying your puppy in public to see and hear the world) rather than waiting until fully vaccinated.');
    tips.push('This is a time-sensitive opportunity, not a medical danger — the urgency is about not missing the window, not about any immediate risk to your puppy.');
  } else if (agegroup === 'puppy_14wk_6mo') {
    tips.push('The sharpest part of the window has passed, but socialization still matters a great deal through this stage — keep exposures varied: people, dogs, sounds, surfaces, and gentle handling.');
    tips.push('Your puppy should be further along on vaccines now — check with your vet about expanding to more public settings and dog-friendly spaces if not already doing so.');
  } else if (agegroup === 'adult_well') {
    tips.push('A well-adjusted adult mostly needs maintenance, not new foundational work — keep exposing them to some variety (new places, new dogs, new people) so social skills don\'t get rusty from routine.');
    tips.push('This is also a good stage to help socialize other dogs or puppies, since a calm, well-socialized adult can be a great example for a puppy during their own window.');
  } else {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '🩺';
    heroTitle = 'Go Slower — Counter-Conditioning, Not Exposure';
    tips.push('This is a different, slower process than puppy socialization: pair novel things with high-value treats from a distance your dog is actually comfortable at, then gradually decrease that distance over time — this is counter-conditioning, not just exposure.');
    tips.push('Pushing too fast can worsen fear-based reactivity — progress here is measured in your dog staying calm enough to notice a treat and engage, not in how much new stuff you can expose them to in one session.');
    tips.push('Many fearful or reactive adult dogs benefit significantly from a certified force-free trainer or veterinary behaviorist rather than DIY exposure — worth considering if progress stalls or you\'re unsure how to read your dog\'s signals.');
  }

  if (level === 'not_started') {
    tips.push('Starting from scratch, begin with the lowest-pressure exposures first (quiet spaces, one calm dog or person at a time) and build from there rather than jumping into busy environments.');
  } else if (level === 'some') {
    tips.push('With some exposure already, look at which categories you\'ve covered (people, dogs, sounds, surfaces, handling) and prioritize the ones you\'ve missed rather than repeating the same easy wins.');
  } else {
    tips.push('To maintain and expand from a well-socialized baseline, rotate in new environments and mild novelty regularly so skills stay sharp rather than fading from routine.');
  }

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + agegroupLabels[agegroup] + ' · ' + levelLabels[level] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Age Group</div><div class="pz-result-cell-val" style="font-size:12px">' + agegroupLabels[agegroup] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Current Level</div><div class="pz-result-cell-val" style="font-size:12px">' + levelLabels[level] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>🤝 Your Socialization Priorities</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Dog Aggression Training Guide
function pzGenAggression() {
  var trigger = document.getElementById('pz_tf_trigger')?.value || 'strangers';
  var severity = document.getElementById('pz_tf_severity')?.value || 'warning';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Matching guidance to your situation…');
  setTimeout(function() {

  var triggerLabels = {
    strangers: 'Strangers approaching home or owner',
    dogs: 'Other dogs',
    guarding: 'Resource guarding (food/toys/space)',
    sudden: 'Sudden onset, previously not aggressive',
    leash: 'Only happens on leash'
  };
  var severityLabels = {
    warning: 'Growling/stiffening, no contact',
    snapped: 'Snapped but did not make contact',
    bitten: 'Has bitten'
  };

  var tips = [];
  // This entire guide defaults to warning-state — aggression is safety-critical regardless of branch.
  var wrapClass = 'pz-result-warning';
  var heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
  var heroIcon = '⚠️';
  var heroTitle = 'Cause-Matched Aggression Guidance';

  if (trigger === 'sudden') {
    heroColor = 'linear-gradient(135deg,#B71C1C,#E65100)';
    heroIcon = '🩺';
    heroTitle = 'Get a Vet Check Before Assuming It\'s Behavioral';
    tips.push('A previously non-aggressive dog suddenly acting aggressively, especially when touched in a specific area, strongly warrants an immediate vet check to rule out pain or illness before assuming this is purely a training issue.');
    tips.push('Once a medical cause is ruled out or treated, the underlying behavioral pattern (fear, guarding, etc.) can be addressed on its own terms.');
  } else if (trigger === 'strangers') {
    heroTitle = 'Territorial/Protective Aggression Guidance';
    tips.push('Aggression toward strangers approaching your home or you specifically often has a territorial or protective root — management (distance, barriers, a leash indoors when guests arrive) reduces risk while you work on the underlying response.');
    tips.push('Avoid forcing greetings or "getting it over with" introductions — this tends to escalate rather than resolve the behavior.');
  } else if (trigger === 'dogs') {
    heroTitle = 'Dog-Directed Aggression Guidance';
    tips.push('Reactions to other dogs can stem from fear, poor early socialization, frustration, or genuine dog-dog incompatibility — the right approach depends on which of these is actually driving it.');
    tips.push('Distance is your main safety tool in the meantime — keep enough space from other dogs that your dog can stay under threshold while you get a professional assessment.');
  } else if (trigger === 'guarding') {
    heroTitle = 'Resource Guarding Guidance';
    tips.push('Resource guarding over food, toys, or space is a distinct, well-understood pattern with its own trade-up and counter-conditioning protocols — it is not the same as general aggression.');
    tips.push('Mild resource guarding is one of the more approachable forms to work on with careful, gradual counter-conditioning, but it escalates quickly if mishandled, so go slowly and avoid taking items away by force.');
  } else {
    heroTitle = 'Leash Reactivity Guidance';
    tips.push('Aggression-like behavior that only happens on leash is often frustration-based rather than true aggression, and behaves differently from how the same dog acts off-leash.');
    tips.push('Distance-based counter-conditioning — rewarding calm behavior at a distance your dog can handle, then gradually decreasing that distance — is the standard approach here.');
  }

  tips.push('Never punish growling or stiffening — it is your dog\'s warning system, and punishing it removes the warning without addressing the underlying issue, which can make a bite without notice more likely, not less.');

  if (severity === 'bitten') {
    heroColor = 'linear-gradient(135deg,#B71C1C,#E65100)';
    heroIcon = '🚨';
    heroTitle = 'Get a Veterinary Behaviorist Involved Now';
    tips.push('A bite is a serious safety event regardless of the trigger — get a veterinary behaviorist or a CAAB/CPDT-KA trainer with real aggression experience involved now rather than continuing with DIY approaches alone.');
    tips.push('In the meantime, manage the environment closely: muzzle training (done gradually and positively), a secure leash, and distance from known triggers reduce risk while you arrange professional support.');
  } else if (severity === 'snapped') {
    tips.push('A snap without contact is still a real escalation from a warning signal — this is a strong signal to bring in a certified professional now rather than waiting to see if it happens again.');
    tips.push('Increase your management in the meantime: more distance from the trigger, and consider starting muzzle training as a proactive safety step.');
  } else {
    tips.push('Growling or stiffening without contact is still your dog communicating real discomfort — this is the ideal, earliest point to bring in a professional, since it\'s far easier to work with before any escalation happens.');
  }

  tips.push('Beyond mild resource guarding or these earliest fear signals, this genuinely warrants a certified professional rather than DIY training alone — a veterinary behaviorist or CAAB/CPDT-KA trainer with aggression experience can build a plan matched to your dog\'s specific cause and severity.');

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + triggerLabels[trigger] + ' · ' + severityLabels[severity] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Trigger</div><div class="pz-result-cell-val" style="font-size:12px">' + triggerLabels[trigger] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Severity</div><div class="pz-result-cell-val" style="font-size:12px">' + severityLabels[severity] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>⚠️ Your Guidance</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Fun Dog Tricks Training Guide
function pzGenTrickTraining() {
  var level = document.getElementById('pz_tf_level')?.value || 'starting';
  var trick = document.getElementById('pz_tf_trick')?.value || 'shake';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Building your trick training steps…');
  setTimeout(function() {

  var levelLabels = {
    starting: 'Just starting — knows sit/down',
    some: 'Some tricks already, ready for more',
    advanced: 'Advanced, wants a challenge'
  };
  var trickLabels = {
    shake: 'Shake/paw',
    spin: 'Spin',
    rollover: 'Roll over',
    playdead: 'Play dead',
    notsure: 'Not sure — suggest one'
  };

  var tips = [];
  var wrapClass = 'pz-result-success';
  var heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
  var heroIcon = '🎪';
  var heroTitle = 'Your Trick Training Steps';

  var effectiveTrick = trick;
  if (trick === 'notsure') {
    effectiveTrick = (level === 'advanced') ? 'rollover' : 'shake';
    tips.push('Since you\'re not sure which to try, ' + (effectiveTrick === 'rollover' ? 'roll over is a good next challenge' : 'shake/paw is a great starting trick') + ' based on your dog\'s current level.');
  }

  if (effectiveTrick === 'shake') {
    heroTitle = 'Teaching Shake/Paw';
    tips.push('From a sit, gently touch or tap your dog\'s paw while saying "shake," and the instant the paw lifts even slightly, mark and treat.');
    tips.push('Alternatively, wait for your dog to naturally lift a paw (many dogs do this out of frustration when a treat is held in a closed fist) and mark that moment — this is shaping rather than luring.');
    tips.push('Once reliable, "high five" is a natural next step — just raise your target hand a little higher and reward the higher paw lift.');
  } else if (effectiveTrick === 'spin') {
    heroTitle = 'Teaching Spin';
    tips.push('Lure with a treat held right at nose height, tracing a circle in the air so your dog\'s whole body follows — mark and treat as soon as the circle completes.');
    tips.push('Break it into quarter-turns at first if your dog loses the treat trail, then gradually ask for more of the circle before marking.');
    tips.push('Once solid, teach the opposite direction with a distinctly different cue so your dog learns to tell the two apart.');
  } else if (effectiveTrick === 'rollover') {
    heroTitle = 'Teaching Roll Over — Takes More Patience';
    tips.push('Build from a solid "down" first, then break the roll into small steps: lure your dog to lie flat on one side, mark and treat that step alone before asking for more.');
    tips.push('Next, lure the head and shoulder around slightly further each rep, rewarding every small bit of progress rather than expecting the full roll right away.');
    tips.push('This is one of the harder beginner tricks precisely because it\'s several small steps chained together — expect it to take more sessions than shake or spin.');
    tips.push('If your dog has any joint or back sensitivity, go extra gently or consider skipping this trick — a vet check first is reasonable if you\'re unsure.');
  } else {
    heroTitle = 'Teaching Play Dead';
    tips.push('Start from "down," then lure your dog onto their side with a treat traced from nose toward their shoulder, pairing it with a "bang" cue.');
    tips.push('Mark and treat the instant your dog\'s side touches the ground, then gradually ask them to hold the position a beat longer before rewarding.');
    tips.push('This builds naturally on the same down-to-side motion used for roll over, so dogs that know one often pick up the other faster.');
  }

  if (level === 'starting') {
    tips.push('Since you\'re just starting out, keep sessions to just a few minutes and stick with one trick at a time until it\'s solid before adding another.');
  } else if (level === 'some') {
    tips.push('With some tricks already under your dog\'s belt, you can layer this new one in alongside a quick warm-up of a trick they already know well.');
  } else {
    tips.push('For an extra challenge, try chaining this trick with one your dog already knows, or adding it to a short sequence cued one after another.');
  }

  tips.push('Across every trick: mark the instant of correct behavior, treat immediately, keep sessions short, and end on a success rather than pushing until your dog loses interest.');
  tips.push('Very young puppies should skip high-impact or jumping-heavy tricks until their growth plates close, to protect developing joints.');

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + levelLabels[level] + ' · ' + trickLabels[trick] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Level</div><div class="pz-result-cell-val" style="font-size:12px">' + levelLabels[level] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Trick</div><div class="pz-result-cell-val" style="font-size:12px">' + trickLabels[trick] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>🎪 Your Step-by-Step Approach</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Rescue Dog Training: First 30 Days Guide
function pzGenRescueDog() {
  var daysowned = document.getElementById('pz_tf_daysowned')?.value || 'days';
  var concern = document.getElementById('pz_tf_concern')?.value || 'routine';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Building your first-30-days plan…');
  setTimeout(function() {

  var daysownedLabels = {
    days: 'Just brought them home (days 1-3)',
    weeks: 'First few weeks (up to 3 weeks)',
    months: '1-3 months in'
  };
  var concernLabels = {
    routine: 'Just building routine, no major issues',
    fearful: 'Very fearful/hiding/shut down',
    guarding: 'Showing guarding or aggression signs',
    escape: 'Escape risk / flight-prone when scared'
  };

  var tips = [];
  var wrapClass = 'pz-result-success';
  var heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
  var heroIcon = '🏠';
  var heroTitle = 'Your First 30 Days Plan';

  if (daysowned === 'days') {
    tips.push('You\'re in the decompression window — this is normal, not a sign of a bigger problem. Your dog may not eat normally or may hide, so keep things calm, predictable, and low-stimulation rather than starting heavy training or lots of new introductions.');
  } else if (daysowned === 'weeks') {
    tips.push('You\'re in the settling-in window — your dog is likely learning your household routine, testing boundaries a little, and showing more of its real personality now. This is a good time to begin gentle basic training and routine-building.');
  } else {
    tips.push('You\'re moving into the true-bonding window — training can progress more like it would with any dog, and the deeper routine and trust built over the past couple months should be paying off.');
  }

  if (concern === 'fearful') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '🩺';
    heroTitle = 'Patience First — Don\'t Force It';
    tips.push('Don\'t force interaction or affection — let your dog approach you on its own timeline. Forcing closeness before a fearful dog is ready usually backfires and slows the process down.');
    tips.push('This is normal for many rescue dogs, especially with an unknown history, and isn\'t a sign you\'re doing something wrong — expect the timeline to be longer than a 3-3-3 guideline might suggest, and that\'s okay.');
  } else if (concern === 'guarding') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '⚠️';
    heroTitle = 'Get a Rescue-Experienced Trainer Involved Early';
    tips.push('Resource guarding or aggression signs in a new rescue, especially with an unknown history, are worth involving a rescue-experienced trainer for earlier rather than waiting to see if it resolves on its own.');
    tips.push('In the meantime, manage the environment — give space around food and high-value items, and avoid taking things away by force.');
  } else if (concern === 'escape') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '🦺';
    heroTitle = 'Secure Your Equipment — Real Flight Risk';
    tips.push('A well-fitted collar and harness with ID, plus a slip-lead backup, is worth the extra caution — scared rescue dogs are a genuine flight risk in an unfamiliar place, especially in these early weeks.');
    tips.push('Double-check gates, doors, and vehicle exits during this period, and avoid off-leash time in unfenced areas until your dog is more settled and reliably responsive.');
  } else {
    tips.push('Keep a consistent routine — feeding times and walk times at similar times each day help reduce stress for a dog still adjusting to a new environment.');
  }

  tips.push('If your dog came with a known or suspected history of neglect, abuse, or limited socialization, expect training to take longer, and consider consulting a trainer experienced with rescue or fearful dogs early on rather than waiting for problems to develop.');

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + daysownedLabels[daysowned] + ' · ' + concernLabels[concern] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Time Since Adoption</div><div class="pz-result-cell-val" style="font-size:12px">' + daysownedLabels[daysowned] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Main Concern</div><div class="pz-result-cell-val" style="font-size:12px">' + concernLabels[concern] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>🏠 Your Plan</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Dog Obedience Training Schedule
function pzGenObedienceSchedule() {
  var agegroup = document.getElementById('pz_tf_agegroup')?.value || 'puppy';
  var goal = document.getElementById('pz_tf_goal')?.value || 'foundation';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Building your training schedule…');
  setTimeout(function() {

  var agegroupLabels = {
    puppy: 'Puppy (8 weeks - 6 months)',
    adult: 'Adult dog, new to training',
    senior: 'Senior dog'
  };
  var goalLabels = {
    foundation: 'Building a first-time foundation',
    distractions: 'Adding reliability around distractions',
    maintenance: 'General refresher/maintenance'
  };

  var tips = [];
  var wrapClass = 'pz-result-success';
  var heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
  var heroIcon = '📅';
  var heroTitle = 'Your Weekly Training Schedule';

  if (agegroup === 'puppy') {
    tips.push('Puppies do well starting as young as 8 weeks with very short, food-motivated sessions — aim for 3-5 minutes, 3-4 times a day, since attention spans are short at this age.');
  } else if (agegroup === 'adult') {
    tips.push('Adult dogs learn perfectly well on the same structure as a puppy — "old dogs can\'t learn new tricks" is a myth. Aim for 5-10 minute sessions, 2-3 times a day.');
  } else {
    tips.push('Senior dogs can absolutely still learn — age isn\'t the limiting factor here. Keep sessions a bit shorter (5-7 minutes) and be mindful of positions like sit or down if joint stiffness makes them uncomfortable; standing-based cues or a raised surface can help.');
  }

  if (goal === 'foundation') {
    heroTitle = 'Weeks 1-2: Foundation Phase';
    tips.push('Focus on core commands (sit, stay, come, down) in a low-distraction environment like home or the yard, using high-value treats for every rep.');
    tips.push('Once those are solid, move into weeks 3-4: add duration and a little distance to each command, and start practicing in mildly more distracting settings like the front yard or a quiet street.');
  } else if (goal === 'distractions') {
    heroTitle = 'Weeks 5-8: Generalization Phase';
    tips.push('This is the step most owners skip — deliberately practice known commands in new locations and around real distractions. A dog that "knows sit" at home may act like it\'s never heard the word at a busy park, and that\'s incomplete generalization, not defiance.');
    tips.push('Increase distraction gradually: a quiet street, then a park with some activity, then somewhere busier — advancing only once your dog is reliable at the current level.');
    tips.push('A structured, force-free group obedience class is a great way to add real-world distraction practice with professional guidance built in.');
  } else {
    heroTitle = 'Ongoing Maintenance Schedule';
    tips.push('Skills can fade without use, especially around distractions — a couple of short practice sessions a week, rotating through different commands and locations, keeps everything sharp.');
    tips.push('Use maintenance sessions to spot-check generalization too — try a known command somewhere you haven\'t practiced in a while.');
  }

  tips.push('Across every phase, short daily sessions consistently outperform occasional long ones for both learning speed and retention.');

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + agegroupLabels[agegroup] + ' · ' + goalLabels[goal] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Age Group</div><div class="pz-result-cell-val" style="font-size:12px">' + agegroupLabels[agegroup] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Goal</div><div class="pz-result-cell-val" style="font-size:12px">' + goalLabels[goal] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>📅 Your Schedule</h4><ul>' + listHtml + '</ul></div>'
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download as PDF</button></div>'
    + '</div>';

  }, 650);
}

// ── Dog Sleep Training Guide
function pzGenSleepTraining() {
  var agegroup = document.getElementById('pz_tf_agegroup')?.value || 'puppy';
  var preference = document.getElementById('pz_tf_preference')?.value || 'tradeoffs';
  var result = document.getElementById('pz-guide-result');
  if (!result) return;
  pzShowAnalyzing('pz-guide-result', 'Weighing the tradeoffs for your dog…');
  setTimeout(function() {

  var agegroupLabels = {
    puppy: 'New puppy, still house-training',
    adult: 'Adult dog, well-adjusted',
    sensitive: 'Dog with anxiety or guarding tendencies'
  };
  var preferenceLabels = {
    room: 'Want them in my room',
    ownspace: 'Want them in their own space',
    tradeoffs: 'Not sure — want the tradeoffs'
  };

  var tips = [];
  var wrapClass = 'pz-result-success';
  var heroColor = 'linear-gradient(135deg,#1B5E20,#2E7D32)';
  var heroIcon = '😴';
  var heroTitle = 'Your Sleep Setup Guidance';

  if (agegroup === 'puppy') {
    heroTitle = 'Crate Near Your Bed Is the Common Starting Point';
    tips.push('Many trainers suggest a crate near your bed for the first weeks or months — the proximity reduces whining, and since puppies typically need one or more nighttime bathroom breaks, being nearby to hear those cues matters during house-training.');
    tips.push('Dogs generally avoid soiling their own sleep space, so a properly sized crate genuinely supports the house-training process.');
    tips.push('Once your puppy is reliably house-trained and settled, you can gradually transition to whichever long-term setup you prefer — there\'s no fixed timeline for this.');
  } else if (agegroup === 'sensitive') {
    wrapClass = 'pz-result-warning';
    heroColor = 'linear-gradient(135deg,#E65100,#FF9800)';
    heroIcon = '⚠️';
    heroTitle = 'Worth Knowing Before You Decide';
    tips.push('If your dog already shows guarding tendencies, sharing your bed can reinforce bed-guarding specifically — worth being aware of, not a reason to panic, just something to factor in.');
    tips.push('For a dog with genuine separation anxiety, always sleeping pressed against you can mean they never get to practice being calm without physical contact, which can make solo alone-time harder rather than easier.');
    tips.push('A dog bed in your room but not on the bed itself is often a good middle ground here — proximity comfort without reinforcing either issue as directly.');
  } else {
    heroTitle = 'Any Common Setup Works Well for You';
    tips.push('For a well-adjusted adult dog with no behavioral concerns, bed-sharing, a dog bed in your room, or a separate space are all genuinely fine choices — this comes down to preference, not a right or wrong answer.');
  }

  if (preference === 'room') {
    tips.push('Keeping your dog in your room — whether on the bed or on a dog bed nearby — is a popular choice that most well-adjusted dogs do fine with.');
  } else if (preference === 'ownspace') {
    tips.push('A separate room or dog bed elsewhere in the house works well for secure, well-trained adult dogs, though it\'s less ideal for a new puppy or an anxious dog still settling in.');
  } else {
    tips.push('There\'s no single universally "correct" answer here — crate, bedroom, bed, or separate space are all legitimate, and the right choice depends on your dog\'s age, temperament, and what actually works for your household.');
  }

  var listHtml = '';
  tips.forEach(function(t){ listHtml += '<li>' + t + '</li>'; });

  result.style.display = 'block';
  result.innerHTML =
    '<div class="' + wrapClass + '" style="border-radius:16px;overflow:hidden">'
    + '<div class="pz-result-hero" style="background:' + heroColor + ';color:#fff;padding:24px">'
    + '<div style="font-size:13px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">' + heroIcon + ' ' + heroTitle + '</div>'
    + '<div style="font-size:15px;opacity:.9">' + agegroupLabels[agegroup] + ' · ' + preferenceLabels[preference] + '</div>'
    + '</div>'
    + '<div class="pz-result-grid">'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Situation</div><div class="pz-result-cell-val" style="font-size:12px">' + agegroupLabels[agegroup] + '</div></div>'
    + '<div class="pz-result-cell"><div class="pz-result-cell-label">Preference</div><div class="pz-result-cell-val" style="font-size:12px">' + preferenceLabels[preference] + '</div></div>'
    + '</div>'
    + '<div class="pz-result-tips"><h4>😴 Your Guidance</h4><ul>' + listHtml + '</ul></div>'
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
    + '<div style="padding:0 20px 20px"><button class="pz-int-btn" style="margin-top:0;background:transparent;border:2px solid #E0E0E0;color:#555" onclick="pzPrintResult()">📥 Download This Result as PDF</button></div>'
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
