jQuery( document ).ready( function( $ ) {
    // Uploading files
    var file_frame;
    var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
    var set_to_post_id = null; // TODO: Set this

    jQuery('#upload_image_button').on('click', function( event ){
        event.preventDefault();
        // If the media frame already exists, reopen it.
        if ( file_frame ) {
            // Set the post ID to what we want
            file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
            // Open frame
            file_frame.open();
            return;
        } else {
            // Set the wp.media post id so the uploader grabs the ID we want when initialised
            wp.media.model.settings.post.id = set_to_post_id;
        }
        // Create the media frame.
        file_frame = wp.media.frames.file_frame = wp.media({
            title: 'Select a image to upload',
            button: {
                text: 'Use this image',
            },
            multiple: false	// Set to true to allow multiple files to be selected
        });
        // When an image is selected, run a callback.
        file_frame.on( 'select', function() {
            // We set multiple to false so only get one image from the uploader
            attachment = file_frame.state().get('selection').first().toJSON();
            // Do something with attachment.id and/or attachment.url here
            $( '#image-preview' ).attr( 'src', attachment.url ).css( 'width', 'auto' );
            $( '#cover_image' ).val( attachment.id );
            // Restore the main post ID
            wp.media.model.settings.post.id = wp_media_post_id;
        });
        // Finally, open the modal
        file_frame.open();
    });
    // Restore the main ID when the add media button is pressed
    jQuery( 'a.add_media' ).on( 'click', function() {
        wp.media.model.settings.post.id = wp_media_post_id;
    });

    // Update Sub-Category Options when Category changes
    $('#category').on('change', function() { updateSubCategories(true); });

    function updateSubCategories(resetSubcategory) {
        var categoryId = $('#category').find('option:selected').data('category-id');

        if (resetSubcategory) $('#subcategory option:selected').prop('selected', false);

        $('#subcategory option').each(function(index, elem){
            var shouldShow = $(elem).data('category-id') == categoryId || $(elem).data('category-id') == 0;
            
            if (shouldShow) {
                $(elem).show();
            } else {
                $(elem).hide();
            }
        });
    }

    updateSubCategories(false);
});