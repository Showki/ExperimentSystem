<?php
App::uses('AppController', 'Controller');
class MakesController extends AppController {
	public $components = array('Paginator', 'Session', 'Flash');
	public $uses = array(
		'User','Knowledge','Template','Question','Activity','Category',
		'TargetKnowledge','GeneratedQuestion','GeneratedWord','PastExam',
	);

	public function index(){
		// return $this->redirect(array('action' => 'selectMode'));
	}

	// 本実験で不要の機能
	// public function selectMode(){
	// 	// $this->storeActivity("問題作成機能｜");
	// }

	// 問題自動生成機能
	public function inputWord(){
		// $this->storeActivity("問題作成機能｜キーワード入力による検索｜");
	}

	// 本実験で不要の機能
	// public function selectCategories(){
	// 	// $this->storeActivity("問題作成機能｜カテゴリによる検索｜");
	// 	$categories = $this->Category->find('all');
	// 	$this->set(compact('categories'));
	// }

	public function showKeywords(){
		if(empty($this->request->data['Make']['input_word']))
			return $this->redirect(array('action' => 'inputWord'));	

		$word = $this->request->data['Make']['input_word'];
		$keywords = $this->Knowledge->fetchKeywordFromInput($word);
		// $this->storeActivity("問題作成機能｜キーワード入力による検索->入力：".$word."｜");
		
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

		$used_flg = $this->TargetKnowledge->isUsed($tk_word);
		$tk_id = $this->TargetKnowledge->fetchId($tk_word);

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
		$this->redirect(array(
			'controller'=>'makes',
			'action'=>'showQuestions',$tk_word
		));
		
	}

	public function showQuestions($tk_word){
		if(empty($tk_word))
			return $this->redirect(array('action' => 'selectMode'));

		$tk_id 					= $this->TargetKnowledge->fetchId($tk_word);
		// テンプレートで絞込している箇所
		$generated_questions 	= $this->GeneratedQuestion->fetchQuestions($tk_id);
		
		$exam_id_list 			= $this->Knowledge->fetchExamId($tk_word);
		$exam_questions 		= $this->PastExam->fetchQuestions($exam_id_list);

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

		$this->loadModel('MadeProblem');
		$store_question['MadeProblem'] = $this->request->data['Edit'];
		$store_question['MadeProblem']['user_id'] = $this->Auth->user('id');
		$this->MadeProblem->save($store_question);

		// $stored_question_id = $this->Question->getLastInsertId();
		// $this->storeActivity("問題作成機能｜生成問題一覧->編集：".$stored_question_id."｜");
		// $this->redirect(array('controller' => 'histories','action' => 'showMadeQuestionss'));
	}

	public function makeManualQuestion(){
		if ($this->request->is('post')) {
			$this->loadModel('MadeProblem');
			$this->MadeProblem->create();
			$this->request->data['MadeProblem']['user_id'] = $this->Auth->user('id');
			if ($this->MadeProblem->save($this->request->data)) {
				$this->Flash->success(__('登録完了しました．'));
				return $this->redirect(array('action' => 'showMadeQuestions'));
			} else {
				$this->Flash->error(__('登録失敗しました．やり直しましょう．'));
			}
		}
		// $answerResult = $this->AnswerResult->find('list');
		// $this->set(compact('answerResult'));

	}

	public function showMadeQuestions(){
		$this->loadModel('MadeProblem');
		$made_problems = $this->MadeProblem->find('all',array(
			'conditions' => array('MadeProblem.user_id' => $this->Auth->user('id')),
		));
		$made_problems = Set::extract('/MadeProblem/.',$made_problems);
		debug($made_problems);
		$this->set(compact('made_problems'));
	}

    public function editMadeQuestion($problem_id){
		$this->loadModel('MadeProblem');
		if ($this->request->is('post')) {
			$this->MadeProblem->create();
			if ($this->MadeProblem->save($this->request->data)) {
				$this->Flash->success(__('更新されました．'));
				return $this->redirect(array('action' => 'showMadeQuestions'));
			} else {
				$this->Flash->error(__('更新失敗しました．やり直してください．'));
			}
		}
		$problem = $this->MadeProblem->findById($problem_id);
		$this->set(compact('problem','problem_id'));		
	}
	
    public function deleteMadeQuestion($question_id=null){
        $this->autoRender = false;
        if($question_id === null)
            return $this->redirect(array('action' => 'showMadeQuestions'));
		$this->loadModel('MadeProblem');
        $this->MadeProblem->delete($question_id);
        return $this->redirect(array('action' => 'showMadeQuestions'));
    }


}
