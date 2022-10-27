<?php

global $_W,$_GPC;
$op = $_GPC['op'];
$uniacid = $_W['uniacid'];
 $_W['plugin'] ='sign';
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
  $team = pdo_fetchall("select id from ".tablename("hyb_yl_team")." where uniacid=".$uniacid." and zid in (".$zjs.")");
  $teams = "";
  if(count($team) > 0)
  {
  	foreach($team as &$tea)
	  {
	  	$teams .= $tea['id'].",";
	  }
	  $teams = substr($teams,0,strlen($teams)-1);
  }
  
}

if($op == 'index')
{
	global $_W,$_GPC;
	$todayss = date("Y-m-d H:i:s",time());
	$today = strtotime(date("Y-m-d",time()));
	$yesterday = mktime(0,0,0,date('m'),date('d')-1,date('Y'));
	$seven = mktime(0,0,0,date('m'),date('d'),date('Y'))-1;
	$monthse = mktime(0,0,0,date('m'),date('d')-30,date('Y'));
	// 新增团队
	$wheres = "";
	$where2 = "";
	if(is_agent == '1')
	{
		if($zjs != '')
		{
			$wheres = " and zid in (".$zjs.")";
		}
		if($teams != '')
		{
			$where2 = " and tid in (".$teams.")";
		}else{
			$where2 = " and tid =0";
		}
		
	}
	$today_add_team = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_team")." where uniacid=".$uniacid." and created >=".$today.$wheres);
	$yes_add_team = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_team")." where uniacid=".$uniacid." and created >=".$yesterday." and created <=".$today.$wheres);
	// 新增社区团队
	$today_add_shequ = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_team")." where uniacid=".$uniacid." and cid != 0 and created >=".$today.$wheres);
	$yes_add_shequ = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_team")." where uniacid=".$uniacid." and cid != 0 and created >=".$yesterday." and created <=".$today.$wheres);

	// 新增社区
	$today_add_shequ = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_community")." where uniacid=".$uniacid." and created >=".$today);
	$yes_add_shequ = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_community")." where uniacid=".$uniacid." and created >=".$yesterday." and created <=".$today);
	// 今日收益
	$today_money = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_teamorder")." where uniacid=".$uniacid." and ifpay!=0 and ifpay != 6 and paytime>=".$today.$where2);
	$yes_money = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_teamorder")." where uniacid=".$uniacid." and ifpay!=0 and ifpay != 6 and paytime>=".$yesterday." and paytime <=".$today.$where2);

	if($today_money == NULL)
	{
		$today_money = '0.00';
	}
	if($yes_money == NULL)
	{
		$yes_money = '0.00';
	}
	
	// 新增签约数
	$today_qianyue = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_teamorder")." where uniacid=".$uniacid." and ifpay!=0 and ifpay != 6 and paytime>=".$today.$where2);
	   
	$yes_qianyue = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_teamorder")." where uniacid=".$uniacid." and ifpay!=0 and ifpay != 6 and paytime>=".$yesterday." and paytime <=".$today.$where2);

	// 新增团队服务包
	$today_fuwu = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_docser_speck")." where uniacid=".$uniacid." and time >='".date("Y-m-d H:i:s",$today)."'");
	
	$yes_fuwu = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_docser_speck")." where uniacid=".$uniacid." and time >='".date("Y-m-d H:i:s",$yesterday)."' and time <='".date("Y-m-d H:i:s",$today)."'");

	// 新增订单数
	$today_order = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_teamorder")." where uniacid=".$uniacid." and created >=".$today.$where2);

	$yes_order = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_teamorder")." where uniacid=".$uniacid." and created>=".$yesterday." and created <=".$today.$where2);

	// 待签约订单
	$daiqian = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_teamorder")." where uniacid=".$uniacid." and ifpay=0".$where2);
	// 退款订单
	$tuikuan = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_teamorder")." where uniacid=".$uniacid." and (ifpay=5 or ifpay=6)".$where2);
	// 带续费订单
	$xufei = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_teamorder")." where uniacid=".$uniacid." and end<=".date("Y-m-d",$today).$where2);

	$seven_money = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_teamorder")." where uniacid=".$uniacid." and ifpay!=0 and ifpay != 6 and paytime>=".$seven." and paytime <=".$today.$where2);
	$month_money = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_teamorder")." where uniacid=".$uniacid." and ifpay!=0 and ifpay != 6 and paytime>=".$monthse." and paytime <=".$today.$where2);
	if($seven_money == NULL)
	{
		$seven_money = '0.00';
	}
	if($month_money == NULL)
	{
		$month_money = '0.00';
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
				'team' => pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_team")." where uniacid=:uniacid and created >=:starttime and created<=:endtime".$wheres,$params),
				'order' => pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_teamorder")." where uniacid=:uniacid and created >=:starttime and created <=:endtime".$where2,$params),
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
					'team' => pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_team")." where uniacid=:uniacid and created >=:starttime and created<=:endtime".$wheres,$params),
					'order' => pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_teamorder")." where uniacid=:uniacid and created >=:starttime and created <=:endtime".$where2,$params),
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
						'team' => pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_team")." where uniacid=:uniacid and created >=:starttime and created<=:endtime".$wheres,$params),
						'order' => pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_teamorder")." where uniacid=:uniacid and created >=:starttime and created <=:endtime".$where2,$params),
					);
				}
			}
		}
	}
	include $this->template("sign/index");
}
if($op == 'add')
{
	$id = $_GPC['id'];
	$hid = $_GPC['hid'];
	$item = pdo_get("hyb_yl_team",array("id"=>$id));
	$shequ = pdo_getall("hyb_yl_community",array("uniacid"=>$uniacid,"status"=>'1'));
	if($item)
	{
		$item['zhuanjia'] = pdo_getcolumn("hyb_yl_zhuanjia",array("zid"=>$item['zid']),'z_name');
		$item['label'] = json_decode($item['label'],true);
	}
	$service = pdo_get("hyb_yl_team_service",array("tid"=>$id));
	$athuo_list = pdo_getall("hyb_yl_hospital_diction",array('uniacid'=>$uniacid));
	if (empty($item)) {
		$quanxian2 = pdo_getall("hyb_yl_hospital",array('pid'=>$item['jigou_two']));
	}else{
		//查询所属机构
		$quanxian2 = pdo_getall("hyb_yl_hospital",array('groupid'=>$item['jigou_one']));
	}
	$ks_list = pdo_getall("hyb_yl_classgory",array('uniacid'=>$uniacid));
	$ks_two = pdo_getall("hyb_yl_ceshi",array('giftstatus'=>$item['keshi_one']));

	$labels = pdo_getcolumn("hyb_yl_ceshi",array('id'=>$item['keshi_two']),array('description'));
	$res_sc = explode('、', $labels);
	$fw_list = pdo_fetchall("SELECT a.*,b.title,b.id as bid,b.time_leng FROM".tablename("hyb_yl_docser_speck")."as a left join".tablename('hyb_yl_docserver_type')."as b on b.typeid=a.id where a.uniacid ='{$uniacid}'");
		
	$rwo = pdo_fetch("select count(*) as count from".tablename("hyb_yl_team_serverlist")."where uniacid='{$uniacid}' and tid ='{$id}'");

	//查专家开通的服务包
	$list_fuwu = pdo_fetchall("SELECT * from".tablename('hyb_yl_team_serverlist')."where uniacid='{$uniacid}' and tid ='{$id}'");
	$val2 = array_merge($list_fuwu,$fw_list);
	$newArr2 = array();
	foreach($val2 as $v) {
	  if(! isset($newArr2[$v['key_words']])) $newArr2[$v['key_words']] = $v;
	  else $newArr2[$v['key_words']]["url"] .=  $v["url"];
	}
	$data_list2 = !$list_fuwu?$fw_list:$newArr2;
	
	
	if ($_W['ispost']) {
		$data = array(
			'openid' => $_GPC['openid'],
			"uniacid" => $_W['uniacid'],
			"title" => $_GPC['title'],
			"sort" => $_GPC['sort'],
			"type" => $_GPC['type'],
			"telphone" => $_GPC['telphone'],
			"province" => $_GPC['address']['province'],
			"city" => $_GPC['address']['city'],
			"district" => $_GPC['address']['district'],
			'lon' => $_GPC['register']['location']['lon'],
			"lat" => $_GPC['register']['location']['lat'],
			"keshi_one" => $_GPC['keshi_one'],
			"keshi_two" => $_GPC['keshi_two'],
			"label" => json_encode($_GPC['label'],true),
			"is_show" => $_GPC['is_show'],
			"created" => time(),
			"thumb" => $_GPC['thumb'],
			"imgpath" => $_GPC['imgpath'],
			"xn_answer" => $_GPC['xn_answer'],
			"xn_chufang" => $_GPC['xn_chufang'],
			"times" => $_GPC['times'],
			"content" => $_GPC['content'],
			"money" => $_GPC['money'],
			"zid" => $_GPC['zid'],
			"status" => $_GPC['status'],
			"address" => $_GPC['address']['province'].$_GPC['address']['city'].$_GPC['address']['district'],
			"cid" => $_GPC['cid'],
			'plugin'    =>serialize($_GPC['plugin']),
			"jigou_one" => $_GPC['jigou_one'],
			"jigou_two" => $_GPC['jigou_two'],
		);
		$services = $_GPC['service'];
		$services['uniacid'] = $_W['uniacid'];

		if($id)
		{
			$pluginarr = $_GPC['plugin'];
		     $result3 = [];
		     array_map(function ($value) use (&$result3) {
		        $result3 = array_merge($result3, array_values($value));
		     }, $pluginarr);  

             for($i=0;$i<count($result3);$i++){
                $key_words_b = $result3[$i]['key_words'];
                $bid_b    = $result3[$i]['bid'];
                $titlme_b = $result3[$i]['titlme'];
                $time_b   = $result3[$i]['time'];
                $time_leng_b = $result3[$i]['time_leng'];
                $ptmoney_b = $result3[$i]['ptmoney'];
                $ptzhuiw_b = $result3[$i]['ptzhuiw'];
                $hymoney_b = $result3[$i]['hymoney'];
                $hyzhuiw_b = $result3[$i]['hyzhuiw'];
                $stateback_b = $result3[$i]['stateback'];
                $ids_b    = $result3[$i]['id'];

                $data2 =array(
                	 'id'       => $ids_b,
                     'uniacid'   => $_W['uniacid'],
                     'key_words' => $key_words_b,
                     'bid'       => $bid_b,
                     'titlme'    => $titlme_b,
                     'time'      => $time_b,
                     'time_leng' => $time_leng_b,
                     'ptmoney'   => $ptmoney_b,
                     'ptzhuiw'   => $ptzhuiw_b,
                     'hymoney'   => $hymoney_b,
                     'hyzhuiw'   => $hyzhuiw_b,
                     'tid'       => $tid,
                     'stateback' => $stateback_b,
                    );
                $data3 =array(
                     'uniacid'   => $_W['uniacid'],
                     'key_words' => $key_words_b,
                     'bid'       => $bid_b,
                     'titlme'    => $titlme_b,
                     'time'      => $time_b,
                     'time_leng' => $time_leng_b,
                     'ptmoney'   => $ptmoney_b,
                     'ptzhuiw'   => $ptzhuiw_b,
                     'hymoney'   => $hymoney_b,
                     'hyzhuiw'   => $hyzhuiw_b,
                     'tid'       => $id,
                     'stateback' => $stateback_b,
                    );

                if($ids_b ==''){
                  pdo_insert("hyb_yl_team_serverlist",$data3);

                }
                  pdo_update('hyb_yl_team_serverlist',$data2,array('id'=>$ids_b));
              }
			$res = pdo_update("hyb_yl_team",$data,array("id"=>$id));
			if($service)
			{
				pdo_update("hyb_yl_team_service",$services,array("tid"=>$id));
			}else{
				$services['tid'] = $id;
				$services['created'] = time();
				pdo_insert("hyb_yl_team_service",$services);
			}
			
		}else{
			$data['created'] = time();
			$res = pdo_insert("hyb_yl_team",$data);
			$tid = pdo_insertid();
	    	  $pluginarr = $_GPC['plugin'];
		      $result3 = [];
		      array_map(function ($value) use (&$result3) {
		        $result3 = array_merge($result3, array_values($value));
		     }, $pluginarr);  
             for($i=0;$i<count($result3);$i++){
                $key_words_b = $result3[$i]['key_words'];
                $bid_b    = $result3[$i]['bid'];
                $titlme_b = $result3[$i]['titlme'];
                $time_b   = $result3[$i]['time'];
                $time_leng_b = $result3[$i]['time_leng'];
                $ptmoney_b = $result3[$i]['ptmoney'];
                $ptzhuiw_b = $result3[$i]['ptzhuiw'];
                $hymoney_b = $result3[$i]['hymoney'];
                $hyzhuiw_b = $result3[$i]['hyzhuiw'];
                $stateback_b = $result3[$i]['stateback'];
                $data2 =array(
                     'uniacid'   => $_W['uniacid'],
                     'key_words' => $key_words_b,
                     'bid'       => $bid_b,
                     'titlme'    => $titlme_b,
                     'time'      => $time_b,
                     'time_leng' => $time_leng_b,
                     'ptmoney'   => $ptmoney_b,
                     'ptzhuiw'   => $ptzhuiw_b,
                     'hymoney'   => $hymoney_b,
                     'hyzhuiw'   => $hyzhuiw_b,
                     'tid'       => $tid,
                     'stateback' => $stateback_b,
                    );
               pdo_insert('hyb_yl_team_serverlist',$data2);
            }
			// $services['created'] = time();
			// $services['tid'] = $tid;
			// if($tid)
			// {
			// 	pdo_insert("hyb_yl_team_service",$services);
			// }
			
		}
		if($res)
		{
			message("编辑成功!",$this->createWebUrl("sign",array("op"=>"tdlist",'hid'=>$hid)),"success");
		}else{
			message("编辑失败!",$this->createWebUrl("sign",array("op"=>"tdlist",'hid'=>$hid)),"error");
		}
	}
	include $this->template("sign/add");
}

//团队列表
if($op == 'tdlist')
{
	$page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
    $keyword = $_GPC['keyword'];
    $keywordtype = $_GPC['keywordtype'];
    $where = " where t.uniacid=".$uniacid;
    $addressed = pdo_getall("hyb_yl_address");
    if($keywordtype == '1')
    {
    	$where .= " and t.id=".$keyword;
    }else if($keywordtype == '2')
    {
    	$where .= " and t.title like '%$keyword%'";
    }else if($keywordtype == '3')
    {
    	$where .= " and z.z_name like '%$keyword%'";
    }
    $status = empty($_GPC['status']) ? "1" : $_GPC['status'];
    if($status == '1')
    {
    	$where .= " and t.status=1";
    }else if($status == '2')
    {
    	$where .= " and t.status=0";
    }
    $address = $_GPC['address'];
    if($address != '')
    {
    	$where .= " and t.address like '%$address%'";
    }
    if(is_agent == '1')
    {
    	$where .= " and t.zid in (".$zjs.")";
    }
    
    $list = pdo_fetchall("select t.*,z.z_name from ".tablename("hyb_yl_team")." as t left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=t.zid ".$where." order by t.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);

    $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_team")." as t left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=t.zid ".$where);
    foreach($list as &$value)
    {
    	$value['created'] = date("Y-m-d H:i:s",$value['created']);
    	$value['erweima'] = $_W['siteroot'].$value['erweima'];

    }
    $where1 = " where uniacid=".$uniacid." and status=1";
    $where2 = " where uniacid=".$uniacid." and status=0";
    if(is_agent == '1')
    {
    	$where1 .= " and zid in (".$zjs.")";
    	$where2 .= " and zid in (".$zjs.")";
    }
    $ruzhu = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_team").$where1);
    $shenhe = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_team").$where2);
    $pager = pagination($total, $pageindex, $pagesize);
	include $this->template("sign/tdlist");
}
//团队设置
if($op == 'telask')
{
	
	$item = pdo_get("hyb_yl_team_rule",array("uniacid"=>$_W['uniacid']));
	
	if ($_W['ispost']) {
		$data = array(
			'is_shenhe' => $_GPC['is_shenhe'],
			"is_service" => $_W['is_service'],
			"content" => $_GPC['content'],
			"uniacid" => $_W['uniacid'],
			"background" => $_GPC['background'],
			"thumb" => $_GPC["thumb"],
		);
		if($item)
		{
			$res = pdo_update("hyb_yl_team_rule",$data,array("uniacid"=>$uniacid));
		}else{
			$data['created'] = time();
			$res = pdo_insert("hyb_yl_team_rule",$data);
		}
		if($res)
		{
			message("编辑成功!",$this->createWebUrl("sign",array("op"=>"telask")),"success");
		}else{
			message("编辑失败!",$this->createWebUrl("sign",array("op"=>"telask")),"error");
		}
		
		

	}
	include $this->template("sign/telask");
}
//团队公告
if($op == 'tdmsg')
{
	$tid = $_GPC['tid'];
	$page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
    $where = " where uniacid=".$uniacid." and t_id=".$tid;
    $list = pdo_fetchall("select * from ".tablename("hyb_yl_teamment").$where." order by g_id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
    
    foreach ($list as &$value)
    {
    	$value['t_name'] = pdo_getcolumn("hyb_yl_team",array("id"=>$value['t_id']),'title');
    	$value['updateTime'] = date("Y-m-d H:i:s",$value['updateTime']);
    }
    $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_teamment").$where);
    $pager = pagination($total, $pageindex, $pagesize);
	include $this->template("sign/tdmsg");
}
//添加团队公告
if($op == 'tdmsgadd')
{
	$tid = $_GPC['t_id'];
	$g_id = $_GPC['g_id'];

	$team = pdo_get("hyb_yl_team",array("id"=>$tid));
	$item = pdo_get("hyb_yl_teamment",array("g_id"=>$g_id));
	if($item)
	{
		$item['thumbarr'] = unserialize($item['thumbarr']);
	}
	
	if ($_W['ispost']) {
		$data = array(
			'title' => $_GPC['title'],
			"teamtext" => $_GPC['teamtext'],
			"thumbarr" => serialize($_GPC['thumbarr']),
			't_id' => $tid,
			"uniacid" => $_W['uniacid'],
			"menttypes" => $_GPC['menttypes'],
		);

		if($item)
		{
			$res = pdo_update("hyb_yl_teamment",$data,array("g_id"=>$g_id));
		}else{
			$data['updateTime'] = time();

			$res = pdo_insert("hyb_yl_teamment",$data);
		}
		if($res)
		{
			message("编辑成功!",$this->createWebUrl("sign",array("op"=>"tdmsg","tid"=>$tid)),"success");
		}else{
			message("编辑失败!",$this->createWebUrl("sign",array("op"=>"tdmsg","tid"=>$tid)),"error");
		}

	}
	include $this->template("sign/tdmsgadd");
}
// 团队公告删除
if($op == 'tdmsgdel')
{
	$tid = $_GPC['t_id'];
	$g_id = $_GPC['g_id'];
	$res = pdo_delete("hyb_yl_teamment",array("g_id"=>$g_id));
	if($res)
	{
		message("删除成功!",$this->createWebUrl("sign",array("op"=>"tdmsg","tid"=>$tid)),"success");
	}else{
		message("删除失败!",$this->createWebUrl("sign",array("op"=>"tdmsg","tid"=>$tid)),"error");
	}
	include $this->template("sign/tdmsg");

}
//团队开通记录
if($op == 'fwblist')
{
	$page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $keywordtype = $_GPC['keywordtype'];
    $keyword = $_GPC['keyword'];
    $pagesize = 10;
    $where = " o.uniacid=".$uniacid;
    $fw_list = pdo_getall("hyb_yl_docser_speck",array("uniacid"=>$uniacid,"state"=>"1"));
    $bid = $_GPC['bid'];
    $start = empty($_GPC['start']) ? date("Y-m-d",strtotime("-1Months",time())) : $_GPC['start']; 
	$end = empty($_GPC['end']) ? date("Y-m-d",strtotime("+1days",time())) : $_GPC['end'];
	if($bid != '')
	{
		$where .= " and o.bid=".$bid;
	}
	if($keywordtype == '1')
	{
		$where .= " and o.back_order like '%$keyword%'";
	}else if($keywordtype == '2')
	{
		$where .= " and t.title like '%$keyword%'";
	}
	$where1 = '';
	$where2 = '';
	if(is_agent == '1')
	{
		if($teams != '')
		{
			$where .= " and tid in (".$teams.")";
			$where2 = " and tid in (".$teams.")";
		}else{
			$where .= " and tid =0";
			$where2 = " and tid =0";
		}
		$where1 = " and zid in (".$zjs.")";
		
	}
	$where .= " and o.created >=".strtotime($start)." and o.created <=".strtotime($end);
	$list = pdo_fetchall("select o.*,t.title from ".tablename("hyb_yl_team_serverlog")." as o left join ".tablename("hyb_yl_team")." as  t on t.id=o.tid ".$where ." order by o.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
	$total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_team_serverlog")." as o left join ".tablename("hyb_yl_team")." as t on t.id=o.tid".$where);
	foreach($list as &$value)
	{
		$server = pdo_get("hyb_yl_docser_speck",array("id"=>$value['bid']));
		$server['icon'] = tomedia($server['icon']);
		$value['server'] = $server;
	}
	$team = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_team")." where uniacid=".$uniacid.$where1);
	$count = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_team_serverlog")." where status=1 and uniacid=".$uniacid.$where2);
	$money = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_team_serverlog")." where status=1 and uniacid=".$uniacid.$where2);
	if($money == NULL)
	{
		$money = '0.00';
	}
	$pager = pagination($total, $pageindex, $pagesize);
	
	include $this->template("sign/fwblist");
}

// 服务订单状态修改
if($op == 'chengesfworder')
{
	$id = $_GPC['id'];
	$hid = $_GPC['hid'];
	$res = pdo_update("hyb_yl_team_serverlog",array("status"=>'1','pay_time'=>time()),array("id"=>$id));
	if($res)
	{
		message("修改成功!",$this->createWebUrl("sign",array("op"=>"fwblist",'hid'=>$hid)),"success");
	}else{
		message("修改失败!",$this->createWebUrl("sign",array("op"=>"fwblist",'hid'=>$hid)),"error");
	}
	include $this->template("sign/fwblist");
}
if($op == 'delfworder')
{
	$id = $_GPC['id'];
	$hid = $_GPC['hid'];
	$res = pdo_delete("hyb_yl_team_serverlog",array("id"=>$id));
	if($res)
	{
		message("删除成功!",$this->createWebUrl("sign",array("op"=>"fwblist",'hid'=>$hid)),"success");
	}else{
		message("删除失败!",$this->createWebUrl("sign",array("op"=>"fwblist",'hid'=>$hid)),"error");
	}
	include $this->template("sign/fwblist");
}
//收费设置
if($op == 'typelist')
{
	$page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
   
    $where = " where uniacid=".$uniacid;
    
    $list = pdo_fetchall("select * from ".tablename("hyb_yl_shoufei_set").$where." order by id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
    foreach ($list as &$value) {
    	$value['type_name'] = pdo_getcolumn("hyb_yl_docser_speck",array("id"=>$value['type']),'titlme');
    }
    $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_shoufei_set").$where);

    $pager = pagination($total, $pageindex, $pagesize);
	include $this->template("sign/typelist");
}
// 添加收费设置
if($op == 'typelistadd')
{
	$id = $_GPC['id'];
	$item = pdo_get("hyb_yl_shoufei_set",array("id"=>$id));
	
	$service = pdo_getall("hyb_yl_docser_speck",array("uniacid"=>$uniacid));
	if ($_W['ispost']) {
		$data = array(
			'title' => $_GPC['title'],
			"uniacid" => $_W['uniacid'],
			"time" => $_GPC['time'],
			"price" => $_GPC['price'],
			"type" => $_GPC['type'],
			"is_fenxiao" => $_GPC['is_fenxiao'],
			"fx_one" => $_GPC['fx_one'],
			"fx_two" => $_GPC['fx_two'],
			'is_shenhe' => $_GPC['is_shenhe'],
			"is_xufei" => $_GPC['is_xufei'],
			"status" => $_GPC['status'],
			"sort" => $_GPC['sort'],
		);
		if($item)
		{
			$res = pdo_update("hyb_yl_shoufei_set",$data,array("id"=>$item['id']));
		}else{
			$data['created'] = time();
			$res = pdo_insert("hyb_yl_shoufei_set",$data);
		}
		if($res)
		{
			message("编辑成功!",$this->createWebUrl("sign",array("op"=>"typelist")),"success");
		}else{
			message("编辑失败!",$this->createWebUrl("sign",array("op"=>"typelist")),"error");
		}
	}
	include $this->template("sign/typelistadd");
}
// 删除收费设置
if($op == 'typelistdel')
{
	$id = $_GPC['id'];
	$res = pdo_delete("hyb_yl_shoufei_set",array("id"=>$id));
	if($res)
	{
		message("删除成功!",$this->createWebUrl("sign",array("op"=>"typelist")),"success");
	}else{
		message("删除失败!",$this->createWebUrl("sign",array("op"=>"typelist")),"error");
	}
	include $this->template("sign/typelist");
}

//订单列表
if($op == 'orderlist')
{
	$page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
   
    $where = " where o.uniacid=".$uniacid;
    $start = empty($_GPC['start']) ? date("Y-m-d",strtotime("-1Months",time())) : $_GPC['start']; 
	$end = empty($_GPC['end']) ? date("Y-m-d",strtotime("+1days",time())) : $_GPC['end'];
    $starts = strtotime($start);
    $ends = strtotime($end);
    $leixings = pdo_getall("hyb_yl_docser_speck",array("uniacid"=>$uniacid));
    $key_words = $_GPC['key_words'];

    if($key_words != '')
    {
    	$where .= " and o.key_words='".$key_words."'";
    }
    $status = $_GPC['status'];
    $ifpay = $_GPC['ifpay'];
    if($ifpay != '')
    {
    	$where .= " and o.ifpay={$ifpay}";
    }
    
    $keyword = $_GPC['keyword'];
    $keywordtype = $_GPC['keywordtype'];
    if($keywordtype == '1')
    {
    	$where .= " and o.orders like '%$keyword%'";
    }else if($keywordtype == '2')
    {
    	$where .= " and u.u_name like '%$keyword%'";
    }else if($keywordtype == '3')
    {
    	$where .= " and t.title like '%$keyword%'";
    }
    if($start && $end)
    {
    	$where .= " and o.created >=".$starts." and o.created <=".$ends;
    }
    $where1 = "";
    if(is_agent == '1')
    {
    	if($teams != '')
    	{
    		$where .= " and o.tid in (".$teams.")";
    		$where1 = " and tid in (".$teams.")";
    	}else{
    		$where .= " and o.tid = 0";
    		$where1 = " and tid = 0";
    	}
    	
    }
    $list = pdo_fetchall("select o.*,u.u_name,u.u_phone,u.u_id,t.title,t.zid from ".tablename("hyb_yl_teamorder")." as o left join ".tablename("hyb_yl_userinfo")." as u on u.openid=o.openid left join ".tablename("hyb_yl_team")." as t on t.id=o.tid ".$where." order by o.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
    foreach ($list as &$value) {
    	$value['z_name'] = pdo_getcolumn("hyb_yl_zhuanjia",array("uniacid"=>$uniacid,"zid"=>$value['zid']),'z_name');
    	$value['created'] = date("Y-m-d H:i:s",$value['created']);
    	$value['paytime'] = date("Y-m-d H:i:s",$value['paytime']);
    	$value['t_time'] = date("Y-m-d H:i:s",$value['t_time']);
    	$type = pdo_get("hyb_yl_docser_speck",array("key_words"=>$value['key_words']));
    	$value['time_leng'] = pdo_getcolumn("hyb_yl_docserver_type",array("typeid"=>$type['id']),'time_leng');
    	$value['type_name'] = $type['titlme'];
    	$value['fw_thumb'] = tomedia($type['thumb']);
    	
    }
    $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_teamorder")." as o left join ".tablename("hyb_yl_userinfo")." as u on u.openid=o.openid left join ".tablename("hyb_yl_team")." as t on t.id=o.tid ".$where);
    $qianyue = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_teamorder")." where uniacid={$uniacid} and ifpay=1".$where1);

    $money = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_teamorder")." where uniacid={$uniacid}".$where1);
    $count = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_teamorder")." where uniacid={$uniacid}".$where1); 
    if($money == null)
    {
    	$money = '0';
    }
    $pager = pagination($total, $pageindex, $pagesize);
	include $this->template("sign/orderlist");
}
// 签约订单状态修改
if($op == 'changeorder')
{
	$id = $_GPC['id'];
	$ifpay = $_GPC['ifpay'];
	$data['ifpay'] = $ifpay;
	if($ifpay == '1')
	{
		$data['pay_time'] = time();
	}else{
		$data['t_time'] = time();
	}
	$res = pdo_update("hyb_yl_teamorder",$data,array("id"=>$id));
	if($res)
	{
		message("修改成功!",$this->createWebUrl("sign",array("op"=>"orderlist")),"success");
	}else{
		message("修改失败!",$this->createWebUrl("sign",array("op"=>"orderlist")),"error");
	}
	include $this->template("sign/orderlist");
}
// 签约订单删除
if($op == 'orderdel')
{
	$id = $_GPC['id'];
	$res = pdo_delete("hyb_yl_teamorder",array("id"=>$id));
	if($res)
	{
		message("删除成功!",$this->createWebUrl("sign",array("op"=>"orderlist")),"success");
	}else{
		message("删除失败!",$this->createWebUrl("sign",array("op"=>"orderlist")),"error");
	}
	include $this->template("sign/orderlist");
}
//人群设置
if($op == 'crowd')
{
	include $this->template("sign/crowd");
}
//续费记录
if($op == 'record')
{
	include $this->template("sign/record");
}
//社区列表
if($op == 'sqlist')
{
	$page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
   	$status = $_GPC['status'];

    $where = " where uniacid=".$uniacid;
    if($status == '1')
   	{
   		$where .= " and status=1";
   	}else if($status == '2')
   	{
   		$where .= "and status=0";
   	}
   	$keyword = $_GPC['keyword'];
   	if($keyword)
   	{
   		$where .= " and title like '%$keyword%'";
   	}
    $list = pdo_fetchall("select * from ".tablename("hyb_yl_community").$where." order by id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
    $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_community").$where);
    $pager = pagination($total, $pageindex, $pagesize);
	include $this->template("sign/sqlist");
}
// 导入社区
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
          $arr['title'] = $objWorksheet->getCellByColumnAndRow('0', $row)->getValue();
          $arr['address'] = $objWorksheet->getCellByColumnAndRow('1', $row)->getValue();
          $arr['lon'] = trim($objWorksheet->getCellByColumnAndRow('2', $row)->getValue());
          $arr['lat'] = $objWorksheet->getCellByColumnAndRow('3', $row)->getValue();
          $arr['province'] = trim($objWorksheet->getCellByColumnAndRow('4', $row)->getValue());
          $arr['city'] = $objWorksheet->getCellByColumnAndRow('5', $row)->getValue();
          $arr['district'] = $objWorksheet->getCellByColumnAndRow('6', $row)->getValue();
          $arr['created'] = time();
          $arr['status'] = "1";
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
          $res = pdo_insert('hyb_yl_community',$value);
        }
      }
      message("导入成功!",$this->createWebUrl("sign",array("op"=>"sqlist")),"success");
    }
    include $this->template("sign/import");
}
//添加社区列表
if($op == 'sqlistadd')
{
	$id = $_GPC['id'];
	$item = pdo_get("hyb_yl_community",array("id"=>$id));
	if ($_W['ispost']) {
		$data = array(
			'title' => $_GPC['title'],
			"uniacid" => $_W['uniacid'],
			"status" => $_GPC['status'],
			"province" => $_GPC['address']['province'],
			"city" => $_GPC['address']['city'],
			"district" => $_GPC['address']['district'],
			'lon' => $_GPC['register']['location']['lon'],
			"lat" => $_GPC['register']['location']['lat'],
			"address" => $_GPC['address']['province'].$_GPC['address']['city'].$_GPC['address']['district']
		);
		if($item)
		{
			$res = pdo_update("hyb_yl_community",$data,array("id"=>$item['id']));
		}else{
			$data['created'] = time();
			$res = pdo_insert("hyb_yl_community",$data);
		}
		if($res)
		{
			message("编辑成功!",$this->createWebUrl("sign",array("op"=>"sqlist")),"success");
		}else{
			message("编辑失败!",$this->createWebUrl("sign",array("op"=>"sqlist")),"error");
		}
	}
	include $this->template("sign/sqlistadd");
}
// 删除社区列表
if($op == 'sqlistdel')
{
	$id = $_GPC['id'];
	$res = pdo_delete("hyb_yl_community",array("id"=>$id));
	if($res)
	{
		message("删除成功!",$this->createWebUrl("sign",array("op"=>"sqlist")),"success");
	}else{
		message("删除失败!",$this->createWebUrl("sign",array("op"=>"sqlist")),"error");
	}
	
	include $this->template("sign/sqlistadd");
}
//成员列表
if($op == 'cylist')
{
	$tid = $_GPC['tid'];
	$page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
   	$ks_list = pdo_getall("hyb_yl_classgory",array("uniacid"=>$uniacid,"typeint"=>'0'));
   	$service = pdo_getall("hyb_yl_docser_speck",array("uniacid"=>$uniacid));
   	$job_list = pdo_getall("hyb_yl_zhuanjia_job",array('uniacid'=>$uniacid,'type'=>'1'));
    $where = " where p.uniacid=".$uniacid." and p.tid=".$tid;
    $keywordtype = $_GPC['keywordtype'];
    $keyword = $_GPC['keyword'];
    if($keywordtype == '1')
    {
    	$where .= " and z.z_name like '%$keyword%'";
    }else if($keywordtype == '2')
    {
    	$where .= " and z.zid =".$keyword;
    }
   	$keshi = $_GPC['keshi'];
   	if($keshi != '')
   	{
   		$where .= " and z.z_room = ".$keshi;
   	}
   	$gzstype = $_GPC['gzstype'];
   	if($gzstype != '')
   	{
   		$where .= " and z.gzstype=".$gzstype;
   	}
   	$zhicheng = $_GPC['zhicheng'];
   	if($zhicheng != '')
   	{
   		$where .= " and z.z_zhicheng=".$zhicheng;
   	}
    $list = pdo_fetchall("select p.*,z.* from ".tablename("hyb_yl_team_people")." as p left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=p.y_zid ".$where." order by p.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);

    foreach($list as &$value)
    {
    	$value['advertisement'] = tomedia($value['advertisement']);
    	$value['jigou'] = pdo_getcolumn("hyb_yl_hospital_diction",array('uniacid'=>$uniacid,'id'=>$value['qx_id']),'name');
    	
    	$value['keshi_one'] = pdo_getcolumn("hyb_yl_classgory",array("id"=>$value['z_room']),'ctname');
    	$value['keshi_two'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$value['parentid']),'name');
    	$value['created'] =date("Y-m-d",$value['created']);
    	$value['add_time'] = date("Y-m-d",$value['add_time']);
    }

    $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_team_people")." as p left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=p.zid ".$where);
    $pager = pagination($total, $pageindex, $pagesize);
	include $this->template("sign/cylist");
}

// 提出团队成员
if($op == 'delpeople')
{
	$tid = $_GPC['tid'];
	$id = $_GPC['id'];
	$res = pdo_delete("hyb_yl_team_people",array("id"=>$id));
	if($res)
	{
		message("删除成功!",$this->createWebUrl("sign",array("op"=>"cylist","tid"=>$tid)),"success");
	}else{
		message("删除失败!",$this->createWebUrl("sign",array("op"=>"cylist","tid"=>$tid)),"error");

	}
	include $this->template("sign/cylist");
}
// 专家订单
// if($op == 'people_order')
// {
// 	$id = $_GPC['id'];
// 	$tid = $_GPC['tid'];
// 	$where = " where uniacid=".$uniacid." and zid=".$id;
// 	$qianyue = pdo_fetchall("select * from ".tablename("hyb_yl_quanyueorder").$where);
// 	$tijian = pdo_fetchall("select * from ".tablename("hyb_yl_tijianorder").$where);
// 	$twen = pdo_fetchall("select * from ".tablename("hyb_yl_twenorder").$where);
// 	$wenzhen = pdo_fetchall("select * from ".tablename("hyb_yl_wenzorder").$where);
// 	foreach($qianyue as &$value)
// 	{
// 		$value['typs'] = 'qianyue';
// 		if(strpos($value['qyimg'], 'http') === false)
// 		{
// 			$value['qyimg'] = $_W['attachurl'].$value['qyimg'];
// 			$value['fuwu'] = pdo_getcolumn("hyb_yl_fwlist",array("id"=>$value['pid']),'fw_name');
// 			$value['zhuanjia'] = pdo_fetch("select * from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and zid=".$value['zid']);
// 			$value['zhuanjia']['t_name'] = pdo_fetchcolumn("select t.title from ".tablename("hyb_yl_team_people")." as p left join ".tablename("hyb_yl_team")." as t on t.id=p.tid where uniacid=".$uniacid." and p.zid=".$value['zid']);
// 			$value['time'] = date("Y-m-d H:i:s",$value['time']);
// 			$value['overtime'] = date("Y-m-d H:i:s",$value['overtime']);
// 		}
// 	}
// 	foreach($tijian as &$tj)
// 	{
// 		$tj['typs'] = 'tijian';
// 	}
// 	foreach($twen as &$tw)
// 	{
// 		$tw['typs'] = 'tuwen';
// 	}
// 	foreach($wenzheng as &$wz)
// 	{
// 		$wz['typs'] = 'wz';
// 	}
// 	$lists = array_merge($qianyue,$tijian,$twen,$wenzhen);
// 	$page = empty($_GPC['page']) ? "" : $_GPC['page'];
//     $pageindex = max(1, intval($page));
//     $pagesize = 10;
//     $list = array_slice($lists,$page * $pagesize,$pagesize);
//     $total = count($lists);
//     $pager = pagination($total, $pageindex, $pagesize);
// 	include $this->template("sign/people_order");
// }

//邀请记录
if($op == 'share')
{
	$tid = $_GPC['tid'];
	$page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
   	$status = $_GPC['status'];

    $where = " where p.uniacid=".$uniacid." and p.tid=".$tid;
    if($status == '1')
   	{
   		$where .= " and p.status=0";
   	}else if($status == '2')
   	{
   		$where .= " and p.status=1";
   	}else if($status == '3')
   	{
   		$where .= " and p.status=2";
   	}
   	$keyword = $_GPC['keyword'];
   	$start = empty($_GPC['start']) ? date("Y-m-d",strtotime("-1Months",time())) : $_GPC['start']; 
	$end = empty($_GPC['end']) ? date("Y-m-d",strtotime("+1days",time())) : $_GPC['end'];
   	$ks_list = pdo_getall("hyb_yl_classgory",array("uniacid"=>$uniacid,"typeint"=>'0'));
   	if($start && $end)
   	{
   		$where .= " and p.created >=".strtotime($start)." and p.created <=".strtotime($end);
   	}
   	$keywordtype = $_GPC['keywordtype'];
   	if($keywordtype == '1')
   	{
   		$where .= " and p.y_zid =".$keyword;
   	}else if($keywordtype == '2')
   	{
   		$where .= " and z.z_name like '%$keyword%'";
   	}else if($keywordtype == '3')
   	{
   		$where .= " and z.z_telephone like '%$keyword%'";
   	}
   	$keshi = $_GPC['keshi'];
   	if($keshi)
   	{
   		$where .= " and z.z_room =".$keshi;
   	}
    $list = pdo_fetchall("select p.*,z.z_name,z.z_telephone,z.advertisement,z.qx_id,z.z_room,z.parentid from ".tablename("hyb_yl_team_people")." as p left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=p.y_zid right join ".tablename("hyb_yl_classgory")." as c on c.id=z.z_room ".$where." order by p.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
    
    foreach($list as &$value)
    {
    	if(strpos($value['advertisement'],'http') === false)
    	{
    		$value['advertisement'] = $_W['attachurl'].$value['advertisement'];
    	}
    	$value['jigou'] = pdo_getcolumn("hyb_yl_hospital_diction",array('uniacid'=>$uniacid,'id'=>$value['qx_id']),'name');
    	$value['created'] = date("Y-m-d",$value['created']);
    	$value['add_time'] = date("Y-m-d",$value['add_time']);
    	$value['keshi_one'] = pdo_getcolumn("hyb_yl_classgory",array("id"=>$value['z_room']),'ctname');
    	$value['keshi_two'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$value['parentid']),'name');
    }
   
    $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_team_log")." as l left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=l.zid ".$where);
    $pager = pagination($total, $pageindex, $pagesize);
	include $this->template("sign/share");
}
if($op == 'shenhes')
{
	$id = $_GPC['id'];
	$tid = $_GPC['tid'];
	$item = pdo_get("hyb_yl_team_people",array("id"=>$id));
	$status = $_GPC['status'];
	$res = pdo_update("hyb_yl_team_people",array("status"=>$status,"add_time"=>time()),array("id"=>$id));
	
	if($res)
	{
		message("审核成功!",$this->createWebUrl("sign",array("op"=>"share","tid"=>$tid)),"success");
	}else{
		message("审核失败!",$this->createWebUrl("sign",array("op"=>"share","tid"=>$tid)),"error");

	}
	include $this->template("sign/share");
}
// 邀请记录删除
if($op == "sharedel")
{
	$id = $_GPC['id'];
	$tid = $_GPC['tid'];
	$res = pdo_delete("hyb_yl_team_log",array("id"=>$id));
	if($res)
	{
		message("删除成功!",$this->createWebUrl("sign",array("op"=>"share","tid"=>$tid)),"success");
	}else{
		message("删除失败!",$this->createWebUrl("sign",array("op"=>"share","tid"=>$tid)),"error");

	}
	include $this->template("sign/share");
}
if($op == 'sharedels')
{
	$ids = $_GPC['ids'];
	$tid = $_GPC['tid'];
	foreach($ids as $value)
	{
		$res = pdo_delete("hyb_yl_team_log",array("id"=>$value));
	}
	if($res)
	{
		message("删除成功!",$this->createWebUrl("sign",array("op"=>"share","tid"=>$tid)),"success");
	}else{
		message("删除失败!",$this->createWebUrl("sign",array("op"=>"share","tid"=>$tid)),"error");

	}
	include $this->template("sign/share");
}
//签约详情
if($op == 'orderdetail')
{
	global $_W,$_GPC;
	$uniacid = $_W['uniacid'];
	$id = $_GPC['id'];
	$item = pdo_get("hyb_yl_teamorder",array("id"=>$id));
	$user = pdo_fetch("select u.u_thumb,u.u_name,j.names,j.region,j.tel from ".tablename("hyb_yl_userinfo")." as u left join ".tablename("hyb_yl_userjiaren")." as j on j.openid=u.openid where u.openid='".$item['openid']."' and j.sick_index=0 and u.uniacid={$uniacid}");
	$type = pdo_get("hyb_yl_docser_speck",array("key_words"=>$item['key_words']));
	$item['time_leng'] = pdo_getcolumn("hyb_yl_docserver_type",array("typeid"=>$type['id']),'time_leng');
	$item['type_name'] = $type['titlme'];
	$item['fw_thumb'] = tomedia($type['thumb']);
	$item['created'] = date("Y-m-d H:i:s",$item['created']);
	$item['paytime'] = date("Y-m-d H:i:s",$item['paytime']);
	$item['t_time'] = date("Y-m-d H:i:s",$item['t_time']);
	$item['overtime'] = date("Y-m-d H:i:s",$item['overtime']);
	$item['s_time'] = date("Y-m-d H:i:s",$item['s_time']);
	$team = pdo_fetch("select t.*,z.z_name,z.z_zhicheng,z.parentid,z.qx_id from ".tablename("hyb_yl_team")." as t left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=t.zid where t.uniacid={$uniacid} and t.id=".$item['tid']);
	$team['thumb'] = tomedia($team['thumb']);
	$team['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$team['z_zhicheng']),'job_name');
	$team['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$team['parentid']),'name');
	$team['jigou'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$team['qx_id']),'agentname');
	include $this->template("sign/orderdetail");
}
//提现记录
if($op == 'withdrawal')
{
	$tid = $_GPC['tid'];
	$page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
   	$status = $_GPC['status'];

    $where = " where uniacid=".$uniacid." and tid=".$tid;
    if($status == '1')
   	{
   		$where .= " and status=0";
   	}else if($status == '2')
   	{
   		$where .= "and status=1";
   	}else if($status == '3')
   	{
   		$where .= " and status=2";
   	}else if($status == '4')
   	{
   		$where .= " and status=3";
   	}
   	
   	$start = empty($_GPC['start']) ? date("Y-m-d",strtotime("-1Months",time())) : $_GPC['start']; 
	$end = empty($_GPC['end']) ? date("Y-m-d",strtotime("+1days",time())) : $_GPC['end'];
   	if($start && $end)
   	{
   		$where .= " created >=".$start." and created <=".$end;
   	}
   	$style = $_GPC['style'];
   	
    $list = pdo_fetchall("select * from ".tablename("hyb_yl_team_tixian").$where." order by id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
    foreach($list as &$value)
    {
    	$value['created'] = date("Y-m-d",$value['created']);
    	$value['s_time'] = date("Y-m-d",$value['s_time']);
    	$value['z_name'] = pdo_getcolumn("hyb_yl_zhuanjia",array("zid"=>$value['zid']),'z_name');
    }
    $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_team_tixian").$where);
    $pager = pagination($total, $pageindex, $pagesize);
	include $this->template("sign/withdrawal");
}
// 团队提现操作
if($op == 'change_withdrawal')
{
	$id = $_GPC['id'];
	$tid = $_GPC['tid'];
	$status = $_GPC['status'];
	if($status == '1' || $status == '3')
	{
		$res = pdo_update("hyb_yl_team_tixian",array("status"=>$status,'s_time'=>time()),array("id"=>$id));
	}else if($status == '2')
	{
		$res = pdo_update("hyb_yl_team_tixian",array("status"=>$status,"d_time"=>time()),array("id"=>$id));
	}
	if($res)
	{
		message("设置成功!",$this->createWebUrl("sign",array("op"=>"withdrawal","tid"=>$tid)),"success");
	}else{
		message("设置失败!",$this->createWebUrl("sign",array("op"=>"withdrawal","tid"=>$tid)),"error");

	}
	include $this->template("sign/withdrawal");
}
// 团队提现删除
if($op == 'withdrawaldel')
{
	$id = $_GPC['id'];
	$tid = $_GPC['tid'];
	$res = pdo_delete("hyb_yl_team_tixian",array("id"=>$id));
	if($res)
	{
		message("删除成功!",$this->createWebUrl("sign",array("op"=>"withdrawal","tid"=>$tid)),"success");
	}else{
		message("删除失败!",$this->createWebUrl("sign",array("op"=>"withdrawal","tid"=>$tid)),"error");

	}
	include $this->template("sign/withdrawal");
}

// 删除团队列表
if($op == 'del_teams')
{
	$ids = $_GPC['ids'];
	for($i=0;$i<count($ids);$i++)
	{
	   $res = pdo_delete("hyb_yl_team",array("id" => $ids[$i]));
	    
	}
	die(json_encode(array('errno'=>1,'message'=>1)));
}

// 删除签约订单
if($op == 'del_orderlists')
{
	$ids = $_GPC['ids'];
	for($i=0;$i<count($ids);$i++)
	{
	   $res = pdo_delete("hyb_yl_teamorder",array("id" => $ids[$i]));
	    
	}
	die(json_encode(array('errno'=>1,'message'=>1)));
}
