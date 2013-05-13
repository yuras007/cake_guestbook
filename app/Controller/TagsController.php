<?php

App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');

/**
 * TagsController дочірній до AppController
 */
class TagsController extends AppController {

    /**
     * index method
     *
     * @return void
     */
    public function index() 
    {
        $this -> layout();
        $this->Tag->recursive = 0;
        $this->set('tags', $this->paginate());
    }

    /**
     * view method
     *
     * @param string $id
     * @return void
     */
    public function view($id = null) 
    {
        $this -> layout();
        if (!$this->Tag->exists($id)) {
            $this -> Session -> setFlash(__( 'Даного тега не існує.') );
            $this -> redirect( array( 'controller' => 'tags', 'action' => 'index'), null, true );
        }
        $options = array('conditions' => array('Tag.' . $this->Tag->primaryKey => $id));
        $this->set('tag', $this->Tag->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() 
    {
        $this -> layout();
        $this -> checkSession();
        if ($this->request->is('post')) {
            $this -> request -> data = Sanitize::clean ( $this -> request -> data );
            $this->Tag->create();
            if ($this->Tag->save($this->request->data)) {
                $this->Session->setFlash(__('Тег збережено'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Тег не може бути збережено. Будь ласка, попробуйте знову.'));
            }
        }
        $posts = $this->Tag->Post->find('list');
        $this->set(compact('posts'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) 
    {
        $this -> layout();
        $this -> checkSession();
        if (!$this->Tag->exists($id)) {
            $this -> Session -> setFlash(__( 'Даного тега не існує.') );
            $this -> redirect( array( 'controller' => 'tags', 'action' => 'index'), null, true );
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this -> request -> data = Sanitize::clean ( $this -> request -> data );
            if ($this->Tag->save($this->request->data)) {
                $this->Session->setFlash(__('Тег збережено'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Тег не збережено. Будь ласка, спробуйте знову.'));
            }
        } else {
            $options = array('conditions' => array('Tag.' . $this->Tag->primaryKey => $id));
            $this->request->data = $this->Tag->find('first', $options);
        }
        $posts = $this->Tag->Post->find('list');
        $this->set(compact('posts'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) 
    {
        $this -> checkSession();
        $this->Tag->id = $id;
        if (!$this->Tag->exists()) {
            $this -> Session -> setFlash(__( 'Даного тега не існує.') );
            $this -> redirect( array( 'controller' => 'tags', 'action' => 'index'), null, true );
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Tag->delete()) {
            $this->Session->setFlash(__('Тег видалено'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Тег не видалено'));
        $this->redirect(array('action' => 'index'));
    }
}