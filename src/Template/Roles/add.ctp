<!-- File: templates/Races/add.php -->

<h1>Add Role</h1>
<?php
    echo $this->Form->create($role);
    echo $this->Form->control('name'); 
    echo $this->Form->control('description');
    echo $this->Form->button(__('Save Role'));
    echo $this->Form->end();
?>

