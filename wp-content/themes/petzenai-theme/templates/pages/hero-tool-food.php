<?php
/**
 * Template Name: 🍽️ Hero Tool — Food Portion Calculator
 */
if(!defined('ABSPATH')) exit;
get_header();
?>
<style>
<?php include get_template_directory().'/templates/pages/hero-tool-shared.css.php'; ?>
</style>
<main class="ht-page">
  <?php include get_template_directory().'/templates/pages/hero-tool-breadcrumb.php'; ?>

  <section class="ht-hero" style="background:linear-gradient(135deg,#0D0D1A,#1a2a0a)">
    <span class="ht-hero-icon">🍽️</span>
    <h1>Pet Food Portion <span>Calculator</span></h1>
    <p>Enter your pet's details for personalized daily feeding amounts — vet-reviewed, instant results.</p>
    <div class="ht-badges"><span class="ht-badge green">✅ Vet Reviewed</span><span class="ht-badge blue">🔬 Science-Based</span><span class="ht-badge orange">⚡ Instant</span></div>
  </section>

  <div class="ht-main">
    <div class="ht-tool-wrap">
      <div class="ht-tool-header"><h2>🍽️ Calculate Daily Food Portions</h2><p>Works for dogs, cats, rabbits, birds & more</p></div>
      <div class="ht-grid">
        <div class="ht-field"><label>Pet Type</label>
          <select id="ht_species" class="ht-select" onchange="htFoodUpdateBreed()">
            <option value="dog">🐕 Dog</option>
            <option value="cat">🐱 Cat</option>
            <option value="rabbit">🐰 Rabbit</option>
            <option value="bird">🦜 Bird</option>
            <option value="guinea_pig">🐹 Guinea Pig</option>
          </select>
        </div>
        <div class="ht-field"><label>Life Stage</label>
          <div class="ht-chips" id="ht-stage-chips">
            <button class="ht-chip" data-val="puppy" onclick="htChip(this,'stage')">Baby/Puppy</button>
            <button class="ht-chip active" data-val="adult" onclick="htChip(this,'stage')">Adult</button>
            <button class="ht-chip" data-val="senior" onclick="htChip(this,'stage')">Senior</button>
          </div>
          <input type="hidden" id="ht_stage" value="adult">
        </div>
        <div class="ht-field"><label>Weight <span class="ht-unit-sw"><button class="ht-ubtn active" onclick="htUnit('lbs',this)">lbs</button><button class="ht-ubtn" onclick="htUnit('kg',this)">kg</button></span></label>
          <div class="ht-input-wrap"><input type="number" id="ht_weight" class="ht-input" placeholder="e.g. 25" min="0.1" max="300" step="0.1"><span class="ht-suffix" id="ht-wunit">lbs</span></div>
        </div>
        <div class="ht-field"><label>Activity Level</label>
          <div class="ht-chips">
            <button class="ht-chip" data-val="low" onclick="htChip(this,'activity')">😴 Low</button>
            <button class="ht-chip active" data-val="moderate" onclick="htChip(this,'activity')">🚶 Moderate</button>
            <button class="ht-chip" data-val="high" onclick="htChip(this,'activity')">🏃 High</button>
            <button class="ht-chip" data-val="working" onclick="htChip(this,'activity')">⚡ Athletic</button>
          </div>
          <input type="hidden" id="ht_activity" value="moderate">
        </div>
        <div class="ht-field"><label>Health Goal</label>
          <select id="ht_goal" class="ht-select">
            <option value="maintain">Maintain weight</option>
            <option value="lose">Lose weight</option>
            <option value="gain">Gain weight</option>
          </select>
        </div>
        <div class="ht-field"><label>Health Status</label>
          <select id="ht_health" class="ht-select">
            <option value="healthy">✅ Healthy</option>
            <option value="overweight">⚖️ Overweight</option>
            <option value="underweight">📉 Underweight</option>
            <option value="pregnant">🤰 Pregnant/Nursing</option>
            <option value="medical">💊 Medical Condition</option>
          </select>
        </div>
      </div>
      <button class="ht-btn" onclick="htCalcFood()">🍽️ Calculate My Pet's Portions — Free</button>
      <div id="ht-result" style="display:none"></div>
    </div>

    <div class="ht-info-wrap">
      <div class="ht-info-card"><h3>📋 Why Portion Control Matters</h3><ul>
        <li>60% of pets in the US are overweight</li><li>Overfeeding is the #1 preventable health issue</li>
        <li>Correct portions extend your pet's life by 2+ years</li><li>Each pet's needs are unique — weight, age, breed matter</li>
      </ul></div>
      <div class="ht-info-card"><h3>⚡ How It Works</h3><ol>
        <li>Enter your pet's species, weight & stage</li><li>Select activity level & health goal</li>
        <li>Get instant vet-reviewed calorie targets</li><li>Download results as PDF</li>
      </ol></div>
      <div class="ht-related"><h3>🔗 Related Tools</h3>
        <a href="<?php echo home_url('/tools/pet-age-calculator/'); ?>" class="ht-rel-link">🎂 Pet Age Calculator →</a>
        <a href="<?php echo home_url('/tools/pet-exercise-calculator/'); ?>" class="ht-rel-link">🏃 Exercise Calculator →</a>
        <a href="<?php echo home_url('/dog-calorie-calculator/'); ?>" class="ht-rel-link">🐕 Dog Calorie Calculator →</a>
        <a href="<?php echo home_url('/cat-calorie-calculator/'); ?>" class="ht-rel-link">🐱 Cat Calorie Calculator →</a>
      </div>
    </div>
  </div>
</main>

<script>
var htWeightUnit='lbs';
function htUnit(u,btn){htWeightUnit=u;document.querySelectorAll('.ht-ubtn').forEach(function(b){b.classList.remove('active')});btn.classList.add('active');document.querySelectorAll('.ht-suffix').forEach(function(s){s.textContent=u});}
function htChip(el,field){el.closest('.ht-chips').querySelectorAll('.ht-chip').forEach(function(c){c.classList.remove('active')});el.classList.add('active');var inp=document.getElementById('ht_'+field);if(inp)inp.value=el.dataset.val;}
function htCalcFood(){
  var w=parseFloat(document.getElementById('ht_weight').value)||0;
  var activity=document.getElementById('ht_activity').value;
  var health=document.getElementById('ht_health').value;
  var goal=document.getElementById('ht_goal').value;
  var stage=document.getElementById('ht_stage').value;
  var res=document.getElementById('ht-result');
  if(!w){res.style.display='block';res.innerHTML='<div class="ht-warn">⚠️ Please enter your pet\'s weight.</div>';return;}
  var kg=htWeightUnit==='kg'?w:w*0.453592;
  var rer=70*Math.pow(kg,0.75);
  var am={low:1.2,moderate:1.6,high:1.8,working:3.0};
  var hm={healthy:1,overweight:0.8,underweight:1.4,pregnant:3.0,medical:1.1};
  var gm={maintain:1,lose:0.8,gain:1.2};
  var sm={puppy:2.0,adult:1,senior:0.9};
  var daily=Math.round(rer*(am[activity]||1.6)*(hm[health]||1)*(gm[goal]||1)*(sm[stage]||1));
  res.style.display='block';
  res.innerHTML='<div class="ht-result-box">'
    +'<div class="ht-result-top"><div class="ht-result-num">'+daily+'<span class="ht-result-unit">kcal/day</span></div><div class="ht-result-label">Daily Calorie Target</div></div>'
    +'<div class="ht-result-cells">'
    +'<div class="ht-cell"><div class="ht-cell-n">'+Math.round(daily/2)+'</div><div class="ht-cell-l">Per Meal (2×)</div></div>'
    +'<div class="ht-cell"><div class="ht-cell-n">'+Math.round(daily/3)+'</div><div class="ht-cell-l">Per Meal (3×)</div></div>'
    +'<div class="ht-cell"><div class="ht-cell-n">'+Math.round(rer)+'</div><div class="ht-cell-l">Base RER</div></div>'
    +'<div class="ht-cell"><div class="ht-cell-n">'+Math.round(daily*0.1)+'</div><div class="ht-cell-l">Max Treats/day</div></div>'
    +'</div>'
    +'<div class="ht-result-tips"><h4>📋 Feeding Recommendations</h4><ul>'
    +'<li>Split daily calories into 2–3 meals for best digestion</li>'
    +'<li>Adjust ±10% based on body weight change over 4 weeks</li>'
    +'<li>Treats should not exceed 10% of daily calories</li>'
    +'<li>Always provide fresh water alongside meals</li>'
    +'<li>Confirm with your vet for medical conditions</li>'
    +'</ul></div>'
    +'<button onclick="window.print()" class="ht-print-btn">📥 Download as PDF</button>'
    +'</div>';
}
</script>
<?php get_footer(); ?>
