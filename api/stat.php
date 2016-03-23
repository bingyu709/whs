<?php
	header("Content-type:text/html;charset=utf-8");
	date_default_timezone_set ('Asia/Shanghai'); 
	include('db.class.php');
	  /* 
	echo 'IP:'.$_SERVER['REMOTE_ADDR'];
	echo '<br/>USER_AGENT为'.$_SERVER['HTTP_USER_AGENT'];
	echo '<br/>访问者IP为'.$_SERVER['REMOTE_ADDR'];
	echo '<br/>服务器IP为'.$_SERVER['SERVER_ADDR'];
	echo '<br/>访问时间为'.date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME']);
	echo '<br/>离开时间可能过js unonload获取。。';
	echo '<br/>访问页'.$_SERVER['PHP_SELF'];
 
	exit;
*/	
	$page = isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'直接打开';
	$str = date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME']).">>>>> ".$_SERVER['REMOTE_ADDR'].">>>".$_SERVER['SERVER_ADDR'].">>>>".$page." \r\n";
	
	$date = date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME']);
	$ip = $_SERVER['REMOTE_ADDR'];
	$server_id = $_SERVER['SERVER_ADDR'];
	
	
	$db = new  DB();
	$sql = " insert into w_stat(date,ip,server_ip,page) values('".$date."','".$ip."','".$server_id."','".$page."')";
	$db->query($sql);
	$handle = fopen("file.txt", "a");
	if ($handle) {
		fwrite($handle, $str);
		fclose($handle);
	} 

?>