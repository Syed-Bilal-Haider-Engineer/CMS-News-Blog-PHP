<?php
include 'config.php';
 if(isset($_GET['id']))
 {
     $id=$_GET['id'];
    //  echo $id;
     $query="SELECT `user_id`,`first_name`, `last_name`, `username`, `password`, `role` FROM `user` WHERE user_id='$id'";
     $result=mysqli_query($conn,$query) or die("Query is fialed".mysqli_error($conn));
     if(mysqli_num_rows($result)!=0)
    { //   echo "Data is metch";
          while($row=mysqli_fetch_assoc($result))
          {
              echo $row['first_name']."--".$row['last_name'];
          }
    } }
 ?>