<?php
/**
 * Blog frame setting element
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<?php echo $this->NetCommonsForm->hidden('Frame.id'); ?>
<?php echo $this->NetCommonsForm->hidden('Frame.key'); ?>

<?php echo $this->NetCommonsForm->hidden('SchoolInformationFrameSetting.id'); ?>
<?php echo $this->NetCommonsForm->hidden('SchoolInformationFrameSetting.frame_key'); ?>


<?php
$isDisplayFields = [];
$fields = array_keys($this->request->data['SchoolInformationFrameSetting']);
foreach ($fields as $field) {
	if (substr($field, 0, 10) === 'is_display') {
		$isDisplayFields[] = $field;
	}
}

//echo $this->NetCommonsForm->label('is_display', __d('school_informations', 'Display Setting'));
foreach ($isDisplayFields as $field) {
	echo $this->NetCommonsForm->input(
		'SchoolInformationFrameSetting.' . $field,
		[
			'type' => 'radio',
			'label' => __d('school_informations', Inflector::humanize(substr($field, 11))),
			'div' => ['class' => 'form-group form-inline'],

			'options' => [
				1 => __d('school_informations', 'Display'),
				0 => __d('school_informations', 'Hide'),
			]
		]
	);

}
