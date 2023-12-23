<?php include 'includes/db.php';?>;
<?php include 'includes/header.php';?>

<!-- Navigation -->
<?php include 'includes/navigation.php' ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

        <?php 
    
           if(isset($_GET['category'])){
               
               $category_side_id = $_GET['category'];
           }

            $sql = "SELECT * FROM posts WHERE post_category_id = ?";
            $stmt_side_catch_id = $pdo->prepare($sql);
            $stmt_side_catch_id->execute([$category_side_id]);
                
            while($row = $stmt_side_catch_id->fetch(PDO::FETCH_ASSOC)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                if(strlen($post_content >= 50)){
                    $post_content = substr($post_content, 0, strrpos($post_content, ' ')) ."...";
                }else{
                   $post_content = $post_content ."..."; 
                }
               
            ?>



             
            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <!-- First Blog Post -->
            <h2>
                <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
            </h2>
            <p class="lead">
                by <a href="index.php"><?php echo $post_author ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
            <hr>
            <a href="post.php?p_id=<?php echo $post_id ?>"> 
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
             <a/>
            <hr>
            <p><?php echo $post_content ?></p>
            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>


          <?php  }?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
         <?php include 'includes/sidebar.php'?>

    </div>
    <!-- /.row -->

    <hr>
<?php include('includes/footer.php') ?>
