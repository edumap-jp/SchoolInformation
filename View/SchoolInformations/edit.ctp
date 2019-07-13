<?php
/**
 * school_information 編集
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 *
 * @var array $prefectureOptions [都道府県コード => 都道府県名, ...]
 */

$jsonSchoolInformation = json_encode(
	NetCommonsAppController::camelizeKeyRecursive(
		($this->request->data['SchoolInformation'])
	)
);
?>
<?php echo $this->NetCommonsHtml->script(
	[
		'/school_informations/js/school_information_edit.js',
	]
); ?>

<article class="block-setting-body" ng-controller="SchoolInformationEdit"
		ng-init="init(<?php echo h($jsonSchoolInformation); ?>)">

	<div class="panel panel-default">
		<?php echo $this->NetCommonsForm->create('SchoolInformation', ['type' => 'file']); ?>

		<?php
			echo $this->element('SchoolInformations.SchoolInformation/edit_form');
		?>

		<div class="panel-footer text-center">
			<?php echo $this->Button->cancelAndSave(
				__d('net_commons', 'Cancel'),
				__d('net_commons', 'OK')
			); ?>
		</div>
		<?php echo $this->NetCommonsForm->end(); ?>

	</div>
</article>
