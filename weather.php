<?php 
/*	PAGE ID				:PHP#
	WEBSITE NAME		:Wallys Weather
	DEVELOPED BY		:Zerosoft [www.zerosofttech.com]
	CREATED ON			:4/29/2016
	AUTHOR				:ZST1043
	DESCRIPTION			:This one is wather related information displayed page*/
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Weather - Wallys Weather</title>
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link rel="icon" href="Sliced images/favicon.png" type="image/x-icon">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="DESCRIPTION" content ="Wally's Weather is a weather page setup to make observations of major weather events across Australia but in particular the Queensland tropics. It has since become a popular site for people across Australia to discuss and ask questions about forecasts and weather information."/> 
<meta name="KEYWORDS" content="Wallys, Wallys Weather, Wally, Weather winter, sunny, Weather sunny, Australia weather detector,
australian weather, weather in australia, weather condition, australian weather, weather in australia, weather condition, Wally’s Weather page, Queensland tropics weather, Queensland tropics weather, weather events across Australia, weather information, road conditions, climate blogs and community communication, Synoptic Charts, Satellite Imagery, Forecast charts, Observation data " />

<!--For External CSS sheet-->
<link href="css/style.css" type="text/css" rel="stylesheet" />
</head>
<div class="wrapper">
    <? include('header.php')?>
    <div class="clear"></div>
    <div class="box1" style="height: auto; padding:10px;">
        <h1  class="hBotVal" style="padding: 9px;border-bottom: 1px solid #a7def7;">
    		Wally's Weather App <span class="lik"><a href="dev.html">Sign-In</a> <span style="color: #446586; font-weight:bold">|</span> <a href="dev.html">Subscribe</a></span></h1><br /><br />
        <h2>Current Weather for your location : </h2><br />
        <p>Select Location : <input type="text" class="wInput" value=""></p>
        <h2>Today's Facebook Posts : </h2><br />
        <p>Search Facebook Posts : <input type="text" class="wInput" value=""><p>
        <p>
        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
        </p><br />
        <h2>Weather Maps :</h2><br />
        <canvas id="canvas" width="1100" height="600"  style="border:0px solid #ccc"></canvas><br />
        <p>Region View : </p><br />
        <select id="basemap" class="selInp">
            <option value='' selected>QLD</option>
            <option value=''>Coral Sea</option>
        </select>
        <span class="blogBtns btnPad"><input type="submit" value="Radar" class="button"></span>
        <span class="blogBtns btnPad"><input type="submit" value="Satellite" class="button"></span>
        <span class="blogBtns btnPad"><input type="submit" value="Model" class="button"></span><br /><br />
        <h2>Weather Knowledge Base:</h2><br />
        <p>Frequently asked questions</p><br />
    </div>
</div>
<div class="clear"></div>
<? include('footer.php') ?>
</body>


