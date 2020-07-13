
<div id="charts_test1"></div>
<div id="hidden_div" style="display:none"></div>
<img id="test_image" src="">

<?php // debug($athletes); ?>

<script type="text/javascript">


    // about image charts in tooltips
    // not legend on the axes, could maybe be used for trends
    // ux of this is also not great.. don't see use case for this.. 

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawPrimaryChart);
    // google.charts.setOnLoadCallback(drawToolTipChart);
    // google.charts.setOnLoadCallback(drawTooltipChartsinCharts);

    var athletes = <?php echo json_encode($athletes); ?> 
    var options = { tooltip: {isHtml: true}, legend: 'none'};
    var tooltip_options = { 
        
        tooltip: {isHtml: true}, 
        legend: 'none',
        vAxis: {maxValue: 29, minValue: 26, title: '10K PB'}}    ;

    var tooltipImg = [];

    function drawTooltipChartsinCharts(country){

        // build up tooltipdata - selection of populated countries already made 
        // make a tooltipchart for Belgium 
        var tooltipData = new google.visualization.DataTable();
        tooltipData.addColumn('string', 'Athlete');
        tooltipData.addColumn('number', '10K Time');

        $.each(athletes[country]['athletes'], function(key, athlete) {

            // need to transform 27:25 into duration 
            var duration_minutes = parseInt(athlete.tenk_time.slice(3, 5));             // 27
            var duration_seconds = parseFloat((athlete.tenk_time.slice(6, 8))/ 60);     // 41
            var duration = duration_minutes + duration_seconds;

            tooltipData.addRow([athlete.last_name, duration]);

        });        
 
        // datatable built.. build view.. 
        // make view with dataTable tooltipData 
        var view = new google.visualization.DataView(tooltipData);

        // draw the actual chart 
        var scatterChart = new google.visualization.ScatterChart(document.getElementById('hidden_div'));

        // create a new Chart & take URI of this chart.. 
        // you can return this and add this to the datatable for the primary data 
        google.visualization.events.addListener(scatterChart, 'ready', function() {     

            tooltipImg.url = scatterChart.getImageURI();
            //$("#test_image").attr('src', scatterChart.getImageURI());

        });   

        scatterChart.draw(view, tooltip_options);

    }








    // arrayToDataTable OR addColumn/ addRow directly in datatable 
    // arrayToDataTable() when you have set data 
    // addColumn/ addRow directly in datatable on creating from retrieved data (99% of cases)
    function drawPrimaryChart() {

        var primary_dataTable = new google.visualization.DataTable();
        primary_dataTable.addColumn('string', 'Country');
        primary_dataTable.addColumn('number', 'Number Athletes');
        primary_dataTable.addColumn({type: 'string', role: 'tooltip', p: {'html': true}});      

        $.each(athletes, function(key, countryinfo) {

            if (countryinfo.athletes.length > 0){

                // draw tooltipchart for a certain country
                drawTooltipChartsinCharts(key);

                // this sets variable you can use in your image src.. 
                primary_dataTable.addRow([countryinfo.country[0], countryinfo.athletes.length, '<img width="500" src="' + tooltipImg.url + '">']);

            }
        });   

        var chart = new google.visualization.ColumnChart(document.getElementById('charts_test1'));
        chart.draw(primary_dataTable, options);        

    }
    






    // EXAMPLE TOOLTIPCHART DRAW FOR BELGIUM 
    // onloadcallback draw tooltipcharts 
    // add tooltipchart as url to primary data 
    // how can you add an extra column to a datatable? create charts, add them to athletes array and then add to datatable in loop.. 
    function drawToolTipChart(){

        // make a tooltipchart for Belgium 
        var tooltipData = new google.visualization.DataTable();
        tooltipData.addColumn('string', 'Athlete');
        tooltipData.addColumn('number', '10K Time');
        tooltipData.addColumn({type: 'string', role: 'tooltip', p: {'html': true}});

        $.each(athletes['BE']['athletes'], function(key, athlete) {

            // console.log(athlete);

            // need to transform 27:25 into duration 
            var duration_minutes = parseInt(athlete.tenk_time.slice(3, 5));           // 27
            var duration_seconds = parseFloat((athlete.tenk_time.slice(6, 8))/ 60);     // 41
            var duration = duration_minutes + duration_seconds;
            // console.log(duration);

            tooltipData.addRow([athlete.last_name, duration, "10K PB = " + athlete.tenk_time]);

        });

        var primaryChart = new google.visualization.ScatterChart(document.getElementById('charts_test1'));

        google.visualization.events.addListener(primaryChart, 'ready', function() {

            var tooltipImg = primaryChart.getImageURI();
            console.log(tooltipImg);

            // set image src 
            $('#test_image').attr('src', tooltipImg);

        });

        primaryChart.draw(tooltipData, options);

    }


</script>


<style>

    #charts_test1{

        float:left; 
        width: 100%;
        height: 500px;
        display: inline;

    }

</style>