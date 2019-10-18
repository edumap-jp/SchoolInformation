<?php
class ModifyDefaultFalseInIsPublicSeismicWorkAndIsPublicDesignationOfShelter extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'modify_default_false_in_is_public_seismic_work_and_is_public_designation_of_shelter';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'alter_field' => array(
				'school_informations' => array(
					'is_public_seismic_work' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
					'is_public_designation_of_shelter' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
				),
			),
		),
		'down' => array(
			'alter_field' => array(
				'school_informations' => array(
					'is_public_seismic_work' => array('type' => 'boolean', 'null' => true, 'default' => '1'),
					'is_public_designation_of_shelter' => array('type' => 'boolean', 'null' => true, 'default' => '1'),
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
