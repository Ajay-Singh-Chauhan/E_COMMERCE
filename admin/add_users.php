
  <?php
  require("connection_inc.php");
  require("func_inc.php");
  require("header.php");


    $msg="";
                  //insert

                  if(isset($_POST['submit'])){

                    $uname =get_safe_value($con,$_POST['uname']);
                    $pass =get_safe_value($con,$_POST['pass']);
                    $name =get_safe_value($con,$_POST['name']);
                    $role =get_safe_value($con,$_POST['role']);

                    $res=mysqli_query($con,"select * from users where user_name={$uname}");

                    if(mysqli_num_rows($res)>0){
                            $msg= $uname." Name aready exists";
                    }
                    else {
                       $res=mysqli_query($con,"insert into users (user_name,name,password,role) values ('
                       {$uname}','{$name}','{$pass}',{$role})");

                       if($res)
                        header("Location: $host/admin/users.php");
                       else
                         $msg="Query Failed";
                     }

                  }
  
     ?>

           <div class="content pb-0">
              <div class="orders">
                 <div class="row">
                    <div class="col-xl-12">
                       <div class="card">
                          <div class="card-body">
                             <h4 class="box-title">Add user</h4>
                          </div>

                            <div class="card-body">

                              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                                    <div class="form-group">
                                      <label for="email">User Name</label>
                                      <input type="text" name="uname" class="form-control"   required>
                                    </div>

                                    <div class="form-group">
                                      <label for="email">Name</label>
                                      <input type="text" name="name" class="form-control"  required>
                                    </div>

                                    <div class="form-group">
                                      <label for="email">Password</label>
                                      <input type="text" name="pass" class="form-control"  required>
                                    </div>

                                    <div class="form-group">
                                      <label for="status">Role</label>
                                      <select class="form-control" name="role">
                                       <option disabled value="">Select Role</option>
                                       <option value="1">Admin</option>
                                       <option value="0">User</option>
                                      </select>
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    </form>

                                 </div>
                                 <div class="card-body--">
                                  <div class="alert alert-danger">
                                   <?php echo $msg; ?>
                                 </div>
                              </div>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
      <?php require ("footer.php");  ?>
