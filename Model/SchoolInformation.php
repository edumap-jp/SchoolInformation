<?php
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
App::uses('SchoolInformationConst', 'SchoolInformations.Model');
App::uses('SchoolInformationCustomValidationTrait', 'SchoolInformations.Model/Validation');
App::uses('SchoolInformationValidationRepositoryTrait', 'SchoolInformations.Model/Validation');
App::uses('SchoolInformationValidationRulesTrait', 'SchoolInformations.Model/Validation');

/**
 * Summary for SchoolInformation Model
 *
 * @property SiteSetting $SiteSetting
 * @property Language $Language
 */
class SchoolInformation extends SchoolInformationsAppModel {

	use SchoolInformationCustomValidationTrait;
	use SchoolInformationValidationRepositoryTrait;
	use SchoolInformationValidationRulesTrait;

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
		return SchoolInformationConst::LOCATION_FIELDS;
	}

/**
 * バリデートメッセージ多言語化対応のためのラップ
 *
 * @param array $options options
 * @return bool
 */
	public function beforeValidate($options = array()) {
		if (isset($this->data[$this->alias]['prefecture_code']) &&
				$this->data[$this->alias]['prefecture_code'] ===
					SchoolInformationConst::FOREIGN_COUNTRY['PREFECTURE_CODE']) {
			$isForeignContry = true;
		} else {
			$isForeignContry = false;
		}

		$this->validate = array_merge(
			$this->validate,
			$this->getValidationRules($isForeignContry)
		);
		return parent::beforeValidate($options);
	}

/**
 * 学校情報取得
 *
 * @return array SchoolInformation data
 */
	public function getSchoolInformation() {
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
 * @throws InternalErrorException
 */
	public function saveSchoolInformation(array $data) {
		$this->loadModels([
			'SiteSetting' => 'SiteManager.SiteSetting',
			'Language' => 'M17n.Language',
		]);

		//トランザクションBegin
		$this->begin();
		$this->create(false);

		//バリデーション
		$schoolInfo = $this->getSchoolInformation();
		if ($schoolInfo) {
			$this->set($schoolInfo);
		}

		$data = $this->cleansingSchoolInformation($data);
		$this->set($data);

		\CakeLog::debug(__METHOD__ . '(' . __LINE__ . ') ' . var_export($this->data, true));

		if (!$this->validates()) {
			return false;
		}

		try {
			//学校情報の登録
			$fieldList = $this->getUpdatableFieldList(CurrentLib::read('User.role_key', ''));
			$schoolInformation = $this->save(null, false, $fieldList);
			if (!$schoolInformation) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}

			//サイト名も更新する
			$this->__updateSiteName($schoolInformation);

			//Meta情報の更新
			$this->updateMetas($schoolInformation);

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
 * @throws InternalErrorException
 */
	private function __updateSiteName($schoolInformation) {
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
 * Meta情報の更新
 *
 * @param array $schoolInformation 学校情報
 * @return void
 */
	public function updateMetas($schoolInformation) {
		$this->loadModels([
			'SiteSetting' => 'SiteManager.SiteSetting',
		]);
		$prefectures = $this->getPrefecture();

		//Meta.description情報の更新
		$this->__updateMetaDescription($schoolInformation, $prefectures);

		//Meta.keywords情報の更新
		$this->__updateMetaKeywords($schoolInformation, $prefectures);

		//Meta.author情報の更新
		$this->__updateMetaAuthor($schoolInformation);
	}

/**
 * Meta.description情報の更新
 *
 * @param array $schoolInformation 学校情報
 * @param array $prefectures 都道府県データ
 * @return void
 */
	private function __updateMetaDescription($schoolInformation, $prefectures) {
		$description = $schoolInformation[$this->alias]['school_name'];

		if ($schoolInformation[$this->alias]['is_public_school_name_kana'] &&
				$schoolInformation[$this->alias]['school_name_kana']) {
			$description .= ', ' . $schoolInformation[$this->alias]['school_name_kana'];
		}

		if ($schoolInformation[$this->alias]['is_public_location']) {
			$location = '';
			if ($schoolInformation[$this->alias]['postal_code']) {
				$location .= __d(
					'school_informations',
					'PostalCode:%s',
					$schoolInformation[$this->alias]['postal_code']
				);
			}

			$location .= __d(
				'school_informations',
				'Adress:%3$s City:%2$s Prefecture:%1$s',
				$prefectures[$schoolInformation[$this->alias]['prefecture_code']] ?? '',
				$schoolInformation[$this->alias]['city'],
				$schoolInformation[$this->alias]['address']
			);

			if (trim($location)) {
				$description .= ', ' . $location;
			}
		}

		$this->__updateSiteSetting('Meta.description', $description);
	}

/**
 * Meta.keywords情報の更新
 *
 * @param array $schoolInformation 学校情報
 * @param array $prefectures 都道府県データ
 * @return void
 */
	private function __updateMetaKeywords($schoolInformation, $prefectures) {
		$keywords = '';

		if ($schoolInformation[$this->alias]['is_public_school_kind'] &&
				$schoolInformation[$this->alias]['school_kind']) {
			$keywords .= $schoolInformation[$this->alias]['school_kind'] . ',';
		}

		if ($schoolInformation[$this->alias]['is_public_school_type'] &&
				$schoolInformation[$this->alias]['school_type']) {
			$keywords .= $schoolInformation[$this->alias]['school_type'] . ',';
		}

		if ($schoolInformation[$this->alias]['is_public_location']) {
			if ($schoolInformation[$this->alias]['city']) {
				$keywords .= $schoolInformation[$this->alias]['city'] . ',';
			}
			if (!empty($prefectures[$schoolInformation[$this->alias]['prefecture_code']])) {
				$keywords .= $prefectures[$schoolInformation[$this->alias]['prefecture_code']] . ',';
			}
		}

		$keywords .= 'edumap,NetCommons';

		$this->__updateSiteSetting('Meta.keywords', $keywords);
	}

/**
 * Meta.author情報の更新
 *
 * @param array $schoolInformation 学校情報
 * @return void
 */
	private function __updateMetaAuthor($schoolInformation) {
		//$author = $schoolInformation[$this->alias]['school_name'];
		$this->__updateSiteSetting('Meta.author', 'edumap');
	}

/**
 * SiteSettinのupdate
 *
 * @param string $key キー
 * @param string $value 値
 * @return void
 */
	private function __updateSiteSetting($key, $value) {
		$db = $this->getDataSource();

		$update = [
			'SiteSetting.value' => $db->value($value, 'string')
		];
		$conditions = [
			'SiteSetting.key' => $key
		];

		$this->SiteSetting->updateAll($update, $conditions);
	}

}
