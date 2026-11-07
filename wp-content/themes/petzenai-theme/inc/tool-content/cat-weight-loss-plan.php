<?php
/**
 * Tool-specific content for: Cat Weight Loss Plan Calculator (registry key: cat_weight_loss_plan).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_cat_weight_loss_plan() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Safe weight loss for cats is slow: aim for roughly 0.5-2% of body weight lost per week, through measured portions and more activity, never through sudden starvation. Losing weight too fast puts cats at risk of a serious liver condition called hepatic lipidosis, so any weight-loss plan should start with a vet confirming your cat's target weight.</div>
<?php }

function pz_what_is_cat_weight_loss_plan() {
    ob_start(); ?>
    <p>A cat weight loss plan is a structured, gradual approach to helping an overweight cat reach a healthier body weight through controlled calorie intake and increased activity, rather than a crash diet.</p>
    <p>Unlike people, cats are physiologically vulnerable to rapid weight loss. When a cat loses weight too quickly, especially by not eating enough, the body can mobilize fat faster than the liver can process it, leading to hepatic lipidosis, a potentially fatal buildup of fat in the liver described by the Cornell Feline Health Center and VCA Hospitals. This is why cat weight loss must be slow and monitored.</p>
    <p>A sound plan starts with your vet confirming a target weight and ruling out medical causes of weight gain, then sets a modest calorie deficit, measured feeding, and added enrichment or play to increase activity, with regular weigh-ins to track progress.</p>
    <?php return ob_get_clean();
}

function pz_why_important_cat_weight_loss_plan() {
    ob_start(); ?>
    <p>Feline obesity is one of the most common preventable health problems in pet cats, and a careful approach to weight loss protects against both the risks of being overweight and the risks of losing weight the wrong way.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">📊</span>
        <div><strong>Obesity is widespread in pet cats</strong><p>The Association for Pet Obesity Prevention has repeatedly found that more than half of pet cats in the US are overweight or obese, putting them at higher risk for diabetes, joint disease, and reduced lifespan.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🫀</span>
        <div><strong>Crash dieting can be fatal</strong><p>Cats that stop eating or lose weight too fast can develop hepatic lipidosis, a liver condition that can become life-threatening within days to weeks if not caught and treated.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🦴</span>
        <div><strong>Extra weight strains joints and organs</strong><p>Carrying excess weight increases stress on joints and is linked to a higher risk of type 2 diabetes and reduced mobility, according to VCA Hospitals.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🩺</span>
        <div><strong>Underlying conditions can cause weight gain or resist loss</strong><p>Conditions like hypothyroidism-adjacent issues or reduced mobility from arthritis can contribute to weight gain or make loss harder, which is why a vet visit should come before starting a weight-loss plan.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_cat_weight_loss_plan() {
    return [
        ['title' => 'Get a vet check and target weight', 'desc' => 'A vet can rule out medical causes of weight gain and estimate your cat\'s ideal weight using body condition scoring, giving you a real target instead of a guess.'],
        ['title' => 'Calculate a modest calorie deficit', 'desc' => 'A commonly used starting point is feeding around 80% of the calories needed to maintain current weight, adjusted based on your cat\'s response over the following weeks.'],
        ['title' => 'Switch to measured, scheduled meals', 'desc' => 'Move away from free-feeding to two to four measured meals a day using a kitchen scale, so you know exactly how much your cat eats.'],
        ['title' => 'Increase activity gradually', 'desc' => 'Add short daily play sessions with wand toys or food puzzles that make her work for calories, building activity slowly rather than all at once.'],
        ['title' => 'Weigh your cat weekly', 'desc' => 'Use the same scale at the same time of day each week and track the numbers, aiming for roughly 0.5-2% of body weight lost per week.'],
        ['title' => 'Adjust and recheck with your vet', 'desc' => 'If weight loss stalls or happens too fast, adjust calories by about 10% and consider a vet recheck to confirm the plan is still on track and safe.'],
    ];
}

function pz_tips_cat_weight_loss_plan() {
    return [
        ['Never let an overweight cat go without food for more than a day', 'Even a cat that seems to be "fasting itself" needs veterinary attention, since any prolonged drop in food intake risks triggering hepatic lipidosis.'],
        ['Use a food puzzle instead of a bowl', 'Puzzle feeders slow down eating, add mental stimulation, and turn mealtime into light activity, all of which support gradual weight loss.'],
        ['Switch calorie-dense treats for low-calorie ones', 'Small pieces of plain cooked chicken or commercial low-calorie treats let you reward your cat without undoing the day\'s calorie plan.'],
        ['Track body condition, not just the scale', 'Feeling for ribs under a thin layer of fat and looking for a visible waist from above gives a fuller picture of progress than weight alone.'],
        ['Be patient: plan for months, not weeks', 'A cat that needs to lose a meaningful amount of weight may need several months of steady, slow loss; rushing the timeline increases health risk.'],
        ['Feed multi-cat households separately during a diet', 'Separate feeding stations or timed feeders prevent a dieting cat from eating another cat\'s food, or vice versa.'],
    ];
}

function pz_mistakes_cat_weight_loss_plan() {
    return [
        ['❌ Starving or severely restricting food suddenly', 'This is the single most dangerous mistake in cat weight loss and can trigger hepatic lipidosis, a life-threatening liver condition, within days.'],
        ['❌ Skipping the vet visit before starting', 'Weight gain can have medical causes, and a vet-confirmed target weight and health clearance make the whole plan safer and more effective.'],
        ['❌ Expecting fast results', 'Cats need slow, steady weight loss of about 0.5-2% of body weight per week; faster loss is a red flag, not a win.'],
        ['❌ Not accounting for treats in the calorie count', 'Treats and table scraps can quietly add a significant share of daily calories, stalling progress even when meals are well measured.'],
        ['❌ Giving up after a plateau', 'Weight loss often slows or pauses temporarily; recalculating calories or rechecking with a vet is more productive than abandoning the plan.'],
        ['❌ Ignoring sudden appetite loss during the diet', 'If a dieting cat stops eating even the reduced amount, this needs prompt vet attention rather than waiting it out.'],
    ];
}

function pz_faq_cat_weight_loss_plan() {
    return [
        ['How fast should a cat lose weight safely?', 'A generally cited safe pace is roughly 0.5-2% of body weight per week. For a 12 lb cat, that is about 1-2 ounces a week. Faster loss raises the risk of hepatic lipidosis, a dangerous liver condition.'],
        ['How many calories should I cut for weight loss?', 'A common starting point is about 80% of the calories needed to maintain current weight, then adjusting based on how your cat responds over several weeks. Your vet can help set a more precise number based on her target weight.'],
        ['Can I just feed less of the same food?', 'You can, but it\'s easy to under- or overshoot without measuring. Use a kitchen scale and track the exact amount fed daily so you can adjust in small, deliberate increments.'],
        ['Is it dangerous if my cat stops eating during a diet?', 'Yes, this is a warning sign. Any cat that stops eating or eats very little for more than a day or two, especially while overweight, is at risk for hepatic lipidosis and needs prompt veterinary attention.'],
        ['Will exercise alone help my cat lose weight?', 'Activity helps, but calorie intake has a bigger impact for most cats. Combining measured feeding with daily play sessions and food puzzles tends to work better than exercise alone.'],
        ['How do I know my cat\'s target weight?', 'A vet can estimate ideal weight using body condition scoring, which assesses rib coverage, waist, and abdominal fat, since a universal "ideal weight" chart doesn\'t account for individual body frames.'],
        ['What if my cat\'s weight loss stalls?', 'Plateaus are common. Recheck the accuracy of your measuring, account for any treats, and consider adjusting calories by about 10% or consulting your vet for a recheck.'],
    ];
}
