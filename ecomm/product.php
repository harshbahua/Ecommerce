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

	// Check to see if the type of file uploaded is a valid image type
	function valid($ptype)
	{
		// This is an array that holds all the valid image MIME types
		$valid_types = array("image/jpg", "image/jpeg", "image/bmp", "image/gif");
		
		//echo $file['type'];
		if (in_array($ptype, $valid_types))
			return 1;
		else
			return 0;
	}
	
	// Build our target path full string.  This is where the file will be moved do
	// i.e.  images/picture.jpg
	$TARGET_PATH = __DIR__.'/'."images/";
	$TARGET_PATH = $TARGET_PATH . basename( $_FILES['image']['name']);


	//Sanitize the POST values
	$pcategory = clean($_POST['category']);
	$pname = clean($_POST['Productname']);
	$prs = clean($_POST['Price']);
	$pquantity = clean($_POST['Quantity']);
	$pdesc = clean($_POST['description']);
	$pimage = $_FILES["image"]["name"];
	$ptype = $_FILES["image"]["type"];

	//Check for duplicate 
	if($pname != '') {
		$qry = "SELECT * FROM Product WHERE p_name='$pname'";
		$result = mysql_query($qry);
		if($result) {
			if(mysql_num_rows($result) > 0) {
				$errmsg_arr[] = 'Product already created';
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
	
	// Check to make sure that our file is actually an image
// You check the file type instead of the extension because the extension can easily be faked
	if (!valid($ptype))
	{
	$_SESSION['ERRMSG_ARR'] = array('You must upload a jpeg, gif, or bmp');
	//print_r($_FILES);
	header("Location: admin.php");
	exit;
	}
	
	// Here we check to see if a file with that name already exists
// You could get past filename problems by appending a timestamp to the filename and then continuing
if (file_exists($TARGET_PATH))
{
	$_SESSION['ERRMSG_ARR'] = array('A file with that name already exists');
	header("Location: admin.php");
	exit;
}

// Lets attempt to move the file from its temporary directory to its new home
if (move_uploaded_file($_FILES['image']['tmp_name'], $TARGET_PATH))
{
	// NOTE: This is where a lot of people make mistakes.
	// We are *not* putting the image into the database; we are putting a reference to the file's location on the server
	$sql = "insert into Product (p_category, p_name, p_rs, p_initial_quantity, p_quantity, p_desc, p_image) values ('$pcategory', '$pname','$prs', '$pquantity', '$pquantity','$pdesc', '" . $pimage . "')";
	$result = mysql_query($sql);
	 //Check whether the query was successful or not
	if($result) 
	{
		$_SESSION['ERRMSG_ARR'] = array('Product added');;
		$_SESSION['MSG_FLAG'] = 0;
		session_write_close();
		header("location: admin.php");
		exit();
	}else 
	{
		die("Query failed: ".mysql_error());
	}
	
}
else
{
	// A common cause of file moving failures is because of bad permissions on the directory attempting to be written to
	// Make sure you chmod the directory to be writeable HOGAYA!
	$_SESSION['ERRMSG_ARR'] = array('Could not upload file.  Check read/write persmissions on the directory');
	header("Location: admin.php");
	exit;
}

?>