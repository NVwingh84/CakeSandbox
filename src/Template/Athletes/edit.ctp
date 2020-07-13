<!-- File: templates/Athletes/edit.php -->

<h1>Edit Athlete</h1>
<?php
    echo $this->Form->create($athlete_pass);

    // create a new control type with custom html 
    $this->Form->setTemplates([
        'runtimesContainer' => '<label>{{label}}</label><input class="{{id}}" label="{{id}}" type="time" id="{{id}}" name="{{name}}" step="0.001">'
    ]);

    echo $this->Form->control('user_id', ['type' => 'hidden']);
    echo $this->Form->control('first_name');
    echo $this->Form->control('last_name');
    
    echo $this->Form->control('threek_time', ['value' => $athlete_pass['3K_time']]);      
    echo $this->Form->control('fivek_time', ['value' => $athlete_pass['5K_time']]);       
    echo $this->Form->control('tenk_time', ['value' => $athlete_pass['10K_time']]);  

    if($athlete_pass['country']){

        echo $this->Form->input('country', array('type'=>'select', 'options'=>$countries, 'value'=> $athlete_pass['country']));   

    } else {

        echo $this->Form->input('country', array('type'=>'select', 'options'=>$countries));   

    }


    echo $this->Form->select('gender', $gender);     
    echo $this->Form->button(__('Save Athlete'));
    echo $this->Form->end();
?>

