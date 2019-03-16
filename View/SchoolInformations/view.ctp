<?php
/**
 * @var array $frameSetting SchoolInformationFrameSetting data
 */
?>

<?php if (Current::permission('content_editable')): ?>
	<div align="right">
		<?php
		echo $this->LinkButton->edit(
			__d('net_commons', 'Edit'),
			[
				'action' => 'edit'
			]
		);
		?>
	</div>
<?php endif ?>
<?php
$displayType = $frameSetting['SchoolInformationFrameSetting']['display_type'];
echo $this->element('SchoolInformations.SchoolInformation/' . $displayType);
?>
