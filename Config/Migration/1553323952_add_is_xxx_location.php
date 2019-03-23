<?php
class AddIsXxxLocation extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'add_is_xxx_location';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'create_field' => array(
				'school_information_frame_settings' => array(
					'is_display_location' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 所在地', 'after' => 'is_display_close_year_month'),
				),
				'school_informations' => array(
					'is_public_location' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 所在地', 'after' => 'is_public_close_year_month'),
				),
			),
			'drop_field' => array(
				'school_information_frame_settings' => array('is_display_postal_code', 'is_display_prefecture_code', 'is_display_city', 'is_display_address'),
				'school_informations' => array('is_public_postal_code', 'is_public_prefecture_code', 'is_public_city', 'is_public_address'),
			),
		),
		'down' => array(
			'drop_field' => array(
				'school_information_frame_settings' => array('is_display_location'),
				'school_informations' => array('is_public_location'),
			),
			'create_field' => array(
				'school_information_frame_settings' => array(
					'is_display_postal_code' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 郵便番号'),
					'is_display_prefecture_code' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 都道府県'),
					'is_display_city' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 区市町村'),
					'is_display_address' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 番地'),
				),
				'school_informations' => array(
					'is_public_postal_code' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 郵便番号'),
					'is_public_prefecture_code' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 都道府県'),
					'is_public_city' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 区市町村'),
					'is_public_address' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 番地'),
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
