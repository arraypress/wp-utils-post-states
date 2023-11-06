<?php
/**
 * Initializes and registers the Post_States_Manager to manage and display custom post states within the WordPress admin panel.
 *
 * This utility function sets up a Post_States_Manager with a given mapping of option keys to their labels for displaying custom
 * post states, such as "Landing Page" or "Featured Article," next to post titles in the admin posts list. These states provide
 * administrators with at-a-glance insights into specific attributes of the posts directly from the list view.
 *
 * The function requires an associative array mapping option keys to labels and an optional callable responsible for retrieving
 * option values. It gracefully handles errors during initialization, optionally using a provided error callback function.
 *
 * Example usage:
 * $options_map = [
 *     'landing_page' => __('Landing Page', 'text-domain'),
 *     'featured_post' => __('Featured Post', 'text-domain'),
 *     // ... other states
 * ];
 * register_post_states($options_map, 'get_option', function($exception) {
 *     // Error handling logic here
 * });
 *
 * By invoking this function, the Post_States_Manager is hooked into the 'display_post_states' WordPress filter and will
 * append the appropriate labels to the posts in the list based on their states.
 *
 * @package     ArrayPress/Utils/WP/Post_States_Manager
 * @copyright   Copyright (c) 2023, ArrayPress Limited
 * @license     GPL2+
 * @since       1.0.0
 * @author      David Sherlock
 */

namespace ArrayPress\Utils\WP;

use Exception;

if ( ! function_exists( 'register_post_states' ) ) {
	/**
	 * Initializes the Post_States_Manager with given options and handles exceptions.
	 *
	 * @param array         $options_map    Associative array mapping option keys to labels.
	 * @param string|null   $option_getter  Function to retrieve the option values, defaults to 'get_option'.
	 * @param callable|null $error_callback Callback function for error handling.
	 *
	 * @return Post_States_Manager|null The initialized Post_States_Manager or null on failure.
	 */
	function register_post_states(
		array $options_map,
		string $option_getter = null,
		?callable $error_callback = null
	): ?Post_States_Manager {
		try {
			return new Post_States_Manager( $options_map, $option_getter );
		} catch ( Exception $e ) {
			if ( is_callable( $error_callback ) ) {
				call_user_func( $error_callback, $e );
			}

			// Handle the exception or log it if needed
			return null; // Return null on failure
		}
	}
}