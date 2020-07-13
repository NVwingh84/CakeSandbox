<!-- File: templates/Roles/index.php -->

<h1>Roles</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>CRUD</th>  
    </tr>
    
    <?php 
    echo $this->Html->link('Add', ['action' => 'add']); 
    
    foreach ($roles as $role): ?>
    <tr>
        <td>
            <?php echo ($role['id']) ?>
        </td>
        <td>
            <!-- published & created when through mysql CLI or in system, not directly through database -->
            <?php echo ($role['name']) ?>
        </td>
        <td>
            <?php echo ($role['description']) ?>
        </td>         
        <td>
            <!-- target = _blank refers to opening a new page  -->
            <?php 
                echo $this->Html->link('Delete', ['action' => 'delete', $role->id]); 
                echo $this->Html->link('Edit', ['action' => 'edit', $role->id]);               
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
    
</table>
