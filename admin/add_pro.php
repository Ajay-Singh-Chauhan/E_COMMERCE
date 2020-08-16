
  <?php
  require("connection_inc.php");
  require("func_inc.php");
  require("header.php");


    $msg="";
    if(isset($_FILES['img'])){
      $f_fullname=$_FILES['img']['name'];
      $f_temp_name=$_FILES['img']['tmp_name'];
      $f_sizee=$_FILES['img']['size'];

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
          //insert

                  if(isset($_POST['submit'])){

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

                     $res3=mysqli_query($con,"select * from product where cat_name={$category} and pro_name='{$name}' ");

                     if(mysqli_num_rows($res3)>0){
                             $msg= $name." Name aready exists";
                     }
                     else {

                       $res=mysqli_query($con,"insert into product (cat_name,pro_name,pro_mrp,pro_price,pro_qty,
                       pro_image,short_desc,full_desc,status,pro_meta_title,pro_meta_desc) values ({$category},'
                       {$name}',{$mrp},{$price },{$qty},'{$f_fullname}','{$s_desc}','{$f_desc}',{$status},'{$m_title}','{$m_desc}')");

                       if($res)
                        header("Location: $host/admin/product.php");
                       else
                         $msg="Query Failed";
                     }

                  }
      }

?>
<div class="content pb-0">
   <div class="orders">
      <div class="row">
         <div class="col-xl-12">
            <div class="card">

               <div class="card-body card-title">
                  <h4 class="box-title">Add Product</h4>
                     </div>
                   <div class="card-body">

                   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

                       <div class="form-group">
                         <label for="category">Category</label>
                           <select class="form-control" name="category">
                             <option value="" selected disabled>select category</option>
                           <?php

                           $cat_res=mysqli_query($con,"select * from category");

                               while($row2=mysqli_fetch_assoc($cat_res)){

                             ?>
                           <option value="<?php echo $row2['cat_id']; ?>" ><?php echo $row2['cat_name'];  ?></option>
                         <?php } ?>
                         </select>
                       </div>

                       <div class="form-group">
                         <label for="email">Product Name</label>
                         <input type="text" name="name" class="form-control" required>
                       </div>

                       <div class="form-group">
                         <label for="mrp">MRP</label>
                         <input type="text" name="mrp" class="form-control"  required>
                       </div>

                       <div class="form-group">
                         <label for="email">Price</label>
                         <input type="text" name="price" class="form-control" required>
                       </div>

                       <div class="form-group">
                         <label for="email">Qty</label>
                         <input type="text" name="qty" class="form-control" required>
                       </div>

                       <div class="form-group">
                           <input type="file" name="img"  value="">
                       </div>

                       <div class="form-group">
                          <label for="comment">Short Description</label>
                          <textarea name="s_desc" class="form-control" rows="8" cols="80"></textarea>
                       </div>

                       <div class="form-group">
                          <label for="comment">Full Description</label>
                          <textarea name="f_desc" class="form-control" rows="8" cols="80"></textarea>
                       </div>

                       <div class="form-group">
                         <label for="status">Status</label>
                         <select class="form-control" name="status">
                           <option value="1">Active</option>
                           <option value="0">Deactive</option>
                         </select>
                       </div>

                       <div class="form-group">
                         <label for="date">Meta Title</label>
                         <input type="text" name="m_title" class="form-control" class="form-control" required>
                       </div>

                       <div class="form-group">
                          <label for="comment">Product Meta Description</label>
                          <textarea name="m_desc" class="form-control" rows="8" cols="80"></textarea>
                       </div>

                       <div class="form-group">
                         <input type="submit" name="submit" class="form-control btn btn-primary">
                       </div>


                       <div class="alert alert-danger">
                        <?php echo $msg; ?>
                      </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
<?php require ("footer.php");



?>
