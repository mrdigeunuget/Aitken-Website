<?php session_start(); ?>
<html lang="eng">
    <head>
        <title> Aitken Spence Weather </title>
        <link rel="stylesheet" type="text/css" href="index.css">
    </head>
    <body>
        <ul class="navBar">
            <div class="photo">
                <a href='index.php'><img src="pictures/logoWhite.png" alt="diamond"></a>
            </div>
            <div class='btn-group'>
                <a class="active" href="index.php">Home</a>
                <a href="station.php">Station</a>
                <a href="download.php">Download</a>
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
        <div class='backbox'>
            <div class='stations'>
                <?php
                include 'country_names.php';
                print("<form method='post' action=''><fieldset><legend>Country</legend><select id='country' class='selectCountry' name='country'>");
                for($i=0; $i < sizeof($stationsCountry); $i++) {
                    print("<option value='{$stationsCountry[$i]}'>$stationsCountry[$i]</option>");
                };
                print("</select ><input type='submit' class='submitButton' value='Select Country'></fieldset></form>");
                ?>
            </div>
            <?php

                if(isset($_POST['country'])) {
                    include 'country_data.php';
                    $stationland = $_POST['country'];
                    echo "<form method='post' action='station.php'>";
                    print ("<table class='stationTable'>
                                        <tr>
                                            <th>Number</th>
                                            <th>Name</th>
                                            <th>Country</th>
                                            <th>Latitude</th>
                                            <th>Longitude</th>
                                            <th>Elevation</th>
                                        </tr>");
                    for ($i = 0; $i < sizeof($stationInformation); $i++) {
                        if ($stationInformation[$i]['country'] == $stationland) {
                                print ("<tr>
                                            <td><input type='submit' class='stnButton' name='stn' value='{$stationInformation[$i]['stn']}'></td>
                                            <td>{$stationInformation[$i]['name']}</td>
                                            <td>{$stationInformation[$i]['country']}</td>
                                            <td>{$stationInformation[$i]['latitude']}</td>
                                            <td>{$stationInformation[$i]['longitude']}</td>
                                            <td>{$stationInformation[$i]['elevation']}</td>
                                        </tr>");
                            }
                        }
                    print ("</form></table>");
                }
            ?>
        </div>
    </body>
</html>