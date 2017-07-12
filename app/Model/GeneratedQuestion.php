<?php
class GeneratedQuestion extends AppModel{
	public $useDbConfig = 'make';
	public $name = 'GeneratedQuestion';

	public function storeQuestions($questions,$tk_id){
		foreach ($questions as $question) {
			$this->create();
			$this->set(array(
				'target_knowledges_id' => $tk_id,
				'sentence' => $question['sentence'],
				'answer' => $question['answer'],
				'use_knowledge' => $question['use_knowledge'],
				'use_template' => $question['use_template'],
				'type' => 1, //生成した問題
			));
			$this->save();
		}
	}

	public function fetchQuestions($tk_id){
		$questions = $this->find('all',array('conditions' => array(
			'target_knowledges_id' => $tk_id,
			'type' => 1 //生成問題：1，厳選問題：2
			)));
		return $this->changeQuestionIndex($questions);
	}

	public function changeQuestionIndex($questions){
		foreach ($questions as $question) {
			$aligned_id = $question['GeneratedQuestion']['use_knowledge'];
			if(strpos($aligned_id,',') !== false){
				$first_id = explode(',',$aligned_id,-1);
			}else{
				$first_id[0] = $aligned_id;
			}
			$chg_questions[$first_id[0]][] = $question['GeneratedQuestion'];
		}
		if(!empty($chg_questions)){
			return $chg_questions;
		}else{
			return null;
		}
	}



	// 似通っている問題を削除する
	// public function deduplicationQuestions($tk_id){
	// 	$questions = $this->find('all',array('condition' => array('target_knowledges_id' => $tk_id)));

	// 	foreach ($questions as $key => $question) {
	// 		$Questions[$key]['sentence_keywords'] = $this->getKeyphrase($question['sentence']);
	// 		$Qvaguestions[$key]['answer_keywords'] = $this->getKeyphrase($question['answer']);
	// 	}
	// }

}