<?php
/**
 * school_information 編集
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

//echo $this->NetCommonsHtml->script(array(
//	'/school_informations/js/school_informations.js'
//));

//$school_information = NetCommonsAppController::camelizeKeyRecursive(array('school_information' => $this->data['SchoolInformation']));
?>
<?php echo $this->NetCommonsHtml->script(
	[
		'/school_informations/js/school_information_edit.js',
	]
); ?>


<article class="block-setting-body" ng-controller="SchoolInformationEdit">

	<div class="panel panel-default">
		<?php echo $this->NetCommonsForm->create('SchoolInformation', ['type' => 'file']); ?>
		<div class="panel-body">

			<?php //echo $this->element('Blocks.form_hidden'); ?>

			<?php echo $this->NetCommonsForm->hidden('SchoolInformation.id'); ?>
			<?php echo $this->NetCommonsForm->hidden('SchoolInformation.key'); ?>
			<?php //echo $this->NetCommonsForm->hidden('SchoolInformation.block_id'); ?>
			<?php echo $this->NetCommonsForm->hidden('SchoolInformation.language_id'); ?>
			<?php //echo $this->NetCommonsForm->hidden('SchoolInformation.status'); ?>
			<!---->
			<?php //echo $this->NetCommonsForm->hidden('SchoolInformationSetting.use_workflow'); ?>

			<?php echo $this->NetCommonsForm->input(
				'SchoolInformation.school_name',
				[
					'label' => __d('school_informations', 'School Name'),
					'required' => true,

				]
			) ?>
			<?php echo $this->NetCommonsForm->uploadFile(
				'SchoolInformation.school_badge',
				['label' => __d('school_informations', 'School Badge'), 'remove' => false]
			)
			?>

			<?php echo $this->NetCommonsForm->input(
				'SchoolInformation.address',
				[
					'label' => __d('school_informations', 'Address'),
				]
			) ?>
			<?php echo $this->NetCommonsForm->input(
				'SchoolInformation.tel',
				[
					'label' => __d('school_informations', 'Telephone Number'),
				]
			) ?>
			<?php echo $this->NetCommonsForm->input(
				'SchoolInformation.fax',
				[
					'label' => __d('school_informations', 'Fax Number'),
				]
			) ?>

			<?php echo $this->NetCommonsForm->input(
				'SchoolInformation.email',
				[
					'label' => __d('school_informations', 'Email'),
				]
			) ?>

			<?php //echo $this->NetCommonsForm->wysiwyg(
			//	'SchoolInformation.contact_information',
			//	array(
			//		'label' => __d('school_informations', 'Contact Information'),
			//		'required' => true,
			//		'rows' => 12
			//	)
			//); ?>

			<?php echo $this->NetCommonsForm->input(
				'SchoolInformation.number_of_students',
				[
					'label' => __d('school_informations', 'Number Of Students'),
				]
			) ?>
			<?php echo $this->NetCommonsForm->input(
				'SchoolInformation.number_of_faculty_members',
				[
					'label' => __d('school_informations', 'Number Of Faculty Members'),
				]
			) ?>


			<?php //echo $this->Workflow->inputComment('SchoolInformation.status'); ?>
		</div>

		<?php //echo $this->Workflow->buttons('SchoolInformation.status', NetCommonsUrl::backToPageUrl()); ?>
		<div class="panel-footer">
			<?php echo $this->Button->cancelAndSave(
				__d('net_commons', 'Cancel'),
				__d('net_commons', 'OK')
			); ?>

		</div>
		<?php echo $this->NetCommonsForm->end(); ?>

	</div>

	<?php //echo $this->Workflow->comments(); ?>

</article>
