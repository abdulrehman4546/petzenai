<?php
/**
 * Tool-specific content for: Cat Fever Symptoms Checker & Guide (registry key: cat_fever_checker).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_cat_fever_checker() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> A cat's normal body temperature is roughly 100-102.5°F (37.8-39.2°C); most vets consider anything above about 102.5°F a fever. Without a thermometer, lethargy, reduced appetite, warm ears, hiding, and shivering are the most common signs, but the only accurate way to confirm a fever is a rectal thermometer reading or a vet visit.</div>
<?php }

function pz_what_is_cat_fever_checker() {
    ob_start(); ?>
    <p>This guide explains how to recognize the signs that a cat may have a fever, what counts as a true fever versus normal variation, and when it is time to call a vet rather than monitor at home. A fever itself is not a disease, it is the body's response to something else going on, often an infection, inflammation, or less commonly a reaction to a vaccine or medication.</p>
    <p>Touching a cat's ears or nose and guessing at a temperature is unreliable. Ears can feel warm from sunbathing or activity, and a warm, dry nose on its own does not reliably indicate fever. The behavioral signs below are useful clues, but a thermometer reading is the only way to know for sure.</p>
    <p>Because cats hide illness well, a fever is sometimes the first obvious sign that something is wrong, even when the underlying cause is not yet visible.</p>
    <?php return ob_get_clean();
}

function pz_why_important_cat_fever_checker() {
    ob_start(); ?>
    <p>Catching a fever early, and knowing when it needs urgent attention, helps get the underlying cause treated sooner.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🌡️</span>
        <div><strong>Fever is a signal, not the problem itself</strong><p>A raised temperature usually means the immune system is responding to an infection or inflammation somewhere, so it is worth finding the cause rather than only treating the number.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🙀</span>
        <div><strong>Cats hide illness well</strong><p>A cat with a fever often just seems a bit quiet or less interested in food, rather than obviously sick, which makes it easy to miss until it progresses.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🚨</span>
        <div><strong>A very high fever can be dangerous</strong><p>Temperatures that climb well above the normal range for an extended time can affect organs, so a persistent or very high fever needs prompt veterinary care.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🚫</span>
        <div><strong>Human fever medication is dangerous for cats</strong><p>Common human fever reducers like acetaminophen and ibuprofen are toxic to cats even in small amounts. Never give any medication without a vet's direction.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_cat_fever_checker() {
    return [
        ['title' => 'Watch for behavior changes first', 'desc' => 'Lethargy, hiding, reduced appetite, shivering, or being unusually quiet are the most common early signs of a fever in cats.'],
        ['title' => 'Take a rectal temperature if you can do so safely', 'desc' => 'A digital rectal thermometer with a bit of lubricant gives the most accurate reading. Have a second person help hold your cat if needed, and stop if it becomes too stressful for either of you.'],
        ['title' => 'Compare to the normal range', 'desc' => 'Most cats run 100-102.5°F (37.8-39.2°C). A reading above roughly 102.5°F points to a fever, and above about 106°F is an emergency.'],
        ['title' => 'Check for other symptoms', 'desc' => 'Note any vomiting, diarrhea, coughing, discharge from the eyes or nose, limping, or a wound, since these can point to the cause.'],
        ['title' => 'Call your vet with what you have found', 'desc' => 'Describe the temperature if you have one, how long symptoms have lasted, and anything else unusual. A vet can tell you whether to come in right away or monitor at home.'],
        ['title' => 'Keep your cat comfortable while you arrange care', 'desc' => 'Offer water, keep her in a quiet, temperate room, and avoid forcing food if she is not interested. Do not apply ice or give any medication without veterinary guidance.'],
    ];
}

function pz_tips_cat_fever_checker() {
    return [
        ['Use a pet-specific digital rectal thermometer', 'These are designed for quick, accurate readings and are safer and more reliable than guessing from ears or nose temperature.'],
        ['Note when symptoms started', 'A timeline of when lethargy, appetite loss, or other signs began helps your vet narrow down likely causes faster.'],
        ['Keep your cat hydrated', 'Fresh water should stay available. A cat that stops drinking along with other fever signs needs veterinary attention sooner rather than later.'],
        ['Watch kittens and seniors more closely', 'Very young and older cats can decline faster with a fever than healthy adults and generally warrant a quicker vet call.'],
        ['Do not rely on ear or nose temperature alone', 'Both can feel warm or cool for reasons unrelated to fever, such as sunbathing, recent activity, or ambient room temperature.'],
        ['Keep your vet\'s and an emergency clinic\'s number saved', 'Having both on hand removes a step from an already stressful moment if a fever appears outside normal office hours.'],
    ];
}

function pz_mistakes_cat_fever_checker() {
    return [
        ['❌ Giving human fever or pain medication', 'Acetaminophen and ibuprofen are toxic to cats, even in small doses, and can cause serious or fatal organ damage. Never give any human medication to a cat.'],
        ['❌ Judging fever only by a warm nose or ears', 'These are unreliable indicators on their own. A cat can have a fever with a cool, moist nose, or feel warm-eared without any fever at all.'],
        ['❌ Waiting several days to see if a fever "breaks on its own"', 'A fever lasting more than a day or two, or one that is high, warrants a vet visit rather than extended home monitoring.'],
        ['❌ Applying ice packs or cold water to cool a cat down', 'Rapid cooling can cause shock and is not a safe way to manage fever. Leave temperature management to a vet.'],
        ['❌ Assuming a fever after a vaccine always needs treatment', 'A mild, short-lived temperature rise after vaccination is common and usually resolves on its own, but a high or prolonged fever still deserves a vet call.'],
        ['❌ Skipping the thermometer because a cat seems "a little off"', 'Subtle lethargy is often the main visible clue in cats, so an actual temperature reading, when safely possible, gives far more useful information than impressions alone.'],
    ];
}

function pz_faq_cat_fever_checker() {
    return [
        ['What is a normal temperature for a cat?', 'A healthy cat\'s normal body temperature typically falls between about 100°F and 102.5°F (37.8-39.2°C). Temperatures above this range are generally considered a fever, and temperatures above roughly 106°F are a veterinary emergency.'],
        ['How can I tell if my cat has a fever without a thermometer?', 'Lethargy, reduced appetite, hiding, shivering, and warm-feeling ears are common signs, but none of them confirm a fever on their own. A rectal thermometer reading, or a vet visit, is the only reliable way to know for certain.'],
        ['Can I use a human thermometer on my cat?', 'A digital thermometer designed for pets is safer and easier to use correctly, but a standard digital rectal thermometer can work if used carefully with lubricant. Ear and forehead thermometers made for humans are not reliable for cats.'],
        ['What causes a fever in cats?', 'Common causes include bacterial or viral infections, abscesses, inflammation, and sometimes a reaction to a recent vaccination. Less commonly, fever can be linked to immune conditions or certain cancers. A vet exam and testing are usually needed to find the specific cause.'],
        ['When is a cat\'s fever an emergency?', 'A temperature above about 106°F, a fever combined with difficulty breathing, repeated vomiting, collapse, or a fever that has lasted more than a day or two without improvement should be treated as urgent and seen by a vet right away.'],
        ['Can I give my cat anything at home to bring down a fever?', 'No. Human fever and pain medications, including acetaminophen and ibuprofen, are toxic to cats. There is no safe home treatment for fever; the appropriate response is contacting your vet.'],
        ['Is a fever after a vaccine normal?', 'A mild, temporary rise in temperature and some lethargy for a day after vaccination is common and usually resolves on its own. A high fever, one that lasts more than a day or two, or one with other serious symptoms should be reported to your vet.'],
    ];
}
