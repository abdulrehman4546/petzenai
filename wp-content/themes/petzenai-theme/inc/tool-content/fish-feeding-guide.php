<?php
/**
 * Tool-specific content for: How Much to Feed Fish: Feeding Guide & Calculator (registry key: fish_feeding_guide).
 * Registry type changed from 'calculator' to 'guide' (no dedicated render function existed, and the generic
 * fallback calculator is a mammal weight/breed-size/life-stage form, which makes no sense for fish feeding
 * amounts). The page widget is pz_render_guide_fish_feeding_guide() in inc/tool-renderer.php — a static
 * quick-reference card on feeding frequency and portion size, not an interactive calculator.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_fish_feeding_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Most community fish do well on small amounts of food they can finish within a couple of minutes, offered once or twice a day. Overfeeding — not underfeeding — is the far more common mistake, and leftover food breaks down into waste that stresses water quality.</div>
<?php }

function pz_what_is_fish_feeding_guide() {
    ob_start(); ?>
    <p>Feeding fish correctly is less about hitting an exact gram amount and more about matching portion size to what the fish can actually eat quickly. A commonly used guideline is to offer only as much food as the fish in the tank can consume within a couple of minutes, once or twice daily for most community species.</p>
    <p>This guide covers the general principles behind that approach: how to judge portion size by behavior rather than measurement, why feeding frequency varies a bit by species and life stage, and why uneaten food is the single biggest risk most new fish keepers underestimate.</p>
    <?php return ob_get_clean();
}

function pz_why_important_fish_feeding_guide() {
    ob_start(); ?>
    <p>Feeding amount and frequency directly affect water quality, since uneaten food and excess waste both break down and add to the bioload a tank's filter has to process.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">⏱️</span>
        <div><strong>The "couple of minutes" rule beats guessing by weight</strong><p>Judging portions by how quickly fish finish eating is more practical day-to-day than trying to measure an exact food weight.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🚨</span>
        <div><strong>Overfeeding is the most common feeding mistake</strong><p>New fish keepers tend to feed too much rather than too little, and leftover food sinking into the substrate is easy to miss.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💧</span>
        <div><strong>Uneaten food links directly to water quality problems</strong><p>Decomposing leftover food adds ammonia-producing waste to the tank, which can push water parameters in the wrong direction.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🐟</span>
        <div><strong>Feeding needs vary by species and life stage</strong><p>Some species and younger fish benefit from smaller, more frequent feedings rather than one or two larger ones.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_fish_feeding_guide() {
    return [
        ['title' => 'Start with a small pinch or portion', 'desc' => 'Offer less than you think is needed at first — it is easier to add a little more than to clean up an overfed tank.'],
        ['title' => 'Watch how long it takes fish to finish', 'desc' => 'If food is still visible after a couple of minutes, the portion was likely too large for next time.'],
        ['title' => 'Remove obvious leftover food', 'desc' => 'Uneaten food sitting in the tank breaks down and adds to the bioload, so netting out visible excess helps protect water quality.'],
        ['title' => 'Feed once or twice daily for most community fish', 'desc' => 'This is a common starting frequency; some species or younger fish may do better with smaller, more frequent feedings.'],
        ['title' => 'Research your specific species\' feeding habits', 'desc' => 'Bottom feeders, grazers, and predatory species often have different feeding patterns than typical community fish.'],
        ['title' => 'Adjust gradually and watch fish behavior', 'desc' => 'If fish consistently seem to be searching for food well after feeding, or portions are routinely uneaten, adjust the amount gradually rather than making a big change at once.'],
    ];
}

function pz_tips_fish_feeding_guide() {
    return [
        ['When in doubt, feed less', 'It is far easier to correct underfeeding than to recover from the water quality issues that can follow repeated overfeeding.'],
        ['Occasional fasting is normal for many species', 'Skipping a feeding now and then is generally not harmful for many established adult fish, and some keepers use it intentionally.'],
        ['Vary food type where appropriate', 'Rotating between food types can help match the natural diet of some species, though this depends heavily on what species you keep.'],
        ['Use a feeding routine, not a strict clock', 'Consistency in approximate timing matters more than feeding at the exact same minute every day.'],
        ['Watch for food sinking out of reach', 'Floating foods that aren\'t eaten quickly can sink and get missed, especially in tanks with decor or substrate that hides debris.'],
    ];
}

function pz_mistakes_fish_feeding_guide() {
    return [
        ['❌ Feeding more because fish "seem hungry"', 'Fish often continue to beg for food after they are already full — this behavior is not a reliable signal of real hunger.'],
        ['❌ Leaving uneaten food in the tank', 'Leftover food decomposes and adds waste to the water, which can affect water quality well before it is visibly obvious.'],
        ['❌ Feeding the same amount regardless of tank size or fish count', 'Portion sizes that make sense for a heavily stocked tank can be far too much for a lightly stocked one, and vice versa.'],
        ['❌ Ignoring species-specific feeding needs', 'Bottom feeders, nocturnal species, and grazers often need a different feeding approach than typical mid-water community fish.'],
        ['❌ Ramping up feeding right after setup', 'Overfeeding in a newly established tank adds avoidable stress to a system that is still stabilizing.'],
    ];
}

function pz_faq_fish_feeding_guide() {
    return [
        ['How much should I feed my fish?', 'A common guideline is to offer only as much food as fish can finish within a couple of minutes, rather than measuring an exact amount.'],
        ['How often should I feed fish?', 'Once or twice daily works for most community fish, though some species and younger fish may benefit from smaller, more frequent feedings.'],
        ['What happens if I overfeed my fish?', 'Uneaten food breaks down in the tank and adds to the bioload, which can contribute to water quality problems over time.'],
        ['Is it okay to skip a feeding?', 'Occasional missed feedings are generally not a concern for many established adult fish.'],
        ['Should I remove leftover food from the tank?', 'Yes — netting out visible uneaten food helps limit the waste load on the tank\'s filtration.'],
        ['Do all fish need the same feeding schedule?', 'No — feeding frequency and portion habits vary by species, so researching your specific fish is worthwhile.'],
    ];
}
