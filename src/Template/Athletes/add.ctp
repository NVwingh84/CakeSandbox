<!-- File: templates/Athletes/add.php -->

<h1>Add Athlete</h1>
<?php
    echo $this->Form->create($athletes);

    // create a new control type with custom html 
    $this->Form->setTemplates([
        'runtimesContainer' => '<label>{{label}}</label><input class="{{id}}" label="{{id}}" type="time" id="{{id}}" name="{{name}}" step="0.001">'
    ]);
    
    // Hard code the user for now. The id will be taken from another model related to authentication. 
    echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => 1]);
    echo $this->Form->control('first_name');
    echo $this->Form->control('last_name');
    
    echo $this->Form->control('threek_time', ['type' => 'runtimes', 'templateVars' => ['id' => '3K_time', 'name' => '3K_time', 'label' => '3K best time']]);
    
    // echo $this->Form->control('3K_time', ['type' => 'time']);      
    echo $this->Form->control('fivek_time', ['type' => 'time']);       
    echo $this->Form->control('tenk_time', ['type' => 'time']);   
    echo $this->Form->select('country', $countries);  
    echo $this->Form->select('gender', $gender);       
    echo $this->Form->button(__('Save Athlete'));
    echo $this->Form->end();
?>

