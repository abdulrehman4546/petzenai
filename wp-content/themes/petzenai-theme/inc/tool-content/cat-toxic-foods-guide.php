<?php
/**
 * Tool-specific content for: Foods Toxic to Cats: Complete Safety List (registry key: cat_toxic_foods_guide).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_cat_toxic_foods_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Onions, garlic, chocolate, grapes and raisins, alcohol, raw dough, and xylitol (an artificial sweetener) are among the most dangerous foods for cats. If your cat eats any of these, contact your vet or an animal poison control line right away rather than waiting to see symptoms.</div>
<?php }

function pz_what_is_cat_toxic_foods_guide() {
    ob_start(); ?>
    <p>This guide lists human foods and household items that are toxic or dangerous to cats, based on guidance from the ASPCA Animal Poison Control Center and the Pet Poison Helpline. It explains what makes each item dangerous and what signs to watch for.</p>
    <p>Cats are small, and their liver processes certain compounds very differently from ours, which is why foods that are harmless to people, like onions or a square of chocolate, can cause serious illness in a cat. Cats are also more sensitive to some toxins than dogs because of differences in liver enzymes.</p>
    <p>This list is not exhaustive and reactions can vary by cat, amount eaten, and the cat's size and health. If you know or suspect your cat has eaten something on this list, treat it as urgent and contact your vet or a poison control hotline immediately rather than waiting for symptoms to appear.</p>
    <?php return ob_get_clean();
}

function pz_why_important_cat_toxic_foods_guide() {
    ob_start(); ?>
    <p>Knowing which everyday foods are dangerous to cats helps you prevent accidental poisoning, which the ASPCA reports among the most common reasons for emergency vet visits in pets.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🧅</span>
        <div><strong>Onions and garlic damage red blood cells</strong><p>Members of the allium family, including onions, garlic, leeks, and chives, contain compounds that damage feline red blood cells and can cause hemolytic anemia, whether eaten raw, cooked, or as a powder in sauces and baby food.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🍫</span>
        <div><strong>Chocolate affects the heart and nervous system</strong><p>Chocolate contains theobromine and caffeine, which cats metabolize slowly. Dark and baking chocolate are more concentrated and more dangerous than milk chocolate, per the ASPCA, and signs include vomiting, elevated heart rate, and tremors.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🍇</span>
        <div><strong>Grapes and raisins can cause kidney injury</strong><p>Although better documented in dogs, the ASPCA lists grapes and raisins as a food to keep away from cats as well, since the exact toxic mechanism isn't fully understood and the safety margin is unclear.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🍞</span>
        <div><strong>Raw dough expands and ferments inside the stomach</strong><p>Yeast dough continues to rise in the warm, moist environment of the stomach, which can cause painful bloating and a dangerous twisting of the stomach, while the fermentation process also produces alcohol that is absorbed into the bloodstream.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_cat_toxic_foods_guide() {
    return [
        ['title' => 'Identify what and how much your cat ate', 'desc' => 'Note the specific food, an estimate of the amount, and when it happened. This information helps your vet or poison control assess the risk level quickly.'],
        ['title' => 'Call your vet or a poison control hotline immediately', 'desc' => 'Don\'t wait for symptoms. The ASPCA Animal Poison Control Center and Pet Poison Helpline are available for guidance on next steps, and many toxins cause internal damage before any outward signs appear.'],
        ['title' => 'Do not induce vomiting unless told to', 'desc' => 'Some substances cause more harm coming back up or shouldn\'t be vomited at all. Only induce vomiting if a vet or poison control specialist specifically instructs you to.'],
        ['title' => 'Remove any remaining food from reach', 'desc' => 'Secure the food item and any leftovers so your cat, or other pets, cannot access more of it while you seek help.'],
        ['title' => 'Watch for symptoms even if your cat seems fine', 'desc' => 'Vomiting, diarrhea, lethargy, drooling, elevated heart rate, or tremors can take hours to appear depending on the toxin, so continue monitoring as advised by your vet.'],
        ['title' => 'Follow up with your regular vet', 'desc' => 'Even after an emergency consult, a follow-up visit can check organ function via bloodwork, since some toxins cause delayed damage to the liver or kidneys.'],
    ];
}

function pz_tips_cat_toxic_foods_guide() {
    return [
        ['Store toxic foods completely out of reach', 'Cats are skilled climbers and counter-jumpers, so keep onions, garlic, chocolate, and grapes in closed cabinets rather than on open counters or in reachable bowls.'],
        ['Be cautious with "people food" leftovers', 'Gravy, sauces, and seasoned dishes often contain onion or garlic powder even when the dish doesn\'t look like it contains onions, so avoid sharing cooked leftovers casually.'],
        ['Keep alcohol and unbaked dough away from counters', 'Unattended drinks and rising bread dough left on a counter are easy for a curious cat to investigate, and both are genuinely dangerous in small amounts.'],
        ['Check sugar-free products for xylitol', 'Xylitol, a sweetener found in some sugar-free gum, baked goods, and peanut butter, is highly toxic to pets and is increasingly common in household products.'],
        ['Save packaging if your cat eats something unknown', 'Keeping the wrapper or container lets your vet or poison control quickly check the ingredient list for toxic components.'],
        ['Program the poison control number into your phone', 'Having the ASPCA Animal Poison Control Center or Pet Poison Helpline number saved means you won\'t lose time searching for it during an emergency.'],
    ];
}

function pz_mistakes_cat_toxic_foods_guide() {
    return [
        ['❌ Waiting to see if symptoms develop', 'Many toxins cause internal damage well before visible symptoms appear, so delaying a call to your vet or poison control reduces the chances of effective treatment.'],
        ['❌ Assuming "a little bit" is always safe', 'Toxic thresholds vary by the cat\'s size and the specific substance; even small amounts of some items, like xylitol or dark chocolate, can be dangerous for a small cat.'],
        ['❌ Giving home remedies like milk or salt water', 'Unproven home remedies can delay proper treatment or cause additional harm; always consult a vet or poison control professional for actual guidance.'],
        ['❌ Thinking cooked onion or garlic is safe', 'Cooking does not remove the compounds in alliums that damage feline red blood cells; powders and cooked forms are still dangerous.'],
        ['❌ Leaving alcohol or unbaked dough unattended', 'Both are more dangerous to cats, pound for pound, than many owners realize, and curious cats will investigate unattended food and drink.'],
        ['❌ Not telling the vet exactly what was eaten', 'Vague descriptions make it harder for a vet to judge urgency; specific information about the food and estimated amount leads to faster, more accurate guidance.'],
    ];
}

function pz_faq_cat_toxic_foods_guide() {
    return [
        ['What foods are most toxic to cats?', 'Onions, garlic, and other alliums, chocolate, grapes and raisins, alcohol, raw yeast dough, and xylitol are among the most dangerous, according to the ASPCA Animal Poison Control Center. Each affects cats differently, from damaging red blood cells to harming the kidneys or nervous system.'],
        ['My cat licked a small amount of onion sauce. Should I worry?', 'Yes, it\'s worth a call to your vet or a poison control line. Even small, repeated exposures to onion or garlic compounds can add up and damage red blood cells over time, and it\'s better to get guidance than assume it\'s fine.'],
        ['Is milk bad for cats?', 'Many adult cats are lactose intolerant and milk can cause digestive upset like diarrhea, though it\'s not considered a toxic emergency the way onions or chocolate are. It\'s best avoided or given only in very small amounts.'],
        ['Can cats eat tuna safely?', 'Plain tuna in small amounts is not toxic, but it isn\'t nutritionally complete and regular feeding can lead to mercury exposure or nutritional imbalances over time. It\'s best as an occasional treat, not a diet staple.'],
        ['What should I do if my cat eats chocolate?', 'Contact your vet or a poison control hotline immediately with information on the type and amount of chocolate eaten. Dark and baking chocolate are more concentrated and dangerous than milk chocolate.'],
        ['Are cooked bones dangerous for cats?', 'Yes, cooked bones can splinter and cause choking, internal punctures, or blockages. This is a physical hazard rather than a toxin, but it\'s equally serious and bones should be kept away from cats.'],
        ['How quickly do symptoms of food poisoning show up in cats?', 'This varies widely by toxin. Some, like chocolate, can cause symptoms within hours, while others, like onion toxicity, may take a day or more to show up as lethargy or pale gums. When in doubt, seek guidance immediately rather than waiting.'],
    ];
}
