<?
$currentFile = $_SERVER["SCRIPT_NAME"];
$parts = Explode('/', $currentFile);
$currentFile = $parts[count($parts) - 1];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Jquery PrMenu Plugin Demo</title>
	
	<style>

		body {
			margin: 0;
			padding: 0;
		}

		.content {
			width: 90%;
			max-width: 800px;
			margin: 50px auto;
		}

		 pre {
			white-space: pre-wrap;       /* CSS 3 */
			white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
			white-space: -pre-wrap;      /* Opera 4-6 */
			white-space: -o-pre-wrap;    /* Opera 7 */
			word-wrap: break-word;       /* Internet Explorer 5.5+ */
		}
		.wrapper
{
	max-width:980px; width:100%; margin:auto;
}


	</style>

</head>
<body>
<div class="wrapper">
<div id="container">
 <? 
	  if($currentFile=="index.php"){ $home="class='current-menu-item'"; } else {  $home=""; }
	  if($currentFile=="sign_in_user.php"){ $signin="class='current-menu-item'"; } else {  $signin=""; }
	  if($currentFile=="registration.php"){ $reg="class='current-menu-item'"; } else {  $reg=""; }
	  if($currentFile=="forgot_password.php"){ $pwd="class='current-menu-item'"; } else {  $pwd=""; }
	  if($currentFile=="content.php"){ $cont="class='current-menu-item'"; } else {  $cont=""; }
	?>
	<ul id="top-menu">
        <li <?=$home?>><a href="index.php">Home</a></li>
         <li <?=$signin?>><a href="sign_in_user.php">Sign-In</a></li>
        <li <?=$reg?>><a href="registration.php">Subscribe</a></li>
        <li <?=$pwd?>><a href="forgot_password.php">Forgot Password</a></li>
        <li <?=$cont?>><a href="content.php">Content</a></li>
        <!--<li><a href="#">About</a></li>
        <li><a href="#">Contact</a>
            
        </li>-->
    </ul>







</div>
</div><!-- /container -->

<div id="footer">

</div><!-- /footer -->

</body>
</html>
<script src="js/jquery.1.9.0.js"></script>
	<script src="js/jquery.prmenu.min.js"></script>
	<link type="text/css" rel="stylesheet" href="css/prmenu.css" />
	<script>
		$(document).ready(function(){
			  $('#top-menu').prmenu({
				  "fontsize": "14",
					"height": "50",
					"case": "capitalize",
					"linkbgcolor": "#286090",
					"linktextcolor": "#ffffff",
					"linktextweight": "400",
					"linktextfont": "sans-serif",
					"hoverdark": false
				});


		});

	</script>