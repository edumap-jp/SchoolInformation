<?php
class ChangeFrameSetting extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'change_frame_setting';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'create_field' => array(
				'school_information_frame_settings' => array(
					'is_display_school_name_kana' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 学校名(かな)', 'after' => 'frame_key'),
					'is_display_school_name_roma' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 学校名(ローマ字)', 'after' => 'is_display_school_name_kana'),
					'is_display_principal_name' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 学校長名', 'after' => 'is_display_school_name_roma'),
					'is_display_principal_name_roma' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 学校長名(ローマ字)', 'after' => 'is_display_principal_name'),
					'is_display_school_type' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 国公立種別（国立・公立・私立）', 'after' => 'is_display_principal_name_roma'),
					'is_display_school_kind' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 校種（小学校・中学校・高等学校・中等教育学校・小中一貫校）', 'after' => 'is_display_school_type'),
					'is_display_student_category' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 学生種別（男子校・女子校・共学）', 'after' => 'is_display_school_kind'),
					'is_display_establish_year_month' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 開校年月', 'after' => 'is_display_student_category'),
					'is_display_close_year_month' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 閉校年月', 'after' => 'is_display_establish_year_month'),
					'is_display_postal_code' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 郵便番号', 'after' => 'is_display_close_year_month'),
					'is_display_prefecture_code' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 都道府県', 'after' => 'is_display_postal_code'),
					'is_display_city' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 区市町村', 'after' => 'is_display_prefecture_code'),
					'is_display_address' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 番地', 'after' => 'is_display_city'),
					'is_display_tel' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 電話番号', 'after' => 'is_display_address'),
					'is_display_fax' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) FAX番号', 'after' => 'is_display_tel'),
					'is_display_email' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) メールアドレス', 'after' => 'is_display_fax'),
					'is_display_emergency_contact' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 緊急連絡先', 'after' => 'is_display_email'),
					'is_display_contact' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 問い合わせ先', 'after' => 'is_display_emergency_contact'),
					'is_display_url' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) URL', 'after' => 'is_display_contact'),
					'is_display_number_of_male_students' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 男子生徒数', 'after' => 'is_display_url'),
					'is_display_number_of_female_students' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 女子生徒数', 'after' => 'is_display_number_of_male_students'),
					'is_display_number_of_faculty_members' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 教員数', 'after' => 'is_display_number_of_female_students'),
				),
			),
			'drop_field' => array(
				'school_information_frame_settings' => array('display_type'),
			),
		),
		'down' => array(
			'drop_field' => array(
				'school_information_frame_settings' => array('is_display_school_name_kana', 'is_display_school_name_roma', 'is_display_principal_name', 'is_display_principal_name_roma', 'is_display_school_type', 'is_display_school_kind', 'is_display_student_category', 'is_display_establish_year_month', 'is_display_close_year_month', 'is_display_postal_code', 'is_display_prefecture_code', 'is_display_city', 'is_display_address', 'is_display_tel', 'is_display_fax', 'is_display_email', 'is_display_emergency_contact', 'is_display_contact', 'is_display_url', 'is_display_number_of_male_students', 'is_display_number_of_female_students', 'is_display_number_of_faculty_members'),
			),
			'create_field' => array(
				'school_information_frame_settings' => array(
					'display_type' => array('type' => 'string', 'null' => false, 'default' => 'main', 'length' => 30, 'collate' => 'utf8_general_ci', 'comment' => '表示タイプ side, footer, main', 'charset' => 'utf8'),
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
