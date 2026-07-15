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

// compatibility backstop for plugins reading a single-site retention option
add_filter( 'pre_option_empty_trash_days', 'disable_empty_trash_days' );

// compatibility backstop for plugins reading a Multisite retention option
add_filter( 'pre_site_option_empty_trash_days', 'disable_empty_trash_days' );

// match SlickStack's default 100-year retention without redefining EMPTY_TRASH_DAYS
function disable_empty_trash_days() {
    return 36500;
}

// disable WordPress core automatic cleanup on single-site and Multisite installations
// manual Empty Trash actions remain available
function disable_empty_trash_scheduler() {
    remove_action( 'wp_scheduled_delete', 'wp_scheduled_delete' );
}

// remove the core callback before the normal cron check runs on init
add_action( 'init', 'disable_empty_trash_scheduler', -999 );
