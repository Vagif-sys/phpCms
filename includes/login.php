<?php
ob_start();
session_start() ?>
<?php include 'db.php' ?>


<?php
    
if(isset($_POST['login'])){
    
  $username = $_POST['username'];
   $password = $_POST['password'];
    
    
   $sql_login = "SELECT * FROM users WHERE  username = ?";
   $stmt_login = $pdo->prepare($sql_login);
   $stmt_login->execute([$username]);
    
    


while($row = $stmt_login->fetch(PDO::FETCH_ASSOC)){
        
            $db_user_id = $row['user_id'];
            $db_username = $row['username'];
            $db_user_password = $row['user_password'];
            $db_user_firstname = $row['user_firstname'];
            $db_user_lastname = $row['user_lastname'];
            $db_user_role = $row['user_role'];
}
    
 $user_password = crypt($user_password,$db_user_password);

if($username === $db_username && $password === $db_user_password){
    
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;

        header('Location: ../admin');
    }else{

        header('Location: ../index.php');
    }
}
?>