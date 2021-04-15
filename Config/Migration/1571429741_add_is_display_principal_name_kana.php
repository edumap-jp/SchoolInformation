<?php
/**
 * 1571429741_add_is_display_principal_name_kana.php
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsMigration', 'NetCommons.Config/Migration');

/**
 * AddIsDisplayPrincipalNameKana
 *
 * @package NetCommons\SchoolInformations\Config\Migration
 */
class AddIsDisplayPrincipalNameKana extends NetCommonsMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'add_is_display_principal_name_kana';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'create_field' => array(
				'school_information_frame_settings' => array(
					'is_display_principal_name_kana' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 学校長名(カナ)', 'after' => 'is_display_principal_name'),
				),
			),
		),
		'down' => array(
			'drop_field' => array(
				'school_information_frame_settings' => array('is_display_principal_name_kana'),
			),
		),
	);

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
		return true;
	}
}
