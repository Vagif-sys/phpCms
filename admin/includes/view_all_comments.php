

<table class="table table-bordered table-hover">
<thead>
    <tr>
        <th>Id</th>
        <th>Author</th>
        <th>Comment</th>
        <th>Email</th>
        <th>Status</th>
        <th>In Response to</th>
        <th>Date</th>
        <th>Approve</th>
        <th>Unapprove</th>
        <th>Delete</th>
    </tr>
</thead>
<tbody>

    <?php

         $sql_comments = "SELECT * FROM comments";
         $stmt_comments = $pdo->prepare($sql_comments);
          $stmt_comments->execute();

         while($row = $stmt_comments->fetch(PDO::FETCH_ASSOC)) {
              $comment_id = $row['comment_id'];
              $comment_post_id = $row['comment_post_id'];
              $comment_author = $row['comment_author'];
              $comment_content = $row['comment_content'];
              $comment_email = $row['comment_email'];
              $comment_status = $row['comment_status'];
              $comment_date = $row['comment_date'];

              echo'<tr>';
                  echo"<td>$comment_id</td>";
                  echo"<td>$comment_author</td>";
                  echo"<td>$comment_content</td>";
                  
                
                      
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
            
                  
                 
                  
                  echo"<td>$comment_email</td>";
                  echo"<td>$comment_status</td>";
             
                  $post_titleToResponse = "SELECT * FROM posts WHERE post_id = ?";
                  $stmt_postToResponse = $pdo->prepare($post_titleToResponse);
                  $stmt_postToResponse->execute([$comment_post_id]);
             
                 while($row = $stmt_postToResponse->fetch(PDO::FETCH_ASSOC)){
                     $post_id = $row['post_id'];
                     $post_title = $row['post_title'];
                     
                      echo"<td><a href='../post.php?p_id={$post_id}'>$post_title</a></td>";
                 }
                      

             
             
                  echo"<td>$comment_date</td>";
                  echo"<td><a class='btn btn-success' href='comments.php?approve={$comment_id}'>Approve</a></td>";
                  echo"<td><a class='btn btn-danger' href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";
                  echo"<td><a class='btn btn-danger' href='comments.php?delete={$comment_id}'>Delete</a></td>";
             echo'</tr>';


        }


   ?>
</tbody>
</table>

<?php 



 if(isset($_GET['approve'])){

      $approve_comment_id = $_GET['approve'];

      $sql_approve = "UPDATE comments SET comment_status = 'approve' WHERE comment_id =:approve_comment_id";
      $stmt_approve = $pdo->prepare($sql_approve);
      $stmt_approve->bindParam(':approve_comment_id',$approve_comment_id,PDO::PARAM_INT);
      $stmt_approve->execute();
      header('Location:comments.php');


  } 



 if(isset($_GET['unapprove'])){

      $unapprove_comment_id = $_GET['unapprove'];

      $sql_unApprove = "UPDATE comments SET comment_status = 'unapprove' WHERE comment_id =:unapprove_comment_id";
      $stmt_unApprove = $pdo->prepare($sql_unApprove);
      $stmt_unApprove->bindParam(':unapprove_comment_id',$unapprove_comment_id,PDO::PARAM_INT);
      $stmt_unApprove->execute();
      header('Location:comments.php');


  } 


 if(isset($_GET['delete'])){

      $delete_comment_id = $_GET['delete'];

      $sql_comment_item = 'DELETE FROM comments WHERE comment_id=:delete_comment_id';
      $delete_comment_stmt = $pdo->prepare($sql_comment_item);
      $delete_comment_stmt->bindParam(':delete_comment_id',$delete_comment_id,PDO::PARAM_INT);
      $delete_comment_stmt->execute();
      header('Location:comments.php');


  } 

?>