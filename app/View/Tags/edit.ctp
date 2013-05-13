<div class="tags form">
    <?php echo $this->Form->create('Tag'); ?>
	<fieldset>
            <legend><?php echo __('Редагувати теги'); ?></legend>
            <?php
		echo $this->Form->input('id', array('type' => 'hidden'));
		echo $this->Form->input('name', array('label' => 'Назва'));
		echo $this->Form->input('count', array('label' => 'К-сть'));
		echo $this->Form->input('Post');
            ?>
	</fieldset>
    <?php echo $this->Form->end(__('Редагувати')); ?>
</div>