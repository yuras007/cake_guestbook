<div class="tags view">
    <?php  echo __('Tag'); ?>
	<table>
            <tr>
		<td>
                    <?php echo __('Id'); ?>
                </td>
		<td>
                    <?php echo h($tag['Tag']['id']); ?>
		</td>
            </tr>
            <tr>
		<td>
                    <?php echo __('Name'); ?>
                </td>
		<td>
                    <?php echo h($tag['Tag']['name']); ?>
		</td>
            </tr>
            <tr>
		<td>
                    <?php echo __('Count'); ?></dt>
		</td>
                <td>
			<?php echo h($tag['Tag']['count']); ?>
		</td>
            </tr>
	</table>
</div>
<div class="actions">
    <table>
	<tr>
            <td>
                <?php echo $this->Html->link(__('Редагувати теги'), 
                        array('action' => 'edit', $tag['Tag']['id'])); ?> 
            </td>
            <td>
                <?php echo $this->Form->postLink(__('Видалити теги'), 
                        array('action' => 'delete', $tag['Tag']['id']), null, 
                        __('Ви впевнені, що хочите видалити # %s?', $tag['Tag']['id'])); ?> 
            </td>
            <td>
                <?php echo $this->Html->link(__('Список тегів'), array('action' => 'index')); ?> 
            </td>
            <td>
                <?php echo $this->Html->link(__('Новий тег'), array('action' => 'add')); ?>
            </td>
        <tr>
    </table>
</div>