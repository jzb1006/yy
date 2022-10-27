<?php
header('Content-type: text/xml');
define('IN_SYS', true);
require '../../framework/bootstrap.inc.php';
define('dianc_ROOT', dirname(dirname(__FILE__)));
define('IS_OPERATOR', true);
require dianc_ROOT . '../../web/common/bootstrap.sys.inc.php';
//微信返回的数据
global $_GPC, $_W;
$postXml = file_get_contents("php://input"); //接收微信参数
//$postXml = $GLOBALS["HTTP_RAW_POST_DATA"];
$uniacid = cache_load('uniacid');
if (empty($postXml)) {
    return false;
}
$attr = xmlToArray($postXml);
if ($postXml) {
    $xml = simplexml_load_string($postXml);
    $money = (string)$xml->total_fee;
    $return_code = (string)$xml->return_code;
    $attach = (string)$xml->attach;
    $user_id = (string)$xml->user_id;
    $out_trade_no = (string)$xml->out_trade_no;
}
if ($attr['result_code'] == 'SUCCESS' && $attr['return_code'] == 'SUCCESS') {
    //查用户最新订单
 $key_words = cache_load('key_words');
 pdo_update("hyb_yl_goodsorders",array("isPay"=>'1','orderStatus'=>'0','paytime'=>date("Y-m-d H:i:s")),array("uniacid"=>$uniacid,"orderNo"=>$out_trade_no));
 
// if($key_words == 'yuanchengkaifang')
// {
//     $order_time = pdo_get("hyb_yl_wenzhenrule",array('uniacid'=>$uniacid));
//     $chaoshi = $order_time['p_jiezhen'];
//     $time_b = intval($chaoshi * 60);
//     $newtime  = date("Y-m-d H:i:s");
//     $overtime = date("Y-m-d H:i:s",strtotime($newtime)+$time_b); 
//     $res_one_order = pdo_update('hyb_yl_chufang',array('ispay'=>1,'paytime' => strtotime("now"),'overtime'=>strtotime($overtime)),array('uniacid'=>$uniacid,'back_orser'=>$out_trade_no));

//     $order = pdo_get("hyb_yl_chufang",array("uniacid"=>$uniacid,'back_orser'=>$out_trade_no));
//     $order['content'] = unserialize($order['content']);
//     $order['openid'] = $order['useropenid'];
//     $near = '开处方';

//     $id = $order['c_id'];
// }else if($key_words == 'tuwenwenzhen')
// {
//     $order_time = pdo_get("hyb_yl_wenzhenrule",array('uniacid'=>$uniacid));
//     $chaoshi = $order_time['p_jiezhen'];
//     $time_b = intval($chaoshi * 60);
//     $newtime  = date("Y-m-d H:i:s");
//     $overtime = date("Y-m-d H:i:s",strtotime($newtime)+$time_b); 
//     $res_one_order = pdo_update('hyb_yl_twenorder', array('ifpay' => 1, 'paytime' => strtotime("now"),'overtime'=>strtotime($overtime)), array('uniacid' => $uniacid, 'back_orser' => $out_trade_no));
//     $order = pdo_get("hyb_yl_twenorder",array("uniacid"=>$uniacid,"back_orser"=>$out_trade_no));
//     $order['content'] = unserialize($order['content']);
//     $near = '图文';

//     $id = $order['id'];

// }else if($key_words == 'dianhuajizhen' || $key_words == 'shipinwenzhen' || $key_words == 'shoushukuaiyue' || $key_words == 'tijianjiedu')
// {
//     $order_time = pdo_get("hyb_yl_wenzhenrule",array('uniacid'=>$uniacid));
//     $chaoshi = $order_time['p_jiezhen'];
//     $time_b = intval($chaoshi * 60);
//     $newtime  = date("Y-m-d H:i:s");
//     $overtime = date("Y-m-d H:i:s",strtotime($newtime)+$time_b); 
//     $res_one_order = pdo_update('hyb_yl_wenzorder',array('ifpay'=>1,'paytime' => strtotime("now"),'overtime'=>strtotime($overtime)),array('uniacid'=>$uniacid,'back_orser'=>$out_trade_no));

//     $order = pdo_get("hyb_yl_wenzorder",array("uniacid"=>$uniacid,"back_orser"=>$out_trade_no));
//     $order['content'] = unserialize($order['describe']);
//     if($key_words == 'dianhuajizhen')
//     {
//         $near = '电话';
//     }else if($key_words == 'shipinwenzhen')
//     {
//         $near = '视频';
//     }else if($key_words == 'shoushukuaiyue')
//     {
//         $near = '手术快约';
//     }else if($key_words == 'tijianjiedu')
//     {
//         $near = '报告解读';
//     }

//     $id = $order['id'];

// }else if($key_words == 'yuanchengguahao')
// {
//     $res = pdo_update('hyb_yl_guahaoorder',array('ifpay'=>1,'paytime' => strtotime("now")),array('uniacid'=>$uniacid,'orders'=>$out_trade_no));
//     $order = pdo_get("hyb_yl_guahaoorder",array("uniacid"=>$uniacid,"back_orser"=>$out_trade_no));
    
//     pdo_update("hyb_yl_user_coupon",array("status"=>'1'),array("id"=>$order['coupon_id']));
//     pdo_update("hyb_yl_user_yearcard",array("status"=>'1'),array("id"=>$order['yid']));

//     $id = $order['id'];
// }else if($key_words == 'goods')
// {
//     pdo_update("hyb_yl_goodsorders",array("isPay"=>'1','orderStatus'=>'0','paytime'=>date("Y-m-d H:i:s",time())),array("uniacid"=>$uniacid,"orderNo"=>$out_trade_no));
// }


// $zhuanjia = pdo_get("hyb_yl_zhuanjia",array("uniacid"=>$uniacid,"zid"=>$order['zid']));

// // 订单返利
// if($key_words == 'goods')
// {
//     $yaoshi = pdo_get("hyb_yl_yaoshi",array("uniacid"=>$uniacid,"id"=>$order['y_id']));
//     $jiesuan = pdo_get("hyb_yl_jiesuan_set",array("uniacid"=>$uniacid));
//     if($yaoshi['cut'] != '' && $yaoshi['cut'] != '0.00')
//     {
//       $ys_cut = $yaoshi['cut'];
//     }else if($jiesuan['ys_cut'] != '' && $jiesuan['ys_cut'] != '0.00')
//     {
//       $ys_cut = $jiesuan['ys_cut'];
//     }else{
//       $ys_cut = '0.00';
//     }
//     if($ys_cut != '' && $ys_cut != '0.00')
//     {
//       $data = array(
//         'uniacid' => $uniacid,
//         "openid" =>$order['openid'],
//         "money" => $order['realTotalMoney'] * $ys_cut / 100,
//         "created" => time(),
//         "back_orser" => $order['orderNo'],
//         "old_money" => $order['realTotalMoney'],
//         "keyword" => 'yuanchengkaifang',
//         "type" => '0',
//         "style" => '6',
//         "status" => '1',
//         "cash" => '0',
//         "yid" => $yaoshi['id']
//       );
//       pdo_insert("hyb_yl_pay",$data);
//       $ys_money = $yaoshi['money'] + $order['realTotalMoney'] * $ys_cut / 100;
//       pdo_update("hyb_yl_yaoshi",array("money"=>$ys_money),array("id"=>$yaoshi['money']));
//     }
//     if($zhuanjia['ks_cut'] != '' && $zhuanjia['ks_cut'] != '0.00')
//     {
//       $zj_cut = $zhuanjia['ks_cut'];
//     }else if($jiesuan['doc_cut'] != '' && $jiesuan['doc_cut'] != '0.00')
//     {
//       $zj_cut = $jiesuan['doc_cut'];
//     }else{
//       $zj_cut = '0.00';
//     }
//     if($zj_cut != '' && $zj_cut != '0.00')
//     {
//         $data = array(
//             'uniacid' => $uniacid,
//             "openid" => $openid,
//             "money" => $order['realTotalMoney'] * $zj_cut / 100,
//             "zid" => $zhuanjia['zid'],
//             "created" => time(),
//             "back_orser" => $order['orderNo'],
//             "old_money" => $order['realTotalMoney'],
//             "keyword" => 'yuanchengkaifang',
//             "type" => '0',
//             "style" => '1',
//             "status" => '1',
//             "cash" => '0',
//         );
//         pdo_insert("hyb_yl_pay",$data);
//         $z_money = $zhuanjia['total_money'] + $order['realTotalMoney'] * $zj_cut / 100;
//         pdo_update("hyb_yl_zhuanjia",array("total_money"=>$z_money),array("zid"=>$zhuanjia['zid']));
//     }
//     $sid = unserialize($order['sid']);
//     $sname = $sid[0]['sname'];
//     $hospital = pdo_fetch("select h.* from ".tablename("hyb_yl_hospital")." as h left join ".tablename("hyb_yl_goodsarr")." as g on g.jigou_two=h.hid where h.uniacid=".$uniacid." and g.sname like '%$sname%'");
//     if($hospital['cut'] != '' && $hospital['cut'] != '0.00')
//     {
//       $h_cut = $hospital['cut'];
//     }else if($jiesuan['hos_cut'] != '' && $jiesuan['hos_cut'] != '0.00')
//     {
//       $h_cut = $jiesuan['cut'];
//     }else{
//       $h_cut = '0.00';
//     }
//     if($h_cut != '' && $h_cut != '0.00')
//     {
//       $data = array(
//         'uniacid' => $uniacid,
//         "openid" => $openid,
//         "money" => $order['realTotalMoney'] * $h_cut / 100,
//         "hid" => $hospital['hid'],
//         "created" => time(),
//         "back_orser" => time(),
//         "back_orser" => $order['orderNo'],
//         "old_money" => $order['realTotalMoney'],
//         "keyword" => 'yuanchengkaifang',
//         "type" => '0',
//         "style" => '8',
//         "status" => '1',
//         "cash" => '0',
//       );
//       pdo_insert("hyb_yl_pay",$data);
//     }
//     $moneys = $hospital['money'] + $order['realTotalMoney'] - $order['realTotalMoney'] * ($ys_cut + $zj_cut + $h_cut) / 100;
//     pdo_update("hyb_yl_hospital",array("money"=>$moneys),array("uniacid"=>$uniacid,"hid"=>$hospital['hid']));
// }else{
//     if($zhuanjia)
//     {
//       if($zhuanjia['cut'] == '' || $zhuanjia['cut'] == '0.00')
//       {
//         $cut = pdo_getcolumn("hyb_yl_zhuanjia_rule",array("uniacid"=>$uniacid),'fee');
//       }else{
//         $cut = $zhuanjia['cut'];
//       }
//       if($cut != '' && $cut != '0.00')
//       {
//         $data = array(
//           'uniacid' => $uniacid,
//           "openid" => $order['openid'],
//           "money" => $order['money'] * $cut / 100,
//           "zid" => $order['zid'],
//           "created" => time(),
//           "back_orser" => $order['back_orser'],
//           "old_money" => $order['money'],
//           "keyword" => $keywords,
//           "type" => '0',
//           "style" => '8',
//           "status" => '1',
//           "cash" => '0',
//         );
//         pdo_insert("hyb_yl_pay",$data);
//       }
      
//       // 机构抽成
//       $hospital = pdo_get("hyb_yl_hospital",array("hid"=>$zhuanjia['hid']));
//       if($hospital['cut'] == '' || $hospital['cut'] == '0.00')
//       {
//         $cuts = pdo_getcolumn("hyb_yl_jiesuan_set",array("uniacid"=>$uniacid),'hos_cut');
//       }else{
//         $cuts = $hospital['cut'];
//       }
//       if($cuts != '' && $cuts != '0.00')
//       {
//         $datas = array(
//           'uniacid' => $uniacid,
//           "openid" => $order['openid'],
//           "money" => $order['money'] * $cuts / 100,
//           "hid" => $hospital['hid'],
//           "created" => time(),
//           "back_orser" => $order['back_orser'],
//           "old_money" => $order['money'],
//           "keyword" => $keywords,
//           "type" => '0',
//           "style" => '7',
//           "status" => '1',
//           "cash" => '0',
//         );
//         pdo_insert("hyb_yl_pay",$datas);
//         $h_moneys = $hospital['money'] + $order['money'] * $cuts / 100;
//         pdo_update("hyb_yl_hospital",array("money"=>$h_moneys),array("uniacid"=>$uniacid,"hid"=>$hospital['hid']));
//       }
//       $z_money = $zhuanjia['total_money'] + $order['money'] - $order['money'] * ($cut + $cuts) / 100;
//       pdo_update("hyb_yl_zhuanjia",array("uniacid"=>$uniacid,array("total_money"=>$z_money),"zid"=>$zhuanjia['zid']));
//       // hos_cut
      
//     }
// }
// require_once dirname(dirname(dirname(__FILE__))). '/inc/SignatureHelper.php';
// // 模板通知
// if($key_words != 'goods' && $key_words != 'yuanchengguahao')
// {
//     // 订单模板通知
//     $msg = unserialize($order['content']);
//     $textarea = $this->subtext($order['cotent']['text'], 10);
//     $text = $near. "问诊描述:" . $textarea;

//     $j_id = $order['j_id'];
//     $zid = $order['zid'];

//     pdo_update('hyb_yl_zhuanjia',array('ptperson'=>$zhuanjia['ptperson']+1),array('zid'=>$zid));
//     $us_openid = $zhuanjia['openid'];
//     $username =  preg_replace("/\\d+/",'', $zhuanjia['z_name']); //专家名称
//     $wxappaid = pdo_get('hyb_yl_parameter', array('uniacid' => $uniacid));
//     $wxapp_mb = unserialize($wxappaid['wxapp_mb']);

//     $appid = $wxappaid['appid'];
//     $appsecret = $wxappaid['appsecret'];
//     $template_id = $wxapp_mb['Mobile'];
//     $tokenUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$appsecret}";
//     $getArr = array();
//     $tokenArr = json_decode($this->send_post($tokenUrl, $getArr, "GET"));
//     $access_token = $tokenArr->access_token;
//     $url = 'https://api.weixin.qq.com/cgi-bin/message/subscribe/send?access_token=' . $access_token;
//     $data_time = date("Y-m-d H:i:s");
//     //专家回复
//     $doctor_over_msg = "患者发起" . $near . "咨询";
//     //专家回复时间￥
//     $doctor_over_time = "请在小程序专家端查看";
//     $dd['data'] = [
//     'thing1' => ['value' => $textarea], 
//     'thing2' => ['value' => $doctor_over_msg], 
//     'name3' =>  ['value' => $username], 
//     'thing4' => ['value' => $doctor_over_time], 
//     ];
//     $dd['touser'] = $us_openid;
//     $dd['template_id'] = $template_id;

//     if($near == '开处方')
//     {
//         $dd['page'] = 'hyb_yl/zhuanjiasubpages/pages/zhuanjiahuida/zhuanjiahuida?id='.$id.'&zid='.$zid.'&typedate='.$order['content']['typedate'].'&key_words=yuanchengkaifang&openid='.$order['openid'].'&back_orser='.$order['back_orser'].'&j_id='.$order['j_id'].'&docindex=1&ifpay='.$order['ifpay'];
//     }else if($near == '图文')
//     {
//         $dd['page'] = 'hyb_yl/zhuanjiasubpages/pages/zhuanjiahuida/zhuanjiahuida?id='.$id.'&zid='.$zid.'&typedate='.$order['content']['typedate'].'&key_words=tuwenwenzhen&openid='.$order['openid'].'&back_orser='.$order['back_orser'].'&j_id='.$order['j_id'].'&docindex=1&ifpay='.$order['ifpay'].'&overtime='.$order['overtime'];
        
//     }else if($near == '电话')
//     {
//         $dd['page'] = 'hyb_yl/zhuanjiasubpages/pages/zhuanjiahuida/zhuanjiahuida?id='.$id.'&zid='.$zid.'&typedate='.$order['content']['typedate'].'&key_words=dianhuajizhen&openid='.$order['openid'].'&back_orser='.$order['back_orser'].'&j_id='.$order['j_id'].'&docindex=1&ifpay='.$order['ifpay'].'&overtime='.$order['overtime'];
//     }else if($near == '视频')
//     {
//         $dd['page'] = 'hyb_yl/zhuanjiasubpages/pages/zhuanjiahuida/zhuanjiahuida?id='.$id.'&zid='.$zid.'&typedate='.$order['content']['typedate'].'&key_words=shipinwenzhen&openid='.$order['openid'].'&back_orser='.$order['back_orser'].'&j_id='.$order['j_id'].'&docindex=1&ifpay='.$order['ifpay'].'&overtime='.$order['overtime'];
//     }else if($near == '手术快约')
//     {
//         $dd['page'] = 'hyb_yl/zhuanjiasubpages/pages/zhuanjiahuida/zhuanjiahuida?id='.$id.'&zid='.$zid.'&typedate='.$order['content']['typedate'].'&key_words=shoushukuaiyue&openid='.$order['openid'].'&back_orser='.$order['back_orser'].'&j_id='.$order['j_id'].'&docindex=1&ifpay='.$order['ifpay'].'&overtime='.$order['overtime'];
//     }else if($near == '报告解读')
//     {
//         $dd['page'] = 'hyb_yl/zhuanjiasubpages/pages/zhuanjiahuida/zhuanjiahuida?id='.$id.'&zid='.$zid.'&typedate='.$order['content']['typedate'].'&key_words=tijianjiedu&openid='.$order['openid'].'&back_orser='.$order['back_orser'].'&j_id='.$order['j_id'].'&docindex=1';
//     }
//     else
//     {
//         $id = pdo_fetchcolumn("select id from ".tablename("hyb_yl_docser_speck")." where uniacid=".$uniacid." and key_words ='yuanchengkaifang'");
//         $dd['page'] = 'hyb_yl/mysubpages/pages/docorder/docorder?titlme=图文问诊&key_words=tuwenwenzhen&id='.$id.'&zid='.$zid.'&z_telephone='.$user['z_telephone'];
//     }

//     $result1 = $this->https_curl_json($url, $dd, 'json');

//     $date_info_time = pdo_get('hyb_yl_wenzhenrule',array('uniacid'=>$uniacid),array('p_jiezhen'));
//     $time = $date_info_time['p_jiezhen'];
//     $aliduanxin = pdo_fetch("SELECT * FROM " . tablename("hyb_yl_duanxin") . "WHERE uniacid = '{$uniacid}' ");
//     $mobel = unserialize($aliduanxin['moban_id']);
//     if ($aliduanxin['stadus'] == 1 ) {

//         $myinfo = pdo_fetch("SELECT * FROM " . tablename("hyb_yl_userjiaren") . "WHERE uniacid = '{$uniacid}' and  j_id ='{$j_id}'");
//         $name = $myinfo['names'];
//         $phoneNum = $myinfo['tel'];
//         $doname = pdo_fetch("SELECT * FROM " . tablename("hyb_yl_zhuanjia") . "as a left join" . tablename('hyb_yl_ceshi') . "as b on b.id=a.parentid WHERE a.uniacid = '{$uniacid}' and a.zid ='{$zid}'");
//         $doctor = $doname['z_name']."(".$text.")";
//         $ksname = $doname['name'];
//         $accessKeyId = $aliduanxin['key'];
//         $accessKeySecret = $aliduanxin['scret'];
//         $params["PhoneNumbers"] = $doname['z_telephone'];
//         $params["SignName"] = $aliduanxin['qianming'];
//         $params["TemplateCode"] = $mobel['kfmobel']; 
//         $params['TemplateParam'] = Array('name' => $name, 'time' => $time);
//         if (!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
//             $params["TemplateParam"] = json_encode($params["TemplateParam"]);
//         }
//         $helper = new SignatureHelper();
//         $content = $helper->request($accessKeyId, $accessKeySecret, "dysmsapi.aliyuncs.com", array_merge($params, array("RegionId" => "cn-hangzhou", "Action" => "SendSms", "Version" => "2017-05-25",)));
//     }
// }else if($key_words == 'yuanchengguahao'){
//     $j_id = $order['j_id'];
//      $zid = $order['zid'];
//      $openid = $zhuanjia['openid'];
//      $z_name = $zhuanjia['z_name'];
//      //查询机构
//      $hid = $zhuanjia['hid'];
//      $hos_jigou = pdo_get('hyb_yl_hospital',array('hid'=>$hid),array('agentname'));
//      //查询科室
//      $parentid = $hos_jigou['parentid'];
//      $k_shi_one = pdo_get('hyb_yl_ceshi',array('id'=>$parentid));
//      $userinfo = pdo_get("hyb_yl_userjiaren",array('uniacid'=>$uniacid,'j_id'=>$j_id));
//      $username = $userinfo['names'];
//      $sex = $userinfo['sex'];
//      $wxappaid = pdo_get('hyb_yl_parameter', array('uniacid' => $uniacid));
//      $wxapptemp = pdo_get('hyb_yl_wxapptemp', array('uniacid' => $uniacid));
//      $appid = $wxappaid['appid'];
//      $appsecret = $wxappaid['appsecret'];
//      $template_id = $wxapptemp['overtime']; 
//      $tokenUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$appsecret}";
//      $getArr = array();
//      $tokenArr = json_decode($this->send_post($tokenUrl, $getArr, "GET"));
//      $access_token = $tokenArr->access_token;
//      $url = 'https://api.weixin.qq.com/cgi-bin/message/subscribe/send?access_token=' . $access_token;
//      $data_time = date("Y-m-d H:i:s");
//      $dd['data']  = [
//         'phrase2'   =>['value' =>$username],
//         'phrase3'   =>['value' =>$sex],
//         'thing4'    =>['value' =>$hos_jigou['agentname']],
//         'thing5'    =>['value' =>$k_shi_one['name']],
//         'thing6'    =>['value' =>$z_name],
//       ];   
//      $dd['touser'] = $openid;
//      $dd['template_id'] = $template_id;
//      $dd['page'] = 'hyb_yl/backstageFollowUp/pages/explanation/explanation?zid='.$zid; 
//      $result1 = $this->https_curl_json($url, $dd, 'json');

//      $aliduanxin = pdo_fetch("SELECT * FROM " . tablename("hyb_yl_duanxin") . "WHERE uniacid = '{$uniacid}' ");
//     $mobel = unserialize($aliduanxin['moban_id']);
//     if ($aliduanxin['stadus'] == 1 ) {
//         $time = strtotime($order['year']);
//         $time_back = date("Y-m-d",$time);
//         $month_time = $order['month_time'];
//         $exp_time = explode('-', $month_time);

//         $stat = $exp_time[0];
//         $endt = $exp_time[1];
        
//         $startime_on =$time_back.' '.$stat;
//         $endtime_on =$time_back.' '.$endt;
//         $myinfo = pdo_fetch("SELECT * FROM " . tablename("hyb_yl_userjiaren") . "WHERE uniacid = '{$uniacid}' and  j_id ='{$j_id}'");
//         $name = $myinfo['names'];
//         $phoneNum = $myinfo['tel'];
//         $doname = pdo_fetch("SELECT * FROM " . tablename("hyb_yl_zhuanjia") . "as a left join" . tablename('hyb_yl_ceshi') . "as b on b.id=a.parentid WHERE a.uniacid = '{$uniacid}' and a.zid ='{$zid}'");
//         $doctor = $doname['z_name'];
//         $ksname = $doname['name'];
//         $accessKeyId = $aliduanxin['key'];
//         $accessKeySecret = $aliduanxin['scret'];
//         $params["PhoneNumbers"] = $aliduanxin['tel'];
//         $params["SignName"] = $aliduanxin['qianming'];
//         $params["TemplateCode"] = $mobel['ghmobel'];
//         $params['TemplateParam'] = Array( 'name' => $name, 'tel' => $phoneNum, 'zname' => $doctor,'time' => $startime_on,'time2' => $endtime_on);
//         if (!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
//             $params["TemplateParam"] = json_encode($params["TemplateParam"]);
//         }
//         $helper = new SignatureHelper();
//         $content = $helper->request($accessKeyId, $accessKeySecret, "dysmsapi.aliyuncs.com", array_merge($params, array("RegionId" => "cn-hangzhou", "Action" => "SendSms", "Version" => "2017-05-25",)));
//     }
// }
echo '<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>';
$myfile = fopen("wxtestfile.txt", "a");
fwrite($myfile, "\r\n");
fwrite($myfile, $postXml);
fclose($myfile);

}
//将xml格式转换成数组
function xmlToArray($xml) {
    //禁止引用外部xml实体
    libxml_disable_entity_loader(true);
    $xmlstring = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
    $val = json_decode(json_encode($xmlstring), true);
    return $val;
}

function subtext($text, $length) {
    if (mb_strlen($text, 'utf8') > $length) {
        return mb_substr($text, 0, $length, 'utf8') . '...';
    } else {
        return $text;
    }
}

function https_curl_json($url, $data, $type) {
    if ($type == 'json') {
        $headers = array("Content-type: application/json;charset=UTF-8", "Accept: application/json", "Cache-Control: no-cache", "Pragma: no-cache", "Content-type:application/x-www-form-urlencoded");
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

function send_post($url, $post_data, $method = 'POST') {
    $postdata = http_build_query($post_data);
    $options = array('http' => array('method' => $method, //or GET
    'header' => 'Content-type:application/x-www-form-urlencoded', 'content' => $postdata, 'timeout' => 15 * 60 // 超时时间（单位:s）
    ));
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    return $result;
}
?>