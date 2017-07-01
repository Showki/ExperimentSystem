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

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$anser_results = $this->AnswerResult->getAnswerResult();
		$answerResults = $this->Paginator->paginate();
		$this->set(compact('anser_results','answerResults'));
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
	public function edit($id = null) {
		if (!$this->AnswerResult->exists($id)) {
			throw new NotFoundException(__('Invalid answer result'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->AnswerResult->save($this->request->data)) {
				$this->Flash->success(__('The answer result has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The answer result could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AnswerResult.' . $this->AnswerResult->primaryKey => $id));
			$this->request->data = $this->AnswerResult->find('first', $options);
		}
		$answerResult = $this->AnswerResult->find('list');
		$this->set(compact('answerResult'));
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




}
