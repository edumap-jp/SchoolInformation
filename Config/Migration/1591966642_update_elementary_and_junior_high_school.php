<?php
/**
 * 種別を「義務教育学校」から「小中一貫校・義務教育学校」に変更
 *
 * @author Noriko Arai <arai@s4e.jp>
 * @author AllCreator <info@allcreator.net>
 * @copyright c 2019 Research Institute of Science for Education. All Rights Reserved.
 */

App::uses('NetCommonsMigration', 'NetCommons.Config/Migration');

/**
 * 種別を「義務教育学校」から「小中一貫校・義務教育学校」に変更
 *
 * @package NetCommons\EmSubscriptions\Config\Migration
 * @codingStandardsIgnoreStart
 */
class UpdateElementaryAndJuniorHighSchool extends NetCommonsMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'update_elementary_and_junior_high_school';

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
 * SiteSettingsの更新
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
 * value、labelを変更する
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function after($direction) {
		if ($direction === 'down') {
			return true;
		}

		//モデルのインスタンスを取得
		$EmSchoolInformation = $this->generateModel('SchoolInformation');
		$update = [
			'SchoolInformation.school_kind' => '\'小中一貫校・義務教育学校\''
		];
		$conditions = [
			'SchoolInformation.school_kind' => '義務教育学校'
		];
		$EmSchoolInformation->updateAll($update, $conditions);

		return true;
	}
}
