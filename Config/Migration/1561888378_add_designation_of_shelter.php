<?php
class AddDesignationOfShelter extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'add_designation_of_shelter';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'create_field' => array(
				'school_informations' => array(
					'designation_of_shelter' => array('type' => 'boolean', 'null' => true, 'default' => null, 'comment' => '避難所指定の有無', 'after' => 'seismic_work'),
					'is_public_seismic_work' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'after' => 'is_public_number_of_faculty_members'),
					'is_public_designation_of_shelter' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'after' => 'is_public_seismic_work'),
				),
			),
			'drop_field' => array(
				'school_informations' => array('is_seismic_work'),
			),
		),
		'down' => array(
			'drop_field' => array(
				'school_informations' => array('designation_of_shelter', 'is_public_seismic_work', 'is_public_designation_of_shelter'),
			),
			'create_field' => array(
				'school_informations' => array(
					'is_seismic_work' => array('type' => 'boolean', 'null' => true, 'default' => '1'),
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
