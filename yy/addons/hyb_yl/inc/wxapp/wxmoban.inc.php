<?php
/**
* 
*/
 class Wxmoban extends HYBPage
 { 
   //通知医生
  public function doctemp(){
      global $_W, $_GPC;
      $uniacid = $_W['uniacid'];
      $openid = $_GPC['openid'];
      $zid = $_GPC['zid'];
      $name = $_GPC['name'];
      $bingzs = $_GPC['bingzs'];
      $bl_id = $_GPC['bl_id'];
      $oid = $_GPC['oid'];
      $allone_key = $_GPC['allone_key'];
      //改变订单状态并且通知医生
      $order = $_GPC['order'];
      pdo_update("hyb_yl_wenzorder",array('ispay'=>1),array('order'=>$order,'uniacid'=>$uniacid));
      $res = pdo_get("hyb_yl_zhuanjia",array('uniacid'=>$uniacid,'zid'=>$zid));
      $user_openid = $res['openid'];
      $userinfo = pdo_fetch("SELECT a.*,b.names,b.age,b.sex FROM".tablename('hyb_yl_userinfo')."as a left join".tablename('hyb_yl_userjiaren')."as b on b.openid=a.openid where a.uniacid='{$uniacid}' and a.openid='{$openid}'");
      $names = $userinfo['names'];
      $age = $userinfo['age'];
      $sex = $userinfo['sex'];
      $info_msg = $names.' '.$age.' '.$sex;
      $wxappaid = pdo_get('hyb_yl_parameter', array('uniacid' => $uniacid));
      $wxapptemp = pdo_get('hyb_yl_wxapptemp', array('uniacid' => $uniacid));
      $appid = $wxappaid['appid'];
      $appsecret = $wxappaid['appsecret'];
      $template_id = $wxapptemp['weidbb'];
      $tokenUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$appsecret}";
      $getArr = array();
      $tokenArr = json_decode($this->send_post($tokenUrl, $getArr, "GET"));
      $access_token = $tokenArr->access_token;
      $url = 'https://api.weixin.qq.com/cgi-bin/message/wxopen/template/send?access_token=' . $access_token;
      $user_curr = pdo_fetchall("SELECT * FROM " . tablename("hyb_yl_userinfo") . " where uniacid=:uniacid and openid=:openid", array(":uniacid" => $uniacid, ":openid" => $user_openid));
      foreach ($user_curr as $key => $value) {
        $out_time = strtotime('-7 days', time());
        $formids = unserialize($value['form_id']);
        foreach ($formids as $k => $v) {
            if ($out_time >= $v['form_time']) {
                unset($formids[$k]);
            }
        }
        $formids = array_values($formids);
        $form_id = $formids[0]['form_id'];
        $dd['form_id'] = $form_id;
        $dd['touser'] = $value['openid'];
        $content = array(
          "keyword1" => array(
            "value" => $info_msg, 
            "color" => "#4a4a4a"
            ), 
          "keyword2" => array(
            "value" => $bingzs, 
            "color" => ""
            ), 
          "keyword3" => array(
            "value" => $name, 
            "color" => ""
            ),
           "keyword4" => array(
            "value" => date("Y-m-d H:i:s"), 
            "color" => ""
            )
          );
        $dd['template_id'] = $template_id;
        if($allone_key ==1){
          $dd['page'] = 'hyb_yl/czhuanjiasubpages/pages/questends/index?datakey=2&oid='.$oid; 
        }
        if($allone_key ==2){
          $dd['page'] = 'hyb_yl/czhuanjiasubpages/pages/questends/index?datakey=2&oid='.$oid; 
        }
        
        $dd['data'] = $content; 
        $dd['color'] = ''; 
        $dd['emphasis_keyword'] = ''; 
        $result1 = $this->https_curl_json($url, $dd, 'json');
        foreach ($formids as $k => $v) {
            if ($form_id == $v['form_id']) {
                unset($formids[$k]);
            }
        }
        $new_formids = array_values($formids);
        $datas['form_id'] = serialize($new_formids);
        pdo_update('hyb_yl_userinfo', $datas, array('u_id' => $value['u_id']));
        echo json_encode($dd);
      }
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


