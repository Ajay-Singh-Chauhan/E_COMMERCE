  <?php
  require("connection_inc.php");
  require("func_inc.php");

  if(!isset($_SESSION['A_L'])) {
    header("Location: $host/admin/login.php");
  }

  if(isset($_GET['type'])){
    //  <!__Status__!>
    if ($_GET['type']=="status") {
      if (($_GET['operation']=='Active' && $_GET['id']!=null)) {
            $val=1;
            $id=get_safe_value($con,$_GET['id']);
      }
      if (($_GET['operation']=='Deactive' && $_GET['id']!=null)) {
        $val=0;
        $id=get_safe_value($con,$_GET['id']);
      }
      mysqli_query($con,"update product set status={$val} where pro_id={$id}");
      }
 //  <!__Delete__!>

  if ($_GET['type']=="delete") {

          $id=get_safe_value($con,$_GET['id']);
            mysqli_query($con,"delete from product where pro_id={$id}");
    }

}
    require("header.php");
    $res=mysqli_query($con,"select pro_id, p.cat_name as p_c_name, pro_name, pro_mrp,
    pro_price, pro_qty, pro_image, short_desc, full_desc,
    p.status as p_status, pro_meta_title, pro_meta_desc,
    cat_id, c.cat_name as c_c_name, c.status as c_status
    from product p join category c on p.cat_name = c.cat_id order by p.pro_id asc");
     ?>
         <div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Product</h4>
                           <a href='add_pro.php' class="btn btn-primary mt-3">Add Product</a>
                        </div>

                          <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th class="serial">S.NO</th>
                                       <th>ID</th>
                                       <th>Category</th>
                                       <th>Product Name</th>
                                       <th>MRP</th>
                                       <th>Price</th>
                                       <th>Qty</th>
                                       <th>Short Description</th>
                                       <th>Status</th>
                                       <th>Update</th>
                                       <th>Delete</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                   <?php
                                   $sno=1;
                                   while ($row=mysqli_fetch_assoc($res)) {
                                    ?>
                                    <tr>
                                       <td class="serial"><?php echo $sno; ?></td>
                                       <td><?php echo $row['pro_id']; ?> </td>
                                       <td><?php echo $row['c_c_name']; ?> </td>
                                       <td><?php echo $row['pro_name']; ?></td>
                                       <td><?php echo $row['pro_mrp']; ?> </td>
                                       <td><?php echo $row['pro_price']; ?> </td>
                                       <td><?php echo $row['pro_qty']; ?> </td>
                                       <td><?php echo $row['short_desc']; ?> </td>
                                       <!__Active and Deactive__!>
                                       <td>
                                         <span class="badge badge-success text-dark" >
                                           <?php if ($row['p_status']==1) {
                                            echo "<a class='text-dark' href='?type=status&operation=Deactive&id=".$row['pro_id']."'><b>Active</b></a>";
                                           }
                                           else {
                                            echo "<a class='text-dark'href='?type=status&operation=Active&id=".$row['pro_id']."'><b>Deactive</b></a>";
                                           }
                                           ?>
                                          </span>
                                       </td>
                                       <!__update__!>
                                       <td>
                                         <span class="badge badge-primary text-dark" >
                                           <?php
                                            echo "<a class='text-dark' href='update_pro.php?&id=".$row['pro_id']."'><b>Update</b></a>";
                                           ?>
                                          </span>
                                       </td>
                                        <!__Delete__!>
                                       <td>
                                         <span class="badge badge-danger" >
                                         <?php
                                          echo "<a class='text-dark' href='?type=delete&id=".$row['pro_id']."'><b>Delete</b></a>";
                                         ?>
                                          </span>
                                       </td>
                                    </tr>
                                  <?php  $sno=$sno+1; } ?>

                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
		  </div>
  <?php require ("footer.php");  ?>
