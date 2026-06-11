<?php
/**
 * PetZenAI — Fix Missing Featured Images
 * Finds posts without featured images and assigns free stock images.
 * DELETE after running!
 */
if (!isset($_GET['token']) || $_GET['token'] !== 'pz_img_fix_2026') die('Unauthorized');

$_SERVER['HTTP_HOST']   = 'petzenai.com';
$_SERVER['REQUEST_URI'] = '/pz-fix-images.php';
require_once __DIR__ . '/wp-load.php';
set_time_limit(600);

require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/image.php';

echo "<!DOCTYPE html><html><head><meta charset='UTF-8'>
<style>body{font-family:monospace;font-size:13px;background:#0D0D0D;color:#E8E8E8;padding:24px;line-height:2}
.ok{color:#4CAF50}.skip{color:#888}.err{color:#F44336}.h{color:#FF6B1A;font-size:16px;font-weight:bold}</style></head><body>";
echo "<div class='h'>🐾 PetZenAI — Fixing Missing Featured Images</div><br>";
flush();

// ── Free stock image map (keyword → Unsplash permanent URL) ─────────────────
$image_map = [
    // Dogs
    'dog'          => 'https://images.unsplash.com/photo-1587300003388-59208cc962cb?w=1200&h=630&fit=crop&q=80',
    'puppy'        => 'https://images.unsplash.com/photo-1601979031925-424e53b6caaa?w=1200&h=630&fit=crop&q=80',
    'dog health'   => 'https://images.unsplash.com/photo-1548199973-03cce0bbc87b?w=1200&h=630&fit=crop&q=80',
    'dog training' => 'https://images.unsplash.com/photo-1587300003388-59208cc962cb?w=1200&h=630&fit=crop&q=80',
    'dog grooming' => 'https://images.unsplash.com/photo-1599443015574-be5fe8a05783?w=1200&h=630&fit=crop&q=80',
    'dog age'      => 'https://images.unsplash.com/photo-1534361960057-19f4434a29d1?w=1200&h=630&fit=crop&q=80',
    'dog anxiety'  => 'https://images.unsplash.com/photo-1548199973-03cce0bbc87b?w=1200&h=630&fit=crop&q=80',
    'dog food'     => 'https://images.unsplash.com/photo-1601979031925-424e53b6caaa?w=1200&h=630&fit=crop&q=80',
    'dog behavior' => 'https://images.unsplash.com/photo-1587300003388-59208cc962cb?w=1200&h=630&fit=crop&q=80',
    // Cats
    'cat'          => 'https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?w=1200&h=630&fit=crop&q=80',
    'kitten'       => 'https://images.unsplash.com/photo-1561948955-570b270e7c36?w=1200&h=630&fit=crop&q=80',
    'cat health'   => 'https://images.unsplash.com/photo-1574158622682-e40e69881006?w=1200&h=630&fit=crop&q=80',
    'cat food'     => 'https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?w=1200&h=630&fit=crop&q=80',
    'cat care'     => 'https://images.unsplash.com/photo-1561948955-570b270e7c36?w=1200&h=630&fit=crop&q=80',
    'cat nutrition'=> 'https://images.unsplash.com/photo-1574158622682-e40e69881006?w=1200&h=630&fit=crop&q=80',
    // Birds
    'bird'         => 'https://images.unsplash.com/photo-1444464666168-49d633b86797?w=1200&h=630&fit=crop&q=80',
    'parrot'       => 'https://images.unsplash.com/photo-1552728089-57bdde30beb3?w=1200&h=630&fit=crop&q=80',
    // Fish / Aquatic
    'fish'         => 'https://images.unsplash.com/photo-1535591273668-578e31182c4f?w=1200&h=630&fit=crop&q=80',
    'aquarium'     => 'https://images.unsplash.com/photo-1583212292454-1fe6229603b7?w=1200&h=630&fit=crop&q=80',
    'aquatic'      => 'https://images.unsplash.com/photo-1535591273668-578e31182c4f?w=1200&h=630&fit=crop&q=80',
    // Reptiles
    'reptile'      => 'https://images.unsplash.com/photo-1504450874802-0ba2bcd9b5ae?w=1200&h=630&fit=crop&q=80',
    'gecko'        => 'https://images.unsplash.com/photo-1504450874802-0ba2bcd9b5ae?w=1200&h=630&fit=crop&q=80',
    'snake'        => 'https://images.unsplash.com/photo-1516728778615-2d590ea1855e?w=1200&h=630&fit=crop&q=80',
    'lizard'       => 'https://images.unsplash.com/photo-1504450874802-0ba2bcd9b5ae?w=1200&h=630&fit=crop&q=80',
    // Small pets
    'rabbit'       => 'https://images.unsplash.com/photo-1585110396000-c9ffd4e4b308?w=1200&h=630&fit=crop&q=80',
    'hamster'      => 'https://images.unsplash.com/photo-1425082661705-1834bfd09dca?w=1200&h=630&fit=crop&q=80',
    'guinea pig'   => 'https://images.unsplash.com/photo-1548767797-d8c844163c4a?w=1200&h=630&fit=crop&q=80',
    'small pet'    => 'https://images.unsplash.com/photo-1425082661705-1834bfd09dca?w=1200&h=630&fit=crop&q=80',
    // General
    'pet health'   => 'https://images.unsplash.com/photo-1587300003388-59208cc962cb?w=1200&h=630&fit=crop&q=80',
    'pet care'     => 'https://images.unsplash.com/photo-1548199973-03cce0bbc87b?w=1200&h=630&fit=crop&q=80',
    'vaccine'      => 'https://images.unsplash.com/photo-1548199973-03cce0bbc87b?w=1200&h=630&fit=crop&q=80',
    'default'      => 'https://images.unsplash.com/photo-1444464666168-49d633b86797?w=1200&h=630&fit=crop&q=80',
];

// ── Get best image URL for a post ────────────────────────────────────────────
function pz_get_image_url($title, $category, $image_map) {
    $text = strtolower($title . ' ' . $category);
    foreach ($image_map as $keyword => $url) {
        if ($keyword === 'default') continue;
        if (strpos($text, $keyword) !== false) return $url;
    }
    return $image_map['default'];
}

// ── Attach image from URL ────────────────────────────────────────────────────
function pz_sideload($img_url, $post_id, $title) {
    $tmp = download_url($img_url);
    if (is_wp_error($tmp)) return false;
    $file_arr = ['name' => sanitize_title($title) . '.jpg', 'tmp_name' => $tmp];
    $attach_id = media_handle_sideload($file_arr, $post_id, $title);
    if (is_wp_error($attach_id)) { @unlink($tmp); return false; }
    update_post_meta($attach_id, '_wp_attachment_image_alt', $title);
    return $attach_id;
}

// ── Find posts missing featured images ──────────────────────────────────────
$posts = get_posts([
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'meta_query'     => [[
        'key'     => '_thumbnail_id',
        'compare' => 'NOT EXISTS',
    ]],
]);

echo "<b>Posts missing featured image: " . count($posts) . "</b><br><br>";
flush();

if (empty($posts)) {
    echo "<span class='ok'>✅ All posts already have featured images!</span><br>";
} else {
    foreach ($posts as $p) {
        $cats     = wp_get_post_categories($p->ID, ['fields' => 'names']);
        $cat_name = !empty($cats) ? $cats[0] : '';
        $img_url  = pz_get_image_url($p->post_title, $cat_name, $image_map);

        $attach_id = pz_sideload($img_url, $p->ID, $p->post_title);
        if ($attach_id) {
            set_post_thumbnail($p->ID, $attach_id);
            echo "<span class='ok'>✅ Fixed: <b>{$p->post_title}</b> (ID {$p->ID})</span><br>";
        } else {
            echo "<span class='err'>❌ Failed: {$p->post_title}</span><br>";
        }
        flush();
    }
}

echo "<br><b class='ok'>✅ Done! Delete this file: /pz-fix-images.php</b>";
echo "</body></html>";
