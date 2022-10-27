<?php

global $_W,$_GPC;
$op = $_GPC['op'];
load()->func('tpl');
$uniacid =$_W['uniacid'];
load()->model('user');
load()->model('setting');
load()->model('message');
load()->classs('oauth2/oauth2client');
$hid = $_GPC['hid'];
$_W['hid'] = $hid;
$todayss = date("Y-m-d H:i:s",time());
$todays = strtotime(date("Y-m-d",time()));;
$yesterdays = mktime(0,0,0,date('m'),date('d')-1,date('Y'));
$sevens = mktime(0,0,0,date('m'),date('d')-7,date('Y'));
$monthse = mktime(0,0,0,date('m'),date('d')-30,date('Y'));
$zhuanjia = pdo_fetchall("select zid from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$hid);
$zids = '';
$name = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$hid),'agentname');
foreach($zhuanjia as &$zj)
{
	$zids = $zj['zid'].",";
}
$zids = substr($zids, 0,strlen($zids)-1);
// 今日支付金额
$today_tuwen_pay = pdo_fetchall("select sum(money) as money from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and ifpay!=0 and ifpay != 5 and ifpay != 6 and ifpay !=7 and ifpay !=8 and paytime>=".$todays." and zid in (".$zids.") group by back_orser");
$today_tuwen_pay = array_sum(array_map(function($val){return $val['money'];}, $today_tuwen_pay));

if(!$today_tuwen_pay)
{
  $today_tuwen_pay = '0.00';
}
$today_wenzhen_pay = pdo_fetchall("select sum(money) as money from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and ifpay!=0 and ifpay != 5 and ifpay != 6 and ifpay != 7 and ifpay !=8 and paytime>=".$todays." and zid in (".$zids.") group by back_orser");
$today_wenzhen_pay = array_sum(array_map(function($val){return $val['money'];}, $today_wenzhen_pay));

if(!$today_wenzhen_pay)
{
  $today_wenzhen_pay = '0.00';
}
$today_guahao_pay = pdo_fetchall("select sum(money) as money from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid." and ifpay!=0 and ifpay != 5 and ifpay != 6 and ifpay != 7 and ifpay !=8 and paytime>=".$todays." and zid in (".$zids.") group by back_orser");
$today_guahao_pay = array_sum(array_map(function($val){return $val['money'];}, $today_guahao_pay));

if(!$today_guahao_pay)
{
  $today_guahao_pay = '0.00';
}
$today_year_pay = pdo_fetchall("select sum(money) as money from ".tablename("hyb_yl_user_yearcard")." where uniacid=".$uniacid." and status=1 and created>=".$todays." and zid in (".$zids.")");
$today_year_pay = array_sum(array_map(function($val){return $val['money'];}, $today_year_pay));

if(!$today_year_pay)
{
  $today_year_pay = '0.00';
}
$today['pay_money'] = $today_tuwen_pay + $today_tuwen_pay + $today_guahao_pay + $today_year_pay;
// 昨日支付金额
$yes_tuwen_pay = pdo_fetchall("select sum(money) as money from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and ifpay!=0 and ifpay != 5 and ifpay != 6 and ifpay !=7 and ifpay !=8 and paytime>=".$sevens." and paytime <=".$todays." and zid in (".$zids.") group by back_orser");
$yes_tuwen_pay = array_sum(array_map(function($val){return $val['money'];}, $yes_tuwen_pay));

if(!$yes_tuwen_pay)
{
  $yes_tuwen_pay = '0.00';
}
$yes_wenzhen_pay = pdo_fetchall("select sum(money) as money from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and ifpay!=0 and ifpay != 5 and ifpay != 6 and ifpay != 7 and ifpay !=8 and paytime>=".$yesterdays." and paytime <=".$todays." and zid in (".$zids.") group by back_orser");
$yes_wenzhen_pay = array_sum(array_map(function($val){return $val['money'];}, $yes_wenzhen_pay));

if(!$yes_wenzhen_pay)
{
  $yes_wenzhen_pay = '0.00';
}
$yes_guahao_pay = pdo_fetchall("select sum(money) as money from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid." and ifpay!=0 and ifpay != 5 and ifpay != 6 and ifpay != 7 and ifpay !=8 and paytime>=".$yesterdays." and paytime <=".$todays." and zid in (".$zids.") group by back_orser");
$yes_guahao_pay = array_sum(array_map(function($val){return $val['money'];}, $yes_guahao_pay));

if(!$yes_guahao_pay)
{
  $yes_guahao_pay = '0.00';
}
$yes_year_pay = pdo_fetchall("select sum(money) as money from ".tablename("hyb_yl_user_yearcard")." where uniacid=".$uniacid." and status=1 and created>=".$yesterdays." and created <=".$todays." and zid in (".$zids.")");
$yes_year_pay = array_sum(array_map(function($val){return $val['money'];}, $yes_year_pay));

if(!$yes_year_pay)
{
  $yes_year_pay = '0.00';
}
$yes['pay_money'] = $yes_tuwen_pay + $yes_tuwen_pay + $yes_guahao_pay + $yes_year_pay; 
// 七日付款金额
$seven_tuwen_pay = pdo_fetchall("select sum(money) as money from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and ifpay!=0 and ifpay != 5 and ifpay != 6 and ifpay !=7 and ifpay !=8 and paytime>=".$sevens." and paytime <=".$todays." and zid in (".$zids.") group by back_orser");
$seven_tuwen_pay = array_sum(array_map(function($val){return $val['money'];}, $seven_tuwen_pay));

if(!$seven_tuwen_pay)
{
  $seven_tuwen_pay = '0.00';
}
$seven_wenzhen_pay = pdo_fetchall("select sum(money) as money from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and ifpay!=0 and ifpay != 5 and ifpay != 6 and ifpay != 7 and ifpay !=8 and paytime>=".$sevens." and paytime <=".$todays." and zid in (".$zids.") group by back_orser");
$seven_wenzhen_pay = array_sum(array_map(function($val){return $val['money'];}, $seven_wenzhen_pay));

if(!$seven_wenzhen_pay)
{
  $seven_wenzhen_pay = '0.00';
}
$seven_guahao_pay = pdo_fetchall("select sum(money) as money from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid." and ifpay!=0 and ifpay != 5 and ifpay != 6 and ifpay != 7 and ifpay !=8 and paytime>=".$sevens." and paytime <=".$todays." and zid in (".$zids.") group by back_orser");
$seven_guahao_pay = array_sum(array_map(function($val){return $val['money'];}, $seven_guahao_pay));

if(!$seven_guahao_pay)
{
  $seven_guahao_pay = '0.00';
}
$seven_year_pay = pdo_fetchall("select sum(money) as money from ".tablename("hyb_yl_user_yearcard")." where uniacid=".$uniacid." and status=1 and created>=".$sevens." and created <=".$todays." and zid in (".$zids.")");
$seven_year_pay = array_sum(array_map(function($val){return $val['money'];}, $seven_year_pay));

if(!$seven_year_pay)
{
  $seven_year_pay = '0.00';
}
$seven['pay_money'] = $seven_tuwen_pay + $seven_tuwen_pay + $seven_guahao_pay + $seven_year_pay; 

// 一个月之内付款金额
$monthss_tuwen_pay = pdo_fetchall("select sum(money) as money from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and ifpay!=0 and ifpay != 5 and ifpay != 6 and ifpay !=7 and ifpay !=8 and paytime>=".$monthse." and paytime <=".$todays." and zid in (".$zids.") group by back_orser");
$monthss_tuwen_pay = array_sum(array_map(function($val){return $val['money'];}, $monthss_tuwen_pay));

if(!$monthss_tuwen_pay)
{
  $monthss_tuwen_pay = '0.00';
}
$monthss_wenzhen_pay = pdo_fetchall("select sum(money) as money from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and ifpay!=0 and ifpay != 5 and ifpay != 6 and ifpay != 7 and ifpay !=8 and paytime>=".$monthse." and paytime <=".$todays." and zid in (".$zids.") group by back_orser");
$monthss_wenzhen_pay = array_sum(array_map(function($val){return $val['money'];}, $monthss_wenzhen_pay));

if(!$monthss_wenzhen_pay)
{
  $monthss_wenzhen_pay = '0.00';
}
$monthss_guahao_pay = pdo_fetchall("select sum(money) as money from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid." and ifpay!=0 and ifpay != 5 and ifpay != 6 and ifpay != 7 and ifpay !=8 and paytime>=".$monthse." and paytime <=".$todays." and zid in (".$zids.") group by back_orser");
$monthss_guahao_pay = array_sum(array_map(function($val){return $val['money'];}, $monthss_guahao_pay));

if(!$monthss_guahao_pay)
{
  $monthss_guahao_pay = '0.00';
}
$monthss_year_pay = pdo_fetchall("select sum(money) as money from ".tablename("hyb_yl_user_yearcard")." where uniacid=".$uniacid." and status=1 and created>=".$monthse." and created <=".$todays." and zid in (".$zids.")");
$monthss_year_pay = array_sum(array_map(function($val){return $val['money'];}, $monthss_year_pay));

if(!$monthss_year_pay)
{
  $monthss_year_pay = '0.00';
}
$monthss['pay_money'] = $monthss_tuwen_pay + $monthss_tuwen_pay + $monthss_guahao_pay + $monthss_year_pay;
// 今日退款金额
$today_twround_money = pdo_fetchall("select sum(money) as money from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and ifpay=6 and paytime>=".$yesterdays." and paytime <=".$todays." and zid in (".$zids.") group by back_orser");
$today_twround_money = array_sum(array_map(function($val){return $val['money'];}, $today_twround_money));

if(!$today_twround_money)
{
  $today_twround_money = '0.00';
}
$today_wzround_pay = pdo_fetchall("select sum(money) as money from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and ifpay=6 and paytime>=".$yesterdays." and paytime <=".$todays." and zid in (".$zids.") group by back_orser");
$today_wzround_pay = array_sum(array_map(function($val){return $val['money'];}, $today_wzround_pay));

if(!$today_wzround_pay)
{
  $today_wzround_pay = '0.00';
}
$today_ghround_pay = pdo_fetchall("select sum(money) as money from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid." and ifpay=6 and paytime>=".$yesterdays." and paytime <=".$todays." and zid in (".$zids.") group by back_orser");
$today_ghround_pay = array_sum(array_map(function($val){return $val['money'];}, $today_ghround_pay));

if(!$today_ghround_pay)
{
  $today_ghround_pay = '0.00';
}
$today_round_money = $today_twround_money + $today_wzround_pay + $today_ghround_pay;
// 昨日退款金额
$yes_twround_money = pdo_fetchall("select sum(money) as money from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and ifpay=6 and paytime>=".$yesterdays." and paytime <=".$todays." and zid in (".$zids.") group by back_orser");
$yes_twround_money = array_sum(array_map(function($val){return $val['money'];}, $yes_twround_money));

if(!$yes_twround_money)
{
  $yes_twround_money = '0.00';
}
$yes_wzround_pay = pdo_fetchall("select sum(money) as money from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and ifpay=6 and paytime>=".$yesterdays." and paytime <=".$todays." and zid in (".$zids.") group by back_orser");
$yes_wzround_pay = array_sum(array_map(function($val){return $val['money'];}, $yes_wzround_pay));

if(!$yes_wzround_pay)
{
  $yes_wzround_pay = '0.00';
}
$yes_ghround_pay = pdo_fetchall("select sum(money) as money from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid." and ifpay=6 and paytime>=".$yesterdays." and paytime <=".$todays." and zid in (".$zids.") group by back_orser");
$yes_ghround_pay = array_sum(array_map(function($val){return $val['money'];}, $yes_ghround_pay));

if(!$yes_ghround_pay)
{
  $yes_ghround_pay = '0.00';
}
$yes_round = $yes_twround_money + $yes_wzround_pay + $yes_ghround_pay;

$today_zhuanjia = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and opentime >=".$todays);
$yes_zhuanjia = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and opentime >=".$yesterdays." and opentime <=".$todays);

$today_tw_num = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and xdtime>=".$todays." and ifpay=1 and zid in (".$zids.") group by back_orser");
$today_tw_num = count($today_tw_num);
$today_wz_num = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and xdtime>=".$todays." and ifpay=1 and zid in (".$zids.")  group by back_orser");
$today_wz_num = count($today_wz_num);

$today_gh_num = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid." and time>=".$todays." and ifpay=1 and zid in (".$zids.") group by back_orser");
$today_gh_num = count($today_gh_num);

$today_year_num = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_user_yearcard")." where uniacid=".$uniacid." and created>=".$todays." and status=1 and zid in (".$zids.")");

$today_num = $today_gh_num + $today_tw_num + $today_wz_num + $today_year_num;

$yes_tw_num = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and xdtime>=".$yesterdays." and xdtime <=".$todays." and ifpay=1 and zid in (".$zids.") group by back_orser");
$yes_tw_num = count($yes_tw_num);
$yes_wz_num = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid." and xdtime>=".$yesterdays." and xdtime <=".$todays." and ifpay=1 and zid in (".$zids.")  group by back_orser");
$yes_wz_num = count($yes_wz_num);

$yes_gh_num = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid." and time>=".$yesterdays." and time <=".$todays." and ifpay=1 and zid in (".$zids.") group by back_orser");
$yes_gh_num = count($yes_gh_num);

$yes_year_num = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_user_yearcard")." where uniacid=".$uniacid." and created>=".$yesterdays." and created <=".$todays." and status=1 and zid in (".$zids.")");

$yes_num = $yes_gh_num + $yes_tw_num + $yes_wz_num + $yes_year_num;

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
		$condition = " where uniacid=".$uniacid." and time >=:starttime and time <=:endtime";
		$params = array(':starttime' => strtotime($time . ' 00:00:00'), ':endtime' => strtotime($time . ' 23:59:59'));
		$wenzorder = pdo_fetchall("select sum(money) as money from ".tablename("hyb_yl_wenzorder").$condition." group by back_orser",$params);
		$wenzorder = array_sum(array_map(function($val){return $val['money'];}, $wenzorder));
      	if(!$wenzorder)
      	{
        	$wenzorder = '0';
      	}
		$twenorder = pdo_fetchall("select sum(money) as money from ".tablename("hyb_yl_twenorder").$condition." group by back_orser",$params);
		$twenorder = array_sum(array_map(function($val){return $val['money'];}, $twenorder));
      	if(!$twenorder)
      	{
        	$twenorder = '0';
      	}
		$guahaoorder = pdo_fetchall("select sum(money) as money from ".tablename("hyb_yl_guahaoorder").$condition." group by back_orser",$params);
		$guahaoorder = array_sum(array_map(function($val){return $val['money'];}, $guahaoorder));
      	if(!$guahaoorder)
      	{
        	$guahaoorder = '0';
      	}
		
		$datas[] = array(
			'date' => $time, 
			'wenzorder' => $wenzorder,
			'twenorder' => $twenorder,
			'guahaoorder' => $guahaoorder
		);
		--$i;
	}

}
else {
	if (!empty($year) && !empty($month)) {
		$charttitle = $year . '年' . $month . '月增长趋势图';
		
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
			$condition = " where uniacid=".$uniacid." and time >=:starttime and time <=:endtime";
			$params = array(':starttime' => strtotime($time . ' 00:00:00'), ':endtime' => strtotime($time . ' 23:59:59'));
			$wenzorder = pdo_fetchall("select sum(money) as money from ".tablename("hyb_yl_wenzorder").$condition." group by back_orser",$params);
			$wenzorder = array_sum(array_map(function($val){return $val['money'];}, $wenzorder));
	      	if(!$wenzorder)
	      	{
	        	$wenzorder = '0';
	      	}
			$twenorder = pdo_fetchall("select sum(money) as money from ".tablename("hyb_yl_twenorder").$condition." group by back_orser",$params);
			$twenorder = array_sum(array_map(function($val){return $val['money'];}, $twenorder));
	      	if(!$twenorder)
	      	{
	        	$twenorder = '0';
	      	}
			$guahaoorder = pdo_fetchall("select sum(money) as money from ".tablename("hyb_yl_guahaoorder").$condition." group by back_orser",$params);
			$guahaoorder = array_sum(array_map(function($val){return $val['money'];}, $guahaoorder));
	      	if(!$guahaoorder)
	      	{
	        	$guahaoorder = '0';
	      	}
	      	$datas[] = array(
				'date' => $d . '日', 
				'wenzorder' => $wenzorder,
				'twenorder' => $twenorder,
				'guahaoorder' => $guahaoorder
			);
			
			++$d;
		}
	}
	else {
		if (!empty($year)) {
			$charttitle = $year . '年增长趋势图';

			foreach ($months as $m) {
				// $lastday = $this->get_last_day($year, $m['data']);
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
			    $condition = " where uniacid=".$uniacid." and time >=:starttime and time <=:endtime";
				$params = array(':starttime' => strtotime($time . ' 00:00:00'), ':endtime' => strtotime($time . ' 23:59:59'));
				$wenzorder = pdo_fetchall("select sum(money) as money from ".tablename("hyb_yl_wenzorder").$condition." group by back_orser",$params);
				$wenzorder = array_sum(array_map(function($val){return $val['money'];}, $wenzorder));
		      	if(!$wenzorder)
		      	{
		        	$wenzorder = '0';
		      	}
				$twenorder = pdo_fetchall("select sum(money) as money from ".tablename("hyb_yl_twenorder").$condition." group by back_orser",$params);
				$twenorder = array_sum(array_map(function($val){return $val['money'];}, $twenorder));
		      	if(!$twenorder)
		      	{
		        	$twenorder = '0';
		      	}
				$guahaoorder = pdo_fetchall("select sum(money) as money from ".tablename("hyb_yl_guahaoorder").$condition." group by back_orser",$params);
				$guahaoorder = array_sum(array_map(function($val){return $val['money'];}, $guahaoorder));
		      	if(!$guahaoorder)
		      	{
		        	$guahaoorder = '0';
		      	}
		      	$datas[] = array(
					'date' => $m['data'] . '月', 
					'wenzorder' => $wenzorder,
					'twenorder' => $twenorder,
					'guahaoorder' => $guahaoorder
				);
				
			}
		}
	}
}

include $this->template('dashboard/index');



