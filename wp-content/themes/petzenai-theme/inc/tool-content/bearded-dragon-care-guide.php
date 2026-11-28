<?php
/**
 * Tool-specific content for: Bearded Dragon Care Guide: Diet, Lighting & Tank (registry key: bearded_dragon_care_guide).
 * Registry type is 'guide' and uses a dedicated static widget in inc/tool-renderer.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_bearded_dragon_care_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Bearded dragons need a temperature gradient in their enclosure, with a warm basking spot at one end and a cooler area at the other, plus UVB lighting to stay healthy. They're omnivorous, eating a mix of insects and vegetables that shifts with age — juveniles generally eat more protein, while adults shift toward more vegetables. A natural winter slowdown called brumation is normal and shouldn't be mistaken for illness.</div>
<?php }

function pz_what_is_bearded_dragon_care_guide() {
    ob_start(); ?>
    <p>A bearded dragon is a desert-adapted lizard commonly kept as a reptile pet, and its care centers on recreating the temperature range, lighting, and diet it would naturally experience. That means a basking area that's noticeably warmer than the rest of the enclosure, a cooler area to retreat to, UVB lighting, and an omnivorous diet of insects and vegetables.</p>
    <p>This guide covers the basics of setting up that temperature gradient and lighting, what a bearded dragon eats at different life stages, and brumation, the natural slowdown some bearded dragons go through.</p>
    <?php return ob_get_clean();
}

function pz_why_important_bearded_dragon_care_guide() {
    ob_start(); ?>
    <p>Getting the temperature gradient, lighting, and diet right matters because a bearded dragon can't regulate its body temperature or get essential nutrients the way a mammal pet does.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🌡️</span>
        <div><strong>A temperature gradient lets the dragon regulate itself</strong><p>A warm basking spot at one end and a cooler area at the other allows the dragon to move between zones to manage its own body temperature.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">☀️</span>
        <div><strong>UVB lighting is a core requirement, not optional</strong><p>Bearded dragons need UVB exposure as part of their enclosure setup, distinct from simply providing heat.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🦗</span>
        <div><strong>Diet shifts from more protein to more vegetables with age</strong><p>Juveniles generally eat a higher proportion of insects, while adults shift toward eating more vegetables as they mature.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💤</span>
        <div><strong>Brumation is a natural slowdown, not illness</strong><p>Some bearded dragons go through a winter period of reduced activity and appetite that's a normal seasonal pattern rather than a health problem.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_bearded_dragon_care_guide() {
    return [
        ['title' => 'Set up a basking area and a cooler area in the enclosure', 'desc' => 'This temperature gradient lets the dragon move between warmer and cooler zones to regulate itself.'],
        ['title' => 'Provide UVB lighting alongside basking heat', 'desc' => 'UVB is a separate requirement from heat and is a core part of a bearded dragon enclosure.'],
        ['title' => 'Feed a higher proportion of insects to juveniles', 'desc' => 'Younger bearded dragons generally need more protein relative to vegetables than adults do.'],
        ['title' => 'Shift the diet toward more vegetables as the dragon matures', 'desc' => 'Adult bearded dragons generally eat proportionally more vegetables and fewer insects than juveniles.'],
        ['title' => 'Monitor both ends of the temperature gradient, not just one spot', 'desc' => 'Checking both the basking area and the cooler area helps confirm the full gradient is working as intended.'],
        ['title' => 'Recognize brumation as a seasonal pattern, not a symptom to panic over', 'desc' => 'A bearded dragon slowing down and eating less in a brumation period is a known natural behavior, distinct from illness.'],
    ];
}

function pz_tips_bearded_dragon_care_guide() {
    return [
        ['Check both the warm and cool ends of the enclosure', 'Confirming the gradient exists on both sides matters more than just checking the basking spot alone.'],
        ['Replace UVB bulbs on the schedule the manufacturer recommends', 'UVB output can decline over time even if the bulb still lights up normally.'],
        ['Adjust insect-to-vegetable ratio as the dragon ages', 'A diet that doesn\'t shift as a juvenile matures into an adult may no longer match its changing needs.'],
        ['Watch for brumation-like behavior mainly in cooler months', 'Reduced activity and appetite showing up seasonally is more consistent with brumation than with illness.'],
        ['Give a brumating dragon access to both warm and cool areas still', 'Even during a slowdown, the temperature gradient remains part of normal enclosure setup.'],
    ];
}

function pz_mistakes_bearded_dragon_care_guide() {
    return [
        ['❌ Providing heat without UVB lighting', 'UVB is a separate requirement from basking heat, and skipping it leaves out a core part of bearded dragon care.'],
        ['❌ Keeping the whole enclosure at one uniform temperature', 'Without a gradient between a warm basking spot and a cooler area, the dragon has no way to self-regulate.'],
        ['❌ Feeding an adult the same high-insect diet as a juvenile', 'Diet proportions are generally expected to shift toward more vegetables as a bearded dragon matures.'],
        ['❌ Assuming reduced appetite always means illness', 'A seasonal slowdown consistent with brumation is a normal pattern, separate from an actual health problem.'],
        ['❌ Forgetting to replace an aging UVB bulb', 'UVB output can drop over time even while the bulb continues to produce visible light.'],
    ];
}

function pz_faq_bearded_dragon_care_guide() {
    return [
        ['Do bearded dragons need a temperature gradient?', 'Yes — a warm basking spot and a cooler area in the enclosure let the dragon move between zones to regulate its body temperature.'],
        ['Do bearded dragons need UVB lighting?', 'Yes, UVB is a core requirement alongside basking heat, not an optional extra.'],
        ['What do bearded dragons eat?', 'They\'re omnivorous, eating a mix of insects and vegetables, with juveniles generally eating more insects and adults shifting toward more vegetables.'],
        ['What is brumation in bearded dragons?', 'It\'s a natural winter slowdown in activity and appetite, similar in concept to hibernation, and shouldn\'t automatically be mistaken for illness.'],
        ['Does diet change as a bearded dragon gets older?', 'Yes, the ratio of insects to vegetables is generally expected to shift toward more vegetables as the dragon matures from juvenile to adult.'],
    ];
}
