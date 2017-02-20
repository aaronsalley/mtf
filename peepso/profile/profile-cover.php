<?php
$PeepSoProfile=PeepSoProfile::get_instance();
?>
<div class="row">

	<section id="mainbody" class="clearfix">

		<section id="component" role="article" class="clearfix">

			<?php PeepSoTemplate::exec_template('general', 'navbar'); ?>

			<h4><?php _e('Change Cover Photo', 'peepso'); ?></h4>

			<?php PeepSoTemplate::exec_template('profile', 'submenu'); ?>

			<div class="clayout cProfile-UploadAvatar">

				<div class="app-box upload-avatar">

					<form name="jsform-profile-uploadavatar" action="<?php echo PeepSo::get_page('profile'); ?>?cover" id="uploadForm" method="post" enctype="multipart/form-data">
						<input type="file" id="file-upload" name="filedata" />
						<input class="btn btn-primary" size="30" type="submit" id="file-upload-submit" value="Upload" />
						<input type="hidden" name="action" value="doUpload" />
						<input type="hidden" name="user_id" value="<?php echo $PeepSoProfile->get('user_id'); ?>" />
						<input type="hidden" name="profileType" value="0" />
						<?php wp_nonce_field('cover-photo', '_covernonce'); ?>
					</form>

					<div class="small">
						<?php printf(__('Maximum File Size for Upload is %s ', 'peepso'), '<strong>' . $PeepSoProfileupload_size() . '</strong>'); ?>
						<br/>
						<?php _e('Recommended image dimensions are: ', 'peepso'); ?> <?php echo PeepSoUser::COVER_WIDTH . 'x' . PeepSoUser::COVER_HEIGHT; ?>
					</div>

					<?php if ($PeepSoProfile->has_errors()) { ?>
					<div class="calert">
						<?php $PeepSoProfile->error_message(); ?>
					</div>
					<?php } ?>

					<div class="app-box-footer">
						<a href="javascript:void(0);" onclick="profile.confirm_remove_cover_photo();" class="btn btn-danger"><?php _e('Remove Cover Photo', 'peepso'); ?></a>
					</div>

				</div>

			<div class="app-box show-avatar">

					<h3 class="app-box-header"><?php _e('Cover Photo', 'peepso'); ?></h3>

					<?php if ($PeepSoProfile->has_cover()) { ?>

						<div id="imagePreview" class="imagePreview">
							<img id="large-profile-pic" src="<?php $PeepSoProfile->cover_photo(); ?>" alt="<?php _e('Automatically Generated. (Maximum width: 1140px)', 'peepso'); ?>"
								class="ps-name-tips" />
						</div>

						<div class="app-box-footer">
							<a href="javascript:updateThumbnail()" id="update-thumbnail" class="btn btn-primary" style="display: inline-block;"><?php _e('Crop Image', 'peepso'); ?></a>
							<a href="javascript:saveThumbnail()" id="update-thumbnail-save" class="btn btn-primary" style="display: none;"><?php _e('Save Thumbnail', 'peepso'); ?></a>
							<div id="update-thumbnail-guide" style="display: none;">
								<?php _e('Click and drag your mouse on the avatar to enable cropping tool.', 'peepso'); ?>
							</div>
						</div>

					<?php } else { ?>

						<div class="calert" style="margin-top: 10px"><?php _e('No cover photo uploaded. Use the form above to select and upload one.' ,'peepso'); ?></div>
					
					<?php } ?>
					
				</div>

			</div><!-- clayout -->

		</section><!--end compnent-->

	</section><!--end mainbody-->

</div><!--end row-->

<div id="ps-dialogs" style="display:none">
	<div id="delete-confirmation" class="hidden">
		<div id="delete-title"><?php _e('Delete Cover Photo', 'peepso'); ?></div>
		<div id="delete-content">
			<div><?php _e('Are you sure you want to remove your cover photo?', 'peepso'); ?></div>
			<div>
				<button type="button" class="ps-button-cancel" onclick="pswindow.hide(); return false;"><?php _e('Cancel', 'peepso'); ?></button>
				<button type="button" class="ps-button-action" onclick="profile.remove_cover_photo(<?php echo $PeepSoProfile->user_id(); ?>); return false;"><?php _e('Remove', 'peepso'); ?></button>
			</div>
		</div>
	</div>
</div>