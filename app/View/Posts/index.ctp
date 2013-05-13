<h1 align="center">Гостьова книга</h1>

<p align="right">
    <a href="/users/logout">exit</a>
</p>

<br />
<?php echo $this->Html->link('Додати повідомлення', array('controller' => 'Posts',
                             'action' => 'add')); ?>

<br /> <br />
<table>
    <?php foreach($posts as $post): ?>
    <table>
    <tr>
        <td><strong>Id:</strong> <?php echo $post['Post']['id']; ?></td>
        <td> <strong>Тема:</strong> <?php echo $post['Post']['title']; ?></td>
    </tr>
    
    <tr>
        <td> 
            <small>Дата створення: <?php echo $post['Post']['created']; ?> </small> 
        </td>
        <td> 
            <small>Дата редагування: <?php echo $post['Post']['modified']; ?> </small>
        </td>
    </tr>
    
    <tr>
        <td colspan="2"> 
            <strong>Опис:</strong> <?php echo $post['Post']['description']; ?> 
        </td>
    </tr>
    
    <tr>
        <td>
            <?php 
                echo $this->Html->link( 'Редагувати', array('controller' => 'Posts',
                                        'action' => 'edit', $post['Post']['id']) ); 
                echo "&nbsp;&nbsp;";
                echo $this->Form->postLink( 'Видалити', array('controller' => 'Posts',
                                        'action' => 'delete', $post['Post']['id']),
                        array('confirm' => 'Ви впевнені?') );
            ?>
        </td>
        <td> 
            <?php echo $this->Html->link( 'Переглянути', array('controller' => 'Posts', 
                                        'action' => 'view', $post['Post']['id']) ); ?> 
        </td>
    </tr>
    </table>
    <br />
<?php endforeach; ?>
<?php unset($post); ?>
</table>

<p align="center">
<?php
// Показуємо лінк на попередню сторінку
echo $this->Paginator->prev('« Попередня   ', null, null, array('class' => 'disabled'));

// Показуємо номери сторінок
echo $this->Paginator->numbers();

// Показуємо лінк на наступну сторінку
echo $this->Paginator->next('   Наступна »', null, null, array('class' => 'disabled'));

// Друкуємо к-сть сторінок і записів
echo '<br />'.$this->Paginator->counter(array(
    'format' => 'Сторінка {:page} з {:pages}'.'<br />'.'(показується по {:current} записи з
             {:count} загальних)'
));
?>
</p>