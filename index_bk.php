<?
 session_start(); ob_start();
include_once('lib/config.php');
include_once('lib/mysql_class.php');
$sql=new mysql();  

$table_banner="image";
$where_banner= "order by web_id";
$res_banner=$sql->view_query($table_banner,$where_banner);

$table_img="blog";
$where_img= "order by web_id";
$res_img=$sql->view_query($table_img,$res_img);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home - wally</title>
<link href="css/style.css" type="text/css" rel="stylesheet" />
</head>

<body>
<div class="wrapper">
<? include('header.php') ?>
<div class="clear"></div>
 <div class="four">

        <? foreach($res_banner as $res_banner) {
			  ?>
<div class="one"><div class="img1"><img src="webupload/thumb/company/<?=$res_banner['image']?>" /></div><div class="clear"></div><div class="heading"><h3><?=$res_banner['title']?></h3></div></div>
            <? } ?>

<!--<div class="one"><div class="img1"><img src="images/sunny.png" /></div><div class="clear"></div><div class="heading"><h3>Sunny</h3></div></div>
<div class="one"><div class="img1"><img src="images/somesunandsnow.png" /></div><div class="clear"></div><div class="heading1"><h3>Some Sun And Snow</h3></div></div>
<div class="one"><div class="img1"><img src="images/rainallday.png" /></div><div class="clear"></div><div class="heading2"><h3>Rain All Day</h3></div></div>
<div class="one"><div class="img1"><img src="images/thunderandrain.png" /></div><div class="clear"></div><div class="heading3"><h3>Thunder And Rain</h3></div></div>
<div class="one"><div class="img1"><img src="images/mostlysunny.png" /></div><div class="clear"></div><div class="heading4"><h3>Mostly Sunny</h3></div></div>
<div class="one"><div class="img1"><img src="images/cold-andcoludy.png" /></div><div class="clear"></div><div class="heading5"><h3>Cold And Clowdy</h3></div></div>
<div class="one"><div class="img1"><img src="images/snowing.png" /></div><div class="clear"></div><div class="heading6"><h3>Snowing</h3></div></div>
<div class="one"><div class="img1"><img src="images/sun&rain.png" /></div><div class="clear"></div><div class="heading7"><h3>Sun And Rain</h3></div>--></div>

<div class="clear"></div>
<div class="title"><img src="images/titleline.png" /><h1>&nbsp;From the blog&nbsp;</h1><div class="imgg"><img src="images/titleline.png" /></div></div>
<div class="clear"></div>
 
 <? foreach($res_img as $res_img) {
			  ?>
              <? $num_count=mysql_num_rows(mysql_query("select * from comment where blogid=".$res_img['web_id'])); ?>

<div class="box">
<div class="image"><img src="webupload/thumb/image/<?=$res_img['image']?>" /></div>
<div class="content">
<a href="blog.php?blogid=<?=base64_encode($res_img['web_id'])?>" ><h2><?=$res_img['heading']?></h2></a>
<p><?= substr($res_img['content'],0,100)?>...</p>
<div class="x">
<div class="comment"><img src="images/comment_icon.png" /><p><?=$num_count?> comments</p></div>
<div class="date"><img src="images/cleander.png" /><p><?=$res_img['date']?></p></div>
<div class="read"><p><a href="blog.php?blogid=<?=base64_encode($res_img['web_id'])?>" >Read more...</a></p></div>
</div>
</div>
</div>
            <? } ?>



<div class="clear"></div>
<? include('footer.php') ?>
</div>
</body>
</html>