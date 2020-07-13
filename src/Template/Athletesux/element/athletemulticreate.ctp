<?php echo $this->Html->script('http://code.jquery.com/jquery.min.js'); ?> 

<!-- modal for athlete add & edit actions --> 
<div id="shader_modal"></div>

<div id="add_modal">

    <h1><?php echo $action ?> Athledddte</h1>

    <a id="close">close</a>

    <?php

    echo $this->Form->create($athlete, ['url' => ['controller' => 'Athletesux', 'action' => $action]]);
    
    // Hard code the user for now. The id will be taken from another model related to authentication. 
    echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => 1]);
    echo $this->Form->control('first_name', ['id' => 'first_name']);
    echo $this->Form->control('last_name', ['id' => 'last_name']); ?> 

    <!-- This is not better with respect to Usability, creates security vulnerability. Definitely NO GO.. -->
    <input type="time" id="3K_time" step="2" value="<?php $athlete['3K_time'] ?>" required>
    <input type="time" id="5K_time" step="2" value="<?php $athlete['5K_time'] ?>" required>
    <input type="time" id="10K_time" step="2" value="<?php $athlete['10K_time'] ?>" required>

    <?php
    echo $this->Form->select('country', $countryoptions, ['id' => 'country']);  
    echo $this->Form->select('gender', $gender, ['id' => 'gender']);   
    echo $this->Form->end();
    ?> 
    
    <button id="saveathlete">Save Athlete</button>
    <button id="nextadd">Add next</button>       
    
</div>


<script>
   
    $('#close').click(function(){

        $('#add_modal').remove();
        $('#shader_modal').remove();

    });

    $('#shader_modal').click(function(){

        $('#add_modal').remove();
        $('#shader_modal').remove();        

    });  

    // no window load for an element!!!! maybe need to transfer these methods to the original page?? 
    //$(window).load(function() {       

        var all_athletes = [];
        var athletes_add = new Array();   

        // save all values of array to database as new athletes 
        $('#saveathlete').click(function(){

            // console.log('save athlete');

            var multiadd_url = "http://wampprojects/composer_cakephptut/athletesux/multiadd";

            // first add the last element to the array 
            if($('#first_name').val() && $('#last_name').val() && $('#3K_time').val() && $('#5K_time').val() && $('#10K_time').val() && $('#gender').val() && $('#country').val()){

                var current_athlete = new Array();
                current_athlete.push({'user_id' :  $('#user-id').val(),'first_name' : $('#first_name').val(), 'last_name' : $('#last_name').val(), 'threek_time' : $('#3K_time').val() , 'fivek_time' : $('#5K_time').val(), 'tenk_time' : $('#10K_time').val(), 'country' : $('#country').val(), 'gender' : $('#gender').val()});

                // add element to array which you are going to use for saving athletes in final save operation 
                athletes_add.push(current_athlete);

                // clear values & keep the user id
                $('#first_name').val('');
                $('#last_name').val('');
                $('#3K_time').val('');
                $('#5K_time').val('');
                $('#10K_time').val('');
                $('#country').val('AF');
                $('#gender').val('m');

                console.log(athletes_add);    

            // then send athlete array to the controller where you will perform the save action 
            $.ajax({

                type: 'post',
                url: multiadd_url,
                headers: {'X-CSRF-Token': csrf_token},
                data: {athletes_save : athletes_add},
                success: function(result){

                    $('#add_modal').remove();
                    $('#shader_modal').remove();  
                    location.reload(true);
    
                    }
                });  


            } else {

                console.log('form not validated');

                alert("All boxes need to be filled in..");

            }
        });      

        // save all values to an array
        $('#nextadd').click(function(){       

            // console.log("nextadd");

            // form validation, all need to be filled in.. 
            // what else can you do wrong? 
            if($('#first_name').val() && $('#last_name').val() && $('#3K_time').val() && $('#5K_time').val() && $('#10K_time').val() && $('#gender').val() && $('#country').val()){

                // create new object with current athlete 
                var current_athlete = new Array();
                current_athlete.push({'user_id' :  $('#user-id').val(),'first_name' : $('#first_name').val(), 'last_name' : $('#last_name').val(), 'threek_time' : $('#3K_time').val() , 'fivek_time' : $('#5K_time').val(), 'tenk_time' : $('#10K_time').val(), 'country' : $('#country').val(), 'gender' : $('#gender').val()});
                
                // add element to array which you are going to use for saving athletes in final save operation 
                athletes_add.push(current_athlete);

                console.log(athletes_add);

                // clear values & keep the user id
                $('#first_name').val('');
                $('#last_name').val('');
                $('#3K_time').val('');
                $('#5K_time').val('');
                $('#10K_time').val('');
                $('#country').val('AF');
                $('#gender').val('m');

            } else {

                console.log('form not validated');
                alert("All boxes need to be filled in..");

            }
        });
    //});

</script>

<style>
    #close{
        position: fixed; 
        right: 5px;
        top: 5px;
    }

    #add_modal{

        position: fixed;
        display: block;
        height: 100vh;
        width: 90vw;
        border-radius: 25px;
        background-color: white;
        border: 10px black solid;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        overflow: auto;

    }

    #shader_modal{

        position: absolute;
        left: 0px;
        top: 0px;
        height: 100vh; 
        width: 100vw;
        background-color: white;
        opacity: 0.7;

    }

</style>
