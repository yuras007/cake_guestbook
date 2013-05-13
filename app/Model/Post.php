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
    public function getPostsList() {
        $posts = array();
        
        $result = $this->find('all');
        
        foreach ($result as $line) {
            $posts['id'] = $line['id'];
                $posts['title'] = $line['title'];
                $created = $line['created'];
                $modified = $line['modified'];
                if($created == $modified)
                {
                    $posts['date'] = "Дата створення: $created<br/>";
                } 
                else
                {
                    $posts['date'] = "Дата створення: $created.'               '.       
                                      Дата редагування: $modified";    
                }
                $posts['description'] = $line['description'];
                $posts['message'] = $line['message'];
                $posts['user_id'] = $line['user_id'];
                $postsAll[] = $posts[];
        }
        return $postsAll;
    }
**/
}
    
?>