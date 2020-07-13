<?php echo $this->Html->script('http://code.jquery.com/jquery.min.js'); ?> 

<!-- File: templates/Articlecats/index.php -->
<h1>Article Categories</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Title</th>      
        <th>Operations</th>
    </tr>
    
    <?php foreach ($categories as $cat): ?>
    <tr>
        <td>
            <?php echo ($cat['id']) ?>
        </td>
        <td>
            <!-- published & created when through mysql CLI or in system, not directly through database -->
            <?php echo ($cat['title']) ?>
        </td>
        <td>
            <!-- target = _blank refers to opening a new page  -->
            <?php 
                echo $this->Html->link('Add', ['action' => 'add', 'target' => '_blank']); 
                echo $this->Html->link('Delete', ['action' => 'delete', $cat->id]); 
                echo $this->Html->link('Edit', ['action' => 'edit', $cat->id]); 
                echo $this->Html->link('View', ['action' => 'view', $cat->id]);                 
            ?>
        </td>
    </tr>
    <?php endforeach; 
    
    $csrfToken = $this->request->getParam('_csrfToken');

    ?>
    
</table>



<button id="add_cat"> AddCat </button>

<script>

    var current_athlete = new Array();
    current_athlete.push({'user_id' :  3,'title' : 'test title'});
    var multiadd_url = "http://wampprojects/composer_cakephptut/articlecats/add_test";   
    var csrf_token = <?php echo json_encode($csrfToken) ?>;      

    $('#add_cat').click(function(){

        console.log(current_athlete);

        $.ajax({

            type: 'post',
            url: multiadd_url,
            headers: {'X-CSRF-Token': csrf_token},
            data: {athletes_save : current_athlete},
            success: function(result){

                console.log(result);

            }
        });  
    });        

</script>