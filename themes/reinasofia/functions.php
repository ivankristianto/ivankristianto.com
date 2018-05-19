<?php
/**
 * WP Theme constants and setup functions
 */

// Useful global constants.
define( 'REINASOFIA_VERSION',      '0.1.0' );
define( 'REINASOFIA_URL',          get_stylesheet_directory_uri() );
define( 'REINASOFIA_TEMPLATE_URL', get_template_directory_uri() );
define( 'REINASOFIA_PATH',         get_template_directory() . '/' );
define( 'REINASOFIA_INC',          REINASOFIA_PATH . 'includes/' );

require_once REINASOFIA_INC . 'core.php';
require_once REINASOFIA_INC . 'template-tags.php';

// Run the setup functions.
Reinasofia\Core\setup();

// Require Composer autoloader if it exists.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once 'vendor/autoload.php';
}
