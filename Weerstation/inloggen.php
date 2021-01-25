<?php session_start(); ?>
<html lang="eng">
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
                print ("<script>
                      alert('Login was succesfull');
                      window.location.href='index.php';
                     </script>");
            }else {
                print ("<script>
                      alert('Wrong password or username, try again');
                      window.location.href='login.php';
                     </script>");
            }
            dbDisconnect($dbConnection);
        ?>
    </body>
</html>
