
<?
session_start(); ob_start(); include_once('lib/config.php'); include_once('lib/mysql_class.php');
$sql=new mysql();
$table="dynamic_register";


if($_REQUEST['user_id']!="")
{
	$_SESSION['user_id']=$_REQUEST['user_id'];
}


if($_SESSION['user_id']=="" )
{
header('Location:login.php');exit();
}	
	

if(isset($_REQUEST['action']) && $_REQUEST['action']=="edit_changable" )// not used as edit is made free for both free and paid coupons
{
	 $where_edit=" where web_id=".$_SESSION['cid']; 
	
$field['web_coupon_title']=$_SESSION['web_coupon_title'];

	$val=$_SESSION['web_coupon_expiredate'];
	$date = strtotime("+$val day");
    $expaire=date('Y-m-d', $date);
	$field['web_coupon_expiredate']=$expaire;	
	$field['web_coupon_expaire']=$_SESSION['web_coupon_expiredate'];
	
	
			
/*	$field['web_coupon_expiredate']=$_SESSION['web_coupon_expiredate'];	
	$field['web_coupon_expaire']=$_SESSION['web_coupon_expaire'];*/
	
	
	
	
	$field['web_ccategory']=$_SESSION['web_ccategory'];
	$field['web_coupon_ownername']=($_SESSION['web_coupon_ownername']);		
	$field['web_coupon_bname']=$_SESSION['web_coupon_bname'];
	
	if($_SESSION['web_coupon_url']!="")
	{
		$field['web_coupon_url']=$_SESSION['web_coupon_url'];
	}
	
	else
	{
		$field['web_coupon_url']="#";
	}
	//$field['web_coupon_url']=$_SESSION['web_coupon_url'];
	$field['web_coupon_details']=($_SESSION['web_coupon_details']);		
	$field['web_coupon_email']=$_SESSION['web_coupon_email'];	
	$field['web_coupon_image']=$_SESSION['web_coupon_image']; //$_REQUEST['web_coupon_image'];
	$field['web_coupon_address']=($_SESSION['web_coupon_address']);		
	$field['web_coupon_state']=$_SESSION['web_coupon_state'];	
	$field['web_coupon_city']=$_SESSION['web_coupon_city'];
	$field['web_coupon_country']=($_SESSION['web_coupon_country']);		
	$field['web_coupon_zipcode']=($_SESSION['web_coupon_zipcode']);		
	$field['web_coupon_postalcode']=($_SESSION['web_coupon_postalcode']);		
	$field['web_coupon_id']=$_SESSION['web_coupon_id'];	
	$field['web_coupon_package']=$_SESSION['web_coupon_package'];
	$field['web_coupon_opendate']=$_SESSION['web_coupon_opendate'];	
	$field['web_coupon_circulation']=$_SESSION['web_coupon_circulation'];
	$field['web_capture_info']=$_REQUEST['web_capture_info'];
	
	$res=$sql->update_query($field,"dynamic_create_coupons",$where_edit);	
	
	?> <script>window.location.href ="myaccount.php"; alert("Success! Coupon has been successfully edited.");</script> <?
          
exit;	
}
if(isset($_REQUEST['action']) && $_REQUEST['action']=="package" )
{


	$field['web_package']=$_REQUEST['plan_id'];
	$field['web_txn']=$_REQUEST['tx'];
	$field['web_subscription_status']=1;
	$field['web_total_amount']=$_REQUEST['amt'];
	$field['web_subscribed_coupons']="";
	
	$field['web_date']=date("Y-m-d");
	$_SESSION['user_id']=$_REQUEST['user_id'];

	$where="where web_id=".$_SESSION['user_id'];	
	$res=$sql->update_query($field,$table,$where);
	if($res==true){	$msg="Updated  successfully!"; header('Location:myaccount.php');exit();}	
		
}



if(isset($_REQUEST['action']) && $_REQUEST['action']=="fromsignup" )
{


$table_email="dynamic_content";
$where_email=" where web_page='sitemail'";
$site_email=$sql->select_query($table_email,$where_email); 
	
		$field=array();
	
	$field['paid_status']=1;
/*	$field['web_dob']=$_SESSION['web_dob'];
    $field['web_email']=$_SESSION['web_email'];
    $field['web_password']=$_SESSION['web_password'];	
	$field['web_company_name']=$_SESSION['web_company_name'];
	
	
	
	$field['web_package']=$_SESSION['plan_id'];
	$field['web_txn']=$_SESSION['tx'];
	$field['web_subscription_status']=1;
	$field['web_total_amount']=$_SESSION['amt'];
	$field['web_subscribed_coupons']="";
	
	$field['web_date']=date("Y-m-d");*/

	
	$res=$sql->update_query($field,$table," where web_id=".$_REQUEST['user_id']);
$fetch_cd_s=$sql->select_query($table," where web_id=".$_REQUEST['user_id']);
	
	$_SESSION['user_id']=$_REQUEST['user_id'];
	$_SESSION['web_email']=$fetch_cd_s[0]['web_email'];
	
	$subject = 'Reg: Dynamicoupons - Signup Confirmation';

	 $mail_body = "<html><body>
	<table border=0 cellspacing=1cellpadding=1 width=100%>
	<tr><td height='25' align='left'>Dear ".$fetch_cd_s[0]['web_fname'].",</td></tr><br>
	<tr><td height='25' align='left'>Thank you for signing up a Dynamicoupons website.</td></tr><br>
	<tr><td height='25' align='left'>Your registration was completed.</td></tr><br>
	<tr><td height='25' align='left' width='45%'>Please login to access your account using the URL below:</td></tr>
	<tr><td><a href='http://nskfix.com/dev/dynamicoupons/login.php'>
	http://nskfix.com/dev/dynamicoupons/login.php</a></td></tr><br>
	
	<tr><td height='25' align='left'>Email:  ".$fetch_cd_s[0]['web_email']."</td></tr><br>
	<tr><td height='25' align='left'>Password:  ".$fetch_cd_s[0]['web_password']."</td></tr>
	<tr height='25'></tr>
	<tr><td>Thanks,</td></tr><br>
	<tr><td width='35%'>Dynamicoupons Website Team!,
	<BR><a href='http://nskfix.com/dev/dynamicoupons/'>
	http://nskfix.com/dev/dynamicoupons/</a></td></tr>
	</table></body><html>";
	
	$from=stripslashes($site_email[0]['web_content']);
	
	$act_sing_up_mail=$sql->select_query("dynamic_register"," where web_id=".$_REQUEST['user_id']);
	$to=$act_sing_up_mail[0]['web_email'];
	
	$_SESSION['web_email']=$to;
	$_SESSION['web_id']=$_REQUEST['web_email'];
	
	$headers = 'From: '.$from.'\r\n'.'X-Mailer: PHP/' . phpversion();
	$headers = "From: " . strip_tags($from) . "\r\n";
	$headers .= "Reply-To: ". strip_tags($from) . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$ok= mail($to, $subject, $mail_body, $headers);
	

	
	if($ok){ ?>
		<script>window.location="myaccount.php";</script> 
		<?	 exit;}	
		
	
		
		
}


else
{

$sql->delete_query("dynamic_register"," where paid_status=0");	
	
}





$result=$sql->select_query($table,"where web_id=".$_SESSION['user_id']);


$select_sub_packz=$sql->select_query($tablez," where web_id=".$_SESSION['user_id']);
$plan_detailsz=$sql-> select_query("dynamic_pricelist"," where web_id=".$select_sub_packz[0]['web_package']);
$started_dtaez=$select_sub_packz[0]['web_date'];
$datez = strtotime("+1 month", strtotime($started_dtaez));
$expiration_datez=date('Y-m-d', $datez);
		
		

require_once('ajax/recaptchalib.php');
$publickey = "6LezYxETAAAAABo0AEAnaO_9IAoXjko3-Y_nt31x"; // you got this from the signup page
$privatekey = "6LezYxETAAAAALqkuilnU7dR_hjBbM__z0_CeLPB";


$table_email="dynamic_content";
$where_email=" where web_page='sitemail'";
$site_email=$sql->select_query($table_email,$where_email); 

			if($_REQUEST['action']=="delete")
			{				
			$where_del="where cid =".$_REQUEST['cid']." limit 1";		
			$res=$sql->delete_query($table,$where_del);
			if($res==true){$msg="deleted  successfully!";}	
			?>
			<script>window.location.href ="myaccount.php#tab4"; alert("Deleted successfully!");  </script>		<?
			}	

if(isset($_REQUEST['signup']))
{	
	$field=array();
	
	$field['web_fname']=$_REQUEST['web_fname'];
	$field['web_dob']=$_REQUEST['web_dob'];
    $field['web_email']=$_REQUEST['web_email'];
    $field['web_password']=$_REQUEST['web_password'];	
	$field['web_company_name']=$_REQUEST['web_company_name'];	
	$where="where web_id=".$_SESSION['user_id'];	
	$res=$sql->update_query($field,$table,$where);
	if($res==true){	$msg="Updated  successfully!"; header('Location:myaccount.php');                                                                                                                                                                                                                                                                                                                                                                                                 exit();}	

}

if(isset($_REQUEST['change']))
{	
	$field=array();				
	$field['web_password']=$_REQUEST['newpassword'];				
			
	$where="where web_id=".$_SESSION['user_id'];
	$res2=$sql->update_query($field,$table,$where);
	
	if($res2==true){		
	     $msg=1;	?>
         <script>window.location.href ="myaccount.php"; alert("Password updated successfully!");  </script>
	    <?
	                      }	
}


/*=========================request shared email data separately for individual coupon=============================*/


if($_REQUEST['action']=='request_shared_email') { 

   $field_status['web_capture_info']=1;

  $coupon_info=$sql->update_query($field_status,"dynamic_create_coupons"," where web_id=".$_REQUEST['cid']); 
	
   $coupon_email=$sql->select_query("dynamic_create_coupons"," where web_id=".$_REQUEST['cid']);

   
   /*$subject="Shared Data for coupon: ".$coupon_email[0]['web_coupon_id'];
	
   $message = "<html><body>
	<table border=0 cellspacing=1cellpadding=1 width=100%>
	<tr><td height='25' align='left'>Hai,</td></tr><br>
	<tr><td height='25' align='left'>Merchant has sent this email from you who has just requested the shared information for below coupon only..</td></tr><br>
	
	<tr><td height='25' align='left'>Coupon number: ".$coupon_email[0]['web_coupon_id']."</td></tr>
	<tr><td height='25' align='left'>Coupon title: ".get_symbol($coupon_email[0]['web_coupon_title'])."</td></tr>
	<tr><td height='25' align='left'>Coupon expire: ".$coupon_email[0]['web_coupon_expiredate']."</td></tr>
	<tr><td height='25' align='left'>Sender email: ".$coupon_email[0]['web_coupon_email']."</td></tr><br>
    <tr><td height='25' align='left'>**Do not reply this email** </td></tr>
	
	<tr height='25'></tr>
	<tr><td>Thanks,</td></tr><br>
	<tr><td width='35%'>Dynamicoupons Website Team!,
	<BR><a href='http://nskfix.com/dev/dynamicoupons/'>
	http://nskfix.com/dev/dynamicoupons/</a></td></tr>
	</table></body><html>";
	
	//print_r($message); exit;
$table_email="dynamic_content";
$where_email=" where web_page='sitemail'";
$site_email=$sql->select_query($table_email,$where_email); 

	$from=$coupon_email[0]['web_coupon_email'];
	$to=$site_email[0]['web_content'];
	$headers = 'From: '.$from.'\r\n'.'X-Mailer: PHP/' . phpversion();
	$headers = "From: " . strip_tags($from) . "\r\n";
	$headers .= "Reply-To: ". strip_tags($from) . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	if($mail_send = mail($to, $subject, $message, $headers))
	{
    */
	?>
	<script>window.location.href ="myaccount.php";</script>
	<?
	//}
	/*else
	{
	?>
	<script>window.location.href ="myaccount.php";</script>
	<?
	}*/
}




if($_REQUEST['action']=='inform') { ?>
         <script>window.location.href ="paypal_capture_amount.php?cid=<?=$_REQUEST['cid']?>&action=inform"; </script>
	    <?
}

if($_REQUEST['action']=='email_status') { 
   
   $fetch_c_det=$sql->select_query("dynamic_create_coupons"," where web_id=".$_REQUEST['cid']);
   $field_status['web_capture_info']=$_REQUEST['web_capture_info'];
   
   if($_REQUEST['web_coupon_circulation_exceed']==1)
   {
	$field_status['web_coupon_circulation']=$_REQUEST['circ_no']+100;   
	   
   }

$field_status['paid_status_merchant_coupon']=1;
 $subject="Activate your coupon: ".$fetch_c_det[0]['web_coupon_id'];
	
	$message ="<html><head><title>Contact</title></head><body>".
	"<table style='font-family:arial;font-size:12px;'>". 
	"<tr><td style='text-align:left'>Hi,</td></tr><tr><td></td></tr>".
	
	"<tr><td style='text-align:left'><BR>NOTE: Please copy and paste the entire link below in the browser window to activate your coupon, alternatively you can click on the link to activate your post</td></tr>".
	
	"<tr><td style='text-align:left'><BR><a href='http://nskfix.com/dev/dynamicoupons/view_coupons.php?cid=".$fetch_c_det[0]['web_id']."'>http://nskfix.com/dev/dynamicoupons/view_coupons.php?cid=".$fetch_c_det[0]['web_id']."</a></td></tr>".
	
	"<tr><td style='text-align:left'><BR>We suggest that you save this email for future use.</td></tr>".
	"<tr><td style='text-align:left'><BR><BR>Sincerely,</td></tr>".
	"<tr><td style='text-align:left'><BR>The Dynamicoupons Help Team
	<BR><BR><a href='http://nskfix.com/dev/dynamicoupons/index.php'>
http://nskfix.com/dev/dynamicoupons/index.php</a></td></tr>".
	
	
	"</table>";
	"</body></html>";
	
	//print_r($message); exit;
	
	
	$table_email="dynamic_content";
$where_email=" where web_page='sitemail'";
$site_email=$sql->select_query($table_email,$where_email); 

	$from=$site_email[0]['web_content'];
	$to=$_REQUEST['web_coupon_email'];
	$headers = 'From: '.$from.'\r\n'.'X-Mailer: PHP/' . phpversion();
	$headers = "From: " . strip_tags($from) . "\r\n";
	$headers .= "Reply-To: ". strip_tags($from) . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	if($mail_send = mail($to, $subject, $message, $headers))
	{
		$select_sub_pack=$sql->select_query("dynamic_register"," where web_id=".$_SESSION['user_id']);
$field_register['web_subscribed_coupons']=$select_sub_pack[0]['web_subscribed_coupons']+1;

	$sql->update_query($field_register,"dynamic_register"," where web_id=".$_SESSION['user_id']); 
	
	?>
	<script>window.location.href ="myaccount.php"; alert("Success! Please check your email inbox for activation link!");</script>
	<?
	}
	
	
   $coupon_info=$sql->update_query($field_status,"dynamic_create_coupons"," where web_id=".$_REQUEST['cid']); 
	
  // $coupon_email=$sql->select_query("dynamic_create_coupons"," where web_id=".$_REQUEST['cid']);
   
   /*$subject="Shared Data for coupon: ".$coupon_email[0]['web_coupon_id'];
	
   $message = "<html><body>
	<table border=0 cellspacing=1cellpadding=1 width=100%>
	<tr><td height='25' align='left'>Hai,</td></tr><br>
	<tr><td height='25' align='left'>Merchant has sent this email from you who has just requested the shared information for below coupon only..</td></tr><br>
	
	<tr><td height='25' align='left'>Coupon number: ".$coupon_email[0]['web_coupon_id']."</td></tr>
	<tr><td height='25' align='left'>Coupon title: ".get_symbol($coupon_email[0]['web_coupon_title'])."</td></tr>
	<tr><td height='25' align='left'>Coupon expire: ".$coupon_email[0]['web_coupon_expiredate']."</td></tr>
	<tr><td height='25' align='left'>Sender email: ".$coupon_email[0]['web_coupon_email']."</td></tr><br>
    <tr><td height='25' align='left'>**Do not reply this email** </td></tr>
	
	<tr height='25'></tr>
	<tr><td>Thanks,</td></tr><br>
	<tr><td width='35%'>Dynamicoupons Website Team!,
	<BR><a href='http://nskfix.com/dev/dynamicoupons/'>
	http://nskfix.com/dev/dynamicoupons/</a></td></tr>
	</table></body><html>";
	
	//print_r($message); exit;
$table_email="dynamic_content";
$where_email=" where web_page='sitemail'";
$site_email=$sql->select_query($table_email,$where_email); 

	$from=$coupon_email[0]['web_coupon_email'];
	$to=$site_email[0]['web_content'];
	$headers = 'From: '.$from.'\r\n'.'X-Mailer: PHP/' . phpversion();
	$headers = "From: " . strip_tags($from) . "\r\n";
	$headers .= "Reply-To: ". strip_tags($from) . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	if($mail_send = mail($to, $subject, $message, $headers))
	{
    
	?>
	<script>window.location.href ="myaccount.php";</script>
	<?
	}
	else
	{*/
	?>
	<script>window.location.href ="myaccount.php";</script>
	<?
/*	}*/
}

else

{
	
$sql->delete_query("dynamic_create_coupons"," where web_coupon_status=0 and paid_status_merchant_coupon=0");	
	
}





if((isset($_REQUEST['save']) && $_REQUEST['cid']==''))
{
	
$select_sub_pack=$sql->select_query($table," where web_id=".$_SESSION['user_id']);
// print_r($select_sub_pack);
	$plan_details=$sql-> select_query("dynamic_pricelist"," where web_id=".$select_sub_pack[0]['web_package']);
	$started_dtae=$select_sub_pack[0]['web_date'];
		
		/*if(($started_dtae=='') || ($started_dtae==0))
		{ ?>
        <input class="button_s orange" type="submit" value='Save Coupon' name="save"  onclick='return coupon_validation()'  />
    	<input class="button_s orange" type="submit" value='Cancel' name="back"  onclick='return homepage()'  />
		<? } 
		else
		{*/
		$date = strtotime("+1 month", strtotime($started_dtae));

		$expiration_date=date('Y-m-d', $date);
	
?>
<?

	/*	if($expiration_date>=date('Y-m-d')){*/
			
			
			
			
	
	$web_img=$_FILES['web_coupon_image']['name'];

if($web_img!='')
	{
		list($width, $height) = getimagesize($_FILES['web_coupon_image']['tmp_name']);
		if($_FILES['web_coupon_image']['size'] >=1024000)
		{
		?>
				<script>
				alert("The image size should be less than 1MB.");
				window.location="myaccount.php";
                </script>
         <?
		 }
		 elseif($width<400)
		 {
			 
			$up=$_FILES['web_coupon_image']['name'];
			$srce = $_FILES['web_coupon_image']['tmp_name'];
			$orgi = "webupload/original/coupons/".$up;
			$thumb = "webupload/thumb/coupons/";
			move_uploaded_file($srce,$orgi);
			$imgname = time().$up;
			$parts=explode(".",$imgname);
			 $up=$parts[0].".png"; 
			include_once('imgresize.php');
			resize($orgi, $thumb.$up, $width, $height); 
			 $imgname=$up; 
						
		 }	
		 else
		 {
	    $imgname = ($web_img);
		$source = $_FILES['web_coupon_image']['tmp_name'];		    
		include("resize-class.php");
		$originalpath  = "webupload/original/coupons/".$imgname;
		$thumbnailpath = "webupload/thumb/coupons/".$imgname;		
		move_uploaded_file($source,$originalpath);	
		$height_1 = (($height * 400) / $width);	
		$resizeObj = new resize($originalpath);	
		
		$resizeObj -> resizeImage(400, $height_1, 'crop');
		$resizeObj -> saveImage($thumbnailpath, 100);
		 }
		 		
			
	}
	else { $imgname=($_REQUEST['theValue']); }

	
	$field=array();
	$field['web_coupon_title']=get_entity($_REQUEST['web_coupon_title']);
			
	$val=$_REQUEST['web_coupon_expiredate'];
	$date = strtotime("+$val day");
    $expaire=date('Y-m-d', $date);
	$field['web_coupon_expiredate']=$expaire;	
	$field['web_coupon_expaire']=$_REQUEST['web_coupon_expiredate'];
	
	$field['web_ccategory']=$_REQUEST['web_ccategory'];
	$field['web_coupon_ownername']=get_entity($_REQUEST['web_coupon_ownername']);		
	$field['web_coupon_bname']=$_REQUEST['web_coupon_bname'];
	
	if($_REQUEST['web_coupon_url']!="")
	{
	$field['web_coupon_url']=$_REQUEST['web_coupon_url'];
	}
	
	else
	{
	$field['web_coupon_url']="#";	
	}
		
	//$field['web_coupon_url']=$_REQUEST['web_coupon_url'];
	$field['web_coupon_details']=get_entity($_REQUEST['web_coupon_details']);		
	$field['web_coupon_email']=$_REQUEST['web_coupon_email'];	
	$field['web_coupon_image']=$imgname; //$_REQUEST['web_coupon_image'];
	$field['web_coupon_address']=get_entity($_REQUEST['web_coupon_address']);		
	$field['web_coupon_state']=$_REQUEST['web_coupon_state'];	
	$field['web_coupon_city']=$_REQUEST['web_coupon_city'];
	$field['web_coupon_country']=get_entity($_REQUEST['web_coupon_country']);		
	$field['web_coupon_zipcode']=get_entity($_REQUEST['web_coupon_zipcode']);		
	$field['web_coupon_postalcode']=get_entity($_REQUEST['web_coupon_postalcode']);		
	$field['web_coupon_id']=$_REQUEST['web_coupon_id'];	
	$field['web_coupon_package']=$_REQUEST['web_coupon_package'];
	$field['web_coupon_circulation']=$_REQUEST['web_coupon_circulation'];
	$field['web_capture_info']=$_REQUEST['web_capture_info'];
	$field['web_coupon_opendate']=$_REQUEST['web_coupon_opendate'];	
		$field['web_user_id']=$_SESSION['user_id'];
		$where_sp=" where web_id=".$_SESSION['user_id'];
		$select_sub_pack=$sql->select_query($table,$where_sp);
	//print_r($select_sub_pack);
		
		$started_date=$expaire;	
	
		if($started_date>=date('d-m-Y')){
		$field['web_expired']=0;		
		}
		else
		{
		$field['web_expired']=1;		
		}
		
		
		
			if($result[0]['web_admin_user']==1) // if admin user, then no charge for any coupon
	{
		
		$field['paid_status_merchant_coupon']="1";	
	$res=$sql->add_query($field,"dynamic_create_coupons");
	if($res==true){$msg="Inserted successfully";  }	
	$cid_insert=mysql_insert_id();
	
	

	 $subject="Activate your coupon: ".$_REQUEST['web_coupon_id'];
	
	$message ="<html><head><title>Contact</title></head><body>".
	"<table style='font-family:arial;font-size:12px;'>". 
	"<tr><td style='text-align:left'>Hi,</td></tr><tr><td></td></tr>".
	
	"<tr><td style='text-align:left'><BR>NOTE: Please copy and paste the entire link below in the browser window to activate your coupon, alternatively you can click on the link to activate your post</td></tr>".
	
	"<tr><td style='text-align:left'><BR><a href='http://nskfix.com/dev/dynamicoupons/view_coupons.php?cid=".$cid_insert."'>http://nskfix.com/dev/dynamicoupons/view_coupons.php?cid=".$cid_insert."</a></td></tr>".
	
	"<tr><td style='text-align:left'><BR>We suggest that you save this email for future use.</td></tr>".
	"<tr><td style='text-align:left'><BR><BR>Sincerely,</td></tr>".
	"<tr><td style='text-align:left'><BR>The Dynamicoupons Help Team
	<BR><BR><a href='http://nskfix.com/dev/dynamicoupons/index.php'>
http://nskfix.com/dev/dynamicoupons/index.php</a></td></tr>".
	
	
	"</table>";
	"</body></html>";
	
	//print_r($message); exit;
	
	$from=$site_email[0]['web_content'];
	$to=$_REQUEST['web_coupon_email'];
	$headers = 'From: '.$from.'\r\n'.'X-Mailer: PHP/' . phpversion();
	$headers = "From: " . strip_tags($from) . "\r\n";
	$headers .= "Reply-To: ". strip_tags($from) . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$mail_send = mail($to, $subject, $message, $headers);
	
	?>
	<script>window.location.href ="myaccount.php"; alert("Success! Please check your email inbox for activation link!");</script>
	<?
	exit;
	
	}
	
	
	else
	{
		
	if($_REQUEST['cid']!="")// this condition will not be called
	{
		
	$field['web_coupon_status']="1";
	$where_edit_status="  where web_id='".$_REQUEST['cid']."'";
	$res_edit_status=$sql->select_query("dynamic_create_coupons",$where_edit_status);
	if($res_edit_status[0]['web_free_coupon_status']==1)
	{
	$_REQUEST['free_yes']=1;
	 $where_edit=" where web_id=".$_REQUEST['cid']; 
$field['web_coupon_title']=$_REQUEST['web_coupon_title'];

$val=$_REQUEST['web_coupon_expiredate'];
	$date = strtotime("+$val day");
    $expaire=date('Y-m-d', $date);
	$field['web_coupon_expiredate']=$expaire;	
	$field['web_coupon_expaire']=$_REQUEST['web_coupon_expiredate'];
	
			
	/*$field['web_coupon_expiredate']=$_REQUEST['web_coupon_expiredate'];	
	$field['web_coupon_expaire']=$_REQUEST['web_coupon_expaire'];*/
	$field['web_ccategory']=$_REQUEST['web_ccategory'];
	$field['web_coupon_ownername']=($_REQUEST['web_coupon_ownername']);		
	$field['web_coupon_bname']=$_REQUEST['web_coupon_bname'];
	
	if($_REQUEST['web_coupon_url']!="")
	{
		$field['web_coupon_url']=$_REQUEST['web_coupon_url'];
	}
	
	else
	{
		$field['web_coupon_url']="#";
	}
	//$field['web_coupon_url']=$_SESSION['web_coupon_url'];
	$field['web_coupon_details']=($_REQUEST['web_coupon_details']);		
	$field['web_coupon_email']=$_REQUEST['web_coupon_email'];	
	$field['web_coupon_image']=$_REQUEST['web_coupon_image']; //$_REQUEST['web_coupon_image'];
	$field['web_coupon_address']=($_REQUEST['web_coupon_address']);		
	$field['web_coupon_state']=$_REQUEST['web_coupon_state'];	
	$field['web_coupon_city']=$_REQUEST['web_coupon_city'];
	$field['web_coupon_country']=($_REQUEST['web_coupon_country']);		
	$field['web_coupon_zipcode']=($_REQUEST['web_coupon_zipcode']);		
	$field['web_coupon_postalcode']=($_REQUEST['web_coupon_postalcode']);		
	$field['web_coupon_id']=$_REQUEST['web_coupon_id'];	
	$field['web_coupon_package']=$_REQUEST['web_coupon_package'];
	$field['web_coupon_opendate']=$_REQUEST['web_coupon_opendate'];	
	$field['web_coupon_circulation']=$_REQUEST['web_coupon_circulation'];
	$field['web_capture_info']=$_REQUEST['web_capture_info'];
	
	$res=$sql->update_query($field,"dynamic_create_coupons",$where_edit);	
	
		?> <script>window.location.href ="myaccount.php"; alert("Success! Free Coupon has been successfully edited.");</script> <?
          
exit;	


/*======================= end free coupon edit (free no charge for edit option of free coupon) =======================================*/
	}
	else
	{
			?>
		<script>window.location.href ="paypal_edit_coupons.php"; </script>
		<?
		
 exit;
	}

	}
	
	else {
		
	if($select_sub_pack[0]['web_subscription_status']==1)
	{
		$plan_details=$sql-> select_query("dynamic_pricelist"," where web_id=".$select_sub_pack[0]['web_package']);
	
	
		//$plan_details['web_date'];
		
		if($expiration_date>=date('Y-m-d')){
			
		
/*echo "first=".$select_sub_pack[0]['web_free_coupon_status'];
echo "secndpack=".$select_sub_pack[0]['web_free_coupon_status']; */

	if($select_sub_pack[0]['web_free_coupon_status']==1  && $select_sub_pack[0]['web_free_coupon_status']==1) //if free coupon over
	{
		

		/*echo "num=".$plan_details[0]['web_numofcoupons'];
		echo "subc=".$select_sub_pack[0]['web_subscribed_coupons'];*/
		
	
	if($plan_details[0]['web_numofcoupons']> $select_sub_pack[0]['web_subscribed_coupons'])
	{	
		

	
	$field['web_coupon_status']="0";
	
if($_REQUEST['web_capture_info']==1 || $_REQUEST['web_coupon_circulation_exceed']==1) {
	
	$res=$sql->add_query($field,"dynamic_create_coupons");
	if($res==true){$msg="Inserted successfully";  }	
	$cid_insert=mysql_insert_id();
	
	
			?>
		<script>window.location.href ="paypal_capture_amount.php?cid=<?=$cid_insert;?>&circ_no=<?=$_REQUEST['web_coupon_circulation']?>&exceed=<?=$_REQUEST['web_coupon_circulation_exceed']?>&web_capture_info=<?=$_REQUEST['web_capture_info']?>"; </script>
		<?
		exit; }	
	
	$field['paid_status_merchant_coupon']="1";	
	$res=$sql->add_query($field,"dynamic_create_coupons");
	if($res==true){$msg="Inserted successfully";  }	
	$cid_insert=mysql_insert_id();
	
	

	 $subject="Activate your coupon: ".$_REQUEST['web_coupon_id'];
	
	$message ="<html><head><title>Contact</title></head><body>".
	"<table style='font-family:arial;font-size:12px;'>". 
	"<tr><td style='text-align:left'>Hi,</td></tr><tr><td></td></tr>".
	
	"<tr><td style='text-align:left'><BR>NOTE: Please copy and paste the entire link below in the browser window to activate your coupon, alternatively you can click on the link to activate your post</td></tr>".
	
	"<tr><td style='text-align:left'><BR><a href='http://nskfix.com/dev/dynamicoupons/view_coupons.php?cid=".$cid_insert."'>http://nskfix.com/dev/dynamicoupons/view_coupons.php?cid=".$cid_insert."</a></td></tr>".
	
	"<tr><td style='text-align:left'><BR>We suggest that you save this email for future use.</td></tr>".
	"<tr><td style='text-align:left'><BR><BR>Sincerely,</td></tr>".
	"<tr><td style='text-align:left'><BR>The Dynamicoupons Help Team
	<BR><BR><a href='http://nskfix.com/dev/dynamicoupons/index.php'>
http://nskfix.com/dev/dynamicoupons/index.php</a></td></tr>".
	
	
	"</table>";
	"</body></html>";
	
	//print_r($message); exit;
	
	$from=$site_email[0]['web_content'];
	$to=$_REQUEST['web_coupon_email'];
	$headers = 'From: '.$from.'\r\n'.'X-Mailer: PHP/' . phpversion();
	$headers = "From: " . strip_tags($from) . "\r\n";
	$headers .= "Reply-To: ". strip_tags($from) . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	if($mail_send = mail($to, $subject, $message, $headers))
	{
$field_register['web_subscribed_coupons']=$select_sub_pack[0]['web_subscribed_coupons']+1;

	$sql->update_query($field_register,$table," where web_id=".$_SESSION['user_id']); 
	
	?>
	<script>window.location.href ="myaccount.php"; alert("Success! Please check your email inbox for activation link!");</script>
	<?
	}
	else
	{
	?>
	<script>window.location.href ="myaccount.php"; alert("Message has not been send .Please try again!");</script>
	<?
	}
			
	}
	

	
	else
	{
	?>
	<script>window.location.href ="pricing.php"; alert("You have crossed your coupon limit .Please upgarde your subscription!");</script>
	<?	
	}
	
	}
	
		else
	{
		

			if($_REQUEST['cid']!='') { 
	$field['web_coupon_status']="1";
	$where_edit_status="  where web_id='".$_REQUEST['cid']."'";
	$res_edit_status=$sql->select_query("dynamic_create_coupons",$where_edit_status);
	if($res_edit_status[0]['web_coupon_editstatus']==1)
	{
		$field['web_coupon_editstatus']="2";
	}
	else if($res_edit_status[0]['web_coupon_editstatus']=='')
	{
	$field['web_coupon_editstatus']="1";
	}
	$where="where web_id=".$_REQUEST['cid'];
    $res_edit=$sql->update_query($field,"dynamic_create_coupons",$where);
	}
	else {
	
		/*----------------------free coupon---------------------*/
	$field['web_coupon_status']="0";
	$field['web_free_coupon_status']="1";
	
	$res=$sql->add_query($field,"dynamic_create_coupons"); 
	$cid1_insert=mysql_insert_id();
	$field_register['web_free_coupon_status']=1;
	
	$is_it_free_pack=mysql_fetch_array(mysql_query("select * from dynamic_register where web_id=".$_SESSION['user_id']));
	if($is_it_free_pack['web_package']==1)
	{
	$field_register['web_subscribed_coupons']=1;
	}
	
	
	$sql->update_query($field_register,$table," where web_id=".$_SESSION['user_id']);
	if($res==true){$msg="Inserted successfully";  }	
	
	 $subject="Activate your coupon: ".$_REQUEST['web_coupon_id'];
	
	$message ="<html><head><title>Contact</title></head><body>".
	"<table style='font-family:arial;font-size:12px;'>".
	"<tr><td style='text-align:left'>Hi,</td></tr><tr><td></td></tr>".
	
	"<tr><td style='text-align:left'><BR>NOTE: Please copy and paste the entire link below in the browser window to activate your coupon, alternatively you can click on the link to activate your post</td></tr>".
	
	"<tr><td style='text-align:left'><BR><a href='http://nskfix.com/dev/dynamicoupons/view_coupons.php?cid=".$cid1_insert."'>http://nskfix.com/dev/dynamicoupons/view_coupons.php?cid=".$cid1_insert."</a></td></tr>".
	
	"<tr><td style='text-align:left'><BR>We suggest that you save this email for future use.</td></tr>".
	"<tr><td style='text-align:left'><BR><BR>Sincerely,</td></tr>".
	"<tr><td style='text-align:left'><BR>The Dynamicoupons Help Team
	<BR><BR><a href='http://nskfix.com/dev/dynamicoupons/index.php'>
http://nskfix.com/dev/dynamicoupons/index.php</a></td></tr>".
	
	
	"</table>";
	"</body></html>";
	
	//print_r($message); exit;
	
	$from=$site_email[0]['web_content'];
	$to=$_REQUEST['web_coupon_email'];
	$headers = 'From: '.$from.'\r\n'.'X-Mailer: PHP/' . phpversion();
	$headers = "From: " . strip_tags($from) . "\r\n";
	$headers .= "Reply-To: ". strip_tags($from) . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	if($mail_send = mail($to, $subject, $message, $headers))
	{
	?>
	<script>window.location.href ="myaccount.php"; alert("Success! Please check your email inbox for activation link!");</script>
	<?
	}
	else
	{
	?>
	<script>window.location.href ="myaccount.php"; alert("Message has not been send .Please try again!");</script>
	<?
	}
	}		

	}
	
		}
		
		
		else
		{
			
		?>
         <script>window.location.href ="pricing.php"; alert("Your subscription package has expired. Please upgrade your package ");  </script>
	    <?
			
		}
		
		
	
}

else
{

			if(($_REQUEST['cid']!='')&&($_REQUEST['cid']!=0)) { 
			
			/*--------------edit coupon------------*/
			
	$field['web_coupon_status']="1";
	$where_edit_status="  where web_id='".$_REQUEST['cid']."'";
	$res_edit_status=$sql->select_query("dynamic_create_coupons",$where_edit_status);
	if($res_edit_status[0]['web_coupon_editstatus']==1)
	{
		$field['web_coupon_editstatus']="2";
	}
	else if($res_edit_status[0]['web_coupon_editstatus']=='')
	{
	$field['web_coupon_editstatus']="1";
	}
	$where="where web_id=".$_REQUEST['cid'];
    $res_edit=$sql->update_query($field,"dynamic_create_coupons",$where);
	}
	else {
		
		if($select_sub_pack[0]['web_free_coupon_status']!=1 || $select_sub_pack[0]['web_free_coupon_status']!="" )
		
		{
			
	$field['web_coupon_status']="0";
	$field['web_free_coupon_status']="1";
	$res=$sql->add_query($field,"dynamic_create_coupons");
	$cid2_insert=mysql_insert_id();
		$field_register['web_free_coupon_status']=1;
	$sql->update_query($field_register,$table," where web_id=".$_SESSION['user_id']);
	
	if($res==true){$msg="Inserted successfully";  }	
	
	 $subject="Activate your coupon: ".$_REQUEST['web_coupon_id'];
	
	$message ="<html><head><title>Contact</title></head><body>".
	"<table style='font-family:arial;font-size:12px;'>".
	"<tr><td style='text-align:left'>Hi,</td></tr><tr><td></td></tr>".
	
	"<tr><td style='text-align:left'><BR>NOTE: Please copy and paste the entire link below in the browser window to activate your coupon, alternatively you can click on the link to activate your post</td></tr>".
	
	"<tr><td style='text-align:left'><BR><a href='http://nskfix.com/dev/dynamicoupons/view_coupons.php?cid=".$cid2_insert."'>http://nskfix.com/dev/dynamicoupons/view_coupons.php?cid=".$cid2_insert."</a></td></tr>".
	
	"<tr><td style='text-align:left'><BR>We suggest that you save this email for future use.</td></tr>".
	"<tr><td style='text-align:left'><BR><BR>Sincerely,</td></tr>".
	"<tr><td style='text-align:left'><BR>The Dynamicoupons Help Team
	<BR><BR><a href='http://nskfix.com/dev/dynamicoupons/index.php'>
http://nskfix.com/dev/dynamicoupons/index.php</a></td></tr>".
	
	
	"</table>";
	"</body></html>";
	
	//print_r($message); exit;
	
	$from=$site_email[0]['web_content'];
	$to=$_REQUEST['web_coupon_email'];
	$headers = 'From: '.$from.'\r\n'.'X-Mailer: PHP/' . phpversion();
	$headers = "From: " . strip_tags($from) . "\r\n";
	$headers .= "Reply-To: ". strip_tags($from) . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	if($mail_send = mail($to, $subject, $message, $headers))
	{
	?>
	<script>window.location.href ="myaccount.php"; alert("Success! Please check your email inbox for activation link!");</script>
	<?
	}
	else
	{
	?>
	<script>window.location.href ="myaccount.php"; alert("Message has not been send .Please try again!");</script>
	<?
	}
	
	
	}
	
	else
	{
		
	?><script>window.location.href ="pricing.php"; alert("Your free coupon limit is over .Please subscribe any of our packages!");</script><?	
	}
	
	
}
	
	
}
	}


	}
	


?>


<?php /*?><? }



else
{
	
	
	?>
         <script>window.location.href ="pricing.php"; alert("Your subscription package has expired. Please upgrade your package ");  </script>
	    <?
		
		
}

?>
<?php */?>

<?


}




if((isset($_REQUEST['save']) && $_REQUEST['cid']!=''))
	{
		
			
	$web_img=$_FILES['web_coupon_image']['name'];

if($web_img!='')
	{
		list($width, $height) = getimagesize($_FILES['web_coupon_image']['tmp_name']);
		if($_FILES['web_coupon_image']['size'] >=1024000)
		{
		?>
				<script>
				alert("The image size should be less than 1MB.");
				window.location="myaccount.php";
                </script>
         <?
		 }
		 elseif($width<400)
		 {
			 
			$up=$_FILES['web_coupon_image']['name'];
			$srce = $_FILES['web_coupon_image']['tmp_name'];
			$orgi = "webupload/original/coupons/".$up;
			$thumb = "webupload/thumb/coupons/";
			move_uploaded_file($srce,$orgi);
			$imgname = time().$up;
			$parts=explode(".",$imgname);
			 $up=$parts[0].".png"; 
			include_once('imgresize.php');
			resize($orgi, $thumb.$up,$width, $height); 
			 $imgname=$up; 
						
		 }	
		 else
		 {
	    $imgname = ($web_img);
		$source = $_FILES['web_coupon_image']['tmp_name'];		    
		include("resize-class.php");
		$originalpath  = "webupload/original/coupons/".$imgname;
		$thumbnailpath = "webupload/thumb/coupons/".$imgname;
		
				
		move_uploaded_file($source,$originalpath);
		$height_1 = (($height * 400) / $width);
				
		$resizeObj = new resize($originalpath);		
		$resizeObj -> resizeImage(400, $height_1, 'crop');
		$resizeObj -> saveImage($thumbnailpath, 100);
		 }
		 		
			
	}
	else { $imgname=($_REQUEST['theValue']); }
		
		
		//print_r($_REQUEST);
	$field['web_coupon_status']="1";
	$where_edit_status="  where web_id='".$_REQUEST['cid']."'";
	$res_edit_status=$sql->select_query("dynamic_create_coupons",$where_edit_status);
	
	$_REQUEST['free_yes']=1;
	 $where_edit=" where web_id=".$_REQUEST['cid']; 
$field['web_coupon_title']=$_REQUEST['web_coupon_title'];

$val=$_REQUEST['web_coupon_expiredate'];
	$date = strtotime("+$val day");
    $expaire=date('Y-m-d', $date);
	/*$field['web_coupon_expiredate']=$expaire;	
	$field['web_coupon_expaire']=$_REQUEST['web_coupon_expiredate']; recently commented-> 11-04-2016*/
	
			
	/*$field['web_coupon_expiredate']=$_REQUEST['web_coupon_expiredate'];	
	$field['web_coupon_expaire']=$_REQUEST['web_coupon_expaire'];*/
	$field['web_ccategory']=$_REQUEST['web_ccategory'];
	$field['web_coupon_ownername']=($_REQUEST['web_coupon_ownername']);		
	$field['web_coupon_bname']=$_REQUEST['web_coupon_bname'];
	
	if($_REQUEST['web_coupon_url']!="")
	{
		$field['web_coupon_url']=$_REQUEST['web_coupon_url'];
	}
	
	else
	{
		$field['web_coupon_url']="#";
	}
	//$field['web_coupon_url']=$_SESSION['web_coupon_url'];
	$field['web_coupon_details']=($_REQUEST['web_coupon_details']);		
	$field['web_coupon_email']=$_REQUEST['web_coupon_email'];	
	$field['web_coupon_image']=$imgname; //$_REQUEST['web_coupon_image'];
	$field['web_coupon_address']=($_REQUEST['web_coupon_address']);		
	$field['web_coupon_state']=$_REQUEST['web_coupon_state'];	
	$field['web_coupon_city']=$_REQUEST['web_coupon_city'];
	$field['web_coupon_country']=($_REQUEST['web_coupon_country']);		
	$field['web_coupon_zipcode']=($_REQUEST['web_coupon_zipcode']);		
	$field['web_coupon_postalcode']=($_REQUEST['web_coupon_postalcode']);		
	$field['web_coupon_id']=$_REQUEST['web_coupon_id'];	
	$field['web_coupon_package']=$_REQUEST['web_coupon_package'];
	$field['web_coupon_opendate']=$_REQUEST['web_coupon_opendate'];	
	$field['web_coupon_circulation']=$_REQUEST['web_coupon_circulation'];
	$field['web_capture_info']=$_REQUEST['web_capture_info'];
	

	
	$res=$sql->update_query($field,"dynamic_create_coupons",$where_edit);	
	
		?> <script>window.location.href ="myaccount.php"; alert("Success! your Coupon has been successfully edited.");</script> <?
          
exit;	


/*======================= end free coupon edit (free no charge for edit option of free coupon) =======================================*/
	


	}
	
	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
 <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="http://fonts.googleapis.com/css?family=Lobster" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Open Sans" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="images/favicon.ico">
<link rel="stylesheet" type="text/css" href="css/styles.css">
<link rel="stylesheet" type="text/css" href="css/cssmenu.css">
<link rel="stylesheet" type="text/css" href="css/media.css">
<title>Home - Dynamicoupons</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
  <script src="cssmenu/script.js"></script>
<script src="js/jquery.flexslider-min.js"></script>

<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript">
 var RecaptchaOptions = {
    theme : 'red'
 };
 
 $(function() {
    $( "#web_coupon_expiredate" ).datepicker({minDate: 0});
	
	
	$("span.box_click").click(function() {
    
	var id = $(this).attr("id");
	
	$.ajax({
	   type: "POST",
	   url: "ajax/view_data.php",
	   data: {id:id},
	   success: function (result)   {
		   document.getElementById('box_ads').innerHTML=result;
		    $("#box_ads").show();
	 }
	});
	}); 
  });
  
 </script>

<link rel="stylesheet" href="css/flexslider.css" />
</head>

<script type="text/javascript">
$(document).ready(function(){
	

	
	$('ul.tabsclass').each(function(){

			
		var $active, $content, $links = $(this).find('a');
		<? if($_REQUEST['cid']!='') { ?>
		$active = $($links.filter('[href="'+location.hash+'"]')[2] || $links[2]);
		$active.addClass('active');
		<? } elseif($_REQUEST['share_id']!='') { ?>
		$active = $($links.filter('[href="'+location.hash+'"]')[3] || $links[3]);
		$active.addClass('active');
		<? } else { ?>
		$active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
		$active.addClass('active');
		<? } ?>
		$content = $($active[0].hash);

		$links.not($active).each(function () {
						$(this.hash).hide();
					});

		$(this).on('click', 'a', function(e){
		$("#box_ads").hide();
		$active.removeClass('active');
		$content.hide();

		$active = $(this);  
		
		//alert($active[0]);
		if($active[0]=="http://www.nskfix.com/dev/dynamicoupons/myaccount.php#tab3" || $active[0]=="http://nskfix.com/dev/dynamicoupons/myaccount.php#tab3"){ 


	
		<? $where_sp_q=" where web_id=".$_SESSION['user_id'];
		$select_sub_pack_q=$sql->select_query($table,$where_sp_q);
		
		
		 $plan_details_q=$sql-> select_query("dynamic_pricelist"," where web_id=".$select_sub_pack_q[0]['web_package']);	
		
		
		$started_dtae_q=$select_sub_pack_q[0]['web_date'];

		$date_q = strtotime("+1 month", strtotime($started_dtae_q));

		$expiration_dat_q=date('Y-m-d', $date_q);


if($_REQUEST['cid']=="") {
	
if($select_sub_pack_q[0]['web_admin_user']!=1) {
if($select_sub_pack_q[0]['web_subscription_status']==1)
	{


	if($select_sub_pack_q[0]['web_free_coupon_status']==1  && $select_sub_pack_q[0]['web_free_coupon_status']==1) //if free coupon over
	{

	if($plan_details_q[0]['web_numofcoupons']> $select_sub_pack_q[0]['web_subscribed_coupons'])
	{	
	
				 ?>	$content = $(this.hash);
			
			<? } 
			
			else { ?>
	
	
		alert(" You have already created free coupon or package limit, please upgrade the coupon package ");
			window.location.replace("pricing.php");
			
		<? } 			
			 }
			
			else { ?>
		$content = $(this.hash);
		<? } 
			
			 } }  
			 
		
				
		else { ?>
		$content = $(this.hash);
		<? } 
			 
			 
			 

			 
			 } else { ?>
		$content = $(this.hash);
		<? } ?>
		}
		else
		{
			$content = $(this.hash);
		}

		$active.addClass('active');
		$content.show();
		e.preventDefault();
					});
		});
		
		/*$("#box_ads").hide();
        $("#box_click").click(function(){
            $("#box_ads").show();
});*/

});

</script>
<script type="text/javascript" src="webadmin/ckeditor/ckeditor.js" language="javascript1.2"></script>

<body>
<? 
function callscr ($web_coupon_title, $web_coupon_expiredate,$web_coupon_expaire, $web_ccategory, $web_coupon_ownername, $web_coupon_bname, $web_coupon_url, $web_coupon_details, $web_coupon_email, $web_coupon_image, $web_coupon_address, $web_coupon_state, $web_coupon_city, $web_coupon_country, $web_coupon_zipcode, $web_coupon_postalcode, $web_coupon_id, $web_coupon_package, $web_coupon_circulation, $web_capture_info)
		{
			
			
			?>
            <form enctype="multipart/form-data" name="ss" id='ss' action="paypal_edit_coupons.php">
             <input type="hidden" name="web_coupon_title" id="web_coupon_title" value="<?=$web_coupon_title?>"  />
              <input type="hidden" name="web_coupon_expiredate" id="web_coupon_expiredate" value="<?=$web_coupon_expiredate?>" />
              <input type="hidden" name="web_coupon_expaire" id="web_coupon_expaire" value="<?=$web_coupon_expaire?>" />
              <input type="hidden" name="web_ccategory" id="web_ccategory" value="<?=$web_ccategory?>" />
              <input type="hidden" name="web_coupon_ownername" id="web_coupon_ownername" value="<?=$web_coupon_ownername?>" />
              <input type="hidden" name="web_coupon_bname" id="web_coupon_bname" value="<?=$web_coupon_bname?>" />
              <input type="hidden" name="web_coupon_url" id="web_coupon_url" value="<?=$web_coupon_url?>" />
              <input type="hidden" name="web_coupon_details" id="web_coupon_details" value="<?=$web_coupon_details?>" />
              <input type="hidden" name="web_coupon_email" id="web_coupon_email" value="<?=$web_coupon_email?>" />
              <input type="hidden" name="web_coupon_image" id="web_coupon_image" value="<?=$web_coupon_image?>" />
              <input type="hidden" name="web_coupon_address" id="web_coupon_address" value="<?=$web_coupon_address?>" />
              <input type="hidden" name="web_coupon_state" id="web_coupon_state" value="<?=$web_coupon_state?>" />
              <input type="hidden" name="web_coupon_city" id="web_coupon_city" value="<?=$web_coupon_city?>" />
              <input type="hidden" name="web_coupon_country" id="web_coupon_country" value="<?=$web_coupon_country?>" />
              <input type="hidden" name="web_coupon_zipcode" id="web_coupon_zipcode" value="<?=$web_coupon_zipcode?>" />
              <input type="hidden" name="web_coupon_postalcode" id="web_coupon_postalcode" value="<?=$web_coupon_postalcode?>" />
              <input type="hidden" name="web_coupon_id" id="web_coupon_id" value="<?=$web_coupon_id?>" />
              <input type="hidden" name="web_coupon_package" id="web_coupon_package" value="<?=$web_coupon_package?>" />
              <input type="hidden" name="web_coupon_circulation" id="web_coupon_circulation" value="<?=$web_coupon_circulation?>" />
              <input type="hidden" name="web_capture_info" id="web_capture_info" value="<?=$web_capture_info?>" />

            </form>     
            <script> document.getElementById("ss").submit();</script>     <?
			
		}
?>
<? include('header.php');?>

<div class="middlesection">
    <div class="wrapper1">
    
 
    
<div class="tabcontainer" style="clear:both;">

 <div class="title">My Account</div>
 <div class="clear"></div>
 <div class="space"></div>

<div class="contentp" style="min-height:450px;">

<ul class="tabsclass">

<li><a href="#tab1" <? //if(isset($_REQUEST['cid']) && $_REQUEST['cid']!='') {  "class='active'"; }  elseif(!isset($_REQUEST['cid']) && !isset($_REQUEST['action'])) { echo "class='active'";   }?>>My Account</a></li>
<li><a href="#tab2">Change Password</a></li>
<li><a href="#tab3" <? if($_REQUEST['action']=='package') { echo "class='active'"; } ?> onClick="myacc_load1();">Create Coupons</a></li>


<li><a href="#tab4">Coupon List</a></li>
<li><a href="#tab5">Subscription Details</a></li>
</ul>
<script type="text/javascript">
function myacc_load1()
{

//location.reload();
window.location.href="http://nskfix.com/dev/dynamicoupons/myaccount.php#tab3";

}

</script>


<div class="logout"><a href="logout.php">Logout</a></div>
<!-- --------------------- My Account ------------------------------------- -->
<?php /*?><?   if(isset($_REQUEST['cid']) && $_REQUEST['cid']!='') {  $style2='style="display:none;"'; } else if(!isset($_REQUEST['cid']) && $_REQUEST['cid']=='' && !isset($_REQUEST['action']) && $_REQUEST['action']!="package") {  $style2='style="display:block;"'; }  else {  $style2='style="display:none;"';   }?><?php */?>
<? //if($_REQUEST['cid']!='') { $style1='style="display:none;"'; } else if($_REQUEST['cid']=='') { $style1='style="display:block;"'; } ?>
<div id="tab1">
<div class="center">
    <form action="#" enctype="multipart/form-data" method="post" name="form_signup">
    <div class="clear"></div>
    <div class="space"></div>
    <div class="space"></div>
    
    
    <div class="hd_left">Name<font color="#FF0000">*</font></div>
    <div class="colon">:</div>
    <div class="des">
    <input type="text" name="web_fname" id="web_fname" class="textbox" value="<?=$result[0]['web_fname']?>"/></div>
    <div class="clear"></div>
    <div class="space"></div>
    
    <div class="hd_left">Birth date<font color="#FF0000">*</font></div>
    <div class="colon">:</div>
    <div class="des">
    <input type="text" name="web_dob" id="web_dob" class="textbox" value="<?=$result[0]['web_dob']?>"/></div>
    <div class="clear"></div>
    <div class="space"></div>
    
    <div class="hd_left">Email Address<font color="#FF0000">*</font></div>
    <div class="colon">:</div>
    <div class="des">
    <input type="text" name="web_email" id="web_email" class="textbox" value="<?=$result[0]['web_email']?>" readonly /></div>
    <div class="clear"></div>
    <div class="space"></div>
    
    <div class="hd_left">Password <font color="#FF0000">*</font></div>
    <div class="colon">:</div>
    <div class="des">
    <input type="password" name="web_password" id="web_password" value="<?=$result[0]['web_password']?>" class="textbox" readonly /></div>
    <div class="clear"></div>
    <div class="space"></div>
    
    <div class="hd_left">Company Name<font color="#FF0000">*</font></div>
    <div class="colon">:</div>
    <div class="des">
    <input type="text" name="web_company_name" id="web_company_name" class="textbox" value="<?=$result[0]['web_company_name']?>"/></div>
    <div class="clear"></div>
    <div class="space"></div>
    
    
    <div class="hd_left_1">&nbsp;</div>	
    <div class="colon">&nbsp;</div>		
    <div class="des"><input class="button_s orange" type="submit" value='Update' name="signup"  onclick='return validation()'  /></div>	
    <div class="clear"></div>	             
    <div class="space"></div>   
    </form>
    </div>
</div>

<!-- --------------------- Change Password ------------------------------------- -->
<div id="tab2" style="display:none;">
<div class="center" style="margin-left:10px;">
    <form action="#" enctype="multipart/form-data" method="post" name="form_change">
    <div class="clear"></div>
    <div class="space"></div>
    <div class="space"></div>
    
    
    <div class="hd_left">Old Password<font color="#FF0000">*</font></div>
    <div class="colon">:</div>
    <div class="des">
    <input type="password" name="oldpassword" id="oldpassword" class="textbox" onKeyPress="return checkpath(event)"/></div>
    <div id="passerr" style="color:#FF0000;"></div>
    <div class="clear"></div>
    <div class="space"></div>
    
    <div class="hd_left">New Password<font color="#FF0000">*</font></div>
    <div class="colon">:</div>
    <div class="des">
    <input type="password" name="newpassword" id="newpassword" class="textbox" onKeyPress="return checkpath(event)"/></div>
    <div id="newpasserr" style="color:#FF0000;"></div>
    <div class="clear"></div>
    <div class="space"></div>
    
    <div class="hd_left">Confirm Password<font color="#FF0000">*</font></div>
    <div class="colon">:</div>
    <div class="des">
    <input type="password" name="confirmpassword" id="confirmpassword" class="textbox" onKeyPress="return checkpath(event)"/></div>
    <div id="cpasserr" style="color:#FF0000;"></div>
    <div class="clear"></div>
    <div class="space"></div>
    
    <div class="hd_left_1">&nbsp;</div>	
    <div class="colon">&nbsp;</div>		
    <div class="des">
    <input class="button_s orange" type="submit" value='Submit' name="change"  onclick='return change_validation();'  />
    <input class="button_s orange" type="submit" value='Cancel'  onclick='return homepage()' />
    </div>	
    <div class="clear"></div>	             
    <div class="space"></div>   
    </form>
    </div>
</div>

<!-- --------------------- Create Coupons ------------------------------------- -->
<? if($_REQUEST['action']=='package') {  $style1='style="display:block;"'; } else if(isset($_REQUEST['cid']) && $_REQUEST['cid']!='') { $style1='style="display:block;"'; }  else { $style1='style="display:none;"';  }?>
<? //if($_REQUEST['cid']!='') { $style='style="display:block;"'; } else if($_REQUEST['cid']=='') { $style='style="display:none;"'; } ?>
<div id="tab3">

<div class="clear"></div>
<div class="space"></div>

    
    <?
	if($_REQUEST['cid']!='')
	{
	 $where_edit="  where web_id='".$_REQUEST['cid']."'";
	 $res_edit=$sql->select_query("dynamic_create_coupons",$where_edit);	
	 $web_coupon_id=$res_edit[0]['web_coupon_id'];
	 $web_free_coupon_status=$res_edit[0]['web_free_coupon_status'];
	}
	else{			 
				 
							 
				$count1=$sql->select_query("dynamic_create_coupons"," where web_excel_status!='1' order by web_id"); 				 	 
				$count=count($count1);
				/* if($count == 0)
				 {
					$web_coupon_id = "10001";
				 }
				 else
				 {
					 $where_fet=" web_excel_status!='1' ORDER BY web_id DESC LIMIT 1";
					$res_fet=$sql->select_query("dynamic_create_coupons",$where_fet);	
					$getempid=$res_fet[0]['web_coupon_id'];					 
					$last_id = $getempid;
					$insert_id = $last_id+1;
					$web_coupon_id = $insert_id;				 
				 }	*/
				 
				 $web_coupon_id = uniqid();
				 
				$web_coupon_id= strtoupper(substr($web_coupon_id,5));
				
				$check_free=$sql->select_query("dynamic_register"," where web_id=".$_SESSION['user_id']);
				$web_free_coupon_status=$check_free[0]['web_free_coupon_status'];
				 
	}

				//echo "jjj=". $web_free_coupon_status;
				 ?>
                 
<?php /*?><? if($_REQUEST['cid']!="")
{

if($web_free_coupon_status==1) { 

$action='action="paypal_edit_coupons.php"';


 }
 
 else
 {
	
$action='action=""';
 
 }
 
}
else

{
	

	
	if($web_free_coupon_status==1) { 

echo "aaA";

$action='action="paypal_edit_coupons.php"';


 }
else
 { 

echo "kkkkkkkkk".$action='action=""';



}
}

?><?php 

<? if($_REQUEST['cid']!="") { $action='action="paypal_edit_coupons.php"'; } else { $action='action=""';}?>*/?>

 <form action="#" name="form_cou" method="post" enctype="multipart/form-data">
 
    
       <?
	   $res=$sql->select_query("dynamic_create_coupons",""); 
if($_REQUEST['action']=="send")
{ ?>
<div style="color:#093;padding-bottom: 25px; text-align:center; font-size:14px; width:90%;"><? echo "Success! Please check your email inbox for activation link";?></div>
<? }
if($_REQUEST['action']=="fail")
{ ?>
<div style="color:#f00;padding-bottom: 25px;text-align:center;font-size:14px; width:90%;"><? echo "Message has not been sent .Please try again!";?></div>
<? } ?>
    
    <div class="center">

				<!-- <input type="hidden" name="web_coupon_id" id="web_coupon_id" class="textbox"  value="<?=$web_coupon_id?>" readonly >  -->
                 <input type="hidden" name="web_coupon_opendate" id="web_coupon_opendate" value="<?=date("Y/m/d")?>" />
                 <input type="hidden" name="cid" id="cid" value="<?=$res_edit[0]['web_id']?>" />
                 <div class="clear"></div>	
    
    
        <div class="hd_left">Coupon ID<font color="#FF0000">*</font></div>
    <div class="colon">:</div>
    <div class="des">
    <input type="text" name="web_coupon_id" id="web_coupon_id" class="textbox" placeholder="Coupon ID *" value="<?=$web_coupon_id?>" onChange='coupon_id();'/>
    </div>
    <div class="clear"></div>
    <div class="space"></div>
    
    <div class="hd_left">Coupon Title<font color="#FF0000">*</font></div>
    <div class="colon">:</div>
    <div class="des">
    <input type="text" name="web_coupon_title" id="web_coupon_title" class="textbox" placeholder="Coupon Title * (e.g. Buy 1 & Get 1 FREE)" value="<?=get_symbol($res_edit[0]['web_coupon_title']);?>" onChange='coupon_title();'/> 
    </div>
    <div class="clear"></div>
    <div class="space"></div>
    
    <? if($_REQUEST['cid']=="") { ?>
    <div class="hd_left">Coupon expire<font color="#FF0000">*</font></div>
    <div class="colon">:</div>
    <div class="des">
     <select name="web_coupon_expiredate" id="web_coupon_expiredate" class="textbox sel_view" style="height:30px;" value="<?=$res_edit[0]['web_coupon_expaire']?>">
     <?
	 if($res_edit[0]['web_coupon_expaire']==7){ $sel="selected"; } else { $sel=""; }
	 if($res_edit[0]['web_coupon_expaire']==15){ $sel2="selected"; } else { $sel2=""; }
	 if($res_edit[0]['web_coupon_expaire']==30){ $sel3="selected"; } else { $sel3=""; }
	 if($res_edit[0]['web_coupon_expaire']==90){ $sel4="selected"; } else { $sel4=""; }
	 ?>
     <option value="-1"></option>
     <option value="1" <?=$sel?>> 1 day</option>
     <option value="7" <?=$sel?>> 7 days</option>
     <option value="15" <?=$sel2?>> 15 days</option>
     <option value="30" <?=$sel3?>> 30 days</option>
         <option value="90" <?=$sel4?>> 3 Months</option>
         
     </select>
     
      <p style="color:#0C0;text-align:center !important; ">Your selection is permanent once coupon is published. Future edits are not available.</p>
      
    </div>
    <div class="clear"></div>
    <div class="space"></div>
    <? } ?>
    
    <div class="hd_left">Coupon category<font color="#FF0000">*</font></div>
    <div class="colon">:</div>
    <div class="des">
    <select name="web_ccategory" id="web_ccategory" class="textbox sel_view" multiple="multiple" style="height:87px;">
    <?
                $table12='dynamic_category';
                $res1=$sql->select_query($table12," order by web_title asc"); $i=1;
                $web_ccategory=get_symbol($res_edit[0]['web_ccategory']);
                if(!empty($res1))
                {
                foreach($res1 as $res1)
                {
                $nw=$res1['web_id'];
                if($web_ccategory==$nw)
                { $sel1="selected='selected'"; }
                else{ $sel1=""; }
                ?>
               <option value="<?=$res1['web_id']?>" <?=$sel1?> ><?=stripslashes(get_symbol($res1['web_title']))?></option>
                <? } } ?>
    </select>
    </div>
    <div class="clear"></div>
    <div class="space"></div>
    
   <div class="hd_left">Coupon Details<font color="#FF0000">*</font></div>
    <div class="colon">:</div>
    <div class="des1">
    <textarea name="web_coupon_details" id="web_coupon_details" placeholder="Coupon Details* (e.g. offer valid on certain days or times) (character limit 600)" class="textbox" style="height:100px;" onChange='coupon_detail();'><?=get_symbol($res_edit[0]['web_coupon_details']);?></textarea>
<!--    <script type="text/javascript">			
          var ckedit=CKEDITOR.replace("web_coupon_details", 
          {
           height:"200", width:"317",
		   filebrowserBrowseUrl : 'ckeditor/ckfinder/ckfinder.html',
		   filebrowserImageBrowseUrl : 'ckeditor/ckfinder/ckfinder.html?type=Images',
			filebrowserFlashBrowseUrl : 'ckeditor/ckfinder/ckfinder.html?type=Flash',
			filebrowserUploadUrl : 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
			filebrowserImageUploadUrl : 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
			filebrowserFlashUploadUrl : 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
           });
  </script>-->
  
  
   <script type="text/javascript">			
                                        var ckedit=CKEDITOR.replace("web_coupon_details", 
                                      
									    {
                                        height:"350", width:"335",
										filebrowserBrowseUrl : 'ckeditor/ckfinder/ckfinder.html',
										filebrowserImageBrowseUrl : 'ckeditor/ckfinder/ckfinder.html?type=Images',
										filebrowserFlashBrowseUrl : 'ckeditor/ckfinder/ckfinder.html?type=Flash',
										filebrowserUploadUrl : 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
										filebrowserImageUploadUrl : 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
										filebrowserFlashUploadUrl : 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                                        });
                                        </script>
                                        
                                        
                                        
  <p style="color:#0C0;text-align:center !important;"> Character Limit 600</p> 
    </div>
    <div class="clear"></div>
    <div class="space"></div>
   
    <div class="hd_left">Upload Image<font color="#FF0000">&nbsp;</font></div>
    <div class="colon">:</div>
    <div class="des">
    <input type="file" name="web_coupon_image" id="web_coupon_image" class="textbox"/>
    <p class="greeen_view" style="text-align:center !important;">You can upload image format as (.jpg / .png / .gif).</p>
    <input type="hidden" value="<?=$res_edit[0]['web_coupon_image']?>" id="theValue" name="theValue" />
    <? if($res_edit[0]['web_coupon_image']!=''){ ?>
                  <img src="image.php?width=30&height=30&cropratio=3.0:3.0&amp;image=<?=$urlsite?>webupload/thumb/coupons/<?=$res_edit[0]['web_coupon_image']?>" border="0" 
                  style="vertical-align:top" alt="<?=$sitetitle?>"/>
                  
				  <? echo $res_edit[0]['web_coupon_image']; } ?>                 
    </div>
    <div class="clear"></div>
    <div class="space"></div>
   
    </div>
    
    <div class="center">
    
    <div class="hd_left">Email <font color="#FF0000">*</font></div>
    <div class="colon">:</div>
    <div class="des">
    <? if($_REQUEST['cid']!='') { ?>
    <input type="text" name="web_coupon_email" id="web_coupon_email" class="textbox" placeholder="Will not publish" value="<?=$res_edit[0]['web_coupon_email']?>"/>
    <? } else { ?>
    <input type="text" name="web_coupon_email" id="web_coupon_email" class="textbox" placeholder="Will not publish" readonly value="<?=$result[0]['web_email']?>"/>
    <? } ?>
    </div>
    <div class="clear"></div>
    <div class="space"></div>
   
    
    <div class="hd_left">Business Owner <font color="#FF0000">*</font></div>
    <div class="colon">:</div>
    <div class="des">
    <input type="text" name="web_coupon_ownername" id="web_coupon_ownername" class="textbox" placeholder="Business Owner/Person Designate* (Will not publish)" value="<?=get_symbol($res_edit[0]['web_coupon_ownername']);?>" onChange='coupon_owner();'/>
    </div>
    <div class="clear"></div>
    <div class="space"></div>
    
    <div class="hd_left">Business Name <font color="#FF0000">*</font></div>
    <div class="colon">:</div>
    <div class="des">
    <input type="text" name="web_coupon_bname" id="web_coupon_bname" class="textbox" placeholder="Business name*" value="<?=get_symbol($res_edit[0]['web_coupon_bname']);?>" onChange='coupon_bname();'/></div>
    <div class="clear"></div>
    <div class="space"></div>
    
    <div class="hd_left">Website Address </div>
    <div class="colon">:</div>
    <div class="des">
    
    <? if($res_edit[0]['web_coupon_url']=="#") { $url="";  } else { $url=get_symbol($res_edit[0]['web_coupon_url']); } ?>
    <input type="text" name="web_coupon_url" id="web_coupon_url" class="textbox" placeholder="Copy & Paste the Website Address" value="<?=$url?>"/></div>
    <div class="clear"></div>
    <div class="space"></div>
    
    <div class="hd_left">Address <font color="#FF0000">*</font></div>
    <div class="colon">:</div>
    <div class="des">
    <input type="text" name="web_coupon_address" id="web_coupon_address" class="textbox" placeholder="Address*" value="<?=get_symbol($res_edit[0]['web_coupon_address']);?>" onChange='coupon_address();'/></div>
    <div class="clear"></div>
    <div class="space"></div>
    
    <div class="hd_left">City <font color="#FF0000">*</font></div>
    <div class="colon">:</div>
    <div class="des">
    <input type="text" name="web_coupon_city" id="web_coupon_city" class="textbox" placeholder="City*" value="<?=get_symbol($res_edit[0]['web_coupon_city']);?>" onChange='coupon_city();'/></div>
    <div class="clear"></div>
    <div class="space"></div>
    
    <div class="hd_left">State <font color="#FF0000">*</font></div>
    <div class="colon">:</div>
    <div class="des">
    <input type="text" name="web_coupon_state" id="web_coupon_state" class="textbox" placeholder="State*" value="<?=get_symbol($res_edit[0]['web_coupon_state']);?>" onChange='coupon_state();'/></div>
    <div class="clear"></div>
    <div class="space"></div>
    
    <div class="hd_left">Country <font color="#FF0000">*</font></div>
    <div class="colon">:</div>
    <div class="des">
    <input type="text" name="web_coupon_country" id="web_coupon_country" class="textbox" placeholder="Country*" value="<?=get_symbol($res_edit[0]['web_coupon_country']);?>" onChange='coupon_country();'/>    </div>
    <div class="clear"></div>
    <div class="space"></div>
    
    <div class="hd_left">Zip/Postal code <font color="#FF0000">*</font></div>
    <div class="colon">:</div>
    <div class="des">
    <input type="text" name="web_coupon_postalcode" id="web_coupon_postalcode" class="textbox" placeholder="Zip/Postal code*" onKeyPress="return isNumberKey(event)" value="<?=get_symbol($res_edit[0]['web_coupon_postalcode']);?>"/>    </div>
    <div class="clear"></div>
    <div class="space"></div>
    
    <div class="hd_left">No.of.Circulation<font color="#FF0000">*</font></div>
    <div class="colon">:</div>
    <div class="des">
    <input type="text" name="web_coupon_circulation" id="web_coupon_circulation" class="textbox" placeholder="No.of.Circulation" value="<?=get_symbol($res_edit[0]['web_coupon_circulation']);?>" maxlength="2" onKeyPress="return isNumberKey(event)"/>    <p style="color:#0C0;text-align:center !important; ">Choose the total # of times (under 100) your coupon can be Redeemed before the chosen expiry date. More info under <a href="faq.php" style="color:green">FAQ</a> page.</p> </div>
    <div class="clear"></div>
    <div class="space"></div>
    
    
      <? if($_REQUEST['cid']=="") { ?>
    <div class="hd_left">Do you want to extend your Coupon Circulation limit by 100? <font color="#FF0000">*</font></div>
    <div class="colon">:</div>
    <div class="des">
    <!--<input type="text" name="web_coupon_circulation" id="web_coupon_circulation" class="textbox" placeholder="No.of Coupons you want in Circulation (ie., 10, 50)*" onKeyPress="return isNumberKey(event)" value="<?=get_symbol($res_edit[0]['web_coupon_circulation']);?>"/>--> 
    
            <input type="radio" name="web_coupon_circulation_exceed" value="1" onClick="dividerss_circ()" id="web_coupon_circulation_exceed" />&nbsp;Yes &nbsp; &nbsp;
    <input type="radio" name="web_coupon_circulation_exceed" id="web_coupon_circulation_exceed"  onClick="dividers_circ()" value="0" checked="checked" />&nbsp; No &nbsp; &nbsp;


       </div>
    <div class="clear"></div>
    
      <div class="space">&nbsp;</div>     
    <div id="amt_circ" style="display:none;">
    <div class="hd_left">Circulation Fee
 <font color="#FF0000">*</font></div>	
    <div class="colon">:</div>	
    <?
	$where_coupon="  where web_id=1 order by web_id";
    $res_coupon=$sql->select_query("dynamic_coupon_edit",$where_coupon);
	?>	
    <div class="des"><input type="text" name="amount_circ" id="amount_circ" size="34"  class="textbox file"  style="float:left;" value="$<?=get_symbol($res_coupon[0]['web_coupon_circulation_exceed_amount'])?>" readonly/>
    </div>	
    </div>
    <div class="clear"></div>
    <div class="space">&nbsp;</div>

    
    <div class="space"></div>
    
  
    <div class="hd_left">Do you want shared email data<font color="#FF0000">*</font> </div>	
    <div class="colon">:</div>		
    <div class="des"> 
    <div style="float:left;line-height:30px">
    <input type="radio" name="web_capture_info" value="1" id="web_capture_info" onClick="dividerss()" <? if($res_edit[0]['web_capture_info']=='1'){ ?> checked="checked" <? } ?> />&nbsp; Yes &nbsp; &nbsp;
    <input type="radio" name="web_capture_info" id="web_capture_info"  value="0" onClick="dividers()" <? if($res[0]['web_capture_info']=='0'){ ?> checked="checked" <? }?>/>&nbsp; No
        <p style="color:#0C0; line-height: 23px;text-align:center !important;">The email data is the captured emails of users using the coupon redeem option. There is an additional fee for this service in the amount indicated below. More info under <a href="faq.php" style="color:green">FAQ</a> page.</p>
        </div>
	</div>
    <div class="clear"></div>
                
    <div class="space">&nbsp;</div>     
    <div id="amt" style=" <? if($res_edit[0]['web_capture_info']=='1') { ?> display:block; <? } else { ?>display:none; <? }?>">
    <div class="hd_left">Shared email Capture Fee
 <font color="#FF0000">*</font></div>	
    <div class="colon">:</div>	
    <?
	$where_coupon="  where web_id=1 order by web_id";
    $res_coupon=$sql->select_query("dynamic_coupon_edit",$where_coupon);
	?>	
    <div class="des"><input type="text" name="amount" id="amount" size="34"  class="textbox file"  style="float:left;" value="$<?=get_symbol($res_coupon[0]['web_price'])?>" readonly/>
    </div>	
    </div>
    <div class="clear"></div>
    <div class="space">&nbsp;</div>
                 	
	<div id="no_amt" style=" <? if($res_edit[0]['web_capture_info']=='0') { ?> display:block; <? } else { ?>display:none; <? }?>">
    </div>
    <? } ?>
    
    <div class="hd_left" >Captcha <font color="#FF0000">*</font> </div>
    <div class="colon">:</div>	
    <div class="des1" style="float:left;"><div class="g-recaptcha captcha_view" data-sitekey="6LezYxETAAAAABo0AEAnaO_9IAoXjko3-Y_nt31x"></div>
    <div id="captchaStatus" style="color:#d30c0c;">&nbsp;</div>
    </div>
    <div class="clear"></div>
    
    <div class="hd_left_1">&nbsp;</div>
    <div class="colon">&nbsp;</div>		
    <div class="des">


    <input class="button_s orange" type="submit" value='Save Coupon' name="save"  onclick='return coupon_validation()'  />
    <input class="button_s orange" type="submit" value='Cancel' name="back"  onclick='return homepage()'  />
   
    </div>	
    <div class="clear"></div>	             
    <div class="space"></div> 
    
   <? if($res_edit_status[0]['web_free_coupon_status']==1) { ?>
    
   <input type="hidden" name="free_coupon" id="free_coupon" value="1" /> .
   

<? } else { ?>



    
   <input type="hidden" name="free_coupon" id="free_coupon" value="0" /> 
   <? } ?>
<input type="hidden" name="free_coupon_limit" id="free_coupon_limit" value="<?=$result[0]['web_free_coupon_status']?>"   />  


 <input type="hidden" name="subscription_status" id="subscription_status" value="<?=$result[0]['web_subscription_status']?>"   />   
    </div>
    
    </form>
</div>



<!-- --------------------- List Coupons------------------------------------- -->
<div id="tab4">

<div class="center" style="margin-left:10px;">
<!-- <div class="my_Table">
    <div class="my_Title">
        <p></p>
    </div>
    <div class="my_Heading">
        <div class="my_Cell">
            <p>S.No</p>
        </div>
        <div class="my_Cell">
            <p>Coupon ID</p>
        </div>
        <div class="my_Cell">
            <p>Coupon Title</p>
        </div>
        <div class="my_Cell">
            <p> Coupon Circulation</p>
        </div>
        <div class="my_Cell">
            <p> Coupon Expiration</p>
        </div>
         <div class="my_Cell">
            <p> Action</p>
        </div>
    </div> -->
	<div class="space"></div>
    <div class="coupanlist_content">There is a 7 day grace period. Your coupon and shared emails will expire from your 
account permanently after the grace period.  You can edit and renew your coupon. 
Also, copy/paste to save your shared emails list in your personal file.
</div>
	<div class="space"></div>
    
	<table class="data_table" id="coupan_list">
		<thead class="data_heading">
		<tr>
		<th>S.No</th>
			<th>Coupon ID</th>
			<th>Coupon Title</th>
			<th>Coupon Circulation</th>
			<th>Coupon Expiration from Account</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody>
     <? 
    $cnt=$sql->cnt_table($table, "");
				$per_page = 10;
				if($cnt>$per_page){//include('pagination.php');
				}
				else {$start="0";}
				
				//$where_list=" where web_user_id=".$_SESSION['user_id']." order by web_id desc limit $start,$per_page";
				$where_list=" where web_user_id=".$_SESSION['user_id']." order by web_id desc ";
				//$coupon_list=$sql->select_query("dynamic_create_coupons",$where_list);
	
				$coupon_list=$sql->view_query("dynamic_create_coupons",$where_list);	
				
				$cnt=count($coupon_list);
				if($cnt!='' || ($cnt!=0))			
				{ $a=1;				 
				   foreach($coupon_list as $coupon_list){ 
				 ?>
   <!-- <div class="my_Row">
     <div class="my_Cell">
            <p><?=$a?></p>
        </div>
      
        <div class="my_Cell">
            <p><a href="myaccount.php?cid=<?=$coupon_list['web_id']?>#tab3"><?=$coupon_list['web_coupon_id']?></a></p>
        </div>
        <div class="my_Cell">
           <p><a href="myaccount.php?cid=<?=$coupon_list['web_id']?>#tab3"><?=get_symbol($coupon_list['web_coupon_title'])?></a></p> 
        </div>
        <div class="my_Cell">
        <? if($coupon_list['web_coupon_circulation']!='') { ?>
        <p><?=$coupon_list['web_coupon_circulation'];?></p>
        <? } else { ?>
            <p>NULL</p>
        <? } ?>
        </div>
        <div class="my_Cell" style="text-align:center;">
            <? if($coupon_list['web_expired']==0){ ?>
          <a href="#" class="action"><img alt="Allow" src="images/1.png" /></a>
          <? } else{ ?>
          <a href="expire.php?web_id=<?=$coupon_list['web_id']?>" class="action"><img alt="Allow" src="images/0.png" /></a>
          <? } ?>
        </div>
        
         <div class="my_Cell">
            <p><a href="myaccount.php?cid=<?=$coupon_list['web_id']?>&action=edit" class="action" style="color: #002C53;">Edit</a>&nbsp;/&nbsp;<? if($coupon_list['web_capture_info']==1) { ?><span class="box_click" id="<?=$coupon_list['web_id']?>" style="cursor:pointer; text-decoration:underline; color: #002C53;">View Data</span><? } else { ?><a href="myaccount.php?cid=<?=$coupon_list['web_id']?>&action=inform" class="action" style="color: #002C53;">Request&nbsp;Capture&nbsp;Email</a><? }?>&nbsp;/&nbsp;<a href="myaccount.php?cid=<?=$coupon_list['web_id']?>&action=delete" class="action" onClick="return confirmDelete();" style="color: #002C53;">Delete</a></p>
        </div>
        
     
        
        
    </div> -->
	<tr class="data_row">
	<td><?=$a?></td>
	<td><a href="myaccount.php?cid=<?=$coupon_list['web_id']?>#tab3"><?=$coupon_list['web_coupon_id']?></a></td>
	<td><a href="myaccount.php?cid=<?=$coupon_list['web_id']?>#tab3"><?=get_symbol($coupon_list['web_coupon_title'])?></a></td>
	<td>
	<? if($coupon_list['web_coupon_circulation']!='') { ?>
        <p><?=$coupon_list['web_coupon_circulation'];?></p>
        <? } else { ?>
            <p>NULL</p>
        <? } ?>
	</td>
	<td style="text-align: center;">
	 <?  echo date('d M, Y', strtotime(get_symbol($coupon_list['web_coupon_expiredate']))); ?> <br/><?
     if($coupon_list['web_expired']==0){ ?>
          <a href="#" class="action"><img alt="Allow" src="images/1.png" /></a>
          <? } else{ ?>
         <!-- <a href="expire.php?web_id=<?=$coupon_list['web_id']?>" class="action"><img alt="Allow" src="images/0.png" /></a>-->
         <a href="#" class="action"><img alt="Allow" src="images/0.png" /></a>
         
          <? } ?>
	</td>
	<td><a href="myaccount.php?cid=<?=$coupon_list['web_id']?>&action=edit" class="action" style="color: #002C53;">Edit</a>&nbsp;/&nbsp;<? if($coupon_list['web_capture_info']==1) { ?><span class="box_click" id="<?=$coupon_list['web_id']?>" style="cursor:pointer; text-decoration:underline; color: #002C53;">View Data</span><? } else { ?>
    
    <? 
	 if($coupon_list['web_free_coupon_status']==1 || $result[0]['web_admin_user']==1) { ?>
    <a href="myaccount.php?cid=<?=$coupon_list['web_id']?>&action=request_shared_email" class="action" style="color: #002C53;">Request&nbsp;Capture&nbsp;Email</a>
	
 <? } else
 { ?>
	 
	 <a href="myaccount.php?cid=<?=$coupon_list['web_id']?>&action=inform" class="action" style="color: #002C53;">Request&nbsp;Capture&nbsp;Email</a>
      
 <? }
 ?>
	<? }?>&nbsp;/&nbsp;<a href="myaccount.php?cid=<?=$coupon_list['web_id']?>&action=delete" class="action" onClick="return confirmDelete();" style="color: #002C53;">Delete</a></td>
	</tr>

<? $a++;}
				echo $msg;
				}
				?>
</tbody>
</table>
<!--</div>-->
    </div>
</div>

 <!-- --------------------- Shared Details------------------------------------- -->
<?php /*?><? 
$where_sh="  where web_id='".$_REQUEST['share_id']."'";
$res_sh=$sql->select_query("dynamic_create_coupons",$where_sh);	
$web_capture_information=$res_sh[0]['web_capture_info'];
if($_REQUEST['share_id']!='' && $web_capture_information=="1") { ?><?php */?>
<div id="box_ads"> 
</div>
<?php /*?><? } ?><?php */?>
<!------------------>

<!-- --------------------- Subscription Details------------------------------------- -->
<div id="tab5">

<div class="center" style="margin-left:10px;">
<div class="clear"></div>
<div class="space"></div>
<!-- <div class="my_Table"> -->
<table class="data_table" id="table_subscripe">
		<thead class="data_heading">
		<tr>
		<th>S.No</th>
			<th>Package Title</th>
			<th>Total no.of Coupon</th>
			<th>Remaining Coupons</th>
		</tr>
		</thead>
		<tbody>
    <!-- <div class="my_Title">
        <p></p>
    </div>
    <div class="my_Heading">
        <div class="my_Cell">
            <p>S.No</p>
        </div>
        <div class="my_Cell">
            <p>Package Title</p>
        </div>
        <div class="my_Cell">
            <p>Total no.of Coupon</p>
        </div>
        <div class="my_Cell">
            <p>Remaining Coupons</p>
        </div> -->
    </div>
     <? 
                $cnt_sub=$sql->cnt_table($table, "");
				$per_page = 10;
				if($cnt>$per_page){//include('pagination.php');
				}
				else {$start="0";}
				
				//$where_list=" where web_user_id=".$_SESSION['user_id']." order by web_id desc limit $start,$per_page";
				$where_sub=" where web_id=".$_SESSION['user_id']." order by web_id desc ";
				//$coupon_list=$sql->select_query("dynamic_create_coupons",$where_list);
	
				$coupon_sub=$sql->view_query("dynamic_register",$where_sub);	
				
				$cnt_sub=count($coupon_list);
				if($cnt_sub!='' || ($cnt_sub!=0))			
				{ $a=1;				 
				   foreach($coupon_sub as $coupon_sub){ 
				   
				   $res_subde=$sql->select_query("dynamic_pricelist"," where web_id=".$coupon_sub['web_package']);
				   ?>
   <!--  <div class="my_Row">
    
        <div class="my_Cell">
            <p><?=$a?></p>
        </div>
      
        <div class="my_Cell">
            <p><?=get_symbol($res_subde[0]['web_title'])?></p>
        </div>
        
        <div class="my_Cell">
           <p><?=get_symbol($res_subde[0]['web_numofcoupons'])?></p> 
        </div>
        
        <div class="my_Cell">
        <?
		$tot=$res_subde[0]['web_numofcoupons'];
		$ctot=$coupon_sub['web_subscribed_coupons'];
		$value=$tot-$ctot;
		?>
        <p><?=$value?></p>
        </div>
    
    </div> -->
	
	<tr class="data_row">
		  <td><?=$a?></td>
		  <td><?=get_symbol($res_subde[0]['web_title'])?></td>
		  <td><?=get_symbol($res_subde[0]['web_numofcoupons'])?></td>
		  <td>  <?
		$tot=$res_subde[0]['web_numofcoupons'];
		$ctot=$coupon_sub['web_subscribed_coupons'];
		$value=$tot-$ctot;
		?>
        <?=$value?>
      </td>
		  
	<tr>

<? $a++;}
				echo $msg;
				}
				?>
</tbody>
</table>
<!-- </div> -->
    </div>
</div>



</div>


</div>
    </div>
 </div>
 <? include('footer.php'); ?>
 
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<!--<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->

<script type="text/javascript">

var j = jQuery.noConflict();
j(document).ready(function(){

CKEDITOR.instances.web_coupon_details.on( 'key', function() { 

var str = CKEDITOR.instances.web_coupon_details.getData();

       if (str.length > 850) {	
           CKEDITOR.instances.web_coupon_details.setData(str.substring(0, 800));	
alert("You cannot have more than 600 characters");
return false;         
       }
       
   } );	
   

   
 
}); 
function dividers()
	{
		document.getElementById('no_amt').style.display = 'block';
		document.getElementById('amt').style.display = 'none';
	}
	function dividerss()
	{
		document.getElementById('amt').style.display = 'block';
		document.getElementById('no_amt').style.display = 'none';
	}
	
	function dividers_circ()
	{

		document.getElementById('amt_circ').style.display = 'none';
	}
	function dividerss_circ()
	{
		document.getElementById('amt_circ').style.display = 'block';

	}
	
	
	
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

return true;
}

function isNumberKey(evt){
   var charCode = (evt.which) ? evt.which : event.keyCode
   if (charCode > 31 && (charCode < 48 || charCode > 57))
       return false;
   return true;
}

function confirmDelete(){	
	{ 
		answer = confirm("Do you want to delete this item?")

		if (answer ==0) 
		{ 
			return false;
		} 

	}
}


$(function() {
    $( "#web_dob" ).datepicker();
  });
  
function homepage()
	{		
	window.location.href ="myaccount.php";
	return false;
	}
	
function checkpath(e) {    
	if(e.keyCode==13) { 
		//changevalid();
    }
}

function CheckPassword(inputtxt)   
		{   
		var decimal=  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;  
		if(inputtxt.value.match(decimal))   
		{  
		//return true;  
		}  
		else  
		{   
		return false;  
		}  
		}   
function change_validation()
{
	
		var oldpass='';
		var pass='';
		var cpass='';
		var err=0;
		var ids='';		
		oldpass = document.getElementById('oldpassword').value;
		pass = document.getElementById('newpassword').value;
		cpass = document.getElementById('confirmpassword').value;
		
		
		document.getElementById('passerr').innerHTML = '';
		document.getElementById('newpasserr').innerHTML = '';
		document.getElementById('cpasserr').innerHTML = '';
		
		if(oldpass=='')
		{
			alert('Enter the old password');
			ids='oldpassword';
			document.getElementById(ids).focus();
			document.getElementById(ids).select();			
			return false;
		}
		
		else 
		{
			function pswd_exists(oldpass) {
			var result= null;
			$.ajax({
				url: 'ajax/checkpswd.php',				
				data: {oldpass: oldpass},				
				cache: false,
				async: false, // boo!
				success: function(data) {
					result= data;								
				}
			});			
			return result;				
			}
			
			var cntvalue=pswd_exists(oldpass);	
			
				if(cntvalue==0 || (cntvalue=='') || (cntvalue!=1))
				{
				alert("Invalid old password.");
				 ids = 'oldpassword';				
				document.getElementById(ids).focus();
				document.getElementById(ids).select();			
				return false;					
				
			}
		}
	
		if(pass=='')
		{
			alert('Enter the new password');
			ids = 'newpassword';				
			document.getElementById(ids).focus();
			document.getElementById(ids).select();			
			return false;			
		}
		
		else if(document.getElementById('newpassword').value!="") 
		{
			UP=document.getElementById('newpassword').value;
			 var i,index,j;
			var str=" ";
			if(UP.charAt(0)==" ")
			{
			alert('Invalid password'); 
			document.getElementById('newpassword').focus();
			document.getElementById('newpassword').select();	
			return false;			
			}
			var inputtxt=document.getElementById('newpassword');
		    var rtnpswd=CheckPassword(inputtxt); 	
		    if(rtnpswd==false)
		    {
		    alert('Password must be at least 8 to 15 characters and must contain at least one lower case and upper case letter and one digit and special character');
			document.getElementById('newpassword').select();	
			document.getElementById('newpassword').focus();
			return false;
	     }
		}
		
		
		if(cpass=='')
		{
			alert('Enter the confirm password');
			ids='confirmpassword'; 
			document.getElementById(ids).focus();
			document.getElementById(ids).select();			
			return false;
			
		}
		else if(pass!=cpass)
		{
			alert('Password and confirm password should be same');			 
			ids='confirmpassword'; 
			document.getElementById(ids).focus();
			document.getElementById(ids).select();			
			return false;			
		} 	
			
				
				return true;
			
			
		}


function coupon_validation()
{
	
	
		web_coupon_id = document.getElementById('web_coupon_id').value;
	if(web_coupon_id=="") 
	{ 
		alert("Please enter the coupon ID");
		document.getElementById('web_coupon_id').select();	
		document.getElementById('web_coupon_id').focus();			
		return false;
	}
	
	
	
	web_coupon_title = document.getElementById('web_coupon_title').value;
	
	   //var str1=document.getElementById("web_coupon_title");
   var n = web_coupon_title.length;
   
  
	   
	if(web_coupon_title=="") 
	{ 
		alert("Please enter the coupon title");
		document.getElementById('web_coupon_title').select();	
		document.getElementById('web_coupon_title').focus();			
		return false;
	}
	

	
	web_coupon_expiredate = document.getElementById('web_coupon_expiredate').value;
	if(web_coupon_expiredate=="-1") 
	{ 
		alert("Please enter the coupon expire date");		
		return false;
	}
	
	var editorcontent = CKEDITOR.instances['web_coupon_details'].getData().replace(/<[^>]*>/gi, '');
	if(editorcontent=='')
	{
	alert("Please enter the coupon details!");			
    return false;
	}	
	
	web_coupon_email = document.getElementById('web_coupon_email').value;
	if(web_coupon_email=="") 
	{ 
		alert("Please enter the email details");
		document.getElementById('web_coupon_email').select();	
		document.getElementById('web_coupon_email').focus();			
		return false;
	}
	
	var emailcontent=document.getElementById('web_coupon_email').value;
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
	document.getElementById('web_coupon_email').select();	
	document.getElementById('web_coupon_email').focus();
    return false;
    }
	}
	
	web_coupon_ownername = document.getElementById('web_coupon_ownername').value;
	if(web_coupon_ownername=="") 
	{ 
		alert("Please enter the business owner");
		document.getElementById('web_coupon_ownername').select();	
		document.getElementById('web_coupon_ownername').focus();			
		return false;
	}
	
	web_coupon_bname = document.getElementById('web_coupon_bname').value;
	if(web_coupon_bname=="") 
	{ 
		alert("Please enter the business name");
		document.getElementById('web_coupon_bname').select();	
		document.getElementById('web_coupon_bname').focus();			
		return false;
	}
	
	web_coupon_url = document.getElementById('web_coupon_url').value;
	
	if(web_coupon_url !="") {
	var url =document.getElementById('web_coupon_url').value;
    url_validate = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
    if(!url_validate.test(url)){
    alert('Please enter valid url');
	document.getElementById('web_coupon_url').select();	
	document.getElementById('web_coupon_url').focus();	
	return false;
     }
	}
  
	web_coupon_address = document.getElementById('web_coupon_address').value;
	if(web_coupon_address=="") 
	{ 
		alert("Please enter the address");
		document.getElementById('web_coupon_address').select();	
		document.getElementById('web_coupon_address').focus();			
		return false;
	}
	
	web_coupon_city = document.getElementById('web_coupon_city').value;
	if(web_coupon_city=="") 
	{ 
		alert("Please enter the city");
		document.getElementById('web_coupon_city').select();	
		document.getElementById('web_coupon_city').focus();			
		return false;
	}
	
	web_coupon_state = document.getElementById('web_coupon_state').value;
	if(web_coupon_state=="") 
	{ 
		alert("Please enter the state");
		document.getElementById('web_coupon_state').select();	
		document.getElementById('web_coupon_state').focus();			
		return false;
	}
	
	web_coupon_country = document.getElementById('web_coupon_country').value;
	if(web_coupon_country=="") 
	{ 
		alert("Please enter the country");
		document.getElementById('web_coupon_country').select();	
		document.getElementById('web_coupon_country').focus();			
		return false;
	}
	
	web_coupon_postalcode = document.getElementById('web_coupon_postalcode').value;
	if(web_coupon_postalcode=="") 
	{ 
		alert("Please enter the postal code");
		document.getElementById('web_coupon_postalcode').select();	
		document.getElementById('web_coupon_postalcode').focus();			
		return false;
	}
	
	web_coupon_circulation = document.getElementById('web_coupon_circulation').value;
	if(web_coupon_circulation=="") 
	{ 
		alert("Please enter the coupon circulation");
		document.getElementById('web_coupon_circulation').select();	
		document.getElementById('web_coupon_circulation').focus();			
		return false;
	}
	
	/*if (( form1.web_capture_info[0].checked == false ) && ( form1.web_capture_info[1].checked == false )) 
	{
	alert ( "Please choose shared data" ); 
	return false;
	}*/
	
	var a = jQuery('#g-recaptcha-response').val();
	if(!a)
	{
        alert('Please check the captcha');
        return false;
    }
	
	
return true;
}
function coupon_title()
	{
	web_coupon_title1 = document.getElementById('web_coupon_title').value; 
	web_coupon_title=$.trim(web_coupon_title1);
	$.ajax({
	type: 'post',
	url: 'ajax/word_filters.php',
	data: { web_coupon_title:web_coupon_title},
	
	success: function (result) {
		var str = result.substring(0, result.length-1);
	if(str!=''){
	//alert(str+" Word are not accepted. Please enter the coupon title");
	alert("We are a family website and have established Standards and Guidelines for content that is family oriented.  Accordingly, the current word selection is not acceptable for publication.  Please revise your term and try again. Thank you for your help.");
	
	
	document.getElementById('web_coupon_title').value="";
	document.getElementById('web_coupon_title').focus();
	}
	}
	
	});
	}
	
	
	 
 
 function coupon_id()
	{

	web_coupon_id = document.getElementById('web_coupon_id').value; 

	$.ajax({
	type: 'post',
	url: 'ajax/check_couponid.php',
	data: { web_coupon_id:web_coupon_id},
	
	success: function (result) {

	if(result==1){
	alert("Coupon ID already exists");
	document.getElementById('web_coupon_id').value="";
	document.getElementById('web_coupon_id').focus();
	}
	}
	
	});
	}


	function coupon_detail()
	{ 
	web_coupon_details1 = document.getElementById('web_coupon_details').value;
	web_coupon_details=$.trim(web_coupon_details); 
	$.ajax({

	type: 'post',
	url: 'ajax/word_filters.php',
	data: { web_coupon_details:web_coupon_details},
	
	success: function (result) {
	var str = result.substring(0, result.length-1);
	if(str!=''){
	//alert(str+" Word are not accepted. Please enter the coupon details");
	alert("We are a family website and have established Standards and Guidelines for content that is family oriented.  Accordingly, the current word selection is not acceptable for publication.  Please revise your term and try again. Thank you for your help.");
	
	document.getElementById('web_coupon_details').value="";
	document.getElementById('web_coupon_details').focus();
	return false;
	}
	}
	
	});
	}
	
	function coupon_owner()
	{
	web_coupon_ownername1 = document.getElementById('web_coupon_ownername').value; 
	web_coupon_ownername=$.trim(web_coupon_ownername1);
	$.ajax({
	type: 'post',
	url: 'ajax/word_filters.php',
	data: { web_coupon_ownername:web_coupon_ownername},
	
	success: function (result) {
	var str = result.substring(0, result.length-1);
	if(str!=''){
	//alert(str+" Word are not accepted. Please enter the business owner");
	alert("We are a family website and have established Standards and Guidelines for content that is family oriented.  Accordingly, the current word selection is not acceptable for publication.  Please revise your term and try again. Thank you for your help.");
	
	document.getElementById('web_coupon_ownername').value="";
	document.getElementById('web_coupon_ownername').focus();
	}
	}
	
	});
	}
	
	function coupon_bname()
	{
	web_coupon_bname1 = document.getElementById('web_coupon_bname').value; 
	web_coupon_bname=$.trim(web_coupon_bname1); 
	$.ajax({
	type: 'post',
	url: 'ajax/word_filters.php',
	data: { web_coupon_bname:web_coupon_bname},
	
	success: function (result) {
	var str = result.substring(0, result.length-1);
	if(str!=''){
	//alert(str+" Word are not accepted. Please enter the business name");
	alert("We are a family website and have established Standards and Guidelines for content that is family oriented.  Accordingly, the current word selection is not acceptable for publication.  Please revise your term and try again. Thank you for your help.");
	
	document.getElementById('web_coupon_bname').value="";
	document.getElementById('web_coupon_bname').focus();
	}
	}
	
	});
	}
	
	function coupon_address()
	{
	web_coupon_address1 = document.getElementById('web_coupon_address').value; 
	web_coupon_address=$.trim(web_coupon_address1);
	$.ajax({
	type: 'post',
	url: 'ajax/word_filters.php',
	data: { web_coupon_address:web_coupon_address},
	
	success: function (result) {
	var str = result.substring(0, result.length-1);
	if(str!=''){
	//alert(str+" Word are not accepted. Please enter the address");
	alert("We are a family website and have established Standards and Guidelines for content that is family oriented.  Accordingly, the current word selection is not acceptable for publication.  Please revise your term and try again. Thank you for your help.");
	
	document.getElementById('web_coupon_address').value="";
	document.getElementById('web_coupon_address').focus();
	}
	}
	
	});
	}
	
	function coupon_city()
	{
	web_coupon_city1 = document.getElementById('web_coupon_city').value; 
	web_coupon_city=$.trim(web_coupon_city1);
	$.ajax({
	type: 'post',
	url: 'ajax/word_filters.php',
	data: { web_coupon_city:web_coupon_city},
	
	success: function (result) {
	var str = result.substring(0, result.length-1);
	if(str!=''){
	//alert(str+" Word are not accepted. Please enter the city");
	alert("We are a family website and have established Standards and Guidelines for content that is family oriented.  Accordingly, the current word selection is not acceptable for publication.  Please revise your term and try again. Thank you for your help.");
	
	document.getElementById('web_coupon_city').value="";
	document.getElementById('web_coupon_city').focus();
	}
	}
	
	});
	}
	
	function coupon_state()
	{
	web_coupon_state1 = document.getElementById('web_coupon_state').value; 
	web_coupon_state=$.trim(web_coupon_state1);
	$.ajax({
	type: 'post',
	url: 'ajax/word_filters.php',
	data: { web_coupon_state:web_coupon_state},
	
	success: function (result) {
	var str = result.substring(0, result.length-1);
	if(str!=''){
	//alert(str+" Word are not accepted. Please enter the state");
	alert("We are a family website and have established Standards and Guidelines for content that is family oriented.  Accordingly, the current word selection is not acceptable for publication.  Please revise your term and try again. Thank you for your help.");
	
	document.getElementById('web_coupon_state').value="";
	document.getElementById('web_coupon_state').focus();
	}
	}
	
	});
	}
	
	function coupon_country()
	{
	web_coupon_country1 = document.getElementById('web_coupon_country').value;
	web_coupon_country=$.trim(web_coupon_country1); 
	$.ajax({
	type: 'post',
	url: 'ajax/word_filters.php',
	data: { web_coupon_country:web_coupon_country},
	
	success: function (result) {
	var str = result.substring(0, result.length-1);
	if(str!=''){
	//alert(str+" Word are not accepted. Please enter the country");
	alert("We are a family website and have established Standards and Guidelines for content that is family oriented.  Accordingly, the current word selection is not acceptable for publication.  Please revise your term and try again. Thank you for your help.");
	
	document.getElementById('web_coupon_country').value="";
	document.getElementById('web_coupon_country').focus();
	}
	}
	
	});
	}
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

.contentp{ padding:0px; }
.title{ text-align:center; }
.hd_left{ width:130px;}
.textbox{ width:310px;}
.data_table
{ margin-bottom:10px;
}
 .sel_view
 {
	 width:312px; 
 }
@media only screen and (max-width: 768px)
{
.greeen_view
{
	text-align:center !important;
}
.textbox
{
	    width: 323px;
}
.sel_view
 {
	 width:333px; 
	     height: 30px !important;
 }
}
  @media only screen and (min-width: 1px) and (max-width: 250px){
  .orange
  {
	      margin-top: 4%;
  }
  }
  @media only screen and (min-width: 1px) and (max-width: 450px){
  #cke_web_coupon_details {
    width: 88% !important;
    margin: 0 auto;
}
.textbox
{
	    width: 88% !important;
}
.sel_view
 {
	 width:92% !important;
	     height: 30px !important; 
 }
  }
</style>
 
