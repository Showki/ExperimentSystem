<?php
App::uses('AppController', 'Controller');
class MakesController extends AppController {
	public $uses = array(
		'User','Knowledge','Template','Question','Activity','Category',
		'TargetKnowledge','GeneratedQuestion','GeneratedWord','PastExam',
	);

	public function index(){
		return $this->redirect(array('action' => 'selectMode'));
	}

	public function selectMode(){
		// $this->storeActivity("問題作成機能｜");
	}

	public function inputWord(){
		// $this->storeActivity("問題作成機能｜キーワード入力による検索｜");
	}

	public function selectCategories(){
		// $this->storeActivity("問題作成機能｜カテゴリによる検索｜");
		$categories = $this->Category->find('all');
		$this->set(compact('categories'));
	}

	public function showKeywords($category_id=null){
		if($category_id){
			$end_tree_categories = $this->Category->fetchEndCategories($category_id);
			$categories = $this->Category->toFlat($end_tree_categories,'id');
			$select_category = $this->Category->fetchCategory($category_id);
			$keywords = $this->Knowledge->loadKeywords($categories);

			// $this->storeActivity("問題作成機能｜カテゴリによる検索->選択：".$select_category."｜");
		}else{
			if(empty($this->request->data['Make']['input_word']))
				return $this->redirect(array('action' => 'selectMode'));

			$word = $this->request->data['Make']['input_word'];
			$keywords = $this->Knowledge->fetchKeywordFromInput($word);
			// $this->storeActivity("問題作成機能｜キーワード入力による検索->入力：".$word."｜");
		}

		if(!isset($keywords)){
			$this->Session->setFlash(__('検索結果が 0件であったため、検索画面に戻ります'));
			$this->redirect(array('controller'=>'makes','action'=>'inputWord'));
		}else{
			// $this->storeActivity("問題作成機能｜キーワード一覧｜");
			$this->set(compact('keywords'));
		}
	}

	public function generateQuestions($tk_word){
		$this->autoRender = false;

		if(empty($tk_word))
			return $this->redirect(array('action' => 'selectMode'));

		$used_flg 	= $this->TargetKnowledge->isUsed($tk_word);
		$tk_id 		= $this->TargetKnowledge->fetchId($tk_word);

		// $this->storeActivity("問題作成機能｜キーワード一覧->選択：".$tk_word."｜");

		if($used_flg === false){
			// 問題生成
			$knowledge 	= $this->Knowledge->loadKnowledge($tk_word);
			$tk_list 	= $this->TargetKnowledge->fetchTargetKnowledgeList();
			$questions 	= $this->Template->generateQuestions($knowledge,$tk_list);
			
			// 生成問題登録
			$this->GeneratedQuestion->storeQuestions($questions,$tk_id);

			// 生成済みフラグをtrueへ
			$this->TargetKnowledge->toUsed($tk_id);
		}
		$this->redirect(array('controller'=>'makes','action'=>'selectTemplate',$tk_word));
	}

	public function selectTemplate($tk_word){
		$templates = $this->Template->find('all');
		// $this->storeActivity("問題作成機能｜キーワード一覧->選択：".$tk_word."｜テンプレート一覧｜");
		$this->set(compact('templates','tk_word'));
	}

	public function showQuestions($tk_word,$tmpl_id){
		if(empty($tk_word)||empty($tmpl_id))
			return $this->redirect(array('action' => 'selectMode'));

		$tk_id 					= $this->TargetKnowledge->fetchId($tk_word);
		$generated_questions 	= $this->GeneratedQuestion->fetchQuestions($tk_id,$tmpl_id);
		
		$exam_id_list 			= $this->Knowledge->fetchExamId($tk_word);
		$exam_questions 		= $this->PastExam->fetchQuestions($exam_id_list);

		// $this->storeActivity("問題作成機能｜キーワード一覧->選択：".$tk_word."｜テンプレート一覧->選択：".$tmpl_id."｜");

		$this->set(compact('generated_questions','exam_questions','tk_word'));
	}

	public function editQuestion($question_id){
		$question = $this->GeneratedQuestion->findById($question_id);

		// $this->storeActivity("問題作成機能｜生成問題一覧->選択：".$question_id."｜");

		$this->set(compact('question','question_id'));
	}

	public function storeQuestion(){
		if(empty($this->request->data['edit_confirm']))
			return $this->redirect(array('action' => 'selectMode'));
		$store_question['Question'] = $this->request->data['Edit'];
		$store_question['Question']['user_id'] = $this->Auth->user('id');
		$this->Question->save($store_question);
		$stored_question_id = $this->Question->getLastInsertId();

		// $this->storeActivity("問題作成機能｜生成問題一覧->編集：".$stored_question_id."｜");
		$this->redirect(array('controller' => 'histories','action' => 'showMyQuestions'));
	}
}
