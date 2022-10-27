<?php
/**
* 
*/
 class Specialty extends HYBPage
 { 
  //联盟基本信息
   public function index()
  {
     global $_GPC, $_W;
     $model = Model('hospital');
     $uniacid = $_W['uniacid'];
     $hid =$_GPC['hid'];
     $res = $model->where("uniacid='".$uniacid."' and hid='".$hid."' ")->get('hospital,logo,shanchang,grade,docnumber');
     $res['logo'] = $_W['attachurl'].$res['logo'];
     $res['shanchang']=explode(',', $res['shanchang']);
     echo json_encode($res);
  }
  //安装的应用
  public function menu(){
     global $_GPC, $_W;
     $model = Model('lianmserver');
     $uniacid = $_W['uniacid'];
     $uid = $_GPC['uid'];
     $res = $model->where("uniacid='".$uniacid."' and uid='".$uid."'")-> getall();
     foreach ($res as $key => $value) {
       $res[$key]['thumb'] = $_W['attachurl'].$res[$key]['thumb'];
     }
     echo json_encode($res);
  }
  //联盟专家
  public function doctor(){
     global $_GPC, $_W;
     $model =  Model('zhuanjia');
     $uniacid = $_W['uniacid'];
     $uid = $_GPC['uid'];
     $res = $model->where("uniacid='".$uniacid."' and uid='".$uid."' ")-> getall('zid,z_zhiwu,z_zhicheng,z_thumbs,z_zhiwu,z_zhenzhi,z_name');
     foreach ($res as $key => $value) {
       $res[$key]['z_thumbs'] = $_W['attachurl'].$res[$key]['z_thumbs'];
     }
     echo json_encode($res);
  }
 //获取视频列表
    public function lmhj(){
     global $_GPC, $_W;
     $model =  Model('hjiaosite');
     $uniacid = $_W['uniacid'];
     $uid = $_GPC['uid'];
     $h_leixing = $_GPC['h_leixing'];
     $tab1 = $model->tablename("hjiaosite"); 
     $tab2 = $model->tablename("hjfenl");
     $tab3 = $model->tablename("zhuanjia");
     $sql="SELECT DISTINCT $tab1.h_id,$tab1.*,$tab2.hj_id,$tab2.hj_name,$tab3.zid,$tab3.z_thumbs,$tab3.z_name,$tab3.z_zhiwu  from $tab1 LEFT JOIN $tab2 ON $tab1.h_flid=$tab2.hj_id LEFT JOIN $tab3 on $tab1.zid=$tab3.zid where $tab1.uniacid='".$uniacid."' and $tab1.uid='".$uid."' and $tab1.h_leixing='".$h_leixing."' order by $tab1.h_id asc";
     $page=$model->pagenation($sql);
     $res=$page['dataset'];

     foreach ($res as $key => $value) {
       $res[$key]['z_thumbs'] = $_W['attachurl'].$res[$key]['z_thumbs'];
       $res[$key]['h_pic'] = $_W['attachurl'].$res[$key]['h_pic'];
       $res[$key]['audios'] = $_W['attachurl'].$res[$key]['audios'];
       $res[$key]['h_video'] = $_W['attachurl'].$res[$key]['h_video'];
       $res[$key]['h_text']=strip_tags(htmlspecialchars_decode($res[$key]['h_text']));
     }
     echo json_encode($res);
  }
  //联盟列表
    public function listall(){
     global $_GPC, $_W;
     $uniacid = $_W['uniacid'];
     $model =  Model('hospital');
     $total=$model->where("uniacid='".$uniacid."'")->count();
     $pindex = max(1, intval($_GPC['page'])); 
     $pagesize = 5;
     $pager = pagination($total,$pindex,$pagesize);
     $p = ($pindex-1) * $pagesize; 
     $res=$model->where("uniacid='".$uniacid."'")->limit("".$p.",".$pagesize."")->getall();
     foreach ($res as $key => $value) {
         $res[$key]['logo'] = $_W['attachurl'] . $res[$key]['logo'];
     }
     echo json_encode($res);
  }
}


