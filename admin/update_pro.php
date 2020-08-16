
  <?php
  require("connection_inc.php");
  require("func_inc.php");
  $msg="";
  if(!isset($_SESSION['A_L'])) {
    header("Location: $host/admin/login.php");
  }

 if(isset($_POST['submit'])){
   $f_fullname="";

   if(!empty($_FILES['new-img']['name'])){
     $f_fullname=$_FILES['new-img']['name'];
     $f_temp_name=$_FILES['new-img']['tmp_name'];
     $f_sizee=$_FILES['new-img']['size'];

     $f_nameArray= explode('.',$f_fullname);
     $f_extension=strtolower(end($f_nameArray));
     $extension=['jpg','jpeg','gif','png'];

     //Validations

      $error = array();

         if(in_array($f_extension,$extension)===false){
           $error[]="please enter jpg jpeg png formate";
         }
         if($f_sizee>2097152){
           $error[]="This file not allowed greater then 2 md.";
         }
         if(empty($error)==true){
           move_uploaded_file($f_temp_name,images_server.'/'.$f_fullname);
         }
         else {
           print_r($error);
           die();
         }
   }
   else {
          $f_fullname=$_POST['old-img'];
       }
        //insert
   $id =get_safe_value($con,$_POST['id']);
   $category =get_safe_value($con,$_POST['category']);
   $name =get_safe_value($con,$_POST['name']);
   $mrp =get_safe_value($con,$_POST['mrp']);
   $price =get_safe_value($con,$_POST['price']);
   $qty =get_safe_value($con,$_POST['qty']);

   $m_title =get_safe_value($con,$_POST['m_title']);
   $m_desc =get_safe_value($con,$_POST['m_desc']);
   $s_desc =get_safe_value($con,$_POST['s_desc']);
   $f_desc =get_safe_value($con,$_POST['f_desc']);
   $status =get_safe_value($con,$_POST['status']);

   $res=mysqli_query($con,"select * from product where cat_name={$category} and pro_name='{$name}' ");

   if(mysqli_num_rows($res)>0){
           $msg= $name." Name aready exists";
   }
   else {

     $res2=mysqli_query($con,"update product set cat_name={$category},pro_name='{$name}',pro_mrp={$mrp},
     pro_price={$price },pro_qty={$qty}, pro_image='{$f_fullname}',short_desc='{$s_desc}',
     full_desc='{$f_desc}',status={$status},pro_meta_title='{$m_title}',pro_meta_desc='{$m_title}'
     where pro_id={$id}");

     if($res2)
      header("Location: $host/admin/product.php");
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
                           <h4 class="box-title">Update Product</h4>
                        </div>

                          <div class="card-body">
                              <?php
                                if ((isset($_GET['id'])&&$_GET['id']!=null)) {
                                    $id=get_safe_value($con,$_GET['id']);

                                    $res3=mysqli_query($con,"select pro_id, p.cat_name as p_c_name, pro_name, pro_mrp,
                                    pro_price, pro_qty, pro_image, short_desc, full_desc,
                                    p.status as p_status, pro_meta_title, pro_meta_desc,
                                    cat_id, c.cat_name as c_c_name, c.status as c_status
                                    from product p join category c on p.cat_name = c.cat_id
                                    where pro_id = $id");
                                }
                                else {
                                  $id=0;

                                  $res3=mysqli_query($con,"select pro_id, p.cat_name as p_c_name, pro_name, pro_mrp,
                                  pro_price, pro_qty, pro_image, short_desc, full_desc,
                                  p.status as p_status, pro_meta_title, pro_meta_desc,
                                  cat_id, c.cat_name as c_c_name, c.status as c_status
                                  from product p join category c on p.cat_name = c.cat_id
                                  where pro_id = $id");
                                }
                               ?>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                               <?php while ($row=mysqli_fetch_assoc($res3)) {
                                ?>
                                <div class="form-group">
                                  <input type="hidden" name="id" class="form-control" value="<?php echo $row['pro_id']; ?>" required>
                                </div>

                                  <div class="form-group">
                                     <label for="">Category</label>
                                    <select class="form-control" name="category">
                                      <option disabled value="">SELECT CATEGORY</option>
                                      <?php
                                      $cat_res=mysqli_query($con,"select * from category");

                                          while($row2=mysqli_fetch_assoc($cat_res)){
                                              if ($row['cat_name']==$row2['cat_id']) {
                                                echo "<option value=".$row2['cat_id']."selected>".$row2['cat_name']."</option>";
                                              }
                                              else {
                                                echo "<option value=".$row2['cat_id'].">".$row2['cat_name']."</option>";
                                              }
                                            }
                                        ?>
                                    </select>
                                  </div>

                                  <div class="form-group">
                                    <label for="email">Product Name</label>
                                    <input type="text" name="name" class="form-control" aria-describedby="emailHelp" placeholder="<?php echo $row['pro_name']; ?>" required>
                                  </div>

                                  <div class="form-group">
                                    <label for="email">MRP</label>
                                    <input type="text" name="mrp" class="form-control" aria-describedby="emailHelp" placeholder="<?php echo $row['pro_mrp']; ?>" required>
                                  </div>

                                  <div class="form-group">
                                    <label for="email">Price</label>
                                    <input type="text" name="price" class="form-control" aria-describedby="emailHelp" placeholder="<?php echo $row['pro_price']; ?>" required>
                                  </div>

                                  <div class="form-group">
                                    <label for="email">Qty</label>
                                    <input type="text" name="qty" class="form-control" aria-describedby="emailHelp" placeholder="<?php echo $row['pro_qty']; ?>" required>
                                  </div>

                                  <div class="form-group">
                                    <label for="img">Product Images</label>
                                     <input type="file" name="new-img" value="">
                                    <input type="hidden" name="old-img" value="<?php echo $row['pro_image']; ?>">
                                  </div>

                                  <div class="form-group">
                                    <img  src="upload/<?php echo $row['pro_image'];?>" alt="images">
                                  </div>

                                  <div class="form-group">
                                     <label for="comment">Short Description</label>
                                     <textarea  class="form-control" name="s_desc" rows="8" cols="80"><?php echo $row['short_desc']; ?></textarea>
                                  </div>

                                  <div class="form-group">
                                     <label for="comment">Full Description</label>
                                     <textarea  class="form-control" name="f_desc" rows="8" cols="80"><?php echo $row['full_desc']; ?></textarea>
                                  </div>

                                  <div class="form-group">
                                    <label for="date">Meta Title</label>
                                    <input type="text" name="m_title" class="form-control" aria-describedby="emailHelp" placeholder="<?php echo $row['pro_meta_title']; ?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" name="status">
                                      <?php
                                        if ($row['p_status']==1) {
                                          echo "<option value='1' selected>Active<option>";
                                          echo "<option value='0'>Deactive</option>";
                                        }
                                        else {
                                          echo "<option value='1'>Active</option>";
                                          echo "<option value='0' selected>Deactive</option>";
                                        }
                                       ?>
                                    </div>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                     <label for="comment">Product Meta Description</label>
                                     <textarea name="m_desc" class='form-control' rows="8" cols="80"><?php echo $row['full_desc']; ?></textarea>
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
