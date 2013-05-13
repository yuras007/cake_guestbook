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
        ));
     
    /** 
     * Метод для перегляду списку повідомлень (по замовчуванню)
     *  
     *  @return void
     */
    public function index() {
        $this->set('posts', $this->paginate('Post'));
    }
    
    /**
     * view method
     * 
     * @param int $id - id повідомлення
     * @return void 
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
     * add method
     * 
     * @return void
     */
    public function add() {
         if ( $this->request->is('post') ) {
            $this->request->data['Post']['user_id'] = $this->Auth->user('id');
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
     * edit method
     * 
     * @param int $id - id повідомлення
     * @return void
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
     * delete method
     * 
     * @param int $id - id повідомлення
     * @return void
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
    
    /**
     * isAuthorized method
     * 
     * @param string $user
     * @return boolean
     */
    public function isAuthorized($user) {
        // Всі зареєстовані користувачі можуть додавати повідомлення
        if ($this->action === 'add') {
            return true;
        }
        // Власники повідомлень можуть видаляти і редагувати їх
        if (in_array($this->action, array('edit', 'delete'))) {
            $postId = $this->request->params['pass'][0];
            if ($this->Post->isOwnedBy($postId, $user['id'])) {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }
    
}

?>