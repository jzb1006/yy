<?php

ini_set("display_errors", "on");

class PlsDemo
{
    protected $app_key;
    protected $app_secrt;
    protected $areaCode;
    protected $maxDuration;

    function __construct($app_key,$app_secrt,$areaCode,$maxDuration) {
        $this->app_key = $app_key;
        $this->app_secrt = $app_secrt;
        $this->areaCode = $areaCode;
        $this->maxDuration = $maxDuration;
    }
  //绑定
public function getBangdin($doc_ph,$app_key,$app_secrt,$areaCode,$maxDuration){
    // 必填,请参考"开发准备"获取如下数据,替换为实际值
    $realUrl = 'https://rtcpns.cn-north-1.myhuaweicloud.com:443/rest/provision/caas/privatenumber/v1.0'; // APP接入地址+接口访问URI
    $APP_KEY = $this->app_key; // APP_Key
    $APP_SECRET = $this->app_secrt; // APP_Secret
    // $origNum = '+86'.$doc_ph;  // A号码
    $origNum='+86'.$doc_ph;
    $maxDuration=$this->maxDuration;

    // $privateNum = '+8617010000001'; // X号码(隐私号码)
    /*
     * 选填,各参数要求请参考"AX模式绑定接口"
     */
    $privateNumType = 'mobile-virtual'; //固定为mobile-virtual
    $areaCode = $this->areaCode; //需要绑定的X号码对应的城市码
    // $recordFlag = 'false'; //是否需要针对该绑定关系产生的所有通话录音
    // $recordHintTone = 'recordHintTone.wav'; //设置录音提示音
    $calleeNumDisplay = '0'; // 设置非A用户呼叫X时,A接到呼叫时的主显号码
    // $privateSms = 'true'; //设置该绑定关系是否支持短信功能

    // $callerHintTone = 'callerHintTone.wav'; //设置A拨打X号码时的通话前等待音
    // $calleeHintTone = 'calleeHintTone.wav'; //设置非A用户拨打X号码时的通话前等待音
    // $preVoice = [
    //     'callerHintTone' => $callerHintTone,
    //     'calleeHintTone' => $calleeHintTone
    // ];

    // 请求Headers
    $headers = [
        'Accept: application/json',
        'Content-Type: application/json;charset=UTF-8',
        'Authorization: WSSE realm="SDP",profile="UsernameToken",type="Appkey"',
        'X-WSSE: ' . $this->buildWsseHeader($APP_KEY, $APP_SECRET)
    ];
    // 请求Body,可按需删除选填参数
    $data = json_encode([
        'origNum' => $origNum,
        'maxDuration'=>$maxDuration,
        // 'privateNum' => $privateNum,
        'privateNumType' => $privateNumType,
        'areaCode' => $areaCode,
        // 'recordFlag' => $recordFlag,
        // 'recordHintTone' => $recordHintTone,
        'calleeNumDisplay' => $calleeNumDisplay,
        // 'privateSms' => $privateSms,
        // 'preVoice' => $preVoice
    ]);

    $context_options = [
        'http' => [
            'method' => 'POST', // 请求方法为POST
            'header' => $headers,
            'content' => $data,
            'ignore_errors' => true // 获取错误码,方便调测
        ],
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false
        ] // 为防止因HTTPS证书认证失败造成API调用失败,需要先忽略证书信任问题
    ];

    try {
        $file=fopen('bind_data.txt', 'a'); //打开文件
        fwrite($file, '绑定请求数据：' . $data . PHP_EOL); //绑定请求参数记录到本地文件,方便定位问题
        $response = file_get_contents($realUrl, false, stream_context_create($context_options)); // 发送请求
        $info = json_decode(trim($response,chr(239).chr(187).chr(191)),true);
        echo json_encode($info);
        fwrite($file, '绑定结果：' . $response . PHP_EOL); //绑定ID很重要,请记录到本地文件,方便后续修改绑定关系及解绑
    } catch (Exception $e) {
        echo $e->getMessage();
    } finally {
        fclose($file); //关闭文件
    }
  }
  //呼叫
public function getAcsClient($user_phone, $doc_phone,$privateNum) {
    // 必填,请参考"开发准备"获取如下数据,替换为实际值
    $realUrl = 'https://rtcpns.cn-north-1.myhuaweicloud.com:443/rest/caas/privatenumber/calleenumber/v1.0'; // APP接入地址+接口访问URI
    $APP_KEY = $this->app_key; // APP_Key
    $APP_SECRET = $this->app_secrt; // APP_Secret

    /*
     * 选填,各参数要求请参考"AX模式设置临时被叫接口"
     * subscriptionId和(origNum+privateNum)为二选一关系,都携带时以subscriptionId为准
     */
 
    $origNum = '+86'.$doc_phone; // A号码
    // $privateNum = '+8617100750434'; // X号码(隐私号码)
    $calleeNum = '+86'.$user_phone; // 必填,本次呼叫的真实被叫号码
    $privateNum = $privateNum; // X号码
    // $subscriptionId = '0167ecc9-bfb6-4eec-b671-a7dab2ba78cf'; // 指定"AX模式绑定接口"返回的绑定ID设置临时被叫
    // 请求Headers
    $headers = [
        'Accept: application/json',
        'Content-Type: application/json;charset=UTF-8',
        'Authorization: WSSE realm="SDP",profile="UsernameToken",type="Appkey"',
        'X-WSSE: ' . $this->buildWsseHeader($APP_KEY, $APP_SECRET)
    ];
    // 请求Body,可按需删除选填参数
    $data = json_encode([
        'origNum' => $origNum,
        'privateNum' => $privateNum,
        // 'subscriptionId' => $subscriptionId,
        'calleeNum' => $calleeNum
    ]);

    $context_options = [
        'http' => [
            'method' => 'PUT', // 请求方法为PUT
            'header' => $headers,
            'content' => $data,
            'ignore_errors' => true // 获取错误码,方便调测
        ],
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false
        ] // 为防止因HTTPS证书认证失败造成API调用失败,需要先忽略证书信任问题
    ];

    try {
        $response = file_get_contents($realUrl, false, stream_context_create($context_options)); // 发送请求
        $info = json_decode(trim($response,chr(239).chr(187).chr(191)),true);
        echo json_encode($info);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
        }


//解绑
     public function getHuaweidel($user_phone,$privateNum){
    // 必填,请参考"开发准备"获取如下数据,替换为实际值
    $realUrl = 'https://rtcpns.cn-north-1.myhuaweicloud.com:443/rest/provision/caas/privatenumber/v1.0'; // APP接入地址+接口访问URI
    $APP_KEY = $this->app_key; // APP_Key
    $APP_SECRET = $this->app_secrt; // APP_Secret
    /*
     * 选填,各参数要求请参考"AX模式解绑接口"
     * subscriptionId和(origNum+privateNum)为二选一关系,都携带时以subscriptionId为准
     */
    $origNum = '+86'.$user_phone; // A号码
    $privateNum = $privateNum; // X号码
    // $subscriptionId = '0167ecc9-bfb6-4eec-b671-a7dab2ba78cf'; // 指定"AX模式绑定接口"返回的绑定ID进行解绑

    // 请求Headers
    $headers = [
        'Accept: application/json',
        'Content-Type: application/json;charset=UTF-8',
        'Authorization: WSSE realm="SDP",profile="UsernameToken",type="Appkey"',
        'X-WSSE: ' . $this->buildWsseHeader($APP_KEY, $APP_SECRET)
    ];
    // 请求URL参数
    $data = http_build_query([
        'origNum' => $origNum,
        'privateNum' => $privateNum
        // 'subscriptionId' => $subscriptionId
    ]);
    // 完整请求地址
    $fullUrl = $realUrl . '?' . $data;
    $context_options = [
            'http' => [
                'method' => 'DELETE', // 请求方法为DELETE
                'header' => $headers,
                'ignore_errors' => true // 获取错误码,方便调测
            ],
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false
            ] // 为防止因HTTPS证书认证失败造成API调用失败,需要先忽略证书信任问题
        ];
        try {
       
            $response = file_get_contents($fullUrl, false, stream_context_create($context_options)); // 发送请求
            $info = json_decode(trim($response,chr(239).chr(187).chr(191)),true);
            echo json_encode($info);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
     }
     //话单通知

       public function onFeeEvent($jsonBody) {
            $jsonArr = json_decode($jsonBody, true); //将通知消息解析为关联数组
            $eventType = $jsonArr['eventType']; //通知事件类型

            if (strcasecmp($eventType, 'fee') != 0) {
                // print_r('EventType error: ' . $eventType);
                echo json_encode($eventType);
                return;
            }

            if (!array_key_exists('feeLst', $jsonArr)) {
                // print_r('param error: no feeLst.');
                echo "no feeLst";
                return;
            }
            $feeLst = $jsonArr['feeLst']; //呼叫话单事件信息
            echo json_encode($eventType);
            //print_r('eventType: ' . $eventType . PHP_EOL); //打印通知事件类型
  
            //短时间内有多个通话结束时隐私保护通话平台会将话单合并推送,每条消息最多携带50个话单
            if (sizeof($feeLst) > 1) {
                foreach ($feeLst as $loop){
                    if (array_key_exists('sessionId', $loop)) {
                       // print_r('sessionId: ' . $loop['sessionId'] . PHP_EOL);
                       echo json_encode($loop['sessionId']);
                    }
                }
            } else if(sizeof($feeLst) == 1) {
                if (array_key_exists('sessionId', $feeLst[0])) {
                   // print_r('sessionId: ' . $feeLst[0]['sessionId'] . PHP_EOL);
                   echo json_encode($feeLst[0]['sessionId']);
                }
            } else {
                //print_r('feeLst error: no element.');
                echo "no element";
            }

        }
     public function buildWsseHeader($appKey, $appSecret) {
            date_default_timezone_set("UTC");
            $Created = date('Y-m-d\TH:i:s\Z'); //Created
            $nonce = uniqid(); //Nonce
            $base64 = base64_encode(hash('sha256', ($nonce . $Created . $appSecret), TRUE)); //PasswordDigest
            return sprintf("UsernameToken Username=\"%s\",PasswordDigest=\"%s\",Nonce=\"%s\",Created=\"%s\"", $appKey, $base64, $nonce, $Created);
        }
   

}