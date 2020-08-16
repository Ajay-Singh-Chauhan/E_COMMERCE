
  <?php
  require("connection_inc.php");
  require("func_inc.php");
  $msg="";
  if(!isset($_SESSION['A_L'])) {
    header("Location: $host/admin/login.php");
  }

 if(isset($_POST['submit'])){
    $name=get_safe_value($con,$_POST['name']);
    $email=trim(get_safe_value($con,$_POST['email']));
    $id=get_safe_value($con,$_POST['id']);
    $mobile=get_safe_value($con,$_POST['mobile']);
    $comment=get_safe_value($con,$_POST['comment']);
    $date=get_safe_value($con,$_POST['date']);

    $res2=$res=mysqli_query($con,"select * from contact_us where email='{$email}' ");
    if(mysqli_num_rows($res2)>0){
      $msg= $email." Email aready exists";
    }
    else {
      $res=mysqli_query($con,"update contact_us set
       name='{$name}',email='{$email}', mobile='{$mobile}',
       comment='{$comment}', add_on='{$date}'  where id={$id}");

      if($res)
       header("Location: $host/admin/contact.php");
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
                           <h4 class="box-title">Update Category</h4>
                        </div>

                          <div class="card-body">
                              <?php
                                if ((isset($_GET['id'])&&$_GET['id']!=null)) {
                                    $id=get_safe_value($con,$_GET['id']);
                                    $res=mysqli_query($con,"select * from contact_us where id = {$id}");
                                }
                               ?>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                               <?php while ($row=mysqli_fetch_assoc($res)) {
                                ?>

                                <div class="form-group">
                                  <input type="hidden" name="id" class="form-control" value="<?php echo $row['id']; ?>" required>
                                </div>

                                  <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" aria-describedby="emailHelp" placeholder="<?php echo $row['name']; ?>" required>
                                  </div>

                                  <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" class="form-control" aria-describedby="emailHelp" placeholder="<?php echo $row['email']; ?>" required>
                                  </div>

                                  <div class="form-group">
                                    <label for="email">Mobile</label>
                                    <input type="text" name="mobile" class="form-control" aria-describedby="emailHelp" placeholder="<?php echo $row['mobile']; ?>" required>
                                  </div>

                                  <div class="form-group">
                                     <label for="comment">Comment</label>
                                     <textarea name="comment" rows="8" cols="80"><?php echo $row['comment']; ?></textarea>
                                  </div>

                                  <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="text" name="date" class="form-control" aria-describedby="emailHelp" placeholder="<?php echo $row['add_on']; ?>" required>
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
