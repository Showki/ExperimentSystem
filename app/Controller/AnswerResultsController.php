<?php
App::uses('AppController', 'Controller');
/**
 * AnswerResults Controller
 *
 * @property AnswerResult $AnswerResult
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class AnswerResultsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Flash');


    public function beforeFilter(){
        $this->layout = 'experiment';
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$answer_results = $this->AnswerResult->getAnswerResult();
		$this->set(compact('answer_results'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
 	// 要らない
	public function view($id = null) {
		if (!$this->AnswerResult->exists($id)) {
			throw new NotFoundException(__('Invalid answer result'));
		}
		$options = array('conditions' => array('AnswerResult.' . $this->AnswerResult->primaryKey => $id));
		$this->set('answerResult', $this->AnswerResult->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->AnswerResult->create();
			if ($this->AnswerResult->save($this->request->data)) {
				$this->Flash->success(__('The answer result has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The answer result could not be saved. Please, try again.'));
			}
		}
		$answerResult = $this->AnswerResult->find('list');
		$this->set(compact('answerResult'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($times = null,$id = null) {
		if ($this->request->is(array('post', 'put'))) {
			$this->loadModel('PastProblem');
			$answer_result_id = $this->request->data['AnswerResult']['id'];
			$answer_result_tmp = $this->AnswerResult->find('first',array('conditions' => array(
				'AnswerResult.id' => $answer_result_id,
			)));
			$select_number = $this->request->data['AnswerResult']['select_number'];
			$correct_number = $answer_result_tmp['PastProblems']['correct_number'];

			if($select_number == $correct_number){
				$this->request->data['AnswerResult']['result'] = 1;
			}else{
				$this->request->data['AnswerResult']['result'] = 0;
			}
			
			if ($this->AnswerResult->save($this->request->data)) {
				$this->Session->setFlash(__('正常に保存されました．'),'alert',array(
					'plugin' => 'BoostCake','class' => 'alert-success'
				));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('正常に保存されませんでした．'),'alert',array(
					'plugin' => 'BoostCake','class' => 'alert-danger'
				));
			}
		} else {
			$answer_result_id = $this->request->query['id'];
			$times = $this->request->query['times'];
			$options = array('conditions' => array(
				'AnswerResult.' . $this->AnswerResult->primaryKey => $answer_result_id));
			$result = $this->AnswerResult->find('first', $options);

			$this->loadModel('PastProblem');
			$tmp['PastProblem'] = $result['PastProblems']; 
			$problem = $this->PastProblem->toProblemFormat($tmp);

			$answer['AnswerResult']['select_number'] = $result['AnswerResult']['select_number'];
			$answer['AnswerResult']['id'] = $result['AnswerResult']['id'];

			$this->set(compact('problem','times','answer'));
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
 	// 要らない
	public function delete($id = null) {
		$this->AnswerResult->id = $id;
		if (!$this->AnswerResult->exists()) {
			throw new NotFoundException(__('Invalid answer result'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->AnswerResult->delete()) {
			$this->Flash->success(__('The answer result has been deleted.'));
		} else {
			$this->Flash->error(__('The answer result could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function sum_points(){
		$this->autoRender = false;
		$id = $this->Auth->user('id');
		$points = $this->AnswerResult->find('count',array(
			'conditions' => array(
				'users_id' => $id,
				'result' => 1
			)));
		$this->loadModel('User');
		if($this->User->save(compact('id','points'))){
			$this->Session->setFlash(__(
				'採点が完了しました．指示が出るまでお待ち下さい．'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
			));
			return $this->redirect(array('controller' => 'users', 'action' => 'top'));
		}else{
			$this->Session->setFlash(__(
				'採点できませんでした．やり直してください．'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
			));
		}
	}
}