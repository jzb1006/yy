<?php
/**
* 
*/
 class Authorize extends HYBPage
 { 
    //获取用户信息
    public function tymember() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $openid = $_REQUEST['openid'];
        $item['u_name'] = $_GPC['u_name'];
        $item['u_thumb'] = $_GPC['u_thumb'];
        $item['uniacid'] = $uniacid;
        $item['longtime'] =date('Y-m-d H:i:s');

        if ($openid) {
            $res = pdo_update('hyb_yl_userinfo', $item, array('openid' => $openid));
        }

        echo json_encode($item);
    }
  //授权
    public function getuid() {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $result = pdo_fetch('SELECT * FROM ' . tablename('hyb_yl_parameter') . " where `uniacid`='{$uniacid}'");
        $APPID = $result['appid'];
        $SECRET = $result['appsecret'];
        $code = trim($_GPC['code']);
        $url = "https://api.weixin.qq.com/sns/jscode2session?appid={$APPID}&secret={$SECRET}&js_code={$code}&grant_type=authorization_code";
        $database['userinfo'] = json_decode($this->httpGet($url));
        $openid = $database['userinfo']->openid;
        $item['openid'] = $openid;
        $item['longtime'] =date('Y-m-d H:i:s');
     
        require_once dirname(dirname(dirname(__FILE__)))."/inc/common/wxBizDataCrypt.php";
        $sessionKey = $database['userinfo']->session_key;
        $encryptedData = $_GPC['encryptedData'];
        $iv = $_GPC['iv'];
        $pc = new WXBizDataCrypt($APPID, $sessionKey);
        $errorcode = $pc->decryptData($encryptedData, $iv, $data);
        $data  = json_decode($data,true);//$data 包含用户所有基本信息
        $item['unionId'] =$data['unionId'];
        if ($openid) {
            $u_id = pdo_getcolumn('hyb_yl_userinfo',array('openid'=>$openid,'uniacid'=>$uniacid),'u_id');
            if (!$u_id) {
               $item['zctime'] = date('Y-m-d H:i:s');
               pdo_insert('hyb_yl_userinfo', $item);
            }else{

               pdo_update('hyb_yl_userinfo', $item,array('openid'=>$openid,'uniacid'=>$uniacid)); 
            }
        }
        echo json_encode($database);
    }
    //每天记录一次登记时间
    public function logintime(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $openid = $_GPC['openid'];
        //查询今天开始时间和结束时间
        $beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));//当天开始时间戳
        $endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;//当天结束时间戳
        $res  = pdo_get("hyb_yl_userinfo",array('openid'=>$openid,'uniacid'=>$uniacid));
        $res['longtime'] = strtotime($res['longtime']);
        if($res['longtime'] >= $beginToday && $res['longtime'] <= $endToday){
           echo json_encode($res);
        }else{
           //更新用户登录时间
           $res= pdo_update("hyb_yl_userinfo",array('longtime'=>date("Y-m-d H:i:s")),array('openid'=>$openid));
           echo json_encode($res);
        }
        
    }
    private function httpGet($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_URL, $url);
        $res = curl_exec($curl);
        curl_close($curl);
        return $res;
    }
    public function ifregister(){
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $openid = $_GPC['openid'];
        $res = pdo_get("hyb_yl_userinfo",array('uniacid'=>$uniacid,'openid'=>$openid));
        echo json_encode($res['randnum']);
    }

    public function updateadmin(){
         global $_GPC, $_W;
         $uniacid = $_W['uniacid'];
         $openid = $_GPC['openid'];
         $initcode = $this->initcode();
         $data = array('randnum'=>$initcode);
         pdo_update("hyb_yl_userinfo",$data,array('openid'=>$openid));
         $res  = pdo_get('hyb_yl_userinfo',array('openid'=>$openid,'uniacid'=>$uniacid));
         echo json_encode($res['randnum']);
    }
    private function initcode(){
        $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
        $string=time();
        for(;$len>=1;$len--)
        {
            $position=rand()%strlen($chars);
            $position2=rand()%strlen($string);
            $string=substr_replace($string,substr($chars,$position,1),$position2,0);
        }
        return $string;
    }
    public function ifcunzai(){
         global $_GPC, $_W;
         $uniacid = $_W['uniacid'];
         $pub_appid = pdo_getcolumn('hyb_yl_parameter',array('uniacid'=>$uniacid),'pub_appid');
         if(empty($pub_appid)){
            echo json_encode(0);
         }else{
            echo json_encode(1);
         }
         
    }
}


