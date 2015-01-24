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
  
  <body>
   <?php 
     include 'header.php';
     include 'db.php';
     //Include database connection details
                      require_once('config.php');
                      
                      //Array to store validation errors
                      $errmsg_arr = array();
                      
                      //Validation error flag
                      $errflag = false;
                      
                      
     ?>
    <!-- PAGE-HEADER-->
    <div class="container">
    <br>
    <br>
    <br>
      <div class="row">
        <div class="col-md-2">
          <div class="well">
            <ul id="cat-navi" class="nav nav-pills nav-stacked">
              <li class="nav-header"><h4><strong><p class="text-info">Categories</p></strong></h4></li>
              <br>
              <?php
                      
                      //Create query
                        $qry="SELECT * FROM Category";
                        $result=mysqli_query($link,$qry);
                        while($row = mysqli_fetch_array($result))
                       {
                        ?>
              <li>
                <a href="categ.php?categ=<?php echo $row['c_name']?>" ><? echo $row['c_name']?></a>
              </li>
              <?php } ?>
             
            </ul>
          </div>
        </div>
        
      <div class="col-md-10 clearfix">
      <div data-spy="scroll" data-target="#cat-navi">
        <div class="row">
        <?php
                      //Create query
                        $qry="SELECT * FROM Product WHERE p_category = '".$_GET['categ']."' ";
                        $result=mysqli_query($link,$qry);
                        while($row = mysqli_fetch_array($result))
                       {
                        ?>
          <div class="col-md-4 clearfix">
            <div class="thumbnail">
            <img src="images/<?php echo $row['p_image']; ?>" />
              <div class="caption">
                <h3><?php echo $row['p_name'] ?></h3>
                <p><?php echo $row['p_desc'] ?></p>
                <p><a href="#" class="btn btn-primary">Button</a> <a href="#" class="btn btn-default">Button</a></p>
              </div>
            </div>
          </div>

          <?php } ?>
  
</div>
</div>
      
    
  </body>

</html>