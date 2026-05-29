<?php /** Template Name: 🎂 Hero Tool — Age Calculator */ if(!defined('ABSPATH')) exit; get_header(); ?>
<style><?php include get_template_directory().'/templates/pages/hero-tool-shared.css.php'; ?></style>
<main class="ht-page">
<?php include get_template_directory().'/templates/pages/hero-tool-breadcrumb.php'; ?>
<section class="ht-hero" style="background:linear-gradient(135deg,#0D0D1A,#1a0a2a)">
  <span class="ht-hero-icon">🎂</span>
  <h1>Pet Age Calculator <span>Human Years</span></h1>
  <p>Convert your dog or cat's age to human years using the science-backed formula — not the old 7× myth.</p>
  <div class="ht-badges"><span class="ht-badge green">✅ Vet Reviewed</span><span class="ht-badge blue">🔬 DNA-Based Formula</span><span class="ht-badge orange">⚡ Instant</span></div>
</section>
<div class="ht-main">
  <div class="ht-tool-wrap">
    <div class="ht-tool-header"><h2>🎂 Convert Pet Age to Human Years</h2><p>Uses breed-specific scientific formulas</p></div>
    <div class="ht-grid">
      <div class="ht-field"><label>Pet Type</label>
        <select id="ht_species" class="ht-select">
          <option value="dog">🐕 Dog</option><option value="cat">🐱 Cat</option>
          <option value="rabbit">🐰 Rabbit</option><option value="bird">🦜 Bird</option>
        </select>
      </div>
      <div class="ht-field"><label>Pet's Age (years)</label>
        <input type="number" id="ht_age" class="ht-input" placeholder="e.g. 5" min="0" max="30" step="0.5">
      </div>
      <div class="ht-field"><label>Breed Size (Dogs)</label>
        <select id="ht_size" class="ht-select">
          <option value="small">Small (under 20 lbs)</option>
          <option value="medium" selected>Medium (20–50 lbs)</option>
          <option value="large">Large (50–90 lbs)</option>
          <option value="giant">Giant (90+ lbs)</option>
        </select>
      </div>
      <div class="ht-field"><label>Your Pet's Name <span style="font-weight:400;color:#aaa;font-size:11px">(optional)</span></label>
        <input type="text" id="ht_name" class="ht-input" placeholder="e.g. Buddy">
      </div>
    </div>
    <button class="ht-btn" onclick="htCalcAge()">🎂 Calculate Human Age — Free</button>
    <div id="ht-result" style="display:none"></div>
  </div>
  <div class="ht-info-wrap">
    <div class="ht-info-card"><h3>🔬 The Science Behind Pet Ages</h3><ul>
      <li>The old "1 year = 7 human years" rule is a myth</li>
      <li>Dogs age faster when young, slower when older</li>
      <li>Large breeds age faster than small breeds</li>
      <li>Cats follow a different curve — fast early, slower later</li>
    </ul></div>
    <div class="ht-info-card"><h3>📊 Life Stage Guide</h3><ul>
      <li><strong>Puppy/Kitten:</strong> 0–1 yr = rapid development</li>
      <li><strong>Young Adult:</strong> 1–3 yrs = prime condition</li>
      <li><strong>Middle Age:</strong> 4–7 yrs = preventive care key</li>
      <li><strong>Senior:</strong> 7+ yrs = increased vet visits</li>
    </ul></div>
    <div class="ht-related"><h3>🔗 Related Tools</h3>
      <a href="<?php echo home_url('/tools/pet-food-portion-calculator/'); ?>" class="ht-rel-link">🍽️ Food Portion Calculator →</a>
      <a href="<?php echo home_url('/tools/pet-vaccination-schedule/'); ?>" class="ht-rel-link">💉 Vaccination Schedule →</a>
      <a href="<?php echo home_url('/tools/pet-exercise-calculator/'); ?>" class="ht-rel-link">🏃 Exercise Calculator →</a>
    </div>
  </div>
</div>
<script>
function htCalcAge(){
  var age=parseFloat(document.getElementById('ht_age').value)||0;
  var species=document.getElementById('ht_species').value;
  var size=document.getElementById('ht_size').value;
  var name=document.getElementById('ht_name').value||'Your Pet';
  var res=document.getElementById('ht-result');
  if(!age||age<=0){res.style.display='block';res.innerHTML='<div class="ht-warn">⚠️ Please enter your pet\'s age.</div>';return;}
  var human=0;
  if(species==='dog'){
    var t={small:[15,24,28,32,36,40,44,48,52,56,60,64,68,72,76],medium:[15,24,28,32,36,42,47,51,56,61,66,70,74,78,83],large:[15,24,28,32,36,45,50,55,61,66,72,77,82,88,93],giant:[15,24,28,32,36,49,56,64,71,79,86,93,100,107,115]};
    var tbl=t[size]||t['medium'];
    var idx=Math.min(Math.round(age)-1,tbl.length-1);
    human=idx>=0?tbl[idx]:Math.round(age*6);
  } else if(species==='cat'){
    if(age<=1) human=15; else if(age<=2) human=24; else human=24+Math.round((age-2)*4);
  } else if(species==='rabbit'){
    human=Math.round(age*9);
  } else {
    human=Math.round(age*5);
  }
  var stage=human<18?'Young':human<40?'Young Adult':human<60?'Middle Age':human<75?'Senior':'Elder';
  var stageColor=human<40?'#2E7D32':human<60?'#E65100':'#C62828';
  res.style.display='block';
  res.innerHTML='<div class="ht-result-box">'
    +'<div class="ht-result-top" style="background:linear-gradient(135deg,#4A148C,#7B1FA2)">'
    +'<div style="font-size:13px;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px">'+name+'\'s Human Age</div>'
    +'<div class="ht-result-num">'+human+'<span class="ht-result-unit"> human years</span></div>'
    +'<div class="ht-result-label" style="color:#CE93D8">Life Stage: '+stage+'</div>'
    +'</div>'
    +'<div class="ht-result-cells">'
    +'<div class="ht-cell"><div class="ht-cell-n">'+age+'</div><div class="ht-cell-l">Pet Years</div></div>'
    +'<div class="ht-cell"><div class="ht-cell-n">'+human+'</div><div class="ht-cell-l">Human Years</div></div>'
    +'<div class="ht-cell"><div class="ht-cell-n" style="color:'+stageColor+'">'+stage+'</div><div class="ht-cell-l">Life Stage</div></div>'
    +'<div class="ht-cell"><div class="ht-cell-n">'+(age<=6?'Annual':'6-mo')+'</div><div class="ht-cell-l">Vet Visits</div></div>'
    +'</div>'
    +'<div class="ht-result-tips"><h4>💡 Care Tips for '+stage+' '+species.charAt(0).toUpperCase()+species.slice(1)+'</h4><ul>'
    +(human<24?'<li>Focus on socialization and basic training</li><li>Complete vaccination series on schedule</li><li>Spay/neuter between 6–12 months</li>':'')
    +(human>=24&&human<60?'<li>Annual wellness check-ups are sufficient</li><li>Maintain healthy weight and regular exercise</li><li>Dental cleanings every 1–2 years</li>':'')
    +(human>=60?'<li>Switch to senior-formula food</li><li>Bi-annual vet visits recommended</li><li>Watch for arthritis, vision/hearing changes</li>':'')
    +'</ul></div>'
    +'<button onclick="window.print()" class="ht-print-btn">📥 Save as PDF</button>'
    +'</div>';
}
</script>
<?php get_footer(); ?>
