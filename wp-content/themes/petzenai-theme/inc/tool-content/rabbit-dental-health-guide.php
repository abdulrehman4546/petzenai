<?php
/**
 * Tool-specific content for: Rabbit Dental Health & Teeth Problems Guide (registry key: rabbit_dental_health_guide).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_rabbit_dental_health_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> A rabbit's teeth grow continuously throughout her life, and chewing hay is the main way she naturally wears them down. Drooling, dropping food, or facial swelling are signs of a dental problem worth a vet check — left unaddressed, dental issues can also affect her willingness to eat.</div>
<?php }

function pz_what_is_rabbit_dental_health_guide() {
    ob_start(); ?>
    <p>Unlike human teeth, a rabbit's teeth never stop growing — both the front incisors and the back molars grow continuously throughout her life. This is normal and by design, but it means her teeth depend on a constant source of wear to stay at a manageable length, which is where hay-based chewing comes in.</p>
    <p>This guide covers how that continuous growth works, the signs that teeth have grown unevenly or become overgrown — a situation called malocclusion — and when those signs warrant a vet visit. Dental problems can, in some cases, be enough to put a rabbit off eating, which has a real connection to the gut slowing down; that broader emergency topic is covered in more depth elsewhere, so here the focus stays on the dental side itself.</p>
    <?php return ob_get_clean();
}

function pz_why_important_rabbit_dental_health_guide() {
    ob_start(); ?>
    <p>Because a rabbit's teeth never stop growing, dental health isn't a one-time concern — it's an ongoing balance between growth and wear that depends heavily on diet and is worth monitoring throughout her life.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🦷</span>
        <div><strong>Teeth grow continuously, not just as a baby</strong><p>Both incisors and molars keep growing throughout adulthood, so wear from chewing has to keep pace or problems build up over time.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🌾</span>
        <div><strong>Hay is the main natural way teeth get worn down</strong><p>The chewing motion involved in eating hay grinds molars against each other in a way that other foods, including pellets, don't replicate nearly as well.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">😮</span>
        <div><strong>Overgrown or misaligned teeth are called malocclusion</strong><p>When teeth don't meet and wear evenly, they can grow into sharp points or overgrow altogether, which can make eating painful.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🍽️</span>
        <div><strong>Dental pain can reduce how much she eats</strong><p>A rabbit in dental discomfort may eat less or stop altogether, which connects to broader digestive health given how much eating affects her gut.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_rabbit_dental_health_guide() {
    return [
        ['title' => 'Keep hay available as the bulk of her diet', 'desc' => 'Unlimited hay access gives her teeth the steady chewing workload they need to wear down naturally alongside continuous growth.'],
        ['title' => 'Watch for drooling or a wet chin', 'desc' => 'Excess drooling, sometimes called "slobbers," often points to a tooth alignment problem making normal chewing uncomfortable or inefficient.'],
        ['title' => 'Notice if she drops food while eating', 'desc' => 'Dropping food mid-chew, rather than finishing it normally, can be a sign that something about her teeth is making chewing difficult.'],
        ['title' => 'Check for facial swelling along the jawline', 'desc' => 'Swelling near the jaw or under the eye can indicate a tooth root problem and is worth a vet exam rather than waiting to see if it resolves.'],
        ['title' => 'Schedule a vet dental check periodically', 'desc' => 'A vet can look at molars that aren\'t easily visible at home and catch developing malocclusion before it becomes painful.'],
        ['title' => 'Treat loss of appetite alongside dental signs as more urgent', 'desc' => 'If she\'s showing dental symptoms and has also stopped eating normally, that combination deserves prompt vet attention given how closely eating and gut health are connected.'],
    ];
}

function pz_tips_rabbit_dental_health_guide() {
    return [
        ['Offer hay in a way that encourages long chewing sessions', 'A hay rack or loose pile she can settle in and graze from supports more natural wear than a quick nibble.'],
        ['Check her front incisors periodically', 'The front teeth are easy to see without a vet visit, so a quick look now and then can catch obvious overgrowth early.'],
        ['Don\'t rely on pellets or treats to wear down molars', 'The chewing motion for hay is different from pellets, so swapping in more pellets doesn\'t substitute for hay\'s wearing effect.'],
        ['Note any chewing hesitation during normal feeding', 'A rabbit who approaches hay but then seems reluctant to actually chew it is worth watching closely.'],
        ['Keep a record of any dental vet visits', 'Tracking when issues were caught and treated helps a vet spot a recurring pattern over time.'],
    ];
}

function pz_mistakes_rabbit_dental_health_guide() {
    return [
        ['❌ Assuming dental problems are rare in rabbits', 'Because teeth grow continuously throughout life, dental issues are a genuinely ongoing concern, not a one-time risk.'],
        ['❌ Dismissing drooling as just a messy eating habit', 'Drooling is often linked to a tooth alignment problem rather than being purely cosmetic or incidental.'],
        ['❌ Ignoring facial swelling near the jaw', 'This can point to a tooth root issue and is worth a prompt vet exam rather than a wait-and-see approach.'],
        ['❌ Cutting back on hay without realizing the dental impact', 'Reduced hay access removes the main natural source of tooth wear, which can accelerate overgrowth over time.'],
        ['❌ Overlooking reduced eating as unrelated to teeth', 'A rabbit eating less could be dealing with dental pain making chewing uncomfortable, which is worth ruling out alongside other causes.'],
    ];
}

function pz_faq_rabbit_dental_health_guide() {
    return [
        ['Do rabbit teeth really grow continuously?', 'Yes — both incisors and molars grow throughout a rabbit\'s life, which is why ongoing wear from chewing hay matters so much.'],
        ['What is malocclusion in rabbits?', 'It\'s when teeth don\'t meet and wear evenly, leading to overgrowth or sharp points that can make eating painful.'],
        ['What are signs of a dental problem in a rabbit?', 'Drooling, a wet chin, dropping food while eating, and facial swelling near the jaw are common signs worth a vet check.'],
        ['Can dental problems affect a rabbit\'s eating?', 'Yes — dental pain can reduce how much a rabbit eats or stop her from eating altogether, which has a real connection to overall digestive health.'],
        ['How does hay help rabbit teeth?', 'The chewing motion involved in eating hay grinds molars against each other, providing the wear that continuously growing teeth need to stay a manageable length.'],
        ['Is reduced eating from a dental issue the same as GI stasis?', 'They\'re related but distinct — dental pain can be one of several triggers behind a rabbit eating less, and reduced eating is itself a warning sign for gut slowdown, which is covered as its own emergency topic.'],
    ];
}
