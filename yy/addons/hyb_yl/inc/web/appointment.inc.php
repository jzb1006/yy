<?php
global $_W, $_GPC;
$op = $_GPC['op'];
$type_id = $_GPC['type_id'];
$uniacid = $_W['uniacid'];

if($op == 'guahao')
{
	include $this->template('appointment/gua_list');
}
if($op == 'tijian')
{
	include $this->template("appointment/ti_list");
}


