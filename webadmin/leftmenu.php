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
	  
	   if($currentFile=="faq.php"){ $faq="class='select'"; } else {  $faq=""; }
	
 if($currentFile=="user_management.php"){ $user_management="class='select'"; } else {  $user_management=""; }
	?>
    <ul>
     <!--<a href="banner.php"> <li <?=$banner?>>Image Management&nbsp;&nbsp;</li></a>-->
     <a href="user_management.php"> <li <?=$user_management?>>User Management&nbsp;&nbsp;</li></a>
     <a href="faq.php"> <li <?=$faq?>>FAQ&nbsp;&nbsp;</li></a>
    
     
    </ul>
  </div>
</div>
