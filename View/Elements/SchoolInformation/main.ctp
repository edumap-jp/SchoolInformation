<?php
/**
 */
?>
<?php echo $this->NetCommonsHtml->css('/school_informations/css/main.css', ['inline' => false]); ?>
<?php

?>
<article class="school-information-center">
	<div class="school-information-center-title">
		<div class="school-information-school-badge">
			<?php echo $this->SchoolInformation->schoolBadge('small');?>
		</div>
		<h1>
			<?php echo $this->SchoolInformation->display(
				'school_name_kana',
				['tag' => 'div']
			); ?>
			<div>
				<?php echo h($schoolInformation['SchoolInformation']['school_name']); ?>
			</div>
			<?php echo $this->SchoolInformation->display('school_name_roma', ['tag' => 'div']); ?>
		</h1>
	</div>

	<?php echo $this->element('SchoolInformations.SchoolInformation/table');?>
</article>
