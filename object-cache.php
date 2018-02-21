<?php

// If Redis exists and redis server is configured,
if ( class_exists( 'Redis' ) && isset( $GLOBALS['redis_server'] ) ) {

	// Then load our object cache plugin.
	require_once 'plugins/wp-redis/object-cache.php';
}

/*
 * If we can't use the object-cache, we need some trickery
 * for WP to believe we aren't actually using an object-cache
 * (which it assumes since we have this file)
 *
 * As of https://core.trac.wordpress.org/changeset/42723, this
 * "else" will no longer be needed.
 */
else {

	// Helper/callback.
	function set_wp_using_ext_object_cache_to_false() {
		wp_using_ext_object_cache( false );
	}

	/*
	 * Set to false now.
	 * (After this file loads, WP resets to true.)
	 */
	set_wp_using_ext_object_cache_to_false();

	/*
	 * Loads and caches certain often requested site options. Need
	 * to do manually now because it will not run later when
	 * wp_load_core_site_options is set to false.
	 */
	if ( is_multisite() ) {
		add_action( 'ms_loaded', 'set_wp_using_ext_object_cache_to_false', 0 );
		add_action( 'ms_loaded', 'wp_load_core_site_options', 2 );
	} else {
		wp_load_core_site_options();
	}

	// Include the built-in WP object-caching.
	require_once( ABSPATH . WPINC . '/cache.php' );

	// Hook in to reset to false,
	add_action(
		'muplugins_loaded', // To the earliest hook,
		'set_wp_using_ext_object_cache_to_false',
		-9999 // At a super early priority.
	);
}
