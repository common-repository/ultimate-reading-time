<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<h3><?php esc_html_e('Font Setting', 'ultimate-reading-time'); ?></h3>

<!-- Font Style -->
<label for="urtbenz_custom_font_style"><?php esc_html_e('Font Style', 'ultimate-reading-time'); ?></label>
<select id="urtbenz_custom_font_style" name="urtbenz_custom_font_style">
    <?php
    $font_style_options = [
        'normal' => __('Normal', 'ultimate-reading-time'),
        'italic' => __('Italic', 'ultimate-reading-time'),
        'oblique' => __('Oblique', 'ultimate-reading-time')
    ];
    $current_font_style = get_option('urtbenz_custom_font_style', 'normal');
    foreach ($font_style_options as $value => $label) {
        printf(
            '<option value="%s" %s>%s</option>',
            esc_attr($value),
            selected($current_font_style, $value, false),
            esc_html($label)
        );
    }
    ?>
</select>

<!-- Font Size  -->
<label for="urtbenz_custom_font_size"><?php esc_html_e('Font Size', 'ultimate-reading-time'); ?></label>
<input type="number" id="urtbenz_custom_font_size" name="urtbenz_custom_font_size" value="<?php echo esc_attr(get_option('urtbenz_custom_font_size', '16')); ?>" />

<!-- Font Weight -->
<label for="urtbenz_custom_font_weight"><?php esc_html_e('Font Weight', 'ultimate-reading-time'); ?></label>
<select id="urtbenz_custom_font_weight" name="urtbenz_custom_font_weight">
    <?php
    $font_weight_options = [
        'normal' => __('Normal', 'ultimate-reading-time'),
        'lighter' => __('Lighter', 'ultimate-reading-time'),
        'bold' => __('Bold', 'ultimate-reading-time'),
        'bolder' => __('Bolder', 'ultimate-reading-time')
    ];
    $current_font_weight = get_option('urtbenz_custom_font_weight', 'normal');
    foreach ($font_weight_options as $value => $label) {
        printf(
            '<option value="%s" %s>%s</option>',
            esc_attr($value),
            selected($current_font_weight, $value, false),
            esc_html($label)
        );
    }
    ?>
</select>
