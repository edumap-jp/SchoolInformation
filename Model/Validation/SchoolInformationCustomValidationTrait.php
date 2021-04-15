<?php
/**
 * SchoolInformationCustomValidation.php
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('SchoolInformationConst', 'SchoolInformations.Model');

/**
 * SchoolInformationCustomValidation
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\SchoolInformations\Model\Validation
 */
trait SchoolInformationCustomValidationTrait {

/**
 * 地図URLのバリデーション
 *
 * @param array $check チェック値
 * @return bool
 */
	public function matchMapUrl($check) {
		$value = array_shift($check);
		if (is_string($value)) {
			return (bool)preg_match('/^' . preg_quote(SchoolInformationConst::MAP_URL, '/') . '/', $value);
		} else {
			return false;
		}
	}
}
