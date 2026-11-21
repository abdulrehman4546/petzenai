<?php
/**
 * Tool-specific content for: Rabbit Grooming Guide: Brushing & Nail Trimming (registry key: rabbit_grooming_guide).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_rabbit_grooming_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Rabbits groom themselves constantly and generally should not be bathed or submerged in water — brushing a few times a week, more often during heavy shedding seasons, plus regular nail trims covers almost all of what grooming a pet rabbit involves.</div>
<?php }

function pz_what_is_rabbit_grooming_guide() {
    ob_start(); ?>
    <p>Grooming a pet rabbit centers on two tasks you do for her: brushing out loose fur and trimming her nails. Everything else, including keeping her own coat clean day to day, she largely handles herself through near-constant self-grooming.</p>
    <p>One point worth leading with: rabbits are not a species that generally needs or tolerates bathing. Submerging a rabbit in water is stressful for her and can be genuinely risky, so brushing is the main tool for managing loose fur rather than washing it away.</p>
    <p>Because she swallows a lot of loose fur while self-grooming, regular brushing also does double duty — it reduces how much fur she ingests, which matters for keeping her digestion moving normally.</p>
    <?php return ob_get_clean();
}

function pz_why_important_rabbit_grooming_guide() {
    ob_start(); ?>
    <p>Skipping grooming does not just mean a scruffier-looking rabbit — it can show up as digestive and comfort problems she cannot resolve on her own.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🚫</span>
        <div><strong>Bathing is not the answer</strong><p>Submerging or soaking a rabbit is stressful and can be risky for her, so brushing — not water — is how loose fur gets managed.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🪮</span>
        <div><strong>Coat type and season change the brushing schedule</strong><p>A short-coated rabbit needs less frequent brushing than a long-haired breed, and any rabbit needs more attention during a heavy seasonal shed.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🐾</span>
        <div><strong>Overgrown nails affect how she stands and moves</strong><p>Nails left too long can change her posture and gait over time, and are also more prone to snagging and tearing.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🧶</span>
        <div><strong>Swallowed fur is a digestive consideration</strong><p>Constant self-grooming means she is always ingesting some loose fur, and regular brushing reduces how much of that she has to pass through her gut.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_rabbit_grooming_guide() {
    return [
        ['title' => 'Identify her coat type', 'desc' => 'A short, flat coat needs a simple weekly brushing baseline, while a long-haired or dense-coated breed needs more frequent attention to prevent matting.'],
        ['title' => 'Brush a few times a week as a baseline', 'desc' => 'Use a soft brush or grooming glove and work gently in the direction of fur growth, checking for any mats forming near the base of the tail or behind the ears.'],
        ['title' => 'Step up brushing during seasonal sheds', 'desc' => 'Rabbits typically shed more heavily a couple of times a year, and daily brushing during those stretches keeps loose fur from building up on her coat and in your home.'],
        ['title' => 'Trim her nails on a regular schedule', 'desc' => 'Trim just the tip of each nail, avoiding the pink quick, and have a vet or groomer show you the technique the first time if you are unsure.'],
        ['title' => 'Skip the bath', 'desc' => 'Rely on brushing and spot-cleaning with a damp cloth for any localized mess, rather than bathing or submerging her in water.'],
        ['title' => 'Watch for mats or skin issues while you brush', 'desc' => 'Brushing sessions double as a chance to feel for lumps, sore spots, or matted fur that might need closer attention.'],
    ];
}

function pz_tips_rabbit_grooming_guide() {
    return [
        ['Never submerge or fully bathe a rabbit', 'This is one of the clearest differences from dog or cat grooming, and it is worth remembering since it goes against what many new owners expect.'],
        ['Brush more during spring and fall sheds', 'A rabbit\'s coat often turns over heavily during seasonal transitions, and daily brushing then prevents mats and reduces how much fur she swallows.'],
        ['Use a grooming session to check body condition', 'Running your hands over her while brushing is an easy way to notice weight changes or lumps early.'],
        ['Go slow with nail trims', 'Trimming a little at a time and stopping well short of the quick avoids pain and keeps her calmer for the next session.'],
        ['Spot-clean instead of bathing for a dirty patch', 'A damp cloth on a localized mess is safer than a full bath and avoids the stress that comes with submerging her.'],
    ];
}

function pz_mistakes_rabbit_grooming_guide() {
    return [
        ['❌ Bathing or submerging a rabbit in water', 'This is stressful and can be risky for a rabbit, so it should generally be avoided in favor of brushing and spot-cleaning.'],
        ['❌ Brushing on the same fixed schedule all year', 'Coat type and shedding season both change how often brushing is actually needed, so a single fixed schedule misses heavy-shed periods.'],
        ['❌ Letting nails go too long between trims', 'Overgrown nails can affect how she stands and walks and are more prone to tearing.'],
        ['❌ Cutting too close to the quick', 'Trimming too far up the nail can cause pain and bleeding, so trimming small amounts and checking as you go is safer.'],
        ['❌ Ignoring mats until they are severe', 'A small mat caught early is a quick fix, while a large one can require more extensive and uncomfortable removal later.'],
    ];
}

function pz_faq_rabbit_grooming_guide() {
    return [
        ['Can I bathe my rabbit?', 'Generally no — rabbits should not be submerged or fully bathed in water, since it is stressful and can be risky for them. Brushing and spot-cleaning cover almost everything bathing would otherwise be used for.'],
        ['How often should I brush my rabbit?', 'A few times a week is a reasonable baseline, with daily brushing during heavy seasonal shedding, and the exact frequency depends somewhat on her coat type.'],
        ['Do long-haired rabbits need more grooming?', 'Yes — a long-haired or dense-coated breed is more prone to matting and typically needs more frequent brushing than a short-coated rabbit.'],
        ['How often do rabbit nails need trimming?', 'Nails should be checked regularly and trimmed before they grow long enough to change her posture or catch on things, with the exact interval varying rabbit to rabbit.'],
        ['Why does brushing matter for digestion?', 'Rabbits swallow loose fur while self-grooming, and regular brushing reduces how much fur she ends up ingesting, which supports normal digestion.'],
        ['What should I do about a mat in her fur?', 'Work it out gently with a brush or comb while it is still small, and seek help from a vet or groomer if it is tight against the skin or you cannot remove it safely yourself.'],
    ];
}
