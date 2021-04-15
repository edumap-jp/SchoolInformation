<?php
/**
 * 1559975644_add_map_url_and_number_of_total_students.php
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsMigration', 'NetCommons.Config/Migration');

/**
 * AddMapUrlAndNumberOfTotalStudents
 *
 * @package NetCommons\SchoolInformations\Config\Migration
 */
class AddMapUrlAndNumberOfTotalStudents extends NetCommonsMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'add_map_url_and_number_of_total_students';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'create_field' => array(
				'school_informations' => array(
					'map_url' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 2000, 'collate' => 'utf8mb4_general_ci', 'comment' => '地図URL', 'charset' => 'utf8mb4', 'after' => 'url'),
					'number_of_total_students' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'comment' => '全生徒数', 'after' => 'number_of_female_students'),
					'is_public_number_of_total_students' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'after' => 'is_public_number_of_female_students'),
				),
			),
		),
		'down' => array(
			'drop_field' => array(
				'school_informations' => array('map_url', 'number_of_total_students', 'is_public_number_of_total_students'),
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
