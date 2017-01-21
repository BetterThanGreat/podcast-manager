<?php
/**
 * Create and display a settings page for managing the Podcast
 */
if (is_admin()) {
	add_action( 'admin_menu', 'btg_add_podcast_settings_page' );
	add_action( 'admin_init', 'btg_register_podcast_settings' );
}

// Define Field Constants
define( BTG_PODCAST_SETTINGS_COVER_IMAGE, 'cover_image' );
define( BTG_PODCAST_SETTINGS_CATEGORY, 'category' );
define( BTG_PODCAST_SETTINGS_SUB_CATEGORY, 'subcategory' );
define( BTG_PODCAST_SETTINGS_IS_EXPLICIT, 'is_explicit' );
define( BTG_PODCAST_SETTINGS_DESCRIPTION, 'description' );

function btg_add_podcast_settings_page() {
    add_submenu_page(
        'edit.php?post_type=' . BTG_PODCAST_POST_TYPE,
        'Podcast Settings',
        'Settings',
        'edit_posts',
        'podcast-settings',
	    'btg_podcast_render_settings_page'
    );
}

function btg_register_podcast_settings() {
	register_setting( BTG_PODCAST_SETTINGS_GROUP, BTG_PODCAST_SETTINGS_COVER_IMAGE );
	register_setting( BTG_PODCAST_SETTINGS_GROUP, BTG_PODCAST_SETTINGS_CATEGORY );
	register_setting( BTG_PODCAST_SETTINGS_GROUP, BTG_PODCAST_SETTINGS_SUB_CATEGORY );
	register_setting( BTG_PODCAST_SETTINGS_GROUP, BTG_PODCAST_SETTINGS_IS_EXPLICIT );
	register_setting( BTG_PODCAST_SETTINGS_GROUP, BTG_PODCAST_SETTINGS_DESCRIPTION );
}

function btg_podcast_render_settings_page() {
	wp_enqueue_media();
	wp_enqueue_script( 'btg_settings_page_js', BTG_PODCAST_MANAGER_URL . 'includes/js/btg-podcast-settings-page.js', array('jquery') );
	load_template( BTG_PODCAST_MANAGER_DIR . '/templates/btg-podcast-settings-page.php' );
}

?>
