<?
$currentFile = $_SERVER["SCRIPT_NAME"];
$parts = Explode('/', $currentFile);
$currentFile = $parts[count($parts) - 1];
?>

<div class="cont_left" >
  <p><a href="home.php">DASHBOARD</a></p>
  <div id="leftmenu">
    <? 
	  if($currentFile=="banner.php"){ $banner="class='select'"; } else {  $banner=""; }
	

	?>
    <ul>
     <!--<a href="banner.php"> <li <?=$banner?>>Image Management&nbsp;&nbsp;</li></a>-->
    




    </ul>
  </div>
</div>
