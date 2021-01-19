<?php session_start(); ?>
<!DOCTYPE html>
<html lang="nl">

<head>

  <meta charset="utf-8">
  <title>inloggen</title>
  <link rel="stylesheet" type="text/css" href="register.css">
</head>

<body>
  <div class="register">
    <h1> Inloggen</h1>
     <form name="formulier" method="post" action="inloggen.php">

      <div>
        Vul je gebruikersnaam in:<br />
      </div>
      <input type='text' name='gebruikersnaam' size='25' /> <br />
      <div>
        Vul je wachtwoord in:<br />
      </div>
      <input type='password' name='wachtwoord' size='25' /> <br /></br>
      <input type='submit' name='verzenden' /><br />
      <br />
       <div class="nogniet">Nog niet geregistreerd? <a href="registreren1.php">Klik hier om te registreren</a></div>
      
    </form>
  </div>
</body>

</html>