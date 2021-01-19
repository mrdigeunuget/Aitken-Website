<?php
	function dbConnect(){
		$db_conn = mysqli_connect("localhost","localhost","localhost","unwdmi");
		if(mysqli_connect_errno()){
			$errormessage = "Connection failed".mysqli_connect_error();
			die($errormessage);
		}
		return $db_conn;
	}
	function dbDisconnect($db_conn){
		mysqli_close($db_conn);
	}
?>