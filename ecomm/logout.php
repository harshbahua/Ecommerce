<?php
//Start session
	session_start();
	
	//Unset the variables stored in session
	unset($_SESSION['SESS_USER_ID']);
	unset($_SESSION['SESS_USERNAME']);
	unset($_SESSION['SESS_ADMIN']);
	session_write_close();
	header("location: index.php");

?>