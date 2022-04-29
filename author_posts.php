<?php include "includes/db.php";?>
<?php include "includes/header.php";?>
    <!-- Navigation -->
    <?php include "includes/navigation.php";?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

      <?php
			if(isset($_GET['p_id'])){ //index.php ka key
			$the_post_id=$_GET['p_id'];
      $the_author_post=$_GET['author'];
      }


       $query="SELECT * FROM posts WHERE post_user='{$the_author_post}'";//post_id ka column
		   $select_author_post=mysqli_query($connection,$query);
					while($row=mysqli_fetch_assoc($select_author_post)){
          $post_id=$row['post_id'];
					$post_title=$row['post_title'];
          //post_title so tr db yae row name
					$post_user=$row['post_user'];
					$post_date=$row['post_date'];
					$post_image=$row['post_image'];
					$post_content=$row['post_content'];
						//} ma pate nk oo
           ?>

          <!-- <h1 class="page-header">
              Page Heading
              <small>Secondary Text</small>
          </h1> -->

          <!-- First Blog Post -->
          <h2>
              <a href="/NewCMS/post/<?php echo $post_id;?>"><?php echo $post_title;?></a>
          </h2>
          <p class="lead">
              by <a href="author_posts.php?author=<?php echo $post_user;?>&p_id=<?php echo $post_id;?>"><?php echo $post_user;?></a>
          </p>
          <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date;?></p>
          <hr>
          <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
          <hr>
          <p><?php echo $post_content;?></p>
          <a class="btn btn-primary" href="/NewCMS/post/<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>


          <hr>
          <?php }    ?>

              <!-- Blog Comments -->

          <?php //comment data ty database htl ko htae
        if(isset($_POST['create_comment'])){
			  $the_post_id=$_GET['p_id'];

			  $comment_author=$_POST['comment_author'];
			  $comment_email=$_POST['comment_email'];
			  $comment_content=$_POST['comment_content'];
        if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){

			  $query="INSERT INTO comments (comment_post_id,comment_author,comment_email,
			  comment_content,comment_status,comment_date) " ;
			  $query.= "VALUES ($the_post_id,'{$comment_author}','{$comment_email}',
			  '{$comment_content}','UNAPPROVE',now())";

			 $create_comment_query=mysqli_query($connection,$query);
			 if(!$create_comment_query){
			 	die('Query Failed'.mysqli_error($connection));
			 }
			 //comment increment query
			 $query="UPDATE posts SET post_comment_count=post_comment_count + 1 ";
			 $query.="WHERE post_id=$the_post_id";
			 $update_comment_count=mysqli_query($connection,$query);

			  }
        else{
          echo "<script>alert('Fields cannot be Empty');</script>";
        }
      }
              ?>


            </div>

            <!-- Blog sidebar widget column-->
            <?php include "includes/sidebar.php";?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
       <?php include "includes/footer.php";?>
