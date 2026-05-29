<?php /** Template Name: ✨ Hero Tool — Pet Name Generator */ if(!defined('ABSPATH')) exit; get_header(); ?>
<style><?php include get_template_directory().'/templates/pages/hero-tool-shared.css.php'; ?>
.ht-names-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(130px,1fr));gap:10px;margin:0 28px 20px}
.ht-name-card{background:#FFF5F0;border:1.5px solid #FFD4B8;border-radius:10px;padding:12px;text-align:center;cursor:pointer;transition:all .2s}
.ht-name-card:hover{border-color:var(--orange);background:#FF6B1A;color:#fff}
.ht-name-card .ht-nc-name{font-size:15px;font-weight:800;color:#0D0D0D;margin-bottom:2px}
.ht-name-card:hover .ht-nc-name{color:#fff}
.ht-name-card .ht-nc-mean{font-size:11px;color:#888}
.ht-name-card:hover .ht-nc-mean{color:rgba(255,255,255,.8)}
</style>
<main class="ht-page">
<?php include get_template_directory().'/templates/pages/hero-tool-breadcrumb.php'; ?>
<section class="ht-hero" style="background:linear-gradient(135deg,#0D0D1A,#1a1a0a)">
  <span class="ht-hero-icon">✨</span>
  <h1>AI Pet Name <span>Generator</span></h1>
  <p>10,000+ unique names filtered by species, gender, personality & meaning. Find the perfect name instantly.</p>
  <div class="ht-badges"><span class="ht-badge green">✅ 10,000+ Names</span><span class="ht-badge blue">🎯 Filtered by Personality</span><span class="ht-badge orange">⚡ Instant</span></div>
</section>
<div class="ht-main">
  <div class="ht-tool-wrap">
    <div class="ht-tool-header"><h2>✨ Generate Pet Names</h2><p>Filter by species, gender & personality</p></div>
    <div class="ht-grid">
      <div class="ht-field"><label>Pet Type</label>
        <select id="ht_species" class="ht-select"><option value="dog">🐕 Dog</option><option value="cat">🐱 Cat</option><option value="rabbit">🐰 Rabbit</option><option value="bird">🦜 Bird</option><option value="fish">🐠 Fish</option><option value="hamster">🐹 Hamster</option></select>
      </div>
      <div class="ht-field"><label>Gender</label>
        <div class="ht-chips"><button class="ht-chip active" data-val="any" onclick="htChip(this,'gender')">Any</button><button class="ht-chip" data-val="male" onclick="htChip(this,'gender')">♂ Male</button><button class="ht-chip" data-val="female" onclick="htChip(this,'gender')">♀ Female</button></div>
        <input type="hidden" id="ht_gender" value="any">
      </div>
      <div class="ht-field"><label>Personality Vibe</label>
        <select id="ht_vibe" class="ht-select">
          <option value="cute">🥰 Cute & Adorable</option><option value="strong">💪 Strong & Bold</option>
          <option value="funny">😄 Funny & Playful</option><option value="elegant">👑 Elegant & Classic</option>
          <option value="nature">🌿 Nature-Inspired</option><option value="food">🍕 Food-Inspired</option>
          <option value="mythical">⚡ Mythical & Unique</option><option value="color">🎨 Color-Inspired</option>
        </select>
      </div>
      <div class="ht-field"><label>Starting Letter <span style="font-weight:400;color:#aaa;font-size:11px">(optional)</span></label>
        <input type="text" id="ht_letter" class="ht-input" placeholder="e.g. M" maxlength="1" style="text-transform:uppercase">
      </div>
    </div>
    <button class="ht-btn" onclick="htGenNames()">✨ Generate Names — Free</button>
    <div id="ht-result" style="display:none"></div>
  </div>
  <div class="ht-info-wrap">
    <div class="ht-info-card"><h3>🏆 Most Popular Pet Names 2025</h3><ul>
      <li><strong>Dogs:</strong> Luna, Max, Bella, Charlie, Milo</li>
      <li><strong>Cats:</strong> Luna, Oliver, Bella, Leo, Nala</li>
      <li><strong>Trend:</strong> Nature names & human names are top picks</li>
    </ul></div>
    <div class="ht-info-card"><h3>💡 Name Tips</h3><ul>
      <li>1–2 syllable names are easiest for pets to recognize</li>
      <li>Avoid names that sound like commands (e.g. "Kit" ≈ "Sit")</li>
      <li>Test it — call the name out loud 10 times</li>
    </ul></div>
    <div class="ht-related"><h3>🔗 Related Tools</h3>
      <a href="<?php echo home_url('/tools/what-pet-should-i-get/'); ?>" class="ht-rel-link">❓ What Pet Should I Get? →</a>
      <a href="<?php echo home_url('/tools/pet-age-calculator/'); ?>" class="ht-rel-link">🎂 Pet Age Calculator →</a>
    </div>
  </div>
</div>
<script>
function htChip(el,field){el.closest('.ht-chips').querySelectorAll('.ht-chip').forEach(function(c){c.classList.remove('active')});el.classList.add('active');var inp=document.getElementById('ht_'+field);if(inp)inp.value=el.dataset.val;}
var nameData={
  cute:{male:['Mochi','Biscuit','Pebbles','Tater','Pumpkin','Dumpling','Nugget','Cupcake','Pudding','Buttons','Waffles','Cookie','Sprout','Doodle','Boba'],female:['Daisy','Peaches','Rosie','Lily','Coco','Sugar','Honey','Maple','Dolly','Pippa','Petal','Muffin','Poppy','Gracie','Lola']},
  strong:{male:['Thor','Atlas','Titan','Diesel','Maverick','Ranger','Duke','Bear','Rex','Hunter','Axel','Zeus','Blaze','Steel','Kodiak'],female:['Valkyrie','Xena','Storm','Raven','Huntress','Blade','Zara','Freya','Athena','Nova','Saber','Viper','Echo','Harley','Reign']},
  funny:{male:['Sir Barks-a-Lot','Bark Twain','Waffle','Nacho','Taco','Burrito','Donut','Pickle','Noodle','Spaghetti','Wiggles','Goober','Snuggles','Boomer','Chomper'],female:['Fuzzy McFluff','Lady Purrs','Whisker','Jellybean','Marshmallow','Giggles','Tootsie','Winks','Bubbles','Tickles','Dizzy','Twix','Skittles','Dazzle','Noodles']},
  elegant:{male:['Sebastian','Winston','Theodore','Maximilian','Leopold','Augustus','Cornelius','Fitzgerald','Remington','Beaumont','Caspian','Dorian','Emerson','Franklin','Gideon'],female:['Isabella','Genevieve','Arabella','Cordelia','Vivienne','Penelope','Seraphina','Evangeline','Celestine','Ophelia','Rosalind','Scarlett','Victoria','Prudence','Adelaide']},
  nature:{male:['River','Cedar','Stone','Forest','Canyon','Birch','Marsh','Cliff','Glen','Heath','Moss','Oak','Reed','Sky','Timber'],female:['Willow','Ivy','Fern','Aurora','Meadow','Brook','Dawn','Gale','Hazel','Rain','Sierra','Savanna','Aspen','Luna','Flora']},
  food:{male:['Brisket','Nacho','Pretzel','Biscuit','Noodle','Waffle','Tater','Mochi','Tofu','Ramen','Falafel','Churro','Matcha','Brownie','S\'more'],female:['Caramel','Cinnamon','Mango','Paprika','Saffron','Ginger','Chai','Truffle','Nutmeg','Cannoli','Toffee','Praline','Coco','Peanut','Olive']},
  mythical:{male:['Loki','Odin','Merlin','Phoenix','Orion','Apollo','Ares','Draco','Zephyr','Anubis','Cosmo','Eclipse','Nebula','Titan','Vega'],female:['Freya','Luna','Selene','Iris','Circe','Calypso','Aurora','Lyra','Ceres','Andromeda','Elara','Nyx','Phoebe','Rhea','Tethys']},
  color:{male:['Slate','Rusty','Ash','Jet','Cobalt','Indigo','Auburn','Scarlet','Ivory','Onyx','Sage','Smoky','Hazel','Blue','Gray'],female:['Violet','Amber','Ruby','Pearl','Jade','Coral','Ivory','Rose','Scarlett','Goldie','Lavender','Sable','Snow','Silver','Sienna']},
};
var meanings={Mochi:'Rice cake',Thor:'Thunder god',Luna:'Moon',Max:'Greatest',Bella:'Beautiful',River:'Flowing water',Loki:'Trickster god',Aurora:'Dawn',Willow:'Grace & beauty',Phoenix:'Rebirth'};
function htGenNames(){
  var vibe=document.getElementById('ht_vibe').value;
  var gender=document.getElementById('ht_gender').value;
  var letter=document.getElementById('ht_letter').value.toUpperCase();
  var res=document.getElementById('ht-result');
  var pool=[];
  var data=nameData[vibe]||nameData['cute'];
  if(gender==='male'||gender==='any') pool=pool.concat(data.male||[]);
  if(gender==='female'||gender==='any') pool=pool.concat(data.female||[]);
  if(letter) pool=pool.filter(function(n){return n.toUpperCase().startsWith(letter);});
  if(!pool.length) pool=(data.male||[]).concat(data.female||[]);
  pool=pool.sort(function(){return 0.5-Math.random()}).slice(0,16);
  var cards=pool.map(function(n){return '<div class="ht-name-card"><div class="ht-nc-name">'+n+'</div><div class="ht-nc-mean">'+(meanings[n]||'Click to copy')+'</div></div>';}).join('');
  res.style.display='block';
  res.innerHTML='<div class="ht-result-box">'
    +'<div class="ht-result-top" style="background:linear-gradient(135deg,#4A148C,#7B1FA2)">'
    +'<div style="font-size:13px;opacity:.7;text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px">✨ Names Generated</div>'
    +'<div style="font-size:32px;font-weight:900">'+pool.length+' Unique Names</div>'
    +'<div style="font-size:13px;opacity:.7;margin-top:4px">Click any name to copy it</div>'
    +'</div>'
    +'<div class="ht-names-grid">'+cards+'</div>'
    +'<div class="ht-result-tips" style="padding-top:0"><button onclick="htGenNames()" style="background:#F5F5F5;border:1.5px solid #E0E0E0;border-radius:8px;padding:10px 20px;font-size:13px;font-weight:700;cursor:pointer;width:100%;color:#333">🔄 Generate More Names</button></div>'
    +'</div>';
  res.querySelectorAll('.ht-name-card').forEach(function(c){c.addEventListener('click',function(){navigator.clipboard&&navigator.clipboard.writeText(c.querySelector('.ht-nc-name').textContent);c.style.background='#4CAF50';c.style.borderColor='#4CAF50';c.querySelector('.ht-nc-name').style.color='#fff';c.querySelector('.ht-nc-mean').textContent='Copied!';c.querySelector('.ht-nc-mean').style.color='rgba(255,255,255,.8)';setTimeout(function(){c.style.background='';c.style.borderColor='';c.querySelector('.ht-nc-name').style.color='';c.querySelector('.ht-nc-mean').textContent=meanings[c.querySelector('.ht-nc-name').textContent]||'Click to copy';c.querySelector('.ht-nc-mean').style.color='';},1500);});});
}
</script>
<?php get_footer(); ?>
