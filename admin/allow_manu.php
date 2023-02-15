<?php

include "config.php";
session_start();
if(!$_SESSION['role']==1)
{
    echo '<script> window.location.href="post.php"</script>';  die();
}
?>