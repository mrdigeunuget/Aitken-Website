<?php session_start(); ?>
<html lang="eng">
    <head>
        <title>Stationsinformatie</title>
        <link rel="stylesheet" type="text/css" href="index.css">
    </head>
    <body>
        <ul class="navBar">
            <div class="photo">
                <a href='index.php'><img src="pictures/logoWhite.png" alt="diamond"></a>
            </div>
            <div class='btn-group'>
                <a href="index.php">Home</a>
                <a class="active" href="station.php">Station</a>
            </div>
        </ul>
        <div class='extraBackBox'>
            <div class='stations'>

                <form method='post' action=''>
                    <fieldset>
                    <legend>Stationnumber</legend>
                        <input type="text" class="stationTextInput" name="stn" placeholder="e.g. 123456" />
                    <input type='submit' class='submitButton' value='Search'>
                    </fieldset>
                </form>
            </div>
        </div>

        <?php
        $stn = "";
        if(isset($_POST['stn'])) {
            $stn = $_POST['stn'];
        }
        if(!file_exists("data/2021-01-26_$stn")){
            print("file is non-existant");
        } else {
            $strJsonFileContents = file_get_contents("data/2021-01-26_$stn");
            $array = json_decode($strJsonFileContents, true);
            $graph = 0;
            $stnExtra = 0;
            $dataPoints = array();
            $dataPointsRain = array();
            if(empty($_GET['graph'])){
                $graph = 1;
            }
            if(isset($_GET['graph'])){
                $graph = $_GET['graph'];
            }
                if(isset($_POST['stn'])) {
                    if($graph == 2){
                    $stn = $_POST['stn'];
                    print("<div class='backbox'><div class='graphTable'>
                    <a href=station.php?stationNumber=$stn&graph=1 class ='graphTable'>Graph</a>
                    <a href=station.php?stationNumber=$stn&graph=2 class = 'graphTable'>Table</a></div>");


                    print("<div class= 'currentcountry'> 
                        Current station: $stn
                        </div>");


                    $i = 0;
                    if(!empty($strJsonFileContents)) {
                        print("<table class = stationTable>");
                        for ($i = 0; $i < sizeof($array); $i++) {
                            print("<tr>");
                            if ($i == 0) {
                                print("<th>STN</th>
                                                    <th>DATE</th>
                                                    <th>TIME</th>
                                                    <th>TEMP</th>
                                                    <th>DEWP</th>
                                                    <th>STP</th>
                                                    <th>SLP</th>
                                                    <th>VISIB</th>
                                                    <th>WDSP</th>
                                                    <th>PRCP</th>
                                                    <th>SNDP</th>
                                                    <th>FRSHTT</th>
                                                    <th>CLDC</th>
                                                    <th>WNDDIR</th></tr><tr>");
                            }
                            isset($array[$i]["STN"]) ? print("<td>{$array[$i]["STN"]}</td>") : print("<td></td>");
                            isset($array[$i]["DATE"]) ? print("<td>{$array[$i]["DATE"]}</td>") : print("<td></td>");
                            isset($array[$i]["TIME"]) ? print("<td>{$array[$i]["TIME"]}</td>") : print("<td></td>");
                            isset($array[$i]["TEMP"]) ? print("<td>{$array[$i]["TEMP"]}</td>") : print("<td></td>");
                            isset($array[$i]["DEWP"]) ? print("<td>{$array[$i]["DEWP"]}</td>") : print("<td></td>");
                            isset($array[$i]["STP"]) ? print("<td>{$array[$i]["STP"]}</td>") : print("<td></td>");
                            isset($array[$i]["SLP"]) ? print("<td>{$array[$i]["SLP"]}</td>") : print("<td></td>");
                            isset($array[$i]["VISIB"]) ? print("<td>{$array[$i]["VISIB"]}</td>") : print("<td></td>");
                            isset($array[$i]["WDSP"]) ? print("<td>{$array[$i]["WDSP"]}</td>") : print("<td></td>");
                            isset($array[$i]["PRCP"]) ? print("<td>{$array[$i]["PRCP"]}</td>") : print("<td></td>");
                            isset($array[$i]["SNDP"]) ? print("<td>{$array[$i]["SNDP"]}</td>") : print("<td></td>");
                            isset($array[$i]["FRSHTT"]) ? print("<td>{$array[$i]["FRSHTT"]}</td>") : print("<td></td>");
                            isset($array[$i]["CLDC"]) ? print("<td>{$array[$i]["CLDC"]}</td>") : print("<td></td>");
                            isset($array[$i]["WNDDIR"]) ? print("<td>{$array[$i]["WNDDIR"]}</td>") : print("<td></td>");
                            print("</tr>");
                        }
                    }else {
                        print("There is no data available for this station");
                    }
                print("</table>");
                }elseif($graph == 1){
                        $stn = $_POST['stn'];
                    print("<div class='backbox'>
                    <a href=station.php?stationNumber=$stn&graph=1 class = 'graphTable'>Graph</a>
                    <a href=station.php?stationNumber=$stn&graph=2 class = 'graphTable'>Table</a>");


                    print("<div class= 'currentcountry'> 
                        Current station: $stn
                        </div>");

                            for($i = 0; $i < sizeof($array); $i++){
                                        array_push($dataPoints, array("x" => $i, "y" => $array[$i]["TEMP"]));
                                        array_push($dataPointsRain, array("x" => $i, "y" => $array[$i]["PRCP"]));
                                    }
                                    ?>
            <script>
                window.onload = function () {

                    var chart = new CanvasJS.Chart("chartContainer", {
                        animationEnabled: true,
                        title:{
                            text: "Temperature"
                        },
                        axisY: {
                            title: "Temperature in celcius",
                            suffix: "°C",

                        },

                        axisX: {
                            interval: 1,
                            title: "Second",
                        },

                        data: [{
                            type: "spline",
                            markerSize: 1,

                            xValueType: "Time",
                            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                        }]
                    });

                    chart.render();



                    var chartRain = new CanvasJS.Chart("chartContainerRain", {
                        animationEnabled: true,
                        title:{
                            text: "Rainfall"
                        },
                        axisY: {
                            title: "Rainfall in mm",
                            suffix: "mm",

                        },

                        axisX: {
                            interval: 1,
                            title: "Second",
                        },

                        data: [{
                            type: "spline",
                            markerSize: 1,

                            xValueType: "Time",
                            dataPoints: <?php echo json_encode($dataPointsRain, JSON_NUMERIC_CHECK); ?>
                        }]
                    });

                    chartRain.render();

                }
            </script>
            <?php
                                }
                            }

            if(isset($_GET['stationNumber'])) {
            if($graph == 2 && empty($_POST['stn'])){
                $stn = $_GET['stationNumber'];
                print("<div class='backbox'>
                <a href=station.php?stationNumber=$stn&graph=1 class = 'graphTable'>Graph</a>
                <a href=station.php?stationNumber=$stn&graph=2 class = 'graphTable'>Table</a>");


                print("<div class= 'currentcountry'> 
                    Current station: $stn
                    </div>");
                $strJsonFileContents = file_get_contents("data/2021-01-26_11510");
                $array = json_decode($strJsonFileContents, true);
                $i = 0;
                if(!empty($strJsonFileContents)) {
                    print("<table class = stationTable>");
                    for ($i = 0; $i < sizeof($array); $i++) {
                        print("<tr>");
                        if ($i == 0) {
                            print("<th>STN</th>
                                                <th>DATE</th>
                                                <th>TIME</th>
                                                <th>TEMP</th>
                                                <th>DEWP</th>
                                                <th>STP</th>
                                                <th>SLP</th>
                                                <th>VISIB</th>
                                                <th>WDSP</th>
                                                <th>PRCP</th>
                                                <th>SNDP</th>
                                                <th>FRSHTT</th>
                                                <th>CLDC</th>
                                                <th>WNDDIR</th></tr><tr>");
                        }
                        isset($array[$i]["STN"]) ? print("<td>{$array[$i]["STN"]}</td>") : print("<td></td>");
                        isset($array[$i]["DATE"]) ? print("<td>{$array[$i]["DATE"]}</td>") : print("<td></td>");
                        isset($array[$i]["TIME"]) ? print("<td>{$array[$i]["TIME"]}</td>") : print("<td></td>");
                        isset($array[$i]["TEMP"]) ? print("<td>{$array[$i]["TEMP"]}</td>") : print("<td></td>");
                        isset($array[$i]["DEWP"]) ? print("<td>{$array[$i]["DEWP"]}</td>") : print("<td></td>");
                        isset($array[$i]["STP"]) ? print("<td>{$array[$i]["STP"]}</td>") : print("<td></td>");
                        isset($array[$i]["SLP"]) ? print("<td>{$array[$i]["SLP"]}</td>") : print("<td></td>");
                        isset($array[$i]["VISIB"]) ? print("<td>{$array[$i]["VISIB"]}</td>") : print("<td></td>");
                        isset($array[$i]["WDSP"]) ? print("<td>{$array[$i]["WDSP"]}</td>") : print("<td></td>");
                        isset($array[$i]["PRCP"]) ? print("<td>{$array[$i]["PRCP"]}</td>") : print("<td></td>");
                        isset($array[$i]["SNDP"]) ? print("<td>{$array[$i]["SNDP"]}</td>") : print("<td></td>");
                        isset($array[$i]["FRSHTT"]) ? print("<td>{$array[$i]["FRSHTT"]}</td>") : print("<td></td>");
                        isset($array[$i]["CLDC"]) ? print("<td>{$array[$i]["CLDC"]}</td>") : print("<td></td>");
                        isset($array[$i]["WNDDIR"]) ? print("<td>{$array[$i]["WNDDIR"]}</td>") : print("<td></td>");
                        print("</tr>");
                    }
                }else {
                    print("There is no data available for this station");
                }
                print("</table>");

            }elseif($graph == 1 && empty($_POST['stn'])){
                $stn = $_GET['stationNumber'];
                print("<div class='backbox'>
                <a href=station.php?stationNumber=$stn&graph=1 class = 'graphTable'>Graph</a>
                <a href=station.php?stationNumber=$stn&graph=2 class = 'graphTable'>Table</a>");

                print("<div class= 'currentcountry'> 
                    Current station: $stn
                    </div>");

        for($i = 0; $i < sizeof($array); $i++){
            array_push($dataPoints, array("x" => $i, "y" => $array[$i]["TEMP"]));
            array_push($dataPointsRain, array("x" => $i, "y" => $array[$i]["PRCP"]));
        }
        ?>

                        <script>
                            window.onload = function () {

                                var chart = new CanvasJS.Chart("chartContainer", {
                                    animationEnabled: true,
                                    title:{
                                        text: "Temperature"
                                    },
                                    axisY: {
                                        title: "Temperature in celcius",
                                        suffix: "°C",

                                    },

                                    axisX: {
                                        interval: 1,
                                        title: "Second",
                                    },

                                    data: [{
                                        type: "spline",
                                        markerSize: 1,

                                        xValueType: "Time",
                                        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                                    }]
                                });

                                chart.render();

                                var chartRain = new CanvasJS.Chart("chartContainerRain", {
                                    animationEnabled: true,
                                    title:{
                                        text: "Rainfall"
                                    },
                                    axisY: {
                                        title: "Rainfall in mm",
                                        suffix: "mm",

                                    },

                                    axisX: {
                                        interval: 1,
                                        title: "Second",
                                    },

                                    data: [{
                                        type: "spline",
                                        markerSize: 1,

                                        xValueType: "Time",
                                        dataPoints: <?php echo json_encode($dataPointsRain, JSON_NUMERIC_CHECK); ?>
                                    }]
                                });

                                chartRain.render();

                            }
                        </script>
                        <?php
                    }
                }
        }
        ?>

        <div id="chartContainer" style="height: 450px; width: 100%; position: relative;"></div>
        <div id="chartContainerRain" style="height: 450px; width: 100%; position: relative; padding-top: 10px;"></div>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    </body>
</html>

