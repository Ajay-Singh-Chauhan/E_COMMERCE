
  <?php
  require("connection_inc.php");
  require("func_inc.php");

  if(!isset($_SESSION['A_L'])) {
    header("Location: $host/admin/login.php");
  }

  if(isset($_GET['type'])){
   //<!__Delete__!>
  if ($_GET['type']=="delete") {
          $id=get_safe_value($con,$_GET['id']);
            mysqli_query($con,"delete from users where user_id={$id}");
    }

}
    require("header.php");

    $res=mysqli_query($con,"select * from users order by user_id desc");
     ?>
         <div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Users</h4>
                           <a href="add_users.php" class="btn btn-primary mt-3">Add Users</a>
                        </div>

                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th class="serial">S.NO</th>
                                       <th>ID</th>
                                       <th>Uname</th>
                                       <th>Name</th>
                                       <th>Role</th>
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
                                       <td class="id"><?php echo $row['user_id'] ?></td>
                                       <td class="name"> <?php echo $row['user_name'] ?></td>
                                       <td class="name"> <?php echo $row['name'] ?></td>
                                       <td class="name"> <?php
                                       if ($row['role']==1) {
                                         echo "Admin";
                                       } else {
                                         echo "User";
                                       }?>
                                     </td>
                                       <!__update__!>
                                       <td>
                                         <span class="badge badge-primary text-dark" >
                                           <?php
                                            echo "<a class='text-dark' href='update_users.php?&id=".$row['user_id']."'><b>Update</b></a>";
                                           ?>
                                          </span>
                                       </td>
                                        <!__Delete__!>
                                       <td>
                                         <span class="badge badge-danger" >
                                         <?php
                                          echo "<a class='text-dark' href='?type=delete&id=".$row['user_id']."'><b>Delete</b></a>";
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
