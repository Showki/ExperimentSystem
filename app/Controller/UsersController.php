<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {
	function beforeFilter(){
		$this->Auth->allow('passwordHash');
	}


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
		$this->layout = 'login';
	    if($this->request->is('post')) {
	        if($this->Auth->login()) {
	            return $this->redirect(array('action' => 'top'));
	        }else{
				$this->Session->setFlash(__(
					'ログイン失敗しました．IDかパスワードが間違っています．'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-danger'
				));
	        }
	    }
	}

	public function logout(){
		$this->Session->setFlash(__(
			'ログアウトしました．お疲れ様でした．'), 'alert', array(
				'plugin' => 'BoostCake',
				'class' => 'alert-success'
		));
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
			$this->Flash->success(__('チーム割振り成功．'));
			return $this->redirect(array('action' => 'index'));
		}else{
			$this->Flash->error(__('チーム割振り失敗．'));
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


	public function setTheme(){
		$this->autoRender = false;
		if($this->Auth->user('id') != 1){
			return $this->redirect(array('action' => 'top'));
		}
		$this->loadModel('Theme');
		$themes = $this->Theme->find('all',array('fields' => array('name')));
		// 回答数0の学生は除外してテーマを割り振る
		// Aチーム振り分け
		$a_team = $this->User->find('all',array(
			'conditions' => array(
				'User.team' => 'A',
				'User.times >' => 0,
				),
			'fields' => array('id'),
			'order' => array('User.points' => 'DESC'),
		));
		$this->User->setTheme($a_team,$themes);
		// Bチーム振り分け
		$b_team = $this->User->find('all',array(
			'conditions' => array(
				'User.team' => 'B',
				'User.times >' => 0,
				),
			'fields' => array('id'),
			'order' => array('User.points' => 'DESC'),
		));
		$this->User->setTheme($b_team,$themes);
		return $this->redirect(array('action' => 'index'));
	}

	// テスト用のメソッド
	public function setPoints(){
		$this->autoRender = false;
		if($this->User->setPoints()){
			$this->Flash->success(__('テスト用だけど点数を生成して登録．'));
			return $this->redirect(array('action' => 'index'));
		}else{
			$this->Flash->error(__(
				'点数の生成か，その登録で失敗してる．'));
		}
	}

	// 何らかのメソッドでパスワードが再ハッシュされてしまった時、初期化してハッシュする
	public function passwordHash(){
		if($this->Auth->user('id') != 1){
			return $this->redirect(array('action' => 'top'));
		}
		$this->autoRender = false;
		if($this->User->passHash()){
			$this->Flash->success(__('ハッシュ成功'));
			return $this->redirect(array('action' => 'index'));
		}
	}

	public function clearTheme(){
		$this->autoRender = false;
		if($this->Auth->user('id') != 1){
			return $this->redirect(array('action' => 'top'));
		}
		if($this->User->clearTheme()){
			$this->Flash->success(__('クリア成功'));
			return $this->redirect(array('action' => 'index'));
		}
	}

	public function clearTeam(){
		$this->autoRender = false;
		if($this->Auth->user('id') != 1){
			return $this->redirect(array('action' => 'top'));
		}
		if($this->User->clearTeam()){
			$this->Flash->success(__('クリア成功'));
			return $this->redirect(array('action' => 'index'));
		}
	}

	public function clearPoint(){
		$this->autoRender = false;
		if($this->Auth->user('id') != 1){
			return $this->redirect(array('action' => 'top'));
		}
		if($this->User->clearPoint()){
			$this->Flash->success(__('クリア成功'));
			return $this->redirect(array('action' => 'index'));
		}
	}

}
