<?php
/**
 * Advanced settings of the plugin
 *
 * @package fme
 *
 * @since 2.0.0
 */

use FME\Helpers\Settings;

Settings::build_option(
	array(
		'title' => esc_html__( 'Advanced Settings', 'awesome-footnotes' ),
		'id'    => 'advanced-settings-tab',
		'type'  => 'tab-title',
	)
);

Settings::build_option(
	array(
		'type'  => 'header',
		'id'    => 'advanced-settings',
		'title' => esc_html__( 'Advanced Settings', 'awesome-footnotes' ),
	)
);

	// Pretty tooltips formatting.
	Settings::build_option(
		array(
			'title' => esc_html__( 'Where to put this settings page?', 'awesome-footnotes' ),
			'id'    => 'jquery-pretty-tooltips-format-settings',
			'type'  => 'header',
		)
	);

	Settings::build_option(
		array(
			'type'  => 'header',
			'id'    => 'reset-all-settings',
			'title' => esc_html__( 'Reset All Settings', 'awesome-footnotes' ),
		)
	);

	Settings::build_option(
		array(
			'title' => esc_html__( 'Markup', 'awesome-footnotes' ),
			'id'    => 'reset-settings-hint',
			'type'  => 'hint',
			'hint'  => esc_html__( 'This is destructive operation, which can not be undone! You may want to export your current settings first.', 'awesome-footnotes' ),
		)
	);

	?>

	<div class="option-item">
		<a id="fme-reset-settings" class="fme-primary-button button button-primary button-hero fme-button-red" href="<?php print \esc_url( \wp_nonce_url( \admin_url( 'admin.php?page=' . self::MENU_SLUG . '&reset-settings' ), 'reset-plugin-settings', 'reset_nonce' ) ); ?>" data-message="<?php esc_html_e( 'This action can not be undone. Clicking "OK" will reset your plugin options to the default installation. Click "Cancel" to stop this operation.', 'awesome-footnotes' ); ?>"><?php esc_html_e( 'Reset All Settings', 'awesome-footnotes' ); ?></a>
	</div>

