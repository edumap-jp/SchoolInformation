<?php if ($this->SchoolInformation->isDisplay(
		'number_of_male_students'
	) || $this->SchoolInformation->isDisplay('number_of_female_students')): ?>
	<tr>
		<th>
			<?= __d('school_informations', 'Number Of Students') ?>
		</th>
		<td>
			<div>
				<span><?= __d('school_informations', 'Male'); ?> : </span>
				<?php echo $this->SchoolInformation->display(
					'number_of_male_students',
					[
						'tag' => 'span',
						'format' => __d(
							'school_informations',
							'%d persons'
						)
					]
				); ?>

			</div>
			<div>
				<span><?= __d('school_informations', 'Female'); ?> : </span>
				<?php echo $this->SchoolInformation->display(
					'number_of_female_students',
					[
						'tag' => 'span',
						'format' => __d(
							'school_informations',
							'%d persons'
						)
					]
				); ?>
			</div>
		</td>
	</tr>
<?php endif; ?>
