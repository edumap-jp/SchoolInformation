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
 */
class SchoolInformationFormHelper extends AppHelper {

	use SchoolInformationFormHelpTrait;

/**
 * 使用するヘルパー
 *
 * @var array
 */
	public $helpers = [
		'NetCommons.NetCommonsForm'
	];

/**
 * 入力部品の出力
 *
 * @param string $field カラム名
 * @param array $extraOptions オプション
 * @param bool $isUpdatable 更新可能なカラムか否か
 * @return string
 */
	public function input($field, $extraOptions, $isUpdatable) {
		$html = '';
		$html .= '<div class="school-information-form-group">';
		$html .= $this->__inputCommon($field, $extraOptions, $isUpdatable);
		$html .= '<hr>';
		$html .= '</div>';
		return $html;
	}

/**
 * 入力部品の出力
 *
 * @param string $field カラム名
 * @param array $extraOptions オプション
 * @param bool $isUpdatable 更新可能なカラムか否か
 * @return string
 */
	public function inputLocation($field, $extraOptions, $isUpdatable) {
		$html = '';
		$html .= '<div class="school-information-form-location-input">';
		$html .= $this->__inputCommon($field, $extraOptions, $isUpdatable);
		$html .= '</div>';
		return $html;
	}

/**
 * 入力部品の出力
 *
 * @param string $field カラム名
 * @param array $extraOptions オプション
 * @param bool $isUpdatable 更新可能なカラムか否か
 * @return string
 */
	public function inputNumberOfStudents($field, $extraOptions, $isUpdatable) {
		$html = '';
		$html .= '<div class="school-information-form-group">';
		$html .= $this->__inputCommon($field, $extraOptions, $isUpdatable);
		$html .= '</div>';
		return $html;
	}


/**
 * 入力部品の出力
 *
 * @param string $field カラム名
 * @param array $extraOptions オプション
 * @param bool $isUpdatable 更新可能なカラムか否か
 * @return string
 */
	private function __inputCommon($field, $extraOptions, $isUpdatable) {
		$html = '';

		$defaultOptions = [
			'label' => __d('school_informations', Inflector::humanize($field)),
			'disabled' => !$isUpdatable,
			'div' => 'school-information-form-input',
		];
		$options = array_merge($defaultOptions, $extraOptions);

		$html .= $this->NetCommonsForm->input(
			'SchoolInformation.' . $field,
			$options
		);

		$helpMethod = '_help' . ucfirst(Inflector::camelize($field));

		if (method_exists($this, $helpMethod)) {
			$html .= $this->NetCommonsForm->help($this->$helpMethod($options['label'], $isUpdatable));
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