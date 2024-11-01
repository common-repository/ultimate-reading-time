<?php
/**
 * Class ReadingTimeDisplay
 *
 * This class handles displaying the reading time for posts and pages.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class URTBENZ_ReadingTimeDisplay {
    private $calculator;

    /**
     * Constructor for the ReadingTimeDisplay class.
     *
     * @param ReadingTimeCalculator $calculator An instance of the ReadingTimeCalculator class.
     */
    public function __construct($calculator) {
        $this->calculator = $calculator;
        add_filter('the_content', [$this, 'display_reading_time']);
        add_filter('the_title', [$this, 'display_reading_time_above_or_below_title'], 10, 2);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_styles']);
    }

    /**
     * Enqueue the styles for the reading time display.
     */
    public function enqueue_styles() {
        if (!is_singular() || (is_page() && !get_option('urtbenz_display_on_pages', 0)) || (is_single() && !get_option('urtbenz_display_on_posts', 0))) {
            return;
        }
        wp_enqueue_style('ultimate-reading-time-style', plugin_dir_url(__FILE__) . '../assets/css/ultimate-reading-time.css', [], '1.0.0');
    }

    /**
     * Displays the reading time at the beginning of the post or page content.
     *
     * @param string $content The original content of the post or page.
     * @return string The content with the reading time appended or prepended.
     */
    public function display_reading_time($content) {
        // Ensure we are not in the admin area, and are on a singular post or page
        if (is_admin() || !is_singular() || (!is_page() && !is_single())) {
            return $content;
        }

        // Check options to see if we should display on pages or posts
        if ((is_page() && !get_option('urtbenz_display_on_pages', 0)) || (is_single() && !get_option('urtbenz_display_on_posts', 0))) {
            return $content;
        }

        // Calculate reading time
        $reading_time = $this->calculator->calculate($content);
        
        // Retrieve and sanitize options
        $reading_time_prefix = sanitize_text_field(get_option('urtbenz_custom_reading_prefix', 'Reading Time'));
        $reading_time_postfix = sanitize_text_field(get_option('urtbenz_custom_reading_postfix', 'minutes'));
        $text_alignment = sanitize_text_field(get_option('urtbenz_custom_text_alignment', 'left'));
        $reading_time_position = sanitize_text_field(get_option('urtbenz_custom_reading_time_position', 'above_content'));

        // Create reading time HTML
        $reading_time_html = sprintf(
            '<p class="reading-time %s"><span class="dashicons dashicons-clock"></span> %s %s %s</p>',
            esc_attr($text_alignment),
            esc_html($reading_time_prefix),
            esc_html($reading_time),
            esc_html($reading_time_postfix)
        );

        // Insert the reading time HTML based on the selected position
        if ($reading_time_position === 'above_content') {
            $content = $reading_time_html . $content;
        } elseif ($reading_time_position === 'below_content') {
            $content = $content . $reading_time_html;
        } elseif ($reading_time_position === 'above_title') {
            // Will be handled by display_reading_time_above_or_below_title
        } elseif ($reading_time_position === 'below_title') {
            // Will be handled by display_reading_time_above_or_below_title
        }

        return $content;
    }

    /**
     * Displays the reading time above or below the post title.
     *
     * @param string $title The original title of the post or page.
     * @param int $id The post ID.
     * @return string The title with the reading time appended or prepended.
     */
    public function display_reading_time_above_or_below_title($title, $id) {
        // Ensure we are not in the admin area, and are on a singular post or page
        if (is_admin() || !is_singular() || (!is_page() && !is_single())) {
            return $title;
        }

        // Check options to see if we should display on pages or posts
        if ((is_page() && !get_option('urtbenz_display_on_pages', 0)) || (is_single() && !get_option('urtbenz_display_on_posts', 0))) {
            return $title;
        }

        // Calculate reading time
        $post = get_post($id);
        $reading_time = $this->calculator->calculate($post->post_content);

        // Retrieve and sanitize options
        $reading_time_prefix = sanitize_text_field(get_option('urtbenz_custom_reading_prefix', 'Reading Time'));
        $reading_time_postfix = sanitize_text_field(get_option('urtbenz_custom_reading_postfix', 'minutes'));
        $text_alignment = sanitize_text_field(get_option('urtbenz_custom_text_alignment', 'left'));
        $reading_time_position = sanitize_text_field(get_option('urtbenz_custom_reading_time_position', 'above_content'));

        // Create reading time HTML
        $reading_time_html = sprintf(
            '<p class="reading-time %s"><span class="dashicons dashicons-clock"></span> %s %s %s</p>',
            esc_attr($text_alignment),
            esc_html($reading_time_prefix),
            esc_html($reading_time),
            esc_html($reading_time_postfix)
        );

        // Insert the reading time HTML based on the selected position
        if ($reading_time_position === 'above_title') {
            $title = $reading_time_html . $title;
        } elseif ($reading_time_position === 'below_title') {
            $title = $title . $reading_time_html;
        }

        return $title;
    }
}
?>
