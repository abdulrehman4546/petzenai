<?php
/**
 * Tool-specific content for: Aquarium Water Temperature Guide by Fish Type (registry key: aquarium_water_temperature_guide).
 * Registry type is 'guide' and uses the generic GUIDE/TRACKER renderer in inc/tool-renderer.php (no dedicated
 * static widget needed — this page is reference content, not a calculator substitute).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_aquarium_water_temperature_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Target temperature depends heavily on species type. Tropical fish are commonly kept around 75-80°F (24-27°C), while coldwater species like goldfish are commonly kept cooler, around 65-72°F (18-22°C). Stability within a species' range matters as much as the exact number.</div>
<?php }

function pz_what_is_aquarium_water_temperature_guide() {
    ob_start(); ?>
    <p>Aquarium water temperature needs vary a lot depending on what kind of fish you keep. Tropical species generally need warmer, heated water, commonly cited in the 75-80°F (24-27°C) range, while coldwater species such as goldfish are typically kept cooler, often around 65-72°F (18-22°C), and usually don't need a heater at all.</p>
    <p>This guide covers those general ranges, why they are ranges rather than a single exact number, and the basic equipment — a reliable heater and a separate thermometer — that most tanks need to keep temperature steady rather than swinging.</p>
    <?php return ob_get_clean();
}

function pz_why_important_aquarium_water_temperature_guide() {
    ob_start(); ?>
    <p>Temperature affects fish metabolism, activity level, and how well they tolerate other stressors, which is why matching temperature to species type is a basic part of tank setup.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🌡️</span>
        <div><strong>Tropical and coldwater species need different ranges</strong><p>Tropical fish commonly need warmer water around 75-80°F (24-27°C), while coldwater species like goldfish commonly do better around 65-72°F (18-22°C).</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">📉</span>
        <div><strong>Stability matters as much as the exact number</strong><p>A tank that holds a steady temperature within a species' range is generally better than one that technically hits a target number but fluctuates a lot.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🔧</span>
        <div><strong>A heater alone isn't enough without a thermometer</strong><p>Heaters can fail or drift, so a separate thermometer is the main way to confirm the water is actually at the intended temperature.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🐠</span>
        <div><strong>Mixing species with different temperature needs is risky</strong><p>Keeping tropical and coldwater species together generally isn't recommended, since their comfortable ranges don't overlap well.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_aquarium_water_temperature_guide() {
    return [
        ['title' => 'Identify whether your fish are tropical or coldwater species', 'desc' => 'This general category determines which temperature range to target, so confirm it before choosing equipment.'],
        ['title' => 'Set up a reliable heater for tropical tanks', 'desc' => 'Most tropical setups need a heater to maintain a steady temperature in the commonly cited 75-80°F (24-27°C) range.'],
        ['title' => 'Skip the heater (usually) for coldwater setups', 'desc' => 'Coldwater species like goldfish are commonly kept around 65-72°F (18-22°C), which many homes reach without supplemental heating.'],
        ['title' => 'Add a separate thermometer', 'desc' => 'A thermometer independent of the heater\'s own display helps confirm the actual water temperature rather than relying on the heater\'s setting alone.'],
        ['title' => 'Check temperature regularly, not just at setup', 'desc' => 'Periodic checks help catch heater drift or failure before it becomes a bigger problem.'],
        ['title' => 'Avoid sudden temperature swings during water changes', 'desc' => 'Using water that is close to the tank\'s existing temperature during changes helps avoid stressing fish with a sudden shift.'],
    ];
}

function pz_tips_aquarium_water_temperature_guide() {
    return [
        ['Research your specific species\' preferred range', 'General tropical and coldwater ranges are a starting point — some species prefer the warmer or cooler end of their category.'],
        ['Place thermometers away from heater outflow', 'Reading right next to the heater can give a misleadingly warm reading compared to the rest of the tank.'],
        ['Keep a heater on a separate circuit if possible', 'This can help limit the impact if something else in the room trips a breaker.'],
        ['Watch fish behavior as a secondary signal', 'Unusual lethargy or erratic activity can sometimes point to a temperature issue worth double-checking with a thermometer.'],
        ['Match temperature before mixing species in one tank', 'Confirm temperature ranges overlap well before combining different species in the same aquarium.'],
    ];
}

function pz_mistakes_aquarium_water_temperature_guide() {
    return [
        ['❌ Assuming room temperature is close enough for tropical fish', 'Many homes run cooler than the 75-80°F (24-27°C) range tropical fish commonly need, especially overnight or in winter.'],
        ['❌ Relying only on the heater\'s built-in display', 'A separate thermometer is the more reliable way to confirm actual water temperature.'],
        ['❌ Making large, sudden temperature changes', 'Rapid shifts are generally more stressful to fish than a stable temperature that isn\'t perfectly centered in the ideal range.'],
        ['❌ Mixing tropical and coldwater species in one tank', 'Their comfortable temperature ranges typically don\'t overlap well, which makes it hard to suit both.'],
        ['❌ Forgetting to recheck temperature after equipment changes', 'Moving a heater, changing tank location, or adjusting lighting can all shift ambient and water temperature.'],
    ];
}

function pz_faq_aquarium_water_temperature_guide() {
    return [
        ['What temperature should a tropical fish tank be?', 'A commonly cited range is about 75-80°F (24-27°C), though some species prefer the warmer or cooler end of that range.'],
        ['What temperature do goldfish need?', 'Goldfish are a coldwater species commonly kept around 65-72°F (18-22°C), generally without needing a heater.'],
        ['Do I need a heater for a coldwater tank?', 'Usually not, since coldwater species are adapted to cooler temperatures many homes already provide, but it depends on your home\'s climate.'],
        ['Can I keep tropical and coldwater fish together?', 'Generally not recommended, since their comfortable temperature ranges don\'t overlap well.'],
        ['How do I know if my heater is working correctly?', 'A separate thermometer, checked regularly, is the main way to confirm the heater is maintaining the intended temperature.'],
        ['Does water temperature affect fish health?', 'Yes — temperature affects metabolism and activity level, and sudden swings outside a species\' comfortable range can add stress.'],
    ];
}
