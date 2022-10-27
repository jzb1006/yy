<?php
/**
* 
*/
 class Tuwen extends HYBPage
 { 

   public function addbl()
  {
     global $_GPC, $_W;
     $model = Model('twenorder');
     $uniacid = $_W['uniacid'];
     $content = $this->jsondata($_GPC['conets']);
     $biaoqian = $this->jsondata($_GPC['biaoqian']);

     foreach ($biaoqian as $key => $value) {
        $text.= $value.',';
     }
     $bq_cont = rtrim($text,',');

     $openid = $_GPC['openid'];
     $zid   = $_GPC['zid'];
     $orders =$this->getordernum();
     $server = pdo_get("hyb_yl_doc_all_serverlist",array("uniacid"=>$uniacid,"zid"=>$zid,"key_words"=>'tuwenwenzhen'));
     $user_vip = pdo_fetch("select a.*,b.quanyi,c.quanyi as vip_quanyi from ".tablename("hyb_yl_vip_log")." as a left join ".tablename("hyb_yl_vip")." as b on b.id=a.vip left join ".tablename("hyb_yl_vip_quanyi")." as c on c.id=a.quanyi where a.uniacid=".$uniacid." and a.openid='".$openid."' and a.status=1 and a.starttime>=".time()." and a.endtime <=".time());
     if($user_vip)
     {
      $quanyi = json_decode($user_vip['vip_quanyi']);
      if(in_array('图文问诊',$quanyi)){
        $card_dk = $server['ptmoney'] - $server['hymoney'];
      }else{
        $card_dk = '0.00';
      }
     }else{
      $card_dk = '0.00';
     }
     
     $row = pdo_fetch("SELECT * FROM".tablename('hyb_yl_twenorder')."where uniacid='{$uniacid}' and zid='{$zid}' and openid='{$openid}' order by id asc limit 1 ");
     //查询未支付订单时间
     $order_time = pdo_get("hyb_yl_wenzhenrule",array('uniacid'=>$uniacid));
      if($_GPC['money'] == '0'){
        $chaoshi = $order_time['p_jiezhen'];
      }else{
        $chaoshi = $order_time['chaoshi'];
      }
     $time_b = intval($chaoshi * 60);
     $newtime  = date("Y-m-d H:i:s");
     $overtime = date("Y-m-d H:i:s",strtotime($newtime)+$time_b);
     $data = array(
         'uniacid'    => $_W['uniacid'],
         'j_id'       => $_GPC['j_id'],
         'openid'     => $_GPC['openid'],
         'zid'        => $_GPC['zid'],
         'content'    => serialize($content),
         'orders'     => $orders,
         'time'       => date("Y-m-d H:i:s"),
         'money'      => $_GPC['money'],
         'cfstate'    => $_GPC['cfstate'],
         'ifgk'       => $_GPC['ifgk'],
         'back_orser' => $orders,
         'pid'        => 0,
         'grade'      => 1,
         'role'       => $_GPC['role'],
         'xdtime'     => strtotime('now'),
         'addnum'     => $_GPC['addnum'],
         'overtime'   => strtotime($overtime),
         'biaoqian'   => $bq_cont,
         'old_money' => $_GPC['old_money'],
          'coupon_id' => $_GPC['coupon_id'],
          "coupon_dk" => $_GPC['coupon_dk'],
          "yid" => $_GPC['yid'],
          "year_dk" => $_GPC['year_dk'],
          "card_dk" => $card_dk

      	);
     if($_GPC['money'] == '0')
     {
      $data['ifpay'] = '1';
      $data['paytime'] = time();
     }
       $model->add($data);
       $id =  pdo_insertid();
       $res = $model->where('id="'.$id.'"')->get();
       // $res['overtime'] = date('Y-m-d H:i:s',$res['overtime']);
       echo json_encode($res);
  }
  

  public function listall(){
    global $_GPC, $_W;
    $uniacid = $_W['uniacid'];
    $openid  = $_GPC['openid'];
    $zid = $_GPC['zid'];
    $back_orser = $_GPC['back_orser'];
    $row = pdo_fetchall("SELECT a.time as atime,a.*,b.z_name,b.z_zhicheng,b.advertisement FROM".tablename('hyb_yl_twenorder')."as a left join".tablename('hyb_yl_zhuanjia')."as b on b.zid=a.zid where a.uniacid ='{$uniacid}' and a.zid='{$zid}' and a.openid ='{$openid}' and a.back_orser='{$back_orser}' ");
    $i=0;
    
    foreach ($row as $key => $value) {
      $row[$key]['mp3'] = tomedia($row[$key]['mp3']);
      $row[$key]['advertisement'] = tomedia($row[$key]['advertisement']);
      $row[$key]['content'] = unserialize($row[$key]['content']);
      $time = strtotime($row[$key]['time']);
      $row[$key]['time'] = date("m月d日 H:i",$time);
      if($value['role'] =='0'){
        $row[$key]['len'] = $i++;
      }
    }
    echo json_encode($row);
   }
  
public function oderstate(){
    global $_GPC, $_W;
    $uniacid = $_W['uniacid'];
    $ifpay = $_GPC['ifpay'];
    $key_words = $_GPC['key_words'];
    $openid = $_GPC['openid'];
    $timestamp = strtotime('now');


    if($ifpay =='0'){
      $where="where a.uniacid='{$uniacid}' and a.ifpay='0' and a.openid='{$openid}' and a.role=0 and a.grade=1 and a.ifgb !=1";
    }
    if($ifpay =='1'){
       $where="where a.uniacid='{$uniacid}' and a.ifpay='1' and a.openid='{$openid}' and a.role=0 and a.grade=1 and a.ifgb !=1";
    }
    if($ifpay =='2'){
      $where="where a.uniacid='{$uniacid}' and a.ifpay='2' and a.openid='{$openid}' and a.role=0 and a.grade=1 ";
    }
    if($ifpay =='3'){
       $where = "where a.uniacid='{$uniacid}' and a.role=0 and (a.ifpay='3' or a.ifpay='4') and a.grade=1  and a.openid='{$openid}'  ";
    }
    if($ifpay =='4'){
      $where="where a.uniacid='{$uniacid}' and (a.ifpay='5' or a.ifpay='6') and a.openid='{$openid}' and a.role=0 and a.grade=1";
    }
    if($ifpay =='5'){
      $where="where a.uniacid='{$uniacid}' and (a.ifpay='0' or a.ifpay='1' or a.ifpay='8') and a.openid='{$openid}' and a.role=0 and a.grade=1 and a.ifgb=1";
    }

    $res = pdo_fetchall("select a.*,b.z_name,b.z_zhicheng,b.advertisement  from".tablename('hyb_yl_twenorder')."as a left join".tablename("hyb_yl_zhuanjia")."as b on b.zid=a.zid {$where} ");
    $row = array();
    foreach ($res as $key => $value) {
     $res[$key]['content'] = unserialize($res[$key]['content']);
     $res[$key]['xdtime'] = date("Y-m-d H:i:s",$res[$key]['xdtime']);
     $res[$key]['advertisement'] = tomedia($res[$key]['advertisement']);
     $row = pdo_fetchall("select a.*,b.z_name,b.z_zhicheng,b.advertisement  from".tablename('hyb_yl_twenorder')."as a left join".tablename("hyb_yl_zhuanjia")."as b on b.zid=a.zid {$where} order by id desc");

     $wxappaid = pdo_get('hyb_yl_parameter', array('uniacid' => $uniacid));
     $wxapptemp = pdo_get('hyb_yl_wxapptemp', array('uniacid' => $uniacid));
     $appid = $wxappaid['appid'];
     $appsecret = $wxappaid['appsecret'];
     $template_id = $wxapptemp['fwSuccess']; 
    foreach ($row as $key => $value) {
     $row[$key]['content'] = unserialize($row[$key]['content']);
     $row[$key]['xdtime'] = date("Y-m-d H:i:s",$row[$key]['xdtime']);
     $row[$key]['advertisement'] = tomedia($row[$key]['advertisement']);
    }
          //查询当前时间戳是否大于数据库时间
       if($timestamp>=$value['overtime']){
           //更新数据库ifgb=1 订单关闭
            if($value['ifpay']=='2'){
                pdo_update("hyb_yl_twenorder",array('ifgb'=>'1','ifpay'=>'3'),array('back_orser'=>$value['orders']));

            }else{
                pdo_update("hyb_yl_twenorder",array('ifgb'=>'1'),array('back_orser'=>$value['orders']));
            }
            
             $tokenUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$appsecret}";
             $getArr = array();
             $tokenArr = json_decode($this->send_post($tokenUrl, $getArr, "GET"));
             $access_token = $tokenArr->access_token;
             $url = 'https://api.weixin.qq.com/cgi-bin/message/subscribe/send?access_token=' . $access_token;
             $data_time = date("Y-m-d H:i:s");
             $dd['data']  = [
                'character_string1'   =>['value' =>$value['back_orser']],
                'name2'   =>['value' =>$row[$key]['z_name']],
                'thing3'    =>['value' =>'图文问诊'.",剩余".$row[$key]['addnum']],
                'date4'    =>['value' =>date("Y-m-d H:i:s",time())],
              ];   
             $dd['touser'] = $row[$key]['openid'];
             $dd['template_id'] = $template_id;
             $dd['page'] = 'hyb_yl/mysubpages/pages/wodezixun/wodezixun?type=wenzhen&key_words=tuwenwenzhen'; 
             $result1 = $this->https_curl_json($url, $dd, 'json');
        }
    }
    
    echo json_encode($row);
}
 public function detail(){
    global $_GPC, $_W;
    $uniacid = $_W['uniacid'];
    $model = Model('chart_list');
    $openid  = $_GPC['openid'];
    $orders = $_GPC['orders'];
    $res =pdo_fetch("SELECT * FROM".tablename('hyb_yl_twenorder')."where uniacid='{$uniacid}' and orders='{$orders}'");
    echo json_encode($res);
 }
 public function oneorder(){
    global $_GPC, $_W;
    $uniacid = $_W['uniacid'];
    $id  = $_GPC['id'];
    $res =pdo_fetch("SELECT * FROM".tablename('hyb_yl_twenorder')."where uniacid='{$uniacid}' and id='{$id}'");
    $res['content'] = unserialize($res['content']);
    $res['xdtime'] = date("Y-m-d H:i:s",$res['xdtime']);
    $res['advertisement'] = tomedia($res['advertisement']);
    echo json_encode($res);
 }


 public function alldochuida(){
    global $_GPC, $_W;
    $uniacid = $_W['uniacid'];
    $id  = $_GPC['id'];
    $zid = $_GPC['zid'];
    $res =pdo_fetchall("SELECT a.*,b.z_name,b.z_zhicheng,b.advertisement FROM".tablename('hyb_yl_twenorder')."as a left join".tablename('hyb_yl_zhuanjia')."as b on b.zid=a.zid where a.uniacid ='{$uniacid}' and a.zid='{$zid}' and a.pid='{$id}' order by a.id asc");
    foreach ($res as $key => $value) {
     $res[$key]['content'] = unserialize($res[$key]['content']);
     $res[$key]['xdtime'] = date("Y-m-d H:i:s",$res[$key]['xdtime']);
     $res[$key]['advertisement'] = tomedia($res[$key]['advertisement']);
    }
    echo json_encode($res);
 }

    public function addkuaisu()
  {
     global $_GPC, $_W;
     $model = Model('chart_list');
     $uniacid = $_W['uniacid'];
     $msglist = $this->jsondata($_GPC['data_arr']);
     $zid = $_GPC['zid'];

     $openid = $_GPC['useropenid'];
     //查询患者信息
     $userinfo = pdo_get("hyb_yl_userinfo",array('openid'=>$openid));
     $myroom  = $userinfo['randnum'];
     $u_name  = $userinfo['u_name'];
     $u_thumb = $userinfo['u_thumb'];
    //查询我的真实信息
     $userjren = pdo_get("hyb_yl_zhuanjia",array('openid'=>$openid,'sick_index'=>0));
     
       //查询医生信息
        $docinfo = pdo_fetch("SELECT * FROM".tablename("hyb_yl_zhuanjia")."where uniacid='{$uniacid}' and zid = '{$zid}'");
        $data = array(
          'uniacid'   => $_W['uniacid'],
          'data_arr'  => serialize($msglist),
          'u_name'    => $u_name,
          'u_thumb'   => $u_thumb,
          'msg'       => $_GPC['msg'],
          'z_thumbs'  => $docinfo['z_thumbs'],
          'z_name'    => $docinfo['z_name'],
          'useropenid'=> $_GPC['useropenid'],
          'docopenid' => $docinfo['openid'],
          'j_id'      => $userjren['j_id'],
          'keywords'  => $_GPC['keywords'],
          'type'      => intval($_GPC['type']),
          'myroom'    => $myroom,
          'docroom'   => $docinfo['randnum'],
          'names'     => $userjren['names'],
          'name'      => $_GPC['name'],
          'zid'       => $zid,
          'orders'    => $this->getordernum(),
          'time'      => strtotime('now'),
          'money'     => $_GPC['money']
        );
        if($_GPC['money'] == '0' || $_GPC['money'] == '0.00')
        {
          $data['ifpay'] = 0;
        }
       $res = $model->add($data);
       echo json_encode($res);
     
  }

      public function jsondata($data)
   {
        $value =htmlspecialchars_decode($data);
        $array =json_decode($value);
        $object =json_decode(json_encode($array),true);
        return $object;
    }

     public function mbtxing(){
         global $_GPC, $_W;
         $uniacid = $_W['uniacid'];
         $j_id = $_GPC['j_id'];
         $zid = $_GPC['zid'];
         $docinfo = pdo_get("hyb_yl_zhuanjia",array('uniacid'=>$uniacid,'zid'=>$zid));
         $openid = $docinfo['openid'];
         $userinfo = pdo_get("hyb_yl_userjiaren",array('uniacid'=>$uniacid,'j_id'=>$j_id));
         $username = $userinfo['names'];
         $wxappaid = pdo_get('hyb_yl_parameter', array('uniacid' => $uniacid));
         $wxapptemp = pdo_get('hyb_yl_wxapptemp', array('uniacid' => $uniacid));
         $appid = $wxappaid['appid'];
         $appsecret = $wxappaid['appsecret'];
         $template_id = $wxapptemp['doctemp']; 
         $tokenUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$appsecret}";
         $getArr = array();
         $tokenArr = json_decode($this->send_post($tokenUrl, $getArr, "GET"));
         $access_token = $tokenArr->access_token;
         $url = 'https://api.weixin.qq.com/cgi-bin/message/subscribe/send?access_token=' . $access_token;
         $data_time = date("Y-m-d H:i:s");
         $dd['data']  = [
            'name1'   =>['value' =>$username],
            'time2'   =>['value' =>$data_time],
            'thing3'  =>['value' =>'图文问诊']
          ];   
         $dd['touser'] = $openid;
         $dd['template_id'] = $template_id;
         $dd['page'] = 'hyb_yl/backstageFollowUp/pages/explanation/explanation?zid='.$zid; 
         $result1 = $this->https_curl_json($url, $dd, 'json');

         $parameter = pdo_get("hyb_yl_parameter",array("uniacid"=>$uniacid));
        $uid = pdo_getcolumn("hyb_yl_boxuser",array("uniacid"=>$uniacid),'uid');
        $sn = $parameter['box_sn'];
        $m = 1;
        $token = $parameter['box_token'];
        $version = $parameter['box_version'];
        $content = $username."刚刚下了一个".$docinfo['z_name']."的图文问诊订单";
        $getArr = array();

        $url = "https://speaker.17laimai.cn/notify.php?id=".$sn."&token=".$token."&version=".$version."&message=".$content."&speed=50";
         
         $tokenArr = json_decode($this->send_post($url, $getArr, "GET"),true);
         echo json_encode($result1);
     }

     public function getordernum(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $res = pdo_get('hyb_yl_parameter', array('uniacid' => $_W['uniacid']));
        $mch_id = $res['mch_id'];
        $out_trade_no = $mch_id . time();
        return $out_trade_no;
     }
    public function https_curl_json($url, $data, $type) {
            if ($type == 'json') {
                $headers = array("Content-type: application/json;charset=UTF-8", "Accept: application/json", "Cache-Control: no-cache", "Pragma: no-cache");
                $data = json_encode($data);
            }
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
            if (!empty($data)) {
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            $output = curl_exec($curl);
            if (curl_errno($curl)) {
                echo 'Errno' . curl_error($curl); //捕抓异常
                
            }
            curl_close($curl);
            return $output;
        }
     public function send_post($url, $post_data,$method='POST') {
        $postdata = http_build_query($post_data);
        $options = array(
          'http' => array(
            'method' => $method, //or GET
            'header' => 'Content-type:application/x-www-form-urlencoded',
            'content' => $postdata,
            'timeout' => 15 * 60 // 超时时间（单位:s）
          )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        return $result;
      }
}


