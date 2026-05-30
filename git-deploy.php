<?php
$token = 'pz_deploy_2026_secret';
if (!isset($_GET['token']) || $_GET['token'] !== $token) {
    http_response_code(403); die('Unauthorized');
}

$zip_url = 'https://github.com/abdulrehman4546/petzenai/archive/refs/heads/main.zip';
$zip_content = file_get_contents($zip_url);
if (!$zip_content) { die('Failed to download from GitHub'); }

$zip_file = sys_get_temp_dir() . '/petzenai-' . time() . '.zip';
file_put_contents($zip_file, $zip_content);

$zip = new ZipArchive();
if ($zip->open($zip_file) !== true) { die('Failed to open ZIP'); }

$extract_dir = sys_get_temp_dir() . '/pz-extract-' . time();
mkdir($extract_dir, 0755, true);
$zip->extractTo($extract_dir);
$zip->close();
unlink($zip_file);

$src = $extract_dir . '/petzenai-main/wp-content/themes/petzenai-theme/';
$dst = '/home/sites/4b/0/0a977b293d/public_html6/wp-content/themes/petzenai-theme/';

function pz_copy_dir($src, $dst) {
    @mkdir($dst, 0755, true);
    foreach (scandir($src) as $file) {
        if ($file === '.' || $file === '..') continue;
        if (is_dir("$src$file")) {
            pz_copy_dir("$src$file/", "$dst$file/");
        } else {
            copy("$src$file", "$dst$file");
        }
    }
}

pz_copy_dir($src, $dst);
echo "Deployed at " . date('Y-m-d H:i:s');
