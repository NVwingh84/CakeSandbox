<!-- File: templates/Customers/edit.php -->

<h1>Edit Customer</h1>
<?php
    echo $this->Form->create($customer);
    echo $this->Form->control('name');
    echo $this->Form->control('city');
    echo $this->Form->button(__('Save Customer'));
    echo $this->Form->end();
?>

