<?php
/**
 * SchoolInformationFrameSetting Model
 *
 * @property Block $Block
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('SchoolInformationsAppModel', 'SchoolInformations.Model');

/**
 * SchoolInformationFrameSetting Model
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\SchoolInformations\Model
 */
class SchoolInformationFrameSetting extends SchoolInformationsAppModel {

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array();

	/**
	 * belongsTo associations
	 *
	 * @var array
	 */
	public $belongsTo = array(
		'Frame' => array(
			'className' => 'Frames.Frame',
			'foreignKey' => 'frame_key',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

	/**
	 * Called during validation operations, before validation. Please note that custom
	 * validation rules can be defined in $validate.
	 *
	 * @param array $options Options passed from Model::save().
	 * @return bool True if validate operation should continue, false to abort
	 * @link http://book.cakephp.org/2.0/en/models/callback-methods.html#beforevalidate
	 * @see Model::save()
	 */
	public function beforeValidate($options = array()) {
		$this->validate = array_merge(
			$this->validate,
			array(
				'frame_key' => array(
					'notBlank' => array(
						'rule' => array('notBlank'),
						'message' => __d('net_commons', 'Invalid request.'),
						'required' => true,
					)
				),
			)
		);
		return parent::beforeValidate($options);
	}

	/**
	 * Get SchoolInformationFrameSetting data
	 *
	 * @return array SchoolInformationFrameSetting data
	 */
	public function getSchoolInformationFrameSetting($layoutPosition) {
		$conditions = array(
			'frame_key' => Current::read('Frame.key')
		);

		$frameSetting = $this->find(
			'first',
			array(
				'recursive' => -1,
				'conditions' => $conditions,
			)
		);

		if (!$frameSetting) {
			// まだフレーム設定がないときのデフォルト
			$default = $this->__defaultSettingByLayoutPosition($layoutPosition);
			$default['frame_key'] = Current::read('Frame.key');
			$frameSetting = $this->create($default);
		}

		return $frameSetting;
	}

	private function __defaultSettingByLayoutPosition($layoutPosition) {
		// デフォルトで表示なのでここでは非表示にする項目をリストしてる
		$hide = [];
		switch ($layoutPosition) {
			case 'header':
				$hide = [
					//'is_display_school_name_kana',
					//'is_display_school_name_roma',
					'is_display_principal_name',
					'is_display_principal_name_roma',
					'is_display_school_type',
					'is_display_school_kind',
					'is_display_student_category',
					'is_display_establish_year_month',
					'is_display_close_year_month',
					'is_display_location',
					'is_display_tel',
					'is_display_fax',
					'is_display_email',
					'is_display_emergency_contact',
					'is_display_contact',
					'is_display_url',
					'is_display_number_of_male_students',
					'is_display_number_of_female_students',
					'is_display_number_of_faculty_members',
				];
				break;
			case 'major':
			case 'minor':
				$hide = [
					'is_display_school_name_kana',
					'is_display_school_name_roma',
					'is_display_principal_name',
					'is_display_principal_name_roma',
					'is_display_school_type',
					'is_display_school_kind',
					'is_display_student_category',
					'is_display_establish_year_month',
					'is_display_close_year_month',
					//'is_display_location',
					//'is_display_tel',
					//'is_display_fax',
					//'is_display_email',
					'is_display_emergency_contact',
					'is_display_contact',
					'is_display_url',
					'is_display_number_of_male_students',
					'is_display_number_of_female_students',
					'is_display_number_of_faculty_members',
				];
				break;
			case 'main':
				break;
			case 'footer':
				$hide = [
					'is_display_school_name_kana',
					'is_display_school_name_roma',
					'is_display_principal_name',
					'is_display_principal_name_roma',
					'is_display_school_type',
					'is_display_school_kind',
					'is_display_student_category',
					'is_display_establish_year_month',
					'is_display_close_year_month',
					//'is_display_location',
					//'is_display_tel',
					//'is_display_fax',
					//'is_display_email',
					'is_display_emergency_contact',
					'is_display_contact',
					'is_display_url',
					'is_display_number_of_male_students',
					'is_display_number_of_female_students',
					'is_display_number_of_faculty_members',
				];
				break;
		}
		$default = [];
		foreach ($hide as $hideField) {
			$default[$hideField] = false;
		}

		return $default;
	}

	/**
	 * Save SchoolInformationFrameSetting
	 *
	 * @param array $data received post data
	 * @return mixed On success Model::$data if its not empty or true, false on failure
	 * @throws InternalErrorException
	 */
	public function saveSchoolInformationFrameSetting($data) {
		$this->loadModels(
			[
				'SchoolInformationFrameSetting' => 'SchoolInformations.SchoolInformationFrameSetting',
			]
		);

		//トランザクションBegin
		$this->begin();

		//バリデーション
		$this->set($data);
		if (!$this->validates()) {
			$this->rollback();
			return false;
		}

		try {
			//登録処理
			if (!$this->save(null, false)) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}
			//トランザクションCommit
			$this->commit();

		} catch (Exception $ex) {
			//トランザクションRollback
			$this->rollback($ex);
		}

		return true;
	}
}
