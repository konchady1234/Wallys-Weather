<?php 
error_reporting(0);
$ip=$_SERVER["SERVER_ADDR"];
<<<<<<< HEAD
$conn = mysql_connect('localhost', 'root', '') or die('Error connecting to mysql');
$dbname = 'wally';
$urlsite='http://localhost/wally/';
$foldername='/wally/';
mysql_select_db($dbname,$conn) or die('Error connecting to database');
$sitetitle='wally ';
=======


/*$conn = mysql_connect('localhost', 'root', '') or die('Error connecting to mysql');
$dbname = 'wally';
$foldername='/wally/'; */

$conn = mysql_connect('mysql.2freehosting.com', 'u168539759_wally', 'wallysweather123') or die('Error connecting to mysql');
$dbname = 'u168539759_admin';
$foldername='/';


mysql_select_db($dbname,$conn) or die('Error connecting to database');

$sitetitle="Wally's Weather";



$sitepath = 'http://wallysweather.3eeweb.com/';





>>>>>>> 72b5b01fa70f0fba2e589a992e66ccb9ab41f4bc
?>