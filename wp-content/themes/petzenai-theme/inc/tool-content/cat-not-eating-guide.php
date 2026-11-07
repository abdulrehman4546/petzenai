<?php
/**
 * Tool-specific content for: Cat Not Eating: Causes & Solutions Guide (registry key: cat_not_eating_guide).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_cat_not_eating_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> A cat that skips one meal but is otherwise acting normal can often be watched for a short time, but a cat that goes 24 hours without eating anything needs a vet visit, since cats are prone to a serious liver condition called hepatic lipidosis when they stop eating, especially if they are overweight. Common causes range from stress and dental pain to kidney disease, nausea, and respiratory infections that block smell. Any total loss of appetite in a cat should be taken seriously.</div>
<?php }

function pz_what_is_cat_not_eating_guide() {
    ob_start(); ?>
    <p>A cat refusing to eat, called anorexia or inappetence, is one of the more common and genuinely important symptoms owners see, because cats are unusually vulnerable to the effects of not eating compared to many other animals. Unlike dogs or humans, cats can develop a dangerous liver condition called hepatic lipidosis (fatty liver disease) within as little as 24 to 48 hours of not eating, particularly if they are overweight, according to veterinary sources including VCA and Cornell.</p>
    <p>Causes of reduced appetite are wide-ranging: dental pain, nausea from almost any illness, stress from a household change, upper respiratory infections that block the sense of smell, kidney disease, pancreatitis, cancer, and many other conditions can all show up first as a cat that simply stops eating.</p>
    <p>Because the underlying cause can be anything from minor and temporary to serious, the two most important things to track are how long the cat has gone without eating and whether anything else seems off, like lethargy, vomiting, or hiding.</p>
    <?php return ob_get_clean();
}

function pz_why_important_cat_not_eating_guide() {
    ob_start(); ?>
    <p>Appetite loss in cats deserves faster action than many owners expect, because the consequences of not eating can become serious well before the underlying cause is identified.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🫀</span>
        <div><strong>Hepatic lipidosis develops quickly</strong><p>When a cat's body isn't getting enough calories, especially an overweight cat, fat is mobilized to the liver faster than it can process it, which can lead to liver failure within days of not eating.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">👃</span>
        <div><strong>Cats rely heavily on smell to want to eat</strong><p>Upper respiratory infections that cause nasal congestion can suppress appetite simply because the cat can\'t smell the food, even though nothing is wrong with the digestive system.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🦷</span>
        <div><strong>Dental pain is an underrated cause</strong><p>Cats are good at hiding mouth pain. A cat that approaches food, then walks away or eats only soft food, may have a dental problem rather than a lack of hunger.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">😿</span>
        <div><strong>Stress alone can stop a cat from eating</strong><p>Moving, a new pet, a new baby, or even rearranged furniture can be enough to make a sensitive cat stop eating temporarily, though this still needs monitoring to avoid it becoming prolonged.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_cat_not_eating_guide() {
    return [
        ['title' => 'Note exactly how long it has been', 'desc' => 'Track the last time your cat ate normally. Less than 24 hours with otherwise normal behavior can often be monitored; 24+ hours of eating nothing warrants a vet call.'],
        ['title' => 'Check for other symptoms', 'desc' => 'Lethargy, hiding, vomiting, diarrhea, weight loss, drooling, or bad breath alongside not eating all point toward needing veterinary evaluation rather than waiting it out.'],
        ['title' => 'Look in the mouth if your cat allows it', 'desc' => 'Red gums, visible tartar, a broken tooth, or drooling can point to dental pain as the cause. Don\'t force this if your cat resists; mention it to your vet instead.'],
        ['title' => 'Try a few simple encouragements', 'desc' => 'Warming wet food slightly, offering a stronger-smelling option like tuna-flavored food, or hand-feeding small amounts can sometimes jump-start eating in a mildly stressed or nauseated cat.'],
        ['title' => 'Rule out an environmental or stress trigger', 'desc' => 'Think about recent changes: new pets, moving, construction noise, or a change in food or bowl location. Addressing the stressor sometimes resolves mild cases.'],
        ['title' => 'See a vet promptly if it continues or your cat seems unwell', 'desc' => 'Your vet can run bloodwork, check for dental disease, and assess for underlying illness. Don\'t wait past 24–48 hours of no food intake, especially in an overweight or senior cat.'],
    ];
}

function pz_tips_cat_not_eating_guide() {
    return [
        ['Don\'t force-feed without veterinary guidance', 'Forcing food can cause aspiration or added stress. If your cat truly won\'t eat, a vet visit to address the underlying cause and, if needed, provide supportive feeding is safer.'],
        ['Warm wet food slightly', 'Lightly warming food (never hot) can intensify the aroma and make it more appealing to a cat with a reduced appetite.'],
        ['Offer a few different textures and flavors', 'A cat avoiding one food isn\'t always "just picky." Offering a couple of gentle variations can help you figure out whether it\'s a preference issue or something more concerning.'],
        ['Reduce stress around feeding time', 'Feed in a quiet, low-traffic area away from other pets, and keep the routine predictable, since stress is a common and often overlooked contributor to reduced appetite.'],
        ['Keep a weight log, especially for overweight cats', 'Overweight cats are at the highest risk for hepatic lipidosis when they stop eating, so tracking weight helps you and your vet catch dangerous trends early.'],
        ['Watch litter box output as an appetite proxy', 'A cat not eating or drinking will usually produce less urine and fewer stools, which can be an early clue something is wrong even before you\'re sure about the food itself.'],
    ];
}

function pz_mistakes_cat_not_eating_guide() {
    return [
        ['❌ Waiting several days to see a vet', 'Because of the risk of hepatic lipidosis, cats that stop eating need attention much sooner than many owners assume, especially if they are overweight.'],
        ['❌ Assuming a cat is "just being picky"', 'True pickiness is less common than people think; a sudden refusal to eat a previously liked food is often a sign of nausea, pain, or illness rather than preference.'],
        ['❌ Switching foods repeatedly to find something they\'ll eat', 'Constant food switching can mask an underlying medical cause and sometimes causes its own digestive upset. If appetite loss continues for more than a day, see a vet rather than cycling through foods.'],
        ['❌ Ignoring bad breath or drooling', 'These are common signs of dental disease, which is a very frequent and treatable cause of reduced eating in cats.'],
        ['❌ Force-feeding at home without guidance', 'This can cause stress, aspiration, or a negative association with food, and doesn\'t address the root cause. Veterinary-guided feeding support is safer when needed.'],
        ['❌ Overlooking appetite loss in an overweight cat as "fine, she\'ll just lose some weight"', 'Overweight cats are specifically the highest-risk group for hepatic lipidosis when they stop eating, so a lack of appetite in a heavier cat deserves faster attention, not less.'],
    ];
}

function pz_faq_cat_not_eating_guide() {
    return [
        ['How long can a cat go without eating before it\'s dangerous?', 'Generally, 24 hours of completely refusing food is considered a reason to contact a vet, and overweight or senior cats should be seen even sooner, since they are more prone to rapid liver complications from not eating.'],
        ['Why is my cat not eating but still drinking water?', 'This pattern can occur with nausea, dental pain, or early illness where thirst is less affected than appetite. It still warrants attention, especially if it continues beyond a day.'],
        ['Can stress cause a cat to stop eating?', 'Yes, changes like moving, new pets, loud noises, or household disruption can cause temporary appetite loss in sensitive cats. If it doesn\'t resolve within a day or so, or if other symptoms appear, see a vet.'],
        ['What is hepatic lipidosis?', 'It\'s a serious liver condition where fat accumulates in the liver faster than it can be processed, triggered by cats not eating enough for even a short period, especially if they are overweight. It can become life-threatening and needs prompt veterinary treatment.'],
        ['Could dental problems be why my cat isn\'t eating?', 'Yes, dental pain, broken teeth, and gum disease are common causes of reduced eating in cats, particularly if your cat approaches food but won\'t chew it or prefers only soft food.'],
        ['Is it normal for a sick cat not to want to eat?', 'Reduced appetite accompanies many illnesses in cats, from minor infections to serious conditions like kidney disease or cancer. It\'s a symptom worth investigating rather than something to simply wait out, especially if it persists.'],
        ['What can I do at home to encourage my cat to eat?', 'Warming food slightly, offering a stronger-smelling option, reducing stress at mealtimes, and hand-feeding small amounts can help with mild, short-term appetite dips, but a cat that goes a full day without eating needs veterinary evaluation rather than home remedies alone.'],
    ];
}
