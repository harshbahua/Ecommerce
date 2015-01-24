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
        <div class="col-md-3 col-md-offset-4" style="padding-left: 36px;padding-top: 50px;">
          <form action="login-exec.php" method="post">
            <?php
            if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
                ?>
                <div class="alert alert-warning">
                  <ul class="list-unstyled">
                    <?php 
                    foreach ($_SESSION['ERRMSG_ARR'] as $msg) {
                      echo '<li>'.$msg.'</li>';
                    }
                    ?>
                  </ul>
                </div>
              <?php
              unset($_SESSION['ERRMSG_ARR']);
            }
          ?>
            <input type="text" class="form-control input-lg" placeholder="Username" name="username">
            <hr>
            <input type="password" class="form-control input-lg" placeholder="Password" name="password">
            <hr>
            <button type="submit" class="btn btn-block btn-primary btn-lg">Login</button>
          </form><br>
          <form action="registration.php">
            <button type="submit" class="btn pull-right btn-link">Register?</button>
          </form>
        </div>
      </div>
    </div>
  </body>

</html>