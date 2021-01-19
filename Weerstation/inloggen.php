<?php session_start(); ?>
    <html>
    <head>
        <title>Log in</title>
    </head>
    <body>
<?php
$gebruikersnaam = $_POST['user'];
$wachtwoord = $_POST['password'];

require('database.lib.php');
$dbConnection = dbConnect();
$sql = "SELECT * FROM admin
     WHERE user = '$gebruikersnaam'
     AND password = '$wachtwoord'";
$result = mysqli_query($dbConnection,$sql);
if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $_SESSION['persoon'] = 1;
    echo "<script>
          alert('succesvol ingelogd, klik op OK om te bestellen');
          window.location.href='index.php';
         </script>";
}else {
    echo "<script>
          alert('verkeerde wachtwoord of gebruikersnaam, probeer het opnieuw');
          window.location.href='login.php';
         </script>";
}

?>