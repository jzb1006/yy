<?php  
class HYBPage extends WeModuleSite
{ 
	function copysiteUrl($copysite){
		if($this->inMobile){
			$query['do'] = "copysite";
			$query['m'] = strtolower(HYB_MODULE);
			return murl('entry', $query, true)."&act=".$copysite;
		}else{
			 $gets=$_GET;
			 $module0=strlen($gets['m'])>0?$gets['m']:HYB_MODULE;
			 $url0=url('site/entry/copysite',array("m"=>$module0));
			 $url0.="&act=".$copysite."&version_id=".intval($gets['version_id']);
			return $url0;
		}
		
	}
	 
}
function debug_trace($var){
	global $_GPC,$_W;
	$str=$var;
	if(gettype($var)!='string'){
		$str=json_encode($var);
	}
	$uniacid=$_W['uniacid'];
	if(intval($_GPC['debug'])==1){
		 $model=new Model("log");
        $model->add(array(
        	"uniacid"=>$uniacid,
            "date"=>date("Y-m-d H:i:s",time()),
            "log"=>$str
        ));
	}
}
function copysiteUrl($act){ 
	global $_GPC,$_W;
	global $_W;
	
	$module0=strlen($_GPC['m'])>0?$_GPC['m']:GIZ_MODULE;
	$url0=url('site/entry/copysite',array("m"=>$module0));
	$url0.="&version_id=".intval($_GPC['version_id'])."&act=$act"; 

	return  $url0;
}
if (!function_exists('copysite')) {
	function copysite(){
		global $_GPC,$_W; 
		$act=$_GPC['act']; 
		$from=0;
		if(intval($_W['uid'])){ 
			$path=HYB_PATH.'/inc/web/'; 
		}else if($_GPC['from']=="wxapp"||$_GPC['a']=="wxapp"){
			$from="wxapp";
			$path=HYB_PATH.'/inc/wxapp/';
		}else if(strpos($_W['siteurl'],'/app/index.php')!==false){
			$path=HYB_PATH.'/inc/mobile/';
		}
		
		if(strtolower($_GPC['do'])=='copysite'){

			$acts=explode(".", $act); 

			if(count($acts)>2){
				for($i=0;$i<(count($acts)-1);$i++){
					$file.=$acts[$i]."/";
				}
				$file=$path.substr($file,0,strlen($acts[0])-1).".inc.php"; 
				$class=$acts[count($acts)-2]; 
				$func=$acts[count($acts)-1];
			}else if(count($acts)==2){
				$file=$path.$acts[0].".inc.php"; 
				$class=$acts[0];
				$func=$acts[1];
			}     
		}else{
			$acts=explode(".", $act); 

			if(count($acts)>1){
				for($i=0;$i<(count($acts)-1);$i++){
					$file.=$acts[$i]."/";
				}
				$file=$path.$_GPC['do']."/".substr($file,0,strlen($acts[0])-1).".inc.php"; 

			 	$class=$acts[count($acts)-2]; 
				$func=$acts[count($acts)-1];
			}else if(count($acts)==1){
				$file=$path.$_GPC['do'].".inc.php"; 
				$class=$_GPC['do'];
				$func=$acts[0];
			}else{
				$file=$path.$_GPC['do'].".inc.php"; 
				$class=$_GPC['do'];
				if (!is_file($file)) { 
					$file=$path.$_GPC['do']."/".$_GPC['do'].".inc.php"; 
				}  
				$func=$acts[0];
			}  
			 
		} 
		if(empty($func)){
			$func="index";
		}  
		 
		if (!is_file($file)) {  //xxx.php
			exit(' ????????? ' . $class . ' ?????????!'); 
		}else{
			require_once $file;  
			$class_name = ucfirst($class); 
			$controller = new $class_name(); 
			if($from=="wxapp"){
				$controller->__define=HYB_PATH."/wxapp.php";
			}else{ 
				$controller->__define=HYB_PATH."/site.php";
			}
			
			$controller->uniacid=$_W['uniacid'];
			$controller->module=$_W['current_module']; 
			if($_W['os']=="mobile"){
				$controller->inMobile=true;
			}
			if(!method_exists($controller,$func)){
			    die('?????? '.$class_name.'->'.$func.'()?????????');
			} 
			$controller->$func(); 
		}
		
		exit;
	}
} 
 
if (!function_exists('Model')) {//????????????
	function Model($name) {
		$model = new Model($name);
		return $model;
	} 
}
function URL_ENCODE($d){
//?????????????????????urlencode
	$json= EACHARR($d,"urlencode");
	return $json;
}
function URL_DECODE($d){
//?????????????????????urldecode
	$json= EACHARR($d,"urldecode");
	return $json;
}
function JSON_OUT($d,$replace=false){ 
//???????????????json_encode; 

	$json= EACHARR($d,"urlencode",$replace);
	return urldecode(json_encode($json)); 
 
}
function EACHARR($arr,$act=false,$repSts=false){ 
//???????????????????????????????????????
	switch (gettype($arr)) {
		case 'array': 
			foreach ($arr as $key => $val) {
				$arr[$key] = EACHARR($val,$act,$repSts);// 
			}
			break;  
		default: 
			if($repSts){
				$find = array("\r\n", "\n", "\r");  
				$replace = " "; 
				$arr=str_replace($find, $replace, $arr);  
			} 
			switch($act){
				case 'urlencode':
					 $arr=urlencode($arr); 
					break;
				case 'urldecode':
					 $arr=urldecode($arr); 
					break;
				default: 
					break;
			}   
		break;
	}
	return $arr;
}
function __childtree($father,$son){//???????????????
	$father['children']=array();
	foreach ($son as $k => $v) {
		if(intval($v['pid'])==intval($father['id'])){ 
			$sons=__childtree($v,$son);//???????????????????????????????????????
			array_push($father['children'],$sons);
			unset($son[$k]);
		}
	}
	
	return $father;
}
function childtree($son,$alone=false){//  
	$father=array();
	foreach ($son as $key => $val) {
		if(intval($val['pid'])==0){//???????????????
			array_push($father, $val);
			unset($son[$key]); 
		}
	}
	foreach ($father as $key => $val) {
		$father[$key]=__childtree($val,$son);
	}
	if($alone){//???????????????????????????
		foreach ($son as $key => $val) { 
			array_push($father, $val); 
		}
	}
	return $father;
}

function  CURL_get($url){ 		
	$curl = curl_init(); // ????????????CURL??????      
	curl_setopt($curl, CURLOPT_URL, $url); // ??????????????????                  
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT,15);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	// curl_setopt($curl, CURLOPT_COOKIEFILE, $this->cookie_file); // ????????????????????????Cookie??????      
	curl_setopt($curl, CURLOPT_TIMEOUT, 30); // ?????????????????????????????????      
	curl_setopt($curl, CURLOPT_HEADER, 0); // ???????????????Header????????????      
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // ??????????????????????????????????????????      
	$tmpInfo = curl_exec($curl); // ????????????   
	if (curl_errno($curl)) {      
		echo 'Errno'.curl_error($curl);      
	}else{
		 $arr = json_decode($tmpInfo,true);
		return $arr; // ????????????   
	}   
}
function CURL_send($url,$data=array(),$timeout=20){
	//??????curl?????????arr???
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	//curl_setopt($ch, CURLOPT_HTTPHEADER, 'Content-Type:text/html;charset=utf-8');	
	if(!empty($data)){
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	}
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT,20);//????????????
	$rs=curl_exec($ch);
	if(curl_errno($ch)){//???????????????????????????
       $s = "{\"success\": false,\"msg\":\"".curl_error($ch)."\" }";
       return $s;
    }else{
		curl_close($ch);  

		$arr = json_decode($rs,true);    
	 	return $arr;
		 
	}
} 
//????????????
function randChar($length){
	$str="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$tmp="";
	for($i=0;$i<$length;$i++){
		$tmp.=$str[mt_rand(0,51)];
	}  
	return $tmp;
}
//???????????????
function randCharNumber($length){
	$str="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$tmp="";
	for($i=0;$i<$length;$i++){
		$tmp.=$str[mt_rand(0,61)];
	}  
	return $tmp;
} 
function matchweek($time){
	$week="0";
	if(intval($time)>10){
		$week=date("w",$time);
	}else{
		$week=$time;
	}
	switch ($week) {
	 	case '0':
	 		$w="???";
	 		break; 
	 	case '1':
	 		$w="???";
	 		break; 
	 	case '2':
	 		$w="???";
	 		break; 
	 	case '3':
	 		$w="???";
	 		break; 
	 	case '4':
	 		$w="???";
	 		break; 
	 	case '5':
	 		$w="???";
	 		break; 
	 	case '6':
	 		$w="???";
	 		break; 
	 	default:
	 		# code...
	 		break;
	 }
	 return $w;
}
function currentUrl(){
	return 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
}
function Array_Sort($array,$row,$type){//??????????????????
  $array_temp = array();
  foreach($array as $v){
  	if(intval($v[$row])){
  		$array_temp[intval($v[$row])] = $v;	
  	}else{
  		$array_temp[$v[$row]] = $v;	
  	}
    
  }
  if($type == 'asc'){
    ksort($array_temp);
  }elseif($type='desc'){
    krsort($array_temp);
  }else{
  }
  
  return $array_temp;
}