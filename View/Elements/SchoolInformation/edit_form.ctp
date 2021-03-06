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

	<?php echo $this->NetCommonsForm->input(
		'SchoolInformation.school_name',
		[
			'label' => __d('school_informations', 'School Name'),
			'required' => true,
		]
	) ?>

	<?php
	$firstFields = [
		'school_name_kana',
		'school_name_roma',
	];
	$locationFields = [
		'postal_code',
		'prefecture_code' => [
			'type' => 'select',
			'options' => $prefectureOptions
		],
		'city_code',
		'city',
		'address',
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
			'label' => __d('school_informations', 'Telephone Number')
		],
		'fax' => [
			'label' => __d('school_informations', 'Fax Number')
		],
		'email',
		'emergency_contact',
		'contact',
		'url',
	];
	$otherFields = [
		'principal_name',
		'principal_name_kana',
		'school_type' => [
			'type' => 'select',
			'options' => $schoolTypeOptions
		],
		'school_kind' => [
			'type' => 'select',
			'options' => $schoolKindOptions
		],
		'student_category' => [
			'type' => 'select',
			'options' => $studentCategoryOptions
		],
		'establish_year_month' => [
			'type' => 'datetime',
			'datetimepicker-options' => json_encode(
				[
					'format' => 'YYYY-MM'
				]
			),
			'ng-model' => 'schoolInformation.establishYearMonth',
			//'mg-init' => 'establish_year_month="2019-03"'
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
		],
		'designation_of_shelter' => [
			'type' => 'radio',
			'div' => ['class' => 'form-radio-outer'],
			'options' => [
				1 => __d('school_informations', 'Yes'),
				0 => __d('school_informations', 'No'),
			]
		],
	];

	foreach ($firstFields as $key => $field) {
		echo $this->SchoolInformationForm->input($key, $field);
	}

	//校章
	echo $this->NetCommonsForm->uploadFile(
		'SchoolInformation.school_badge',
		[
			'label' => __d('school_informations', 'School Badge'),
			'remove' => true,
			'accept' => 'image/gif,image/jpeg,image/png',
		]
	);

	//カバー写真
	echo $this->NetCommonsForm->uploadFile(
		'SchoolInformation.cover_picture',
		[
			'label' => __d('school_informations', 'Cover Picture'),
			'remove' => true,
			'accept' => 'image/gif,image/jpeg,image/png',
		]
	);

	//所在地
	echo $this->NetCommonsForm->label('location', __d('school_informations', 'Location'));
	echo '<div class="col-xs-offset-1">';
	echo $this->NetCommonsForm->input(
		'SchoolInformation.is_public_location',
		[
			'type' => 'radio',
			'div' => ['class' => 'form-group form-inline'],
			'options' => [
				1 => __d('school_informations', 'Public'),
				0 => __d('school_informations', 'Private'),
			]
		]
	);
	foreach ($locationFields as $key => $field) {
		echo $this->SchoolInformationForm->input($key, $field);
	}
	echo '</div>';

	foreach ($mainFields as $key => $field) {
		echo $this->SchoolInformationForm->input($key, $field);
	}

	echo '<hr>';

	foreach ($otherFields as $key => $field) {
		echo $this->SchoolInformationForm->input($key, $field);
	}

	//教員数
	echo $this->SchoolInformationForm->input(0, 'number_of_faculty_members');

	//生徒数
	echo $this->NetCommonsForm->label(
		'SchoolInformation.number_of_total_students',
		__d('school_informations', 'Number Of Children or Students')
	);
	echo '<div class="col-xs-offset-1">';
	foreach ($studentsFields as $key => $field) {
		echo $this->SchoolInformationForm->input($key, $field);
	}
	echo '</div>';

	echo '<hr>';

	//地図URL
	echo '<div class="form-group">';
	echo $this->NetCommonsForm->input(
		'SchoolInformation.map_url',
		[
			'label' => __d('school_informations', 'Map Url'),
			'div' => false,
		]
	);
	echo '<div class="help-block">' .
			__d('school_informations', 'Specify the URL of the Google Maps iframe widget.') .
		'</div>';
	echo '</div>';
?>
</div>
