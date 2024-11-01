<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<h3><?php esc_html_e( 'Color Setting', 'ultimate-reading-time' ); ?></h3>
<label for="urtbenz_custom_color"><?php esc_html_e( 'Custom Color', 'ultimate-reading-time' ); ?></label>
<input type="text" id="urtbenz_custom_color" name="urtbenz_custom_color" value="<?php echo esc_attr( get_option( 'urtbenz_custom_color', '#111111' ) ); ?>" class="ultimate-color-picker" />
