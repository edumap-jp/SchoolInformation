<?php
/**
 * BbsFrameSettingsController Test Case
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsControllerTestCase', 'NetCommons.TestSuite');

/**
 * BbsFrameSettingsController Test Case
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\Bbses\Test\Case\Controller
 */
class SchoolInformationsControllerditTest extends NetCommonsControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = [
		'plugin.school_informations.school_information',
		'plugin.school_informations.school_information_frame_setting',
		'plugin.school_informations.frame_for_school_information',
		'plugin.school_informations.data_type_choice_for_school_information',
		'plugin.pages.box4pages',
		'plugin.pages.boxes_page_container4pages',
		'plugin.frames.frame_public_language4frames',
		'plugin.frames.frames_language4frames',
		'plugin.pages.pages_language4pages',
		'plugin.pages.page_container4pages',
		'plugin.pages.page4pages',
		'plugin.pages.plugins_room4pages',
	];

/**
 * Plugin name
 *
 * @var array
 */
	public $plugin = 'school_informations';

/**
 * Controller name
 *
 * @var string
 */
	protected $_controller = 'school_informations';

/**
 * テストDataの取得
 *
 * @return array
 */
	private function __getData() {
		$data = [
			'save' => '',
			'SchoolInformation' => [
				'id' => '1',
				'key' => '',
				'language_id' => '',
				'school_name' => '教育のための科学小学校',
				'school_name_kana' => 'キョウイクノタメノカガクショウガッコウ',
				'is_public_school_name_kana' => '1',
				'school_name_roma' => 'Research Institute of Science for Education Attached Elementary school',
				'is_public_school_name_roma' => '1',
				'school_badge' => [
					'remove' => '0',
					'name' => '',
					'type' => '',
					'tmp_name' => '',
					'error' => 4,
					'size' => 0,
				],
				'cover_picture' => [
					'remove' => '0',
					'name' => '',
					'type' => '',
					'tmp_name' => '',
					'error' => 4,
					'size' => 0,
				],
				'is_public_location' => '1',
				'postal_code' => '123-4567',
				'prefecture_code' => '13',
				'city_code' => '131016',
				'city' => '千代田区',
				'address' => '大手町XXXX-XXXXX',
				'tel' => '03-1111-2222',
				'is_public_tel' => '1',
				'fax' => '03-1111-3333',
				'is_public_fax' => '1',
				'email' => 'test@example.com',
				'is_public_email' => '1',
				'emergency_contact' => '03-1111-2222',
				'is_public_emergency_contact' => '1',
				'contact' => '03-1111-2222',
				'is_public_contact' => '1',
				'url' => 'https://test-school.edumap.jp',
				'is_public_url' => '1',
				'principal_name' => '大手町幸太郎',
				'is_public_principal_name' => '1',
				'principal_name_kana' => 'オオテマチコウタロウ',
				'is_public_principal_name_kana' => '1',
				'school_type' => '国立',
				'is_public_school_type' => '1',
				'school_kind' => '高等学校',
				'is_public_school_kind' => '1',
				'student_category' => '男子校',
				'is_public_student_category' => '1',
				'establish_year_month' => '2021-03-31 15:00:00',
				'is_public_establish_year_month' => '1',
				'close_year_month' => '',
				'is_public_close_year_month' => '1',
				'seismic_work' => '0',
				'is_public_seismic_work' => '0',
				'designation_of_shelter' => '0',
				'is_public_designation_of_shelter' => '0',
				'number_of_faculty_members' => '10',
				'is_public_number_of_faculty_members' => '1',
				'number_of_total_students' => '20',
				'is_public_number_of_total_students' => '1',
				'number_of_male_students' => '11',
				'is_public_number_of_male_students' => '1',
				'number_of_female_students' => '9',
				'is_public_number_of_female_students' => '1',
				'map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15416.677638347563!2d139.7408159187545!3d35.67805485085001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188c0d02d8064d%3A0xd11a5f0b379e6db7!2z55qH5bGF!5e0!3m2!1sja!2sjp!4v1558878421425!5m2!1sja!2sjp',
			],
			'_NetCommonsTime' => [
				'user_timezone' => 'Asia/Tokyo',
				'convert_fields' => 'SchoolInformation.establish_year_month,SchoolInformation.close_year_month',
			],
		];

		return $data;
	}

/**
 * editアクションのGETテスト
 *
 * @param array $urlOptions URLオプション
 * @param array $expects テストの期待値
 * @param string|null $exception Exception
 * @param string $return testActionの実行後の結果
 * @dataProvider dataProviderEditGet
 * @return void
 */
	public function testEditGet($urlOptions, $expects, $exception = null, $return = 'view') {
		//ログイン
		TestAuthGeneral::login($this, Role::ROOM_ROLE_KEY_ROOM_ADMINISTRATOR);

		//テスト実施
		$url = Hash::merge(array(
			'plugin' => $this->plugin,
			'controller' => $this->_controller,
			'action' => 'edit',
		), $urlOptions);

		$this->_testGetAction($url, null, $exception, $return);

		//結果の検証
		$this->__assertEditGet($expects);

		//ログアウト
		TestAuthGeneral::logout($this);
	}

/**
 * editアクションのGET検証
 *
 * @return void
 */
	private function __assertEditGet($expects) {
		$matches = [];
		preg_match_all(
			'/<(input|select)([^\>]+)>/iUu',
			$this->view,
			$matches
		);
		$this->assertEquals($expects, $matches[0]);
	}

/**
 * editアクションのGETテスト(ログインあり)用DataProvider
 *
 * #### 戻り値
 *  - urlOptions: URLオプション
 *  - expects: テストの期待値
 *  - exception: Exception
 *  - return: testActionの実行後の結果
 *
 * @return array
 */
	public function dataProviderEditGet() {
		$results = [];

		//ヘッダー
		$results[0] = [
			'urlOptions' => [
				'frame_id' => '2'
			],
			'expects' => [
				'<input type="hidden" name="_method" value="PUT"/>',
				'<input type="hidden" name="data[SchoolInformation][id]" value="1" id="SchoolInformationId"/>',
				'<input type="hidden" name="data[SchoolInformation][key]" id="SchoolInformationKey"/>',
				'<input type="hidden" name="data[SchoolInformation][language_id]" id="SchoolInformationLanguageId"/>',
				'<input name="data[SchoolInformation][school_name]" class="form-control" maxlength="255" type="text" value="栗矢市立第一小学校" id="SchoolInformationSchoolName"/>',
				'<input name="data[SchoolInformation][school_name_kana]" class="form-control" maxlength="255" type="text" value="クリヤシリツダイイチショウガッコウ" id="SchoolInformationSchoolNameKana"/>',
				'<input type="radio" name="data[SchoolInformation][is_public_school_name_kana]" id="SchoolInformationIsPublicSchoolNameKana1" value="1" checked="checked" />',
				'<input type="radio" name="data[SchoolInformation][is_public_school_name_kana]" id="SchoolInformationIsPublicSchoolNameKana0" value="0" />',
				'<input name="data[SchoolInformation][school_name_roma]" class="form-control" maxlength="255" type="text" value="Kuriya Dai-ichi elementary school" id="SchoolInformationSchoolNameRoma"/>',
				'<input type="radio" name="data[SchoolInformation][is_public_school_name_roma]" id="SchoolInformationIsPublicSchoolNameRoma1" value="1" checked="checked" />',
				'<input type="radio" name="data[SchoolInformation][is_public_school_name_roma]" id="SchoolInformationIsPublicSchoolNameRoma0" value="0" />',
				'<input type="file" name="data[SchoolInformation][school_badge]" class="" accept="image/gif,image/jpeg,image/png" id="SchoolInformationSchoolBadge" required="required"/>',
				'<input type="file" name="data[SchoolInformation][cover_picture]" class="" accept="image/gif,image/jpeg,image/png" id="SchoolInformationCoverPicture" required="required"/>',
				'<input type="radio" name="data[SchoolInformation][is_public_location]" id="SchoolInformationIsPublicLocation1" value="1" checked="checked" />',
				'<input type="radio" name="data[SchoolInformation][is_public_location]" id="SchoolInformationIsPublicLocation0" value="0" />',
				'<input name="data[SchoolInformation][postal_code]" class="form-control" maxlength="8" type="text" value="3660000" id="SchoolInformationPostalCode"/>',
				'<select name="data[SchoolInformation][prefecture_code]" class="form-control" id="SchoolInformationPrefectureCode">',
				'<input name="data[SchoolInformation][city_code]" class="form-control" maxlength="8" type="text" value="112186" id="SchoolInformationCityCode"/>',
				'<input name="data[SchoolInformation][city]" class="form-control" maxlength="255" type="text" value="栗矢市" id="SchoolInformationCity"/>',
				'<input name="data[SchoolInformation][address]" class="form-control" maxlength="255" type="text" value="栗矢9丁目18番地" id="SchoolInformationAddress"/>',
				'<input name="data[SchoolInformation][tel]" class="form-control" maxlength="50" type="tel" value="03-4212-2722" id="SchoolInformationTel"/>',
				'<input type="radio" name="data[SchoolInformation][is_public_tel]" id="SchoolInformationIsPublicTel1" value="1" checked="checked" />',
				'<input type="radio" name="data[SchoolInformation][is_public_tel]" id="SchoolInformationIsPublicTel0" value="0" />',
				'<input name="data[SchoolInformation][fax]" class="form-control" maxlength="50" type="text" value="03-4212-2722" id="SchoolInformationFax"/>',
				'<input type="radio" name="data[SchoolInformation][is_public_fax]" id="SchoolInformationIsPublicFax1" value="1" checked="checked" />',
				'<input type="radio" name="data[SchoolInformation][is_public_fax]" id="SchoolInformationIsPublicFax0" value="0" />',
				'<input name="data[SchoolInformation][email]" class="form-control" maxlength="255" type="email" value="kuriya-dai-ich@example.com" id="SchoolInformationEmail"/>',
				'<input type="radio" name="data[SchoolInformation][is_public_email]" id="SchoolInformationIsPublicEmail1" value="1" checked="checked" />',
				'<input type="radio" name="data[SchoolInformation][is_public_email]" id="SchoolInformationIsPublicEmail0" value="0" />',
				'<input name="data[SchoolInformation][emergency_contact]" class="form-control" maxlength="255" type="text" value="" id="SchoolInformationEmergencyContact"/>',
				'<input type="radio" name="data[SchoolInformation][is_public_emergency_contact]" id="SchoolInformationIsPublicEmergencyContact1" value="1" checked="checked" />',
				'<input type="radio" name="data[SchoolInformation][is_public_emergency_contact]" id="SchoolInformationIsPublicEmergencyContact0" value="0" />',
				'<input name="data[SchoolInformation][contact]" class="form-control" maxlength="255" type="text" value="03-4212-2722" id="SchoolInformationContact"/>',
				'<input type="radio" name="data[SchoolInformation][is_public_contact]" id="SchoolInformationIsPublicContact1" value="1" checked="checked" />',
				'<input type="radio" name="data[SchoolInformation][is_public_contact]" id="SchoolInformationIsPublicContact0" value="0" />',
				'<input name="data[SchoolInformation][url]" class="form-control" maxlength="255" type="text" value="https://kuriya-dai-ichi-elementary-schoo.edumap.jp" id="SchoolInformationUrl"/>',
				'<input type="radio" name="data[SchoolInformation][is_public_url]" id="SchoolInformationIsPublicUrl1" value="1" checked="checked" />',
				'<input type="radio" name="data[SchoolInformation][is_public_url]" id="SchoolInformationIsPublicUrl0" value="0" />',
				'<input name="data[SchoolInformation][principal_name]" class="form-control" maxlength="255" type="text" value="押切基次郎" id="SchoolInformationPrincipalName"/>',
				'<input type="radio" name="data[SchoolInformation][is_public_principal_name]" id="SchoolInformationIsPublicPrincipalName1" value="1" checked="checked" />',
				'<input type="radio" name="data[SchoolInformation][is_public_principal_name]" id="SchoolInformationIsPublicPrincipalName0" value="0" />',
				'<input name="data[SchoolInformation][principal_name_kana]" class="form-control" maxlength="255" type="text" value="オシキリモトジロウ" id="SchoolInformationPrincipalNameKana"/>',
				'<input type="radio" name="data[SchoolInformation][is_public_principal_name_kana]" id="SchoolInformationIsPublicPrincipalNameKana1" value="1" checked="checked" />',
				'<input type="radio" name="data[SchoolInformation][is_public_principal_name_kana]" id="SchoolInformationIsPublicPrincipalNameKana0" value="0" />',
				'<select name="data[SchoolInformation][school_type]" class="form-control" id="SchoolInformationSchoolType">',
				'<input type="radio" name="data[SchoolInformation][is_public_school_type]" id="SchoolInformationIsPublicSchoolType1" value="1" checked="checked" />',
				'<input type="radio" name="data[SchoolInformation][is_public_school_type]" id="SchoolInformationIsPublicSchoolType0" value="0" />',
				'<select name="data[SchoolInformation][school_kind]" class="form-control" id="SchoolInformationSchoolKind">',
				'<input type="radio" name="data[SchoolInformation][is_public_school_kind]" id="SchoolInformationIsPublicSchoolKind1" value="1" checked="checked" />',
				'<input type="radio" name="data[SchoolInformation][is_public_school_kind]" id="SchoolInformationIsPublicSchoolKind0" value="0" />',
				'<select name="data[SchoolInformation][student_category]" class="form-control" id="SchoolInformationStudentCategory">',
				'<input type="radio" name="data[SchoolInformation][is_public_student_category]" id="SchoolInformationIsPublicStudentCategory1" value="1" checked="checked" />',
				'<input type="radio" name="data[SchoolInformation][is_public_student_category]" id="SchoolInformationIsPublicStudentCategory0" value="0" />',
				'<input name="data[SchoolInformation][establish_year_month]" datetimepicker-options="{&quot;format&quot;:&quot;YYYY-MM&quot;}" ng-model="schoolInformation.establishYearMonth" datetimepicker="1" convert_timezone="1" data-toggle="dropdown" class="form-control" maxlength="7" type="text" value="2005-04" id="SchoolInformationEstablishYearMonth"/>',
				'<input type="radio" name="data[SchoolInformation][is_public_establish_year_month]" id="SchoolInformationIsPublicEstablishYearMonth1" value="1" checked="checked" />',
				'<input type="radio" name="data[SchoolInformation][is_public_establish_year_month]" id="SchoolInformationIsPublicEstablishYearMonth0" value="0" />',
				'<input name="data[SchoolInformation][close_year_month]" datetimepicker-options="{&quot;format&quot;:&quot;YYYY-MM&quot;}" ng-model="schoolInformation.closeYearMonth" datetimepicker="1" convert_timezone="1" data-toggle="dropdown" class="form-control" maxlength="7" type="text" value="" id="SchoolInformationCloseYearMonth"/>',
				'<input type="radio" name="data[SchoolInformation][is_public_close_year_month]" id="SchoolInformationIsPublicCloseYearMonth1" value="1" checked="checked" />',
				'<input type="radio" name="data[SchoolInformation][is_public_close_year_month]" id="SchoolInformationIsPublicCloseYearMonth0" value="0" />',
				'<input type="radio" name="data[SchoolInformation][seismic_work]" id="SchoolInformationSeismicWork1" value="1" checked="checked" />',
				'<input type="radio" name="data[SchoolInformation][seismic_work]" id="SchoolInformationSeismicWork0" value="0" />',
				'<input type="radio" name="data[SchoolInformation][is_public_seismic_work]" id="SchoolInformationIsPublicSeismicWork1" value="1" />',
				'<input type="radio" name="data[SchoolInformation][is_public_seismic_work]" id="SchoolInformationIsPublicSeismicWork0" value="0" checked="checked" />',
				'<input type="radio" name="data[SchoolInformation][designation_of_shelter]" id="SchoolInformationDesignationOfShelter1" value="1" checked="checked" />',
				'<input type="radio" name="data[SchoolInformation][designation_of_shelter]" id="SchoolInformationDesignationOfShelter0" value="0" />',
				'<input type="radio" name="data[SchoolInformation][is_public_designation_of_shelter]" id="SchoolInformationIsPublicDesignationOfShelter1" value="1" />',
				'<input type="radio" name="data[SchoolInformation][is_public_designation_of_shelter]" id="SchoolInformationIsPublicDesignationOfShelter0" value="0" checked="checked" />',
				'<input name="data[SchoolInformation][number_of_faculty_members]" class="form-control" type="number" value="27" id="SchoolInformationNumberOfFacultyMembers"/>',
				'<input type="radio" name="data[SchoolInformation][is_public_number_of_faculty_members]" id="SchoolInformationIsPublicNumberOfFacultyMembers1" value="1" checked="checked" />',
				'<input type="radio" name="data[SchoolInformation][is_public_number_of_faculty_members]" id="SchoolInformationIsPublicNumberOfFacultyMembers0" value="0" />',
				'<input name="data[SchoolInformation][number_of_total_students]" class="form-control" type="number" value="534" id="SchoolInformationNumberOfTotalStudents"/>',
				'<input type="radio" name="data[SchoolInformation][is_public_number_of_total_students]" id="SchoolInformationIsPublicNumberOfTotalStudents1" value="1" checked="checked" />',
				'<input type="radio" name="data[SchoolInformation][is_public_number_of_total_students]" id="SchoolInformationIsPublicNumberOfTotalStudents0" value="0" />',
				'<input name="data[SchoolInformation][number_of_male_students]" class="form-control" type="number" value="276" id="SchoolInformationNumberOfMaleStudents"/>',
				'<input type="radio" name="data[SchoolInformation][is_public_number_of_male_students]" id="SchoolInformationIsPublicNumberOfMaleStudents1" value="1" checked="checked" />',
				'<input type="radio" name="data[SchoolInformation][is_public_number_of_male_students]" id="SchoolInformationIsPublicNumberOfMaleStudents0" value="0" />',
				'<input name="data[SchoolInformation][number_of_female_students]" class="form-control" type="number" value="258" id="SchoolInformationNumberOfFemaleStudents"/>',
				'<input type="radio" name="data[SchoolInformation][is_public_number_of_female_students]" id="SchoolInformationIsPublicNumberOfFemaleStudents1" value="1" checked="checked" />',
				'<input type="radio" name="data[SchoolInformation][is_public_number_of_female_students]" id="SchoolInformationIsPublicNumberOfFemaleStudents0" value="0" />',
				'<input name="data[SchoolInformation][map_url]" class="form-control" maxlength="2000" type="text" value="https://www.google.com/maps/embed?origin=mfe&amp;pb=!1m13!1m8!1m3!1d6585.8606394135795!2d132.457015!3d34.37769!3m2!1i1024!2i768!4f13.1!2m1!1z5Z-8546J55yM5qCX55-i5biC5qCX55-iOeS4geebrjE455Wq5Zyw!5e0!6i16!3m1!1sja!5m1!1sja" id="SchoolInformationMapUrl"/>',
				'<input type="hidden" name="data[_NetCommonsTime][user_timezone]" id="_NetCommonsTimeUserTimezone"/>',
				'<input type="hidden" name="data[_NetCommonsTime][convert_fields]" value="SchoolInformation.establish_year_month,SchoolInformation.close_year_month" id="_NetCommonsTimeConvertFields"/>'
			]
		];

		return $results;
	}

/**
 * editアクションのPOSTテスト
 *
 * @param array $data POSTデータ
 * @param string $role ロール
 * @param array $urlOptions URLオプション
 * @param string|null $exception Exception
 * @param string $return testActionの実行後の結果
 * @dataProvider dataProviderEditPost
 * @return void
 */
	public function testEditPost($data, $role, $urlOptions, $exception = null, $return = 'view') {
		//ログイン
		if (isset($role)) {
			TestAuthGeneral::login($this, $role);
		}

		//テスト実施
		$url = Hash::merge(['action' => 'edit'], $urlOptions);
		$this->_testPostAction('put', $data, $url, $exception, $return);

		//正常の場合、リダイレクト
		if (! $exception) {
			$header = $this->controller->response->header();
			$this->assertNotEmpty($header['Location']);
		}

		//ログアウト
		if (isset($role)) {
			TestAuthGeneral::logout($this);
		}
	}

/**
 * editアクションのPOSTテスト用DataProvider
 *
 * #### 戻り値
 *  - data: 登録データ
 *  - role: ロール
 *  - urlOptions: URLオプション
 *  - exception: Exception
 *  - return: testActionの実行後の結果
 *
 * @return array
 */
	public function dataProviderEditPost() {
		$results = [];

		//ログインなし
		$data = $this->__getData('6', 'frame_3');
		$results[0] = [
			'data' => $data,
			'role' => null,
			'urlOptions' => ['frame_id' => '6'],
			'exception' => 'ForbiddenException',
		];

		//正常
		$data = $this->__getData('6', 'frame_3');
		$results[1] = [
			'data' => $data,
			'role' => Role::ROOM_ROLE_KEY_ROOM_ADMINISTRATOR,
			'urlOptions' => ['frame_id' => '6'],
			'exception' => null,
		];

		return $results;
	}

}
