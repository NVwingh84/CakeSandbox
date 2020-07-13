
<div id="events_info"></div>
<div id="charts_test1"></div>


<script type="text/javascript">

    var events = <?php echo json_encode($events); ?>   

    // console.log(events[0]['start_date']);

    if(events[0]['start_date'] <= events[0]['end_date']){

      console.log(new Date(events[0]['end_date']));

    }

    google.charts.load("current", {packages:["calendar"]});
    google.charts.setOnLoadCallback(drawChart);


    function drawChart() {

      var dataTable = new google.visualization.DataTable();
      dataTable.addColumn({ type: 'date', id: 'Date'});
      dataTable.addColumn({ type: 'number', id: 'event_id' });
      dataTable.addColumn({type: 'string', role: 'tooltip', p: {'html': true}});

      // what if two events on the same day? 
      $.each(events, function(key, event) {

          // console.log(event);
          dataTable.addRow([new Date(event.start_date), event.id, '<div id="tooltip">' + event.title + '<br><a href="http://wampprojects/composer_cakephptut/events/' + event.id + '">view event</a></div>']);

      });      

      var chart = new google.visualization.Calendar(document.getElementById('charts_test1'));

      var options = {
        title: "Athletics Events Calendar 2020",
        height: 350,
        tooltip: {trigger: 'selection'}, 
        calendar: {cellColor: {stroke: '#91edbd', strokeWidth: 0.3}, 
          cellSize : 10,
          focusedCellColor: {stroke: 'red', strokeWidth: 2},
          monthOutlineColor: {stroke: 'blue', strokeWidth: 1.4},
          unusedMonthOutlineColor: {stroke: 'blue', strokeWidth: 1.4},
          yearLabel: {fontName: 'Times-Roman', fontSize: 1, color: '#ffffff', bold: false, italic: false
          },
        },    
        colorAxis: {colors:['#45dec4','#45dec4']},
        noDataPattern: {backgroundColor: '#f0f5f4', color: '#f0f5f4'}
      };

      // shows events so you can enroll etcetera.. 
      function selectHandler() {
        
        var selection = chart.getSelection();
        var events_date = [];

        if (selection.length > 0) {

          var selectedDate = new Date(selection[0].date);
          // console.log(selectedDate);

          $("#events_info" ).empty( );

          // here you can do something with this date to get out possible events.. 
          $.each(events, function(key, event) {

              var event_date = new Date(event['start_date']);

              // if there are events on this date 
              if(event_date.getTime() === selectedDate.getTime()){

                events_date.push(event);
                
                // if there are events in it, show them with link to go to event.. 
                $("#events_info" ).append( '<p>' + event.title + '<a href="http://wampprojects/composer_cakephptut/events/view/' + event.id +'">view event</a></p>' ); 

              };
          });   
        }
      }

      // Listen for the 'select' event, and call my function selectHandler() when
      // the user selects something on the chart.
      google.visualization.events.addListener(chart, 'select', selectHandler);

      chart.draw(dataTable, options);

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

    #events_info{

      height: 150px;

    }

    #charts_test1 svg g:nth-child(1){

      display: none;

    }

</style>