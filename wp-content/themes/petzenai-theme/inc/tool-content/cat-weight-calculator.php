<?php
/**
 * Tool-specific content for: Cat Ideal Weight Calculator by Breed (registry key: cat_weight_calculator).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_cat_weight_calculator() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> There is no single ideal weight for "a cat" because breed and frame size vary enormously, from a lean 6-pound Siamese to a large-framed 18-pound Maine Coon that is perfectly healthy. Vets judge ideal weight using a 9-point body condition score that checks ribs, waist, and belly shape, not a number on a scale alone.</div>
<?php }

function pz_what_is_cat_weight_calculator() {
    ob_start(); ?>
    <p>This guide explains how vets actually determine whether a cat is at a healthy weight: the body condition score, or BCS, system, which looks at how easily you can feel the ribs, whether there is a visible waist from above, and how much fat sits over the belly and spine. A score of 5 out of 9 is generally considered ideal.</p>
    <p>Breed and frame matter a great deal. A large-boned breed like a Maine Coon or Ragdoll can weigh 15-20 pounds at a healthy, lean body condition, while a small-framed breed like a Siamese may be perfectly healthy at 6-10 pounds. Comparing either cat to a flat "average cat weight" number would be misleading.</p>
    <p>Rather than chasing a single target number, the goal is reading your own cat's body condition directly and tracking it over time, ideally with input from your vet at routine checkups.</p>
    <?php return ob_get_clean();
}

function pz_why_important_cat_weight_calculator() {
    ob_start(); ?>
    <p>Knowing whether your cat is at a healthy weight, by breed and frame rather than a generic chart, helps you catch slow weight changes before they become a bigger health issue.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">📏</span>
        <div><strong>Breed size varies hugely</strong><p>A Maine Coon at 18 pounds can be lean and fit, while a domestic shorthair at 12 pounds may be carrying significant extra weight. Frame size has to factor into any judgment.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⚖️</span>
        <div><strong>Feline obesity is widespread</strong><p>Surveys of US pet cats have repeatedly found that roughly half or more are overweight or obese, which raises the risk of diabetes, joint problems, and other health issues.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">👐</span>
        <div><strong>Hands-on checks beat the scale alone</strong><p>Two cats of the same weight can have very different body conditions depending on frame and muscle mass, which is why feeling the ribs and waist matters more than a single number.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">📉</span>
        <div><strong>Unexplained weight loss is a red flag</strong><p>Unlike gradual weight gain, sudden or unexplained weight loss in a cat, especially an older one, can point to a serious underlying illness and should prompt a vet visit.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_cat_weight_calculator() {
    return [
        ['title' => 'Weigh your cat on a reliable scale', 'desc' => 'A baby scale or a bathroom scale (weighing yourself holding her, then subtracting your own weight) both work. Use the same scale each time for consistency.'],
        ['title' => 'Feel along the ribs', 'desc' => 'At a healthy weight, you should be able to feel the ribs easily under a thin layer of fat, without heavy pressing and without them being sharply visible.'],
        ['title' => 'Look for a waist from above', 'desc' => 'Standing over your cat, there should be a visible narrowing behind the ribs. A straight or bulging profile suggests extra weight.'],
        ['title' => 'Check the belly profile from the side', 'desc' => 'A slight tuck up behind the ribcage is normal. A belly that hangs or sways can indicate excess fat.'],
        ['title' => 'Compare against her own breed and frame, not a flat chart', 'desc' => 'A large-framed breed carrying more total weight is not automatically overweight; what matters is the body condition score, not pounds alone.'],
        ['title' => 'Track trends over weeks and months', 'desc' => 'One weigh-in tells you little. A slow upward or downward trend over several weeks is what actually signals a problem worth addressing.'],
    ];
}

function pz_tips_cat_weight_calculator() {
    return [
        ['Weigh monthly, not daily', 'Cat weight naturally fluctuates a bit day to day. Monthly checks on the same scale show real trends without the noise.'],
        ['Learn your cat\'s normal body condition when she is healthy', 'Knowing what "normal" feels like for your specific cat makes it much easier to notice a real change later.'],
        ['Ask your vet to show you a body condition check at a routine visit', 'Having a vet demonstrate the rib and waist check once in person makes it far easier to repeat accurately at home.'],
        ['Factor in life stage', 'Kittens are expected to gain steadily as they grow, and senior cats sometimes lose muscle even at a stable weight, so context matters more than the number alone.'],
        ['Do not compare across breeds', 'A healthy weight for a Maine Coon says nothing about what is healthy for a Siamese or a domestic shorthair; always judge within the individual cat\'s own frame.'],
        ['Treat sudden weight changes as a signal to call the vet', 'Rapid weight loss or gain over a few weeks, rather than a slow trend, is more likely to point to an underlying medical cause.'],
    ];
}

function pz_mistakes_cat_weight_calculator() {
    return [
        ['❌ Using a single generic weight number for every cat', 'Breed and frame size vary too much for one flat target to make sense across all cats.'],
        ['❌ Judging weight by the scale number alone', 'Two cats at the same weight can have very different body conditions. Feeling the ribs and waist matters as much as the number.'],
        ['❌ Assuming a large or fluffy-looking cat is automatically overweight', 'Thick fur and large frame breeds can look heavier than they are. A hands-on check cuts through the visual illusion.'],
        ['❌ Ignoring gradual weight gain because it happens slowly', 'Slow, steady gain over months is exactly how most feline obesity develops, and it is easy to miss without regular checks.'],
        ['❌ Putting an overweight cat on a sudden crash diet', 'Rapid weight loss in cats carries a real risk of a serious liver condition. Weight loss should be gradual and ideally guided by a vet.'],
        ['❌ Dismissing weight loss in an older cat as "just aging"', 'Unexplained weight loss in a senior cat is a common early sign of several treatable conditions and deserves a vet visit, not an assumption.'],
    ];
}

function pz_faq_cat_weight_calculator() {
    return [
        ['How do I know if my cat is overweight?', 'The most reliable check is feeling her ribs: if you have to press firmly to feel them, and there is no visible waist from above, she is likely carrying extra weight. A vet can confirm this with a body condition score during a checkup.'],
        ['What is a body condition score?', 'It is a 9-point scale vets use to judge weight by feel and appearance rather than pounds alone, looking at ribs, waist, and belly profile. A score of 5 is considered ideal, with lower scores indicating thin and higher scores indicating overweight or obese.'],
        ['Does breed really affect ideal weight that much?', 'Yes, significantly. A large-framed breed such as a Maine Coon or Ragdoll can be a healthy 15-20 pounds, while a small-framed breed such as a Siamese may be healthy at 6-10 pounds. Frame size has to be part of any weight judgment.'],
        ['My cat\'s weight has not changed, but she seems different. Does that matter?', 'Yes. A cat can lose muscle while staying the same weight, especially seniors, which can mask an underlying problem on the scale alone. A hands-on body condition check and a vet visit can pick up on this.'],
        ['How much weight loss in a cat is concerning?', 'Losing more than about 5-10% of body weight without a planned diet, especially over a few weeks, is worth discussing with a vet, since unexplained weight loss can be an early sign of several health conditions.'],
        ['How often should I check my cat\'s weight?', 'Monthly weigh-ins on the same scale, paired with an occasional hands-on body condition check, are enough to catch meaningful trends for most healthy adult cats. Kittens and cats with known health conditions may need more frequent checks.'],
        ['Can an indoor cat be a healthy weight even if she looks big?', 'Yes. Long or thick fur and a large frame can make a cat look heavier than her actual body condition. Feeling the ribs and checking the waist gives a more accurate picture than appearance alone.'],
    ];
}
