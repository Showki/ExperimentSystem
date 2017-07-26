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
	public function add() {
		if ($this->request->is('post')) {
			$this->SecondAnswerResult->create();
			if ($this->SecondAnswerResult->save($this->request->data)) {
				$this->Flash->success(__('The second answer result has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The second answer result could not be saved. Please, try again.'));
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
