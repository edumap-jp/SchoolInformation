<table class="table school-information-table">
	<tbody>

	<?php
	if (!isset($fields)) {
		$fields = [
			'location',
			'tel' => [
				'label' => __d('school_informations', 'Telephone Number')
			],
			'fax' => [
				'label' => __d('school_informations', 'Fax Number')
			],
			'contact',
			'email',
			'emergency_contact',
			'url',

			'principal',
			'school_type',
			'school_kind',
			'student_category',
			'establish_year_month',
			'close_year_month',

			'number_of_students',
			'number_of_faculty_members' => [
				'format' => __d('school_informations', '%d persons')
			]
		];
	}
	?>
	<?php foreach ($fields as $index => $field): ?>
		<?php
		$extraOptions = [];
		if (is_array($field)) {
			// keyがフィールド名で $fieldがオプション
			$extraOptions = $field;
			$field = $index;
		}
		?>


		<?php
		$elementFilePath = __DIR__ . '/TableField/' . $field . '.ctp';
		if (file_exists($elementFilePath)) {
			echo $this->element(
				'SchoolInformations.SchoolInformation/TableField/' . $field,
				['extraOptions' => $extraOptions, 'field' => $field]
			);
		} else {
			echo $this->element(
				'SchoolInformations.SchoolInformation/TableField/default',
				['extraOptions' => $extraOptions, 'field' => $field]
			);
		}
		?>
	<?php endforeach; ?>
	</tbody>
</table>