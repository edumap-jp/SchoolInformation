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
// TODO 言語ファイル化
echo $this->NetCommonsForm->input('SchoolInformationFrameSetting.display_type', array(
	'label' => __d('school_informations', '表示形式'),
	'type' => 'radio',
	'options' => [
		'side' => '左右カラム用',
		'footer' => 'フッタ用',
		'main' => 'メインカラム用'
	]
));