<?php
/*
Plugin Name: Disable Empty Trash
Plugin URI: https://www.littlebizzy.com/plugins/disable-empty-trash
Description: Completely disables the automatic trash empty for WordPress posts, custom posts, pages, and comments to avoid data loss and encourage manual emptying.
Version: 1.0.0
Author: LittleBizzy
Author URI: https://www.littlebizzy.com
License: GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/


/**
 * Define main plugin class
 */
class LB_Disable_Empty_Trash {

	/**
	 * A reference to an instance of this class.
	 *
	 * @since 1.0.0
	 * @var   object
	 */
	private static $instance = null;

	/**
	 * Initalize plugin actions
	 *
	 * @return void
	 */
	public function init() {
		remove_action( 'wp_scheduled_delete', 'wp_scheduled_delete' );
	}

	/**
	 * Returns plugin base file
	 *
	 * @return string
	 */
	public static function file() {
		return __FILE__;
	}

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @return object
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}
}

/**
 * Returns instance of LB_Disable_Empty_Trash class
 *
 * @return object
 */
function lb_disable_empty_trash() {
	return LB_Disable_Empty_Trash::get_instance();
}

/**
 * Initalize plugin instance very early on 'init' hook
 */
add_action( 'init', array( lb_disable_empty_trash(), 'init' ), -999 );
