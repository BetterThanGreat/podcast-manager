<div class="wrap">

    <h1>Podcast Settings</h1>

	<form method="POST" action="options.php">
		<?php settings_fields( BTG_PODCAST_SETTINGS_GROUP ); ?>
		<?php do_settings_sections( BTG_PODCAST_SETTINGS_GROUP ); ?>

		<table class="form-table">

			<!-- Cover Image -->
			<tr valign="top">
				<td scope="row">Cover Image</td>
				<td>
					<?php

						$btg_podcast_cover_url = wp_get_attachment_url( get_option(BTG_PODCAST_SETTINGS_COVER_IMAGE) );
						if (!strlen($btg_podcast_cover_url)) {
							$btg_podcast_cover_url = 'http://placehold.it/100x100';
						}
					?>


					<div class='image-preview-wrapper'>
						<img id='image-preview' src='<?php echo $btg_podcast_cover_url; ?>' width='100' height='100' style='max-height: 100px; width: 100px;'>
					</div>
					<input id="upload_image_button" type="button" class="button" value="<?php _e( 'Upload image' ); ?>" />
					<input type='hidden' name='<?php echo BTG_PODCAST_SETTINGS_COVER_IMAGE; ?>' id='<?php echo BTG_PODCAST_SETTINGS_COVER_IMAGE; ?>' value="<?php echo esc_attr( get_option(BTG_PODCAST_SETTINGS_COVER_IMAGE) ); ?>" >
				</td>
			</tr><!-- End Cover Image -->

			<tr valign="top">
				<td scope="row">Podcast Description</td>
				<td>
					<textarea name="<?php echo BTG_PODCAST_SETTINGS_DESCRIPTION; ?>" id="<?php echo BTG_PODCAST_SETTINGS_DESCRIPTION; ?>" cols="30" rows="10"><?php echo esc_attr( get_option(BTG_PODCAST_SETTINGS_DESCRIPTION) ); ?></textarea>
				</td>
			</tr>

			<!-- Category -->
			<tr valign="top">
				<td scope="row">Category</td>
				<td>
					<select value="<?php echo esc_attr( get_option(BTG_PODCAST_SETTINGS_CATEGORY) ); ?>" name="<?php echo BTG_PODCAST_SETTINGS_CATEGORY ?>" id="<?php echo BTG_PODCAST_SETTINGS_CATEGORY; ?>">
						<?php $btg_selected_category = esc_attr( get_option(BTG_PODCAST_SETTINGS_CATEGORY) ); ?>

						<option value="">-- PICK A CATEGORY --</option>
						<option data-category-id="1" value="Arts" <?php if ($btg_selected_category == 'Arts') echo 'selected'; ?>>Arts</option>
						<option data-category-id="2" value="Business" <?php if ($btg_selected_category == 'Business') echo 'selected'; ?>>Business</option>
						<option data-category-id="3" value="Comedy" <?php if ($btg_selected_category == 'Comedy') echo 'selected'; ?>>Comedy</option>
						<option data-category-id="4" value="Education" <?php if ($btg_selected_category == 'Education') echo 'selected'; ?>>Education</option>
						<option data-category-id="5" value="Games &amp; Hobbies" <?php if ($btg_selected_category == 'Games &amp; Hobbies') echo 'selected'; ?>>Games &amp; Hobbies</option>
						<option data-category-id="6" value="Government &amp; Organizations" <?php if ($btg_selected_category == 'Government &amp; Organizations') echo 'selected'; ?>>Goverment &amp; Organizations</option>
						<option data-category-id="7" value="Health" <?php if ($btg_selected_category == 'Health') echo 'selected'; ?>>Health</option>
						<option data-category-id="8" value="Music" <?php if ($btg_selected_category == 'Music') echo 'selected'; ?>>Music</option>
						<option data-category-id="9" value="News &amp; Politics" <?php if ($btg_selected_category == 'News &amp; Politics') echo 'selected'; ?>>News &amp; Politics</option>
						<option data-category-id="10" value="Religion &amp; Sprirituality" <?php if ($btg_selected_category == 'Religion &amp; Spirituality') echo 'selected'; ?>>Religion &amp; Spirituality</option>
						<option data-category-id="11" value="Science &amp; Medicine" <?php if ($btg_selected_category == 'Science &amp; Medicine') echo 'selected'; ?>>Science &amp; Medicine</option>
						<option data-category-id="12" value="Society &amp; Culture" <?php if ($btg_selected_category == 'Society &amp; Culture') echo 'selected'; ?>>Society &amp; Culture</option>
						<option data-category-id="13" value="Sports &amp; Recreation" <?php if ($btg_selected_category == 'Sports &amp; Recreation') echo 'selected'; ?>>Sports &amp; Recreation</option>
						<option data-category-id="14" value="Technology" <?php if ($btg_selected_category == 'Technology') echo 'selected'; ?>>Technology</option>
					</select>
				</td>
			</tr>
			<!-- End Category -->

			<!-- Sub Category -->
			<tr valign="top">
				<td scope="row">Sub Category</td>
				<td>
					<select value="<?php echo esc_attr( get_option(BTG_PODCAST_SETTINGS_SUB_CATEGORY) ); ?>" name="<?php echo BTG_PODCAST_SETTINGS_SUB_CATEGORY ?>" id="<?php echo BTG_PODCAST_SETTINGS_SUB_CATEGORY; ?>">
						<option value="">-- PICK A SUB-CATEGORY --</option>
						<?php $btg_selected_sub_category = esc_attr( get_option(BTG_PODCAST_SETTINGS_SUB_CATEGORY) ); ?>

						<!-- Arts -->
						<option data-category-id="1" value="Design" <?php if ($btg_selected_sub_category == 'Design') echo 'selected'; ?>>Design</option>
						<option data-category-id="1" value="Fashion &amp; Beauty" <?php if ($btg_selected_sub_category == 'Fashion &amp; Beauty') echo 'selected'; ?>>Fashion &amp; Beauty</option>
						<option data-category-id="1" value="Food" <?php if ($btg_selected_sub_category == 'Food') echo 'selected'; ?>>Food</option>
						<option data-category-id="1" value="Literature" <?php if ($btg_selected_sub_category == 'Literature') echo 'selected'; ?>>Literature</option>
						<option data-category-id="1" value="Performing Arts" <?php if ($btg_selected_sub_category == 'Performing Arts') echo 'selected'; ?>>Performing Arts</option>
						<option data-category-id="1" value="Visual Arts" <?php if ($btg_selected_sub_category == 'Visual Arts') echo 'selected'; ?>>Visual Arts</option>
						<!-- End Arts -->

						<!-- TODO: the rest of these  -->
						<!-- Business -->

						<!-- End Business -->

					</select>
				</td>
			</tr>
			<!-- End Sub Category -->

			<!-- Is Explicit -->
			<tr valign="top">
				<td scope="row">Is Explicit?</td>
				<?php $is_explicit = get_option(BTG_PODCAST_SETTINGS_IS_EXPLICIT); ?>
				<td><input type="checkbox" <?php if ($is_explicit) echo 'checked' ?> name="<?php echo BTG_PODCAST_SETTINGS_IS_EXPLICIT; ?>"></td>
			</tr><!-- End Is Explicit -->

		</table>

		<?php submit_button(); ?>
	</form>
</div>
