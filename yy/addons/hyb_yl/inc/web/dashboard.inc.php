<?php
global $_W,$_GPC;
$op = $_GPC['op'];
$uniacid = $_W['uniacid'];
$_W['plugin'] = 'dashboard';

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
 

if($op == "gk")
{
	$todayss = date("Y-m-d H:i:s",time());
	$todays = strtotime(date("Y-m-d",time()));;
    $yesterdays = mktime(0,0,0,date('m'),date('d')-1,date('Y'));
    $sevens = mktime(0,0,0,date('m'),date('d')-7,date('Y'));
    $monthse = mktime(0,0,0,date('m'),date('d')-30,date('Y'));

    // 七日访客
    $seven['visit'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_visit")." where uniacid=".$uniacid." and type=0 and created >=".$sevens);
   	// 三十天访客
   	$monthss['visit'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_visit")." where uniacid=".$uniacid." and type=0 and created >=".$monthse);
   	
   	
    // 今天数据
    //访客
	$today['visit'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_visit")." where uniacid=".$uniacid." and type=0 and created >=".$todays);

	// 动态
	$today['dongtai'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_share")." where uniacid=".$uniacid." and times >=".$todays);
	$zhuanjia = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and opentime>=".$todays);
	// 患教
	$today['education'] = '0';
	// 入驻数
	$today['setting'] = '0';
	// 新增药品
	if(is_agent == '1')
	{
		$today['goods'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsarr")." where uniacid=".$uniacid." and (jigou_one=".$hospital['hid']." or jigou_two=".$hospital['hid'].") and date >=".date("Y-m-d",$todays));
	}else{
		$today['goods'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsarr")." where uniacid=".$uniacid." and date >=".date("Y-m-d",$todays));
	}
	// 新增药品
	// $today['goods'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsarr")." where uniacid=".$uniacid." and date >=".date("Y-m-d",$todays));
	// 处方
	if(is_agent == '1')
	{
		$today['chufang'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid." and zid in (".$zjs.") and time >=".$todays);
	}else{
		$today['chufang'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_chufang")." where uniacid=".$uniacid." and time >=".$todays);
	}
	
	// 待审核动态
	$today['shenhe_dongdai'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_share")." where uniacid=".$uniacid." and type=0 and times >=".$todays);
	// 待审核患教
	$today['shenhe_education'] = '0';
	// 优惠券
	$today['coupon'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_coupon_code")." where uniacid=".$uniacid." and createtime>='".date("Y-m-d H:i:s",$todays)."'");
	
	// 昨日数据
	$yesterday['visit'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_visit")." where uniacid=".$uniacid." and type=0 and created >=".$yesterdays." and created <=".$todays);
	$yesterday['dongtai'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_share")." where uniacid=".$uniacid." and times >=".$yesterdays." and times <=".$todays);
	if(is_agent == '1')
	{
		$zhuanjias = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and opentime>=".$yesterdays." and opentime <=".$todays." and zid in (".$zjs.")");
	}else{
		$zhuanjias = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and opentime>=".$yesterdays." and opentime <=".$todays);
	}
	
	$yesterday['education'] = '0';
	$yesterday['setting'] = '0';
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
			$condition = '  uniacid=:uniacid and created>=:starttime and created<=:endtime and type =0';
			$params = array(':uniacid' => $_W['uniacid'], ':starttime' => strtotime($time . ' 00:00:00'), ':endtime' => strtotime($time . ' 23:59:59'));
			$datas[] = array('date' => $time, 'mcount' => pdo_fetchcolumn('select count(*) from ' . tablename('hyb_yl_visit') . (' where   ' . $condition), $params));
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
				$condition = '  uniacid=:uniacid and created>=:starttime and created<=:endtime and type =0';
				$params = array(':uniacid' => $_W['uniacid'], ':starttime' => strtotime($year . '-' . $month . '-' . $d . ' 00:00:00'), ':endtime' => strtotime($year . '-' . $month . '-' . $d . ' 23:59:59'));
				$datas[] = array('date' => $d . '日', 'mcount' => pdo_fetchcolumn('select count(*) from ' . tablename('hyb_yl_visit') . (' where   ' . $condition), $params));
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
					$condition = '  uniacid=:uniacid and created>=:starttime and created<=:endtime and type =0';
					$params = array(':uniacid' => $_W['uniacid'], ':starttime' => strtotime($year . '-' . $m['data'] . '-01 00:00:00'), ':endtime' => strtotime($year . '-' . $m['data'] . '-' . $lastday . ' 23:59:59'));
					$datas[] = array('date' => $m['data'] . '月', 'mcount' => pdo_fetchcolumn('select count(*) from ' . tablename('hyb_yl_visit') . (' where   ' . $condition), $params));
				}
			}
		}
	}

	include $this->template("index");
}
//推广概况
if($op == "tggk"){
	$todayss = date("Y-m-d H:i:s",time());
	$todays = strtotime(date("Y-m-d",time()));;
    $yesterdays = mktime(0,0,0,date('m'),date('d')-1,date('Y'));
    $sevens = mktime(0,0,0,date('m'),date('d')-7,date('Y'));
    $monthss = mktime(0,0,0,date('m'),date('d')-30,date('Y'));
    $today['people'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_userinfo")." where uniacid=".$uniacid." and zctime>='".date("Y-m-d H:i:s",$todays)."'");
    
    $today['zhuangjia'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and opentime>=".$todays);
    $today['jigou'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_hospital")." where uniacid=".$uniacid." and created >=".$todays);
    $today['tuike'] = '0';
    $today['tuike_order'] = '0';
    $today['vip'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_userinfo")." where uniacid=".$uniacid." and adminoptime>=".$todays);
    $today['team_user'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_teamorder")." where uniacid=".$uniacid." and ifpay=1 and created>=".$todays);
    $today['team'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_team")." where uniacid=".$uniacid." and created>=".$todays);

    $today['tixian_order'] = '0';

    $yesterday['people'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_userinfo")." where uniacid=".$uniacid." and zctime>=".$yesterdays." and zctime <=".$todays);
    $yesterday['zhuangjia'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and opentime>=".$yesterdays." and opentime <=".$todays);
    $yesterday['jigou'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_hospital")." where uniacid=".$uniacid." and created >=".$yesterdays." and opentime <=".$todays);

    $yesterday['tuike'] = '0';
    $yesterday['tuike_order'] = '0';
    $yesterday['vip'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_userinfo")." where uniacid=".$uniacid." and adminoptime>=".$yesterdays." and adminoptime <=".$todays);
    $today['team_user'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_teamorder")." where uniacid=".$uniacid." and ifpay=1 and created>=".$yesterdays." and created<=".$todays);
    $yesterday['team'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_team")." where uniacid=".$uniacid." and created>=".$yesterdays." and created<=".$todays);

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
			$condition = '  uniacid=:uniacid and created>=:starttime and created<=:endtime';
			$params = array(':uniacid' => $_W['uniacid'], ':starttime' => strtotime($time . ' 00:00:00'), ':endtime' => strtotime($time . ' 23:59:59'));
			$datas[] = array('date' => $time, 'mcount' => pdo_fetchcolumn('select count(*) from ' . tablename('hyb_yl_visit') . (' where   ' . $condition), $params));
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
				$condition = '  uniacid=:uniacid and created>=:starttime and created<=:endtime';
				$params = array(':uniacid' => $_W['uniacid'], ':starttime' => strtotime($year . '-' . $month . '-' . $d . ' 00:00:00'), ':endtime' => strtotime($year . '-' . $month . '-' . $d . ' 23:59:59'));
				$datas[] = array('date' => $d . '日', 'mcount' => pdo_fetchcolumn('select count(*) from ' . tablename('hyb_yl_visit') . (' where   ' . $condition), $params));
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
					$condition = '  uniacid=:uniacid and created>=:starttime and created<=:endtime';
					$params = array(':uniacid' => $_W['uniacid'], ':starttime' => strtotime($year . '-' . $m['data'] . '-01 00:00:00'), ':endtime' => strtotime($year . '-' . $m['data'] . '-' . $lastday . ' 23:59:59'));
					$datas[] = array('date' => $m['data'] . '月', 'mcount' => pdo_fetchcolumn('select count(*) from ' . tablename('hyb_yl_visit') . (' where   ' . $condition), $params));
				}
			}
		}
	}
    // $today['tuike'] = pdo_fetchcolumn("select count(*) from ".tablename())
   include $this->template("tggk");
}
//订单概况
if($op == "orderarea"){
	
	$todayss = date("Y-m-d H:i:s",time());
	$todays = strtotime(date("Y-m-d",time()));;
    $yesterdays = mktime(0,0,0,date('m'),date('d')-1,date('Y'));
    $sevens = mktime(0,0,0,date('m'),date('d')-7,date('Y'));
    $monthse = mktime(0,0,0,date('m'),date('d')-30,date('Y'));
    $tj_where = " where uniacid=".$uniacid." and time>=".$todays;
    if(is_agent == '1')
    {
    	$tj_where .= " and zid in (".$zjs.")";
    }

    $today['tijian_order'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tijianorder").$tj_where." group by ordernums");
    if(!$today['tijian_order'])
    {
    	$today['tijian_order'] = '0';
    }
    
    $today['goods_order'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid." and createTime>=".$todays);
	$gh_where = " where uniacid=".$uniacid." and created>=".$todays;
	if(is_agent == '1')
	{
		$gh_where .= " and zid in (".$zjs.")";
	}
    $today['guahao_order'] = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder").$gh_where." group by back_orser");
    $today['guahao_order'] = count($today['guahao_order']);
    $today['daozheng_order'] = '0';
    $wz_where = " where uniacid=".$uniacid." and time>=".$todays." and (keywords ='dianhuajizhen' or keywords = 'shipinwenzhen')";
    if(is_agent == '1')
    {
    	$wz_where .= " and zid in (".$zjs.")";
    }
    $wenzorder = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder").$wz_where." group by back_orser");
    $wenzorder = count($wenzorder);
    $tw_where =" where uniacid=".$uniacid." and xdtime >=".$todays;
    if(is_agent == '1')
    {
    	$tw_where .= " and zid in (".$zjs.")";
    }
    $twenorder = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_twenorder").$tw_where." group by back_orser");
    $today['wenzorder'] = $wenzorder + $twenorder;
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
    $today['qianyue_order'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_teamorder")." where uniacid=".$uniacid." and created >=".$todays." group by back_orser");
    if(!$today['qianyue_order'])
    {
    	$today['qianyue_order'] = '0';
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
    $wz_where = " where uniacid=".$uniacid." and ifpay=0 and time >=".$todays;
    if(is_agent == '1')
    {
    	$wz_where .= " and zid in (".$zid.")";
    }
    $pay_wenzhen = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder").$wz_where." group by back_orser");
    $pay_wenzhen = count($pay_wenzhen);
    $pay_tijian = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and ifpay=0 and time >=".$todays." group by ordernums");
    $tw_where = " where uniacid=".$uniacid." and ifpay=0 and xdtime >=".$todays;
    if(is_agent == '1')
    {
    	$tw_where .= " and zid in (".$zid.")";
    }
    $pay_tuwen = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder").$tw_where." group by back_orser");
    $pay_tuwen = count($pay_tuwen);
    $pay_goods = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid." and isPay=0 and createTime>=".date("Y-m-d H:i:s",$todays));
    $gh_where = " where uniacid=".$uniacid." and is_pay=0 and created>=".$todays;
    if(is_agent == '1')
    {
    	$gh_where .= " and zid in (".$zid.")";
    }
    $pay_guahao = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder").$gh_where." group by back_orser");
    $pay_guahao = count($pay_guahao);
    $cf_where = " where uniacid=".$uniacid." and ispay=1 and time>=".$todays;
    if(is_agent == '1')
    {
    	$ch_where .= " and zid in (".$zjs.")";
    }
    $pay_chufang = pdo_fetchall("select count(*) from ".tablename("hyb_yl_chufang").$ch_where." group by back_orser");
    $pay_chufang = count($pay_chufang);

    $pay_qianyue = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_teamorder")." where uniacid=".$uniacid." and ifpay=0 and created>=".$todays);
    
    $pay_yuyue = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_yuyueorder")." where uniacid=".$uniacid." and is_pay=0 and created>=".$todays);
    $today['pay_order'] = $pay_wenzhen + $pay_tijian + $pay_tuwen + $pay_goods + $pay_guahao + $pay_qianyue + $pay_yuyue + $pay_chufang;
    $wz_where = " where uniacid=".$uniacid." and ifpay=1 and time >=".$todays;
    if(is_agent == '1')
    {
    	$wz_where .= " and zid in (".$zjs.")";
    }
    $jie_wenzhen = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder").$wz_where." group by back_orser");
    $jie_wenzhen = count($jie_wenzhen);

    $jie_tijian = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and ifpay=1 and time >=".$todays." group by ordernums");
    $tw_where = " where uniacid=".$uniacid." and ifpay=1 and xdtime >=".$todays;
    if(is_agent == '1')
    {
    	$tw_where .= " and zid in (".$zjs.")";
    }
    $jie_tuwen = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder").$tw_where." group by back_orser");
    $jie_tuwen = count($jie_tuwen);
    $gh_where = " where uniacid=".$uniacid." and is_pay=1 and status=1 and created>=".$todays;
    if(is_agent == '1')
    {
    	$gh_where .= " and zid in (".$zjs.")";
    }
    $jie_guahao = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder").$gh_where." group by back_orser");
    $jie_guahao = count($jie_guahao);
    $jie_qianyue = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_teamorder")." where uniacid=".$uniacid." and ifpay=1 and paytime>=".$todays);
    $cf_where = " where uniacid=".$uniacid." and ispay=1 and paytime>=".$todays;
    if(is_agent == '1')
    {
    	$cf_where .= " and zid in (".$zjs.")";
    }
    $jie_chufang = pdo_fetchall("select count(*) from ".tablename("hyb_yl_chufang").$cf_where." group by back_orser");
    $jie_chufang = count($jie_chufang);
    $jie_yuyue = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_yuyueorder")." where uniacid=".$uniacid." and is_pay=1 and status=0 and created>=".$todays);
    $today['jie_order'] = $jie_wenzhen + $jie_tijian + $jie_tuwen + $jie_guahao + $jie_qianyue + $jie_yuyue + $jie_chufang;
    $wz_where = " where uniacid=".$uniacid." and (ifpay=3 or ifpay =4 or ifpay=6 or ifpay=7) and time >=".$todays;
    if(is_agent == '1')
    {
    	$wz_where .= " and zid in (".$zjs.")";
    }
    $over_wenzhen = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder").$wz_where." group by back_orser");
    $over_wenzhen = count($over_wenzhen);
    $over_tijian = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and (ifpay=3 or ifpay=5) and time >=".$todays." group by ordernums");
    $tw_where = " where uniacid=".$uniacid." and (ifpay=3 or ifpay =4 or ifpay=6 or ifpay=7) and xdtime >=".$todays;
    if(is_agent == '1')
    {
    	$tw_where .= " and zid in (".$zjs.")";
    }
    $over_tuwen = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder").$tw_where." group by back_orser");
    $over_tuwen = count($over_tuwen);
    $over_goods = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid." and (orderStatus=-1 or orderStatus=2) and createTime>=".date("Y-m-d H:i:s",$todays));
    $gh_where = " where uniacid=".$uniacid." and (status=3 or status=4 or status =5) and created>=".$todays;
    if(is_agent == '1')
    {
    	$gh_where .= " and zid in (".$zjs.")";
    }
    $over_guahao = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder").$gh_where." group by back_orser");
    $over_guahao = count($over_guahao);
    $cf_where = " where uniacid=".$uniacid." and (ispay=3 or ispay =4 or ispay=6 or ispay=7) and paytime >=".$todays;
    if(is_agent == '1')
    {
    	$cf_where .= " and zid in (".$zjs.")";
    }
    $over_chufang = pdo_fetchall("select count(*) from ".tablename("hyb_yl_chufang").$cf_where." group by back_orser");
    $over_chufang = count($over_chufang);
    $over_qianyue = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_teamorder")." where uniacid=".$uniacid." (ifpay=3 or ifpay =4 or ifpay=6 or ifpay=7) and paytime>=".$todays);
    $over_yuyue = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_yuyueorder")." where uniacid=".$uniacid." and is_pay=1 and (status=2 or status=3) and created>=".$todays);
    $today['over_order'] = $over_wenzhen + $over_tijian + $over_tuwen + $over_goods + $over_guahao + $over_qianyue + $over_yuyue + $over_chufang;
    $wz_where = " where uniacid=".$uniacid." and (ifpay=5 or ifpay=6) and apply_time >=".$todays;
    if(is_agent == '1')
    {
    	$wz_where .= " and zid in (".$zjs.")";
    }
    $refund_wenzhen = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder").$wz_where." group by back_orser");
    $refund_wenzhen = count($refund_wenzhen);
    $tw_where = " where uniacid=".$uniacid." and (ifpay=3 or ifpay =4 or ifpay=6 or ifpay=7) and xdtime >=".$todays;
    if(is_agent == '1')
    {
    	$tw_where .= " and zid in (".$zjs.")";
    }
    $refund_tuwen = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder").$tw_where);
    $refund_tuwen = count($refund_tuwen);
    $refund_goods = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid." and isRefund=1 and createTime>=".date("Y-m-d H:i:s",$todays));
    $refund_qianyue = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_teamorder")." where uniacid=".$uniacid." (ifpay=3 or ifpay =4 or ifpay=6 or ifpay=7) and t_time>=".$todays);
    $refund_yuyue = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_yuyueorder")." where uniacid=".$uniacid." and is_pay=1 and (status=2 or status=3) and created>=".$todays);
    $today['refund_order'] = $refund_wenzhen + $refund_tuwen + $refund_goods + $refund_qianyue + $refund_yuyue;
    $wz_where = " where uniacid=".$uniacid." and ifpay=6 and xdtime >=".$todays;
    if(is_agent == '1')
    {
    	$wz_where .= " and zid in (".$zjs.")";
    }
    $yitui_wenzhen = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder").$wz_where." group by back_orser");
    $yitui_wenzhen = count($yitui_wenzhen);
    $tw_where = " where uniacid=".$uniacid." and ifpay=6 and xdtime >=".$todays;
    if(is_agent == '1')
    {
    	$tw_where .= " and zid in (".$zjs.")";
    }
    $yitui_tuwen = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder").$tw_where." group by back_orser");
    $yitui_tuwen = count($yitui_tuwen);
    $yitui_goods = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid." and isRefund=1 and createTime>=".date("Y-m-d H:i:s",$todays));
    $yitui_qianyue = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_teamorder")." where uniacid=".$uniacid." ifpay=4 and t_time>=".$todays);
    $today['yitui_order'] = $yitui_wenzhen + $yitui_tuwen + $refund_goods + $refund_qianyue;


    $yesterday['tijian_order'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and time>=".$yesterdays." and time <=".$todays." group by ordernums");
    if(!$yesterday['tijian_order'])
    {
    	$yesterday['tijian_order'] = '0';
    }
    $yesterday['goods_order'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid." and createTime>=".$yesterdays." and createTime <= ".$todays);
    $gh_where = " where uniacid=".$uniacid." and created>=".$yesterdays." and created <=".$todays;
    if(is_agent)
    {
    	$gh_where .= " and zid in (".$zjs.")";
    }
    $yesterday['guahao_order'] = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder").$gh_where." group by back_orser");
    $yesterday['guahao_order'] = count($yesterday['guahao_order']);
    $yesterday['daozheng_order'] = '0';
    $wz_where = " where uniacid=".$uniacid." and time>=".$yesterdays." and time <=".$todays." and (keywords ='dianhuajizhen' or keywords = 'shipinwenzhen')";
    $tw_where = " where uniacid=".$uniacid." and xdtime >=".$yesterdays." and xdtime<=".$todays;
    if(is_agent)
    {
    	$wz_where .= " and zid in (".$zjs.")";
    	$tw_where .= " and zid in (".$zjs.")";
    }
    $wenzorder = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder").$wz_where." group by back_orser");
    $wenzorder = count($wenzorder);
    $twenorder = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder").$tw_where." group by back_orser");
    $twenorder = count($twenorder);
    $yesterday['wenzorder'] = $wenzorder + $twenorder;

    $jd_where = " where uniacid=".$uniacid." and keywords='tijianjiedu' and time>=".$yesterdays." and time <=".$todays;
    if(is_agent)
    {
    	$jd_where .= " and zid in (".$zjs.")";
    }
    $yesterday['jiedu_order'] = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder").$jd_where." group by back_orser");
    $yesterday['jiedu_order'] = count($yesterday['jiedu_order']);
    if(!$yesterday['jiedu_order'])
    {
    	$yesterday['jiedu_order'] = '0';
    }
    $yesterday['qianyue_order'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_teamorder")." where uniacid=".$uniacid." and time >=".$yesterdays." and time <=".$todays." group by back_orser");
    if(!$yesterday['qianyue_order'])
    {
    	$yesterday['qianyue_order'] = '0';
    }
    $ss_where = " where uniacid=".$uniacid." and keywords='shoushukuaiyue' and time >=".$yesterdays." and time <=".$todays;
    if(is_agent)
    {
    	$ss_where .= " and zid in (".$zjs.")";
    }
    $yesterday['shoushu_order'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_wenzorder").$ss_where." group by back_orser");

    if(!$yesterday['shoushu_order'])
    {
    	$yesterday['shoushu_order'] = '0';
    }
    $wz_where = " where uniacid=".$uniacid."and time >=".$todays;
    $tw_where = " where uniacid=".$uniacid." and xdtime >=".$todays;
    $gh_where = " where uniacid=".$uniacid." and created>=".$todays;
    if(is_agent)
    {
    	$wz_where .= " and zid in (".$zjs.")";
    	$tw_where .= " and zid in (".$zjs.")";
    	$gh_where .= " and zid in (".$zjs.")";
    }
    $wenzhen = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder").$wz_where." group by back_orser");
    $wenzhen = count($wenzhen);
    $tijian = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tijianorder").$wz_where." group by ordernums");
    $tuwen = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder").$tw_where." group by back_orser");
    $tuwen = count($tuwen);
    $goods = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid." and createTime>=".date("Y-m-d H:i:s",$todays));
    $guahao = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder").$gh_where." group by back_orser");
    $guahao = count($guahao);
    $qianyue = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_teamorder")." where uniacid=".$uniacid." and created>=".$todays);
    $yuyue = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_yuyueorder")." where uniacid=".$uniacid." and created>=".$todays);
    $today['order'] = $wenzhen + $tijian + $tuwen + $goods + $guahao + $qianyue + $yuyue;

    $wz_where = " where uniacid=".$uniacid."and time >=".$yesterdays." and time <=".$todays;
    if(is_agent == '1')
    {
    	$wz_where .= " and zid in (".$zjs.")";
    }
    $wenzhen = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder").$wz_where." group by back_orser");
    $wenzhen = count($wenzhen);
    $tijian = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and time >=".$yesterdays." and time <=".$todays." group by ordernums");
    $tw_where = " where uniacid=".$uniacid." and xdtime >=".$yesterdays." and xdtime <=".$todays;
    if(is_agent == '1')
    {
    	$tw_where .= " and zid in (".$zjs.")";
    }
    $tuwen = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder").$tw_where." group by back_orser");
    $tuwen = count($tuwen);
    $goods = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid." and createTime>=".date("Y-m-d H:i:s",$yesterdays)." and createTime <=".date("Y-m-d H:i:s",$todays));
    $gh_where = " where uniacid=".$uniacid." and created>=".$yesterdays." and created <=".$todays;
    if(is_agent == '1')
    {
    	$gh_where .= " and zid in (".$zjs.")";
    }
    $guahao = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder").$gh_where." group by back_orser");
    $guahao = count($guahao);
    $qianyue = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_teamorder")." where uniacid=".$uniacid." and created>=".$yesterdays." and created <=".$todays);
    $yuyue = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_yuyueorder")." where uniacid=".$uniacid." and created>=".$yesterdays." and created <=".$todays);
    $yesterday['order'] = $wenzhen + $tijian + $tuwen + $goods + $guahao + $qianyue + $yuyue;

    $wz_where = " where uniacid=".$uniacid."and time >=".$sevens;
    if(is_agent == '1')
    {
    	$wz_where .= " and zid in (".$zjs.")";
    }
    $wenzhen = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder").$wz_where." group by back_orser");
    $wenzhen = count($wenzhen);
    $tijian = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and time >=".$sevens." group by ordernums");
    $tw_where = " where uniacid=".$uniacid." and xdtime >=".$sevens;
    if(is_agent == '1')
    {
    	$tw_where .= " and zid in (".$zjs.")";
    }
    $tuwen = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder").$tw_where." group by back_orser");
    $tuwen = count($tuwen);
    $goods = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid." and createTime>=".date("Y-m-d H:i:s",$sevens));
    $gh_where = " where uniacid=".$uniacid." and created>=".$sevens;
    if(is_agent == '1')
    {
    	$gh_where .= " and zid in (".$zjs.")";
    }
    $guahao = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder").$gh_where." group by back_orser");
    $guahao = count($guahao);
    $qianyue = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_teamorder")." where uniacid=".$uniacid." and created>=".$sevens);
    $yuyue = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_yuyueorder")." where uniacid=".$uniacid." and created>=".$sevens);
    $seven['order'] = $wenzhen + $tijian + $tuwen + $goods + $guahao + $qianyue + $yuyue;

    $wz_where = " where uniacid=".$uniacid."and time >=".$monthse;
    if(is_agent == '1')
    {
    	$wz_where .= " and zid in (".$zjs.")";
    }
    $wenzhen = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder").$wz_where." group by back_orser");
    $wenzhen = count($wenzhen);
    $tijian = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and time >=".$monthse." group by ordernums");
    $tw_where = " where uniacid=".$uniacid." and xdtime >=".$monthse;
    if(is_agent == '1')
    {
    	$tw_where .= " and zid in (".$zjs.")";
    }
    $tuwen = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder").$tw_where." group by back_orser");
    $tuwen = count($tuwen);
    $goods = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid." and createTime>=".date("Y-m-d H:i:s",$monthss));
    $gh_where = " where uniacid=".$uniacid." and created>=".$monthse;
    if(is_agent == '1')
    {
    	$gh_where .= " and zid in (".$zjs.")";
    }
    $guahao = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder").$gh_where." group by back_orser");
    $guahao = count($guahao);
    $qianyue = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_teamorder")." where uniacid=".$uniacid." and created>=".$monthse);
    $yuyue = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_yuyueorder")." where uniacid=".$uniacid." and created>=".$monthse);
    $monthss['order'] = $wenzhen + $tijian + $tuwen + $goods + $guahao + $qianyue + $yuyue;


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
			$params = array(':uniacid' => $_W['uniacid'], ':starttime' => $time . ' 00:00:00', ':endtime' => $time . ' 23:59:59');
			$wz_where = " where uniacid=:uniacid and time >=:starttime and time<=:endtime";
			if(is_agent == '1')
			{
				$wz_where .= " and zid in (".$zjs.")";
			}
			$wenzhen = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder").$where.= "  group by back_orser",$params);
			$wenzhen = count($wenzhen);
			
			$tw_where = " where uniacid=:uniacid and xdtime >=:starttime and xdtime <=:endtime";
			if(is_agent == '1')
			{
				$tw_where .= " and zid in (".$zjs.")";
			}
			$tuwen = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder").$tw_where,$params);
			$tuwen = count($tuwen);
			$gh_where = " where uniacid=:uniacid and created>=:starttime and created<=:endtime";
			if(is_agent == '1')
			{
				$gh_where .= " and zid in (".$zjs.")";
			}
			$guahao = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder").$gh_where,$params);
			$guahao = count($guahao);
			$datas[] = array(
				'date' => $time,
				'wenzhen' => $wenzhen,
				'tijian' => pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=:uniacid and time >=:starttime and time <=:endtime",$params),
				'tuwen' => $tuwen,
				'goods' => pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsorders")." where uniacid=:uniacid and createTime>=:starttime and createTime<=:endtime",$paramss),
				'guahao' => $guahao,
				'qianyue' => pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_teamorder")." where uniacid=:uniacid and created>=:starttime and created<=:endtime",$params),
				'yuyue' =>  pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_yuyueorder")." where uniacid=:uniacid and created>=:starttime and created<=:endtime",$params),
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
				$paramss = array(':uniacid' => $_W['uniacid'], ':starttime' => $year . '-' . $month . '-' . $d . ' 00:00:00', ':endtime' => $year . '-' . $month . '-' . $d . ' 23:59:59');
				$wz_where = " where uniacid=:uniacid and time >=:starttime and time<=:endtime";
				if(is_agent == '1')
				{
					$wz_where .= " and zid in (".$zjs.")";
				}
				$wenzhen = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder").$where.= "  group by back_orser",$params);
				$wenzhen = count($wenzhen);
				
				$tw_where = " where uniacid=:uniacid and xdtime >=:starttime and xdtime <=:endtime";
				if(is_agent == '1')
				{
					$tw_where .= " and zid in (".$zjs.")";
				}
				$tuwen = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder").$tw_where,$params);
				$tuwen = count($tuwen);
				$gh_where = " where uniacid=:uniacid and created>=:starttime and created<=:endtime";
				if(is_agent == '1')
				{
					$gh_where .= " and zid in (".$zjs.")";
				}
				$guahao = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder").$gh_where,$params);
				$guahao = count($guahao);
				$datas[] = array(
					'date' => $d . '日', 
					'wenzhen' => $wenzhen,
					'tijian' => pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=:uniacid and time >=:starttime and time <=:endtime",$params),
					'tuwen' => $tuwen,
					'goods' => pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsorders")." where uniacid=:uniacid and createTime>=:starttime and createTime<=:endtime",$paramss),
					'guahao' => $guahao,
					'qianyue' => pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_teamorder")." where uniacid=:uniacid and created>=:starttime and created<=:endtime",$params),
					'yuyue' =>  pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_yuyueorder")." where uniacid=:uniacid and created>=:starttime and created<=:endtime",$params),
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
					$paramss = array(':uniacid' => $_W['uniacid'], ':starttime' => $year . '-' . $m['data'] . '-01 00:00:00', ':endtime' => $year . '-' . $m['data'] . '-' . $lastday . ' 23:59:59');
					$wz_where = " where uniacid=:uniacid and time >=:starttime and time<=:endtime";
					if(is_agent == '1')
					{
						$wz_where .= " and zid in (".$zjs.")";
					}
					$wenzhen = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder").$where.= "  group by back_orser",$params);
					$wenzhen = count($wenzhen);
					
					$tw_where = " where uniacid=:uniacid and xdtime >=:starttime and xdtime <=:endtime";
					if(is_agent == '1')
					{
						$tw_where .= " and zid in (".$zjs.")";
					}
					$tuwen = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder").$tw_where,$params);
					$tuwen = count($tuwen);
					$gh_where = " where uniacid=:uniacid and created>=:starttime and created<=:endtime";
					if(is_agent == '1')
					{
						$gh_where .= " and zid in (".$zjs.")";
					}
					$guahao = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder").$gh_where,$params);
					$guahao = count($guahao);
					$datas[] = array(
						'date' => $m['data'] . '月',
						'wenzhen' => $wenzhen,
						'tijian' => pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=:uniacid and time >=:starttime and time <=:endtime",$params),
						'tuwen' => $tuwen,
						'goods' => pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsorders")." where uniacid=:uniacid and createTime>=:starttime and createTime<=:endtime",$paramss),
						'guahao' => $guahao,
						'qianyue' => pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_teamorder")." where uniacid=:uniacid and created>=:starttime and created<=:endtime",$params),
						'yuyue' =>  pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_yuyueorder")." where uniacid=:uniacid and created>=:starttime and created<=:endtime",$params),
					);
				}
			}
		}
	}
   include $this->template("orderarea");
}
//财务概况
if($op == "financialstaus"){

	$todayss = date('Y-m-d H:i:s',time());
	$todays = strtotime(date("Y-m-d",time()));;
    $yesterdays = mktime(0,0,0,date('m'),date('d')-1,date('Y'));
    $sevens = mktime(0,0,0,date('m'),date('d')-7,date('Y'));
    $monthse = mktime(0,0,0,date('m'),date('d')-30,date('Y'));
    $wz_where = " where uniacid=".$uniacid."and time >=".$todays;
    if(is_agent == '1')
    {
    	$wz_where .= " and zid in (".$zjs.")";
    }
    $wenzhen = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder").$wz_where." group by back_orser");
    $wenzhen = array_sum(array_map(function($val){return $val['money'];}, $wenzhen));
    if(!$wenzhen)
    {
    	$wenzhen = '0.00';
    }

    $tijian = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and time >=".$todays." group by ordernums");
    if(!$tijian)
    {
    	$tijian = '0.00';
    }
    $tw_where = " where uniacid=".$uniacid." and xdtime >=".$todays;
    if(is_agent == '1')
    {
    	$tw_where .= " and zid in (".$zjs.")";
    }
    $tuwen = pdo_fetchall("select money from ".tablename("hyb_yl_twenorder").$tw_where." group by back_orser");
    $tuwen = array_sum(array_map(function($val){return $val['money'];}, $tuwen));
    if(!$tuwen)
    {
    	$tuwen = '0.00';
    }
    $goods = pdo_fetchcolumn("select sum(realTotalMoney) from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid." and createTime>=".date("Y-m-d H:i:s",$todays));
    if(!$goods)
    {
    	$goods = '0.00';
    }
    $gh_where = " where uniacid=".$uniacid." and created>=".$todays;
    if(is_agent == '1')
    {
    	$gh_where .= " and zid in (".$zjs.")";
    }
    $guahao = pdo_fetchall("select money from ".tablename("hyb_yl_guahaoorder").$gh_where." group by back_orser");
	$guahao = array_sum(array_map(function($val){return $val['money'];}, $guahao));
    if(!$guahao)
    {
    	$guahao = '0.00';
    }
    $qianyue = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_teamorder")." where uniacid=".$uniacid." and created>=".$todays);
    if(!$qianyue)
    {
    	$qianyue = '0.00';
    }
    $yuyue = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_yuyueorder")." where uniacid=".$uniacid." and created>=".$todays);
    if(!$yuyue)
    {
    	$yuyue = '0.00';
    }
    $today['money'] = $wenzhen + $tijian + $tuwen + $goods + $guahao + $qianyue;

    $wz_where = " where uniacid=".$uniacid." and ifpay=6 and time >=".$todays;
    if(is_agent == '1')
    {
    	$wz_where .= " and zid in (".$zjs.")";
    }
    $wenzhen = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder").$wz_where." group by back_orser");
    $wenzhen = array_sum(array_map(function($val){return $val['money'];}, $wenzhen));
    if(!$wenzhen)
    {
    	$wenzhen = '0.00';
    }
    $tw_where = " where uniacid=".$uniacid." and ispay=6 and xdtime >=".$todays;
    if(is_agent == '1')
    {
    	$tw_where .= " and zid in (".$zjs.")";
    }
    $tuwen = pdo_fetchall("select money from ".tablename("hyb_yl_twenorder").$tw_where." group by back_orser");
    $tuwen = array_sum(array_map(function($val){return $val['money'];}, $tuwen));
    if(!$tuwen)
    {
    	$tuwen = '0.00';
    }
    $goods = pdo_fetchcolumn("select sum(realTotalMoney) from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid." and isRefund=1 and createTime>=".date("Y-m-d H:i:s",$todays));
    if(!$goods)
    {
    	$goods = '0.00';
    }
    $qianyue = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_teamorder")." where uniacid=".$uniacid." and ifpay=4 and created>=".$todays);
    if(!$qianyue)
    {
    	$qianyue = '0.00';
    }
    $today['refund'] = $wenzhen + $tuwen + $goods + $qianyue;

    $wz_where = " where uniacid=".$uniacid." and ifpay=6 and time >=".$yesterdays." and time <=".$todays;
    if(is_agent == '1')
    {
    	$wz_where .= " and zid in (".$wz_where.")";
    }
    $wenzhen = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder").$wz_where." group by back_orser");
    $wenzhen = array_sum(array_map(function($val){return $val['money'];}, $wenzhen));
    if(!$wenzhen)
    {
    	$wenzhen = '0.00';
    }
    $tw_where = " where uniacid=".$uniacid." and ispay=6 and xdtime >=".$yesterdays." and time <=".$todays;
    if(is_agent == '1')
    {
    	$tw_where .= " and zid in (".$zjs.")";
    }
    $tuwen = pdo_fetchall("select money from ".tablename("hyb_yl_twenorder").$tw_where." group by back_orser");
    $tuwen = array_sum(array_map(function($val){return $val['money'];}, $tuwen));
    if(!$tuwen)
    {
    	$tuwen = '0.00';
    }
    $goods = pdo_fetchcolumn("select sum(realTotalMoney) from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid." and isRefund=1 and createTime>=".date("Y-m-d H:i:s",$yesterdays)." and createTime <=".date("Y-m-d H:i:s",$todays));
    if(!$goods)
    {
    	$goods = '0.00';
    }
    $qianyue = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_teamorder")." where uniacid=".$uniacid." and ifpay=4 and created>=".$yesterdays." and created <=".$todays);
    if(!$qianyue)
    {
    	$qianyue = '0.00';
    }
    $refund = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_refund")." where uniacid=".$uniacid." and (status=1 or status=3) and created>=".$todays);
    if(!$refund)
    {
    	$refund = '0.00';
    }
	$yesterday['refund'] = $wenzhen + $tuwen + $goods + $qianyue + $refund;
	$today['tixian'] = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_cash")." where uniacid=".$uniacid." and (status=1 or status=2) and s_time>=".$todays);
	$yesterday['tixian'] = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_cash")." where uniacid=".$uniacid." and (status=1 or status=2) and s_time>=".$yesterdays." and s_time<=".$todays);


    // $tixian = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_refund")." where uniacid=".$uniacid." and (status=1 or status=3) and s_time>=".$todays);

    $fahuo_goods = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid." and orderStatus=0 and createTime>='".date("Y-m-d H:i:s",$todays)."'");
    
    $today['fahuo_order'] = $fahuo_goods;
    $wz_where = " where uniacid=".$uniacid." and (ifpay=5 or ifpay=6) and apply_time >=".$todays;
    if(is_agent == '1')
    {
    	$wz_where .= " and zid in (".$zjs.")";
    }
    $refund_wenzhen = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder").$wz_where." group by back_orser");
    $refund_wenzhen = count($refund_wenzhen);
    $tw_where = " where uniacid=".$uniacid." and (ifpay=3 or ifpay =4 or ifpay=6 or ifpay=7) and xdtime >=".$todays;
    if(is_gent == '1')
    {
    	$tw_where .= " and zid in (".$zjs.")";
    }
    $refund_tuwen = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder").$tw_where." group by back_orser");
    $refund_tuwen = count($refund_tuwen);
    $refund_goods = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid." and isRefund=1 and createTime>=".date("Y-m-d H:i:s",$todays));
    $refund_qianyue = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_teamorder")." where uniacid=".$uniacid." (ifpay=3 or ifpay =4 or ifpay=6 or ifpay=7) and t_time>=".$todays);
    $refund_yuyue = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_yuyueorder")." where uniacid=".$uniacid." and is_pay=1 and (status=2 or status=3) and created>=".$todays);
    $today['refund_order'] = $refund_wenzhen + $refund_tuwen + $refund_goods + $refund_qianyue + $refund_yuyue;
    $wz_where = " where uniacid=".$uniacid." and ifpay=6 and refund_time >=".$todays;
    if(is_agent == '1')
    {
    	$wz_where .= " and zid in (".$zjs.")";
    }
    $yitui_wenzhen = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder").$wz_where." group by back_orser");
    $yitui_wenzhen = count($yitui_wenzhen);
    $tw_where = " where uniacid=".$uniacid." and ifpay=6 and xdtime >=".$todays;
    if(is_agent == '1')
    {
    	$tw_where .= " and zid in (".$zjs.")";
    }
    $yitui_tuwen = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder").$tw_where." group by back_orser");
    $yitui_tuwen = count($yitui_tuwen);
    $yitui_goods = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid." and isRefund=1 and createTime>=".date("Y-m-d H:i:s",$todays));
    $yitui_qianyue = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_teamorder")." where uniacid=".$uniacid." and  ifpay=4 and t_time>=".$todays);
    $today['yitui_order'] = $yitui_wenzhen + $yitui_tuwen + $refund_goods + $refund_qianyue;

   	$today['tixian'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_cash")." where uniacid=".$uniacid." and created>=".$todays);
   	$yesterday['tixian'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_cash")." where uniacid=".$uniacid." and created>=".$yesterdays." and created <=".$todays);
   	if(!$today['tixian'])
   	{
   		$today['tixian'] = '0.00';
   	}
   	if(!$yesterday['tixian'])
   	{
   		$yesterday['tixian'] = '0.00';
   	}
    $zj_tixian = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_cash")." where uniacid=".$uniacid." and type=0 and status=0");
    if(!$zj_tixian)
    {
    	$today['zj_tixian'] = '0.00';
    }
    $jg_tixian = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_cash")." where uniacid=".$uniacid." and type=1 and status=0");
    if(!$zj_tixian)
    {
    	$today['jg_tixian'] = '0.00';
    }
    $user_tixian = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_cash")." where uniacid=".$uniacid." and type=4 and status=0");
    if(!$user_tixian)
    {
    	$today['user_tixian'] = '0.00';
    }
    $wz_where = " where uniacid=".$uniacid." and time >=".$yesterdays." and time <=".$todays;
    if(is_agent == '1')
    {
    	$wz_where .= " and zid in (".$zjs.")";
    }
    $wenzhen = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder").$wz_where." group by back_orser");
    $wenzhen = array_sum(array_map(function($val){return $val['money'];}, $wenzhen));
    if(!$wenzhen)
    {
    	$wenzhen = '0.00';
    }
    $tijian = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and time >=".$yesterdays." and time <=".$todays." group by ordernums");
    if(!$tijian)
    {
    	$tijian = '0.00';
    }
    $tw_where = " where uniacid=".$uniacid." and xdtime >=".$yesterdays." and xdtime <=".$todays;
    if(is_agent == '1')
    {
    	$tw_where .= " and zid in (".$zjs.")";
    }
    $tuwen = pdo_fetchall("select money from ".tablename("hyb_yl_twenorder").$tw_where." group by back_orser");
    $tuwen = array_sum(array_map(function($val){return $val['money'];}, $tuwen));
    if(!$tuwen)
    {
    	$tuwen = '0.00';
    }
    $goods = pdo_fetchcolumn("select sum(realTotalMoney) from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid." and createTime>=".date("Y-m-d H:i:s",$yesterdays)." and createTime <=".date("Y-m-d H:i:s",$todays));
    if(!$goods)
    {
    	$goods = '0.00';
    }
    $gh_where = " where uniacid=".$uniacid." and created>=".$yesterdays." and created <=".$todays;
    if(is_agent == '1')
    {
    	$gh_where .= " and zid in (".$zjs.")";
    }
    $guahao = pdo_fetchall("select money from ".tablename("hyb_yl_guahaoorder").$gh_where." group by back_orser");
    $guahao = array_sum(array_map(function($val){return $val['money'];}, $guahao));
    if(!$guahao)
    {
    	$guahao = '0.00';
    }
    $qianyue = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_teamorder")." where uniacid=".$uniacid." and created>=".$yesterdays." and created <=".$todays);
    if(!$qianyue)
    {
    	$qianyue = '0.00';
    }
    $yuyue = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_yuyueorder")." where uniacid=".$uniacid." and created>=".$yesterdays." and created <=".$todays);
    if(!$yuyue)
    {
    	$yuyue = '0.00';
    }
    $yesterday['money'] = $wenzhen + $tijian + $tuwen + $goods + $guahao + $qianyue + $yuyue;

    $wz_where = " where uniacid=".$uniacid."and time >=".$sevens;
    if(is_agent == '1')
    {
    	$wz_where .= " and zid in (".$zjs.")";
    }
    $wenzhen = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder").$wz_where." group by back_orser");
    $wenzhen = array_sum(array_map(function($val){return $val['money'];}, $wenzhen));
    if(!$wenzhen)
    {
    	$wenzhen = '0.00';
    }
    $tijian = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and time >=".$sevens." group by ordernums");
    if(!$tijian)
    {
    	$tijian = '0.00';
    }
    $tw_where = " where uniacid=".$uniacid." and xdtime >=".$sevens;
    if(is_agent == '1')
    {
    	$tw_where .= " and zid in (".$zjs.")";
    }
    $tuwen = pdo_fetchall("select money from ".tablename("hyb_yl_twenorder").$tw_where." group by back_orser");
    $tuwen = array_sum(array_map(function($val){return $val['money'];}, $tuwen));
    if(!$tuwen)
    {
    	$tuwen = '0.00';
    }
    $goods = pdo_fetchcolumn("select sum(realTotalMoney) from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid." and createTime>=".date("Y-m-d H:i:s",$sevens));
    if(!$goods)
    {
    	$goods = '0.00';
    }
    $gh_where = " where uniacid=".$uniacid." and created>=".$sevens;
    if(is_agent == '1')
    {
    	$gh_where .= " and zid in (".$zjs.")";
    }
    $guahao = pdo_fetchall("select money from ".tablename("hyb_yl_guahaoorder").$gh_where." group by back_orser");
    $guahao = array_sum(array_map(function($val){return $val['money'];}, $guahao));
    if(!$guahao)
    {
    	$guahao = '0.00';
    }
    $qianyue = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_teamorder")." where uniacid=".$uniacid." and created>=".$sevens);
    if(!$qianyue)
    {
    	$qianyue = '0.00';
    }
    $yuyue = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_yuyueorder")." where uniacid=".$uniacid." and created>=".$sevens);
    if(!$yuyue)
    {
    	$yuyue = '0.00';
    }
    $seven['money'] = $wenzhen + $tijian + $tuwen + $goods + $guahao + $qianyue + $yuyue;

    $wz_where = " where uniacid=".$uniacid."and time >=".$monthse;
    if(is_agent == '1')
    {
    	$wz_where .= " and zid in (".$zjs.")";
    }
    $wenzhen = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder").$wz_where." group by back_orser");
    $wenzhen = array_sum(array_map(function($val){return $val['money'];}, $wenzhen));
    if(!$wenzhen)
    {
    	$wenzhen = '0.00';
    }
    $tijian = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and time >=".$monthse." group by ordernums");
    if(!$tijian)
    {
    	$tijian = '0.00';
    }
    $tw_where = " where uniacid=".$uniacid." and xdtime >=".$monthse;
    if(is_agent == '1')
    {
    	$tw_where .= " and zid in (".$zjs.")";
    }
    $tuwen = pdo_fetchall("select money from ".tablename("hyb_yl_twenorder").$tw_where." group by back_orser");
    $tuwen = array_sum(array_map(function($val){return $val['money'];}, $tuwen));
    if(!$tuwen)
    {
    	$tuwen = '0.00';
    }
    $goods = pdo_fetchcolumn("select sum(realTotalMoney) from ".tablename("hyb_yl_goodsorders")." where uniacid=".$uniacid." and createTime>=".date("Y-m-d H:i:s",$monthss));
    if(!$goods)
    {
    	$goods = '0.00';
    }
    $gh_where = " where uniacid=".$uniacid." and created>=".$monthse;
    if(is_agent == '1')
    {
    	$gh_where .= " and zid in (".$zjs.")";
    }
    $guahao = pdo_fetchall("select money from ".tablename("hyb_yl_guahaoorder").$gh_where);
    $guahao = array_sum(array_map(function($val){return $val['money'];}, $guahao));
    if(!$guahao)
    {
    	$guahao = '0.00';
    }
    $qianyue = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_teamorder")." where uniacid=".$uniacid." and created>=".$monthse);
    if(!$qianyue)
    {
    	$qianyue = '0.00';
    }
    $yuyue = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_yuyueorder")." where uniacid=".$uniacid." and created>=".$monthse);
    if(!$yuyue)
    {
    	$yuyue = '0.00';
    }
    $monthss['money'] = $wenzhen + $tijian + $tuwen + $goods + $guahao + $qianyue + $yuyue;
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
			$paramss = array(':uniacid' => $_W['uniacid'], ':starttime' => $time . ' 00:00:00', ':endtime' => $time . ' 23:59:59');
			$wz_where = " where uniacid=:uniacid and time >=:starttime and time<=:endtime";
			if(is_agent == '1')
			{
				$wz_where .= " and zid in (".$zjs.")";
			}
			$wenzhen = pdo_fetchall("select money from ".tablename("hyb_yl_wenzorder").$wz_where." group by back_orser",$params);
			$wenzhen = array_sum(array_map(function($val){return $val['money'];}, $wenzhen));
			if(!$wenzhen)
			{
				$wenzhen = '0.00';
			}
			$tijian = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_tijianorder")." where uniacid=:uniacid and time >=:starttime and time <=:endtime",$params);
			if(!$tijian)
			{
				$tijian = '0.00';
			}
			$tw_where = " where uniacid=:uniacid and xdtime >=:starttime and xdtime <=:endtime";
			if(is_agent == '1')
			{
				$tw_where .= " and zid in (".$zjs.")";
			}
			$tuwen = pdo_fetchall("select money from ".tablename("hyb_yl_twenorder").$tw_where." group by back_orser",$params);
			$tuwen = array_sum(array_map(function($val){return $val['money'];}, $tuwen));
			if(!$tuwen)
			{
				$tuwen = '0.00';
			}
			$goods = pdo_fetchcolumn("select sum(realTotalMoney) from ".tablename("hyb_yl_goodsorders")." where uniacid=:uniacid and createTime>=:starttime and createTime<=:endtime",$paramss);
			if(!$goods)
			{
				$goods = '0.00';
			}
			$gh_where = " where uniacid=:uniacid and created>=:starttime and created<=:endtime";
			if(is_agent == '1')
			{
				$gh_where .= " and zid in (".$zjs.")";
			}
			$guahao = pdo_fetchall("select money from ".tablename("hyb_yl_guahaoorder").$gh_where,$params);
			$guahao = array_sum(array_map(function($val){return $val['money'];}, $guahao));
			if(!$guahao)
			{
				$guahao = '0.00';
			}
			$qianyue = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_teamorder")." where uniacid=:uniacid and created>=:starttime and created<=:endtime",$params);
			if(!$qianyue)
			{
				$qianyue = '0.00';
			}
			$yuyue =  pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_yuyueorder")." where uniacid=:uniacid and created>=:starttime and created<=:endtime",$params);
			if(!$yuyue)
			{
				$yuyue = '0.00';
			}
			$datas[] = array(
				'date' => $time,
				'wenzhen' => $wenzhen,
				'tijian' => $tijian,
				'tuwen' => $tuwen,
				'goods' => $goods,
				'guahao' => $guahao,
				'qianyue' => $qianyue,
				'yuyue' =>  $yuyue,
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
				$paramss = array(':uniacid' => $_W['uniacid'], ':starttime' => $year . '-' . $month . '-' . $d . ' 00:00:00', ':endtime' => $year . '-' . $month . '-' . $d . ' 23:59:59');
				$wenzhen = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_wenzorder")." where uniacid=:uniacid and time >=:starttime and time<=:endtime",$params);
				if(!$wenzhen)
				{
					$wenzhen = '0.00';
				}
				$tijian = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_tijianorder")." where uniacid=:uniacid and time >=:starttime and time <=:endtime",$params);
				if(!$tijian)
				{
					$tijian = '0.00';
				}
				$tuwen = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_twenorder")." where uniacid=:uniacid and xdtime >=:starttime and xdtime <=:endtime",$params);
				if(!$tuwen)
				{
					$tuwen = '0.00';
				}
				$goods = pdo_fetchcolumn("select sum(realTotalMoney) from ".tablename("hyb_yl_goodsorders")." where uniacid=:uniacid and createTime>=:starttime and createTime<=:endtime",$paramss);
				if(!$goods)
				{
					$goods = '0.00';
				}
				$guahao = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_guahaoorder")." where uniacid=:uniacid and created>=:starttime and created<=:endtime",$params);
				if(!$guahao)
				{
					$guahao = '0.00';
				}
				$qianyue = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_teamorder")." where uniacid=:uniacid and created>=:starttime and created<=:endtime",$params);
				if(!$qianyue)
				{
					$qianyue = '0.00';
				}
				$yuyue =  pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_yuyueorder")." where uniacid=:uniacid and created>=:starttime and created<=:endtime",$params);
				if(!$yuyue)
				{
					$yuyue = '0.00';
				}
				$datas[] = array(
					'date' => $d . '日', 
					'wenzhen' => $wenzhen,
			        'tijian' => $tijian,
			        'tuwen' => $tuwen,
			        'goods' => $goods,
			        'guahao' => $guahao,
			        'qianyue' => $qianyue,
			        'yuyue' =>  $yuyue,
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
					$paramss = array(':uniacid' => $_W['uniacid'], ':starttime' => $year . '-' . $m['data'] . '-01 00:00:00', ':endtime' => $year . '-' . $m['data'] . '-' . $lastday . ' 23:59:59');
					$wenzhen = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_wenzorder")." where uniacid=:uniacid and time >=:starttime and time<=:endtime",$params);
					if(!$wenzhen)
					{
						$wenzhen = '0.00';
					}
					$tijian = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_tijianorder")." where uniacid=:uniacid and time >=:starttime and time <=:endtime",$params);
					if(!$tijian)
					{
						$tijian = '0.00';
					}
					$tuwen = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_twenorder")." where uniacid=:uniacid and xdtime >=:starttime and xdtime <=:endtime",$params);
					if(!$tuwen)
					{
						$tuwen = '0.00';
					}
					$goods = pdo_fetchcolumn("select sum(realTotalMoney) from ".tablename("hyb_yl_goodsorders")." where uniacid=:uniacid and createTime>=:starttime and createTime<=:endtime",$paramss);
					if(!$goods)
					{
						$goods = '0.00';
					}
					$guahao = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_guahaoorder")." where uniacid=:uniacid and created>=:starttime and created<=:endtime",$params);
					if(!$guahao)
					{
						$guahao = '0.00';
					}
					$qianyue = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_teamorder")." where uniacid=:uniacid and created>=:starttime and created<=:endtime",$params);
					
					if(!$qianyue)
					{
						$qianyue = '0.00';
					}
					$yuyue =  pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_yuyueorder")." where uniacid=:uniacid and created>=:starttime and created<=:endtime",$params);
					if(!$yuyue)
					{
						$yuyue = '0.00';
					}
					$datas[] = array(
						'date' => $m['data'] . '月',
						'wenzhen' => $wenzhen,
				        'tijian' => $tijian,
				        'tuwen' => $tuwen,
				        'goods' => $goods,
				        'guahao' => $guahao,
				        'qianyue' => $qianyue,
				        'yuyue' =>  $yuyue,
					);
					
				}
			}
		}
		
	}	
   include $this->template("financialstaus");
}
