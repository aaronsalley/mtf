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
	$user = $wpdb->get_row("SELECT c_id FROM " . $wpdb->prefix . "wc_crm_customer_list WHERE user_id = '$user->ID'");
	$this_user = new WC_CRM_Customer($user->c_id);
    $group_ids = $this_user->get_groups();
	$groups = array();
		foreach ( $group_ids as $id ) {
			$groups[] = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "wc_crm_groups WHERE ID = '$id'");
		}
		foreach ( $groups as $group ){
			if( $group->group_slug == $this_directory && $this_directory == 'staff') :
			?> 
		<article class="member">
			<a href="mailto:<?php echo $this_user->email; ?>">
				<div class="headshot"><?php echo get_avatar(); ?></div>
				<h5 class="name"><?php echo $this_user->name; ?></h5>
				<h5 class="position"><?php echo $this_user->title; ?></h5>
				<h5 class="contact"><?php echo $this_user->email; ?></h5>
			</a>
		</article>
			<?php elseif( $group->group_slug == $this_directory && $this_directory !== 'staff') : ?>
		<article class="member">
			<h4 class="name"><?php echo $this_user->name; ?></h4>
			<h5 class="position"><?php echo $this_user->title; ?></h5>
		</article>
			<?php endif; 
		}
	endforeach; ?>
</section>
<?php endforeach; endif; ?>