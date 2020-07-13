<?php echo $this->Html->script('http://code.jquery.com/jquery.min.js'); ?> 

<!-- File: templates/Articles/edit.php -->

<h1>Edit Article</h1>
<?php
    echo $this->Form->create($article_pass);
    echo $this->Form->control('user_id', ['type' => 'hidden']);
    echo $this->Form->control('title');
    echo $this->Form->control('body', ['rows' => '3']);
    echo $this->Form->select('articlecat_id', $article_categories, ['id' => 'article_cat']);     
    echo $this->Form->button(__('Save Article'));
    echo $this->Form->end();
    
    $csrfToken = $this->request->getParam('_csrfToken');

?>

<button id="edit_category">Adapt Article Category</button>

<div id="ajax_data"></div>


<script>

    var csrf_token = <?php echo json_encode($csrfToken) ?>;  

    $(window).load(function() {   

        // get article category data from controller method through ajax call 
        // populate the form with them      
        $('#edit_category').click(function(){

            var targeturl = "http://wampprojects/composer_cakephptut/articles/editcategory"; 

            var category_selected = $('#article_cat').children("option:selected").val();
            console.log(category_selected);

            // if an article category is selected 
            if ($('#article_cat').children("option:selected").val()){

                $.ajax({
                    type: 'post',
                    url: targeturl,
                    headers: {'X-CSRF-Token': csrf_token},
                    data: {category: category_selected},
                    success: function(result){

                        console.log(result);

                        // create a form with a POST action that links to database 
                        $('#ajax_data').html(result);
                        
                    }
                });

            }else{

                console.log("no cat selected");

            }
        });
    });
</script>

