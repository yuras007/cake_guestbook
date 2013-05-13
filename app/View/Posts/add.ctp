<h1>Додати повідомлення</h1>
<?php
	echo $this->Form->create('Post');
	echo $this->Form->input('title');
	echo $this->Form->input( 'description', array('rows' => '3') );
        echo $this->Form->input( 'message', array('rows' => '6') );
	echo $this->Form->end('Зберегти');
?>