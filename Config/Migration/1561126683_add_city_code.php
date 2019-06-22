<?php
class AddCityCode extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'add_city_code';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'create_field' => array(
				'school_informations' => array(
					'city_code' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 8, 'collate' => 'utf8mb4_general_ci', 'comment' => '区市町村コード', 'charset' => 'utf8mb4', 'after' => 'prefecture_code'),
				),
			),
		),
		'down' => array(
			'drop_field' => array(
				'school_informations' => array('city_code'),
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
