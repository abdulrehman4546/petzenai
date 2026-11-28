<?php
/**
 * Tool-specific content for: Tortoise Care Guide: Diet, Lighting & Habitat (registry key: tortoise_care_guide).
 * Registry type is 'guide' and uses a dedicated static widget in inc/tool-renderer.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_tortoise_care_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> A tortoise is a land-dwelling member of the turtle family, distinct from the aquatic or semi-aquatic pet turtles most people keep, so its housing centers on dry land and grazing space rather than a water area. Tortoises are herbivorous grazers and need UVB lighting for calcium metabolism, with outdoor tortoises getting it from real sunlight and indoor tortoises needing an artificial UVB source. Some tortoises can live exceptionally long lives, in some cases outliving their owners, an even longer timeline than the already decades-long lifespan many pet turtles have. Many tortoise species also go through brumation, a natural seasonal slowdown, and outdoor grazing space is a consideration distinct from an indoor tank setup.</div>
<?php }

function pz_what_is_tortoise_care_guide() {
    ob_start(); ?>
    <p>A tortoise is a land-dwelling member of the turtle family, and it's worth being clear up front that this is different from the aquatic or semi-aquatic pet turtles most people keep. Where a water-kept turtle's housing needs both a water area and a dry basking spot, a tortoise's housing is built entirely around dry land and grazing space, with no swimming area needed.</p>
    <p>This guide covers that land-based housing and how it differs from an aquatic turtle's water-and-land setup, the herbivorous grazing diet tortoises need, the UVB lighting tortoises need for calcium metabolism, a lifespan that for some tortoises can exceed even the decades many turtles live, brumation as a seasonal slowdown many tortoise species go through, and outdoor grazing space as a consideration distinct from an indoor tank.</p>
    <?php return ob_get_clean();
}

function pz_why_important_tortoise_care_guide() {
    ob_start(); ?>
    <p>Tortoise care has several features that are easy to confuse with turtle care if the land-versus-water distinction isn't kept clear.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🏞️</span>
        <div><strong>Tortoises are land-dwelling, not aquatic</strong><p>Unlike a pet turtle, which is aquatic or semi-aquatic and needs a water area, a tortoise lives entirely on land and doesn't need a swimming area.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🥬</span>
        <div><strong>Herbivorous grazers by diet</strong><p>Tortoises graze on plant matter, which shapes both what they're fed and how much space they need to move around and forage.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">☀️</span>
        <div><strong>UVB lighting matters, from the sun outdoors or a bulb indoors</strong><p>Like other reptiles, tortoises need UVB for calcium metabolism. Outdoor tortoises get it from real sunlight, since glass or plastic filters UVB out, while indoor or enclosure-kept tortoises need an artificial UVB source instead.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⏳</span>
        <div><strong>Some tortoises live exceptionally long lives</strong><p>Some tortoises can live exceptionally long lives, in some cases outliving their owners, an even longer timeline than the decades many pet turtles live.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💤</span>
        <div><strong>Brumation is common in many tortoise species</strong><p>Many tortoise species go through brumation, the same natural seasonal slowdown concept seen in some other reptiles, and tortoises are actually one of the more commonly brumating groups.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🌳</span>
        <div><strong>Outdoor grazing space is a distinct consideration</strong><p>Many tortoises benefit from outdoor grazing areas, a housing consideration that's different from the indoor tank setups used for many other reptiles.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_tortoise_care_guide() {
    return [
        ['title' => 'Set up dry, land-based housing rather than a water-and-land setup', 'desc' => 'Since a tortoise is land-dwelling, not aquatic like a turtle, its enclosure doesn\'t need a swimming area.'],
        ['title' => 'Feed a grazing, herbivorous diet', 'desc' => 'Tortoises graze on plant matter, so diet and foraging space should reflect that grazing behavior.'],
        ['title' => 'Plan for outdoor grazing space where climate allows', 'desc' => 'Outdoor grazing areas are a consideration distinct from an indoor tank setup and suit many tortoise species well.'],
        ['title' => 'Provide real sunlight outdoors or artificial UVB indoors', 'desc' => 'Tortoises need UVB for calcium metabolism, and since glass or plastic filters it out, outdoor tortoises need real sun exposure while indoor tortoises need an artificial UVB source.'],
        ['title' => 'Recognize brumation as a normal seasonal pattern', 'desc' => 'Many tortoise species go through brumation, a natural slowdown that\'s a common and expected pattern in these species.'],
        ['title' => 'Plan ownership around a potentially very long lifespan', 'desc' => 'Some tortoises can live exceptionally long lives, in some cases outliving their owners, so ownership can be a long-term commitment for some species.'],
        ['title' => 'Keep the land-versus-water distinction in mind when researching care', 'desc' => 'Care advice written for aquatic or semi-aquatic turtles doesn\'t directly apply to a land-dwelling tortoise.'],
    ];
}

function pz_tips_tortoise_care_guide() {
    return [
        ['Don\'t copy a turtle\'s water-and-land housing setup', 'A tortoise is land-dwelling and doesn\'t need the swimming area a turtle\'s housing requires.'],
        ['Give grazing tortoises room to forage, not just a small enclosure', 'Grazing behavior benefits from more open space to move through and feed in.'],
        ['Consider a secure outdoor grazing area if your climate supports it', 'Outdoor space is a distinct option worth considering alongside or instead of an indoor-only setup.'],
        ['Expect reduced activity during brumation season', 'A slowdown in activity and appetite during brumation is a normal pattern in many tortoises, not a sign of illness.'],
        ['Make sure a UVB source reaches your tortoise, not just sunlight through a window', 'Sunlight through glass or plastic has its UVB filtered out, so indoor tortoises need a dedicated UVB bulb rather than relying on a sunny window.'],
        ['Think across decades when deciding on a tortoise', 'Some tortoises can live exceptionally long lives, in some cases outliving their owners, so this can be a very long-term commitment.'],
    ];
}

function pz_mistakes_tortoise_care_guide() {
    return [
        ['❌ Confusing tortoise care with turtle care', 'A tortoise is land-dwelling while a turtle is aquatic or semi-aquatic, so their housing needs are genuinely different, not interchangeable.'],
        ['❌ Housing a tortoise with no grazing or foraging space', 'As herbivorous grazers, tortoises benefit from room to move and forage, not just a small, static enclosure.'],
        ['❌ Assuming brumation means something is wrong', 'A seasonal slowdown is a common, normal pattern in many tortoises rather than a health concern.'],
        ['❌ Relying on a sunny window instead of real UVB', 'Sunlight through glass or plastic has its UVB filtered out, so an indoor tortoise still needs an artificial UVB source.'],
        ['❌ Underestimating how long a tortoise can live', 'Some tortoises can live exceptionally long lives, in some cases outliving their owners, a longer commitment than many owners initially plan for.'],
        ['❌ Overlooking outdoor grazing space as an option', 'Where climate allows, outdoor grazing areas are a distinct consideration from an indoor tank that many tortoises benefit from.'],
    ];
}

function pz_faq_tortoise_care_guide() {
    return [
        ['Is a tortoise the same as a turtle?', 'No — tortoises are land-dwelling members of the turtle family, which is why their care is different from the aquatic/semi-aquatic turtles most people keep as pets.'],
        ['What do tortoises eat?', 'Tortoises are herbivorous grazers that eat plant matter, which also shapes how much space they need to forage.'],
        ['Do tortoises need UVB lighting?', 'Yes — tortoises need UVB for calcium metabolism. Outdoor tortoises get it from real sunlight, since glass or plastic filters UVB out, while indoor tortoises need an artificial UVB source.'],
        ['How long do tortoises live?', 'Some tortoises can live exceptionally long lives, in some cases outliving their owners, an even longer timeline than the decades many pet turtles live.'],
        ['What is brumation in tortoises?', 'It\'s a natural seasonal slowdown in activity and appetite, the same general concept seen in some other reptiles, and many tortoise species are among the more commonly brumating groups.'],
        ['Do tortoises need outdoor space?', 'Many benefit from outdoor grazing areas where climate allows, which is a distinct housing consideration from an indoor tank setup.'],
    ];
}
