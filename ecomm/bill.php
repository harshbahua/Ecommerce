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
    <div class="container">
    <br>
    <br>
    <br>
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
      <div class="row">
        <div class="col-md-8">
          <img src="img/paypal.png">
        </div>
        <div class="col-md-3 col-md-push-1">
        	<br>
        	<br>
          <form action="bill-exec.php" method="post" class="form-horizontal">

          	

            <input type="text" class="form-control clearfix input-lg" name="name" placeholder="Username*">
            <hr>
            <input type="text" class="form-control clearfix input-lg" name="cardno" placeholder="Card No.*">
            <hr>
            <input type="password" class="form-control clearfix input-lg" name="password" placeholder="Password*">
            <hr>
            <button type="submit" class="btn btn-block btn-primary btn-lg">Submit</button>
          </form><br>
        </div>
      </div>
    </div>
  </body>

</html>