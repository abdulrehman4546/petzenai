<?php /** Template Name: 💉 Hero Tool — Vaccination Schedule */ if(!defined('ABSPATH')) exit; get_header(); ?>
<style><?php include get_template_directory().'/templates/pages/hero-tool-shared.css.php'; ?></style>
<main class="ht-page">
<?php include get_template_directory().'/templates/pages/hero-tool-breadcrumb.php'; ?>
<section class="ht-hero" style="background:linear-gradient(135deg,#0D0D1A,#0a1a2a)">
  <span class="ht-hero-icon">💉</span>
  <h1>Pet Vaccination <span>Schedule Tracker</span></h1>
  <p>Never miss a vaccine. Get a complete vet-recommended immunization schedule tailored to your pet's age and type.</p>
  <div class="ht-badges"><span class="ht-badge green">✅ Vet Reviewed</span><span class="ht-badge blue">📋 Full Schedule</span><span class="ht-badge orange">⚡ Instant</span></div>
</section>
<div class="ht-main">
  <div class="ht-tool-wrap">
    <div class="ht-tool-header"><h2>💉 Get Your Pet's Vaccine Schedule</h2><p>Core + non-core vaccines with timing</p></div>
    <div class="ht-grid">
      <div class="ht-field"><label>Pet Type</label>
        <select id="ht_species" class="ht-select"><option value="dog">🐕 Dog</option><option value="cat">🐱 Cat</option></select>
      </div>
      <div class="ht-field"><label>Current Age</label>
        <div class="ht-input-wrap"><input type="number" id="ht_age" class="ht-input" placeholder="e.g. 8" min="0" max="20" step="0.5"><span class="ht-suffix">wks/mo</span></div>
      </div>
      <div class="ht-field"><label>Age Unit</label>
        <div class="ht-chips"><button class="ht-chip active" data-val="weeks" onclick="htChip(this,'ageunit')">Weeks</button><button class="ht-chip" data-val="months" onclick="htChip(this,'ageunit')">Months</button><button class="ht-chip" data-val="years" onclick="htChip(this,'ageunit')">Years</button></div>
        <input type="hidden" id="ht_ageunit" value="weeks">
      </div>
      <div class="ht-field"><label>Lifestyle</label>
        <select id="ht_lifestyle" class="ht-select"><option value="indoor">Indoor Only</option><option value="outdoor" selected>Outdoor/Mixed</option><option value="boarding">Goes to Boarding/Dog Park</option></select>
      </div>
    </div>
    <button class="ht-btn" onclick="htCalcVaccine()">💉 Generate My Vaccine Schedule — Free</button>
    <div id="ht-result" style="display:none"></div>
  </div>
  <div class="ht-info-wrap">
    <div class="ht-info-card"><h3>🛡️ Core Vaccines (All Pets)</h3><ul>
      <li><strong>Dogs:</strong> Distemper, Parvovirus, Adenovirus, Rabies</li>
      <li><strong>Cats:</strong> FVRCP (3-in-1), Rabies</li>
      <li>Core vaccines are required by most vets & boarding facilities</li>
    </ul></div>
    <div class="ht-info-card"><h3>💡 Non-Core (Lifestyle-Based)</h3><ul>
      <li><strong>Dogs:</strong> Bordetella, Leptospirosis, Lyme</li>
      <li><strong>Cats:</strong> FeLV (outdoor cats), Chlamydia</li>
      <li>Based on exposure risk and environment</li>
    </ul></div>
    <div class="ht-related"><h3>🔗 Related Tools</h3>
      <a href="<?php echo home_url('/tools/pet-age-calculator/'); ?>" class="ht-rel-link">🎂 Pet Age Calculator →</a>
      <a href="<?php echo home_url('/tools/pet-food-portion-calculator/'); ?>" class="ht-rel-link">🍽️ Food Portion Calculator →</a>
    </div>
  </div>
</div>
<script>
function htChip(el,field){el.closest('.ht-chips').querySelectorAll('.ht-chip').forEach(function(c){c.classList.remove('active')});el.classList.add('active');var inp=document.getElementById('ht_'+field);if(inp)inp.value=el.dataset.val;}
function htCalcVaccine(){
  var age=parseFloat(document.getElementById('ht_age').value)||0;
  var unit=document.getElementById('ht_ageunit').value;
  var species=document.getElementById('ht_species').value;
  var lifestyle=document.getElementById('ht_lifestyle').value;
  var res=document.getElementById('ht-result');
  if(!age){res.style.display='block';res.innerHTML='<div class="ht-warn">⚠️ Please enter your pet\'s age.</div>';return;}
  var ageWks=unit==='weeks'?age:(unit==='months'?age*4.3:age*52);
  var schedule=species==='dog'?[
    {name:'DA2PP (Distemper/Parvo)',due:ageWks<8?'Now (6-8 weeks)':ageWks<12?'Now':ageWks<16?'Now (12-16 wks)':'Booster in 1 year',status:ageWks<16?'🔴 Due':'✅ Booster Due',core:true},
    {name:'Rabies',due:ageWks<52?'At 12-16 weeks':ageWks<104?'Booster in 1 year':'Every 1-3 years',status:ageWks<16?'🔴 Due':'✅ Up to date',core:true},
    {name:'Bordetella (Kennel Cough)',due:lifestyle==='boarding'?'Every 6-12 months':'Optional',status:lifestyle==='boarding'?'⚠️ Recommended':'ℹ️ Optional',core:false},
    {name:'Leptospirosis',due:lifestyle==='outdoor'||lifestyle==='boarding'?'Annually':'Optional',status:lifestyle!=='indoor'?'⚠️ Recommended':'ℹ️ Optional',core:false},
    {name:'Lyme Disease',due:lifestyle==='outdoor'||lifestyle==='boarding'?'Annually':'Optional',status:lifestyle!=='indoor'?'⚠️ Recommended':'ℹ️ Optional',core:false},
  ]:[
    {name:'FVRCP (3-in-1)',due:ageWks<8?'Now (6-8 weeks)':ageWks<16?'Now (series)':'Booster every 3 years',status:ageWks<16?'🔴 Due':'✅ Booster Due',core:true},
    {name:'Rabies',due:ageWks<52?'At 12-16 weeks':'Every 1-3 years',status:ageWks<16?'🔴 Due':'✅ Up to date',core:true},
    {name:'FeLV (Feline Leukemia)',due:lifestyle!=='indoor'?'Annually for outdoor cats':'Optional',status:lifestyle!=='indoor'?'⚠️ Recommended':'ℹ️ Indoor — Optional',core:false},
  ];
  var rows=schedule.map(function(v){return '<tr><td style="padding:10px 12px;font-weight:700;color:#0D0D0D">'+v.name+(v.core?'<span style="margin-left:6px;font-size:10px;background:rgba(76,175,80,.15);color:#2E7D32;padding:2px 6px;border-radius:4px;font-weight:700">CORE</span>':'')+'</td><td style="padding:10px 12px;color:#555;font-size:13px">'+v.due+'</td><td style="padding:10px 12px">'+v.status+'</td></tr>';}).join('');
  res.style.display='block';
  res.innerHTML='<div class="ht-result-box">'
    +'<div class="ht-result-top" style="background:linear-gradient(135deg,#0D47A1,#1565C0)">'
    +'<div style="font-size:13px;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">Vaccine Schedule Ready</div>'
    +'<div style="font-size:32px;font-weight:900;margin-bottom:4px">'+schedule.length+' Vaccines</div>'
    +'<div style="font-size:13px;opacity:.7">'+schedule.filter(function(v){return v.core;}).length+' Core · '+schedule.filter(function(v){return !v.core;}).length+' Non-Core</div>'
    +'</div>'
    +'<div style="overflow-x:auto"><table style="width:100%;border-collapse:collapse;font-size:13px">'
    +'<thead><tr style="background:#F5F5F5"><th style="padding:10px 12px;text-align:left;font-size:11px;color:#888;text-transform:uppercase;letter-spacing:.05em">Vaccine</th><th style="padding:10px 12px;text-align:left;font-size:11px;color:#888;text-transform:uppercase;letter-spacing:.05em">When Due</th><th style="padding:10px 12px;text-align:left;font-size:11px;color:#888;text-transform:uppercase;letter-spacing:.05em">Status</th></tr></thead>'
    +'<tbody>'+rows+'</tbody></table></div>'
    +'<div class="ht-result-tips"><h4>📋 Important Reminders</h4><ul>'
    +'<li>Keep all vaccine records in a physical folder for boarding/travel</li>'
    +'<li>Never skip the puppy/kitten series — immunity isn\'t fully built until complete</li>'
    +'<li>Rabies vaccination is legally required in most states/countries</li>'
    +'</ul></div>'
    +'<button onclick="window.print()" class="ht-print-btn">📥 Print Vaccine Record</button>'
    +'</div>';
}
</script>
<?php get_footer(); ?>
