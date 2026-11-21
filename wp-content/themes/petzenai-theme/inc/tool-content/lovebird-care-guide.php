<?php
/**
 * Tool-specific content for: Lovebird Care Guide: Diet, Housing & Health (registry key: lovebird_care_guide).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_lovebird_care_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Lovebirds are small parrots famous for forming an unusually tight pair bond, whether with another lovebird or a devoted owner, and that strong attachment is central to their care. They need a cage with enough horizontal room to move around, a daily diet of pellets and fresh vegetables, and either a bonded companion or consistent daily attention, since a lovebird left without either can become nippy or distressed.</div>
<?php }

function pz_what_is_lovebird_care_guide() {
    ob_start(); ?>
    <p>This guide covers what's distinct about caring for a lovebird (Agapornis species), a small, stocky parrot named for the intense pair-bonding behavior it displays with a mate. It focuses on the traits that set lovebirds apart from other small pet birds rather than generic bird-care advice.</p>
    <p>Lovebirds are one of the smallest commonly kept parrot species by body size, but their personality doesn't scale down to match: they're known for being bold, assertive, and sometimes nippy, particularly when defending a mate, a favorite person, or territory they've claimed as their own.</p>
    <p>The defining trait of this species is the strength of its pair bond. A mated pair of lovebirds will often sit pressed together, preen each other extensively, and show visible distress if separated, a level of attachment behavior that's more pronounced than in many other small parrot species.</p>
    <?php return ob_get_clean();
}

function pz_why_important_lovebird_care_guide() {
    ob_start(); ?>
    <p>A lovebird's intense pair-bonding instinct, compact size, and assertive temperament together shape care decisions that differ from other small pet birds.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">❤️</span>
        <div><strong>Pair bonding is unusually strong in this species</strong><p>A lovebird without a bonded companion, bird or human, tends to show more distress than many other small parrot species do when socially isolated.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⚡</span>
        <div><strong>Small size doesn't mean a mild temperament</strong><p>Lovebirds are known for being bold and sometimes territorial or nippy, especially around a bonded mate or favorite person, which surprises owners expecting budgie-like mildness.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🏠</span>
        <div><strong>Compact bodies still need real flight room</strong><p>Despite their small size, lovebirds are active and benefit from a cage with enough horizontal space to move and stretch their wings, not just room to perch.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🥗</span>
        <div><strong>Diet quality affects a lifespan that often surprises new owners</strong><p>Lovebirds commonly live into the 10 to 15 year range, longer than many people expect from such a small bird, which makes diet quality a long-term factor, not a short-term one.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_lovebird_care_guide() {
    return [
        ['title' => 'Decide between a single, human-bonded lovebird or a bonded pair', 'desc' => 'A lovebird kept alone can bond tightly with its owner instead of another bird, but this requires regular daily interaction to meet the same social need a bonded pair would otherwise fill.'],
        ['title' => 'Don\'t size the cage down just because the bird is small', 'desc' => 'Lovebirds are surprisingly active for their size, climbing, flapping, and moving around constantly, so err toward a roomier cage rather than the smallest one marketed for this species.'],
        ['title' => 'Feed a varied diet rather than a seed-heavy one', 'desc' => 'Lovebirds will readily eat an all-seed diet if that\'s what\'s offered, but a mix leaning on quality pellets with vegetables mixed in daily gives much better long-term nutrition than seed alone.'],
        ['title' => 'Supervise interactions carefully if housing a lovebird with other birds', 'desc' => 'This species can be territorial, especially a bonded individual defending a mate, so introducing a lovebird to other birds or letting them mix freely needs close supervision.'],
        ['title' => 'Give a solo lovebird consistent daily one-on-one attention', 'desc' => 'Since this species bonds so strongly, a lovebird without a bird companion depends more heavily on regular human interaction to avoid loneliness-driven stress.'],
        ['title' => 'Watch for nippiness tied to bonding behavior', 'desc' => 'Increased nipping around a mate, a favorite person, or a perceived territory often reflects normal pair-bonding instincts rather than a training failure, and is worth understanding rather than just correcting.'],
    ];
}

function pz_tips_lovebird_care_guide() {
    return [
        ['Separate a bonded pair gently, not abruptly, if you ever need to', 'Because the pair bond in this species is so strong, sudden separation, even temporarily for a vet visit, can cause visible distress; keeping the separation brief and the birds within sight helps.'],
        ['Don\'t expect a lovebird to automatically bond with a new companion bird', 'Pairing isn\'t guaranteed just by housing two lovebirds together; introductions should be gradual, and some individuals never bond with a particular other bird.'],
        ['Respect territorial behavior around the nest area or favorite perch', 'A lovebird defending a specific spot is acting on normal instinct, so working around that territory rather than forcing access tends to reduce bites.'],
        ['Keep a solo lovebird\'s schedule predictable', 'A lovebird relying on you as its primary bond benefits from consistent timing for attention and feeding, similar to how it would rely on a mate\'s presence.'],
        ['Rotate toys to offset the intensity of this species\' social focus', 'Because lovebirds can become fixated on a bonded companion, offering engaging toys helps provide some independent stimulation alongside social time.'],
    ];
}

function pz_mistakes_lovebird_care_guide() {
    return [
        ['❌ Assuming small size means a mild, easygoing temperament', 'Lovebirds are known for being bold and sometimes nippy, and expecting budgie-like mildness often leads to surprise or frustration.'],
        ['❌ Leaving a solo lovebird without enough daily attention', 'This species bonds intensely, and a lovebird without a companion bird or regular human interaction can become distressed or behaviorally difficult.'],
        ['❌ Separating a bonded pair for long periods without good reason', 'The strength of the pair bond in this species means prolonged separation can cause real stress; keep any necessary separation brief.'],
        ['❌ Underestimating the cage space a small bird needs', 'Lovebirds are more active than their size suggests, and a cage sized only for perching rather than movement limits normal activity.'],
        ['❌ Mistaking bonding-related nipping for a behavioral problem to punish', 'Nipping tied to defending a mate or territory reflects instinct rather than disobedience, and punishment-based responses tend to backfire with this species.'],
    ];
}

function pz_faq_lovebird_care_guide() {
    return [
        ['Do lovebirds need to be kept in pairs?', 'Not strictly, but this species bonds intensely, so a solo lovebird needs consistent daily human interaction to fill the social role a companion bird would otherwise provide.'],
        ['Why is my lovebird so nippy?', 'Lovebirds are a naturally bold, sometimes territorial species, and nipping often increases around a bonded mate, favorite person, or claimed territory rather than being a simple training issue.'],
        ['What size cage does a lovebird need?', 'A cage with enough horizontal room for real movement and short flights, not just perching space, suits this species\' activity level better than a minimally sized cage.'],
        ['What should lovebirds eat?', 'Lovebirds do better on a varied mix leaning toward pellets with vegetables added daily; an all-seed bowl is easy to overfeed and leaves real nutritional gaps.'],
        ['How long do lovebirds live?', 'Lovebirds commonly live in the range of 10 to 15 years with good care, longer than many people expect given their small size.'],
        ['Can two lovebirds always be housed together successfully?', 'Not automatically; pairing isn\'t guaranteed, introductions should be gradual and supervised, and some individual lovebirds never bond with a particular other bird.'],
        ['Is a lovebird a good first pet bird?', 'They can be, but their strong social needs and assertive temperament mean they require more thought than their small size might suggest, especially if kept solo.'],
    ];
}
