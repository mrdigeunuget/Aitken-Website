<?php session_start(); ?>
<html lang="eng">
<head>
    <title>Log in</title>
</head>
<body>
<?php
$gebruikersnaam = $_POST['user'];
$wachtwoord = $_POST['password'];
if($gebruikersnaam=="admin@aitken-spence.com" && $wachtwoord == "rqN6vA?A9F") {
    $_SESSION['persoon'] = 1;
    print ("<script>
                      alert('Login was succesfull');
                      window.location.href='index.php';
                     </script>");
} else {
    print ("<script>
                      alert('Wrong password or username, try again');
                      window.location.href='login.php';
                     </script>");
}
?>
</body>
</html>

