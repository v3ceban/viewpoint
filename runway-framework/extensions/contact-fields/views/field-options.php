<form action="<?php echo $this->self_url(); ?>&action=update-field" method="post">

	<?php wp_nonce_field( 'update-field-nonce' ,'update-field-nonce' ); ?>
	
	<table class="form-table">
		<tbody>
			<tr>
				<th scope="row" valign="top"><?php _e( 'Field title', 'runway' ) ?><br><em class="required"><?php _e( 'Required', 'runway' ) ?></em></th>
				<td>
					<input class="input-text" type="text" name="field[label]" value="<?php echo isset( $field['label'] ) ? stripslashes( $field['label'] ) : ''; ?>">
					<p class="description"><?php _e( 'The name of the field as it will be displayed in the form.', 'runway' ) ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row" valign="top"><?php _e( 'Alias (unique identifier)', 'runway' ) ?><br><em class="required"><?php _e( 'Required', 'runway' ) ?></em></th>
				<td>
					<input class="input-text" type="text" name="field[alias]" value="<?php echo isset( $field['alias'] ) ? stripslashes( $field['alias'] ) : ''; ?>">
					<p class="description"><?php _e( 'This alias is used to add the field to contact forms.', 'runway' ) ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row" valign="top"><?php _e( 'Caption', 'runway' ) ?></th>
				<td>
					<textarea class="input-textarea " name="field[caption]"><?php echo isset( $field['caption'] ) ? esc_textarea( stripslashes( $field['caption'] ) ) : ''; ?></textarea>
					<p class="description"><?php _e( 'You can add instructions or information for the user about this field. HTML code is allowed.', 'runway' ) ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row" valign="top"><?php _e( 'Field type', 'runway' ) ?><p class="description"></p></th>
				<td>
					<label><input class="input-radio" type="radio" name="field[field_type]" value="text" <?php echo ( isset( $field['field_type'] ) && $field['field_type'] == 'text' || ! isset( $field['field_type'] ) ) ? 'checked="checked"' : ''; ?>> <?php _e( 'Text', 'runway' ) ?></label>
					<label><input class="input-radio" type="radio" name="field[field_type]" value="textarea" <?php echo isset( $field['field_type'] ) && $field['field_type'] == 'textarea' ? 'checked="checked"' : ''; ?>> <?php _e( 'Textarea', 'runway' ) ?></label>
					<label><input class="input-radio" type="radio" name="field[field_type]" value="select" <?php echo isset( $field['field_type'] ) && $field['field_type'] == 'select' ? 'checked="checked"' : ''; ?>> <?php _e( 'Select', 'runway' ) ?></label>
					<label><input class="input-radio" type="radio" name="field[field_type]" value="radio" <?php echo isset( $field['field_type'] ) && $field['field_type'] == 'radio' ? 'checked="checked"' : ''; ?>> <?php _e( 'Radio button (set)', 'runway' ) ?></label>
					<label><input class="input-radio" type="radio" name="field[field_type]" value="checkbox" <?php echo isset( $field['field_type'] ) && $field['field_type'] == 'checkbox' ? 'checked="checked"' : ''; ?>> <?php _e( 'Checkbox', 'runway' ) ?></label>
					<label><input class="input-radio" type="radio" name="field[field_type]" value="hidden" <?php echo isset( $field['field_type'] ) && $field['field_type'] == 'hidden' ? 'checked="checked"' : ''; ?>> <?php _e( 'Hidden', 'runway' ) ?></label>
				</td>
			</tr>
			<tr>
				<th scope="row" valign="top"><?php _e( 'Values (if applicable)', 'runway' ) ?></th>			
				<td>
					<input class="input-text" type="text" name="field[values]" value="<?php echo isset( $field['values'] ) ? stripslashes( $field['values'] ) : ''; ?>">
					<p class="description"><?php echo sprintf( __( 'Set the value of hidden fields here or they will contain no information.<br><br>If your selected field type requires pre-defined options, such as radio buttons or select boxes, enter the values here as a comma separated list. For example, your values could be entered as %s.', 'runway' ), '<code>Good, Better, Best</code>' ) ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row" valign="top"><?php _e( 'Required', 'runway' ) ?></th>
				<td>
					<label><input class="input-radio" type="radio" name="field[required]" value="1" <?php echo isset( $field['required'] ) && $field['required'] ? 'checked="checked"' : ''; ?>> <?php _e( 'Yes', 'runway' ) ?></label>
					<label><input class="input-radio" type="radio" name="field[required]" value="0" <?php echo ! isset( $field['required'] ) || ! $field['required'] ? 'checked="checked"' : ''; ?>> <?php _e( 'No', 'runway' ) ?></label>
					<p class="description"><?php _e( 'Require users to enter a value?', 'runway' ) ?></p></td>
			</tr>
			<tr>
				<th scope="row" valign="top"><?php _e( 'Required error message', 'runway' ) ?><br><em class="required"><?php _e( 'Required', 'runway' ) ?></em></th>
				<td>
					<input class="input-text" type="text" name="field[error_required]" value="<?php echo isset( $field['error_required'] ) ? stripslashes( $field['error_required'] ) : ''; ?>">
					<p class="description"><?php _e( 'Enter an optional error message for empty fields that are required.', 'runway' ) ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row" valign="top"><?php _e( 'Minimum length', 'runway' ) ?></th>
				<td>
					<input class="input-text" type="text" name="field[minlength]" value="<?php echo isset( $field['minlength'] ) ? stripslashes( $field['minlength'] ) : ''; ?>">
					<p class="description"><?php _e( 'You can optionally specify a minimum number of characters allowed for this field.', 'runway' ) ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row" valign="top"><?php _e( 'Maximum length', 'runway' ) ?></th>
				<td>
					<input class="input-text" type="text" name="field[maxlength]" value="<?php echo isset( $field['maxlength'] ) ? stripslashes( $field['maxlength'] ) : ''; ?>">
					<p class="description"><?php _e( 'You can optionally specify a maximum number of characters allowed for this field.', 'runway' ) ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row" valign="top"><?php _e( 'Validation', 'runway' ) ?> <p class="description"><?php _e( 'You can apply validation to some fields to ensure valid entries.', 'runway' ) ?></p></th>
				<td>
					<select class="input-select" name="field[validation]">
						<option value="" <?php echo ! isset( $field['validation'] ) ? 'selected="selected"' : ''; ?>> </option>
						<option value="email" <?php echo isset( $field['validation'] ) && $field['validation'] == 'email' ? 'selected="selected"' : ''; ?>> <?php _e( 'Email address', 'runway' ) ?></option>
						<option value="url" <?php echo isset( $field['validation'] ) && $field['validation'] == 'url' ? 'selected="selected"' : ''; ?>> <?php _e( 'Website address (URL)', 'runway' ) ?></option>
						<option value="date" <?php echo isset( $field['validation'] ) && $field['validation'] == 'date' ? 'selected="selected"' : ''; ?>> <?php _e( 'Date', 'runway' ) ?></option>
						<option value="digits" <?php echo isset( $field['validation'] ) && $field['validation'] == 'digits' ? 'selected="selected"' : ''; ?>> <?php _e( 'Numbers only', 'runway' ) ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="row" valign="top"><?php _e( 'Validation error message', 'runway' ) ?> <br><em class="required"><?php _e( 'Required', 'runway' ) ?></em>
				</th>
				<td>
					<input class="input-text" type="text" name="field[error_validation]" value="<?php echo isset( $field['error_validation'] ) ? stripslashes( $field['error_validation'] ) : ''; ?>">
					<p class="description"><?php _e( 'Enter an optional error message for fields that fail validation.', 'runway' ) ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row" valign="top"><?php _e( 'Input width', 'runway' ) ?></th>
				<td>
					<input class="input-text" type="text" name="field[size][width]" value="<?php echo isset( $field['size']['width'] ) ? stripslashes( $field['size']['width'] ) : ''; ?>">
					<p class="description"><?php _e( 'Optional. You can specify the width of the field in pixels. Does not apply to some input types.', 'runway' ) ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row" valign="top"><?php _e( 'Input height', 'runway' ) ?></th>
				<td>
					<input class="input-text" type="text" name="field[size][height]" value="<?php echo isset( $field['size']['height'] ) ? stripslashes( $field['size']['height'] ) : ''; ?>">
					<p class="description"><?php _e( 'Optional. You can specify the height of the field in pixels. Does not apply to some input types.', 'runway' ) ?></p>
				</td>
			</tr>
			</tbody>

	</table>

	<input class="button-primary" type="submit" value="<?php _e( 'Save Field Settings', 'runway' ) ?>">
</form>