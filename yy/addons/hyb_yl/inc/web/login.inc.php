<?php
global $_W,$_GPC;
// if(checksubmit() || $_W['isajax']) {
//     if($_GPC['aid']){
//         staffLogin($_GPC);//代理商员工登录
//     }else{
//         isetcookie('__wlagent_staff_session', '', -10000);//删除员工登录信息
//         _login($_GPC['referer']);//代理商登陆
//     }
// }
$cloudset['name'] ="思创医疗";

function staffLogin($info){
    global $_W;
    #1、接收参数信息
    $aid = $info['aid'];
    $account = $info['username'];
    $password = $info['password'];
    #2、判断信息是否完整
    if(!$account){
        wl_message('登录失败！请填写账号信息。');
    }else if (!$password){
        wl_message('登录失败！请填写账号密码。');
    }
    #3、判断代理商是否存在
    $agent = pdo_get(PDO_NAME."agentusers",array('id'=>$aid));
    if(!$agent){
        wl_message('登录失败！代理商信息不存在。');
    }else if ($agent['status'] != 1){
        wl_message('登录失败！该代理商正在审核或是已经被禁用，请联系网站管理员解决。');
    }else if(!empty($agent['endtime']) && $agent['endtime'] < TIMESTAMP){
        wl_message('登录失败！该代理商运营有效期已过，请联系网站管理员解决。');
    }
    #4、判断是否存在该账号
    $existence = pdo_get(PDO_NAME."agentadmin",array('account'=>$account));
    if(!$existence){
        wl_message('登录失败！账号不存在。');
    }
    #5、判断账号密码是否正确
    $userInfo = pdo_get(PDO_NAME."agentadmin",array('account'=>$account,'password'=>md5($password)));
    if(!$userInfo){
        wl_message('登录失败！密码错误。');
    }
    #6、登录成功后的操作 - 模拟代理商登录成功
    $cookie['id'] = $agent['id'];
    $cookie['uniacid'] = $agent['uniacid'];
    $cookie['hash'] = md5($agent['password'] . $agent['salt']);
    $session = base64_encode(json_encode($cookie));
    isetcookie('__wlagent_session', $session, 7 * 86400, true);
    #7、登录成功后的操作 - 员工登录成功，储存员工登录信息
    $userCookie['aid'] = $aid;
    $userCookie['uniacid'] = $_W['uniacid'];
    $userCookie['account'] = $account;
    $userCookie['password'] = md5($password);
    $userSession = base64_encode(json_encode($userCookie));
    isetcookie('__wlagent_staff_session', $userSession, 7 * 86400, true);
    #8、获取该管理员的昵称信息
    $mid = $userInfo['mid'];
    $nickname = pdo_getcolumn(PDO_NAME."member",array('id'=>$mid),'nickname');
    wl_message("欢迎回来，{$nickname}。", web_url('dashboard/dashboard'));
}
include $this->template('default/user/agent_login');



