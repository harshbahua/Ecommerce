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
          <div class="well" style="margin-left: -30px">

            <ul id="cat-navi" class="nav nav-pills nav-stacked" >
              <li class="nav-header"><h4><strong><p class="text-info">Categories</p></strong></h4></li>
              <br>
              <?php
                      //Create query
                        $qry="SELECT * FROM Category ORDER BY c_name";
                        $result=mysqli_query($link,$qry);
                        while($row = mysqli_fetch_array($result))
                       {
                        ?>
              <li>
                <a href="categ.php?categ=<?php echo $row['c_name']?>" ><? echo $row['c_name']?></a>
           
              </li>
              
              <?php 
              } ?>
             
            </ul>
          </div>
        </div>
        <div class="col-md-10">
          <!-- Carousel==================================================-->
          <div id="myCarousel" class="carousel slide">
            <!-- Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#myCarousel" data-slide-to="1"></li>
              <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="item active">
                <img src="img/intel1.jpg" class="img-polaroid">
                <div class="container">
                  
                </div>
              </div>
              <div class="item" style>
                <img src="http://lorempixel.com/1500/600/abstract">
                <div class="container">
                  <div class="carousel-caption">
                    <h1>Changes to the Grid</h1>
                    <p>Bootstrap 3 still features a 12-column grid, but many of the CSS class names have completely changed.</p>
                    <p><a class="btn btn-large btn-primary" href="#">Learn more</a></p>
                  </div>
                </div>
              </div>
              <div class="item" style>
                <img src="http://placehold.it/1500X500">
                <div class="container">
                  <div class="carousel-caption">
                    <h1>Percentage-based sizing</h1>
                    <p>With "mobile-first" there is now only one percentage-based grid.</p>
                    <p><a class="btn btn-large btn-primary" href="#">Browse gallery</a></p>
                  </div>
                </div>
              </div>
            </div>
            <!-- Controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">    <span class="icon-prev"></span>  </a><a class="right carousel-control" href="#myCarousel" data-slide="next">    <span class="icon-next"></span>  </a> 

          </div>
          </div>
        </div>
        </div>
        <div class="container" style="margin-top:30px">
    <div class="row clearfix">
      <div class="col-md-2"></div>
      <div class="col-md-10 clearfix">
        <div class="row">
        <?php
                      //Create query
                        $qry="SELECT * FROM Product";
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
                <a href="cart.php?prod=<?php echo $row['p_name']?>" class="btn btn-primary" style="margin-left: 150px"><span class="glyphicon glyphicon-shopping-cart"></span>Add to cart</a>
              </div>
            </div>
          </div>

          <?php } ?>
  
</div>
</div>
</div>
</div>
      
    
  </body>

</html>