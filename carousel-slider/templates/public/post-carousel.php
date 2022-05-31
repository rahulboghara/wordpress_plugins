<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

$_image_size       = get_post_meta( $id, '_image_size', true );
$_nav_color        = get_post_meta( $id, '_nav_color', true );
$_nav_active_color = get_post_meta( $id, '_nav_active_color', true );
$_lazy_load_image  = get_post_meta( $id, '_lazy_load_image', true );
?>
<div class="carousel-slider-outer carousel-slider-outer-posts carousel-slider-outer-<?php echo $id; ?>">
	<?php carousel_slider_inline_style( $id ); ?>
	<div <?php echo join( " ", $this->carousel_options( $id ) ); ?>>
		<?php
		$posts = carousel_slider_posts( $id );
		foreach ( $posts as $_post ):
			global $post;
			$post = $_post;
			setup_postdata( $post );
			$category = get_the_category( $post->ID );

			do_action( 'carousel_slider_post_loop', $post, $category );

			$html = '<div class="carousel-slider__post">';
			$html .= '<div class="carousel-slider__post-content">';
			$html .= '<div class="carousel-slider__post-header">';
			// Post Thumbnail
			$_permalink = esc_url( get_permalink( $post->ID ) );
			$_thumb_id  = get_post_thumbnail_id( $post->ID );
			$num_words  = apply_filters( 'carousel_slider_post_excerpt_length', 9 );
			$more_text  = apply_filters( 'carousel_slider_post_read_more', ' ...', $post );
			$_excerpt   = wp_trim_words( wp_strip_all_tags( $post->post_content ), $num_words, $more_text );

			$_created  = strtotime( $post->post_date );
			$_modified = strtotime( $post->post_modified );

			if ( has_post_thumbnail( $post ) ) {
				$image_src = wp_get_attachment_image_src( $_thumb_id, $_image_size );

				if ( $_lazy_load_image == 'on' ) {

					$html .= sprintf( '<div class="carousel-slider__post-img"><a href="%s" class="carousel-slider__post-image owl-lazy" data-src="%s"></a>', $_permalink, $image_src[0] );

					$html .= '<div class="carousel-slider__post-details-date">';
					if ( $_created !== $_modified ) {
						$html .= sprintf( '<span class="carousel-slider__post-publication-date" datetime="%s">%s</span>',
							date_i18n( 'c', $_modified ),
							date_i18n(( 'j' ), $_modified )
						);
						$html .= sprintf( '<span class="carousel-slider__post-publication-month" datetime="%s">%s</span>',
							date_i18n( 'c', $_modified ),
							date_i18n(( 'M.' ), $_modified )
						);
					} else {
						$html .= sprintf( '<span class="carousel-slider__post-publication-date" datetime="%s">%s</span>',
							date_i18n( 'c', $_created ),
							date_i18n(( 'j' ), $_created )
						);
						$html .= sprintf( '<span class="carousel-slider__post-publication-month" datetime="%s">%s</span>',
							date_i18n( 'c', $_created ),
							date_i18n(( 'M.' ), $_created )
						);
					}
					$html .= '</div>';
				} else {

					$html .= sprintf( '<div class="carousel-slider__post-img"><a href="%s" class="carousel-slider__post-image" "><img src="%s"/></a>', $_permalink, $image_src[0] );

					$html .= '<div class="carousel-slider__post-details-date">';
					if ( $_created !== $_modified ) {
						$html .= sprintf( '<span class="carousel-slider__post-publication-date" datetime="%s">%s</span>',
							date_i18n( 'c', $_modified ),
							date_i18n(( 'j' ), $_modified )
						);
						$html .= sprintf( '<span class="carousel-slider__post-publication-month" datetime="%s">%s</span>',
							date_i18n( 'c', $_modified ),
							date_i18n(( 'M.' ), $_modified )
						);
					} else {
						$html .= sprintf( '<span class="carousel-slider__post-publication-date" datetime="%s">%s</span>',
							date_i18n( 'c', $_created ),
							date_i18n(( 'j' ), $_created )
						);
						$html .= sprintf( '<span class="carousel-slider__post-publication-month" datetime="%s">%s</span>',
							date_i18n( 'c', $_created ),
							date_i18n(( 'M.' ), $_created )
						);
					}
					$html .= '</div>';
				}

			} else {

				$html .= sprintf( '<div class="carousel-slider__post-img"><a href="%s" class="carousel-slider__post-image"></a>', $_permalink );

					$html .= '<div class="carousel-slider__post-details-date">';
					if ( $_created !== $_modified ) {
						$html .= sprintf( '<span class="carousel-slider__post-publication-date" datetime="%s">%s</span>',
							date_i18n( 'c', $_modified ),
							date_i18n(( 'j' ), $_modified )
						);
						$html .= sprintf( '<span class="carousel-slider__post-publication-month" datetime="%s">%s</span>',
							date_i18n( 'c', $_modified ),
							date_i18n(( 'M.' ), $_modified )
						);
					} else {
						$html .= sprintf( '<span class="carousel-slider__post-publication-date" datetime="%s">%s</span>',
							date_i18n( 'c', $_created ),
							date_i18n(( 'j' ), $_created )
						);
						$html .= sprintf( '<span class="carousel-slider__post-publication-month" datetime="%s">%s</span>',
							date_i18n( 'c', $_created ),
							date_i18n(( 'M.' ), $_created )
						);
					}
					$html .= '</div>';
			}
			$html .= '</div>'; 

			$html .= '<div class="carousel-slider__post-desc">';

			// Post Title
			$html .= sprintf( '<a class="carousel-slider__post-title" href="%s"><h2>%s</h2></a>', $_permalink, $post->post_title );
			
			$html .= '<div class="carousel-slider__post-excerpt">' . $_excerpt . '</div>';

			// Post Read More
			$html .= '<div class="carousel-slider__post-read_more">';

			$html .= sprintf( '<a class="carousel-slider__read_more" href="%s"><span>Read More</span></a>', $_permalink, $post->post_title );

			$html .= '</div>'; 
			$html .= '</div>'; 
			$html .= '</div>'; // End Post Header
			$html .= '</div>';
			$html .= '</div>';

			echo apply_filters( 'carousel_slider_post', $html, $post, $category );
		endforeach;
		wp_reset_postdata();
		?>
	</div>
</div>