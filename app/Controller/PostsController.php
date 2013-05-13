<?php

/**
 * PostsController дочірній до AppController
 * 
 * Містить методи для перегляду всіх повідомлень та повідомлення із номером id,
 * додавання, редагування і видалення повідомлення
 */

class PostsController extends AppController {
    public $helpers = array( 'Html', 'Form', 'Session', 'Paginator' );
    public $components = array( 'Session' );
    
     public $paginate = array(
        'limit' => 2,
        'order' => array(
            'Post.created' => 'desc'
        )
    );
    /** 
     * Метод для перегляду списку повідомлень (по замовчуванню)
     *  
     *  @return void()
     */
    public function index() {
        $this->set('posts', $this->paginate('Post'));
    }
    
    /**
     * Метод для перегляду повідомлення із номером id
     * 
     * @param int $id - id повідомлення
     * @return void() 
     */
    public function view($id = NULL) {
        if (!$id)
            throw new NotFoundException(__('Повідомлення не знайдено.'));
        $post = $this->Post->findById($id);
        if (!$post)
            throw new NotFoundException(__('Повідомлення не знайдено.'));
        $this->set('post', $post);
    }

    /**
     * Метод для додавання повідомлення
     * 
     * @return void()
     */
    public function add() {
         if ( $this->request->is('post') ) {
            //$this->request->data['Guestbook']['user_id'] = $this->Auth->user('id');
            $this->Post->create();
            if ( $this->Post->save($this->request->data) ) {
                $this->Session->setFlash('Повідомлення збережено.');
                $this->redirect( array('action' => 'index') );
            } else {
                $this->Session->setFlash('Повідомлення не додано.');
            }
        }
    }
    
    /**
     * Метод для редагування повідомлення
     * 
     * @param int $id - id повідомлення
     * @return void() 
     */
    public function edit($id = NULL) {
        if (!$id) {
            throw new NotFoundException(__('Повідомлення не знайдено.'));
        }
        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Повідомлення не знайдено.'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Post->id = $id;
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash('Повідомлення відредаговано.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Неможливо відредагувати повідомлення.');
            }
        }
        if (!$this->request->data) {
            $this->request->data = $post;
        }
    }
    
    /**
     * Метод для видалення повідомлення
     * 
     * @param int $id - id повідомлення
     * @return void() 
     */
    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        if ($this->Post->delete($id)) {
            $this->Session->setFlash('Повідомлення з id: '.$id.' видалено.');
            $this->redirect(array('action' => 'index'));
        }
    }
}

?>