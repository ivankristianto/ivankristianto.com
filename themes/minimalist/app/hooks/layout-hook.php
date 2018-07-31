<?php

global $calibrefx;

$calibrefx->hooks->move( 'calibrefx_post_content', 'calibrefx_before_post_title', 'calibrefx_do_post_image' );
$calibrefx->hooks->add( 'wp_head', 'min_show_adsense', 11 );

function min_show_adsense() {
	$adsense_code = calibrefx_get_option( 'adsense_before_image' );
	?>
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<script>
			(adsbygoogle = window.adsbygoogle || []).push({
				google_ad_client: "<?php echo esc_html( $adsense_code ); ?>",
				enable_page_level_ads: true
			});
	</script>
	<?php
}

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
add_filter( 'calibrefx_title', 'no_space_title', 90, 3 );
