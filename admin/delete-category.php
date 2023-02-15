<?php
    include 'config.php';
    $cat_id = $_GET["id"];

    /*sql to delete a record*/
    $sql = "DELETE FROM category WHERE category_id ='{$cat_id}'";
    $cat_query=mysqli_query($conn, $sql) or die("Query is failed of category.".mysqli_error($conn));
    if($cat_query) {
        $sql_post = "DELETE FROM post WHERE category ='{$cat_id}'";
        $post_query=mysqli_query($conn, $sql_post)  or die("Query is failed of category.".mysqli_error($conn));
        if($post_query)
        {
            echo '<script> window.location.href="category.php"</script>';  die();
        }
        else
        {
            echo "Deletion process is not successful:";
            die();
        }
    }

    mysqli_close($conn);

?>