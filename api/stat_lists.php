<?php
	header("Content-type:text/html;charset=utf-8");
	date_default_timezone_set ('Asia/Shanghai'); 
	include('db.class.php');
	
	
	
	$db = new  DB();
	$sql = "SELECT * FROM  w_stat  order by id desc";
	$list  = $db->get_all($sql);
	

	$cur_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
	
	$sqlcount = "SELECT * FROM  w_stat where page='".$cur_url."'";
	$cur_read = $db->get_all($sqlcount);
	
	
	
	$count = count($cur_read);

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>OneThink&#8250;使用说明</title>
	<style type="text/css">
		html,body {
			font: 16px/1.5 "microsoft yahei", Helvetica, Tahoma, Arial, sans-serif;
			color:#404040;
			background-color:#fafafa;
		}
		body,p,pre,h1,h2,h3,h4,h5,h6,			
		dl,dt,dd,ul,ol,li {
			margin:0;
			padding:0;
		}
		ul,ol {
			margin-left: 16px;
			line-height: 1.8;
		}
		fieldset,img {
			border:0 none;
		}
		img {
			max-width: 100%;
		}
		a {
			color: #08c;
			text-decoration:none;
		}
		a:hover{
			color: #058;
		}
		.main {
			margin: 20px auto;
			padding: 34px;
			width: 930px;
			border: 1px solid #dfdfdf;
			background-color: #fff;
		}
		#logo {
			padding: 0;
			text-align: center;
			border-bottom: 0 none;
		}
		#logo span {
			display: block;
			margin-top: 15px;
			font: normal normal 30px Georgia;
		}
		#logo b {
			font-size: .7em;
		}
		h1 {
			margin-bottom: 10px;
			padding: 8px 0;
			font-size: 24px;
			font-weight: normal;
			color: #666;
			border-bottom: 1px solid #dfdfdf;
		}
		p {
			line-height: 1.8;
		}
		pre {
			font-family: Consolas,"微软雅黑";
		}
		.solgan {
			margin-bottom: 50px;
			font-size: 22px;
			font-weight: bold;
			text-align: center;
		}
	</style>
</head>
<body>
<div class="main">
	<h1 id="logo">
		<a href="" style="font-size:22px;">统计数据列表</a>
	
	</h1>
	
	<p style="text-align: right; margin: 10px 0 30px">
    您的IP地址是：<span id="keleyivisitorip" style="color:red;"></span> 
	<script type="text/javascript" src="http://tool.keleyi.com/ip/visitoriphost/"></script> 
	本页面浏览数（<font color="red"><?php echo $count; ?></font>） <a href="javascript:history.back();">返回</a>
    <table border="1" align="center"  style="width:100%">

	<tr style="background-color:#08c; color: #CCC">
    	<td>编号</td><td>IP</td><td>访问时间</td><td>访问页面</td>
    </tr>
    <?php
	$n = 1;
	foreach($list as $v){
	
	echo "<tr>
    	<td>".$n."</td><td>".$v['ip']."</td><td>".$v['date']."</td><td>".$v['page']."</td>
    </tr>";
	$n++;
	}
	?>
</table>
  </div>
  
  </body>
</html>  
<script type="text/javascript">
document.write(unescape("%3Cspan%20id%3D%27webstat%27%20%3E%3C/span%3E%3Cscript%20src%3D%27http%3A//192.168.1.106/whs/api/stat.php%3Fweb_id%3D20160121%27%20%20type%3D%27text/javascript%27%3E%3C/script%3E"));

</script>