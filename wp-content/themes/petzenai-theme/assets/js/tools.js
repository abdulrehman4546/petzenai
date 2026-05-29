/* ============================================================
   PetZenAI — Working Tools JS
   ============================================================ */

/* ── FOOD CALCULATOR ── */
function pzFoodCalc() {
  var animal    = document.getElementById('food-animal').value;
  var weightVal = parseFloat(document.getElementById('food-weight').value);
  var unit      = document.getElementById('food-unit').value;
  var age       = document.getElementById('food-age').value;
  var activity  = document.getElementById('food-activity').value;
  var condition = document.getElementById('food-condition').value;
  var foodType  = document.getElementById('food-type').value;

  if (!weightVal || weightVal <= 0) { pzAlert('Please enter your pet\'s weight.'); return; }

  var weightKg = unit === 'lbs' ? weightVal * 0.453592 : weightVal;

  // RER = 70 * (weight_kg ^ 0.75)
  var rer = 70 * Math.pow(weightKg, 0.75);

  // MER multipliers
  var ageM     = { puppy: 2.0, adult: 1.0, senior: 0.8 };
  var actM     = { low: 1.2, moderate: 1.4, high: 1.6, working: 1.8 };
  var condM    = { underweight: 1.2, ideal: 1.0, overweight: 0.8 };
  var animalM  = { dog: 1.0, cat: 1.1, rabbit: 0.9, bird: 1.5, hamster: 2.0 };

  var mer = rer * ageM[age] * actM[activity] * condM[condition] * animalM[animal];

  // Calories per gram by food type
  var calPerG = { dry: 3.5, wet: 1.0, raw: 1.5, mixed: 2.5 };
  var dailyG  = Math.round(mer / calPerG[foodType]);
  var cups    = (dailyG / 100).toFixed(1);

  var meals = age === 'puppy' ? 3 : 2;
  var perMeal = Math.round(dailyG / meals);

  document.getElementById('food-daily-grams').textContent = dailyG + 'g';
  document.getElementById('food-daily-cups').textContent  = cups + ' cups approx.';
  document.getElementById('food-daily-cal').textContent   = Math.round(mer) + ' kcal';
  document.getElementById('food-meals').textContent       = meals + 'x per day';
  document.getElementById('food-per-meal').textContent    = perMeal + 'g';

  var tips = {
    dog:    '🐶 Always provide fresh water. Divide meals into ' + meals + ' equal portions.',
    cat:    '🐱 Cats are obligate carnivores — ensure protein is the first ingredient.',
    rabbit: '🐰 Supplement with unlimited hay (timothy) and fresh leafy greens daily.',
    bird:   '🐦 Rotate seeds, pellets, and fresh fruits for a balanced avian diet.',
    hamster:'🐹 Offer food in a heavy ceramic bowl to prevent tipping.'
  };
  document.getElementById('food-tip').innerHTML = '<strong>💡 Tip:</strong> ' + (tips[animal] || '');

  pzShowResult('food-result');
}

/* ── AGE CALCULATOR ── */
var ageBreedWrap = document.getElementById ? document.getElementById('age-breed-wrap') : null;
function pzAgeUpdateBreeds() {
  var wrap = document.getElementById('age-breed-wrap');
  if (!wrap) return;
  wrap.style.display = document.getElementById('age-animal').value === 'dog' ? '' : 'none';
}

function pzAgeCalc() {
  var animal = document.getElementById('age-animal').value;
  var years  = parseInt(document.getElementById('age-years').value) || 0;
  var months = parseInt(document.getElementById('age-months').value) || 0;
  var totalM = years * 12 + months;

  if (totalM <= 0) { pzAlert('Please enter your pet\'s age.'); return; }

  var humanYears, stage, expectancy, tip;

  if (animal === 'dog') {
    var size = document.getElementById('age-breed').value;
    var tables = {
      small:  [1,13,17,20,24,28,32,36,40,44,48,52,56,60,64],
      medium: [1,13,17,20,24,26,30,33,36,39,42,45,48,51,54],
      large:  [1,13,17,20,24,26,29,32,34,36,38,40,42,44,46],
      giant:  [1,13,17,20,22,24,26,28,30,32,34,36,38,40,42]
    };
    var t = tables[size];
    humanYears = years < t.length ? t[years] : t[t.length-1] + (years - t.length + 1) * 4;
    expectancy = { small: '12–16 years', medium: '10–13 years', large: '8–12 years', giant: '7–10 years' }[size];
    stage = years <= 1 ? '🍼 Puppy' : years <= 3 ? '🧒 Young Adult' : years <= 7 ? '🧑 Adult' : '👴 Senior';
    tip = '🐶 Regular vet check-ups are recommended every 6 months for seniors.';
  } else if (animal === 'cat') {
    if (totalM <= 6)       humanYears = totalM * 2;
    else if (totalM <= 12) humanYears = 10 + (totalM - 6);
    else if (years <= 2)   humanYears = 16 + (years - 1) * 5;
    else                   humanYears = 21 + (years - 2) * 4;
    expectancy = '12–18 years';
    stage = years <= 1 ? '🍼 Kitten' : years <= 3 ? '🧒 Junior' : years <= 6 ? '🧑 Prime' : years <= 10 ? '🧓 Mature' : '👴 Senior';
    tip = '🐱 Indoor cats live significantly longer — on average 12–18 vs 5–7 years for outdoor cats.';
  } else if (animal === 'rabbit') {
    humanYears = Math.round(years * 9);
    expectancy = '8–12 years';
    stage = years <= 1 ? '🐣 Young' : years <= 5 ? '🐰 Adult' : '👴 Senior';
    tip = '🐰 Rabbits are social animals — ensure they have space to hop and a companion.';
  } else if (animal === 'bird') {
    humanYears = Math.round(years * 4.5);
    expectancy = '15–60 years (species-dependent)';
    stage = years <= 2 ? '🐣 Young' : years <= 15 ? '🐦 Adult' : '👴 Elder';
    tip = '🐦 Parrots can live 50+ years — they\'re a lifetime commitment!';
  } else {
    humanYears = Math.round(years * 25);
    expectancy = '2–3 years';
    stage = years < 1 ? '🐣 Young' : '👴 Senior';
    tip = '🐹 Hamsters age very quickly — weekly vet checks are ideal.';
  }

  document.getElementById('age-human-years').textContent = Math.round(humanYears);
  document.getElementById('age-stage').textContent       = stage;
  document.getElementById('age-expectancy').textContent  = expectancy || '—';
  document.getElementById('age-tip').innerHTML           = '<strong>💡 Tip:</strong> ' + (tip || '');
  pzShowResult('age-result');
}

/* ── VACCINE TRACKER ── */
function pzVaccineTracker() {
  var animal    = document.getElementById('vac-animal').value;
  var birthdate = document.getElementById('vac-birthdate').value;
  var lifestyle = document.getElementById('vac-lifestyle').value;

  if (!birthdate) { pzAlert('Please enter your pet\'s date of birth.'); return; }

  var bd        = new Date(birthdate);
  var today     = new Date();
  var ageWeeks  = Math.floor((today - bd) / (7 * 24 * 60 * 60 * 1000));

  function addWeeks(d, w) {
    var nd = new Date(d);
    nd.setDate(nd.getDate() + w * 7);
    return nd.toLocaleDateString('en-US', {month:'short', day:'numeric', year:'numeric'});
  }
  function statusLabel(dueWeeks) {
    var dueDate = new Date(bd);
    dueDate.setDate(dueDate.getDate() + dueWeeks * 7);
    if (dueDate < today) return '<span class="pz-vac-status pz-vac-overdue">⚠️ Overdue</span>';
    var diff = Math.ceil((dueDate - today) / (7 * 24 * 60 * 60 * 1000));
    if (diff <= 4)       return '<span class="pz-vac-status pz-vac-soon">🔔 Due Soon</span>';
    return '<span class="pz-vac-status pz-vac-ok">✅ Upcoming</span>';
  }

  var schedule = [];
  if (animal === 'dog') {
    schedule = [
      { vaccine: 'Distemper / Parvovirus / Hepatitis (DHPP)', weekAge: 8,  type: 'Core',     booster: 'Annual' },
      { vaccine: 'DHPP Booster #1',                           weekAge: 12, type: 'Core',     booster: 'Annual' },
      { vaccine: 'DHPP Booster #2 + Rabies',                  weekAge: 16, type: 'Core',     booster: '3 Years' },
      { vaccine: 'Leptospirosis',                              weekAge: 12, type: 'Non-Core', booster: 'Annual' },
      { vaccine: 'Bordetella (Kennel Cough)',                  weekAge: 16, type: 'Non-Core', booster: 'Annual' },
      { vaccine: 'DHPP Adult Booster',                         weekAge: 52, type: 'Core',     booster: '1–3 Years' },
      { vaccine: 'Rabies Adult Booster',                       weekAge: 56, type: 'Core',     booster: '3 Years' },
    ];
    if (lifestyle === 'outdoor' || lifestyle === 'outdoor-only') {
      schedule.push({ vaccine: 'Canine Influenza', weekAge: 20, type: 'Non-Core', booster: 'Annual' });
      schedule.push({ vaccine: 'Lyme Disease',     weekAge: 24, type: 'Non-Core', booster: 'Annual' });
    }
  } else {
    schedule = [
      { vaccine: 'FVRCP (Feline Distemper)',        weekAge: 8,  type: 'Core',     booster: '1–3 Years' },
      { vaccine: 'FVRCP Booster #1',                weekAge: 12, type: 'Core',     booster: '1–3 Years' },
      { vaccine: 'Rabies + FVRCP Booster #2',       weekAge: 16, type: 'Core',     booster: '3 Years' },
      { vaccine: 'FVRCP Adult Booster',             weekAge: 52, type: 'Core',     booster: '1–3 Years' },
      { vaccine: 'Rabies Adult Booster',            weekAge: 56, type: 'Core',     booster: '3 Years' },
    ];
    if (lifestyle !== 'indoor') {
      schedule.push({ vaccine: 'FeLV (Feline Leukemia)', weekAge: 12, type: 'Non-Core', booster: 'Annual' });
      schedule.push({ vaccine: 'FeLV Booster',           weekAge: 16, type: 'Non-Core', booster: 'Annual' });
    }
  }

  var tbody  = document.getElementById('vaccine-tbody');
  tbody.innerHTML = '';
  schedule.forEach(function(s) {
    var tr = document.createElement('tr');
    tr.innerHTML =
      '<td><strong>' + s.vaccine + '</strong><br><small>Booster: ' + s.booster + '</small></td>' +
      '<td>' + addWeeks(bd, s.weekAge) + '<br><small>' + s.weekAge + ' weeks old</small></td>' +
      '<td><span class="pz-vac-type pz-vac-type--' + s.type.toLowerCase().replace(/[^a-z]/g,'') + '">' + s.type + '</span></td>' +
      '<td>' + statusLabel(s.weekAge) + '</td>';
    tbody.appendChild(tr);
  });

  var overdue = schedule.filter(function(s){ return new Date(bd.getTime() + s.weekAge*7*86400000) < today; }).length;
  document.getElementById('vaccine-summary').innerHTML =
    '<div class="pz-vac-sum">' +
    '<span class="pz-vac-sum-item"><strong>' + schedule.length + '</strong> Total Vaccines</span>' +
    '<span class="pz-vac-sum-item pz-vac-sum--warn"><strong>' + overdue + '</strong> Overdue</span>' +
    '<span class="pz-vac-sum-item"><strong>' + (animal === 'dog' ? 'Dog' : 'Cat') + '</strong> ' + ageWeeks + ' weeks old</span>' +
    '</div>';

  pzShowResult('vaccine-result');
}

/* ── NAME GENERATOR ── */
var pzNames = {
  cute: {
    male:   ['Biscuit','Mochi','Pudding','Waffle','Cookie','Peanut','Caramel','Snuggles','Teddy','Cinnamon','Honey','Brownie','Sprinkles','Cupcake','Noodle','Pumpkin','Butterscotch','Fudge','Marshmallow','Cocoa','Maple','Toffee','Jellybean','Taffy','Bonbon'],
    female: ['Bella','Daisy','Lily','Rosie','Poppy','Coco','Lola','Maple','Sugar','Cherry','Pearl','Angel','Dottie','Peaches','Blossom','Violet','Clover','Ivy','Fern','Hazel','Buttercup','Magnolia','Primrose','Lavender','Jasmine']
  },
  fierce: {
    male:   ['Titan','Rex','Zeus','Thor','Duke','Bear','Diesel','Blaze','Ace','Maverick','Ranger','Hunter','Gunner','Tank','Spike','Axe','Blade','Vulcan','Goliath','Atlas','Ares','Odin','Brutus','Caesar','Samson'],
    female: ['Vixen','Raven','Storm','Athena','Hera','Xena','Freya','Nyx','Zara','Cobra','Viper','Sable','Valkyrie','Tempest','Duchess','Empress','Electra','Fang','Huntress','Shadow']
  },
  funny: {
    male:   ['Bark Twain','Chewbacca','Doge','Woofer','Sir Barks-a-Lot','Paw McCartney','Wigglebutt','Drool McGee','Farticus','Chunky Monkey','Noodle Legs','Mr. Fluffington','Professor Sniff','Bork','Captain Zoomies'],
    female: ['Lady Fluffington','Princess Paws','Madame Whiskers','Duchess Derpface','Countess Woofsalot','Snorty McSnort','Fuzzbutt','Wigglesworth','Lady Droolmore','Princess Floppyears','Boopsnoot','Derpy Paws','Snickerdoodle','Fluffernutter','Wobblebottom']
  },
  elegant: {
    male:   ['Sebastian','Leonardo','Maximilian','Augustus','Cornelius','Percival','Reginald','Benedikt','Cassian','Dorian','Erasmus','Fabian','Galahad','Hadrian','Ignatius','Julian','Kingston','Lorenzo','Montague','Nathaniel'],
    female: ['Arabella','Beatrice','Clementine','Dorothea','Eleonora','Florentina','Genevieve','Henrietta','Isadora','Josephine','Katerina','Leonora','Marguerite','Nicolette','Ophelia','Penelope','Rosalind','Seraphina','Theodora','Vivienne']
  },
  nature: {
    male:   ['River','Forest','Stone','Cedar','Moss','Birch','Aspen','Cliff','Flint','Ridge','Sage','Sorrel','Thorn','Willow','Brook','Canyon','Dale','Glen','Heath','Loch'],
    female: ['Meadow','Aurora','Luna','Willow','Fern','Iris','Jade','Juniper','Marigold','Misty','Pearl','Rain','Sierra','Sky','Sunny','Terra','Wren','Zephyr','Ember','Flora']
  },
  food: {
    male:   ['Nacho','Burrito','Taco','Pickle','Sausage','Meatball','Noodle','Dumpling','Pretzel','Bagel','Wonton','Ramen','Brisket','Biscuit','Chorizo','Falafel','Kebab','Pierogi','Schnitzel','Tempura'],
    female: ['Mochi','Tiramisu','Macaron','Crepe','Sorbet','Latte','Brownie','Truffle','Panini','Brie','Cheddar','Gouda','Mimosa','Sangria','Cannoli','Baklava','Churro','Éclair','Profiterole','Streusel']
  },
  mythical: {
    male:   ['Merlin','Gandalf','Phoenix','Griffin','Orion','Draco','Fenrir','Poseidon','Hermes','Apollo','Achilles','Odysseus','Loki','Baldur','Ragnar','Oberon','Puck','Triton','Kraken','Pegasus'],
    female: ['Artemis','Calypso','Circe','Elara','Freya','Gaia','Hecate','Hestia','Io','Iris','Juno','Medusa','Minerva','Nemesis','Niobe','Pandora','Persephone','Selene','Sibyl','Titania']
  }
};

function pzNameGen() {
  var animal      = document.getElementById('name-animal').value;
  var gender      = document.getElementById('name-gender').value;
  var personality = document.getElementById('name-personality').value;
  var letter      = document.getElementById('name-letter').value.toUpperCase();
  var count       = parseInt(document.getElementById('name-count').value);

  var pool = pzNames[personality] || pzNames.cute;
  var names = [];
  if (gender === 'male')   names = pool.male || [];
  else if (gender === 'female') names = pool.female || [];
  else names = (pool.male || []).concat(pool.female || []);

  if (letter) names = names.filter(function(n){ return n.toUpperCase().startsWith(letter); });

  // Shuffle
  names = names.slice().sort(function(){ return Math.random() - 0.5; });

  // Pad if needed
  while (names.length < count) names = names.concat(names);
  names = names.slice(0, count);

  var grid = document.getElementById('names-grid');
  grid.innerHTML = '';
  names.forEach(function(name) {
    var el = document.createElement('div');
    el.className = 'pz-name-chip';
    el.innerHTML = '<span class="pz-name-text">' + name + '</span>' +
      '<span class="pz-name-copy" onclick="pzCopyName(this)" title="Copy">' +
      '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>' +
      '</span>';
    grid.appendChild(el);
  });

  document.getElementById('names-result-title').textContent = names.length + ' Names Generated ✨';
  pzShowResult('names-result');
}
function pzCopyName(el) {
  var name = el.parentElement.querySelector('.pz-name-text').textContent;
  navigator.clipboard && navigator.clipboard.writeText(name);
  el.textContent = '✓';
  setTimeout(function(){ el.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>'; }, 1500);
}

/* ── EXERCISE CALCULATOR ── */
function pzExUpdateBreed() {
  var f = document.getElementById('ex-breed-field');
  if (f) f.style.display = document.getElementById('ex-animal').value === 'dog' ? '' : 'none';
}
function pzExerciseCalc() {
  var animal = document.getElementById('ex-animal').value;
  var age    = document.getElementById('ex-age').value;
  var health = document.getElementById('ex-health').value;
  var weight = parseFloat(document.getElementById('ex-weight').value) || 10;

  var baseMinutes = { dog: 60, cat: 20, rabbit: 30, bird: 15 }[animal] || 30;

  if (animal === 'dog') {
    var energy = document.getElementById('ex-breed').value;
    baseMinutes = { low: 30, medium: 60, high: 90, 'very-high': 120 }[energy];
  }

  var ageM    = { puppy: 0.7, adult: 1.0, senior: 0.6 }[age] || 1;
  var healthM = { healthy: 1.0, overweight: 1.2, recovering: 0.3, 'senior-health': 0.5 }[health] || 1;
  var finalMins = Math.round(baseMinutes * ageM * healthM);

  var walks   = animal === 'dog' ? (finalMins >= 60 ? '3 walks/day' : '2 walks/day') : 'Free roam';
  var intensity = finalMins >= 90 ? '🔥 High' : finalMins >= 45 ? '⚡ Moderate' : '🌿 Light';
  var play    = Math.round(finalMins * 0.3) + ' min';

  var actMap = {
    dog:    ['🚶 Leash walks','🏃 Off-leash run','🎾 Fetch games','🐕 Dog park play','🧠 Nose work / training'],
    cat:    ['🧸 Wand toy play','📦 Box exploration','🪟 Window watching','🌿 Indoor climbing','🎯 Laser pointer (5 min)'],
    rabbit: ['🌿 Free roam time','🪀 Toss toys','🧩 Digging box','🏠 Tunnel play'],
    bird:   ['🦜 Out-of-cage flight','🎵 Music interaction','🧩 Foraging toys','🤸 Gym perch play'],
  };
  var activities = actMap[animal] || actMap.dog;

  document.getElementById('ex-minutes').textContent   = finalMins + ' min/day';
  document.getElementById('ex-walks').textContent     = walks;
  document.getElementById('ex-intensity').textContent = intensity;
  document.getElementById('ex-play').textContent      = play;

  var actHtml = '<div class="pz-ex-activities"><h4>Recommended Activities</h4><ul>';
  activities.forEach(function(a){ actHtml += '<li>' + a + '</li>'; });
  actHtml += '</ul></div>';
  document.getElementById('ex-activities').innerHTML = actHtml;

  var tips = {
    dog:    '🐶 Break exercise into sessions — morning walk + evening play is ideal.',
    cat:    '🐱 Short 5–10 min play bursts are better for cats than one long session.',
    rabbit: '🐰 Rabbits need at least 3 hours of free roam daily outside their cage.',
    bird:   '🐦 Social interaction IS exercise for birds — talk and play with them daily.'
  };
  document.getElementById('ex-tip').innerHTML = '<strong>💡 Tip:</strong> ' + (tips[animal] || '');
  pzShowResult('exercise-result');
}

/* ── PET QUIZ ── */
var pzQuizQuestions = [
  { q: 'How would you describe your home?', opts: ['Large house with yard 🏡','Apartment / Small space 🏢','Medium home, no yard 🏠','I travel a lot ✈️'], keys: ['space','space','space','travel'] },
  { q: 'How active are you daily?', opts: ['Very active (run/gym daily) 🏃','Moderately active (daily walks) 🚶','Somewhat active (occasional) 🧘','Prefer staying home 🛋️'], keys: ['active','moderate','low','low'] },
  { q: 'How much time can you spend with your pet daily?', opts: ['6+ hours 😍','3–6 hours 😊','1–3 hours 🙂','Less than 1 hour 😅'], keys: ['social','social','moderate','independent'] },
  { q: 'Do you have allergies to pet fur?', opts: ['No allergies 😊','Mild allergies 🤧','Yes, severe allergies 🚫','Not sure 🤔'], keys: ['any','low-shedding','hypoallergenic','any'] },
  { q: 'What\'s your budget for pet care monthly?', opts: ['$200+ 💰','$50–200 💵','Under $50 💸','I\'m flexible 🤷'], keys: ['high','medium','low','any'] },
  { q: 'Do you have children at home?', opts: ['Yes, young children 👶','Yes, older kids 👦','No children 👤','Adult household only 👨'], keys: ['family','family','any','any'] },
  { q: 'How much noise can your home handle?', opts: ['Very quiet — thin walls 🔇','Some noise is fine 🔉','Noise is no problem 🔊','I love loud pets! 📣'], keys: ['quiet','moderate','loud','loud'] },
  { q: 'What experience do you have with pets?', opts: ['First-time pet owner 🆕','Some experience 📚','Very experienced 🎓','Lifelong pet owner 🏅'], keys: ['easy','moderate','advanced','advanced'] },
  { q: 'What do you look for most in a pet?', opts: ['Cuddles & affection ❤️','Playfulness & energy ⚡','Independence & low-maintenance 😎','Intelligence & trainability 🧠'], keys: ['affectionate','playful','independent','trainable'] },
  { q: 'How long can you commit to a pet?', opts: ['Long-term (10+ years) ♾️','Medium (5–10 years) 📅','Flexible 🔄','Short-term (under 5 years) ⏳'], keys: ['long','medium','any','short'] },
];

var pzQuizAnswers = [];
var pzQuizCurrent = 0;

function pzQuizRender() {
  var body = document.getElementById('quiz-body');
  var stepLabel = document.getElementById('quiz-step-label');
  var bar = document.getElementById('quiz-progress-bar');
  if (!body) return;

  var q = pzQuizQuestions[pzQuizCurrent];
  body.innerHTML =
    '<div class="pz-quiz-question" data-aos>' +
    '<h3 class="pz-quiz-q-text">' + q.q + '</h3>' +
    '<div class="pz-quiz-options">' +
    q.opts.map(function(opt, i) {
      return '<button class="pz-quiz-option" onclick="pzQuizAnswer(' + i + ')">' + opt + '</button>';
    }).join('') +
    '</div>' +
    (pzQuizCurrent > 0 ? '<button class="pz-quiz-back" onclick="pzQuizBack()">← Back</button>' : '') +
    '</div>';

  stepLabel.textContent = 'Question ' + (pzQuizCurrent+1) + ' of ' + pzQuizQuestions.length;
  bar.style.width = ((pzQuizCurrent / pzQuizQuestions.length) * 100) + '%';
}

function pzQuizAnswer(i) {
  pzQuizAnswers[pzQuizCurrent] = pzQuizQuestions[pzQuizCurrent].keys[i];
  pzQuizCurrent++;
  if (pzQuizCurrent >= pzQuizQuestions.length) {
    pzQuizShowResult();
  } else {
    pzQuizRender();
  }
}
function pzQuizBack() {
  if (pzQuizCurrent > 0) { pzQuizCurrent--; pzQuizRender(); }
}
function pzQuizReset() {
  pzQuizAnswers = []; pzQuizCurrent = 0;
  document.getElementById('quiz-result').hidden = true;
  document.getElementById('quiz-body').style.display = '';
  document.getElementById('quiz-progress').style.display = '';
  document.getElementById('quiz-step-label').style.display = '';
  pzQuizRender();
}
function pzQuizShowResult() {
  var scores = { dog:0, cat:0, rabbit:0, bird:0, fish:0, hamster:0 };
  var ans = pzQuizAnswers;

  // Score mapping logic
  var spaceVal = ans[0];
  if (spaceVal === 'large house with yard 🏡' || spaceVal === 'space') { scores.dog += 3; scores.cat += 2; scores.rabbit += 1; }
  else { scores.cat += 3; scores.fish += 3; scores.hamster += 2; scores.bird += 2; }

  var actVal = ans[1];
  if (actVal === 'active') { scores.dog += 4; }
  else if (actVal === 'moderate') { scores.dog += 2; scores.cat += 2; scores.rabbit += 1; }
  else { scores.cat += 3; scores.fish += 3; scores.hamster += 2; }

  var timeVal = ans[2];
  if (timeVal === 'social') { scores.dog += 3; scores.cat += 2; scores.bird += 2; }
  else if (timeVal === 'independent') { scores.cat += 3; scores.fish += 3; scores.hamster += 2; }

  if (ans[3] === 'hypoallergenic') { scores.fish += 4; scores.bird += 3; scores.hamster += 2; }
  if (ans[3] === 'low-shedding')   { scores.cat += 2; scores.bird += 2; }

  var budgetVal = ans[4];
  if (budgetVal === 'low') { scores.fish += 3; scores.hamster += 3; }
  else if (budgetVal === 'high') { scores.dog += 2; scores.bird += 2; }

  if (ans[5] === 'family') { scores.dog += 3; scores.cat += 2; }

  var noiseVal = ans[6];
  if (noiseVal === 'quiet') { scores.fish += 3; scores.cat += 2; scores.hamster += 2; }
  else if (noiseVal === 'loud') { scores.dog += 3; scores.bird += 2; }

  var expVal = ans[7];
  if (expVal === 'easy') { scores.cat += 2; scores.fish += 3; }
  else if (expVal === 'advanced') { scores.dog += 2; scores.bird += 2; }

  if (ans[8] === 'affectionate') { scores.dog += 3; scores.cat += 2; }
  if (ans[8] === 'playful')      { scores.dog += 3; scores.rabbit += 2; }
  if (ans[8] === 'independent')  { scores.cat += 3; scores.fish += 2; }
  if (ans[8] === 'trainable')    { scores.dog += 4; scores.bird += 2; }

  if (ans[9] === 'long') { scores.dog += 2; scores.cat += 2; }
  if (ans[9] === 'short') { scores.hamster += 3; scores.fish += 2; }

  var sorted = Object.keys(scores).sort(function(a,b){ return scores[b]-scores[a]; });
  var winner = sorted[0];

  var petData = {
    dog:     { icon:'🐶', name:'Dog',     desc:'Dogs are your perfect match! Your active lifestyle and living space are ideal for a loyal canine companion. Dogs thrive on interaction and will become your best friend.' },
    cat:     { icon:'🐱', name:'Cat',     desc:'Cats suit your lifestyle perfectly! They\'re affectionate yet independent, quiet, and adapt well to your home environment. Low maintenance but full of love.' },
    rabbit:  { icon:'🐰', name:'Rabbit',  desc:'A rabbit is a wonderful match! They\'re gentle, quiet, and surprisingly interactive. Perfect for moderate living spaces with time for play.' },
    bird:    { icon:'🐦', name:'Bird',    desc:'Birds are your ideal companion! Intelligent, entertaining, and incredibly bonding. They match your love for interaction without needing large spaces.' },
    fish:    { icon:'🐠', name:'Fish',    desc:'Fish are perfect for you! Calming, beautiful, and low-maintenance — ideal for busy lifestyles or small spaces. A stunning aquarium will reduce stress too!' },
    hamster: { icon:'🐹', name:'Hamster', desc:'A hamster is your ideal starter pet! Small, adorable, low-cost, and don\'t require much space. Perfect for your lifestyle and schedule.' },
  };

  var p = petData[winner];
  document.getElementById('quiz-pet-icon').textContent   = p.icon;
  document.getElementById('quiz-match-pet').textContent  = p.icon + ' ' + p.name;
  document.getElementById('quiz-match-score').textContent = 'Match Score: ' + Math.min(98, Math.round((scores[winner] / (scores[winner]+5)) * 100)) + '%';
  document.getElementById('quiz-match-desc').textContent  = p.desc;

  // Runner-ups
  var runnerHtml = '<div class="pz-quiz-runners"><h4>Also Consider:</h4>';
  sorted.slice(1,4).forEach(function(pet) {
    runnerHtml += '<span class="pz-quiz-runner">' + petData[pet].icon + ' ' + petData[pet].name + '</span>';
  });
  runnerHtml += '</div>';
  document.getElementById('quiz-runner-ups').innerHTML = runnerHtml;

  document.getElementById('quiz-body').style.display   = 'none';
  document.getElementById('quiz-progress').style.display = 'none';
  document.getElementById('quiz-step-label').style.display = 'none';
  document.getElementById('quiz-progress-bar').style.width = '100%';
  pzShowResult('quiz-result');
}

/* ── UTILS ── */
function pzShowResult(id) {
  var el = document.getElementById(id);
  if (!el) return;
  el.hidden = false;
  el.style.animation = 'none';
  el.offsetHeight; // reflow
  el.style.animation = 'pzResultIn 0.5s ease both';
  setTimeout(function(){ el.scrollIntoView({ behavior:'smooth', block:'nearest' }); }, 100);
}
function pzAlert(msg) {
  var existing = document.querySelector('.pz-alert');
  if (existing) existing.remove();
  var el = document.createElement('div');
  el.className = 'pz-alert';
  el.textContent = '⚠️ ' + msg;
  document.body.appendChild(el);
  setTimeout(function(){ el.remove(); }, 3000);
}

/* Init quiz on load */
document.addEventListener('DOMContentLoaded', function() {
  if (document.getElementById('quiz-body')) pzQuizRender();
  pzAgeUpdateBreeds();
  pzExUpdateBreed();
});
