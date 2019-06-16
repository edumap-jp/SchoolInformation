<?php
class SchoolInformationsSchema extends CakeSchema {

	public $connection = 'master';

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $school_information_frame_settings = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary', 'comment' => 'ID'),
		'frame_key' => array('type' => 'string', 'null' => false, 'default' => null, 'key' => 'index', 'collate' => 'utf8_general_ci', 'comment' => 'フレームKey', 'charset' => 'utf8'),
		'is_display_school_name_kana' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 学校名(かな)'),
		'is_display_school_name_roma' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 学校名(ローマ字)'),
		'is_display_principal_name' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 学校長名'),
		'is_display_principal_name_roma' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 学校長名(ローマ字)'),
		'is_display_school_type' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 国公立種別（国立・公立・私立）'),
		'is_display_school_kind' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 校種（小学校・中学校・高等学校・中等教育学校・小中一貫校）'),
		'is_display_student_category' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 学生種別（男子校・女子校・共学）'),
		'is_display_establish_year_month' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 開校年月'),
		'is_display_close_year_month' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 閉校年月'),
		'is_display_location' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 所在地'),
		'is_display_tel' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 電話番号'),
		'is_display_fax' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) FAX番号'),
		'is_display_email' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) メールアドレス'),
		'is_display_emergency_contact' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 緊急連絡先'),
		'is_display_contact' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 問い合わせ先'),
		'is_display_url' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) URL'),
		'is_display_number_of_male_students' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 男子生徒数'),
		'is_display_number_of_female_students' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 女子生徒数'),
		'is_display_number_of_total_students' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 全生徒数'),
		'is_display_number_of_faculty_members' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '表示設定(1:表示 0:非表示) 教員数'),
		'created_user' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'comment' => '作成者'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '作成日時'),
		'modified_user' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'comment' => '更新者'),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '更新日時'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'frame_key' => array('column' => 'frame_key', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $school_informations = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'school_name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '学校名', 'charset' => 'utf8mb4'),
		'school_name_kana' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '学校名(かな)', 'charset' => 'utf8mb4'),
		'school_name_roma' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '学校名(ローマ字)', 'charset' => 'utf8mb4'),
		'principal_name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '学校長名', 'charset' => 'utf8mb4'),
		'principal_name_roma' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '学校長名(ローマ字)', 'charset' => 'utf8mb4'),
		'school_type' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 10, 'collate' => 'utf8mb4_general_ci', 'comment' => '国公立種別（国立・公立・私立）', 'charset' => 'utf8mb4'),
		'school_kind' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 10, 'collate' => 'utf8mb4_general_ci', 'comment' => '校種（小学校・中学校・高等学校・中等教育学校・小中一貫校）', 'charset' => 'utf8mb4'),
		'student_category' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 10, 'collate' => 'utf8mb4_general_ci', 'comment' => '学生種別（男子校・女子校・共学）', 'charset' => 'utf8mb4'),
		'establish_year_month' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 7, 'collate' => 'utf8mb4_general_ci', 'comment' => '開校年月', 'charset' => 'utf8mb4'),
		'close_year_month' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 7, 'collate' => 'utf8mb4_general_ci', 'comment' => '閉校年月', 'charset' => 'utf8mb4'),
		'postal_code' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 8, 'collate' => 'utf8mb4_general_ci', 'comment' => '郵便番号', 'charset' => 'utf8mb4'),
		'prefecture_code' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 2, 'collate' => 'utf8mb4_general_ci', 'comment' => '都道府県', 'charset' => 'utf8mb4'),
		'city' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '区市町村', 'charset' => 'utf8mb4'),
		'address' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '番地', 'charset' => 'utf8mb4'),
		'tel' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8mb4_general_ci', 'comment' => '電話番号', 'charset' => 'utf8mb4'),
		'fax' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8mb4_general_ci', 'comment' => 'FAX番号', 'charset' => 'utf8mb4'),
		'email' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => 'メールアドレス', 'charset' => 'utf8mb4'),
		'emergency_contact' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '緊急連絡先', 'charset' => 'utf8mb4'),
		'contact' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '問い合わせ先', 'charset' => 'utf8mb4'),
		'url' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => 'URL', 'charset' => 'utf8mb4'),
		'map_url' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 2000, 'collate' => 'utf8mb4_general_ci', 'comment' => '地図URL', 'charset' => 'utf8mb4'),
		'number_of_male_students' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'comment' => '男子生徒数'),
		'number_of_female_students' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'comment' => '女子生徒数'),
		'number_of_total_students' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'comment' => '全生徒数'),
		'number_of_faculty_members' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'comment' => '教員数'),
		'seismic_work' => array('type' => 'boolean', 'null' => true, 'default' => null, 'comment' => '耐震工事の有無'),
		'is_public_school_name_kana' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 学校名(かな)'),
		'is_public_school_name_roma' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 学校名(ローマ字)'),
		'is_public_principal_name' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 学校長名'),
		'is_public_principal_name_roma' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 学校長名(ローマ字)'),
		'is_public_school_type' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 国公立種別（国立・公立・私立）'),
		'is_public_school_kind' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 校種（小学校・中学校・高等学校・中等教育学校・小中一貫校）'),
		'is_public_student_category' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 学生種別（男子校・女子校・共学）'),
		'is_public_establish_year_month' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 開校年月'),
		'is_public_close_year_month' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 閉校年月'),
		'is_public_location' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 所在地'),
		'is_public_tel' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 電話番号'),
		'is_public_fax' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) FAX番号'),
		'is_public_email' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) メールアドレス'),
		'is_public_emergency_contact' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 緊急連絡先'),
		'is_public_contact' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 問い合わせ先'),
		'is_public_url' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) URL'),
		'is_public_number_of_male_students' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 男子生徒数'),
		'is_public_number_of_female_students' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 女子生徒数'),
		'is_public_number_of_total_students' => array('type' => 'boolean', 'null' => true, 'default' => '1'),
		'is_public_number_of_faculty_members' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 教員数'),
		'is_seismic_work' => array('type' => 'boolean', 'null' => true, 'default' => '1'),
		'created_user' => array('type' => 'integer', 'null' => true, 'default' => '0', 'unsigned' => false, 'comment' => '作成者'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '作成日時'),
		'modified_user' => array('type' => 'integer', 'null' => true, 'default' => '0', 'unsigned' => false, 'comment' => '更新者'),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '更新日時'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8mb4', 'collate' => 'utf8mb4_general_ci', 'engine' => 'InnoDB')
	);

}
