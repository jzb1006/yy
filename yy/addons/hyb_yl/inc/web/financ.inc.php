<?php

global $_W,$_GPC;
$op = $_GPC['op'];
$_W['plugin'] = 'financ';
$uniacid = $_W['uniacid'];
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
if($op == 'index')
{
	$page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
    $where = " where a.uniacid=".$uniacid;
    $keywordtype = $_GPC['keywordtype'];
    $type_arr = pdo_getall("hyb_yl_docser_speck",array("uniacid"=>$uniacid));
    foreach($type_arr as $key => $ty)
    {
        if($type_arr[$key]['key_words'] == 'sirenyisheng')
        {
            unset($type_arr[$key]);
        }
    }
    if(is_agent == '1')
    {
        if($zjs != '')
        {
            $where .= " and a.zid in (".$zjs.")";
        }else{
            $where .= " and a.zid is NULL";
        }
        
    }
    $keyword = $_GPC['keyword'];
    $ftitle = empty($_GPC['ftitle']) ? '视频问诊' : $_GPC['ftitle'];
    $key_words = empty($_GPC['key_words']) ? 'shipinwenzhen' : $_GPC['key_words'];
    if($key_words == 'shipinwenzhen' || $key_words == 'dianhuajizhen' || $key_words == 'shoushukuaiyue' || $key_words == 'tijianjiedu')
    {
        $where .= " and a.keywords='".$key_words."'";
    }
    $start = empty($_GPC['start']) ? date("Y-m-d",strtotime("-1Months",time())) : $_GPC['start']; 
    $end = empty($_GPC['end']) ? date("Y-m-d",strtotime("+1days",time())) : $_GPC['end'];
    if($keywordtype == '1')
    {
    	$where .= " and z.z_name like '%$keyword%'";
    }else if($keywordtype == '2')
    {
    	$where .= " and a.orders like '%$keyword%'";
    }
    $start = empty($_GPC['start']) ? date("Y-m-d",strtotime("-1Months",time())) : $_GPC['start']; 
    $end = empty($_GPC['end']) ? date("Y-m-d",strtotime("+1days",time())) : $_GPC['end'];
    if($start != '' && $start != date("Y-m-d",strtotime("-1Months",time())) && $end != '' && $end != date("Y-m-d",strtotime("+1days",time())))
    {
    	if($key_words == 'tuwenwenzhen')
    	{
    		$where .= " and a.xdtime >=".strtotime($start)." and a.xdtime <=".strtotime($end);
    	}else
    	{
    		$where .= " and a.time>=".strtotime($start)." and a.time <=".strtotime($end);
    	}
    }

    if($key_words == 'tuwenwenzhen')
    {
        $list = pdo_fetchall("select a.*,z.z_name,z.advertisement from ".tablename("hyb_yl_twenorder")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=a.zid ".$where." group by back_orser order by a.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
        
        foreach($list as &$values)
        {
            $values['time'] = date("Y-m-d H:i:s",$values['xdtime']);
        }
        $total = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=a.zid ".$where."group by back_order");
        $total = count($total);
    }else if($key_words == 'shipinwenzhen' || $key_words == 'dianhuajizhen' || $key_words == 'shoushukuaiyue' || $key_words == 'tijianjiedu')
    {
        $where.= " and a.orders like '%$keyword%'"; 
        $list = pdo_fetchall("select a.*,z.z_name,z.advertisement from ".tablename("hyb_yl_wenzorder")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=a.zid ".$where." group by a.back_orser order by a.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
        


        foreach($list as &$val)
        {
            $val['time'] = date("Y-m-d H:i:s",$val['time']);
        }
        $total = pdo_fetchall("select count(*) from ".tablename("hyb_yl_wenzorder")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=a.zid ".$where." group by a.back_orser");
        $total = count($total);


    }else if($key_words == 'yuanchengkaifang')
    {
        $list = pdo_fetchall("select a.*,z.z_name,z.advertisement from ".tablename("hyb_yl_chufang")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=a.zid ".$where." group by a.back_orser order by a.c_id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
        
        
        foreach($list as &$vall)
        {
            $vall['time'] = date("Y-m-d H:i:s",$vall['time']);
        }
        $total = pdo_fetchall("select count(*) from ".tablename("hyb_yl_chufang")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=a.zid ".$where." group by a.back_orser");
        $total = count($total);
    }else if($key_words == 'yuanchengguahao')
    {
        $list = pdo_fetchall("select a.*,z.z_name,z.advertisement from ".tablename("hyb_yl_guahaoorder")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=a.zid ".$where." group by a.back_orser order by a.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
        foreach($list as &$vall)
        {
            $vall['time'] = date("Y-m-d H:i:s",$vall['time']);
        }

        $total = pdo_fetchall("select count(*) from ".tablename("hyb_yl_guahaoorder")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=a.zid ".$where." group by back_orser");
        $total = count($total);
    }
    foreach($list as &$value)
    {
        $value['advertisement'] = tomedia($value['advertisement']);
    }
	$pager = pagination($total, $pageindex, $pagesize);
    
    
	include $this->template("financ/index");
}
//退款列表
if($op == 'display1')
{
	$page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
    $where = " where a.uniacid=".$uniacid;
    $refund = $_GPC['refund'];
    $type_arr = pdo_getall("hyb_yl_docser_speck",array("uniacid"=>$uniacid));
    $keywordtype = $_GPC['keywordtype'];
    $keyword = $_GPC['keyword'];

    $start = $_GPC['time']['start']; 
    $end = $_GPC['time']['end'];
    $key_words = $_GPC['key_words'];
  
    if($key_words == ''){
        $where .="";
    }
    if($refund != '')
    {
    	$where .= " and a.refund=".$refund;
    }
    if($keywordtype == '1')
    {
    	$where .= " and a.orders like '%$keyword%'";
    }else if($keywordtype == '2')
    {
    	$where .= " and b.names like '%$keyword%'";
    }else if($keywordtype == '3')
    {
    	$where .= " and b.tel like '%$keyword%'";
    }
    if(!empty($start) && !empty($end) && $start != date("Y-m-d",strtotime("-1Months",time())) && $end != '' && $end != date("Y-m-d",strtotime("+1days",time())))
    {
    	$where .= " and a.created>=".strtotime($start)." and a.created<=".strtotime($end);
    }
    if($key_words != '')
    {
    	$where .= " and a.key_words='{$keyword}'";
    }


    $list = pdo_fetchall("select a.*,b.names,b.tel from".tablename('hyb_yl_refund')."as a left join".tablename('hyb_yl_userjiaren')."as b on b.j_id=a.j_id".$where." order by a.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);


    $total = pdo_fetchcolumn("select count(*) from".tablename('hyb_yl_refund')."as a left join".tablename('hyb_yl_userjiaren')."as b on b.j_id=a.j_id".$where);

    $pager = pagination($total, $pageindex, $pagesize);
	// $res = pdo_fetchall("select a.*,b.names from".tablename('hyb_yl_refund')."as a left join".tablename('hyb_yl_userjiaren')."as b on b.j_id=a.j_id where a.uniacid='{$uniacid}'");
	include $this->template("financ/display1");
}
// 退款审核
if($op == 'tk_change')
{
    header('Content-type:text/html; Charset=utf-8');
	$id = $_GPC['id'];
	$status = $_GPC['status'];
	$res = pdo_update("hyb_yl_refund",array("status"=>$status),array("id"=>$id));
   

	if($res)
	{

	  message("设置成功!",$this->createWebUrl("financ",array("op"=>"display1")),"success");
	}else{
	  message("设置失败!",$this->createWebUrl("financ",array("op"=>"display1")),"error");
	}
	include $this->template("financ/display1");
}
// 退款删除
if($op == 'tk_del')
{
	$id = $_GPC['id'];
	$res = pdo_delete("hyb_yl_refund",array("id"=>$id));
	if($res)
	{
	  message("删除成功!",$this->createWebUrl("financ",array("op"=>"display1")),"success");
	}else{
	  message("删除失败!",$this->createWebUrl("financ",array("op"=>"display1")),"error");
	}
	include $this->template("financ/display1");
}
// 提现状态修改
if($op == 'tx_change')
{
	$id = $_GPC['id'];
	$status = $_GPC['status'];
	$res = pdo_update("hyb_yl_pay",array("status"=>$status),array("id"=>$id));
	if($res)
	{
	  message("设置成功!",$this->createWebUrl("financ",array("op"=>"givemoney")),"success");
	}else{
	  message("设置失败!",$this->createWebUrl("financ",array("op"=>"givemoney")),"error");
	}
	include $this->template("financ/givemoney");
}
if($op == 'tx_change_money')
{
    $id = $_GPC['id'];
    $status = $_GPC['status'];
    $one_data = pdo_get('hyb_yl_refund',array('id'=>$id));
    require_once dirname(dirname(dirname(__FILE__)))."/wxtk.php";
    $res = pdo_get('hyb_yl_parameter', array('uniacid' => $_W['uniacid']));
    $mchid = $res['mch_id'];     //微信支付商户号 PartnerID 通过微信支付商户资料审核后邮件发送
    $appid = $res['appid']; //微信支付申请对应的公众号的APPID
    $apiKey = $res['pub_api'];  //https://pay.weixin.qq.com 帐户设置-安全设置-API安全-API密钥-设置API密钥
    $orderNo = $one_data['orders'];           //商户订单号（商户订单号与微信订单号二选一，至少填一个）
    $wxOrderNo = '';           //微信订单号（商户订单号与微信订单号二选一，至少填一个）
    $totalFee = floatval($one_data['money']);          //订单金额，单位:元
    $refundFee = floatval($one_data['money']);         //退款金额，单位:元
    $refundNo = 'refund_'.uniqid();    //退款订单号(可随机生成)
    $wxPay = new WxpayService($mchid,$appid,$apiKey);
    $refund_desc = '问诊退款';
    if($one_data['key_words']=='tuwenwenzhen'){
       
        $ims ='hyb_yl_twenorder';
    }
    if($one_data['key_words']=='yuanchengkaifang'){
       
        $ims ='hyb_yl_chufang';
    }
    if($one_data == 'dianhuajizhen' || $one_data == 'shipinwenzhen' || $one_data == 'tijianjiedu' || $one_data == 'shoushukuaiyue'){
       
        $ims ='hyb_yl_wenzorder';
    }
    $result = $wxPay->doRefund($totalFee, $refundFee, $refundNo, $wxOrderNo,$orderNo,$refund_desc);
    $json =  json_encode($result);
    $result1 = json_decode($json,true);

    if($result1['result_code']=='FAIL' && $result1['err_code']=='NOTENOUGH'){
     message($result1['err_code_des'],$this->createWebUrl("financ",array("op"=>"display1",'ac'=>'display1')),"error");
    }
    if($result1['result_code']=='FAIL' && $result1['err_code']=='ERROR'){
     message($result1['err_code_des'],$this->createWebUrl("financ",array("op"=>"display1",'ac'=>'display1')),"error");
    }
    if($result1['result_code']=='FAIL' && $result1['err_code']=='ORDERNOTEXIST'){
     message($result1['err_code_des'],$this->createWebUrl("financ",array("op"=>"display1",'ac'=>'display1')),"error");
    }
    if($result1['result_code']=='SUCCESS'){
     pdo_update("hyb_yl_refund",array("status"=>$status,'s_time'=>strtotime('now')),array("id"=>$id));
     //改变订单状态
     pdo_update($ims,array('ifpay'=>6),array('orders'=>$orderNo));
     message('确认成功',$this->createWebUrl("financ",array("op"=>"display1",'ac'=>'display1')),"success");
    }
    
    // message("确认成功!",$this->createWebUrl("financ",array("op"=>"givemoney")),"success");

    //include $this->template("financ/givemoney");
}
// 提现删除
if($op == 'tx_del')
{
	$id = $_GPC['id'];
	$res = pdo_delete("hyb_yl_pay",array("id"=>$id));
	if($res)
	{
	  message("设置成功!",$this->createWebUrl("financ",array("op"=>"givemoney")),"success");
	}else{
	  message("设置失败!",$this->createWebUrl("financ",array("op"=>"givemoney")),"error");
	}
	include $this->template("financ/givemoney");
}
//提现列表
if($op == 'givemoney')
{
	$page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
    $where = " where uniacid=".$uniacid." and cash=1";
    $style = $_GPC['style'];
    $status = $_GPC['status'];
    $start = empty($_GPC['start']) ? date("Y-m-d",strtotime("-1Months",time())) : $_GPC['start']; 
    $end = empty($_GPC['end']) ? date("Y-m-d",strtotime("+1days",time())) : $_GPC['end'];
    if($style != '')
    {
    	$where .= " and style=".$style;
    }
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
        
    $list = pdo_fetchall("select * from ".tablename("hyb_yl_pay").$where." order by id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);

    foreach($list as &$value)
    {
        $value['created'] = date("Y-m-d H:i:s",$value['created']);
        
        if($value['style'] == '0')
        {
            $doc = pdo_get("hyb_yl_guidance",array("id"=>$value['did']));
            $value['name'] = $doc['title'];
            $value['thumb'] = tomedia($doc['thumb']);
        }else if($value['style'] == '1')
        {
            $doc = pdo_get("hyb_yl_zhuanjia",array("zid"=>$value['zid']));
            $value['name'] = $doc['z_name'];
            $value['thumb'] = tomedia($value['advertisement']);
        }else if($value['style'] == '2')
        {
            $doc = pdo_get("hyb_yl_team",array("id"=>$value['tid']));
            $value['name'] = $doc['title'];
            $value['thumb'] = tomedia($doc['thumb']);
        }else if($value['style'] == '5')
        {
            $doc = pdo_get("hyb_yl_userinfo",array("openid"=>$value['openid']));
            $value['name'] = $doc['u_name'];
            $value['thumb'] = $doc['u_thumb'];
        }else if($value['style'] == '6')
        {
            $doc = pdo_get("hyb_yl_yaoshi",array("id"=>$value['yid']));
            $value['name'] = $doc['name'];
            $value['thumb'] = tomedia($doc['thumb']);
        }else if($value['style'] == '7')
        {
            $doc = pdo_get("hyb_yl_hospital",array("hid"=>$value['hid']));
            $value['name'] = $doc['agentname'];
            $value['thumb'] = $doc['thumb'];
        }

    }
    
    $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_pay").$where);
    $pager = pagination($total, $pageindex, $pagesize);
	include $this->template("financ/givemoney");
}
//平台账户
if($op == 'currentstore')
{
	include $this->template("financ/currentstore");
}
//代理账户
if($op == 'currentmy')
{
    $page = empty($_GPC['page']) ? "" : $_GPC['page'];
    $pageindex = max(1, intval($page));
    $pagesize = 10;
    $keyword = $_GPC['keyword'];
    $type = $_GPC['type'];
    
    $where = " where uniacid=".$uniacid." and style=7";
    $h_where = " where uniacid=".$uniacid;
    if($keyword != '')
    {
        $h_where .= " and agentname like '%$keyword%'";
    }
    
    if($type != '')
    {
        $h_where .= " and groupid=".$type;
    }

    $h_arr = pdo_fetchall("select hid from ".tablename("hyb_yl_hospital").$h_where);

    if(count($h_arr) > 0)
    {
        foreach($h_arr as &$hs)
        {
            $hids .= $hs['hid'].",";
        }
        $hids = substr($hids,0,strlen($hids)-1);
        $where .= " and hid in (".$hids.")";
    }else{
        $hids = "";
        $where .= " and hid = 0";
    }
    
    $list = pdo_fetchall("select * from ".tablename("hyb_yl_pay").$where." order by id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);

    foreach($list as &$value)
    {
        $value['h_money'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$value['hid']),'money');
        $value['agentname'] = pdo_getcolumn("hyb_yl_hospital",array("hid"=>$value['hid']),'agentname');
    }
    // $list = pdo_fetchall("select a.*,b.agentname,b.money as h_money from ".tablename("hyb_yl_pay")." as a left join ".tablename("hyb_yl_hospital")." as b on b.hid=a.hid ".$where." order by a.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
    
    // echo "<pre>";
    // var_dump($list);
    // exit();
    $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_hospital").$where);
    $pager = pagination($total, $pageindex, $pagesize);

    // if($keywordtype == '1')
    // {
    //     $where .= " and z.z_name like '%$keyword%'";
    // }else if($keywordtype == '2')
    // {
    //     $where .= " and a.back_order like '%$keyword%'";
    // }
    // if($start != '' && $start != date("Y-m-d",strtotime("-1Months",time())))
    // {
    //     $where .= " and a.paytime >=".$start;
    // }
    // if($end != '' && $end != date("Y-m-d",strtotime("+1days",time())))
    // {
    //     $where .= " and a.paytime <=".$end;
    // }
    // $list1 = pdo_fetchall("select a.*,z.z_name,z.hid from ".tablename("hyb_yl_wenzorder")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=a.zid ".$where." group by back_orser order by a.id desc");
    // foreach($list as &$value)
    // {
    //     if($value['keywords'] == 'shipinwenzhen')
    //     {
    //         $value['typs'] = '视频问诊';
    //     }else if($value['keywords'] == 'dianhuajizhen')
    //     {
    //         $value['typs'] = '电话急诊';
    //     }else if($value['keywords'] == 'shoushukuaiyue')
    //     {
    //         $value['typs'] = '手术快约';
    //     }else if($value['keywords'] == 'tijianjiedu')
    //     {
    //         $value['typs'] = '体检解读';
    //     }
    //     $value['paytime'] = date("Y-m-d H:i:s",$value['paytime']);
    //     $value['content'] = unserialize($value['describe']);
    //     $value['times'] = date("Y-m-d H:i:s",$value['time']);
    // }
    // $list2 = pdo_fetchall("select a.*,z.z_name,z.hid from ".tablename("hyb_yl_twenorder")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=a.zid ".$where." group by back_orser order by a.id desc");
    // foreach($list as &$tw)
    // {
    //     $tw['paytime'] = date("Y-m-d H:i:s",$tw['paytime']);
    //     $tw['typs'] = '图文问诊';
    //     $tw['times'] = date("Y-m-d H:i:s",$tw['xdtime']);
    //     $tw['content'] = unserialize($tw['content']);
    // }
    // $list3 = pdo_fetchall("select a.*,z.z_name,z.hid from ".tablename("hyb_yl_guahaoorder")." as a left join ".tablename("hyb_yl_zhuanjia")." as z  on z.zid=a.zid ".$where." group by a.back_orser order by a.id desc");
    // foreach($list3 as &$gh)
    // {
    //     $gh['content'] = unserialize($gh['describe']);
    //     $gh['paytime'] = date("Y-m-d H:i:s",$gh['paytime']);
    //     $gh['times'] = date("Y-m-d H:i:s",$gh['time']);
    //     $gh['typs'] = '挂号订单';
    // }
    // $list4 = pdo_fetchall("select a.*,z.z_name,z.hid from ".tablename("hyb_yl_chufang")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=a.zid ".$where."  group by a.back_orser order by a.cid desc");
    // foreach($list4 as &$cf)
    // {
    //     $cf['content'] = 
    // }
    // if($key_words == 'shipinwenzhen' || $key_words == 'dianhuajizhen' || $key_words == 'shoushukuaiyue' || $key_words == 'tijianjiedu')
    // {
    //     $where .= " and a.keywords='".$key_words."'";
    //     $list = pdo_fetchall("select a.*,z.z_name,z.hid from ".tablename("hyb_yl_wenzorder")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=a.zid ".$where." order by a.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
    //     foreach($list as &$value)
    //     {
    //         if($value['keywords'] == 'shipinwenzhen')
    //         {
    //             $value['typs'] = '视频问诊';
    //         }else if($value['keywords'] == 'dianhuajizhen')
    //         {
    //             $value['typs'] = '电话急诊';
    //         }else if($value['keywords'] == 'shoushukuaiyue')
    //         {
    //             $value['typs'] = '手术快约';
    //         }else if($value['keywords'] == 'tijianjiedu')
    //         {
    //             $value['typs'] = '体检解读';
    //         }
    //         $value['paytime'] = date("Y-m-d H:i:s",$value['paytime']);
    //     }
    //     $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_wenzorder")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=a.zid ".$where);
    //     $pager = pagination($total, $pageindex, $pagesize);
    // }else if($key_words == 'yuanchengkaifang')
    // {
    //     $list = pdo_fetchall("select a.*,z.z_name from ".tablename("hyb_yl_twenorder")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=a.zid ".$where." order by a.id desc limit ".($pageindex - 1) * $pagesize.",".$pagesize);
    //     foreach($list as &$value)
    //     {
    //         $value['paytime'] = date("Y-m-d H:i:s",$value['paytime']);
    //         $value['typs'] = '远程处方';
    //     }
    //     $total = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_twenorder")." as a left join ".tablename("hyb_yl_zhuanjia")." as z on z.zid=a.zid ".$where);
    //     $pager = pagination($total, $pageindex, $pagesize);
    // }
    

	include $this->template("financ/currentmy");
}
//结算设置
if($op == 'currentsite')
{
	$item = pdo_get("hyb_yl_jiesuan_set",array("uniacid"=>$uniacid));
    if($item)
    {
        $item['money'] = unserialize($item['money']);
        $item['pay_type'] = unserialize($item['pay_type']);
    }
    
	if($_W['ispost'])
	{

		$data = array(
			'uniacid' => $uniacid,
			"min_money" => $_GPC['min_money'],
			"reserve_money" => $_GPC['reserve_money'],
			"pay_type" => serialize($_GPC['pay_type']),
			"is_user" => $_GPC['is_user'],
			"is_agent" => $_GPC['is_agent'],
			"is_twitter" => $_GPC['is_twitter'],
			"expert_fee" => $_GPC['expert_fee'],
			"agent_fee" => $_GPC['agent_fee'],
			"interval_time" => $_GPC['interval_time'],
			"user_fee" => $_GPC['user_fee'],
            "lvtong_fee" => $_GPC['lvtong_fee'],
            "is_lvtong" => $_GPC['is_lvtong'],
            "lvtong_cash" => $_GPC['lvtong_cash'],
            "is_expert" => $_GPC['is_expert'],
            "content" => $_GPC['content'],
            "money" => serialize($_GPC['money']),
            "weixin_content" => $_GPC['weixin_content'],
            "zfb_content" => $_GPC['zfb_content'],
            "bank_content" => $_GPC['bank_content'],
            "hos_cut" => $_GPC['hos_cut'],
            "doc_cut" => $_GPC['doc_cut'],
            "card_cut" => $_GPC['card_cut'],
            "green_cut" => $_GPC['green_cut'],
            "team_cut" => $_GPC['team_cut'],
            "yaoshi_cut" => $_GPC['yaoshi_cut'],
		);
		if($item)
		{
			$res = pdo_update("hyb_yl_jiesuan_set",$data,array("uniacid"=>$uniacid));
		}else{
			$res = pdo_insert("hyb_yl_jiesuan_set",$data);
		}
		if($res)
	    {
	      message("设置成功!",$this->createWebUrl("financ",array("op"=>"currentsite")),"success");
	    }else{
	      message("设置失败!",$this->createWebUrl("financ",array("op"=>"currentsite")),"error");

	    }
	}
	include $this->template("financ/currentsite");
}
// 批量删除提现
if($op == 'del_givemoneys')
{
    $ids = $_GPC['ids'];
    for($i=0;$i<count($ids);$i++)
    {
        pdo_delete("hyb_yl_pay",array("id" => $ids[$i]));
    }
    die(json_encode(array('errno'=>1,'message'=>1)));
}

if($op == 'del_refunds')
{
    $ids = $_GPC['ids'];
    for($i=0;$i<count($ids);$i++)
    {
        pdo_delete("hyb_yl_refund",array("id" => $ids[$i]));
    }
    die(json_encode(array('errno'=>1,'message'=>1)));
}