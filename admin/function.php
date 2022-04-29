<?php
//===== DATABASE HELPER FUNCTIONS =====//
function redirect($location){
  header("Location:".$location);
  exit;
}


function query($query){
  global $connection;
  $result= mysqli_query($connection,$query);
  confirmQuery($result);
  return $result;
}

function count_query_result($result){
  return mysqli_num_rows($result);
}
//===== END DATABASE HELPERS =====//


//===== GENERAL HELPERS =====//
function get_user_name(){
  return isset($_SESSION['username']) ? $_SESSION['username'] : null;
  // if(isset($_SESSION['username'])){
  //   return $_SESSION['username'];
  // }
}

//===== END GENERAL HELPERS =====//


//===== AUTHENTICATION HELPERS =====//

function is_admin($username=null){
  global $connection;
  if(isLoggedIn()){
    $result=query("SELECT user_role FROM users WHERE user_id=". $_SESSION['user_id']." ");
    $row=fetchRecords($result);
    if($row['user_role']=='admin'){
      return true;
    }else{
      return false;
       }
     }
  return false;
}
//===== END AUTHENTICATION HELPERS =====//

//===== USER SPECIFIC HELPERS=====//
function get_all_user_posts(){
  return query("SELECT * FROM posts WHERE user_id=".loggedInUserId()." ");
}

function get_all_post_user_comments(){
  return query("SELECT * FROM posts
    INNER JOIN comments ON posts.post_id=comments.comment_post_id
    WHERE user_id=".loggedInUserId()." ");
}


function get_all_user_categories(){
  return query("SELECT * FROM categories WHERE user_id=".loggedInUserId()." ");
}

function get_all_user_published_posts(){
  return query("SELECT * FROM posts WHERE user_id=".loggedInUserId()."  AND post_status='published'");
}
function get_all_user_draft_posts(){
  return query("SELECT * FROM posts WHERE user_id=".loggedInUserId()."  AND post_status='draft'");
}
function get_all_user_approved_comments(){
  return query("SELECT * FROM posts
    INNER JOIN comments ON posts.post_id=comments.comment_post_id
    WHERE user_id=".loggedInUserId()." AND comment_status='approved'");
}

function get_all_user_unapproved_comments(){
  return query("SELECT * FROM posts
    INNER JOIN comments ON posts.post_id=comments.comment_post_id
    WHERE user_id=".loggedInUserId()." AND comment_status='unapproved'");
}
//===== END USER SPECIFIC HELPERS=====//




function ifItIsMethod($method=null){
  if($_SERVER['REQUEST_METHOD']==strtoupper($method)){
    return true;

  }return false;
}


 function confirmQuery($result){
   	global $connection;
   	if(!$result){
   		die('Query Failed '.mysqli_error($connection));
   	}
 }



function isLoggedIn(){
  if(isset($_SESSION['user_role'])){
    return true;
  }return false;
}

function fetchRecords($result){
  return mysqli_fetch_array($result);
}



function loggedInUserId(){
    if(isLoggedIn()){
        $result = query("SELECT * FROM users WHERE username='" . $_SESSION['username'] ."'");
        confirmQuery($result);
        $user = mysqli_fetch_array($result);
        return mysqli_num_rows($result) >= 1 ? $user['user_id'] : false;
    }
    return false;

}


function userLikedThisPost($post_id){
    $result = query("SELECT * FROM likes WHERE user_id=" .loggedInUserId() . " AND post_id={$post_id}");
    confirmQuery($result);
    return mysqli_num_rows($result) >= 1 ? true : false;
}


function getPostLikes($post_id){
  $result=query("SELECT * FROM likes WHERE post_id={$post_id}");
  confirmQuery($result);
  echo mysqli_num_rows($result);
}

function checkIfUserIsLoggedInAndRedirect($redirectLocation=null){
  if(isLoggedIn()){
    redirect($redirectLocation);
  }
}

function users_online() {
  if(isset($_GET['onlineusers'])) {
    global $connection;
        if(!$connection) {
        session_start();
        include("../includes/db.php");
        $session = session_id();
        $time = time();
        $time_out_in_seconds = 05;
        $time_out = $time - $time_out_in_seconds;
        $query = "SELECT * FROM users_online WHERE session = '$session'";
        $send_query = mysqli_query($connection, $query);
        $count = mysqli_num_rows($send_query);
    if($count == NULL) {
        mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session','$time')");
    }
    else {
        mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
    }
    $users_online_query =  mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
    echo $count_user = mysqli_num_rows($users_online_query);
}
    } // get request isset()
}
users_online();


function insert_categories(){
   global $connection;//dr lote mha connect loh ya mr
   if(isset($_POST['submit'])){

    $cat_title=$_POST['cat_title'];
	  if($cat_title=="" || empty($cat_title)){
	  echo "This field should not be empty";
		}
    else{

    $stmt=mysqli_prepare($connection,"INSERT INTO categories(cat_title) VALUES (?)");
    mysqli_stmt_bind_param($stmt,'s',$cat_title);
    mysqli_stmt_execute($stmt);

		if(!$stmt){
		die('Query Failed'. mysqli_error($connection));
				   }
		     	}
          mysqli_stmt_close($stmt);
      }
  }



 function findAllCategories(){
    global $connection;
    $query="SELECT * FROM categories";//LIMIT 2 nk limit loh ya
		$select_categories=mysqli_query($connection,$query);

        while($row=mysqli_fetch_assoc($select_categories)){//while loop ka athet kana2 yay ny syr ma lo tot bu
        $cat_id=$row['cat_id'];//[] htal ka db yk column name
        $cat_title=$row['cat_title'];
        echo "<tr>";//while htal mr loop pat tk tabaw
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";//get super global var ko 3 mr .
         	//ashae ka delete ka key nout ka {$cat_id}ka value
         echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";//get super global var ko 3 mr .
        //dr ka global variable edit key nk Edit Category Title chate lk tr
        echo "</tr>";
         }
}


 function deleteCategories(){
	  global $connection;
		if(isset($_GET['delete'])){   //['delete']ka apaw ka key
    $delete_cat_id=$_GET['delete'];
        //query saunt p delete fo
		$query="DELETE FROM categories WHERE cat_id ={$delete_cat_id} ";//get method used to collect
		//data after submitting an HTML form
		$delete_query=mysqli_query($connection,$query);//send like p db ko ae dr so pyt wr yw

	   header("Location:categories.php");//dr ka 2 khr ma click ya ag tann refresh loke lk tr
                     }
 }




//escape data before posting online
function escape($string){
  global $connection;
  return mysqli_real_escape_string($connection,trim($string));
}

function recordCount($table){
  global $connection;
  $query="SELECT * FROM ".$table;
  $select_column_count=mysqli_query($connection,$query);
  $count=mysqli_num_rows($select_column_count);
  confirmQuery($count);
  return $count;

}

function checkStatus($table,$column,$status){
  global $connection;
  $query = "SELECT * FROM $table WHERE $column = '$status' ";
  $result = mysqli_query($connection,$query);
  confirmQuery($result);
  return mysqli_num_rows($result);
}

function checkUserRole($table,$column,$user_role){
  global $connection;
  $query = "SELECT * FROM $table WHERE $column = '$user_role'";
  $result = mysqli_query($connection,$query);
  confirmQuery($result);
  return mysqli_num_rows($result);
}

function username_exists($username){
  global $connection;
  $query="SELECT username FROM users WHERE username='$username'";
  $result=mysqli_query($connection,$query);
  confirmQuery($result);
  if(mysqli_num_rows($result)>0){
    return true;
  }
  else{
    return false;
  }
}

function email_exists($email){
  global $connection;
  $query="SELECT user_email FROM users WHERE user_email='$email'";
  $result=mysqli_query($connection,$query);
  confirmQuery($result);
  if(mysqli_num_rows($result)>0){
    return true;
  }
  else{
    return false;
  }
}

function register_user($username, $email, $password){

    global $connection;

    $username = mysqli_real_escape_string($connection, $username);
    $email    = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);

    $password = password_hash( $password, PASSWORD_BCRYPT, array('cost' => 12));


    $query = "INSERT INTO users (username, user_email, user_password, user_role) ";
    $query .= "VALUES('{$username}','{$email}', '{$password}', 'subscriber' )";
    $register_user_query = mysqli_query($connection, $query);

    confirmQuery($register_user_query);
}





function login_user($username,$password){
    global $connection;
    $username=trim($_POST['username']);
    $password=trim($_POST['password']);

    $username=mysqli_real_escape_string($connection,$username);
    $password=mysqli_real_escape_string($connection,$password);
    //sql injection


    $query="SELECT * FROM users WHERE username='{$username}'";
    $select_user_query=mysqli_query($connection,$query);
    if(!$select_user_query){
      die("Query Failed".mysqli_error($connection));
    }

    //to pull information out of database
    while($row=mysqli_fetch_array($select_user_query)){
      $db_user_id=$row['user_id'];
      $db_user_firstname=$row['user_firstname'];
      $db_user_lastname=$row['user_lastname'];
      $db_user_role=$row['user_role'];
      $db_username=$row['username'];
      $db_user_email=$row['user_email'];
      $db_user_password=$row['user_password'];


      if(password_verify($password,$db_user_password)){
        $_SESSION['user_id']=$db_user_id;
        $_SESSION['username']=$db_username;
        $_SESSION['user_firstname']=$db_user_firstname;
        $_SESSION['user_lastname']=$db_user_lastname;
        $_SESSION['user_role']=$db_user_role;

        redirect("/NewCMS/admin");


      }
      else{
       redirect("/NewCMS/index");
         }
    }
    //rand password to normal Password
    // $password=crypt($password,$db_user_password);

    }
?>
