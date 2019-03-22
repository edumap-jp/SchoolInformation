<?php echo $this->NetCommonsHtml->css('/school_informations/css/main.css', ['inline' => false]); ?>
<?php

?>
<article class="school-information-center">
	<div class="school-information-center-title">
		<?php
		if (isset($schoolInformation['UploadFile']['school_badge']['id'])):?>
		<div class="school-information-school-badge">
			<?php
			echo $this->NetCommonsHtml->image(
				'/school_informations/school_informations/school_badge?size=main',
				['class' => '']
			);
			?>
		</div>
		<?php endif; ?>
		<h1>
			<ruby>
				<?php echo h($schoolInformation['SchoolInformation']['school_name']); ?>

				<?php echo $this->SchoolInformation->display('school_name_kana', ['tag' => 'rt']);?>
				<?php //if ($schoolInformation['SchoolInformation']['is_public_school_name_kana']):?>
				<!---->
				<!--<rt>--><?//= h($schoolInformation['SchoolInformation']['school_name_kana']);?><!--</rt>-->
				<?php //endif ?>
			</ruby>
			<?php echo $this->SchoolInformation->display('school_name_roma', ['tag' => 'div']);?>
		</h1>
	</div>

	<table class="table school_information_main_table">
		<tbody>
		<?php
		$fields = [
			'principal_name',
			'principal_name_roma',
			'school_type' => [
				'type' => 'select',
				'options' => [
					'国立',
					'公立',
					'私立'
				]
			],
			'school_kind' => [
				'type' => 'select',
				'options' => [
					'小学校',
					'中学校',
					'高等学校',
					'中等教育学校',
					'小中一貫校'
				]
			],
			'student_category' => [
				'男子校',
				'女子校',
				'共学'
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
			'postal_code',
			'prefecture_code' => [
				'type' => 'select',
				'options' => $prefectureOptions
			],
			'city',
			'address',
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
			'number_of_male_students',
			'number_of_female_students',
			'number_of_faculty_members'
		];
		?>
		<?php foreach ($fields as $index => $field): ?>
		<?php
			if (is_array($field)) {
				// keyがフィールド名で $fieldがオプション
				$extraOptions = $field;
				$field = $index;
			}
		?>
		<?php if ($this->SchoolInformation->isDisplay($field)):?>
		<tr>
			<th>
				<?php echo __d('school_informations', $field);?>
			</th>
			<td>
				<?php echo $this->SchoolInformation->display($field); ?>
			</td>
		</tr>
		<?php endif; ?>
		<?php endforeach; ?>

		<?php if ($schoolInformation['SchoolInformation']['address']): ?>
			<tr>
				<th><?php echo __d('school_informations', 'Location') ?></th>
				<td><?php echo h($schoolInformation['SchoolInformation']['address']); ?></td>
			</tr>
		<?php endif ?>

		<?php if ($schoolInformation['SchoolInformation']['tel']): ?>
			<tr>
				<th><?php echo __d('school_informations', 'Telephone Number') ?></th>
				<td><?php echo h($schoolInformation['SchoolInformation']['tel']); ?></td>
			</tr>
		<?php endif ?>

		<?php if ($schoolInformation['SchoolInformation']['fax']): ?>
			<tr>
				<th><?php echo __d('school_informations', 'Fax Number') ?></th>
				<td><?php echo h($schoolInformation['SchoolInformation']['fax']); ?></td>
			</tr>
		<?php endif ?>

		<?php if ($schoolInformation['SchoolInformation']['email']): ?>
			<tr>
				<th><?php echo __d('school_informations', 'Email') ?></th>
				<td><?php echo h($schoolInformation['SchoolInformation']['email']); ?></td>
			</tr>
		<?php endif ?>

		<?php if ($schoolInformation['SchoolInformation']['number_of_students']): ?>
			<tr>
				<th><?php echo __d('school_informations', 'Number Of Students') ?></th>
				<td><?php echo __d(
						'school_informations',
						'%d persons',
						$schoolInformation['SchoolInformation']['number_of_students']
					) ?></td>
			</tr>
		<?php endif ?>

		<?php if ($schoolInformation['SchoolInformation']['number_of_faculty_members']): ?>
			<tr>
				<th><?php echo __d('school_informations', 'Number Of Faculty Members') ?></th>
				<td><?php echo __d(
						'school_informations',
						'%d persons',
						$schoolInformation['SchoolInformation']['number_of_faculty_members']
					) ?></td>
			</tr>
		<?php endif ?>
		</tbody>
	</table>
</article>
