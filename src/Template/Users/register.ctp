<!-- File: templates/Users/add.php -->

<h1>Register</h1>
<?php
    echo $this->Form->create($user);

    // Hard code the user for now. The id will be taken from another model related to authentication. 
    echo $this->Form->control('email');
    echo $this->Form->control('password');
    echo $this->Form->select('user_role', $user_role);     
    echo $this->Form->button(__('Register'));
    echo $this->Form->end();
?>

