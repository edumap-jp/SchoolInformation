<?php
/**
 * edumap API設定
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

$releaseType = Configure::read('RELEASE_TYPE', 'DEVELOPMENT');

switch ($releaseType) {
	case 'RELEASE_SAKURA':
		//本番(edumap.jp)
		$allowIps = '192.168.11.5|133.242.55.199'; //データ管理サーバ
		$allowIps .= '|123.226.229.113'; //NaKaZii
		break;
	case 'DEVELOP_SAKURA':
		//開発さくらクラウド(dev.edumap.jp.jp)
		$allowIps = '192.168.254.20'; //データ管理サーバ
		$allowIps .= '|123.226.229.113'; //NaKaZii
		break;
	default:
		//ローカル開発
		$allowIps = '10.0.0.0/20';
}

$config['edumap_api']['SchoolInformations']['allow_ips'] = $allowIps;