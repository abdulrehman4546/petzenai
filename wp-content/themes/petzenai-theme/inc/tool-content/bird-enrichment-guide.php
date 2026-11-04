<?php
/**
 * Tool-specific content for: Bird Enrichment Ideas & Mental Stimulation Guide (registry key: bird_enrichment_guide).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_bird_enrichment_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> A bored pet bird needs daily foraging for food, rotating toys, time out of the cage, and something to shred or chew — not just a bigger cage. Mix at least one toy from each category (forage, shred, climb, mirror-free noise/sound) and swap pieces weekly so nothing goes stale.</div>
<?php }

function pz_what_is_bird_enrichment_guide() {
    ob_start(); ?>
    <p>This guide covers how to keep a pet bird — budgie, cockatiel, parrotlet, conure, or larger parrot — mentally occupied for the many hours it spends in or near its cage. Birds are built to spend most of a wild day finding food, chewing, flying, and reading flock behavior, so a cage with a water dish and a perch is not a full life even if it covers the basics.</p>
    <p>Enrichment means giving a bird jobs to do: things to forage through, destroy, climb on, and figure out. Done well, it reduces the screaming, feather-plucking, and cage aggression that bird owners often assume is "just how parrots are," when it is frequently a bird with nothing to do.</p>
    <p>The ideas below are grouped by what they ask the bird to do, not by product name, so you can build a rotation from things you already own, cheap hardware-store items, and a handful of purchased toys rather than restocking the whole cage every month.</p>
    <?php return ob_get_clean();
}

function pz_why_important_bird_enrichment_guide() {
    ob_start(); ?>
    <p>Enrichment is not a luxury for birds; it fills the same behavioral need that foraging and flock life fill in the wild.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🧠</span>
        <div><strong>Foraging is a full-time wild job</strong><p>Wild parrots spend a large part of each day searching for and processing food. A bowl that is always full removes that job entirely, leaving hours with nothing to fill them.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🪶</span>
        <div><strong>Boredom shows up as feather damage</strong><p>Feather plucking and over-grooming are frequently linked to understimulation and stress rather than a single medical cause, which is why vets ask about toy rotation and out-of-cage time before anything else.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🦜</span>
        <div><strong>Chewing is a beak-health need, not just play</strong><p>A parrot's beak grows continuously, and gnawing on safe wood keeps it worn down and the jaw muscles exercised.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">📣</span>
        <div><strong>Screaming often means "entertain me"</strong><p>Attention-seeking vocalizing frequently drops once a bird has something to interact with during the hours its owner is busy or out of the room.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_bird_enrichment_guide() {
    return [
        ['title' => 'Audit the current cage', 'desc' => 'Note how many toys are in there, how long they have been in the same spot, and whether the food bowl is the only way the bird gets to eat.'],
        ['title' => 'Add one foraging task', 'desc' => 'Hide a few pellets or seeds inside a paper cup, a cardboard tube with the ends folded shut, or a foraging box, so the bird has to work for part of its meal.'],
        ['title' => 'Add one destructible item', 'desc' => 'Untreated balsa, pine, or willow pieces, a paper bag, or a cardboard box give a legitimate outlet for chewing instead of cage bars or furniture.'],
        ['title' => 'Rotate instead of adding forever', 'desc' => 'Keep 3-4 toys in the cage at a time and swap one out every few days from a small rotating stock, rather than cramming every toy in permanently.'],
        ['title' => 'Schedule out-of-cage time', 'desc' => 'Daily supervised time on a play stand, shoulder, or bird-safe room gives exercise and social contact a cage alone cannot.'],
        ['title' => 'Watch and adjust', 'desc' => 'If a toy is ignored for a week, retire it for now. If the bird destroys something in a day, that is a sign to buy more of that type, not less.'],
    ];
}

function pz_tips_bird_enrichment_guide() {
    return [
        ['Make breakfast a puzzle', 'Scatter part of the daily pellets in a foraging box or wrapped in paper instead of putting it all in the bowl.'],
        ['Use safe household items', 'Paper towel tubes, muffin cups, and plain paper are often more exciting to a bird than an expensive toy, and cost nothing.'],
        ['Vary toy texture and material', 'Mix wood, rope, leather-free plastic, and paper so the bird is not just gnawing one material.'],
        ['Mount toys at different heights', 'Spread them around the cage rather than clustering them near the favorite perch, so the bird has to move to use them.'],
        ['Keep a "toy library"', 'Store extra toys in a box and cycle them, instead of buying new ones every time the cage feels stale.'],
        ['Match toys to the species\' size and strength', 'A toy sized for a budgie can be a choking risk for it but ignored by a large parrot, so check the toy\'s intended bird size.'],
    ];
}

function pz_mistakes_bird_enrichment_guide() {
    return [
        ['❌ Filling the cage with toys and never rotating them', 'Birds habituate to toys that never change, so a cluttered but static cage can be just as understimulating as an empty one.'],
        ['❌ Using human jewelry, string, or rubber bands as toys', 'These can wrap around toes or necks or be swallowed; stick to toys made and sold for birds.'],
        ['❌ Assuming a bigger cage solves boredom', 'Space without activities to do in it does not replace foraging, chewing, and social interaction.'],
        ['❌ Only interacting with the bird to clean the cage or add food', 'Birds are social animals; a cage that is otherwise ignored all day leaves no outlet for social needs.'],
        ['❌ Using toys with zinc-plated or lead-weighted parts', 'Cheap metal clasps and bells on toys not made for birds can be toxic if chewed; buy toys labeled bird-safe.'],
        ['❌ Giving up on a destroyed toy as "a waste of money"', 'A toy a bird destroys quickly did its job — that is chewing enrichment working as intended.'],
    ];
}

function pz_faq_bird_enrichment_guide() {
    return [
        ['How many toys should be in a bird cage at once?', 'Most birds do well with roughly 3 to 5 items in the cage at a time, covering different jobs such as foraging, chewing, and climbing, rather than filling every inch of space. Too many at once can clutter flight and climbing room.'],
        ['How often should I rotate bird toys?', 'Swapping one or two items every few days to a week keeps things novel without constantly disrupting the bird\'s space. Watch which toys get used and which get ignored, and rotate the ignored ones out.'],
        ['My bird ignores every toy I buy — what now?', 'Try changing material or job rather than just buying more of the same type: a bird that ignores plastic rings might go after a foraging box or a shreddable paper toy. Introducing a new toy near a favorite perch, or hanging it where food used to be, can also help.'],
        ['Is foraging training hard to start?', 'No — start simple, such as hiding a few pellets under a loosely crumpled piece of paper in the bowl, and build up to lidded foraging boxes once the bird catches on. Most birds pick it up within days.'],
        ['Can enrichment help with feather plucking?', 'It can help when the plucking is linked to boredom or stress, which is common, but feather plucking also has medical causes such as skin or hormonal issues. A vet exam is the right first step before assuming it is purely behavioral.'],
        ['Does out-of-cage time count as enrichment?', 'Yes, and it is one of the most effective kinds — supervised time on a play stand or in a bird-safe room gives exercise, a change of scenery, and social contact that cage toys cannot fully replace.'],
        ['Are homemade toys safe?', 'Many are, if you stick to plain, untreated materials like paper, cardboard, and certain woods, and avoid string, rubber bands, and small parts that could be swallowed or tangle around toes.'],
    ];
}
