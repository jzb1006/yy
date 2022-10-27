<?php

 class Docuser extends HYBPage
 { 
  
   public function orderguan()
  {
     global $_GPC, $_W;
     $model = Model('userjiaren');
     $uniacid = $_W['uniacid'];
     $zid = $_GPC['zid'];
     $guanzhu = pdo_fetchall("SELECT * FROM".tablename("hyb_yl_collect")."as a left join".tablename("hyb_yl_userinfo")."as b on b.openid=a.openid left join".tablename("hyb_yl_userjiaren")."as c on c.openid=b.openid and c.sick_index=1 where a.uniacid='{$uniacid}' and a.goods_id='{$zid}' and a.ifqianyue=2 order by a.id desc");
     echo json_encode($guanzhu);
  }
 //我签约的家庭医生
  public function jtdoc(){
    global $_GPC, $_W;
    $uniacid = $_W['uniacid'];
    $ordernum = $_GPC['ordernum'];
    $res = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_qianyueorder')."as a left join".tablename('hyb_yl_fwlist')."as b on b.ff_id=a.pid where a.uniacid='{$uniacid}' and a.ordernum ='{$ordernum}'");
    foreach ($res as $key => $value) {
    	$res[$key]['fw_startime'] = date("Y-m-d",$res[$key]['fw_startime']);
    	$res[$key]['overtime'] = date("Y-m-d",$res[$key]['overtime']);
    }
     echo json_encode($res);
  }
  public function pay(){
      global $_GPC, $_W;
      require_once dirname(dirname(dirname(__FILE__)))."/wxpay.php";
      $res = pdo_get('hyb_yl_parameter', array('uniacid' => $_W['uniacid']));
      $appid = $res['appid'];
      $openid = $_GPC['openid'];
      $mch_id = $res['mch_id'];
      $key = $res['pub_api'];
      $out_trade_no = $mch_id . time();
      $total_fee = $_GPC['z_tw_money'];
      if (empty($total_fee)) {
          $body = '订单付款';
          $total_fee = floatval(99 * 100);
      } else {
          $body = '订单付款';
          $total_fee = floatval($total_fee * 100);
      }
      $weixinpay = new WeixinPay($appid, $openid, $mch_id, $key, $out_trade_no, $body, $total_fee);
      $return = $weixinpay->pay();
      echo json_encode($return);
  }
  //更新订单状态
  public function updateorder(){
    global $_GPC, $_W;
    $uniacid = $_W['uniacid'];
    $q_id = $_GPC['q_id'];
    $res = pdo_update("hyb_yl_qianyueorder",array('ispay'=>1),array('q_id'=>$q_id));
    echo json_encode($res);
  }
  //取消申请
  public function updatequxiao(){
    global $_GPC, $_W;
    $uniacid = $_W['uniacid'];
    $q_id = $_GPC['q_id'];
    $res = pdo_delete("hyb_yl_qianyueorder",array('q_id'=>$q_id));
    echo json_encode($res);
  }
  //关注医生的用户
  public function orderguanzhu(){
    global $_GPC,$_W;
    $zid = $_GPC['zid'];
    $uniacid = $_W['uniacid'];
    $result = pdo_fetchall("SELECT a.*,b.openid,b.names,b.j_id,b.sex,b.age,c.u_id,c.u_name,c.u_thumb FROM".tablename("hyb_yl_qianyueorder")."as a left join".tablename("hyb_yl_userjiaren")."as b on b.j_id=a.j_id left join".tablename('hyb_yl_userinfo')."as c on c.openid=a.openid where a.zid='{$zid}' and a.uniacid='{$uniacid}' and  a.istg =1 and a.fenzuid =0 ");
    $count = pdo_fetchall("SELECT a.*,b.openid,b.names,b.j_id,b.sex,b.age,c.u_id,c.u_name,c.u_thumb FROM".tablename("hyb_yl_qianyueorder")."as a left join".tablename("hyb_yl_userjiaren")."as b on b.j_id=a.j_id left join".tablename('hyb_yl_userinfo')."as c on c.openid=a.openid where a.zid='{$zid}' and a.uniacid='{$uniacid}' and  a.istg =1  ");
    $data = array(
      'data' => $result,
      'count'=> $count
      );
    echo json_encode($data);
  }
  //用户分组
  public function orderguanfenzu(){
        global $_W, $_GPC;
        $zid = $_GPC['zid'];
        $uniacid = $_W['uniacid'];
        $guanzhu = pdo_fetchall("SELECT * FROM".tablename("hyb_yl_qianyueorder")."as a left join".tablename("hyb_yl_userjiaren")."as b on b.j_id=a.j_id left join".tablename("hyb_yl_myinfors")."as c on c.openid=b.openid where a.uniacid='{$uniacid}' and a.zid='{$zid}' and a.istg=1 order by a.q_id desc");

        
        echo json_encode($guanzhu);
  }
  //添加分组
  public function addfenzu(){
    global $_GPC,$_W;
    $zid = $_GPC['zid'];
    $uniacid = $_W['uniacid'];
    $op =$_GPC['op'];
    $data =array(
       'zid'     =>$_GPC['zid'],
       'uniacid' =>$uniacid,
       'fenzname'=>$_GPC['fenzname'],
        );
    if($op=='display'){
      $res =pdo_fetchall("SELECT * FROM".tablename("hyb_yl_zhuanjiafenzu")."where uniacid='{$uniacid}' and zid='{$zid}'  order by fenzuid desc");
      foreach ($res as $key => $value) {
        //查询分子下面人数
        $count = pdo_fetch("SELECT count(*) as count FROM".tablename('hyb_yl_qianyueorder')."where fenzuid='{$value['fenzuid']}'");
        $res[$key]['count'] =$count['count']; 
      }
      echo json_encode($res); 
    }
    if($op=='post'){
      $res =pdo_insert("hyb_yl_zhuanjiafenzu",$data);
      echo json_encode($res);
    }
    if($op=='update'){
     $fenzuid = $_GPC['fenzuid'];
     $res =pdo_update("hyb_yl_zhuanjiafenzu",$data,array('fenzuid'=>$fenzuid,'uniacid'=>$uniacid));
     echo json_encode($res);
    }
    if($op =="yidongfenz"){
     $q_id = $_GPC['q_id'];
     $data1= array(
        'fenzuid'=>0
      );
     $res =pdo_update("hyb_yl_qianyueorder",$data1,array('q_id'=>$q_id,'uniacid'=>$uniacid));
     echo json_encode($res);
    }
    if($op =='xiugaibeizhu'){
     $q_id = $_GPC['q_id'];
     $beizhu = $_GPC['beizhu'];
     $data2= array(
        'beizhu'=>$beizhu
      );
     $res =pdo_update("hyb_yl_qianyueorder",$data2,array('q_id'=>$q_id,'uniacid'=>$uniacid));
     echo json_encode($res);
    }
    if($op =='jieyue'){
     $q_id = $_GPC['q_id'];
     $jieyutext = $_GPC['jieyutext'];
     $data3= array(
        'jieyutext'=>$jieyutext,
        'istg' =>2
      );
     $res =pdo_update("hyb_yl_qianyueorder",$data3,array('q_id'=>$q_id,'uniacid'=>$uniacid));
     echo json_encode($res);
    }
  }
      public function ydfenzu(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $q_id = $_GPC['q_id'];
        $fenzuid =intval($_GPC['fenzuid']);
        $data = array(
         'fenzuid'=>$fenzuid
            );
        $rows = pdo_update("hyb_yl_qianyueorder",$data,array('uniacid' => $uniacid, 'q_id' =>$q_id));
        if($rows==1){
           echo '1';
         }else{
           echo '0';  
        }
    }
    ///
    public function fenzuuser(){
      global $_GPC, $_W;
      $uniacid = $_W['uniacid'];
      $op =$_GPC['op'];
      $fenzuid = $_GPC['fenzuid'];
      $zid = $_GPC['zid'];
      if($op=='display'){
         $res =pdo_fetchall("SELECT a.*,b.openid,b.names,b.j_id,b.sex,b.age,c.u_id,c.u_name,c.u_thumb FROM".tablename("hyb_yl_qianyueorder")."as a left join".tablename("hyb_yl_userjiaren")."as b on b.j_id=a.j_id left join".tablename('hyb_yl_userinfo')."as c on c.openid=a.openid where a.zid='{$zid}' and a.uniacid='{$uniacid}' and  a.istg =1 and a.fenzuid='{$fenzuid}' order by a.q_id desc");
        echo json_encode($res);
      }
      if($op=='sousuo'){
        $kewords=$_GPC['kewords'];
        $zid =$_GPC['zid'];
        $res = pdo_fetchall("SELECT * FROM".tablename("hyb_yl_qianyueorder")."as a left join".tablename("hyb_yl_userjiaren")."as b on b.openid=a.openid where a.uniacid='{$uniacid}' and a.zid='{$zid}' AND a.istg=1 AND (c.myname like '%{$kewords}%' or b.u_name like '%{$kewords}%')  order by a.q_id desc");
        echo json_encode($res);
      }
      if($op=='tybut'){
        $id  = $_GPC['id'];
        $res = pdo_update("hyb_yl_qianyueorder",array('istg'=>2),array('uniacid'=>$uniacid,'id'=>$id));
        echo json_encode($res);
      }
    }
}


