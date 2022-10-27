<?php
global $_W, $_GPC;
$op = $_GPC['op'];
$uniacid = $_W['uniacid'];
$type_id = $_GPC['type_id'];
if($op == 'huanzhesearch')
{
	global $_W, $_GPC;
	
	$keyword = !empty($_GPC['keyword'])?$_GPC['keyword']:"";
	if($keyword == '')
	{
		$huanzhe = pdo_fetchall("select * from ".tablename("hyb_yl_myinfors")." where uniacid=:uniacid and hz_name like '%$keyword%'",array(":uniacid"=>$uniacid));
	}else{
		$huanzhe = array();
	}
	return json_encode($huanzhe);
}
if($op == 'yuyuedata')
{
	global $_W,$_GPC;
	$uniacid = $_W['uniacid'];
	$time = $this->get_week(time());
	foreach($time as $key => $value)
	{
		$time[$key] = strtotime($time[$key]);
		$value['num'] = pdo_fetchcolumn("select * from ".tablename("hyb_yl_zhuanjia_yuyue")." where zy_time<:time and zy_time>:times",array(":time"=>$time[$key],":times"=>$time[$key+1]));
	}

}
if($op == 'help')
{
	include $this->template('help');
}
if($op == 'zhanghao')
{
	include $this->template("zhanghao");
}
if($op == 'update')
{
	include $this->template("update_password");
}
if($op == 'login')
{
	include $this->template("login");
}
if($op == 'paiban')
{
	global $_W,$_GPC;
	$pindex = max(1, intval($_GPC['page']));
	$psize = 10;
	$uniacid = $_W['uniacid'];
	$zhuanjia = pdo_fetchall("select * from ".tablename("hyb_yl_zhuanjia")." where uniacid=:uniacid order by zid desc limit ",array(":uniacid"=>$uniacid));

}


