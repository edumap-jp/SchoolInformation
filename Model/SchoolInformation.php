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

	private static $locationFields = [
		'postal_code',
		'prefecture_code',
		'city',
		'address'
	];
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

	public static function locationFields() {
		return self::$locationFields;
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
		);
		return $validate;
	}

	/**
	 * TODO getSchoolInformation
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

	public function saveSchoolInformation(array $data) {
		$this->loadModels([
			'SiteSetting' => 'SiteManager.SiteSetting',
			'Language' => 'M17n.Language',
		]);

		//トランザクションBegin
		$this->begin();

		//バリデーション
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
			$this->SiteSetting->cacheClear();

			//トランザクションCommit
			$this->commit();

		} catch (Exception $ex) {
			//トランザクションRollback
			$this->rollback($ex);
		}

		return $schoolInformation;
	}

	public function schoolTypes() {
		return [
			'国立' => __d('school_informations', '国立'),
			'公立' => __d('school_informations', '公立'),
			'私立' => __d('school_informations', '私立')
		];
	}
	public function schoolKinds() {
		return [
			'小学校' => __d('school_informations', '小学校'),
			'中学校' => __d('school_informations', '中学校'),
			'高等学校' => __d('school_informations', '高等学校'),
			'中等教育学校' => __d('school_informations', '中等教育学校'),
			'小中一貫校' => __d('school_informations', '小中一貫校')
		];
	}
	public function studentCategories() {
		return [
			'男子校' => __d('school_informations', '男子校'),
			'女子校' => __d('school_informations', '女子校'),
			'共学' => __d('school_informations', '共学')
		];
	}
}
