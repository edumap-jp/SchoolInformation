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

//echo $this->NetCommonsHtml->script(array(
//	'/school_informations/js/school_informations.js'
//));

$jsonSchoolInformation = json_encode(
	NetCommonsAppController::camelizeKeyRecursive(
		($this->request->data['SchoolInformation'])
	)
);
?>
<?php echo $this->NetCommonsHtml->script(
	[
		'/school_informations/js/school_information_edit.js',
	]
); ?>


<article class="block-setting-body" ng-controller="SchoolInformationEdit"
		ng-init="init(<?= h($jsonSchoolInformation); ?>)">

	<div class="panel panel-default">
		<?php echo $this->NetCommonsForm->create('SchoolInformation', ['type' => 'file']); ?>
		<div class="panel-body">

			<?php //echo $this->element('Blocks.form_hidden'); ?>

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
			<?php echo $this->NetCommonsForm->uploadFile(
				'SchoolInformation.school_badge',
				['label' => __d('school_informations', 'School Badge'), 'remove' => false]
			)
			?>

			<?php
			$fieldFormElement = function ($key, $field) {
				$extraOptions = [];
				if (is_array($field)) {
					// keyがフィールド名で $fieldがオプション
					$extraOptions = $field;
					$field = $key;
				}
				$defaultOptions = [
					'label' => __d('school_informations', Inflector::humanize($field)),
				];
				$options = array_merge($defaultOptions, $extraOptions);
				echo $this->NetCommonsForm->input(
					'SchoolInformation.' . $field,
					$options
				);
				if (in_array($field, SchoolInformation::locationFields(), true) === false) {

					echo '<div class="col-xs-offset-1 form-group form-inline">';
					echo $this->NetCommonsForm->input(
						'SchoolInformation.is_public_' . $field,
						[
							'type' => 'radio',
							//'div' => ['class' => 'form-group form-inline col-xs-offset-1'],
							'div' => ['class' => 'form-radio-outer'],
							'options' => [
								1 => __d('school_informations', 'Public'),
								0 => __d('school_informations', 'Private'),
							]
						]
					);
					echo '</div>';
				}
			};

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
				'city',
				'address',

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
				'principal_name_roma',
				'school_type' => [
					'type' => 'select',
					'options' => $schoolTypeOptions
				],
				'school_kind' => [
					'type' => 'select',
					'options' => $schoolKindOptions
				],
				'student_category' => $studenTypeOptions,
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
				'number_of_male_students',
				'number_of_female_students',
				'number_of_faculty_members'

			];

			foreach ($firstFields as $key => $field) {
				$fieldFormElement($key, $field);
			}

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
				$fieldFormElement($key, $field);
			}
			echo '</div>';

			foreach ($mainFields as $key => $field) {
				$fieldFormElement($key, $field);
			}

			echo '<hr>';

			foreach ($otherFields as $key => $field) {
				$fieldFormElement($key, $field);
			}
			?>

		</div>

		<div class="panel-footer text-center">
			<?php echo $this->Button->cancelAndSave(
				__d('net_commons', 'Cancel'),
				__d('net_commons', 'OK')
			); ?>

		</div>
		<?php echo $this->NetCommonsForm->end(); ?>

	</div>
</article>
