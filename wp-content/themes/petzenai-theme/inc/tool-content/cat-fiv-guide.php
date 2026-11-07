<?php
/**
 * Tool-specific content for: FIV in Cats: Symptoms, Management & Life Expectancy (registry key: cat_fiv_guide).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_cat_fiv_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Feline immunodeficiency virus (FIV) spreads mainly through deep bite wounds, usually between outdoor or unneutered male cats fighting over territory, and slowly weakens the immune system over years. Many FIV-positive cats stay healthy for a long time with no symptoms and can live a normal lifespan with good care. A blood test confirms the diagnosis. There's no cure, but keeping cats indoors, managing stress, and treating secondary infections promptly lets most FIV-positive cats live well for years.</div>
<?php }

function pz_what_is_cat_fiv_guide() {
    ob_start(); ?>
    <p>Feline immunodeficiency virus, FIV, is a retrovirus similar in family to HIV in humans, though it behaves differently and does not infect people. It gradually weakens a cat's immune system over a period of years, making the cat more susceptible to other infections and slower to recover from illness, rather than causing a specific disease on its own.</p>
    <p>According to the Cornell Feline Health Center, FIV is transmitted primarily through deep bite wounds, which is why it's seen most often in unneutered outdoor male cats that fight over territory and mates. Casual contact like grooming or sharing bowls carries a much lower risk of transmission compared to FeLV, and it's rarely passed from mother to kitten.</p>
    <p>FIV infection has a long asymptomatic phase that can last many years, during which an infected cat may appear completely healthy. Diagnosis is made with an ELISA blood test, sometimes followed by confirmatory testing, since kittens of FIV-positive mothers can show a temporary false positive from maternal antibodies.</p>
    <?php return ob_get_clean();
}

function pz_why_important_cat_fiv_guide() {
    ob_start(); ?>
    <p>FIV has a much better long-term outlook than many owners initially assume, but understanding how it progresses helps you give an infected cat the right kind of care.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">⏳</span>
        <div><strong>Many cats live symptom-free for years</strong><p>FIV typically progresses slowly, and many infected cats live a normal or near-normal lifespan with no major symptoms, especially with attentive care.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🩹</span>
        <div><strong>Bite wounds are the main transmission route</strong><p>Because fighting between outdoor, unneutered cats is the primary way FIV spreads, neutering and keeping cats indoors meaningfully reduce the risk of both catching and spreading it.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🦠</span>
        <div><strong>Secondary infections become more serious over time</strong><p>As the immune system weakens in later stages, infections that a healthy cat would shake off easily can become more persistent or severe in an FIV-positive cat.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🏠</span>
        <div><strong>Indoor living reduces risk on both sides</strong><p>Keeping an FIV-positive cat indoors protects other cats from exposure and reduces the infected cat\'s exposure to illnesses their immune system is less equipped to handle.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_cat_fiv_guide() {
    return [
        ['title' => 'Test any new or stray cat before introducing them', 'desc' => 'A simple blood test can detect FIV antibodies, and testing before introducing a new cat to your household, especially one with any outdoor history, helps prevent accidental exposure.'],
        ['title' => 'Confirm with follow-up testing if needed', 'desc' => 'Kittens born to FIV-positive mothers can show temporary false positives from maternal antibodies, so your vet may recommend retesting after 6 months of age to confirm true status.'],
        ['title' => 'Keep FIV-positive cats indoors only', 'desc' => 'This is one of the most effective steps you can take: it protects other cats in the neighborhood from exposure and protects the infected cat from additional infections.'],
        ['title' => 'Have your cat neutered or spayed', 'desc' => 'Since fighting between unneutered males is the main transmission route, neutering reduces territorial aggression and lowers both infection and transmission risk.'],
        ['title' => 'Schedule regular veterinary checkups', 'desc' => 'Twice-yearly checkups with bloodwork are commonly recommended for FIV-positive cats to catch secondary infections or illness early, when they are most treatable.'],
        ['title' => 'Treat any illness promptly and thoroughly', 'desc' => 'Because an FIV-positive cat\'s immune system may struggle to clear infections on its own, prompt, complete treatment of even minor-seeming illnesses matters more than it would for an FIV-negative cat.'],
    ];
}

function pz_tips_cat_fiv_guide() {
    return [
        ['Keep FIV-positive cats strictly indoors', 'This single step does the most to protect both the infected cat and other cats in the area from the main transmission route, bite wounds from fighting.'],
        ['Reduce stress wherever possible', 'A calmer environment supports whatever immune function an FIV-positive cat has, since chronic stress can further suppress immunity.'],
        ['Feed a high-quality, complete commercial diet', 'Avoid raw food specifically for FIV-positive cats, since raw diets carry a higher risk of foodborne pathogens that a weakened immune system is less able to fight.'],
        ['Watch closely for subtle signs of illness', 'Changes in appetite, weight, energy, or coat condition can be early clues of a secondary problem and are worth mentioning to your vet sooner rather than later.'],
        ['Keep dental care a priority', 'FIV-positive cats are more prone to significant gum disease, so regular dental checkups and home dental care are a meaningful part of their care.'],
        ['Don\'t assume a positive test means a short life', 'Many FIV-positive cats, especially those diagnosed early and kept indoors with good care, live long, comfortable lives; discuss a realistic outlook with your vet rather than assuming the worst.'],
    ];
}

function pz_mistakes_cat_fiv_guide() {
    return [
        ['❌ Assuming FIV spreads easily through normal household contact', 'FIV mainly spreads through deep bite wounds, not casual contact like sharing bowls or grooming, so FIV-positive and negative cats in the same calm household have a lower risk than many owners fear, though separation is still often recommended out of caution.'],
        ['❌ Letting an FIV-positive cat roam outdoors', 'This is the single biggest risk factor for both exposing other cats to the virus and exposing the infected cat to fights and additional infections.'],
        ['❌ Skipping retesting on a kitten with maternal antibodies', 'A kitten testing positive before 6 months old may just have antibodies passed from an FIV-positive mother, not a true infection; retesting later is important before assuming a lifelong diagnosis.'],
        ['❌ Feeding a raw diet to an FIV-positive cat', 'Raw diets carry a higher risk of bacterial contamination, which is a bigger concern for a cat with reduced immune defenses.'],
        ['❌ Delaying treatment for "minor" symptoms', 'What might resolve quickly in a healthy cat can become more serious in an FIV-positive cat, so prompt veterinary attention for new symptoms matters more.'],
        ['❌ Assuming FIV automatically means a short, sickly life', 'Many FIV-positive cats live for years with few or no symptoms, particularly when kept indoors with routine veterinary care; the actual prognosis is often better than people expect.'],
    ];
}

function pz_faq_cat_fiv_guide() {
    return [
        ['How do cats get FIV?', 'FIV is transmitted mainly through deep bite wounds, most commonly between unneutered outdoor male cats fighting over territory or mates. It spreads much less easily through casual contact like grooming or sharing food bowls.'],
        ['Can FIV spread to humans or other pets?', 'No, FIV is specific to cats and does not infect humans, dogs, or other species.'],
        ['How long can a cat live with FIV?', 'Many FIV-positive cats live a normal or near-normal lifespan, especially with indoor living, routine veterinary care, and prompt treatment of secondary infections. The disease typically progresses slowly over years.'],
        ['Is there a cure for FIV in cats?', 'No, there is no cure, but FIV is manageable, and most infected cats live symptom-free for long periods with appropriate care and monitoring.'],
        ['Can an FIV-positive cat live with FIV-negative cats?', 'It carries some risk, mainly if there is fighting or significant bite-wound exposure. Many calm, non-aggressive multi-cat households manage this safely, though vets often still recommend caution or separation depending on the cats\' personalities.'],
        ['How is FIV diagnosed?', 'A blood test (ELISA) checks for FIV antibodies. Because kittens of FIV-positive mothers can show temporary false positives from maternal antibodies, retesting after 6 months of age is sometimes needed to confirm true infection status.'],
        ['Does neutering help prevent FIV?', 'Yes, since fighting between unneutered male cats is the primary transmission route, neutering reduces the territorial aggression that leads to the bite wounds through which FIV spreads.'],
    ];
}
