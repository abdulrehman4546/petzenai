<?php
/**
 * Tool-specific content for: Feline Leukemia Virus (FeLV): Guide for Cat Owners (registry key: feline_leukemia_guide).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_feline_leukemia_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Feline leukemia virus (FeLV) is a contagious virus spread mainly through close, prolonged contact like grooming, shared bowls, and bite wounds, and it weakens the immune system over time, making infected cats more prone to infections and certain cancers. A simple blood test diagnoses it. There's no cure, but many FeLV-positive cats live comfortably for years with good veterinary care, and a vaccine is available to help protect uninfected, at-risk cats.</div>
<?php }

function pz_what_is_feline_leukemia_guide() {
    ob_start(); ?>
    <p>Feline leukemia virus is a retrovirus that attacks a cat's bone marrow and immune system, and despite its name, it doesn't always cause leukemia specifically. It's more accurately understood as a virus that suppresses immune function and increases the risk of certain cancers, anemia, and secondary infections over time.</p>
    <p>According to the Cornell Feline Health Center and the American Association of Feline Practitioners, FeLV spreads primarily through prolonged close contact between cats: mutual grooming, shared food and water bowls, and bite wounds. Kittens can also be infected before birth or through nursing from an infected mother. It does not spread to humans or other species.</p>
    <p>Not every exposed cat becomes permanently infected. Some cats mount an effective immune response and clear the virus, some become healthy long-term carriers with the virus dormant, and others develop progressive infection that eventually leads to illness. Testing, usually an ELISA screening test followed by confirmatory testing if positive, is the only reliable way to know a cat's status.</p>
    <?php return ob_get_clean();
}

function pz_why_important_feline_leukemia_guide() {
    ob_start(); ?>
    <p>Understanding how FeLV spreads and progresses helps owners protect uninfected cats and provide the right kind of care for cats that test positive.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🧪</span>
        <div><strong>Testing is the only way to know for sure</strong><p>FeLV can be present without obvious symptoms for a long time, so testing, especially for new cats joining a household, is the only reliable way to confirm status.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🏡</span>
        <div><strong>It is one of the leading infectious causes of death in cats</strong><p>FeLV-related illness is a significant cause of disease and death in infected cats, which is why prevention through testing and vaccination matters, especially for at-risk cats.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">😺</span>
        <div><strong>Many FeLV-positive cats still live well for years</strong><p>With indoor-only living, good nutrition, and prompt treatment of secondary infections, many FeLV-positive cats enjoy a good quality of life for a meaningful length of time after diagnosis.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💉</span>
        <div><strong>A vaccine exists for at-risk cats</strong><p>The FeLV vaccine is recommended for kittens and cats with potential exposure to infected cats, such as those who go outdoors or live with an infected cat.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_feline_leukemia_guide() {
    return [
        ['title' => 'Test any new cat before introducing them to others', 'desc' => 'A simple in-clinic blood test (ELISA) can detect FeLV, and testing new cats, especially strays or shelter cats, before introducing them to a resident cat is a key prevention step.'],
        ['title' => 'Confirm a positive result with follow-up testing', 'desc' => 'Because initial tests can occasionally give a false positive, especially in low-risk cats, your vet may recommend a confirmatory test like IFA or PCR before finalizing a diagnosis.'],
        ['title' => 'Keep FeLV-positive cats indoors only', 'desc' => 'This protects the infected cat from additional illness exposure and prevents them from spreading the virus to other cats in the neighborhood.'],
        ['title' => 'Separate FeLV-positive and negative cats in multi-cat homes', 'desc' => 'Since transmission requires close, prolonged contact, keeping infected and uninfected cats separate (or carefully managed, per your vet\'s guidance) reduces the risk of spreading the virus.'],
        ['title' => 'Schedule more frequent veterinary checkups', 'desc' => 'FeLV-positive cats typically benefit from checkups roughly every six months, since their weakened immune system makes early detection of secondary problems especially important.'],
        ['title' => 'Discuss vaccination for at-risk, uninfected cats', 'desc' => 'Kittens and cats with outdoor access or exposure to unknown-status cats are good candidates for the FeLV vaccine; ask your vet whether it fits your cat\'s lifestyle.'],
    ];
}

function pz_tips_feline_leukemia_guide() {
    return [
        ['Test before adopting or introducing a new cat', 'This single step prevents most accidental exposures in multi-cat households and is standard practice recommended by shelters and vets alike.'],
        ['Keep FeLV-positive cats indoors exclusively', 'This protects them from new infections they are less equipped to fight off and prevents spreading the virus to other cats.'],
        ['Watch for signs of secondary illness', 'Because FeLV suppresses immune function, infections, dental disease, or anemia can develop or worsen faster than in an uninfected cat; report new symptoms to your vet promptly.'],
        ['Feed a high-quality, complete diet', 'Good nutrition supports whatever immune function an FeLV-positive cat has left, so avoid raw diets specifically, since they carry infection risks that are riskier for immune-suppressed cats.'],
        ['Reduce stress for FeLV-positive cats', 'Chronic stress can further suppress immune function, so a calm, stable environment is a meaningful part of supportive care.'],
        ['Don\'t assume a positive result is an automatic death sentence', 'Many FeLV-positive cats live comfortably for a good length of time with attentive care; talk with your vet about a realistic, individualized outlook for your cat.'],
    ];
}

function pz_mistakes_feline_leukemia_guide() {
    return [
        ['❌ Skipping testing for a new cat because they "seem healthy"', 'FeLV-infected cats can look completely normal for a long time before symptoms appear, so appearance alone can\'t rule it out.'],
        ['❌ Assuming FeLV spreads through casual contact like humans catching a cold', 'It requires fairly close, prolonged contact such as grooming, shared bowls, or bites; brief or indirect contact carries lower risk, though testing and caution are still wise.'],
        ['❌ Letting an FeLV-positive cat roam outdoors', 'This risks spreading the virus to other cats in the area and exposes the FeLV-positive cat to additional infections their immune system is less able to fight.'],
        ['❌ Treating a single positive test as absolutely final without confirmation', 'False positives can occur, especially in low-risk cats, so confirmatory testing is an important step before making major decisions based on the result.'],
        ['❌ Assuming there\'s nothing that can be done for an FeLV-positive cat', 'While there is no cure, supportive care, more frequent monitoring, and prompt treatment of secondary infections can give many cats years of good quality life.'],
        ['❌ Skipping the FeLV vaccine for at-risk cats', 'Cats with outdoor access or potential exposure to cats of unknown status are reasonable candidates for vaccination; not discussing it with your vet is a missed prevention opportunity.'],
    ];
}

function pz_faq_feline_leukemia_guide() {
    return [
        ['How is feline leukemia virus spread?', 'FeLV spreads mainly through prolonged close contact between cats, including mutual grooming, shared food and water bowls, and bite wounds. Kittens can also be infected before birth or through nursing from an infected mother.'],
        ['Can FeLV spread to humans or dogs?', 'No, FeLV is specific to cats and does not infect humans, dogs, or other species.'],
        ['How is FeLV diagnosed?', 'A simple in-clinic blood test called ELISA is used for initial screening. If positive, vets often recommend a confirmatory test, such as IFA or PCR, since false positives can occasionally occur, especially in low-risk cats.'],
        ['Is there a cure for feline leukemia virus?', 'No, there is currently no cure for FeLV. Management focuses on supportive care, monitoring, and promptly treating secondary infections, and many infected cats live comfortably for a meaningful period with this approach.'],
        ['How long can a cat live with FeLV?', 'It varies significantly by cat, but many FeLV-positive cats live for a good number of years with attentive care, indoor-only living, and regular veterinary monitoring, rather than becoming ill immediately.'],
        ['Can an FeLV-positive cat live with FeLV-negative cats?', 'It carries some risk since transmission requires close contact; many households manage this by keeping cats separated or under close veterinary guidance, and some choose to vaccinate the negative cat for additional protection.'],
        ['Is there a vaccine for FeLV?', 'Yes, a vaccine is available and recommended for kittens and at-risk cats, such as those with outdoor access or exposure to cats of unknown FeLV status. It is not considered a core vaccine for strictly indoor cats with no exposure risk.'],
    ];
}
