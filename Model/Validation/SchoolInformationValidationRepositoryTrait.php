<?php
/**
 * SchoolInformationValidationRepository.php
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('SchoolInformationConst', 'SchoolInformations.Model');

/**
 * SchoolInformationValidationRepository
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\SchoolInformations\Model\Validation
 */
trait SchoolInformationValidationRepositoryTrait {

/**
 * バリデーションルールを返す
 *
 * @return array
 */
	public function getValidationRules() {
		$validate = array(
			'school_name' => array(
				'notBlank' => [
					'rule' => array('notBlank'),
					'message' => sprintf(
						__d('net_commons', 'Please input %s.'),
						__d('school_informations', 'School Name')
					),
					//'allowEmpty' => false,
					'required' => true,
				],
			),

			'status' => array(
				'numeric' => array(
					'rule' => array('numeric'),
					//'message' => 'Your custom message here',
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
			'is_auto_translated' => array(
				'boolean' => array(
					'rule' => array('boolean'),
					//'message' => 'Your custom message here',
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
			'map_url' => array(
				'google_map' => array(
					'rule' => array('matchMapUrl'),
					'message' => __d(
						'net_commons',
						'Unauthorized pattern for %s.',
						__d('school_informations', 'Map Url')
					),
					'allowEmpty' => true,
					'required' => false,
				),
			),
		);
		return $validate;
	}

/**
 * 登録データをクレンジング
 *
 * @param array $data 登録データ
 * @return array
 */
	public function cleansingSchoolInformation(array $data) {
		foreach (SchoolInformationConst::CONV_NULL_IF_EMPTY_FIELDS as $key) {
			if (array_key_exists($key, $data[$this->alias]) &&
					$data[$this->alias][$key] === '') {
				$data[$this->alias][$key] = null;
			}
		}
		if (!empty($data[$this->alias]['map_url'])) {
			$data[$this->alias]['map_url'] =
					$this->__cleansingMapUrl($data[$this->alias]['map_url']);
		}

		if (!empty($data[$this->alias]['school_name_kana'])) {
			$data[$this->alias]['school_name_kana'] =
					mb_convert_kana($data[$this->alias]['school_name_kana'], 'KVAs');
		}

		//海外の場合、郵便番号区市町村コード・区市町村を上書きする
		if (!empty($data[$this->alias]['prefecture_code']) &&
				$data[$this->alias]['prefecture_code'] ===
					SchoolInformationConst::FOREIGN_COUNTRY['PREFECTURE_CODE']) {
			$data[$this->alias]['postal_code'] =
					SchoolInformationConst::FOREIGN_COUNTRY['POSTAL_CODE'];
			$data[$this->alias]['city_code'] =
					SchoolInformationConst::FOREIGN_COUNTRY['CITY_CODE'];
			$data[$this->alias]['city'] = '';
		}

		return $data;
	}

/**
 * 地図URLをクレンジング(iframeタグ等を取り除く)
 *
 * @param string $mapUrl 地図URL
 * @return string
 */
	private function __cleansingMapUrl(string $mapUrl) {
		$match = [];
		if (is_string($mapUrl) &&
				preg_match('/src="(.+)?"/', $mapUrl, $match)) {
			$mapUrl = $match[1];
		}
		return $mapUrl;
	}

/**
 * 国公立種別のリストを返す
 *
 * @return array
 */
	public function getSchoolTypes() {
		return [
			'公立' => __d('school_informations', '公立'),
			'国立' => __d('school_informations', '国立'),
			'私立' => __d('school_informations', '私立'),
		];
	}

/**
 * 校種のリストを返す
 *
 * @return array
 */
	public function getSchoolKinds() {
		return [
			'小学校' => __d('school_informations', '小学校'),
			'中学校' => __d('school_informations', '中学校'),
			'小中一貫校・義務教育学校' =>
					__d('school_informations', '小中一貫校・義務教育学校'),
			'高等学校' => __d('school_informations', '高等学校'),
			'中等教育学校' => __d('school_informations', '中等教育学校'),
			'特別支援学校' => __d('school_informations', '特別支援学校'),
			'各種学校（インターナショナルスクール等）' =>
					__d('school_informations', '各種学校（インターナショナルスクール等）'),
			'幼稚園' => __d('school_informations', '幼稚園'),
			'保育園' => __d('school_informations', '保育園'),
			'認定こども園' => __d('school_informations', '認定こども園'),
		];
	}

/**
 * 学生種別のリストを返す
 *
 * @return array
 */
	public function getStudentCategories() {
		return [
			'共学' => __d('school_informations', '共学'),
			'男子校' => __d('school_informations', '男子校'),
			'女子校' => __d('school_informations', '女子校'),
		];
	}

/**
 * 都道府県データ取得
 *
 * @return array
 */
	public function getPrefecture() {
		/** @var \DataTypeChoice $DataTypeChoice */
		$DataTypeChoice = \ClassRegistry::init('DataTypes.DataTypeChoice');

		$options = [
			'conditions' => [
				'data_type_key' => 'prefecture',
				'language_id' => \Current::read('Language.id', '2'),
			],
			'order' => 'DataTypeChoice.weight ASC',
			'fields' => ['DataTypeChoice.code', 'DataTypeChoice.name']
		];
		$prefectures = $DataTypeChoice->cacheFindQuery('all', $options);

		$options = [];
		foreach ($prefectures as $prefecture) {
			$code = $prefecture['DataTypeChoice']['code'];
			$name = $prefecture['DataTypeChoice']['name'];
			$options[$code] = $name;
		}

		//海外を追加
		$options[SchoolInformationConst::FOREIGN_COUNTRY['PREFECTURE_CODE']] =
								SchoolInformationConst::FOREIGN_COUNTRY['NAME'];

		return $options;
	}
}
