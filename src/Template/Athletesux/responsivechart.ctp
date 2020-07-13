
<div id="container_charts" class="flex-container">
    <div id="chart_lefttop" class="chartdiv">

    </div>
    <div id="chart_midtop" class="chartdiv"></div>
    <div id="chart_righttop" class="chartdiv"></div>
    <div id="chart_leftbottom" class="chartdiv"></div>
    <div id="chart_midbottom" class="chartdiv"></div>
    <div id="chart_rightbottom" class="chartdiv"></div>
</div>

<div id="container_images" class="flex-container">
    <div id="chart_lefttop" class="chartdiv" ondrop="dropItem(event)" ondragover="dragover_handler(event)" ondragleave="dragleave_handler(event)">
        <img id="lefttop_image" draggable= true ondragstart="dragStart(event)" ondragend="dragEnd(event)">
    </div>
    <div id="chart_midtop" class="chartdiv" ondrop="dropItem(event)" ondragover="dragover_handler(event)" ondragleave="dragleave_handler(event)">
        <img id="midtop_image" draggable= true ondragstart="dragStart(event)" ondragend="dragEnd(event)">    
    </div>
    <div id="chart_righttop" class="chartdiv" ondrop="dropItem(event)" ondragover="dragover_handler(event)" ondragleave="dragleave_handler(event)">
        <img id="righttop_image" draggable= true ondragstart="dragStart(event)" ondragend="dragEnd(event)">        
    </div>
    <div id="chart_leftbottom" class="chartdiv" ondrop="dropItem(event)"></div>
    <div id="chart_midbottom" class="chartdiv"></div>
    <div id="chart_rightbottom" class="chartdiv"></div>
</div>




<script type="text/javascript"> 

    var original_container;

    function dragStart(ev){

        original_container = ev.target.parentNode;
        ev.target.style.border = "dashed";
        ev.dataTransfer.setData("application/my-app", ev.target.id);        

    }

    function dragEnd(ev){

        ev.preventDefault();     
        ev.target.style.border = "none";   

    }    

    function dropItem(ev){

        // console.log(ev.target.parentNode);
        ev.preventDefault();

        // switch element in getData with element in targeted div
        // apparently you get the id of the img, so need to target parent element 
        const data = ev.dataTransfer.getData("application/my-app");
        // console.log(ev.target.parentNode.id);

        // if there is already an element, will add to existing (append) or will overwrite (html).. 
        // add the element you are moving to the element you drop it in 
        console.log(ev.target.parentNode);
        $(ev.target.parentNode).append(document.getElementById(data));

        // add the existing element from the element you drop it in to the div it originates from 
        console.log(ev.target.id);
        $(original_container).append(document.getElementById(ev.target.id));
     
    }

    // feedback function UX.. 
    function dragover_handler(ev) {

        ev.preventDefault();
        $(ev.target).css('background-color', 'yellow');

    }

    // feedback function UX.. 
    function dragleave_handler(ev){

        ev.preventDefault();
        $(ev.target).css('background-color', 'white');        

    }





    google.charts.load('current', {'packages':['corechart']});

        var athletes = <?php echo json_encode($athletes); ?> 
        var options = {tooltip: {isHtml: true, trigger: 'selection'}, legend: 'none', title: 'Athletes per Country'};

        var athletes_check = [];

        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            
            var dataTable = new google.visualization.DataTable();
            dataTable.addColumn('string', 'Country');
            dataTable.addColumn('number', 'Number Athletes');
            // A column for html tooltip 
            // dataTable.addColumn({type: 'string', role: 'tooltip', p: {'html': true}});

            $.each( athletes, function(key, countryinfo ) {

                if (countryinfo.athletes.length > 0){

                athletes_check.push(countryinfo.athletes);
                dataTable.addRow([countryinfo.country[0], countryinfo.athletes.length]);

                }
            });

            // draw chart in html element with data & options 
            var chartlefttop = new google.visualization.ColumnChart(document.getElementById('chart_lefttop'));
            var chartmidtop = new google.visualization.BarChart(document.getElementById('chart_midtop'));
            var chartrighttop = new google.visualization.LineChart(document.getElementById('chart_righttop'));
            var chartleftbottom = new google.visualization.ScatterChart(document.getElementById('chart_leftbottom'));
            var chartmidbottom = new google.visualization.ColumnChart(document.getElementById('chart_midbottom'));
            var chartrightbottom = new google.visualization.ColumnChart(document.getElementById('chart_rightbottom'));


            // set image & draw chart for the six charts.. 
            google.visualization.events.addListener(chartlefttop, 'ready', function() {     

                $('#lefttop_image').attr('src', chartlefttop.getImageURI());
                
            });   

            chartlefttop.draw(dataTable, options); 



            google.visualization.events.addListener(chartmidtop, 'ready', function() {     

                $('#midtop_image').attr('src', chartmidtop.getImageURI());

                });   

            chartmidtop.draw(dataTable, options);



            google.visualization.events.addListener(chartrighttop, 'ready', function() {     

                $('#righttop_image').attr('src', chartrighttop.getImageURI());

                });   

            chartrighttop.draw(dataTable, options);




            chartleftbottom.draw(dataTable, options);
            chartmidbottom.draw(dataTable, options);
            chartrightbottom.draw(dataTable, options);
        
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

    #container_charts{

        opacity: 0;

    }

    #container_images{

        position: absolute;
        top: 50px;
        z-index: 2;

    }

</style>