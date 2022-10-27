<?php
global $_W,$_GPC;
$op = $_GPC['op'];
$uniacid = $_W['uniacid'];
 $_W['plugin'] ='member';
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
	include $this->template("member/index");
}
if($op == 'svip')
{

	$page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
    $list = pdo_fetchall("select * from ".tablename("hyb_yl_vip")." where uniacid=".$uniacid." order by sort desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
    foreach($list as &$value)
    {
    	$value['quanyi'] = pdo_getcolumn("hyb_yl_vip_quanyi",array("id"=>$value['quanyi']),'title');
    }
    $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_vip")." where uniacid=".$uniacid);
    $pager = pagination($total, $pageindex, $pagesize);
	include $this->template("member/svip");
}
if($op == 'svipadd')
{
	$id = $_GPC['id'];
	$item = pdo_get("hyb_yl_vip",array("id"=>$id));
	$quanyi = pdo_getall("hyb_yl_vip_quanyi",array("uniacid"=>$uniacid,"status"=>'1'));
	if ($_W['ispost']) {
		$data = array(
			'title' => $_GPC['title'],
			"uniacid" => $_W['uniacid'],
			"content" => $_GPC['content'],
			"times" => $_GPC['times'],
			"price" => $_GPC['price'],
            "oldprice" => $_GPC['oldprice'],
			"times" => $_GPC['times'],
			"quanyi" => $_GPC['quanyi'],
			"num" => $_GPC['num'],
			"sort" => $_GPC['sort'],
			"is_xf" => $_GPC['is_xf'],
			"is_tuijian" => $_GPC['is_tuijian'],
			"status" => $_GPC['status'],
		);

		if($id)
		{
			$res = pdo_update("hyb_yl_vip",$data,array("id"=>$id));
		}else{
			$data['created'] = time();
			$res = pdo_insert("hyb_yl_vip",$data);
		}
		if($res)
		{
			message("编辑成功!",$this->createWebUrl("member",array("op"=>"svip")),"success");
		}else{
			message("编辑失败!",$this->createWebUrl("member",array("op"=>"svip")),"error");
		}

	}
	include $this->template("member/svipadd");
}
// 删除会员
if($op == 'del_vip')
{
	$id = $_GPC['id'];
	$res = pdo_delete("hyb_yl_vip",array("id"=>$id));
	if($res)
	{
		message("删除成功!",$this->createWebUrl("member",array("op"=>"svip")),"success");
	}else{
		message("删除失败!",$this->createWebUrl("member",array("op"=>"svip")),"error");
	}
	include $this->template("member/svip");
}
if($op == 'sviphistory')
{
	$page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
    $keywordtype = $_GPC['keywordtype'];
    $keyword = $_GPC['keyword'];
    $where = " where l.uniacid=:uniacid and l.type=0 ";
    $wheredata[':uniacid'] = $uniacid;
    if($keywordtype == '1')
    {
    	$where .= " and u.u_name like '%$keyword%' ";
    }else if($keywordtype == '2')
    {
    	$where .= " and u.u_phone like '%$keyword%' ";
    }else if($keywordtype == '3')
    {
    	$where .= " and v.title like '%$keyword%' ";
    }
    $list = pdo_fetchall("select l.*,u.u_name,u.u_phone,u.u_thumb,v.title,v.times from ".tablename("hyb_yl_vip_log")." as l left join ".tablename("hyb_yl_userinfo")." as u on u.openid=l.openid right join ".tablename("hyb_yl_vip")." as v on v.id=l.vip ".$where." order by l.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize,$wheredata);
    
    if (!empty($list)) {
       foreach($list as &$value){
            $value['p_time']  = date("Y-m-d H:i:s",$value['p_time']);
            $value['tk'] = pdo_fetchcolumn("select b.username from ".tablename("hyb_yl_tuikesite")." as a  left join ".tablename("hyb_yl_tuikesite")." as b on b.tkid=a.id where a.uniacid=".$uniacid." and a.openid='".$value['openid']."'");
        }
    }
    
    $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_vip_log")." as l left join ".tablename("hyb_yl_userinfo")." as u on u.openid=l.openid right join ".tablename("hyb_yl_vip")." as v on v.id=l.vip ".$where,$wheredata);
    $pager = pagination($total, $pageindex, $pagesize);
	include $this->template("member/sviphistory");
}
if($op == "sviphistorydelete"){
    for($i=0;$i<count($_GPC['ids']);$i++)
    {
        pdo_delete('hyb_yl_vip_log',array('id' =>$_GPC['ids'][$i]));
    }
    die(json_encode(array('errno'=>1,'message'=>1)));
}
if($op == 'renewal')
{
	$page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
    $keywordtype = $_GPC['keywordtype'];
    $keyword = $_GPC['keyword'];
    $where = " where l.uniacid=".$uniacid." and l.type=1";
    if($keywordtype == '1')
    {
    	$where .= " and u.u_name like '%$keyword%'";
    }else if($keywordtype == '2')
    {
    	$where .= " and u.u_phone like '%$keyword%'";
    }else if($keywordtype == '3')
    {
    	$where .= " and v.title like '%$keyword%'";
    }
    $list = pdo_fetchall("select l.*,u.u_name,u.u_phone,u.u_thumb,v.title,v.times from ".tablename("hyb_yl_vip_log")." as l left join ".tablename("hyb_yl_userinfo")." as u on u.openid=l.openid right join ".tablename("hyb_yl_vip")." as v on v.id=l.vip ".$where." order by l.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
    foreach($list as &$value)
    {
    	$value['p_time']  = date("Y-m-d H:i:s",$value['p_time']);
        $value['tk'] = pdo_fetchcolumn("select b.username from ".tablename("hyb_yl_tuikesite")." as a  left join ".tablename("hyb_yl_tuikesite")." as b on b.tkid=a.id where a.uniacid=".$uniacid." and a.openid='".$value['openid']."'");
    }
    $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_vip_log")." as l left join ".tablename("hyb_yl_userinfo")." as u on u.openid=l.openid right join ".tablename("hyb_yl_vip")." as v on v.id=l.vip ".$where);
    $pager = pagination($total, $pageindex, $pagesize);
	include $this->template("member/renewal");
}
if ($op == "renewaldelete") {
    for($i=0;$i<count($_GPC['ids']);$i++)
    {
        pdo_delete('hyb_yl_vip_log',array('id' =>$_GPC['ids'][$i]));
    }
    die(json_encode(array('errno'=>1,'message'=>1)));
}
if($op == 'donation')
{
	$page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
    $keywordtype = $_GPC['keywordtype'];
    $keyword = $_GPC['keyword'];
    $where = " where l.uniacid=".$uniacid." and l.type=2";
    if($keywordtype == '1')
    {
    	$where .= " and u.u_name like '%$keyword%'";
    }else if($keywordtype == '2')
    {
    	$where .= " and u.u_phone like '%$keyword%'";
    }else if($keywordtype == '3')
    {
    	$where .= " and v.title like '%$keyword%'";
    }
    $list = pdo_fetchall("select l.*,u.u_name,u.u_phone,u.u_thumb,v.title,v.times from ".tablename("hyb_yl_vip_log")." as l left join ".tablename("hyb_yl_userinfo")." as u on u.openid=l.openid right join ".tablename("hyb_yl_vip")." as v on v.id=l.vip ".$where." order by l.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
    foreach($list as &$value)
    {
        $value['give_name'] = $value['u_name'];
        $value['give_thumb'] = $value['u_thumb'];
        //领取者信息
        if ($value['receive']=='1') {
            $receive_user = pdo_get("hyb_yl_userinfo",array("openid"=>$value['s_openid']));
            $value['receive_name'] = $receive_user['u_name'];
            $value['receive_thumb'] = $receive_user['u_thumb'];
        }else{
            $value['receive_name'] = "无";
            
        }
    	
    }
    $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_vip_log")." as l left join ".tablename("hyb_yl_userinfo")." as u on u.openid=l.openid right join ".tablename("hyb_yl_vip")." as v on v.id=l.vip ".$where);
    $pager = pagination($total, $pageindex, $pagesize);
	include $this->template("member/donation");
}
if ($op == "donationdelete") {
    for($i=0;$i<count($_GPC['ids']);$i++)
    {
        pdo_delete('hyb_yl_vip_log',array('id' =>$_GPC['ids'][$i]));
    }
    die(json_encode(array('errno'=>1,'message'=>1)));
}
if($op == 'svipsys')
{
	$page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
    $where = " where uniacid=".$uniacid;
    $keyword = $_GPC['keyword'];
    if($keyword != '')
    {
    	$where .= " and title like '%$keyword%'";
    }
    $status = $_GPC['status'];
    if($status == '1')
    {
    	$where .= " and status=1";
    }else if($status == '2')
    {
    	$where .= " and status=0";
    }
    $list = pdo_fetchall("select * from ".tablename("hyb_yl_vip_quanyi").$where." order by sort desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
    foreach($list as &$value)
    {
    	if(strpos($value['thumb'],'http') === false)
    	{
    		$value['thumb'] = $_W['attachurl'].$value['thumb'];
    	}
    }
    $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_vip_quanyi").$where);
    $pager = pagination($total, $pageindex, $pagesize);
	include $this->template("member/svipsys");
}

if($op == 'del_svipsys')
{
    for($i=0;$i<count($_GPC['ids']);$i++)
    {
        pdo_delete('hyb_yl_vip_quanyi',array('id' =>$_GPC['ids'][$i]));
    }
    die(json_encode(array('errno'=>1,'message'=>1)));
}
if($op == 'svipsysadd')
{
	$id = $_GPC['id'];
	$item = pdo_get("hyb_yl_vip_quanyi",array("id"=>$id));
	$item['quanyi'] = json_decode($item['quanyi'],true);

	$fuwu = pdo_fetchall("select * from".tablename('hyb_yl_docser_speck')."where uniacid =".$uniacid);

	if($_W['ispost'])
	{
		$data = array(
			'uniacid' => $_W['uniacid'],
			"title" => $_GPC['title'],
			"type" => $_GPC['type'],
			"quanyi" => json_encode($_GPC['quanyi'],true),
			"zhekou" => $_GPC['zhekou'],
			"is_mianfei" => $_GPC['is_mianfei'],
			"mianfei_num" => $_GPC['mianfei_num'],
			"xianzhi" => $_GPC['xianzhi'],
			"mfwz_num" => $_GPC['mfwz_num'],
			"content" => $_GPC['content'],
			"sort" => $_GPC['sort'],
			"status" => $_GPC['status'],
			"thumb" => $_GPC['thumb'],
		);
		if($id)
		{
			$res = pdo_update("hyb_yl_vip_quanyi",$data,array("id"=>$id));
		}else{
			$data['created'] = time();

			$res = pdo_insert("hyb_yl_vip_quanyi",$data);
		}
		if($res)
		{
			message("编辑成功!",$this->createWebUrl("member",array("op"=>"svipsys")),"success");
		}else{
			message("编辑失败!",$this->createWebUrl("member",array("op"=>"svipsys")),"error");
		}
	}
	include $this->template("member/svipsysadd");
}
// 删除权益设置
if($op == 'svipsysdel')
{
	$id = $_GPC['id'];
	$res = pdo_delete("hyb_yl_vip_quanyi",array("id"=>$id));
	if($res)
	{
		message("删除成功!",$this->createWebUrl("member",array("op"=>"svipsys")),"success");
	}else{
		message("删除失败!",$this->createWebUrl("member",array("op"=>"svipsys")),"error");
	}
	include $this->template("member/svipsys");
}
//基础设置
if ($op == "svipsetting") {
    $items = pdo_fetch("select * from ".tablename("hyb_yl_vip_setting")." where uniacid=:uniacid",array(":uniacid"=>$uniacid));
    if($_W['ispost'])
    {
        $data['uniacid'] = $uniacid;
        $data['setting_title'] = trim($_GPC['setting_title']);
        $data['setting_goumai_content'] = trim($_GPC['setting_goumai_content']);
        $data['setting_zengsong_content'] = trim($_GPC['setting_zengsong_content']);
        $data['setting_goumai_thumb'] = $_GPC['setting_goumai_thumb'];
        $data['setting_zengsong_thumb'] = $_GPC['setting_zengsong_thumb'];
        if (empty($items)) {
            $res = pdo_insert("hyb_yl_vip_setting",$data);
        }else{
            $res = pdo_update("hyb_yl_vip_setting",$data,array("id"=>$items['id']));
        }
        if($res)
        {
            message("编辑成功!",$this->createWebUrl("member",array('ac'=>"svipsetting","op"=>"svipsetting")),"success");
        }else{
            message("编辑失败!",$this->createWebUrl("member",array('ac'=>"svipsetting","op"=>"svipsetting")),"error");
        }
    }
    include $this->template("member/svipsetting");
}
if($op == 'integral')
{
    $page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 100;

    $where = " where uc.uniacid=:uniacid and uc.credittype=:credittype ";
    $wheredata[":uniacid"] = $uniacid;
    $wheredata[":credittype"] = "credit1";

    $keyword = !empty($_GPC['keyword'])?$_GPC['keyword']:"";
    if(!empty($keyword))
    {
        $where .= " and (u.u_name like :keywords or u.u_phone like :keywords)";
        $wheredata[":keywords"] = '%'.$keyword.'%';
    }
    $timetype = !empty($_GPC['timetype'])?$_GPC['timetype']:"";
    if (empty($timetype)) {
        $starttime = date("Y-m-d",strtotime('-1 month'));
        $endtime = date("Y-m-d",time());
    }else{
        $starttime = $_GPC['time_limit']['start'];
        $endtime = $_GPC['time_limit']['end'];
        if (!empty($starttime)  && !empty($endtime)) {
            $where.= " and uc.createtime >= :starttime and uc.createtime <= :endtime ";
            $wheredata[':starttime'] = strtotime($starttime);
            $wheredata[':endtime'] = strtotime($endtime);
        }
    }
    $list = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_userinfo_credit_record")." as uc left join ".tablename("hyb_yl_userinfo")." as u on uc.openid=u.openid ".$where." order by uc.createtime desc limit ".($pageindex - 1) * $pagesize.",".$pagesize,$wheredata);

    $total = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_userinfo_credit_record")." as uc left join ".tablename("hyb_yl_userinfo")." as u on uc.openid=u.openid ".$where."  order by uc.createtime desc ",$wheredata);
    $pager = pagination($total, $pageindex, $pagesize);
	include $this->template("member/integral");
}
if ($op == "integraldelete") {
    for($i=0;$i<count($_GPC['ids']);$i++)
    {
        pdo_delete('hyb_yl_userinfo_credit_record',array('id' =>$_GPC['ids'][$i]));
    }
    die(json_encode(array('errno'=>1,'message'=>1)));
}
if($op == 'balance')
{
    $page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 100;

    $where = " where uc.uniacid=:uniacid and uc.credittype=:credittype ";
    $wheredata[":uniacid"] = $uniacid;
    $wheredata[":credittype"] = "credit2";

    $keyword = !empty($_GPC['keyword'])?$_GPC['keyword']:"";
    if(!empty($keyword))
    {
        $where .= " and (u.u_name like :keywords or u.u_phone like :keywords)";
        $wheredata[":keywords"] = '%'.$keyword.'%';
    }
    $timetype = !empty($_GPC['timetype'])?$_GPC['timetype']:"";
    if (empty($timetype)) {
        $starttime = date("Y-m-d",strtotime('-1 month'));
        $endtime = date("Y-m-d",time());
    }else{
        $starttime = $_GPC['time_limit']['start'];
        $endtime = $_GPC['time_limit']['end'];
        if (!empty($starttime)  && !empty($endtime)) {
            $where.= " and uc.createtime >= :starttime and uc.createtime <= :endtime ";
            $wheredata[':starttime'] = strtotime($starttime);
            $wheredata[':endtime'] = strtotime($endtime);
        }
    }
    $list = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_userinfo_credit_record")." as uc left join ".tablename("hyb_yl_userinfo")." as u on uc.openid=u.openid ".$where." order by uc.createtime desc limit ".($pageindex - 1) * $pagesize.",".$pagesize,$wheredata);

    $total = pdo_fetchcolumn("SELECT count(*) FROM ".tablename("hyb_yl_userinfo_credit_record")." as uc left join ".tablename("hyb_yl_userinfo")." as u on uc.openid=u.openid ".$where."  order by uc.createtime desc ",$wheredata);
    $pager = pagination($total, $pageindex, $pagesize);

	include $this->template("member/balance");
}
if ($op == "balancedelete") {
    for($i=0;$i<count($_GPC['ids']);$i++)
    {
        pdo_delete('hyb_yl_userinfo_credit_record',array('id' =>$_GPC['ids'][$i]));
    }
    die(json_encode(array('errno'=>1,'message'=>1)));
}