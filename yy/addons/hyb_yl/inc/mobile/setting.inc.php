<?php
global $_W,$_GPC;
$op = $_GPC['op'];
load()->func('tpl');
$uniacid =$_W['uniacid'];
load()->model('user');
load()->model('setting');
load()->model('message');
load()->classs('oauth2/oauth2client');
switch ($op) {
	case 'login':
	    if($_W['ispost']){
			$user['username'] = trim($_GPC['username']);
			$user['password'] = trim($_GPC['password']);
			$user = user_single($user);
			$_W['uid'] = $user['uid'];
			$_W['isfounder'] = user_is_founder($user['uid']);
			$_W['user'] = $user;
			$uid =$user['uid'];
			if(empty($user)) {
				message(error(-1, '账号或密码错误'), '', 'ajax');
			}
            if($user['status'] == 1) {
				message(error(-1, '您的账号正在审核或是已经被系统禁止，请联系网站管理员解决'), '', 'ajax');
			}
			$clerk = pdo_get('users', array('status' => $_W['uniacid'], 'uid' => $user['uid']));
			if(empty($clerk)) {
				message(error(-1, '您没有管理该店铺的权限'), '', 'ajax');
			}
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
			user_update($status);
			if ($user['uid'] != $_GPC['__uid']) {
				isetcookie('__uniacid', '', -7 * 86400);
				isetcookie('__uid', '', -7 * 86400);
			}
			message(error(0, $user['uid']), '', 'ajax');
			
	    }
		include $this->template("login");
		break;

}

