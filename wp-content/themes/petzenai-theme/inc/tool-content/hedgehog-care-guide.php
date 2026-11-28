<?php
/**
 * Tool-specific content for: Hedgehog Care Guide: Diet, Housing & Health (registry key: hedgehog_care_guide).
 * Registry type is 'guide' and uses a dedicated static widget in inc/tool-renderer.php.
 * New small-pets cluster, distinct from every other animal in this cluster: an insectivore rather than a
 * rodent, solitary, nocturnal, known for curling into a spiked ball as defense, and temperature-sensitive
 * in a way that can trigger unwanted attempted hibernation if kept too cold.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_hedgehog_care_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Pet hedgehogs are insectivores, not rodents, a fundamentally different category from the hamsters, gerbils, and chinchillas they're sometimes grouped with. They're a solitary species that should be housed alone, and they're nocturnal, most active at night. Their signature defense is curling into a tight, spiked ball when they feel threatened. Hedgehogs are also notably temperature-sensitive — if kept too cold, a pet hedgehog can attempt to hibernate, which is dangerous and not something you want to happen, unlike the normal, expected dormancy seen in some reptiles.</div>
<?php }

function pz_what_is_hedgehog_care_guide() {
    ob_start(); ?>
    <p>Pet hedgehogs are small insectivorous mammals, not rodents, which puts them in a genuinely different category from the other small pets in this cluster, such as a <a href="/tools/hamster-care-guide/">hamster</a> or <a href="/tools/gerbil-care-guide/">gerbil</a>.</p>
    <p>This guide covers their insectivore diet, solitary and nocturnal nature, their spiked-ball defense behavior, and the temperature sensitivity that can lead to a dangerous attempted hibernation if they're kept too cold.</p>
    <?php return ob_get_clean();
}

function pz_why_important_hedgehog_care_guide() {
    ob_start(); ?>
    <p>Hedgehogs have several traits that set them apart from every other small pet in this cluster, and a couple of them carry real health stakes if misunderstood.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🐛</span>
        <div><strong>An insectivore, not a rodent</strong><p>Unlike hamsters, gerbils, chinchillas, and mice, a hedgehog's natural diet centers on insects, which is a core taxonomic and dietary difference, not just a surface one.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🚫</span>
        <div><strong>Solitary, like a Syrian hamster</strong><p>Hedgehogs should be housed alone, matching the solitary housing rule established for a Syrian hamster rather than the social pairing some other small pets need.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🌙</span>
        <div><strong>Nocturnal, with a signature ball defense</strong><p>Hedgehogs are most active at night and are known for curling into a tight, spiked ball when they feel threatened, a defense mechanism specific to the species.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🌡️</span>
        <div><strong>Cold can trigger dangerous attempted hibernation</strong><p>A pet hedgehog kept too cold can attempt to hibernate, which is unwanted and dangerous for a captive hedgehog — the opposite of the normal, expected dormancy some reptiles go through.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_hedgehog_care_guide() {
    return [
        ['title' => 'Feed an insectivore-appropriate diet', 'desc' => 'Choose a food formulated for hedgehogs rather than a standard hamster or gerbil mix, since a hedgehog\'s nutritional needs center on insects rather than the mostly plant-based diets those rodents eat.'],
        ['title' => 'House your hedgehog alone', 'desc' => 'Hedgehogs are a solitary species and should be kept by themselves, similar to the solitary housing rule for a Syrian hamster.'],
        ['title' => 'Keep the habitat consistently warm', 'desc' => 'Avoid letting the temperature drop too low, since a cold pet hedgehog can attempt to hibernate, which is dangerous rather than a normal, expected rest state.'],
        ['title' => 'Plan around nighttime activity', 'desc' => 'Hedgehogs are nocturnal and most active at night, so handling and enrichment generally fit better in the evening than during the day.'],
        ['title' => 'Give your hedgehog time to uncurl on its own', 'desc' => 'Curling into a spiked ball is a normal defense response to feeling threatened, so let a startled hedgehog relax at its own pace rather than forcing it open.'],
        ['title' => 'Monitor room temperature closely', 'desc' => 'Because of the hibernation risk, checking ambient temperature matters more for a hedgehog than it does for most other small pets in this cluster.'],
    ];
}

function pz_tips_hedgehog_care_guide() {
    return [
        ['Don\'t assume hedgehog food is the same as rodent food', 'Hedgehogs are insectivores, not rodents, so their nutritional needs differ from a hamster\'s or gerbil\'s plant-leaning diet.'],
        ['Keep your hedgehog housed alone', 'Hedgehogs are solitary, so a companion isn\'t a kindness here, similar to the solitary rule for a Syrian hamster.'],
        ['Watch the thermostat, not just the cage thermometer', 'A pet hedgehog that gets too cold can attempt to hibernate, which is a genuine danger rather than a normal rest period.'],
        ['Let a curled-up hedgehog relax in its own time', 'Curling into a spiked ball is a natural defense reaction, so patience works better than trying to force it to uncurl.'],
        ['Expect nighttime activity', 'Hedgehogs are nocturnal, so don\'t expect much activity during the day the way you might from a more diurnal small pet.'],
    ];
}

function pz_mistakes_hedgehog_care_guide() {
    return [
        ['❌ Feeding a diet built for rodents', 'Hedgehogs are insectivores, not rodents, so a food designed for a hamster or gerbil doesn\'t match their natural dietary needs.'],
        ['❌ Housing a hedgehog with a companion', 'Hedgehogs are solitary and should be kept alone, the same housing rule that applies to a Syrian hamster.'],
        ['❌ Letting the habitat get too cold', 'A cold pet hedgehog can attempt to hibernate, which is dangerous and not a normal or expected state the way dormancy can be for some reptiles.'],
        ['❌ Forcing a curled-up hedgehog to open', 'Curling into a ball is a natural defense response to feeling threatened, so forcing it open rather than letting it relax on its own adds unnecessary stress.'],
        ['❌ Expecting daytime activity', 'Hedgehogs are nocturnal, so treating a quiet, inactive daytime hedgehog as a problem misreads a normal activity pattern.'],
    ];
}

function pz_faq_hedgehog_care_guide() {
    return [
        ['Are hedgehogs rodents?', 'No. Pet hedgehogs are insectivores, a fundamentally different category from rodents like hamsters, gerbils, chinchillas, and mice.'],
        ['Should a pet hedgehog have a companion?', 'No. Hedgehogs are solitary and should be housed alone, the same rule that applies to a Syrian hamster rather than to a social species like a gerbil or guinea pig.'],
        ['Why does my hedgehog curl into a ball?', 'Curling into a tight, spiked ball is a hedgehog\'s natural defense mechanism when it feels threatened, and it\'s best to let it relax on its own rather than forcing it open.'],
        ['Can a pet hedgehog hibernate?', 'It can attempt to if kept too cold, but this is dangerous for a captive hedgehog, not a normal or desirable state — the opposite of the expected, normal dormancy some reptiles go through.'],
        ['Are hedgehogs active during the day or at night?', 'Hedgehogs are nocturnal and most active at night, so plan handling and enrichment for the evening rather than daytime.'],
    ];
}
