<?php echo $this->NetCommonsHtml->css(
	'/school_informations/css/footer.css',
	['inline' => false]
); ?>
<article class="school_information_footer">
	<div class="school_information_footer_school_name">
		<?php
		if (isset($schoolInformation['UploadFile']['school_badge']['id'])) {
			echo $this->NetCommonsHtml->image(
				'/school_informations/school_informations/school_badge/?size=small'
			);
		}
		?>&nbsp;<?php echo h($schoolInformation['SchoolInformation']['school_name']); ?>
	</div>

	<?php if ($schoolInformation['SchoolInformation']['address']): ?>
		<div>
			<?php echo h($schoolInformation['SchoolInformation']['address']); ?>
		</div>
	<?php endif ?>

	<div>
		<?php if ($schoolInformation['SchoolInformation']['tel']): ?>
			<span><?php echo __d('school_informations', 'Tel') ?></span>
			:
			<span><?php echo h($schoolInformation['SchoolInformation']['tel']); ?></span>
			&nbsp;&nbsp;
		<?php endif ?>

		<?php if ($schoolInformation['SchoolInformation']['fax']): ?>
			<span><?php echo __d('school_informations', 'Fax') ?></span>
			:
			<span><?php echo h($schoolInformation['SchoolInformation']['fax']); ?></span>
			&nbsp;
		<?php endif; ?>

		<?php if ($schoolInformation['SchoolInformation']['email']): ?>
			<span><?php echo h($schoolInformation['SchoolInformation']['email']); ?></span>
		<?php endif; ?>
	</div>
</article>
