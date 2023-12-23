<?php include 'includes/admin_header.php'; ?>

<?php 

   if(isset($_SESSION['username'])){
       
       $username = $_SESSION['username'];
       
       
       $profile_session = "SELECT * FROM users WHERE username = ?";
       $stmt_profile_session = $pdo->prepare($profile_session);
       $stmt_profile_session->execute([$username]);
       
       
       while($row = $stmt_profile_session->fetch(PDO::FETCH_ASSOC)){
              $user_id = $row['user_id'];
              $username = $row['username'];
              $user_password = $row['user_password'];
              $user_firstname = $row['user_firstname'];
              $user_lastname = $row['user_lastname'];
              $user_email = $row['user_email'];
              $user_image = $row['user_image'];
              $user_role = $row['user_role'];
       }
   }

?>


<?php 

   if(isset($_POST['update_profile'])){
       
              $username = $_POST['username'];
              $user_password = $_POST['user_password'];
              $user_firstname = $_POST['user_firstname'];
              $user_lastname = $_POST['user_lastname'];
              $user_email = $_POST['user_email'];
              $user_image = $_POST['user_image'];
              $user_role = $_POST['user_role'];
        
          
    
            move_uploaded_file($post_image_temp,"../images/$post_image");
            
            if(empty($post_image)){
                
                $empty_image = 'SELECT * FROM posts WHERE post_id = ?';
                 $stmt_empty_image = $pdo->prepare($empty_image);
                 $stmt_empty_image->execute([$post_edit_id]);
                
                 while($row = $stmt_empty_image->fetch(PDO::FETCH_ASSOC)){
                      $post_image = $row['post_image'];
                 }
                
            }
      
            $update_profile = "UPDATE users SET username=?,user_firstname=?,user_lastname=?,user_email=?,user_role=?,user_password=? WHERE username=? ";
            $stmt_profile_user = $pdo->prepare($update_profile)->execute([$username,$user_firstname,$user_lastname,$user_email,$user_role,$user_password, $username]);
            header('Location:users.php');
   }

?>


<div id="wrapper">

    <!-- Navigation -->
    <?php include 'includes/admin_navigation.php' ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin Page
                        <small>Author</small>
                    </h1>


                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <div class="form-group">
                                <label for="post_author">Firstname</label>
                                <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname ?>" />
                            </div>

                            <div class="form-group">
                                <label for="post_status">Lastname</label>
                                <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname?>" />
                            </div>
                            <div class="form-group">
                                <select name='user_role' id='user_role' class="form-select" aria-label="Default select example">
                                    <option value='subscriber'><?php echo $user_role ?></option>
                                    <?php
    
                                        if($user_role == 'admin'){
                                           echo  "<option value='subscriber'>Subscriber</option>";
                                        }else{
                                           echo "<option value='admin'>Admin</option>";
                                        }


                                      ?>

                                </select>
                            </div>


                             <!--

                          <div class="form-group">
                            <label for="post_image">Post Image</label>
                            <input type="file" name="image" />
                          </div>
                          -->

                            <div class="form-group">
                                <label for="post_tags">Username</label>
                                <input type="text" class="form-control" name="username" value="<?php echo $username ?>" />
                            </div>

                            <div class="form-group">
                                <label for="post_tags">Email</label>
                                <input type="text" class="form-control" name="user_email" value="<?php echo $user_email?>" />
                            </div>


                            <div class="form-group">
                                <label for="post_tags">Password</label>
                                <input type="password" class="form-control" name="user_password" value="<?php echo $user_password?>" />
                            </div>

                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="update_profile" value="Update Profile">
                            </div>
                    </form>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php 

            include 'includes/admin_footer.php' 

            ?>
