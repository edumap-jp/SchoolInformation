<div class="schoolInformations view">
<h2><?php echo __('School Information'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($schoolInformation['SchoolInformation']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Key'); ?></dt>
		<dd>
			<?php echo h($schoolInformation['SchoolInformation']['key']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('School Name'); ?></dt>
		<dd>
			<?php echo h($schoolInformation['SchoolInformation']['school_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($schoolInformation['SchoolInformation']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tel'); ?></dt>
		<dd>
			<?php echo h($schoolInformation['SchoolInformation']['tel']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fax'); ?></dt>
		<dd>
			<?php echo h($schoolInformation['SchoolInformation']['fax']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($schoolInformation['SchoolInformation']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contact Information'); ?></dt>
		<dd>
			<?php echo h($schoolInformation['SchoolInformation']['contact_information']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Number Of Students'); ?></dt>
		<dd>
			<?php echo h($schoolInformation['SchoolInformation']['number_of_students']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Number Of Faculty Members'); ?></dt>
		<dd>
			<?php echo h($schoolInformation['SchoolInformation']['number_of_faculty_members']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($schoolInformation['SchoolInformation']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Active'); ?></dt>
		<dd>
			<?php echo h($schoolInformation['SchoolInformation']['is_active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Latest'); ?></dt>
		<dd>
			<?php echo h($schoolInformation['SchoolInformation']['is_latest']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Language'); ?></dt>
		<dd>
			<?php echo $this->Html->link($schoolInformation['Language']['id'], array('controller' => 'languages', 'action' => 'view', $schoolInformation['Language']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Origin'); ?></dt>
		<dd>
			<?php echo h($schoolInformation['SchoolInformation']['is_origin']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Translation'); ?></dt>
		<dd>
			<?php echo h($schoolInformation['SchoolInformation']['is_translation']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Original Copy'); ?></dt>
		<dd>
			<?php echo h($schoolInformation['SchoolInformation']['is_original_copy']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Filename'); ?></dt>
		<dd>
			<?php echo h($schoolInformation['SchoolInformation']['filename']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($schoolInformation['SchoolInformation']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Trackable Creator'); ?></dt>
		<dd>
			<?php echo $this->Html->link($schoolInformation['TrackableCreator']['id'], array('controller' => 'users', 'action' => 'view', $schoolInformation['TrackableCreator']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($schoolInformation['SchoolInformation']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Trackable Updater'); ?></dt>
		<dd>
			<?php echo $this->Html->link($schoolInformation['TrackableUpdater']['id'], array('controller' => 'users', 'action' => 'view', $schoolInformation['TrackableUpdater']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($schoolInformation['SchoolInformation']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit School Information'), array('action' => 'edit', $schoolInformation['SchoolInformation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete School Information'), array('action' => 'delete', $schoolInformation['SchoolInformation']['id']), null, __('Are you sure you want to delete # %s?', $schoolInformation['SchoolInformation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List School Informations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New School Information'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Languages'), array('controller' => 'languages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Language'), array('controller' => 'languages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Trackable Creator'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
