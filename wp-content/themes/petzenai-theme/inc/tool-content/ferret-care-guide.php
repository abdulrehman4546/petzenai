<?php
/**
 * Tool-specific content for: Ferret Care Guide: Diet, Housing & Training (registry key: ferret_care_guide).
 * Registry type is 'guide' and uses a dedicated static widget in inc/tool-renderer.php.
 * New small-pets cluster, distinct from hamster/guinea pig: obligate carnivore diet (not plant-based),
 * highly active with long sleep periods between bursts, musky odor (descenting nuanced point, no
 * medical/procedural advice), and a curious, mischievous temperament prone to stealing/hiding objects.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_ferret_care_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Ferrets are obligate carnivores, needing a meat-based diet, a fundamentally different nutritional need from the largely plant-based diets of hamsters and guinea pigs. They're highly active and playful in bursts, with long sleep periods in between rather than a steady activity level throughout the day. Ferrets have a naturally musky odor, and while descenting is sometimes done, it's increasingly viewed as unnecessary with modern diets and husbandry rather than a routine requirement. They're also notoriously curious and mischievous, with a strong tendency to steal and hide small objects.</div>
<?php }

function pz_what_is_ferret_care_guide() {
    ob_start(); ?>
    <p>Ferrets are a small carnivorous mammal kept as pets, and their care differs in fundamental ways from other small pets like a <a href="/tools/hamster-care-guide/">hamster</a> or <a href="/tools/guinea-pig-care-guide/">guinea pig</a> — most importantly, ferrets need a meat-based diet rather than the plant-based diets those species rely on.</p>
    <p>This guide covers the obligate carnivore diet, the bursty activity pattern of long naps punctuated by energetic play, the musky odor ferrets are known for, and their famously curious, mischievous personality.</p>
    <?php return ob_get_clean();
}

function pz_why_important_ferret_care_guide() {
    ob_start(); ?>
    <p>Ferrets have a handful of traits that are genuinely different from the rodent small pets they're sometimes grouped with casually, and understanding them matters before bringing one home.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🥩</span>
        <div><strong>Ferrets are obligate carnivores</strong><p>Unlike the largely plant-based diets of a hamster or guinea pig, a ferret's diet needs to be meat-based, a core distinguishing fact that shapes what food is appropriate.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💤</span>
        <div><strong>Long naps between bursts of intense activity</strong><p>Ferrets are known for sleeping for extended periods and then becoming highly energetic and playful in short bursts, a distinct activity pattern from steadier small pets.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">👃</span>
        <div><strong>A naturally musky odor is normal</strong><p>Ferrets have a distinct musky smell as part of their normal biology; descenting is sometimes performed but is increasingly viewed as unnecessary, especially with good diet and husbandry, rather than something every ferret needs.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🕵️</span>
        <div><strong>Famously curious and mischievous</strong><p>Ferrets have a strong, well-known tendency to investigate, steal, and hide small objects around the house, a behavioral trait specific to the species that owners should plan around.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_ferret_care_guide() {
    return [
        ['title' => 'Feed a meat-based, obligate carnivore diet', 'desc' => 'Choose a food formulated specifically for ferrets rather than one designed for a plant-eating small pet like a hamster or guinea pig.'],
        ['title' => 'Set up a secure, ferret-proofed space', 'desc' => 'Given their curious, mischievous nature and tendency to squeeze into small gaps, a ferret\'s space needs to be checked carefully for escape routes and small hazards they could get into.'],
        ['title' => 'Plan around their activity pattern', 'desc' => 'Expect long naps punctuated by bursts of energetic play, and give ferrets supervised time out of their housing during their active periods.'],
        ['title' => 'Accept a natural musky odor as normal', 'desc' => 'A certain amount of musky smell is simply part of having a ferret; regular cleaning and good diet help manage it without needing to assume descenting is required.'],
        ['title' => 'Provide enrichment for their curious nature', 'desc' => 'Tunnels, digging boxes, and rotating toys give a mischievous, investigative ferret an appropriate outlet rather than letting boredom lead to stealing or hiding household items.'],
        ['title' => 'Keep small, swallowable objects out of reach', 'desc' => 'Ferrets are known for grabbing and hiding small items, so keeping stray objects off the floor reduces both mess and ingestion risk.'],
    ];
}

function pz_tips_ferret_care_guide() {
    return [
        ['Don\'t feed a ferret food made for hamsters or guinea pigs', 'Those diets are largely plant-based, while a ferret is an obligate carnivore that needs a meat-based food formulated for its specific nutritional needs.'],
        ['Expect bursts of energy, not steady activity all day', 'A ferret napping heavily for long stretches is normal; the energy shows up in concentrated bursts of play rather than being spread evenly throughout the day.'],
        ['Don\'t assume odor means something is wrong', 'A natural musky smell is part of normal ferret biology, and it can often be managed through regular cleaning and diet without assuming a medical issue or that descenting is necessary.'],
        ['Keep track of small items left within reach', 'Ferrets are well known for stealing and hiding small objects, so a quick habit of keeping stray items off the floor saves both frustration and potential hazards.'],
        ['Provide supervised exploration time', 'Given their curious nature, ferrets benefit from regular supervised time to explore outside their housing rather than staying confined most of the day.'],
    ];
}

function pz_mistakes_ferret_care_guide() {
    return [
        ['❌ Feeding a largely plant-based small-pet diet', 'A ferret is an obligate carnivore and needs a meat-based diet, unlike the largely plant-based diets suited to a hamster or guinea pig.'],
        ['❌ Leaving small objects within reach', 'Ferrets have a strong tendency to steal and hide small items, which can lead to lost belongings or ingestion hazards if not managed.'],
        ['❌ Assuming a sleepy ferret is inactive or unwell', 'Long naps between bursts of play are a normal activity pattern for ferrets, not necessarily a sign of lethargy or illness.'],
        ['❌ Assuming descenting is always necessary', 'Descenting is sometimes performed but is increasingly viewed as unnecessary, particularly with good diet and husbandry, rather than a routine requirement for every ferret.'],
        ['❌ Underestimating how ferret-proof a space needs to be', 'Their curious, exploratory nature means gaps, loose items, and unsecured areas that wouldn\'t concern other small pets can become real issues with a ferret.'],
    ];
}

function pz_faq_ferret_care_guide() {
    return [
        ['What do ferrets eat?', 'Ferrets are obligate carnivores and need a meat-based diet formulated specifically for them, a fundamentally different nutritional need from the largely plant-based diets of a hamster or guinea pig.'],
        ['Are ferrets nocturnal?', 'Ferrets aren\'t strictly nocturnal; they\'re known for long sleep periods punctuated by bursts of intense, energetic play, rather than a steady activity level spread evenly across the day.'],
        ['Do ferrets smell bad?', 'Ferrets have a naturally musky odor as part of their normal biology. Regular cleaning and good diet help manage it, and descenting, while sometimes performed, is increasingly viewed as unnecessary rather than something every ferret needs.'],
        ['Why do ferrets steal things?', 'Ferrets have a famously curious, mischievous temperament and a strong instinct to investigate, steal, and hide small objects, a behavioral trait the species is well known for.'],
        ['Can I feed my ferret the same food as my hamster or guinea pig?', 'No — those are largely plant-based diets, while a ferret is an obligate carnivore that needs a meat-based food formulated for its specific nutritional requirements.'],
    ];
}
