<?php
/**
 * Login Logout Primary Menu Item
 *
 * @package login-logout-primary-menu-item
 * @author Andy Fragen <andy@thefragens.com>
 * @license MIT
 * @link https://github.com/afragen/login-logout-primary-menu-item
 */

/**
 * Plugin Name:       Login Logout Primary Menu Item
 * Plugin URI:        https://github.com/afragen/login-logout-primary-menu-item
 * Author:            Andy Fragen
 * Author URI:        http://thefragens.com/
 * Description:       Adds a login/logout menu item to the primary menu.
 * Version:           0.1.0
 * Domain Path:       /languages
 * Text Domain:       login-logout-primary-menu-item
 * License:           MIT
 * GitHub Plugin URI: https://github.com/afragen/login-logout-primary-menu-item
 * Requires PHP:      5.6
 * Requires at least: 4.6
 */

// need to add code to create 'Loginout' menu.

add_filter(
	'wp_nav_menu_items',
	function ( $items, $args ) {
		$items .= '<li class="menu-item">' . \wp_loginout( 'index.php', false ) . '</li>';

		return $items;
	},
	10,
	2
);
