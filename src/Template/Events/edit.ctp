<!-- File: templates/Articles/edit.php -->

<h1>Edit Event</h1>
<?php
    echo $this->Form->create($event_pass);
    echo $this->Form->control('user_id', ['type' => 'hidden']);
    echo $this->Form->control('title');
    echo $this->Form->control('start_date', ['type' => 'date']);
    echo $this->Form->control('end_date', ['type' => 'date']);  
    echo $this->Form->control('city');
    echo $this->Form->button(__('Save Event'));
    echo $this->Form->end();
?>

