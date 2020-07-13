<!-- File: templates/Races/edit.php -->

<h1>Edit Race</h1>
<?php
    echo $this->Form->create($race_pass);
    // echo $this->Form->control('user_id', ['type' => 'hidden']);
    echo $this->Form->control('title');
    echo $this->Form->control('distance_km');
    echo $this->Form->control('max_competitors');    
    echo $this->Form->button(__('Save Race'));
    echo $this->Form->end();
?>

