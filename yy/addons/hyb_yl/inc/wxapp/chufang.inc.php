<?php
/**
* 
*/
 class chufang extends HYBPage
 { 
   public function doPagecflist()
   {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $openid = $_GPC['openid'];
      $index = $_GPC['index'];
      if($index =='0'){
        $where = "where uniacid ='{$uniacid}' AND openid='{$openid}' ";
      }
      if($index =='1'){
        $where = "where uniacid ='{$uniacid}' AND openid='{$openid}' and orderStatus=-2";
      }
      if($index =='2'){
        $where = "where uniacid ='{$uniacid}' AND openid='{$openid}' and orderStatus=0";
      } 
      if($index =='3'){
        $where = "where uniacid ='{$uniacid}' AND openid='{$openid}' and orderStatus=1";
      } 
      if($index =='4'){
        $where = "where uniacid ='{$uniacid}' AND openid='{$openid}' and orderStatus=2";
      }  

      $list  = pdo_fetchall('SELECT * FROM'.tablename('hyb_yl_goodsorders')."{$where} order by id desc");

      
      foreach ($list as $key => $value) {
        $list[$key]['cartlist']= unserialize($list[$key]['sid']);
        foreach ($list[$key]['cartlist'] as $k => $v) {

          $s_id = $v['s_id'];
          $list[$key]['cartlist'][$k]['zyf'] = pdo_fetch("SELECT title FROM".tablename('hyb_yl_store')."where uniacid='{$uniacid}' and id='{$s_id}' group by id");

        }
      }
      echo json_encode($list);
   }
   public function doPgedetail(){
      global $_GPC, $_W;
      $uniacid = $_W['uniacid'];
      $id = $_GPC['id'];
      $list  = pdo_fetch('SELECT * FROM'.tablename('hyb_yl_goodsorders')."where uniacid='{$uniacid}'and id='{$id}'");
      $list['content'] = unserialize($list['conets']);
      $list['cartlist'] = unserialize($list['sid']);
      $list['created'] = date("Y-m-d H:i:s",$list['createTime']);
      foreach ($list['cartlist'] as $k => $v) {
          $s_id = $v['sid'];
          $list['cartlist'][$k]['zyf'] = pdo_fetch("SELECT title FROM".tablename('hyb_yl_store')."where uniacid='{$uniacid}' and id='{$s_id}' group by id");
          $hid = pdo_getcolumn('hyb_yl_goodsarr',array('sid'=>$s_id),'jigou_two');

          $list['agentname'] = pdo_getcolumn('hyb_yl_hospital',array('hid'=>$hid),'agentname');
          $list['address'] = pdo_getcolumn('hyb_yl_hospital',array('hid'=>$hid),'address');
          $list['longitude'] = pdo_getcolumn('hyb_yl_hospital',array('hid'=>$hid),'longitude');
          $list['latitude'] = pdo_getcolumn('hyb_yl_hospital',array('hid'=>$hid),'latitude');
        }
      echo json_encode($list);
   }
   public function xufang(){
      global $_GPC, $_W;
      $uniacid = $_W['uniacid'];
      $id = $_GPC['id'];
      $list  = pdo_fetch('SELECT * FROM'.tablename('hyb_yl_goodsorders')."where uniacid='{$uniacid}'and id='{$id}'");
      $data = array(
        'uniacid' => $uniacid, 
        'u_id' => $list['u_id'], 
        'sid'  => $list['sid'], 
        'createTime' => date('Y-m-d H:i:s'), 
        'orderNo'    => $this->getordernum(), 
        'deliverMoney' => $list['deliverMoney'],  
        'totalMoney'   => $list['totalMoney'], 
        'num'          => $list['num'],  
        'addressId'    => $_GPC['addressId'], 
        'openid'       => $_GPC['openid'], 
        'ifCf'     => 1,
        'conets'   =>$list['conets'],
        'ifshop'   =>$list['ifshop'],
        'key_words'=>$list['key_words'],
        'j_id'     =>$list['j_id'],
        'cid'      =>$list['cid'],
        'zid'      =>$list['zid'],
        'xufang'   =>1
        );
        $res = pdo_insert('hyb_yl_goodsorders', $data);
        $id = pdo_insertid();
        $orderNo = pdo_get('hyb_yl_goodsorders',array('id'=>$id,'uniacid'=>$uniacid));
        echo json_encode($orderNo['orderNo']);
   }
    public function getordernum(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $res = pdo_get('hyb_yl_parameter', array('uniacid' => $_W['uniacid']));
        $mch_id = $res['mch_id'];
        $out_trade_no = $mch_id . time();
        return $out_trade_no;
     } 
}


