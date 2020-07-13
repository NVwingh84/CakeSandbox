<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>


<div id="container_images" class="flex-container">
    
    <div id="chart_lefttop" class="chartdiv">
        <div class="inner_div"></div>
        <div id="textbox"><h4 class="tiletext">Some Nice Text</h4></div>         
        <img id="arrow" src="<?php echo $this->Url->image('motiontest/arrow_tile.png'); ?>">                 
        <img id="topyellow" src="<?php echo $this->Url->image('motiontest/topyellow_tiles.png'); ?>">
        <img id="bottomyellow" src="<?php echo $this->Url->image('motiontest/bottomyellow_tiles.png'); ?>">
        <img id="bottompurple" src="<?php echo $this->Url->image('motiontest/bottompurple_tiles.png'); ?>">
    </div>
    <div id="chart_midtop" class="chartdiv">
        <img id="topyellow" src="<?php echo $this->Url->image('motiontest/topyellow_tiles.png'); ?>">
        <img id="bottomyellow" src="<?php echo $this->Url->image('motiontest/bottomyellow_tiles.png'); ?>">
        <img id="bottompurple" src="<?php echo $this->Url->image('motiontest/bottompurple_tiles.png'); ?>">
    </div>
    <div id="chart_righttop" class="chartdiv">
        <img id="topyellow" src="<?php echo $this->Url->image('motiontest/topyellow_tiles.png'); ?>">
        <img id="bottomyellow" src="<?php echo $this->Url->image('motiontest/bottomyellow_tiles.png'); ?>">
        <img id="bottompurple" src="<?php echo $this->Url->image('motiontest/bottompurple_tiles.png'); ?>">  
    </div>
</div>

<div id="hoverdiv">just showing what it can do..</div>


<script>
    
    // testing if velocity.js library works as it should
    // test is succesful!!
    $("#hoverdiv").hover(function() {
        
        console.log("test");
        
        $("#chart_lefttop").velocity({
            width: "800px"
        }, {
            /* Velocity's default options */
            duration: 400,
            easing: "swing",
            loop: false,
            delay: 200
        });
  
    });

</script>


<style>

    body{
        
        background-color: #2B71A7;
        
    }
    
    .chartdiv{
        
        border: 0px solid black;
        background-color: #2DA8D5;
        height: 250px;
        width: 350px;
        margin: auto;
        border-top-right-radius: 30px;
        box-shadow: 5px 10px 5px #ffffff;
        overflow: hidden;

    } 
    
    .inner_div{

        height: 100%;
        width: 100%;
        border-top-right-radius: 30px;
        background-image: url('../img/motiontest/formback_tile.png');
        transition: all 0.5s ease;
        // background-image: url('../img/motiontest/running_background.jpg');        
        
    }
    
    .inner_div:hover{
        
        transform: scale(1.2);
        
    }
    
    
    #textbox{
        
        position: absolute;
        bottom: 70px;
        margin-left: 40px;
        
    }
    
    #arrow{
        
        width: 70px;
        position: absolute;
        bottom: 60px;
        margin-left: 40px;
        
    }
    
    #topyellow{

        position: absolute;
        width: 325px;
        top:0px;
            
        }
    
    #bottomyellow{

        position: absolute;
        width: 351px;
        bottom:0px;
            
        }    
    
    #bottompurple{

        position: absolute;
        width: 351px;
        bottom: 0px;        
            
        }    
    
    .tiletext{
            
        color: white;
        font-weight: bold;
            
        }
        
        
    
    
    

    @media only screen and (max-width: 600px) {
        .chartdiv {
            // width: 100%;
        }
    }

    @media only screen and (min-width: 601px) and (max-width: 1200px) {
        .chartdiv {
            // width: 50%;
        }
    }

    .flex-container {

        display: flex;
        flex-flow: row wrap;
        width: 100%;

    }

    #container_images{

        position: absolute;
        top: 150px;
        z-index: 2;

    }

</style>