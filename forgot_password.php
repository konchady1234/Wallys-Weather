<?php 
/*	PAGE ID				:PHP#
	WEBSITE NAME		:Wallys Weather
	DEVELOPED BY		:Zerosoft [www.zerosofttech.com]
	CREATED ON			:4/29/2016
	AUTHOR				:ZST1043
	DESCRIPTION			:This one is UI registration page*/
	session_start(); ob_start();
	include_once('lib/config.php');
	include_once('lib/mysql_class.php');
	$sql=new mysql();
	extract($_REQUEST);

	if (isset($_REQUEST['submit']))
	{	
		
		$rs =mysql_fetch_array(mysql_query("SELECT * FROM web_user WHERE user_email='$user_email' ORDER BY user_id DESC LIMIT 1"));
		$user_name = $rs['user_name'];
		$user_password = $rs['user_password'];

		$subject="Password details";
		$message ="<html><head><title>Wallys Weather - Password details</title></head><body>".
		"<table style='font-family:arial;font-size:12px;'>".
		"<tr><td style='text-align:left'><b>Hi ".$user_name.",</b></td></tr>".
		"<tr><td style='text-align:left'><BR><BR>Please find your password details</td></tr>".
		"<tr><td style='text-align:left'><BR><BR>Username      : ".$user_name."</td></tr>".
		"<tr><td style='text-align:left'><BR><BR>Password      : ".$user_password."</td></tr>".
		"<tr><td style='text-align:left'><BR><BR><b>Sincerely,</b></td></tr>".
		"<tr><td style='text-align:left'><BR><b>Wallys Weather</b>
		<BR><BR><a href='http://nskfix.com/dev/wally/index.php'>
		http://nskfix.com/dev/wally/index.php</a></td></tr>".
		"</table>";
		"</body></html>";
	
		$from="wally@gmail.com";
		$to=$_REQUEST['user_email'];
		$headers = 'From: '.$from.'\r\n'.'X-Mailer: PHP/' . phpversion();
		$headers = "From: " . strip_tags($from) . "\r\n";
		$headers .= "Reply-To: ". strip_tags($from) . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		if($mail_send = mail($to, $subject, $message, $headers))
		{
		?> <script>window.location.href="forgot_password.php?action=success";</script><?
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Forgot Password - Wallys Weather</title>
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link rel="icon" href="Sliced images/favicon.png" type="image/x-icon">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="DESCRIPTION" content ="Wally's Weather is a weather page setup to make observations of major weather events across Australia but in particular the Queensland tropics. It has since become a popular site for people across Australia to discuss and ask questions about forecasts and weather information."/> 
<meta name="KEYWORDS" content="Wallys, Wallys Weather, Wally, Weather winter, sunny, Weather sunny, Australia weather detector,
australian weather, weather in australia, weather condition, australian weather, weather in australia, weather condition, Wally’s Weather page, Queensland tropics weather, Queensland tropics weather, weather events across Australia, weather information, road conditions, climate blogs and community communication, Synoptic Charts, Satellite Imagery, Forecast charts, Observation data " />

<!-- Support js -->
<script src="js/jquery-1.11.0.min.js"></script>

<!-- For jquery plugins validation -->
<script src="js/jquery.validate.js"></script>
<script src="js/additional-methods.js"></script>

<!--For External CSS sheet-->
<link href="css/style.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="css/media.css">    
</head>
<style>
.box1 {
    background: url(images/blog_box_top.png), url(images/blog_box_bottom.png), url(images/blog_box_center.png);
    background-position: left top, left bottom, left center;
    background-repeat: no-repeat, no-repeat, no-repeat;
    background-size: 100% 4.75% , 100% 3.5%, 100% 93.2%;
    width: auto;
    height: auto;
    margin-bottom: 30px;
    /*margin-top: 30px;*/
}
</style>
    <div class="wrapper">
        <? include('header.php')?>
        <div class="clear"></div>
        <h1  class="hBotVal" style="padding:9px; color:#fff; text-align:center;">Forgot Password</h1>
        <div class="lik">
                    <ul>
                    <li><a class="back"  href="index.php">Home</a></li>
                    <li><a class="back" href="sign_in_user.php">Sign-in</a></li>
                    <!--<li><a class="back" href="sign_in_admin.php">Admin-Signin</a></li>-->
                    <!--<span style="color: #446586; font-weight:bold"> | </span>-->
                    <li><a class="back" href="registration.php">Subscribe</a></li>
                    <!--<span style="color: #446586; font-weight:bold"> | </span>-->
                    <li><a class="back" id="hig_Menu" href="forgot_password.php">Forgot Password</a></li>
                     <!--<span style="color: #446586; font-weight:bold"> | </span>-->
                    <li><a class="back" href="content.php">Content</a></li>
                    <li><a class="back" href="location.php">Location</a></li>
                    </ul>
                    </div>
        <div class="box1" style="height: auto; padding: 7px;">
              </h1><br /><br />
            <? if($_REQUEST['action']=="success") { ?>
            <div class="suc_msg">Password has been sent successfully to your email.</div>
            <? }  ?>

            <form action="" method="post" style="height: auto;width: 100%;" name="registerform" id="registerform" onSubmit="return reg_validation()" enctype="multipart/form-data"	>
                    <div class="form_reg1">        
                        <div class="input_fld_otr123">
                            <label for="register_input">Email address <sup class="astrix">*</sup> :</label>  
                            <span> <input type="text"  id="user_email" name="user_email" placeholder="Enter email"  class="register_input"
                            onChange="checkemail()"  /> <div id="email1" style="color:#F00"></div></span>
                            <div class="message"></div>
                            <span id="email_status"></span>
                        </div>
                        <div class="clear"></div>
                        
                        <div class="input_fld_otr123"><br />
                            <label for="register_input"></label> 
                            <span class="blogBtns btnPad" style="margin:2px">
                                <input type="submit" name="submit" id="btn_registration_submit" value="Submit" class="button"> 
                            </span><br /><br /><br />
                        </div>
                        <div class="clear"></div>
                    </div>
                </form>
            </div>
            <div class="footer">
            <p>Copyright &copy; 2016 <a href="#">wallyweather.com.au.</a> All rights reserved.</p>
            </div>
    </div>
</body>
</html>    
<!--For jquery plugins validation-->
<script>
$(document).ready(function() {
	$("#registerform").validate({
		errorClass:"errors",  
		onkeyup: true,
		ignore: [],
		  debug: false,
		  rules: {
			user_email: {
					required: true,
					email: true,
					"remote":
					{
					  url: 'checkemailExist.php',
					  type: "post",
					  data:
					  {
						  email: function()
						  {
							  return $('#registerform :input[name="user_email"]').val();
						  }
					  }
					}
					},
		},
		messages: {
			user_email:
			{
				 required: "Please enter the email address",
				 remote: jQuery.validator.format("{0} is does not exists.")
			},
			},
	submitHandler: function() { 
		document.registerform.submit();
	}
});

});
</script>
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

