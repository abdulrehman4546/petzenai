<?php
/**
 * Tool-specific content for: Leopard Gecko Care Guide for Beginners (registry key: leopard_gecko_care_guide).
 * Registry type is 'guide' and uses a dedicated static widget in inc/tool-renderer.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_leopard_gecko_care_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Leopard geckos are nocturnal/crepuscular, most active at dusk and night, which sets their care apart from basking, daytime-active bearded dragons. They don't need UVB as strictly as a bearded dragon does, though some keepers still provide a low level. They're insectivorous rather than omnivorous, and they store fat in their tails while also being able to drop their tail as a defense mechanism called autotomy.</div>
<?php }

function pz_what_is_leopard_gecko_care_guide() {
    ob_start(); ?>
    <p>A leopard gecko is a ground-dwelling lizard commonly kept as a beginner-friendly reptile pet. Unlike a basking, daytime-active bearded dragon, a leopard gecko is nocturnal or crepuscular, meaning it's most active at dusk and during the night rather than under bright daytime basking light.</p>
    <p>This guide covers that activity pattern, the lighter UVB approach compared to a bearded dragon, the insectivorous diet leopard geckos need, and two genuinely gecko-specific traits: tail fat storage and the tail-drop defense mechanism called autotomy.</p>
    <?php return ob_get_clean();
}

function pz_why_important_leopard_gecko_care_guide() {
    ob_start(); ?>
    <p>Leopard gecko care differs from other commonly kept reptiles in several specific ways, and getting these details right matters for the gecko's health and comfort.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🌙</span>
        <div><strong>Nocturnal/crepuscular activity shapes their care</strong><p>Being most active at dusk and night, rather than basking during the day, is a key difference from daytime-active reptiles like bearded dragons.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">☀️</span>
        <div><strong>UVB is not as strict a requirement as for bearded dragons</strong><p>Some keepers still provide a low level of UVB, but it isn't the same hard requirement that applies to a basking species like the bearded dragon.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🦗</span>
        <div><strong>Leopard geckos are insectivorous, not omnivorous</strong><p>Their diet centers on insects rather than the insect-and-vegetable mix an omnivorous reptile like a bearded dragon eats.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🦎</span>
        <div><strong>Tail fat storage and tail-drop defense are gecko-specific</strong><p>A leopard gecko stores fat reserves in its tail and can drop its tail as a defense mechanism known as autotomy, a trait not shared by bearded dragons.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_leopard_gecko_care_guide() {
    return [
        ['title' => 'Plan around a nocturnal/crepuscular activity pattern', 'desc' => 'Expect more activity at dusk and night rather than during the day, and set up observation and feeding times accordingly.'],
        ['title' => 'Decide on a UVB approach appropriate for the species', 'desc' => 'A leopard gecko doesn\'t need UVB as strictly as a bearded dragon, though some keepers still choose to provide a low level.'],
        ['title' => 'Feed an insectivorous diet rather than an omnivorous one', 'desc' => 'Leopard geckos rely on insects as their diet, unlike the insect-and-vegetable mix a bearded dragon eats.'],
        ['title' => 'Recognize a healthy, fuller tail as a sign of fat storage', 'desc' => 'A leopard gecko\'s tail serves as a fat reserve, so its condition can be a useful general indicator to watch over time.'],
        ['title' => 'Handle gently to avoid triggering tail-drop defense', 'desc' => 'Rough handling or grabbing by the tail can trigger autotomy, the tail-drop defense mechanism geckos use when stressed or threatened.'],
        ['title' => 'Compare care needs against other reptiles rather than assuming they match', 'desc' => 'Activity pattern, UVB needs, and diet all differ from a bearded dragon, so care routines shouldn\'t simply be copied between the two.'],
    ];
}

function pz_tips_leopard_gecko_care_guide() {
    return [
        ['Observe feeding and activity in the evening hours', 'Since leopard geckos are more active at dusk and night, this is when natural behavior is easiest to notice.'],
        ['Don\'t assume UVB rules from other reptiles apply directly', 'A leopard gecko\'s UVB needs are not as strict as a bearded dragon\'s, so a separate approach is appropriate.'],
        ['Stick to an insect-based diet rather than adding vegetables as a staple', 'Leopard geckos are insectivorous, which is a different dietary need than an omnivorous reptile.'],
        ['Avoid picking up a leopard gecko by the tail', 'This increases the chance of triggering the tail-drop defense mechanism known as autotomy.'],
        ['Watch tail condition as a general health cue over time', 'A visibly thin tail can suggest reduced fat reserves worth paying attention to.'],
    ];
}

function pz_mistakes_leopard_gecko_care_guide() {
    return [
        ['❌ Expecting daytime basking behavior like a bearded dragon', 'Leopard geckos are nocturnal/crepuscular, so most activity happens at dusk and night rather than during the day.'],
        ['❌ Applying a bearded dragon\'s strict UVB requirement directly', 'Leopard geckos don\'t need UVB as strictly, even though some keepers still choose to provide a low level.'],
        ['❌ Feeding vegetables as a dietary staple', 'Leopard geckos are insectivorous, unlike an omnivorous reptile that eats both insects and vegetables.'],
        ['❌ Grabbing or handling by the tail', 'This can trigger the tail-drop defense mechanism called autotomy, which is a stress response, not a trick.'],
        ['❌ Ignoring tail condition entirely', 'Since the tail stores fat reserves, its appearance can be a useful general cue worth paying attention to.'],
    ];
}

function pz_faq_leopard_gecko_care_guide() {
    return [
        ['Are leopard geckos active during the day?', 'No, they\'re nocturnal/crepuscular, meaning they\'re most active at dusk and during the night rather than in daytime basking hours.'],
        ['Do leopard geckos need UVB lighting?', 'Not as strictly as a bearded dragon does — some keepers still provide a low level, but it isn\'t the same hard requirement.'],
        ['What do leopard geckos eat?', 'They\'re insectivorous, relying on insects rather than the insect-and-vegetable mix an omnivorous reptile like a bearded dragon eats.'],
        ['Why do leopard geckos have thick tails?', 'Their tails store fat reserves, which can serve as a general indicator of body condition over time.'],
        ['What happens if a leopard gecko drops its tail?', 'This is a defense mechanism called autotomy, often triggered by rough handling or a stressful situation, rather than a sign of injury alone.'],
    ];
}
