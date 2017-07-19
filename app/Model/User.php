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

	public function setTheme($team,$themes){
		$theme_count = 0; 
		foreach ($team as $user_count => &$user) {
			if($theme_count < 30){
				$user['User']['theme_1'] = $themes[$theme_count]['Theme']['name']."：".$theme_count;
				$theme_count += 1;
			}else{
				$user['User']['theme_1'] = $themes[0]['Theme']['name']."："."0";
				$theme_count = 1;
			}
		}
		foreach ($team as $key => &$user) {
			if($theme_count < 30){
				$user['User']['theme_2'] = $themes[$theme_count]['Theme']['name']."：".$theme_count;
				$theme_count += 1;
			}else{
				$user['User']['theme_2'] = $themes[0]['Theme']['name']."："."0";
				$theme_count = 1;
			}
		}
		foreach ($team as $key => &$user) {
			if($theme_count < 30){
				$user['User']['theme_3'] = $themes[$theme_count]['Theme']['name']."：".$theme_count;
				$theme_count += 1;
			}else{
				$user['User']['theme_3'] = $themes[0]['Theme']['name']."："."0";
				$theme_count = 1;
			}
		}
		return $this->saveAll($team);
	}

	public function setPoints(){
		$users = $this->find('all',array('fields' => array('id')));
		foreach ($users as $key => &$user) {
			$users[$key]['User']['points'] = rand(5,25);
			$users[$key]['User']['times'] = 30;
		}
		return $this->saveAll($users);
	}
	
	public function passHash(){
		$users = $this->find('all',array('fields' => array('id','student_number')));
		foreach ($users as $key => &$user) {
			$user['User']['password'] = $user['User']['student_number'];
		}
		return $this->saveAll($users);
	}

}
