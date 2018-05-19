<?php
/**
 * This admin hook only run in admin area
 */

// This function adds the top-level menu
function calibrefx_register_admin_menu() {
	global $menu, $calibrefx;

	$calibrefx->load->library( 'theme_settings' );

	$calibrefx->theme_settings->pagehook = add_theme_page( __( 'Theme Settings', 'calibrefx' ), 'Theme Settings', 'edit_theme_options', 'calibrefx', array( $calibrefx->theme_settings, 'dashboard' ) );
}
add_action( 'admin_menu', 'calibrefx_register_admin_menu' );
