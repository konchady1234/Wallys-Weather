<?php 
error_reporting(0);
$ip=$_SERVER["SERVER_ADDR"];
$conn = mysql_connect('localhost', 'root', '') or die('Error connecting to mysql');
$dbname = 'wally';
$urlsite='http://localhost/wally/';
$foldername='/wally/';
mysql_select_db($dbname,$conn) or die('Error connecting to database');
$sitetitle='wally ';
?>