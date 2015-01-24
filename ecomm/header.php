
    <?php
    @session_start();
    include 'db.php';
    ?>
    <div class="container">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">HBRD</a>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
          <li <?php echo strpos($_SERVER['REQUEST_URI'], 'index.php') > 0 ? 'class="active"' : ''; ?> >
            <a href="index.php">Home</a>
          </li>
          

          <li class="dropdown" >
            <a href="#" class="dropdown-toggle" id="menu" data-toggle="dropdown">Our Products <b class="caret"></b></a>
            <ul class="dropdown-menu" aria-labelledby="menu">
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
              <?php } ?>
            </ul>
          </li>
          <li <?php echo strpos($_SERVER['REQUEST_URI'], 'about.php') > 0 ? 'class="active"' : ''; ?> >
            <a href="#">About Us</a>
          </li>
          <li <?php echo strpos($_SERVER['REQUEST_URI'], 'contact.php') > 0 ? 'class="active"' : ''; ?> >
            <a href="contact.php">Contact Us</a>
          </li>
        </ul>
        <div class="navbar-right">
        <form class="navbar-form pull-left" >
        <a type="button" href="profile.php" class="btn btn-default">
          <span class="glyphicon glyphicon-shopping-cart"></span>
        </a>
        </form>
        <form class="navbar-form pull-left" role="search" action="search.php" method="post">
          <div class="form-group">
            <input type="text" class="form-control" name="search" placeholder="Search">
          </div>
          <button type="search" class="btn btn-info">
            <span class="glyphicon glyphicon-search"></span>
          </button>
        </form>
        <?php 
                if (isset($_SESSION['SESS_USERNAME'])) { ?>

        <form class="navbar-form pull-right" ac>        
        <div class="btn-group">
          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
           <?php echo  $_SESSION['SESS_USERNAME']?> <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <?php 
              if(isset($_SESSION['SESS_ADMIN'])) { ?>
                 <li><a href="admin.php">ADMIN</a></li>
            <?php } 
            else { ?>
              <li><a href="profile.php">PROFILE</a></li>
            <?php } ?>
            <li class="divider"></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </div>
        </form>
          <?php
          }
          else
            { ?>
           <form class="navbar-form pull-right" action="login.php">
          <button type="submit" class="btn btn-primary "  >Sign In</button>
        </form>
        <?php
        }
        ?>
        </div>
      </div>
      <!-- /.navbar-collapse -->
    </nav>

    <div class="row">
       <?php
          if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) 
          {

              if( isset($_SESSION['ADMIN_FLAG'])) {?>
              

                <div class="alert alert-danger">
                  <ul class="list-unstyled">
                  <br>
                  <br>
                  <br>
                  <?php 
                  foreach ($_SESSION['ERRMSG_ARR'] as $msg) {
                    echo '<li>'.$msg.'</li>';
                  }
                }
              else if( isset($_SESSION['MSG_FLAG'])) {?>
              

                <div class="alert alert-success">
                  <ul class="list-unstyled">
                  <br>
                  <br>
                  <br>
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
                    <br>
                    <br>
                    <br>
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
