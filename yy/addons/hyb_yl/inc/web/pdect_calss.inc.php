<?php

global $_W,$_GPC;
$uniacid=intval($_W['uniacid']);
require_once dirname(__FILE__) .'/Data/pdo.class.php';
$goods = new Model('jfenl');
$op = $_GPC['op'];
$type_id = $_GPC['type_id'];
if($op == 'cate')
{
	$where="uniacid=$uniacid"; 
	$page=$goods->where($where)->page("*");
	$page['attachurl']=$_W['attachurl'];
	$list=$page['dataset'];
	if($_W['isajax']){
		switch ($_GPC['type']) {

			case 'del_one':
            	$fl_id=intval($_GPC['fl_id']); 
	            $res=$model->delete("fl_id=$fl_id and uniacid=$uniacid ");
				break;

			case 'del':
			    $values =$_GPC['values'];
                foreach ($values as $key => $value) {
                	 $fl_id=intval($value); 
		             $res=$goods->delete("fl_id=$fl_id and uniacid=$uniacid ");
                }
				break;
		}
         
       message(error(0, $values), '', 'ajax');  
	}
	include $this->template("pdect_calss/list_category");
}
if($op == 'add_category')
{
    $fl_id =intval($_GPC['fl_id']);
	$res = $goods->where("fl_id=$fl_id and uniacid=$uniacid")->get('*');
    $res['j_thumb'] =unserialize($res['j_thumb']);
	$state ='0';
	$data =array(
	      'uniacid'  => $_W['uniacid'],
          'j_name'   => $_GPC['j_name'],
          'j_thumb'  => $_GPC['j_thumb'],
	    );
    if($_W['ispost']){

 		if($fl_id){
 			$goods->where("fl_id=$fl_id and uniacid=$uniacid")->save($data);
 			message('成功', 'refresh', 'success');
 			//message("编辑成功!",$this->createWebUrl("pdect_calss",array("op"=>"add_category",'fl_id'=>$fl_id)),"success");
 		}else{
 			$goods->add($data);
 			message('成功', 'refresh', 'success');
 			//message("添加成功!",$this->createWebUrl("pdect_calss",array("op"=>"cate",'fl_id'=>$fl_id)),"success");
 		}
	  
    }
	include $this->template("pdect_calss/add_category");
}


