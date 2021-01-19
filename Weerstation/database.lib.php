<?php
	function dbConnect(){
		$db_conn = mysqli_connect("rdbms.strato.de","U3911727","Isubwich2019","DB3911727");
		if(mysqli_connect_errno()){
			$errormessage = "Connection failed".mysqli_connect_error();
			die($errormessage);
			exit();
		}
		return $db_conn;
	}
	function dbDisconnect($db_conn){
		mysqli_close($db_conn);
	}
?>