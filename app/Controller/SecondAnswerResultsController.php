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

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->SecondAnswerResult->recursive = 0;
		$this->set('secondAnswerResults', $this->Paginator->paginate());
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
			$this->loadModel('SecondAnswerResult');
			$answer_result_id = $this->request->data['SecondAnswerResult']['id'];
			$answer_result_tmp = $this->SecondAnswerResult->find('first',array('conditions' => array(
				'AnswerResult.id' => $answer_result_id,
			)));
			$select_number = $this->request->data['SecondAnswerResult']['select_number'];
			$correct_number = $answer_result_tmp['SecondAnswerResults']['correct_number'];

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
				'AnswerResult.' . $this->SecondAnswerResult->primaryKey => $answer_result_id));
			$result = $this->SecondAnswerResult->find('first', $options);

			$this->loadModel('SecondAnswerResult');
			$tmp['SecondAnswerResult'] = $result['SecondAnswerResults']; 
			$problem = $this->SecondAnswerResult->toProblemFormat($tmp);

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
	public function edit($id = null) {
		if (!$this->SecondAnswerResult->exists($id)) {
			throw new NotFoundException(__('Invalid second answer result'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->SecondAnswerResult->save($this->request->data)) {
				$this->Flash->success(__('The second answer result has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The second answer result could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('SecondAnswerResult.' . $this->SecondAnswerResult->primaryKey => $id));
			$this->request->data = $this->SecondAnswerResult->find('first', $options);
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
}
