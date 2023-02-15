<?php include "header.php"; 
   error_reporting(true);
   $limit=5;
  if(isset($_GET['id']))
  {
      $page_id=$_GET['id'];
  }
  else{
    $page_id=1;
  }
  $offset=($page_id-1)*$limit;
   $sql="SELECT `user_id`,`first_name`, `last_name`, `username`, `password`, `role` FROM `user` ORDER BY user_id DESC LIMIT  {$offset},{$limit} ";
   $result=mysqli_query($conn,$sql) or die("Query is failed:".mysqli_error($conn));
   if(mysqli_num_rows( $result)>0)
   {
?>
<head>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>last Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                          <?php 
                          $i=0;
                            while($row=mysqli_fetch_assoc($result))
                            { $i++; ?>
                          <tr>
                              <td class='id'><?php echo $i;?></td>
                              <td><?php echo $row['first_name'];?></td>
                              <td><?php echo $row['last_name']?></td>
                              <?php if($row['role']==1) {?>
                              <td>Admin</td>
                              <?php } else { echo " <td>User</td>";}  ?>
                              <td class='edit'><a href='update-user.php?id=<?php echo $row['user_id'];?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-user.php?id=<?php echo $row['user_id'];?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php }?>
                      </tbody>
                  </table>
                  <!-- this is code of pagination; -->
                  <?php
                //   select all record in user table;
                     $pag_sql="SELECT * from user";
                     $pag_query=mysqli_query($conn,$pag_sql);
                     if(mysqli_num_rows($pag_query)>0)
                     {
                         $total_record=mysqli_num_rows($pag_query);
                        
                        // how many creates totals page according to pagniations;
                         $total_page=ceil($total_record/$limit);
                         echo  "<ul class='pagination admin-pagination'>";
                         //previous  button code here
                         if($page_id>1)
                         {
                            $user_id=$page_id-1;
                            echo " <li class='active'><a href='users.php?id=$user_id'>Prev</a></li>";
                         }
                        //  overall pagniations of users
                         for($i=1; $i<= $total_page; $i++)
                         {
                           echo " <li class='active' ><a href='users.php?id=$i'>".$i."</a></li>";
                       }
                 echo $boonam;
                       //next page button code here
                                if($total_page>$page_id)
                                {
                                    $next_id=$page_id+1;
                                echo " <li class='active'><a href='users.php?id=$next_id'>Next</a></li>";
                                }
                         echo " </ul>";
                     }
                  ?>
              </div>
          </div>
      </div>
  </div>
<?php }
  else{
      echo "<h1>Result not Found: </h1>";
        }
        include "footer.php";
        mysqli_close($conn); ?>
