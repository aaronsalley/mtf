<?php $users = new WP_User_Query( array(
	'role__not_in'	=> 'subscriber',
	)); 
	$directory = array( 'staff', 'board', 'advisor' );
	$directories = wc_crm_get_groups();
?>
<?php if ( ! empty( $users->results ) ) : foreach ($directory as $this_directory) : 
	foreach ($directories as $dir ) :
		if ( $dir->group_slug == $this_directory ) {
			$directory_name = $dir->group_name;
		}
	endforeach;
?>
<section id="<?php echo $this_directory; ?>" class="members">
	<h2 class="directory"><?php echo $directory_name; ?></h2>
	<?php foreach ( $users->results as $user ) :
		$wp_user_id = $user->ID;
		$customer_id = $wpdb->get_row("SELECT c_id FROM " . $wpdb->prefix . "wc_crm_customer_list WHERE user_id = {$wp_user_id}")->c_id;
		$user = new WC_CRM_Customer;
		$this_user = $user->get_customer($customer_id);
				
    $group_ids = $user->get_groups();

	$groups = array();
		foreach ( $group_ids as $group_id ) {
			$groups[] = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "wc_crm_groups WHERE ID = '$group_id'");
		}
		foreach ( $groups as $group ){
			if( $group->group_slug == $this_directory && $this_directory == 'staff') :
			?> 
			<article class="member">
				<a href="mailto:<?php echo $user->get_email(); ?>">
					<div class="headshot"><img class="avatar" src="#"/></div>
					<h5 class="name"><?php echo $user->get_name(); ?></h5>
					<h5 class="position"><?php echo $user->__get('title'); ?></h5>
					<h5 class="contact"><?php echo $user->get_email(); ?></h5>
				</a>
			</article>
			<?php elseif( $group->group_slug == $this_directory && $this_directory !== 'staff') : ?>
		<article class="member">
			<h4 class="name"><?php echo $user->get_name(); ?></h4>
			<h5 class="position"><?php echo $user->__get('title'); ?></h5>
		</article>
			<?php endif; 
		}
	endforeach; ?>
</section>
<?php endforeach; endif; ?>