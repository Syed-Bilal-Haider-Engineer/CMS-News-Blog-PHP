<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>News</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
    
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
                <a href="index.php" id="logo"><img src="images/news.jpg"></a>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <ul class='menu'>
            <li><a  href='index.php' alt="News Website">Home</a></li>
            
                <?php
                include "admin/config.php";
                  $active="";
                   $sql="SELECT * from category where post > 0";
                   $cat_query=mysqli_query($conn,$sql) or die("Queyr is failed".mysqli_error($conn));
                   while($row=mysqli_fetch_assoc($cat_query))
                   {
                    if(isset($_GET['id']))
                    {
                        $id=$_GET['id'];
                        if($row['category_id']==$id)
                        {
                            $active="active";
                        }
                    }
                    else{
                                $active="";
                        }
                      
                      echo  "<li><a class='{$active}' href='category.php?id={$row['category_id']}'>{$row['category_name']}</a></li>";
                   }
             ?> 
              
            <li><a  href='contact.php' alt="News Website">Contact us</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
