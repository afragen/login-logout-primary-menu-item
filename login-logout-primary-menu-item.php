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
 * Version:           0.4.0
 * Domain Path:       /languages
 * Text Domain:       login-logout-primary-menu-item
 * License:           MIT
 * GitHub Plugin URI: https://github.com/afragen/login-logout-primary-menu-item
 * Requires PHP:      5.6
 * Requires at least: 4.6
 */

/**
 * Filter to target only a primary menu.
 * This should not target custom nav walkers.
 */
add_filter(
	'wp_nav_menu_items',
	function ( $items, $args ) {
		if ( ( 'wp_page_menu' === $args->fallback_cb && empty( $args->walker ) )
			|| false !== strpos( $args->theme_location, 'primary' )
			|| false !== strpos( $args->menu->slug, 'default' )
			|| false !== strpos( $args->menu->slug, 'primary' )
		) {
			$items .= '<li class="menu-item">' . \wp_loginout( 'index.php', false ) . '</li>';
		}

		return $items;
	},
	10,
	2
);
