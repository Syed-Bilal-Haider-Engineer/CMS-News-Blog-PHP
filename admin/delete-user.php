<?php
include("config.php");
 if(isset($_GET['id']))
 {
     $id=$_GET['id'];
     $query="DELETE FROM `user` WHERE user_id='$id'";
     $result=mysqli_query($conn,$query) or die("Query is failed".mysqli_error($conn));
     if($result)
     { echo '<script> window.location.href="users.php"</script>';  die(); }
     else
     {   echo "Query is failed"; }}
     mysqli_close($conn);

?>