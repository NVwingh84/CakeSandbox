<!-- File: templates/Users/view.ctp -->

<h1>User <?php echo ($user['email']) ?></h1>

<li>
    <?php foreach ($user['orders'] as $ass_order): ?>
        
        <ul> <?php echo $ass_order['title']; ?> </ul>
        
    <?php endforeach; ?>

</li>




