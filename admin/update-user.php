<?php include "header.php"; ?>
<?php
global $id;
$msg="";
  if(isset($_GET['id']))
  {
      $id=$_GET['id'];
     $sql="SELECT `user_id`, `first_name`, `last_name`, `username`, `password`, `role` FROM `user` WHERE user_id='$id'";
     $result=mysqli_query($conn,$sql) or die("Query is failed:".mysqli_error($conn));
    }

    if(isset($_POST['submit']))
    {
        $User_id=mysqli_real_escape_string($conn,$_POST['user_id']);
        $fname=mysqli_real_escape_string($conn,$_POST['f_name']);
        $lname=mysqli_real_escape_string($conn,$_POST['l_name']);
        $username=mysqli_real_escape_string($conn,$_POST['username']);
        $role=mysqli_real_escape_string($conn,$_POST['role']);
       $sql="UPDATE `user` SET `first_name`=' $fname',`last_name`='$lname',`username`='$username',`role`='$role' WHERE user_id=' $User_id'";
         $query=mysqli_query($conn,$sql) or die("Query is failed:".mysqli_error($conn));
         if($query)
         {
            echo '<script> window.location.href="users.php"</script>';  die(); 
         }
         else
         {
             $msg="Data is not update";
         }
    }
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                  <!-- Form Start -->
                  <?php while($row=mysqli_fetch_assoc($result))
                  {?>
                  <form  action="" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo $row['user_id'];?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name'];?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name'];?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $row['username'];?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?php echo $row['role']; ?>">
                              <option value="0">normal User</option>
                              <option value="1">Admin</option>
                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                     <?php  echo $msg;?>
                    </form>
                  <?php } ?>
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
