
<div id="charts_test1"></div>


<script type="text/javascript">

    google.charts.load('current', {'packages':['gauge']});
    google.charts.setOnLoadCallback(drawChart);

    // not possible to animate option that is equal to value 
    // maybe try pie chart? 

    var memory = 30;

    var optionsadapted = {
          width: 400, height: 400,
          greenFrom: 0, greenTo: memory,
          minorTicks: 0, animation : {duration: 1000, easing: 'inAndOut'}
        };

    function drawChart() {

      var data = google.visualization.arrayToDataTable([
        ['Label', 'Value'],
        ['Memory', memory],
        ['CPU', 55],
      ]);

      function changeOptions(memory){

        optionsadapted = {
          width: 400, height: 400,
          greenFrom: 0, greenTo: memory,
          minorTicks: 0, animation : {duration: 1000, easing: 'inAndOut'}
        };
      }

      var chart = new google.visualization.Gauge(document.getElementById('charts_test1'));
      chart.draw(data, optionsadapted);
      setInterval(function() {
        
        memory = 88;
        data.setValue(0, 1, memory);
        chart.draw(data, optionsadapted);

        setInterval(function() {
        
          changeOptions(memory);       
          chart.draw(data, optionsadapted);      

        }, 1000);

      }, 2500);

    }




</script>


<style>

    #charts_test1{

        float:left; 
        width: 50%;
        height: 500px;
        display: inline;
        position: absolute; 
        left: 50%;
        transform: translateX(-50%);

    }

    #charts_test1 table tr td:first-child svg{

      width: 240;
      height: 240;

    }

    #charts_test1 table tr td:first-child svg g circle:nth-child(1){

      stroke-width: 0;
      fill: #F6F6F6;

    }

    #charts_test1 table tr td:first-child svg g circle:nth-child(2){

      stroke-width: 0;
      fill: white;

    }    

    #charts_test1 table tr td:first-child svg g path{

      fill: #00FFAC;
      stroke-width: 2;
      stroke: #f2f2f2;
      stroke-width: 1;

    }   

    #charts_test1 table tr td:first-child svg g g path{

      fill: #00FFAC;
      stroke-width: 1;
      stroke: #f2f2f2;

    }    

    #charts_test1 table tr td:first-child svg g g circle{

      fill: #f2f2f2;
      stroke: 0;
      r: 0;

    }    

    // path underneath is the actual value strip 


</style>