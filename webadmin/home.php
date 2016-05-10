<?  
session_start(); ob_start();
include_once('../lib/config.php');
include_once('../lib/mysql_class.php');

if($_SESSION['admin_id']=="")
{
header('Location:index.php');exit();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home -
<?=$sitetitle?>
</title>
<link href="css/admin_stlyz.css" type="text/css" rel="stylesheet" />
</head>

<body id="innerbg">
<? include("header.php"); ?>
  <div class="cont_right"  >
    <p class="welcome_text">Welcome to Wallys Weather admin!<br/>
      <br/>
      Please choose an option from the leftmenu.
    <div class="clear"></div>
    <div class="space"></div>
  </div>
</div>
<div class="clear"></div>
<? include("footer.php"); ?>
</div>
</body>
</html>
<script>
function validation()
{
	
	web_title = document.getElementById('web_title').value;
	if(web_title=="") 
	{ 
		alert("Please enter title");		
		document.getElementById('web_title').focus();			
		return false;
	}
	start_date = document.getElementById('start_date').value;
	if(start_date=="") 
	{ 
		alert("Please select start date");		
		document.getElementById('start_date').focus();			
		return false;
	}
	end_date = document.getElementById('end_date').value;
	if(end_date=="") 
	{ 
		alert("Please select end date");		
		document.getElementById('end_date').focus();			
		return false;
	}
	web_content = document.getElementById('web_content').value;
	if(web_content=="") 
	{ 
		alert("Please enter venue");		
		document.getElementById('web_content').focus();			
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

function homepage()
	{		
	window.location.href ="home.php";
	return false;
	}
</script>
</style>
<link href="http://code.jquery.com/ui/1.9.2/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
<script>

var $j = jQuery.noConflict();
$j(function() {
	
	/*$j('#res_date').datepick();*/
	/*$j('#res_date').datepick({ minDate: 0 });*/
	$j("#start_date").datepicker({
		dateFormat: 'yy-mm-dd',
		minDate: 0,

});
   
   $j("#end_date").datepicker({
		dateFormat: 'yy-mm-dd',
		minDate: 0,

});
   
	

});
  

</script>