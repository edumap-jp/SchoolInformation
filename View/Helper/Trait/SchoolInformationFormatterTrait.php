<?php
/**
 * SchoolInformationFormatterTrait.php
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('SchoolInformationConst', 'SchoolInformations.Model');

/**
 * SchoolInformationFormatterTrait
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\SchoolInformations\Veiw\Helper\Trait
 */
trait SchoolInformationFormatterTrait {

/**
 * 各項目の整形処理
 *
 * @param string $field 項目名
 * @param string $format フォーマット
 * @return string
 */
	protected function _formatValue($field, $format) {
		if (strpos($field, 'year_month') !== false) {
			$formattedText = $this->_formatYearMont($field);
			return $formattedText;
		}
		if (strpos($field, 'url') !== false) {
			return $this->_formatUrl($field);
		}

		$formatMethod = '_format' . ucfirst(Inflector::camelize($field));
		if (method_exists($this, $formatMethod)) {
			return call_user_func([$this, $formatMethod]);
		}

		$formattedText = $this->_formatDefault($field, $format);
		return $formattedText;
	}

/**
 * 国公立種別の整形処理
 *
 * @return string
 */
	protected function _formatSchoolType() {
		$value = $this->_schoolInformation['SchoolInformation']['school_type'];
		return $this->_View->viewVars['schoolTypeOptions'][$value];
	}

/**
 * 校種の整形処理
 *
 * @return string
 */
	protected function _formatSchoolKind() {
		$value = $this->_schoolInformation['SchoolInformation']['school_kind'];
		return $this->_View->viewVars['schoolKindOptions'][$value];
	}

/**
 * 学生種別の整形処理
 *
 * @return string
 */
	protected function _formatStudentCategory() {
		$value = $this->_schoolInformation['SchoolInformation']['student_category'];
		return $this->_View->viewVars['studentCategoryOptions'][$value];
	}

/**
 * 年月の整形処理
 *
 * @param string $field 項目名
 * @return string
 */
	protected function _formatYearMont($field) {
		list($year, $month) = explode(
			'-',
			$this->_schoolInformation['SchoolInformation'][$field]
		);
		$formattedText = __d('school_informations', '%2$d/%1$d', $year, $month);
		return h($formattedText);
	}

/**
 * URLの整形処理
 *
 * @param string $field 項目名
 * @return string
 */
	protected function _formatUrl($field) {
		return $this->NetCommonsHtml->link(
			$this->_schoolInformation['SchoolInformation'][$field],
			$this->_schoolInformation['SchoolInformation'][$field],
			[
				'target' => '_blank'
			]
		);
	}

/**
 * Emailの整形処理
 *
 * @return string
 */
	protected function _formatEmail() {
		$value = $this->_schoolInformation['SchoolInformation']['email'];
		list($local, $domain) = explode('@', $value);
		return
			h($local) . $this->NetCommonsHtml->image('/school_informations/img/mailmark.gif') . h($domain);
	}

/**
 * 学生種別の整形処理
 *
 * @return string
 */
	protected function _formatPostalCode() {
		$prefectureCode = $this->_schoolInformation['SchoolInformation']['prefecture_code'];
		if ($prefectureCode === SchoolInformationConst::FOREIGN_COUNTRY['PREFECTURE_CODE']) {
			return '';
		}
		$value = $this->_schoolInformation['SchoolInformation']['postal_code'];
		if (preg_match('/^[0-9]+$/', $value)) {
			$value = substr($value, 0, 3) . '-' . substr($value, -4);
		}
		return h(__d('school_informations', 'PostalCode:%s', $value));
	}

/**
 * デフォルトの整形処理
 *
 * @param string $field 項目名
 * @param string $format フォーマット
 * @return string
 */
	protected function _formatDefault($field, $format) {
		$formattedText = sprintf(
			$format,
			$this->_schoolInformation['SchoolInformation'][$field]
		);
		return h($formattedText);
	}
}
