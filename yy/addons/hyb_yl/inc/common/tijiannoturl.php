<?php

header('Content-type: text/xml');
define('IN_SYS', true);
require '../../framework/bootstrap.inc.php';
define('dianc_ROOT', dirname(dirname(__FILE__)));
define('IS_OPERATOR', true);
require dianc_ROOT . '../../web/common/bootstrap.sys.inc.php';
//微信返回的数据
global $_GPC, $_W;
$postXml =file_get_contents("php://input");//接收微信参数
//$postXml = $GLOBALS["HTTP_RAW_POST_DATA"];
$uniacid=cache_load('uniacid');
if (empty($postXml)) {
    return false;
}
$attr = xmlToArray($postXml);
if($postXml){
    $xml = simplexml_load_string($postXml);
    $money = (string)$xml->total_fee;
    $return_code = (string)$xml->return_code;
    $attach = (string)$xml->attach;
    $user_id = (string)$xml->user_id;
    $out_trade_no = (string)$xml->out_trade_no;
    $transaction_id = (string)$xml->transaction_id;
}
if($attr['result_code'] == 'SUCCESS' && $attr['return_code'] == 'SUCCESS'){
    pdo_update('hyb_yl_tijianorder',array('ifpay'=>1,'paytime' => strtotime("now")),array('uniacid'=>$uniacid,'ordernums'=>$out_trade_no));
}
//将xml格式转换成数组
function xmlToArray($xml) {
    //禁止引用外部xml实体 
    libxml_disable_entity_loader(true);
    $xmlstring = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
    $val = json_decode(json_encode($xmlstring), true);
    return $val;
}
$myfile = fopen("wxtestfile.txt", "a");
fwrite($myfile, "\r\n");
fwrite($myfile, $postXml);
fclose($myfile);

?>