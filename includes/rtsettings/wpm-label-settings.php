<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<h3><?php esc_html_e('WPM & Label Setting', 'ultimate-reading-time'); ?></h3>

<!-- Custom Words Per Minute -->
<label for="urtbenz_custom_words_per_minute"><?php esc_html_e('Custom Words Per Minute', 'ultimate-reading-time'); ?></label>
<input type="number" id="urtbenz_custom_words_per_minute" name="urtbenz_custom_words_per_minute" value="<?php echo esc_attr(get_option('urtbenz_custom_words_per_minute', 250)); ?>" />

<!-- Reading time prefix -->
<label for="urtbenz_custom_reading_prefix"><?php esc_html_e('Reading time prefix', 'ultimate-reading-time'); ?></label>
<input type="text" id="urtbenz_custom_reading_prefix" name="urtbenz_custom_reading_prefix" value="<?php echo esc_attr(get_option('urtbenz_custom_reading_prefix', 'Reading Time')); ?>" />

<!-- Reading time postfix -->
<label for="urtbenz_custom_reading_postfix"><?php esc_html_e('Reading time postfix', 'ultimate-reading-time'); ?></label>
<input type="text" id="urtbenz_custom_reading_postfix" name="urtbenz_custom_reading_postfix" value="<?php echo esc_attr(get_option('urtbenz_custom_reading_postfix', 'minutes')); ?>" />

