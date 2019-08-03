<?php /** @noinspection ALL */
/**
 * SchoolInformation Model
 *
 * @property Language $Language
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Your Name <yourname@domain.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('SchoolInformationsAppModel', 'SchoolInformations.Model');

/**
 * Summary for SchoolInformation Model
 *
 * @property SiteSetting $SiteSetting
 * @property Language $Language
 */
class SchoolInformation extends SchoolInformationsAppModel {

/**
 * 所在地のカラムリスト
 *
 * @var array
 */
	const LOCATION_FIELDS = [
		'postal_code',
		'prefecture_code',
		'city_code',
		'city',
		'address'
	];

/**
 * 空値の場合、nullに変換するカラムリスト
 *
 * @var array
 */
	const CONV_NULL_IF_EMPTY_FIELDS = [
		'seismic_work',
		'designation_of_shelter',
	];

/**
 * 地図URL
 *
 * @var string
 */
	const MAP_URL = 'https://www.google.com/maps/embed';

/**
 * use behaviors
 *
 * @var array
 */
	public $actsAs = array(
		'NetCommons.OriginalKey',
		//'Workflow.WorkflowComment',
		//'Workflow.Workflow',
		'Wysiwyg.Wysiwyg' => array(
			'fields' => array('contact_information'),
		),
		'M17n.M17n', //多言語
		'Files.Attachment' => [
			'school_badge' => [
				'thumbnailSizes' => [
					'large' => '200h',
					'middle' => '120h',
					'small' => '60h',
					//'main' => '60h',
					//'small' => '36h'
				]
			],
			'cover_picture' => [
				'thumbnailSizes' => [
					'large' => '1200w',
					//'main' => '60h',
					//'small' => '36h'
				]
			]
		],
	);

/**
 * 所在地のカラムリストを返す
 *
 * @return array
 */
	public static function locationFields() {
		return self::LOCATION_FIELDS;
	}

/**
 * バリデートメッセージ多言語化対応のためのラップ
 *
 * @param array $options options
 * @return bool
 */
	public function beforeValidate($options = array()) {
		$this->validate = array_merge(
			$this->validate,
			$this->__getValidateSpecification()
		);
		return parent::beforeValidate($options);
	}

/**
 * バリデーションルールを返す
 *
 * @return array
 */
	private function __getValidateSpecification() {
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
					'rule' => array('validateMapUrl'),
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
 * 学校情報取得
 *
 * @return array SchoolInformation data
 */
	public function getSchoolInformation() {
		// TODO 条件必用であれば追加
		$options = [];
		//$conditions = $this->getWorkflowConditions();
		//$options['conditions'] = $conditions;
		$data = $this->find('first', $options);
		return $data;
	}

/**
 * 学校情報登録
 *
 * @param array $data 登録データ
 * @return array SchoolInformation data
 */
	public function saveSchoolInformation(array $data) {
		$this->loadModels([
			'SiteSetting' => 'SiteManager.SiteSetting',
			'Language' => 'M17n.Language',
		]);

		//トランザクションBegin
		$this->begin();
		$this->create();

		//バリデーション
		$data = $this->cleansingSaveSchoolInformation($data);
		$this->set($data);
		if (!$this->validates()) {
			return false;
		}

		try {
			//学校情報の登録
			$schoolInformation = $this->save(null, false);
			if (!$schoolInformation) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}

			//サイト名も更新する
			$this->__updateSiteName($schoolInformation);

			$this->SiteSetting->cacheClear();

			//トランザクションCommit
			$this->commit();

		} catch (Exception $ex) {
			//トランザクションRollback
			$this->rollback($ex);
		}

		return $schoolInformation;
	}

/**
 * サイト名を更新
 *
 * @param array $schoolInformation 学校情報
 * @return void
 */
	public function __updateSiteName($schoolInformation) {
		//サイト名も更新する
		$languages = $this->Language->find('all', [
			'recursive' => -1,
			'fields' => ['id', 'code'],
		]);
		$langIds = [];
		foreach ($languages as $lang) {
			$langIds[$lang['Language']['code']] = $lang['Language']['id'];
		}

		$siteSettings = $this->SiteSetting->getSiteSettingForEdit([
			'SiteSetting.key' => [
				//サイト名
				'App.site_name',
			]
		]);

		$schoolName = $schoolInformation[$this->alias]['school_name'];
		$siteSettings['App.site_name'][$langIds['ja']]['value'] = $schoolName;
		if (!empty($schoolInformation[$this->alias]['school_name_roma'])) {
			$siteSettings['App.site_name'][$langIds['en']]['value'] =
							$schoolInformation[$this->alias]['school_name_roma'];
		} else {
			$siteSettings['App.site_name'][$langIds['en']]['value'] = $schoolName;
		}

		foreach ($siteSettings['App.site_name'] as $saveData) {
			$this->SiteSetting->create();
			if (! $this->SiteSetting->save($saveData, ['callbacks' => false])) {
				CakeLog::error(var_export($this->SiteSetting->validationErrors, true));
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}
		}
	}

/**
 * 都道府県データ取得
 *
 * @return array
 */
	public function getPrefectureOptions() {
		$this->DataTypeChoice = ClassRegistry::init('DataTypes.DataTypeChoice');

		$options = [
			'conditions' => [
				'data_type_key' => 'prefecture',
				'language_id' => Current::read('Language.id', '2'),
			],
			'order' => 'DataTypeChoice.weight ASC',
			'fields' => ['DataTypeChoice.code', 'DataTypeChoice.name']
		];
		$prefectures = $this->DataTypeChoice->find('all', $options);

		$options = [];
		foreach ($prefectures as $prefecture) {
			$code = $prefecture['DataTypeChoice']['code'];
			$name = $prefecture['DataTypeChoice']['name'];
			$options[$code] = $name;
		}
		return $options;
	}

/**
 * 登録データをクレンジング
 *
 * @param array $data 登録データ
 * @return array
 */
	public function cleansingSaveSchoolInformation($data) {
		foreach (self::CONV_NULL_IF_EMPTY_FIELDS as $key) {
			if (array_key_exists($key, $data[$this->alias]) &&
					$data[$this->alias][$key] === '') {
				$data[$this->alias][$key] = null;
			}
		}
		if (!empty($data[$this->alias]['map_url'])) {
			$data[$this->alias]['map_url'] =
					$this->cleansingMapUrl($data[$this->alias]['map_url']);
		}

		if (!empty($data[$this->alias]['school_name_kana'])) {
			$data[$this->alias]['school_name_kana'] =
					mb_convert_kana($data[$this->alias]['school_name_kana'], 'KVAs');
		}

		return $data;
	}

/**
 * 地図URLをクレンジング(iframeタグ等を取り除く)
 *
 * @param string $mapUrl 地図URL
 * @return string
 */
	public function cleansingMapUrl($mapUrl) {
		$match = [];
		if (is_string($mapUrl) &&
				preg_match('/src="(.+)?"/', $mapUrl, $match)) {
			$mapUrl = $match[1];
		}
		return $mapUrl;
	}

/**
 * 地図URLのバリデーション
 *
 * @param array $check チェック値
 * @return bool
 */
	public function validateMapUrl($check) {
		$value = array_shift($check);
		if (is_string($value)) {
			return (bool)preg_match('/^' . preg_quote(self::MAP_URL, '/') . '/', $value);
		} else {
			return false;
		}
	}

/**
 * 国公立種別のリストを返す
 *
 * @return array
 */
	public function schoolTypes() {
		return [
			'国立' => __d('school_informations', '国立'),
			'公立' => __d('school_informations', '公立'),
			'私立' => __d('school_informations', '私立')
		];
	}

/**
 * 校種のリストを返す
 *
 * @return array
 */
	public function schoolKinds() {
		return [
			'幼稚園' => __d('school_informations', '幼稚園'),
			'保育園' => __d('school_informations', '保育園'),
			'小学校' => __d('school_informations', '小学校'),
			'中学校' => __d('school_informations', '中学校'),
			'高等学校' => __d('school_informations', '高等学校'),
			'中等教育学校' => __d('school_informations', '中等教育学校'),
			'小中一貫校' => __d('school_informations', '小中一貫校')
		];
	}

/**
 * 学生種別のリストを返す
 *
 * @return array
 */
	public function studentCategories() {
		return [
			'男子校' => __d('school_informations', '男子校'),
			'女子校' => __d('school_informations', '女子校'),
			'共学' => __d('school_informations', '共学')
		];
	}
}
