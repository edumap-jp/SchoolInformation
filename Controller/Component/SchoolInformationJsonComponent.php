<?php
/**
 * SchoolInformationJsonComponent.php
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('Component', 'Controller');

/**
 * SchoolInformationJsonComponent
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\SchoolInformations\Controller\Component
 */
class SchoolInformationJsonComponent extends Component {

/**
 * コントローラ
 *
 * @var SchoolInformationsController
 */
	private $__controller;

/**
 * URL
 *
 * @var string
 */
	private $__baseUrl;

/**
 * Called before the Controller::beforeFilter().
 *
 * @param Controller $controller Instantiating controller
 * @return void
 */
	public function initialize(Controller $controller) {
		$this->__controller = $controller;
		$this->__baseUrl = Configure::read('App.fullBaseUrl');
	}

/**
 * JSON出力用に変換する
 *
 * @param array $schoolInformation 学校情報
 * @return array
 */
	public function convert(array $schoolInformation) {
		$convSchoolInfo = [];

		foreach ($schoolInformation['SchoolInformation'] as $field => $value) {
			if (is_null($value) ||
					$value === '') {
				continue;
			}

			$this->__setDefaultField(
				$convSchoolInfo, $schoolInformation['SchoolInformation'], $field, $value
			);

			//school_nameの前に校章、カバー写真のURLをセットする
			if ($field === 'school_name') {
				$uploadFile = $schoolInformation['UploadFile'] ?? [];
				$this->__setSchoolBadge($convSchoolInfo, $uploadFile);
				$this->__setCoverPicture($convSchoolInfo, $uploadFile);
			}

			//県コードの場合、県名をセットする
			if ($field === 'prefecture_code') {
				$this->__setPrefectureName($convSchoolInfo, $value);
			}
		}

		return $convSchoolInfo;
	}

/**
 * 校章を戻り値にセットする
 *
 * @param array &$result セットする戻り値配列
 * @param array $schoolInformation 学校情報データ
 * @param string $field 公開状態カラム名
 * @param string|bool|int $value 値
 * @return void
 */
	private function __setDefaultField(
			array &$result, array $schoolInformation, string $field, $value) {
		$isPubicField = 'is_public_' . $field;
		if (array_key_exists($isPubicField, $schoolInformation)) {
			if ($schoolInformation[$isPubicField]) {
				$result[$field] = $value;
			}
		} else {
			$result[$field] = $value;
		}
	}

/**
 * 校章を戻り値にセットする
 *
 * @param array &$result セットする戻り値配列
 * @param array $uploadFile Uploadデータ
 * @return void
 */
	private function __setSchoolBadge(array &$result, array $uploadFile) {
		if (isset($uploadFile['school_badge'])) {
			$fileName = 'school_badge.' . $uploadFile['school_badge']['extension'];
			$result['school_badge'] =
					$this->__baseUrl . '/school_informations/school_informations/' . $fileName;
		}
	}

/**
 * カバー写真を戻り値にセットする
 *
 * @param array &$result セットする戻り値配列
 * @param array $uploadFile Uploadデータ
 * @return void
 */
	private function __setCoverPicture(array &$result, array $uploadFile) {
		if (isset($uploadFile['cover_picture'])) {
			$fileName = 'cover_picture.' . $uploadFile['cover_picture']['extension'];
			$result['cover_picture'] =
					$this->__baseUrl . '/school_informations/school_informations/' . $fileName;
		}
	}

/**
 * 県名を戻り値にセットする
 *
 * @param array &$result セットする戻り値配列
 * @param string $prefectureCode 県コード
 * @return void
 */
	private function __setPrefectureName(array &$result, string $prefectureCode) {
		$prefectures = $this->__controller->SchoolInformation->getPrefecture();
		if (isset($prefectures[$prefectureCode])) {
			$result['prefecture'] = $prefectures[$prefectureCode];
		}
	}

}
