<?php
/**
 * SchoolInformationFrameSettings Controller
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('SchoolInformationsAppController', 'SchoolInformations.Controller');

/**
 * SchoolInformationFrameSettings Controller
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\SchoolInformations\Controller
 */
class SchoolInformationFrameSettingsController extends SchoolInformationsAppController {

/**
 * layout
 *
 * @var array
 */
	public $layout = 'NetCommons.setting';

/**
 * use models
 *
 * @var array
 */
	public $uses = array(
		'SchoolInformations.SchoolInformationFrameSetting',
	);

/**
 * use components
 *
 * @var array
 */
	public $components = array(
		'NetCommons.Permission' => array(
			//アクセスの権限
			'allow' => array(
				'edit' => 'page_editable',
			),
		),
	);

/**
 * use helpers
 *
 * @var array
 */
	public $helpers = array(
		'Blocks.BlockTabs' => array(
			'mainTabs' => array(
				'frame_settings' => array('url' => array('controller' => 'SchoolInformation_frame_settings')),
			),
			//'blockTabs' => array(
			//	'block_settings' => array('url' => array('controller' => 'SchoolInformation_blocks')),
			//	'role_permissions' => array('url' => array('controller' => 'SchoolInformation_block_role_permissions')),
			//),
		),
		//'NetCommons.DisplayNumber',
	);

/**
 * edit
 *
 * @return void
 */
	public function edit() {
		if ($this->request->is('put') || $this->request->is('post')) {
			if ($this->SchoolInformationFrameSetting->saveSchoolInformationFrameSetting($this->data)) {
				return $this->redirect(NetCommonsUrl::backToPageUrl(true));
			} else {
				return $this->throwBadRequest();
			}

		} else {
			$this->request->data = $this->SchoolInformationFrameSetting->getSchoolInformationFrameSetting($this->_getLayoutPosition());
			$this->request->data['Frame'] = Current::read('Frame');
		}
	}
}
