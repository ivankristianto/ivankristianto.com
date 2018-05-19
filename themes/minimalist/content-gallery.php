<?php
/**
 * Post Format: Gallery
 */


add_filter( 'the_content', 'gallery_display', 11 );
add_filter( 'the_content', 'force_comment' );
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content row">
		<div class="author col-md-1 col-sm-2 col-xs-3">
			<?php
				echo get_avatar( get_the_author_meta( 'email' ), 70 );
			?>
		</div>
		<div class="status col-md-11 col-sm-10 col-xs-9">
			<h2 class="entry-title"><?php echo get_the_title(); ?></h2>
			<div class="published-date"><?php echo do_shortcode( '[post_date format="relative"]' ); ?></div>
			<?php
				the_content();
			?>
			<?php comments_template( '/simple-comments.php' ); ?>
		</div>
	</div><!-- end .entry-content -->

</div><!-- end .postclass -->
