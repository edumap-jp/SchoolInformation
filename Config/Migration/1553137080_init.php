<?php
/**
 * 1553137080_init.php
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsMigration', 'NetCommons.Config/Migration');

/**
 * Init
 *
 * @package NetCommons\SchoolInformations\Config\Migration
 */
class Init extends NetCommonsMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'init';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'create_table' => array(
				'school_information_frame_settings' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary', 'comment' => 'ID'),
					'frame_key' => array('type' => 'string', 'null' => false, 'default' => null, 'key' => 'index', 'collate' => 'utf8_general_ci', 'comment' => 'フレームKey', 'charset' => 'utf8'),
					'display_type' => array('type' => 'string', 'null' => false, 'default' => 'main', 'length' => 30, 'collate' => 'utf8_general_ci', 'comment' => '表示タイプ side, footer, main', 'charset' => 'utf8'),
					'created_user' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'comment' => '作成者'),
					'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '作成日時'),
					'modified_user' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'comment' => '更新者'),
					'modified' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '更新日時'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
						'frame_key' => array('column' => 'frame_key', 'unique' => 0),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
				),
				'school_informations' => array(
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
					'number_of_male_students' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'comment' => '男子生徒数'),
					'number_of_female_students' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'comment' => '女子生徒数'),
					'number_of_faculty_members' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'comment' => '教員数'),
					'is_public_school_name_kana' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 学校名(かな)'),
					'is_public_school_name_roma' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 学校名(ローマ字)'),
					'is_public_principal_name' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 学校長名'),
					'is_public_principal_name_roma' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 学校長名(ローマ字)'),
					'is_public_school_type' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 国公立種別（国立・公立・私立）'),
					'is_public_school_kind' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 校種（小学校・中学校・高等学校・中等教育学校・小中一貫校）'),
					'is_public_student_category' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 学生種別（男子校・女子校・共学）'),
					'is_public_establish_year_month' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 開校年月'),
					'is_public_close_year_month' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 閉校年月'),
					'is_public_postal_code' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 郵便番号'),
					'is_public_prefecture_code' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 都道府県'),
					'is_public_city' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 区市町村'),
					'is_public_address' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 番地'),
					'is_public_tel' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 電話番号'),
					'is_public_fax' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) FAX番号'),
					'is_public_email' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) メールアドレス'),
					'is_public_emergency_contact' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 緊急連絡先'),
					'is_public_contact' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 問い合わせ先'),
					'is_public_url' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) URL'),
					'is_public_number_of_male_students' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 男子生徒数'),
					'is_public_number_of_female_students' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 女子生徒数'),
					'is_public_number_of_faculty_members' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '公開設定(1:公開 0:非公開) 教員数'),
					'created_user' => array('type' => 'integer', 'null' => true, 'default' => '0', 'unsigned' => false, 'comment' => '作成者'),
					'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '作成日時'),
					'modified_user' => array('type' => 'integer', 'null' => true, 'default' => '0', 'unsigned' => false, 'comment' => '更新者'),
					'modified' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '更新日時'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8mb4', 'collate' => 'utf8mb4_general_ci', 'engine' => 'InnoDB'),
				),
			),
		),
		'down' => array(
			'drop_table' => array(
				'school_information_frame_settings', 'school_informations'
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
