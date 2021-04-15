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

}
