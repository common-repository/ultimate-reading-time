<?php
/**
 * Class ShortcodeReadingTime
 *
 * This class handles the shortcode for displaying reading time.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class URTBENZ_ShortcodeReadingTime {
	private $calculator;

	/**
	 * Constructor for the ShortcodeReadingtime class.
	 *
	 * @param ReadingTimeCalculator $calculator An instance of the ReadingTimeCalculator class.
	 */
	public function __construct( $calculator ) {
		$this->calculator = $calculator;
		add_shortcode( 'urtbenz_reading_time', [ $this, 'shortcode_handler' ] );
	}

	/**
	 * Shortcode handler for [urtbenz_reading_time] and [urtbenz_reading_time id=XX].
	 *
	 * @param array $atts Shortcode attributes.
	 * @return string The HTML output for the shortcode.
	 */
	public function shortcode_handler( $atts ) {
		// Extract attributes, default to empty content if not provided
		$atts = shortcode_atts( [ 'id' => 0 ], $atts, 'urtbenz_reading_time' );
		$post_id = intval( $atts['id'] );

		// If no ID provided, use the current post ID
		if ( $post_id === 0 ) {
			$post_id = get_the_ID();
		}

		// Ensure valid post ID
		if ( $post_id <= 0 ) {
			return '';
		}

		// Get the post content
		$post = get_post( $post_id );
		if ( ! $post ) {
			return '';
		}

		// Calculate reading time
		$reading_time = $this->calculator->calculate( $post->post_content );

		// Retrieve and sanitize options
		$reading_time_prefix = sanitize_text_field( get_option( 'urtbenz_custom_reading_prefix', 'Reading Time' ) );
		$reading_time_postfix = sanitize_text_field( get_option( 'urtbenz_custom_reading_postfix', 'minutes' ) );

		// Create reading time HTML
		$reading_time_html = sprintf(
			'<p class="reading-time"><span class="dashicons dashicons-clock"></span> %s %s %s</p>',
			esc_html( $reading_time_prefix ),
			esc_html( $reading_time ),
			esc_html( $reading_time_postfix )
		);

		return $reading_time_html;
	}
}
