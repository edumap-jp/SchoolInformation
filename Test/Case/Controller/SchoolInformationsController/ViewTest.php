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
class SchoolInformationsControllerViewTest extends NetCommonsControllerTestCase {

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
 * viewアクションのGETテスト
 *
 * @param array $urlOptions URLオプション
 * @param array $expects テストの期待値
 * @param string|null $exception Exception
 * @param string $return testActionの実行後の結果
 * @dataProvider dataProviderView
 * @return void
 */
	public function testView($urlOptions, $expects, $exception = null, $return = 'view') {
		//テスト実施
		$url = Hash::merge(array(
			'plugin' => $this->plugin,
			'controller' => $this->_controller,
			'action' => 'view',
		), $urlOptions);

		$this->_testGetAction($url, null, $exception, $return);

		//結果の検証
		$this->__assertView($expects);
	}

/**
 * viewアクションのGETテスト
 *
 * @param array $urlOptions URLオプション
 * @param array $expects テストの期待値
 * @param string|null $exception Exception
 * @param string $return testActionの実行後の結果
 * @dataProvider dataProviderView
 * @return void
 */
	public function testViewByEditable($urlOptions, $expects, $exception = null, $return = 'view') {
		TestAuthGeneral::login($this, Role::ROOM_ROLE_KEY_ROOM_ADMINISTRATOR);

		//テスト実施
		$url = Hash::merge(array(
			'plugin' => $this->plugin,
			'controller' => $this->_controller,
			'action' => 'view',
		), $urlOptions);

		$this->_testGetAction($url, null, $exception, $return);

		//結果の検証
		$this->__assertView($expects);

		//ログアウト
		$expects[] = '編集';
		TestAuthGeneral::logout($this);
	}

/**
 * editアクションのGET検証
 *
 * @param array $expects テストの期待値
 * @return void
 */
	private function __assertView($expects) {
		$view = $this->view;
		$view = preg_replace('/^\s+/m', '', $view);
		$view = preg_replace('/\s+$/m', '', $view);
		$view = preg_replace("/&nbsp;\n/", '', $view);
		$view = preg_replace("/(\>)\s+/", '\1', $view);
		$view = preg_replace("/\s+(\<)/", '\1', $view);
		foreach ($expects as $expect) {
			$this->assertContains($expect, $view);
		}
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
 * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
 */
	public function dataProviderView() {
		$results = [];

		//ヘッダー
		$results[0] = [
			'urlOptions' => [
				'frame_id' => '2'
			],
			'expects' => [
				'<div class="school-information-record-item school-information-school-name-kana">クリヤシリツダイイチショウガッコウ</div>',
				'<div>栗矢市立第一小学校</div>',
				'<div class="school-information-location"><span class="school-information-prefecture"></span></div>'
			]
		];
		//左カラム
		$results[1] = [
			'urlOptions' => [
				'frame_id' => '4'
			],
			'expects' => [
				'<div class="school-information-side-school-name">栗矢市立第一小学校</div>',
				'<div class="school-information-location">' .
					'<span class="school-information-record-item school-information-postal-code">〒366-0000</span>' .
					'<span class="school-information-prefecture">埼玉県</span>' .
					'<span class="school-information-record-item school-information-city">栗矢市</span>' .
					'<span class="school-information-record-item school-information-address">栗矢9丁目18番地</span>' .
				'</div>',
				'<div class="school-information-record-item school-information-tel">' .
					'<span class="school-information-label school-information-tel-label">Tel</span>03-4212-2722' .
				'</div>',
				'<div class="school-information-record-item school-information-fax">' .
					'<span class="school-information-label school-information-fax-label">Fax</span>03-4212-2722' .
				'</div>',
				'<div class="school-information-record-item school-information-email">kuriya-dai-ich',
					'/img/school_informations/mailmark.gif',
				'example.com</div>'
			]
		];
		//右カラム
		$results[2] = [
			'urlOptions' => [
				'frame_id' => '8'
			],
			'expects' => [
				'<div class="school-information-side-school-name">栗矢市立第一小学校</div>',
				'<div class="school-information-location">' .
					'<span class="school-information-record-item school-information-postal-code">〒366-0000</span>' .
					'<span class="school-information-prefecture">埼玉県</span>' .
					'<span class="school-information-record-item school-information-city">栗矢市</span>' .
					'<span class="school-information-record-item school-information-address">栗矢9丁目18番地</span>' .
				'</div>',
				'<div class="school-information-record-item school-information-tel">' .
					'<span class="school-information-label school-information-tel-label">Tel</span>03-4212-2722' .
				'</div>',
				'<div class="school-information-record-item school-information-fax">' .
					'<span class="school-information-label school-information-fax-label">Fax</span>03-4212-2722' .
				'</div>',
				'<div class="school-information-record-item school-information-email">kuriya-dai-ich',
					'/img/school_informations/mailmark.gif',
				'example.com</div>'
			]
		];
		//フッター
		$results[3] = [
			'urlOptions' => [
				'frame_id' => '10'
			],
			'expects' => [
				'<div class="school-information-footer-school-name">栗矢市立第一小学校</div>',
				'<div class="school-information-location">' .
					'<span class="school-information-record-item school-information-postal-code">〒366-0000</span>' .
					'<span class="school-information-prefecture">埼玉県</span>' .
					'<span class="school-information-record-item school-information-city">栗矢市</span>' .
					'<span class="school-information-record-item school-information-address">栗矢9丁目18番地</span>' .
				'</div>',
				'<span class="school-information-record-item school-information-tel"><span class="school-information-label school-information-tel-label">Tel</span>03-4212-2722</span>',
				'<span class="school-information-record-item school-information-fax"><span class="school-information-label school-information-fax-label">Fax</span>03-4212-2722</span>',
				'<span class="school-information-record-item school-information-email">kuriya-dai-ich',
				'/img/school_informations/mailmark.gif',
				'example.com</span>'
			]
		];
		//メイン
		$results[4] = [
			'urlOptions' => [
				'frame_id' => '6'
			],
			'expects' => [
				'<div class="school-information-record-item school-information-school-name-kana">クリヤシリツダイイチショウガッコウ</div>',
				'<div>栗矢市立第一小学校</div>',
				'<div class="school-information-record-item school-information-school-name-roma">Kuriya Dai-ichi elementary school</div>',
				'<tr><th>所在地</th><td>' .
					'<div class="school-information-location">' .
						'<span class="school-information-record-item school-information-postal-code">〒366-0000</span>' .
						'<span class="school-information-prefecture">埼玉県</span>' .
						'<span class="school-information-record-item school-information-city">栗矢市</span>' .
						'<span class="school-information-record-item school-information-address">栗矢9丁目18番地</span>' .
					'</div>' .
				'</td></tr>',
				'<tr><th>電話番号</th><td><div class="school-information-record-item school-information-tel">03-4212-2722</div></td></tr>',
				'<tr><th>Fax番号</th><td><div class="school-information-record-item school-information-fax">03-4212-2722</div></td></tr>',
				'<tr><th>問い合わせ先</th><td><div class="school-information-record-item school-information-contact">03-4212-2722</div></td></tr>',
				'<tr><th>学校メールアドレス</th><td><div class="school-information-record-item school-information-email">kuriya-dai-ich',
				'/img/school_informations/mailmark.gif',
				'example.com</div></td></tr>',
				'<tr><th>URL</th><td><div class="school-information-record-item school-information-url"><a href="https://kuriya-dai-ichi-elementary-schoo.edumap.jp" target="_blank">https://kuriya-dai-ichi-elementary-schoo.edumap.jp</a></div></td></tr>',
				'<tr><th>校長名</th><td><ruby>押切基次郎<rt>オシキリモトジロウ</rt></ruby>　</td></tr>',
				'<tr><th>国公立種別</th><td><div class="school-information-record-item school-information-school-type">公立</div></td></tr>',
				'<tr><th>校種</th><td><div class="school-information-record-item school-information-school-kind">小学校</div></td></tr>',
				'<tr><th>学生種別</th><td><div class="school-information-record-item school-information-student-category">共学</div></td></tr>',
				'<tr><th>開校年月</th><td><div class="school-information-record-item school-information-establish-year-month">2005年4月</div></td></tr>',
				'<tr><th>児童数</th><td><div><span class="school-information-record-item school-information-number-of-total-students">534 人</span></div><div><span>男子 :</span><span class="school-information-record-item school-information-number-of-male-students">276 人</span></div><div><span>女子 :</span><span class="school-information-record-item school-information-number-of-female-students">258 人</span></div></td></tr>',
				'<tr><th>教員数</th><td><div class="school-information-record-item school-information-number-of-faculty-members">27 人</div></td></tr>',
			]
		];

		return $results;
	}

}
