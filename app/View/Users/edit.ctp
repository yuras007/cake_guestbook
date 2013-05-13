<div class="users form">
    <?php echo $this->Form->create('User'); ?>
        <fieldset>
            <legend><?php echo __('Редагувати користувача'); ?></legend>
            <?php 
                echo $this->Form->input('id', array('type' => 'hidden'));
                echo $this->Form->input('username');
                echo $this->Form->input('password');
                echo $this->Form->input('surname');
                echo $this->Form->input('name');
                echo $this->Form->input('role', array(
                    'options' => array('admin' => 'Admin', 'author' => 'Author')
                    ));
            ?>
        </fieldset>
    <?php echo $this->Form->end(__('Відредагувати')); ?>
</div>