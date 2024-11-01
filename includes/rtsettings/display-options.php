<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<h3><?php esc_html_e('Display Options', 'ultimate-reading-time'); ?></h3>

<!--  Display on Posts  -->
<label id="urtbenz_display_on_posts_label" for="urtbenz_display_on_posts">
    <input type="checkbox" id="urtbenz_display_on_posts" name="urtbenz_display_on_posts" value="1" <?php checked(get_option('urtbenz_display_on_posts', 1), 1); ?> />
    <?php esc_html_e('Display on Posts', 'ultimate-reading-time'); ?>
</label>

<!--  Display on Pages  -->
<label id="urtbenz_display_on_pages_label" for="urtbenz_display_on_pages">
    <input type="checkbox" id="urtbenz_display_on_pages" name="urtbenz_display_on_pages" value="1" <?php checked(get_option('urtbenz_display_on_pages', 1), 1); ?> />
    <?php esc_html_e('Display on Pages', 'ultimate-reading-time'); ?>
</label>
