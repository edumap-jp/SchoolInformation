<?php
class AddSeismicWork extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'add_seismic_work';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'create_field' => array(
				'school_information_frame_settings' => array(
					'is_display_number_of_total_students' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 全生徒数', 'after' => 'is_display_number_of_female_students'),
				),
				'school_informations' => array(
					'seismic_work' => array('type' => 'boolean', 'null' => true, 'default' => null, 'comment' => '耐震工事の有無', 'after' => 'number_of_faculty_members'),
					'is_seismic_work' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'after' => 'is_public_number_of_faculty_members'),
				),
			),
		),
		'down' => array(
			'drop_field' => array(
				'school_information_frame_settings' => array('is_display_number_of_total_students'),
				'school_informations' => array('seismic_work', 'is_seismic_work'),
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
