<!-- File: templates/Customers/add.php -->

<h1>Add Customer</h1>
<?php
    // you relate to attributes of this object in the control element of the form 
    echo $this->Form->create($customer_creating);

    echo $this->Form->control('name');
    echo $this->Form->control('city');

    // this needs to be correctly saved 
    // multiple select, output values are not correct, need to be article_id 

    echo $this->Form->button(__('Save Customer'));
    echo $this->Form->end();

    ?> 

