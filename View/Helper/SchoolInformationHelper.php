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

	public function schoolBadge($size) {
		if (isset($this->__schoolInformation['UploadFile']['school_badge']['id'])) {
			return $this->NetCommonsHtml->image(
				'/school_informations/school_informations/school_badge?size=' . $size
			);
		}
		// デフォルトロゴ
		// HACK: SchoolInformationモデルから参照するほうが良い
		$height = [
			'small' => 60,
			'middle' => 120,
			'large' => 200
		];
		return $this->NetCommonsHtml->image(
			'/school_informations/img/no_badge.png',
			['style' => 'height:' . $height[$size] . 'px']
		);
	}

	public function displayPrincipal() {
		if ($this->isDisplayPrincipal() === false) {
			return '';
		}
		return $this->NetCommonsHtml->tag(
			'ruby',
			$this->display('principal_name') . $this->display(
				'principal_name_roma',
				['tag' => 'rt']
			)
		);
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

	public function display($field, array $options = []) {
		assert($this->__schoolInformation);

		if ($this->isDisplay($field) === false) {
			return '';
		}

		$tag = isset($options['tag']) ? $options['tag'] : 'div';

		$format = isset($options['format']) ? $options['format'] : '%s';

		$tagOptions = [
			'class' => 'school-information-record-item school-information-' . $this->__toKebab($field),
		];

		$formattedText = $this->__formatValue($field, $format);

		$label = '';
		if (isset($options['displayLabel']) && $options['displayLabel']) {
			$labelText = __d('school_informations', Inflector::humanize($field));
			$label = $this->label($field, $labelText);
		}

		return $this->NetCommonsHtml->tag(
			$tag,
			$label . $formattedText,
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

	/**
	 * __formatValue
	 *
	 * @param $field
	 * @param $format
	 * @return string
	 */
	private function __formatValue($field, $format) {
		$formatMethod = '__format' . ucfirst(Inflector::camelize($field));
		if (method_exists($this, $formatMethod)) {
			return call_user_func([$this, $formatMethod]);
		}


		if (strpos($field, 'year_month') !== false) {
			$formattedText = $this->__formatYearMont($field);
			return $formattedText;
		}
		if (strpos($field, 'url') !== false) {
			return $this->__formatUrl($field);
		}
		$formattedText = $this->__formatDefault($field, $format);
		return $formattedText;
	}

	public function __formatSchoolType() {
		$value = $this->__schoolInformation['SchoolInformation']['school_type'];
		return $this->_View->viewVars['schoolTypeOptions'][$value];
	}
	public function __formatSchoolKind() {
		$value = $this->__schoolInformation['SchoolInformation']['school_kind'];
		return $this->_View->viewVars['schoolKindOptions'][$value];
	}
	public function __formatStudentCategory() {
		$value = $this->__schoolInformation['SchoolInformation']['student_category'];
		return $this->_View->viewVars['studentCategoryOptions'][$value];
	}

	/**
	 * __formatYearMont
	 *
	 * @param $field
	 * @return mixed
	 */
	private function __formatYearMont($field) {
		list($year, $month) = explode(
			'-',
			$this->__schoolInformation['SchoolInformation'][$field]
		);
		$formattedText = __d('school_informations', '%2$d/%1$d', $year, $month);
		return h($formattedText);
	}

	private function __formatUrl($field) {
		return $this->NetCommonsHtml->link(
			$this->__schoolInformation['SchoolInformation'][$field],
			$this->__schoolInformation['SchoolInformation'][$field],
			[
				'target' => '_blank'
			]
		);
	}

	/**
	 * __formatDefault
	 *
	 * @param $field
	 * @param $format
	 * @return string
	 */
	private function __formatDefault($field, $format) {
		$formattedText = sprintf(
			$format,
			$this->__schoolInformation['SchoolInformation'][$field]
		);
		return h($formattedText);
	}

	/**
	 * label
	 *
	 * @param $field
	 * @param $labelText
	 * @return mixed
	 */
	public function label($field, $labelText) {
		$labelClassName = 'school-information-label school-information-' . $this->__toKebab(
				$field
			) . '-label';
		$label = $this->NetCommonsHtml->tag('span', $labelText, ['class' => $labelClassName]);
		return $label;
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
			['format' => __d('school_informations', 'PostalCode:%s'), 'tag' => 'span']
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
		return $this->NetCommonsHtml->tag('div', $ret, ['class' => 'school-information-location']);
	}

	private function __prefecture() {
		if ($this->isDisplay('prefecture_code')) {
			return $this->_View->viewVars['prefectureOptions'][$this->__schoolInformation['SchoolInformation']['prefecture_code']];
		}
		return '';
	}
}