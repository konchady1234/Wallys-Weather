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
	$pagetitle="Registration";
	extract($_REQUEST);

	//For display captcha
	require_once('inc/recaptchalib.php');
	
	//Captcha API key
	$publickey = "6LeIvOoSAAAAAHp-zbE6aBeMDohqhH-shAo7V2Lm"; 
	$privatekey = "6LeIvOoSAAAAABGMBPN8a9JqodDJGo8TROBTlxqr";

	if (isset($_REQUEST['submit']))
	{	
		$user_status=date("Y-m-d H:i:s"); 
		//mysql_query("INSERT INTO web_user(user_name,user_email,user_gender,user_password,user_status,user_createdon) VALUES('$user_name','$user_email','$user_gender','$user_password','0','$user_status')");
		mysql_query("INSERT INTO web_user(user_name,user_email,user_password,user_status,user_createdon) VALUES('$user_name','$user_email','$user_password','1','$user_status')");

		$subject="Registration Confirmation";
		$message ="<html><head><title>Wallys Weather - Registration Confirmation</title></head><body>".
		"<table style='font-family:arial;font-size:12px;'>".
		"<tr><td style='text-align:left'><b>Hi ".$_REQUEST['user_name'].",</b></td></tr>".
		"<tr><td style='text-align:left'><BR><BR>Please find your login details</td></tr>".
		"<tr><td style='text-align:left'><BR><BR>Username      : ".$_REQUEST['user_name']."</td></tr>".
		"<tr><td style='text-align:left'><BR><BR>Password      : ".$_REQUEST['user_password']."</td></tr>".
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
		?> <script>window.location.href="sign_in_user.php?action=success";</script><?
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Subscribe - Wallys Weather</title>
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
    background-size: 100% 3.75% , 100% 3.5%, 100% 93.2%;
    width: auto;
    height: auto;
    margin-bottom: 30px;
    /*margin-top: 30px;*/
}
</style>
    <div class="wrapper">
        <? include('header.php')?>
        <div class="clear"></div>
        <h1  class="hBotVal" style="padding: 9px; color:#fff; text-align:center;">
                    Subscribe</h1>
                    <div class="lik">
                    <ul>
                     <li><a class="back" href="index.php">Home</a></li>
                     <li><a class="back" href="sign_in_user.php">Sign-in</a></li>
                     <!--<li><a class="back" href="sign_in_admin.php">Admin-Signin</a></li>-->
                     <li><a class="back" id="hig_Menu" href="registration.php">Subscribe</a></li>
                    <!--<span style="color: #446586; font-weight:bold"> | </span>-->
                    <li><a class="back" href="forgot_password.php">Forgot Password</a></li>
                    <li><a class="back" href="content.php">Content</a></li>
                    <li><a class="back" href="location.php">Location</a></li>
                    </ul>
                    </div>
        <div class="box1" style="height: auto; padding: 7px;">
              
                    
                </h1><br /><br />
                
            <!--<h1  class="hBotVal" style="padding:9px;border-bottom: 1px solid #a7def7;">Registration  <span class="lik">Sign-In ( <a href="sign_in_user.php">User</a>/<a href="sign_in_admin.php">Admin</a> )<span style="color: #446586; font-weight:bold"> | </span> <a href="registration.php">Subscribe</a></span></h1><br /><br />-->
            <? if($_REQUEST['action']=="success") { ?>
            <!--<div class="suc_msg">Your Account has been Registered successfully. Please check your inbox to confirm the email address.</div>-->
            <? }  ?>
                
            <form action="" method="post" style="height: auto;width: 100%;" name="registerform" id="registerform" onSubmit="return reg_validation()" enctype="multipart/form-data"	>
                    <div class="form_reg1">        
                        <div class="input_fld_otr123">
                            <label for="register_input">Username<sup class="astrix">*</sup> </label>
                            <input type="text"  name="user_name" id="user_name" placeholder="Enter username" class="register_input"
                            onChange="checkusername()"   /><div id="username1" style="color:#F00"></div>
                        </div>
                        <div class="clear"></div>
                        
                        <div class="input_fld_otr123">
                            <label for="register_input">Email address <sup class="astrix">*</sup> </label>  
                            <span> <input type="text"  id="user_email" name="user_email" placeholder="Enter email"  
 class="register_input"
                            onChange="checkemail()"  /> <div id="email1" style="color:#F00"></div></span>
                            <div class="message"></div>
                            <span id="email_status"></span>
                        </div>
                        <div class="clear"></div>
                        
                        <!--
                        <div class="input_fld_otr123">
                        <label for="register_input" style="text-align:right">Gender   <sup class="astrix">*</sup> </label>  
                            <span>
                                <input type="radio"  id="user_mgender"  name="user_gender" class="gender"
                                value="Male" />
                                Male
                            </span>
                            <span >
                                <input type="radio" id="user_fgender"  name="user_gender" class="gender"
                                value="Female" />
                                Female
                            </span>
                            <span for="user_gender" class="errors" style="display:none">Please select the gender</span>
                        </div>
                        <div class="clear"></div>
                        -->
                        
                        <div class="input_fld_otr123">
                            <label for="register_input">Password<sup class="astrix">*</sup></label> 
                            <input type="password"  name="user_password" id="user_password" placeholder="Enter password" class="register_input"
                            />
                        </div>
                        <div class="clear"></div>
                        
                        <div class="input_fld_otr123">
                            <label for="register_input">Confirm password<sup class="astrix">*</sup></label> 
                            <input type="password"  
 name="user_cpassword" id="user_cpassword" placeholder="Enter confirm password" class="register_input" />
                        </div>
                        <div class="clear"></div>
                        
                        <div class="input_fld_otr12">
                            <label for="register_input" class="captcha_reg">Captcha<span  style="color:red" >*</span>&nbsp;&nbsp;&nbsp;&nbsp;</label> 
                            <div class="captcha" id="captcha_id" style="margin-left: 2px;
                            margin-top: 20px;">
							
							<?php echo recaptcha_get_html($publickey); ?> </div>                  
                        </div>
                        <div class="clear"></div>
                        <div style="color:#F00; margin-left: 307px;" id="captchaStatus">&nbsp;</div> 
                        <div class="clear"></div>
                        
                        <div class="input_fld_otr123"><br />
                            <label for="register_input"></label> 
                            <span class="blogBtns btnPad" style="margin:2px">
                            <input type="submit" name="submit" id="btn_registration_submit" value="Register" class="button"></span>
                            Already have an account ? Click <a href="sign_in_user.php">here</a> to sign-in<br /><br /><br />
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

<script>
$(document).ready(function() {
	$("#registerform").validate({
		errorClass:"errors",  
		onkeyup: true,
		ignore: [],
		  debug: false,
		  rules: {
			user_name: {
				required: true,
				remote: 'checkusername.php',
					},
			user_email: {
					required: true,
					email: true,
					"remote":
					{
					  url: 'checkemail.php',
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
					user_gender: {
				required: true,

					},
			user_password: {
				required: true,
				minlength: 8,
			},
			user_cpassword: {
				required: true,
				minlength: 8,
				equalTo: "#user_password"
			},
			
		recaptcha_response_field:{
			required: true,
		},
		terms_condition: {
			required: true,
			},
		},
		messages: {
			user_name:
			{
				 required: "Please enter the username",
				  remote:"User name already exists"
			},
			user_email:
			{
				 required: "Please enter the email address",
				 remote: jQuery.validator.format("{0} is already exists.")
			},
			user_gender:
			{
				 required: "Please select the gender",
			},
			
			user_password: {
				required: "Please enter the password",
			},
			
				user_cpassword: {
				required: "Please enter the confirm password",
				equalTo: "Password and confirm password must be same",
			},

			
			recaptcha_response_field:{
			required: "Please enter the captcha"
		},
		terms_condition: {
				required: "You have to agree tutorname's terms of service and privacy policy.",
			},

			},
	submitHandler: function() { 
		challengeField = $("input#recaptcha_challenge_field").val();
		responseField = $("input#recaptcha_response_field").val();
		var html = $.ajax({
		type: "POST",
		url: "ajax.recaptcha.php",
		data: "recaptcha_challenge_field=" + challengeField + "&recaptcha_response_field=" + responseField,
		async: false
		}).responseText;
		if(html == "success")
		{
			$("#captchaStatus").html("Success. Processing form.");
		}
		else
		{
			$("#captchaStatus").html("Your captcha is incorrect. Please try again");
			Recaptcha.reload();
			return false;
		}
		document.registerform.submit();
	}
});

});
</script>
<style>
span[for=recaptcha_response_field] {
	top: -3px;
    position: absolute;
}


span[for=recaptcha_response_field] {
	
	display: block\9; /* IE 8 and below */

	*display: block; /* IE 7 and below */

	_display: block; /* IE 6 */
	
	display: block !ie; /* IE6, IE7  */
	
	display: block\0/; /* IE6, IE7  */

}

/* IE9, IE10 */
@media screen and (min-width:0\0) {
    span[for=recaptcha_response_field] {display: block}
}

/* IE 10+ */
@media screen and (-ms-high-contrast: active), (-ms-high-contrast: none) {
    span[for=recaptcha_response_field] {display: block}
}

</style>
<style>
@media screen and (max-width: 600px) {
	.lik ul li
	{
		float:none;
		margin-top:22px;
		margin-bottom:0 !important;
	}
}
</style>
