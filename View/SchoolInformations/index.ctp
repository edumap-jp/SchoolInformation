<div class="schoolInformations index">
	<h2><?php echo __('School Informations'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('key'); ?></th>
			<th><?php echo $this->Paginator->sort('school_name'); ?></th>
			<th><?php echo $this->Paginator->sort('address'); ?></th>
			<th><?php echo $this->Paginator->sort('tel'); ?></th>
			<th><?php echo $this->Paginator->sort('fax'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('contact_information'); ?></th>
			<th><?php echo $this->Paginator->sort('number_of_students'); ?></th>
			<th><?php echo $this->Paginator->sort('number_of_faculty_members'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('is_active'); ?></th>
			<th><?php echo $this->Paginator->sort('is_latest'); ?></th>
			<th><?php echo $this->Paginator->sort('language_id'); ?></th>
			<th><?php echo $this->Paginator->sort('is_origin'); ?></th>
			<th><?php echo $this->Paginator->sort('is_translation'); ?></th>
			<th><?php echo $this->Paginator->sort('is_original_copy'); ?></th>
			<th><?php echo $this->Paginator->sort('filename'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('created_user'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified_user'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($schoolInformations as $schoolInformation): ?>
	<tr>
		<td><?php echo h($schoolInformation['SchoolInformation']['id']); ?>&nbsp;</td>
		<td><?php echo h($schoolInformation['SchoolInformation']['key']); ?>&nbsp;</td>
		<td><?php echo h($schoolInformation['SchoolInformation']['school_name']); ?>&nbsp;</td>
		<td><?php echo h($schoolInformation['SchoolInformation']['address']); ?>&nbsp;</td>
		<td><?php echo h($schoolInformation['SchoolInformation']['tel']); ?>&nbsp;</td>
		<td><?php echo h($schoolInformation['SchoolInformation']['fax']); ?>&nbsp;</td>
		<td><?php echo h($schoolInformation['SchoolInformation']['email']); ?>&nbsp;</td>
		<td><?php echo h($schoolInformation['SchoolInformation']['contact_information']); ?>&nbsp;</td>
		<td><?php echo h($schoolInformation['SchoolInformation']['number_of_students']); ?>&nbsp;</td>
		<td><?php echo h($schoolInformation['SchoolInformation']['number_of_faculty_members']); ?>&nbsp;</td>
		<td><?php echo h($schoolInformation['SchoolInformation']['status']); ?>&nbsp;</td>
		<td><?php echo h($schoolInformation['SchoolInformation']['is_active']); ?>&nbsp;</td>
		<td><?php echo h($schoolInformation['SchoolInformation']['is_latest']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($schoolInformation['Language']['id'], array('controller' => 'languages', 'action' => 'view', $schoolInformation['Language']['id'])); ?>
		</td>
		<td><?php echo h($schoolInformation['SchoolInformation']['is_origin']); ?>&nbsp;</td>
		<td><?php echo h($schoolInformation['SchoolInformation']['is_translation']); ?>&nbsp;</td>
		<td><?php echo h($schoolInformation['SchoolInformation']['is_original_copy']); ?>&nbsp;</td>
		<td><?php echo h($schoolInformation['SchoolInformation']['filename']); ?>&nbsp;</td>
		<td><?php echo h($schoolInformation['SchoolInformation']['description']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($schoolInformation['TrackableCreator']['id'], array('controller' => 'users', 'action' => 'view', $schoolInformation['TrackableCreator']['id'])); ?>
		</td>
		<td><?php echo h($schoolInformation['SchoolInformation']['created']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($schoolInformation['TrackableUpdater']['id'], array('controller' => 'users', 'action' => 'view', $schoolInformation['TrackableUpdater']['id'])); ?>
		</td>
		<td><?php echo h($schoolInformation['SchoolInformation']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $schoolInformation['SchoolInformation']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $schoolInformation['SchoolInformation']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $schoolInformation['SchoolInformation']['id']), null, __('Are you sure you want to delete # %s?', $schoolInformation['SchoolInformation']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New School Information'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Languages'), array('controller' => 'languages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Language'), array('controller' => 'languages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Trackable Creator'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
