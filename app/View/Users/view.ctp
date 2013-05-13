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
            ?>
        </td>
        <td>
            <?php
                echo $this->Form->postLink( 'Видалити', array('controller' => 'Users',
                                        'action' => 'delete', $user['User']['id']),
                        array('confirm' => 'Ви впевнені?') );
            ?>
        </td>
    </tr>
    </table>