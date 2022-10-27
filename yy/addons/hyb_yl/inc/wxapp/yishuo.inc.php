<?php
/**
* 
*/
 class Yishuo extends HYBPage
 { 


   
    public function  listliebiao() {
    global $_GPC, $_W;
    $zid = $_GPC['zid'];
    $uniacid = $_W['uniacid'];
    //查询所有分组
    $res =pdo_fetchall("SELECT * FROM".tablename("hyb_yl_zhuanjiafenzu")."where uniacid='{$uniacid}' and zid='{$zid}' order by fenzuid desc");
    foreach ($res as $key => $value) {
    //查询分组下面的所有用户
        $fenzuid =$value['fenzuid'];
        $res[$key]['user'] = pdo_fetchall("SELECT a.*,b.openid,b.names,b.j_id,b.sex,b.age,c.u_id,c.u_name,c.u_thumb FROM".tablename("hyb_yl_qianyueorder")."as a left join".tablename("hyb_yl_userjiaren")."as b on b.j_id=a.j_id left join".tablename('hyb_yl_userinfo')."as c on c.openid=a.openid where a.zid='{$zid}' and a.uniacid='{$uniacid}' and  a.istg =1 and a.fenzuid='{$fenzuid}' order by a.q_id desc");
        
      }
     $data =array(
         'data'=>$res,
         'weifenzu'=>pdo_fetchall("SELECT a.*,b.openid,b.names,b.j_id,b.sex,b.age,c.u_id,c.u_name,c.u_thumb FROM".tablename("hyb_yl_qianyueorder")."as a left join".tablename("hyb_yl_userjiaren")."as b on b.j_id=a.j_id left join".tablename('hyb_yl_userinfo')."as c on c.openid=a.openid where a.zid='{$zid}' and a.uniacid='{$uniacid}' and  a.istg =1 and a.fenzuid=0 order by a.q_id desc")
        );
     echo json_encode($data); 
     }
     //添加医说
     public function saveyishuo(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $value = htmlspecialchars_decode($_GPC['yspic']);
        $array = json_decode($value);
        $object = json_decode(json_encode($array), true);
        $user = $_GPC['user'];
        $data =array(
          'zid'=>$zid,
          'uniacid'=>$uniacid,
          'hid'=>$_GPC['hid'],
          'yspic'=>serialize($object),
          'ystime'=>strtotime("now"),
          'user' =>$user,
          'ystext' =>$_GPC['ystext'],
          );
       $info = pdo_insert('hyb_yl_yishuo', $data);
       echo json_encode($info);
     }
     //保存患教
    public function savegerenhj(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $zid =$_GPC['zid'];
        $op =$_GPC['op'];
        $hj_type =$_GPC['hj_type'];
        $value = htmlspecialchars_decode($_GPC['h_thumb']);
        $array = json_decode($value);
        $object = json_decode(json_encode($array), true);
        $doc = pdo_get('hyb_yl_zhuanjia',array('zid'=>$zid),array('z_name'));
        //查询是否免审核
        $rew = pdo_get('hyb_yl_zhuanjia_rule',array('uniacid'=>$uniacid),array('is_huanjiao'));
        if($rew['is_huanjiao']=='1'){
            $h_shen = 0;
        }else{
            $h_shen = 1;
        }
        $data =array(
          'zid'=>$zid,
          'uniacid'=>$uniacid,
          'h_text' =>$_GPC['h_text'],
          'h_leixing'=>$_GPC['h_leixing'],
          'h_thumb'=>serialize($object),
          'created'=>strtotime("now"),
          'h_flid' =>$_GPC['h_flid'],
          'h_title'=>$_GPC['h_title'],
          'h_pic'  =>$_GPC['h_pic'],
          'z_name' =>$doc['z_name'],
          'h_type' => $_GPC['h_type'],
          'h_shen' => $h_shen
          );
        if($op=='post'){
           
           $info = pdo_insert('hyb_yl_hjiaosite', $data);
           echo json_encode($info);
        }
    }
    public function Allhjfenl(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];    
        $op = $_GPC['op'];
        if ($op == 'display') {
            $res = pdo_fetchall('SELECT * FROM' . tablename('hyb_yl_hjfenl') . "WHERE uniacid ='{$uniacid}' ");
            //最新患教
            $huanjiao = pdo_fetchall('SELECT * FROM' . tablename('hyb_yl_hjiaosite') . "WHERE uniacid ='{$uniacid}' AND h_leixing=0 order by h_id desc");
            foreach ($huanjiao as $key => $value) {
                $huanjiao[$key]['h_pic'] = $_W['attachurl'] . $huanjiao[$key]['h_pic'];
                $huanjiao[$key]['sfbtime'] = date('Y-m-d H:i:s', $huanjiao[$key]['sfbtime']);
            }
            $data = array('fenl' => $res, 'hjlist' => $huanjiao);
            echo json_encode($data);
        }
        if($op == 'geren'){
            //查询我的点赞总数
            $zid =$_GPC['zid'];
            $dianzan = pdo_fetch('SELECT SUM(`h_dianzan`) AS dianzan FROM' . tablename('hyb_yl_hjiaosite') . "WHERE uniacid ='{$uniacid}' AND zid='{$zid}'");
            $yuedu = pdo_fetch('SELECT SUM(`h_read`) AS yuedu FROM' . tablename('hyb_yl_hjiaosite') . "WHERE uniacid ='{$uniacid}' AND zid='{$zid}'");
            $zhuanfa = pdo_fetch('SELECT SUM(`h_zhuanfa`) AS zhuanfa FROM' . tablename('hyb_yl_hjiaosite') . "WHERE uniacid ='{$uniacid}' AND zid='{$zid}'");
            $res = pdo_fetchall('SELECT * FROM' . tablename('hyb_yl_hjfenl') . "WHERE uniacid ='{$uniacid}' ");
            //最新患教
            $huanjiao = pdo_fetchall('SELECT * FROM' . tablename('hyb_yl_hjiaosite') . "WHERE uniacid ='{$uniacid}' AND h_leixing=1 order by h_id desc");
            foreach ($huanjiao as $key => $value) {
                $huanjiao[$key]['h_pic'] = $_W['attachurl'] . $huanjiao[$key]['h_pic'];
                $huanjiao[$key]['sfbtime'] = date('Y-m-d H:i:s', $huanjiao[$key]['sfbtime']);
            }
            $data = array('fenl' => $res, 'hjlist' => $huanjiao,'dianzan'=>$dianzan,'yuedu'=>$yuedu,'zhuanfa'=>$zhuanfa);
            echo json_encode($data);
        }
        if ($op == 'post') {
            $h_id = $_GPC['h_id'];
            $h_leixing = intval($_GPC['h_leixing']);
            if($h_leixing ==1){
              $res = pdo_get('hyb_yl_hjiaosite', array('h_id' => $h_id, 'uniacid' => $uniacid));
              $zid =$res['zid'];
              $auth = pdo_fetch("SELECT * FROM".tablename("hyb_yl_zhuanjia")."WHERE uniacid='{$uniacid}' AND zid='{$zid}'");
              $res['h_thumb']=unserialize($res['h_thumb']);
              $num =count($res['h_thumb']);
              $dianzan = pdo_fetch('SELECT SUM(`h_dianzan`) AS dianzan FROM' . tablename('hyb_yl_hjiaosite') . "WHERE uniacid ='{$uniacid}' AND zid='{$zid}'");
              $yuedu = pdo_fetch('SELECT SUM(`h_read`) AS yuedu FROM' . tablename('hyb_yl_hjiaosite') . "WHERE uniacid ='{$uniacid}' AND zid='{$zid}'");
              $zhuanfa = pdo_fetch('SELECT SUM(`h_zhuanfa`) AS zhuanfa FROM' . tablename('hyb_yl_hjiaosite') . "WHERE uniacid ='{$uniacid}' AND zid='{$zid}'");
              for ($i=0; $i <$num ; $i++) { 
                  $res['h_thumb'][$i] = $_W['attachurl'] . $res['h_thumb'][$i];
              }
              if (!empty($res['h_video'])) {
                  $res['h_video'] = $_W['attachurl'] . $res['h_video'];
              }
              if(!empty($auth['z_thumbs'])){
                $auth['z_thumbs'] =$_W['attachurl'].$auth['z_thumbs'];
              }
              if(!empty($res)){
                  $res['h_pic'] = $_W['attachurl'] . $res['h_pic'];
                  $res['sfbtime'] = date("Y-m-d H:i:s", $res['sfbtime']);
                  $res['auth'] =$auth;
                  $res['h_text'] = strip_tags(htmlspecialchars_decode($res['h_text']));
                  $res['dianzan'] =$dianzan;
                  $res['yuedu'] =$yuedu;
                  $res['zhuanfa']=$zhuanfa;
              }

            }else{
             //查平台
              $auth = pdo_fetch("SELECT * FROM".tablename("hyb_yl_bace")."WHERE uniacid='{$uniacid}'");
              $dianzan = pdo_fetch('SELECT SUM(`h_dianzan`) AS dianzan FROM' . tablename('hyb_yl_hjiaosite') . "WHERE uniacid ='{$uniacid}' AND h_leixing=0");
              $yuedu = pdo_fetch('SELECT SUM(`h_read`) AS yuedu FROM' . tablename('hyb_yl_hjiaosite') . "WHERE uniacid ='{$uniacid}' AND h_leixing=0");
              $zhuanfa = pdo_fetch('SELECT SUM(`h_zhuanfa`) AS zhuanfa FROM' . tablename('hyb_yl_hjiaosite') . "WHERE uniacid ='{$uniacid}' AND h_leixing=0 ");
              $auth['show_thumb'] =unserialize($auth['show_thumb']);
              $auth['bq_thumb'] =$_W['attachurl'].$auth['bq_thumb'];
              $auth['yy_thumb'] =$_W['attachurl'].$auth['yy_thumb'];
              $auth['yy_content'] = strip_tags(htmlspecialchars_decode($auth['yy_content']));
              $count = count($auth['show_thumb']);
              for ($i=0; $i <$count ; $i++) { 
                 $auth['show_thumb'][$i] =$_W['attachurl'].$auth['show_thumb'][$i];
              }
              $res = pdo_get('hyb_yl_hjiaosite', array('h_id' => $h_id, 'uniacid' => $uniacid));
              $res['h_thumb']=unserialize($res['h_thumb']);
              $num =count($res['h_thumb']);
              for ($i=0; $i <$num ; $i++) { 
                  $res['h_thumb'][$i] = $_W['attachurl'] . $res['h_thumb'][$i];
              }
              if (!empty($res['h_video'])) {
                  $res['h_video'] = $_W['attachurl'] . $res['h_video'];
              }
              if(!empty($res)){
                  $res['h_pic'] = $_W['attachurl'] . $res['h_pic'];
                  $res['sfbtime'] = date("Y-m-d H:i:s", $res['sfbtime']);
                  $res['auth'] =$auth;
                  $res['h_text'] = strip_tags(htmlspecialchars_decode($res['h_text']));
                  $res['dianzan'] =$dianzan;
                  $res['yuedu'] =$yuedu;
                  $res['zhuanfa']=$zhuanfa;
              }
            }
            echo json_encode($res);
        }
        if($op == 'remen'){
            //查询热门
            $res = pdo_fetchall('SELECT * FROM' . tablename('hyb_yl_hjfenl') . "WHERE uniacid ='{$uniacid}' ");
            //最新患教
            $huanjiao = pdo_fetchall('SELECT * FROM' . tablename('hyb_yl_hjiaosite') . "WHERE uniacid ='{$uniacid}' AND h_leixing=0 AND h_tuijian=1 order by h_id desc");
            foreach ($huanjiao as $key => $value) {
                $huanjiao[$key]['h_pic'] = $_W['attachurl'] . $huanjiao[$key]['h_pic'];
                $huanjiao[$key]['sfbtime'] = date('Y-m-d H:i:s', $huanjiao[$key]['sfbtime']);
            }
            $data = array('fenl' => $res, 'hjlist' => $huanjiao);
            echo json_encode($data);
        }
        if($op == 'allhj'){
          $hj_id = $_GPC['hj_id'];
          $huanjiao = pdo_fetchall('SELECT * FROM' . tablename('hyb_yl_hjiaosite') . "WHERE uniacid ='{$uniacid}' AND h_flname='{$hj_id}' AND h_leixing=0   order by h_id desc");
          foreach ($huanjiao as $key => $value) {
              $huanjiao[$key]['h_pic'] = $_W['attachurl'] . $huanjiao[$key]['h_pic'];
              $huanjiao[$key]['sfbtime'] = date('Y-m-d H:i:s', $huanjiao[$key]['sfbtime']);
          }
          echo json_encode($huanjiao);
        }
        if($op == 'allfl'){
          $res = pdo_fetchall('SELECT * FROM' . tablename('hyb_yl_hjfenl') . "WHERE uniacid ='{$uniacid}' ");
          echo json_encode($res);
        }
        
    }
    public function ysdetail(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];    
        $yisid = $_GPC['yisid'];
        $res = pdo_fetch("SELECT * FROM".tablename('hyb_yl_yishuo')."as a left join".tablename('hyb_yl_zhuanjia')."as b on b.zid=a.zid where a.uniacid='{$uniacid}' and a.yisid='{$yisid}' "  );
        $res['z_thumbs'] = $_W['attachurl'].$res['z_thumbs'];
        $res['time'] = date("Y-m-d",$res['time']);
        $res['yspic'] = unserialize($res['yspic']);
        // $count = count($res['yspic']);
        // for ($i = 0;$i < $count;$i++) {
        //    $res['yspic'][$i] = $_W['attachurl'] . $res['yspic'][$i];
        //  }  
        echo json_encode($res);
    }
    public function hjdetail(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];    
        $h_id = $_GPC['h_id'];
        $res = pdo_fetch("SELECT * FROM".tablename('hyb_yl_yishuo')."as a left join".tablename('hyb_yl_zhuanjia')."as b on b.zid=a.zid where a.uniacid='{$uniacid}' and a.h_id='{$h_id}' "  );
        $res['z_thumbs'] = $_W['attachurl'].$res['z_thumbs'];
        $res['time'] = date("Y-m-d",$res['time']);
        $res['h_pic'] = unserialize($res['h_pic']);
        echo json_encode($res);
    }
}


