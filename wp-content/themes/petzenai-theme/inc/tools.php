<?php
/**
 * PetZenAI Tools Loader
 * Loads all 6 tool shortcodes from inc/tools/ folder.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$pz_tools = [
    'food-calculator',
    'age-calculator',
    'vaccine-tracker',
    'name-generator',
    'exercise-calculator',
    'pet-quiz',
];

foreach ( $pz_tools as $tool ) {
    $file = get_template_directory() . '/inc/tools/' . $tool . '.php';
    if ( file_exists( $file ) ) {
        require_once $file;
    }
}
