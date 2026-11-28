<?php
/**
 * Tool-specific content for: Chinchilla Care Guide: Dust Baths, Diet & Health (registry key: chinchilla_care_guide).
 * Registry type is 'guide' and uses a dedicated static widget in inc/tool-renderer.php.
 * New small-pets cluster, distinct from hamster/gerbil/guinea pig: needs a dust bath rather than water
 * bathing, dense fur prone to overheating, a notably long lifespan for a small rodent, and a very
 * active/jumpy temperament needing vertical space with platforms.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_chinchilla_care_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Chinchillas need regular dust baths rather than water baths — their dense fur traps water and doesn't dry properly, so bathing with chinchilla dust is how they stay clean. That same dense fur also makes them prone to overheating, so keeping their space cool matters more than it does for most small pets. Chinchillas are commonly cited as living notably longer than a hamster, gerbil, or mouse, making them a longer-term commitment. They're also very active and jumpy, so a tall habitat with multiple platforms suits them better than a floor-focused setup.</div>
<?php }

function pz_what_is_chinchilla_care_guide() {
    ob_start(); ?>
    <p>Chinchillas are small rodents known for their dense fur and distinctive dust-bath grooming, and several of their core needs set them apart from other small pets like a <a href="/tools/hamster-care-guide/">hamster</a> or <a href="/tools/gerbil-care-guide/">gerbil</a>.</p>
    <p>This guide covers the dust-bath grooming routine, the overheating risk tied to their dense fur, their comparatively long lifespan, and their active, jumpy temperament that calls for vertical space.</p>
    <?php return ob_get_clean();
}

function pz_why_important_chinchilla_care_guide() {
    ob_start(); ?>
    <p>Chinchillas are rodents, but they have a handful of care needs that set them apart from the other small rodent pets they're often grouped with casually, and getting them wrong can cause real harm.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🏜️</span>
        <div><strong>Dust baths, not water baths</strong><p>A chinchilla's dense fur traps water and doesn't dry out properly, so regular bathing in chinchilla dust, not water, is how they stay clean and healthy.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🌡️</span>
        <div><strong>Prone to overheating</strong><p>That same dense fur that evolved for cold mountain climates makes chinchillas sensitive to warm temperatures, so keeping their environment cool is a genuine health priority.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⏳</span>
        <div><strong>A notably long lifespan for a small rodent</strong><p>Chinchillas are commonly cited as living substantially longer than a hamster, gerbil, or mouse, which matters for the length of commitment involved.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🤸</span>
        <div><strong>Very active and jumpy, needs vertical space</strong><p>Chinchillas move energetically and benefit from a tall habitat with multiple platforms, a different setup priority than the floor-focused space that suits a hamster or gerbil.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_chinchilla_care_guide() {
    return [
        ['title' => 'Provide regular dust baths', 'desc' => 'Offer chinchilla dust in a shallow container on a regular basis rather than bathing with water, since their dense fur can\'t dry out properly if it gets wet.'],
        ['title' => 'Keep the environment cool', 'desc' => 'Because dense fur makes chinchillas prone to overheating, avoid warm rooms and direct sun, and monitor temperature more closely than you would for a hamster or gerbil.'],
        ['title' => 'Set up a tall habitat with platforms', 'desc' => 'Chinchillas are very active and jumpy, so vertical space with multiple levels suits their natural movement better than a floor-focused cage.'],
        ['title' => 'Feed a hay-based diet with a quality commercial food', 'desc' => 'A diet built around fresh hay, supplemented with a food formulated specifically for chinchillas, supports their digestive needs.'],
        ['title' => 'Plan for a long-term commitment', 'desc' => 'Chinchillas are commonly cited as living notably longer than a hamster, gerbil, or mouse, so factor in a longer care horizon when deciding if one fits your household.'],
        ['title' => 'Never bathe a chinchilla in water', 'desc' => 'Water bathing can leave their dense fur damp for too long, which is a real health risk rather than just an inconvenience.'],
    ];
}

function pz_tips_chinchilla_care_guide() {
    return [
        ['Offer dust baths on a regular schedule, not just occasionally', 'Consistent access to chinchilla dust keeps their fur in good condition and is their normal method of staying clean.'],
        ['Watch the room temperature, not just the cage', 'Chinchillas can overheat even in a room that would feel comfortable to a person, because their dense fur is built for a cold climate.'],
        ['Give vertical space, not just floor space', 'A chinchilla\'s jumpy, active nature is better served by platforms and levels than by a wide, flat enclosure.'],
        ['Don\'t expect a short-term pet', 'Chinchillas commonly outlive a hamster, gerbil, or mouse by a wide margin, so plan for a much longer-term commitment.'],
        ['Never use water to clean a chinchilla\'s coat', 'Dust bathing is the correct method; water baths risk leaving the dense fur damp and prone to problems.'],
    ];
}

function pz_mistakes_chinchilla_care_guide() {
    return [
        ['❌ Bathing a chinchilla in water', 'Their dense fur traps water and doesn\'t dry properly, so dust baths, not water, are how chinchillas should be kept clean.'],
        ['❌ Keeping a chinchilla in a warm room', 'Dense fur that evolved for cold climates makes chinchillas prone to overheating, so temperature needs closer attention than with many other small pets.'],
        ['❌ Setting up a flat, floor-only cage', 'Chinchillas are very active and jumpy, so a habitat without vertical platforms doesn\'t match their natural movement needs.'],
        ['❌ Treating a chinchilla as a short-term pet', 'Chinchillas are commonly cited as living notably longer than a hamster, gerbil, or mouse, so underestimating the commitment can lead to mismatched expectations.'],
        ['❌ Skipping dust baths because they seem messy', 'Regular dust bathing is a genuine health need, not an optional extra, for keeping a chinchilla\'s coat in good condition.'],
    ];
}

function pz_faq_chinchilla_care_guide() {
    return [
        ['Can I bathe my chinchilla in water?', 'No. Chinchillas need dust baths instead of water baths, since their dense fur traps water and doesn\'t dry out properly, which can cause health problems.'],
        ['Why does my chinchilla seem sensitive to heat?', 'Chinchillas have dense fur adapted for cold mountain climates, which makes them prone to overheating in warm environments, so keeping their space cool matters more than for most small pets.'],
        ['How long do chinchillas live compared to other small pets?', 'Chinchillas are commonly cited as living notably longer than a hamster, gerbil, or mouse, making them a longer-term commitment.'],
        ['Does a chinchilla need a tall cage?', 'Yes. Chinchillas are very active and jumpy, so a tall habitat with multiple platforms suits them better than a flat, floor-focused setup.'],
        ['How often should I give my chinchilla a dust bath?', 'On a regular basis — consistent access to chinchilla dust is their normal way of staying clean and keeping their coat in good condition.'],
    ];
}
