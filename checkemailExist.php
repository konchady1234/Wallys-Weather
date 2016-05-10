<?
session_start(); ob_start();
error_reporting(0);
include_once('lib/config.php');
include_once('lib/mysql_class.php');
$sql=new mysql();

$cnt=mysql_num_rows(mysql_query("select * from web_user where user_email='".$_REQUEST['user_email']."'"));
if($cnt>0){
echo 'true';
}
else{	
echo 'false';
}
?>