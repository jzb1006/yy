<?php

global $_W,$_GPC;
$uniacid = $_W['uniacid'];
$op = $_GPC['op'];
 $_W['plugin'] ='physical';
//体检概况
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
if($op == 'index')
{
	$todayss = date("Y-m-d H:i:s",time());
	$todays = strtotime(date("Y-m-d",time()));;
	$yesterdays = mktime(0,0,0,date('m'),date('d')-1,date('Y'));
	$sevens = mktime(0,0,0,date('m'),date('d'),date('Y'))-1;
	$monthse = mktime(0,0,0,date('m'),date('d')-30,date('Y'));
	if(is_agent == '1')
	{
		if($zjs != '')
		{
			$wheres = " and zid in (".$zjs.")";
		}else{
			$wheres = " and zid =''";
		}
	}
	$today['taocan'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_taocan")." where uniacid=".$uniacid." and created>=".$todays);
	$today['tijian'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and time>=".$todays.$wheres);
	$today['hospital'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_hospital")." where uniacid=".$uniacid." and zctime>=".$todays);
	$today['money'] = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and ifpay=1 and time>=".$todays.$wheres);
	if(!$today['money'])
	{
		$today['money'] = '0.00';
	}
	$today['duibi'] = '0';
	$today['huanzhe'] = '0';
	$today['order'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and ifpay=1 and time>=".$todays.$wheres);
	$hexiao = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and ifpay=1".$wheres);
	$tuikuan = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and ifpay=6".$wheres);
	$yitui = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and ifpay=7".$wheres);
	$huanzhe = '0';
	$baogao = '0';

	$yesterday['taocan'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_taocan")." where uniacid=".$uniacid." and created>=".$yesterdays." and created<=".$todays);
	$yesterday['tijian'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and time>=".$yesterdays." and time <=".$todays.$wheres);
	$yesterday['hospital'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_hospital")." where uniacid=".$uniacid." and zctime>=".$yesterdays." and zctime<=".$todays);
	$yesterday['money'] = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and ifpay=1 and time>=".$yesterdays." and time <=".$todays.$wheres);
	if(!$yesterday['money'])
	{
		$yesterday['money'] = '0.00';
	}
	$yesterday['duibi'] = '0';
	$yesterday['huanzhe'] = '0';
	$yesterday['order'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and ifpay=1 and time>=".$yesterdays." and time <=".$todays.$wheres);

	$seven['money'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and ifpay=1 and time>=".$sevens.$wheres);
	if(!$seven['money'])
	{
		$seven['money'] = '0.00';
	}
	$monthss['money'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and ifpay=1 and time>=".$monthse.$wheres);
	if(!$monthss['money'])
	{
		$monthss['money'] = '0.00';
	}

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
			$datas[] = array(
				'date' => $time,
				'order' => pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=:uniacid and time >=:starttime and time <=:endtime".$wheres,$params),
				'hospital' => pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_hospital")." where uniacid=:uniacid and zctime >=:starttime and zctime <=:endtime",$params),
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
				$datas[] = array(
					'date' => $d . '日', 
					'order' => pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=:uniacid and time >=:starttime and time <=:endtime".$wheres,$params),
					'hospital' => pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_hospital")." where uniacid=:uniacid and zctime >=:starttime and zctime <=:endtime",$params),
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
					$datas[] = array(
						'date' => $m['data'] . '月',
						'order' => pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tijianorder")." where uniacid=:uniacid and time >=:starttime and time <=:endtime",$params),
						'hospital' => pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_hospital")." where uniacid=:uniacid and zctime >=:starttime and zctime <=:endtime",$params),
					);
				}
			}
		}
	}

	include $this->template("physical/index");
}
if($op == 'add')
{
	include $this->template("physical/add");
}
//模板列表
if($op == 'mblist')
{
	
    $page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
    $keywordtype = $_GPC['keywordtype'];
    $where = " where uniacid=".$uniacid;
    $keyword = $_GPC['keyword'];
    if($keywordtype == '0')
    {
    	$where .= " and type like '%$keyword%'";
    }else if($keywordtype == '1')
    {
    	$where .= " and (title like '%$keyword%' or content like '%$keyword%')";
    }
    $list = pdo_fetchall("select * from ".tablename("hyb_yl_tijian_moban").$where." order by id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
    foreach($list as &$value)
    {
    	$project = pdo_getcolumn("hyb_yl_tijian_project",array("m_id"=>$value['id']),'title');
    	$value['content'] .= $project.",";
    }
    $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tijian_moban").$where);
    $pager = pagination($total, $pageindex, $pagesize);
	include $this->template("physical/mblist");
}
//添加模板
if($op == 'mblistadd')
{
	$id = $_GPC['id'];
	$item = pdo_get("hyb_yl_tijian_moban",array("id"=>$id));
	if ($_W['ispost']) {
		$moban = $_GPC['moban'];
		$id = $moban['id'];
		$data = array(
			'title' => $moban['title'],
			"uniacid" => $_W['uniacid'],
			"status" => $moban['status'],
			"type" => $moban['type'],
		);

		if($id)
		{
			$res = pdo_update("hyb_yl_tijian_moban",$data,array("id"=>$id));
		}else{
			$data['created'] = time();
			$res = pdo_insert("hyb_yl_tijian_moban",$data);
		}
		if($res)
		{
			message("编辑成功!",$this->createWebUrl("physical",array("op"=>"mblist")),"success");
		}else{
			message("编辑失败!",$this->createWebUrl("physical",array("op"=>"mblist")),"success");
		}

	}
	include $this->template("physical/mblistadd");
}
// 模板删除
if($op == 'mbdel')
{
	$id = $_GPC['id'];
	pdo_delete("hyb_yl_tijian_project",array("m_id"=>$id));
	$res = pdo_delete("hyb_yl_tijian_moban",array("id"=>$id));
	if($res)
	{
		message("删除成功!",$this->createWebUrl("physical",array("op"=>"mblist")),"success");
		
	}else{
		message("删除失败!",$this->createWebUrl("physical",array("op"=>"mblist")),"success");
	}
	include $this->template("physical/mblist");
}
// 模板批量删除
if($op == 'mbdels')
{
	$ids = $_GPC['ids'];
	foreach($ids as &$value)
	{
		pdo_delete("hyb_yl_tijian_project",array("m_id"=>$value));
		pdo_delete("hyb_yl_tijian_moban",array("id"=>$value));
	}
	message("删除成功!",$this->createWebUrl("physical",array("op"=>"mblist")),"success");
	include $this->template("physical/mblist");
}
//项目列表
if($op == 'mbitem')
{
	$m_id = $_GPC['m_id'];
	$page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
    $type = $_GPC['type'];
    $keyword = $_GPC['keyword'];
    $_GPC['ac'] = 'mbitem';
    $where = " where uniacid=".$uniacid." and m_id=".$m_id;
    if($keyword != '')
    {
    	$where .= " and (title like '%$keyword%' or content like '%$keyword%')";
    }
    $list = pdo_fetchall("select * from ".tablename("hyb_yl_tijian_project").$where." order by id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
    $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tijian_project").$where);
    $pager = pagination($total, $pageindex, $pagesize);
	include $this->template("physical/mbitem");
}
//添加项目
if($op == 'mbitemadd')
{
	$id = $_GPC['id'];
	$m_id = $_GPC['m_id'];
	$item = pdo_get("hyb_yl_tijian_project",array("id"=>$id));
	if ($_W['ispost']) {
		$project = $_GPC['project'];
		$data = array(
			'title' => $project['title'],
			"uniacid" => $_W['uniacid'],
			"status" => $project['status'],
			"english" => $project['english'],
			"min" => $project['min'],
			"max" => $project['max'],
			"unit" => $project['unit'],
			"content" => $project['content'],
			"price" => $project['price'],
			"m_id" => $m_id,
			'destic' =>$project['destic'],
			'type'   =>$project['type'],
			'text'   =>$project['text'],
			'text2'  =>$project['text2'],
		);
		if($id)
		{
			$res = pdo_update("hyb_yl_tijian_project",$data,array("id"=>$id));
		}else{
			$data['created'] = time();
			$res = pdo_insert("hyb_yl_tijian_project",$data);
		}
		if($res)
		{
			message("编辑成功!",$this->createWebUrl("physical",array("op"=>"mbitem",'m_id'=>$m_id)),"success");
		}else{
			message("编辑失败!",$this->createWebUrl("physical",array("op"=>"mbitem",'m_id'=>$m_id)),"success");
		}

	}
	include $this->template("physical/mbitemadd");
}
// 项目删除
if($op == 'mbitemdel')
{
	$id = $_GPC['id'];
	$m_id = $_GPC['m_id'];
	$res = pdo_delete("hyb_yl_tijian_project",array("id"=>$id));
	if($res)
	{
		message("删除成功!",$this->createWebUrl("physical",array("op"=>"mbitem","m_id"=>$m_id)),"success");
	
	}else{
		message("删除失败!",$this->createWebUrl("physical",array("op"=>"mbitem","m_id"=>$m_id)),"success");
	}
	include $this->template("physical/mbitem");
}
// 项目批量删除
if($op == 'mbitemdels')
{
	$ids = $_GPC['ids'];
	$m_id = $_GPC['m_id'];
	foreach($ids as &$value)
	{
		pdo_delete("hyb_yl_tijian_project",array("id"=>$value));
	}
	message("删除成功!",$this->createWebUrl("physical",array("op"=>"mbitem","m_id"=>$m_id)),"success");
	include $this->template("physical/mbitem");
}
//套餐分类
if($op == 'sort')
{
	$page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
    $type = $_GPC['type'];
    $keyword = $_GPC['keyword'];
    $where = " where uniacid=".$uniacid;
    if($keyword != '')
    {
    	$where .= " and title like '%$keyword%'";
    }
    $list = pdo_fetchall("select * from ".tablename("hyb_yl_taocan_cate").$where." order by id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
    foreach($list as &$value){
    	$value['thumb'] = $_W['attachurl'].$value['thumb'];
    	$value['icon'] = $_W['attachurl'].$value['icon'];
    }
    $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_taocan_cate").$where);
    $pager = pagination($total, $pageindex, $pagesize);
	include $this->template("physical/sort");
}
//添加分类
if($op == 'sortadd')
{
	$id = $_GPC['id'];
	$item = pdo_get("hyb_yl_taocan_cate",array("id"=>$id));

	if ($_W['ispost']) {
		$data = array(
			'title' => $_GPC['title'],
			"uniacid" => $_W['uniacid'],
			"status" => $_GPC['status'],
			"thumb" => $_GPC['thumb'],
			"icon" => $_GPC['icon'],
			"is_tuijian" => $_GPC['is_tuijian'],

		);
		if($id)
		{
			$res = pdo_update("hyb_yl_taocan_cate",$data,array("id"=>$id));
		}else{
			$data['created'] = time();
			$res = pdo_insert("hyb_yl_taocan_cate",$data);
		}
		if($res)
		{
			message("编辑成功!",$this->createWebUrl("physical",array("op"=>"sort")),"success");
		}else{
			message("编辑成功!",$this->createWebUrl("physical",array("op"=>"sort")),"success");
		}

	}
	include $this->template("physical/sortadd");
}

// 套餐分类删除
if($op == 'sortdel')
{
	$id = $_GPC['id'];
	$res = pdo_delete("hyb_yl_taocan_cate",array("id"=>$id));
	if($res)
	{
		message("删除成功!",$this->createWebUrl("physical",array("op"=>"sort")),"success");
	}else{
		message("删除成功!",$this->createWebUrl("physical",array("op"=>"sort")),"success");
	}
	include $this->template("physical/sortadd");
}

// 套餐分类批量删除
if($op == 'sortdels')
{
	$ids = $_GPC['ids'];
	foreach($ids as &$value)
	{
		$res = pdo_delete("hyb_yl_taocan_cate",array("id"=>$value));
	}
	if($res)
	{
		message("删除成功!",$this->createWebUrl("physical",array("op"=>"sort")),"success");
	}else{
		message("删除成功!",$this->createWebUrl("physical",array("op"=>"sort")),"success");
	}
	include $this->template("physical/sortadd");
}
//套餐列表
if($op == 'tclist')
{
	$page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
    $type = $_GPC['type'];
    $keyword = $_GPC['keyword'];
    $where = " where uniacid=".$uniacid;
    $status = $_GPC['status'];
    if($status != '' && $status == '1')
    {
    	$where .=" and status=1 and typs=0";
    }else if($status != '' && $status == '2')
    {
    	$where .= "and status=0";
    }else if($status != '' && $status == '3')
    {
    	$where .= "and status=2";
    }else if($status == '4')
    {
    	$where .=" and typs=1";
    }else if($status == '5')
    {
    	$where .= " and status=3";
    }
    if($keyword != '')
    {
    	$where .= " and title like '%$keyword%'";
    }
    
    $list = pdo_fetchall("select * from ".tablename("hyb_yl_taocan").$where." order by id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);


    foreach($list as $key=>$value)
    {
    	$value[$key]['imgpath'] = json_decode($value['imgpath'],true);
	    //查询套餐分类
	    $list[$key]['tcfl'] = pdo_get('hyb_yl_taocan_cate',array('id'=>$value['type']),array('title'));
	    //查询套餐适应人群
	    $crowd = explode(',', $value['crowd']);
	    foreach ($crowd as $k1 => $v1) {
	    $list[$key]['tcper'][] = pdo_get('hyb_yl_tijian_crowd',array('id'=>$v1),array('title'));
	    }
		$id = $value['id'];
		$list[$key]['xiaoliang'] = pdo_fetchcolumn("select count(*) from".tablename('hyb_yl_tijianorder')."where uniacid='{$uniacid}' and tid='{$id}'");
	    $list[$key]['payover'] = pdo_fetchcolumn("select count(*) from".tablename('hyb_yl_tijianorder')."where uniacid='{$uniacid}' and tid='{$id}' and ifpay=1");
	    $list[$key]['overdrder'] = pdo_fetchcolumn("select count(*) from".tablename('hyb_yl_tijianorder')."where uniacid='{$uniacid}' and tid='{$id}' and ifover=1");
	    //查询套餐分院
	    $hid = json_decode($value['hid'],true);
	    foreach ($hid as $k => $v) {

	    	 $list[$key]['fenyuan'][] = pdo_fetch("SELECT agentname from".tablename('hyb_yl_hospital')."where hid='{$v}'");
	    }
         //查询模板
	    $m_id = $value['tijian'];
	    $moban_one = pdo_getall('hyb_yl_tijian_project',array('uniacid'=>$uniacid,'m_id'=>$m_id));
	    $list[$key]['tijianxiang'] =count($moban_one);

    }
    $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_taocan").$where);

    $pager = pagination($total, $pageindex, $pagesize);
    $count = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_taocan")." where uniacid=".$uniacid);
    $sell = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_taocan")." where uniacid=".$uniacid." and status=1 and typs=0");
    $shenhe = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_taocan")." where uniacid=".$uniacid." and status=0");
    $jujue = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_taocan")." where uniacid=".$uniacid." and status=2");
    $xiajia = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_taocan")." where uniacid=".$uniacid." and typs=1");
    $del = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_taocan")." where uniacid=".$uniacid." and status=3");
	include $this->template("physical/tclist");
}
//套餐添加
if($op == 'tclistadd')
{
	$id = $_GPC['id'];
	$_GPC['ac'] = 'tclistadd';
	$itemArr = pdo_get("hyb_yl_taocan",array("id"=>$id));

	$crowdArr = explode(',', $itemArr['crowd']);
	$hidArr = json_decode($itemArr['hid'],true);
	if($itemArr)
	{
		$itemArr['imgpath'] = json_decode($itemArr['imgpath'],true);
	}

	$athuo_list = pdo_getall("hyb_yl_hospital_diction",array('uniacid'=>$uniacid));
	$yunfei = pdo_getall("hyb_yl_yunfei",array("uniacid"=>$uniacid));

	$renqun = pdo_getall("hyb_yl_tijian_crowd",array("uniacid"=>$uniacid));
	$cate = pdo_getall("hyb_yl_taocan_cate",array("uniacid"=>$uniacid,"status"=>'1'));
	$crowds = pdo_getall("hyb_yl_tijian_crowd",array("uniacid"=>$uniacid,"status"=>'1'));
	$moban = pdo_getall("hyb_yl_tijian_moban",array("uniacid"=>$uniacid,"status"=>'1'));
	//查询二级机构
	$id_jg = $itemArr['jigou_one'];

	$one_quanx = pdo_fetchall("select * from".tablename('hyb_yl_hospital_level')."where uniacid='{$uniacid}'");

    $erji = pdo_fetchall("select * from".tablename('hyb_yl_hospital')."where uniacid='{$uniacid}' and groupid='{$id_jg}'");
    $lit_host = pdo_fetchall("SELECT * from".tablename('hyb_yl_hospital')."where uniacid='{$uniacid}'");

	if ($_W['ispost']) {
		$taocan = $_GPC['taocan'];
		$crowd = implode(',', $_GPC['crowd']);
		$hid =json_encode($_GPC['hid']);
		$data = array(
			'sort' => $taocan['sort'],
			"uniacid" => $_W['uniacid'],
			"title" => $taocan['title'],
			"thumb" => $taocan['thumb'],
			"imgpath" => json_encode($taocan['imgpath'],true),
			"type" => $taocan['type'],
			'crowd' => $crowd,
			"jigou_one" => $taocan['jigou_one'],
			"jigou_two" => $taocan['jigou_two'],
			"time" => $taocan['time'],
			"yunfei" => $taocan['yunfei'],
			"price" => $taocan['price'],
			"num" => $taocan['num'],
			'content' => $taocan['content'],
			"notes" => $taocan['notes'],
			"status" => $taocan['status'],
			"typs" => $taocan['typs'],
			"is_tui" => $taocan['is_tui'],
			"is_tuijian" => $taocan['is_tuijian'],
			"is_vip" => $taocan['is_vip'],
			"vip_money" => $taocan['vip_money'],
			"is_fenxiao" => $taocan['is_fenxiao'],
			"is_guoqi" => $taocan['is_guoqi'],
			"tijian" => $taocan['tijian'],
			'fx_one' =>$taocan['fx_one'],
			'fx_two' =>$taocan['fx_two'],
			'js_time' =>$taocan['js_time'],
			'hid'    => $hid
		);
	

		if($id)
		{
			$res = pdo_update("hyb_yl_taocan",$data,array("id"=>$id));
		}else{
			$data['created'] = time();
			
			$res = pdo_insert("hyb_yl_taocan",$data);
		}
		if($res)
		{
			message("编辑成功!",$this->createWebUrl("physical",array("op"=>"tclist",'ac'=>'tclistadd')),"success");
		}else{
			message("编辑成功!",$this->createWebUrl("physical",array("op"=>"tclist",'ac'=>'tclistadd')),"success");
		}

	}
	include $this->template("physical/tclistadd");
}
// 套餐适合人群列表
if($op == 'crowd')
{
	$page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
    $keyword = $_GPC['keyword'];
    $where = " where uniacid=".$uniacid;
    if($keyword != '')
    {
    	$where .= " and title like '%$keyword%'";
    }
    $list = pdo_fetchall("select * from ".tablename("hyb_yl_tijian_crowd").$where." order by id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
    $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tijian_crowd").$where);
    $pager = pagination($total, $pageindex, $pagesize);
    include $this->template("physical/crowd");
}
// 添加适合人群
if($op == 'addcrowd')
{
	$id = $_GPC['id'];
	$item = pdo_get("hyb_yl_tijian_crowd",array("id"=>$id));
	if ($_W['ispost']) {
		$crowd = $_GPC['crowd'];
		
		$data = array(
			'title' => $crowd['title'],
			'status' => $crowd['status'],
			'uniacid' =>$uniacid,
			'icon'   => $_GPC['icon']
		);
		if($id)
		{
			$res = pdo_update("hyb_yl_tijian_crowd",$data,array("id"=>$id));
		}else{
			$data['created'] = time();
			$res = pdo_insert("hyb_yl_tijian_crowd",$data);
		}
		if($res)
		{
			message("编辑成功!",$this->createWebUrl("physical",array("op"=>"crowd")),"success");
		}else{
			message("编辑成功!",$this->createWebUrl("physical",array("op"=>"crowd")),"success");
		}
	}
	include $this->template("physical/addcrowd");
}
// 删除人群
if($op == 'delcrowd')
{
	$id = $_GPC['id'];
	$res = pdo_delete("hyb_yl_tijian_crowd",array("id"=>$id));
	if($res)
	{
		message("删除成功!",$this->createWebUrl("physical",array("op"=>"crowd")),"success");
	}else{
		message("删除成功!",$this->createWebUrl("physical",array("op"=>"crowd")),"success");
	}
	include $this->template("physical/crowd");
}
// 人群批量删除
if($op == 'delcrowds')
{
	$ids = $_GPC['ids'];
	foreach($ids as &$value)
	{
		$res = pdo_delete("hyb_yl_tijian_crowd",array("id"=>$value));
	}
	if($res)
	{
		message("删除成功!",$this->createWebUrl("physical",array("op"=>"crowd")),"success");
	}else{
		message("删除成功!",$this->createWebUrl("physical",array("op"=>"crowd")),"success");
	}
	include $this->template("physical/crowd");
}
// 选择套餐模板查看项目
if($op == 'ajax')
{
	$id = $_GPC['id'];

	$project = pdo_getall("hyb_yl_tijian_project",array("m_id"=>$id,"status"=>'1'));

	echo json_encode($project);
	exit();
}
// 套餐状态修改
if($op == 'changes')
{
	$id = $_GPC['id'];
	$type = $_GPC['type'];
	$status = $_GPC['status'];
	$item = pdo_get("hyb_yl_taocan",array("id"=>$id));
	if($item['is_tuijian'] == '0')
	{
		$is_tuijian = '1';
	}else if($item['is_tuijian'] == '1')
	{
		$is_tuijian = '0';
	}
	if($item['typs'] == '0')
	{
		$typs = '1';
	}else if($item['typs'] == '1')
	{
		$typs = '0';
	}

	if($type == 'shangji'){
		$typs = '0';
	}
	if($type == 'xiajia'){
		$typs = '1';
	}

	if($type == 'tuijian')
	{
		$res = pdo_update("hyb_yl_taocan",array("is_tuijian"=>$is_tuijian),array("id"=>$id));
	}else if($type == 'zhuangtai' || $type == 'shangji' || $type == 'xiajia')
	{
		$res = pdo_update("hyb_yl_taocan",array("typs"=>$typs),array("id"=>$id));
	}else if($type == 'shenhe')
	{
		$res = pdo_update("hyb_yl_taocan",array("status"=>$status),array("id"=>$id));
	}
	if($res)
	{
		message("设置成功!",$this->createWebUrl("physical",array("op"=>"tclist")),"success");
	}else{
		message("设置失败!",$this->createWebUrl("physical",array("op"=>"tclist")),"success");
	}
}
// 套餐软删除
if($op == 'tcdel')
{
	$id = $_GPC['id'];
	$res = pdo_update("hyb_yl_taocan",array("status"=>'3'),array("id"=>$id));
	if($res)
	{
		message("删除成功!",$this->createWebUrl("physical",array("op"=>"tclist")),"success");
	}else{
		message("删除失败!",$this->createWebUrl("physical",array("op"=>"tclist")),"success");
	}
}

// 套餐列表删除
if($op == 'tcdelete')
{
	$id = $_GPC['id'];
	$res = pdo_delete("hyb_yl_taocan",array("id"=>$id));
	if($res)
	{
		message("删除成功!",$this->createWebUrl("physical",array("op"=>"tclist")),"success");
	}else{
		message("删除失败!",$this->createWebUrl("physical",array("op"=>"tclist")),"success");
	}
}

//套餐规则
if($op == 'rule')
{
	$item = pdo_get("hyb_yl_taocan_rule",array("uniacid"=>$uniacid));
	if ($_W['ispost']) {
		$data = array(
			'num' => $_GPC['num'],
			"uniacid" => $_W['uniacid'],
			"is_send" => $_GPC['is_send'],
			"status" => $_GPC['status'],
		);
		if($item)
		{
			$res = pdo_update("hyb_yl_taocan_rule",$data,array("id"=>$item['id']));
		}else{
			$data['created'] = time();
			
			$res = pdo_insert("hyb_yl_taocan_rule",$data);
		}
		if($res)
		{
			message("编辑成功!",$this->createWebUrl("physical",array("op"=>"rule",'ac'=>'rule')),"success");
		}else{
			message("编辑成功!",$this->createWebUrl("physical",array("op"=>"rule",'ac'=>'rule')),"success");
		}
		
		

	}
	include $this->template("physical/rule");
}
//对比规则
if($op == 'dbrule')
{
	$item = pdo_get("hyb_yl_duibi_rule",array("uniacid"=>$uniacid));
	if ($_W['ispost']) {
		$data = array(
			'c_num' => $_GPC['c_num'],
			"uniacid" => $_W['uniacid'],
			"z_num" => $_GPC['z_num'],
			"r_num" => $_GPC['r_num'],
			"cp_num" => $_GPC['cp_num'],
			"is_cun" => $_GPC['is_cun'],
			"is_pipei" => $_GPC['is_pipei'],
		);
		if($item)
		{
			$res = pdo_update("hyb_yl_duibi_rule",$data,array("id"=>$item['id']));
		}else{
			$data['created'] = time();
			$res = pdo_insert("hyb_yl_duibi_rule",$data);
		}
		if($res)
		{
			message("编辑成功!",$this->createWebUrl("physical",array("op"=>"dbrule")),"success");
		}else{
			message("编辑成功!",$this->createWebUrl("physical",array("op"=>"dbrule")),"success");
		}
		
		

	}
	include $this->template("physical/dbrule");
}
//对比列表
if($op == 'dblist')
{

	$list = pdo_fetchall("SELECT * from".tablename('hyb_yl_duibi_data')."where uniacid='{$uniacid}' ");
	foreach ($list as $key => $value) {
		//用户
		$zidarr = explode(',', $value['zidarr']);
		$articleidarr = explode(',', $value['articleidarr']);
		$goodsidarr = explode(',', $value['goodsidarr']);
		$tijianid = explode(',', $value['duiidarr']);
		$zhengchang = explode(',', $value['zhengchang']);
		$yichang = explode(',', $value['yichang']);
		$openid = $value['openid'];
		$useropenid = $value['openid'];
		
		//查询每个人的处方单
		$value['cfcount'] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' .tablename("hyb_yl_goodsorders")."  where uniacid=:uniacid and openid=:openid",array(":uniacid"=>$uniacid,":openid"=>$useropenid));
		//查询每个人的问诊次数
        $value['twcount'] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' .tablename("hyb_yl_twenorder")."  where uniacid='{$uniacid}' and openid='{$useropenid}'  ");
        if($value['u_label'] == '')
        {
        	$value['u_label'] = pdo_fetchcolumn("select biaoqian from ".tablename("hyb_yl_twenorder")." where uniacid='{$uniacid}' and openid='{$useropenid}' order by id asc ");
        }
        

        $list[$key]['count'] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' .tablename("hyb_yl_wenzorder")."  where uniacid='{$uniacid}' and openid='{$useropenid}'  ");

        $list[$key]['numcount'] = ($value['twcount'] + $value['count'] );
        //查询用户购药订单
        $list[$key]['gycount'] = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_goodsorders")." WHERE uniacid=:uniacid and openid=:openid",array(":uniacid"=>$uniacid,":openid"=>$useropenid));
        //查询用户体检订单
        $list[$key]['tjcount'] = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_tijianorder")." WHERE uniacid=:uniacid and openid=:openid",array(":uniacid"=>$uniacid,":openid"=>$useropenid));
        //查询用户挂号订单
        $list[$key]['ghcount'] = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_guahaoorder")." WHERE uniacid=:uniacid and openid=:openid",array(":uniacid"=>$uniacid,":openid"=>$useropenid));
        //查询用户的检查报告
        $list[$key]['baogao'] = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_tijianorder")." WHERE uniacid=:uniacid and openid=:openid and ifover=1",array(":uniacid"=>$uniacid,":openid"=>$useropenid));
        //查询用户优惠券
        $list[$key]['yhqcount'] = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_user_coupon")." WHERE uniacid=:uniacid and openid=:openid",array(":uniacid"=>$uniacid,":openid"=>$useropenid));

        //查询用户真实姓名年龄等
        $userinfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_userjiaren")." WHERE uniacid=:uniacid and openid=:openid and sick_index=0",array(":uniacid"=>$uniacid,':openid'=>$useropenid));
        $list[$key]['zhenshixingming'] = $userinfo['names'];
        $list[$key]['telphone'] = $userinfo['tel'];
        $list[$key]['xingbie'] = $userinfo['sex'];
        $list[$key]['nianlin'] = $userinfo['age'];



		$list[$key]['userinfo'] = pdo_get('hyb_yl_userinfo',array('openid'=>$openid));
		//医生
		foreach ($zidarr as $key2 => $value2) {
			$list[$key]['doctor'] = pdo_get('hyb_yl_zhuanjia',array('zid'=>$value2));
		}
		
		//文章
		foreach ($articleidarr as $key3 => $value3) {
			$list[$key]['article'] = pdo_get('hyb_yl_zixun',array('id'=>$value3));
		}
		//药品
		foreach ($goodsidarr as $key4 => $value4) {
			$list[$key]['goods'] = pdo_get('hyb_yl_goodsarr',array('sid'=>$value4));
		}
		//对比订单号
		foreach ($tijianid as $key5 => $value5) {
			$tijian[] = pdo_get('hyb_yl_tijianorder',array('id'=>$value5),'ordernums');
		}
		//正常总数
		$list[$key]['zcount'] = count($zhengchang);
		$list[$key]['ycount'] = count($yichang);
	}

	include $this->template("physical/dblist");
}
//对比列表
if($op == 'patient')
{
	$list = pdo_fetchall("SELECT * from".tablename('hyb_yl_duibi_data')."where uniacid='{$uniacid}' and yichang!='' ");
	foreach ($list as $key => $value) {
		//用户
		$zidarr = explode(',', $value['zidarr']);
		$articleidarr = explode(',', $value['articleidarr']);
		$goodsidarr = explode(',', $value['goodsidarr']);
		$tijianid = explode(',', $value['duiidarr']);
		$zhengchang = explode(',', $value['zhengchang']);
		$yichang = explode(',', $value['yichang']);
		$openid = $value['openid'];
		$useropenid = $value['openid'];
		
		//查询每个人的处方单
		$value['cfcount'] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' .tablename("hyb_yl_goodsorders")."  where uniacid=:uniacid and openid=:openid",array(":uniacid"=>$uniacid,":openid"=>$useropenid));
		//查询每个人的问诊次数
        $value['twcount'] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' .tablename("hyb_yl_twenorder")."  where uniacid='{$uniacid}' and openid='{$useropenid}'  ");
        if($value['u_label'] == '')
        {
        	$value['u_label'] = pdo_fetchcolumn("select biaoqian from ".tablename("hyb_yl_twenorder")." where uniacid='{$uniacid}' and openid='{$useropenid}' order by id asc ");
        }
        

        $list[$key]['count'] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' .tablename("hyb_yl_wenzorder")."  where uniacid='{$uniacid}' and openid='{$useropenid}'  ");

        $list[$key]['numcount'] = ($value['twcount'] + $value['count'] );
        //查询用户购药订单
        $list[$key]['gycount'] = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_goodsorders")." WHERE uniacid=:uniacid and openid=:openid",array(":uniacid"=>$uniacid,":openid"=>$useropenid));
        //查询用户体检订单
        $list[$key]['tjcount'] = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_tijianorder")." WHERE uniacid=:uniacid and openid=:openid",array(":uniacid"=>$uniacid,":openid"=>$useropenid));
        //查询用户挂号订单
        $list[$key]['ghcount'] = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_guahaoorder")." WHERE uniacid=:uniacid and openid=:openid",array(":uniacid"=>$uniacid,":openid"=>$useropenid));
        //查询用户的检查报告
        $list[$key]['baogao'] = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_tijianorder")." WHERE uniacid=:uniacid and openid=:openid and ifover=1",array(":uniacid"=>$uniacid,":openid"=>$useropenid));
        //查询用户优惠券
        $list[$key]['yhqcount'] = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_user_coupon")." WHERE uniacid=:uniacid and openid=:openid",array(":uniacid"=>$uniacid,":openid"=>$useropenid));

        //查询用户真实姓名年龄等
        $userinfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_userjiaren")." WHERE uniacid=:uniacid and openid=:openid and sick_index=0",array(":uniacid"=>$uniacid,':openid'=>$useropenid));
        $list[$key]['zhenshixingming'] = $userinfo['names'];
        $list[$key]['telphone'] = $userinfo['tel'];
        $list[$key]['xingbie'] = $userinfo['sex'];
        $list[$key]['nianlin'] = $userinfo['age'];
        $list[$key]['mbnumber'] = $userinfo['randnum'];

		$list[$key]['userinfo'] = pdo_get('hyb_yl_userinfo',array('openid'=>$openid));
		//医生
		foreach ($zidarr as $key2 => $value2) {
			$list[$key]['doctor'] = pdo_get('hyb_yl_zhuanjia',array('zid'=>$value2));
		}
		
		//文章
		foreach ($articleidarr as $key3 => $value3) {
			$list[$key]['article'] = pdo_get('hyb_yl_zixun',array('id'=>$value3));
		}
		//药品
		foreach ($goodsidarr as $key4 => $value4) {
			$list[$key]['goods'] = pdo_get('hyb_yl_goodsarr',array('sid'=>$value4));
		}
		//对比订单号
		foreach ($tijianid as $key5 => $value5) {
			$tijian[] = pdo_get('hyb_yl_tijianorder',array('id'=>$value5),'ordernums');
		}
		//正常总数
		$list[$key]['zcount'] = count($zhengchang);
		$list[$key]['ycount'] = count($yichang);
	}
	include $this->template("physical/patient");
}
//对比列表
if($op == 'dbdetails')
{
	$id = $_GPC['id'];
	$list = pdo_fetch("select * from".tablename('hyb_yl_duibi_data')."where uniacid='{$uniacid}' and id='{$id}'");
	$openid = $list['openid'];
	$list['userinfo'] = pdo_get('hyb_yl_userinfo',array('openid'=>$openid));
	$duiidarr = explode(',',$list['duiidarr']);
    //查询用户真实姓名年龄等
    $userinfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_userjiaren")." WHERE uniacid=:uniacid and openid=:openid and sick_index=0",array(":uniacid"=>$uniacid,':openid'=>$openid));
    $list['zhenshixingming'] = $userinfo['names'];
    $list['telphone'] = $userinfo['tel'];
    $list['xingbie'] = $userinfo['sex'];
    $list['nianlin'] = $userinfo['age'];
    $list['region'] = $userinfo['region'];
    $tijianid = explode(',', $list['duiidarr']);
	foreach ($tijianid as $key5 => $value5) {
		$tijian[] = pdo_get('hyb_yl_tijianorder',array('id'=>$value5),'ordernums');
	}
	$goods = pdo_getall('hyb_yl_duibi_data_back',array('pid'=>$id));
	foreach ($goods as $key => $value) {
		$goodsidarr = explode(',',$value['goodsidarr']);
		$zidarr = explode(',',$value['zidarr']);
		$articleidarr = explode(',',$value['articleidarr']);
		foreach ($goodsidarr as $key2 => $value2) {
			$goodslist[] = pdo_get('hyb_yl_goodsarr',array('sid'=>$value2));
		}
		foreach ($zidarr as $key3 => $value3) {
			$doclist[] = pdo_get('hyb_yl_zhuanjia',array('zid'=>$value3));
		}
		foreach ($articleidarr as $key4 => $value4) {
			$articlelist[] = pdo_get('hyb_yl_zixun',array('id'=>$value4));
			//所属分类
			foreach ($articlelist as $key5 => $value5) {
				//
				$p_id = $value5['p_id'];
				$zid = $value5['zid'];
				$userid = $value5['userid'];
				$articlelist[$key5]['zx_name'] = pdo_getcolumn('hyb_yl_zixun_type',array('zx_id'=>$p_id),'zx_name');
				//医生
				$articlelist[$key5]['z_name'] = pdo_getcolumn('hyb_yl_zhuanjia',array('zid'=>$zid),'z_name');
			//编辑员
			    $articlelist[$key5]['u_name'] = pdo_getcolumn('hyb_yl_userinfo',array('u_id'=>$userid),'u_name');
			}
			
		}	
	}
      
    if($op=='delete'){
       $id = $_GPC['id'];
       pdo_delete('hyb_yl_duibi_data',array('id'=>$id));
       pdo_delete('hyb_yl_duibi_data_back',array('pid'=>$id));
       message("删除成功!",$this->createWebUrl("physical",array("op"=>"patient")),"success");
    }

	include $this->template("physical/dbdetails");
}
    if($op=='zhuanhua'){
		$id = $_GPC['id'];
		$list = pdo_fetch("select * from".tablename('hyb_yl_duibi_data')."where uniacid='{$uniacid}' and id='{$id}'");
		$openid = $list['openid'];
		$list['userinfo'] = pdo_get('hyb_yl_userinfo',array('openid'=>$openid));
		$duiidarr = explode(',',$list['duiidarr']);
	    //查询用户真实姓名年龄等
	    $userinfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_userjiaren")." WHERE uniacid=:uniacid and openid=:openid and sick_index=0",array(":uniacid"=>$uniacid,':openid'=>$openid));
	    $list['zhenshixingming'] = $userinfo['names'];
	    $list['telphone'] = $userinfo['tel'];
	    $list['xingbie'] = $userinfo['sex'];
	    $list['nianlin'] = $userinfo['age'];
	    $list['region'] = $userinfo['region'];

        include $this->template("physical/zhuanhua");
    }
     if($op=='successzhuanhua'){
     	$id = $_GPC['id'];
	    if($_W['ispost']){
        $data =array(
             'conetnt'=>$_GPC['conetnt'],
             'ifzhuanhua'=>$_GPC['ifzhuanhua'],
        	);
        pdo_update('hyb_yl_duibi_data',$data,array('id'=>$id));
        message("修改成功!",$this->createWebUrl("physical",array("op"=>"patient")),"success");
	    }
     }
     if($op=='suifanglist'){
     	load()->func('tpl');
     	$id = $_GPC['id'];
     	$u_id = $_GPC['u_id'];
     	$op = $_GPC['op'];
     	$openid = $_GPC['u_openid'];
     	$where ="where uniacid='{$uniacid}' and openid='{$openid}'";
     	if(!empty($_GPC['time']['start'])){
     		$star = strtotime($_GPC['time']['start']);
     		$end  = strtotime($_GPC['time']['end']);
     		$where .=" and next_time>'{$star}'";
     	}
     	if(!empty($_GPC['time']['start']) && $_GPC['time']['start'] !== $_GPC['time']['end']){
     		$star = strtotime($_GPC['time']['start']);
     		$end  = strtotime($_GPC['time']['end']);
     		$where .=" and next_time>'{$star}' and next_time<'{$end}'";
     	}
     	if($_GPC['time']['start'] == $_GPC['time']['end']){
            $where .=" and next_time>'{$star}'";
     	}

        $list =  pdo_fetchall("select * from".tablename('hyb_yl_suifang')."$where");

        $userduibi = pdo_fetch("select * from".tablename('hyb_yl_duibi_data')."where uniacid='{$uniacid}' and id='{$id}'");
        $useropenid = $userduibi['openid']?$userduibi['openid']:$openid;
        $userinfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_userjiaren")." WHERE uniacid=:uniacid and openid=:openid and sick_index=0",array(":uniacid"=>$uniacid,':openid'=>$useropenid));

        foreach ($list as $key => $value) {
        	$openid = $value['openid'];
        	$list[$key]['userinfo'] = pdo_get('hyb_yl_userinfo',array('openid'=>$openid));
        	$list[$key]['next_time'] = date("Y-m-d H:i:s",$list[$key]['next_time']);
        }
        
     	include $this->template("physical/suifang");
     }
     if($op=='suifang'){
     	load()->func('tpl');
     	$id = $_GPC['id'];
     	$u_id = $_GPC['u_id'];
     	$op = $_GPC['op'];
		$list = pdo_fetch("select * from".tablename('hyb_yl_duibi_data')."where uniacid='{$uniacid}' and id='{$id}'");
		$openid = $list['openid']?$list['openid']:$_GPC['u_openid'];
		$list['userinfo'] = pdo_get('hyb_yl_userinfo',array('openid'=>$openid));
		$duiidarr = explode(',',$list['duiidarr']);
	    //查询用户真实姓名年龄等
	    $userinfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_userjiaren")." WHERE uniacid=:uniacid and openid=:openid and sick_index=0",array(":uniacid"=>$uniacid,':openid'=>$openid));
	
        $ids =$_GPC['ids'];
        $get = pdo_get('hyb_yl_suifang',array('id'=>$ids));
        $get['next_time'] =date('Y-m-d H:i:s',$get['next_time']);
        $sfopenid = $get['openid'];
        $get['userinfo'] = pdo_get('hyb_yl_userinfo',array('openid'=>$sfopenid));
 
	    $list['zhenshixingming'] = $userinfo['names'];
	    $list['telphone'] = $userinfo['tel'];
	    $list['xingbie'] = $userinfo['sex'];
	    $list['nianlin'] = $userinfo['age'];
	    $list['region'] = $userinfo['region'];
     	if($_W['ispost']){
     		  $data=array(
		          'uniacid' =>$_W['uniacid'],
		          'jieduan' =>$_GPC['jieduan'],
		          'beizhu'  =>$_GPC['beizhu'],
		          'fangshi' =>$_GPC['fangshi'],
		          'thumb'   =>tomedia($_GPC['thumb']),
		          'pid'     =>$id,
		          'openid'  =>$openid,
		          'next_time'=>strtotime($_GPC['next_time']),
		          'addtime'=>date('Y-m-d H:i:s')
     			);
          if(empty($ids)){
                pdo_insert('hyb_yl_suifang',$data);
                message("添加成功!",$this->createWebUrl("physical",array("op"=>"suifanglist",'id'=>$id,'u_openid'=>$openid)),"success");
          }else{
                pdo_update('hyb_yl_suifang',$data,array('id'=>$ids));
                message("更新成功!",$this->createWebUrl("physical",array("op"=>"suifanglist",'id'=>$id,'u_openid'=>$openid)),"success");
          } 
     	}
     	include $this->template("physical/suifang");
     }
     if($op =='delsuifang'){
       $id = $_GPC['id'];
       $res =pdo_delete("hyb_yl_suifang",array('id'=>$id));
       message("删除成功!",$this->createWebUrl("physical",array("op"=>"suifanglist",'id'=>$id,'u_openid'=>$openid)),"success");
     }

     if($op == 'del_tclists')
     {
     	$ids = $_GPC['ids'];
     	for($i=0;$i<count($ids);$i++)
		  {
		    $res = pdo_delete("hyb_yl_taocan",array("id" => $ids[$i]));
		    
		  }
		  die(json_encode(array('errno'=>1,'message'=>1)));
     }