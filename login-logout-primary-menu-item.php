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
 * Version:           0.5.0
 * Domain Path:       /languages
 * Text Domain:       login-logout-primary-menu-item
 * License:           MIT
 * GitHub Plugin URI: https://github.com/afragen/login-logout-primary-menu-item
 * Requires PHP:      7.2
 * Requires at least: 5.2
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
	15,
	2
);

/**
 * Filter to target block navigation menu items.
 *
 * @since WP 6.1.0 / Gutenberg 14.1.x
 */
add_filter(
	'block_core_navigation_render_inner_blocks',
	function( $inner_blocks ) {
		$count = $inner_blocks->count();
		if ( 0 < $count ) {
			$login_logout = [
				'blockName'    => 'core/navigation-link',
				'attrs'        => [
					'className'     => ' menu-item menu-item-type-custom menu-item-object-custom',
					'description'   => __( 'Add login/logout menu item', 'login-logout-primary-menu-item' ),
					'id'            => $count + 1,
					'kind'          => 'custom',
					'label'         => is_user_logged_in() ? __( 'Log out', 'login-logout-primary-menu-item' ) : __( 'Log in', 'login-logout-primary-menu-item' ),
					'opensInNewTab' => false,
					'rel'           => null,
					'title'         => __( 'Login/logout menu item', 'login-logout-primary-menu-item' ),
					'type'          => 'custom',
					'url'           => is_user_logged_in() ? wp_logout_url( 'index.php' ) : wp_login_url( 'index.php' ),
				],
				'innerBlocks'  => [],
				'innerHTML'    => '',
				'innerContent' => [],
			];
		}
		$inner_blocks->offsetSet( null, $login_logout );

		return $inner_blocks;
	}
);
