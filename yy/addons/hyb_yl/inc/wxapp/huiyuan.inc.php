<?php
/**
* 
*/
 class Huiyuan extends HYBPage
 { 

    //会员卡设置
    public function setting(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $openid  = $_GPC['openid'];
        $info = pdo_fetch("select * from ".tablename("hyb_yl_vip_setting")." where uniacid=:uniacid",array(":uniacid"=>$uniacid));
        if (!empty($info['setting_goumai_thumb'])) {
            $info['setting_goumai_thumb'] = $_W['attachurl'].$info['setting_goumai_thumb'];
        }
        if (!empty($info['setting_zengsong_thumb'])) {
            $info['setting_zengsong_thumb'] = $_W['attachurl'].$info['setting_zengsong_thumb'];
        }
        if (empty($info['setting_title'])) {
            $info['setting_title'] = "";
        }
        if (empty($info['setting_goumai_content'])) {
            $info['setting_goumai_content'] = "";
        }
        if (empty($info['setting_zengsong_content'])) {
            $info['setting_zengsong_content'] = "";
        }
            

        // 判断用户是否购买过会员
        $userinfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_userinfo")." WHERE uniacid=:uniacid and openid=:openid ",array(":uniacid"=>$uniacid,":openid"=>$openid));
        $info['userbuystatus'] = $userinfo['admintype'];

        echo json_encode($info);
    }

    //会员卡列表
    public function allhuiyuan(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $list = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_vip")." where uniacid=:uniacid order by sort desc ",array(":uniacid"=>$uniacid));
        if (!empty($list)) {
            foreach ($list as &$value) {
                //查询权益
                $quanyi = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_vip_quanyi")." where uniacid=:uniacid and id=:id ",array(":uniacid"=>$uniacid,":id"=>$value['quanyi']));
                $value['quanyi_thumb'] = $_W['attachurl'].$quanyi['thumb'];
                $value['quanyi_content'] = htmlspecialchars_decode($quanyi['content']);
            }
        }
        echo json_encode($list);
    }


    //支付
    public function pay() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        require_once dirname(dirname(dirname(__FILE__)))."/wxpay.php";
        $res = pdo_get('hyb_yl_parameter', array('uniacid' => $_W['uniacid']));
        $appid = $res['appid'];
        $openid = $_GPC['openid'];
        $mch_id = $res['mch_id'];
        $key = $res['pub_api'];
        $out_trade_no = $mch_id . time();
        $total_fee = $_GPC['payprice'];
        $goodsnoturl = 'http://'.$_SERVER['SERVER_NAME'].'/addons/hyb_yl/goodsnoturl.php'; //通知地址 
        if (empty($total_fee)) {
            $body = '订单付款';
            $total_fee = floatval(99 * 100);
        } else {
            $body = '订单付款';
            $total_fee = floatval($total_fee * 100);
        }
        $weixinpay = new WeixinPay($appid, $openid, $mch_id, $key, $out_trade_no, $body, $total_fee,$goodsnoturl);
        $return = $weixinpay->pay();
        $return['ordersn'] = $out_trade_no;
        echo json_encode($return);
    } 

    public function payaddhuiyuan(){
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $openid = $_GPC['openid'];
        $payhid = $_GPC['payhid'];
        $ordersn = $_GPC['ordersn'];
        $type = $_GPC['type'];

        //查询会员卡
        $huiyuaninfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_vip")." where uniacid=:uniacid and id=:id ",array(":uniacid"=>$uniacid,":id"=>$payhid));

        //查询购买者用户信息
        $userinfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_userinfo")." WHERE uniacid=:uniacid and openid=:openid ",array(":uniacid"=>$uniacid,":openid"=>$openid));

        $data['uniacid'] = $uniacid;
        $data['openid'] = $openid;
        $data['u_name'] = $userinfo['u_name'];
        $data['vip'] = $huiyuaninfo['id'];
        $data['price'] = $huiyuaninfo['price'];
        $data['status'] = "1";
        $data['created'] = time();
        $data['p_time']  = time();
        $data['type'] = $type;
        $data['ordersn'] = $ordersn;
        

        $shichang = $huiyuaninfo['times'];
        $newdaytime = time();
        if ($type!='2') {
            if ($newdaytime<$userinfo['adminguanbi']) {
                $data['starttime'] = $userinfo['adminguanbi'];
                $data['endtime'] = strtotime("+$shichang day",$userinfo['adminguanbi']);
            }else{
                $data['starttime'] = $newdaytime;
                $data['endtime'] = strtotime("+$shichang day",$newdaytime);
            }
        }else{
            $data['starttime'] = $newdaytime;
            $data['endtime'] = strtotime("+$shichang day",$newdaytime);
        }
        $data['shichang'] = $shichang;
        
        pdo_insert("hyb_yl_vip_log",$data);

        if ($type!='2') {
            //修改用户会员信息
            $savemember['adminuserdj'] = $huiyuaninfo['id'];
            if ($type=='0') {  //开通
                $savemember['adminoptime'] = time();
                $adminguanbi = time();
            }
            if ($type=='1') {  //续费
                
                if ($newdaytime<$userinfo['adminoptime']) {
                    $savemember['adminoptime'] = time();
                }
                if ($newdaytime<$userinfo['adminguanbi']) {
                    $adminguanbi = $userinfo['adminguanbi'];
                }else{
                    $adminguanbi = time();
                }
                
            }
            $savemember['adminguanbi'] = strtotime("+$shichang day",$adminguanbi);
            $savemember['admintype'] = "1";
            pdo_update("hyb_yl_userinfo",$savemember,array("u_id"=>$userinfo['u_id']));

        }
        if ($type=='2') {
            

            $buyid = pdo_insertid();
            $orders = pdo_get('hyb_yl_vip',array('id'=>$buyid));
            $shuju =array(
               'id'=>$buyid,
               'orders'=>$ordersn
                );
            echo json_encode($shuju);
        }
        
    }


    //会员购买记录
    public function buyhistory(){
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $openid = $_GPC['openid'];
        $list = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_vip_log")." where uniacid=:uniacid and openid=:openid order by id desc ",array(":uniacid"=>$uniacid,":openid"=>$openid));
        if (!empty($list)) {
            foreach ($list as &$value) {

                $value['starttime'] = date("Y-m-d",$value['starttime']);
                $value['endtime'] = date("Y-m-d",$value['endtime']);

                //查询会员卡
                $huiyuaninfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_vip")." where uniacid=:uniacid and id=:id ",array(":uniacid"=>$uniacid,":id"=>$value['vip']));
                //查询权益
                $quanyi = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_vip_quanyi")." where uniacid=:uniacid and id=:id ",array(":uniacid"=>$uniacid,":id"=>$huiyuaninfo['quanyi']));
                $value['huiyuan_title'] = $huiyuaninfo['title'];
                $value['huiyuan_thumb'] = $_W['attachurl'].$quanyi['thumb'];

                $shiyongxianzhi = "";
                if (!empty($quanyi['zhekou'])) {
                    $zhekou = $quanyi['zhekou']*10;
                    $shiyongxianzhi.= ' 享'.$zhekou.'折优惠';
                }
                if (!empty($quanyi['xianzhi'])) {
                    $shiyongxianzhi.= ' '.$quanyi['xianzhi'];
                }
                if ($quanyi['is_mianfei']=='1') {
                    if (!empty($quanyi['mianfei_num'])) {
                        $shiyongxianzhi.= ' 免费追问'.$quanyi['mianfei_num'].'次';
                    } 
                }
                if (!empty($quanyi['mfwz_num'])) {
                    $shiyongxianzhi.= ' 免费问诊'.$quanyi['mfwz_num'].'次';
                }else{
                    $shiyongxianzhi.= ' 永久免费问诊';
                }
                $value['shiyongxianzhi'] = $shiyongxianzhi;

            }
        }
        echo json_encode($list);
    }


    //会员卡赠送
    public function zengsong_give(){
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $openid = $_GPC['openid'];
        $buyId = $_GPC['buyId'];
        $zhufu = !empty($_GPC['zhufu'])?$_GPC['zhufu']:"";
        //查询购买记录
        $buyhistory = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_vip_log")." where uniacid=:uniacid and id=:id ",array(":uniacid"=>$uniacid,":id"=>$buyId));
        if (!empty($buyhistory) && $buyhistory['receive']=='0') {
            $data['s_content'] = $zhufu;
            $res = pdo_update("hyb_yl_vip_log",$data,array("id"=>$buyId));
        }
    }

    //会员卡领取
    public function zengsong_lingqu(){
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $receiveid = $_GPC['receiveid'];
        

        //查询购买记录
        $buyhistory = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_vip_log")." where uniacid=:uniacid and id=:id ",array(":uniacid"=>$uniacid,":id"=>$receiveid));
        if (!empty($buyhistory) && $buyhistory['receive']=='0') {
            $data['s_openid'] = $_GPC['openid'];
            $data['receive'] = "1";
            $data['receive_time'] = time();
            $res = pdo_update("hyb_yl_vip_log",$data,array("id"=>$receiveid));
            if ($res) {
                echo "领取成功";
            }else{
                echo "领取失败";
            }
        }else{
            echo "领取失败";
        }
    }
    public function zengsong_lingquinfo(){
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $receiveid = $_GPC['receiveid'];
        //查询购买记录
        $buyhistory = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_vip_log")." where uniacid=:uniacid and id=:id ",array(":uniacid"=>$uniacid,":id"=>$receiveid));
        echo json_encode($buyhistory);
    }
}


