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
<title>Home - Wallys Weather</title>
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link rel="icon" href="Sliced images/favicon.png" type="image/x-icon">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="DESCRIPTION" content ="Wally's Weather is a weather page setup to make observations of major weather events across Australia but in particular the Queensland tropics. It has since become a popular site for people across Australia to discuss and ask questions about forecasts and weather information."/> 
<meta name="KEYWORDS" content="Wallys, Wallys Weather, Wally, Weather winter, sunny, Weather sunny, Australia weather detector,
australian weather, weather in australia, weather condition, australian weather, weather in australia, weather condition, Wally’s Weather page, Queensland tropics weather, Queensland tropics weather, weather events across Australia, weather information, road conditions, climate blogs and community communication, Synoptic Charts, Satellite Imagery, Forecast charts, Observation data " />

<link href="css/style.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="css/master.css">    
<link rel="stylesheet" href="css/media.css">    

<script>
  (function() {
	var fabricUrl = 'lib/fabric.js';
	if (document.location.search.indexOf('load_fabric_from=') > -1) {
	  var match = document.location.search.match(/load_fabric_from=([^&]*)/);
	  if (match && match[1]) {
		fabricUrl = match[1];
	  }
	}
	document.write('<script src="' + fabricUrl + '"><\/script>');
  })();
</script>
</head>

<body>
    <div class="wrapper">
        <? include('header.php') ?>
        <div class="clear"></div>
        <div class="four">
            <? foreach($res_banner as $res_banner){?>
                <div class="one"><div class="img1"><img src="webupload/thumb/company/<?=$res_banner['image']?>" /></div><div class="clear"></div><div class="heading"><h3><?=$res_banner['title']?></h3></div></div>
            <?}?>
            <div class="clear"></div>
    
            <div class="box1" style="height: auto; padding:15px;">
                <h1  class="hBotVal" style="padding: 2px;border-bottom: 1px solid #a7def7;">
                    Wally's Weather App 
                    <span class="lik">
                    Sign-In ( <a href="sign_in_user.php">User</a>/<a href="sign_in_admin.php">Admin</a> )
                    <span style="color: #446586; font-weight:bold"> | </span>
                    <a href="registration.php">Subscribe</a>
                    <span style="color: #446586; font-weight:bold"> | </span>
                    <a href="forgot_password.php">Forgot Password</a>
                    </span>
                </h1><br /><br />
                <h2>Current Weather for your location : </h2>
                <p>Select Location : <input type="text" class="register_input" value=""></p><br />
                <h2>Today's Facebook Posts : </h2>
                <p>Search Facebook Posts : <input type="text" class="register_input" value=""><p><br />
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
                <span class="blogBtns btnPad"><input type="submit" value="Radar" id="radar" class="button"></span>
                <span class="blogBtns btnPad"><input type="submit" value="Satellite" id="satellite" class="button"></span>
                <span class="blogBtns btnPad"><input type="submit" value="Model" id="model" class="button"></span><br /><br />
                <h2>Weather Knowledge Base:</h2><br />
                <p>Frequently asked questions</p><br />
                <div style="padding: 8px;">
					<? $faq=$sql->select_query("faq"," order by web_id");
                    $i=0;
                    foreach($faq as $faq) {  ?>
                        <div style="float:left;">
                            <?=get_symbol($faq['web_title'])?>
                        </div>
                        <div >
                            <a href="javascript:toggleDiv('myContent_<?=$i?>');" style=" float:right;">
                            <img src="image/showhide.png" width="16" height="16" style="    vertical-align: bottom;" /></a>
                        </div>
                        <div class="clear"></div>
                        <div id="myContent_<?=$i?>" style="display: none;background-color: rgb(235, 248, 255);maring: 5px;border-radius: 3px;margin: 5px;padding: 5px;">
                            <?=stripslashes($faq['web_content'])?>
                        </div>
                    <? $i++;  } ?>
                </div>
            </div>
        </div>
        
        <div class="footer">
            <p>Copyright &copy; 2016 <a href="#">wallyweather.com.au.</a> All rights reserved.</p>
        </div>
    </div>
</body>
</html>    
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script type="text/javascript">
function toggleDiv(divId)
{
   $("#"+divId).toggle();
}
</script>

	<script>
	  var wallysweatherapp = { };
	  var canvas = new fabric.Canvas('canvas');
	</script>
	<script>
		(function() {
		
			var radarBtn = document.getElementById('radar');
			radarBtn.onclick = function() {
				canvas.clear();
				fabric.Image.fromURL('http://www.bom.gov.au/radar/IDR733.gif', function(img) {
					img.scale(1).set({
						left: 0,
						top: 0,
						scaleX: 1.06,
						scaleY: 1.06,
						selectable: false,
						angle: 0
					});
					canvas.add(img).setActiveObject(img);
					var activeObject = canvas.getActiveObject();
					if (activeObject) {
					  canvas.sendBackwards(activeObject);
					}
				});
			};
			
			var satelliteBtn = document.getElementById('satellite');
			satelliteBtn.onclick = function() {
				canvas.clear();
				fabric.Image.fromURL('http://realtime.bsch.com.au/data/sat/www/qld_vis_latest.jpg', function(img) {
					img.scale(1).set({
						left: 0,
						top: 0,
						scaleX: 0.61,
						scaleY: 0.61,
						selectable: false,
						angle: 0
					});
					canvas.add(img).setActiveObject(img);
					var activeObject = canvas.getActiveObject();
					if (activeObject) {
					  canvas.sendBackwards(activeObject);
					}
				});
			};
			
			var modelBtn = document.getElementById('model');
			modelBtn.onclick = function() {
				canvas.clear();
				fabric.Image.fromURL('http://stormcast.com.au/viewimage.php?image=gfs.stormcast.bsch.init-2016041900z.fcst-201604191600z.mslp.qld.null.0.png', function(img) {
					img.scale(1).set({
						left: 0,
						top: 0,
						scaleX: 0.80,
						scaleY: 0.80,
						selectable: false,
						angle: 0
					});
					canvas.add(img).setActiveObject(img);
					var activeObject = canvas.getActiveObject();
					if (activeObject) {
					  canvas.sendBackwards(activeObject);
					}
				});
			};
			
			fabric.Image.fromURL('basemaps/qld_ga.jpg', function(img) {
				img.scale(1).set({
					left: 0,
					top: 0,
					selectable: false,
					angle: 0
				});
				canvas.add(img).setActiveObject(img);
				var activeObject = canvas.getActiveObject();
				if (activeObject) {
				  canvas.sendBackwards(activeObject);
				}
			});		

			var circle = new fabric.Circle({
			  left: 258,
			  top: 292,
			  fill: 'rgba(255,255,255,1)',
			  stroke: 'rgba(255,255,255,1)',
			  selectable: false,
			  radius: 3
			});
			canvas.add(circle);
			
		})();

	</script>
