<?php
$PeepSoProfile = PeepSoProfile::get_instance();
$user_id = $PeepSoProfile->block_user();
$PeepSoUser		= new PeepSoUser($user_id);
?>
<div class="ps-members-item-wrapper">
	<div class="ps-members-item">
		<div class="ps-members-item-avatar">
			<span class="ps-avatar">
				<img src="<?php echo PeepSo::get_avatar($PeepSoProfile->block_user()); ?>" title="<?php echo $PeepSoUser->get_fullname(); ?>">
			</span>
		</div>
		<div class="ps-members-item-body">
			<div class="ps-members-item-title">
				<?php $PeepSoProfile->block_username(); ?>
			</div>
			<div class="ps-members-item-options">
				<div class="ps-checkbox">
					<input type="checkbox" id="ckbx-<?php echo $user_id; ?>" />
					<label for="ckbx-<?php echo $user_id; ?>"></label>
				</div>
			</div>
		</div>
	</div>
</div>
