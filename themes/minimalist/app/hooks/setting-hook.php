<?php

function min_adsense_box() {
	global $calibrefx;

	calibrefx_add_meta_box( 'general', 'basic', 'calibrefx-theme-settings-adsense', __( 'Google Adsense Code', 'calibrefx' ), 'adsense_setting', $calibrefx->theme_settings->pagehook, 'main' );
}
add_action( 'calibrefx_theme_settings_meta_box', 'min_adsense_box' );

function adsense_setting() {
	global $calibrefx;

	calibrefx_add_meta_group( 'adsense-code-settings', 'adsense-code-settings', __( 'Google Adsense Settings', 'calibrefx' ) );
	add_action(
		'adsense-code-settings_options', function() {
			calibrefx_add_meta_option(
				'adsense-code-settings',  // group id
				'adsense_before_image', // field id and option name
				__( 'Google Ad Client ID', 'calibrefx' ), // Label
				array(
					'option_type'        => 'textinput',
					'option_default'     => '',
					'option_filter'      => 'no_html',
					'option_description' => __( 'Google Auto Ads Script', 'calibrefx' ),
				), // Settings config
				5 //Priority
			);
		}
	);

	calibrefx_do_meta_options( $calibrefx->theme_settings, 'adsense-code-settings' );
}

