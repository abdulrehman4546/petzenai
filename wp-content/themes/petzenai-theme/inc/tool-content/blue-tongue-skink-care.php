<?php
/**
 * Tool-specific content for: Blue Tongue Skink Care Guide (registry key: blue_tongue_skink_care).
 * Registry type is 'guide' and uses a dedicated static widget in inc/tool-renderer.php.
 * Species-specific — distinct from bearded dragon (different omnivore diet ratio), chameleon (not arboreal),
 * and turtle (not aquatic); ground-dwelling with a calm temperament and the namesake defensive tongue display.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_blue_tongue_skink_care() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Blue tongue skinks are ground-dwelling, omnivorous lizards known for a generally calm, docile temperament compared to many other lizards, which is a big part of their popularity. Their diet runs noticeably more protein-heavy than an adult bearded dragon's mostly-vegetable diet, alongside vegetables and some fruit. Their name comes from the bright blue tongue they flash as a defensive display meant to startle a predator, not a feeding behavior. As ground dwellers, their housing is built around floor space rather than climbing height, more similar in concept to a bearded dragon's setup than a chameleon's.</div>
<?php }

function pz_what_is_blue_tongue_skink_care() {
    ob_start(); ?>
    <p>The blue tongue skink is a ground-dwelling lizard species, distinct from the arboreal, climbing lifestyle of a <a href="/tools/chameleon-care-guide/">chameleon</a> and from the aquatic habits of a pet <a href="/tools/turtle-care-guide/">turtle</a>. It spends its time moving across the floor of its enclosure rather than climbing branches or swimming.</p>
    <p>This guide covers the basics of housing, the omnivorous diet that differs from a <a href="/tools/bearded-dragon-care-guide/">bearded dragon's</a> in balance even though both eat a mix of protein and vegetables, and the calm temperament and defensive blue-tongue display the species is known for.</p>
    <?php return ob_get_clean();
}

function pz_why_important_blue_tongue_skink_care() {
    ob_start(); ?>
    <p>Blue tongue skinks have a handful of traits that set them apart from other commonly kept pet lizards, and understanding them helps set realistic expectations before bringing one home.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">😌</span>
        <div><strong>Known for a calm, docile temperament</strong><p>Compared to many other lizard species, blue tongue skinks have a reputation for being generally calm and tolerant of handling, which is a major reason they are popular among keepers.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">👅</span>
        <div><strong>The namesake tongue is a defensive display</strong><p>A blue tongue skink will flash its bright blue tongue as a startling display meant to deter a predator, a specific and distinctive defensive behavior rather than anything related to feeding.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🦎</span>
        <div><strong>Ground-dwelling, not a climber</strong><p>Unlike a chameleon, which lives an arboreal lifestyle, a blue tongue skink spends its time on the ground, so enclosure design centers on floor space rather than vertical climbing structure.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🍽️</span>
        <div><strong>Omnivorous, but more protein-heavy than a bearded dragon</strong><p>Both species eat a mix of animal protein and vegetables, but an adult blue tongue skink keeps more protein in the mix than an adult bearded dragon typically does, so a bearded dragon's feeding ratio should not be assumed to transfer directly.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_blue_tongue_skink_care() {
    return [
        ['title' => 'Set up a floor-space-focused enclosure', 'desc' => 'Since blue tongue skinks are ground dwellers, prioritize open floor area over vertical climbing structure, the opposite emphasis from an arboreal species like a chameleon.'],
        ['title' => 'Provide a basking-to-cool temperature gradient', 'desc' => 'Like many pet reptiles, a blue tongue skink needs a warm basking area and a cooler area to self-regulate, confirmed with a thermometer rather than guessed by feel.'],
        ['title' => 'Offer UVB lighting', 'desc' => 'UVB supports calcium metabolism and is a standard part of a healthy setup for this species, replaced on a schedule rather than judged by whether the bulb still visibly lights up.'],
        ['title' => 'Feed an omnivorous diet balanced for this species specifically', 'desc' => 'A mix of appropriate animal protein and vegetables suits a blue tongue skink, kept noticeably more protein-heavy than a bearded dragon\'s mostly-vegetable adult diet.'],
        ['title' => 'Handle regularly to support their naturally calm temperament', 'desc' => 'Blue tongue skinks are generally known for tolerating handling well, and consistent, gentle handling tends to keep that calm disposition comfortable around people.'],
        ['title' => 'Don\'t mistake the blue-tongue display for aggression', 'desc' => 'Flashing the bright blue tongue is a defensive display meant to startle a potential threat, not necessarily a sign the skink is about to bite.'],
    ];
}

function pz_tips_blue_tongue_skink_care() {
    return [
        ['Give them room to roam', 'As ground dwellers, blue tongue skinks make good use of open floor space, so a wider enclosure footprint benefits them more than extra height.'],
        ['Don\'t assume bearded dragon diet ratios apply directly', 'Even though both species are omnivorous lizards, the balance of protein to vegetables that suits a blue tongue skink is not identical to a bearded dragon\'s.'],
        ['Take advantage of their calmer temperament for routine handling', 'Their generally docile reputation makes regular handling sessions more approachable than with some other, more defensive lizard species.'],
        ['Don\'t be startled by the tongue flash', 'Seeing the blue tongue flash is a normal defensive display, not a medical concern or a sign of distress on its own.'],
        ['Confirm UVB and basking temperatures with a thermometer', 'Guessing at temperature by feel is unreliable; measuring the basking spot and cooler area directly gives a more accurate picture.'],
    ];
}

function pz_mistakes_blue_tongue_skink_care() {
    return [
        ['❌ Copying a bearded dragon\'s exact diet ratio', 'Both are omnivorous lizards, but the balance of animal protein to vegetables that suits a blue tongue skink differs from a bearded dragon\'s, so the ratios should not be assumed interchangeable.'],
        ['❌ Prioritizing height over floor space', 'As a ground-dwelling species, a blue tongue skink benefits far more from open floor area than from tall climbing structures suited to an arboreal lizard.'],
        ['❌ Misreading the blue tongue display as aggression requiring punishment', 'The display is a natural defensive behavior meant to startle a threat, not a behavioral problem that needs correcting.'],
        ['❌ Skipping UVB because the skink seems active without it', 'UVB supports calcium metabolism in ways that aren\'t obvious from activity level alone, so it shouldn\'t be skipped just because the skink appears fine in the short term.'],
        ['❌ Assuming a calm reputation means no handling introduction is needed', 'Even a generally docile species benefits from a gradual, consistent introduction to handling rather than being picked up roughly from the start.'],
    ];
}

function pz_faq_blue_tongue_skink_care() {
    return [
        ['Are blue tongue skinks good for handling?', 'They have a reputation for a generally calm, docile temperament compared to many other lizard species, which is a major reason they are popular among keepers who want a lizard that tolerates regular handling.'],
        ['Why do blue tongue skinks flash their tongue?', 'Flashing the bright blue tongue is a defensive display meant to startle a potential predator or threat, a distinctive behavior specific to this species rather than a feeding or aggressive behavior.'],
        ['What do blue tongue skinks eat?', 'They are omnivorous, eating a mix of animal protein and vegetables, though the balance differs from a bearded dragon\'s diet rather than following the same ratio.'],
        ['Do blue tongue skinks climb?', 'No, they are ground-dwelling lizards, unlike an arboreal species such as a chameleon, so enclosure design should prioritize floor space over vertical climbing structure.'],
        ['Do blue tongue skinks need UVB lighting?', 'Yes, UVB supports calcium metabolism and is a standard part of a healthy setup for this species, replaced on a manufacturer-recommended schedule rather than judged by appearance.'],
    ];
}
