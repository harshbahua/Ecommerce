<!doctype html>

<html>
  
  <head>
    <title>HBRD</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <?php
    session_start();
    $x=1;
    while ($x==1) {
      # code...
    
    if (isset($_SESSION['SESS_USERNAME']) && isset($_SESSION['SESS_ADMIN'])) {
            $x=0;
        continue;
    }
    else
    {
      $_SESSION['ERRMSG_ARR'] = array('<b>SORRY!!!</b> You Need to be admin ');
      $_SESSION['ADMIN_FLAG']=0;
      session_write_close();
      header("location: index.php");
      exit();
    }   
     }?>
  </head>
  
  <body>
  <?php

                      //Include database connection details
                      require_once('config.php');
                      
                      //Array to store validation errors
                      $errmsg_arr = array();
                      
                      //Validation error flag
                      $errflag = false;
                      
                      //Connect to mysql server
                      $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
                      if(!$link) {
                        die('Failed to connect to server: ' . mysql_error());
                      }
                      
                      //Select database
                      $db = mysqli_select_db($link,DB_DATABASE);
                      if(!$db) {
                        die("Unable to select database");
                      }

                    
  ?>
    <div class="container">
      <h1><u>      <p class="text-success">Admin</p>      </u></h1>
      <a class="btn btn-link" href="index.php"><p class="text-success">&lt;&lt; Back to Home Page </p></a>
    
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
    </div>
    <div class="container">
      <div class="panel-group" id="accordion">
        <div class="panel panel-success">
          <div class="panel-heading">
            <h4 class="panel-title">          
              <a type="button" class="accordion-toggle btn btn-default" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> Categories </a>   
              <a type="button" class="btn accordion-toggle btn-default" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"> Products </a>                        
              <a type="button" class="btn accordion-toggle btn-default" data-toggle="collapse" data-parent="#accordion" href="#collapseThree"> Users </a>                        
              <a type="button" class="btn accordion-toggle btn-default" data-toggle="collapse" data-parent="#accordion" href="#collapseFour"> Cart </a>
            </h4>
          </div>
          <div id="collapseOne" class="panel-collapse collapse in">
            <div class="panel-body">
              <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title">Categories</h3>
                </div>
                <div class="panel-body">
                  <div class="table-responsive">
                  <table class="table table-hover table-striped">
                    <tbody>
                    
                      <tr>
                        <th>No.</th>
                        <th>Category</th>
                        <th></th>
                      </tr>
                      <?php
                      //Create query
                        $qry="SELECT * FROM Category";
                        $result=mysqli_query($link,$qry);
                        while($row = mysqli_fetch_array($result))
                       {
                        ?>

                      <tr >
                        <td><?php echo $row['c_id']?></td>
                        <td><?php echo $row['c_name']?></td>
                        <td> 
                         <a href="delete.php?type=c&name=<?php echo $row['c_name']?>" class="btn btn-danger">Delete</a>
                         </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  </div>

                   <!-- Button trigger modal -->
                  <a data-toggle="modal"  data-target="#myModal1" class="btn btn-info pull-right" id="reg-link">Add</a>
                    <!-- Modal -->    
                    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                          
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Categories</h4>
                          </div>
                          <div class="modal-body">
                            <form role="form" action="category.php" method="post">
                              <div class="form-group">
                                <label for="category">Category</label>
                                <input type="text" class="form-control" name="categoryname" placeholder="Enter Category">
                              </div>
                              
                              <button type="submit" class="btn btn-primary ">Submit</button>
                              
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div>
                    
                </div>
              </div>

            </div>
          </div>
          
          <div id="collapseTwo" class="panel-collapse collapse">
            <div class="panel-body">
              <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title">Products</h3>
                </div>
                <div class="panel-body">
                  <div class="table-responsive">
                  <table class="table table-hover table-striped">
                    <tbody>
                    
                      <tr>
                        <th>No.</th>
                        <th>Category</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Current Quantity</th>
                        <th>Description</th>
                        <th></th>
                      </tr>
                      <?php
                      //Create query
                        $qry="SELECT * FROM Product";
                        $result=mysqli_query($link,$qry);
                        while($row = mysqli_fetch_array($result))
                       {
                        ?>

                      <tr >
                        <td><?php echo $row['p_id']?></td>
                        <td><?php echo $row['p_category']?></td>
                        <td><?php echo $row['p_name']?></td>
                        <td><?php echo $row['p_rs']?></td>
                        <td><?php echo $row['p_initial_quantity']?></td>
                        <td><?php echo $row['p_quantity']?></td>
                        <td><?php echo $row['p_desc']?></td>
                        <td><a href="delete.php?type=p&name=<?php echo $row['p_name']?>" class="btn btn-danger">Delete</a>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  </div>

                   <!-- Button trigger modal -->
                  <a data-toggle="modal"  data-target="#myModal2" class="btn btn-info pull-right" id="reg-link">Add</a>
                    <!-- Modal -->    
                    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                          
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Products</h4>
                          </div>
                          <div class="modal-body">
                            <form role="form" action="product.php" method="post" enctype="multipart/form-data">
                              <div class="form-group">
                                <label for="product">Category</label>
                                <div class="row">
                                <div class="col-lg-6">
                                <select class="form-control" name="category">
                                <?php 
                                $qry="SELECT * FROM Category";
                                 $result=mysqli_query($link,$qry);
                                while($row = mysqli_fetch_array($result))
                                {
                                  ?>
                                 <option><?echo $row['c_name']?></option>
                                 <?php }?>
                                </select>
                                </div>
                                </div>
                              </div>
                              <div class="form-group">
                              
                                <label for="product">Product</label>
                                <label for="price" style="margin-left: 227px">Price</label>
                                <label for="category" class="clearfix" style="margin-left: 104px">Quanity</label>
                              
                              <div class="row">
                                 <div class="col-lg-6">
                                  <input type="text" class="form-control " name="Productname" placeholder="Enter Product">
                                </div>
                                <div class="col-lg-3">
                                  <input type="text" class="form-control " name="Price" placeholder="Enter Price">
                                </div>
                                <div class="col-lg-3">
                                  <input type="text" class="form-control pull-right" style="margin-right:0px" name="Quantity" placeholder="Quantity">
                                </div>
                              </div>
                              </div>

                              <div class="form-group">
                                <label for="product">Product Description</label>
                                <textarea class="form-control" name="description" rows="3" placeholder="Enter Product Description"></textarea>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputFile">File input</label>
                                <input type="file" name="image">
                              </div>
                              <button type="submit" class="btn btn-primary ">Submit</button>
                              
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div>
                    <!-- Button trigger modal -->
                  <a data-toggle="modal"  data-target="#myModal3" class="btn btn-info" style="margin-left: 925px" id="reg-link">Update</a>
                    <!-- Modal -->    
                    <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                          
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Products</h4>
                          </div>
                          <div class="modal-body">
                            <form role="form" action="update.php" method="post" enctype="multipart/form-data">
                              <div class="form-group">
                                <label for="product">Product</label>
                                <div class="row">
                                <div class="col-lg-6">
                                <select class="form-control" name="Product">
                                <?php 
                                $qry="SELECT * FROM Product";
                                 $result=mysqli_query($link,$qry);
                                while($row = mysqli_fetch_array($result))
                                {
                                  ?>
                                 <option><?echo $row['p_name']?></option>
                                 <?php }?>
                                </select>
                                </div>
                                </div>
                              </div>
                              <div class="form-group">
                              
                                <label for="product">Price</label>
                                <label for="price" style="margin-left: 150px">Quanity</label>
                              
                              <div class="row">
                                 <div class="col-lg-4">
                                  <input type="text" class="form-control " name="Price" placeholder="Enter price">
                                </div>
                                <div class="col-lg-4">
                                  <input type="text" class="form-control " name="Quantity" placeholder="Enter Quantity">
                                </div>
                               
                              </div>
                              </div>
                              <button type="submit" class="btn btn-primary ">Submit</button>
                              
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div>
                    
                </div>
                </div>

              </div>

            </div>
            <div id="collapseThree" class="panel-collapse collapse">
            <div class="panel-body">
              <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title">Products</h3>
                </div>
                <div class="panel-body">
                  <div class="table-responsive">
                  <table class="table table-hover table-striped">
                    <tbody>
                    
                      <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Join Date</th>
                        <th>Admin</th>
                        <th></th>
                      </tr>
                      <?php
                      //Create query
                        $qry="SELECT * FROM User";
                        $result=mysqli_query($link,$qry);
                        while($row = mysqli_fetch_array($result))
                       {
                        ?>

                      <tr >
                        <td><?php echo $row['user_id']?></td>
                        <td><?php echo $row['user_name']?></td>
                        <td><?php echo $row['user_email']?></td>
                        <td><?php echo $row['created_at']?></td>
                        <td><?php echo $row['user_is_admin']?></td>
                        <td><a href="delete.php?type=u&name=<?php echo $row['user_name']?>" class="btn btn-danger">Delete</a></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  </div>
                 </div>

                    
                </div>
              </div>

            </div>
            <div id="collapseFour" class="panel-collapse collapse">
            <div class="panel-body">
              <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title">Products</h3>
                </div>
                <div class="panel-body">
                  <div class="table-responsive">
                  <table class="table table-hover table-striped">
                    <tbody>
                    
                      <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Product Id</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th></th>
                      </tr>
                      <?php
                      //Create query
                        $qry="SELECT cid, user, userid, pid, pname, prs, categ, pstatus, SUM(pquant) FROM Cart GROUP BY user, pid";
                        $result=mysqli_query($link,$qry);
                        while($row = mysqli_fetch_array($result))
                       {
                        ?>

                      <tr >
                        <td><?php echo $row['cid']?></td>
                        <td><?php echo $row['user']?></td>
                        <td><?php echo $row['userid']?></td>
                        <td><?php echo $row['pid']?></td>
                        <td><?php echo $row['pname']?></td>
                        <td><?php echo $row['prs']?></td>
                        <td><?php echo $row['categ']?></td>
                        <td><?php echo $row['SUM(pquant)']?></td>
                        <td><?php echo $row['pstatus']?></td>
                        <td><a href="delete.php?type=ca&name=<?php echo $row['pname']?>&uname=<?php echo $row['user']?>" class="btn btn-danger">Delete</a></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  </div>
                 </div>

                    
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </body>

</html>