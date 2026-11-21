<?php
/**
 * Tool-specific content for: Ideal Temperature for Pet Birds Guide (registry key: bird_temperature_guide).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_bird_temperature_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Most pet birds are comfortable in roughly the same range as typical household room temperature, generally cited as around 65-80°F (18-27°C), as long as it stays fairly stable. Sudden swings, drafts, and cold nights near windows or doors are usually more of a problem than any single number on the thermostat.</div>
<?php }

function pz_what_is_bird_temperature_guide() {
    ob_start(); ?>
    <p>This guide covers the general room temperature range that works well for most pet birds and, just as importantly, why stability matters as much as the exact number. It is general guidance rather than a precise clinical threshold, since comfortable temperature varies a bit by species and individual bird.</p>
    <p>Most pet birds do well in the same general comfort range as the people living with them — a typical heated or air-conditioned home is usually in the right zone. The bigger risk tends to come from sudden changes rather than the temperature itself.</p>
    <p>Cage placement matters here as much as the thermostat setting: a cage near a drafty window, an exterior door, or an air conditioning vent can expose a bird to colder or more variable air than the rest of the room, even if the room itself reads at a comfortable temperature.</p>
    <?php return ob_get_clean();
}

function pz_why_important_bird_temperature_guide() {
    ob_start(); ?>
    <p>Birds regulate body temperature differently than people do, and sudden changes are harder on them than a steady, moderate environment, even one at the cooler or warmer end of a comfortable range.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🌡️</span>
        <div><strong>Stability matters more than a precise number</strong><p>A room that holds a steady, moderate temperature is generally better for a bird than one that swings widely between warm days and cold nights.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🪟</span>
        <div><strong>Cage placement affects the temperature a bird actually feels</strong><p>A cage next to a drafty window or exterior door can expose a bird to colder air than the rest of the room shows on a thermostat.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💨</span>
        <div><strong>Drafts are often a bigger issue than the temperature setting</strong><p>Air conditioning vents and open windows can create a localized draft that feels much colder to a bird than the general room temperature.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🏥</span>
        <div><strong>Sick birds lose the ability to regulate temperature well</strong><p>A bird that already looks fluffed up and lethargic has less ability to cope with temperature swings, which is part of why a stable environment matters even more when a bird is unwell.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_bird_temperature_guide() {
    return [
        ['title' => 'Keep the room in a moderate, stable range', 'desc' => 'Aim for roughly 65-80°F (18-27°C), the general range most pet birds are comfortable in, and avoid letting the room swing widely between day and night.'],
        ['title' => 'Place the cage away from drafts', 'desc' => 'Avoid positioning the cage directly next to a window, exterior door, or air conditioning vent where air movement can make the local temperature feel colder than the room overall.'],
        ['title' => 'Avoid direct, unfiltered sun exposure', 'desc' => 'A cage in direct sun for long stretches can get noticeably hotter than the rest of the room, so some shade or distance from the window helps.'],
        ['title' => 'Monitor overnight temperature in cooler months', 'desc' => 'Rooms often get colder overnight than during the day, so check that the bird\'s room does not drop well below the comfortable range while heating is turned down.'],
        ['title' => 'Watch your bird\'s behavior as a cue', 'desc' => 'A bird that is fluffed up and reluctant to move may be cold, while one with wings held away from its body and panting may be too warm — both are worth addressing.'],
        ['title' => 'Call an avian vet if a bird seems chilled or overheated and not recovering', 'desc' => 'If adjusting the room temperature does not resolve fluffed-up, lethargic behavior fairly quickly, treat it as a reason to call an avian vet rather than waiting.'],
    ];
}

function pz_tips_bird_temperature_guide() {
    return [
        ['Use a simple room thermometer near the cage', 'A thermometer placed near cage height gives a more accurate read than guessing from a thermostat elsewhere in the house.'],
        ['Cover part of the cage at night in a cold room', 'A light cover over part of the cage can help retain warmth overnight without fully blocking airflow.'],
        ['Avoid moving a bird between very different temperatures quickly', 'Taking a bird from a warm room straight into a cold car or outdoors is a bigger shock than a gradual change.'],
        ['Keep the cage away from kitchen heat sources too', 'Ovens and stovetops can create sudden localized heat and fumes, so cage placement away from the kitchen helps on both fronts.'],
        ['Check for drafts at bird height, not just human height', 'Cold air can pool lower in a room even when it feels fine standing up, so check near the cage itself.'],
    ];
}

function pz_mistakes_bird_temperature_guide() {
    return [
        ['❌ Placing the cage right next to a window or door', 'Even a room that reads comfortably on a thermostat can have a cold draft right at a window or exterior door that the cage sits next to.'],
        ['❌ Letting the room swing widely between day and night', 'A stable, moderate temperature is generally better for a bird than one that is warm during the day and cold overnight.'],
        ['❌ Assuming a fluffed-up bird is just resting', 'Fluffed feathers combined with reduced activity can be a sign a bird is cold or unwell, not simply relaxed.'],
        ['❌ Leaving a cage in direct sun for long stretches', 'Direct, unfiltered sun can heat a cage well above the rest of the room, especially in warmer months.'],
        ['❌ Moving a bird quickly between very different temperatures', 'A sudden shift, like from a warm house straight into a cold car, is harder on a bird than a gradual change.'],
    ];
}

function pz_faq_bird_temperature_guide() {
    return [
        ['What temperature should my bird\'s room be?', 'Most pet birds do well in roughly the same range as typical household room temperature, generally cited as around 65-80°F (18-27°C), as long as it stays fairly stable.'],
        ['Is it more important to avoid drafts or hit an exact temperature?', 'Avoiding drafts and sudden swings generally matters more than hitting one precise number, since a stable, moderate room is usually fine for most pet birds.'],
        ['How do I know if my bird is too cold?', 'A cold bird often sits fluffed up, is less active than usual, and may tuck a foot up or sit low on the perch; if this does not improve once the draft or temperature is fixed, contact an avian vet.'],
        ['How do I know if my bird is too warm?', 'A bird that is too warm may hold its wings slightly away from its body, pant, or seem unusually restless; moving it away from direct heat or sun and offering water is a reasonable first step.'],
        ['Can I put my bird\'s cage near a window?', 'A window can work if the cage is not in a direct draft and gets shade from intense, direct sun for long stretches; check for cold air at cage height, especially in winter.'],
        ['Does room temperature matter more for a sick bird?', 'Yes — a bird that is already unwell has less ability to regulate its own temperature, so keeping its environment stable and warm enough matters even more while it recovers.'],
    ];
}
