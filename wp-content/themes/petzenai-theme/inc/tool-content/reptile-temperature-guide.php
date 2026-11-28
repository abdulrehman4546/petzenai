<?php
/**
 * Tool-specific content for: Reptile Temperature & Humidity Guide (registry key: reptile_temperature_guide).
 * Registry type is 'guide' and uses a dedicated static widget in inc/tool-renderer.php.
 * General cross-species guide — not species-specific; covers both temperature and humidity gradients, since needs for both vary heavily by species.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_reptile_temperature_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Nearly every pet reptile needs both a temperature gradient and an appropriate humidity level in its enclosure. For temperature, that usually means a basking zone that runs noticeably hotter than a retreat zone elsewhere in the tank, letting the reptile move back and forth to regulate itself since reptiles can't do this internally the way mammals do. Humidity needs swing even more by species — desert reptiles need the air kept dry while tropical or semi-aquatic reptiles need it kept much more moist, and running the wrong level for too long is a common cause of shedding problems. The exact numbers for both vary a lot by species, so this guide focuses on the underlying concepts, with a thermometer and a hygrometer as the tools that confirm either one is actually on target.</div>
<?php }

function pz_what_is_reptile_temperature_guide() {
    ob_start(); ?>
    <p>This guide covers two related but separate things every reptile enclosure needs to get right: a temperature gradient between a hotter basking zone and a cooler retreat zone, and a humidity level that matches what the species naturally experiences. It explains why both matter across nearly all pet reptiles, and why exact numbers aren't given here since they vary so much by species.</p>
    <p>Temperature and humidity needs differ a lot between species — a desert-adapted reptile and a tropical or semi-aquatic one can need very different setups for both — so owners should look up what their specific species needs rather than applying one set of numbers broadly.</p>
    <?php return ob_get_clean();
}

function pz_why_important_reptile_temperature_guide() {
    ob_start(); ?>
    <p>Understanding the gradient concept matters more than memorizing any single number, since the right temperature range differs by species while the underlying principle stays the same.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🌡️</span>
        <div><strong>A gradient lets a reptile self-regulate</strong><p>Since reptiles can't generate their own body heat internally the way mammals do, a warm basking area and a cooler area let them move between zones to manage their temperature.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">📏</span>
        <div><strong>Exact numbers vary by species</strong><p>What counts as the right basking or cool-end temperature differs considerably between species, which is why species-specific guides matter alongside this general concept.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">📟</span>
        <div><strong>A thermometer or thermostat confirms the gradient is real</strong><p>Guessing at temperature by feel isn't reliable, so accurate measurement is what actually verifies the warm and cool zones are working as intended.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🌙</span>
        <div><strong>Nighttime temperature often needs to drop</strong><p>Many reptiles benefit from a cooler period overnight rather than holding the same temperature around the clock.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💧</span>
        <div><strong>Humidity needs are just as species-dependent as temperature</strong><p>A desert species such as a bearded dragon needs the air kept fairly dry, while a tropical or semi-aquatic species needs it kept much more moist, and getting this wrong is a common cause of incomplete or stuck shedding.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_reptile_temperature_guide() {
    return [
        ['title' => 'Set up a clearly warmer basking area and a clearly cooler area', 'desc' => 'This gradient is the core setup nearly every pet reptile enclosure needs, regardless of species.'],
        ['title' => 'Research the specific temperature and humidity range for your species', 'desc' => 'Exact numbers for both vary a lot by species, so look up what your particular reptile needs rather than using general figures.'],
        ['title' => 'Place a thermometer at both the basking spot and the cool end', 'desc' => 'Measuring both ends, not just one, is what actually confirms the gradient exists across the enclosure.'],
        ['title' => 'Add a hygrometer to track humidity the same way you track temperature', 'desc' => 'Humidity is just as easy to misjudge by feel as temperature is, so a dedicated reading matters, especially if your species is prone to shedding issues.'],
        ['title' => 'Consider a thermostat to help maintain consistency', 'desc' => 'A thermostat can help keep the basking area within range rather than relying on guesswork.'],
        ['title' => 'Allow for a nighttime temperature drop where appropriate', 'desc' => 'Many reptiles benefit from cooler nighttime conditions rather than a constant temperature day and night.'],
        ['title' => 'Recheck temperature and humidity periodically, not just at setup', 'desc' => 'Bulbs, heaters, and room conditions can change over time, so an initial reading isn\'t necessarily a lasting one.'],
    ];
}

function pz_tips_reptile_temperature_guide() {
    return [
        ['Don\'t rely on feel alone to judge enclosure temperature', 'A thermometer gives a much more reliable reading than guessing by touch.'],
        ['Measure both the basking spot and the cool end separately', 'Checking only one zone doesn\'t confirm the gradient actually exists across the enclosure.'],
        ['Research your species\' numbers rather than guessing', 'General gradient and humidity principles apply broadly, but the right numbers for your specific reptile take some species-specific research.'],
        ['Don\'t assume a single thermometer reading represents the whole tank', 'Temperature can vary across an enclosure, so one reading in one spot doesn\'t tell the full story.'],
        ['Reconsider nighttime temperatures separately from daytime ones', 'A cooler night period is appropriate for many species rather than keeping daytime basking temperatures constant around the clock.'],
        ['Watch shedding for signs humidity is off', 'A shed that comes off in patches or gets stuck rather than coming away cleanly often points back to humidity that\'s running too low.'],
    ];
}

function pz_mistakes_reptile_temperature_guide() {
    return [
        ['❌ Letting the enclosure settle into one flat temperature end to end', 'A reptile placed in a tank with no meaningful difference between its warm and cool areas is left with no way to adjust its own body temperature at all.'],
        ['❌ Guessing at temperature instead of measuring it', 'Relying on how the enclosure feels by hand isn\'t a reliable substitute for an actual thermometer reading.'],
        ['❌ Applying one species\' numbers to a different species', 'Exact temperature and humidity needs vary enough between species that numbers for one reptile shouldn\'t be assumed to fit another.'],
        ['❌ Measuring temperature only once at setup and never again', 'Equipment and conditions can change over time, so periodic rechecking matters.'],
        ['❌ Ignoring nighttime temperature entirely', 'Many reptiles benefit from a cooler period overnight rather than a constant round-the-clock temperature.'],
        ['❌ Overlooking humidity while focusing only on temperature', 'Humidity gets far less attention than temperature from many keepers, but running it too low for a species that needs more moisture can lead to shedding trouble.'],
    ];
}

function pz_faq_reptile_temperature_guide() {
    return [
        ['Why do reptiles need a temperature gradient?', 'Because reptiles can\'t regulate body heat internally the way mammals do, a warm basking area and a cooler area let them move between zones to manage their own temperature.'],
        ['Is the right temperature the same for every reptile?', 'No, exact numbers vary considerably by species, which is why this guide focuses on the general gradient concept rather than specific figures.'],
        ['Do I need a thermometer in the enclosure?', 'Yes, a thermometer or thermostat is what actually confirms the basking and cool-end temperatures, rather than relying on guesswork.'],
        ['Should the temperature drop at night?', 'For many reptiles, yes — a nighttime drop is often appropriate rather than keeping the same temperature around the clock.'],
        ['Where can I find exact temperature numbers for my reptile?', 'Temperature needs vary considerably by species, so it\'s worth researching what your particular reptile needs rather than relying on general figures.'],
        ['Does humidity matter as much as temperature?', 'Yes — humidity needs vary just as much by species, with desert reptiles needing dry air and tropical or semi-aquatic reptiles needing much higher moisture, and a hygrometer is the tool that confirms the level in the enclosure.'],
        ['Why does my reptile keep having a bad shed?', 'Low humidity is one of the most common causes of incomplete or stuck shedding, so checking humidity levels with a hygrometer is a reasonable first step when shedding looks off.'],
    ];
}
