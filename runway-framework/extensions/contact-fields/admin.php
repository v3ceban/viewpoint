<?php

global $contact_fields_admin, $contact_fields;

// Beadcrumbs
$navText = array();
switch ($this->navigation) {
	case 'add-field':
		$navText = array( __( 'Add Field', 'runway' ) );
		break;
	case 'edit-field':
		$navText = array( __( 'Edit Field', 'runway' ) );
		break;
	default:
		$navText = array( __( 'Settings', 'runway' ) );
		break;
}
// if ($this->navigation) {
	$this->navigation_bar( $navText );
// }

$required = '<em class="required">' . __( 'Required', 'runway' ) . '</em>';
$_data = $contact_fields_admin->data;

$action = isset( $_REQUEST['action'] ) ? $_REQUEST['action'] : '';
if( $action != '' ){
	switch ( $action ) {	

		case 'update-field': {
			check_admin_referer( 'update-field-nonce', 'update-field-nonce' );

			$options = isset( $_REQUEST['field'] ) ? $_REQUEST['field'] : '';

			if( $options != '' && is_array( $options ) ) {
				$contact_fields_admin->update_field( $options );
				echo "<script>location.href = 'options-general.php?page=contact-form';</script>";
			}
		} break; 

		case 'duplicate-field': {
			check_admin_referer( 'duplicate-field' );

			$alias = isset( $_REQUEST['alias'] ) ? sanitize_title( $_REQUEST['alias'] ) : '';
			if( $alias != '' ) {
				$contact_fields_admin->duplicate_field( $alias );
				echo "<script>location.href = 'options-general.php?page=contact-form';</script>";
			}
		} break;

		case 'update-defaults': {
			check_admin_referer( 'update-defaults-nonce', 'update-defaults-nonce' );

			$options = isset( $_REQUEST['defaults'] ) ? $_REQUEST['defaults'] : '';

			if( $options != '' && is_array( $options ) ) {
				$contact_fields_admin->update_defaults( $options );
				echo "<script>location.href = 'options-general.php?page=contact-form';</script>";
			}
		} break;
		
		case 'delete-field': {
			check_admin_referer( 'delete-field' );

			$alias = isset( $_REQUEST['alias'] ) ? sanitize_title( $_REQUEST['alias'] ) : '';
			if( $alias != '' ){
				$contact_fields_admin->delete_field( $alias );
				echo "<script>location.href = 'options-general.php?page=contact-form';</script>";
			}
		} break;

		default:{
			// nothing to do
		} break;
	}
}

switch ( $this->navigation ) {
	case 'add-field':
	case 'edit-field':
		$field = array();
		$alias = isset( $_REQUEST['alias'] ) ? sanitize_title( $_REQUEST['alias'] ) : '';
		if ( $alias ) {
			$field = $contact_fields_admin->get_field( $alias );
		}
		require_once( 'views/field-options.php' );
	break;

	default:
		if( isset( $action ) && $action == 'update-defaults' ) {
			$options = isset( $_REQUEST['defaults'] ) ? $_REQUEST['defaults'] : '';
			if( $options != '' && is_array( $options ) ) {
				$defaults = $options;
			}
			else
				$defaults = $contact_fields->get_defaults();
		}
		else
			$defaults = $contact_fields->get_defaults();
		$fields = $contact_fields->get_fields();
		require_once( 'views/default-options.php' );
		require_once( 'views/fields-list.php' );
}   

?>