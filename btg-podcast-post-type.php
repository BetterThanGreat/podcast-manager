<?php
/**
 * Defines and installs a custom post type for creating instances of a podcast's "episodes"
 */

add_action('init', 'btg_register_podcast_post_type');
add_action('add_meta_boxes', 'btg_podcast_custom_fields');
add_action('save_post', 'btg_podcast_save_audio_field');
add_action('post_edit_form_tag', 'btg_update_edit_form');

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

function btg_podcast_save_audio_field( $id ) {

    if (BTG_PODCAST_POST_TYPE != get_post_type($id)) {
        return $id;
    }
   
    /* --- security verification --- */
    if(!wp_verify_nonce($_POST[BTG_PODCAST_AUDIO_FIELD_NONCE], BTG_PODCAST_PLUGIN_BASENAME)) {
        return $id;
    } // end if

    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $id;
    } // end if

    if(!current_user_can('edit_post', $id)) {
        return $id;
    } // end if
    /* - end security verification - */

    // Make sure the file array isn't empty
    if(!empty($_FILES[BTG_PODCAST_AUDIO_FIELD_ID]['name'])) {
         
        // Setup the array of supported file types.
        // FIXME: probably should add support for more file types if we want to distribute this as a plugin
        $supported_types = array('audio/mpeg');
         
        // Get the file type of the upload
        $arr_file_type = wp_check_filetype(basename($_FILES[BTG_PODCAST_AUDIO_FIELD_ID]['name']));
        $uploaded_type = $arr_file_type['type'];
         
        // Check if the type is supported. If not, throw an error.
        if(in_array($uploaded_type, $supported_types)) {
 
            // Use the WordPress API to upload the file
            $upload = wp_upload_bits($_FILES[BTG_PODCAST_AUDIO_FIELD_ID]['name'], null, file_get_contents($_FILES[BTG_PODCAST_AUDIO_FIELD_ID]['tmp_name']));
     
            if(isset($upload['error']) && $upload['error'] != 0) {
                wp_die('There was an error uploading your file. The error is: ' . $upload['error']);
            } else {
                update_post_meta($id, BTG_PODCAST_AUDIO_FIELD_ID, $upload);
            } // end if/else
 
        } else {
            wp_die("The type of file that you've uploaded is not supported.");
        } // end if/else
    }// end if
}

// Allow file posting from post editor
function btg_update_edit_form() {
    echo ' enctype="multipart/form-data"';
} // end update_edit_form

?>
