
  <?php
  require("connection_inc.php");
  require("func_inc.php");
  $msg="";
  if(!isset($_SESSION['A_L'])) {
    header("Location: $host/admin/login.php");
  }

 if(isset($_POST['submit'])){
    $status=get_safe_value($con,$_POST['status']);
    $cat_name=get_safe_value($con,$_POST['cat_name']);

    $res2=$res=mysqli_query($con,"select * from category where cat_name='{$cat_name}' ");
    if(mysqli_num_rows($res2)>0){
            $msg= $cat_name." Category aready exists";
    }
    else {
      $res=mysqli_query($con,"insert into category (cat_name,status) values ('{$cat_name}',$status)");
      if($res)
       header("Location: $host/admin/category.php");
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
                           <h4 class="box-title">Add Category</h4>
                        </div>

                          <div class="card-body">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                  <div class="form-group">
                                    <label for="cat_name">New Category Name</label>
                                    <input type="text" name="cat_name" class="form-control" aria-describedby="emailHelp" placeholder="Enter Name here.." required>
                                  </div>
                                  <div class="form-group">
                                    <label for="status">Status</label>
                                      <select class="" name="status" required>
                                        <option value="1">Active</option>
                                        <option value="0">Deactive</option>
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
