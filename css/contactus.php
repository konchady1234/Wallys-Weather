<? session_start(); ob_start();
include_once('lib/config.php');
include_once('lib/mysql_class.php');
$sql=new mysql(); 
//table aboutus
$table_contact="lbd_contact";
$where_contact="where web_id=2";
$res_contact=$sql->select_query($table_contact,$where_contact);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>lbdmarket - Contact Us</title>
<link href="css/stylz.css" type="text/css" rel="stylesheet" />
<link href="css/res_style.css" type="text/css" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<!--ads &flash news -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
 <link rel="stylesheet" href="css/bootstrap.min.css">
<!--<script type="text/javascript" src="js/jquery.jticker.min.js"></script>
<script type="text/javascript" src="js/jquery.jticker.js"></script>
    <script type="text/javascript">
      jQuery(function($) {
        $('.ticker').jTicker();
      });
    </script>-->
     <script src='https://www.google.com/recaptcha/api.js'></script>
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
   
    <!-- menu -->
<link href="css/menustyles.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/menuscript.js"></script>
<link rel="stylesheet" type="text/css" href="css/default.css" />		
<script src="js/modernizr.custom.js"></script>
<!--<link rel="stylesheet" href="css/style.ads.css">-->
<link rel="stylesheet" href="css/theme.css">
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery.validate.js"></script>
	<script type="text/javascript" src="js/additional-methods.js"></script>
    <link rel="stylesheet" href="css/jquery-ui.css">
<script type="text/javascript" src="js/jquery-ui.js"></script>	
</head>
<body>
<!-- For Failure message Start -->
<div id="contact_Errordialog" title="Failure" >
  <p>Your details Failed to send. Please try again.</p>
</div>

<!-- For Failure message End -->

<!-- For Failure message Start -->

<div id="contact_Successdialog" title="Success" >
  <p>Your details has been successfully submitted.</p>
</div>
		
<!-- For Failure message End -->
<script type="text/javascript">
$( "#contact_Errordialog" ).dialog({ autoOpen: false,modal: true });
 
</script>
<script type="text/javascript">
$( "#contact_Successdialog" ).dialog({ autoOpen: false,modal: true,close: function() {
                //some code
window.location="contactus.php";				
 } });
 
</script>
    <SCRIPT language=Javascript>
      <!--
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
      //-->
   </SCRIPT>
<?
if(isset($_REQUEST['contact_Submit']))
{
$usrid=$_REQUEST['usrid']; 
$web_first_name=$_REQUEST['web_first_name'];
$web_last_name=$_REQUEST['web_last_name'];  
$email=$_REQUEST['cmail']; 
$contactno=$_REQUEST['contno'];
$city=$_REQUEST['ccity'];
$organization=$_REQUEST['corg'];
$msg=$_REQUEST['cmsg']; 

?>
<?

$to=get_symbol($res_contact[0]['web_email']) ;
$subject="Lbdmarket_Contact";
$message .= "<table style='font-family:arial;font-size:12px;'>";
if(isset($_SESSION['lid'])&& $_SESSION['lid']!="")
$message .= "<tr><td style='text-align:right'><strong>User id:</strong></td><td>".$usrid."</td></tr><tr><td height='10px;'></td></tr>"; 
$message .= "<tr><td style='text-align:right'><strong>First Name:</strong></td><td>".$web_first_name."</td></tr><tr><td height='10px;'></td></tr>"; 
if($web_last_name!=''){
	$message .="<tr><td style='text-align:right'><strong>Last Name:</strong></td><td>".$web_last_name."</td></tr><tr><td height='10px;'></td></tr>";
}
$message .="<tr><td style='text-align:right'><strong>Email:</strong></td><td>".$email."</td></tr><tr><td height='10px;'></td></tr>";
				 if($contactno!='') {
				  $message .= "<tr><td style='text-align:right'><strong>Contact Number:</strong></td><td>".$contactno."</td></tr><tr><td height='10px;'></td></tr>";
				  }
				   $message .= "<tr><td style='text-align:right'><strong>City:</strong></td><td>".$city."</td></tr><tr><td height='10px;'></td></tr>";
				 if($organization!='') {
				 $message .= "<tr><td style='text-align:right'><strong>Organization:</strong></td><td>".$organization."</td></tr><tr><td height='10px;'></td></tr>"; }
					 				 
				 $message .= "<tr><td style='text-align:right'><strong>Message:</strong></td><td>".$msg."</td></tr><tr><td height='10px;'></td></tr>";  
				 "</table>";
				 $from=$email;
				 $headers = 'From: '.$from.'\r\n'.'X-Mailer: PHP/' . phpversion();
$headers = "From: " . strip_tags($from) . "\r\n";
$headers .= "Reply-To: ". strip_tags($from) . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
if(mail($to, $subject, $message, $headers))
{
?>
<script>$( "#contact_Successdialog" ).dialog( "open" );</script>
<?
}
else
{
?>
<script>$( "#contact_Errordialog" ).dialog( "open" );</script>
<?

}
}
?>

<div class="wrapper">	
<div id="container">
<?php include('login.php');?>
<?php include('header.php'); ?>

<div class="middle-section">
<div class="middle-contacttitle"><?=get_symbol( $res_contact[0]['web_title']); ?></div>
<div class="border-line"></div>
<div class="col-sm-6">
<div class="cont_address"> <?=get_symbol( $res_contact[0]['web_content']); ?>
</div>
</div>
<div class="col-sm-6">

<div class="middle-contactleft">
          
<form name="frm_contact" id="frm_contact" action="" method="post" enctype="multipart/form-data" class="contact_form"  />
<input type="hidden" name="action" value="submit" />

<?
$table_con="lbd_users";
$where_con="where web_id ='".$_SESSION['lid']."'";
$res_con=$sql->select_query($table_con,$where_con);	
?>
<!--<div class="cont_left">Name:<font color=#FF0000>* </font></div>
<div class="cont_des"><input type="text" name="uname" class="form-control" id="uname" placeholder="Name" value="<?=get_symbol($res_con[0]['web_name'])?>"/> </div>-->
 <div class="cont_left">Name:<font color=#FF0000>* </font></div>
      <div class="cont_des_initial">
			<select class="form-control"  Id="web_initial" name="web_initial" />
			<option value="Mr"<?php if($res_con[0]['web_initial']=="Mr" ){ echo "Selected"; } ?> >Mr</option>
			<option value="Miss"<?php if($res_con[0]['web_initial']=="Miss"){ echo "Selected";} ?>>Miss</option>
			<option value="Ms"<?php if($res_con[0]['web_initial']=="Ms"){ echo "Selected";} ?>>Ms</option>
			<option value="Mrs"<?php if($res_con[0]['web_initial']=="Mrs"){ echo "Selected";} ?>>Mrs</option>
			</select>
			</div>
			 <div class="cont_des_first_name">
            <input type="text" name="web_first_name" class="form-control" id="web_first_name" placeholder="First Name" value="<?=get_symbol($res_con[0]['web_first_name'])?>" >
			 </div> 
              <div class="cont_des_last_name">
            <input type="text" name="web_last_name" class="form-control" id="web_last_name" placeholder="Last Name" value="<?=get_symbol($res_con[0]['web_last_name'])?>"> 
             </div>
		 
         
<div class="clear"></div>
<div class="cspace"></div>
<div class="cont_left">Email:<font color=#FF0000>* </font></div>
<div class="cont_des"><input type="text" name="cmail" class="form-control" id="cmail" placeholder="Email" value="<?=get_symbol($res_con[0]['web_mail'])?>"/> </div>
<div class="clear"></div>
<input type="hidden" name="usrid" class="form-control" id="usrid" value="<?=get_symbol($res_con[0]['web_user_id'])?>" />
<div class="clear"></div>
<div class="cspace"></div>
<div class="cont_left">Contact Number:<font color=#FF0000>* </font></div>
<div class="cont_des"><input type="text" name="contno" class="form-control" id="contno" placeholder="Contact Number" maxlength="13"  value="<?=get_symbol($res_con[0]['web_phone'])?>" onkeypress="return isNumberKey(event)" /> </div>
<div class="clear"></div>
<div class="cspace"></div>
<div class="cont_left">City:<font color=#FF0000>* </font></div>
<?php
					$where=" where id='".get_symbol($res_con[0]['web_district'])."'";
					$state_res=$sql->select_query("cities",$where);
										?>
<div class="cont_des"><input type="text" name="ccity" class="form-control" id="ccity" placeholder="City"  value="<? echo $state_res[0]['name'];?>" /> </div>
<div class="clear"></div>
<div class="cspace"></div>
<div class="cont_left">Organisation:</div>
<div class="cont_des"><input type="text" name="corg" class="form-control" id="corg" placeholder="Organisation" /> </div>
<div class="clear"></div>
<div class="cspace"></div>
<div class="cont_left">Message:<font color=#FF0000>* </font></div>
<div class="cont_des"><!--<textarea name="cmsg" id="cmsg"  class="form-control" placeholder="Message"  />--> <textarea placeholder="Enter the message" id="cmsg" name="cmsg" class="form-control"></textarea> </div>
<div class="clear"></div>
<div class="cspace"></div>
<div class="cont_left">Captcha:<font color=#FF0000>* </font></div>
<div class="des-captcha"><!--<div class="g-recaptcha" id="captcha" data-sitekey="6LeiGhUTAAAAAJ-4USIg_LapMCOB4jWTGaZjGxJG"></div></div>-->
 <div class="g-recaptcha" data-sitekey="6LeiGhUTAAAAAJ-4USIg_LapMCOB4jWTGaZjGxJG"></div>
                      <input type="hidden" title="Please verify that you are not a robot." class="my_cpa hiddencode required" name="hiddencode" id="hiddencode"></div>  
<div class="clear"></div>
<div class="cspace"></div>
<div class="button1">                
<input class="submit_btn" type="submit" value="Send" name="contact_Submit" Id="contact_Submit"/>
<input class="submit_btn" type="submit" value="Cancel" name="cancel" id="cancel" onClick="window.location.href='contactus.php'"  />
</div>

</form>

</div>
</div>
<div class="clear"></div>
<?php include('footer.php'); ?>

</div>
</div>
</div>
   

<div class="clear"></div>

<!-- Popup Div Ends Here -->

</body>
</html>
<script type="text/javascript">
(function($,W,D)
{
    var JQUERY4U = {};
    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $('#frm_contact').validate({
             ignore: ":hidden:not(.my_cpa)",
               rules: {   web_first_name: {required:true},
			cmail: {
				required: true,
				minlength: 5,
				email: true,
				},
				ccity:{required:true},
				cmsg:{required: true,
maxlength :150,},
contno:{required:true},

				    
                   "hiddencode": {
                       required: function() {
                           if(grecaptcha.getResponse() == '') {
                               return true;
                           } else {
                               return false;
                           }
                       }
                   }
               },
			   messages:{
			web_first_name:{required:"Enter the  first name"},
			cmail: {
				required: "Please enter the email address",
				minlength: "Your email must be at least 5 characters long",
				email:"Please enter the valid email address"
				},
				ccity:{required:"Please enter the  city"},
				cmsg: {
required: "Please enter the message",
maxlength:"Maximum 150 characters allowed"
},
contno:{required:"Please enter the phone number"},
				
		}
			   
            });
        }
    }
    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
    });
})(jQuery, window, document);
</script>
<script>
function isNumberKey(evt) {
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	// Added to allow decimal, period, or delete
	if (charCode == 110 || charCode == 190 || charCode == 46) 
		return true;
	
	if (charCode > 31 && (charCode < 48 || charCode > 57)) 
		return false;
	
	return true;
} // isNumberKey
</script>
<style>
@media screen and (max-width: 768px) 
{
	.cont_left, .cont_des
	{
		text-align:left;
	}
} 
</style>

  
 