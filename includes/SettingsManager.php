<?php
/**
 * Class SettingsManager
 *
 * Manages the settings for the Ultimate Reading Time plugin.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class URTBENZ_SettingsManager {

    /**
     * Constructor
     *
     * Hooks into the admin_init action to register settings and admin_enqueue_scripts to enqueue the color picker.
     */
    public function __construct() {
        add_action('admin_init', [$this, 'register_settings']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_color_picker']);
        add_action('admin_post_save_reading_time_settings', [$this, 'save_settings']);
    }

    /**
     * Register Settings
     *
     * Registers all the settings used in the plugin.
     */
    public function register_settings() {
        // Set default values if not already set
        if (get_option('urtbenz_display_on_posts') === false) {
            update_option('urtbenz_display_on_posts', 1);
        }
        if (get_option('urtbenz_display_on_pages') === false) {
            update_option('urtbenz_display_on_pages', 1);
        }

        register_setting('reading_time_settings_group', 'urtbenz_custom_words_per_minute', 'intval');
        register_setting('reading_time_settings_group', 'urtbenz_custom_reading_prefix', 'sanitize_text_field');
        register_setting('reading_time_settings_group', 'urtbenz_custom_reading_postfix', 'sanitize_text_field');
        register_setting('reading_time_settings_group', 'urtbenz_custom_color', 'sanitize_hex_color');
        register_setting('reading_time_settings_group', 'urtbenz_custom_font_style', 'sanitize_text_field');
        register_setting('reading_time_settings_group', 'urtbenz_custom_font_size', 'intval');
        register_setting('reading_time_settings_group', 'urtbenz_custom_font_weight', 'sanitize_text_field');
        register_setting('reading_time_settings_group', 'urtbenz_custom_text_alignment', 'sanitize_text_field');
        register_setting('reading_time_settings_group', 'urtbenz_display_on_posts', 'intval');
        register_setting('reading_time_settings_group', 'urtbenz_display_on_pages', 'intval');
        register_setting('reading_time_settings_group', 'urtbenz_custom_reading_time_position', 'sanitize_text_field');
    }

    /**
     * Enqueue Color Picker
     *
     * Enqueues the color picker script and style for the settings page.
     *
     * @param string $hook_suffix The current admin page hook suffix.
     */
    public function enqueue_color_picker($hook_suffix) {
        // Only enqueue scripts/styles on the settings page
        if ($hook_suffix === 'toplevel_page_reading-time-settings') {
            wp_enqueue_style('wp-color-picker');
            wp_enqueue_script('ultimate-reading-time-script', plugins_url('../assets/js/ultimate-reading-time.js', __FILE__), ['wp-color-picker'], '1.0.0', true);
        }
    }

    /**
     * Save Settings
     *
     * Handles the saving of settings with nonce and capability checks.
     */
    public function save_settings() {
        if (!current_user_can('manage_options')) {
            wp_die(esc_html__('You do not have sufficient permissions to access this page.', 'ultimate-reading-time'));
        }
    
        check_admin_referer('reading_time_settings_nonce', 'reading_time_settings_nonce_field');
    
        // Check and save each setting
        if (isset($_POST['urtbenz_words_per_minute'])) {
            $words_per_minute = intval($_POST['urtbenz_words_per_minute']);
            update_option('urtbenz_words_per_minute', $words_per_minute);
        }
    
        if (isset($_POST['urtbenz_reading_prefix'])) {
            $reading_prefix = sanitize_text_field(wp_unslash($_POST['urtbenz_reading_prefix']));
            update_option('urtbenz_reading_prefix', $reading_prefix);
        }
    
        if (isset($_POST['urtbenz_reading_postfix'])) {
            $reading_postfix = sanitize_text_field(wp_unslash($_POST['urtbenz_reading_postfix']));
            update_option('urtbenz_reading_postfix', $reading_postfix);
        }
    
        if (isset($_POST['urtbenz_color'])) {
            $color = sanitize_hex_color(wp_unslash($_POST['urtbenz_color']));
            update_option('urtbenz_color', $color);
        }
    
        if (isset($_POST['urtbenz_font_style'])) {
            $font_style = sanitize_text_field(wp_unslash($_POST['urtbenz_font_style']));
            update_option('urtbenz_font_style', $font_style);
        }
    
        if (isset($_POST['urtbenz_font_size'])) {
            $font_size = intval($_POST['urtbenz_font_size']);
            update_option('urtbenz_font_size', $font_size);
        }
    
        if (isset($_POST['urtbenz_font_weight'])) {
            $font_weight = sanitize_text_field(wp_unslash($_POST['urtbenz_font_weight']));
            update_option('urtbenz_font_weight', $font_weight);
        }
    
        if (isset($_POST['urtbenz_text_alignment'])) {
            $text_alignment = sanitize_text_field(wp_unslash($_POST['urtbenz_text_alignment']));
            update_option('urtbenz_text_alignment', $text_alignment);
        }
    
        if (isset($_POST['urtbenz_display_on_posts'])) {
            $display_on_posts = isset($_POST['urtbenz_display_on_posts']) ? 1 : 0;
            update_option('urtbenz_display_on_posts', $display_on_posts);
        }
    
        if (isset($_POST['urtbenz_display_on_pages'])) {
            $display_on_pages = isset($_POST['urtbenz_display_on_pages']) ? 1 : 0;
            update_option('urtbenz_display_on_pages', $display_on_pages);
        }
    
        wp_redirect(admin_url('admin.php?page=reading-time-settings&status=success'));
        exit;
    }
    
}