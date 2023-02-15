<?php include "header.php";
 error_reporting(true);
 $limit=5;
if(isset($_GET['id']))
{
    $page_id=$_GET['id'];
}
else{
  $page_id=1;
}
$offset=($page_id-1)*$limit;
 $sql="SELECT * FROM `category` ORDER BY category_id DESC LIMIT  {$offset},{$limit} ";
 $result=mysqli_query($conn,$sql) or die("Query is failed:".mysqli_error($conn));

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <?php 
                     if(mysqli_num_rows($result)>0)
                     {
                         $i;?>
                    <tbody>
                        <?php while($row=mysqli_fetch_assoc($result))
                        {
                            $i++;
                            ?>
                        <tr>
                            <td class='id'><?php echo $i; ?></td>
                            <td><?php echo $row['category_name']; ?></td>
                            <td><?php echo $row['post']; ?></td>
                            <td class='edit'><a href='update-category.php?id=<?php echo $row['category_id']; ?> '><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php?id=<?php echo $row['category_id']; ?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                       <?php }?>
                    </tbody>
                    <?php } ?>
                </table>
                <!-- this is code of pagination; -->
                <?php
                //   select all record in user table;
                     $pag_sql="SELECT * from category";
                     $pag_query=mysqli_query($conn,$pag_sql);
                     if(mysqli_num_rows($pag_query)>0)
                     {
                         $total_record=mysqli_num_rows($pag_query);
                        
                        // how many creates totals page according to pagniations;
                         $total_page=ceil($total_record/$limit);
                         echo  "<ul class='pagination admin-pagination'>";
                         //previous  button code here
                         if($page_id>1)
                         {
                            $user_id=$page_id-1;
                            echo " <li class='active'><a href='category.php?id=$user_id'>Prev</a></li>";
                         }
                        //  overall pagniations of users
                         for($i=1; $i<= $total_page; $i++)
                         {
                           echo " <li class='active' ><a href='category.php?id=$i'>".$i."</a></li>";
                       }

                       //next page button code here
                                if($total_page>$page_id)
                                {
                                    $next_id=$page_id+1;
                                echo " <li class='active'><a href='category.php?id=$next_id'>Next</a></li>";
                                }
                         echo " </ul>";
                     }
                  ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php";
   mysqli_close($conn);
?>
