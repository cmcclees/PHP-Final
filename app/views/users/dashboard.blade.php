@extends('layouts.base')
@section('head')

<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">

    // Load the Visualization API and the piechart package.
    google.load('visualization', '1.0', {'packages':['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);

    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
    function drawChart() {



        // Create the data table.
        var genres = new google.visualization.DataTable(<?=$json_genres?>);
        var devices = new google.visualization.DataTable(<?=$json_devices?>);

        // Set chart options
        var genre_options = {
            'title':'Which Genres You Watch Most',
            'width':900,
            'height':700};

        var device_options = {'title':'Which Devices you use to Watch Movies',
            'width':900,
            'height':700};

        // Instantiate and draw our chart, passing in some options.
        var genre_chart = new google.visualization.BarChart(document.getElementById('genre_chart_div'));
        var device_chart = new google.visualization.BarChart(document.getElementById('device_chart_div'));
        genre_chart.draw(genres, genre_options);
        device_chart.draw(devices, device_options);

    }
</script>
@stop

@section('sidebar')
    @parent
@stop

@section('content')
<div id="genre_chart_div"></div>
<div id="device_chart_div"></div>

@stop