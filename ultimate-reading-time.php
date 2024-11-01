<?php
/**
 * Plugin Name: Ultimate Reading Time
 * Description: Ultimate solution for displaying reading time on your posts and pages
 * Plugin URI:
 * Author: WPBenz
 * Author URI:
 * Version: 1.0.0
 * License: GPL2 or later
 * Text Domain: ultimate-reading-time
 * Domain Path: /languages/
 * License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Include each class file using absolute paths
include_once plugin_dir_path(__FILE__) . 'includes/TextDomainLoader.php';
include_once plugin_dir_path(__FILE__) . 'includes/ReadingTimeCalculator.php';
include_once plugin_dir_path(__FILE__) . 'includes/ReadingTimeDisplay.php';
include_once plugin_dir_path(__FILE__) . 'includes/ReadingTimeStyles.php';
include_once plugin_dir_path(__FILE__) . 'includes/SettingsManager.php';
include_once plugin_dir_path(__FILE__) . 'includes/AdminMenu.php';
include_once plugin_dir_path(__FILE__) . 'includes/ShortcodeReadingTime.php';

/**
 * Main Plugin Class
 */
class URTBENZ_Reading_Time_Plugin {
    private $textDomainLoader;
    private $readingTimeCalculator;
    private $readingTimeDisplay;
    private $readingTimeStyles;
    private $settingsManager;
    private $adminMenu;
    private $shortcodeReadingTime;

    /**
     * Constructor
     */
    public function __construct() {
        // Initialize classes
        $this->textDomainLoader = new URTBENZ_TextDomainLoader();
        $this->readingTimeCalculator = new URTBENZ_ReadingTimeCalculator();
        $this->readingTimeDisplay = new URTBENZ_ReadingTimeDisplay($this->readingTimeCalculator);
        $this->readingTimeStyles = new URTBENZ_ReadingTimeStyles();
        $this->settingsManager = new URTBENZ_SettingsManager();
        $this->adminMenu = new URTBENZ_AdminMenu($this->settingsManager);
        $this->shortcodeReadingTime = new URTBENZ_ShortcodeReadingTime($this->readingTimeCalculator);

        // Hook into WordPress
        add_action('init', [$this, 'init']);
    }

    /**
     * Initialize the plugin
     */
    public function init() {
        // Hook into WordPress actions and filters
        add_filter('the_content', [$this->readingTimeDisplay, 'display_reading_time']);
        add_action('admin_menu', [$this->adminMenu, 'add_plugin_menu']);
        add_action('wp_head', [$this->readingTimeStyles, 'apply_inline_styles']);
        add_action('admin_enqueue_scripts', [$this->settingsManager, 'enqueue_color_picker']);
    }
}

// Instantiate the plugin class
$urtbenz_reading_time_plugin = new URTBENZ_Reading_Time_Plugin();
