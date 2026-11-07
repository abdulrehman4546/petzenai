<?php
/**
 * Tool-specific content for: Heartworm in Cats: Prevention & Symptoms (registry key: cat_heartworm_guide).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_cat_heartworm_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Heartworm disease in cats is spread by mosquito bites and, unlike in dogs, often causes respiratory signs like coughing and wheezing rather than classic heart symptoms, since cats are considered a resistant, "atypical" host for the parasite. There's no approved treatment to kill adult heartworms in cats, which makes monthly preventive medication the primary strategy. Even indoor cats are at risk, since mosquitoes can get indoors. Ask your vet about year-round heartworm prevention regardless of your cat's indoor or outdoor lifestyle.</div>
<?php }

function pz_what_is_cat_heartworm_guide() {
    ob_start(); ?>
    <p>Heartworm disease is caused by a parasitic worm, Dirofilaria immitis, transmitted through the bite of an infected mosquito. While heartworm is more commonly associated with dogs, cats can become infected too, though they are considered an atypical host, meaning the worms are less likely to mature and reproduce successfully in a cat compared to a dog.</p>
    <p>According to the American Heartworm Society and the Companion Animal Parasite Council, this atypical host status actually makes diagnosis and disease trickier in cats: cats often have fewer, immature worms that don't show up as reliably on standard tests, and the clinical picture, called heartworm-associated respiratory disease (HARD), frequently looks like asthma or bronchitis rather than classic heart disease.</p>
    <p>Because there is no approved medication to kill adult heartworms in cats (unlike in dogs), and because even a small number of worms can cause serious lung and respiratory damage or sudden death in a cat, prevention through monthly preventive medication is considered the cornerstone of protecting cats from this disease.</p>
    <?php return ob_get_clean();
}

function pz_why_important_cat_heartworm_guide() {
    ob_start(); ?>
    <p>Heartworm disease in cats is less common than in dogs but can be more unpredictable and harder to treat, which is why prevention plays an outsized role in protecting cats from it.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🚫</span>
        <div><strong>There is no approved cure for cats</strong><p>Unlike dogs, cats have no approved medication to eliminate adult heartworms, so once infected, management focuses on controlling symptoms rather than removing the parasite.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🫁</span>
        <div><strong>It often mimics asthma</strong><p>Heartworm-associated respiratory disease in cats causes coughing, wheezing, and labored breathing that closely resembles feline asthma, which can lead to misdiagnosis without heartworm testing specifically being considered.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🦟</span>
        <div><strong>Indoor cats are not fully protected</strong><p>Since transmission is through mosquito bites, and mosquitoes regularly find their way indoors, indoor-only cats are still at some risk and benefit from preventive medication.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⚡</span>
        <div><strong>Even a few worms can be dangerous</strong><p>Because cats are atypical hosts, the sudden death of even one or two worms can trigger a severe inflammatory reaction in the lungs, sometimes causing acute collapse.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_cat_heartworm_guide() {
    return [
        ['title' => 'Talk to your vet about year-round prevention', 'desc' => 'Monthly heartworm preventive medication, available as topical or oral products, is the primary and most effective way to protect cats, since there\'s no cure once infected.'],
        ['title' => 'Watch for respiratory signs', 'desc' => 'Coughing, wheezing, rapid or labored breathing, and vomiting (unrelated to eating) are common signs, and can easily be mistaken for asthma or a hairball issue.'],
        ['title' => 'Mention mosquito exposure to your vet', 'desc' => 'Even cats that are mostly or entirely indoors can be bitten by mosquitoes that get inside, so this history is worth sharing if your cat develops respiratory symptoms.'],
        ['title' => 'Understand that standard tests have limitations in cats', 'desc' => 'Because cats often carry fewer or immature worms, standard antigen tests can miss some true infections; your vet may use a combination of antigen and antibody testing along with imaging if heartworm is suspected.'],
        ['title' => 'Discuss imaging if heartworm disease is suspected', 'desc' => 'Chest x-rays or echocardiogram (heart ultrasound) can help support a diagnosis when blood tests alone are inconclusive, since they can show characteristic lung changes.'],
        ['title' => 'Manage symptoms under veterinary guidance if diagnosed', 'desc' => 'Since adult worms can\'t be directly treated in cats, management focuses on controlling inflammation and respiratory symptoms, sometimes with corticosteroids or supportive oxygen therapy during a crisis, decided and dosed by your vet.'],
    ];
}

function pz_tips_cat_heartworm_guide() {
    return [
        ['Use a vet-recommended monthly preventive year-round', 'Consistent use, even in cooler months and for indoor cats, is the most reliable way to prevent heartworm disease, since there\'s no treatment to remove adult worms in cats.'],
        ['Reduce mosquito exposure indoors', 'Window screens in good repair and reducing standing water near the home help lower mosquito exposure, even for cats that never go outside.'],
        ['Mention any respiratory symptoms promptly to your vet', 'Because heartworm-associated respiratory disease mimics asthma, flagging new coughing or wheezing early helps your vet consider the full range of possible causes.'],
        ['Don\'t assume a negative test fully rules out heartworm', 'Because cats often have low worm burdens that don\'t always register on standard antigen tests, your vet may use additional testing or imaging if suspicion remains high despite a negative result.'],
        ['Ask about combination preventives', 'Many monthly heartworm preventives for cats also cover other parasites like fleas or intestinal worms, which can simplify an overall parasite prevention routine.'],
        ['Keep up with prevention even after a negative test', 'A negative test today doesn\'t protect against a mosquito bite tomorrow; prevention needs to be ongoing, not a one-time check.'],
    ];
}

function pz_mistakes_cat_heartworm_guide() {
    return [
        ['❌ Assuming indoor cats don\'t need heartworm prevention', 'Mosquitoes regularly get indoors, and heartworm transmission only requires one infected mosquito bite, so indoor-only status reduces but doesn\'t eliminate risk.'],
        ['❌ Mistaking heartworm-associated respiratory disease for asthma', 'The two conditions look very similar, and heartworm specifically should be considered and tested for in cats with new respiratory symptoms, especially in heartworm-endemic areas.'],
        ['❌ Expecting a treatment to remove adult heartworms like in dogs', 'There is no approved medication to kill adult heartworms in cats; management instead focuses on controlling symptoms, which is part of why prevention is so heavily emphasized.'],
        ['❌ Trusting a single negative antigen test completely', 'Because cats often have low worm burdens, antigen tests can miss true infections; your vet may recommend additional testing if symptoms strongly suggest heartworm despite a negative result.'],
        ['❌ Skipping monthly doses during colder months', 'Mosquitoes can still be active in milder winters or indoors, which is why many vets recommend year-round prevention rather than only during summer.'],
        ['❌ Not mentioning possible mosquito exposure to your vet', 'This detail can help your vet decide how strongly to pursue heartworm testing when a cat shows unexplained respiratory symptoms.'],
    ];
}

function pz_faq_cat_heartworm_guide() {
    return [
        ['Can cats get heartworm disease?', 'Yes, though cats are considered an atypical host, meaning the worms are less likely to fully mature and reproduce compared to in dogs. Even so, infection can cause serious respiratory illness in cats.'],
        ['What are the symptoms of heartworm in cats?', 'Coughing, wheezing, rapid or labored breathing, and vomiting unrelated to eating are the most common signs, often resembling asthma or bronchitis rather than classic heart symptoms.'],
        ['Is there a cure for heartworm in cats?', 'No, there is no approved medication to kill adult heartworms in cats. Management focuses on controlling symptoms, which is why monthly preventive medication is considered essential rather than optional.'],
        ['Do indoor cats need heartworm prevention?', 'Yes, mosquitoes can enter homes, and even brief exposure to one infected mosquito can transmit heartworm, so many vets recommend prevention regardless of whether a cat goes outdoors.'],
        ['How is heartworm diagnosed in cats?', 'Vets typically use a combination of antigen and antibody blood tests, since standard antigen tests alone can miss infections in cats with low worm burdens. Chest x-rays or an echocardiogram may also support the diagnosis.'],
        ['Why does heartworm look different in cats than in dogs?', 'Because cats are atypical hosts, they tend to have fewer worms that don\'t always reach full maturity, leading to a condition called heartworm-associated respiratory disease that affects the lungs more prominently than the classic heart disease picture seen in dogs.'],
        ['How often should I give my cat heartworm prevention?', 'Most heartworm preventive products for cats are given monthly, and many vets recommend year-round use rather than only during mosquito season, given how serious and untreatable heartworm disease can be in cats.'],
    ];
}
