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
 */
class SchoolInformationsController extends SchoolInformationsAppController {

	public $uses = [
		'SchoolInformations.SchoolInformation',
		'SchoolInformations.SchoolInformationFrameSetting',
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
		parent::beforeFilter();
	}



	public function view() {
		$schoolInformation = $this->SchoolInformation->getSchoolInformation();
		if ($schoolInformation) {
			$this->set('schoolInformation', $schoolInformation);
			$frameSetting = $this->SchoolInformationFrameSetting->getSchoolInformationFrameSetting();
			$this->set('frameSetting', $frameSetting);
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
			$this->request->data['Frame'] = Current::read('Frame');
		}

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
}
