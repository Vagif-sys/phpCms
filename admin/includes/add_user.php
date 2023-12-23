<?php

if(isset($_POST['create_user'])){
    
            $user_firstname       = $_POST['user_firstname'];
            $user_lastname        = $_POST['user_lastname'];
    
//            $post_image          = $_FILES['image']['name'];
//            $post_image_temp     = $_FILES['image']['tmp_name'];
    
    
            $username          = $_POST['username'];
            $user_email       = $_POST['user_email'];
            $user_role       = $_POST['user_role'];
            $user_password       = $_POST['user_password'];
           
            //$post_comment_count = 4;
        
            
            //move_uploaded_file($post_image_temp,"../images/$post_image");
    
            $add_user_insert = "INSERT INTO users ( user_firstname, user_lastname, username,user_password,user_email,user_role) VALUES(?,?,?,?,?,?)";
            $stmt_add_user = $pdo->prepare($add_user_insert);
            $stmt_add_user->execute([$user_firstname,$user_lastname,$username,$user_password,$user_email,$user_role]);
    
    
            $newID = $pdo->lastInsertId ();
    
            
            echo '<div class="alert alert-success text-center" role="alert">
                  User added successfully
            </div>';
    
            header('Location:users.php')
           
}


?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <div class="form-group">
            <label for="post_author">Firstname</label>
            <input type="text" class="form-control" name="user_firstname" />
        </div>

        <div class="form-group">
            <label for="post_status">Lastname</label>
            <input type="text" class="form-control" name="user_lastname" />
        </div>
        <div class="form-group">
            <select name='user_role' id='user_role' class="form-select" aria-label="Default select example">
                <option value='subscriber'>Selected Option</option>
                <option value='admin'>Admin</option>
                <option value='subscriber'>Subscriber</option>

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
            <input type="text" class="form-control" name="username" />
        </div>

        <div class="form-group">
            <label for="post_tags">Username</label>
            <input type="text" class="form-control" name="user_email" />
        </div>


        <div class="form-group">
            <label for="post_tags">Password</label>
            <input type="text" class="form-control" name="user_password" />
        </div>

        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="create_user" value="Add Post">
        </div>
</form>