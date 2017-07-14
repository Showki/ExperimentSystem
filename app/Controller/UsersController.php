<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class UsersController extends AppController {

public function beforeFilter() {
    // $this->Auth->allow();
}

/**
 * Components
 *
 * @var array
 */
	public $components = array('Session', 'Flash');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->User->find('all'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
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

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
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

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
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

	public function login() {
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

	public function addTestUsers() {
		$this->autoRender = false;
		if($this->User->addTestUsers()){
			$this->Session->setFlash(__('登録成功'));
			return $this->redirect(array('action' => 'index'));
		}
	}

	public function deleteTestUsers(){
		$this->autoRender = false;
		$conditions = array('User.name like' => '%テストユーザ%');
		if($this->User->deleteAll($conditions,false)){
			$this->Session->setFlash(__('削除成功'));
			return $this->redirect(array('action' => 'index'));
		}

	}

	public function assignTeam(){
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
		// $this->autoRender = false;
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

	public function top(){
		$user_name = $this->Auth->user('name');
		$this->set(compact('user_name'));
	}
}
