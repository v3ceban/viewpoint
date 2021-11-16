<?php if( ! empty( $fields ) ): ?>
	<table class="wp-list-table widefat" style="width: auto; min-width: 50%;">
		<thead>
			<tr>
				<th id="name" class="manage-column column-name"><?php _e( 'Field', 'runway' ) ?></th>
				<th id="field-alias" class="manage-column column-alias"><?php _e( 'Shortcode alias', 'runway' ) ?></th>
				<th id="field-type" class="manage-column column-type"><?php _e( 'Type', 'runway' ) ?></th>
				<th id="field-required" class="manage-column column-required"><?php _e( 'Required', 'runway' ) ?></th>
				<th id="field-actions" class="manage-column column-actions" style="text-align:right;"><?php _e( 'Actions', 'runway' ) ?></th>
			</tr>
		</thead>
		<tbody id="the-list">
			<?php foreach ( $fields as $key => $values ): ?>
				<tr class="active">
					<td class="plugin-title">
						<a href="<?php echo $this->self_url( 'edit-field' ); ?>&alias=<?php echo $values['alias']; ?>"><strong><?php echo $values['label']; ?></strong></a>
					</td>
					<td class="column-alias">
						<?php echo $values['alias']; ?>
					</td>
					<td class="column-type">
						<?php echo $values['field_type']; ?>
					</td>
					<td class="column-required">
						<?php echo ( $values['required'] ) ? __( 'Yes','runway' ) : __( 'No','runway' ); ?>
					</td>
					<td class="column-actions" style="text-align:right;">
						<a href="<?php echo $this->self_url( 'edit-field' ); ?>&alias=<?php echo $values['alias']; ?>"><?php _e( 'Edit', 'runway' ) ?></a> | 
						<a href="<?php echo $this->self_url(); ?>&action=duplicate-field&alias=<?php echo $values['alias']; ?>&_wpnonce=<?php echo wp_create_nonce( 'duplicate-field' ); ?>"><?php _e( 'Duplicate', 'runway' ) ?></a> | 
						<a style="color: #BC0B0B;" href="<?php echo $this->self_url(); ?>&action=delete-field&alias=<?php echo $values['alias']; ?>&_wpnonce=<?php echo wp_create_nonce( 'delete-field' ); ?>"><?php _e( 'Delete', 'runway' ) ?></a>
					</td>
				</tr>					
			<?php endforeach; ?>
		</tbody>
	</table>
<?php else: ?>

	<h3><?php _e( 'No fields created created yet.', 'runway' ) ?></h3>

<?php endif; ?>

<p><a href="<?php echo $this->self_url( 'add-field' ); ?>" class="button"><?php _e( 'Add new Field', 'runway' ) ?></a></p>


<div class="hr"></div>

<h3><?php _e( 'Shortcode Samples', 'runway' ) ?></h3>

<p><code style="font-size:13px;">[contact_form]</code></p>

<p><code style="font-size:13px;">[contact_form to="<?php echo $to ?>" subject="<?php echo $subject ?>" thankyou="<?php echo $thankyou ?>" button="<?php echo $button ?>" ]</code></p>

<?php
// If we have user created fields...
if ( ! empty( $fields ) ) {
	// Print another shortcode sample with ALL custom fields
	$alias_list = array();
	foreach( (array) $fields as $key => $values ) {
		if ( ! $key ) continue;
		array_push( $alias_list, $values['alias'] );
	}
	// Add another shortcode
	$alias_fields =	implode( ",", $alias_list );
}
?>

<?php if( isset( $alias_fields ) ): ?>
<p><code style="font-size:13px;">[contact_form fields="<?php echo $alias_fields ?>"]</code></p>
<?php endif ?>

<p class="description"><?php _e( 'Above are examples of how you can add the shortcode to your content.', 'runway' ) ?></p>

<br>