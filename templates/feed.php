<?php

/**
Template Name: Podcast RSS
**/

// Query the Podcast Custom Post Type and fetch the latest 100 posts
$args = array( 'post_type' => BTG_PODCAST_POST_TYPE, 'posts_per_page' => 100 );
$loop = new WP_Query( $args );

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
    <item>
      <title><?php the_title_rss(); ?></title>
      <itunes:author><?php echo get_bloginfo('name'); ?></itunes:author>
      <itunes:summary><?php echo get_the_excerpt(); ?></itunes:summary>
      <?php // Retrieve just the URL of the Featured Image: http://codex.wordpress.org/Function_Reference/wp_get_attachment_image_src
      if (has_post_thumbnail( $post->ID ) ): ?>
        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
        <itunes:image href="<?php echo $image[0]; ?>" />
      <?php endif; ?>

      <?php // Get the file field URL, filesize and date format
        $attachment_id = get_field('podcast_file');
        $fileurl = wp_get_attachment_url( $attachment_id );
        $filesize = filesize( get_attached_file( $attachment_id ) );
        $dateformatstring = _x( 'D, d M Y H:i:s O', 'Date formating for iTunes feed.' );
      ?>

      <enclosure url="<?php echo $fileurl; ?>" length="<?php echo $filesize; ?>" type="audio/mpeg" />
      <guid><?php echo $fileurl; ?></guid>
      <guid><?php the_field('podcast_file'); ?></guid>
      <pubDate><?php echo date($dateformatstring, $show_date); ?></pubDate>
      <itunes:duration><?php the_field('podcast_duration'); ?></itunes:duration>
    </item>
    <?php endwhile; ?>

  </channel>

</rss>
