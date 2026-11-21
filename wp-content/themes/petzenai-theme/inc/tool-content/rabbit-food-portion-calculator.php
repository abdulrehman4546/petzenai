<?php
/**
 * Tool-specific content for: Rabbit Food Portion Calculator (registry key: rabbit_food_portion_calculator).
 * This is a 'calculator' type with no dedicated pz_render_calc function, so it uses the generic
 * calorie/portion widget in templates/pages/auto-tool.php, which outputs an estimated kcal figure,
 * not a specific gram or cup amount. Content below is written to explain that the number is an
 * energy estimate only, and that hay still needs to be the actual foundation of the diet.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_rabbit_food_portion_calculator() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Enter your rabbit's weight and activity level above to get a rough daily energy (kcal) number. That number is only a reference for sizing her measured pellet portion — it is not a hay allowance, since hay should be left unlimited no matter what the estimate says.</div>
<?php }

function pz_what_is_rabbit_food_portion_calculator() {
    ob_start(); ?>
    <p>Type in your rabbit's current weight and how active she is, and this tool returns an approximate daily calorie need in kcal. It's a math-based estimate, not a measurement of an actual meal — think of it the way you'd think of a calorie target for a person, not a recipe card.</p>
    <p>The number you get back does almost nothing to tell you what to put in the bowl. A rabbit's diet isn't really about hitting a calorie target at all; it's built around keeping hay in front of her at all times and then layering a small measured scoop of pellets and some fresh greens on top of that. The kcal figure mostly matters for sanity-checking the pellet scoop, not for deciding how much hay to offer.</p>
    <p>Spay/neuter status and age shift things more than people expect. An intact or young, still-growing rabbit can run a noticeably different energy need than an adult spayed or neutered one, so if your rabbit falls into either of those groups, treat the number as rougher than usual and lean on her actual body condition instead.</p>
    <?php return ob_get_clean();
}

function pz_why_important_rabbit_food_portion_calculator() {
    ob_start(); ?>
    <p>A rabbit that's slowly over- or under-fed on pellets rarely shows it right away — weight creeps up or down over weeks, which is exactly why having a sanity-check number helps even though it's imprecise.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🐇</span>
        <div><strong>Hay doesn't show up in the calorie math the way you'd think</strong><p>Unlimited hay intake is hard to pin to a single number, so the estimate is really aimed at the pellet side of the bowl, not the hay rack.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">✂️</span>
        <div><strong>Spay/neuter status shifts the baseline</strong><p>An unaltered rabbit's energy use and behavior can differ enough from a fixed one that the same weight doesn't always mean the same needs.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">📈</span>
        <div><strong>A growing rabbit isn't the same calculation as an adult one</strong><p>Younger rabbits still building out their frame often need proportionally more energy than a full-grown adult at a similar weight.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⚖️</span>
        <div><strong>Pounds and ounces matter more than people expect</strong><p>A mid-size rabbit's healthy weight range can span less than a pound in either direction, so small shifts on the scale are worth tracking closely, not brushing off.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_rabbit_food_portion_calculator() {
    return [
        ['title' => 'Weigh her and log the number precisely', 'desc' => 'Rabbit weight is usually worth tracking to the ounce or to tenths of a kilogram, not just rounded to the nearest pound — small changes are meaningful on a rabbit-sized frame.'],
        ['title' => 'Note whether she is spayed/neutered and roughly how old she is', 'desc' => 'These two details change how much the raw kcal number should be trusted, since intact and young rabbits often run outside the typical adult pattern.'],
        ['title' => 'Pick the activity level that matches her actual space', 'desc' => 'A rabbit with daily run-around time outside a cage burns more than one confined most of the day, so be honest about how much room she gets.'],
        ['title' => 'Read the kcal result as a pellet sanity-check, nothing more', 'desc' => 'Use it to confirm your measured pellet scoop is in a reasonable range — it was never meant to tell you anything about her hay.'],
        ['title' => 'Leave hay unlimited regardless of what the number says', 'desc' => 'No calorie estimate overrides the basic rule that hay stays available around the clock; the number only applies to the smaller supplemental foods.'],
        ['title' => 'Re-weigh and rerun this every so often', 'desc' => 'A few months of growth, a spay/neuter surgery, or a change in exercise room are all reasons to redo this rather than trust an old number indefinitely.'],
    ];
}

function pz_tips_rabbit_food_portion_calculator() {
    return [
        ['Weigh on the same scale, same time of day', 'A kitchen scale that reads in ounces or grams catches small week-to-week shifts that a bathroom scale would miss entirely.'],
        ['Don\'t let the pellet scoop grow with the bag size', 'It\'s easy to start scooping a little more just because the bag is bigger — stick to a fixed measuring cup instead.'],
        ['Track body feel, not just the number on the scale', 'Running a hand along her sides and spine tells you more about whether she\'s carrying extra weight than the raw figure alone.'],
        ['Expect the estimate to move after a spay/neuter', 'Energy needs often settle into a slightly lower, steadier pattern once a rabbit is fixed, so don\'t be surprised if the number drifts.'],
        ['Treat hay quantity as unrelated to this tool', 'If you\'re trying to figure out how much hay to buy or offer, this calculator isn\'t the right reference — hay stays unlimited by design.'],
    ];
}

function pz_mistakes_rabbit_food_portion_calculator() {
    return [
        ['❌ Using the kcal figure to ration hay', 'Hay is meant to be unlimited no matter what the calorie estimate says — the number was never built to cover it.'],
        ['❌ Ignoring spay/neuter status when reading the result', 'An intact rabbit\'s actual needs can diverge enough from the estimate that the number deserves less trust in that case.'],
        ['❌ Weighing only occasionally, or rounding loosely', 'Rabbit-scale weight changes are small in absolute terms, so a scale that only reads whole pounds can hide a real trend.'],
        ['❌ Assuming a young, growing rabbit fits the same curve as an adult', 'Growth adds energy demands the standard estimate doesn\'t fully account for.'],
        ['❌ Letting the pellet scoop drift upward over time', 'A slightly bigger scoop each refill adds up, and the calorie estimate only helps if the actual portion stays consistent with it.'],
    ];
}

function pz_faq_rabbit_food_portion_calculator() {
    return [
        ['What exactly does this calculator output?', 'A rough daily energy estimate in kcal, based on the weight and activity level you enter — it is not a gram or cup measurement of any specific food.'],
        ['Does this tell me how much hay to give?', 'No. Hay should stay unlimited at all times regardless of this estimate; the number is really aimed at sanity-checking the pellet portion.'],
        ['Does spaying or neutering change the result I should expect?', 'The tool itself doesn\'t ask about that, but in practice an intact rabbit\'s real needs can run differently than the estimate suggests, so weigh the number with that in mind.'],
        ['My rabbit is still young — is the estimate still accurate?', 'Treat it as less reliable for a growing rabbit, since young rabbits often need proportionally more energy than the adult pattern the estimate is based on.'],
        ['How precisely should I be weighing her?', 'Closer than most people expect — ounces or tenths of a kilogram, not just the nearest pound, since her healthy range can be a narrow window.'],
        ['How often should I redo the calculation?', 'Any time her weight shifts, she\'s spayed or neutered, or her exercise routine changes meaningfully — not just once and never again.'],
    ];
}
