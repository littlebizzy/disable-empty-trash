<?php
/*
Plugin Name: Disable Empty Trash
Plugin URI: https://www.littlebizzy.com/plugins/disable-empty-trash
Description: Stops WordPress emptying trash
Version: 2.0.3
Requires PHP: 7.0
Tested up to: 6.7
Author: LittleBizzy
Author URI: https://www.littlebizzy.com
License: GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
Update URI: false
GitHub Plugin URI: littlebizzy/disable-empty-trash
Primary Branch: master
Text Domain: disable-empty-trash
*/

// prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// override wordpress.org with git updater
add_filter( 'gu_override_dot_org', function( $overrides ) {
    $overrides[] = 'disable-empty-trash/disable-empty-trash.php';
    return $overrides;
}, 999 );

// disable automatic trash emptying
function disable_empty_trash() {
    static $disabled = false;
    if ( $disabled ) {
        return;
    }
    $disabled = true;
    
    // remove scheduled trash deletion
    remove_action( 'wp_scheduled_delete', 'wp_scheduled_delete' );
}

// hook to init with high priority
add_action( 'init', 'disable_empty_trash', -999 );


// Ref: ChatGPT
