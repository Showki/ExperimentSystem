<?php
class Category extends AppModel{
	public $useDbConfig = 'make';
    public $name = 'Category';

    public function fetchEndCategories($category_id){
        $category = $this->find('first',array('conditions' => array('id' => $category_id)));
        $children = $this->find('all',array('conditions' => array('parent_id' => $category['Category']['id'])));
        if(!empty($children)){
            foreach ($children as $key => $child){
                $result[$child['Category']['id']] = $this->fetchEndCategories($child['Category']['id']);
            }
        }else{
            $result = $category['Category'];
        }
        return $result;
    }

    public function fetchCategory($category_id){
        $category = $this->findById($category_id);
        return $category['Category']['categoryies_name'];
    }

}
?>
