<?
class mysql{   

/*===================== Admin Login start =============================*/
	function admin_login($username,$password){
		
		
		  $sql="select * from `admin_table` where username='".$username."' and password='".$password."'";
		
		$value=mysql_query($sql);
		$fetch=mysql_fetch_array($value); 
		$_SESSION['admin_id']=$fetch['web_id']; 
		
		$_SESSION['username']=$fetch['username']; 
	    
		if(($username==$fetch['username']) && ($password==$fetch['password']))
		{
			return true;
		}
		else
		{
			return false;
		}
		return false;
	}
	/*============================= End  =============================*/
	
	/*============================= Change Password  =============================*/
	function change_password($old_pwd,$new_pwd){
		
		
        $old_pwd=($old_pwd); 
        $password=($new_pwd); 	 
		$passval = mysql_fetch_assoc(mysql_query("select count(web_id) as cnt from `admin_table` where password ='".$old_pwd."'")); 
		if($passval['cnt']!='1')
		{
			 return "error";
		}
		else
		{
			echo $sql = "update `admin_table` set password='".$password."'";
			mysql_query($sql);
			return "success";
		}
		exit();
	 }
	/*============================= End  =============================*/

   /*============================= Query start  =============================*/
		function add_query($field,$table){
			
			$key_value = implode(",", array_keys($field));
			$org_value = "'" . implode("','", array_values($field)) . "'" ;			
			
			$sql="insert into `$table`($key_value) values ($org_value)"; 
			$query=mysql_query($sql); 
			return true;
			
		}
		
			
		function select_query($table, $where){
			
			
			$sql=mysql_query("select * from `$table` $where");
			
			$num=mysql_num_rows($sql);		
			
			if($num!=0)
			{   
				$i=0;
				$array_category= array();				
				while($query=mysql_fetch_assoc($sql))
				{
					 foreach ($query as $key => $value) {
					 $array_category[$i][$key]=$value;
					 }
							
					$i++;
				}
			}			
			return $array_category;	
		}
			
		
		function view_query($table, $where){
			
		
			$sql=mysql_query("select * from `$table` $where ");
			while($query=mysql_fetch_array($sql))
			{
				 $rslt[]=$query;
			}
			return $rslt;
			
		}
		
		function view_query3($table, $where, $domiansort){	
		
			$sql=mysql_query("select *, $domiansort  from `$table` $where ");
			while($query=mysql_fetch_array($sql))
			{
				 $rslt[]=$query;
			}
			return $rslt;
			
		}
		
		function update_query($field,$table,$where){
			$cn=1; $cnt_field=count($field);
			foreach($field as $key => $val)
			{
				if($cn!=$cnt_field)$comma= ", ";else $comma='';				
				$update.=$key."='".$val."'".$comma; 
				$cn++;
			}		
			
		 	$sql="Update `$table` set $update $where";   
			$query=mysql_query($sql);
			return $query;
		}
		
		function delete_query($table,$where){
			$sql="delete from `$table` $where ";
			$query=mysql_query($sql);
			return true;
		}
	
	
		function cnt_table($table, $where){
			
			$num=mysql_num_rows(mysql_query("select * from `$table`  $where"));			
			return $num;
		}
		
		function cnt_table3($table, $where, $domiansort){
			
			$num=mysql_num_rows(mysql_query("select *, $domiansort from `$table`  $where"));			
			return $num;
		}
		
		
		
		function getRealIpAddr()
		{
			if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
			{
			  $ip=$_SERVER['HTTP_CLIENT_IP'];
			}
			elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
			{
			  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
			}
			else
			{
			  $ip=$_SERVER['REMOTE_ADDR'];
			}
			return $ip;
		}
		
	function add_subscribers($email){
		$sql="insert into admin_newsletter(email) values ('$email')";
		$query=mysql_query($sql);
		return true;
	}
	
		
	/*============================= End  =============================*/
	
}


$searchReplaceArray = array(
'$' => '%24',
'&' => '%26',
'+'=>'%2B',
','=>'%2C',
'/'=>'%2F',
':'=>'%3A',
';'=>'%3B',
'='=>'%3D',
'?'=>'%3F',
"\'"=>'%27',
"'"=>'%27',
'"'=>'%93',
'‘'=>'%91',
'”'=>'%94',
'’'=>'%92',
'<'=>'%3C',
'>'=>'%3E'
);

$ReplaceArray = array(
'%24' => '$',
'%26' => '&',
'%2B'=>'+',
'%2C'=>',',
'%2F'=>'/',
'%3A'=>':',
'%3B'=>';',
'%3D'=>'=',
'%3F'=>'?',
'%27'=>"\'",
'%27'=>"'",
'%93'=>'"',
'%91'=>'‘',
'%94'=>'”',
'%92'=>'’',
'%3C'=>'<',
'%3E'=>'>'
);

function get_symbol($symbol)
{	
	global $ReplaceArray; global $searchReplaceArray;
	return $rslt=str_replace(array_keys($ReplaceArray),array_values($ReplaceArray),$symbol);
}

function get_entity($symbol)
{	
	global $ReplaceArray; global $searchReplaceArray;
	return $rslt=str_replace(array_keys($searchReplaceArray),array_values($searchReplaceArray),$symbol);
}

?>