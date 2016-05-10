<!--<script type="text/javascript" src="../js/jquery.min.js"></script> -->
<div class="headerbg">
	<div class="header_wrapper">
    <div class="left"><a href="index.php"><img src="../images/logo.png" border="0" alt="<?=$sitetitle?>" /></a></div>
  <div class="top_text">Administration Control Panel </div> 
    <div class="logout" ><img src="images/administrator.png" style="padding-right:5px;" />
    <span>Welcome,&nbsp;<?= $_SESSION['username']?> !</span>
  <img src="images/key.png" style=" padding-right:5px;" />
  <a href="change_password.php"><span>Change Password</span>
  </a><b>|</b>&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/logout.png" style=" padding-right:5px;" /><a href="logout.php" ><span>Logout</span></a></div>
    </div>
	</div>
    <div class="clear"></div>
    <div class="inner_wrapper">
       
        <? include("leftmenu.php"); ?>
