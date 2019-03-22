<?php
/**
 * SchoolInformationHelper.php
 *
 * @author   Ryuji AMANO <ryuji@ryus.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
App::uses('AppHelper', 'View');

/**
 * Class SchoolInformationHelper
 */
class SchoolInformationHelper extends AppHelper {

	public $helpers = [
		'NetCommons.NetCommonsHtml'
	];

	private $__schoolInformation;

	public function set(array $schoolInformation) {
		$this->__schoolInformation = $schoolInformation;
	}

	public function display($field, array $options =[]) {
		assert($this->__schoolInformation);

		if ($this->isDisplay($field) === false) {
			return;
		}

		$tag = isset($options['tag']) ? $options['tag'] : 'div';

		$tagOptions = [
			'escape' => true,
			'class' => 'school-information-' . $this->__toKebab($field),
		];
		echo $this->NetCommonsHtml->tag(
			$tag,
			$this->__schoolInformation['SchoolInformation'][$field],
			$tagOptions
		);
	}

	public function isDisplay($field) {
		if ($this->__isPublic($field) === false) {
			return false;
		}
		if ($this->__isExists($field) === false) {
			return false;
		}
		return true;
	}

	private function __isPublic($field) {
		return (bool) $this->__schoolInformation['SchoolInformation']['is_public_' . $field];
	}

	private function __isExists($field) {
		return (bool) $this->__schoolInformation['SchoolInformation'][$field];
	}

	/**
	 * __toKebab
	 *
	 * @param string $field snake_case
	 * @return string kebab-style
	 */
	private function __toKebab($field) {
		return str_replace('_', '-', $field);
	}
}