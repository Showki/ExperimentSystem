<?php
App::uses('AppModel', 'Model');
/**
 * AnswerResult Model
 *
 * @property PastProblems $PastProblems
 */
class AnswerResult extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'PastProblems' => array(
			'className' => 'PastProblems',
			'foreignKey' => 'past_problems_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public function storeAnswerResult($answer_result,$ansewr_problem){
		$this->save($this->toStoreFormat($answer_result,$ansewr_problem));
	}

	public function toStoreFormat($answer_result,$ansewr_problem){
		$result['past_problems_id'] = $answer_result['id'];
		$result['select_number'] = $answer_result['select_option'];
		$result['correct_number'] = $ansewr_problem['correct_number'];
		$result['type'] = 0;
		if($result['select_number'] === $result['correct_number']){
			$result['result'] = 1;
		}else{
			$result['result'] = 0;
		}
		return $result;
	}

	
}