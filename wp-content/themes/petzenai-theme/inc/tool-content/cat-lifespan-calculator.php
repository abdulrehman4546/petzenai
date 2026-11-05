<?php
/**
 * Tool-specific content for: Cat Lifespan Calculator by Breed (registry key: cat_lifespan_calculator).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_cat_lifespan_calculator() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Most indoor cats live roughly 12-18 years, while outdoor cats, exposed to traffic, disease, and predators, often live only 2-5 years on average. Breed plays a smaller role than lifestyle: being spayed or neutered, kept indoors, and fed a complete diet with regular vet care generally matters more than breed alone.</div>
<?php }

function pz_what_is_cat_lifespan_calculator() {
    ob_start(); ?>
    <p>This guide looks at what actually drives how long a cat lives: whether she is indoor or outdoor, spayed or neutered, her weight, and the quality of her diet and veterinary care, alongside what is known (and not well established) about breed-specific lifespan.</p>
    <p>Lifestyle factors have a much larger, better-documented effect than breed. Indoor cats avoid traffic, fights, disease exposure, and extreme weather that cut short many outdoor cats' lives, and spaying or neutering removes certain cancer and infection risks tied to reproduction.</p>
    <p>Breed-specific lifespan claims circulating online vary widely and are often based on small surveys rather than large studies, so they should be treated as rough, general impressions rather than precise predictions for an individual cat.</p>
    <?php return ob_get_clean();
}

function pz_why_important_cat_lifespan_calculator() {
    ob_start(); ?>
    <p>Understanding what actually extends a cat's life helps you focus on the choices that matter most, rather than factors you cannot control.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🏠</span>
        <div><strong>Indoor living adds years</strong><p>Keeping a cat indoors, or giving safe, supervised outdoor access, removes major risks like traffic, fights, and disease that shorten the lives of many free-roaming cats.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">✂️</span>
        <div><strong>Spaying and neutering reduces certain risks</strong><p>Fixed cats avoid pregnancy complications and have a lower risk of certain reproductive cancers and roaming-related injuries.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⚖️</span>
        <div><strong>Weight affects healthy years, not just total years</strong><p>Overweight cats are more prone to diabetes and joint problems, which can shorten both lifespan and the quality of the years they do have.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🩺</span>
        <div><strong>Routine care catches problems early</strong><p>Regular vet checkups, especially as cats reach senior age around 10-11 years, help catch treatable conditions like kidney disease or hyperthyroidism before they progress.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_cat_lifespan_calculator() {
    return [
        ['title' => 'Consider her living situation', 'desc' => 'Fully indoor cats generally live significantly longer than cats with regular unsupervised outdoor access, due to reduced exposure to traffic, disease, and predators.'],
        ['title' => 'Factor in spay/neuter status', 'desc' => 'Spayed or neutered cats tend to have fewer roaming-related injuries and lower risk of certain reproductive health issues.'],
        ['title' => 'Think about body condition', 'desc' => 'A cat at a healthy weight, rather than overweight or underweight, tends to have fewer chronic health complications over her lifetime.'],
        ['title' => 'Look at known health history', 'desc' => 'Chronic conditions like kidney disease, heart disease, or diabetes, if already diagnosed, affect expected remaining lifespan more than breed does.'],
        ['title' => 'Note breed as a loose, general reference only', 'desc' => 'Some breeds are informally associated with longer or shorter average lifespans in breeder and owner surveys, but these figures are not based on large, rigorous studies.'],
        ['title' => 'Keep up with routine senior care', 'desc' => 'Starting twice-yearly vet visits and bloodwork around age 10-11 helps catch age-related conditions early, which can meaningfully extend healthy years.'],
    ];
}

function pz_tips_cat_lifespan_calculator() {
    return [
        ['Keep your cat at a healthy body condition', 'Avoiding obesity reduces the risk of diabetes and joint disease, two conditions that can shorten both lifespan and quality of life.'],
        ['Schedule routine vet visits even when she seems healthy', 'Many of the conditions that shorten a cat\'s life, like early kidney disease, show few obvious signs until they are more advanced.'],
        ['Provide mental and physical enrichment', 'Climbing structures, play, and window perches keep an indoor cat active and engaged, which supports both physical health and wellbeing over a long life.'],
        ['Keep vaccinations and parasite prevention current', 'Preventing infectious disease and parasite-related illness removes avoidable risks to a long life.'],
        ['Watch for early signs of common senior conditions', 'Increased thirst, weight loss, or changes in litter box habits can be early signals of kidney disease, hyperthyroidism, or diabetes, all of which are more manageable when caught early.'],
        ['Be skeptical of precise breed lifespan numbers', 'Treat any specific breed lifespan figure you see online as a rough estimate rather than a guarantee; individual health and lifestyle matter more.'],
    ];
}

function pz_mistakes_cat_lifespan_calculator() {
    return [
        ['❌ Letting a cat roam outdoors unsupervised', 'This is one of the single largest factors shortening average cat lifespan, due to traffic, fights, and disease exposure.'],
        ['❌ Treating breed as the main factor in lifespan', 'Lifestyle factors like being indoors, spayed/neutered, and at a healthy weight generally matter more than breed, despite how often breed charts are shared online.'],
        ['❌ Skipping vet visits because a cat "seems fine"', 'Many serious conditions in cats, especially kidney disease, progress silently. Waiting for obvious symptoms means catching problems later than ideal.'],
        ['❌ Letting weight creep up over the years', 'Gradual weight gain is easy to miss but raises the risk of diabetes and joint problems that can shorten a cat\'s life.'],
        ['❌ Assuming a specific online breed lifespan number is scientifically precise', 'Many circulating breed lifespan figures come from informal surveys, not large veterinary studies, and vary widely between sources.'],
        ['❌ Delaying senior care until symptoms appear', 'Starting twice-yearly checkups and bloodwork around age 10-11, rather than waiting for visible illness, gives the best chance of catching age-related disease early.'],
    ];
}

function pz_faq_cat_lifespan_calculator() {
    return [
        ['How long do indoor cats typically live?', 'Most healthy indoor cats live roughly 12-18 years, with many living well into their late teens with good care. This is considerably longer than the average for cats with regular outdoor access.'],
        ['How long do outdoor cats live compared to indoor cats?', 'Outdoor cats face traffic, predators, fights, and disease exposure that indoor cats largely avoid, and estimates for outdoor cat lifespan are commonly cited around 2-5 years on average, far shorter than typical indoor lifespans.'],
        ['Do certain breeds really live longer than others?', 'Some breeds are associated with longer or shorter average lifespans in informal owner and breeder surveys, but these figures vary a lot between sources and are not based on large, controlled studies. Lifestyle factors generally have a bigger, better-documented impact than breed.'],
        ['Does spaying or neutering affect how long a cat lives?', 'Yes, spayed and neutered cats tend to avoid certain reproductive health risks and roaming-related injuries associated with intact cats, which can contribute to a longer average lifespan.'],
        ['At what age is a cat considered a senior?', 'Most vets consider cats senior starting around 10-11 years old. This is generally when twice-yearly checkups and routine bloodwork become more important for catching age-related conditions early.'],
        ['What are the most common health conditions that shorten a cat\'s life?', 'Chronic kidney disease, diabetes, heart disease, and cancer are among the most common serious conditions affecting older cats. Many are more manageable when caught early through routine veterinary screening.'],
        ['Can diet affect how long my cat lives?', 'A complete, balanced diet appropriate to her life stage supports healthy body weight and organ function over time. Chronic overfeeding leading to obesity, or feeding an incomplete diet, can both negatively affect long-term health.'],
    ];
}
