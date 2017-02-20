<?php
	$PeepSoProfile=PeepSoProfile::get_instance();

	if (FALSE === $PeepSoProfile->has_cover()) {
		$reposition_style = 'display:none;';
		$cover_class = 'default';
	} else {
		$reposition_style = '';
		$cover_class = 'has-cover';
	}

	$is_profile_segment = isset($current) ? TRUE : FALSE;

?>
<div class="ps-focus js-focus <?php if($is_profile_segment) { echo 'ps-focus-mini'; } ?> ps-js-focus ps-js-focus--<?php echo $PeepSoProfile->user_id() ?>">
	<div class="ps-focus-cover js-focus-cover ">
		<div class="ps-focus-image">
			<img id="<?php echo $PeepSoProfile->get('user_id'); ?>"
				data-cover-context="profile"
				class="focusbox-image cover-image <?php echo $cover_class; ?>"
				src="<?php $PeepSoProfile->cover_photo(); ?>"
				alt="cover photo"
				style="<?php $PeepSoProfile->cover_photo_position(); ?>"
			/>
		</div>

		<div class="ps-focus-image-mobile" style="background:url(<?php $PeepSoProfile->cover_photo(); ?>) no-repeat center center;">
		</div>

		<div class="js-focus-gradient" data-cover-context="profile" data-cover-type="cover"></div>

		<?php if ($PeepSoProfile->can_edit() && !$is_profile_segment) { ?>

		<?php wp_nonce_field('profile-photo', '_photononce'); ?>
		<!-- Cover options dropdown -->
		<div class="ps-focus-options ps-dropdown ps-dropdown-focus">
			<a href="javascript:" class="ps-dropdown-toggle">
				<span class="ps-icon-camera"></span>
			</a>
			<ul class="dropdown-menu">
				<li class="ps-reposition-cover"><a id="profile-reposition-cover" href="javascript:void(0)" style="<?php echo $reposition_style;?>" data-cover-context="profile" onclick="profile.reposition_cover();"><i class="ps-icon-cog"></i><?php _e('Reposition Cover', 'peepso'); ?></a></li>
				<li><a href="javascript:void(0)" data-cover-context="profile" onclick="profile.show_cover_dialog();"><i class="ps-icon-picture"></i><?php _e('Modify Cover', 'peepso'); ?></a></li>
			</ul>
		</div>
		<!-- Reposition cover - buttons -->
		<div class="ps-focus-change js-focus-change-cover" data-cover-type="cover">
			<div class="reposition-cover-actions" style="display: none;">
				<a href="javascript:void(0)" class="ps-btn" onclick="profile.cancel_reposition_cover();"><?php _e('Cancel', 'peepso'); ?></a>
				<a href="javascript:void(0)" class="ps-btn ps-btn-primary" onclick="profile.save_reposition_cover();"><?php _e('Save', 'peepso'); ?></a>
			</div>
			<div class="ps-reposition-loading" style="display: none;">
				<img src="<?php echo PeepSo::get_asset('images/ajax-loader.gif'); ?>">
				<div> </div>
			</div>
		</div>
		<?php } ?>

		<!-- Focus Title , Avatar, Add as friend button -->
		<div class="ps-focus-header js-focus-content">
			<div class="ps-avatar-focus js-focus-avatar">
				<img src="<?php $PeepSoProfile->avatar_full(); //image'); ?>" alt="<?php $PeepSoProfile->user_name(); ?>">
				<?php if ((1 != PeepSo::get_option('avatars_wordpress_only', 0)) && $PeepSoProfile->can_edit() && !$is_profile_segment) { ?>
					<span class="ps-avatar-change js-focus-avatar-option">
						<a href="javascript:void(0);" onclick="profile.show_avatar_dialog()">
							<i class="ps-icon-camera"></i>
						</a>
					</span>
				<?php } ?>
			</div>
			<div class="ps-focus-title">
				<span>
					<?php $PeepSoProfile->online_status(); ?>
					<?php $PeepSoProfile->user_display_name(); ?>
				</span>
				<br/>
				<?php
				if(!$is_profile_segment) {
					do_action('peepso_profile_cover_full_after_name', $PeepSoProfile->user_id());
				}
				?>
			</div>
			<div class="ps-focus-actions">
				<?php $PeepSoProfile->profile_actions(); ?>
			</div>
		</div>
	</div><!-- .js-focus-cover -->

	<?php
	if(!$is_profile_segment)
	{
		$current='stream';
	}
	?>

	<!-- Profile actions - mobile -->
	<div class="ps-focus-actions-mobile">
		<?php $PeepSoProfile->profile_actions(); ?>
	</div>

	<!-- Focus Menu & Interactions -->
	<div class="ps-focus-link">
		<?php echo $PeepSoProfile->profile_segment_menu(array('current'=>$current)); ?>

		<ul class="ps-list profile-interactions profile-social">
			<?php $PeepSoProfile->interactions(); ?>
		</ul>
	</div>
	
	<div class="js-focus-actions">
	</div><!-- .js-focus-actions -->
</div><!-- .js-focus -->
