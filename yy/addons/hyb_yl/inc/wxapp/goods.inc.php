<?php
/**
* 
*/
 class Goods extends HYBPage
 { 
   public function listgoods()
   {
      global $_W,$_GPC;
      $uniacid = $_W['uniacid'];
      //所有推荐商品
      $getgoodslist  = pdo_fetchall('SELECT * FROM'.tablename('hyb_yl_goodsarr')."where uniacid ='{$uniacid}' AND rec=1");
      foreach ($getgoodslist as $key => $value) {
        $getgoodslist[$key]['sthumb'] =$_W['attachurl'].$getgoodslist[$key]['sthumb'];
      } 
      //所有分类商品
      $getallfenlegoods = pdo_fetchall('SELECT * FROM '.tablename('hyb_yl_goodsfenl')."where uniacid = '{$uniacid}'");
      foreach ($getallfenlegoods as $key1 => $value1) {
        $getallfenlegoods[$key1]['fenlpic'] =$_W['attachurl'].$getallfenlegoods[$key1]['fenlpic'];
      } 
      $data =array(
        'item'     =>$getgoodslist,
        'category' =>$getallfenlegoods
      );
      echo json_encode($data);

   }
   public function detail(){
      global $_GPC, $_W;
      $uniacid = $_W['uniacid'];
      $sid = $_GPC['sid'];
      $openid = $_GPC['openid'];

      $res = pdo_get('hyb_yl_goodsarr', array('uniacid' => $uniacid, 'sid' => $sid));
      $vip_log = pdo_get("hyb_yl_vip_log",array("uniacid"=>$uniacid,'openid'=>$openid));
      if($vip_log['endtime'] > time())
      {
        $is_vip = true;
        $res['smoney'] = $res['smoney'] - $res['hy_money'];
      }else{
        $is_vip = false;
      }
      $res['spic'] = json_decode($res['spic'],true);
      $res['sfbtime'] = date('Y-m-d H:i:s', $res['sfbtime']);
      $re1 = htmlspecialchars_decode($res['scontent']);
      $url = 'https://'.$_SERVER['HTTP_HOST'];
      $res['g_content'] = unserialize($res['g_content']);
      //查询商品规格
      //$res['guige'] = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_goodsguige')."where uniacid='{$uniacid}' and sid='{$sid}'");

      $num = count($res['spic']);
      for ($i = 0;$i < $num;$i++) {
          $res['spic'][$i] = $_W['attachurl'] . $res['spic'][$i];
      }
      $res['sthumb']= $_W['attachurl'] . $res['sthumb'];
      $data = array('item' => $res,'contents'=>$re1,'url'=>$url);
      echo json_encode($data);
   }
   //所有商品hyb_yl_goodsguige
   public function allgoods(){
      global $_GPC, $_W;
      $uniacid = $_W['uniacid'];
      $jigou_two = $_GPC['hid'];

      $provinceName = $_GPC['provinceName'];
      $row  = pdo_fetchall("SELECT a.*,b.*,c.detail FROM".tablename('hyb_yl_goodsarr')."as a left join ".tablename('hyb_yl_goodsfenl')."as b on b.fid=a.g_id left join".tablename('hyb_yl_yunfei')."as c on c.id=a.yf_id where a.uniacid='{$uniacid}' and a.jigou_two='{$jigou_two}' ORDER BY RAND() LIMIT 10");

      foreach ($row as $key => $value) {
          $sid = $value['sid'];
          $detail = unserialize($value['detail']);
          if($value['g_baoyou'] =='1'){
            $row[$key]['peisong'] = 1;
          }else{
            if(count($detail)>1){
              $newarr=[];
              foreach($detail as $k=>$v) $newarr[$k] = $v['address'];
              $detail_Arr = implode(',', $newarr);
              $addressArr_new_back = rtrim($detail_Arr,',');
              $arr_new = explode(',', $addressArr_new_back);
              foreach( $arr_new as $k2=>$v2){   
                    if( !$v2 )   
                     unset( $arr_new[$k2] );   
                } 
                if(in_array($provinceName,$arr_new)){
                   $row[$key]['peisong'] = 1;
                }else{
                   $row[$key]['peisong'] = 0;
                }
              }else{
                  $row[$key]['peisong'] = 1;
              }
          }
          $row[$key]['detail'] = $detail;
          $row[$key]['sthumb'] = $_W['attachurl'].$row[$key]['sthumb'];
          $cx_name = strip_tags(htmlspecialchars_decode($row[$key]['sdescribe']));
          $cx_name = str_replace(PHP_EOL, '',  $cx_name);
          $cx_name = str_replace(array("&nbsp;", "&ensp;", "&emsp;","&thinsp;","&zwnj;","&zwj;","&ldquo;","&rdquo;"), "", $cx_name);
          $row[$key]['sdescribe']  = $cx_name;
          $row[$key]['guige']  = pdo_fetchall("SELECT gg_name FROM".tablename("hyb_yl_goodsguige")."where uniacid='{$uniacid}' and sid='{$sid}'");
          $row[$key]['num'] =0;
      }

       echo json_encode($row);
   }
   //开处方
   public function chufang(){
    global $_GPC, $_W;
    $uniacid = $_W['uniacid'];
    $ypList = $this->jsondata($_GPC['ypList']);
    $j_id = $_GPC['j_id'];
    $data =array(
       'uniacid' => $uniacid,
       'textarr' => $_GPC['textarr'],
       'ypList'  => serialize($ypList),
       'useropenid'=> $_GPC['useropenid'],
       'j_id'    => $_GPC['j_id'],
       'zid'     => $_GPC['zid'],
       'cfpic'   => $_GPC['cfpic'],
       'money'   => $_GPC['money'],
       'orders'  => date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8)
      );
    $res = pdo_insert("hyb_yl_chufang",$data);
    $cid = pdo_insertid();
    $getuserinfo = pdo_get("hyb_yl_userjiaren",array('j_id'=>$j_id,'uniacid'=>$uniacid));
    if($getuserinfo['sex'] =='0'){
      $sex ='男';
    }else{
      $sex ='女';
    } 
    $msg = array(
          "username" => $getuserinfo['names'],
          'text' => $sex.'-'.$getuserinfo['age'].'岁',
          "title"=> "处方",
          "style"=> "right",
          'type' => 'file',
          'url'  => '/hyb_yl/addPrescription/addPrescription?c_id='.$cid,
          'sate' => 1,
          'time' => date("Y-m-d H:i:s"),
      );
    echo json_encode($msg);
   }
   public function chufangdt(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $c_id =intval($_GPC['c_id']);
        $res = pdo_get("hyb_yl_chufang",array('c_id'=>$c_id,'uniacid'=>$uniacid));
        $res['ypList'] =unserialize($res['ypList']);
        echo json_encode($res);
   }
   

    //添加订单
    public function creatorder(){
      global $_GPC, $_W;
      $uniacid = $_W['uniacid'];
      cache_write('uniacid', $uniacid);
      $goodarr = $this->jsondata($_GPC['goodarr']);
      if(!empty($_GPC['cf_orser'])){
         $back_orders  = $_GPC['cf_orser'];
      }else{
         $back_orders  = $this->getordernum();
      }
      $openid = $_GPC['openid'];
      $vip_log = pdo_get("hyb_yl_vip_log",array("uniacid"=>$uniacid,"openid"=>$openid));
      if($vip_log['endtime'] > time()){
        $is_vip = true;
      }else{
        $is_vip = false;
      }
      $vip_dk = "0.00";
      foreach($goodarr as &$goods)
      {
        $good = pdo_fetch("select hy_money,smoney from ".tablename("hyb_yl_goodsarr")." where uniacid=".$uniacid." and sid=".$goods['sid']);
        if($is_vip)
        {
          $vip_dk += $good['hy_money'] * $goods['num'];
        }

      }
      $orders  = $this->getordernum();
      $chufangorderinfo = pdo_fetch("select * from ".tablename("hyb_yl_chufang")." where uniacid=:uniacid and c_id=:c_id",array(":uniacid"=>$uniacid,":c_id"=>$_GPC['cid']));


      $conets  = $this->jsondata($_GPC['conets']);
      //未支付订单时间
      $order_time = pdo_get("hyb_yl_wenzhenrule",array('uniacid'=>$uniacid));
      if($_GPC['money'] == '0'){
        $chaoshi = $order_time['p_jiezhen'];
      }else{
        $chaoshi = $order_time['chaoshi'];
      }
      $data =array(
         'uniacid'   => $uniacid,
         'u_id'      => $_GPC['u_id'],
         'sid'       => serialize($goodarr),
         'createTime'=> date("Y-m-d H:i:s"),
         'gg_id'     => $_GPC['gg_id'],
         'orderNo'      => $orders,
         'deliverMoney' => $_GPC['deliverMoney'],
         'totalMoney'   => $_GPC['totalMoney'],
         'realTotalMoney'  => $_GPC['realTotalMoney'],
         'isPay'           => 0,
         'feight'       => $_GPC['feight'],
         'num'          => $_GPC['num'],
         'addressId'    => $_GPC['addressid'],
         'openid'       => $_GPC['openid'],
         'conets'       => serialize($conets),
         'ifshop'        => $_GPC['ifshop'],
         'key_words'    => $_GPC['key_words'],
         'j_id'         => $_GPC['j_id'],
         'cid'          => $_GPC['cid'],
         'zid'          => $_GPC['zid'],
         'ifCf'         => $_GPC['ifcf'],
         'back_orders'  => $back_orders,
         "vip_dk"       => $vip_dk,
         "mode"         => $_GPC['mode'],
         'goodstype'    => $_GPC['goodstype']
        );

      $is_shenhe = pdo_getcolumn("hyb_yl_ys_rule",array("uniacid"=>$uniacid),'is_shenhe');
      $yaoshi = pdo_getall("hyb_yl_yaoshi",array("uniacid"=>$uniacid));
      if($is_shenhe == '0' || count($yaoshi) == 0)
      {
        $data['status'] = '1';
        $data['sh_time'] = time();
      }
      pdo_insert("hyb_yl_goodsorders",$data);
      $id = pdo_insertid();
      pdo_update('hyb_yl_chufang',array('kf_time'=>strtotime('now')),array('c_id'=>$_GPC['cid']));
      $orderNo = pdo_get("hyb_yl_goodsorders",array('id'=>$id,'uniacid'=>$uniacid));

      echo json_encode($orderNo['orderNo']);
    }
    //支付
    public function pay() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        require_once dirname(dirname(dirname(__FILE__)))."/wxpay.php";
        cache_write('uniacid',$_W['uniacid']);
        $res = pdo_get('hyb_yl_parameter', array('uniacid' => $_W['uniacid']));
        $appid = $res['appid'];
        $openid = $_GPC['openid'];
        $mch_id = $res['mch_id'];
        $key = $res['pub_api'];
        $out_trade_no = $_GPC['orderNo'];
        $total_fee = $_GPC['z_tw_money'];
        $noturl = 'http://'.$_SERVER['SERVER_NAME'].''; //通知地址 
        if (empty($total_fee)) {
            $body = '订单付款';
            $total_fee = floatval(99 * 100);
        } else {
            $body = '订单付款';
            $total_fee = floatval($total_fee * 100);
        }
        $weixinpay = new WeixinPay($appid, $openid, $mch_id, $key, $out_trade_no, $body, $total_fee,$noturl);
        $return = $weixinpay->pay();
        echo json_encode($return);
    } 
    //处方资料
    public function cfcreate(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $openid = $_GPC['openid'];
        $content =$this->jsondata($_GPC['content']);
        $data=array(
            'uniacid' => $uniacid,
            'content' => serialize($content),
            'openid'  => $openid,
            'timeStar'=> date("Y-m-d H:i:s"),
            'j_id'    => $_GPC['j_id'],
            'typeSate'=> $_GPC['typeSate']
          );
       $res = pdo_insert("hyb_yl_userchufang",$data);
       $cf_id = pdo_insertid();
       echo json_encode($cf_id);
    }
    public function creatuseraddress(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $openid = $_GPC['openid'];
        $userName = $_GPC['userName'];
        $userPhone = $_GPC['userPhone'];
        $userAddress = $_GPC['userAddress'];
        $pdo_get = pdo_fetch("SELECT * FROM".tablename('hyb_yl_user_address')."where uniacid='{$uniacid}' and openid='{$openid}' and userName='{$userName}' and userPhone='{$userPhone}' and userAddress='{$userAddress}'");
        if($pdo_get){
           $inf = $pdo_get;
          }else{
            $data =array(
               'uniacid'  =>$uniacid,
               'openid'   =>$openid,
               'userName' =>$userName,
               'userPhone'=>$userPhone,
               'userAddress'=>$userAddress,
               'createTime' =>date("Y-m-d H:i:s")
              );
            $res = pdo_insert('hyb_yl_user_address',$data);
            $id  = pdo_insertid();
            $inf = pdo_get('hyb_yl_user_address',array('uniacid'=>$uniacid,'addressId'=>$id));

          }
         $g_baoyou = $_GPC['g_baoyou'];
         $yf_id = $_GPC['yf_id'];
      
        if($g_baoyou=='0'){

           $userAddress = explode('-', $inf['userAddress']);
           $city = $userAddress[0];
           //查询这个字段是否在数据库字段中
           $sql = "select * from ".tablename('hyb_yl_yunfei')." where id='{$yf_id}' and uniacid='{$uniacid}'";
           $resinfo = pdo_fetch($sql);
           $detail = unserialize($resinfo['detail']);

           if(!empty($_GPC['yf_id'])){
             $result = array_shift($detail);
           }
        
           foreach ($detail as $key => $value) {
           //查询是否在数组中
             $addressArr = explode(',', $value['address']);
              if(in_array($city,$addressArr)){
                $inf['first'] = $value['first']; //多少件内运费
                $inf['first_price'] = $value['first_price'];//多少件内运费
                $inf['continue'] = $value['continue'];//c超过多少件
                $inf['continue_price'] = $value['continue_price'];//c超过多少件运费
              }else{
                $inf['first'] = 0.00; //多少件内运费
                $inf['first_price'] = 0.00;//多少件内运费
                $inf['continue'] = 0.00;//c超过多少件
                $inf['continue_price'] = 0.00;//c超过多少件运费
              }
           }
         }
        echo json_encode($inf);
       }

   //订单列表  
    public function allshoporder()
    {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $openid = $_GPC['openid'];
        $index  = $_GPC['index'];
        if($index==0){
          //所有订单
          $res = pdo_fetchall("SELECT * FROM".tablename("hyb_yl_goodsorders")." as a left join".tablename("hyb_yl_goodsarr")."as b on b.sid=a.sid where a.uniacid='{$uniacid}' and  a.openid='{$openid}'");
        }
        if($index==1){
          //待付款
          $res = pdo_fetchall("SELECT * FROM".tablename("hyb_yl_goodsorders")." as a left join".tablename("hyb_yl_goodsarr")."as b on b.sid=a.sid where a.uniacid='{$uniacid}' and  a.openid='{$openid}' and a.orderStatus='-2'"); 
        }
        if($index==2){
         //待收货
          $res = pdo_fetchall("SELECT * FROM".tablename("hyb_yl_goodsorders")." as a left join".tablename("hyb_yl_goodsarr")."as b on b.sid=a.sid where a.uniacid='{$uniacid}' and  a.openid='{$openid}' and a.orderStatus='1'"); 
        }
        if($index==3){
        //已完成
          $res = pdo_fetchall("SELECT * FROM".tablename("hyb_yl_goodsorders")." as a left join".tablename("hyb_yl_goodsarr")."as b on b.sid=a.sid where a.uniacid='{$uniacid}' and  a.openid='{$openid}' and a.orderStatus='2'"); 
        }
        foreach ($res as $key => $value) {
          $res[$key]['sthumb'] = $_W['attachurl'].$res[$key]['sthumb'];
          $res[$key]['code'] =$this->code($res[$key]['orderStatus']);
        } 
        echo json_encode($res);
    }
       public function code($code){
        global $_GPC, $_W;
        $data=array(
            '已拒收' =>'-3',
            '待支付' =>'-2',
            '已取消' =>'-1',
            '待发货' =>'0',
            '配送中' =>'1',
            '已收货' =>'2',
          );
         $subject_type = array_search($code,$data);
         return $subject_type;
       }
    public function upstatus(){
       global $_GPC, $_W;
       $uniacid = $_W['uniacid'];
       $id = $_GPC['id'];
       $orderStatus = $_GPC['orderStatus'];
       $order = pdo_get("hyb_yl_goodsorders",array("uniacid"=>$uniacid,"id"=>$id));
       $jiesuan_set = pdo_get("hyb_yl_jiesuan_set",array("uniacid"=>$uniacid));
       $docmoney = '0';
       $ysmoney = "0";
       $ptmoney = "";
       if($order['zid'] != '0')
       {
        $zhuanjia = pdo_get("hyb_yl_zhuanjia",array("uniacid"=>$uniacid,"zid"=>$order['zid']));
        if(!empty($zhuanjia['ky_cut']))
        {
          $zky_cut = $zhuanjia['ky_cut'];
        }else if(!empty($jiesuan_set['doc_cut']))
        {
          $zky_cut = $zhuanjia['zky_cut'];
        }
        $docmoney = $order['realTotalMoney'] * $zky_cut / 100;
        $data = array(
            'uniacid' => $uniacid,
            "openid" => $order['openid'],
            "money" => $order['realTotalMoney'] * $zky_cut / 100,
            "zid" => $zhuanjia['zid'],
            "creared" => time(),
            "old_money" =>$order['realTotalMoney'],
            "type" =>'0',
            "style" => '1',
            "status" => '1',
            "cash" => '0'
        );
        pdo_insert("hyb_yl_pay",$data);
        $z_money = $zhuanjia['money'] + $order['realTotalMoney'] * $zky_cut / 100;
        pdo_update("hyb_yl_zhuanjia",array("money"=>$money),array("zid"=>$zhuanjia['zid']));
       }
       if($order['yid'] != '0')
       {
        $yaoshi = pdo_get("hyb_yl_yaoshi",array("uniacid"=>$uniacid,"id"=>$order['yid']));
        if(!empty($yaoshi))
        {
          $ys_cut = $yaoshi['cut'];
        }else if(!empty($jiesuan_set['yaoshi_cut']))
        {
          $ys_cut = $yaoshi['cut'];
        }
        $ysmoney = $order['realTotalMoney'] * $ys_cut / 100;
        $datas = array(
            'uniacid' => $uniacid,
            "openid" => $order['openid'],
            "money" => $order['realTotalMoney'] * $ys_cut / 100,
            "yid" => $yaoshi['id'],
            "creared" => time(),
            "old_money" =>$order['realTotalMoney'],
            "type" =>'0',
            "style" => '6',
            "status" => '1',
            "cash" => '0'
        );
        pdo_insert("hyb_yl_pay",$datas);
        $ys_money = $yaoshi['money'] + $order['realTotalMoney'] * $ys_cut / 100;
        pdo_update("hyb_yl_yaoshi",array("money"=>$money),array("id"=>$yaoshi['id']));
       }
       if($order['hid'] != '0')
       {
        $hospital = pdo_get("hyb_yl_hospital",array("uniacid"=>$uniacid,"id"=>$order['hid']));
        if(!empty($hospital))
        {
          $hos_cut = $hospital['cut'];
        }else if(!empty($jiesuan_set['hos_cut']))
        {
          $hos_cut = $hospital['cut'];
        }
        $ptmoney = $order['realTotalMoney'] * $hos_cut / 100;
        $datas = array(
            'uniacid' => $uniacid,
            "openid" => $order['openid'],
            "money" => $ptmoney,
            "hid" => $hospital['id'],
            "creared" => time(),
            "old_money" =>$order['realTotalMoney'],
            "type" =>'0',
            "style" => '8',
            "status" => '1',
            "cash" => '0'
        );
        pdo_insert("hyb_yl_pay",$datas);
        
       }
       
       $res = pdo_update("hyb_yl_goodsorders",array('orderStatus'=>$orderStatus,'ysmoney'=>$ysmoney,'docmoney'=>$docmoney,'ptmoney'=>$ptmoney),array('id'=>$id,'uniacid'=>$uniacid));
       echo json_encode($res);
    }
    //订单详情
    public function getoneorder(){
       global $_GPC, $_W;
       $uniacid = $_W['uniacid'];
       $id = $_GPC['id'];
       $sid = $_GPC['sid'];
       $res = pdo_fetch("SELECT * FROM".tablename('hyb_yl_goodsorders')."as a left join ".tablename('hyb_yl_goodsarr')."as b on b.sid=a.sid left join".tablename('hyb_yl_user_address')."as c on c.addressId=a.addressId where a.id='{$id}'");
       $res['sthumb']= $_W['attachurl'] . $res['sthumb'];
       echo json_encode($res);
    }
    public function delete(){
      global $_GPC, $_W;
      $uniacid = $_W['uniacid'];
      $id = $_GPC['id'];
      $res = pdo_update('hyb_yl_goodsorders',array('orderStatus'=>-1),array('id'=>$id));
      //$res = pdo_delete("hyb_yl_goodsorders",array('id'=>$id));
      echo json_encode($res);
    }
       public function jsondata($data)
   {
        $value =htmlspecialchars_decode($data);
        $array =json_decode($value);
        $object =json_decode(json_encode($array),true);
        return $object;
    }
   public function pinglun(){
    global $_W,$_GPC;
    $uniacid =$_W['uniacid'];  
    $sid =$_GPC['sid'];
    $res = pdo_fetchall("SELECT a.*,b.u_name,b.u_thumb FROM".tablename('hyb_yl_pinglunsite')."as a left join".tablename("hyb_yl_userinfo")."as b on b.openid=a.useropenid where a.uniacid='{$uniacid}' and a.sid ='{$sid}' order by a.pl_time desc limit 5");
    //查询
    foreach ($res as $key => $value) {
      $res[$key]['pl_text'] = unserialize($res[$key]['pl_text']);
      $res[$key]['dengj'] = intval($res[$key]['dengj']);
      $pl_time =strtotime($res[$key]['pl_time']);
      $res[$key]['pl_time'] = date("Y-m-d",$pl_time);
    }
       echo json_encode($res);
   }
   //优惠券
   public function yhuq(){
      global $_W,$_GPC;
      $uniacid =$_W['uniacid'];  
      $res = pdo_fetchall("SELECT * FROM".tablename("hyb_yl_store_sale")."where uniacid='{$uniacid}'");
      echo json_encode($res);
   }
   //评论详情
   public function Detailpl(){
      global $_W,$_GPC;
      $uniacid =$_W['uniacid'];  
      $pl_id = $_GPC['pl_id'];
      //pdo_get("hyb_yl_pinglunsite",array('uniacid'=>$uniacid,'pl_id'=>$pl_id));
      $res = pdo_fetch("SELECT a.*,b.sname,b.sthumb,c.openid,c.u_name,c.u_thumb FROM".tablename('hyb_yl_pinglunsite')."as a left join".tablename("hyb_yl_goodsarr")."as b on b.sid=a.sid left join".tablename("hyb_yl_userinfo")."as c on c.openid=a.openid where a.uniacid='{$uniacid}' and a.pl_id='{$pl_id}' ");
      $res['pl_text'] = unserialize($res['pl_text']);
      $res['sthumb'] = $_W['attachurl'].$res['sthumb'];
      $res['dengj'] = intval($res['dengj']);
      $pl_time =strtotime($res['pl_time']);
      $res['pl_time'] = date("Y-m-d",$pl_time);
      echo json_encode($res);
   }
   //分类商品列表
   public function allfenlgoods(){
    global $_GPC,$_W;
    $uniacid = $_W['uniacid'];
    $fid = !empty($_GPC['fid'])?$_GPC['fid']:'0';
    $where = "where a.uniacid='{$uniacid}' ";
    if(empty($fid)){
      $where .="";
    }else{
      $where .="  and a.g_id='{$fid}'";
    }
    $row  = pdo_fetchall("SELECT a.sname,a.sthumb,a.smoney,a.sid,a.spxl,b.fid,b.fenlname FROM".tablename('hyb_yl_goodsarr')."as a left join ".tablename('hyb_yl_goodsfenl')."as b on b.fid=a.g_id ".$where."");
    foreach ($row as $key => $value) {
      $row[$key]['sthumb'] = $_W['attachurl'].$row[$key]['sthumb'];
    }
    echo json_encode($row);
   }
     public function getordernum(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $res = pdo_get('hyb_yl_parameter', array('uniacid' => $_W['uniacid']));
        $mch_id = $res['mch_id'];
        $out_trade_no = $mch_id . time();
        return $out_trade_no;
     }
     public function upgoodstatus(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        $detail = pdo_update('hyb_yl_goodsorders',array('orderStatus'=>2),array('id'=>$id));
        $detail['sid'] = unserialize($detail['sid']);
        echo json_encode($detail);
     }
     public function getquanxian(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $id = $_GPC['id'];
        $res = pdo_get('hyb_yl_goodsorders',array());
     }
}


