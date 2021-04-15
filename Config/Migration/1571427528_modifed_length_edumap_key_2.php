<?php
/**
 * 1571427528_modifed_length_edumap_key_2.php
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsMigration', 'NetCommons.Config/Migration');

/**
 * ModifedLengthEdumapKey2
 *
 * @package NetCommons\SchoolInformations\Config\Migration
 */
class ModifedLengthEdumapKey2 extends NetCommonsMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'modifed_length_edumap_key';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'alter_field' => array(
				'school_informations' => array(
					'edumap_key' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 255, 'collate' => 'utf8mb4_general_ci', 'comment' => 'edumap上でユニークキー', 'charset' => 'utf8mb4'),
				),
			),
		),
		'down' => array(
			'alter_field' => array(
				'school_informations' => array(
					'edumap_key' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'utf8mb4_general_ci', 'comment' => 'edumap上でユニークキー', 'charset' => 'utf8mb4'),
				),
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
