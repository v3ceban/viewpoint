<?php
global $reports;

if ( isset( $_GET['action'] ) && $_GET['action'] == 'fix-all-issues' ) {
	$reports->fix_all_issues();
}
?>

<?php if ( !empty( $reports->reports ) ) : ?>
<table class="system-status-report">
	<tbody>
		<?php foreach ( $reports->reports as $report_key => $report_info ) : ?>
			<tr class="<?php echo $report_info['state']; ?>">
				<td>
					<div class="status-message">
						<span><?php echo $report_info[$report_info['state'].'_message']; ?></span>
					</div>
				</td>
				<td class="source">
					<?php echo $report_info['source']; ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php else: ?>
	<div id="message" class="updated"><p><?php echo __('No assigned reports!', 'framework'); ?></p></div>
<?php endif; ?>
