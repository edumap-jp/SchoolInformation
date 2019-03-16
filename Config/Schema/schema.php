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
		'displa_type' => array('type' => 'string', 'null' => false, 'default' => '10', 'length' => 30, 'collate' => 'utf8_general_ci', 'comment' => '表示タイプ side, footer, main', 'charset' => 'utf8'),
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
		'key' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
		'school_name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '学校名', 'charset' => 'utf8mb4'),
		'address' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '所在地', 'charset' => 'utf8mb4'),
		'tel' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '電話番号', 'charset' => 'utf8mb4'),
		'fax' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => 'Fax Number番号', 'charset' => 'utf8mb4'),
		'email' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => 'メールアドレス', 'charset' => 'utf8mb4'),
		'contact_information' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '連絡先', 'charset' => 'utf8mb4'),
		'number_of_students' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'comment' => '生徒数'),
		'number_of_faculty_members' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'comment' => '教員数'),
		'status' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4, 'unsigned' => false, 'comment' => '公開状況  1:公開中、2:公開申請中、3:下書き中、4:差し戻し'),
		'is_active' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'is_latest' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'language_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'is_origin' => array('type' => 'boolean', 'null' => false, 'default' => '1', 'comment' => 'オリジナルかどうか'),
		'is_translation' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '翻訳したかどうか'),
		'is_original_copy' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => 'オリジナルのコピー。言語を新たに追加したときに使用する'),
		'filename' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => 'タイトル', 'charset' => 'utf8mb4'),
		'description' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '概要', 'charset' => 'utf8mb4'),
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
