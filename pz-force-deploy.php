<?php
/**
 * PetZenAI — Force update git-deploy.php + ads.txt on live server
 * Downloads latest versions from GitHub and overwrites.
 * DELETE after running!
 */
if (!isset($_GET['token']) || $_GET['token'] !== 'pz_force_2026') die('Unauthorized');

set_time_limit(120);
$root_dst = '/home/sites/4b/0/0a977b293d/public_html6/';
$raw_base = 'https://raw.githubusercontent.com/abdulrehman4546/petzenai/main/';

echo "<pre style='background:#0D0D0D;color:#E8E8E8;padding:20px;font-size:13px;line-height:2'>";
echo "PetZenAI Force Deploy\n=====================\n";

$files = ['git-deploy.php', 'ads.txt'];

foreach ($files as $file) {
    $content = file_get_contents($raw_base . $file);
    if ($content === false) {
        echo "❌ Failed to download: $file\n";
        continue;
    }
    if (file_put_contents($root_dst . $file, $content)) {
        echo "✅ Updated: $file\n";
    } else {
        echo "❌ Write failed: $file\n";
    }
}

echo "\nDone! Delete this file now.\n</pre>";
