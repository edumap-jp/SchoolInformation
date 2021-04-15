<?php
/**
 * SchoolInformationFormHelper.php
 *
 * @author   Ryuji AMANO <ryuji@ryus.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
App::uses('AppHelper', 'View');

/**
 * Class SchoolInformationFormHelper
 *
 * @property NetCommonsFormHelpr $NetCommonsForm
 */
class SchoolInformationFormHelper extends AppHelper {

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
 * @param string $key キー項目
 * @param string|array $field カラム名
 * @return string
 */
	public function input($key, $field) {
		$html = '';

		$extraOptions = [];
		if (is_array($field)) {
			// keyがフィールド名で $fieldがオプション
			$extraOptions = $field;
			$field = $key;
		}
		$defaultOptions = [
			'label' => __d('school_informations', Inflector::humanize($field)),
		];
		$options = array_merge($defaultOptions, $extraOptions);
		$html .= $this->NetCommonsForm->input(
			'SchoolInformation.' . $field,
			$options
		);

		if (in_array($field, SchoolInformation::locationFields(), true) === false) {
			$html .= '<div class="col-xs-offset-1 form-group form-inline">';
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

}