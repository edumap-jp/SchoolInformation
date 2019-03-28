<?php
App::uses('SchoolInformationsAppController', 'SchoolInformations.Controller');
/**
 * SchoolInformations Controller
 *
 *
* @author Noriko Arai <arai@nii.ac.jp>
* @author Your Name <yourname@domain.com>
* @link http://www.netcommons.org NetCommons Project
* @license http://www.netcommons.org/license.txt NetCommons License
* @copyright Copyright 2014, NetCommons Project
 */

/**
 * Class SchoolInformationsController
 *
 * @property SchoolInformation $SchoolInformation
 * @property SchoolInformationFrameSetting $SchoolInformationFrameSetting
 * @property DataTypeChoice $DataTypeChoice
 */
class SchoolInformationsController extends SchoolInformationsAppController {

	public $uses = [
		'SchoolInformations.SchoolInformation',
		'SchoolInformations.SchoolInformationFrameSetting',

		'DataTypes.DataTypeChoice',
	];

	/**
	 * use components
	 *
	 * @var array
	 */
	public $components = array(
		'NetCommons.Permission' => array(
			//アクセスの権限
			'allow' => array(
				'edit' => 'content_editable',
			),
		),
		'Files.Download'
	);

	//public $helpers = [
	//	'Workflow.Workflow'
	//];

	/**
	 * beforeFilter
	 *
	 * @return void
	 */
	public function beforeFilter() {
		// ゲストアクセスOKのアクションを設定
		$this->Auth->allow('view', 'school_badge');
		//$this->Categories->initCategories();
		$this->set('schoolTypeOptions', $this->SchoolInformation->schoolTypes());
		$this->set('schoolKindOptions', $this->SchoolInformation->schoolKinds());
		$this->set('studentCategoryOptions', $this->SchoolInformation->studentCategories());
		parent::beforeFilter();
	}



	public function view() {
		//
		$layoutPosition = $this->_getLayoutPosition();
		$this->set('layoutPosition', $layoutPosition);

		$schoolInformation = $this->SchoolInformation->getSchoolInformation();
		if ($schoolInformation) {
			$this->set('schoolInformation', $schoolInformation);
			$frameSetting = $this->SchoolInformationFrameSetting->getSchoolInformationFrameSetting($this->_getLayoutPosition());
			$this->set('frameSetting', $frameSetting);
			$this->set('prefectureOptions', $this->__getPrefectureOptions());

			return;
		}
		if (Current::permission('content_editable')) {
			// データない&編集権限ありなら編集ボタン表示
			$this->view = 'SchoolInformations/empty_for_editable';
		} else {
			$this->emptyRender();
		}
	}

	/**
	 * TODO edit
	 *
	 * @return CakeResponse|null
	 */
	public function edit() {
		//$this->emptyRender();
		if ($this->request->is('post') || $this->request->is('put')) {
			$data = $this->data;
			//$data['SchoolInformation']['status'] = $this->Workflow->parseStatus();
			//unset($data['SchoolInformation']['id']);

			if ($this->SchoolInformation->saveSchoolInformation($data)) {
				return $this->redirect(NetCommonsUrl::backToPageUrl());
			}
			$this->NetCommons->handleValidationError($this->SchoolInformation->validationErrors);

		} else {
			//初期データセット
			if (! $this->request->data = $this->SchoolInformation->getSchoolInformation()) {
				$this->request->data = $this->SchoolInformation->createAll();
			}
			//$this->request->data['SchoolInformation']['establish_year_month'] = '2000-01';
			$this->request->data['Frame'] = Current::read('Frame');
		}

		$this->set('prefectureOptions', $this->__getPrefectureOptions());
		//$comments = $this->SchoolInformation->getCommentsByContentKey(
		//	$this->request->data['SchoolInformation']['key']
		//);
		//$this->set('comments', $comments);

	}

	/**
	 * ファイルダウンロード
	 *
	 * @throws NotFoundException
	 * @return mixed
	 */
	public function school_badge() {
		$schoolInformation = $this->SchoolInformation->getSchoolInformation();

		if (!$schoolInformation) {
			throw new NotFoundException();
		}
		$size = $this->request->query('size');
		if (!$size) {
			$size = 'main';
		}
		// ダウンロード実行
		return $this->Download->doDownload(
			$schoolInformation['SchoolInformation']['id'],
			[
				'field' => 'school_badge',
				'size' => $size
			]
		);
	}

	private function __getPrefectureOptions() {
		$options = [
			'conditions' => [
				'data_type_key' => 'prefecture',
				'language_id' => Current::read('Language.id'),
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

}
