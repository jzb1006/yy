<?php
global $_W,$_GPC;
$op = $_GPC['op'];
load()->func('tpl');
$uniacid =$_W['uniacid'];
load()->model('user');
load()->model('setting');
load()->model('message');
load()->classs('oauth2/oauth2client');

define('IN_GW', true);

load()->model('user');
load()->model('message');
load()->classs('oauth2/oauth2client');
load()->model('setting');

if (!empty($_W['uid']) && $_GPC['handle_type'] != 'bind') {
	$data = array(
		'code' => '0',
      	'message' => '请先退出再登录！',
	);
	
}


$setting = $_W['setting'];
$_GPC['login_type'] = !empty($_GPC['login_type']) ? $_GPC['login_type'] : (!empty($_W['setting']['copyright']['mobile_status']) ? 'mobile': 'system');

$login_urls = user_support_urls();


$op = $_GPC['op'];

if($op == 'ispost'){

	// $failed = pdo_get('users_failed_login', array('username' => trim($_GPC['username'])));
	
	// 	if ($record['status'] == USER_STATUS_CHECK || $record['status'] == USER_STATUS_BAN) {
	// 		$data = array(
	// 			'code' => '0',
	// 	      	'message' => '您的账号正在审核或是已经被系统禁止，请联系网站管理员解决?',
	// 		);
	// 	}
	// 	$_W['uid'] = $record['uid'];
	// 	$_W['isfounder'] = user_is_founder($record['uid']);

	// 	$_W['user'] = $record;

	// 	$support_login_bind_types = Oauth2CLient::supportThirdLoginBindType();
	// 	if (in_array($_GPC['login_type'], $support_login_bind_types) && !empty($_W['setting']['copyright']['oauth_bind']) && !$record['is_bind'] && empty($_W['isfounder']) && ($record['register_type'] == USER_REGISTER_TYPE_QQ || $record['register_type'] == USER_REGISTER_TYPE_WECHAT)) {
	// 		$data = array(
	// 			'code' => '0',
	// 	      	'message' => '您的账号正在审核或是已经被系统禁止，请联系网站管理员解决?',
	// 		);
			
	// 	}

	// 	if (!empty($_W['siteclose']) && empty($_W['isfounder'])) {
	// 		$data = array(
	// 			'code' => '0',
	// 	      	'message' => '站点已关闭，关闭原因:'. $_W['setting']['copyright']['reason'],
	// 		);
	// 	}

	// 	$cookie = array();
	// 	$cookie['uid'] = $record['uid'];
	// 	$cookie['lastvisit'] = $record['lastvisit'];
	// 	$cookie['lastip'] = $record['lastip'];
	// 	$cookie['hash'] = !empty($record['hash']) ? $record['hash'] : md5($record['password'] . $record['salt']);
	// 	$session = authcode(json_encode($cookie), 'encode');
	// 	isetcookie('__session', $session, !empty($_GPC['rember']) ? 7 * 86400 : 0, true);
	// 	$status = array();
	// 	$status['uid'] = $record['uid'];
	// 	$status['lastvisit'] = TIMESTAMP;
	// 	$status['lastip'] = CLIENT_IP;
	// 	user_update($status);

	// 	if (empty($forward)) {
	// 		$forward = user_login_forward($_GPC['forward']);
	// 	}
	// 			$forward = safe_gpc_url($forward);

	// 	if ($record['uid'] != $_GPC['__uid']) {
	// 		isetcookie('__uniacid', '', -7 * 86400);
	// 		isetcookie('__uid', '', -7 * 86400);
	// 	}
	// 	if (!empty($failed)) {
	// 		pdo_delete('users_failed_login', array('id' => $failed['id']));
	// 	}

	// 	$user_endtime = $_W['user']['endtime'];
	// 	if (!empty($user_endtime) && !in_array($user_endtime, array(USER_ENDTIME_GROUP_EMPTY_TYPE, USER_ENDTIME_GROUP_UNLIMIT_TYPE)) && $user_endtime < TIMESTAMP) {
	// 		$user_is_expired = true;
	// 	}

	// 	if ((empty($_W['isfounder']) || user_is_vice_founder()) && $user_is_expired) {
	// 		$user_expire = setting_load('user_expire');
	// 		$user_expire = !empty($user_expire['user_expire']) ? $user_expire['user_expire'] : array();
	// 		$notice = !empty($user_expire['notice']) ? $user_expire['notice'] : '您的账号已到期，请前往商城购买续费';
	// 		$redirect = !empty($user_expire['status_store_redirect']) && $user_expire['status_store_redirect'] == 1 ? url('home/welcome/ext', array('m' => 'store')) : '';
	// 		$extend_buttons = array();
	// 		if (!empty($user_expire['status_store_button']) && $user_expire['status_store_button'] == 1) {
	// 			$extend_buttons['status_store_button'] = array(
	// 				'url' => url('home/welcome/ext', array('m' => 'store')),
	// 				'class' => 'btn btn-primary',
	// 				'title' => '去商城续费',
	// 			);
	// 		}
	// 		$extend_buttons['cancel'] = array(
	// 			'url' => url('user/profile'),
	// 			'class' => 'btn btn-info',
	// 			'title' => '取消',
	// 		);
	// 		$data = array(
	// 			'code' => '0',
	// 	      	'message' => $notice,
	// 		);
	// 		// message($notice, $redirect, 'expired', '', $extend_buttons);
	// 	}
	// 	$hoispital = pdo_get("hyb_yl_hospital",array("username"=>$_GPC['username']));
		
	// 	$url = $_W['siteroot']."web/index.php?c=site&a=entry&do=dashboard&op=gk&m=hyb_yl&ac=dashboard&&hid=".$hoispital['hid'];
	// 	var_dump($url);
	// 	exit();
		
	// 	$hoispital = pdo_get("hyb_yl_hospital",array("username"=>$_GPC['username']));
	// 	cache_build_frame_menu();
	// 	$data = array(
	// 		'code' => '1',
	//       	'message' => "欢迎回来，{$record['username']}",
	//       	'hid' => $hoispital['hid'],
	//       	'url' => $url,
	// 	);
		
		// itoast("欢迎回来，{$record['username']}", $forward, 'success');
	
	


$user['username'] = trim($_GPC['username']);
$user['password'] = trim($_GPC['password']);
$password = trim($_GPC['password']);
$username = trim($_GPC['username']);

$user = user_single($user);
$_W['uid'] = $user['uid'];
$record = pdo_get('users',array('username'=>$username));
$_W['isfounder'] = user_is_founder($user['uid']);
$_W['user'] = $user;
$uid =$user['uid'];

$hash = md5($record['password'] . $record['salt']);

$hash2 = $user['hash'];


if(empty($user)) {
	$data = array(
		'code' => '0',
      	'message' => '账号或密码错误,请重新输入',
	);
    echo json_encode($data);
	exit();
	
}
if($user['status'] == 1) {
	$data = array(
		'code' => '0',
      	'message' => '您的账号正在审核或是已经被系统禁止，请联系网站管理员解决',
	);
	echo json_encode($data);
	exit();
}
if($hash == $hash2){
	$cookie = array();
	$cookie['uid'] = $user['uid'];
	$cookie['lastvisit'] = $user['lastvisit'];
	$cookie['lastip'] = $user['lastip'];
	$cookie['hash'] = !empty($user['hash']) ? $user['hash'] : md5($user['password'] . $user['salt']);
	$session = authcode(json_encode($cookie), 'encode');
	isetcookie('__session', $session, !empty($_GPC['rember']) ? 7 * 86400 : 0, true);
	$status = array();
	$status['uid'] = $user['uid'];
	$status['lastvisit'] = TIMESTAMP;
	$status['lastip'] = CLIENT_IP;

	//user_update($status);
	if ($user['uid'] != $_GPC['__uid']) {
		isetcookie('__uniacid', '', -7 * 86400);
		isetcookie('__uid', '', -7 * 86400);
	}

	$hoispital = pdo_get("hyb_yl_hospital",array("username"=>$_GPC['username']));
	$user = pdo_get("users",array("username"=>$_GPC['username']));
	$_W['user'] = $user;
	$_W['uid'] = $user['uid'];
	$_W['is_hospital'] = true;
	$hospital = pdo_get("hyb_yl_hospital",array("uniacid"=>$uniacid,"hid"=>$hoispital['hid']));
	$_W['username'] = $user['username'];
	$lifeTime = 24 * 3600; 
	session_set_cookie_params($lifeTime); 
	session_start();
	$_SESSION["is_hospital"] = '1'; 
	define("is_agent",'1');
	define("hid",$hoispital['hid']);
	define("groupids",$hoispital['groupid']);
    
	$zhuanjia = pdo_fetchall("select zid from ".tablename("hyb_yl_zhuanjia")." where uniacid=".$uniacid." and hid=".$hoispital['hid']);
	$zjs = '';
	foreach($zhuanjia as &$zj)
	{
		$zjs .= $zj['zid'].",";
	}
	$zjs = substr($zjs,0,strlen($zjs)-1);
	define('zid', $zjs);
    $hid = $hoispital['hid'];
    $siteroot =  $_W['siteroot'];
    $url = $_W['siteroot'] . 'web/index.php?c=site&a=entry&do=dashboard&op=gk&m=hyb_yl&ac=dashboard&hid='.$hid.'&owner_uid=' . $user['uid'];
	$data = array(
		'code' => '1',
        'hid'  =>$hid,
        'url'  =>$url,
      	'message' => '登录成功',
	);	
	
	echo json_encode($data);
	exit();
}

}

$cloudset['name'] ="思创医疗";



include $this->template('user/agent_login');



