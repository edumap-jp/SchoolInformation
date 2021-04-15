<?php if ($this->SchoolInformation->isDisplay('number_of_male_students'	) ||
		$this->SchoolInformation->isDisplay('number_of_female_students') ||
		$this->SchoolInformation->isDisplay('number_of_total_students')): ?>
	<tr>
		<th>
			<?php echo $this->SchoolInformation->labelNumberOfStudents(); ?>
		</th>
		<td>
			<?php
				$totalNum = $this->SchoolInformation->display(
					'number_of_total_students',
					[
						'tag' => 'span',
						'format' => __d(
							'school_informations',
							'%d persons'
						)
					]
				);
			?>
			<?php if ($totalNum) : ?>
				<div>
					<?php echo $totalNum; ?>
				</div>
			<?php endif; ?>

			<?php
				$maleNum = $this->SchoolInformation->display(
					'number_of_male_students',
					[
						'tag' => 'span',
						'format' => __d(
							'school_informations',
							'%d persons'
						)
					]
				);
			?>
			<?php if ($maleNum) : ?>
				<div>
					<span><?php echo __d('school_informations', 'Male'); ?> : </span>
					<?php echo $maleNum; ?>
				</div>
			<?php endif; ?>

			<?php
				$femaleNum = $this->SchoolInformation->display(
					'number_of_female_students',
					[
						'tag' => 'span',
						'format' => __d(
							'school_informations',
							'%d persons'
						)
					]
				);
			?>
			<?php if ($femaleNum) : ?>
				<div>
					<span><?php echo __d('school_informations', 'Female'); ?> : </span>
					<?php echo $femaleNum; ?>
				</div>
			<?php endif; ?>
		</td>
	</tr>
<?php endif;
