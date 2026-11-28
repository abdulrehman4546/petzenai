<?php
/**
 * Tool-specific content for: Guinea Pig Care Guide: Diet, Housing & Health (registry key: guinea_pig_care_guide).
 * Registry type is 'guide' and uses a dedicated static widget in inc/tool-renderer.php.
 * New small-pets cluster, distinct from hamster: social/herd species that does better in pairs or groups
 * (direct contrast to the hamster's solitary requirement), needs dietary vitamin C unlike most small
 * mammals, and is commonly cited as living longer than a hamster.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_guinea_pig_care_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Guinea pigs are social animals that generally do better living in pairs or small groups, the opposite of a Syrian hamster's strict solitary housing requirement. They need a dietary source of vitamin C, since unlike most small pets they can't produce their own, so fresh vegetables and a fortified commercial diet matter. Guinea pigs also tend to live longer than hamsters, commonly cited as several years rather than a couple. They need a roomy, flat-floored cage with hiding spots and a steady supply of hay.</div>
<?php }

function pz_what_is_guinea_pig_care_guide() {
    ob_start(); ?>
    <p>Guinea pigs are a popular small pet with a noticeably different social structure than a <a href="/tools/hamster-care-guide/">hamster</a> — where Syrian hamsters must be housed strictly alone, guinea pigs are a social, herd-oriented species that generally does better with companionship.</p>
    <p>This guide covers the housing, social, and dietary basics, including the vitamin C requirement that sets guinea pigs apart from most other small mammals, and how their typical lifespan compares to a hamster's.</p>
    <?php return ob_get_clean();
}

function pz_why_important_guinea_pig_care_guide() {
    ob_start(); ?>
    <p>Guinea pigs have a few genuinely distinct needs that make their care meaningfully different from other small pets, even ones they're often compared to.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">👥</span>
        <div><strong>Social housing is the opposite of a hamster's needs</strong><p>Guinea pigs generally do better living in pairs or small groups, a direct contrast to the strict solitary housing a Syrian hamster requires.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🥬</span>
        <div><strong>Vitamin C has to come from their diet</strong><p>Unlike most small pets, guinea pigs can't produce their own vitamin C internally, so a diet with a consistent dietary source, through fresh vegetables and a fortified commercial food, is genuinely important rather than a nice extra.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⏳</span>
        <div><strong>Generally a longer lifespan than a hamster</strong><p>Guinea pigs are commonly cited as living noticeably longer than hamsters, which matters for the level of long-term commitment involved compared to other small pets.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🌾</span>
        <div><strong>Hay is a constant, not an occasional treat</strong><p>A steady, unlimited supply of fresh hay supports digestion and dental health continuously, rather than being an add-on to a pelleted diet.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_guinea_pig_care_guide() {
    return [
        ['title' => 'Plan for a pair or small group rather than a single guinea pig', 'desc' => 'As a social, herd-oriented species, guinea pigs generally do better with companionship than living alone, the opposite of a Syrian hamster\'s solitary requirement.'],
        ['title' => 'Set up a roomy, flat-floored cage', 'desc' => 'Guinea pigs don\'t climb the way some other small pets do, so prioritize open floor space with hiding spots over vertical levels.'],
        ['title' => 'Keep hay available at all times', 'desc' => 'A constant supply of fresh hay supports digestion and dental health and should make up the bulk of the diet, not just an occasional addition.'],
        ['title' => 'Provide a daily dietary source of vitamin C', 'desc' => 'Since guinea pigs can\'t make their own vitamin C, fresh vegetables and a fortified commercial pellet formulated for guinea pigs specifically should be offered consistently.'],
        ['title' => 'Offer fresh vegetables alongside hay and pellets', 'desc' => 'A rotating variety of guinea-pig-safe vegetables adds both nutrition and enrichment to a hay-and-pellet base diet.'],
        ['title' => 'Plan for a multi-year commitment', 'desc' => 'Guinea pigs commonly live longer than hamsters, so factor in a longer care commitment when deciding if one is the right pet for your household.'],
    ];
}

function pz_tips_guinea_pig_care_guide() {
    return [
        ['Introduce new guinea pigs to each other carefully', 'Even though they\'re social animals, pairing guinea pigs still benefits from a gradual, supervised introduction rather than placing strangers directly together.'],
        ['Don\'t apply hamster housing rules to guinea pigs', 'Where a Syrian hamster needs strict solitary housing, a guinea pig\'s social needs point in the opposite direction, toward companionship.'],
        ['Choose a commercial food formulated specifically for guinea pigs', 'Foods made for other small pets, like rabbits or hamsters, aren\'t fortified with the vitamin C a guinea pig\'s diet needs.'],
        ['Rotate fresh vegetables rather than feeding the same one repeatedly', 'Variety supports a more balanced diet and keeps mealtime more enriching.'],
        ['Expect a longer-term pet than a hamster', 'Guinea pigs commonly live several years, so plan their care as a multi-year commitment rather than a short-term one.'],
    ];
}

function pz_mistakes_guinea_pig_care_guide() {
    return [
        ['❌ Keeping a guinea pig alone by default', 'Guinea pigs are a social species that generally does better with companionship, unlike a Syrian hamster, which must be housed alone.'],
        ['❌ Relying on pellets alone without a steady hay supply', 'Hay should make up the bulk of a guinea pig\'s diet continuously, not act as an occasional supplement to pellets.'],
        ['❌ Assuming any small-pet food covers vitamin C needs', 'Guinea pigs need a diet with a reliable vitamin C source; food formulated for other small pets, like hamsters or rabbits, isn\'t fortified the same way.'],
        ['❌ Prioritizing cage height over floor space', 'Guinea pigs are ground-dwelling and benefit far more from open floor area than from vertical climbing structures.'],
        ['❌ Underestimating the length of commitment', 'Because guinea pigs commonly live longer than hamsters, treating the decision to get one as a short-term commitment can lead to mismatched expectations.'],
    ];
}

function pz_faq_guinea_pig_care_guide() {
    return [
        ['Should guinea pigs be kept alone or in pairs?', 'Guinea pigs generally do better in pairs or small groups, since they\'re a social, herd-oriented species — the opposite of a Syrian hamster, which must be housed strictly alone.'],
        ['Do guinea pigs need vitamin C in their diet?', 'Yes. Unlike most small pets, guinea pigs can\'t produce their own vitamin C, so it needs to come from a consistent dietary source such as fresh vegetables and a fortified commercial food made for guinea pigs specifically.'],
        ['How long do guinea pigs live compared to hamsters?', 'Guinea pigs are commonly cited as living noticeably longer than hamsters, making them a longer-term commitment than some other small pets.'],
        ['How much hay does a guinea pig need?', 'A steady, essentially unlimited supply of fresh hay should make up the bulk of a guinea pig\'s diet, supporting both digestion and dental health.'],
        ['Can I feed a guinea pig the same food as a hamster or rabbit?', 'No — guinea pigs need a food specifically fortified with vitamin C, which food formulated for other small pets typically isn\'t.'],
    ];
}
