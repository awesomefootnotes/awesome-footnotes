<?php
/**
 * Uninstaller
 *
 * Uninstall the plugin by removing any options from the database
 *
 * @package  fme
 * @since    1.0
 */

use AWEFOOT\Helpers\Settings;

// If the uninstall was not called by WordPress, exit.

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

require_once __DIR__ . '/awesome-footnotes.php';

// Delete any saved data.
\delete_option( AWEFOOT_SETTINGS_NAME );
\delete_option( Settings::SETTINGS_VERSION );