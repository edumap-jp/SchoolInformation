<?php
/**
 * Add plugin migration
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsMigration', 'NetCommons.Config/Migration');

/**
 * Add plugin migration
 *
 * @package NetCommons\PluginManager\Config\Migration
 */
class UpdateRecordPrincipalNameKana extends NetCommonsMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'update_record_principal_name_kana';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(),
		'down' => array(),
	);

/**
 * plugin data
 *
 * @var array $migration
 */
	public $records = array();

/**
 * Before migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function after($direction) {
		$this->loadModels([
			'SchoolInformation' => 'SchoolInformations.SchoolInformation',
			'SchoolInformationFrameSetting' => 'SchoolInformations.SchoolInformationFrameSetting',
		]);

		if ($direction === 'up') {
			$conditions = ['1' => '1'];

			$alias = 'SchoolInformation';
			$update = [
				"{$alias}.is_public_principal_name_kana" => "{$alias}.is_public_principal_name"
			];
			$this->SchoolInformation->updateAll($update, $conditions);

			$alias = 'SchoolInformationFrameSetting';
			$update = [
				"{$alias}.is_display_principal_name_kana" => "{$alias}.is_display_principal_name"
			];
			$this->SchoolInformationFrameSetting->updateAll($update, $conditions);
		}
		return true;
	}
}
