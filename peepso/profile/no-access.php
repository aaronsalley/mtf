<?php
$PeepSoProfile=PeepSoProfile::get_instance();
?>
<div class="peepso">
	<section id="mainbody" class="ps-wrapper">
		<section id="component" role="article" class="clearfix">
			<?php PeepSoTemplate::exec_template('general', 'navbar'); ?>
			<div id="cProfileWrapper" class="ps-profile-noaccess">
				<div class="ps-focus js-focus">
					<div class="ps-focus-cover js-focus-cover">
						<div class="ps-focus-image">
							<img id="<?php echo $PeepSoProfile->get('user_id'); ?>"
								data-cover-context="profile"
								class="focusbox-image cover-image <?php echo (isset($cover_class) ? $cover_class : ''); ?>"
								src="<?php $PeepSoProfile->cover_photo(); ?>"
								alt="cover photo"
								style="<?php $PeepSoProfile->cover_photo_position(); ?>"
							/>
						</div>

						<div class="ps-focus-image-mobile" style="background:url(<?php $PeepSoProfile->cover_photo(); ?>) no-repeat center center;">
						</div>

						<div class="js-focus-gradient" data-cover-context="profile" data-cover-type="cover"></div>

						<!-- Focus Title , Avatar, Add as friend button -->
						<div class="ps-focus-header js-focus-content">
							<div class="ps-avatar-focus">
								<img src="<?php $PeepSoProfile->avatar_full(); //image'); ?>" alt="<?php $PeepSoProfile->user_name(); ?>">
							</div>
							<div class="ps-focus-title">
								<span><?php $PeepSoProfile->user_display_name(); ?></span>
							</div>
							<div class="ps-focus-actions js-focus-actions">
							</div>
						</div>
					</div><!-- .js-focus-cover --> <!-- end js-focus-content -->
				</div><!-- .js-focus -->

				<!-- Profile actions - mobile -->
				<div class="ps-focus-actions-mobile js-focus-actions"></div>

				<div class="ps-body">
					<div class="ps-main ps-main-full">
						<!-- js_profile_feed_top -->
						<div class="activity-stream-front ps-page ps-text--center">
							<div id="ps-no-posts"><?php _e('This user has decided to keep their profile private.' ,'peepso'); ?></div>
							<div class="ps-gap"></div>
							<a href="#" class="ps-btn ps-btn-primary" onclick="jQuery(window).trigger('peepso_auth_required', [ true ]); return false;"><?php _e('Login' ,'peepso'); ?></a>
							<span class="ps-text--muted">or</span>
							<a href="<?php echo get_bloginfo('wpurl'), '/', PeepSo::get_option('page_register'), '/';?>" class="ps-btn ps-btn-success"><?php _e('Register' ,'peepso'); ?></a>
						</div><!-- end activity-stream-front -->
					</div><!--end col-->
				</div><!-- end row -->
			</div><!-- end cProfileWrapper --><!-- js_bottom -->
		</section><!--end component-->
	</section><!--end mainbody-->
</div><!--end row-->
