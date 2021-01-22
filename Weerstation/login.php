<?php session_start(); ?>
<html lang="eng">
    <head>
        <title>Aitken Spence Login</title>
        <link rel="stylesheet" type="text/css" href="login.css">
    </head>
    <body>
        <div class="header">
            <h2>Login</h2>
        </div>
        <form name="formulier" method="post" action="inloggen.php">
            <a href='login.php'><img class='logoImg' src="pictures/logo.png" alt="logo"></a>
            <div class="input-group">
                <label>User
                    <input type="text" name="user" >
                </label>
            </div>
            <div class="input-group">
                <label>Password
                    <input type="password" name="password">
                </label>
            </div>
            <div class="input-group">
                <button type="submit" class="submitButton" name="bestel">Log in</button>
            </div>
        </form>
    </body>
</html>