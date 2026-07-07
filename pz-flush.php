<?php
if ($_GET['token'] !== 'pz_flush_2026') { die('Unauthorized'); }
define('ABSPATH_CHECK', true);
require_once __DIR__ . '/wp-load.php';
flush_rewrite_rules(true);
echo '✅ Rewrite rules flushed! Sitemap should now work at: <a href="/sitemap-clean.xml">/sitemap-clean.xml</a>';
