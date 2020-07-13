<?php echo $this->Html->script('http://code.jquery.com/jquery.min.js'); ?> 

<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>

        <?php // $this->Html->meta('') ?>
        <?php // $this->Html->css('') ?>
        <link href="https://fonts.googleapis.com/css?family=Raleway:500i|Roboto:300,400,700|Roboto+Mono" rel="stylesheet">
    </head>

    <body>
        <header>
            </header>


    <?php echo $this->Html->link('Logout', ['controller' => 'users', 'action' => 'logout']); ?> 

    <br><br><br>


    <a href="<?php echo $this->Url->build(["controller" => "Orders", "action" => "index"]); ?>">Orders</a>
    <br><br>
    <a href="<?php echo $this->Url->build(["controller" => "Articles", "action" => "index"]); ?>">Articles</a>
    <br><br>
    <a href="<?php echo $this->Url->build(["controller" => "Articlecats", "action" => "index"]); ?>">ArticleCategories</a>
    <br><br>
    <a href="<?php echo $this->Url->build(["controller" => "Customers", "action" => "index"]); ?>">Customers</a>
    <br><br>
    <a href="<?php echo $this->Url->build(["controller" => "Events", "action" => "index"]); ?>">Events</a>
    <br><br>
    <a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "index"]); ?>">Users</a> 
    
    </body>
</html>

<style>
    .login_modal{
        // display: none; 
    }

</style>