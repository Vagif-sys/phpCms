<?php 

  include 'includes/db.php';
  include 'includes/header.php';
?>

<!-- Navigation -->
<?php include 'includes/navigation.php' ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

        <?php 
    
          if(isset($_GET['p_id'])){
              
              $post_id = $_GET['p_id'];
          }

            $post_id_catch = "SELECT * FROM posts WHERE post_id = ?";
            $post_id_catch = $pdo->prepare($post_id_catch);
            $post_id_catch->execute([$post_id]);
            while($row = $post_id_catch->fetch(PDO::FETCH_ASSOC)) {
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
                $post_comment_count = $row['post_comment_count'];
               


               ?>
             
            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <!-- First Blog Post -->
            <h2>
                <a href="#"><?php echo $post_title ?></a>
            </h2>
            <p class="lead">
                by <a href="index.php"><?php echo $post_author ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
            <hr>
            <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
            <hr>
            <p><?php echo $post_content ?></p>
            <hr>


          <?php  } ?>
            
            <?php 
             
                 if(isset($_POST['create_comment'])){
                     
                     
                     
                     $post_id = $_GET['p_id']; 
                     $comment_author = $_POST['comment_author'];
                     $comment_email  = $_POST['comment_email'];                    
                     $comment_content = $_POST['comment_content'];
                     $comment_date    = date('Y-m-d H:i:s');
                     
                       if(empty($comment_author)){
                             $error['comment_author'] = 'Author must not be blank';
                         }elseif(empty($comment_email)){
                              $error['comment_email'] = 'Email must not be blank';
                         }elseif(empty($comment_content)){
                              $error['comment_content'] = 'Content must not be blank';
                         
                     
                       }else{
                          
                         $sql_comment_insert = "INSERT INTO comments (comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date)VALUES(?,?,?,?,?,?)";
                     
                         $stmt_comment_insert = $pdo->prepare($sql_comment_insert);
                         $stmt_comment_insert->execute([$post_id,$comment_author,$comment_email,$comment_content,'approved',$comment_date]);

                          $comment_count = $post_comment_count + 1;
                          $post_comment_count = "UPDATE posts SET post_comment_count = ? WHERE post_id = ?";
                          $stmt_comment_count = $pdo->prepare($post_comment_count);
                          $stmt_comment_count->execute([$comment_count,$post_id]);
                         
                         
                     }
                   
                     
                 }
            
            ?>
                
                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="POST" action=''>
                        <label for='Author'>Author: </label>
                        <div class="form-group">
                           <input type='text' name='comment_author' class='form-control'/>
                            <p class='alert alert-danger errorComment'><?php echo $error['comment_author'] = 'Author must not be blank';?></p>
                        </div>
                         <label for='Email'>Email: </label>
                        <div class="form-group">            
                           <input type='email' name='comment_email' class='form-control' name='comment_name'/>
                        </div>
                        
                         <div class="form-group">
                           <label for='Message'>Your Comment: </label>
                           <textarea class='form-control' row='3' name="comment_content"></textarea>
                        </div>
                       
                        <button type="submit" class="btn btn-primary" name='create_comment'>Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
            
                 <?php
            
                     $sql_approved_comments = "SELECT * FROM comments WHERE comment_post_id=? AND comment_status='approved' ORDER BY comment_id DESC";
                      
                     $approved_comments = $pdo->prepare($sql_approved_comments);
                     $approved_comments->execute([$post_id]);
                     
                        while($row = $approved_comments->fetch(PDO::FETCH_ASSOC)){
                             $comment_date = $row['comment_date'];
                             $comment_content = $row['comment_content'];
                             $comment_author = $row['comment_author'];
                          ?>
                      
                            <!-- Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $comment_author ?>
                                    <small><?php echo $comment_date ?></small>
                                </h4>
                                <?php echo $comment_content ?>
                            </div>
                        </div>
                            
                       <?php } ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
         <?php include 'includes/sidebar.php'?>

    </div>
    <!-- /.row -->

    <hr>
<?php include('includes/footer.php') ?>
