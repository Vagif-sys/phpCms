<?php include "includes/admin_header.php"; ?>
<div id="wrapper">
     <!-- Navigation -->
        <?php include 'includes/admin_navigation.php' ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin Page   
                            <small>  <?php echo  $_SESSION['username'] ?></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                       
                <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                <?php
                                    
                                    $sql_count = $pdo->query('SELECT * FROM posts');
                                    $post_count = $sql_count->rowCount();
                                      echo "<div class='huge'>{$row_count}</div>"
                                 ?>
                             
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                   <?php
                                    
                                    $sql_count = $pdo->query('SELECT * FROM comments');
                                    $comment_count = $sql_count->rowCount();
                                      echo "<div class='huge'>{$row_count}</div>"
                                 ?>
                                  <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                  <?php
                                    
                                    $sql_count = $pdo->query('SELECT * FROM users');
                                    $user_count = $sql_count->rowCount();
                                      echo "<div class='huge'>{$row_count}</div>"
                                 ?>
                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                 <?php
                                    
                                    $sql_count = $pdo->query('SELECT * FROM categories');
                                    $cat_count = $sql_count->rowCount();
                                      echo "<div class='huge'>{$row_count}</div>"
                                 ?>
                                     <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
                <!-- /.row -->
                
             <?php 
                                          
                   $sql_draft_count = $pdo->query("SELECT * FROM posts WHERE post_status = 'draft'");
                   $post_count_draft = $sql_draft_count->rowCount();                    
                                          
             ?>
                
                <div class="row" >
                 <script type="text/javascript">
                      google.charts.load('current', {'packages':['bar']});
                      google.charts.setOnLoadCallback(drawChart);

                      function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                          ['Data', 'Count'],
                          
                           <?php 
                                          
                            $element_text = ['Active Posts','Draft','Categories','Users','Comments'];
    
                            $element_count = [$post_count,$post_count_draft,$user_count,$comment_count,$cat_count];
                             
                            
                            for($i=0; $i< 5 ; $i++){
                                
                                echo "['{$element_text[$i]}',{$element_count[$i]}],";
                            }
                                
                            //['Post', 1000],
                          ?>
                        ]);

                        var options = {
                          chart: {
                            title: '',
                            subtitle: '',
                          }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                      }
                    </script>
                   <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div></div>
                </div>
                
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php 

include 'includes/admin_footer.php' 

?>
