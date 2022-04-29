<?php if (session_status() == PHP_SESSION_NONE) {
   session_start();
}?>
 <?php  require_once("admin/function.php"); ?>
 <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
            </button>
                <a class="navbar-brand" href="/NewCMS/index">CMS Front</a>
            </div>


            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

        	<?php
        	$query="SELECT * FROM categories";
					$select_all_categories_query=mysqli_query($connection,$query);
  				while($row=mysqli_fetch_assoc($select_all_categories_query)){
					$cat_title=$row['cat_title'];
          $cat_id=$row['cat_id'];

         //active for each link
         $category_class='';
         $registration_class='';
         $contact_class='';
         $pageName=basename($_SERVER['PHP_SELF']);
         $registration='registration.php';
         $contact='contact.php';
         if(isset($_GET['category'])  &&  $_GET['category']==$cat_id){
           $category_class='active';

         }
         else if($pageName==$registration){
           $registration_class='active';
         }
         else if($pageName==$contact){
           $contact_class=='active';
         }
				echo "<li class='$category_class'><a href='/NewCMS/category/{$cat_id}'>{$cat_title}</a></li>";
			}
      	?>

        <?php if(isLoggedIn()): ?>
            <?php if (is_admin()):?>
  						<li><a href="/NewCMS/admin">Admin</a></li>
            <?php endif ?>
  						<li><a href="/NewCMS/includes/logout.php">Logout</a></li>

  			<?php else: ?>

  						<li><a href="/NewCMS/login.php">Login</a></li>
  					<?php endif; ?>

          <?php echo "<li class='$registration_class'>
              <a href='/NewCMS/registration'>Registration</a>
          </li>
          <li class='$contact_class'>
              <a href='/NewCMS/contact'>Contact</a>
          </li>";
          ?>


     <?php
     if(isset($_SESSION['user_role'])){
       if(isset($_GET['p_id'])){//it's important to get post id
         $edit_post_id=$_GET['p_id'];
         echo "<li><a href='/NewCMS/admin/posts.php?source=edit_post&p_id={$edit_post_id}'>Edit Post</a></li>";//apw ka ny out ko twr
       }
     }
     ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
