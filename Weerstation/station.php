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
                <?php
                    require('database.lib.php');
                    $dbConnection = dbConnect();
                    $sessienummerextra = $_SESSION['persoon'];
                    if(empty($sessienummerextra)){
                        header("Location: login.php", true, 301);
                    } else {
                        print('<a class="logButton" href="sessionend.php" >Log out</a>');
                        $sessienummer = $_SESSION['persoon'];
                    }
                ?>
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
                <table class="stationTable">
                <?php
                    $strJsonFileContents = file_get_contents("data/2021-01-26_11510");
                    $array = json_decode($strJsonFileContents, true);
                    $i = 0;
                    for($i = 0;$i<sizeof($array);$i++){
                        print("<tr>");
                        if($i == 0){
                            print("<th>WNDDIR</th>
                                        <th>SNDP</th>
                                        <th>WDSP</th>
                                        <th>DEWP</th>
                                        <th>VISIB</th>
                                        <th>TIME</th>
                                        <th>PRCP</th>
                                        <th>STN</th>
                                        <th>STP</th>
                                        <th>DATE</th>
                                        <th>TEMP</th>
                                        <th>SLP</th>
                                        <th>CLDC</th>
                                        <th>FRSHTT</th></tr><tr>");
                        }
                            isset($array[$i]["WNDDIR"])?print("<td>{$array[$i]["WNDDIR"]}</td>"):print("<td></td>");
                            isset($array[$i]["SNDP"])?print("<td>{$array[$i]["SNDP"]}</td>"):print("<td></td>");
                            isset($array[$i]["WDSP"])?print("<td>{$array[$i]["WDSP"]}</td>"):print("<td></td>");
                            isset($array[$i]["DEWP"])?print("<td>{$array[$i]["DEWP"]}</td>"):print("<td></td>");
                            isset($array[$i]["VISIB"])?print("<td>{$array[$i]["VISIB"]}</td>"):print("<td></td>");
                            isset($array[$i]["TIME"])?print("<td>{$array[$i]["TIME"]}</td>"):print("<td></td>");
                            isset($array[$i]["PRCP"])?print("<td>{$array[$i]["PRCP"]}</td>"):print("<td></td>");
                            isset($array[$i]["STN"])?print("<td>{$array[$i]["STN"]}</td>"):print("<td></td>");
                            isset($array[$i]["STP"])?print("<td>{$array[$i]["STP"]}</td>"):print("<td></td>");
                            isset($array[$i]["DATE"])?print("<td>{$array[$i]["DATE"]}</td>"):print("<td></td>");
                            isset($array[$i]["TEMP"])?print("<td>{$array[$i]["TEMP"]}</td>"):print("<td></td>");
                            isset($array[$i]["SLP"])?print("<td>{$array[$i]["SLP"]}</td>"):print("<td></td>");
                            isset($array[$i]["CLDC"])?print("<td>{$array[$i]["CLDC"]}</td>"):print("<td></td>");
                            isset($array[$i]["FRSHTT"])?print("<td>{$array[$i]["FRSHTT"]}</td>"):print("<td></td>");
                        print("</tr>");
                    }
//                    foreach ($array as $key => $jsons) {
//
//                        foreach($jsons as $key => $value) {
//                            if($i==0)
//                            isset($key,$value)?print("<td>{$key},{$value}</td>"):print("<td></td>");
//                        }


                ?>
                </table>
            </div>
        </div>


        <?php
        $graph = 0;
        $stnExtra = 0;
        $dataPoints = array();
        $dataPointsRain = array();
        $iData = 1;
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
                $sql = "SELECT * FROM data
                        WHERE stn = '$stn'
                        GROUP BY time
                        ORDER BY time DESC
                        LIMIT 60";
                if ($result = mysqli_query($dbConnection, $sql)) {
                    if ($result->num_rows > 0) {
                        print ("<table class='stationTable'>
                                <tr>
                                    <th>stn</th>
                                    <th>time</th>
                                    <th>date</th>
                                    <th>temp</th>
                                    <th>dewp</th>
                                    <th>visib</th>
                                    <th>wdsp</th>
                                    <th>prcp</th>
                                    <th>sndp</th>
                                    <th>frshtt</th>
                                    <th>cldc</th>
                                    <th>wnddir</th>
                                    <th>slp</th>                                    
                                </tr>");
                        while ($row = mysqli_fetch_array($result)) {
                            print ("<tr>
                                    <td>{$row['stn']}</td>
                                    <td>{$row['time']}</td>
                                    <td>{$row['date']}</td>
                                    <td>{$row['temp']}</td>
                                    <td>{$row['dewp']}</td>
                                    <td>{$row['visib']}</td>
                                    <td>{$row['wdsp']}</td>
                                    <td>{$row['prcp']}</td>
                                    <td>{$row['sndp']}</td>
                                    <td>{$row['frshtt']}</td>
                                    <td>{$row['cldc']}</td>
                                    <td>{$row['wnddir']}</td>
                                    <td>{$row['slp']}</td>                                    
                                  </tr>");
                        }
                        print ("</table>");
                    } else {
                        print("There is no data available for this station");
                    }
                } else {
                    print("Connection Error");
                }

            }elseif($graph == 1){
                    $stn = $_POST['stn'];
                print("<div class='backbox'>
                <a href=station.php?stationNumber=$stn&graph=1 class = 'graphTable'>Graph</a>
                <a href=station.php?stationNumber=$stn&graph=2 class = 'graphTable'>Table</a>");


                print("<div class= 'currentcountry'> 
                    Current station: $stn
                    </div>");
                $sql = "SELECT * FROM data
                        WHERE stn = '$stn'
                        GROUP BY time
                        ORDER BY time DESC
                        LIMIT 60
                        ";
                        if ($result = mysqli_query($dbConnection, $sql)) {
                            if ($result->num_rows > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    array_push($dataPoints, array("x" => $iData, "y" => $row['temp']));
                                    array_push($dataPointsRain, array("x" => $iData, "y" => $row['prcp']));
                                    $iData++;
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
                            }else {
                              print("There is no data available for this station");
                            }
                        } else {
                           print("Connection Error");
                        }
                    }else {
                    print("Error 404");
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
                $sql = "SELECT * FROM data
                        WHERE stn = '$stn'
                        GROUP BY time
                        ORDER BY time DESC
                        LIMIT 60";
                if ($result = mysqli_query($dbConnection, $sql)) {
                    if ($result->num_rows > 0) {
                        print ("<table class='stationTable'>
                                <tr>
                                    <th>stn</th>
                                    <th>time</th>
                                    <th>date</th>
                                    <th>temp</th>
                                    <th>dewp</th>
                                    <th>visib</th>
                                    <th>wdsp</th>
                                    <th>prcp</th>
                                    <th>sndp</th>
                                    <th>frshtt</th>
                                    <th>cldc</th>
                                    <th>wnddir</th>
                                    <th>slp</th>                                    
                                </tr>");
                        while ($row = mysqli_fetch_array($result)) {
                            print ("<tr>
                                    <td>{$row['stn']}</td>
                                    <td>{$row['time']}</td>
                                    <td>{$row['date']}</td>
                                    <td>{$row['temp']}</td>
                                    <td>{$row['dewp']}</td>
                                    <td>{$row['visib']}</td>
                                    <td>{$row['wdsp']}</td>
                                    <td>{$row['prcp']}</td>
                                    <td>{$row['sndp']}</td>
                                    <td>{$row['frshtt']}</td>
                                    <td>{$row['cldc']}</td>
                                    <td>{$row['wnddir']}</td>
                                    <td>{$row['slp']}</td>                                    
                                  </tr>");
                        }
                        print ("</table>");
                    } else {
                        print("There is no data available for this station");
                    }
                } else {
                    print("Connection Error");
                }
                print("</div>");

            }elseif($graph == 1 && empty($_POST['stn'])){
                $stn = $_GET['stationNumber'];
                print("<div class='backbox'>
                <a href=station.php?stationNumber=$stn&graph=1 class = 'graphTable'>Graph</a>
                <a href=station.php?stationNumber=$stn&graph=2 class = 'graphTable'>Table</a>");


                print("<div class= 'currentcountry'> 
                    Current station: $stn
                    </div>");
                $sql = "SELECT * FROM data
                        WHERE stn = '$stn'
                        GROUP BY time
                        ORDER BY time DESC
                        LIMIT 60";
                if ($result = mysqli_query($dbConnection, $sql)) {
                    if ($result->num_rows > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            array_push($dataPoints, array("x" => $iData, "y" => $row['temp']));
                            array_push($dataPointsRain, array("x" => $iData, "y" => $row['prcp']));
                            $iData++;
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
                    }else {
                        print("There is no data available for this station");
                    }
                } else {
                    print("Connection Error");
                }
            }
            dbDisconnect($dbConnection);
        }


        ?>



        <div id="chartContainer" style="height: 450px; width: 100%; position: relative;"></div>
        <div id="chartContainerRain" style="height: 450px; width: 100%; position: relative; padding-top: 10px;"></div>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    </body>
</html>

