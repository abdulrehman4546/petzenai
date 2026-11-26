<?php
/**
 * Tool-specific content for: Koi Pond Care Guide: Feeding & Water Quality (registry key: koi_pond_care_guide).
 * Registry type is 'guide' and uses a dedicated static widget in inc/tool-renderer.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_koi_pond_care_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Koi are large, long-lived pond fish, commonly cited as living for decades, that need an outdoor pond with far more space and volume than an indoor aquarium, along with pond-specific filtration and aeration and reduced feeding during cold months.</div>
<?php }

function pz_what_is_koi_pond_care_guide() {
    ob_start(); ?>
    <p>Koi are large ornamental pond fish kept outdoors rather than in an indoor aquarium, which puts them in a different care context than most of the tank-based fish covered elsewhere in this category. A koi pond needs to be sized for fish that grow substantially larger than typical aquarium species, and because it sits outdoors, it is exposed to seasonal temperature swings that an indoor, climate-controlled tank generally is not.</p>
    <p>This guide covers the outdoor pond context: space and volume needs, seasonal care including winterizing and reduced cold-weather feeding, koi's long lifespan, and pond-specific filtration and aeration.</p>
    <?php return ob_get_clean();
}

function pz_why_important_koi_pond_care_guide() {
    ob_start(); ?>
    <p>Treating a koi pond like a larger version of an indoor fish tank misses several outdoor-specific factors that matter for koi health over the long run.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🌊</span>
        <div><strong>Koi need far more space and volume than tank fish</strong><p>Koi grow substantially larger than typical aquarium species, so a pond needs enough space and water volume to support that adult size long-term.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">❄️</span>
        <div><strong>Outdoor ponds face real seasonal temperature swings</strong><p>Unlike an indoor, climate-controlled tank, an outdoor pond experiences the full range of seasonal temperature changes, which affects feeding and overall care through the year.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⏳</span>
        <div><strong>Koi are commonly cited as very long-lived</strong><p>Well-cared-for koi are often described as living for decades, making a koi pond a long-term commitment well beyond that of many aquarium fish.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💨</span>
        <div><strong>Pond filtration and aeration differ from tank setups</strong><p>A pond's much larger water volume and outdoor exposure generally call for pond-specific filtration and aeration equipment rather than scaled-up aquarium gear.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_koi_pond_care_guide() {
    return [
        ['title' => 'Plan pond size around koi\'s adult size', 'desc' => 'Because koi grow large, a pond needs to be sized from the start for their eventual adult size and the number of fish intended.'],
        ['title' => 'Install pond-specific filtration and aeration', 'desc' => 'A pond\'s water volume and outdoor exposure generally call for filtration and aeration equipment designed for ponds rather than adapted aquarium filters.'],
        ['title' => 'Monitor water quality through the seasons', 'desc' => 'Outdoor conditions change through the year, so checking water quality regularly, not just at setup, helps catch seasonal shifts early.'],
        ['title' => 'Reduce feeding as water temperature drops in cold months', 'desc' => 'Koi generally need less food as the water cools, since their metabolism slows down in colder conditions.'],
        ['title' => 'Winterize the pond for the cold season', 'desc' => 'Preparing an outdoor pond for winter, including considerations like keeping part of the surface from fully freezing over, is part of seasonal koi pond care.'],
        ['title' => 'Plan for a multi-decade commitment', 'desc' => 'Given koi\'s commonly cited long lifespan, a pond setup should be planned as a long-term commitment rather than a short-term project.'],
    ];
}

function pz_tips_koi_pond_care_guide() {
    return [
        ['Size the pond for adult koi, not juvenile size', 'Koi purchased small will grow considerably larger, so plan pond volume around their eventual size.'],
        ['Adjust feeding amount with the season', 'Less food is generally needed in cold months as koi\'s metabolism slows with lower water temperature.'],
        ['Check aeration especially in summer and winter extremes', 'Both very warm and very cold conditions can affect oxygen levels in pond water, making reliable aeration important.'],
        ['Have a winterizing routine ready before cold weather arrives', 'Preparing the pond ahead of the cold season is easier than reacting once temperatures have already dropped.'],
        ['Think in decades, not years, when planning a koi pond', 'Koi\'s long commonly cited lifespan means the pond setup and long-term care plan should match that timeframe.'],
    ];
}

function pz_mistakes_koi_pond_care_guide() {
    return [
        ['❌ Building a pond sized only for koi\'s current juvenile size', 'Koi grow substantially larger, so undersizing the pond early on creates problems later.'],
        ['❌ Feeding at the same rate year-round', 'Overfeeding during cold months, when koi\'s metabolism has slowed, can harm water quality and the fish.'],
        ['❌ Treating pond filtration as a scaled-up aquarium filter', 'Pond-specific filtration and aeration are generally needed for the larger volume and outdoor exposure a pond involves.'],
        ['❌ Skipping winterizing preparation', 'An unprepared pond going into cold weather can face problems that proper seasonal preparation helps avoid.'],
        ['❌ Underestimating koi\'s lifespan when planning', 'Koi are commonly cited as living for decades, so a pond is a much longer commitment than many assume at purchase.'],
    ];
}

function pz_faq_koi_pond_care_guide() {
    return [
        ['How big should a koi pond be?', 'A koi pond needs to be sized around koi\'s eventual adult size, not their size at purchase, since they grow substantially larger than typical aquarium fish.'],
        ['How long do koi live?', 'Koi are commonly cited as very long-lived, often described as living for decades with good care.'],
        ['Do koi need less food in winter?', 'Yes, koi generally need reduced feeding in cold months as their metabolism slows with lower water temperature.'],
        ['What does winterizing a koi pond involve?', 'It generally means preparing the pond for cold weather ahead of time, including considerations around keeping part of the surface from fully freezing.'],
        ['Can I use an aquarium filter for a koi pond?', 'Ponds generally need filtration and aeration equipment designed for their larger volume and outdoor exposure rather than adapted aquarium gear.'],
        ['Is a koi pond a bigger commitment than an indoor fish tank?', 'Given koi\'s large adult size, outdoor seasonal care needs, and long lifespan, a koi pond is generally a longer-term and larger-scale commitment.'],
    ];
}
