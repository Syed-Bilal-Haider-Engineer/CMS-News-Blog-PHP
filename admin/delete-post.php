<?php
include("config.php");
 if(isset($_GET['id']) && isset($_GET['catid']))
 {
            $id=$_GET['id'];
            $cat_id=$_GET['catid'];
            // first query is use select image from database and then unlink from folder
            $select_query="SELECT `post_img` FROM `post` WHERE post_id={$id}";
            $select_result=mysqli_query($conn,$select_query) or die("Query is selections failed".mysqli_error($conn));
            $fetch_img=mysqli_fetch_assoc($select_result);
            $img=$fetch_img['post_img'];
            unlink("images/".$img);
            if($select_result)
            {
            //second query is used for update numbers of post in categor table
            $Update_query="UPDATE `category` SET post = post - 1 WHERE `category_id`= '$cat_id'";

     //third query is used for deletion data from database according to id;
            $query="DELETE FROM `post` WHERE post_id='$id'";
            $result=mysqli_query($conn,$query) or die("Query is Deletion failed".mysqli_error($conn));
            if($result)
            {   
          $result_update=mysqli_query($conn,$Update_query) or die("Query is update failed".mysqli_error($conn));
                if($result_update)
                {
                echo '<script> window.location.href="post.php"</script>';  die();
                }
                }
                }
                else
                {   echo "Query is failed"; }
            }
?>