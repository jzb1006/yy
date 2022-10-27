<?php
/**
* 
*/
 class Huanjiao extends HYBPage
 { 
//手术预约详情
   public function allhjfenl()
  {
     global $_GPC, $_W;
     $uniacid = $_W['uniacid'];
     $zid = $_GPC['zid'];
     $hj_id = $_GPC['hj_id'];
     $res = pdo_fetchall('SELECT * FROM' . tablename('hyb_yl_hjfenl') . "WHERE uniacid ='{$uniacid}' ");
     $WHERE ="WHERE a.uniacid='{$uniacid}' ";
     if(empty($zid) || $zid=='undefined'){
        $WHERE .="and a.h_tuijian=1";
     }else{
        $WHERE .=" and a.zid='{$zid}'";
     }
     if(!empty($hj_id)){
        $WHERE .=" and a.h_flid='{$hj_id}'";
     }
     $list = pdo_fetchall('SELECT * FROM' . tablename('hyb_yl_hjiaosite') . " as a left join".tablename('hyb_yl_hjfenl')."as b on b.hj_id=a.h_flid ".$WHERE."  order by a.h_id desc");


     if(!empty($zid)){
      $dianzan = pdo_fetchcolumn("SELECT SUM(`h_dianzan`) FROM".tablename('hyb_yl_hjiaosite')."where zid='{$zid}'");
      $read = pdo_fetchcolumn("SELECT SUM(`h_read`) FROM".tablename('hyb_yl_hjiaosite')."where zid='{$zid}'");
      $zhuanfa = pdo_fetchcolumn("SELECT SUM(`h_zhuanfa`) FROM".tablename('hyb_yl_hjiaosite')."where zid='{$zid}'");
     }

     foreach ($list as $key => $value) {

         $list[$key]['h_pic'] = $_W['attachurl'] . $list[$key]['h_pic'];
         $list[$key]['created'] = date('Y-m-d', $list[$key]['created']);
     }

      $data['fenl'] =$res;
      $data['hjlist'] =$list;
     if(!empty($zid)){
      $data['dianzan'] =$dianzan;
      $data['read'] =$read;
      $data['zhuanfa'] =$zhuanfa;
     }
     echo json_encode($data);
  }
//患教详情
  public function detail(){
    global $_GPC,$_W;
    $uniacid = $_W['uniacid'];
    $h_id = $_GPC['h_id'];
    $sql = "SELECT * FROM".tablename("hyb_yl_hjiaosite")."as a left join".tablename("hyb_yl_zhuanjia")."as b on b.zid=a.zid where a.uniacid='{$uniacid}' and a.h_id='{$h_id}'";
    $res  = pdo_fetch($sql);
    $res['sfbtime'] =date("Y-m-d H:i:s",$res['sfbtime']);
    $res['h_text'] =htmlspecialchars_decode($res['h_text']);
    echo json_encode($res);
  }
  public function remen(){
     global $_GPC,$_W;
     $uniacid = $_W['uniacid'];
     $huanjiao = pdo_fetchall('SELECT a.*,b.hospital FROM' . tablename('hyb_yl_hjiaosite') . "as a left join ".tablename('hyb_yl_hospital')."as b on b.uid=a.uid WHERE a.uniacid ='{$uniacid}' AND a.h_type=0 and a.h_dianzan!=0 order by a.h_dianzan desc");
     foreach ($huanjiao as $key => $value) {
        if(!$value['hospital']){
          $hospital= pdo_get("hyb_yl_base",array('uniacid'=>$uniacid),'show_title');
          $huanjiao[$key]['hospital']=$hospital['show_title'];
         }
         $huanjiao[$key]['h_pic'] = $_W['attachurl'] . $huanjiao[$key]['h_pic'];
         $huanjiao[$key]['sfbtime'] = date('Y-m-d', $huanjiao[$key]['sfbtime']);
     }
     $data = array('hjlist' => $huanjiao);  
     echo json_encode($data);
   }
}


