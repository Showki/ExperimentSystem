<?php
class Question extends AppModel{
	public $useDbConfig = 'make';
	public $name = 'Question';
	public function fetchMadeQuestionsList($user_id){
		$list = $this->find('all',array(
			'conditions' => array(
				'Question.user_id' => $user_id,
				)));
		return $list;
	}
	public function fetchOtherQuestions($users){
		foreach ($users as $user) {
			$questions[$user['name']] = $this->find('all',array(
				'conditions' => array(
				'Question.user_id' => $user['id'],
				),
				'order' => array('Question.created' => 'desc')
			));
		}
		return $questions;
	}
}
?>
