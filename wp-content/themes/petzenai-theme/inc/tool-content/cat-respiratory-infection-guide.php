<?php
/**
 * Tool-specific content for: Cat Upper Respiratory Infection Guide (registry key: cat_respiratory_infection_guide).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_cat_respiratory_infection_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Upper respiratory infections in cats cause sneezing, nasal and eye discharge, congestion, and sometimes a mild fever or reduced appetite, most often from feline herpesvirus or calicivirus. They're common, especially in kittens, shelter cats, and multi-cat households, and most mild cases resolve with supportive care over 7–10 days. See a vet if symptoms are severe, your cat stops eating, or signs last beyond two weeks, since secondary bacterial infections sometimes need antibiotics.</div>
<?php }

function pz_what_is_cat_respiratory_infection_guide() {
    ob_start(); ?>
    <p>Feline upper respiratory infection (URI) is an umbrella term for infections affecting the nose, throat, and sinuses, most commonly caused by feline herpesvirus type 1 and feline calicivirus, which together are responsible for the large majority of cases according to the Cornell Feline Health Center. Bacteria, including Bordetella and Chlamydophila felis, can also cause or complicate URIs.</p>
    <p>These viruses spread easily through sneezing, shared food bowls, bedding, and direct contact, which is why outbreaks are common in shelters, catteries, and multi-cat households. Once infected with feline herpesvirus, many cats become lifelong carriers and can have recurrent flare-ups during times of stress, even without new exposure.</p>
    <p>Typical signs include sneezing, nasal discharge, watery or goopy eyes, congestion, mild fever, and reduced appetite from a blunted sense of smell. Most otherwise healthy adult cats recover with supportive care, but kittens, senior cats, and cats with other health issues are more vulnerable to complications.</p>
    <?php return ob_get_clean();
}

function pz_why_important_cat_respiratory_infection_guide() {
    ob_start(); ?>
    <p>Most URIs are not dangerous on their own, but understanding the typical course helps you know when home care is enough and when veterinary treatment is genuinely needed.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🍼</span>
        <div><strong>Kittens are especially vulnerable</strong><p>Young kittens can become seriously ill from a URI, sometimes developing pneumonia or severe dehydration, and need closer monitoring than adult cats.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">👁️</span>
        <div><strong>Eye involvement can threaten vision</strong><p>Herpesvirus can cause corneal ulcers, which are painful and, if untreated, can threaten the eye itself. Squinting or cloudy eyes need prompt veterinary attention.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🔁</span>
        <div><strong>Herpesvirus can recur throughout life</strong><p>Many cats carry the virus long-term and can have flare-ups during stress, illness, or a weakened immune system, even years after the first infection.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🍽️</span>
        <div><strong>Lost smell can stop a cat from eating</strong><p>Because cats rely heavily on smell, severe congestion can lead to appetite loss serious enough to need supportive feeding, particularly in kittens and small cats.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_cat_respiratory_infection_guide() {
    return [
        ['title' => 'Watch for the typical signs', 'desc' => 'Sneezing, nasal or eye discharge, congestion, mild fever, and reduced appetite are the classic pattern. Discharge may start clear and become thicker or discolored as the infection progresses.'],
        ['title' => 'Keep your cat eating and hydrated', 'desc' => 'Offer strong-smelling, warmed wet food to work around a blocked nose, and make sure fresh water is easily accessible. Appetite loss from congestion is common but needs monitoring.'],
        ['title' => 'Gently clean discharge from the nose and eyes', 'desc' => 'Use a warm, damp cloth to wipe away crusted discharge a few times a day, which helps your cat breathe and see more comfortably.'],
        ['title' => 'Isolate from other cats if possible', 'desc' => 'URIs spread easily through direct contact and shared bowls or litter boxes, so separating a sick cat helps protect other cats in the household.'],
        ['title' => 'Monitor for warning signs', 'desc' => 'Not eating for more than a day, labored breathing, significant lethargy, or eye squinting and cloudiness are signs that need a vet visit rather than continued home care.'],
        ['title' => 'See a vet for medication if needed', 'desc' => 'Vets may prescribe antibiotics for secondary bacterial infections, eye medication for corneal issues, or antiviral treatment for severe or recurrent herpesvirus flare-ups.'],
    ];
}

function pz_tips_cat_respiratory_infection_guide() {
    return [
        ['Use a humidifier or steamy bathroom', 'Moist air can help loosen nasal congestion and make breathing more comfortable, similar to steam therapy used for human colds.'],
        ['Warm wet food to boost its smell', 'Lightly warming food makes it more aromatic, which can help tempt a congested cat with a dulled sense of smell to eat.'],
        ['Clean bedding, bowls, and litter boxes during an active infection', 'This reduces the chance of reinfection or spreading the virus to other cats in the home.'],
        ['Reduce stress during recovery', 'Since stress can trigger or worsen herpesvirus flare-ups, a calm, quiet recovery environment supports faster healing.'],
        ['Keep vaccinations current', 'The core feline vaccine (FVRCP) covers herpesvirus and calicivirus and significantly reduces the severity of infection, even if it doesn\'t guarantee complete prevention.'],
        ['Ask your vet about L-lysine or other supportive options', 'Some vets recommend supplements for cats with recurrent herpesvirus flare-ups, though evidence is mixed; discuss whether it\'s appropriate for your cat.'],
    ];
}

function pz_mistakes_cat_respiratory_infection_guide() {
    return [
        ['❌ Giving human cold medication to a cat', 'Many human decongestants and cold remedies are toxic to cats. Never give over-the-counter human medication without explicit veterinary guidance.'],
        ['❌ Assuming all URIs need antibiotics', 'Most URIs are viral, and antibiotics only help with secondary bacterial infections. Overuse without a clear need doesn\'t speed recovery and can contribute to resistance.'],
        ['❌ Ignoring eye squinting or cloudiness', 'This can indicate a corneal ulcer from herpesvirus, which is painful and can threaten vision without prompt treatment.'],
        ['❌ Letting appetite loss go unaddressed', 'Because cats can develop serious complications from not eating, prolonged appetite loss during a URI needs active management, not just waiting it out.'],
        ['❌ Not isolating a sick cat in a multi-cat home', 'URIs spread very easily through shared spaces and direct contact, so skipping isolation often leads to the whole household getting sick.'],
        ['❌ Assuming a past infection means permanent immunity', 'Cats infected with herpesvirus often remain carriers and can have repeat flare-ups throughout life, especially during stress, so ongoing vigilance still matters.'],
    ];
}

function pz_faq_cat_respiratory_infection_guide() {
    return [
        ['What causes upper respiratory infections in cats?', 'Most cases are caused by feline herpesvirus type 1 or feline calicivirus, with bacteria like Bordetella or Chlamydophila felis sometimes involved as well, particularly as secondary infections.'],
        ['How long does a cat URI usually last?', 'Mild cases often resolve within 7 to 10 days with supportive care. Symptoms lasting beyond two weeks, or that worsen, should be evaluated by a vet.'],
        ['Is feline URI contagious to other cats?', 'Yes, it spreads easily through sneezing, shared bowls, bedding, and direct contact, which is why outbreaks are common in multi-cat households and shelters. It does not spread to dogs or people.'],
        ['Do cats need antibiotics for a URI?', 'Not always. Since most URIs are viral, antibiotics are reserved for cases with signs of secondary bacterial infection, such as thick discolored discharge or a worsening course. Your vet can determine if they\'re needed.'],
        ['Can a URI affect my cat\'s eyes?', 'Yes, herpesvirus commonly causes eye discharge and can lead to corneal ulcers, which are painful and need prompt veterinary treatment, especially if your cat is squinting or the eye looks cloudy.'],
        ['Will my cat get URIs again in the future?', 'Cats infected with feline herpesvirus often become lifelong carriers and can have recurrent flare-ups, especially during periods of stress or illness, even without new exposure.'],
        ['Does vaccination prevent URIs completely?', 'The core FVRCP vaccine significantly reduces the severity and likelihood of herpesvirus and calicivirus infections but doesn\'t guarantee complete prevention, since there are many strains and some immunity wanes over time.'],
    ];
}
