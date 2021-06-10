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
trait SchoolInformationFormHelpTrait {

/**
 * ヘルプ表示
 *
 * @param string $helpMessage ヘルプメッセージ
 * @return string
 */
	private function __displayHelp($helpMessage) {
		return '<span class="glyphicon glyphicon-bullhorn"></span> ' . $helpMessage;
	}

/**
 * 変更不可のヘルプ表示
 *
 * @param string $labelText ラベルテキスト
 * @return string
 */
	private function __helpDisabled($labelText) {
		$helpMessage = __d(
			'school_informations',
			'%sは学校ウェブサイトからは変更できません<br>' .
				'　edumap公式サイト' .
				'(<a href="https://edumap.jp/" target="_blank">https://edumap.jp/</a>)' .
				'で変更してください',
			$labelText
		);
		return $this->__displayHelp($helpMessage);
	}

/**
 * 文字数のヘルプ表示
 *
 * @param int $length 文字数
 * @return string
 */
	private function __helpMaxLength($length) {
		$helpMessage = __d(
			'school_informations',
			'%s文字以内で入力してください',
			$length
		);
		return $this->__displayHelp($helpMessage);
	}

/**
 * 文字数+カナのヘルプ表示
 *
 * @param int $length 文字数
 * @return string
 */
	private function __helpMaxLengthAndKana($length) {
		$helpMessage = __d(
			'school_informations',
			'%s文字以内で入力してください<br>' .
				'　全角カタカナ、スペースで入力してください',
			$length
		);
		return $this->__displayHelp($helpMessage);
	}

/**
 * 文字数+半角英数字記号のヘルプ表示
 *
 * @param int $length 文字数
 * @return string
 */
	private function __helpMaxLengthAndAlphaNumericSymbol($length) {
		$helpMessage = __d(
			'school_informations',
			'%s文字以内で入力してください<br>' .
				'　半角英数記号(&\',-.・)、半角スペースで入力してください',
			$length
		);
		return $this->__displayHelp($helpMessage);
	}

/**
 * 半角数字のヘルプ表示
 *
 * @return string
 */
	private function __helpNumeric() {
		$helpMessage = __d(
			'school_informations',
			'半角数字で入力してください'
		);
		return $this->__displayHelp($helpMessage);
	}

/**
 * 年月のヘルプ表示
 *
 * @return string
 */
	private function __helpMonth() {
		$helpMessage = __d(
			'school_informations',
			'YYYY-MM形式で入力してください　例.2019-09'
		);
		return $this->__displayHelp($helpMessage);
	}

/**
 * 電話番号のヘルプ表示
 *
 * @return string
 */
	private function __helpPhoneNumber() {
		$helpMessage = __d(
			'school_informations',
			'半角数字でハイフン「-」を含めて市外局番から入力してください'
		);
		return $this->__displayHelp($helpMessage);
	}

/**
 * 問い合わせ先のヘルプ表示
 *
 * @return string
 */
	private function __helpContact() {
		$helpMessage = __d(
			'school_informations',
			'電話番号かメールアドレスを入力してください'
		);
		return $this->__displayHelp($helpMessage);
	}

/**
 * 学校名inputヘルプを返す
 *
 * @param string $labelText ラベルテキスト
 * @param bool $isUpdatable 更新可能なカラムか否か
 * @return string
 */
	protected function _helpSchoolName(string $labelText, bool $isUpdatable) {
		if (! $isUpdatable) {
			return $this->__helpDisabled($labelText);
		} else {
			return $this->__helpMaxLength(30);
		}
	}

/**
 * 学校名(フリガナ)inputヘルプを返す
 *
 * @param string $labelText ラベルテキスト
 * @param bool $isUpdatable 更新可能なカラムか否か
 * @return string
 */
	protected function _helpSchoolNameKana(string $labelText, bool $isUpdatable) {
		if (! $isUpdatable) {
			return $this->__helpDisabled($labelText);
		} else {
			return $this->__helpMaxLengthAndKana(100);
		}
	}

/**
 * 学校名(英語表記)inputヘルプを返す
 *
 * @param string $labelText ラベルテキスト
 * @param bool $isUpdatable 更新可能なカラムか否か
 * @return string
 */
	protected function _helpSchoolNameRoma(string $labelText, bool $isUpdatable) {
		if (! $isUpdatable) {
			return $this->__helpDisabled($labelText);
		} else {
			return $this->__helpMaxLengthAndAlphaNumericSymbol(100);
		}
	}

/**
 * 学校長名inputヘルプを返す
 *
 * @param string $labelText ラベルテキスト
 * @param bool $isUpdatable 更新可能なカラムか否か
 * @return string
 */
	protected function _helpPrincipalName(string $labelText, bool $isUpdatable) {
		if (! $isUpdatable) {
			return $this->__helpDisabled($labelText);
		} else {
			return $this->__helpMaxLength(30);
		}
	}

/**
 * 学校長名(フリガナ)inputヘルプを返す
 *
 * @param string $labelText ラベルテキスト
 * @param bool $isUpdatable 更新可能なカラムか否か
 * @return string
 */
	protected function _helpPrincipalNameKana(string $labelText, bool $isUpdatable) {
		if (! $isUpdatable) {
			return $this->__helpDisabled($labelText);
		} else {
			return $this->__helpMaxLengthAndKana(100);
		}
	}

/**
 * 郵便番号inputヘルプを返す
 *
 * @param string $labelText ラベルテキスト
 * @param bool $isUpdatable 更新可能なカラムか否か
 * @return string
 */
	protected function _helpPostalCode(string $labelText, bool $isUpdatable) {
		if (! $isUpdatable) {
			return $this->__helpDisabled($labelText);
		} else {
			$helpMessage = __d(
				'school_informations',
				'ハイフンなしの半角数字で入力してください'
			);
			return $this->__displayHelp($helpMessage);
		}
	}

/**
 * 県コードinputヘルプを返す
 *
 * @param string $labelText ラベルテキスト
 * @param bool $isUpdatable 更新可能なカラムか否か
 * @return string
 */
	protected function _helpPrefectureCode(string $labelText, bool $isUpdatable) {
		if (! $isUpdatable) {
			return $this->__helpDisabled($labelText);
		} else {
			return '';
		}
	}

/**
 * 市区町村コードinputヘルプを返す
 *
 * @param string $labelText ラベルテキスト
 * @param bool $isUpdatable 更新可能なカラムか否か
 * @return string
 */
	protected function _helpCityCode(string $labelText, bool $isUpdatable) {
		if (! $isUpdatable) {
			return $this->__helpDisabled($labelText);
		} else {
			return '';
		}
	}

/**
 * 市区町村inputヘルプを返す
 *
 * @param string $labelText ラベルテキスト
 * @param bool $isUpdatable 更新可能なカラムか否か
 * @return string
 */
	protected function _helpCity(string $labelText, bool $isUpdatable) {
		if (! $isUpdatable) {
			return $this->__helpDisabled($labelText);
		} else {
			return $this->__helpMaxLength(100);
		}
	}

/**
 * 番地(それ以降の所在地)inputヘルプを返す
 *
 * @param string $labelText ラベルテキスト
 * @param bool $isUpdatable 更新可能なカラムか否か
 * @return string
 */
	protected function _helpAddress(string $labelText, bool $isUpdatable) {
		if (! $isUpdatable) {
			return $this->__helpDisabled($labelText);
		} else {
			return $this->__helpMaxLength(200);
		}
	}

/**
 * 電話番号inputヘルプを返す
 *
 * @param string $labelText ラベルテキスト
 * @param bool $isUpdatable 更新可能なカラムか否か
 * @return string
 */
	protected function _helpTel(string $labelText, bool $isUpdatable) {
		if (! $isUpdatable) {
			return $this->__helpDisabled($labelText);
		} else {
			return $this->__helpPhoneNumber();
		}
	}

/**
 * FAX番号inputヘルプを返す
 *
 * @param string $labelText ラベルテキスト
 * @param bool $isUpdatable 更新可能なカラムか否か
 * @return string
 */
	protected function _helpFax(string $labelText, bool $isUpdatable) {
		if (! $isUpdatable) {
			return $this->__helpDisabled($labelText);
		} else {
			return $this->__helpPhoneNumber();
		}
	}

/**
 * 学校メールアドレスinputヘルプを返す
 *
 * @param string $labelText ラベルテキスト
 * @param bool $isUpdatable 更新可能なカラムか否か
 * @return string
 */
	protected function _helpEmail(string $labelText, bool $isUpdatable) {
		if (! $isUpdatable) {
			return $this->__helpDisabled($labelText);
		} else {
			$helpMessage = __d(
				'school_informations',
				'255文字以内のメール形式で入力してください'
			);
			return $this->__displayHelp($helpMessage);
		}
	}

/**
 * 緊急連絡先inputヘルプを返す
 *
 * @param string $labelText ラベルテキスト
 * @param bool $isUpdatable 更新可能なカラムか否か
 * @return string
 */
	protected function _helpEmergencyContact(string $labelText, bool $isUpdatable) {
		if (! $isUpdatable) {
			return $this->__helpDisabled($labelText);
		} else {
			return $this->__helpContact();
		}
	}

/**
 * 問い合わせ先inputヘルプを返す
 *
 * @param string $labelText ラベルテキスト
 * @param bool $isUpdatable 更新可能なカラムか否か
 * @return string
 */
	protected function _helpContact(string $labelText, bool $isUpdatable) {
		if (! $isUpdatable) {
			return $this->__helpDisabled($labelText);
		} else {
			return $this->__helpContact();
		}
	}

/**
 * 校種inputヘルプを返す
 *
 * @param string $labelText ラベルテキスト
 * @param bool $isUpdatable 更新可能なカラムか否か
 * @return string
 */
	protected function _helpSchoolKind(string $labelText, bool $isUpdatable) {
		if (! $isUpdatable) {
			return $this->__helpDisabled($labelText);
		} else {
			return '';
		}
	}

/**
 * 国公立種別inputヘルプを返す
 *
 * @param string $labelText ラベルテキスト
 * @param bool $isUpdatable 更新可能なカラムか否か
 * @return string
 */
	protected function _helpSchoolType(string $labelText, bool $isUpdatable) {
		if (! $isUpdatable) {
			return $this->__helpDisabled($labelText);
		} else {
			return '';
		}
	}

/**
 * 学生種別inputヘルプを返す
 *
 * @param string $labelText ラベルテキスト
 * @param bool $isUpdatable 更新可能なカラムか否か
 * @return string
 */
	protected function _helpStudentCategory(string $labelText, bool $isUpdatable) {
		if (! $isUpdatable) {
			return $this->__helpDisabled($labelText);
		} else {
			return '';
		}
	}

/**
 * 耐震工事の有無inputヘルプを返す
 *
 * @param string $labelText ラベルテキスト
 * @param bool $isUpdatable 更新可能なカラムか否か
 * @return string
 */
	protected function _helpSeismicWork(string $labelText, bool $isUpdatable) {
		if (! $isUpdatable) {
			return $this->__helpDisabled($labelText);
		} else {
			$helpMessage = __d(
				'school_informations',
				'校舎と屋内施設(体育館)の両方に2000年(平成12年)6月1日以降の' .
					'「2000年基準」を満たした耐震工事はされていますか？'
			);
			return $this->__displayHelp($helpMessage);
		}
	}

/**
 * 避難所指定の有無inputヘルプを返す
 *
 * @param string $labelText ラベルテキスト
 * @param bool $isUpdatable 更新可能なカラムか否か
 * @return string
 */
	protected function _helpDesignationOfShelter(string $labelText, bool $isUpdatable) {
		if (! $isUpdatable) {
			return $this->__helpDisabled($labelText);
		} else {
			return '';
		}
	}

/**
 * 教員(保育士)数inputヘルプを返す
 *
 * @param string $labelText ラベルテキスト
 * @param bool $isUpdatable 更新可能なカラムか否か
 * @return string
 */
	protected function _helpNumberOfFacultyMembers(string $labelText, bool $isUpdatable) {
		if (! $isUpdatable) {
			return $this->__helpDisabled($labelText);
		} else {
			return $this->__helpNumeric();
		}
	}

/**
 * 全児童(園児)・生徒数inputヘルプを返す
 *
 * @param string $labelText ラベルテキスト
 * @param bool $isUpdatable 更新可能なカラムか否か
 * @return string
 */
	protected function _helpNumberOfTotalStudents(string $labelText, bool $isUpdatable) {
		if (! $isUpdatable) {
			return $this->__helpDisabled($labelText);
		} else {
			return $this->__helpNumeric();
		}
	}

/**
 * 男子数inputヘルプを返す
 *
 * @param string $labelText ラベルテキスト
 * @param bool $isUpdatable 更新可能なカラムか否か
 * @return string
 */
	protected function _helpNumberOfMaleStudents(string $labelText, bool $isUpdatable) {
		if (! $isUpdatable) {
			return $this->__helpDisabled($labelText);
		} else {
			return $this->__helpNumeric();
		}
	}

/**
 * 女子数inputヘルプを返す
 *
 * @param string $labelText ラベルテキスト
 * @param bool $isUpdatable 更新可能なカラムか否か
 * @return string
 */
	protected function _helpNumberOfFemaleStudents(string $labelText, bool $isUpdatable) {
		if (! $isUpdatable) {
			return $this->__helpDisabled($labelText);
		} else {
			return $this->__helpNumeric();
		}
	}

/**
 * 開校(開園)年月inputヘルプを返す
 *
 * @param string $labelText ラベルテキスト
 * @param bool $isUpdatable 更新可能なカラムか否か
 * @return string
 */
	protected function _helpEstablishYearMonth(string $labelText, bool $isUpdatable) {
		if (! $isUpdatable) {
			return $this->__helpDisabled($labelText);
		} else {
			return $this->__helpMonth();
		}
	}

/**
 * 閉校(閉園)年月inputヘルプを返す
 *
 * @param string $labelText ラベルテキスト
 * @param bool $isUpdatable 更新可能なカラムか否か
 * @return string
 */
	protected function _helpCloseYearMonth(string $labelText, bool $isUpdatable) {
		if (! $isUpdatable) {
			return $this->__helpDisabled($labelText);
		} else {
			return $this->__helpMonth();
		}
	}

/**
 * URLinputヘルプを返す
 *
 * @param string $labelText ラベルテキスト
 * @param bool $isUpdatable 更新可能なカラムか否か
 * @return string
 */
	protected function _helpUrl(string $labelText, bool $isUpdatable) {
		if (! $isUpdatable) {
			return $this->__helpDisabled($labelText);
		} else {
			$helpMessage = __d(
				'school_informations',
				'255文字以内の「https://」もしくは「http://」から始まる' .
					'URL形式で入力してください'
			);
			return $this->__displayHelp($helpMessage);
		}
	}

/**
 * 地図URLinputヘルプを返す
 *
 * @param string $labelText ラベルテキスト
 * @param bool $isUpdatable 更新可能なカラムか否か
 * @return string
 */
	protected function _helpMapUrl(string $labelText, bool $isUpdatable) {
		if (! $isUpdatable) {
			return $this->__helpDisabled($labelText);
		} else {
			$helpMessage = __d('school_informations', 'Specify the URL of the Google Maps iframe widget.');
			return $this->__displayHelp($helpMessage);
		}
	}

}
