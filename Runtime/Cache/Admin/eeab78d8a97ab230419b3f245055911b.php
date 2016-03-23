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
  <!--<div class="top">
  	<div class="top_div"><img src="/whs/Public/Admin/images/pic_1.png"></div>
  </div>-->
  <!-- 导航栏 -->
  <div class="navigation">
     <div class="navigation_div">
     	<div class="navigation_left">
		  	<ul>
		  		<li><a href="javascript:;" style=" color:red"><?php echo session('user_auth.username');?></a></li>
				<li><a href="<?php echo U('Index/index');?>">首页</a></li>
				<li><a href="<?php echo U('Flow/add');?>">录入信息</a></li>
		  		<script>
				var  groupid = "<?php echo session('user_auth.uid');?>";
				if(groupid == 3){
				
						document.write("<li><a href=\"<?php echo U('Bus/index');?>\">车辆管理</a></li>");
						document.write("<li><a href=\"<?php echo U('User/index');?>\">用户管理</a></li>");
				}
				</script>
		  		
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
    <div class="list">
      <div class="list_div">
       
       <div class="right">
	        <div class="list_head">
	        	<div class="list_left">
	        		<span>当前位置</span>
	        		<span> 》》</span>
	        		<span>信息列表</span>
	        	</div>
	        	<div class="list_right">
	        	
	        		<a href="<?php echo U('Flow/expUser');?>"><input type="button"  value="导出Excel" /></a>
	        	</div>
	        </div>
	        <div class="list_tab">
            	<table  style="width:100%;">
					<tr class="tab_tr">
						<td style="color:red;font-size:14px;">（<b><?php echo (date('Y-m',$dt)); ?>月份</b>）单车圈次、行驶公里、及日耗油/气量统计表</td>
					</tr>
				</table>
	        	<table  style="width:100%">
					
	        		<tr class="tab_tr">
	        			<td>编号</td>
	        			<td>车号</td>
	        			<td>消费</td>
                        <?php $__FOR_START_10996__=1;$__FOR_END_10996__=$end+1;for($i=$__FOR_START_10996__;$i < $__FOR_END_10996__;$i+=1){ ?><td><?php echo ($i); ?></td><?php } ?>
	        			<td><b>合计</b></td>
						<td><b>总计</b></td>
	        		</tr>
	        		 <?php if(is_array($lists)): $n = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($n % 2 );++$n;?><tr <?php if($n % 2 == 0 ): ?>style="background-color:#E9E9E9"<?php endif; ?> >
					
	        			<td rowspan="4"><?php echo ($n); ?></td>
	        			<td rowspan="4"><?php echo ($vol["driver"]); ?><br/><?php echo ($vol["plate"]); ?></td>
	        			<td>圈次</td>
	        			<?php if(is_array($vol['data']['val1'])): $i = 0; $__LIST__ = $vol['data']['val1'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><td><a href="<?php echo U('Flow/add',array('ym'=>$dt,'dt'=>$i,'plate'=>$vol['plate']));?>"><?php echo ($val); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
						<td style="font-weight:bold;color:red;"><?php echo ($vol["val1_total"]); ?></td>
						<td rowspan="4" style="font-weight:bold;color:blue;"><?php echo ($vol["total"]); ?></td>
	        		</tr>	
                    <tr <?php if($n % 2 == 0 ): ?>style="background-color:#E9E9E9"<?php endif; ?>>
	        			
	        			<td>公里</td>
						
	        			<?php if(is_array($vol['data']['val2'])): $i = 0; $__LIST__ = $vol['data']['val2'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><td><?php echo ($val); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
	        			<td style="font-weight:bold;color:red;"><?php echo ($vol["val2_total"]); ?></td>
	        		</tr>	
                    <tr <?php if($n % 2 == 0 ): ?>style="background-color:#E9E9E9"<?php endif; ?>>
	        			
	        			<td>燃油</td>
	        			 <?php if(is_array($vol['data']['val3'])): $i = 0; $__LIST__ = $vol['data']['val3'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><td><?php echo ($val); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
	        			<td style="font-weight:bold;color:red;"><?php echo ($vol["val3_total"]); ?></td>
	        		</tr>	
                    <tr <?php if($n % 2 == 0 ): ?>style="background-color:#E9E9E9"<?php endif; ?>>
	        			
	        			<td>燃气</td>
	        			<?php if(is_array($vol['data']['val4'])): $i = 0; $__LIST__ = $vol['data']['val4'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><td><?php echo ($val); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
	        			<td style="font-weight:bold;color:red;"><?php echo ($vol["val4_total"]); ?></td>
	        		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	        	
                	
                
                
                
	        	</table>
	        </div>
      	</div>
      </div>
     	
    </div>

  <!-- 底部 -->
  <div style="background-color: #104f83 ;width: 1083px;height: 4px;margin: 10px auto 0;"></div> 
  
  <div class="end">

  	<div class="end_div">

  		<p class="end_p1">

  			<!--

			<span><a href="javasript:;">关于我们</a></span> <sapn class="xain">|</sapn>

  			<span><a href="javasript:;">网站声明</a></span> <sapn class="xain">|</sapn>

  			-->

			<span><a href="javasript:;">公交调度系统测试版 </a></span> <span class="xain"></span><br/>

			

  		</p>

  		<p class="end_p2">版权所有 ©2008-2016    陕ICP备15016206号-2   技术支持：bingyu709@163.com</p>

  	</div>

  </div>






 
  <script type="text/javascript">
document.write(unescape("%3Cspan%20id%3D%27webstat%27%20%3E%3C/span%3E%3Cscript%20src%3D%27http%3A//gj.liyubin.top/api/stat.php%3Fweb_id%3D20160121%27%20%20type%3D%27text/javascript%27%3E%3C/script%3E"));

</script>
</body>
</html>