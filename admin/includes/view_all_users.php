

<table class="table table-bordered table-hover">
<thead>
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
         <th>Image</th>
        <th>Role</th>
        <th>Date</th>
        <th>Edit</th>
    </tr>
</thead>
<tbody>

    <?php

         $sql_users = "SELECT * FROM users";
         $stmt_users = $pdo->prepare($sql_users);
          $stmt_users->execute();

         while($row = $stmt_users->fetch(PDO::FETCH_ASSOC)) {
              $user_id = $row['user_id'];
              $username = $row['username'];
              $user_password = $row['user_password'];
              $user_firstname = $row['user_firstname'];
              $user_lastname = $row['user_lastname'];
              $user_email = $row['user_email'];
              $user_image = $row['user_image'];
              $user_role = $row['user_role'];
             
              echo'<tr>';
                  echo"<td>$user_id</td>";
                  echo"<td>$username</td>";
                  echo"<td>$user_firstname</td>";
                  
                
                      
//                    $related_category_item = "SELECT * FROM categories WHERE cat_id = ?";
//                    $stmt_related_category_item = $pdo->prepare($related_category_item);
//                    $stmt_related_category_item->execute([$post_category_id]);
//                    
//                    while($row = $stmt_related_category_item->fetch(PDO::FETCH_ASSOC)){
//                        $cat_id = $row['cat_id'];
//                        $cat_title = $row['cat_title'];
//                        
//                         echo"<td>$cat_title</td>";
//                             
//                    }
            
                  
                 
                  
                  echo"<td>$user_lastname</td>";
                  echo"<td>$user_email</td>";
                  echo"<td>$user_image</td>";
                  echo"<td>$user_role</td>";
               
//                  $post_titleToResponse = "SELECT * FROM posts WHERE post_id = ?";
//                  $stmt_postToResponse = $pdo->prepare($post_titleToResponse);
//                  $stmt_postToResponse->execute([$comment_post_id]);
//             
//                 while($row = $stmt_postToResponse->fetch(PDO::FETCH_ASSOC)){
//                     $post_id = $row['post_id'];
//                     $post_title = $row['post_title'];
//                     
//                      echo"<td><a href='../post.php?p_id={$post_id}'>$post_title</a></td>";
//                 }
//                      

             
             
                  echo"<td></td>";
                  echo"<td><a class='btn btn-success' href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
                  echo"<td><a class='btn btn-danger' href='users.php?change_to_sub={$user_id}'>Subscriber</a></td>";
                    echo"<td><a class='btn btn-success' href='users.php?source=edit_user&u_id={$user_id}')>Edit</a></td>";
                  echo"<td><a class='btn btn-danger' href='users.php?delete={$user_id}')>Delete</a></td>";
             echo'</tr>';


        }


   ?>
</tbody>
</table>

<?php 



 if(isset($_GET['change_to_admin'])){

      $user_role_id = $_GET['change_to_admin'];

      $sql_role = "UPDATE users SET user_role = 'admin' WHERE user_id =:user_role_id";
      $stmt_role = $pdo->prepare($sql_role);
      $stmt_role->bindParam(':user_role_id',$user_role_id,PDO::PARAM_INT);
      $stmt_role->execute();
      header('Location:users.php');


  } 




 if(isset($_GET['change_to_sub'])){

      $user_sub_role_id = $_GET['change_to_sub'];

      $sql_role_sub = "UPDATE users SET user_role = 'subscriber' WHERE user_id =:user_sub_role_id";
      $stmt_role_sub = $pdo->prepare($sql_role_sub);
      $stmt_role_sub->bindParam(':user_sub_role_id',$user_sub_role_id,PDO::PARAM_INT);
      $stmt_role_sub->execute();
      header('Location:users.php');


  }


 if(isset($_GET['delete'])){

      $delete_user_id = $_GET['delete'];

      $sql_user_item = 'DELETE FROM users WHERE user_id=:delete_user_id';
      $delete_user_stmt = $pdo->prepare($sql_user_item);
      $delete_user_stmt->bindParam(':delete_user_id',$delete_user_id,PDO::PARAM_INT);
      $delete_user_stmt->execute();
      header('Location:users.php');


  } 

?>