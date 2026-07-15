<?php
/*
Plugin Name: Disable Empty Trash
Plugin URI: https://www.littlebizzy.com/plugins/disable-empty-trash
Description: Stops WordPress emptying trash
Version: 2.1.0
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

// return 100 years for plugins or custom code reading the single-site option
add_filter( 'pre_option_empty_trash_days', 'disable_empty_trash_days' );

// return 100 years for plugins or custom code reading the Multisite option
add_filter( 'pre_site_option_empty_trash_days', 'disable_empty_trash_days' );

// WordPress core uses EMPTY_TRASH_DAYS instead of either option above
function disable_empty_trash_days() {
    return 36500;
}

// disable core cleanup without trying to redefine EMPTY_TRASH_DAYS after wp-config.php loads
// this works when the constant is custom-defined (such as SlickStack) or left at the WordPress default
// manual Empty Trash actions remain available
function disable_empty_trash_scheduler() {
    remove_action( 'wp_scheduled_delete', 'wp_scheduled_delete' );
}

// remove the core callback before the normal cron check runs on init
add_action( 'init', 'disable_empty_trash_scheduler', -999 );
