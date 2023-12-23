<form method='POST' action=''>
    <div class='form-group'>
        <label for='cat-title'>Edit Category</label>
        <?php
             // editing the item
             if(isset($_GET['edit'])){

                $edit_cat_id = $_GET['edit'];


             $select_category_id ="SELECT cat_id,cat_title FROM categories WHERE cat_id = :edit_cat_id";
             $stmt_id = $pdo->prepare($select_category_id);
             $stmt_id->bindParam(':edit_cat_id',$edit_cat_id,PDO::PARAM_INT);

             $stmt_id->execute();

             while($row = $stmt_id->fetch(PDO::FETCH_ASSOC) ){
                     $cat_id = $row['cat_id'];
                     $cat_title = $row['cat_title'];
             ?>  

           <input value="<?php if(isset($cat_title)){echo $cat_title;} ?>" type='text' name='cat_title'class='form-control'>

        <?php } }?>


        <?php 
         // update the item
            if(isset($_POST['update_category'])){

              $update_cat_title = $_POST['cat_title'];

              $sql_update_item = 'UPDATE categories SET cat_title=:update_cat_title  WHERE cat_id=:edit_cat_id';
              $update_stmt = $pdo->prepare($sql_update_item);
              $update_stmt->bindParam(':update_cat_title',$update_cat_title);
              $update_stmt->bindParam(':edit_cat_id',$cat_id,PDO::PARAM_INT);
              $update_stmt->execute();

          } 

        ?>

    </div>
    <div class='form-group'>
        <button type='submit' class='btn btn-primary'  name='update_category'>Edit A Category</button>
    </div>
<form>