
<?php
  if(ifItIsMethod('post')){

      if(isset($_POST['login'])){

        if(isset($_POST['username']) && isset($_POST['password'])){

            login_user($_POST['username'], $_POST['password']);

          }else {
            redirect('index');
                }
              }

    }

?>
<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">

  <!-- Blog Search Well -->
                <div class="well">
                  <h4>Blog Search</h4>
                   <form action="search.php" method="post">
                   <div class="input-group">
                        <input name="search" type="text" class="form-control">
                        <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form><!--search form-->
                    <!-- /.input-group -->
                </div>


   <!-- Login -->
        <div class="well">
        <?php //log in pee yin log out fo
        if(isset($_SESSION['user_role'])):?>

         <h4>Login as <span style='color:magenta'><?php echo $_SESSION['username'];?></span></h4>
         <a href="/NewCMS/includes/logout.php" class="btn btn-primary">Logout</a>


          <?php else:?>
          <h4>Log in</h4>
         <div class="form-group">
          <form action="" method="post">
          <input name="username" type="text" class="form-control" placeholder="Enter Username">
          </div>

         <div class="input-group">
          <input name="password" type="password" class="form-control" placeholder="Enter Password">
          <span class="input-group-btn">
           <button name="login" class="btn btn-primary" type="submit">
           Submit</button>
           </span>
          </div>

          <div class="form-group">
            <a href="forgot.php?forgot=<?php echo uniqid(true);?>">Forgot Password</a>
          </div>
          </form><!--search form-->
                    <!-- /.input-group -->
          <?php endif;?>
          </div>

          <!-- Blog Categories Well -->
          <div class="well">
        	<?php
        	$query="SELECT * FROM categories";//LIMIT 2 nk limit loh ya
					$select_categories_sidebar=mysqli_query($connection,$query);

    	    ?>
        <h4>Blog Categories</h4>
           <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
             <?php
            while($row=mysqli_fetch_assoc($select_categories_sidebar)){
            $cat_title=$row['cat_title'];
            $cat_id=$row['cat_id'];
			      echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
		             }//category ka get super global key
                         ?>
                      </ul>

                        </div>



                        <!-- /.col-lg-6
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                       /.col-lg-6 -->




                    </div>
                    <!-- /.row -->
                </div>

               <?php include "widget.php";?>
