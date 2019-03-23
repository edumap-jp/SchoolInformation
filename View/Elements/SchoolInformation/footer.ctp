<?php echo $this->NetCommonsHtml->css(
	'/school_informations/css/footer.css',
	['inline' => false]
); ?>
<div class="school-information-footer-wrap">
	<article class="school-information-footer">
		<div class="school-information-footer-school-badge">
			<?php
			if (isset($schoolInformation['UploadFile']['school_badge']['id'])) {
				echo $this->NetCommonsHtml->image(
					'/school_informations/school_informations/school_badge/?size=small'
				);
			}
			?>
		</div>
		<div class="school-information-footer-text">
			<div class="school-information-footer-school-name">
				<?php echo h($schoolInformation['SchoolInformation']['school_name']); ?>
			</div>
			<div class="school-information-footer-sub-items">
				<?= $this->SchoolInformation->displayLocation(); ?>
				<div>
					<?= $this->SchoolInformation->display(
						'tel',
						['tag' => 'span', 'displayLabel' => true]
					); ?>
					<?= $this->SchoolInformation->display(
						'fax',
						['tag' => 'span', 'displayLabel' => true]
					); ?>
					<?= $this->SchoolInformation->display(
						'email',
						['tag' => 'span', 'displayLabel' => true]
					); ?>
				</div>
			</div>

		</div>
	</article>
</div>
