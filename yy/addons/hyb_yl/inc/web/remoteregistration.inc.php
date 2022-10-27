<?php
global $_W,$_GPC;
$op = $_GPC['op'];
$uniacid = $_W['uniacid'];
$_W['plugin'] = 'remoteregistration';
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
	$zhuanjia = pdo_fetchall("select zid from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$_GPC['hid']);
	$zjs = '';
	foreach($zhuanjia as &$zj)
	{
		$zjs .= $zj['zid'].",";
	}
	$zjs = substr($zjs,0,strlen($zjs)-1);
	define('zid', $zjs);
}
if($op == "index")
{
	include $this->template("remoteregistration/index");
}
if($op == 'subscribe')
{
	$page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
    $where = " where g.uniacid=".$uniacid." and is_admin=1";
    $keyword = $_GPC['keyword'];
    if($keyword != '')
    {
    	$where .= " and (u.u_name like '%$keyword%' or u.u_phone like '%$keyword%')";
    }
    if(is_agent == '1')
    {
    	$where .= " and z.zid in (".$zjs.")";
    }
    $start = empty($_GPC['start']) ? date("Y-m-d",strtotime("-1Months",time())) : $_GPC['start']; 
	$end = empty($_GPC['end']) ? date("Y-m-d",strtotime("+1DAys",time())) : $_GPC['end'];
	if($start != '' && $end != '')
	{
		$where .= " and g.time>=".strtotime($start)." and g.time <=".strtotime($end);
	}
// 	$keshi_arr = pdo_getall("hyb_yl_classgory",array("uniacid"=>$uniacid,"typeint"=>'0'));

// 	$keshis_arr = pdo_getall("hyb_yl_ceshi",array("uniacid"=>$uniacid,"giftstatus"=>$keshi_arr[0]['id']));
	$type_arr = pdo_getall("hyb_yl_ghyy_type",array("uniacid"=>$uniacid));
	$type = $_GPC['type'];
	if($type != '')
	{
		$where .= " and g.yy_type=".$type;
	}
// 	$keshi = $_GPC['keshi'];
// 	if($keshi != '')
// 	{
// 		$where .= " and z.z_room = ".$keshi;
// 	}
// 	$keshi_two = $_GPC['keshi_two'];
// 	if($keshi_two != '')
// 	{
// 		$where .= " and z.parentid=".$keshi_two;
// 	}
	$zhuanjia_arr = pdo_getall("hyb_yl_zhuanjia",array("uniacid"=>$uniacid));
	$zhuanjia = $_GPC['zhuanjia'];
	if($zhuanjia != '')
	{
		$where .= " and g.zid=".$zhuanjia;
	}
	$ifpay = $_GPC['ifpay'];
	if($ifpay != '')
	{
		$where .= " and g.ifpay=".$ifpay;
	}
	
	$list = pdo_fetchall("select g.*,z.z_name,z.z_room,z.parentid,u.u_name,u.u_thumb,u.gender,z.qx_id,z.hid from ".tablename("hyb_yl_guahaoorder")." as g left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=g.zid left join ".tablename("hyb_yl_userinfo")." as u on u.openid=g.openid ".$where." order by g.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);

	foreach($list as &$value)
	{
// 		$value['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$value['parentid']),'name');
// 		$value['jigou'] = pdo_getcolumn("hyb_yl_hospital",array("id"=>$value['hid']),'agentname');
	    $userjs = pdo_get("hyb_yl_userjiaren",array("uniacid"=>$uniacid,"j_id"=>$value['j_id']));
	    $value['sex'] = $userjs['sex'];
	    $value['telphone'] = $userjs['tel'];
	    $value['describe'] = unserialize($value['describe']); 
// 		$value['time'] = date("Y-m-d H:i:s",$value['time']);
// 		$value['paytime'] = date("Y-m-d H:i:s",$value['paytime']);

	}
	$total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_guahaoorder")." as g left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=g.zid left join ".tablename("hyb_yl_userinfo")." as u on u.openid=g.openid ".$where);
	$pager = pagination($total, $pageindex, $pagesize);
	include $this->template("remoteregistration/subscribe");
}

// 微信交流
if($op == 'weixin')
{
	$id = $_GPC['id'];
	$hid = $_SESSION['hid'];
	$list = pdo_fetchall("select * from ".tablename('hyb_yl_chat_msg_list')." where uniacid=".$uniacid." and oid=".$id);
	$user = pdo_get("hyb_yl_userinfo",array("openid"=>$list[0]['u_openid']));
	foreach($list as &$value)
	{
		$user = pdo_get("hyb_yl_userinfo",array("openid"=>$value['u_openid']));
		$value['user'] = $user;
		$zhuanjia = pdo_get("hyb_yl_zhuanjia",array("zid"=>$value['zid']));
		if(strpos($zhuanjia['advertisement'], 'http') === false)
		{
			$zhuanjia['advertisement'] = $_W['attachurl'].$zhuanjia['advertisement'];
		}
	}
	include $this->template("remoteregistration/weixin");
}
// 预约记录详情
if($op == 'yy_detail')
{
	$id = $_GPC['id'];
	$item = pdo_fetch("select * from ".tablename("hyb_yl_guahaoorder")." where id=".$id);
	$zhuanjia = pdo_get("hyb_yl_zhuanjia",array("zid"=>$item['zid']));
	
	$zhuanjia['advertisement'] = tomedia($zhuanjia['advertisement']);
	
	$item['keshi'] = $zhuanjia['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$zhuanjia['parentid']),'name');
	$zhuanjia['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$zhuanjia['z_zhicheng']),'job_name');
	$item['jigou'] = $zhuanjia['jigou'] = pdo_getcolumn("hyb_yl_hospital_diction",array("id"=>$zhuanjia['hid']),'name');
	$item['yy_time'] = date("Y-m-d H:i:s",$item['time']);
	$item['yy_types'] = pdo_getcolumn("hyb_yl_ghyy_type",array("id"=>$item['yy_type']),'title');
	$item['jz_times'] = date("Y-m-d H:i:s",$item['jz_times']);
	$item['qx_time'] = date("Y-m-d H:i:s",$item['qx_time']);
	$item['p_time'] = date("Y-m-d H:i:s",$item['paytime']);
	
	$item['created'] = date("Y-m-d H:i:s",$item['time']);
	include $this->template("remoteregistration/yy_detail");

}
// 删除预约记录
// 预约类型
if($op == 'yy_type')
{
	$page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 12;
    $where = " where uniacid=".$uniacid;
    $list = pdo_fetchall("select * from ".tablename("hyb_yl_ghyy_type").$where." order by id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
    foreach($list as &$value)
    {
    	$value['thumb'] = $_W['attachurl'].$value['thumb'];
    }
    $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_ghyy_type").$where);
    $pager = pagination($total, $pageindex, $pagesize);
    include $this->template("remoteregistration/yy_type");
}
// 添加预约类型
if($op == 'addyytype')
{
	$id = $_GPC['id'];
	$item = pdo_get("hyb_yl_ghyy_type",array("id"=>$id));
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
			$res = pdo_update("hyb_yl_ghyy_type",$data,array("id"=>$id));
		}else{
			$data['created'] = time();
			$res = pdo_insert("hyb_yl_ghyy_type",$data);
		}
		if($res)
		{
			message("设置成功!",$this->createWebUrl("remoteregistration",array("op"=>"yy_type")),"success");
		}else{
			message("设置失败!",$this->createWebUrl("remoteregistration",array("op"=>"yy_type")),"error");

		}
	}
	include $this->template('remoteregistration/addyytype');
}
// 预约类型删除
if($op == 'delyytype')
{
	$id = $_GPC['id'];
	$res = pdo_delete("hyb_yl_ghyy_type",array("id"=>$id));
	if($res)
	{
		message("设置成功!",$this->createWebUrl("remoteregistration",array("op"=>"yy_type")),"success");
	}else{
		message("设置失败!",$this->createWebUrl("remoteregistration",array("op"=>"yy_type")),"error");

	}
	include $this->template('remoteregistration/yy_type');
}
if($op == 'gk')
{
	$todayss = date("Y-m-d H:i:s",time());
	$todays = time();
    $yesterdays = mktime(0,0,0,date('m'),date('d')-1,date('Y'));
    $sevens = mktime(0,0,0,date('m'),date('d')-7,date('Y'));
    $monthse = mktime(0,0,0,date('m'),date('d')-30,date('Y'));
    $pay = " where uniacid=".$uniacid." and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8 and paytime >=".$todays;
    if(is_agent == '1')
    {
    	$pay .= " and zid in (".$zjs.")";
    }
    $today['pay'] = pdo_fetchall("select money from ".tablename("hyb_yl_guahaoorder").$pay." group by back_orser");

    $today['pay'] = array_sum(array_map(function($val){return $val['money'];}, $today['pay']));

    if(!$today['pay'])
    {
      $today['pay'] = '0.00';
    }
    $pays = " where uniacid=".$uniacid." and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8 and paytime >=".$yesterdays;
    if(is_agent == '1')
    {
    	$pays .= " and zid in (".$zjs.")";
    }
    $yesterday['pay'] = pdo_fetchall("select money from ".tablename("hyb_yl_guahaoorder").$pays." group by back_orser");

    $yesterday['pay'] = array_sum(array_map(function($val){return $val['money'];}, $yesterday['pay']));

    if(!$yesterday['pay'])
    {
      $yesterday['pay'] = '0.00';
    }
 	$pay = " where uniacid=".$uniacid." and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8  and paytime >=".$sevens;
 	if(is_agent == '1')
 	{
 		$pay .= " and zid in (".$zjs.")";
 	}
    $seven['pay'] = pdo_fetchall("select money from ".tablename("hyb_yl_guahaoorder").$pay." group by back_orser");

    $seven['pay'] = array_sum(array_map(function($val){return $val['money'];}, $seven['pay']));

    if(!$seven['pay'])
    {
      $seven['pay'] = '0.00';
    }
    $pay = " where uniacid=".$uniacid." and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8 and paytime >=".$monthse;
    if(is_agent == '1')
    {
    	$pay .= " and zid in (".$zjs.")";
    }
   	$monthss['pay'] = pdo_fetchall("select money from ".tablename("hyb_yl_guahaoorder").$pay." group by back_orser");

	$monthss['pay'] = array_sum(array_map(function($val){return $val['money'];}, $monthss['pay']));

    if(!$monthss['pay'])
    {
      $monthss['pay'] = '0.00';
    }
   	
   	
    // 今天数据
    $guahao = " where uniacid=".$uniacid."  and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8 and paytime >=".$todays;
    if(is_agent == '1')
    {
    	$guahao .= " and zid in (".$zjs.")";
    }
	$today['guahao'] = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder").$guahao." group by back_orser");

	$today['guahao'] = count($today['guahao']);
	$zj = " where uniacid=".$uniacid." and opentime >=".$todays;
	if(is_agent == '1')
	{
		$zj .= " and zid in (".$zjs.")";
	}
	$today['doc'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zhuanjia").$zj);
	
	$order = " where uniacid=".$uniacid." and time >=".$todays;
	if(is_agent == '1')
	{
		$order .= " and zid in (".$zjs.")";
	}
	$today['order'] = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder").$order." group by back_orser");

	$today['order'] = count($today['order']);
	$pays = " where uniacid=".$uniacid." and ifpay=0 and time >=".$todays;
	if(is_agent == '1')
	{
		$pays .= " and zid in (".$zjs.")";
	}
	$today['pays'] = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder").$pays." group by back_orser");

	$today['pays'] = count($today['pays']);
	$refund = " where uniacid=".$uniacid." and ifpay=6 and refund_time >=".$todays;
	if(is_agent == '1')
	{
		$refund .= " and zid in (".$zjs.")";
	}
	$today['refund'] = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder").$refund." group by back_orser");
	
	$today['refund'] = count($today['refund']);
	$jiuzhen = " where uniacid=".$uniacid." and ifpay=2 and jz_time>=".$todays;
	if(is_agent == '1')
	{
		$jiuzhen .= " and zid in (".$zjs.")";
	}
	$today['jiuzhen'] = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder").$jiuzhen." group by back_orser");
	$today['jiuzhen'] = count($today['jiuzhen']);
	
	// 昨日数据
	$gh = " where uniacid=".$uniacid." and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8 and paytime <=".$todays." and paytime >=".$yesterdays;
	if(is_agent == '1')
	{
		$gh .= " and zid in (".$zjs.")";
	}
	$yesterday['guahao'] = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid." and ifpay != 0 and ifpay != 6 and ifpay != 7 and ifpay!=8 and paytime <=".$todays." and paytime >=".$yesterdays." group by back_orser");
	
	$yesterday['guahao'] = count($yesterday['guahao']);
	$zj = " where uniacid=".$uniacid." and opentime <=".$todays." and opentime >=".$yesterdays;
	if(is_agent == '1')
	{
		$zj .= " and zid in (".$zjs.")";
	}
	$yesterday['doc'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zhuanjia").$zj);
	$order = " where uniacid=".$uniacid." and time <=".$todays." and time >=".$yesterdays;
	if(is_agent == '1')
	{
		$order .= " and zid in (".$zjs.")";
	}
	$yesterday['order'] = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder").$order." group by back_orser");
	$yesterday['order'] = count($yesterday['order']);

	
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
			$condition = '  uniacid=:uniacid and time>=:starttime and time<=:endtime';
			$conditions = '  uniacid=:uniacid and yy_time>=:starttime and yy_time<=:endtime';
			$params = array(':uniacid' => $_W['uniacid'], ':starttime' => strtotime($time . ' 00:00:00'), ':endtime' => strtotime($time . ' 23:59:59'));
			if(is_agent == '1')
			{
				$condition .= " and zid in (".$zjs.")";
				$conditions .= " and zid in (".$zjs.")";
			}
			$guahao = pdo_fetchall('select count(*) from ' . tablename('hyb_yl_guahaoorder') . (' where   ' . $condition." group by back_orser"), $params);
			$guahao = count($guahao);
			$yuyue = pdo_fetchcolumn('select count(*) from ' . tablename('hyb_yl_yuyueorder') . (' where   ' . $conditions), $params);
			
			$datas[] = array(
				'date' => $time,
				'guahao' => $guahao,
				'yuyue' => $yuyue
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
				$condition = '  uniacid=:uniacid and time>=:starttime and time<=:endtime';
				$conditions = '  uniacid=:uniacid and yy_time>=:starttime and yy_time<=:endtime';
				$params = array(':uniacid' => $_W['uniacid'], ':starttime' => strtotime($year . '-' . $month . '-' . $d . ' 00:00:00'), ':endtime' => strtotime($year . '-' . $month . '-' . $d . ' 23:59:59'));
				if(is_agent == '1')
				{
					$condition .= " and zid in (".$zjs.")";
					$conditions .= " and zid in (".$zjs.")";
				}
				$guahao = pdo_fetchall('select count(*) from ' . tablename('hyb_yl_guahaoorder') . (' where   ' . $condition." group by back_orser"), $params);
				$guahao = count($guahao);
				$yuyue = pdo_fetchcolumn('select count(*) from ' . tablename('hyb_yl_yuyueorder') . (' where   ' . $conditions), $params);
				$datas[] = array(
					'date' => $d . '日',
					'guahao' => $guahao,
					'yuyue' => $yuyue
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
					$condition = '  uniacid=:uniacid and time>=:starttime and time<=:endtime';
					$conditions = '  uniacid=:uniacid and yy_time>=:starttime and yy_time<=:endtime';
					$params = array(':uniacid' => $_W['uniacid'], ':starttime' => strtotime($year . '-' . $m['data'] . '-01 00:00:00'), ':endtime' => strtotime($year . '-' . $m['data'] . '-' . $lastday . ' 23:59:59'));
					if(is_agent == '1')
					{
						$condition .= " and zid in (".$zjs.")";
						$conditions .= " and zid in (".$zjs.")";
					}
					$guahao = pdo_fetchall('select count(*) from ' . tablename('hyb_yl_guahaoorder') . (' where   ' . $condition." group by back_orser"), $params);
					$guahao = count($guahao);
					
					$datas[] = array(
						'date' => $m['data'] . '月',
						'guahao' => $guahao,
						'yuyue' => $yuyue
					);
					$datas[] = array('date' => $m['data'] . '月', 'guahao' => $guahao,'yuyue' => pdo_fetchcolumn('select count(*) from ' . tablename('hyb_yl_yuyueorder') . (' where   ' . $conditions), $params));
				}
			}
		}
	}
	include $this->template("remoteregistration/gk");
}
if($op == 'list')
{
	$zid = $_GPC['zid'];
	$state = $_GPC['state'];
	$page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
	$where = " where uniacid=".$uniacid." and style=1";
	if($state != '')
	{
		$where .= " and state=".$state;
	}
	if(is_agent == '1')
	{
		$where .= " and zid in (".$zjs.")";
	}
	
    $res = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_docjobtime").$where." order by id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
    
    $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_docjobtime").$where);

    $pager = pagination($total, $pageindex, $pagesize);
    foreach ($res as $key => $value) {
    	$server_time =unserialize($res[$key]['server_time']);
    	$startTime = $server_time[0]['time'];

        foreach ($startTime as $key1 => $value1) {
        	  $startTime[$key1]['time'] = $startTime[$key1]['startTime'].'-'.$startTime[$key1]['endTime'];
        	  unset($startTime[$key1]['startTime']);
        	  unset($startTime[$key1]['endTime']);
        }
	     $result2 = [];
	     array_map(function ($value) use (&$result2) {
	        $result2 = array_merge($result2, array_values($value));
	     }, $startTime); 
        
        $tmp = '';

        foreach ($server_time as $key2 => $value2) {
           if($value2['week']=='1'){
               $value2['week'] ='星期一';
           }
           if($value2['week']=='2'){
               $value2['week'] ='星期二';
           }
           if($value2['week']=='3'){
               $value2['week'] ='星期三';
           }
           if($value2['week']=='4'){
               $value2['week'] ='星期四';
           }
           if($value2['week']=='5'){
               $value2['week'] ='星期五';
           } 
           if($value2['week']=='6'){
               $value2['week'] ='星期六';
           } 
           if($value2['week']=='0'){
               $value2['week'] ='星期日';
           } 
           $tmp .= $value2['week'].',';
        }

         $res[$key]['weeks'] = rtrim($tmp, ',');
      
	     $res[$key]['times'] =implode(',', $result2);
	    
    } 
	include $this->template("remoteregistration/list");
}
if($op=="schedulingadd"){
		
		$id = $_GPC['id'];
		$zid = $_GPC['zid'];
		$item = pdo_get("hyb_yl_docjobtime",array("id"=>$id));

		if($item)
		{	
			$item['server_time'] = unserialize($item['server_time']);
			
			foreach($item['server_time'] as &$value)
			{
				$item['week'][] = $value['week'];
			}
			$item['times'] = $item['server_time'][0];

		}
		
		if($_W['ispost']){

         $startTime = $_GPC['registerdate']['startTime'];
         $endTime = $_GPC['registerdate']['endTime'];
         $week = $_GPC['halfcard']['week'];
         $nums = $_GPC['nums'];
         $type = $_GPC['type'];
         foreach ($startTime as $key => $value) {
         	$new_time[$key]['startTime'] = $startTime[$key];
         	$new_time[$key]['endTime'] = $endTime[$key];
         }
         foreach ($week as $key => $value) {
         	$time[$key]['week'] = $week[$key];
         	$time[$key]['time'] = $new_time;
         	$time[$key]['nums'] = $nums;
         	$time[$key]['type'] = $type;
         }
         $data =array(
             'uniacid' => $_W['uniacid'],
             'server_time' => serialize($time),
             'nums'     =>$_GPC['nums'],
             'title'    =>$_GPC['title'],
             'state'    =>$_GPC['state'],
             'zid'      =>$_GPC['zid'],
             'type'     =>$_GPC['type'],
             'style'    =>'1'
         	);
         if(!empty($id)){
              pdo_update('hyb_yl_docjobtime',$data,array('id'=>$id));
         }else{
              pdo_insert('hyb_yl_docjobtime',$data);
         }
        
         message("操作成功!",$this->createWebUrl("remoteregistration",array("op"=>"list",'ac'=>'list','hid'=>$_SESSION['hid'])),"success");
		}
		include $this->template('remoteregistration/schedualadd');
	}
	// 排版删除
	if($op == 'schedulingdel')
	{
		$id = $_GPC['id'];
		$res = pdo_delete("hyb_yl_docjobtime",array("id"=>$id));
		if($res)
		{
			message("删除成功!",$this->createWebUrl("remoteregistration",array("op"=>"list",'ac'=>'list','hid'=>$_SESSION['hid'])),"success");
		}else{
			message("删除失败!",$this->createWebUrl("remoteregistration",array("op"=>"list",'ac'=>'list','hid'=>$_SESSION['hid'])),"error");
		}
		include $this->template('remoteregistration/scheduling');
	}
	if($op == 'schedulingdels')
	{
		$ids = $_GPC['ids'];
		foreach($ids as &$value)
		{
			$res = pdo_delete("hyb_yl_docjobtime",array("id"=>$value));
		}
		if($res)
		{
			message("删除成功!",$this->createWebUrl("remoteregistration",array("op"=>"list",'ac'=>'list','hid'=>$_SESSION['hid'])),"success");
		}else{
			message("删除失败!",$this->createWebUrl("remoteregistration",array("op"=>"list",'ac'=>'list','hid'=>$_SESSION['hid'])),"error");
		}
		include $this->template('remoteregistration/scheduling');
	}
// 删除排班
if($op == 'listdel')
{
	$id = $_GPC['id'];
	$res = pdo_delete("hyb_yl_gh_paiban",array("id"=>$id));
	if($res)
	{
		message("删除成功!",$this->createWebUrl("remoteregistration",array("op"=>"list",'ac'=>'list','hid'=>$_SESSION['hid'])),"success");
	}else{
		message("删除失败!",$this->createWebUrl("remoteregistration",array("op"=>"list",'ac'=>'list','hid'=>$_SESSION['hid'])),"error");

	}
	include $this->template('remoteregistration/list');
}
if($op == 'artrule')
{
	$item = pdo_get("hyb_yl_gh_rule",array("uniacid"=>$uniacid));
	if($_W['ispost'])
	{
		$data = array(
			'uniacid' => $uniacid,
			"times" => $_GPC['times'],
			"people" => $_GPC['people'],
			"num" => $_GPC['num'],
			"price" => $_GPC['price'],

		);
		if($item)
		{
			$res = pdo_update("hyb_yl_gh_rule",$data,array("uniacid"=>$uniacid));
		}else{
			$data['created'] = time();
			$res = pdo_insert("hyb_yl_gh_rule",$data);
		}
		if($res)
		{
			message("设置成功!",$this->createWebUrl("remoteregistration",array("op"=>"artrule")),"success");
		}else{
			message("设置失败!",$this->createWebUrl("remoteregistration",array("op"=>"artrule")),"error");

		}
	}
	include $this->template("remoteregistration/artrule");
}
if($op == 'ghorder')
{
	$page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
    $start = empty($_GPC['start']) ? date("Y-m-d",strtotime("-1Months",time())) : $_GPC['start']; 
	$end = empty($_GPC['end']) ? date("Y-m-d",strtotime("+1days",time())) : $_GPC['end'];
	$ifpay = $_GPC['ifpay'];
	$keywordtype = $_GPC['keywordtype'];
	$timetype = $_GPC['timetype'];
	$keyword = $_GPC['keyword'];
	
	$where = " where o.uniacid=".$uniacid;
	if(is_agent == '1')
	{
		$where .= " and o.zid in (".$zjs.")";
	}
	$keshi_arr = pdo_getall("hyb_yl_classgory",array("uniacid"=>$uniacid,"typeint"=>'0'));

	$type_arr = pdo_getall("hyb_yl_ghyy_type",array("uniacid"=>$uniacid));
	$type = $_GPC['type'];
	if($type != '')
	{
		$where .= " and g.yy_type=".$type;
	}
	$keshi = $_GPC['keshi'];
	if($keshi != '')
	{
		$where .= " and z.z_room = ".$keshi;
	}
	$zhuanjia_arr = pdo_getall("hyb_yl_zhuanjia",array("uniacid"=>$uniacid));
	$zhuanjia = $_GPC['zhuanjia'];
	if($zhuanjia != '')
	{
		$where .= " and g.zid=".$zhuanjia;
	}
	if($ifpay != '')
	{
		$where .= " and o.ifpay=".$ifpay;
	}
	if($keywordtype == '1')
	{
		$where .= " and o.orders like '%$keyword%'";
	}else if($keywordtype == '2')
	{
		$where .= " and u.u_name like '%$keyword%'";
	}else if($keywordtype == '3')
	{
		$where .= " and z.z_name like '%$keyword%'";
	}else if($keywordtype == '4')
	{
		$where .= " and u.tell like '%$keyword%'";
	}
	if($timetype == '1')
	{
		$where .= " and o.time >=".strtotime($start)." and o.time <=".strtotime($end);
	}else if($timetype == '2')
	{
		$where .= " and o.paytime >=".strtotime($start)." and o.paytime <=".strtotime($end);
	}
	
	$list = pdo_fetchall("select o.*,u.u_id,u.u_name,u.u_thumb,u.u_phone,z.z_name,z.z_room,z.parentid,z.z_zhicheng,z.qx_id,z.advertisement from".tablename("hyb_yl_guahaoorder")." as o left join ".tablename("hyb_yl_userinfo")." as u on u.openid=o.openid left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=o.zid ".$where." order by o.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
	
	$total = pdo_fetchcolumn("select o.*,u.u_id,u.u_name,u.u_thumb,u.u_phone,z.z_name,z.z_room,z.parentid,z.z_zhicheng,z.qx_id from".tablename("hyb_yl_guahaoorder")." as o left join ".tablename("hyb_yl_userinfo")." as u on u.openid=o.openid left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=o.zid ".$where);
	foreach($list as &$value)
	{
		if(strpos($value['advertisement'],'http') === false)
		{
			$value['advertisement'] = $_W['attachurl'].$value['advertisement'];
		}
		$doctime = pdo_getall("hyb_yl_docjobtime",array("uniacid"=>$uniacid,"zid"=>$value['zid']));
		
		$value['month_time'] = explode("-",$value['month_time']);
		
		foreach($doctime as &$vv)
		{
			$vv['server_time'] = unserialize($vv['server_time']);
			
		
			if($value['month_time'][0] == $vv['server_time'][0]['time'][0]['startTime'] && $value['month_time'][1] == $vv['server_time'][0]['time'][0]['endTime'])
			{
				$value['nums'] = $vv['nums'];
			}
				
		}
		$num = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid." and zid=".$value['zid']." and year='".$value['year']."'");
		
		$value['gh_num'] = $num;
		$value['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$value['parentid']),'name');
		$value['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$value['z_zhicheng']),'job_name');
		$value['jigou'] = pdo_getcolumn("hyb_yl_hospital_diction",array("id"=>$value['qx_id']),'name');
		// $value['describe'] = json_decode($value['describe'],true);
		$value['time'] = date("Y-m-d H:i:s",$value['time']);
		$value['paytime'] = date("Y-m-d H:i:s",$value['paytime']);
		$value['describe'] = unserialize($value['describe']);
		$value['ptmoneys'] = $value['old_money'];
		$value['moneyss'] = $value['ptmoneys'] - $value['ptmoney'] - $value['hosmoney'] - $value['tk_one'] - $value['tk_two'] - $value['coupon_dk'] - $value['card_dk'];
		$value['tk'] = pdo_fetchcolumn("select b.username from ".tablename("hyb_yl_tuikesite")." as a  left join ".tablename("hyb_yl_tuikesite")." as b on b.tkid=a.id where a.uniacid=".$uniacid." and a.openid='".$value['openid']."'");
		// $value['ptmoney'] = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_pay")." where uniacid=".$uniacid." and cash=0 and style=8 and back_orser='".$value['orders']."'");
		// if(!$value['ptmoney'])
		// {
		// 	$value['ptmoney'] = "0.00";
		// }
		// $value['tkmoney'] = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_tuikeshouyi")." where uniacid=".$uniacid." and orders='".$value['orders']."'");
		// if(!$value['tkmoney'])
		// {
		// 	$value['tkmoney'] = "0.00";
		// }
	}
	
	$pager = pagination($total, $pageindex, $pagesize);
	$wheres = "";
	if(is_agent == '1')
	{
		$wheres .= " and zid in (".$zjs.")";
	}
	$count = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid.$wheres);
	$money = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid.$wheres);
	
	if($money == NULL)
	{
		$money = '0.00';
	}
	include $this->template("remoteregistration/ghorder");
}
if($op == 'orderdetail')
{
	$id = $_GPC['id'];
	$item = pdo_get("hyb_yl_guahaoorder",array("id"=>$id));
	$user = pdo_get("hyb_yl_userinfo",array("openid"=>$item['openid']));

	$item['yy_time'] = date("Y-m-d H:i:s",$item['yy_time']);
	$item['created'] = date("Y-m-d H:i:s",$item['created']);
	$item['paytime'] = date("Y-m-d H:i:s",$item['paytime']);
	
	$item['time'] = date("Y-m-d H:i:s",$item['time']);
	$item['jz_time'] = date("Y-m-d H:i:s",$item['jz_time']);
	$item['qx_time'] = date("Y-m-d H:i:s",$item['qx_time']);
	$item['apply_time'] = date("Y-m-d H:i:s",$item['apply_time']);
	$item['refund_time'] = date("Y-m-d H:i:s",$item['refund_time']);
	$item['overtime'] = date("Y-m-d H:i:s",$item['overtime']);
	$item['type_name'] = pdo_getcolumn("hyb_yl_ghyy_type",array("id"=>$item['type']),'title');
	$item['moneyss'] = $item['old_money'] - $item['ptmoney'] - $item['hosmoney'] - $item['tk_one'] - $item['tk_two'] - $item['coupon_dk'] - $item['card_dk'];
	$item['tk'] = pdo_fetchcolumn("select b.username from ".tablename("hyb_yl_tuikesite")." as a  left join ".tablename("hyb_yl_tuikesite")." as b on b.tkid=a.id where a.uniacid=".$uniacid." and a.openid='".$item['openid']."'");
	$zhuanjia = pdo_get("hyb_yl_zhuanjia",array("zid"=>$item['zid']));
	if(strpos($zhuanjia['advertisement'],'http') === false)
	{
		$zhuanjia['advertisement'] = tomedia($zhuanjia['advertisement']);
	}
	$item['describe'] = unserialize($item['describe']);
	$zhuanjia['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$zhuanjia['parentid']),'name');
	$zhuanjia['jigou'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$zhuanjia['hid']),'agentname');
	$zhuanjia['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$zhuanjia['z_zhicheng']),'job_name');
	$item['moneyss'] = $item['old_money'] - $item['ptmoney'] - $item['hosmoney'] - $item['tk_one'] - $item['tk_two'] - $item['coupon_dk'] - $item['card_dk'] - $item['year_dk'];
	
	include $this->template("remoteregistration/orderdetail");
}
if($op == 'order_qz')
{
	$id = $_GPC['id'];
	$res = pdo_update("hyb_yl_guahaoorder",array("status"=>'2'),array("id"=>$id));
	if($res)
	{
		message("操作成功!",$this->createWebUrl("remoteregistration",array("op"=>"orderdetail","id"=>$id)),"success");
	}else{
		message("操作失败!",$this->createWebUrl("remoteregistration",array("op"=>"orderdetail","id"=>$id)),"error");

	}
	include $this->template("remoteregistration/orderdetail");
}
if($op == 'yy_qz')
{
	$id = $_GPC['id'];
	$res = pdo_update("hyb_yl_yuyueorder",array("status"=>'2'),array("id"=>$id));
	if($res)
	{
		message("操作成功!",$this->createWebUrl("remoteregistration",array("op"=>"yy_detail","id"=>$id)),"success");
	}else{
		message("操作失败!",$this->createWebUrl("remoteregistration",array("op"=>"yy_detail","id"=>$id)),"error");

	}
	include $this->template("remoteregistration/yy_detail");
}
if($op == 'schedual')
{
	$page = empty($_GPC['page']) ? "" : $_GPC['page'];
	$pageindex = max(1, intval($page));
	$pagesize = 10;
	$where = " where uniacid=".$uniacid;
	$status = $_GPC['status'];
	if($status != '')
	{
		$where .= " and status=".$status;
	}
	$list = pdo_fetchall("select * from ".tablename("hyb_yl_guahao_time").$where." order by id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
	
	$count = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_guahao_time").$where);
	$pager = pagination($total, $pageindex, $pagesize);
	foreach($list as &$value)
	{
		$value['server_time'] = unserialize($value['server_time']);
	}
	include $this->template("remoteregistration/schedual");
}
if($op == 'schedualadd')
{
	$id = $_GPC['id'];
	$item = pdo_get("hyb_yl_guahao_time",array("id"=>$id));
	$item['server_time'] = unserialize($item['server_time']);
	if($_W['ispost'])
	{
		$startTime = $_GPC['registerdate']['startTime'];
         $endTime = $_GPC['registerdate']['endTime'];
		foreach ($startTime as $key => $value) {
         	$new_time[$key]['startTime'] = $startTime[$key];
         	$new_time[$key]['endTime'] = $endTime[$key];
         }
         $data = array(
         	'uniacid' => $_W['uniacid'],
         	"server_time" => serialize($new_time),
         	"status" => $_GPC['status'],
         	"title" => $_GPC['title'],
 		);
         if($id)
         {
         	$res = pdo_update("hyb_yl_guahao_time",$data,array("id"=>$id));
         }else{
         	$data['created'] = time();
         	$res = pdo_insert("hyb_yl_guahao_time",$data);
         }
	}
	include $this->template("remoteregistration/schedualadd");
}
// 挂号订单删除
if($op == 'orderdel')
{
	$id = $_GPC['id'];
	$res = pdo_delete("hyb_yl_guahaoorder",array("uniacid"=>$uniacid,"id"=>$id));
	if($res)
	{
		message("操作成功!",$this->createWebUrl("remoteregistration",array("op"=>"ghorder")),"success");
	}else{
		message("操作失败!",$this->createWebUrl("remoteregistration",array("op"=>"ghorder")),"error");
	}
	include $this->template("remoteregistration/ghorder");
}

// 挂号订单确认到诊
if($op == 'daozhen')
{
	$id = $_GPC['id'];
	$res = pdo_update("hyb_yl_guahaoorder",array("status"=>2),array("id"=>$id,"uniacid"=>$uniacid));
	if($res)
	{
		message("操作成功!",$this->createWebUrl("remoteregistration",array("op"=>"ghorder")),"success");
	}else{
		message("操作失败!",$this->createWebUrl("remoteregistration",array("op"=>"ghorder")),"error");
	}
	include $this->template("remoteregistration/ghorder");
}
// 查看适合专家
if($op == 'allzhuanjia')
{
    
    $hid = $_GPC['hid'];
    $week = $_GPC['week'];
    $res = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_doc_all_serverlist')."WHERE uniacid='{$uniacid}' and key_words='yuanchengguahao' and stateback=1 ");
    
    $row = array();
    foreach($res as $kk =>$vv)
    {
        $zhuanjia = pdo_get("hyb_yl_zhuanjia",array("uniacid"=>$uniacid,"zid"=>$vv['zid']));
        $zid = $vv['zid'];
        if($week != '')
        {
            $doc_jobtime = pdo_get("hyb_yl_docjobtime",array("uniacid"=>$uniacid,"id"=>$zhuanjia['jobtime']));
            if($doc_jobtime == '')
            {
                $doc_jobtime = pdo_get("hyb_yl_docjobtime",array("uniacid"=>$uniacid,"zid"=>$vv['zid']));
            }
            $doc_jobtime = unserialize($doc_jobtime['server_time']);
            $week_arr = array_column($doc_jobtime, 'week');
            
            if(!$doc_jobtime || in_array($week, $week_arr) === false)
            {

                unset($res[$kk]);
            }
            
        }
    }
   
    if(count($res) > 0)
    {
        foreach ($res as $key => $value) {
          $zid = $value['zid'];
          $wheres = '';
          
          if($hid != '')
          {
              $wheres .= " and hid=".$hid;
          }
         $where ="where uniacid ='{$uniacid}'".$wheres." and zid='{$zid}' "; 
          
          
          $rows =pdo_fetchall("SELECT * FROM " . tablename('hyb_yl_zhuanjia') . " {$where}");
         
          $row = array_merge($row,$rows);
        }
    }
    
    echo json_encode($row);
    exit();
}

// 查看专家标签及时间
if($op == 'docbiaoqian')
{
    $zid = $_GPC['zid'];
    $authority = pdo_getcolumn("hyb_yl_zhuanjia",array("uniacid"=>$uniacid,"zid"=>$zid),'authority');
    $authority = explode("、",$authority);
    $docjobtime = pdo_fetch("select a.* from ".tablename("hyb_yl_docjobtime")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.register_jobtime=a.id where a.uniacid=".$uniacid." and z.zid=".$zid);
    if($docjobtime)
    {
        $server_time = unserialize($docjobtime['server_time']);
        $times = $server_time['0']['time'];
    }else{
        $docjobtime = pdo_get("hyb_yl_docjobtime",array("uniacid"=>$uniacid,"zid"=>$zid,'style'=>'1'));
        if(!$docjobtime)
        {
            $docjobtime = pdo_get("hyb_yl_docjobtime",array("uniacid"=>$uniacid));
        }
        $server_time = unserialize($docjobtime['server_time']);
        $times = $server_time['0']['time'];
    }
    $list['authority'] = $authority;
    $list['times'] = $times;
    echo json_encode($list);
    exit();
}
// 查看用户家庭成员
if($op == 'userjiaren')
{
    $openid = $_GPC['openid'];
    $list = pdo_getall("hyb_yl_userjiaren",array("uniacid"=>$uniacid,"openid"=>$openid));
    echo json_encode($list);
    exit();
}
// 添加挂号预约
if($op == 'addsubscribe')
{
    $ks_list = pdo_getall("hyb_yl_classgory",array("uniacid"=>$uniacid,"typeint"=>0));
    $ks_two = pdo_getall("hyb_yl_classgory",array("uniacid"=>$uniacid,"typeint"=>$keshi_one[0]['id']));
    $yy_type = pdo_getall("hyb_yl_ghyy_type",array("uniacid"=>$uniacid,"status"=>'1'));
    $id = $_GPC['id'];
    $item = pdo_get("hyb_yl_guahaoorder",array("uniacid"=>$uniacid,"id"=>$id));
    if($item)
    {
        $zhuanjia = pdo_get("hyb_yl_zhuanjia",array("uniacid"=>$uniacid,"zid"=>$item['zid']));
        $zhuanjias = pdo_getall("hyb_yl_zhuanjia",array("uniacid"=>$uniacid,"hid"=>$zhuanjia['hid']));
        $quanxian2 = pdo_getall("hyb_yl_hospital",array("uniacid"=>$uniacid,"groupid"=>$zhuanjia['qx_id']));
        $user = pdo_get("hyb_yl_userinfo",array("uniacid"=>$uniacid,"openid"=>$item['openid']));
        $item['u_name'] = $user['u_name'];
        $item['u_id'] = $user['u_id'];
        $userjr = pdo_getall("hyb_yl_userjiaren",array("uniacid"=>$uniacid,"openid"=>$item['openid']));
        $item['describe'] = unserialize($item['describe']);
        
        $label = explode("、",$zhuanjia['authority']);
        if($item['biaoqian'] != '')
        {
            $item['biaoqian'] = explode(",",$item['biaoqian']);
        }
        $item['qx_id'] = $zhuanjia['qx_id'];
        $item['hid'] = $zhuanjia['hid'];
        
        $docjobtime = pdo_fetch("select a.* from ".tablename("hyb_yl_docjobtime")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.register_jobtime=a.id where a.uniacid=".$uniacid." and z.zid=".$item['zid']);
        if($docjobtime)
        {
            $server_time = unserialize($docjobtime['server_time']);
            $times = $server_time['0']['time'];
        }else{
            $docjobtime = pdo_get("hyb_yl_docjobtime",array("uniacid"=>$uniacid,"zid"=>$item['zid'],'style'=>'1'));
            if(!$docjobtime)
            {
                $docjobtime = pdo_get("hyb_yl_docjobtime",array("uniacid"=>$uniacid));
            }
            $server_time = unserialize($docjobtime['server_time']);
            $times = $server_time['0']['time'];
        }
        foreach($times as &$ts)
        {
            $ts['tms'] = $ts['startTime'] . "-".$ts['endTime'];
        }
        
    }
    $curtime = time();
    for($i=0;$i<=6;$i++)
    {
        $curdate[$i]['date'] = date("m-d",$curtime+$i*24*60*60);
        $curdate[$i]['dates'] = date("Y-m-d",$curtime+$i*24*60*60);
    }

    foreach($curdate as $k=>$v){

       $curdate[$k]['week']=get_weeks($v['dates']);
       $curdate[$k]['weeks']=get_week($v['dates']);

    }
    
    
    if($_W['ispost'])
    {
        $res = pdo_get('hyb_yl_parameter', array('uniacid' => $_W['uniacid']));
        $mch_id = $res['mch_id'];
        $out_trade_no = $mch_id . time();
        $order_time = pdo_get("hyb_yl_gh_rule",array('uniacid'=>$uniacid));
         $chaoshi = $order_time['times'];
         $money = $_GPC['money'];
         if($money =='0.00'){
            $ifpay = 1;
            $paytime = time();
         }else{
            $ifpay = 0;
            $paytime = 0;
         }
         $time_b = intval($chaoshi * 3600);
         $newtime  = date("Y-m-d H:i:s");
         $overtime = date("Y-m-d H:i:s",strtotime($newtime)+$time_b);
         $z_tel = pdo_getcolumn("hyb_yl_zhuanjia",array("uniacid"=>$uniacid,"z_id"=>$_GPC['z_id']),'z_telephone');
         $content = $_GPC['content'];
         $imgpath = $_GPC['imgpath'];
         $describe = array();
         $describe['text'] = $content;
         $moneys = pdo_getcolumn("hyb_yl_doc_all_serverlist",array("uniacid"=>$uniacid,"zid"=>$_GPC['zid'],'key_words'=>'yuanchengguahao'),'ptmoney');
         if(count($imgpath) > 0)
         {
             $describe['typedate'] = '1';
             $describe['upload_picture_list'] = $imgpath;
         }else{
             $describe['typedate'] = '0';
             $describe['upload_picture_list'] = array();
         }
         $describe = serialize($describe);
         $userinfo = pdo_get("hyb_yl_userinfo",array("uniacid"=>$uniacid,"openid"=>$_GPC['openid']));
         $userjr = pdo_get("hyb_yl_userjiaren",array("uniacid"=>$uniacid,"j_id"=>$_GPC['j_id']));
         $month_time = $_GPC['month_time'];
         $time = explode("-",$month_time);
         $start = explode(":",$time[0]);
         $end = explode(":",$time[1]);
         $times = $_GPC['time'];
        $data = array(
            'uniacid' => $uniacid,
            "zid" => $_GPC['zid'],
            "openid" => $_GPC['openid'],
            // "status" => $_GPC['status'],
            "ifpay" => $_GPC['ifpay'],
            "paytime" =>strtotime($_GPC['paytime']),
            "p_type" => $_GPC['p_type'],
            "ordersn" => $out_trade_no,
            
            "money" => $moneys,
            "yy_time" => $_GPC['yy_time'],
            "describe" => $describe,
            "type" => '1',
            "biaoqian" => implode(",",$_GPC['authority']),
            "orders" => $out_trade_no,
            "back_orser" => $out_trade_no,
            "overtime" => strtotime($overtime),
            "j_id" => $_GPC['j_id'],
            "week" => $curdate[$times]['week'],
            "year" => $curdate[$times]['dates'] . ' ' .$_GPC['month_time'],
            "privateNum" => $z_tel,
            "month_time" => $_GPC['month_time'],
            "startime" => $start[0],
            "endtime" => $end[0],
            "roomID" => $user['randnum'],
           'addnum'    => '1',
           "is_admin" => '1',
           "yy_type" => $_GPC['yy_type'],
        );
        
        if($id)
        {
            $res = pdo_update("hyb_yl_guahaoorder",$data,array("id"=>$id));
        }else{
            $data['time'] = time();
            $res = pdo_insert("hyb_yl_guahaoorder",$data);
        }
        
        if($res)
        {
            message("操作成功!",$this->createWebUrl("remoteregistration",array("op"=>"subscribe")),"success");
    	}else{
    		message("操作失败!",$this->createWebUrl("remoteregistration",array("op"=>"subscribe")),"error");
    	}
    }
    
    include $this->template("remoteregistration/addsubscribe");
}

if($op == 'delsubscribe')
{
	$id = $_GPC['id'];
	$res = pdo_delete("hyb_yl_guahaoorder",array("uniacid"=>$uniacid,"id"=>$id));
	if($res)
	{
		message("操作成功!",$this->createWebUrl("remoteregistration",array("op"=>"subscribe")),"success");
	}else{
		message("操作失败!",$this->createWebUrl("remoteregistration",array("op"=>"subscribe")),"error");
	}
	include $this->template("remoteregistration/subscribe");
}

if($op == 'del_subscribe')
{
	$ids = $_GPC['ids'];

	for($i=0;$i<count($ids);$i++)
	{
		pdo_delete("hyb_yl_yuyueorder",array("id" => $ids[$i]));
	}
	die(json_encode(array('errno'=>1,'message'=>1)));
}


if($op == 'del_guahaos')
{
	$ids = $_GPC['ids'];
	
	for($i=0;$i<count($ids);$i++)
	{
		$res = pdo_delete("hyb_yl_guahaoorder",array("back_orser" => $ids[$i]));
		
	}
	die(json_encode(array('errno'=>1,'message'=>1)));
}
function get_weeks($date){

       $date_str=date('Y-m-d',strtotime($date));
       $arr=explode("-", $date_str);
       $year=$arr[0];
       $month=sprintf('%02d',$arr[1]);
       $day=sprintf('%02d',$arr[2]);
       $hour = $minute = $second = 0;
       $strap = mktime($hour,$minute,$second,$month,$day,$year);
       $number_wk=date("w",$strap);
       $weekArr=array("周日","周一","周二","周三","周四","周五","周六");
       return $weekArr[$number_wk];

    }
    function get_week($date) {
        //强制转换日期格式
        $date_str = date('Y-m-d', strtotime($date));
        //封装成数组
        $arr = explode("-", $date_str);
        //参数赋值
        //年
        $year = $arr[0];
        //月，输出2位整型，不够2位右对齐
        $month = sprintf('%02d', $arr[1]);
        //日，输出2位整型，不够2位右对齐
        $day = sprintf('%02d', $arr[2]);
        //时分秒默认赋值为0；
        $hour = $minute = $second = 0;
        //转换成时间戳
        $strap = mktime($hour, $minute, $second, $month, $day, $year);
        //获取数字型星期几
        $number_wk = date("w", $strap);
        //自定义星期数组
        $weekArr = array("0", "1", "2", "3", "4", "5", "6");
        //获取数字对应的星期
        return $weekArr[$number_wk];
    }
