<?php
class AddPrincipalNameKana extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'add_principal_name_kana';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'create_field' => array(
				'school_informations' => array(
					'principal_name_kana' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '学校長名(カナ)', 'charset' => 'utf8mb4', 'after' => 'principal_name'),
				),
			),
		),
		'down' => array(
			'drop_field' => array(
				'school_informations' => array('principal_name_kana'),
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
