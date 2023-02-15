<?php include "header.php";?>
  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Add New Post</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form -->
                  <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="post_title">Title</label>
                          <input type="text" name="post_title" class="form-control" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1"> Description</label>
                          <textarea name="postdesc" class="form-control" rows="5"  required></textarea>
                      </div>
                      <?php
                       $sql_category="SELECT `category_id`, `category_name`, `post` FROM `category`";
                        $result=mysqli_query($conn, $sql_category);
                        if(mysqli_num_rows($result)>0) {
                         ?>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Category</label>
                          <select name="category" class="form-control">
                              <option value="" disabled> Select Category</option>
                              <?php while($row=mysqli_fetch_assoc($result)){ 
                                  ?>
                              <option value="<?php echo $row['category_id'];?>"> <?php echo $row['category_name'];?></option>
                              <?php 
                              }
                               ?>
                             
                          </select>
                      </div>
                     <?php } ?>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Post image</label>
                          <input type="file" name="image" required>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                  </form>
                  <!--/Form -->
                
              </div>
          </div>
      </div>
  </div>
  <!-- here started code of upload image and insert post data in database; -->
  <?php
            define('DISH_NAME',$_SERVER['DOCUMENT_ROOT']."/corenews/images");
                if(isset($_POST['post_title']) && isset($_POST['postdesc']) && isset($_POST['category']) && isset($_FILES['image']) && isset($_POST['submit']))
                {
                
                    $post_title=mysqli_real_escape_string($conn,$_POST['post_title']);
                    $postdesc=mysqli_real_escape_string($conn,$_POST['postdesc']);
                    $category_id=mysqli_real_escape_string($conn,$_POST['category']);
                    // code started of files uploades and moves in folder;
                                $name=rand(111111111,999999999)."_".$_FILES['image']['name'];
                                $tepname=$_FILES['image']['tmp_name'];
                                $path="images/".$name;
                                move_uploaded_file($tepname,$path);
                                $pathinfo=pathinfo($name,PATHINFO_EXTENSION);

                    $date=date('Y-M-d');
                    $auther=$_SESSION['username'];
                    if($pathinfo=='png' ||$pathinfo=='PNG' || $pathinfo=='jpg' || $pathinfo=='JPG')
                    {
                        // started sqls queries , insert data of pos in mysqli database;

                            $sql="INSERT INTO `post`( `title`, `description`, `category`, `post_date`, `author`, `post_img`) VALUES ('$post_title','$postdesc','$category_id','$date','$auther','$name')";
                            $query1=mysqli_query($conn,$sql) or die("Query is first failed".mysqlI_error($conn));
                            if($query1)
                            {
                                $sql2="UPDATE category SET post = post+1 WHERE category_id = {$category_id}";
                              $query2=mysqli_query($conn,$sql2) or die("Query is second failed".mysqlI_error($conn));
                            
                              if($query2)
                              {
                                
                                echo "<p class='alert alert-danger w-25'>Insert successfully:</p>";
                                header("Location:post.php");
                              }
                              else{
                                  echo "<p class='alert alert-danger w-25'>Category is not incremnet:</p>";
                              }
                            }
                            else
                            {
                                echo " <p class='alert alert-danger w-25'>Post Not insert:</p>";
                            }
                           
                    }
                    else
                    {
                        echo " <p class='alert alert-danger w-25'>Please enter PNG or JPG:</p>";
                    }
                   
                }
               
    ?>
<?php include "footer.php"; ?>
