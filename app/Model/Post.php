<?php

/**
 * Post дочірній до AppModel
 * 
 * Містить валідацію
 */

class Post extends AppModel {
    
    public $validate = array( 
                            'title' => array('rule' => 'notEmpty', 
                                    'message' => 'Поле обов\'язкове для заповнення'),
                            'description' => array('rule' => 'notEmpty',
                                    'message' => 'Поле обов\'язкове для заповнення'),
                            'message' => array('rule' => 'notEmpty',
                                    'message' => 'Поле обов\'язкове для заповнення') );

   /**
    * belongsTo associations
    */
    public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

   /**
    * hasAndBelongsToMany associations
    */
    public $hasAndBelongsToMany = array(
		'Tag' => array(
			'className' => 'Tag',
			'joinTable' => 'posts_tags',
			'foreignKey' => 'post_id',
			'associationForeignKey' => 'tag_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		));
}
?>