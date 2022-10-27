<?php
/**
* 
*/

class Coupon extends HYBPage{ 
    // 兑换优惠券
    public function exchange()
    {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $openid = $_GPC['openid'];
      $duihuanma = trim($_GPC['duihuanma']);
      $newtime = date("Y-m-d H:i:s",time());
      //查询兑换优惠券
      $duihuancoupon = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_coupon_code")." WHERE uniacid=:uniacid and code=:code and status=0 ",array(":uniacid"=>$uniacid,":code"=>$duihuanma));
      if (empty($duihuancoupon)) {
          $res = "兑换失败!兑换码输入错误!";
      }else{
          //查询优惠券详情
          $couponinfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_coupon")." WHERE uniacid=:uniacid and id=:id and state=0 and endtime>:newtime ",array(":uniacid"=>$uniacid,":id"=>$duihuancoupon['cid'],":newtime"=>$newtime));
          if (!empty($couponinfo)) {
              //查询用户是否兑换过
              $isduihuan = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_user_coupon")." WHERE uniacid=:uniacid and openid=:openid and coupon_id=:coupon_id and duihuanma=:duihuanma ",array(":uniacid"=>$uniacid,":openid"=>$openid,":coupon_id"=>$couponinfo['id'],":duihuanma"=>$duihuanma));

              if (!empty($isduihuan)) {
                  $res = "兑换失败！您已使用此兑换码兑换过，请勿重复使用";
              }else{
                  $res = "兑换成功!";

                  //增加个人优惠券
                  $data['uniacid'] = $uniacid;
                  $data['openid'] = $openid;
                  $data['coupon_id'] = $couponinfo['id'];
                  $data['coupon_name'] = $couponinfo['title'];
                  $data['createtime'] = date("Y-m-d H:i:s",time());
                  $data['type'] = $couponinfo['usagetype'];
                  $data['start_time'] = $couponinfo['starttime'];
                  $data['end_time'] = $couponinfo['endtime'];
                  $data['deductible_amount'] = $couponinfo['deductible_amount'];
                  $data['applicableservices'] = $couponinfo['applicableservices'];
                  $data['duihuanma'] = $duihuanma;
                  pdo_insert("hyb_yl_user_coupon",$data);
                  pdo_update("hyb_yl_coupon_code",array("status"=>"1"),array("id"=>$duihuancoupon['id']));
              }
          }else{
              //优惠券失效/禁用
              $res = "兑换失败！此优惠券已过期！";
          }
      }
      echo json_encode($res);
    }
    
    //个人中心我的优惠券
    public function userlist(){
       global $_W,$_GPC;
       $uniacid = $_W['uniacid'];
       $openid = $_GPC['openid'];
       $couindex = $_GPC['couindex'];
       $newtime = date("Y-m-d H:i:s",time());
       $wherecontion = "  WHERE uniacid=:uniacid and openid=:openid ";
       $wheredata['uniacid'] = $uniacid;
       $wheredata['openid'] = $openid;
       if ($couindex=='0') {
          //待使用
          $wherecontion .= " and status=:status and end_time > :newtime";
          $wheredata[':newtime'] = $newtime;
          $wheredata[':status'] = "0";
       }
       if ($couindex=='1') {
          //已使用
          $wherecontion .= " and status=:status ";
          $wheredata[':status'] = "1";
       }
       if ($couindex=='2') {
          //已过期
          $wherecontion .= " and end_time < :newtime ";
          $wheredata[':newtime'] = $newtime;
       }
       
       $list = pdo_fetchall("SELECT * FROM ".tablename("hyb_yl_user_coupon").$wherecontion." order by createtime desc ",$wheredata);
       if (!empty($list)) {
          foreach ($list as &$value) {
              //查询优惠券详情
              $couponinfo = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_coupon")." WHERE uniacid=:uniacid and id=:id ",array(":uniacid"=>$uniacid,":id"=>$value['coupon_id']));
              $value['coupon_name'] = $couponinfo['title'];
              //查询适用服务
              $shiyongfuwuid = $value['applicableservices'];
              $shiyongfuwu = pdo_fetchall("SELECT titlme FROM ".tablename("hyb_yl_docser_speck")." WHERE uniacid=:uniacid and id in($shiyongfuwuid)",array(":uniacid"=>$uniacid));
              $value['shiyongfuwu'] = $shiyongfuwu;

              //查询所属医院
              $hospital = pdo_fetch("SELECT * FROM ".tablename("hyb_yl_hospital")." where uniacid=:uniacid and hid=:hid ",array(":uniacid"=>$uniacid,":hid"=>$couponinfo['hid']));
              if (!empty($hospital)) {
                $value['hospital'] = $hospital['agentname'];
              }else{
                $value['hospital'] = '';
              }

          }
       }
       echo json_encode($list);
    }
} 


