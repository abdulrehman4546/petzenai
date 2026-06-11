<?php
define('ABSPATH_CHECK', true);
require_once __DIR__ . '/wp-load.php';

if (!current_user_can('manage_options')) {
    // Allow direct run via token for CLI deploy
    $token = isset($_GET['token']) ? $_GET['token'] : '';
    if ($token !== 'pz_rm_fix_2026') {
        die('Unauthorized');
    }
}

$option = get_option('rank_math_titles', []);

$before = isset($option['noindex_empty_taxonomies']) ? $option['noindex_empty_taxonomies'] : 'not set';

$option['noindex_empty_taxonomies'] = 'off';

update_option('rank_math_titles', $option);

$after = get_option('rank_math_titles')['noindex_empty_taxonomies'];

echo "<pre>";
echo "Rank Math Fix\n";
echo "=============\n";
echo "noindex_empty_taxonomies BEFORE: " . $before . "\n";
echo "noindex_empty_taxonomies AFTER:  " . $after . "\n";
echo "\nDone! Category pages will now be indexed by Google.\n";
echo "</pre>";
