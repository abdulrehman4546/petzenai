<?php
/**
 * Tool-specific content for: Finch Care Guide: Diet, Cage & Health (registry key: finch_care_guide).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_finch_care_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Finches such as zebra finches and society finches are small, flock-oriented birds best kept in pairs or small groups rather than alone, which is the opposite of a solitary-friendly canary. They're a watch-and-enjoy pet rather than a hands-on one; finches rarely tame down to handling and do best left to their own activity in a spacious flight cage. Their diet is a simple finch seed mix plus occasional greens, and commonly kept species like zebra finches have a relatively short lifespan, often cited around 5 to 10 years.</div>
<?php }

function pz_what_is_finch_care_guide() {
    ob_start(); ?>
    <p>This guide covers finches as a pet category, which includes species like zebra finches and society finches that are commonly kept in home aviaries or flight cages. Finch care is built around a different relationship with the bird than most other pet birds offer.</p>
    <p>Finches are social with their own kind but not typically with people. Where parrots thrive on direct interaction and canaries do fine solo, finches fall into a third category: keep them in pairs or small groups of their own species, and expect to observe and enjoy them rather than handle them. Most finches never become comfortable being picked up or perched on a hand, and attempting to force that kind of interaction usually just stresses the bird.</p>
    <p>Because finches are kept in groups and are highly active flyers, cage space and flock composition matter more for this species than training or one-on-one bonding time. A lone finch, unlike a lone canary, is generally considered a less appropriate setup since finches look to each other for the social contact that canaries don't need and parrots usually get from their owner.</p>
    <?php return ob_get_clean();
}

function pz_why_important_finch_care_guide() {
    ob_start(); ?>
    <p>Finch care goes wrong most often when owners apply expectations from other pet birds, either the hands-on approach used with parrots or the solitary setup that works for canaries.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">👥</span>
        <div><strong>Finches need their own kind, not a solo setup</strong><p>Unlike canaries, which generally do well alone, finches are social with other finches and should be kept in pairs or small groups rather than singly.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">👁️</span>
        <div><strong>This is a watch, not a handle, pet</strong><p>Finches rarely tame to hand-handling the way parrots can; trying to force that kind of bonding typically just adds stress rather than building a relationship.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🏠</span>
        <div><strong>Group living means cage space needs matter more here</strong><p>A cage sized for one bird quickly becomes crowded with a pair or small group, so finch housing decisions are driven by flock size more than by any single bird's needs.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⏳</span>
        <div><strong>Their lifespan is on the shorter end for pet birds</strong><p>Commonly kept species like zebra finches are often cited around 5 to 10 years, shorter than canaries and far shorter than parrot-family birds.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_finch_care_guide() {
    return [
        ['title' => 'Get at least a pair, not a single finch', 'desc' => 'Finches are social with their own species and generally should not be kept alone; a pair or small same-species group is the standard setup.'],
        ['title' => 'Choose a wide flight cage sized for the group, not just one bird', 'desc' => 'Finches are constant, active flyers, so cage width and the number of birds sharing it both factor into how much space is actually needed.'],
        ['title' => 'Plan to watch rather than handle', 'desc' => 'Set expectations for an observation-based pet from the start; most finches don\'t become comfortable being picked up, and that\'s normal for the species.'],
        ['title' => 'Feed a finch-specific seed mix with occasional greens', 'desc' => 'A finch seed blend covers most of their diet, with small amounts of leafy greens or vegetables added a few times a week.'],
        ['title' => 'Keep the group composition stable once established', 'desc' => 'Finches form their own social order within a group; repeatedly adding and removing birds can create stress that a stable group avoids.'],
        ['title' => 'Watch the group for one bird being excluded or picked on', 'desc' => 'Occasional pecking order behavior is normal, but one bird being consistently chased from food or perches is worth addressing with more space or a calmer mix of birds.'],
    ];
}

function pz_tips_finch_care_guide() {
    return [
        ['Don\'t buy a single finch expecting it to bond with you like a parrot', 'This species looks to other finches for social contact, not primarily to its owner, so a solo finch without company is likely to do poorly.'],
        ['Give the flight cage more width than height', 'Finches fly back and forth rather than climbing, so horizontal space supports their natural activity better than a tall cage does.'],
        ['Let young finches settle into the group before assuming problems', 'Some initial adjustment and minor squabbling when finches are introduced is normal and usually settles within days.'],
        ['Keep a shallow bathing dish available', 'Finches commonly bathe regularly and appreciate consistent access to shallow water for this.'],
        ['Avoid overcrowding even in a large cage', 'Too many finches in one space, regardless of cage size, increases stress and competition for food and perches.'],
    ];
}

function pz_mistakes_finch_care_guide() {
    return [
        ['❌ Keeping a single finch alone', 'Unlike canaries, finches rely on their own species for social contact, and a lone finch without company typically doesn\'t do well.'],
        ['❌ Trying to tame a finch to hand-handling', 'Most finches never become comfortable being picked up, and repeated attempts usually create stress rather than a bond.'],
        ['❌ Undersizing the cage for a group', 'A cage that would suit one bird is often too small once it\'s housing a pair or small group of active flyers.'],
        ['❌ Mixing finches with unrelated species expecting harmony', 'Different finch species or other bird types sharing a cage can lead to conflict rather than the flock dynamic finches have with their own kind.'],
        ['❌ Assuming finch care is just a smaller version of canary care', 'The two species have opposite social needs — canaries generally do well solo, finches generally need company — so the same setup doesn\'t work for both.'],
    ];
}

function pz_faq_finch_care_guide() {
    return [
        ['Is a single pet finch okay on its own?', 'Not usually recommended; this species looks to its own kind for social contact and tends to fare better housed in pairs or small groups.'],
        ['Do finches like to be held?', 'Generally no. Most finches don\'t tame to handling the way parrots can, and this is a pet meant to be watched and enjoyed rather than handled.'],
        ['What\'s the difference between finch care and canary care?', 'Canaries generally do well living alone, while finches are social with their own species and are typically kept in pairs or small groups instead.'],
        ['How long do pet finches live?', 'Commonly kept species like zebra finches are often cited around 5 to 10 years, shorter than canaries and much shorter than larger parrots.'],
        ['What do finches eat?', 'A finch-specific seed mix as the base diet, with occasional leafy greens or vegetables added a few times a week.'],
        ['How big should a finch cage be?', 'Wide and horizontal rather than tall, with enough room for the whole group to fly back and forth, not just perch.'],
        ['Is it normal for finches to squabble in a group?', 'Some pecking-order behavior is normal, but one bird being consistently excluded from food or perches is worth addressing with more space.'],
    ];
}
