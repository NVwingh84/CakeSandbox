<!-- File: templates/Events/index.php -->

<?php $csrfToken = $this->request->getParam('_csrfToken'); ?>

<h1> Testing Events Index Access as API </h1>

<script>


    var csrf_token = <?php echo json_encode($csrfToken) ?>;  // token for ajax calls 
    
    console.log(csrf_token);

    $(window).load(function() { 
    
        $.ajax({
                type: 'get',
                url: "http://wampprojects/composer_cakephptut/events/index",
                headers: {'X-CSRF-Token': csrf_token},
                success: function(result){

                    console.log(result);

                }
        });         
    
    });


</script>


