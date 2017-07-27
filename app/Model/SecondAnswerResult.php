<?php
App::uses('AppModel', 'Model');
/**
 * SecondSecondAnswerResult Model
 *
 */
class SecondAnswerResult extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'users_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'problems_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'select_number' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'result' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	public $belongsTo = array(
		'SecondMadeProblems' => array(
			'className' => 'SecondMadeProblems',
			'foreignKey' => 'second_made_problems_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public function storeSecondAnswerResult($answer_result,$ansewr_problem){
		$this->save($this->toStoreFormat($answer_result,$ansewr_problem));
	}

	public function toStoreFormat($answer_result,$ansewr_problem){
		$result['users_id'] = $this->__getCurrentUserId();
		$result['second_made_problems_id'] = $answer_result['id'];
		$result['select_number'] = $answer_result['select_option'];
		if($result['select_number'] === $ansewr_problem['correct_number']){
			$result['result'] = 1;
		}else{
			$result['result'] = 0;
		}
		$result_id = $this->find('first',array(
			'conditions' => array(
				'SecondAnswerResult.users_id' => $this->__getCurrentUserId(),
				'SecondAnswerResult.second_made_problems_id' => $answer_result['id']
			),
			'fields' => array('id'),
		));
		if(!empty($result_id)){
			$result['id'] = $result_id['SecondAnswerResult']['id'];
		}
		return $result;
	}

	public function getSecondAnswerResult(){
		$answer_results = $this->find('all',array(
			'conditions' => array(
				'SecondAnswerResult.users_id' => $this->__getCurrentUserId(),
			),
		));
		foreach ($answer_results as $key => $result) {
			$formated_result[$key] 	= $this->toShowFormat($result);
		}
		return $formated_result;
	}

	public function toShowFormat($result){
		$selected_number = $result['SecondAnswerResult']['select_number'];
		$selected_option = $result['SecondMadeProblems']["option_".$selected_number];
		$sentence = $result['SecondMadeProblems']['sentence'];	
		$id = $result['SecondAnswerResult']['id'];

		return compact('id','sentence','selected_number','selected_option');
	}

}
