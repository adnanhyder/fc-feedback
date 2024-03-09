<?php
/**
 * Fc Feedback Functions.
 * This file contains all the functions which are used in the plugin.
 *
 * @since 1.0.0
 * @package FC-Feedback
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'fc_sanitize_thing' ) ) {
	/**
	 * Recursive sanitation for text, integer or array.
	 *
	 * @since 1.0.0
	 * @param array|string $var Array or string to sanitize.
	 * @return array|string
	 */
	function fc_sanitize_thing( $var ) {

		if ( is_array( $var ) ) {
			return array_map( 'fc_sanitize_thing', $var );
		} else {
			return is_scalar( $var ) ? sanitize_text_field( wp_unslash( $var ) ) : $var;
		}
	}
}
