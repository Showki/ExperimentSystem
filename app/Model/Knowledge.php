<?php
class Knowledge extends AppModel{
    public $useDbConfig = 'make';
	public $name = 'Knowledge';

    public function loadKeywords($categories){
        // キーワードに該当する対象知識の全てのレコード（オブジェクトのみ）を抽出
        foreach ($categories as $category) {
            $result_sach[] = $this->find('all',array(
                'conditions' => array('level_flag' => '1','categories_id' => $category['id']),
                'fields' => array('object')
            ));
        }
        $keywords = $this->toFlat($result_sach,'object');
        foreach ($keywords as $key => $keyword) {
            $arrange[$key] = $keyword['object'];
        }
        return $this->uniqueIndex($arrange);
    }

    public function fetchExamId($tk_word){
        $src_id_tmp = $this->find('list',array(
            'conditions' => array(
                'target_knowledge' => $tk_word
            ),
            'fields' => array(
                'resources_id'
            )
        ));
        return $this->uniqueIndex($src_id_tmp);
    }

    // public function getKeywordsList($category_id,$input_text){
    //     if($category_id){
    //         // $objects = $this->fetchObject();
    //         $keywords = $this->getKeywords($category_id);

    //     }
    // }

    // public function getKeywords($category_id){
    //     $this->find('all',array(
    //         'conditions' => array('categories_id')
    //     ))
    // }

	public function loadObject(){
		$object_list = $this->find('list',array(
            'fields' => array('Knowledge.object'),
            'conditions' => array(
                'Knowledge.level_flag' => 1)
        ));
        if (empty($object_list))
            return null;
        // 検索結果の重複を除去
        $removed_duplicate_list = $this->uniqueIndex($object_list);
        return $removed_duplicate_list;
	}

	public function fetchKeywordFromInput($input){
        // 入力されたキーワードで検索
        $input_in_searched_list = $this->find('list',array(
            'fields' => array('Knowledge.object'),
            'conditions' => array(
                'Knowledge.object like' => "%".$input."%",
                'Knowledge.level_flag' => 1)
        ));
        if (empty($input_in_searched_list))
            return null;
        if (empty($input))
            return null;
        // 検索結果の重複を除去
        return $this->uniqueIndex($input_in_searched_list);
	}

    public function loadKnowledge($selected_keyword){
        $searched_knowledge = $this->find('all',array(
            'conditions' => array(
                'OR' => array(
                    'Knowledge.object' => $selected_keyword,
                    'Knowledge.target_knowledge' => $selected_keyword)
            )
        ));
        return $searched_knowledge;
    }
}
?>
