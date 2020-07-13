<!-- File: templates/Roles/edit.php -->

<h1>Edit Role</h1>
<?php
    echo $this->Form->create($role_pass);
    echo $this->Form->control('name');
    echo $this->Form->control('description');   
    echo $this->Form->button(__('Save Role'));
    echo $this->Form->end();
?>

