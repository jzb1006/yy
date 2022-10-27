<?php

global $_W,$_GPC;
$op = $_GPC['op'];
$uniacid =$_W['uniacid'];
if($op == 'display')
{
	//查询当前站点的所有合作医院
	$res =pdo_getall('hyb_yl_hospital',array('uniacid'=>$uniacid));

	include $this->template("suifan/index");
}
if($op == 'detail')
{
	include $this->template("suifan/detail");
}
if($op == 'update')
{
	include $this->template("suifan/update");
}