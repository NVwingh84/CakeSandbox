<!-- File: templates/Orders/index.php -->

<h1>Orders</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Body</th>        
        <th>Created</th>
    </tr>

    <!-- Here is where we iterate through our $articles query object, printing out article info -->
    <!-- Routing is fine, file is read, need to pass variable -->
    
    <tr>
        <td>
            <?php echo ($user['email']) ?>
        </td>
        <td>
            <!-- published & created when through mysql CLI or in system, not directly through database -->
            <?php echo ($order['title']) ?>
        </td>
        <td>
            <!-- target = _blank refers to opening a new page  -->
            <?php echo ($order['body']) ?>
        </td>
        <td>
            <?php echo $user['password'] ?>
        </td>
    </tr>
    
</table>
