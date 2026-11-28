<?php
/**
 * Tool-specific content for: Aquarium Live Plants Guide for Beginners (registry key: aquarium_live_plants_guide).
 * Registry type is 'guide' and uses a dedicated static widget in inc/tool-renderer.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_aquarium_live_plants_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Live plants generally need brighter, more specific lighting than a fish-only tank, along with a nutrient source either from the substrate or the water column depending on the plant type. CO2 supplementation is an advanced option, not something a beginner planted tank needs to start with, and a well-growing plant mass can help take up some of the nitrate a tank produces.</div>
<?php }

function pz_what_is_aquarium_live_plants_guide() {
    ob_start(); ?>
    <p>A live-plant aquarium adds real, growing plants to the tank rather than plastic or silk decorations. Beyond appearance, live plants have their own light and nutrient needs that differ from a fish-only setup, and different species get most of their nutrients either through their roots in the substrate or directly from the water column through their leaves.</p>
    <p>This guide covers the basics of what a beginner planted tank needs to get started: lighting, substrate versus water-column feeding, where CO2 supplementation fits in, and how a healthy plant mass relates to the tank's nitrate levels.</p>
    <?php return ob_get_clean();
}

function pz_why_important_aquarium_live_plants_guide() {
    ob_start(); ?>
    <p>Choosing the right lighting and feeding approach for live plants makes the difference between plants that thrive and ones that struggle, melt, or simply stall out.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">💡</span>
        <div><strong>Live plants generally need more light than a fish-only tank</strong><p>A planted tank typically calls for brighter or more targeted lighting for photosynthesis than fish alone would require.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🌱</span>
        <div><strong>Plants feed through roots, leaves, or both</strong><p>Some species draw most of their nutrients from a nutrient-rich substrate through their roots, while others absorb nutrients mainly through their leaves from the water column.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🫧</span>
        <div><strong>CO2 supplementation is an advanced add-on, not a beginner requirement</strong><p>Many low-light, easy-care plants grow reasonably well without supplemental CO2, so it's generally worth starting without it rather than treating it as mandatory.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🧪</span>
        <div><strong>A healthy plant mass can help take up nitrate</strong><p>Growing plants use some of the nitrate a tank produces as a nutrient source, which can be a helpful complement to regular maintenance, though it doesn't replace it.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_aquarium_live_plants_guide() {
    return [
        ['title' => 'Pick beginner-friendly, low-light plant species first', 'desc' => 'Easy-care species tend to tolerate a wider range of lighting and nutrient conditions than more demanding plants.'],
        ['title' => 'Match lighting to the plants chosen', 'desc' => 'Live plants generally need brighter or more specific lighting than a fish-only tank to support photosynthesis.'],
        ['title' => 'Decide whether a nutrient-rich substrate is needed', 'desc' => 'Root-feeding plants benefit from a substrate that supplies nutrients, while water-column feeders rely less on what\'s under them.'],
        ['title' => 'Hold off on CO2 supplementation at first', 'desc' => 'Starting with low-light, easy species that don\'t demand CO2 keeps the setup simpler while you learn the basics.'],
        ['title' => 'Watch how plants respond over the first few weeks', 'desc' => 'Melting leaves or stalled growth can signal a mismatch in lighting or nutrients that\'s worth adjusting.'],
        ['title' => 'Let plant growth complement, not replace, routine maintenance', 'desc' => 'Plants taking up some nitrate is a helpful bonus, but regular water changes and testing still matter.'],
    ];
}

function pz_tips_aquarium_live_plants_guide() {
    return [
        ['Start with a few hardy, low-light species', 'This keeps lighting and nutrient demands manageable while you get a feel for how plants behave in your tank.'],
        ['Match a plant species to its typical feeding style', 'Knowing whether a plant relies more on root uptake or water-column uptake helps you decide if a nutrient substrate is worth it.'],
        ['Treat CO2 as something to add later, not a day-one requirement', 'Many popular beginner plants grow without it, so there\'s no need to invest in CO2 equipment right away.'],
        ['Give new plants time to adjust before judging them', 'Some initial melting or slow growth after planting is common as a plant adapts to new water and lighting.'],
        ['Don\'t expect plants alone to solve a nitrate problem', 'Plant uptake of nitrate is a helpful addition to a maintenance routine, not a substitute for water changes.'],
    ];
}

function pz_mistakes_aquarium_live_plants_guide() {
    return [
        ['❌ Using fish-only lighting on a planted tank', 'Live plants generally need brighter or more specific lighting than fish alone, so under-lighting is a common cause of poor growth.'],
        ['❌ Assuming every plant needs a nutrient-rich substrate', 'Some species absorb most of what they need from the water column through their leaves, so a heavy substrate isn\'t always necessary.'],
        ['❌ Jumping straight to CO2 supplementation as a beginner', 'CO2 is an advanced tool best added once you\'re comfortable with the basics, not a requirement for getting started.'],
        ['❌ Giving up on a plant after early melting or slow growth', 'A brief adjustment period after planting is common, and some species recover and grow well afterward.'],
        ['❌ Skipping water changes because plants are growing well', 'Plant nitrate uptake helps, but it doesn\'t fully replace regular maintenance.'],
    ];
}

function pz_faq_aquarium_live_plants_guide() {
    return [
        ['Do live plants need more light than fish?', 'Generally yes — a planted tank typically needs brighter or more specific lighting than a fish-only setup to support photosynthesis.'],
        ['Do all aquarium plants need a special substrate?', 'No, it depends on the species — some rely mainly on root feeding from a nutrient-rich substrate, while others absorb nutrients through their leaves from the water column.'],
        ['Do beginners need CO2 supplementation for a planted tank?', 'Not necessarily — many easy-care, low-light plants grow reasonably well without added CO2, which is more of an advanced option.'],
        ['Can live plants help with nitrate levels?', 'Growing plants do take up some nitrate as a nutrient source, which can complement routine maintenance, though it doesn\'t replace water changes.'],
        ['Why are my new plants melting after I plant them?', 'Some initial melting or slow growth while a plant adjusts to new water and lighting conditions is common and not always a sign of failure.'],
    ];
}
