<?php 

header("Content-type: text/html; charset=utf-8");
define('IN_SYS', true);
require '../../framework/bootstrap.inc.php';
define('dianc_ROOT', dirname(dirname(__FILE__)));
define('IS_OPERATOR', true);
require dianc_ROOT . '../../web/common/bootstrap.sys.inc.php';
//微信返回的数据
global $_GPC, $_W;
$siteroot = cache_load('siteroot');
$uniacid = cache_load('uniacid');

$basesite = pdo_get('hyb_yl_parameter',array('uniacid'=>$uniacid));
$appid=$basesite['pub_appid']; //填写你公众号的appid

$appid  = $basesite['pub_appid'];  //填写你公众号的appid
$secret = $basesite['appkey'];  //填写你公众号的secret
$code = $_GET["code"];
//第一步:取得openid
$oauth2Url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=$code&grant_type=authorization_code";
$oauth2 = getJson($oauth2Url);

//第二步:根据全局access_token和openid查询用户信息 
$access_token = $oauth2["access_token"]; 
setcookie('access_token',$access_token,7200);

$openid = $oauth2['openid']; 
$unionid =$oauth2['unionid']; 
$get_user_info_url = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN";
$userinfo = getJson($get_user_info_url);

//跳转小程序
$wxappurl = $siteroot."app/index.php?i=2&t=0&v=1.0.0&from=wxapp&c=entry&a=wxapp&do=copysite&m=hyb_yl&act=user.navigate&code=".$code;
header("Location:".$wxappurl);

//将用户的openid保存到数据库触发模板消息
pdo_update('hyb_yl_userinfo',array('wxopenid'=>$openid),array('unionId'=>$unionid));
function getJson($url){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
return json_decode($output, true);
}

      
            
        
