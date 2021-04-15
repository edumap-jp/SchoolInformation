<?php
/**
 * 1571430815_add_is_public_principal_name_kana.php
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsMigration', 'NetCommons.Config/Migration');

/**
 * AddIsPublicPrincipalNameKana
 *
 * @package NetCommons\SchoolInformations\Config\Migration
 */
class AddIsPublicPrincipalNameKana extends NetCommonsMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'add_is_public_principal_name_kana';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'create_field' => array(
				'school_informations' => array(
					'is_public_principal_name_kana' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 学校長名(カナ)', 'after' => 'is_public_principal_name'),
				),
			),
		),
		'down' => array(
			'drop_field' => array(
				'school_informations' => array('is_public_principal_name_kana'),
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
