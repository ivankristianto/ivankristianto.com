<?php

global $calibrefx;

$calibrefx->hooks->move( 'calibrefx_post_content', 'calibrefx_before_post_title', 'calibrefx_do_post_image' );
$calibrefx->hooks->add( 'calibrefx_before_post_title', 'min_show_adsense', 11 );

function min_show_adsense() {
	$adsense_code = calibrefx_get_option( 'adsense_before_image' );
	if ( $adsense_code and is_single() ) {
		echo "<div class='ads-after-image'>" . cap_attr( $adsense_code ) . '</div>';
	}
}

add_filter( 'calibrefx_title', 'no_space_title', 90, 3 );
function no_space_title( $title, $inside, $wrap = '' ) {
	// Set what goes inside the wrapping tags
	$inside = sprintf( '<a href="%s" title="%s" class="site-title">%s</a>', trailingslashit( home_url() ), esc_attr( get_bloginfo( 'name' ) ), str_replace( ' ', '', get_bloginfo( 'name' ) ) );

	// Build the Title
	if ( is_home() || is_front_page() ) {
		$title = sprintf( '<h1 id="title" class="site-title">%s</h1>', $inside );
	} else {
		$title = sprintf( '<h2 id="title" class="site-title">%s</h2>', $inside );
	}

	return $title;
}
