<!-- File: templates/Users/login.php -->

<h1>Login</h1>

<?php

    echo $this->Form->create();
    echo $this->Form->control('email');
    echo $this->Form->control('password');
    echo $this->Form->button('Login'); 
    echo $this->Form->end(); 

?>

<?php $this->Html->link('Register', ['action' => 'register']);  ?>

