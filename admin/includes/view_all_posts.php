<?php include("delete_modal.php");
if(isset($_POST['checkBoxArray'])) {

  foreach($_POST['checkBoxArray'] as $postValueId ){

  $bulk_options = $_POST['bulk_options'];

  switch($bulk_options) {
  case 'published':

      $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}  ";

      $update_to_published_status = mysqli_query($connection,$query);
        confirmQuery($update_to_published_status);

 break;


case 'draft':

      $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}  ";

       $update_to_draft_status = mysqli_query($connection,$query);

      confirmQuery($update_to_draft_status);

  break;

 case 'delete':

      $query = "DELETE FROM posts WHERE post_id = {$postValueId}  ";

       $update_to_delete_status = mysqli_query($connection,$query);

      confirmQuery($update_to_delete_status);
break;
//Clone
case 'clone':

        $query = "SELECT * FROM posts WHERE post_id = {$postValueId}  ";

        $select_posts_query = mysqli_query($connection,$query);

        while($row=mysqli_fetch_assoc($select_posts_query)){
        $post_id=$row['post_id'];//[] htal ka db yk column name
        $post_user=$row['post_user'];
        $post_title=$row['post_title'];
        $post_category_id=$row['post_category_id'];
        $post_status=$row['post_status'];
        $post_image=$row['post_image'];
        $post_content=$row['post_content'];
        $post_tags=$row['post_tags'];
        $post_comment_count=$row['post_comment_count'];
        $post_date=$row['post_date'];
        }
        if(empty($post_tags)){
          $post_tags="No tags";
        }
        $query="INSERT INTO posts(post_category_id,post_title,post_user,post_date,post_image, post_content,
                post_tags,post_status) ";
        $query.="VALUES({$post_category_id},'{$post_title}','{$post_user}',now(),'{$post_image}',
                '{$post_content}','{$post_tags}','{$post_status}')";

        $clone_post_query=mysqli_query($connection,$query);
        if(!$clone_post_query){
          die("Query Failed".mysqli_error($connection));
        }
break;
//reset
case 'reset':

      $query = "UPDATE posts SET post_views_count=0 WHERE post_id= ".mysqli_real_escape_string($connection,$postValueId)." ";

      $reset_query = mysqli_query($connection,$query);

      confirmQuery($reset_query);
break;
}
}
}
 ?>
<form action="" method="post">
    <table class="table-bordered table-hover" style="width:100% ">
      <div class="row">
      <div id="bulkOptionsContainer" class="col-xs-4">
        <select class="form-control" name="bulk_options" id="">
          <option value="">Select Options</option>
          <option value="published">Publish</option>
          <option value="draft">Draft</option>
          <option value="delete">Delete</option>
          <option value="clone">Clone</option>
          <option value="reset">Reset</option>
       </select>
       </div>

        <div class="col-xs-4">
          <input type="submit" name="submit" class="btn btn-success" value="Apply">

          <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
        </div>
         </div>
        	<thead>
        		<tr>
              <th><input id="selectAllBoxes" type="checkbox"></th>
        			<th>ID</th>
        			<th>Users</th>
        			<th style="text-align: center;vertical-align: middle">Title</th>
        			<th>Category</th>
        			<th style="text-align: center;vertical-align: middle">Status</th>
        			<th style="text-align: center;vertical-align: middle">Image</th>
        			<th style="text-align: center;vertical-align: middle">Content</th>
        			<th style="text-align: center;vertical-align: middle">Tags</th>
        			<th>Comments</th>
        			<th>Date</th>
              <th>View Post</th>
        			<th>Edit</th>
        			<th>Delete</th>
              <th>View Counts</th>
        		</tr>
        	</thead>
      <tbody>

      <?php
        // $user=currentUser();//$user=$_SESSION['username'];
      //joining query
        $query="SELECT posts.post_id,posts.post_user,posts.post_title,posts.post_category_id,
        posts.post_status,posts.post_image,posts.post_content,posts.post_tags,
        posts.post_comment_count,posts.post_date,posts.post_views_count, ";
        $query.="categories.cat_id,categories.cat_title ";
        $query.="FROM posts ";
        $query.="LEFT JOIN categories ON posts.post_category_id=categories.cat_id ORDER BY posts.post_id DESC";
  			$select_posts=mysqli_query($connection,$query);

      while($row=mysqli_fetch_assoc($select_posts)){
    	$post_id=$row['post_id'];//[] htal ka db yk column name
      $post_user=$row['post_user'];
      $post_title=$row['post_title'];
			$post_category_id=$row['post_category_id'];
			$post_status=$row['post_status'];
			$post_image=$row['post_image'];
			$post_content=$row['post_content'];
			$post_tags=$row['post_tags'];
			$post_comment_count=$row['post_comment_count'];
			$post_date=$row['post_date'];
      $post_views_count=$row['post_views_count'];
      $cat_id=$row['cat_id'];//[] htal ka db yk column name
      $cat_title=$row['cat_title'];
    	echo "<tr>";?>

     <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]'
     value='<?php echo $post_id; ?>'></td>


      <?php
      echo "<td>$post_id</td>";

      if(!empty($post_user)){
      echo "<td style='text-align: center;vertical-align: middle'>$post_user</td>";
      }


      echo "<td>$post_title</td>";

			//category ko dynamic fik ag NOT DEFAULT NUMBER what user add
			// $query="SELECT * FROM categories WHERE cat_id=$post_category_id ";//pcid ka db column name
		  // $select_categories_id=mysqli_query($connection,$query);
      //
      // while($row=mysqli_fetch_assoc($select_categories_id)){
      // $cat_id=$row['cat_id'];//[] htal ka db yk column name
			// $cat_title=$row['cat_title'];
	    // echo "<td>{$cat_title}</td>";
      //   }
      echo "<td>{$cat_title}</td>";

			echo "<td>$post_status</td>";
			//echo "<td><img class='img-responsive' src='../images/$post_image' alt='image'></td>";
			echo "<td><img width='100' src='../images/$post_image' alt='image'></td>";
			echo "<td width=30px>$post_content</td>";
			echo "<td>$post_tags</td>";
      //post yk comment Counts
      $query="SELECT * FROM comments WHERE comment_post_id=$post_id";
      $comment_query=mysqli_query($connection,$query);
      $post_comment_count=mysqli_num_rows($comment_query);
      // echo "<td>$post_comment_count</td>";
      echo "<td style='text-align: center;vertical-align: middle'><a href='post_comments.php?id=$post_id'>$post_comment_count</a></td>";
      //id ka related comments to post(for GET request)
      // $row=mysqli_fetch_array($comment_query);

			echo "<td>$post_date</td>";

      echo "<td><a class='btn btn-info' href='../post.php?p_id={$post_id}'>View Post</a></td>";
			echo "<td><a class='btn btn-primary' href='posts.php?source=edit_post&p_id={$post_id}'>EDIT</a></td>";
			//edit link
			// echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete???');\" href='posts.php?delete={$post_id}'>DELETE</a></td>";//delete link
      echo "<td><a class='btn btn-danger delete_link' href='javascript: void(0)' rel='$post_id' >Delete</a></td>";
      echo "<td style='text-align: center;vertical-align: middle'>{$post_views_count}</td>";
      echo "</tr>";
			}

      ?>

      <?php //delete query
      if(isset($_GET['delete'])){

      $delete_post_id=$_GET['delete'];
			$query="DELETE FROM posts WHERE post_id={$delete_post_id}";
			$delete_query=mysqli_query($connection,$query);
			header("Location:posts.php");
      }
      ?>
       </tbody>
      </table>
</form>

  <script>
  $(document).ready(function(){
    $(".delete_link").on('click',function(){
      var id=$(this).attr("rel");
      var delete_url = "posts.php?delete="+ id;;
      $(".modal_delete_link").attr("href", delete_url);
      $("#myModal").modal('show');
    });
  });
  </script>
