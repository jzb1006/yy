<?php

global $_W,$_GPC;
$op = $_GPC['op'];
$_W['plugin'] = 'drugstore';
if($op == 'index')
{
	include $this->template("drugstore/index");
}
if($op == 'add')
{
	include $this->template("drugstore/add");
}