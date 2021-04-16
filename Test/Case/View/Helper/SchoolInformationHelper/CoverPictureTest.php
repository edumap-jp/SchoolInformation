<?php
/**
 * SchoolInformationHelperCoverPictureTest.php
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsHelperTestCase', 'NetCommons.TestSuite');
if (!defined('UPLOADS_ROOT')) {
	define('UPLOADS_ROOT', App::pluginPath('SchoolInformations') . 'Test' . DS . 'Fixture' . DS);
}

/**
 * SchoolInformationHelperCoverPictureTest
 *
 * @property SchoolInformationHelper $SchoolInformation
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\SchoolInformations\TestCase\View\Helper\SchoolInformationHelper
 */
class SchoolInformationHelperCoverPictureTest extends NetCommonsHelperTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array();

/**
 * Plugin name
 *
 * @var string
 */
	public $plugin = 'school_informations';

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		//テストデータ生成
		$viewVars = array();
		$requestData = array();
		$params = array();

		//Helperロード
		$this->loadHelper('SchoolInformations.SchoolInformation', $viewVars, $requestData, $params);
	}

/**
 * coverPicture()のテスト
 *
 * @param array $uploadFile
 * @param string $expect
 * @dataProvider dataProvider
 * @return void
 */
	public function testCoverPicture($uploadFile, $expect) {
		$schoolInfo['UploadFile'] = $uploadFile;

		$this->SchoolInformation->set($schoolInfo);
		$result = $this->SchoolInformation->coverPicture();

		$this->assertEquals($expect, $result);
	}

/**
 * coverPicture()のテスト用DataProvider
 *
 * @return array テストデータ
 */
	public function dataProvider() {
		$results = [];

		$fileName = '179x1139.png';
		$base64Img = base64_encode(
			file_get_contents(UPLOADS_ROOT . 'cover_picture' . DS . '1' . DS . 'large_' . $fileName)
		);
		$results[0] = [
			'uploadFile' => [
				'cover_picture' => [
					'id' => '1',
					'path' => 'cover_picture',
					'real_file_name' => $fileName,
					'mimetype' => 'image/png',
				],
			],
			'expect' => '<img src="data:image/png;base64,' . $base64Img . '" class="school-cover-picture-fixed-width" alt="" />',
		];

		$fileName = '179x1141.png';
		$base64Img = base64_encode(
			file_get_contents(UPLOADS_ROOT . 'cover_picture' . DS . '1' . DS . 'large_' . $fileName)
		);
		$results[1] = [
			'uploadFile' => [
				'cover_picture' => [
					'id' => '1',
					'path' => 'cover_picture',
					'real_file_name' => $fileName,
					'mimetype' => 'image/png',
				],
			],
			'expect' => '<img src="data:image/png;base64,' . $base64Img . '" class="school-cover-picture-fixed-height" alt="" />',
		];

		$fileName = '181x1141.png';
		$base64Img = base64_encode(
			file_get_contents(UPLOADS_ROOT . 'cover_picture' . DS . '1' . DS . 'large_' . $fileName)
		);
		$results[2] = [
			'uploadFile' => [
				'cover_picture' => [
					'id' => '1',
					'path' => 'cover_picture',
					'real_file_name' => $fileName,
					'mimetype' => 'image/png',
				],
			],
			'expect' => '<img src="data:image/png;base64,' . $base64Img . '" alt="" />',
		];

		$fileName = '181x1139.png';
		$base64Img = base64_encode(
			file_get_contents(UPLOADS_ROOT . 'cover_picture' . DS . '1' . DS . 'large_' . $fileName)
		);
		$results[3] = [
			'uploadFile' => [
				'cover_picture' => [
					'id' => '1',
					'path' => 'cover_picture',
					'real_file_name' => $fileName,
					'mimetype' => 'image/png',
				],
			],
			'expect' => '<img src="data:image/png;base64,' . $base64Img . '" class="school-cover-picture-fixed-width" alt="" />',
		];

		return $results;
	}

}
