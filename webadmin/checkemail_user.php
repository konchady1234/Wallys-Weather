    <?php
error_reporting(0);
include_once('../lib/config.php');
include_once('../lib/mysql_class.php');

$registeredEmail  =mysql_query("select * from web_user where user_email='".$_REQUEST['user_email']."'");
$cnt=mysql_num_rows($registeredEmail); 


    if( $cnt>0) {
        echo '1';
    }
    else{
        echo '0';
    }
    ?>
	