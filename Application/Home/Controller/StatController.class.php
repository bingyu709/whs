<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;
use OT\DataDictionary;
/**
 * 后台首页控制器
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
class StatController extends HomeController {

    /**
     * 后台首页
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function stats(){
		
        $this->meta_title = '统计接口';
       
		
		$data['date'] 		=	date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME']);
		$data['ip'] 		=	$_SERVER['REMOTE_ADDR'];
		$data['server_ip'] 	=	$_SERVER['SERVER_ADDR'];
		$data['page'] 	=   $_SERVER['PHP_SELF'];
		
		$result = M('Stat')->add($data);
		echo M('Stat')->_sql();
		exit;//$this->display();
    }
	
	public function lists(){
		$this->meta_title = '统计报表';
			
		$this->display();	
	}

	
	
	
}
