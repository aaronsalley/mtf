/**
	 * Outputs the hidden row displayed when inline editing
	 *
	 * @since 3.1.0
	 *
	 * @global string $mode List table view mode.
	 */
	function inline_edit() {
		global $mode;

		$screen = $this->screen;

		$post             = get_default_post_to_edit( $screen->post_type );
		$post_type_object = get_post_type_object( $screen->post_type );

		$taxonomy_names          = get_object_taxonomies( $screen->post_type );
		$hierarchical_taxonomies = array();
		$flat_taxonomies         = array();

		foreach ( $taxonomy_names as $taxonomy_name ) {
			$taxonomy = get_taxonomy( $taxonomy_name );

			$show_in_quick_edit = $taxonomy->show_in_quick_edit;

			/**
			 * Filters whether the current taxonomy should be shown in the Quick Edit panel.
			 *
			 * @since 4.2.0
			 *
			 * @param bool   $show_in_quick_edit Whether to show the current taxonomy in Quick Edit.
			 * @param string $taxonomy_name      Taxonomy name.
			 * @param string $post_type          Post type of current Quick Edit post.
			 */
			if ( ! apply_filters( 'quick_edit_show_taxonomy', $show_in_quick_edit, $taxonomy_name, $screen->post_type ) ) {
				continue;
			}

			if ( $taxonomy->hierarchical ) {
				$hierarchical_taxonomies[] = $taxonomy;
			} else {
				$flat_taxonomies[] = $taxonomy;
			}
		}

		$m            = ( isset( $mode ) && 'excerpt' === $mode ) ? 'excerpt' : 'list';
		$can_publish  = current_user_can( $post_type_object->cap->publish_posts );
		$core_columns = array(
			'cb'         => true,
			'date'       => true,
			'title'      => true,
			'categories' => true,
			'tags'       => true,
			'comments'   => true,
			'author'     => true,
		);
		?>

		<form method="get">
		<table style="display: none"><tbody id="inlineedit">
		<?php
		$hclass              = count( $hierarchical_taxonomies ) ? 'post' : 'page';
		$inline_edit_classes = "inline-edit-row inline-edit-row-$hclass";
		$bulk_edit_classes   = "bulk-edit-row bulk-edit-row-$hclass bulk-edit-{$screen->post_type}";
		$quick_edit_classes  = "quick-edit-row quick-edit-row-$hclass inline-edit-{$screen->post_type}";

		$bulk = 0;

		while ( $bulk < 2 ) :
			$classes  = $inline_edit_classes . ' ';
			$classes .= $bulk ? $bulk_edit_classes : $quick_edit_classes;
			?>
			<tr id="<?php echo $bulk ? 'bulk-edit' : 'inline-edit'; ?>" class="<?php echo $classes; ?>" style="display: none">
			<td colspan="<?php echo $this->get_column_count(); ?>" class="colspanchange">
			<div class="inline-edit-wrapper" role="region" aria-labelledby="<?php echo $bulk ? 'bulk' : 'quick'; ?>-edit-legend">
			<fieldset class="inline-edit-col-left">
				<legend class="inline-edit-legend" id="<?php echo $bulk ? 'bulk' : 'quick'; ?>-edit-legend"><?php echo $bulk ? __( 'Bulk Edit' ) : __( 'Quick Edit' ); ?></legend>
				<div class="inline-edit-col">

				<?php if ( post_type_supports( $screen->post_type, 'title' ) ) : ?>

					<?php if ( $bulk ) : ?>

						<div id="bulk-title-div">
							<div id="bulk-titles"></div>
						</div>

					<?php else : // $bulk ?>

						<label>
							<span class="title"><?php _e( 'Title' ); ?></span>
							<span class="input-text-wrap"><input type="text" name="post_title" class="ptitle" value="" /></span>
						</label>

						<?php if ( is_post_type_viewable( $screen->post_type ) ) : ?>

							<label>
								<span class="title"><?php _e( 'Slug' ); ?></span>
								<span class="input-text-wrap"><input type="text" name="post_name" value="" autocomplete="off" spellcheck="false" /></span>
							</label>

						<?php endif; // is_post_type_viewable() ?>

					<?php endif; // $bulk ?>

				<?php endif; // post_type_supports( ... 'title' ) ?>

				<?php if ( ! $bulk ) : ?>
					<fieldset class="inline-edit-date">
						<legend><span class="title"><?php _e( 'Date' ); ?></span></legend>
						<?php touch_time( 1, 1, 0, 1 ); ?>
					</fieldset>
					<br class="clear" />
				<?php endif; // $bulk ?>

				<?php
				if ( post_type_supports( $screen->post_type, 'author' ) ) {
					$authors_dropdown = '';

					if ( current_user_can( $post_type_object->cap->edit_others_posts ) ) {
						$dropdown_name  = 'post_author';
						$dropdown_class = 'authors';
						if ( wp_is_large_user_count() ) {
							$authors_dropdown = sprintf( '<select name="%s" class="%s hidden"></select>', esc_attr( $dropdown_name ), esc_attr( $dropdown_class ) );
						} else {
							$users_opt = array(
								'hide_if_only_one_author' => false,
								'capability'              => array( $post_type_object->cap->edit_posts ),
								'name'                    => $dropdown_name,
								'class'                   => $dropdown_class,
								'multi'                   => 1,
								'echo'                    => 0,
								'show'                    => 'display_name_with_login',
							);

							if ( $bulk ) {
								$users_opt['show_option_none'] = __( '&mdash; No Change &mdash;' );
							}

							/**
							 * Filters the arguments used to generate the Quick Edit authors drop-down.
							 *
							 * @since 5.6.0
							 *
							 * @see wp_dropdown_users()
							 *
							 * @param array $users_opt An array of arguments passed to wp_dropdown_users().
							 * @param bool $bulk A flag to denote if it's a bulk action.
							 */
							$users_opt = apply_filters( 'quick_edit_dropdown_authors_args', $users_opt, $bulk );

							$authors = wp_dropdown_users( $users_opt );

							if ( $authors ) {
								$authors_dropdown  = '<label class="inline-edit-author">';
								$authors_dropdown .= '<span class="title">' . __( 'Author' ) . '</span>';
								$authors_dropdown .= $authors;
								$authors_dropdown .= '</label>';
							}
						}
					} // current_user_can( 'edit_others_posts' )

					if ( ! $bulk ) {
						echo $authors_dropdown;
					}
				} // post_type_supports( ... 'author' )
				?>

				<?php if ( ! $bulk && $can_publish ) : ?>

					<div class="inline-edit-group wp-clearfix">
						<label class="alignleft">
							<span class="title"><?php _e( 'Password' ); ?></span>
							<span class="input-text-wrap"><input type="text" name="post_password" class="inline-edit-password-input" value="" /></span>
						</label>

						<span class="alignleft inline-edit-or">
							<?php
							/* translators: Between password field and private checkbox on post quick edit interface. */
							_e( '&ndash;OR&ndash;' );
							?>
						</span>
						<label class="alignleft inline-edit-private">
							<input type="checkbox" name="keep_private" value="private" />
							<span class="checkbox-title"><?php _e( 'Private' ); ?></span>
						</label>
					</div>

				<?php endif; ?>

				</div>
			</fieldset>

			<?php if ( count( $hierarchical_taxonomies ) && ! $bulk ) : ?>

				<fieldset class="inline-edit-col-center inline-edit-categories">
					<div class="inline-edit-col">

					<?php foreach ( $hierarchical_taxonomies as $taxonomy ) : ?>

						<span class="title inline-edit-categories-label"><?php echo esc_html( $taxonomy->labels->name ); ?></span>
						<input type="hidden" name="<?php echo ( 'category' === $taxonomy->name ) ? 'post_category[]' : 'tax_input[' . esc_attr( $taxonomy->name ) . '][]'; ?>" value="0" />
						<ul class="cat-checklist <?php echo esc_attr( $taxonomy->name ); ?>-checklist">
							<?php wp_terms_checklist( 0, array( 'taxonomy' => $taxonomy->name ) ); ?>
						</ul>

					<?php endforeach; // $hierarchical_taxonomies as $taxonomy ?>

					</div>
				</fieldset>

			<?php endif; // count( $hierarchical_taxonomies ) && ! $bulk ?>

			<fieldset class="inline-edit-col-right">
				<div class="inline-edit-col">

				<?php
				if ( post_type_supports( $screen->post_type, 'author' ) && $bulk ) {
					echo $authors_dropdown;
				}
				?>

				<?php if ( post_type_supports( $screen->post_type, 'page-attributes' ) ) : ?>

					<?php if ( $post_type_object->hierarchical ) : ?>

						<label>
							<span class="title"><?php _e( 'Parent' ); ?></span>
							<?php
							$dropdown_args = array(
								'post_type'         => $post_type_object->name,
								'selected'          => $post->post_parent,
								'name'              => 'post_parent',
								'show_option_none'  => __( 'Main Page (no parent)' ),
								'option_none_value' => 0,
								'sort_column'       => 'menu_order, post_title',
							);

							if ( $bulk ) {
								$dropdown_args['show_option_no_change'] = __( '&mdash; No Change &mdash;' );
							}

							/**
							 * Filters the arguments used to generate the Quick Edit page-parent drop-down.
							 *
							 * @since 2.7.0
							 * @since 5.6.0 The `$bulk` parameter was added.
							 *
							 * @see wp_dropdown_pages()
							 *
							 * @param array $dropdown_args An array of arguments passed to wp_dropdown_pages().
							 * @param bool  $bulk          A flag to denote if it's a bulk action.
							 */
							$dropdown_args = apply_filters( 'quick_edit_dropdown_pages_args', $dropdown_args, $bulk );

							wp_dropdown_pages( $dropdown_args );
							?>
						</label>

					<?php endif; // hierarchical ?>

					<?php if ( ! $bulk ) : ?>

						<label>
							<span class="title"><?php _e( 'Order' ); ?></span>
							<span class="input-text-wrap"><input type="text" name="menu_order" class="inline-edit-menu-order-input" value="<?php echo $post->menu_order; ?>" /></span>
						</label>

					<?php endif; // ! $bulk ?>

				<?php endif; // post_type_supports( ... 'page-attributes' ) ?>

				<?php if ( 0 < count( get_page_templates( null, $screen->post_type ) ) ) : ?>

					<label>
						<span class="title"><?php _e( 'Template' ); ?></span>
						<select name="page_template">
							<?php if ( $bulk ) : ?>
							<option value="-1"><?php _e( '&mdash; No Change &mdash;' ); ?></option>
							<?php endif; // $bulk ?>
							<?php
							/** This filter is documented in wp-admin/includes/meta-boxes.php */
							$default_title = apply_filters( 'default_page_template_title', __( 'Default template' ), 'quick-edit' );
							?>
							<option value="default"><?php echo esc_html( $default_title ); ?></option>
							<?php page_template_dropdown( '', $screen->post_type ); ?>
						</select>
					</label>

				<?php endif; ?>

				<?php if ( count( $flat_taxonomies ) && ! $bulk ) : ?>

					<?php foreach ( $flat_taxonomies as $taxonomy ) : ?>

						<?php if ( current_user_can( $taxonomy->cap->assign_terms ) ) : ?>
							<?php $taxonomy_name = esc_attr( $taxonomy->name ); ?>
							<div class="inline-edit-tags-wrap">
							<label class="inline-edit-tags">
								<span class="title"><?php echo esc_html( $taxonomy->labels->name ); ?></span>
								<textarea data-wp-taxonomy="<?php echo $taxonomy_name; ?>" cols="22" rows="1" name="tax_input[<?php echo esc_attr( $taxonomy->name ); ?>]" class="tax_input_<?php echo esc_attr( $taxonomy->name ); ?>" aria-describedby="inline-edit-<?php echo esc_attr( $taxonomy->name ); ?>-desc"></textarea>
							</label>
							<p class="howto" id="inline-edit-<?php echo esc_attr( $taxonomy->name ); ?>-desc"><?php echo esc_html( $taxonomy->labels->separate_items_with_commas ); ?></p>
							</div>
						<?php endif; // current_user_can( 'assign_terms' ) ?>

					<?php endforeach; // $flat_taxonomies as $taxonomy ?>

				<?php endif; // count( $flat_taxonomies ) && ! $bulk ?>

				<?php if ( post_type_supports( $screen->post_type, 'comments' ) || post_type_supports( $screen->post_type, 'trackbacks' ) ) : ?>

					<?php if ( $bulk ) : ?>

						<div class="inline-edit-group wp-clearfix">

						<?php if ( post_type_supports( $screen->post_type, 'comments' ) ) : ?>

							<label class="alignleft">
								<span class="title"><?php _e( 'Comments' ); ?></span>
								<select name="comment_status">
									<option value=""><?php _e( '&mdash; No Change &mdash;' ); ?></option>
									<option value="open"><?php _e( 'Allow' ); ?></option>
									<option value="closed"><?php _e( 'Do not allow' ); ?></option>
								</select>
							</label>

						<?php endif; ?>

						<?php if ( post_type_supports( $screen->post_type, 'trackbacks' ) ) : ?>

							<label class="alignright">
								<span class="title"><?php _e( 'Pings' ); ?></span>
								<select name="ping_status">
									<option value=""><?php _e( '&mdash; No Change &mdash;' ); ?></option>
									<option value="open"><?php _e( 'Allow' ); ?></option>
									<option value="closed"><?php _e( 'Do not allow' ); ?></option>
								</select>
							</label>

						<?php endif; ?>

						</div>

					<?php else : // $bulk ?>

						<div class="inline-edit-group wp-clearfix">

						<?php if ( post_type_supports( $screen->post_type, 'comments' ) ) : ?>

							<label class="alignleft">
								<input type="checkbox" name="comment_status" value="open" />
								<span class="checkbox-title"><?php _e( 'Allow Comments' ); ?></span>
							</label>

						<?php endif; ?>

						<?php if ( post_type_supports( $screen->post_type, 'trackbacks' ) ) : ?>

							<label class="alignleft">
								<input type="checkbox" name="ping_status" value="open" />
								<span class="checkbox-title"><?php _e( 'Allow Pings' ); ?></span>
							</label>

						<?php endif; ?>

						</div>

					<?php endif; // $bulk ?>

				<?php endif; // post_type_supports( ... comments or pings ) ?>

					<div class="inline-edit-group wp-clearfix">

						<label class="inline-edit-status alignleft">
							<span class="title"><?php _e( 'Status' ); ?></span>
							<select name="_status">
								<?php if ( $bulk ) : ?>
									<option value="-1"><?php _e( '&mdash; No Change &mdash;' ); ?></option>
								<?php endif; // $bulk ?>

								<?php if ( $can_publish ) : // Contributors only get "Unpublished" and "Pending Review". ?>
									<option value="publish"><?php _e( 'Published' ); ?></option>
									<option value="future"><?php _e( 'Scheduled' ); ?></option>
									<?php if ( $bulk ) : ?>
										<option value="private"><?php _e( 'Private' ); ?></option>
									<?php endif; // $bulk ?>
								<?php endif; ?>

								<option value="pending"><?php _e( 'Pending Review' ); ?></option>
								<option value="draft"><?php _e( 'Draft' ); ?></option>
							</select>
						</label>

						<?php if ( 'post' === $screen->post_type && $can_publish && current_user_can( $post_type_object->cap->edit_others_posts ) ) : ?>

							<?php if ( $bulk ) : ?>

								<label class="alignright">
									<span class="title"><?php _e( 'Sticky' ); ?></span>
									<select name="sticky">
										<option value="-1"><?php _e( '&mdash; No Change &mdash;' ); ?></option>
										<option value="sticky"><?php _e( 'Sticky' ); ?></option>
										<option value="unsticky"><?php _e( 'Not Sticky' ); ?></option>
									</select>
								</label>

							<?php else : // $bulk ?>

								<label class="alignleft">
									<input type="checkbox" name="sticky" value="sticky" />
									<span class="checkbox-title"><?php _e( 'Make this post sticky' ); ?></span>
								</label>

							<?php endif; // $bulk ?>

						<?php endif; // 'post' && $can_publish && current_user_can( 'edit_others_posts' ) ?>

					</div>

				<?php if ( $bulk && current_theme_supports( 'post-formats' ) && post_type_supports( $screen->post_type, 'post-formats' ) ) : ?>
					<?php $post_formats = get_theme_support( 'post-formats' ); ?>

					<label class="alignleft">
						<span class="title"><?php _ex( 'Format', 'post format' ); ?></span>
						<select name="post_format">
							<option value="-1"><?php _e( '&mdash; No Change &mdash;' ); ?></option>
							<option value="0"><?php echo get_post_format_string( 'standard' ); ?></option>
							<?php if ( is_array( $post_formats[0] ) ) : ?>
								<?php foreach ( $post_formats[0] as $format ) : ?>
									<option value="<?php echo esc_attr( $format ); ?>"><?php echo esc_html( get_post_format_string( $format ) ); ?></option>
								<?php endforeach; ?>
							<?php endif; ?>
						</select>
					</label>

				<?php endif; ?>

				</div>
			</fieldset>

			<?php
			list( $columns ) = $this->get_column_info();

			foreach ( $columns as $column_name => $column_display_name ) {
				if ( isset( $core_columns[ $column_name ] ) ) {
					continue;
				}

				if ( $bulk ) {

					/**
					 * Fires once for each column in Bulk Edit mode.
					 *
					 * @since 2.7.0
					 *
					 * @param string $column_name Name of the column to edit.
					 * @param string $post_type   The post type slug.
					 */
					do_action( 'bulk_edit_custom_box', $column_name, $screen->post_type );
				} else {

					/**
					 * Fires once for each column in Quick Edit mode.
					 *
					 * @since 2.7.0
					 *
					 * @param string $column_name Name of the column to edit.
					 * @param string $post_type   The post type slug, or current screen name if this is a taxonomy list table.
					 * @param string $taxonomy    The taxonomy name, if any.
					 */
					do_action( 'quick_edit_custom_box', $column_name, $screen->post_type, '' );
				}
			}
			?>

			<div class="submit inline-edit-save">
				<?php if ( ! $bulk ) : ?>
					<?php wp_nonce_field( 'inlineeditnonce', '_inline_edit', false ); ?>
					<button type="button" class="button button-primary save"><?php _e( 'Update' ); ?></button>
				<?php else : ?>
					<?php submit_button( __( 'Update' ), 'primary', 'bulk_edit', false ); ?>
				<?php endif; ?>

				<button type="button" class="button cancel"><?php _e( 'Cancel' ); ?></button>

				<?php if ( ! $bulk ) : ?>
					<span class="spinner"></span>
				<?php endif; ?>

				<input type="hidden" name="post_view" value="<?php echo esc_attr( $m ); ?>" />
				<input type="hidden" name="screen" value="<?php echo esc_attr( $screen->id ); ?>" />
				<?php if ( ! $bulk && ! post_type_supports( $screen->post_type, 'author' ) ) : ?>
					<input type="hidden" name="post_author" value="<?php echo esc_attr( $post->post_author ); ?>" />
				<?php endif; ?>

				<div class="notice notice-error notice-alt inline hidden">
					<p class="error"></p>
				</div>
			</div>
		</div> <!-- end of .inline-edit-wrapper -->

			</td></tr>

			<?php
			$bulk++;
		endwhile;
		?>
		</tbody></table>
		</form>
		<?php
	}