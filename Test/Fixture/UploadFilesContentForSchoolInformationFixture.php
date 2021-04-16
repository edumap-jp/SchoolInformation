<?php
/**
 * UploadFilesContentForSchoolInformationFixture.php
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('UploadFilesContentFixture', 'Files.Test/Fixture');

/**
 * UploadFilesContentForSchoolInformationFixture
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\SchoolInformations\Test\Fixture
 */
class UploadFilesContentForSchoolInformationFixture extends UploadFilesContentFixture {

/**
 * Model name
 *
 * @var string
 */
	public $name = 'UploadFilesContent';

/**
 * Full Table Name
 *
 * @var string
 */
	public $table = 'upload_files_contents';

/**
 * Records
 *
 * @var array
 */
	public $records = [
		[
			'id' => '1',
			'plugin_key' => 'school_informations',
			'content_id' => '1',
			'upload_file_id' => '1',
		],
		[
			'id' => '2',
			'plugin_key' => 'school_informations',
			'content_id' => '1',
			'upload_file_id' => '2',
		],
	];

}
