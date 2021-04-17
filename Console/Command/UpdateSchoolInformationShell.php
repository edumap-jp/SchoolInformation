<?php
/**
 * 学校情報シェル
 *
 * @author   Ryuji AMANO <ryuji@ryus.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('AppShell', 'Console/Command');
App::uses('SiteBuildMngCommandExec', 'SiteBuildManager.Lib');

/**
 * 学校情報シェル
 *
 * @property SchoolInformation $SchoolInformation
 *
 * @package Edumap\SchoolInformations\Console\Command
 */
class UpdateSchoolInformationShell extends AppShell {

/**
 * JSON フォーマット
 *
 * @var int
 */
	const JSON_FORMAT = JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES;

/**
 * use model
 *
 * @var array
 */
	public $uses = [
		'SchoolInformations.SchoolInformation',
	];

/**
 * メイン処理
 *
 * @return void
 */
	public function main() {
		try {
			$this->SchoolInformation->begin();

			$jsonContent = json_decode($this->param('json-content'), true);
			if (! $this->__validateParams($jsonContent)) {
				return false;
			}

			$edumapKey = $jsonContent['school_information']['edumap_key'];
			$schoolInfo = $this->SchoolInformation->getSchoolInformation();

			$schoolInfoAlias = $this->SchoolInformation->alias;
			if (empty($schoolInfo[$schoolInfoAlias]) &&
					$schoolInfo[$schoolInfoAlias]['edumap_key'] !== $edumapKey) {
				$this->err('edumap_keyに対する学校情報がありません');
				return false;
			}

			if ($schoolInfo[$schoolInfoAlias]['modified'] > $jsonContent['school_information']['modified']) {
				//学校サイトの方が新しい場合は、公式サイトの方を更新する
				SiteBuildMngCommandExec::updateSchoolInfo();
				return true;
			}
			if (array_key_exists('modified', $jsonContent['school_information'])) {
				unset($jsonContent['school_information']['modified']);
			}

			$saveData = $jsonContent['school_information'];
			$saveData['id'] = $schoolInfo[$schoolInfoAlias]['id'];

			if (! $this->SchoolInformation->saveSchoolInformation([$schoolInfoAlias => $saveData], false)) {
				$validationErrors = $this->SchoolInformation->validationErrors;
				$this->err(json_encode($validationErrors, self::JSON_FORMAT));
				return false;
			}

			//トランザクションCommit
			$this->SchoolInformation->commit();
		} catch (Exception $ex) {
			//トランザクションRollback
			$this->SchoolInformation->rollback($ex);
		}

		$this->out('<success>学校情報を更新しました</success>');
		return true;
	}

/**
 * 引数の入力チェック
 *
 * @param string|null $jsonContent JSONテキスト
 * @return bool
 */
	private function __validateParams($jsonContent) {
		if (! $jsonContent) {
			$this->err('jsonテキストではありません');
			return false;
		}
		if (empty($jsonContent['school_information'])) {
			$this->err('フォーマットが異なります');
			return false;
		}
		if (empty($jsonContent['school_information']['edumap_key'])) {
			$this->err('edumap_keyが含まれていません');
			return false;
		}
		if (empty($jsonContent['school_information']['modified'])) {
			$this->err('modifiedが含まれていません');
			return false;
		}
		return true;
	}

/**
 * ヘルプオプションの取得
 *
 * @return ConsoleOptionParser
 */
	public function getOptionParser() {
		$optionParser = parent::getOptionParser();
		$optionParser->description('学校情報の更新')
			->addOption(
				'json-content',
				[
					'help' => 'JSONテキスト',
					'required' => true,
				]
			);
		return $optionParser;
	}

}