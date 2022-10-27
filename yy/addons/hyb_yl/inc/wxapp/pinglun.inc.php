<?php
/**
* 
*/
 class Pinglun extends HYBPage
 { 
   //商品评价
    public function goodspj(){
       global $_GPC, $_W;
       $uniacid = $_W['uniacid'];
       $pic = $_GPC['pic'];
       $text = $_GPC['text'];
       $id = $_GPC['id'];
       $value = $this->jsondata($pic);
       $text_info = array(
         'text'=>$text,
         'pic'=>$value
        );
       $data =array(
            'uniacid'=>$uniacid,
            'sid'   =>$_GPC['sid'],
            'openid' =>$_GPC['openid'],
            'dengj'  =>$_GPC['dengj'],
            'pl_text'=>serialize($text_info),
            'pl_time'=>date("Y-m-d H:i:s")
            );
       $res  =pdo_update("hyb_yl_goodsorders",array('isAppraise'=>1),array('id'=>$id,'uniacid'=>$uniacid));
       pdo_insert("hyb_yl_pinglunsite",$data);
       echo json_encode($res);
    }
       public function jsondata($data)
    {
        $value =htmlspecialchars_decode($data);
        $array =json_decode($value);
        $object =json_decode(json_encode($array),true);
        return $object;
    }
}


