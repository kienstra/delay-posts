<?php
/**
 * Delay Posts
 *
 * @package Kienstra\DelayPosts
 *
 * Plugin Name: Delay Posts
 * Description: Delay posts in the main loop.
 * Author: Ryan Kienstra
 * Version: 0.1.0
 * Author URI: https://ryankienstra.com
 * Text Domain: delay-posts
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Tested up to: 6.3
 * Requires PHP: 8.1
 */

namespace Kienstra\DelayPosts;

/**
 * Delays posts in the main query.
 *
 * @param WP_Query &$query The query.
 */
function delay_posts( &$query ) {
	if (
		! is_admin() &&
		! $query->is_single() &&
		$query->is_main_query()
	) {
		$query->set(
			'date_query',
			[ 'before' => gmdate( 'Y-m-d', strtotime( '-4 days' ) ) ]
		);
	}
}

add_action( 'pre_get_posts', __NAMESPACE__ . '\delay_posts' );
