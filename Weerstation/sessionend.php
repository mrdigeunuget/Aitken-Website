<?php 
    session_start();
    $_SESSION = array();
    session_destroy();
	print ("<script>
          alert('succesvol uitgelogd, klik op OK om naar de home pagina te gaan');
          window.location.href='login.php';
         </script>");
