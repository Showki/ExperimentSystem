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
}
