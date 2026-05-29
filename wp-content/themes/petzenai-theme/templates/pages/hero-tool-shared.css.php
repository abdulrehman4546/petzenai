<?php if(!defined('ABSPATH')) exit; ?>
:root{--orange:#FF6B1A;--bg:#F7F8FA}
.ht-page{background:var(--bg);min-height:100vh}
.ht-breadcrumb{background:#fff;border-bottom:1px solid #E8E8E8;padding:10px 24px;font-size:13px;color:#888}
.ht-breadcrumb a{color:#888;text-decoration:none}.ht-breadcrumb a:hover{color:var(--orange)}
.ht-breadcrumb span{margin:0 6px}

.ht-hero{padding:60px 24px 50px;text-align:center;position:relative;overflow:hidden}
.ht-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 70% 60% at 50% 0%,rgba(255,107,26,.15),transparent);pointer-events:none}
.ht-hero-icon{font-size:60px;display:block;margin-bottom:16px}
.ht-hero h1{font-size:clamp(26px,5vw,44px);font-weight:900;color:#fff;margin-bottom:12px;line-height:1.15}
.ht-hero h1 span{color:var(--orange)}
.ht-hero p{font-size:16px;color:rgba(255,255,255,.65);max-width:560px;margin:0 auto 20px;line-height:1.7}
.ht-badges{display:flex;gap:8px;justify-content:center;flex-wrap:wrap}
.ht-badge{font-size:12px;font-weight:700;padding:5px 12px;border-radius:50px}
.ht-badge.green{background:rgba(76,175,80,.2);color:#4CAF50;border:1px solid rgba(76,175,80,.3)}
.ht-badge.blue{background:rgba(59,130,246,.2);color:#60A5FA;border:1px solid rgba(59,130,246,.3)}
.ht-badge.orange{background:rgba(255,107,26,.2);color:#FF6B1A;border:1px solid rgba(255,107,26,.3)}
.ht-badge.purple{background:rgba(139,92,246,.2);color:#A78BFA;border:1px solid rgba(139,92,246,.3)}

.ht-main{max-width:1200px;margin:0 auto;padding:40px 24px 80px;display:grid;grid-template-columns:1fr 340px;gap:32px;align-items:start}
@media(max-width:900px){.ht-main{grid-template-columns:1fr}}

.ht-tool-wrap{background:#fff;border-radius:20px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,.08);border:1.5px solid #E8E8E8}
.ht-tool-header{padding:24px 28px 0;border-bottom:1px solid #F0F0F0;padding-bottom:20px;margin-bottom:24px}
.ht-tool-header h2{font-size:20px;font-weight:900;color:#0D0D0D;margin-bottom:4px}
.ht-tool-header p{font-size:13px;color:#888}
.ht-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px 20px;padding:0 28px;margin-bottom:20px}
@media(max-width:600px){.ht-grid{grid-template-columns:1fr;padding:0 16px}}

.ht-field{display:flex;flex-direction:column;gap:6px}
.ht-field label{font-size:11px;font-weight:700;color:#666;text-transform:uppercase;letter-spacing:.06em;display:flex;align-items:center;gap:8px}
.ht-input{width:100%;padding:11px 40px 11px 14px;border:1.5px solid #E0E0E0;border-radius:10px;font-size:14px;color:#0D0D0D;outline:none;transition:border-color .2s;background:#FAFAFA}
.ht-input:focus{border-color:var(--orange);background:#fff}
.ht-input-wrap{position:relative}
.ht-suffix{position:absolute;right:12px;top:50%;transform:translateY(-50%);font-size:12px;font-weight:700;color:#999;pointer-events:none}
.ht-select{width:100%;padding:11px 14px;border:1.5px solid #E0E0E0;border-radius:10px;font-size:14px;color:#0D0D0D;outline:none;cursor:pointer;background:#FAFAFA;transition:border-color .2s}
.ht-select:focus{border-color:var(--orange)}
.ht-chips{display:flex;gap:6px;flex-wrap:wrap}
.ht-chip{padding:6px 12px;border:1.5px solid #E0E0E0;border-radius:50px;font-size:12px;font-weight:700;cursor:pointer;background:#FAFAFA;color:#555;transition:all .2s}
.ht-chip.active,.ht-chip:hover{background:var(--orange);border-color:var(--orange);color:#fff}
.ht-unit-sw{display:inline-flex;gap:2px;background:#F0F0F0;border-radius:6px;padding:2px;margin-left:6px}
.ht-ubtn{padding:2px 8px;border:none;border-radius:4px;font-size:11px;font-weight:700;cursor:pointer;color:#777;background:transparent;transition:all .15s}
.ht-ubtn.active{background:#fff;color:var(--orange);box-shadow:0 1px 4px rgba(0,0,0,.1)}

.ht-btn{display:flex;align-items:center;justify-content:center;gap:10px;width:calc(100% - 56px);margin:0 28px 28px;padding:16px 24px;background:linear-gradient(135deg,#FF6B1A,#e55a0d);border:none;border-radius:12px;color:#fff;font-size:16px;font-weight:800;cursor:pointer;transition:all .2s}
.ht-btn:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(255,107,26,.35)}
@media(max-width:600px){.ht-btn{margin:0 16px 20px;width:calc(100% - 32px)}}

.ht-warn{background:#FFF8E1;border:1.5px solid #FFB300;border-radius:10px;padding:14px 18px;color:#E65100;font-weight:700;font-size:14px;margin:0 28px 20px}

/* Results */
.ht-result-box{margin:0 28px 28px;border-radius:16px;overflow:hidden;border:1.5px solid #E8E8E8}
.ht-result-top{background:linear-gradient(135deg,#1B5E20,#2E7D32);color:#fff;padding:28px;text-align:center}
.ht-result-num{font-size:56px;font-weight:900;line-height:1;margin-bottom:4px}
.ht-result-unit{font-size:18px;font-weight:700;opacity:.8}
.ht-result-label{font-size:13px;opacity:.7;margin-top:4px;text-transform:uppercase;letter-spacing:.05em}
.ht-result-cells{display:grid;grid-template-columns:repeat(4,1fr);background:#F8F8F8;border-bottom:1px solid #E8E8E8}
@media(max-width:500px){.ht-result-cells{grid-template-columns:1fr 1fr}}
.ht-cell{padding:14px 8px;text-align:center;border-right:1px solid #E8E8E8}
.ht-cell:last-child{border-right:none}
.ht-cell-n{font-size:20px;font-weight:900;color:#0D0D0D}
.ht-cell-l{font-size:10px;color:#888;font-weight:600;text-transform:uppercase;margin-top:2px}
.ht-result-tips{padding:20px 24px}
.ht-result-tips h4{font-size:13px;font-weight:800;color:#0D0D0D;margin-bottom:10px;text-transform:uppercase;letter-spacing:.04em}
.ht-result-tips ul,.ht-result-tips ol{margin:0;padding-left:18px}
.ht-result-tips li{font-size:13px;color:#555;margin-bottom:6px;line-height:1.5}
.ht-print-btn{display:block;width:100%;padding:12px;background:var(--orange);color:#fff;border:none;border-radius:8px;font-size:14px;font-weight:700;cursor:pointer;margin-top:16px;transition:opacity .2s}
.ht-print-btn:hover{opacity:.85}

/* Checker */
.ht-progress-wrap{display:flex;align-items:center;gap:12px;padding:0 28px 20px}
.ht-progress-bar{flex:1;height:6px;background:#F0F0F0;border-radius:50px;overflow:hidden}
.ht-progress-fill{height:100%;background:linear-gradient(90deg,var(--orange),#FFB347);border-radius:50px;transition:width .4s}
.ht-progress-txt{font-size:12px;font-weight:700;color:#888;white-space:nowrap}
.ht-step{display:none;padding:0 28px 20px}.ht-step.active{display:block}
.ht-q-num{font-size:11px;font-weight:700;color:var(--orange);text-transform:uppercase;letter-spacing:.06em;margin-bottom:8px}
.ht-q-text{font-size:17px;font-weight:800;color:#0D0D0D;margin-bottom:16px;line-height:1.4}
.ht-answer-cards{display:grid;grid-template-columns:1fr 1fr;gap:10px}
@media(max-width:480px){.ht-answer-cards{grid-template-columns:1fr}}
.ht-answer-card{display:flex;flex-direction:column;align-items:center;gap:8px;padding:16px 12px;border:2px solid #E8E8E8;border-radius:12px;cursor:pointer;transition:all .2s;text-align:center;background:#FAFAFA}
.ht-answer-card:hover{border-color:var(--orange);background:#FFF5F0}
.ht-answer-card input{display:none}
.ht-answer-card.selected{border-color:var(--orange);background:rgba(255,107,26,.07)}
.ht-answer-icon{font-size:28px}
.ht-answer-txt{font-size:13px;font-weight:600;color:#333}

/* Sidebar */
.ht-info-wrap{display:flex;flex-direction:column;gap:20px}
.ht-info-card{background:#fff;border-radius:16px;padding:20px 22px;border:1.5px solid #E8E8E8}
.ht-info-card h3{font-size:14px;font-weight:800;color:#0D0D0D;margin-bottom:12px}
.ht-info-card ul,.ht-info-card ol{margin:0;padding-left:18px}
.ht-info-card li{font-size:13px;color:#555;margin-bottom:6px;line-height:1.5}
.ht-related{background:#fff;border-radius:16px;padding:20px 22px;border:1.5px solid #E8E8E8}
.ht-related h3{font-size:13px;font-weight:800;color:#0D0D0D;text-transform:uppercase;letter-spacing:.05em;margin-bottom:12px}
.ht-rel-link{display:flex;align-items:center;padding:9px 12px;border-radius:8px;font-size:13px;font-weight:600;color:#333;text-decoration:none;transition:all .2s;border:1px solid transparent;margin-bottom:4px}
.ht-rel-link:hover{background:rgba(255,107,26,.07);border-color:rgba(255,107,26,.2);color:var(--orange)}

/* Quiz */
.ht-quiz-intro{padding:0 28px 20px;background:#FFF8F5;border-bottom:1px solid #F0E8E0}
.ht-quiz-intro p{font-size:14px;color:#555;margin:0;line-height:1.6}

@media print{.ht-hero,.ht-info-wrap,.ht-btn,.ht-print-btn,.navbar,footer,.ht-breadcrumb{display:none!important}.ht-result-box{border:none}}
