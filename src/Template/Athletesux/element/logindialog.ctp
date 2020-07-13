<!-- modal for athlete add & edit actions --> 
<div id="shader_modal">

</div>

    <div id="add_modal">

        <h1>User Login</h1>

        <a id="close">close</a>

        <?php

        echo $this->Form->create($user, ['url' => ['controller' => 'Users', 'action' => 'login']]); 

        echo $this->Form->control('email'); 
        echo $this->Form->control('password'); 
        
        echo $this->Form->button('Login');

        echo $this->Form->end(['data-type' => 'hidden']);
        
        echo $this->Html->link('Register', ['controller' => 'users', 'action' => 'register']);  
        
        ?>

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
