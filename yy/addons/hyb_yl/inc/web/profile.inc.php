<?php
$_W['plugin'] ='member';
 class Profile extends HYBPage
 { 


	public function userlist()
	{
		global $_W, $_GPC;
		$op =$_GPC['op'];
        $page = empty($_GPC['page']) ? "" : $_GPC['page'];
	    $pageindex = max(1, intval($page));
	    $pagesize = 10;
		$uniacid =$_W['uniacid'];

		$keywordtype = !empty($_GPC['keywordtype'])?$_GPC['keywordtype']:"";
		$keyword = !empty($_GPC['keyword'])?$_GPC['keyword']:"";
		$wherecontion = " where u.uniacid=:uniacid ";
		$wheredata[':uniacid'] = $uniacid;
		if (!empty($keywordtype)) {
			if ($keywordtype=='1' && !empty($keyword)) {
				$wherecontion .= " and u.randnum like '%".$keyword."%'";
				// $wheredata[':keyword'] ='%'.$keyword.'%';
			}
			if ($keywordtype=='2' && !empty($keyword)) {
				$wherecontion .= " and (j.tel like '%".$keyword."%'  or u.u_phone like '%".$keyword."%')";
				// $wheredata[':keyword'] ='%'.$keyword.'%';
			}
			if ($keywordtype=='3' && !empty($keyword)) {
				$wherecontion .= " and u.u_name like '%".$keyword."%'";
				// $wheredata[':keyword'] ='%'.$keyword.'%';
			}
		}
		
		$groupid = !empty($_GPC['groupid'])?$_GPC['groupid']:"";
		if (!empty($groupid)) {
			if ($groupid=='1') {
				$wherecontion .= " and (u.admintype!=1 or adminguanbi<:newtime) ";
				$wheredata[':newtime'] = time();
			}
			if ($groupid=='2') {
				$wherecontion .= " and u.admintype=1  ";
			}
		}
		$zhuangtai = !empty($_GPC['zhuangtai'])?$_GPC['zhuangtai']:"";
		if (!empty($zhuangtai)) {
			if ($zhuangtai=='1') {
				$wherecontion .= " and u.type=1 ";
			}
			if ($zhuangtai=='2') {
				$wherecontion .= " and u.type=0 ";
			}
		}
		
        $listarray = pdo_fetchall("SELECT *,u.openid as u_openid  FROM".tablename('hyb_yl_userinfo')." as u left join ".tablename("hyb_yl_userjiaren")." as j on j.openid=u.openid and j.sick_index=0  ".$wherecontion."  order by u.zctime desc LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize,$wheredata);


       	$total = pdo_fetchcolumn("SELECT count(*)  FROM ".tablename('hyb_yl_userinfo')." as u left join ".tablename("hyb_yl_userjiaren")." as j on j.openid=u.openid and j.sick_index=0  ".$wherecontion,$wheredata);
     
       	$pager = pagination($total, $pageindex, $pagesize);
		foreach ($listarray as &$value) {

			$useropenid = $value['u_openid'];
			$value['u_thumb'] = tomedia($value['u_thumb']);
			//查询每个人的处方单
			$value['cfcount'] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' .tablename("hyb_yl_goodsorders")."  where uniacid=:uniacid and openid=:openid",array(":uniacid"=>$uniacid,":openid"=>$useropenid));
			//查询每个人的问诊次数
            $value['twcount'] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' .tablename("hyb_yl_twenorder")."  where uniacid='{$uniacid}' and openid='{$useropenid}'  ");
            if($value['u_label'] == '')
            {
            	$value['u_label'] = pdo_fetchcolumn("select biaoqian from ".tablename("hyb_yl_twenorder")." where uniacid='{$uniacid}' and openid='{$useropenid}' order by id asc ");
            }
            

            $value['count'] = pdo_fetchcolumn('SELECT COUNT(*) FROM ' .tablename("hyb_yl_wenzorder")."  where uniacid='{$uniacid}' and openid='{$useropenid}'  ");

            $value['numcount'] = ($value['twcount'] + $value['count'] );
            //查询用户购药订单
            $value['gycount'] = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_goodsorders")." WHERE uniacid=:uniacid and openid=:openid",array(":uniacid"=>$uniacid,":openid"=>$useropenid));
            //查询用户体检订单
            $value['tjcount'] = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_tijianorder")." WHERE uniacid=:uniacid and openid=:openid",array(":uniacid"=>$uniacid,":openid"=>$useropenid));
            //查询用户挂号订单
            $value['ghcount'] = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_guahaoorder")." WHERE uniacid=:uniacid and openid=:openid",array(":uniacid"=>$uniacid,":openid"=>$useropenid));
            //查询用户的检查报告
            $value['baogao'] = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_tijianorder")." WHERE uniacid=:uniacid and openid=:openid and ifover=1",array(":uniacid"=>$uniacid,":openid"=>$useropenid));
            //查询用户优惠券
            $value['yhqcount'] = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_user_coupon")." WHERE uniacid=:uniacid and openid=:openid",array(":uniacid"=>$uniacid,":openid"=>$useropenid));

            //查询用户真实姓名年龄等
            $userinfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_userjiaren")." WHERE uniacid=:uniacid and openid=:openid and sick_index=0",array(":uniacid"=>$uniacid,':openid'=>$useropenid));
            $value['zhenshixingming'] = $userinfo['names'];
            $value['telphone'] = $userinfo['tel'];
            $value['xingbie'] = $userinfo['sex'];
            $value['nianlin'] = $userinfo['age'];
            


		}


		if($_W['isajax']){
			switch ($_GPC['type']) {
				case 'del_one':
	            	$hj_id=intval($_GPC['id']); 
		            $res=$model->delete("hj_id=$hj_id and uniacid=$uniacid ");
					break;
				case 'del':
				    $values =$_GPC['values'];
	                foreach ($values as $key => $value) {
	                	 $hj_id=intval($value); 
			             $res=$model->delete("hj_id=$hj_id and uniacid=$uniacid ");
	                }
					break;
			}
	         
	       message(error(0, $_GPC['type']), '', 'ajax');  
		}
		include $this->template("profile/userlist");
	}
	//用户家人
	public function userjr(){
		global $_W, $_GPC;
		$op =$_GPC['op'];
		$type_id = $_GPC['type_id'];
		$openid = $_GPC['openid'];
		$uniacid =$_W['uniacid'];
		$list = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_userjiaren')."where uniacid ='{$uniacid}' and openid='{$openid}'");
        include $this->template("profile/userjr");
	}

	//用户标签
	public function userlabel(){
		global $_W,$_GPC;
		$uniacid = $_W['uniacid'];
		$u_id = $_GPC['u_id'];
		$userinfo = pdo_fetch("select * FROM ".tablename("hyb_yl_userinfo")." WHERE uniacid=:uniacid and u_id=:u_id",array(":uniacid"=>$uniacid,":u_id"=>$u_id));
		$tuwen = pdo_getcolumn("hyb_yl_twenorder",array("openid"=>$userinfo['openid']),'biaoqian');
		if (!empty($userinfo['u_label'])) {
			$u_label = explode("、", $userinfo['u_label']);
		}elseif($tuwen != ''){
			$u_label = explode(",", $tuwen);
			
		}else{
			$u_label = [];
		}
		
		//科室
		$ks_list = pdo_getall("hyb_yl_classgory",array('uniacid'=>$uniacid));
		$ks_two = pdo_getall("hyb_yl_ceshi",array("giftstatus"=>$res['z_room']));

		include $this->template("profile/userlabel");
	}
	//修改用户标签
	public function adduserlabel(){
		global $_W,$_GPC;
		$uniacid = $_W['uniacid'];
		$u_id = $_GPC['u_id'];
		$arr = implode("、",$_GPC['arr']);
		$res = pdo_update("hyb_yl_userinfo",array("u_label"=>$arr),array("u_id"=>$u_id));
		if ($res) {
			die(json_encode("1"));
		}else{
			die(json_encode("0"));
		}

	}
	public function userlabel_keshi(){
		global $_W,$_GPC;
		$id = $_GPC['id'];
		//二级科室
		$res =  pdo_getall("hyb_yl_ceshi",array('giftstatus'=>$id));
		echo json_encode($res);
	}
	public function userlabel_keshiinfo(){
		global $_W,$_GPC;
		$id = $_GPC['id'];
		//二级科室
		$res =  pdo_get("hyb_yl_ceshi",array('id'=>$id),array('description'));
       	$description = explode('、', $res['description']);
  
        echo json_encode($description);
	}

	//用户账户 积分  余额充值
	public function rechargeuser(){
		global $_W, $_GPC;
		$uniacid = $_W['uniacid'];
		$u_id = $_GPC['u_id'];
		$userinfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_userinfo")." WHERE uniacid=:uniacid and u_id=:u_id",array(":uniacid"=>$uniacid,":u_id"=>$u_id));
		$userjiaren = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_userjiaren")." WHERE uniacid=:uniacid and openid=:openid",array(":uniacid"=>$uniacid,":openid"=>$userinfo['openid']));
		$userinfo['u_zhenshixingming'] = $userjiaren['names'];
		if($_W['ispost']){
			$data['uniacid']  = $_W['uniacid'];
			$data['u_id'] = $u_id;
			$data['openid'] = $userinfo['openid'];
			$data['credittype'] = $_GPC['credittype'];
			$num = floatval($_GPC['num']);
			$remark = trim($_GPC['remark']);
			$changetype = intval($_GPC['changetype']);
			if ($changetype=='0') {
				$changetype = 0;
				$changenum = $num;
			}
			else {
				$changetype = 1;
				$changenum = 0 - $num;
			}
			$data['num'] = $changenum;
			
			$data['createtime'] = time();
			$data['operator'] = "0";   //来源
			if ($_GPC['credittype']=='credit1') {
				$presentcredit = $userinfo['score']+$changenum;
			}else{
				$presentcredit = $userinfo['money']+$changenum;
			}
			$data['remark'] = "后台会员充值 ".$_GPC['remark'].' '.$userinfo['openid'].' 剩余：'.$presentcredit;  //备注
			$data['presentcredit'] = $presentcredit;
			$res = pdo_insert("hyb_yl_userinfo_credit_record",$data);
			if ($res) {
				if ($_GPC['credittype']=='credit1') {
					pdo_update("hyb_yl_userinfo",array('score +='=>$changenum),array("u_id"=>$u_id));
				}else{
					pdo_update("hyb_yl_userinfo",array('money +='=>$changenum),array("u_id"=>$u_id));
				}
				die(json_encode(array('message'=>1)));
			}else{
				die(json_encode(array('message'=>0)));
			}
		}
		include $this->template("profile/rechargeuser");
	}

	//添加/修改分类
	 public function detail()
	{
		global $_W, $_GPC;
		$op ='hz_lisr';
		$uniacid = $_W['uniacid'];
		$type_id = $_GPC['type_id'];
		$model=Model("hjfenl"); 
	    $hj_id =intval($_GPC['hj_id']);
		$res = $model->where("hj_id=$hj_id and uniacid=$uniacid")->get('*');
        $data = array(
                'uniacid' => $_W['uniacid'],
                'hj_name' => $_GPC['hj_name'],
                'hj_color'=> $_GPC['hj_color']
        	);
	    if($_W['ispost']){
	 		if($hj_id){
	 			$model->where("hj_id=$hj_id and uniacid=$uniacid")->save($data);
	 			message('成功', 'refresh', 'success');
	 			//message("修改成功",$this->copysiteUrl("patient.listcate"),"success");
	 		}else{
	 			$model->add($data);
	 			message('成功', 'refresh', 'success');
	 			//message("添加成功",$this->copysiteUrl("patient.listcate"),"success");
	 		}
		  
	    }
		include $this->template("profile/detail");
	}

	//用户拉黑
	public function saveusertype(){
		global $_W, $_GPC;
		$u_id = $_GPC['u_id'];
		$caozuo = $_GPC['caozuo'];

		if ($caozuo == "no") {
			
			pdo_update("hyb_yl_userinfo",array("type"=>"1"),array("u_id"=>$u_id));
	         $data = array(
	            'status'=>1,
	          );
	        echo json_encode($data);
	        return false;
		}else{
			pdo_update("hyb_yl_userinfo",array("type"=>"0"),array("u_id"=>$u_id));
	         $data = array(
	            'status'=>1,
	          );
	        echo json_encode($data);
	        return false;
		}
		
	}

	 public function listhj()
	{
		global $_W, $_GPC;
		$op ='list_hj';
		$model=Model('hjiaosite'); 
		$uniacid = $_W['uniacid'];
		$tab1=$model->tablename("hjiaosite");
		$tab2=$model->tablename("hjfenl");
		$type_id = $_GPC['type_id'];
		$where="uniacid=$uniacid"; 
		$sql="SELECT DISTINCT $tab1.h_flid,$tab1.*,$tab2.hj_id,$tab2.hj_name FROM $tab1 LEFT JOIN $tab2 ON $tab1.h_flid=$tab2.hj_id  WHERE $tab1.uniacid='".$uniacid."' order by $tab1.sfbtime DESC";
		$page=$model->pagenation($sql);
		$list=$page['dataset'];
		if($_W['isajax']){
		switch ($_GPC['type']) {
			case 'del_one':
		    	$id=intval($_GPC['id']); 
		        $res=$model->delete("h_id=$id and uniacid=$uniacid ");
				break;
			case 'del':
			    $values =$_GPC['values'];
		        foreach ($values as $key => $value) {
		        	 $id=intval($value); 
		             $res=$model->delete("h_id=$id and uniacid=$uniacid ");
		        }
				break;
			case 'rec':
			    $values =$_GPC['values'];
		        foreach ($values as $key => $value) {
		        	 $id=intval($value); 
		        	 $data =array(
		                  'h_shen' =>1
		        	 	);
		             $res=$model->where("h_id=$id and uniacid=$uniacid")->save($data);
		         }
				break;
			case 'norec':
			    $values =$_GPC['values'];
		        foreach ($values as $key => $value) {
		        	 $id=intval($value); 
		        	 $data =array(
		                  'h_shen' =>0
		        	 	);
		             $res=$model->where("h_id=$id and uniacid=$uniacid")->save($data);

		        }
				break;
		}
		 
		    message(error(0, $res), '', 'ajax');  
		}
		include $this->template("patient/list_hj");
	}
	//添加患教
	 public function addhj()
	{
		global $_W, $_GPC;
		$op ='list_hj';
		$h_id = intval($_GPC['h_id']);
		$uniacid = $_W['uniacid'];
		$model= Model('hjiaosite'); 
		$type_id = $_GPC['type_id'];
		$cate = Model('hjfenl');
		$where="uniacid=$uniacid"; 
		$ca=$cate->where($where)->page("*");
		$cate_list=$ca['dataset']; 

		$res = $model->where("h_id=$h_id and uniacid=$uniacid")->get('*');
        
		$data =array(
		      'uniacid'   => $_W['uniacid'],
		      'h_title'   => $_GPC['h_title'],
		      'h_pic'     => $_GPC['h_pic'],
		      'h_type'    => $_GPC['h_type'],
		      'h_text'    => $_GPC['h_text'],
		      'h_flid'    => $_GPC['h_flid'],
		      'h_video'   => $_GPC['h_video'],
		      'audios'    => $_GPC['audios'],
		      'sfbtime'   => strtotime('now'),
		      'h_leixing' => $_GPC['h_leixing'],
		      'zid'       => $_GPC['info']['zid']
		    );

		if($_W['ispost']){
				if($h_id){
					 $model->where("h_id=$h_id and uniacid=$uniacid")->save($data);
					 message('成功', 'refresh', 'success');
		             //message("编辑成功!",$this->copysiteUrl("patient.listhj"),"success");
				}else{
					 $model->add($data);
					 message('成功', 'refresh', 'success');
					 //message("添加成功",$this->copysiteUrl("patient.listhj"),"success");
				}
		  
		}
		include $this->template("patient/add_hj");
	}
 	 public function register()
     {
		global $_W, $_GPC;
        $uniacid = $_W['uniacid'];
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
				$condition = '  uniacid=:uniacid and zctime>=:starttime and zctime<=:endtime';
				$params = array(':uniacid' => $_W['uniacid'], ':starttime' => $time . ' 00:00:00', ':endtime' => $time . ' 23:59:59');
				$datas[] = array('date' => $time, 'mcount' => pdo_fetchcolumn('select count(*) from ' . tablename('hyb_yl_userinfo') . (' where   ' . $condition), $params), 'acount' => pdo_fetchcolumn('select count(*) from ' . tablename('hyb_yl_userinfo') . (' where ' . $condition), $params));
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
					$condition = '  uniacid=:uniacid and zctime>=:starttime and zctime<=:endtime';
					$params = array(':uniacid' => $_W['uniacid'], ':starttime' => $year . '-' . $month . '-' . $d . ' 00:00:00', ':endtime' => $year . '-' . $month . '-' . $d . ' 23:59:59');
					$datas[] = array('date' => $d . '日', 'mcount' => pdo_fetchcolumn('select count(*) from ' . tablename('hyb_yl_userinfo') . (' where   ' . $condition), $params), 'acount' => pdo_fetchcolumn('select count(*) from ' . tablename('hyb_yl_userinfo') . (' where  ' . $condition), $params));
					++$d;
				}
			}
			else {
				if (!empty($year)) {
					$charttitle = $year . '年增长趋势图';

					foreach ($months as $m) {
						// $lastday = get_last_day($year, $m['data']);
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
						$condition = '  uniacid=:uniacid and zctime>=:starttime and zctime<=:endtime';
						$params = array(':uniacid' => $_W['uniacid'], ':starttime' => $year . '-' . $m['data'] . '-01 00:00:00', ':endtime' => $year . '-' . $m['data'] . '-' . $lastday . ' 23:59:59');
						$datas[] = array('date' => $m['data'] . '月', 'mcount' => pdo_fetchcolumn('select count(*) from ' . tablename('hyb_yl_userinfo') . (' where   ' . $condition), $params), 'acount' => pdo_fetchcolumn('select count(*) from ' . tablename('hyb_yl_userinfo') . (' where   ' . $condition), $params));
					}
				}
			}
		}
      
      	
      	$zongyonghunum = pdo_fetchcolumn('select count(*) from ' . tablename('hyb_yl_userinfo')." where uniacid=:uniacid ",array(":uniacid"=>$_W['uniacid']));
      	
      	//查询昨日新增会员
      	$yesterday = date("Y-m-d",strtotime("-1 day"));
      	$yesterdaynum = pdo_fetchcolumn('select count(*) from ' . tablename('hyb_yl_userinfo')." where uniacid=:uniacid and zctime like :zctime ",array(':uniacid' => $_W['uniacid'], ':zctime' => '%'.$yesterday.'%'));

      	$today = date("Y-m-d",time());
      	$todaynum = pdo_fetchcolumn('select count(*) from ' . tablename('hyb_yl_userinfo')." where uniacid=:uniacid and zctime like :zctime ",array(':uniacid' => $_W['uniacid'], ':zctime' => '%'.$today.'%'));
      	$monthday = date("Y-m",time());
     	$monthnum = pdo_fetchcolumn('select count(*) from ' . tablename('hyb_yl_userinfo')." where uniacid=:uniacid and zctime like :zctime ",array(':uniacid' => $_W['uniacid'], ':zctime' => '%'.$monthday.'%'));
        include $this->template("profile/ptgaikuang");
     }
 	 public function hynotice()
     {
		global $_W, $_GPC;
        
      
        include $this->template("profile/hynotice");
     }
    /**
   添加用户
   */
    public function adduser()
     {
		global $_W, $_GPC;
        $u_id = $_GPC['u_id'];
        $uniacid  =$_W['uniacid'];
        $openid = $_GPC['openid'];
        $tab = !empty($_GPC['tab'])?$_GPC['tab']:"#tab1";

        $res = pdo_fetch("SELECT * FROM ".tablename('hyb_yl_userinfo')." where uniacid='{$uniacid}' and u_id='{$u_id}'");
        $openid = $res['openid'];
        $res['jr'] = pdo_fetch("SELECT * FROM ".tablename('hyb_yl_userjiaren')." where uniacid='{$uniacid}' and openid='{$openid}' and sick_index=0");

        $res['regions'] = explode(",",$res['jr']['region']);

        $res['my'] = pdo_get('hyb_yl_userjiaren',array('openid'=>$openid,'sick_index'=>0 ));

        if(strpos($res['regions'][0],'市') != false)
        {
        	$res['regions'][0] = substr($res['regions'][0],0,6);
        }

        //查询我的所有亲属
        $family = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_userjiaren')."where uniacid ='{$uniacid}' and openid='{$res['openid']}' and sick_index !=0");
        foreach($family as &$jiare)
        {
        	$jiare['regions'] = explode(",",$jiare['region']);
	        if(strpos($jiare['regions'][0],'市') != false)
	        {
	        	$jiare['regions'][0] = substr($jiare['regions'][0],0,6);
	        }
        }

        //查询用户会员等级
        $huiyuandengji = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_vip")." where uniacid=:uniacid and id=:id ",array(":uniacid"=>$uniacid,":id"=>$res['adminuserdj']));
        if (!empty($huiyuandengji)) {
        	$res['adminuserdj_name'] = $huiyuandengji['title'];
        }else{
        	$res['adminuserdj_name'] = "无";
        }


        //查询用户积分记录
    	$jifenjilu = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_userinfo_credit_record")." WHERE uniacid=:uniacid and openid=:openid and credittype=:credittype order by createtime desc ",array(":uniacid"=>$uniacid,":openid"=>$res['openid'],":credittype"=>'credit1'));

    	//查询用户优惠券
    	$couponlist = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_user_coupon")." WHERE uniacid=:uniacid and openid=:openid order by createtime desc ",array(":uniacid"=>$uniacid,":openid"=>$res['openid']));
    	if (!empty($couponlist)) {
    		foreach ($couponlist as &$coupon) {
    			//查询优惠券详情
	            $couponinfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_coupon")." WHERE uniacid=:uniacid and id=:id ",array(":uniacid"=>$uniacid,":id"=>$coupon['coupon_id']));
	            $coupon['coupon_name'] = $couponinfo['title'];
	            $coupon['sub_title'] = $couponinfo['sub_title'];
	            $shiyongfuwuid = $coupon['applicableservices'];
			    $shiyongfuwu = pdo_fetchall("SELECT titlme FROM ".tablename("hyb_yl_docser_speck")." WHERE uniacid=:uniacid and id in($shiyongfuwuid)",array(":uniacid"=>$uniacid));
			    if (!empty($shiyongfuwu)) {
			        foreach ($shiyongfuwu as &$ssfw) {
			         	$shiyongfuwuname[] = $ssfw['titlme'];
			        }
			         
			        $coupon['shiyongfuwu'] = implode("、", $shiyongfuwuname);
			    }else{
			        $coupon['shiyongfuwu'] = '无';
			    }

	            //查询所属医院
	            $hospital = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_hospital")." where uniacid=:uniacid and hid=:hid ",array(":uniacid"=>$uniacid,":hid"=>$couponinfo['hid']));
	            if (!empty($hospital)) {
	                $coupon['hospital'] = $hospital['agentname'];
	            }else{
	                $coupon['hospital'] = '';
	            }
    		}
    	}

    	$chufang = pdo_fetchall("select c.*,z.z_name as names from ".tablename("hyb_yl_chufang")." as c left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=c.zid where c.useropenid='".$openid."' and c.ispay!=0 and c.uniacid=".$uniacid." order by c.c_id desc");

    	foreach($chufang as &$cf)
    	{
    		$cf['time'] = date("Y-m-d H:i:s",$cf['time']);
    		$cf['types'] = '处方订单';
    	}
    	$chufan_money = array_sum(array_map(function($val){return $val['money'];}, $chufang));

    	$goodsorder = pdo_fetchall("select g.*,s.title as names from ".tablename("hyb_yl_goodsorders")." as g left join ".tablename("hyb_yl_store")." as s on g.sid=s.id where g.uniacid=".$uniacid." and g.openid='".$openid."' and isPay=1 order by g.id desc");
    	foreach($goodsorder as &$goods)
    	{
    		$goods['time'] = $goods['createtime'];
    		$goods['types'] = '购药订单';
    		$goods['money'] = $goods['realTotalMoney'];
    	}
    	$goods_money = array_sum(array_map(function($val){return $val['realTotalMoney'];}, $goodsorder));

    	$guahaoorder = pdo_fetchall("select g.*,z.z_name as names from ".tablename("hyb_yl_guahaoorder")." as g left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=g.zid where g.uniacid=".$uniacid." and g.openid='".$openid."' and is_pay=1 order by g.id desc");
    	foreach($guahaoorder as &$guahao)
    	{
    		$guahao['created'] = date("Y-m-d H:i:s",$guahao['created']);
    		$guahao['types'] = '购药订单';
    	}
    	$guahao_money = array_sum(array_map(function($val){return $val['money'];}, $guahaoorder));

    	$teamorder = pdo_fetchall("select o.*,t.title as names,t.type,t.money as t_money,t.zid from ".tablename("hyb_yl_teamorder")." as o left join ".tablename("hyb_yl_team")." as t on t.id=o.tid where o.uniacid=".$uniacid." and o.openid='".$openid."' and o.ifpay!=0 order by o.id desc");

    	foreach($teamorder as &$team)
    	{
    		if($team['type'] == '0')
    		{
    			$team['typs'] = '线上团队';
    		}else{
    			$team['typs'] = '线下团队';
    		}
    		$value['z_name'] = pdo_getcolumn("hyb_yl_zhuanjia",array("zid"=>$team['zid']),'z_name');
    		$value['created'] = date("Y-m-d H:i:s",$value['created']);
    		$guahao['types'] = '签约订单';
    	}
    	$team_money = array_sum(array_map(function($val){return $val['money'];}, $teamorder));

    	$tijianorder = pdo_fetchall("select * from ".tablename("hyb_yl_tijianorder")." where uniacid=".$uniacid." and openid='".$openid."' and ifpay!=0 order by id desc");
    	foreach($tijianorder as &$tijian)
    	{
    		$tijian['time'] = date("Y-m-d H:i:s",$tijian['time']);
    		$tijian['types'] = '体检订单';
    	}
    	$tijian_money = array_sum(array_map(function($val){return $val['money'];}, $tijianorder));

    	$tuwenorder = pdo_fetchall("select o.*,z.z_name as names from ".tablename("hyb_yl_twenorder")." as o left join ".tablename("hyb_yl_zhuanjia")." as z on o.zid=z.zid where o.uniacid=".$uniacid." and ifpay!=0 and o.openid='".$openid."' group by back_orser order by o.id desc");
        $biaoqian = $tuwenorder[0]['biaoqian'];
    	foreach($tuwenorder as &$tuwen)
    	{
    		$tuwen['typs'] = 'tuwen';
    		$tuwen['time'] = date("Y-m-d H:i:s",$tuwen['xdtime']);
    		$tuwen['types'] = '图文订单';
    	}
    	$tuwen_money = array_sum(array_map(function($val){return $val['money'];}, $tuwenorder));
    	$list = pdo_getall("hyb_yl_tuwen",array("uniacid"=>$uniacid,"back_orser"=>$tuwenorder[0]['back_orser']));
		foreach($list as &$ch)
		{
			$ch['content'] = unserialize($ch['content']);
			$ch['u_thumb'] = pdo_getcolumn("hyb_yl_userinfo",array("openid"=>$ch['openid']),"u_thumb");
			$ch['names'] = pdo_getcolumn("hyb_yl_userjiaren",array("j_id"=>$ch['j_id']),'names');
			$ch['z_thumb'] = pdo_getcolumn("hyb_yl_zhuanjia",array("zid"=>$ch['zid']),'advertisement');
			$ch['xdtime'] = date("Y-m-d H:i:s",$ch['xdtime']);
		}

    	$wenzorder = pdo_fetchall("select o.*,z.z_name as names from ".tablename("hyb_yl_wenzorder")." as o left join ".tablename("hyb_yl_zhuanjia")." as z on o.zid=z.zid where o.uniacid=".$uniacid." and ifpay!=0 and o.openid='".$openid."' group by back_orser order by o.id desc");

    	foreach($wenzorder as &$wen)
    	{
    		$wen['typs'] = 'wenzhen';
    		$wen['time'] = date("Y-m-d H:i:s",$wen['time']);
    		if($wen['keywords'] == 'dianhuajizhen')
    		{
    			$wen['types'] = '电话问诊';
    		}else if($wen['keywords'] == 'shipinwenzhen')
    		{
    			$wen['types'] = '视频问诊';
    		}else if($wen['keywords'] == 'shoushukuaiyue')
    		{
    			$wen['types'] = '手术快约';
    		}else if($wen['keywords'] == 'tijianjiedu')
    		{
    			$wen['types'] = '报告解读';
    		}
    		
    	}
    	$wenzhenorder = array_merge($tuwenorder,$wenzorder);
    	
    	$wenz_money = array_sum(array_map(function($val){return $val['money'];}, $wenzorder));

    	$vip_order = pdo_fetchall("select o.*,v.title as names from ".tablename("hyb_yl_vip_log")." as o left join ".tablename("hyb_yl_vip")." as v on o.vip=v.id where o.uniacid=".$uniacid." and o.status=1 and o.openid='".$openid."' order by o.id desc");
    	foreach($vip_order as &$vip)
    	{
    		$vip['time'] = date("Y-m-d H:i:s",$vip['created']);
    		$vip['types'] = '会员订单';
    	}
    	$vip_money = array_sum(array_map(function($val){return $val['money'];}, $viporder));

    	$yuyueorder = pdo_fetchall("select y.*,z.z_name as names from ".tablename("hyb_yl_yuyueorder")." as y left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=y.zid where y.uniacid=".$uniacid." and y.openid='".$openid."' and y.is_pay=1 order by id desc");
    	foreach($yuyueorder as &$yuyue)
    	{
    		$yuyue['hospital'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$yuyue['jigou_two']),'agentname');
    		$yuyue['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$yuyue['keshi_two']),'name');
    		$yuyue['typs'] = pdo_getcolumn("hyb_yl_ghyy_type",array("id"=>$yuyue['yy_type']),'title');
    		$yuyue['time'] = date("Y-m-d H:i:s",$yuyue['created']);
    		$yuyue['types'] = '预约订单';
    	}
    	$yuyue_money = array_sum(array_map(function($val){return $val['money'];}, $yuyueorder));

    	$yearorder = pdo_fetchall("select * from ".tablename("hyb_yl_user_yearcard")." as u left join ".tablename("hyb_yl_yearcard")." as y on u.yid=y.id where u.openid='".$openid."' and u.uniacid=".$uniacid." and u.status=1");

    	foreach($yearorder as &$year)
    	{
    		$zhuanjia = pdo_get("hyb_yl_zhuanjia",array("zid"=>$year['zid']));
    		$year['hospital'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$zhuanjia['hid']),'agentname');
    		$year['keshi'] = pdo_getcolumn("hyb_yl_ceshi",array("id"=>$zhuanjia['parentid']),'name');
    		$year['zhicheng'] = pdo_getcolumn("hyb_yl_zhuanjia_job",array("id"=>$zhuanjia['z_zhicheng']),'job_name');
    		$year['createds'] = date("Y-m-d H:i:s",$year['createds']);
    		$year['time'] = date("Y-m-d H:i:s",$year['createds']);
    		$year['types'] = '年卡订单';
    	}
    	$year_money = array_sum(array_map(function($val){return $val['money'];}, $yearorder));

    	$order = array_merge($chufang,$goodsorder,$guahaoorder,$teamorder,$tijianorder,$tuwenorder,$wenzorder,$vip_order,$yuyueorder,$yearorder);
       	
       	$money = $chufan_money + $goods_money + $guahao_money + $team_money + $tijian_money + $tuwen_money + $wenz_money + $vip_money + $yuyue_money + $year_money;

       	//处方单
	   $content = pdo_fetchall("select * from".tablename('hyb_yl_goodsorders')."where uniacid='{$uniacid}' and openid='{$openid}' and ifCf=1");
	    
	    foreach ($content as $key => $value) {
	      $content[$key]['cartlist'] = unserialize($content[$key]['sid']);
          $content[$key]['timess'] = substr($content[$key]['createTime'], 0,10);
	      foreach ($content[$key]['cartlist'] as $k => $v) {
	        $zhiyaochang =pdo_get("hyb_yl_goodsarr",array('sid'=>$v['sid']),array('pp_title','ifcfy'));
	        $content[$key]['cartlist'][$k]['zhiyaochang'] = $zhiyaochang['pp_title'];
	        $content[$key]['cartlist'][$k]['ifcfy'] = $zhiyaochang['ifcfy'];
	      }
	    }
	    
	    $times_arr = array_column($content,'timess');
	    $times_arr = array_unique($times_arr);
	    $one_time = $times_arr[0];

	    
	    // 查询用户动态
	    $dongtai = pdo_getall("hyb_yl_share",array("uniacid"=>$uniacid,"openid"=>$openid));
	    foreach($dongtai as &$vv)
	    {
	    	$vv['sharepic'] = unserialize($vv['sharepic']);
	    	$vv['times'] = date("Y-m-d H:i:s",$vv['times']);
	    	$vv['label_name'] = pdo_getcolumn("hyb_yl_share_category",array("id"=>$vv['labelid']),'name');
	    	$pinglunnum = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_pinglunsite")." WHERE uniacid=:uniacid and a_id=:a_id and parentid=0 ",array(":uniacid"=>$uniacid,":a_id"=>$vv['a_id']));
            $vv['pinglunnum'] = $pinglunnum;	
	    }
	    $sharebaogao = pdo_fetchall("select * from ".tablename("hyb_yl_user_baogao")." where uniacid=".$uniacid." and openid='".$openid."' order by times desc");
	    
	    foreach($sharebaogao as &$baogao)
	    {
	    	$baogao['sharepic'] = unserialize($baogao['sharepic']);
	    	foreach($baogao['sharepic'] as &$imgs)
	    	{
	    		if(strpos($img,'http') === false)
	    		{
	    			$imgs = tomedia($imgs);
	    		}
	    		
	    	}
	    	$baogao['times'] = date("Y-m-d H:i:s",$baogao['times']);
	    	$pinglunnum = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_pinglunsite")." WHERE uniacid=:uniacid and a_id=:a_id and parentid=0 ",array(":uniacid"=>$uniacid,":a_id"=>$vv['a_id']));
            $vv['pinglunnum'] = $pinglunnum;
	    }
	    $case_date = pdo_fetchall("select date from ".tablename("hyb_yl_user_case")." where uniacid=".$uniacid." and openid='".$openid."' group by date order by id desc");
	    $one_case_date = $case_date[0]['date'];
	    $case = pdo_fetchall("select created,date,id,day,number from ".tablename("hyb_yl_user_case")." where uniacid=".$uniacid." and openid='".$openid."' and date='".$case_date[0]['date']."' order by id desc");
	    foreach($case as &$cas)
	    {
	    	$cas['content'] = unserialize($cas['content']);
	    	$cas['created'] = date("m-d H:i:s",$cas['created']);
	    }
	    // $case = pdo_getall("hyb_yl_user_case",array("uniacid"=>$uniacid,"openid"=>$openid));
        include $this->template("profile/adduser");
     }
     public function search_case()
     {
     	global $_W,$_GPC;
     	$uniacid = $_W['uniacid'];
     	$date = $_GPC['date'];
     	$openid = $_GPC['openid'];
     	$case = pdo_fetchall("select * from ".tablename("hyb_yl_user_case")." where uniacid=".$uniacid." and openid='".$openid."' and date='".$date."' order by id desc");
     	
     	foreach($case as &$cas)
	    {
	    	$cas['content'] = unserialize($cas['content']);
	    	$cas['created'] = date("m-d H:i:s",$cas['created']);
	    }
     	echo json_encode($case);
     	exit();
     }
     // 删除问诊记录
     public function delwenzhen()
     {
     	global $_W,$_GPC;
     	$uniacid = $_W['uniacid'];
     	$back_orser = $_GPC['back_orser'];
     	$typs = $_GPC['typs'];
     	if($typs == 'wenzhen')
     	{
     		$res = pdo_delete("hyb_yl_wenzorder",array("uniacid"=>$uniacid,"back_orser"=>$back_orser));
     	}else if($typs == 'tuwen')
     	{
     		$res = pdo_delete("hyb_yl_twenorder",array("uniacid"=>$uniacid,"back_orser"=>$back_orser));
     	}
     	if($res)
     	{
     		$data = array(
     			'code' => '1'
     		);
     	}else{
     		$data = array(
     			'code' => '0'
     		);
     	}
     	echo json_encode($data);
     	exit();

     }

     // 查询问诊记录
     public function usre_wenzhen()
     {
     	global $_W,$_GPC;
     	$uniacid = $_W['uniacid'];
     	$openid = $_GPC['openid'];
     	$tuwenorder = pdo_fetchall("select o.*,z.z_name as names from ".tablename("hyb_yl_twenorder")." as o left join ".tablename("hyb_yl_zhuanjia")." as z on o.zid=z.zid where o.uniacid=".$uniacid." and ifpay!=0 and o.openid='".$openid."' group by back_orser order by o.id desc");
        $biaoqian = $tuwenorder[0]['biaoqian'];
    	foreach($tuwenorder as &$tuwen)
    	{
    		$tuwen['typs'] = 'tuwen';
    		$tuwen['time'] = date("Y-m-d H:i:s",$tuwen['xdtime']);
    		$tuwen['types'] = '图文订单';
    	}
    	$wenzorder = pdo_fetchall("select o.*,z.z_name as names from ".tablename("hyb_yl_wenzorder")." as o left join ".tablename("hyb_yl_zhuanjia")." as z on o.zid=z.zid where o.uniacid=".$uniacid." and ifpay!=0 and o.openid='".$openid."' group by back_orser order by o.id desc");

    	foreach($wenzorder as &$wen)
    	{
    		$wen['typs'] = 'wenzhen';
    		$wen['time'] = date("Y-m-d H:i:s",$wen['time']);
    		if($wen['keywords'] == 'dianhuajizhen')
    		{
    			$wen['types'] = '电话问诊';
    		}else if($wen['keywords'] == 'shipinwenzhen')
    		{
    			$wen['types'] = '视频问诊';
    		}else if($wen['keywords'] == 'shoushukuaiyue')
    		{
    			$wen['types'] = '手术快约';
    		}else if($wen['keywords'] == 'tijianjiedu')
    		{
    			$wen['types'] = '报告解读';
    		}
    		
    	}
    	$wenzhenorder = array_merge($tuwenorder,$wenzorder);
    	echo json_encode($wenzhenorder);
    	exit();
     }
     // 获取用户当天的处方记录
     public function chufan_arr()
     {
     	global $_W,$_GPC;
     	$uniacid = $_W['uniacid'];
     	$time = $_GPC['time'];
     	$openid = $_GPC['openid'];
     	$content = pdo_fetchall("select * from".tablename('hyb_yl_goodsorders')."where uniacid='{$uniacid}' and createTime like '%$time%' and openid='{$openid}'");
	    
	    foreach ($content as $key => $value) {
	      $content[$key]['cartlist'] = unserialize($content[$key]['sid']);
          $content[$key]['timess'] = substr($content[$key]['createTime'], 0,10);
	      foreach ($content[$key]['cartlist'] as $k => $v) {
	        $zhiyaochang =pdo_get("hyb_yl_goodsarr",array('sid'=>$v['sid']),array('pp_title','ifcfy','adapt'));
	        
	        $content[$key]['cartlist'][$k]['zhiyaochang'] = $zhiyaochang['pp_title'];
	        $content[$key]['cartlist'][$k]['ifcfy'] = $zhiyaochang['ifcfy'];
	        $content[$key]['cartlist'][$k]['adapt'] = $zhiyaochang['adapt'];
	      }
	    }
	    echo json_encode($content);
	    die();
     }
     public function userchufang(){
     	global $_W,$_GPC;
     	$uniacid = $_W['uniacid'];
     
     	if($_W['isajax']){
	       	//处方单
	       $id = $_GPC['id'];

		   $content = pdo_fetch("select * from".tablename('hyb_yl_goodsorders')."as a left join".tablename('hyb_yl_userjiaren')."as b on b.openid=a.openid where a.uniacid='{$uniacid}' and a.id='{$id}'");

	
          $content['docdetail'] = pdo_fetch("select * from".tablename('hyb_yl_zhuanjia')."as a left join".tablename('hyb_yl_ceshi')."as b on b.id=a.parentid where a.uniacid='{$uniacid}' and a.zid='{$content['zid']}'");
	      $content['cartlist'] = unserialize($content['sid']);
          $content['content'] = unserialize($content['conets']);
          $content['users'] = pdo_get("hyb_yl_userinfo",array('openid'=>$content['openid']),array('randnum'));
	      foreach ($content['cartlist'] as $k => $v) {
	        $zhiyaochang =pdo_get("hyb_yl_goodsarr",array('sid'=>$v['sid']),array('pp_title','ifcfy','use'));
	        $content['cartlist'][$k]['zhiyaochang'] = $zhiyaochang['pp_title'];
	        $content['cartlist'][$k]['ifcfy'] = $zhiyaochang['ifcfy'];
	       
	      }

		   //message(error(0, $content), '', 'ajax');  
	      include $this->template("profile/chufangdan");
     	}

     }
     public function getmsg()
     {
     	global $_W,$_GPC;
     	$uniacid = $_W['uniacid'];
     	$back_orser = $_REQUEST['back_orser'];
     	$typs = $_REQUEST['typs'];
     	
     	if($typs == 'tuwen')
     	{
     		$list = pdo_fetchall("select o.*,z.z_name,z.advertisement from ".tablename("hyb_yl_twenorder")." as o left join ".tablename("hyb_yl_zhuanjia")." as z on o.zid=z.zid where o.uniacid=".$uniacid." and o.back_orser='".$back_orser."'");
     		
     		foreach($list as &$tuwen)
     		{
     			$tuwen['advertisement'] = tomedia($tuwen['advertisement']);
     			$tuwen['names'] = pdo_getcolumn("hyb_yl_userjiaren",array("j_id"=>$tuwen['j_id']),'names');
     			if(!$tuwen['names'])
     			{
     				$tuwen['names'] = pdo_getcolumn("hyb_yl_userinfo",array("openid"=>$tuwen['openid']),'u_name');
     			}
     			$tuwen['u_thumb'] = pdo_getcolumn("hyb_yl_userinfo",array("openid"=>$tuwen['openid']),'u_thumb');
     			$tuwen['content'] = unserialize($tuwen['content']);
     			$tuwen['time'] = date("Y-m-d H:i:s",$tuwen['xdtime']);
     			$jiaren = pdo_get("hyb_yl_userjiaren",array("j_id"=>$tuwen['j_id']));
     			if($jiaren['sick_index'] == '0')
     			{
     				$jiaren['gx'] = '本人';
     			}else if($jiaren['sick_index'] == '1')
     			{
     				$jiaren['gx'] = '家庭成员';
     			}else if($jiaren['sick_index'] == '2')
     			{
     				$jiaren['gx'] = '亲戚';
     			}else if($jiaren['sick_index'] == '3')
     			{
     				$jiaren['gx'] = '朋友';
     			}else if($jiaren['sick_index'] == '4')
     			{
     				$jiaren['gx'] = '其他';
     			}
     			$tuwen['jiaren'] = $jiaren;
     		}
     	}else if($typs == 'wenzhen')
     	{
     		$list = pdo_fetchall("select o.*,z.z_name,z.advertisement from ".tablename("hyb_yl_wenzorder")." as o left join ".tablename("hyb_yl_zhuanjia")." as z on o.zid=z.zid where o.uniacid=".$uniacid." and o.back_orser=".$back_orser);
     		foreach($list as &$wenzhen)
     		{
     			$wenzhen['advertisement'] = tomedia($wenzhen['advertisement']);
     			$wenzhen['names'] = pdo_getcolumn("hyb_yl_userjiaren",array("j_id"=>$wenzhen['j_id']),'names');
     			if(!$wenzhen['names'])
     			{
     				$wenzhen['names'] = pdo_getcolumn("hyb_yl_userinfo",array("openid"=>$wenzhen['openid']),'u_name');
     			}
     			$wenzhen['u_thumb'] = pdo_getcolumn("hyb_yl_userinfo",array("openid"=>$wenzhen['openid']),'u_thumb');
     			$wenzhen['content'] = unserialize($wenzhen['describe']);
     			$wenzhen['time'] = date("Y-m-d H:i:s",$wenzhen['time']);
     			$jiaren = pdo_get("hyb_yl_userjiaren",array("j_id"=>$wenzhen['j_id']));
     			if($jiaren['sick_index'] == '0')
     			{
     				$jiaren['gx'] = '本人';
     			}else if($jiaren['sick_index'] == '1')
     			{
     				$jiaren['gx'] = '家庭成员';
     			}else if($jiaren['sick_index'] == '2')
     			{
     				$jiaren['gx'] = '亲戚';
     			}else if($jiaren['sick_index'] == '3')
     			{
     				$jiaren['gx'] = '朋友';
     			}else if($jiaren['sick_index'] == '4')
     			{
     				$jiaren['gx'] = '其他';
     			}
     			$wenzhen['jiaren'] = $jiaren;
     		}
     	}
     	echo json_encode($list);
     	exit();
     }
     public function edituser()
     {
     	global $_W,$_GPC;
     	$uniacid = $_W['uniacid'];
     	$openid = $_GPC['openid'];
     	$typs = $_GPC['typs'];
     	
     	if($_W['ispost'])
     	{
     		if($typs == 'base')
     		{
     			$province = $_GPC['address']['province'];
     			if($province == '北京' || $province == '天津' || $province == '上海' || $province == '重庆')
     			{
     				$province = $province."市";
     			}
     			$city = $_GPC['address']['city'];
     			$district = $_GPC['address']['district'];
     			$age =$this->getAge($_GPC['datetime']);
     			$data = array(
	     			'uniacid' => $uniacid,
	     			"names" => $_GPC['names'],
	     			"sex" => $_GPC['sex'],
	     			"age" => $age,
	     			"datetime" => $_GPC['datetime'],
	     			"tel" => $_GPC['tel'],
	     			"numcard" => $_GPC['numcard'],
	     			"hunyin" => $_GPC['hunyin'],
	     			"zhiye" => $_GPC['zhiye'],
	     			"gan_index" => $_GPC['gan_index'],
	     			"shen_index" => $_GPC['shen_index'],
	     			"be_index" => $_GPC['be_index'],
	     			"openid" => $openid,
	     			"region" => $province.",".$city.",".$district
	     			
	 			);
     		}else if($typs == 'qita'){
     			$data = array(
	     			'uniacid' => $uniacid,
	     			"tizhong" => $_GPC['tizhong'],
	     			"shengao" => $_GPC['shengao'],
	     			"xuex" => $_GPC['xuex'],
	     			"openid" => $openid,
	 			);
     		}
     		
 			
 			$item = pdo_get("hyb_yl_userjiaren",array("openid"=>$openid,"sick_index"=>'0'));
 			if($item)
 			{
 				$res = pdo_update("hyb_yl_userjiaren",$data,array("openid"=>$openid,"sick_index"=>'0'));
 			}else{
 				$data['sick_index'] = '0';
 				$res = pdo_insert("hyb_yl_userjiaren",$data);
 			}
 			if($res)
            {
                message("编辑成功!",$this->CopysiteUrl("profile.userlist"),"success");
            }else{
                message("编辑失败!",$this->CopysiteUrl("profile.userlist"),"error");
            }
     	}
     	include $this->template("profile/userlist");
     }
	private function getAge($birthday) { 
          $age = 0; 
          $year = $month = $day = 0; 
          if (is_array($birthday)) { 
             extract($birthday); 
          } else { 
             if (strpos($birthday, '-') !== false) { 
             list($year, $month, $day) = explode('-', $birthday); 
             $day = substr($day, 0, 2); //get the first two chars in case of '2000-11-03 12:12:00' 
        } 
        } 
        $age = date('Y') - $year; 
        if (date('m') < $month || (date('m') == $month && date('d') < $day)) $age--; 
        return $age; 
    }
     // 修改用户家人信息
     public function edituser_list()
     {
     	global $_W,$_GPC;
     	$uniacid = $_W['uniacid'];
     	$j_id = $_GPC['j_id'];
     	$openid = $_GPC['openid'];
     	if($_W['ispost'])
     	{
     		$province = $_GPC['address']['province'];
 			if($province == '北京' || $province == '天津' || $province == '上海' || $province == '重庆')
 			{
 				$province = $province."市";
 			}
 			$city = $_GPC['address']['city'];
 			$district = $_GPC['address']['district'];

 			$data = array(
     			'uniacid' => $uniacid,
     			"names" => $_GPC['names'],
     			"sex" => $_GPC['sex'],
     			"datetime" => $_GPC['datetime'],
     			"tel" => $_GPC['tel'],
     			"numcard" => $_GPC['numcard'],
     			"hunyin" => $_GPC['hunyin'],
     			"zhiye" => $_GPC['zhiye'],
     			"gan_index" => $_GPC['gan_index'],
     			"shen_index" => $_GPC['shen_index'],
     			"be_index" => $_GPC['be_index'],
     			"openid" => $openid,
     			"region" => $province.",".$city.",".$district,
     			"tizhong" => $_GPC['tizhong'],
	     		"shengao" => $_GPC['shengao'],
	     		"xuex" => $_GPC['xuex'],
	     		"sick_index" => $_GPC['sick_index'],
 			);
 			if($j_id)
 			{
 				$res = pdo_update("hyb_yl_userjiaren",$data,array("j_id"=>$j_id));
 			}else{

 				$res = pdo_insert("hyb_yl_userjiaren",$data);
 			}
 			if($res)
            {
                message("编辑成功!",$this->CopysiteUrl("profile.userlist"),"success");
            }else{
                message("编辑失败!",$this->CopysiteUrl("profile.userlist"),"error");
            }
     	}
     	include $this->template("profile/userlist");
     }

     public function deleteuserjr()
     {
     	global $_W,$_GPC;
     	$uniacid = $_W['uniacid'];
     	$j_id = $_GPC['j_id'];
     	$res = pdo_delete("hyb_yl_userjiaren",array("j_id"=>$j_id));
     	if($res)
        {
            message("删除成功!",$this->CopysiteUrl("profile.userlist"),"success");
        }else{
            message("删除失败!",$this->CopysiteUrl("profile.userlist"),"error");
        }
        include $this->template("profile/userlist");
     }
   /**
   会员列表
   */
 	 public function hylist()
     {
		global $_W, $_GPC;
        
      
        include $this->template("profile/hylist");
     }
        public function deleteuser(){
         global $_W, $_GPC;
         $uniacid = $_W['uniacid'];
         $u_id = $_GPC['u_id'];
         $openid = pdo_getcolumn("hyb_yl_userinfo",array("u_id"=>$u_id),'openid');
         pdo_delete("hyb_yl_userinfo",array('u_id'=>$u_id));
         pdo_delete("hyb_yl_userjiaren",array("openid"=>$openid));
         pdo_delete("hyb_yl_chart_list",array("useropenid"=>$openid));
         pdo_delete("hyb_yl_chufang",array("useropenid"=>$openid));
         pdo_delete("hyb_yl_goodsorders",array("openid"=>$openid));
         pdo_delete("hyb_yl_guahaoorder",array("openid"=>$openid));
         pdo_delete("hyb_yl_attention",array("openid"=>$openid));
         pdo_delete("hyb_yl_share",array("openid"=>$openid));
         pdo_delete("hyb_yl_answer",array("openid"=>$openid));
         pdo_delete("hyb_yl_tank",array("openid"=>$openid));
         pdo_delete("hyb_yl_teamorder",array("openid"=>$openid));
         pdo_delete("hyb_yl_tijianorder",array("openid"=>$openid));
         pdo_delete("hyb_yl_twenorder",array("openid"=>$openid));
         pdo_delete("hyb_yl_user_address",array("openid"=>$openid));
         pdo_delete("hyb_yl_user_baogao",array("openid"=>$openid));
         pdo_delete("hyb_yl_user_coupon",array("openid"=>$openid));
         pdo_delete("hyb_yl_user_yearcard",array("openid"=>$openid));
         pdo_delete("hyb_yl_userbingli",array("openid"=>$openid));
         pdo_delete("hyb_yl_userchufang",array("openid"=>$openid));
         pdo_delete("hyb_yl_userdianz",array("openid"=>$openid));
         pdo_delete("hyb_yl_userinfo_credit_record",array("openid"=>$openid));
         pdo_delete("hyb_yl_vip_log",array("openid"=>$openid));
         pdo_delete("hyb_yl_visit",array("openid"=>$openid));
         pdo_delete("hyb_yl_wenzorder",array("openid"=>$openid));
         $data = array(
            'status'=>1,
          );
        echo json_encode($data);
        return false;
     }
     public function updateuserbli(){
         global $_W, $_GPC;
         $uniacid = $_W['uniacid'];
         $u_id = $_GPC['u_id'];
         $j_id = $_GPC['j_id'];
         $gan_index = $_GPC['gan_index'];
         $shen_index = $_GPC['shen_index'];
         $data = array(
              'shen_index' =>$shen_index,
              'gan_index' =>$gan_index
         	);
         pdo_update('hyb_yl_userjiaren',$data,array('j_id'=>$j_id));
         message('成功', 'refresh', 'success');
     }
     public function userbaogao(){
         global $_W, $_GPC;
         $uniacid = $_W['uniacid'];
         $id = $_GPC['id'];
         $hid = $_GPC['bm_id'];
        
         $res = pdo_get('hyb_yl_tijianorder',array('id'=>$id,'uniacid'=>$uniacid));

         $j_id =$res['j_id']; 
         $zid = $res['zid'];
         $user =  pdo_get('hyb_yl_userjiaren',array('j_id'=>$j_id));
         $data = unserialize($res['data']);
         $content = unserialize($res['content']);
         $doc = pdo_get('hyb_yl_zhuanjia',array('zid'=>$zid));
         $jigou = pdo_get('hyb_yl_hospital',array('hid'=>$hid));
         $jcyuan = pdo_get('hyb_yl_zhuanjia',array('openid'=>$jigou['openid']));

         $keshi_one = pdo_getcolumn("hyb_yl_classgory",array("uniacid"=>$uniacid,"id"=>$doc['z_room']),'ctname');
         $keshi_two = pdo_getcolumn("hyb_yl_ceshi",array("uniacid"=>$uniacid,"id"=>$doc['parentid']),'name');
         $list = unserialize($res['content']);
         $res['time'] =date("Y-m-d H:i:s",$res['time']);
         include $this->template("profile/baogao");
     }

     // 给用户发送消息
     public function sendmsg()
     {
     	global $_W,$_GPC;
     	$u_id = $_GPC['u_id'];
     	$uniacid = $_W['uniacid'];
		$userinfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_userinfo")." WHERE uniacid=:uniacid and u_id=:u_id",array(":uniacid"=>$uniacid,":u_id"=>$u_id));
		if($_W['ispost']){
			$text = $_GPC['text'];
	     	$result = pdo_fetch('SELECT * FROM ' . tablename('hyb_yl_parameter') . " where `uniacid`='{$uniacid}' ", array(":uniacid" => $uniacid));
	        $APPID = $result['appid'];
	        $SECRET = $result['appsecret'];
	        $wxapptemp = unserialize($result['wxapp_mb']);
       		$template_id = $wxapptemp['refundNotice']; 
	        $tokenUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$APPID}&secret={$SECRET}";
	        $getArr = array();
	        $tokenArr = json_decode($this->send_post($tokenUrl, $getArr, "GET"));
	        $access_token = $tokenArr->access_token;
	        
             $url = 'https://api.weixin.qq.com/cgi-bin/message/subscribe/send?access_token=' . $access_token;
             $data_time = date("Y-m-d H:i:s");
             $dd['data']  = [
             	'date1' => ['value' => date("Y-m-d H:i:s",time())],
                'thing2'   =>['value' =>'平台'],
                'thing3'   =>['value' =>'平台'],
                'thing4'   =>['value' =>$text],
              ];   
             $dd['touser'] = $userinfo['openid'];
             $dd['template_id'] = $template_id;
             $dd['page'] = 'hyb_yl/tabBar/index/index'; 
             $result = $this->https_curl_json($url, $dd, 'json');
             
	        
			if ($result) {
				
				die(json_encode(array('message'=>1)));
			}else{
				die(json_encode(array('message'=>0)));
			}
		}
     	
        
        include $this->template("profile/send");
     }
     public function https_curl_json($url, $data, $type) {
        if ($type == 'json') {
            $headers = array("Content-type: application/json;charset=UTF-8", "Accept: application/json", "Cache-Control: no-cache", "Pragma: no-cache");
            $data = json_encode($data);
        }
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $output = curl_exec($curl);
        if (curl_errno($curl)) {
            echo 'Errno' . curl_error($curl); //捕抓异常
            
        }
        curl_close($curl);
        return $output;
    }

     public function api_notice_increment($url, $data) {
        $ch = curl_init();
        // $header = "Accept-Charset: utf-8";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        //curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);
        if (curl_errno($ch)) {
            return false;
        } else {
            return $tmpInfo;
        }
    }
    public function send_post($url, $post_data, $method = 'POST') {
        $postdata = http_build_query($post_data);
        $options = array('http' => array('method' => $method, //or GET
        'header' => 'Content-type:application/x-www-form-urlencoded', 'content' => $postdata, 'timeout' => 15 * 60 // 超时时间（单位:s）
        ));
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        return $result;
    }

    // 添加报告
    public function edituser_baogao()
    {
    	global $_W,$_GPC;
    	$uniacid = $_W['uniacid'];
    	if($_W['ispost']){
			$data = array(
				'uniacid' => $uniacid,
				"openid" => $_GPC['openid'],
				"sharepic" => serialize($_GPC['sharepic']),
				"contents" => $_GPC['contents'],
				"times" => time(),
			);

			$res = pdo_insert("hyb_yl_user_baogao",$data);
			if($res)
            {
                message("编辑成功!",$this->CopysiteUrl("profile.userlist"),"success");
            }else{
                message("编辑失败!",$this->CopysiteUrl("profile.userlist"),"error");
            }
		}
		include $this->template("profile/edituser_baogao");
    }

    // 删除报告
    public function delbg()
    {
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $a_id = $_GPC['a_id'];
        $res = pdo_delete("hyb_yl_user_baogao",array("uniacid"=>$uniacid,"a_id"=>$a_id));
        if($res)
        {
            message("删除成功!",$this->CopysiteUrl("profile.userlist"),"success");
        }else{
            message("删除失败!",$this->CopysiteUrl("profile.userlist"),"error");
        }
        include $this->template("profile/userlist");
    }

    // 添加用户
    public function addusers()
    {
    	global $_W,$_GPC;
    	$uniacid = $_W['uniacid'];
    	if($_W['ispost'])
    	{
    		$data = array(
	    		'uniacid' => $uniacid,
	    		"u_name" => $_GPC['u_name'],
	    		"u_thumb" => $_GPC['u_thumb'],
	    		"u_type" => $_GPC['u_type'],
	    		"u_phone" => $_GPC['u_phone'],
	    		"u_sex" => $_GPC['u_sex'],
	    		"u_age" => $_GPC['u_age'],
	    		"money" => $_GPC['money'],
	    		"score" => $_GPC['score'],
	    		"zctime" => date("Y-m-d H:i:s",time()),
	    		"longtime" => date("Y-m-d H:i:s",time()),
	    		"randnum" => $this->initcode(),
	    	);
	    	$res = pdo_insert("hyb_yl_userinfo",$data);

	    	if($res)
            {
                message("编辑成功!",$this->CopysiteUrl("profile.userlist"),"success");
            }else{
                message("编辑失败!",$this->CopysiteUrl("profile.userlist"),"error");
            }
    	}
    	include $this->template("profile/addusers");
    }
    private function initcode(){
        $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
        $string=time();
        for(;$len>=1;$len--)
        {
            $position=rand()%strlen($chars);
            $position2=rand()%strlen($string);
            $string=substr_replace($string,substr($chars,$position,1),$position2,0);
        }
        return $string;
    }

	// 档案设置
	public function symptomset()
	{
		global $_W,$_GPC;
		$uniacid = $_W['uniacid'];
		// $item = pdo_get("hyb_yl_symptomset",array("uniacid"=>$uniacid));
		$list = pdo_getall("hyb_yl_symptomset",array("uniacid"=>$uniacid));
		foreach($list as &$value)
		{
			$value['content'] = unserialize($value['content']);
			$value['cons'] = "";
			foreach($value['content'] as &$cons)
			{
				$value['cons'] .= $cons['title'].",";
			}
		}
		include $this->template('profile/symptomset');
	}

	// 添加档案设置
	public function addsymptomset()
	{
		global $_W,$_GPC;
		$uniacid = $_W['uniacid'];
		$count = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_symptomset")." where uniacid=".$uniacid);
		$step = $count + 1;

		$id = $_GPC['id'];
		$item = pdo_get("hyb_yl_symptomset",array("uniacid"=>$uniacid,"id"=>$id));
		if($item)
		{
			$item['content'] = unserialize($item['content']);

		}
		if($_W['ispost'])
		{
			$items = pdo_get("hyb_yl_symptomset",array("uniacid"=>$uniacid,"step"=>$_GPC['step']));
			if($items && $item['step'] != $_GPC['step'])
			{
				message("该步骤已设置!",$this->CopysiteUrl("profile.symptomset"),"error");
			}
			$data = array(
				'uniacid' => $uniacid,
				"step" => $_GPC['step'],
				"content" => serialize($_GPC['content']),
			);
			
			if($id)
			{
				pdo_update("hyb_yl_symptomset",$data,array("uniacid"=>$uniacid,"id"=>$id));
			}else{
				$data['created'] = time();
				pdo_insert("hyb_yl_symptomset",$data);
			}
			message("设置成功!",$this->CopysiteUrl("profile.symptomset"),"success");
		}
		include $this->template('profile/addsymptomset');
	}

	// 删除档案设置
	public function delsymptomset()
	{
		global $_W,$_GPC;
		$id = $_GPC['id'];
		$res = pdo_delete("hyb_yl_symptomset",array("id"=>$id));
		if($res)
		{
			message("删除成功!",$this->CopysiteUrl("profile.symptomset"),"success");
		}else{
			message("删除失败!",$this->CopysiteUrl("profile.symptomset"),"error");
		}
		include $this->template('profile/symptomset');
	}
    
}
