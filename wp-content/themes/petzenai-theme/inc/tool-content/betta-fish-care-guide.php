<?php
/**
 * Tool-specific content for: Betta Fish Care Guide: Tank, Diet & Health (registry key: betta_fish_care_guide).
 * Registry type changed from generic to a dedicated 'guide' widget (the default guide fallback asks for
 * pet name/age/breed/weight, which makes no sense here). Static widget is
 * pz_render_guide_betta_fish_care_guide() in inc/tool-renderer.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_betta_fish_care_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Bettas are solitary, territorial fish — males in particular will fight if housed together and generally need to live alone. Despite the common myth of keeping them in small unheated bowls, bettas are a tropical species and need a heater to stay in a warm, stable range, even though their labyrinth organ lets them also gulp air at the surface.</div>
<?php }

function pz_what_is_betta_fish_care_guide() {
    ob_start(); ?>
    <p>Betta fish care centers on a few traits that set this species apart from many other small aquarium fish. Bettas are solitary and territorial by nature, especially males, which will flare at and fight each other if housed in the same tank. A betta's labyrinth organ lets it gulp air directly from the surface, which is part of why older advice sometimes claimed they could live in tiny, unheated containers.</p>
    <p>That advice is a common misconception. A betta is a tropical fish and needs a heater to hold a warm, stable temperature, regardless of the labyrinth organ. This guide covers housing one betta at a time, heating correctly, and recognizing flaring as a normal display and stress signal rather than a health problem on its own.</p>
    <?php return ob_get_clean();
}

function pz_why_important_betta_fish_care_guide() {
    ob_start(); ?>
    <p>Misreading a betta's unusual biology is one of the most common ways new keepers unintentionally cause stress or injury.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🥊</span>
        <div><strong>Males are territorial and generally should live alone</strong><p>Housing two male bettas together commonly leads to fighting, and even pairing with other species calls for careful compatibility research.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💨</span>
        <div><strong>The labyrinth organ doesn't remove the need for heat</strong><p>Being able to gulp surface air helps a betta tolerate lower-oxygen water, but it has nothing to do with temperature — a heater is still necessary.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🩹</span>
        <div><strong>Small, unheated bowls commonly lead to fin damage</strong><p>Cold, cramped conditions stress bettas and are frequently linked to torn or deteriorating fins in beginner setups.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🎭</span>
        <div><strong>Flaring is a display and stress signal, not a disease</strong><p>Spreading fins and gill covers at a reflection, another fish, or a perceived threat is normal betta behavior, though frequent flaring can indicate ongoing stress.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_betta_fish_care_guide() {
    return [
        ['title' => 'House one betta alone unless you have researched compatible tankmates', 'desc' => 'Males especially will fight each other, so a single-betta setup is the simplest and safest starting point.'],
        ['title' => 'Install a heater sized for your tank', 'desc' => 'Bettas are tropical fish and need a heater to maintain a warm, stable temperature — the labyrinth organ does not replace this requirement.'],
        ['title' => 'Choose a tank larger than the old small-bowl standard', 'desc' => 'A roomier tank gives more stable water parameters and swimming space than the cramped containers bettas were once mistakenly kept in.'],
        ['title' => 'Avoid strong, direct-blast filtration', 'desc' => 'Bettas have long, delicate fins and generally do better with gentler water flow rather than a powerful current pushing them around.'],
        ['title' => 'Watch for flaring patterns, not just isolated incidents', 'desc' => 'Occasional flaring at a reflection is normal display behavior; frequent or constant flaring is more worth investigating as a stress signal.'],
        ['title' => 'Check fins regularly for damage or deterioration', 'desc' => 'Catching early fin damage lets you address likely causes, such as temperature or water quality, before it worsens.'],
    ];
}

function pz_tips_betta_fish_care_guide() {
    return [
        ['Don\'t rely on the labyrinth organ as a reason to skip a heater', 'Surface air-gulping solves an oxygen problem, not a temperature one — tropical warmth is still required.'],
        ['Research tankmate compatibility carefully before adding other fish', 'Not every species pairs well with a betta\'s temperament, and some combinations commonly lead to fin nipping or stress.'],
        ['Provide some cover or plants for a sense of security', 'A betta that has places to retreat to may display calmer, less constantly defensive behavior.'],
        ['Keep an eye on fin edges after any tankmate introduction', 'New fin damage shortly after adding another fish is a useful early clue about incompatibility.'],
        ['Avoid tapping the glass or encouraging constant flaring for entertainment', 'Repeated provoked flaring can add unnecessary stress even though occasional natural flaring is normal.'],
    ];
}

function pz_mistakes_betta_fish_care_guide() {
    return [
        ['❌ Keeping a betta in a small bowl with no heater', 'This outdated approach misunderstands the labyrinth organ and leaves the fish in cold, cramped conditions it isn\'t suited for.'],
        ['❌ Housing two male bettas together', 'Males are territorial and will typically fight, often leading to serious injury.'],
        ['❌ Assuming the labyrinth organ means heating doesn\'t matter', 'Surface air access addresses oxygen, not temperature — bettas still need a tropical heated range.'],
        ['❌ Using high-flow filtration meant for more active swimmers', 'Strong currents can exhaust and damage the fins of a betta\'s slower, more deliberate swimming style.'],
        ['❌ Ignoring frequent flaring as "just normal behavior"', 'Occasional flaring is typical, but persistent flaring deserves a look at possible stress sources in the tank.'],
    ];
}

function pz_faq_betta_fish_care_guide() {
    return [
        ['Can two bettas live in the same tank?', 'Generally not recommended, especially for males, which are territorial and commonly fight if housed together.'],
        ['Do bettas need a heater if they can breathe surface air?', 'Yes — the labyrinth organ lets them gulp air for oxygen, but bettas are still a tropical species that needs a heater for proper temperature.'],
        ['Why is my betta flaring?', 'Flaring is a normal display and stress signal, often triggered by a reflection, another fish, or a perceived threat. Occasional flaring is typical; frequent flaring is worth investigating.'],
        ['Why did my betta\'s fins get damaged?', 'Fin damage is often linked to cold, cramped, unheated conditions or incompatible tankmates — reviewing temperature and tank setup is a good first step.'],
        ['Is a small bowl enough for a betta?', 'No — this is an outdated and common misconception. Bettas do better in a properly heated tank larger than the small bowls once associated with the species.'],
        ['Can bettas live with other fish?', 'Sometimes, with careful research on compatible tankmates, but many keepers find a single-betta setup is the simplest way to avoid aggression.'],
    ];
}
