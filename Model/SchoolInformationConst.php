<?php
/**
 * SchoolInformationConst.php
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */


/**
 * SchoolInformationConst
 *
 * @method string REGEXP_ALPHANUMERIC_SYMBOLS()
 * @method string REGEXP_ALPHANUMERIC_ALL_SYMBOLS()
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\SchoolInformations\Model
 */
class SchoolInformationConst {

/**
 * 所在地のカラムリスト
 *
 * @var array
 */
	const LOCATION_FIELDS = [
		'postal_code',
		'prefecture_code',
		'city_code',
		'city',
		'address'
	];

/**
 * 空値の場合、nullに変換するカラムリスト
 *
 * @var array
 */
	const CONV_NULL_IF_EMPTY_FIELDS = [
		'seismic_work',
		'designation_of_shelter',
	];

/**
 * 地図URL
 *
 * @var string
 */
	const MAP_URL = 'https://www.google.com/maps/embed';

/**
 * 海外の県コード
 *
 * @var array
 */
	const FOREIGN_COUNTRY = [
		'PREFECTURE_CODE' => '99',
		'CITY_CODE' => '999999',
		'POSTAL_CODE' => '9999999',
		'NAME' => '(海外)',
		'NAME_EN' => 'Foreign country'
	];

/**
 * 全角カタカナ、全半角スペースのみOKの正規表現
 *
 * @var string
 */
	const REGEXP_KATAKANA = '/\A[ァ-ヾ０-９ 　]+\z/u';

/**
 * 学校名（英語表記）で使える記号
 *
 * @var string
 */
	const ALLOW_SYMBOLS = '&\',-.・';

/**
 * 日本の郵便番号のみヒット（ハイフンなし）
 *
 * 郵便番号は7桁
 * https://www.post.japanpost.jp/zipcode/zipmanual/p04.html
 * @var string
 */
	const REGEXP_JP_POST_CODE = '/\A[0-9]{7}\z/';

/**
 * 正規表現
 * メールアドレスをヒット
 * RFCに準拠していない(..や..@などdocomoやau系)メールアドレス
 *
 * @var string
 */
//@codingStandardsIgnoreStart
	const REGEXP_EMAIL = '/^[a-z0-9\.!#$%&\'*+\/=?^_`{|}~-]+(?:[a-z0-9\.!#$%&\'*+\/=?^_`{|}~-]+)*@(?:[_\p{L}0-9][-_\p{L}0-9]*\.)*(?:[\p{L}0-9][-\p{L}0-9]{0,62})\.(?:(?:[a-z]{2}\.)?[a-z]{2,})$/i';
//@codingStandardsIgnoreEnd

/**
 * 日本の電話番号かどうかの正規表現
 * 市外局番、090、080、070、050に対応
 *
 * [5789]に数字を追加すれば、0X0に対応可能
 * 正規表現を改行してもいいか不明なため、無視
 * @var string
 */
//@codingStandardsIgnoreStart
	const REGEXP_JP_PHONE_NUMBER = '/^(?=(?:(?:\d+\-)?\d+\-\d+|(?:\d+)?\(\d+\)\d+))(?=(?=^(?:(?:0[346]\D)?\D?[2-9][0-9]{3}\D\d{4}|(?:0[1-9][1-9]\D)?\D?[2-9][0-9]{2}\D\d{4}|(?:0[1-9][1-9][0-9]\D)?\D?[2-9][0-9]\D\d{4}|(?:0[1-9][1-9][0-9]{2}\D)?\D?[2-9]\D\d{4})$|^0120\-(?:\d{3}\-\d{3}|\d{2}\-\d{4})$|^0[5789]0\-(?:[0-9]{3}\-\d{5}|\d{4}\-\d{4})$))(?:(\d+)\D)?\D?(\d+)\D(\d+)$/';
//@codingStandardsIgnoreEnd

/**
 * 年月
 *
 * @var string
 */
	const REGEXP_MONTH = '/(^19[0-9]{2}|20[0-3][0-9])\-(0[0-9]|1[0-2])$/';

/**
 * PHPマジックメソッド
 * 定数定義が不可能な値を定数みたく定義する
 *
 * @param string $name 関数名
 * @param array $arguments 引数
 * @return mixed
 * @throws InvalidArgumentException
 */
	public static function __callStatic($name, $arguments) {
		switch($name) {
			//英字数字記号（「&」「\」「'」「,」「-」「.」「・」）半角スペースオンリーの正規表現
			//学校名（英語表記）で使われる
			//商号に数字や記号が使えるとのこと 参考：http://www.moj.go.jp/MINJI/minji44.html
			case 'REGEXP_ALPHANUMERIC_SYMBOLS':
				return '/\A[a-z\d\s' . self::ALLOW_SYMBOLS . ']+\z/i';
			case 'REGEXP_ALPHANUMERIC_ALL_SYMBOLS':
				return '/\A[a-z\d\s' . preg_quote('_-<>,.$%#@!\\\'"+&?=~:;|][()*^{}/', '/') . ']+\z/i';
			//ヒットしなければ、例外発生させる
			default:
				throw new InvalidArgumentException('Not defined constant.');
		}
	}
}
