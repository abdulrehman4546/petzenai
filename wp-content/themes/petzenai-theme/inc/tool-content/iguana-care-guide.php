<?php
/**
 * Tool-specific content for: Green Iguana Care Guide: Housing & Diet (registry key: iguana_care_guide).
 * Registry type is 'guide' and uses a dedicated static widget in inc/tool-renderer.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_iguana_care_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> A green iguana grows into a genuinely large lizard, far bigger at maturity than a bearded dragon or leopard gecko, so housing has to be planned around significant adult size rather than a starter-sized tank. Adults are strictly herbivorous, eating only plant matter, unlike the insect-and-vegetable diets of bearded dragons or the insect-only diets of leopard geckos. Iguanas can also be more skittish or defensive than a calmer species like the bearded dragon, using their tail and claws to defend themselves when they feel threatened, and like other basking lizards they need strong UVB lighting.</div>
<?php }

function pz_what_is_iguana_care_guide() {
    ob_start(); ?>
    <p>A green iguana is a large lizard commonly kept as a pet, and its care is shaped heavily by just how big it gets as it matures — considerably larger than a bearded dragon or leopard gecko. That size difference means housing has to be planned for an adult iguana's eventual space needs from early on, not just for the smaller size it starts out at.</p>
    <p>This guide covers that long-term space commitment, the strictly herbivorous diet adult iguanas need, a temperament that can run more skittish or defensive than other commonly kept lizards, and the strong UVB and basking requirements iguanas share with other basking reptiles.</p>
    <?php return ob_get_clean();
}

function pz_why_important_iguana_care_guide() {
    ob_start(); ?>
    <p>Iguana care differs from smaller commonly kept lizards in several ways that matter well before the animal reaches adult size.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">📏</span>
        <div><strong>Adult size is a major space commitment</strong><p>A green iguana grows considerably larger at maturity than a bearded dragon or leopard gecko, so housing needs to be planned around that eventual adult size rather than a starter tank.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🥗</span>
        <div><strong>Adults are strictly herbivorous</strong><p>Unlike the insect-and-vegetable diet of a bearded dragon or the insect-only diet of a leopard gecko, an adult iguana eats only plant matter.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🦎</span>
        <div><strong>Temperament can be more skittish or defensive</strong><p>Compared with a calmer species like the bearded dragon, an iguana can be more easily startled and may use its tail and claws defensively when it feels threatened.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">☀️</span>
        <div><strong>Strong UVB and basking needs</strong><p>As a basking species, an iguana needs strong UVB lighting alongside a proper basking setup, consistent with the needs of other basking lizards.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_iguana_care_guide() {
    return [
        ['title' => 'Plan housing around adult size, not current size', 'desc' => 'A green iguana grows much larger than a bearded dragon or leopard gecko, so space needs should be planned for well before the iguana reaches full size.'],
        ['title' => 'Feed a strictly herbivorous diet to adults', 'desc' => 'Adult iguanas eat only plant matter, which is a different diet from the insect-and-vegetable or insect-only diets of other commonly kept lizards.'],
        ['title' => 'Provide strong UVB lighting and a proper basking area', 'desc' => 'As a basking species, an iguana needs strong UVB alongside a warm basking spot to stay healthy.'],
        ['title' => 'Approach handling with awareness of a more defensive temperament', 'desc' => 'An iguana can be more skittish than a calmer species like the bearded dragon and may use its tail or claws defensively if it feels threatened.'],
        ['title' => 'Give the iguana time to adjust to handling gradually', 'desc' => 'Building familiarity slowly can help reduce defensive reactions compared to rushing handling early on.'],
        ['title' => 'Commit to the iguana\'s long lifespan when planning ownership', 'desc' => 'A green iguana is a long-term commitment, so ownership decisions should account for years of continued care, not just the first year.'],
    ];
}

function pz_tips_iguana_care_guide() {
    return [
        ['Research adult size before building or buying an enclosure', 'Since a green iguana ends up much larger than a bearded dragon or leopard gecko, sizing for the adult avoids a costly upgrade later.'],
        ['Keep the diet strictly plant-based for adults', 'Adding insects to an adult iguana\'s diet doesn\'t match its strictly herbivorous needs as a mature animal.'],
        ['Watch for strong UVB output, not just a basking bulb', 'UVB and basking heat are separate needs, and both matter for an iguana the same way they do for other basking lizards.'],
        ['Move slowly and predictably around a skittish iguana', 'Sudden movements are more likely to trigger a defensive reaction, including tail or claw use, than a calm, gradual approach.'],
        ['Think in years, not months, before bringing one home', 'An iguana\'s long lifespan makes it a bigger long-term commitment than some other commonly kept lizards.'],
    ];
}

function pz_mistakes_iguana_care_guide() {
    return [
        ['❌ Housing an iguana in a tank sized for its current juvenile size', 'Since adult iguanas grow far larger than a bearded dragon or leopard gecko, a juvenile-sized tank quickly becomes inadequate.'],
        ['❌ Feeding insects to an adult iguana as a dietary staple', 'Adult iguanas are strictly herbivorous, unlike the insect-eating diets of other commonly kept lizards.'],
        ['❌ Skipping strong UVB lighting', 'As a basking species, an iguana needs strong UVB, not just basking heat, to stay healthy.'],
        ['❌ Handling roughly or without warning', 'A more skittish, defensive temperament means abrupt handling is more likely to provoke a defensive reaction involving the tail or claws.'],
        ['❌ Underestimating the long-term space and time commitment', 'An iguana\'s eventual size and long lifespan mean it asks for more sustained commitment than some smaller reptile pets.'],
    ];
}

function pz_faq_iguana_care_guide() {
    return [
        ['How big do pet iguanas get?', 'Green iguanas grow considerably larger at maturity than commonly kept lizards like the bearded dragon or leopard gecko, so housing needs to be planned around that adult size.'],
        ['What do iguanas eat?', 'Adult iguanas are strictly herbivorous, eating only plant matter, unlike the insect-and-vegetable or insect-only diets of some other pet lizards.'],
        ['Are iguanas aggressive?', 'They can be more skittish or defensive than a calmer species like the bearded dragon, sometimes using their tail or claws defensively when they feel threatened.'],
        ['Do iguanas need UVB lighting?', 'Yes, as a basking species they need strong UVB lighting alongside proper basking heat.'],
        ['Are iguanas a big commitment?', 'Yes — their eventual large size and long lifespan make them a more significant long-term commitment than some smaller commonly kept lizards.'],
    ];
}
