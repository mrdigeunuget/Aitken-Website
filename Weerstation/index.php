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
                print("<option value='{$row['country']}'>".$row['country']."</option>")
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
                        if ($result->num_rows > 0) {
                            echo "<table class='stationTable'>";
                            echo "<tr>";
                            echo "<th>Number</th>";
                            echo "<th>Name</th>";
                            echo "<th>Country</th>";
                            echo "<th>Latitude</th>";
                            echo "<th>Longitude</th>";
                            echo "<th>Elevation</th>";
                            echo "</tr>";
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['stn'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['country'] . "</td>";
                                echo "<td>" . $row['latitude'] . "</td>";
                                echo "<td>" . $row['longitude'] . "</td>";
                                echo "<td>" . $row['elevation'] . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        } else {
                            print("Er ging iets fout");
                        }
                    } else {
                        print("iets met de verbinding");
                    }
                }
            ?>
        </div>
    </body>
</html>