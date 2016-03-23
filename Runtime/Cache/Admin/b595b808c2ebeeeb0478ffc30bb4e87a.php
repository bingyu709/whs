<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($meta_title); ?></title>

<link rel="stylesheet" type="text/css" href="/whs/Public/Admin/css/reset.css" media="all">
<link rel="stylesheet" type="text/css" href="/whs/Public/Admin/css/data_style.css" media="all">

<script src="/whs/Public/Admin/js/jquery.min.js"></script>

</head>
<body>
    <div class="navigation" >
         <div class="navigation_div" style="color:#FFF">
         	
		  	
             <li class="manager">你好，<em title="<?php echo session('user_auth.username');?>"><?php echo session('user_auth.username');?></em></li>
                <li><a href="<?php echo U('User/updatePassword');?>">修改密码</a></li>
                <li><a href="<?php echo U('User/updateNickname');?>">修改昵称</a></li>
                <li><a href="<?php echo U('Public/logout');?>">退出</a></li>
         
    	
    </div>

  <div class="top">
  	<div class="top_div"><img src="/whs/Public/Admin/images/pic_1.png"></div>
  </div>
  <!-- 导航栏 -->
  <div class="navigation">
     <div class="navigation_div">
     	<div class="navigation_left">
		  	<ul>
		  		<li><a href="javascript:;">首页</a></li>
		  		<li><a href="javascript:;">客运服务</a></li>
		  		<li><a href="javascript:;">货运服务</a></li>
		  		<li><a href="javascript:;">行包服务</a></li>
		  		<li><a href="javascript:;">车站引导</a></li>
		  		<li><a href="javascript:;">铁路常识</a></li>
		  		<li><a href="javascript:;">战车风采</a></li>
		  	</ul>
  	    </div>
	  	<div class="navigation_right" id="divTest">
        	
	  	</div>
        
     </div>
  </div>
<!-- 中间 -->
   <div class="data">
   	  <div class="data_div">
   	  	<ul class="data_ul">
   	  		<li><a href="<?php echo U('Flow/lists');?>"><img src="/whs/Public/Admin/images/pic_4.png"></a></li>
   	  		<li><a href="<?php echo U('Flow/add');?>"><img src="/whs/Public/Admin/images/pic_5.png"></a></li>
   	  	</ul>
   	  	<ul class="data_ul">
   	  		<li><a href="javascript:;"><img src="/whs/Public/Admin/images/pic_6.png"></a></li>
   	  		<li><a href="javascript:;"><img src="/whs/Public/Admin/images/pic_7.png"></a></li>
   	  	</ul>
   	  </div>
   </div>

  <!-- 底部 -->
  <div style="background-color: #104f83 ;width: 1083px;height: 4px;margin: 188px auto 0;"></div> 
  <div class="end">
  	<div class="end_div">
  		<p class="end_p1">
  			<span><a href="javasript:;">关于我们</a></span> <sapn class="xain">|</sapn>
  			<span><a href="javasript:;">网站声明</a></span> <sapn class="xain">|</sapn>
  			<span><a href="javasript:;">帮助</a></span>
  		</p>
  		<p class="end_p2">版权所有 ©2008-2016 公交调度系统使用测试版    京ICP备88888888号</p>
  	</div>
  </div>
 <!-- 获取当前时间 -->
<script language="javascript">
		function getCurDate(){
			 var d = new Date();
			 var week;
			 switch (d.getDay()){
			 case 1: week="星期一"; break;
			 case 2: week="星期二"; break;
			 case 3: week="星期三"; break;
			 case 4: week="星期四"; break;
			 case 5: week="星期五"; break;
			 case 6: week="星期六"; break;
			 default: week="星期天";
			 }
			 var years = d.getFullYear();
			 var month = add_zero(d.getMonth()+1);
			 var days = add_zero(d.getDate());
			 var ndate = years+"年"+month+"月"+days+"日 "+" &nbsp; "+week;
			 divT.innerHTML= ndate;
		}
		function add_zero(temp){
		 // if(temp<10) return "0"+temp;
		  return temp;
		}
		setInterval("getCurDate()",100);
</script>
</body>
</html>