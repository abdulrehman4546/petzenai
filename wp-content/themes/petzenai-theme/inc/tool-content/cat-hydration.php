<?php
/**
 * Tool-specific content for: Cat Hydration / Cat Water Intake Calculator (registry key: cat_hydration_calc).
 * The calculation lives in pzCalcCatHydration() in templates/pages/auto-tool.php.
 *
 * Figures: about 50 ml of water per kg of body weight a day in total (the "3.5–4.5 oz per 5 lb" rule found in
 * many cat-care references works out to the same thing), shown as a ±10% range. Wet food is taken as ~78% water
 * and dry food as ~10%. Drinking more than about 100 ml/kg a day is the usual definition of excessive thirst.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_cat_hydration_calc() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> A healthy cat needs roughly <strong>50 ml of water per kg of body weight a day</strong> (about 3.5–4.5 fl oz per 5 lb), counting the water in her food. For a 10 lb (4.5 kg) cat that is about <strong>200–250 ml (7–8.5 fl oz)</strong>. A cat on wet food gets much of this from her meals and may drink very little; a cat on dry food has to drink nearly all of it. Enter your cat’s weight and diet to see her numbers.</div>
<?php }

function pz_hero_trust_cat_hydration_calc() { ?>
      <span>✅ Counts water in wet and dry food</span>
      <span>✅ ml, fl oz and cups</span>
      <span>✅ Shows when thirst is too high</span>
<?php }

function pz_methodology_heading_cat_hydration_calc() { return 'How Your Cat’s Water Needs Are Worked Out'; }

function pz_methodology_cat_hydration_calc() { ?>
    <p style="color:#555;margin-bottom:20px">The calculator starts from your cat’s total daily water need, then subtracts the water she already gets from her food. What is left is roughly what she should drink from her bowl or fountain. All figures are averages, so the result is shown as a range.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">💧</div>
        <strong>Total water need</strong>
        <p>About 50 ml per kg of body weight per day (roughly 1 fl oz per 2.5 lb). The tool shows ±10% around that figure, because cats vary.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🥫</div>
        <strong>Water from wet food</strong>
        <p>Wet food is about 75–80% water. A 3 oz (85 g) can holds about 65 ml of water and a 5.5 oz (156 g) can about 120 ml, so wet-fed cats drink much less.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🍚</div>
        <strong>Water from dry food</strong>
        <p>Dry food is only about 10% water, so a cup of kibble adds roughly 10 ml. A cat on an all-dry diet has to drink almost all of her water.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">⚠️</div>
        <strong>The “too much” line</strong>
        <p>Drinking more than about 100 ml per kg a day is generally considered excessive thirst in cats. The tool shows that amount for your cat so you know when to call the vet.</p>
      </div>
    </div>
    <table class="pz-breed-table" style="margin-top:20px">
      <thead><tr><th>Cat weight</th><th>Total water per day</th><th>Excessive if drinking over</th></tr></thead>
      <tbody>
        <tr><td>5 lb (2.3 kg)</td><td>about 100–125 ml (3.5–4 fl oz)</td><td>about 230 ml</td></tr>
        <tr><td>8 lb (3.6 kg)</td><td>about 165–200 ml (5.5–7 fl oz)</td><td>about 360 ml</td></tr>
        <tr><td>10 lb (4.5 kg)</td><td>about 205–250 ml (7–8.5 fl oz)</td><td>about 455 ml</td></tr>
        <tr><td>12 lb (5.4 kg)</td><td>about 245–300 ml (8.5–10 fl oz)</td><td>about 545 ml</td></tr>
        <tr><td>15 lb (6.8 kg)</td><td>about 305–375 ml (10.5–12.5 fl oz)</td><td>about 680 ml</td></tr>
      </tbody>
    </table>
<?php }

function pz_faq_cat_hydration_calc() {
    return [
        ['How much water should a cat drink a day?', 'A healthy adult cat needs about 50 ml of water per kg of body weight a day in total, which is roughly 3.5–4.5 fl oz for every 5 lb. That total includes the water in her food. A 10 lb cat needs around 200–250 ml a day. How much of that she drinks from a bowl depends mostly on whether she eats wet or dry food.'],
        ['My cat eats wet food and hardly drinks. Is that normal?', 'Usually, yes. Wet food is about 75–80% water, so a cat eating two or three cans a day can get half or more of her water from meals and may rarely visit the bowl. As long as she is eating well, urinating normally and her gums feel moist, light drinking on a wet diet is expected.'],
        ['How can I tell if my cat is dehydrated?', 'Common signs are sticky or dry gums, sunken eyes, lethargy, a poor appetite and skin that is slow to fall back when you gently lift it at the shoulders. Dehydration is often a sign of another problem, such as vomiting, diarrhoea or kidney disease, so a cat that seems dehydrated should see a vet promptly.'],
        ['How do I know if my cat is drinking too much?', 'Drinking more than about 100 ml per kg a day (around 450 ml for a 10 lb cat) is generally considered excessive. You may also notice bigger clumps in the litter box, an emptier bowl than usual or your cat drinking from taps and glasses. Increased thirst can point to kidney disease, diabetes or an overactive thyroid, so it is worth a vet check rather than waiting.'],
        ['How can I measure how much my cat drinks?', 'Fill the bowl with a measured amount, for example 500 ml from a measuring jug, and measure what is left 24 hours later. Put out a second bowl of the same water in another room to see how much simply evaporates, and subtract it. Repeat over two or three days and take the average. In multi-cat homes this only gives a household total.'],
        ['Do water fountains help cats drink more?', 'Some cats do drink more from moving water, and many owners find fountains helpful, but not every cat cares. Wide, shallow bowls that do not touch her whiskers, fresh water every day and several water stations around the home also help. Adding wet food is one of the most reliable ways to raise a cat’s total water intake.'],
        ['Can I add water to my cat’s food?', 'Yes. Adding a little water or low-sodium, onion-free broth made for cats to wet food is a simple way to increase intake. Add it gradually so she accepts the texture, and do not leave watered-down food out for hours, because it spoils faster.'],
        ['Do kittens and senior cats need different amounts?', 'Kittens need more water per kg than adults because they are growing and very active, and nursing mothers need much more again. Older cats are prone to kidney disease and can become dehydrated more easily. For both, watch for changes and ask your vet if their drinking or urination changes noticeably.'],
    ];
}

function pz_what_is_cat_hydration_calc() {
    ob_start(); ?>
    <p>The Cat Water Intake Calculator estimates how much water your cat needs each day and how much of it she should be drinking, as opposed to getting from her food. It uses her body weight and what she eats, because a cat on wet food and a cat on dry food can have very different drinking habits while both being well hydrated.</p>
    <p>You get her total daily water need, the water her food already provides, the amount left for her bowl in millilitres, fluid ounces and cups, and the level above which her drinking would count as excessive. Those two numbers give you a normal range to compare with what you actually see.</p>
    <p>It is an estimate for healthy cats. Hot weather, nursing, illness and some medicines all change water needs, and a sudden change in thirst is more important than any single number.</p>
    <?php return ob_get_clean();
}

function pz_why_important_cat_hydration_calc() {
    ob_start(); ?>
    <p>Cats descend from desert animals that got most of their water from prey, and many have a weak drive to drink. That makes water intake one of the easiest things to overlook, and one of the most useful early clues to health problems.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🚽</span>
        <div>
          <strong>Urinary health</strong>
          <p>Cats that take in little water produce concentrated urine, which is linked to bladder inflammation and urinary crystals. More water usually means more dilute urine.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🫘</span>
        <div>
          <strong>Kidney disease</strong>
          <p>Chronic kidney disease is common in older cats, and drinking more than usual is often one of the first signs owners notice.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🩸</span>
        <div>
          <strong>Diabetes and thyroid problems</strong>
          <p>Increased thirst and urination are also typical early signs of diabetes and hyperthyroidism, which are easier to manage when caught early.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">📏</span>
        <div>
          <strong>A baseline to compare against</strong>
          <p>Knowing her normal range lets you spot a real change instead of guessing, and gives your vet useful numbers at a checkup.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_cat_hydration_calc() {
    return [
        ['title' => 'Weigh your cat', 'desc' => 'Use a pet or baby scale, or weigh yourself holding her and subtract your own weight. Water needs scale with her weight.'],
        ['title' => 'Choose her diet', 'desc' => 'All dry, all wet, or a mix. This makes the biggest difference to how much she needs to drink.'],
        ['title' => 'Enter how much wet and dry food she eats', 'desc' => 'Count cans (and pick the can size) and cups of kibble per day. Rough amounts are fine.'],
        ['title' => 'Read the bowl target and the “too much” line', 'desc' => 'The first is roughly what she should drink. The second is the amount above which you should talk to your vet.'],
        ['title' => 'Measure her real intake for a few days', 'desc' => 'Fill the bowl with a measured amount and check what is left after 24 hours, allowing for evaporation. Compare the average with the result.'],
    ];
}

function pz_tips_cat_hydration_calc() {
    return [
        ['Add wet food', 'Even one can a day adds around 65–120 ml of water. It is one of the most reliable ways to raise a cat’s water intake.'],
        ['Use wide, shallow bowls', 'Many cats dislike their whiskers touching the sides of a deep bowl. Glass, ceramic or stainless steel are easy to keep clean.'],
        ['Keep water away from food and litter', 'Cats often prefer water that is not right next to their food, and never near the litter box.'],
        ['Offer several water stations', 'A bowl on each floor, or in each room she uses, makes drinking easy, especially for older cats with stiff joints.'],
        ['Refresh daily', 'Change the water at least once a day and wash the bowl often. Clean a fountain and replace its filter as the maker recommends.'],
        ['Measure, don’t guess', 'A measuring jug and a few days of notes tell you far more than a glance at the bowl.'],
    ];
}

function pz_mistakes_cat_hydration_calc() {
    return [
        ['❌ Worrying that a wet-fed cat rarely drinks', 'If most of her diet is wet food, she may need very little from the bowl. Check the food water before assuming she is dehydrated.'],
        ['❌ Assuming “drinks a lot” means “healthy”', 'A cat that suddenly drinks much more than usual may be unwell. Increased thirst is a classic early sign of kidney disease, diabetes and hyperthyroidism.'],
        ['❌ Feeding only dry food to a cat that barely drinks', 'An all-dry diet with low drinking can leave urine very concentrated. Adding wet food or water to meals often helps.'],
        ['❌ Giving milk instead of water', 'Many adult cats are lactose-intolerant, and milk can cause diarrhoea, which makes dehydration worse. Water is all she needs.'],
        ['❌ Forgetting evaporation when measuring', 'In warm, dry rooms a bowl can lose a noticeable amount on its own. Use a second, untouched bowl as a control.'],
    ];
}

function pz_render_calc_cat_hydration_calc( $tool ) {
    $icon = $tool['icon'] ?? '💧';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Cat Water Intake Calculator</div>
          <div class="pz-int-sublabel">Daily water need, water from food, and how much she should drink</div>
        </div>
      </div>
      <div class="pz-int-badges">
        <span class="pz-int-badge pz-int-badge--green">✅ No Sign-Up</span>
        <span class="pz-int-badge pz-int-badge--blue">💧 ml, fl oz &amp; cups</span>
      </div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt" for="pz_hy_weight">Weight
            <span class="pz-int-unit-toggle">
              <button type="button" class="pz-unit-btn active" onclick="pzSetUnit('lbs',this)">lbs</button>
              <button type="button" class="pz-unit-btn" onclick="pzSetUnit('kg',this)">kg</button>
            </span>
          </label>
          <div class="pz-int-input-wrap">
            <input type="number" id="pz_hy_weight" class="pz-int-input" placeholder="e.g. 10" min="0.2" max="40" step="0.1">
            <span class="pz-int-input-suffix" id="pz-unit-label">lbs</span>
          </div>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt" for="pz_hy_diet">Diet</label>
          <select id="pz_hy_diet" class="pz-int-select" onchange="pzCatHydDiet()">
            <option value="dry" selected>Dry food only</option>
            <option value="mix">Mix of wet and dry</option>
            <option value="wet">Wet food only</option>
          </select>
        </div>
        <div class="pz-int-field" id="pz_hy_wet_wrap" style="display:none">
          <label class="pz-int-label-txt" for="pz_hy_cans">Cans of wet food per day</label>
          <div class="pz-int-input-wrap">
            <input type="number" id="pz_hy_cans" class="pz-int-input" value="1" min="0" max="8" step="0.25">
            <select id="pz_hy_can_size" class="pz-int-select" style="max-width:110px">
              <option value="85" selected>3 oz cans</option>
              <option value="156">5.5 oz cans</option>
            </select>
          </div>
        </div>
        <div class="pz-int-field" id="pz_hy_dry_wrap">
          <label class="pz-int-label-txt" for="pz_hy_cups">Cups of dry food per day</label>
          <input type="number" id="pz_hy_cups" class="pz-int-input" value="0.5" min="0" max="3" step="0.05">
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt" for="pz_hy_cond">Anything that raises her needs?</label>
          <select id="pz_hy_cond" class="pz-int-select">
            <option value="none" selected>No, normal indoor life</option>
            <option value="hot">Hot weather or very active</option>
            <option value="nursing">Nursing kittens</option>
          </select>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzCalcCatHydration()">
        <span class="pz-int-btn-icon"><?php echo $icon; ?></span>
        Calculate Water Needs
      </button>
      <div id="pz-calc-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}
