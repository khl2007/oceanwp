<?php
/**
 * Single related posts
 *
 * @package OceanWP WordPress theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Text
$text = esc_html__( 'You Might Also Like', 'oceanwp' );

// Apply filters for child theming
$text = apply_filters( 'ocean_related_posts_title', $text );

// Number of columns for entries
$oceanwp_columns = apply_filters( 'ocean_related_blog_posts_columns', get_theme_mod( 'ocean_blog_related_columns', '3' ) );

// Create an array of current category ID's
$cats     = wp_get_post_terms( get_the_ID(), 'category' );
$cats_ids = array();
foreach( $cats as $oceanwp_related_cat ) {
	$cats_ids[] = $oceanwp_related_cat->term_id;
}

// Query args
$args = array(
	'posts_per_page' => apply_filters( 'ocean_related_blog_posts_count', get_theme_mod( 'ocean_blog_related_count', '3' ) ),
	'orderby'        => 'rand',
	'category__in'   => $cats_ids,
	'post__not_in'   => array( get_the_ID() ),
	'no_found_rows'  => true,
	'tax_query'      => array (
		'relation'  => 'AND',
		array (
			'taxonomy' => 'post_format',
			'field'    => 'slug',
			'terms'    => array( 'post-format-quote', 'post-format-link' ),
			'operator' => 'NOT IN',
		),
	),
);
$args = apply_filters( 'ocean_blog_post_related_query_args', $args );

// Related query arguments
$oceanwp_related_query = new WP_Query( $args );

// If the custom query returns post display related posts section
if ( $oceanwp_related_query->have_posts() ) :

	// Wrapper classes
	$classes = 'clr';
	if ( 'full-screen' == oceanwp_post_layout() ) {
		$classes .= ' container';
	} ?>

	<div id="related-posts" class="<?php echo esc_attr( $classes ); ?>">

		<h3 class="theme-heading related-posts-title">
			<span class="text"><?php echo esc_html( $text ); ?></span>
		</h3>

		<div class="oceanwp-row clr">

			<?php $oceanwp_count = 0; ?>

			<?php foreach( $oceanwp_related_query->posts as $post ) : setup_postdata( $post ); ?>

				<?php $oceanwp_count++;

				// Disable embeds
				$show_embeds = apply_filters( 'ocean_related_blog_posts_embeds', false );

				// Get post format
				$format = get_post_format();

				// Add classes
				$classes	= array( 'related-post', 'clr', 'col' );
				$classes[]	= oceanwp_grid_class( $oceanwp_columns );
				$classes[]	= 'col-'. $oceanwp_count; ?>

				<article <?php post_class( $classes ); ?>>

					<?php
					// Display post video
					if ( $show_embeds && 'video' == $format && $video = oceanwp_get_post_video_html() ) : ?>

						<div class="related-post-video">
							<?php echo $video; ?>
						</div><!-- .related-post-video -->

					<?php
					// Display post audio
					elseif ( $show_embeds && 'audio' == $format && $audio = oceanwp_get_post_audio_html() ) : ?>

						<div class="related-post-video">
							<?php echo $audio; ?>
						</div><!-- .related-post-audio -->

					<?php
					// Display post thumbnail
					elseif ( has_post_thumbnail() ) : ?>

						<figure class="related-post-media clr">

							<a href="<?php the_permalink(); ?>" class="related-thumb">

								<?php
								// Image width
								$img_width  = apply_filters( 'ocean_related_blog_posts_img_width', get_theme_mod( 'ocean_blog_related_img_width' ) );
								$img_height = apply_filters( 'ocean_related_blog_posts_img_height', get_theme_mod( 'ocean_blog_related_img_height' ) );

			                	// Images attr
								$img_id 	= get_post_thumbnail_id( get_the_ID(), 'full' );
								$img_url 	= wp_get_attachment_image_src( $img_id, 'full', true );
								if ( OCEAN_EXTRA_ACTIVE
									&& function_exists( 'ocean_extra_image_attributes' ) ) {
									$img_atts 	= ocean_extra_image_attributes( $img_url[1], $img_url[2], $img_width, $img_height );
								}

								// If Ocean Extra is active and has a custom size
								if ( OCEAN_EXTRA_ACTIVE
									&& function_exists( 'ocean_extra_resize' )
									&& ! empty( $img_atts ) ) { ?>

									<img src="<?php echo ocean_extra_resize( $img_url[0], $img_atts[ 'width' ], $img_atts[ 'height' ], $img_atts[ 'crop' ], true, $img_atts[ 'upscale' ] ); ?>" alt="<?php esc_attr( the_title() ); ?>" width="<?php echo esc_attr( $img_width ); ?>" height="<?php echo esc_attr( $img_height ); ?>" itemprop="image" />

								<?php
								} else {

									// Images size
									if ( 'full-width' == oceanwp_post_layout()
										|| 'full-screen' == oceanwp_post_layout() ) {
										$size = 'medium_large';
									} else {
										$size = 'medium';
									}

									// Display post thumbnail
									the_post_thumbnail( $size, array(
										'alt'		=> get_the_title(),
										'itemprop' 	=> 'image',
									) );

								} ?>
							</a>

						</figure>

					<?php endif; ?>

					<h2 class="related-post-title">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
					</h2><!-- .related-post-title -->
									
					<time class="published" datetime="<?php echo esc_html( get_the_date( 'c' ) ); ?>"><i class="icon-clock"></i><?php echo esc_html( get_the_date() ); ?></time>

				</article><!-- .related-post -->
				
				<?php if ( $oceanwp_columns == $oceanwp_count ) $oceanwp_count=0; ?>

			<?php endforeach; ?>

		</div><!-- .oceanwp-row -->

	</div><!-- .related-posts -->

<?php endif; ?>

<?php wp_reset_postdata(); ?>