<?php
if ( ! defined('ABSPATH') ) exit;

function pz_get_tool_categories() {
    return [
        'dog-grooming'   => ['label'=>'Dog Grooming',    'icon'=>'🐕', 'animal'=>'dog'],
        'dog-health'     => ['label'=>'Dog Health',      'icon'=>'🏥', 'animal'=>'dog'],
        'dog-nutrition'  => ['label'=>'Dog Nutrition',   'icon'=>'🍖', 'animal'=>'dog'],
        'dog-training'   => ['label'=>'Dog Training',    'icon'=>'🎾', 'animal'=>'dog'],
        'cat-grooming'   => ['label'=>'Cat Grooming',    'icon'=>'🐱', 'animal'=>'cat'],
        'cat-health'     => ['label'=>'Cat Health',      'icon'=>'💊', 'animal'=>'cat'],
        'cat-nutrition'  => ['label'=>'Cat Nutrition',   'icon'=>'🐟', 'animal'=>'cat'],
        'bird-care'      => ['label'=>'Bird Care',       'icon'=>'🦜', 'animal'=>'bird'],
        'rabbit-care'    => ['label'=>'Rabbit Care',     'icon'=>'🐰', 'animal'=>'rabbit'],
        'fish-aquarium'  => ['label'=>'Fish & Aquarium', 'icon'=>'🐠', 'animal'=>'fish'],
        'reptile-care'   => ['label'=>'Reptile Care',    'icon'=>'🦎', 'animal'=>'reptile'],
        'small-pets'     => ['label'=>'Small Pets',      'icon'=>'🐹', 'animal'=>'small'],
        'general-pet'    => ['label'=>'General Pet Care','icon'=>'🐾', 'animal'=>'all'],
        'pet-behavior'   => ['label'=>'Pet Behavior',    'icon'=>'🧠', 'animal'=>'all'],
        'pet-safety'     => ['label'=>'Pet Safety',      'icon'=>'🛡️', 'animal'=>'all'],
    ];
}

function pz_get_all_tools() {
    return [
        // ═══════════════════════════════════════════
        // DOG GROOMING (20)
        // ═══════════════════════════════════════════
        ['slug'=>'dog-nail-trimming-guide','title'=>'Dog Nail Trimming Guide & Schedule','cat'=>'dog-grooming','animal'=>'dog','type'=>'guide','kw'=>'dog nail trimming guide','icon'=>'✂️'],
        ['slug'=>'dog-bathing-frequency-calculator','title'=>'How Often Should I Bathe My Dog? Calculator','cat'=>'dog-grooming','animal'=>'dog','type'=>'calculator','kw'=>'how often bathe dog','icon'=>'🛁'],
        ['slug'=>'dog-shedding-guide','title'=>'Dog Shedding Guide: Control & Solutions','cat'=>'dog-grooming','animal'=>'dog','type'=>'guide','kw'=>'dog shedding guide','icon'=>'🪮'],
        ['slug'=>'dog-ear-cleaning-guide','title'=>'Dog Ear Cleaning Guide & Schedule','cat'=>'dog-grooming','animal'=>'dog','type'=>'guide','kw'=>'dog ear cleaning guide','icon'=>'👂'],
        ['slug'=>'dog-teeth-brushing-guide','title'=>'Dog Teeth Brushing Guide for Beginners','cat'=>'dog-grooming','animal'=>'dog','type'=>'guide','kw'=>'how to brush dog teeth','icon'=>'🦷'],
        ['slug'=>'dog-grooming-schedule-calculator','title'=>'Dog Grooming Schedule Calculator by Breed','cat'=>'dog-grooming','animal'=>'dog','type'=>'calculator','kw'=>'dog grooming schedule','icon'=>'📅'],
        ['slug'=>'puppy-first-grooming-guide','title'=>'Puppy First Grooming: Complete Guide','cat'=>'dog-grooming','animal'=>'dog','type'=>'guide','kw'=>'puppy first grooming guide','icon'=>'🐶'],
        ['slug'=>'dog-coat-type-guide','title'=>'Dog Coat Types: Care Guide for Every Breed','cat'=>'dog-grooming','animal'=>'dog','type'=>'guide','kw'=>'dog coat types care guide','icon'=>'🐩'],
        ['slug'=>'dog-eye-cleaning-guide','title'=>'Dog Eye Discharge Cleaning Guide','cat'=>'dog-grooming','animal'=>'dog','type'=>'guide','kw'=>'clean dog eye discharge','icon'=>'👁️'],
        ['slug'=>'dog-paw-care-guide','title'=>'Dog Paw Care & Moisturizing Guide','cat'=>'dog-grooming','animal'=>'dog','type'=>'guide','kw'=>'dog paw care guide','icon'=>'🐾'],
        ['slug'=>'dog-anal-gland-guide','title'=>'Dog Anal Gland Expression Guide','cat'=>'dog-grooming','animal'=>'dog','type'=>'guide','kw'=>'dog anal gland expression guide','icon'=>'🔬'],
        ['slug'=>'dog-haircut-styles-guide','title'=>'Dog Haircut Styles by Breed Guide','cat'=>'dog-grooming','animal'=>'dog','type'=>'guide','kw'=>'dog haircut styles guide','icon'=>'✂️'],
        ['slug'=>'long-haired-dog-grooming-guide','title'=>'Long-Haired Dog Grooming: Step by Step','cat'=>'dog-grooming','animal'=>'dog','type'=>'guide','kw'=>'long haired dog grooming','icon'=>'🪮'],
        ['slug'=>'dog-deshedding-guide','title'=>'Dog Deshedding Tools & Techniques Guide','cat'=>'dog-grooming','animal'=>'dog','type'=>'guide','kw'=>'dog deshedding guide','icon'=>'🐕'],
        ['slug'=>'dog-grooming-tools-guide','title'=>'Dog Grooming Tools: Complete Buying Guide','cat'=>'dog-grooming','animal'=>'dog','type'=>'guide','kw'=>'dog grooming tools guide','icon'=>'🛒'],
        ['slug'=>'dog-winter-coat-care','title'=>'Dog Winter Coat Care Guide','cat'=>'dog-grooming','animal'=>'dog','type'=>'guide','kw'=>'dog winter coat care','icon'=>'❄️'],
        ['slug'=>'dog-summer-grooming-guide','title'=>'Dog Summer Grooming & Cooling Guide','cat'=>'dog-grooming','animal'=>'dog','type'=>'guide','kw'=>'dog summer grooming tips','icon'=>'☀️'],
        ['slug'=>'how-to-remove-dog-mats','title'=>'How to Remove Dog Mats & Tangles Safely','cat'=>'dog-grooming','animal'=>'dog','type'=>'guide','kw'=>'how to remove dog mats','icon'=>'✂️'],
        ['slug'=>'dog-tail-grooming-guide','title'=>'Dog Tail Grooming & Care Guide','cat'=>'dog-grooming','animal'=>'dog','type'=>'guide','kw'=>'dog tail grooming','icon'=>'🐕'],
        ['slug'=>'professional-vs-home-dog-grooming','title'=>'Professional vs Home Dog Grooming: Which Is Better?','cat'=>'dog-grooming','animal'=>'dog','type'=>'guide','kw'=>'professional vs home dog grooming','icon'=>'⚖️'],

        // ═══════════════════════════════════════════
        // DOG HEALTH (25)
        // ═══════════════════════════════════════════
        ['slug'=>'dog-fever-checker','title'=>'Dog Fever Checker: Symptoms & What To Do','cat'=>'dog-health','animal'=>'dog','type'=>'checker','kw'=>'dog fever symptoms checker','icon'=>'🌡️'],
        ['slug'=>'dog-weight-calculator','title'=>'Dog Ideal Weight Calculator by Breed','cat'=>'dog-health','animal'=>'dog','type'=>'calculator','kw'=>'dog ideal weight calculator','icon'=>'⚖️'],
        ['slug'=>'dog-bmi-calculator','title'=>'Dog Body Condition Score (BCS) Calculator','cat'=>'dog-health','animal'=>'dog','type'=>'calculator','kw'=>'dog body condition score calculator','icon'=>'📊'],
        ['slug'=>'dog-lifespan-calculator','title'=>'Dog Lifespan Calculator by Breed & Size','cat'=>'dog-health','animal'=>'dog','type'=>'calculator','kw'=>'dog lifespan calculator','icon'=>'📅'],
        ['slug'=>'dog-parasite-prevention-guide','title'=>'Dog Parasite Prevention: Flea, Tick & Worm Guide','cat'=>'dog-health','animal'=>'dog','type'=>'guide','kw'=>'dog parasite prevention guide','icon'=>'🦟'],
        ['slug'=>'dog-deworming-schedule','title'=>'Dog Deworming Schedule Calculator','cat'=>'dog-health','animal'=>'dog','type'=>'calculator','kw'=>'dog deworming schedule','icon'=>'💊'],
        ['slug'=>'puppy-health-checklist','title'=>'Puppy Health Checklist: First Year Guide','cat'=>'dog-health','animal'=>'dog','type'=>'guide','kw'=>'puppy health checklist','icon'=>'✅'],
        ['slug'=>'dog-spay-neuter-guide','title'=>'Dog Spay & Neuter: Age, Benefits & Recovery','cat'=>'dog-health','animal'=>'dog','type'=>'guide','kw'=>'when to spay neuter dog','icon'=>'🏥'],
        ['slug'=>'dog-allergy-symptoms-checker','title'=>'Dog Allergy Symptoms Checker & Relief Guide','cat'=>'dog-health','animal'=>'dog','type'=>'checker','kw'=>'dog allergy symptoms checker','icon'=>'🤧'],
        ['slug'=>'dog-joint-health-guide','title'=>'Dog Joint Health & Arthritis Prevention Guide','cat'=>'dog-health','animal'=>'dog','type'=>'guide','kw'=>'dog joint health guide','icon'=>'🦴'],
        ['slug'=>'senior-dog-health-guide','title'=>'Senior Dog Health Guide: 7+ Years Care','cat'=>'dog-health','animal'=>'dog','type'=>'guide','kw'=>'senior dog health guide','icon'=>'👴'],
        ['slug'=>'dog-heat-stroke-guide','title'=>'Dog Heat Stroke: Signs, Prevention & First Aid','cat'=>'dog-health','animal'=>'dog','type'=>'guide','kw'=>'dog heat stroke signs prevention','icon'=>'🌡️'],
        ['slug'=>'dog-pregnancy-calculator','title'=>'Dog Pregnancy Calculator & Whelping Guide','cat'=>'dog-health','animal'=>'dog','type'=>'calculator','kw'=>'dog pregnancy calculator','icon'=>'🤰'],
        ['slug'=>'dog-heart-health-guide','title'=>'Dog Heart Health: Signs & Prevention Guide','cat'=>'dog-health','animal'=>'dog','type'=>'guide','kw'=>'dog heart health guide','icon'=>'❤️'],
        ['slug'=>'dog-skin-conditions-guide','title'=>'Common Dog Skin Conditions: Guide & Treatment','cat'=>'dog-health','animal'=>'dog','type'=>'guide','kw'=>'dog skin conditions guide','icon'=>'🔬'],
        ['slug'=>'dog-eye-problems-guide','title'=>'Dog Eye Problems: Symptoms & Treatment Guide','cat'=>'dog-health','animal'=>'dog','type'=>'guide','kw'=>'dog eye problems guide','icon'=>'👁️'],
        ['slug'=>'dog-ear-infection-guide','title'=>'Dog Ear Infection: Symptoms, Causes & Treatment','cat'=>'dog-health','animal'=>'dog','type'=>'guide','kw'=>'dog ear infection guide','icon'=>'👂'],
        ['slug'=>'dog-diabetes-guide','title'=>'Dog Diabetes: Signs, Management & Diet Guide','cat'=>'dog-health','animal'=>'dog','type'=>'guide','kw'=>'dog diabetes guide','icon'=>'💉'],
        ['slug'=>'dog-cancer-signs-guide','title'=>'Dog Cancer Early Warning Signs Guide','cat'=>'dog-health','animal'=>'dog','type'=>'guide','kw'=>'dog cancer early warning signs','icon'=>'🔬'],
        ['slug'=>'dog-anxiety-guide','title'=>'Dog Anxiety: Types, Triggers & Solutions Guide','cat'=>'dog-health','animal'=>'dog','type'=>'guide','kw'=>'dog anxiety guide','icon'=>'😰'],
        ['slug'=>'dog-kennel-cough-guide','title'=>'Kennel Cough in Dogs: Symptoms & Treatment','cat'=>'dog-health','animal'=>'dog','type'=>'guide','kw'=>'kennel cough in dogs','icon'=>'🤧'],
        ['slug'=>'dog-hypothyroidism-guide','title'=>'Dog Hypothyroidism: Symptoms & Management','cat'=>'dog-health','animal'=>'dog','type'=>'guide','kw'=>'dog hypothyroidism guide','icon'=>'🏥'],
        ['slug'=>'dog-first-aid-guide','title'=>'Dog First Aid Guide: Emergency Situations','cat'=>'dog-health','animal'=>'dog','type'=>'guide','kw'=>'dog first aid guide','icon'=>'🚑'],
        ['slug'=>'dog-vet-visit-frequency','title'=>'How Often Should Dogs Visit the Vet? Calculator','cat'=>'dog-health','animal'=>'dog','type'=>'calculator','kw'=>'how often dog vet visit','icon'=>'📅'],
        ['slug'=>'dog-hip-dysplasia-guide','title'=>'Dog Hip Dysplasia: Signs, Breeds & Management','cat'=>'dog-health','animal'=>'dog','type'=>'guide','kw'=>'dog hip dysplasia guide','icon'=>'🦴'],

        // ═══════════════════════════════════════════
        // DOG NUTRITION (20)
        // ═══════════════════════════════════════════
        ['slug'=>'dog-calorie-calculator','title'=>'Dog Daily Calorie Calculator','cat'=>'dog-nutrition','animal'=>'dog','type'=>'calculator','kw'=>'dog daily calorie calculator','icon'=>'🔢'],
        ['slug'=>'puppy-feeding-guide','title'=>'Puppy Feeding Guide: How Much & How Often','cat'=>'dog-nutrition','animal'=>'dog','type'=>'guide','kw'=>'puppy feeding guide','icon'=>'🍼'],
        ['slug'=>'dog-raw-diet-guide','title'=>'Raw Diet for Dogs: Complete Beginner Guide','cat'=>'dog-nutrition','animal'=>'dog','type'=>'guide','kw'=>'raw diet for dogs guide','icon'=>'🥩'],
        ['slug'=>'dog-homemade-food-guide','title'=>'Homemade Dog Food Guide: Recipes & Nutrition','cat'=>'dog-nutrition','animal'=>'dog','type'=>'guide','kw'=>'homemade dog food guide','icon'=>'👨‍🍳'],
        ['slug'=>'best-dog-food-guide','title'=>'How to Choose the Best Dog Food: Complete Guide','cat'=>'dog-nutrition','animal'=>'dog','type'=>'guide','kw'=>'how to choose best dog food','icon'=>'🛒'],
        ['slug'=>'dog-weight-loss-plan','title'=>'Dog Weight Loss Plan Calculator','cat'=>'dog-nutrition','animal'=>'dog','type'=>'calculator','kw'=>'dog weight loss plan','icon'=>'📉'],
        ['slug'=>'dog-toxic-foods-guide','title'=>'Foods Toxic to Dogs: Complete Safety List','cat'=>'dog-nutrition','animal'=>'dog','type'=>'guide','kw'=>'foods toxic to dogs list','icon'=>'☠️'],
        ['slug'=>'dog-grain-free-diet-guide','title'=>'Grain-Free Dog Food: Pros, Cons & Safety','cat'=>'dog-nutrition','animal'=>'dog','type'=>'guide','kw'=>'grain free dog food guide','icon'=>'🌾'],
        ['slug'=>'dog-protein-requirements','title'=>'Dog Protein Requirements Calculator & Guide','cat'=>'dog-nutrition','animal'=>'dog','type'=>'calculator','kw'=>'dog protein requirements','icon'=>'💪'],
        ['slug'=>'senior-dog-diet-guide','title'=>'Senior Dog Diet: Best Foods for Aging Dogs','cat'=>'dog-nutrition','animal'=>'dog','type'=>'guide','kw'=>'senior dog diet guide','icon'=>'👴'],
        ['slug'=>'dog-food-allergies-guide','title'=>'Dog Food Allergies: Signs & Elimination Diet','cat'=>'dog-nutrition','animal'=>'dog','type'=>'guide','kw'=>'dog food allergies guide','icon'=>'🤧'],
        ['slug'=>'dog-supplements-guide','title'=>'Dog Supplements Guide: What Actually Works','cat'=>'dog-nutrition','animal'=>'dog','type'=>'guide','kw'=>'dog supplements guide','icon'=>'💊'],
        ['slug'=>'dog-hydration-calculator','title'=>'Dog Water Intake Calculator','cat'=>'dog-nutrition','animal'=>'dog','type'=>'calculator','kw'=>'how much water should a dog drink','icon'=>'💧'],
        ['slug'=>'pregnant-dog-nutrition-guide','title'=>'Pregnant Dog Nutrition & Feeding Guide','cat'=>'dog-nutrition','animal'=>'dog','type'=>'guide','kw'=>'pregnant dog nutrition guide','icon'=>'🤰'],
        ['slug'=>'dog-treat-calculator','title'=>'Dog Daily Treat Limit Calculator','cat'=>'dog-nutrition','animal'=>'dog','type'=>'calculator','kw'=>'how many treats can I give my dog','icon'=>'🦴'],
        ['slug'=>'working-dog-nutrition','title'=>'Working Dog Nutrition & High-Energy Diet Guide','cat'=>'dog-nutrition','animal'=>'dog','type'=>'guide','kw'=>'working dog nutrition guide','icon'=>'🏋️'],
        ['slug'=>'dog-digestive-health-diet','title'=>'Dog Digestive Health Diet & Foods Guide','cat'=>'dog-nutrition','animal'=>'dog','type'=>'guide','kw'=>'dog digestive health diet','icon'=>'🫀'],
        ['slug'=>'dog-kidney-disease-diet','title'=>'Dog Kidney Disease Diet Guide','cat'=>'dog-nutrition','animal'=>'dog','type'=>'guide','kw'=>'dog kidney disease diet','icon'=>'🏥'],
        ['slug'=>'dog-joint-supplement-guide','title'=>'Best Joint Supplements for Dogs Guide','cat'=>'dog-nutrition','animal'=>'dog','type'=>'guide','kw'=>'best joint supplements for dogs','icon'=>'💊'],
        ['slug'=>'puppy-to-adult-food-transition','title'=>'When to Switch Puppy to Adult Dog Food','cat'=>'dog-nutrition','animal'=>'dog','type'=>'guide','kw'=>'when to switch puppy to adult food','icon'=>'🔄'],

        // ═══════════════════════════════════════════
        // DOG TRAINING (15)
        // ═══════════════════════════════════════════
        ['slug'=>'puppy-training-schedule','title'=>'Puppy Training Schedule by Age','cat'=>'dog-training','animal'=>'dog','type'=>'guide','kw'=>'puppy training schedule by age','icon'=>'📋'],
        ['slug'=>'dog-potty-training-guide','title'=>'Dog Potty Training Guide: Step by Step','cat'=>'dog-training','animal'=>'dog','type'=>'guide','kw'=>'dog potty training guide','icon'=>'🚽'],
        ['slug'=>'dog-crate-training-guide','title'=>'Dog Crate Training Guide for Beginners','cat'=>'dog-training','animal'=>'dog','type'=>'guide','kw'=>'dog crate training guide','icon'=>'🏠'],
        ['slug'=>'dog-leash-training-guide','title'=>'Dog Leash Training Guide: Stop Pulling','cat'=>'dog-training','animal'=>'dog','type'=>'guide','kw'=>'dog leash training guide','icon'=>'🐕'],
        ['slug'=>'dog-socialization-guide','title'=>'Dog Socialization Guide: Puppies & Adults','cat'=>'dog-training','animal'=>'dog','type'=>'guide','kw'=>'dog socialization guide','icon'=>'🤝'],
        ['slug'=>'dog-separation-anxiety-training','title'=>'Dog Separation Anxiety Training Guide','cat'=>'dog-training','animal'=>'dog','type'=>'guide','kw'=>'dog separation anxiety training','icon'=>'😟'],
        ['slug'=>'dog-bark-training-guide','title'=>'How to Stop Dog Barking: Training Guide','cat'=>'dog-training','animal'=>'dog','type'=>'guide','kw'=>'how to stop dog barking','icon'=>'🔇'],
        ['slug'=>'dog-bite-prevention-guide','title'=>'Dog Bite Prevention Training Guide','cat'=>'dog-training','animal'=>'dog','type'=>'guide','kw'=>'dog bite prevention training','icon'=>'🛡️'],
        ['slug'=>'dog-basic-commands-guide','title'=>'10 Basic Dog Commands Every Dog Should Know','cat'=>'dog-training','animal'=>'dog','type'=>'guide','kw'=>'basic dog commands guide','icon'=>'✋'],
        ['slug'=>'clicker-training-dogs-guide','title'=>'Clicker Training for Dogs: Complete Guide','cat'=>'dog-training','animal'=>'dog','type'=>'guide','kw'=>'clicker training dogs guide','icon'=>'🎯'],
        ['slug'=>'dog-aggression-training-guide','title'=>'Dog Aggression Training: Causes & Solutions','cat'=>'dog-training','animal'=>'dog','type'=>'guide','kw'=>'dog aggression training guide','icon'=>'⚠️'],
        ['slug'=>'dog-trick-training-guide','title'=>'Fun Dog Tricks Training Guide for Beginners','cat'=>'dog-training','animal'=>'dog','type'=>'guide','kw'=>'dog tricks training guide','icon'=>'🎪'],
        ['slug'=>'rescue-dog-training-guide','title'=>'Rescue Dog Training: First 30 Days Guide','cat'=>'dog-training','animal'=>'dog','type'=>'guide','kw'=>'rescue dog training guide','icon'=>'🏠'],
        ['slug'=>'dog-obedience-training-schedule','title'=>'Dog Obedience Training Schedule','cat'=>'dog-training','animal'=>'dog','type'=>'guide','kw'=>'dog obedience training schedule','icon'=>'📅'],
        ['slug'=>'dog-sleep-training-guide','title'=>'Dog Sleep Training: Where Should Dogs Sleep?','cat'=>'dog-training','animal'=>'dog','type'=>'guide','kw'=>'dog sleep training guide','icon'=>'😴'],

        // ═══════════════════════════════════════════
        // CAT GROOMING (15)
        // ═══════════════════════════════════════════
        ['slug'=>'cat-nail-trimming-guide','title'=>'Cat Nail Trimming Guide: How & How Often','cat'=>'cat-grooming','animal'=>'cat','type'=>'guide','kw'=>'cat nail trimming guide','icon'=>'✂️'],
        ['slug'=>'how-often-brush-cat','title'=>'How Often Should You Brush Your Cat? Calculator','cat'=>'cat-grooming','animal'=>'cat','type'=>'calculator','kw'=>'how often brush cat','icon'=>'🪮'],
        ['slug'=>'cat-bathing-guide','title'=>'How to Bathe a Cat: Step-by-Step Guide','cat'=>'cat-grooming','animal'=>'cat','type'=>'guide','kw'=>'how to bathe a cat','icon'=>'🛁'],
        ['slug'=>'cat-shedding-guide','title'=>'Cat Shedding: Control Guide & Best Tools','cat'=>'cat-grooming','animal'=>'cat','type'=>'guide','kw'=>'cat shedding control guide','icon'=>'🐱'],
        ['slug'=>'long-haired-cat-grooming','title'=>'Long-Haired Cat Grooming: Complete Guide','cat'=>'cat-grooming','animal'=>'cat','type'=>'guide','kw'=>'long haired cat grooming guide','icon'=>'🐈'],
        ['slug'=>'cat-hairball-prevention-guide','title'=>'Cat Hairball Prevention: Diet & Grooming Guide','cat'=>'cat-grooming','animal'=>'cat','type'=>'guide','kw'=>'cat hairball prevention guide','icon'=>'🍃'],
        ['slug'=>'cat-dental-care-guide','title'=>'Cat Dental Care Guide: Teeth Brushing & Health','cat'=>'cat-grooming','animal'=>'cat','type'=>'guide','kw'=>'cat dental care guide','icon'=>'🦷'],
        ['slug'=>'cat-ear-cleaning-guide','title'=>'Cat Ear Cleaning Guide','cat'=>'cat-grooming','animal'=>'cat','type'=>'guide','kw'=>'cat ear cleaning guide','icon'=>'👂'],
        ['slug'=>'cat-eye-cleaning-guide','title'=>'Cat Eye Discharge Cleaning Guide','cat'=>'cat-grooming','animal'=>'cat','type'=>'guide','kw'=>'clean cat eye discharge','icon'=>'👁️'],
        ['slug'=>'indoor-vs-outdoor-cat-grooming','title'=>'Indoor vs Outdoor Cat Grooming Differences','cat'=>'cat-grooming','animal'=>'cat','type'=>'guide','kw'=>'indoor outdoor cat grooming differences','icon'=>'🏠'],
        ['slug'=>'cat-grooming-tools-guide','title'=>'Best Cat Grooming Tools Guide','cat'=>'cat-grooming','animal'=>'cat','type'=>'guide','kw'=>'best cat grooming tools','icon'=>'🛒'],
        ['slug'=>'cat-mats-removal-guide','title'=>'How to Remove Cat Mats Safely','cat'=>'cat-grooming','animal'=>'cat','type'=>'guide','kw'=>'how to remove cat mats','icon'=>'✂️'],
        ['slug'=>'senior-cat-grooming-guide','title'=>'Senior Cat Grooming Guide: 10+ Years','cat'=>'cat-grooming','animal'=>'cat','type'=>'guide','kw'=>'senior cat grooming guide','icon'=>'👴'],
        ['slug'=>'kitten-first-grooming-guide','title'=>'Kitten First Grooming: Starter Guide','cat'=>'cat-grooming','animal'=>'cat','type'=>'guide','kw'=>'kitten grooming guide','icon'=>'🐱'],
        ['slug'=>'cat-paw-care-guide','title'=>'Cat Paw Care & Health Guide','cat'=>'cat-grooming','animal'=>'cat','type'=>'guide','kw'=>'cat paw care guide','icon'=>'🐾'],

        // ═══════════════════════════════════════════
        // CAT HEALTH (20)
        // ═══════════════════════════════════════════
        ['slug'=>'cat-fever-checker','title'=>'Cat Fever Symptoms Checker & Guide','cat'=>'cat-health','animal'=>'cat','type'=>'checker','kw'=>'cat fever symptoms checker','icon'=>'🌡️'],
        ['slug'=>'cat-weight-calculator','title'=>'Cat Ideal Weight Calculator by Breed','cat'=>'cat-health','animal'=>'cat','type'=>'calculator','kw'=>'cat ideal weight calculator','icon'=>'⚖️'],
        ['slug'=>'cat-lifespan-calculator','title'=>'Cat Lifespan Calculator by Breed','cat'=>'cat-health','animal'=>'cat','type'=>'calculator','kw'=>'cat lifespan calculator','icon'=>'📅'],
        ['slug'=>'cat-vaccination-schedule','title'=>'Cat Vaccination Schedule: Complete Guide','cat'=>'cat-health','animal'=>'cat','type'=>'guide','kw'=>'cat vaccination schedule','icon'=>'💉'],
        ['slug'=>'cat-deworming-schedule','title'=>'Cat Deworming Schedule Calculator','cat'=>'cat-health','animal'=>'cat','type'=>'calculator','kw'=>'cat deworming schedule','icon'=>'💊'],
        ['slug'=>'cat-spay-neuter-guide','title'=>'Cat Spay & Neuter Guide: When & Benefits','cat'=>'cat-health','animal'=>'cat','type'=>'guide','kw'=>'when to spay neuter cat','icon'=>'🏥'],
        ['slug'=>'cat-uti-symptoms-guide','title'=>'Cat UTI: Symptoms, Causes & Treatment Guide','cat'=>'cat-health','animal'=>'cat','type'=>'guide','kw'=>'cat uti symptoms guide','icon'=>'🔬'],
        ['slug'=>'cat-kidney-disease-guide','title'=>'Cat Kidney Disease: Early Signs & Management','cat'=>'cat-health','animal'=>'cat','type'=>'guide','kw'=>'cat kidney disease guide','icon'=>'🏥'],
        ['slug'=>'cat-diabetes-guide','title'=>'Cat Diabetes: Symptoms, Diet & Management','cat'=>'cat-health','animal'=>'cat','type'=>'guide','kw'=>'cat diabetes guide','icon'=>'💉'],
        ['slug'=>'cat-hyperthyroidism-guide','title'=>'Cat Hyperthyroidism: Symptoms & Treatment','cat'=>'cat-health','animal'=>'cat','type'=>'guide','kw'=>'cat hyperthyroidism guide','icon'=>'🏥'],
        ['slug'=>'cat-flea-treatment-guide','title'=>'Cat Flea Treatment & Prevention Guide','cat'=>'cat-health','animal'=>'cat','type'=>'guide','kw'=>'cat flea treatment guide','icon'=>'🦟'],
        ['slug'=>'cat-vomiting-guide','title'=>'Why Is My Cat Vomiting? Causes & When to Worry','cat'=>'cat-health','animal'=>'cat','type'=>'checker','kw'=>'cat vomiting causes guide','icon'=>'🤢'],
        ['slug'=>'cat-not-eating-guide','title'=>'Cat Not Eating: Causes & Solutions Guide','cat'=>'cat-health','animal'=>'cat','type'=>'checker','kw'=>'cat not eating causes guide','icon'=>'🍽️'],
        ['slug'=>'cat-stress-signs-guide','title'=>'Signs of Stress in Cats & How to Help','cat'=>'cat-health','animal'=>'cat','type'=>'guide','kw'=>'signs of stress in cats','icon'=>'😰'],
        ['slug'=>'cat-respiratory-infection-guide','title'=>'Cat Upper Respiratory Infection Guide','cat'=>'cat-health','animal'=>'cat','type'=>'guide','kw'=>'cat respiratory infection guide','icon'=>'🤧'],
        ['slug'=>'cat-arthritis-guide','title'=>'Cat Arthritis: Signs, Management & Pain Relief','cat'=>'cat-health','animal'=>'cat','type'=>'guide','kw'=>'cat arthritis guide','icon'=>'🦴'],
        ['slug'=>'senior-cat-health-guide','title'=>'Senior Cat Health Guide: 10+ Year Care','cat'=>'cat-health','animal'=>'cat','type'=>'guide','kw'=>'senior cat health guide','icon'=>'👴'],
        ['slug'=>'cat-indoor-enrichment-guide','title'=>'Indoor Cat Enrichment & Mental Health Guide','cat'=>'cat-health','animal'=>'cat','type'=>'guide','kw'=>'indoor cat enrichment guide','icon'=>'🏠'],
        ['slug'=>'cat-first-aid-guide','title'=>'Cat First Aid Guide: Emergency Situations','cat'=>'cat-health','animal'=>'cat','type'=>'guide','kw'=>'cat first aid guide','icon'=>'🚑'],
        ['slug'=>'cat-vet-visit-frequency','title'=>'How Often Should Cats Visit the Vet?','cat'=>'cat-health','animal'=>'cat','type'=>'calculator','kw'=>'how often cat vet visit','icon'=>'📅'],

        // ═══════════════════════════════════════════
        // CAT NUTRITION (15)
        // ═══════════════════════════════════════════
        ['slug'=>'cat-calorie-calculator','title'=>'Cat Daily Calorie Calculator','cat'=>'cat-nutrition','animal'=>'cat','type'=>'calculator','kw'=>'cat daily calorie calculator','icon'=>'🔢'],
        ['slug'=>'kitten-feeding-guide','title'=>'Kitten Feeding Guide: How Much & How Often','cat'=>'cat-nutrition','animal'=>'cat','type'=>'guide','kw'=>'kitten feeding guide','icon'=>'🍼'],
        ['slug'=>'wet-vs-dry-cat-food-guide','title'=>'Wet vs Dry Cat Food: Which Is Better?','cat'=>'cat-nutrition','animal'=>'cat','type'=>'guide','kw'=>'wet vs dry cat food guide','icon'=>'🥫'],
        ['slug'=>'cat-toxic-foods-guide','title'=>'Foods Toxic to Cats: Complete Safety List','cat'=>'cat-nutrition','animal'=>'cat','type'=>'guide','kw'=>'foods toxic to cats list','icon'=>'☠️'],
        ['slug'=>'cat-raw-diet-guide','title'=>'Raw Diet for Cats: Benefits, Risks & Guide','cat'=>'cat-nutrition','animal'=>'cat','type'=>'guide','kw'=>'raw diet for cats guide','icon'=>'🥩'],
        ['slug'=>'cat-weight-loss-plan','title'=>'Cat Weight Loss Plan Calculator','cat'=>'cat-nutrition','animal'=>'cat','type'=>'calculator','kw'=>'cat weight loss plan','icon'=>'📉'],
        ['slug'=>'cat-hydration-guide','title'=>'Cat Hydration: How Much Water Should Cats Drink?','cat'=>'cat-nutrition','animal'=>'cat','type'=>'calculator','kw'=>'how much water should cats drink','icon'=>'💧'],
        ['slug'=>'best-cat-food-guide','title'=>'How to Choose the Best Cat Food: Guide','cat'=>'cat-nutrition','animal'=>'cat','type'=>'guide','kw'=>'best cat food guide','icon'=>'🛒'],
        ['slug'=>'cat-food-allergies-guide','title'=>'Cat Food Allergies: Symptoms & Elimination Diet','cat'=>'cat-nutrition','animal'=>'cat','type'=>'guide','kw'=>'cat food allergies guide','icon'=>'🤧'],
        ['slug'=>'senior-cat-diet-guide','title'=>'Senior Cat Diet: Best Foods for Aging Cats','cat'=>'cat-nutrition','animal'=>'cat','type'=>'guide','kw'=>'senior cat diet guide','icon'=>'👴'],
        ['slug'=>'cat-supplements-guide','title'=>'Cat Supplements Guide: Omega-3, Probiotics & More','cat'=>'cat-nutrition','animal'=>'cat','type'=>'guide','kw'=>'cat supplements guide','icon'=>'💊'],
        ['slug'=>'cat-kidney-diet-guide','title'=>'Cat Kidney Disease Diet Guide','cat'=>'cat-nutrition','animal'=>'cat','type'=>'guide','kw'=>'cat kidney disease diet guide','icon'=>'🏥'],
        ['slug'=>'homemade-cat-food-guide','title'=>'Homemade Cat Food Guide: Safe Recipes','cat'=>'cat-nutrition','animal'=>'cat','type'=>'guide','kw'=>'homemade cat food guide','icon'=>'👨‍🍳'],
        ['slug'=>'cat-grain-free-diet-guide','title'=>'Grain-Free Cat Food: Is It Safe?','cat'=>'cat-nutrition','animal'=>'cat','type'=>'guide','kw'=>'grain free cat food guide','icon'=>'🌾'],
        ['slug'=>'cat-taurine-guide','title'=>'Taurine in Cat Food: Why Cats Need It','cat'=>'cat-nutrition','animal'=>'cat','type'=>'guide','kw'=>'taurine in cat food guide','icon'=>'🔬'],

        // ═══════════════════════════════════════════
        // BIRD CARE (20)
        // ═══════════════════════════════════════════
        ['slug'=>'parrot-feeding-guide','title'=>'Parrot Feeding Guide: Diet & Nutrition','cat'=>'bird-care','animal'=>'bird','type'=>'guide','kw'=>'parrot feeding guide','icon'=>'🦜'],
        ['slug'=>'budgie-care-guide','title'=>'Budgie (Parakeet) Care Guide for Beginners','cat'=>'bird-care','animal'=>'bird','type'=>'guide','kw'=>'budgie care guide','icon'=>'🐦'],
        ['slug'=>'cockatiel-care-guide','title'=>'Cockatiel Care Guide: Diet, Health & Housing','cat'=>'bird-care','animal'=>'bird','type'=>'guide','kw'=>'cockatiel care guide','icon'=>'🐦'],
        ['slug'=>'bird-cage-size-calculator','title'=>'Bird Cage Size Calculator by Species','cat'=>'bird-care','animal'=>'bird','type'=>'calculator','kw'=>'bird cage size calculator','icon'=>'🏠'],
        ['slug'=>'bird-food-portion-calculator','title'=>'Bird Food Portion Calculator by Species','cat'=>'bird-care','animal'=>'bird','type'=>'calculator','kw'=>'bird food portion calculator','icon'=>'🌾'],
        ['slug'=>'bird-toxic-foods-guide','title'=>'Foods Toxic to Birds: Complete Safety List','cat'=>'bird-care','animal'=>'bird','type'=>'guide','kw'=>'foods toxic to birds list','icon'=>'☠️'],
        ['slug'=>'bird-temperature-guide','title'=>'Ideal Temperature for Pet Birds Guide','cat'=>'bird-care','animal'=>'bird','type'=>'guide','kw'=>'ideal temperature for pet birds','icon'=>'🌡️'],
        ['slug'=>'bird-illness-signs-checker','title'=>'Bird Illness Signs Checker','cat'=>'bird-care','animal'=>'bird','type'=>'checker','kw'=>'bird illness signs checker','icon'=>'🔬'],
        ['slug'=>'how-to-tame-a-bird','title'=>'How to Tame a Pet Bird: Step-by-Step Guide','cat'=>'bird-care','animal'=>'bird','type'=>'guide','kw'=>'how to tame a pet bird','icon'=>'🤝'],
        ['slug'=>'bird-molting-guide','title'=>'Bird Molting: What to Expect & How to Help','cat'=>'bird-care','animal'=>'bird','type'=>'guide','kw'=>'bird molting guide','icon'=>'🪶'],
        ['slug'=>'bird-lifespan-guide','title'=>'Pet Bird Lifespan Guide by Species','cat'=>'bird-care','animal'=>'bird','type'=>'guide','kw'=>'pet bird lifespan guide','icon'=>'📅'],
        ['slug'=>'african-grey-parrot-care','title'=>'African Grey Parrot Care Guide','cat'=>'bird-care','animal'=>'bird','type'=>'guide','kw'=>'african grey parrot care guide','icon'=>'🦜'],
        ['slug'=>'lovebird-care-guide','title'=>'Lovebird Care Guide: Diet, Housing & Health','cat'=>'bird-care','animal'=>'bird','type'=>'guide','kw'=>'lovebird care guide','icon'=>'❤️'],
        ['slug'=>'cockatoo-care-guide','title'=>'Cockatoo Care Guide: Complete Owner Guide','cat'=>'bird-care','animal'=>'bird','type'=>'guide','kw'=>'cockatoo care guide','icon'=>'🦜'],
        ['slug'=>'canary-care-guide','title'=>'Canary Care Guide: Diet, Singing & Health','cat'=>'bird-care','animal'=>'bird','type'=>'guide','kw'=>'canary care guide','icon'=>'🐦'],
        ['slug'=>'bird-enrichment-guide','title'=>'Bird Enrichment Ideas & Mental Stimulation Guide','cat'=>'bird-care','animal'=>'bird','type'=>'guide','kw'=>'bird enrichment ideas guide','icon'=>'🎠'],
        ['slug'=>'bird-egg-incubation-guide','title'=>'Bird Egg Incubation Guide & Calculator','cat'=>'bird-care','animal'=>'bird','type'=>'calculator','kw'=>'bird egg incubation guide','icon'=>'🥚'],
        ['slug'=>'bird-sleep-requirements-guide','title'=>'How Much Sleep Do Pet Birds Need?','cat'=>'bird-care','animal'=>'bird','type'=>'guide','kw'=>'how much sleep do pet birds need','icon'=>'😴'],
        ['slug'=>'bird-feather-plucking-guide','title'=>'Bird Feather Plucking: Causes & Solutions','cat'=>'bird-care','animal'=>'bird','type'=>'guide','kw'=>'bird feather plucking causes','icon'=>'🪶'],
        ['slug'=>'finch-care-guide','title'=>'Finch Care Guide: Diet, Cage & Health','cat'=>'bird-care','animal'=>'bird','type'=>'guide','kw'=>'finch care guide','icon'=>'🐦'],

        // ═══════════════════════════════════════════
        // RABBIT CARE (15)
        // ═══════════════════════════════════════════
        ['slug'=>'rabbit-feeding-guide','title'=>'Rabbit Feeding Guide: Diet, Hay & Vegetables','cat'=>'rabbit-care','animal'=>'rabbit','type'=>'guide','kw'=>'rabbit feeding guide','icon'=>'🥕'],
        ['slug'=>'rabbit-food-portion-calculator','title'=>'Rabbit Food Portion Calculator','cat'=>'rabbit-care','animal'=>'rabbit','type'=>'calculator','kw'=>'rabbit food portion calculator','icon'=>'🥬'],
        ['slug'=>'rabbit-cage-size-calculator','title'=>'Rabbit Hutch & Cage Size Calculator','cat'=>'rabbit-care','animal'=>'rabbit','type'=>'calculator','kw'=>'rabbit cage size calculator','icon'=>'🏠'],
        ['slug'=>'rabbit-lifespan-calculator','title'=>'Rabbit Lifespan Calculator by Breed','cat'=>'rabbit-care','animal'=>'rabbit','type'=>'calculator','kw'=>'rabbit lifespan calculator','icon'=>'📅'],
        ['slug'=>'rabbit-health-checker','title'=>'Rabbit Health Symptoms Checker','cat'=>'rabbit-care','animal'=>'rabbit','type'=>'checker','kw'=>'rabbit health symptoms checker','icon'=>'🔬'],
        ['slug'=>'rabbit-toxic-foods-guide','title'=>'Foods Toxic to Rabbits: Safety Guide','cat'=>'rabbit-care','animal'=>'rabbit','type'=>'guide','kw'=>'foods toxic to rabbits guide','icon'=>'☠️'],
        ['slug'=>'rabbit-litter-training-guide','title'=>'Rabbit Litter Training: Step-by-Step Guide','cat'=>'rabbit-care','animal'=>'rabbit','type'=>'guide','kw'=>'rabbit litter training guide','icon'=>'🏠'],
        ['slug'=>'rabbit-spay-neuter-guide','title'=>'Rabbit Spay & Neuter: Benefits & Recovery','cat'=>'rabbit-care','animal'=>'rabbit','type'=>'guide','kw'=>'rabbit spay neuter guide','icon'=>'🏥'],
        ['slug'=>'rabbit-grooming-guide','title'=>'Rabbit Grooming Guide: Brushing & Nail Trimming','cat'=>'rabbit-care','animal'=>'rabbit','type'=>'guide','kw'=>'rabbit grooming guide','icon'=>'🪮'],
        ['slug'=>'rabbit-bonding-guide','title'=>'How to Bond Two Rabbits: Complete Guide','cat'=>'rabbit-care','animal'=>'rabbit','type'=>'guide','kw'=>'how to bond two rabbits','icon'=>'❤️'],
        ['slug'=>'rabbit-exercise-guide','title'=>'Rabbit Exercise Needs & Playtime Guide','cat'=>'rabbit-care','animal'=>'rabbit','type'=>'guide','kw'=>'rabbit exercise needs guide','icon'=>'🏃'],
        ['slug'=>'indoor-rabbit-care-guide','title'=>'Indoor Rabbit Care Guide: House Rabbit Tips','cat'=>'rabbit-care','animal'=>'rabbit','type'=>'guide','kw'=>'indoor rabbit care guide','icon'=>'🏠'],
        ['slug'=>'rabbit-gi-stasis-guide','title'=>'GI Stasis in Rabbits: Signs & Emergency Guide','cat'=>'rabbit-care','animal'=>'rabbit','type'=>'guide','kw'=>'rabbit gi stasis guide','icon'=>'🚑'],
        ['slug'=>'dwarf-rabbit-care-guide','title'=>'Dwarf Rabbit Care Guide','cat'=>'rabbit-care','animal'=>'rabbit','type'=>'guide','kw'=>'dwarf rabbit care guide','icon'=>'🐰'],
        ['slug'=>'rabbit-dental-health-guide','title'=>'Rabbit Dental Health & Teeth Problems Guide','cat'=>'rabbit-care','animal'=>'rabbit','type'=>'guide','kw'=>'rabbit dental health guide','icon'=>'🦷'],

        // ═══════════════════════════════════════════
        // FISH & AQUARIUM (20)
        // ═══════════════════════════════════════════
        ['slug'=>'aquarium-size-calculator','title'=>'Fish Tank Size Calculator: Gallons Per Fish','cat'=>'fish-aquarium','animal'=>'fish','type'=>'calculator','kw'=>'fish tank size calculator','icon'=>'🐠'],
        ['slug'=>'fish-feeding-guide','title'=>'How Much to Feed Fish: Feeding Guide & Calculator','cat'=>'fish-aquarium','animal'=>'fish','type'=>'calculator','kw'=>'how much to feed fish','icon'=>'🐡'],
        ['slug'=>'aquarium-water-temperature-guide','title'=>'Aquarium Water Temperature Guide by Fish Type','cat'=>'fish-aquarium','animal'=>'fish','type'=>'guide','kw'=>'aquarium water temperature guide','icon'=>'🌡️'],
        ['slug'=>'aquarium-ph-guide','title'=>'Aquarium pH Levels: Complete Guide','cat'=>'fish-aquarium','animal'=>'fish','type'=>'guide','kw'=>'aquarium ph guide','icon'=>'🧪'],
        ['slug'=>'fish-tank-cycling-guide','title'=>'Fish Tank Nitrogen Cycle Guide for Beginners','cat'=>'fish-aquarium','animal'=>'fish','type'=>'guide','kw'=>'fish tank cycling guide','icon'=>'🔄'],
        ['slug'=>'fish-tank-cleaning-schedule','title'=>'Fish Tank Cleaning Schedule Calculator','cat'=>'fish-aquarium','animal'=>'fish','type'=>'calculator','kw'=>'fish tank cleaning schedule','icon'=>'🧹'],
        ['slug'=>'betta-fish-care-guide','title'=>'Betta Fish Care Guide: Tank, Diet & Health','cat'=>'fish-aquarium','animal'=>'fish','type'=>'guide','kw'=>'betta fish care guide','icon'=>'🐟'],
        ['slug'=>'goldfish-care-guide','title'=>'Goldfish Care Guide: Tank Setup & Feeding','cat'=>'fish-aquarium','animal'=>'fish','type'=>'guide','kw'=>'goldfish care guide','icon'=>'🐠'],
        ['slug'=>'tropical-fish-care-guide','title'=>'Tropical Fish Care Guide for Beginners','cat'=>'fish-aquarium','animal'=>'fish','type'=>'guide','kw'=>'tropical fish care guide','icon'=>'🐡'],
        ['slug'=>'saltwater-aquarium-guide','title'=>'Saltwater Aquarium Setup Guide for Beginners','cat'=>'fish-aquarium','animal'=>'fish','type'=>'guide','kw'=>'saltwater aquarium setup guide','icon'=>'🌊'],
        ['slug'=>'fish-disease-checker','title'=>'Fish Disease Symptoms Checker','cat'=>'fish-aquarium','animal'=>'fish','type'=>'checker','kw'=>'fish disease symptoms checker','icon'=>'🔬'],
        ['slug'=>'aquarium-filter-guide','title'=>'Aquarium Filter Guide: Types & Maintenance','cat'=>'fish-aquarium','animal'=>'fish','type'=>'guide','kw'=>'aquarium filter guide','icon'=>'💧'],
        ['slug'=>'fish-tank-lighting-guide','title'=>'Fish Tank Lighting Guide: Hours & Types','cat'=>'fish-aquarium','animal'=>'fish','type'=>'guide','kw'=>'fish tank lighting guide','icon'=>'💡'],
        ['slug'=>'fish-compatibility-guide','title'=>'Fish Compatibility Guide: Which Fish Can Live Together','cat'=>'fish-aquarium','animal'=>'fish','type'=>'guide','kw'=>'fish compatibility guide','icon'=>'🤝'],
        ['slug'=>'guppy-care-guide','title'=>'Guppy Fish Care Guide: Breeding & Feeding','cat'=>'fish-aquarium','animal'=>'fish','type'=>'guide','kw'=>'guppy fish care guide','icon'=>'🐠'],
        ['slug'=>'koi-pond-care-guide','title'=>'Koi Pond Care Guide: Feeding & Water Quality','cat'=>'fish-aquarium','animal'=>'fish','type'=>'guide','kw'=>'koi pond care guide','icon'=>'🐟'],
        ['slug'=>'aquarium-live-plants-guide','title'=>'Aquarium Live Plants Guide for Beginners','cat'=>'fish-aquarium','animal'=>'fish','type'=>'guide','kw'=>'aquarium live plants guide','icon'=>'🌿'],
        ['slug'=>'fish-quarantine-guide','title'=>'Fish Quarantine Tank: How & Why Guide','cat'=>'fish-aquarium','animal'=>'fish','type'=>'guide','kw'=>'fish quarantine tank guide','icon'=>'🏥'],
        ['slug'=>'aquarium-ammonia-guide','title'=>'Aquarium Ammonia: Causes, Effects & Fix','cat'=>'fish-aquarium','animal'=>'fish','type'=>'guide','kw'=>'aquarium ammonia guide','icon'=>'🧪'],
        ['slug'=>'oscar-fish-care-guide','title'=>'Oscar Fish Care Guide: Tank & Feeding','cat'=>'fish-aquarium','animal'=>'fish','type'=>'guide','kw'=>'oscar fish care guide','icon'=>'🐡'],

        // ═══════════════════════════════════════════
        // REPTILE CARE (15)
        // ═══════════════════════════════════════════
        ['slug'=>'bearded-dragon-care-guide','title'=>'Bearded Dragon Care Guide: Diet, Lighting & Tank','cat'=>'reptile-care','animal'=>'reptile','type'=>'guide','kw'=>'bearded dragon care guide','icon'=>'🦎'],
        ['slug'=>'leopard-gecko-care-guide','title'=>'Leopard Gecko Care Guide for Beginners','cat'=>'reptile-care','animal'=>'reptile','type'=>'guide','kw'=>'leopard gecko care guide','icon'=>'🦎'],
        ['slug'=>'ball-python-care-guide','title'=>'Ball Python Care Guide: Feeding & Habitat','cat'=>'reptile-care','animal'=>'reptile','type'=>'guide','kw'=>'ball python care guide','icon'=>'🐍'],
        ['slug'=>'turtle-care-guide','title'=>'Pet Turtle Care Guide: Tank, Diet & Health','cat'=>'reptile-care','animal'=>'reptile','type'=>'guide','kw'=>'pet turtle care guide','icon'=>'🐢'],
        ['slug'=>'reptile-temperature-guide','title'=>'Reptile Temperature & Humidity Guide','cat'=>'reptile-care','animal'=>'reptile','type'=>'guide','kw'=>'reptile temperature humidity guide','icon'=>'🌡️'],
        ['slug'=>'reptile-uvb-lighting-guide','title'=>'Reptile UVB Lighting Guide: Types & Schedule','cat'=>'reptile-care','animal'=>'reptile','type'=>'guide','kw'=>'reptile uvb lighting guide','icon'=>'💡'],
        ['slug'=>'reptile-feeding-calculator','title'=>'Reptile Feeding Calculator & Schedule','cat'=>'reptile-care','animal'=>'reptile','type'=>'calculator','kw'=>'reptile feeding calculator','icon'=>'🦗'],
        ['slug'=>'reptile-health-checker','title'=>'Reptile Health Symptoms Checker','cat'=>'reptile-care','animal'=>'reptile','type'=>'checker','kw'=>'reptile health symptoms checker','icon'=>'🔬'],
        ['slug'=>'iguana-care-guide','title'=>'Green Iguana Care Guide: Housing & Diet','cat'=>'reptile-care','animal'=>'reptile','type'=>'guide','kw'=>'green iguana care guide','icon'=>'🦎'],
        ['slug'=>'chameleon-care-guide','title'=>'Chameleon Care Guide: Humidity & Feeding','cat'=>'reptile-care','animal'=>'reptile','type'=>'guide','kw'=>'chameleon care guide','icon'=>'🦎'],
        ['slug'=>'tortoise-care-guide','title'=>'Tortoise Care Guide: Diet, Lighting & Habitat','cat'=>'reptile-care','animal'=>'reptile','type'=>'guide','kw'=>'tortoise care guide','icon'=>'🐢'],
        ['slug'=>'reptile-shedding-guide','title'=>'Reptile Shedding Problems & Solutions Guide','cat'=>'reptile-care','animal'=>'reptile','type'=>'guide','kw'=>'reptile shedding guide','icon'=>'🔄'],
        ['slug'=>'corn-snake-care-guide','title'=>'Corn Snake Care Guide for Beginners','cat'=>'reptile-care','animal'=>'reptile','type'=>'guide','kw'=>'corn snake care guide','icon'=>'🐍'],
        ['slug'=>'reptile-hibernation-guide','title'=>'Reptile Hibernation (Brumation) Guide','cat'=>'reptile-care','animal'=>'reptile','type'=>'guide','kw'=>'reptile brumation guide','icon'=>'❄️'],
        ['slug'=>'blue-tongue-skink-care','title'=>'Blue Tongue Skink Care Guide','cat'=>'reptile-care','animal'=>'reptile','type'=>'guide','kw'=>'blue tongue skink care guide','icon'=>'🦎'],

        // ═══════════════════════════════════════════
        // SMALL PETS (20)
        // ═══════════════════════════════════════════
        ['slug'=>'hamster-care-guide','title'=>'Hamster Care Guide: Cage, Diet & Health','cat'=>'small-pets','animal'=>'hamster','type'=>'guide','kw'=>'hamster care guide','icon'=>'🐹'],
        ['slug'=>'guinea-pig-care-guide','title'=>'Guinea Pig Care Guide: Diet, Housing & Health','cat'=>'small-pets','animal'=>'guinea-pig','type'=>'guide','kw'=>'guinea pig care guide','icon'=>'🐾'],
        ['slug'=>'guinea-pig-food-calculator','title'=>'Guinea Pig Food Portion Calculator','cat'=>'small-pets','animal'=>'guinea-pig','type'=>'calculator','kw'=>'guinea pig food portion calculator','icon'=>'🥬'],
        ['slug'=>'hamster-cage-size-calculator','title'=>'Hamster Cage Size Calculator','cat'=>'small-pets','animal'=>'hamster','type'=>'calculator','kw'=>'hamster cage size calculator','icon'=>'🏠'],
        ['slug'=>'ferret-care-guide','title'=>'Ferret Care Guide: Diet, Housing & Training','cat'=>'small-pets','animal'=>'ferret','type'=>'guide','kw'=>'ferret care guide','icon'=>'🐾'],
        ['slug'=>'gerbil-care-guide','title'=>'Gerbil Care Guide for Beginners','cat'=>'small-pets','animal'=>'gerbil','type'=>'guide','kw'=>'gerbil care guide','icon'=>'🐭'],
        ['slug'=>'chinchilla-care-guide','title'=>'Chinchilla Care Guide: Dust Baths, Diet & Health','cat'=>'small-pets','animal'=>'chinchilla','type'=>'guide','kw'=>'chinchilla care guide','icon'=>'🐾'],
        ['slug'=>'hedgehog-care-guide','title'=>'Hedgehog Care Guide: Diet, Housing & Health','cat'=>'small-pets','animal'=>'hedgehog','type'=>'guide','kw'=>'hedgehog care guide','icon'=>'🦔'],
        ['slug'=>'mouse-rat-care-guide','title'=>'Pet Rat & Mouse Care Guide','cat'=>'small-pets','animal'=>'rat','type'=>'guide','kw'=>'pet rat mouse care guide','icon'=>'🐭'],
        ['slug'=>'sugar-glider-care-guide','title'=>'Sugar Glider Care Guide: Diet & Bonding','cat'=>'small-pets','animal'=>'sugar-glider','type'=>'guide','kw'=>'sugar glider care guide','icon'=>'🦎'],
        ['slug'=>'small-pet-health-checker','title'=>'Small Pet Health Symptoms Checker','cat'=>'small-pets','animal'=>'small','type'=>'checker','kw'=>'small pet health symptoms checker','icon'=>'🔬'],
        ['slug'=>'hamster-lifespan-guide','title'=>'Hamster Lifespan & Age Guide by Breed','cat'=>'small-pets','animal'=>'hamster','type'=>'guide','kw'=>'hamster lifespan guide','icon'=>'📅'],
        ['slug'=>'guinea-pig-lifespan-guide','title'=>'Guinea Pig Lifespan & Health Guide','cat'=>'small-pets','animal'=>'guinea-pig','type'=>'guide','kw'=>'guinea pig lifespan guide','icon'=>'📅'],
        ['slug'=>'small-pet-cage-guide','title'=>'Small Pet Cage Setup Guide','cat'=>'small-pets','animal'=>'small','type'=>'guide','kw'=>'small pet cage setup guide','icon'=>'🏠'],
        ['slug'=>'ferret-diet-guide','title'=>'Ferret Diet Guide: What Can Ferrets Eat?','cat'=>'small-pets','animal'=>'ferret','type'=>'guide','kw'=>'ferret diet guide','icon'=>'🍖'],
        ['slug'=>'chinchilla-dust-bath-guide','title'=>'Chinchilla Dust Bath Guide: How Often & Which Dust','cat'=>'small-pets','animal'=>'chinchilla','type'=>'guide','kw'=>'chinchilla dust bath guide','icon'=>'🧹'],
        ['slug'=>'hamster-wheel-size-guide','title'=>'Hamster Wheel Size Guide by Breed','cat'=>'small-pets','animal'=>'hamster','type'=>'guide','kw'=>'hamster wheel size guide','icon'=>'⚙️'],
        ['slug'=>'guinea-pig-vitamin-c-guide','title'=>'Guinea Pig Vitamin C: Sources & Requirements','cat'=>'small-pets','animal'=>'guinea-pig','type'=>'guide','kw'=>'guinea pig vitamin c guide','icon'=>'🍊'],
        ['slug'=>'hedgehog-hibernation-guide','title'=>'Hedgehog Hibernation Dangers & Prevention','cat'=>'small-pets','animal'=>'hedgehog','type'=>'guide','kw'=>'hedgehog hibernation dangers','icon'=>'❄️'],
        ['slug'=>'small-pet-bonding-guide','title'=>'How to Bond with Your Small Pet Guide','cat'=>'small-pets','animal'=>'small','type'=>'guide','kw'=>'how to bond with small pet','icon'=>'❤️'],

        // ═══════════════════════════════════════════
        // GENERAL PET CARE (30)
        // ═══════════════════════════════════════════
        ['slug'=>'pet-adoption-guide','title'=>'Pet Adoption Guide: First-Time Owner Checklist','cat'=>'general-pet','animal'=>'all','type'=>'guide','kw'=>'pet adoption guide checklist','icon'=>'🏠'],
        ['slug'=>'pet-insurance-guide','title'=>'Pet Insurance Guide: Is It Worth It?','cat'=>'general-pet','animal'=>'all','type'=>'guide','kw'=>'pet insurance guide worth it','icon'=>'🛡️'],
        ['slug'=>'pet-microchipping-guide','title'=>'Pet Microchipping Guide: Cost, Process & Benefits','cat'=>'general-pet','animal'=>'all','type'=>'guide','kw'=>'pet microchipping guide','icon'=>'📡'],
        ['slug'=>'pet-travel-guide','title'=>'Traveling with Pets: Complete Safety Guide','cat'=>'general-pet','animal'=>'all','type'=>'guide','kw'=>'traveling with pets guide','icon'=>'✈️'],
        ['slug'=>'new-pet-checklist','title'=>'New Pet Checklist: Everything You Need','cat'=>'general-pet','animal'=>'all','type'=>'guide','kw'=>'new pet checklist','icon'=>'✅'],
        ['slug'=>'pet-cost-calculator','title'=>'Annual Pet Cost Calculator','cat'=>'general-pet','animal'=>'all','type'=>'calculator','kw'=>'annual pet cost calculator','icon'=>'💰'],
        ['slug'=>'pet-proof-home-guide','title'=>'How to Pet-Proof Your Home: Room-by-Room Guide','cat'=>'general-pet','animal'=>'all','type'=>'guide','kw'=>'how to pet proof home','icon'=>'🏠'],
        ['slug'=>'indoor-vs-outdoor-pet-guide','title'=>'Indoor vs Outdoor Pets: Pros, Cons & Safety','cat'=>'general-pet','animal'=>'all','type'=>'guide','kw'=>'indoor vs outdoor pet guide','icon'=>'🏡'],
        ['slug'=>'pet-loss-grief-guide','title'=>'Coping with Pet Loss: Grief Support Guide','cat'=>'general-pet','animal'=>'all','type'=>'guide','kw'=>'coping with pet loss guide','icon'=>'💔'],
        ['slug'=>'pet-emergency-kit-guide','title'=>'Pet Emergency Kit: Complete Checklist','cat'=>'general-pet','animal'=>'all','type'=>'guide','kw'=>'pet emergency kit checklist','icon'=>'🚑'],
        ['slug'=>'multiple-pet-household-guide','title'=>'Multiple Pet Household: Introduction & Harmony Guide','cat'=>'general-pet','animal'=>'all','type'=>'guide','kw'=>'multiple pet household guide','icon'=>'🐾'],
        ['slug'=>'pet-vaccination-guide','title'=>'Core Vaccines for Pets: Complete Schedule Guide','cat'=>'general-pet','animal'=>'all','type'=>'guide','kw'=>'core vaccines for pets guide','icon'=>'💉'],
        ['slug'=>'pet-weight-management-guide','title'=>'Pet Obesity: Weight Management & Diet Guide','cat'=>'general-pet','animal'=>'all','type'=>'guide','kw'=>'pet obesity weight management','icon'=>'⚖️'],
        ['slug'=>'zoonotic-diseases-guide','title'=>'Zoonotic Diseases: Diseases Pets Can Give Humans','cat'=>'general-pet','animal'=>'all','type'=>'guide','kw'=>'zoonotic diseases pets guide','icon'=>'🔬'],
        ['slug'=>'pet-sleep-guide','title'=>'How Much Should Pets Sleep? Guide by Animal','cat'=>'general-pet','animal'=>'all','type'=>'guide','kw'=>'how much should pets sleep','icon'=>'😴'],
        ['slug'=>'children-and-pets-guide','title'=>'Kids and Pets Safety Guide: Teaching Respect','cat'=>'general-pet','animal'=>'all','type'=>'guide','kw'=>'children and pets safety guide','icon'=>'👧'],
        ['slug'=>'pet-water-safety-guide','title'=>'Pet Water Safety: Lakes, Pools & Beaches','cat'=>'general-pet','animal'=>'all','type'=>'guide','kw'=>'pet water safety guide','icon'=>'🏊'],
        ['slug'=>'apartment-pets-guide','title'=>'Best Pets for Apartment Living Guide','cat'=>'general-pet','animal'=>'all','type'=>'guide','kw'=>'best pets for apartments guide','icon'=>'🏢'],
        ['slug'=>'pet-noise-phobia-guide','title'=>'Pet Noise Phobia: Fireworks & Thunderstorm Guide','cat'=>'general-pet','animal'=>'all','type'=>'guide','kw'=>'pet noise phobia guide','icon'=>'💥'],
        ['slug'=>'senior-pet-care-guide','title'=>'Senior Pet Care Guide: All Animals 8+ Years','cat'=>'general-pet','animal'=>'all','type'=>'guide','kw'=>'senior pet care guide','icon'=>'👴'],
        ['slug'=>'exotic-pet-guide','title'=>'Exotic Pets Guide: Legal, Care & Considerations','cat'=>'general-pet','animal'=>'all','type'=>'guide','kw'=>'exotic pets guide','icon'=>'🦁'],
        ['slug'=>'pet-dental-care-guide','title'=>'Pet Dental Care Guide: All Animals','cat'=>'general-pet','animal'=>'all','type'=>'guide','kw'=>'pet dental care guide','icon'=>'🦷'],
        ['slug'=>'raw-vs-commercial-pet-food','title'=>'Raw vs Commercial Pet Food: Complete Comparison','cat'=>'general-pet','animal'=>'all','type'=>'guide','kw'=>'raw vs commercial pet food guide','icon'=>'⚖️'],
        ['slug'=>'pet-stomach-upset-guide','title'=>'Pet Stomach Upset: Causes & Home Remedies','cat'=>'general-pet','animal'=>'all','type'=>'guide','kw'=>'pet stomach upset guide','icon'=>'🤢'],
        ['slug'=>'pet-eye-problems-guide','title'=>'Common Pet Eye Problems: Signs & Treatment','cat'=>'general-pet','animal'=>'all','type'=>'guide','kw'=>'pet eye problems guide','icon'=>'👁️'],
        ['slug'=>'how-to-give-pet-medicine','title'=>'How to Give Your Pet Medicine: Tips & Tricks','cat'=>'general-pet','animal'=>'all','type'=>'guide','kw'=>'how to give pet medicine','icon'=>'💊'],
        ['slug'=>'pet-reproduction-guide','title'=>'Pet Reproduction Guide: Mating, Pregnancy & Birth','cat'=>'general-pet','animal'=>'all','type'=>'guide','kw'=>'pet reproduction guide','icon'=>'🤰'],
        ['slug'=>'pet-enrichment-guide','title'=>'Pet Enrichment Ideas: Mental Stimulation Guide','cat'=>'general-pet','animal'=>'all','type'=>'guide','kw'=>'pet enrichment ideas guide','icon'=>'🧩'],
        ['slug'=>'seasonal-pet-care-guide','title'=>'Seasonal Pet Care Guide: Summer to Winter','cat'=>'general-pet','animal'=>'all','type'=>'guide','kw'=>'seasonal pet care guide','icon'=>'🍂'],
        ['slug'=>'pet-anxiety-medications-guide','title'=>'Pet Anxiety Medications & Natural Remedies Guide','cat'=>'general-pet','animal'=>'all','type'=>'guide','kw'=>'pet anxiety medications guide','icon'=>'💊'],

        // ═══════════════════════════════════════════
        // PET BEHAVIOR (15)
        // ═══════════════════════════════════════════
        ['slug'=>'dog-body-language-guide','title'=>'Dog Body Language: Complete Guide','cat'=>'pet-behavior','animal'=>'dog','type'=>'guide','kw'=>'dog body language guide','icon'=>'🐕'],
        ['slug'=>'cat-body-language-guide','title'=>'Cat Body Language & Communication Guide','cat'=>'pet-behavior','animal'=>'cat','type'=>'guide','kw'=>'cat body language guide','icon'=>'🐱'],
        ['slug'=>'why-do-cats-purr-guide','title'=>'Why Do Cats Purr? Meanings & Science Guide','cat'=>'pet-behavior','animal'=>'cat','type'=>'guide','kw'=>'why do cats purr guide','icon'=>'💭'],
        ['slug'=>'dog-tail-wagging-guide','title'=>'Dog Tail Wagging Meanings: What It Tells You','cat'=>'pet-behavior','animal'=>'dog','type'=>'guide','kw'=>'dog tail wagging meanings','icon'=>'🐕'],
        ['slug'=>'cat-kneading-guide','title'=>'Why Do Cats Knead? Behavior Explained','cat'=>'pet-behavior','animal'=>'cat','type'=>'guide','kw'=>'why do cats knead guide','icon'=>'🐱'],
        ['slug'=>'why-dogs-eat-grass','title'=>'Why Do Dogs Eat Grass? Science Explained','cat'=>'pet-behavior','animal'=>'dog','type'=>'guide','kw'=>'why do dogs eat grass','icon'=>'🌱'],
        ['slug'=>'cat-zoomies-guide','title'=>'Why Do Cats Get Zoomies? Guide & Meaning','cat'=>'pet-behavior','animal'=>'cat','type'=>'guide','kw'=>'why do cats get zoomies','icon'=>'🏃'],
        ['slug'=>'dog-zoomies-guide','title'=>'Dog Zoomies: Why They Happen & What To Do','cat'=>'pet-behavior','animal'=>'dog','type'=>'guide','kw'=>'dog zoomies guide','icon'=>'🏃'],
        ['slug'=>'pet-play-behavior-guide','title'=>'Pet Play Behavior Guide: Normal vs Aggressive','cat'=>'pet-behavior','animal'=>'all','type'=>'guide','kw'=>'pet play behavior guide','icon'=>'🎮'],
        ['slug'=>'cat-scratching-behavior-guide','title'=>'Why Cats Scratch & How to Redirect It','cat'=>'pet-behavior','animal'=>'cat','type'=>'guide','kw'=>'cat scratching behavior guide','icon'=>'🐾'],
        ['slug'=>'dog-sniffing-behavior','title'=>'Why Dogs Sniff Everything: Behavior Guide','cat'=>'pet-behavior','animal'=>'dog','type'=>'guide','kw'=>'why dogs sniff behavior guide','icon'=>'👃'],
        ['slug'=>'pet-territorial-behavior','title'=>'Pet Territorial Behavior: Guide & Solutions','cat'=>'pet-behavior','animal'=>'all','type'=>'guide','kw'=>'pet territorial behavior guide','icon'=>'🗺️'],
        ['slug'=>'why-cats-bring-gifts','title'=>'Why Cats Bring Dead Animals as Gifts','cat'=>'pet-behavior','animal'=>'cat','type'=>'guide','kw'=>'why cats bring dead animals gifts','icon'=>'🎁'],
        ['slug'=>'dog-humping-behavior','title'=>'Dog Humping Behavior: Causes & Solutions','cat'=>'pet-behavior','animal'=>'dog','type'=>'guide','kw'=>'dog humping behavior causes','icon'=>'🐕'],
        ['slug'=>'cat-midnight-activity-guide','title'=>'Why Are Cats Active at Night? Solutions Guide','cat'=>'pet-behavior','animal'=>'cat','type'=>'guide','kw'=>'why are cats active at night','icon'=>'🌙'],

        // ═══════════════════════════════════════════
        // PET SAFETY (15)
        // ═══════════════════════════════════════════
        ['slug'=>'pet-toxic-plants-guide','title'=>'Plants Toxic to Pets: Complete Home Safety List','cat'=>'pet-safety','animal'=>'all','type'=>'guide','kw'=>'plants toxic to pets guide','icon'=>'🌿'],
        ['slug'=>'pet-poison-emergency-guide','title'=>'Pet Poisoning Emergency Guide: What to Do','cat'=>'pet-safety','animal'=>'all','type'=>'guide','kw'=>'pet poisoning emergency guide','icon'=>'🚑'],
        ['slug'=>'dog-car-safety-guide','title'=>'Dog Car Safety Guide: Harnesses & Crates','cat'=>'pet-safety','animal'=>'dog','type'=>'guide','kw'=>'dog car safety guide','icon'=>'🚗'],
        ['slug'=>'pet-heat-safety-guide','title'=>'Pet Heat Safety Guide: Summer & Hot Cars','cat'=>'pet-safety','animal'=>'all','type'=>'guide','kw'=>'pet heat safety guide','icon'=>'☀️'],
        ['slug'=>'pet-cold-weather-safety','title'=>'Pet Cold Weather Safety Guide','cat'=>'pet-safety','animal'=>'all','type'=>'guide','kw'=>'pet cold weather safety guide','icon'=>'❄️'],
        ['slug'=>'holiday-pet-safety-guide','title'=>'Holiday Pet Safety Guide: Christmas & Halloween','cat'=>'pet-safety','animal'=>'all','type'=>'guide','kw'=>'holiday pet safety guide','icon'=>'🎄'],
        ['slug'=>'pet-household-chemicals-guide','title'=>'Household Chemicals Toxic to Pets','cat'=>'pet-safety','animal'=>'all','type'=>'guide','kw'=>'household chemicals toxic to pets','icon'=>'☠️'],
        ['slug'=>'dog-pool-safety-guide','title'=>'Dog Pool & Water Safety Guide','cat'=>'pet-safety','animal'=>'dog','type'=>'guide','kw'=>'dog pool water safety','icon'=>'🏊'],
        ['slug'=>'pet-fire-safety-guide','title'=>'Pet Fire Safety & Evacuation Guide','cat'=>'pet-safety','animal'=>'all','type'=>'guide','kw'=>'pet fire safety guide','icon'=>'🔥'],
        ['slug'=>'escaped-pet-guide','title'=>'Lost Pet Guide: What to Do When Pet Escapes','cat'=>'pet-safety','animal'=>'all','type'=>'guide','kw'=>'lost pet guide what to do','icon'=>'🔍'],
        ['slug'=>'dog-bite-wound-guide','title'=>'Dog Bite First Aid: Wound Care Guide','cat'=>'pet-safety','animal'=>'dog','type'=>'guide','kw'=>'dog bite first aid guide','icon'=>'🩹'],
        ['slug'=>'pet-medication-safety','title'=>'Human Medications Toxic to Pets','cat'=>'pet-safety','animal'=>'all','type'=>'guide','kw'=>'human medications toxic to pets','icon'=>'💊'],
        ['slug'=>'outdoor-pet-hazards-guide','title'=>'Outdoor Pet Hazards: Wildlife, Plants & Pests','cat'=>'pet-safety','animal'=>'all','type'=>'guide','kw'=>'outdoor pet hazards guide','icon'=>'🌲'],
        ['slug'=>'pet-stranger-safety-guide','title'=>'Teaching Pets to Be Safe Around Strangers','cat'=>'pet-safety','animal'=>'all','type'=>'guide','kw'=>'pet stranger safety guide','icon'=>'👤'],
        ['slug'=>'new-baby-pet-safety-guide','title'=>'Baby and Pet Safety: Introduction Guide','cat'=>'pet-safety','animal'=>'all','type'=>'guide','kw'=>'baby and pet safety guide','icon'=>'👶'],

        // ═══════════════════════════════════════════
        // BONUS — DOG HEALTH EXTRA (5)
        // ═══════════════════════════════════════════
        ['slug'=>'dog-bloat-gDV-guide','title'=>'Dog Bloat (GDV): Signs, Prevention & Emergency','cat'=>'dog-health','animal'=>'dog','type'=>'guide','kw'=>'dog bloat GDV guide','icon'=>'🚨'],
        ['slug'=>'dog-parvovirus-guide','title'=>'Parvovirus in Dogs: Symptoms, Treatment & Prevention','cat'=>'dog-health','animal'=>'dog','type'=>'guide','kw'=>'parvovirus in dogs guide','icon'=>'🦠'],
        ['slug'=>'dog-heartworm-prevention','title'=>'Dog Heartworm Prevention: Complete Guide','cat'=>'dog-health','animal'=>'dog','type'=>'guide','kw'=>'dog heartworm prevention guide','icon'=>'❤️'],
        ['slug'=>'dog-lyme-disease-guide','title'=>'Lyme Disease in Dogs: Ticks, Signs & Treatment','cat'=>'dog-health','animal'=>'dog','type'=>'guide','kw'=>'lyme disease in dogs guide','icon'=>'🦟'],
        ['slug'=>'dog-cushing-disease-guide','title'=>'Cushing\'s Disease in Dogs: Symptoms & Management','cat'=>'dog-health','animal'=>'dog','type'=>'guide','kw'=>'cushings disease in dogs','icon'=>'🏥'],

        // ═══════════════════════════════════════════
        // BONUS — CAT HEALTH EXTRA (5)
        // ═══════════════════════════════════════════
        ['slug'=>'feline-leukemia-guide','title'=>'Feline Leukemia Virus (FeLV): Guide for Cat Owners','cat'=>'cat-health','animal'=>'cat','type'=>'guide','kw'=>'feline leukemia virus guide','icon'=>'🦠'],
        ['slug'=>'cat-fiv-guide','title'=>'FIV in Cats: Symptoms, Management & Life Expectancy','cat'=>'cat-health','animal'=>'cat','type'=>'guide','kw'=>'FIV in cats guide','icon'=>'🏥'],
        ['slug'=>'cat-pancreatitis-guide','title'=>'Cat Pancreatitis: Signs, Causes & Diet','cat'=>'cat-health','animal'=>'cat','type'=>'guide','kw'=>'cat pancreatitis guide','icon'=>'🔬'],
        ['slug'=>'cat-ringworm-guide','title'=>'Ringworm in Cats: Treatment & Prevention Guide','cat'=>'cat-health','animal'=>'cat','type'=>'guide','kw'=>'ringworm in cats guide','icon'=>'🩹'],
        ['slug'=>'cat-heartworm-guide','title'=>'Heartworm in Cats: Prevention & Symptoms','cat'=>'cat-health','animal'=>'cat','type'=>'guide','kw'=>'heartworm in cats guide','icon'=>'❤️'],

        // ═══════════════════════════════════════════
        // BONUS — GENERAL PET EXTRA (5)
        // ═══════════════════════════════════════════
        ['slug'=>'pet-grooming-at-home-guide','title'=>'Complete At-Home Pet Grooming Guide','cat'=>'general-pet','animal'=>'all','type'=>'guide','kw'=>'at home pet grooming guide','icon'=>'🪮'],
        ['slug'=>'pet-birthday-ideas-guide','title'=>'Pet Birthday Ideas: Celebrating Your Pet','cat'=>'general-pet','animal'=>'all','type'=>'guide','kw'=>'pet birthday ideas guide','icon'=>'🎂'],
        ['slug'=>'pet-boarding-guide','title'=>'Pet Boarding vs Pet Sitter: Which Is Better?','cat'=>'general-pet','animal'=>'all','type'=>'guide','kw'=>'pet boarding vs pet sitter','icon'=>'🏨'],
        ['slug'=>'how-to-find-good-vet','title'=>'How to Find a Good Veterinarian: Complete Guide','cat'=>'general-pet','animal'=>'all','type'=>'guide','kw'=>'how to find a good veterinarian','icon'=>'🏥'],
        ['slug'=>'pet-dna-test-guide','title'=>'Pet DNA Test Guide: Worth It for Dogs & Cats?','cat'=>'general-pet','animal'=>'all','type'=>'guide','kw'=>'pet DNA test guide','icon'=>'🧬'],

        // ═══════════════════════════════════════════
        // BONUS — PET BEHAVIOR EXTRA (5)
        // ═══════════════════════════════════════════
        ['slug'=>'why-dogs-lick-you','title'=>'Why Does My Dog Lick Me? Meanings Explained','cat'=>'pet-behavior','animal'=>'dog','type'=>'guide','kw'=>'why does my dog lick me','icon'=>'👅'],
        ['slug'=>'why-cats-headbutt-guide','title'=>'Why Do Cats Headbutt You? Behavior Guide','cat'=>'pet-behavior','animal'=>'cat','type'=>'guide','kw'=>'why do cats headbutt guide','icon'=>'🐱'],
        ['slug'=>'dog-dream-guide','title'=>'Do Dogs Dream? Science & Sleep Behavior Guide','cat'=>'pet-behavior','animal'=>'dog','type'=>'guide','kw'=>'do dogs dream science guide','icon'=>'💭'],
        ['slug'=>'cat-slow-blink-guide','title'=>'Cat Slow Blink: What It Means & How to Do It Back','cat'=>'pet-behavior','animal'=>'cat','type'=>'guide','kw'=>'cat slow blink meaning guide','icon'=>'😌'],
        ['slug'=>'dog-rolling-grass-guide','title'=>'Why Do Dogs Roll in Grass & Smelly Things?','cat'=>'pet-behavior','animal'=>'dog','type'=>'guide','kw'=>'why dogs roll in grass guide','icon'=>'🌿'],
    ];
}
