
<select id="country_select"></select>
<select id="distance_select">
    <option value="threek"> 3K Times </option>
    <option value="fivek"> 5K Times </option>
    <option value="tenk"> 10K Times </option>
</select>
<div id="charts_test1"></div>
<div id="hidden_div" style="display:none"></div>
<img id="test_image" src="">


<script type="text/javascript">

    var countriescathletes = <?php echo json_encode($countryoptions); ?> 
    var athletes = <?php echo json_encode($athletes); ?> 
    var distance_title = '3K';
    var options = {
          title: '3K PB Males ' + 'Belgium',
          height: 400,
          width: 800,
          vAxis: {title: 'Minutes', gridlines : { color: '#b7ebd3'}},
          hAxis: {gridlines : { color: 'red'}},
          animation: {duration: 500, easing: 'out', startup: 'true'},
          orientation: 'horizontal',
          // selectionMode: 'multiple',
          crosshair: {trigger: 'selection'},
          // do not use explorer if not really necessary, chart needs to have good UX without having to scroll ea.. 
          explorer: { actions: ['dragToZoom', 'rightClickToReset'] },
          backgroundColor: {fill: '#ebfaef', stroke: '#e4f2e8', strokeWidth: 4},
          legend: 'none',
          tooltip: {isHtml: true, trigger: 'selection', textStyle: {color: 'yellow'}}
        };

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);


    $(window).load(function() { 

        $.each(countriescathletes, function(val, text) {

            $('#country_select').append(

                $('<option></option>').val(val).html(text)

            );
        });    

        $('#country_select').change(function(){

            redrawChart($('#country_select').val(), $('#distance_select').val());

        });

        $('#distance_select').change(function(){

            redrawChart($('#country_select').val(), $('#distance_select').val());

        });
        

    });

    function calculateOptions(country, distance){

        options = {
          title: distance + ' PB Males ' + country,
          height: 400,
          width: 800,
          vAxis: {title: 'Minutes'},
          backgroundColor: {fill: '#ebfaef', stroke: '#e4f2e8', strokeWidth: 4},
          legend: 'none',
          tooltip: {isHtml: true, trigger: 'selection'}
        };
    }

    function redrawChart(country, distance){

        console.log(distance);

        var redataTable = new google.visualization.DataTable();
        redataTable.addColumn('string', 'Athlete');
        redataTable.addColumn('number', 'Distance PB');
        redataTable.addColumn({type: 'string', role: 'tooltip', p: {'html': true}});    

        // not built for ability to select multiple athletes 
        $.each(athletes[country]['athletes'], function(key, athlete) {

            switch(distance){

                case 'threek': 
                    
                    redataTable.addRow([athlete.last_name, athlete.threek_duration, '<div id="tooltip_scatter"><h5>' + athlete.first_name + " " + athlete.last_name +
                    '</h5><br><p>3K PB : ' + athlete.threek_time + '</p><p>5K PB : ' + athlete.fivek_time + '</p><p>10K PB : ' + athlete.tenk_time 
                    + '</p><a href="http://wampprojects/composer_cakephptut/athletesux">Profile</a></div>']);   

                    distance_title = '3K';     

                    break;            

                case 'fivek': 
                    
                    redataTable.addRow([athlete.last_name, athlete.fivek_duration, '<div id="tooltip_scatter"><h5>' + athlete.first_name + " " + athlete.last_name +
                    '</h5><br><p>3K PB : ' + athlete.threek_time + '</p><p>5K PB : ' + athlete.fivek_time + '</p><p>10K PB : ' + athlete.tenk_time 
                    + '</p><a href="http://wampprojects/composer_cakephptut/athletesux">Profile</a></div>']);  

                    distance_title = '5K';         

                    break;    

                case 'tenk': 
                    
                    redataTable.addRow([athlete.last_name, athlete.tenk_duration, '<div id="tooltip_scatter"><h5>' + athlete.first_name + " " + athlete.last_name +
                    '</h5><br><p>3K PB : ' + athlete.threek_time + '</p><p>5K PB : ' + athlete.fivek_time + '</p><p>10K PB : ' + athlete.tenk_time 
                    + '</p><a href="http://wampprojects/composer_cakephptut/athletesux">Profile</a></div>']);      

                    distance_title = '10K';     

                    break;       
            }

        });  

        var chart = new google.visualization.ScatterChart(document.getElementById('charts_test1'));

        calculateOptions(athletes[country]['country'][0], distance_title);

        chart.draw(redataTable, options);

    }

    function drawChart() {
        
        var dataTable = new google.visualization.DataTable();
        dataTable.addColumn('string', 'Athlete');
        dataTable.addColumn('number', 'Distance PB');
        dataTable.addColumn({type: 'string', role: 'tooltip', p: {'html': true}});    

        // for Belgium to start of with 
        $.each(athletes['BE']['athletes'], function(key, athlete) {

            dataTable.addRow([athlete.last_name, athlete.threek_duration, '<div id="tooltip_scatter"><h5>' + athlete.first_name + " " + athlete.last_name +
             '</h5><br><p>3K PB : ' + athlete.threek_time + '</p><p>5K PB : ' + athlete.fivek_time + '</p><p>10K PB : ' + athlete.tenk_time 
             + '</p><a href="http://wampprojects/composer_cakephptut/athletesux">Profile</a></div>']);

        });  

        var chart = new google.visualization.ScatterChart(document.getElementById('charts_test1'));

        chart.draw(dataTable, options);

    }


</script>


<style>

    #tooltip_scatter{

        width: 250px;
        height: fit-content;
        border: 5px solid white;
        text-align: center;

    }

    #charts_test1{

        position: absolute;
        left: 50%;
        transform: translateX(-50%);

    }


</style>
 