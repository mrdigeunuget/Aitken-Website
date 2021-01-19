<?php session_start(); ?>
<html>
 <head>
  <title>inloggen</title>
 </head>
  <body>
   <?php
    $gebruikersnaam = $_POST['gebruikersnaam'];
    $wachtwoord = $_POST['wachtwoord']; 
 
    require('database.lib.php');
	  $dbConnection = dbConnect(); 
    $sql = "SELECT * FROM gebruiker
     WHERE gebruikersnaam = '$gebruikersnaam'
     AND wachtwoord = '$wachtwoord'";
     $result = mysqli_query($dbConnection,$sql);
       if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $_SESSION['persoon'] = $row['gebruikersid'];
         echo "<script>
          alert('succesvol ingelogd, klik op OK om te bestellen');
          window.location.href='broodjes.php';
         </script>"; 
       }else {
         echo "<script>
          alert('verkeerde wachtwoord of gebruikersnaam, probeer het opnieuw');
          window.location.href='inloggen1.php';
         </script>";
       }
   
 ?>
 </body>
</html>