<?php
include "config.php";
// error_reporting(0);
session_start();
?>
<!doctype html>
<html>
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ADMIN | Login</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                        <img class="logo" src="images/news.jpg">
                        <h3 class="heading">Admin</h3>
                        <!-- Form Start -->
                        <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method ="POST" autocomplete="off">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="" required>
                            </div>
                            <input type="submit" name="login" class="btn btn-primary" value="login" />
                        </form>
                        <!-- /Form  End -->
                        <?php
                        if(isset($_POST['login']))
                        {
                            
                            $name=mysqli_real_escape_string($conn,$_POST['username']);
                            $pass=mysqli_real_escape_string($conn,$_POST['password']);
                            
                            $sql="SELECT * FROM user WHERE username='$name'";
                             $data=mysqli_query($conn,$sql) or die("Query is failed.".mysqli_error($conn));
                             if(mysqli_num_rows($data)>0)
                             {
                                $result=mysqli_fetch_assoc($data);
                                $hashed=$result['password'];
                            //    if(password_verify($pass,$hashed))
                            //    {
                                   $_SESSION['role']=$result['role'];
                                    $_SESSION['username']=$result['username'];
                                    $_SESSION['user_id']=$result['user_id'];
                                    echo '<script> window.location.href="post.php"</script>'; 
                                     die();   
                            //    }else{
                            //     echo "<p class='alert alert-danger ml-2'>Password is not match, please try again!</p>";
                            //    }
                                 
                             }
                             else{
                                 echo "<p class='alert alert-danger ml-2'>Invalid username,Please enter correct username:</p>";
                             }
                        }?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
