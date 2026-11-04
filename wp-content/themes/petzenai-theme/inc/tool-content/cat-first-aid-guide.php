<?php
/**
 * Tool-specific content for: Cat First Aid Guide: Emergency Situations (registry key: cat_first_aid_guide).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_cat_first_aid_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> For any cat emergency — trauma, difficulty breathing, suspected poisoning, seizures, or collapse — keep the cat calm, limit movement, and get her to a vet or emergency animal hospital immediately. First aid at home is about stabilizing and safely transporting her, not treating the underlying problem yourself.</div>
<?php }

function pz_what_is_cat_first_aid_guide() {
    ob_start(); ?>
    <p>This guide covers how to recognize a true cat emergency and what to do in the minutes before and during the trip to a vet. It is written for the moments when something has clearly gone wrong — a fall, a fight, sudden collapse, labored breathing, or exposure to something toxic — and you need a clear next step rather than a search engine spiral.</p>
    <p>Cat first aid at home has a narrow, specific job: keep the cat from getting more hurt, keep yourself from getting bitten or scratched by a frightened animal, and get her to professional care as fast as safely possible. It is not a substitute for veterinary treatment, and this guide deliberately does not include dosing any medication, since giving the wrong drug or amount to a cat can be fatal.</p>
    <p>Cats hide pain and distress far more than dogs do, so part of this guide is also about recognizing the quieter signs — hiding, rapid shallow breathing, dragging a limb — that something is seriously wrong even without an obvious wound.</p>
    <?php return ob_get_clean();
}

function pz_why_important_cat_first_aid_guide() {
    ob_start(); ?>
    <p>Knowing the right immediate steps, and just as importantly what not to do, can change the outcome in the window before a vet takes over.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">⏱️</span>
        <div><strong>The first minutes matter</strong><p>For poisoning, breathing trouble, and major trauma, how quickly a cat reaches veterinary care often matters more than anything done at home in between.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🙀</span>
        <div><strong>Scared cats bite and scratch</strong><p>A cat in pain or shock, even a normally gentle one, can injure the person trying to help her. Safe handling protects both of you and avoids making the injury worse.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🚫</span>
        <div><strong>Common home remedies can do real harm</strong><p>Giving human medication, trying to induce vomiting the wrong way, or forcing water into a struggling cat are frequent, well-meant mistakes that make emergencies worse.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">📞</span>
        <div><strong>Knowing who to call saves time</strong><p>Having an emergency vet's number and the nearest animal poison control line saved in your phone ahead of time removes a panicked search from an already stressful moment.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_cat_first_aid_guide() {
    return [
        ['title' => 'Stay calm and approach slowly', 'desc' => 'A hurt cat is frightened and may bite or scratch even if she normally never would. Speak softly and move slowly rather than grabbing suddenly.'],
        ['title' => 'Check breathing and responsiveness', 'desc' => 'Look for a rising and falling chest and whether she responds to her name or a gentle touch. Open-mouth breathing or blue-tinged gums is an emergency.'],
        ['title' => 'Control visible bleeding', 'desc' => 'Apply gentle, steady pressure with a clean cloth over a wound. Do not apply a tourniquet unless a vet has specifically instructed you how.'],
        ['title' => 'Limit movement for suspected fractures or spinal injury', 'desc' => 'Slide her onto a flat, firm surface such as a board or sturdy box lid without twisting her body, and keep her as still as possible on the way to the vet.'],
        ['title' => 'Call ahead to the vet or emergency clinic', 'desc' => 'Tell them what happened while you are en route so they can prepare, and ask if there is anything specific they want you to do or avoid during transport.'],
        ['title' => 'Transport in a secure carrier', 'desc' => 'Even an injured cat can panic and bolt; a closed carrier lined with a towel keeps her contained and reduces further injury on the drive.'],
    ];
}

function pz_tips_cat_first_aid_guide() {
    return [
        ['Keep a cat first aid kit ready', 'Gauze, a clean towel, a muzzle or thick towel for safe restraint, and your vet\'s and the nearest emergency clinic\'s numbers, stored somewhere you can grab quickly.'],
        ['Wrap a scared cat in a towel before handling', 'A "cat burrito" wrap controls claws and reduces struggling far more safely than trying to hold a thrashing cat with your hands alone.'],
        ['Save the ASPCA or Pet Poison Helpline number in your phone now', 'If you suspect poisoning, a poison control specialist can tell you within minutes whether it is an emergency and what the vet will need to know.'],
        ['Note the time symptoms started', 'Vets will ask when a problem began, so note the time and anything the cat was exposed to, such as a plant, medication bottle, or spoiled food.'],
        ['Bring the packaging of anything ingested', 'If you suspect your cat ate a plant, chemical, or medication, bring the container or a photo of the label so the vet or poison control can identify it precisely.'],
        ['Have a carrier accessible at all times, not stored away', 'In an emergency, hunting for a carrier wastes critical minutes; keep it somewhere grab-and-go.'],
    ];
}

function pz_mistakes_cat_first_aid_guide() {
    return [
        ['❌ Giving human pain medication', 'Common over-the-counter pain relievers such as acetaminophen and ibuprofen are highly toxic to cats, even in small amounts. Never give any human medication without explicit veterinary instruction.'],
        ['❌ Trying to induce vomiting at home', 'What is safe to use for this in dogs is often unsafe or ineffective in cats, and vomiting is not always the right response depending on what was ingested. Call a vet or poison control first.'],
        ['❌ Handling an injured cat with bare hands and no restraint', 'A cat in pain can bite hard enough to cause a serious infection. Use a towel wrap or thick gloves when handling an injured or frightened cat.'],
        ['❌ Waiting to "see if it gets better"', 'Breathing difficulty, repeated vomiting, inability to urinate, or collapse can worsen within hours. These warrant immediate veterinary attention, not a wait-and-watch approach.'],
        ['❌ Forcing water or food on a sick cat', 'A cat that is nauseated, in shock, or has trouble breathing can inhale liquid forced into her mouth. Let a vet determine when it is safe to offer food or water again.'],
        ['❌ Not having a plan for after-hours emergencies', 'Many regular vet clinics are closed overnight and on weekends; find and save the nearest 24-hour emergency animal hospital before you need it.'],
    ];
}

function pz_faq_cat_first_aid_guide() {
    return [
        ['What are signs of a true cat emergency?', 'Labored or open-mouth breathing, pale or blue-tinged gums, collapse, repeated vomiting, inability to urinate, seizures, a large wound, or suspected poisoning are all reasons to go to a vet or emergency clinic immediately rather than waiting.'],
        ['Should I induce vomiting if my cat ate something toxic?', 'Do not try this on your own. Call your vet or a poison control helpline first, since the right response depends on exactly what was ingested, and some home methods used for dogs are unsafe for cats.'],
        ['How do I safely restrain a scared or injured cat?', 'Wrapping her snugly in a thick towel with only the area you need to treat exposed, sometimes called a "cat burrito," controls claws and reduces struggling while keeping both of you safer than trying to hold her directly.'],
        ['Can I give my cat human medication in an emergency?', 'No. Several common human medications, including acetaminophen and ibuprofen, are toxic to cats even in small doses. Never give any medication not specifically prescribed for that cat by a vet.'],
        ['What should be in a cat first aid kit?', 'Gauze pads, a clean towel for restraint and warmth, blunt-tip scissors, a pet-safe antiseptic if your vet recommends one, a secure carrier, and your vet\'s plus the nearest emergency clinic\'s phone numbers.'],
        ['How do I know if my cat is in shock?', 'Signs can include pale or gray gums, a weak or rapid pulse, cold extremities, rapid shallow breathing, and lethargy or collapse. Shock is a medical emergency requiring immediate veterinary care.'],
        ['What if my cat stops breathing?', 'Check for a heartbeat and responsiveness and get her to an emergency vet immediately — call ahead so they can be ready. CPR technique for cats differs from humans and dogs, so this is best guided by an emergency vet over the phone if you are far from help.'],
    ];
}
