<h1 align="center">Гостьова книга</h1>

<br /> <br />
<table>
    <?php foreach($users as $user): ?>
    <table>
    <tr>
        <td><strong>Id:</strong> <?php echo $user['User']['id']; ?></td>
        <td> <strong>Login:</strong> <?php echo $user['User']['username']; ?></td>
    </tr>
    
    <tr>
        <td> 
            <small>Дата створення: <?php echo $user['User']['created']; ?> </small> 
        </td>
        <td> 
            <small>Дата редагування: <?php echo $user['User']['modified']; ?> </small>
        </td>
    </tr>
    
    <tr>
        <td> 
            <strong>Surname:</strong> <?php echo $user['User']['surname']; ?> 
        </td>
        <td> 
            <strong>Name:</strong> <?php echo $user['User']['name']; ?> 
        </td>
    </tr>
    
    <tr>
        <td colspan="2"> 
            <strong>Роль:</strong> <?php echo $user['User']['role']; ?> 
        </td>
    </tr>
    
    <tr>
        <td>
            <?php 
                echo $this->Html->link( 'Редагувати', array('controller' => 'Users',
                                        'action' => 'edit', $user['User']['id']) ); 
                echo "&nbsp;&nbsp;";
                echo $this->Form->postLink( 'Видалити', array('controller' => 'Users',
                                        'action' => 'delete', $user['User']['id']),
                        array('confirm' => 'Ви впевнені?') );
            ?>
        </td>
        <td> 
            <?php echo $this->Html->link( 'Переглянути', array('controller' => 'Users', 
                                        'action' => 'view', $user['User']['id']) ); ?> 
        </td>
    </tr>
    </table>
    <br />
<?php endforeach; ?>
<?php unset($users); ?>
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