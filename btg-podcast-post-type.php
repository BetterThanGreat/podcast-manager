<?php
/**
 * Defines and installs a custom post type for creating instances of a podcast's "episodes"
 */

add_action('init', 'btg_register_podcast_post_type');
add_action( 'add_meta_boxes', 'btg_podcast_custom_fields' );

function btg_register_podcast_post_type() {
    register_post_type(BTG_PODCAST_POST_TYPE, [
        'labels' => [
            'name'              => __( 'Podcast' ),
            'singular_name'     => __( 'Podcast' ),
            'add_new'           => __( 'New Episode' ),
            'add_new_item'      => __( 'Add New Episode' ),
            'edit_item'         => __( 'Edit Episode' ),
            'new_item'          => __( 'New Episode' ),
            'view_item'         => __( 'View Episode' ),
            'search_items'      => __( 'Search Episodes' ),
            'not_found'         => __( 'No Episodes Found' ),
            'not_found_in_trash'=> __( 'No Episodes Found in Trash' ),
            'all_items'         => __( 'All Episodes' ),
            'archives'          => __( 'Episode Archives' )
        ],
        'public'        => true,
        'has_archive'   => true,
        'menu_icon'     => 'dashicons-rss',
        'menu_position' => 3,
        'rewrite'       => [
            'slug'              => __( 'episodes' )
        ],
        'supports'      => [
            'title',
            'excerpt',
	        'editor'
        ]
    ]);
}

function btg_podcast_custom_fields() {
    btg_podcast_add_audio_field();
}

function btg_podcast_add_audio_field() {
    add_meta_box(
	    'btg_podcast_audio_field',
	    'Episode Audio File',
	    'btg_podcast_render_add_audio_field',
	    BTG_PODCAST_POST_TYPE,
	    'side'
    );
}
function btg_podcast_render_add_audio_field() {
	load_template( BTG_PODCAST_MANAGER_DIR . '/templates/btg-podcast-audio-field.php' );
}

?>
