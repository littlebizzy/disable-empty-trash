<?php
/*
Plugin Name: Disable Empty Trash
Plugin URI: https://www.littlebizzy.com/plugins/disable-empty-trash
Description: Stops WordPress emptying trash
Version: 2.0.2
Requires PHP: 7.0
Author: LittleBizzy
Author URI: https://www.littlebizzy.com
License: GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
GitHub Plugin URI: littlebizzy/disable-empty-trash
Primary Branch: master
*/

// prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// disable wordpress.org updates for this plugin
add_filter( 'gu_override_dot_org', function( $overrides ) {
    $overrides[] = 'disable-empty-trash/disable-empty-trash.php';
    return $overrides;
}, 999 );

// disable automatic trash emptying
function disable_empty_trash() {
    // Remove the scheduled action for emptying trash
    remove_action('wp_scheduled_delete', 'wp_scheduled_delete');
}

// Hook the function to 'init' with high priority
add_action('init', 'disable_empty_trash', -999);

// Ref: ChatGPT
