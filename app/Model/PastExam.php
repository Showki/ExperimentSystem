<?php
class PastExam extends AppModel{
    public $useDbConfig = 'make';
    public $name = 'PastExam';

    public function fetchQuestions($exam_id_list){
        foreach ($exam_id_list as $id) {
            $q_tmp = $this->find('first',array(
                'conditions' => array(
                    'id' => (int)$id
                )
            ));
            $q_tmp['PastExam']['description']['year']   = 12+(int)substr($q_tmp['PastExam']['id'],2,2);
            $q_tmp['PastExam']['description']['grade']  = (int)substr($q_tmp['PastExam']['id'],4,1);
            $q_tmp['PastExam']['description']['number'] = (int)substr($q_tmp['PastExam']['id'],5,3);
            $questions[] = $q_tmp['PastExam'];
        }
        return $questions;
    }
}