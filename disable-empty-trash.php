<?php
/*
Plugin Name: Disable Empty Trash
Plugin URI: https://www.littlebizzy.com/plugins/disable-empty-trash
Description: Stops WordPress emptying trash
Version: 2.2.0
Requires PHP: 7.0
Tested up to: 7.0
Author: LittleBizzy
Author URI: https://www.littlebizzy.com
License: GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
Update URI: false
Text Domain: disable-empty-trash
GitHub Plugin URI: littlebizzy/disable-empty-trash
Primary Branch: master
*/

// block direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// override WordPress.org with Git Updater
add_filter( 'gu_override_dot_org', function( $overrides ) {
    $overrides[] = 'disable-empty-trash/disable-empty-trash.php';
    return $overrides;
}, 999 );

// disable WordPress core automatic trash cleanup regardless of EMPTY_TRASH_DAYS
function disable_empty_trash_scheduler() {
    remove_action( 'wp_scheduled_delete', 'wp_scheduled_delete' );
}

// remove WordPress core scheduled trash cleanup callback during init
add_action( 'init', 'disable_empty_trash_scheduler', -999 );
