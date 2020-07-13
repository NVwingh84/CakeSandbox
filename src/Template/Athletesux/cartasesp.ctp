
<div id="charts_test1"></div>
<div id="charts_test2"><ul id="athletes_display"></ul></div>

<?php // debug($athletes); ?>

<script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});
      var athletes = <?php echo json_encode($athletes); ?> 
      var options = { tooltip: {isHtml: true, trigger: 'selection'}, legend: 'none'};

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
        var chart = new google.visualization.ColumnChart(document.getElementById('charts_test1'));

        chart.setAction({
          id: 'getcountryathletes',
          text: 'See sample book',
          action: function() {
            selection = chart.getSelection();
            console.log(selection[0].row);
            getAthletes(selection[0].row);
            $('.google-visualization-tooltip').remove();
          }
        }); 

        chart.draw(dataTable, options);
        
      }

      // you perform the interaction in a chart function, not in standard JS.. 

      function getAthletes(value){

        console.log(athletes_check[value]);

        $("#charts_test2").show();

        $.each(athletes_check[value], function(key, countryathlete ) {

          $("#athletes_display").append('<li>' + countryathlete.first_name + '</li>');

        });
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
        position: absolute; 
        left: 0px;
        top: 0px;
        width: 100px;
        height: 500px;
        display: none;
        background-color: yellow;

    }    

</style>