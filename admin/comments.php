<?php 
ob_start();
include 'includes/admin_header.php'; 
include '../includes/db.php';
include 'functions/function.php';
ob_start();
?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include 'includes/admin_navigation.php' ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin Page
                        <small>Author</small>
                    </h1>
                <?php
                if(isset($_GET['source'])){
                   $source = $_GET['source'];   
                }
                    
                switch($source){
                   
                   case 'add_post';
                   include 'includes/add_post.php';
                        
                   break;
                    
                   case 'edit_post.php';
                    include 'includes/edit_post.php';
                   break;
                    
                   case '200';
                    echo '200';
                   break;
                    
                   default:
                    
                   include 'includes/view_all_comments.php';
                        
                   break;
                   
                }
    
              ?>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php 

            include 'includes/admin_footer.php' 

            ?>
