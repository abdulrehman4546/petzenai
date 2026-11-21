<?php
/**
 * Tool-specific content for: Bird Food Portion Calculator by Species (registry key: bird_food_portion_calculator).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_bird_food_portion_calculator() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Use the calculator on this page — enter your bird's life stage, weight, and activity level to get a personalized starting-point daily calorie estimate. Whatever the number comes out to, the daily diet itself should still be built around pellets and fresh vegetables as the base, with seed kept as a smaller part of the mix, not the main food.</div>
<?php }

function pz_what_is_bird_food_portion_calculator() {
    ob_start(); ?>
    <p>This tool helps you work out a starting-point daily calorie estimate for a pet bird based on its life stage, weight, and activity level. Enter those details into the calculator above and it returns a personalized kcal figure you can use as a baseline, along with a rough split across meals.</p>
    <p>A calorie number on its own only tells part of the story — what the bird is actually fed matters just as much as how much energy it needs. A pelleted food as the base, fresh vegetables added daily, and a smaller amount of fruit is the general pattern that applies across most pet bird species, with seed kept to a treat-sized role rather than the main food.</p>
    <p>Because birds vary a lot in size, from a small budgie to a large macaw, a single fixed calorie number across all species would be misleading, which is why the calculator adjusts for your bird's own weight and activity level instead of giving one flat answer.</p>
    <?php return ob_get_clean();
}

function pz_why_important_bird_food_portion_calculator() {
    ob_start(); ?>
    <p>Getting energy needs roughly right matters because both overfeeding and underfeeding a pet bird show up gradually, over weeks and months, rather than all at once.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">⚖️</span>
        <div><strong>Calorie needs scale with the bird</strong><p>An energy estimate that fits a small budgie would be far too low for a large parrot, and vice versa, which is why life stage and weight both factor into the personalized figure.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🌾</span>
        <div><strong>Where those calories come from matters too</strong><p>The same daily calorie total made up mostly of seed is a narrower, fattier mix than one split across pellets, vegetables, and a little fruit.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🏃</span>
        <div><strong>Activity level changes energy needs</strong><p>A bird that gets daily out-of-cage flight time generally burns more energy than one that stays mostly in the cage, which is why activity level is part of the estimate.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">📊</span>
        <div><strong>A starting point still needs body-condition checks</strong><p>Any calorie estimate is a baseline to adjust from — watching your bird's actual weight and body condition over time tells you whether to offer a bit more or less food.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_bird_food_portion_calculator() {
    return [
        ['title' => 'Select your bird\'s life stage', 'desc' => 'Choose young, adult, or senior in the calculator above, since energy needs shift somewhat across life stages.'],
        ['title' => 'Enter your bird\'s weight in lbs or kg', 'desc' => 'The calculator takes body weight in pounds or kilograms rather than grams, so convert first for small species — a 35g budgie, for example, is about 0.08 lbs — and use your most recent avian vet weigh-in if you have one.'],
        ['title' => 'Choose an activity level', 'desc' => 'Select low, moderate, high, or athletic based on how much flight and out-of-cage time your bird gets in a typical day.'],
        ['title' => 'Review the personalized estimate', 'desc' => 'Use the daily calorie figure as a reference point when deciding how much pelleted food and fresh vegetables to offer, rather than reading it as a literal gram or weight amount — pellets should still form the base, with vegetables added daily and seed kept to a treat-sized amount.'],
        ['title' => 'Offer fresh food in portions it can actually finish', 'desc' => 'Vegetables and fruit go off well before pellets do, and heat speeds that up, so aim to put out roughly what your bird will clear before the next feeding instead of piling the dish high.'],
        ['title' => 'Recheck the estimate if weight or activity changes', 'desc' => 'A bird that becomes more or less active, or gains or loses weight, may need the calorie estimate recalculated rather than left the same indefinitely.'],
    ];
}

function pz_tips_bird_food_portion_calculator() {
    return [
        ['Spread feeding across more than one sitting', 'Offering fresh food at two or three points in the day, rather than filling the bowl once and walking away, keeps it appealing and limits how long anything sits out.'],
        ['Make part of the daily food a foraging task', 'Tucking some pellets or vegetables into a foraging toy turns a portion of the calorie estimate into mental work instead of a bowl that removes that task entirely.'],
['Re-check the estimate after a weigh-in', 'Body weight is the biggest lever in the calorie result, so a fresh weigh-in every few months — more often for a growing or recovering bird — keeps the number worth using.'],
        ['Re-weigh periodically, not just once', 'A bird\'s weight can shift gradually, so checking it every so often and re-running the calculator keeps the calorie estimate current rather than based on outdated numbers.'],
        ['A full-looking bowl doesn\'t mean the energy math works out', 'Heaping the dish with seed can look like plenty of food while quietly packing in more fat per scoop than the same volume of pellets and vegetables would.'],
    ];
}

function pz_mistakes_bird_food_portion_calculator() {
    return [
        ['❌ Using one flat number for every bird', 'Life stage, weight, and activity level all change how much energy a bird actually needs, so a single fixed calorie figure across different birds is often wrong in one direction or the other.'],
        ['❌ Hitting the calorie estimate mostly with seed', 'Reaching the same daily number through seed alone is a narrower, fattier approach; pellets and fresh vegetables should supply the larger share.'],
        ['❌ Never rechecking the estimate', 'A figure that was right for a young, highly active bird may be too high once activity drops with age, so revisiting the calculator periodically helps.'],
        ['❌ Piling the bowl instead of watching how much is actually eaten', 'A full bowl doesn\'t tell you whether the bird is eating anywhere near the estimated amount, and leftover vegetables in a warm room can spoil within hours.'],
        ['❌ Ignoring body condition changes', 'If a bird is visibly gaining or losing weight, that is a sign to re-run the estimate rather than sticking with a number calculated months earlier.'],
    ];
}

function pz_faq_bird_food_portion_calculator() {
    return [
        ['How does this calculator work?', 'Enter your bird\'s life stage, weight in lbs or kg, and activity level above and it returns a personalized starting-point daily calorie (kcal) estimate based on those details, plus a rough per-meal split.'],
        ['Does this tell me exactly how many grams of food to feed?', 'No — it estimates daily energy needs in calories, not a food weight. How many grams of pellets or vegetables that translates to depends on the specific food\'s calorie density, so use the estimate as a reference point rather than a literal scoop size.'],
        ['Does bird size affect the estimate?', 'Yes — weight is one of the inputs, since a small budgie and a large parrot have very different daily energy needs.'],
        ['How often should I recheck the calorie estimate?', 'Whenever your bird\'s weight, activity level, or life stage changes noticeably, rather than assuming one number applies indefinitely.'],
        ['Can I hit the daily calorie number with just seed?', 'It is best not to — reaching the same energy total mostly through seed is a narrower, fattier way to get there compared to splitting it across pellets and fresh vegetables.'],
        ['My bird isn\'t eating much of what I offer. What should I do?', 'Check whether it is actually eating the pellets and vegetables versus leaving them in the bowl, and consider whether the estimate needs adjusting for a lower activity level.'],
    ];
}
