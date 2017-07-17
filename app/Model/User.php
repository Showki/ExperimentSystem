<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

/**
 * User Model
 *
 */
class User extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'student_number' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	
	public function beforeSave($options = Array()) {
    	if (isset($this->data['User']['password'])) {
        	$passwordHasher = new BlowfishPasswordHasher();
        	$this->data['User']['password'] = $passwordHasher->hash($this->data['User']['password']);
    	}
    	return true;
	}

	public function assignTeam($users){
		$team_num = 0;
		foreach ($users as $key => $user) {
			$team_num ^= 1;
			$team = ($team_num == 1) ? "A" : "B";
			$assigned_user['User'][$key]['id'] = $user['User']['id'];
			$assigned_user['User'][$key]['team'] = $team;
		}
		return $this->saveAll($assigned_user['User']);
	}
}
