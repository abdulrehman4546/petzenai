<?php
/**
 * Tool-specific content for: Cat Deworming Schedule Calculator (registry key: cat_deworming_schedule).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_cat_deworming_schedule() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Kittens are typically dewormed starting around 2-3 weeks old, repeated every 2 weeks until about 8 weeks, then monthly until 6 months. Adult cats are commonly dewormed, or tested with a fecal exam, about four times a year depending on lifestyle and risk. Your vet chooses the specific product and dose based on your cat's weight and a fecal test; this guide does not cover dosing.</div>
<?php }

function pz_what_is_cat_deworming_schedule() {
    ob_start(); ?>
    <p>Deworming is the routine treatment of intestinal parasites, like roundworms, hookworms, and tapeworms, that are extremely common in kittens and still show up periodically in adult cats. This guide covers the general timing recommended by parasite control organizations like CAPC, not specific drug names or doses, since the right product and amount depends on your cat's weight, health, and which parasites are present, and should always be determined by your vet.</p>
    <p>Kittens are born with a high likelihood of intestinal parasites, often passed from their mother, which is why their deworming schedule starts early and repeats frequently in the first couple of months. Adult cats pick up parasites through hunting, contact with soil or other animals' feces, or fleas (which can transmit tapeworm), so ongoing prevention stays relevant throughout life.</p>
    <p>A fecal exam, where a vet checks a stool sample under a microscope, is often used alongside or instead of blanket deworming in adults, to confirm what parasites, if any, are actually present before treating.</p>
    <?php return ob_get_clean();
}

function pz_why_important_cat_deworming_schedule() {
    ob_start(); ?>
    <p>Staying on top of deworming protects your cat's health and reduces the risk of certain parasites spreading to people in the household, especially children.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🍼</span>
        <div><strong>Kittens are especially vulnerable</strong><p>Intestinal parasites are extremely common in kittens and can cause poor growth, diarrhea, vomiting, and in severe cases, more serious complications, which is why their schedule starts early and repeats often.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🐾</span>
        <div><strong>Adult cats stay at ongoing risk</strong><p>Hunting, outdoor access, and flea exposure (which can transmit tapeworm) mean adult cats can pick up new parasites throughout their lives, not just as kittens.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🔬</span>
        <div><strong>Not all parasites cause obvious symptoms</strong><p>A cat can carry intestinal parasites without visible signs, which is why routine fecal testing, not just watching for symptoms, is part of the recommended approach.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">👪</span>
        <div><strong>Some parasites are a concern for people too</strong><p>Certain intestinal parasites in cats can potentially spread to people, especially young children, through contaminated soil or litter box contact, making routine prevention a household health matter.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_cat_deworming_schedule() {
    return [
        ['title' => 'Start kitten deworming around 2-3 weeks old', 'desc' => 'Parasite control guidelines generally recommend beginning treatment this early, since kittens often pick up worms from their mother before birth or through nursing.'],
        ['title' => 'Repeat every 2 weeks until about 8 weeks old', 'desc' => 'Frequent early treatments target parasites at different life cycle stages, since a single dose will not catch every stage of every worm.'],
        ['title' => 'Continue monthly until 6 months old', 'desc' => 'This covers the period when kittens remain at higher risk while their immune system and habits are still developing.'],
        ['title' => 'Move to an adult schedule after 6 months', 'desc' => 'Many vets recommend adult cats be dewormed or tested roughly four times a year, adjusted for individual lifestyle and risk factors like outdoor access or hunting.'],
        ['title' => 'Use fecal testing to confirm what is actually present', 'desc' => 'A vet can check a stool sample to identify specific parasites, which helps target treatment rather than treating blindly.'],
        ['title' => 'Deworm newly adopted cats promptly', 'desc' => 'Cats and kittens of unknown deworming history should typically be treated soon after adoption, on your vet\'s recommended timeline.'],
    ];
}

function pz_tips_cat_deworming_schedule() {
    return [
        ['Always let your vet choose the product and dose', 'The right dewormer and amount depends on your cat\'s weight, age, and the specific parasite involved; this is not something to guess at home.'],
        ['Keep flea prevention current', 'Fleas can transmit tapeworm, so consistent flea control reduces one entire route of reinfection.'],
        ['Bring a fresh stool sample to checkups', 'A recent sample lets your vet run a fecal exam and tailor deworming to what is actually present rather than a blanket schedule.'],
        ['Clean the litter box regularly', 'Prompt removal of feces reduces the chance of reinfection from parasite eggs in the environment.'],
        ['Treat all cats in a household together when one tests positive', 'Parasites can spread between cats sharing a litter box or living space, so treating only one cat often is not enough.'],
        ['Keep a record of deworming dates', 'A simple log helps you and your vet track whether your cat is on schedule, especially useful if you switch vets or add a new pet to the household.'],
    ];
}

function pz_mistakes_cat_deworming_schedule() {
    return [
        ['❌ Using over-the-counter dewormers without vet guidance', 'Different parasites require different medications, and using the wrong product may not treat what your cat actually has.'],
        ['❌ Giving a dose based on a guess or an online chart', 'Dosing should be based on your cat\'s actual weight and determined by your vet; incorrect dosing can be ineffective or unsafe.'],
        ['❌ Stopping the kitten series after one or two treatments', 'The repeated early schedule exists because a single dose does not catch every parasite life stage; skipping doses leaves gaps in protection.'],
        ['❌ Assuming an indoor-only adult cat never needs deworming', 'Indoor cats can still pick up parasites from fleas, contaminated soil tracked in on shoes, or insects, so periodic testing is still worthwhile.'],
        ['❌ Not treating other pets in the household', 'If one cat tests positive for intestinal parasites, other cats sharing the same space are often at risk too and may need treatment.'],
        ['❌ Skipping fecal testing because a cat "seems fine"', 'Many intestinal parasites do not cause obvious symptoms, so testing rather than relying on visible signs is part of the standard recommendation.'],
    ];
}

function pz_faq_cat_deworming_schedule() {
    return [
        ['When should I start deworming a kitten?', 'Parasite control guidelines generally recommend starting around 2-3 weeks of age, since kittens commonly acquire intestinal parasites from their mother. Your vet will confirm the exact starting point and product for your kitten.'],
        ['How often do adult cats need deworming?', 'A commonly cited guideline is about four times a year for adult cats, though your vet may adjust this based on your cat\'s lifestyle, outdoor access, hunting behavior, and fecal test results.'],
        ['Do indoor cats need to be dewormed?', 'Yes, though their risk is generally lower than outdoor cats. Indoor cats can still be exposed to parasites through fleas or contaminated materials brought into the home, so periodic testing or treatment is still recommended.'],
        ['What is a fecal exam and do I need one?', 'A fecal exam is a lab check of a stool sample to identify specific intestinal parasites. Many vets recommend it periodically, sometimes in place of or alongside routine deworming, to confirm what treatment is actually needed.'],
        ['How do I know what dewormer dose my cat needs?', 'Dosing depends on your cat\'s weight, age, and the specific parasite being treated, and should always be determined by your vet rather than estimated at home or from an online chart.'],
        ['Can I catch worms from my cat?', 'Certain intestinal parasites in cats can potentially be transmitted to people, particularly through contact with contaminated soil or litter boxes, which is part of why routine prevention matters for the whole household, not just the cat.'],
        ['My cat was just adopted. When should she be dewormed?', 'Cats of unknown deworming history, including newly adopted ones, are generally dewormed soon after adoption, often within the first couple of weeks, based on your vet\'s assessment and recommended timeline.'],
    ];
}
