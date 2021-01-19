<?php session_start(); ?>
<html lang="eng">
	<head>
		<title> Aitken Spence Weather </title>
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
		<div class='backbox'>
            <div class='stations'>
			<?php
				$query = "SELECT DISTINCT country FROM stations ORDER BY country";
				$result = mysqli_query($dbConnection, $query);
				print("<form method='post' action='station.php'><select id='country' class='select-css' name='country'>");
				while($row = mysqli_fetch_array($result))(
				        print("<option value='{$row['country']}'>".$row['country']."</option>")
                );
				print("</select ><input type='submit' class='btn' value='Select Country'></form>");
            dbDisconnect($dbConnection);
			?>
            </div>";
		</div>
        <div class='backbox'>
            <div class='stations'>
                <form method='post' action='station.php'>
                    <label for="stationnumber">Stationnumber</label><br>
                    <input type="text" id="stationnumber" name="stationnumber"><br>
                <input type='submit' class='btn' value='Search Stationnumber'></form>
            </div>
        </div>
	</body>
</html>