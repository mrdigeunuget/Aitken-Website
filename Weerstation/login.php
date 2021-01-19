<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Voornaam</label>
  		<input type="text" name="voornaam" >
  	</div>
  	<div class="input-group">
  		<label>achternaam</label>
  		<input type="text" name="achternaam">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="bestel">Plaat je bestelling!</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>
  </form>
</body>
</html>