<?php
global $_W;
defined('IN_IA') or exit('Access Denied');
define('ST_ROOT',IA_ROOT.'/addons/hyb_yl/');
define('ST_URL',$_W['siteroot'].'addons/hyb_yl/');
define('MODULE','hyb_yl');
require_once(IA_ROOT.'/addons/hyb_yl/define.php');
require_once(ST_ROOT.'class/autoload.php');

class Hyb_ylModule extends WeModule {


	public function welcomeDisplay($settings)
	{

		global $_W, $_GPC;
		$uniacid = $_W['uniacid'];
	
		$op =$_GPC['op'];
        $_W['plugin'] = $plugin = !empty($_GPC['p']) ? $_GPC['p'] : 'dashboard';
        $_W['controller'] = $controller = !empty($_GPC['ac']) ? $_GPC['ac'] : 'dashboard';
		$todays = strtotime(date("Y-m-d"),time());
		$today_zjyy = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zhuanjia_yuyue")." where uniacid=:uniacid and zy_time>=:time",array(":uniacid"=>$uniacid,":time"=>$todays));
		$huanzhenum = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_myinfors")." where uniacid=:uniacid",array(":uniacid"=>$uniacid));
		$hushi = $this->hushi();
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
		$today['goods'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_goodsarr")." where uniacid=".$uniacid." and date >=".date("Y-m-d",$todays));
		// 处方
		$today['chufang'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_chufang_log")." where uniacid=".$uniacid." and created >=".$todays);
		// 待审核动态
		$today['shenhe_dongdai'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_share")." where uniacid=".$uniacid." and type=0 and times >=".$todays);
		// 待审核患教
		$today['shenhe_education'] = '0';
		// 优惠券
		$today['coupon'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_coupon_code")." where uniacid=".$uniacid." and createtime>='".date("Y-m-d H:i:s",$todays)."'");
		
		// 昨日数据
		$yesterday['visit'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_visit")." where uniacid=".$uniacid." and type=0 and created >=".$yesterdays." and created <=".$todays);
		$yesterday['dongtai'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_share")." where uniacid=".$uniacid." and times >=".$yesterdays." and times <=".$todays);
		$zhuanjias = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and opentime>=".$yesterdays." and opentime <=".$todays);
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
		//include $this->template('index');
		$uid = $_W['uid'];

		$user = pdo_get("users",array("uid"=>$uid));

		$hid = pdo_get("hyb_yl_hospital",array("username"=>$user['username']));

		message('登录成功!', $this->createWebUrl('dashboard', array('ac'=>'dynamiclist','op'=>'gk','hid'=>$hid['hid'])), 'success');
	}

	public function hushi()
	{
		global $_W,$_GPC;
		$uniacid = $_W['uniacid'];
	    $time = pdo_fetchall("SELECT * FROM " . tablename("hyb_yl_userinfo") . " as a left join " . tablename("hyb_yl_zhuanjia_yuyue") . " as b on b.zy_openid=a.openid left join" . tablename('hyb_yl_myinfors') . " as c on c.my_id = b.zy_name where  b.uniacid='{$uniacid}' order by b.zy_id desc");
	    foreach ($time as & $value) {
	        $value['zy_time'] = date("Y-m-d H:i:s", $value['zy_time']);
	    }
	    return $time;
	    
	}

	  
	
}