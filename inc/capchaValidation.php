<?php session_start();
extract($_POST);
include("../submitTroughImage.class.php");
$sti = new submitTroughImage();
if($STI_imgString!='')
{
	if($sti->checkPost() === false)
	{ 		
		 $capcha="Wrong entry of Type Text";
		 echo 'false';	
	}else{
		echo 'true';
	}
}
?>
