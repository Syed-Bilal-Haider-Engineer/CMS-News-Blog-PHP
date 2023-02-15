<?php
include "config.php";

if(empty($_FILES['new-image']['name'])){
  $file_name = $_POST['old_image'];
}else{
  $errors = array();

  $file_name =  $name=rand(111111111,999999999)."_".$_FILES['new-image']['name'];
  $file_tmp = $_FILES['new-image']['tmp_name'];
  $file_type = $_FILES['new-image']['type'];
  $file_ext = pathinfo($name,PATHINFO_EXTENSION);

  $extensions = array("jpeg","jpg","png");

  if(in_array($file_ext,$extensions) === false)
  {
    $errors[] = "This extension file not allowed, Please choose a JPG or PNG file.";
  }
  $path="images/".$file_name;
  if(empty($errors) == true){
    move_uploaded_file($file_tmp,$path);
  }else{
    print_r($errors);
    die();
  }
}

$sql = "UPDATE post SET title='{$_POST["post_title"]}',description='{$_POST["postdesc"]}',category={$_POST["category"]},post_img='{$file_name}'
        WHERE post_id={$_POST["post_id"]};";
if($_POST['old_category'] != $_POST["category"] ){
  $sql .= "UPDATE category SET post= post - 1 WHERE category_id = {$_POST['old_category']};";
  $sql .= "UPDATE category SET post= post + 1 WHERE category_id = {$_POST["category"]};";
}

$result = mysqli_multi_query($conn,$sql);

if($result){
  header("Location:post.php");
}else{
  echo "Query Failed";
}

?>
