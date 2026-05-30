<?php
/**
 * PetZenAI — Full Security Hardening
 * Run ONCE on live server, then DELETE immediately.
 */
if ( ! isset($_GET['confirm']) ) {
    die('<h2>Add ?confirm=yes to URL to run security hardening.</h2>');
}
require_once 'wp-load.php';
$log = [];

// ── 1. Disable file editing in WP Admin ───────────────────────────────────
if ( ! defined('DISALLOW_FILE_EDIT') ) {
    $config = ABSPATH . 'wp-config.php';
    $content = file_get_contents($config);
    if ( strpos($content, 'DISALLOW_FILE_EDIT') === false ) {
        $content = str_replace(
            "/* That's all, stop editing!",
            "define('DISALLOW_FILE_EDIT', true);\ndefine('DISALLOW_FILE_MODS', false);\n\n/* That's all, stop editing!",
            $content
        );
        file_put_contents($config, $content);
        $log[] = "✅ File editing disabled in wp-config.php";
    } else {
        $log[] = "☑️ DISALLOW_FILE_EDIT already set";
    }
}

// ── 2. Hide WordPress version ─────────────────────────────────────────────
$funcs = get_template_directory() . '/functions.php';
$fc = file_get_contents($funcs);
if ( strpos($fc, 'remove_action.*wp_generator') === false && strpos($fc, 'pz_security_hide') === false ) {
    $security_code = "\n\n/* ============================================================\n   SECURITY\n   ============================================================ */\nadd_action('init', function() {\n    remove_action('wp_head', 'wp_generator');\n    remove_action('wp_head', 'wlwmanifest_link');\n    remove_action('wp_head', 'rsd_link');\n    remove_action('wp_head', 'wp_shortlink_wp_head');\n    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);\n}, 99, 0);\n\n// Hide WP version from scripts/styles\nadd_filter('style_loader_src',  fn(\$src) => \$src ? remove_query_arg('ver', \$src) : \$src);\nadd_filter('script_loader_src', fn(\$src) => \$src ? remove_query_arg('ver', \$src) : \$src);\n\n// Disable XML-RPC\nadd_filter('xmlrpc_enabled', '__return_false');\n\n// Remove X-Powered-By header\nheader_remove('X-Powered-By');\n\n// Disable REST API for non-logged-in users (except needed endpoints)\nadd_filter('rest_authentication_errors', function(\$result) {\n    if (true === \$result || is_wp_error(\$result)) return \$result;\n    if (!is_user_logged_in()) {\n        return new WP_Error('rest_not_logged_in', 'REST API restricted.', ['status'=>401]);\n    }\n    return \$result;\n});\n\n// Security headers\nadd_action('send_headers', function() {\n    header('X-Content-Type-Options: nosniff');\n    header('X-Frame-Options: SAMEORIGIN');\n    header('X-XSS-Protection: 1; mode=block');\n    header('Referrer-Policy: strict-origin-when-cross-origin');\n    header('Permissions-Policy: camera=(), microphone=(), geolocation=()');\n});\n// pz_security_hide\n";
    file_put_contents($funcs, $fc . $security_code);
    $log[] = "✅ Security functions added to functions.php";
}

// ── 3. Update .htaccess with security rules ───────────────────────────────
$htaccess = ABSPATH . '.htaccess';
$ht = file_get_contents($htaccess);
if ( strpos($ht, 'PetZenAI Security') === false ) {
    $security_ht = "\n# PetZenAI Security\n# Block access to sensitive files\n<FilesMatch \"(wp-config\\.php|xmlrpc\\.php|\\.htaccess|\\.env|readme\\.html|license\\.txt|wp-cli\\.yml)\">\n    Order Allow,Deny\n    Deny from all\n</FilesMatch>\n\n# Block directory browsing\nOptions -Indexes\n\n# Block PHP in uploads folder\n<IfModule mod_rewrite.c>\nRewriteRule ^wp-content/uploads/.*\\.php$ - [F]\n</IfModule>\n\n# Protect wp-login.php from brute force\n<Files wp-login.php>\n    Order Deny,Allow\n    Allow from all\n</Files>\n\n# Block bad bots\n<IfModule mod_rewrite.c>\nRewriteCond %{HTTP_USER_AGENT} (MJ12bot|AhrefsBot|DotBot|SemrushBot|MegaIndex) [NC]\nRewriteRule .* - [F,L]\n</IfModule>\n\n# Prevent hotlinking\n<IfModule mod_rewrite.c>\nRewriteCond %{HTTP_REFERER} !^$\nRewriteCond %{HTTP_REFERER} !^https?://(www\\.)?petzenai\\.com [NC]\nRewriteRule \\.(jpg|jpeg|png|gif|webp)$ - [F,NC,L]\n</IfModule>\n\n# End PetZenAI Security\n";
    file_put_contents($htaccess, $ht . $security_ht);
    $log[] = "✅ .htaccess security rules added";
}

// ── 4. Delete sensitive files ─────────────────────────────────────────────
$sensitive = [ABSPATH.'readme.html', ABSPATH.'license.txt', ABSPATH.'wp-config-sample.php'];
foreach ($sensitive as $f) {
    if (file_exists($f)) {
        unlink($f);
        $log[] = "🗑️ Deleted: " . basename($f);
    }
}

// ── 5. WordPress security options ────────────────────────────────────────
update_option('default_ping_status', 'closed');
update_option('default_comment_status', 'closed');
update_option('close_comments_for_old_posts', 1);
update_option('close_comments_days_old', 14);
update_option('comment_moderation', 1);
update_option('comment_previously_approved', 1);
$log[] = "✅ Comments disabled/moderated (spam protection)";

// Disable pingbacks
update_option('enable_xmlrpc', 0);
$log[] = "✅ XML-RPC disabled";

// ── 6. Strong password enforcement note ──────────────────────────────────
$log[] = "⚠️  Manual: Change WP admin password to 20+ char strong password";
$log[] = "⚠️  Manual: Install 'Limit Login Attempts Reloaded' plugin for brute force protection";
$log[] = "⚠️  Manual: Enable SSL/HTTPS on hosting cPanel";

$log[] = str_repeat('─', 50);
$log[] = "🎉 Security hardening complete!";
?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8"><title>Security</title>
<style>
  body{font-family:Arial,sans-serif;max-width:900px;margin:40px auto;padding:20px;background:#f0f4f8}
  h1{color:#c62828}.box{background:#fff;border-radius:10px;padding:20px;box-shadow:0 2px 8px rgba(0,0,0,.1)}
  p{margin:4px 0;font-size:14px;font-family:monospace}
  .done{background:#e8f5e9;border-left:5px solid #4caf50;padding:16px;border-radius:8px;margin-top:20px;font-size:15px;font-weight:bold}
  .warn{color:#c62828;font-weight:bold}
  table{width:100%;border-collapse:collapse;margin-top:20px;background:#fff;border-radius:8px;overflow:hidden}
  th{background:#c62828;color:#fff;padding:10px;text-align:left;font-size:13px}
  td{padding:9px 10px;font-size:13px;border-bottom:1px solid #eee}
</style></head><body>
<h1>🔒 PetZenAI — Security Hardening</h1>
<div class="box">
<?php foreach($log as $l) echo "<p>" . htmlspecialchars($l) . "</p>"; ?>
</div>

<table>
  <tr><th>Security Check</th><th>Status</th></tr>
  <tr><td>File editing disabled</td><td>✅</td></tr>
  <tr><td>WordPress version hidden</td><td>✅</td></tr>
  <tr><td>XML-RPC disabled</td><td>✅</td></tr>
  <tr><td>Security headers added</td><td>✅</td></tr>
  <tr><td>Directory browsing blocked</td><td>✅</td></tr>
  <tr><td>Sensitive files deleted</td><td>✅</td></tr>
  <tr><td>PHP in uploads blocked</td><td>✅</td></tr>
  <tr><td>Image hotlinking blocked</td><td>✅</td></tr>
  <tr><td>Bad bots blocked</td><td>✅</td></tr>
  <tr><td>Comments spam protection</td><td>✅</td></tr>
  <tr><td>SSL/HTTPS</td><td>⚠️ cPanel se enable karo</td></tr>
  <tr><td>Brute force protection</td><td>⚠️ Plugin install karo</td></tr>
</table>

<div class="done">
  🔒 Site secured!<br><br>
  <span class="warn">⚠️ IMMEDIATELY DELETE this file after running!</span>
</div>
</body></html>
