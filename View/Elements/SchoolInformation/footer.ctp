<?php echo $this->NetCommonsHtml->css('/school_informations/css/footer.css', ['inline' => false]);?>
<div class="school_information_footer_school_name">
	<?php echo $this->NetCommonsHtml->image(
		'/school_informations/school_informations/school_badge/?size=small'
	)?>

	<?php echo h($schoolInformation['SchoolInformation']['school_name']); ?>
</div>
<div>
	<?php echo h($schoolInformation['SchoolInformation']['address']); ?>
</div>
<div>
	<span><?php echo __d('school_informations', 'Tel') ?></span>
	:
	<span><?php echo h($schoolInformation['SchoolInformation']['tel']); ?></span>
	&nbsp;
	<span><?php echo __d('school_informations', 'Fax') ?></span>
	:
	<span><?php echo h($schoolInformation['SchoolInformation']['fax']); ?></span>
</div>
<div>
	<span><?php echo h($schoolInformation['SchoolInformation']['email']); ?></span>
</div>
