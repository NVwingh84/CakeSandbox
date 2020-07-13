<!-- File: templates/Articles/index.php -->

<h1>Articles</h1>
<?php echo $this->Html->link('__Add', ['action' => 'add'], ['class' => 'fa fa-plus']); ?>

<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Operations</th>        
        <th>Category</th>
    </tr>

    <!-- Here is where we iterate through our $articles query object, printing out article info -->
    <!-- Routing is fine, file is read, need to pass variable -->
    
    <?php foreach ($first_article as $article): ?>
    <tr>
        <td>
            <?php echo ($article['id']) ?>
        </td>
        <td>
            <!-- published & created when through mysql CLI or in system, not directly through database -->
            <?php echo ($article['title']) ?>
        </td>
        <td>
            <!-- target = _blank refers to opening a new page  -->
            <!-- add classes to these links to define their look, another way is to add icons  -->            
            <?php 
                echo $this->Html->link('__', ['action' => 'delete', $article->id], ['class' => 'fa fa-trash']); 
                echo $this->Html->link('__', ['action' => 'edit', $article->id], ['class' => 'fa fa-edit']); 
                echo $this->Html->link('__', ['action' => 'view', $article->id], ['class' => 'fa fa-eye']);                 
            ?>
        </td>
        <td>
            <?php echo $article['articlecat']['title'] ?>
        </td>
    </tr>
    <?php endforeach; ?>
    
</table>
