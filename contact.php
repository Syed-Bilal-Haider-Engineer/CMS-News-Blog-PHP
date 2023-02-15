<?php include "header.php";
 $msg="";
  ?>
<head>
  <style>
       <?php include 'css/contact-style.css';?>
  </style>
</head>
<div class="container contact-container">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method ="POST" autocomplete="off">
  <div class="row">
    <div class="col-25">
      <label for="name"> Name</label>
    </div>
    <div class="col-75">
      <input type="text" id="name" name="firstname" placeholder="Your name..">
    </div>
  </div>
  
    <div class="row">
    <div class="col-25">
      <label for="email">Email</label>
    </div>
    <div class="col-75">
      <input type="text" id="email" name="email" placeholder="Email">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="phone">Phone number</label>
    </div>
    <div class="col-75">
      <input type="number" id="phone" name="phone" placeholder="Your phone number">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="country">Country</label>
    </div>
    <div class="col-75">
      <select id="country" name="country">
        <option value="australia">Australia</option>
        <option value="canada">Canada</option>
        <option value="usa">USA</option>
      </select>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="subject">Subject</label>
    </div>
    <div class="col-75">
      <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>
    </div>
  </div>
  <div class="row">
    <input type="submit" value="Submit">
  </div>
  </form>
</div>
<?php include 'footer.php'; ?>
<?php

if(isset($_POST['submit']))
{
    
     $name=$email=$phonenumber=$password=$country=$subject="";
     //this is first name;
     if (empty($_POST["firstname"]))
     { $msg="First name is required:";  } 
     else{ $name=mysqli_real_escape_string($conn,$_POST['firstname']); 
    echo $name;}
     //this is last name:
     if (empty($_POST["email"]))
     { $msg="email is required:";  } 
     else{  $email=mysqli_real_escape_string($conn,$_POST['email']);   }
     //this is user name;
     if (empty($_POST["phone"]))
     { $msg="phone number is required:";  } 
     else{ $phonenumber=mysqli_real_escape_string($conn,$_POST['phone']); }
     //this is password of user;
     if (empty($_POST["country"]))
     { $msg="country is required:";  } 
     else{  $country=mysqli_real_escape_string($conn,$_POST['country']);
          //   $hash_password=password_hash($password,PASSWORD_BCRYPT);
     }
     //this is user role in the website;
     if (empty($_POST["subject"]))
     { $msg="subject of user is required:";  } 
     else{  $subject=mysqli_real_escape_string($conn,$_POST['subject']);  }
    $sql="INSERT INTO `contact`( `name`, `email`, `phonenumber`, `country`, `subject`) VALUES ('$name','$email','$phonenumber',' $country','$subject')";
    $query=mysqli_query($conn, $sql) or die("Query is failed:".mysqli_error($conn));
    if($query) 
        $msg="Data Insert successfully:";
    }
    else{
        $msg="Data is not insert successfully:";
    }
    ?>