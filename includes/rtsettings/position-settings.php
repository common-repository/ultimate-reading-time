<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<h3><?php esc_html_e('Reading Time Position', 'ultimate-reading-time'); ?></h3>

<!-- Reading time alignment -->
<label for="urtbenz_custom_text_alignment"><?php esc_html_e('Reading time alignment', 'ultimate-reading-time'); ?></label>
<select id="urtbenz_custom_text_alignment" name="urtbenz_custom_text_alignment">
    <?php
    // Define text alignment options
    $text_alignment_options = [
        'left' => __('Left', 'ultimate-reading-time'),
        'center' => __('Center', 'ultimate-reading-time'),
        'right' => __('Right', 'ultimate-reading-time')
    ];
    
    // Sanitize and get the current text alignment option
    $current_text_alignment = sanitize_text_field(get_option('urtbenz_custom_text_alignment', 'left'));

    // Loop through and display text alignment options
    foreach ($text_alignment_options as $value => $label) {
        printf(
            '<option value="%s" %s>%s</option>',
            esc_attr($value),
            selected($current_text_alignment, $value, false),
            esc_html($label)
        );
    }
    ?>
</select>

<!-- Reading time position -->
<label for="urtbenz_custom_reading_time_position"><?php esc_html_e('Reading time position', 'ultimate-reading-time'); ?></label>
<select id="urtbenz_custom_reading_time_position" name="urtbenz_custom_reading_time_position">
    <?php
    // Define reading time position options
    $reading_time_position_options = [
        'above_content' => __('Above the Content', 'ultimate-reading-time'),
        'below_content' => __('Below the Content', 'ultimate-reading-time'), // New option
        'above_title' => __('Above the Post Title', 'ultimate-reading-time'),
        'below_title' => __('Below the Post Title', 'ultimate-reading-time')
    ];
    
    // Sanitize and get the current reading time position option
    $current_reading_time_position = sanitize_text_field(get_option('urtbenz_custom_reading_time_position', 'above_content'));

    // Loop through and display reading time position options
    foreach ($reading_time_position_options as $value => $label) {
        printf(
            '<option value="%s" %s>%s</option>',
            esc_attr($value),
            selected($current_reading_time_position, $value, false),
            esc_html($label)
        );
    }
    ?>
</select>
