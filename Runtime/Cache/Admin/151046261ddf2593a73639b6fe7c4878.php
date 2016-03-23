<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title></title>

<link rel="stylesheet" type="text/css" href="/whs/Public/Admin/css/reset.css">

<link rel="stylesheet" type="text/css" href="/whs/Public/Admin/css/data_style.css">

<!-- 日期插件 -->

<link rel="stylesheet" type="text/css" href="/whs/Public/Admin/css/jquery-ui.css" />

<script src="/whs/Public/Admin/js/jquery.min.js"></script>



<script >

	$(function(){

			$("#date_1").datepicker();	

		});

</script>





</head>

<body>

<!--

  <div class="top">

  	<div class="top_div"><img src="/whs/Public/Admin/images/pic_1.png"></div>

  </div>

  

  -->

  <!-- 导航栏 -->

  <div class="navigation">

     <div class="navigation_div">

     	<div class="navigation_left">

		  	<ul>

		  		<li><a href="javascript:;" style=" color:red"><?php echo session('user_auth.username');?></a></li>

				<li><a href="<?php echo U('Index/index');?>">首页</a></li>

				<li><a href="<?php echo U('Flow/lists');?>">信息列表</a></li>

		  		

		  		

		  	</ul>

  	    </div>

	  	<div class="navigation_right" id="divTest">

		    <?php echo session('user_auth.username');?>

			<a href="<?php echo U('User/updatePassword');?>">修改密码</a>

		  	<a href="<?php echo U('User/updateNickname');?>">修改昵称</a>

        	<a href="<?php echo U('Public/logout');?>" style=" color:red">退出</a>

	  	</div>

     </div>

  </div>

<!-- 中间 -->

   <div class="message">

   	 <div class="message_div">

   	 	<div class="message_span">

   	 		<span>当前位置</span>

        	<span>》</span>

        	<span>信息录入</span>

   	 	</div>

        <form action="<?php echo U('add');?>"  method="post" >

   	 	<div class="message_list"> 

		    <div class="message_inp">

		      <span class="mess">日期：</span>

		      <input type="text" id="date_1"  name="xfdate" value="<?php echo ($xfdate); ?>" />

		    </div>

		  

		   

		   

		   <div class="message_inp">

		      <p>

		      	<span class="mess"><?php echo session('user_auth.uid');?>车牌：</span>
				
                <select name="plate" >
                <?php if(is_array($plates)): $i = 0; $__LIST__ = $plates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><option value="<?php echo ($val["plate"]); ?>" <?php if($val['plate'] == $plate): ?>selected="selected"<?php endif; ?> ><?php echo ($val["plate"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
                
		       <!-- <input type="text" name="plate" value="<?php echo ($plate); ?>" placeholder="车牌"/>-->

		      </p>	

		      <p>

		      	<span class="mess">司机：</span>

		        <input type="text" name="driver" value="<?php echo ($flow["driver"]); ?>" placeholder="司机"/>

		      </p>

		   </div>

		    <div class="message_inp">

		      <p>

		      	<span class="mess">售票员：</span>

		        <input type="text" name="conductor" value="<?php echo ($flow["conductor"]); ?>" placeholder="车牌"/>

		      </p>	

		      <p>

		      	<span class="mess">收入：</span>

		        <input type="text" name="income" value="<?php echo ($flow["income"]); ?>" placeholder="司机"/>

		      </p>

		   </div>

		   

		   <div class="message_inp">

		      <p>

		      	<span class="mess">圈次：</span>

		        <?php if($flow['val1'] == '' ): ?>0<?php else: echo ($flow["val1"]); endif; ?> + <input type="text" name="val1"  onkeyup="value=value.replace(/[^\d.]/g,'')" />

		      </p>	

		      <p>

		      	<span class="mess">公里：</span>

		       <?php if($flow['val2'] == '' ): ?>0<?php else: echo ($flow["val2"]); endif; ?> + <input type="text" name="val2" onkeyup="value=value.replace(/[^\d.]/g,'')" />

		      </p>

		   </div>

		   <div class="message_inp">

		      <p>

		      	<span class="mess">燃油：</span>

		       <?php if($flow['val3'] == '' ): ?>0<?php else: echo ($flow["val3"]); endif; ?> + <input type="text" name="val3"  onkeyup="value=value.replace(/[^\d.]/g,'')" />

		      </p>	

		      <p>

		      	<span class="mess">燃气：</span>

		        <?php if($flow['val4'] == '' ): ?>0<?php else: echo ($flow["val4"]); endif; ?> +  <input type="text" name="val4" onkeyup="value=value.replace(/[^\d.]/g,'')" />

		      </p>

		   </div>

		   

		   <div class="message_btn">

             <input type="image" src="/whs/Public/Admin/images/pic_8.png"  onclick="this.form.submit()"  />

		   	

		   </div>



   	 	</div>

        </form>

   	 </div>

   </div>

  <!-- 底部 -->

  <div style="background-color: #104f83 ;width: 1083px;height: 4px;margin: 10px auto 0;"></div> 

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

 <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>

 <script type="text/javascript" src="js/jquery-ui-datepicker.js"></script>

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