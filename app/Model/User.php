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

	public function addTestUsers(){
		for ($i=1; $i<=100 ; $i++) { 
			$test_users['User'][$i]['password'] = "test";
			$test_users['User'][$i]['points'] = rand(0,40);
			switch (strlen($i)) {
				case 1:
					$under_num = "00".$i;
					break;
				case 2:
					$under_num = "0".$i;
					break;
				default:
					$under_num = $i;
					break;
			}
			$test_users['User'][$i]['student_number'] = "0312017".$under_num;
			$test_users['User'][$i]['name'] = "テストユーザ".$under_num;
		}
		$this->saveAll($test_users['User']);
		return true;
	}
}
