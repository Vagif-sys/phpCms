<?php

if(isset($_GET['p_id'])){
    
    $post_edit_id = $_GET['p_id'];
}

 $select_posts_byId = "SELECT * FROM posts WHERE post_id =:post_edit_id";
 $stmt_posts_byId = $pdo->prepare($select_posts_byId);
 $stmt_posts_byId->bindParam(':post_edit_id',$post_edit_id,PDO::PARAM_INT);
 $stmt_posts_byId->execute();

         while($row = $stmt_posts_byId->fetch(PDO::FETCH_ASSOC)) {
              $post_author = $row['post_author'];
              $post_title = $row['post_title'];
              $post_category_id = $row['post_category_id'];
              $post_status = $row['post_status'];
              $post_image = $row['post_image'];
              $post_content = $row['post_content'];
              $post_tags = $row['post_tags'];
              $post_comment_count = $row['post_comment_count'];
              $post_date = $row['post_date'];
           
}


  if(isset($_POST['create_post'])){
      
            $post_title          = $_POST['post_title'];
            $post_author         = $_POST['post_author'];
            $post_category_id    = $_POST['post_category'];
            $post_status         = $_POST['post_status'];
    
            $post_image          = $_FILES['image']['name'];
            $post_image_temp     = $_FILES['image']['tmp_name'];
            $post_date           = date("Y-m-d H:i:s");
    
            $post_tags           = $_POST['post_tags'];
            $post_content        = $_POST['post_content'];
        
          
    
            move_uploaded_file($post_image_temp,"../images/$post_image");
            
            if(empty($post_image)){
                
                $empty_image = 'SELECT * FROM posts WHERE post_id = ?';
                 $stmt_empty_image = $pdo->prepare($empty_image);
                 $stmt_empty_image->execute([$post_edit_id]);
                
                 while($row = $stmt_empty_image->fetch(PDO::FETCH_ASSOC)){
                      $post_image = $row['post_image'];
                 }
                
            }
      
            $update_post = "UPDATE posts SET post_category_id=?,post_title=?,post_author=?,post_date=?,post_image=?,post_content=?,post_tags=?,post_status=? WHERE post_id=? ";
            $a = $pdo->prepare($update_post)->execute([$post_category_id,$post_title, $post_author,$post_date,$post_image,$post_content,$post_tags,$post_status,$post_edit_id]);
             
             ?>
            <script>
            window.setTimeout(function() {
                window.location = 'posts.php';
              }, 5000);
            </script>
<?php
            echo '<div class="alert alert-success text-center" role="alert">
                      Post updated successfully
                 </div>';
        
            
  }?>





<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="post_title">Post title</label>
    <input type="text" class="form-control" name="post_title" value="<?php echo $post_title; ?>"/>
  </div>
 
  <div class="form-group">
    <select name='post_category' id='post_category'>
    <?php
  
            $select_category = "SELECT * FROM categories";
             $stmt_select_category = $pdo->prepare($select_category);
             $stmt_select_category->execute();

             while($row = $stmt_select_category->fetch(PDO::FETCH_ASSOC)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                 echo "<option value='{$cat_id}'>{$cat_title}</option>";
             }
         
     ?> 
    
    </select>
  </div>
 
  <div class="form-group">
    <label for="post_author">Post Author</label>
    <input type="text" class="form-control" name="post_author"  value="<?php echo $post_author; ?>"/>
  </div>
 
  <div class="form-group">
      <select name='post_status'>
          <option value='<?php echo $post_status;?>'><?php echo $post_status; ?></option>
          if($post_status == 'published'){
             echo '<option value="darft">draft</option>'
          }else{
             echo '<option value="published">published</option>'
          }
      
      </select>
  </div>
 
  <div class="form-group">
    <img src='../images/<?php echo $post_image?>' width='100'/>
    <input type='file' name="image"/>
  </div>
 
  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="post_tags"  value="<?php echo $post_tags; ?>"/>
  </div>
 
  <div class="form-group">
    <label for="summernote">Post Content</label>
      <textarea class="form-control" name="post_content" id="summernote" rows="10" cols="30">
    
       <?php echo $post_content; ?>                                                                          
    </textarea>
    </div>
 
    <div class="form-group">
      <input class="btn btn-primary" type="submit" name="create_post" value="Add Post">
    </div>
</form>