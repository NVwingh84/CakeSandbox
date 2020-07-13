<!-- File: templates/Orders/index.php -->

<h3>Orders</h3>

<button id="checkout" class="fa fa-shopping-bag"></button>

<?php 

    // can you centralise this to automatically render a breadcrumb home:::controller?
    // make a breadcrumbs element that combines these two lines of code, with parameter 'controller'
    $this->Breadcrumbs->add([
        ['title' => 'Home', 'url' => ['controller' => 'Pages', 'action' => 'home']],
        ['title' => $this->request->param('controller'), 'url' => ['controller' => $this->request->param('controller'), 'action' => 'index']]
    ]);

    echo $this->Breadcrumbs->render(
        ['class' => 'breadcrumbs-trail'],
        ['separator' => ':::']
    );

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



<style>

    .breadcrumbs-trail{

        list-style-type: none;
        position: absolute; 
        top: 55px;
        right: 40px;

    }

    .breadcrumbs-trail li {

        float: left;

    }    

</style>

<script>

    var csrf_token = <?php echo json_encode($this->request->getParam('_csrfToken')) ?>; 
    var checkouturl = "<?php echo $this->Url->build('/orders/checkout', true) ?>";  
    var test = ["test", "test2"];


    $("#checkout").click(function() {

        $.ajax({
                    type: 'post',
                    url: checkouturl,
                    headers: {'X-CSRF-Token': csrf_token},
                    data: {data : test},
                    success: function(result){

                       console.log(result);

                    },
                    error: function (xhr, ajaxOptions, thrownError) {

                        console.log(xhr);
                        console.log(thrownError);

                    }
            });              
        });  
        

</script>