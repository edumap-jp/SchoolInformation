<?php
/**
 * school_information 編集
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 *
 * @var array $prefectureOptions [都道府県コード => 都道府県名, ...]
 */
?>
<div class="panel-body">
	<?php echo $this->NetCommonsForm->hidden('SchoolInformation.id'); ?>
	<?php echo $this->NetCommonsForm->hidden('SchoolInformation.key'); ?>
	<?php //echo $this->NetCommonsForm->hidden('SchoolInformation.block_id'); ?>
	<?php echo $this->NetCommonsForm->hidden('SchoolInformation.language_id'); ?>

	<?php echo $this->SchoolInformationForm->input(
		'school_name',
		[
			'label' => __d('school_informations', 'School Name'),
			'required' => true,
		],
		(empty($updatableFieldList) || in_array('school_name', $updatableFieldList, true))
	); ?>

	<?php
	$firstFields = [
		'school_name_kana' => [
			'required' => true,
		],
		'school_name_roma' => [
			'required' => true,
		],
	];
	$locationFields = [
		'postal_code' => [],
		'prefecture_code' => [
			'type' => 'select',
			'options' => $prefectureOptions
		],
		'city_code' => [],
		'city' => [],
		'address' => [],
	];
	$studentsFields = [
		'number_of_total_students' => [
			'label' => __d('school_informations', 'Number Of Total Children or Total Students'),
		],
		'number_of_male_students' => [
			'label' => __d('school_informations', 'Number Of Male Children or Male Students'),
		],
		'number_of_female_students' => [
			'label' => __d('school_informations', 'Number Of Female Children or Female Students'),
		],
	];
	$mainFields = [
		'tel' => [
			'label' => __d('school_informations', 'Telephone Number'),
			'required' => true,
		],
		'fax' => [
			'label' => __d('school_informations', 'Fax Number'),
		],
		'email' => [
			'required' => true,
		],
		'emergency_contact' => [
			'required' => true,
		],
		'contact' => [],
		'url' => [],
	];
	$otherFields = [
		'principal_name' => [
			'required' => true,
		],
		'principal_name_kana' => [
			'required' => true,
		],
		'school_type' => [
			'type' => 'select',
			'options' => $schoolTypeOptions,
			'required' => true,
		],
		'school_kind' => [
			'type' => 'select',
			'options' => $schoolKindOptions,
			'required' => true,
		],
		'student_category' => [
			'type' => 'select',
			'options' => $studentCategoryOptions,
			'required' => true,
		],
		'establish_year_month' => [
			'type' => 'datetime',
			'datetimepicker-options' => json_encode(
				[
					'format' => 'YYYY-MM'
				]
			),
			'ng-model' => 'schoolInformation.establishYearMonth',
			//'mg-init' => 'establish_year_month="2019-03"',
			'required' => true,
		],
		'close_year_month' => [
			'type' => 'datetime',
			'datetimepicker-options' => json_encode(
				[
					'format' => 'YYYY-MM'
				]
			),
			'ng-model' => 'schoolInformation.closeYearMonth',
			//'mg-init' => 'establish_year_month="2019-03"'
		],
		'seismic_work' => [
			'type' => 'radio',
			'div' => ['class' => 'form-radio-outer'],
			'options' => [
				1 => __d('school_informations', 'Yes'),
				0 => __d('school_informations', 'No'),
			],
			'required' => true,
		],
		'designation_of_shelter' => [
			'type' => 'radio',
			'div' => ['class' => 'form-radio-outer'],
			'options' => [
				1 => __d('school_informations', 'Yes'),
				0 => __d('school_informations', 'No'),
			],
			'required' => true,
		],
	];

	foreach ($firstFields as $field => $options) {
		echo $this->SchoolInformationForm->input(
			$field,
			$options,
			(empty($updatableFieldList) || in_array($field, $updatableFieldList, true))
		);
	}

	//校章
	echo $this->SchoolInformationForm->uploadFile(
		'school_badge',
		[
			'label' => __d('school_informations', 'School Badge'),
			'remove' => true,
			'accept' => 'image/gif,image/jpeg,image/png',
		]
	);
	echo '<hr>';

	//カバー写真
	echo $this->SchoolInformationForm->uploadFile(
		'cover_picture',
		[
			'label' => __d('school_informations', 'Cover Picture'),
			'remove' => true,
			'accept' => 'image/gif,image/jpeg,image/png',
		]
	);
	echo '<hr>';

	//所在地
	echo '<div class="school-information-form-location-group">';
	echo $this->NetCommonsForm->label(
		'location',
		__d('school_informations', 'Location'),
		['required' => true]
	);
	echo '<div class="col-xs-offset-1">';
	echo $this->NetCommonsForm->input(
		'SchoolInformation.is_public_location',
		[
			'type' => 'radio',
			'div' => ['class' => 'form-group form-radio-outer form-inline'],
			'options' => [
				1 => __d('school_informations', 'Public'),
				0 => __d('school_informations', 'Private'),
			]
		]
	);
	foreach ($locationFields as $field => $options) {
		echo $this->SchoolInformationForm->inputLocation(
			$field,
			$options,
			(empty($updatableFieldList) || in_array($field, $updatableFieldList, true))
		);
	}
	echo '</div>';
	echo '<hr>';
	echo '</div>';

	foreach ($mainFields as $field => $options) {
		echo $this->SchoolInformationForm->input(
			$field,
			$options,
			(empty($updatableFieldList) || in_array($field, $updatableFieldList, true))
		);
	}

	foreach ($otherFields as $field => $options) {
		echo $this->SchoolInformationForm->input(
			$field,
			$options,
			(empty($updatableFieldList) || in_array($field, $updatableFieldList, true))
		);
	}

	//教員数
	echo $this->SchoolInformationForm->input(
		'number_of_faculty_members',
		[],
		(empty($updatableFieldList) || in_array('number_of_faculty_members', $updatableFieldList, true))
	);

	//生徒数
	echo $this->NetCommonsForm->label(
		'SchoolInformation.number_of_total_students',
		__d('school_informations', 'Number Of Children or Students'),
		['required' => true]
	);
	echo '<div class="col-xs-offset-1">';
	foreach ($studentsFields as $field => $options) {
		echo $this->SchoolInformationForm->inputNumberOfStudents(
			$field,
			$options,
			(empty($updatableFieldList) || in_array($field, $updatableFieldList, true))
		);
	}
	echo '</div>';

	echo '<hr>';

	//地図URL
	echo $this->SchoolInformationForm->input(
		'map_url',
		[
			'label' => __d('school_informations', 'Map Url'),
			'div' => false,
		],
		(empty($updatableFieldList) || in_array('map_url', $updatableFieldList, true))
	);
?>
</div>
