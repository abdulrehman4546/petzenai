<?php
/**
 * Tool-specific content for: Rabbit Hutch & Cage Size Calculator (registry key: rabbit_cage_calc).
 * The calculation lives in pzCalcRabbitCage() in templates/pages/auto-tool.php.
 *
 * Sizes follow commonly published minimums from humane societies and rabbit-welfare groups. Sources differ a little
 * (minimum floor area is quoted anywhere from about 8 to 12 sq ft), so the tool shows both a minimum and a
 * comfortable target and tells people to go bigger when they can.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_rabbit_cage_calc() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Most rabbits need an enclosure of <strong>at least 12 square feet</strong> (about 6 × 2 ft), plus <strong>24–32 sq ft of safe exercise space</strong> for several hours a day. Guides quote bare minimums from about 8 sq ft for a medium rabbit, but bigger is always better. Pick your rabbit’s size and how many you have to see the numbers for your setup.</div>
<?php }

function pz_hero_trust_rabbit_cage_calc() { ?>
      <span>✅ Minimum and comfortable size</span>
      <span>✅ 1 to 4 rabbits</span>
      <span>✅ Inches and centimetres</span>
<?php }

function pz_methodology_heading_rabbit_cage_calc() { return 'How the Cage Size Is Worked Out'; }

function pz_methodology_rabbit_cage_calc() { ?>
    <p style="color:#555;margin-bottom:20px">The calculator uses the minimum enclosure sizes that humane societies and rabbit-welfare groups publish for each size of rabbit, then adds a more comfortable target. Different groups quote slightly different numbers, so treat these as floors, not goals.</p>
    <div class="pz-methodology-grid">
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">📏</div>
        <strong>Minimum by rabbit size</strong>
        <p>Small rabbits need about 3 × 2 × 1.5 ft, medium about 4 × 2 × 2 ft, large about 5 × 2 × 2 ft, and giant breeds about 6 × 2.5 × 2.5 ft, as a bare minimum.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🐇</div>
        <strong>The hop test</strong>
        <p>The enclosure should be long enough for at least three or four hops, and tall enough to stand fully upright on the hind legs. A common rule is length of at least four times your rabbit’s body length.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">🏠</div>
        <strong>Comfortable target</strong>
        <p>Many rabbit organisations recommend at least 12 sq ft for the main living area (about 6 × 2 ft). For larger rabbits the tool uses 1.5 times the minimum if that is bigger.</p>
      </div>
      <div class="pz-methodology-card">
        <div class="pz-methodology-icon">👯</div>
        <strong>More than one rabbit</strong>
        <p>Guidance suggests doubling the space for a pair. The calculator gives each rabbit a full allowance, so two rabbits need twice the area, three need three times, and so on.</p>
      </div>
    </div>
    <table class="pz-breed-table" style="margin-top:20px">
      <thead><tr><th>Rabbit size</th><th>Bare minimum (L × W × H)</th><th>Floor area</th></tr></thead>
      <tbody>
        <tr><td>Small (dwarf breeds, up to about 4 lb)</td><td>36 × 24 × 18 in</td><td>6 sq ft</td></tr>
        <tr><td>Medium (about 4–7 lb)</td><td>48 × 24 × 24 in</td><td>8 sq ft</td></tr>
        <tr><td>Large (about 7–11 lb)</td><td>60 × 24 × 24 in</td><td>10 sq ft</td></tr>
        <tr><td>Giant (over 11 lb)</td><td>72 × 30 × 30 in</td><td>15 sq ft</td></tr>
      </tbody>
    </table>
<?php }

function pz_faq_rabbit_cage_calc() {
    return [
        ['How big should a rabbit cage be?', 'As a bare minimum, a small rabbit needs about 3 × 2 ft of floor, a medium rabbit about 4 × 2 ft, a large rabbit about 5 × 2 ft and a giant breed about 6 × 2.5 ft. Many rabbit organisations recommend at least 12 square feet (about 6 × 2 ft) for the living area, and the cage should be tall enough for the rabbit to stand fully upright.'],
        ['Is a rabbit cage enough, or does she need an exercise area too?', 'She needs both. The enclosure is where a rabbit rests, eats and uses her litter box. Rabbits also need a larger safe area to run, jump and explore, often given as 24 to 32 square feet, for several hours every day. Many owners leave a pen or room open for most of the day.'],
        ['How much space do two rabbits need?', 'Guidelines suggest roughly doubling the space for a pair. Give each rabbit a full allowance, so two medium rabbits are better with at least 16 square feet at the very minimum and ideally 24 or more.'],
        ['Are pet-store cages big enough?', 'Most are not. Many cages sold for rabbits are smaller than the minimums above, especially for medium and large breeds. A large dog exercise pen, a puppy playpen or a purpose-built rabbit hutch with an attached run usually gives much better space.'],
        ['Can a rabbit live in a hutch outdoors?', 'It can if the setup is large, predator-proof and protected from rain, wind, and especially heat and cold. Rabbits are sensitive to hot weather. A hutch should be paired with a secure run and checked daily, and many owners prefer to keep rabbits indoors for safety and companionship.'],
        ['What flooring is best?', 'Solid flooring with a soft surface such as a washable mat or fleece is better than bare wire, which can cause painful sore hocks. Add a litter box with hay, and give a hiding place so she can feel safe.'],
        ['Does a bigger cage really matter?', 'Yes. Rabbits that cannot move, stretch and hop freely can become bored, overweight or stressed. Treat the minimums as the least you can do and go bigger whenever you have room.'],
    ];
}

function pz_what_is_rabbit_cage_calc() {
    ob_start(); ?>
    <p>The Rabbit Hutch &amp; Cage Size Calculator tells you how big your rabbit’s enclosure should be, based on her size and how many rabbits share it. It shows the bare minimum, a more comfortable target, and the safe exercise space she needs on top.</p>
    <p>It uses the minimum sizes published by humane societies and rabbit-welfare groups, and an optional body-length check, so you can compare the cage you have, or one you are about to buy, with what the guidance recommends.</p>
    <p>The numbers are guidance, not law. Different groups quote slightly different minimums, so use them as floors and go larger when you can.</p>
    <?php return ob_get_clean();
}

function pz_why_important_rabbit_cage_calc() {
    ob_start(); ?>
    <p>Rabbits are active animals that need room to move. Space is one of the most common things owners get wrong, because many cages sold in shops are smaller than welfare guidance recommends.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🐇</span>
        <div>
          <strong>Natural movement</strong>
          <p>Rabbits run, hop, stretch out and stand up on their hind legs. A cage that is too small stops all of these behaviours.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⚖️</span>
        <div>
          <strong>Weight and health</strong>
          <p>Rabbits that cannot exercise can gain weight, and limited movement is linked to problems such as sore hocks and poor digestion.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🧠</span>
        <div>
          <strong>Behaviour</strong>
          <p>Cramped, bored rabbits may chew bars, dig at the floor or become withdrawn. More space and enrichment often help.</p>
        </div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💰</span>
        <div>
          <strong>Buying once</strong>
          <p>Knowing the right size before you buy saves you from replacing an undersized cage a few months later.</p>
        </div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_rabbit_cage_calc() {
    return [
        ['title' => 'Choose your rabbit’s size', 'desc' => 'Use her adult weight if she is still growing. Pick giant only for breeds such as Flemish Giants.'],
        ['title' => 'Say how many rabbits share the space', 'desc' => 'Each rabbit gets a full allowance, so the area grows with the number of rabbits.'],
        ['title' => 'Measure her body length (optional)', 'desc' => 'Measure from nose to the base of the tail when she is stretched out. The tool checks the four-times-body-length rule.'],
        ['title' => 'Compare the result with your cage', 'desc' => 'Measure the inside floor of the cage you have or want to buy, and compare it with the minimum and the comfortable target.'],
        ['title' => 'Add a safe exercise area', 'desc' => 'A cage alone is never enough. Plan for 24 to 32 square feet or more for several hours a day, using a playpen or a bunny-proofed room.'],
    ];
}

function pz_tips_rabbit_cage_calc() {
    return [
        ['Measure the inside, not the outside', 'Shelves, ramps and food bowls take up floor space. Measure the usable floor that is free of clutter.'],
        ['Use a pen instead of a small cage', 'A dog exercise pen or puppy playpen is often cheaper and larger than a rabbit cage, and can be reshaped to fit a room.'],
        ['Give height to stand up', 'She should be able to stand fully on her hind legs without her ears touching the top.'],
        ['Fill the space well', 'Include a litter box with hay, a hiding place, water and a chew toy. Rabbits need unlimited hay every day.'],
        ['Cover hard floors', 'Use a washable mat or fleece over bare wire or slippery floors to protect her feet.'],
        ['Keep her cool', 'Rabbits are sensitive to heat. Keep the enclosure out of direct sun and well ventilated.'],
    ];
}

function pz_mistakes_rabbit_cage_calc() {
    return [
        ['❌ Trusting the size on the pet-store label', 'Cages labelled for rabbits are often smaller than welfare guidance. Compare the measurements, not the label.'],
        ['❌ Keeping her in the cage all day', 'The enclosure is for resting. Rabbits need several hours of exercise outside it every day.'],
        ['❌ Using a cage with a wire floor', 'Bare wire can cause sore hocks. Use a solid floor with a soft surface.'],
        ['❌ Housing two rabbits in a one-rabbit cage', 'A pair needs about double the space of a single rabbit, even if they are bonded and like to cuddle.'],
        ['❌ Forgetting height', 'A low cage stops her standing up to look around. Check she can stand fully upright.'],
    ];
}

function pz_render_calc_rabbit_cage_calc( $tool ) {
    $icon = $tool['icon'] ?? '🏠';
    ?>
    <div class="pz-int-header">
      <div class="pz-int-header-left">
        <span class="pz-int-big-icon"><?php echo $icon; ?></span>
        <div>
          <div class="pz-int-label">Rabbit Hutch &amp; Cage Size Calculator</div>
          <div class="pz-int-sublabel">Minimum size, a comfortable target and the exercise space your rabbit needs</div>
        </div>
      </div>
      <div class="pz-int-badges">
        <span class="pz-int-badge pz-int-badge--green">✅ No Sign-Up</span>
        <span class="pz-int-badge pz-int-badge--blue">📏 Inches &amp; cm</span>
      </div>
    </div>
    <div class="pz-int-body">
      <div class="pz-int-grid">
        <div class="pz-int-field">
          <label class="pz-int-label-txt" for="pz_rb_size">Rabbit size</label>
          <select id="pz_rb_size" class="pz-int-select">
            <option value="small">Small: dwarf breeds, up to about 4 lb</option>
            <option value="medium" selected>Medium: about 4–7 lb</option>
            <option value="large">Large: about 7–11 lb</option>
            <option value="giant">Giant: over 11 lb (e.g. Flemish Giant)</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt" for="pz_rb_count">Number of rabbits</label>
          <select id="pz_rb_count" class="pz-int-select">
            <option value="1" selected>1 rabbit</option>
            <option value="2">2 rabbits</option>
            <option value="3">3 rabbits</option>
            <option value="4">4 rabbits</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt" for="pz_rb_housing">Where will they live?</label>
          <select id="pz_rb_housing" class="pz-int-select">
            <option value="indoor" selected>Indoors (pen or cage)</option>
            <option value="outdoor">Outdoor hutch with attached run</option>
            <option value="free">Free-roam, bunny-proofed room</option>
          </select>
        </div>
        <div class="pz-int-field">
          <label class="pz-int-label-txt" for="pz_rb_len">Body length <span class="pz-int-optional">(optional, nose to tail base)</span></label>
          <div class="pz-int-input-wrap">
            <input type="number" id="pz_rb_len" class="pz-int-input" placeholder="e.g. 16" min="4" max="40" step="0.5">
            <select id="pz_rb_len_unit" class="pz-int-select" style="max-width:90px">
              <option value="in" selected>inches</option>
              <option value="cm">cm</option>
            </select>
          </div>
        </div>
      </div>
      <button class="pz-int-btn" onclick="pzCalcRabbitCage()">
        <span class="pz-int-btn-icon"><?php echo $icon; ?></span>
        Calculate Cage Size
      </button>
      <div id="pz-calc-result" style="display:none" aria-live="polite"></div>
    </div>
    <?php
}
