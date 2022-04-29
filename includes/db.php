<?php ob_start();?>
<?php
$db['db_host']="localhost";//array nk secure fik ag save htr tr
$db['db_user']="root";
$db['db_pass']="";
$db['db_name']="cms";
foreach($db as $key=>$value){//foreach ka arr nk obj ka value ty loop anay nk htoke py tl
define(strtoupper($key), $value);//constant htae tr function define nk aku ka upper nk htae tr ya say chin loh key ko

}
//$connection=mysqli_connect('localhost','root','','cms');ae lo htae yin secure ma fik mr soe loh
$connection=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
$query="SET NAMES utf8";
mysqli_query($connection,$query);

//if($connection){
	//echo "Database is connected";
//}










?>
