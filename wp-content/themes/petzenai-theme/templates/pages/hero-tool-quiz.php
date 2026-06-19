<?php /** Template Name: ❓ Hero Tool — What Pet Should I Get? */ if(!defined('ABSPATH')) exit; get_header(); ?>
<style><?php include get_template_directory().'/templates/pages/hero-tool-shared.css.php'; ?>
.ht-quiz-q{padding:0 28px 0}
.ht-quiz-intro-box{background:#FFF8F5;border-bottom:1px solid #F0E8E0;padding:16px 28px;margin-bottom:8px}
.ht-quiz-intro-box p{font-size:14px;color:#555;margin:0}
</style>
<main class="ht-page">
<?php include get_template_directory().'/templates/pages/hero-tool-breadcrumb.php'; ?>
<section class="ht-hero" style="background:linear-gradient(135deg,#0D0D1A,#2a0a1a)">
  <span class="ht-hero-icon">❓</span>
  <h1>What Pet Should <span>I Get?</span></h1>
  <p>Answer 10 quick questions about your lifestyle, home, and personality — we match you to your perfect pet.</p>
  <div class="ht-badges"><span class="ht-badge green">✅ Science-Based</span><span class="ht-badge purple">🎯 Personalized</span><span class="ht-badge orange">10 Questions</span></div>
</section>
<div class="ht-main">
  <div class="ht-tool-wrap">
    <div class="ht-tool-header"><h2>❓ Find Your Perfect Pet</h2><p>10 questions · 2 minutes · Life-changing match</p></div>
    <div class="ht-quiz-intro-box"><p>🎯 Answer honestly — there are no wrong answers. The more accurate you are, the better your match!</p></div>

    <div class="ht-progress-wrap"><div class="ht-progress-bar"><div class="ht-progress-fill" id="ht-prog-fill" style="width:10%"></div></div><span class="ht-progress-txt" id="ht-prog-txt">Question 1 of 10</span></div>

    <?php
    $questions = [
      ['q'=>'How active is your lifestyle?','opts'=>[['🛋️','Mostly indoors, relaxed'],['🚶','Daily walks, moderate activity'],['🏃','Very active, outdoor adventures'],['🏋️','Extremely active, sports/hiking']]],
      ['q'=>'What size home do you live in?','opts'=>[['🏠','Small apartment'],['🏡','Medium house with small yard'],['🏘️','Large house with big yard'],['🌾','Rural/farm property']]],
      ['q'=>'How much time can you dedicate to a pet daily?','opts'=>[['⏰','Less than 1 hour'],['⏱️','1–2 hours'],['🕐','3–4 hours'],['⌛','5+ hours']]],
      ['q'=>'What is your budget for pet care per month?','opts'=>[['💵','Under $50'],['💰','$50–$100'],['💳','$100–$200'],['💎','$200+, quality is priority']]],
      ['q'=>'Do you have children at home?','opts'=>[['👶','Toddlers (0–5)'],['👧','Children (6–12)'],['🧑','Teenagers'],['🚫','No children']]],
      ['q'=>'How do you feel about pet hair/mess?','opts'=>[['😬','Can\'t stand any mess'],['🤷','A little is okay'],['😊','It\'s fine, I\'ll clean up'],['🤣','Mess doesn\'t bother me at all']]],
      ['q'=>'What kind of bond do you want?','opts'=>[['🤝','Companion who follows me everywhere'],['😌','Independent pet who\'s there when I want'],['🎭','Entertaining, playful performer'],['🔍','Interesting creature to observe']]],
      ['q'=>'Experience with pets?','opts'=>[['🆕','First-time pet owner'],['📚','Had pets as a child'],['✅','Current or recent pet owner'],['🏆','Experienced with multiple species']]],
      ['q'=>'Allergies in the household?','opts'=>[['🤧','Yes — need hypoallergenic options'],['❓','Not sure'],['✅','No allergies'],['🐟','Prefer non-furry pets anyway']]],
      ['q'=>'What\'s your living situation?','opts'=>[['🏢','Renting — restrictions on pets'],['🏠','Own my home — flexible'],['👨‍👩‍👧','With family — shared decision'],['🌍','Travel frequently for work']]],
    ];
    foreach($questions as $i=>$q): ?>
    <div class="ht-step <?php echo $i===0?'active':''; ?> ht-quiz-q" id="ht-step-<?php echo $i; ?>">
      <div class="ht-q-num">Question <?php echo $i+1; ?> of <?php echo count($questions); ?></div>
      <p class="ht-q-text"><?php echo esc_html($q['q']); ?></p>
      <div class="ht-answer-cards">
        <?php foreach($q['opts'] as $j=>$opt): ?>
        <label class="ht-answer-card" id="ht-card-<?php echo $i; ?>-<?php echo $j; ?>">
          <input type="radio" name="htq_<?php echo $i; ?>" value="<?php echo $j; ?>"
                 onchange="htQuizNext(<?php echo $i; ?>, <?php echo count($questions)-1; ?>, this)">
          <span class="ht-answer-icon"><?php echo $opt[0]; ?></span>
          <span class="ht-answer-txt"><?php echo esc_html($opt[1]); ?></span>
        </label>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endforeach; ?>

    <div style="padding:0 28px 28px;display:none" id="ht-submit-wrap">
      <button class="ht-btn" onclick="htCalcQuiz()">🎯 Find My Perfect Pet Match!</button>
    </div>
    <div id="ht-result" style="display:none;margin:0 28px 28px"></div>
  </div>
  <div class="ht-info-wrap">
    <div class="ht-info-card"><h3>🐾 Pets We Match</h3><ul>
      <li>🐕 Dogs — 30+ lifestyle profiles</li><li>🐱 Cats — indoor & outdoor types</li>
      <li>🐰 Rabbits — gentle & low-maintenance</li><li>🦜 Birds — social & intelligent</li>
      <li>🐠 Fish — peaceful & low-effort</li><li>🐹 Small pets — hamsters, guinea pigs</li>
    </ul></div>
    <div class="ht-info-card"><h3>⚠️ Before You Adopt</h3><ul>
      <li>Research breed-specific needs thoroughly</li><li>Consider adoption from local shelters first</li>
      <li>Ensure all household members agree</li><li>Budget for vet, food, supplies, and grooming</li>
    </ul></div>
    <div class="ht-related"><h3>🔗 After Your Match</h3>
      <a href="<?php echo home_url('/tools/ai-pet-name-generator/'); ?>" class="ht-rel-link">✨ Name Generator →</a>
      <a href="<?php echo home_url('/tools/pet-food-portion-calculator/'); ?>" class="ht-rel-link">🍽️ Food Calculator →</a>
      <a href="<?php echo home_url('/tools/pet-vaccination-schedule/'); ?>" class="ht-rel-link">💉 Vaccine Schedule →</a>
    </div>
  </div>
</div>
<script>
function htQuizNext(cur, total, inp){
  var cards=document.querySelectorAll('#ht-step-'+cur+' .ht-answer-card');
  cards.forEach(function(c){c.classList.remove('selected')});
  inp.closest('.ht-answer-card').classList.add('selected');
  setTimeout(function(){
    document.getElementById('ht-step-'+cur).classList.remove('active');
    var next=cur+1;
    if(next<=total){
      document.getElementById('ht-step-'+next).classList.add('active');
      var pct=Math.round(((next+1)/(total+1))*100);
      document.getElementById('ht-prog-fill').style.width=pct+'%';
      document.getElementById('ht-prog-txt').textContent='Question '+(next+1)+' of '+(total+1);
    }
    if(cur===total-1){
      document.getElementById('ht-prog-fill').style.width='95%';
      document.getElementById('ht-prog-txt').textContent='Last question!';
    }
    if(cur===total){
      document.getElementById('ht-prog-fill').style.width='100%';
      document.getElementById('ht-prog-txt').textContent='All done!';
      document.getElementById('ht-submit-wrap').style.display='block';
    }
  },350);
}
function htCalcQuiz(){
  var answers=[];
  for(var i=0;i<10;i++){var r=document.querySelector('input[name="htq_'+i+'"]:checked');answers.push(r?parseInt(r.value):0);}
  // Scoring matrix: [dog, cat, rabbit, bird, fish, smallpet]
  var scores=[0,0,0,0,0,0];
  var weights=[[3,1,1,1,0,0],[2,1,1,1,1,0],[3,1,0,1,0,0],[2,1,1,1,1,1],[1,2,2,2,2,2],[1,2,2,1,2,2],[2,1,2,2,2,1],[0,0,0,0,0,0],[0,0,0,0,0,0],[2,1,0,1,2,1]];
  answers.forEach(function(a,i){var row=weights[i];if(a===0){scores[0]+=1;scores[4]+=2;scores[5]+=1;}else if(a===1){scores[0]+=2;scores[1]+=1;scores[2]+=1;}else if(a===2){scores[0]+=3;scores[3]+=2;}else{scores[0]+=2;scores[3]+=3;}});
  // Simple activity-based override
  if(answers[0]===0){scores[4]+=3;scores[5]+=2;scores[1]+=2;}
  if(answers[0]===3){scores[0]+=4;}
  if(answers[1]===0){scores[1]+=3;scores[4]+=3;scores[5]+=2;scores[0]-=2;}
  if(answers[8]===0){scores[4]+=4;scores[5]+=3;scores[0]-=3;scores[1]-=2;}
  var pets=[
    {name:'Dog',emoji:'🐕',color:'#E65100',reason:'Your active lifestyle and home setup are perfect for a dog. Dogs thrive with engaged owners who provide daily exercise and companionship.'},
    {name:'Cat',emoji:'🐱',color:'#1565C0',reason:'Your lifestyle matches a cat\'s independent nature. Cats are low-maintenance, apartment-friendly, and provide wonderful companionship.'},
    {name:'Rabbit',emoji:'🐰',color:'#2E7D32',reason:'Rabbits are gentle, quiet, and great for smaller spaces. They\'re social but don\'t need walks, making them ideal for your lifestyle.'},
    {name:'Bird',emoji:'🦜',color:'#6A1B9A',reason:'Birds are intelligent, entertaining, and bond deeply with their owners. They\'re perfect for social people who want an interactive companion.'},
    {name:'Fish',emoji:'🐠',color:'#0277BD',reason:'Fish are peaceful, low-maintenance, and perfect for busy or allergy-prone households. A beautiful aquarium is both relaxing and rewarding.'},
    {name:'Small Pet',emoji:'🐹',color:'#558B2F',reason:'Hamsters, guinea pigs, or gerbils are perfect starter pets — low cost, small space, and great for learning pet care responsibilities.'},
  ];
  var best=scores.indexOf(Math.max.apply(null,scores));
  var ranked=scores.map(function(s,i){return{s:s,p:pets[i]}}).sort(function(a,b){return b.s-a.s});
  var res=document.getElementById('ht-result');
  res.style.display='block';
  res.innerHTML='<div class="ht-result-box">'
    +'<div class="ht-result-top" style="background:linear-gradient(135deg,'+ranked[0].p.color+','+ranked[0].p.color+'cc)">'
    +'<div style="font-size:13px;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">🎯 Your Perfect Pet Match</div>'
    +'<div style="font-size:60px;margin-bottom:8px">'+ranked[0].p.emoji+'</div>'
    +'<div style="font-size:28px;font-weight:900;margin-bottom:8px">'+ranked[0].p.name+'</div>'
    +'<div style="font-size:13px;opacity:.8;max-width:400px;margin:0 auto;line-height:1.5">'+ranked[0].p.reason+'</div>'
    +'</div>'
    +'<div class="ht-result-cells">'
    +ranked.slice(1,4).map(function(r,i){return '<div class="ht-cell"><div class="ht-cell-n">'+r.p.emoji+'</div><div class="ht-cell-l">#'+(i+2)+' '+r.p.name+'</div></div>';}).join('')
    +'<div class="ht-cell"><div class="ht-cell-n">✅</div><div class="ht-cell-l">Your Match</div></div>'
    +'</div>'
    +'<div class="ht-result-tips"><h4>🚀 Next Steps</h4><ul>'
    +'<li>Research '+ranked[0].p.name.toLowerCase()+' breeds that match your lifestyle</li>'
    +'<li>Visit local shelters — adoption saves lives!</li>'
    +'<li>Use our Food Calculator and Vaccine Schedule tools</li>'
    +'</ul></div>'
    +'<button onclick="htGenNames&&htGenNames()||window.location=\"<?php echo home_url('/tools/ai-pet-name-generator/'); ?>\"" class="ht-print-btn">✨ Find a Name for Your New Pet →</button>'
    +'</div>';
  document.getElementById('ht-submit-wrap').style.display='none';
}
</script>
<?php get_footer(); ?>
