<?php

if(isset($_POST['create_post'])){
    
            $post_title          = $_POST['post_title'];
            $post_author         = $_POST['post_author'];
            $post_category_id    = $_POST['post_category'];
            $post_status         = $_POST['post_status'];
    
            $post_image          = $_FILES['image']['name'];
            $post_image_temp     = $_FILES['image']['tmp_name'];
    
    
            $post_tags           = $_POST['post_tags'];
            $post_content        = $_POST['post_content'];
            $post_date           = date('Y-m-d H:i:s');
            //$post_comment_count = 4;
        
            
            move_uploaded_file($post_image_temp,"../images/$post_image");
    
            $add_post_insert = "INSERT INTO posts (post_category_id, post_title, post_author, post_date,post_image,post_content,post_tags,post_status) VALUES(?,?,?,?,?,?,?,?)";
            $stmt_add_post = $pdo->prepare($add_post_insert);
            $stmt_add_post->execute([$post_category_id,$post_title,$post_author,$post_date,$post_image,$post_content,$post_tags,$post_status]);
    
    
            $newID = $pdo->lastInsertId();
    ?>
            <script>
            window.setTimeout(function() {
                window.location = 'posts.php';
              }, 5000);
            </script>
<?php
            echo "<div class='alert alert-success text-center' role='alert'>
                  Post added successfully. You can check post here <a href='../posts.php?p_id={$newId}'>View Post</a> Wait...
            </div>";
          
}?>





<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="post_title">Post title</label>
    <input type="text" class="form-control" name="post_title" />
  </div>
 
    <div class="form-group">
    <select name='post_category' id='post_category' class="form-control" aria-label="Default select example">
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
    <input type="text" class="form-control" name="post_author" />
  </div>
 
  <div class="form-group">
      <select name='post_status' id='' class="form-control">     
          <option value='draft'>Post Status</option>
          <option value='published'>Published</option>
          <option value='draft'>Draft</option>
      </select>
  </div>
 
  <div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file" name="image" />
  </div>
 
  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="post_tags" />
  </div>
 
  <div class="form-group">
    <label for="summernote">Post Content</label>
      <textarea class="form-control" name="post_content" id="summernote" rows="10" cols="30"></textarea>
    </div>
 
    <div class="form-group">
      <input class="btn btn-primary" type="submit" name="create_post" value="Add Post">
    </div>
</form>