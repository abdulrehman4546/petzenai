<?php /** Template Name: 🏃 Hero Tool — Exercise Calculator */ if(!defined('ABSPATH')) exit; get_header(); ?>
<style><?php include get_template_directory().'/templates/pages/hero-tool-shared.css.php'; ?></style>
<main class="ht-page">
<?php include get_template_directory().'/templates/pages/hero-tool-breadcrumb.php'; ?>
<section class="ht-hero" style="background:linear-gradient(135deg,#0D0D1A,#0a2a1a)">
  <span class="ht-hero-icon">🏃</span>
  <h1>Pet Exercise <span>Calculator</span></h1>
  <p>Discover exactly how much daily exercise your pet needs based on breed, age, weight, and health status.</p>
  <div class="ht-badges"><span class="ht-badge green">✅ Vet Reviewed</span><span class="ht-badge blue">🐕 Breed-Specific</span><span class="ht-badge orange">⚡ Instant</span></div>
</section>
<div class="ht-main">
  <div class="ht-tool-wrap">
    <div class="ht-tool-header"><h2>🏃 Calculate Daily Exercise Needs</h2><p>Personalized activity plan for your pet</p></div>
    <div class="ht-grid">
      <div class="ht-field"><label>Pet Type</label>
        <select id="ht_species" class="ht-select"><option value="dog">🐕 Dog</option><option value="cat">🐱 Cat</option></select>
      </div>
      <div class="ht-field"><label>Breed Energy Level</label>
        <select id="ht_breed_energy" class="ht-select">
          <option value="low">Low Energy (Basset, Bulldog)</option>
          <option value="medium" selected>Medium Energy (Lab, Beagle)</option>
          <option value="high">High Energy (Border Collie, Husky)</option>
          <option value="very_high">Very High (Jack Russell, Vizsla)</option>
        </select>
      </div>
      <div class="ht-field"><label>Age</label>
        <div class="ht-chips"><button class="ht-chip" data-val="puppy" onclick="htChip(this,'age_stage')">Puppy</button><button class="ht-chip active" data-val="adult" onclick="htChip(this,'age_stage')">Adult</button><button class="ht-chip" data-val="senior" onclick="htChip(this,'age_stage')">Senior</button></div>
        <input type="hidden" id="ht_age_stage" value="adult">
      </div>
      <div class="ht-field"><label>Health Status</label>
        <select id="ht_health" class="ht-select"><option value="healthy">✅ Healthy</option><option value="overweight">⚖️ Overweight</option><option value="joint">🦴 Joint Issues</option><option value="recovering">💊 Recovering from Illness</option></select>
      </div>
    </div>
    <button class="ht-btn" onclick="htCalcExercise()">🏃 Get Exercise Plan — Free</button>
    <div id="ht-result" style="display:none"></div>
  </div>
  <div class="ht-info-wrap">
    <div class="ht-info-card"><h3>⚠️ Under vs Over Exercise</h3><ul>
      <li><strong>Too little:</strong> Obesity, boredom, destructive behavior</li>
      <li><strong>Too much:</strong> Joint damage, exhaustion, injury</li>
      <li>Puppies need short, frequent sessions — not long runs</li>
    </ul></div>
    <div class="ht-info-card"><h3>🎯 Exercise Types</h3><ul>
      <li><strong>Walking:</strong> Best for all fitness levels</li>
      <li><strong>Fetch/Play:</strong> Mental + physical stimulation</li>
      <li><strong>Swimming:</strong> Great for joint issues</li>
      <li><strong>Mental exercise:</strong> Puzzle toys count!</li>
    </ul></div>
    <div class="ht-related"><h3>🔗 Related Tools</h3>
      <a href="<?php echo home_url('/tools/pet-food-portion-calculator/'); ?>" class="ht-rel-link">🍽️ Food Portion Calculator →</a>
      <a href="<?php echo home_url('/tools/pet-age-calculator/'); ?>" class="ht-rel-link">🎂 Pet Age Calculator →</a>
    </div>
  </div>
</div>
<script>
function htChip(el,field){el.closest('.ht-chips').querySelectorAll('.ht-chip').forEach(function(c){c.classList.remove('active')});el.classList.add('active');var inp=document.getElementById('ht_'+field);if(inp)inp.value=el.dataset.val;}
function htCalcExercise(){
  var energy=document.getElementById('ht_breed_energy').value;
  var stage=document.getElementById('ht_age_stage').value;
  var health=document.getElementById('ht_health').value;
  var species=document.getElementById('ht_species').value;
  var res=document.getElementById('ht-result');
  var base={low:30,medium:60,high:90,very_high:120}[energy]||60;
  var sm={puppy:0.5,adult:1,senior:0.7}[stage]||1;
  var hm={healthy:1,overweight:0.8,joint:0.6,recovering:0.3}[health]||1;
  if(species==='cat') base=20;
  var mins=Math.round(base*sm*hm);
  var walks=health==='recovering'?1:stage==='puppy'?3:2;
  var activities=species==='dog'?['Daily walks ('+Math.round(mins/walks)+' min each)','Off-leash play in yard or park','Fetch or tug-of-war games','Mental stimulation with puzzle toys','Socialization with other dogs']
    :['Interactive play sessions with wand toys','Window perches for mental stimulation','Puzzle feeders for mental exercise','Climbing trees/cat towers','Laser pointer sessions (5 min max)'];
  var actHtml=activities.slice(0,4).map(function(a){return '<li>'+a+'</li>';}).join('');
  res.style.display='block';
  res.innerHTML='<div class="ht-result-box">'
    +'<div class="ht-result-top" style="background:linear-gradient(135deg,#1B5E20,#2E7D32)">'
    +'<div style="font-size:13px;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px">Daily Exercise Recommendation</div>'
    +'<div class="ht-result-num">'+mins+'<span class="ht-result-unit"> min/day</span></div>'
    +'<div class="ht-result-label">'+walks+' session'+(walks>1?'s':'')+' recommended</div>'
    +'</div>'
    +'<div class="ht-result-cells">'
    +'<div class="ht-cell"><div class="ht-cell-n">'+mins+'</div><div class="ht-cell-l">Min/Day</div></div>'
    +'<div class="ht-cell"><div class="ht-cell-n">'+walks+'x</div><div class="ht-cell-l">Sessions</div></div>'
    +'<div class="ht-cell"><div class="ht-cell-n">'+Math.round(mins/walks)+'</div><div class="ht-cell-l">Min/Session</div></div>'
    +'<div class="ht-cell"><div class="ht-cell-n">'+Math.round(mins*7/60)+'h</div><div class="ht-cell-l">Per Week</div></div>'
    +'</div>'
    +'<div class="ht-result-tips"><h4>📋 Recommended Activities</h4><ul>'+actHtml+'</ul></div>'
    +'<button onclick="window.print()" class="ht-print-btn">📥 Save Exercise Plan</button>'
    +'</div>';
}
</script>
<?php get_footer(); ?>
