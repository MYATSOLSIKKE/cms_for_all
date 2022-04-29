    <table class="table table-bordered table-hover" >
                        	<thead>
                        		<tr>
                        			<th>ID</th>
                        			<th>Username</th>
                        			<th>Firstname</th>
                        			<th>Lastname</th>
                        			<th>Email</th>
                        			<th>Role</th>
                              <th>Change Role</th>
                              <th>Change Role</th>
	                           </tr>
                        	</thead>
                        	<tbody>

     <?php
        $query="SELECT * FROM users";
  			$select_users=mysqli_query($connection,$query);

          while($row=mysqli_fetch_assoc($select_users)){
        	    $user_id=$row['user_id'];//[] htal ka db yk column name
        			$username=$row['username'];
        			$user_password=$row['user_password'];
        			$user_firstname=$row['user_firstname'];
        			$user_lastname=$row['user_lastname'];
        			$user_email=$row['user_email'];
        			$user_image=$row['user_image'];
        			$user_role=$row['user_role'];

        			echo "<tr>";
        			echo "<td>$user_id</td>";
              echo "<td>$username</td>";
        			echo "<td>$user_firstname</td>";
        			echo "<td>$user_lastname</td>";
        			echo "<td>$user_email</td>";
        			echo "<td>$user_role</td>";



			//comment pyy tae  post  ko title nk link nk chate ml
			//$query="SELECT * FROM posts WHERE post_id=$comment_post_id";
			//$select_post_id_query=mysqli_query($connection,$query);

			//while($row=mysqli_fetch_assoc($select_post_id_query)){
			//$post_id=$row['post_id'];//[]htl ka apw ka hr
			//$post_title=$row['post_title'];

			//echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";

			//}


			//category ko dynamic fik ag NOT DEFAULT NUMBER what user add
			//$query="SELECT * FROM categories WHERE cat_id=$post_category_id ";//pcid ka db column name
		    //$select_categories_id=mysqli_query($connection,$query);

             // while($row=mysqli_fetch_assoc($select_categories_id)){
             // $cat_id=$row['cat_id'];//[] htal ka db yk column name
			//$cat_title=$row['cat_title'];
		   //  echo "<td>{$cat_title}</td>";
		   // }

			//echo "<td><img class='img-responsive' src='../images/$post_image' alt='image'></td>";
			//echo "<td><img width='100' src='../images/$post_image' alt='image'></td>";
			//echo "<td>$post_content</td>";
			//echo "<td>$post_tags</td>";
			//echo "<td>$post_comment_count</td>";
			//echo "<td>$post_date</td>";
			echo "<td><a href='users.php?change_to_admin={$user_id}'>ADMIN</a></td>";
			echo "<td><a href='users.php?change_to_sub={$user_id}'>SUBSCRIBER</a></td>";
			echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>EDIT</a></td>";
		  echo "<td><a href='users.php?delete={$user_id}'>DELETE</a></td>";//delete link
			echo "</tr>";
			}

      ?>

      <?php
      //admin
      if(isset($_GET['change_to_admin'])){
      $the_user_id=$_GET['change_to_admin'];

			$query="UPDATE users SET user_role='admin' WHERE user_id= $the_user_id";
			$change_admin=mysqli_query($connection,$query);
			//refresh
			header("Location:users.php");
            }


			//subscriber
			if(isset($_GET['change_to_sub'])){
      $the_user_id=$_GET['change_to_sub'];

			$query="UPDATE users SET user_role='subscriber' WHERE user_id= $the_user_id";
			$change_subscriber=mysqli_query($connection,$query);
			//refresh
			header("Location:users.php");
      }
    // deleteuser function

         if(isset($_GET['delete'])){   //['delete']ka apaw ka key
          $delete_user_id=$_GET['delete'];
             //query saunt p delete fo
         $query="DELETE FROM users WHERE user_id ={$delete_user_id} ";//get method used to collect
         //data after submitting an HTML form
         $delete_query=mysqli_query($connection,$query);//send like p db ko ae dr so pyt wr yw

          header("Location:users.php");//dr ka 2 khr ma click ya ag tann refresh loke lk tr

      }

    //delete user
    if(isset($_GET['delete'])){
      if(isset($_SESSION['user_role'])){
        if($_SESSION['user_role']=='admin'){
          $delete_user_id=mysqli_real_escape_string($connection,$_GET['delete']);
          $query="DELETE FROM users WHERE user_id={$delete_user_id}";
    			$delete_user=mysqli_query($connection,$query);
    			//refresh
    			header("Location:users.php");
        }
      }
  }
      ?>
   </tbody>
  </table>
