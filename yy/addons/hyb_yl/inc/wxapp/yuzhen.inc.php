<?php
/**
* 
*/
 class Yuzhen extends HYBPage
 { 
//列表
   public function info()
  {
     global $_GPC, $_W;
     $model = Model('zhenzhuang');
     $uniacid = $_W['uniacid'];
     $res = $model->where('uniacid="'.$uniacid.'" and pid!=-1')->getall();
     foreach ($res as $key => $value) {
      $res[$key]['icon'] = $_W['attachurl'].$res[$key]['icon'];
     }
     echo json_encode($res);
  }
  //一级分类
   public function classa()
  {
     global $_GPC, $_W;
     $model = Model('zhenzhuang');
     $uniacid = $_W['uniacid'];
     $res = $model->where('uniacid="'.$uniacid.'" and pid=-1')->getall();
     foreach ($res as $key => $value) {
      $res[$key]['icon'] = $_W['attachurl'].$res[$key]['icon'];
     }
     echo json_encode($res);
  }
  //二级分类
   public function classb()
  {
     global $_GPC, $_W;
     $model   = Model('zhenzhuang');
     $uniacid = $_W['uniacid'];
     $pid = $_GPC['id'];
     $res = $model->where('uniacid="'.$uniacid.'" and pid="'.$pid.'"')->getall();
     foreach ($res as $key => $value) {
      $res[$key]['icon'] = $_W['attachurl'].$res[$key]['icon'];
     }
     echo json_encode($res);
  }
//详情
   public function onedata()
  {
       global $_GPC, $_W;
       $model = Model('zhenzhuang');
       $goodsarr = Model('goodsarr');
       $tab1=$model->tablename("intelyuzhen");
       $tab2=$model->tablename("zhenzhuang");
       $model2 = Model('zhuanjia');
       $uniacid = $_W['uniacid'];
       $id =$_GPC['id'];
       $sql ="SELECT $tab1.pid AS pp_id,$tab1.*,$tab2.id,$tab2.pid,$tab2.name from $tab1 LEFT JOIN $tab2 ON $tab2.id = $tab1.pid WHERE $tab1.uniacid='".$uniacid."' and $tab1.pid = '".$id."' limit 1";
       $res = pdo_fetch($sql);
       $i_id = $res['i_id'];
       $start=unserialize($res['start']);
       $last=unserialize($res['last']);
       $suggest=unserialize($res['suggest']);
       $yp=unserialize($res['yp']);
       $ys=unserialize($res['ys']);
       $ypname=unserialize($res['ypname']);
       $ysname=unserialize($res['ysname']); 
    //分数区间
    foreach ($start as $key => $value) {
        $num[$key]['start']=$start[$key];  
        $num[$key]['last']=$last[$key];
        $num[$key]['suggest']=$suggest[$key];
        $num[$key]['yp']=$yp[$key];
        $num[$key]['ys']=$ys[$key];
        $num[$key]['ypname']=$ypname[$key];
        $num[$key]['ysname']=$ysname[$key];
    }
      foreach ($num as $key => $value) {
        $dd_yp= explode(',', $num[$key]['yp']);
        $dd_ys = explode(',', $num[$key]['ys']);
        foreach ($dd_yp as $key1 => $value1) {
          $num[$key]['dd_yp'] = $goodsarr->where("sid='{$value1}'")->getall();
             foreach ($num[$key]['dd_yp'] as $k => $v) {
             $num[$key]['dd_yp'][$k]['sthumb'] = $_W['attachurl'].$num[$key]['dd_yp'][$k]['sthumb'];
          }
        }
        foreach ($dd_ys as $key2 => $value2) {
          $num[$key]['dd_ys']=$model2->where("zid='{$value2}'")->getall();
          foreach ($num[$key]['dd_ys'] as $k => $v) {
             $num[$key]['dd_ys'][$k]['z_thumbs'] = tomedia($num[$key]['dd_ys'][$k]['z_thumbs']);
          }
        }
      }
        $spec_items = json_decode($res['spec'],true);
        $result2 = [];
          array_map(function ($value) use (&$result2) {
            $result2 = array_merge($result2, array_values($value));
         }, $spec_items);  

       $data =array(
            'num' =>$num,
            'spec'=>$result2
        );
       echo json_encode($data);
  }
}


