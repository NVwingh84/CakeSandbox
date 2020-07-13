<!-- File: templates/Orders/index.php -->

<h1>Orders</h1>

<?php 
    
    echo $this->Html->link(
                    '_<span class="fa fa-plus"></span><span class="sr-only"></span>',
                    ['action' => 'add'],
                    ['escape' => false]
                );

    echo $this->Html->link(
        '_<span class="fa fa-at"></span><span class="sr-only"></span>',
        ['action' => 'mail'],
        ['escape' => false]
    );
?>

<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Body</th>        
        <th>Created</th>
    </tr>

    <?php foreach ($present_orders as $order): ?>
    <tr>
        <td>
            <?php echo ($order['id']) ?>
        </td>
        <td>
            <!-- published & created when through mysql CLI or in system, not directly through database -->
            <?php echo ($order['title']) ?>
        </td>
        <td>
            <!-- target = _blank refers to opening a new page  -->
            <?php 
                echo ($order['body'])
            ?>
        </td>
        <td>
            <?php                 

                echo $this->Html->link(
                    '_<span class="fa fa-trash"></span><span class="sr-only"></span>',
                    ['action' => 'delete', $order->id],
                    ['escape' => false]
                );    
                echo $this->Html->link(
                    '_<span class="fa fa-pencil"></span><span class="sr-only"></span>',
                    ['action' => 'edit', $order->id],
                    ['escape' => false]
                );    
                echo $this->Html->link(
                    '_<span class="fa fa-eye"></span><span class="sr-only"></span>',
                    ['action' => 'view', $order->id],
                    ['escape' => false]
                );    

                echo "_<a class='fa fa-file-pdf-o' href='http://wampprojects/composer_cakephptut/orders/view/". $order['id'] .".pdf'></a>";
     
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
    
</table>

