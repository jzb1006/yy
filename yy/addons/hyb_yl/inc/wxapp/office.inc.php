<?php

 class Office extends HYBPage
 { 
  
  public function fllist(){
    global $_GPC, $_W;

    $uniacid = $_W['uniacid'];
    $res = pdo_fetchall("SELECT * FROM".tablename('hyb_yl_fwlist_copy')."as a left join".tablename('hyb_yl_crowd')."as b on b.id=a.fl_id where a.uniacid='{$uniacid}'");
    foreach ($res as $key => $value) {
      $res[$key]['thumb'] =$_W['attachurl'].$res[$key]['thumb'];
    }
    echo json_encode($res);
  }
  public function fllistdoc(){
    global $_GPC, $_W;
    $model = Model('crowd');
    $uniacid = $_W['uniacid'];
    $res = $model->where("uniacid=$uniacid")->getall();
    foreach ($res as $key => $value) {
      $res[$key]['thumb'] =$_W['attachurl'].$res[$key]['thumb'];
    }
    echo json_encode($res);
  }

   public function qianyue()
  {
     global $_GPC, $_W;
     $model = Model('zhuanjteam');
     $uniacid = $_W['uniacid'];
     $t_id = $_GPC['t_id'];
     $res = $model->where("uniacid=$uniacid and t_id=$t_id")->get();
     $res['doc'] = pdo_fetchall("SELECT a.*,b.z_name,b.z_thumbs FROM".tablename("hyb_yl_yaoqingdoc")." as a left join".tablename("hyb_yl_zhuanjia")."as b on b.zid =a.zid where a.uniacid='{$uniacid}' and a.t_id='{$t_id}' and a.yao_type=1");
     foreach ($res['doc']as $key => $value) {
       $res['doc'][$key]['z_thumbs'] = $_W['attachurl'].$res['doc'][$key]['z_thumbs'];
     }
     echo json_encode($res);
  }
 
 public function allinfo(){
     global $_GPC, $_W;
     $model = Model('fwlist');
     $uniacid = $_W['uniacid'];
     $value =htmlspecialchars_decode($_GPC['arr']);
     $array =json_decode($value);
     $object =json_decode(json_encode($array),true);
     $data =array();
     foreach ($object as $key => $value) {
       $pid=$value['id'];
       $data[]= pdo_fetchall("SELECT * FROM".tablename('hyb_yl_fwlist')."as a left join".tablename('hyb_yl_crowd')."as b on b.id =a.pid where a.uniacid=$uniacid and a.pid=$pid order by a.ff_id asc");
      }
      $merged = call_user_func_array('array_merge', $data);
      foreach ($merged as $key => $value) {
        $merged[$key]['fw_pic'] = $_W['attachurl'].$merged[$key]['fw_pic'];
      }
      echo json_encode($merged);
 }

     public function fwdetail(){
       global $_GPC, $_W;
       $model = Model('fwlist');
       $uniacid = $_W['uniacid'];
       $ff_id = $_GPC['ff_id'];
       $res =$model->where("uniacid=$uniacid and ff_id=$ff_id")->get();
       $res['fw_pic'] = $_W['attachurl'].$res['fw_pic'];
       echo json_encode($res);
     }

     public function addorders(){
       global $_GPC, $_W;
       $model = Model('qianyueorder');
       $uniacid = $_W['uniacid'];
       $value =htmlspecialchars_decode($_GPC['ff_id']);
       $array =json_decode($value);
       $object =json_decode(json_encode($array),true);
       $ff_id= implode(',', $object);
       $data = array(
          'uniacid' => $uniacid,
          'openid'  => $_GPC['openid'],
          'j_id'  => $_GPC['j_id'],
          'ordernum'  => date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8),
          'qyimg'     => $_GPC['qyimg'],
          'qmimg'     => $_GPC['qmimg'],
          'money'     => $_GPC['money'],
          'pid'       => $ff_id,
          'overtime'  => strtotime('now'),
          'name'      => $_GPC['name'],
          'names'     => $_GPC['names'],
          't_id'      => $_GPC['t_id'],
          'sid'       => $_GPC['sid'],
          'time'      => strtotime('now'),
          'ispay'     => $_GPC['ispay'],
          'zid'       => $_GPC['zid']
        );
       $model->add($data);
       $q_id = pdo_insertid();
       $res = $model->where("q_id=$q_id and uniacid=$uniacid")->get();
       echo json_encode($res);
     }
     public function fwlist(){
         global $_GPC, $_W;
         $uniacid = $_W['uniacid'];
         $t_id = intval($_GPC['t_id']);
         $res = pdo_fetchall("SELECT * FROM".tablename("hyb_yl_fwlist_copy")."as a left join".tablename("hyb_yl_fwlist")."as b on a.ff_id=b.ff_id where a.uniacid='{$uniacid}' and a.t_id='{$t_id}' ");
         echo json_encode($res);
     }
     //查询人群下的所有服务包
     public function allfwb(){
         global $_GPC, $_W;
         $uniacid = $_W['uniacid'];
         $model = Model('fwlist');
         $id = $_GPC['id'];
         $res = $model->where("uniacid=$uniacid and pid = $id")->getall();
         echo json_encode($res);
     }
     public function bmtempetid(){
         global $_GPC, $_W;
         $uniacid = $_W['uniacid'];
         $res = pdo_get('hyb_yl_wxapptemp',array('uniacid'=>$uniacid));
         $qiany = $res['qiany'];
         echo json_encode($res);
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
         $template_id = $wxapptemp['qiany']; 
         $tokenUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$appsecret}";
         $getArr = array();
         $tokenArr = json_decode($this->send_post($tokenUrl, $getArr, "GET"));
         $access_token = $tokenArr->access_token;
         $url = 'https://api.weixin.qq.com/cgi-bin/message/subscribe/send?access_token=' . $access_token;
         $data_time = date("Y-m-d H:i:s");
         $dd['data']  = [
            'name1'   =>['value' =>$username],
            'phrase2' =>['value' =>'家庭医生'],
            'date3'   =>['value' =>$data_time]
          ];   
         $dd['touser'] = $openid;
         $dd['template_id'] = $template_id;
         $dd['page'] = 'hyb_yl/tabBar/index/index'; 
         $result1 = $this->https_curl_json($url, $dd, 'json');
         echo json_encode($result1);
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


