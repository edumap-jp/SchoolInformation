<?php
/**
 */
?>
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

				<?php echo $this->SchoolInformation->display(
					'school_name_kana',
					['tag' => 'rt']
				); ?>
			</ruby>
			<?php echo $this->SchoolInformation->display('school_name_roma', ['tag' => 'div']); ?>
		</h1>
	</div>

	<table class="table school_information_main_table">
		<tbody>
		<?php if ($this->SchoolInformation->isDisplayPrincipal()): ?>
			<tr>
				<th><?= __d('school_informations', 'Principal Name') ?></th>
				<td>
					<ruby>
						<?= $this->SchoolInformation->display(
							'principal_name'
						); ?>
						<?= $this->SchoolInformation->display(
							'principal_name_roma',
							['tag' => 'rt']
						); ?>
					</ruby>
				</td>
			</tr>
		<?php endif; ?>

		<?php if ($this->SchoolInformation->isDisplayLocation()): ?>
			<tr>
				<th><?= __d('school_informations', 'Location') ?></th>
				<td>
					<?= $this->SchoolInformation->displayLocation(); ?>
				</td>
			</tr>
		<?php endif; ?>
		<?php
		$fields = [
			//'principal_name',
			//'principal_name_roma',
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
			<?php if ($this->SchoolInformation->isDisplay($field)): ?>
				<tr>
					<th>
						<?php
						if (isset($extraOptions['label'])) {
							echo $extraOptions['label'];
						} else {
							echo __d('school_informations', Inflector::humanize($field));
						}
						?>
					</th>
					<td>
						<?php echo $this->SchoolInformation->display($field); ?>
					</td>
				</tr>
			<?php endif; ?>
		<?php endforeach; ?>

		<?php if ($this->SchoolInformation->isDisplay(
				'number_of_male_students'
			) || $this->SchoolInformation->isDisplay('number_of_female_students')): ?>
			<tr>
				<th>
					<?= __d('school_informations', 'Number Of Students') ?>
				</th>
				<td>
					<div>
						<span><?=__d('school_informations', 'Male');?> : </span>
						<?php echo $this->SchoolInformation->display('number_of_male_students', ['tag' => 'span', 'format' => __d(
							'school_informations',
							'%d persons'
						)]); ?>

					</div>
					<div>
						<span><?=__d('school_informations', 'Female');?> : </span>
						<?php echo $this->SchoolInformation->display('number_of_female_students', ['tag' => 'span', 'format' => __d(
							'school_informations',
							'%d persons'
						)]); ?>
					</div>
				</td>
			</tr>
		<?php endif; ?>

		<?php if ($this->SchoolInformation->isDisplay('number_of_faculty_members')): ?>
			<tr>
				<th>
					<?= __d('school_informations', 'Number Of Faculty Members') ?>
				</th>
				<td>
					<?php echo $this->SchoolInformation->display('number_of_faculty_members', ['format' => __d(
						'school_informations',
						'%d persons'
					)]); ?>
				</td>
			</tr>
		<?php endif; ?>

		</tbody>
	</table>
</article>
