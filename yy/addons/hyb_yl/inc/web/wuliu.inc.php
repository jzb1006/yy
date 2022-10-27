<?php

global $_W,$_GPC;
$op = $_GPC['op'];
$_W['plugin'] = 'medicine';
$ac =$_GPC['ac'];
$uniacid=intval($_W['uniacid']);
if($op =='wuliulist'){
$where ="where uniacid='{$uniacid}'";
 $keyword = $_GPC['keyword'];
 $status =$_GPC['status'];
 if(!empty($keyword) || $status ==""){
   $where.=" and name like '%$keyword%'";
 }

 if($status!=='-1' && $status!==""){
   $where.=" and status='{$status}'";
 }
 if($_W['ispost']){
     $row = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_kuaidi')."".$where."");
 }else{
 	 $row = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_kuaidi')."".$where."");
 }


include $this->template("wuliu/list");
}
if($op =='add'){
	$id = $_GPC['id'];
	$res = pdo_get('hyb_yl_kuaidi',array('id'=>$id));
	if($_W['ispost']){
		$data =array(
		     'uniacid' =>$_W['uniacid'],
		     'name'    =>$_GPC['name'],
		     'com'     =>$_GPC['com'],
		     'tel'     =>$_GPC['tel'],
		     'sort'    =>$_GPC['sort'],
		     'created' =>strtotime('now'),
		     'status'  =>$_GPC['status']
			);
		if(empty($id)){
        pdo_insert('hyb_yl_kuaidi',$data);
		message("添加成功!",$this->createWebUrl("wuliu",array("op"=>"wuliulist",'ac'=>'wuliulist','status'=>-1)),"success");
		}else{
        pdo_update('hyb_yl_kuaidi',$data,array('id'=>$id));
		message("修改成功!",$this->createWebUrl("wuliu",array("op"=>"wuliulist",'ac'=>'wuliulist','status'=>-1)),"success");
		}
	}
	include $this->template("wuliu/add");
}