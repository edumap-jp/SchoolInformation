<?php echo $this->NetCommonsHtml->css('/school_informations/css/main.css', ['inline' => false]); ?>
<article>
	<h1>
		<?php
		if (isset($schoolInformation['UploadFile']['school_badge']['id'])) {
			echo $this->NetCommonsHtml->image(
				'/school_informations/school_informations/school_badge?size=main'
			);
		}
		?>&nbsp<?php echo h($schoolInformation['SchoolInformation']['school_name']); ?>
	</h1>
	<table class="table school_information_main_table">
		<tbody>
		<?php if ($schoolInformation['SchoolInformation']['address']): ?>
			<tr>
				<th><?php echo __d('school_informations', 'Address') ?></th>
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
