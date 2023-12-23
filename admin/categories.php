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

                    <div class='col-xs-6'>

                        <?php insert_cat() ?>

                        <form method='POST' action=''>
                            <div class='form-group'>
                                <label for='cat-title'>Category Title</label>
                                <input type='text' name='cat_title' class='form-control'>
                            </div>
                            <div class='form-group'>
                                <button type='submit' class='btn btn-primary' name='submit'>Add A Category</button>
                            </div>
                            <form>

                                <?php
                            
                            if(isset($_GET['edit'])){
                                
                                $cat_id = $_GET['edit'];   
                                    
                            include 'includes/update_categories.php'; 
                             
                            }
                            
                         ?>

                    </div>

                    <div class='col-xs-6'>
                        <table class='table table-bordered table-hover'>
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                 // Find all categories query
                                 
                                   findAllCategories()
                                
                                ?>
                                <?php 
                                  // DELETE Categories
                                
                                  deleteCategories()
                              ?>
                            </tbody>
                        </table>
                    </div>
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
