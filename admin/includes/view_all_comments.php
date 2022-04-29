  <table class="table table-bordered table-hover" >
                        	<thead>
                        		<tr>
                              <th>Comment ID</th>
                        			<th>Post ID</th>
                        			<th>Author</th>
                        			<th>Comment</th>
                        			<th>Email</th>
                        			<th>Status</th>
                        			<th>In Response to</th>
                        			<th>Date</th>
                        			<th>Approve</th>
                        			<th>Unapprove</th>
                        			<th>Delete</th>
                        		</tr>
                        	</thead>
                        	<tbody>

      <?php
      
      $query="SELECT comments.comment_id,comments.comment_post_id,comments.comment_author,
      comments.comment_content,comments.comment_email,comments.comment_status,
      comments.comment_date,posts.post_id,posts.post_title FROM comments LEFT JOIN posts ON
      comments.comment_post_id = posts.post_id";
			$select_comments=mysqli_query($connection,$query);

      while($row=mysqli_fetch_assoc($select_comments)){
    	$comment_id=$row['comment_id'];//[] htal ka db yk column name
			$comment_post_id=$row['comment_post_id'];
			$comment_author=$row['comment_author'];
			$comment_content=$row['comment_content'];
			$comment_email=$row['comment_email'];
			$comment_status=$row['comment_status'];
			$comment_date=$row['comment_date'];
      $post_id=$row['post_id'];
      $post_title=$row['post_title'];

			echo "<tr>";echo "<td>$comment_id</td>";
			echo "<td>$comment_post_id</td>";
      echo "<td>$comment_author</td>";
			echo "<td>$comment_content</td>";
			echo "<td>$comment_email</td>";
			echo "<td>$comment_status</td>";
      echo "<td><a href='../post.php?p_id=$post_id'>$post_title</td>";

			//comment pyy tae  post  ko title nk link nk chate ml

    //  $query = "SELECT posts.post_id,posts.post_title,comments.comment_post_id LEFT JOIN posts ON
    //  posts.post_id=comments.comment_post_id ";
    //  $select_post_id_query = mysqli_query($connection,$query);
    //  while($row = mysqli_fetch_assoc($select_post_id_query)){
    //
    //
    // echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
    //
    //
    //  }




			echo "<td>$comment_date</td>";
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
			echo "<td><a href='comments.php?approve=$comment_id'>APPROVE</a></td>";
			echo "<td><a href='comments.php?unapprove=$comment_id'>UNAPPROVE</a></td>";
		  echo "<td><a href='comments.php?delete=$comment_id'>DELETE</a></td>";//delete link
			echo "</tr>";
			}

      ?>

      <?php
      //approve
      if(isset($_GET['approve'])){
      $the_comment_id=$_GET['approve'];

			$query="UPDATE comments SET comment_status='APPROVED' WHERE comment_id= $the_comment_id";
			$approve_comment_query=mysqli_query($connection,$query);
			//refresh
			header("Location:comments.php");
            }


			//unapprove
			if(isset($_GET['unapprove'])){
            $the_comment_id=$_GET['unapprove'];
            $query="UPDATE comments SET comment_status='UNAPPROVED' WHERE comment_id= $the_comment_id";

			$unapprove_comment_query=mysqli_query($connection,$query);
			//refresh
			header("Location:comments.php");
            }





      //delete comment
      if(isset($_GET['delete'])){
      $delete_comment_id=$_GET['delete'];
			$query="DELETE FROM comments WHERE comment_id={$delete_comment_id}";
			$delete_query=mysqli_query($connection,$query);
			//refresh
			header("Location:comments.php");
    }
            ?>


             </tbody>
                        </table>
