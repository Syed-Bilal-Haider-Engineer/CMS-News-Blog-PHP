<?php include "header.php"; 
$msg="";
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add User</h1>
              </div>
             
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="user" class="form-control" placeholder="Username" required>
                      </div>

                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                              <option value="0">Normal User</option>
                              <option value="1">Admin</option>
                          </select>
                      </div>
                      <input type="submit"  name="save" class="btn btn-primary" value="Save" required />
                      <?php echo "<span color='black'>".$msg."</span>"; ?>
                  </form>
                   <!-- Form End-->
               </div>
              
           </div>
       </div>
   </div>
   <?php include "footer.php";?>
   <?php
  if(isset($_POST['save']))
  {
       $msg="";
       $fname=$lname=$role=$password=$user="";
       //this is first name;
       if (empty($_POST["fname"]))
       { $msg="First name is required:";  } 
       else{ $fname=mysqli_real_escape_string($conn,$_POST['fname']); }
       //this is last name:
       if (empty($_POST["lname"]))
       { $msg="last name name is required:";  } 
       else{  $lname=mysqli_real_escape_string($conn,$_POST['lname']);   }
       //this is user name;
       if (empty($_POST["user"]))
       { $msg="user name is required:";  } 
       else{ $user=mysqli_real_escape_string($conn,$_POST['user']); }
       //this is password of user;
       if (empty($_POST["password"]))
       { $msg="user password is required:";  } 
       else{  $password=mysqli_real_escape_string($conn,$_POST['password']);
            //   $hash_password=password_hash($password,PASSWORD_BCRYPT);
       }
       //this is user role in the website;
       if (empty($_POST["role"]))
       { $msg="Role of user is required:";  } 
       else{  $role=mysqli_real_escape_string($conn,$_POST['role']);  }
      $sql="INSERT INTO `user`( `first_name`, `last_name`, `username`, `password`, `role`) VALUES ('$fname','$lname','$user',' $password','$role')";
      $query=mysqli_query($conn, $sql) or die("Query is failed:".mysqli_error($conn));
      if($query) 
          $msg="Data Insert successfully:";
      }
      else{
          $msg="Data is not insert successfully:";
      }
      ?>

