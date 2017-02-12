<?php
/**
 * Registers a new Feed using the pre-packaged RSS template (templates/feed.php)
 */

add_action( 'init', 'btg_podcast_rss' );
function btg_podcast_rss() {
    add_feed( BTG_PODCAST_FEED_SLUG, 'btg_register_feed_template' );

    global $wp_rewrite;
    $wp_rewrite->flush_rules( false );
}

/* Filter the type, this hook wil set the correct HTTP header for Content-type. */
function btg_custom_rss_content_type( $content_type, $type ) {
    if ( BTG_PODCAST_FEED_SLUG === $type ) {
        return feed_content_type( 'rss2' );
    }
    return $content_type;
}
add_filter( 'feed_content_type', 'btg_custom_rss_content_type', 10, 2 );

function btg_register_feed_template() {
    load_template( BTG_PODCAST_MANAGER_DIR . '/templates/feed.php' );
}

?>
