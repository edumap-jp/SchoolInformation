<?php
/**
 * SchoolInformationFrameSettingsControllerEditTest.php
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsControllerTestCase', 'NetCommons.TestSuite');

/**
 * SchoolInformationFrameSettingsControllerEditTest
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\SchoolInformations\TestCase\Controller\SchoolInformationFrameSettingsController
 */
class SchoolInformationFrameSettingsControllerEditTest extends NetCommonsControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = [
		'plugin.school_informations.school_information',
		'plugin.school_informations.frame_for_school_information',
		'plugin.school_informations.school_information_frame_setting',
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
	protected $_controller = 'school_information_frame_settings';

/**
 * テストDataの取得
 *
 * @return array
 */
	private function __getData($frameId, $frameKey, $schoolFrameId = '') {
		$data = [
			'save' => '',
			'Frame' => [
				'id' => $frameId,
				'key' => $frameKey,
			],
			'Block' => [
				'id' => '',
				'key' => '',
				'room_id' => '',
				'plugin_key' => '',
			],
			'BlocksLanguage' => [
				'language_id' => '',
			],
			'SchoolInformationFrameSetting' => [
				'id' => $schoolFrameId,
				'frame_key' => $frameKey,
				'is_display_school_name_kana' => '1',
				'is_display_school_name_roma' => '1',
				'is_display_principal_name' => '1',
				'is_display_principal_name_kana' => '1',
				'is_display_principal_name_roma' => '1',
				'is_display_school_type' => '1',
				'is_display_school_kind' => '1',
				'is_display_student_category' => '1',
				'is_display_establish_year_month' => '1',
				'is_display_close_year_month' => '1',
				'is_display_location' => '1',
				'is_display_tel' => '1',
				'is_display_fax' => '1',
				'is_display_email' => '1',
				'is_display_emergency_contact' => '1',
				'is_display_contact' => '1',
				'is_display_url' => '1',
				'is_display_number_of_male_students' => '1',
				'is_display_number_of_female_students' => '1',
				'is_display_number_of_total_students' => '1',
				'is_display_number_of_faculty_members' => '1',
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
			'/<input type="radio" name="data\[SchoolInformationFrameSetting\]\[([0-9a-z_]+)\]" ' .
					'id="[0-9a-z]+" value="1" checked="checked" \/>/iUu',
			$this->view,
			$matches
		);
		//debug($matches);
		$this->assertEquals($expects, $matches[1]);
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
				'is_display_school_name_kana'
			]
		];
		//左カラム
		$results[1] = [
			'urlOptions' => [
				'frame_id' => '4'
			],
			'expects' => [
				'is_display_location',
				'is_display_tel',
				'is_display_fax',
				'is_display_email',
			]
		];
		//右カラム
		$results[2] = [
			'urlOptions' => [
				'frame_id' => '8'
			],
			'expects' => [
				'is_display_location',
				'is_display_tel',
				'is_display_fax',
				'is_display_email',
			]
		];
		//フッター
		$results[3] = [
			'urlOptions' => [
				'frame_id' => '10'
			],
			'expects' => [
				'is_display_location',
				'is_display_tel',
				'is_display_fax',
				'is_display_email',
			]
		];
		//メイン
		$results[4] = [
			'urlOptions' => [
				'frame_id' => '6'
			],
			'expects' => [
				'is_display_school_name_kana',
				'is_display_school_name_roma',
				'is_display_principal_name',
				'is_display_principal_name_kana',
				'is_display_principal_name_roma',
				'is_display_school_type',
				'is_display_school_kind',
				'is_display_student_category',
				'is_display_establish_year_month',
				'is_display_close_year_month',
				'is_display_location',
				'is_display_tel',
				'is_display_fax',
				'is_display_email',
				'is_display_emergency_contact',
				'is_display_contact',
				'is_display_url',
				'is_display_number_of_male_students',
				'is_display_number_of_female_students',
				'is_display_number_of_total_students',
				'is_display_number_of_faculty_members',
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

		//バリデーションエラー
		$data = $this->__getData(null, null);
		$results[2] = [
			'data' => $data,
			'role' => Role::ROOM_ROLE_KEY_ROOM_ADMINISTRATOR,
			'urlOptions' => ['frame_id' => '6'],
			'exception' => 'BadRequestException',
		];

		return $results;
	}

}
