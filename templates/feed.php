<?php

/**
Template Name: Podcast RSS
**/

// Query the Podcast Custom Post Type and fetch the latest 100 posts
$args = array( 'post_type' => BTG_PODCAST_POST_TYPE, 'posts_per_page' => 100 );
$loop = new WP_Query( $args );

// Require WP Media library
require_once( ABSPATH . 'wp-admin/includes/media.php' );

/**
* Get the current URL taking into account HTTPS and Port
* @link http://css-tricks.com/snippets/php/get-current-page-url/
* @version Refactored by @AlexParraSilva
*/
function getCurrentUrl() {
  $url  = isset( $_SERVER['HTTPS'] ) && 'on' === $_SERVER['HTTPS'] ? 'https' : 'http';
  $url .= '://' . $_SERVER['SERVER_NAME'];
  $url .= in_array( $_SERVER['SERVER_PORT'], array('80', '443') ) ? '' : ':' . $_SERVER['SERVER_PORT'];
  $url .= $_SERVER['REQUEST_URI'];
  return $url;
}

// Output the XML header
header('Content-Type: '.feed_content_type('rss-http').'; charset='.get_option('blog_charset'), true);
echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>';
?>

<?php // Start the iTunes RSS Feed: https://www.apple.com/itunes/podcasts/specs.html ?>
<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">

  <?php
    // The information for the podcast channel
    // Mostly using get_bloginfo() here, but these can be custom tailored, as needed
  ?>
  <channel>
    <title><?php echo get_bloginfo('name'); ?></title>
    <link><?php echo get_bloginfo('url'); ?></link>
    <language><?php echo get_bloginfo ( 'language' ); ?></language>
    <copyright><?php echo date('Y'); ?> <?php echo get_bloginfo('name'); ?></copyright>

    <itunes:author><?php echo get_bloginfo('name'); ?></itunes:author>
    <itunes:summary><?php echo get_bloginfo('description'); ?></itunes:summary>
    <description><?php echo esc_attr( get_option(BTG_PODCAST_SETTINGS_DESCRIPTION) ); ?></description>

    <itunes:owner>
      <itunes:name><?php echo get_bloginfo('name'); ?></itunes:name>
      <itunes:email><?php echo get_bloginfo('admin_email'); ?></itunes:email>
    </itunes:owner>

    <?php // Change to your own image. Must be at least 1400 x 1400: https://www.apple.com/itunes/podcasts/creatorfaq.html ?>
    <itunes:image href="<?php echo wp_get_attachment_url( get_option(BTG_PODCAST_SETTINGS_COVER_IMAGE) ); ?>" />

    <itunes:category text="<?php echo esc_attr( get_option(BTG_PODCAST_SETTINGS_CATEGORY) );?>">
      <itunes:category text="<?php echo esc_attr( get_option(BTG_PODCAST_SETTINGS_SUB_CATEGORY) ); ?>"/>
    </itunes:category>
    <itunes:explicit>
      <?php echo ( get_option(BTG_PODCAST_SETTINGS_IS_EXPLICIT) ) ? 'yes' : 'no'; ?>
    </itunes:explicit>

    <?php // Start the loop for Podcast posts
    while ( $loop->have_posts() ) : $loop->the_post(); ?>

    <?php // Get the file field URL, filesize and date format
      $audio_file = get_post_meta($post->ID, BTG_PODCAST_AUDIO_FIELD_ID, true);

      if (!$audio_file) continue;

      $fileurl = $audio_file['url'];
      $mime_type = $audio_file['type'];

      $head = array_change_key_case(get_headers($fileurl, TRUE));
      $filesize = $head['content-length'];

      $audio_meta = wp_read_audio_metadata( $audio_file['file'] );
      $dateformatstring = _x( 'D, d M Y H:i:s O', 'Date formating for iTunes feed.' );
    ?>

    <item>
      <title><?php the_title_rss(); ?></title>
      <itunes:author><?php echo get_bloginfo('name'); ?></itunes:author>
      <itunes:summary><?php echo get_the_excerpt(); ?></itunes:summary>
      <?php // Retrieve just the URL of the Featured Image: http://codex.wordpress.org/Function_Reference/wp_get_attachment_image_src
      if (has_post_thumbnail( $post->ID ) ): ?>
        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
        <itunes:image href="<?php echo $image[0]; ?>" />
      <?php endif; ?>

      <enclosure url="<?php echo $fileurl; ?>" length="<?php echo $filesize; ?>" type="<?php echo $mime_type; ?>" />
      <guid><?php echo $fileurl; ?></guid>
      <pubDate><?php echo get_the_date($dateformatstring); ?></pubDate>
      <itunes:duration><?php echo $audio_meta['length_formatted']; ?></itunes:duration>
    </item>
    <?php endwhile; ?>

  </channel>

</rss>
