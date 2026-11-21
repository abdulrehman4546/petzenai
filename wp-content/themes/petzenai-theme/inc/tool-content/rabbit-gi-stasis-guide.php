<?php
/**
 * Tool-specific content for: GI Stasis in Rabbits: Signs & Emergency Guide (registry key: rabbit_gi_stasis_guide).
 * Medical emergency topic — content is deliberately limited to recognition and urgency to see a vet,
 * with no treatment steps, no dosage information, and no home remedies framed as adequate care.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_rabbit_gi_stasis_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> GI stasis is when a rabbit's digestive system slows down or stops, and it is a genuine emergency. A rabbit who stops eating, stops producing droppings, or sits hunched and unusually still needs to see a vet right away — this is not something to wait out at home.</div>
<?php }

function pz_what_is_rabbit_gi_stasis_guide() {
    ob_start(); ?>
    <p>GI stasis describes a rabbit's gut slowing down or stopping its normal movement. Because a rabbit's digestive system is built to keep food moving constantly, even a short stall can escalate quickly and become dangerous in a way that wouldn't be comparable in many other pets.</p>
    <p>It's commonly linked to inadequate fiber or hay intake, stress, dehydration, or pain somewhere else in the body — a dental problem, for instance, can be enough of a distraction from eating to trigger it. The exact cause isn't always obvious at home, which is part of why it needs a vet's evaluation rather than a guess.</p>
    <p>This guide is focused on helping you recognize the warning signs quickly and understand why fast vet care matters — it is not a treatment manual, and nothing here is meant to be used as a substitute for an in-person vet visit.</p>
    <?php return ob_get_clean();
}

function pz_why_important_rabbit_gi_stasis_guide() {
    ob_start(); ?>
    <p>GI stasis can go from a subtle change in behavior to a life-threatening emergency faster than most owners expect, which makes early recognition the single most useful thing you can do.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🚨</span>
        <div><strong>It is a genuine emergency, not a wait-and-see issue</strong><p>A rabbit's gut slowing or stopping can escalate quickly, so the appropriate response is a vet visit, not a few days of watching to see if it resolves on its own.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🍽️</span>
        <div><strong>Not eating is one of the clearest red flags</strong><p>A rabbit skipping meals for more than a few hours, especially alongside other signs, is a stronger warning sign in rabbits than in many other pets.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💧</span>
        <div><strong>Dehydration and stress can both be triggers</strong><p>Factors that seem minor on their own — a stressful move, a hot day, reduced water intake — can combine to slow the gut down.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🦷</span>
        <div><strong>Pain elsewhere in the body can be the real cause</strong><p>A dental problem or other source of pain can be enough to stop a rabbit from eating normally, which is one reason a vet exam matters more than guessing at home.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_rabbit_gi_stasis_guide() {
    return [
        ['title' => 'Watch for a stop or sharp drop in eating', 'desc' => 'A rabbit who skips hay, pellets, and treats for more than a few hours, especially after normally being a steady eater, is showing one of the earliest warning signs.'],
        ['title' => 'Check for a change in droppings', 'desc' => 'Small, dry, or noticeably reduced droppings — or none at all — are a sign the gut isn\'t moving normally and should not be ignored.'],
        ['title' => 'Notice posture and behavior changes', 'desc' => 'A rabbit who sits hunched, grinds her teeth, seems unusually still, or withdraws from normal interaction may be in pain.'],
        ['title' => 'Treat any combination of these signs as urgent', 'desc' => 'You don\'t need every sign present to take it seriously — reduced eating plus reduced droppings together is already enough reason to call a vet.'],
        ['title' => 'Contact a vet immediately, not after a wait-and-see period', 'desc' => 'Call your regular vet or an emergency animal hospital right away — this is a condition where hours matter, not days.'],
        ['title' => 'Bring details about recent changes to the appointment', 'desc' => 'Recent stress, a diet change, reduced water intake, or any other symptoms you\'ve noticed can help the vet evaluate what\'s going on faster.'],
    ];
}

function pz_tips_rabbit_gi_stasis_guide() {
    return [
        ['Know your rabbit\'s normal eating and dropping pattern', 'Recognizing a change quickly depends on knowing what "normal" looks like for her day to day.'],
        ['Keep an emergency vet contact saved and ready', 'Having the number for an emergency animal hospital on hand before you need it saves time in a genuine crisis.'],
        ['Don\'t wait to see if symptoms "pass"', 'Because this condition can escalate quickly, a few hours of not eating is already worth a call, not a reason to wait longer.'],
        ['Mention any recent stress or routine changes to your vet', 'A move, a new pet in the house, or a sudden diet change can all be relevant context for diagnosing what triggered it.'],
        ['Keep hay as the foundation of her everyday diet', 'Ongoing adequate fiber intake is one of the factors linked to gut health, which is relevant to long-term prevention even though it isn\'t a treatment for an active episode.'],
    ];
}

function pz_mistakes_rabbit_gi_stasis_guide() {
    return [
        ['❌ Waiting a day or two to see if she "bounces back"', 'This condition can escalate quickly, so delaying a vet visit when she isn\'t eating or producing normal droppings increases the risk.'],
        ['❌ Trying home remedies instead of calling a vet', 'Nothing done at home is a substitute for a vet\'s evaluation and care once these warning signs appear.'],
        ['❌ Assuming reduced droppings alone aren\'t a big deal', 'A clear drop in dropping output is one of the more telling signs and shouldn\'t be dismissed as a minor or temporary change.'],
        ['❌ Overlooking a hunched posture or teeth grinding', 'These can be signs of pain, which is relevant information for how urgently she needs to be seen.'],
        ['❌ Assuming it can\'t be serious because she still looks mostly normal', 'Early signs can be subtle, which is exactly why they\'re easy to underestimate until the condition has already progressed.'],
    ];
}

function pz_faq_rabbit_gi_stasis_guide() {
    return [
        ['What is GI stasis in rabbits?', 'It\'s when a rabbit\'s digestive system slows down or stops moving normally, which can become a life-threatening emergency quickly given how a rabbit\'s gut is built to work.'],
        ['What are the first signs of GI stasis?', 'A drop or stop in eating and a reduction in droppings are usually the earliest and clearest signs, often alongside a hunched posture or unusual stillness.'],
        ['Is GI stasis an emergency?', 'Yes — it should be treated as an emergency, with a call to a vet or emergency animal hospital right away rather than a wait-and-see approach.'],
        ['What causes GI stasis?', 'It\'s commonly linked to inadequate fiber or hay intake, stress, dehydration, or pain elsewhere in the body, such as a dental problem, though the exact cause isn\'t always obvious without a vet exam.'],
        ['Can I treat GI stasis at home?', 'No — this guide is focused on recognizing the signs, not treating the condition. A vet needs to evaluate and manage an active case; nothing done at home is an adequate substitute.'],
        ['How quickly does GI stasis need to be addressed?', 'As quickly as possible — hours matter with this condition, so contact a vet immediately once you notice signs rather than waiting to see if they improve.'],
    ];
}
