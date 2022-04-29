<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>
<?php echo loggedInUserId();

if(userLikedThisPost(158)){

    echo "USER LIKED IT";


} else {

    echo "USER DID NOT LIKE IT";

}

?>
