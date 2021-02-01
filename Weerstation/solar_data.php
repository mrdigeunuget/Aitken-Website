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
<div class = 'backbox'>
    <div class='stations'>
        <?php
        include 'country_names.php';
        print("<form method='post' action=''><fieldset style='border-radius: 5px'><legend>Solar panels</legend><select id='solarCountry' class='selectCountry' name='solarCountry'>");
        for($i=0; $i < sizeof($stationsCountry); $i++) {
            if ($stationsCountry[$i] == 'SRI LANKA' || $stationsCountry[$i] == 'INDIA') {
                print("<option value='{$stationsCountry[$i]}'>$stationsCountry[$i]</option>");
            }
        }
        print("</select ><input type='submit' class='submitButton' value='Select Country'></fieldset></form>");
        ?>
    </div>
</div>
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
            if (file_exists("/home/group8/jsonfiles/{$stn}_{$date}")) {
                $strJsonFileContents = file_get_contents("/home/group8/jsonfiles/{$stn}_{$date}");
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
                                array_push($finalArray, array("Temper" => $heatCelcius, "place" => $tempArray[$j]['name']));
                            }
                        }
                    }
                }
//                function sortByOrder($a, $b) {
//                    return $a[0] - $b[0];
//                }
//

            }

        }
        array_multisort( array_column( $finalArray, 'Temper' ), SORT_DESC, SORT_NUMERIC, $finalArray );


        ?>


            <table class="stationTable">
                <tr>
                    <th>Country</th>
                    <th>Region</th>
                    <th>Heat index</th>
                </tr>
                <?php
                $i=0;
                foreach ($finalArray as $key=>$value) {
                    print("<tr>
                        <td>{$countryName}</td>
                        <td>{$value['place']}</td>
                        <td>".round($value['Temper'],2)."°C</td>
                        </tr>");
                    if($i==4){
                        break;
                    }
                    $i++;
                }
                ?>
            </table>



<?php

    }
?>
</div>
</body>
</html>