<?php
/**
 * SchoolInformationFormHelper.php
 *
 * @author   Ryuji AMANO <ryuji@ryus.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('AppHelper', 'View');
App::uses('SchoolInformationFormHelpTrait', 'SchoolInformations.View/Helper/Trait');

/**
 * Class SchoolInformationFormHelper
 *
 * @property NetCommonsFormHelpr $NetCommonsForm
 * @property SchoolInformationHtmlHelper $SchoolInformationHtml
 */
class SchoolInformationFormHelper extends AppHelper {

	use SchoolInformationFormHelpTrait;

/**
 * 使用するヘルパー
 *
 * @var array
 */
	public $helpers = [
		'NetCommons.NetCommonsForm',
		'SchoolInformations.SchoolInformationHtml'
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
		$this->SchoolInformationHtml->set($schoolInformation);
	}

/**
 * 入力部品の出力
 *
 * @param string $field カラム名
 * @param array $extraOptions オプション
 * @param bool $isEditable 更新可能なカラムか否か
 * @return string
 */
	public function input($field, $extraOptions, $isEditable) {
		$html = '';
		$html .= '<div class="school-information-form-group">';
		$html .= $this->__inputCommon($field, $extraOptions, $isEditable);
		$html .= '<hr>';
		$html .= '</div>';
		return $html;
	}

/**
 * 入力部品の出力
 *
 * @param string $field カラム名
 * @param array $extraOptions オプション
 * @param bool $isEditable 更新可能なカラムか否か
 * @return string
 */
	public function labelLocation() {
		$html = '';
		$html .= $this->NetCommonsForm->label(
			'location',
			__d('school_informations', 'Location'),
			['required' => empty($this->_schoolInformation['SchoolInformation']['is_non_school_organazation'])]
		);

		return $html;
	}

/**
 * 入力部品の出力
 *
 * @param string $field カラム名
 * @param array $extraOptions オプション
 * @param bool $isEditable 更新可能なカラムか否か
 * @return string
 */
	public function inputLocation($field, $extraOptions, $isEditable) {
		$html = '';
		$html .= '<div class="school-information-form-location-input">';
		$html .= $this->__inputCommon($field, $extraOptions, $isEditable);
		$html .= '</div>';
		return $html;
	}

/**
 * 入力部品の出力
 *
 * @param string $field カラム名
 * @param array $extraOptions オプション
 * @param bool $isEditable 更新可能なカラムか否か
 * @return string
 */
	public function inputNumberOfStudents($field, $extraOptions, $isEditable) {
		$html = '';
		$html .= '<div class="school-information-form-group">';
		$html .= $this->__inputCommon($field, $extraOptions, $isEditable);
		$html .= '</div>';
		return $html;
	}

/**
 * 入力部品の出力
 *
 * @param string $field カラム名
 * @param array $extraOptions オプション
 * @param bool $isEditable 更新可能なカラムか否か
 * @return string
 */
	private function __inputCommon($field, $extraOptions, $isEditable) {
		$html = '';

		$methodName = 'label' . ucfirst(Inflector::camelize($field));
		if (method_exists($this->SchoolInformationHtml, $methodName)) {
			$label = $this->SchoolInformationHtml->$methodName();
		} else {
			$label = __d('school_informations', Inflector::humanize($field));
		}

		$defaultOptions = [
			'label' => $label,
			'disabled' => !$isEditable,
			'div' => 'school-information-form-input',
		];
		$options = array_merge($defaultOptions, $extraOptions);

		$html .= $this->NetCommonsForm->input(
			'SchoolInformation.' . $field,
			$options
		);

		$helpMethod = '_help' . ucfirst(Inflector::camelize($field));

		if (method_exists($this, $helpMethod)) {
			$html .= $this->NetCommonsForm->help($this->$helpMethod($options['label'], $isEditable));
		}

		if (in_array($field, SchoolInformation::locationFields(), true) === false &&
				!in_array($field, ['school_name', 'map_url'], true)) {
			$html .= '<div class="col-xs-offset-1 form-inline">';
			$html .= $this->NetCommonsForm->input(
				'SchoolInformation.is_public_' . $field,
				[
					'type' => 'radio',
					//'div' => ['class' => 'form-group form-inline col-xs-offset-1'],
					'div' => ['class' => 'form-radio-outer'],
					'options' => [
						1 => __d('school_informations', 'Public'),
						0 => __d('school_informations', 'Private'),
					]
				]
			);
			$html .= '</div>';
		}

		return $html;
	}

/**
 * 入力部品の出力
 *
 * @param string $field カラム名
 * @param array $options オプション
 * @return string
 */
	public function uploadFile($field, $options) {
		$html = '';

		$html .= '<div class="school-information-form-group">';

		$html .= $this->NetCommonsForm->uploadFile(
			'SchoolInformation.' . $field,
			$options
		);

		$html .= '</div>';
		return $html;
	}

}