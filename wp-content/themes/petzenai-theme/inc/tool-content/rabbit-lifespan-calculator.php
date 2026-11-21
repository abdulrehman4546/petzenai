<?php
/**
 * Tool-specific content for: Rabbit Lifespan Calculator by Breed (registry key: rabbit_lifespan_calculator).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_rabbit_lifespan_calculator() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> A well-cared-for pet rabbit commonly lives roughly 8 to 12 years. Breed size plays a role, since smaller breeds often live longer than giant breeds, but spay/neuter status, whether she lives indoors, and diet generally matter just as much as breed alone.</div>
<?php }

function pz_what_is_rabbit_lifespan_calculator() {
    ob_start(); ?>
    <p>Four things drive how long a pet rabbit typically lives: how big her breed is, whether she's been spayed or neutered, whether she stays indoors, and what she's fed — this page walks through each one alongside the general range owners commonly hear cited.</p>
    <p>A well-cared-for pet rabbit commonly lives somewhere in the 8 to 12 year range. That is a range, not a guarantee, and individual rabbits vary based on genetics and the care they receive.</p>
    <p>Size is one piece of the picture — a giant breed typically has a shorter expected run than a dwarf or small breed — but day-to-day choices like spaying or neutering, indoor housing, and a hay-based diet tend to make a meaningful difference too.</p>
    <?php return ob_get_clean();
}

function pz_why_important_rabbit_lifespan_calculator() {
    ob_start(); ?>
    <p>Breed size and genetics aren't things you can change after the fact, but spay/neuter status, housing, and diet are — knowing which is which points you toward the decisions actually worth making.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">📏</span>
        <div><strong>Breed size plays a role</strong><p>Smaller breeds often live longer than giant breeds, though this is a general pattern rather than a precise prediction for an individual rabbit.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">✂️</span>
        <div><strong>Fixing her changes the health math</strong><p>An unaltered female in particular carries a meaningfully elevated risk of uterine disease later in life, which spaying removes almost entirely; neutering a male mainly cuts out hormone-driven fighting and roaming risks.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🏠</span>
        <div><strong>Indoor living removes major risks</strong><p>Keeping a rabbit indoors, or giving her safe supervised outdoor time, avoids predators, extreme weather, and disease exposure that can shorten an outdoor rabbit's life.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🌾</span>
        <div><strong>Diet affects healthy years</strong><p>A hay-based diet supports digestion and dental health over her lifetime, while a diet too heavy in pellets or treats can contribute to weight and digestive problems.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_rabbit_lifespan_calculator() {
    return [
        ['title' => 'Note her breed and approximate size', 'desc' => 'Smaller breeds often live longer than giant breeds as a general pattern, so her size category gives a rough starting point.'],
        ['title' => 'Consider her spay or neuter status', 'desc' => 'Fixing her cuts out the uterine disease risk tied to being an intact female, and curbs hormone-driven fighting and roaming in males.'],
        ['title' => 'Think about indoor versus outdoor housing', 'desc' => 'Indoor rabbits, or those with safe supervised outdoor access, generally avoid risks like predators and extreme weather that can shorten an outdoor rabbit\'s life.'],
        ['title' => 'Review her diet', 'desc' => 'A hay-based diet with measured pellets and daily vegetables supports digestion and dental health over the years.'],
        ['title' => 'Weigh these factors together rather than any one alone', 'desc' => 'Breed size, spay/neuter status, housing, and diet combine to shape where an individual rabbit is likely to land, so no single factor tells the whole story on its own.'],
    ];
}

function pz_tips_rabbit_lifespan_calculator() {
    return [
        ['Spay or neuter when your vet recommends it', 'This is one of the more controllable factors that can support a longer, healthier life.'],
        ['Keep her indoors or in a secure, supervised outdoor setup', 'Reducing exposure to predators, extreme temperatures, and disease supports a longer lifespan.'],
        ['Keep hay as the base of her diet', 'A hay-heavy diet with measured pellets and daily vegetables supports digestion and dental health over time.'],
        ['Give her daily exercise space', 'Regular movement supports healthy weight and joint condition as she ages.'],
        ['Schedule regular veterinary checkups', 'Routine visits can catch developing health issues earlier, when they are often easier to manage.'],
    ];
}

function pz_mistakes_rabbit_lifespan_calculator() {
    return [
        ['❌ Assuming breed alone determines lifespan', 'Breed size is one factor among several — spay/neuter status, housing, and diet matter just as much.'],
        ['❌ Treating a lifespan range as an exact number', 'The 8 to 12 year range is a general guide, not a guarantee for any individual rabbit.'],
        ['❌ Skipping spay or neuter surgery', 'An intact female faces a notably higher lifetime risk of uterine disease that spaying removes almost entirely.'],
        ['❌ Housing her outdoors without protection', 'An unprotected outdoor setup exposes her to predators and weather extremes that an indoor or secure setup avoids.'],
        ['❌ Letting pellets or treats replace hay', 'Swapping out hay for more pellets or treats than she needs can lead to weight gain and digestive problems that shorten a comfortable, healthy life.'],
    ];
}

function pz_faq_rabbit_lifespan_calculator() {
    return [
        ['How long do pet rabbits usually live?', 'Most well-cared-for pet rabbits reach roughly 8 to 12 years, with the exact number shaped by genetics and the quality of day-to-day care.'],
        ['Do smaller rabbit breeds live longer?', 'That is the general pattern — dwarf and small breeds tend to outlast giant breeds — though it is not a precise rule for every individual rabbit.'],
        ['Does spaying or neutering affect lifespan?', 'Spaying a female removes almost all of her lifetime uterine disease risk, and neutering a male reduces fighting- and roaming-related injuries — both can support a longer life.'],
        ['Does indoor versus outdoor housing matter?', 'Yes — a rabbit kept indoors, or outdoors only with real supervision, sidesteps the predator attacks and temperature extremes that cut short the lives of many hutch-only rabbits.'],
        ['Can diet affect how long a rabbit lives?', 'Keeping hay central supports her gut and teeth for years, whereas a bowl leaning too heavily on pellets or treats tends to invite weight gain and digestive trouble.'],
        ['Is the lifespan range the same for every rabbit?', 'No — it is a general range. Breed size, spay/neuter status, housing, and diet all influence where an individual rabbit might fall within or outside that range.'],
    ];
}
