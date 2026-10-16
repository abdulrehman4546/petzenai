<?php
/**
 * Tool-specific content for: Cat Daily Calorie Calculator (registry key: cat_calorie_calc).
 * Hook names follow the renderer's convention: pz_<section>_<calc key>().
 * The calculation itself lives in pzCalcCatCalorie() in templates/pages/auto-tool.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_cat_calorie_calc() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> A typical 10 lb (4.5 kg) neutered adult cat needs roughly <strong>215–260 calories a day</strong>, which is 1.0–1.2× her Resting Energy Requirement (RER) depending on how active she is. Kittens need about twice that per pound, and cats on a weight-loss plan need less. Enter your cat’s details to get a range for her.</div>
<?php }

function pz_hero_trust_cat_calorie_calc() { ?>
      <span>✅ Standard RER formula</span>
      <span>✅ Kitten, adult &amp; senior</span>
      <span>✅ Cups or cans per day</span>
<?php }

function pz_methodology_heading_cat_calorie_calc() { return 'How Your Cat’s Calorie Target Is Calculated'; }

function pz_methodology_cat_calorie_calc() { ?>
    <p style="color:#555;margin-bottom:20px">The calculator uses the Resting Energy Requirement formula that veterinary nutrition guidelines use for cats, then multiplies it by a factor for life stage, neuter status and activity. The result is shown as a range (±10%) because no formula can know your individual cat’s metabolism.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🔥</div>
        <strong>Resting Energy Requirement (RER)</strong>
        <p>RER = 70 × (body weight in kg)<sup>0.75</sup>. It is the energy a cat uses at complete rest. A 4.5 kg (10 lb) cat has an RER of about 218 kcal.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🐱</div>
        <strong>Life-stage factor</strong>
        <p>Kittens under 4 months use about 2.5× RER and kittens of 4–12 months about 2.0×, because they are growing. Healthy adults sit near 1.0–1.6×, and most seniors near 1.1×.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">✂️</div>
        <strong>Neuter status and activity</strong>
        <p>Neutered adults commonly use about 1.2× RER and intact adults about 1.4×. A mostly sleepy indoor cat can sit at 1.0×, while a very active cat can reach 1.6×.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">⚖️</div>
        <strong>Weight-loss plans</strong>
        <p>For gentle weight loss the tool applies 0.8× RER. It is a starting point only. Rapid loss is risky in cats, so a vet should set the target weight and the pace.</p>
      </div>
    </div>
    <table class="pz-breed-table" style="margin-top:20px">
      <thead><tr><th>Cat</th><th>Multiplier × RER</th><th>Example: 4.5 kg cat</th></tr></thead>
      <tbody>
        <tr><td>Kitten, under 4 months</td><td>2.5</td><td>about 545 kcal</td></tr>
        <tr><td>Kitten, 4–12 months</td><td>2.0</td><td>about 435 kcal</td></tr>
        <tr><td>Neutered adult, normal activity</td><td>1.2</td><td>about 260 kcal</td></tr>
        <tr><td>Neutered adult, inactive indoor</td><td>1.0</td><td>about 218 kcal</td></tr>
        <tr><td>Intact adult, normal activity</td><td>1.4</td><td>about 305 kcal</td></tr>
        <tr><td>Active adult</td><td>1.6</td><td>about 350 kcal</td></tr>
        <tr><td>Weight-loss plan</td><td>0.8</td><td>about 175 kcal</td></tr>
      </tbody>
    </table>
<?php }

function pz_faq_cat_calorie_calc() {
    return [
        ['How many calories does my cat need per day?', 'Most healthy adult cats need roughly 20 to 30 calories per pound (45–65 per kg) of body weight each day, which equals about 1.0 to 1.4 times their Resting Energy Requirement. A neutered indoor cat is usually at the lower end. The calculator above works out a range for your cat from her weight, age, neuter status and activity.'],
        ['How much dry or wet food is that in cups or cans?', 'Divide the daily calories by the calories in one cup (dry) or one can (wet), which are printed on the label. A typical dry food has 300–450 kcal per cup and a 3 oz can of wet food 60–100 kcal, but brands vary a lot, so the calculator lets you enter your own food’s number. Scoops and cups are not precise, so a kitchen scale and the kcal per gram on the label is more accurate.'],
        ['Is the calorie count the same for wet and dry food?', 'Calories are calories, but the amount of food differs. Wet food is mostly water, so you feed more by volume and weight to reach the same calories. Check the kcal on each label instead of assuming wet is lower or higher. If you feed both, add up the calories from each.'],
        ['How many calories does a kitten need?', 'A growing kitten needs much more per pound than an adult: about 2.5 times her RER until about 4 months and about 2 times until she is a year old. Kittens should eat a food made for growth and be fed several small meals a day. Weigh her weekly and ask your vet whether her growth looks right.'],
        ['Do senior cats need fewer calories?', 'It depends. Some cats slow down and gain weight in middle age, so they need fewer calories. Many cats over about 11–12 years old do the opposite: they lose weight and muscle and may need more. If an older cat is losing weight without a diet, see a vet, because it can point to a health problem.'],
        ['My cat is overweight. How much should I cut back?', 'A common starting point is about 80% of her RER, but the right target depends on her ideal weight, which your vet can estimate. Aim to lose roughly 0.5–2% of her body weight a week. Cutting too fast is dangerous in cats and can lead to a serious liver condition, so do not crash-diet and talk to your vet first.'],
        ['Should I leave food out all day (free feeding)?', 'Free feeding makes calories hard to track and is linked to weight gain in many indoor cats. Measured meals, two to four a day, let you see exactly what she eats and notice early if her appetite changes. In homes with several cats, feed them separately so each cat eats only her own portion.'],
        ['How many calories can come from treats?', 'A widely used guideline is that treats should be no more than about 10% of the day’s calories. The calculator shows what that is for your cat. Count the treats toward the total and reduce her meals a little instead of adding treats on top.'],
        ['How often should I recalculate?', 'Check every month for kittens and every few months for adults, and any time her weight, activity or neuter status changes. Weigh her on the same scale, and adjust the amount by about 10% at a time if she is gaining or losing when she should not be.'],
    ];
}

function pz_what_is_cat_calorie_calc() {
    ob_start(); ?>
    <p>The Cat Daily Calorie Calculator estimates how many calories your cat needs each day. It starts from the Resting Energy Requirement, 70 × (weight in kg)<sup>0.75</sup>, and multiplies it by a factor for her life stage, neuter status, activity level and whether she is on a weight-loss plan.</p>
    <p>It then turns the calories into something you can scoop or open: cups of dry food or cans of wet food, split into sensible meals, plus a treat allowance of about 10%. Because it works from your cat’s own numbers, the answer is more useful than the generic chart on a food bag.</p>
    <p>The result is an estimate, not a prescription. Cats vary, so use it as a starting point and adjust by watching her weight and body shape over a few weeks.</p>
    <?php return ob_get_clean();
}

function pz_why_important_cat_calorie_calc() {
    ob_start(); ?>
    <p>Indoor cats burn few calories, and it takes very little extra food to add weight. Getting the daily amount close to right is one of the simplest things you can do for her long-term health.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">⚖️</span>
        <div>
          <strong>Obesity is common in cats</strong>
          <p>Surveys such as those by the Association for Pet Obesity Prevention regularly find that more than half of pet cats in the US are overweight or obese. Extra weight is linked to diabetes, joint pain and a shorter, less comfortable life.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🍽️</span>
        <div>
          <strong>Food bags run generous</strong>
          <p>Feeding guides on food packaging are written to cover many cats, and many neutered indoor cats need less than the chart suggests. Starting from her own calories avoids a slow, hidden overfeed.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🍼</span>
        <div>
          <strong>Kittens and seniors are different</strong>
          <p>A growing kitten needs far more per pound than an adult, and some older cats need more again. One flat number for every age does not work.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🩺</span>
        <div>
          <strong>A shared starting point with your vet</strong>
          <p>The RER method is the same one used in veterinary nutrition guidelines, so the number is easy to discuss at a checkup and adjust to her needs.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_cat_calorie_calc() {
    return [
        ['title' => 'Weigh your cat', 'desc' => 'Use a baby or kitchen scale, or weigh yourself holding her and subtract your own weight. Use the same scale each time so changes are real.'],
        ['title' => 'Pick her life stage', 'desc' => 'Kitten under 4 months, kitten 4–12 months, adult, or senior (11+ years). The factor changes a lot between stages.'],
        ['title' => 'Say whether she is neutered and how active she is', 'desc' => 'Neutered cats use fewer calories than intact cats. Be honest about activity: most indoor cats are “low” or “normal”, not “high”.'],
        ['title' => 'Choose maintain or gentle weight loss', 'desc' => 'Pick weight loss only for an adult or senior cat that is overweight, ideally after a vet has confirmed it.'],
        ['title' => 'Enter your food’s calories', 'desc' => 'Look for “kcal per cup” on dry food or “kcal per can” on wet food. Use the numbers on your own label, since brands differ widely.'],
        ['title' => 'Feed the amount and check in two weeks', 'desc' => 'Reweigh after two weeks. If she is gaining or losing when she should not be, change the daily amount by about 10% and check again.'],
    ];
}

function pz_tips_cat_calorie_calc() {
    return [
        ['Weigh the food, not just the scoop', 'A cup of kibble can vary by 20% or more depending on how you scoop. A cheap kitchen scale and the kcal per gram on the bag give more reliable portions.'],
        ['Split the day into 2–4 meals', 'Smaller meals are closer to how cats naturally eat and make it easy to spot a change in appetite. A puzzle feeder can slow down fast eaters.'],
        ['Run your hands over her ribs', 'You should feel her ribs under a thin layer of fat and see a waist from above. If you cannot feel the ribs, she is probably carrying extra weight.'],
        ['Count treats and toppings', 'Treats, lickable pastes and table scraps all add calories. Keep them near 10% and take that amount out of her meals.'],
        ['Change gradually', 'When you change the amount or switch food, move over several days. Sudden changes upset digestion, and cats can refuse unfamiliar food.'],
        ['Feed multi-cat homes separately', 'Otherwise one cat often eats more and another less than planned, and the numbers here will not match anyone.'],
    ];
}

function pz_mistakes_cat_calorie_calc() {
    return [
        ['❌ Leaving a full bowl out all day', 'It is the most common way indoor cats gain weight, because you cannot see or control how much she really eats.'],
        ['❌ Trusting the feeding chart on the bag as the target', 'Charts are broad and often generous. Treat them as a ceiling to compare against, and start from her calculated calories.'],
        ['❌ Putting an overweight cat on a crash diet', 'Cats that lose weight too fast, or stop eating, can develop a serious liver disease. Weight loss should be slow and supervised by a vet.'],
        ['❌ Assuming every cup of food has the same calories', 'Different foods can differ by more than 100 kcal per cup. Always use the number on the label of the food you actually feed.'],
        ['❌ Forgetting treats and extras', 'A few treats a day can add 10–20% to her calories. Count them in.'],
        ['❌ Ignoring unexplained weight loss', 'If an adult or senior cat is losing weight without a diet, or eating much more or less than usual, see a vet rather than adjusting food yourself.'],
    ];
}

function pz_render_calc_cat_calorie_calc( $tool ) {
    $icon = $tool['icon'] ?? '🔢';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Cat Daily Calorie Calculator</div>
          <div class="pz-int-sublabel">Daily calories, plus cups or cans, for kittens, adults and seniors</div>
        </div>
      </div>
      <div class="pz-int-badges">
        <span class="pz-int-badge pz-int-badge--green">✅ No Sign-Up</span>
        <span class="pz-int-badge pz-int-badge--blue">🔬 RER Formula</span>
      </div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt" for="pz_cat_weight">Weight
            <span class="pz-int-unit-toggle">
              <button type="button" class="pz-unit-btn active" onclick="pzSetUnit('lbs',this)">lbs</button>
              <button type="button" class="pz-unit-btn" onclick="pzSetUnit('kg',this)">kg</button>
            </span>
          </label>
          <div class="pz-int-input-wrap">
            <input type="number" id="pz_cat_weight" class="pz-int-input" placeholder="e.g. 10" min="0.2" max="40" step="0.1">
            <span class="pz-int-input-suffix" id="pz-unit-label">lbs</span>
          </div>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt" for="pz_cat_stage">Life Stage</label>
          <select id="pz_cat_stage" class="pz-int-select">
            <option value="kitten4">Kitten, under 4 months</option>
            <option value="kitten12">Kitten, 4–12 months</option>
            <option value="adult" selected>Adult (1–10 years)</option>
            <option value="senior">Senior (11+ years)</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt" for="pz_cat_neuter">Spayed / Neutered</label>
          <select id="pz_cat_neuter" class="pz-int-select">
            <option value="neutered" selected>Yes, spayed or neutered</option>
            <option value="intact">No, intact</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt" for="pz_cat_activity">Activity Level</label>
          <select id="pz_cat_activity" class="pz-int-select">
            <option value="low">Low: indoor, mostly resting</option>
            <option value="normal" selected>Normal: indoor with regular play</option>
            <option value="high">High: very active or outdoor</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt" for="pz_cat_goal">Goal</label>
          <select id="pz_cat_goal" class="pz-int-select">
            <option value="maintain" selected>Maintain current weight</option>
            <option value="lose">Gentle weight loss (adults and seniors)</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt" for="pz_cat_food">Food</label>
          <select id="pz_cat_food" class="pz-int-select" onchange="pzCatFoodDefault()">
            <option value="dry" selected>Dry food (kcal per cup)</option>
            <option value="wet">Wet food (kcal per 3 oz can)</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt" for="pz_cat_kcal">Calories in your food <span class="pz-int-optional">(see the label)</span></label>
          <input type="number" id="pz_cat_kcal" class="pz-int-input" value="375" min="20" max="900" step="1">
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzCalcCatCalorie()">
        <span class="pz-int-btn-icon"><?php echo $icon; ?></span>
        Calculate My Cat’s Calories
      </button>
      <div id="pz-calc-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}
