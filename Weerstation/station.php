<?php session_start(); ?>
<html>
    <head>
        <title>Stationsinformatie</title>
        <link rel="stylesheet" type="text/css" href="index.css">
    </head>
    <body>
        <ul class="navBar">
            <div class="photo">
                <a href='index.php'><img src="pictures/diamond.png" alt="diamond"></a>
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
        <div class="backbox">
        <?php
            if(isset($_POST['stn'])) {
                $stn = $_POST['stn'];
                $sql = "SELECT * FROM data
                        WHERE stn = '$stn'
                        GROUP BY time";
                if ($result = mysqli_query($dbConnection, $sql)) {
                    if ($result->num_rows > 0) {
                        echo "<table class='stationTable'>
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
                                </tr>";
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>
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
                                  </tr>";
                        }
                        echo "</table>";
                    } else {
                        print("Er ging iets fout");
                    }
                } else {
                    print("iets met de verbinding");
                }
                print("<div class= 'currentcountry'> 
                    Current country: $stn
                    </div>");
            }
        ?>
        </div>
    </body>
</html>

