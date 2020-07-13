<!-- File: templates/Athletes/index.php -->

<h1>Athletes</h1>

<?php  

// debug($this->getRequest()->getSession());

echo $this->Html->link(
    '__<span class="fa fa-plus"></span><span class="sr-only"></span>',
    ['action' => 'add'],
    ['escape' => false]
);
echo $this->Html->link(
    '__Multi<span class="fa fa-plus"></span><span class="sr-only"></span>',
    ['action' => 'add_multiple'],
    ['escape' => false]
);

?>

<table>
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Gender</th>        
        <th>Operations</th>        
    </tr>

    <!-- Here is where we iterate through our $articles query object, printing out article info -->
    <!-- Routing is fine, file is read, need to pass variable -->
    
    <?php foreach ($athletes as $athlete): ?>
    <tr>
        <td>
            <?php echo ($athlete['id']) ?>
        </td>
        <td>
            <!-- published & created when through mysql CLI or in system, not directly through database -->
            <?php echo ($athlete['first_name']) ?>
        </td>
        <td>
            <?php echo ($athlete['last_name']) ?>
        </td>     
        <td>
            <?php echo ($athlete['gender']) ?>
        </td>            
        <td>
            <!-- target = _blank refers to opening a new page  -->
            <?php 
                echo $this->Html->link(
                    '__<span class="fa fa-pencil"></span><span class="sr-only"></span>',
                    ['action' => 'edit', $athlete->id],
                    ['escape' => false]
                );    
                echo $this->Html->link(
                    '__<span class="fa fa-trash"></span><span class="sr-only"></span>',
                    ['action' => 'delete', $athlete->id],
                    ['escape' => false]
                );                                      
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
    
</table>
