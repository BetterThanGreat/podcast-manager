<?php
    $files = get_post_meta( get_the_ID(), BTG_PODCAST_AUDIO_FIELD_ID, true);
    if ($files) {
        $this_file = $files['url'];
        $this_file = explode("/", $this_file);
    }
?>

<?php if ($this_file) : ?>
    <p><strong>Current File:</strong> <?php echo array_pop($this_file); ?></p>
    <hr>
<?php endif; ?>

<?php wp_nonce_field( BTG_PODCAST_PLUGIN_BASENAME, BTG_PODCAST_AUDIO_FIELD_NONCE ); ?>
<p class="description">Upload your episode's audio file (MP3):</p>
<input type="file" id="<?php echo BTG_PODCAST_AUDIO_FIELD_ID; ?>" name="<?php echo BTG_PODCAST_AUDIO_FIELD_ID; ?>" value="" size="">
