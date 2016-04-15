<?  
session_start(); ob_start();
include_once('../lib/config.php');
include_once('../lib/mysql_class.php');
$sql=new mysql();
$table="image";
//error_reporting (E_ALL ^ E_NOTICE);

/*if($_SESSION['web_id']=="")
{
header('Location:index.php');exit();
}*/

	$web_id=$_REQUEST['web_id'];	
// image upload

if($_FILES['image']['name']!= "")
	{
		list($width,$height) = getimagesize($_FILES['image']['tmp_name']); 
	
		if($width<177||$height<178)
		{
			
			$banner = $_FILES['image']['name'];
			$source = $_FILES['image']['tmp_name'];
			$banner = time().$banner;
			$originalpath = "../webupload/original/company/".$banner;
			$thumbnailpath = "../webupload/thumb/company/";
			$smallpath = "../webupload/small/company/";
			$iconimage = "../webupload/icon/company/";
			move_uploaded_file($source,$originalpath);
			$parts=explode(".",$banner);
			$banner=$parts[0].".png";
			include_once('imgresize.php');
			resize($originalpath, $thumbnailpath.$banner,177,178);
			resize($originalpath, $smallpath.$banner, 100,101);
			resize($originalpath, $iconimage.$banner, 70, 70);
		}
		else
		{
			include('resize.php');
			$banner = $_FILES['image']['name'];
			$source = $_FILES['image']['tmp_name'];
			$banner = time().$banner;
			$originalpath = "../webupload/original/company/".$banner;
			$thumbnailpath = "../webupload/thumb/company/".$banner;
			$smallpath = "../webupload/small/company/".$banner;
			$iconimage = "../webupload/icon/company/".$banner;
			move_uploaded_file($source,$originalpath);
			$objimg = new SimpleImage();
			$objimg -> load($originalpath);
			$objimg -> resize(177,178);
			$objimg -> save($thumbnailpath);
			$objimg -> save($smallpath);
			$objimg -> resize(70,70);
			$objimg -> save($iconimage);
		}
}
else
{
	$banner=$_REQUEST['theValue'];
}

// end		
		
		//////////////////////////////Update Field///////////////////////////////////////////		
		
		$field=array();		
		$field['title']=stripslashes($_REQUEST['title']);	
		$field['image']=$banner;

			
		//////////////////////////////Action///////////////////////////////////////////
		if($_REQUEST['action']!="")
		{	
			
			if(isset($_REQUEST['add']))
			{	 		
			 	$res=$sql->add_query($field,$table);				
				if($res==true){$msg="Inserted successfully"; 
				
				 }				
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
			if($_REQUEST['action']=="enable")
		    {
             $act="update $table set web_status = 1 where web_id = '$web_id'";
             mysql_query($act);		
		     ?>
            <script>window.location="banner.php"</script>
            <?
            }
		if($_REQUEST['action']=="disable")
		{
         $act="update $table set web_status = 0 where web_id = '$web_id'";
          mysql_query($act);		
          ?>
          <script>window.location="banner.php"</script>
          <?
         }
			if($msg!="")
			{
			header('Location:banner.php');exit();	
			}
		}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Image Management - <?=$sitetitle?></title>
<link href="css/admin_stlyz.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" language="javascript1.2" src="ckeditor/ckeditor.js"></script>
</head>

<body id="innerbg">
<div>
  <? include("header.php"); ?>
    <div class="cont_right"  >
    
    	<h2 style="color: #66a8da;">Image Management <? if($_REQUEST['action']=="add") { ?>
            - Add
            <? } else if($_REQUEST['action']=="edit") { ?>
            - Edit
            <? } else if($_REQUEST['action']=="view") { ?>
            - View
             <? } ?></h2>                  
             <div  class="addlink">
             <? if($_REQUEST['web_id']=="" && ($_REQUEST['action']!="add")) {  ?>
             <a href="banner.php?action=add" class="add" >Add</a><?  }  ?>
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
                 <div class="des"><input type="text" name="title" id="title" class="textbox" value="<?=htmlentities(stripslashes($res[0]['title']))?>"  ></div>	
                 <div class="clear"></div>	
               
                 <div class="space"></div>
                 
                 <div class="hd_left">Image <font color="#FF0000">*</font></div>	
                 <div class="colon">:</div>		
                 <div class="des">                 
                  <input type="file" name="image" id="image" size="34" class="textbox"   onchange="return test();" />
                 <input type="hidden" value="<?=$res[0]['image']?>" id="theValue" name="theValue" />
               <? if($_REQUEST['web_id'] == 4){?>
				 <span style="color:#090;"><b>Image size 512 X 325 pixels.</b></span>
				 <? } else {?>
				  <span style="color:#090;"><b>Image size 398 X 318 pixels.</b></span>
				 <? } ?>
                 
                 <? if($res[0]['image']!=''){ ?>
                
                 <img src="<?=$sitepath?>webupload/icon/company/<?= $res[0]['image']; ?>" border="0" class="imgborder"  style="vertical-align:top" alt=""  />
                
  				 
				 <? } ?>
                                          
                 </div>	
                 <div class="clear"></div>	
                 
                              
                 <div class="space">&nbsp;</div>             
                 <div class="hd_left">&nbsp;</div>	
                 <div class="colon">&nbsp;</div>		
                 <div class="des">
              <? if($_REQUEST['action']=="add" ) { 
				 ?><input class="submit_btn" type="submit" value='Submit' name="add"  onclick='return validation()'  /> <?				 
				  } else {?><input class="submit_btn" type="submit" value='Submit' name="edit"  onclick='return validation()'  /> <? } ?>
                  &nbsp;<input class="submit_btn" type="submit" value='Cancel' name="cancel"  onclick='return homepage()'  />
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
             <div class="des"> <?=get_symbol($res[0]['title'])?></div>	
             <div class="clear"></div>	
             
             <div class="space"></div>
              
           	 <div class="hd_left">Image </div>	
             <div class="colon">:</div>		
             <div class="des"> 
			  <img src="<?=$sitepath?>webupload/small/company/<?=$res[0]['image']; ?>" border="0"  />
             </div>	
             <div class="clear"></div>	
              <div class="space"></div>   
             <div class="hd_left">&nbsp;</div>	
             <div class="colon">&nbsp;</div>		
             <div class="des"><input class="submit_btn " type="submit" value='Back' name="back"  onclick='return homepage()'  /></div>	
             <div class="clear"></div>	             
             <div class="space"></div>               
                    
			  <?				
			}
			else
			{	
			?>
              <div  class="row">
            <div >
            <div class="hd_rw" style="width:60px;">No</div>
            <div class="hd_rw" style="width:180px;" >Title</div> 
            <div class="hd_rw brd_rgt0" style="width:375px;">Image</div>
            <div class="hd_rw brd_rgt0" style="width:230px;">Action</div>
            
            <div class="clear"></div>
            </div>  
            <div id="rw_color"> 
            <ul>
             <?	
			
				$cnt=$sql->cnt_table($table, "");
				$per_page = 20;
				if($cnt>$per_page){include('paging.php');}
				else {$start="0";}
					
				$where=" order by web_id asc";
				$res=$sql->view_query($table,$where);	
				$cnt=count($res);
				if($cnt!='' || ($cnt!=0))			
				{ $a=1;				
				foreach($res as $res){ 
				
				?>
            <li>
                  <div class="rw" style="width:49px;height:60px;line-height:60px; text-align:center;"><?=$a?></div>
				<div class="rw" style="width:170px;height:60px;line-height:60px;text-align:center;" ><?=$res['title']?>
               </div>	
               <div class="rw" style="width:365px; height:60px;line-height:60px;text-align:center;" >
                 <img src="<?=$sitepath?>webupload/icon/company/<?= $res['image']; ?>" border="0"  />
</div>
                <div class="rw" style="width:221px;height:60px;line-height:60px; text-align:center;">
				<a href="banner.php?web_id=<?=$res['web_id']?>&action=view" class="action">View</a>
				&nbsp;/&nbsp;<a href="banner.php?web_id=<?=$res['web_id']?>&action=edit" class="action">Edit</a>
				&nbsp;/&nbsp;<a href="banner.php?web_id=<?=$res['web_id']?>&action=delete&sortid=<?=$pos1?>" class="action" onClick="return confirmDelete();">Delete</a>
				</div>  
				<div class="clear"></div>
			<?
				$a++;}
				echo $msg;
				}
			else
			{
				?><div class="norecord">No Record Found!</div><?
			}
			?>
             </ul></div>
            </div>    
            <?
			}
			?>

    </div>
       </div>
    <div class="clear"></div>
    </div>
      <? include("footer.php"); ?>
</div>
</body>
</html>
<script>
function validation()
{
	title = document.getElementById('title').value;
	if(title=="") 
	{ 
		alert("Please enter title");		
		document.getElementById('title').focus();			
		return false;
	}	
	image = document.getElementById('theValue').value;
	if(image=="") 
	{ 
		alert("Please upload image");		
		document.getElementById('image').focus();			
		return false;
	}
	
	
	
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
function test()
{	
document.getElementById('theValue').value=document.getElementById('image').value;
return true;
}
function homepage()
	{		
	window.location.href ="banner.php";
	return false;
	}
</script>
