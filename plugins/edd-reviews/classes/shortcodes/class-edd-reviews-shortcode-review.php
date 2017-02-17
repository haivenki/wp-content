<?php
/**
 * Reviews Shortcode Class
 *
 * @package EDD_Reviews
 * @subpackage Shortcodes
 * @copyright Copyright (c) 2016, Sunny Ratilal
 * @since 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'EDD_Reviews_Shortcode_Review' ) ) :

/**
 * EDD_Reviews_Shortcode_Review Class
 *
 * @package EDD_Reviews
 * @since 1.0
 * @version 1.1
 * @author Sunny Ratilal
 */
final class EDD_Reviews_Shortcode_Review {
	/**
	 * Render the shortcode
	 *
	 * @since 1.0
	 * @access public
	 * @param array $atts Shortcode attributes
	 * @return void
	 */
	public static function render( $atts ) {
		ob_start();

		extract( shortcode_atts( array(
			'number'   => '1',
			'multiple' => 'false',
			'download' => 'false',
			'id'       => 'false'
		), $atts ), EXTR_SKIP );

		if ( isset( $multiple ) && 'true' == $multiple && isset( $number ) && isset( $download ) ) {
			self::render_multiple_reviews( $atts );
			return;
		}

		remove_action( 'pre_get_comments', array( edd_reviews(), 'hide_reviews' ) );

		$review = get_comment( $id, OBJECT );

		add_action( 'pre_get_comments', array( edd_reviews(), 'hide_reviews' ) );

		if ( $review ) {
			ob_start();
			?>
			<div class="edd-review-body edd-review-shortcode-body">
				<div class="edd-review-meta">
					<div class="edd-review-author vcard">
						<b><?php echo get_comment_meta( $review->comment_ID, 'edd_review_title', true ); ?></b> <span class="edd-review-meta-rating"><?php edd_reviews()->render_star_rating( get_comment_meta( $review->comment_ID, 'edd_rating', true ) ); ?></span>

						<div class="edd-review-metadata">
							<p>
								<?php echo sprintf( '<span class="author">By %s</span>', get_comment_author_link( $review->comment_ID ) ); ?> on
								<a href="<?php echo esc_url( get_comment_link( $review->comment_ID, $args ) ); ?>"><?php echo get_comment_date( apply_filters( 'edd_reviews_widget_date_format', get_option( 'date_format' ) ), $review->comment_ID ); ?></a>
							</p>
						</div>
					</div>
				</div>
				<div class="edd-review-content">
					<?php echo apply_filters( 'the_content', $review->comment_content ); ?>
				</div>
			</div>
			<?php
		} else {
			?>
			<p><strong><?php _e( 'Review not found.', 'edd-reviews' ); ?></strong></p>
			<?php
		}

		$output = ob_get_contents();
		ob_end_clean();

		echo $output;
	}

	/**
	 * Render the shortcode
	 */
	public static function render_multiple_reviews( $atts ) {
		extract( shortcode_atts( array(
			'number'   => '1',
			'multiple' => 'false',
			'download' => 'false',
			'id'       => 'false'
		), $atts ), EXTR_SKIP );

		$args = array(
			'post_id'  => $download,
			'meta_key' => 'edd_review_title',
			'number'   => $number
		);

		$reviews = get_comments( $args );

		if ( $reviews ) :
			foreach ( $reviews as $review ) :
				ob_start();
				?>
				<div class="<?php echo apply_filters( 'edd_reviews_shortcode_class', 'edd-review' ); ?>">
					<div class="edd-review-h-card">
						<?php if ( get_option( 'show_avatars' ) ) echo get_avatar( $review, apply_filters( 'edd_reviews_shortcode_avatar_size', 57 ) ); ?>
						<?php
						echo '<p>' . get_comment_meta( $review->comment_ID, 'edd_review_title', true ) . ' ' . __( 'by', 'edd-reviews' ) . ' ' . get_comment_author_link( $review->comment_ID ) . '</p>';
						echo '<p><a href="' . get_permalink( $review->comment_post_ID ) . '">' . get_the_title( $review->comment_post_ID ) . '</a>' . '</p>';
						$rating = get_comment_meta( $review->comment_ID, 'edd_rating', true );
						?>
						<div class="edd_reviews_rating_box" role="img" aria-label="<?php echo $rating . ' ' . __( 'stars', 'edd-reviews' ); ?>">
							<div class="edd_star_rating" style="width: <?php echo 19 * $rating; ?>px"></div>
						</div>
						<div class="clear"></div>
					</div>
					<p class="edd-review-content">
						<?php echo $review->comment_content; ?>
					</p>
					<div class="edd-review-dateline">
						<?php echo get_comment_date( apply_filters( 'edd_reviews_shortcode_date_format', get_option( 'date_format' ) ), $review->comment_ID ); ?>
					</div>
				</div>
				<?php
				echo ob_get_clean();
			endforeach;
		endif;

		return;
	}
}

endif;