<?php
/**
 * BuddyPress - Groups Admin - Group Settings
 */

?>

<div class="yz-group-settings-tab">

	<?php

	/**
	 * Fires before the group settings admin display.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_before_group_settings_admin' ); ?>

	<?php if ( bp_is_active( 'forums' ) ) : ?>

		<?php if ( bp_forums_is_installed_correctly() ) : ?>

			<div class="checkbox">
				<label for="group-show-forum"><input type="checkbox" name="group-show-forum" id="group-show-forum" value="1"<?php bp_group_show_forum_setting(); ?> /> <?php _e( 'Enable discussion forum', 'youzer' ); ?></label>
			</div>

			<hr />

		<?php endif; ?>

	<?php endif; ?>
	
	<?php if ( apply_filters( 'yz_enable_groups_privacy_settings', true ) ) : ?>

	<fieldset class="group-create-privacy">

		<legend><?php _e( 'Privacy Options', 'youzer' ); ?></legend>

		<div class="radio">

			<label for="group-status-public"><input type="radio" name="group-status" id="group-status-public" value="public"<?php if ( 'public' == bp_get_new_group_status() || !bp_get_new_group_status() ) { ?> checked="checked"<?php } ?> aria-describedby="public-group-description" /> <?php _e( 'This is a public group', 'youzer' ); ?></label>

			<ul id="public-group-description">
				<li><?php _e( 'Any site member can join this group.', 'youzer' ); ?></li>
				<li><?php _e( 'This group will be listed in the groups directory and in search results.', 'youzer' ); ?></li>
				<li><?php _e( 'Group content and activity will be visible to any site member.', 'youzer' ); ?></li>
			</ul>

			<label for="group-status-private"><input type="radio" name="group-status" id="group-status-private" value="private"<?php if ( 'private' == bp_get_new_group_status() ) { ?> checked="checked"<?php } ?> aria-describedby="private-group-description" /> <?php _e( 'This is a private group', 'youzer' ); ?></label>

			<ul id="private-group-description">
				<li><?php _e( 'Only users who request membership and are accepted can join the group.', 'youzer' ); ?></li>
				<li><?php _e( 'This group will be listed in the groups directory and in search results.', 'youzer' ); ?></li>
				<li><?php _e( 'Group content and activity will only be visible to members of the group.', 'youzer' ); ?></li>
			</ul>

			<label for="group-status-hidden"><input type="radio" name="group-status" id="group-status-hidden" value="hidden"<?php if ( 'hidden' == bp_get_new_group_status() ) { ?> checked="checked"<?php } ?> aria-describedby="hidden-group-description" /> <?php _e('This is a hidden group', 'youzer' ); ?></label>

			<ul id="hidden-group-description">
				<li><?php _e( 'Only users who are invited can join the group.', 'youzer' ); ?></li>
				<li><?php _e( 'This group will not be listed in the groups directory or search results.', 'youzer' ); ?></li>
				<li><?php _e( 'Group content and activity will only be visible to members of the group.', 'youzer' ); ?></li>
			</ul>

		</div>

	</fieldset>
	
		<?php else : ?>
			<input type="hidden" name="group-status" id="group-status-hidden" value="<?php echo bp_get_new_group_status(); ?>" aria-describedby="hidden-group-description" />
		<?php endif; ?>
		
	<?php // Group type selection ?>

	<?php if ( $group_types = bp_groups_get_group_types( array( 'show_in_create_screen' => true ), 'objects' ) ): ?>

		<fieldset class="group-create-types">
			<legend><?php _e( 'Group Types', 'youzer' ); ?></legend>

			<p><?php _e( 'Select the types this group should be a part of.', 'youzer' ); ?></p>

			<?php foreach ( $group_types as $type ) : ?>
				<div class="checkbox">
					<label for="<?php printf( 'group-type-%s', $type->name ); ?>">
						<input type="checkbox" name="group-types[]" id="<?php printf( 'group-type-%s', $type->name ); ?>" value="<?php echo esc_attr( $type->name ); ?>" <?php checked( bp_groups_has_group_type( bp_get_current_group_id(), $type->name ) ); ?>/> <?php echo esc_html( $type->labels['name'] ); ?>
						<?php
							if ( ! empty( $type->description ) ) {
								printf( __( '&ndash; %s', 'youzer' ), '<span class="bp-group-type-desc">' . esc_html( $type->description ) . '</span>' );
							}
						?>
					</label>
				</div>

			<?php endforeach; ?>

		</fieldset>

	<?php endif; ?>

	<fieldset class="group-create-invitations">

		<legend><?php _e( 'Group Invitations', 'youzer' ); ?></legend>

		<p><?php _e( 'Which members of this group are allowed to invite others?', 'youzer' ); ?></p>

		<div class="radio">

			<label for="group-invite-status-members"><input type="radio" name="group-invite-status" id="group-invite-status-members" value="members"<?php bp_group_show_invite_status_setting( 'members' ); ?> /> <?php _e( 'All group members', 'youzer' ); ?></label>

			<label for="group-invite-status-mods"><input type="radio" name="group-invite-status" id="group-invite-status-mods" value="mods"<?php bp_group_show_invite_status_setting( 'mods' ); ?> /> <?php _e( 'Group admins and mods only', 'youzer' ); ?></label>

			<label for="group-invite-status-admins"><input type="radio" name="group-invite-status" id="group-invite-status-admins" value="admins"<?php bp_group_show_invite_status_setting( 'admins' ); ?> /> <?php _e( 'Group admins only', 'youzer' ); ?></label>

		</div>

	</fieldset>

	<?php

	/**
	 * Fires after the group settings admin display.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_after_group_settings_admin' ); ?>
	<div class="yz-group-submit-form">
		<input type="submit" value="<?php esc_attr_e( 'Save Changes', 'youzer' ); ?>" id="save" name="save" />
	</div>
	<?php wp_nonce_field( 'groups_edit_group_settings' ); ?>
</div>