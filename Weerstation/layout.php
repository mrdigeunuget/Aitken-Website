<html>
	<body>
		<ul class="navBar">
			<div class="photo">
				<img src="sandwich.jpg">
			</div>
			<li><a href="index.php">Home</a></li>
			<li><a href="broodjes.php">Broodjes</a></li>
			<li><a href="info.php">Contact</a></li>
			<li><a href="echte.php">Bestel</a></li>
      <li><a href="bestelgesch.php">Bestelgeschiedenis</a></li>
			<?php
				require('database.lib.php');
				$dbConnection = dbConnect();
				$sessienummerextra = $_SESSION['persoon'];
				if(empty($sessienummerextra)){
					print('<div class="registreren"><li><a <button href="registreren1.php" class="button10">Registreren</button></a></li></div>');
					print('<div class="inloggen"><li><a <button href="inloggen1.php" class="button10">Inloggen</button></a></li></div>');
				} else {
					$sessienummer = $_SESSION['persoon'];
					if(isset($sessienummer)){
						$sql = 'select gebruikersid from gebruiker where admin = 1';
						$result = mysqli_query($dbConnection,$sql);
						while($row = mysqli_fetch_array($result)){
							if($row["gebruikersid"] == $sessienummer){
								print('<li><a href="adminmain.php">Admin</a></li>');
								$admin = true;
							} 
						}
					}
					if(!$admin){
						print('<li><a href="bestelgesch.php">Bestelgeschiedenis</a></li>');
					}
				}
				dbDisconnect($dbConnection);
			?>
		</ul>
		</body>
	</html>
