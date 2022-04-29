<!--Edit Category Title-->
<form action="" method="post">
<div class="form-group">
<label for="cat_title"> Edit Category</label>

  	<?php
  	if(isset($_GET['edit'])){
  	$edit_cat_id=$_GET['edit'];

		$query="SELECT * FROM categories WHERE cat_id=$edit_cat_id ";
    $select_categories_id=mysqli_query($connection,$query);

    while($row=mysqli_fetch_assoc($select_categories_id)){
    $cat_id=$row['cat_id'];//[] htal ka db yk column name
	  $cat_title=$row['cat_title'];
	  ?><!-- loop pate pee html htae fo ,html htae fo so ?>pate ya tl -->

  <input value="<?php if(isset($cat_title)) {echo $cat_title;}?>" type="text" class="form-control" name="cat_title">
<!-- apaw ka hr ka br loh thel lr ll so tot we want whole piece inside the while loop-->
<!--pee tot value so tr ka right ka table htl ka edit tk kg ko edit form yae text nay yar mr tnn paw lr say chin loh-->

	   <?php } } ?>
	   <!-- kyan tk } ty so php nk sine loh <?php ?> ty thet2 lote py ya tl-->
	   <!--nout } ka if akyee atwt-->

  	  <?php
    	  //////Update query
	  if(isset($_POST['update_category'])){
   	$update_cat_title=escape($_POST['cat_title']);  //query saunt p delete fo

    $stmt=mysqli_prepare($connection,"UPDATE categories SET cat_title=? WHERE cat_id=?");
    mysqli_stmt_bind_param($stmt,'si',$update_cat_title,$cat_id);
    mysqli_stmt_execute($stmt);

     if(!$stmt){
     	die("Query Failed".mysqli_error($connection));
     }
     redirect("categories.php");mysqli_stmt_close($stmt);
  }
  	  ?>
	   </div>
    	<div class="form-group">
    		<input type="submit" class="btn btn-primary" name="update_category" value="Update">
    	</div>
    </form>
