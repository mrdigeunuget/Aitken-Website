<?php 
    session_start();
    $_SESSION = array();
    session_destroy();
	print ("<script>
          alert('Logout was succesful.');
          window.location.href='login.php';
         </script>");
