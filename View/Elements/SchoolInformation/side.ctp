<?php echo $this->NetCommonsHtml->css('/school_informations/css/side.css', ['inline' => false]); ?>
<article class="school_information_side">
	<div class="school_information_side_image">
		<?php
		if (isset($schoolInformation['UploadFile']['school_badge']['id'])) {
			echo $this->NetCommonsHtml->image(
				'/school_informations/school_informations/school_badge?size=main'
			);
		}
		?>
	</div>

	<div class="school_information_side_school_name">
		<?php echo h($schoolInformation['SchoolInformation']['school_name']); ?>
	</div>

	<?php if ($schoolInformation['SchoolInformation']['address']): ?>
		<div>
			<?php echo h($schoolInformation['SchoolInformation']['address']); ?>
		</div>
	<?php endif ?>

	<?php if ($schoolInformation['SchoolInformation']['tel']): ?>
		<div>
			<span><?php echo __d('school_informations', 'Tel') ?></span>
			<span><?php echo h($schoolInformation['SchoolInformation']['tel']); ?></span>
			&nbsp;
		</div>
	<?php endif ?>

	<?php if ($schoolInformation['SchoolInformation']['fax']): ?>
		<div>
			<span><?php echo __d('school_informations', 'Fax') ?></span>
			<span><?php echo h($schoolInformation['SchoolInformation']['fax']); ?></span>
		</div>
	<?php endif ?>

	<?php if ($schoolInformation['SchoolInformation']['email']): ?>
		<div>
			<span><?php echo h($schoolInformation['SchoolInformation']['email']); ?></span>
		</div>
	<?php endif ?>

</article>
