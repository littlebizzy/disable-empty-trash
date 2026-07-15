<?php
/*
Plugin Name: Disable Empty Trash
Plugin URI: https://www.littlebizzy.com/plugins/disable-empty-trash
Description: Stops WordPress emptying trash
Version: 2.1.1
Requires PHP: 7.0
Tested up to: 6.9
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

// disable WordPress core automatic trash cleanup regardless of EMPTY_TRASH_DAYS
// works with custom wp-config.php values (such as SlickStack) or the WordPress default
// manual Empty Trash actions remain available
function disable_empty_trash_scheduler() {
    remove_action( 'wp_scheduled_delete', 'wp_scheduled_delete' );
}

// remove the core callback before the normal cron check runs on init
add_action( 'init', 'disable_empty_trash_scheduler', -999 );
