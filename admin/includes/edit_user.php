<?php

if(isset($_GET['u_id'])){
    
    $user_edit_id = $_GET['u_id'];
}

 $select_user_byId = "SELECT * FROM users WHERE user_id =:user_edit_id";
 $stmt_user_byId = $pdo->prepare($select_user_byId);
 $stmt_user_byId->bindParam(':user_edit_id',$user_edit_id,PDO::PARAM_INT);
 $stmt_user_byId->execute();

         while($row = $stmt_user_byId->fetch(PDO::FETCH_ASSOC)) {
              $user_id = $row['user_id'];
              $username = $row['username'];
              $user_password = $row['user_password'];
              $user_firstname = $row['user_firstname'];
              $user_lastname = $row['user_lastname'];
              $user_email = $row['user_email'];
              $user_image = $row['user_image'];
              $user_role = $row['user_role'];
         
        }

  if(isset($_POST['edit_user'])){

              $username = $_POST['username'];
              $user_password = $_POST['user_password'];
              $user_firstname = $_POST['user_firstname'];
              $user_lastname = $_POST['user_lastname'];
              $user_email = $_POST['user_email'];
              $user_image = $_POST['user_image'];
              $user_role = $_POST['user_role'];
        
                $sql_salt = "SELECT randSalt FROM users";
                $stmt_salt = $pdo->prepare($sql_salt);
                $stmt_salt->execute();
        
                $row = $stmt_salt->fetch(PDO::FETCH_ASSOC);
                     $saltPass = $row['randSalt'];
                $hash_password = crypt($user_password,$saltPass);
    
            move_uploaded_file($post_image_temp,"../images/$post_image");
      
           
            
            if(empty($post_image)){
                
                $empty_image = 'SELECT * FROM posts WHERE post_id = ?';
                 $stmt_empty_image = $pdo->prepare($empty_image);
                 $stmt_empty_image->execute([$post_edit_id]);
                
                 $row = $stmt_empty_image->fetch(PDO::FETCH_ASSOC);
                 $post_image = $row['post_image'];
                
                
            }
      
            $update_user = "UPDATE users SET username=?,user_firstname=?,user_lastname=?,user_email=?,user_role=?,user_password=? WHERE user_id=? ";
            $stmt_update_user = $pdo->prepare($update_user)->execute([$username,$user_firstname,$user_lastname,$user_email,$user_role,$hash_password, $user_edit_id]);
            //header('Location:users.php');
  }


?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <div class="form-group">
            <label for="post_author">Firstname</label>
            <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname ?>"/>
        </div>

        <div class="form-group">
            <label for="post_status">Lastname</label>
            <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname?>"/>
        </div>
        <div class="form-group">
            <select name='user_role' id='user_role' class="form-select" aria-label="Default select example">
           <option value='<?php echo $user_role ?>'><?php echo $user_role ?></option>
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
            <input type="text" class="form-control" name="username" value="<?php echo $username ?>"/>
        </div>

        <div class="form-group">
            <label for="post_tags">Email</label>
            <input type="text" class="form-control" name="user_email" value="<?php echo $user_email?>"/>
        </div>


        <div class="form-group">
            <label for="post_tags">Password</label>
            <input type="password" class="form-control" name="user_password" value="<?php echo $user_password?>"/>
        </div>

        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="edit_user" value="Edit User">
        </div>
</form>