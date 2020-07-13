<!-- File: templates/Articles/edit.php -->

<h1>Edit ArticleCategory</h1>
<?php
    echo $this->Form->create($category_pass);
    echo $this->Form->control('user_id', ['type' => 'hidden']);
    echo $this->Form->control('title');
    echo $this->Form->button(__('Save Article'));
    echo $this->Form->end();
?>

