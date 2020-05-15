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

/**
 * getInlineImage
 *
 * @param array $uploadFile アップロードファイル
 * @param string $size サイズ
 * @return string
 */
	private function __getInlineImage($uploadFile, $size) {
		$filepath = $this->__getImagePath($uploadFile, $size);
		$mimeType = $uploadFile['mimetype'];
		$encodeData = base64_encode(file_get_contents($filepath));
		return sprintf('data:%s;base64,%s', $mimeType, $encodeData);
	}

/**
 * getImagePath
 *
 * @param array $uploadFile アップロードファイル
 * @param string $size サイズ
 * @return string
 */
	private function __getImagePath($uploadFile, $size) {
		return $filepath = UPLOADS_ROOT . $uploadFile['path'] . DS .
				$uploadFile['id'] .DS . $size . $uploadFile['real_file_name'];
	}

/**
 * 校章の表示
 *
 * @param string $size サイズ
 * @return string
 */
	public function schoolBadge($size) {
		if (isset($this->__schoolInformation['UploadFile']['school_badge']['id'])) {
			//return $this->NetCommonsHtml->image(
			//	'/school_informations/school_informations/school_badge?size=' . $size,
			//	['class' => 'img-responsive']
			//);
			$imgSrc = $this->__getInlineImage(
				$this->__schoolInformation['UploadFile']['school_badge'], $size . '_'
			);
			return '<img src="' . $imgSrc . '" class="img-responsive" alt="" />';
		}
		// デフォルトロゴ
		// HACK: SchoolInformationモデルから参照するほうが良い
		$height = [
			'small' => 60,
			//'middle' => 120,
			'large' => 200
		];
		if (isset($height[$size])) {
			return $this->NetCommonsHtml->image(
				'/school_informations/img/no_badge.png',
				['style' => 'height:' . $height[$size] . 'px']
			);
		} else {
			return $this->NetCommonsHtml->image(
				'/school_informations/img/no_badge.png',
				['class' => 'img-responsive']
			);
		}
	}

/**
 * カバー写真の表示
 *
 * @return string
 */
	public function coverPicture() {
		if (isset($this->__schoolInformation['UploadFile']['cover_picture']['id'])) {
			//return $this->NetCommonsHtml->image(
			//	'/school_informations/school_informations/cover_picture'
			//);
			$imgSrc = $this->__getInlineImage(
				$this->__schoolInformation['UploadFile']['cover_picture'], 'large_'
			);
			$imagePath = $this->__getImagePath(
				$this->__schoolInformation['UploadFile']['cover_picture'], 'large_'
			);

			list($width, $height) = @getimagesize($imagePath);
			if ($height < 180 && $width < 1140) {
				$imgClassName = ' class="school-cover-picture-fixed-width"';
			} elseif ($height < 180) {
				$imgClassName = ' class="school-cover-picture-fixed-height"';
			} elseif ($width < 1140) {
				$imgClassName = ' class="school-cover-picture-fixed-width"';
			} else {
				$imgClassName = '';
			}

			return '<img src="' . $imgSrc . '"' . $imgClassName . ' alt="" />';
		}
		//return $this->NetCommonsHtml->image(
		//	'/school_informations/img/cover_sample.jpg'
		//);
		return '';
	}

/**
 * 校長の表示
 *
 * @return string
 */
	public function displayPrincipal() {
		if ($this->isDisplayPrincipal() === false) {
			return '';
		}

		if ($this->isDisplay('principal_name')) {
			$principalName = $this->__schoolInformation['SchoolInformation']['principal_name'] ?? '';
		} else {
			$principalName = '';
		}

		if ($this->isDisplay('principal_name_kana')) {
			$principalNameKana =
					$this->__schoolInformation['SchoolInformation']['principal_name_kana'] ?? '';
		} else {
			$principalNameKana = '';
		}

		$splitName = preg_split('/[\s　]+/u', trim($principalName));
		$splitNameCount = count($splitName);
		$splitNameKana = preg_split('/[\s　]+/u', trim($principalNameKana));

		if ($splitNameCount === count($splitNameKana)) {
			$tagText = '';
			for ($i = 0; $i < $splitNameCount; $i++) {
				$tagText .= $this->NetCommonsHtml->tag(
					'ruby',
					h($splitName[$i]) . $this->NetCommonsHtml->tag('rt', h($splitNameKana[$i]))
				);
				$tagText .= '　';
			}
		} else {
			$tagText = $this->NetCommonsHtml->tag(
				'ruby',
				h($principalName) . $this->NetCommonsHtml->tag('rt', h($principalNameKana))
			);
		}
		return $tagText;
	}

/**
 * 校長の表示できるか否か
 *
 * @return bool
 */
	public function isDisplayPrincipal() {
		return ($this->isDisplay('principal_name') || $this->isDisplay('principal_name_kana'));
	}

/**
 * 各項目を表示できるか否か
 *
 * @param string $field 項目名
 * @return bool
 */
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

/**
 * 各項目が公開に設定されているか否か
 *
 * @param string $field 項目名
 * @return bool
 */
	private function __isPublic($field) {
		if (in_array($field, SchoolInformation::locationFields(), true)) {
			$field = 'location';
		}
		return (bool)$this->__schoolInformation['SchoolInformation']['is_public_' . $field];
	}

/**
 * 各項目が入力されているか否か
 *
 * @param string $field 項目名
 * @return bool
 */
	private function __isExists($field) {
		return (bool)$this->__schoolInformation['SchoolInformation'][$field];
	}

/**
 * フレーム設定で各項目が公開に設定されているか否か
 *
 * @param string $field 項目名
 * @return bool
 */
	private function __isDisplayByFrameSetting($field) {
		if (in_array($field, SchoolInformation::locationFields(), true)) {
			$field = 'location';
		}
		return (bool)$this->_View->viewVars['frameSetting']['SchoolInformationFrameSetting']['is_display_' . $field];
	}

/**
 * 表示処理
 *
 * @param string $field 項目名
 * @param array $options オプション
 * @return bool
 */
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
			if (isset($options['label'])) {
				$labelText = $options['label'];
			} else {
				$labelText = __d('school_informations', Inflector::humanize($field));
			}
			$label = $this->label($field, $labelText);
		}

		return $this->NetCommonsHtml->tag(
			$tag,
			$label . $formattedText,
			$tagOptions
		);
	}

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
 * 各項目の整形処理
 *
 * @param $field 項目名
 * @param $format フォーマット
 * @return string
 */
	private function __formatValue($field, $format) {
		if (strpos($field, 'year_month') !== false) {
			$formattedText = $this->__formatYearMont($field);
			return $formattedText;
		}
		if (strpos($field, 'url') !== false) {
			return $this->__formatUrl($field);
		}

		$formatMethod = '__format' . ucfirst(Inflector::camelize($field));
		if (method_exists($this, $formatMethod)) {
			return call_user_func([$this, $formatMethod]);
		}

		$formattedText = $this->__formatDefault($field, $format);
		return $formattedText;
	}

/**
 * 国公立種別の整形処理
 *
 * @param $field 項目名
 * @return string
 */
	public function __formatSchoolType() {
		$value = $this->__schoolInformation['SchoolInformation']['school_type'];
		return $this->_View->viewVars['schoolTypeOptions'][$value];
	}

/**
 * 校種の整形処理
 *
 * @param $field 項目名
 * @return string
 */
	public function __formatSchoolKind() {
		$value = $this->__schoolInformation['SchoolInformation']['school_kind'];
		return $this->_View->viewVars['schoolKindOptions'][$value];
	}

/**
 * 学生種別の整形処理
 *
 * @param $field 項目名
 * @return string
 */
	public function __formatStudentCategory() {
		$value = $this->__schoolInformation['SchoolInformation']['student_category'];
		return $this->_View->viewVars['studentCategoryOptions'][$value];
	}

/**
 * 年月の整形処理
 *
 * @param $field 項目名
 * @return string
 */
	private function __formatYearMont($field) {
		list($year, $month) = explode(
			'-',
			$this->__schoolInformation['SchoolInformation'][$field]
		);
		$formattedText = __d('school_informations', '%2$d/%1$d', $year, $month);
		return h($formattedText);
	}

/**
 * URLの整形処理
 *
 * @param $field 項目名
 * @return string
 */
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
 * Emailの整形処理
 *
 * @return string
 */
	private function __formatEmail() {
		$value = $this->__schoolInformation['SchoolInformation']['email'];
		list($local, $domain) = explode('@', $value);
		return
			h($local) . $this->NetCommonsHtml->image('/school_informations/img/mailmark.gif') . h($domain);
	}

/**
 * 学生種別の整形処理
 *
 * @param $field 項目名
 * @return string
 */
	public function __formatPostalCode() {
		$value = $this->__schoolInformation['SchoolInformation']['postal_code'];
		if (preg_match('/^[0-9]+$/', $value)) {
			$value = substr($value, 0, 3) . '-' . substr($value, -4);
		}
		return h(__d('school_informations', 'PostalCode:%s', $value));
	}

/**
 * デフォルトの整形処理
 *
 * @param $field 項目名
 * @param $format フォーマット
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
 * ラベルの表示
 *
 * @param $field 項目名
 * @param $labelText ラベルテキスト
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
 * 所在地の公開できるか否か
 *
 * @return bool
 */
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

/**
 * 所在地の表示
 *
 * @return string
 */
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

/**
 * 都道府県の表示
 *
 * @return string
 */
	private function __prefecture() {
		if ($this->isDisplay('prefecture_code')) {
			$code = $this->__schoolInformation['SchoolInformation']['prefecture_code'];
			return $this->_View->viewVars['prefectureOptions'][$code];
		}
		return '';
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
		$schoolKind = $this->__schoolInformation['SchoolInformation']['school_kind'];
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
		$schoolKind = $this->__schoolInformation['SchoolInformation']['school_kind'];
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
		$schoolKind = $this->__schoolInformation['SchoolInformation']['school_kind'];
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
		$schoolKind = $this->__schoolInformation['SchoolInformation']['school_kind'];
		return in_array($schoolKind, ['幼稚園', '保育園', '認定こども園'], true);
	}

}