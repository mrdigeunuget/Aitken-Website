<?php session_start(); ?>
<html lang="eng">
    <head>
        <title>Stationsinformatie</title>
        <link rel="stylesheet" type="text/css" href="index.css">
        <link rel="stylesheet" type="text/css" href="station.css">
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
            </div>
        </div>
<script>
        function openData(evt, cityName) {
        // Declare all variables
        var i, tabcontent, tablinks;

        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
        }

        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Show the current tab, and add an "active" class to the button that opened the tab
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";

        }
        document.getElementById("defaultOpen").click();
        // Get the element with id="defaultOpen" and click on it

</script>
        <div class='backbox'>
            <div class ='tab'>
                <button class = "tablinks" onclick="openData(event,'graph')" id="defaultOpen">Graph</button>
                <button class = "tablinks" onclick="openData(event,'table')">Table</button>
            </div>

            <?php
                $stn = "";
                if(isset($_POST['stn'])) {
                    $stn = $_POST['stn'];
                }
                if(!file_exists("data/17_2021-01-27_$stn")){
                    print("file is non-existant");
                }else{
                    $strJsonFileContents = file_get_contents("data/17_2021-01-27_$stn");
                    $array = json_decode($strJsonFileContents, true);
                    print("<div id='graph' class='tabcontent'>");
                    $dataPoints = array();
                    $dataPointsRain = array();
                    print("<div class= 'currentcountry'> 
                                Current station: $stn
                                </div>");
                    for($i = 1; $i < 61; $i++){
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
            <div id="chartContainer" style="height: 450px; width: 100%; position: relative;"></div>
            <div id="chartContainerRain" style="height: 450px; width: 100%; position: relative; padding-top: 10px;"></div>
            <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
            <?php
            print("</div>");
            ?>
            <div id="table" class="tabcontent">
                <?php
                    print("<div class= 'currentcountry'> 
                            Current station: $stn
                            </div>");
                        if(!empty($strJsonFileContents)) {
                            print("<table class = stationTable>");
                            for ($i = 0; $i < 60; $i++) {
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
                }
                ?>
            </div>
        </div>

    </body>
</html>

