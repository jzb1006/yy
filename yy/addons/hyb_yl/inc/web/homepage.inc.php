<?php
global $_W,$_GPC;
$op = $_GPC['op'];
 $_W['plugin'] ='homepage';
if($op == "survey")
{
	include $this->template("homepage/index");
}
if($op == 'page')
{
	include $this->template("homepage/notice");
}
