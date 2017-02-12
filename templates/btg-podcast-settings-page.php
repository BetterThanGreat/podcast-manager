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
						<option data-category-id="0" value="">-- PICK A SUB-CATEGORY --</option>
						<?php $btg_selected_sub_category = esc_attr( get_option(BTG_PODCAST_SETTINGS_SUB_CATEGORY) ); ?>

						<!-- 1. Arts -->
						<option data-category-id="1" value="Design" <?php if ($btg_selected_sub_category == 'Design') echo 'selected'; ?>>Design</option>
						<option data-category-id="1" value="Fashion &amp; Beauty" <?php if ($btg_selected_sub_category == 'Fashion &amp; Beauty') echo 'selected'; ?>>Fashion &amp; Beauty</option>
						<option data-category-id="1" value="Food" <?php if ($btg_selected_sub_category == 'Food') echo 'selected'; ?>>Food</option>
						<option data-category-id="1" value="Literature" <?php if ($btg_selected_sub_category == 'Literature') echo 'selected'; ?>>Literature</option>
						<option data-category-id="1" value="Performing Arts" <?php if ($btg_selected_sub_category == 'Performing Arts') echo 'selected'; ?>>Performing Arts</option>
						<option data-category-id="1" value="Visual Arts" <?php if ($btg_selected_sub_category == 'Visual Arts') echo 'selected'; ?>>Visual Arts</option>
						<!-- End Arts -->

						<!-- 2. Business -->
						<option data-category-id="2" value="Business News" <?php if ($btg_selected_sub_category == 'Business News') echo 'selected'; ?>>Business News</option>
						<option data-category-id="2" value="Careers" <?php if ($btg_selected_sub_category == 'Careers') echo 'selected'; ?>>Careers</option>
						<option data-category-id="2" value="Investing" <?php if ($btg_selected_sub_category == 'Investing') echo 'selected'; ?>>Investing</option>
						<option data-category-id="2" value="Management &amp; Marketing" <?php if ($btg_selected_sub_category == 'Management &amp; Marketing') echo 'selected'; ?>>Management &amp; Marketing</option>
						<option data-category-id="2" value="Shopping" <?php if ($btg_selected_sub_category == 'Shopping') echo 'selected'; ?>>Shopping</option>
						<!-- End Business -->

						<!-- 3. Comedy -->
						<!-- End Comedy -->

						<!-- 4. Education -->
						<option data-category-id="4" value="Educational Technology" <?php if ($btg_selected_sub_category == 'Educational Technology') echo 'selected'; ?>>Educational Technology</option>
						<option data-category-id="4" value="Higher Education" <?php if ($btg_selected_sub_category == 'Higher Education') echo 'selected'; ?>>Higher Education</option>
						<option data-category-id="4" value="K-12" <?php if ($btg_selected_sub_category == 'K-12') echo 'selected'; ?>>K-12</option>
						<option data-category-id="4" value="Language Courses" <?php if ($btg_selected_sub_category == 'Language Courses') echo 'selected'; ?>>Language Courses</option>
						<option data-category-id="4" value="Training" <?php if ($btg_selected_sub_category == 'Training') echo 'selected'; ?>>Training</option>
						<!-- End Education -->

						<!-- 5. Games & Hobbies -->
						<option data-category-id="5" value="Automotive" <?php if ($btg_selected_sub_category == 'Automotive') echo 'selected'; ?>>Automotive</option>
						<option data-category-id="5" value="Aviation" <?php if ($btg_selected_sub_category == 'Aviation') echo 'selected'; ?>>Aviation</option>
						<option data-category-id="5" value="Hobbies" <?php if ($btg_selected_sub_category == 'Hobbies') echo 'selected'; ?>>Hobbies</option>
						<option data-category-id="5" value="Other Games" <?php if ($btg_selected_sub_category == 'Other Games') echo 'selected'; ?>>Other Games</option>
						<option data-category-id="5" value="Video Games" <?php if ($btg_selected_sub_category == 'Video Games') echo 'selected'; ?>>Video Games</option>
						<!-- End Games & Hobbies -->

						<!-- 6. Government & Organizations -->
						<option data-category-id="6" value="Local" <?php if ($btg_selected_sub_category == 'Local') echo 'selected'; ?>>Local</option>
						<option data-category-id="6" value="National" <?php if ($btg_selected_sub_category == 'National') echo 'selected'; ?>>National</option>
						<option data-category-id="6" value="Non-Profit" <?php if ($btg_selected_sub_category == 'Non-Profit') echo 'selected'; ?>>Non-Profit</option>
						<option data-category-id="6" value="Regional" <?php if ($btg_selected_sub_category == 'Regional') echo 'selected'; ?>>Regional</option>
						<!-- End Government & Organizations -->

						<!-- 7. Health -->
						<option data-category-id="7" value="Alternative Health" <?php if ($btg_selected_sub_category == 'Alternative Health') echo 'selected'; ?>>Alternative Health</option>
						<option data-category-id="7" value="Fitness &amp; Nutrition" <?php if ($btg_selected_sub_category == 'Fitness &amp; Nutrition') echo 'selected'; ?>>Fitness &amp; Nutrition</option>
						<option data-category-id="7" value="Self-Help" <?php if ($btg_selected_sub_category == 'Self-Help') echo 'selected'; ?>>Self-Help</option>
						<option data-category-id="7" value="Sexuality" <?php if ($btg_selected_sub_category == 'Sexuality') echo 'selected'; ?>>Sexuality</option>
						<option data-category-id="7" value="Kids &amp; Family" <?php if ($btg_selected_sub_category == 'Kids &amp; Family') echo 'selected'; ?>>Kids &amp; Family</option>
						<!-- End Health -->

						<!-- 8. Music -->
						<!-- End Music -->

						<!-- 9. News & Politics -->
						<!-- End News & Politics -->

						<!-- 10. Religion & Spirituality -->
						<option data-category-id="10" value="Buddhism" <?php if ($btg_selected_sub_category == 'Buddhism') echo 'selected'; ?>>Buddhism</option>
						<option data-category-id="10" value="Christianity" <?php if ($btg_selected_sub_category == 'Christianity') echo 'selected'; ?>>Christianity</option>
						<option data-category-id="10" value="Hinduism" <?php if ($btg_selected_sub_category == 'Hinduism') echo 'selected'; ?>>Hinduism</option>
						<option data-category-id="10" value="Islam" <?php if ($btg_selected_sub_category == 'Islam') echo 'selected'; ?>>Islam</option>
						<option data-category-id="10" value="Judaism" <?php if ($btg_selected_sub_category == 'Judaism') echo 'selected'; ?>>Judaism</option>
						<option data-category-id="10" value="Other" <?php if ($btg_selected_sub_category == 'Other') echo 'selected'; ?>>Other</option>
						<option data-category-id="10" value="Spirituality" <?php if ($btg_selected_sub_category == 'Spirituality') echo 'selected'; ?>>Spirituality</option>
						<!-- End Religion & Spirituality -->

						<!-- 11. Science & Medicine -->
						<option data-category-id="11" value="Medicine" <?php if ($btg_selected_sub_category == 'Medicine') echo 'selected'; ?>>Medicine</option>
						<option data-category-id="11" value="Natural Sciences" <?php if ($btg_selected_sub_category == 'Natural Sciences') echo 'selected'; ?>>Natural Sciences</option>
						<option data-category-id="11" value="Social Sciences" <?php if ($btg_selected_sub_category == 'Social Sciences') echo 'selected'; ?>>Social Sciences</option>
						<!-- End Science & Medicine -->

						<!-- 12. Society & Culture -->
						<option data-category-id="12" value="History" <?php if ($btg_selected_sub_category == 'History') echo 'selected'; ?>>History</option>
						<option data-category-id="12" value="Personal Journals" <?php if ($btg_selected_sub_category == 'Personal Journals') echo 'selected'; ?>>Personal Journals</option>
						<option data-category-id="12" value="Philosophy" <?php if ($btg_selected_sub_category == 'Philosophy') echo 'selected'; ?>>Philosophy</option>
						<option data-category-id="12" value="Places &amp; Travel" <?php if ($btg_selected_sub_category == 'Places &amp; Travel') echo 'selected'; ?>>Places &amp; Travel</option>
						<!-- End Society & Culture -->

						<!-- 13. Sports & Recreation -->
						<option data-category-id="13" value="Amateur" <?php if ($btg_selected_sub_category == 'Amateur') echo 'selected'; ?>>Amateur</option>
						<option data-category-id="13" value="College &amp; High School" <?php if ($btg_selected_sub_category == 'College &amp; High School') echo 'selected'; ?>>College &amp; High School</option>
						<option data-category-id="13" value="Outdoor" <?php if ($btg_selected_sub_category == 'Outdoor') echo 'selected'; ?>>Outdoor</option>
						<option data-category-id="13" value="Professional" <?php if ($btg_selected_sub_category == 'Professional') echo 'selected'; ?>>Professional</option>
						<option data-category-id="13" value="TV &amp; Film" <?php if ($btg_selected_sub_category == 'TV &amp; Film') echo 'selected'; ?>>TV &amp; Film</option>
						<!-- End Sports & Recreation -->

						<!-- 14. Technology -->
						<option data-category-id="14" value="Gadgets" <?php if ($btg_selected_sub_category == 'Gadgets') echo 'selected'; ?>>Gadgets</option>
						<option data-category-id="14" value="Podcasting" <?php if ($btg_selected_sub_category == 'Podcasting') echo 'selected'; ?>>Podcasting</option>
						<option data-category-id="14" value="Software How-To" <?php if ($btg_selected_sub_category == 'Software How-To') echo 'selected'; ?>>Software How-To</option>
						<option data-category-id="14" value="Tech News" <?php if ($btg_selected_sub_category == 'Tech News') echo 'selected'; ?>>Tech News</option>
						<!-- End Technology -->

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
