<!-- File: templates/Athletesux/index.php -->
<!-- better to load this centrally, so for all views -->
<?php // echo $this->Html->script('https://use.fontawesome.com/37339b609d.js'); ?> 
<?php // echo $this->Html->script('http://code.jquery.com/jquery.min.js'); ?> 
<?php // echo $this->Html->script('https://www.gstatic.com/charts/loader.js'); ?> 

<h1>Charts Test Pages</h1>

<div id="charts_test1"></div>
<div id="charts_test2"></div>
<div id="charts_next"></div>
<div id="visualization_div"></div>


<script>

    // which version and packages you will use 
    google.charts.load('current', {packages: ['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart(){

        drawChart1();
        drawChart2();

    }

    function drawChart1() {
        // Define the chart to be drawn.
        var data = new google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Work', 11],
            ['Eat', 2],
            ['Commute', 2],
            ['Watch TV', 2],
            ['Sleep', 7]
        ]);

        /*var data = new google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day', {type: 'string', role: 'tooltip', 'p': {'html': true}}],
            ['Work',     11, '<button>Work</button>'],
            ['Eat',      2, 'Eat'],
            ['Commute',  2, 'Commute'],
            ['Watch TV', 2, 'Watch TV'],
            ['Sleep',    7, 'Sleep']
        ]);   */     

        var blue = "#019FD3";
        var yellow = "#FFFF00";
        var green = "#00FFAC";
        var lightblue = "#6DB9D5";

        var options = {

            title: 'example chart',
            is3D: true,
            backgroundColor: {fill: 'blue', fillOpacity: 0.1, stroke: 'black', strokeWidth: '3'},
            // chartArea:{left:150,top:20,width:'250px',height:'250px'},
            colors:['yellow', 'blue', 'green', 'lightblue', 'orange'],
            // pieHole: 0.4
            legend: {textStyle : {color : 'black'}},
            // tooltip: {isHtml: true},
            // pieSliceText: 'label',
            slices: {   1: {offset: 0.3},
                        2: {offset: 0.3},
                        3: {offset: 0.3}
            },
        };

        // Instantiate and draw the chart.
        var chart = new google.visualization.PieChart(document.getElementById('charts_test1'));
        chart.draw(data, options);

    }

    function drawChart2() {
      // Define the chart to be drawn.
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Element');
      data.addColumn('number', 'Percentage');
      data.addRows([
        ['Nitrogen', 0.78],
        ['Oxygen', 0.21],
        ['Other', 0.01]
      ]);

    var options = {

        title: 'example chart',
        sliceVisibilityThreshold: 4/10

    };

      // Instantiate and draw the chart.
      var chart = new google.visualization.PieChart(document.getElementById('charts_test2'));
      chart.draw(data, options);

    }





    var visualization;

    function draw() {
      drawVisualization();
      drawToolbar();
    }

    function drawVisualization() {
      var container = document.getElementById('visualization_div');
      visualization = new google.visualization.PieChart(container);
      new google.visualization.Query('https://spreadsheets.google.com/tq?key=pCQbetd-CptHnwJEfo8tALA').
          send(queryCallback);
    }

    function queryCallback(response) {
      visualization.draw(response.getDataTable(), {is3D: true});
    }

    function drawToolbar() {
      var components = [
          {type: 'igoogle', datasource: 'https://spreadsheets.google.com/tq?key=pCQbetd-CptHnwJEfo8tALA',
           gadget: 'https://www.google.com/ig/modules/pie-chart.xml',
           userprefs: {'3d': 1}},
          {type: 'html', datasource: 'https://spreadsheets.google.com/tq?key=pCQbetd-CptHnwJEfo8tALA'},
          {type: 'csv', datasource: 'https://spreadsheets.google.com/tq?key=pCQbetd-CptHnwJEfo8tALA'},
          {type: 'htmlcode', datasource: 'https://spreadsheets.google.com/tq?key=pCQbetd-CptHnwJEfo8tALA',
           gadget: 'https://www.google.com/ig/modules/pie-chart.xml',
           userprefs: {'3d': 1},
           style: 'width: 800px; height: 700px; border: 3px solid purple;'}
      ];

      var container = document.getElementById('charts_next');
      google.visualization.drawToolbar(container, components);
    };

    google.charts.setOnLoadCallback(draw);

</script>

<style>

    #charts_test1{

        float:left; 
        width: 50%;
        display: inline;

    }

    #charts_test2{

        float:left; 
        width: 50%;
        display: inline;

    }    

</style>