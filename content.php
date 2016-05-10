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
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Content - Wallys Weather</title>
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link rel="icon" href="Sliced images/favicon.png" type="image/x-icon">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="DESCRIPTION" content ="Wally's Weather is a weather page setup to make observations of major weather events across Australia but in particular the Queensland tropics. It has since become a popular site for people across Australia to discuss and ask questions about forecasts and weather information."/> 
<meta name="KEYWORDS" content="Wallys, Wallys Weather, Wally, Weather winter, sunny, Weather sunny, Australia weather detector,
australian weather, weather in australia, weather condition, australian weather, weather in australia, weather condition, Wally’s Weather page, Queensland tropics weather, Queensland tropics weather, weather events across Australia, weather information, road conditions, climate blogs and community communication, Synoptic Charts, Satellite Imagery, Forecast charts, Observation data " />

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
.faq_div
{
	font-family:Arial;
}
</style>
<div class="wrapper">
    <? include('header.php')?>
    <div class="clear"></div>
    <h1  class="hBotVal" style="padding:9px; color:#fff; text-align:center;">Content</h1>
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
                                                            <? } ?>

                     <!--<span style="color: #446586; font-weight:bold"> | </span>-->
                    <li><a class="back" id="hig_Menu" href="content.php">Content</a></li>
                     <?
                     if($_SESSION['user_id']!='')
                     {?>
                     <li><a class="back" href="logout.php">Logout</a></li>
                     
                     <? } ?>
                     <li><a class="back" href="location.php">Location</a></li>
                    </ul>
                    </div>
    <div class="box1" style="height: auto;line-height: 30px; font-family:Arial; font-size:15px; padding: 28px;">
    <img  src="images/cont_img.jpg" style="float: right;
    margin: 5px;
    padding: 5px;"/>
        Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
        The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. <br /><br />
        It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br /></br>
        It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br /></br>
        It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
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
@media screen and (max-width: 575px) {
	.lik ul li
	{
		float:none;
		margin-top:22px;
		margin-bottom:0 !important;
	}
}
</style>
