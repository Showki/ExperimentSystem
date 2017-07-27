<?php
App::uses('AppController', 'Controller');
/**
 * SecondMadeProblems Controller
 *
 * @property SecondMadeProblem $SecondMadeProblem
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class SecondMadeProblemsController extends AppController {

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
		$this->SecondMadeProblem->recursive = 0;
		$this->set('secondMadeProblems', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->SecondMadeProblem->exists($id)) {
			throw new NotFoundException(__('Invalid second made problem'));
		}
		$options = array('conditions' => array('SecondMadeProblem.' . $this->SecondMadeProblem->primaryKey => $id));
		$this->set('secondMadeProblem', $this->SecondMadeProblem->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->SecondMadeProblem->create();
			if ($this->SecondMadeProblem->save($this->request->data)) {
				$this->Flash->success(__('The second made problem has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The second made problem could not be saved. Please, try again.'));
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
		if (!$this->SecondMadeProblem->exists($id)) {
			throw new NotFoundException(__('Invalid second made problem'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->SecondMadeProblem->save($this->request->data)) {
				$this->Flash->success(__('The second made problem has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The second made problem could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('SecondMadeProblem.' . $this->SecondMadeProblem->primaryKey => $id));
			$this->request->data = $this->SecondMadeProblem->find('first', $options);
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
		$this->SecondMadeProblem->id = $id;
		if (!$this->SecondMadeProblem->exists()) {
			throw new NotFoundException(__('Invalid second made problem'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->SecondMadeProblem->delete()) {
			$this->Flash->success(__('The second made problem has been deleted.'));
		} else {
			$this->Flash->error(__('The second made problem could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function answer() {
		$this->layout = 'experiment';

		if(is_null($this->request->data('SecondMadeProblem.times'))){
			$times = 0;
		}else{
			if(!empty($this->request->data['next'])){
				$times = $this->request->data('SecondMadeProblem.times') + 1;
			}
			$second_answer_result = $this->request->data('SecondMadeProblem');
			$second_answer_probelm = $this->SecondMadeProblem->findById($second_answer_result['id']);

			$second_answer_probelm = $second_answer_probelm['SecondMadeProblem'];
			$this->loadModel('SecondAnswerResult');
			$this->SecondAnswerResult->storeSecondAnswerResult($second_answer_result,$second_answer_probelm);

			// ユーザテーブルに何問目まで進んでいるのか記録する
			$this->loadModel('User');
			$id = $this->Auth->user('id');
			$tmp['User'] = compact('id','times');
			$this->User->save($tmp);
			
		}
		$problems = $this->SecondMadeProblem->find('all');
		if(!($times >= count($problems))){
			$problem = $this->SecondMadeProblem->toProblemFormat($problems[$times]);
			$this->set(compact('times','problem'));
		}else{
			return $this->redirect(array('controller' => 'AnswerResults','action' => 'index'));
		}

	}


}
