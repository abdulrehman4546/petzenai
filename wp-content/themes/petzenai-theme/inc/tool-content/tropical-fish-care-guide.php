<?php
/**
 * Tool-specific content for: Tropical Fish Care Guide for Beginners (registry key: tropical_fish_care_guide).
 * Registry type changed from generic to a dedicated 'guide' widget (the default guide fallback asks for
 * pet name/age/breed/weight, which makes no sense here). Static widget is
 * pz_render_guide_tropical_fish_care_guide() in inc/tool-renderer.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_tropical_fish_care_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> "Tropical fish" is a broad category defined mainly by needing warm, heated water, commonly cited around 75-80°F, rather than a single species. This page covers what the category has in common — heating needs and basic community-tank compatibility — as a starting point before researching a specific species in depth.</div>
<?php }

function pz_what_is_tropical_fish_care_guide() {
    ob_start(); ?>
    <p>Tropical fish is a broad category covering many different species that share one defining trait: they need warm, heated water, commonly cited around 75-80°F, rather than the cooler conditions a coldwater species like goldfish is kept in. Beyond that shared temperature need, tropical species vary enormously in size, temperament, and specific care requirements.</p>
    <p>This guide is intended as a category-level starting point rather than a deep dive into any single fish. It covers what "tropical" actually means for setup purposes and the basics of building a compatible community tank, so you have a foundation before researching the specific needs of whichever species you choose to keep.</p>
    <?php return ob_get_clean();
}

function pz_why_important_tropical_fish_care_guide() {
    ob_start(); ?>
    <p>Treating "tropical fish" as a single type rather than a broad category is a common source of mismatched expectations for new keepers.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🌡️</span>
        <div><strong>The shared trait is warm water, not a single species</strong><p>Tropical species are commonly kept around 75-80°F — that shared heating need is what defines the category, not any particular look or size.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🧩</span>
        <div><strong>Compatibility varies a lot within the category</strong><p>Two tropical species can both need the same temperature range yet still be a poor match for the same community tank due to temperament or size differences.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">📚</span>
        <div><strong>Category knowledge is a starting point, not a finish line</strong><p>Knowing the general tropical range helps with initial equipment choices, but each species still needs its own specific research.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🚫</span>
        <div><strong>Mixing tropical and coldwater species isn't recommended</strong><p>A coldwater species like goldfish doesn't share the tropical category's warm-water need, so combining the two in one tank typically doesn't work well.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_tropical_fish_care_guide() {
    return [
        ['title' => 'Confirm your chosen species actually falls in the tropical category', 'desc' => 'Check whether it needs the warmer, heated range commonly cited around 75-80°F before assuming standard tropical setup applies.'],
        ['title' => 'Set up a heater and thermometer as the category baseline', 'desc' => 'Since warm water is what defines the tropical category, reliable heating equipment is the first piece of equipment to get right.'],
        ['title' => 'Research compatibility beyond just shared temperature needs', 'desc' => 'Two tropical species sharing the same temperature range can still clash on temperament, size, or activity level in a community tank.'],
        ['title' => 'Start researching your specific species in depth', 'desc' => 'Use this category overview as a baseline, then move to species-specific feeding, tank size, and behavior details for the fish you actually choose.'],
        ['title' => 'Plan stocking around the mix of species you want', 'desc' => 'Building a community tank works best when species are chosen together for compatibility, rather than added one at a time without a plan.'],
        ['title' => 'Avoid combining tropical and coldwater categories', 'desc' => 'A species like goldfish that belongs to the coldwater category generally doesn\'t pair well with tropical tankmates.'],
    ];
}

function pz_tips_tropical_fish_care_guide() {
    return [
        ['Treat "tropical" as a starting filter, not a full care plan', 'It tells you the general temperature category, but not the specific tank size, diet, or temperament of any one species.'],
        ['Research compatibility as its own separate step', 'Shared temperature needs don\'t guarantee two species will get along or thrive together in the same tank.'],
        ['Build a stocking list before buying fish one at a time', 'Planning the full community in advance avoids ending up with mismatched or incompatible species later.'],
        ['Keep the category distinction in mind when reading general advice', 'Advice written for tropical fish broadly may not apply to coldwater species, and vice versa.'],
        ['Use species-specific guides as the next step after this overview', 'This page is meant to be a jumping-off point, not the final word on any single fish\'s care.'],
    ];
}

function pz_mistakes_tropical_fish_care_guide() {
    return [
        ['❌ Assuming "tropical fish" means one specific care routine', 'The category spans many species with different temperaments, sizes, and specific needs beyond the shared warm-water requirement.'],
        ['❌ Stopping research at the category level', 'Knowing the general 75-80°F range is a starting point, not a substitute for researching your specific chosen species.'],
        ['❌ Assuming shared temperature needs mean good compatibility', 'Two tropical species can need the same water temperature yet still be a poor match for the same community tank.'],
        ['❌ Mixing tropical and coldwater species in the same tank', 'Coldwater species like goldfish don\'t share the tropical category\'s warm-water needs, making the pairing generally unsuitable.'],
        ['❌ Buying fish one at a time without a stocking plan', 'Adding species individually without considering overall compatibility can lead to a mismatched community tank.'],
    ];
}

function pz_faq_tropical_fish_care_guide() {
    return [
        ['What does "tropical fish" actually mean?', 'It\'s a broad category of species that need warm, heated water, commonly cited around 75-80°F, rather than a description of any single fish.'],
        ['Do all tropical fish have the same care needs?', 'No — beyond sharing a warm-water temperature need, tropical species vary widely in size, temperament, and specific care requirements.'],
        ['Can any tropical fish live together?', 'Not necessarily — shared temperature needs don\'t guarantee compatibility, so temperament and size still need separate research before combining species.'],
        ['Can tropical fish live with goldfish?', 'Generally not recommended, since goldfish are a coldwater species and don\'t share the tropical category\'s warm-water needs.'],
        ['Where should I go after reading a general tropical fish guide?', 'Move on to researching your specific chosen species in depth, since this type of overview is a starting point rather than complete species-specific care.'],
        ['Do tropical fish need a heater?', 'Yes — needing warm, heated water around the commonly cited 75-80°F range is the defining trait of the tropical category.'],
    ];
}
