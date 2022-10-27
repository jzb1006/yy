<?php 
	global $_W,$_GPC;
    $_W['plugin'] ='store';
	$uniacid=intval($_W['uniacid']);
	require_once dirname(__FILE__) .'/Data/pdo.class.php';
	require_once dirname(dirname(dirname(__FILE__)))."/erweima.php";
	$thumbs = new erweima();
	$model = new Model('category');
    $doctor= new Model('zhuanjia');
	$op = isset($_GPC['op'])?$_GPC['op']:'doctor';
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
	$uid = $_W['uid'];
	$type_id = $_GPC['type_id'];
	$ac = $_GPC['ac'];
	if($op =='doctor'){
		$keshi_arr = pdo_getall("hyb_yl_classgory",array("uniacid"=>$uniacid,'typeint'=>'0'));
		$keshis_arr = pdo_getall("hyb_yl_ceshi",array("uniacid"=>$uniacid,"giftstatus"=>$keshi_arr[0]['id']));
		$zhicheng_arr = pdo_getall("hyb_yl_zhuanjia_job",array('uniacid'=>$uniacid,'type'=>'1'));
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
			$where .= " and a.z_name like '%$keyword%'";
		}else if($keywordtype == '3')
		{
			$where .= " and a.z_telephone like '%$keyword%'";
		}else if($keywordtype == '4')
		{
			$where .= " and a.zid=".$keyword;
		}
		$status = empty($_GPC['status']) ? '' : $_GPC['status'];
		if($status == '1')
		{
			$where .= " and a.exa=1 and a.endtime >='".date("Y-m-d",time())."'";
		}else if($status == '2')
		{
			$where .= " and a.exa=0";
		}else if($status == '3')
		{
			$where .= " and a.exa=2";
		}else if($status == '4')
		{
			$where .= " and a.endtime <='".date("Y-m-d",time())."'";
		}
		if(is_agent == '1')
		{
			$where .= " and a.zid in (".$zjs.")";
		}
		$keshi = $_GPC['keshi'];
		$keshi_two = $_GPC['keshi_two'];
		if($keshi_two)
		{
			$where .= " and a.parentid=".$keshi_two;
		}
		$zhicheng = $_GPC['zhicheng'];
		if($keshi)
		{
			$where .= " and  a.z_room=".$keshi;
		}
		if($zhicheng)
		{
			$where .= " and a.z_zhicheng=".$zhicheng;
		}
		$gzstype = $_GPC['gzstype'];
		if($gzstype != '')
		{
			$where .= " and a.gzstype=".$gzstype;
		}
		$listsql = "SELECT a.*,b.ctname,c.name,d.agentname FROM".tablename("hyb_yl_zhuanjia")." as a left join ".tablename("hyb_yl_classgory")."as b on b.id=a.z_room left join".tablename("hyb_yl_ceshi")."as c on c.id = a.parentid and c.giftstatus=b.id left join".tablename("hyb_yl_hospital")."as d on d.hid =a.hid".$where." group by a.openid";
			
		$res = pdo_fetchall($listsql." limit ".($pageindex - 1) * $pagesize.",".$pagesize);
		$result = pdo_fetch('SELECT * FROM ' . tablename('hyb_yl_parameter') . " where `uniacid`='{$uniacid}' ", array(":uniacid" => $uniacid));
        $APPID = $result['appid'];
        $SECRET = $result['appsecret'];
        $base = pdo_getcolumn("hyb_yl_zhuanjia_rule",array("uniacid"=>$uniacid),'background');
		foreach($res as &$value)
		{
			$value['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$value['parentid']),'name');
			$value['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$value['z_zhicheng']),'job_name');
			$value['hospital'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$value['hid']),'agentname');
			
			$labels = $value['keshi']."|".$value['zhicheng'];
			$data = array(
				'hospital' => $value['hospital'],
				'z_name' => $value['z_name'],
				'zid' => $value['zid'],
				"thumb" => tomedia($value['advertisement']),
				'share_erweima' => $value['share_erweima'],
				"erweima" => $value['weweima'],
				"labels" => $labels,
				"shanchan" => "擅长：".$value['authority'],
				"background" => tomedia($base),
				"appid" => $APPID,
				"appsecret" => $SECRET
			);
			if($value['weweima'] != '')
			{
				$value['erweima'] = $_W['siteroot'].$value['weweima'];
			}
			if($value['share_erweima'] != '')
			{
				$value['share_erweima'] = $_W['siteroot'].$value['share_erweima'];
			}
		}

		$total = count(pdo_fetchall($listsql));
		$pager = pagination($total, $pageindex, $pagesize);
		$wheres = '';
		if(is_agent == '1')
		{
			$wheres = " and zid in (".$zjs.")";
		}
		$ruzhu = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and exa=1 and endtime >='".date("Y-m-d",time())."'".$wheres);
		$shenhe = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and  exa=0".$wheres);

		$zanting = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and exa=2".$wheres);
		$daoqi = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and  endtime <='".date("Y-m-d",time())."'".$wheres);
		


		if($_W['isajax']){
             switch ($_GPC['type']) {
             	case 'list':
             	$id =intval($_GPC['id']);
             	if($id ==0){
                  $where = "$tab1.uniacid='".$uniacid."' and $tab1.uid='".$uid."'  order by $tab1.time DESC";
             	}else{
                  $where = "$tab1.uniacid='".$uniacid."' and $tab1.uid='".$uid."' and $tab1.z_room='".$id."' order by $tab1.time DESC";
             	}
				$sql="SELECT DISTINCT $tab1.z_room,$tab1.*,$tab2.id,$tab2.parentid AS pid,$tab2.name FROM $tab1 LEFT JOIN $tab2 ON $tab1.z_room=$tab2.id  WHERE $where";
				$page=$model->pagenation($sql);
				$list=$page['dataset'];
				foreach ($list as $key => $value) {
					$list[$key]['time'] =date('Y-m-d',$list[$key]['time']);
					$list[$key]['z_thumbs'] =$_W['attachurl'].$list[$key]['z_thumbs'];
				}
				break;
             }
             message(error(0, $list), '', 'ajax'); 
		}
        include $this->template('team/list');
	}


  if($op =='huanzhe'){
    $zid = $_GPC['zid'];
	$res = pdo_fetch("SELECT  a.*,b.id,b.ctname,c.agentname,c.hid,d.level_name FROM " . tablename("hyb_yl_zhuanjia") . " as a left join " . tablename("hyb_yl_classgory") . " as b on a.z_room=b.id left join" . tablename('hyb_yl_hospital') . "as c on c.hid=a.hid left join" . tablename('hyb_yl_hospital_level') . "as d on d.id=c.grade where a.zid='{$zid}' and a.uniacid='{$uniacid}' ");

    $res['authority'] = explode('、', $res['authority']);
    $authority = $res['authority'];
    
    $weifenzu1 = pdo_fetchall("SELECT * from".tablename('hyb_yl_twenorder')."where zid='{$zid}' and uniacid='{$uniacid}' group by openid desc");

    foreach ($weifenzu1 as $key => $value) {
        $openid = $value['openid'];
        $userinfo1[] = pdo_fetch("select a.u_name,a.openid,a.u_id,a.u_thumb,b.label from".tablename('hyb_yl_userinfo')."as a left join".tablename('hyb_yl_userlabelarr')."as b on b.openid=a.openid where a.uniacid='{$uniacid}' and a.openid='{$openid}'");
            foreach ($userinfo1 as $key5 => $value5) {
               $openid = $value5['openid'];
               $userinfo1[$key]['user'] = pdo_get("hyb_yl_userjiaren",array('openid'=>$openid,'sick_index'=>0));
            }

    }

    $weifenzu2 = pdo_fetchall("SELECT * from".tablename('hyb_yl_wenzorder')."where zid='{$zid}' and uniacid='{$uniacid}' group by openid desc");
    foreach ($weifenzu2 as $key => $value) {
        $openid = $value['openid'];
        $userinfo2[] = pdo_fetch("select a.u_name,a.openid,a.u_id,a.u_thumb,b.label from".tablename('hyb_yl_userinfo')."as a left join".tablename('hyb_yl_userlabelarr')."as b on b.openid=a.openid where a.uniacid='{$uniacid}' and a.openid='{$openid}'");
            foreach ($userinfo2 as $key4 => $value4) {
               $openid = $value4['openid'];
               $userinfo2[$key]['user'] = pdo_get("hyb_yl_userjiaren",array('openid'=>$openid,'sick_index'=>0));
            }
    }

    $userinfo3 = array_merge($userinfo1,$userinfo2);
    
    $userinfo4 = $this->assoc_unique($userinfo3,'openid');

    foreach ($userinfo4 as $key3 => $value3) {
        if(empty($value3['label'])){
            $fenzuwei[]=$value3;
        }else{
            $yifen[]=$value3['label'];
        }
    }

    foreach ($userinfo4 as $key2 => $value2) {
        $openid =$value2['openid'];
        $userinfo4[$key2]['label'] = pdo_getcolumn('hyb_yl_userlabelarr',array('openid'=>$openid,'zid'=>$zid),'label');
        if(!$userinfo4[$key2]['label']){
          $userinfo5[] = pdo_get('hyb_yl_userlabelarr',array('openid'=>$openid,'zid'=>$zid),'label');
        }
    }
   
    $overbiaoqian =array_filter(array_unique(array_merge($yifen,$authority)));
    foreach ($overbiaoqian as $key => $value) {
       
       $zong = pdo_fetchall("SELECT * from".tablename('hyb_yl_userlabelarr')." where uniacid='{$uniacid}' and zid='{$zid}' and label regexp '{$value}' group by openid ");

       foreach ($zong as $key2 => $value2) {
           $openid = $value2['openid'];
           $user[] = pdo_get('hyb_yl_userinfo',array('openid'=>$openid));
       }

       $count[] = count($zong);
    }

    foreach ($overbiaoqian as $key => $value) {
        $newdate[$key]['description']=$overbiaoqian[$key];  
        $newdate[$key]['count']=$count[$key];
        if($newdate[$key]['count'] == '')
        {
        	$newdate[$key]['count'] = 0;
        }
    }
    $arr = array(
    	'description' => '未分组',
    	'count' => count($fenzuwei),
    );	
    array_push($newdate,$arr);
    $newdates = json_encode($newdate);
    include $this->template('team/huanzhe');
  }

  // 添加分组
  if($op == 'add_fenzu')
  {
  	$name = $_GPC['name'];
  	$zid = $_GPC['zid'];
    $fzid = $_GPC['fzid'];
    $labelList = $_GPC['labelList'];
    $idarr = json_decode($labelList,true);
    $idarr = array_column($idarr,'description');
    array_push($idarr,$name);
    $biaoqian = implode(',',$idarr);
    
    $openid = pdo_get("hyb_yl_zhuanjia",array("zid"=>$zid),'openid');
    if(empty($fzid)){
        $res = pdo_insert('hyb_yl_userlabelarr',array('uniacid'=>$uniacid,'label'=>$name,'zid'=>$zid,'openid'=>$openid,'addtime'=>strtotime('now')));
    }else{
        $res = pdo_update('hyb_yl_userlabelarr',array('label'=>$name),array('id'=>$fzid));
    }
    
    $doc = pdo_get('hyb_yl_zhuanjia',array('zid'=>$zid));
    $authority = explode('、',$doc['authority']);
    $doc_biao = $doc['authority'];
    $weiyou=[];
    foreach ($idarr as $key => $value) {
       if(in_array($value,$authority)){
       }else{
         $weiyou[]=$value;
       }
    }
    $wwei_data = implode('、',$weiyou);
    $data =array(
       'authority'=>$doc_biao.'、'.$wwei_data
        );
    $res = pdo_update('hyb_yl_zhuanjia',$data,array('zid'=>$zid));
    if($res)
    {
    	message("添加成功!",$this->createWebUrl("team",array("op"=>"huanzhe",'zid'=>$zid)),"success");
    }else{
    	message("添加失败!",$this->createWebUrl("team",array("op"=>"huanzhe",'zid'=>$zid)),"error");
    }
    include $this->template('team/huanzhe');
  }

  if($op == 'del_fenzu')
  {
  	$content = $_GPC['content'];
  	$zid = $_GPC['zid'];
  	$fzid = $_GPC['fzid'];
    $labelList = $_GPC['labelList'];
    $idarr = json_decode($labelList,true);
    $idarr = array_column($idarr,'description');
    foreach($idarr as $key => $value)
    {
    	if($value == $content)
    	{
    		unset($idarr[$key]);
    	}
    }
    $biaoqian = implode(',',$idarr);
    
    $openid = pdo_get("hyb_yl_zhuanjia",array("zid"=>$zid),'openid');
    if($fzid){
        $res = pdo_delete('hyb_yl_userlabelarr',array("id"=>$fzid));
    }
    
    $doc = pdo_get('hyb_yl_zhuanjia',array('zid'=>$zid));
    $authority = explode('、',$doc['authority']);
    $doc_biao = $doc['authority'];
    $weiyou=[];
    foreach ($idarr as $key => $value) {
       if(in_array($value,$authority)){
       }else{
         $weiyou[]=$value;
       }
    }
    $wwei_data = implode('、',$weiyou);
    $data =array(
       'authority'=>$doc_biao.'、'.$wwei_data
        );
    $res = pdo_update('hyb_yl_zhuanjia',$data,array('zid'=>$zid));
    if($res)
    {
    	message("添加成功!",$this->createWebUrl("team",array("op"=>"huanzhe",'zid'=>$zid)),"success");
    }else{
    	message("添加失败!",$this->createWebUrl("team",array("op"=>"huanzhe",'zid'=>$zid)),"error");
    }
    include $this->template('team/huanzhe');
  }

  // 患者分组用户
  	if($op == 'users')
  	{
  		$name = $_GPC['name'];
  		$zid = $_GPC['zid'];
  		if($name == '未分组')
  		{
  			$weifenzu1 = pdo_fetchall("SELECT * from".tablename('hyb_yl_twenorder')."where zid='{$zid}' and uniacid='{$uniacid}' group by openid desc");
	        foreach ($weifenzu1 as $key => $value) {
	            $openid = $value['openid'];
	            $userinfo1[] = pdo_fetch("select a.u_name,a.openid,a.u_id,a.u_thumb,b.label from".tablename('hyb_yl_userinfo')."as a left join".tablename('hyb_yl_userlabelarr')."as b on b.openid=a.openid where a.uniacid='{$uniacid}' and a.openid='{$openid}'");
	                foreach ($userinfo1 as $key5 => $value5) {
	                   $openid = $value5['openid'];
	                   $userinfo1[$key]['user'] = pdo_get("hyb_yl_userjiaren",array('openid'=>$openid,'sick_index'=>0));
	                }

	        }
	        $weifenzu2 = pdo_fetchall("SELECT * from".tablename('hyb_yl_wenzorder')."where zid='{$zid}' and uniacid='{$uniacid}' group by openid desc");
	        foreach ($weifenzu2 as $key => $value) {
	            $openid = $value['openid'];
	            $userinfo2[] = pdo_fetch("select a.u_name,a.openid,a.u_id,a.u_thumb,b.label from".tablename('hyb_yl_userinfo')."as a left join".tablename('hyb_yl_userlabelarr')."as b on b.openid=a.openid where a.uniacid='{$uniacid}' and a.openid='{$openid}'");
	                foreach ($userinfo2 as $key4 => $value4) {
	                   $openid = $value4['openid'];
	                   $userinfo2[$key]['user'] = pdo_get("hyb_yl_userjiaren",array('openid'=>$openid,'sick_index'=>0));
	                }
	        }
	        $userinfo3 = array_merge($userinfo1,$userinfo2);
	        $userinfo4 = $this->assoc_unique($userinfo3,'openid');
	        foreach ($userinfo4 as $key3 => $value3) {
	            if(empty($value3['label'])){
	                $fenzuwei[]=$value3;
	            }else{
	                $yifen[]=$value3['label'];
	            }
	        }
	        foreach($fenzuwei as &$vv)
	        {
	        	$vv['label'] = '未分组';
	        }
  		}else{
  			$fenzuwei = pdo_fetchall("select a.*,u.u_name,u.u_thumb from ".tablename("hyb_yl_userlabelarr")." as a left join ".tablename("hyb_yl_userinfo")." as u on u.openid=a.openid where a.uniacid=".$uniacid." and a.zid=".$zid." and label='".$name."' group by a.openid");
  			
  		}
  		
        
        include $this->template('team/users');
  	}

  	// 患者设置分组
  	if($op == 'setuser')
  	{
  		$u_name = $_GPC['u_name'];
  		$zid = $_GPC['zid'];
  		$openid = $_GPC['openid'];
  		$fzid = $_GPC['fzid'];
  		$name = $_GPC['name'];
  		$item = pdo_get("hyb_yl_userlabelarr",array("uniacid"=>$uniacid,"id"=>$fzid));
  		
  		$res = pdo_fetch("SELECT  a.*,b.id,b.ctname,c.agentname,c.hid,d.level_name FROM " . tablename("hyb_yl_zhuanjia") . " as a left join " . tablename("hyb_yl_classgory") . " as b on a.z_room=b.id left join" . tablename('hyb_yl_hospital') . "as c on c.hid=a.hid left join" . tablename('hyb_yl_hospital_level') . "as d on d.id=c.grade where a.zid='{$zid}' and a.uniacid='{$uniacid}' ");

	    $res['authority'] = explode('、', $res['authority']);
	    $authority = $res['authority'];
	    
	    $weifenzu1 = pdo_fetchall("SELECT * from".tablename('hyb_yl_twenorder')."where zid='{$zid}' and uniacid='{$uniacid}' group by openid desc");

	    foreach ($weifenzu1 as $key => $value) {
	        $openid4 = $value['openid'];
	        $userinfo1[] = pdo_fetch("select a.u_name,a.openid,a.u_id,a.u_thumb,b.label from".tablename('hyb_yl_userinfo')."as a left join".tablename('hyb_yl_userlabelarr')."as b on b.openid=a.openid where a.uniacid='{$uniacid}' and a.openid='{$openid4}'");
	            foreach ($userinfo1 as $key5 => $value5) {
	               $openids = $value5['openid'];
	               $userinfo1[$key]['user'] = pdo_get("hyb_yl_userjiaren",array('openid'=>$openids,'sick_index'=>0));
	            }

	    }

	    $weifenzu2 = pdo_fetchall("SELECT * from".tablename('hyb_yl_wenzorder')."where zid='{$zid}' and uniacid='{$uniacid}' group by openid desc");
	    foreach ($weifenzu2 as $key => $value) {
	        $openidss = $value['openid'];
	        $userinfo2[] = pdo_fetch("select a.u_name,a.openid,a.u_id,a.u_thumb,b.label from".tablename('hyb_yl_userinfo')."as a left join".tablename('hyb_yl_userlabelarr')."as b on b.openid=a.openid where a.uniacid='{$uniacid}' and a.openid='{$openidss}'");
	            foreach ($userinfo2 as $key4 => $value4) {
	               $openidss = $value4['openid'];
	               $userinfo2[$key]['user'] = pdo_get("hyb_yl_userjiaren",array('openid'=>$openidss,'sick_index'=>0));
	            }
	    }

	    $userinfo3 = array_merge($userinfo1,$userinfo2);
	    
	    $userinfo4 = $this->assoc_unique($userinfo3,'openid');

	    foreach ($userinfo4 as $key3 => $value3) {
	        if(empty($value3['label'])){
	            $fenzuwei[]=$value3;
	        }else{
	            $yifen[]=$value3['label'];
	        }
	    }

	    foreach ($userinfo4 as $key2 => $value2) {
	        $openid2 =$value2['openid'];
	        $userinfo4[$key2]['label'] = pdo_getcolumn('hyb_yl_userlabelarr',array('openid'=>$openid2,'zid'=>$zid),'label');
	        if(!$userinfo4[$key2]['label']){
	          $userinfo5[] = pdo_get('hyb_yl_userlabelarr',array('openid'=>$openid2,'zid'=>$zid),'label');
	        }
	    }
	   
	    $overbiaoqian =array_filter(array_unique(array_merge($yifen,$authority)));
	    foreach ($overbiaoqian as $key => $value) {
	       
	       $zong = pdo_fetchall("SELECT * from".tablename('hyb_yl_userlabelarr')." where uniacid='{$uniacid}' and zid='{$zid}' and label regexp '{$value}' group by openid ");

	       foreach ($zong as $key2 => $value2) {
	           $openid3 = $value2['openid'];
	           $user[] = pdo_get('hyb_yl_userinfo',array('openid'=>$openid3));
	       }

	       $count[] = count($zong);
	    }

	    foreach ($overbiaoqian as $key => $value) {
	        $newdate[$key]['description']=$overbiaoqian[$key];  
	        $newdate[$key]['count']=$count[$key];
	        if($newdate[$key]['count'] == '')
	        {
	        	$newdate[$key]['count'] = 0;
	        }
	    }
	    if ($_W['ispost']) {
	  		$data = array(
	  			'uniacid' => $uniacid,
	  			"zid" => $_GPC['zid'],
	  			"openid" => $_GPC['openid'],
	  			"label" => $_GPC['name'],

	  		);
	  		
	  		if($fzid)
	  		{
	  			$res = pdo_update("hyb_yl_userlabelarr",$data,array("id"=>$fzid));
	  		}else{
	  			$data['addtime'] = time();
	  			$res = pdo_insert("hyb_yl_userlabelarr",$data);
	  		}
	  		if($res)
		    {
		    	message("设置成功!",$this->createWebUrl("team",array("op"=>"users",'zid'=>$zid,'name'=>$name)),"success");
		    }else{
		    	message("设置失败!",$this->createWebUrl("team",array("op"=>"users",'zid'=>$zid,'name'=>$name)),"error");
		    }
		}
	    include $this->template('team/setuser');
  		
  	}




	if($op == 'adderweima')
	{
		if(is_agent == '1')
		{
			$list = pdo_fetchall("select * from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and zid in (".$zjs.")");
		}else{
			$list = pdo_getall("hyb_yl_zhuanjia",array("uniacid"=>$uniacid));
		}
		
		$result = pdo_fetch('SELECT * FROM ' . tablename('hyb_yl_parameter') . " where `uniacid`='{$uniacid}' ", array(":uniacid" => $uniacid));
        $APPID = $result['appid'];
        $SECRET = $result['appsecret'];
        $base = pdo_getcolumn("hyb_yl_zhuanjia_rule",array("uniacid"=>$uniacid),'background');
        foreach($list as &$value)
		{
			$value['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$value['parentid']),'name');
			$value['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$value['z_zhicheng']),'job_name');
			$value['hospital'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$value['hid']),'agentname');
			
			$labels = $value['keshi']."|".$value['zhicheng'];
			$data = array(
				'hospital' => $value['hospital'],
				'z_name' => $value['z_name'],
				'zid' => $value['zid'],
				"thumb" => tomedia($value['advertisement']),
				'share_erweima' => $value['share_erweima'],
				"erweima" => $value['weweima'],
				"labels" => $labels,
				"shanchan" => "擅长：".$value['authority'],
				"background" => tomedia($base),
				"appid" => $APPID,
				"appsecret" => $SECRET
			);
			$erweima = $thumbs->generate($data);
			$value['erweima'] = $_W['siteroot'].$erweima['erweima'];
			$value['share_erweima'] = $_W['siteroot'].$erweima['share_erweima'];
			pdo_update("hyb_yl_zhuanjia",array("weweima"=>$erweima['erweima'],'share_erweima'=>$erweima['share_erweima']),array('zid'=>$value['zid'],'uniacid'=>$uniacid));
			
		}
		message("生成成功!",$this->createWebUrl("team",array("op"=>"doctor")),"success");
		include $this->template('team/list');
	}
	if($op == 'tixian')
	{
		$zid = $_GPC['zid'];
		$page = empty($_GPC['page']) ? "" : $_GPC['page'];
	  $pageindex = max(1, intval($page));
	  $where = " where uniacid=".$uniacid." and style=1 and cash=1 and zid=".$zid;
	  $status = $_GPC['status'];
	  $start = empty($_GPC['start']) ? date("Y-m-d",strtotime("-1Months",time())) : $_GPC['start']; 
	  $end = empty($_GPC['end']) ? date("Y-m-d",strtotime("+1days",time())) : $_GPC['end'];
	  if($status != '')
	  {
	    $where .= " and status=".$status;
	  }
	  $cash_type = $_GPC['cash_type'];
	  if($cash_type != '')
	  {
	    $where .= " and cash_type=".$cash_type;
	  }

	  if($start != '' && $start != date("Y-m-d",strtotime("-1Months",time())))
	  {
	    $where .= " and created >=".strtotime($start);
	  }
	  if($end != '' && $end != date("Y-m-d",strtotime("+1days",time())))
	  {
	    $where .= " and created <=".strtotime($end);
	  }
	  
	  $pagesize = 10;
	  $list = pdo_fetchall("select * from ".tablename("hyb_yl_pay").$where." order by id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);

	  $count = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_pay").$where);
	  $pager = pagination($total, $pageindex, $pagesize);
	  include $this->template("team/tixian");
	}
	if($op == 'change_exa')
	{
		$zid = $_GPC['zid'];
		$exa = $_GPC['exa'];
		$data['exa'] = $exa;
		if($exa == '1')
		{
			$password = md5('123456789');
			$data['password'] = $password;

		}
		$res = pdo_update("hyb_yl_zhuanjia",$data,array("zid"=>$zid));
		if($res)
		{
			message("审核成功!",$this->createWebUrl("team",array("op"=>"doctor")),"success");
		}else{
			message("审核失败!",$this->createWebUrl("team",array("op"=>"doctor")),"success");
		}
	}
	if($op == 'shouyi')
	{
		$page = empty($_GPC['page']) ? "" : $_GPC['page'];
    	$pageindex = max(1, intval($page));
    	$pagesize = 10;
		$zid = $_GPC['zid'];
		$server_arr = pdo_getall("hyb_yl_doc_all_serverlist",array("zid"=>$zid));
		$arr = array(
			'0' => array(
				'key_words' => 'goods',
				'titlme' => '商品订单',
				),
			'1' => array(
				'key_words' => 'tijian',
				'titlme' => '体检订单',
				),
		);
		$server_arr = array_merge($server_arr,$arr);
		
		$server = $_GPC['server'];
		$keyword = $_GPC['keyword'];
		$keywordtype = $_GPC['keywordtype'];
		$where = " where a.uniacid=".$uniacid." and a.zid=".$zid;
		if($server == 'dianhuajizhen' || $server == 'shipinwenzhen' || $server == 'shoushukuaiyue' || $server == 'tijianjiedu')
		{
			$where .= " and a.keywords like '%$server%'";
		}
		if($keyword != '')
		{
			if($keywordtype == '1')
			{
				$where .= " and b.names like '%$keyword%'";
			}else if($keywordtype == '2')
			{
				$where .= " and b.tel like '%$keyword%'";
			}else if($keywordtype == '3')
			{
				if($server == 'goods')
				{
					$where .= " and a.orderNo like '%$keyword%'";
				}else if($server == 'tijian')
				{
					$where .= " and a.ordernums like '%$keyword%'";
				}else{
					$where .= " and a.back_orser like '%$keyword%'";
				}
			}
		}


		if($server == 'tuwenwenzhen')
		{
			$list = pdo_fetchall("select a.*,b.names,b.tel,c.u_thumb,c.u_id,c.u_name,c.randnum from ".tablename("hyb_yl_twenorder")." as a left join ".tablename("hyb_yl_userjiaren")." as b on a.j_id=b.j_id left join ".tablename("hyb_yl_userinfo")." as c on c.openid=a.openid ".$where." and a.ifpay != 0 and a.ifpay != 6 and a.ifpay != 8 and a.overtime != '0' group by a.back_orser order by a.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
			foreach($list as &$value)
			{
				$value['typs'] = '图文问诊';
				$value['content'] = unserialize($value['content']);
				$value['times'] = date("Y-m-d H:i:s",$value['xdtime']);
				$value['ptmoneys'] = $value['old_money'];
				$servers = pdo_get("hyb_yl_doc_all_serverlist",array("uniacid"=>$uniacid,"key_words"=>'tuwenwenzhen','zid'=>$value['zid']));
			      $value['hymoney'] = $servers['hymoney'];
			    	$count = intval($value['countarr']);
			      $count_money =(float)($value['money']);
			    	$value['count_money'] = ($count*$count_money);

			      $value['xdtime'] =date("Y-m-d H:i:s",$value['xdtime']);
			      $value['paytime'] =date("Y-m-d H:i:s",$value['paytime']);
			      $value['advertisement'] =tomedia($value['advertisement']);
			      $hid = $value['hid'];
			      $z_zhicheng =$value['z_zhicheng']; 
			      $parentid = $value['parentid'];

			      $value['moneyss'] = $value['ptmoneys'] - $value['ptmoney'] - $value['hosmoney'] - $value['tk_one'] - $value['tk_two'] - $value['coupon_dk'] - $value['card_dk'] - $value['year_dk'];
			}
			$total = count($list);
		}else if($server == 'dianhuajizhen' || $server == 'shipinwenzhen' || $server == 'shoushukuaiyue' || $server == 'tijianjiedu')
		{
			$list = pdo_fetchall("select a.*,b.names,b.tel,c.u_thumb,c.u_id,c.u_name,c.randnum from ".tablename("hyb_yl_wenzorder")." as a left join ".tablename("hyb_yl_userjiaren")." as b on a.j_id=b.j_id left join ".tablename("hyb_yl_userinfo")." as c on c.openid=a.openid ".$where." and a.ifpay != 0 and a.ifpay != 6 and a.ifpay != 8 group by a.back_orser order by a.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
			
			foreach($list as &$wz)
			{
				if($wz['keywords'] == 'dianhuajizhen')
				{
					$wz['typs'] = '电话问诊';
				}else if($wz['keywords'] == 'shipinwenzhen')
				{
					$wz['typs'] = '视频问诊';
				}else if($wz['keywords'] == 'shoushukuaiyue')
				{
					$wz['typs'] = '手术快约';
				}else if($wz['keywords'] == 'tijianjiedu')
				{
					$wz['typs'] = '体检解读';
				}
				$wz['content'] = unserialize($wz['describe']);
				$wz['times'] = date("Y-m-d H:i:s",$wz['time']);
				$servers = pdo_get("hyb_yl_doc_all_serverlist",array("uniacid"=>$uniacid,"key_words"=>'tuwenwenzhen','zid'=>$wz['zid']));
      			
		      $wz['ptmoneys'] = $wz['old_money'];
		      $wz['hymoney'] = $servers['hymoney'];
		    	$count = intval($wz['countarr']);
		      $count_money =(float)($wz['money']);
		    	$wz['count_money'] = ($count*$count_money);

		      $wz['xdtime'] =date("Y-m-d H:i:s",$wz['xdtime']);
		      $wz['paytime'] =date("Y-m-d H:i:s",$wz['paytime']);
		      $wz['advertisement'] =tomedia($wz['advertisement']);
		      $hid = $wz['hid'];
		      $z_zhicheng =$wz['z_zhicheng']; 
		      $parentid = $wz['parentid'];

		      $wz['moneyss'] = $wz['ptmoneys'] - $wz['ptmoney'] - $wz['hosmoney'] - $wz['tk_one'] - $wz['tk_two'] - $wz['coupon_dk'] - $wz['card_dk'] - $wz['year_dk'];
			}
			
			$total = count($list);
		}else if($server == 'yuanchengguahao')
		{
			$list = pdo_fetchall("select a.*,b.names,b.tel,c.u_thumb,c.u_id,c.u_name,c.randnum from ".tablename("hyb_yl_guahaoorder")." as a left join ".tablename("hyb_yl_userjiaren")." as b on a.j_id=b.j_id left join ".tablename("hyb_yl_userinfo")." as c on c.openid=a.openid ".$where." and a.ifpay != 0 and a.ifpay != 6 and a.ifpay != 8 group by a.back_orser order by a.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
			foreach($list as &$gh)
			{
				$gh['typs'] = '在线挂号';
				$gh['content'] = unserialize($gh['describe']);
				$gh['times'] = date("Y-m-d H:i:s",$gh['time']);
				$gh['ptmoneys'] = $gh['old_money'];
				$gh['moneyss'] = $gh['ptmoneys'] - $gh['ptmoney'] - $gh['hosmoney'] - $gh['tk_one'] - $gh['tk_two'] - $gh['coupon_dk'] - $gh['card_dk'];
				$gh['tk'] = pdo_fetchcolumn("select b.username from ".tablename("hyb_yl_tuikesite")." as a  left join ".tablename("hyb_yl_tuikesite")." as b on b.tkid=a.id where a.uniacid=".$uniacid." and a.openid='".$gh['openid']."'");
			}
			$total = count($list);
		}else if($server == 'yuanchengkaifang')
		{
			$list = pdo_fetchall("select a.*,b.names,b.tel,c.u_thumb,c.u_id,c.u_name,c.randnum from ".tablename("hyb_yl_chufang")." as a left join ".tablename("hyb_yl_userjiaren")." as b on a.j_id=b.j_id left join ".tablename("hyb_yl_userinfo")." as c on c.openid=a.useropenid ".$where." and a.ispay != 0 and a.ispay != 6 and a.ispay != 8 group by a.back_orser order by a.c_id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
			foreach($list as &$cf)
			{
				$cf['typs'] = '在线开方';
				$cf['content'] = unserialize($cf['content']);
				$cf['times'] = date("Y-m-d H:i:s",$cf['time']);
				$back_orser = $cf['orders'];
				$cf['yaoshimoney'] = pdo_getcolumn("hyb_yl_pay",array("uniacid"=>$uniacid,'back_orser'=>$back_orser,"style"=>'6'),'money');
				
				$cf['ptmoney'] = pdo_getcolumn("hyb_yl_pay",array("uniacid"=>$uniacid,"back_orser"=>$back_orser,'style'=>'8'),'money');
				$cf['tkmoney'] = pdo_fetchcolumn("SELECT SUM(money) FROM".tablename('hyb_yl_tuikeshouyi')."where uniacid='{$uniacid}' and orders='{$back_orser}'");
			}
			$total = count($list);
		}else if($server == 'goods')
		{
			$list = pdo_fetchall("select a.*,b.names,b.tel,c.u_thumb,c.u_id,c.u_name,c.randnum from ".tablename("hyb_yl_goodsorders")." as a left join ".tablename("hyb_yl_userjiaren")." as b on a.j_id=b.j_id left join ".tablename("hyb_yl_userinfo")." as c on c.openid=a.openid ".$where." and a.isPay=1 order by a.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
			foreach($list as &$good)
			{
				$good['content'] = unserialize($good['conets']);
				$good['typs'] = '商品订单';
				$good['times'] = $good['createTime'];
				$good['money'] = $good['totalMoney'];
				$good['back_orser'] = $good['orderNo'];
				$orders = $good['orderNo'];
				$goods = unserialize($value['sid']);
		        $good['tkmoney'] = pdo_fetchcolumn("SELECT SUM(money) FROM".tablename('hyb_yl_tuikeshouyi')."where uniacid='{$uniacid}' and orders='{$orders}'");
		        foreach ($goods as $k => $v) {
		            $v['u_tel'] = pdo_getcolumn("hyb_yl_user_address",array("openid"=>$good['openid']),'userPhone');
		            $v['time'] = date("Y-m-d H:i:s",$good['time']);
		        }
		        $good['goods'] = $goods;
		        $good['moneys'] = $good['realTotalMoney'] - $good['ptmoney'] - $good['docmoney']- $good['tkmoney'] - $good['ysmoney'];
			}

			$total = count($list);
		}else if($server == 'tijian')
		{
			$list = pdo_fetchall("select a.*,b.names,b.tel,c.u_thumb,c.u_id,c.u_name,c.randnum from ".tablename("hyb_yl_tijianorder")." as a left join ".tablename("hyb_yl_userjiaren")." as b on a.j_id=b.j_id left join ".tablename("hyb_yl_userinfo")." as c on c.openid=a.openid ".$where." and a.ifpay != 0 and a.ifpay != 6 and a.ifpay != 8 group by a.ordernums order by a.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
			foreach($list as &$tj)
			{
				$tj['content'] = unserialize($tj['content']);
				$tj['typs'] = '体检订单';
				$tj['times'] = date("Y-m-d H:i:s",$tj['time']);
				$tj['back_orser'] = $tj['ordernums'];
				$tj['moneys'] = $tj['money'] - $tj['tk_one'] - $tj['tk_two'] - $tj['ptmoney'];
			}
			$total = count($list);
		}else{
			$tuwen = pdo_fetchall("select a.*,b.names,b.tel,c.u_thumb,c.u_id,c.u_name,c.randnum from ".tablename("hyb_yl_twenorder")." as a left join ".tablename("hyb_yl_userjiaren")." as b on a.j_id=b.j_id left join ".tablename("hyb_yl_userinfo")." as c on c.openid=a.openid ".$where." and a.ifpay != 0 and a.ifpay != 6 and a.ifpay != 8 and a.overtime != '0' group by a.back_orser order by a.xdtime desc");
			foreach($tuwen as &$value)
			{
				$value['typs'] = '图文问诊';
				$value['content'] = unserialize($value['content']);
				$value['times'] = date("Y-m-d H:i:s",$value['xdtime']);
				$servers = pdo_get("hyb_yl_doc_all_serverlist",array("uniacid"=>$uniacid,"key_words"=>'tuwenwenzhen','zid'=>$value['zid']));
				$value['ptmoneys'] = $value['old_money'];
			      $value['hymoney'] = $servers['hymoney'];
			    	$count = intval($value['countarr']);
			      $count_money =(float)($value['money']);
			    	$value['count_money'] = ($count*$count_money);

			      $value['xdtime'] =date("Y-m-d H:i:s",$value['xdtime']);
			      $value['paytime'] =date("Y-m-d H:i:s",$value['paytime']);
			      $value['advertisement'] =tomedia($value['advertisement']);
			      $hid = $value['hid'];
			      $z_zhicheng =$value['z_zhicheng']; 
			      $parentid = $value['parentid'];

			      $value['moneyss'] = $value['ptmoneys'] - $value['ptmoney'] - $value['hosmoney'] - $value['tk_one'] - $value['tk_two'] - $value['coupon_dk'] - $value['card_dk'] - $value['year_dk'];
			}
			
			$wenzhen = pdo_fetchall("select a.*,b.names,b.tel,c.u_thumb,c.u_id,c.u_name,c.randnum from ".tablename("hyb_yl_wenzorder")." as a left join ".tablename("hyb_yl_userjiaren")." as b on a.j_id=b.j_id left join ".tablename("hyb_yl_userinfo")." as c on c.openid=a.openid ".$where." and a.ifpay != 0 and a.ifpay != 6 and a.ifpay != 8 group by a.back_orser order by a.time desc");
			foreach($wenzhen as &$wz)
			{
				if($wz['keywords'] == 'dianhuajizhen')
				{
					$wz['typs'] = '电话问诊';
				}else if($wz['keywords'] == 'shipinwenzhen')
				{
					$wz['typs'] = '视频问诊';
				}else if($wz['keywords'] == 'shoushukuaiyue')
				{
					$wz['typs'] = '手术快约';
				}else if($wz['keywords'] == 'tijianjiedu')
				{
					$wz['typs'] = '体检解读';
				}
				$wz['content'] = unserialize($wz['describe']);
				$wz['times'] = date("Y-m-d H:i:s",$wz['time']);
				$servers = pdo_get("hyb_yl_doc_all_serverlist",array("uniacid"=>$uniacid,"key_words"=>'tuwenwenzhen','zid'=>$wz['zid']));
      
		      $wz['ptmoneys'] = $wz['old_money'];
		      $wz['hymoney'] = $servers['hymoney'];
		    	$count = intval($wz['countarr']);
		      $count_money =(float)($wz['money']);
		    	$wz['count_money'] = ($count*$count_money);

		      $wz['xdtime'] =date("Y-m-d H:i:s",$wz['xdtime']);
		      $wz['paytime'] =date("Y-m-d H:i:s",$wz['paytime']);
		      $wz['advertisement'] =tomedia($wz['advertisement']);
		      $hid = $wz['hid'];
		      $z_zhicheng =$wz['z_zhicheng']; 
		      $parentid = $wz['parentid'];

		      $wz['moneyss'] = $wz['ptmoneys'] - $wz['ptmoney'] - $wz['hosmoney'] - $wz['tk_one'] - $wz['tk_two'] - $wz['coupon_dk'] - $wz['card_dk'] - $wz['year_dk'];
			}

			
			$goods = pdo_fetchall("select a.*,b.names,b.tel,c.u_thumb,c.u_id,c.u_name,c.randnum from ".tablename("hyb_yl_goodsorders")." as a left join ".tablename("hyb_yl_userjiaren")." as b on a.j_id=b.j_id left join ".tablename("hyb_yl_userinfo")." as c on c.openid=a.openid ".$where." and a.isPay=1 order by a.createTime");
			foreach($goods as &$good)
			{
				$good['content'] = unserialize($good['conets']);
				$good['typs'] = '商品订单';
				$good['times'] = $good['createTime'];
				$good['money'] = $good['totalMoney'];
				$good['back_orser'] = $good['orderNo'];
				$orders = $good['orderNo'];
				$goodss = unserialize($value['sid']);
		        $good['tkmoney'] = pdo_fetchcolumn("SELECT SUM(money) FROM".tablename('hyb_yl_tuikeshouyi')."where uniacid='{$uniacid}' and orders='{$orders}'");
		        foreach ($goods as $k => $v) {
		            $v['u_tel'] = pdo_getcolumn("hyb_yl_user_address",array("openid"=>$good['openid']),'userPhone');
		            $v['time'] = date("Y-m-d H:i:s",$good['time']);
		        }
		        $good['goods'] = $goodss;
		        $good['moneys'] = $good['realTotalMoney'] - $good['ptmoney'] - $good['docmoney']- $good['tkmoney'] - $good['ysmoney'];
			}

			$chufang = pdo_fetchall("select a.*,b.names,b.tel,c.u_thumb,c.u_id,c.u_name,c.randnum from ".tablename("hyb_yl_chufang")." as a left join ".tablename("hyb_yl_userjiaren")." as b on a.j_id=b.j_id left join ".tablename("hyb_yl_userinfo")." as c on c.openid=a.useropenid ".$where." and a.ispay != 0 and a.ispay != 6 and a.ispay != 8 group by a.back_orser order by a.time desc");
			foreach($chufang as &$cf)
			{
				$cf['typs'] = '在线开方';
				$cf['content'] = unserialize($cf['content']);
				$cf['times'] = date("Y-m-d H:i:s",$cf['time']);

				$back_orser = $cf['orders'];
				$cf['yaoshimoney'] = pdo_getcolumn("hyb_yl_pay",array("uniacid"=>$uniacid,'back_orser'=>$back_orser,"style"=>'6'),'money');
				
				$cf['ptmoney'] = pdo_getcolumn("hyb_yl_pay",array("uniacid"=>$uniacid,"back_orser"=>$back_orser,'style'=>'8'),'money');
				$cf['tkmoney'] = pdo_fetchcolumn("SELECT SUM(money) FROM".tablename('hyb_yl_tuikeshouyi')."where uniacid='{$uniacid}' and orders='{$back_orser}'");
			}

			$guahao = pdo_fetchall("select a.*,b.names,b.tel,c.u_thumb,c.u_id,c.u_name,c.randnum from ".tablename("hyb_yl_guahaoorder")." as a left join ".tablename("hyb_yl_userjiaren")." as b on a.j_id=b.j_id left join ".tablename("hyb_yl_userinfo")." as c on c.openid=a.openid ".$where." and a.ifpay != 0 and a.ifpay != 6 and a.ifpay != 8 group by a.back_orser order by a.time desc");
			foreach($guahao as &$gh)
			{
				$gh['typs'] = '在线挂号';
				$gh['content'] = unserialize($gh['describe']);
				$gh['times'] = date("Y-m-d H:i:s",$gh['time']);
				$gh['ptmoneys'] = $gh['old_money'];
				$gh['moneyss'] = $gh['ptmoneys'] - $gh['ptmoney'] - $gh['hosmoney'] - $gh['tk_one'] - $gh['tk_two'] - $gh['coupon_dk'] - $gh['card_dk'];
				$gh['tk'] = pdo_fetchcolumn("select b.username from ".tablename("hyb_yl_tuikesite")." as a  left join ".tablename("hyb_yl_tuikesite")." as b on b.tkid=a.id where a.uniacid=".$uniacid." and a.openid='".$gh['openid']."'");
			}

			$tijian = pdo_fetchall("select a.*,b.names,b.tel,c.u_thumb,c.u_id,c.u_name,c.randnum from ".tablename("hyb_yl_tijianorder")." as a left join ".tablename("hyb_yl_userjiaren")." as b on a.j_id=b.j_id left join ".tablename("hyb_yl_userinfo")." as c on c.openid=a.openid ".$where." and a.ifpay != 0 and a.ifpay != 6 and a.ifpay != 8 group by a.ordernums order by a.time desc");
			foreach($tijian as &$tj)
			{
				$tj['content'] = unserialize($tj['content']);
				$tj['typs'] = '体检订单';
				$tj['times'] = date("Y-m-d H:i:s",$tj['time']);
				$tj['back_orser'] = $tj['ordernums'];
				$tj['moneys'] = $tj['money'] - $tj['tk_one'] - $tj['tk_two'] - $tj['ptmoney'];
			}

			$list = array_merge($tuwen,$tijian,$guahao,$chufang,$goods,$wenzhen);
			
			$total = count($list);

			$list = array_slice($list,($pageindex - 1) * $pagesize,$pagesize);
			
		}
		$pager = pagination($total, $pageindex, $pagesize);

		include $this->template("team/order");
	}
	
   if($op =='ajax'){
     if($_W['isajax']){
     	if($_GPC['type'] =='all'){
	       $id = $_GPC['id'];
	       $res =  pdo_getall("hyb_yl_ceshi",array('giftstatus'=>$id,'uniacid'=>$uniacid));
	       echo json_encode($res);
	       return false;
     	}
        if($_GPC['type'] =='detail'){
	       $id = $_GPC['id'];
	       $res =  pdo_get("hyb_yl_ceshi",array('id'=>$id),array('description'));
	       $res['description'] = explode('、', $res['description']);
	       echo json_encode($res);
	       return false;
        }
        //机构
     	if($_GPC['type'] =='jgall'){
	       $id = $_GPC['id'];
	       $res =  pdo_getall("hyb_yl_hospital",array('groupid'=>$id,'uniacid'=>$uniacid));
	       echo json_encode($res);
	       return false;
     	}
     }
   }
	if($op =='edit'){
		$zid = $_GPC['zid'];
		$res= pdo_fetch("SELECT a.*,b.u_name FROM".tablename('hyb_yl_zhuanjia')."as a left join".tablename('hyb_yl_userinfo')."as b on b.openid =a.openid where a.uniacid='{$uniacid}' and a.zid ='{$zid}'");
		$res['groupid'] = explode(",",$res['groupid']);
		$groups = array('在线专家','审核专家','词条专家');
		$res_sc =explode('、', $res['authority']) ;
		$res_jingxuan =explode(',', $res['jingxuan']);
		$add = explode("-",$res['address']);
		$res['province'] = $add[0];
		$res['city'] = $add[1];
		$res['district'] = $add[2];
		$jobtime = pdo_getall("hyb_yl_docjobtime",array("uniacid"=>$uniacid,"style"=>'0'));
		$jobtimes = pdo_getall("hyb_yl_docjobtime",array("uniacid"=>$uniacid,"style"=>'1'));
    $jingxuan = pdo_getall("hyb_yl_zhuanjia_select",array('uniacid'=>$uniacid));

		$job_list = pdo_getall("hyb_yl_zhuanjia_job",array('uniacid'=>$uniacid,'type'=>'1'));
		//科室
		$ks_list = pdo_getall("hyb_yl_classgory",array('uniacid'=>$uniacid,'typeint'=>'0'));
		$ks_two = pdo_getall("hyb_yl_ceshi",array("giftstatus"=>$res['z_room'],'uniacid'=>$uniacid));
		
		//权限列表
		$athuo_list = pdo_getall("hyb_yl_hospital_diction",array('uniacid'=>$uniacid));
		if (empty($res)) {
			$quanxian2 = pdo_getall("hyb_yl_hospital",array('pid'=>$res['hid'],'uniacid'=>$uniacid));
		}else{
			//查询所属机构
			$quanxian2 = pdo_getall("hyb_yl_hospital",array('groupid'=>$res['qx_id'],'uniacid'=>$uniacid));
		}
		

		$authority = implode('、', $_GPC['authority']);
		$address = $_GPC['address']['province'].'-'.$_GPC['address']['city'].'-'.$_GPC['address']['district'];
		//服务列表

		$fw_list = pdo_fetchall("SELECT a.*,b.title,b.id as bid,b.time_leng,b.money FROM".tablename("hyb_yl_docser_speck")."as a left join".tablename('hyb_yl_docserver_type')."as b on b.typeid=a.id where a.uniacid ='{$uniacid}'");
		

		$rwo = pdo_fetch("select count(*) as count from".tablename("hyb_yl_doc_all_serverlist")."where uniacid='{$uniacid}' and zid ='{$zid}'");

		//查专家开通的服务包
		$list_fuwu = pdo_fetchall("SELECT * from".tablename('hyb_yl_doc_all_serverlist')."where uniacid='{$uniacid}' and zid ='{$zid}'");
		$val2 = array_merge($list_fuwu,$fw_list);

		$newArr2 = array();
		foreach($val2 as $v) {
		  if(! isset($newArr2[$v['key_words']])){
		  	$newArr2[$v['key_words']] = $v;
		  }  
		  else{
		  	$newArr2[$v['key_words']]["url"] .=  $v["url"];
		  	$newArr2[$v['key_words']]["bmoney"] .=  $v["money"];
		  	$newArr2[$v['key_words']]["time_lengs"] .=  $v["time_leng"];
		  } 
		  
		}
		$data_list2 = !$list_fuwu?$fw_list:$newArr2;
        $jx_name = $_GPC['jingxuan'];
	    $data =array(
          'uniacid' => $_W['uniacid'],
          'openid'  =>$_GPC['openid'],
          'z_name'  =>$_GPC['z_name'],
          'sord'    =>$_GPC['sord'],
          'score'   =>$_GPC['register']['score'],
          'lng'     =>$_GPC['register']['location']['lng'],
          'lat'     =>$_GPC['register']['location']['lat'],
          'z_sex'    =>$_GPC['z_sex'],
          'sfzbianhao'     =>$_GPC['sfzbianhao'],
          'advertisement'  =>$_GPC['advertisement'],
          'z_telephone'    =>$_GPC['z_telephone'],
          'z_zhicheng'     =>$_GPC['z_zhicheng'],
          'address'        =>$address,
		  'z_room'        =>$_GPC['z_room'],
		  'parentid' =>$_GPC['parentid'],
		  'authority'=>$authority,
		  'username' =>$_GPC['username'],
		  'password' =>MD5($_GPC['password']),
		  'groupid'  =>implode(",",$_GPC['groupid']),
		  'gzstype'  =>$_GPC['gzstype'],
		  'qx_id'    =>$_GPC['qx_id'],
		  'hid'      =>$_GPC['hid'],
		  'listshow' =>$_GPC['listshow'],
		  'exa'      =>$_GPC['exa'],
		  'endtime'  =>$_GPC['endtime'],
		  'sfzimgurl1back' =>$_GPC['sfzimgurl1back'],
		  'sfzimgurl2back' =>$_GPC['sfzimgurl2back'],
		  'xn_reoly' =>$_GPC['xn_reoly'],
		  'xn_cf'    =>$_GPC['xn_cf'],
		  'xytime'   =>$_GPC['xytime'],
		  'zgzimgurl1back' =>$_GPC['zgzimgurl1back'],
		  'z_content' =>$_GPC['z_content'],
		  'plugin'    =>serialize($_GPC['plugin']),
          'opentime'  =>strtotime("now"),
          "is_green" => $_GPC['is_green'],
          "is_examine" => $_GPC['is_examine'],
          "is_urgent" =>$_GPC['is_urgent'],
          "video" => $_GPC['video'],
          "video_thumb" => $_GPC['video_thumb'],
          "jingxuan" =>implode(',', $jx_name),
          "jobtime" => $_GPC['jobtime'],
          "cut" => $_GPC['cut'],
          "register_jobtime" => $_GPC['register_jobtime'],
          "ky_cut" => $_GPC['ky_cut']
	    	);
	   
	    if($_W['ispost']){
	    	$is_bangding = pdo_get("hyb_yl_zhuanjia",array("uniacid"=>$uniacid,"openid"=>$data['openid']));
	    	if($data['openid'] == '')
	    	{
	    		message("请绑定专家微信!",$this->createWebUrl("team",array("op"=>"doctor",'zid'=>$zid)),"error");
	    	}else if($is_bangding && $data['openid'] != $res['openid']){
				message("该用户已被其他专家绑定，请选择其他用户!",$this->createWebUrl("team",array("op"=>"doctor",'zid'=>$zid)),"error");
	    	}
	   
	    	if(!empty($zid)){
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
                $ids_b    = $result3[$i]['ids'];
                $money = $result3[$i]['money'];

		        //服务到期时间
			     $time_b = date("Y-m-d H:i:s",strtotime("+".$time_leng_b." day"));
			     $over_time = strtotime($time_b);
		        $base_one = pdo_get('hyb_yl_parameter', array('uniacid' => $_W['uniacid']));
		        $mch_id = $base_one['mch_id'];
		        $out_trade_no = $mch_id . time();
                $data2 =array(
                     'ids'       => $ids_b,
                     'uniacid'   => $_W['uniacid'],
                     'key_words' => $key_words_b,
                     'bid'       => $bid_b,
                     'titlme'    => $titlme_b,
                     'time_leng' => $time_leng_b,
                     'ptmoney'   => $ptmoney_b,
                     'ptzhuiw'   => $ptzhuiw_b,
                     'hymoney'   => $hymoney_b,
                     'hyzhuiw'   => $hyzhuiw_b,
                     'zid'       => $zid,
                     'stateback' => $stateback_b,
                     'money'     => $money,
                    );
                $data3 =array(
                     'uniacid'   => $_W['uniacid'],
                     'key_words' => $key_words_b,
                     'bid'       => $bid_b,
                     'titlme'    => $titlme_b,
                     'time'      => date('Y-m-d H:i:s'),
                     'time_leng' => $time_leng_b,
                     'ptmoney'   => $ptmoney_b,
                     'ptzhuiw'   => $ptzhuiw_b,
                     'hymoney'   => $hymoney_b,
                     'hyzhuiw'   => $hyzhuiw_b,
                     'zid'       => $zid,
                     'stateback' => $stateback_b,
                     'money'     => $money,
                     'overtime'  => $over_time,
                     'orders'    => $out_trade_no
                    );
                if($ids_b ==''){
                  	pdo_insert("hyb_yl_doc_all_serverlist",$data3);
                  	
                }
                  pdo_update('hyb_yl_doc_all_serverlist',$data2,array('ids'=>$ids_b));
              }
             
	          pdo_update('hyb_yl_zhuanjia',$data,array('zid'=>$zid));
	          message("修改成功!",$this->createWebUrl("team",array("op"=>"doctor",'zid'=>$zid)),"success");
	    	}else{
	    	  pdo_insert('hyb_yl_zhuanjia',$data);
	    	  $zid = pdo_insertid();
          //     $result = pdo_fetch('SELECT * FROM ' . tablename('hyb_yl_parameter') . " where `uniacid`='{$uniacid}' ", array(":uniacid" => $uniacid));
		        // $APPID = $result['appid'];
		        // $SECRET = $result['appsecret'];
		        
		        // $keshi = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$data['parentid']),'name');
		        // $zhicheng = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$data['z_zhicheng']),'job_name');
		        // $hospital = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$data['hid']),'agentname');
		        // $base = pdo_getcolumn("hyb_yl_zhuanjia_rule",array("uniacid"=>$uniacid),'background');
		        // $labels = $keshi."|".$zhicheng;
		        // $datas = array(
		        //   'hospital' => $hospital,
		        //   'z_name' => $data['z_name'],
		        //   'zid' => $zid,
		        //   "thumb" => tomedia($data['advertisement']),
		        //   'share_erweima' => '',
		        //   "labels" => $labels,
		        //   "shanchan" => "擅长：".$data['authority'],
		        //   "background" => tomedia($base),
		        //   "appid" => $APPID,
		        //   "appsecret" => $SECRET
		        // );
		        // $erweima = $thumbs->generate($datas);
		        
		        // pdo_update("hyb_yl_zhuanjia",array("weweima"=>$erweima['erweima'],'share_erweima'=>$erweima['share_erweima']),array('zid'=>$zid,'uniacid'=>$uniacid));
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
                $money_b   = $result3[$i]['money'];

		        //服务到期时间
			     $time_b = date("Y-m-d H:i:s",strtotime("+".$time_leng_b." day"));
			     $over_time = strtotime($time_b);
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
                     'zid'       => $zid,
                     'stateback' => $stateback_b,
                     'money'     => $money,
                     'overtime' => $over_time
                    );
               pdo_insert('hyb_yl_doc_all_serverlist',$data2);
            }
	    	  message("添加成功!",$this->createWebUrl("team",array("op"=>"doctor")),"success");
	    	}
	    }
        
       include $this->template('team/add');
	}
	if($op =='del'){
		$zid=intval($_GPC['zid']); 
		$res=$doctor->delete("zid=$zid and uniacid=$uniacid ");
		pdo_delete("hyb_yl_doc_all_serverlist",array("zid"=>$zid));
		pdo_delete("hyb_yl_goodsorders",array("zid"=>$zid,"uniacid"=>$uniacid));
		pdo_delete("hyb_yl_guahaoorder",array("zid"=>$zid,"uniacid"=>$uniacid));
		pdo_delete("hyb_yl_pay",array("zid"=>$zid,"uniacid"=>$uniacid));
		pdo_delete("hyb_yl_attention",array("goods_id"=>$zid,"uniacid"=>$uniacid,"cerated_type"=>'0'));
		pdo_delete("hyb_yl_tijianorder",array("uniacid"=>$uniacid,"zid"=>$zid));
		pdo_delete("hyb_yl_twenorder",array("uniacid"=>$uniacid,"zid"=>$zid));
		pdo_delete("hyb_yl_visit",array("zid"=>$zid,"uniacid"=>$uniacid));
		pdo_delete("hyb_yl_wenzorder",array("zid"=>$zid,"uniacid"=>$uniacid));
		pdo_delete("hyb_yl_yearcard",array("zid"=>$zid,"uniacid"=>$uniacid));
		pdo_delete("hyb_yl_docjobtime",array("zid"=>$zid,"uniacid"=>$uniacid));
		message("删除成功!",$this->createWebUrl("team",array("op"=>"doctor")),"success");
	}
	if($op =='doctor_room'){

        if($_W['isajax']){
			//团队负责人
		     $model = Model('zhuanjia');
		     $tab1  = $model->tablename("zhuanjia");
		     $tab2  = $model->tablename("hospital");
		     $tab3  = Model('base');
		     $tab4  = $model->tablename("category");
	         $sql="SELECT DISTINCT $tab1.uid,$tab1.*,$tab2.uid,$tab2.grade,$tab2.hospital,$tab4.id,$tab4.parentid AS pid,$tab4.name FROM $tab1 LEFT JOIN $tab4 ON $tab1.z_room=$tab4.id LEFT JOIN $tab2 ON $tab1.uid=$tab2.uid  WHERE $tab1.uniacid='".$uniacid."' and find_in_set('8', $tab1.sid) order by $tab1.sord";
	         $teamlist = pdo_fetchall($sql);
		     foreach ($teamlist as $key => $value) {
		      $money = unserialize($teamlist[$key]['money']);
		      if(array_key_exists($zhuan_key,$money)){
		           $teamlist[$key]['newmoney'][$zhuan_key]=$money[$zhuan_key]; 
		       }
		       $teamlist[$key]['z_thumbs'] =$_W['attachurl'].$teamlist[$key]['z_thumbs'];
		     }
		     //专家工作室
			$type = !empty($_GPC['type']) ? $_GPC['type'] : '0';
			if($type=='0'){
				$zid = $teamlist['0']['zid'];
				$total = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename("hyb_yl_zhuanjteam")."as a LEFT JOIN".tablename("hyb_yl_zhuanjia")."as b on b.zid=a.zid where a.uniacid='{$uniacid}' and a.zid='{$zid}'");
				$pindex = max(1, intval($_GPC['page'])); 
				$pagesize = 10;
				$p = ($pindex-1) * $pagesize; 
				$res = pdo_fetchall("SELECT * FROM".tablename("hyb_yl_zhuanjteam")."as a LEFT JOIN".tablename("hyb_yl_zhuanjia")."as b on b.zid=a.zid where a.uniacid='{$uniacid}' and a.zid='{$zid}'");
		        $pager = pagination($total,$pindex,$pagesize);
		        foreach ($res as $key => $value) {
		        	$res[$key]['teampic'] = $_W['attachurl'].$res[$key]['teampic'];
		        	$res[$key]['cltime'] = date("Y-m-d",$res[$key]['cltime']);
		        }
		        $data =array(
                   'doctor'=>$teamlist,
                   'room'  =>$res
		        	);
		        echo json_encode($data);
	            return false;
			}else{
				$zid = $_GPC['zid'];
				$total = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename("hyb_yl_zhuanjteam")."as a LEFT JOIN".tablename("hyb_yl_zhuanjia")."as b on b.zid=a.zid where a.uniacid='{$uniacid}' and a.zid='{$zid}'");
				$pindex = max(1, intval($_GPC['page'])); 
				$pagesize = 10;
				$p = ($pindex-1) * $pagesize; 
				$res = pdo_fetchall("SELECT * FROM".tablename("hyb_yl_zhuanjteam")."as a LEFT JOIN".tablename("hyb_yl_zhuanjia")."as b on b.zid=a.zid where a.uniacid='{$uniacid}' and a.zid='{$zid}'");
		        $pager = pagination($total,$pindex,$pagesize);
		        foreach ($res as $key => $value) {
		        	$res[$key]['teampic'] = $_W['attachurl'].$res[$key]['teampic'];
		        	$res[$key]['cltime'] = date("Y-m-d",$res[$key]['cltime']);
		        }
		        $data =array(
                   'doctor'=>$teamlist,
                   'room'  =>$res
		        	);
		        echo json_encode($data);
	            return false;
			}

        }
        include $this->template('team/doctor_room');
	}
	//专家服务
	if($op == "server"){
	   $ser= new Model('docserver');
	   $servicemenu = new Model('servicemenu');
       $zid =intval($_GPC['zid']); 
       $sid =intval($_GPC['sid']);
       //查询是否存在一条安装记录
       $res = $ser->where("uniacid='".$uniacid."'and zid ='".$zid."'")->getall();
       $list_all = $servicemenu->getall();
	   $val = array_merge($res,$list_all);
       $newdata = [];
       foreach($val as $k=>$v){
        if(!isset($newdata[$v['sid']])){
            $newdata[$v['sid']]=$v;
        }else{
            $newdata[$v['sid']]['state']+=$v['state'];
          }
        }
        //二维数组重新排序根据sid
        $last_names = array_column($newdata,'sid');
		array_multisort($last_names,SORT_DESC,$newdata);
		$o = '';
			foreach ($newdata AS $key => $parent) {
				$sid = explode(',',  $parent['sid']);
		        if($parent['state']==1){
		           $button ="<button class=\"js-delete btn btn-danger btn-sm jiaanniu\" data-index=".$key." data-id=".$parent['serid'].">关闭</button>";
		        }else{
		           $button ="<button class=\"js-delete btn btn-success btn-sm jiaanniu\" data-index=".$key."   data-sid=".$parent['sid']." data-name=".$parent['name']." data-zid=".$zid."  data-thumb=".$parent['thumb']." data-desc=".$parent['desc']." data-id=".$parent['serid'].">开启</button>";
		        }
				$o.= "<div style=\"position: relative;\" class=\"col-md-3\" data-index=".$key."> ";
				$o.= "<div class=\"quan1\">";
				$o.= "<div class=\"quan1_top\">";
				$o.= "<div class=\"quan1_top_t\">";
				$o.= "<div class=\"quan1_img\">";
				$o.= "<img src=".$_W['attachurl'].$parent['thumb'].">";
				$o.= "</div>";
				$o.= "<div class=\"quan1_text\">";
				$o.= "<p>".$parent['name']."</p>";
				$o.= "".$html."";
				$o.= "<p><span style=\"color:#35a7ba;\"></span>".$parent['desc']."</p>";
				$o.= "<p class=\"quan1_top_b\">";
				$o.= "</p>";
				$o.= "</div>";
				$o.= "<div class=\"quan1_btn\">";
				$o.= "".$button."";
				$o.= "</div>";
				$o.= "</div>";
				$o.= "</div>";
				$o.= "</div>";
				$o.= "</div>";
			}
		if($_W['isajax']){
			if($_GPC['type'] =='update_xz'){
	           $serid = intval($_GPC['serid']);
	           $data =array(
	              'state' => 0
	           	);
	           pdo_update('hyb_yl_docserver',$data,array('uniacid'=>$uniacid,'serid'=>$serid));
		       $res = $ser->where("uniacid='".$uniacid."'and zid ='".$zid."'")->getall();
		       $list_all = $servicemenu->getall();
			   $val = array_merge($res,$list_all);
		       $newdata = [];
		       foreach($val as $k=>$v){
		        if(!isset($newdata[$v['sid']])){
		            $newdata[$v['sid']]=$v;
		        }else{
		            $newdata[$v['sid']]['state']+=$v['state'];
		          }
		        }
			}
			if($_GPC['type'] =='update_an'){
	           $serid = intval($_GPC['serid']);
	           $data =array(
	              'state' => 1
	           	);
	           pdo_update('hyb_yl_docserver',$data,array('uniacid'=>$uniacid,'serid'=>$serid));
		       $res = $ser->where("uniacid='".$uniacid."'and zid ='".$zid."'")->getall();
		       $list_all = $servicemenu->getall();
			   $val = array_merge($res,$list_all);
		       $newdata = [];
		       foreach($val as $k=>$v){
		        if(!isset($newdata[$v['sid']])){
		            $newdata[$v['sid']]=$v;
		        }else{
		            $newdata[$v['sid']]['state']+=$v['state'];
		          }
		        }
			}
			if($_GPC['type'] =='add'){
	           $data =array(
	           	  'uniacid'=>$uniacid,
	           	  'sid'   =>$_GPC['sid'],
	           	  'zid'   =>$_GPC['zid'],
	           	  'thumb' =>$_GPC['thumb'],
	           	  'desc'  =>$_GPC['desc'],
	           	  'name'  =>$_GPC['name'],
	              'state' => 1,
	              'uid'   =>$_W['uid']
	           	);
	           $ser->add($data);
		       $res = $ser->where("uniacid='".$uniacid."'and zid ='".$zid."'")->getall();
		       $list_all = $servicemenu->getall();
			   $val = array_merge($res,$list_all);
		       $newdata = [];
		       foreach($val as $k=>$v){
		        if(!isset($newdata[$v['sid']])){
		            $newdata[$v['sid']]=$v;
		        }else{
		            $newdata[$v['sid']]['state']+=$v['state'];
		          }
		        }
			}
		    message(error(0, $newdata), '', 'ajax'); 
		}
       include $this->template('team/server'); 
	}
	if($op=="message"){
		message('成功', 'refresh', 'success');
	}
//专家年卡列表
	if($op=="nklist"){
		$page = empty($_GPC['page']) ? "" : $_GPC['page'];
	    $pageindex = max(1, intval($page));
	    $pagesize = 10;
	   	$status = $_GPC['status'];
	   	$where = " where c.uniacid=".$uniacid;
	   	if($status != '')
	   	{
	   		$where .= " and c.status=".$status;
	   	}
	   	$keyword = $_GPC['keyword'];
	   	if($keyword != '')
	   	{
	   		$where .= " and z.z_name like '%$keyword%'";
	   	}
	   	if(is_agent == '1')
	   	{
	   		$where .= " and z.zid in (".$zjs.")";
	   	}
	   	$keshi_arr = pdo_getall("hyb_yl_classgory",array("uniacid"=>$uniacid,'typeint'=>'0'));
		$keshis_arr = pdo_getall("hyb_yl_ceshi",array("uniacid"=>$uniacid,"giftstatus"=>$keshi_arr[0]['id']));
	   	$keshi = $_GPC['keshi'];
	   	if($keshi != '')
	   	{
	   		$where .= " and z.z_room=".$keshi;
	   	}
	   	$keshi_two = $_GPC['keshi_two'];
	   	if($keshi_two != '')
	   	{
	   		$where .= " and z.parentid=".$keshi_two;
	   	}
	   	$list = pdo_fetchall("select c.*,z.z_name,z.parentid,z.z_zhicheng,z.z_room,z.advertisement from ".tablename("hyb_yl_yearcard")." as c left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=c.zid ".$where." order by c.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
	   	foreach($list as &$value)
	   	{
	   		if(strpos($value['advertisement'],'http') === false)
	   		{
	   			$value['advertisement'] = $_W['attachurl'].$value['advertisement'];
	   			
	   		}
	   		$value['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$value['parentid']),'name');
   			$value['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$value['z_zhicheng']),'job_name');
   			$value['created'] = date("Y-m-d",$value['created']);
   			$value['s_time'] = date("Y-m-d",$value['s_time']);
	   	}
	   	$wheres = "";
	   	if(is_agent == '1')
	   	{
	   		$wheres .= "  and zid in (".$zjs.")";
	   	}
	   	$total = pdo_fetchcolumn("select count(c.*) from ".tablename("hyb_yl_yearcard")." as c left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=c.zid ".$where);
	   	$count = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_yearcard")." where uniacid=".$uniacid.$wheres);
	   	$shenhe = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_yearcard")." where uniacid=".$uniacid." and status=0".$wheres);
	   	$tongguo = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_yearcard")." where uniacid=".$uniacid." and status=1".$wheres);
	   	$jujue = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_yearcard")." where uniacid=".$uniacid." and status=2".$wheres);
	   	$pager = pagination($total, $pageindex, $pagesize);
		include $this->template('team/nklist');
	}
	//专家年卡添加
	if($op=="nklistadd"){
		$id = $_GPC['id'];
		$item = pdo_get("hyb_yl_yearcard",array("id"=>$id));
		if($_W['ispost'])
		{
			$is_bangding = pdo_get("hyb_yl_yearcard",array("uniacid"=>$uniacid,"zid"=>$_GPC['zid']));
			if($is_bangding && $item['zid'] != $_GPC['zid'])
			{
				message("该专家已有年卡，请选择其他专家!",$this->createWebUrl("team",array("op"=>"nklistadd",'id'=>$id)),"error");
			}
			$data = array(
				'uniacid' => $uniacid,
				"zid" => $_GPC['zid'],
				"z_name" => $_GPC['z_name'],
				"is_mianfei" => $_GPC['is_mianfei'],
				"is_wzzk" => $_GPC['is_wzzk'],
				"hh_num" => $_GPC['hh_num'],
				"wz_num" => $_GPC['wz_num'],
				"wz_zhekou" => $_GPC['wz_zhekou'],
				"is_jd" => $_GPC['is_jd'],
				"times" => $_GPC['times'],
				"jd_num" => $_GPC['jd_num'],
				"num" => $_GPC['num'],
				"old_price" => $_GPC['old_price'],
				"new_price" => $_GPC['new_price'],
				"notes" => $_GPC['notes'],
				"content" => $_GPC['content'],
				"sort" => $_GPC['sort'],
				"status" => '1',
				"cut" => $_GPC['cut'],
			);
			if($id)
			{
				$data['s_time'] = time();
				$res = pdo_update("hyb_yl_yearcard",$data,array("id"=>$id));
			}else{
				$data['s_time'] = time();
				$data['created'] = time();
				$res = pdo_insert("hyb_yl_yearcard",$data);
			}
			if($res)
			{
				message("编辑成功!",$this->createWebUrl("team",array("op"=>"nklist")),"success");
			}else{
				message("编辑失败!",$this->createWebUrl("team",array("op"=>"nklist")),"error");

			}

		}
		include $this->template('team/nklistadd');
	}
	// 年卡删除
	if($op == 'nkdel')
	{
		$id = $_GPC['id'];
		$res = pdo_delete("hyb_yl_yearcard",array("id"=>$id));
		if($res)
		{
			message("删除成功!",$this->createWebUrl("team",array("op"=>"nklist")),"success");
		}else{
			message("删除失败!",$this->createWebUrl("team",array("op"=>"nklist")),"error");

		}
		include $this->template('team/nklist');
	}
	// 年卡审核
	if($op == 'nklistshenhe')
	{
		$id = $_GPC['id'];
		$status = $_GPC['status'];
		$res = pdo_update("hyb_yl_yearcard",array("status"=>$status,"s_time"=>time()),array("id"=>$id));
		if($res)
		{
			message("设置成功!",$this->createWebUrl("team",array("op"=>"nklist")),"success");
		}else{
			message("设置失败!",$this->createWebUrl("team",array("op"=>"nklist")),"error");

		}
		include $this->template('team/nklist');
	}
	// 年卡批量删除
	if($op == 'nkdels')
	{
		$ids = $_GPC['ids'];
		foreach($ids as &$value)
		{
			$res = pdo_delete("hyb_yl_yearcard",array("id"=>$value));
		}
		if($res)
		{
			message("删除成功!",$this->createWebUrl("team",array("op"=>"nklist")),"success");
		}else{
			message("删除失败!",$this->createWebUrl("team",array("op"=>"nklist")),"error");

		}
		include $this->template('team/nklist');
	}

	// 专家排班
	if($op == 'paiban')
	{
		$page = empty($_GPC['page']) ? "" : $_GPC['page'];
	    $pageindex = max(1, intval($page));
	    $pagesize = 10;
		$where = " where a.uniacid=".$uniacid." and a.jobtime != 0";
		$keyword = $_GPC['keyword'];
		$time = $_GPC['time'];
		$keywordtype = $_GPC['keywordtype'];
		if($keywordtype == '1')
		{
			$where .= " and a.z_name like '%$keyword%'";
		}else if($keywordtype == '2')
		{
			$where .= " and h.agentname like '%$keyword%'";
		}else if($keywordtype == '3')
		{
			$where .=" and b.title like '%$keyword%'";
		}
		
		if($time != '')
		{
			// $date_str=date('Y-m-d',strtotime($time));
			$date_str = $time;
		    //封装成数组
		    $arr=explode("-", $date_str);
		    //参数赋值
		    //年
		    $year=$arr[0];
		    //月，输出2位整型，不够2位右对齐
		    $month=sprintf('%02d',$arr[1]);
		    //日，输出2位整型，不够2位右对齐
		    $day=sprintf('%02d',$arr[2]);
		    //时分秒默认赋值为0；
		    $hour = $minute = $second = 0;
		    //转换成时间戳
		    $strap = mktime($hour,$minute,$second,$month,$day,$year);
		    //获取数字型星期几
		    $times=date("w",$strap);
		    $docjobtime = pdo_fetchall("select * from ".tablename("hyb_yl_docjobtime")." where uniacid=".$uniacid);
		    $s_id = "";
		    foreach($docjobtime as $k1 => $doc)
		    {
		    	$doc['server_time'] = unserialize($doc['server_time']);
		    	$tmp = '';
		    	foreach($doc['server_time'] as $kk => $vv)
		    	{
		    		$tmp .= $vv['week'].',';
			         
		    	}
		    	$docjobtime[$k1]['weeks'] = rtrim($tmp, ',');
		        if(strpos($docjobtime[$k1]['weeks'],$times) !== false)
		    	{
		    		$s_id .= $docjobtime[$k1]['id'].",";
		    	}

		    }
		    $s_id = rtrim($s_id,',');
		    if($s_id != '')
		    {
		    	$where .= " and a.jobtime in (".$s_id.")";
		    }
			
			$wheres = " and year like '%$time%'";
		}

		$list = pdo_fetchall("select a.*,b.title,b.server_time,b.id,h.agentname from ".tablename("hyb_yl_zhuanjia")." as a left join ".tablename("hyb_yl_docjobtime")." as b on b.id=a.jobtime left join ".tablename("hyb_yl_hospital")." as h on h.hid=a.hid ".$where." order by a.zid desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);

		if(count($list) != '0')
		{
			foreach($list as $key => $value)
			{
				$wenzhen = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." where uniacid=".$uniacid.$wheres." group by back_orser");
				$wenzhen = count($wenzhen);
				$guahao = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder")." where uniacid=".$uniacid.$wheres." group by back_orser");
				$guahao = count($guahao);
				$list[$key]['yuyue'] = $wenzhen + $guahao;
				$list[$key]['advertisement'] = tomedia($value['advertisement']);
				$server_time =unserialize($list[$key]['server_time']);
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

		         $list[$key]['weeks'] = rtrim($tmp, ',');
	          
			     $list[$key]['times'] =implode(',', $result2);
			}
		}
		
		$total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zhuanjia")." as a left join ".tablename("hyb_yl_docjobtime")." as b on b.id=a.jobtime left join ".tablename("hyb_yl_hospital")." as h on h.hid=a.hid ".$where);
		$pager = pagination($total, $pageindex, $pagesize);

		include $this->template('team/paiban');
	}
	//排班维护
	if($op=="scheduling"){
		$zid = $_GPC['zid'];
		$state = $_GPC['state'];
		$page = empty($_GPC['page']) ? "" : $_GPC['page'];
	    $pageindex = max(1, intval($page));
	    $pagesize = 10;
		$where = " where uniacid=".$uniacid." and style=0";
		if($state != '')
		{
			$where .= " and state=".$state;
		}
		if(is_agent == '1')
		{
			$where .= " and (zid in (".$zjs.") or zid is null)";
		}

		
        $res = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_docjobtime").$where." order by id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
        
	    $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_docjobtime").$where);

	    $pager = pagination($total, $pageindex, $pagesize);
        foreach ($res as $key => $value) {
        	$res[$key]['z_name'] = pdo_getcolumn("hyb_yl_zhuanjia",array("zid"=>$value['zid']),'z_name');
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
		include $this->template('team/scheduling');
	}
//新增排班维护
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
             'zid'      =>$zid,
             'type'     =>$_GPC['type']
         	);
         if(!empty($id)){
              pdo_update('hyb_yl_docjobtime',$data,array('id'=>$id));
         }else{
              pdo_insert('hyb_yl_docjobtime',$data);
         }
        
         message("操作成功!",$this->createWebUrl("team",array("op"=>"scheduling",'ac'=>'scheduling','zid'=>$zid)),"success");
		}
		include $this->template('team/schedulingadd');
	}
	// 排版删除
	if($op == 'schedulingdel')
	{
		$id = $_GPC['id'];
		$res = pdo_delete("hyb_yl_docjobtime",array("id"=>$id));
		if($res)
		{
			message("删除成功!",$this->createWebUrl("team",array("op"=>"scheduling")),"success");
		}else{
			message("删除失败!",$this->createWebUrl("team",array("op"=>"scheduling")),"error");
		}
		include $this->template('team/scheduling');
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
			message("删除成功!",$this->createWebUrl("team",array("op"=>"scheduling")),"success");
		}else{
			message("删除失败!",$this->createWebUrl("team",array("op"=>"scheduling")),"error");
		}
		include $this->template('team/scheduling');
	}
	//专家排班
	if($op=="docscheduling"){
		include $this->template('team/docscheduling');
	}
	//专家入驻设置
	if($op=="settled"){
		$page = empty($_GPC['page']) ? "" : $_GPC['page'];
	    $pageindex = max(1, intval($page));
	    $pagesize = 10;
		$where = " where uniacid=".$uniacid;
		$list = pdo_fetchall("select * from ".tablename("hyb_yl_zhuanjia_rzset").$where." order by id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
		$total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zhuanjia_rzset").$where);
		$pager = pagination($total, $pageindex, $pagesize);
		include $this->template('team/settled');
	}
	//专家入驻条件添加
	if($op=="settledadd"){
		$id = $_GPC['id'];
		$item = pdo_get("hyb_yl_zhuanjia_rzset",array("id"=>$id));
		if($_W['ispost'])
		{
			$data = array(
				"uniacid" => $_W['uniacid'],
				"title" => $_GPC['title'],
				"content" => $_GPC['content'],
				"times" => $_GPC['times'],
				"price" => $_GPC['price'],
				"sort" => $_GPC['sort'],
				"is_xf" => $_GPC['is_xf'],
				"is_tuijian" => $_GPC['is_tuijian'],
				"status" => $_GPC['status'],
			);
			if($id)
			{
				$res = pdo_update("hyb_yl_zhuanjia_rzset",$data,array("id"=>$id));
			}else{
				$data['created'] = time();

				$res = pdo_insert("hyb_yl_zhuanjia_rzset",$data);
			}
			if($res)
			{
				message("设置成功!",$this->createWebUrl("team",array("op"=>"settled",'ac'=>'settled')),"success");
			}else{
				message("设置失败!",$this->createWebUrl("team",array("op"=>"settled",'ac'=>'settled')),"error");
			}
		}
	include $this->template('team/settledadd');
	}

	// 删除专家入驻设置
	if($op == 'delsettled')
	{
		$id = $_GPC['id'];
		$res = pdo_delete("hyb_yl_zhuanjia_rzset",array("id"=>$id));
		if($res)
		{
			message("删除成功!",$this->createWebUrl("team",array("op"=>"settled")),"success");
		}else{
			message("删除失败!",$this->createWebUrl("team",array("op"=>"settled")),"error");
		}
		include $this->template('team/settled');
	}
		//专家入驻明细
	if($op=="settlement"){
		$page = empty($_GPC['page']) ? "" : $_GPC['page'];
	    $pageindex = max(1, intval($page));
	    $pagesize = 10;
		$where = " where l.uniacid=".$uniacid;
		$keyword = $_GPC['keyword'];
		$keywordtype = $_GPC['keywordtype'];
		if($keywordtype == '1')
		{
			$where .= " and l.zid=".$keyword;
		}else if($keywordtype == '2')
		{
			$where .= " and z.z_name like '%$keyword%'";
		}else if($keywordtype == '3')
		{
			$where .= " and z.z_telephone like '%$keyword%'";
		}
		$keshi_arr = pdo_getall("hyb_yl_classgory",array("uniacid"=>$uniacid));
		$status = $_GPC['status'];
		if($status != '')
		{
			$where .= " and l.type=".$status;
		}
		
		$timetype = $_GPC['timetype'];
		$start = empty($_GPC['start']) ? date("Y-m-d",strtotime("-1Months",time())) : $_GPC['start']; 
		$end = empty($_GPC['end']) ? date("Y-m-d",strtotime("+1days",time())) : $_GPC['end'];
		if($start != date("Y-m-d",time()) && $end != date("Y-m-d",time()))
		{
			if($timetype == '1')
			{
				$where .= " and z.endtime>=".$start." and z.endtime<=".$end;
			}else{
				$where .= " and l.p_time>=".strtotime($start)." and l.p_time<=".strtotime($end);
			}
			
		}

		$list = pdo_fetchall("select l.*,z.z_name,z.z_telephone,z.endtime,z.advertisement,z.z_room,z.parentid,z.qx_id,z.hid,z.opentime from ".tablename("hyb_yl_zhuanjia_log")."as l left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=l.zid ".$where." order by id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);

		$total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zhuanjia_log")."as l left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=l.zid ".$where);
		$pager = pagination($total, $pageindex, $pagesize);
		include $this->template('team/settlement');
	}
	// 删除专家入驻记录
	if($op == 'settlementdel')
	{
		$id = $_GPC['id'];
		$res = pdo_delete("hyb_yl_zhuanjia_log",array("id"=>$id));
		if($res)
		{
			message("删除成功!",$this->createWebUrl("team",array("op"=>"settlement")),"success");
		}else{
			message("删除失败!",$this->createWebUrl("team",array("op"=>"settlement")),"error");
		}
		include $this->template('team/settlement');
	}

	// 批量删除专家入驻记录
	if($op == 'settlementdels')
	{
		$ids = $_GPC['ids'];
		foreach($ids as &$value)
		{
			$res = pdo_delete("hyb_yl_zhuanjia_log",array("id"=>$value));
		}
		if($res)
		{
			message("删除成功!",$this->createWebUrl("team",array("op"=>"settlement")),"success");
		}else{
			message("删除失败!",$this->createWebUrl("team",array("op"=>"settlement")),"error");
		}
		include $this->template('team/settlement');
	}

//专家服务包管理
	if($op=="servicebox"){
		$list = pdo_fetchall("SELECT a.*,b.id as b_id,b.titlme FROM".tablename('hyb_yl_docserver_type')."as a left join".tablename('hyb_yl_docser_speck')."as b on b.id =a.typeid where a.uniacid ='{$uniacid}'");
		include $this->template('team/servicebox');
	}
//专家服务包添加
	if($op=="serviceboxadd"){
		$id = $_GPC['id'];
		$res = pdo_fetch("SELECT * FROM".tablename('hyb_yl_docserver_type')."where uniacid ='{$uniacid}' and id ='{$id}'");
		$list = pdo_fetchall("SELECT id,titlme FROM".tablename('hyb_yl_docser_speck')."where uniacid ='{$uniacid}'");
		if($_W['ispost']){
             $data =array(
                  'uniacid'   =>$uniacid,
                  'title'     =>$_GPC['title'],
                  'time_leng' =>$_GPC['time_leng'],
                  'money'   =>$_GPC['money'],
                  'typeid'  =>$_GPC['typeid'],
                  'stort'   =>$_GPC['stort'],
                  'fx_type' =>$_GPC['fx_type'],
                  'one_fx'  =>$_GPC['one_fx'],
                  'two_tx'  =>$_GPC['two_tx'],
                  'if_store'=>$_GPC['if_store'],
                  'if_xf'   =>$_GPC['if_xf'],
                  'if_open' =>$_GPC['if_open'],
             	);
             if(empty($id)){
                 pdo_insert("hyb_yl_docserver_type",$data);
                 message("添加成功!",$this->createWebUrl("team",array("op"=>"servicebox",'ac'=>'servicebox')),"success");
             }else{
             	 pdo_update("hyb_yl_docserver_type",$data,array('id' =>$id));
             	 message("更新成功!",$this->createWebUrl("team",array("op"=>"servicebox",'ac'=>'servicebox')),"success");
             }
		}
		include $this->template('team/serviceboxadd');
	}
	// 删除专家服务包
	if($op == 'serviceboxdel')
	{
		$ids = $_GPC['ids'];
		$res = pdo_delete("hyb_yl_doc_all_serverlist",array("ids"=>$ids));
        $data =array(
          'status'=>$res
        	);
        echo json_encode($data);
        return false;
	}
//专家服务包开通记录
	if($op=="serviceboxlog"){
		$status = $_GPC['status'];
		$page = empty($_GPC['page']) ? "" : $_GPC['page'];
	    $pageindex = max(1, intval($page));
	    $pagesize = 10;
		$where = " where l.uniacid=".$uniacid;
		$pay_type = $_GPC['pay_type'];
		$keywordtype = $_GPC['keywordtype'];
		$keyword = $_GPC['keyword'];
		$start = empty($_GPC['start']) ? date("Y-m-d",strtotime("-1Months",time())) : $_GPC['start']; 
	    $end = empty($_GPC['end']) ? date("Y-m-d",strtotime("+1days",time())) : $_GPC['end'];
		$type_arr = pdo_getall("ims_hyb_yl_docserver_type",array("uniacid"=>$uniacid));

		$type = $_GPC['type'];
		if($type != '')
		{
			$where .= " and l.bid=".$type;
		}
		if($pay_type != '')
		{
			$where .= " and l.pay_type=".$pay_type;
		}
		if($keywordtype == '1')
		{
			$where .= " and l.orders like '%$keyword%'";
		}
		if($keywordtype == '2')
		{
			$where .= " and z.z_name like '%$keyword%'";
		}
		if(is_agent == '1')
		{
			$where .= " and z.zid in (".$zjs.")";
		}
			

		if($_W['ispost']){
			if($start != '' && $end != '')
			{
				$where .= " and l.time >='".$start."' and l.time <='".$end."'";
			}
			$list = pdo_fetchall("select l.*,z.z_name,z.z_zhicheng,z.z_telephone,c.thumb,d.title from ".tablename("hyb_yl_doc_all_serverlist")." as l left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=l.zid left join".tablename('hyb_yl_docser_speck')."as c on c.id = l.bid left join".tablename('hyb_yl_docserver_type')."as d on d.typeid=c.id ".$where." order by l.ids desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
				
		
		}else{
			  $list = pdo_fetchall("select l.*,z.z_name,z.z_zhicheng,z.z_telephone,c.thumb,d.title from ".tablename("hyb_yl_doc_all_serverlist")." as l left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=l.zid left join".tablename('hyb_yl_docser_speck')."as c on c.id = l.bid left join".tablename('hyb_yl_docserver_type')."as d on d.typeid=c.id ".$where." order by l.ids desc limit ".($pageindex - 1) * $pagesize.",".$pagesize); 
		}
		


        $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_doc_all_serverlist")." as l left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=l.zid left join".tablename('hyb_yl_docser_speck')."as c on c.id = l.bid left join".tablename('hyb_yl_docserver_type')."as d on d.typeid=c.id ".$where);

		$pager = pagination($total, $pageindex, $pagesize);

		foreach($list as &$value)
		{
			$value['p_time'] = date("Y-m-d H:i:s",$value['p_time']);
			$value['end_time'] = date("Y-m-d H:i:s",$value['end_time']);
			$value['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$value['z_zhicheng']),'job_name');
			$fuwu = pdo_get("ims_hyb_yl_docserver_type",array("id"=>$value['type']));
			$fuwu['thumb'] = pdo_getcolumn("hyb_yl_docser_speck",array("id"=>$fuwu['typeid']),'thumb');
			if(strpos($fuwu['thumb'],'http') === false)
			{
				$fuwu['thumb'] = $_W['attachurl'].$fuwu['thumb'];
			}
			$value['fw_thumb'] = $fuwu['thumb'];
			$value['fw_title'] = $fuwu['title'];
			$value['time_leng'] = $fuwu['time_leng'];
		}
		$wheres = '';
		if(is_agent == '1')
		{
			$wheres = " and zid in (".$zjs.")";
		}
		$zhuangjia_count = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid.$wheres);
		$fuwu_count = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_doc_all_serverlist")." where uniacid=".$uniacid.$wheres);
		$fuwu_money = pdo_fetchcolumn("select sum(money) from ".tablename("hyb_yl_doc_all_serverlist")." where uniacid=".$uniacid."and kt_type=1".$wheres);
		if($fuwu_money == NULL)
		{
			$fuwu_money = '0.00';
		}
		include $this->template('team/serviceboxlog');
	}
		
//专家服务包开通详情
	if($op=="serviceboxdetail"){
		
		$ids = $_GPC['ids'];
		$item = pdo_fetch("select l.time_leng as ltime_leng,l.*,z.z_name,z.z_zhicheng,z.z_telephone,z.advertisement,c.thumb,d.typeid,d.id as did,d.title from ".tablename("hyb_yl_doc_all_serverlist")." as l left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=l.zid left join".tablename('hyb_yl_docser_speck')."as c on c.id = l.bid left join".tablename('hyb_yl_docserver_type')."as d on d.typeid=c.id where l.ids=".$ids);
		$user = pdo_get("hyb_yl_userinfo",array("openid"=>$item['openid']));
		$fuwu = pdo_get("hyb_yl_docserver_type",array("id"=>$item['did']));
		$fuwu['thumb'] = pdo_getcolumn("hyb_yl_docser_speck",array("id"=>$fuwu['typeid']),'thumb');
		include $this->template('team/serviceboxdetail');
	}

//开卡记录
	if($op=="nkrecord"){
		$page = empty($_GPC['page']) ? "" : $_GPC['page'];
	    $pageindex = max(1, intval($page));
	    $pagesize = 10;
		$where = " where p.uniacid=".$uniacid;
		$status = $_GPC['status'];
		if($status != '' && $status != '2')
		{
			$where .= " and p.status=".$status;
		}else if($status == '2')
		{
			$where .= " and endtime<=".time();
		}
		if(is_agent == '1')
		{
			$where .= " and zid in (".$zjs.")";
		}
		$keywordtype = $_GPC['keywordtype'];
		$keyword = $_GPC['keyword'];
		if($keywordtype == '1')
		{
			$where .= " and u.u_name like '%$keyword%'";
		}else if($keywordtype == '2')
		{
			$where .= " and u.u_phone like '%$keyword%'";
		}else if($keywordtype == '3')
		{
			$where .= " p.ordersn like '%$keyword%'";
		}
		$list = pdo_fetchall("select p.*,u.u_name,u.u_thumb,u.u_phone from ".tablename("hyb_yl_user_yearcard")." as p left join ".tablename("hyb_yl_userinfo")." as u on u.openid=p.openid ".$where." order by p.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);

		$total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_user_yearcard")." as p left join ".tablename("hyb_yl_userinfo")." as u on u.openid=p.openid ".$where);

		$pager = pagination($total, $pageindex, $pagesize);
		foreach($list as &$value)
		{
			$zhuanjia = pdo_get("hyb_yl_zhuanjia",array("zid"=>$value['zid']));
			if(strpos($zhuanjia['advertisement'],'http') === false)
			{
				$zhuanjia['advertisement'] = $_W['attachurl'].$zhuanjia['advertisement'];
			}
			$value['advertisement'] = $zhuanjia['advertisement'];
			$value['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$zhuanjia['parentid']),'name');
   			$value['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$zhuanjia['z_zhicheng']),'job_name');
   			$card = pdo_get("hyb_yl_yearcard",array("id"=>$value['yid']));
   			$value['card'] = $card;
   			$value['p_time'] = date("Y-m-d",$value['created']);
   			$value['endtime'] = date("Y-m-d",$value['end_time']);
   			$value['moneys'] = $value['money'] - $value['ptmoney'] - $value['hosmoney'] - $value['tk_one'] - $value['tk_two'];
   			$value['tk'] = pdo_fetchcolumn("select b.username from ".tablename("hyb_yl_tuikesite")." as a  left join ".tablename("hyb_yl_tuikesite")." as b on b.tkid=a.id where a.uniacid=".$uniacid." and a.openid='".$value['openid']."'");
		}

		include $this->template('team/nkrecord');
	}
	// 删除办卡记录
	if($op == 'nkcarddel')
	{
		$id = $_GPC['id'];
		$res = pdo_delete("hyb_yl_card_pay",array("id"=>$id));
		if($res)
		{
			message("删除成功!",$this->createWebUrl("team",array("op"=>"nkrecord")),"success");
		}else{
			message("删除失败!",$this->createWebUrl("team",array("op"=>"nkrecord")),"error");

		}
		include $this->template('team/nkrecord');
	}
//专家年卡图标列表
	if($op=="nkicon"){
		$item = pdo_get("hyb_yl_card_thumb",array("uniacid"=>$uniacid));
		if($item)
		{
			if(strpos($item['mf_thumb'],'http') === false)
			{
				$item['mf_thumb'] = $_W['attachurl'].$item['mf_thumb'];
			}
			if(strpos($item['wz_thumb'],'http') === false)
			{
				$item['wz_thumb'] = $_W['attachurl'].$item['wz_thumb'];
			}
			if(strpos($item['hh_thumb'],'http') === false)
			{
				$item['hh_thumb'] = $_W['attachurl'].$item['hh_thumb'];
			}
			if(strpos($item['jd_thumb'],'http') === false)
			{
				$item['jd_thumb'] = $_W['attachurl'].$item['jd_thumb'];
			}
		}
		if($_W['ispost'])
		{
			$data = array(
				'uniacid' => $uniacid,
				"mf_title" => $_GPC['mf_title'],
				"mf_thumb" => $_GPC['mf_thumb'],
				"mf_status" => $_GPC['mf_status'],
				"mf_content" => $_GPC['mf_content'],
				"wz_title" => $_GPC['wz_title'],
				"wz_thumb" => $_GPC['wz_thumb'],
				"wz_status" => $_GPC['wz_status'],
				"wz_content" => $_GPC['wz_content'],
				"hh_title" => $_GPC['hh_title'],
				"hh_thumb" => $_GPC['hh_thumb'],
				"hh_status" => $_GPC['hh_status'],
				"hh_content" => $_GPC['hh_content'],
				"jd_title" => $_GPC['jd_title'],
				"jd_thumb" => $_GPC['jd_thumb'],
				"jd_status" => $_GPC['jd_status'],
				"jd_content" => $_GPC['jd_content'],
			);
			if($item)
			{
				$res = pdo_update("hyb_yl_card_thumb",$data,array("uniacid"=>$uniacid));
			}else{
				$data['created'] = time();
				$res = pdo_insert("hyb_yl_card_thumb",$data);
			}
			if($res)
			{
				message("设置成功!",$this->createWebUrl("team",array("op"=>"nkicon")),"success");
			}else{
				message("设置失败!",$this->createWebUrl("team",array("op"=>"nkicon")),"error");

			}
		}
		include $this->template('team/nkicon');
	}
//年卡规则
	if($op=="nkrule"){
		$item = pdo_get("hyb_yl_card_rule",array("uniacid"=>$uniacid));
		if($_W['ispost'])
		{
			$data = array(
				'uniacid' => $_W['uniacid'],
				"status" => $_GPC['status'],
				"is_wz" => $_GPC['is_wz'],
				"is_zk" => $_GPC['is_zk'],
				"is_hh" => $_GPC['is_hh'],
				"is_jd" => $_GPC['is_jd'],
				"is_ms" => $_GPC['is_ms'],
				"content" => $_GPC['content'],
				
			);
			if($item)
			{
				$res = pdo_update("hyb_yl_card_rule",$data,array("uniacid"=>$uniacid));
			}else{
				$data['created'] = time();
				$res = pdo_insert("hyb_yl_card_rule",$data);
			}
			if($res)
			{
				message("设置成功!",$this->createWebUrl("team",array("op"=>"nkrule")),"success");
			}else{
				message("设置失败!",$this->createWebUrl("team",array("op"=>"nkrule")),"error");

			}
		}
		include $this->template('team/nkrule');
	}
//全部评论
	if($op=="register"){
		$page = empty($_GPC['page']) ? "" : $_GPC['page'];
	    $pageindex = max(1, intval($page));
	    $pagesize = 10;
		$where = " where p.uniacid=".$uniacid;
		$start = empty($_GPC['start']) ? date("Y-m-d",strtotime("-1Months",time())) : $_GPC['start']; 
	$end = empty($_GPC['end']) ? date("Y-m-d",strtotime("+1days",time())) : $_GPC['end'];
		$typs = $_GPC['typs'];
		if($typs != '')
		{
			$where .= " and p.typs=".$typs;
		}
		$keyword = $_GPC['keyword'];
		if($keyword != '')
		{
			$where .= " and z.z_name like '%$keyword%'";
		}
		$style = $_GPC['style'];
		if($style != '')
		{
			$where .= " and p.style=".$style;
		}
		if(is_agent == '1')
		{
			$where .= " and z.zid in (".$zjs.")";
		}
		$list = pdo_fetchall("select p.*,z.z_name,z.advertisement,z.z_room,z.parentid,z.z_zhicheng from ".tablename("hyb_yl_pingjia")." as p left join ".tablename("hyb_yl_zhuanjia")." as  z on z.zid=p.zid ".$where." order by p.gz_id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
		foreach ($list as &$value) {
			$value['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$value['parentid']),'name');
			$value['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$value['z_zhicheng']),'job_name');
			$user = pdo_get("hyb_yl_userinfo",array("openid"=>$value['openid']));
			$value['u_name'] = $user['u_name'];
			$value['u_thumb'] = $user['u_thumb'];
			if(strpos($value['advertisement'],'http') === false)
			{
				$value['advertisement'] = $_W['attachurl'].$value['advertisement'];
			}
		}
		$total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_pingjia")." as p left join ".tablename("hyb_yl_zhuanjia")." as  z on z.zid=p.zid ".$where);
		$pager = pagination($total, $pageindex, $pagesize);
		include $this->template('team/register');
	}
//虚拟评论
	if($op=="registeradd"){
		$zid = $_GPC['zid'];
		if($_W['ispost'])
		{
			$data = array(
				'uniacid' => $uniacid,
				"createTime" => strtotime($_GPC['createTime']),
				"starsnum" => $_GPC['starsnum'],
				"openid" => $_GPC['openid'],
				"content" => $content,
				"status" => '0',
				"typs" => "1",
				"style" => '2',
				"zid" => $zid,
			);
			pdo_insert("hyb_yl_pingjia",$data);
		}
		include $this->template('team/registeradd');
	}
	// 评论审核
	if($op == 'registershenhe')
	{
		$gz_id = $_GPC['gz_id'];
		$typs = $_GPC['typs'];

		$res = pdo_update("hyb_yl_pingjia",array("typs"=>$typs),array("gz_id"=>$gz_id));
		if($res)
		{
			message("审核成功!",$this->createWebUrl("team",array("op"=>"register",'ac'=>'register')),"success");
		}else{
			message("审核失败!",$this->createWebUrl("team",array("op"=>"register",'ac'=>'register')),"success");
		}
		include $this->template('team/register');
	}
	// 评论删除
	if($op == 'registerdel')
	{
		$gz_id = $_GPC['gz_id'];
		$res = pdo_delete("hyb_yl_pingjia",array("gz_id"=>$gz_id));
		if($res)
		{
			message("删除成功!",$this->createWebUrl("team",array("op"=>"register",'ac'=>'register')),"success");
		}else{
			message("删除失败!",$this->createWebUrl("team",array("op"=>"register",'ac'=>'register')),"success");
		}
		include $this->template('team/register');
	}
	// 评论批量操作
	if($op == 'registerchange')
	{
		$ids = $_GPC['ids'];
		$typs = $_GPC['typs'];
		$status = $_GPC['status'];
		$ids = explode(",",$ids);
		foreach($ids as &$value)
		{
			if($typs == 'shenhe')
			{
				$res = pdo_update("hyb_yl_pingjia",array("status"=>$status),array("gz_id"=>$value));
			}else if($typs == 'del')
			{
				$res = pdo_delete("hyb_yl_pingjia",array("gz_id"=>$value));
			}
		}
		if($res)
		{
			message("操作成功!",$this->createWebUrl("team",array("op"=>"register",'ac'=>'register')),"success");
		}else{
			message("操作失败!",$this->createWebUrl("team",array("op"=>"register",'ac'=>'register')),"success");
		}
		include $this->template('team/register');
	}
	if($op == 'huifu')
	{
		$gz_id = $_GPC['gz_id'];
		$content = $_GPC['content'];
		$res = pdo_update("hyb_yl_pingjia",array("h_content"=>$content,"h_time"=>time()),array("gz_id"=>$gz_id));
		if($res)
		{
			message("操作成功!",$this->createWebUrl("team",array("op"=>"register",'ac'=>'register')),"success");
		}else{
			message("操作失败!",$this->createWebUrl("team",array("op"=>"register",'ac'=>'register')),"success");
		}
		include $this->template('team/register');
	}
//专家动态
	if($op=="docsetting"){
		include $this->template('team/docsetting');
	}
//添加类别
	if($op=="addact"){
		include $this->template('team/addact');
	}
//规则设置
	if($op=="group"){
		$item = pdo_get("hyb_yl_zhuanjia_rule",array("uniacid"=>$uniacid));
		if($_W['ispost'])
		{
			$data = array(
				'uniacid' => $uniacid,
				"is_ff" => $_GPC['is_ff'],
				"is_ruzhu" => $_GPC['is_ruzhu'],
				"is_huanjiao" => $_GPC['is_huanjiao'],
				"is_dongtai" => $_GPC['is_dongtai'],
				"is_pinglun" => $_GPC['is_pinglun'],
				"score" => $_GPC['score'],
				"sort_type" => $_GPC['sort_type'],
				"rz_content" => $_GPC['rz_content'],
				"pay_content" => $_GPC['pay_content'],
				"background" => $_GPC['background'],
				"fee" => $_GPC['fee'],
			);
			if($item)
			{
				$res = pdo_update("hyb_yl_zhuanjia_rule",$data,array("uniacid"=>$_W['uniacid']));

			}else{
				$data['created'] = time();
				$res = pdo_insert("hyb_yl_zhuanjia_rule",$data);
			}
			if($res)
			{
				message("操作成功!",$this->createWebUrl("team",array("op"=>"group")),"success");
			}else{
				message("操作失败!",$this->createWebUrl("team",array("op"=>"group")),"error");
			}
		}
		include $this->template('team/group');
	}
//添加职称
	// if($op=="comment"){
	// 	include $this->template('team/comment');
	// }
//职称列表
	if($op=="dynamic"){
		$where = " where uniacid='{$uniacid}' and type=1";
		$keyword = $_GPC['keyword'];
		if($keyword != '')
		{
			$where .= " and job_name like '%$keyword%'";
		}
		$row = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_zhuanjia_job').$where);
		if($_W['isajax']){
          $data = array(
            'uniacid'  =>$uniacid,
            'job_name' =>$_GPC['job_name'],
            'job_strot'=>$_GPC['job_strot'],
            'job_state'=>$_GPC['job_state'],
            'type' =>1
          	);
          $res = pdo_insert("hyb_yl_zhuanjia_job",$data);
          if($res){
          	$data1 =array(
                'status'=>1
          		);
          }else{
          	$data1 =array(
                'status'=>0
          		);
          }
          echo json_encode($data);
          return false;
		}
		include $this->template('team/dynamic');
	}

	// 职称修改
	if($op == 'changejob')
	{
		$type = $_GPC['type'];
		$id = $_GPC['id'];
		if($type == '1')
		{
			$res = pdo_update("hyb_yl_zhuanjia_job",array("job_name"=>$_GPC['value']),array("id"=>$id));
		}else if($type == '2')
		{
			$res = pdo_update("hyb_yl_zhuanjia_job",array("job_strot"=>$_GPC['value']),array("id"=>$id));
		}else if($type == '3')
		{
			$job_state = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$id),'job_state');
			if($job_state == '1')
			{
				$res = pdo_update("hyb_yl_zhuanjia_job",array("job_state"=>'0'),array("id"=>$id));
			}else if($job_state == '0')
			{
				$res = pdo_update("hyb_yl_zhuanjia_job",array("job_state"=>'1'),array("id"=>$id));
			}
		}
		if($res)
		{
			$data['status'] = '1';
		}else{
			$data['status'] = '0';
		}
		echo json_encode($data);
		return false;
		include $this->template('team/dynamic');
	}
	// 删除职称
	if($op == 'deljob')
	{
		$id = $_GPC['id'];
		$res = pdo_delete("hyb_yl_zhuanjia_job",array("id"=>$id));
		if($res)
		{
			message("操作成功!",$this->createWebUrl("team",array("op"=>"dynamic","ac"=>"dynamic")),"success");
		}else{
			message("操作失败!",$this->createWebUrl("team",array("op"=>"dynamic","ac"=>"dynamic")),"error");
		}
		include $this->template('team/dynamic');
	}
//添加头衔
	if($op=="addtoux"){
		include $this->template('team/addtoux');
	}
//头衔列表
	if($op=="txlist"){
		include $this->template('team/txlist');
	}
//患教列表
	if($op=="hjsetting"){

		$page = empty($_GPC['page']) ? "" : $_GPC['page'];
    	$pageindex = max(1, intval($page));
    	$pagesize = 10;
    	$where = " where h.uniacid=".$uniacid;
    	$status = $_GPC['status'];
    	if(is_agent == '1')
    	{
    		$where .= " and zid in (".$zjs.")";
    	}
    	if($status == '1')
    	{
    		$where .= " and h.h_shen=2";
    	}else if($status == '2')
    	{
    		$where .= " and h.h_shen=1";
    	}else if($status == '3')
    	{
    		$where .= " and h.h_shen=0";
    	}else if($status == '4'){

    		$where .= " and h.h_shen=1 and h.h_tuijian=1";
    	}else if($status == '5')
    	{
    		$where .= " and h.h_shen=3";
    	}
    	$keywordtype = $_GPC['keywordtype'];
    	$keyword = $_GPC['keyword'];
    	if($keywordtype == '1')
    	{
    		$where .= " and h.h_title like '%$keyword%'";
    	}else if($keywordtype == '2')
    	{
    		$where .= " and h.title like '%$keyword%'";
    	}else if($keywordtype == '3')
    	{
    		$where .= " and u.u_name like '%$keyword%'";
    	}else if($keywordtype == '4')
    	{
    		$where .= " and u.u_phone like '%$keyword%'";
    	}
    	$start = empty($_GPC['start']) ? date("Y-m-d",strtotime("-1Months",time())) : $_GPC['start']; 
	    $end = empty($_GPC['end']) ? date("Y-m-d",strtotime("+1days",time())) : $_GPC['end'];
    	if($start && $end)
    	{
    		$where .= " and h.created >=".strtotime($start)." and h.created <=".strtotime($end);
    	}
    	$list = pdo_fetchall("select h.*,f.hj_name from ".tablename("hyb_yl_hjiaosite")." as h left join ".tablename("hyb_yl_hjfenl")." as f on f.hj_id=h.h_flid ".$where ." order by h.h_id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);


    	foreach($list as &$value)
    	{
    		$zhuanjia = pdo_get("hyb_yl_zhuanjia",array("zid"=>$value['zid']));
    		if(strpos($zhuanjia['advertisement'],'http') === false)
    		{
    			$zhuanjia['advertisement'] = $_W['attachurl'].$zhuanjia['advertisement'];
    		}
    		$value['z_name'] = $zhuanjia['z_name'];
    		$value['advertisement'] = $zhuanjia['advertisement'];
    		$value['fenlei'] = pdo_getcolumn("hyb_yl_hjfenl",array("hj_id"=>$value['h_flid']),'hj_name');
    		$value['created'] = date("Y-m-d H:i:s",$value['created']);
    	}
    	$total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_hjiaosite")." as h left join ".tablename("hyb_yl_hjfenl")." as f on f.hj_id=h.h_flid right join ".tablename("hyb_yl_userinfo")." as u on u.u_id=h.uid ".$where);
    	$pager = pagination($total, $pageindex, $pagesize);
    	$shenhe = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_hjiaosite")." where uniacid=".$uniacid." and h_shen=2");
    	$show = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_hjiaosite")." where uniacid=".$uniacid." and h_shen=1");
    	$tuijian = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_hjiaosite")." where uniacid=".$uniacid." and h_tuijian=1");
    	$jujue =pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_hjiaosite")." where uniacid=".$uniacid." and h_shenhe=0");
    	$del = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_hjiaosite")." where uniacid=".$uniacid." and h_shen=3");

		include $this->template('team/hjsetting');
	}
	// 添加患教
	if($op == 'hjadd')
	{
		$h_id = $_GPC['h_id'];
		$item = pdo_get("hyb_yl_hjiaosite",array("h_id"=>$h_id));
		$item['openid'] = pdo_getcolumn("hyb_yl_zhuanjia",array("zid"=>$item['zid']),'openid');
		$cate_list = pdo_getall("hyb_yl_hjfenl",array("uniacid"=>$uniacid));
		if($_W['ispost'])
		{
			$u_id = pdo_getcolumn("hyb_yl_userinfo",array("openid"=>$_GPC['openid']),'u_id');
			$data = array(
				'uniacid' => $uniacid,
				"sort" => $_GPC['sort'],
				"h_keyword" => $_GPC['h_keyword'],
				"h_dianzan" => $_GPC['h_dianzan'],
				"h_read" => $_GPC['h_read'],
				"h_zhuanfa" => $_GPC['h_zhuanfa'],
				"h_tuijian" => $_GPC['h_tuijian'],
				"h_shen" => $_GPC['h_shen'],
				'h_title'   => $_GPC['h_title'],
			    'h_pic'     => $_GPC['h_pic'],
		      	'h_type'    => $_GPC['h_type'],
		      	'h_text'    => $_GPC['h_text'],
		      	'h_flid'    => $_GPC['h_flid'],
		      	'h_video'   => $_GPC['h_video'],
		      	'audios'    => $_GPC['audios'],
		      	'sfbtime'   => time(),
		      	'h_leixing' => $_GPC['h_leixing'],
		      	'uid'       => $u_id,
		      	'zid'       => $_GPC['zid'],
		      	'z_name'    => $_GPC['z_name'],
		      	"created" => strtotime($_GPC['created']),
			);

			if($h_id)
			{
				$res = pdo_update("hyb_yl_hjiaosite",$data,array("h_id"=>$h_id));
			}else{
				$res = pdo_insert("hyb_yl_hjiaosite",$data);
			}

			if($res)
			{
				message("设置成功!",$this->createWebUrl("team",array("op"=>"hjsetting",'hid'=>$_SESSION['hid'])),"success");
			}else{
				message("设置失败!",$this->createWebUrl("team",array("op"=>"hjsetting",'hid'=>$_SESSION['hid'])),"error");

			}
		}
		include $this->template("team/hjadd");
	}
	// 删除患教
	if($op == 'hjdel')
	{
		$h_id = $_GPC['h_id'];
		$res = pdo_update("hyb_yl_hjiaosite",array("h_shen"=>'3'),array("h_id"=>$h_id));
		if($res)
		{
			message("设置成功!",$this->createWebUrl("team",array("op"=>"hjsetting")),"success");
		}else{
			message("设置失败!",$this->createWebUrl("team",array("op"=>"hjsetting")),"error");
		}
		include $this->template("team/hjsetting");

	}
	// 患教状态修改
	if($op == 'hjchange')
	{
		$h_id = $_GPC['h_id'];
		$type = $_GPC['type'];
		if($type == 'tuijian')
		{
			$h_tuijian = $_GPC['h_tuijian'];
			$res = pdo_update("hyb_yl_hjiaosite",array("h_tuijian"=>$h_tuijian),array("h_id"=>$h_id));
		}else{
			$h_shen = $_GPC['h_shen'];
			$res = pdo_update("hyb_yl_hjiaosite",array("h_shen"=>$h_shen),array("h_id"=>$h_id));
		}
		
		if($res)
		{
			message("设置成功!",$this->createWebUrl("team",array("op"=>"hjsetting")),"success");
		}else{
			message("设置失败!",$this->createWebUrl("team",array("op"=>"hjsetting")),"error");
		}
		include $this->template("team/hjsetting");
	}
	if($op == 'hjchanges')
	{
		$ids = $_GPC['ids'];
		$type = $_GPC['type'];
		$status = $_GPC['status'];
		foreach($ids as &$value)
		{
			if($type == 'tuijian')
			{
				$res = pdo_update("hyb_yl_hjiaosite",array("h_tuijian"=>$status),array("h_id"=>$value));
			}else if($type == 'status')
			{
				$res = pdo_update("hyb_yl_hjiaosite",array("status"=>$status),array("h_id"=>$value));
			}else if($type == 'del')
			{
				$is_del = false;
				$item = pdo_getcolumn("hyb_yl_hjiaosite",array("h_id"=>$value),'status');
				if($item == '3')
				{
					$res = pdo_delete("hyb_yl_hjiaosite",array("h_id"=>$value));
				}else{
					$res = pdo_update("hyb_yl_hjiaosite",array("status"=>$status),array("h_id"=>$value));
				}
				
			}
		}
		include $this->template("team/hjsetting");

	}
//患教分类
	if($op=="hjsort"){
		$page = empty($_GPC['page']) ? "" : $_GPC['page'];
	    $pageindex = max(1, intval($page));
	    $pagesize = 10;
	    $list = pdo_fetchall("select * from ".tablename("hyb_yl_hjfenl")." where uniacid=".$uniacid." and pid=0 order by hj_id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
	    $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_hjfenl")." where uniacid=".$uniacid." and pid=0");
	    $pager = pagination($total, $pageindex, $pagesize);
	    foreach($list as &$value)
	    {
	    	if(strpos($value['thumb'],'http') === false)
	    	{
	    		$value['thumb'] = $_W['attachurl'].$value['thumb'];
	    	}
	    	$child = pdo_getall("hyb_yl_hjfenl",array("uniacid"=>$uniacid,"pid"=>$value['hj_id']));
	    	foreach($child as &$ch)
	    	{
	    		if(strpos($ch['thumb'],'http') === false)
	    		{
	    			$ch['thumb'] = $_W['attachurl'].$ch['thumb'];
	    		}
	    	}
	    	$value['child'] = $child;
	    }
		include $this->template('team/hjsort');
	}
	if($op == 'hjsortadd'){
		$hj_id = $_GPC['hj_id'];
		$pid = $_GPC['pid'];
    	$parent = pdo_getall("hyb_yl_hjfenl",array("uniacid"=>$uniacid,"pid"=>'0'));
		$item = pdo_get("hyb_yl_hjfenl",array("hj_id"=>$hj_id));
		if($_W['ispost'])
		{
			$data = array(
				'uniacid' => $uniacid,
				"pid" => $_GPC['pid'],
				"hj_name" => $_GPC['hj_name'],
				"thumb" => $_GPC['thumb'],
				"status" => $_GPC['status'],
				"sord" => $_GPC['sord'],
			);
			if($hj_id)
			{
				$res = pdo_update("hyb_yl_hjfenl",$data,array("hj_id"=>$hj_id));
			}else{
				$data['created'] = time();
				
				$res = pdo_insert("hyb_yl_hjfenl",$data);
			}
			if($res)
			{
				message("设置成功!",$this->createWebUrl("team",array("op"=>"hjsort")),"success");
			}else{
				message("设置失败!",$this->createWebUrl("team",array("op"=>"hjsort")),"error");

			}
		}
		include $this->template('team/hjsortadd');
	}
	if($op == 'hj_del')
	{
		$hj_id = $_GPC['hj_id'];
		$type = $_GPC['type'];
		if($type == '1')
		{
			pdo_delete("hyb_yl_hjfenl",array("pid"=>$hj_id));
		}
		$res = pdo_delete("hyb_yl_hjfenl",array("hj_id"=>$hj_id));
		if($res)
		{
			message("删除成功!",$this->createWebUrl("team",array("op"=>"hjsort")),"success");
		}else{
			message("删除失败!",$this->createWebUrl("team",array("op"=>"hjsort")),"error");

		}
		include $this->template('team/hjsort');
	}
//患教评论
	if($op=="hjcomment"){
		$page = empty($_GPC['page']) ? "" : $_GPC['page'];
	    $pageindex = max(1, intval($page));
	    $pagesize = 10;
	    $h_id = $_GPC['h_id'];
	    $start = empty($_GPC['start']) ? date("Y-m-d H:i:s",strtotime("-1Months",time())) : $_GPc['start']; 
		$end = empty($_gPc['end']) ? date("Y-m-d h:i:s",time()) : $_GPC['end'];
		$style = $_GPC['style'];
		$typs = $_GPC['typs'];
		$keyword = $_GPC['keyword'];
		$where = " where p.uniacid=".$uniacid." and p.j_id=".$h_id;
		if($keyword != '')
		{
			$where .= " and z.z_name like '%$keyword%'";
		}
		if($style != '')
		{
			$where .= " and p.style=".$style;
		}
		if($typs != '')
		{
			$where .= " and p.typs=".$typs;
		}
		if($start != '' && $end != '')
		{
			$where .= " and p.createTime>=".strtotime($start)." and p.createTime <=".strtotime($end);
		}
	    $list = pdo_fetchall("select p.*,z.z_name from ".tablename("hyb_yl_pingjia")." as p left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=p.zid ".$where." order by p.gz_id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
	    $total = pdo_fetchcolumn("select count(p.*) from ".tablename("hyb_yl_pingjia")." as p left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=p.zid ".$where);
	    foreach($list as &$value)
	    {
	    	$user = pdo_get("hyb_yl_userinfo",array("openid"=>$value['openid']));
	    	$value['u_name'] = $user['u_name'];
	    	$value['u_thumb'] = $user['u_thumb'];
	    }
	    $pager = pagination($total, $pageindex, $pagesize);
		include $this->template('team/hjcomment');
	}

	// 患教评论审核
	if($op == 'comment_shenhe')
	{
		$id = $_GPC['id'];
		$h_id = $_GPC['h_id'];
		$typs = $_GPC['typs'];
		$res = pdo_update("hyb_yl_pingjia",array("typs"=>$typs),array("id"=>$id));
		if($res)
		{
			message("设置成功!",$this->createWebUrl("team",array("op"=>"hjcomment","h_id"=>$h_id)),"success");
		}else{
			message("设置失败!",$this->createWebUrl("team",array("op"=>"hjcomment","h_id"=>$h_id)),"error");

		}
		include $this->template('team/hjcomment');
	}

	// 患教评论回复
	if($op == 'comment_huifu')
	{
		$id = $_GPC['id'];
		$h_id = $_GPC['h_id'];
		$content = $_GPC['content'];
		$res = pdo_update("hyb_yl_pingjia",array("h_content"=>$content,'h_time'=>time()),array("id"=>$id));
		if($res)
		{
			message("设置成功!",$this->createWebUrl("team",array("op"=>"hjcomment","h_id"=>$h_id)),"success");
		}else{
			message("设置失败!",$this->createWebUrl("team",array("op"=>"hjcomment","h_id"=>$h_id)),"error");

		}
		include $this->template('team/hjcomment');
	}
	// 患教评论添加
	if($op == 'comment_add')
	{
		$h_id = $_GPC['h_id'];
		$zid = $_GPC['zid'];
		if($_W['is_post'])
		{
			$data = array(
				'openid' => $_GPC['openid'],
				"zid" => $_GPC['zid'],
				"starsnum" => $_GPC['starsnum'],
				"content" => $_GPC['content'],
				"createTime" => time(),
				"j_id" => $h_id,
				"h_content" => $_GPC['h_content'],
				"style" => '2'
			);
			if($_GPC['h_content'] != '')
			{
				$data['h_time'] = time();
				$data['status'] = '1';
			}
			$res = pdo_isnert("hyb_yl_pingjia",$data);
			if($res)
			{
				message("设置成功!",$this->createWebUrl("team",array("op"=>"hjcomment","h_id"=>$h_id)),"success");
			}else{
				message("设置失败!",$this->createWebUrl("team",array("op"=>"hjcomment","h_id"=>$h_id)),"error");

			}
		}

		include $this->template("team/comment_add");
	}
	// 患教评论删除
	if($op == 'comment_del')
	{
		$gz_id = $_GPC['gz_id'];
		$h_id = $_GPC['h_id'];
		$res = pdo_delete("hyb_yl_pingjia",array("gz_id"=>$gz_id));
		if($res)
		{
			message("设置成功!",$this->createWebUrl("team",array("op"=>"hjcomment","h_id"=>$h_id)),"success");
		}else{
			message("设置失败!",$this->createWebUrl("team",array("op"=>"hjcomment","h_id"=>$h_id)),"error");

		}
		include $this->template("team/hjcomment");
	}
	// 患教评论批量操作
	if($op == 'comment_changes')
	{
		$ids = $_GPC['ids'];
		$typs = $_GPC['typs'];
		$status = $_GPC['status']; 
		foreach($ids as &$value)
		{
			if($typs == 'shenhe')
			{
				$res = pdo_update("hyb_yl_pingjia",array("h_shenhe"=>$status),array("gz_id"=>$value));
			}else{
				$res = pdo_delete("hyb_yl_pingjia",array("gz_id"=>$value));
			}
		} 
		if($res)
		{
			message("设置成功!",$this->createWebUrl("team",array("op"=>"hjcomment","h_id"=>$h_id)),"success");
		}else{
			message("设置失败!",$this->createWebUrl("team",array("op"=>"hjcomment","h_id"=>$h_id)),"error");

		}
		include $this->template("team/hjcomment");
	}
	    if($op == 'delerweima'){
        $res =pdo_update("hyb_yl_zhuanjia",array('weweima'=>''),array('uniacid'=>$uniacid));
        $data = array(
           'status'=>1
            );
        echo json_encode($data);
        return false;
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
	   
	   
	    if($zip->zipFolder("../attachment/hyb_yl/share_{$uniacid}","../attachment/hyb_yl/erweima_".date("Y-m-d",time()).".zip")){
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

    // 专家签约记录
	if($op == 'signup')
	{
		$zid = $_GPC['zid'];
		$page = empty($_GPC['page']) ? "" : $_GPC['page'];
	    $pageindex = max(1, intval($page));
	    $pagesize = 10;
	    $ifqianyue = $_GPC['ifqianyue'];
	    $where = " where a.uniacid=".$uniacid." and a.goods_id=".$zid." and a.cerated_type=7";
	    if($ifqianyue != '')
	    {
	    	$where .= " and a.ifqianyue=".$ifqianyue;
	    }
	    $keyword = $_GPC['keyword'];
	    if($keyword != '')
	    {
	    	$where .= " and u.u_name like '%$keyword%'";
	    }
		$list = pdo_fetchall("select a.*,u.u_thumb,u.u_name,u.u_id from ".tablename("hyb_yl_attention")." as a left join ".tablename("hyb_yl_userinfo")." as u on u.openid=a.openid ".$where." order by a.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
		$total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_attention")." as a left join ".tablename("hyb_yl_userinfo")." as u on u.openid=a.openid ".$where);
		$pager = pagination($total, $pageindex, $pagesize);
		
		include $this->template('team/signup');
	}

	// 签约记录审核
	if($op == 'sign_change')
	{
		$id = $_GPC['id'];
		$zid = $_GPC['zid'];
		$ifqianyue = $_GPC['ifqianyue'];
		$res = pdo_update("hyb_yl_attention",array("ifqianyue"=>$ifqianyue),array("id"=>$id));
		if($res)
		{
			message("审核成功!",$this->createWebUrl("team",array("op"=>"signup","zid"=>$zid)),"success");
		}else{
			message("审核失败!",$this->createWebUrl("team",array("op"=>"signup","zid"=>$zid)),"success");
		}
		include $this->template('team/signup');
	}
	// 签约记录删除
	if($op == 'sign_del')
	{
		$id = $_GPC['id'];
		$zid = $_GPC['zid'];
		$res = pdo_delete("hyb_yl_attention",array("id"=>$id));
		if($res)
		{
			message("删除成功!",$this->createWebUrl("team",array("op"=>"signup","zid"=>$zid)),"success");
		}else{
			message("删除失败!",$this->createWebUrl("team",array("op"=>"signup","zid"=>$zid)),"success");
		}
		include $this->template('team/signup');
	}

	// 签约记录批量删除
	if($op == 'sign_del')
	{
		$id = $_GPC['id'];
		$zid = $_GPC['zid'];
		$res = pdo_delete("hyb_yl_attention",array("id"=>$id));
		if($res)
		{
			message("删除成功!",$this->createWebUrl("team",array("op"=>"signup","zid"=>$zid)),"success");
		}else{
			message("删除失败!",$this->createWebUrl("team",array("op"=>"signup","zid"=>$zid)),"success");
		}
		include $this->template('team/signup');
	}
	if($op == 'jxbiaoqian'){
        $page = empty($_GPC['page']) ? "" : $_GPC['page'];
        $pageindex = max(1, intval($page));
        $pagesize = 100;

        $keyword = !empty($_GPC['keyword'])?$_GPC['keyword']:"";
        if (!empty($keyword)) {
            $keyword = trim($keyword);
            $where = " and  name like '%$keyword%' ";
        }
        $list = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_zhuanjia_select")." where uniacid=:uniacid ".$where." order by id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize,array(":uniacid"=>$uniacid));
        $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zhuanjia_select")." where uniacid=:uniacid ".$where,array(":uniacid"=>$uniacid));
        $pager = pagination($total, $pageindex, $pagesize);
		include $this->template('team/jxbiaoqian');
	}
	if($op == 'addjxbiaoqian'){
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $id = $_GPC['id'];
      $rows = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_zhuanjia_select")." where uniacid=:uniacid and id=:id ",array(":uniacid"=>$uniacid,":id"=>$id));
      if($_W['ispost']){
          $data['uniacid'] = $uniacid;
          $data['name'] = $_GPC['name'];
          $data['status'] = $_GPC['status'];
          if (empty($rows)) {
              $res = pdo_insert("hyb_yl_zhuanjia_select",$data);
          }else{
              $res = pdo_update("hyb_yl_zhuanjia_select",$data,array("id"=>$id));
          }

          if ($res) {
              message("编辑成功!",$this->createWebUrl("team",array("op"=>"jxbiaoqian")),"success");
          }else{
              message("编辑失败!",$this->createWebUrl("team",array("op"=>"jxbiaoqian")),"error");
          }
      }
      include $this->template('team/addjxbiaoqian');
	}
	if($op =='deljxbiaoqian'){
      $id = $_GPC['id'];
      $res = pdo_delete('hyb_yl_zhuanjia_select',array('id'=>$id));
      $data =array(
         'status'=>$res
      	);
      echo json_encode($data);
      return false;
	}

	if($op == 'del_shouyis')
	{
		$back_orser = $_GPC['ids'];
		$servers = $_GPC['servers'];
		for($i=0;$i<count($_GPC['ids']);$i++)
	    {
	        pdo_delete('hyb_yl_vip_quanyi',array('id' =>$_GPC['ids'][$i]));
	    }
	    die(json_encode(array('errno'=>1,'message'=>1)));
	}
	// 批量删除排版列表
	if($op == 'del_paibans')
	{
		$ids = $_GPC['ids'];
		for($i=0;$i<count($ids);$i++)
		{
			pdo_delete("hyb_yl_docjobtime",array("id" => $ids[$i]));
		}
		die(json_encode(array('errno'=>1,'message'=>1)));
	}

	// 批量删除开通记录
	if($op == 'del_serviceboxlogs')
	{
		$ids = $_GPC['ids'];

		for($i=0;$i<count($ids);$i++)
		{
			pdo_delete("hyb_yl_doc_all_serverlist",array("ids" => $ids[$i]));
		}
		die(json_encode(array('errno'=>1,'message'=>1)));
	}

	// 批量删除年卡记录
	if($op == 'del_nkrecords')
	{
		$ids = $_GPC['ids'];
		for($i=0;$i<count($ids);$i++)
		{
			pdo_delete("hyb_yl_user_yearcard",array("id" => $ids[$i]));
		}
		die(json_encode(array('errno'=>1,'message'=>1)));
	}


function a_array_unique($array){
  $out = array();
 
  foreach ($array as $key=>$value) {
   if (!in_array($value, $out)){
    $out[$key] = $value;
   }
  }
 
  $out = array_values($out);
  return $out;
 }
