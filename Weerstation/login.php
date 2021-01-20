<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Aitken Spence Login</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
<div class="header">
    <h2>Login</h2>

</div>

<form name="formulier" method="post" action="inloggen.php">
    <a class='button1' href='login.php'><img src="pictures/logo.png" width="100%"></a>
    <div class="input-group">
        <label>User</label>
        <input type="text" name="user" >
    </div>
    <div class="input-group">
        <label>Password</label>
        <input type="text" name="password">
    </div>
    <div class="input-group">
        <button type="submit" class="submitButton" name="bestel">Log in</button>
    </div>
</form>
</body>
</html>