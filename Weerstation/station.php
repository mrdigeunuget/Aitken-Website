<?php session_start(); ?>
    <html>
    <head>
        <title>Stationsinformatie</title>
        <link rel="stylesheet" type="text/css" href="index.css">
    </head>
    <body>
<ul class="navBar">
    <div class="photo">
        <a class='button1' href='index.php'><img src="pictures/diamond.png" alt="diamond"></a>
    </div>
    <div class='btn-group'>
        <a class="button1" href="index.php">Home</a>

        <?php
        require('database.lib.php');
        $dbConnection = dbConnect();
        $sessienummerextra = $_SESSION['persoon'];
        if(empty($sessienummerextra)){
            header("Location: login.php", true, 301);
        } else {
            print('<a class="button1" href="sessionend.php" >Log out</a>');
            $sessienummer = $_SESSION['persoon'];
        }
        ?>
    </div>
</ul>
<?php
if(isset($_POST['country'])) {
    $stationland = $_POST['country'];
    $sql = "SELECT * FROM stations
     WHERE country = '$stationland'";
    if ($result = mysqli_query($dbConnection, $sql)) {
        if ($result->num_rows > 0) {
            echo "<table class='stationtable'>";
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
    print("<div class= 'currentcountry'> 
        Current country: $stationland
        </div>");
}

if(isset($_POST['stationnumber'])) {
    $stationnumber = $_POST['stationnumber'];
    $sql = "SELECT * FROM stations
     WHERE stn = '$stationnumber'";
    if ($result = mysqli_query($dbConnection, $sql)) {
        if ($result->num_rows > 0) {
            echo "<table class='stationtable'>";
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
            print("This is no valid stationnumber");
        }
    } else {
        print("iets met de verbinding");
    }
}

print("<div class='stationcountry'>");
				$query = "SELECT DISTINCT country FROM stations ORDER BY country";
				$result = mysqli_query($dbConnection, $query);
				print("<form method='post' action='station.php'><select id='country' class='select-css' name='country'");
				while($row = mysqli_fetch_array($result))(
				        print("<option value='{$row['country']}'>".$row['country']."</option>")
                );
				print("</select ><input type='submit' class='btn' value='Select Country'></form>");
			dbDisconnect($dbConnection);
print("</div>");
?>

    <div class='stationnumbernumber'>
        <form method='post' action='station.php'>
            <label for="stationnumber">Stationnumber</label><br>
            <input type="text" id="stationnumber" name="stationnumber"><br>
            <input type='submit' class='btn' value='Search Stationnumber'></form>
    </div>
    </body>
    </html>

