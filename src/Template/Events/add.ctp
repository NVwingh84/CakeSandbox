<!-- File: templates/Events/add.php -->

<h1>Add Event</h1>
<?php
    echo $this->Form->create($event);

    // Hard code the user for now. The id will be taken from another model related to authentication. 
    echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => 1]);
    echo $this->Form->control('title');
    echo $this->Form->control('start_date', ['type' => 'date']);
    echo $this->Form->control('end_date', ['type' => 'date']);
    echo $this->Form->control('city');
    echo $this->Form->button(__('Save Event'));
    echo $this->Form->end();
?>

