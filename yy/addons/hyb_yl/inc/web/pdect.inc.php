<?php

global $_W,$_GPC;
$uniacid=intval($_W['uniacid']);
require_once dirname(__FILE__) .'/Data/pdo.class.php';
$model=new Model('schoolroom');
$goods = new Model('jfenl');
$op = $_GPC['op'];
$type_id = $_GPC['type_id'];
if($op == 'list_so')
{
		$tab1=$model->tablename("schoolroom");
		$tab2=$model->tablename("jfenl");
		$where="uniacid=$uniacid"; 
		$ca=$model->where($where)->page("*");
		$ca_list=$ca['dataset']; 
		$sql="SELECT DISTINCT $tab1.room_parentid,$tab1.*,$tab2.fl_id,$tab2.j_name FROM $tab1 LEFT JOIN $tab2 ON $tab1.room_parentid=$tab2.fl_id  WHERE $tab1.uniacid='".$uniacid."' order by $tab1.sord DESC";
		$page=$model->pagenation($sql);
		$page['last']=$sql;
		$list=$page['dataset'];
	if($_W['isajax']){
		switch ($_GPC['type']) {
			case 'del_one':
            	$id=intval($_GPC['id']); 
	            $res=$model->delete("id=$id and uniacid=$uniacid ");
				break;
			case 'del':
			    $values =$_GPC['values'];
                foreach ($values as $key => $value) {
                	 $id=intval($value); 
		             $res=$model->delete("id=$id and uniacid=$uniacid ");
                }
				break;
			case 'rec':
			    $values =$_GPC['values'];
                foreach ($values as $key => $value) {
                	 $id=intval($value); 
                	 $data =array(
                          'room_tj' =>1
                	 	);
		             $res=$model->where("id=$id and uniacid=$uniacid")->save($data);
                 }
				break;
			case 'norec':
			    $values =$_GPC['values'];
                foreach ($values as $key => $value) {
                	 $id=intval($value); 
                	 $data =array(
                          'room_tj' =>0
                	 	);
		             $res=$model->where("id=$id and uniacid=$uniacid")->save($data);

                }
				break;
		}
         
            message(error(0, $res), '', 'ajax');  
	}
	include $this->template("pdect/list");
}


if($op == 'add')
{   

    $where="uniacid=$uniacid"; 
	$cate = $goods->where($where)->page("*");
	$cate_list = $cate['dataset'];
	$id = intval($_GPC['id']);
	$res = $model->where("id=$id and uniacid=$uniacid")->get('*');
    $res['spic'] =unserialize($res['spic']);
	$state =$_GPC['state'];

	$data =array(
	      'uniacid'     => $_W['uniacid'],
	      'sroomtitle'  => $_GPC['sroomtitle'],
	      'room_money'  => $_GPC['room_money'],
	      'room_tj'     => $_GPC['room_tj'],
	      'room_parentid' => $_GPC['room_parentid'],
	      'room_desc'  => $_GPC['room_desc'],
	      'room_thumb' => $_GPC['room_thumb'],
	      'z_name'     => $_GPC['link']
	    );

    if($_W['ispost']){
         //var_dump($data);exit();
 		if($id){
 			$model->where("id=$id and uniacid=$uniacid")->save($data);
            message("编辑成功!",$this->createWebUrl("pdect",array("op"=>"add",'id'=>$id)),"success");
 		}else{
 			$model->add($data);
 			 message("编辑成功!",$this->createWebUrl("pdect",array("op"=>"list_so",'id'=>$id)),"success");
 		}
	  
    }
	include $this->template("pdect/add");
}


