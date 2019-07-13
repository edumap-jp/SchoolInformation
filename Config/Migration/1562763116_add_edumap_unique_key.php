<?php
class AddEdumapUniqueKey extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'add_edumap_unique_key';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'alter_field' => array(
				'school_information_frame_settings' => array(
					'frame_key' => array('type' => 'string', 'null' => false, 'default' => null, 'key' => 'index', 'collate' => 'utf8mb4_general_ci', 'comment' => 'フレームKey', 'charset' => 'utf8mb4'),
					'tableParameters' => array('charset' => 'utf8mb4', 'collate' => 'utf8mb4_general_ci'),
				),
			),
			'create_field' => array(
				'school_informations' => array(
					'edumap_key' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'utf8mb4_general_ci', 'comment' => 'edumap上でユニークキー', 'charset' => 'utf8mb4', 'after' => 'id'),
				),
			),
		),
		'down' => array(
			'alter_field' => array(
				'school_information_frame_settings' => array(
					'frame_key' => array('type' => 'string', 'null' => false, 'default' => null, 'key' => 'index', 'collate' => 'utf8_general_ci', 'comment' => 'フレームKey', 'charset' => 'utf8'),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
				),
			),
			'drop_field' => array(
				'school_informations' => array('edumap_key'),
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
