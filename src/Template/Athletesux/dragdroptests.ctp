



<div class="flex-container">
    <div id="chart_lefttop" class="chartdiv" ondrop="drop_handler(event)" ondragover="dragover_handler(event)" ondragleave="dragleave_handler(event)">
        <button id="draggable_button" class="button" sortable="true" draggable="true" ondragstart="dragstart_button(event)" ondragend="dragend(event)">Button Element</button>    
    </div>

    <div id="chart_midtop" class="chartdiv" ondrop="drop_handler(event)" ondragover="dragover_handler(event)" ondragleave="dragleave_handler(event)">
        <p id="draggable_text" class="text" sortable="true" draggable="true" ondragstart="dragstart_text(event)" ondragend="dragend(event)">This element is draggable.</p>    
    </div>



    <div id="chart_righttop" class="chartdiv" ondrop="drop_handler(event)" ondragover="dragover_handler(event)" ondragleave="dragleave_handler(event)"></div>
    <div id="chart_leftbottom" class="chartdiv" ondrop="drop_handler(event)" ondragover="dragover_handler(event)" ondragleave="dragleave_handler(event)"></div>
    <div id="chart_midbottom" class="chartdiv" ondrop="drop_handler(event)" ondragover="dragover_handler(event)" ondragleave="dragleave_handler(event)"></div>
    <div id="chart_rightbottom" class="chartdiv" ondrop="drop_handler(event)" ondragover="dragover_handler(event)" ondragleave="dragleave_handler(event)"></div>
</div>


<script>

    // ondragover for instance opacity, border change, form change AS LONG AS IT IS BEING DRAGGED OVER, indicates that it is droppable 
    // ondragenter only when entering, very small thingy in combination with ondragover 

    var dragged_class = "";
    
    function dragstart_text(ev) {

        // console.log(ev.target.id);
        ev.target.style.border = "dashed";
        ev.dataTransfer.setData("text/plain", ev.target.innerText);
        dragged_class = "text";

    }

    // ev.target is the element that is being dragged..
    function dragstart_button(ev){

        ev.target.style.border = "dashed";
        ev.dataTransfer.setData("application/my-app", ev.target.id);
        dragged_class = "button";

    }

    // ev.target is the element that is dropped into..
    function drop_handler(ev) {

        // console.log(ev.target.id);
        ev.preventDefault();

        console.log($(ev.target).children());

        if(dragged_class === "button"){

            const data = ev.dataTransfer.getData("application/my-app");
            // $(ev.target).append(document.getElementById(data));
            var toClone = document.getElementById(data).cloneNode(true);
            $(ev.target).append(toClone);

        }

        else if(dragged_class === "text"){

            const text = ev.dataTransfer.getData("text/plain");
            $(ev.target).append(text);

        }
    }

    function dragend(ev){

        ev.preventDefault();     
        ev.target.style.border = "none";   

    }





    // feedback function UX.. 
    function dragover_handler(ev) {

        ev.preventDefault();
        // $(ev.target).css('background-color', 'yellow');

    }

    // feedback function UX.. 
    function dragleave_handler(ev){

        ev.preventDefault();
        // $(ev.target).css('background-color', 'white');        

    }
    
</script>





<style>

    .chartdiv{

        border: 5px solid black;
        height: 250px;
        width: 33%;
        margin: auto;

    }

    @media only screen and (max-width: 600px) {
        .chartdiv {
            width: 100%;
        }
    }

    @media only screen and (min-width: 601px) and (max-width: 1200px) {
        .chartdiv {
            width: 50%;
        }
    }

    .flex-container {

        display: flex;
        flex-flow: row wrap;
        width: 100%;

    }

</style>
