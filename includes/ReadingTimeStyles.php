<?php
/**
 * Class ReadingTimeStyles
 *
 * This class handles the styles for the reading time display, including enqueueing
 * the plugin stylesheet and applying custom inline styles based on user settings.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class URTBENZ_ReadingTimeStyles {

	/**
	 * Constructor for the ReadingTimeStyles class.
	 */
	public function __construct() {
		add_action('wp_enqueue_scripts', [$this, 'enqueue_styles']);
	}

	/**
	 * Enqueue the plugin stylesheet and inline styles.
	 *
	 * This method adds the plugin's stylesheet to the WordPress queue, so it is loaded
	 * on the front end of the site.
	 */
	public function enqueue_styles() {
		if (!is_singular() || (is_page() && !get_option('urtbenz_display_on_pages', 0)) || (is_single() && !get_option('urtbenz_display_on_posts', 0))) {
			return;
		}

		wp_enqueue_style('ultimate-reading-time-style', plugin_dir_url(__FILE__) . '../assets/css/ultimate-reading-time.css', [], '1.0.0');
		$this->apply_inline_styles();
	}

	/**
	 * Apply custom styles inline.
	 *
	 * This method outputs custom inline styles for the reading time display based on
	 * user settings retrieved from the WordPress options.
	 */
	public function apply_inline_styles() {
		// Retrieve custom style options
		$urtbenz_custom_color = sanitize_hex_color(get_option('urtbenz_custom_color', '#111111'));
		$urtbenz_custom_font_style = sanitize_text_field(get_option('urtbenz_custom_font_style', 'normal'));
		$urtbenz_custom_font_size = intval(get_option('urtbenz_custom_font_size', '16'));
		$urtbenz_custom_font_weight = sanitize_text_field(get_option('urtbenz_custom_font_weight', 'normal'));
		$custom_text_align = sanitize_text_field(get_option('urtbenz_custom_text_alignment', 'left'));

		// Validate text alignment
		$valid_alignments = ['left', 'center', 'right'];
		if (!in_array($custom_text_align, $valid_alignments, true)) {
			$custom_text_align = 'left';
		}

		// Generate inline CSS
		$inline_styles = "
			.reading-time {
				font-style: " . esc_attr($urtbenz_custom_font_style) . ";
				color: " . esc_attr($urtbenz_custom_color) . ";
				font-size: " . esc_attr($urtbenz_custom_font_size) . "px;
				font-weight: " . esc_attr($urtbenz_custom_font_weight) . ";
				text-align: " . esc_attr($custom_text_align) . ";
			}
		";

		// Add inline styles to the existing stylesheet
		wp_add_inline_style('ultimate-reading-time-style', $inline_styles);
	}
}
