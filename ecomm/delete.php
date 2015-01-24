<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('config.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Connect to mysql server
	$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
                      if(!$link) {
                        die('Failed to connect to server: ' . mysql_error());
                      }
                   
	switch ($_GET['type']) {
		case 'c':
			mysqli_query($link,"DELETE FROM Category WHERE c_name= '".$_GET['name']."'");
			mysqli_query($link,"DELETE FROM Product WHERE p_category= '".$_GET['name']."'");
			$_SESSION['ERRMSG_ARR'] = array('Category Deleted');
			session_write_close();
			header("location: admin.php");
			exit();
			break;
		
		case 'p':
			mysqli_query($link,"DELETE FROM Product WHERE p_category= '".$_GET['name']."'");
			$_SESSION['ERRMSG_ARR'] = array('Product Deleted');
			session_write_close();
			header("location: admin.php");
			exit();

		case 'u':
			mysqli_query($link,"DELETE FROM User WHERE user_name= '".$_GET['name']."'");
			$_SESSION['ERRMSG_ARR'] = array('User Deleted');
			session_write_close();
			header("location: admin.php");
			exit();

		case 'ca':
			mysqli_query($link,"DELETE FROM Cart WHERE pname= '".$_GET['name']."' AND user= '".$_GET['uname']."' ");
			$_SESSION['ERRMSG_ARR'] = array('Cart Deleted');
			session_write_close();
			header("location: admin.php");
			exit();

		case 'uca':
			mysqli_query($link,"DELETE FROM Cart WHERE pname= '".$_GET['name']."' AND user = '".$_SESSION['SESS_USERNAME']."' ");
			$_SESSION['ERRMSG_ARR'] = array('Product Deleted');
			session_write_close();
			header("location: profile.php");
			exit();
		default:
			# code...
			break;
	}
?>