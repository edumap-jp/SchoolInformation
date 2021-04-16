<?php
/**
 * SchoolInformations Controller
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Your Name <yourname@domain.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('SchoolInformationsAppController', 'SchoolInformations.Controller');
App::uses('NetCommonsTime', 'NetCommons.Utility');
App::uses('SiteBuildMngCommandExec', 'SiteBuildManager.Lib');

/**
 * Class SchoolInformationsController
 *
 * @property SchoolInformation $SchoolInformation
 * @property SchoolInformationFrameSetting $SchoolInformationFrameSetting
 * @property DataTypeChoice $DataTypeChoice
 */
class SchoolInformationsController extends SchoolInformationsAppController {

/**
 * use models
 *
 * @var array
 */
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

/**
 * use helpers
 *
 * @var array
 */
	public $helpers = [
		'SchoolInformations.SchoolInformation',
		'SchoolInformations.SchoolInformationForm',
	];

/**
 * beforeFilter
 *
 * @return void
 */
	public function beforeFilter() {
		// ゲストアクセスOKのアクションを設定
		$this->Auth->allow('view', 'school_badge', 'cover_picture');
		//$this->Categories->initCategories();
		$this->set('schoolTypeOptions', $this->SchoolInformation->getSchoolTypes());
		$this->set('schoolKindOptions', $this->SchoolInformation->getSchoolKinds());
		$this->set('studentCategoryOptions', $this->SchoolInformation->getStudentCategories());
		parent::beforeFilter();
	}

/**
 * view
 *
 * @return void
 */
	public function view() {
		$schoolInformation = $this->SchoolInformation->getSchoolInformation();
		if ($this->request->is('json')) {
			$this->set('schoolInformation', $schoolInformation);
			$this->set('_serialize', ['schoolInformation']);
		} else {
			$layoutPosition = $this->_getLayoutPosition();
			$this->set('layoutPosition', $layoutPosition);

			if ($schoolInformation) {
				$this->set('schoolInformation', $schoolInformation);
				$frameSetting = $this->SchoolInformationFrameSetting
									->getSchoolInformationFrameSetting($this->_getLayoutPosition());
				$this->set('frameSetting', $frameSetting);
				$this->set('prefectureOptions', $this->SchoolInformation->getPrefecture());
				return;
			}

			if (Current::permission('content_editable')) {
				// データない&編集権限ありなら編集ボタン表示
				$this->view = 'SchoolInformations/empty_for_editable';
			} else {
				$this->emptyRender();
			}
		}
	}

/**
 * 登録データをクレンジング
 *
 * @param array $data 登録データ
 * @return array
 */
	private function __cleansingSaveSchoolInformation($data) {
		$NetCommonsTime = new NetCommonsTime();

		if (!empty($data[$this->SchoolInformation->alias]['establish_year_month'])) {
			$datetime = $data[$this->SchoolInformation->alias]['establish_year_month'];
			$data[$this->SchoolInformation->alias]['establish_year_month'] =
					$NetCommonsTime->dateFormat($datetime, 'Y-m');
		}

		if (!empty($data[$this->SchoolInformation->alias]['close_year_month'])) {
			$datetime = $data[$this->SchoolInformation->alias]['close_year_month'];
			$data[$this->SchoolInformation->alias]['close_year_month'] =
					$NetCommonsTime->toUserDatetime($datetime, 'Y-m');
		}

		return $data;
	}

/**
 * edit
 *
 * @return CakeResponse|null
 */
	public function edit() {
		//$this->emptyRender();
		if ($this->request->is('post') || $this->request->is('put')) {
			$data = $this->__cleansingSaveSchoolInformation($this->data);
			//$data['SchoolInformation']['status'] = $this->Workflow->parseStatus();
			//unset($data['SchoolInformation']['id']);

			if ($this->SchoolInformation->saveSchoolInformation($data)) {
				//Rundeckの学校情報更新JOBを実行
				//SiteBuildMngCommandExec::updateSchoolInfo();

				$this->NetCommons->setFlashNotification(
					__d('net_commons', 'Successfully saved.'), array('class' => 'success')
				);
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

		$this->set('prefectureOptions', $this->SchoolInformation->getPrefecture());
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
			$size = 'middle';
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

/**
 * ファイルダウンロード
 *
 * @throws NotFoundException
 * @return mixed
 */
	public function cover_picture() {
		$schoolInformation = $this->SchoolInformation->getSchoolInformation();

		if (!$schoolInformation) {
			throw new NotFoundException();
		}
		// ダウンロード実行
		return $this->Download->doDownload(
			$schoolInformation['SchoolInformation']['id'],
			[
				'field' => 'cover_picture',
				'size' => 'large'
			]
		);
	}

}
