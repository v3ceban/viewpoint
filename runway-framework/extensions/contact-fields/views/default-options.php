<form action="<?php echo $this->self_url(); ?>&action=update-defaults" method="post">

	<?php wp_nonce_field( 'update-defaults-nonce' ,'update-defaults-nonce' ); ?>

	<a name="options_contact"></a>
	<h3><?php _e( 'Contact Form', 'runway' ); ?></h3>
	<p><?php echo sprintf( __( 'Display your form with the %s shortcode. You can customize each instance with unique values for %s, %s and %s in the form. Empty fields use the default settings established in the fields below.' ,'runway' ), '<code>[contact_form]</code>', '<code>to</code>', '<code>subject</code>', '<code>thankyou</code>' ); ?></p>

	<?php
	// Some values used in multiple locations
	$to       = ( isset( $defaults['to'] ) ) ? stripslashes( $defaults['to'] ) : get_option( 'admin_email' );
	$subject  = ( isset( $defaults['subject'] ) ) ? stripslashes( $defaults['subject'] ) : __( 'Email from Contact Form', 'runway' );
	$thankyou = ( isset( $defaults['thankyou'] ) ) ? esc_textarea( stripslashes( $defaults['thankyou'] ) ) : __( 'Thank you. Your message has been sent.', 'runway' );
	$button   = ( isset( $defaults['button'] ) ) ? stripslashes( $defaults['button'] ) : __( 'Send', 'runway' );
	?>

	<table class="form-table">
		<tbody>
			<tr>
				<th scope="row" valign="top"><?php _e( 'Email To', 'runway' ) ?></th>
				<td>
					<input class="input-text " type="text" name="defaults[to]" value="<?php echo $to; ?>">
					<p class="description"><?php _e( 'The default address to deliver messages sent from contact forms.', 'runway' ) ?></p>
				</td>
			</tr>

			<tr>
				<th scope="row" valign="top"><?php _e( 'Subject', 'runway' ) ?></th>
				<td><input class="input-text " type="text" name="defaults[subject]" value="<?php echo $subject; ?>"><p class="description"><?php _e( 'Enter the default email subject for contact form messages.', 'runway' ) ?></p></td>
			</tr>

			<tr>
				<th scope="row" valign="top"><?php _e( 'Thank You Message', 'runway' ) ?></th>
				<td><textarea class="input-textarea " name="defaults[thankyou]"><?php echo $thankyou; ?></textarea><p class="description"><?php _e( 'The "thank you" message visitors will see after sending. HTML is allowed.', 'runway' ) ?></p></td>
			</tr>

			<tr>
				<th scope="row" valign="top"><?php _e( 'Button text', 'runway' ) ?></th>
				<td><input class="input-text " type="text" name="defaults[button]" value="<?php echo $button; ?>"><p class="description"><?php _e( 'The text to appear on the send button. Default: "Send"', 'runway' ) ?></p></td>
			</tr>
			
			<tr>
				<th scope="row" valign="top"><?php _e('Use CAPTCHA', 'runway') ?></th>
				<td>
					<label><input class="input-radio" type="radio" name="defaults[captcha]" value="1" <?php echo isset($defaults['captcha']) && $defaults['captcha'] ? 'checked="checked"' : ''; ?>> <?php _e( 'Yes', 'runway' ) ?></label><br>
					<label><input class="input-radio" type="radio" name="defaults[captcha]" value="0" <?php echo ( ! isset( $defaults['captcha'] ) || !$defaults['captcha'] ) ? 'checked="checked"' : ''; ?>> <?php _e( 'No', 'runway' ) ?></label>
					<p class="description"><?php _e('Require CAPTCHA image verification?', 'runway') ?></p>
					<p><img src="<?php echo FRAMEWORK_URL .'extensions/contact-fields/inc/captcha/captcha.php?'. base_convert( mt_rand( 0x1679616, 0x39AA3FF ), 10, 36 ) ?>" id="captcha"></p>

					<?php _e( 'Sample image.', 'runway' ) ?> 

					<a href="#" onclick="document.getElementById('captcha').src='<?php echo FRAMEWORK_URL .'extensions/contact-fields/inc/captcha/captcha.php?' ?>_' + Math.random(); return false;" id="refreshCaptcha"><?php _e( 'Refresh?', 'runway' ) ?></a>
				</td>
			</tr>
			
		</tbody>
	</table>

	<input class="button-primary" type="submit" value="<?php _e( 'Save Settings', 'runway' ) ?>">
</form>

<br>
<div class="hr"></div>
<br>