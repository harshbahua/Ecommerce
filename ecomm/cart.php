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
                   
	
	if(!isset($_SESSION['SESS_USER_ID']) && !isset($_SESSION['SESS_USER_ID']))
	{
		$_SESSION['ERRMSG_ARR'] = array('Please Login and try again');
		session_write_close();
		header("location: index.php");
		exit();

	}
	$qry="SELECT * FROM Product, User WHERE p_name = '".$_GET['prod']."' AND user_name = '".$_SESSION['SESS_USERNAME']."' LIMIT 1";
    $result=mysqli_query($link,$qry);
    $row = mysqli_fetch_assoc($result);

    //Create INSERT query
	$qry1 = "INSERT INTO Cart(pid,pname,prs,categ,userid,user,pquant,pstatus) 
			 VALUES('".$row['p_id']."',
			 		'".$row['p_name']."',
			 		".$row['p_rs'].",
			 		'".$row['p_category']."',
			 		'".$row['user_email']."',
			 		'".$row['user_name']."',
			 		1,'PENDING')";
	$result1 = mysqli_query($link,$qry1);

	//$qry1 = " INSERT INTO Cart(pid,pname,prs,categ,userid,user,pquant,pstatus) SELECT p_id, p_name, p_rs, p_category, user_email, user_name FROM Product, User WHERE p_name = '".$_GET['prod']."' AND user_name = '".$_SESSION['SESS_USERNAME']."' ";
	//$result1 = @mysql_query($qry1);
	//Check whether the query was successful or not
	if($result1) {
		$_SESSION['ERRMSG_ARR'] = array('Product Added');
		$_SESSION['MSG_FLAG'] = 0;
		$q=$row['p_quantity'];
		--$q;
		mysqli_query($link,"UPDATE Product SET p_quantity = $q
		WHERE p_name = '".$_GET['prod']."'");
		session_write_close();
		header("location: index.php");
		exit();
	}else {
		die("Query failed: ".mysql_error());
	}
?>