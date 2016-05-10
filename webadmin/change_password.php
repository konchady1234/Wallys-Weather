<?  
session_start(); ob_start();
include_once('../lib/config.php');
include_once('../lib/mysql_class.php');
$sql=new mysql();

//error_reporting (E_ALL ^ E_NOTICE);

if($_SESSION['admin_id']=="")
{
header('Location:index.php');exit();
}

if(isset($_REQUEST['old_pwd']) && $_REQUEST['new_pwd'] && $_REQUEST['cfrm_pwd']!='')
{
	
 	$res=$sql->change_password($_REQUEST['old_pwd'],$_REQUEST['new_pwd']);
	if($res==true){			
	header('Location:change_password.php?action=success');exit();	
	}
	else{
		header('Location:change_password.php?action=fail');exit();	
	}
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Change Password - Wally</title>
<link href="css/admin_stlyz.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" language="javascript1.2" src="ckeditor/ckeditor.js"></script>
</head>

<body id="innerbg">
<div>
  <? include("header.php"); ?>
    <div class="cont_right"  >
    
    	<div class="Grid_topbg"><h2 style="color: #66a8da;">Change Password </h2></div>
          <div class="Grid_midbg">
       		 <div>&nbsp;</div>
        	<!-- <div align="center" style="color:#666; height:30px; font-size:14px;"><h2>Home</h2></div>-->
       		 <div>
             
             
             <form action="#" method="post" enctype="multipart/form-data" name="form1" id="form1">  
                
                <div>    
                
                <? if($_REQUEST['action']=="success"){ ?>      
                 <div class="hd_left">&nbsp; </div>	
                 <div class="colon">&nbsp;</div>		
                 <div class="des"><font color="#1fb214">Password updated successfully!</font></div>	
                 <div class="clear"></div>
                 
                 <? } 
				 else if($_REQUEST['action']=="fail"){ ?>           
                 <div class="hd_left">&nbsp; </div>	
                 <div class="colon">&nbsp;</div>		
                 <div class="des"><font color="#f00">Password not updated</font></div>	
                 <div class="clear"></div>
				 <? }?>
                
                 <div class="space"></div>           
<<<<<<< HEAD
                 <div class="hd_left" style="width: 124px;">Old Password <font color="#FF0000">*</font> </div>	
                 <div class="colon">:</div>		
                 <div class="des"><input type="password" name="old_pwd" id="old_pwd" class="textbox" onchange="countValid(this);"></div>	
=======
                 <div class="hd_left">Old Password <font color="#FF0000">*</font> </div>	
                 <div class="colon">:</div>		
                 <div class="des"><input type="password" name="old_pwd" id="old_pwd" class="textbox" ></div>	
>>>>>>> 72b5b01fa70f0fba2e589a992e66ccb9ab41f4bc
                 <div class="clear"></div>	
                                                          
                 
                 <div class="space"></div>             
<<<<<<< HEAD
                 <div class="hd_left" style="width: 124px;">New Password <font color="#FF0000">*</font></div>	
                 <div class="colon">:</div>		
                 <div class="des">                 
                 <input type="password" name="new_pwd" id="new_pwd" class="textbox" onchange="countValid(this);" ></div>
=======
                 <div class="hd_left">New Password <font color="#FF0000">*</font></div>	
                 <div class="colon">:</div>		
                 <div class="des">                 
                 <input type="password" name="new_pwd" id="new_pwd" class="textbox" ></div>
>>>>>>> 72b5b01fa70f0fba2e589a992e66ccb9ab41f4bc
                                          
                 
                 <div class="clear"></div>	
                 
                  <div class="space"></div>             
<<<<<<< HEAD
                 <div class="hd_left" style="width: 124px;">Confirm Password <font color="#FF0000">*</font></div>	
                 <div class="colon">:</div>		
                 <div class="des">                 
                 <input type="password" name="cfrm_pwd" id="cfrm_pwd" class="textbox" onchange="countValid(this);"></div>
=======
                 <div class="hd_left">Confirm Password <font color="#FF0000">*</font></div>	
                 <div class="colon">:</div>		
                 <div class="des">                 
                 <input type="password" name="cfrm_pwd" id="cfrm_pwd" class="textbox" ></div>
>>>>>>> 72b5b01fa70f0fba2e589a992e66ccb9ab41f4bc
                 
                </div>	
                 <div class="clear"></div>	
                 
                              
                 <div class="space">&nbsp;</div>             
                 <div class="hd_left">&nbsp;</div>	
                 <div class="colon">&nbsp;</div>		
                 <div class="des">
               
				<input class="submit_btn" type="submit" value='Update' name="submit"  onclick='return validation()'  />
<<<<<<< HEAD
                 <input class="submit_btn" type="reset" value='Reset' name="cancel"  />
=======
                 <input class="submit_btn" type="button" value='Cancel' name="cancel"  />
>>>>>>> 72b5b01fa70f0fba2e589a992e66ccb9ab41f4bc
                 
                 </div>	
                 <div class="clear"></div>	
                 
              
                   
                
            	</form>
</div>        
        </div>
        <div class="Grid_botmbg"></div>
    </div>
    
    <div class="clear"></div>
    </div>
      <? include("footer.php"); ?>
</div>
</body>
</html>
   <script type='text/javascript' src='http://code.jquery.com/jquery-1.9.1.js'></script>
<script>
function validation()
{	
	old_pwd = document.getElementById('old_pwd').value;
	if(old_pwd=="") 
	{ 
		alert("Please enter old password");		
		document.getElementById('old_pwd').focus();			
		return false;
	}	
	else{
		function pswd_exists(old_pwd) {
			var result= null;
			$.ajax({
				url: 'checkpwd.php',				
				data: {oldpass: old_pwd},				
				cache: false,
				async: false, // boo!
				success: function(data) {
					result= data;								
				}
			});			
			return result;				
			}
			
			var cntvalue=pswd_exists(old_pwd);	
			
				if(cntvalue==0 || (cntvalue=='') || (cntvalue!=1))
				{
				alert("Invalid old password");						
				document.getElementById('old_pwd').focus();	
				return false;					
				
			}
	}

	new_pwd = document.getElementById('new_pwd').value;
	if(new_pwd=="") 
	{ 
		alert("Please enter new password");		
		document.getElementById('new_pwd').focus();			
		return false;
	}
	
	cfrm_pwd = document.getElementById('cfrm_pwd').value;

	if(cfrm_pwd=="") 
	{ 
		alert("Please enter confirm password");		
		document.getElementById('cfrm_pwd').focus();			
		return false;
	}
	else if(new_pwd!=cfrm_pwd) 
	{ 
<<<<<<< HEAD
		alert("Password and confirm password must be same");		
=======
		alert("Please confirm your password");		
>>>>>>> 72b5b01fa70f0fba2e589a992e66ccb9ab41f4bc
		document.getElementById('cfrm_pwd').focus();			
		return false;
	}
		
}

<<<<<<< HEAD

/*var reg= /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/;
function countValid(new_pwd)
{  
	var OK = reg.exec(new_pwd.value);  
	if (!OK)  
	window.alert("Please enter at least 8 characters.");  
}
*/
=======
>>>>>>> 72b5b01fa70f0fba2e589a992e66ccb9ab41f4bc
</script>