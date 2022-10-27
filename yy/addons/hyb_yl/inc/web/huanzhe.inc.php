<?php

global $_W,$_GPC;
$op = $_GPC['op'];

if($op == 'display')
{
	include $this->template("huanzhe/index");
}
if($op == 'add')
{
	include $this->template("huanzhe/add");
}