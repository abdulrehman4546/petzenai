<?php
/**
 * Tool-specific content for: Guppy Fish Care Guide: Breeding & Feeding (registry key: guppy_care_guide).
 * Registry type is 'guide' and uses a dedicated static widget in inc/tool-renderer.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_guppy_care_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Guppies are a hardy, beginner-friendly livebearer, meaning they give birth to live young rather than laying eggs, and they breed prolifically. A single mixed-sex group can overpopulate a tank surprisingly quickly if new owners are not prepared for the numbers.</div>
<?php }

function pz_what_is_guppy_care_guide() {
    ob_start(); ?>
    <p>Guppies are a small, colorful tropical fish widely recommended for beginners thanks to their general hardiness and easy care. One defining trait sets them apart from many other common aquarium fish: guppies are livebearers, meaning females give birth to free-swimming live young rather than laying eggs that need to hatch.</p>
    <p>This guide covers guppies as a livebearer species, why their prolific breeding is a practical consideration for new owners, and the color and fin variety that selective breeding has produced in the species.</p>
    <?php return ob_get_clean();
}

function pz_why_important_guppy_care_guide() {
    ob_start(); ?>
    <p>Guppies' combination of easy care and rapid breeding makes them a popular beginner choice, but that same breeding trait is exactly what catches new owners off guard.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🐣</span>
        <div><strong>Guppies are livebearers, not egg-layers</strong><p>Females give birth to live, free-swimming young rather than laying eggs, which is a genuinely distinct trait compared to many other popular aquarium species.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">📈</span>
        <div><strong>Breeding is prolific and can overpopulate a tank fast</strong><p>A small mixed-sex group can produce new young repeatedly, and numbers can climb quickly if that is not accounted for when stocking a tank.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💪</span>
        <div><strong>Guppies are relatively hardy for beginners</strong><p>They tend to tolerate a range of conditions better than many more sensitive species, which is part of why they are commonly recommended to new fish keepers.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🎨</span>
        <div><strong>Decades of selective breeding created huge color and fin variety</strong><p>Guppies are available in a wide range of colors and fin shapes thanks to extensive breeding work within the species.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_guppy_care_guide() {
    return [
        ['title' => 'Decide whether you want breeding to happen at all', 'desc' => 'Keeping only males, or only females, avoids the rapid population growth that a mixed-sex group produces.'],
        ['title' => 'Plan for population growth if keeping both sexes', 'desc' => 'A mixed-sex group of guppies will likely produce new young on an ongoing basis, so plan tank space and a plan for extra fish in advance.'],
        ['title' => 'Provide a tropical temperature range and stable water', 'desc' => 'As a tropical species, guppies need a heated tank in the warmer range already covered in general tropical fish care, with stable, consistent water conditions.'],
        ['title' => 'Offer a varied diet', 'desc' => 'Guppies generally do well on a varied diet rather than a single food type, consistent with general feeding guidance for tropical community fish.'],
        ['title' => 'Separate or rehome excess young if numbers grow', 'desc' => 'Because breeding is prolific, having a plan for extra fry, such as a separate grow-out space or rehoming, helps avoid overcrowding the main tank.'],
        ['title' => 'Keep guppies with calm, similarly-sized tankmates', 'desc' => 'Guppies are generally peaceful, so pairing them with aggressive or fin-nipping species is best avoided given their flowing fins.'],
    ];
}

function pz_tips_guppy_care_guide() {
    return [
        ['Expect rapid breeding if both sexes are kept together', 'New owners are often surprised by how quickly a small group of guppies can multiply.'],
        ['Have a plan for extra fry before they arrive', 'Deciding in advance how to handle population growth is easier than scrambling once a tank is overcrowded.'],
        ['Take advantage of guppies\' hardiness while still testing water regularly', 'Being relatively forgiving does not mean guppies are immune to poor water quality.'],
        ['Choose tankmates that will not bother long, flowing fins', 'Fancy guppy varieties in particular have fins that fin-nipping species can damage.'],
        ['Enjoy the color variety, but research specific strains before buying', 'Different guppy varieties can vary somewhat in fin length and hardiness, so a little research helps match the fish to your setup.'],
    ];
}

function pz_mistakes_guppy_care_guide() {
    return [
        ['❌ Keeping a mixed-sex group without planning for breeding', 'This is one of the most common guppy-keeping surprises, since population growth can happen quickly.'],
        ['❌ Assuming hardiness means water quality does not matter', 'Guppies are relatively forgiving, but they still need stable water conditions and regular testing.'],
        ['❌ Mixing guppies with known fin-nipping species', 'Their flowing fins, especially in fancy varieties, make guppies an easy target for fin-nippers.'],
        ['❌ Not having a plan for excess fry', 'Without a plan, a tank can become overcrowded faster than expected as new young are born.'],
        ['❌ Keeping guppies at the cooler end of a coldwater range', 'Guppies are a tropical species and need a heated tank, not coldwater conditions.'],
    ];
}

function pz_faq_guppy_care_guide() {
    return [
        ['Are guppies livebearers or do they lay eggs?', 'Guppies are livebearers, meaning females give birth to live, free-swimming young rather than laying eggs.'],
        ['Why do guppy populations grow so quickly?', 'Guppies breed prolifically, and a mixed-sex group can produce new young repeatedly, so numbers can climb fast if not planned for.'],
        ['Are guppies good for beginners?', 'Yes, they are commonly recommended for beginners thanks to their general hardiness and easy care, though their rapid breeding is worth planning for.'],
        ['How do I stop guppies from overpopulating my tank?', 'Keeping only one sex is the most direct way to prevent breeding, or having a separate space or rehoming plan ready for extra fry.'],
        ['What temperature do guppies need?', 'As a tropical species, guppies need a heated tank in the warmer tropical range rather than coldwater conditions.'],
        ['Why do guppies come in so many colors?', 'Extensive selective breeding over many generations has produced a wide range of colors and fin shapes within the species.'],
    ];
}
