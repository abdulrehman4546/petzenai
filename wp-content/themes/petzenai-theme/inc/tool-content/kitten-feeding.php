<?php
/**
 * Tool-specific content for: Kitten Feeding Guide (registry key: kitten_feeding, type 'guide').
 * The calculation lives in pzGenKittenFeeding() in templates/pages/auto-tool.php.
 *
 * Figures and sources:
 * - RER = 70 × kg^0.75. Growing kittens about 2.5 × RER (Merck Veterinary Manual maintenance-energy table;
 *   AAFP gives 2–2.5 × RER for growth). Kept consistent with the Cat Daily Calorie Calculator:
 *   2.5 × RER under 4 months, 2.0 × RER from 4 to 12 months.
 * - Meals: Merck, 3–4 a day under 4 months; International Cat Care, at least 4 a day at 8–12 weeks, at least 3
 *   at 3–6 months and at least 2 after 6 months; Cornell Feline Health Center, 3 meals until 6 months, then twice daily.
 * - Bottle-fed kittens (International Cat Care, hand-rearing): about 10 feeds a day every 2–2.5 h in weeks 0–2,
 *   about 7 a day every 2.5–3.5 h in weeks 2–4, about 5 a day at 4–5 weeks. Never cow's or goat's milk.
 * - Weaning starts at 3–4 weeks and is usually finished by about 8 weeks (International Cat Care).
 * - Kitten food until adulthood at about 9–12 months (Merck); adult at about one year (Cornell).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_kitten_feeding() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Kittens need small, frequent meals of a complete kitten food: about <strong>4 meals a day at 2–4 months</strong>, <strong>3 a day at 4–6 months</strong> and <strong>2–3 a day from 6 to 12 months</strong>. A growing kitten needs about 2–2.5 times her resting energy requirement, roughly twice what an adult cat of the same weight eats, so a 4 lb kitten under 4 months needs around <strong>275 calories a day</strong>. Kittens under 4 weeks need a kitten milk replacer, never cow’s milk. Enter your kitten’s age and weight to get her numbers.</div>
<?php }

function pz_hero_trust_kitten_feeding() { ?>
      <span>✅ Feeding schedule by age</span>
      <span>✅ Daily calories, cans and cups</span>
      <span>✅ Bottle-feeding and weaning notes</span>
<?php }

function pz_methodology_heading_kitten_feeding() { return 'Kitten Feeding Chart by Age: How Much and How Often'; }

function pz_methodology_kitten_feeding() { ?>
    <p style="color:#555;margin-bottom:20px">The guide works in two steps. First it uses your kitten’s age to set how often she should eat and what kind of food suits her. Then, for kittens on solid food, it uses her weight to estimate her daily calories and turns them into cans or cups using the numbers on your food’s label. Every kitten grows at her own pace, so the calories are shown as a range.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🔥</div>
        <strong>Resting Energy Requirement (RER)</strong>
        <p>RER = 70 × (body weight in kg)<sup>0.75</sup>, the same formula veterinary nutrition guidelines use for adult cats. A 2 lb (0.9 kg) kitten has an RER of about 65 kcal.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">📈</div>
        <strong>Growth factor</strong>
        <p>Growing kittens need about 2–2.5 × RER. The guide uses 2.5 × RER under 4 months, when growth is fastest, and 2.0 × RER from 4 to 12 months, matching our Cat Daily Calorie Calculator.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🍽️</div>
        <strong>Meals by age</strong>
        <p>Kittens have small stomachs, so they eat little and often. The number of meals falls as they grow: about four a day at 2–4 months, three at 4–6 months and two or three after that.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🍼</div>
        <strong>Under 4 weeks: milk only</strong>
        <p>Very young kittens drink their mother’s milk or a kitten milk replacer. The guide shows a feeding schedule for them, not calories or solid food, because formula amounts depend on the product and should follow its label and your vet.</p>
      </div>
    </div>
    <h3 style="margin-top:24px">Kitten feeding schedule by age</h3>
    <table class="pz-breed-table" style="margin-top:12px">
      <thead><tr><th>Age</th><th>What she eats</th><th>How often</th></tr></thead>
      <tbody>
        <tr><td>0–2 weeks</td><td>Mother’s milk, or kitten milk replacer by bottle</td><td>About 10 feeds a day, every 2–2½ hours, day and night</td></tr>
        <tr><td>2–4 weeks</td><td>Mother’s milk, or kitten milk replacer by bottle</td><td>About 7 feeds a day, every 2½–3½ hours</td></tr>
        <tr><td>4–8 weeks</td><td>Weaning: milk plus wet kitten food, softened at first</td><td>About 4–5 meals a day; many kittens do well with food always available</td></tr>
        <tr><td>2–4 months</td><td>Complete kitten food, wet, dry or both</td><td>About 4 meals a day</td></tr>
        <tr><td>4–6 months</td><td>Complete kitten food</td><td>About 3 meals a day</td></tr>
        <tr><td>6–12 months</td><td>Complete kitten food</td><td>2–3 meals a day</td></tr>
        <tr><td>About 12 months</td><td>Switch gradually to adult cat food</td><td>2 meals a day, or more smaller ones</td></tr>
      </tbody>
    </table>
    <h3 style="margin-top:24px">How many calories a kitten needs by weight</h3>
    <table class="pz-breed-table" style="margin-top:12px">
      <thead><tr><th>Kitten weight</th><th>Under 4 months (2.5 × RER)</th><th>4–12 months (2.0 × RER)</th></tr></thead>
      <tbody>
        <tr><td>1 lb (0.45 kg)</td><td>about 95 kcal</td><td>about 75 kcal</td></tr>
        <tr><td>2 lb (0.9 kg)</td><td>about 165 kcal</td><td>about 130 kcal</td></tr>
        <tr><td>3 lb (1.4 kg)</td><td>about 220 kcal</td><td>about 175 kcal</td></tr>
        <tr><td>4 lb (1.8 kg)</td><td>about 275 kcal</td><td>about 220 kcal</td></tr>
        <tr><td>5 lb (2.3 kg)</td><td>about 325 kcal</td><td>about 260 kcal</td></tr>
        <tr><td>6 lb (2.7 kg)</td><td>about 370 kcal</td><td>about 295 kcal</td></tr>
        <tr><td>8 lb (3.6 kg)</td><td>about 460 kcal</td><td>about 370 kcal</td></tr>
      </tbody>
    </table>
    <p style="color:#555;margin-top:12px">To turn calories into food, divide by the kcal per can or per cup printed on your kitten food. The calculator does this for you.</p>
<?php }

function pz_faq_kitten_feeding() {
    return [
        ['How much should I feed my kitten?', 'It depends on her weight and age. A growing kitten needs roughly twice the calories of an adult cat of the same weight: about 2.5 × her Resting Energy Requirement until 4 months and about 2 × until she is a year old. For a 4 lb kitten under 4 months that is about 275 kcal a day. Divide that by the kcal per can or cup on your food’s label, or use the calculator above to do it for you.'],
        ['How often should I feed a kitten?', 'Little and often. Kittens of 2–4 months usually need about four meals a day, kittens of 4–6 months about three, and kittens of 6–12 months two or three. Bottle-fed kittens under 2 weeks need feeding about every 2–2½ hours, day and night, and kittens of 2–4 weeks about every 2½–3½ hours.'],
        ['What does a kitten feeding chart by age look like?', 'Under 4 weeks: mother’s milk or kitten milk replacer only. 4–8 weeks: weaning onto wet kitten food alongside milk, about 4–5 meals a day. 2–4 months: complete kitten food, about 4 meals. 4–6 months: about 3 meals. 6–12 months: 2–3 meals. Around 12 months: a gradual switch to adult food. The full chart is in the section above.'],
        ['Should I feed my kitten wet or dry food?', 'Either can work, as long as it is a complete food made for kittens. Wet food is usually the easiest first food during weaning, and offering both textures while she is young can help her accept different foods later in life. If you feed both, split her daily calories between them so the total does not creep up.'],
        ['Can kittens drink milk?', 'Kittens should drink their mother’s milk, or a kitten milk replacer if they have no mother. Never give a kitten cow’s or goat’s milk: it does not have the right balance of protein and fat for kittens and can upset their stomachs. Once a kitten is weaned she only needs fresh water to drink.'],
        ['When do kittens start eating solid food?', 'Weaning usually begins at around 3–4 weeks of age and is generally finished by about 8 weeks. Start with a wet kitten food, softened with a little warm water or milk replacer if needed, offered in a shallow dish. Go slowly; most kittens take a week or two to eat confidently.'],
        ['When should I switch my kitten to adult food?', 'Most kittens can move to adult food at about 12 months old, which is when cats are generally considered adults. Some sources say 9–12 months. Large, slow-growing breeds such as Maine Coons may keep growing for longer, so ask your vet when to switch. Make the change gradually over about 3–7 days.'],
        ['How do I know if my kitten is eating enough?', 'A healthy kitten should keep gaining weight steadily, have plenty of energy and have a body you can feel the ribs on without them sticking out. Weigh her once a week on a kitchen or baby scale. If she stops gaining, loses weight, refuses food or has diarrhoea, contact your vet, because young kittens can go downhill quickly.'],
    ];
}

function pz_what_is_kitten_feeding() {
    ob_start(); ?>
    <p>The Kitten Feeding Guide answers the two questions every new kitten owner asks: how much should I feed my kitten, and how often? You enter her age and weight, and optionally the food you use, and it gives you a feeding schedule for her age, an estimate of her daily calories, and the number of cans or cups per day and per meal.</p>
    <p>For kittens under 4 weeks it does something different. They should still be on their mother’s milk or a kitten milk replacer, so the guide shows how often they need feeding and the key safety points for bottle feeding instead of food amounts. For kittens being weaned, it explains how to bring in solid food.</p>
    <p>The numbers are estimates for healthy kittens. Kittens vary a lot, so use the result as a starting point and adjust it by weighing her every week and watching her body shape.</p>
    <?php return ob_get_clean();
}

function pz_why_important_kitten_feeding() {
    ob_start(); ?>
    <p>A kitten does most of her growing in her first year, and she needs much more food per pound than an adult cat to do it. Getting the amount and the timing roughly right helps her grow steadily and sets up good eating habits for life.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">📈</span>
        <div>
          <strong>Fast growth needs a lot of energy</strong>
          <p>Kittens need about twice the calories of an adult of the same weight, plus extra protein, fat, vitamins and minerals. That is why a complete kitten food matters more than the brand.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🍽️</span>
        <div>
          <strong>Small stomachs need frequent meals</strong>
          <p>A kitten cannot eat a whole day’s food in one or two sittings. Splitting it into several meals helps her get enough without overfilling her stomach.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🍼</span>
        <div>
          <strong>Young kittens are fragile</strong>
          <p>Kittens under a few weeks old cannot keep themselves warm and need feeding around the clock. Missed feeds, the wrong milk or a chilled kitten can become serious quickly.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⚖️</span>
        <div>
          <strong>Habits start early</strong>
          <p>Measured meals make it easy to notice if her appetite changes, and help prevent weight gain later, especially after she is spayed or neutered.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_kitten_feeding() {
    return [
        ['title' => 'Pick her age', 'desc' => 'Her age decides how often she eats and what she eats. If you do not know her exact age, your vet can estimate it from her teeth and size.'],
        ['title' => 'Weigh her', 'desc' => 'Use a kitchen or baby scale. Small kittens are easiest to weigh in a bowl or box; weigh the container first and subtract it.'],
        ['title' => 'Choose her food', 'desc' => 'Wet, dry or a mix of both. Enter the kcal per 3 oz can and per cup from the label of the kitten food you actually use.'],
        ['title' => 'Split the day into meals', 'desc' => 'Divide the daily amount across the number of meals shown for her age. Put each meal down at about the same times every day.'],
        ['title' => 'Weigh her weekly and adjust', 'desc' => 'She should keep gaining steadily. If she is not, or if she is getting round, change the daily amount by about 10% and check again the next week.'],
        ['title' => 'Plan the switch to adult food', 'desc' => 'At around 12 months, move her to an adult food by mixing it in gradually over 3–7 days.'],
    ];
}

function pz_tips_kitten_feeding() {
    return [
        ['Feed a complete kitten food', 'Look for “complete” and “for growth” or “for kittens” on the label. Adult cat food does not have enough of what a growing kitten needs.'],
        ['Start with what she is used to', 'When she first comes home, keep her on the same food for a while. A new home and a new diet at once can upset her stomach.'],
        ['Offer both wet and dry while she is young', 'Kittens that get used to different textures early are often easier to feed later in life.'],
        ['Keep water away from food', 'Fresh water should always be available, ideally in a separate spot from her food bowl, with a second bowl elsewhere in the home.'],
        ['Use a scale, not a guess', 'A kitchen scale for her and for the food gives you far better numbers than a scoop and a glance.'],
        ['Count puzzle feeders and treats', 'Food from puzzle feeders and treats is part of her daily amount. Take it out of her meals rather than adding it on top.'],
    ];
}

function pz_mistakes_kitten_feeding() {
    return [
        ['❌ Giving cow’s milk', 'Cow’s and goat’s milk do not have the right protein and fat levels for kittens and can cause stomach upsets. Use a kitten milk replacer for young kittens, and water once she is weaned.'],
        ['❌ Feeding adult cat food too early', 'Adult food is not designed for growth. Keep her on kitten food until about 12 months unless your vet suggests otherwise.'],
        ['❌ Two big meals for a young kitten', 'Her stomach is small. Kittens under 6 months do better with three or four smaller meals.'],
        ['❌ Changing food suddenly', 'Switch over 3–7 days, mixing a little of the new food into the old and slowly increasing it, to avoid diarrhoea.'],
        ['❌ Feeding a chilled kitten', 'A cold newborn kitten cannot digest properly. Warm her up gently first, and call a vet if she feels cold or will not feed.'],
        ['❌ Feeding a raw or home-made diet', 'It is very hard to balance a home-made or raw diet for a growing kitten, and raw meat can carry germs that make cats and people ill.'],
    ];
}

function pz_render_guide_kitten_feeding( $tool ) {
    $icon = $tool['icon'] ?? '🍼';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Kitten Feeding Calculator</div>
          <div class="pz-int-sublabel">Meals a day, daily calories and cans or cups for her age</div>
        </div>
      </div>
      <div class="pz-int-badges">
        <span class="pz-int-badge pz-int-badge--green">✅ No Sign-Up</span>
        <span class="pz-int-badge pz-int-badge--blue">🍼 Birth to 12 months</span>
      </div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt" for="pz_kf_age">Kitten’s Age</label>
          <select id="pz_kf_age" class="pz-int-select" onchange="pzKittenAge()">
            <option value="neo">0–4 weeks (milk or bottle)</option>
            <option value="wean">4–8 weeks (weaning)</option>
            <option value="m2" selected>2–4 months</option>
            <option value="m4">4–6 months</option>
            <option value="m6">6–12 months</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt" for="pz_kf_weight">Weight
            <span class="pz-int-unit-toggle">
              <button type="button" class="pz-unit-btn active" onclick="pzSetUnit('lbs',this)">lbs</button>
              <button type="button" class="pz-unit-btn" onclick="pzSetUnit('kg',this)">kg</button>
            </span>
          </label>
          <div class="pz-int-input-wrap">
            <input type="number" id="pz_kf_weight" class="pz-int-input" placeholder="e.g. 3" min="0.05" max="20" step="0.05">
            <span class="pz-int-input-suffix" id="pz-unit-label">lbs</span>
          </div>
        </div>
        <div class="pz-int-field" id="pz_kf_diet_wrap">
          <label class="pz-int-label-txt" for="pz_kf_diet">Food</label>
          <select id="pz_kf_diet" class="pz-int-select" onchange="pzKittenDiet()">
            <option value="wet" selected>Wet kitten food only</option>
            <option value="dry">Dry kitten food only</option>
            <option value="mix">Half wet, half dry</option>
          </select>
        </div>
        <div class="pz-int-field" id="pz_kf_wet_wrap">
          <label class="pz-int-label-txt" for="pz_kf_can_kcal">kcal per 3 oz can <span class="pz-int-optional">(optional, see the label)</span></label>
          <input type="number" id="pz_kf_can_kcal" class="pz-int-input" value="80" min="20" max="300" step="1">
        </div>
        <div class="pz-int-field" id="pz_kf_dry_wrap" style="display:none">
          <label class="pz-int-label-txt" for="pz_kf_cup_kcal">kcal per cup of dry food <span class="pz-int-optional">(optional, see the label)</span></label>
          <input type="number" id="pz_kf_cup_kcal" class="pz-int-input" value="375" min="150" max="700" step="1">
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzGenKittenFeeding()">
        <span class="pz-int-btn-icon"><?php echo $icon; ?></span>
        Get My Kitten’s Feeding Plan
      </button>
      <div id="pz-guide-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}
