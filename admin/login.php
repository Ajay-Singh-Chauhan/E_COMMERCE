<!doctype html>
<?php
  require("connection_inc.php");
  require("func_inc.php");
    $msg="";
  if (isset($_SESSION['A_L'])) {
    header("Location: $host/admin/category.php");
  }

  if (isset($_POST['submit'])){
    $uname=get_safe_value($con,$_POST['uname']);
    $pass=get_safe_value($con,$_POST['password']);

    $sql="select * from users where user_name='{$uname}' and password='{$pass}'";
    $res = mysqli_query($con,$sql);
    $count= mysqli_num_rows($res);

    if($count>0){
      $row=mysqli_fetch_assoc($con,$res);
      $_SESSION['A_L']="yes";
      $_SESSION['name']=$row['name'];
      header("Location: $host/admin/category.php");
    }
    else {
      $msg="Please Enter Right Uname and Password";
    }
  }
?>
<html class="no-js" lang="">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Login Page</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="assets/css/normalize.css">
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/css/themify-icons.css">
      <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">
      <link rel="stylesheet" href="assets/css/flag-icon.min.css">
      <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
      <link rel="stylesheet" href="assets/css/style.css">
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
   </head>
   <body class="bg-dark">
      <div class="sufee-login d-flex align-content-center flex-wrap">
         <div class="container">
            <div class="login-content">
               <div class="login-form mt-150">
                  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                     <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="uname" placeholder="Username" required>
                     </div>
                     <div class="form-group">
                        <label>Password</label>
                        <input  type="password" class="form-control" name="password" placeholder="Password" required>
                     </div>
                     <button name="submit" type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
					        </form>
                  <div class="alert alert-danger mt-3">
                    <?php echo $msg ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script src="assets/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
      <script src="assets/js/popper.min.js" type="text/javascript"></script>
      <script src="assets/js/plugins.js" type="text/javascript"></script>
      <script src="assets/js/main.js" type="text/javascript"></script>
   </body>
</html>
