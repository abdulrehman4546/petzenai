<?php
/**
 * Tool-specific content for: Bird Illness Signs Checker (registry key: bird_illness_signs_checker).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_bird_illness_signs_checker() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Fluffed feathers for long periods, sitting at the bottom of the cage, closed or crusty eyes, tail bobbing with each breath, and a noticeable drop in appetite or droppings are the most common early signs a pet bird is sick. Birds hide illness well, so any of these warrants an avian vet visit, ideally the same day.</div>
<?php }

function pz_what_is_bird_illness_signs_checker() {
    ob_start(); ?>
    <p>This checker walks through the physical and behavioral signs that commonly indicate a pet bird is unwell, organized by how urgent they typically are. Birds are prey animals by instinct, so they tend to mask weakness until a problem has progressed significantly, which is why owners are often caught off guard by how quickly a sick bird can decline.</p>
    <p>Rather than trying to diagnose a specific illness, this guide focuses on recognizing the pattern of change from your bird's normal baseline, since that is almost always the first and most reliable clue something is wrong.</p>
    <p>Use it alongside, not instead of, a relationship with an avian or exotics vet, since many bird illnesses need diagnostic testing to identify and treat properly.</p>
    <?php return ob_get_clean();
}

function pz_why_important_bird_illness_signs_checker() {
    ob_start(); ?>
    <p>Because birds mask sickness so effectively, the gap between "looks fine" and "critically ill" can be a matter of hours rather than days.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🕐</span>
        <div><strong>Birds hide symptoms until late</strong><p>As a prey species, birds instinctively conceal weakness to avoid looking vulnerable, so by the time obvious symptoms appear, an illness may already be advanced.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⚖️</span>
        <div><strong>Small body size means fast decline</strong><p>A bird's high metabolism and small reserves mean dehydration, infection, or blood loss can become life-threatening far more quickly than in a cat or dog of comparable relative size.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">📊</span>
        <div><strong>Baseline knowledge is your best early-warning tool</strong><p>Knowing your bird's normal weight, droppings, activity level, and vocal patterns lets you catch subtle deviations long before they become obvious to a stranger.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🏥</span>
        <div><strong>Avian vets are a limited resource</strong><p>Not every veterinary clinic treats birds, so knowing the signs early gives you time to locate an avian or exotics vet before an emergency hits.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_bird_illness_signs_checker() {
    return [
        ['title' => 'Establish your bird\'s normal baseline', 'desc' => 'Note typical weight, droppings appearance, vocal activity, and feather condition when healthy, so changes are easier to spot.'],
        ['title' => 'Watch posture and feather position', 'desc' => 'A healthy bird perches upright on both feet; one that sits fluffed, hunched, or on the cage floor for extended periods is signaling it feels unwell.'],
        ['title' => 'Check eyes, nares, and beak', 'desc' => 'Look for discharge, swelling, crustiness around the nares, or changes in beak color or texture, which can point to respiratory or systemic issues.'],
        ['title' => 'Monitor droppings daily', 'desc' => 'Changes in color, consistency, volume, or frequency of droppings are often the earliest visible clue to digestive or systemic problems.'],
        ['title' => 'Track appetite and weight', 'desc' => 'A bird eating less, or losing a noticeable amount of body weight, needs prompt attention since weight loss in small birds progresses fast.'],
        ['title' => 'Listen for changes in breathing or voice', 'desc' => 'Tail bobbing with each breath, open-mouth breathing, clicking sounds, or a hoarse or absent voice usually indicate a respiratory concern needing same-day care.'],
    ];
}

function pz_tips_bird_illness_signs_checker() {
    return [
        ['Weigh your bird weekly with a gram scale', 'Small, gradual weight loss is often invisible to the eye but shows up clearly on a scale, making it one of the most sensitive tools you have.'],
        ['Keep a droppings log for the first few weeks', 'Photographing normal droppings gives you a reference point to compare against if something looks off later.'],
        ['Warm the cage if your bird looks fluffed and lethargic', 'Sick birds lose the ability to regulate body temperature well, and gentle supplemental heat can help stabilize them on the way to the vet.'],
        ['Locate an avian vet before you need one', 'Search ahead of time for a vet experienced with your bird\'s species, since general practice vets may not be equipped for avian emergencies.'],
        ['Isolate a sick bird from other birds in the home', 'Many avian illnesses are contagious between birds, so separating a sick bird protects the rest of the flock while you seek care.'],
    ];
}

function pz_mistakes_bird_illness_signs_checker() {
    return [
        ['❌ Waiting for obvious symptoms before acting', 'Because birds hide illness so well, waiting for dramatic signs often means waiting until the bird is already in crisis.'],
        ['❌ Assuming a quiet, sleepy bird is just relaxed', 'Reduced activity and vocalization are among the earliest and most commonly missed signs of illness in pet birds.'],
        ['❌ Skipping regular weigh-ins', 'Without a weight history, it is very hard to notice gradual loss until the bird has already lost a dangerous percentage of its body weight.'],
        ['❌ Using a general practice vet with no avian experience', 'Bird physiology and medication dosing differ significantly from cats and dogs, so an avian or exotics specialist gives your bird the best chance.'],
        ['❌ Delaying care over a weekend or holiday', 'Bird illnesses can progress within hours, so a same-day or emergency exotics vet visit is usually worth it rather than waiting it out.'],
    ];
}

function pz_faq_bird_illness_signs_checker() {
    return [
        ['What are the first signs a bird is getting sick?', 'Early signs often include reduced vocalization, sitting fluffed for long periods, slightly decreased appetite, and subtle changes in droppings. These are easy to miss, which is why knowing your bird\'s normal baseline matters so much.'],
        ['Why do birds hide signs of illness so well?', 'As prey animals, birds have evolved to mask weakness to avoid appearing vulnerable to predators or flock rivals. This instinct persists in pet birds, so visible symptoms usually mean the illness has already progressed.'],
        ['What does it mean if my bird is bobbing its tail while breathing?', 'Tail bobbing synchronized with breathing is a sign of respiratory distress and is considered an emergency. A same-day visit to an avian vet is strongly advised.'],
        ['Should I be worried if my bird\'s droppings change?', 'Yes, droppings are one of the most useful early indicators of a bird\'s health. Changes in color, consistency, or frequency that last more than a day or two should prompt a vet call.'],
        ['How often should I weigh my bird?', 'Weekly weighing with a gram scale is a good routine for most pet birds, since weight loss is often the most measurable early sign of illness before other symptoms appear.'],
        ['When is a bird illness an emergency?', 'Open-mouth breathing, tail bobbing, bleeding, collapse, seizures, or a bird that cannot perch all warrant an immediate emergency vet visit rather than waiting to see if it improves.'],
        ['Can I treat a sick bird at home?', 'Supportive measures like warmth and a quiet, stress-free space can help while arranging care, but home remedies cannot replace veterinary diagnosis and treatment for an underlying illness.'],
    ];
}
