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
class FlowController extends AdminController {

    /**
     * 后台首页
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function index(){
        $this->meta_title = '车辆消费信息管理';
        $this->display();
    }
	
	public function add(){
		$this->meta_title = '添加消费信息|公交信息管理系统';
		if($_POST){
			
			$data['plate'] = I('post.plate');	
			$data['val1'] = I('post.val1')?I('post.val1'):0;	
			$data['val2'] = I('post.val2')?I('post.val2'):0;	
			$data['val3'] = I('post.val3')?I('post.val3'):0;	
			$data['val4'] = I('post.val4')?I('post.val4'):0;
			$data['driver'] = I('post.driver');
			$data['conductor'] = I('post.conductor');
			$data['income'] = I('post.income');
			
			$xfdate = I('post.xfdate');
			$data['xfdate'] = strtotime($xfdate);
			$where['xfdate'] = strtotime($xfdate);
			$where['plate'] = I('post.plate');
			$count=M('Flow')->where($where)->count();
			if($count){
				//M('Flow')->where($where)->save($data);
				M('Flow')->where($where)->setField('driver',$data['driver']);
				M('Flow')->where($where)->setField('conductor',$data['conductor']);
				M('Flow')->where($where)->setField('income',$data['income']);
				M('Flow')->where($where)->setInc('val1',$data['val1']);
				M('Flow')->where($where)->setInc('val2',$data['val2']);
				M('Flow')->where($where)->setInc('val3',$data['val3']);
				M('Flow')->where($where)->setInc('val4',$data['val4']);
			}else{
				M('Flow')->add($data);
				
			}
			$this->redirect('Flow/lists');
		}else{
			if(I('get.ym') && I('get.dt')  && I('get.plate')){
				
				$dt = date('Y-m',I('get.ym')).'-'.I('get.dt');
				
				$flow = M('Flow')->where(array('xfdate'=>strtotime($dt),'plate'=>I('get.plate')))->find();
				$this->assign('flow',$flow);
				
			}else{
				
				$dt = date('Y-m-d',time());
				
			}
			$bus = M('Bus')->field('plate')->select();
			$this->assign('plates',$bus);
			$this->assign('plate',I('get.plate'));
			$this->assign('xfdate',$dt);
		}
		
		
		$this->display();	
	}
	
	public function lists(){
		
		/*
		echo 'IP:'.$_SERVER['REMOTE_ADDR'];
		echo '<br/>USER_AGENT为'.$_SERVER['HTTP_USER_AGENT'];
		echo '<br/>访问者IP为'.$_SERVER['REMOTE_ADDR'];
		echo '<br/>服务器IP为'.$_SERVER['SERVER_ADDR'];
		echo '<br/>访问时间为'.$_SERVER['REQUEST_TIME'];
		echo '<br/>离开时间可能过js unonload获取。。';
		echo '<br/>访问页'.$_SERVER['PHP_SELF'];
		
		*/
		$this->meta_title = '信息列表|公交信息管理系统';
		$where = '';
		
		$this->assign('dt',time());
		
		$month = date('m',time());
		$year = date('Y',time());
		//$this->assign('end',cal_days_in_month(CAL_GREGORIAN, $month, $year));
		$firstday = mktime(0,0,0,$month,1,$year); //取所给年月的第一天的UNIX时间戳    
		$days = date('t',$firstday); //返回指定月份的天数  
		
		$this->assign('end',$days);
		
		
		// 1. 查询所有的车辆   
		$list = M('Bus')->field('driver,plate')->select();
		
		//2.查询当月份的所有数据
		$starttime = strtotime(date('Y-m-01',time()));
		$endtime = strtotime(date('Y-m-'.$days.' 23:59:59',time()));
		
		$where .= " xfdate >= $starttime and xfdate <= $endtime ";
		
		$flowList  = M('Flow')->where($where)->order('xfdate asc ')->select();
		
		//echo M('Flow')->_sql();
		
		//echo '<pre>';
		//var_dump($list);
		//echo '</pre>';
		//3. 重组数据
		
		
		$val1_sum =$val2_sum = $val3_sum =$val4_sum = 0;
		
		
		foreach($list as $k=>$val){
			$data = array();
			
			//合计
			$list[$k]['val1_total'] = $list[$k]['val2_total'] =$list[$k]['val3_total'] =$list[$k]['val4_total'] = 0;
			$n = 0;
			
			for($i = $starttime;$i < $endtime;$i=$i+86400){
				$data['val1'][$n] = 0;
				$data['val2'][$n] = 0;
				$data['val3'][$n] = 0;
				$data['val4'][$n] = 0;
				
				foreach($flowList as $key=>$v){
					if($v['xfdate'] >= $i &&  $v['xfdate'] < $i+86400 && $v['plate'] == $val['plate']){
						$list[$k]['driver']= $v['driver'];
						$data['val1'][$n] = $v['val1']?'<font color="blue">'.$v['val1'].'</font>':0;
						$data['val2'][$n] = $v['val2']?'<font color="blue">'.$v['val2'].'</font>':0;
						$data['val3'][$n] = $v['val3']?'<font color="blue">'.$v['val3'].'</font>':0;
						$data['val4'][$n] = $v['val4']?'<font color="blue">'.$v['val4'].'</font>':0;
					
					    $list[$k]['val1_total'] = $list[$k]['val1_total']+ $v['val1'];
						$list[$k]['val2_total'] = $list[$k]['val2_total']+ $v['val2'];
						$list[$k]['val3_total'] = $list[$k]['val3_total']+ $v['val3'];
						$list[$k]['val4_total'] = $list[$k]['val4_total']+ $v['val4'];
					
					}
				}
				$n++;	
			}
			$list[$k]['total'] = $list[$k]['val1_total'] + $list[$k]['val2_total'] + $list[$k]['val3_total'] + $list[$k]['val4_total'];
			$val1_sum = $val1_sum + $list[$k]['val1_total'];
			$val2_sum = $val2_sum + $list[$k]['val2_total'];
			$val3_sum = $val3_sum + $list[$k]['val3_total'];
			$val4_sum = $val4_sum + $list[$k]['val4_total'];
			
			$list[$k]['data'] = $data;
			
		}
		
		//echo '<pre>';
		//var_dump($list);
		//echo '</pre>';
		
		//$lists = M('Flow')->select();
		$this->assign('val1_sum',$val1_sum);
		$this->assign('val2_sum',$val2_sum);
		$this->assign('val3_sum',$val3_sum);
		$this->assign('val4_sum',$val4_sum);
		$this->assign('lists',$list);
		
		$this->display();
		
	}
	
	/**
      *
      * 导出Excel
      */
    function expUser(){//导出Excel
        //Header("Content-type: application/octet-stream;charset=utf-8"); 
		 $xlsName  = "单车圈次、行驶公里、及日耗油/气量统计表";
         $xlsCell  = array(
				array('id','序列'),
				array('plate','车号'),
				array('vtype','类型'),
		 );
        	
		$month = date('m',time());
		$year = date('Y',time());
		//$this->assign('end',cal_days_in_month(CAL_GREGORIAN, $month, $year));
		$firstday = mktime(0,0,0,$month,1,$year); //取所给年月的第一天的UNIX时间戳    
		$days = date('t',$firstday); //返回指定月份的天数 
		
		
		for($i = 0;$i<$days;$i++){
			$temp_array = array($i,$i);	 
			$xlsCell[] = $temp_array; 
		}
		$xlsCell[] = array('total','小计');
		$xlsCell[] = array('sum','合计');
        $xlsData  = $this->get_flow();//$xlsModel->Field('id,plate,driver,conductor,income,val1,val2,val3,val4')->select();
        $xlsName  = $xlsName . "    圈次：".$xlsData['val1_sum']."    公里：".$xlsData['val2_sum']."    燃油：".$xlsData['val3_sum']."    燃气：".$xlsData['val4_sum'];
		unset($xlsData['val1_sum']);
		unset($xlsData['val2_sum']);
		unset($xlsData['val3_sum']);
		unset($xlsData['val4_sum']);
				
		$temp_list = $xlsData;
				
		$new_list = array();
			
		foreach($temp_list as $k=>$val){
			foreach($val['data'] as $key=>$v){
				switch($key){
					case 'val1': $val['data'][$key]['vtype'] = '圈次';break;
					case 'val2': $val['data'][$key]['vtype'] = '公里';break;
					case 'val3': $val['data'][$key]['vtype'] = '燃油';break;
					case 'val4': $val['data'][$key]['vtype'] = '燃气';break;
				}
				$val['data'][$key]['plate'] = $val['driver'].$val['plate'];
				//$val['data'][$key]['plate'] = $val['plate'];
				$val['data'][$key]['xfdate'] = $val['xfdate'];
			}
			$new_list[] = $val['data'];
			
		}
		//
		$list  = array();
		foreach($new_list as $k=>$val){
			foreach($val as $key=>$v){
				
				$list[] = $v;
			}
			
		}
		foreach($list as $k=>$val){
			$list[$k]['id'] = $k+1;
			
		}
		// 求和
		$n = 1;
		$sum = 0;
		foreach($list as $k=>$val){
			
			for($i = 0;$i<$days;$i++){
				$list[$k]['total'] = $list[$k]['total'] + $val[$i];	
			}
			
			$sum = $sum + $list[$k]['total'];
			
			if($n % 4 == 0){
				$list[$k]['sum'] = $sum;
				$sum = 0;
			}
			
			$n++;	
		}
		for($i= 0;$i < count($list);$i=$i+4){
			
			$list[$i]['sum'] = $list[$i+1]['sum']=$list[$i+2]['sum'] = $list[$i+3]['sum'];
		}
		
		
        $this->exportExcel($xlsName,$xlsCell,$list);
        
    }
	public function exportExcel($expTitle,$expCellName,$expTableData){
		
		
         $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
         $fileName = date('_YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
         $cellNum = count($expCellName);
         $dataNum = count($expTableData);
         vendor("PHPExcel.PHPExcel");
		
         $objPHPExcel = new \PHPExcel();
         $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
         
		 //设置标题
         $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
         
		 //合并单元格
		 for($i = 3;$i < $dataNum; $i=$i+4){
			 $len = $i+3;
			 //$objPHPExcel->getActiveSheet(0)->mergeCells('A'.$i.':A'.$len);
			 $objPHPExcel->getActiveSheet(0)->mergeCells('B'.$i.':B'.$len);
			 $objPHPExcel->getActiveSheet(0)->mergeCells('AJ'.$i.':AJ'.$len);
		 }
		 //设置列宽度
		 $objPHPExcel->getActiveSheet()->getStyle('A2:AJ2')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);  
		 $objPHPExcel->getActiveSheet()->getStyle('A2:AJ2')->getFill()->getStartColor()->setARGB('#ccc');  

		 
		 $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth('18'); 
		 $objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('FF808080'); 
		 $objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);  
		 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', '  Export time:'.date('Y-m-d H:i:s').$expTitle);  
         $objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(25);
		 
		 $objPHPExcel->getActiveSheet()->getStyle('A2:AJ2')->getFill()->getStartColor()->setARGB("#0cedffb");
		  $objPHPExcel->getActiveSheet()->getStyle('A2:AJ2')->getFont()->setBold(true);
		 $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->getColor()->setARGB(\PHPExcel_Style_Color::COLOR_BLUE);
		
		 $objPHPExcel->getActiveSheet()->getStyle('D2:AJ2')->getFont()->getColor()->setARGB(\PHPExcel_Style_Color::COLOR_RED);
		 $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
		 
		 
		// 设置第一行
		
		
		 for($i=0;$i<$cellNum;$i++){
			 if(!in_array($cellName[$i],array('A','B','C','AI','AJ','AK'))){
			  	
				$v = $expCellName[$i][1] + 1;
			  	
			  }else{
				$v = $expCellName[$i][1] ; 
		      }
             $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'2', $v); 
         } 
		
		 
         // Miscellaneous glyphs, UTF-8   
         //设置数据
		
		 for($i=0;$i<$dataNum;$i++){
           for($j=0;$j<$cellNum;$j++){
             $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3), $expTableData[$i][$expCellName[$j][0]]);
			 $objPHPExcel->getActiveSheet()->getStyle('B'.$j.':'.'C'.$j)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		     
             
           } 
		    $objPHPExcel->getActiveSheet()->getStyle('A1:AI'.($i+2))->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER); 
			$objPHPExcel->getActiveSheet()->getStyle('AJ3:Aj'.($i+2))->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);         
         }
		
		header('pragma:public');
		Header("Content-type: application/octet-stream;charset=utf-8"); 
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
        header("Content-Disposition:inline;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
        $objWriter->save('php://output'); 
        exit;   
    }
	
	private function get_flow(){
		
		$where = '';
		
		$this->assign('dt',time());
		
		$month = date('m',time());
		$year = date('Y',time());
		//$this->assign('end',cal_days_in_month(CAL_GREGORIAN, $month, $year));
		$firstday = mktime(0,0,0,$month,1,$year); //取所给年月的第一天的UNIX时间戳    
		$days = date('t',$firstday); //返回指定月份的天数  
		
		$this->assign('end',$days);
		
		
		// 1. 查询所有的车辆   
		$list = M('Bus')->field('driver,plate')->select();
		
		//2.查询当月份的所有数据
		$starttime = strtotime(date('Y-m-01',time()));
		$endtime = strtotime(date('Y-m-'.$days.' 23:59:59',time()));
		
		$where .= " xfdate >= $starttime and xfdate <= $endtime ";
		
		$flowList  = M('Flow')->where($where)->order('xfdate asc ')->select();
		
		//echo M('Flow')->_sql();
		
		//echo '<pre>';
		//var_dump($list);
		//echo '</pre>';
		//3. 重组数据
		$val1_sum =$val2_sum = $val3_sum =$val4_sum = 0;
		
		foreach($list as $k=>$val){
			$data = array();
			
			//合计
			$list[$k]['val1']['total'] = $list[$k]['val2']['total'] =$list[$k]['val3']['total'] =$list[$k]['val4']['total'] = 0;
			$n = 0;
			for($i = $starttime;$i < $endtime;$i=$i+86400){
				$data['val1'][$n] = 0;
				$data['val2'][$n] = 0;
				$data['val3'][$n] = 0;
				$data['val4'][$n] = 0;
				
				foreach($flowList as $key=>$v){
					if($v['xfdate'] >= $i &&  $v['xfdate'] < $i+86400 && $v['plate'] == $val['plate']){
						$list[$k]['driver']= $v['driver'];
						$data['val1'][$n] = $v['val1'];//?'<font color="blue">'.$v['val1'].'</font>':0;
						$data['val2'][$n] = $v['val2'];//?'<font color="blue">'.$v['val2'].'</font>':0;
						$data['val3'][$n] = $v['val3'];//?'<font color="blue">'.$v['val3'].'</font>':0;
						$data['val4'][$n] = $v['val4'];//?'<font color="blue">'.$v['val4'].'</font>':0;
					
					    $list[$k]['val1']['total'] = $list[$k]['val1']['total']+ $v['val1'];
						$list[$k]['val2']['total'] = $list[$k]['val2']['total']+ $v['val2'];
						$list[$k]['val3']['total'] = $list[$k]['val3']['total']+ $v['val3'];
						$list[$k]['val4']['total'] = $list[$k]['val4']['total']+ $v['val4'];
					
					}
				}
				$n++;	
			}
			$list[$k]['total'] = $list[$k]['val1']['total'] + $list[$k]['val2']['total'] + $list[$k]['val3']['total'] + $list[$k]['val4']['total'];
			$val1_sum = $val1_sum + $list[$k]['val1']['total'];
			$val2_sum = $val2_sum + $list[$k]['val2']['total'];
			$val3_sum = $val3_sum + $list[$k]['val3']['total'];
			$val4_sum = $val4_sum + $list[$k]['val3']['total'];
			
			
			$list[$k]['data'] = $data;
			
		}
		
		$list['val1_sum'] = $val1_sum;
		$list['val2_sum'] = $val2_sum;
		$list['val3_sum'] = $val3_sum;
		$list['val4_sum'] = $val4_sum;
		
		return $list;
	}
	
}
