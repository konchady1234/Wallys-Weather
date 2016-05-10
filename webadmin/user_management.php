<? 
session_start(); ob_start();
include_once('../lib/config.php');
include_once('../lib/mysql_class.php');
$sql=new mysql();
$table="web_user";

if($_SESSION['admin_id']=="")
{
header('Location:index.php');exit();
}


		//////////////////////////////Update Field///////////////////////////////////////////		
		
		$field=array();
				
		$field['user_name']=$_REQUEST['user_name'];	
				
		$field['user_email']=$_REQUEST['user_email'];
		
		$field['user_status']=$_REQUEST['user_status'];
		
		//////////////////////////////Action///////////////////////////////////////////
		
		$web_id=$_REQUEST['web_id'];
		
		if($_REQUEST['action']!="")
		{	
			
			if(isset($_REQUEST['add']))
			{							
			 	$res=$sql->add_query($field,$table);
				if($res==true){$msg="Inserted successfully";  }				
			}
			
			if(isset($_REQUEST['edit']))
			{	
			$where="where user_id=".$web_id;	
			$res=$sql->update_query($field,$table,$where);
			if($res==true){	$msg="Updated  successfully!";}	
			}
			
			if($_REQUEST['action']=="delete")
			{
			$where="where user_id =".$web_id." limit 1";		
			$res=$sql->delete_query($table,$where);
			if($res==true){$msg="deleted  successfully!";}
			}	
			
			
				if($_REQUEST['action']=="enable")
			{
				$sql=mysql_query("update $table set user_status='1' where user_id=".$web_id);				
				$msg="Enabled  successfully!";	
				?><script>window.location.href="user_management.php?msg=<?=$msg?>";</script><?	
			}
			if($_REQUEST['action']=="disable")
			{
				$sql=mysql_query("update $table set user_status='0' where user_id=".$web_id);
				


                $msg="Disabled  successfully!";
				?><script>window.location.href="user_management.php?msg=<?=$msg?>";</script><?
				

			}
			
			
			
			if($msg!="")
			{
			header('Location:user_management.php?msg='.$msg);exit();		
			}
		}


?>
<!----------------------------------Content--------------------------------------------------------->


<link href="css/admin_stlyz.css" type="text/css" rel="stylesheet" />

<script type="text/javascript" language="javascript1.2" src="ckeditor/ckeditor.js"></script>

	
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
	
	<script type="text/javascript">
$(document).ready(function() {
	$('#example').DataTable();
} );


	</script>
    <body id="innerbg">
<div>
	 <? include("header.php"); ?>
        
   
    
    <div class="cont_right"  >    
    	   <div class="content">       		 
       		
             <? 
			  if($_REQUEST['msg']!="") {  ?>
             <div style="color: green; text-align: center;"><?=$_REQUEST['msg']?></div>
             
             <? } ?>
             
             
             <div >
             <h2  class="cbt_head"><?=$sitetitle?> - User Management
             <? if($_REQUEST['action']=="add") { ?>
            - Add
            <? } else if($_REQUEST['action']=="edit") { ?>
            - Edit
            <? } else if($_REQUEST['action']=="view") { ?>
            - View
             <? } ?></h2>
             </div>
             <div  class="addlink">
             <? if($_REQUEST['web_id']=="" && ($_REQUEST['action']!="add")) {  ?><!--<a href="user_management.php?action=add" class="add" >Add</a>--><?  }  ?>
             </div>
             <div class="clear"></div>
             <div class="space"></div>
             <?  
			if(($_REQUEST['action']=="add") || ($_REQUEST['action']=="edit"))
			{
				 	  if($_REQUEST['action']=="edit")
					  {
						$where="where user_id ='".$web_id."'";
						$res=$sql->select_query($table,$where);											
					  }
			?>   
                <form action="#" method="post" enctype="multipart/form-data" name="form1" id="form1">  
                
                <div>                
                        
                 <div class="hd_left">Username <font color="#FF0000">*</font> </div>	
                 <div class="colon">:</div>		
                 <div class="des"><input type="text" name="user_name" id="user_name" class="textbox" onChange="checkusername()"   value="<?=($res[0]['user_name'])?>"  ><div id="web_username1" style="color:#F00"></div>	</div>	
                 <div class="clear"></div>	
                 <div class="space"></div>
                 
                 
                 <div class="hd_left">Email <font color="#FF0000">*</font> </div>	
                 <div class="colon">:</div>		
                 <div class="des"><input type="text" name="user_email" id="user_email" class="textbox" onChange="checkemail()"  value="<?=($res[0]['user_email'])?>"  ><div id="web_email1" style="color:#F00"></div></div>	
                 <div class="clear"></div>	
                 <div class="space"></div>
                 
                 
                 
                 <div class="hd_left">Password <font color="#FF0000">*</font> </div>	
                 <div class="colon">:</div>		
                 <div class="des">*****</div>	
                 <div class="clear"></div>	
                 <div class="space"></div>
                 
                 
                 <input type="hidden" name="user_status" id="user_status" value="<?=$res[0]['user_status']?>"/>
                 <div class="space">&nbsp;</div>             
                 <div class="hd_left">&nbsp;</div>	
                 <div class="colon">&nbsp;</div>		
                 <div class="des">
                 <? if($_REQUEST['action']=="add" ) { 
				 ?><input class="button orange" type="submit" value='Submit' name="add"  onclick='return validation()'  /> <?				 
				  } else {?><input class="button orange" type="submit" value='Submit' name="edit"  onclick='return validation()'  /> <? } ?>
                  &nbsp;<input class="button orange" type="submit" value='Cancel' name="cancel"  onclick='return homepage()'  />
                 
                 </div>	
                 <div class="clear"></div>	
                 
                 <div class="space"></div>  
                
                </div>           
                
            	</form>
                <?
				
			}
			else if($_REQUEST['action']=="view" )
			{				
				$where="where user_id ='".$web_id."'";
				$res=$sql->select_query($table,$where);
			?>
                   
           	 <div class="hd_left">Username</div>	
             <div class="colon">:</div>		
             <div class="des"> <?=($res[0]['user_name'])?></div>	
             <div class="clear"></div>	
             
             
             <div class="space"></div>	
              <div class="hd_left">Email</div>	
             <div class="colon">:</div>		
             <div class="des"> <?=($res[0]['user_email'])?></div>	
             <div class="clear"></div>	
             
             <div class="space"></div>	
             
             <!--<div class="space"></div>             
           	 <div class="hd_left">Image </div>	
             <div class="colon">:</div>		
             <div class="des">
              <img src="../webupload/thumb/privacypolicy/<?=$res[0]['web_image']?>" border="0"   style="vertical-align:top" alt="<?=$sitetitle?>"/>
             </div>	
             <div class="clear"></div>	                  
             <div class="space"></div> -->
                        
           	 <div class="hd_left">Password </div>	
             <div class="colon">:</div>		
             <div class="des"> ***** </div>	
             <div class="clear"></div>	
                    
             <div class="space"></div>	
              <div class="hd_left">Status</div>	
             <div class="colon">:</div>		
            <? if($res[0]['user_status']==1)
			  {?>	
             <div class="des">
             
              Active</div>	
              <? } else { ?>
                 <div class="des">
             
              Inactive</div>
              <? } ?>	
             <div class="clear"></div> 
             <div class="space"></div> 
             
             
                         
             <div class="space"></div>             
           	 <div class="hd_left">&nbsp;</div>	
             <div class="colon">&nbsp;</div>		
             <div class="des"><input class="button orange" type="submit" value='Back' name="back"  onClick="history.go(-1);return true;"/></div>	
             <div class="clear"></div>	             
             <div class="space"></div>             
                
                <?				
			}
			else
			{	
			?>
            <div  class="row">
             <table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
             <th>S.No</th>
                <th> Username</th>
                <th> Email</th>
                <th> Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        
          
          
          
  <? $i=1;
	$res=$sql->select_query($table," order by user_id desc");
		foreach($res as $res){  ?>
        	<tr>
            <td><?=$i?></td>
        	<td><?=($res['user_name'])?></td>
<? //echo $res['web_content'];  ?>
        	<td>            <?=$res['user_email'];?>
            
            </td>
            
            
             <td>
              <?  if($res['user_status']==1) { ?>
                <a href="user_management.php?web_id=<?=$res['user_id']?>&action=disable" class="action" ><img src="images/publish.png" border="0" alt="" height="16" width="16" title="Published" style="margin-top:10px;"></a>
                <? } else { ?>
                <a href="user_management.php?web_id=<?=$res['user_id']?>&action=enable" class="action"><img src="images/unpublish.png" border="0" alt="" height="16" width="16" title="Unpublished" style="margin-top:10px;"></a>
                
			<? } ?>
				
				</td>

            
            <td><a href="user_management.php?web_id=<?=$res['user_id']?>&action=view" class="action">View</a>
				<!--&nbsp;/&nbsp;<a href="user_management.php?web_id=<?=$res['user_id']?>&action=edit" class="action">Edit</a>	-->
                &nbsp;/&nbsp;<a href="user_management.php?web_id=<?=$res['user_id']?>&action=delete" onClick="return confirmDelete();"  class="action">Delete</a>	
                	</td>
            
            
            
        </tr>
        
        <? $i++; } ?>
        </tbody>
       
    </table>

            
            <? } ?>
            
         



      
</div>        
       
        
    </div>
    
    <div class="clear"></div>
    </div>
    
     <div class="clear"></div>
    </div>
      <? include("footer.php"); ?>
</div>
</body>
</html>
	
	
<!-------------------------------------------------------------------------------------------------->
<script type="text/javascript">
function validation()
{
	web_title = document.getElementById('user_name').value;
	if(web_title=="") 
	{ 
		alert("Please enter the username");
		document.getElementById('web_title').select();	
		document.getElementById('web_title').focus();			
		return false;
	}

	web_email = document.getElementById('user_email').value;
	if(web_email=="") 
	{ 
		alert("Please enter the email");
		document.getElementById('user_email').select();	
		document.getElementById('user_email').focus();			
		return false;
	}
	else if(document.getElementById('user_email').value!="")
{
EA=document.getElementById('user_email').value;
EA = EA.toLowerCase();
if((EA.substring(0,1)<"a" || EA.substring(0,1)>"z") && (EA.substring(0,1)<"A" || EA.substring(0,1)>"Z"))
{
alert('Invalid additional email address');
document.getElementById('user_email').select();
document.getElementById('user_email').focus();
return false;
}
else if(!checkemail(EA))
{
alert('Invalid additional email address');
document.getElementById('user_email').select();
document.getElementById('user_email').focus();
return false;
}
function checkemail(str)
{
var str;

var filter = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);

if (filter.test(str))
testresults=true
else
{
testresults=false
}
return (testresults)
}
	

	
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
function homepage()
	{		
	window.location.href ="<?=$_SERVER['HTTP_REFERER']?>";
	return false;
	}
	
	function checkemail()
{

	$.ajax({
	
type: 'post',

url: 'checkemail_user.php',
data: $('#web_email').serialize(),

success: function (result) {
	//alert(result);
if(result==1){

$("#web_email1").html("Email Id Already exisis");
document.getElementById('web_email').value="";
document.getElementById('web_email').focus();

}
else{

$("#web_email1").html("");
}
}

});
}


function checkusername()
{

	$.ajax({
	
type: 'post',

url: 'checkusername_user.php',
data: $('#user_name').serialize(),

success: function (result) {
	//alert(result);
if(result==1){

$("#web_username1").html("Username Already exisis");
document.getElementById('user_name').value="";
document.getElementById('user_name').focus();

}
else{

$("#user_name").html("");
}
}

});
}



</script>
<style>

.hd_left
{width:80px;}

.des
{width:700px;

}

</style>
