<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Admin\Controller;
use User\Api\UserApi as UserApi;

/**
 * 后台首页控制器
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
class StatController extends AdminController {

    /**
     * 后台首页
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function stats(){
        $this->meta_title = '统计接口';
        
		echo 'IP:'.$_SERVER['REMOTE_ADDR'];
		echo '<br/>USER_AGENT为'.$_SERVER['HTTP_USER_AGENT'];
		echo '<br/>访问者IP为'.$_SERVER['REMOTE_ADDR'];
		echo '<br/>服务器IP为'.$_SERVER['SERVER_ADDR'];
		echo '<br/>访问时间为'.date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME']);
		echo '<br/>离开时间可能过js unonload获取。。';
		echo '<br/>访问页'.$_SERVER['PHP_SELF'];
		
		$data['date'] 		=	date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME']);
		$data['ip'] 		=	$_SERVER['REMOTE_ADDR'];
		$data['server_ip'] 	=	$_SERVER['SERVER_ADDR'];
		$data['page'] 	=   $_SERVER['PHP_SELF'];
		
		M('Stat')->add($data);
		
		exit;//$this->display();
    }
	
	public function lists(){
		$this->meta_title = '统计报表';
			
		$this->display();	
	}

	
	
	
}
