<?php include "header.php"; 
 if(isset($_POST['save']))
 {
     if(empty($_POST['cat']))
     {
         echo "Please enter the category";
     }
     else
     {
     $cat_name=mysqli_real_escape_string($conn,$_POST['cat']);
     $cate_query="INSERT INTO `category`( `category_name`,`post`) VALUES ('$cat_name',0)";
     $result=mysqli_query($conn,$cate_query) or die("Query is falied".nysqli_error($conn));
     if($result)
     {
        echo " <p class='alert alert-danger w-25'>Category insert successfully:</p>";
     }
     else
     {
        echo " <p class='alert alert-danger w-25'>Category not insert successfully:</p>";
     }
     }
     
 }
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
