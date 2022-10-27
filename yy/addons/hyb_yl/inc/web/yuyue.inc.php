<?php

global $_W,$_GPC;
$op = $_GPC['op'];

if($op == 'display')
{
	include $this->template("yuyue/index");
}else if($op == 'baogao')
{

	include $this->template("yuyue/baogao");
}else if($op == 'list')
{

	include $this->template("yuyue/list");
}else if($op == 'add')
{

	include $this->template("yuyue/yuyue");
}else if($op == 'shoufei')
{

	include $this->template("shoufei/shoufei");
}
else if($op == 'suifan')
{

	include $this->template("shoufei/suifan");
}
