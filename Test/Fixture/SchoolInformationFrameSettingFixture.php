<?php
/**
 * SchoolInformationFrameSettingFixture
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

/**
 * Summary for SchoolInformationFrameSettingFixture
 */
class SchoolInformationFrameSettingFixture extends CakeTestFixture {

/**
 * Records
 *
 * @var array
 */
	public $records = [
	];

/**
 * Initialize the fixture.
 *
 * @return void
 */
	public function init() {
		$pluginName = 'SchoolInformations';
		require_once App::pluginPath($pluginName) . 'Config' . DS . 'Schema' . DS . 'schema.php';
		$schemaClassName = $pluginName . 'Schema';
		$this->fields = (new $schemaClassName())->tables[Inflector::tableize($this->name)];
		parent::init();
	}

}
