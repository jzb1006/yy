<?php 
	global $_W,$_GPC;
    $_W['plugin'] ='green';
	$uniacid=intval($_W['uniacid']);
	require_once dirname(__FILE__) .'/Data/pdo.class.php';
	
	$op = isset($_GPC['op'])?$_GPC['op']:'index';
	$uid = $_W['uid'];
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
	  $guidance = pdo_fetchall("select id from ".tablename("hyb_yl_guidance")." where uniacid=".$uniacid." and hid=".$_GPC['hid']);
	  $guidances = '';
	  foreach($guidance as &$gu)
	  {
	    $guidances .= $gu['zid'].",";
	  }
	  $guidances = substr($guidances,0,strlen($guidances)-1);
	  define('guidances', $guidances);
	}
	$ac = $_GPC['ac'];
	if($op == 'index')
	{
		$todayss = date("Y-m-d H:i:s",time());
    	$todays = strtotime(date("Y-m-d",time()));;
	    $yesterdays = mktime(0,0,0,date('m'),date('d')-1,date('Y'));
	    $sevens = mktime(0,0,0,date('m'),date('d')-7,date('Y'));
	    $monthse = mktime(0,0,0,date('m'),date('d')-30,date('Y'));
		$type = pdo_getall("hyb_yl_tstype",array("uniacid"=>$uniacid,"pid"=>'0'));
		foreach($type as &$value)
		{
			$value['thumb'] = tomedia($value['thumb']);
			$value['today'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_guidance_order")." where uniacid=".$uniacid." and created>=".$todays." and key_words like '".$value['keyword']."'");
			$value['yesterday'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_guidance_order")." where uniacid=".$uniacid." and created >=".$yesterdays." and created <=".$todays." and key_words like '".$value['keyword']."'");

		}
		$wheres = "";
		if(is_agent == '1')
		{
			if($guidances != '')
			{
				$wheres = " and z_id in (".$guidances.")";
			}else{
				$wheres = " and z_id is NULL";
			}
			
		}
		$todays['num'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_guidance_order")." where uniacid=".$uniacid." and created>=".$todays.$wheres);
		$yesterday['num'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_guidance_order")." where uniacid=".$uniacid." and created >=".$yesterdays." and created <=".$todays.$wheres);
		$today['pay_money'] = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_guidance_order")." where (ifpay=1 or ifpay=2 or ifpay=3 or ifpay=4) and uniacid=".$uniacid." and created >=".$todays.$wheres);
		if(!$today['pay_money'])
		{
			$today['pay_money'] = '0.00';
		}
		$yesterday['pay_money'] = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_guidance_order")." where (ifpay=1 or ifpay=2 or ifpay=3 or ifpay=4) and  uniacid=".$uniacid." and created>=".$yesterdays." and created<=".$todays.$wheres);
		if(!$yesterday['pay_money'])
		{
			$yesterday['pay_money'] = '0.00';
		}
		$seven['pay_money'] = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_guidance_order")." where (ifpay=1 or ifpay=2 or ifpay=3 or ifpay=4) and  uniacid=".$uniacid." and created>=".$sevens." and created<=".$todays.$wheres);
		if(!$seven['pay_money'])
		{
			$seven['pay_money'] = '0.00';
		}
		$monthss['pay_money'] = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_guidance_order")." where (ifpay=1 or ifpay=2 or ifpay=3 or ifpay=4) and  uniacid=".$uniacid." and created>=".$monthse." and created<=".$todays.$wheres);
		if(!$monthss['pay_money'])
		{
			$monthss['pay_money'] = '0.00';
		}
		$jiezhen = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_guidance_order")." where uniacid=".$uniacid." and ifpay=1".$wheres);
		$pay_order = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_guidance_order")." where uniacid=".$uniacid." and ifpay=0".$wheres);
		
		$over_order = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_guidance_order")." where uniacid=".$uniacid." and (ifpay=3 or ifpay=4 or ifpay=6 or ifpay=7 or ifpay=8)".$wheres);

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
				$baogaojiaji = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_guidance_order")." where uniacid=:uniacid and created>=:starttime and created<=:endtime and (ifpay=1 or ifpay=2 or ifpay=3 or ifpay=4) and key_words like '%baogaojiaji%'".$wheres,$params);
				if(!$baogaojiaji)
				{
					$baogaojiaji = '0.00';
				}
				$yuyuejiuzhen = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_guidance_order")." where uniacid=:uniacid and created>=:starttime and created<=:endtime and (ifpay=1 or ifpay=2 or ifpay=3 or ifpay=4) and key_words like '%yuyuejiuzhen%'".$wheres,$params);
				if(!$yuyuejiuzhen)
				{
					$yuyuejiuzhen = '0.00';
				}
				$zhuyuananpai = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_guidance_order")." where uniacid=:uniacid and created>=:starttime and created<=:endtime and (ifpay=1 or ifpay=2 or ifpay=3 or ifpay=4) and key_words like '%zhuyuananpai%'".$wheres,$params);
				if(!$zhuyuananpai)
				{
					$zhuyuananpai = '0.00';
				}
				$shoushuanpai = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_guidance_order")." where uniacid=:uniacid and created>=:starttime and created<=:endtime and (ifpay=1 or ifpay=2 or ifpay=3 or ifpay=4) and key_words like '%shoushuanpai%'".$wheres,$params);
				if(!$shoushuanpai)
				{
					$shoushuanpai = '0.00';
				}
		    	$datas[] = array(
			        'date' => $time,
			        'shoushuanpai' => $shoushuanpai,
			        'baogaojiaji' => $baogaojiaji,
			        'zhuyuananpai' => $zhuyuananpai,
			        'yuyuejiuzhen' => $yuyuejiuzhen,
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
		        $baogaojiaji = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_guidance_order")." where uniacid=:uniacid and created>=:starttime and created<=:endtime and (ifpay=1 or ifpay=2 or ifpay=3 or ifpay=4) and key_words like '%baogaojiaji%'".$wheres,$params);
				if(!$baogaojiaji)
				{
					$baogaojiaji = '0.00';
				}
				$yuyuejiuzhen = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_guidance_order")." where uniacid=:uniacid and created>=:starttime and created<=:endtime and (ifpay=1 or ifpay=2 or ifpay=3 or ifpay=4) and key_words like '%yuyuejiuzhen%'".$wheres,$params);
				if(!$yuyuejiuzhen)
				{
					$yuyuejiuzhen = '0.00';
				}
				$zhuyuananpai = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_guidance_order")." where uniacid=:uniacid and created>=:starttime and created<=:endtime and (ifpay=1 or ifpay=2 or ifpay=3 or ifpay=4) and key_words like '%zhuyuananpai%'".$wheres,$params);
				if(!$zhuyuananpai)
				{
					$zhuyuananpai = '0.00';
				}
				$shoushuanpai = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_guidance_order")." where uniacid=:uniacid and created>=:starttime and created<=:endtime and (ifpay=1 or ifpay=2 or ifpay=3 or ifpay=4) and key_words like '%shoushuanpai%'".$wheres,$params);
				if(!$shoushuanpai)
				{
					$shoushuanpai = '0.00';
				}
		    	$datas[] = array(
			        'date' => $time,
			        'shoushuanpai' => $shoushuanpai,
			        'baogaojiaji' => $baogaojiaji,
			        'zhuyuananpai' => $zhuyuananpai,
			        'yuyuejiuzhen' => $yuyuejiuzhen,
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
		          
		          $baogaojiaji = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_guidance_order")." where uniacid=:uniacid and created>=:starttime and created<=:endtime and (ifpay=1 or ifpay=2 or ifpay=3 or ifpay=4) and key_words like '%baogaojiaji%'".$wheres,$params);
				if(!$baogaojiaji)
				{
					$baogaojiaji = '0.00';
				}
				$yuyuejiuzhen = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_guidance_order")." where uniacid=:uniacid and created>=:starttime and created<=:endtime and (ifpay=1 or ifpay=2 or ifpay=3 or ifpay=4) and key_words like '%yuyuejiuzhen%'".$wheres,$params);
				if(!$yuyuejiuzhen)
				{
					$yuyuejiuzhen = '0.00';
				}
				$zhuyuananpai = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_guidance_order")." where uniacid=:uniacid and created>=:starttime and created<=:endtime and (ifpay=1 or ifpay=2 or ifpay=3 or ifpay=4) and key_words like '%zhuyuananpai%'".$wheres,$params);
				if(!$zhuyuananpai)
				{
					$zhuyuananpai = '0.00';
				}
				$shoushuanpai = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_guidance_order")." where uniacid=:uniacid and created>=:starttime and created<=:endtime and (ifpay=1 or ifpay=2 or ifpay=3 or ifpay=4) and key_words like '%shoushuanpai%'".$wheres,$params);
				if(!$shoushuanpai)
				{
					$shoushuanpai = '0.00';
				}
		    	$datas[] = array(
			        'date' => $time,
			        'shoushuanpai' => $shoushuanpai,
			        'baogaojiaji' => $baogaojiaji,
			        'zhuyuananpai' => $zhuyuananpai,
			        'yuyuejiuzhen' => $yuyuejiuzhen,
		        );
		        }
		      }
		    }
		}
		    
		include $this->template('green/index');
	}
	// 绿通项目
	if($op == 'special')
	{
		$page = $_GPC['page'];
        $page = empty($_GPC['page']) ? "" : $_GPC['page'];
        $pageindex = max(1, intval($page));
        $where = " where pid=0 and uniacid=".$uniacid;
        $keyword = $_GPC['keyword'];
        if($keyword)
        {
            $where .= " and title like '%$keyword%'";
        }
        $pagesize = 10;
        $list = pdo_fetchall("select * from ".tablename("hyb_yl_tstype").$where." order by sort desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
        foreach($list as &$value)
        {
        	$value['childs'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tstype")." where uniacid=".$uniacid." and pid=".$value['id']);
            $value['thumb'] = tomedia($value['thumb']);
        }
        $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tstype").$where);
        $pager = pagination($total, $pageindex, $pagesize);
        include $this->template("green/special");
	}
	if($op == 'specialtwo')
	{
		$page = $_GPC['page'];
        $page = empty($_GPC['page']) ? "" : $_GPC['page'];
        $pageindex = max(1, intval($page));
        $pid = $_GPC['pid'];
        $where = " where pid=".$pid." and uniacid=".$uniacid;
        $keyword = $_GPC['keyword'];
        if($keyword)
        {
            $where .= " and title like '%$keyword%'";
        }
        $pagesize = 10;
        $list = pdo_fetchall("select * from ".tablename("hyb_yl_tstype").$where." order by sort desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
        foreach($list as &$value)
        {
        	$value['parent'] = pdo_fetchcolumn("select title from ".tablename("hyb_yl_tstype")." where uniacid=".$uniacid." and id=".$value['pid']);
            $value['thumb'] = tomedia($value['thumb']);
        }
        $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_tstype").$where);
        $pager = pagination($total, $pageindex, $pagesize);

        include $this->template("green/specialtwo");
	}
	// 添加绿通项目
	if($op == 'addspecial')
	{
		$id = $_GPC['id'];
		$pid = $_GPC['pid'];

        $item = pdo_get("hyb_yl_tstype",array("id"=>$id,"uniacid"=>$uniacid));
        $titles = pdo_getall("hyb_yl_all_server_menulist",array("uniacid"=>$uniacid,"ser_url"=>'hyb_yl/czhuanjiasubpages/pages/longsever/index'));
        $parent = pdo_getall("hyb_yl_tstype",array("pid"=>'0','uniacid'=>$uniacid));
        
        
        if($_W['ispost'])
        {
            $data = array(
                'uniacid' => $uniacid,
                "title" => $_GPC['title'],
                "money" => $_GPC['money'],
                "thumb" => $_GPC['thumb'],
                "vip_money" => $_GPC['vip_money'],
                "status" => $_GPC['status'],
                "sort" => $_GPC['sort'],
                "pid" => $_GPC['pid'],
               	"content" => $_GPC['content'],
            );
            $title = $_GPC['title'];
            if($title == '预约就诊' && $pid == '')
            {
            	$data['keyword'] = 'yuyuejiuzhen';
            }else if($title == '住院安排' && $pid == '')
            {
            	$data['keyword'] = 'zhuyuananpai';
            }else if($title == '手术安排' && $pid == '')
            {
            	$data['keyword'] = 'shoushuanpai';
            }else if($title == '报告加急' && $pid == '')
            {
            	$data['keyword'] = 'baogaojiaji';
            }
            $is_has = pdo_get("hyb_yl_tstype",array("title"=>$title,'pid'=>$_GPC['id']));
            if($is_has)
            {
            	message("编辑失败，此项目已存在",$this->createWebUrl('green',array('op'=>'special','ac'=>'special')),"success");
            }
            if($id)
            {
                pdo_update("hyb_yl_tstype",$data,array("id"=>$id));
            }else{
                $data['created'] = time();

                $res = pdo_insert("hyb_yl_tstype",$data);
                
            }
            if($pid != '0' && $pid)
            {
            	message("编辑成功",$this->createWebUrl('green',array('op'=>'specialtwo','ac'=>'special','pid'=>$pid)),"success");
            }else{
            	message("编辑成功",$this->createWebUrl('green',array('op'=>'special','ac'=>'special')),"success");
            } 
        }
        include $this->template("green/addspecial");
	}
	// 删除绿通项目
	if($op == 'delspecial')
	{
		$id = $_GPC['id'];
        $pid = $_GPC['pid'];
        
        if($pid == '0')
        {
        	pdo_delete("hyb_yl_tstype",array("pid"=>$pid));
        }
        $res = pdo_delete("hyb_yl_tstype",array("id"=>$id));
        
        if($res)
        {
        	if($pid == '0')
        	{
        		message("删除成功",$this->createWebUrl('green',array('op'=>'special','ac'=>'special')),"success");
        	}else{
        		message("删除成功",$this->createWebUrl('green',array('op'=>'specialtwo','ac'=>'special')),"success");
        	}
        }else{
            if($pid == '0')
        	{
        		message("删除失败",$this->createWebUrl('green',array('op'=>'special','ac'=>'special')),"success");
        	}else{
        		message("删除失败",$this->createWebUrl('green',array('op'=>'specialtwo','ac'=>'special')),"success");
        	}
            
        }
        
        include $this->template("green/special");
	}
	// 修改绿通项目状态
	if($op == 'change_special')
	{
		$id = $_GPC['id'];
		$pid = $_GPC['pid'];
        $status = $_GPC['status'];
        if($pid == '0')
        {
        	pdo_update("hyb_yl_tstype",array("status"=>$status),array("pid"=>$id));
        }
        $res = pdo_update("hyb_yl_tstype",array("status"=>$status),array("id"=>$id));
        echo json_encode($res);
        exit();
	}
	// 绿通人员列表
	if($op == 'list')
	{
		$keshi_arr = pdo_getall("hyb_yl_classgory",array("uniacid"=>$uniacid,'typeint'=>'0'));

		$keshis_arr = pdo_getall("hyb_yl_ceshi",array("uniacid"=>$uniacid,"giftstatus"=>$keshi_arr[0]['id']));
		$hospital = pdo_getall("hyb_yl_hospital_diction",array("uniacid"=>$uniacid));
		$zc_arr = pdo_getall("hyb_yl_zhuanjia_job",array("uniacid"=>$uniacid));
		$page = empty($_GPC['page']) ? "" : $_GPC['page'];
    	$pageindex = max(1, intval($page));
    	$pagesize = 10;
		$where = " where a.uniacid=".$uniacid;
		$keywordtype = $_GPC['keywordtype'];
		$keyword = $_GPC['keyword'];
		if($keywordtype == '1')
		{
			$where .= " and d.agentname like '%$keyword%'";
		}else if($keywordtype == '2')
		{
			$where .= " and a.title like '%$keyword%'";
		}else if($keywordtype == '3')
		{
			$where .= " and u.u_name like '%$keyword%'";
		}else if($keywordtype == '4')
		{
			$where .= " and a.telphone like '%$keyword%'".$keyword;
		}
		
		$keshi_one = $_GPC['keshi_one'];
		if($keshi_one)
		{
			$where .= " and  a.room=".$keshi_one;
		}
		$keshi_two = $_GPC['keshi_two'];
		if($keshi_two)
		{
			$where .= " and a.parentid=".$keshi_two;
		}
		$qx_id = $_GPC['qx_id'];
		if($qx_id)
		{
			$where .= " and a.qx_id=".$qx_id;
		}
		$h_id = $_GPC['h_id'];
		if($h_id)
		{
			$where .= " and a.hid=".$h_id;
		}
		
		$gzstype = $_GPC['gzstype'];
		if($gzstype != '')
		{
			$where .= " and a.gzstype=".$gzstype;
		}
		$zhicheng = $_GPC['zhicheng'];
		if($zhicheng != '')
		{
			$where .= " and a.zhicheng =".$zhicheng;
		}
		if(is_agent == '1')
		{
			if($guidances != '')
			{
				$where .= " and a.id in (".$guidances.")";
			}else{
				$where .= " and a.id is NULL";
			}
			
		}
		
		$list = pdo_fetchall("select a.*,b.ctname,c.name,d.agentname FROM ".tablename("hyb_yl_guidance")." as a left join ".tablename("hyb_yl_classgory")."as b on b.id=a.room left join".tablename("hyb_yl_ceshi")." as c on c.id = a.parentid and c.giftstatus=b.id left join ".tablename("hyb_yl_hospital")." as d on d.hid =a.hid left join ".tablename("hyb_yl_userinfo")." as u on u.openid=a.openid ".$where." group by a.openid order by a.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
		foreach($list as &$value)
		{
			$value['thumb'] = tomedia($value['thumb']);
			$value['hospital'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$value['hid']),'agentname');
			$value['keshi_one'] = pdo_getcolumn("hyb_yl_classgory",array("id"=>$value['room']),'ctname');
			$value['keshi_two'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$value['parentid']),'name');
			$value['opentime'] =date("Y-m-d H:i:s",$value['opentime']);
		}
		$total = pdo_fetchcolumn("select count(*) FROM".tablename("hyb_yl_guidance")." as a left join ".tablename("hyb_yl_classgory")."as b on b.id=a.room left join".tablename("hyb_yl_ceshi")."as c on c.id = a.parentid and c.giftstatus=b.id left join".tablename("hyb_yl_hospital")."as d on d.hid =a.hid left join ".tablename("hyb_yl_userinfo")." as u on u.openid=a.openid ".$where." group by a.openid");
		$pager = pagination($total, $pageindex, $pagesize);
		include $this->template("green/list");
	}
	// 编辑新建绿通
	if($op == 'edit')
	{
		$id = $_GPC['id'];
		
		$res = pdo_get("hyb_yl_guidance",array("id"=>$id));
		if($res)
		{
			$res['groupid'] = explode(",",$res['groupid']);
			$res_sc =explode('、', $res['authority']);
			$res['server'] = explode(',', $res['server']);
			$add = explode("-",$res['address']);
			$res['province'] = $add[0];
			$res['city'] = $add[1];
			$res['district'] = $add[2];
			$ks_two = pdo_getall("hyb_yl_ceshi",array("giftstatus"=>$res['room']));
		}
		$groups = array('在线专家','审核专家','词条专家');
		$res['u_name'] = pdo_getcolumn("hyb_yl_userinfo",array("openid"=>$res['openid']),'u_name');
		$server = pdo_getall("hyb_yl_tstype",array("uniacid"=>$uniacid,"pid"=>'0'));


		$job_list = pdo_getall("hyb_yl_zhuanjia_job",array('uniacid'=>$uniacid,'type'=>'1'));
		//科室
		$ks_list = pdo_getall("hyb_yl_classgory",array('uniacid'=>$uniacid));
		
		
		//权限列表
		$athuo_list = pdo_getall("hyb_yl_hospital_diction",array('uniacid'=>$uniacid));
		if (empty($res)) {
			$quanxian2 = pdo_getall("hyb_yl_hospital",array('pid'=>$res['hid']));
		}else{
			//查询所属机构
			$quanxian2 = pdo_getall("hyb_yl_hospital",array('groupid'=>$res['qx_id']));
		}
		

		$authority = implode('、', $_GPC['authority']);
		$address = $_GPC['address']['province'].'-'.$_GPC['address']['city'].'-'.$_GPC['address']['district'];
		if($_W['ispost'])
		{
			$server = implode(',', $_GPC['server']);
			$is_bangding = pdo_get("hyb_yl_guidance",array("uniacid"=>$uniacid,"openid"=>$_GPC['openid']));
			if($is_bangding && $res['openid'] != $_GPC['openid'])
			{
				message("该用户已绑定其他客服，请选择其他用户!",$this->createWebUrl("green",array("op"=>"edit",'id'=>$id,'hid'=>$hid)),"error");
			}
			$data = array(
				'uniacid' =>$uniacid,
				"openid" => $_GPC['openid'],
				"title" => $_GPC['title'],
				"sort" => $_GPC['sort'],
				"score" => $_GPC['score'],
				"lng" => $_GPC['register']['location']['lng'],
          		'lat' =>$_GPC['register']['location']['lat'],
				"sex" => $_GPC['sex'],
				"idcard" => $_GPC['idcard'],
				"thumb" => $_GPC['thumb'],
				"telphone" => $_GPC['telphone'],
				"zhicheng" => $_GPC['zhicheng'],
				"address" => $address,
				"room" => $_GPC['room'],
				"parentid" => $_GPC['parentid'],
				"authority" => $authority,
				"username" => $_GPC['username'],
				"password" => md5($_GPC['password']),
				"groupid" => implode(",",$_GPC['groupid']),
				"gzstype" => $_GPC['gzstype'],
				"qx_id" => $_GPC['qx_id'],
				"hid" => $_GPC['hid'],
				"listshow" => $_GPC['listshow'],
				"exa" => $_GPC['exa'],
				"endtime" => $_GPC['endtime'],
				"sfzimgurl1back" => $_GPC['sfzimgurl1back'],
				"sfzimgurl2back" => $_GPC['sfzimgurl2back'],
				"xn_reoly" => $_GPC['xn_reoly'],
				"xn_cf" => $_GPC['xn_cf'],
				"xytime" => $_GPC['xytime'],
				"gzimgurl1back" => $_GPC['gzimgurl1back'],
				"content" => $_GPC['content'],
				"privateNum" => $_GPC['telphone'],
				"is_examine" => $_GPC['is_examine'],
				"is_urgent" => $_GPC['is_urgent'],
				"server" => $server,
				"cut" => $_GPC['cut'],
			);
			
			if($id)
			{
				$res = pdo_update("hyb_yl_guidance",$data,array("id"=>$id));
			}else{
				$data['opentime'] = time();
				$res = pdo_insert("hyb_yl_guidance",$data);
				
				
				$id = pdo_insertid();
			}

			if($res)
			{
				message("编辑成功!",$this->createWebUrl("green",array("op"=>"edit",'id'=>$id,'hid'=>$hid)),"success");
			}else{
				message("编辑失败!",$this->createWebUrl("green",array("op"=>"edit",'id'=>$id,'hid'=>$hid)),"success");
			}
		}
		include $this->template("green/edit");
	}

	// 绿通删除
	if($op == 'delete')
	{
		$id = $_GPC['id'];
		$hid = $_GPC['hid'];
		$res = pdo_delete("hyb_yl_guidance",array("id"=>$id));
		if($res)
		{
			message("删除成功!",$this->createWebUrl("green",array("op"=>"list",'ac'=>'list','hid'=>$hid)),"success");
		}else{
			message("删除失败!",$this->createWebUrl("green",array("op"=>"list",'ac'=>'list','hid'=>$hid)),"success");
		}
		include $this->template("green/list");
	}

	// 绿通批量删除
	if($op == 'deletes')
	{
		$id = $_GPC['ids'];
		$hid = $_GPC['hid'];
		foreach($id as &$value)
		{
			pdo_delete("hyb_yl_guidance",array("id"=>$value));
		}
		message("删除成功!",$this->createWebUrl("green",array("op"=>"list",'ac'=>'list','hid'=>$hid)),"success");
		include $this->template("green/list");

	}

	// 绿通订单
	if($op == 'order')
	{
		$type_arr = pdo_getall("hyb_yl_tstype",array("uniacid"=>$uniacid,"pid"=>'0'));
		$page = empty($_GPC['page']) ? "" : $_GPC['page'];
    	$pageindex = max(1, intval($page));
    	$pagesize = 10;
		$where = " where a.uniacid=".$uniacid;
		$keywordtype = $_GPC['keywordtype'];
		$keyword = $_GPC['keyword'];
		if($keywordtype == '1')
		{
			$where .= " and a.back_orser like '%$keyword%'";
		}else if($keywordtype == '2')
		{
			$where .= " and u.names like '%$keyword%'";
		}else if($keywordtype == '3')
		{
			$where .= " and a.telphone like '%$keyword%'";
		}
		$type = $_GPC['type'];
		if($type != '')
		{
			$where .= " and a.key_words like '%$type%'";
		}

		$ifpay = $_GPC['ifpay'];
		if($ifpay != '' && $ifpay != '5')
		{
			$where .= " and a.ifpay=".$ifpay;
		}else if($ifpay == '5')
		{
			$where .= " and (a.ifpay=5 or a.ifpay=6)";
		}
		$timetype = $_GPC['timetype'];
    	$start = empty($_GPC['start']) ? date("Y-m-d",strtotime("-1Months",time())) : $_GPC['start']; 
    	$end = empty($_GPC['end']) ? date("Y-m-d",strtotime("+1days",time())) : $_GPC['end'];
    	if($timetype == '1')
    	{
    		$where .= " and a.created >=".strtotime($start)." and a.created <=".strtotime($end);
    	}else if($timetype == '2')
    	{
    		$where .= " and a.paytime >=".strtotime($start)." and a.paytime <=".strtotime($end);
    	}
    	if($key_words != '')
    	{
    		$where .= " and a.key_words='".$key_words."'";
    	}
    	if(is_agent == '1')
		{
			if($guidances != '')
			{
				$where .= " and a.z_id in (".$guidances.")";
			}else{
				$where .= " and a.z_id is NULL";
			}
			
		}
    	$list = pdo_fetchall("select a.*,u.names from ".tablename("hyb_yl_guidance_order")."  as a left join ".tablename("hyb_yl_userjiaren")." as u on u.j_id=a.j_id ".$where." order by a.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
    	
    	foreach($list as &$value)
    	{
    		$user = pdo_get("hyb_yl_userinfo",array("openid"=>$value['openid']));
    		$value['randnum'] = $user['randnum'];
    		$value['user'] = $user;
    		if($value['did'] != '0' && $value['did'] != '')
    		{
    			$doc = pdo_fetch("select a.*,b.name,c.job_name,d.agentname from ".tablename("hyb_yl_guidance")." as a left join ".tablename("hyb_yl_ceshi")." as b on b.id=a.parentid left join ".tablename("hyb_yl_zhuanjia_job")." as c on c.id=a.zhicheng left join ".tablename("hyb_yl_hospital")." as d on d.hid=a.hid",array("id"=>$value['did']));

    			$doc['thumb'] = tomedia($doc['thumb']);
    			$value['doc'] = $doc;
    		}else if($value['z_id'] != '0' && $value['z_id'] != '')
    		{
    			$doc = pdo_fetch("select a.*,b.name,c.job_name,d.agentname from ".tablename("hyb_yl_zhuanjia")." as a left join ".tablename("hyb_yl_ceshi")." as b on b.id=a.parentid left join ".tablename("hyb_yl_zhuanjia_job")." as c on c.id=a.z_zhicheng left join ".tablename("hyb_yl_hospital")." as d on d.hid=a.hid",array("id"=>$value['did']));
    			$doc['thumb'] = tomedia($doc['advertisement']);
    			$doc['title'] = $doc['z_name'];
    			$value['doc'] = $doc;
    		}
    		$value['created'] = date("Y-m-d H:i:s",$value['created']);
    		$value['paytime'] = date("Y-m-d H:i:s",$value['paytime']);
    		$value['apply_time'] = date("Y-m-d H:i:s",$value['apply_time']);
    		$value['refund_time'] = date("Y-m-d H:i:s",$value['refund_time']);
    		$value['cancel_time'] = date("Y-m-d H:i:s",$value['cancel_time']);
    		if($value['fuwus'] != '')
    		{
    			$value['fuwus'] = unserialize($value['fuwus']);
    		}
    		$value['typs'] = pdo_fetchcolumn("select title from ".tablename("hyb_yl_tstype")." where uniacid=".$uniacid." and keyword='".$value['key_words']."'");
    		$value['moneyss'] = $value['money'] - $value['tk_one'] - $value['tk_two'] - $value['ptmoney'] - $value['hosmoney'] - $value['card_dk'] - $value['vip_dk'];
    	}
    	$total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_guidance_order")."  as a left join ".tablename("hyb_yl_userjiaren")." as u on u.j_id=a.j_id ".$where);
    	$pager = pagination($total, $pageindex, $pagesize);
    	if(is_agent == '1')
    	{
    		if($guidances != '')
    		{
    			$wheres = " and did in (".$guidances.")";
    		}else{
    			$wheres = " and did = ''";
    		}
    		
    	}else{
    		$wheres = " and did = ''";
    	}
    	$count = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_guidance_order")." where uniacid=".$uniacid.$wheres);
    	$money = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_guidance_order")." where uniacid=".$uniacid.$wheres);
    	$count_people = pdo_fetchcolumn("select count(distinct openid) from ".tablename("hyb_yl_guidance_order")." where uniacid=".$uniacid.$wheres);
        include $this->template('green/order');

	}
	// 订单指派查看专家或导诊
	if($op == 'assign_list')
	{
		$keyword = $_GPC['keyword'];
		if($keyword != 'baogaojiaji')
		{
			$list = pdo_fetchall("select * from ".tablename("hyb_yl_guidance")." where uniacid=".$uniacid." and gzstype=1 and listshow=0 and exa=1 and server like '%$keyword%'");
			
		}else{
			$list = pdo_fetchall("select * from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and gzstype=1 and listshow=0 and exa=1 and is_urgent =1");
		}
		
		echo json_encode($list);
		exit();

	}

	// 订单指派
	if($op == 'doassign')
	{
		$id = $_GPC['id'];
		$did = $_GPC['did'];
		$zid = $_GPC['zid'];
		$hid = $_GPC['hid'];
		if($did == '' && $zid == '')
		{
			message("请先选择服务人员!",$this->createWebUrl("green",array("op"=>"order",'ac'=>'order','hid'=>$hid)),"error");
		}else{
			if($did != '')
			{
				$name = pdo_getcolumn("hyb_yl_guidance",array("id"=>$did),'title');

			}else if($zid != '')
			{
				$name = pdo_getcolumn("hyb_yl_zhuanjia",array("zid"=>$zid),'z_name');
			}
			$order = pdo_get("hyb_yl_guidance_order",array("id"=>$id,"uniacid"=>$uniacid));
			$res = pdo_update("hyb_yl_guidance_order",array("did"=>$did,"z_id"=>$zid,'ifpay'=>'2','accept_time'=>time()),array("id"=>$id));
			
			if($res)
			{
				$content = array(
					'text' => '您的订单已被'.$name."接单，请及时查看",
					'typedate' => '0',
					'upload_picture_list' => ''
				);

				$data = array(
					'uniacid' => $uniacid,
					"order_id" => $id,
					"back_orser" => $order['back_orser'],
					"content" => serialize($content),
					"created" => time(),
					"role" => '1',
					"openid" => $order['openid'],
					"z_id" => $zid,
					"did" => $did,
				);
				pdo_insert("hyb_yl_guidance_message",$data);
				message("指派成功!",$this->createWebUrl("green",array("op"=>"order",'ac'=>'order','hid'=>$hid)),"success");
			}else{
				message("指派失败!",$this->createWebUrl("green",array("op"=>"order",'ac'=>'order','hid'=>$hid)),"error");
			}
		}
		
		include $this->template("green/order");

		
	}
	// 获取订单详情
	if($op == 'order_detail')
	{
		global $_W,$_GPC;
		$uniacid = $_W['uniacid'];
		$id = $_GPC['id'];
		$hid = $_GPC['hid'];
		$order = pdo_get("hyb_yl_guidance_order",array("id"=>$id,"uniacid"=>$uniacid));
		$order['tk'] = pdo_fetchcolumn("select b.username from ".tablename("hyb_yl_tuikesite")." as a  left join ".tablename("hyb_yl_tuikesite")." as b on b.tkid=a.id where a.uniacid=".$uniacid." and a.openid='".$order['openid']."'");
		if($order['did'] != '0' && $order['did'] != '')
		{
			$doc = pdo_fetch("select a.*,b.name,c.job_name,d.agentname from ".tablename("hyb_yl_guidance")." as a left join ".tablename("hyb_yl_ceshi")." as b on b.id=a.parentid left join ".tablename("hyb_yl_zhuanjia_job")." as c on c.id=a.zhicheng left join ".tablename("hyb_yl_hospital")." as d on d.hid=a.hid",array("id"=>$order['did']));
			$doc['ctname'] = pdo_getcolumn("hyb_yl_classgory",array("id"=>$doc['room']),'ctname');
			$doc['thumb'] = tomedia($doc['thumb']);
		}else if($order['z_id'] != '0' && $order['z_id'] != '')
		{
			$doc = pdo_fetch("select a.*,b.name,c.job_name,d.agentname from ".tablename("hyb_yl_zhuanjia")." as a left join ".tablename("hyb_yl_ceshi")." as b on b.id=a.parentid left join ".tablename("hyb_yl_zhuanjia_job")." as c on c.id=a.z_zhicheng left join ".tablename("hyb_yl_hospital")." as d on d.hid=a.hid",array("id"=>$order['did']));
			$doc['ctname'] = pdo_getcolumn("hyb_yl_classgory",array("id"=>$doc['z_room']),'ctname');
			$doc['thumb'] = tomedia($doc['advertisement']);
			$doc['title'] = $doc['z_name'];
		}
		$user = pdo_get("hyb_yl_userjiaren",array("j_id"=>$order['j_id'],"uniacid"=>$uniacid));
		$info = pdo_get("hyb_yl_userinfo",array("openid"=>$user['openid']));
		$user['u_thumb'] = $info['u_thumb'];
		$user['u_name'] = $info['u_name'];
		$user['u_id'] = $info['u_id'];
		$order['created'] = date("Y-m-d H:i:s",$order['created']);
		$order['paytime'] = date("Y-m-d H:i:s",$order['paytime']);
		$order['apply_time'] = date("Y-m-d H:i:s",$order['apply_time']);
		$order['refund_time'] = date("Y-m-d H:i:s",$order['refund_time']);
		$order['cancel_time'] = date("Y-m-d H:i:s",$order['cancel_time']);
		$order['accept_time'] = date("Y-m-d H:i:s",$order['accept_time']);
		$order['typs'] = pdo_fetchcolumn("select title from ".tablename("hyb_yl_tstype")." where uniacid=".$uniacid." and keyword='".$order['key_words']."'");
		$order['moneyss'] = $order['money'] - $order['tk_one'] - $order['tk_two'] - $order['ptmoney'] - $order['hosmoney'] - $order['card_dk'] - $order['vip_dk'];
		include $this->template("green/order_detail");
	}
	// 查询对话
	if($op == 'askchat')
	{
		$back_orser = $_GPC['back_orser'];
		$order = pdo_get("hyb_yl_guidance_order",array("back_orser"=>$back_orser));
		$hid = $_GPC['hid'];
		$users = pdo_get("hyb_yl_userjiaren",array("j_id"=>$order['j_id']));
  		$user = pdo_get("hyb_yl_userinfo",array("openid"=>$order['openid']));
  		$jiaren = pdo_fetchall("select * from ".tablename("hyb_yl_userjiaren")." where uniacid=".$uniacid." and openid='".$order['openid']."' and sick_index != 0");
		if($order['did'] != '0' && $order['did'] != '')
		{
			$doc = pdo_fetch("select a.*,b.name,c.job_name,d.agentname from ".tablename("hyb_yl_guidance")." as a left join ".tablename("hyb_yl_ceshi")." as b on b.id=a.parentid left join ".tablename("hyb_yl_zhuanjia_job")." as c on c.id=a.zhicheng left join ".tablename("hyb_yl_hospital")." as d on d.hid=a.hid",array("id"=>$order['did']));
			$doc['ctname'] = pdo_getcolumn("hyb_yl_classgory",array("id"=>$doc['room']),'ctname');
			$doc['thumb'] = tomedia($doc['thumb']);
		}else if($order['z_id'] != '0' && $order['z_id'] != '')
		{
			$doc = pdo_fetch("select a.*,b.name,c.job_name,d.agentname from ".tablename("hyb_yl_zhuanjia")." as a left join ".tablename("hyb_yl_ceshi")." as b on b.id=a.parentid left join ".tablename("hyb_yl_zhuanjia_job")." as c on c.id=a.z_zhicheng left join ".tablename("hyb_yl_hospital")." as d on d.hid=a.hid",array("id"=>$order['did']));
			$doc['ctname'] = pdo_getcolumn("hyb_yl_classgory",array("id"=>$doc['z_room']),'ctname');
			$doc['thumb'] = tomedia($doc['advertisement']);
			$doc['title'] = $doc['z_name'];
		}

		$message = pdo_getall("hyb_yl_guidance_message",array("back_orser"=>$back_orser));
		
		if(count($message) == 0)
		{
			$message = pdo_fetchall("select * from ".tablename("hyb_yl_guidance_order")." where back_orser='".$back_orser."'");

			foreach($message as &$values)
			{
				$values['role'] = '0';
				
			}
			
		}

		
		foreach($message as &$value)
		{
			$value['content'] = unserialize($value['content']);
			$value['created'] = date("Y-m-d H:i:s",$value['created']);
		}
		include $this->template("green/askchat");
	}

	// 订单回复
	if($op == 'askchat_huifu')
	{
		$text = $_GPC['text'];
		$hid = $_GPC['hid'];
	  	$back_orser = $_GPC['back_orser'];
	  	$content = array(
	    	'text' => $text,
		    'typedate' => '0',
		    "upload_picture_list"=>''
	    );
	    $contents = serialize($content);
	    $item = pdo_get("hyb_yl_guidance_order",array("back_orser"=>$back_orser));
	    $data = array(
		    'uniacid' => $uniacid,
		    "order_id" => $item['id'],
		    "back_orser" => $item['back_orser'],
		    "content" => $contents,
		    "created" => time(),
		    "openid" => $item['openid'],
		    "z_id" => $item['z_id'],
		    "did" => $item['did'],
		    "role" => '1',
		    
	    );
	    $res = pdo_insert("hyb_yl_guidance_message",$data);
	}
	// 修改订单状态
	if($op == 'changeorder')
	{
		$id = $_GPC['id'];
		$hid = $_GPC['hid'];
		$res = pdo_update("hyb_yl_guidance_order",array("ifpay"=>'1','paytime'=>time()),array("id"=>$id));
		if($res)
		{
			message("修改成功!",$this->createWebUrl("green",array("op"=>"order",'ac'=>'order','hid'=>$hid)),"success");
		}else{
			message("修改失败!",$this->createWebUrl("green",array("op"=>"order",'ac'=>'order','hid'=>$hid)),"success");
		}
		include $this->template("green/order");
	}

	// 删除订单
	if($op == 'del_order')
	{
		$back_orser = $_GPC['back_orser'];
		$hid = $_GPC['hid'];
		pdo_delete("hyb_yl_guidance_message",array("back_orser"=>$back_orser));
		$res = pdo_delete("hyb_yl_guidance_order",array("back_orser"=>$back_orser));

		if($res)
		{
			message("删除成功!",$this->createWebUrl("green",array("op"=>"order",'ac'=>'order','hid'=>$hid)),"success");
		}else{
			message("删除失败!",$this->createWebUrl("green",array("op"=>"order",'ac'=>'order','hid'=>$hid)),"success");
		}
		include $this->template("green/order");
	}

	// 多选删除订单
	if($op == 'del_orders')
	{
		$back_orsers = $_REQUEST['back_orsers'];
		$hid = $_REQUEST['hid'];
		foreach($back_orsers as &$value)
		{
			$res = pdo_delete("hyb_yl_guidance_message",array("back_orser"=>$value));
			pdo_delete("hyb_yl_guidance_order",array("back_orser"=>$value));
		}
		message("删除成功!",$this->createWebUrl("green",array("op"=>"order",'ac'=>'order','hid'=>$hid)),"success");
		include $this->template("green/order");

	}
	// 获取导诊元列表
	if($op == 'getdaozhen')
	{
		global $_W,$_GPC;
		$uniacid = $_W['uniacid'];
		$hid = $_GPC['hid'];
		$address = $_GPC['address']['province'].'-'.$_GPC['address']['city'].'-'.$_GPC['address']['district'];
		$hospital = pdo_getall("hyb_yl_hospital_diction",array("uniacid"=>$uniacid));
		$r_id = $_GPC['r_id'];
		$h_id = $_GPC['h_id'];
		$where = " where uniacid=".$uniacid;
		if($address != '')
		{
			$where .= " and address like '%$address%'";
		}
		if($r_id != '')
		{
			$where .= " and room=".$r_id;
		}
		if($h_id != '')
		{
			$where .= " and h_id=".$h_id;
		}
		if($hid != '')
		{
			$where .= " and hid=".$hid;
		}
		$list = pdo_fetchall("select * from ".tablename("hyb_yl_guidance").$where);
		echo json_encode($list);
		exit();
	}

	// 派遣导诊
	if($op == 'daozhen_add')
	{
		$g_id = $_GPC['g_id'];
		$id = $_GPC['id'];
		$hid = $_GPC['hid'];
		$res = pdo_update("hyb_yl_guidance",array("g_id"=>$g_id),array("id"=>$id));
		if($res)
		{
			message("设置成功!",$this->createWebUrl("green",array("op"=>"order",'hid'=>$hid)),"success");
		}else{
			message("设置失败!",$this->createWebUrl("green",array("op"=>"order",'hid'=>$hid)),"success");
		}
	}

	// 修改导诊状态
	if($op == 'edit_daozhen')
	{
		$id = $_GPC['id'];
		$ifpay = $_GPC['ifpay'];
		$hid = $_GPC['hid'];
		$res = pdo_update("hyb_yl_guidance",array("ifpay"=>$ifpay),array("id"=>$id));
		if($res)
		{
			message("设置成功!",$this->createWebUrl("green",array("op"=>"order",'hid'=>$hid)),"success");
		}else{
			message("设置失败!",$this->createWebUrl("green",array("op"=>"order",'hid'=>$hid)),"success");
		}
	}
	if($op == 'del_daozhen')
	{
		$id = $_GPC['id'];
		$hid = $_GPC['hid'];
		$res = pdo_delete("hyb_yl_guidance",array("id"=>$id));
		if($res)
		{
			message("设置成功!",$this->createWebUrl("green",array("op"=>"order",'hid'=>$hid)),"success");
		}else{
			message("设置失败!",$this->createWebUrl("green",array("op"=>"order",'hid'=>$hid)),"success");
		}
	}

    // 压缩二维码
    if($op == 'zips')
    {
    	date_default_timezone_set("PRC");
		ini_set('max_execution_time',0);
	    // 不限制内存使用
	    ini_set('memory_limit',-1);
	    
	    require_once dirname(dirname(dirname(__FILE__)))."/zip.php";
    	$zip = new zip();
	    //PHP压缩文件夹为zip压缩文件
	   
	   
	    if($zip->zipFolder('../attachment/hyb_yl/share',"../attachment/hyb_yl/erweima_".date("Y-m-d",time()).".zip")){
	            echo '成功压缩了文件夹。';
	    }else{
	            echo '文件夹没有压缩成功。';
	    }

	    ob_end_clean();
	    header("Content-Type: application/force-download");
	    header("Content-Transfer-Encoding: binary");
	    header('Content-Type: application/zip');
	    header('Content-Disposition: attachment; filename='.basename("../attachment/hyb_yl/erweima_".date("Y-m-d",time()).".zip"));
	    header('Content-Length: '.filesize("../attachment/hyb_yl/erweima_".date("Y-m-d",time()).".zip"));
	    error_reporting(0);
	    @readfile("../attachment/hyb_yl/erweima_".date("Y-m-d",time()).".zip");
	    flush();
	    ob_flush();
	    exit;
    }