<?php
App::uses('AppController', 'Controller');
/**
 * PastProblems Controller
 *
 * @property PastProblem $PastProblem
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class PastProblemsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Flash');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->layout = 'experiment';
        $year = array(
            "2012" => "H24",
            "2013" => "H25",
            "2014" => "H26",
        );
        $grade = array(
            "3" => "3級",
            "2" => "2級",
        );
		$this->loadModel('PastExam');

        if(!empty($this->request->data['PastProblem'])){
            $select_year    = $this->request->data['PastProblem']['year'];
            $select_grade   = $this->request->data['PastProblem']['grade'];

            $resource_key   = $select_year.$select_grade;
            $questions      = $this->PastExam->find('all',array(
                'conditions' => array(
                    'id like' => $resource_key."%"
                ),
            ));
            $select_year = (string)((int)$select_year-1988);
            $this->set(compact('year','grade','questions','select_year','select_grade'));
        }else{
            $this->set(compact('year','grade'));
        }
    }

	public function showTestProblems() {
		$this->set('pastProblems', $this->PastProblem->find('all'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PastProblem->exists($id)) {
			throw new NotFoundException(__('Invalid past problem'));
		}
		$options = array('conditions' => array('PastProblem.' . $this->PastProblem->primaryKey => $id));
		$this->set('pastProblem', $this->PastProblem->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PastProblem->create();
			if ($this->PastProblem->save($this->request->data)) {
				$this->Flash->success(__('The past problem has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The past problem could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->PastProblem->exists($id)) {
			throw new NotFoundException(__('Invalid past problem'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PastProblem->save($this->request->data)) {
				$this->Flash->success(__('The past problem has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The past problem could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PastProblem.' . $this->PastProblem->primaryKey => $id));
			$this->request->data = $this->PastProblem->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->PastProblem->id = $id;
		if (!$this->PastProblem->exists()) {
			throw new NotFoundException(__('Invalid past problem'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->PastProblem->delete()) {
			$this->Flash->success(__('The past problem has been deleted.'));
		} else {
			$this->Flash->error(__('The past problem could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

		// $this->autoRender = false;
	public function answer() {
		$this->layout = 'experiment';
		$problems = $this->PastProblem->find('all');

		// viewからのpostがないときは初アクセスとみなし，0からスタート
		if(is_null($this->request->data('PastProblem.times'))){
			$times = 0;
		}else{
			if(!empty($this->request->data['next'])){
				$times = $this->request->data('PastProblem.times') + 1;
			}
			// ここでtimesの結果がおかしいので、あとで調査
			$answer_result = $this->request->data('PastProblem');
			$answer_probelm = $this->PastProblem->findById($answer_result['id']);
			// モデル名を消したネスト構造に
			$answer_probelm = Set::extract('PastProblem',$answer_probelm);
			$this->loadModel('AnswerResult');
			$this->AnswerResult->storeAnswerResult($answer_result,$answer_probelm);

			// ユーザテーブルに何問目まで進んでいるのか記録する
			$this->loadModel('User');
			$id = $this->Auth->user('id');
			$tmp['User'] = compact('id','times');
			$this->User->save($tmp);
			
		}

		if(!($times >= count($problems))){
			$problem = $this->PastProblem->toProblemFormat($problems[$times]);
			$this->set(compact('times','problem'));
		}else{
			return $this->redirect(array('controller' => 'AnswerResults','action' => 'index'));
		}

	}
}

