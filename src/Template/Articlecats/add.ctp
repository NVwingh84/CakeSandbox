<!-- File: templates/Articles/add.php -->
<!-- Helper functions   C:\wampserver\www\wamp_projects\composer_cakephptut\vendor\cakephp\cakephp\src -->
<!-- How hard is it to put custom styling in this? -->

<h1>Add ArticleCategory</h1>
<?php
    echo $this->Form->create($category);

    // Hard code the user for now. The id will be taken from another model related to authentication. 
    echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => 1]);
    echo $this->Form->control('title');
    echo $this->Form->button(__('Save Article'));
    echo $this->Form->end();
?>

