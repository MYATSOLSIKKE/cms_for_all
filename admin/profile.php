<?php include "includes/admin_header.php";?>
<?php //show profile for specific user
  if(isset($_SESSION['username'])){
  	$username=$_SESSION['username'];
	$query="SELECT * FROM users WHERE username='{$username}' ";
	$select_user_profile_query=mysqli_query($connection,$query);
	while($row=mysqli_fetch_array($select_user_profile_query)){
	    $user_id=$row['user_id'];//[] htal ka db yk column name
			$username=$row['username'];
			$user_password=$row['user_password'];
			$user_firstname=$row['user_firstname'];
			$user_lastname=$row['user_lastname'];
			$user_email=$row['user_email'];
			$user_image=$row['user_image'];
			$user_role=$row['user_role'];

	}
  }

?>

<?php //update user profile
   if(isset($_POST['edit_user'])){

$user_firstname=$_POST['user_firstname'];
$user_lastname=$_POST['user_lastname'];
$user_role=$_POST['user_role'];
//$post_image=$_FILES['image']['name'];
//$post_image_temp=$_FILES['image']['tmp_name'];
$username=$_POST['username'];
$user_email=$_POST['user_email'];
$user_password=$_POST['user_password'];
//$post_date=date('d-m-y');

//move_uploaded_file($post_image_temp, "../images/$post_image");
         	$query="UPDATE users SET ";
			$query.="user_firstname='{$user_firstname}', ";//ashae ka table coulumn anout ka variable name
			$query.="user_lastname='{$user_lastname}', ";
			$query.="user_role='{$user_role}', ";
			$query.="username='{$username}', ";
			$query.="user_email='{$user_email}', ";
			$query.="user_password='{$user_password}' ";
		    $query.="WHERE username='{$username}'";


			$update_user=mysqli_query($connection,$query);
			confirmQuery($update_user);
   }
?>
    <div id="wrapper">
    <?php include "includes/admin_navigation.php";?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">

                      <h1 class="page-header">
                            Welcome to Admin Page
                            <small>By myatsusan</small>
                        </h1>


<form action="" method="post" enctype="multipart/form-data">


<div class="form-group">
<label for="user_firstname">User Firstname</label>
<input type="text" value="<?php echo $user_firstname;?>" class="form-control" name="user_firstname">
</div>

<div class="form-group">
<label for="user_lastname">User Lastname</label>
<input type="text" value="<?php echo $user_lastname;?>"class="form-control" name="user_lastname">
</div>

<!-- <div class="form-group">
<select name="user_role" id="">
<option><?php echo $user_role;?></option>
</select>
</div> -->

<div class="form-group">
<label for="username">Username</label>
<input type="text" value="<?php echo $username;?>"class="form-control" name="username">
</div>

<div class="form-group">
<label for="user_email">User Email</label>
<input type="email" value="<?php echo $user_email;?>" class="form-control" name="user_email">
</div>


<div class="form-group">
<label for="user_password">User password</label>
<input type="password" autocomplete="off" class="form-control" name="user_password">
</div>

<!--<div class="form-group">
<label for="post_image">Post Image</label>
<input type="file" name="image">
</div>
-->

<div class="form-group">
<input class="btn btn-primary" type="submit" name="edit_user" value="UPDATE">
</div>

</form>

 </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

   <?php include "includes/admin_footer.php"; ?>
