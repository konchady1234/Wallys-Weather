
<?
$currentFile = $_SERVER["SCRIPT_NAME"];
$parts = Explode('/', $currentFile);
$currentFile = $parts[count($parts) - 1];
?>

<!doctype html>
<html lang=''>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="styles.css">
   <!--<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>-->
   <script src="script.js"></script>
   <title>CSS MenuMaker</title>
</head>
<body>

<div id='cssmenu'>
 <? 
	  if($currentFile=="index.php"){ $home="class='current-menu-item'"; } else {  $home=""; }
	  if($currentFile=="sign_in_user.php"){ $signin="class='current-menu-item'"; } else {  $signin=""; }
	  if($currentFile=="registration.php"){ $reg="class='current-menu-item'"; } else {  $reg=""; }
	  if($currentFile=="forgot_password.php"){ $pwd="class='current-menu-item'"; } else {  $pwd=""; }
	  if($currentFile=="content.php"){ $cont="class='current-menu-item'"; } else {  $cont=""; }
	?>

<ul id="rmenu">
   <li <?=$home?>><a href='index.php'>Home</a></li>
   <li <?=$signin?>><a href='sign_in_user.php'>Sign-In</a></li>
   <li <?=$reg?>><a href='registration.php'>Subscribe</a></li>
   <li <?=$pwd?>><a href='forgot_password.php'>Forgot Password</a></li>
   <li <?=$cont?>><a href='content.php'>Content</a></li>
</ul>
</div>

</body>
<html>
