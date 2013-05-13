<?php

/**
 * UsersController дочірній до AppController
 * 
 * Містить методи для відображення додавання, редагування, видалення 
 * і списку користувачів, login i logout
 */

class UsersController extends AppController {

    public $helpers = array('Paginator');
    
    public $paginate = array(
        'limit' => 2,
        'order' => array(
            'Post.created' => 'desc'
        ));
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add'); // дозволяємо користувачам зареєструвати себе
    }

    /**
     * login method
     * 
     * @return void
     */
    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Неправильний логін або пароль, повторіть спробу'));
            }
        }
    }

     /**
     * logout method
     * 
     * @return void
     */
    public function logout() {
        $this->redirect($this->Auth->logout());
    }
    
     /**
     * index method
     * 
     * @return void
     */
    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

     /**
     * view method
     * 
     * @param int $id
     * @return void
     */
    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Не існуючий користувач'));
        }
        $this->set('user', $this->User->read(null, $id));
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
                $this->Session->setFlash(__('Користувача збережено'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Користувача не може бути збережено. 
                    Будь ласка, повторіть спробу.'));
            }
        }
    }

    /**
     * edit method
     * 
     * @param int $id
     * @return void
     */
    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Не існуючий користувач'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Зміни користувача збережено'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Зміни користувача не може бути збережено. 
                    Будь ласка, повторіть спробу.'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    /**
     * delete method
     * 
     * @param int $id
     * @return void
     */
    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Не існуючий користувач'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('Користувача видалено'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Користувача не видалено'));
        $this->redirect(array('action' => 'index'));
    }
    
}

?>