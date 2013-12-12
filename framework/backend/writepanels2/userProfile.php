<?php
function ff_add_custom_user_profile_fields( $user ) {
	?>
	<h3><?php _e('Extra Profile Information', 'your_textdomain'); ?></h3>
	<table class="form-table">
		<tr>
			<th>
				<label for="address"><?php _e('Social Links', 'your_textdomain'); ?>
			</label></th>
			<td>
				<textarea name="social_links" id="social_links" rows="5" cols="30"><?php echo esc_attr( get_the_author_meta( 'social_links', $user->ID ) ); ?></textarea><br />
				<span class="description"><?php _e('Please enter your social links.', 'your_textdomain'); ?></span>
			</td>
		</tr>
	</table>
<?php }
function ff_save_custom_user_profile_fields( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) )
		return FALSE;
	update_user_meta( $user_id, 'social_links', $_POST['social_links'] );
	
}
add_action( 'show_user_profile', 'ff_add_custom_user_profile_fields' );
add_action( 'edit_user_profile', 'ff_add_custom_user_profile_fields' );
add_action( 'personal_options_update', 'ff_save_custom_user_profile_fields' );
add_action( 'edit_user_profile_update', 'ff_save_custom_user_profile_fields' );