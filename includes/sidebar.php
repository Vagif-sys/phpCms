<div class="col-md-4">

            <!-- Blog Search Well -->
            <div class="well">
                <h4>Blog Search</h4>
                <form method='POST'  action='search.php'>
                    <div class="input-group">
                        <input type="text" name='search' class="form-control">
                        <span class="input-group-btn">
                            <button name='submit' class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div>
                </form>
                <!-- /.input-group -->
            </div>
    
    
              <!-- Blog Search Well -->
            <div class="well">
                <h4>Login</h4>
                <form method='POST'  action='includes/login.php'>
                    <div class="form-group">
                        <input type="text" name='username' class="form-control" placeholder='Enter Login'>
                    </div>
                    <div class="form-group">
                        <input type="password" name='password' class="form-control" placeholder="Enter Password">
                    </div>
                    <div class='d-grid'>
                       <button type='submit' class='btn btn-primary' name='login'>Login</button>
                    </div>
                    <div class="d-grid regBtn">
                      <a href="registration.php">Registration </a>               
                    </div>
                   
                </form>
                <!-- /.input-group -->
            </div>

            <!-- Blog Categories Well -->
            <div class="well">

            <?php
             
             $sidebar_cat_query = $pdo->query("SELECT * FROM categories");
             $sidebar_cat_query->execute();
           
             
             ?>
                <h4>Blog Categories</h4>
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="list-unstyled">

                        <?php
                             while($row = $sidebar_cat_query->fetch(PDO::FETCH_ASSOC)) {
                                $cat_title = $row['cat_title'];
                                $cat_id = $row['cat_id'];
                                 echo "<li><a href='category.php?category=$cat_id'>$cat_title</a></li>";
                            }
                        ?>
                         
                        </ul>
                    </div>
                </div>
                <!-- /.row -->
            </div>

            <!-- Side Widget Well -->
           <?php  include 'widget.php' ?>

        </div>