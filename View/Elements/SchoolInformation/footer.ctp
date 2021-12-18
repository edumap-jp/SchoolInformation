<?php echo $this->NetCommonsHtml->css(
	'/school_informations/css/footer.css',
	['inline' => false]
); ?>
<div class="school-information-footer-wrap">
	<article class="school-information-footer">
		<div class="school-information-footer-school-badge">
			<?php echo $this->SchoolInformationHtml->schoolBadge('small');?>
		</div>
		<div class="school-information-footer-text">
			<div class="school-information-footer-school-name">
				<?php echo h($schoolInformation['SchoolInformation']['school_name']); ?>
			</div>
			<div class="school-information-footer-sub-items">
				<?php echo $this->SchoolInformationHtml->displayLocation(); ?>
				<div>
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
			</div>
			<div class="school-information-footer-sub-items">
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
	</article>
</div>
