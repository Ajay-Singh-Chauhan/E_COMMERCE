
  <?php
  require("connection_inc.php");
  require("func_inc.php");

  if(!isset($_SESSION['A_L'])) {
    header("Location: $host/admin/login.php");
  }

  if(isset($_GET['type'])){
    //  <!__Status__!>
    if ($_GET['type']=="status") {
      if (($_GET['operation']=='Active'&&$_GET['id']!=null)) {
            $val=1;
            $id=get_safe_value($con,$_GET['id']);
      }
      if (($_GET['operation']=='Deactive'&&$_GET['id']!=null)) {
        $val=0;
        $id=get_safe_value($con,$_GET['id']);
      }

      mysqli_query($con,"update category set status={$val} where cat_id={$id}");
      }
 //  <!__Delete__!>

  if ($_GET['type']=="delete") {

          $id=get_safe_value($con,$_GET['id']);
            mysqli_query($con,"delete from category where cat_id={$id}");
    }

}

    require("header.php");
    $res=mysqli_query($con,"select * from category order by cat_id asc")
     ?>
         <div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Category</h4>
                           <a href="add_cat.php" class="btn btn-primary mt-3">Add Category</a>
                        </div>

                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th class="serial">S.NO</th>
                                       <th>ID</th>
                                       <th>Category Name</th>
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
                                       <td> <span class="product"><?php echo $row['cat_id'] ?></span> </td>
                                       <td> <span class="name"><?php echo $row['cat_name'] ?></span> </td>
                                       <!__Active and Deactive__!>
                                       <td>
                                         <span class="badge badge-success text-dark" >
                                           <?php if ($row['status']==1) {
                                            echo "<a class='text-dark' href='?type=status&operation=Deactive&id=".$row['cat_id']."'><b>Active</b></a>";
                                           }
                                           else {
                                            echo "<a class='text-dark'href='?type=status&operation=Active&id=".$row['cat_id']."'><b>Deactive</b></a>";
                                           }
                                           ?>
                                          </span>
                                       </td>
                                       <!__update__!>
                                       <td>
                                         <span class="badge badge-primary text-dark" >
                                           <?php
                                            echo "<a class='text-dark' href='cat_update.php?&id=".$row['cat_id']."'><b>Update</b></a>";
                                           ?>
                                          </span>
                                       </td>
                                        <!__Delete__!>
                                       <td>
                                         <span class="badge badge-danger" >
                                         <?php
                                          echo "<a class='text-dark' href='?type=delete&id=".$row['cat_id']."'><b>Delete</b></a>";
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
