<? 
session_start(); ob_start();
include_once('../lib/config.php');
include_once('../lib/mysql_class.php');
$sql=new mysql();
$table="faq";

if($_SESSION['admin_id']=="")
{
header('Location:index.php');exit();
}
$web_img=$_FILES['web_image']['name'];
		if($web_img != "")
		{
			$imgname = get_entity($web_img);
			list($width, $height) = getimagesize($_FILES['web_image']['tmp_name']);
			if($width < 200 || $height < 200)
			{				
				$srce = $_FILES['web_image']['tmp_name'];
				$orgi = "../webupload/original/privacypolicy/".$web_img;				
				$thumb = "../webupload/thumb/privacypolicy/";
				move_uploaded_file($srce,$orgi);					
				$parts=explode(".",$web_img);
				$up=$parts[0].".png";
				include_once('imgresize.php');	
	$imgname=$up;	
				resize($orgi, $thumb.$up, 200, 200);					
			}
			else
			{			
			$source = $_FILES['web_image']['tmp_name'];		    
			include("resize-class.php");
			$originalpath  = "../webupload/original/privacypolicy/".$imgname;
			$thumbnailpath = "../webupload/thumb/privacypolicy/".$imgname;			
			move_uploaded_file($source,$originalpath);		
			$resizeObj = new resize($originalpath);		
			$resizeObj -> resizeImage(200,200, 'crop');
			$resizeObj -> saveImage($thumbnailpath, 100);
			}				
		
		
		}
		else { $imgname=get_entity($_REQUEST['theValue']); }
		

		//////////////////////////////Update Field///////////////////////////////////////////		
		
		$field=array();		
		$field['web_title']=get_entity($_REQUEST['web_title']);	
				
		$field['web_content']=addslashes($_REQUEST['web_content']);
		
		
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
			$where="where web_id=".$web_id;	
			$res=$sql->update_query($field,$table,$where);
			if($res==true){	$msg="Updated  successfully!";}	
			}
			
			if($_REQUEST['action']=="delete")
			{
			$where="where web_id =".$web_id." limit 1";		
			$res=$sql->delete_query($table,$where);
			if($res==true){$msg="deleted  successfully!";}
			}	
			
			if($msg!="")
			{
			header('Location:faq.php?msg='.$msg);exit();		
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
             <h2  class="cbt_head"><?=$sitetitle?> - FAQ
             <? if($_REQUEST['action']=="add") { ?>
            - Add
            <? } else if($_REQUEST['action']=="edit") { ?>
            - Edit
            <? } else if($_REQUEST['action']=="view") { ?>
            - View
             <? } ?></h2>
             </div>
             <div  class="addlink">
             <? if($_REQUEST['web_id']=="" && ($_REQUEST['action']!="add")) {  ?><a href="faq.php?action=add" class="add" >Add</a><?  }  ?>
             </div>
             <div class="clear"></div>
             <div class="space"></div>
             <?  
			if(($_REQUEST['action']=="add") || ($_REQUEST['action']=="edit"))
			{
				 	  if($_REQUEST['action']=="edit")
					  {
						$where="where web_id ='".$web_id."'";
						$res=$sql->select_query($table,$where);											
					  }
			?>   
                <form action="#" method="post" enctype="multipart/form-data" name="form1" id="form1">  
                
                <div>                
                        
                 <div class="hd_left">Title <font color="#FF0000">*</font> </div>	
                 <div class="colon">:</div>		
                 <div class="des"><input type="text" name="web_title" id="web_title" class="textbox"  value="<?=get_symbol($res[0]['web_title'])?>"  ></div>	
                 <div class="clear"></div>	
                 <div class="space"></div>
                 
                 
                 
                 
                       
             
                            
                 <div class="hd_left">Description <font color="#FF0000">*</font></div>	
                 <div class="colon">:</div>		
                 <div class="des">                 
                 <textarea name="web_content" id="web_content" class="textarea"><?//=mb_substr(strip_tags(stripslashes(get_symbol($res['web_content']))));?><?=stripslashes($res[0]['web_content'])?></textarea>
                 <script type="text/javascript">			
                                        var ckedit=CKEDITOR.replace("web_content", 
                                        {
                                        height:"400", width:"690",
										filebrowserBrowseUrl : 'ckeditor/ckfinder/ckfinder.html',
										filebrowserImageBrowseUrl : 'ckeditor/ckfinder/ckfinder.html?type=Images',
										filebrowserFlashBrowseUrl : 'ckeditor/ckfinder/ckfinder.html?type=Flash',
										filebrowserUploadUrl : 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
										filebrowserImageUploadUrl : 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
										filebrowserFlashUploadUrl : 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                                        });
                                        </script>
                                          
                 </div>	
                 <div class="clear"></div>	
                 
             
                 
                 
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
				$where="where web_id ='".$web_id."'";
				$res=$sql->select_query($table,$where);
			?>
                   
           	 <div class="hd_left">Title</div>	
             <div class="colon">:</div>		
             <div class="des"> <?=get_symbol($res[0]['web_title'])?></div>	
             <div class="clear"></div>	
             
             	
             
             <!--<div class="space"></div>             
           	 <div class="hd_left">Image </div>	
             <div class="colon">:</div>		
             <div class="des">
              <img src="../webupload/thumb/privacypolicy/<?=$res[0]['web_image']?>" border="0"   style="vertical-align:top" alt="<?=$sitetitle?>"/>
             </div>	
             <div class="clear"></div>	                  
             <div class="space"></div> -->
             
             <div class="space"></div>             
           	 <div class="hd_left">Description </div>	
             <div class="colon">:</div>		
             <div class="des"> <?=stripslashes($res[0]['web_content'])?></div>	
             <div class="clear"></div>	
                    
             
             
                         
             <div class="space"></div>             
           	 <div class="hd_left">&nbsp;</div>	
             <div class="colon">&nbsp;</div>		
             <div class="des"><input class="button orange" type="submit" value='Back' name="back"  onclick='return homepage()'  /></div>	
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
                <th> Title</th>
                <th> Description</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        
          
          
          
  <? $i=1;
	$res=$sql->select_query($table," order by web_id desc");
		foreach($res as $res){  ?>
        	<tr>
            <td><?=$i?></td>
        	<td><?=get_symbol($res['web_title'])?></td>
<? //echo $res['web_content'];  ?>
        	<td><?=mb_substr(strip_tags(html_entity_decode(stripslashes(get_symbol($res['web_content'])), ENT_QUOTES, 'UTF-8')), 0,70) .'...';?>
            <?//=strip_tags(substr($res['web_content'],0,70));?>
            
            </td>

            
            <td><a href="faq.php?web_id=<?=$res['web_id']?>&action=view" class="action">View</a>
				&nbsp;/&nbsp;<a href="faq.php?web_id=<?=$res['web_id']?>&action=edit" class="action">Edit</a>	
                &nbsp;/&nbsp; <a href="faq.php?web_id=<?=$res['web_id']?>&action=delete" onClick="return confirmDelete();"  class="action">Delete</a>
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
	web_title = document.getElementById('web_title').value;
	if(web_title=="") 
	{ 
		alert("Please enter the title");
		document.getElementById('web_title').select();	
		document.getElementById('web_title').focus();			
		return false;
	}

	var editorcontent = CKEDITOR.instances['web_content'].getData().replace(/<[^>]*>/gi, '');
	if(editorcontent=='')
	{
	alert('Please enter your web_content!');			
    return false;
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
</script>
<style>

.hd_left
{width:80px;}

.des
{width:700px;

}

</style>
