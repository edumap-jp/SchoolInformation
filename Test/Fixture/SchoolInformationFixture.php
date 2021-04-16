<?php
/**
 * SchoolInformationFixture
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

/**
 * Summary for SchoolInformationFixture
 */
class SchoolInformationFixture extends CakeTestFixture {

/**
 * Records
 *
 * @var array
 */
	public $records = [
		[
			'id' => 1,
			'edumap_key' => 'kuriya-dai-ichi-elementary-schoo.edumap.jp',
			'school_name' => '栗矢市立第一小学校',
			'school_name_kana' => 'クリヤシリツダイイチショウガッコウ',
			'school_name_roma' => 'Kuriya Dai-ichi elementary school',
			'principal_name' => '押切基次郎',
			'principal_name_kana' => 'オシキリモトジロウ',
			'principal_name_roma' => 'Motojiro Oshikiri',
			'school_type' => '公立',
			'school_kind' => '小学校',
			'student_category' => '共学',
			'establish_year_month' => '2005-04',
			'close_year_month' => '',
			'postal_code' => '3660000',
			'prefecture_code' => '11',
			'city_code' => '112186',
			'city' => '栗矢市',
			'address' => '栗矢9丁目18番地',
			'tel' => '03-4212-2722',
			'fax' => '03-4212-2722',
			'email' => 'kuriya-dai-ich@example.com',
			'emergency_contact' => '',
			'contact' => '03-4212-2722',
			'url' => 'https://kuriya-dai-ichi-elementary-schoo.edumap.jp',
			'map_url' => 'https://www.google.com/maps/embed?origin=mfe&pb=!1m13!1m8!1m3!1d6585.8606394135795!2d132.457015!3d34.37769!3m2!1i1024!2i768!4f13.1!2m1!1z5Z-8546J55yM5qCX55-i5biC5qCX55-iOeS4geebrjE455Wq5Zyw!5e0!6i16!3m1!1sja!5m1!1sja',
			'number_of_male_students' => '276',
			'number_of_female_students' => '258',
			'number_of_total_students' => '534',
			'number_of_faculty_members' => '27',
			'seismic_work' => true,
			'designation_of_shelter' => true,
			'is_public_school_name_kana' => true,
			'is_public_school_name_roma' => true,
			'is_public_principal_name' => true,
			'is_public_principal_name_kana' => true,
			'is_public_principal_name_roma' => true,
			'is_public_school_type' => true,
			'is_public_school_kind' => true,
			'is_public_student_category' => true,
			'is_public_establish_year_month' => true,
			'is_public_close_year_month' => true,
			'is_public_location' => true,
			'is_public_tel' => true,
			'is_public_fax' => true,
			'is_public_email' => true,
			'is_public_emergency_contact' => true,
			'is_public_contact' => true,
			'is_public_url' => true,
			'is_public_number_of_male_students' => true,
			'is_public_number_of_female_students' => true,
			'is_public_number_of_total_students' => true,
			'is_public_number_of_faculty_members' => true,
			'is_public_seismic_work' => false,
			'is_public_designation_of_shelter' => false,
		]
	];

/**
 * Initialize the fixture.
 *
 * @return void
 */
	public function init() {
		$pluginName = 'SchoolInformations';
		require_once App::pluginPath($pluginName) . 'Config' . DS . 'Schema' . DS . 'schema.php';
		$schemaClassName = $pluginName . 'Schema';
		$this->fields = (new $schemaClassName())->tables[Inflector::tableize($this->name)];
		parent::init();
	}

}
