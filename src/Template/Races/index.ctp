<!-- File: templates/Races/index.php -->

<h1><?php echo __('A ball') ?></h1>

<?php  echo $this->Html->link('Add', ['action' => 'add']); ?> 

<br>
<br>

<?php echo $this->Paginator->counter(['format' => 'range']); ?> 


<table>
    <tr>
        <th><?php 
        // paginator sort links 
        echo $this->Paginator->sort('id', 'Sort ID'); ?> </th>
        <th>Title</th>
        <th>Event</th>
        <th>Distance</th>    
        <th>CRUD</th>  
    </tr>

    <?php foreach ($races as $race): ?>
    <tr>
        <td>
            <?php echo ($race['id']) ?>
        </td>
        <td>
            <!-- published & created when through mysql CLI or in system, not directly through database -->
            <?php echo ($race['title']) ?>
        </td>
        <td>
            <?php echo ($race['event']['title']) ?>
        </td>        
        <td>
            <?php echo ($race['distance_km']) ?>
        </td>       
        <td>
            <!-- target = _blank refers to opening a new page  -->
            <?php 
                echo $this->Html->link('Delete', ['action' => 'delete', $race->id]); 
                echo $this->Html->link('Edit', ['action' => 'edit', $race->id]); 
                echo $this->Html->link('View', ['action' => 'view', $race->id]);                 
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
    
</table>
<?php

?> <ul> <?php

// paginator 
echo $this->Paginator->numbers();

echo $this->Paginator->first('<< First');

// already multilanguage plugin reference in here 
echo $this->Paginator->prev(' << ' . __('Previous') . "  ");



echo $this->Paginator->next('Next >>');
echo $this->Paginator->last('Last >>');

?> </ul> <?php

?>

<style>

 ul li {
     
     float: left;
     list-style-type: none;
     
     }

</style>