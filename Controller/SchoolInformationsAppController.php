<?php

App::uses('AppController', 'Controller');

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

	protected function _getLayoutPosition() {
		$containerType = (int)Current::read('Box.container_type');
		$layoutPositions = [
			1 => 'header',
			2 => 'major',
			3 => 'main',
			4 => 'minor',
			5 => 'footer'
		];
		return $layoutPositions[$containerType];
	}

}
