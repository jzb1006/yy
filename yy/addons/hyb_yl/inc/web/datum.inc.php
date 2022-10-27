<?php

global $_W,$_GPC;
$op = $_GPC['op'];
$uniacid = $_W['uniacid'];
$_W['plugin'] = 'datacenter';
if(!empty($_GPC['hid']))
{
  $lifeTime = 24 * 3600; 
  session_set_cookie_params($lifeTime); 
  session_start();
  $_SESSION["is_hospital"] = '1'; 
  $_SESSION['hid'] = $_GPC['hid'];
  define("is_agent",'1');
  define("hid",$_GPC['hid']);
  $hospital = pdo_get("hyb_yl_hospital",array("uniacid"=>$uniacid,"hid"=>hid));
  $role = pdo_getcolumn("hyb_yl_hospital_role",array("id"=>$hospital['groupid']),'role');
  $role = unserialize($role);
  define('groupids',$hospital['groupid']);
  $zhuanjia = pdo_fetchall("select zid from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$_GPC['hid']);
  $zjs = '';
  foreach($zhuanjia as &$zj)
  {
    $zjs .= $zj['zid'].",";
  }
  $zjs = substr($zjs,0,strlen($zjs)-1);
  define('zid', $zjs);
}
if($op == 'index')
{
	$data = array();
	// $timetype = empty($_GPC['timetype']) ? '1' : $_GPC['timetype'];
	
	$starts = empty($_GPC['start']) ? date("Y-m-d") : $_GPC['start'];
	$start = strtotime($starts);
	$ends = empty($_GPC['end']) ? date("Y-m-d") : $_GPC['end'];
	$ends = $ends . ' 23:59:59';
	$end = strtotime($ends);
	if(is_agent == '1')
	{
		if($zjs != '')
		{
			$tw_where = " and zid in (".$zjs.")";
		}else{
			$tw_where = " and zid is NULL";
		}
	}else{
		$tw_where = '';
	}
	$tuwen = pdo_fetchall("select money from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and paytime>=".$start." and paytime<=".$end.$tw_where." and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8 group by back_orser");

	
	$tuwen = array_sum(array_map(function($val){return $val['money'];}, $tuwen));

    if(!$tuwen)
    {
      $tuwen = '0.00';
    }
	
	$chufang = pdo_fetchall("select money from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid." and paytime>=".$start." and paytime<=".$end.$tw_where." and (ispay != 0 and ispay != 6 and ispay != 7 and ispay!=8) group by back_orser");
	
	$chufang = array_sum(array_map(function($val){return $val['money'];}, $chufang));

    if(!$chufang)
    {
      $chufang = '0.00';
    }
	$shipin = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and paytime>=".$start." and paytime<=".$end.$tw_where." and (ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8) and keywords='shipinwenzhen' group by back_orser");
	
	$shipin = array_sum(array_map(function($val){return $val['money'];}, $shipin));

    if(!$shipin)
    {
      $shipin = '0.00';
    }
	$tel = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and paytime>=".$start." and paytime<=".$end.$tw_where." and (ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8) and keywords='dianhuajizhen' group by back_orser");

	$tel = array_sum(array_map(function($val){return $val['money'];}, $tel));

    if(!$tel)
    {
      $tel = '0.00';
    }
	$guahao = pdo_fetchall("select money from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid." and time>=".$start." and time<=".$end.$tw_where." and (ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8) group by back_orser");
	$guahao = array_sum(array_map(function($val){return $val['money'];}, $guahao));
	
    if(!$guahao)
    {
      $guahao = '0.00';
    }
	$shoushu = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and paytime>=".$start." and paytime<=".$end.$tw_where." and (ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8) and keywords='shoushukuaiyue' group by back_orser");
	
	$shoushu = array_sum(array_map(function($val){return $val['money'];}, $shoushu));
    if(!$shoushu)
    {
      $shoushu = '0.00';
    }
	$baogao = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and paytime>=".$start." and paytime<=".$end.$tw_where." and (ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8) and keywords='tijianjiedu' group by back_orser");
	
	$baogao = array_sum(array_map(function($val){return $val['money'];}, $baogao));
    if(!$baogao)
    {
      $baogao = '0.00';
    }
	$goods = pdo_fetchcolumn("select sum(realTotalMoney) from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid." and createTime>=".$starts.$tw_where." and createTime<=".$ends." and isPay=1");
	
	if(!$goods)
	{
		$goods = '0.00';
	}
	$tijian = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and time>=".$start." and time<=".$end.$tw_where." and ifpay=1");
	if(!$tijian)
	{
		$tijian = '0.00';
	}
	$fenxiao = '0.00';
	$choucheng = '0.00';
	$money = $tuwen + $chufang + $shipin + $tel + $guahao + $shoushu + $baogao + $goods + $tijian + $fenxiao + $choucheng;
	
	$tuwen1 = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid.$tw_where." and (ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8) group by back_orser");


	$chufang1 = pdo_fetchall("select count(*) from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid.$tw_where." and paytime>=".$start." and paytime<=".$end." and (ispay != 0 and ispay != 6 and ispay != 7 and ispay!=8) group by back_orser");
	
	$shipin1 = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid.$tw_where." and paytime>=".$start." and paytime<=".$end." and keywords='shipinwenzhen' and (ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8) group by back_orser");
	
	$tel1 = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid.$tw_where." and paytime>=".$start." and paytime<=".$end." and (ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8) and keywords='dianhuajizhen' group by back_orser");
	
	$guahao1 = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid.$tw_where." and time>=".$start." and time<=".$end." and (ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8) group by back_orser");
	
	$shoushu1 = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid.$tw_where." and paytime>=".$start." and paytime<=".$end." and (ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8) and keywords='shoushukuaiyue' group by back_orser");
	
	$baogao1 = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid.$tw_where." and paytime>=".$start." and paytime<=".$end." and (ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8) and keywords='tijianjiedu' group by back_orser");
	
	$goods1 = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid.$tw_where." and createTime>=".$starts." and createTime<=".$ends." and isPay=1");
	
	$tijian1 = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid.$tw_where." and time>=".$start." and time<=".$end." and (ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8)");

	$count = count($tuwen1) + count($chufang1) + count($shipin1) + count($tel1) + count($guahao1) + count($shoushu1) + count($baogao1) + $goods1 + $tijian1;
	
	$tuwens = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid.$tw_where." and paytime>=".$start." and paytime<=".$end." and (ifpay=6 or ifpay=7) group by back_orser");
	
	$chufangs = pdo_fetchall("select count(*) from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid.$tw_where." and paytime>=".$start." and paytime<=".$end." and (ispay=6 or ispay=7) group by back_orser");
	
	$shipins = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid.$tw_where." and paytime>=".$start." and paytime<=".$end." and (ifpay=6 or ifpay=7) and keywords='shipinwenzhen' group by back_orser");
	
	$tels = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid.$tw_where." and paytime>=".$start." and paytime<=".$end." and (ifpay=6 or ifpay=7) and keywords='dianhuajizhen' group by back_orser");
	
	$guahaos = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid.$tw_where." and time>=".$start." and time<=".$end." and (ifpay=6 or ifpay=7) group by back_orser");
	
	$shoushus = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid.$tw_where." and paytime>=".$start." and paytime<=".$end." and (ifpay=6 or ifpay=7) and keywords='shoushukuaiyue' group by back_orser");
	
	$baogaos = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid.$tw_where." and paytime>=".$start." and paytime<=".$end." and (ifpay=6 or ifpay=7) and keywords='tijianjiedu' group by back_orser");
	
	$tijians = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid.$tw_where." and time>=".$start." and time<=".$end." and (ifpay=6 or ifpay=7)");

	$goodss = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid.$tw_where." and createTime>=".$starts." and createTime<=".$ends." and isRefund=1");
	
	$refund = count($tuwens) + count($chufangs) + count($shipins) + count($tels) + count($guahaos) + count($shoushus) + count($baogaos) + $goodss + $tijians;
	
    // 计算日期段内有多少天
    $days = ($end-$start)/86400;
    

    // 保存每天日期
    $date = array();

    for($i=0; $i<$days; $i++){
        $date[]['time'] = date('Y-m-d', $start+(86400*$i));
    }
    foreach($date as &$value)
    {

		$params = array(':uniacid' => $_W['uniacid'], ':starttime' => strtotime($value['time'] . ' 00:00:00'), ':endtime' => strtotime($value['time'] . ' 23:59:59'));
		$tuwen2 = pdo_fetchall("select money from ".tablename("hyb_yl_twenorder")." where uniacid=:uniacid and paytime>=:starttime and paytime<=:endtime ".$tw_where." and (ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8) group by back_orser",$params);
		

		$tuwen2 = array_sum(array_map(function($val){return $val['money'];}, $tuwen2));
     
	     if(!$tuwen2)
	     {
	         $tuwen2 = '0.00';
	     }
		$chufang2 = pdo_fetchall("select money from ".tablename("hyb_yl_chufang")." where uniacid=:uniacid and paytime>=:starttime and paytime<=:endtime ".$tw_where." and (ispay != 0 and ispay != 6 and ispay != 7 and ispay!=8) group by back_orser",$params);
		
		

		$chufang2 = array_sum(array_map(function($val){return $val['money'];}, $chufang2));
     
	     if(!$chufang2)
	     {
	         $chufang2 = '0.00';
	     }

		$shipin2 = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=:uniacid and paytime>=:starttime and paytime<=:endtime ".$tw_where." and keywords='shipinwenzhen' and (ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8) group by back_orser",$params);

		$shipin2 = array_sum(array_map(function($val){return $val['money'];}, $shipin2));
     
	    if(!$shipin2)
	    {
	        $shipin2 = '0.00';
	    }
		$tel2 = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=:uniacid and paytime>=:starttime and paytime<=:endtime ".$tw_where." and keywords='dianhuajizhen' and (ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8) group by back_orser",$params);

		$tel2 = array_sum(array_map(function($val){return $val['money'];}, $tel2));
     
	    if(!$tel2)
	    {
	        $tel2 = '0.00';
	    }
		$guahao2 = pdo_fetchall("select money from ".tablename("hyb_yl_guahaoorder")." where uniacid=:uniacid and time>=:starttime and time<=:endtime ".$tw_where." and (ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8) group by back_orser",$params);

		$guahao2 = array_sum(array_map(function($val){return $val['money'];}, $guahao2));
     
	    if(!$guahao2)
	    {
	        $guahao2 = '0.00';
	    }
		$shoushu2 = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=:uniacid and paytime>=:starttime and paytime<=:endtime ".$tw_where." and keywords='shoushukuaiyue' and (ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8) group by back_orser",$params);
		

		$shoushu2 = array_sum(array_map(function($val){return $val['money'];}, $shoushu2));
     
	    if(!$shoushu2)
	    {
	        $shoushu2 = '0.00';
	    }

		$baogao2 = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=:uniacid and paytime>=:starttime and paytime<=:endtime ".$tw_where." and keywords='tijianjiedu' and (ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8) group by back_orser",$params);
		
		$baogao2 = array_sum(array_map(function($val){return $val['money'];}, $baogao2));
     
	    if(!$baogao2)
	    {
	        $baogao2 = '0.00';
	    }
		$goods2 = pdo_fetchcolumn("select sum(realTotalMoney) from ".tablename("hyb_yl_goodsorders")." where uniacid=:uniacid and createTime>=:starttime ".$tw_where." and createTime<=:endtime and isPay=1",$params);

		if(!$goods2)
		{
			$goods2 = '0.00';
		}
		$tijian2 = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_tijianorder")." where uniacid=:uniacid and time>=:starttime ".$tw_where." and time<=:endtime and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8",$params);

		if(!$tijian2)
		{
			$tijian2 = '0.00';
		}
		$fenxiao = '0.00';
		$choucheng = '0.00';
		$money2 = $tuwen2 + $chufang2 + $shipin2 + $tel2 + $guahao2 + $shoushu2 + $baogao2 + $goods2 + $tijian2 + $fenxiao + $choucheng;

		$value['tuwen'] = $tuwen2;
		$value['shipin'] = $shipin2;
		$value['tel'] = $tel2;
		$value['guahao'] = $guahao2;
		$value['chufang'] = $chufang2;

		$value['shoushu'] = $shoushu2;
		$value['baogao'] =$baogao2;
		$value['goods'] = $goods2;
		$value['tijian'] = $tijian2;
		$value['fenxiao'] = $fenxiao;
		$value['choucheng'] = $choucheng;
		$value['money'] = $money2;
		
    }
   
   	
	include $this->template("datum/index");
}
//推广统计
if($op == 'promotionstatistics')
{
	if(is_agent == '1')
	{
		$hospital = pdo_getall("hyb_yl_hospital",array("uniacid"=>$uniacid,'hid'=>$_SESSION['hid']));
		if($zjs != '')
		{
			$tw_where = " and zid in (".$zjs.")";
		}else{
			$tw_where = " and zid is NULL";
		}
	}else{
		$hospital = pdo_getall("hyb_yl_hospital",array("uniacid"=>$uniacid));
		$tw_where = "";
	}
	
	$data = array();
	
	$starts = empty($_GPC['start']) ? date("Y-m-d") : $_GPC['start'];
	$start = strtotime($starts);
	$ends = empty($_GPC['end']) ? date("Y-m-d") : $_GPC['end'];
	$ends = $ends . ' 23:59:59';
	$end = strtotime($ends);
	$tuwen = pdo_fetchall("select money from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and paytime>=".$start." and paytime<=".$end.$tw_where." and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8 group by back_orser");

	$tuwen = array_sum(array_map(function($val){return $val['money'];}, $tuwen));
    if(!$tuwen)
    {
      $tuwen = '0.00';
    }
	$chufang = pdo_fetchall("select money from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid." and paytime>=".$start." and paytime<=".$end.$tw_where." and ispay != 0 and ispay != 6 and ispay != 7 and ispay!=8 group by back_orser");

	$chufang = array_sum(array_map(function($val){return $val['money'];}, $chufang));
    if(!$chufang)
    {
      $chufang = '0.00';
    }
	$shipin = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and paytime>=".$start." and paytime<=".$end.$tw_where." and keywords='shipinwenzhen' and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8 group by back_orser");

	$shipin = array_sum(array_map(function($val){return $val['money'];}, $shipin));
    if(!$shipin)
    {
      $shipin = '0.00';
    }
	$tel = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and paytime>=".$start." and paytime<=".$end.$tw_where." and keywords='dianhuajizhen' and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8 group by back_orser");

	$tel = array_sum(array_map(function($val){return $val['money'];}, $tel));
    if(!$tel)
    {
      $tel = '0.00';
    }
	$guahao = pdo_fetchall("select money from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid." and time>=".$start." and time<=".$end.$tw_where." and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8 group by back_orser");
	$guahao = array_sum(array_map(function($val){return $val['money'];}, $guahao));

    if(!$guahao)
    {
      $guahao = '0.00';
    }
	$shoushu = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and paytime>=".$start." and paytime<=".$end.$tw_where." and keywords='shoushukuaiyue' and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8 group by back_orser");

	$shoushu = array_sum(array_map(function($val){return $val['money'];}, $shoushu));
    if(!$shoushu)
    {
      $shoushu = '0.00';
    }
	$baogao = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and paytime>=".$start." and paytime<=".$end.$tw_where." and keywords='tijianjiedu' and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8 group by back_orser");

	$baogao = array_sum(array_map(function($val){return $val['money'];}, $baogao));
    if(!$baogao)
    {
      $baogao = '0.00';
    }
	$tijian = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and time>=".$start." and time<=".$end.$tw_where." and ifpay=1");
	if(!$tijian)
	{
		$tijian = '0.00';
	}
	$money = $tuwen + $chufang + $shipin + $tel + $guahao + $shoushu + $baogao + $tijian;
	
	$tuwen1 = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and paytime>=".$start." and paytime<=".$end.$tw_where." and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8 group by back_orser");

	$chufang1 = pdo_fetchall("select count(*) from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid." and paytime>=".$start." and paytime<=".$end.$tw_where." and ispay != 0 and ispay != 6 and ispay != 7 and ispay!=8 group by back_orser");
	
	$shipin1 = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and paytime>=".$start." and paytime<=".$end.$tw_where." and keywords='shipinwenzhen' and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8 group by back_orser");
	
	$tel1 = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and paytime>=".$start." and paytime<=".$end.$tw_where." and keywords='dianhuajizhen' and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8 group by back_orser");
	
	$guahao1 = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid." and time>=".$start." and time<=".$end.$tw_where." and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8 group by back_orser");
	
	$shoushu1 = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and paytime>=".$start." and paytime<=".$end.$tw_where." and keywords='shoushukuaiyue' and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8 group by back_orser");
	
	$baogao1 = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and paytime>=".$start." and paytime<=".$end.$tw_where." and keywords='tijianjiedu' and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8 group by back_orser");
	
	$goods1 = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid." and createTime>='".$starts."' and createTime<='".$ends.$tw_where."' and isPay=1");
	
	$tijian1 = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and time>=".$start." and time<=".$end.$tw_where." and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8");
	
	$count = count($tuwen1) + count($chufang1) + count($shipin1) + count($tel1) + count($guahao1) + count($shoushu1) + count($baogao1) + $goods1 + $tijian1;
    // 计算日期段内有多少天
    $days = ($end-$start)/86400;
    

    // 保存每天日期
    $date = array();

    for($i=0; $i<$days; $i++){
        $date[]['time'] = date('Y-m-d', $start+(86400*$i));
    }
    
    foreach($hospital as &$valuess)
	{
	    foreach($date as &$value)
	    {

    		$zids = '';
			$zid = pdo_fetchall("select zid from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$valuess['hid']);
			
			if(count($zid) > 0)
			{
				foreach($zid as &$values)
				{
					$zids .= $values['zid'].",";
				}
				
				$zids = substr($zids, 0,strlen($zids)-1);
			}else{
				$zids = '';
			}
			
		
		$params = array(':uniacid' => $_W['uniacid'], ':starttime' => strtotime($value['time'] . ' 00:00:00'), ':endtime' => strtotime($value['time'] . ' 23:59:59'));
		
		$tuwen2 = pdo_fetchall("select money from ".tablename("hyb_yl_twenorder")." where uniacid=:uniacid and paytime>=:starttime and paytime<=:endtime and zid in (".$zids.") ".$tw_where." and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8 group by back_orser",$params);

		$tuwen2 = array_sum(array_map(function($val){return $val['money'];}, $tuwen2));
	    if(!$tuwen2)
	    {
	      $tuwen2 = '0.00';
	    }
		$chufang2 = pdo_fetchall("select money from ".tablename("hyb_yl_chufang")." where uniacid=:uniacid and paytime>=:starttime and paytime<=:endtime and zid in (".$zids.") ".$tw_where." and ispay != 0 and ispay != 6 and ispay != 7 and ispay!=8 group by back_orser",$params);

		$chufang2 = array_sum(array_map(function($val){return $val['money'];}, $chufang2));
	    if(!$chufang2)
	    {
	      $chufang2 = '0.00';
	    }
		$shipin2 = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=:uniacid and paytime>=:starttime and paytime<=:endtime and keywords='shipinwenzhen' ".$tw_where." and zid in (".$zids.") and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8 group by back_orser",$params);
		

		$shipin2 = array_sum(array_map(function($val){return $val['money'];}, $shipin2));
	    if(!$shipin2)
	    {
	      $shipin2 = '0.00';
	    }
		$tel2 = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=:uniacid and paytime>=:starttime and paytime<=:endtime and keywords='dianhuajizhen' and zid in (".$zids.") ".$tw_where." and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8 group by back_orser",$params);

		$tel2 = array_sum(array_map(function($val){return $val['money'];}, $tel2));
	    if(!$tel2)
	    {
	      $tel2 = '0.00';
	    }
		$guahao2 = pdo_fetchall("select money from ".tablename("hyb_yl_guahaoorder")." where uniacid=:uniacid and time>=:starttime and time<=:endtime and zid in (".$zids.") and ifpay != 0 and ifpay != 6 ".$tw_where." and ifpay != 7 and ifpay!=8 group by back_orser",$params);
		
		$guahao2 = array_sum(array_map(function($val){return $val['money'];}, $guahao2));
	    if(!$guahao2)
	    {
	      $guahao2 = '0.00';
	    }
		$shoushu2 = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=:uniacid and paytime>=:starttime and paytime<=:endtime and keywords='shoushukuaiyue' and zid in (".$zids.") ".$tw_where." and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8 group by back_orser",$params);

		$shoushu2 = array_sum(array_map(function($val){return $val['money'];}, $shoushu2));
	    if(!$shoushu2)
	    {
	      $shoushu2 = '0.00';
	    }
		$baogao2 = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=:uniacid and paytime>=:starttime and paytime<=:endtime and keywords='tijianjiedu' and zid in (".$zids.") ".$tw_where." and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8 group by back_orser",$params);

		$baogao2 = array_sum(array_map(function($val){return $val['money'];}, $baogao2));
	    if(!$baogao2)
	    {
	      $baogao2 = '0.00';
	    }
		$tijian2 = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_tijianorder")." where uniacid=:uniacid and time>=:starttime and time<=:endtime and ifpay=1 ".$tw_where." and zid in (".$zids.")",$params);

		if(!$tijian2)
		{
			$tijian2 = '0.00';
		}

		$money2 = $tuwen2 + $shipin2 + $tel2 + $guahao2 + $shoushu2 + $baogao2 + $tijian2;

		$valuess['tuwens'] = $tuwen2;
		$valuess['shipins'] = $shipin2;
		$valuess['tels'] = $tel2;
		$valuess['guahaos'] = $guahao2;
		$valuess['shoushus'] = $shoushu2;
		$valuess['baogaos'] =$baogao2;
		$valuess['tijians'] = $tijian2;
		$valuess['chufangs'] = $chufang2;
		$valuess['moneys'] = $money2;

		$valuess['tuwen'][] = $tuwen2;
		$valuess['shipin'][] = $shipin2;
		$valuess['tel'][] = $tel2;
		$valuess['guahao'][] = $guahao2;
		$valuess['shoushu'][] = $shoushu2;
		$valuess['baogao'][] =$baogao2;
		$valuess['tijian'][] = $tijian2;
		$valuess['moneyss'][] = $money2;
		$value['hospital'][] = $valuess;
		$valuess['time'] = $value['time'];


				
		}
    }
    
    $time = array_column($date,'time');
    
	include $this->template("datum/promotionstatistics");
}
//专家统计
if($op == 'expertstatistics')
{
	if(is_agent == '1')
	{
		if($zjs != '')
		{
			$wheres = " and zid in (".$zjs.")";
		}else{
			$wheres = " and zid is NULL";
		}
		$zhuanjia = pdo_fetchall("select * from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid.$wheres);
	}else{

		$wheres = '';
		$zhuanjia = pdo_getall("hyb_yl_zhuanjia",array("uniacid"=>$uniacid));
	}
	
	$data = array();
	// $timetype = empty($_GPC['timetype']) ? '1' : $_GPC['timetype'];
	
	$starts = empty($_GPC['start']) ? date("Y-m-d") : $_GPC['start'];
	$start = strtotime($starts);
	$ends = empty($_GPC['end']) ? date("Y-m-d") : $_GPC['end'];
	$ends = $ends . ' 23:59:59';
	$end = strtotime($ends);
	$zid = $_GPC['zid'];

	$where = '';
	if($zid)
	{
		$where = " and zid=".$zid;
	}
	$tuwen = pdo_fetchall("select money from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and paytime>=".$start." and paytime<=".$end." and ifpay != 0 and ifpay != 6 and ifpay != 7".$where.$wheres." group by back_orser");

	$tuwen = array_sum(array_map(function($val){return $val['money'];}, $tuwen));
    if(!$tuwen)
    {
      $tuwen = '0.00';
    }
	
	$chufang = pdo_fetchall("select money from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid." and paytime>=".$start." and paytime<=".$end." and ispay != 0 and ispay != 6 and ispay != 7".$where.$wheres." group by back_orser");

	$chufang = array_sum(array_map(function($val){return $val['money'];}, $chufang));
    if(!$chufang)
    {
      $chufang = '0.00';
    }
	$shipin = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and paytime>=".$start." and paytime<=".$end." and keywords='shipinwenzhen' and ifpay != 0 and ifpay != 6 and ifpay != 7".$where.$wheres." group by back_orser");

	$shipin = array_sum(array_map(function($val){return $val['money'];}, $shipin));
    if(!$shipin)
    {
      $shipin = '0.00';
    }
	$tel = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and paytime>=".$start." and paytime<=".$end." and keywords='dianhuajizhen' and ifpay != 0 and ifpay != 6 and ifpay != 7".$where.$wheres." group by back_orser");

	$tel = array_sum(array_map(function($val){return $val['money'];}, $tel));
    if(!$tel)
    {
      $tel = '0.00';
    }
	$guahao = pdo_fetchall("select money from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid." and time>=".$start." and time<=".$end." and ifpay != 0 and ifpay != 6 and ifpay != 7".$where.$wheres." group by back_orser");

	$guahao = array_sum(array_map(function($val){return $val['money'];}, $guahao));
    if(!$guahao)
    {
      $guahao = '0.00';
    }
	$shoushu = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and paytime>=".$start." and paytime<=".$end." and keywords='shoushukuaiyue' and ifpay != 0 and ifpay != 6 and ifpay != 7".$where.$wheres." group by back_orser");

	$shoushu = array_sum(array_map(function($val){return $val['money'];}, $shoushu));
    if(!$shoushu)
    {
      $shoushu = '0.00';
    }
	$baogao = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and paytime>=".$start." and paytime<=".$end." and keywords='tijianjiedu' and ifpay != 0 and ifpay != 6 and ifpay != 7".$where.$wheres." group by back_orser");

	$baogao = array_sum(array_map(function($val){return $val['money'];}, $baogao));
    if(!$baogao)
    {
      $baogao = '0.00';
    }
	$goods = pdo_fetchcolumn("select sum(realTotalMoney) from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid." and createTime>='".$starts."' and createTime<='".$ends."' and isPay=1".$where.$wheres);
	
	if(!$goods)
	{
		$goods = '0.00';
	}
	$tijian = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and time>=".$start." and time<=".$end." and ifpay != 0 and ifpay != 6 and ifpay != 7".$where.$wheres);

	if(!$tijian)
	{
		$tijian = '0.00';
	}	
	$money = $tuwen + $chufang + $shipin + $tel + $guahao + $shoushu + $baogao + $goods + $tijian;
	$tuwen1 = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and paytime>=".$start." and paytime<=".$end." and ifpay != 0 and ifpay != 6 and ifpay != 7".$where.$wheres." group by back_orser");
	
	$chufang1 = pdo_fetchall("select count(*) from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid." and time>=".$start." and time<=".$end." and ispay != 0 and ispay != 6 and ispay != 7".$where.$wheres." group by back_orser");
	
	$shipin1 = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and paytime>=".$start." and paytime<=".$end." and keywords='shipinwenzhen' and ifpay != 0 and ifpay != 6 and ifpay != 7".$where.$wheres." group by back_orser");
	
	$tel1 = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and paytime>=".$start." and paytime<=".$end." and keywords='dianhuajizhen' and ifpay != 0 and ifpay != 6 and ifpay != 7".$where.$wheres." group by back_orser");
	
	$guahao1 = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder".$where)." where uniacid=".$uniacid." and time>=".$start." and time<=".$end." and ifpay != 0 and ifpay != 6 and ifpay != 7".$where.$wheres." group by back_orser");
	
	$shoushu1 = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and paytime>=".$start." and paytime<=".$end." and keywords='shoushukuaiyue' and ifpay != 0 and ifpay != 6 and ifpay != 7".$where.$wheres." group by back_orser");
	
	$baogao1 = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and paytime>=".$start." and paytime<=".$end." and keywords='tijianjiedu' and ifpay != 0 and ifpay != 6 and ifpay != 7".$where.$wheres." group by back_orser");
	
	$goods1 = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid." and createTime>=".$starts." and createTime<=".$ends." and isPay=1".$where.$wheres);
	
	$tijian1 = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and time>=".$start." and time<=".$end." and ifpay != 0 and ifpay != 6 and ifpay != 7".$where.$wheres);
	
	$count = count($tuwen1) + count($chufang1) + count($shipin1) + count($tel1) + count($guahao1) + count($shoushu1) + count($baogao1) + $goods1 + $tijian1;
	

    // 计算日期段内有多少天
    $days = ($end-$start)/86400;
    

    // 保存每天日期
    $date = array();

    for($i=0; $i<$days; $i++){
        $date[]['time'] = date('Y-m-d', $start+(86400*$i));
    }
    if($zid != '')
    {
    	$zhuanjias = pdo_getall("hyb_yl_zhuanjia",array("uniacid"=>$uniacid,"zid"=>$zid));
    }else{
    	$zhuanjias = $zhuanjia;
    }
	
	foreach($zhuanjias as &$values)
    {
    	foreach($date as &$value)
	    {
    	
    	
    		$params = array(':uniacid' => $_W['uniacid'], ':starttime' => strtotime($value['time'] . ' 00:00:00'), ':endtime' => strtotime($value['time'] . ' 23:59:59'),":zid"=>$values['zid']);
			$tuwen2 = pdo_fetchall("select money from ".tablename("hyb_yl_twenorder")." where uniacid=:uniacid and paytime>=:starttime and paytime<=:endtime and zid=:zid and ifpay != 0 and ifpay != 6 and ifpay != 7 ".$wheres."  group by back_orser",$params);
			$tuwen2 = array_sum(array_map(function($val){return $val['money'];}, $tuwen2));
		    if(!$tuwen2)
		    {
		      $tuwen2 = '0.00';
		    }
			$chufang2 = pdo_fetchall("select money from ".tablename("hyb_yl_chufang")." where uniacid=:uniacid and paytime>=:starttime and paytime<=:endtime and zid=:zid and ispay != 0 and ispay != 6 and ispay != 7 ".$wheres." group by back_orser",$params);
			
			$chufang2 = array_sum(array_map(function($val){return $val['money'];}, $chufang2));
		    if(!$chufang2)
		    {
		      $chufang2 = '0.00';
		    }
			$shipin2 = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=:uniacid and paytime>=:starttime and paytime<=:endtime and keywords='shipinwenzhen' and zid=:zid and ifpay != 0 and ifpay != 6 and ifpay != 7 ".$wheres." group by back_orser",$params);
			
			$shipin2 = array_sum(array_map(function($val){return $val['money'];}, $shipin2));
		    if(!$shipin2)
		    {
		      $shipin2 = '0.00';
		    }
			$tel2 = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=:uniacid and paytime>=:starttime and paytime<=:endtime and keywords='dianhuajizhen' and zid=:zid and ifpay != 0 and ifpay != 6 and ifpay != 7 ".$wheres." group by back_orser",$params);

			$tel2 = array_sum(array_map(function($val){return $val['money'];}, $tel2));
		    if(!$tel2)
		    {
		      $tel2 = '0.00';
		    }
			$guahao2 = pdo_fetchall("select money from ".tablename("hyb_yl_guahaoorder")." where uniacid=:uniacid and time>=:starttime and time<=:endtime and zid=:zid and ifpay != 0 and ifpay != 6 and ifpay != 7 group by back_orser",$params);

			$guahao2 = array_sum(array_map(function($val){return $val['money'];}, $guahao2));
		    if(!$guahao2)
		    {
		      $guahao2 = '0.00';
		    }
			$shoushu2 = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=:uniacid and paytime>=:starttime and paytime<=:endtime and keywords='shoushukuaiyue' and zid=:zid and ifpay != 0 and ifpay != 6 and ifpay != 7 ".$wheres." group by back_orser",$params);

			$shoushu2 = array_sum(array_map(function($val){return $val['money'];}, $shoushu2));
		    if(!$shoushu2)
		    {
		      $shoushu2 = '0.00';
		    }
			$baogao2 = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=:uniacid and paytime>=:starttime and paytime<=:endtime and keywords='tijianjiedu' and zid=:zid and ifpay != 0 and ifpay != 6 and ifpay != 7 ".$wheres." group by back_orser",$params);

			$baogao2 = array_sum(array_map(function($val){return $val['money'];}, $baogao2));
		    if(!$baogao2)
		    {
		      $baogao2 = '0.00';
		    }
			$tijian2 = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_tijianorder")." where uniacid=:uniacid and time>=:starttime and time<=:endtime and ifpay != 0 and ifpay != 6 and ifpay != 7 and zid=:zid".$wheres,$params);
			
			if(!$tijian2)
			{
				$tijian2 = '0.00';
			}
			$money2 = $tuwen2 + $chufang2 + $shipin2 + $tel2 + $guahao2 + $shoushu2 + $baogao2  + $tijian2;

			
			$values['tuwens'] = $tuwen2;
			$values['shipins'] = $shipin2;
			$values['tels'] = $tel2;
			$values['guahaos'] = $guahao2;
			$values['shoushus'] = $shoushu2;
			$values['baogaos'] =$baogao2;
			$values['tijians'] = $tijian2;
			$values['chufangs'] = $chufang2;
			$values['moneys'] = $money2;

			$values['tuwen'][] = $tuwen2;
			$values['shipin'][] = $shipin2;
			$values['tel'][] = $tel2;
			$values['guahao'][] = $guahao2;
			$values['shoushu'][] = $shoushu2;
			$values['baogao'][] =$baogao2;
			$values['tijian'][] = $tijian2;
			$values['chufang'][] = $chufang2;
			$values['money'][] = $money2;
			$value['zhuanjia'][] = $values;
			$values['time'] = $value['time'];

			
    	}
    }
    
    $time = array_column($date,'time');
	include $this->template("datum/expertstatistics");
}
// 收入统计
if($op == 'income')
{
	$start = empty($_GPC['start']) ? date("Y-m-d",time()) : $_GPC['start']; 
	 $end = empty($_GPC['end']) ? date("Y-m-d 23:59:59",time()) : $_GPC['end'];
	$where = " where uniacid=".$uniacid;
	$t_where = $vip_where = " where uniacid=".$uniacid;
	
	
    
    $type_arr1 = pdo_getall("hyb_yl_docser_speck",array("uniacid"=>$uniacid));
    $type_arr2 = array(
    	array('key_words'=>'tijian','titlme'=>'体检抽成'),
    	array('key_words'=>'goods','titlme'=>'商品抽成'),
    	array('key_words'=>'vip','titlme'=>'会员收入'),
    	array('key_words'=>'ziying','titlme'=>'平台自营收入'),
    	array('key_words'=>'server','titlme'=>'服务包总收入'),
    	array('key_words'=>'team','titlme'=>'团队签约抽成'),
    	array('key_words'=>'tixian','titlme'=>'提现抽成'),
    	array('key_words'=>'green','titlme'=>'绿通服务总抽成'),
    );
    $type_arrs = $type_arr = array_merge($type_arr1,$type_arr2);

    $ziying_goods = pdo_fetchall("select sname from ".tablename("hyb_yl_goodsarr")." where uniacid=".$uniacid." and jigou_two = '0'");
    $ziying = "";
    foreach($ziying_goods as &$goods)
    {
    	$ziying .= $goods['sname'].",";
    }
    $ziying = substr($ziying,0,strlen($ziying)-1);
    $count ='0.00';
    foreach($type_arr as &$value)
    {

    	if($value['key_words'] == 'vip')
    	{
    		$money = pdo_fetchcolumn("select sum(price) from ".tablename("hyb_yl_vip_log").$vip_where);
    		if(empty($money))
    		{
    			$money = '0.00';
    		}
    		$value['money'] = $money;
    	}else if($value['key_words'] == 'server')
    	{
    		$money = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_doc_all_serverlist").$where." and stateback=1");
    		
    		if(empty($money))
    		{
    			$money = '0.00';
    		}
    		$value['money'] = $money;
    		

    	}else if($value['key_words'] == 'tixian'){
    		$money = pdo_fetchcolumn("select sum(fee) from ".tablename("hyb_yl_pay").$where." and cash=1 and status=1");
    		
    		if(empty($money))
    		{
    			$money = '0.00';
    		}
    		$value['money'] = $money;
    	}else if($value['key_words'] == 'tijian' || $value['key_words'] == 'goods' || $value['key_words'] == '')
    	{

    		$money = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_pay").$where." and keyword='".$value['key_words']."' and style=8");
    		
    		if(empty($money))
    		{
    			$money = '0.00';
    		}
    		$value['money'] = $money;
    	}else if($value['key_words'] == 'team')
    	{
    		$money = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_teamorder").$t_where." and paytime!= '0'");
    		if(empty($money))
    		{
    			$money = '0.00';
    		}
    		$value['money'] = $money;
    	}else if($value['key_words'] == 'green')
    	{
    		$money = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_pay").$where." and (keyword='yuyuejiuzhen' or keyword='zhuyuananpai' or keyword='shoushuanpai' or keyword='baogaojiaji') and style=8");
    		if(empty($money))
    		{
    			$money = '0.00';
    		}
    		$value['money'] = $money;
    	}else{
    		$money = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_pay").$where." and keyword='".$value['key_words']."' and style=8");
    		
    		if(empty($money))
    		{
    			$money = '0.00';
    		}
    		$value['money'] = $money;
    	}
    	$count += $value['money'];
    }
    $days = ceil((strtotime($end)-strtotime($start))/86400);
    
    
    // 保存每天日期
    $date = array();
    $times = $_GPC['times'];
    
    for($i=0; $i<$days; $i++){
    	if($times == '')
    	{
    		$date[]['time'] = '全部';
    	}else{
    		$date[]['time'] = date('Y-m-d', strtotime($start)+(86400*$i));
    	}
        
    }
    
    foreach($type_arr as &$values)
    {  
    	foreach($date as &$value)
	    {
	    	
		    $starttime = strtotime($value['time'] . ' 00:00:00');
		    $endtime = strtotime($value['time'] . ' 23:59:59');
		    $where = " where uniacid=".$uniacid." and time>=".$starttime." and time <=".$endtime;
		    $vip_where = " where uniacid=".$uniacid." and created >=".$starttime." and created <=".$endtime;
		    $t_where = " where uniacid=".$uniacid." and created >=".$starttime." and created <=".$endtime;
		    
	    	if($values['key_words'] == 'vip')
	    	{
	    		$money = pdo_fetchcolumn("select sum(price) from ".tablename("hyb_yl_vip_log").$vip_where);
	    		if(empty($money))
	    		{
	    			$money = '0.00';
	    		}
	    		$value[$values['titlme']] = $money;
	    	}else if($values['key_words'] == 'server')
	    	{
	    		$money = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_doc_all_serverlist").$where." and stateback=1");
	    		
	    		if(empty($money))
	    		{
	    			$money = '0.00';
	    		}
	    		$value[$values['titlme']] = $money;
	    		

	    	}else if($values['key_words'] == 'tixian'){
	    		$money = pdo_fetchcolumn("select sum(fee) from ".tablename("hyb_yl_pay").$t_where." and cash=1 and status=1");
	    		
	    		if(empty($money))
	    		{
	    			$money = '0.00';
	    		}
	    		$value[$values['titlme']] = $money;
	    	}else if($values['key_words'] == 'tijian' || $values['key_words'] == 'goods' || $values['key_words'] == '')
	    	{

	    		$money = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_pay").$t_where." and keyword='".$value['key_words']."' and style=8");
	    		
	    		if(empty($money))
	    		{
	    			$money = '0.00';
	    		}
	    		$keys = $values['titlme'];
	    		$value[$keys] = $money;
	    	}else if($values['key_words'] == 'team')
	    	{
	    		$money = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_teamorder").$t_where." and paytime!= '0'");
	    		if(empty($money))
	    		{
	    			$money = '0.00';
	    		}
	    		$value[$values['titlme']] = $money;
	    	}else if($values['key_words'] == 'green')
	    	{
	    		$money = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_pay").$t_where." and (keyword='yuyuejiuzhen' or keyword='zhuyuananpai' or keyword='shoushuanpai' or keyword='baogaojiaji') and style=8");
	    		if(empty($money))
	    		{
	    			$money = '0.00';
	    		}
	    		$value[$values['titlme']] = $money;
	    	}else{
	    		$money = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_pay").$t_where." and keyword='".$values['key_words']."' and style=8");
	    		
	    		if(empty($money))
	    		{
	    			$money = '0.00';
	    		}
	    		$keys = $values['titlme'];
	    		$value[$keys] = $money;
	    	}
	    	$keys = $values['titlme'];
			$values['moneys'][] = $value[$keys];
			$values['time'] = $value['time'];
	    }
    }
    
    $time = array_column($date,'time');
	include $this->template("datum/income");
}
// 支出统计
if($op == 'pay')
{
	$starts = empty($_GPC['start']) ? date("Y-m-d",time()) : $_GPC['start']; 
	  $ends = empty($_GPC['end']) ? date("Y-m-d",time()) : $_GPC['end'];
	$start = strtotime($starts);
	$endss = $ends . ' 23:59:59';
	$end = strtotime($endss);
	$where = " where uniacid=".$uniacid;
	$times = $_GPC['times'];

	if($starts != '' && $end != '' && $times == '1')
	{
		$where .= " and created >=".$start." and created <=".$end;
	}
	

	$fx_tixian = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_pay").$where." and style=4 and status=1");
	if($fx_tixian == '')
	{
		$fx_tixian = '0.00';
	}
	$hos_tixian = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_pay").$where." and style=7 and status=1");
	if($hos_tixian == '')
	{
		$hos_tixian = '0.00';
	}
	$doc_tixian = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_pay").$where." and style=6 and status=1");
	if($doc_tixian == '')
	{
		$doc_tixian = '0.00';
	}
	$zj_tixian = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_pay").$where." and style=1 and status=1");
	if($zj_tixian == '')
	{
		$zj_tixian = '0.00';
	}
	$team_tixian = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_pay").$where." and style=2 and status=1");
	if($team_tixian == '')
	{
		$team_tixian = '0.00';
	}
	$dao_tixian = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_pay").$where." and style=0 and status=1");
	if($dao_tixian == '')
	{
		$dao_tixian = '0.00';
	}
	$count = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_pay").$where." and status=1");
	if($count == '')
	{
		$count = '0.00';
	}
	$days = ($end-$start)/86400;
    

    // 保存每天日期
    $date = array();
    
    for($i=0; $i<$days; $i++){
    	if($times == '')
    	{
    		$date[]['time'] = '全部';
    	}else{
    		$date[]['time'] = date('Y-m-d', $start+(86400*$i));
    	}
        
    }
    $list = array(
    	array('title' => '分销提现',),
    	array('title' => '机构提现',),
    	array('title' => '药师提现',),
    	array('title' => '专家提现',),
    	array('title' => '团队提现',),
    	array('title' => '导诊提现',),
    	array('title' => '总支出',),
    );
    foreach($list as &$values)
    {
    	foreach($date as &$value)
	    {
	    	
		    $starttime = strtotime($value['time'] . ' 00:00:00');
		    $endtime = strtotime($value['time'] . ' 23:59:59');
		    $wheres = " where uniacid=".$uniacid." and created >=".$starttime." and created <=".$endtime;
		    
	    	$fx_tixians = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_pay").$wheres." and style=4 and status=1");
	    	if($fx_tixians == '')
	    	{
	    		$fx_tixians = '0.00';
	    	}
	    	
	    	$value['fx_tixian'] = $fx_tixians;
	 
	    	$value['hos_tixian'] = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_pay").$wheres." and style=7 and status=1");
	    	if($value['hos_tixian'] == '')
	    	{
	    		$value['hos_tixian'] = '0.00';
	    	}
			$value['doc_tixian'] = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_pay").$wheres." and style=6 and status=1");
			if($value['doc_tixian'] == '')
	    	{
	    		$value['doc_tixian'] = '0.00';
	    	}
			$value['zj_tixian'] = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_pay").$wheres." and style=1 and status=1");
			if($value['zj_tixian'] == '')
	    	{
	    		$value['zj_tixian'] = '0.00';
	    	}
	    	
			$value['team_tixian'] = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_pay").$wheres." and style=2 and status=1");
			if($value['team_tixian'] == '')
	    	{
	    		$value['team_tixian'] = '0.00';
	    	}
			$value['dao_tixian'] = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_pay").$wheres." and style=0 and status=1");
			if($value['dao_tixian'] == '')
	    	{
	    		$value['dao_tixian'] = '0.00';
	    	}
			$value['count'] = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_pay").$wheres." and status=1");
			if($value['count'] == '')
	    	{
	    		$value['count'] = '0.00';
	    	}
			
			// $value['time'] = $value['time'];
			if($values['title'] == '分销提现')
			{
				$values['money'][] = $value['fx_tixian'];
			}else if($values['title'] == '机构提现')
			{
				$values['money'][] = $value['hos_tixian'];
			}else if($values['title'] == '药师提现')
			{
				$values['money'][] = $value['doc_tixian'];
			}else if($values['title'] == '专家提现')
			{
				$values['money'][] = $value['zj_tixian'];
			}else if($values['title'] == '团队提现')
			{
				$values['money'][] = $value['team_tixian'];
			}else if($values['title'] == '导诊提现')
			{
				$values['money'][] = $value['dao_tixian'];
			}else if($values['title'] == '总支出')
			{
				$values['money'][] = $value['count'];
			}
			
			$values['time'] = $value['time'];
	    }
    }
    $time = array_column($date,'time');

	include $this->template("datum/pay");
}

// 盈亏统计
if($op == 'profit')
{
	$starts = empty($_GPC['start']) ? date("Y-m-d",strtotime("-1 month")) : $_GPC['start']; 
	$ends = empty($_GPC['end']) ? date("Y-m-d",time()) : $_GPC['end'];
	$start = strtotime($starts);
	$endss = $ends . ' 23:59:59';
	$end = strtotime($endss);
	$where = " where uniacid=".$uniacid;
	$times = $_GPC['times'];
	$days = ceil(($end-$start)/86400);
    // 保存每天日期
    $date = array();
    $times = $_GPC['times'];
    for($i=0; $i<$days; $i++){
    	$date[]['time'] = date('Y-m-d', $start+(86400*$i));
    }
    foreach($date as $key => $value)
    {
    	$starttime = strtotime($value['time'] . ' 00:00:00');
		$endtime = strtotime($value['time'] . ' 23:59:59');
		$starttimes = $value['time'] . ' 00:00:00';
		$endtimes = $value['time'] . ' 23:59:59';

		$income1 = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_pay")." where uniacid=".$uniacid." and style=8 and cash=0 and created >=".$starttime." and created <=".$endtime);
		
		$income2 = pdo_fetchcolumn("select sum(fee) from ".tablename("hyb_yl_pay")." where uniacid=".$uniacid." and cash=1 and status=1 and created >=".$starttime." and created <=".$endtime);

		$vip_money = pdo_fetchcolumn("select sum(price) from ".tablename("hyb_yl_vip_log")." where uniacid=".$uniacid." and p_time >=".$starttime." and p_time <=".$endtime);
		$server_money = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_doc_all_serverlist")." where time >='".$starttimes."' and time <='".$endtimes."' and stateback=1");
		
		$date[$key]['income'] = $income1 + $income2 + $vip_money + $server_money;

		$pay = pdo_fetchcolumn("select sum(t_money) from ".tablename("hyb_yl_refund")." where uniacid=".$uniacid." and (status=1 or status=3) and created >=".$starttimes." and created <=".$endtimes);
		$tixian = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_pay")." where uniacid=".$uniacid." and cash=1 and status=1 and created >=".$starttime." and created <=".$endtime);

		if(empty($pay))
		{
			$pay = '0.00';
		}
		if(empty($tixian))
		{
			$tixian = '0.00';
		}
		$date[$key]['pay'] = $pay + $tixian;

		$date[$key]['profit'] = $date[$key]['income'] - $date[$key]['pay'];


		// 收入
    	$wenzhen = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and paytime>=".$starttime." and paytime <= ".$endtime." and ifpay!=0 and ifpay != 5 and ifpay != 7 and ifpay != 8 group by back_orser");
    	$wenzhen_income = array_sum(array_map(function($val){return $val['money'];}, $wenzhen));



    	$chufang = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and paytime>=".$starttime." and paytime <= ".$endtime." and ispay!=0 and ispay != 5 and ispay != 7 and ispay != 8 group by back_orser");
    	$chufang_income = array_sum(array_map(function($val){return $val['money'];}, $chufang));

    	$tuwen = pdo_fetchall("select money from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and paytime>=".$starttime." and paytime <= ".$endtime." and ifpay!=0 and ifpay != 5 and ifpay != 7 and ifpay != 8 group by back_orser");
    	$tuwen_income = array_sum(array_map(function($val){return $val['money'];}, $tuwen));
    	$goods_income = pdo_fetchcolumn("select sum(realTotalMoney) from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid." and createTime>='".$starttimes."' and createTime <=".$endtimes."' and orderStatus != -3 and orderStatus != -2 and orderStatus=-1");
    	$tijian_income = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and ifpay!=0 and ifpay != 6 and ifpay != 7 and paytime>=".$starttime." and paytime<=".$endtime);

    	$guahao = pdo_fetchall("select money from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid." and ifpay!=0 and ifpay != 6 and ifpay != 7 and paytime>=".$starttime." and paytime<=".$endtime);
    	$guahao_income = array_sum(array_map(function($val){return $val['money'];}, $guahao));

    	$guidance = pdo_fetchall("select money from ".tablename("hyb_yl_guidance_order")." where uniacid=".$uniacid." and ifpay!=0 and ifpay != 6 and ifpay != 7 and paytime>=".$starttime." and paytime<=".$endtime);
    	$guidance_income = array_sum(array_map(function($val){return $val['money'];}, $guidance));

    	$yearcard = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_user_yearcard")." where uniacid=".$uniacid." and status=1 and created >=".$starttime." and created <=".$endtime);

    	$date[$key]['incomes'] = $wenzhen_income + $chufang_income + $tuwen_income + $goods_income + $tijian_income + $guahao_income + $guidance_income + $yearcard;


    	// 支出统计
    	$wenzhen = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and paytime>=".$starttime." and paytime <= ".$endtime." ifpay = 7 group by back_orser");
    	$wenzhen_pay = array_sum(array_map(function($val){return $val['money'];}, $wenzhen));



    	$chufang = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and paytime>=".$starttime." and paytime <= ".$endtime." and ispay = 7 group by back_orser");
    	$chufang_pay = array_sum(array_map(function($val){return $val['money'];}, $chufang));

    	$tuwen = pdo_fetchall("select money from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and paytime>=".$starttime." and paytime <= ".$endtime." and ifpay = 7 group by back_orser");
    	$tuwen_pay = array_sum(array_map(function($val){return $val['money'];}, $tuwen));
    	
    	$tijian_pay = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." ifpay = 7 and paytime>=".$starttime." and paytime<=".$endtime);

    	$guahao = pdo_fetchall("select money from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid." and ifpay = 7 and paytime>=".$starttime." and paytime<=".$endtime);
    	$guahao_pay = array_sum(array_map(function($val){return $val['money'];}, $guahao));

    	$guidance = pdo_fetchall("select money from ".tablename("hyb_yl_guidance_order")." where uniacid=".$uniacid." ifpay = 7 and paytime>=".$starttime." and paytime<=".$endtime);
    	$guidance_pay = array_sum(array_map(function($val){return $val['money'];}, $guidance));
    	$date[$key]['pays'] = $wenzhen_pay + $chufang_pay + $tuwen_pay + $tijian_pay + $guahao_pay + $guidance_pay;
    }
    $time = array_column($date,'time');
    
    include $this->template("datum/profit");
}