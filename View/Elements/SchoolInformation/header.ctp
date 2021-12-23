<?php
echo $this->NetCommonsHtml->css(
	'/school_informations/css/header.css',
	['inline' => false]
);
?>
<div class="school-information-header-outer <?php echo h($this->theme); ?> navbar-inverse">
	<div class="school-cover-picture">
		<?php echo $this->SchoolInformationHtml->coverPicture(); ?>
	</div>
	<div class="school-information-header">
		<div class="school-information-header-school-badge">
			<?php echo $this->SchoolInformationHtml->schoolBadge('middle'); ?>
		</div>
		<div class="school-information-header-text">
			<h1 class="school-information-header-title">
				<?php echo $this->SchoolInformationHtml->display(
					'school_name_kana',
					['tag' => 'div']
				); ?>

				<div>
					<?php echo h($schoolInformation['SchoolInformation']['school_name']); ?>

				</div>
				<?php echo $this->SchoolInformationHtml->display('school_name_roma', ['tag' => 'div']); ?>
			</h1>
			<div>
				<?php echo $this->SchoolInformationHtml->displayLocation(); ?>
				<?php echo $this->SchoolInformationHtml->display(
					'tel',
					['tag' => 'span', 'displayLabel' => true]
				); ?>
				<?php echo $this->SchoolInformationHtml->display(
					'fax',
					['tag' => 'span', 'displayLabel' => true]
				); ?>
				<?php echo $this->SchoolInformationHtml->display(
					'contact',
					['tag' => 'span']
				); ?>
				<?php echo $this->SchoolInformationHtml->display(
					'email',
					['tag' => 'span']
				); ?>
				<?php echo $this->SchoolInformationHtml->display(
					'emergency_contact',
					['tag' => 'span']
				); ?>
				<?php echo $this->SchoolInformationHtml->display(
					'url',
					['tag' => 'span']
				); ?>

			</div>
			<div class="school-information-header-sub-items">
				<?php
				$fields = [
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
								echo '<span class="school-information-record-item">';
								echo $this->SchoolInformationHtml->label('principal_name',
										$this->SchoolInformationHtml->labelPrincipal());
								echo $this->SchoolInformationHtml->displayPrincipal();
								echo '</span>';
							}
							break;
						default:
							$methodName = 'label' . ucfirst(Inflector::camelize($field));
							if (! isset($extraOptions['label']) &&
									method_exists($this->SchoolInformationHtml, $methodName)) {
								$extraOptions['label'] = $this->SchoolInformationHtml->$methodName();
							}
							$extraOptions['displayLabel'] = true;
							$extraOptions['tag'] = 'span';
							echo $this->SchoolInformationHtml->display($field, $extraOptions);
					}
				}
				?>
			</div>
		</div>
		<?php //echo $this->element('SchoolInformations.SchoolInformation/table');?>
	</div>
</div>
