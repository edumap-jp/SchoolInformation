<?php
/**
 * 1571440443_modify_default_false_in_is_public_seismic_work_and_is_public_designation_of_shelter.php
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsMigration', 'NetCommons.Config/Migration');

/**
 * UpdateSchoolKindLength2
 *
 * @package NetCommons\SchoolInformations\Config\Migration
 */
class UpdateSchoolKindLength2 extends NetCommonsMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'update_school_kind_length2';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'alter_field' => array(
				'school_informations' => array(
					'school_kind' => array('type' => 'string', 'null' => true, 'length' => 255, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '校種', 'charset' => 'utf8mb4'),
				),
			),
		),
		'down' => array(
			'alter_field' => array(
				'school_informations' => array(
					'school_kind' => array('type' => 'string', 'null' => true, 'length' => 10, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '校種', 'charset' => 'utf8mb4'),
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
