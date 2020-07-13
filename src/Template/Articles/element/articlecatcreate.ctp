<h1>Edit ArticleCategory</h1>

<div>

    <?php
    
    // you miss a primary key, it does try to save to the right table 
    echo $this->Form->create($articlecat_pass, ['url' => ['controller' => 'Articlecats', 'action' => 'edit']]);
    echo $this->Form->control('user_id', ['type' => 'hidden']);
    echo $this->Form->control('title');
    echo $this->Form->button(__('Save Article'));
    echo $this->Form->end();
    
    ?>

</div>


