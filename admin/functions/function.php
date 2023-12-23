<?php


function insert_cat(){
    global $pdo; 
    if(isset($_POST['submit'])){

        $cat_title = $_POST['cat_title'];
       var_dump($cat_title);

        if($cat_title == ''|| empty($cat_title)){
            echo "This field should not be blank";
        }else{

        $sql = 'INSERT INTO categories(cat_title) VALUES(:cat_title)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':cat_title' => $cat_title]);

        $category_id = $pdo->lastInsertId();
       }
    }
    
}

function findAllCategories(){
    
    global $pdo;   
    $select_category = $pdo->query("SELECT * FROM categories");
      $select_category->execute();

     while($row = $select_category->fetch(PDO::FETCH_ASSOC)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

         echo "<tr>";
         echo "<td>{$cat_id}</td>";
         echo "<td>{$cat_title}</td>";
         echo "<td><a class='btn btn-danger' href='categories.php?delete={$cat_id}'>Delete</a></td>";
          echo "<td><a class='btn btn-success'href='categories.php?edit={$cat_id}'>Edit</a></td>";
         echo "</tr>";
    }
}


function deleteCategories(){
    global $pdo;
    if(isset($_GET['delete'])){

      $delete_cat_id = $_GET['delete'];

      $sql_delete_item = 'DELETE FROM categories WHERE cat_id=:delete_cat_id';
      $delete_stmt = $pdo->prepare($sql_delete_item);
      $delete_stmt->bindParam(':delete_cat_id',$delete_cat_id,PDO::PARAM_INT);
      $delete_stmt->execute();
      header('Location:categories.php');


  } 
}

?>