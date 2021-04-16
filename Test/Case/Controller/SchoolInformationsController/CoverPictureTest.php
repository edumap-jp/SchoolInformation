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
class SchoolInformationsControllerCoverPictureTest extends NetCommonsControllerTestCase {

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
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->generateNc(Inflector::camelize('school_informations'), [
			'components' => [
				'Files.Download' => ['doDownload']
			],
		]);
	}

/**
 * school_badgeアクションのGETテスト
 *
 * @return void
 */
	public function testCoverPicture() {
		//テスト実施
		$url = [
			'plugin' => $this->plugin,
			'controller' => 'school_informations',
			'action' => 'cover_picture',
		];

		$this->controller->Download->expects($this->once())
			->method('doDownload')
			->with('1', ['field' => 'cover_picture', 'size' => 'large']);

		$this->_testGetAction($url, null, null, 'result');
	}

}
