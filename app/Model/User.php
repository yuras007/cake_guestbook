<?php

/*
 * User дочірній до AppModel
 * 
 * Містить валідацію
 */

App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {
    
    public $validate = array (
        'surname' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Введіть прізвище!'
                )
            ),
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Введіть ім\'я!'
                )
            ),
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Введіть логін!'
                )
            ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Введіть пароль!'
                )
            ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'author')),
                'message' => 'Будь ласка, виберіть роль!',
                'allowEmpty' => false
                )
            )
        );
    
/**
 * hasMany associations
 */
	public $hasMany = array(
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		));
    
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = 
                    AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }
    
}
    
?>
