<?php
/**
 * Tool-specific content for: Indoor Rabbit Care Guide: House Rabbit Tips (registry key: indoor_rabbit_care_guide).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_indoor_rabbit_care_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> A house rabbit needs chew-proofed cords and furniture, a stable indoor temperature, and a litter box placed somewhere she can reach without crossing heavy household traffic. Indoor living is generally easier on a rabbit than an outdoor hutch, but only once the home itself is set up with her habits in mind.</div>
<?php }

function pz_what_is_indoor_rabbit_care_guide() {
    ob_start(); ?>
    <p>Indoor rabbit care means adapting the house itself around a rabbit's natural habits — chewing, digging, and needing a quiet, predictable spot to retreat to — rather than adapting the rabbit to fit the house. This guide focuses on the parts of indoor living that are specific to being inside: proofing rooms against chewing, managing temperature and drafts, and choosing a workable spot for the litter box within a busy home.</p>
    <p>It does not re-cover how large her dedicated exercise pen should be or the mechanics of litter training itself — those are their own topics. What matters here is the layout and proofing decisions that make a house genuinely safe and workable for a rabbit who lives in it full time.</p>
    <?php return ob_get_clean();
}

function pz_why_important_indoor_rabbit_care_guide() {
    ob_start(); ?>
    <p>A rabbit who lives indoors is exposed to hazards an outdoor hutch simply doesn't have — exposed cords, houseplants, furniture legs, and gaps behind appliances — while also benefiting from a more stable, climate-controlled environment than most backyards offer.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🔌</span>
        <div><strong>Cords and cables are a chewing magnet</strong><p>A rabbit's instinct to gnaw doesn't distinguish between a chew toy and a live cord, so exposed wiring is a safety hazard, not just a property one.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🌡️</span>
        <div><strong>Indoor temperature control is a real advantage</strong><p>A climate-controlled home avoids the extreme heat and cold swings an outdoor hutch is exposed to, which is one of the clearest benefits of house-rabbit living.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🚪</span>
        <div><strong>Litter box placement affects whether it actually gets used</strong><p>A box tucked in a high-traffic hallway or a spot she has to cross an open, exposed area to reach often gets avoided in favor of a corner she feels safer in.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🪑</span>
        <div><strong>Furniture and baseboards need proofing too</strong><p>Chewed furniture legs and baseboards are a common and preventable side effect of letting a rabbit roam an unproofed room.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_indoor_rabbit_care_guide() {
    return [
        ['title' => 'Walk the room at rabbit height', 'desc' => 'Get down near floor level and look for anything within reach of a hop or a stretch — cords, loose rugs, exposed wires, and low furniture edges all stand out from this angle.'],
        ['title' => 'Cover or route cords out of reach', 'desc' => 'Cord protectors, cable channels along the wall, or simply rerouting cords behind furniture she can\'t access all reduce the temptation to chew them.'],
        ['title' => 'Block access to furniture legs she targets', 'desc' => 'Furniture guards, a flat panel, or rearranging so the leg isn\'t an open invitation can save both the furniture and her digestion if she swallows splinters.'],
        ['title' => 'Keep her main living area away from vents and drafts', 'desc' => 'A spot directly under an AC vent or in a drafty hallway swings in temperature more than a stable interior room, so pick her main area with that in mind.'],
        ['title' => 'Place the litter box in a calm, reachable corner', 'desc' => 'A quiet corner of her main room that doesn\'t require crossing open floor or heavy foot traffic tends to get used far more consistently than one in a busy walkway.'],
        ['title' => 'Recheck the room after rearranging furniture', 'desc' => 'Moving a couch or shelf can expose a cord or gap that wasn\'t accessible before, so a quick re-walk of the space after any furniture change is worth the few minutes.'],
    ];
}

function pz_tips_indoor_rabbit_care_guide() {
    return [
        ['Give her a predictable "home base" spot', 'A consistent corner with her litter box and a hideaway gives her somewhere to retreat to, which matters more indoors where household activity is constant.'],
        ['Watch for drafts near doors and windows in winter', 'A spot that feels fine to you standing can still have a noticeable draft near the floor where she actually spends her time.'],
        ['Keep houseplants out of reach or off the floor', 'Many common houseplants are unsafe if chewed, so treat them the same way you would an exposed cord.'],
        ['Use baby gates instead of closed doors when possible', 'A gate lets her see and hear the household while still keeping her out of rooms that aren\'t proofed yet.'],
        ['Reassess proofing as she ages', 'An older, calmer rabbit may chew less, but a young or newly adopted one often tests boundaries more, so don\'t assume early proofing covers her for life.'],
    ];
}

function pz_mistakes_indoor_rabbit_care_guide() {
    return [
        ['❌ Assuming a rabbit will avoid cords on her own', 'Chewing is instinctual, not a judgment call on her part, so unprotected cords stay a risk regardless of how calm she seems.'],
        ['❌ Placing the litter box in a high-traffic hallway', 'A box she has to use while people and pets pass by constantly is more likely to get avoided in favor of a corner elsewhere in the room.'],
        ['❌ Letting her free-roam a room before proofing it', 'Skipping the walk-through proofing step means discovering the hazards after the chewing has already happened.'],
        ['❌ Keeping her main area right next to a heating or AC vent', 'Direct airflow can create more temperature swings in that one spot than the rest of the climate-controlled room experiences.'],
        ['❌ Forgetting to recheck proofing after rearranging furniture', 'A newly exposed gap or cord behind a moved piece of furniture is easy to miss if you don\'t re-walk the room.'],
    ];
}

function pz_faq_indoor_rabbit_care_guide() {
    return [
        ['Is it easier to control temperature for a rabbit indoors than outdoors?', 'Generally yes — a climate-controlled home avoids the extreme heat and cold swings an outdoor hutch is exposed to, which is one of the main advantages of house-rabbit living.'],
        ['Where should I put the litter box in the house?', 'A calm corner of her main living area that doesn\'t require crossing a busy walkway tends to get used more reliably than a spot in a high-traffic hallway.'],
        ['How do I stop my rabbit from chewing cords?', 'Cover or reroute cords out of reach using cord protectors or cable channels — chewing is instinctual, so proofing the cord is more reliable than expecting her to leave it alone.'],
        ['Are houseplants a concern for an indoor rabbit?', 'Yes, many common houseplants are unsafe if chewed, so keep them out of reach or off the floor the same way you would an exposed cord.'],
        ['Do I need to re-proof a room after moving furniture?', 'Yes — rearranging furniture can expose a cord or gap that wasn\'t accessible before, so a quick re-walk of the space is worth doing after any change.'],
        ['Is a baby gate better than a closed door for keeping her in one area?', 'Often yes, since a gate lets her stay aware of household activity while still restricting her to rooms that are properly proofed.'],
    ];
}
