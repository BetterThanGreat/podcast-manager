<?php
/*
Plugin Name: BTG Podcast Manager
Plugin URI: https://betterthangreat.co/
Description: A WordPress plugin for managing and hosting a podcast. Creates a new custom post type with manageable taxonomies as well as a dynamic feed for distribution
Version: 0.0.1
Author: Better Than Great
Author URI: https://betterthangreat.co/
License: GPLv2 or later
Text Domain: btgpodcastmanager
*/

define( 'BTG_PODCAST_MANAGER_VERSION', '0.0.1' );
define( 'BTG_PODCAST_MANAGER_DIR', plugin_dir_path( __FILE__ ) );
define( 'BTG_PODCAST_MANAGER_URL', plugin_dir_url( __FILE__ ) );
define( 'BTG_PODCAST_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'BTG_PODCAST_POST_TYPE', 'btg_podcast_episode');
define( 'BTG_PODCAST_FEED_SLUG', 'podcast' );
define( 'BTG_PODCAST_SETTINGS_GROUP', 'btg-options-group' );

// Form Constants
define( 'BTG_PODCAST_AUDIO_FIELD_NONCE', 'btg-podcast-audio-field-nonce' );
define( 'BTG_PODCAST_AUDIO_FIELD_ID', 'btg-podcast-audio-field-id' );

// Include the post type
require_once( BTG_PODCAST_MANAGER_DIR . 'btg-podcast-post-type.php' );

// Include the taxonomy
require_once( BTG_PODCAST_MANAGER_DIR . 'btg-podcast-taxonomy.php' );

// Include the settings page
require_once( BTG_PODCAST_MANAGER_DIR . 'btg-podcast-settings.php' );

// Setup the RSS Feed
require_once( BTG_PODCAST_MANAGER_DIR . 'btg-podcast-rss.php' );

// Do base setup on plugin activation
function btg_podcast_manager_on_activate() {
    // Flush rewrite rules

	$rules = get_option( 'rewrite_rules' );
	$feeds = array_keys( $rules, 'index.php?&feed=$matches[1]' );

	foreach ( $feeds as $feed ) {
		if ( FALSE !== strpos( $feed, BTG_PODCAST_FEED_SLUG ) )
			$registered = TRUE;
	}

	// Feed not yet registered, so lets flush the rules once.
	if ( ! $registered )
		flush_rewrite_rules( FALSE );
}
register_activation_hook( __FILE__, 'btg_podcast_manager_on_activate' );

?>