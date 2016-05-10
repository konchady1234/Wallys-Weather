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
<<<<<<< HEAD
	  
	   if($currentFile=="faq.php"){ $faq="class='select'"; } else {  $faq=""; }
	
 if($currentFile=="user_management.php"){ $user_management="class='select'"; } else {  $user_management=""; }
	?>
    <ul>
     <!--<a href="banner.php"> <li <?=$banner?>>Image Management&nbsp;&nbsp;</li></a>-->
     <a href="user_management.php"> <li <?=$user_management?>>User Management&nbsp;&nbsp;</li></a>
     <a href="faq.php"> <li <?=$faq?>>FAQ&nbsp;&nbsp;</li></a>
    
     
=======
	

	?>
    <ul>
     <!--<a href="banner.php"> <li <?=$banner?>>Image Management&nbsp;&nbsp;</li></a>-->
    




>>>>>>> 72b5b01fa70f0fba2e589a992e66ccb9ab41f4bc
    </ul>
  </div>
</div>
