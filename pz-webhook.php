<?php
$token = 'pz_deploy_2026_secret';
$provided = isset($_POST['token']) ? $_POST['token'] : (isset($_GET['token']) ? $_GET['token'] : '');
if ($provided !== $token) {
    http_response_code(403); die('Unauthorized');
}

// Respond immediately so GitHub Actions doesn't timeout
ignore_user_abort(true);
set_time_limit(300);
ob_start();
echo "Deploy started at " . date('Y-m-d H:i:s');
$size = ob_get_length();
header("Content-Length: $size");
header("Connection: close");
header("Content-Type: text/plain");
ob_end_flush();
flush();

// Now run the deploy in background
$zip_url = 'https://github.com/abdulrehman4546/petzenai/archive/refs/heads/main.zip';

$ctx = stream_context_create(['http' => ['timeout' => 120]]);
$zip_content = file_get_contents($zip_url, false, $ctx);
if (!$zip_content) { exit; }

$zip_file = sys_get_temp_dir() . '/petzenai-' . time() . '.zip';
file_put_contents($zip_file, $zip_content);

$zip = new ZipArchive();
if ($zip->open($zip_file) !== true) { exit; }

$extract_dir = sys_get_temp_dir() . '/pz-' . time();
mkdir($extract_dir, 0755, true);
$zip->extractTo($extract_dir);
$zip->close();
unlink($zip_file);

$root_src = $extract_dir . '/petzenai-main/';
$root_dst = '/home/sites/4b/0/0a977b293d/public_html6/';

// Copy theme
$src = $root_src . 'wp-content/themes/petzenai-theme/';
$dst = $root_dst . 'wp-content/themes/petzenai-theme/';

function pz_copy_dir($src, $dst) {
    @mkdir($dst, 0755, true);
    foreach (scandir($src) as $file) {
        if ($file === '.' || $file === '..') continue;
        if (is_dir("$src$file")) { pz_copy_dir("$src$file/", "$dst$file/"); }
        else { copy("$src$file", "$dst$file"); }
    }
}

pz_copy_dir($src, $dst);

// Copy root files — via extracted zip AND direct GitHub raw download as fallback
$root_files = [
    'pz-fix-images.php', 'pz-force-deploy.php', 'pz-rankmath-fix.php',
    'pz-security.php', 'ads.txt', 'llms.txt', 'pz-webhook.php', 'pz-posts-import.php',
];
$raw_base = 'https://raw.githubusercontent.com/abdulrehman4546/petzenai/main/';
$log = "Deploy log " . date('Y-m-d H:i:s') . "\n";
$log .= "root_src exists: " . (is_dir($root_src) ? 'YES' : 'NO') . "\n";
$log .= "root_dst writable: " . (is_writable($root_dst) ? 'YES' : 'NO') . "\n";
foreach ($root_files as $f) {
    $src_file = $root_src . $f;
    if (file_exists($src_file)) {
        $ok = copy($src_file, $root_dst . $f);
        $log .= "$f: zip-copy=" . ($ok ? 'OK' : 'FAIL') . "\n";
    } else {
        $raw = @file_get_contents($raw_base . $f, false, stream_context_create(['http'=>['timeout'=>30]]));
        if ($raw !== false) {
            $ok = file_put_contents($root_dst . $f, $raw);
            $log .= "$f: raw-download=" . ($ok !== false ? 'OK' : 'FAIL') . "\n";
        } else {
            $log .= "$f: raw-download=FETCH_FAILED\n";
        }
    }
}
file_put_contents($root_dst . 'pz-deploy-log.txt', $log);

// Cleanup
array_map('unlink', glob("$extract_dir/*.*"));
@rmdir($extract_dir);
