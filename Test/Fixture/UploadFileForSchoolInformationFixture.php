<?php
/**
 * UploadFileForSchoolInformationFixture.php
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('UploadFileFixture', 'Files.Test/Fixture');

/**
 * UploadFileForSchoolInformationFixture
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\SchoolInformations\Test\Fixture
 */
class UploadFileForSchoolInformationFixture extends UploadFileFixture {

/**
 * Model name
 *
 * @var string
 */
	public $name = 'UploadFile';

/**
 * Full Table Name
 *
 * @var string
 */
	public $table = 'upload_files';

/**
 * Records
 *
 * @var array
 */
	public $records = [
		[
			'id' => '1',
			'plugin_key' => 'school_informations',
			'content_key' => '',
			'field_name' => 'school_badge',
			'original_name' => '181x1141.png',
			'path' => 'school_badge',
			'real_file_name' => '181x1141.png',
			'extension' => 'png',
			'mimetype' => 'image/png',
			'size' => 287060,
			'download_count' => 1,
			'total_download_count' => 1,
			'room_id' => '1',
			'block_key' => null,
		],
		[
			'id' => '2',
			'plugin_key' => 'school_informations',
			'content_key' => '',
			'field_name' => 'cover_picture',
			'original_name' => '181x1141.png',
			'path' => 'cover_picture',
			'real_file_name' => '181x1141.png',
			'extension' => 'png',
			'mimetype' => 'image/png',
			'size' => 287060,
			'download_count' => 1,
			'total_download_count' => 1,
			'room_id' => '1',
			'block_key' => null,
		],
	];

}
