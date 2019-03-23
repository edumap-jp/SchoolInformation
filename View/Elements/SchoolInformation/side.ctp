<?php echo $this->NetCommonsHtml->css('/school_informations/css/side.css', ['inline' => false]); ?>
<article class="school_information_side">
	<div class="school_information_side_image">
		<?php echo $this->SchoolInformation->schoolBadge('small');?>
	</div>

	<div class="school_information_side_school_name">
		<?php echo h($schoolInformation['SchoolInformation']['school_name']); ?>
	</div>

	<?= $this->SchoolInformation->displayLocation(); ?>
	<?= $this->SchoolInformation->display('tel'); ?>
	<?= $this->SchoolInformation->display('fax'); ?>
	<?= $this->SchoolInformation->display('email'); ?>



	<div style="margin-top: 10px">
		<?php
		$fields = [
			'principal',
			'school_type',
			'school_kind',
			'student_category',
			'establish_year_month',
			'close_year_month',
			//'tel' => [
			//	'label' => __d('school_informations', 'Telephone Number')
			//],
			//'fax' => [
			//	'label' => __d('school_informations', 'Fax Number')
			//],
			//'email',
			'emergency_contact',
			'contact',
			'url',

			'number_of_students',
			'number_of_faculty_members' => [
				'format' => __d('school_informations', '%d persons')
			]

		];
		echo $this->element(
			'SchoolInformations.SchoolInformation/table',
			['fields' => $fields]
		); ?>
	</div>


</article>
