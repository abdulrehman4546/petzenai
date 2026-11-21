<?php
/**
 * Tool-specific content for: Cockatiel Care Guide: Diet, Health & Housing (registry key: cockatiel_care_guide).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_cockatiel_care_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> A cockatiel needs a cage at least 20x20x24 inches, a bowl built mainly from pellets and fresh vegetables rather than seed, and enough out-of-cage time to stretch its long tail feathers and fly. Watch the crest for mood cues, and expect whistling long before any talking.</div>
<?php }

function pz_what_is_cockatiel_care_guide() {
    ob_start(); ?>
    <p>The cockatiel (Nymphicus hollandicus) is a crested, long-tailed parrot from the cockatoo family, bred in many color mutations — grey, lutino, pied, pearl, and whiteface among them — but all sharing the same core housing and diet needs regardless of coloring.</p>
    <p>Its tail alone can run close to half the bird's total length, which is why a cockatiel's enclosure needs to be judged on floor footprint and depth, not just height the way a taller cage for a smaller bird might be.</p>
    <p>Owners sometimes pick a cockatiel expecting a quieter version of a larger parrot, and that's broadly fair on noise — but the trade-off is a bird that leans on whistled contact calls and crest signals instead of words, so reading those cues matters more here than it does with chattier species.</p>
    <?php return ob_get_clean();
}

function pz_why_important_cockatiel_care_guide() {
    ob_start(); ?>
    <p>Cockatiels have a reputation as a low-maintenance "starter parrot," and while their temperament is usually easier than a larger species', the housing, feeding, and attention they actually require doesn't scale down to match that reputation.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🏠</span>
        <div><strong>A long tail changes what "big enough" means</strong><p>Floor footprint matters as much as cage height for a cockatiel, since a tail that drags or presses against bars during turns gets damaged — 20x20x24 inches is the floor to start from.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🦜</span>
        <div><strong>The crest is its clearest mood display</strong><p>Few pet bird species telegraph mood as visibly as a cockatiel's crest does — tracking whether it sits flat, upright, or swept back tells you more than watching general posture alone.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🌾</span>
        <div><strong>Seed-only feeding is an easy trap with this species</strong><p>Cockatiels will happily eat nothing but seed for years if it's offered, which masks a diet that's running short on the vegetables and pellets its body actually needs.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🎵</span>
        <div><strong>Whistling, not speech, is the usual payoff</strong><p>Set expectations around tune-whistling rather than word-mimicry — it's the more typical cockatiel skill and, when it shows up readily, a decent sign the bird feels at ease.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_cockatiel_care_guide() {
    return [
        ['title' => 'Size the cage around the tail, not just the body', 'desc' => 'Start from 20x20x24 inches and check bar spacing is narrow enough to stop a head squeezing through, since a cockatiel\'s long tail needs floor room to clear corners without dragging or bending.'],
        ['title' => 'Shift the bowl toward pellets and vegetables', 'desc' => 'Make pellets the everyday base, add fresh vegetables most days, and treat seed as the smaller portion rather than the default — the <a href="/tools/bird-food-portion-calculator/">bird food portion calculator</a> turns weight and activity level into a daily calorie estimate to plan around.'],
        ['title' => 'Mix perch thickness across the cage', 'desc' => 'Swap at least one factory dowel perch for a natural branch of a different width, so the feet aren\'t gripping the same diameter every time they land.'],
        ['title' => 'Scout the room before any out-of-cage time', 'desc' => 'Shut windows, switch off fans, and tuck away anything chewable within reach, since a cockatiel loose in an unfamiliar room will land on and test whatever it can reach.'],
        ['title' => 'Build in daily one-on-one attention', 'desc' => 'A cockatiel housed alone leans more on its owner for company than a budgie typically would, so a consistent daily routine of handling or simply being nearby matters more here.'],
        ['title' => 'Treat a drooping crest or fluffed stillness as urgent', 'desc' => 'A cockatiel that goes quiet, stops perching normally, or shows a flattened crest for an extended stretch is worth an avian vet visit the same day, since this species tends to hide illness until it is fairly advanced.'],
    ];
}

function pz_tips_cockatiel_care_guide() {
    return [
        ['Watch the crest, not just the body language', 'A crest held tight and flat often means fear or discomfort, while one carried loosely upright usually points to a bird that\'s settled.'],
        ['Refresh the toy lineup instead of expanding it', 'Cycling two or three familiar toys in and out tends to hold a cockatiel\'s interest longer than leaving a large static pile in the cage permanently.'],
        ['Keep the cage off the direct path of heating or cooling vents', 'Sitting in the blast of an AC unit or a heater causes more temperature stress for a cockatiel than a draft-free interior spot slightly further from a window.'],
        ['Settle into a lights-out routine', 'Covering the cage or dimming the room at roughly the same time each evening helps a cockatiel wind down, since inconsistent bright evening light tends to leave them overtired.'],
        ['Let new foods sit beside the familiar ones', 'A cockatiel weaned onto mostly seed often won\'t touch an unfamiliar vegetable at first; placing it next to the regular bowl for a week or two usually works better than a sudden swap.'],
        ['Don\'t mistake quiet stillness for calm', 'A cockatiel that\'s usually whistling or moving and suddenly goes silent and motionless is more often signaling discomfort than contentment.'],
    ];
}

function pz_mistakes_cockatiel_care_guide() {
    return [
        ['❌ Picking a cage that\'s tall instead of wide', 'Height alone doesn\'t give a cockatiel\'s tail room to clear turns — floor footprint is the dimension that actually gets cramped first.'],
        ['❌ Letting seed become the default meal', 'A bowl that\'s mostly seed is heavy on fat and light on the nutrients pellets and vegetables provide, even though a cockatiel will eat it indefinitely without complaint.'],
        ['❌ Assuming "easier bird" means "low-upkeep bird"', 'A cockatiel\'s calmer temperament doesn\'t reduce its need for real flight space and daily interaction — it just makes the shortfall less obvious day to day.'],
        ['❌ Leaving every perch the same width', 'A cage full of identical dowel perches keeps a cockatiel gripping the exact same way every time it lands, and that lack of variety is what tends to cause trouble long term.'],
        ['❌ Reading a fluffed, silent cockatiel as relaxed', 'A normally active bird that goes still and puffs up is usually telling you something is wrong, not settling in for a nap.'],
    ];
}

function pz_faq_cockatiel_care_guide() {
    return [
        ['What size cage does a cockatiel need?', 'At least 20x20x24 inches, with floor space weighted as heavily as height since the tail needs room to clear turns without bending against the bars.'],
        ['What should I feed a cockatiel?', 'Lead with pellets, add fresh vegetables most days, and keep seed to occasional amounts rather than the main event — a seed-heavy bowl is easy to fall into with this species since they\'ll eat it happily either way.'],
        ['Do cockatiels learn to talk?', 'Rarely, and not as readily as some other parrot species — whistling tunes is the far more common vocal skill, and a bird that whistles freely is usually a comfortable one.'],
        ['Can a cockatiel live alone without another bird?', 'Yes, more comfortably than many parrot species, provided its owner supplies the daily attention a second bird would otherwise have provided.'],
        ['How can I tell if my cockatiel is unwell?', 'A crest held flat for long stretches, fluffed stillness, reduced activity, or any sudden change in droppings are all reasons to get an avian vet opinion rather than wait it out — this species is known for masking illness.'],
        ['What does the crest position mean?', 'Loosely upright usually reads as settled; held flat and tight against the head more often signals fear, stress, or discomfort, especially paired with other behavior changes.'],
        ['Is a cockatiel a good choice as a first parrot?', 'Often recommended for that reason, but the flight space, varied diet, and daily attention requirements don\'t shrink to match the calmer temperament — plan for the same baseline care a more demanding species would need.'],
    ];
}
