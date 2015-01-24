<!doctype html>

<html>
  
  <head>
    <title>HBRD</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
  </head>
  
  <body>
  <?php
  include 'header.php';
  
  ?>

    <div class="container">
    <br>
    <br>
    <br>
      <div class="row">
        <div class="col-md-4 col-md-offset-4 " style="padding-left: 36px;padding-top: 50px;">
         <?php
          if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) 
          {
              if( isset($_SESSION['MSG_FLAG'])) {?>
              

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
          }
        ?>


      

        <form action="register-exec.php" method="post">
          <input required type="text" class="form-control" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$" placeholder="Username" name="username" required>
          <br>
          <input type="text" class="form-control" placeholder="Email" name="email">
          <br>
          <input type="password" class="form-control" placeholder="Password" name="password">
          <br>
          <input type="password" class="form-control" placeholder="Confirm Password" name="cpassword">
          <br>
          <button type="submit" class="btn btn-info" style="margin-left:80px; padding:8px 53px ">Register!</button>
        </form>
        </div>
      </div>
    </div>
  </body>

</html>