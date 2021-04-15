<?php
/**
 * SchoolInformationHelper.php
 *
 * @author   Ryuji AMANO <ryuji@ryus.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('AppHelper', 'View');
App::uses('SchoolInformationFormatterTrait', 'SchoolInformations.View/Helper/Trait');
App::uses('SchoolInformationLabelTrait', 'SchoolInformations.View/Helper/Trait');

/**
 * Class SchoolInformationHelper
 */
class SchoolInformationHelper extends AppHelper {

	use SchoolInformationFormatterTrait;
	use SchoolInformationLabelTrait;

/**
 * 使用するヘルパー
 *
 * @var array
 */
	public $helpers = [
		'NetCommons.NetCommonsHtml'
	];

/**
 * 学校情報データ
 *
 * @var array
 */
	protected $_schoolInformation;

/**
 * 学校情報データをヘルパーにセットする
 *
 * @param array $schoolInformation 学校情報データ
 * @return void
 */
	public function set(array $schoolInformation) {
		$this->_schoolInformation = $schoolInformation;
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
		return UPLOADS_ROOT . $uploadFile['path'] . DS .
				$uploadFile['id'] . DS . $size . $uploadFile['real_file_name'];
	}

/**
 * 校章の表示
 *
 * @param string $size サイズ
 * @return string
 */
	public function schoolBadge($size) {
		if (isset($this->_schoolInformation['UploadFile']['school_badge']['id'])) {
			//return $this->NetCommonsHtml->image(
			//	'/school_informations/school_informations/school_badge?size=' . $size,
			//	['class' => 'img-responsive']
			//);
			$imgSrc = $this->__getInlineImage(
				$this->_schoolInformation['UploadFile']['school_badge'], $size . '_'
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
		if (isset($this->_schoolInformation['UploadFile']['cover_picture']['id'])) {
			//return $this->NetCommonsHtml->image(
			//	'/school_informations/school_informations/cover_picture'
			//);
			$imgSrc = $this->__getInlineImage(
				$this->_schoolInformation['UploadFile']['cover_picture'], 'large_'
			);
			$imagePath = $this->__getImagePath(
				$this->_schoolInformation['UploadFile']['cover_picture'], 'large_'
			);

			//@codingStandardsIgnoreStart
			$info = @getimagesize($imagePath);
			//@codingStandardsIgnoreEnd
			if (is_array($info)) {
				list($width, $height) = $info;
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
		}

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
			$principalName = $this->_schoolInformation['SchoolInformation']['principal_name'] ?? '';
		} else {
			$principalName = '';
		}

		if ($this->isDisplay('principal_name_kana')) {
			$principalNameKana =
					$this->_schoolInformation['SchoolInformation']['principal_name_kana'] ?? '';
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
		return (bool)$this->_schoolInformation['SchoolInformation']['is_public_' . $field];
	}

/**
 * 各項目が入力されているか否か
 *
 * @param string $field 項目名
 * @return bool
 */
	private function __isExists($field) {
		return (bool)$this->_schoolInformation['SchoolInformation'][$field];
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
		$frameSetting = $this->_View->viewVars['frameSetting']['SchoolInformationFrameSetting'];
		return (bool)$frameSetting['is_display_' . $field];
	}

/**
 * 表示処理
 *
 * @param string $field 項目名
 * @param array $options オプション
 * @return bool
 */
	public function display($field, array $options = []) {
		assert($this->_schoolInformation);

		if ($this->isDisplay($field) === false) {
			return '';
		}

		$tag = isset($options['tag']) ? $options['tag'] : 'div';

		$format = isset($options['format']) ? $options['format'] : '%s';

		$tagOptions = [
			'class' => 'school-information-record-item school-information-' . $this->__toKebab($field),
		];

		$formattedText = $this->_formatValue($field, $format);

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
			$code = $this->_schoolInformation['SchoolInformation']['prefecture_code'];
			return $this->_View->viewVars['prefectureOptions'][$code];
		}
		return '';
	}

}
