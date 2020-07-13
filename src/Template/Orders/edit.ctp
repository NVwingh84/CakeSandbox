<!-- File: templates/Orders/edit.php -->

<h1>Edit Order</h1>
<?php
    echo $this->Form->create($order_editing);
    echo $this->Form->control('user_id', ['type' => 'hidden']);
    echo $this->Form->control('title');
    echo $this->Form->control('body', ['rows' => '3']);
    echo $this->Form->button(__('Save Order'));
    echo $this->Form->end();
?>

