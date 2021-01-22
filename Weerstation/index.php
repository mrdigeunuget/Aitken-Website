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
        <div class='backbox'>
            <div class='stations'>
                <?php
                $query = "SELECT DISTINCT country FROM stations ORDER BY country";
                $result = mysqli_query($dbConnection, $query);
                print("<form method='post' action=''><select id='country' class='selectCountry' name='country'>");
                while($row = mysqli_fetch_array($result))(
                print("<option value='{$row['country']}'>{$row['country']}</option>")
                );
                print("</select ><input type='submit' class='submitButton' value='Select Country'></form>");
                ?>
            </div>
            <?php
                if(isset($_POST['country'])) {
                    $stationland = $_POST['country'];
                    $sql = "SELECT * FROM stations
                            WHERE country = '$stationland'";
                    if ($result = mysqli_query($dbConnection, $sql)) {
                        echo "<form method='post' action='station.php'>";
                        if ($result->num_rows > 0) {
                            print ("<table class='stationTable'>
                                        <tr>
                                            <th>Number</th>
                                            <th>Name</th>
                                            <th>Country</th>
                                            <th>Latitude</th>
                                            <th>Longitude</th>
                                            <th>Elevation</th>
                                        </tr>");
                            while ($row = mysqli_fetch_array($result)) {
                                print ("<tr>
                                            <td><input type='submit' class='stnButton' name='stn' value='{$row['stn']}'></td>
                                            <td>{$row['name']}</td>
                                            <td>{$row['country']}</td>
                                            <td>{$row['latitude']}</td>
                                            <td>{$row['longitude']}</td>
                                            <td>{$row['elevation']}</td>
                                        </tr>");
                            }
                            print ("</form></table>");
                        } else {
                            print ("Er ging iets fout");
                        }
                    } else {
                        print ("iets met de verbinding");
                    }
                }
            ?>
        </div>
    </body>
</html>