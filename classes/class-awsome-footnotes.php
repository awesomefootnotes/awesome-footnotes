<?php
/**
 * Responsible for plugin initialization.
 *
 * @package    fme
 * @copyright  %%YEAR%% Footnotes
 * @license    https://www.apache.org/licenses/LICENSE-2.0 Apache License 2.0
 * @link       https://wordpress.org/plugins/awesome-footnotes/
 *
 * @since      2.0.0
 */

declare(strict_types=1);

namespace AWEFOOT;

use AWEFOOT\Helpers\Settings;
use AWEFOOT\Controllers\Footnotes_Formatter;
use AWEFOOT\Helpers\Context_Helper;

if ( ! class_exists( '\AWEFOOT\Awesome_Footnotes' ) ) {

	/**
	 * Main plugin class
	 *
	 * @since 2.0.0
	 */
	class Awesome_Footnotes {

		public const REDIRECT_OPTION_NAME = 'awefoot_plugin_do_activation_redirect';

		/**
		 * Inits the class and hooks
		 *
		 * @since 2.0.0
		 */
		public static function init() {
			if ( \is_admin() ) {

				\add_filter( 'plugin_action_links', array( __CLASS__, 'add_settings_link' ), 10, 2 );
				\add_filter( 'plugin_row_meta', array( __CLASS__, 'plugin_meta' ), 10, 2 );

				Settings::init();

				// Hide all unrelated to the plugin notices on the plugin admin pages.
				\add_action( 'admin_print_scripts', array( __CLASS__, 'hide_unrelated_notices' ) );
			} else {
				Footnotes_Formatter::init();
			}
		}

		/**
		 * Add Settings link to plugin list
		 *
		 * Add a Settings link to the options listed against this plugin
		 *
		 * @param array  $links  Current links.
		 * @param string $file   File in use.
		 *
		 * @return string          Links, now with settings added.
		 *
		 * @since 2.0.0
		 */
		public static function add_settings_link( $links, $file ) {
			if ( AWEFOOT_PLUGIN_BASENAME === $file ) {
				$settings_link = '<a href="' . Settings::get_settings_page_link() . '">' . __( 'Settings', 'awesome-footnotes' ) . '</a>';
				array_unshift( $links, $settings_link );
			}

			return $links;
		}

		/**
		 * Add meta to plugin details
		 *
		 * Add options to plugin meta line
		 *
		 * @param string $links  Current links.
		 * @param string $file   File in use.
		 *
		 * @return string Links, now with settings added.
		 *
		 * @since 2.0.0
		 */
		public static function plugin_meta( $links, $file ) {

			if ( false !== strpos( $file, 'awesome-footnotes.php' ) ) {
				$links = array_merge( $links, array( '<a href="https://wordpress.org/support/plugin/awesome-footnotes">' . __( 'Support', 'awesome-footnotes' ) . '</a>' ) );
			}

			return $links;
		}

		/**
		 * Check whether we are on an admin and plugin page.
		 *
		 * @since 2.0.0
		 *
		 * @return bool
		 */
		public static function is_admin_page() {

			return false;
		}

		/**
		 * Remove all non-WP Mail SMTP plugin notices from our plugin pages.
		 *
		 * @since 2.0.0
		 */
		public static function hide_unrelated_notices() {
			// Bail if we're not on our screen or page.
			if ( ! self::is_admin_page() ) {
				return;
			}

			self::remove_unrelated_actions( 'user_admin_notices' );
			self::remove_unrelated_actions( 'admin_notices' );
			self::remove_unrelated_actions( 'all_admin_notices' );
			self::remove_unrelated_actions( 'network_admin_notices' );
		}

		/**
		 * Remove all fme notices from the our plugin pages based on the provided action hook.
		 *
		 * @since 2.0.0
		 *
		 * @param string $action - The name of the action.
		 */
		public static function remove_unrelated_actions( $action ) {
			global $wp_filter;

			if ( empty( $wp_filter[ $action ]->callbacks ) || ! is_array( $wp_filter[ $action ]->callbacks ) ) {
				return;
			}

			foreach ( $wp_filter[ $action ]->callbacks as $priority => $hooks ) {
				foreach ( $hooks as $name => $arr ) {
					if (
					( // Cover object method callback case.
						is_array( $arr['function'] ) &&
						isset( $arr['function'][0] ) &&
						is_object( $arr['function'][0] ) &&
						false !== strpos( ( get_class( $arr['function'][0] ) ), 'AWEFOOT' )
					) ||
					( // Cover class static method callback case.
						! empty( $name ) &&
						false !== strpos( ( $name ), 'AWEFOOT' )
					)
					) {
						continue;
					}

					unset( $wp_filter[ $action ]->callbacks[ $priority ][ $name ] );
				}
			}
		}

		/**
		 * Adds a powered-by message in the footer of the page.
		 *
		 * @return void
		 *
		 * @since 2.0.0
		 */
		public static function powered_by() {
			if ( Context_Helper::is_front() ) {
				?><!--
				<?php
				printf(
					/* Translators: Plugin link. */
					esc_html__( 'Proudly powered by %s', 'awesome-footnotes' ),
					'<a href="' . esc_url( __( 'https://wordpress.org/plugins/awesome-footnotes/', 'awesome-footnotes' ) ) . '" rel="nofollow">' . \esc_attr( AWEFOOT_NAME ) . '</a>'
				);
				?>
				-->
				<?php
			}
		}

		/**
		 * Registers a plugin redirection on activate setting.
		 *
		 * @return void
		 *
		 * @since 2.4.0
		 */
		public static function plugin_activate() {
			\add_option( self::REDIRECT_OPTION_NAME, true );
		}
	}
}
