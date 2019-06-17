<?php
/**
 * @var array $frameSetting SchoolInformationFrameSetting data
 */
?>
<?php echo $this->NetCommonsHtml->script(
	[
		'/school_informations/js/school_information_edit.js',
	]
); ?>

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
switch ($layoutPosition) {
	case 'header':
		$displayType = 'header';
		break;
	case 'major':
	case 'minor':
		$displayType = 'side';
		break;
	case 'main':
		$displayType = 'main';
		break;
	case 'footer';
		$displayType = 'footer';

		break;
}
?>
<?php
//$displayType = $frameSetting['SchoolInformationFrameSetting']['display_type'];
$this->SchoolInformation->set($schoolInformation);
echo $this->element('SchoolInformations.SchoolInformation/' . $displayType);
?>
