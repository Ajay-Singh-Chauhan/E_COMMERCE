
  <?php
  require("connection_inc.php");
  require("func_inc.php");
  $msg="";
  if(!isset($_SESSION['A_L'])) {
    header("Location: $host/admin/login.php");
  }

 if(isset($_POST['submit'])){

        //insert
   $id =get_safe_value($con,$_POST['id']);
   $uname =get_safe_value($con,$_POST['uname']);
   $pass =get_safe_value($con,$_POST['pass']);
   $name =get_safe_value($con,$_POST['name']);
   $role =get_safe_value($con,$_POST['role']);

   $res=mysqli_query($con,"select * from users where user_name={$uname}");

   if(mysqli_num_rows($res)>0){
           $msg= $uname." Name aready exists";
   }
   else {

     $res2=mysqli_query($con,"update users set user_name='{$uname}',name='{$name}',role={$role},
     password={$pass}  where user_id={$id}");

     if($res2)
      header("Location: $host/admin/users.php");
     else
       $msg="Query Failed";
   }
}
    require("header.php");
     ?>
         <div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Update user</h4>
                        </div>

                          <div class="card-body">
                              <?php
                                if ((isset($_GET['id'])&&$_GET['id']!=null)) {
                                    $id=get_safe_value($con,$_GET['id']);

                                    $res3=mysqli_query($con,"select * from users
                                    where user_id = $id");
                                }
                                else {
                                  $id=0;

                                  $res3=mysqli_query($con,"select * from users
                                  where user_id = $id");
                                }
                               ?>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                               <?php while ($row=mysqli_fetch_assoc($res3)) {
                                ?>
                                <div class="form-group">
                                  <input type="hidden" name="id" class="form-control" value="<?php echo $row['user_id']; ?>" required>
                                </div>

                                  <div class="form-group">
                                    <label for="email">User Name</label>
                                    <input type="text" name="uname" class="form-control"  placeholder="<?php echo $row['user_name']; ?>" required>
                                  </div>

                                  <div class="form-group">
                                    <label for="email">Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="<?php echo $row['name']; ?>" required>
                                  </div>

                                  <div class="form-group">
                                    <label for="email">Password</label>
                                    <input type="text" name="pass" class="form-control" placeholder="<?php echo $row['password']; ?>" required>
                                  </div>

                                  <div class="form-group">
                                    <label for="status">Role</label>
                                    <select class="form-control" name="role">
                                      <?php
                                        if ($row['role']==1) {
                                          echo "<option value='1' selected>Admin<option>";
                                          echo "<option value='0'>User</option>";
                                        }
                                        else {
                                          echo "<option value='1'>Admin</option>";
                                          echo "<option value='0' selected>User</option>";
                                        }
                                       ?>
                                    </div>
                                    </select>
                                  </div>

                                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                  </form>
                                <?php } ?>
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
