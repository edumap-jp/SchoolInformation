<?php echo $this->NetCommonsHtml->css('/school_informations/css/side.css', ['inline' => false]); ?>
<article class="school-information-side">
	<div class="school-information-side-image">
		<?php echo $this->SchoolInformationHtml->schoolBadge('small');?>
	</div>

	<div class="school-information-side-school-name">
		<?php echo h($schoolInformation['SchoolInformation']['school_name']); ?>
	</div>

	<?php echo $this->SchoolInformationHtml->displayLocation(); ?>
	<?php echo $this->SchoolInformationHtml->display('tel', ['displayLabel' => true]); ?>
	<?php echo $this->SchoolInformationHtml->display('fax', ['displayLabel' => true]); ?>
	<?php echo $this->SchoolInformationHtml->display('email'); ?>



	<div style="margin-top: 10px">
		<?php
		$fields = [
			'contact',
			'emergency_contact',
			'url',
			'principal',
			'school_type',
			'school_kind',
			'student_category',
			'establish_year_month',
			'close_year_month',

			'number_of_male_students' => [
				'format' => __d('school_informations', '%d persons')
			],
			'number_of_female_students' => [
				'format' => __d('school_informations', '%d persons')
			],
			'number_of_faculty_members' => [
				'format' => __d('school_informations', '%d persons')
			]

		];

		foreach ($fields as $index => $field) {
			$extraOptions = [];
			if (is_array($field)) {
				$extraOptions = $field;
				$field = $index;
			}

			switch ($field) {
				case 'principal':
					if ($this->SchoolInformationHtml->isDisplayPrincipal()) {
						echo $this->SchoolInformationHtml->label(
							'principal_name',
							$this->SchoolInformationHtml->labelPrincipal()
						);
						echo $this->SchoolInformationHtml->displayPrincipal();
					}
					break;
				default:
					$methodName = 'label' . ucfirst(Inflector::camelize($field));
					if (! isset($extraOptions['label']) &&
							method_exists($this->SchoolInformationHtml, $methodName)) {
						$extraOptions['label'] = $this->SchoolInformationHtml->$methodName();
					}
					$extraOptions['displayLabel'] = true;
					echo $this->SchoolInformationHtml->display($field, $extraOptions);
			}
		}
		?>
	</div>


</article>
