<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- post-container -->
                    <div class="post-container">
                        <?php
                        $limit=5;
                        if(isset($_GET['id']))
                        {
                           $page_id=$_GET['id'];
                        }
                        else{
                         $page_id=1;
                        }
                        $offset=($page_id-1)*$limit;
                       
                        $sql="SELECT post.post_id, post.title, post.description,post.post_date,post.author,
                        category.category_name, category.category_id,user.username,post.category,post.post_img FROM post
                        LEFT JOIN category ON post.category = category.category_id 
                        LEFT JOIN user ON post.author = user.user_id ORDER BY post.post_id DESC LIMIT  {$offset},{$limit}";
                        $result=mysqli_query($conn,$sql) or die("Query is failed:".mysqli_error($conn));
                       
                          if(mysqli_num_rows($result)>0)
                          {
                           while($row=mysqli_fetch_assoc($result)) 
                          {  ?>
                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?id=<?php echo $row['post_id'];?>"><img src="<?php echo 'admin/images/'.$row['post_img'];?>" alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?id=<?php echo $row['post_id'];?>'><?php echo substr($row['title'],0,100);?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php?id=<?php echo $row['category_id'];?>'><?php echo $row['category_name']; ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                 <?php
                                                    if($row['author']=='1')
                                                    { 
                                                        echo  "<a href='author.php'>Admin</a>"; 
                                                    }
                                                    else
                                                    {
                                                    echo  "<a href='author.php'>User</a>"; 
                                                    }
                                                    ?>
                                               
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo $row['post_date']; ?>
                                            </span>
                                        </div>
                                        <p class="description">
                                        <?php echo substr($row['description'],0,200);;?>
                                        </p>
                                        <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id'];?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } }?>
                         <!-- this is code of pagination; -->
                   <?php
                //   select all record in user table;
                     $pag_sql="SELECT * from post";
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
                            echo " <li class='active'><a href='index.php?id=$user_id'>Prev</a></li>";
                         }
                        //  overall pagniations of users
                         for($i=1; $i<= $total_page; $i++)
                         {
                           echo " <li class='active' ><a href='index.php?id=$i'>".$i."</a></li>";
                       }

                       //next page button code here
                                if($total_page>$page_id)
                                {
                                    $next_id=$page_id+1;
                                echo " <li class='active'><a href='index.php?id=$next_id'>Next</a></li>";
                                }
                         echo " </ul>";
                     }
                  ?>
                    </div><!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
