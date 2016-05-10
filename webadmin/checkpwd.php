<?
session_start();
include('../lib/config.php'); 
$encrypt_password=$_REQUEST['oldpass'];
$web_password=($encrypt_password); 
$sql_psd=mysql_query("select * from `admin_table` where password='$web_password'");
echo $cnt_roll=mysql_num_rows($sql_psd);
?>
