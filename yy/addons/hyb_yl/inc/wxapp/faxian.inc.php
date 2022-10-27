<?php
/**
* 
*/
 class faxian extends HYBPage
 { 
    //获取用户信息
    public function departments() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $keywords = $_GPC['keywords'];
        $where ="where uniacid = '{$uniacid}' and state=1 and typeint=0";
        if(empty($keywords)){
           $where .= "";
        }else{
           $where .= " and ctname like '%$keywords%'";
        }
        $catlist =pdo_fetchall("select * from".tablename('hyb_yl_classgory')."{$where}");
      
        if($catlist){
         foreach($catlist as $key => $value){
              $newdate[$key]['titles']=$value['ctname'];  
              $id = $value['id']; 
              $rows = pdo_fetchall("select * from".tablename('hyb_yl_ceshi')."where uniacid = '{$uniacid}' and giftstatus ='{$id}' and enabled=1 group by id order by sort desc ");
              foreach($rows as $k => $v){
                $rows[$k]['detail_cover_url'] = tomedia($rows[$k]['detail_cover_url']);
              }
              $newdate[$key]['list']=$rows;
        } 
      }else{
         $newdate=0;
      }

       
        echo json_encode($newdate);
    }


    // 获取机构分组总专家
    public function class_num()
    {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $openid = $_GPC['openid'];
      $hid = pdo_getcolumn("hyb_yl_hospital",array("uniacid"=>$uniacid,"openid"=>$openid),'hid');
      $catlist =pdo_fetchall("select * from".tablename('hyb_yl_classgory')."where uniacid = '{$uniacid}' and state=1 and typeint=0");
      
     
        foreach($catlist as $key => $value){
              $newdate[$key]['titles']=$value['ctname'];  
              $id = $value['id']; 
              $rows = pdo_fetchall("select * from".tablename('hyb_yl_ceshi')."where uniacid = '{$uniacid}' and giftstatus ='{$id}' and enabled=1 group by id order by sort desc ");
              foreach($rows as $k => $v){
                $rows[$k]['detail_cover_url'] = tomedia($rows[$k]['detail_cover_url']);
                $rows[$k]['num'] = pdo_fetchcolumn("select count(*) from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and parentid=".$rows[$k]['id']." and hid=".$hid);
              }
              $newdate[$key]['list']=$rows;
        }
       
        echo json_encode($newdate);
    }

    // 获取机构分组总人数
    public function class_people()
    {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      $openid = $_GPC['openid'];
      $hid = pdo_getcolumn("hyb_yl_hospital",array("uniacid"=>$uniacid,"openid"=>$openid),'hid');
      
      $catlist =pdo_fetchall("select * from".tablename('hyb_yl_classgory')."where uniacid = '{$uniacid}' and state=1 and typeint=0");
      

     
        foreach($catlist as $key => $value){
              $newdate[$key]['titles']=$value['ctname'];  
              $id = $value['id']; 
              $rows = pdo_fetchall("select * from".tablename('hyb_yl_ceshi')."where uniacid = '{$uniacid}' and giftstatus ='{$id}' and enabled=1 group by id order by sort desc ");
              foreach($rows as $k => $v){
                $rows[$k]['detail_cover_url'] = tomedia($rows[$k]['detail_cover_url']);
                $rows[$k]['description'] = explode("、",$rows[$k]['description']);
                $zjs = "";
                $zj_arr = pdo_getall("hyb_yl_zhuanjia",array("uniacid"=>$uniacid,"hid"=>$hid,"parentid"=>$rows[$k]['id']),'zid');

                if(count($zj_arr) > 0)
                {
                  foreach($zj_arr as &$zj)
                  {
                      $zjs .= $zj['zid'].",";
                  }
                  $zjs = substr($zjs,0,strlen($zjs)-1);
                  $order = pdo_fetchall("select count(*) from ".tablename("hyb_yl_twenorder")." where uniacid=".$uniacid." and zid in (".$zjs.") group by openid");
                }else{
                  $order = array();
                }

                

                $rows[$k]['num'] = count($order);
      
                
              }
              $newdate[$key]['list']=$rows;
        }
       
        echo json_encode($newdate);
    }

}


