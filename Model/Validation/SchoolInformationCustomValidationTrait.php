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
	public function validateMapUrl($check) {
		$value = array_shift($check);
		if (is_string($value)) {
			return (bool)preg_match('/^' . preg_quote(SchoolInformationConst::MAP_URL, '/') . '/', $value);
		} else {
			return false;
		}
	}

/**
 * カスタムバリデーション
 * 先頭 or 末尾にスペースが入っているかどうか
 *
 * @param Model $model ビヘイビア呼び出し元モデル
 * @param array $check [ カラム名 => 入力値 ]が自動的に入る
 * @return bool バリデート結果
 */
	public function customValidateContainStartEndSpace($check) {
		//$checkは連想配列が入るため、ここで数字キーの配列に変更させて
		//汎用的に扱えるようにする
		$numArray = array_values($check);
		$startEnd = [
			mb_substr($numArray[0], 0, 1, 'utf-8'), //開始
			mb_substr($numArray[0], -1, 1, 'utf-8') //終了
		];

		$spaceDefine = [
			' ',
			'　',
			"\t"
		];
		foreach ($startEnd as $str) {
			if (in_array($str, $spaceDefine, true)) {
				return false;
			}
		}

		return true;
	}

/**
 * カスタムバリデーション
 * $number1、2の合計値が入力値と同一か
 *
 * @param array $check [ カラム名 => 入力値 ]が自動的に入る
 * @param string $number1 数字が入力された値
 * @param string $number2 数字が入力された値
 * @return bool バリデート結果
 */
	public function customValidateEqualCheckAndNumbers($check, $number1, $number2) {
		//汎用的に使えるように、array_valuesで数字キーにしてアクセス
		$total = (int)array_values($check)[0];
		$sum = (int)$this->data[$this->alias][$number1] + (int)$this->data[$this->alias][$number2];
		return $total === $sum;
	}

}
