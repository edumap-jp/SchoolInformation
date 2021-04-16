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

App::uses('AppController', 'Controller');

/**
 * SchoolInformationsAppController Controller
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\SchoolInformations\Controller
 */
class SchoolInformationsAppController extends AppController {

/**
 * use components
 *
 * @var array
 */
	public $components = array(
		//'NetCommons.NetCommonsBlock',
		//'NetCommons.NetCommonsFrame',
		'Pages.PageLayout',
		'Security',
	);

/**
 * レイアウト位置キー
 *
 * @return string
 */
	protected function _getLayoutPosition() {
		$containerType = (int)Current::read('Box.container_type');
		$layoutPositions = [
			0 => 'main', // default
			1 => 'header',
			2 => 'major',
			3 => 'main',
			4 => 'minor',
			5 => 'footer'
		];
		return $layoutPositions[$containerType];
	}

}
