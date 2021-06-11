<?php
/**
 * SchoolInformationValidationRepository.php
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('SchoolInformationConst', 'SchoolInformations.Model');
App::uses('UserRole', 'UserRoles.Model');

/**
 * SchoolInformationValidationRepository
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\SchoolInformations\Model\Validation
 */
trait SchoolInformationValidationRulesTrait {

/**
 * 更新できるfieldListを返す
 *
 * @param string $roleKey 会員権限
 * @return array
 */
	public function getUpdatableFieldList(string $roleKey) {
		if (in_array($roleKey, UserRole::$systemRoles, true)) {
			//管理者であれば更新可とする
			return [];
		} else {
			return [
				//'school_kind',
				//'school_type',
				//'student_category',
				//'school_name',
				//'school_name_kana',
				'school_name_roma',
				'principal_name',
				'principal_name_kana',
				//'principal_name_roma',
				//'postal_code',
				//'prefecture_code',
				//'city',
				//'city_code',
				//'address',
				//'establish_year_month',
				'close_year_month',
				'seismic_work',
				'designation_of_shelter',
				'number_of_faculty_members',
				'number_of_total_students',
				'number_of_male_students',
				'number_of_female_students',
				'tel',
				'fax',
				'email',
				'emergency_contact',
				'contact',
				'url',
				'map_url',
				'is_public_school_name_kana',
				'is_public_school_name_roma',
				'is_public_principal_name',
				'is_public_principal_name_kana',
				'is_public_principal_name_roma',
				'is_public_school_type',
				'is_public_school_kind',
				'is_public_student_category',
				'is_public_establish_year_month',
				'is_public_close_year_month',
				'is_public_location',
				'is_public_tel',
				'is_public_fax',
				'is_public_email',
				'is_public_emergency_contact',
				'is_public_contact',
				'is_public_url',
				'is_public_number_of_male_students',
				'is_public_number_of_female_students',
				'is_public_number_of_total_students',
				'is_public_number_of_faculty_members',
				'is_public_seismic_work',
				'is_public_designation_of_shelter',
			];
		}
	}

/**
 * バリデーションルールを返す
 *
 * @param bool $isForeignContry 海外か否か
 * @return array
 */
	public function getValidationRules(bool $isForeignContry) {
		$validate = [
			'school_kind' => $this->__getRuleSchoolKind(),
			'school_type' => $this->__getRuleSchoolType(),
			'student_category' => $this->__getRuleStudentCategory(),
			'school_name' => $this->__getRuleSchoolName(),
			'school_name_kana' => $this->__getRuleSchoolNameKana(),
			'school_name_roma' => $this->__getRuleSchoolNameRoma(),
			'principal_name' => $this->__getRulePrincipalName(),
			'principal_name_kana' => $this->__getRulePrincipalNameKana(),
			//'principal_name_roma',
			'postal_code' => $this->__getRulePostalCode($isForeignContry),
			'prefecture_code' => $this->__getRulePrefectureCode(),
			'city' => $this->__getRuleCity($isForeignContry),
			'city_code' => $this->__getRuleCityCode(),
			'address' => $this->__getRuleAddress(),
			'establish_year_month' => $this->__getRuleEstablishYearMonth(),
			'close_year_month' => $this->__getRuleCloseYearMonth(),
			'seismic_work' => $this->__getRuleSeismicWork(),
			'designation_of_shelter' => $this->__getRuleDesignationOfShelter(),
			'number_of_faculty_members' => $this->__getRuleNumberOfFacultyMembers(),
			'number_of_total_students' => $this->__getRuleNumberOfTotalStudents(),
			'number_of_male_students' => $this->__getRuleNumberOfMaleStudents(),
			'number_of_female_students' => $this->__getRuleNumberOfFemaleStudents(),
			'tel' => $this->__getRuleTel($isForeignContry),
			'fax' => $this->__getRuleFax($isForeignContry),
			'email' => $this->__getRuleEmail(),
			'emergency_contact' => $this->__getRuleEmergencyContact(),
			'url' => $this->__getRuleUrl(),
			'contact' => $this->__getRuleContact(),
			'map_url' => $this->__getRuleMapUrl(),
		];

		$fieldList = $this->getUpdatableFieldList(CurrentLib::read('User.role_key', ''));
		if (! empty($fieldList)) {
			foreach ($validate as $field => $rule) {
				if (!empty($rule) && in_array($field, $fieldList, true)) {
					continue;
				}
				unset($validate[$field]);
			}
		}

		return $validate;
	}

/**
 * 学校名のバリデーションルールを返す
 *
 * @return array
 */
	private function __getRuleSchoolName() {
		return [
			'blankCheck' => [
				'rule' => 'notBlank',
				'message' => __d(
					'school_informations',
					'学校名を入力してください'
				),
				'required' => false
			],
			'lengthCheck' => [
				'rule' => ['maxLength', 40],
				'message' => __d(
					'school_informations',
					'学校名は40文字以内で入力してください'
				),
				'required' => false
			],
			'spaceCheck' => [
				'rule' => ['customValidateContainStartEndSpace'],
				'message' => __d(
					'school_informations',
					'学校名は先頭または末尾にスペースを入れることはできません'
				),
				'required' => false
			],
		];
	}

/**
 * 学校名（フリガナ）のバリデーションルールを返す
 *
 * @return array
 */
	private function __getRuleSchoolNameKana() {
		return [
			'blankCheck' => [
				'rule' => 'notBlank',
				'message' => __d(
					'school_informations',
					'学校名（フリガナ）を入力してください'
				),
				'required' => false
			],
			'lengthCheck' => [
				'rule' => ['maxLength', 100],
				'message' => __d(
					'school_informations',
					'学校名（フリガナ）は100文字以内で入力してください'
				),
				'required' => false
			],
			'katakanaCheck' => [
				'rule' => ['custom', SchoolInformationConst::REGEXP_KATAKANA],
				'message' => __d(
					'school_informations',
					'学校名（フリガナ）は全角カタカナ、スペースのみ入力してください'
				),
				'required' => false
			],
			'spaceCheck' => [
				'rule' => ['customValidateContainStartEndSpace'],
				'message' => __d(
					'school_informations',
					'学校名（フリガナ）は先頭または末尾に' .
						'スペースを入れることはできません'
				),
				'required' => false
			],
		];
	}

/**
 * 学校名（英語表記）のバリデーションルールを返す
 *
 * @return array
 */
	private function __getRuleSchoolNameRoma() {
		return [
			'blankCheck' => [
				'rule' => 'notBlank',
				'message' => __d(
					'school_informations',
					'学校名（英語表記）を入力してください'
				),
				'required' => false
			],
			'lengthCheck' => [
				'rule' => ['maxLength', 100],
				'message' => __d(
					'school_informations',
					'学校名（英語表記）は100文字以内で入力してください'
				),
				'required' => false
			],
			'alphaCheck' => [
				'rule' => ['custom', SchoolInformationConst::REGEXP_ALPHANUMERIC_SYMBOLS()],
				'message' => __d(
					'school_informations',
					'学校名（英語表記）は' .
						'半角英数記号(' . SchoolInformationConst::ALLOW_SYMBOLS . ')、' .
						'半角スペースのみ入力してください'
					),
				'required' => false
			],
			'spaceCheck' => [
				'rule' => ['customValidateContainStartEndSpace'],
				'message' => __d(
					'school_informations',
					'学校名（英語表記）は先頭または末尾に' .
						'スペースを入れることはできません'
				),
				'required' => false
			],
		];
	}

/**
 * 校長(園長)名のバリデーションルールを返す
 *
 * @return array
 */
	private function __getRulePrincipalName() {
		return [
			'blankCheck' => [
				'rule' => 'notBlank',
				'message' => __d(
					'school_informations',
					'校長(園長)名を入力してください'
				),
				'required' => false
			],
			'lengthCheck' => [
				'rule' => ['maxLength', 30],
				'message' => __d(
					'school_informations',
					'校長(園長)名は30文字以内で入力してください'
				),
				'required' => false
			],
			'spaceCheck' => [
				'rule' => ['customValidateContainStartEndSpace'],
				'message' => __d(
					'school_informations',
					'校長(園長)名は先頭または末尾にスペースを入れることはできません'
				),
				'required' => false
			],
		];
	}

/**
 * 校長(園長)名のバリデーションルールを返す
 *
 * @return array
 */
	private function __getRulePrincipalNameKana() {
		return [
			'blankCheck' => [
				'rule' => 'notBlank',
				'message' => __d(
					'school_informations',
					'校長(園長)名（フリガナ）を入力してください'
				),
				'required' => false
			],
			'lengthCheck' => [
				'rule' => ['maxLength', 100],
				'message' => __d(
					'school_informations',
					'校長(園長)名（フリガナ）は100文字以内で入力してください'
				),
				'required' => false
			],
			'katakanaCheck' => [
				'rule' => ['custom', SchoolInformationConst::REGEXP_KATAKANA],
				'message' => __d(
					'school_informations',
					'校長(園長)名（フリガナ）は' .
						'全角カタカナ、スペースのみ入力してください'
				),
				'required' => false
			],
			'spaceCheck' => [
				'rule' => ['customValidateContainStartEndSpace'],
				'message' => __d(
					'school_informations',
					'校長(園長)名（フリガナ）は先頭または末尾に' .
						'スペースを入れることはできません'
				),
				'required' => false
			],
		];
	}

/**
 * 校種(園種)のバリデーションルールを返す
 *
 * @return array
 */
	private function __getRuleSchoolKind() {
		if (method_exists($this, 'getSchoolKinds')) {
			$schoolKinds = $this->getSchoolKinds();
		} else {
			$schoolKinds = [];
		}
		return [
			'blankCheck' => [
				'rule' => 'notBlank',
				'message' => __d(
					'school_informations',
					'校種(園種)を選択してください'
				),
				'required' => false
			],
			'invalidCheck' => [
				'rule' => ['inList', array_keys($schoolKinds)],
				'message' => __d(
					'school_informations',
					'正しい校種(園種)を選択してください'
				),
				'required' => false
			],
		];
	}

/**
 * 国公立種別のバリデーションルールを返す
 *
 * @return array
 */
	private function __getRuleSchoolType() {
		if (method_exists($this, 'getSchoolTypes')) {
			$schoolTypes = $this->getSchoolTypes();
		} else {
			$schoolTypes = [];
		}
		return [
			'blankCheck' => [
				'rule' => 'notBlank',
				'message' => __d(
					'school_informations',
					'国公立種別を選択してください'
				),
				'required' => false
			],
			'invalidCheck' => [
				'rule' => ['inList', array_keys($schoolTypes)],
				'message' => __d(
					'school_informations',
					'正しい国公立種別を選択してください'
				),
				'required' => false
			],
		];
	}

/**
 * 学生(園児)種別のバリデーションルールを返す
 *
 * @return array
 */
	private function __getRuleStudentCategory() {
		if (method_exists($this, 'getStudentCategories')) {
			$studentCategories = $this->getStudentCategories();
		} else {
			$studentCategories = [];
		}
		return [
			'blankCheck' => [
				'rule' => 'notBlank',
				'message' => __d(
					'school_informations',
					'学生(園児)種別を選択してください'
				),
				'required' => false
			],
			'invalidCheck' => [
				'rule' => ['inList', array_keys($studentCategories)],
				'message' => __d(
					'school_informations',
					'正しい学生(園児)種別を選択してください'
				),
				'required' => false
			],
		];
	}

/**
 * 郵便番号のバリデーションルールを返す
 *
 * @param bool $isForeignContry 海外か否か
 * @return array
 */
	private function __getRulePostalCode(bool $isForeignContry) {
		if ($isForeignContry) {
			return [];
		} else {
			return [
					'blankCheck' => [
					'rule' => 'notBlank',
					'message' => __d(
						'school_informations',
						'郵便番号を入力してください'
					),
					'required' => false
				],
				'postalCodeCheck' => [
					'rule' => ['postal', SchoolInformationConst::REGEXP_JP_POST_CODE],
					'message' => __d(
						'school_informations',
						'郵便番号はハイフンなしの7桁で入力してください'
					),
					'required' => false
				]
			];
		}
	}

/**
 * 県コードのバリデーションルールを返す
 *
 * @return array
 */
	private function __getRulePrefectureCode() {
		if (method_exists($this, 'getPrefecture')) {
			$prefs = $this->getPrefecture();
		} else {
			$prefs = [];
		}
		return [
			'blankCheck' => [
				'rule' => 'notBlank',
				'message' => __d(
					'school_informations',
					'都道府県を選択してください'
				),
				'required' => false
			],
			'invalidCheck' => [
				'rule' => ['inList', array_keys($prefs)],
				'message' => __d(
					'school_informations',
					'正しい都道府県を選択してください'
				),
				'required' => false
			]
		];
	}

/**
 * 市区町村コードのバリデーションルールを返す
 *
 * @return array
 */
	private function __getRuleCityCode() {
		return [
			'numericCheck' => [
				'rule' => 'numeric',
				'message' => __d(
					'school_informations',
					'市区町村コードは、数値で入力してください'
				),
				'required' => false,
				'allowEmpty' => true
			],
		];
	}

/**
 * 市区町村のバリデーションルールを返す
 *
 * @param bool $isForeignContry 海外か否か
 * @return array
 */
	private function __getRuleCity(bool $isForeignContry) {
		if ($isForeignContry) {
			return [];
		} else {
			return [
				'blankCheck' => [
					'rule' => 'notBlank',
					'message' => __d(
						'school_informations',
						'市区町村を入力してください'
					),
					'required' => false
				],
				'lengthCheck' => [
					'rule' => ['maxLength', 100],
					'message' => __d(
						'school_informations',
						'市区町村は100文字以内で入力してください'
					),
					'required' => false
				],
				'spaceCheck' => [
					'rule' => ['customValidateContainStartEndSpace'],
					'message' => __d(
						'school_informations',
						'市区町村は先頭または末尾にスペースを入れることはできません'
					),
					'required' => false
				],
			];
		}
	}

/**
 * 番地(それ以降の所在地)のバリデーションルールを返す
 *
 * @return array
 */
	private function __getRuleAddress() {
		return [
			'blankCheck' => [
				'rule' => 'notBlank',
				'message' => __d(
					'school_informations',
					'番地(それ以降の所在地)を入力してください'
				),
				'required' => false
			],
			'lengthCheck' => [
				'rule' => ['maxLength', 200],
				'message' => __d(
					'school_informations',
					'番地(それ以降の所在地)は200文字以内で入力してください'
				),
				'required' => false
			],
			'spaceCheck' => [
				'rule' => ['customValidateContainStartEndSpace'],
				'message' => __d(
					'school_informations',
					'番地(それ以降の所在地)は先頭または末尾に' .
						'スペースを入れることはできません'
				),
				'required' => false
			],
		];
	}

/**
 * 開校年月のバリデーションルールを返す
 *
 * @return array
 */
	private function __getRuleEstablishYearMonth() {
		return [
			'blankCheck' => [
				'rule' => 'notBlank',
				'message' => __d(
					'school_informations',
					'開校年月を入力してください'
				),
				'required' => false
			],
			'formatCheck' => [
				'rule' => ['custom', SchoolInformationConst::REGEXP_MONTH],
				'message' => __d(
					'school_informations',
					'YYYY-MM形式で入力してください'
				),
				'required' => false
			],
		];
	}

/**
 * 閉校年月のバリデーションルールを返す
 *
 * @return array
 */
	private function __getRuleCloseYearMonth() {
		return [
			'formatCheck' => [
				'rule' => ['custom', SchoolInformationConst::REGEXP_MONTH],
				'message' => __d('school_informations', 'YYYY-MM形式で入力してください'),
				'allowEmpty' => true,
				'required' => false
			],
		];
	}

/**
 * 耐震工事の有無のバリデーションルールを返す
 *
 * @return array
 */
	private function __getRuleSeismicWork() {
		return [
			'blankCheck' => [
				'rule' => 'notBlank',
				'message' => __d(
					'school_informations',
					'耐震工事の有無を入力してください'
				),
				'required' => false
			],
			'invalidCheck' => [
				'rule' => ['boolean'],
				'message' => __d(
					'school_informations',
					'正しい耐震工事の有無を選択してください'
				),
				'required' => false
			],
		];
	}

/**
 * 避難所指定の有無のバリデーションルールを返す
 *
 * @return array
 */
	private function __getRuleDesignationOfShelter() {
		return [
			'blankCheck' => [
				'rule' => 'notBlank',
				'message' => __d(
					'school_informations',
					'避難所指定の有無を入力してください'
				),
				'required' => false
			],
			'invalidCheck' => [
				'rule' => ['boolean'],
				'message' => __d(
					'school_informations',
					'正しい避難所指定の有無を選択してください'
				),
				'required' => false
			],
		];
	}

/**
 * 教員(保育士)数のバリデーションルールを返す
 *
 * @return array
 */
	private function __getRuleNumberOfFacultyMembers() {
		return [
			'blankCheck' => [
				'rule' => 'notBlank',
				'message' => __d(
					'school_informations',
					'教員(保育士)数を入力してください'
				),
				'required' => false
			],
			'numberCheck' => [
				'rule' => ['naturalNumber', true],
				'message' => __d(
					'school_informations',
					'教員(保育士)数は半角数字で入力してください'
				),
				'required' => false
			],
		];
	}

/**
 * 全児童(園児)・生徒数のバリデーションルールを返す
 *
 * @return array
 */
	private function __getRuleNumberOfTotalStudents() {
		return [
			'blankCheck' => [
				'rule' => 'notBlank',
				'message' => __d(
					'school_informations',
					'全児童(園児)・生徒数を入力してください'
				),
				'required' => false
			],
			'numberCheck' => [
				'rule' => ['naturalNumber', true],
				'message' => __d(
					'school_informations',
					'全児童(園児)・生徒数は半角数字で入力してください'
				),
				'required' => false
			],
			'totalCheck' => [
				'rule' => [
					'customValidateEqualCheckAndNumbers',
					'number_of_male_students',
					'number_of_female_students'
				],
				'message' => __d(
					'school_informations',
					'全児童(園児)・生徒数が男子数と女子数の合計と異なります'
				),
				'required' => false
			],
		];
	}

/**
 * 男子数のバリデーションルールを返す
 *
 * @return array
 */
	private function __getRuleNumberOfMaleStudents() {
		return [
			'blankCheck' => [
				'rule' => 'notBlank',
				'message' => __d('school_informations', '男子数を入力してください'),
				'required' => false
			],
			'numberCheck' => [
				'rule' => ['naturalNumber', true],
				'message' => __d('school_informations', '男子数は半角数字で入力してください'),
				'required' => false
			],
		];
	}

/**
 * 女子数のバリデーションルールを返す
 *
 * @return array
 */
	private function __getRuleNumberOfFemaleStudents() {
		return [
			'blankCheck' => [
				'rule' => 'notBlank',
				'message' => __d('school_informations', '女子数を入力してください'),
				'required' => false
			],
			'numberCheck' => [
				'rule' => ['naturalNumber', true],
				'message' => __d('school_informations', '女子数は半角数字で入力してください'),
				'required' => false
			],
		];
	}

/**
 * 電話番号のバリデーションルールを返す
 *
 * @param bool $isForeignContry 海外か否か
 * @return array
 */
	private function __getRuleTel(bool $isForeignContry) {
		if ($isForeignContry) {
			return [
				'blankCheck' => [
					'rule' => 'notBlank',
					'message' => __d(
						'school_informations',
						'電話番号を入力してください'
					),
					'required' => false
				],
				'alphaCheck' => [
					'rule' => ['custom', SchoolInformationConst::REGEXP_ALPHANUMERIC_ALL_SYMBOLS()],
					'message' => __d(
						'school_informations',
						'電話番号は半角英数記号、半角スペースのみ入力してください'
					),
					'required' => false
				]
			];
		} else {
			return [
				'blankCheck' => [
					'rule' => 'notBlank',
					'message' => __d(
						'school_informations',
						'電話番号を入力してください'
					),
					'required' => false
				],
				'telCheck' => [
					'rule' => ['phone', SchoolInformationConst::REGEXP_JP_PHONE_NUMBER],
					'message' => __d(
						'school_informations',
						'電話番号は半角数字でハイフン「-」を含めて' .
							'市外局番から入力してください'
					),
					'required' => false
				]
			];
		}
	}

/**
 * FAX番号のバリデーションルールを返す
 *
 * @param bool $isForeignContry 海外か否か
 * @return array
 */
	private function __getRuleFax(bool $isForeignContry) {
		if ($isForeignContry) {
			return [
				'alphaCheck' => [
					'rule' => ['custom', SchoolInformationConst::REGEXP_ALPHANUMERIC_ALL_SYMBOLS()],
					'message' => __d(
						'school_informations',
						'FAX番号は半角英数記号、半角スペースのみ入力してください'
					),
					'allowEmpty' => true
				]
			];
		} else {
			return [
				'telCheck' => [
					'rule' => ['phone', SchoolInformationConst::REGEXP_JP_PHONE_NUMBER],
					'message' => __d(
						'school_informations',
						'FAX番号は半角数字でハイフン「-」を' .
							'含めて市外局番からで入力してください'
					),
					'allowEmpty' => true
				]
			];
		}
	}

/**
 * 学校メールアドレスのバリデーションルールを返す
 *
 * @return array
 */
	private function __getRuleEmail() {
		return [
			'blankCheck' => [
				'rule' => 'notBlank',
				'message' => __d(
					'school_informations',
					'学校メールアドレスを入力してください'
				),
				'required' => false
			],
			'lengthCheck' => [
				'rule' => ['maxLength', 255],
				'message' => __d(
					'school_informations',
					'学校メールアドレスは255文字以内で入力してください'
				),
				'required' => false
			],
			'emailCheck' => [
				'rule' => ['email', true, SchoolInformationConst::REGEXP_EMAIL],
				'message' => __d(
					'school_informations',
					'正しい学校メールアドレスを入力してください'
				),
				'required' => false
			],
		];
	}

/**
 * 緊急連絡先のバリデーションルールを返す
 *
 * @return array
 */
	private function __getRuleEmergencyContact() {
		return [
			'blankCheck' => [
				'rule' => 'notBlank',
				'message' => __d('school_informations', '緊急連絡先を入力してください'),
				'required' => false
			],
			'lengthCheck' => [
				'rule' => ['maxLength', 255],
				'message' => __d(
					'school_informations',
					'緊急連絡先は255文字以内で入力してください'
				),
				'required' => false
			],
		];
	}

/**
 * 問い合わせ先のバリデーションルールを返す
 *
 * @return array
 */
	private function __getRuleContact() {
		return [
			'lengthCheck' => [
				'rule' => ['maxLength', 255],
				'message' => __d(
					'school_informations',
					'問い合わせ先は255文字以内で入力してください'
				),
				'required' => false
			],
		];
	}

/**
 * URLのバリデーションルールを返す
 *
 * @return array
 */
	private function __getRuleUrl() {
		return [
			'lengthCheck' => [
				'rule' => ['maxLength', 255],
				'message' => __d(
					'school_informations',
					'URLは255文字以内で入力してください'
				),
				'required' => false
			],
			'urlCheck' => [
				'rule' => ['url', true],
				'message' => __d(
					'school_informations',
					'正しいURLを入力してください'
				),
				'required' => false
			],
		];
	}

/**
 * 地図URLのバリデーションルールを返す
 *
 * @return array
 */
	private function __getRuleMapUrl() {
		return [
			'mapCheck' => [
				'rule' => ['validateMapUrl'],
				'message' => __d(
					'school_informations',
					'地図URLの形式が間違っています'
				),
				'allowEmpty' => true,
				'required' => false,
			],
		];
	}

}
