<div class="schoolInformations form">
<?php echo $this->Form->create('SchoolInformation'); ?>
	<fieldset>
		<legend><?php echo __('Edit School Information'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('key');
		echo $this->Form->input('school_name');
		echo $this->Form->input('address');
		echo $this->Form->input('tel');
		echo $this->Form->input('fax');
		echo $this->Form->input('email');
		echo $this->Form->input('contact_information');
		echo $this->Form->input('number_of_students');
		echo $this->Form->input('number_of_faculty_members');
		echo $this->Form->input('status');
		echo $this->Form->input('is_active');
		echo $this->Form->input('is_latest');
		echo $this->Form->input('language_id');
		echo $this->Form->input('is_origin');
		echo $this->Form->input('is_translation');
		echo $this->Form->input('is_original_copy');
		echo $this->Form->input('filename');
		echo $this->Form->input('description');
		echo $this->Form->input('created_user');
		echo $this->Form->input('modified_user');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('SchoolInformation.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('SchoolInformation.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List School Informations'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Languages'), array('controller' => 'languages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Language'), array('controller' => 'languages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Trackable Creator'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
