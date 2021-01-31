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
    if(isset($_POST['stn'])) {
        $stn = $_POST['stn'];
        $date = "2021-01-30";
        if (!file_exists("data/{$stn}_{$date}")) {
                print("data is not availible}");
        } else {
            $strJsonFileContents = file_get_contents("data/{$stn}_{$date}");
            $arrayJson = json_decode($strJsonFileContents, true);
            for($i = 0; $i < $arrayJson; $i++){
                $temperature = $arrayJson[$i]['TEMP'];
                $dewp = $arrayJson[$i]['DEWP'];
                $relHumidity = ($dewp / $temperature)*100;
            }

        }
    }



    ?>

</div>