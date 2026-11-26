<?php
/**
 * Tool-specific content for: Fish Compatibility Guide: Which Fish Can Live Together (registry key: fish_compatibility_guide).
 * Registry type is 'guide' and uses a dedicated static widget in inc/tool-renderer.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_fish_compatibility_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Fish compatibility depends on temperament as well as water needs: fin-nipping species, territorial species, schooling fish kept alone, and large size mismatches between predator and prey-sized fish are common sources of conflict in a mixed tank.</div>
<?php }

function pz_what_is_fish_compatibility_guide() {
    ob_start(); ?>
    <p>Fish compatibility is often framed around water parameters, but temperament is just as important for a mixed tank to work. Some species are known fin-nippers that bother slower, long-finned tankmates. Others are territorial and defend space aggressively against similar-looking fish. Schooling species are built to live in groups of their own kind and often become stressed or skittish when kept alone or in too small a group. And a large size mismatch, where a small fish is roughly the size of prey to a bigger predatory species, is a straightforward recipe for one fish eating another.</p>
    <p>This guide covers these temperament-based compatibility factors, separate from the species-specific water parameter matching covered in other guides.</p>
    <?php return ob_get_clean();
}

function pz_why_important_fish_compatibility_guide() {
    ob_start(); ?>
    <p>Getting compatibility wrong does not always show up immediately, which makes it easy to misjudge a combination as fine until stress, injury, or a missing fish reveals otherwise.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">✂️</span>
        <div><strong>Fin-nipping species target slower, long-finned fish</strong><p>Certain species have a known tendency to nip at fins, which can repeatedly stress or injure slower-moving, long-finned tankmates.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🚩</span>
        <div><strong>Territorial species defend space aggressively</strong><p>Some fish stake out and defend territory, especially against similar-looking fish, leading to chasing and stress in a crowded or poorly arranged tank.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">👥</span>
        <div><strong>Schooling fish need their own kind in a group</strong><p>A schooling species kept alone or in too few numbers often becomes stressed or hides, since the group is part of how it feels secure.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⚖️</span>
        <div><strong>Large size mismatches put smaller fish at risk</strong><p>Pairing a small fish with a much larger, predatory species can mean the smaller fish is viewed as food rather than a tankmate.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_fish_compatibility_guide() {
    return [
        ['title' => 'Research each species\' temperament before buying', 'desc' => 'Look specifically for notes on fin-nipping tendencies, territorial behavior, and whether the species is a schooling fish.'],
        ['title' => 'Keep schooling species in appropriate group sizes', 'desc' => 'A schooling fish generally needs several of its own kind rather than being added as a single individual to a mixed tank.'],
        ['title' => 'Avoid combining known fin-nippers with long-finned species', 'desc' => 'Pairing a fin-nipping species with slow, long-finned tankmates is a common and avoidable source of injury.'],
        ['title' => 'Check adult size, not just size at purchase', 'desc' => 'A small fish bought young can grow into a size mismatch with tankmates later, so research expected adult size for every species in the tank.'],
        ['title' => 'Watch for early signs of territorial conflict', 'desc' => 'Chasing, fin damage, or a fish hiding constantly can signal a territorial or aggression problem that needs addressing.'],
        ['title' => 'Be ready to separate or rehome a poor match', 'desc' => 'Sometimes a combination that looked fine on paper does not work out in practice, and separating fish is safer than hoping the behavior resolves itself.'],
    ];
}

function pz_tips_fish_compatibility_guide() {
    return [
        ['Research temperament, not just water parameters', 'A species list showing matching temperature and pH needs does not guarantee the fish will get along.'],
        ['Buy schooling fish in groups, not as a single individual', 'A lone schooling fish is more likely to appear stressed or hide than one kept with its own kind.'],
        ['Add territorial species last, if possible', 'Letting calmer fish establish themselves first can sometimes reduce territorial conflict when a more aggressive species is added.'],
        ['Provide hiding spots and visual breaks', 'Decor that breaks line of sight can reduce territorial disputes between fish that might otherwise constantly see and challenge each other.'],
        ['Plan for adult size from the start', 'Choosing tankmates based on the size they will reach as adults avoids surprises as fish grow.'],
    ];
}

function pz_mistakes_fish_compatibility_guide() {
    return [
        ['❌ Assuming matching water parameters means fish are compatible', 'Temperament, including fin-nipping and territorial tendencies, matters separately from water needs.'],
        ['❌ Keeping a schooling species as a single fish', 'This often leaves the fish stressed or withdrawn since schooling species rely on their own group.'],
        ['❌ Mixing fin-nippers with long-finned, slow-moving species', 'This combination is a common and largely avoidable cause of fin damage.'],
        ['❌ Buying based on size at the store rather than adult size', 'A fish that looks harmless small can grow into a serious size mismatch with existing tankmates.'],
        ['❌ Ignoring early chasing or aggression and assuming it will resolve on its own', 'Persistent chasing or fin damage usually needs a response, such as rearranging decor or separating fish, rather than waiting it out.'],
    ];
}

function pz_faq_fish_compatibility_guide() {
    return [
        ['Is water parameter matching enough for fish compatibility?', 'No, temperament factors like fin-nipping tendencies, territorial behavior, and size differences matter separately from matching water needs.'],
        ['Why do schooling fish need to be kept in groups?', 'Schooling species rely on their own kind for a sense of security, and a lone individual often becomes stressed or withdrawn.'],
        ['What is fin-nipping?', 'It describes certain species\' tendency to nip at the fins of slower, long-finned tankmates, which can cause repeated stress or injury.'],
        ['Can a small fish and a large fish live together?', 'It depends on the species, but a large size mismatch between a small fish and a much bigger predatory species often means the smaller fish is at risk.'],
        ['How do I know if two fish are not getting along?', 'Signs include persistent chasing, fin damage, or one fish constantly hiding, which usually call for a change rather than waiting it out.'],
        ['What should I check before adding a new fish to an existing tank?', 'Research its temperament, typical adult size, and whether it is a schooling species, alongside matching its basic water needs.'],
    ];
}
