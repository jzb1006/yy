<?php
require '../../../../framework/bootstrap.inc.php';
require '../../../../addons/hyb_yl/core/common/defines.php';
require '../../../../addons/hyb_yl/core/common/autoload.php';
require '../../../../addons/hyb_yl/core/function/global.func.php';
global $_W,$_GPC;
ignore_user_abort();
set_time_limit(0);
$flag = $_GPC['flag'];
$_W['uniacid'] = $_GPC['uniacid'];
if($flag == 'consumption'){
	Consumption::consumptions();
}
if($flag == 'notice'){
	Consumption::notice();
}
