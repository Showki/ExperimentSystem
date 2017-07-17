<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

	public $components = array('Session', 'Flash');

	public function top(){
		$this->layout = 'experiment';
		$user_name = $this->Auth->user('name');
		$team = $this->User->find('first',array(
			'conditions' => array('id' => $this->Auth->user('id')),
			'fields' => array('team')
			));
		$team = $team['User']['team'];
		$this->set(compact('user_name','team'));
	}

	public function login() {
		$this->layout = 'experiment';
	    if($this->request->is('post')) {
	        if($this->Auth->login()) {
	            $this->redirect($this->Auth->redirect());
	        }else{
	            $this->Session->setFlash(__('IDまたはパスワードが違います'));
	        }
	    }
	}

	public function logout(){
		$logoutUrl = $this->Auth->logout();
		$this->redirect($logoutUrl);
	}


	// 管理者専用ページ

	public function index() {
		if($this->Auth->user('id') != 1){
			return $this->redirect(array('action' => 'top'));
		}
		$this->User->recursive = 0;
		$this->set('users', $this->User->find('all'));
	}

	public function view($id = null) {
		if($this->Auth->user('id') != 1){
			return $this->redirect(array('action' => 'top'));
		}
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

	public function add() {
		if($this->Auth->user('id') != 1){
			return $this->redirect(array('action' => 'top'));
		}
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('正常に登録されました．'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('ユーザ登録ができませんでした．やり直してみてください．'));
			}
		}
	}

	public function edit($id = null) {
		if($this->Auth->user('id') != 1){
			return $this->redirect(array('action' => 'top'));
		}
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

	public function delete($id = null) {
		if($this->Auth->user('id') != 1){
			return $this->redirect(array('action' => 'top'));
		}
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Flash->success(__('The user has been deleted.'));
		} else {
			$this->Flash->error(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function assignTeam(){
		if($this->Auth->user('id') != 1){
			return $this->redirect(array('action' => 'top'));
		}
		$this->autoRender = false;
		$sort_users = $this->User->find('all',array(
			'order' => array('User.points' => 'DESC'),
		));
		if($this->User->assignTeam($sort_users)){
			$this->Session->setFlash(__('更新成功'));
			return $this->redirect(array('action' => 'index'));
		}
	}

	public function showTeamMembers(){
		if($this->Auth->user('id') != 1){
			return $this->redirect(array('action' => 'top'));
		}
		$a_team = $this->User->find('all',array(
			'conditions' => array('User.team' => 'A'),
			'order' => array('User.points' => 'DESC'),
		));
		$b_team = $this->User->find('all',array(
			'conditions' => array('User.team' => 'B'),
			'order' => array('User.points' => 'DESC'),
		));
		$this->set(compact('a_team','b_team'));
	}
}
