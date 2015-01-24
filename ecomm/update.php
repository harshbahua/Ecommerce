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
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}


	//Sanitize the POST values
	$pname = clean($_POST['Product']);
	$prs = clean($_POST['Price']);
	$pquantity = clean($_POST['Quantity']);
	

	
	
	//If there are input validations, redirect back to the registration form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: admin.php");
		exit();
	}
	

	$result = mysqli_query($link,"UPDATE Product SET p_rs=$prs, p_initial_quantity=$pquantity 
				WHERE p_name='$pname'");
	 //Check whether the query was successful or not
	if($result) 
	{
		$_SESSION['ERRMSG_ARR'] = array('Product updated');;
		$_SESSION['MSG_FLAG'] = 0;
		session_write_close();
		header("location: admin.php");
		exit();
	}else 
	{
		die("Query failed: ".mysql_error());
	}
	



?>