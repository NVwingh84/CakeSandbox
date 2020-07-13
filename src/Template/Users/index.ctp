<!-- File: templates/Users/index.ctp -->

<h1>Users</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Email</th>
        <th>Password</th>        
        <th>Created</th>
    </tr>
    
    <?php 
        
    echo $this->Html->link('Logout', ['action' => 'logout']);

    
    foreach ($present_users as $user): 
    
    ?>
    <tr>
        <td>
            <?php echo ($user['id']) ?>
        </td>
        <td>
            <!-- published & created when through mysql CLI or in system, not directly through database -->
            <?php echo ($user['email']) ?>
        </td>
        <td>
            <?php echo ($user['password']) ; ?>
            <br><br>
            <?php echo $this->Html->link('My Orders', '/orders/index'); ?>
        </td>
        <td>
            <?php echo $user['created'] ?>
        </td>
    </tr>
    <?php endforeach; ?>
    
</table>
