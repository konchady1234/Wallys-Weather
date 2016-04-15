<?
 session_start(); ob_start();
include_once('lib/config.php');
include_once('lib/mysql_class.php');
$sql=new mysql();  

$table_img="blog";
$where_img= "order by web_id";
$res_img=$sql->view_query($table_img,$res_img);


$id=base64_decode($_REQUEST['blogid']);
$blog=$sql->select_query("blog"," where web_id=".$id);



if(isset($_REQUEST['blog_comment_submit']))
			{	
			$field=array();		

$field['blogid']=$_REQUEST['comment']; 
$field['comment']=get_entity($_REQUEST['blog_comment_box']);	

				$field['date']=date("Y-m-d H:i:s");										
			 	$res=$sql->add_query($field,"comment");
				
					if($res==true){$msg="Inserted";  ?><script>window.location.href="blog.php?blogid=<?=$_REQUEST['blogid']?>&act=comment_added";</script><? }
   }

?>


<div class="wrapper">
<? include('header.php')?>
<div class="clear"></div>

<div class="box1">
<? 
if($_REQUEST['act']=="comment_added")

{ ?>
<div class="color"> 
Your comment has been successfully posted!</div>
<? } ?>
<div class="image"><img src="webupload/thumb/image/<?=$res_img[0]['image']?>" /></div>
<div class="content">
<h2><?=$res_img[0]['heading']?></h2>
<p><?=$res_img[0]['content']?> <?=$res_img[0]['content']?> <?=$res_img[0]['content']?></p>
<div class="x">
<!--<div class="comment"><img src="images/comment_icon.png" /><p><a href="#">3 comments</a></p></div>-->
<div class="date"><img src="images/cleander.png" /><p><?=$res_img[0]['date']?></p></div>
</div>
</div>
<div class="clear"></div>
<?
      $num_count=mysql_num_rows(mysql_query("select * from comment where blogid=".$id)); ?>
      <div class="photo">
      <img src="images/comment_icon.png">
      </div>
               <div class="head">Comments (<?=$num_count?>)</div>
			   
			   
				   
<div class="head" ><a href="#"  id="show_comments" >Show/ Hide Comments</a></div>
<div id="comments_section" style="display:none" >
	<? 
	$blog_comments=$sql->select_query("comment", "where blogid=".$id);  
    foreach($blog_comments as $blog_comments) { ?>
        <div class="comment_row">
        
        <div class="comnt_area"> <?=get_symbol($blog_comments['comment']);?></div>
        <div class="cmnt_by"><p><? echo date('M d Y', strtotime(get_symbol($blog_comments['date']))); ?></p> </div>
        <div class="clear"></div>
    </div>
    <? 
    }?>
</div>
 
<form name="blog_comment_form" id="blog_comment_form" method="post" action="" novalidate="novalidate">
                 <div class="comment_box">
				 
				 <input type="hidden" name="comment" id="comment" value="<?=base64_decode($_REQUEST['blogid'])?>">
                  <textarea name="blog_comment_box" id="blog_comment_box" placeholder="Enter your comment" required="required"></textarea>
                  <div class="blogBtns"><input type="submit" value="Send" name="blog_comment_submit" id="blog_comment_submit" class="button"></div>
                  </div>	
                 </form>
                 </div>
                 <div class="clear"></div>

<? include('footer.php') ?>

<script type="text/javascript" src="js/jquery.min.js"></script>

<script>
$(function(){
    $("#show_comments").click(function(){
   $("#comments_section").toggle();
    });
	
  });
  </script>
  <!--<script src="js/jquery.js"></script>-->
	<script src="js/jquery.validate.js"></script>
	<script>
	$(document).ready(function() {
		$("#blog_comment_form").validate({
			rules: {
				blog_comment_box: "required",
				
			},
			messages: {
				blog_comment_box: "Please enter comment",

			}
		});
		});
		</script>


