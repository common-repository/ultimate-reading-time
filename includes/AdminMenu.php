<?php
/**
 * Class AdminMenu
 *
 * This class handles the creation and display of the admin menu and settings page
 * for the Ultimate Reading Time plugin.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class URTBENZ_AdminMenu {
    private $settingsManager;

    /**
     * Constructor for the AdminMenu class.
     *
     * @param object $settingsManager An instance of the settings manager.
     */
    public function __construct($settingsManager) {
        $this->settingsManager = $settingsManager;
        add_action('admin_menu', [$this, 'add_plugin_menu']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_styles']);
    }

    /**
     * Adds a menu page to the WordPress admin dashboard.
     *
     * This method hooks into the 'admin_menu' action to add a custom menu page
     * for the plugin settings.
     */
    public function add_plugin_menu() {
        add_menu_page(
            __('Reading Time Settings', 'ultimate-reading-time'), // Page title
            __('Reading Time', 'ultimate-reading-time'),          // Menu title
            'manage_options',                                     // Capability
            'reading-time-settings',                              // Menu slug
            [$this, 'display_settings_page'],                     // Callback function
            'dashicons-clock',                                    // Icon URL
            200                                                   // Position
        );
    }

    /**
     * Enqueue the admin styles for the settings page.
     */
    public function enqueue_admin_styles($hook) {
        if ($hook != 'toplevel_page_reading-time-settings') {
            return;
        }
        wp_enqueue_style('ultimate-reading-time-admin-style', plugin_dir_url(__FILE__) . '../assets/css/admin-style.css',  [], '1.0.0');
    }

    /**
     * Displays the settings page content.
     *
     * This method outputs the HTML for the plugin's settings page, including
     * various form fields for configuring the reading time display options.
     */
    public function display_settings_page() {
        if (!current_user_can('manage_options')) {
            return;
        }

        ?>
        <div class="wrap">
            <h1><?php esc_html_e('Reading Time Settings', 'ultimate-reading-time'); ?></h1>
            <hr>
            <form method="post" action="options.php">
                <?php
                settings_fields('reading_time_settings_group');
                do_settings_sections('reading_time_settings_group');

                // Include the segmented settings sections
                include plugin_dir_path(__FILE__) . 'rtsettings/display-options.php';
                include plugin_dir_path(__FILE__) . 'rtsettings/color-settings.php';
                include plugin_dir_path(__FILE__) . 'rtsettings/position-settings.php';
                include plugin_dir_path(__FILE__) . 'rtsettings/wpm-label-settings.php';
                include plugin_dir_path(__FILE__) . 'rtsettings/font-settings.php';
                include plugin_dir_path(__FILE__) . 'rtsettings/shortcode-settings.php';

                submit_button();
                ?>
            </form>
        </div>
        <?php
    }
}
