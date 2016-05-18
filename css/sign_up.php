<?
session_start(); ob_start(); include_once('lib/config.php'); include_once('lib/mysql_class.php');
$sql=new mysql();
$table="dynamic_register";
//print_r($_SESSION);
?>
<? include('html.php'); ?>
<!-- <body> -->

<? include('header.php');


$table_email="dynamic_content";
$where_email=" where web_page='sitemail'";
$site_email=$sql->select_query($table_email,$where_email); 

if(isset($_REQUEST['signup']))
{	

	if(isset($_REQUEST['plan_id']) && $_REQUEST['plan_id']=="free")
	{
		
		$field=array();
	
	$field['web_fname']=$_REQUEST['web_fname'];
	$field['web_dob']=$_REQUEST['web_dob'];
	$field['web_date']=date("Y-m-d");
    $field['web_email']=$_REQUEST['web_email'];
	
	 $field['web_package']=1;
	 
    $field['web_password']=$_REQUEST['web_password'];	
	$field['web_company_name']=$_REQUEST['web_company_name'];
	$field['web_subscription_status']=1;
	$field['paid_status']=1;	
	
	$res=$sql->add_query($field,$table);
	$last_insert_id=mysql_insert_id();
	if($res==true){$msg="Inserted successfully";  }	
	
	$subject = 'Reg: Dynamicoupons - Signup Confirmation';

	$mail_body = "<html><body>
	<table border=0 cellspacing=1cellpadding=1 width=100%>
	<tr><td height='25' align='left'>Dear ".$_REQUEST['web_fname'].",</td></tr><br>
	<tr><td height='25' align='left'>Thank you for signing up a Dynamicoupons website.</td></tr><br>
	<tr><td height='25' align='left'>Your registration was completed.</td></tr><br>
	<tr><td height='25' align='left' width='45%'>Please login to access your account using the URL below:</td></tr>
	<tr><td><a href='http://nskfix.com/dev/dynamicoupons/login.php'>
	http://nskfix.com/dev/dynamicoupons/login.php</a></td></tr><br>
	
	<tr><td height='25' align='left'>Email:  ".$_REQUEST['web_email']."</td></tr><br>
	<tr><td height='25' align='left'>Password:  ".$_REQUEST['web_password']."</td></tr>
	<tr height='25'></tr>
	<tr><td>Thanks,</td></tr><br>
	<tr><td width='35%'>Dynamicoupons Website Team!,
	<BR><a href='http://nskfix.com/dev/dynamicoupons/'>
	http://nskfix.com/dev/dynamicoupons/</a></td></tr>
	</table></body><html>";
	
	$from=stripslashes($site_email[0]['web_content']);
	$to=$_REQUEST['web_email'];
	$headers = 'From: '.$from.'\r\n'.'X-Mailer: PHP/' . phpversion();
	$headers = "From: " . strip_tags($from) . "\r\n";
	$headers .= "Reply-To: ". strip_tags($from) . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
	if (mail($to, $subject, $mail_body, $headers)) {
	
	?>
	<script>window.location.href='sign_up.php?action=send';</script>
	<?
	}
	
		else
	{
	?>
	<script> window.location='sign_up.php?action=fail';</script>
	<?	
	}
	
	
	}
	
	
	elseif(isset($_REQUEST['plan_id']) && $_REQUEST['plan_id']!= "" )
	{
	/*	
	$_SESSION['web_fname']=$_REQUEST['web_fname'];
	$_SESSION['web_dob']=$_REQUEST['web_dob'];
    $_SESSION['web_email']=$_REQUEST['web_email'];
    $_SESSION['web_password']=$_REQUEST['web_password'];	
	$_SESSION['web_company_name']=$_REQUEST['web_company_name'];
	$_SESSION['plan_id']=$_REQUEST['plan_id'];*/
	
		$field=array();
	
	$field['web_fname']=$_REQUEST['web_fname'];
	$field['web_dob']=$_REQUEST['web_dob'];
	$field['web_date']=date("Y-m-d");
    $field['web_email']=$_REQUEST['web_email'];
	
	 $field['web_package']=1;
	 
    $field['web_password']=$_REQUEST['web_password'];	
	$field['web_company_name']=$_REQUEST['web_company_name'];
	$field['web_subscription_status']=1;

	
	$res=$sql->add_query($field,$table);
	$last_insert_id=mysql_insert_id();
	
	
		
	
	?>
	<script>window.location.href='paypal_plan_sign_up.php?plan_id=<?=$_REQUEST['plan_id']?>&user_id=<?=$last_insert_id?>'</script>
	<?
	}
	
	else
	{
		
	?>                    
	<script>window.location.href='pricing.php';</script>
	<?	
		
	}
	
			
}

?>

<div class="middlesection">
    <div class="wrapper1">
    
    <div class="tabcontainer" style="clear:both;">
    
    <div class="title" style="float:left">Sign up</div>
    
        <div class="title" style="float:right"> <a href="login.php" style=" color: #E67E22; font-size: 18px;  text-decoration: none;">Login</a>

    
     <a href="forgetpassword.php" style="color: #E67E22; font-size: 18px;  text-decoration: none;">&nbsp;&nbsp;|&nbsp;&nbsp; Forgot password?&nbsp;&nbsp;</a></div>
     
     <div class="clear"></div>
        
    
    <div class="contentp" style="min-height:450px;">
    
    <? 
if($_REQUEST['action']=="send")
{ ?>
<div style=" font-size:15px; color:#0C3; height:30px; margin-left:145px;"> Thank you! You have been successfully registered to this site! Please login to continue!</div>
<? }
if($_REQUEST['action']=="fail")
{ ?>
<div style="font-size:15px; color:#FF0000; height:30px; margin-left:145px;">You have been unsuccessfully registered. Please try again!</div>
<? } ?> 
    
    <div class="center" style="margin-left:86px;">
    <form action="#" enctype="multipart/form-data" method="post" name="form_signup" autocomplete="off">
    <div class="clear"></div>
    <div class="space"></div>
    
    <div class="hd_left">Name<font color="#FF0000">*</font></div>
    <div class="colon">:</div>
    <div class="des">
    <input type="text" name="web_fname" id="web_fname" class="textbox" /></div>
    <div class="clear"></div>
    <div class="space"></div>
    
    <div class="hd_left">Birth date<font color="#FF0000">*</font></div>
    <div class="colon">:</div>
    <div class="des">
    <input type="text" name="web_dob" id="web_dob" class="textbox" /></div>
    <div class="clear"></div>
    <div class="space"></div>
    
    <div class="hd_left">Email Address<font color="#FF0000">*</font></div>
    <div class="colon">:</div>
    <div class="des">
    <input type="text" name="web_email" id="web_email" class="textbox" onChange='checkemail();' autocomplete="off"/></div>
    <div class="clear"></div>
    <div class="space"></div>
    
    <div class="hd_left">Password <font color="#FF0000">*</font></div>
    <div class="colon">:</div>
    <div class="des">
    <input type="password" name="web_password" id="web_password" class="textbox" autocomplete="off"/></div>
    <div class="clear"></div>
    <div class="space"></div>
    
    <div class="hd_left">Confirm Password<font color="#FF0000">*</font></div>
    <div class="colon">:</div>
    <div class="des">
    <input type="password" name="web_cpassword" id="web_cpassword" class="textbox" /></div>
    <div class="clear"></div>
    <div class="space"></div>
    
     <div class="hd_left">Company Name<font color="#FF0000">*</font></div>
    <div class="colon">:</div>
    <div class="des">
    <input type="text" name="web_company_name" id="web_company_name" class="textbox" /></div>
    <div class="clear"></div>
    <div class="space"></div>
    
    
    <div class="hd_left_1">&nbsp;</div>	
    <div class="colon">&nbsp;</div>		
    <div class="des deslog"><input class="button_s orange" type="submit" value='Sign up' name="signup"  onclick='return validation()'  />
    
  
   
     
     </div>	
    <div class="clear"></div>	             
    <div class="space"></div> 
    <? if(isset($_REQUEST['plan_id']) && $_REQUEST['plan_id']!="") { ?>
    <input type="hidden" name="plan_id" id="plan_id" value="<?=$_REQUEST['plan_id']?>" /> 
    <? } ?>
    </form>
    </div>
   </div>
    </div>
    </div>
 </div>
 <? include('footer.php'); ?>
 
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<!--<link rel="stylesheet" href="datepicker.css">-->
<!--<script src="//code.jquery.com/jquery-1.10.2.js"></script>-->
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script type="text/javascript">
function validation()
{
	
	web_fname = document.getElementById('web_fname').value;
	if(web_fname=="") 
	{ 
		alert("Please enter the name");
		document.getElementById('web_fname').select();	
		document.getElementById('web_fname').focus();			
		return false;
	}
	
	web_dob = document.getElementById('web_dob').value;
	if(web_dob=="") 
	{ 
		alert("Please choose date of birth");
		document.getElementById('web_dob').select();	
		document.getElementById('web_dob').focus();			
		return false;
	}
	
	web_email = document.getElementById('web_email').value;
	if(web_email=="") 
	{ 
		alert("Please enter the email address");
		document.getElementById('web_email').select();	
		document.getElementById('web_email').focus();			
		return false;
	}
	
	var emailcontent=document.getElementById('web_email').value;
	var emailid=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	if (emailcontent.length > 0)
    {
    if (emailid.test(emailcontent))
    {
    //return true;
    }
    else
    {
    alert("Invalid email address");
    return false;
    }
	}
	
	web_password = document.getElementById('web_password').value;
	if(web_password=="") 
	{ 
		alert("Please enter the password");
		document.getElementById('web_password').select();	
		document.getElementById('web_password').focus();			
		return false;
	}
	
	var str = web_password;
	var n = str.length;
	if(n>=6)
	{
		document.getElementById('web_password').focus();
	}
	else
	{
		alert('Password length should be 6 character');
		document.getElementById('web_password').focus();
		return false;
	}
  
	web_cpassword = document.getElementById('web_cpassword').value;
	if(web_cpassword=="") 
	{ 
		alert("Please enter the confirm password");
		document.getElementById('web_cpassword').select();	
		document.getElementById('web_cpassword').focus();			
		return false;
	}
	web_cpassword = document.getElementById('web_cpassword').value;
	if(web_password!=web_cpassword) 
	{ 
		alert("Password and confirm password should be same");
		document.getElementById('web_cpassword').select();	
		document.getElementById('web_cpassword').focus();			
		return false;
	}
	
	
	web_company_name = document.getElementById('web_company_name').value;
	if(web_company_name=="") 
	{ 
		alert("Please enter the company name");
		document.getElementById('web_company_name').select();	
		document.getElementById('web_company_name').focus();			
		return false;
	}
	
	
	
	
	

return true;
}

function isNumberKey(evt){
   var charCode = (evt.which) ? evt.which : event.keyCode
   if (charCode > 31 && (charCode < 48 || charCode > 57))
       return false;
   return true;
}

$(function() {
    $( "#web_dob" ).datepicker();
  });
  
  
function checkemail()
{

$.ajax({

type: 'post',

url: 'ajax/checkmail.php',
data: $('#web_email').serialize(),

success: function (result) {
//alert(result);
if(result==1){

alert("Email address already exists");
document.getElementById('web_email').value="";
document.getElementById('web_email').focus();

}
else{

}
}

});
}
</script>

<style type="text/css">
.hd_left{ width:125px;}
.des a{ text-align:left !important; color:#003; text-decoration:none; margin-left:10px; }

.des a:hover{ text-align:left !important; color:#55B5BA; font-weight:bold; text-decoration:none; }
</style>
 
