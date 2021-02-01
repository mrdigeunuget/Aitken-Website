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
                <a class="active" href="download.php">Download</a>
                <a href="solar_data.php">Solar panels</a>
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
                    <fieldset style="border-radius: 5px">
                        <legend >Search</legend>
                        <fieldset style="border-bottom: none; border-radius: 5px 5px 0 0;padding-bottom: 0;">
                            <label style="color: white">Stationnumber</label><br>
                            <input type="text" class="stationTextInput" name="stn" placeholder="e.g. 123456" style="margin-bottom: 10px"/>
                        </fieldset>
                        <fieldset style="margin-top: 0;border-radius: 0 0 5px 5px">
                            <label style="color: white">Date</label><br>
                            <input type="text" class="stationTextInput" name="date" placeholder="e.g. 2021-01-27" style="margin-bottom: 10px">
                        </fieldset>
                        <input type='submit' class='submitButton' value='Search'>
                    </fieldset>
                </form>
            </div>
        </div>
        <?php
            $stn = "";
            if(isset($_POST['stn'])) {
                $stn = $_POST['stn'];
            }
            $date = "";
            if(isset($_POST['date'])){
                $date = $_POST['date'];
            }
            if(!file_exists("/home/group8/jsonfiles/{$stn}_{$date}")){
                if($stn != "") {
                    print("file is non-existant, {$stn}_{$date}");
                }
            }else {
                print("<div class='backbox'>
                        <form action='fileDownload.php' method='post'>
                            <input type='hidden' name='filename' value='{$stn}_{$date}'>
                            <input class='submitButton' type='submit' value='download {$stn}_{$date}.xml'>
                        </form>
                       </div>");
            }

        ?>
    </body>
</html>
