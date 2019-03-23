<?php
/**
 */
?>
<?php echo $this->NetCommonsHtml->css('/school_informations/css/main.css', ['inline' => false]); ?>
<?php

?>
<article class="school-information-center">
	<div class="school-information-center-title">
		<?php echo $this->SchoolInformation->schoolBadge('small');?>
		<h1>
			<ruby>
				<?php echo h($schoolInformation['SchoolInformation']['school_name']); ?>

				<?php echo $this->SchoolInformation->display(
					'school_name_kana',
					['tag' => 'rt']
				); ?>
			</ruby>
			<?php echo $this->SchoolInformation->display('school_name_roma', ['tag' => 'div']); ?>
		</h1>
	</div>

	<?php echo $this->element('SchoolInformations.SchoolInformation/table');?>
</article>
