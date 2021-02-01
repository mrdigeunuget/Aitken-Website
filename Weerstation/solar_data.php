<?php session_start(); ?>
<html lang="eng">
<head>
    <title>Stationsinformatie</title>
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" type="text/css" href="station.css">
    <script type="text/javascript" src="scripts.js"></script>
</head>
<body >
<ul class="navBar">
    <div class="photo">
        <a href='index.php'><img src="pictures/logoWhite.png" alt="diamond"></a>
    </div>
    <div class='btn-group'>
        <a href="index.php">Home</a>
        <a href="station.php">Station</a>
        <a href="download.php">Download</a>
        <a class="active" href="solar_data.php">Solar panels</a>
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
<div class="backbox">
    <?php
    if(isset($_POST['solarCountry'])) {
        $countryName = $_POST['solarCountry'];
        include 'country_data.php';
        $tempArray = [];
        $finalArray = [];
        $date = "2021-01-30";
        for($i = 0; $i < sizeof($stationInformation); $i++){
            if($stationInformation[$i]['country'] == $countryName){
                array_push($tempArray, $stationInformation[$i]);
            }
        }
        for($j = 0; $j < sizeof($tempArray); $j++) {
            $stn = $tempArray[$j]['stn'];
            $placeName = $tempArray[$j]['name'];
            $arrayValue = "";
            $c1 = -42.379;
            $c2 = 2.0490153;
            $c3 = 10.14333127;
            $c4 = -0.22475541;
            $c5 = pow(10, -3) * -6.83783;
            $c6 = pow(10, -2) * -5.481717;
            $c7 = pow(10, -3) * 1.22874;
            $c8 = pow(10, -4) * 8.5282;
            $c9 = pow(10, -6) * -1.99;
            if (file_exists("data/{$stn}_{$date}")) {
                $strJsonFileContents = file_get_contents("data/{$stn}_{$date}");
                $arrayJson = json_decode($strJsonFileContents, true);
                for ($k = 0; $k < sizeof($arrayJson); $k++) {
                    if ($stn == $arrayJson[$k]['STN']) {
                        $temperature = $arrayJson[$k]['TEMP'];
                        if ($temperature > 25) {
                            $dewp = $arrayJson[$k]['DEWP'];
                            $tempTemp = ($temperature * 9 / 5) + 32;
                            $relHumidity = 100 * (exp((17.625 * $dewp) / (243.04 + $dewp)) / exp((17.625 * $temperature) / (243.04 + $temperature)));
                            $heatIndex = ($c1 + ($c2 * $tempTemp) + ($c3 * $relHumidity) + ($c4 * $tempTemp * $relHumidity) + ($c5 * pow($tempTemp, 2)) + ($c6 * pow($relHumidity, 2)) + ($c7 * (pow($tempTemp, 2)) * $relHumidity) + ($c8 * $tempTemp * (pow($relHumidity, 2))) + ($c9 * (pow($tempTemp, 2)) * (pow($relHumidity, 2))));
                            $heatCelcius = ($heatIndex - 32) * 5 / 9;
                            if ($arrayValue == "" || $heatCelcius > $arrayValue) {
                                array_push($finalArray, array($heatCelcius, $tempArray[$j]['name']));
                            }
                        }
                    }
                }
                function sortByOrder($a, $b) {
                    return $a[0] - $b[0];
                }

                usort($finalArray, 'sortByOrder');
            }
        }

        ?>
        <div class = "backbox">
            <div id="table" class = 'tabcontent'>
            <table>
                <tr>
                    <th>Country</th>
                    <th>Region</th>
                    <th>Heat index</th>
                </tr>
                <?php
                if($countryName == 'INDIA') {
                    for ($i = 0; $i < 5; $i++) {
                        print("<tr>
                    <td>India</td>
                    <td>{$finalArray[$i][0]}</td>
                    <td>{$finalArray[$i][1]}</td>
                    </tr>");
                    }
                }else {
                    for ($i = 0; $i < 4; $i++) {
                        print("<tr>
                    <td>Sri Lanka</td>
                    <td>{$finalArray[$i][0]}</td>
                    <td>{$finalArray[$i][1]}</td>
                    </tr>
                    ");
                    }
                }
                ?>
            </table>
            </div>
        </div>

<?php

    }
?>
</div>
</body>
</html>