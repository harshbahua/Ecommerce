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
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the POST values
	$cname = clean($_POST['categoryname']);
	
	//Check for duplicate login ID
	if($cname != '') {
		$qry = "SELECT * FROM Category WHERE c_name='$cname'";
		$result = mysql_query($qry);
		if($result) {
			if(mysql_num_rows($result) > 0) {
				$errmsg_arr[] = 'Category already created';
				$errflag = true;
			}
			@mysql_free_result($result);
		}
		else {
			die("Query failed");
		}
	}
	
	//If there are input validations, redirect back to the registration form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: admin.php");
		exit();
	}
	//Create INSERT query
	$qry = "INSERT INTO Category(c_name) 
			VALUES('$cname')";
	$result = @mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		$_SESSION['ERRMSG_ARR'] = array('Category added');;
		$_SESSION['MSG_FLAG'] = 0;
		session_write_close();
		header("location: admin.php");
		exit();
	}else {
		die("Query failed: ".mysql_error());
	}
?>