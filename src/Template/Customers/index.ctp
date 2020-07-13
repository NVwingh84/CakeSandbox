<!-- File: templates/Customers/index.php -->

<h1>Customers</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>City</th>        
        <th>Buttons</th>
    </tr>

    <?php foreach ($present_customers as $customer): ?>
    <tr>
        <td>
            <?php echo ($customer['id']) ?>
        </td>
        <td>
            <!-- published & created when through mysql CLI or in system, not directly through database -->
            <?php echo ($customer['name']) ?>
        </td>
        <td>
            <!-- target = _blank refers to opening a new page  -->
            <?php 
                echo ($customer['city'])
            ?>
        </td>
        <td>
            <?php                 
                echo $this->Html->link('Add', ['action' => 'add']); 
                echo $this->Html->link('Delete', ['action' => 'delete', $customer->id]); 
                echo $this->Html->link('Edit', ['action' => 'edit', $customer->id]); 
                echo $this->Html->link('View', ['action' => 'view', $customer->id]);                   
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
    
</table>
