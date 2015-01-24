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
	$username = clean($_POST['name']);
	$cardno = clean($_POST['cardno']);
	$password = clean($_POST['password']);
	
	//Input Validations
	if($username == '') {
		$errmsg_arr[] = 'Please provide a username.';
		$errflag = true;
	}
	if($cardno == '') {
		$errmsg_arr[] = 'Please enter the card no.';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Please enter the password.';
		$errflag = true;
	}
	
	//If there are input validations, redirect back to the login form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: bill.php");
		exit();
	}
	
	$user1=$_SESSION['SESS_USERNAME'];
	//Create query
	$qry="SELECT * FROM Bank WHERE b_name='$username' AND b_no='$cardno' AND b_pwd='".md5($_POST['password'])."'";
	$result=mysql_query($qry);
	$row = mysql_fetch_array($result);
	//Check whether the query was successful or not
	if($result) {
		if(mysql_num_rows($result) == 1) {
			//Login Successful
			session_regenerate_id();
			$member = mysql_fetch_assoc($result);
			$qry1="SELECT * FROM User WHERE user_name = '$user1' ";
			$result1=mysql_query($qry1);
			if($result1)
			{
				$qry2="SELECT SUM(prs) FROM Cart WHERE user='$user1' and pstatusno=0 ";
				$result2=mysql_query($qry2);
				$row2 = mysql_fetch_array($result2);
				$amt=$row2['SUM(prs)'];
				$amt_user=$row['b_rs']-$amt;
				$sql_admin="SELECT * FROM Bank WHERE b_name='admin';";
				$result3=mysql_query($sql_admin);
				$row3 = mysql_fetch_array($result3);
				print_r($row3);
				$amt_admin=$row3['b_rs']+$amt;
				echo $amt_admin;
				$sql123=mysql_query("Update Bank SET b_rs='$amt_user' where b_name='$username';");
				$sql123=mysql_query("Update Bank SET b_rs='$amt_admin' where b_name='admin';");
				$sql123=mysql_query("Update Cart SET pstatusno=1 , pstatus= 'PAID' where user='$user1';");

			}
			$_SESSION['ERRMSG_ARR'] = array('<b>SUCCESSFULLY PAID<b>');
			$_SESSION['MSG_FLAG']=0;
			session_write_close();
			header("location: index.php");
			exit();
		}else {
			//Login failed
			$_SESSION['ERRMSG_ARR'] = array('<b>Oh no!</b> Incorrect Details. Please try again.');
			session_write_close();
			header("location: bill.php");
			exit();
		}
	}else {
		die("Query failed: ".mysql_error());
	}
?>