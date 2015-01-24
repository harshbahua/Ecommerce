<!doctype html>

<html>
  
  <head>
    <title>HBRD</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="/favicon.ico">


  </head>
  
  <body style="background-color: #2C3E50">
   <?php 
   session_start();
     include 'header.php';
     include 'db.php';
     //Include database connection details
                      require_once('config.php');
                      
                      //Array to store validation errors
                      $errmsg_arr = array();
                      
                      //Validation error flag
                      $errflag = false;

  if(!isset($_SESSION['SESS_USER_ID']) && !isset($_SESSION['SESS_USER_ID']))
  {
    $_SESSION['ERRMSG_ARR'] = array('Please Login and try again');
    session_write_close();
    header("location: login.php");
    exit();

  }
                      
                      
     ?>
    <br>
    <br>
    <br>
    <br>
    <div class="row">
       <?php
          if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) 
          {
              if( isset($_SESSION['ADMIN_FLAG'])) {?>
              

                <div class="alert alert-danger">
                  <ul class="list-unstyled">
                  <?php 
                  foreach ($_SESSION['ERRMSG_ARR'] as $msg) {
                    echo '<li>'.$msg.'</li>';
                  }
                }
              else if( isset($_SESSION['MSG_FLAG'])) {?>
              

                <div class="alert alert-success">
                  <ul class="list-unstyled">
                
                  <?php 
                  foreach ($_SESSION['ERRMSG_ARR'] as $msg) {
                    echo '<li>'.$msg.'</li>';
                  }
                }
                else
                {
                  ?>
                  <div class="alert alert-warning">
                    <ul class="list-unstyled">
                    <?php 
                      foreach ($_SESSION['ERRMSG_ARR'] as $msg) {
                      echo '<li>'.$msg.'</li>';
                  }
                }
              
                ?>
                </ul>
              </div>
            <?php
            unset($_SESSION['ERRMSG_ARR']);
            unset($_SESSION['MSG_FLAG']);
            unset($_SESSION['ADMIN_FLAG']);
          }
        ?>

    
    </div>
    </div>
    </div>
  <div class="container">
 <div class="panel-group" id="accordion">
  <div class="panel panel-info">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
Personal Details        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
    <?php
    $result = mysqli_query($link,"SELECT * FROM User WHERE user_name = '".$_SESSION['SESS_USERNAME']."' LIMIT 1");
	$row = mysqli_fetch_array($result);
    ?>
      <div class="panel-body">
		 <form class="form-inline" role="form" method="post" action="updatepro.php">
		  <div class="form-group">
		    <label  for="exampleInputEmail2">User Name</label>
		    <input class="form-control" id="disabledInput" type="text" placeholder="<?echo $row['user_name']?>" disabled>
		  </div>
		   <div class="form-group" style="margin-left: 10px">
		    <label  for="exampleInputEmail2">Email address</label>
		    <input class="form-control" id="disabledInput" type="text" placeholder="<?echo $row['user_email']?>" disabled>
		  </div>
		  <div class="form-group" style="margin-left: 10px">
		    <label  for="exampleInputPassword2">Update Password</label>
		    <input type="password" class="form-control" id="exampleInputPassword2"  name="pass" placeholder="Enter Password">
		  </div>
		  <div class="form-group" style="margin-left: 10px">
		  	<label  for="exampleInputPassword2"></label>
		    <input type="password" class="form-control" id="exampleInputPassword" name="cpass" style="margin-top: 4px" placeholder="Confirm Password">
		  </div>
		  
		  <button type="submit" class="btn btn-primary "  style="margin-top: 10px; margin-left: 970px">Update</button>
		</form>
      </div>
    </div>
  </div>
</div>
<br>
<br>
<div class="panel-group" id="accordion">
  <div class="panel panel-info">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOn">
			Cart Details </a>
      </h4>
    </div>
    <div id="collapseOn" class="panel-collapse collapse in">
    <?php
    $result1 = mysqli_query($link,"SELECT * FROM Cart WHERE user = '".$_SESSION['SESS_USERNAME']."'  ");
    $result2 = mysqli_query($link,"SELECT SUM(prs) FROM Cart WHERE pstatusno=0 AND user = '".$_SESSION['SESS_USERNAME']."' GROUP BY user  ");
    ?>    
      <div class="panel-body">
		<div class="table-responsive">
                  <table class="table table-hover table-striped">
                    <tbody>
                    
                      <tr>
                        <th>Order No.</th>
                        <th>Product Id</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th></th>
                      </tr>
                      <?php
                        while($row1 = mysqli_fetch_array($result1))
                       {
                        ?>

                      <tr >
                        <td><?php echo $row1['cid']?></td>
                        <td><?php echo $row1['pid']?></td>
                        <td><?php echo $row1['pname']?></td>
                        <td>Rs. <?php echo $row1['prs']?></td>
                        <td><?php echo $row1['categ']?></td>
                        <td><?php echo $row1['pquant']?></td>
                        <td><?php echo $row1['pstatus']?></td>
                        <?php if(($row1['pstatusno']==0))
                        { ?> 
                        <td><a href="delete.php?type=uca&name=<?php echo $row1['pname']?>" class="btn btn-danger">Delete</a></td>
                      	<?php }  else { ?>
                        <td></td>
                        <?php } ?>
                      </tr>
                      <?php } 
                      $row2 = mysqli_fetch_array($result2);
                      ?>
                      <tr></tr>
                      <tr>
                        <td><b> TOTAL</b></td>
                        <td></td>
                        <td></td>
                        <td><b>Rs. <?php echo $row2['SUM(prs)'] ?> </b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><a href="bill.php" class="btn btn-success">Checkout</a></td>
                      </tr>
                    </tbody>
                  </table>
                  </div>
      </div>
    </div>
  </div>  
</div>
</div>
      
    
  </body>

</html>