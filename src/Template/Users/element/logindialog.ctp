<!-- modal for athlete add & edit actions --> 
<div id="shader_modal">

</div>

    <div id="add_modal">

        <h1><?php echo $action ?> Athlete</h1>

        <a id="close">close</a>

        <?php

        echo $this->Form->create($athlete, ['url' => ['controller' => 'Athletesux', 'action' => $action]]);

        // create a new control type with custom html 
        $this->Form->setTemplates([
            'runtimesContainer' => '<label>{{label}}</label><input class="{{id}}" label="{{id}}" type="time" id="{{id}}" name="{{name}}" step="0.001">'
        ]);
        
        echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => $userid]);
        echo $this->Form->control('first_name');
        echo $this->Form->control('last_name');
        echo $this->Form->control('threek_time', ['value' => $athlete['3K_time']]); 
        echo $this->Form->control('fivek_time', ['value' => $athlete['5K_time']]);     
        echo $this->Form->control('tenk_time', ['value' => $athlete['10K_time']]); 
        echo $this->Form->select('country', $countryoptions);  
        echo $this->Form->select('gender', $gender);   
        
        echo $this->Form->button(__('Save Athlete'));

        echo $this->Form->end();
        
        ?>

    </div>


<script>

    var all_athletes = [];

    $('#close').click(function(){

        $('#add_modal').remove();
        $('#shader_modal').remove();

    });

    $('#shader_modal').click(function(){

        $('#add_modal').remove();
        $('#shader_modal').remove();        

    });    

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
