<?php include "includes/admin_header.php";?>

    <div id="wrapper">
    <?php include "includes/admin_navigation.php";?>

        <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin Page
                        <small>myatsusan</small>
                    </h1>

                    <div class="col-xs-6">

                    	<?php insert_categories();?><!--function kwl lk loh-->



        	<!-- add category form start-->

        	<form action="" method="post">
        	<div class="form-group">
        		<label for="cat_title"> Add Category</label>
        		<input type="text" class="form-control" name="cat_title">
        	</div>
        	<div class="form-group">
        		<input type="submit" class="btn btn-primary" name="submit" value="Add">
        	</div>


        	</form>
       <!-- add category form -->

       <?php //update_categories nk chate fo
       if(isset($_GET['edit'])){  //edit ka get method yk key ma loh
       	$cat_id=$_GET['edit'];
		    include "includes/update_categories.php";
                 }
         ?>

   </div>

         <!-- show category table-->
         <div class="col-xs-6">
          	<table class="table table-bordered table-hover">
         		<thead>
         			<tr>
         				<th>ID</th>
         				<th>Category Title</th>
         			</tr>
         		</thead>

       		<tbody>

       		<?php //FIND ALL CATEGORIES
       		findAllCategories();
	         ?>

            <?php //GET DELETE id and DELETE From DATABASE using query
             deleteCategories();
             ?>
           </tbody>
       	</table>

           </div>
          </div>
          <!-- show category table-->

              </div>
          </div>
          <!-- /.row -->

      </div>
      <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

   <?php include "includes/admin_footer.php";?>
