<?php
/**
 * SchoolInformationLabelTrait.php
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */


/**
 * SchoolInformationLabelTrait
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\SchoolInformations\Veiw\Helper\Trait
 */
trait SchoolInformationLabelTrait {

/**
 * _を-に変換
 *
 * @param string $field snake_case
 * @return string kebab-style
 */
	private function __toKebab($field) {
		return str_replace('_', '-', $field);
	}

/**
 * ラベルの表示
 *
 * @param string $field 項目名
 * @param string $labelText ラベルテキスト
 * @return string
 */
	public function label($field, $labelText) {
		$labelClassName = 'school-information-label school-information-' . $this->__toKebab(
				$field
			) . '-label';
		$label = $this->NetCommonsHtml->tag('span', $labelText, ['class' => $labelClassName]);
		return $label;
	}

/**
 * 生徒数ラベル
 *
 * @return string
 */
	public function labelNumberOfStudents() {
		return __d('school_informations', 'Number Of ' . $this->__getLabelDefineNumberOfStudents());
	}

/**
 * 全生徒数ラベル
 *
 * @return string
 */
	public function labelTotalNumberOfStudents() {
		return __d('school_informations', 'Number Of Total ' . $this->__getLabelDefineNumberOfStudents());
	}

/**
 * 生徒数ラベル
 *
 * @return string
 */
	private function __getLabelDefineNumberOfStudents() {
		$schoolKind = $this->_schoolInformation['SchoolInformation']['school_kind'];
		if ($this->__isUnderElementarySchool()) {
			$label = 'Kindergarten pupil';
		} elseif ($schoolKind === '小学校') {
			$label = 'Children';
		} else {
			$label = 'Students';
		}
		return $label;
	}

/**
 * 校長名ラベル
 *
 * @return string
 */
	public function labelPrincipal() {
		$prefx = $this->__getKindergartenLabelOfPrefix();
		return __d('school_informations', $prefx . 'Principal Name');
	}

/**
 * 校種ラベル
 *
 * @return string
 */
	public function labelSchoolKind() {
		$prefx = $this->__getKindergartenLabelOfPrefix();
		return __d('school_informations', $prefx . 'School Kind');
	}

/**
 * 学生種別ラベル
 *
 * @return string
 */
	public function labelStudentCategory() {
		$prefx = $this->__getKindergartenLabelOfPrefix();
		return __d('school_informations', $prefx . 'Student Category');
	}

/**
 * 開校ラベル
 *
 * @return string
 */
	public function labelEstablishYearMonth() {
		$prefx = $this->__getKindergartenLabelOfPrefix();
		return __d('school_informations', $prefx . 'Establish Year Month');
	}

/**
 * 閉校ラベル
 *
 * @return string
 */
	public function labelCloseYearMonth() {
		$prefx = $this->__getKindergartenLabelOfPrefix();
		return __d('school_informations', $prefx . 'Close Year Month');
	}

/**
 * 教員数ラベル
 *
 * @return string
 */
	public function labelNumberOfFacultyMembers() {
		$schoolKind = $this->_schoolInformation['SchoolInformation']['school_kind'];
		if (in_array($schoolKind, ['保育園'], true)) {
			return __d('school_informations', 'Number Of Childcare Workers');
		} else {
			return __d('school_informations', 'Number Of Teachers');
		}
	}

/**
 * 小学生未満のラベルプレフィックス
 *
 * @return string
 */
	private function __getKindergartenLabelOfPrefix() {
		if ($this->__isUnderElementarySchool()) {
			$labelPrefix = 'Kindergarten ';
		} else {
			$labelPrefix = 'School ';
		}
		return $labelPrefix;
	}

/**
 * 小学生未満かどうか
 *
 * @return string
 */
	private function __isUnderElementarySchool() {
		$schoolKind = $this->_schoolInformation['SchoolInformation']['school_kind'];
		return in_array($schoolKind, ['幼稚園', '保育園', '認定こども園'], true);
	}

}
