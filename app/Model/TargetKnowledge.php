<?php
class TargetKnowledge extends AppModel{
	public $useDbConfig = 'make';
	public $name = 'TargetKnowledge';

	public function isUsed($tk_word){
		$tk = $this->find('first',array(
			'conditions' => array(
				'name' => $tk_word),
			'fields' => array('used_flag')
		));
		return $tk['TargetKnowledge']['used_flag'];
	}

	public function fetchId($tk_word){
		$tk = $this->find('first',array(
			'conditions' => array(
				'name' => $tk_word),
			'fields' => array('id')
		));
		return $tk['TargetKnowledge']['id'];
	}

	public function fetchTargetKnowledgeList(){
		$tk_list = $this->find('list',array(
			'fields' => array('name')
		));
		return $tk_list;
	}

	public function toUsed($tk_id){
		$used_tk = array(
			'TargetKnowledge' => array(
			'id' => $tk_id,
			'used_flag' => true,
		));
		$this->save($used_tk);
	}

}