<!-- File: templates/Orders/index.php -->


<h1>Orders</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Body</th>        
        <th>Articles</th>
    </tr>

    <!-- Here is where we iterate through our $articles query object, printing out article info -->
    <!-- Routing is fine, file is read, need to pass variable -->
    
    <tr>
        <td>
            <?php echo ($order_view['id']) ?>
        </td>
        <td>
            <!-- published & created when through mysql CLI or in system, not directly through database -->
            <?php echo ($order_view['title']) ?>
        </td>
        <td>
            <!-- target = _blank refers to opening a new page  -->
            <?php echo ($order_view['body']) ?>
        </td>
        <td>
            <ul>
            <?php   foreach($order_view['articles'] as $article): ?>

                <li> <?php echo $article['title']; ?> </li>

            <?php   endforeach; ?>
            </ul>
        </td>
    </tr>
</table>

<br>
<br>

<?php 

    $text = "test qr code";

    echo "<img src='https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=". $order_view['title'] ."'>";
    echo "<img src='https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=". $text ."'>";

?>



