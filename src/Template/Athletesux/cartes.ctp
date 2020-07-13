
<div id="charts_test1"></div>
<div id="charts_test2"></div>


<script type="text/javascript">
      google.charts.load('current');   // Don't need to specify chart libraries!
      var athletes = <?php echo json_encode($athletes); ?> 
      
      // variables & function for basic visualization 
      google.charts.setOnLoadCallback(drawVisualization);
      var options = {'tooltip': {isHtml: true}, 'title': 'Athletes per Country', 'bar' : {groupWidth: "75%", width: '75%'}, 'animation' : {duration: '1000', startup : 'true'}, orientation: 'horizontal'};
      var tableHead = [];
      var tableBody = [];

      function drawVisualization(dataTable) {

        tableHead.push('');
        tableBody.push('');    

        $.each( athletes, function( key, value ) {

          if ((value.athletes).length > 0){

            tableHead.push(value.country[0]);
            tableBody.push((value.athletes).length);
          
          }
        });

        var dataTable = [];
        dataTable.push(tableHead);
        dataTable.push(tableBody);  

        var wrapper = new google.visualization.ChartWrapper({

          chartType: 'ColumnChart',
          dataTable: dataTable,
          options: options,
          containerId: 'charts_test1', 

        });

        wrapper.draw();

      }



      

</script>


<style>

    #charts_test1{

        float:left; 
        width: 100%;
        height: 500px;
        display: inline;

    }

    #charts_test2{

        float:left; 
        width: 100%;
        height: 500px;
        display: inline;

    }    

</style>