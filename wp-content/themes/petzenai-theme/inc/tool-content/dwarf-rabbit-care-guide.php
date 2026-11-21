<?php
/**
 * Tool-specific content for: Dwarf Rabbit Care Guide (registry key: dwarf_rabbit_care_guide).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_dwarf_rabbit_care_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Dwarf rabbits generally run a faster metabolism and have smaller, more fragile bones than larger breeds, so they often do better with more frequent small feedings and more careful, supported handling. Some dwarf breeds are also more prone to dental issues tied to their compact jaw shape.</div>
<?php }

function pz_what_is_dwarf_rabbit_care_guide() {
    ob_start(); ?>
    <p>Dwarf rabbit care focuses on the handful of traits that actually come from being a small, compact breed — a faster metabolism relative to body size, a more fragile skeletal frame, and in some lines, a jaw shape that makes dental problems more common. This guide is about those dwarf-specific considerations.</p>
    <p>It doesn't re-cover general cage sizing or how breed size affects overall lifespan expectations — those are their own topics. What's relevant here is how her small size changes feeding frequency, handling technique, and what health issues are worth watching for more closely than you might with a larger breed.</p>
    <?php return ob_get_clean();
}

function pz_why_important_dwarf_rabbit_care_guide() {
    ob_start(); ?>
    <p>A dwarf rabbit's small size isn't just a matter of needing a smaller cage — it changes how her body processes food, how much handling stress she can tolerate physically, and which health issues are more likely to show up.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">⚡</span>
        <div><strong>A faster metabolism changes feeding patterns</strong><p>Many dwarf breeds burn through energy faster relative to their size, which is part of why more frequent small feedings often work better than fewer large ones.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🦴</span>
        <div><strong>Smaller bones mean less tolerance for rough handling</strong><p>A dwarf rabbit's frame is more delicate than a larger breed's, so handling needs to be more careful and well-supported, especially when picking her up.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🦷</span>
        <div><strong>Jaw shape in some dwarf breeds predisposes to dental issues</strong><p>A compact skull shape can affect how teeth align, making malocclusion and related dental problems more common in certain dwarf lines than in larger breeds.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🖐️</span>
        <div><strong>Small size raises the stakes on an accidental drop or squeeze</strong><p>What might be a minor scare with a larger, sturdier rabbit can cause real injury to a dwarf breed's smaller frame.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_dwarf_rabbit_care_guide() {
    return [
        ['title' => 'Offer smaller, more frequent portions', 'desc' => 'Splitting her daily food into smaller feedings rather than one or two large ones fits better with a faster metabolism relative to her size.'],
        ['title' => 'Support her full body when picking her up', 'desc' => 'Always support both the chest and hindquarters rather than lifting by the front alone — her smaller frame has less margin for a sudden twist or kick.'],
        ['title' => 'Keep handling sessions calm and low to the ground', 'desc' => 'Handling her closer to the floor or over a lap reduces the height and impact of an unexpected jump or slip.'],
        ['title' => 'Watch for early signs of dental trouble', 'desc' => 'Drooling, dropping food, or reluctance to chew hay are worth noting early, since some dwarf breeds are more prone to jaw-shape-related dental issues.'],
        ['title' => 'Get a vet check if you notice jaw or tooth changes', 'desc' => 'A vet can assess tooth alignment and catch a developing malocclusion before it affects her ability to eat normally.'],
        ['title' => 'Teach careful handling to anyone else interacting with her', 'desc' => 'Kids or new owners unfamiliar with how fragile a dwarf breed\'s frame is benefit from a quick explanation before they pick her up.'],
    ];
}

function pz_tips_dwarf_rabbit_care_guide() {
    return [
        ['Split meals rather than feeding once a day', 'A faster relative metabolism tends to respond better to a few smaller feedings spread through the day.'],
        ['Let her come to you rather than reaching in to grab her', 'A dwarf rabbit that feels safely approached is less likely to startle into a sudden jump that risks injury.'],
        ['Check her teeth periodically, not just when something seems wrong', 'Catching an early jaw or tooth alignment issue is easier before it affects eating.'],
        ['Keep a consistent daily hay supply alongside her other food', 'Hay still matters just as much for a dwarf breed, and chewing it helps keep teeth naturally worn down.'],
        ['Be extra mindful with children handling her', 'Explain that she needs gentler, fully supported holds than a larger rabbit might tolerate.'],
    ];
}

function pz_mistakes_dwarf_rabbit_care_guide() {
    return [
        ['❌ Feeding the same way you would a larger breed', 'A dwarf rabbit\'s faster relative metabolism often does better with smaller, more frequent portions rather than large infrequent meals.'],
        ['❌ Picking her up without supporting her hindquarters', 'An unsupported lift risks a kick or twist that a larger, sturdier rabbit might tolerate but a small dwarf frame is more vulnerable to.'],
        ['❌ Ignoring drooling or dropped food as minor', 'These can be early signs of a dental problem that some dwarf breeds are more prone to due to jaw shape.'],
        ['❌ Letting young kids handle her unsupervised', 'Her smaller, more fragile frame has less tolerance for an accidental squeeze or drop than many people expect.'],
        ['❌ Assuming her small size means lower food needs overall', 'Size and metabolism don\'t scale the same way — a faster metabolism relative to body size can still mean meaningful food needs despite her small frame.'],
    ];
}

function pz_faq_dwarf_rabbit_care_guide() {
    return [
        ['Do dwarf rabbits need to eat differently than larger breeds?', 'Often yes — many dwarf breeds have a faster metabolism relative to their size, so smaller, more frequent feedings tend to work better than large infrequent meals.'],
        ['Why do dwarf rabbits need more careful handling?', 'Their smaller, more fragile bone structure has less tolerance for rough handling or an unsupported lift than a larger, sturdier breed.'],
        ['Are dwarf rabbits more prone to dental problems?', 'Some dwarf breeds are, due to a jaw shape that can affect tooth alignment, making malocclusion and related dental issues more common than in larger breeds.'],
        ['What are early signs of a dental issue in a dwarf rabbit?', 'Drooling, dropping food while eating, or reluctance to chew hay are worth a vet check, especially given the dental predisposition in some dwarf lines.'],
        ['How should I pick up a dwarf rabbit safely?', 'Always support both the chest and hindquarters together, and keep handling low to the ground to reduce the risk of injury from a sudden jump or slip.'],
        ['Is a dwarf rabbit\'s cage size different from a standard rabbit\'s?', 'Cage sizing itself follows general space guidelines covered elsewhere — this guide focuses specifically on feeding frequency, handling, and dwarf-related health predispositions.'],
    ];
}
