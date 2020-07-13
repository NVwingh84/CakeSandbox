<!-- File: templates/Races/add.php -->

<h1>Add Race</h1>
<?php
    echo $this->Form->create($race);

    // Hard code the user for now. The id will be taken from another model related to authentication. 
    // echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => 1]);
    echo $this->Form->control('title');
    echo $this->Form->select('event_id', $events);     
    echo $this->Form->control('distance_km');
    echo $this->Form->control('max_competitors');
    echo $this->Form->button(__('Save Race'));
    echo $this->Form->end();
?>

