<?php  include "includes/header.php"; ?>

<?php


if(isset($_POST['submit'])){
    
   $username = $_POST['username'];
   $user_email    = $_POST['email'];
   $user_password = $_POST['password'];
   $user_role = 'subscriber';
    
    
    if(!empty($username) && !empty($user_email) && !empty($user_password) && !empty($user_role)){
        
        $sql_salt = "SELECT randSalt FROM users";
        $stmt_salt = $pdo->prepare($sql_salt);
        $stmt_salt->execute();
        
        $row = $stmt_salt->fetch(PDO::FETCH_ASSOC);
             $saltPass = $row['randSalt'];
        $user_password = crypt($user_password,$saltPass);

             $add_reg_insert = "INSERT INTO users (username,user_password,user_email,user_role) VALUES(?,?,?,?)";
            $stmt_reg_insert = $pdo->prepare($add_reg_insert);
            $stmt_reg_insert->execute([$username,$user_password,$user_email, $user_role]);


            $message =  "Registration completed successfully!";
    }else{

        $message =  "Fields cant not be blank";
    }

}

?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <h6 class="text-center"><?php echo $message ?></h6>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
