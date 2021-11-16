<?php
// Info and Alert Messages
if ( $info_message != '' ) {
	echo '<div id="message" class="updated"><p>'. $info_message .'</p></div>';
}

$ext_inactive_status = '';
switch ( $this->navigation ) {
	case ( 'inactive' ):{
		$ext_inactive_status = 'class="current"';
		
	} break;
	case ( 'upgrade' ):{
		$ext_upgrade_status = 'class="current"';
	} break;
	default:{
		$ext_all_status = 'class="current"';
	}
}
?>
<ul class="subsubsub">
	<li class="all"><a href="<?php echo admin_url('admin.php?page=extensions&navigation=all'); ?>" <?php echo isset($ext_all_status) ? $ext_all_status : ""; ?>><?php echo __( 'All', 'framework' );?> <span class="count">(<?php echo $ext_all_total; ?>)</span></a> |</li>
	<li class="inactive"><a href="<?php echo admin_url('admin.php?page=extensions&navigation=inactive'); ?>" <?php echo isset($ext_inactive_status) ? $ext_inactive_status : ''; ?>><?php echo __( 'Inactive', 'framework' );?> <span class="count">(<?php echo $ext_inactive_total; ?>)</span></a></li>	
</ul>
<form method="post" action="<?php echo admin_url('admin.php?page=extensions&navigation=search#add-exts'); ?>" class="clear">
	<p class="search-box">
		<label class="screen-reader-text" for="exts-search-input"><?php echo __( 'Search Extensions', 'framework' );?>:</label>
		<input type="search" id="exts-search-input" name="exts-search-input" value="<?php echo isset($_POST['exts-search-input']) ? $_POST['exts-search-input'] : ''; ?>">
		<input type="submit" name="ext-search-submit" id="ext-search-submit" class="button" value="<?php echo __('Search Extensions', 'framework'); ?>"></p>
</form>

<form action="<?php echo admin_url('admin.php?page=extensions&navigation=bulk-actions'); ?>" method="post">
	<?php wp_nonce_field( 'extensions-bulk-actions' ); ?>
	<div class="alignleft actions">
		<select name="action">
			<option value="-1" selected="selected"><?php echo __( 'Bulk Actions', 'framework' );?></option>
			<option value="activate-selected"><?php echo __( 'Activate', 'framework' );?></option>
			<option value="deactivate-selected"><?php echo __( 'Deactivate', 'framework' );?></option>
			<option value="delete-selected"><?php echo __( 'Delete', 'framework' );?></option>
		</select>
		<input type="submit" name="bulk-actions-submit" class="button-secondary action" value="Apply">
	</div>
<br><br>

<table class="wp-list-table widefat">
	<thead>
		<tr>
			<th scope="col" id="cb" class="manage-column column-cb check-column" style="width: 0px;"><input type="checkbox" name="ext_chk[]" /></th>
			<th id="name" class="manage-column column-name"><?php echo __( 'Extension', 'framework' );?></th>
			<th id="description" class="manage-column column-description"><?php echo __( 'Description', 'framework' );?></th>
		</tr>
	</thead>
	<tbody id="the-list">
	<?php
if ( !empty( $exts ) ):
	foreach ( $exts as $ext => $ext_info ):
		$ext_cnt = !$extm->is_activated( $ext );
?>
		<tr <?php if ( $ext_cnt ): ?> class="inactive" <?php else:  ?> calss="active" <?php endif; ?> >
			<th class="check-column">
				<input type="checkbox" name="ext_chk[]" value="<?php echo $ext; ?>" />
			</th>
			<td class="plugin-title">
				<strong><?php echo $ext_info['Name']; ?></strong>
				<?php if ( $ext_cnt ): ?>
					<br><a href="<?php echo admin_url('admin.php?page=extensions&navigation=extension-activate&ext='.urlencode( $ext ).'&_wpnonce='.wp_create_nonce('extension-activate')); ?>"><?php echo __( 'Activate', 'framework' );?></a> |
					<a style="color: #BC0B0B;" href="<?php echo admin_url('admin.php?page=extensions&navigation=del-extension-confirm&ext='.urlencode( $ext )); ?>"><?php echo __( 'Delete', 'framework' );?></a>
				<?php elseif ( !$ext_cnt ): ?>
					<br><a class="edit" href="<?php echo admin_url('admin.php?page=extensions&navigation=extension-deactivate&ext='.urlencode( $ext ).'&_wpnonce='.wp_create_nonce('extension-deactivate')); ?>"><?php echo __( 'Deactivate', 'framework' );?></a>
				<?php endif;?>
			</td>
			<td class="column-description desc">
				<?php
// Item description
$description = '<div class="plugin-description"><p>'. $ext_info['Description'] .'</p></div>';
// Item info
$class = ( $ext_cnt ) ? 'inactive' : 'active' ;
$version = ( $ext_info['Version'] ) ? __( 'Version', 'framework' ).': '.$ext_info['Version'] : '';
if ( $ext_info['Author'] ) {
	$author = ' | '. __('By', 'framework') .' '. $ext_info['Author'];
	if ( $ext_info['AuthorURI'] ) {
		$author = ' | '.__('By', 'framework').' <a href="'. $ext_info['AuthorURI'] .'" title="' . __( 'Visit author homepage', 'framework' ) .'">'. $ext_info['Author'] .'</a>';
	}
}
else {
	$author = ' | '. __( 'By Unknown', 'framework' );	
}
$plugin_link = ( $ext_info['ExtensionURI'] ) ? ' | <a href="'. $ext_info['ExtensionURI'] .'" title="' . __( 'Visit plugin site', 'framework' ).'">' . __( 'Visit plugin site', 'framework' ) . '</a>' : '';
$info = '<div class="'. $class .'second plugin-version-author-uri">'. $version . $author . $plugin_link .'</div>';

// Print details
echo $description;
echo $info;
?>

				<?php if ( count( $ext_info['DepsExts'] ) > 0 && isset( $ext_info['DepsExts'] ) && !empty( $ext_info['DepsExts'] ) ): ?>
					<b><?php echo __( 'Dependencies', 'framework' );?>:</b>
					<?php
	$deps_count = count( $ext_info['DepsExts'] ); $i = 0;
foreach ( $ext_info['DepsExts'] as $dep_ext ):
	$i++;
$dep_ext = explode( '|', $dep_ext );
if ( file_exists( $extm->extensions_dir.$dep_ext[1] ) ) {
	$ext_data = $extm->get_extension_data( $extm->extensions_dir.$dep_ext[1] );
	$active = FALSE;
	if ( !empty( $extm->admin_settings ) )
		foreach ( $extm->admin_settings['extensions'][$extm->theme_name] as $ext_tmp ) {
			if ( $ext_tmp == $dep_ext[1] ) {
				$active = TRUE;
			}
		}
}
else {
	$active = FALSE;
	$ext_data['Name'] = $dep_ext[0];
}
$coma = ( $i == $deps_count ) ? '' : ',';

$active = $active ? '<i style="color: green;">' . __( 'Active', 'framework' ) .'</i>' :
'<i style="color: red;">' . __( 'Disabled', 'framework' ) . '</i>';
?>
							<?php echo $ext_data['Name']; ?>(<?php echo $active; ?>)<?php echo $coma; ?>
					<?php endforeach; ?>
				<?php endif; ?>
			</td>
		</tr>
	<?php endforeach; else: ?>
		<tr calss="active">
			<td class="plugin-title">
				<?php echo __( 'Extensions not found', 'framework' );?>.
			</td>
			<td class="column-description desc"> </td>
		</tr>
	<?php endif; ?>

	</tbody>
</table>
</form>
