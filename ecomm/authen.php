<?php
session_start();

if (isset($_SESSION['SESS_USERNAME']) && isset($_SESSION['SESS_ADMIN'])) {
	session_write_close();
	header("location: admin.php");
	exit();
}
else
{
	$_SESSION['ERRMSG_ARR'] = array('<b>You Need to be admin </b>');
	session_write_close();
	header("location: index.php");
	exit();
}
?>