<?php
/**
 * SchoolInformationsController Test Case
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsControllerTestCase', 'NetCommons.TestSuite');

/**
 * Summary for SchoolInformationsController Test Case
 */
class SchoolInformationsControllerViewWithoutDataTest extends NetCommonsControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = [
		'plugin.school_informations.school_information_without_data',
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
 * viewアクションのGETテスト
 *
 * @param array $urlOptions URLオプション
 * @param string|null $exception Exception
 * @param string $return testActionの実行後の結果
 * @dataProvider dataProviderView
 * @return void
 */
	public function testView($urlOptions, $exception = null, $return = 'view') {
		//テスト実施
		$url = Hash::merge(array(
			'plugin' => $this->plugin,
			'controller' => $this->_controller,
			'action' => 'view',
		), $urlOptions);

		$this->_testGetAction($url, null, $exception, $return);

		//結果の検証
		$this->assertNull($this->view);
	}

/**
 * viewアクションのGETテスト
 *
 * @param array $urlOptions URLオプション
 * @param string|null $exception Exception
 * @param string $return testActionの実行後の結果
 * @dataProvider dataProviderView
 * @return void
 */
	public function testViewByEditable($urlOptions, $exception = null, $return = 'view') {
		TestAuthGeneral::login($this, Role::ROOM_ROLE_KEY_ROOM_ADMINISTRATOR);

		//テスト実施
		$url = Hash::merge(array(
			'plugin' => $this->plugin,
			'controller' => $this->_controller,
			'action' => 'view',
		), $urlOptions);

		$this->_testGetAction($url, null, $exception, $return);

		//結果の検証
		$this->assertContains('編集', $this->view);

		//ログアウト
		TestAuthGeneral::logout($this);
	}

/**
 * editアクションのGETテスト(ログインあり)用DataProvider
 *
 * #### 戻り値
 *  - urlOptions: URLオプション
 *  - exception: Exception
 *  - return: testActionの実行後の結果
 *
 * @return array
 */
	public function dataProviderView() {
		$results = [];

		//ヘッダー
		$results[0] = [
			'urlOptions' => [
				'frame_id' => '2'
			],
		];
		//左カラム
		$results[1] = [
			'urlOptions' => [
				'frame_id' => '4'
			],
		];
		//右カラム
		$results[2] = [
			'urlOptions' => [
				'frame_id' => '8'
			],
		];
		//フッター
		$results[3] = [
			'urlOptions' => [
				'frame_id' => '10'
			],
		];
		//メイン
		$results[4] = [
			'urlOptions' => [
				'frame_id' => '6'
			],
		];

		return $results;
	}

}
