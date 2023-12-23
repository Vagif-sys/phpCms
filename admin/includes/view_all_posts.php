<?php

   if(isset($_POST['checkBoxArray'])){
       
       
       foreach($_POST['checkBoxArray'] as $postValueId){
            
          $bulkOptions = $_POST['bulk_options'];
           
          switch($bulkOptions){
          case 'published':
              $updated = "UPDATE posts SET post_status = ? WHERE post_id = ?";
              $stmt_updated = $pdo->prepare($updated);
              $stmt_updated->execute([$bulkOptions,$postValueId]);
              break ; 
                  
            case 'draft':
              $updated = "UPDATE posts SET post_status = ? WHERE post_id = ?";
              $stmt_updated = $pdo->prepare($updated);
              $stmt_updated->execute([$bulkOptions,$postValueId]);
               break;  
            case 'delete':
              $deleted = "DELETE FROM posts WHERE post_id = ?";
              $stmt_deleted = $pdo->prepare($deleted);
              $stmt_deleted->execute([$postValueId]);
              break;
          
          }
           
           
         
       }
   }
?>



<form action="" method="post">
    <table class="table table-bordered table-hover">
        
        
      <div id="bulkContainer" class="col-xs-4">

         <select name='bulk_options' id="" class="form-control">
             <option value="select">Select Options</option>
              <option value="published">Published</option>
              <option value="draft">Draft</option>
              <option value="delete">Delete</option>
          </select>       
       </div>
     <div class="col-xs-4">
        <input type='submit' name='submit' class='btn btn-success' value='Apply'/>
        <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
     </div>
    <thead>
        <tr>
             <th><input type='checkbox' id="selectAllBoxes" name='selectedAllBoxes'></th>
            <th>Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>View Post</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>

        <?php

             $select_posts = $pdo->query("SELECT * FROM posts");
              $select_posts->execute();

             while($row = $select_posts->fetch(PDO::FETCH_ASSOC)) {
                  $post_id = $row['post_id'];
                  $post_author = $row['post_author'];
                  $post_title = $row['post_title'];
                  $post_category_id = $row['post_category_id'];
                  $post_status = $row['post_status'];
                  $post_image = $row['post_image'];
                  $post_tags = $row['post_tags'];
                  $post_comment_count = $row['post_comment_count'];
                  $post_date = $row['post_date'];

                  echo'<tr>';
                     ?>
                   
                      <td><input class='checkBoxes' id='selectAllBoxes' name='checkBoxArray[]' type='checkbox' value="<?php echo $post_id; ?>"></td>;
                     <?php
                      echo"<td>$post_id</td>";
                      echo"<td>$post_author</td>";
                      echo"<td>$post_title</td>";



                        $related_category_item = "SELECT * FROM categories WHERE cat_id = ?";
                        $stmt_related_category_item = $pdo->prepare($related_category_item);
                        $stmt_related_category_item->execute([$post_category_id]);

                        while($row = $stmt_related_category_item->fetch(PDO::FETCH_ASSOC)){
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];

                        }


                     echo"<td>$cat_title</td>";


                 echo"<td>$post_status</td>";
                      echo"<td><img width='100' src='../images/$post_image' alt='image'></td>";
                      echo"<td>$post_tags</td>";
                      echo"<td>$post_comment_count</td>";
                      echo"<td>$post_date</td>";
                     echo"<td><a class='btn btn-primary' href='../post.php?p_id={$post_id}'>View Post</a></td>";
                      echo"<td><a class='btn btn-danger' href='posts.php?delete={$post_id}' onClick=\"javascript: return confirm('Are you sure you to delete this post') \">Delete</a></td>";
                      echo"<td><a class='btn btn-success' href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                 echo'</tr>';


            }


       ?>
    </tbody>
    </table>
</form>
<?php 


 if(isset($_GET['delete'])){

      $delete_post_id = $_GET['delete'];

      $sql_delete_post = 'DELETE FROM posts WHERE post_id=:delete_post_id';
      $delete_post_stmt = $pdo->prepare($sql_delete_post);
      $delete_post_stmt->bindParam(':delete_post_id',$delete_post_id,PDO::PARAM_INT);
      $delete_post_stmt->execute();
      header('Location:posts.php');


  } 

?>