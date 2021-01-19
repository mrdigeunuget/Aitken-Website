<?php session_start(); ?>
<html>
	<head>
		<title> Aitken Spence Weather </title>
		<link rel="stylesheet" type="text/css" href="index.css">
	</head>

	<body>
		<ul class="nav">
			<div class="foto">
				<a class='button1' href='index.php'><img src="pictures/diamond.png"></a>
			</div>
			<div class='btn-group'>	
				<a class="button1" href="index.php">Home</a>

				<?php
//					require('database.lib.php');
//					$dbConnection = dbConnect();
//					$sessienummerextra = $_SESSION['persoon'];
//					if(empty($sessienummerextra)){
//						print('<a class="button2" href="registreren1.php" >Registreren</a>');
//						print('<a class="button2" href="inloggen1.php" >Inloggen</a>');
//					} else {
//						print('<a class="button2" href="sessionend.php" >uitloggen</a>');
//						$sessienummer = $_SESSION['persoon'];
//						if(isset($sessienummer)){
//							$sql = 'select gebruikersid from gebruiker where admin = 1';
//							$result = mysqli_query($dbConnection,$sql);
//							while($row = mysqli_fetch_array($result)){
//								if($row["gebruikersid"] == $sessienummer){
//									print('<a class="button1" href="adminmain.php">Admin</a>');
//									$admin = true;
//								}
//							}
//						}
//						if(!$admin){
//							print('<a class="button1" href="bestelgesch.php">Bestelgeschiedenis</a>');
//						}
//					}
				
				?>
			</div>
		</ul>
		<div class='backbox'>
<!--			--><?php
//				$query1 = "select id,naam,foto from broodjes where id = 1";
//				$result1 = mysqli_query($dbConnection, $query1);
//				$record1 = mysqli_fetch_assoc($result1);
//				$query2 = "select id,naam,foto from broodjes where id = 2";
//				$result2 = mysqli_query($dbConnection, $query2);
//				$record2 = mysqli_fetch_assoc($result2);
//				$query3 = "select id,naam,foto from broodjes where id = 3";
//				$result3 = mysqli_query($dbConnection, $query3);
//				$record3 = mysqli_fetch_assoc($result3);
//			echo "	<div class='persbroodjes'>
//						<form method='post' action=''>
//							<input type='hidden' name='broodje' value='{$record1['naam']}'>
//							<input type='image' src='broodjes/{$record1['foto']}' width='243px' height='140px' border='0' alt='Submit' />
//							<input type='hidden' name='broodje' value='{$record2['naam']}'>
//							<input type='image' src='broodjes/{$record2['foto']}' width='243px' height='140px' border='0' alt='Submit' />
//							<input type='hidden' name='broodje' value='{$record3['naam']}'>
//							<input type='image' src='broodjes/{$record3['foto']}' width='243px' height='140px' border='0' alt='Submit' />
//
//						</form>
//					</div>";
//			dbDisconnect($dbConnection); ?>
		</div>
	</body>
</html>