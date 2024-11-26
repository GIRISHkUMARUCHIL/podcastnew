<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>
<div class="tml tml-profile" id="theme-my-login<?php $template->the_instance(); ?>">
	<?php $template->the_action_template_message( 'profile' ); ?>
	<?php $template->the_errors(); ?>
	
	

	<form id="your-profile" action="<?php $template->the_action_url( 'profile', 'login_post' ); ?>" method="post">
		<?php wp_nonce_field( 'update-user_' . $current_user->ID ); ?>
		<p>
			<input type="hidden" name="from" value="profile" />
			<input type="hidden" name="checkuser_id" value="<?php echo esc_html( $current_user->ID ); ?>" />
		</p>
		
		
		<div style="display:none;">
		<table class="tml-form-table">
		<tr class="tml-user-admin-bar-front-wrap">
			<th><label for="admin_bar_front"><?php esc_html_e( 'Toolbar', 'viseo-progression' )?></label></th>
			<td>
				<label for="admin_bar_front"><input type="checkbox" name="admin_bar_front" id="admin_bar_front" value="1"<?php checked( _get_admin_bar_pref( 'front', $profileuser->ID ) ); ?> />
				<?php esc_html_e( 'Show Toolbar when viewing site', 'viseo-progression' ); ?></label>
			</td>
		</tr>
		<?php do_action( 'personal_options', $profileuser ); ?>
		</table>
		</div>

		<?php do_action( 'profile_personal_options', $profileuser ); ?>
		
		<br>
		
		<div class="grid2column-progression">
			
		
			<table class="tml-form-table">
			
				<tr class="tml-first-name-wrap">
					<th><label for="first_name"><?php esc_html_e( 'First Name', 'viseo-progression' ); ?></label></th>
					<td><input type="text" name="first_name" id="first_name" value="<?php echo esc_attr( $profileuser->first_name ); ?>" class="regular-text" /></td>
				</tr>

				<tr class="tml-nickname-wrap">
					<th><label for="nickname"><?php esc_html_e( 'Nickname', 'viseo-progression' ); ?> <span class="description"><?php esc_html_e( '(required)', 'viseo-progression' ); ?></span></label></th>
					<td><input type="text" name="nickname" id="nickname" value="<?php echo esc_attr( $profileuser->nickname ); ?>" class="regular-text" /></td>
				</tr>

				<tr class="tml-user-url-wrap">
					<th><label for="url"><?php esc_html_e( 'Name Sub-headline', 'viseo-progression' ); ?></label></th>
					<td><input type="text" name="progression_user_sub_headline" id="progression_user_sub_headline" value="<?php echo esc_attr( $profileuser->progression_user_sub_headline ); ?>" class="regular-text code" /></td>
				</tr>

			</table>
			
		</div>
		
		<div class="grid2column-progression lastcolumn-progression">
			
			<table class="tml-form-table">
				<tr class="tml-last-name-wrap">
					<th><label for="last_name"><?php esc_html_e( 'Last Name', 'viseo-progression' ); ?></label></th>
					<td><input type="text" name="last_name" id="last_name" value="<?php echo esc_attr( $profileuser->last_name ); ?>" class="regular-text" /></td>
				</tr>

				<tr class="tml-display-name-wrap">
					<th><label for="display_name"><?php esc_html_e( 'Display name publicly as', 'viseo-progression' ); ?></label></th>
					<td>
						<select name="display_name" id="display_name">
						<?php
							$public_display = array();
							$public_display['display_nickname']  = $profileuser->nickname;
							$public_display['display_username']  = $profileuser->user_login;

							if ( ! empty( $profileuser->first_name ) )
								$public_display['display_firstname'] = $profileuser->first_name;

							if ( ! empty( $profileuser->last_name ) )
								$public_display['display_lastname'] = $profileuser->last_name;

							if ( ! empty( $profileuser->first_name ) && ! empty( $profileuser->last_name ) ) {
								$public_display['display_firstlast'] = $profileuser->first_name . ' ' . $profileuser->last_name;
								$public_display['display_lastfirst'] = $profileuser->last_name . ' ' . $profileuser->first_name;
							}

							if ( ! in_array( $profileuser->display_name, $public_display ) )// Only add this if it isn't duplicated elsewhere
								$public_display = array( 'display_displayname' => $profileuser->display_name ) + $public_display;

							$public_display = array_map( 'trim', $public_display );
							$public_display = array_unique( $public_display );

							foreach ( $public_display as $id => $item ) {
						?>
							<option <?php selected( $profileuser->display_name, $item ); ?>><?php echo esc_html($item); ?></option>
						<?php
							}
						?>
						</select>
					</td>
				</tr>
				
			</table>
			
		</div>
		<div class="clearfix-pro"></div>
		
		<br>
		<table class="tml-form-table">
		<tr class="tml-user-description-wrap">
			<th><label for="description"><?php esc_html_e( 'Biographical Info', 'viseo-progression' ); ?></label></th>
			<td><textarea name="description" id="description" rows="5" cols="30"><?php echo esc_html( $profileuser->description ); ?></textarea><br />
			<span class="description-small-pro-registration"><?php esc_html_e( 'Share a little biographical information to fill out your profile. This may be shown publicly.', 'viseo-progression' ); ?></span></td>
		</tr>
		</table>
		
		<br>
		
		<div class="grid2column-progression">
			
			<table class="tml-form-table">
			<tr class="tml-user-email-wrap">
				<th><label for="email"><?php esc_html_e( 'E-mail', 'viseo-progression' ); ?> <span class="description"><?php esc_html_e( '(required)', 'viseo-progression' ); ?></span></label></th>
				<td><input type="text" name="email" id="email" value="<?php echo esc_attr( $profileuser->user_email ); ?>" class="regular-text" /></td>
				<?php
				$new_email = get_option( $current_user->ID . '_new_email' );
				if ( $new_email && $new_email['newemail'] != $current_user->user_email ) : ?>
				<div class="updated inline">
				<p><?php
					printf(
						__( 'There is a pending change of your e-mail to %1$s. <a href="%2$s">Cancel</a>', 'viseo-progression' ),
						'<code>' . $new_email['newemail'] . '</code>',
						esc_url( self_admin_url( 'profile.php?dismiss=' . $current_user->ID . '_new_email' ) )
				); ?></p>
				</div>
				<?php endif; ?>
			</tr>

		
			</table>
			
			
			
		</div>
		<div class="grid2column-progression lastcolumn-progression">
			

			<table class="tml-form-table">


			<tr class="tml-user-url-wrap">
				<th><label for="url"><?php esc_html_e( 'Website', 'viseo-progression' ); ?></label></th>
				<td><input type="text" name="url" id="url" value="<?php echo esc_attr( $profileuser->user_url ); ?>" class="regular-text code" /></td>
			</tr>

			<?php
				foreach ( wp_get_user_contact_methods() as $name => $desc ) {
			?>
			<tr class="tml-user-contact-method-<?php echo esc_html($name); ?>-wrap">
				<th><label for="<?php echo esc_html($name); ?>"><?php echo apply_filters( 'user_'.$name.'_label', $desc ); ?></label></th>
				<td><input type="text" name="<?php echo esc_html($name); ?>" id="<?php echo esc_html($name); ?>" value="<?php echo esc_attr( $profileuser->$name ); ?>" class="regular-text" /></td>
			</tr>
			<?php
				}
			?>
			</table>

		

			
		</div>
		<div class="clearfix-pro"></div>
		

		
		
		
		<br>
		<div class="grid2column-progression">
			
			<h5><?php esc_html_e( 'Social Media Links', 'viseo-progression' ); ?></h5>
			
			<table class="tml-form-table">
			
				<tr class="tml-user-url-wrap">
					<th><label for="url"><?php esc_html_e( 'Facebook Link', 'viseo-progression' ); ?></label></th>
					<td><input type="text" name="progression_facebookurl" id="progression_facebookurl" value="<?php echo esc_attr( $profileuser->progression_facebookurl ); ?>" class="regular-text code" /></td>
				</tr>
	
				<tr class="tml-user-url-wrap">
					<th><label for="url"><?php esc_html_e( 'Twitter Link', 'viseo-progression' ); ?></label></th>
					<td><input type="text" name="progression_twitterurl" id="progression_twitterurl" value="<?php echo esc_attr( $profileuser->progression_twitterurl ); ?>" class="regular-text code" /></td>
				</tr>
	
				<tr class="tml-user-url-wrap">
					<th><label for="url"><?php esc_html_e( 'Pinterest Link', 'viseo-progression' ); ?></label></th>
					<td><input type="text" name="progression_pinteresturl" id="progression_pinteresturl" value="<?php echo esc_attr( $profileuser->progression_pinteresturl ); ?>" class="regular-text code" /></td>
				</tr>
				
				<tr class="tml-user-url-wrap">
					<th><label for="url"><?php esc_html_e( 'Google+ Link', 'viseo-progression' ); ?></label></th>
					<td><input type="text" name="progression_googleplusurl" id="progression_googleplusurl" value="<?php echo esc_attr( $profileuser->progression_googleplusurl ); ?>" class="regular-text code" /></td>
				</tr>
				
				<tr class="tml-user-url-wrap">
					<th><label for="url"><?php esc_html_e( 'Soundcloud Link', 'viseo-progression' ); ?></label></th>
					<td><input type="text" name="progression_soundcloudurl" id="progression_soundcloudurl" value="<?php echo esc_attr( $profileuser->progression_soundcloudurl ); ?>" class="regular-text code" /></td>
				</tr>
	
				<tr class="tml-user-url-wrap">
					<th><label for="url"><?php esc_html_e( 'LinkedIn Link', 'viseo-progression' ); ?></label></th>
					<td><input type="text" name="progression_linkedinurl" id="progression_linkedinurl" value="<?php echo esc_attr( $profileuser->progression_linkedinurl ); ?>" class="regular-text code" /></td>
				</tr>
	
				
	
			</table>
			
		</div>
		<div class="grid2column-progression lastcolumn-progression">
			
			<table class="tml-form-table">
			
				
	<h5>&nbsp;</h5>

	
				<tr class="tml-user-url-wrap">
					<th><label for="url"><?php esc_html_e( 'Instagram Link', 'viseo-progression' ); ?></label></th>
					<td><input type="text" name="progression_instagramurl" id="progression_instagramurl" value="<?php echo esc_attr( $profileuser->progression_instagramurl ); ?>" class="regular-text code" /></td>
				</tr>
	
				<tr class="tml-user-url-wrap">
					<th><label for="url"><?php esc_html_e( 'Youtube Link', 'viseo-progression' ); ?></label></th>
					<td><input type="text" name="progression_youtubeurl" id="progression_youtubeurl" value="<?php echo esc_attr( $profileuser->progression_youtubeurl ); ?>" class="regular-text code" /></td>
				</tr>
				
				<tr class="tml-user-url-wrap">
					<th><label for="url"><?php esc_html_e( 'Vimeo Link', 'viseo-progression' ); ?></label></th>
					<td><input type="text" name="progression_vimeourl" id="progression_vimeourl" value="<?php echo esc_attr( $profileuser->progression_vimeourl ); ?>" class="regular-text code" /></td>
				</tr>
				
				<tr class="tml-user-url-wrap">
					<th><label for="url"><?php esc_html_e( 'Dribbble Link', 'viseo-progression' ); ?></label></th>
					<td><input type="text" name="progression_dribbbleurleurl" id="progression_dribbbleurleurl" value="<?php echo esc_attr( $profileuser->progression_dribbbleurleurl ); ?>" class="regular-text code" /></td>
				</tr>
				
				<tr class="tml-user-url-wrap">
					<th><label for="url"><?php esc_html_e( 'Houzz Link', 'viseo-progression' ); ?></label></th>
					<td><input type="text" name="progression_houzzurl" id="progression_houzzurl" value="<?php echo esc_attr( $profileuser->progression_houzzurl ); ?>" class="regular-text code" /></td>
				</tr>
	
				<tr class="tml-user-url-wrap">
					<th><label for="url"><?php esc_html_e( 'E-mail Address', 'viseo-progression' ); ?></label></th>
					<td><input type="text" name="progression_emailmailto" id="progression_emailmailto" value="<?php echo esc_attr( $profileuser->progression_emailmailto ); ?>" class="regular-text code" /></td>
				</tr>
			</table>
			
		</div>
		<div class="clearfix-pro"></div>
		
		
		<table class="tml-form-table">


		<?php
		$show_password_fields = apply_filters( 'show_password_fields', true, $profileuser );
		if ( $show_password_fields ) :
		?>

		<br>
		<h5><?php esc_html_e( 'Account Management', 'viseo-progression' ); ?></h5>
		<table class="tml-form-table lost-password-pro">
		<tr id="password" class="user-pass1-wrap">
			<th><label for="pass1"><?php esc_html_e( 'New Password', 'viseo-progression' ); ?></label></th>
			<td>
				<input class="hidden" value=" " /><!-- #24364 workaround -->
				<button type="button" class="button button-secondary wp-generate-pw hide-if-no-js"><?php esc_html_e( 'Generate Password', 'viseo-progression' ); ?></button>
				<div class="wp-pwd hide-if-js">
					<span class="password-input-wrapper">
						<input type="password" name="pass1" id="pass1" class="regular-text" value="" autocomplete="off" data-pw="<?php echo esc_attr( wp_generate_password( 24 ) ); ?>" aria-describedby="pass-strength-result" />
					</span>
					<div style="display:none" id="pass-strength-result" aria-live="polite"></div>
					<button type="button" class="button button-secondary wp-hide-pw hide-if-no-js" data-toggle="0" aria-label="<?php esc_attr_e( 'Hide password', 'viseo-progression' ); ?>">
						<span class="dashicons dashicons-hidden"></span>
						<span class="text"><?php esc_html_e( 'Hide', 'viseo-progression' ); ?></span>
					</button>
					<button type="button" class="button button-secondary wp-cancel-pw hide-if-no-js" data-toggle="0" aria-label="<?php esc_attr_e( 'Cancel password change', 'viseo-progression' ); ?>">
						<span class="text"><?php esc_html_e( 'Cancel', 'viseo-progression' ); ?></span>
					</button>
				</div>
			</td>
		</tr>
		<tr class="user-pass2-wrap hide-if-js">
			<th scope="row"><label for="pass2"><?php esc_html_e( 'Repeat New Password', 'viseo-progression' ); ?></label></th>
			<td>
			<input name="pass2" type="password" id="pass2" class="regular-text" value="" autocomplete="off" />
			<p class="description"><?php esc_html_e( 'Type your new password again.', 'viseo-progression' ); ?></p>
			</td>
		</tr>
		<tr class="pw-weak">
			<th><?php esc_html_e( 'Confirm Password', 'viseo-progression' ); ?></th>
			<td>
				<label>
					<input type="checkbox" name="pw_weak" class="pw-checkbox" />
					<?php esc_html_e( 'Confirm use of weak password', 'viseo-progression' ); ?>
				</label>
			</td>
		</tr>
		<?php endif; ?>

		</table>


		<?php do_action( 'show_user_profile', $profileuser ); ?>
		
		
		<br>
		
		<p class="tml-submit-wrap">
			<input type="hidden" name="action" value="profile" />
			<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
			<input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr( $current_user->ID ); ?>" />
			<input type="submit" class="button-primary" value="<?php esc_attr_e( 'Update Profile', 'viseo-progression' ); ?>" name="submit" id="submit" />
		</p>
	</form>
</div>
