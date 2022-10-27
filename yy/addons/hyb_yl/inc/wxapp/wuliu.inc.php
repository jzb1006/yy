<?php
/**
* 
*/
 class Wuliu extends HYBPage
 { 
    //单个资讯分类列表
    public function peisong() {
         global $_GPC, $_W;
         $uniacid = $_W['uniacid'];
         $provinceName = $_GPC['provinceName'];
         $listgoodArr = $this->jsondata($_GPC['listgoodArr']);
          //计算当前区域的配送价格
          foreach ($listgoodArr as $key2 => $value2) {
             $num = intval($value2['num']);
             $address_arr = pdo_fetch("SELECT * FROM".tablename("hyb_yl_yunfei")."where uniacid='{$uniacid}' and id='{$value2['yf_id']}' ");
             $detail = unserialize($address_arr['detail']);
        
             if(count($detail)>1){
               array_shift($detail); 
             }
             foreach ($detail as $key3 => $value3) {
               $first = intval($value3['first']);
               $listgoodArr[$key2]['first'] = $first;
               $first_price = floatval($value3['first_price']);
               $listgoodArr[$key2]['first_price'] = $first_price;
               
               $continue = intval($value3['continue']);
               $listgoodArr[$key2]['continue'] = $continue;
               $continue_price = floatval($value3['continue_price']);
               $listgoodArr[$key2]['continue_price'] = $continue_price;

               if($num<=$first){
                  $listgoodArr[$key2]['peimoney'] = $first_price;
               }else{
                  //查询超过了几件
                  $chao_num = ($num - $first);
                  //查询每件的价格
                  $one_money = ($continue * $continue_price );
                  //每超过件数增加多少元
                  $listgoodArr[$key2]['peimoney'] = ($chao_num / $one_money);
                
               }
             }

          }

         echo json_encode($listgoodArr);
    }
      public function jsondata($data)
   {
        $value =htmlspecialchars_decode($data);
        $array =json_decode($value);
        $object =json_decode(json_encode($array),true);
        return $object;
    }
       public function add_val_to_array($val, $array = []) {
            return array_merge($array, (array)$val);
        }
}


