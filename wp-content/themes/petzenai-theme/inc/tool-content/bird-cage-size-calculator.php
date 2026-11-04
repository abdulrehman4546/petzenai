<?php
/**
 * Tool-specific content for: Bird Cage Size Calculator by Species (registry key: bird_cage_size_calculator).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_bird_cage_size_calculator() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> A single budgie or lovebird needs a cage at least 18×18×18 inches, a cockatiel needs about 20×20×24 inches, and larger parrots like African greys or amazons need 24×24×36 inches or more. Width matters more than height, since most birds fly side to side rather than straight up.</div>
<?php }

function pz_what_is_bird_cage_size_calculator() {
    ob_start(); ?>
    <p>This guide helps you work out whether your bird's cage is actually big enough, and what to look for if you're shopping for a new one. "Big enough for the pet store" and "big enough for a bird to live a healthy life" are often two very different things, and cage size is one of the most common welfare issues in pet birds.</p>
    <p>Rather than giving a single number, it walks through how cage dimensions, bar spacing, and perch placement interact for different species, from budgies and cockatiels up to larger parrots, so you can judge a cage against what your specific bird needs rather than a generic chart.</p>
    <p>If you already have a cage and are wondering whether it's a problem, the checklist below will help you spot the signs before they turn into feather damage or behavioral issues.</p>
    <?php return ob_get_clean();
}

function pz_why_important_bird_cage_size_calculator() {
    ob_start(); ?>
    <p>Birds are built to fly, climb, and move constantly. A cage that's too small restricts all three, and the effects show up in both body and behavior.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🦴</span>
        <div><strong>Muscle and bone health depend on movement</strong><p>Birds confined to small cages get less exercise for their wings and legs, which can weaken muscle tone and contribute to obesity over time.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🧠</span>
        <div><strong>Cramped space drives stress behaviors</strong><p>Feather plucking, excessive screaming, and cage aggression are frequently linked to insufficient space and lack of stimulation, according to avian behavior specialists.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">📏</span>
        <div><strong>Wingspan is the real baseline</strong><p>A bird should be able to fully extend and flap both wings without touching the bars on either side. For most species that means the cage needs to be wider than the bird's wingspan, not just its body length.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🛠️</span>
        <div><strong>Bar spacing prevents injury</strong><p>Spacing that's too wide for a small bird's head can lead to it getting stuck or escaping; spacing too narrow for a large parrot's beak can let it bend or chew its way out.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_bird_cage_size_calculator() {
    return [
        ['title' => 'Identify your bird\'s species and size', 'desc' => 'A budgie, a cockatiel, and an African grey all have very different space and bar-spacing needs, so start with an accurate ID.'],
        ['title' => 'Measure wingspan, not just body length', 'desc' => 'Have your bird fully extend its wings (or check a species reference) and make sure the cage width comfortably clears that measurement.'],
        ['title' => 'Check bar spacing for the species', 'desc' => 'Small birds like budgies need bars no more than about 1/2 inch apart; large parrots can have bars up to about 1.5 inches apart without risk of escape or injury.'],
        ['title' => 'Prioritize width over height', 'desc' => 'Most pet birds fly horizontally, so a wide, shallow cage is usually more useful to them than a tall, narrow one.'],
        ['title' => 'Plan perch and toy placement', 'desc' => 'Leave enough open floor and flight space between perches so your bird can move and flap without constantly bumping into accessories.'],
        ['title' => 'Budget for daily out-of-cage time regardless of size', 'desc' => 'Even the best cage is a resting place, not a substitute for supervised time out in a bird-safe room every day.'],
    ];
}

function pz_tips_bird_cage_size_calculator() {
    return [
        ['Go bigger than the minimum when you can', 'Minimum dimensions are a floor, not a target. A cage one size up gives your bird more room to climb, play, and avoid territorial tension with cage mates.'],
        ['Orient the cage for horizontal flight', 'A rectangular cage that\'s wider than it is tall lets most parrot species fly short distances, which a tall, narrow "tower" cage does not allow.'],
        ['Rotate toys and perches of different textures', 'Varying perch diameter helps foot health, and rotating toys keeps a bird using the space actively instead of sitting in one spot.'],
        ['Place the cage against a wall, not in the middle of a room', 'Birds feel safer with at least one solid side, which reduces stress-related behaviors that are often mistaken for a space problem.'],
        ['Reassess when you add a second bird', 'Two birds need meaningfully more space than one, not just a second perch in the same cage, to avoid resource guarding and injury.'],
    ];
}

function pz_mistakes_bird_cage_size_calculator() {
    return [
        ['❌ Buying by price or looks instead of species needs', 'A decorative cage that looks right for your home may be badly undersized or have bar spacing unsafe for your specific bird.'],
        ['❌ Measuring only cage footprint, not usable flight space', 'Perches, dishes, and toys all eat into the open area a bird actually has to move in, so usable space is always less than the listed dimensions.'],
        ['❌ Choosing height over width', 'A tall cage looks impressive but often gives a flying bird less usable horizontal space than a shorter, wider one.'],
        ['❌ Ignoring bar spacing for small birds', 'Bar spacing sized for a parrot can let a budgie or finch squeeze its head through and get stuck or escape.'],
        ['❌ Treating cage size as the only enrichment need', 'Even a large cage without toys, foraging opportunities, and daily interaction can still leave a bird understimulated.'],
    ];
}

function pz_faq_bird_cage_size_calculator() {
    return [
        ['What size cage does a budgie need?', 'A single budgie needs a cage at least 18×18×18 inches, though wider is better since budgies are active flyers. Bar spacing should be no more than about 1/2 inch to prevent escape or head entrapment.'],
        ['What size cage does a cockatiel need?', 'Cockatiels generally need at least 20×20×24 inches, with bar spacing around 1/2 to 5/8 inch. Larger is always welcome if space allows.'],
        ['What size cage do larger parrots like African greys or amazons need?', 'Mid-to-large parrots typically need cages around 24×24×36 inches or bigger, with bar spacing up to about 1 to 1.5 inches depending on beak strength and size.'],
        ['Is a taller cage or a wider cage better?', 'Wider is generally better, because most parrot species fly horizontally rather than vertically. A wide, shorter cage usually gives more usable flight space than a tall, narrow one of the same volume.'],
        ['Can two birds share one cage?', 'Only same-species or compatible pairs should share a cage, and it should be noticeably larger than what a single bird of that size would need, with two of each feeding station to avoid competition.'],
        ['How do I know if my bird\'s current cage is too small?', 'Watch for your bird\'s wings or tail brushing the bars when it moves, difficulty turning around on perches, feather damage, or increased screaming and aggression, all of which can point to insufficient space.'],
        ['Does cage size matter more than toys and enrichment?', 'Both matter. A large cage without stimulation can still leave a bird bored and stressed, while a cage that\'s genuinely too small limits even well-designed enrichment. Birds need adequate space and engagement together.'],
    ];
}
