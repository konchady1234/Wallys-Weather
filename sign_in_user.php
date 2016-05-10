<?php 
/*	PAGE ID				:PHP#
	WEBSITE NAME		:Wallys Weather
	DEVELOPED BY		:Zerosoft [www.zerosofttech.com]
	CREATED ON			:4/29/2016
	AUTHOR				:ZST1043
	DESCRIPTION			:This one is UI page*/
session_start(); ob_start();
include_once('lib/config.php');
include_once('lib/mysql_class.php');
$sql=new mysql();

if(isset($_REQUEST['username'])&& $_REQUEST['username']!='')
{
 $res=$sql->comLogin($_REQUEST['username'],$_REQUEST['password']);
 
 if($res=='admin')
 {   
	
    header('Location:http://wallysweather.3eeweb.com/admin/');exit();
 }
 elseif($res=='user')
 {
	 ?><script>window.location.href="index.php";</script><?
     }
 else
 {
 ?><script>alert("Invalid login details!")</script><?
 }
}?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Login - Wallys Weather</title>
<link href="webadmin/css/admin_stlyz.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="css/media.css">    
</head>

<body id="loginwrapper">
<form name="adminlogin" action=""  method="post">
<div class="admin"><div class="admin-logo"><img src="images/logo.png" alt="logo" border="0"></div>   
   <div class="space"></div>
<center><h2>Sign-In</h2></center>

   <div class="space"></div>  
	<? if($_REQUEST['action']=="success") { ?>
    <div class="suc_msg">Your Account has been Registered successfully.</div>
    <? }  ?>

<div class="admin-frm">
   <div class="space"></div>  
 <div class="admin_left1">Username <font color="#FF0000">*</font> </div> <div class="colon">:</div>		
                 <div class="des1"><input type="text" name="username" id="username" class="textbox"></div>	
                 <div class="clear"></div>	
                 
   <div class="space"></div>  
 <div class="admin_left1">Password <font color="#FF0000">*</font> </div> <div class="colon">:</div>		
                 <div class="des1"><input type="password" name="password" id="password" class="textbox"></div>	
                 <div class="clear"></div>	
   <div class="space"></div>
 <div class="admin_left1">&nbsp; </div> <div class="colon">&nbsp;</div>		
                 <div class="des1">
<input type="submit" class="btn" value='Login' name="submit"  onclick='return validation()'  />
<input type="button" value="Back" name="clear" class="btn" onClick="location.href = 'http://nskfix.com/dev/wally/index.php'"  />
</div>
<div class="clear"></div>
</div>
 <div class="space"></div> 
 <div class="space"></div> 
</div>
</form>
</body>
</html>
<script>
function validation(){
	username = document.getElementById('username').value;
	password = document.getElementById('password').value;	
	if((username=='') &&(password =='')){
		alert("Enter username and password");
		document.getElementById('username').focus();
		return false;
	}
	else if(username==''){
		alert("Enter username");
		document.getElementById('username').focus();
		return false;
	}
	else if(password ==''){
		alert("Enter password");
		document.getElementById('password').focus();
		return false;
	}
	return true;
}
</script>
<style>
.suc_msg
{
	color: white;
    text-align: center;
	font-weight: bold;
	font-size:15px;
}
</style>