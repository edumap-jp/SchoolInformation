<?php echo $this->NetCommonsHtml->css('/school_informations/css/side.css', ['inline' => false]);?>

<div>
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
	<span><?php echo h($schoolInformation['SchoolInformation']['tel']); ?></span>
	&nbsp;
</div>
<div>
	<span><?php echo __d('school_informations', 'Fax') ?></span>
	<span><?php echo h($schoolInformation['SchoolInformation']['fax']); ?></span>
</div>
<div>
	<span><?php echo __d('school_informations', 'Email') ?></span>
	:
	<span><?php echo h($schoolInformation['SchoolInformation']['email']); ?></span>
</div>
