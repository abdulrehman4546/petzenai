<?php
/**
 * Tool-specific content for: Budgie (Parakeet) Care Guide for Beginners (registry key: budgie_care_guide).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_budgie_care_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Budgies (also called parakeets in the US) do best in pairs or small flocks rather than alone, need a cage at least 18x18x18 inches with bar spacing no more than about 1/2 inch, and eat a daily mix of pellets and fresh vegetables with seed kept as a smaller part of the diet, not the whole bowl.</div>
<?php }

function pz_what_is_budgie_care_guide() {
    ob_start(); ?>
    <p>This guide covers the basics of caring for a budgie (Melopsittacus undulatus), a small parakeet species that's one of the most commonly kept pet birds. It focuses on what's specific to budgies as a species — their social needs, housing, and diet — rather than general bird advice that applies to any pet bird.</p>
    <p>Budgies are highly social, flock-oriented birds in the wild, which is why a single budgie kept completely alone with no bird company or regular human interaction tends to do worse than one kept with at least one other budgie.</p>
    <p>Because budgies are small and often sold as a simple "starter bird," their actual care needs — enough space, company, and a varied diet — are frequently underestimated compared to larger, more obviously demanding parrot species.</p>
    <?php return ob_get_clean();
}

function pz_why_important_budgie_care_guide() {
    ob_start(); ?>
    <p>Budgies are commonly treated as a low-maintenance first bird, but getting their specific housing, social, and feeding needs right makes a real difference to how well they do long-term.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🐦</span>
        <div><strong>Budgies are flock birds, not solitary ones</strong><p>In the wild, budgies live in large, loose flocks and communicate constantly with other budgies; a single budgie with no bird company and little human interaction can become withdrawn or bored.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🏠</span>
        <div><strong>Small size doesn't mean small space needs</strong><p>Budgies are active, near-constant flyers for their size, so a cage that's technically "big enough" by minimum dimensions but narrow or cramped still limits normal movement.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🗣️</span>
        <div><strong>Budgies are vocal and can learn words</strong><p>Many budgies, especially males, can learn to mimic sounds and short words; this is a sign of an engaged, stimulated bird rather than just a novelty trick.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🌾</span>
        <div><strong>Diet affects a surprisingly long lifespan for their size</strong><p>A well-cared-for budgie can live considerably longer than its small size might suggest, and diet quality over that time has a cumulative effect on health.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_budgie_care_guide() {
    return [
        ['title' => 'House at least two budgies together when possible', 'desc' => 'Budgies are social flock birds and generally do better with at least one other budgie for company, rather than living completely alone.'],
        ['title' => 'Choose a cage with horizontal space to fly', 'desc' => 'Aim for a cage at least 18x18x18 inches with bar spacing no more than about 1/2 inch for a single budgie, and size up for a pair or small flock so each bird still has room to fly short distances rather than just hop between perches.'],
        ['title' => 'Set up varied perches of different diameters', 'desc' => 'Natural branch perches of varying thickness exercise a budgie\'s feet differently than uniform dowel perches, which can cause foot strain if used exclusively.'],
        ['title' => 'Build a daily diet around pellets and fresh vegetables', 'desc' => 'Use pellets as the base, add fresh vegetables daily, and keep seed as a smaller part of the diet rather than the main food.'],
        ['title' => 'Offer daily out-of-cage time in a bird-safe room', 'desc' => 'Supervised time outside the cage in a room with no open windows, ceiling fans, or toxic plants gives a budgie space to fly and explore.'],
        ['title' => 'Watch for changes in activity, droppings, or appetite', 'desc' => 'Budgies can hide illness well since showing weakness is risky in the wild, so a quieter, fluffed-up, or less active budgie should see an avian vet promptly rather than being watched for long.'],
    ];
}

function pz_tips_budgie_care_guide() {
    return [
        ['Introduce new budgies gradually', 'Housing two unfamiliar budgies together immediately can lead to squabbling; a side-by-side introduction period in separate cages first tends to go more smoothly.'],
        ['Rotate toys regularly', 'Budgies can lose interest in a toy that is always there; swapping a few toys in and out periodically keeps the cage more engaging.'],
        ['Talk to and interact with your budgie daily', 'Even a budgie housed with another budgie benefits from regular, calm human interaction, especially if you want it to become comfortable being handled.'],
        ['Keep the cage out of direct drafts and temperature swings', 'Budgies are sensitive to sudden temperature changes, so placement away from air conditioning vents or drafty windows helps keep them comfortable.'],
        ['Provide a consistent day and night light cycle', 'Budgies generally do better with roughly consistent light and dark hours rather than being left under bright light late into the night.'],
        ['Don\'t assume quiet means content', 'A budgie that has gone unusually quiet or still is more often showing early signs of being unwell than simply being calm, especially if it is normally vocal.'],
    ];
}

function pz_mistakes_budgie_care_guide() {
    return [
        ['❌ Keeping a single budgie with little interaction', 'Budgies are flock birds; one kept alone with minimal human or bird company is more likely to become withdrawn or develop behavior issues.'],
        ['❌ Choosing a cage based on budgie size instead of flight space', 'Because budgies are small, owners often pick undersized cages; a budgie needs real horizontal room to fly short distances, not just room to turn around.'],
        ['❌ Feeding mostly or only seed', 'Seed is calorie-dense and nutritionally narrow on its own; pellets and fresh vegetables should make up a larger share of the daily diet.'],
        ['❌ Using only uniform dowel perches', 'Perches that are all the same diameter do not exercise the feet the way varied natural branches do, which can contribute to foot problems over time.'],
        ['❌ Mistaking a quiet, still budgie for a calm one', 'A budgie that is normally active and vocal but becomes unusually quiet or fluffed up is more likely showing an early sign of illness than simply relaxing.'],
    ];
}

function pz_faq_budgie_care_guide() {
    return [
        ['Can I keep just one budgie?', 'You can, but budgies are social flock birds and generally do better with at least one other budgie for company; a solo budgie needs more regular human interaction to compensate.'],
        ['What size cage does a budgie need?', 'At least 18x18x18 inches with bar spacing no more than about 1/2 inch for one budgie — size up for a pair or small flock — and a wider cage that allows short flights is better than the bare minimum.'],
        ['What should budgies eat?', 'A daily diet built around quality pellets and fresh vegetables, with seed kept as a smaller part of the diet rather than the main food.'],
        ['Can budgies learn to talk?', 'Many budgies, particularly males, can learn to mimic short words and sounds, which is generally a sign of an engaged, well-stimulated bird.'],
        ['How do I know if my budgie is sick?', 'Watch for reduced activity, fluffed-up feathers for extended periods, changes in droppings, or reduced appetite — budgies often hide illness until it becomes more obvious.'],
        ['Is a budgie a good first bird?', 'Budgies are commonly chosen as a first bird, but they still need real flight space, social company, and a varied diet, so "easy" does not mean low-effort.'],
        ['How long do budgies typically live?', 'With good care, budgies can live considerably longer than their small size might suggest, which is part of why diet and housing quality matter over that time.'],
    ];
}
