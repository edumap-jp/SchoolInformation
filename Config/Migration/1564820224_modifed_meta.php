<?php
/**
 * 1564820224_modifed_meta.php
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsMigration', 'NetCommons.Config/Migration');

/**
 * ModifedMeta
 *
 * @package NetCommons\SchoolInformations\Config\Migration
 */
class ModifedMeta extends NetCommonsMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'modifed_meta';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	//public $migration = array();

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
		//@var \SchoolInformation $SchoolInfoModel
		$SchoolInfoModel = ClassRegistry::init('SchoolInformations.SchoolInformation');

		//@var SiteSetting $SiteSetting
		$SiteSetting = ClassRegistry::init('SiteManager.SiteSetting');

		//Meta.copyright情報の更新
		$update = [
			'SiteSetting.value' => "'Copyright © 2019'"
		];
		$conditions = [
			'SiteSetting.key' => 'Meta.copyright'
		];
		$SiteSetting->updateAll($update, $conditions);

		//Meta情報の更新
		$count = (int)$SchoolInfoModel->find('count');
		if ($count === 1) {
			$schoolInfo = $SchoolInfoModel->find('first');
			$SchoolInfoModel->updateMetas($schoolInfo);
		}

		$SiteSetting->cacheClear();

		return true;
	}
}
