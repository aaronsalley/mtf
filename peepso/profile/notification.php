<?php
$PeepSoProfile=PeepSoProfile::get_instance();
$user_id = $PeepSoProfile->notification_user();
$PeepSoUser		= new PeepSoUser($user_id);

$readstatus = $PeepSoProfile->notification_readstatus();

?>
<div class="ps-notifications-item<?php echo ($readstatus === FALSE)? ' ps-notification--unread':''?>">
	<a class="ps-comment-item" href="<?php echo $PeepSoProfile->notification_link(false); ?>">
		<div class="ps-notifications-check">
			<input type="checkbox" id="ckbx-<?php $PeepSoProfile->notification_id(); ?>" />
			<label for="ckbx-<?php $PeepSoProfile->notification_id(); ?>"></label>
		</div>
		<div class="ps-avatar-comment">
			<img src="<?php echo PeepSo::get_avatar($PeepSoProfile->notification_user()); ?>" alt="<?php echo $PeepSoUser->get_fullname(); ?>">
		</div>
		<div class="ps-comment-body">
			<strong><?php echo $PeepSoUser->get_fullname(); ?></strong>
			<?php $PeepSoProfile->notification_message(); ?><?php $PeepSoProfile->notification_link(); ?>
			<div class="ps-comment-time">
				<small class="activity-post-age" data-timestamp="<?php $PeepSoProfile->notification_timestamp(); ?>"><?php $PeepSoProfile->notification_age(); ?></small>
			</div>
		</div>
	</a>
</div>
