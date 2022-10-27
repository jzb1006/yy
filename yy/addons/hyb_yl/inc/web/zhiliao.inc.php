<?php

global $_W,$_GPC;
$op = $_GPC['op'];

if($op == 'display')
{
	include $this->template("zhiliao/index");
}else if($op == 'baogao')
{
	include $this->template("zhiliao/baogao");
}
