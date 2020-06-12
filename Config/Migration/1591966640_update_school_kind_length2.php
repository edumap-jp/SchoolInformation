<?php
class UpdateSchoolKindLength2 extends CakeMigration {

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
