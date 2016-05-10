<?
 session_start(); ob_start();
include_once('lib/config.php');
include_once('lib/mysql_class.php');
$sql=new mysql();  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Search Location - Wallys weather</title>
<link href="css/style.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="css/master.css">    
<link rel="stylesheet" href="css/media.css">    
</head>
<body>
<div class="wrapper">
<? include('header.php') ?>
<br /><br />
<div class="clear">
 <h1  class="hBotVal" style="padding: 9px; color:#fff; text-align:center;">
                    Location</h1>
<div class="lik">
                    <ul>
                    <li><a class="back" href="index.php">Home</a></li>
                     <?
                     if($_SESSION['user_id']=='')
                     {?>

                    <li><a class="back" href="sign_in_user.php">Sign-in</a></li>
                    <? } ?>
                    <!--<li><a class="back" href="sign_in_admin.php">Admin-Signin</a></li>-->
                    <!--<span style="color: #446586; font-weight:bold"> | </span>-->
                     <?
                     if($_SESSION['user_id']=='')
                     {?>

                    <li><a class="back" href="registration.php">Subscribe</a></li>
                    <!--<span style="color: #446586; font-weight:bold"> | </span>-->
                    <li><a class="back" href="forgot_password.php">Forgot Password</a></li>
                     <!--<span style="color: #446586; font-weight:bold"> | </span>-->
                     <?   }   ?>
                    <li><a class="back" href="content.php">Content</a></li>
                     <?
                     if($_SESSION['user_id']!='')
                     {?>
                     <li><a class="back" href="logout.php">Logout</a></li>
                     <? } ?>
                     <li><a id="hig_Menu" class="back" href="location.php">Location</a></li>
                    </ul>
                    </div>
<div class="box1" style="height: auto;height: 500px; padding:15px;">
<br />
<h2 style="float:left;">Current Weather for your location : </h2>&nbsp; &nbsp;<input type="text" placeholder="Select Location" class="register_input" value="">
<br /><br />
<p style="line-height:30px;">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </p>
                <br /><br />
                <p style="line-height:30px;">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </p>

</div>
<div class="footer">
                <p>Copyright &copy; 2016 <a href="#">wallyweather.com.au.</a> All rights reserved.</p></div>
</div>
</body>
</html>
<style>
.box1 {
    background: url(images/blog_box_top.png), url(images/blog_box_bottom.png), url(images/blog_box_center.png);
    background-position: left top, left bottom, left center;
    background-repeat: no-repeat, no-repeat, no-repeat;
    background-size: 100% 3.75% , 100% 3.5%, 100% 93.2%;
    width: auto;
    height: auto;
    margin-bottom: 30px;
    /*margin-top: 30px;*/
}
.register_input
{
	margin-top:0px !important;
}
</style>
<style>
@media screen and (max-width: 575px) {
	.lik ul li
	{
		float:none;
		margin-top:22px;
		margin-bottom:0 !important;
	}
}
</style>
