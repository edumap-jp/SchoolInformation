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

	public function isDisplayPrincipal() {
		return ($this->isDisplay('principal_name') || $this->isDisplay('principal_name_roma'));
	}

	public function isDisplay($field) {
		if ($this->__isPublic($field) === false) {
			return false;
		}
		if ($this->__isExists($field) === false) {
			return false;
		}
		if ($this->__isDisplayByFrameSetting($field) === false) {
			return false;
		}
		return true;
	}

	private function __isPublic($field) {
		if (in_array($field, SchoolInformation::locationFields(), true)) {
			$field = 'location';
		}
		return (bool)$this->__schoolInformation['SchoolInformation']['is_public_' . $field];
	}

	private function __isExists($field) {
		return (bool)$this->__schoolInformation['SchoolInformation'][$field];
	}

	private function __isDisplayByFrameSetting($field) {
		if (in_array($field, SchoolInformation::locationFields(), true)) {
			$field = 'location';
		}
		return (bool)$this->_View->viewVars['frameSetting']['SchoolInformationFrameSetting']['is_display_' . $field];
	}

	public function isDisplayLocation() {
		if ($this->__isPublic('location') === false) {
			return false;
		}
		if ($this->__isDisplayByFrameSetting('location') === false) {
			return false;
		}
		foreach (SchoolInformation::locationFields() as $field) {
			// 公開で表示ならいずれかの所在地フィールドが入力ずみなら表示
			if ($this->__isExists($field)) {
				return true;
			}
		}
	}

	public function displayLocation() {
		$ret = '';
		$ret .= $this->display(
			'postal_code',
			['format' => __d('school_informations', 'PostalCode: %s')]
		);
		$ret .= __d(
			'school_informations',
			'Adress:%3$s City:%2$s Prefecture:%1$s',
			$this->NetCommonsHtml->tag(
				'span',
				$this->__prefecture(),
				['class' => 'school-information-prefecture']
			),
			$this->display('city', ['tag' => 'span']),
			$this->display('address', ['tag' => 'span'])
		);
		return $ret;
	}

	public function display($field, array $options = []) {
		assert($this->__schoolInformation);

		if ($this->isDisplay($field) === false) {
			return;
		}

		$tag = isset($options['tag']) ? $options['tag'] : 'div';

		$format = isset($options['format']) ? $options['format'] : '%s';

		$tagOptions = [
			'escape' => true,
			'class' => 'school-information-' . $this->__toKebab($field),
		];
		return $this->NetCommonsHtml->tag(
			$tag,
			sprintf($format, $this->__schoolInformation['SchoolInformation'][$field]),
			$tagOptions
		);
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

	private function __prefecture() {
		if ($this->isDisplay('prefecture_code')) {
			return $this->_View->viewVars['prefectureOptions'][$this->__schoolInformation['SchoolInformation']['prefecture_code']];
		}
		return '';
	}
}