<?php
/**
 * Tool-specific content for: Bird Molting: What to Expect & How to Help (registry key: bird_molting_guide).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_bird_molting_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Molting is the normal process of a bird shedding old feathers and growing new ones, usually once or twice a year, and it typically takes several weeks to a couple of months to finish. During a molt it's normal to see loose feathers around the cage, a patchier look, and a grumpier-than-usual bird, since the new "blood feathers" coming in can be itchy and tender to the touch.</div>
<?php }

function pz_what_is_bird_molting_guide() {
    ob_start(); ?>
    <p>This guide explains what's happening during a normal molt and how to tell it apart from feather loss that points to a health problem. It applies across pet bird species rather than one bird in particular, since the underlying process, shedding and regrowing feathers, works the same way in parakeets, cockatiels, parrots, and other common pet birds.</p>
    <p>A molt replaces feathers that have become worn from flying, rubbing against the cage, and everyday wear. Feathers don't repair themselves once damaged, so periodic replacement is how a bird keeps its flight ability and insulation intact over its life.</p>
    <p>New feathers emerge from the skin as "blood feathers," encased in a protective waxy sheath with a blood supply running through the shaft while they develop. The bird (or a cagemate, through mutual preening) picks the dried sheath off once the feather has finished growing, revealing the mature feather underneath.</p>
    <?php return ob_get_clean();
}

function pz_why_important_bird_molting_guide() {
    ob_start(); ?>
    <p>Knowing what a normal molt looks like helps you tell the difference between ordinary feather replacement and signs of feather-destructive behavior, illness, or injury that are worth a vet visit.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🪶</span>
        <div><strong>Molting is gradual, not all at once</strong><p>A healthy molt happens in patches over weeks so the bird never loses its ability to fly or stay insulated; large bald patches appearing quickly are not typical of a normal molt.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🩸</span>
        <div><strong>Blood feathers can bleed if broken</strong><p>Because a growing blood feather has an active blood supply, a snapped one can bleed noticeably; knowing this in advance means you're not caught off guard if it happens.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">😤</span>
        <div><strong>Mood changes during a molt are expected</strong><p>New feathers coming in can be itchy and sensitive to touch, so a bird that's normally cuddly may avoid being handled or seem more irritable while molting.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🔍</span>
        <div><strong>It's the easiest time to miss a real problem</strong><p>Owners sometimes write off ongoing bald spots, skin irritation, or feathers that never grow back as "just molting" when it's actually a behavioral or medical issue needing attention.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_bird_molting_guide() {
    return [
        ['title' => 'Expect loose feathers and a patchier look', 'desc' => 'Finding feathers at the bottom of the cage and noticing thinner-looking patches on your bird is normal during a molt and isn\'t by itself a cause for concern.'],
        ['title' => 'Offer extra protein around molting season', 'desc' => 'Growing a full set of new feathers takes more protein than maintenance does, so make sure pellets and protein-containing vegetables stay part of the daily diet rather than cutting back.'],
        ['title' => 'Avoid handling areas with visible blood feathers roughly', 'desc' => 'New blood feathers are tender and have a blood supply running through them; let your bird guide how much touching it wants near those areas rather than forcing contact.'],
        ['title' => 'Provide a light misting or shallow bath a few times a week', 'desc' => 'Dampening the feathers helps loosen the dry sheaths covering new feathers and can make the itchy regrowth phase more comfortable.'],
        ['title' => 'Give your bird more quiet, low-stress time than usual', 'desc' => 'A molting bird is often more irritable or withdrawn; reducing handling demands and loud activity around the cage for a while tends to help.'],
        ['title' => 'Watch for bald spots that don\'t regrow or spreading irritation', 'desc' => 'A feather-free area that stays bare well after the molt should have ended, or skin that looks red, scabbed, or chewed, is worth an avian vet visit rather than waiting it out.'],
    ];
}

function pz_tips_bird_molting_guide() {
    return [
        ['Let your bird finish preening a loosened sheath itself when possible', 'Pulling at a sheath that hasn\'t fully dried out can hurt the bird; a cagemate\'s help with mutual preening, or patience, works better than forcing it off.'],
        ['Keep a towel handy if you keep flighted birds during a heavy molt', 'A bird mid-molt can have a temporarily weaker flight pattern while feathers are being replaced, so being ready to gently catch or guide it reduces injury risk.'],
        ['Don\'t assume a quiet molt means no stress', 'Some birds molt without any mood change, but even a stoic bird may simply be masking discomfort; watching appetite and activity levels is a better gauge than mood alone.'],
        ['Track roughly when molts happen for your individual bird', 'Many pet birds molt around the same time each year, often tied to day length; noting the pattern helps you recognize what\'s normal for your particular bird.'],
        ['Avoid pulling out a broken blood feather yourself unless shown how', 'A broken blood feather can bleed heavily, and removing it incorrectly can make bleeding worse; contact an avian vet for guidance the first time this happens.'],
    ];
}

function pz_mistakes_bird_molting_guide() {
    return [
        ['❌ Cutting back on food because the bird seems less active', 'A molting bird actually needs more nutritional support to grow new feathers, not less, since feather regrowth draws heavily on protein reserves.'],
        ['❌ Assuming every bald patch is a normal molt', 'Ongoing bald spots, feathers that are chewed off at the base rather than shed whole, or skin irritation point toward feather-destructive behavior or a medical issue rather than routine molting.'],
        ['❌ Forcing handling on a bird that\'s avoiding touch during a molt', 'Pushing through a bird\'s clear discomfort around tender new feathers can create a lasting negative association with handling in general.'],
        ['❌ Panicking over a bleeding broken blood feather without acting', 'A broken blood feather can bleed steadily; applying gentle pressure and contacting an avian vet promptly matters more than waiting to see if it stops on its own.'],
        ['❌ Ignoring a molt that seems to drag on far longer than usual', 'A molt that continues well beyond the bird\'s normal pattern, or never seems to finish, can indicate stress, poor nutrition, or an underlying health issue.'],
    ];
}

function pz_faq_bird_molting_guide() {
    return [
        ['How often do pet birds molt?', 'Most pet birds go through a full molt once or twice a year, often influenced by day length, though the exact timing and pattern varies by individual bird.'],
        ['How long does a molt last?', 'A typical molt takes several weeks to a couple of months to complete, since feathers are replaced gradually in patches rather than all shedding at once.'],
        ['Why does my bird seem grumpier while molting?', 'Growing feathers emerge as sensitive blood feathers that can be itchy and tender, so irritability or reduced interest in being handled during this time is common and usually temporary.'],
        ['What should I feed my bird during a molt?', 'Keep offering a diet built around pellets and fresh vegetables, since growing new feathers requires more protein than normal maintenance; this isn\'t a time to cut back on food.'],
        ['Is it normal for a feather to bleed during molting?', 'A developing blood feather has an active blood supply, so a feather that breaks while still growing in can bleed; applying gentle pressure and contacting an avian vet is the right response if it happens.'],
        ['When should I worry about feather loss?', 'See an avian vet if bald patches don\'t regrow after the molt should have ended, if skin looks irritated or scabbed, or if feathers appear chewed off rather than naturally shed.'],
        ['Can I bathe my bird during a molt?', 'Yes, light misting or a shallow bath a few times a week can help loosen the dry sheaths on new feathers and often makes the itchy regrowth phase more comfortable.'],
    ];
}
