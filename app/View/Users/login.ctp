<div class="users form">
    <?php echo $this->Session->flash('auth'); ?>
    <?php echo $this->Form->create('User'); ?>
        <fieldset>
            <legend><?php echo __('Будь ласка, введіть логін і пароль'); ?></legend>
            <?php 
                echo $this->Form->input('username', array('label' => 'Еmail'));
                echo $this->Form->input('password', array('label' => 'Пароль'));
            ?>
        </fieldset>
    <?php echo $this->Form->end(__('Login')); ?>
</div>