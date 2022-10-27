<?php
/**
* 
*/
 class Search extends HYBPage
 { 
    //单个资讯分类列表
    public function searching() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $kewords =$_GPC['kewords'];
        $model = Model('zhuanjia');
        $tab1  = $model->tablename("zhuanjia");
        $tab2  = $model->tablename("hospital");
        $tab3  = $model->tablename("category");
        require_once dirname(dirname(dirname(__FILE__)))."/class/Segmentation.class.php";
        iconv('GB2312','UTF-8',$kewords); 
        $kew = new Segmentation();
        $date = $kew->spStr($kewords);
        $sear_kew=array();
        foreach ($date as $key1 => $value1) {
            $sql="SELECT DISTINCT $tab1.uid,$tab1.*,$tab2.uid,$tab2.grade,$tab2.hospital,$tab3.id,$tab3.parentid AS pid,$tab3.name FROM $tab1 LEFT JOIN $tab3 ON $tab1.z_room=$tab3.id LEFT JOIN $tab2 ON $tab1.uid=$tab2.uid  WHERE $tab1.uniacid='".$uniacid."' and $tab1.z_zhenzhi LIKE '%{$value1}%' and $tab1.exa=1 order by $tab1.sord";
            $page=$model->pagenation($sql);
            $res=$page['dataset'];
            foreach ($res as $key2 =>$value2) {
                $res[$key2]['z_thumbs'] =$_W['attachurl'].$res[$key2]['z_thumbs'];
            }
            $sear_kew  =array(
                'data'=>$res
            );
        }
        $result2 = [];
          array_map(function ($value) use (&$result2) {
            $result2 = array_merge($result2, array_values($value));
         }, $sear_kew); 
        if(!empty($result2)){

           echo json_encode($result2); 
        }else{
         $sql="SELECT DISTINCT $tab1.uid,$tab1.*,$tab2.uid,$tab2.grade,$tab2.hospital,$tab3.id,$tab3.parentid AS pid,$tab3.name FROM $tab1 LEFT JOIN $tab3 ON $tab1.z_room=$tab3.id LEFT JOIN $tab2 ON $tab1.uid=$tab2.uid  WHERE $tab1.uniacid='".$uniacid."' and $tab1.exa=1 order by $tab1.sord";
         $res = pdo_fetchall($sql);
         foreach ($res as $key2 =>$value2) {
           $res[$key2]['z_thumbs'] =$_W['attachurl'].$res[$key2]['z_thumbs'];
          }
         $sear_kew  =array(
               'data'=>$res
            );
         echo json_encode($sear_kew); 
        }

          
    }

}


