<?php

global $_W,$_GPC;
$op = $_GPC['op'];
$_W['plugin'] ='ask';
$uniacid = $_W['uniacid'];
load()->func('tpl');
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
    $todayss = date("Y-m-d H:i:s",time());
    $todays = strtotime(date("Y-m-d",time()));;
    $yesterdays = mktime(0,0,0,date('m'),date('d')-1,date('Y'));
    $sevens = mktime(0,0,0,date('m'),date('d')-7,date('Y'));
    $monthse = mktime(0,0,0,date('m'),date('d')-30,date('Y'));
    $tw_where = " where uniacid=".$uniacid." and xdtime >=".$todays;
    if(is_agent == '1')
    {
      $tw_where .= " and zid in (".$zjs.")";
    }
    $today['tuwenorder'] = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder").$tw_where." group by back_orser");
    $today['tuwenorder'] = count($today['tuwenorder']);
    if(!$today['tuwenorder'])
    {
      $today['tuwenorder'] = '0';
    }
    $wz_where = " where uniacid=".$uniacid." and time>=".$todays;
    if(is_agent == '1')
    {
      $wz_where .= " and zid in (".$zjs.")";
    }
    $today['telorder'] = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder").$wz_where." and keywords ='dianhuajizhen' group by back_orser");
    $today['telorder'] = count($today['telorder']);
    if(!$today['telorder'])
    {
      $today['telorder'] = '0';
    }
    $sp_where = " where uniacid=".$uniacid." and time>=".$todays;
    if(is_agent == '1')
    {
      $sp_where .= " and zid in (".$zjs.")";
    }
    $today['sporder'] = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder").$sp_where." and keywords = 'shipinwenzhen' group by back_orser");
    $today['sporder'] = count($today['sporder']);
    if(!$today['sporder'])
    {
      $today['sporder'] = '0';
    }
    $cf_where = " where uniacid=".$uniacid."  and time>=".$todays;
    if(is_agent == '1')
    {
      $cf_where .= " and zid in (".$zjs.")";
    }
    $today['chufang_order'] = pdo_fetchall("select count(*) from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid."  and time>=".$todays." group by back_orser");
    $today['chufang_order'] = count($today['chufang_order']);
    if(!$today['chufang_order'])
    {
      $today['chufang_order'] = '0';
    }
    $jd_where = " where uniacid=".$uniacid." and keywords='tijianjiedu' and time>=".$todays;
    if(is_agent == '1')
    {
      $jd_where .= " and zid in (".$zjs.")";
    }
    $today['jiedu_order'] = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder").$jd_where." group by back_orser");
    $today['jiedu_order'] = count($today['jiedu_order']);
    if(!$today['jiedu_order'])
    {
      $today['jiedu_order'] = '0';
    }
    $ss_where = " where uniacid=".$uniacid." and keywords='shoushukuaiyue' and time >=".$todays;
    if(is_agent == '1')
    {
      $ss_where .= " and zid in (".$zjs.")";
    }
    $today['shoushu_order'] = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder").$ss_where." group by back_orser");
    $today['shoushu_order'] = count($today['shoushu_order']);
    if(!$today['shoushu_order'])
    {
      $today['shoushu_order'] = '0';
    }
    $today['order'] = $today['shoushu_order'] +  $today['jiedu_order'] + $today['chufang_order'] + $today['chufang_order'] + $today['sporder'] + $today['telorder'] + $today['tuwenorder'];
    $tw_where = " where uniacid=".$uniacid." and xdtime <=".$todays." and xdtime >=".$yesterdays;
    if(is_agent == '1')
    {
      $tw_where .= " and zid in (".$zjs.")";
    }
    $yesterday['tuwenorder'] = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder").$tw_where." group by back_orser");
    $yesterday['tuwenorder'] = count($yesterday['tuwenorder']);
    if(!$yesterday['tuwenorder'])
    {
      $yesterday['tuwenorder'] = '0';
    }
    $tel_where = " where uniacid=".$uniacid." and time<=".$todays." and time >=".$yesterdays;
    if(is_agent == '1')
    {
      $tel_where .= " and zid in (".$zjs.")";
    }
    $yesterday['telorder'] = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder").$tel_where." and keywords ='dianhuajizhen' group by back_orser");
    $yesterday['telorder'] = count($yesterday['telorder']);
    if(!$yesterday['telorder'])
    {
      $yesterday['telorder'] = '0';
    }
    $sp_where .= " where uniacid=".$uniacid." and time<=".$todays." and time >=".$yesterdays;
    if(is_agent == '1')
    {
      $sp_where .= " and zid in (".$zjs.")";
    }
    $yesterday['sporder'] = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder").$sp_where." and keywords = 'shipinwenzhen' group by back_orser");
    $yesterday['sporder'] = count($yesterday['sporder']);
    if(!$yesterday['sporder'])
    {
      $yesterday['sporder'] = '0';
    }
    $cf_where = " where uniacid=".$uniacid."  and time<=".$todays." and time >=".$yesterdays;
    if(is_agent == '1')
    {
      $cf_where .= " and zid in (".$zjs.")";
    }
    $yesterday['chufang_order'] = pdo_fetchall("select count(*) from ".tablename("hyb_yl_chufang").$cf_where." group by back_orser");
    $yesterday['chufang_order'] = count($yesterday['chufang_order']);
    if(!$yesterday['chufang_order'])
    {
      $yesterday['chufang_order'] = '0';
    }
    $jd_where = " where uniacid=".$uniacid." and keywords='tijianjiedu' and time<=".$todays." and time >=".$yesterdays;
    if(is_agent == '1')
    {
      $jd_where .= " and zid in (".$zjs.")";
    }
    $yesterday['jiedu_order'] = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder").$jd_where." group by back_orser");
    $yesterday['jiedu_order'] = count($yesterday['jiedu_order']);
    if(!$yesterday['jiedu_order'])
    {
      $yesterday['jiedu_order'] = '0';
    }
    $ss_where = " where uniacid=".$uniacid." and keywords='shoushukuaiyue' and time <=".$todays." and time >=".$yesterdays;
    if(is_agent == '1')
    {
      $ss_where .= " and zid in (".$zjs.")";
    }
    $yesterday['shoushu_order'] = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder").$ss_where." group by back_orser");
    $yesterday['shoushu_order'] = count($yesterday['shoushu_order']);
    if(!$yesterday['shoushu_order'])
    {
      $yesterday['shoushu_order'] = '0';
    }
    $yesterday['order'] = $yesterday['shoushu_order'] + $yesterday['jiedu_order'] + $yesterday['chufang_order'] + $yesterday['chufang_order'] + $yesterday['sporder'] + $yesterday['telorder'] + $yesterday['tuwenorder'];

    $tw_where = " where uniacid=".$uniacid." and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8";
    if(is_agent == '1')
    {
      $tw_where .= " and zid in (".$zjs.")";
    }
    $tw_jiezhen = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder").$tw_where." group by back_orser");

    $tw_jiezhen = count($tw_jiezhen);

    if(!$tw_jiezhen)
    {
      $tw_jiezhen = '0';
    }
    $wz_where = " where uniacid=".$uniacid." and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8";
    if(is_agent == '1')
    {
      $wz_where .= " and zid in (".$zjs.")";
    }
    $wz_jiezhen = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder").$wz_where." group by back_orser");
    $wz_jiezhen = count($wz_jiezhen);
    if(!$wz_jiezhen)
    {
      $wz_jiezhen = '0';
    }
    $jiezhen = $tw_jiezhen + $wz_jiezhen;
    $tw_where = " where uniacid=".$uniacid." and ifpay=0";
    if(is_agent == '1')
    {
      $tw_where .= " and zid in (".$zjs.")";
    }
    $tw_pay = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder").$tw_where." group by back_orser");
    $tw_pay = count($tw_pay);
    if(!$tw_pay)
    {
      $tw_pay = '0';
    }
    $wz_where = " where uniacid=".$uniacid." and ifpay=0";
    if(is_agent == '1')
    {
      $wz_where .= " and zid in (".$zjs.")";
    }
    $wz_pay = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder").$wz_where." group by back_orser");
    $wz_pay = count($wz_pay);
    if(!$wz_pay)
    {
      $wz_pay = '0';
    }
    $pay = $tw_pay + $wz_pay;
    $tw_where = " where uniacid=".$uniacid." and (ifpay=3 or ifpay=4 or ifpay=6 or ifpay=7)";
    if(is_agent == '1')
    {
      $tw_where .= " and zid in (".$zjs.")";
    }
    $tw_over = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder").$tw_where." group by back_orser");
    $tw_over = count($tw_over);
    if(!$tw_over)
    {
      $tw_over = '0';
    }
    $wz_where = " where uniacid=".$uniacid." and (ifpay=3 or ifpay=4 or ifpay=6 or ifpay=7)";
    if(is_agent == '1')
    {
      $wz_where .= " and zid in (".$zjs.")";
    }
    $wz_over = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder").$wz_where." group by back_orser");
    $wz_over = count($wz_over);
    if(!$wz_over)
    {
      $wz_over = '0';
    }
    $over = $tw_over + $wz_over;
    $tw_where = " where uniacid=".$uniacid." and ifgk=1";
    if(is_agent == '1')
    {
      $tw_where .= " and zid in (".$zjs.")";
    }
    $tw_gk = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder").$tw_where." group by back_orser");
    $tw_gk = count($tw_gk);
    if(!$tw_gk)
    {
      $tw_gk = '0';
    }
    $wz_where = " where uniacid=".$uniacid." and ifgk=1";
    if(is_agent == '1')
    {
      $wz_where .= " and zid in (".$zjs.")";
    }
    $wz_gk = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder").$wz_where." group by back_orser");
    $wz_gk = count($wz_gk);
    if(!$wz_gk)
    {
      $wz_gk = '0';
    }
    $gongkai = $tw_gk + $wz_gk;
    $tw_where = " where uniacid=".$uniacid." and ifgk=0";
    if(is_agent == '1')
    {
      $tw_where .= " and zid in (".$zjs.")";
    }
    $tw_bgk = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder").$tw_where." group by back_orser");
    $tw_bgk = count($tw_bgk);
    if(!$tw_bgk)
    {
      $tw_bgk = '0';
    }
    $wz_where = " where uniacid=".$uniacid." and ifgk=0";
    if(is_agent == '1')
    {
      $wz_where .= " and zid in (".$zjs.")";
    }
    $wz_bgk = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder").$wz_where." group by back_orser");
    $wz_bgk = count($wz_bgk);
    if(!$wz_bgk)
    {
      $wz_bgk = '0';
    }
    $bgongkai = $tw_bgk + $wz_bgk;
    $tw_where = " where uniacid=".$uniacid." and xdtime >=".$todays." and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8";
    if(is_agent == '1')
    {
      $tw_where .= " and zid in (".$zjs.")";
    }
    $tuwen_pay = pdo_fetchall("select money from ".tablename("hyb_yl_twenorder").$tw_where." group by back_orser");
    $tuwen_pay = array_sum(array_map(function($val){return $val['money'];}, $tuwen_pay));
    
    if(!$tuwen_pay)
    {
      $tuwen_pay = '0.00';
    }
    $wz_where = " where uniacid=".$uniacid." and xdtime >=".$todays." and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8";
    if(is_agent == '1')
    {
      $wz_where .= " and zid in (".$zjs.")";
    }
    $wenzhen_pay = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder").$wz_where." group by back_orser");
    $wenzhen_pay = array_sum(array_map(function($val){return $val['money'];}, $wenzhen_pay));
    if(!$wenzhen_pay)
    {
      $wenzhen_pay = '0.00';
    }
    $today['pay'] = $tuwen_pay + $wenzhen_pay;
    $tw_where = " where uniacid=".$uniacid." and xdtime >=".$yesterdays." and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8";
    if(is_agent == '1')
    {
      $tw_where .= " and zid in (".$zjs.")";
    }
    $tuwen_pay = pdo_fetchall("select money from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and xdtime >=".$yesterdays." and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8 group by back_orser");
    $tuwen_pay = array_sum(array_map(function($val){return $val['money'];}, $tuwen_pay));
    if(!$tuwen_pay)
    {
      $tuwen_pay = '0.00';
    }
    $wz_where = " where uniacid=".$uniacid." and xdtime >=".$yesterdays." and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8";
    if(is_agent == '1')
    {
      $wz_where .= " and zid in (".$zjs.")";
    }
    $wenzhen_pay = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder").$wz_where." group by back_orser");
    $wenzhen_pay = array_sum(array_map(function($val){return $val['money'];}, $wenzhen_pay));
    if(!$wenzhen_pay)
    {
      $wenzhen_pay = '0.00';
    }
    $yesterday['pay'] = $tuwen_pay + $wenzhen_pay;
    $tw_where = " where uniacid=".$uniacid." and xdtime >=".$sevens." and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8";
    if(is_agent == '1')
    {
      $tw_where .= " and zid in (".$zjs.")";
    }
    $tuwen_pay = pdo_fetchall("select money from ".tablename("hyb_yl_twenorder").$tw_where." group by back_orser");
    $tuwen_pay = array_sum(array_map(function($val){return $val['money'];}, $tuwen_pay));
    if(!$tuwen_pay)
    {
      $tuwen_pay = '0.00';
    }
    $wz_where = " where uniacid=".$uniacid." and xdtime >=".$sevens." and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8";
    if(is_agent == '1')
    {
      $wz_where .= " and zid in (".$zjs.")";
    }
    $wenzhen_pay = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder").$wz_where." group by back_orser");
    $wenzhen_pay = array_sum(array_map(function($val){return $val['money'];}, $wenzhen_pay));
    if(!$wenzhen_pay)
    {
      $wenzhen_pay = '0.00';
    }
    $seven['pay'] = $tuwen_pay + $wenzhen_pay;
    $tw_where = " where uniacid=".$uniacid." and xdtime >=".$monthse." and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8";
    if(is_agent == '1')
    {
      $tw_where .= " and zid in (".$zjs.")";
    }
    $tuwen_pay = pdo_fetchall("select money from ".tablename("hyb_yl_twenorder").$tw_where." group by back_orser");
    $tuwen_pay = array_sum(array_map(function($val){return $val['money'];}, $tuwen_pay));
    if(!$tuwen_pay)
    {
      $tuwen_pay = '0.00';
    }
    $wz_where = " where uniacid=".$uniacid." and xdtime >=".$monthse." and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8";
    if(is_agent == '1')
    {
      $wz_where .= " and zid in (".$zjs.")";
    }
    $wenzhen_pay = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder").$wz_where." group by back_orser");
    $wenzhen_pay = array_sum(array_map(function($val){return $val['money'];}, $wenzhen_pay));
    if(!$wenzhen_pay)
    {
      $wenzhen_pay = '0.00';
    }
    $monthss['pay'] = $tuwen_pay + $wenzhen_pay;

    $days = intval($_GPC['days']);

  if (empty($_GPC['search'])) {
    $days = 7;
  }

  $years = array();
  $current_year = date('Y');
  $year = $_GPC['year'];
  $i = $current_year - 10;

  while ($i <= $current_year) {
    $years[] = array('data' => $i, 'selected' => $i == $year);
    ++$i;
  }

  $months = array();
  $current_month = date('m');
  $month = $_GPC['month'];
  $i = 1;

  while ($i <= 12) {
    $months[] = array('data' => $i, 'selected' => $i == $month);
    ++$i;
  }

  $datas = array();
  $title = '';
  
  if (!empty($days)) {
    $charttitle = '最近' . $days . '天增长趋势图';
    $i = $days;

    while (0 <= $i) {
      $time = date('Y-m-d', strtotime('-' . $i . ' day'));
      $params = array(':uniacid' => $_W['uniacid'], ':starttime' => strtotime($time . ' 00:00:00'), ':endtime' => strtotime($time . ' 23:59:59'));
      $tw_where = " where uniacid=:uniacid and xdtime >=:starttime and xdtime<=:endtime and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8";
      if(is_agent == '1')
      {
        $tw_where .= " and zid in (".$zjs.")";
      }
      $tuwenorder = pdo_fetchall("select money from ".tablename("hyb_yl_twenorder").$tw_where." group by back_orser",$params);

      $tuwenorder = array_sum(array_map(function($val){return $val['money'];}, $tuwenorder));
      if(!$tuwenorder)
      {
        $tuwenorder = '0';
      }
      $tel_where = " where uniacid=:uniacid and keywords ='dianhuajizhen' and time >=:starttime and time<=:endtime and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8";
      if(is_agent == '1')
      {
        $tel_where .= " and zid in (".$zjs.")";
      }
      $telorder = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder").$tel_where." group by back_orser",$params);
      $telorder = array_sum(array_map(function($val){return $val['money'];}, $telorder));
      if(!$telorder)
      {
        $telorder = '0';
      }
      $sp_where = " where uniacid=:uniacid and keywords = 'shipinwenzhen'  and time >=:starttime and time<=:endtime and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8";
      if(is_agent == '1')
      {
        $sp_where .= " and zid in (".$zjs.")";
      }
      $sporder = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder").$sp_where." group by back_orser",$params);
      $sporder = array_sum(array_map(function($val){return $val['money'];}, $sporder));
      if(!$sporder)
      {
        $sporder = '0';
      }
      $cf_where = " where uniacid=:uniacid and time >=:starttime and time<=:endtime and ispay != 0 and ispay != 6 and ispay != 7 and ispay!=8";
      if(is_agent == '1')
      {
        $cf_where .= " and zid in (".$zjs.")";
      }
      $chufang_order = pdo_fetchall("select money from ".tablename("hyb_yl_chufang").$cf_where." group by back_orser",$params);
      $chufang_order = array_sum(array_map(function($val){return $val['money'];}, $chufang_order));
      if(!$chufang_order)
      {
        $chufang_order = '0';
      }
      $jd_where = " where uniacid=:uniacid and keywords='tijianjiedu' and time >=:starttime and time<=:endtime and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8";
      if(is_agent == '1')
      {
        $jd_where .= " and zid in (".$zjs.")";
      }
      $jiedu_order = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder").$jd_where." group by back_orser",$params);
      $jiedu_order = array_sum(array_map(function($val){return $val['money'];}, $jiedu_order));
      if(!$jiedu_order)
      {
        $jiedu_order = '0';
      }
      $ss_where = " where uniacid=:uniacid and keywords='shoushukuaiyue' and time >=:starttime and time<=:endtime and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8";
      if(is_agent == '1')
      {
        $ss_where .= " and zid in (".$zjs.")";
      }
      $shoushu_order = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder").$ss_where." group by back_orser",$params);
      $shoushu_order = array_sum(array_map(function($val){return $val['money'];}, $shoushu_order));
      if(!$shoushu_order)
      {
        $shoushu_order = '0';
      }
      $datas[] = array(
        'date' => $time,
        'tuwenorder' => $tuwenorder,
        'telorder' => $telorder,
        'sporder' => $sporder,
        'chufang_order' => $chufang_order,
        'jiedu_order' => $jiedu_order,
        'shoushu_order' => $shoushu_order,
        );
      --$i;
    }

  }
  else {
    if (!empty($year) && !empty($month)) {
      $charttitle = $year . '年' . $month . '月增长趋势图';
      // $lastday = $this->get_last_day($year, $month);
      switch ($month) {
            case 4 :
              $days = 30;
                break;
            case 6 :
              $days = 30;
                break;
            case 9 :
              $days = 30;
                break;
            case 11 :
                $days = 30;
                break;
            case 2 :
                if ($year % 4 == 0) {
                    if ($year % 100 == 0) {
                        $days = $year % 400 == 0 ? 29 : 28;
                    } else {
                        $days = 29;
                    }
                } else {
                    $days = 28;
                }
                break;
            default :
                $days = 31;
                break;
        }
        $lastday = $days;
      $d = 1;
      
      while ($d <= $lastday) {
        
        $params = array(':uniacid' => $_W['uniacid'], ':starttime' => strtotime($year . '-' . $month . '-' . $d . ' 00:00:00'), ':endtime' => strtotime($year . '-' . $month . '-' . $d . ' 23:59:59'));
        $tw_where = " where uniacid=:uniacid and xdtime >=:starttime and xdtime<=:endtime and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8";
        if(is_agent == '1')
        {
          $tw_where .= " and zid in (".$zjs.")";
        }
        $tuwenorder = pdo_fetchall("select money from ".tablename("hyb_yl_twenorder").$tw_where." group by back_orser",$params);

        $tuwenorder = array_sum(array_map(function($val){return $val['money'];}, $tuwenorder));
        if(!$tuwenorder)
        {
          $tuwenorder = '0';
        }
        $tel_where = " where uniacid=:uniacid and keywords ='dianhuajizhen' and time >=:starttime and time<=:endtime and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8";
        if(is_agent == '1')
        {
          $tel_where .= " and zid in (".$zjs.")";
        }
        $telorder = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder").$tel_where." group by back_orser",$params);
        $telorder = array_sum(array_map(function($val){return $val['money'];}, $telorder));
        if(!$telorder)
        {
          $telorder = '0';
        }
        $sp_where = " where uniacid=:uniacid and keywords = 'shipinwenzhen'  and time >=:starttime and time<=:endtime and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8";
        if(is_agent == '1')
        {
          $sp_where .= " and zid in (".$zjs.")";
        }
        $sporder = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder").$sp_where." group by back_orser",$params);
        $sporder = array_sum(array_map(function($val){return $val['money'];}, $sporder));
        if(!$sporder)
        {
          $sporder = '0';
        }
        $cf_where = " where uniacid=:uniacid and time >=:starttime and time<=:endtime and ispay != 0 and ispay != 6 and ispay != 7 and ispay!=8";
        if(is_agent == '1')
        {
          $cf_where .= " and zid in (".$zjs.")";
        }
        $chufang_order = pdo_fetchall("select money from ".tablename("hyb_yl_chufang").$cf_where." group by back_orser",$params);
        $chufang_order = array_sum(array_map(function($val){return $val['money'];}, $chufang_order));
        if(!$chufang_order)
        {
          $chufang_order = '0';
        }
        $jd_where = " where uniacid=:uniacid and keywords='tijianjiedu' and time >=:starttime and time<=:endtime and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8";
        if(is_agent == '1')
        {
          $jd_where .= " and zid in (".$zjs.")";
        }
        $jiedu_order = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder").$jd_where." group by back_orser",$params);
        $jiedu_order = array_sum(array_map(function($val){return $val['money'];}, $jiedu_order));
        if(!$jiedu_order)
        {
          $jiedu_order = '0';
        }
        $ss_where = " where uniacid=:uniacid and keywords='shoushukuaiyue' and time >=:starttime and time<=:endtime and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8";
        if(is_agent == '1')
        {
          $ss_where .= " and zid in (".$zjs.")";
        }
        $shoushu_order = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder").$ss_where." group by back_orser",$params);
        $shoushu_order = array_sum(array_map(function($val){return $val['money'];}, $shoushu_order));
        if(!$shoushu_order)
        {
          $shoushu_order = '0';
        }
        $datas[] = array(
          'date' => $d . '日', 
          'tuwenorder' => $tuwenorder,
          'telorder' => $telorder,
          'sporder' => $sporder,
          'chufang_order' => $chufang_order,
          'jiedu_order' => $jiedu_order,
          'shoushu_order' => $shoushu_order,
        );
        ++$d;
      }

      
    }
    else {
      if (!empty($year)) {
        $charttitle = $year . '年增长趋势图';

        foreach ($months as $m) {
          switch ($m['data']) {
                case 4 :
                  $days = 30;
                    break;
                case 6 :
                  $days = 30;
                    break;
                case 9 :
                  $days = 30;
                    break;
                case 11 :
                    $days = 30;
                    break;
                case 2 :
                    if ($year % 4 == 0) {
                        if ($year % 100 == 0) {
                            $days = $year % 400 == 0 ? 29 : 28;
                        } else {
                            $days = 29;
                        }
                    } else {
                        $days = 28;
                    }
                    break;
                default :
                    $days = 31;
                    break;
            }
            $lastday = $days;
          $params = array(':uniacid' => $_W['uniacid'], ':starttime' => strtotime($year . '-' . $m['data'] . '-01 00:00:00'), ':endtime' => strtotime($year . '-' . $m['data'] . '-' . $lastday . ' 23:59:59'));
          
          $tw_where = " where uniacid=:uniacid and xdtime >=:starttime and xdtime<=:endtime and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8";
          if(is_agent == '1')
          {
            $tw_where .= " and zid in (".$zjs.")";
          }
          $tuwenorder = pdo_fetchall("select money from ".tablename("hyb_yl_twenorder").$tw_where." group by back_orser",$params);

          $tuwenorder = array_sum(array_map(function($val){return $val['money'];}, $tuwenorder));
          if(!$tuwenorder)
          {
            $tuwenorder = '0';
          }
          $tel_where = " where uniacid=:uniacid and keywords ='dianhuajizhen' and time >=:starttime and time<=:endtime and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8";
          if(is_agent == '1')
          {
            $tel_where .= " and zid in (".$zjs.")";
          }
          $telorder = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder").$tel_where." group by back_orser",$params);
          $telorder = array_sum(array_map(function($val){return $val['money'];}, $telorder));
          if(!$telorder)
          {
            $telorder = '0';
          }
          $sp_where = " where uniacid=:uniacid and keywords = 'shipinwenzhen'  and time >=:starttime and time<=:endtime and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8";
          if(is_agent == '1')
          {
            $sp_where .= " and zid in (".$zjs.")";
          }
          $sporder = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder").$sp_where." group by back_orser",$params);
          $sporder = array_sum(array_map(function($val){return $val['money'];}, $sporder));
          if(!$sporder)
          {
            $sporder = '0';
          }
          $cf_where = " where uniacid=:uniacid and time >=:starttime and time<=:endtime and ispay != 0 and ispay != 6 and ispay != 7 and ispay!=8";
          if(is_agent == '1')
          {
            $cf_where .= " and zid in (".$zjs.")";
          }
          $chufang_order = pdo_fetchall("select money from ".tablename("hyb_yl_chufang").$cf_where." group by back_orser",$params);
          $chufang_order = array_sum(array_map(function($val){return $val['money'];}, $chufang_order));
          if(!$chufang_order)
          {
            $chufang_order = '0';
          }
          $jd_where = " where uniacid=:uniacid and keywords='tijianjiedu' and time >=:starttime and time<=:endtime and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8";
          if(is_agent == '1')
          {
            $jd_where .= " and zid in (".$zjs.")";
          }
          $jiedu_order = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder").$jd_where." group by back_orser",$params);
          $jiedu_order = array_sum(array_map(function($val){return $val['money'];}, $jiedu_order));
          if(!$jiedu_order)
          {
            $jiedu_order = '0';
          }
          $ss_where = " where uniacid=:uniacid and keywords='shoushukuaiyue' and time >=:starttime and time<=:endtime and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8";
          if(is_agent == '1')
          {
            $ss_where .= " and zid in (".$zjs.")";
          }
          $shoushu_order = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder").$ss_where." group by back_orser",$params);
          $shoushu_order = array_sum(array_map(function($val){return $val['money'];}, $shoushu_order));
          if(!$shoushu_order)
          {
            $shoushu_order = '0';
          }
          $datas[] = array(
            'date' => $m['data'] . '月',
            'tuwenorder' => $tuwenorder,
            'telorder' => $telorder,
            'sporder' => $sporder,
            'chufang_order' => $chufang_order,
            'jiedu_order' => $jiedu_order,
            'shoushu_order' => $shoushu_order,
          );
        }
      }
    }
  }
	include $this->template("ask/index");
}
if($op == 'add')
{
	include $this->template("ask/add");
}
//图文问诊订单
if($op == 'asklist')
{
    $keywordtype = $_GPC['keywordtype'];
    $keyword  = $_GPC['keyword'];
    $timetype = $_GPC['timetype'];

    $ifpay = $_GPC['ifpay'];

    $pay_type = $_GPC['pay_type'];
    $where = "where a.uniacid = '{$uniacid}' and a.role=0 and a.grade=1 and a.overtime != '0'";
    if($keywordtype=='1'){
    //订单号
        $where .=" ";
    }
    if($keywordtype=='2'){
    //用户姓名
        $where .=" and c.names ='{$keyword}'";
    }
    if($keywordtype=='4'){
    //接诊医生
        $where .=" and d.z_name ='{$keyword}'";
    }
    if($keywordtype=='5'){
    //用户电话
        $where .=" and b.tel ='{$keyword}'";
    }
    if($ifpay !== '-1')
    {
      $where .= " and a.ifpay=".$ifpay;

    }
    if($start != '' && $start != date("Y-m-d",strtotime("-1Months",time())) && $end != '' && $end != date("Y-m-d",strtotime("+1days",time())) && $timetype =='1')
    {
      $where .= " and a.xdtime>=".strtotime($start)." and a.xdtime<=".strtotime($end);
    }else if($start != '' && $start != date("Y-m-d",strtotime("-1Months",time())) && $end != '' && $end != date("Y-m-d",strtotime("+1days",time())) && $timetype =='2')
    {
      $where .= " and a.paytime>=".strtotime($start)." and a.paytime<=".strtotime($end);
    }
    if(is_agent == '1')
    {
      $where .= " and a.zid in (".$zjs.")";
    }
    $page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
    if($_W['ispost']){
           $res = pdo_fetchall("SELECT a.*,b.names,b.sex,b.age,b.tel,c.u_thumb,c.randnum,c.u_name,d.z_name,d.advertisement,d.advertisement,d.hid,d.z_room,d.z_zhicheng,d.parentid FROM".tablename('hyb_yl_twenorder')."as a left join".tablename('hyb_yl_userjiaren')."as b on b.j_id =a.j_id left join".tablename('hyb_yl_userinfo')."as c on c.openid=a.openid left join".tablename('hyb_yl_zhuanjia')."as d on d.zid=a.zid ".$where." group by back_orser order by a.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
          
    }else{
          $res = pdo_fetchall("SELECT a.*,b.names,b.sex,b.age,b.tel,c.u_thumb,c.randnum,c.u_name,d.z_name,d.advertisement,d.advertisement,d.hid,d.z_room,d.z_zhicheng,d.parentid FROM".tablename('hyb_yl_twenorder')."as a left join".tablename('hyb_yl_userjiaren')."as b on b.j_id =a.j_id left join".tablename('hyb_yl_userinfo')."as c on c.openid=a.openid left join".tablename('hyb_yl_zhuanjia')."as d on d.zid=a.zid ".$where." group by back_orser order by a.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);

    }
    $total = pdo_fetchall("SELECT count(*) FROM".tablename('hyb_yl_twenorder')."as a left join".tablename('hyb_yl_userjiaren')."as b on b.j_id =a.j_id left join".tablename('hyb_yl_userinfo')."as c on c.openid=a.openid left join".tablename('hyb_yl_zhuanjia')."as d on d.zid=a.zid ".$where." group by back_orser");
    $total = count($total);
    $pager = pagination($total, $pageindex, $pagesize);
    $where1 = " where uniacid='{$uniacid}' and role=0";
    $where2 = " where uniacid='{$uniacid}'";
    if(is_agent == '1')
    {
      $where1 .= " and zid in (".$zjs.")";
      $where2 .= " and zid in (".$zjs.")";
    }
    $person = pdo_fetchall("select * from ".tablename("hyb_yl_twenorder").$where1." group by openid");
    $person_count = count($person);
    //查询问诊人数和总金额
    $count_person = count($res);
    $count_money_order = pdo_fetchall("SELECT money FROM ".tablename('hyb_yl_twenorder').$where2." group by back_orser");
    $count_money_order = array_sum(array_map(function($val){return $val['money'];}, $count_money_order));
    if(!$count_money_order)
    {
      $count_money_order = '0';
    }
    foreach ($res as $key => $value) {

    	$back_orser = $value['orders'];

    	$res[$key]['content'] =unserialize($res[$key]['content']);
    	$res[$key]['countarr'] = pdo_fetchcolumn('SELECT count(*) FROM ' .tablename("hyb_yl_twenorder")."  where uniacid='{$uniacid}' and back_orser='{$back_orser}' and role=0");
      $server = pdo_get("hyb_yl_doc_all_serverlist",array("uniacid"=>$uniacid,"key_words"=>'tuwenwenzhen','zid'=>$res[$key]['zid']));
      
      $res[$key]['ptmoneys'] = $res[$key]['old_money'];
      $res[$key]['hymoney'] = $server['hymoney'];
    	$count = intval($res[$key]['countarr']);
      $count_money =(float)($res[$key]['money']);
    	$res[$key]['count_money'] = ($count*$count_money);

      $res[$key]['xdtime'] =date("Y-m-d H:i:s",$res[$key]['xdtime']);
      $res[$key]['paytime'] =date("Y-m-d H:i:s",$res[$key]['paytime']);
      $res[$key]['advertisement'] =tomedia($res[$key]['advertisement']);
      $hid = $value['hid'];
      $z_zhicheng =$value['z_zhicheng']; 
      $parentid = $value['parentid'];

      $res[$key]['moneyss'] = $res[$key]['ptmoneys'] - $res[$key]['ptmoney'] - $res[$key]['hosmoney'] - $res[$key]['tk_one'] - $res[$key]['tk_two'] - $res[$key]['coupon_dk'] - $res[$key]['card_dk'] - $res[$key]['year_dk'];

      $res[$key]['host'] = pdo_fetch("SELECT agentname FROM".tablename('hyb_yl_hospital')."where hid='{$hid}'");
      $res[$key]['keshi'] = pdo_fetch("SELECT name FROM".tablename('hyb_yl_ceshi')."where id='{$parentid}'");
      $res[$key]['job'] = pdo_fetch("SELECT job_name FROM".tablename('hyb_yl_zhuanjia_job')."where id='{$z_zhicheng}'");     
    }



	include $this->template("ask/asklist");
}
//图文订单详情
if($op == 'askdetails')
{
    $id = $_GPC['id'];
    $hid = $_GPC['hid'];
    $res = pdo_fetch("SELECT a.money as amoney,a.*,b.money as bmoney,b.*,c.* FROM".tablename('hyb_yl_twenorder')."as a left join".tablename('hyb_yl_userinfo')."as b on b.openid=a.openid left join".tablename('hyb_yl_userjiaren')."as c on c.j_id=a.j_id and c.openid=b.openid where a.uniacid = '{$uniacid}' and a.id ='{$id}' ");
    //查询预约专家详情
    $zid = $res['zid'];
    $res['content'] = unserialize($res['content']);
    $docinfo = pdo_fetch("SELECT a.*,b.agentname,c.name,d.job_name,e.ctname FROM".tablename('hyb_yl_zhuanjia')."as a left join".tablename('hyb_yl_hospital')."as b on a.hid=b.hid left join ".tablename('hyb_yl_ceshi')."as c on c.id =a.parentid left join".tablename('hyb_yl_zhuanjia_job')."as d on d.id=a.z_zhicheng left join".tablename('hyb_yl_classgory')."as e on e.id=c.giftstatus where a.zid='{$zid}'");
    $back_orser = $res['back_orser'];
    // $res['tkmoney'] = pdo_fetchcolumn("SELECT SUM(money) FROM".tablename('hyb_yl_tuikeshouyi')."where uniacid='{$uniacid}' and orders='{$back_orser}'");
    // $res['tkmoney'] = pdo_fetchcolumn("select money from ".tablename("hyb_yl_pay")." where uniacid=".$uniacid." and style=8 and back_orser=".$back_orser);
    $docinfo['advertisement'] = tomedia($docinfo['advertisement']);
    $res['time'] =date("Y-m-d H:i:s",$res['xdtime'] );
    $res['paytime'] =date("Y-m-d H:i:s",$res['paytime'] );
    $res['ptmoneys'] = $res['old_money'];
    
    $res['tk'] = pdo_fetchcolumn("select b.username from ".tablename("hyb_yl_tuikesite")." as a  left join ".tablename("hyb_yl_tuikesite")." as b on b.tkid=a.id where a.uniacid=".$uniacid." and a.openid='".$res['openid']."'");
    $res['moneyss'] = $res['ptmoneys'] - $res['ptmoney'] - $res['hosmoney'] - $res['tk_one'] - $res['tk_two'] - $res['coupon_dk'] - $res['card_dk'] - $res['year_dk'];
      $server_key = "tuwenwenzhen";
      $docinfo['plugin'] = unserialize($docinfo['plugin']);
      $result2 = [];
      array_map(function ($value) use (&$result2) {
        $result2 = array_merge($result2, array_values($value));
      }
      , $docinfo['plugin']);
      $docinfo['plugin'] =$result2;
      $docinfo['advertisement'] =tomedia($docinfo['advertisement']);

      foreach ($result2 as $k => $v) {
        if($server_key == $v['key_words']) {
          $docinfo['money'] = $v['ptmoney'];
        }
      }
      
	include $this->template("ask/askdetails");
}

//电话问诊
if($op == 'telask')
{

    $keywordtype = $_GPC['keywordtype'];
    $keyword = $_GPC['keyword'];
    $ifpay = $_GPC['ifpay'];
    $pay_type = $_GPC['pay_type'];
    $timetype = $_GPC['timetype'];
    $page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
    $start = empty($_GPC['start']) ? date("Y-m-d",strtotime("-1Months",time())) : $_GPC['start']; 
    $end = empty($_GPC['end']) ? date("Y-m-d",strtotime("+1days",time())) : $_GPC['end'];
    $where = " where a.uniacid = '{$uniacid}' and a.pid=0 and a.type=1 and a.keywords ='dianhuajizhen' and a.overtime != '0'";
    if($keywordtype == '1')
    {
      $where .= " and a.orders like '%$keyword%'";
    }else if($keywordtype == '2')
    {
      $where .= " and c.u_name like '%$keyword%'";
    }else if($keywordtype == '3')
    {
      $where .= " and d.z_name like '%$keyword%'";
    }else if($keywordtype == '4')
    {
      $where .= " and a.tell like '%$keyword%'";
    }
    if(is_agent == '1')
    {
      $where .= " and a.zid in (".$zjs.")";
    }
    if($ifpay != '')
    {
      $where .= " and a.ifpay=".$ifpay;
    }
    if($pay_type != '')
    {
      $where .= " and a.pay_type=".$pay_type;
    }
    if($start != '' && $start != date("Y-m-d",strtotime("-1Months",time())) && $end != '' && $end != date("Y-m-d",strtotime("+1days",time())) && $timetype =='1')
    {
      $where .= " and a.time>=".strtotime($start)." and a.time<=".strtotime($end);
    }else if($start != '' && $start != date("Y-m-d",strtotime("-1Months",time())) && $end != '' && $end != date("Y-m-d",strtotime("+1days",time())) && $timetype =='2')
    {
      $where .= " and a.paytime>=".strtotime($start)." and a.paytime<=".strtotime($end);
    }
    if($_W['ispost']){

    $res = pdo_fetchall("SELECT a.*,b.names,b.sex,b.age,b.tel,c.u_thumb,c.randnum,c.u_name,d.z_name,d.advertisement,d.hid,d.z_room,d.z_zhicheng,d.parentid FROM".tablename('hyb_yl_wenzorder')."as a left join".tablename('hyb_yl_userjiaren')."as b on b.j_id =a.j_id left join".tablename('hyb_yl_userinfo')."as c on c.openid=a.openid left join".tablename('hyb_yl_zhuanjia')."as d on d.zid=a.zid".$where." and a.role=0 and a.type=1 and a.keywords='dianhuajizhen' group by a.back_orser order by a.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
    }else{
     $res = pdo_fetchall("SELECT a.*,b.names,b.sex,b.age,b.tel,c.u_thumb,c.randnum,c.u_name,d.z_name,d.advertisement,d.hid,d.z_room,d.z_zhicheng,d.parentid FROM".tablename('hyb_yl_wenzorder')."as a left join".tablename('hyb_yl_userjiaren')."as b on b.j_id =a.j_id left join".tablename('hyb_yl_userinfo')."as c on c.openid=a.openid left join".tablename('hyb_yl_zhuanjia')."as d on d.zid=a.zid".$where." and a.role=0 and a.type=1 and a.keywords='dianhuajizhen' group by a.back_orser order by a.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);

    }
    $wheres = " where uniacid='{$uniacid}' and role=0 and keywords='dianhuajizhen'";
    $where1 = " where uniacid='{$uniacid}' and keywords='dianhuajizhen' and type=1";
    if(is_agent == '1')
    {
      $wheres .= " and zid in (".$zjs.")";
      $where1 .= " and zid in (".$zjs.")";
    }
    $person = pdo_fetchall("select * from ".tablename("hyb_yl_wenzorder").$wheres." group by openid");

    $count_person = count($person);

    $count_money_or = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder").$wheres." group by back_orser");
    $count_money_or = array_sum(array_map(function($val){return $val['money'];}, $count_money_or));
    if(!$count_money_or)
    {
      $count_money_or = '0';
    }
    foreach ($res as $key => $value) {

      $back_orser = $value['orders'];

      // $res[$key]['tkmoney'] = pdo_fetchcolumn("SELECT SUM(money) FROM".tablename('hyb_yl_tuikeshouyi')."where uniacid='{$uniacid}' and orders='{$back_orser}'");
      // $res[$key]['ptmoney'] = pdo_fetchcolumn("select money from ".tablename("hyb_yl_pay")." where uniacid=".$uniacid." and style=8 and back_orser=".$back_orser);
      // $res[$key]['hosmoney'] = pdo_fetchcolumn("select money from ".tablename("hyb_yl_pay")." where uniacid=".$uniacid." and style=7 and back_orser=".$back_orser);
      if($res[$key]['ifpay'] =='0'){
         $res[$key]['zhuangtai'] ="待支付";
      }
      if($res[$key]['ifpay'] =='1'){
         $res[$key]['zhuangtai'] ="已支付待接诊";
      }
      if($res[$key]['ifpay'] =='2'){
         $res[$key]['zhuangtai'] ="已接诊";
      }
      if($res[$key]['ifpay'] =='3'){
         $res[$key]['zhuangtai'] ="已完成待评价";
      }
      if($res[$key]['ifpay'] =='4'){
         $res[$key]['zhuangtai'] ="已评价";
      }
      if($res[$key]['ifpay'] =='5' && $res[$key]['money'] !=0){
         $res[$key]['zhuangtai'] ="退款中";
      }
      if($res[$key]['ifpay'] =='6' ){
         $res[$key]['zhuangtai'] ="已退款";
      }
      $hid = $value['hid'];
      $z_zhicheng =$value['z_zhicheng']; 
      $z_room = $value['parentid'];
      $back_orser = $value['orders'];
      $res[$key]['content'] =unserialize($res[$key]['content']);
      $res[$key]['count'] =pdo_fetchcolumn('SELECT COUNT(*) FROM ' .tablename("hyb_yl_wenzorder")."  where uniacid='{$uniacid}' and back_orser='{$back_orser}' and money!=0 and keywords ='dianhuajizhen' ");
      $server = pdo_get("hyb_yl_doc_all_serverlist",array("uniacid"=>$uniacid,"key_words"=>'dianhuajizhen','zid'=>$res[$key]['zid']));

      $res[$key]['ptmoneys'] = $res[$key]['old_money'];
      $res[$key]['hymoney'] = $server['hymoney'];

      $res[$key]['countarr'] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' .tablename("hyb_yl_wenzorder")."  where uniacid='{$uniacid}' and back_orser='{$back_orser}' and role=0 and keywords ='dianhuajizhen' ");
      $count = intval($res[$key]['count']);
      $count_money =(float)($res[$key]['money']);
      $res[$key]['count_money'] = ($count*$count_money);
      $res[$key]['time'] =date("Y-m-d H:i:s",$res[$key]['time']);
      $res[$key]['paytime'] =date("Y-m-d H:i:s",$res[$key]['paytime']);
      $res[$key]['advertisement'] =tomedia($res[$key]['advertisement']);
      $res[$key]['host'] = pdo_fetch("SELECT agentname FROM".tablename('hyb_yl_hospital')."where hid='{$hid}'");
      $res[$key]['keshi'] = pdo_fetch("SELECT name FROM".tablename('hyb_yl_ceshi')."where id='{$z_room}'");
      $res[$key]['job'] = pdo_fetch("SELECT job_name FROM".tablename('hyb_yl_zhuanjia_job')."where id='{$z_zhicheng}'");

      $res[$key]['moneyss'] = $res[$key]['ptmoneys'] - $res[$key]['ptmoney'] - $res[$key]['hosmoney'] - $res[$key]['tk_one'] - $res[$key]['tk_two'] - $res[$key]['coupon_dk'] - $res[$key]['card_dk'] - $res[$key]['year_dk'];
      
    }

    if($money == NULL)
    {
      $money = '0.00';
    }
    $total = pdo_fetchall("SELECT count(*) FROM".tablename('hyb_yl_wenzorder')."as a left join".tablename('hyb_yl_userjiaren')."as b on b.j_id =a.j_id left join".tablename('hyb_yl_userinfo')."as c on c.openid=a.openid left join".tablename('hyb_yl_zhuanjia')."as d on d.zid=a.zid".$where." and a.role=0 and a.type=1 and a.keywords='dianhuajizhen' group by a.back_orser");
    $total = count($total);
    $count_order = $total;
    $pager = pagination($total, $pageindex, $pagesize);
    

	include $this->template("ask/telask");
}
//电话问诊详情
if($op == 'telaskdetails')
{
    $id = $_GPC['id'];
    $hid = $_GPC['hid'];
    $res = pdo_fetch("SELECT a.money as amoney,a.*,b.money as bmoney,b.*,c.names,c.sex,c.datetime,c.age,c.region FROM".tablename('hyb_yl_wenzorder')."as a left join".tablename('hyb_yl_userinfo')."as b on b.openid=a.openid left join".tablename('hyb_yl_userjiaren')."as c on c.j_id=a.j_id and c.openid=b.openid where a.uniacid = '{$uniacid}' and a.id ='{$id}' and a.keywords='dianhuajizhen' ");

    //查询预约专家详情
    $zid = $res['zid'];
    $res['content'] = unserialize($res['describe']);
    $docinfo = pdo_fetch("SELECT a.*,b.agentname,c.name,d.job_name,e.ctname FROM".tablename('hyb_yl_zhuanjia')."as a left join".tablename('hyb_yl_hospital')."as b on a.hid=b.hid left join ".tablename('hyb_yl_ceshi')."as c on c.id =a.parentid left join".tablename('hyb_yl_zhuanjia_job')."as d on d.id=a.z_zhicheng left join".tablename('hyb_yl_classgory')."as e on e.id=c.giftstatus where a.zid='{$zid}'");
    $res['tk'] = pdo_fetchcolumn("select b.username from ".tablename("hyb_yl_tuikesite")." as a  left join ".tablename("hyb_yl_tuikesite")." as b on b.tkid=a.id where a.uniacid=".$uniacid." and a.openid='".$res['openid']."'");
    $res['ptmoneys'] = $res['old_money'];
    

    $res['moneyss'] = $res['ptmoneys'] - $res['ptmoney'] - $res['hosmoney'] - $res['tk_one'] - $res['tk_two'] - $res['coupon_dk'] - $res['card_dk'] - $res['year_dk'];
    $docinfo['advertisement'] = tomedia($docinfo['advertisement']);
         $res['time'] =date("Y-m-d H:i:s",$res['time'] );
         $res['paytime'] =date("Y-m-d H:i:s",$res['paytime'] );

      $server_key = "dianhuajizhen";
      $docinfo['plugin'] = unserialize($docinfo['plugin']);
      $result2 = [];
      array_map(function ($value) use (&$result2) {
        $result2 = array_merge($result2, array_values($value));
      }
      , $docinfo['plugin']);
      $docinfo['plugin'] =$result2;
      $docinfo['advertisement'] =tomedia($docinfo['advertisement']);

      foreach ($result2 as $k => $v) {
        if($server_key == $v['key_words']) {
          $docinfo['money'] = $v['ptmoney'];
        }
      }
	include $this->template("ask/telaskdetails");
}
if($op == 'telaskdel')
{
  $id = $_GPC['id'];
  $hid = $_GPC['hid'];
  $back_orser = $_GPC['back_orser'];
  $res = pdo_delete("hyb_yl_wenzorder",array("id"=>$id));
  pdo_delete('hyb_yl_answer',array('orders'=>$back_orser));
  if($res)
  {
    message("删除成功!",$this->createWebUrl("ask",array("op"=>"telask",'ac'=>'telask','hid'=>$_SESSION['hid'])),"success");
  }else{
    message("删除失败!",$this->createWebUrl("ask",array("op"=>"telask",'ac'=>'telask','hid'=>$hid)),"error");

  }

}
if($op == 'askdel')
{
  $id = $_GPC['id'];
  $hid = $_GPC['hid'];
  $res = pdo_delete("hyb_yl_answer",array("id"=>$id));
  $data = array(
     'status'=>$res
    );
  echo json_encode($data);
  return false;

}
//开方问诊
if($op == 'squareask')
{
    $keywordtype = $_GPC['keywordtype'];
    $keyword = $_GPC['keyword'];
    $ispay = $_GPC['ispay'];
    $p_type = $_GPC['p_type'];
    $timetype = $_GPC['timetype'];
    $page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
    $start = empty($_GPC['start']) ? date("Y-m-d",strtotime("-1Months",time())) : $_GPC['start']; 
    $end = empty($_GPC['end']) ? date("Y-m-d",strtotime("+1days",time())) : $_GPC['end'];
    $where = " where a.uniacid = '{$uniacid}' and a.pid=0 and a.grade=1";
    if($keywordtype == '1')
    {
      $where .= " and a.orders like '%$keyword%'";
    }else if($keywordtype == '2')
    {
      $where .= " and c.u_name like '%$keyword%'";
    }else if($keywordtype == '3')
    {
      $where .= " and d.z_name like '%$keyword%'";
    }else if($keywordtype == '4')
    {
      $where .= " and a.telphone like '%$keyword%'";
    }
    if($ispay != '')
    {
      $where .= " and a.ispay=".$ispay;
    }
    if($p_type != '')
    {
      $where .= " and a.p_type=".$p_type;
    }
    if($start != '' && $start != date("Y-m-d",strtotime("-1Months",time())) && $end != '' && $end != date("Y-m-d",strtotime("+1days",time())))
    {
      $where .= " and a.time>=".strtotime($start)." and a.time<=".strtotime($end);
    }
    if(is_agent == '1')
    {
      $where .= " and a.zid in (".$zjs.")";
    }

    if($_W['ispost']){
        $res = pdo_fetchall("SELECT a.*,b.names,b.sex,b.age,b.tel,c.u_thumb,c.randnum,c.u_name,d.z_name,d.advertisement,d.hid,d.z_room,d.z_zhicheng,d.parentid FROM".tablename('hyb_yl_chufang')."as a left join".tablename('hyb_yl_userjiaren')."as b on b.j_id =a.j_id left join".tablename('hyb_yl_userinfo')."as c on c.openid=a.useropenid left join".tablename('hyb_yl_zhuanjia')."as d on d.zid=a.zid".$where." group by a.back_orser order by a.c_id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);

    }else{
        $res = pdo_fetchall("SELECT a.*,b.names,b.sex,b.age,b.tel,c.u_thumb,c.randnum,c.u_name,d.z_name,d.advertisement,d.hid,d.z_room,d.z_zhicheng,d.parentid FROM".tablename('hyb_yl_chufang')."as a left join".tablename('hyb_yl_userjiaren')."as b on b.j_id =a.j_id left join".tablename('hyb_yl_userinfo')."as c on c.openid=a.useropenid left join".tablename('hyb_yl_zhuanjia')."as d on d.zid=a.zid ".$where." group by a.back_orser order by a.c_id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
    }
    $count_order = count($res);
    $where1 = " where uniacid=".$uniacid;
    $where2 = " where uniacid=".$uniacid." and role=0";
    if(is_agent == '1')
    {
      $where1 .= " and zid in (".$zjs.")";
      $where2 .= " and zid in (".$zjs.")";
    }
    $money = pdo_fetchall("select money from ".tablename("hyb_yl_chufang").$where1." group by back_orser");
    $money = array_sum(array_map(function($val){return $val['money'];}, $money));
    $count = pdo_fetchall("select * from ".tablename("hyb_yl_chufang").$where2." group by openid");
    $count = count($count);


    if($money == NULL)
    {
      $money = '0.00';
    }
    $total = pdo_fetchall("SELECT count(*) FROM".tablename('hyb_yl_chufang')."as a left join".tablename('hyb_yl_userjiaren')."as b on b.j_id =a.j_id left join".tablename('hyb_yl_userinfo')."as c on c.openid=a.useropenid left join".tablename('hyb_yl_zhuanjia')."as d on d.zid=a.zid ".$where." group by a.back_orser");
    $total = count($total);
    $pager = pagination($total, $pageindex, $pagesize);
    foreach ($res as $key => $value) {

    	$back_orser = $value['orders'];
      // $res[$key]['tkmoney'] = pdo_fetchcolumn("SELECT SUM(money) FROM".tablename('hyb_yl_tuikeshouyi')."where uniacid='{$uniacid}' and orders='{$back_orser}'");
      // $res[$key]['ptmoney'] = pdo_fetchcolumn("select money from ".tablename("hyb_yl_pay")." where uniacid=".$uniacid." and style=8 and back_orser=".$back_orser);
      // $res[$key]['hosmoney'] = pdo_fetchcolumn("select money from ".tablename("hyb_yl_pay")." where uniacid=".$uniacid." and style=7 and back_orser=".$back_orser);
      $server = pdo_get("hyb_yl_doc_all_serverlist",array("uniacid"=>$uniacid,"key_words"=>'yuanchengkaifang','zid'=>$res[$key]['zid']));
      
      $res[$key]['ptmoneys'] = $res[$key]['ptmoney'];
      $res[$key]['hymoney'] = $server['hymoney'];
    	$res[$key]['content'] =unserialize($res[$key]['content']);
    	$res[$key]['count'] =pdo_fetchcolumn('SELECT COUNT(*) FROM ' .tablename("hyb_yl_chufang")."  where uniacid='{$uniacid}' and back_orser='{$back_orser}' and money!=0  ");

    	$res[$key]['countarr'] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' .tablename("hyb_yl_chufang")."  where uniacid='{$uniacid}' and back_orser='{$back_orser}' and role=0  ");
    	$count = intval($res[$key]['count']);
        $count_money =(float)($res[$key]['money']);
    	$res[$key]['count_money'] = ($count*$count_money);
    	$res[$key]['time'] =date("Y-m-d H:i:s",$res[$key]['time']);
    	$res[$key]['paytime'] =date("Y-m-d H:i:s",$res[$key]['paytime']);
    	$res[$key]['advertisement'] =tomedia($res[$key]['advertisement']);

      $res[$key]['moneyss'] = $res[$key]['ptmoneys'] - $res[$key]['ptmoney'] - $res[$key]['hosmoney'] - $res[$key]['tk_one'] - $res[$key]['tk_two'] - $res[$key]['coupon_dk'] - $res[$key]['card_dk'] - $res[$key]['year_dk'];
        $hid = $value['hid'];
        $z_zhicheng =$value['z_zhicheng']; 
        $z_room = $value['parentid'];
        $res[$key]['host'] = pdo_fetch("SELECT agentname FROM".tablename('hyb_yl_hospital')."where hid='{$hid}'");
        $res[$key]['keshi'] = pdo_fetch("SELECT name FROM".tablename('hyb_yl_ceshi')."where id='{$z_room}'");

        $res[$key]['job'] = pdo_fetch("SELECT job_name FROM".tablename('hyb_yl_zhuanjia_job')."where id='{$z_zhicheng}'");
    }
 
	include $this->template("ask/squareask");
}
//开方问诊详情
if($op == 'squareaskdetails')
{
    $c_id = $_GPC['c_id'];
    $hid = $_GPC['hid'];
    $res = pdo_fetch("SELECT a.money as amoney,a.paytime as apaytime,a.zid as zids,a.*,b.money as bmoney,b.*,c.*,d.paytime as dpaytime,d.* FROM".tablename('hyb_yl_chufang')."as a left join".tablename('hyb_yl_userinfo')."as b on b.openid=a.useropenid left join".tablename('hyb_yl_userjiaren')."as c on c.j_id=a.userid and c.openid=b.openid left join".tablename("hyb_yl_goodsorders")."as d on d.cid=a.c_id where a.uniacid = '{$uniacid}' and a.c_id ='{$c_id}'  ");
   
    $res['doc_detail']=  pdo_fetch("select a.*,c.name from".tablename('hyb_yl_zhuanjia')."as a left join".tablename('hyb_yl_ceshi')."as c on c.id = a.parentid where a.uniacid='{$uniacid}' and a.zid='{$res['zids']}'");
    $res['tk'] = pdo_fetchcolumn("select b.username from ".tablename("hyb_yl_tuikesite")." as a  left join ".tablename("hyb_yl_tuikesite")." as b on b.tkid=a.id where a.uniacid=".$uniacid." and a.openid='".$res['openid']."'");
    $back_orser = $res['back_orser'];
    $yizhu = unserialize($res['content']);
  
    $content = pdo_fetchall("select * from".tablename('hyb_yl_goodsorders')."where uniacid='{$uniacid}' and back_orders='{$back_orser}'");
    $res['ptmoneys'] = $res['old_money'];


    $res['moneyss'] = $res['ptmoneys'] - $res['ptmoney'] - $res['hosmoney'] - $res['tk_one'] - $res['tk_two'] - $res['coupon_dk'] - $res['card_dk'] - $res['year_dk'];

    foreach ($content as $key => $value) {
      $content[$key]['cartlist'] = unserialize($content[$key]['sid']);
      $cartlist = unserialize($content[$key]['sid']);
      foreach ($content[$key]['cartlist'] as $k => $v) {
        $namesgoods[] = explode(',',$v['sname']);
        
        $money[] = $v['smoney'];
        $num[] = $v['num'];

        $zhiyaochang =pdo_get("hyb_yl_goodsarr",array('sid'=>$v['sid']),array('pp_title','ifcfy'));
        $content[$key]['cartlist'][$k]['zhiyaochang'] = $zhiyaochang['pp_title'];
        $content[$key]['cartlist'][$k]['ifcfy'] = $zhiyaochang['ifcfy'];
      }
    }
    


    //查询预约专家详情
    $zid = $res['zids'];
    $res['content'] = unserialize($res['content']);
    $docinfo = pdo_fetch("SELECT a.*,b.agentname,c.name,d.job_name,e.ctname FROM".tablename('hyb_yl_zhuanjia')."as a left join".tablename('hyb_yl_hospital')."as b on a.hid=b.hid left join ".tablename('hyb_yl_ceshi')."as c on c.id =a.parentid left join".tablename('hyb_yl_zhuanjia_job')."as d on d.id=a.z_zhicheng left join".tablename('hyb_yl_classgory')."as e on e.id=c.giftstatus where a.zid='{$zid}'");
    
    $docinfo['advertisement'] = tomedia($docinfo['advertisement']);
         $res['time'] =date("Y-m-d H:i:s",$res['time'] );
         $res['paytime'] =date("Y-m-d H:i:s",$res['apaytime']);

      $server_key = "dianhuajizhen";
      $docinfo['plugin'] = unserialize($docinfo['plugin']);
      $result2 = [];
      array_map(function ($value) use (&$result2) {
        $result2 = array_merge($result2, array_values($value));
      }
      , $docinfo['plugin']);
      $docinfo['plugin'] =$result2;
      $docinfo['advertisement'] =tomedia($docinfo['advertisement']);

      foreach ($result2 as $k => $v) {
        if($server_key == $v['key_words']) {
          $docinfo['money'] = $v['ptmoney'];
        }
      }

	include $this->template("ask/squareaskdetails");
}
//视频问诊
if($op == 'videoask')
{
    $keywordtype = $_GPC['keywordtype'];
    $keyword = $_GPC['keyword'];
    $ifpay = $_GPC['ifpay'];
    $pay_type = $_GPC['pay_type'];
    $timetype = $_GPC['timetype'];
    $page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
    $start = empty($_GPC['start']) ? date("Y-m-d",strtotime("-1Months",time())) : $_GPC['start']; 
    $end = empty($_GPC['end']) ? date("Y-m-d",strtotime("+1days",time())) : $_GPC['end'];
    $where = " where a.uniacid = '{$uniacid}' and a.pid=0 and a.type=1 and a.keywords ='shipinwenzhen'";
    if($keywordtype == '1')
    {
      $where .= " and a.orders like '%$keyword%'";
    }else if($keywordtype == '2')
    {
      $where .= " and c.u_name like '%$keyword%'";
    }else if($keywordtype == '3')
    {
      $where .= " and d.z_name like '%$keyword%'";
    }else if($keywordtype == '4')
    {
      $where .= " and a.tell like '%$keyword%'";
    }
    if($ifpay != '')
    {
      $where .= " and a.ifpay=".$ifpay;
    }
    if($pay_type != '')
    {
      $where .= " and a.pay_type=".$pay_type;
    }
    if($start != '' && $end != '' && $start != date("Y-m-d",strtotime("-1Months",time())) && $end != '' && $end != date("Y-m-d",strtotime("+1days",time())))
    {
      $where .= " and a.time>=".strtotime($start)." and a.time<=".strtotime($end);
    }
    if(is_agent == '1')
    {
      $where .= " and zid in (".$zjs.")";
    }
    if($_W['ispost']){
      $res = pdo_fetchall("SELECT a.*,b.names,b.sex,b.age,b.tel,c.u_thumb,c.randnum,c.u_name,d.z_name,d.advertisement,d.hid,d.z_room,d.z_zhicheng,d.parentid FROM".tablename('hyb_yl_wenzorder')."as a left join".tablename('hyb_yl_userjiaren')."as b on b.j_id =a.j_id left join".tablename('hyb_yl_userinfo')."as c on c.openid=a.openid left join".tablename('hyb_yl_zhuanjia')."as d on d.zid=a.zid ".$where ." group by a.back_orser order by a.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
    }else{
      $res = pdo_fetchall("SELECT a.*,b.names,b.sex,b.age,b.tel,c.u_thumb,c.randnum,c.u_name,d.z_name,d.advertisement,d.hid,d.z_room,d.z_zhicheng,d.parentid FROM".tablename('hyb_yl_wenzorder')."as a left join".tablename('hyb_yl_userjiaren')."as b on b.j_id =a.j_id left join".tablename('hyb_yl_userinfo')."as c on c.openid=a.openid left join".tablename('hyb_yl_zhuanjia')."as d on d.zid=a.zid  ".$where." group by a.back_orser order by a.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
        
    }
   
    $where1 = " where  uniacid='{$uniacid}' and keywords ='shipinwenzhen'";
    $where2 = " where uniacid='{$uniacid}' and role=0 and keywords='shipinwenzhen'";

    if(is_agent == '1')
    {
      $where1 .= " and zid in (".$zjs.")";
      $where2 .= " and zid in (".$zjs.")";
    }
    //$count_order = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder").$where1." group by back_orser");
   
    $money_count = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder").$where1." group by back_orser");
    $money_count = array_sum(array_map(function($val){return $val['money'];}, $money_count));

    $person = pdo_fetchall("select * from ".tablename("hyb_yl_wenzorder").$where2." group by openid"); 

    $count_person = count($person);
    foreach ($res as $key => $value) {

      if($res[$key]['ifpay'] =='0'){
         $res[$key]['zhuangtai'] ="待支付";
      }
      if($res[$key]['ifpay'] =='1'){
         $res[$key]['zhuangtai'] ="已支付待接诊";
      }
      if($res[$key]['ifpay'] =='2'){
         $res[$key]['zhuangtai'] ="已接诊";
      }
      if($res[$key]['ifpay'] =='3'){
         $res[$key]['zhuangtai'] ="已完成待评价";
      }
      if($res[$key]['ifpay'] =='4'){
         $res[$key]['zhuangtai'] ="已评价";
      }
      if($res[$key]['ifpay'] =='5' && $res[$key]['money'] !=0){
         $res[$key]['zhuangtai'] ="退款中";
      }
      if($res[$key]['ifpay'] =='6' ){
         $res[$key]['zhuangtai'] ="已退款";
      } 
      if($res[$key]['ifpay'] =='7'){
         $res[$key]['zhuangtai'] ="已关闭";
      }
      if($res[$key]['ifpay'] =='8'){
         $res[$key]['zhuangtai'] ="已取消";
      }

      $back_orser = $value['orders'];
      // $res[$key]['tkmoney'] = pdo_fetchcolumn("SELECT SUM(money) FROM".tablename('hyb_yl_tuikeshouyi')."where uniacid='{$uniacid}' and orders='{$back_orser}'");
      // $res[$key]['ptmoney'] = pdo_fetchcolumn("select money from ".tablename("hyb_yl_pay")." where uniacid=".$uniacid." and style=8 and back_orser=".$back_orser);
      // $res[$key]['hosmoney'] = pdo_fetchcolumn("select money from ".tablename("hyb_yl_pay")." where uniacid=".$uniacid." and style=7 and back_orser=".$back_orser);
      $server = pdo_get("hyb_yl_doc_all_serverlist",array("uniacid"=>$uniacid,"key_words"=>'shipinwenzhen','zid'=>$res[$key]['zid']));
      
      $res[$key]['ptmoneys'] = $res[$key]['old_money'];
      $res[$key]['hymoney'] = $server['hymoney'];
      $res[$key]['content'] =unserialize($res[$key]['content']);
      $res[$key]['count'] =pdo_fetchcolumn('SELECT COUNT(*) FROM ' .tablename("hyb_yl_wenzorder")."  where uniacid='{$uniacid}' and back_orser='{$back_orser}' and role=0 and keywords ='shipinwenzhen' ");

      $res[$key]['countarr'] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' .tablename("hyb_yl_wenzorder")."  where uniacid='{$uniacid}' and back_orser='{$back_orser}' and role=0 and keywords ='shipinwenzhen' ");
      $count = intval($res[$key]['count']);
      $count_money =(float)($res[$key]['money']);
      $res[$key]['count_money'] = ($count*$count_money);
      $res[$key]['time'] =date("Y-m-d H:i:s",$res[$key]['time']);
      $res[$key]['paytime'] =date("Y-m-d H:i:s",$res[$key]['paytime']);
      $res[$key]['advertisement'] =tomedia($res[$key]['advertisement']);
      $hid = $value['hid'];
      $z_zhicheng =$value['z_zhicheng']; 
      $z_room = $value['parentid'];
      $res[$key]['host'] = pdo_fetch("SELECT agentname FROM".tablename('hyb_yl_hospital')."where hid='{$hid}'");
      $res[$key]['keshi'] = pdo_fetch("SELECT name FROM".tablename('hyb_yl_ceshi')."where id='{$z_room}'");
      $res[$key]['job'] = pdo_fetch("SELECT job_name FROM".tablename('hyb_yl_zhuanjia_job')."where id='{$z_zhicheng}'");

      $res[$key]['moneyss'] = $res[$key]['ptmoneys'] - $res[$key]['ptmoney'] - $res[$key]['hosmoney'] - $res[$key]['tk_one'] - $res[$key]['tk_two'] - $res[$key]['coupon_dk'] - $res[$key]['card_dk'] - $res[$key]['year_dk'];
    }

    if($money == NULL)
    {
      $money = '0.00';
    }
    $totals = pdo_fetchall("SELECT count(*) FROM".tablename('hyb_yl_wenzorder')."as a left join".tablename('hyb_yl_userjiaren')."as b on b.j_id =a.j_id left join".tablename('hyb_yl_userinfo')."as c on c.openid=a.openid left join".tablename('hyb_yl_zhuanjia')."as d on d.zid=a.zid".$where." group by a.back_orser");
    
    $count_order = $total = count($totals);

    $pager = pagination($total, $pageindex, $pagesize);
    
	include $this->template("ask/videoask");
}
//视频问诊详情
if($op == 'videoaskdetails')
{
    $id = $_GPC['id'];
    $res = pdo_fetch("SELECT a.money as amoney,a.*,b.money as bmoney,b.*,c.names,c.sex,c.datetime,c.age,c.region FROM".tablename('hyb_yl_wenzorder')."as a left join".tablename('hyb_yl_userinfo')."as b on b.openid=a.openid left join".tablename('hyb_yl_userjiaren')."as c on c.j_id=a.j_id and c.openid=b.openid where a.uniacid = '{$uniacid}' and a.id ='{$id}'  ");

    //查询预约专家详情
    $zid = $res['zid'];
    $res['content'] = unserialize($res['describe']);
    $docinfo = pdo_fetch("SELECT a.*,b.agentname,c.name,d.job_name,e.ctname FROM".tablename('hyb_yl_zhuanjia')."as a left join".tablename('hyb_yl_hospital')."as b on a.hid=b.hid left join ".tablename('hyb_yl_ceshi')."as c on c.id =a.parentid left join".tablename('hyb_yl_zhuanjia_job')."as d on d.id=a.z_zhicheng left join".tablename('hyb_yl_classgory')."as e on e.id=c.giftstatus where a.zid='{$zid}'");
    $res['ptmoneys'] = $res['old_money'];
    $res['moneyss'] = $res['ptmoneys'] - $res['ptmoney'] - $res['hosmoney'] - $res['tk_one'] - $res['tk_two'] - $res['coupon_dk'] - $res['card_dk'] - $res['year_dk'];
    $res['tk'] = pdo_fetchcolumn("select b.username from ".tablename("hyb_yl_tuikesite")." as a  left join ".tablename("hyb_yl_tuikesite")." as b on b.tkid=a.id where a.uniacid=".$uniacid." and a.openid='".$res['openid']."'");
    $docinfo['advertisement'] = tomedia($docinfo['advertisement']);
         $res['time'] =date("Y-m-d H:i:s",$res['time'] );
         $res['paytime'] =date("Y-m-d H:i:s",$res['paytime'] );

      $server_key = "dianhuajizhen";
      $docinfo['plugin'] = unserialize($docinfo['plugin']);
      $result2 = [];
      array_map(function ($value) use (&$result2) {
        $result2 = array_merge($result2, array_values($value));
      }
      , $docinfo['plugin']);
      $docinfo['plugin'] =$result2;
      $docinfo['advertisement'] =tomedia($docinfo['advertisement']);

      foreach ($result2 as $k => $v) {
        if($server_key == $v['key_words']) {
          $docinfo['money'] = $v['ptmoney'];
        }
      }
	include $this->template("ask/videoaskdetails");
}
//手术安排
if($op == 'operativeask')
{
  $keywordtype = $_GPC['keywordtype'];
  $keyword = $_GPC['keyword'];
  $ispay = $_GPC['ispay'];
  // $pay_type = $_GPC['pay_type'];
  $timetype = $_GPC['timetype'];
  $page = empty($_GPC['page']) ? "" : $_GPC['page'];
  $pageindex = max(1, intval($page));
  $pagesize = 10;
  $start = empty($_GPC['start']) ? date("Y-m-d",strtotime("-1Months",time())) : $_GPC['start']; 
  $end = empty($_GPC['end']) ? date("Y-m-d",strtotime("+1days",time())) : $_GPC['end'];
  $where = " where a.uniacid = '{$uniacid}' and a.keywords = 'shoushukuaiyue'";
  if($ispay != '')
  {
    $where .= " and a.ifpay=".$ispay;
  }
  if($keywordtype == '1')
  {
    $where .= " and a.back_orser like '%$keyword%'";
  }else if($keywordtype == '2')
  {
    $where .= " and u.u_name like '%$keyword%'";
  }else if($keywordtype == '3')
  {
    $where .= " and z.z_name like '%$keyword%'";
  }else if($keywordtype == '4')
  {
    $where .= " and u.u_phone like '%$keyword%'";
  }
  if($timetype == '1' && $start != '' && $start != date("Y-m-d",strtotime("-1Months",time())) && $end != '' && $end != date("Y-m-d",strtotime("+1days",time())))
  {
    $where .= " and a.created >=".strtotime($start)." and a.created <=".strtotime($end);
  }else if($timetype == '2' && $start != '' && $start != date("Y-m-d",strtotime("-1Months",time())) && $end != '' && $end != date("Y-m-d",strtotime("+1days",time())))
  {
    $where .= " and a.paytime >=".strtotime($start)." and a.created <=".strtotime($end);
  }
  if(is_agent == '1')
  {
    $where .= " and a.zid in (".$zjs.")";
  }
  $list = pdo_fetchall("select a.*,z.z_name,z.z_zhicheng,z.z_room,z.parentid,z.qx_id,z.hid,u.u_name,u.u_phone,u.u_id,z.advertisement from ".tablename("hyb_yl_wenzorder")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=a.zid left join ".tablename("hyb_yl_userinfo")." as u on u.openid=a.openid ".$where." group by a.back_orser order by a.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
  
  foreach($list as &$value)
  {
    $back_orser = $value['orders'];
    // $value['tkmoney'] = pdo_fetchcolumn("SELECT SUM(money) FROM".tablename('hyb_yl_tuikeshouyi')."where uniacid='{$uniacid}' and orders='{$back_orser}'");
    // $value['ptmoney'] = pdo_fetchcolumn("select money from ".tablename("hyb_yl_pay")." where uniacid=".$uniacid." and style=8 and back_orser=".$back_orser);
    // $value['hosmoney'] = pdo_fetchcolumn("select money from ".tablename("hyb_yl_pay")." where uniacid=".$uniacid." and style=7 and back_orser=".$back_orser);
    $value['advertisement'] = tomedia($value['advertisement']);
    $value['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$value['parentid']),'name');
    $value['jigou'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$value['hid']),'agentname');
    $value['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$value['z_zhicheng']),"job_name");
    $value['time'] = date("Y-m-d H:i:s",$value['time']);
    $value['overtime'] = date("Y-m-d H:i:s",$value['overtime']);
    $value['paytime'] = date("Y-m-d H:i:s",$value['paytime']);
    $value['jz_time'] = date("Y-m-d H:i:s",$value['jz_time']);
    $value['apply_time'] = date("Y-m-d H:i:s",$value['apply_time']);
    $value['refund_time'] = date("Y-m-d H:i:s",$value['refund_time']);
    $user = pdo_get("hyb_yl_userjiaren",array("openid"=>$value['openid'],"sick_index"=>'0'));
    $value['names'] =$user['names'];
    $value['tel'] = $user['tel'];

    $server = pdo_get("hyb_yl_doc_all_serverlist",array("uniacid"=>$uniacid,"key_words"=>'shoushukuaiyue','zid'=>$value['zid']));
      
    $value['ptmoneys'] = $value['old_money'];
    $value['hymoney'] = $server['hymoney'];

    $value['moneyss'] = $value['ptmoneys'] - $value['ptmoney'] - $res[$key]['hosmoney'] - $value['tk_one'] - $value['tk_two'] - $value['coupon_dk'] - $value['card_dk'] - $value['year_dk'];
  }
  $total = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=a.zid left join ".tablename("hyb_yl_userinfo")." as u on u.openid=a.openid ".$where." group by a.back_orser");

  $total = count($total);
  $pager = pagination($total, $pageindex, $pagesize);
  $where1 = " where uniacid=".$uniacid."  and keywords = 'shoushukuaiyue'";
  if(is_agent == '1')
  {
    $where1 .= " and zid in (".$zjs.")";
  }
  $count = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder").$where1." group by back_orser");
  
  $count = count($count);
  $money = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder").$where1." group by back_orser");
  $money = array_sum(array_map(function($val){return $val['money'];}, $money));
	include $this->template("ask/operativeask");
}
//手术安排详情
if($op == 'operativeaskdetails')
{
  $id = $_GPC['id'];
  $item = pdo_fetch("select * from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and keywords = 'shoushukuaiyue' and id=".$id);
  $item['tk'] = pdo_fetchcolumn("select b.username from ".tablename("hyb_yl_tuikesite")." as a  left join ".tablename("hyb_yl_tuikesite")." as b on b.tkid=a.id where a.uniacid=".$uniacid." and a.openid='".$item['openid']."'");
  $item['describe'] = unserialize($item['describe']);
  $item['name'] = pdo_getcolumn("hyb_yl_docser_speck",array("uniacid"=>$uniacid,"key_words"=>$item['keywords']),'titlme');
  $zhuanjia = pdo_get("hyb_yl_zhuanjia",array("zid"=>$item['zid']));
  $zhuanjia['advertisement'] = tomedia($zhuanjia['advertisement']);
  $zhuanjia['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$zhuanjia['z_zhicheng']),'job_name');
  $zhuanjia['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$zhuanjia['parentid']),'name');
  $zhuanjia['jigou'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$zhuanjia['hid']),'agentname');
  $item['time'] = date("Y-m-d H:i:s",$item['time']);
  $item['overtime'] = date("Y-m-d H:i:s",$item['overtime']);
  $item['paytime'] = date("Y-m-d H:i:s",$item['paytime']);
  $item['jz_time'] = date("Y-m-d H:i:s",$item['jz_time']);
  $item['apply_time'] = date("Y-m-d H:i:s",$item['apply_time']);
  $item['refund_time'] = date("Y-m-d H:i:s",$item['refund_time']);
  $user = pdo_fetch("select u.*,j.names,j.tel,j.region from ".tablename("hyb_yl_userinfo")." as u left join ".tablename("hyb_yl_userjiaren")." as j on j.openid=u.openid where u.openid=:openid",array(":openid"=>$item['openid']));
  $item['names'] =$user['names'];
  $item['tel'] = $user['tel'];
  $item['ptmoneys'] = $item['old_money'];

  $item['moneyss'] = $item['ptmoneys'] - $item['ptmoney'] - $item['hosmoney'] - $item['tk_one'] - $item['tk_two'] - $item['coupon_dk'] - $item['card_dk'] - $item['year_dk'];
	include $this->template("ask/operativeaskdetails");
}

// 手术安排确认付款
if($op == 'operativeaskpay')
{
  $back_orser = $_GPC['back_orser'];
  $ifpay = $_GPC['ifpay'];
  $res = pdo_update("hyb_yl_wenzorder",array("ifpay"=>$ifpay,"paytime"=>time()),array("back_orser"=>$back_orser));
  if($res)
  {
    message("设置成功!",$this->createWebUrl("ask",array("op"=>"operativeask",'ac'=>'operativeask')),"success");
  }else{
    message("设置失败!",$this->createWebUrl("ask",array("op"=>"operativeask",'ac'=>'operativeask')),"error");

  }
  include $this->template("ask/operativeask");
}
// 删除手术安排
if($op == 'operativeaskdel')
{
  $back_orser = $_GPC['back_orser'];
  $res = pdo_delete("hyb_yl_wenzorder",array("back_orser"=>$back_orser));
  pdo_delete('hyb_yl_answer',array('orders'=>$back_orser));
  if($res)
  {
    message("删除成功!",$this->createWebUrl("ask",array("op"=>"operativeask",'ac'=>'operativeask')),"success");
  }else{
    message("删除失败!",$this->createWebUrl("ask",array("op"=>"operativeask",'ac'=>'operativeask')),"error");

  }
  include $this->template("ask/operativeask");
}

// 导出手术安排
if($op == 'export')
{
  $key_words = empty($_GPC['key_words']) ? 'dianhuajizhen' : $_GPC['key_words'];
  $keywordtype = $_GPC['keywordtype'];
  $keyword = $_GPC['keyword'];
  $ispay = $_GPC['ispay'];
  // $pay_type = $_GPC['pay_type'];
  $timetype = $_GPC['timetype'];
  $start = empty($_GPC['start']) ? date("Y-m-d",strtotime("-1Months",time())) : $_GPC['start']; 
  $end = empty($_GPC['end']) ? date("Y-m-d",strtotime("+1days",time())) : $_GPC['end'];
  $where = " where a.uniacid = '{$uniacid}' and a.keywords = '{$key_words}'";
  if($ispay != '')
  {
    $where .= " and a.ifpay=".$ispay;
  }
  if($keywordtype == '1')
  {
    $where .= " and a.back_orser like '%$keyword%'";
  }else if($keywordtype == '2')
  {
    $where .= " and u.u_name like '%$keyword%'";
  }else if($keywordtype == '3')
  {
    $where .= " and z.z_name like '%$keyword%'";
  }else if($keywordtype == '4')
  {
    $where .= " and u.u_phone like '%$keyword%'";
  }
  if($timetype == '1')
  {
    $where .= " and a.created >=".strtotime($start)." and a.created <=".strtotime($end);
  }
  $list = pdo_fetchall("select a.*,z.z_name,z.z_zhicheng,z.z_room,z.parentid,z.qx_id,z.hid,u.u_name,u.u_phone,u.u_id,z.advertisement from ".tablename("hyb_yl_wenzorder")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=a.zid left join ".tablename("hyb_yl_userinfo")." as u on u.openid=a.openid ".$where." group by a.back_orser order by a.id desc");
    require_once(IA_ROOT . '/framework/library/phpexcel/PHPExcel.php');
    //实例化
    if($key_words == 'dianhuajizhen')
    {
      $name = "电话问诊订单表";
      $names = "电话费用";
    }else if($key_words == 'shipinwenzhen')
    {
      $name = "视频问诊订单表";
      $names = "视频费用";
    }else if($key_words == 'shoushukuaiyue')
    {
      $name = "手术安排订单表";
      $names = "手术费用";
    }else if($key_words == 'tijianjiedu')
    {
      $name = "报告解读订单表";
      $names = "解读费用";
    }
    //实例化
    $objPHPExcel = new PHPExcel();
    /*右键属性所显示的信息*/
    $objPHPExcel->getProperties()->setCreator("管理员")  //作者
    ->setLastModifiedBy("管理员")  //最后一次保存者
    ->setTitle($name)  //标题
    ->setSubject($name) //主题
    ->setDescription($name)  //描述
    ->setKeywords("excel")   //标记
    ->setCategory("result file");  //类别

    //设置当前的表格
    $objPHPExcel->setActiveSheetIndex(0);
    // 设置表格第一行显示内容
    $objPHPExcel->getActiveSheet()
        ->setCellValue('A1', '订单编号')
        ->setCellValue('B1', '专家名称')
        ->setCellValue('C1', '专家科室')
        ->setCellValue('D1', '专家职称')
        ->setCellValue('E1', '专家机构')
        ->setCellValue('F1', $names)
        ->setCellValue('G1', '用户名称')
        ->setCellValue('H1', '联系方式')
        ->setCellValue('I1', '问诊详情')
        ->setCellValue('J1', '下单方式')
        ->setCellValue('K1', '订单状态')
        ->setCellValue('L1', '订单类型')
        //设置第一行为红色字体
        ->getStyle('A1:L1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);

    $s = 1;
    //  /*以下就是对处理Excel里的数据，横着取数据*/
    foreach($list as &$t){

        $t['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$t['parentid']),'name');
        $t['jigou'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$t['hid']),'agentname');
        $t['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$t['z_zhicheng']),"job_name");
        $t['time'] = date("Y-m-d H:i:s",$t['time']);
        $user = pdo_get("hyb_yl_userjiaren",array("openid"=>$t['openid'],"sick_index"=>'0'));
        $t['names'] =$user['names'];
        $t['tel'] = $user['tel'];
        $t['name'] = pdo_getcolumn("hyb_yl_docser_speck",array("uniacid"=>$uniacid,"key_words"=>$t['keywords']),'titlme');
        $t['describe'] = unserialize($t['describe']);
        //匹配数值
        if($t['ifpay'] == 0)
        {
            $t['statuss'] = '待支付';
        }elseif($t['ifpay'] == 1)
        {
            $t['statuss'] = '已支付待接诊';
        }elseif($t['ifpay'] == 2)
        {
            $t['statuss'] = '接诊中';
        }elseif($t['ifpay'] == 3)
        {
            $t['statuss'] = '已完成待评价';
        }elseif($t['ifpay'] == 4)
        {
            $t['statuss'] = '已评价';
        }elseif($t['ifpay'] == 5)
        {
            $t['statuss'] = '申请退款';
        }elseif($t['ifpay'] == 6)
        {
            $t['statuss'] = '退款成功';
        }else if($t['ifpay'] == '7')
        {
            $t['statuss'] = '订单关闭';
        }

        //设置循环从第二行开始
        $s++;
        $objPHPExcel->getActiveSheet()

            //Excel的第A列，name是你查出数组的键值字段，下面以此类推
            ->setCellValue('A'.$s, $t['back_orser'])
            ->setCellValue('B'.$s, $t['z_name'])
            ->setCellValue('C'.$s, $t['keshi'])
            ->setCellValue('D'.$s, $t['zhicheng'])
            ->setCellValue('E'.$s, $t['jigou'])
            ->setCellValue('F'.$s, $t['money'])
            ->setCellValue('G'.$s, $t['names'])
            ->setCellValue('H'.$s, $t['tel'])
            ->setCellValue('I'.$s, $t['describe']['text'])
            ->setCellValue('J'.$s, '微信支付')
            ->setCellValue('K'.$s, $t['statuss'])
            ->setCellValue('L'.$s, $t['name']);

    }
    //设置当前的表格
    $objPHPExcel->setActiveSheetIndex(0);
    ob_end_clean();//清除缓冲区,避免乱码
    header('Content-Type: application/vnd.ms-excel'); //文件类型
    header('Content-Disposition: attachment;filename="'.$name.'.xls"'); //文件名
    header('Cache-Control: max-age=0');
    header('Content-Type: text/html; charset=utf-8'); //编码
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //excel 2003
    $objWriter->save('php://output');
    // message("导出成功!",$this->createWebUrl("ask",array("op"=>"operativeask")),"error");
    exit;
}

//报告解读
if($op == 'informask')
{
  $keywordtype = $_GPC['keywordtype'];
  $keyword = $_GPC['keyword'];
  $ispay = $_GPC['ispay'];
  // $pay_type = $_GPC['pay_type'];
  $timetype = $_GPC['timetype'];
  $page = empty($_GPC['page']) ? "" : $_GPC['page'];
  $pageindex = max(1, intval($page));
  $pagesize = 10;
  $start = empty($_GPC['start']) ? date("Y-m-d",strtotime("-1Months",time())) : $_GPC['start']; 
  $end = empty($_GPC['end']) ? date("Y-m-d",strtotime("+1days",time())) : $_GPC['end'];
  $where = " where a.uniacid = '{$uniacid}' and a.keywords = 'tijianjiedu'";
  if($ispay != '')
  {
    $where .= " and a.ifpay=".$ispay;
  }
  if($keywordtype == '1')
  {
    $where .= " and a.back_orser like '%$keyword%'";
  }else if($keywordtype == '2')
  {
    $where .= " and u.u_name like '%$keyword%'";
  }else if($keywordtype == '3')
  {
    $where .= " and z.z_name like '%$keyword%'";
  }else if($keywordtype == '4')
  {
    $where .= " and u.u_phone like '%$keyword%'";
  }
  if($timetype == '1' && $start != '' && $start != date("Y-m-d",strtotime("-1Months",time())) && $end != '' && $end != date("Y-m-d",strtotime("+1days",time())))
  {
    $where .= " and a.created >=".strtotime($start)." and a.created <=".strtotime($end);
  }else if($timetype == '2' && $start != '' && $start != date("Y-m-d",strtotime("-1Months",time())) && $end != '' && $end != date("Y-m-d",strtotime("+1days",time())))
  {
    $where .= " and a.paytime >=".strtotime($start)." and a.paytime <=".strtotime($end);
  }
  if(is_agent == '1')
  {
    $where .= " and a.zid in (".$zjs.")";
  }
  $list = pdo_fetchall("select a.*,z.z_name,z.z_zhicheng,z.z_room,z.parentid,z.qx_id,z.hid,u.u_name,u.u_phone,u.u_id,z.advertisement from ".tablename("hyb_yl_wenzorder")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=a.zid left join ".tablename("hyb_yl_userinfo")." as u on u.openid=a.openid ".$where." group by a.back_orser order by a.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
  
  foreach($list as &$value)
  {
    $value['advertisement'] = tomedia($value['advertisement']);
    $value['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$value['parentid']),'name');
    $value['jigou'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$value['hid']),'agentname');
    $value['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$value['z_zhicheng']),"job_name");
    $value['time'] = date("Y-m-d H:i:s",$value['time']);
    $value['overtime'] = date("Y-m-d H:i:s",$value['overtime']);
    $value['paytime'] = date("Y-m-d H:i:s",$value['paytime']);
    $value['jz_time'] = date("Y-m-d H:i:s",$value['jz_time']);
    $value['apply_time'] = date("Y-m-d H:i:s",$value['apply_time']);
    $value['refund_time'] = date("Y-m-d H:i:s",$value['refund_time']);
    $user = pdo_get("hyb_yl_userjiaren",array("openid"=>$value['openid'],"sick_index"=>'0'));
    $value['names'] =$user['names'];
    $value['tel'] = $user['tel'];
    $server = pdo_get("hyb_yl_doc_all_serverlist",array("uniacid"=>$uniacid,"key_words"=>'tijianjiedu','zid'=>$value['zid']));
      
    $value['ptmoneys'] = $value['old_money'];
    $value['hymoney'] = $server['hymoney'];

    $value['moneyss'] = $value['ptmoneys'] - $value['ptmoney'] - $value['hosmoney'] - $value['tk_one'] - $value['tk_two'] - $value['coupon_dk'] - $value['card_dk'] - $value['year_dk'];
  }
  $total = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=a.zid left join ".tablename("hyb_yl_userinfo")." as u on u.openid=a.openid ".$where." group by a.back_orser");
  $total = count($total);
  $pager = pagination($total, $pageindex, $pagesize);
  $where1 = " where uniacid=".$uniacid."  and keywords = 'tijianjiedu'";
  if(is_agent == '1')
  {
    $where1 .= " and zid in (".$zjs.")";
  }
  $count = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder").$where1." group by back_orser");
  $count = count($count);

  $money = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder").$where1." group by back_orser");
  $money = array_sum(array_map(function($val){return $val['money'];}, $money));
	include $this->template("ask/informask");
}
//报告解读详情
if($op == 'informaskdetails')
{
  $id = $_GPC['id'];
  $item = pdo_fetch("select * from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and keywords = 'tijianjiedu' and id=".$id);
  $item['describe'] = unserialize($item['describe']);
  $item['name'] = pdo_getcolumn("hyb_yl_docser_speck",array("uniacid"=>$uniacid,"key_words"=>$item['keywords']),'titlme');
  $zhuanjia = pdo_get("hyb_yl_zhuanjia",array("zid"=>$item['zid']));
  $zhuanjia['advertisement'] = tomedia($zhuanjia['advertisement']);
  $zhuanjia['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$zhuanjia['z_zhicheng']),'job_name');
  $zhuanjia['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$zhuanjia['parentid']),'name');
  $zhuanjia['jigou'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$zhuanjia['hid']),'agentname');
  $item['time'] = date("Y-m-d H:i:s",$item['time']);
  $item['overtime'] = date("Y-m-d H:i:s",$item['overtime']);
  $item['paytime'] = date("Y-m-d H:i:s",$item['paytime']);
  $item['jz_time'] = date("Y-m-d H:i:s",$item['jz_time']);
  $item['apply_time'] = date("Y-m-d H:i:s",$item['apply_time']);
  $item['refund_time'] = date("Y-m-d H:i:s",$item['refund_time']);
  $user = pdo_fetch("select u.*,j.names,j.tel,j.region from ".tablename("hyb_yl_userinfo")." as u left join ".tablename("hyb_yl_userjiaren")." as j on j.openid=u.openid where u.openid=:openid",array(":openid"=>$item['openid']));
  $item['names'] =$user['names'];
  $item['tel'] = $user['tel'];
  $item['tk'] = pdo_fetchcolumn("select b.username from ".tablename("hyb_yl_tuikesite")." as a  left join ".tablename("hyb_yl_tuikesite")." as b on b.tkid=a.id where a.uniacid=".$uniacid." and a.openid='".$item['openid']."'");
  $item['ptmoneys'] = $item['old_money'];
  $item['moneyss'] = $item['ptmoneys'] - $item['ptmoney'] - $item['hosmoney'] - $item['tk_one'] - $item['tk_two'] - $item['coupon_dk'] - $item['card_dk'] - $item['year_dk'];
	include $this->template("ask/informaskdetails");
}

// 报告解读确认付款
if($op == 'informaskpay')
{
  $back_orser = $_GPC['back_orser'];
  $ifpay = $_GPC['ifpay'];
  $res = pdo_update("hyb_yl_wenzorder",array("ifpay"=>$ifpay,"paytime"=>time()),array("back_orser"=>$back_orser));
  if($res)
  {
    message("设置成功!",$this->createWebUrl("ask",array("op"=>"informask",'ac'=>'informask')),"success");
  }else{
    message("设置失败!",$this->createWebUrl("ask",array("op"=>"informask",'ac'=>'informask')),"error");

  }
  include $this->template("ask/informask");
}
// 删除报告解读
if($op == 'informaskdel')
{
  $back_orser = $_GPC['back_orser'];

  $res = pdo_delete("hyb_yl_wenzorder",array("back_orser"=>$back_orser));
  pdo_delete('hyb_yl_answer',array('orders'=>$back_orser));
  if($res)
  {
    message("删除成功!",$this->createWebUrl("ask",array("op"=>"informask",'ac'=>'informask')),"success");
  }else{
    message("删除失败!",$this->createWebUrl("ask",array("op"=>"informask",'ac'=>'informask')),"error");

  }
  include $this->template("ask/informask");
}
//规则设置
if($op == 'askrule')
{
  $item = pdo_get("hyb_yl_wenzhenrule",array("uniacid"=>$uniacid));
  if($_W['ispost'])
  {
    $data = array(
      'uniacid' => $uniacid,
      "chaoshi" => $_GPC['chaoshi'],
      "over" => $_GPC['over'],
      "p_jiezhen" => $_GPC['p_jiezhen'],
      "mianfei_num" => $_GPC['mianfei_num'],
      "chao_price" => $_GPC['chao_price'],
      "default_telnum" => $_GPC['default_telnum'],
      "default_telprice" => $_GPC['default_telprice'],
      "default_spnum" => $_GPC['default_spnum'],
      "default_spprice" => $_GPC['default_spprice'],
    );
    if($item)
    {
      $res = pdo_update("hyb_yl_wenzhenrule",$data,array("uniacid"=>$uniacid));
    }else{
      $data['created'] = time();
      $res = pdo_insert("hyb_yl_wenzhenrule",$data);
    }
    if($res)
    {
      message("设置成功!",$this->createWebUrl("ask",array("op"=>"askrule")),"success");
    }else{
      message("设置失败!",$this->createWebUrl("ask",array("op"=>"askrule")),"error");

    }
  }
	include $this->template("ask/askrule");
}
//问题库
if($op == 'askroom')
{
  $page = empty($_GPC['page']) ? "" : $_GPC['page'];
  $pageindex = max(1, intval($page));
  $pagesize = 10;

  $type_arr = pdo_getall("hyb_yl_docserver_type",array("uniacid"=>$uniacid));
  $ks_list = pdo_getall("hyb_yl_classgory",array("uniacid"=>$uniacid,'typeint'=>'0'));
  $keshi_arr = pdo_getall("hyb_yl_ceshi",array("uniacid"=>$uniacid));
  foreach($keshi_arr as &$value)
  {
     $value['description'] = explode('、', $value['description']);
  }
  $start = empty($_GPC['start']) ? date("Y-m-d",strtotime("-1Months",time())) : $_GPC['start']; 
  $end = empty($_GPC['end']) ? date("Y-m-d",strtotime("+1days",time())) : $_GPC['end'];
  $keshi_one = $_GPC['keshi_ones'];
  $keshi_two = $_GPC['keshi_two'];
  $label = $_GPC['label'];
  $keyword = $_GPC['keyword'];
  $type = $_GPC['type'];
  $status = $_GPC['status'];
  $where = " where a.uniacid=".$uniacid;

  if($type != '')
  {
    $where .= " and a.type like '%$type%'";
  }
  if($start != date("Y-m-d",strtotime("-1Months",time())) && $end != date("Y-m-d",strtotime("+1days",time())))
  {
    $where .= " and a.created>=".strtotime($start)." and a.created <=".strtotime($end);
  }
  if($status != '')
  {
    $where .= " and a.status=".$status;
  }
  if($keshi_one != '')
  {
    $where .= " and a.keshi_one=".$keshi_one;
  }
  if($keshi_two != '')
  {
    $where .= " and a.keshi_two=".$keshi_two;
  }
  if($label != '')
  {
    $where .= " and a.label like '%$label%'";
  }
  if($keyword != '')
  {
    $where .= " and (a.z_name like '%$keyword%' or a.u_name like '%$keyword%' or z.z_name like '%$keyword%' or u.u_name like '%$keyword%')";
  }
  
  if(is_agent == '1')
  {
    $where .= " and a.zid in (".$zjs.")";
  }
  $list = pdo_fetchall("select a.*,z.z_name as zname,z.advertisement,u.u_name as uname,u.u_thumb as thumb from ".tablename("hyb_yl_answer")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=a.zid left join ".tablename("hyb_yl_userinfo")." as u on u.openid=a.openid ".$where." order by a.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);

  foreach($list as &$value)
  {

    $value['ks_one'] = pdo_getcolumn("hyb_yl_classgory",array("id"=>$value['keshi_one']),'ctname');
    $value['ks_two'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$value['keshi_two']),'name');
    $value['created'] = date("Y-m-d H:i:s",$value['created']);
    if($value['keyword']=='dianhuajizhen' || $value['keyword']=='shipinwenzhen' ){
      $label =  pdo_fetch("SELECT * FROM".tablename('hyb_yl_wenzorder')."as a left join".tablename('hyb_yl_userinfo')."as b on b.openid=a.openid where a.orders = '{$value['orders']}' or b.openid='{$value['openid']}'");
       $value['label'] = explode(',', $label);
    }
    elseif($value['keyword']=='tuwenwenzhen'){
      $labels =  pdo_fetch("SELECT * FROM".tablename('hyb_yl_twenorder')."as a left join".tablename('hyb_yl_userinfo')."as b on b.openid=a.openid where a.orders = '{$value['orders']}' or b.openid='{$value['openid']}' ");
       $value['label'] = explode(',', $labels['biaoqian']);
    }else{
       $value['label'] = explode(',', $value['label']);
    }
    
  }
  $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_answer")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=a.zid left join ".tablename("hyb_yl_userinfo")." as u on u.openid=a.openid ".$where);
  $pager = pagination($total, $pageindex, $pagesize);
  
	include $this->template("ask/askroom");
}
if($op == 'import')
{

  if ($_W['ispost']) {
      $force = $_GPC['force'];
      $file = $_FILES['file'];
      $type = @end( explode('.', $file['name']));
      $type = strtolower($type);

      //开始导入
      set_time_limit(0);
      require_once(IA_ROOT . '/framework/library/phpexcel/PHPExcel.php');
      require_once(IA_ROOT . '/framework/library/phpexcel/PHPExcel/IOFactory.php');
      if( $type == 'xls' ){
        $inputFileType = 'Excel5';    //这个是读 xls的
      }else{
        $inputFileType = 'Excel2007';//这个是计xlsx的
      }   
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
      $objPHPExcel = $objReader->load($file['tmp_name']);

      $objWorksheet = $objPHPExcel->getActiveSheet();//取得总行数
      $highestRow = $objWorksheet->getHighestRow();//取得总列
 
      // $title = array('id','title','content','z_name','keyword','u_name');

      // $key = $title[$i];
      // $num = count($title);



      $newarr = array();       
      for ($row = 2;$row <= $highestRow;$row++){
        // for($i = 0;$i<$num;$i++){
          $arr['uniacid'] = $uniacid;
          $arr['id'] = $objWorksheet->getCellByColumnAndRow('0', $row)->getValue();
          $arr['title'] = $objWorksheet->getCellByColumnAndRow('3', $row)->getValue();
          $arr['content'] = trim($objWorksheet->getCellByColumnAndRow('4', $row)->getValue());
          $arr['z_name'] = $objWorksheet->getCellByColumnAndRow('5', $row)->getValue();
          $arr['keyword'] = trim($objWorksheet->getCellByColumnAndRow('7', $row)->getValue());
          $arr['u_name'] = $objWorksheet->getCellByColumnAndRow('8', $row)->getValue();
          $arr['created'] = time();
          $arr['status'] = "0";
          $arr['is_hot'] = '0';
        // }
        array_push($newarr,$arr);   
      } 
      $num = count($newarr);
      $each = 120;     // 数据总数
      $step = ceil( $num/$each);  // insert执行总次数
      for($j=0;$j<$step;$j++){
        $nextNum= $j*$each;
        $newarr1 = array_slice($newarr, $nextNum, $each);
        foreach ($newarr1 as $key => $value) {
          $res = pdo_insert('hyb_yl_answer',$value);
        }
      }
      message("导入成功!",$this->createWebUrl("ask",array("op"=>"askroom")),"success");
    }
    include $this->template("ask/import");
}
if($op == 'askchange')
{
  $id = $_GPC['id'];
  $status = $_GPC['status'];
  $is_hot = $_GPC['is_hot'];

  if($status != '')
  {
    $res = pdo_update("hyb_yl_answer",array("status"=>$status),array("id"=>$id));
  }
  if($is_hot != '')
  {
    $res = pdo_update("hyb_yl_answer",array("is_hot"=>$is_hot),array("id"=>$id));
  }

  if($res)
  {
    message("设置成功!",$this->createWebUrl("ask",array("op"=>"askroom")),"success");
  }else{
    message("设置失败!",$this->createWebUrl("ask",array("op"=>"askroom")),"error");
  }
  include $this->template("ask/askroom");
}
if($op == 'changes')
{
  $id = $_GPC['aid'];
  $type = $_GPC['type'];
  $labels = $_GPC['labels'];
  $keshi_one = $_GPC['keshi_one'];
  $keshi_two = $_GPC['parentid'];
  $res = pdo_update("hyb_yl_answer",array("label"=>$labels,"keshi_one"=>$keshi_one,"keshi_two"=>$keshi_two,'type'=>$type),array("id"=>$id));
  if($res)
  {
    message("设置成功!",$this->createWebUrl("ask",array("op"=>"askroom")),"success");
  }else{
    message("设置失败!",$this->createWebUrl("ask",array("op"=>"askroom")),"error");
  }
  include $this->template("ask/askroom");
}
if($op == 'askbiaoqian'){
  $biaoqian = $_GPC['biaoqian'];
  $res = pdo_getall("hyb_yl_label_library",array('uniacid'=>$uniacid),array('name'));
  include $this->template("ask/biaoqian");
}
//问题详情
if($op == 'askchat')
{
  $back_orser = $_GPC['back_orser'];
  $keyword = empty($_GPC['keyword']) ? 'tuwenwenzhen' : $_GPC['keyword'];
  if($keyword == 'tuwenwenzhen')
  {
      $list = pdo_fetchall("select t.*,z.z_name,z.advertisement,u.u_name,u.u_thumb from ".tablename("hyb_yl_twenorder")." as t left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=t.zid left join ".tablename("hyb_yl_userinfo")." as u on u.openid=t.openid where t.back_orser='".$back_orser."'");

      foreach($list as &$value)
      {
        $openid = $value['openid'];
        $value['content'] = unserialize($value['content']);
        $value['xdtime'] = date("Y-m-d H:i:s",$value['xdtime']);
        $value['user'] = pdo_get('hyb_yl_userjiaren',array('openid'=>$openid,'sick_index'=>0));
        if(strpos($value['advertisement'],'http') === false)
        {
          $value['advertisement'] = $_W['attachurl'].$value['advertisement'];
        }
      }

  }else if($keyword == 'shoushukuaiyue' || $keyword == 'dianhuajizhen' || $keyword == 'shipinwenzhen' || $keyword == 'tijianjiedu')
  {
    $list = pdo_fetchall("select t.*,z.z_name,z.advertisement,u.u_name,u.u_thumb from ".tablename("hyb_yl_wenzorder")." as t left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=t.zid left join ".tablename("hyb_yl_userinfo")." as u on u.openid=t.openid where t.back_orser='".$back_orser."'");
 
    foreach($list as &$value)
      {
        $openid = $value['openid'];
        $value['describe'] = unserialize($value['describe']);
        $value['time'] = date("Y-m-d H:i:s",$value['time']);
        $value['user'] = pdo_get('hyb_yl_userjiaren',array('openid'=>$openid,'sick_index'=>0));
        if(strpos($value['advertisement'],'http') === false)
        {
          $value['advertisement'] = $_W['attachurl'].$value['advertisement'];
        }
      }

  }else if($keyword == 'yuanchengkaifang'){
    $list = pdo_fetchall("select t.*,z.z_name,z.advertisement,u.u_name,u.u_thumb from ".tablename("hyb_yl_chufang")." as t left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=t.zid left join ".tablename("hyb_yl_userinfo")." as u on u.openid=t.useropenid where t.back_orser=".$back_orser);

      foreach($list as &$value)
        {
          $openid = $value['useropenid'];
          $value['content'] = unserialize($value['content']);
          $value['time'] = date("Y-m-d H:i:s",$value['time']);
          $value['user'] = pdo_get('hyb_yl_userjiaren',array('j_id'=>$value['j_id']));
          if(strpos($value['advertisement'],'http') === false)
          {
            $value['advertisement'] = $_W['attachurl'].$value['advertisement'];
          }

        }
     
  }
  $users = pdo_get("hyb_yl_userjiaren",array("j_id"=>$list[0]['j_id']));

  $user = pdo_get("hyb_yl_userinfo",array("openid"=>$list[0]['openid']));

  

  $jiaren = pdo_fetchall("select * from ".tablename("hyb_yl_userjiaren")." where uniacid=".$uniacid." and openid='".$list[0]['openid']."' and sick_index != 0");


	include $this->template("ask/askchat");
}
// 问诊回复
if($op == 'ask_huifu')
{
  $text = $_GPC['text'];
  
  $back_orser = $_GPC['back_orser'];
  $content = array(
    'text' => $text,
    'typedate' => '0',
    "upload_picture_list"=>''
  );
  $contents = serialize($content);
  $item = pdo_get("hyb_yl_twenorder",array("back_orser"=>$back_orser));
  $data = array(
    'uniacid' => $uniacid,
    "zid" => $item['zid'],
    "openid" => $item['openid'],
    "orders" => $item['orders'],
    "time" => date("H:i:s",time()),
    "content" => $contents,
    "type" => $item['type'],
    "cfstate" => $item['cfstate'],
    "j_id" => $item['j_id'],
    "money" => $item['money'],
    "ifgk" => $item['ifgk'],
    "ifpay" => $item['ifpay'],
    "back_orser" => $item['back_orser'],
    "pid" => $item['pid'],
    "role" => '1',
    "addnum" => $item['addnum'],
    "paytime" => $item['paytime'],
    "grade" => '2',
    "coupon_id" => $item['coupon_id'],
    "ifpay" => $item['ifpay'],
    "xdtime" => time(),
    "overtime" => $item['overtime'],
    "dumiao" => $_GPC['dumiao'],
  );
  $res = pdo_insert("hyb_yl_twenorder",$data);
  
}
//问题分类
if($op == 'asksort')
{

  $page = empty($_GPC['page']) ? "" : $_GPC['page'];
  $pageindex = max(1, intval($page));
  $pagesize = 10;
  $list = pdo_fetchall("select * from ".tablename("hyb_yl_answer_type")." where uniacid=".$uniacid." order by id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
  $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_answer_type")." where uniacid=".$uniacid);
  $pager = pagination($total, $pageindex, $pagesize);
	include $this->template("ask/asksort");
}

//问题分类
if($op == 'asksortadd')
{
  $id = $_GPC['id'];
  $item = pdo_get("hyb_yl_answer_type",array("id"=>$id));
  if($_W['ispost'])
  {
    $data = array(
      'uniacid' => $uniacid,
      "title" => $_GPC['title'],
      "thumb" => $_GPC['thumb'],
      "status" => $_GPC['status'],
    );
    if($id)
    {
      $res = pdo_update("hyb_yl_answer_type",$data,array("id"=>$id));
    }else{
      $data['created'] = time();
      $res = pdo_insert("hyb_yl_answer_type",$data);
    }
    if($res)
    {
      message("设置成功!",$this->createWebUrl("ask",array("op"=>"asksort")),"success");
    }else{
      message("设置失败!",$this->createWebUrl("ask",array("op"=>"asksort")),"error");

    }
  }
	include $this->template("ask/asksortadd");
}
// 问题分类删除
if($op == 'asksortdel')
{
  $id = $_GPC['id'];
  $res = pdo_delete("hyb_yl_answer_type",array("id"=>$id));
  if($res)
  {
    message("删除成功!",$this->createWebUrl("ask",array("op"=>"asksort")),"success");
  }else{
    message("删除失败!",$this->createWebUrl("ask",array("op"=>"asksort")),"error");

  }
  include $this->template("ask/asksort");
}
if($op=="entervideoorder"){
  $id = $_GPC['id'];
  $op = $_GPC['op'];
  $hid = $_GPC['hid'];
  pdo_update("hyb_yl_wenzorder",array('ifpay'=>1,'paytime'=>strtotime('now')),array('id'=>$id));
  message("确定付款成功!",$this->createWebUrl("ask",array("op"=>'videoask','ac'=>'telask','hid'=>$hid)),"success");
}
if($op=="entertelorder"){
  $id = $_GPC['id'];
  $op = $_GPC['op'];
  $hid = $_GPC['hid'];
  pdo_update("hyb_yl_wenzorder",array('ifpay'=>1,'paytime'=>strtotime('now')),array('id'=>$id));
  message("确定付款成功!",$this->createWebUrl("ask",array("op"=>'telask','ac'=>'telask','hid'=>$hid)),"success");
}
if($op=="entercforder"){
  $c_id = $_GPC['c_id'];
  $hid = $_GPC['hid'];
  pdo_update("hyb_yl_chufang",array('ispay'=>1,'paytime'=>strtotime('now')),array('c_id'=>$c_id));
  message("确定付款成功!",$this->createWebUrl("ask",array("op"=>"squareask",'ac'=>'squareask','hid'=>$hid)),"success");
}
if($op=="enterorder"){
  $id = $_GPC['id'];
  $hid = $_GPC['hid'];
  pdo_update("hyb_yl_twenorder",array('ifpay'=>1,'paytime'=>strtotime('now')),array('id'=>$id));
  message("确定付款成功!",$this->createWebUrl("ask",array("op"=>"asklist",'ac'=>'asklist','ifpay'=>-1,'hid'=>$hid)),"success");
}
if($op == 'deletetuwen'){
  $back_orser =$_GPC['back_orser'];
  pdo_delete("hyb_yl_twenorder",array('back_orser'=>$back_orser));
  pdo_delete('hyb_yl_answer',array('orders'=>$back_orser));
  $hid = $_GPC['hid'];
  message("删除成功!",$this->createWebUrl("ask",array("op"=>"asklist",'ac'=>'asklist','ifpay'=>'-1',"hid"=>$hid)),"success");
}
if($op == 'deletekaifang')
{
  $back_orser = $_GPC['back_orser'];
  $hid = $_GPC['hid'];
  $res = pdo_delete("hyb_yl_chufang",array("back_orser"=>$back_orser));
  pdo_delete('hyb_yl_answer',array('orders'=>$back_orser));
  if($res)
  {
    message("删除成功!",$this->createWebUrl("ask",array("op"=>"squareask",'ac'=>'squareask','hid'=>$hid)),"success");
  }else{
    message("删除失败!",$this->createWebUrl("ask",array("op"=>"squareask",'ac'=>'squareask','hid'=>$hid)),"error");

  }
}
if($op == 'deleteshipin')
{
  $back_orser = $_GPC['back_orser'];
  $hid = $_GPC['hid'];
  $res = pdo_delete("hyb_yl_wenzorder",array("back_orser"=>$back_orser));
  pdo_delete('hyb_yl_answer',array('orders'=>$back_orser));
  if($res)
  {
    message("删除成功!",$this->createWebUrl("ask",array("op"=>"videoask",'ac'=>'videoask','hid'=>$hid)),"success");
  }else{
    message("删除失败!",$this->createWebUrl("ask",array("op"=>"videoask",'ac'=>'videoask','hid'=>$hid)),"error");

  }
}

if($op == 'del_asklists')
{
  $ids = $_GPC['ids'];
  for($i=0;$i<count($ids);$i++)
  {
    $res = pdo_delete("hyb_yl_twenorder",array("back_orser" => $ids[$i]));
    
  }
  die(json_encode(array('errno'=>1,'message'=>1)));
}
if($op == 'del_telasks')
{
  $ids = $_GPC['ids'];
  for($i=0;$i<count($ids);$i++)
  {
    $res = pdo_delete("hyb_yl_wenzorder",array("back_orser" => $ids[$i]));
    
  }
  die(json_encode(array('errno'=>1,'message'=>1)));
}

if($op == 'del_squareaks')
{
  $ids = $_GPC['ids'];
  for($i=0;$i<count($ids);$i++)
  {
    $res = pdo_delete("hyb_yl_chufang",array("back_orser" => $ids[$i]));
    
  }
  die(json_encode(array('errno'=>1,'message'=>1)));
}

if($op == 'del_askrooms')
{
  $ids = $_GPC['ids'];
  for($i=0;$i<count($ids);$i++)
  {
    $res = pdo_delete("hyb_yl_answer",array("id" => $ids[$i]));
    
  }
  die(json_encode(array('errno'=>1,'message'=>1)));
}