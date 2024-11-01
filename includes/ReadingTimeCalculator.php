<?php
/**
 * Class ReadingTimeCalculator
 *
 * This class calculates the estimated reading time for a given content.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class URTBENZ_ReadingTimeCalculator {
	/**
	 * Calculate the reading time for the given content.
	 *
	 * This method strips HTML tags from the content, counts the number of words,
	 * and calculates the reading time based on the words per minute (WPM) setting.
	 *
	 * @param string $content The content to calculate the reading time for.
	 * @return int The estimated reading time in minutes.
	 */
	public function calculate( $content ) {
		// Sanitize and validate the content input
		$content = wp_strip_all_tags( $content );

		// Get the words per minute option, default to 250 if not set
		$words_per_minute = intval( get_option( 'urtbenz_custom_words_per_minute', 250 ) );

		// Validate that words_per_minute is a positive integer
		if ( $words_per_minute <= 0 ) {
			$words_per_minute = 250; // Reset to default if invalid
		}

		// Count the words
		$word_count = str_word_count( $content );

		// Calculate the reading time in minutes
		return ceil( $word_count / $words_per_minute );
	}
}
