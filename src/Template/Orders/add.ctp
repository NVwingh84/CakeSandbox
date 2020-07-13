<?php  echo $this->Html->script('http://code.jquery.com/jquery.min.js'); ?> 

<!-- File: templates/Orders/add.php -->


<!-- Still need to do the following -->
<!-- Prepopulate the category select with an empty option -->
<!-- Need validation on the form, article needs to be mandatory -->
<!-- On selecting an article it needs to be added to a card-like something -->
<h1>Add Order</h1>
<?php
    // you relate to attributes of this object in the control element of the form 
    echo $this->Form->create($order_creating);

    // Hard code the user for now. The id will be taken from another model related to authentication. 
    echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => 1]);
    echo $this->Form->control('title');
    echo $this->Form->control('body', ['rows' => '3']);

    // still need to make sure you have correct key => value pairs need to be id => name 
    // find('list') is made for this.. 
    echo $this->Form->select('customer_id', $customers); 

    // article categories in a first step select 
    echo $this->Form->select('articlecat_id', $art_categories, ['multiple' => false, 'id' => "articlecat_select"]);
 
    // articles to generate 
    echo $this->Form->select('article_id', $article_basetext, ['multiple' => true, 'id' => "article_select"]);
    
    echo $this->Form->button('Save Order', ['id' => "save_order"]);
    echo $this->Form->end();

    // debug($this->request->getParam('_csrfToken'));

    $csrfToken = $this->request->getParam('_csrfToken');

    ?> 

<!--
<button id="ajax_button">Ajax</button>

<button id="weather_button">Weather</button>
-->


<script>

    var csrf_token = <?php echo json_encode($csrfToken) ?>;  

    // try to reproduce this in jquery and then make the ajax call 
    // ajax call works, need to create targeturl the proper way 
    // how to handle data on the controller 
    $(window).load(function() {   

      $('#ajax_button').click(function(){

        var targeturl = "http://wampprojects/composer_cakephptut/orders/dynamic-articleload"; 
        
        // console.log(csrf_token);

        $.ajax({
            type: 'post',
            url: targeturl,
            headers: {'X-CSRF-Token': csrf_token},
            data: {number: 5},
            success: function(result){

                console.log(result);

            }
        });
      });

        $('#weather_button').click(function(){

            var targeturl = "http://wampprojects/composer_cakephptut/orders/weatherdata"; 


            $.ajax({
                type: 'post',
                url: targeturl,
                headers: {'X-CSRF-Token': csrf_token},
                data: {number: 5},
                success: function(result){

                    console.log(result);

                }
            });
        });

        // FUNCTION FOR DYNAMIC POPULATION OF ARTICLES ON CATEGORY SELECT 
        // better way to set targeturl 
        $('#articlecat_select').change(function(){

            var categoryselectUrl = "http://wampprojects/composer_cakephptut/orders/categorySelect"; 
            var cat_select = $('#articlecat_id').val();
            var selected_category = $(this).children("option:selected").val();

            
            // this ajax request populates the multipleselect article widget 
            // based on the articlecategory selected 
            $.ajax({
                type: 'post',
                url: categoryselectUrl,
                headers: {'X-CSRF-Token': csrf_token},
                data: {category: selected_category},
                success: function(result){

                    // result is in JSON format back to javascript array 
                    var json_articles = JSON.parse(result); 
                    console.log(json_articles);

                    $('#article_select').find('option').remove();
                    
                    // for each method is working with index and value 
                    $.each(json_articles, function(index, article) {
                        
                        $('#article_select').append($('<option>').val(index).text(article));               
                    
                    });
                }
            });
        });
    });

</script>

