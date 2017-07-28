<?php
App::uses('AppController', 'Controller');
/**
 * SecondAnswerResults Controller
 *
 * @property SecondAnswerResult $SecondAnswerResult
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class SecondAnswerResultsController extends AppController {

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
		$answer_results = $this->SecondAnswerResult->getSecondAnswerResult();
		$this->set(compact('answer_results'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->SecondAnswerResult->exists($id)) {
			throw new NotFoundException(__('Invalid second answer result'));
		}
		$options = array('conditions' => array('SecondAnswerResult.' . $this->SecondAnswerResult->primaryKey => $id));
		$this->set('secondAnswerResult', $this->SecondAnswerResult->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function edit($times = null,$id = null) {
		if ($this->request->is(array('post', 'put'))) {
			$this->loadModel('SecondMadeProblem');
			$second_answer_result_id = $this->request->data['SecondAnswerResult']['id'];
			$second_answer_result_tmp = $this->SecondAnswerResult->find(
				'first',array('conditions' => array(
					'SecondAnswerResult.id' => $second_answer_result_id,
			)));
			$select_number = $this->request->data['SecondAnswerResult']['select_number'];
			$correct_number = $second_answer_result_tmp['SecondMadeProblems']['correct_number'];
			if($select_number == $correct_number){
				$this->request->data['SecondAnswerResult']['result'] = 1;
			}else{
				$this->request->data['SecondAnswerResult']['result'] = 0;
			}
			
			if ($this->SecondAnswerResult->save($this->request->data)) {
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
				'SecondAnswerResult.' . $this->SecondAnswerResult->primaryKey => $answer_result_id));
			$result = $this->SecondAnswerResult->find('first', $options);
			// debug($result);

			$this->loadModel('SecondMadeProblem');
			$tmp['SecondMadeProblem'] = $result['SecondMadeProblems']; 
			$problem = $this->SecondMadeProblem->toProblemFormat($tmp);

			$answer['SecondAnswerResult']['select_number'] = $result['SecondAnswerResult']['select_number'];
			$answer['SecondAnswerResult']['id'] = $result['SecondAnswerResult']['id'];

			$this->set(compact('problem','times','answer'));
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	// public function edit($id = null) {
	// 	if (!$this->SecondAnswerResult->exists($id)) {
	// 		throw new NotFoundException(__('Invalid second answer result'));
	// 	}
	// 	if ($this->request->is(array('post', 'put'))) {
	// 		if ($this->SecondAnswerResult->save($this->request->data)) {
	// 			$this->Flash->success(__('The second answer result has been saved.'));
	// 			return $this->redirect(array('action' => 'index'));
	// 		} else {
	// 			$this->Flash->error(__('The second answer result could not be saved. Please, try again.'));
	// 		}
	// 	} else {
	// 		$options = array('conditions' => array('SecondAnswerResult.' . $this->SecondAnswerResult->primaryKey => $id));
	// 		$this->request->data = $this->SecondAnswerResult->find('first', $options);
	// 	}
	// }

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->SecondAnswerResult->id = $id;
		if (!$this->SecondAnswerResult->exists()) {
			throw new NotFoundException(__('Invalid second answer result'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->SecondAnswerResult->delete()) {
			$this->Flash->success(__('The second answer result has been deleted.'));
		} else {
			$this->Flash->error(__('The second answer result could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function sum_second_points(){
		$this->autoRender = false;
		$id = $this->Auth->user('id');
		$second_points = $this->SecondAnswerResult->find('count',array(
			'conditions' => array(
				'users_id' => $id,
				'result' => 1
			)));
		$this->loadModel('User');
		if($this->User->save(compact('id','second_points'))){
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
