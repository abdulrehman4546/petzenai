<?php
/**
 * Tool-specific content for: Coping with Pet Loss: Grief Support Guide (registry key: pet_loss_grief_guide).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_pet_loss_grief_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Grief over losing a pet is real grief, not an overreaction, and there is no set timeline for it. Give yourself permission to feel it fully, lean on people who understand, consider a small memorial that feels right to you, and know that there is no "correct" moment to decide whether or when to welcome another pet into your life.</div>
<?php }

function pz_what_is_pet_loss_grief_guide() {
    ob_start(); ?>
    <p>If you have just lost a pet, or you can see that moment coming, this guide is here to sit with you through it. Losing a pet can be one of the hardest losses a person goes through, and it is often not treated with the same understanding as other kinds of grief, which can leave people feeling isolated in exactly the moment they need support most.</p>
    <p>This guide talks through what grief after pet loss commonly looks like, how to support yourself and the people around you, especially children, through it, and how to think about memorializing your pet and eventually, if you choose, opening your home to another animal.</p>
    <p>There is no single right way to grieve. What follows are options and perspectives, not a checklist, and you are welcome to take only what feels useful right now.</p>
    <?php return ob_get_clean();
}

function pz_why_important_pet_loss_grief_guide() {
    ob_start(); ?>
    <p>Pet loss grief is sometimes dismissed by people who have not experienced the depth of a human-animal bond, but the loss is genuine and deserves to be treated that way.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">💔</span>
        <div><strong>Pet loss grief is recognized as genuine grief</strong><p>Mental health professionals and grief counselors widely recognize that losing a pet can trigger the same stages and intensity of grief as losing a close human family member, because for many people, that is exactly what the relationship was.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🙊</span>
        <div><strong>"Disenfranchised grief" makes it harder, not easier</strong><p>Because society sometimes minimizes pet loss, many grieving pet owners feel pressure to hide or rush through their feelings, which research on grief suggests often prolongs rather than shortens the pain.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">👧</span>
        <div><strong>Children process pet loss differently at different ages</strong><p>How a child understands and grieves a pet's death changes significantly with developmental stage, so the way you talk about it with a toddler needs to look different than with a teenager.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🕯️</span>
        <div><strong>Memorializing a pet can be a meaningful part of healing</strong><p>Grief counselors often note that rituals, whether large or small, give grief somewhere to go and can help mark the significance of the relationship rather than letting it pass unacknowledged.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_pet_loss_grief_guide() {
    return [
        ['title' => 'Let yourself feel it, without a timeline', 'desc' => 'There is no correct number of days or weeks for grief to last. Some days will feel heavier than others for a long time, and that is a normal part of loving something deeply.'],
        ['title' => 'Talk to people who understand pet loss specifically', 'desc' => 'Pet loss support groups, whether in person or online, and friends who have been through it themselves often offer a kind of understanding that people without pets may not be able to give right now.'],
        ['title' => 'Decide on a memorial that feels right to you', 'desc' => 'This might be a paw print keepsake, a planted tree, a photo album, or simply keeping a favorite collar somewhere meaningful. There is no obligation to do anything, and no wrong choice if you do.'],
        ['title' => 'Talk with children in a way that fits their age', 'desc' => 'Younger children often need simple, concrete, honest language, while older children and teens may want to talk more about feelings and memories. Avoid euphemisms like "went to sleep," which can confuse or frighten young children.'],
        ['title' => 'Give yourself permission around other pets in the home', 'desc' => 'Surviving pets may also grieve and show behavior changes, and it is okay to give them, and yourself, time to adjust before making other changes to routines.'],
        ['title' => 'Consider the question of a new pet only when it feels right, not on a schedule', 'desc' => 'There is no "correct" waiting period. Some people feel ready quickly, others need a long time, and some choose not to get another pet, and all of these are valid.'],
    ];
}

function pz_tips_pet_loss_grief_guide() {
    return [
        ['Write down memories while they are fresh', 'A particular habit, a funny moment, the way they greeted you, these details are easy to lose over time, and writing them down can become something comforting to revisit later.'],
        ['Let yourself cry in front of your other pets', 'There is no need to hide grief from other animals in your home; they are often attuned to your emotional state and your honesty does not harm them.'],
        ['Be gentle with yourself about guilt', 'Many grieving pet owners cycle through "what ifs" about decisions made near the end of a pet\'s life. These thoughts are extremely common and do not mean you did anything wrong.'],
        ['Find a pet loss hotline or support group if you feel isolated', 'Several veterinary schools and animal welfare organizations run free pet loss support lines staffed by people trained specifically in this kind of grief.'],
        ['Let others help in concrete ways', 'If friends or family ask how to help, specific requests, like sitting with you, helping choose a memorial, or just checking in without judgment, are often easier for people to act on than a vague offer.'],
        ['Notice if grief is affecting your daily functioning for a long stretch', 'If grief feels unmanageable or is seriously affecting your sleep, eating, or ability to function after an extended period, a grief counselor or therapist can offer additional support.'],
    ];
}

function pz_mistakes_pet_loss_grief_guide() {
    return [
        ['❌ Assuming you should "be over it" by a certain point', 'Grief does not run on other people\'s timelines, including your own expectations of yourself, and comparing your grief to an arbitrary deadline usually just adds guilt on top of grief.'],
        ['❌ Using euphemisms with young children', 'Phrases like "went to sleep" can cause real confusion or fear around sleep and bedtime in young children. Honest, age-appropriate language is kinder in the long run.'],
        ['❌ Rushing to get a new pet to "fix" the grief', 'A new pet can be a wonderful addition eventually, but bringing one home before you are ready often means grieving the old pet while also struggling to bond with the new one.'],
        ['❌ Dismissing your own grief because "it was just a pet"', 'Minimizing the bond you had does not make the grief smaller, it just makes it harder to process and easier to carry alone.'],
        ['❌ Ignoring a surviving pet\'s grief or behavior changes', 'Other pets in the household may also show signs of grief, like changes in appetite or searching behavior, and deserve patience and comfort too.'],
        ['❌ Isolating yourself instead of reaching out', 'Because pet loss grief is sometimes misunderstood by others, it can be tempting to withdraw rather than explain. Seeking out people or groups who specifically understand pet loss can make a real difference.'],
    ];
}

function pz_faq_pet_loss_grief_guide() {
    return [
        ['Is it normal to grieve a pet as much as a person?', 'Yes. Grief counselors recognize that the human-animal bond can be as deep as any human relationship, and grieving a pet with that same intensity is a normal, valid response, not an overreaction.'],
        ['How long does pet loss grief typically last?', 'There is no fixed timeline. Grief tends to come in waves rather than a straight line, and it is common for feelings to resurface around anniversaries, holidays, or small reminders long after the loss.'],
        ['How do I explain a pet\'s death to my child?', 'Use honest, simple, age-appropriate language rather than euphemisms like "went to sleep," which can confuse or frighten young children. Older children often benefit from being included in conversations about memories and feelings rather than being shielded from the topic entirely.'],
        ['Should I get another pet right away?', 'There is no required waiting period, and the right timing is personal. Some people feel ready soon after, others need much longer, and some decide not to get another pet at all. All of these are reasonable choices.'],
        ['My other pet seems to be grieving too. What should I do?', 'Surviving pets can show grief through changes in appetite, sleep, or searching behavior. Giving them extra attention, keeping routines stable, and allowing time to adjust usually helps, though check with a vet if changes are severe or prolonged.'],
        ['What are some ways to memorialize a pet?', 'Common options include a paw print or ink print keepsake, planting a tree or garden in their memory, making a photo album or scrapbook, or simply keeping a favorite item like a collar or toy somewhere meaningful. The right memorial is whatever feels meaningful to you.'],
        ['When should I seek professional grief support?', 'If grief feels unmanageable, is seriously affecting your sleep, appetite, or ability to function for an extended period, or if you feel completely isolated in your grief, a grief counselor, therapist, or pet loss support group can offer additional help.'],
    ];
}
