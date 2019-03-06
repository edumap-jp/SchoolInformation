<?php
/**
 * SchoolInformation Test Case
 *
* @author Noriko Arai <arai@nii.ac.jp>
* @author Your Name <yourname@domain.com>
* @link http://www.netcommons.org NetCommons Project
* @license http://www.netcommons.org/license.txt NetCommons License
* @copyright Copyright 2014, NetCommons Project
 */

App::uses('SchoolInformation', 'SchoolInformations.Model');

/**
 * Summary for SchoolInformation Test Case
 */
class SchoolInformationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.school_informations.school_information',
		'plugin.school_informations.language',
		'plugin.school_informations.user',
		'plugin.school_informations.role',
		'plugin.school_informations.user_role_setting',
		'plugin.school_informations.users_language'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SchoolInformation = ClassRegistry::init('SchoolInformations.SchoolInformation');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SchoolInformation);

		parent::tearDown();
	}

}
