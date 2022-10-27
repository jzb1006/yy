<?php
//升级数据表
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '地址id',
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `pid` int(11) unsigned NOT NULL COMMENT '上级城市id',
  `name` varchar(500) NOT NULL COMMENT '城市名称',
  `visible` tinyint(4) unsigned NOT NULL,
  `displayorder` tinyint(11) unsigned NOT NULL,
  `level` tinyint(3) unsigned NOT NULL COMMENT '等级',
  `is_host` tinyint(2) NOT NULL,
  `status` tinyint(2) NOT NULL COMMENT '是否开启',
  `sort` tinyint(11) NOT NULL COMMENT '排序',
  `created` int(11) NOT NULL COMMENT '添加时间',
  `agent` varchar(50) NOT NULL COMMENT '代理',
  `parentid` int(11) NOT NULL COMMENT '地区一级id',
  PRIMARY KEY (`id`),
  KEY `isShow` (`visible`),
  KEY `parentId` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=16889 DEFAULT CHARSET=utf8 COMMENT='地址表   ';

");

if(!pdo_fieldexists('hyb_yl_address','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_address')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '地址id'");}
if(!pdo_fieldexists('hyb_yl_address','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_address')." ADD   `uniacid` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('hyb_yl_address','pid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_address')." ADD   `pid` int(11) unsigned NOT NULL COMMENT '上级城市id'");}
if(!pdo_fieldexists('hyb_yl_address','name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_address')." ADD   `name` varchar(500) NOT NULL COMMENT '城市名称'");}
if(!pdo_fieldexists('hyb_yl_address','visible')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_address')." ADD   `visible` tinyint(4) unsigned NOT NULL");}
if(!pdo_fieldexists('hyb_yl_address','displayorder')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_address')." ADD   `displayorder` tinyint(11) unsigned NOT NULL");}
if(!pdo_fieldexists('hyb_yl_address','level')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_address')." ADD   `level` tinyint(3) unsigned NOT NULL COMMENT '等级'");}
if(!pdo_fieldexists('hyb_yl_address','is_host')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_address')." ADD   `is_host` tinyint(2) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_address','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_address')." ADD   `status` tinyint(2) NOT NULL COMMENT '是否开启'");}
if(!pdo_fieldexists('hyb_yl_address','sort')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_address')." ADD   `sort` tinyint(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('hyb_yl_address','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_address')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_address','agent')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_address')." ADD   `agent` varchar(50) NOT NULL COMMENT '代理'");}
if(!pdo_fieldexists('hyb_yl_address','parentid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_address')." ADD   `parentid` int(11) NOT NULL COMMENT '地区一级id'");}
if(!pdo_fieldexists('hyb_yl_address','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_address')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('hyb_yl_address','isShow')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_address')." ADD   KEY `isShow` (`visible`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_adv` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '广告表',
  `uniacid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL COMMENT '标题',
  `sort` int(11) NOT NULL COMMENT '排序',
  `thumb` varchar(255) NOT NULL COMMENT '图片',
  `link` varchar(255) NOT NULL COMMENT '链接地址',
  `status` tinyint(2) NOT NULL COMMENT '状态（0：隐藏；1：显示）',
  `position` tinyint(2) NOT NULL DEFAULT '0' COMMENT '所在位置（0：首页位置1；1：首页位置2；2：首页位置3；3：体检；4：看一看；5：积分；6：专家首页位置1；7专家首页位置2；8：专家首页位置3；9：推客首页；10：患教首页）',
  `created` int(11) NOT NULL COMMENT '添加时间',
  `appid` varchar(255) DEFAULT NULL COMMENT '小程序appid',
  `url` varchar(255) DEFAULT NULL COMMENT '连接地址',
  `data` varchar(255) DEFAULT NULL COMMENT '页面数据',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COMMENT='幻灯片表';

");

if(!pdo_fieldexists('hyb_yl_adv','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_adv')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '广告表'");}
if(!pdo_fieldexists('hyb_yl_adv','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_adv')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_adv','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_adv')." ADD   `title` varchar(255) NOT NULL COMMENT '标题'");}
if(!pdo_fieldexists('hyb_yl_adv','sort')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_adv')." ADD   `sort` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('hyb_yl_adv','thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_adv')." ADD   `thumb` varchar(255) NOT NULL COMMENT '图片'");}
if(!pdo_fieldexists('hyb_yl_adv','link')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_adv')." ADD   `link` varchar(255) NOT NULL COMMENT '链接地址'");}
if(!pdo_fieldexists('hyb_yl_adv','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_adv')." ADD   `status` tinyint(2) NOT NULL COMMENT '状态（0：隐藏；1：显示）'");}
if(!pdo_fieldexists('hyb_yl_adv','position')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_adv')." ADD   `position` tinyint(2) NOT NULL DEFAULT '0' COMMENT '所在位置（0：首页位置1；1：首页位置2；2：首页位置3；3：体检；4：看一看；5：积分；6：专家首页位置1；7专家首页位置2；8：专家首页位置3；9：推客首页；10：患教首页）'");}
if(!pdo_fieldexists('hyb_yl_adv','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_adv')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_adv','appid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_adv')." ADD   `appid` varchar(255) DEFAULT NULL COMMENT '小程序appid'");}
if(!pdo_fieldexists('hyb_yl_adv','url')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_adv')." ADD   `url` varchar(255) DEFAULT NULL COMMENT '连接地址'");}
if(!pdo_fieldexists('hyb_yl_adv','data')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_adv')." ADD   `data` varchar(255) DEFAULT NULL COMMENT '页面数据'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_all_server_menulist` (
  `ids` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `server_key` varchar(255) NOT NULL COMMENT '关键字',
  `titles` varchar(255) NOT NULL COMMENT '服务标题',
  `ser_url` varchar(255) NOT NULL COMMENT '服务URL',
  PRIMARY KEY (`ids`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8 COMMENT='服务表';

");

if(!pdo_fieldexists('hyb_yl_all_server_menulist','ids')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_all_server_menulist')." ADD 
  `ids` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_all_server_menulist','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_all_server_menulist')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_all_server_menulist','server_key')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_all_server_menulist')." ADD   `server_key` varchar(255) NOT NULL COMMENT '关键字'");}
if(!pdo_fieldexists('hyb_yl_all_server_menulist','titles')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_all_server_menulist')." ADD   `titles` varchar(255) NOT NULL COMMENT '服务标题'");}
if(!pdo_fieldexists('hyb_yl_all_server_menulist','ser_url')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_all_server_menulist')." ADD   `ser_url` varchar(255) NOT NULL COMMENT '服务URL'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_answer` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '问题id',
  `uniacid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `openid` varchar(255) NOT NULL COMMENT '用户openid',
  `u_name` varchar(255) NOT NULL COMMENT '用户名称',
  `zid` int(11) NOT NULL COMMENT '专家id',
  `z_name` varchar(255) NOT NULL COMMENT '专家名称',
  `keshi_one` int(11) NOT NULL COMMENT '一级科室',
  `keshi_two` int(11) NOT NULL COMMENT '二级科室',
  `label` text NOT NULL COMMENT '标签',
  `keyword` varchar(255) NOT NULL COMMENT '关键词',
  `type` varchar(255) NOT NULL COMMENT '问诊类型',
  `created` int(11) NOT NULL COMMENT '添加时间（问诊时间）',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '公开状态（0：公开；1：不公开）',
  `is_hot` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否热门（0：否；1：是）',
  `orders` varchar(255) NOT NULL,
  `state` tinyint(2) NOT NULL DEFAULT '2' COMMENT '1真实2假数据',
  `erweima` varchar(255) NOT NULL,
  `haibao` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `用户标识` (`openid`),
  CONSTRAINT `用户标识` FOREIGN KEY (`openid`) REFERENCES `ims_hyb_yl_userinfo` (`openid`)
) ENGINE=InnoDB AUTO_INCREMENT=458 DEFAULT CHARSET=utf8 COMMENT='问题表';

");

if(!pdo_fieldexists('hyb_yl_answer','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_answer')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '问题id'");}
if(!pdo_fieldexists('hyb_yl_answer','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_answer')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_answer','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_answer')." ADD   `title` varchar(255) NOT NULL COMMENT '标题'");}
if(!pdo_fieldexists('hyb_yl_answer','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_answer')." ADD   `content` text NOT NULL COMMENT '内容'");}
if(!pdo_fieldexists('hyb_yl_answer','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_answer')." ADD   `openid` varchar(255) NOT NULL COMMENT '用户openid'");}
if(!pdo_fieldexists('hyb_yl_answer','u_name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_answer')." ADD   `u_name` varchar(255) NOT NULL COMMENT '用户名称'");}
if(!pdo_fieldexists('hyb_yl_answer','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_answer')." ADD   `zid` int(11) NOT NULL COMMENT '专家id'");}
if(!pdo_fieldexists('hyb_yl_answer','z_name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_answer')." ADD   `z_name` varchar(255) NOT NULL COMMENT '专家名称'");}
if(!pdo_fieldexists('hyb_yl_answer','keshi_one')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_answer')." ADD   `keshi_one` int(11) NOT NULL COMMENT '一级科室'");}
if(!pdo_fieldexists('hyb_yl_answer','keshi_two')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_answer')." ADD   `keshi_two` int(11) NOT NULL COMMENT '二级科室'");}
if(!pdo_fieldexists('hyb_yl_answer','label')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_answer')." ADD   `label` text NOT NULL COMMENT '标签'");}
if(!pdo_fieldexists('hyb_yl_answer','keyword')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_answer')." ADD   `keyword` varchar(255) NOT NULL COMMENT '关键词'");}
if(!pdo_fieldexists('hyb_yl_answer','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_answer')." ADD   `type` varchar(255) NOT NULL COMMENT '问诊类型'");}
if(!pdo_fieldexists('hyb_yl_answer','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_answer')." ADD   `created` int(11) NOT NULL COMMENT '添加时间（问诊时间）'");}
if(!pdo_fieldexists('hyb_yl_answer','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_answer')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '公开状态（0：公开；1：不公开）'");}
if(!pdo_fieldexists('hyb_yl_answer','is_hot')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_answer')." ADD   `is_hot` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否热门（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_answer','orders')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_answer')." ADD   `orders` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_answer','state')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_answer')." ADD   `state` tinyint(2) NOT NULL DEFAULT '2' COMMENT '1真实2假数据'");}
if(!pdo_fieldexists('hyb_yl_answer','erweima')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_answer')." ADD   `erweima` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_answer','haibao')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_answer')." ADD   `haibao` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_answer','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_answer')." ADD   PRIMARY KEY (`id`)");}
if(!pdo_fieldexists('hyb_yl_answer','用户标识')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_answer')." ADD   KEY `用户标识` (`openid`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_attention` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户关注表',
  `goods_id` int(11) NOT NULL COMMENT '关注id',
  `openid` varchar(255) NOT NULL COMMENT 'y用户标识',
  `cerated_time` datetime NOT NULL COMMENT '添加时间',
  `cerated_type` int(10) NOT NULL COMMENT '关注的类型  0:专家；1:视频;2:患者点赞；3:咨询点赞;4:患者评论点赞;5:咨询评论点赞；6：团队7:签约',
  `fenzuid` int(11) NOT NULL DEFAULT '0' COMMENT '分组ID',
  `beizhu` char(50) NOT NULL COMMENT '备注',
  `uniacid` int(11) NOT NULL,
  `ifqianyue` int(11) NOT NULL DEFAULT '1' COMMENT '1签约中；2已同意；3已解约；4已取消;5拒绝',
  `jieyutext` varchar(255) NOT NULL COMMENT '解约原因',
  `change` int(11) NOT NULL DEFAULT '0' COMMENT '是否开启档案',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=322 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_attention','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_attention')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户关注表'");}
if(!pdo_fieldexists('hyb_yl_attention','goods_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_attention')." ADD   `goods_id` int(11) NOT NULL COMMENT '关注id'");}
if(!pdo_fieldexists('hyb_yl_attention','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_attention')." ADD   `openid` varchar(255) NOT NULL COMMENT 'y用户标识'");}
if(!pdo_fieldexists('hyb_yl_attention','cerated_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_attention')." ADD   `cerated_time` datetime NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_attention','cerated_type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_attention')." ADD   `cerated_type` int(10) NOT NULL COMMENT '关注的类型  0:专家；1:视频;2:患者点赞；3:咨询点赞;4:患者评论点赞;5:咨询评论点赞；6：团队7:签约'");}
if(!pdo_fieldexists('hyb_yl_attention','fenzuid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_attention')." ADD   `fenzuid` int(11) NOT NULL DEFAULT '0' COMMENT '分组ID'");}
if(!pdo_fieldexists('hyb_yl_attention','beizhu')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_attention')." ADD   `beizhu` char(50) NOT NULL COMMENT '备注'");}
if(!pdo_fieldexists('hyb_yl_attention','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_attention')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_attention','ifqianyue')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_attention')." ADD   `ifqianyue` int(11) NOT NULL DEFAULT '1' COMMENT '1签约中；2已同意；3已解约；4已取消;5拒绝'");}
if(!pdo_fieldexists('hyb_yl_attention','jieyutext')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_attention')." ADD   `jieyutext` varchar(255) NOT NULL COMMENT '解约原因'");}
if(!pdo_fieldexists('hyb_yl_attention','change')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_attention')." ADD   `change` int(11) NOT NULL DEFAULT '0' COMMENT '是否开启档案'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_backorders` (
  `ordersn` varchar(255) NOT NULL DEFAULT '' COMMENT '订单号',
  `status` varchar(255) NOT NULL DEFAULT '' COMMENT '状态',
  `createtime` varchar(255) NOT NULL DEFAULT '' COMMENT 't添加时间',
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('hyb_yl_backorders','ordersn')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_backorders')." ADD 
  `ordersn` varchar(255) NOT NULL DEFAULT '' COMMENT '订单号'");}
if(!pdo_fieldexists('hyb_yl_backorders','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_backorders')." ADD   `status` varchar(255) NOT NULL DEFAULT '' COMMENT '状态'");}
if(!pdo_fieldexists('hyb_yl_backorders','createtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_backorders')." ADD   `createtime` varchar(255) NOT NULL DEFAULT '' COMMENT 't添加时间'");}
if(!pdo_fieldexists('hyb_yl_backorders','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_backorders')." ADD   `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_baogao_setting` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '体检报告设置',
  `uniacid` int(10) DEFAULT NULL,
  `is_shenhe` int(10) NOT NULL DEFAULT '0' COMMENT '是否免审核（0：否；1：是）',
  `is_status` int(10) NOT NULL DEFAULT '0' COMMENT '是否启用（0：否；1：是）',
  `newfeed` varchar(255) DEFAULT NULL COMMENT '最新动态',
  `hotfeed` varchar(255) DEFAULT NULL COMMENT '热门动态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='报告设置表';

");

if(!pdo_fieldexists('hyb_yl_baogao_setting','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_baogao_setting')." ADD 
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '体检报告设置'");}
if(!pdo_fieldexists('hyb_yl_baogao_setting','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_baogao_setting')." ADD   `uniacid` int(10) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_baogao_setting','is_shenhe')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_baogao_setting')." ADD   `is_shenhe` int(10) NOT NULL DEFAULT '0' COMMENT '是否免审核（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_baogao_setting','is_status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_baogao_setting')." ADD   `is_status` int(10) NOT NULL DEFAULT '0' COMMENT '是否启用（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_baogao_setting','newfeed')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_baogao_setting')." ADD   `newfeed` varchar(255) DEFAULT NULL COMMENT '最新动态'");}
if(!pdo_fieldexists('hyb_yl_baogao_setting','hotfeed')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_baogao_setting')." ADD   `hotfeed` varchar(255) DEFAULT NULL COMMENT '热门动态'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_baogaopinglunsite` (
  `pl_id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `useropenid` varchar(255) NOT NULL DEFAULT '0' COMMENT '作者',
  `sid` int(11) NOT NULL,
  `pl_text` text NOT NULL COMMENT '评论文字',
  `pl_time` int(11) NOT NULL COMMENT '评论时间',
  `dengj` tinyint(11) NOT NULL COMMENT '等级',
  `parentid` int(11) NOT NULL COMMENT '上级id',
  `usertoux` varchar(255) NOT NULL COMMENT '用户头像',
  `name` char(50) NOT NULL COMMENT '专家姓名',
  `author` int(11) NOT NULL,
  `replyType` char(50) NOT NULL,
  `types` int(11) NOT NULL COMMENT '0用户端1医生端',
  `a_id` int(11) NOT NULL,
  `adminopenid` varchar(255) DEFAULT NULL,
  `user_identity` int(10) NOT NULL DEFAULT '0' COMMENT '评论者身份 0用户 1专家 2后台',
  PRIMARY KEY (`pl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_baogaopinglunsite','pl_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_baogaopinglunsite')." ADD 
  `pl_id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_baogaopinglunsite','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_baogaopinglunsite')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_baogaopinglunsite','useropenid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_baogaopinglunsite')." ADD   `useropenid` varchar(255) NOT NULL DEFAULT '0' COMMENT '作者'");}
if(!pdo_fieldexists('hyb_yl_baogaopinglunsite','sid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_baogaopinglunsite')." ADD   `sid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_baogaopinglunsite','pl_text')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_baogaopinglunsite')." ADD   `pl_text` text NOT NULL COMMENT '评论文字'");}
if(!pdo_fieldexists('hyb_yl_baogaopinglunsite','pl_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_baogaopinglunsite')." ADD   `pl_time` int(11) NOT NULL COMMENT '评论时间'");}
if(!pdo_fieldexists('hyb_yl_baogaopinglunsite','dengj')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_baogaopinglunsite')." ADD   `dengj` tinyint(11) NOT NULL COMMENT '等级'");}
if(!pdo_fieldexists('hyb_yl_baogaopinglunsite','parentid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_baogaopinglunsite')." ADD   `parentid` int(11) NOT NULL COMMENT '上级id'");}
if(!pdo_fieldexists('hyb_yl_baogaopinglunsite','usertoux')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_baogaopinglunsite')." ADD   `usertoux` varchar(255) NOT NULL COMMENT '用户头像'");}
if(!pdo_fieldexists('hyb_yl_baogaopinglunsite','name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_baogaopinglunsite')." ADD   `name` char(50) NOT NULL COMMENT '专家姓名'");}
if(!pdo_fieldexists('hyb_yl_baogaopinglunsite','author')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_baogaopinglunsite')." ADD   `author` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_baogaopinglunsite','replyType')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_baogaopinglunsite')." ADD   `replyType` char(50) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_baogaopinglunsite','types')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_baogaopinglunsite')." ADD   `types` int(11) NOT NULL COMMENT '0用户端1医生端'");}
if(!pdo_fieldexists('hyb_yl_baogaopinglunsite','a_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_baogaopinglunsite')." ADD   `a_id` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_baogaopinglunsite','adminopenid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_baogaopinglunsite')." ADD   `adminopenid` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_baogaopinglunsite','user_identity')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_baogaopinglunsite')." ADD   `user_identity` int(10) NOT NULL DEFAULT '0' COMMENT '评论者身份 0用户 1专家 2后台'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_base` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '基础设置表',
  `uniacid` int(11) NOT NULL,
  `show_title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `show_thumb` text NOT NULL COMMENT '首页轮播图',
  `baidukey` varchar(255) NOT NULL COMMENT '百度地图key',
  `advertisement` text NOT NULL COMMENT '广告幻灯片',
  `back_zjthumb` text NOT NULL COMMENT '专家端幻灯片',
  `tj_thumb` varchar(255) NOT NULL COMMENT '体检中心幻灯片',
  `ztcolor` varchar(50) NOT NULL COMMENT '小程序全局背景色',
  `pstatus` int(11) NOT NULL COMMENT '骗审开关',
  `slide` text NOT NULL COMMENT '骗审轮播图',
  `yy_thumb` varchar(255) NOT NULL COMMENT '医院背景图',
  `yy_title` varchar(50) NOT NULL COMMENT '医院名称',
  `lntroduction` text NOT NULL COMMENT '医院介绍',
  `yy_address` varchar(255) NOT NULL COMMENT '医院地址',
  `latitude` varchar(255) NOT NULL COMMENT 'j经度',
  `longitude` varchar(255) NOT NULL COMMENT '纬度',
  `yy_telphone` varchar(255) NOT NULL COMMENT '客服电话',
  `bq_name` varchar(255) NOT NULL COMMENT '版权名称',
  `bq_thumb` varchar(255) NOT NULL COMMENT '版权缩略图',
  `bq_telphone` varchar(255) NOT NULL COMMENT '版权电话',
  `goodslunb` text NOT NULL COMMENT '商城首页缩略图',
  `fwsite` text NOT NULL COMMENT '服务须知',
  `txxz` text NOT NULL COMMENT '提现须知',
  `zdtx` float(6,2) NOT NULL COMMENT '最低提现金额',
  `txsx` float(6,2) NOT NULL COMMENT '手续费',
  `grade` varchar(20) NOT NULL COMMENT '等级',
  `hot_title` varchar(255) NOT NULL COMMENT '热门标题',
  `tj_title` varchar(255) NOT NULL COMMENT '推荐标题',
  `state` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启先签约后问诊模式，1开启，0关闭',
  `content` text NOT NULL COMMENT '帮助手册',
  `is_search` tinyint(2) NOT NULL DEFAULT '1' COMMENT '是否开启搜索（0：否；1：是）',
  `is_hospital` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否首页展示机构（0：否；1：是）',
  `search_title` varchar(100) NOT NULL COMMENT '搜索设置',
  `USER` varchar(255) NOT NULL COMMENT '飞鹅云后台注册账号',
  `UKEY` varchar(255) NOT NULL COMMENT '飞鹅云后台注册账号后生成的UKEY',
  `SN` varchar(255) NOT NULL COMMENT '打印机编号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='基础设置表';

");

if(!pdo_fieldexists('hyb_yl_base','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '基础设置表'");}
if(!pdo_fieldexists('hyb_yl_base','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_base','show_title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `show_title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题'");}
if(!pdo_fieldexists('hyb_yl_base','show_thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `show_thumb` text NOT NULL COMMENT '首页轮播图'");}
if(!pdo_fieldexists('hyb_yl_base','baidukey')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `baidukey` varchar(255) NOT NULL COMMENT '百度地图key'");}
if(!pdo_fieldexists('hyb_yl_base','advertisement')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `advertisement` text NOT NULL COMMENT '广告幻灯片'");}
if(!pdo_fieldexists('hyb_yl_base','back_zjthumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `back_zjthumb` text NOT NULL COMMENT '专家端幻灯片'");}
if(!pdo_fieldexists('hyb_yl_base','tj_thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `tj_thumb` varchar(255) NOT NULL COMMENT '体检中心幻灯片'");}
if(!pdo_fieldexists('hyb_yl_base','ztcolor')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `ztcolor` varchar(50) NOT NULL COMMENT '小程序全局背景色'");}
if(!pdo_fieldexists('hyb_yl_base','pstatus')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `pstatus` int(11) NOT NULL COMMENT '骗审开关'");}
if(!pdo_fieldexists('hyb_yl_base','slide')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `slide` text NOT NULL COMMENT '骗审轮播图'");}
if(!pdo_fieldexists('hyb_yl_base','yy_thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `yy_thumb` varchar(255) NOT NULL COMMENT '医院背景图'");}
if(!pdo_fieldexists('hyb_yl_base','yy_title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `yy_title` varchar(50) NOT NULL COMMENT '医院名称'");}
if(!pdo_fieldexists('hyb_yl_base','lntroduction')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `lntroduction` text NOT NULL COMMENT '医院介绍'");}
if(!pdo_fieldexists('hyb_yl_base','yy_address')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `yy_address` varchar(255) NOT NULL COMMENT '医院地址'");}
if(!pdo_fieldexists('hyb_yl_base','latitude')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `latitude` varchar(255) NOT NULL COMMENT 'j经度'");}
if(!pdo_fieldexists('hyb_yl_base','longitude')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `longitude` varchar(255) NOT NULL COMMENT '纬度'");}
if(!pdo_fieldexists('hyb_yl_base','yy_telphone')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `yy_telphone` varchar(255) NOT NULL COMMENT '客服电话'");}
if(!pdo_fieldexists('hyb_yl_base','bq_name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `bq_name` varchar(255) NOT NULL COMMENT '版权名称'");}
if(!pdo_fieldexists('hyb_yl_base','bq_thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `bq_thumb` varchar(255) NOT NULL COMMENT '版权缩略图'");}
if(!pdo_fieldexists('hyb_yl_base','bq_telphone')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `bq_telphone` varchar(255) NOT NULL COMMENT '版权电话'");}
if(!pdo_fieldexists('hyb_yl_base','goodslunb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `goodslunb` text NOT NULL COMMENT '商城首页缩略图'");}
if(!pdo_fieldexists('hyb_yl_base','fwsite')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `fwsite` text NOT NULL COMMENT '服务须知'");}
if(!pdo_fieldexists('hyb_yl_base','txxz')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `txxz` text NOT NULL COMMENT '提现须知'");}
if(!pdo_fieldexists('hyb_yl_base','zdtx')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `zdtx` float(6,2) NOT NULL COMMENT '最低提现金额'");}
if(!pdo_fieldexists('hyb_yl_base','txsx')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `txsx` float(6,2) NOT NULL COMMENT '手续费'");}
if(!pdo_fieldexists('hyb_yl_base','grade')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `grade` varchar(20) NOT NULL COMMENT '等级'");}
if(!pdo_fieldexists('hyb_yl_base','hot_title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `hot_title` varchar(255) NOT NULL COMMENT '热门标题'");}
if(!pdo_fieldexists('hyb_yl_base','tj_title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `tj_title` varchar(255) NOT NULL COMMENT '推荐标题'");}
if(!pdo_fieldexists('hyb_yl_base','state')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `state` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启先签约后问诊模式，1开启，0关闭'");}
if(!pdo_fieldexists('hyb_yl_base','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `content` text NOT NULL COMMENT '帮助手册'");}
if(!pdo_fieldexists('hyb_yl_base','is_search')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `is_search` tinyint(2) NOT NULL DEFAULT '1' COMMENT '是否开启搜索（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_base','is_hospital')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `is_hospital` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否首页展示机构（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_base','search_title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `search_title` varchar(100) NOT NULL COMMENT '搜索设置'");}
if(!pdo_fieldexists('hyb_yl_base','USER')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `USER` varchar(255) NOT NULL COMMENT '飞鹅云后台注册账号'");}
if(!pdo_fieldexists('hyb_yl_base','UKEY')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `UKEY` varchar(255) NOT NULL COMMENT '飞鹅云后台注册账号后生成的UKEY'");}
if(!pdo_fieldexists('hyb_yl_base','SN')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_base')." ADD   `SN` varchar(255) NOT NULL COMMENT '打印机编号'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_blood_pressure` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `high_range_down` int(11) DEFAULT NULL COMMENT '高压低端',
  `high_range_up` int(11) DEFAULT NULL COMMENT '高压高端',
  `low_range_down` int(11) DEFAULT NULL COMMENT '低压低端',
  `low_range_up` int(11) DEFAULT NULL COMMENT '低压高端',
  `proposal_low` text COMMENT '偏低建议',
  `proposal_high` text COMMENT '偏高建议',
  `proposal_normal` text COMMENT '正常建议',
  `min_age` int(11) DEFAULT NULL COMMENT '最小年龄',
  `max_age` int(11) DEFAULT NULL COMMENT '适用最大年龄',
  `sex` varchar(50) DEFAULT NULL COMMENT '性别',
  `created` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='用户血压标准表';

");

if(!pdo_fieldexists('hyb_yl_blood_pressure','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_blood_pressure')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_blood_pressure','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_blood_pressure')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_blood_pressure','high_range_down')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_blood_pressure')." ADD   `high_range_down` int(11) DEFAULT NULL COMMENT '高压低端'");}
if(!pdo_fieldexists('hyb_yl_blood_pressure','high_range_up')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_blood_pressure')." ADD   `high_range_up` int(11) DEFAULT NULL COMMENT '高压高端'");}
if(!pdo_fieldexists('hyb_yl_blood_pressure','low_range_down')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_blood_pressure')." ADD   `low_range_down` int(11) DEFAULT NULL COMMENT '低压低端'");}
if(!pdo_fieldexists('hyb_yl_blood_pressure','low_range_up')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_blood_pressure')." ADD   `low_range_up` int(11) DEFAULT NULL COMMENT '低压高端'");}
if(!pdo_fieldexists('hyb_yl_blood_pressure','proposal_low')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_blood_pressure')." ADD   `proposal_low` text COMMENT '偏低建议'");}
if(!pdo_fieldexists('hyb_yl_blood_pressure','proposal_high')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_blood_pressure')." ADD   `proposal_high` text COMMENT '偏高建议'");}
if(!pdo_fieldexists('hyb_yl_blood_pressure','proposal_normal')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_blood_pressure')." ADD   `proposal_normal` text COMMENT '正常建议'");}
if(!pdo_fieldexists('hyb_yl_blood_pressure','min_age')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_blood_pressure')." ADD   `min_age` int(11) DEFAULT NULL COMMENT '最小年龄'");}
if(!pdo_fieldexists('hyb_yl_blood_pressure','max_age')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_blood_pressure')." ADD   `max_age` int(11) DEFAULT NULL COMMENT '适用最大年龄'");}
if(!pdo_fieldexists('hyb_yl_blood_pressure','sex')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_blood_pressure')." ADD   `sex` varchar(50) DEFAULT NULL COMMENT '性别'");}
if(!pdo_fieldexists('hyb_yl_blood_pressure','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_blood_pressure')." ADD   `created` int(11) DEFAULT NULL COMMENT '添加时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_blood_sugar` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `high_range_down` decimal(11,2) DEFAULT NULL COMMENT '最低血糖标准',
  `high_range_up` decimal(11,2) DEFAULT NULL COMMENT '最高血糖标准',
  `proposal_low` text COMMENT '血糖偏低建议',
  `proposal_high` text COMMENT '血糖偏高建议',
  `proposal_normal` text COMMENT '血糖正常建议',
  `created` int(11) DEFAULT NULL COMMENT '添加时间',
  `min_age` int(11) DEFAULT NULL COMMENT '最小年龄',
  `max_age` int(11) DEFAULT NULL COMMENT '最大年龄',
  `sex` varchar(11) DEFAULT NULL COMMENT '性别',
  `type` tinyint(2) DEFAULT '0' COMMENT '测量时间（0：空腹；1：餐后两小时）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='血糖检测标准表';

");

if(!pdo_fieldexists('hyb_yl_blood_sugar','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_blood_sugar')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_blood_sugar','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_blood_sugar')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_blood_sugar','high_range_down')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_blood_sugar')." ADD   `high_range_down` decimal(11,2) DEFAULT NULL COMMENT '最低血糖标准'");}
if(!pdo_fieldexists('hyb_yl_blood_sugar','high_range_up')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_blood_sugar')." ADD   `high_range_up` decimal(11,2) DEFAULT NULL COMMENT '最高血糖标准'");}
if(!pdo_fieldexists('hyb_yl_blood_sugar','proposal_low')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_blood_sugar')." ADD   `proposal_low` text COMMENT '血糖偏低建议'");}
if(!pdo_fieldexists('hyb_yl_blood_sugar','proposal_high')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_blood_sugar')." ADD   `proposal_high` text COMMENT '血糖偏高建议'");}
if(!pdo_fieldexists('hyb_yl_blood_sugar','proposal_normal')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_blood_sugar')." ADD   `proposal_normal` text COMMENT '血糖正常建议'");}
if(!pdo_fieldexists('hyb_yl_blood_sugar','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_blood_sugar')." ADD   `created` int(11) DEFAULT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_blood_sugar','min_age')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_blood_sugar')." ADD   `min_age` int(11) DEFAULT NULL COMMENT '最小年龄'");}
if(!pdo_fieldexists('hyb_yl_blood_sugar','max_age')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_blood_sugar')." ADD   `max_age` int(11) DEFAULT NULL COMMENT '最大年龄'");}
if(!pdo_fieldexists('hyb_yl_blood_sugar','sex')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_blood_sugar')." ADD   `sex` varchar(11) DEFAULT NULL COMMENT '性别'");}
if(!pdo_fieldexists('hyb_yl_blood_sugar','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_blood_sugar')." ADD   `type` tinyint(2) DEFAULT '0' COMMENT '测量时间（0：空腹；1：餐后两小时）'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_boxuser` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `uid` varchar(255) DEFAULT NULL COMMENT '用户id',
  `created` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COMMENT='云收款音箱用户';

");

if(!pdo_fieldexists('hyb_yl_boxuser','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_boxuser')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_boxuser','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_boxuser')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_boxuser','uid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_boxuser')." ADD   `uid` varchar(255) DEFAULT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('hyb_yl_boxuser','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_boxuser')." ADD   `created` int(11) DEFAULT NULL COMMENT '添加时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_card_pay` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '年卡支付表',
  `uniacid` int(11) NOT NULL,
  `cid` int(11) NOT NULL COMMENT '年卡id',
  `zid` int(11) NOT NULL COMMENT '专家id',
  `ordersn` varchar(255) NOT NULL COMMENT '订单编号',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：待付款；1：使用中；2：已到期）',
  `p_time` int(11) NOT NULL COMMENT '支付时间',
  `openid` varchar(255) NOT NULL COMMENT '用户标识',
  `created` int(11) NOT NULL COMMENT '添加时间',
  `end_time` int(11) NOT NULL COMMENT '到期时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='办卡记录表';

");

if(!pdo_fieldexists('hyb_yl_card_pay','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_pay')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '年卡支付表'");}
if(!pdo_fieldexists('hyb_yl_card_pay','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_pay')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_card_pay','cid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_pay')." ADD   `cid` int(11) NOT NULL COMMENT '年卡id'");}
if(!pdo_fieldexists('hyb_yl_card_pay','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_pay')." ADD   `zid` int(11) NOT NULL COMMENT '专家id'");}
if(!pdo_fieldexists('hyb_yl_card_pay','ordersn')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_pay')." ADD   `ordersn` varchar(255) NOT NULL COMMENT '订单编号'");}
if(!pdo_fieldexists('hyb_yl_card_pay','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_pay')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：待付款；1：使用中；2：已到期）'");}
if(!pdo_fieldexists('hyb_yl_card_pay','p_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_pay')." ADD   `p_time` int(11) NOT NULL COMMENT '支付时间'");}
if(!pdo_fieldexists('hyb_yl_card_pay','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_pay')." ADD   `openid` varchar(255) NOT NULL COMMENT '用户标识'");}
if(!pdo_fieldexists('hyb_yl_card_pay','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_pay')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_card_pay','end_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_pay')." ADD   `end_time` int(11) NOT NULL COMMENT '到期时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_card_rule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '年卡设置表',
  `uniacid` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否启用年卡（0：否；1：是）',
  `is_wz` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否设置免费问诊（0：否；1：是）',
  `is_zk` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否设置问诊折扣（0：否；1：是）',
  `is_hh` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否设置会话次数（0：否；1：是）',
  `is_jd` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否设置解读次数（0：否；1：是）',
  `is_ms` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启年卡免审核（0：否；1：是）',
  `content` text NOT NULL COMMENT '年卡协议',
  `created` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='年卡规则表';

");

if(!pdo_fieldexists('hyb_yl_card_rule','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_rule')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '年卡设置表'");}
if(!pdo_fieldexists('hyb_yl_card_rule','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_rule')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_card_rule','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_rule')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否启用年卡（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_card_rule','is_wz')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_rule')." ADD   `is_wz` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否设置免费问诊（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_card_rule','is_zk')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_rule')." ADD   `is_zk` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否设置问诊折扣（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_card_rule','is_hh')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_rule')." ADD   `is_hh` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否设置会话次数（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_card_rule','is_jd')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_rule')." ADD   `is_jd` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否设置解读次数（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_card_rule','is_ms')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_rule')." ADD   `is_ms` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启年卡免审核（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_card_rule','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_rule')." ADD   `content` text NOT NULL COMMENT '年卡协议'");}
if(!pdo_fieldexists('hyb_yl_card_rule','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_rule')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_card_thumb` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `mf_title` varchar(255) NOT NULL COMMENT '免费问诊名称',
  `mf_thumb` varchar(255) NOT NULL COMMENT '免费问诊图标',
  `mf_status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启免费问诊（0：否；1：是）',
  `mf_content` text NOT NULL COMMENT '免费问诊描述',
  `wz_title` varchar(255) NOT NULL COMMENT '问诊折扣名称',
  `wz_thumb` varchar(255) NOT NULL COMMENT '问诊折扣图标',
  `wz_status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启问诊折扣（0：否；1：是）',
  `wz_content` text NOT NULL COMMENT '问诊折扣内容',
  `hh_title` varchar(255) NOT NULL COMMENT '免费会话名称',
  `hh_thumb` varchar(255) NOT NULL COMMENT '免费会话图标',
  `hh_status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启免费会话（0：否；1：是）',
  `hh_content` text NOT NULL COMMENT '免费会话描述',
  `jd_title` varchar(255) NOT NULL COMMENT '免费解读名称',
  `jd_thumb` varchar(255) NOT NULL COMMENT '免费解读图标',
  `jd_status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启免费解读（0：否；1：是）',
  `jd_content` text NOT NULL COMMENT '免费解读描述',
  `created` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='年卡图标表';

");

if(!pdo_fieldexists('hyb_yl_card_thumb','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_thumb')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_card_thumb','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_thumb')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_card_thumb','mf_title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_thumb')." ADD   `mf_title` varchar(255) NOT NULL COMMENT '免费问诊名称'");}
if(!pdo_fieldexists('hyb_yl_card_thumb','mf_thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_thumb')." ADD   `mf_thumb` varchar(255) NOT NULL COMMENT '免费问诊图标'");}
if(!pdo_fieldexists('hyb_yl_card_thumb','mf_status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_thumb')." ADD   `mf_status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启免费问诊（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_card_thumb','mf_content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_thumb')." ADD   `mf_content` text NOT NULL COMMENT '免费问诊描述'");}
if(!pdo_fieldexists('hyb_yl_card_thumb','wz_title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_thumb')." ADD   `wz_title` varchar(255) NOT NULL COMMENT '问诊折扣名称'");}
if(!pdo_fieldexists('hyb_yl_card_thumb','wz_thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_thumb')." ADD   `wz_thumb` varchar(255) NOT NULL COMMENT '问诊折扣图标'");}
if(!pdo_fieldexists('hyb_yl_card_thumb','wz_status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_thumb')." ADD   `wz_status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启问诊折扣（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_card_thumb','wz_content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_thumb')." ADD   `wz_content` text NOT NULL COMMENT '问诊折扣内容'");}
if(!pdo_fieldexists('hyb_yl_card_thumb','hh_title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_thumb')." ADD   `hh_title` varchar(255) NOT NULL COMMENT '免费会话名称'");}
if(!pdo_fieldexists('hyb_yl_card_thumb','hh_thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_thumb')." ADD   `hh_thumb` varchar(255) NOT NULL COMMENT '免费会话图标'");}
if(!pdo_fieldexists('hyb_yl_card_thumb','hh_status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_thumb')." ADD   `hh_status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启免费会话（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_card_thumb','hh_content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_thumb')." ADD   `hh_content` text NOT NULL COMMENT '免费会话描述'");}
if(!pdo_fieldexists('hyb_yl_card_thumb','jd_title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_thumb')." ADD   `jd_title` varchar(255) NOT NULL COMMENT '免费解读名称'");}
if(!pdo_fieldexists('hyb_yl_card_thumb','jd_thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_thumb')." ADD   `jd_thumb` varchar(255) NOT NULL COMMENT '免费解读图标'");}
if(!pdo_fieldexists('hyb_yl_card_thumb','jd_status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_thumb')." ADD   `jd_status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启免费解读（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_card_thumb','jd_content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_thumb')." ADD   `jd_content` text NOT NULL COMMENT '免费解读描述'");}
if(!pdo_fieldexists('hyb_yl_card_thumb','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_card_thumb')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_cash` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `openid` varchar(255) DEFAULT NULL COMMENT '用户openid',
  `u_id` int(11) NOT NULL COMMENT '用户id',
  `created` int(11) NOT NULL COMMENT '申请时间',
  `type` tinyint(2) NOT NULL DEFAULT '4' COMMENT '提现类型（0：专家提现；1：代理提现；2：机构提现；3：分销提现；4用户余额提现；5：绿通提现）',
  `money` decimal(11,2) NOT NULL COMMENT '提现金额',
  `method` tinyint(2) NOT NULL COMMENT '提现方式（）',
  `fee` tinyint(2) NOT NULL COMMENT '手续费',
  `account_money` decimal(11,2) DEFAULT NULL COMMENT '到账金额',
  `account_type` tinyint(2) DEFAULT NULL COMMENT '到账类型',
  `s_time` int(11) DEFAULT NULL COMMENT '审核时间',
  `status` tinyint(2) NOT NULL COMMENT '提现状态（0：待审核；1：待打款；2：已完成；3：未通过）',
  `did` int(11) NOT NULL COMMENT '绿通id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='提现记录表';

");

if(!pdo_fieldexists('hyb_yl_cash','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_cash')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_cash','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_cash')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_cash','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_cash')." ADD   `openid` varchar(255) DEFAULT NULL COMMENT '用户openid'");}
if(!pdo_fieldexists('hyb_yl_cash','u_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_cash')." ADD   `u_id` int(11) NOT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('hyb_yl_cash','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_cash')." ADD   `created` int(11) NOT NULL COMMENT '申请时间'");}
if(!pdo_fieldexists('hyb_yl_cash','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_cash')." ADD   `type` tinyint(2) NOT NULL DEFAULT '4' COMMENT '提现类型（0：专家提现；1：代理提现；2：机构提现；3：分销提现；4用户余额提现；5：绿通提现）'");}
if(!pdo_fieldexists('hyb_yl_cash','money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_cash')." ADD   `money` decimal(11,2) NOT NULL COMMENT '提现金额'");}
if(!pdo_fieldexists('hyb_yl_cash','method')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_cash')." ADD   `method` tinyint(2) NOT NULL COMMENT '提现方式（）'");}
if(!pdo_fieldexists('hyb_yl_cash','fee')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_cash')." ADD   `fee` tinyint(2) NOT NULL COMMENT '手续费'");}
if(!pdo_fieldexists('hyb_yl_cash','account_money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_cash')." ADD   `account_money` decimal(11,2) DEFAULT NULL COMMENT '到账金额'");}
if(!pdo_fieldexists('hyb_yl_cash','account_type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_cash')." ADD   `account_type` tinyint(2) DEFAULT NULL COMMENT '到账类型'");}
if(!pdo_fieldexists('hyb_yl_cash','s_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_cash')." ADD   `s_time` int(11) DEFAULT NULL COMMENT '审核时间'");}
if(!pdo_fieldexists('hyb_yl_cash','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_cash')." ADD   `status` tinyint(2) NOT NULL COMMENT '提现状态（0：待审核；1：待打款；2：已完成；3：未通过）'");}
if(!pdo_fieldexists('hyb_yl_cash','did')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_cash')." ADD   `did` int(11) NOT NULL COMMENT '绿通id'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_ceshi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '一级科室名称',
  `uniacid` int(11) NOT NULL,
  `description` varchar(255) NOT NULL COMMENT '描述',
  `detail_cover_url` varchar(255) NOT NULL COMMENT '连接地址',
  `color` varchar(50) NOT NULL COMMENT '颜色',
  `enabled` tinyint(11) NOT NULL DEFAULT '1' COMMENT '0不显示1显示',
  `sort` tinyint(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `giftstatus` varchar(11) NOT NULL COMMENT '位置（）',
  `py` varchar(50) NOT NULL COMMENT '首字母',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=175 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='一级科室表';

");

if(!pdo_fieldexists('hyb_yl_ceshi','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_ceshi')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_ceshi','name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_ceshi')." ADD   `name` varchar(255) NOT NULL COMMENT '一级科室名称'");}
if(!pdo_fieldexists('hyb_yl_ceshi','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_ceshi')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_ceshi','description')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_ceshi')." ADD   `description` varchar(255) NOT NULL COMMENT '描述'");}
if(!pdo_fieldexists('hyb_yl_ceshi','detail_cover_url')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_ceshi')." ADD   `detail_cover_url` varchar(255) NOT NULL COMMENT '连接地址'");}
if(!pdo_fieldexists('hyb_yl_ceshi','color')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_ceshi')." ADD   `color` varchar(50) NOT NULL COMMENT '颜色'");}
if(!pdo_fieldexists('hyb_yl_ceshi','enabled')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_ceshi')." ADD   `enabled` tinyint(11) NOT NULL DEFAULT '1' COMMENT '0不显示1显示'");}
if(!pdo_fieldexists('hyb_yl_ceshi','sort')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_ceshi')." ADD   `sort` tinyint(11) NOT NULL DEFAULT '0' COMMENT '排序'");}
if(!pdo_fieldexists('hyb_yl_ceshi','giftstatus')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_ceshi')." ADD   `giftstatus` varchar(11) NOT NULL COMMENT '位置（）'");}
if(!pdo_fieldexists('hyb_yl_ceshi','py')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_ceshi')." ADD   `py` varchar(50) NOT NULL COMMENT '首字母'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_ceshiindex` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `tag_name` char(50) NOT NULL,
  `tag_category_id` int(11) NOT NULL COMMENT '1疾病2症状6辅助检查',
  `index_name` char(50) NOT NULL,
  `parentid` int(11) NOT NULL COMMENT '父类ID',
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_ceshiindex','tag_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_ceshiindex')." ADD 
  `tag_id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_ceshiindex','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_ceshiindex')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_ceshiindex','tag_name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_ceshiindex')." ADD   `tag_name` char(50) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_ceshiindex','tag_category_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_ceshiindex')." ADD   `tag_category_id` int(11) NOT NULL COMMENT '1疾病2症状6辅助检查'");}
if(!pdo_fieldexists('hyb_yl_ceshiindex','index_name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_ceshiindex')." ADD   `index_name` char(50) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_ceshiindex','parentid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_ceshiindex')." ADD   `parentid` int(11) NOT NULL COMMENT '父类ID'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_chart_list` (
  `bl_id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `data_arr` text NOT NULL,
  `useropenid` varchar(255) NOT NULL,
  `docopenid` varchar(255) NOT NULL,
  `docroom` varchar(255) NOT NULL,
  `myroom` varchar(255) NOT NULL,
  `j_id` int(11) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `msg` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `names` varchar(255) NOT NULL,
  `orders` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '0图片1语音',
  `u_name` varchar(255) NOT NULL,
  `u_thumb` varchar(255) NOT NULL,
  `z_name` varchar(255) NOT NULL,
  `z_thumbs` varchar(255) NOT NULL,
  `zid` int(11) NOT NULL,
  `ispay` int(11) NOT NULL DEFAULT '0' COMMENT '0未支付1支付了',
  `money` varchar(50) NOT NULL,
  `ifover` int(11) NOT NULL DEFAULT '0' COMMENT '0未完成1完成待评价2交易成功',
  `sate` int(11) NOT NULL DEFAULT '0' COMMENT '0用户1医生',
  PRIMARY KEY (`bl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_chart_list','bl_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chart_list')." ADD 
  `bl_id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_chart_list','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chart_list')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chart_list','data_arr')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chart_list')." ADD   `data_arr` text NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chart_list','useropenid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chart_list')." ADD   `useropenid` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chart_list','docopenid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chart_list')." ADD   `docopenid` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chart_list','docroom')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chart_list')." ADD   `docroom` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chart_list','myroom')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chart_list')." ADD   `myroom` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chart_list','j_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chart_list')." ADD   `j_id` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chart_list','keywords')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chart_list')." ADD   `keywords` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chart_list','msg')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chart_list')." ADD   `msg` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chart_list','name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chart_list')." ADD   `name` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chart_list','names')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chart_list')." ADD   `names` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chart_list','orders')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chart_list')." ADD   `orders` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chart_list','time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chart_list')." ADD   `time` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chart_list','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chart_list')." ADD   `type` int(11) NOT NULL DEFAULT '0' COMMENT '0图片1语音'");}
if(!pdo_fieldexists('hyb_yl_chart_list','u_name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chart_list')." ADD   `u_name` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chart_list','u_thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chart_list')." ADD   `u_thumb` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chart_list','z_name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chart_list')." ADD   `z_name` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chart_list','z_thumbs')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chart_list')." ADD   `z_thumbs` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chart_list','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chart_list')." ADD   `zid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chart_list','ispay')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chart_list')." ADD   `ispay` int(11) NOT NULL DEFAULT '0' COMMENT '0未支付1支付了'");}
if(!pdo_fieldexists('hyb_yl_chart_list','money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chart_list')." ADD   `money` varchar(50) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chart_list','ifover')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chart_list')." ADD   `ifover` int(11) NOT NULL DEFAULT '0' COMMENT '0未完成1完成待评价2交易成功'");}
if(!pdo_fieldexists('hyb_yl_chart_list','sate')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chart_list')." ADD   `sate` int(11) NOT NULL DEFAULT '0' COMMENT '0用户1医生'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_chat_msg_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `sate` tinyint(2) NOT NULL DEFAULT '0' COMMENT '用户类型（0：用户；1：医生）',
  `style` varchar(50) NOT NULL,
  `text` varchar(255) NOT NULL COMMENT 'l聊天文字',
  `time` char(50) NOT NULL COMMENT '发送时间',
  `type` char(50) NOT NULL,
  `img` varchar(255) NOT NULL COMMENT '聊天图片',
  `chatType` char(11) NOT NULL,
  `mid` char(50) NOT NULL,
  `username` varchar(255) NOT NULL COMMENT '用户名称',
  `yourname` varchar(255) NOT NULL,
  `style2` char(50) NOT NULL,
  `u_openid` varchar(255) NOT NULL COMMENT '用户标识',
  `zid` int(11) NOT NULL COMMENT '专家id',
  `oid` int(11) NOT NULL COMMENT '订单id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_chat_msg_list','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chat_msg_list')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_chat_msg_list','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chat_msg_list')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chat_msg_list','sate')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chat_msg_list')." ADD   `sate` tinyint(2) NOT NULL DEFAULT '0' COMMENT '用户类型（0：用户；1：医生）'");}
if(!pdo_fieldexists('hyb_yl_chat_msg_list','style')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chat_msg_list')." ADD   `style` varchar(50) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chat_msg_list','text')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chat_msg_list')." ADD   `text` varchar(255) NOT NULL COMMENT 'l聊天文字'");}
if(!pdo_fieldexists('hyb_yl_chat_msg_list','time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chat_msg_list')." ADD   `time` char(50) NOT NULL COMMENT '发送时间'");}
if(!pdo_fieldexists('hyb_yl_chat_msg_list','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chat_msg_list')." ADD   `type` char(50) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chat_msg_list','img')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chat_msg_list')." ADD   `img` varchar(255) NOT NULL COMMENT '聊天图片'");}
if(!pdo_fieldexists('hyb_yl_chat_msg_list','chatType')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chat_msg_list')." ADD   `chatType` char(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chat_msg_list','mid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chat_msg_list')." ADD   `mid` char(50) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chat_msg_list','username')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chat_msg_list')." ADD   `username` varchar(255) NOT NULL COMMENT '用户名称'");}
if(!pdo_fieldexists('hyb_yl_chat_msg_list','yourname')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chat_msg_list')." ADD   `yourname` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chat_msg_list','style2')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chat_msg_list')." ADD   `style2` char(50) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chat_msg_list','u_openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chat_msg_list')." ADD   `u_openid` varchar(255) NOT NULL COMMENT '用户标识'");}
if(!pdo_fieldexists('hyb_yl_chat_msg_list','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chat_msg_list')." ADD   `zid` int(11) NOT NULL COMMENT '专家id'");}
if(!pdo_fieldexists('hyb_yl_chat_msg_list','oid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chat_msg_list')." ADD   `oid` int(11) NOT NULL COMMENT '订单id'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_chufang` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '处方id',
  `uniacid` int(11) NOT NULL,
  `textarr` varchar(255) NOT NULL,
  `ypList` longtext NOT NULL COMMENT '药品列表',
  `useropenid` varchar(255) NOT NULL COMMENT '用户openid',
  `j_id` int(11) NOT NULL COMMENT '机构id',
  `zid` int(11) NOT NULL COMMENT '专家ID',
  `cfpic` varchar(255) NOT NULL COMMENT '处方照片',
  `money` float(6,2) NOT NULL COMMENT '金额',
  `ispay` int(11) NOT NULL DEFAULT '0' COMMENT '0待支付1已支付待接诊2接诊中3已完成待评价4已评价5申请退款6已退款7已关闭8取消',
  `orders` varchar(255) NOT NULL COMMENT '订单号',
  `y_id` int(11) NOT NULL COMMENT '药师id',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：待审核；1：审核通过；2：审核拒绝；3：已取消）',
  `kf_time` int(11) NOT NULL COMMENT '开方时间',
  `s_time` int(11) NOT NULL COMMENT '审核时间',
  `paytime` int(11) NOT NULL COMMENT '支付时间',
  `p_type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '付款方式（0：余额支付；1：微信支付）',
  `telphone` varchar(100) NOT NULL COMMENT '用户电话',
  `address` varchar(255) NOT NULL COMMENT '用户地址',
  `a_id` int(11) NOT NULL COMMENT '地址id',
  `typs` tinyint(2) NOT NULL DEFAULT '1' COMMENT '处方类型（1：有处方；0：无处方）',
  `name` varchar(255) NOT NULL COMMENT '收货人姓名',
  `express` varchar(255) NOT NULL COMMENT '快递名称',
  `courier_number` varchar(255) NOT NULL COMMENT '快递单号',
  `userid` int(11) NOT NULL COMMENT '用户ID',
  `content` text NOT NULL COMMENT '问题描述',
  `time` int(11) NOT NULL COMMENT '下单时间',
  `ifgk` tinyint(2) NOT NULL DEFAULT '0' COMMENT '1公开0不公开',
  `back_orser` varchar(255) NOT NULL COMMENT '统一订单',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '专家回复的问题id',
  `role` int(11) NOT NULL DEFAULT '0' COMMENT '0用户1医生',
  `grade` int(11) NOT NULL DEFAULT '1' COMMENT '1一级2二级',
  `key_words` varchar(50) NOT NULL COMMENT '服务包关键词',
  `addnum` int(11) unsigned NOT NULL COMMENT '追问次数',
  `overtime` int(11) NOT NULL COMMENT '结束时间',
  `dumiao` varchar(50) NOT NULL COMMENT '读秒',
  `old_money` decimal(11,2) NOT NULL COMMENT '订单原价',
  `coupon_id` int(11) NOT NULL COMMENT '优惠券id',
  `coupon_dk` decimal(11,2) NOT NULL COMMENT '优惠券抵扣金额',
  `yid` int(11) NOT NULL COMMENT '年卡id',
  `year_dk` decimal(11,2) NOT NULL COMMENT '年卡抵扣金额',
  `ifgb` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0未关闭1已关闭',
  `jztime` datetime NOT NULL COMMENT '接诊时间',
  `mp3` varchar(255) NOT NULL,
  `thtime` varchar(255) NOT NULL,
  `card_dk` decimal(11,2) NOT NULL COMMENT '会员卡抵扣',
  `ptmoney` decimal(11,2) NOT NULL COMMENT '平台抽成',
  `hosmoney` decimal(11,2) NOT NULL COMMENT '机构抽成',
  `docmoney` decimal(11,2) NOT NULL COMMENT '专家抽成',
  `ysmoney` decimal(11,2) NOT NULL COMMENT '要是抽成',
  `tk_one` decimal(11,2) NOT NULL COMMENT '推客一级抽成',
  `tk_two` decimal(11,2) NOT NULL COMMENT '推客二级抽成',
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_chufang','c_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD 
  `c_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '处方id'");}
if(!pdo_fieldexists('hyb_yl_chufang','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chufang','textarr')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `textarr` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chufang','ypList')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `ypList` longtext NOT NULL COMMENT '药品列表'");}
if(!pdo_fieldexists('hyb_yl_chufang','useropenid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `useropenid` varchar(255) NOT NULL COMMENT '用户openid'");}
if(!pdo_fieldexists('hyb_yl_chufang','j_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `j_id` int(11) NOT NULL COMMENT '机构id'");}
if(!pdo_fieldexists('hyb_yl_chufang','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `zid` int(11) NOT NULL COMMENT '专家ID'");}
if(!pdo_fieldexists('hyb_yl_chufang','cfpic')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `cfpic` varchar(255) NOT NULL COMMENT '处方照片'");}
if(!pdo_fieldexists('hyb_yl_chufang','money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `money` float(6,2) NOT NULL COMMENT '金额'");}
if(!pdo_fieldexists('hyb_yl_chufang','ispay')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `ispay` int(11) NOT NULL DEFAULT '0' COMMENT '0待支付1已支付待接诊2接诊中3已完成待评价4已评价5申请退款6已退款7已关闭8取消'");}
if(!pdo_fieldexists('hyb_yl_chufang','orders')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `orders` varchar(255) NOT NULL COMMENT '订单号'");}
if(!pdo_fieldexists('hyb_yl_chufang','y_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `y_id` int(11) NOT NULL COMMENT '药师id'");}
if(!pdo_fieldexists('hyb_yl_chufang','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：待审核；1：审核通过；2：审核拒绝；3：已取消）'");}
if(!pdo_fieldexists('hyb_yl_chufang','kf_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `kf_time` int(11) NOT NULL COMMENT '开方时间'");}
if(!pdo_fieldexists('hyb_yl_chufang','s_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `s_time` int(11) NOT NULL COMMENT '审核时间'");}
if(!pdo_fieldexists('hyb_yl_chufang','paytime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `paytime` int(11) NOT NULL COMMENT '支付时间'");}
if(!pdo_fieldexists('hyb_yl_chufang','p_type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `p_type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '付款方式（0：余额支付；1：微信支付）'");}
if(!pdo_fieldexists('hyb_yl_chufang','telphone')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `telphone` varchar(100) NOT NULL COMMENT '用户电话'");}
if(!pdo_fieldexists('hyb_yl_chufang','address')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `address` varchar(255) NOT NULL COMMENT '用户地址'");}
if(!pdo_fieldexists('hyb_yl_chufang','a_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `a_id` int(11) NOT NULL COMMENT '地址id'");}
if(!pdo_fieldexists('hyb_yl_chufang','typs')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `typs` tinyint(2) NOT NULL DEFAULT '1' COMMENT '处方类型（1：有处方；0：无处方）'");}
if(!pdo_fieldexists('hyb_yl_chufang','name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `name` varchar(255) NOT NULL COMMENT '收货人姓名'");}
if(!pdo_fieldexists('hyb_yl_chufang','express')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `express` varchar(255) NOT NULL COMMENT '快递名称'");}
if(!pdo_fieldexists('hyb_yl_chufang','courier_number')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `courier_number` varchar(255) NOT NULL COMMENT '快递单号'");}
if(!pdo_fieldexists('hyb_yl_chufang','userid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `userid` int(11) NOT NULL COMMENT '用户ID'");}
if(!pdo_fieldexists('hyb_yl_chufang','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `content` text NOT NULL COMMENT '问题描述'");}
if(!pdo_fieldexists('hyb_yl_chufang','time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `time` int(11) NOT NULL COMMENT '下单时间'");}
if(!pdo_fieldexists('hyb_yl_chufang','ifgk')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `ifgk` tinyint(2) NOT NULL DEFAULT '0' COMMENT '1公开0不公开'");}
if(!pdo_fieldexists('hyb_yl_chufang','back_orser')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `back_orser` varchar(255) NOT NULL COMMENT '统一订单'");}
if(!pdo_fieldexists('hyb_yl_chufang','pid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `pid` int(11) NOT NULL DEFAULT '0' COMMENT '专家回复的问题id'");}
if(!pdo_fieldexists('hyb_yl_chufang','role')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `role` int(11) NOT NULL DEFAULT '0' COMMENT '0用户1医生'");}
if(!pdo_fieldexists('hyb_yl_chufang','grade')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `grade` int(11) NOT NULL DEFAULT '1' COMMENT '1一级2二级'");}
if(!pdo_fieldexists('hyb_yl_chufang','key_words')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `key_words` varchar(50) NOT NULL COMMENT '服务包关键词'");}
if(!pdo_fieldexists('hyb_yl_chufang','addnum')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `addnum` int(11) unsigned NOT NULL COMMENT '追问次数'");}
if(!pdo_fieldexists('hyb_yl_chufang','overtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `overtime` int(11) NOT NULL COMMENT '结束时间'");}
if(!pdo_fieldexists('hyb_yl_chufang','dumiao')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `dumiao` varchar(50) NOT NULL COMMENT '读秒'");}
if(!pdo_fieldexists('hyb_yl_chufang','old_money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `old_money` decimal(11,2) NOT NULL COMMENT '订单原价'");}
if(!pdo_fieldexists('hyb_yl_chufang','coupon_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `coupon_id` int(11) NOT NULL COMMENT '优惠券id'");}
if(!pdo_fieldexists('hyb_yl_chufang','coupon_dk')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `coupon_dk` decimal(11,2) NOT NULL COMMENT '优惠券抵扣金额'");}
if(!pdo_fieldexists('hyb_yl_chufang','yid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `yid` int(11) NOT NULL COMMENT '年卡id'");}
if(!pdo_fieldexists('hyb_yl_chufang','year_dk')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `year_dk` decimal(11,2) NOT NULL COMMENT '年卡抵扣金额'");}
if(!pdo_fieldexists('hyb_yl_chufang','ifgb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `ifgb` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0未关闭1已关闭'");}
if(!pdo_fieldexists('hyb_yl_chufang','jztime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `jztime` datetime NOT NULL COMMENT '接诊时间'");}
if(!pdo_fieldexists('hyb_yl_chufang','mp3')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `mp3` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chufang','thtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `thtime` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chufang','card_dk')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `card_dk` decimal(11,2) NOT NULL COMMENT '会员卡抵扣'");}
if(!pdo_fieldexists('hyb_yl_chufang','ptmoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `ptmoney` decimal(11,2) NOT NULL COMMENT '平台抽成'");}
if(!pdo_fieldexists('hyb_yl_chufang','hosmoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `hosmoney` decimal(11,2) NOT NULL COMMENT '机构抽成'");}
if(!pdo_fieldexists('hyb_yl_chufang','docmoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `docmoney` decimal(11,2) NOT NULL COMMENT '专家抽成'");}
if(!pdo_fieldexists('hyb_yl_chufang','ysmoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `ysmoney` decimal(11,2) NOT NULL COMMENT '要是抽成'");}
if(!pdo_fieldexists('hyb_yl_chufang','tk_one')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `tk_one` decimal(11,2) NOT NULL COMMENT '推客一级抽成'");}
if(!pdo_fieldexists('hyb_yl_chufang','tk_two')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang')." ADD   `tk_two` decimal(11,2) NOT NULL COMMENT '推客二级抽成'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_chufang_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '日志id',
  `uniacid` int(11) NOT NULL,
  `cid` int(11) NOT NULL DEFAULT '0' COMMENT '处方id 0默认为用户自己的处方单',
  `content` varchar(255) NOT NULL COMMENT '内容',
  `created` int(11) NOT NULL COMMENT '提交时间',
  `zid` int(11) NOT NULL COMMENT '医生id',
  `key_words` varchar(255) NOT NULL COMMENT '关键词处方',
  `openid` varchar(255) NOT NULL COMMENT '用户openid',
  `back_orser` varchar(255) NOT NULL COMMENT '处方问诊记录订单',
  `cartlist` text NOT NULL COMMENT '商品列表',
  `j_id` int(11) NOT NULL COMMENT '患者id',
  `totals` float(7,2) NOT NULL,
  `ifpay` int(11) NOT NULL DEFAULT '0' COMMENT '0未支付1已支付待发货2已发货配送中3已送达4确认收货5已完成待评价6已评价7已取消8拒收',
  `orders` varchar(255) NOT NULL COMMENT '处方单号',
  `address` text NOT NULL COMMENT '地址',
  `tell` varchar(255) NOT NULL COMMENT '手机号',
  `name` varchar(255) NOT NULL COMMENT '用户名',
  `ysid` int(11) NOT NULL COMMENT '药师ID',
  `state` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0未审核1审核通过后发货2不通过退款',
  `tgtime` int(11) NOT NULL COMMENT '审核通过时间',
  `kftime` int(11) NOT NULL COMMENT '开方时间',
  `zhenduan` varchar(255) NOT NULL COMMENT '诊断',
  `yongyao` varchar(255) NOT NULL COMMENT '用药',
  `chufang` varchar(255) NOT NULL COMMENT '处方建议',
  `drugsArr` longtext NOT NULL COMMENT '其他用药',
  `paytime` int(11) DEFAULT NULL COMMENT '支付时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='操作日志表';

");

if(!pdo_fieldexists('hyb_yl_chufang_log','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang_log')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '日志id'");}
if(!pdo_fieldexists('hyb_yl_chufang_log','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang_log')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chufang_log','cid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang_log')." ADD   `cid` int(11) NOT NULL DEFAULT '0' COMMENT '处方id 0默认为用户自己的处方单'");}
if(!pdo_fieldexists('hyb_yl_chufang_log','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang_log')." ADD   `content` varchar(255) NOT NULL COMMENT '内容'");}
if(!pdo_fieldexists('hyb_yl_chufang_log','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang_log')." ADD   `created` int(11) NOT NULL COMMENT '提交时间'");}
if(!pdo_fieldexists('hyb_yl_chufang_log','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang_log')." ADD   `zid` int(11) NOT NULL COMMENT '医生id'");}
if(!pdo_fieldexists('hyb_yl_chufang_log','key_words')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang_log')." ADD   `key_words` varchar(255) NOT NULL COMMENT '关键词处方'");}
if(!pdo_fieldexists('hyb_yl_chufang_log','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang_log')." ADD   `openid` varchar(255) NOT NULL COMMENT '用户openid'");}
if(!pdo_fieldexists('hyb_yl_chufang_log','back_orser')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang_log')." ADD   `back_orser` varchar(255) NOT NULL COMMENT '处方问诊记录订单'");}
if(!pdo_fieldexists('hyb_yl_chufang_log','cartlist')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang_log')." ADD   `cartlist` text NOT NULL COMMENT '商品列表'");}
if(!pdo_fieldexists('hyb_yl_chufang_log','j_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang_log')." ADD   `j_id` int(11) NOT NULL COMMENT '患者id'");}
if(!pdo_fieldexists('hyb_yl_chufang_log','totals')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang_log')." ADD   `totals` float(7,2) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chufang_log','ifpay')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang_log')." ADD   `ifpay` int(11) NOT NULL DEFAULT '0' COMMENT '0未支付1已支付待发货2已发货配送中3已送达4确认收货5已完成待评价6已评价7已取消8拒收'");}
if(!pdo_fieldexists('hyb_yl_chufang_log','orders')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang_log')." ADD   `orders` varchar(255) NOT NULL COMMENT '处方单号'");}
if(!pdo_fieldexists('hyb_yl_chufang_log','address')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang_log')." ADD   `address` text NOT NULL COMMENT '地址'");}
if(!pdo_fieldexists('hyb_yl_chufang_log','tell')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang_log')." ADD   `tell` varchar(255) NOT NULL COMMENT '手机号'");}
if(!pdo_fieldexists('hyb_yl_chufang_log','name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang_log')." ADD   `name` varchar(255) NOT NULL COMMENT '用户名'");}
if(!pdo_fieldexists('hyb_yl_chufang_log','ysid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang_log')." ADD   `ysid` int(11) NOT NULL COMMENT '药师ID'");}
if(!pdo_fieldexists('hyb_yl_chufang_log','state')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang_log')." ADD   `state` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0未审核1审核通过后发货2不通过退款'");}
if(!pdo_fieldexists('hyb_yl_chufang_log','tgtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang_log')." ADD   `tgtime` int(11) NOT NULL COMMENT '审核通过时间'");}
if(!pdo_fieldexists('hyb_yl_chufang_log','kftime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang_log')." ADD   `kftime` int(11) NOT NULL COMMENT '开方时间'");}
if(!pdo_fieldexists('hyb_yl_chufang_log','zhenduan')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang_log')." ADD   `zhenduan` varchar(255) NOT NULL COMMENT '诊断'");}
if(!pdo_fieldexists('hyb_yl_chufang_log','yongyao')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang_log')." ADD   `yongyao` varchar(255) NOT NULL COMMENT '用药'");}
if(!pdo_fieldexists('hyb_yl_chufang_log','chufang')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang_log')." ADD   `chufang` varchar(255) NOT NULL COMMENT '处方建议'");}
if(!pdo_fieldexists('hyb_yl_chufang_log','drugsArr')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang_log')." ADD   `drugsArr` longtext NOT NULL COMMENT '其他用药'");}
if(!pdo_fieldexists('hyb_yl_chufang_log','paytime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufang_log')." ADD   `paytime` int(11) DEFAULT NULL COMMENT '支付时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_chufangfl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('hyb_yl_chufangfl','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufangfl')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_chufangfl','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufangfl')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chufangfl','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufangfl')." ADD   `title` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chufangfl','icon')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufangfl')." ADD   `icon` varchar(255) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_chufangmobo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL COMMENT '标题',
  `content` longtext NOT NULL COMMENT '内容',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `pid` int(11) NOT NULL,
  `desc` varchar(255) NOT NULL COMMENT '处方描述',
  `zhenduan` varchar(255) NOT NULL COMMENT '诊断建议',
  `yongyao` varchar(255) NOT NULL COMMENT '药品信息',
  `chufang` varchar(255) NOT NULL COMMENT '处方详情',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COMMENT='处方模板表';

");

if(!pdo_fieldexists('hyb_yl_chufangmobo','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufangmobo')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_chufangmobo','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufangmobo')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chufangmobo','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufangmobo')." ADD   `title` varchar(255) NOT NULL COMMENT '标题'");}
if(!pdo_fieldexists('hyb_yl_chufangmobo','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufangmobo')." ADD   `content` longtext NOT NULL COMMENT '内容'");}
if(!pdo_fieldexists('hyb_yl_chufangmobo','addtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufangmobo')." ADD   `addtime` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_chufangmobo','pid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufangmobo')." ADD   `pid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chufangmobo','desc')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufangmobo')." ADD   `desc` varchar(255) NOT NULL COMMENT '处方描述'");}
if(!pdo_fieldexists('hyb_yl_chufangmobo','zhenduan')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufangmobo')." ADD   `zhenduan` varchar(255) NOT NULL COMMENT '诊断建议'");}
if(!pdo_fieldexists('hyb_yl_chufangmobo','yongyao')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufangmobo')." ADD   `yongyao` varchar(255) NOT NULL COMMENT '药品信息'");}
if(!pdo_fieldexists('hyb_yl_chufangmobo','chufang')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufangmobo')." ADD   `chufang` varchar(255) NOT NULL COMMENT '处方详情'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_chufangxilie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL COMMENT '标题',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `pid` int(11) NOT NULL COMMENT '上级id',
  `icon` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='处方协议表';

");

if(!pdo_fieldexists('hyb_yl_chufangxilie','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufangxilie')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_chufangxilie','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufangxilie')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_chufangxilie','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufangxilie')." ADD   `title` varchar(255) NOT NULL COMMENT '标题'");}
if(!pdo_fieldexists('hyb_yl_chufangxilie','addtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufangxilie')." ADD   `addtime` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_chufangxilie','pid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufangxilie')." ADD   `pid` int(11) NOT NULL COMMENT '上级id'");}
if(!pdo_fieldexists('hyb_yl_chufangxilie','icon')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_chufangxilie')." ADD   `icon` varchar(255) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_classgory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `ctname` varchar(50) NOT NULL COMMENT '二级科室名称',
  `state` tinyint(5) NOT NULL DEFAULT '1' COMMENT '0不显示1显示',
  `describe` varchar(255) NOT NULL COMMENT '描述',
  `typeint` int(11) NOT NULL DEFAULT '0' COMMENT '0科室类别1疾病类别2:症状类别；3：疫苗类别；4：检查项类别；5：备药类别；6：传染病类别',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8 COMMENT='二级科室表';

");

if(!pdo_fieldexists('hyb_yl_classgory','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_classgory')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_classgory','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_classgory')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_classgory','ctname')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_classgory')." ADD   `ctname` varchar(50) NOT NULL COMMENT '二级科室名称'");}
if(!pdo_fieldexists('hyb_yl_classgory','state')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_classgory')." ADD   `state` tinyint(5) NOT NULL DEFAULT '1' COMMENT '0不显示1显示'");}
if(!pdo_fieldexists('hyb_yl_classgory','describe')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_classgory')." ADD   `describe` varchar(255) NOT NULL COMMENT '描述'");}
if(!pdo_fieldexists('hyb_yl_classgory','typeint')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_classgory')." ADD   `typeint` int(11) NOT NULL DEFAULT '0' COMMENT '0科室类别1疾病类别2:症状类别；3：疫苗类别；4：检查项类别；5：备药类别；6：传染病类别'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_community` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL COMMENT '社区标题',
  `address` varchar(255) NOT NULL COMMENT '所在地',
  `lon` varchar(50) NOT NULL,
  `lat` varchar(50) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：禁用；1：启用）',
  `province` varchar(255) NOT NULL COMMENT '所在省',
  `city` varchar(255) NOT NULL COMMENT '所在市',
  `district` varchar(255) NOT NULL COMMENT '所在区',
  `created` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='社区表';

");

if(!pdo_fieldexists('hyb_yl_community','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_community')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_community','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_community')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_community','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_community')." ADD   `title` varchar(255) NOT NULL COMMENT '社区标题'");}
if(!pdo_fieldexists('hyb_yl_community','address')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_community')." ADD   `address` varchar(255) NOT NULL COMMENT '所在地'");}
if(!pdo_fieldexists('hyb_yl_community','lon')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_community')." ADD   `lon` varchar(50) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_community','lat')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_community')." ADD   `lat` varchar(50) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_community','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_community')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：禁用；1：启用）'");}
if(!pdo_fieldexists('hyb_yl_community','province')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_community')." ADD   `province` varchar(255) NOT NULL COMMENT '所在省'");}
if(!pdo_fieldexists('hyb_yl_community','city')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_community')." ADD   `city` varchar(255) NOT NULL COMMENT '所在市'");}
if(!pdo_fieldexists('hyb_yl_community','district')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_community')." ADD   `district` varchar(255) NOT NULL COMMENT '所在区'");}
if(!pdo_fieldexists('hyb_yl_community','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_community')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_coupon` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL COMMENT '卡券名称',
  `hid` int(10) NOT NULL DEFAULT '0' COMMENT '所属机构',
  `daily` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '满减 满金额',
  `first` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '满减 减金额',
  `usagetype` int(10) NOT NULL DEFAULT '0' COMMENT '优惠券类型 0:代金券',
  `deductible_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '抵扣金额',
  `sub_title` varchar(255) DEFAULT NULL COMMENT '使用说明',
  `applicableservices` longtext COMMENT '适用服务',
  `starttime` varchar(255) DEFAULT NULL COMMENT '使用开始时间',
  `endtime` varchar(255) DEFAULT NULL COMMENT '使用结束时间',
  `state` int(10) NOT NULL DEFAULT '0' COMMENT '状态 0启用 1禁用',
  `sortorder` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='卡券表';

");

if(!pdo_fieldexists('hyb_yl_coupon','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_coupon')." ADD 
  `id` int(10) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_coupon','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_coupon')." ADD   `uniacid` int(10) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_coupon','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_coupon')." ADD   `title` varchar(255) DEFAULT NULL COMMENT '卡券名称'");}
if(!pdo_fieldexists('hyb_yl_coupon','hid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_coupon')." ADD   `hid` int(10) NOT NULL DEFAULT '0' COMMENT '所属机构'");}
if(!pdo_fieldexists('hyb_yl_coupon','daily')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_coupon')." ADD   `daily` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '满减 满金额'");}
if(!pdo_fieldexists('hyb_yl_coupon','first')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_coupon')." ADD   `first` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '满减 减金额'");}
if(!pdo_fieldexists('hyb_yl_coupon','usagetype')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_coupon')." ADD   `usagetype` int(10) NOT NULL DEFAULT '0' COMMENT '优惠券类型 0:代金券'");}
if(!pdo_fieldexists('hyb_yl_coupon','deductible_amount')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_coupon')." ADD   `deductible_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '抵扣金额'");}
if(!pdo_fieldexists('hyb_yl_coupon','sub_title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_coupon')." ADD   `sub_title` varchar(255) DEFAULT NULL COMMENT '使用说明'");}
if(!pdo_fieldexists('hyb_yl_coupon','applicableservices')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_coupon')." ADD   `applicableservices` longtext COMMENT '适用服务'");}
if(!pdo_fieldexists('hyb_yl_coupon','starttime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_coupon')." ADD   `starttime` varchar(255) DEFAULT NULL COMMENT '使用开始时间'");}
if(!pdo_fieldexists('hyb_yl_coupon','endtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_coupon')." ADD   `endtime` varchar(255) DEFAULT NULL COMMENT '使用结束时间'");}
if(!pdo_fieldexists('hyb_yl_coupon','state')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_coupon')." ADD   `state` int(10) NOT NULL DEFAULT '0' COMMENT '状态 0启用 1禁用'");}
if(!pdo_fieldexists('hyb_yl_coupon','sortorder')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_coupon')." ADD   `sortorder` int(10) NOT NULL DEFAULT '0' COMMENT '排序'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_coupon_code` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) DEFAULT NULL,
  `cid` int(10) NOT NULL DEFAULT '0' COMMENT '优惠券id',
  `code` varchar(255) DEFAULT NULL COMMENT '兑换码',
  `status` int(10) NOT NULL DEFAULT '0' COMMENT '使用状态 0待领取 1待使用 2已使用',
  `createtime` varchar(255) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='卡券使用表';

");

if(!pdo_fieldexists('hyb_yl_coupon_code','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_coupon_code')." ADD 
  `id` int(10) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_coupon_code','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_coupon_code')." ADD   `uniacid` int(10) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_coupon_code','cid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_coupon_code')." ADD   `cid` int(10) NOT NULL DEFAULT '0' COMMENT '优惠券id'");}
if(!pdo_fieldexists('hyb_yl_coupon_code','code')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_coupon_code')." ADD   `code` varchar(255) DEFAULT NULL COMMENT '兑换码'");}
if(!pdo_fieldexists('hyb_yl_coupon_code','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_coupon_code')." ADD   `status` int(10) NOT NULL DEFAULT '0' COMMENT '使用状态 0待领取 1待使用 2已使用'");}
if(!pdo_fieldexists('hyb_yl_coupon_code','createtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_coupon_code')." ADD   `createtime` varchar(255) DEFAULT NULL COMMENT '创建时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_crowd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `crowd_name` varchar(255) NOT NULL,
  `create_time` int(11) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_crowd','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_crowd')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_crowd','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_crowd')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_crowd','crowd_name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_crowd')." ADD   `crowd_name` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_crowd','create_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_crowd')." ADD   `create_time` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_crowd','thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_crowd')." ADD   `thumb` varchar(255) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_doc_all_serverlist` (
  `ids` int(11) NOT NULL AUTO_INCREMENT COMMENT '专家开通服务表',
  `uniacid` int(11) NOT NULL,
  `zid` int(11) NOT NULL COMMENT '专家id',
  `key_words` varchar(255) NOT NULL COMMENT '服务关键字',
  `bid` int(11) NOT NULL COMMENT '医生服务包表id',
  `titlme` varchar(255) NOT NULL COMMENT '服务标题',
  `time` datetime NOT NULL COMMENT '服务开通时间',
  `time_leng` int(11) NOT NULL COMMENT '服务到期时间',
  `ptmoney` float(7,2) NOT NULL COMMENT '普通金额',
  `hymoney` float(7,2) NOT NULL COMMENT '会员金额',
  `hyzhuiw` int(11) NOT NULL COMMENT '会员追问次数',
  `ptzhuiw` int(11) NOT NULL COMMENT '普通会员追问次数',
  `stateback` tinyint(2) NOT NULL DEFAULT '0' COMMENT '开关',
  `money` float(7,2) NOT NULL COMMENT '服务开通金额',
  `kt_type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0平台开通1专家申请',
  `orders` varchar(255) NOT NULL COMMENT '专家申请时0的订单平台不产生订单号',
  `opnum` int(11) NOT NULL DEFAULT '0' COMMENT '开通次数',
  `overtime` int(15) NOT NULL COMMENT '服务到期时间',
  PRIMARY KEY (`ids`)
) ENGINE=InnoDB AUTO_INCREMENT=457 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_doc_all_serverlist','ids')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_doc_all_serverlist')." ADD 
  `ids` int(11) NOT NULL AUTO_INCREMENT COMMENT '专家开通服务表'");}
if(!pdo_fieldexists('hyb_yl_doc_all_serverlist','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_doc_all_serverlist')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_doc_all_serverlist','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_doc_all_serverlist')." ADD   `zid` int(11) NOT NULL COMMENT '专家id'");}
if(!pdo_fieldexists('hyb_yl_doc_all_serverlist','key_words')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_doc_all_serverlist')." ADD   `key_words` varchar(255) NOT NULL COMMENT '服务关键字'");}
if(!pdo_fieldexists('hyb_yl_doc_all_serverlist','bid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_doc_all_serverlist')." ADD   `bid` int(11) NOT NULL COMMENT '医生服务包表id'");}
if(!pdo_fieldexists('hyb_yl_doc_all_serverlist','titlme')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_doc_all_serverlist')." ADD   `titlme` varchar(255) NOT NULL COMMENT '服务标题'");}
if(!pdo_fieldexists('hyb_yl_doc_all_serverlist','time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_doc_all_serverlist')." ADD   `time` datetime NOT NULL COMMENT '服务开通时间'");}
if(!pdo_fieldexists('hyb_yl_doc_all_serverlist','time_leng')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_doc_all_serverlist')." ADD   `time_leng` int(11) NOT NULL COMMENT '服务到期时间'");}
if(!pdo_fieldexists('hyb_yl_doc_all_serverlist','ptmoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_doc_all_serverlist')." ADD   `ptmoney` float(7,2) NOT NULL COMMENT '普通金额'");}
if(!pdo_fieldexists('hyb_yl_doc_all_serverlist','hymoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_doc_all_serverlist')." ADD   `hymoney` float(7,2) NOT NULL COMMENT '会员金额'");}
if(!pdo_fieldexists('hyb_yl_doc_all_serverlist','hyzhuiw')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_doc_all_serverlist')." ADD   `hyzhuiw` int(11) NOT NULL COMMENT '会员追问次数'");}
if(!pdo_fieldexists('hyb_yl_doc_all_serverlist','ptzhuiw')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_doc_all_serverlist')." ADD   `ptzhuiw` int(11) NOT NULL COMMENT '普通会员追问次数'");}
if(!pdo_fieldexists('hyb_yl_doc_all_serverlist','stateback')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_doc_all_serverlist')." ADD   `stateback` tinyint(2) NOT NULL DEFAULT '0' COMMENT '开关'");}
if(!pdo_fieldexists('hyb_yl_doc_all_serverlist','money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_doc_all_serverlist')." ADD   `money` float(7,2) NOT NULL COMMENT '服务开通金额'");}
if(!pdo_fieldexists('hyb_yl_doc_all_serverlist','kt_type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_doc_all_serverlist')." ADD   `kt_type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0平台开通1专家申请'");}
if(!pdo_fieldexists('hyb_yl_doc_all_serverlist','orders')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_doc_all_serverlist')." ADD   `orders` varchar(255) NOT NULL COMMENT '专家申请时0的订单平台不产生订单号'");}
if(!pdo_fieldexists('hyb_yl_doc_all_serverlist','opnum')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_doc_all_serverlist')." ADD   `opnum` int(11) NOT NULL DEFAULT '0' COMMENT '开通次数'");}
if(!pdo_fieldexists('hyb_yl_doc_all_serverlist','overtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_doc_all_serverlist')." ADD   `overtime` int(15) NOT NULL COMMENT '服务到期时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_docjobtime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `server_time` text NOT NULL COMMENT '工作时间',
  `nums` int(11) NOT NULL COMMENT '预约人数',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `state` tinyint(11) NOT NULL DEFAULT '0' COMMENT '状态(0：关闭；1：开启）',
  `zid` int(11) NOT NULL COMMENT '专家id',
  `type` varchar(50) NOT NULL COMMENT '上午下午',
  `style` tinyint(2) NOT NULL DEFAULT '0' COMMENT '排版分类（0：问诊；1：挂号）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='专家排版表';

");

if(!pdo_fieldexists('hyb_yl_docjobtime','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docjobtime')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_docjobtime','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docjobtime')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_docjobtime','server_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docjobtime')." ADD   `server_time` text NOT NULL COMMENT '工作时间'");}
if(!pdo_fieldexists('hyb_yl_docjobtime','nums')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docjobtime')." ADD   `nums` int(11) NOT NULL COMMENT '预约人数'");}
if(!pdo_fieldexists('hyb_yl_docjobtime','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docjobtime')." ADD   `title` varchar(255) NOT NULL COMMENT '标题'");}
if(!pdo_fieldexists('hyb_yl_docjobtime','state')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docjobtime')." ADD   `state` tinyint(11) NOT NULL DEFAULT '0' COMMENT '状态(0：关闭；1：开启）'");}
if(!pdo_fieldexists('hyb_yl_docjobtime','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docjobtime')." ADD   `zid` int(11) NOT NULL COMMENT '专家id'");}
if(!pdo_fieldexists('hyb_yl_docjobtime','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docjobtime')." ADD   `type` varchar(50) NOT NULL COMMENT '上午下午'");}
if(!pdo_fieldexists('hyb_yl_docjobtime','style')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docjobtime')." ADD   `style` tinyint(2) NOT NULL DEFAULT '0' COMMENT '排版分类（0：问诊；1：挂号）'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_docser_speck` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `thumb` varchar(255) NOT NULL COMMENT '服务主页图片',
  `sort` int(11) NOT NULL COMMENT '排序',
  `titlme` varchar(255) NOT NULL COMMENT '标题',
  `icon` varchar(255) NOT NULL COMMENT 'icon',
  `url` varchar(255) NOT NULL COMMENT '跳转地址',
  `state` tinyint(2) NOT NULL COMMENT '是否显示（0：否；1：是）',
  `server_content` text NOT NULL COMMENT '协议',
  `key_words` varchar(50) NOT NULL COMMENT '关键词',
  `time` varchar(255) NOT NULL COMMENT '添加时间',
  `ftitle` varchar(255) NOT NULL COMMENT '关联标题',
  `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1问诊0患者服务',
  `buyreading` text NOT NULL COMMENT '买前必读',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COMMENT='医生服务包';

");

if(!pdo_fieldexists('hyb_yl_docser_speck','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docser_speck')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_docser_speck','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docser_speck')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_docser_speck','thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docser_speck')." ADD   `thumb` varchar(255) NOT NULL COMMENT '服务主页图片'");}
if(!pdo_fieldexists('hyb_yl_docser_speck','sort')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docser_speck')." ADD   `sort` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('hyb_yl_docser_speck','titlme')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docser_speck')." ADD   `titlme` varchar(255) NOT NULL COMMENT '标题'");}
if(!pdo_fieldexists('hyb_yl_docser_speck','icon')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docser_speck')." ADD   `icon` varchar(255) NOT NULL COMMENT 'icon'");}
if(!pdo_fieldexists('hyb_yl_docser_speck','url')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docser_speck')." ADD   `url` varchar(255) NOT NULL COMMENT '跳转地址'");}
if(!pdo_fieldexists('hyb_yl_docser_speck','state')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docser_speck')." ADD   `state` tinyint(2) NOT NULL COMMENT '是否显示（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_docser_speck','server_content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docser_speck')." ADD   `server_content` text NOT NULL COMMENT '协议'");}
if(!pdo_fieldexists('hyb_yl_docser_speck','key_words')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docser_speck')." ADD   `key_words` varchar(50) NOT NULL COMMENT '关键词'");}
if(!pdo_fieldexists('hyb_yl_docser_speck','time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docser_speck')." ADD   `time` varchar(255) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_docser_speck','ftitle')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docser_speck')." ADD   `ftitle` varchar(255) NOT NULL COMMENT '关联标题'");}
if(!pdo_fieldexists('hyb_yl_docser_speck','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docser_speck')." ADD   `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1问诊0患者服务'");}
if(!pdo_fieldexists('hyb_yl_docser_speck','buyreading')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docser_speck')." ADD   `buyreading` text NOT NULL COMMENT '买前必读'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_docserver` (
  `serid` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `zid` int(11) NOT NULL COMMENT '专家id',
  `sid` int(11) NOT NULL,
  `state` int(11) NOT NULL COMMENT '状态',
  `thumb` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `uid` int(11) NOT NULL,
  `pinyin` varchar(255) NOT NULL COMMENT '拼音',
  PRIMARY KEY (`serid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_docserver','serid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docserver')." ADD 
  `serid` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_docserver','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docserver')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_docserver','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docserver')." ADD   `zid` int(11) NOT NULL COMMENT '专家id'");}
if(!pdo_fieldexists('hyb_yl_docserver','sid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docserver')." ADD   `sid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_docserver','state')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docserver')." ADD   `state` int(11) NOT NULL COMMENT '状态'");}
if(!pdo_fieldexists('hyb_yl_docserver','thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docserver')." ADD   `thumb` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_docserver','desc')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docserver')." ADD   `desc` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_docserver','name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docserver')." ADD   `name` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_docserver','uid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docserver')." ADD   `uid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_docserver','pinyin')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docserver')." ADD   `pinyin` varchar(255) NOT NULL COMMENT '拼音'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_docserver_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `title` varchar(50) NOT NULL COMMENT '标题',
  `time_leng` int(11) NOT NULL COMMENT '时长',
  `money` float(7,2) NOT NULL COMMENT '金额',
  `typeid` int(11) NOT NULL COMMENT '关联id',
  `stort` int(11) NOT NULL COMMENT '排序',
  `fx_type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0参与1不参与',
  `one_fx` varchar(50) NOT NULL COMMENT '一级分销',
  `two_tx` varchar(50) NOT NULL COMMENT '二级分销',
  `if_store` tinyint(11) NOT NULL DEFAULT '0' COMMENT '1不审核0审核',
  `if_xf` tinyint(11) NOT NULL DEFAULT '1' COMMENT '1续费0无需',
  `if_open` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1启用0不启用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_docserver_type','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docserver_type')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_docserver_type','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docserver_type')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_docserver_type','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docserver_type')." ADD   `title` varchar(50) NOT NULL COMMENT '标题'");}
if(!pdo_fieldexists('hyb_yl_docserver_type','time_leng')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docserver_type')." ADD   `time_leng` int(11) NOT NULL COMMENT '时长'");}
if(!pdo_fieldexists('hyb_yl_docserver_type','money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docserver_type')." ADD   `money` float(7,2) NOT NULL COMMENT '金额'");}
if(!pdo_fieldexists('hyb_yl_docserver_type','typeid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docserver_type')." ADD   `typeid` int(11) NOT NULL COMMENT '关联id'");}
if(!pdo_fieldexists('hyb_yl_docserver_type','stort')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docserver_type')." ADD   `stort` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('hyb_yl_docserver_type','fx_type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docserver_type')." ADD   `fx_type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0参与1不参与'");}
if(!pdo_fieldexists('hyb_yl_docserver_type','one_fx')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docserver_type')." ADD   `one_fx` varchar(50) NOT NULL COMMENT '一级分销'");}
if(!pdo_fieldexists('hyb_yl_docserver_type','two_tx')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docserver_type')." ADD   `two_tx` varchar(50) NOT NULL COMMENT '二级分销'");}
if(!pdo_fieldexists('hyb_yl_docserver_type','if_store')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docserver_type')." ADD   `if_store` tinyint(11) NOT NULL DEFAULT '0' COMMENT '1不审核0审核'");}
if(!pdo_fieldexists('hyb_yl_docserver_type','if_xf')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docserver_type')." ADD   `if_xf` tinyint(11) NOT NULL DEFAULT '1' COMMENT '1续费0无需'");}
if(!pdo_fieldexists('hyb_yl_docserver_type','if_open')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_docserver_type')." ADD   `if_open` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1启用0不启用'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_duanxin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `key` varchar(50) NOT NULL COMMENT '短信key',
  `scret` varchar(50) NOT NULL COMMENT '短信秘钥',
  `qianming` varchar(50) NOT NULL COMMENT '签名',
  `moban_id` text NOT NULL COMMENT '模板id',
  `templateid` varchar(255) NOT NULL COMMENT '短信通知ID',
  `stadus` int(11) NOT NULL DEFAULT '0' COMMENT '状态（0：关闭；1：开启）',
  `tel` varchar(50) NOT NULL COMMENT '接收短信号码',
  `cfmb` varchar(255) NOT NULL,
  `zztz` varchar(255) NOT NULL COMMENT '转诊通知',
  `state` tinyint(5) NOT NULL DEFAULT '1' COMMENT '1开启0关闭',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_duanxin','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duanxin')." ADD 
  `id` int(10) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_duanxin','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duanxin')." ADD   `uniacid` int(10) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_duanxin','key')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duanxin')." ADD   `key` varchar(50) NOT NULL COMMENT '短信key'");}
if(!pdo_fieldexists('hyb_yl_duanxin','scret')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duanxin')." ADD   `scret` varchar(50) NOT NULL COMMENT '短信秘钥'");}
if(!pdo_fieldexists('hyb_yl_duanxin','qianming')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duanxin')." ADD   `qianming` varchar(50) NOT NULL COMMENT '签名'");}
if(!pdo_fieldexists('hyb_yl_duanxin','moban_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duanxin')." ADD   `moban_id` text NOT NULL COMMENT '模板id'");}
if(!pdo_fieldexists('hyb_yl_duanxin','templateid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duanxin')." ADD   `templateid` varchar(255) NOT NULL COMMENT '短信通知ID'");}
if(!pdo_fieldexists('hyb_yl_duanxin','stadus')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duanxin')." ADD   `stadus` int(11) NOT NULL DEFAULT '0' COMMENT '状态（0：关闭；1：开启）'");}
if(!pdo_fieldexists('hyb_yl_duanxin','tel')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duanxin')." ADD   `tel` varchar(50) NOT NULL COMMENT '接收短信号码'");}
if(!pdo_fieldexists('hyb_yl_duanxin','cfmb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duanxin')." ADD   `cfmb` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_duanxin','zztz')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duanxin')." ADD   `zztz` varchar(255) NOT NULL COMMENT '转诊通知'");}
if(!pdo_fieldexists('hyb_yl_duanxin','state')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duanxin')." ADD   `state` tinyint(5) NOT NULL DEFAULT '1' COMMENT '1开启0关闭'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_duanxin_mobel` (
  `id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `mb_title` varchar(50) NOT NULL COMMENT '模板标题',
  `state` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1开启0关闭',
  `mb_code` varchar(255) NOT NULL COMMENT '模板id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_duanxin_mobel','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duanxin_mobel')." ADD 
  `id` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_duanxin_mobel','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duanxin_mobel')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_duanxin_mobel','mb_title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duanxin_mobel')." ADD   `mb_title` varchar(50) NOT NULL COMMENT '模板标题'");}
if(!pdo_fieldexists('hyb_yl_duanxin_mobel','state')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duanxin_mobel')." ADD   `state` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1开启0关闭'");}
if(!pdo_fieldexists('hyb_yl_duanxin_mobel','mb_code')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duanxin_mobel')." ADD   `mb_code` varchar(255) NOT NULL COMMENT '模板id'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_duibi_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `openid` varchar(255) NOT NULL COMMENT '用户标识',
  `addtime` varchar(255) NOT NULL COMMENT '添加时间',
  `duiidarr` varchar(255) NOT NULL COMMENT '对比数据',
  `ordernums` varchar(255) NOT NULL COMMENT '订单号',
  `zhengchang` varchar(255) NOT NULL COMMENT '正常项',
  `yichang` varchar(255) NOT NULL COMMENT '异常项',
  `quanbu` varchar(255) NOT NULL COMMENT '全部项目',
  `conetnt` varchar(255) NOT NULL COMMENT '对比结果',
  `ifzhuanhua` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0未转化1已转化',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='体检对比表';

");

if(!pdo_fieldexists('hyb_yl_duibi_data','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duibi_data')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_duibi_data','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duibi_data')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_duibi_data','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duibi_data')." ADD   `openid` varchar(255) NOT NULL COMMENT '用户标识'");}
if(!pdo_fieldexists('hyb_yl_duibi_data','addtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duibi_data')." ADD   `addtime` varchar(255) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_duibi_data','duiidarr')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duibi_data')." ADD   `duiidarr` varchar(255) NOT NULL COMMENT '对比数据'");}
if(!pdo_fieldexists('hyb_yl_duibi_data','ordernums')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duibi_data')." ADD   `ordernums` varchar(255) NOT NULL COMMENT '订单号'");}
if(!pdo_fieldexists('hyb_yl_duibi_data','zhengchang')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duibi_data')." ADD   `zhengchang` varchar(255) NOT NULL COMMENT '正常项'");}
if(!pdo_fieldexists('hyb_yl_duibi_data','yichang')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duibi_data')." ADD   `yichang` varchar(255) NOT NULL COMMENT '异常项'");}
if(!pdo_fieldexists('hyb_yl_duibi_data','quanbu')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duibi_data')." ADD   `quanbu` varchar(255) NOT NULL COMMENT '全部项目'");}
if(!pdo_fieldexists('hyb_yl_duibi_data','conetnt')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duibi_data')." ADD   `conetnt` varchar(255) NOT NULL COMMENT '对比结果'");}
if(!pdo_fieldexists('hyb_yl_duibi_data','ifzhuanhua')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duibi_data')." ADD   `ifzhuanhua` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0未转化1已转化'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_duibi_data_back` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `openid` varchar(255) NOT NULL COMMENT '用户标识',
  `zidarr` varchar(255) NOT NULL COMMENT '专家id',
  `articleidarr` varchar(255) NOT NULL COMMENT '文章id',
  `goodsidarr` varchar(255) NOT NULL COMMENT '商品id',
  `addtime` varchar(255) NOT NULL COMMENT '添加时间',
  `title_arr` varchar(255) NOT NULL COMMENT '对比关键字',
  `ordernums` varchar(255) NOT NULL COMMENT '订单号',
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('hyb_yl_duibi_data_back','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duibi_data_back')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_duibi_data_back','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duibi_data_back')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_duibi_data_back','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duibi_data_back')." ADD   `openid` varchar(255) NOT NULL COMMENT '用户标识'");}
if(!pdo_fieldexists('hyb_yl_duibi_data_back','zidarr')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duibi_data_back')." ADD   `zidarr` varchar(255) NOT NULL COMMENT '专家id'");}
if(!pdo_fieldexists('hyb_yl_duibi_data_back','articleidarr')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duibi_data_back')." ADD   `articleidarr` varchar(255) NOT NULL COMMENT '文章id'");}
if(!pdo_fieldexists('hyb_yl_duibi_data_back','goodsidarr')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duibi_data_back')." ADD   `goodsidarr` varchar(255) NOT NULL COMMENT '商品id'");}
if(!pdo_fieldexists('hyb_yl_duibi_data_back','addtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duibi_data_back')." ADD   `addtime` varchar(255) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_duibi_data_back','title_arr')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duibi_data_back')." ADD   `title_arr` varchar(255) NOT NULL COMMENT '对比关键字'");}
if(!pdo_fieldexists('hyb_yl_duibi_data_back','ordernums')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duibi_data_back')." ADD   `ordernums` varchar(255) NOT NULL COMMENT '订单号'");}
if(!pdo_fieldexists('hyb_yl_duibi_data_back','pid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duibi_data_back')." ADD   `pid` int(11) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_duibi_rule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `c_num` int(11) NOT NULL COMMENT '推荐文章最多展示数',
  `z_num` int(11) NOT NULL COMMENT '推荐专家最多展示数',
  `r_num` int(11) NOT NULL COMMENT '推荐问题最多展示数',
  `is_cun` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否启用异常指标留存（0：否；1：是）',
  `is_pipei` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否启用智能匹配（0：否；1：是）',
  `created` int(11) NOT NULL COMMENT '添加时间',
  `cp_num` int(11) NOT NULL COMMENT '推荐产品最多展示数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='对比规则表';

");

if(!pdo_fieldexists('hyb_yl_duibi_rule','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duibi_rule')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_duibi_rule','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duibi_rule')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_duibi_rule','c_num')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duibi_rule')." ADD   `c_num` int(11) NOT NULL COMMENT '推荐文章最多展示数'");}
if(!pdo_fieldexists('hyb_yl_duibi_rule','z_num')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duibi_rule')." ADD   `z_num` int(11) NOT NULL COMMENT '推荐专家最多展示数'");}
if(!pdo_fieldexists('hyb_yl_duibi_rule','r_num')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duibi_rule')." ADD   `r_num` int(11) NOT NULL COMMENT '推荐问题最多展示数'");}
if(!pdo_fieldexists('hyb_yl_duibi_rule','is_cun')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duibi_rule')." ADD   `is_cun` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否启用异常指标留存（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_duibi_rule','is_pipei')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duibi_rule')." ADD   `is_pipei` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否启用智能匹配（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_duibi_rule','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duibi_rule')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_duibi_rule','cp_num')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_duibi_rule')." ADD   `cp_num` int(11) NOT NULL COMMENT '推荐产品最多展示数'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_fwlist` (
  `ff_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '服务id',
  `uniacid` int(11) NOT NULL,
  `fw_name` varchar(255) NOT NULL COMMENT '服务名称',
  `fw_pic` varchar(255) NOT NULL COMMENT '服务图片',
  `fw_xy` longtext NOT NULL COMMENT '服务协议',
  `pid` int(11) NOT NULL,
  `fw_money` float(8,2) NOT NULL COMMENT '服务金额',
  `fw_startime` int(11) NOT NULL COMMENT '服务开始时间',
  `fw_endtime` int(11) NOT NULL COMMENT '服务结束时间',
  `fw_neirong` varchar(255) NOT NULL COMMENT '服务内容',
  PRIMARY KEY (`ff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_fwlist','ff_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_fwlist')." ADD 
  `ff_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '服务id'");}
if(!pdo_fieldexists('hyb_yl_fwlist','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_fwlist')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_fwlist','fw_name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_fwlist')." ADD   `fw_name` varchar(255) NOT NULL COMMENT '服务名称'");}
if(!pdo_fieldexists('hyb_yl_fwlist','fw_pic')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_fwlist')." ADD   `fw_pic` varchar(255) NOT NULL COMMENT '服务图片'");}
if(!pdo_fieldexists('hyb_yl_fwlist','fw_xy')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_fwlist')." ADD   `fw_xy` longtext NOT NULL COMMENT '服务协议'");}
if(!pdo_fieldexists('hyb_yl_fwlist','pid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_fwlist')." ADD   `pid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_fwlist','fw_money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_fwlist')." ADD   `fw_money` float(8,2) NOT NULL COMMENT '服务金额'");}
if(!pdo_fieldexists('hyb_yl_fwlist','fw_startime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_fwlist')." ADD   `fw_startime` int(11) NOT NULL COMMENT '服务开始时间'");}
if(!pdo_fieldexists('hyb_yl_fwlist','fw_endtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_fwlist')." ADD   `fw_endtime` int(11) NOT NULL COMMENT '服务结束时间'");}
if(!pdo_fieldexists('hyb_yl_fwlist','fw_neirong')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_fwlist')." ADD   `fw_neirong` varchar(255) NOT NULL COMMENT '服务内容'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_fwlist_copy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `fw_sjmoney` float(11,0) NOT NULL COMMENT '服务实际价格',
  `ff_id` int(11) NOT NULL COMMENT '服务包id',
  `kttime` int(11) NOT NULL COMMENT '开通时间',
  `t_id` int(11) NOT NULL,
  `fl_id` int(11) NOT NULL COMMENT '人群分类',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_fwlist_copy','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_fwlist_copy')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_fwlist_copy','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_fwlist_copy')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_fwlist_copy','fw_sjmoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_fwlist_copy')." ADD   `fw_sjmoney` float(11,0) NOT NULL COMMENT '服务实际价格'");}
if(!pdo_fieldexists('hyb_yl_fwlist_copy','ff_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_fwlist_copy')." ADD   `ff_id` int(11) NOT NULL COMMENT '服务包id'");}
if(!pdo_fieldexists('hyb_yl_fwlist_copy','kttime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_fwlist_copy')." ADD   `kttime` int(11) NOT NULL COMMENT '开通时间'");}
if(!pdo_fieldexists('hyb_yl_fwlist_copy','t_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_fwlist_copy')." ADD   `t_id` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_fwlist_copy','fl_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_fwlist_copy')." ADD   `fl_id` int(11) NOT NULL COMMENT '人群分类'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_gh_paiban` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `zid` int(11) NOT NULL COMMENT '专家id',
  `openid` varchar(255) NOT NULL COMMENT '用户标识',
  `g_id` int(11) NOT NULL COMMENT '排版id',
  `zz_time` varchar(255) NOT NULL COMMENT '坐诊时间',
  `num` int(11) NOT NULL COMMENT '预约人数',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：空闲中；1：休息中；3：忙碌中）',
  `created` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='挂号排版表';

");

if(!pdo_fieldexists('hyb_yl_gh_paiban','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_gh_paiban')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_gh_paiban','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_gh_paiban')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_gh_paiban','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_gh_paiban')." ADD   `zid` int(11) NOT NULL COMMENT '专家id'");}
if(!pdo_fieldexists('hyb_yl_gh_paiban','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_gh_paiban')." ADD   `openid` varchar(255) NOT NULL COMMENT '用户标识'");}
if(!pdo_fieldexists('hyb_yl_gh_paiban','g_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_gh_paiban')." ADD   `g_id` int(11) NOT NULL COMMENT '排版id'");}
if(!pdo_fieldexists('hyb_yl_gh_paiban','zz_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_gh_paiban')." ADD   `zz_time` varchar(255) NOT NULL COMMENT '坐诊时间'");}
if(!pdo_fieldexists('hyb_yl_gh_paiban','num')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_gh_paiban')." ADD   `num` int(11) NOT NULL COMMENT '预约人数'");}
if(!pdo_fieldexists('hyb_yl_gh_paiban','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_gh_paiban')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：空闲中；1：休息中；3：忙碌中）'");}
if(!pdo_fieldexists('hyb_yl_gh_paiban','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_gh_paiban')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_gh_rule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `times` int(11) NOT NULL COMMENT '预约时间',
  `people` int(11) NOT NULL COMMENT '同一时间接纳人数',
  `num` int(11) NOT NULL COMMENT '免费追问次数',
  `price` decimal(11,2) NOT NULL COMMENT '超过每次追加价格',
  `created` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='挂号规则表';

");

if(!pdo_fieldexists('hyb_yl_gh_rule','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_gh_rule')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_gh_rule','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_gh_rule')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_gh_rule','times')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_gh_rule')." ADD   `times` int(11) NOT NULL COMMENT '预约时间'");}
if(!pdo_fieldexists('hyb_yl_gh_rule','people')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_gh_rule')." ADD   `people` int(11) NOT NULL COMMENT '同一时间接纳人数'");}
if(!pdo_fieldexists('hyb_yl_gh_rule','num')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_gh_rule')." ADD   `num` int(11) NOT NULL COMMENT '免费追问次数'");}
if(!pdo_fieldexists('hyb_yl_gh_rule','price')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_gh_rule')." ADD   `price` decimal(11,2) NOT NULL COMMENT '超过每次追加价格'");}
if(!pdo_fieldexists('hyb_yl_gh_rule','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_gh_rule')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_ghyy_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL COMMENT '标题',
  `thumb` varchar(255) NOT NULL COMMENT '图片',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：隐藏；1：显示）',
  `created` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='挂号预约类型表';

");

if(!pdo_fieldexists('hyb_yl_ghyy_type','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_ghyy_type')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_ghyy_type','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_ghyy_type')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_ghyy_type','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_ghyy_type')." ADD   `title` varchar(255) NOT NULL COMMENT '标题'");}
if(!pdo_fieldexists('hyb_yl_ghyy_type','thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_ghyy_type')." ADD   `thumb` varchar(255) NOT NULL COMMENT '图片'");}
if(!pdo_fieldexists('hyb_yl_ghyy_type','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_ghyy_type')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：隐藏；1：显示）'");}
if(!pdo_fieldexists('hyb_yl_ghyy_type','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_ghyy_type')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_goodsarr` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `sname` varchar(255) NOT NULL COMMENT '商品名称',
  `smoney` float(7,2) NOT NULL COMMENT '原价',
  `snum` int(10) unsigned NOT NULL COMMENT '库存',
  `sthumb` varchar(255) NOT NULL COMMENT '首页图片',
  `spic` text NOT NULL COMMENT '商品轮播图',
  `sdescribe` varchar(255) NOT NULL COMMENT '商品描述',
  `scontent` text NOT NULL COMMENT '商品详情',
  `date` varchar(255) NOT NULL COMMENT '入库时间',
  `supplier` varchar(255) NOT NULL COMMENT '供应商',
  `state` int(11) NOT NULL DEFAULT '0' COMMENT '上架',
  `rec` int(11) NOT NULL DEFAULT '0' COMMENT '推荐',
  `g_id` int(11) NOT NULL COMMENT '分类id',
  `gg_type` tinyint(11) NOT NULL DEFAULT '0' COMMENT '是否开启规格1开启0关闭',
  `spxl` int(11) NOT NULL DEFAULT '0',
  `adminqy` tinyint(11) NOT NULL DEFAULT '0' COMMENT '0关闭1开启',
  `yhqy` int(11) NOT NULL DEFAULT '0' COMMENT '优惠权益是否开启',
  `g_kuaidi` float(6,2) NOT NULL COMMENT '快递费用',
  `g_baoyou` tinyint(11) NOT NULL DEFAULT '0' COMMENT '0不包邮1包邮',
  `g_content` text NOT NULL,
  `ifcfy` tinyint(11) NOT NULL DEFAULT '0' COMMENT '0非处方药1处方药',
  `mostgt` int(11) NOT NULL,
  `s_id` int(11) NOT NULL COMMENT '商家id',
  `retail_price` decimal(11,2) NOT NULL COMMENT '零售价',
  `trade_price` decimal(11,2) NOT NULL COMMENT '批发价',
  `company` varchar(20) NOT NULL COMMENT '单位',
  `sort` int(11) NOT NULL COMMENT '排序',
  `is_tui` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否支持退款（0：否；1：是）',
  `jigou_one` int(11) NOT NULL COMMENT '一级机构id',
  `jigou_two` int(11) NOT NULL COMMENT '二级机构id',
  `hy_money` decimal(11,2) NOT NULL COMMENT '会员减免金额',
  `xn_num` int(11) NOT NULL COMMENT '虚拟销量',
  `xg_num` int(11) NOT NULL COMMENT '限购数量',
  `is_dl` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启独立结算规则（0：否；1：是）',
  `js_money` decimal(11,2) NOT NULL COMMENT '结算金额',
  `is_fenxiao` tinyint(2) NOT NULL COMMENT '是否参与分销',
  `fx_one` decimal(11,2) NOT NULL COMMENT '一级分销结算金额',
  `fx_two` decimal(11,2) NOT NULL COMMENT '二级分销结算金额',
  `js_type` tinyint(2) NOT NULL COMMENT '分销佣金结算时间（0：订单完成时结算；1：订单支付是结算）',
  `share_thumb` varchar(255) NOT NULL COMMENT '分享图片',
  `share_title` varchar(255) NOT NULL COMMENT '分享标题',
  `share_detail` varchar(255) NOT NULL COMMENT '分享描述',
  `buy_score` int(11) NOT NULL COMMENT '购买所得积分',
  `one_dikou` decimal(11,2) NOT NULL COMMENT '积分抵扣比例',
  `dikou` decimal(11,2) NOT NULL COMMENT '积分抵扣（单件抵扣）',
  `start` int(11) NOT NULL COMMENT '购买开始时间',
  `end` int(11) NOT NULL COMMENT '购买结束时间',
  `yf_id` int(11) NOT NULL COMMENT '运费模板',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '审核状态（0：待审核；1：审核通过；2：审核拒绝；3：已删除）',
  `guige` varchar(255) NOT NULL COMMENT '规格标题',
  `doc_num` varchar(50) NOT NULL COMMENT '批准文号',
  `pp_title` varchar(255) NOT NULL COMMENT '品牌名称',
  `component` text NOT NULL COMMENT '成分',
  `character` text NOT NULL COMMENT '性状',
  `adapt` text NOT NULL COMMENT '适应症',
  `use` text NOT NULL COMMENT '用法用量',
  `adverse_reactions` text NOT NULL COMMENT '不良反应',
  `com` varchar(255) NOT NULL COMMENT '快递公司编号',
  `kf_money` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '开方服务费',
  `barcode` varchar(255) DEFAULT NULL COMMENT '条形码',
  `code_num` varchar(50) DEFAULT NULL COMMENT '条形码参数',
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COMMENT='商品表';

");

if(!pdo_fieldexists('hyb_yl_goodsarr','sid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD 
  `sid` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_goodsarr','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_goodsarr','sname')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `sname` varchar(255) NOT NULL COMMENT '商品名称'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','smoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `smoney` float(7,2) NOT NULL COMMENT '原价'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','snum')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `snum` int(10) unsigned NOT NULL COMMENT '库存'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','sthumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `sthumb` varchar(255) NOT NULL COMMENT '首页图片'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','spic')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `spic` text NOT NULL COMMENT '商品轮播图'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','sdescribe')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `sdescribe` varchar(255) NOT NULL COMMENT '商品描述'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','scontent')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `scontent` text NOT NULL COMMENT '商品详情'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','date')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `date` varchar(255) NOT NULL COMMENT '入库时间'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','supplier')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `supplier` varchar(255) NOT NULL COMMENT '供应商'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','state')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `state` int(11) NOT NULL DEFAULT '0' COMMENT '上架'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','rec')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `rec` int(11) NOT NULL DEFAULT '0' COMMENT '推荐'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','g_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `g_id` int(11) NOT NULL COMMENT '分类id'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','gg_type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `gg_type` tinyint(11) NOT NULL DEFAULT '0' COMMENT '是否开启规格1开启0关闭'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','spxl')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `spxl` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','adminqy')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `adminqy` tinyint(11) NOT NULL DEFAULT '0' COMMENT '0关闭1开启'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','yhqy')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `yhqy` int(11) NOT NULL DEFAULT '0' COMMENT '优惠权益是否开启'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','g_kuaidi')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `g_kuaidi` float(6,2) NOT NULL COMMENT '快递费用'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','g_baoyou')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `g_baoyou` tinyint(11) NOT NULL DEFAULT '0' COMMENT '0不包邮1包邮'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','g_content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `g_content` text NOT NULL");}
if(!pdo_fieldexists('hyb_yl_goodsarr','ifcfy')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `ifcfy` tinyint(11) NOT NULL DEFAULT '0' COMMENT '0非处方药1处方药'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','mostgt')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `mostgt` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_goodsarr','s_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `s_id` int(11) NOT NULL COMMENT '商家id'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','retail_price')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `retail_price` decimal(11,2) NOT NULL COMMENT '零售价'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','trade_price')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `trade_price` decimal(11,2) NOT NULL COMMENT '批发价'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','company')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `company` varchar(20) NOT NULL COMMENT '单位'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','sort')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `sort` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','is_tui')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `is_tui` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否支持退款（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','jigou_one')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `jigou_one` int(11) NOT NULL COMMENT '一级机构id'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','jigou_two')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `jigou_two` int(11) NOT NULL COMMENT '二级机构id'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','hy_money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `hy_money` decimal(11,2) NOT NULL COMMENT '会员减免金额'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','xn_num')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `xn_num` int(11) NOT NULL COMMENT '虚拟销量'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','xg_num')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `xg_num` int(11) NOT NULL COMMENT '限购数量'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','is_dl')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `is_dl` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启独立结算规则（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','js_money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `js_money` decimal(11,2) NOT NULL COMMENT '结算金额'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','is_fenxiao')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `is_fenxiao` tinyint(2) NOT NULL COMMENT '是否参与分销'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','fx_one')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `fx_one` decimal(11,2) NOT NULL COMMENT '一级分销结算金额'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','fx_two')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `fx_two` decimal(11,2) NOT NULL COMMENT '二级分销结算金额'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','js_type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `js_type` tinyint(2) NOT NULL COMMENT '分销佣金结算时间（0：订单完成时结算；1：订单支付是结算）'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','share_thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `share_thumb` varchar(255) NOT NULL COMMENT '分享图片'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','share_title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `share_title` varchar(255) NOT NULL COMMENT '分享标题'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','share_detail')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `share_detail` varchar(255) NOT NULL COMMENT '分享描述'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','buy_score')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `buy_score` int(11) NOT NULL COMMENT '购买所得积分'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','one_dikou')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `one_dikou` decimal(11,2) NOT NULL COMMENT '积分抵扣比例'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','dikou')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `dikou` decimal(11,2) NOT NULL COMMENT '积分抵扣（单件抵扣）'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','start')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `start` int(11) NOT NULL COMMENT '购买开始时间'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','end')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `end` int(11) NOT NULL COMMENT '购买结束时间'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','yf_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `yf_id` int(11) NOT NULL COMMENT '运费模板'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '审核状态（0：待审核；1：审核通过；2：审核拒绝；3：已删除）'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','guige')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `guige` varchar(255) NOT NULL COMMENT '规格标题'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','doc_num')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `doc_num` varchar(50) NOT NULL COMMENT '批准文号'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','pp_title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `pp_title` varchar(255) NOT NULL COMMENT '品牌名称'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','component')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `component` text NOT NULL COMMENT '成分'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','character')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `character` text NOT NULL COMMENT '性状'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','adapt')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `adapt` text NOT NULL COMMENT '适应症'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','use')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `use` text NOT NULL COMMENT '用法用量'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','adverse_reactions')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `adverse_reactions` text NOT NULL COMMENT '不良反应'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','com')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `com` varchar(255) NOT NULL COMMENT '快递公司编号'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','kf_money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `kf_money` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '开方服务费'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','barcode')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `barcode` varchar(255) DEFAULT NULL COMMENT '条形码'");}
if(!pdo_fieldexists('hyb_yl_goodsarr','code_num')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsarr')." ADD   `code_num` varchar(50) DEFAULT NULL COMMENT '条形码参数'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_goodsfenl` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `fenlname` varchar(255) NOT NULL COMMENT '分类名字',
  `fenlpic` varchar(255) NOT NULL COMMENT '分类图标',
  `rec` int(11) NOT NULL DEFAULT '0' COMMENT '是否推荐（0：否；1：是）',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`fid`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_goodsfenl','fid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsfenl')." ADD 
  `fid` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_goodsfenl','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsfenl')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_goodsfenl','fenlname')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsfenl')." ADD   `fenlname` varchar(255) NOT NULL COMMENT '分类名字'");}
if(!pdo_fieldexists('hyb_yl_goodsfenl','fenlpic')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsfenl')." ADD   `fenlpic` varchar(255) NOT NULL COMMENT '分类图标'");}
if(!pdo_fieldexists('hyb_yl_goodsfenl','rec')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsfenl')." ADD   `rec` int(11) NOT NULL DEFAULT '0' COMMENT '是否推荐（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_goodsfenl','sort')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsfenl')." ADD   `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_goodsguige` (
  `gg_id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `gg_name` varchar(255) NOT NULL COMMENT '规格标题',
  `gg_thumb` varchar(255) NOT NULL COMMENT '缩略图',
  `gg_money` float(8,2) NOT NULL COMMENT '金额',
  `gg_text` varchar(255) NOT NULL COMMENT '规格描述',
  `gg_kucun` int(11) NOT NULL COMMENT '库存',
  `sid` int(11) NOT NULL COMMENT '商品ID',
  `gg_ke` float(8,3) NOT NULL DEFAULT '0.000' COMMENT '规格重量',
  `gg_bh` varchar(255) NOT NULL COMMENT '规格编号',
  `gg_retail` decimal(11,2) NOT NULL COMMENT '零售价',
  `gg_trade` decimal(11,2) NOT NULL COMMENT '规格批发价',
  `vip_money` decimal(11,2) NOT NULL COMMENT '会员结算价',
  `fx_one` decimal(11,2) NOT NULL COMMENT '一级分销佣金',
  `fx_two` decimal(11,2) NOT NULL COMMENT '二级分销佣金',
  `gg_pingtuan` decimal(11,2) NOT NULL COMMENT '拼团价',
  `gg_danjia` decimal(11,2) NOT NULL COMMENT '单购价',
  `gg_jiesuan` decimal(11,2) NOT NULL COMMENT '结算价',
  `gg_title` varchar(50) NOT NULL COMMENT '规格标题',
  PRIMARY KEY (`gg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COMMENT='商品规格表';

");

if(!pdo_fieldexists('hyb_yl_goodsguige','gg_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsguige')." ADD 
  `gg_id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_goodsguige','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsguige')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_goodsguige','gg_name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsguige')." ADD   `gg_name` varchar(255) NOT NULL COMMENT '规格标题'");}
if(!pdo_fieldexists('hyb_yl_goodsguige','gg_thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsguige')." ADD   `gg_thumb` varchar(255) NOT NULL COMMENT '缩略图'");}
if(!pdo_fieldexists('hyb_yl_goodsguige','gg_money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsguige')." ADD   `gg_money` float(8,2) NOT NULL COMMENT '金额'");}
if(!pdo_fieldexists('hyb_yl_goodsguige','gg_text')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsguige')." ADD   `gg_text` varchar(255) NOT NULL COMMENT '规格描述'");}
if(!pdo_fieldexists('hyb_yl_goodsguige','gg_kucun')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsguige')." ADD   `gg_kucun` int(11) NOT NULL COMMENT '库存'");}
if(!pdo_fieldexists('hyb_yl_goodsguige','sid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsguige')." ADD   `sid` int(11) NOT NULL COMMENT '商品ID'");}
if(!pdo_fieldexists('hyb_yl_goodsguige','gg_ke')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsguige')." ADD   `gg_ke` float(8,3) NOT NULL DEFAULT '0.000' COMMENT '规格重量'");}
if(!pdo_fieldexists('hyb_yl_goodsguige','gg_bh')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsguige')." ADD   `gg_bh` varchar(255) NOT NULL COMMENT '规格编号'");}
if(!pdo_fieldexists('hyb_yl_goodsguige','gg_retail')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsguige')." ADD   `gg_retail` decimal(11,2) NOT NULL COMMENT '零售价'");}
if(!pdo_fieldexists('hyb_yl_goodsguige','gg_trade')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsguige')." ADD   `gg_trade` decimal(11,2) NOT NULL COMMENT '规格批发价'");}
if(!pdo_fieldexists('hyb_yl_goodsguige','vip_money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsguige')." ADD   `vip_money` decimal(11,2) NOT NULL COMMENT '会员结算价'");}
if(!pdo_fieldexists('hyb_yl_goodsguige','fx_one')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsguige')." ADD   `fx_one` decimal(11,2) NOT NULL COMMENT '一级分销佣金'");}
if(!pdo_fieldexists('hyb_yl_goodsguige','fx_two')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsguige')." ADD   `fx_two` decimal(11,2) NOT NULL COMMENT '二级分销佣金'");}
if(!pdo_fieldexists('hyb_yl_goodsguige','gg_pingtuan')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsguige')." ADD   `gg_pingtuan` decimal(11,2) NOT NULL COMMENT '拼团价'");}
if(!pdo_fieldexists('hyb_yl_goodsguige','gg_danjia')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsguige')." ADD   `gg_danjia` decimal(11,2) NOT NULL COMMENT '单购价'");}
if(!pdo_fieldexists('hyb_yl_goodsguige','gg_jiesuan')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsguige')." ADD   `gg_jiesuan` decimal(11,2) NOT NULL COMMENT '结算价'");}
if(!pdo_fieldexists('hyb_yl_goodsguige','gg_title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsguige')." ADD   `gg_title` varchar(50) NOT NULL COMMENT '规格标题'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_goodsorders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `u_id` int(11) NOT NULL COMMENT '用户ID',
  `sid` text NOT NULL COMMENT '商品',
  `createTime` datetime NOT NULL COMMENT '下单时间',
  `gg_id` int(11) NOT NULL COMMENT '规格id',
  `orderStatus` tinyint(11) NOT NULL DEFAULT '-2' COMMENT '-3:用户拒收 -2:未付款的订单 -1：用户取消 0:待发货 1:配送中 2:用户确认收货',
  `orderNo` varchar(255) NOT NULL COMMENT '订单号',
  `deliverMoney` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '运费',
  `totalMoney` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '订单总金额	包括运费',
  `realTotalMoney` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '实际订单总金额	进行各种折扣之后的金额',
  `isPay` tinyint(11) NOT NULL DEFAULT '0' COMMENT '0未支付1已支付',
  `isRefund` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否退款0:否 1：是',
  `isAppraise` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0:未点评 1:已点评',
  `orderunique` varchar(50) NOT NULL COMMENT '快递号',
  `receiveTime` datetime NOT NULL COMMENT '收货时间',
  `deliveryTime` datetime NOT NULL COMMENT '发货时间',
  `expressNo` varchar(50) NOT NULL COMMENT '订单流水号',
  `feight` decimal(11,3) NOT NULL COMMENT '重量',
  `num` int(11) NOT NULL COMMENT '商品数量',
  `addressId` int(11) NOT NULL COMMENT '收货地址ID',
  `openid` varchar(255) NOT NULL COMMENT '用户openid',
  `paytime` datetime NOT NULL COMMENT '支付时间',
  `ifCf` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0非处方1处方',
  `conets` text NOT NULL COMMENT '处方',
  `ifshop` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0商城购买开方1医生和用户开方',
  `overtime` int(11) NOT NULL COMMENT '订单结束时间',
  `key_words` varchar(50) NOT NULL COMMENT '关键词',
  `j_id` int(11) NOT NULL DEFAULT '0' COMMENT '家人id',
  `cid` int(11) NOT NULL DEFAULT '0' COMMENT '0用户自己申请的处方',
  `zid` int(11) NOT NULL DEFAULT '0' COMMENT '专家id',
  `xufang` tinyint(2) NOT NULL DEFAULT '0' COMMENT '非续方1续方',
  `cfimg` varchar(255) NOT NULL COMMENT '处方照片',
  `wzimg` varchar(255) NOT NULL COMMENT '完整处方带公章',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '处方状态（0：待审核；1：审核通过；2：审核拒绝）',
  `y_id` int(11) NOT NULL COMMENT '药师id',
  `sh_time` int(11) NOT NULL COMMENT '审核时间',
  `back_orders` varchar(255) NOT NULL COMMENT '问诊订单',
  `ptmoney` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '平台抽成',
  `ysmoney` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '药师抽成',
  `docmoney` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '专家抽成',
  `hid` int(11) NOT NULL COMMENT '药房id',
  `vip_dk` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '会员卡抵扣金额',
  `mode` tinyint(3) NOT NULL,
  `erweima` varchar(255) NOT NULL,
  `goodstype` tinyint(2) NOT NULL DEFAULT '0' COMMENT '1医生开方，0自己购买 ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8 COMMENT='商品订单表';

");

if(!pdo_fieldexists('hyb_yl_goodsorders','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_goodsorders','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_goodsorders','u_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `u_id` int(11) NOT NULL COMMENT '用户ID'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','sid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `sid` text NOT NULL COMMENT '商品'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','createTime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `createTime` datetime NOT NULL COMMENT '下单时间'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','gg_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `gg_id` int(11) NOT NULL COMMENT '规格id'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','orderStatus')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `orderStatus` tinyint(11) NOT NULL DEFAULT '-2' COMMENT '-3:用户拒收 -2:未付款的订单 -1：用户取消 0:待发货 1:配送中 2:用户确认收货'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','orderNo')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `orderNo` varchar(255) NOT NULL COMMENT '订单号'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','deliverMoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `deliverMoney` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '运费'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','totalMoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `totalMoney` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '订单总金额	包括运费'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','realTotalMoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `realTotalMoney` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '实际订单总金额	进行各种折扣之后的金额'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','isPay')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `isPay` tinyint(11) NOT NULL DEFAULT '0' COMMENT '0未支付1已支付'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','isRefund')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `isRefund` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否退款0:否 1：是'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','isAppraise')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `isAppraise` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0:未点评 1:已点评'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','orderunique')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `orderunique` varchar(50) NOT NULL COMMENT '快递号'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','receiveTime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `receiveTime` datetime NOT NULL COMMENT '收货时间'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','deliveryTime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `deliveryTime` datetime NOT NULL COMMENT '发货时间'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','expressNo')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `expressNo` varchar(50) NOT NULL COMMENT '订单流水号'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','feight')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `feight` decimal(11,3) NOT NULL COMMENT '重量'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','num')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `num` int(11) NOT NULL COMMENT '商品数量'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','addressId')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `addressId` int(11) NOT NULL COMMENT '收货地址ID'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `openid` varchar(255) NOT NULL COMMENT '用户openid'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','paytime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `paytime` datetime NOT NULL COMMENT '支付时间'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','ifCf')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `ifCf` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0非处方1处方'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','conets')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `conets` text NOT NULL COMMENT '处方'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','ifshop')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `ifshop` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0商城购买开方1医生和用户开方'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','overtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `overtime` int(11) NOT NULL COMMENT '订单结束时间'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','key_words')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `key_words` varchar(50) NOT NULL COMMENT '关键词'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','j_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `j_id` int(11) NOT NULL DEFAULT '0' COMMENT '家人id'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','cid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `cid` int(11) NOT NULL DEFAULT '0' COMMENT '0用户自己申请的处方'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `zid` int(11) NOT NULL DEFAULT '0' COMMENT '专家id'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','xufang')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `xufang` tinyint(2) NOT NULL DEFAULT '0' COMMENT '非续方1续方'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','cfimg')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `cfimg` varchar(255) NOT NULL COMMENT '处方照片'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','wzimg')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `wzimg` varchar(255) NOT NULL COMMENT '完整处方带公章'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '处方状态（0：待审核；1：审核通过；2：审核拒绝）'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','y_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `y_id` int(11) NOT NULL COMMENT '药师id'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','sh_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `sh_time` int(11) NOT NULL COMMENT '审核时间'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','back_orders')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `back_orders` varchar(255) NOT NULL COMMENT '问诊订单'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','ptmoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `ptmoney` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '平台抽成'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','ysmoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `ysmoney` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '药师抽成'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','docmoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `docmoney` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '专家抽成'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','hid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `hid` int(11) NOT NULL COMMENT '药房id'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','vip_dk')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `vip_dk` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '会员卡抵扣金额'");}
if(!pdo_fieldexists('hyb_yl_goodsorders','mode')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `mode` tinyint(3) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_goodsorders','erweima')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `erweima` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_goodsorders','goodstype')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_goodsorders')." ADD   `goodstype` tinyint(2) NOT NULL DEFAULT '0' COMMENT '1医生开方，0自己购买 '");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_guahao_time` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `server_time` text NOT NULL COMMENT '服务时间',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：隐藏；1：显示）',
  `created` int(11) NOT NULL COMMENT '添加时间',
  `title` varchar(255) NOT NULL COMMENT '挂号班次标题',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='挂号排版表';

");

if(!pdo_fieldexists('hyb_yl_guahao_time','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahao_time')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_guahao_time','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahao_time')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_guahao_time','server_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahao_time')." ADD   `server_time` text NOT NULL COMMENT '服务时间'");}
if(!pdo_fieldexists('hyb_yl_guahao_time','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahao_time')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：隐藏；1：显示）'");}
if(!pdo_fieldexists('hyb_yl_guahao_time','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahao_time')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_guahao_time','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahao_time')." ADD   `title` varchar(255) NOT NULL COMMENT '挂号班次标题'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_guahaoorder` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `zid` int(11) NOT NULL COMMENT '专家id',
  `openid` varchar(255) NOT NULL COMMENT '用户标识',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：未支付；1：待接诊；2：已到诊；3：已结束；4：已取消；5：已失约；6：申请退款）',
  `ifpay` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0待支付1已支付待接诊2接诊中3已完成待评价4已评价5申请退款6退款成功7订单关闭8已取消',
  `paytime` int(11) NOT NULL COMMENT '支付时间',
  `p_type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '支付方式（0：微信支付；1：余额支付）',
  `ordersn` varchar(255) NOT NULL COMMENT '订单号',
  `time` int(11) NOT NULL COMMENT '下单时间',
  `money` decimal(11,2) NOT NULL COMMENT '挂号费',
  `yy_time` int(11) NOT NULL COMMENT '预约时间',
  `describe` text NOT NULL COMMENT '内容描述',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '1一级2二级',
  `jz_time` int(11) NOT NULL COMMENT '就诊时间',
  `qx_time` int(11) NOT NULL COMMENT '取消时间',
  `orders` varchar(255) NOT NULL COMMENT '订单号',
  `back_orser` varchar(255) NOT NULL COMMENT '统一订单号',
  `source` tinyint(2) NOT NULL COMMENT '挂号来源',
  `apply_time` int(11) DEFAULT NULL COMMENT '退款申请时间',
  `refund_time` int(11) DEFAULT NULL COMMENT '退款时间',
  `overtime` int(11) DEFAULT NULL COMMENT '定单结束时间',
  `j_id` int(11) DEFAULT NULL COMMENT '家人id',
  `tell` varchar(12) DEFAULT NULL COMMENT '用户电话',
  `week` varchar(50) DEFAULT NULL COMMENT '预约星期',
  `year` varchar(50) DEFAULT NULL COMMENT '预约时间',
  `privateNum` varchar(50) DEFAULT NULL COMMENT '专家隐私电话',
  `month_time` varchar(255) DEFAULT NULL COMMENT '月份',
  `startime` int(5) DEFAULT NULL COMMENT '开始时间',
  `endtime` int(5) DEFAULT NULL COMMENT '结束时间',
  `userId2` varchar(50) DEFAULT NULL,
  `userSig2` varchar(50) DEFAULT NULL,
  `roomID` varchar(50) DEFAULT NULL,
  `sdkAppID` varchar(50) DEFAULT NULL,
  `userID` varchar(50) DEFAULT NULL,
  `userSig` varchar(50) DEFAULT NULL,
  `addnum` int(11) unsigned NOT NULL COMMENT '添加数量',
  `old_money` decimal(11,2) DEFAULT NULL COMMENT '订单原价',
  `coupon_id` int(11) DEFAULT NULL COMMENT '优惠券id',
  `coupon_dk` decimal(11,2) DEFAULT NULL COMMENT '优惠券抵扣',
  `role` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0用户1医生',
  `ifgb` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0开启1关闭',
  `mp3` varchar(255) NOT NULL,
  `thtime` varchar(255) NOT NULL,
  `biaoqian` varchar(255) NOT NULL COMMENT '标签',
  `ptmoney` decimal(11,2) NOT NULL COMMENT '平台抽成',
  `card_dk` decimal(11,2) NOT NULL COMMENT '会员卡抵扣',
  `hosmoney` decimal(11,2) NOT NULL COMMENT '机构抽成',
  `docmoney` decimal(11,2) NOT NULL COMMENT '专家抽成',
  `tk_one` decimal(11,2) NOT NULL COMMENT '推客一级抽成',
  `tk_two` decimal(11,2) NOT NULL COMMENT '推客二级抽成',
  `is_admin` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否后台代挂号（0：否；1：是）',
  `yy_type` int(11) NOT NULL COMMENT '预约类型',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='挂号订单表';

");

if(!pdo_fieldexists('hyb_yl_guahaoorder','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `zid` int(11) NOT NULL COMMENT '专家id'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `openid` varchar(255) NOT NULL COMMENT '用户标识'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：未支付；1：待接诊；2：已到诊；3：已结束；4：已取消；5：已失约；6：申请退款）'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','ifpay')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `ifpay` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0待支付1已支付待接诊2接诊中3已完成待评价4已评价5申请退款6退款成功7订单关闭8已取消'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','paytime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `paytime` int(11) NOT NULL COMMENT '支付时间'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','p_type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `p_type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '支付方式（0：微信支付；1：余额支付）'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','ordersn')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `ordersn` varchar(255) NOT NULL COMMENT '订单号'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `time` int(11) NOT NULL COMMENT '下单时间'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `money` decimal(11,2) NOT NULL COMMENT '挂号费'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','yy_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `yy_time` int(11) NOT NULL COMMENT '预约时间'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','describe')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `describe` text NOT NULL COMMENT '内容描述'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `type` int(11) NOT NULL DEFAULT '1' COMMENT '1一级2二级'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','jz_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `jz_time` int(11) NOT NULL COMMENT '就诊时间'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','qx_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `qx_time` int(11) NOT NULL COMMENT '取消时间'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','orders')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `orders` varchar(255) NOT NULL COMMENT '订单号'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','back_orser')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `back_orser` varchar(255) NOT NULL COMMENT '统一订单号'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','source')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `source` tinyint(2) NOT NULL COMMENT '挂号来源'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','apply_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `apply_time` int(11) DEFAULT NULL COMMENT '退款申请时间'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','refund_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `refund_time` int(11) DEFAULT NULL COMMENT '退款时间'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','overtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `overtime` int(11) DEFAULT NULL COMMENT '定单结束时间'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','j_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `j_id` int(11) DEFAULT NULL COMMENT '家人id'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','tell')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `tell` varchar(12) DEFAULT NULL COMMENT '用户电话'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','week')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `week` varchar(50) DEFAULT NULL COMMENT '预约星期'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','year')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `year` varchar(50) DEFAULT NULL COMMENT '预约时间'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','privateNum')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `privateNum` varchar(50) DEFAULT NULL COMMENT '专家隐私电话'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','month_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `month_time` varchar(255) DEFAULT NULL COMMENT '月份'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','startime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `startime` int(5) DEFAULT NULL COMMENT '开始时间'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','endtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `endtime` int(5) DEFAULT NULL COMMENT '结束时间'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','userId2')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `userId2` varchar(50) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','userSig2')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `userSig2` varchar(50) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','roomID')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `roomID` varchar(50) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','sdkAppID')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `sdkAppID` varchar(50) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','userID')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `userID` varchar(50) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','userSig')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `userSig` varchar(50) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','addnum')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `addnum` int(11) unsigned NOT NULL COMMENT '添加数量'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','old_money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `old_money` decimal(11,2) DEFAULT NULL COMMENT '订单原价'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','coupon_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `coupon_id` int(11) DEFAULT NULL COMMENT '优惠券id'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','coupon_dk')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `coupon_dk` decimal(11,2) DEFAULT NULL COMMENT '优惠券抵扣'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','role')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `role` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0用户1医生'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','ifgb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `ifgb` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0开启1关闭'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','mp3')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `mp3` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','thtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `thtime` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','biaoqian')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `biaoqian` varchar(255) NOT NULL COMMENT '标签'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','ptmoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `ptmoney` decimal(11,2) NOT NULL COMMENT '平台抽成'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','card_dk')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `card_dk` decimal(11,2) NOT NULL COMMENT '会员卡抵扣'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','hosmoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `hosmoney` decimal(11,2) NOT NULL COMMENT '机构抽成'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','docmoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `docmoney` decimal(11,2) NOT NULL COMMENT '专家抽成'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','tk_one')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `tk_one` decimal(11,2) NOT NULL COMMENT '推客一级抽成'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','tk_two')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `tk_two` decimal(11,2) NOT NULL COMMENT '推客二级抽成'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','is_admin')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `is_admin` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否后台代挂号（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_guahaoorder','yy_type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guahaoorder')." ADD   `yy_type` int(11) NOT NULL COMMENT '预约类型'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_guatime` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `z_pid` int(11) DEFAULT NULL COMMENT '科室ID',
  `shengyunus` varchar(255) DEFAULT NULL COMMENT '剩余数量',
  `m_money` varchar(255) DEFAULT NULL COMMENT '价格',
  `nums` varchar(255) DEFAULT NULL COMMENT '数量',
  `zid` int(11) DEFAULT NULL COMMENT '医生ID',
  `time` varchar(255) DEFAULT NULL,
  `text` longtext NOT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_guatime','tid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guatime')." ADD 
  `tid` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_guatime','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guatime')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_guatime','z_pid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guatime')." ADD   `z_pid` int(11) DEFAULT NULL COMMENT '科室ID'");}
if(!pdo_fieldexists('hyb_yl_guatime','shengyunus')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guatime')." ADD   `shengyunus` varchar(255) DEFAULT NULL COMMENT '剩余数量'");}
if(!pdo_fieldexists('hyb_yl_guatime','m_money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guatime')." ADD   `m_money` varchar(255) DEFAULT NULL COMMENT '价格'");}
if(!pdo_fieldexists('hyb_yl_guatime','nums')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guatime')." ADD   `nums` varchar(255) DEFAULT NULL COMMENT '数量'");}
if(!pdo_fieldexists('hyb_yl_guatime','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guatime')." ADD   `zid` int(11) DEFAULT NULL COMMENT '医生ID'");}
if(!pdo_fieldexists('hyb_yl_guatime','time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guatime')." ADD   `time` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_guatime','text')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guatime')." ADD   `text` longtext NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_guidance` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `openid` varchar(255) DEFAULT NULL COMMENT '用户标识',
  `title` varchar(50) DEFAULT NULL COMMENT '标题',
  `sort` int(11) DEFAULT NULL COMMENT 'p排序',
  `score` int(11) DEFAULT NULL COMMENT '评分',
  `lng` varchar(50) DEFAULT NULL,
  `lat` varchar(50) DEFAULT NULL,
  `sex` tinyint(2) DEFAULT '3' COMMENT 'x性别（0：女；1：男；3：保密）',
  `idcard` varchar(255) DEFAULT NULL COMMENT '身份证号',
  `thumb` varchar(255) DEFAULT NULL COMMENT '照片',
  `telphone` varchar(50) DEFAULT NULL COMMENT 'l联系电话',
  `zhicheng` varchar(255) DEFAULT NULL COMMENT 'z职称',
  `address` varchar(255) DEFAULT NULL COMMENT 'd地址',
  `room` int(11) DEFAULT NULL COMMENT 'y一级科室id',
  `parentid` int(11) DEFAULT NULL COMMENT '二级科室id',
  `authority` varchar(255) DEFAULT NULL COMMENT '擅长',
  `username` varchar(255) DEFAULT NULL COMMENT '账号',
  `password` varchar(255) DEFAULT NULL COMMENT '密码',
  `groupid` varchar(50) DEFAULT NULL COMMENT '所属组别',
  `gzstype` tinyint(2) DEFAULT NULL COMMENT '工作状态（0休息1工作中）',
  `qx_id` int(11) DEFAULT NULL COMMENT '所属机构权限id',
  `hid` int(11) DEFAULT NULL COMMENT '机构id',
  `listshow` tinyint(2) DEFAULT '0' COMMENT '0显示1不显示在列表中',
  `exa` tinyint(2) DEFAULT '1' COMMENT '状态（1入驻中2暂停中）',
  `endtime` varchar(255) DEFAULT NULL COMMENT '到期时间',
  `sfzimgurl1back` varchar(255) DEFAULT NULL COMMENT '身份证正面照',
  `sfzimgurl2back` varchar(255) DEFAULT NULL COMMENT '身份证反面照',
  `xn_reoly` int(11) DEFAULT NULL COMMENT '虚拟回答数',
  `xn_cf` int(11) DEFAULT NULL COMMENT '虚拟处方',
  `xytime` int(11) DEFAULT NULL COMMENT '虚拟响应时间',
  `gzimgurl1back` varchar(255) DEFAULT NULL COMMENT '工作照',
  `content` varchar(255) DEFAULT NULL COMMENT '内容',
  `opentime` varchar(255) DEFAULT NULL COMMENT '注册时间',
  `privateNum` varchar(50) DEFAULT NULL COMMENT '绑定的手机号',
  `erweima` varchar(255) DEFAULT NULL COMMENT '导诊二维码',
  `share_erweima` varchar(255) DEFAULT NULL COMMENT '分享二维码',
  `is_examine` tinyint(2) DEFAULT '0' COMMENT '是否为陪诊人员（0：否；1：是）',
  `is_urgent` tinyint(2) DEFAULT '0' COMMENT '是否支持加急（0：否；1：是）',
  `money` decimal(11,2) NOT NULL COMMENT '余额',
  `server` varchar(255) DEFAULT NULL COMMENT '支持服务',
  `cut` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '导诊订单抽成',
  `jobtime` int(11) NOT NULL COMMENT '导诊排班',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='导诊员列表';

");

if(!pdo_fieldexists('hyb_yl_guidance','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_guidance','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_guidance','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `openid` varchar(255) DEFAULT NULL COMMENT '用户标识'");}
if(!pdo_fieldexists('hyb_yl_guidance','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `title` varchar(50) DEFAULT NULL COMMENT '标题'");}
if(!pdo_fieldexists('hyb_yl_guidance','sort')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `sort` int(11) DEFAULT NULL COMMENT 'p排序'");}
if(!pdo_fieldexists('hyb_yl_guidance','score')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `score` int(11) DEFAULT NULL COMMENT '评分'");}
if(!pdo_fieldexists('hyb_yl_guidance','lng')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `lng` varchar(50) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_guidance','lat')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `lat` varchar(50) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_guidance','sex')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `sex` tinyint(2) DEFAULT '3' COMMENT 'x性别（0：女；1：男；3：保密）'");}
if(!pdo_fieldexists('hyb_yl_guidance','idcard')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `idcard` varchar(255) DEFAULT NULL COMMENT '身份证号'");}
if(!pdo_fieldexists('hyb_yl_guidance','thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `thumb` varchar(255) DEFAULT NULL COMMENT '照片'");}
if(!pdo_fieldexists('hyb_yl_guidance','telphone')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `telphone` varchar(50) DEFAULT NULL COMMENT 'l联系电话'");}
if(!pdo_fieldexists('hyb_yl_guidance','zhicheng')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `zhicheng` varchar(255) DEFAULT NULL COMMENT 'z职称'");}
if(!pdo_fieldexists('hyb_yl_guidance','address')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `address` varchar(255) DEFAULT NULL COMMENT 'd地址'");}
if(!pdo_fieldexists('hyb_yl_guidance','room')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `room` int(11) DEFAULT NULL COMMENT 'y一级科室id'");}
if(!pdo_fieldexists('hyb_yl_guidance','parentid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `parentid` int(11) DEFAULT NULL COMMENT '二级科室id'");}
if(!pdo_fieldexists('hyb_yl_guidance','authority')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `authority` varchar(255) DEFAULT NULL COMMENT '擅长'");}
if(!pdo_fieldexists('hyb_yl_guidance','username')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `username` varchar(255) DEFAULT NULL COMMENT '账号'");}
if(!pdo_fieldexists('hyb_yl_guidance','password')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `password` varchar(255) DEFAULT NULL COMMENT '密码'");}
if(!pdo_fieldexists('hyb_yl_guidance','groupid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `groupid` varchar(50) DEFAULT NULL COMMENT '所属组别'");}
if(!pdo_fieldexists('hyb_yl_guidance','gzstype')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `gzstype` tinyint(2) DEFAULT NULL COMMENT '工作状态（0休息1工作中）'");}
if(!pdo_fieldexists('hyb_yl_guidance','qx_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `qx_id` int(11) DEFAULT NULL COMMENT '所属机构权限id'");}
if(!pdo_fieldexists('hyb_yl_guidance','hid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `hid` int(11) DEFAULT NULL COMMENT '机构id'");}
if(!pdo_fieldexists('hyb_yl_guidance','listshow')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `listshow` tinyint(2) DEFAULT '0' COMMENT '0显示1不显示在列表中'");}
if(!pdo_fieldexists('hyb_yl_guidance','exa')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `exa` tinyint(2) DEFAULT '1' COMMENT '状态（1入驻中2暂停中）'");}
if(!pdo_fieldexists('hyb_yl_guidance','endtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `endtime` varchar(255) DEFAULT NULL COMMENT '到期时间'");}
if(!pdo_fieldexists('hyb_yl_guidance','sfzimgurl1back')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `sfzimgurl1back` varchar(255) DEFAULT NULL COMMENT '身份证正面照'");}
if(!pdo_fieldexists('hyb_yl_guidance','sfzimgurl2back')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `sfzimgurl2back` varchar(255) DEFAULT NULL COMMENT '身份证反面照'");}
if(!pdo_fieldexists('hyb_yl_guidance','xn_reoly')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `xn_reoly` int(11) DEFAULT NULL COMMENT '虚拟回答数'");}
if(!pdo_fieldexists('hyb_yl_guidance','xn_cf')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `xn_cf` int(11) DEFAULT NULL COMMENT '虚拟处方'");}
if(!pdo_fieldexists('hyb_yl_guidance','xytime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `xytime` int(11) DEFAULT NULL COMMENT '虚拟响应时间'");}
if(!pdo_fieldexists('hyb_yl_guidance','gzimgurl1back')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `gzimgurl1back` varchar(255) DEFAULT NULL COMMENT '工作照'");}
if(!pdo_fieldexists('hyb_yl_guidance','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `content` varchar(255) DEFAULT NULL COMMENT '内容'");}
if(!pdo_fieldexists('hyb_yl_guidance','opentime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `opentime` varchar(255) DEFAULT NULL COMMENT '注册时间'");}
if(!pdo_fieldexists('hyb_yl_guidance','privateNum')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `privateNum` varchar(50) DEFAULT NULL COMMENT '绑定的手机号'");}
if(!pdo_fieldexists('hyb_yl_guidance','erweima')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `erweima` varchar(255) DEFAULT NULL COMMENT '导诊二维码'");}
if(!pdo_fieldexists('hyb_yl_guidance','share_erweima')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `share_erweima` varchar(255) DEFAULT NULL COMMENT '分享二维码'");}
if(!pdo_fieldexists('hyb_yl_guidance','is_examine')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `is_examine` tinyint(2) DEFAULT '0' COMMENT '是否为陪诊人员（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_guidance','is_urgent')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `is_urgent` tinyint(2) DEFAULT '0' COMMENT '是否支持加急（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_guidance','money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `money` decimal(11,2) NOT NULL COMMENT '余额'");}
if(!pdo_fieldexists('hyb_yl_guidance','server')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `server` varchar(255) DEFAULT NULL COMMENT '支持服务'");}
if(!pdo_fieldexists('hyb_yl_guidance','cut')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `cut` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '导诊订单抽成'");}
if(!pdo_fieldexists('hyb_yl_guidance','jobtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance')." ADD   `jobtime` int(11) NOT NULL COMMENT '导诊排班'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_guidance_message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL COMMENT '订单id',
  `back_orser` varchar(255) DEFAULT NULL COMMENT '订单号',
  `content` text COMMENT '内容',
  `created` int(11) DEFAULT NULL COMMENT '添加时间',
  `role` tinyint(2) DEFAULT '0' COMMENT '角色（0：用户；1：专家）',
  `openid` varchar(255) DEFAULT NULL,
  `z_id` int(11) DEFAULT NULL COMMENT '专家id',
  `did` int(11) DEFAULT NULL COMMENT '导诊员id',
  `state` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：未回复；1：已回复）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_guidance_message','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_message')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_guidance_message','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_message')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_guidance_message','order_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_message')." ADD   `order_id` int(11) DEFAULT NULL COMMENT '订单id'");}
if(!pdo_fieldexists('hyb_yl_guidance_message','back_orser')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_message')." ADD   `back_orser` varchar(255) DEFAULT NULL COMMENT '订单号'");}
if(!pdo_fieldexists('hyb_yl_guidance_message','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_message')." ADD   `content` text COMMENT '内容'");}
if(!pdo_fieldexists('hyb_yl_guidance_message','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_message')." ADD   `created` int(11) DEFAULT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_guidance_message','role')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_message')." ADD   `role` tinyint(2) DEFAULT '0' COMMENT '角色（0：用户；1：专家）'");}
if(!pdo_fieldexists('hyb_yl_guidance_message','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_message')." ADD   `openid` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_guidance_message','z_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_message')." ADD   `z_id` int(11) DEFAULT NULL COMMENT '专家id'");}
if(!pdo_fieldexists('hyb_yl_guidance_message','did')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_message')." ADD   `did` int(11) DEFAULT NULL COMMENT '导诊员id'");}
if(!pdo_fieldexists('hyb_yl_guidance_message','state')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_message')." ADD   `state` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：未回复；1：已回复）'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_guidance_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(255) DEFAULT NULL COMMENT '下单用户',
  `did` int(11) NOT NULL COMMENT '导诊员id',
  `j_id` int(11) NOT NULL COMMENT '患者id',
  `orders` varchar(100) DEFAULT NULL COMMENT '订单号',
  `content` text COMMENT '内容',
  `money` decimal(11,2) DEFAULT NULL COMMENT '订单金额',
  `back_orser` varchar(100) DEFAULT NULL COMMENT '订单号',
  `paytime` int(11) DEFAULT NULL COMMENT '支付时间',
  `created` int(11) DEFAULT NULL COMMENT '下单时间',
  `overtime` int(11) DEFAULT NULL COMMENT '订单结束时间',
  `biaoqian` varchar(255) DEFAULT NULL COMMENT '所选标签',
  `ifpay` tinyint(2) DEFAULT '0' COMMENT '0待支付1已支付待接诊2已接诊3已完成待评价4已评价5申请退款6退款成功7订单关闭8已取消',
  `typeid` int(11) DEFAULT NULL COMMENT '类型id',
  `z_id` int(11) NOT NULL COMMENT '专家id',
  `key_words` varchar(255) DEFAULT NULL COMMENT '关键字',
  `hid` int(11) DEFAULT NULL COMMENT '医院id',
  `keshi_two` int(11) DEFAULT NULL COMMENT '二级科室id',
  `time` varchar(50) DEFAULT NULL COMMENT '预约时间',
  `fuwus` text COMMENT '服务',
  `apply_time` int(11) DEFAULT NULL COMMENT '退款申请时间',
  `refund_time` int(11) DEFAULT NULL COMMENT '退款时间',
  `cancel_time` int(11) DEFAULT NULL COMMENT '取消时间',
  `accept_time` int(11) DEFAULT NULL COMMENT '接诊时间',
  `tk_one` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '一级推客抽成',
  `tk_two` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '二级推客抽成',
  `ptmoney` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '平台抽成',
  `hosmoney` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '机构抽成',
  `card_dk` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '优惠券抵扣',
  `vip_dk` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '会员抵扣',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='导诊订单表';

");

if(!pdo_fieldexists('hyb_yl_guidance_order','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_order')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_guidance_order','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_order')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_guidance_order','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_order')." ADD   `openid` varchar(255) DEFAULT NULL COMMENT '下单用户'");}
if(!pdo_fieldexists('hyb_yl_guidance_order','did')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_order')." ADD   `did` int(11) NOT NULL COMMENT '导诊员id'");}
if(!pdo_fieldexists('hyb_yl_guidance_order','j_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_order')." ADD   `j_id` int(11) NOT NULL COMMENT '患者id'");}
if(!pdo_fieldexists('hyb_yl_guidance_order','orders')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_order')." ADD   `orders` varchar(100) DEFAULT NULL COMMENT '订单号'");}
if(!pdo_fieldexists('hyb_yl_guidance_order','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_order')." ADD   `content` text COMMENT '内容'");}
if(!pdo_fieldexists('hyb_yl_guidance_order','money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_order')." ADD   `money` decimal(11,2) DEFAULT NULL COMMENT '订单金额'");}
if(!pdo_fieldexists('hyb_yl_guidance_order','back_orser')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_order')." ADD   `back_orser` varchar(100) DEFAULT NULL COMMENT '订单号'");}
if(!pdo_fieldexists('hyb_yl_guidance_order','paytime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_order')." ADD   `paytime` int(11) DEFAULT NULL COMMENT '支付时间'");}
if(!pdo_fieldexists('hyb_yl_guidance_order','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_order')." ADD   `created` int(11) DEFAULT NULL COMMENT '下单时间'");}
if(!pdo_fieldexists('hyb_yl_guidance_order','overtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_order')." ADD   `overtime` int(11) DEFAULT NULL COMMENT '订单结束时间'");}
if(!pdo_fieldexists('hyb_yl_guidance_order','biaoqian')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_order')." ADD   `biaoqian` varchar(255) DEFAULT NULL COMMENT '所选标签'");}
if(!pdo_fieldexists('hyb_yl_guidance_order','ifpay')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_order')." ADD   `ifpay` tinyint(2) DEFAULT '0' COMMENT '0待支付1已支付待接诊2已接诊3已完成待评价4已评价5申请退款6退款成功7订单关闭8已取消'");}
if(!pdo_fieldexists('hyb_yl_guidance_order','typeid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_order')." ADD   `typeid` int(11) DEFAULT NULL COMMENT '类型id'");}
if(!pdo_fieldexists('hyb_yl_guidance_order','z_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_order')." ADD   `z_id` int(11) NOT NULL COMMENT '专家id'");}
if(!pdo_fieldexists('hyb_yl_guidance_order','key_words')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_order')." ADD   `key_words` varchar(255) DEFAULT NULL COMMENT '关键字'");}
if(!pdo_fieldexists('hyb_yl_guidance_order','hid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_order')." ADD   `hid` int(11) DEFAULT NULL COMMENT '医院id'");}
if(!pdo_fieldexists('hyb_yl_guidance_order','keshi_two')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_order')." ADD   `keshi_two` int(11) DEFAULT NULL COMMENT '二级科室id'");}
if(!pdo_fieldexists('hyb_yl_guidance_order','time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_order')." ADD   `time` varchar(50) DEFAULT NULL COMMENT '预约时间'");}
if(!pdo_fieldexists('hyb_yl_guidance_order','fuwus')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_order')." ADD   `fuwus` text COMMENT '服务'");}
if(!pdo_fieldexists('hyb_yl_guidance_order','apply_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_order')." ADD   `apply_time` int(11) DEFAULT NULL COMMENT '退款申请时间'");}
if(!pdo_fieldexists('hyb_yl_guidance_order','refund_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_order')." ADD   `refund_time` int(11) DEFAULT NULL COMMENT '退款时间'");}
if(!pdo_fieldexists('hyb_yl_guidance_order','cancel_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_order')." ADD   `cancel_time` int(11) DEFAULT NULL COMMENT '取消时间'");}
if(!pdo_fieldexists('hyb_yl_guidance_order','accept_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_order')." ADD   `accept_time` int(11) DEFAULT NULL COMMENT '接诊时间'");}
if(!pdo_fieldexists('hyb_yl_guidance_order','tk_one')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_order')." ADD   `tk_one` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '一级推客抽成'");}
if(!pdo_fieldexists('hyb_yl_guidance_order','tk_two')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_order')." ADD   `tk_two` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '二级推客抽成'");}
if(!pdo_fieldexists('hyb_yl_guidance_order','ptmoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_order')." ADD   `ptmoney` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '平台抽成'");}
if(!pdo_fieldexists('hyb_yl_guidance_order','hosmoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_order')." ADD   `hosmoney` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '机构抽成'");}
if(!pdo_fieldexists('hyb_yl_guidance_order','card_dk')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_order')." ADD   `card_dk` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '优惠券抵扣'");}
if(!pdo_fieldexists('hyb_yl_guidance_order','vip_dk')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_guidance_order')." ADD   `vip_dk` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '会员抵扣'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_hjfenl` (
  `hj_id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `hj_name` varchar(255) NOT NULL DEFAULT '' COMMENT '名称',
  `hj_color` varchar(255) NOT NULL COMMENT '颜色',
  `sord` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `pid` int(11) NOT NULL COMMENT '上级分类',
  `thumb` varchar(255) NOT NULL COMMENT '图片',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态（0：关闭；1：开启）',
  `created` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`hj_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='患教分类表';

");

if(!pdo_fieldexists('hyb_yl_hjfenl','hj_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hjfenl')." ADD 
  `hj_id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_hjfenl','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hjfenl')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_hjfenl','hj_name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hjfenl')." ADD   `hj_name` varchar(255) NOT NULL DEFAULT '' COMMENT '名称'");}
if(!pdo_fieldexists('hyb_yl_hjfenl','hj_color')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hjfenl')." ADD   `hj_color` varchar(255) NOT NULL COMMENT '颜色'");}
if(!pdo_fieldexists('hyb_yl_hjfenl','sord')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hjfenl')." ADD   `sord` int(11) NOT NULL DEFAULT '0' COMMENT '排序'");}
if(!pdo_fieldexists('hyb_yl_hjfenl','pid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hjfenl')." ADD   `pid` int(11) NOT NULL COMMENT '上级分类'");}
if(!pdo_fieldexists('hyb_yl_hjfenl','thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hjfenl')." ADD   `thumb` varchar(255) NOT NULL COMMENT '图片'");}
if(!pdo_fieldexists('hyb_yl_hjfenl','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hjfenl')." ADD   `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态（0：关闭；1：开启）'");}
if(!pdo_fieldexists('hyb_yl_hjfenl','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hjfenl')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_hjiaosite` (
  `h_id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `h_title` varchar(255) NOT NULL COMMENT '患教标题',
  `h_pic` varchar(255) NOT NULL COMMENT '患教所路途',
  `h_video` varchar(255) NOT NULL COMMENT '患教视频',
  `h_type` int(11) NOT NULL DEFAULT '1' COMMENT '1平台0专家',
  `h_text` text NOT NULL COMMENT '患教内容',
  `h_dianzan` int(11) unsigned NOT NULL COMMENT '患教点赞数',
  `h_read` int(11) unsigned NOT NULL COMMENT '阅读数',
  `h_zhuanfa` int(11) unsigned NOT NULL COMMENT '转发数',
  `h_tuijian` int(11) NOT NULL DEFAULT '0' COMMENT '1热门',
  `h_flid` int(11) NOT NULL COMMENT '分类id',
  `sfbtime` int(11) NOT NULL,
  `h_leixing` tinyint(5) NOT NULL COMMENT '0音频1视频2文章',
  `zid` int(11) NOT NULL DEFAULT '0' COMMENT '专家id',
  `h_shen` int(11) NOT NULL DEFAULT '1' COMMENT '1通过0未通过；2：待审核；3：已删除',
  `z_name` varchar(255) NOT NULL COMMENT '专家名称',
  `audios` varchar(255) NOT NULL COMMENT '视频连接',
  `uid` int(11) NOT NULL COMMENT 'y用户id',
  `created` int(11) NOT NULL COMMENT '添加时间',
  `h_keyword` text NOT NULL COMMENT '关键字',
  `sort` int(11) NOT NULL COMMENT '排序',
  `h_thumb` tinytext NOT NULL COMMENT '患教图集',
  PRIMARY KEY (`h_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='患教表';

");

if(!pdo_fieldexists('hyb_yl_hjiaosite','h_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hjiaosite')." ADD 
  `h_id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_hjiaosite','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hjiaosite')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_hjiaosite','h_title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hjiaosite')." ADD   `h_title` varchar(255) NOT NULL COMMENT '患教标题'");}
if(!pdo_fieldexists('hyb_yl_hjiaosite','h_pic')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hjiaosite')." ADD   `h_pic` varchar(255) NOT NULL COMMENT '患教所路途'");}
if(!pdo_fieldexists('hyb_yl_hjiaosite','h_video')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hjiaosite')." ADD   `h_video` varchar(255) NOT NULL COMMENT '患教视频'");}
if(!pdo_fieldexists('hyb_yl_hjiaosite','h_type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hjiaosite')." ADD   `h_type` int(11) NOT NULL DEFAULT '1' COMMENT '1平台0专家'");}
if(!pdo_fieldexists('hyb_yl_hjiaosite','h_text')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hjiaosite')." ADD   `h_text` text NOT NULL COMMENT '患教内容'");}
if(!pdo_fieldexists('hyb_yl_hjiaosite','h_dianzan')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hjiaosite')." ADD   `h_dianzan` int(11) unsigned NOT NULL COMMENT '患教点赞数'");}
if(!pdo_fieldexists('hyb_yl_hjiaosite','h_read')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hjiaosite')." ADD   `h_read` int(11) unsigned NOT NULL COMMENT '阅读数'");}
if(!pdo_fieldexists('hyb_yl_hjiaosite','h_zhuanfa')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hjiaosite')." ADD   `h_zhuanfa` int(11) unsigned NOT NULL COMMENT '转发数'");}
if(!pdo_fieldexists('hyb_yl_hjiaosite','h_tuijian')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hjiaosite')." ADD   `h_tuijian` int(11) NOT NULL DEFAULT '0' COMMENT '1热门'");}
if(!pdo_fieldexists('hyb_yl_hjiaosite','h_flid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hjiaosite')." ADD   `h_flid` int(11) NOT NULL COMMENT '分类id'");}
if(!pdo_fieldexists('hyb_yl_hjiaosite','sfbtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hjiaosite')." ADD   `sfbtime` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_hjiaosite','h_leixing')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hjiaosite')." ADD   `h_leixing` tinyint(5) NOT NULL COMMENT '0音频1视频2文章'");}
if(!pdo_fieldexists('hyb_yl_hjiaosite','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hjiaosite')." ADD   `zid` int(11) NOT NULL DEFAULT '0' COMMENT '专家id'");}
if(!pdo_fieldexists('hyb_yl_hjiaosite','h_shen')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hjiaosite')." ADD   `h_shen` int(11) NOT NULL DEFAULT '1' COMMENT '1通过0未通过；2：待审核；3：已删除'");}
if(!pdo_fieldexists('hyb_yl_hjiaosite','z_name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hjiaosite')." ADD   `z_name` varchar(255) NOT NULL COMMENT '专家名称'");}
if(!pdo_fieldexists('hyb_yl_hjiaosite','audios')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hjiaosite')." ADD   `audios` varchar(255) NOT NULL COMMENT '视频连接'");}
if(!pdo_fieldexists('hyb_yl_hjiaosite','uid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hjiaosite')." ADD   `uid` int(11) NOT NULL COMMENT 'y用户id'");}
if(!pdo_fieldexists('hyb_yl_hjiaosite','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hjiaosite')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_hjiaosite','h_keyword')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hjiaosite')." ADD   `h_keyword` text NOT NULL COMMENT '关键字'");}
if(!pdo_fieldexists('hyb_yl_hjiaosite','sort')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hjiaosite')." ADD   `sort` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('hyb_yl_hjiaosite','h_thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hjiaosite')." ADD   `h_thumb` tinytext NOT NULL COMMENT '患教图集'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_hospital` (
  `hid` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `agentname` varchar(255) NOT NULL COMMENT '机构名称',
  `logo` varchar(255) NOT NULL COMMENT '医院logo',
  `hospitaltel` varchar(50) NOT NULL COMMENT '医院电话',
  `workshift` varchar(50) NOT NULL COMMENT '工作时间',
  `address` varchar(255) NOT NULL COMMENT '医院地址',
  `xxaddress` varchar(255) DEFAULT NULL COMMENT '详细地址',
  `logintime` int(11) NOT NULL COMMENT '登陆时间',
  `longitude` varchar(255) NOT NULL COMMENT '经度',
  `latitude` varchar(255) NOT NULL COMMENT '纬度',
  `loginip` varchar(255) NOT NULL COMMENT '登录ip',
  `grade` int(11) NOT NULL DEFAULT '0' COMMENT '医院等级',
  `lntroduction` text NOT NULL COMMENT '医院介绍',
  `pid` int(11) NOT NULL COMMENT '当前账户的父类id',
  `shanchang` varchar(255) NOT NULL COMMENT '擅长',
  `strot` tinyint(11) NOT NULL,
  `hos_tuijian` int(2) NOT NULL DEFAULT '0' COMMENT '是否启用',
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL COMMENT '医院账号',
  `endtime` varchar(50) NOT NULL COMMENT '到期时间',
  `zctime` int(11) NOT NULL COMMENT '注册时间',
  `backpassword` varchar(255) NOT NULL COMMENT '密码',
  `openid` varchar(255) NOT NULL COMMENT '管理员openid',
  `province` int(11) NOT NULL COMMENT '城市一级',
  `city` int(11) unsigned zerofill NOT NULL COMMENT '所在市',
  `district` int(11) NOT NULL COMMENT '所在区',
  `system_royalty` varchar(50) NOT NULL COMMENT '提现手续费',
  `groupid` int(11) NOT NULL COMMENT '所属分组权限组',
  `state` tinyint(2) NOT NULL DEFAULT '0' COMMENT '1已入住0：待审核(原入住中）；2暂停中3已到期4垃圾箱5已拒绝',
  `districtslevel` tinyint(11) NOT NULL COMMENT '城市级别',
  `nickname` varchar(50) NOT NULL COMMENT '负责人名字',
  `realname` varchar(50) NOT NULL COMMENT '真实姓名',
  `money` decimal(11,2) NOT NULL COMMENT '余额',
  `created` int(11) NOT NULL COMMENT '添加时间',
  `type_da` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0管理机构1注册机构',
  `uid` int(11) NOT NULL COMMENT '注册会员id',
  `is_index` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否推荐（0：否；1：是）',
  `bank_num` varchar(100) NOT NULL COMMENT '银行卡号',
  `bank_user` varchar(100) NOT NULL COMMENT '开户名',
  `bank_name` varchar(255) NOT NULL COMMENT '开户行',
  `cut` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '订单抽成设置',
  `erweima` varchar(255) NOT NULL COMMENT '二维码',
  `zfb_name` varchar(100) NOT NULL COMMENT '支付宝姓名',
  `zfb_zhanghao` varchar(100) NOT NULL COMMENT '支付号账号',
  `gh_number` int(11) NOT NULL COMMENT '挂号提醒数',
  `wz_number` int(11) NOT NULL COMMENT '问诊提醒数',
  `order_number` int(11) NOT NULL COMMENT '订单提醒数',
  `tkid` int(11) NOT NULL COMMENT '推客id',
  `USER` varchar(255) NOT NULL COMMENT '飞鹅云后台注册账号',
  `UKEY` varchar(255) NOT NULL COMMENT '飞鹅云后台注册账号后生成的UKEY',
  `SN` varchar(255) NOT NULL COMMENT '打印机编号',
  `box_sn` varchar(255) NOT NULL COMMENT '云收款音箱SN码',
  `box_token` varchar(255) NOT NULL COMMENT '开发商分配token',
  `box_version` int(11) NOT NULL DEFAULT '1' COMMENT '云收款音箱版本号',
  `box_uid` varchar(255) NOT NULL COMMENT '云音响绑定用户id',
  PRIMARY KEY (`hid`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COMMENT='机构表';

");

if(!pdo_fieldexists('hyb_yl_hospital','hid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD 
  `hid` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_hospital','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_hospital','agentname')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `agentname` varchar(255) NOT NULL COMMENT '机构名称'");}
if(!pdo_fieldexists('hyb_yl_hospital','logo')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `logo` varchar(255) NOT NULL COMMENT '医院logo'");}
if(!pdo_fieldexists('hyb_yl_hospital','hospitaltel')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `hospitaltel` varchar(50) NOT NULL COMMENT '医院电话'");}
if(!pdo_fieldexists('hyb_yl_hospital','workshift')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `workshift` varchar(50) NOT NULL COMMENT '工作时间'");}
if(!pdo_fieldexists('hyb_yl_hospital','address')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `address` varchar(255) NOT NULL COMMENT '医院地址'");}
if(!pdo_fieldexists('hyb_yl_hospital','xxaddress')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `xxaddress` varchar(255) DEFAULT NULL COMMENT '详细地址'");}
if(!pdo_fieldexists('hyb_yl_hospital','logintime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `logintime` int(11) NOT NULL COMMENT '登陆时间'");}
if(!pdo_fieldexists('hyb_yl_hospital','longitude')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `longitude` varchar(255) NOT NULL COMMENT '经度'");}
if(!pdo_fieldexists('hyb_yl_hospital','latitude')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `latitude` varchar(255) NOT NULL COMMENT '纬度'");}
if(!pdo_fieldexists('hyb_yl_hospital','loginip')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `loginip` varchar(255) NOT NULL COMMENT '登录ip'");}
if(!pdo_fieldexists('hyb_yl_hospital','grade')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `grade` int(11) NOT NULL DEFAULT '0' COMMENT '医院等级'");}
if(!pdo_fieldexists('hyb_yl_hospital','lntroduction')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `lntroduction` text NOT NULL COMMENT '医院介绍'");}
if(!pdo_fieldexists('hyb_yl_hospital','pid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `pid` int(11) NOT NULL COMMENT '当前账户的父类id'");}
if(!pdo_fieldexists('hyb_yl_hospital','shanchang')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `shanchang` varchar(255) NOT NULL COMMENT '擅长'");}
if(!pdo_fieldexists('hyb_yl_hospital','strot')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `strot` tinyint(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_hospital','hos_tuijian')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `hos_tuijian` int(2) NOT NULL DEFAULT '0' COMMENT '是否启用'");}
if(!pdo_fieldexists('hyb_yl_hospital','password')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `password` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_hospital','username')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `username` varchar(255) NOT NULL COMMENT '医院账号'");}
if(!pdo_fieldexists('hyb_yl_hospital','endtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `endtime` varchar(50) NOT NULL COMMENT '到期时间'");}
if(!pdo_fieldexists('hyb_yl_hospital','zctime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `zctime` int(11) NOT NULL COMMENT '注册时间'");}
if(!pdo_fieldexists('hyb_yl_hospital','backpassword')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `backpassword` varchar(255) NOT NULL COMMENT '密码'");}
if(!pdo_fieldexists('hyb_yl_hospital','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `openid` varchar(255) NOT NULL COMMENT '管理员openid'");}
if(!pdo_fieldexists('hyb_yl_hospital','province')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `province` int(11) NOT NULL COMMENT '城市一级'");}
if(!pdo_fieldexists('hyb_yl_hospital','city')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `city` int(11) unsigned zerofill NOT NULL COMMENT '所在市'");}
if(!pdo_fieldexists('hyb_yl_hospital','district')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `district` int(11) NOT NULL COMMENT '所在区'");}
if(!pdo_fieldexists('hyb_yl_hospital','system_royalty')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `system_royalty` varchar(50) NOT NULL COMMENT '提现手续费'");}
if(!pdo_fieldexists('hyb_yl_hospital','groupid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `groupid` int(11) NOT NULL COMMENT '所属分组权限组'");}
if(!pdo_fieldexists('hyb_yl_hospital','state')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `state` tinyint(2) NOT NULL DEFAULT '0' COMMENT '1已入住0：待审核(原入住中）；2暂停中3已到期4垃圾箱5已拒绝'");}
if(!pdo_fieldexists('hyb_yl_hospital','districtslevel')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `districtslevel` tinyint(11) NOT NULL COMMENT '城市级别'");}
if(!pdo_fieldexists('hyb_yl_hospital','nickname')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `nickname` varchar(50) NOT NULL COMMENT '负责人名字'");}
if(!pdo_fieldexists('hyb_yl_hospital','realname')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `realname` varchar(50) NOT NULL COMMENT '真实姓名'");}
if(!pdo_fieldexists('hyb_yl_hospital','money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `money` decimal(11,2) NOT NULL COMMENT '余额'");}
if(!pdo_fieldexists('hyb_yl_hospital','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_hospital','type_da')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `type_da` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0管理机构1注册机构'");}
if(!pdo_fieldexists('hyb_yl_hospital','uid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `uid` int(11) NOT NULL COMMENT '注册会员id'");}
if(!pdo_fieldexists('hyb_yl_hospital','is_index')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `is_index` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否推荐（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_hospital','bank_num')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `bank_num` varchar(100) NOT NULL COMMENT '银行卡号'");}
if(!pdo_fieldexists('hyb_yl_hospital','bank_user')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `bank_user` varchar(100) NOT NULL COMMENT '开户名'");}
if(!pdo_fieldexists('hyb_yl_hospital','bank_name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `bank_name` varchar(255) NOT NULL COMMENT '开户行'");}
if(!pdo_fieldexists('hyb_yl_hospital','cut')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `cut` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '订单抽成设置'");}
if(!pdo_fieldexists('hyb_yl_hospital','erweima')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `erweima` varchar(255) NOT NULL COMMENT '二维码'");}
if(!pdo_fieldexists('hyb_yl_hospital','zfb_name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `zfb_name` varchar(100) NOT NULL COMMENT '支付宝姓名'");}
if(!pdo_fieldexists('hyb_yl_hospital','zfb_zhanghao')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `zfb_zhanghao` varchar(100) NOT NULL COMMENT '支付号账号'");}
if(!pdo_fieldexists('hyb_yl_hospital','gh_number')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `gh_number` int(11) NOT NULL COMMENT '挂号提醒数'");}
if(!pdo_fieldexists('hyb_yl_hospital','wz_number')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `wz_number` int(11) NOT NULL COMMENT '问诊提醒数'");}
if(!pdo_fieldexists('hyb_yl_hospital','order_number')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `order_number` int(11) NOT NULL COMMENT '订单提醒数'");}
if(!pdo_fieldexists('hyb_yl_hospital','tkid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `tkid` int(11) NOT NULL COMMENT '推客id'");}
if(!pdo_fieldexists('hyb_yl_hospital','USER')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `USER` varchar(255) NOT NULL COMMENT '飞鹅云后台注册账号'");}
if(!pdo_fieldexists('hyb_yl_hospital','UKEY')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `UKEY` varchar(255) NOT NULL COMMENT '飞鹅云后台注册账号后生成的UKEY'");}
if(!pdo_fieldexists('hyb_yl_hospital','SN')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `SN` varchar(255) NOT NULL COMMENT '打印机编号'");}
if(!pdo_fieldexists('hyb_yl_hospital','box_sn')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `box_sn` varchar(255) NOT NULL COMMENT '云收款音箱SN码'");}
if(!pdo_fieldexists('hyb_yl_hospital','box_token')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `box_token` varchar(255) NOT NULL COMMENT '开发商分配token'");}
if(!pdo_fieldexists('hyb_yl_hospital','box_version')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `box_version` int(11) NOT NULL DEFAULT '1' COMMENT '云收款音箱版本号'");}
if(!pdo_fieldexists('hyb_yl_hospital','box_uid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital')." ADD   `box_uid` varchar(255) NOT NULL COMMENT '云音响绑定用户id'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_hospital_bank` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL COMMENT '持卡人姓名',
  `number` varchar(100) DEFAULT NULL COMMENT '银行卡号',
  `address` varchar(255) DEFAULT NULL COMMENT '开户行所在地',
  `created` int(11) NOT NULL COMMENT '添加时间',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否默认（0：否；1：是）',
  `hid` int(11) DEFAULT NULL COMMENT '机构id',
  `bank_name` varchar(100) DEFAULT NULL COMMENT '开户行',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('hyb_yl_hospital_bank','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_bank')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_hospital_bank','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_bank')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_hospital_bank','name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_bank')." ADD   `name` varchar(100) NOT NULL COMMENT '持卡人姓名'");}
if(!pdo_fieldexists('hyb_yl_hospital_bank','number')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_bank')." ADD   `number` varchar(100) DEFAULT NULL COMMENT '银行卡号'");}
if(!pdo_fieldexists('hyb_yl_hospital_bank','address')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_bank')." ADD   `address` varchar(255) DEFAULT NULL COMMENT '开户行所在地'");}
if(!pdo_fieldexists('hyb_yl_hospital_bank','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_bank')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_hospital_bank','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_bank')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否默认（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_hospital_bank','hid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_bank')." ADD   `hid` int(11) DEFAULT NULL COMMENT '机构id'");}
if(!pdo_fieldexists('hyb_yl_hospital_bank','bank_name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_bank')." ADD   `bank_name` varchar(100) DEFAULT NULL COMMENT '开户行'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_hospital_diction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT '权限名称',
  `plug_in` varchar(255) NOT NULL COMMENT '菜单',
  `default` tinyint(11) NOT NULL DEFAULT '1' COMMENT '1默认0勾选',
  `state` tinyint(11) NOT NULL DEFAULT '1' COMMENT '1开启0关闭',
  `grouparr` varchar(255) NOT NULL COMMENT '分组',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='机构分组表';

");

if(!pdo_fieldexists('hyb_yl_hospital_diction','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_diction')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_hospital_diction','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_diction')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_hospital_diction','name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_diction')." ADD   `name` varchar(255) NOT NULL COMMENT '权限名称'");}
if(!pdo_fieldexists('hyb_yl_hospital_diction','plug_in')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_diction')." ADD   `plug_in` varchar(255) NOT NULL COMMENT '菜单'");}
if(!pdo_fieldexists('hyb_yl_hospital_diction','default')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_diction')." ADD   `default` tinyint(11) NOT NULL DEFAULT '1' COMMENT '1默认0勾选'");}
if(!pdo_fieldexists('hyb_yl_hospital_diction','state')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_diction')." ADD   `state` tinyint(11) NOT NULL DEFAULT '1' COMMENT '1开启0关闭'");}
if(!pdo_fieldexists('hyb_yl_hospital_diction','grouparr')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_diction')." ADD   `grouparr` varchar(255) NOT NULL COMMENT '分组'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_hospital_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `level_name` varchar(255) NOT NULL COMMENT '级别名称',
  `level_strot` int(11) NOT NULL COMMENT '级别排序',
  `level_type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1开启0关闭',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='机构级别表';

");

if(!pdo_fieldexists('hyb_yl_hospital_level','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_level')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_hospital_level','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_level')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_hospital_level','level_name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_level')." ADD   `level_name` varchar(255) NOT NULL COMMENT '级别名称'");}
if(!pdo_fieldexists('hyb_yl_hospital_level','level_strot')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_level')." ADD   `level_strot` int(11) NOT NULL COMMENT '级别排序'");}
if(!pdo_fieldexists('hyb_yl_hospital_level','level_type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_level')." ADD   `level_type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1开启0关闭'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_hospital_profit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `profit` decimal(10,2) NOT NULL COMMENT '总金额',
  `state` smallint(11) NOT NULL DEFAULT '0' COMMENT '1收入2支出3冻结',
  `pid` int(11) NOT NULL COMMENT '医院id',
  `type` varchar(255) NOT NULL COMMENT '收益类型(包括图文问诊，电话问诊，视频问诊等问诊服务）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_hospital_profit','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_profit')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_hospital_profit','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_profit')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_hospital_profit','profit')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_profit')." ADD   `profit` decimal(10,2) NOT NULL COMMENT '总金额'");}
if(!pdo_fieldexists('hyb_yl_hospital_profit','state')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_profit')." ADD   `state` smallint(11) NOT NULL DEFAULT '0' COMMENT '1收入2支出3冻结'");}
if(!pdo_fieldexists('hyb_yl_hospital_profit','pid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_profit')." ADD   `pid` int(11) NOT NULL COMMENT '医院id'");}
if(!pdo_fieldexists('hyb_yl_hospital_profit','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_profit')." ADD   `type` varchar(255) NOT NULL COMMENT '收益类型(包括图文问诊，电话问诊，视频问诊等问诊服务）'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_hospital_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL COMMENT '标题',
  `role` text COMMENT '权限',
  `created` int(11) DEFAULT NULL COMMENT '添加时间',
  `keyword` varchar(50) DEFAULT NULL COMMENT '关键字',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COMMENT='机构分组权限表';

");

if(!pdo_fieldexists('hyb_yl_hospital_role','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_role')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_hospital_role','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_role')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_hospital_role','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_role')." ADD   `title` varchar(50) DEFAULT NULL COMMENT '标题'");}
if(!pdo_fieldexists('hyb_yl_hospital_role','role')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_role')." ADD   `role` text COMMENT '权限'");}
if(!pdo_fieldexists('hyb_yl_hospital_role','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_role')." ADD   `created` int(11) DEFAULT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_hospital_role','keyword')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_role')." ADD   `keyword` varchar(50) DEFAULT NULL COMMENT '关键字'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_hospital_zfb` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `hid` int(11) NOT NULL COMMENT '机构id',
  `name` varchar(255) DEFAULT NULL COMMENT '支付号姓名',
  `number` varchar(255) DEFAULT NULL COMMENT '支付宝账号',
  `created` int(11) DEFAULT NULL COMMENT '添加时间',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否默认（0：否；1：是）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('hyb_yl_hospital_zfb','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_zfb')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_hospital_zfb','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_zfb')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_hospital_zfb','hid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_zfb')." ADD   `hid` int(11) NOT NULL COMMENT '机构id'");}
if(!pdo_fieldexists('hyb_yl_hospital_zfb','name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_zfb')." ADD   `name` varchar(255) DEFAULT NULL COMMENT '支付号姓名'");}
if(!pdo_fieldexists('hyb_yl_hospital_zfb','number')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_zfb')." ADD   `number` varchar(255) DEFAULT NULL COMMENT '支付宝账号'");}
if(!pdo_fieldexists('hyb_yl_hospital_zfb','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_zfb')." ADD   `created` int(11) DEFAULT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_hospital_zfb','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospital_zfb')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否默认（0：否；1：是）'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_hospitaljobtime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `server_time` text NOT NULL COMMENT '服务时间',
  `nums` int(11) NOT NULL COMMENT '数量',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `state` tinyint(11) NOT NULL COMMENT '状态（0：关闭；1：开启）',
  `hid` int(11) NOT NULL COMMENT '机构ID',
  `type` varchar(50) NOT NULL COMMENT '上午下午',
  `week` varchar(255) NOT NULL COMMENT '星期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='机构工作时间表';

");

if(!pdo_fieldexists('hyb_yl_hospitaljobtime','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospitaljobtime')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_hospitaljobtime','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospitaljobtime')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_hospitaljobtime','server_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospitaljobtime')." ADD   `server_time` text NOT NULL COMMENT '服务时间'");}
if(!pdo_fieldexists('hyb_yl_hospitaljobtime','nums')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospitaljobtime')." ADD   `nums` int(11) NOT NULL COMMENT '数量'");}
if(!pdo_fieldexists('hyb_yl_hospitaljobtime','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospitaljobtime')." ADD   `title` varchar(255) NOT NULL COMMENT '标题'");}
if(!pdo_fieldexists('hyb_yl_hospitaljobtime','state')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospitaljobtime')." ADD   `state` tinyint(11) NOT NULL COMMENT '状态（0：关闭；1：开启）'");}
if(!pdo_fieldexists('hyb_yl_hospitaljobtime','hid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospitaljobtime')." ADD   `hid` int(11) NOT NULL COMMENT '机构ID'");}
if(!pdo_fieldexists('hyb_yl_hospitaljobtime','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospitaljobtime')." ADD   `type` varchar(50) NOT NULL COMMENT '上午下午'");}
if(!pdo_fieldexists('hyb_yl_hospitaljobtime','week')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_hospitaljobtime')." ADD   `week` varchar(255) NOT NULL COMMENT '星期'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_integral_set` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `evaluate_score` int(11) DEFAULT NULL COMMENT '评价送分',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：关闭；1：开启）',
  `proportion` varchar(20) DEFAULT NULL COMMENT '比例',
  `created` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='评论设置表';

");

if(!pdo_fieldexists('hyb_yl_integral_set','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_integral_set')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_integral_set','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_integral_set')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_integral_set','evaluate_score')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_integral_set')." ADD   `evaluate_score` int(11) DEFAULT NULL COMMENT '评价送分'");}
if(!pdo_fieldexists('hyb_yl_integral_set','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_integral_set')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：关闭；1：开启）'");}
if(!pdo_fieldexists('hyb_yl_integral_set','proportion')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_integral_set')." ADD   `proportion` varchar(20) DEFAULT NULL COMMENT '比例'");}
if(!pdo_fieldexists('hyb_yl_integral_set','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_integral_set')." ADD   `created` int(11) DEFAULT NULL COMMENT '添加时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_intelyuzhen` (
  `i_id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `start` text NOT NULL COMMENT '开始区间',
  `last` text NOT NULL COMMENT '结束',
  `suggest` text NOT NULL COMMENT '建议',
  `yp` text NOT NULL COMMENT '药瓶',
  `ys` text NOT NULL COMMENT '医生',
  `pid` int(11) NOT NULL COMMENT '二级',
  `spec` text NOT NULL,
  `ypname` varchar(255) NOT NULL,
  `ysname` varchar(255) NOT NULL,
  PRIMARY KEY (`i_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_intelyuzhen','i_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_intelyuzhen')." ADD 
  `i_id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_intelyuzhen','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_intelyuzhen')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_intelyuzhen','start')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_intelyuzhen')." ADD   `start` text NOT NULL COMMENT '开始区间'");}
if(!pdo_fieldexists('hyb_yl_intelyuzhen','last')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_intelyuzhen')." ADD   `last` text NOT NULL COMMENT '结束'");}
if(!pdo_fieldexists('hyb_yl_intelyuzhen','suggest')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_intelyuzhen')." ADD   `suggest` text NOT NULL COMMENT '建议'");}
if(!pdo_fieldexists('hyb_yl_intelyuzhen','yp')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_intelyuzhen')." ADD   `yp` text NOT NULL COMMENT '药瓶'");}
if(!pdo_fieldexists('hyb_yl_intelyuzhen','ys')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_intelyuzhen')." ADD   `ys` text NOT NULL COMMENT '医生'");}
if(!pdo_fieldexists('hyb_yl_intelyuzhen','pid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_intelyuzhen')." ADD   `pid` int(11) NOT NULL COMMENT '二级'");}
if(!pdo_fieldexists('hyb_yl_intelyuzhen','spec')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_intelyuzhen')." ADD   `spec` text NOT NULL");}
if(!pdo_fieldexists('hyb_yl_intelyuzhen','ypname')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_intelyuzhen')." ADD   `ypname` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_intelyuzhen','ysname')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_intelyuzhen')." ADD   `ysname` varchar(255) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_jfenl` (
  `fl_id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `j_name` varchar(255) NOT NULL COMMENT '分类名称',
  `j_thumb` varchar(255) NOT NULL COMMENT '分类图标',
  `cont_thumb` varchar(255) NOT NULL COMMENT '分类内容图片',
  `cont_title` varchar(255) NOT NULL COMMENT '分类内容标题',
  `cont` longtext NOT NULL COMMENT '分类内容',
  PRIMARY KEY (`fl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_jfenl','fl_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jfenl')." ADD 
  `fl_id` int(10) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_jfenl','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jfenl')." ADD   `uniacid` int(10) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_jfenl','j_name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jfenl')." ADD   `j_name` varchar(255) NOT NULL COMMENT '分类名称'");}
if(!pdo_fieldexists('hyb_yl_jfenl','j_thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jfenl')." ADD   `j_thumb` varchar(255) NOT NULL COMMENT '分类图标'");}
if(!pdo_fieldexists('hyb_yl_jfenl','cont_thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jfenl')." ADD   `cont_thumb` varchar(255) NOT NULL COMMENT '分类内容图片'");}
if(!pdo_fieldexists('hyb_yl_jfenl','cont_title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jfenl')." ADD   `cont_title` varchar(255) NOT NULL COMMENT '分类内容标题'");}
if(!pdo_fieldexists('hyb_yl_jfenl','cont')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jfenl')." ADD   `cont` longtext NOT NULL COMMENT '分类内容'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_jiesuan_set` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `min_money` decimal(11,2) NOT NULL COMMENT '最低提现金额',
  `reserve_money` decimal(11,2) NOT NULL COMMENT '专家预留金额',
  `pay_type` text NOT NULL COMMENT '打款方式（0：支付宝；1：微信；2：银行卡）',
  `is_user` tinyint(2) NOT NULL DEFAULT '0' COMMENT '用户余额提现（0：禁用；1：开启）',
  `is_agent` tinyint(2) NOT NULL DEFAULT '0' COMMENT '机构代理提现免审核（0：禁用；1：开启）',
  `is_twitter` tinyint(2) NOT NULL DEFAULT '0' COMMENT '推客提现免审核（0：禁用；1：开启）',
  `expert_fee` int(11) NOT NULL COMMENT '默认专家提现手续费',
  `agent_fee` int(11) NOT NULL COMMENT '默认机构提现手续费',
  `interval_time` int(11) DEFAULT NULL COMMENT '提现间隔时间',
  `user_fee` int(11) DEFAULT NULL COMMENT '用户提现余额手续费比例',
  `lvtong_fee` int(11) DEFAULT NULL COMMENT '绿通结算手续费',
  `is_lvtong` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启绿通提现免审核（0：否；1：是）',
  `lvtong_cash` int(11) NOT NULL COMMENT '绿通提现手续费',
  `is_expert` tinyint(2) NOT NULL DEFAULT '0' COMMENT '专家提现是否开启免审核（0：否；1：是）',
  `content` text COMMENT '提现须知',
  `money` text COMMENT '提现金额设置',
  `weixin_content` text COMMENT '微信提现须知',
  `zfb_content` text COMMENT '支付宝提现须知',
  `bank_content` text COMMENT '银行卡提现须知',
  `nodes` text COMMENT '提现说明',
  `hos_cut` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '机构抽成设置',
  `doc_cut` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '专家订单抽成设置',
  `card_cut` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '年卡订单抽成设置',
  `green_cut` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '绿通订单抽成设置',
  `team_cut` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '团队订单抽成设置',
  `yaoshi_cut` decimal(11,2) NOT NULL COMMENT '药师抽成',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='结算设置';

");

if(!pdo_fieldexists('hyb_yl_jiesuan_set','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jiesuan_set')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_jiesuan_set','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jiesuan_set')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_jiesuan_set','min_money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jiesuan_set')." ADD   `min_money` decimal(11,2) NOT NULL COMMENT '最低提现金额'");}
if(!pdo_fieldexists('hyb_yl_jiesuan_set','reserve_money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jiesuan_set')." ADD   `reserve_money` decimal(11,2) NOT NULL COMMENT '专家预留金额'");}
if(!pdo_fieldexists('hyb_yl_jiesuan_set','pay_type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jiesuan_set')." ADD   `pay_type` text NOT NULL COMMENT '打款方式（0：支付宝；1：微信；2：银行卡）'");}
if(!pdo_fieldexists('hyb_yl_jiesuan_set','is_user')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jiesuan_set')." ADD   `is_user` tinyint(2) NOT NULL DEFAULT '0' COMMENT '用户余额提现（0：禁用；1：开启）'");}
if(!pdo_fieldexists('hyb_yl_jiesuan_set','is_agent')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jiesuan_set')." ADD   `is_agent` tinyint(2) NOT NULL DEFAULT '0' COMMENT '机构代理提现免审核（0：禁用；1：开启）'");}
if(!pdo_fieldexists('hyb_yl_jiesuan_set','is_twitter')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jiesuan_set')." ADD   `is_twitter` tinyint(2) NOT NULL DEFAULT '0' COMMENT '推客提现免审核（0：禁用；1：开启）'");}
if(!pdo_fieldexists('hyb_yl_jiesuan_set','expert_fee')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jiesuan_set')." ADD   `expert_fee` int(11) NOT NULL COMMENT '默认专家提现手续费'");}
if(!pdo_fieldexists('hyb_yl_jiesuan_set','agent_fee')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jiesuan_set')." ADD   `agent_fee` int(11) NOT NULL COMMENT '默认机构提现手续费'");}
if(!pdo_fieldexists('hyb_yl_jiesuan_set','interval_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jiesuan_set')." ADD   `interval_time` int(11) DEFAULT NULL COMMENT '提现间隔时间'");}
if(!pdo_fieldexists('hyb_yl_jiesuan_set','user_fee')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jiesuan_set')." ADD   `user_fee` int(11) DEFAULT NULL COMMENT '用户提现余额手续费比例'");}
if(!pdo_fieldexists('hyb_yl_jiesuan_set','lvtong_fee')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jiesuan_set')." ADD   `lvtong_fee` int(11) DEFAULT NULL COMMENT '绿通结算手续费'");}
if(!pdo_fieldexists('hyb_yl_jiesuan_set','is_lvtong')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jiesuan_set')." ADD   `is_lvtong` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启绿通提现免审核（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_jiesuan_set','lvtong_cash')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jiesuan_set')." ADD   `lvtong_cash` int(11) NOT NULL COMMENT '绿通提现手续费'");}
if(!pdo_fieldexists('hyb_yl_jiesuan_set','is_expert')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jiesuan_set')." ADD   `is_expert` tinyint(2) NOT NULL DEFAULT '0' COMMENT '专家提现是否开启免审核（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_jiesuan_set','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jiesuan_set')." ADD   `content` text COMMENT '提现须知'");}
if(!pdo_fieldexists('hyb_yl_jiesuan_set','money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jiesuan_set')." ADD   `money` text COMMENT '提现金额设置'");}
if(!pdo_fieldexists('hyb_yl_jiesuan_set','weixin_content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jiesuan_set')." ADD   `weixin_content` text COMMENT '微信提现须知'");}
if(!pdo_fieldexists('hyb_yl_jiesuan_set','zfb_content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jiesuan_set')." ADD   `zfb_content` text COMMENT '支付宝提现须知'");}
if(!pdo_fieldexists('hyb_yl_jiesuan_set','bank_content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jiesuan_set')." ADD   `bank_content` text COMMENT '银行卡提现须知'");}
if(!pdo_fieldexists('hyb_yl_jiesuan_set','nodes')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jiesuan_set')." ADD   `nodes` text COMMENT '提现说明'");}
if(!pdo_fieldexists('hyb_yl_jiesuan_set','hos_cut')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jiesuan_set')." ADD   `hos_cut` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '机构抽成设置'");}
if(!pdo_fieldexists('hyb_yl_jiesuan_set','doc_cut')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jiesuan_set')." ADD   `doc_cut` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '专家订单抽成设置'");}
if(!pdo_fieldexists('hyb_yl_jiesuan_set','card_cut')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jiesuan_set')." ADD   `card_cut` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '年卡订单抽成设置'");}
if(!pdo_fieldexists('hyb_yl_jiesuan_set','green_cut')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jiesuan_set')." ADD   `green_cut` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '绿通订单抽成设置'");}
if(!pdo_fieldexists('hyb_yl_jiesuan_set','team_cut')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jiesuan_set')." ADD   `team_cut` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '团队订单抽成设置'");}
if(!pdo_fieldexists('hyb_yl_jiesuan_set','yaoshi_cut')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jiesuan_set')." ADD   `yaoshi_cut` decimal(11,2) NOT NULL COMMENT '药师抽成'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_jigou_goods` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `sname` varchar(255) NOT NULL COMMENT '商品名称',
  `smoney` float(7,2) NOT NULL COMMENT '原价',
  `snum` int(10) unsigned NOT NULL COMMENT '库存',
  `sthumb` varchar(255) NOT NULL COMMENT '首页图片',
  `spic` text NOT NULL COMMENT '商品轮播图',
  `sdescribe` varchar(255) NOT NULL COMMENT '商品描述',
  `scontent` text NOT NULL COMMENT '商品详情',
  `date` varchar(255) NOT NULL COMMENT '入库时间',
  `supplier` varchar(255) NOT NULL COMMENT '供应商',
  `state` int(11) NOT NULL DEFAULT '0' COMMENT '上架',
  `rec` int(11) NOT NULL DEFAULT '0' COMMENT '推荐',
  `g_id` int(11) NOT NULL COMMENT '分类id',
  `gg_type` tinyint(11) NOT NULL DEFAULT '0' COMMENT '是否开启规格1开启0关闭',
  `spxl` int(11) NOT NULL DEFAULT '0',
  `adminqy` tinyint(11) NOT NULL DEFAULT '0' COMMENT '0关闭1开启',
  `yhqy` int(11) NOT NULL DEFAULT '0' COMMENT '优惠权益是否开启',
  `g_kuaidi` float(6,2) NOT NULL COMMENT '快递费用',
  `g_baoyou` tinyint(11) NOT NULL DEFAULT '0' COMMENT '0不包邮1包邮',
  `g_content` text NOT NULL,
  `ifcfy` tinyint(11) NOT NULL DEFAULT '0' COMMENT '0非处方药1处方药',
  `mostgt` int(11) NOT NULL,
  `s_id` int(11) NOT NULL COMMENT '机构id',
  `retail_price` decimal(11,2) NOT NULL COMMENT '零售价',
  `trade_price` decimal(11,2) NOT NULL COMMENT '批发价',
  `company` varchar(20) NOT NULL COMMENT '单位',
  `sort` int(11) NOT NULL COMMENT '排序',
  `is_tui` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否支持退款（0：否；1：是）',
  `jigou_one` int(11) NOT NULL COMMENT '一级机构id',
  `jigou_two` int(11) NOT NULL COMMENT '二级机构id',
  `hy_money` decimal(11,2) NOT NULL COMMENT '会员减免金额',
  `xn_num` int(11) NOT NULL COMMENT '虚拟销量',
  `xg_num` int(11) NOT NULL COMMENT '限购数量',
  `is_dl` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启独立结算规则（0：否；1：是）',
  `js_money` decimal(11,2) NOT NULL COMMENT '结算金额',
  `is_fenxiao` tinyint(2) NOT NULL COMMENT '是否参与分销',
  `fx_one` decimal(11,2) NOT NULL COMMENT '一级分销结算金额',
  `fx_two` decimal(11,2) NOT NULL COMMENT '二级分销结算金额',
  `js_type` tinyint(2) NOT NULL COMMENT '分销佣金结算时间（0：订单完成时结算；1：订单支付是结算）',
  `share_thumb` varchar(255) NOT NULL COMMENT '分享图片',
  `share_title` varchar(255) NOT NULL COMMENT '分享标题',
  `share_detail` varchar(255) NOT NULL COMMENT '分享描述',
  `buy_score` int(11) NOT NULL COMMENT '购买所得积分',
  `one_dikou` decimal(11,2) NOT NULL COMMENT '积分抵扣比例',
  `dikou` decimal(11,2) NOT NULL COMMENT '积分抵扣（单件抵扣）',
  `start` int(11) NOT NULL COMMENT '购买开始时间',
  `end` int(11) NOT NULL COMMENT '购买结束时间',
  `yf_id` int(11) NOT NULL COMMENT '运费模板',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '审核状态（0：待审核；1：审核通过；2：审核拒绝；3：已删除）',
  `guige` varchar(255) NOT NULL COMMENT '规格标题',
  `doc_num` varchar(50) NOT NULL COMMENT '批准文号',
  `pp_title` varchar(255) NOT NULL COMMENT '品牌名称',
  `component` text NOT NULL COMMENT '成分',
  `character` text NOT NULL COMMENT '性状',
  `adapt` text NOT NULL COMMENT '适应症',
  `use` text NOT NULL COMMENT '用法用量',
  `adverse_reactions` text NOT NULL COMMENT '不良反应',
  `com` varchar(255) NOT NULL COMMENT '快递公司编号',
  `kf_money` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '开方服务费',
  `barcode` varchar(255) DEFAULT NULL COMMENT '条形码',
  `code_num` varchar(50) DEFAULT NULL COMMENT '条形码参数',
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='商品表';

");

if(!pdo_fieldexists('hyb_yl_jigou_goods','sid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD 
  `sid` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','sname')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `sname` varchar(255) NOT NULL COMMENT '商品名称'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','smoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `smoney` float(7,2) NOT NULL COMMENT '原价'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','snum')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `snum` int(10) unsigned NOT NULL COMMENT '库存'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','sthumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `sthumb` varchar(255) NOT NULL COMMENT '首页图片'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','spic')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `spic` text NOT NULL COMMENT '商品轮播图'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','sdescribe')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `sdescribe` varchar(255) NOT NULL COMMENT '商品描述'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','scontent')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `scontent` text NOT NULL COMMENT '商品详情'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','date')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `date` varchar(255) NOT NULL COMMENT '入库时间'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','supplier')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `supplier` varchar(255) NOT NULL COMMENT '供应商'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','state')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `state` int(11) NOT NULL DEFAULT '0' COMMENT '上架'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','rec')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `rec` int(11) NOT NULL DEFAULT '0' COMMENT '推荐'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','g_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `g_id` int(11) NOT NULL COMMENT '分类id'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','gg_type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `gg_type` tinyint(11) NOT NULL DEFAULT '0' COMMENT '是否开启规格1开启0关闭'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','spxl')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `spxl` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','adminqy')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `adminqy` tinyint(11) NOT NULL DEFAULT '0' COMMENT '0关闭1开启'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','yhqy')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `yhqy` int(11) NOT NULL DEFAULT '0' COMMENT '优惠权益是否开启'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','g_kuaidi')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `g_kuaidi` float(6,2) NOT NULL COMMENT '快递费用'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','g_baoyou')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `g_baoyou` tinyint(11) NOT NULL DEFAULT '0' COMMENT '0不包邮1包邮'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','g_content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `g_content` text NOT NULL");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','ifcfy')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `ifcfy` tinyint(11) NOT NULL DEFAULT '0' COMMENT '0非处方药1处方药'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','mostgt')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `mostgt` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','s_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `s_id` int(11) NOT NULL COMMENT '机构id'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','retail_price')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `retail_price` decimal(11,2) NOT NULL COMMENT '零售价'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','trade_price')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `trade_price` decimal(11,2) NOT NULL COMMENT '批发价'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','company')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `company` varchar(20) NOT NULL COMMENT '单位'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','sort')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `sort` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','is_tui')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `is_tui` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否支持退款（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','jigou_one')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `jigou_one` int(11) NOT NULL COMMENT '一级机构id'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','jigou_two')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `jigou_two` int(11) NOT NULL COMMENT '二级机构id'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','hy_money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `hy_money` decimal(11,2) NOT NULL COMMENT '会员减免金额'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','xn_num')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `xn_num` int(11) NOT NULL COMMENT '虚拟销量'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','xg_num')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `xg_num` int(11) NOT NULL COMMENT '限购数量'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','is_dl')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `is_dl` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启独立结算规则（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','js_money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `js_money` decimal(11,2) NOT NULL COMMENT '结算金额'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','is_fenxiao')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `is_fenxiao` tinyint(2) NOT NULL COMMENT '是否参与分销'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','fx_one')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `fx_one` decimal(11,2) NOT NULL COMMENT '一级分销结算金额'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','fx_two')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `fx_two` decimal(11,2) NOT NULL COMMENT '二级分销结算金额'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','js_type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `js_type` tinyint(2) NOT NULL COMMENT '分销佣金结算时间（0：订单完成时结算；1：订单支付是结算）'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','share_thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `share_thumb` varchar(255) NOT NULL COMMENT '分享图片'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','share_title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `share_title` varchar(255) NOT NULL COMMENT '分享标题'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','share_detail')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `share_detail` varchar(255) NOT NULL COMMENT '分享描述'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','buy_score')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `buy_score` int(11) NOT NULL COMMENT '购买所得积分'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','one_dikou')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `one_dikou` decimal(11,2) NOT NULL COMMENT '积分抵扣比例'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','dikou')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `dikou` decimal(11,2) NOT NULL COMMENT '积分抵扣（单件抵扣）'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','start')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `start` int(11) NOT NULL COMMENT '购买开始时间'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','end')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `end` int(11) NOT NULL COMMENT '购买结束时间'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','yf_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `yf_id` int(11) NOT NULL COMMENT '运费模板'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '审核状态（0：待审核；1：审核通过；2：审核拒绝；3：已删除）'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','guige')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `guige` varchar(255) NOT NULL COMMENT '规格标题'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','doc_num')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `doc_num` varchar(50) NOT NULL COMMENT '批准文号'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','pp_title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `pp_title` varchar(255) NOT NULL COMMENT '品牌名称'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','component')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `component` text NOT NULL COMMENT '成分'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','character')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `character` text NOT NULL COMMENT '性状'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','adapt')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `adapt` text NOT NULL COMMENT '适应症'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','use')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `use` text NOT NULL COMMENT '用法用量'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','adverse_reactions')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `adverse_reactions` text NOT NULL COMMENT '不良反应'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','com')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `com` varchar(255) NOT NULL COMMENT '快递公司编号'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','kf_money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `kf_money` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '开方服务费'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','barcode')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `barcode` varchar(255) DEFAULT NULL COMMENT '条形码'");}
if(!pdo_fieldexists('hyb_yl_jigou_goods','code_num')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_jigou_goods')." ADD   `code_num` varchar(50) DEFAULT NULL COMMENT '条形码参数'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_kuaidi` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT '快递名称',
  `com` varchar(255) NOT NULL COMMENT '快递公司编码',
  `tel` varchar(255) NOT NULL COMMENT '快递公司电话',
  `sort` int(11) NOT NULL,
  `created` int(11) NOT NULL COMMENT '添加时间',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态（0：隐藏；1：显示）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='快递表';

");

if(!pdo_fieldexists('hyb_yl_kuaidi','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_kuaidi')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_kuaidi','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_kuaidi')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_kuaidi','name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_kuaidi')." ADD   `name` varchar(255) NOT NULL COMMENT '快递名称'");}
if(!pdo_fieldexists('hyb_yl_kuaidi','com')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_kuaidi')." ADD   `com` varchar(255) NOT NULL COMMENT '快递公司编码'");}
if(!pdo_fieldexists('hyb_yl_kuaidi','tel')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_kuaidi')." ADD   `tel` varchar(255) NOT NULL COMMENT '快递公司电话'");}
if(!pdo_fieldexists('hyb_yl_kuaidi','sort')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_kuaidi')." ADD   `sort` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_kuaidi','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_kuaidi')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_kuaidi','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_kuaidi')." ADD   `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态（0：隐藏；1：显示）'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_label_library` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL COMMENT '标题',
  `status` int(10) NOT NULL DEFAULT '0' COMMENT '状态（0：隐藏；1：显示）',
  `sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=848 DEFAULT CHARSET=utf8 COMMENT='标签表';

");

if(!pdo_fieldexists('hyb_yl_label_library','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_label_library')." ADD 
  `id` int(10) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_label_library','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_label_library')." ADD   `uniacid` int(10) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_label_library','name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_label_library')." ADD   `name` varchar(255) DEFAULT NULL COMMENT '标题'");}
if(!pdo_fieldexists('hyb_yl_label_library','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_label_library')." ADD   `status` int(10) NOT NULL DEFAULT '0' COMMENT '状态（0：隐藏；1：显示）'");}
if(!pdo_fieldexists('hyb_yl_label_library','sort')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_label_library')." ADD   `sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_lianmserver` (
  `serid` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `uid` int(11) NOT NULL,
  `pinyin` varchar(255) NOT NULL,
  `subtitle` varchar(50) NOT NULL,
  PRIMARY KEY (`serid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_lianmserver','serid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_lianmserver')." ADD 
  `serid` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_lianmserver','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_lianmserver')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_lianmserver','sid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_lianmserver')." ADD   `sid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_lianmserver','state')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_lianmserver')." ADD   `state` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_lianmserver','thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_lianmserver')." ADD   `thumb` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_lianmserver','desc')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_lianmserver')." ADD   `desc` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_lianmserver','name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_lianmserver')." ADD   `name` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_lianmserver','uid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_lianmserver')." ADD   `uid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_lianmserver','pinyin')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_lianmserver')." ADD   `pinyin` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_lianmserver','subtitle')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_lianmserver')." ADD   `subtitle` varchar(50) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_menu_array` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `footers_menu` text NOT NULL COMMENT '底部导航',
  `server_menu` text NOT NULL COMMENT '服务导航',
  `doc_server` text NOT NULL COMMENT '医生端导航',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='菜单表';

");

if(!pdo_fieldexists('hyb_yl_menu_array','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_menu_array')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_menu_array','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_menu_array')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_menu_array','footers_menu')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_menu_array')." ADD   `footers_menu` text NOT NULL COMMENT '底部导航'");}
if(!pdo_fieldexists('hyb_yl_menu_array','server_menu')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_menu_array')." ADD   `server_menu` text NOT NULL COMMENT '服务导航'");}
if(!pdo_fieldexists('hyb_yl_menu_array','doc_server')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_menu_array')." ADD   `doc_server` text NOT NULL COMMENT '医生端导航'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_menulist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '标题',
  `icon` varchar(255) NOT NULL COMMENT '缩略图',
  `pid` int(11) NOT NULL COMMENT '父类id',
  `hide` tinyint(11) NOT NULL,
  `url` varchar(255) NOT NULL COMMENT '跳转连接',
  `op` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='菜单表';

");

if(!pdo_fieldexists('hyb_yl_menulist','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_menulist')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_menulist','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_menulist')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_menulist','name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_menulist')." ADD   `name` varchar(50) NOT NULL COMMENT '标题'");}
if(!pdo_fieldexists('hyb_yl_menulist','icon')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_menulist')." ADD   `icon` varchar(255) NOT NULL COMMENT '缩略图'");}
if(!pdo_fieldexists('hyb_yl_menulist','pid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_menulist')." ADD   `pid` int(11) NOT NULL COMMENT '父类id'");}
if(!pdo_fieldexists('hyb_yl_menulist','hide')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_menulist')." ADD   `hide` tinyint(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_menulist','url')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_menulist')." ADD   `url` varchar(255) NOT NULL COMMENT '跳转连接'");}
if(!pdo_fieldexists('hyb_yl_menulist','op')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_menulist')." ADD   `op` varchar(255) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_mycenter` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL COMMENT '标题',
  `thumb` varchar(255) DEFAULT NULL COMMENT '图片',
  `pid` int(11) DEFAULT NULL COMMENT '上级id',
  `created` int(11) DEFAULT NULL COMMENT '添加时间',
  `url` varchar(255) DEFAULT NULL COMMENT '连接地址',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态（0：隐藏；1：显示）',
  `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '所在位置（0：个人中心；1：专家中心；2：机构中心）',
  `sort` int(11) DEFAULT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8 COMMENT='个人中心菜单表';

");

if(!pdo_fieldexists('hyb_yl_mycenter','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_mycenter')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_mycenter','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_mycenter')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_mycenter','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_mycenter')." ADD   `title` varchar(255) NOT NULL COMMENT '标题'");}
if(!pdo_fieldexists('hyb_yl_mycenter','thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_mycenter')." ADD   `thumb` varchar(255) DEFAULT NULL COMMENT '图片'");}
if(!pdo_fieldexists('hyb_yl_mycenter','pid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_mycenter')." ADD   `pid` int(11) DEFAULT NULL COMMENT '上级id'");}
if(!pdo_fieldexists('hyb_yl_mycenter','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_mycenter')." ADD   `created` int(11) DEFAULT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_mycenter','url')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_mycenter')." ADD   `url` varchar(255) DEFAULT NULL COMMENT '连接地址'");}
if(!pdo_fieldexists('hyb_yl_mycenter','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_mycenter')." ADD   `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态（0：隐藏；1：显示）'");}
if(!pdo_fieldexists('hyb_yl_mycenter','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_mycenter')." ADD   `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '所在位置（0：个人中心；1：专家中心；2：机构中心）'");}
if(!pdo_fieldexists('hyb_yl_mycenter','sort')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_mycenter')." ADD   `sort` int(11) DEFAULT NULL COMMENT '排序'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_myjoinstudio` (
  `j_id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `zid` int(11) NOT NULL COMMENT '医生id',
  `jointime` int(11) NOT NULL COMMENT '加入时间',
  `roomtype` int(11) NOT NULL DEFAULT '1' COMMENT '团队类型1线上2自由',
  `t_id` int(11) NOT NULL COMMENT '团队Id',
  `jointype` int(11) NOT NULL DEFAULT '0' COMMENT '0申请中1同意2拒绝',
  PRIMARY KEY (`j_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_myjoinstudio','j_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_myjoinstudio')." ADD 
  `j_id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_myjoinstudio','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_myjoinstudio')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_myjoinstudio','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_myjoinstudio')." ADD   `zid` int(11) NOT NULL COMMENT '医生id'");}
if(!pdo_fieldexists('hyb_yl_myjoinstudio','jointime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_myjoinstudio')." ADD   `jointime` int(11) NOT NULL COMMENT '加入时间'");}
if(!pdo_fieldexists('hyb_yl_myjoinstudio','roomtype')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_myjoinstudio')." ADD   `roomtype` int(11) NOT NULL DEFAULT '1' COMMENT '团队类型1线上2自由'");}
if(!pdo_fieldexists('hyb_yl_myjoinstudio','t_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_myjoinstudio')." ADD   `t_id` int(11) NOT NULL COMMENT '团队Id'");}
if(!pdo_fieldexists('hyb_yl_myjoinstudio','jointype')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_myjoinstudio')." ADD   `jointype` int(11) NOT NULL DEFAULT '0' COMMENT '0申请中1同意2拒绝'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_node` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `link` varchar(255) NOT NULL COMMENT '链接地址',
  `status` tinyint(2) NOT NULL COMMENT '状态（0：隐藏；1：显示）',
  `created` int(11) NOT NULL COMMENT '添加时间',
  `tid` int(11) NOT NULL COMMENT '团队id',
  `openid` varchar(255) NOT NULL COMMENT '发布者',
  `zid` int(11) NOT NULL COMMENT '发布专家id',
  `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '类型（0：主页设置；1：团队公告）',
  `style` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否置顶（0：否；1：是）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='公告表';

");

if(!pdo_fieldexists('hyb_yl_node','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_node')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_node','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_node')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_node','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_node')." ADD   `title` varchar(255) NOT NULL COMMENT '标题'");}
if(!pdo_fieldexists('hyb_yl_node','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_node')." ADD   `content` text NOT NULL COMMENT '内容'");}
if(!pdo_fieldexists('hyb_yl_node','link')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_node')." ADD   `link` varchar(255) NOT NULL COMMENT '链接地址'");}
if(!pdo_fieldexists('hyb_yl_node','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_node')." ADD   `status` tinyint(2) NOT NULL COMMENT '状态（0：隐藏；1：显示）'");}
if(!pdo_fieldexists('hyb_yl_node','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_node')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_node','tid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_node')." ADD   `tid` int(11) NOT NULL COMMENT '团队id'");}
if(!pdo_fieldexists('hyb_yl_node','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_node')." ADD   `openid` varchar(255) NOT NULL COMMENT '发布者'");}
if(!pdo_fieldexists('hyb_yl_node','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_node')." ADD   `zid` int(11) NOT NULL COMMENT '发布专家id'");}
if(!pdo_fieldexists('hyb_yl_node','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_node')." ADD   `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '类型（0：主页设置；1：团队公告）'");}
if(!pdo_fieldexists('hyb_yl_node','style')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_node')." ADD   `style` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否置顶（0：否；1：是）'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_notesite` (
  `nid` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `note` text NOT NULL COMMENT '标签',
  `position` text NOT NULL COMMENT '医生职位',
  `switch` int(255) NOT NULL DEFAULT '0' COMMENT '0不开放1开放',
  PRIMARY KEY (`nid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_notesite','nid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_notesite')." ADD 
  `nid` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_notesite','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_notesite')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_notesite','uid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_notesite')." ADD   `uid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_notesite','note')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_notesite')." ADD   `note` text NOT NULL COMMENT '标签'");}
if(!pdo_fieldexists('hyb_yl_notesite','position')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_notesite')." ADD   `position` text NOT NULL COMMENT '医生职位'");}
if(!pdo_fieldexists('hyb_yl_notesite','switch')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_notesite')." ADD   `switch` int(255) NOT NULL DEFAULT '0' COMMENT '0不开放1开放'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_order_rule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `qx_time` int(11) NOT NULL DEFAULT '10' COMMENT '订单自动取消时间',
  `gq_time` int(11) NOT NULL COMMENT '订单过期提醒时间小时',
  `sh_time` int(11) NOT NULL COMMENT '自动收货时间',
  `kc_pay` tinyint(2) NOT NULL DEFAULT '0' COMMENT '课程支付是否开启（0：否；1：是）',
  `tjgq_order` tinyint(2) NOT NULL DEFAULT '0' COMMENT '体检退款过期订单（0：关闭；1：开启）',
  `created` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='订单规则表';

");

if(!pdo_fieldexists('hyb_yl_order_rule','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_order_rule')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_order_rule','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_order_rule')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_order_rule','qx_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_order_rule')." ADD   `qx_time` int(11) NOT NULL DEFAULT '10' COMMENT '订单自动取消时间'");}
if(!pdo_fieldexists('hyb_yl_order_rule','gq_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_order_rule')." ADD   `gq_time` int(11) NOT NULL COMMENT '订单过期提醒时间小时'");}
if(!pdo_fieldexists('hyb_yl_order_rule','sh_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_order_rule')." ADD   `sh_time` int(11) NOT NULL COMMENT '自动收货时间'");}
if(!pdo_fieldexists('hyb_yl_order_rule','kc_pay')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_order_rule')." ADD   `kc_pay` tinyint(2) NOT NULL DEFAULT '0' COMMENT '课程支付是否开启（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_order_rule','tjgq_order')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_order_rule')." ADD   `tjgq_order` tinyint(2) NOT NULL DEFAULT '0' COMMENT '体检退款过期订单（0：关闭；1：开启）'");}
if(!pdo_fieldexists('hyb_yl_order_rule','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_order_rule')." ADD   `created` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_parameter` (
  `p_id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `appid` varchar(255) NOT NULL COMMENT '小程序appid',
  `appsecret` varchar(255) NOT NULL COMMENT '小程序秘钥',
  `mch_id` varchar(255) NOT NULL COMMENT '商户号',
  `pub_api` varchar(255) NOT NULL COMMENT '公众号支付秘钥',
  `pub_appid` varchar(255) NOT NULL COMMENT '开发者ID(AppID)',
  `appkey` varchar(255) NOT NULL COMMENT '开发者密码(AppSecret)',
  `keypem` varchar(50) NOT NULL COMMENT 'apiclient_cert.pem',
  `upfile` varchar(50) NOT NULL COMMENT 'apiclient_key.pem',
  `baidu_key` varchar(255) NOT NULL,
  `city_state` tinyint(11) NOT NULL DEFAULT '0' COMMENT '0城市定位1精确定位',
  `qie_city` tinyint(11) NOT NULL DEFAULT '0' COMMENT '0开启1关闭',
  `tencent_sdkappid` varchar(255) NOT NULL COMMENT '腾讯云即时音频sdk',
  `tencent_key` varchar(255) NOT NULL COMMENT '腾讯云即使音频key',
  `huaw_appid` varchar(255) NOT NULL COMMENT '华为电话appid',
  `huaw_key` varchar(255) NOT NULL COMMENT '华为key',
  `wuliu_appid` varchar(255) NOT NULL COMMENT '快递100',
  `wuliu_key` varchar(255) NOT NULL COMMENT '快递100秘钥',
  `wuliu_state` tinyint(11) NOT NULL DEFAULT '0' COMMENT '物流开启状态0关闭1开启',
  `pay_name` varchar(50) NOT NULL COMMENT '支付名称',
  `wxapp_mb` text NOT NULL COMMENT '微信小程序订阅消息',
  `areaCode` varchar(50) NOT NULL COMMENT '号码段',
  `wlid` int(11) NOT NULL DEFAULT '0' COMMENT '物流id',
  `gzhmb` longtext NOT NULL COMMENT '公众号消息提醒',
  `box_sn` varchar(255) DEFAULT NULL COMMENT '云收款音箱SN码',
  `box_token` varchar(255) DEFAULT NULL COMMENT '开发商分配token',
  `box_version` int(11) DEFAULT '1' COMMENT '云收款音箱版本号',
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='参数设置表';

");

if(!pdo_fieldexists('hyb_yl_parameter','p_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_parameter')." ADD 
  `p_id` int(10) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_parameter','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_parameter')." ADD   `uniacid` int(10) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_parameter','appid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_parameter')." ADD   `appid` varchar(255) NOT NULL COMMENT '小程序appid'");}
if(!pdo_fieldexists('hyb_yl_parameter','appsecret')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_parameter')." ADD   `appsecret` varchar(255) NOT NULL COMMENT '小程序秘钥'");}
if(!pdo_fieldexists('hyb_yl_parameter','mch_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_parameter')." ADD   `mch_id` varchar(255) NOT NULL COMMENT '商户号'");}
if(!pdo_fieldexists('hyb_yl_parameter','pub_api')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_parameter')." ADD   `pub_api` varchar(255) NOT NULL COMMENT '公众号支付秘钥'");}
if(!pdo_fieldexists('hyb_yl_parameter','pub_appid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_parameter')." ADD   `pub_appid` varchar(255) NOT NULL COMMENT '开发者ID(AppID)'");}
if(!pdo_fieldexists('hyb_yl_parameter','appkey')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_parameter')." ADD   `appkey` varchar(255) NOT NULL COMMENT '开发者密码(AppSecret)'");}
if(!pdo_fieldexists('hyb_yl_parameter','keypem')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_parameter')." ADD   `keypem` varchar(50) NOT NULL COMMENT 'apiclient_cert.pem'");}
if(!pdo_fieldexists('hyb_yl_parameter','upfile')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_parameter')." ADD   `upfile` varchar(50) NOT NULL COMMENT 'apiclient_key.pem'");}
if(!pdo_fieldexists('hyb_yl_parameter','baidu_key')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_parameter')." ADD   `baidu_key` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_parameter','city_state')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_parameter')." ADD   `city_state` tinyint(11) NOT NULL DEFAULT '0' COMMENT '0城市定位1精确定位'");}
if(!pdo_fieldexists('hyb_yl_parameter','qie_city')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_parameter')." ADD   `qie_city` tinyint(11) NOT NULL DEFAULT '0' COMMENT '0开启1关闭'");}
if(!pdo_fieldexists('hyb_yl_parameter','tencent_sdkappid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_parameter')." ADD   `tencent_sdkappid` varchar(255) NOT NULL COMMENT '腾讯云即时音频sdk'");}
if(!pdo_fieldexists('hyb_yl_parameter','tencent_key')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_parameter')." ADD   `tencent_key` varchar(255) NOT NULL COMMENT '腾讯云即使音频key'");}
if(!pdo_fieldexists('hyb_yl_parameter','huaw_appid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_parameter')." ADD   `huaw_appid` varchar(255) NOT NULL COMMENT '华为电话appid'");}
if(!pdo_fieldexists('hyb_yl_parameter','huaw_key')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_parameter')." ADD   `huaw_key` varchar(255) NOT NULL COMMENT '华为key'");}
if(!pdo_fieldexists('hyb_yl_parameter','wuliu_appid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_parameter')." ADD   `wuliu_appid` varchar(255) NOT NULL COMMENT '快递100'");}
if(!pdo_fieldexists('hyb_yl_parameter','wuliu_key')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_parameter')." ADD   `wuliu_key` varchar(255) NOT NULL COMMENT '快递100秘钥'");}
if(!pdo_fieldexists('hyb_yl_parameter','wuliu_state')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_parameter')." ADD   `wuliu_state` tinyint(11) NOT NULL DEFAULT '0' COMMENT '物流开启状态0关闭1开启'");}
if(!pdo_fieldexists('hyb_yl_parameter','pay_name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_parameter')." ADD   `pay_name` varchar(50) NOT NULL COMMENT '支付名称'");}
if(!pdo_fieldexists('hyb_yl_parameter','wxapp_mb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_parameter')." ADD   `wxapp_mb` text NOT NULL COMMENT '微信小程序订阅消息'");}
if(!pdo_fieldexists('hyb_yl_parameter','areaCode')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_parameter')." ADD   `areaCode` varchar(50) NOT NULL COMMENT '号码段'");}
if(!pdo_fieldexists('hyb_yl_parameter','wlid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_parameter')." ADD   `wlid` int(11) NOT NULL DEFAULT '0' COMMENT '物流id'");}
if(!pdo_fieldexists('hyb_yl_parameter','gzhmb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_parameter')." ADD   `gzhmb` longtext NOT NULL COMMENT '公众号消息提醒'");}
if(!pdo_fieldexists('hyb_yl_parameter','box_sn')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_parameter')." ADD   `box_sn` varchar(255) DEFAULT NULL COMMENT '云收款音箱SN码'");}
if(!pdo_fieldexists('hyb_yl_parameter','box_token')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_parameter')." ADD   `box_token` varchar(255) DEFAULT NULL COMMENT '开发商分配token'");}
if(!pdo_fieldexists('hyb_yl_parameter','box_version')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_parameter')." ADD   `box_version` int(11) DEFAULT '1' COMMENT '云收款音箱版本号'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_pay` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(255) DEFAULT NULL COMMENT '用户',
  `money` decimal(11,2) DEFAULT NULL COMMENT '金额',
  `fee` decimal(11,2) DEFAULT NULL COMMENT '手续费',
  `zid` int(11) DEFAULT NULL COMMENT '专家id',
  `did` int(11) DEFAULT NULL COMMENT '绿通id',
  `created` int(11) DEFAULT NULL COMMENT '添加时间',
  `back_orser` varchar(255) DEFAULT NULL COMMENT '订单号',
  `old_money` decimal(11,2) DEFAULT NULL COMMENT '订单原价',
  `keyword` varchar(255) DEFAULT NULL COMMENT '关键字',
  `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '类型（0：增加；1：减少）',
  `style` tinyint(2) NOT NULL DEFAULT '0' COMMENT '收支类型（0：导诊；1：专家；2：团队；3：代理；4：分销；5：用户;6:药师；7：机构，8：平台）',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0；待审核；1：审核通过；2：审核拒绝）',
  `cash` tinyint(2) DEFAULT NULL COMMENT '是否为提现（0：否；1：是）',
  `tid` int(11) NOT NULL COMMENT '团队id',
  `cash_type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '提现方式（0：微信；1：支付宝；2：银行卡）',
  `yid` int(11) NOT NULL COMMENT '药师id',
  `nickname` varchar(255) DEFAULT '' COMMENT '微信号',
  `zfb_name` varchar(255) DEFAULT NULL COMMENT '支付宝姓名',
  `zfb_number` varchar(50) DEFAULT NULL COMMENT '支付宝账号',
  `bank_card` varchar(255) DEFAULT '' COMMENT '银行卡卡号',
  `bank_address` varchar(255) DEFAULT NULL COMMENT '银行卡开户行',
  `bank_user` varchar(255) DEFAULT NULL COMMENT '银行卡持有人姓名',
  `hid` int(11) DEFAULT NULL COMMENT '机构id',
  `zfb_id` int(11) NOT NULL COMMENT '支付宝id',
  `bank_id` int(11) NOT NULL COMMENT '银行卡id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=utf8 COMMENT='收支明细表';

");

if(!pdo_fieldexists('hyb_yl_pay','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pay')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_pay','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pay')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_pay','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pay')." ADD   `openid` varchar(255) DEFAULT NULL COMMENT '用户'");}
if(!pdo_fieldexists('hyb_yl_pay','money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pay')." ADD   `money` decimal(11,2) DEFAULT NULL COMMENT '金额'");}
if(!pdo_fieldexists('hyb_yl_pay','fee')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pay')." ADD   `fee` decimal(11,2) DEFAULT NULL COMMENT '手续费'");}
if(!pdo_fieldexists('hyb_yl_pay','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pay')." ADD   `zid` int(11) DEFAULT NULL COMMENT '专家id'");}
if(!pdo_fieldexists('hyb_yl_pay','did')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pay')." ADD   `did` int(11) DEFAULT NULL COMMENT '绿通id'");}
if(!pdo_fieldexists('hyb_yl_pay','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pay')." ADD   `created` int(11) DEFAULT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_pay','back_orser')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pay')." ADD   `back_orser` varchar(255) DEFAULT NULL COMMENT '订单号'");}
if(!pdo_fieldexists('hyb_yl_pay','old_money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pay')." ADD   `old_money` decimal(11,2) DEFAULT NULL COMMENT '订单原价'");}
if(!pdo_fieldexists('hyb_yl_pay','keyword')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pay')." ADD   `keyword` varchar(255) DEFAULT NULL COMMENT '关键字'");}
if(!pdo_fieldexists('hyb_yl_pay','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pay')." ADD   `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '类型（0：增加；1：减少）'");}
if(!pdo_fieldexists('hyb_yl_pay','style')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pay')." ADD   `style` tinyint(2) NOT NULL DEFAULT '0' COMMENT '收支类型（0：导诊；1：专家；2：团队；3：代理；4：分销；5：用户;6:药师；7：机构，8：平台）'");}
if(!pdo_fieldexists('hyb_yl_pay','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pay')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0；待审核；1：审核通过；2：审核拒绝）'");}
if(!pdo_fieldexists('hyb_yl_pay','cash')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pay')." ADD   `cash` tinyint(2) DEFAULT NULL COMMENT '是否为提现（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_pay','tid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pay')." ADD   `tid` int(11) NOT NULL COMMENT '团队id'");}
if(!pdo_fieldexists('hyb_yl_pay','cash_type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pay')." ADD   `cash_type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '提现方式（0：微信；1：支付宝；2：银行卡）'");}
if(!pdo_fieldexists('hyb_yl_pay','yid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pay')." ADD   `yid` int(11) NOT NULL COMMENT '药师id'");}
if(!pdo_fieldexists('hyb_yl_pay','nickname')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pay')." ADD   `nickname` varchar(255) DEFAULT '' COMMENT '微信号'");}
if(!pdo_fieldexists('hyb_yl_pay','zfb_name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pay')." ADD   `zfb_name` varchar(255) DEFAULT NULL COMMENT '支付宝姓名'");}
if(!pdo_fieldexists('hyb_yl_pay','zfb_number')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pay')." ADD   `zfb_number` varchar(50) DEFAULT NULL COMMENT '支付宝账号'");}
if(!pdo_fieldexists('hyb_yl_pay','bank_card')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pay')." ADD   `bank_card` varchar(255) DEFAULT '' COMMENT '银行卡卡号'");}
if(!pdo_fieldexists('hyb_yl_pay','bank_address')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pay')." ADD   `bank_address` varchar(255) DEFAULT NULL COMMENT '银行卡开户行'");}
if(!pdo_fieldexists('hyb_yl_pay','bank_user')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pay')." ADD   `bank_user` varchar(255) DEFAULT NULL COMMENT '银行卡持有人姓名'");}
if(!pdo_fieldexists('hyb_yl_pay','hid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pay')." ADD   `hid` int(11) DEFAULT NULL COMMENT '机构id'");}
if(!pdo_fieldexists('hyb_yl_pay','zfb_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pay')." ADD   `zfb_id` int(11) NOT NULL COMMENT '支付宝id'");}
if(!pdo_fieldexists('hyb_yl_pay','bank_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pay')." ADD   `bank_id` int(11) NOT NULL COMMENT '银行卡id'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_pingjia` (
  `gz_id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `openid` varchar(255) NOT NULL COMMENT '用户openid',
  `zid` int(11) NOT NULL COMMENT '专家id',
  `keywords` varchar(255) NOT NULL COMMENT '关键字',
  `starsnum` int(10) unsigned NOT NULL COMMENT '评论星级',
  `content` varchar(255) NOT NULL COMMENT '内容',
  `orders` varchar(255) NOT NULL COMMENT '订单号',
  `createTime` int(11) NOT NULL COMMENT '评论时间',
  `j_id` int(11) NOT NULL COMMENT '患者id',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '回复状态（0：未回复；1：已恢复）',
  `typs` tinyint(2) NOT NULL DEFAULT '0' COMMENT '审核结果（0：待审核；1：审核通过；2：未通过）',
  `h_content` text NOT NULL COMMENT '回复内容',
  `h_time` int(11) NOT NULL COMMENT '回复时间',
  `style` tinyint(2) NOT NULL DEFAULT '1' COMMENT '评论类型（1：真实评价；2：虚拟评价）',
  `did` int(11) NOT NULL COMMENT '绿通人员',
  PRIMARY KEY (`gz_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COMMENT='评价表';

");

if(!pdo_fieldexists('hyb_yl_pingjia','gz_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pingjia')." ADD 
  `gz_id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_pingjia','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pingjia')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_pingjia','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pingjia')." ADD   `openid` varchar(255) NOT NULL COMMENT '用户openid'");}
if(!pdo_fieldexists('hyb_yl_pingjia','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pingjia')." ADD   `zid` int(11) NOT NULL COMMENT '专家id'");}
if(!pdo_fieldexists('hyb_yl_pingjia','keywords')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pingjia')." ADD   `keywords` varchar(255) NOT NULL COMMENT '关键字'");}
if(!pdo_fieldexists('hyb_yl_pingjia','starsnum')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pingjia')." ADD   `starsnum` int(10) unsigned NOT NULL COMMENT '评论星级'");}
if(!pdo_fieldexists('hyb_yl_pingjia','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pingjia')." ADD   `content` varchar(255) NOT NULL COMMENT '内容'");}
if(!pdo_fieldexists('hyb_yl_pingjia','orders')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pingjia')." ADD   `orders` varchar(255) NOT NULL COMMENT '订单号'");}
if(!pdo_fieldexists('hyb_yl_pingjia','createTime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pingjia')." ADD   `createTime` int(11) NOT NULL COMMENT '评论时间'");}
if(!pdo_fieldexists('hyb_yl_pingjia','j_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pingjia')." ADD   `j_id` int(11) NOT NULL COMMENT '患者id'");}
if(!pdo_fieldexists('hyb_yl_pingjia','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pingjia')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '回复状态（0：未回复；1：已恢复）'");}
if(!pdo_fieldexists('hyb_yl_pingjia','typs')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pingjia')." ADD   `typs` tinyint(2) NOT NULL DEFAULT '0' COMMENT '审核结果（0：待审核；1：审核通过；2：未通过）'");}
if(!pdo_fieldexists('hyb_yl_pingjia','h_content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pingjia')." ADD   `h_content` text NOT NULL COMMENT '回复内容'");}
if(!pdo_fieldexists('hyb_yl_pingjia','h_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pingjia')." ADD   `h_time` int(11) NOT NULL COMMENT '回复时间'");}
if(!pdo_fieldexists('hyb_yl_pingjia','style')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pingjia')." ADD   `style` tinyint(2) NOT NULL DEFAULT '1' COMMENT '评论类型（1：真实评价；2：虚拟评价）'");}
if(!pdo_fieldexists('hyb_yl_pingjia','did')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pingjia')." ADD   `did` int(11) NOT NULL COMMENT '绿通人员'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_pinglunsite` (
  `pl_id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `useropenid` varchar(255) NOT NULL DEFAULT '0' COMMENT '作者',
  `sid` int(11) NOT NULL COMMENT '评论对象',
  `pl_text` text NOT NULL COMMENT 'p评论文字',
  `pl_time` int(11) NOT NULL COMMENT 'p评论时间',
  `dengj` tinyint(11) NOT NULL COMMENT 'd等级',
  `parentid` int(11) NOT NULL COMMENT '上级id',
  `usertoux` varchar(255) NOT NULL COMMENT '用户头像',
  `name` char(50) NOT NULL COMMENT 'y用户昵称',
  `author` int(11) NOT NULL,
  `replyType` char(50) NOT NULL,
  `types` int(11) NOT NULL COMMENT '0用户端1医生端',
  `a_id` int(11) NOT NULL,
  `adminopenid` varchar(255) DEFAULT NULL,
  `user_identity` int(10) NOT NULL DEFAULT '0' COMMENT '评论者身份 0用户 1专家 2后台',
  PRIMARY KEY (`pl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_pinglunsite','pl_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pinglunsite')." ADD 
  `pl_id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_pinglunsite','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pinglunsite')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_pinglunsite','useropenid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pinglunsite')." ADD   `useropenid` varchar(255) NOT NULL DEFAULT '0' COMMENT '作者'");}
if(!pdo_fieldexists('hyb_yl_pinglunsite','sid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pinglunsite')." ADD   `sid` int(11) NOT NULL COMMENT '评论对象'");}
if(!pdo_fieldexists('hyb_yl_pinglunsite','pl_text')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pinglunsite')." ADD   `pl_text` text NOT NULL COMMENT 'p评论文字'");}
if(!pdo_fieldexists('hyb_yl_pinglunsite','pl_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pinglunsite')." ADD   `pl_time` int(11) NOT NULL COMMENT 'p评论时间'");}
if(!pdo_fieldexists('hyb_yl_pinglunsite','dengj')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pinglunsite')." ADD   `dengj` tinyint(11) NOT NULL COMMENT 'd等级'");}
if(!pdo_fieldexists('hyb_yl_pinglunsite','parentid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pinglunsite')." ADD   `parentid` int(11) NOT NULL COMMENT '上级id'");}
if(!pdo_fieldexists('hyb_yl_pinglunsite','usertoux')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pinglunsite')." ADD   `usertoux` varchar(255) NOT NULL COMMENT '用户头像'");}
if(!pdo_fieldexists('hyb_yl_pinglunsite','name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pinglunsite')." ADD   `name` char(50) NOT NULL COMMENT 'y用户昵称'");}
if(!pdo_fieldexists('hyb_yl_pinglunsite','author')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pinglunsite')." ADD   `author` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_pinglunsite','replyType')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pinglunsite')." ADD   `replyType` char(50) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_pinglunsite','types')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pinglunsite')." ADD   `types` int(11) NOT NULL COMMENT '0用户端1医生端'");}
if(!pdo_fieldexists('hyb_yl_pinglunsite','a_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pinglunsite')." ADD   `a_id` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_pinglunsite','adminopenid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pinglunsite')." ADD   `adminopenid` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_pinglunsite','user_identity')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_pinglunsite')." ADD   `user_identity` int(10) NOT NULL DEFAULT '0' COMMENT '评论者身份 0用户 1专家 2后台'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_qianyueorder` (
  `q_id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `openid` varchar(255) NOT NULL COMMENT '用户openid',
  `j_id` int(11) NOT NULL,
  `ordernum` varchar(255) NOT NULL,
  `qyimg` varchar(255) NOT NULL,
  `qmimg` varchar(255) NOT NULL,
  `money` float(8,2) NOT NULL,
  `pid` tinyint(11) NOT NULL COMMENT '服务包id',
  `startime` int(11) NOT NULL,
  `overtime` int(11) NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '服务名称',
  `names` varchar(50) NOT NULL COMMENT '用户名称',
  `t_id` int(11) NOT NULL COMMENT '工作室ID',
  `sid` int(11) NOT NULL COMMENT '类型id',
  `time` int(11) NOT NULL,
  `ispay` int(11) NOT NULL DEFAULT '0' COMMENT '0未支付1支付',
  `ifhz` int(11) NOT NULL COMMENT '1户主0不是',
  `hzsfz` varchar(255) NOT NULL COMMENT '户主身份证',
  `istg` tinyint(11) NOT NULL DEFAULT '0' COMMENT '0待通过1通过2已取消',
  `zid` int(11) NOT NULL,
  `beizhu` varchar(50) NOT NULL,
  `fenzuid` int(11) NOT NULL COMMENT '分组',
  `jieyutext` varchar(255) NOT NULL,
  `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '支付方式（1：微信支付；2：线下汇款）',
  PRIMARY KEY (`q_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_qianyueorder','q_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_qianyueorder')." ADD 
  `q_id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_qianyueorder','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_qianyueorder')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_qianyueorder','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_qianyueorder')." ADD   `openid` varchar(255) NOT NULL COMMENT '用户openid'");}
if(!pdo_fieldexists('hyb_yl_qianyueorder','j_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_qianyueorder')." ADD   `j_id` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_qianyueorder','ordernum')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_qianyueorder')." ADD   `ordernum` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_qianyueorder','qyimg')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_qianyueorder')." ADD   `qyimg` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_qianyueorder','qmimg')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_qianyueorder')." ADD   `qmimg` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_qianyueorder','money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_qianyueorder')." ADD   `money` float(8,2) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_qianyueorder','pid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_qianyueorder')." ADD   `pid` tinyint(11) NOT NULL COMMENT '服务包id'");}
if(!pdo_fieldexists('hyb_yl_qianyueorder','startime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_qianyueorder')." ADD   `startime` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_qianyueorder','overtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_qianyueorder')." ADD   `overtime` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_qianyueorder','name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_qianyueorder')." ADD   `name` varchar(50) NOT NULL COMMENT '服务名称'");}
if(!pdo_fieldexists('hyb_yl_qianyueorder','names')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_qianyueorder')." ADD   `names` varchar(50) NOT NULL COMMENT '用户名称'");}
if(!pdo_fieldexists('hyb_yl_qianyueorder','t_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_qianyueorder')." ADD   `t_id` int(11) NOT NULL COMMENT '工作室ID'");}
if(!pdo_fieldexists('hyb_yl_qianyueorder','sid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_qianyueorder')." ADD   `sid` int(11) NOT NULL COMMENT '类型id'");}
if(!pdo_fieldexists('hyb_yl_qianyueorder','time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_qianyueorder')." ADD   `time` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_qianyueorder','ispay')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_qianyueorder')." ADD   `ispay` int(11) NOT NULL DEFAULT '0' COMMENT '0未支付1支付'");}
if(!pdo_fieldexists('hyb_yl_qianyueorder','ifhz')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_qianyueorder')." ADD   `ifhz` int(11) NOT NULL COMMENT '1户主0不是'");}
if(!pdo_fieldexists('hyb_yl_qianyueorder','hzsfz')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_qianyueorder')." ADD   `hzsfz` varchar(255) NOT NULL COMMENT '户主身份证'");}
if(!pdo_fieldexists('hyb_yl_qianyueorder','istg')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_qianyueorder')." ADD   `istg` tinyint(11) NOT NULL DEFAULT '0' COMMENT '0待通过1通过2已取消'");}
if(!pdo_fieldexists('hyb_yl_qianyueorder','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_qianyueorder')." ADD   `zid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_qianyueorder','beizhu')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_qianyueorder')." ADD   `beizhu` varchar(50) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_qianyueorder','fenzuid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_qianyueorder')." ADD   `fenzuid` int(11) NOT NULL COMMENT '分组'");}
if(!pdo_fieldexists('hyb_yl_qianyueorder','jieyutext')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_qianyueorder')." ADD   `jieyutext` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_qianyueorder','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_qianyueorder')." ADD   `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '支付方式（1：微信支付；2：线下汇款）'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_qyfwneirng` (
  `od_id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `fw_neirong` varchar(255) NOT NULL COMMENT '服务内容',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `type` tinyint(11) NOT NULL DEFAULT '0' COMMENT '0未完成1完成',
  `q_id` int(11) NOT NULL COMMENT '签约订单ID',
  PRIMARY KEY (`od_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_qyfwneirng','od_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_qyfwneirng')." ADD 
  `od_id` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_qyfwneirng','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_qyfwneirng')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_qyfwneirng','fw_neirong')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_qyfwneirng')." ADD   `fw_neirong` varchar(255) NOT NULL COMMENT '服务内容'");}
if(!pdo_fieldexists('hyb_yl_qyfwneirng','addtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_qyfwneirng')." ADD   `addtime` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_qyfwneirng','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_qyfwneirng')." ADD   `type` tinyint(11) NOT NULL DEFAULT '0' COMMENT '0未完成1完成'");}
if(!pdo_fieldexists('hyb_yl_qyfwneirng','q_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_qyfwneirng')." ADD   `q_id` int(11) NOT NULL COMMENT '签约订单ID'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_recharge` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `status` tinyint(2) DEFAULT '0' COMMENT '状态（0：关闭；1：开启）',
  `content` text COMMENT '优惠内容',
  `created` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='充值设置';

");

if(!pdo_fieldexists('hyb_yl_recharge','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_recharge')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_recharge','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_recharge')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_recharge','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_recharge')." ADD   `status` tinyint(2) DEFAULT '0' COMMENT '状态（0：关闭；1：开启）'");}
if(!pdo_fieldexists('hyb_yl_recharge','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_recharge')." ADD   `content` text COMMENT '优惠内容'");}
if(!pdo_fieldexists('hyb_yl_recharge','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_recharge')." ADD   `created` int(11) DEFAULT NULL COMMENT '添加时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_refund` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `refund` tinyint(2) NOT NULL DEFAULT '0' COMMENT '退款方式（0：手机端退款；1：后台退款；2：自动退款）',
  `key_words` varchar(50) NOT NULL COMMENT '所属类型',
  `orders` varchar(255) NOT NULL COMMENT '订单号',
  `openid` varchar(255) NOT NULL COMMENT '用户openid',
  `j_id` int(11) NOT NULL COMMENT '申请用户',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：待审核；1：审核通过；2：审核拒绝；3：已打款）',
  `created` int(11) NOT NULL COMMENT '申请时间',
  `s_time` int(11) NOT NULL COMMENT '审核时间',
  `dis_content` varchar(255) NOT NULL COMMENT '退款描述',
  `money` decimal(11,2) NOT NULL COMMENT '申请金额',
  `t_money` decimal(11,2) NOT NULL COMMENT '退款金额',
  `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '申请用户（0：用户；1：专家；2：机构）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 COMMENT='退款记录表';

");

if(!pdo_fieldexists('hyb_yl_refund','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_refund')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_refund','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_refund')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_refund','refund')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_refund')." ADD   `refund` tinyint(2) NOT NULL DEFAULT '0' COMMENT '退款方式（0：手机端退款；1：后台退款；2：自动退款）'");}
if(!pdo_fieldexists('hyb_yl_refund','key_words')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_refund')." ADD   `key_words` varchar(50) NOT NULL COMMENT '所属类型'");}
if(!pdo_fieldexists('hyb_yl_refund','orders')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_refund')." ADD   `orders` varchar(255) NOT NULL COMMENT '订单号'");}
if(!pdo_fieldexists('hyb_yl_refund','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_refund')." ADD   `openid` varchar(255) NOT NULL COMMENT '用户openid'");}
if(!pdo_fieldexists('hyb_yl_refund','j_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_refund')." ADD   `j_id` int(11) NOT NULL COMMENT '申请用户'");}
if(!pdo_fieldexists('hyb_yl_refund','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_refund')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：待审核；1：审核通过；2：审核拒绝；3：已打款）'");}
if(!pdo_fieldexists('hyb_yl_refund','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_refund')." ADD   `created` int(11) NOT NULL COMMENT '申请时间'");}
if(!pdo_fieldexists('hyb_yl_refund','s_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_refund')." ADD   `s_time` int(11) NOT NULL COMMENT '审核时间'");}
if(!pdo_fieldexists('hyb_yl_refund','dis_content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_refund')." ADD   `dis_content` varchar(255) NOT NULL COMMENT '退款描述'");}
if(!pdo_fieldexists('hyb_yl_refund','money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_refund')." ADD   `money` decimal(11,2) NOT NULL COMMENT '申请金额'");}
if(!pdo_fieldexists('hyb_yl_refund','t_money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_refund')." ADD   `t_money` decimal(11,2) NOT NULL COMMENT '退款金额'");}
if(!pdo_fieldexists('hyb_yl_refund','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_refund')." ADD   `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '申请用户（0：用户；1：专家；2：机构）'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_schoolroom` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL COMMENT 'uniacid',
  `room_parentid` int(11) NOT NULL COMMENT '父类ID',
  `sroomtitle` varchar(50) NOT NULL COMMENT '课堂标题',
  `room_type` int(10) NOT NULL DEFAULT '0' COMMENT '课堂类型1收费；0免费',
  `room_money` varchar(50) NOT NULL DEFAULT '0' COMMENT '价格',
  `room_thumb` varchar(255) NOT NULL COMMENT '课堂缩略图',
  `room_liulan` varchar(255) NOT NULL DEFAULT '0' COMMENT '学习人数',
  `room_tj` int(50) NOT NULL DEFAULT '0' COMMENT '推荐1推荐；0不推荐',
  `room_state` int(11) NOT NULL DEFAULT '1' COMMENT '是否通过审核1通过0不通过',
  `room_video` varchar(255) NOT NULL COMMENT '课程视频',
  `room_desc` text NOT NULL COMMENT '课程描述',
  `sord` int(11) NOT NULL DEFAULT '0',
  `openid` varchar(11) NOT NULL COMMENT '发布者',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_schoolroom','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_schoolroom')." ADD 
  `id` int(10) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_schoolroom','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_schoolroom')." ADD   `uniacid` int(10) NOT NULL COMMENT 'uniacid'");}
if(!pdo_fieldexists('hyb_yl_schoolroom','room_parentid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_schoolroom')." ADD   `room_parentid` int(11) NOT NULL COMMENT '父类ID'");}
if(!pdo_fieldexists('hyb_yl_schoolroom','sroomtitle')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_schoolroom')." ADD   `sroomtitle` varchar(50) NOT NULL COMMENT '课堂标题'");}
if(!pdo_fieldexists('hyb_yl_schoolroom','room_type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_schoolroom')." ADD   `room_type` int(10) NOT NULL DEFAULT '0' COMMENT '课堂类型1收费；0免费'");}
if(!pdo_fieldexists('hyb_yl_schoolroom','room_money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_schoolroom')." ADD   `room_money` varchar(50) NOT NULL DEFAULT '0' COMMENT '价格'");}
if(!pdo_fieldexists('hyb_yl_schoolroom','room_thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_schoolroom')." ADD   `room_thumb` varchar(255) NOT NULL COMMENT '课堂缩略图'");}
if(!pdo_fieldexists('hyb_yl_schoolroom','room_liulan')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_schoolroom')." ADD   `room_liulan` varchar(255) NOT NULL DEFAULT '0' COMMENT '学习人数'");}
if(!pdo_fieldexists('hyb_yl_schoolroom','room_tj')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_schoolroom')." ADD   `room_tj` int(50) NOT NULL DEFAULT '0' COMMENT '推荐1推荐；0不推荐'");}
if(!pdo_fieldexists('hyb_yl_schoolroom','room_state')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_schoolroom')." ADD   `room_state` int(11) NOT NULL DEFAULT '1' COMMENT '是否通过审核1通过0不通过'");}
if(!pdo_fieldexists('hyb_yl_schoolroom','room_video')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_schoolroom')." ADD   `room_video` varchar(255) NOT NULL COMMENT '课程视频'");}
if(!pdo_fieldexists('hyb_yl_schoolroom','room_desc')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_schoolroom')." ADD   `room_desc` text NOT NULL COMMENT '课程描述'");}
if(!pdo_fieldexists('hyb_yl_schoolroom','sord')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_schoolroom')." ADD   `sord` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('hyb_yl_schoolroom','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_schoolroom')." ADD   `openid` varchar(11) NOT NULL COMMENT '发布者'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_search` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL COMMENT '搜索词',
  `status` int(10) NOT NULL DEFAULT '0' COMMENT '状态（0：关闭；1：开启）',
  `sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='搜索表';

");

if(!pdo_fieldexists('hyb_yl_search','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_search')." ADD 
  `id` int(10) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_search','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_search')." ADD   `uniacid` int(10) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_search','name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_search')." ADD   `name` varchar(255) DEFAULT NULL COMMENT '搜索词'");}
if(!pdo_fieldexists('hyb_yl_search','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_search')." ADD   `status` int(10) NOT NULL DEFAULT '0' COMMENT '状态（0：关闭；1：开启）'");}
if(!pdo_fieldexists('hyb_yl_search','sort')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_search')." ADD   `sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_search_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `openid` varchar(255) NOT NULL DEFAULT '' COMMENT '搜索者',
  `content` varchar(255) NOT NULL COMMENT '搜搜内容',
  `createtime` varchar(255) NOT NULL COMMENT '搜索时间',
  `source` int(10) NOT NULL DEFAULT '0' COMMENT '搜索来源 0大搜索 1医生 2医院 3药品',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1225 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_search_log','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_search_log')." ADD 
  `id` int(10) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_search_log','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_search_log')." ADD   `uniacid` int(10) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_search_log','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_search_log')." ADD   `openid` varchar(255) NOT NULL DEFAULT '' COMMENT '搜索者'");}
if(!pdo_fieldexists('hyb_yl_search_log','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_search_log')." ADD   `content` varchar(255) NOT NULL COMMENT '搜搜内容'");}
if(!pdo_fieldexists('hyb_yl_search_log','createtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_search_log')." ADD   `createtime` varchar(255) NOT NULL COMMENT '搜索时间'");}
if(!pdo_fieldexists('hyb_yl_search_log','source')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_search_log')." ADD   `source` int(10) NOT NULL DEFAULT '0' COMMENT '搜索来源 0大搜索 1医生 2医院 3药品'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_search_set` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL COMMENT '标题',
  `thumb` varchar(255) DEFAULT NULL COMMENT '图片',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态（0：隐藏；1：显示）',
  `keyword` tinyint(2) NOT NULL DEFAULT '1' COMMENT '搜索类型（1：医生；2：医院；3：药房）',
  `created` int(11) DEFAULT NULL COMMENT '添加时间',
  `sort` int(11) NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('hyb_yl_search_set','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_search_set')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_search_set','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_search_set')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_search_set','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_search_set')." ADD   `title` varchar(100) DEFAULT NULL COMMENT '标题'");}
if(!pdo_fieldexists('hyb_yl_search_set','thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_search_set')." ADD   `thumb` varchar(255) DEFAULT NULL COMMENT '图片'");}
if(!pdo_fieldexists('hyb_yl_search_set','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_search_set')." ADD   `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态（0：隐藏；1：显示）'");}
if(!pdo_fieldexists('hyb_yl_search_set','keyword')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_search_set')." ADD   `keyword` tinyint(2) NOT NULL DEFAULT '1' COMMENT '搜索类型（1：医生；2：医院；3：药房）'");}
if(!pdo_fieldexists('hyb_yl_search_set','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_search_set')." ADD   `created` int(11) DEFAULT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_search_set','sort')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_search_set')." ADD   `sort` int(11) NOT NULL COMMENT '排序'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_service_homepage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `stort` int(11) NOT NULL COMMENT '排序',
  `serh_name` varchar(50) NOT NULL COMMENT '服务标题',
  `serh_ftitle` varchar(50) NOT NULL,
  `serh_thumb` varchar(255) NOT NULL COMMENT '服务图片',
  `serh_content` text NOT NULL COMMENT '服务内容',
  `serh_liuc` text NOT NULL COMMENT '服务流程',
  `serh_xiey` text NOT NULL COMMENT '服务协议',
  `state` tinyint(11) NOT NULL DEFAULT '1' COMMENT '开关 1显示0不显示',
  `ids` int(11) NOT NULL COMMENT '插件id',
  `weizhi` tinyint(2) NOT NULL DEFAULT '0' COMMENT '展示位置1首页0问诊页面;；2：绿通页面',
  `tui_money` text NOT NULL COMMENT '退款协议',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COMMENT='服务包设置';

");

if(!pdo_fieldexists('hyb_yl_service_homepage','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_service_homepage')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_service_homepage','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_service_homepage')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_service_homepage','stort')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_service_homepage')." ADD   `stort` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('hyb_yl_service_homepage','serh_name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_service_homepage')." ADD   `serh_name` varchar(50) NOT NULL COMMENT '服务标题'");}
if(!pdo_fieldexists('hyb_yl_service_homepage','serh_ftitle')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_service_homepage')." ADD   `serh_ftitle` varchar(50) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_service_homepage','serh_thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_service_homepage')." ADD   `serh_thumb` varchar(255) NOT NULL COMMENT '服务图片'");}
if(!pdo_fieldexists('hyb_yl_service_homepage','serh_content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_service_homepage')." ADD   `serh_content` text NOT NULL COMMENT '服务内容'");}
if(!pdo_fieldexists('hyb_yl_service_homepage','serh_liuc')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_service_homepage')." ADD   `serh_liuc` text NOT NULL COMMENT '服务流程'");}
if(!pdo_fieldexists('hyb_yl_service_homepage','serh_xiey')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_service_homepage')." ADD   `serh_xiey` text NOT NULL COMMENT '服务协议'");}
if(!pdo_fieldexists('hyb_yl_service_homepage','state')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_service_homepage')." ADD   `state` tinyint(11) NOT NULL DEFAULT '1' COMMENT '开关 1显示0不显示'");}
if(!pdo_fieldexists('hyb_yl_service_homepage','ids')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_service_homepage')." ADD   `ids` int(11) NOT NULL COMMENT '插件id'");}
if(!pdo_fieldexists('hyb_yl_service_homepage','weizhi')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_service_homepage')." ADD   `weizhi` tinyint(2) NOT NULL DEFAULT '0' COMMENT '展示位置1首页0问诊页面;；2：绿通页面'");}
if(!pdo_fieldexists('hyb_yl_service_homepage','tui_money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_service_homepage')." ADD   `tui_money` text NOT NULL COMMENT '退款协议'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_share` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `openid` varchar(255) NOT NULL COMMENT '用户openid',
  `sharepic` text NOT NULL COMMENT '动态图片',
  `contents` varchar(255) NOT NULL COMMENT '动态内容',
  `times` int(11) NOT NULL COMMENT '发布时间',
  `dianj` int(11) NOT NULL DEFAULT '0' COMMENT '点赞数',
  `type` tinyint(5) NOT NULL DEFAULT '0' COMMENT '1通过审核0不通过',
  `shartitle` varchar(50) NOT NULL COMMENT '动态标题',
  `share_tj` tinyint(5) NOT NULL DEFAULT '0' COMMENT '1推荐0不推荐',
  `state` tinyint(5) NOT NULL DEFAULT '0' COMMENT '0用户；1医生；2平台',
  `labelid` int(10) NOT NULL DEFAULT '0' COMMENT '标签id [版块分类二级id]',
  `user_identity` int(10) NOT NULL DEFAULT '0' COMMENT '发布者身份  0普通用户 1专家 2后台',
  `doctor_visible` int(10) NOT NULL DEFAULT '0' COMMENT '是否仅医生可见  1是 0否',
  `virtual_thumb` varchar(255) DEFAULT NULL COMMENT '虚拟动态用户头像',
  `virtual_name` varchar(255) DEFAULT NULL COMMENT '虚拟动态用户名称',
  `virtual_accesses` int(10) NOT NULL DEFAULT '0' COMMENT '虚拟浏览量',
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_share','a_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_share')." ADD 
  `a_id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_share','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_share')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_share','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_share')." ADD   `openid` varchar(255) NOT NULL COMMENT '用户openid'");}
if(!pdo_fieldexists('hyb_yl_share','sharepic')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_share')." ADD   `sharepic` text NOT NULL COMMENT '动态图片'");}
if(!pdo_fieldexists('hyb_yl_share','contents')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_share')." ADD   `contents` varchar(255) NOT NULL COMMENT '动态内容'");}
if(!pdo_fieldexists('hyb_yl_share','times')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_share')." ADD   `times` int(11) NOT NULL COMMENT '发布时间'");}
if(!pdo_fieldexists('hyb_yl_share','dianj')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_share')." ADD   `dianj` int(11) NOT NULL DEFAULT '0' COMMENT '点赞数'");}
if(!pdo_fieldexists('hyb_yl_share','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_share')." ADD   `type` tinyint(5) NOT NULL DEFAULT '0' COMMENT '1通过审核0不通过'");}
if(!pdo_fieldexists('hyb_yl_share','shartitle')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_share')." ADD   `shartitle` varchar(50) NOT NULL COMMENT '动态标题'");}
if(!pdo_fieldexists('hyb_yl_share','share_tj')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_share')." ADD   `share_tj` tinyint(5) NOT NULL DEFAULT '0' COMMENT '1推荐0不推荐'");}
if(!pdo_fieldexists('hyb_yl_share','state')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_share')." ADD   `state` tinyint(5) NOT NULL DEFAULT '0' COMMENT '0用户；1医生；2平台'");}
if(!pdo_fieldexists('hyb_yl_share','labelid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_share')." ADD   `labelid` int(10) NOT NULL DEFAULT '0' COMMENT '标签id [版块分类二级id]'");}
if(!pdo_fieldexists('hyb_yl_share','user_identity')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_share')." ADD   `user_identity` int(10) NOT NULL DEFAULT '0' COMMENT '发布者身份  0普通用户 1专家 2后台'");}
if(!pdo_fieldexists('hyb_yl_share','doctor_visible')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_share')." ADD   `doctor_visible` int(10) NOT NULL DEFAULT '0' COMMENT '是否仅医生可见  1是 0否'");}
if(!pdo_fieldexists('hyb_yl_share','virtual_thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_share')." ADD   `virtual_thumb` varchar(255) DEFAULT NULL COMMENT '虚拟动态用户头像'");}
if(!pdo_fieldexists('hyb_yl_share','virtual_name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_share')." ADD   `virtual_name` varchar(255) DEFAULT NULL COMMENT '虚拟动态用户名称'");}
if(!pdo_fieldexists('hyb_yl_share','virtual_accesses')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_share')." ADD   `virtual_accesses` int(10) NOT NULL DEFAULT '0' COMMENT '虚拟浏览量'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_share_category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL COMMENT '分类名称',
  `describe` varchar(255) DEFAULT NULL COMMENT '分类描述',
  `thumb` varchar(255) DEFAULT NULL COMMENT '分类图片',
  `abroad` varchar(255) DEFAULT NULL COMMENT '外部链接',
  `enabled` int(10) NOT NULL DEFAULT '0' COMMENT '是否开启 1:是 0:否',
  `recommend` int(10) NOT NULL DEFAULT '0' COMMENT '是否推荐 1:是 0:否',
  `sortid` int(10) NOT NULL DEFAULT '0' COMMENT '分类排序',
  `paretid` int(10) NOT NULL DEFAULT '0' COMMENT '父级id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_share_category','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_share_category')." ADD 
  `id` int(10) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_share_category','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_share_category')." ADD   `uniacid` int(10) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_share_category','name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_share_category')." ADD   `name` varchar(255) DEFAULT NULL COMMENT '分类名称'");}
if(!pdo_fieldexists('hyb_yl_share_category','describe')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_share_category')." ADD   `describe` varchar(255) DEFAULT NULL COMMENT '分类描述'");}
if(!pdo_fieldexists('hyb_yl_share_category','thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_share_category')." ADD   `thumb` varchar(255) DEFAULT NULL COMMENT '分类图片'");}
if(!pdo_fieldexists('hyb_yl_share_category','abroad')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_share_category')." ADD   `abroad` varchar(255) DEFAULT NULL COMMENT '外部链接'");}
if(!pdo_fieldexists('hyb_yl_share_category','enabled')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_share_category')." ADD   `enabled` int(10) NOT NULL DEFAULT '0' COMMENT '是否开启 1:是 0:否'");}
if(!pdo_fieldexists('hyb_yl_share_category','recommend')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_share_category')." ADD   `recommend` int(10) NOT NULL DEFAULT '0' COMMENT '是否推荐 1:是 0:否'");}
if(!pdo_fieldexists('hyb_yl_share_category','sortid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_share_category')." ADD   `sortid` int(10) NOT NULL DEFAULT '0' COMMENT '分类排序'");}
if(!pdo_fieldexists('hyb_yl_share_category','paretid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_share_category')." ADD   `paretid` int(10) NOT NULL DEFAULT '0' COMMENT '父级id'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_share_setting` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) DEFAULT NULL,
  `is_shenhe` int(10) NOT NULL COMMENT '是否免审核（0：否；1：是）',
  `is_status` int(10) NOT NULL DEFAULT '0' COMMENT '是否启用（0：否；1：是）',
  `newfeed` varchar(255) DEFAULT NULL COMMENT '最新动态',
  `hotfeed` varchar(255) DEFAULT NULL COMMENT '热门动态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='分享设置表';

");

if(!pdo_fieldexists('hyb_yl_share_setting','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_share_setting')." ADD 
  `id` int(10) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_share_setting','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_share_setting')." ADD   `uniacid` int(10) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_share_setting','is_shenhe')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_share_setting')." ADD   `is_shenhe` int(10) NOT NULL COMMENT '是否免审核（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_share_setting','is_status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_share_setting')." ADD   `is_status` int(10) NOT NULL DEFAULT '0' COMMENT '是否启用（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_share_setting','newfeed')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_share_setting')." ADD   `newfeed` varchar(255) DEFAULT NULL COMMENT '最新动态'");}
if(!pdo_fieldexists('hyb_yl_share_setting','hotfeed')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_share_setting')." ADD   `hotfeed` varchar(255) DEFAULT NULL COMMENT '热门动态'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_shoufei_service` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL COMMENT '标题',
  `status` tinyint(2) NOT NULL COMMENT '状态（0：禁用；1：启用）',
  `created` int(11) NOT NULL COMMENT '添加时间',
  `thumb` varchar(255) NOT NULL COMMENT '图片',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='收费服务表';

");

if(!pdo_fieldexists('hyb_yl_shoufei_service','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_shoufei_service')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_shoufei_service','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_shoufei_service')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_shoufei_service','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_shoufei_service')." ADD   `title` varchar(255) NOT NULL COMMENT '标题'");}
if(!pdo_fieldexists('hyb_yl_shoufei_service','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_shoufei_service')." ADD   `status` tinyint(2) NOT NULL COMMENT '状态（0：禁用；1：启用）'");}
if(!pdo_fieldexists('hyb_yl_shoufei_service','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_shoufei_service')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_shoufei_service','thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_shoufei_service')." ADD   `thumb` varchar(255) NOT NULL COMMENT '图片'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_shoufei_set` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL COMMENT '类别名称',
  `time` int(11) NOT NULL COMMENT '时长',
  `price` decimal(11,2) NOT NULL COMMENT '价格',
  `type` int(11) NOT NULL COMMENT '类型',
  `is_fenxiao` tinyint(2) NOT NULL COMMENT '是否参与分销（0：不参与；1：参与）',
  `fx_one` decimal(11,2) NOT NULL COMMENT '一级分销结算金额',
  `fx_two` decimal(11,2) NOT NULL COMMENT '二级分销结算金额',
  `is_shenhe` tinyint(2) NOT NULL COMMENT '是否免审核（0：否；1：是）',
  `is_xufei` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否用于续费（0：否；1：是）',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否启用（0：否；1：是）',
  `created` int(11) NOT NULL COMMENT '添加时间',
  `sort` int(11) NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='收费设置表';

");

if(!pdo_fieldexists('hyb_yl_shoufei_set','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_shoufei_set')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_shoufei_set','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_shoufei_set')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_shoufei_set','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_shoufei_set')." ADD   `title` varchar(255) NOT NULL COMMENT '类别名称'");}
if(!pdo_fieldexists('hyb_yl_shoufei_set','time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_shoufei_set')." ADD   `time` int(11) NOT NULL COMMENT '时长'");}
if(!pdo_fieldexists('hyb_yl_shoufei_set','price')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_shoufei_set')." ADD   `price` decimal(11,2) NOT NULL COMMENT '价格'");}
if(!pdo_fieldexists('hyb_yl_shoufei_set','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_shoufei_set')." ADD   `type` int(11) NOT NULL COMMENT '类型'");}
if(!pdo_fieldexists('hyb_yl_shoufei_set','is_fenxiao')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_shoufei_set')." ADD   `is_fenxiao` tinyint(2) NOT NULL COMMENT '是否参与分销（0：不参与；1：参与）'");}
if(!pdo_fieldexists('hyb_yl_shoufei_set','fx_one')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_shoufei_set')." ADD   `fx_one` decimal(11,2) NOT NULL COMMENT '一级分销结算金额'");}
if(!pdo_fieldexists('hyb_yl_shoufei_set','fx_two')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_shoufei_set')." ADD   `fx_two` decimal(11,2) NOT NULL COMMENT '二级分销结算金额'");}
if(!pdo_fieldexists('hyb_yl_shoufei_set','is_shenhe')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_shoufei_set')." ADD   `is_shenhe` tinyint(2) NOT NULL COMMENT '是否免审核（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_shoufei_set','is_xufei')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_shoufei_set')." ADD   `is_xufei` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否用于续费（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_shoufei_set','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_shoufei_set')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否启用（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_shoufei_set','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_shoufei_set')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_shoufei_set','sort')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_shoufei_set')." ADD   `sort` int(11) NOT NULL COMMENT '排序'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_special` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `openid` varchar(255) NOT NULL COMMENT '用户',
  `name` varchar(255) DEFAULT NULL COMMENT '姓名',
  `telphone` varchar(50) DEFAULT NULL COMMENT '电话',
  `idcard` varchar(50) DEFAULT NULL COMMENT '身份证id',
  `city` varchar(255) DEFAULT NULL COMMENT '地址',
  `hid` int(11) DEFAULT NULL COMMENT '医院',
  `keshi` int(11) DEFAULT NULL COMMENT '科室',
  `date` varchar(50) DEFAULT NULL COMMENT '时间',
  `time` varchar(50) DEFAULT NULL COMMENT '时间',
  `imgpath` text COMMENT '图片',
  `files` text COMMENT '文件',
  `money` decimal(11,2) DEFAULT NULL COMMENT '金额',
  `types` text COMMENT '类型',
  `created` int(11) DEFAULT NULL COMMENT '添加时间',
  `orders` varchar(100) DEFAULT NULL COMMENT '统一订单号',
  `back_orser` varchar(100) DEFAULT NULL COMMENT '统一订单号',
  `ifpay` int(11) DEFAULT '0' COMMENT '支付状态（0：未付款；1：已付款）',
  `pay_time` int(11) DEFAULT NULL COMMENT '支付时间',
  `type` varchar(255) DEFAULT NULL COMMENT '类型',
  `text` text COMMENT '详情',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_special','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_special')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_special','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_special')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_special','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_special')." ADD   `openid` varchar(255) NOT NULL COMMENT '用户'");}
if(!pdo_fieldexists('hyb_yl_special','name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_special')." ADD   `name` varchar(255) DEFAULT NULL COMMENT '姓名'");}
if(!pdo_fieldexists('hyb_yl_special','telphone')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_special')." ADD   `telphone` varchar(50) DEFAULT NULL COMMENT '电话'");}
if(!pdo_fieldexists('hyb_yl_special','idcard')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_special')." ADD   `idcard` varchar(50) DEFAULT NULL COMMENT '身份证id'");}
if(!pdo_fieldexists('hyb_yl_special','city')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_special')." ADD   `city` varchar(255) DEFAULT NULL COMMENT '地址'");}
if(!pdo_fieldexists('hyb_yl_special','hid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_special')." ADD   `hid` int(11) DEFAULT NULL COMMENT '医院'");}
if(!pdo_fieldexists('hyb_yl_special','keshi')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_special')." ADD   `keshi` int(11) DEFAULT NULL COMMENT '科室'");}
if(!pdo_fieldexists('hyb_yl_special','date')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_special')." ADD   `date` varchar(50) DEFAULT NULL COMMENT '时间'");}
if(!pdo_fieldexists('hyb_yl_special','time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_special')." ADD   `time` varchar(50) DEFAULT NULL COMMENT '时间'");}
if(!pdo_fieldexists('hyb_yl_special','imgpath')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_special')." ADD   `imgpath` text COMMENT '图片'");}
if(!pdo_fieldexists('hyb_yl_special','files')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_special')." ADD   `files` text COMMENT '文件'");}
if(!pdo_fieldexists('hyb_yl_special','money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_special')." ADD   `money` decimal(11,2) DEFAULT NULL COMMENT '金额'");}
if(!pdo_fieldexists('hyb_yl_special','types')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_special')." ADD   `types` text COMMENT '类型'");}
if(!pdo_fieldexists('hyb_yl_special','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_special')." ADD   `created` int(11) DEFAULT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_special','orders')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_special')." ADD   `orders` varchar(100) DEFAULT NULL COMMENT '统一订单号'");}
if(!pdo_fieldexists('hyb_yl_special','back_orser')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_special')." ADD   `back_orser` varchar(100) DEFAULT NULL COMMENT '统一订单号'");}
if(!pdo_fieldexists('hyb_yl_special','ifpay')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_special')." ADD   `ifpay` int(11) DEFAULT '0' COMMENT '支付状态（0：未付款；1：已付款）'");}
if(!pdo_fieldexists('hyb_yl_special','pay_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_special')." ADD   `pay_time` int(11) DEFAULT NULL COMMENT '支付时间'");}
if(!pdo_fieldexists('hyb_yl_special','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_special')." ADD   `type` varchar(255) DEFAULT NULL COMMENT '类型'");}
if(!pdo_fieldexists('hyb_yl_special','text')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_special')." ADD   `text` text COMMENT '详情'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_store` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL COMMENT '标题',
  `content` text NOT NULL COMMENT '详情',
  `created` int(11) NOT NULL COMMENT '添加时间',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态(0:禁用；1：启用）',
  `telphone` varchar(20) NOT NULL COMMENT '联系电话',
  `province` varchar(255) NOT NULL COMMENT '所在省',
  `city` varchar(255) NOT NULL COMMENT '所在市',
  `district` varchar(255) NOT NULL COMMENT '所在区',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='店铺表';

");

if(!pdo_fieldexists('hyb_yl_store','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_store')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_store','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_store')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_store','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_store')." ADD   `title` varchar(255) NOT NULL COMMENT '标题'");}
if(!pdo_fieldexists('hyb_yl_store','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_store')." ADD   `content` text NOT NULL COMMENT '详情'");}
if(!pdo_fieldexists('hyb_yl_store','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_store')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_store','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_store')." ADD   `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态(0:禁用；1：启用）'");}
if(!pdo_fieldexists('hyb_yl_store','telphone')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_store')." ADD   `telphone` varchar(20) NOT NULL COMMENT '联系电话'");}
if(!pdo_fieldexists('hyb_yl_store','province')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_store')." ADD   `province` varchar(255) NOT NULL COMMENT '所在省'");}
if(!pdo_fieldexists('hyb_yl_store','city')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_store')." ADD   `city` varchar(255) NOT NULL COMMENT '所在市'");}
if(!pdo_fieldexists('hyb_yl_store','district')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_store')." ADD   `district` varchar(255) NOT NULL COMMENT '所在区'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_store_sale` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `stord` int(11) DEFAULT '0' COMMENT '店铺id',
  `title` varchar(255) DEFAULT '' COMMENT 'b奥体',
  `intro` varchar(500) DEFAULT NULL COMMENT '简介',
  `enough` int(11) DEFAULT '0',
  `timelimit` tinyint(4) DEFAULT '0',
  `timedays1` varchar(255) DEFAULT '',
  `timedays2` varchar(255) DEFAULT '',
  `backtype` tinyint(4) DEFAULT '0',
  `backmoney` int(11) DEFAULT '0',
  `discount` int(11) DEFAULT '0',
  `backwhen` tinyint(4) DEFAULT '0',
  `total` int(11) DEFAULT '0',
  `receive` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '0',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_store_sale','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_store_sale')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_store_sale','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_store_sale')." ADD   `uniacid` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('hyb_yl_store_sale','stord')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_store_sale')." ADD   `stord` int(11) DEFAULT '0' COMMENT '店铺id'");}
if(!pdo_fieldexists('hyb_yl_store_sale','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_store_sale')." ADD   `title` varchar(255) DEFAULT '' COMMENT 'b奥体'");}
if(!pdo_fieldexists('hyb_yl_store_sale','intro')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_store_sale')." ADD   `intro` varchar(500) DEFAULT NULL COMMENT '简介'");}
if(!pdo_fieldexists('hyb_yl_store_sale','enough')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_store_sale')." ADD   `enough` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('hyb_yl_store_sale','timelimit')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_store_sale')." ADD   `timelimit` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('hyb_yl_store_sale','timedays1')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_store_sale')." ADD   `timedays1` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('hyb_yl_store_sale','timedays2')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_store_sale')." ADD   `timedays2` varchar(255) DEFAULT ''");}
if(!pdo_fieldexists('hyb_yl_store_sale','backtype')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_store_sale')." ADD   `backtype` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('hyb_yl_store_sale','backmoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_store_sale')." ADD   `backmoney` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('hyb_yl_store_sale','discount')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_store_sale')." ADD   `discount` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('hyb_yl_store_sale','backwhen')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_store_sale')." ADD   `backwhen` tinyint(4) DEFAULT '0'");}
if(!pdo_fieldexists('hyb_yl_store_sale','total')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_store_sale')." ADD   `total` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('hyb_yl_store_sale','receive')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_store_sale')." ADD   `receive` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('hyb_yl_store_sale','enabled')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_store_sale')." ADD   `enabled` int(11) DEFAULT '0'");}
if(!pdo_fieldexists('hyb_yl_store_sale','addtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_store_sale')." ADD   `addtime` int(11) NOT NULL COMMENT '添加时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_suifang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `jieduan` varchar(255) NOT NULL COMMENT '阶段',
  `fangshi` tinyint(5) NOT NULL COMMENT '1电话2微信3QQ4其他',
  `beizhu` longtext NOT NULL COMMENT '备注',
  `next_time` int(11) NOT NULL COMMENT '下次时间',
  `openid` varchar(255) NOT NULL COMMENT 'y用户标识',
  `pid` int(11) NOT NULL COMMENT '潜在患者id',
  `addtime` datetime NOT NULL COMMENT 't添加时间',
  `thumb` varchar(255) NOT NULL COMMENT '图片',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COMMENT='随访表';

");

if(!pdo_fieldexists('hyb_yl_suifang','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_suifang')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_suifang','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_suifang')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_suifang','jieduan')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_suifang')." ADD   `jieduan` varchar(255) NOT NULL COMMENT '阶段'");}
if(!pdo_fieldexists('hyb_yl_suifang','fangshi')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_suifang')." ADD   `fangshi` tinyint(5) NOT NULL COMMENT '1电话2微信3QQ4其他'");}
if(!pdo_fieldexists('hyb_yl_suifang','beizhu')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_suifang')." ADD   `beizhu` longtext NOT NULL COMMENT '备注'");}
if(!pdo_fieldexists('hyb_yl_suifang','next_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_suifang')." ADD   `next_time` int(11) NOT NULL COMMENT '下次时间'");}
if(!pdo_fieldexists('hyb_yl_suifang','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_suifang')." ADD   `openid` varchar(255) NOT NULL COMMENT 'y用户标识'");}
if(!pdo_fieldexists('hyb_yl_suifang','pid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_suifang')." ADD   `pid` int(11) NOT NULL COMMENT '潜在患者id'");}
if(!pdo_fieldexists('hyb_yl_suifang','addtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_suifang')." ADD   `addtime` datetime NOT NULL COMMENT 't添加时间'");}
if(!pdo_fieldexists('hyb_yl_suifang','thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_suifang')." ADD   `thumb` varchar(255) NOT NULL COMMENT '图片'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_symptomset` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `content` text COMMENT '内容',
  `created` int(11) NOT NULL COMMENT '添加时间',
  `step` int(11) NOT NULL DEFAULT '0' COMMENT '所属步骤',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='用户档案设置表';

");

if(!pdo_fieldexists('hyb_yl_symptomset','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_symptomset')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_symptomset','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_symptomset')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_symptomset','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_symptomset')." ADD   `content` text COMMENT '内容'");}
if(!pdo_fieldexists('hyb_yl_symptomset','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_symptomset')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_symptomset','step')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_symptomset')." ADD   `step` int(11) NOT NULL DEFAULT '0' COMMENT '所属步骤'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_tank` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `sort` int(11) NOT NULL COMMENT '排序',
  `title` varchar(255) NOT NULL COMMENT '疾病名称',
  `content` text NOT NULL COMMENT '简单描述',
  `detail` text NOT NULL COMMENT '简介',
  `symptom` text NOT NULL COMMENT '症状',
  `reason` text NOT NULL COMMENT '病因',
  `diagnosis` text NOT NULL COMMENT '诊断',
  `treatment` text NOT NULL COMMENT '治疗',
  `life` text NOT NULL COMMENT '生活',
  `prevention` text NOT NULL COMMENT '预防',
  `openid` varchar(255) NOT NULL COMMENT '词条作者',
  `zid` int(11) NOT NULL COMMENT '审核专家',
  `keshi_one` int(11) NOT NULL COMMENT '一级科室id',
  `keshi_two` int(11) NOT NULL COMMENT '二级科室id',
  `created` int(11) NOT NULL COMMENT '发布时间',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否启用（0：否；1：是）',
  `is_index` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否推荐科室医生（0：否；1：是）',
  `is_yp` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否匹配药品（0：否；1：是）',
  `is_hospital` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否定位附近科室（0：否；1：是）',
  `is_content` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否匹配相关文章（0：否；1：是）',
  `is_reason` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否匹配相关问题（0：否；1：是）',
  `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '内容类型（0：疾病；1：症状；2：疫苗；3：检查项；4：备药；5：传染病）',
  `first` varchar(20) NOT NULL COMMENT '疾病首字母',
  `thumb` varchar(255) NOT NULL COMMENT '缩略图',
  `imgpath` text NOT NULL COMMENT '详情图',
  `style` int(11) NOT NULL COMMENT '所属类别',
  `share` varchar(255) DEFAULT NULL COMMENT '分享图片',
  `erweima` varchar(255) DEFAULT NULL COMMENT '二维码',
  `haibao` varchar(255) DEFAULT NULL COMMENT '海报',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2364 DEFAULT CHARSET=utf8 COMMENT='智库列表';

");

if(!pdo_fieldexists('hyb_yl_tank','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_tank','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_tank','sort')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank')." ADD   `sort` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('hyb_yl_tank','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank')." ADD   `title` varchar(255) NOT NULL COMMENT '疾病名称'");}
if(!pdo_fieldexists('hyb_yl_tank','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank')." ADD   `content` text NOT NULL COMMENT '简单描述'");}
if(!pdo_fieldexists('hyb_yl_tank','detail')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank')." ADD   `detail` text NOT NULL COMMENT '简介'");}
if(!pdo_fieldexists('hyb_yl_tank','symptom')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank')." ADD   `symptom` text NOT NULL COMMENT '症状'");}
if(!pdo_fieldexists('hyb_yl_tank','reason')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank')." ADD   `reason` text NOT NULL COMMENT '病因'");}
if(!pdo_fieldexists('hyb_yl_tank','diagnosis')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank')." ADD   `diagnosis` text NOT NULL COMMENT '诊断'");}
if(!pdo_fieldexists('hyb_yl_tank','treatment')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank')." ADD   `treatment` text NOT NULL COMMENT '治疗'");}
if(!pdo_fieldexists('hyb_yl_tank','life')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank')." ADD   `life` text NOT NULL COMMENT '生活'");}
if(!pdo_fieldexists('hyb_yl_tank','prevention')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank')." ADD   `prevention` text NOT NULL COMMENT '预防'");}
if(!pdo_fieldexists('hyb_yl_tank','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank')." ADD   `openid` varchar(255) NOT NULL COMMENT '词条作者'");}
if(!pdo_fieldexists('hyb_yl_tank','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank')." ADD   `zid` int(11) NOT NULL COMMENT '审核专家'");}
if(!pdo_fieldexists('hyb_yl_tank','keshi_one')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank')." ADD   `keshi_one` int(11) NOT NULL COMMENT '一级科室id'");}
if(!pdo_fieldexists('hyb_yl_tank','keshi_two')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank')." ADD   `keshi_two` int(11) NOT NULL COMMENT '二级科室id'");}
if(!pdo_fieldexists('hyb_yl_tank','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank')." ADD   `created` int(11) NOT NULL COMMENT '发布时间'");}
if(!pdo_fieldexists('hyb_yl_tank','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否启用（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_tank','is_index')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank')." ADD   `is_index` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否推荐科室医生（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_tank','is_yp')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank')." ADD   `is_yp` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否匹配药品（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_tank','is_hospital')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank')." ADD   `is_hospital` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否定位附近科室（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_tank','is_content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank')." ADD   `is_content` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否匹配相关文章（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_tank','is_reason')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank')." ADD   `is_reason` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否匹配相关问题（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_tank','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank')." ADD   `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '内容类型（0：疾病；1：症状；2：疫苗；3：检查项；4：备药；5：传染病）'");}
if(!pdo_fieldexists('hyb_yl_tank','first')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank')." ADD   `first` varchar(20) NOT NULL COMMENT '疾病首字母'");}
if(!pdo_fieldexists('hyb_yl_tank','thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank')." ADD   `thumb` varchar(255) NOT NULL COMMENT '缩略图'");}
if(!pdo_fieldexists('hyb_yl_tank','imgpath')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank')." ADD   `imgpath` text NOT NULL COMMENT '详情图'");}
if(!pdo_fieldexists('hyb_yl_tank','style')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank')." ADD   `style` int(11) NOT NULL COMMENT '所属类别'");}
if(!pdo_fieldexists('hyb_yl_tank','share')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank')." ADD   `share` varchar(255) DEFAULT NULL COMMENT '分享图片'");}
if(!pdo_fieldexists('hyb_yl_tank','erweima')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank')." ADD   `erweima` varchar(255) DEFAULT NULL COMMENT '二维码'");}
if(!pdo_fieldexists('hyb_yl_tank','haibao')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank')." ADD   `haibao` varchar(255) DEFAULT NULL COMMENT '海报'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_tank_thumb` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `symptom` varchar(255) NOT NULL COMMENT '症状图标',
  `reason` varchar(255) NOT NULL COMMENT '病因图标',
  `diagnosis` varchar(255) NOT NULL COMMENT '诊断图标',
  `treatment` varchar(255) NOT NULL COMMENT '治疗图标',
  `life` varchar(255) NOT NULL COMMENT '生活图标',
  `prevention` varchar(255) NOT NULL COMMENT '预防图片',
  `is_symptom` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启症状图标（0：否；1：是）',
  `is_reason` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启病因图标（0：否；1：是）',
  `is_diagnosis` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开始诊断图标（0：否；1：是）',
  `is_treatment` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启治疗（0：否；1：是）',
  `is_life` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启生活图标（0：否；1：是）',
  `is_prevention` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启预防（0：否；1：是）',
  `relieve` varchar(255) NOT NULL COMMENT '缓解方式图标',
  `is_relieve` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启缓解方式图标（0：否；1：是）',
  `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '图标分类（0：疾病；1：症状；2：检查项）',
  `created` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='图标管理表';

");

if(!pdo_fieldexists('hyb_yl_tank_thumb','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank_thumb')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_tank_thumb','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank_thumb')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_tank_thumb','symptom')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank_thumb')." ADD   `symptom` varchar(255) NOT NULL COMMENT '症状图标'");}
if(!pdo_fieldexists('hyb_yl_tank_thumb','reason')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank_thumb')." ADD   `reason` varchar(255) NOT NULL COMMENT '病因图标'");}
if(!pdo_fieldexists('hyb_yl_tank_thumb','diagnosis')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank_thumb')." ADD   `diagnosis` varchar(255) NOT NULL COMMENT '诊断图标'");}
if(!pdo_fieldexists('hyb_yl_tank_thumb','treatment')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank_thumb')." ADD   `treatment` varchar(255) NOT NULL COMMENT '治疗图标'");}
if(!pdo_fieldexists('hyb_yl_tank_thumb','life')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank_thumb')." ADD   `life` varchar(255) NOT NULL COMMENT '生活图标'");}
if(!pdo_fieldexists('hyb_yl_tank_thumb','prevention')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank_thumb')." ADD   `prevention` varchar(255) NOT NULL COMMENT '预防图片'");}
if(!pdo_fieldexists('hyb_yl_tank_thumb','is_symptom')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank_thumb')." ADD   `is_symptom` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启症状图标（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_tank_thumb','is_reason')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank_thumb')." ADD   `is_reason` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启病因图标（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_tank_thumb','is_diagnosis')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank_thumb')." ADD   `is_diagnosis` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开始诊断图标（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_tank_thumb','is_treatment')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank_thumb')." ADD   `is_treatment` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启治疗（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_tank_thumb','is_life')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank_thumb')." ADD   `is_life` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启生活图标（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_tank_thumb','is_prevention')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank_thumb')." ADD   `is_prevention` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启预防（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_tank_thumb','relieve')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank_thumb')." ADD   `relieve` varchar(255) NOT NULL COMMENT '缓解方式图标'");}
if(!pdo_fieldexists('hyb_yl_tank_thumb','is_relieve')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank_thumb')." ADD   `is_relieve` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启缓解方式图标（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_tank_thumb','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank_thumb')." ADD   `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '图标分类（0：疾病；1：症状；2：检查项）'");}
if(!pdo_fieldexists('hyb_yl_tank_thumb','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tank_thumb')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_taocan` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '套餐id',
  `uniacid` int(11) NOT NULL,
  `sort` int(11) NOT NULL COMMENT '排序',
  `title` varchar(255) NOT NULL COMMENT '套餐名称',
  `thumb` varchar(255) NOT NULL COMMENT '套餐缩略图',
  `imgpath` text NOT NULL COMMENT '套餐图集',
  `type` int(11) NOT NULL COMMENT '套餐分类',
  `crowd` varchar(255) NOT NULL,
  `jigou_one` varchar(255) NOT NULL COMMENT '所属机构一级',
  `time` varchar(20) NOT NULL COMMENT '预约时间',
  `yunfei` int(11) NOT NULL COMMENT '报告运费模板',
  `price` decimal(11,2) NOT NULL COMMENT '套餐价',
  `num` int(11) NOT NULL COMMENT '套餐库存',
  `content` varchar(255) NOT NULL COMMENT '套餐描述',
  `notes` text NOT NULL COMMENT '注意事项',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：待审核；1：已通过；2：未通过；3：已删除）',
  `created` int(11) NOT NULL COMMENT '添加时间',
  `typs` tinyint(2) NOT NULL DEFAULT '1' COMMENT '上架状态（0：下架；1：上架）',
  `is_tui` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否启用退款（0：否；1：是）',
  `is_tuijian` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否推荐（0：否；1：是）',
  `is_vip` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启会员优惠（0：否；1：是）',
  `vip_money` decimal(11,2) NOT NULL COMMENT '会员价格',
  `is_fenxiao` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否参与分销（0：否；1：是）',
  `is_guoqi` tinyint(11) NOT NULL DEFAULT '0' COMMENT '过期订单退款（0：禁用；1：启用）',
  `tijian` int(11) NOT NULL COMMENT '体检套餐模板',
  `fx_one` float(8,2) NOT NULL COMMENT '一级分销结算金额',
  `fx_two` float(8,2) NOT NULL COMMENT '二级分销结算金额',
  `js_time` tinyint(2) NOT NULL COMMENT '分销佣金结算时间',
  `jigou_two` int(11) NOT NULL COMMENT '所属机构二级',
  `haveBuyNumber` int(11) NOT NULL DEFAULT '0' COMMENT '预约人数',
  `hid` text NOT NULL COMMENT '分院ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='体检套餐表';

");

if(!pdo_fieldexists('hyb_yl_taocan','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '套餐id'");}
if(!pdo_fieldexists('hyb_yl_taocan','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_taocan','sort')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan')." ADD   `sort` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('hyb_yl_taocan','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan')." ADD   `title` varchar(255) NOT NULL COMMENT '套餐名称'");}
if(!pdo_fieldexists('hyb_yl_taocan','thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan')." ADD   `thumb` varchar(255) NOT NULL COMMENT '套餐缩略图'");}
if(!pdo_fieldexists('hyb_yl_taocan','imgpath')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan')." ADD   `imgpath` text NOT NULL COMMENT '套餐图集'");}
if(!pdo_fieldexists('hyb_yl_taocan','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan')." ADD   `type` int(11) NOT NULL COMMENT '套餐分类'");}
if(!pdo_fieldexists('hyb_yl_taocan','crowd')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan')." ADD   `crowd` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_taocan','jigou_one')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan')." ADD   `jigou_one` varchar(255) NOT NULL COMMENT '所属机构一级'");}
if(!pdo_fieldexists('hyb_yl_taocan','time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan')." ADD   `time` varchar(20) NOT NULL COMMENT '预约时间'");}
if(!pdo_fieldexists('hyb_yl_taocan','yunfei')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan')." ADD   `yunfei` int(11) NOT NULL COMMENT '报告运费模板'");}
if(!pdo_fieldexists('hyb_yl_taocan','price')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan')." ADD   `price` decimal(11,2) NOT NULL COMMENT '套餐价'");}
if(!pdo_fieldexists('hyb_yl_taocan','num')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan')." ADD   `num` int(11) NOT NULL COMMENT '套餐库存'");}
if(!pdo_fieldexists('hyb_yl_taocan','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan')." ADD   `content` varchar(255) NOT NULL COMMENT '套餐描述'");}
if(!pdo_fieldexists('hyb_yl_taocan','notes')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan')." ADD   `notes` text NOT NULL COMMENT '注意事项'");}
if(!pdo_fieldexists('hyb_yl_taocan','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：待审核；1：已通过；2：未通过；3：已删除）'");}
if(!pdo_fieldexists('hyb_yl_taocan','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_taocan','typs')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan')." ADD   `typs` tinyint(2) NOT NULL DEFAULT '1' COMMENT '上架状态（0：下架；1：上架）'");}
if(!pdo_fieldexists('hyb_yl_taocan','is_tui')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan')." ADD   `is_tui` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否启用退款（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_taocan','is_tuijian')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan')." ADD   `is_tuijian` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否推荐（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_taocan','is_vip')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan')." ADD   `is_vip` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启会员优惠（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_taocan','vip_money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan')." ADD   `vip_money` decimal(11,2) NOT NULL COMMENT '会员价格'");}
if(!pdo_fieldexists('hyb_yl_taocan','is_fenxiao')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan')." ADD   `is_fenxiao` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否参与分销（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_taocan','is_guoqi')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan')." ADD   `is_guoqi` tinyint(11) NOT NULL DEFAULT '0' COMMENT '过期订单退款（0：禁用；1：启用）'");}
if(!pdo_fieldexists('hyb_yl_taocan','tijian')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan')." ADD   `tijian` int(11) NOT NULL COMMENT '体检套餐模板'");}
if(!pdo_fieldexists('hyb_yl_taocan','fx_one')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan')." ADD   `fx_one` float(8,2) NOT NULL COMMENT '一级分销结算金额'");}
if(!pdo_fieldexists('hyb_yl_taocan','fx_two')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan')." ADD   `fx_two` float(8,2) NOT NULL COMMENT '二级分销结算金额'");}
if(!pdo_fieldexists('hyb_yl_taocan','js_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan')." ADD   `js_time` tinyint(2) NOT NULL COMMENT '分销佣金结算时间'");}
if(!pdo_fieldexists('hyb_yl_taocan','jigou_two')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan')." ADD   `jigou_two` int(11) NOT NULL COMMENT '所属机构二级'");}
if(!pdo_fieldexists('hyb_yl_taocan','haveBuyNumber')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan')." ADD   `haveBuyNumber` int(11) NOT NULL DEFAULT '0' COMMENT '预约人数'");}
if(!pdo_fieldexists('hyb_yl_taocan','hid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan')." ADD   `hid` text NOT NULL COMMENT '分院ID'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_taocan_cate` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '体检套餐分类id',
  `uniacid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL COMMENT '标题',
  `thumb` varchar(255) NOT NULL COMMENT '中心推荐图',
  `icon` varchar(255) NOT NULL COMMENT 'icon',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态（0：禁用；1：启用）',
  `created` int(11) NOT NULL COMMENT '添加时间',
  `is_tuijian` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否推荐（0：否；1：是）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='体检套餐分类表';

");

if(!pdo_fieldexists('hyb_yl_taocan_cate','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan_cate')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '体检套餐分类id'");}
if(!pdo_fieldexists('hyb_yl_taocan_cate','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan_cate')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_taocan_cate','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan_cate')." ADD   `title` varchar(255) NOT NULL COMMENT '标题'");}
if(!pdo_fieldexists('hyb_yl_taocan_cate','thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan_cate')." ADD   `thumb` varchar(255) NOT NULL COMMENT '中心推荐图'");}
if(!pdo_fieldexists('hyb_yl_taocan_cate','icon')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan_cate')." ADD   `icon` varchar(255) NOT NULL COMMENT 'icon'");}
if(!pdo_fieldexists('hyb_yl_taocan_cate','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan_cate')." ADD   `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态（0：禁用；1：启用）'");}
if(!pdo_fieldexists('hyb_yl_taocan_cate','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan_cate')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_taocan_cate','is_tuijian')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan_cate')." ADD   `is_tuijian` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否推荐（0：否；1：是）'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_taocan_rule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '套餐规则id',
  `uniacid` int(11) NOT NULL,
  `num` int(11) NOT NULL COMMENT '体检首页',
  `is_send` tinyint(2) NOT NULL DEFAULT '0' COMMENT '机构是否允许上传套餐（0：开启；1：关闭）',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '套餐是否开启审核（0：否；1：是）',
  `created` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='体检套餐规则表';

");

if(!pdo_fieldexists('hyb_yl_taocan_rule','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan_rule')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '套餐规则id'");}
if(!pdo_fieldexists('hyb_yl_taocan_rule','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan_rule')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_taocan_rule','num')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan_rule')." ADD   `num` int(11) NOT NULL COMMENT '体检首页'");}
if(!pdo_fieldexists('hyb_yl_taocan_rule','is_send')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan_rule')." ADD   `is_send` tinyint(2) NOT NULL DEFAULT '0' COMMENT '机构是否允许上传套餐（0：开启；1：关闭）'");}
if(!pdo_fieldexists('hyb_yl_taocan_rule','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan_rule')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '套餐是否开启审核（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_taocan_rule','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_taocan_rule')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_team` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `openid` varchar(255) NOT NULL COMMENT '用户openid',
  `title` varchar(255) NOT NULL COMMENT '团队名称',
  `sort` int(11) NOT NULL COMMENT '排序',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '团队类型（0：线上团队；1：线下团队）',
  `telphone` varchar(50) NOT NULL COMMENT '联系电话',
  `province` varchar(255) NOT NULL COMMENT '所在省',
  `city` varchar(255) NOT NULL COMMENT '所在市',
  `district` varchar(255) NOT NULL COMMENT '所在区',
  `lon` varchar(50) NOT NULL,
  `lat` varchar(50) NOT NULL,
  `keshi_one` int(11) NOT NULL COMMENT '一级科室类型id',
  `keshi_two` int(11) NOT NULL COMMENT '二级科室类型',
  `label` text NOT NULL COMMENT '擅长标签',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '入驻状态（0：待审核；1：通过；2：拒绝）',
  `is_show` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否在列表显示（0：否；1：是）',
  `created` int(11) NOT NULL COMMENT '添加时间',
  `thumb` varchar(255) NOT NULL COMMENT '团队logo',
  `imgpath` varchar(255) NOT NULL COMMENT '团队荣誉资质',
  `xn_answer` int(11) NOT NULL COMMENT '虚拟月回答',
  `xn_chufang` int(11) NOT NULL COMMENT '虚拟月处方',
  `times` int(11) NOT NULL COMMENT '响应时间',
  `content` text NOT NULL COMMENT '团队简介',
  `erweima` varchar(255) NOT NULL COMMENT '二维码',
  `money` decimal(11,2) NOT NULL COMMENT '团队余额',
  `address` varchar(255) NOT NULL COMMENT '所在地',
  `zid` int(11) NOT NULL COMMENT '专家id',
  `cid` int(11) DEFAULT NULL COMMENT '所在社区',
  `plugin` text COMMENT '开通服务',
  `jigou_one` int(11) DEFAULT NULL COMMENT '一级机构id',
  `jigou_two` int(11) DEFAULT NULL COMMENT '二级机构id',
  `z_sex` tinyint(2) NOT NULL DEFAULT '0' COMMENT '专家性别',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='团队表';

");

if(!pdo_fieldexists('hyb_yl_team','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_team','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_team','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team')." ADD   `openid` varchar(255) NOT NULL COMMENT '用户openid'");}
if(!pdo_fieldexists('hyb_yl_team','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team')." ADD   `title` varchar(255) NOT NULL COMMENT '团队名称'");}
if(!pdo_fieldexists('hyb_yl_team','sort')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team')." ADD   `sort` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('hyb_yl_team','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team')." ADD   `type` int(11) NOT NULL DEFAULT '0' COMMENT '团队类型（0：线上团队；1：线下团队）'");}
if(!pdo_fieldexists('hyb_yl_team','telphone')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team')." ADD   `telphone` varchar(50) NOT NULL COMMENT '联系电话'");}
if(!pdo_fieldexists('hyb_yl_team','province')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team')." ADD   `province` varchar(255) NOT NULL COMMENT '所在省'");}
if(!pdo_fieldexists('hyb_yl_team','city')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team')." ADD   `city` varchar(255) NOT NULL COMMENT '所在市'");}
if(!pdo_fieldexists('hyb_yl_team','district')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team')." ADD   `district` varchar(255) NOT NULL COMMENT '所在区'");}
if(!pdo_fieldexists('hyb_yl_team','lon')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team')." ADD   `lon` varchar(50) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_team','lat')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team')." ADD   `lat` varchar(50) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_team','keshi_one')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team')." ADD   `keshi_one` int(11) NOT NULL COMMENT '一级科室类型id'");}
if(!pdo_fieldexists('hyb_yl_team','keshi_two')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team')." ADD   `keshi_two` int(11) NOT NULL COMMENT '二级科室类型'");}
if(!pdo_fieldexists('hyb_yl_team','label')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team')." ADD   `label` text NOT NULL COMMENT '擅长标签'");}
if(!pdo_fieldexists('hyb_yl_team','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '入驻状态（0：待审核；1：通过；2：拒绝）'");}
if(!pdo_fieldexists('hyb_yl_team','is_show')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team')." ADD   `is_show` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否在列表显示（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_team','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_team','thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team')." ADD   `thumb` varchar(255) NOT NULL COMMENT '团队logo'");}
if(!pdo_fieldexists('hyb_yl_team','imgpath')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team')." ADD   `imgpath` varchar(255) NOT NULL COMMENT '团队荣誉资质'");}
if(!pdo_fieldexists('hyb_yl_team','xn_answer')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team')." ADD   `xn_answer` int(11) NOT NULL COMMENT '虚拟月回答'");}
if(!pdo_fieldexists('hyb_yl_team','xn_chufang')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team')." ADD   `xn_chufang` int(11) NOT NULL COMMENT '虚拟月处方'");}
if(!pdo_fieldexists('hyb_yl_team','times')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team')." ADD   `times` int(11) NOT NULL COMMENT '响应时间'");}
if(!pdo_fieldexists('hyb_yl_team','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team')." ADD   `content` text NOT NULL COMMENT '团队简介'");}
if(!pdo_fieldexists('hyb_yl_team','erweima')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team')." ADD   `erweima` varchar(255) NOT NULL COMMENT '二维码'");}
if(!pdo_fieldexists('hyb_yl_team','money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team')." ADD   `money` decimal(11,2) NOT NULL COMMENT '团队余额'");}
if(!pdo_fieldexists('hyb_yl_team','address')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team')." ADD   `address` varchar(255) NOT NULL COMMENT '所在地'");}
if(!pdo_fieldexists('hyb_yl_team','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team')." ADD   `zid` int(11) NOT NULL COMMENT '专家id'");}
if(!pdo_fieldexists('hyb_yl_team','cid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team')." ADD   `cid` int(11) DEFAULT NULL COMMENT '所在社区'");}
if(!pdo_fieldexists('hyb_yl_team','plugin')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team')." ADD   `plugin` text COMMENT '开通服务'");}
if(!pdo_fieldexists('hyb_yl_team','jigou_one')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team')." ADD   `jigou_one` int(11) DEFAULT NULL COMMENT '一级机构id'");}
if(!pdo_fieldexists('hyb_yl_team','jigou_two')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team')." ADD   `jigou_two` int(11) DEFAULT NULL COMMENT '二级机构id'");}
if(!pdo_fieldexists('hyb_yl_team','z_sex')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team')." ADD   `z_sex` tinyint(2) NOT NULL DEFAULT '0' COMMENT '专家性别'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_team_people` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `tid` int(11) NOT NULL COMMENT '团队id',
  `openid` varchar(255) DEFAULT NULL COMMENT '邀请用户openid',
  `zid` int(11) DEFAULT NULL COMMENT '邀请专家id',
  `y_openid` varchar(255) NOT NULL COMMENT '被邀专家openid',
  `y_zid` int(11) NOT NULL COMMENT '被邀专家id',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：待同意；1：已加入；2：已拒绝）',
  `created` int(11) NOT NULL COMMENT '邀请时间',
  `add_time` int(11) NOT NULL COMMENT '加入时间',
  `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '成员角色（0：负责人；1：普通成员）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='团队用户表';

");

if(!pdo_fieldexists('hyb_yl_team_people','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_people')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_team_people','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_people')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_team_people','tid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_people')." ADD   `tid` int(11) NOT NULL COMMENT '团队id'");}
if(!pdo_fieldexists('hyb_yl_team_people','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_people')." ADD   `openid` varchar(255) DEFAULT NULL COMMENT '邀请用户openid'");}
if(!pdo_fieldexists('hyb_yl_team_people','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_people')." ADD   `zid` int(11) DEFAULT NULL COMMENT '邀请专家id'");}
if(!pdo_fieldexists('hyb_yl_team_people','y_openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_people')." ADD   `y_openid` varchar(255) NOT NULL COMMENT '被邀专家openid'");}
if(!pdo_fieldexists('hyb_yl_team_people','y_zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_people')." ADD   `y_zid` int(11) NOT NULL COMMENT '被邀专家id'");}
if(!pdo_fieldexists('hyb_yl_team_people','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_people')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：待同意；1：已加入；2：已拒绝）'");}
if(!pdo_fieldexists('hyb_yl_team_people','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_people')." ADD   `created` int(11) NOT NULL COMMENT '邀请时间'");}
if(!pdo_fieldexists('hyb_yl_team_people','add_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_people')." ADD   `add_time` int(11) NOT NULL COMMENT '加入时间'");}
if(!pdo_fieldexists('hyb_yl_team_people','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_people')." ADD   `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '成员角色（0：负责人；1：普通成员）'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_team_rule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `is_shenhe` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否免审核（0：否；1：是）',
  `is_service` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否启用服务包（0：否；1：是）',
  `content` text NOT NULL COMMENT '团队协议',
  `created` int(11) DEFAULT NULL COMMENT '添加时间',
  `background` varchar(255) DEFAULT NULL COMMENT '背景图',
  `thumb` varchar(255) DEFAULT NULL COMMENT '背景信息图',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='团队设置表';

");

if(!pdo_fieldexists('hyb_yl_team_rule','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_rule')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_team_rule','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_rule')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_team_rule','is_shenhe')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_rule')." ADD   `is_shenhe` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否免审核（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_team_rule','is_service')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_rule')." ADD   `is_service` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否启用服务包（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_team_rule','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_rule')." ADD   `content` text NOT NULL COMMENT '团队协议'");}
if(!pdo_fieldexists('hyb_yl_team_rule','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_rule')." ADD   `created` int(11) DEFAULT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_team_rule','background')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_rule')." ADD   `background` varchar(255) DEFAULT NULL COMMENT '背景图'");}
if(!pdo_fieldexists('hyb_yl_team_rule','thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_rule')." ADD   `thumb` varchar(255) DEFAULT NULL COMMENT '背景信息图'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_team_serverlist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `tid` int(11) NOT NULL COMMENT '团队id',
  `key_words` varchar(255) NOT NULL COMMENT '关键字',
  `bid` varchar(255) NOT NULL COMMENT '服务id',
  `titlme` varchar(255) NOT NULL COMMENT '标题',
  `time` datetime NOT NULL COMMENT '添加时间',
  `time_leng` int(11) NOT NULL COMMENT '时长',
  `ptmoney` decimal(11,2) NOT NULL COMMENT '普通价格',
  `hymoney` decimal(11,2) NOT NULL COMMENT '会员价格',
  `hyzhuiw` int(11) NOT NULL COMMENT '会员追加次数',
  `ptzhuiw` int(11) NOT NULL COMMENT '普通追加次数',
  `stateback` tinyint(2) NOT NULL COMMENT '状态（0：关闭；1：开启）',
  `orders` varchar(50) NOT NULL COMMENT '订单号',
  `overtime` int(11) NOT NULL COMMENT '服务到期时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=173 DEFAULT CHARSET=utf8 COMMENT='团队服务表';

");

if(!pdo_fieldexists('hyb_yl_team_serverlist','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_serverlist')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_team_serverlist','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_serverlist')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_team_serverlist','tid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_serverlist')." ADD   `tid` int(11) NOT NULL COMMENT '团队id'");}
if(!pdo_fieldexists('hyb_yl_team_serverlist','key_words')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_serverlist')." ADD   `key_words` varchar(255) NOT NULL COMMENT '关键字'");}
if(!pdo_fieldexists('hyb_yl_team_serverlist','bid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_serverlist')." ADD   `bid` varchar(255) NOT NULL COMMENT '服务id'");}
if(!pdo_fieldexists('hyb_yl_team_serverlist','titlme')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_serverlist')." ADD   `titlme` varchar(255) NOT NULL COMMENT '标题'");}
if(!pdo_fieldexists('hyb_yl_team_serverlist','time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_serverlist')." ADD   `time` datetime NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_team_serverlist','time_leng')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_serverlist')." ADD   `time_leng` int(11) NOT NULL COMMENT '时长'");}
if(!pdo_fieldexists('hyb_yl_team_serverlist','ptmoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_serverlist')." ADD   `ptmoney` decimal(11,2) NOT NULL COMMENT '普通价格'");}
if(!pdo_fieldexists('hyb_yl_team_serverlist','hymoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_serverlist')." ADD   `hymoney` decimal(11,2) NOT NULL COMMENT '会员价格'");}
if(!pdo_fieldexists('hyb_yl_team_serverlist','hyzhuiw')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_serverlist')." ADD   `hyzhuiw` int(11) NOT NULL COMMENT '会员追加次数'");}
if(!pdo_fieldexists('hyb_yl_team_serverlist','ptzhuiw')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_serverlist')." ADD   `ptzhuiw` int(11) NOT NULL COMMENT '普通追加次数'");}
if(!pdo_fieldexists('hyb_yl_team_serverlist','stateback')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_serverlist')." ADD   `stateback` tinyint(2) NOT NULL COMMENT '状态（0：关闭；1：开启）'");}
if(!pdo_fieldexists('hyb_yl_team_serverlist','orders')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_serverlist')." ADD   `orders` varchar(50) NOT NULL COMMENT '订单号'");}
if(!pdo_fieldexists('hyb_yl_team_serverlist','overtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_serverlist')." ADD   `overtime` int(11) NOT NULL COMMENT '服务到期时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_team_serverlog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `tid` int(11) DEFAULT NULL COMMENT '团队id',
  `openid` varchar(255) DEFAULT NULL COMMENT '用户openid',
  `money` decimal(11,2) DEFAULT NULL COMMENT '金额',
  `key_words` varchar(255) DEFAULT NULL COMMENT '关键字',
  `bid` int(11) DEFAULT NULL COMMENT '服务id',
  `titlme` varchar(255) DEFAULT NULL COMMENT '服务名称',
  `time` datetime DEFAULT NULL COMMENT '开通时间',
  `time_leng` int(11) DEFAULT NULL COMMENT '开通时长',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：未支付；1：已支付）',
  `pay_time` int(11) DEFAULT NULL COMMENT '支付时间',
  `created` int(11) NOT NULL COMMENT '添加时间',
  `orders` varchar(255) DEFAULT NULL COMMENT '订单号',
  `back_orders` varchar(255) DEFAULT NULL COMMENT '同意订单号',
  `end_time` int(11) DEFAULT NULL COMMENT '到期时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='团队服务开通记录表';

");

if(!pdo_fieldexists('hyb_yl_team_serverlog','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_serverlog')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_team_serverlog','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_serverlog')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_team_serverlog','tid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_serverlog')." ADD   `tid` int(11) DEFAULT NULL COMMENT '团队id'");}
if(!pdo_fieldexists('hyb_yl_team_serverlog','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_serverlog')." ADD   `openid` varchar(255) DEFAULT NULL COMMENT '用户openid'");}
if(!pdo_fieldexists('hyb_yl_team_serverlog','money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_serverlog')." ADD   `money` decimal(11,2) DEFAULT NULL COMMENT '金额'");}
if(!pdo_fieldexists('hyb_yl_team_serverlog','key_words')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_serverlog')." ADD   `key_words` varchar(255) DEFAULT NULL COMMENT '关键字'");}
if(!pdo_fieldexists('hyb_yl_team_serverlog','bid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_serverlog')." ADD   `bid` int(11) DEFAULT NULL COMMENT '服务id'");}
if(!pdo_fieldexists('hyb_yl_team_serverlog','titlme')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_serverlog')." ADD   `titlme` varchar(255) DEFAULT NULL COMMENT '服务名称'");}
if(!pdo_fieldexists('hyb_yl_team_serverlog','time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_serverlog')." ADD   `time` datetime DEFAULT NULL COMMENT '开通时间'");}
if(!pdo_fieldexists('hyb_yl_team_serverlog','time_leng')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_serverlog')." ADD   `time_leng` int(11) DEFAULT NULL COMMENT '开通时长'");}
if(!pdo_fieldexists('hyb_yl_team_serverlog','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_serverlog')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：未支付；1：已支付）'");}
if(!pdo_fieldexists('hyb_yl_team_serverlog','pay_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_serverlog')." ADD   `pay_time` int(11) DEFAULT NULL COMMENT '支付时间'");}
if(!pdo_fieldexists('hyb_yl_team_serverlog','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_serverlog')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_team_serverlog','orders')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_serverlog')." ADD   `orders` varchar(255) DEFAULT NULL COMMENT '订单号'");}
if(!pdo_fieldexists('hyb_yl_team_serverlog','back_orders')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_serverlog')." ADD   `back_orders` varchar(255) DEFAULT NULL COMMENT '同意订单号'");}
if(!pdo_fieldexists('hyb_yl_team_serverlog','end_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_serverlog')." ADD   `end_time` int(11) DEFAULT NULL COMMENT '到期时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_team_tixian` (
  `id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `tid` int(11) NOT NULL COMMENT '团队id',
  `t_name` varchar(255) NOT NULL COMMENT '团队名称',
  `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '提现类型（0：团队提现）',
  `money` decimal(11,2) NOT NULL COMMENT '提现金额',
  `style` tinyint(2) NOT NULL COMMENT '提现方式（0：微信提现；1：支付宝提现）',
  `shouxufei` decimal(11,2) NOT NULL COMMENT '手续费',
  `dz_money` decimal(11,2) NOT NULL COMMENT '到账金额',
  `dz_type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '打款方式（0：微信；1：支付宝；2：现金）',
  `created` int(11) NOT NULL COMMENT '申请时间',
  `s_time` int(11) NOT NULL COMMENT '审核时间',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：待审核；1：待打款；2：已完成；3：未通过）',
  `d_time` int(11) NOT NULL COMMENT '打款时间',
  `openid` varchar(255) NOT NULL COMMENT '用户标识',
  `zid` int(11) NOT NULL COMMENT '专家id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='团队提现表';

");

if(!pdo_fieldexists('hyb_yl_team_tixian','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_tixian')." ADD 
  `id` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_team_tixian','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_tixian')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_team_tixian','tid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_tixian')." ADD   `tid` int(11) NOT NULL COMMENT '团队id'");}
if(!pdo_fieldexists('hyb_yl_team_tixian','t_name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_tixian')." ADD   `t_name` varchar(255) NOT NULL COMMENT '团队名称'");}
if(!pdo_fieldexists('hyb_yl_team_tixian','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_tixian')." ADD   `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '提现类型（0：团队提现）'");}
if(!pdo_fieldexists('hyb_yl_team_tixian','money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_tixian')." ADD   `money` decimal(11,2) NOT NULL COMMENT '提现金额'");}
if(!pdo_fieldexists('hyb_yl_team_tixian','style')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_tixian')." ADD   `style` tinyint(2) NOT NULL COMMENT '提现方式（0：微信提现；1：支付宝提现）'");}
if(!pdo_fieldexists('hyb_yl_team_tixian','shouxufei')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_tixian')." ADD   `shouxufei` decimal(11,2) NOT NULL COMMENT '手续费'");}
if(!pdo_fieldexists('hyb_yl_team_tixian','dz_money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_tixian')." ADD   `dz_money` decimal(11,2) NOT NULL COMMENT '到账金额'");}
if(!pdo_fieldexists('hyb_yl_team_tixian','dz_type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_tixian')." ADD   `dz_type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '打款方式（0：微信；1：支付宝；2：现金）'");}
if(!pdo_fieldexists('hyb_yl_team_tixian','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_tixian')." ADD   `created` int(11) NOT NULL COMMENT '申请时间'");}
if(!pdo_fieldexists('hyb_yl_team_tixian','s_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_tixian')." ADD   `s_time` int(11) NOT NULL COMMENT '审核时间'");}
if(!pdo_fieldexists('hyb_yl_team_tixian','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_tixian')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：待审核；1：待打款；2：已完成；3：未通过）'");}
if(!pdo_fieldexists('hyb_yl_team_tixian','d_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_tixian')." ADD   `d_time` int(11) NOT NULL COMMENT '打款时间'");}
if(!pdo_fieldexists('hyb_yl_team_tixian','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_tixian')." ADD   `openid` varchar(255) NOT NULL COMMENT '用户标识'");}
if(!pdo_fieldexists('hyb_yl_team_tixian','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_team_tixian')." ADD   `zid` int(11) NOT NULL COMMENT '专家id'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_teamment` (
  `g_id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `title` char(50) NOT NULL COMMENT '标题',
  `teamtext` text NOT NULL COMMENT '内容',
  `thumbarr` varchar(255) NOT NULL COMMENT '图片',
  `t_id` int(11) NOT NULL COMMENT '团队ID',
  `menttypes` int(11) NOT NULL COMMENT '0不置顶1置顶',
  `updateTime` int(11) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`g_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='团队公告表';

");

if(!pdo_fieldexists('hyb_yl_teamment','g_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_teamment')." ADD 
  `g_id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_teamment','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_teamment')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_teamment','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_teamment')." ADD   `title` char(50) NOT NULL COMMENT '标题'");}
if(!pdo_fieldexists('hyb_yl_teamment','teamtext')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_teamment')." ADD   `teamtext` text NOT NULL COMMENT '内容'");}
if(!pdo_fieldexists('hyb_yl_teamment','thumbarr')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_teamment')." ADD   `thumbarr` varchar(255) NOT NULL COMMENT '图片'");}
if(!pdo_fieldexists('hyb_yl_teamment','t_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_teamment')." ADD   `t_id` int(11) NOT NULL COMMENT '团队ID'");}
if(!pdo_fieldexists('hyb_yl_teamment','menttypes')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_teamment')." ADD   `menttypes` int(11) NOT NULL COMMENT '0不置顶1置顶'");}
if(!pdo_fieldexists('hyb_yl_teamment','updateTime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_teamment')." ADD   `updateTime` int(11) NOT NULL COMMENT '修改时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_teamorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `money` decimal(11,2) NOT NULL COMMENT '订单金额',
  `tid` int(11) NOT NULL COMMENT '团队id',
  `openid` varchar(255) NOT NULL COMMENT '用户openid',
  `created` int(11) NOT NULL COMMENT '下单时间',
  `start` varchar(255) DEFAULT NULL COMMENT '开始时间',
  `end` varchar(255) DEFAULT NULL COMMENT '结束时间',
  `back_orser` varchar(255) DEFAULT NULL COMMENT '统一订单号',
  `paytime` int(11) DEFAULT NULL COMMENT '支付时间',
  `coupon_id` int(11) DEFAULT NULL COMMENT '优惠券id',
  `ifpay` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0待支付1已支付2已完成3申请退款4退款成功5退款拒绝；6：用户取消；7：续签待支付',
  `j_id` int(11) NOT NULL COMMENT '建档id',
  `orders` varchar(255) NOT NULL COMMENT '订单号',
  `t_time` int(11) DEFAULT NULL COMMENT '退款时间',
  `y_money` decimal(11,2) DEFAULT NULL COMMENT '订单原价',
  `key_words` varchar(50) NOT NULL COMMENT '关键字',
  `overtime` int(11) NOT NULL COMMENT '订单结束时间',
  `ifgk` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否公开（0：否；1：是）',
  `role` tinyint(2) NOT NULL DEFAULT '0' COMMENT '身份（0：用户；1：团队）',
  `addnum` int(11) NOT NULL COMMENT '数量',
  `s_time` int(11) DEFAULT NULL COMMENT '退款审核时间',
  `qx_time` int(11) NOT NULL COMMENT '取消时间',
  `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '患者分组（0：签约患者；1：普通患者；2：年卡患者）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COMMENT='团队订单表';

");

if(!pdo_fieldexists('hyb_yl_teamorder','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_teamorder')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_teamorder','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_teamorder')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_teamorder','money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_teamorder')." ADD   `money` decimal(11,2) NOT NULL COMMENT '订单金额'");}
if(!pdo_fieldexists('hyb_yl_teamorder','tid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_teamorder')." ADD   `tid` int(11) NOT NULL COMMENT '团队id'");}
if(!pdo_fieldexists('hyb_yl_teamorder','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_teamorder')." ADD   `openid` varchar(255) NOT NULL COMMENT '用户openid'");}
if(!pdo_fieldexists('hyb_yl_teamorder','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_teamorder')." ADD   `created` int(11) NOT NULL COMMENT '下单时间'");}
if(!pdo_fieldexists('hyb_yl_teamorder','start')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_teamorder')." ADD   `start` varchar(255) DEFAULT NULL COMMENT '开始时间'");}
if(!pdo_fieldexists('hyb_yl_teamorder','end')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_teamorder')." ADD   `end` varchar(255) DEFAULT NULL COMMENT '结束时间'");}
if(!pdo_fieldexists('hyb_yl_teamorder','back_orser')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_teamorder')." ADD   `back_orser` varchar(255) DEFAULT NULL COMMENT '统一订单号'");}
if(!pdo_fieldexists('hyb_yl_teamorder','paytime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_teamorder')." ADD   `paytime` int(11) DEFAULT NULL COMMENT '支付时间'");}
if(!pdo_fieldexists('hyb_yl_teamorder','coupon_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_teamorder')." ADD   `coupon_id` int(11) DEFAULT NULL COMMENT '优惠券id'");}
if(!pdo_fieldexists('hyb_yl_teamorder','ifpay')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_teamorder')." ADD   `ifpay` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0待支付1已支付2已完成3申请退款4退款成功5退款拒绝；6：用户取消；7：续签待支付'");}
if(!pdo_fieldexists('hyb_yl_teamorder','j_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_teamorder')." ADD   `j_id` int(11) NOT NULL COMMENT '建档id'");}
if(!pdo_fieldexists('hyb_yl_teamorder','orders')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_teamorder')." ADD   `orders` varchar(255) NOT NULL COMMENT '订单号'");}
if(!pdo_fieldexists('hyb_yl_teamorder','t_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_teamorder')." ADD   `t_time` int(11) DEFAULT NULL COMMENT '退款时间'");}
if(!pdo_fieldexists('hyb_yl_teamorder','y_money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_teamorder')." ADD   `y_money` decimal(11,2) DEFAULT NULL COMMENT '订单原价'");}
if(!pdo_fieldexists('hyb_yl_teamorder','key_words')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_teamorder')." ADD   `key_words` varchar(50) NOT NULL COMMENT '关键字'");}
if(!pdo_fieldexists('hyb_yl_teamorder','overtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_teamorder')." ADD   `overtime` int(11) NOT NULL COMMENT '订单结束时间'");}
if(!pdo_fieldexists('hyb_yl_teamorder','ifgk')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_teamorder')." ADD   `ifgk` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否公开（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_teamorder','role')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_teamorder')." ADD   `role` tinyint(2) NOT NULL DEFAULT '0' COMMENT '身份（0：用户；1：团队）'");}
if(!pdo_fieldexists('hyb_yl_teamorder','addnum')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_teamorder')." ADD   `addnum` int(11) NOT NULL COMMENT '数量'");}
if(!pdo_fieldexists('hyb_yl_teamorder','s_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_teamorder')." ADD   `s_time` int(11) DEFAULT NULL COMMENT '退款审核时间'");}
if(!pdo_fieldexists('hyb_yl_teamorder','qx_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_teamorder')." ADD   `qx_time` int(11) NOT NULL COMMENT '取消时间'");}
if(!pdo_fieldexists('hyb_yl_teamorder','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_teamorder')." ADD   `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '患者分组（0：签约患者；1：普通患者；2：年卡患者）'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_tijian_crowd` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL COMMENT '名称',
  `created` int(11) NOT NULL COMMENT '添加时间',
  `status` tinyint(2) NOT NULL COMMENT '状态（0：隐藏；1：显示）',
  `icon` varchar(255) NOT NULL COMMENT '人群分类icon',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='体检适合人群列表';

");

if(!pdo_fieldexists('hyb_yl_tijian_crowd','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijian_crowd')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_tijian_crowd','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijian_crowd')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_tijian_crowd','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijian_crowd')." ADD   `title` varchar(255) NOT NULL COMMENT '名称'");}
if(!pdo_fieldexists('hyb_yl_tijian_crowd','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijian_crowd')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_tijian_crowd','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijian_crowd')." ADD   `status` tinyint(2) NOT NULL COMMENT '状态（0：隐藏；1：显示）'");}
if(!pdo_fieldexists('hyb_yl_tijian_crowd','icon')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijian_crowd')." ADD   `icon` varchar(255) NOT NULL COMMENT '人群分类icon'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_tijian_moban` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '体检模板id',
  `uniacid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL COMMENT '模板标题',
  `type` varchar(255) NOT NULL COMMENT '模板类型',
  `created` int(11) NOT NULL COMMENT '添加时间',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态（0：禁用；1：启用）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='体检模板表';

");

if(!pdo_fieldexists('hyb_yl_tijian_moban','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijian_moban')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '体检模板id'");}
if(!pdo_fieldexists('hyb_yl_tijian_moban','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijian_moban')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_tijian_moban','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijian_moban')." ADD   `title` varchar(255) NOT NULL COMMENT '模板标题'");}
if(!pdo_fieldexists('hyb_yl_tijian_moban','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijian_moban')." ADD   `type` varchar(255) NOT NULL COMMENT '模板类型'");}
if(!pdo_fieldexists('hyb_yl_tijian_moban','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijian_moban')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_tijian_moban','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijian_moban')." ADD   `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态（0：禁用；1：启用）'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_tijian_project` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '体检项目id',
  `uniacid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL COMMENT '标题',
  `english` varchar(255) NOT NULL COMMENT '英文缩写',
  `min` varchar(50) NOT NULL COMMENT '最小值',
  `max` varchar(50) NOT NULL COMMENT '最大值',
  `unit` varchar(255) NOT NULL COMMENT '单位',
  `content` varchar(255) NOT NULL COMMENT '说明',
  `price` decimal(11,2) NOT NULL COMMENT '价格',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态（0：禁用；1：启用）',
  `created` int(11) NOT NULL COMMENT '添加时间',
  `m_id` int(11) NOT NULL COMMENT '模板id',
  `destic` varchar(255) NOT NULL COMMENT '检查项包含内容',
  `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1套餐包含项目2附加检查项目',
  `text` varchar(20) NOT NULL COMMENT '超过提示信息',
  `text2` varchar(20) NOT NULL COMMENT '未超过',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='模板项目表';

");

if(!pdo_fieldexists('hyb_yl_tijian_project','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijian_project')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '体检项目id'");}
if(!pdo_fieldexists('hyb_yl_tijian_project','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijian_project')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_tijian_project','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijian_project')." ADD   `title` varchar(255) NOT NULL COMMENT '标题'");}
if(!pdo_fieldexists('hyb_yl_tijian_project','english')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijian_project')." ADD   `english` varchar(255) NOT NULL COMMENT '英文缩写'");}
if(!pdo_fieldexists('hyb_yl_tijian_project','min')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijian_project')." ADD   `min` varchar(50) NOT NULL COMMENT '最小值'");}
if(!pdo_fieldexists('hyb_yl_tijian_project','max')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijian_project')." ADD   `max` varchar(50) NOT NULL COMMENT '最大值'");}
if(!pdo_fieldexists('hyb_yl_tijian_project','unit')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijian_project')." ADD   `unit` varchar(255) NOT NULL COMMENT '单位'");}
if(!pdo_fieldexists('hyb_yl_tijian_project','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijian_project')." ADD   `content` varchar(255) NOT NULL COMMENT '说明'");}
if(!pdo_fieldexists('hyb_yl_tijian_project','price')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijian_project')." ADD   `price` decimal(11,2) NOT NULL COMMENT '价格'");}
if(!pdo_fieldexists('hyb_yl_tijian_project','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijian_project')." ADD   `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态（0：禁用；1：启用）'");}
if(!pdo_fieldexists('hyb_yl_tijian_project','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijian_project')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_tijian_project','m_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijian_project')." ADD   `m_id` int(11) NOT NULL COMMENT '模板id'");}
if(!pdo_fieldexists('hyb_yl_tijian_project','destic')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijian_project')." ADD   `destic` varchar(255) NOT NULL COMMENT '检查项包含内容'");}
if(!pdo_fieldexists('hyb_yl_tijian_project','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijian_project')." ADD   `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1套餐包含项目2附加检查项目'");}
if(!pdo_fieldexists('hyb_yl_tijian_project','text')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijian_project')." ADD   `text` varchar(20) NOT NULL COMMENT '超过提示信息'");}
if(!pdo_fieldexists('hyb_yl_tijian_project','text2')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijian_project')." ADD   `text2` varchar(20) NOT NULL COMMENT '未超过'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_tijian_rule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `num` int(11) NOT NULL COMMENT '体检首页',
  `is_chuan` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否允许上传套餐（0：否；1：是）',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启审核（0：否；1：是）',
  `created` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_tijian_rule','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijian_rule')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_tijian_rule','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijian_rule')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_tijian_rule','num')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijian_rule')." ADD   `num` int(11) NOT NULL COMMENT '体检首页'");}
if(!pdo_fieldexists('hyb_yl_tijian_rule','is_chuan')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijian_rule')." ADD   `is_chuan` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否允许上传套餐（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_tijian_rule','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijian_rule')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启审核（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_tijian_rule','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijian_rule')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_tijianorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `j_id` int(11) NOT NULL COMMENT '家人Id',
  `money` float(8,2) NOT NULL COMMENT '订单金额',
  `content` text NOT NULL COMMENT '体检内容',
  `bm_id` int(11) NOT NULL COMMENT '体检部门id',
  `time` int(11) NOT NULL COMMENT '创建时间',
  `ordernums` varchar(50) NOT NULL COMMENT '订单号',
  `ifpay` int(11) NOT NULL COMMENT '0待支付1已支付待接诊2接诊中3已完成4待评价5已评价6：申请退款；7：同意退款；8：拒绝退款',
  `yy_time` varchar(255) NOT NULL COMMENT '预约时间',
  `tid` int(11) NOT NULL COMMENT '套餐id',
  `openid` varchar(255) NOT NULL COMMENT 'x下单人',
  `addproject` text NOT NULL COMMENT '加包项',
  `pdf` varchar(255) NOT NULL COMMENT 'pdf',
  `paytime` int(11) NOT NULL COMMENT '支付时间',
  `overtime` int(12) NOT NULL COMMENT '订单过期时间',
  `wactime` datetime NOT NULL COMMENT '报告生成时间',
  `ifover` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0未生成1已生成报告',
  `wzid` int(11) NOT NULL DEFAULT '0' COMMENT '问诊id',
  `zid` int(11) NOT NULL COMMENT '专家id',
  `jdtime` datetime NOT NULL COMMENT '解读完成时间',
  `professional` int(20) NOT NULL DEFAULT '0' COMMENT '查看人数',
  `ifjd` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0为解读1已解读',
  `role` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0一级订单1二次追问订单',
  `data` text NOT NULL COMMENT '专家建议',
  `ifgb` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0未取消1已取消',
  `jztime` datetime NOT NULL COMMENT '接诊时间',
  `imgpath` varchar(255) NOT NULL COMMENT '报告',
  `tk_one` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '二级推客抽成',
  `tk_two` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '一级推客抽成',
  `ptmoney` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '平台抽成',
  `card_dk` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '会员卡抵扣',
  `old_price` decimal(11,2) NOT NULL COMMENT '订单原价',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COMMENT='体检订单表';

");

if(!pdo_fieldexists('hyb_yl_tijianorder','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijianorder')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_tijianorder','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijianorder')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_tijianorder','j_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijianorder')." ADD   `j_id` int(11) NOT NULL COMMENT '家人Id'");}
if(!pdo_fieldexists('hyb_yl_tijianorder','money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijianorder')." ADD   `money` float(8,2) NOT NULL COMMENT '订单金额'");}
if(!pdo_fieldexists('hyb_yl_tijianorder','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijianorder')." ADD   `content` text NOT NULL COMMENT '体检内容'");}
if(!pdo_fieldexists('hyb_yl_tijianorder','bm_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijianorder')." ADD   `bm_id` int(11) NOT NULL COMMENT '体检部门id'");}
if(!pdo_fieldexists('hyb_yl_tijianorder','time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijianorder')." ADD   `time` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('hyb_yl_tijianorder','ordernums')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijianorder')." ADD   `ordernums` varchar(50) NOT NULL COMMENT '订单号'");}
if(!pdo_fieldexists('hyb_yl_tijianorder','ifpay')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijianorder')." ADD   `ifpay` int(11) NOT NULL COMMENT '0待支付1已支付待接诊2接诊中3已完成4待评价5已评价6：申请退款；7：同意退款；8：拒绝退款'");}
if(!pdo_fieldexists('hyb_yl_tijianorder','yy_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijianorder')." ADD   `yy_time` varchar(255) NOT NULL COMMENT '预约时间'");}
if(!pdo_fieldexists('hyb_yl_tijianorder','tid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijianorder')." ADD   `tid` int(11) NOT NULL COMMENT '套餐id'");}
if(!pdo_fieldexists('hyb_yl_tijianorder','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijianorder')." ADD   `openid` varchar(255) NOT NULL COMMENT 'x下单人'");}
if(!pdo_fieldexists('hyb_yl_tijianorder','addproject')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijianorder')." ADD   `addproject` text NOT NULL COMMENT '加包项'");}
if(!pdo_fieldexists('hyb_yl_tijianorder','pdf')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijianorder')." ADD   `pdf` varchar(255) NOT NULL COMMENT 'pdf'");}
if(!pdo_fieldexists('hyb_yl_tijianorder','paytime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijianorder')." ADD   `paytime` int(11) NOT NULL COMMENT '支付时间'");}
if(!pdo_fieldexists('hyb_yl_tijianorder','overtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijianorder')." ADD   `overtime` int(12) NOT NULL COMMENT '订单过期时间'");}
if(!pdo_fieldexists('hyb_yl_tijianorder','wactime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijianorder')." ADD   `wactime` datetime NOT NULL COMMENT '报告生成时间'");}
if(!pdo_fieldexists('hyb_yl_tijianorder','ifover')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijianorder')." ADD   `ifover` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0未生成1已生成报告'");}
if(!pdo_fieldexists('hyb_yl_tijianorder','wzid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijianorder')." ADD   `wzid` int(11) NOT NULL DEFAULT '0' COMMENT '问诊id'");}
if(!pdo_fieldexists('hyb_yl_tijianorder','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijianorder')." ADD   `zid` int(11) NOT NULL COMMENT '专家id'");}
if(!pdo_fieldexists('hyb_yl_tijianorder','jdtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijianorder')." ADD   `jdtime` datetime NOT NULL COMMENT '解读完成时间'");}
if(!pdo_fieldexists('hyb_yl_tijianorder','professional')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijianorder')." ADD   `professional` int(20) NOT NULL DEFAULT '0' COMMENT '查看人数'");}
if(!pdo_fieldexists('hyb_yl_tijianorder','ifjd')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijianorder')." ADD   `ifjd` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0为解读1已解读'");}
if(!pdo_fieldexists('hyb_yl_tijianorder','role')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijianorder')." ADD   `role` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0一级订单1二次追问订单'");}
if(!pdo_fieldexists('hyb_yl_tijianorder','data')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijianorder')." ADD   `data` text NOT NULL COMMENT '专家建议'");}
if(!pdo_fieldexists('hyb_yl_tijianorder','ifgb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijianorder')." ADD   `ifgb` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0未取消1已取消'");}
if(!pdo_fieldexists('hyb_yl_tijianorder','jztime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijianorder')." ADD   `jztime` datetime NOT NULL COMMENT '接诊时间'");}
if(!pdo_fieldexists('hyb_yl_tijianorder','imgpath')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijianorder')." ADD   `imgpath` varchar(255) NOT NULL COMMENT '报告'");}
if(!pdo_fieldexists('hyb_yl_tijianorder','tk_one')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijianorder')." ADD   `tk_one` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '二级推客抽成'");}
if(!pdo_fieldexists('hyb_yl_tijianorder','tk_two')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijianorder')." ADD   `tk_two` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '一级推客抽成'");}
if(!pdo_fieldexists('hyb_yl_tijianorder','ptmoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijianorder')." ADD   `ptmoney` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '平台抽成'");}
if(!pdo_fieldexists('hyb_yl_tijianorder','card_dk')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijianorder')." ADD   `card_dk` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '会员卡抵扣'");}
if(!pdo_fieldexists('hyb_yl_tijianorder','old_price')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tijianorder')." ADD   `old_price` decimal(11,2) NOT NULL COMMENT '订单原价'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_tjyytime` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `z_pid` int(11) DEFAULT NULL COMMENT '科室ID',
  `shengyunus` varchar(255) DEFAULT NULL COMMENT '剩余数量',
  `m_money` varchar(255) DEFAULT NULL COMMENT '价格',
  `nums` varchar(255) DEFAULT NULL COMMENT '总数量',
  `time` varchar(255) DEFAULT NULL COMMENT 't添加时间',
  `text` longtext NOT NULL,
  `week` varchar(255) NOT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_tjyytime','tid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tjyytime')." ADD 
  `tid` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_tjyytime','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tjyytime')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_tjyytime','z_pid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tjyytime')." ADD   `z_pid` int(11) DEFAULT NULL COMMENT '科室ID'");}
if(!pdo_fieldexists('hyb_yl_tjyytime','shengyunus')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tjyytime')." ADD   `shengyunus` varchar(255) DEFAULT NULL COMMENT '剩余数量'");}
if(!pdo_fieldexists('hyb_yl_tjyytime','m_money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tjyytime')." ADD   `m_money` varchar(255) DEFAULT NULL COMMENT '价格'");}
if(!pdo_fieldexists('hyb_yl_tjyytime','nums')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tjyytime')." ADD   `nums` varchar(255) DEFAULT NULL COMMENT '总数量'");}
if(!pdo_fieldexists('hyb_yl_tjyytime','time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tjyytime')." ADD   `time` varchar(255) DEFAULT NULL COMMENT 't添加时间'");}
if(!pdo_fieldexists('hyb_yl_tjyytime','text')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tjyytime')." ADD   `text` longtext NOT NULL");}
if(!pdo_fieldexists('hyb_yl_tjyytime','week')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tjyytime')." ADD   `week` varchar(255) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_tstype` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL COMMENT '标题',
  `money` decimal(11,2) NOT NULL COMMENT '普通金额',
  `thumb` varchar(255) NOT NULL COMMENT '缩略图',
  `vip_money` decimal(11,2) NOT NULL COMMENT '会员金额',
  `created` int(11) NOT NULL COMMENT '添加时间',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态（0：隐藏；1：显示）',
  `sort` int(11) DEFAULT NULL COMMENT '排序',
  `type` varchar(255) NOT NULL COMMENT '类型',
  `url` varchar(255) NOT NULL COMMENT '连接地址',
  `pid` int(11) NOT NULL COMMENT '上级id',
  `keyword` varchar(255) NOT NULL COMMENT '关键词',
  `content` varchar(255) NOT NULL COMMENT '简介',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='绿通类型';

");

if(!pdo_fieldexists('hyb_yl_tstype','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tstype')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_tstype','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tstype')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_tstype','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tstype')." ADD   `title` varchar(255) NOT NULL COMMENT '标题'");}
if(!pdo_fieldexists('hyb_yl_tstype','money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tstype')." ADD   `money` decimal(11,2) NOT NULL COMMENT '普通金额'");}
if(!pdo_fieldexists('hyb_yl_tstype','thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tstype')." ADD   `thumb` varchar(255) NOT NULL COMMENT '缩略图'");}
if(!pdo_fieldexists('hyb_yl_tstype','vip_money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tstype')." ADD   `vip_money` decimal(11,2) NOT NULL COMMENT '会员金额'");}
if(!pdo_fieldexists('hyb_yl_tstype','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tstype')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_tstype','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tstype')." ADD   `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态（0：隐藏；1：显示）'");}
if(!pdo_fieldexists('hyb_yl_tstype','sort')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tstype')." ADD   `sort` int(11) DEFAULT NULL COMMENT '排序'");}
if(!pdo_fieldexists('hyb_yl_tstype','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tstype')." ADD   `type` varchar(255) NOT NULL COMMENT '类型'");}
if(!pdo_fieldexists('hyb_yl_tstype','url')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tstype')." ADD   `url` varchar(255) NOT NULL COMMENT '连接地址'");}
if(!pdo_fieldexists('hyb_yl_tstype','pid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tstype')." ADD   `pid` int(11) NOT NULL COMMENT '上级id'");}
if(!pdo_fieldexists('hyb_yl_tstype','keyword')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tstype')." ADD   `keyword` varchar(255) NOT NULL COMMENT '关键词'");}
if(!pdo_fieldexists('hyb_yl_tstype','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tstype')." ADD   `content` varchar(255) NOT NULL COMMENT '简介'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_tuiguanglog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `type` tinyint(11) NOT NULL COMMENT '1人数2患者3机构4进入专家主页5问诊',
  `content` varchar(255) NOT NULL COMMENT '推广介绍',
  `tgtime` int(11) NOT NULL COMMENT '推广时间',
  `openid` varchar(255) NOT NULL,
  `tkid` int(11) NOT NULL DEFAULT '0' COMMENT '一级',
  `zid` int(11) NOT NULL COMMENT '专家id',
  `mytkid` int(11) NOT NULL COMMENT '二级',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_tuiguanglog','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuiguanglog')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_tuiguanglog','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuiguanglog')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_tuiguanglog','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuiguanglog')." ADD   `type` tinyint(11) NOT NULL COMMENT '1人数2患者3机构4进入专家主页5问诊'");}
if(!pdo_fieldexists('hyb_yl_tuiguanglog','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuiguanglog')." ADD   `content` varchar(255) NOT NULL COMMENT '推广介绍'");}
if(!pdo_fieldexists('hyb_yl_tuiguanglog','tgtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuiguanglog')." ADD   `tgtime` int(11) NOT NULL COMMENT '推广时间'");}
if(!pdo_fieldexists('hyb_yl_tuiguanglog','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuiguanglog')." ADD   `openid` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_tuiguanglog','tkid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuiguanglog')." ADD   `tkid` int(11) NOT NULL DEFAULT '0' COMMENT '一级'");}
if(!pdo_fieldexists('hyb_yl_tuiguanglog','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuiguanglog')." ADD   `zid` int(11) NOT NULL COMMENT '专家id'");}
if(!pdo_fieldexists('hyb_yl_tuiguanglog','mytkid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuiguanglog')." ADD   `mytkid` int(11) NOT NULL COMMENT '二级'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_tuihospital` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `hid` int(11) NOT NULL COMMENT '机构id',
  `openid` varchar(255) NOT NULL COMMENT 'y用户',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `shar_num` int(10) unsigned NOT NULL DEFAULT '1' COMMENT 'f分享总数',
  `useropenid` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0未入住1已入驻',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('hyb_yl_tuihospital','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuihospital')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_tuihospital','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuihospital')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_tuihospital','hid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuihospital')." ADD   `hid` int(11) NOT NULL COMMENT '机构id'");}
if(!pdo_fieldexists('hyb_yl_tuihospital','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuihospital')." ADD   `openid` varchar(255) NOT NULL COMMENT 'y用户'");}
if(!pdo_fieldexists('hyb_yl_tuihospital','addtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuihospital')." ADD   `addtime` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_tuihospital','shar_num')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuihospital')." ADD   `shar_num` int(10) unsigned NOT NULL DEFAULT '1' COMMENT 'f分享总数'");}
if(!pdo_fieldexists('hyb_yl_tuihospital','useropenid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuihospital')." ADD   `useropenid` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_tuihospital','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuihospital')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0未入住1已入驻'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_tuike_roul` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `switch` tinyint(2) NOT NULL COMMENT '是否开启（0：否；1：是）',
  `mode` tinyint(2) NOT NULL COMMENT '分销模式（0：全名分销；1：渠道分销）',
  `ranknum` tinyint(2) NOT NULL COMMENT '分销层级',
  `levelshow` tinyint(2) NOT NULL COMMENT '分销等级设置（0：隐藏；1：展示）',
  `seetstatus` tinyint(2) NOT NULL COMMENT '付费申请分销商结算方向（0：结算给代理；1：结算给平台）',
  `slide_thumb` varchar(255) NOT NULL COMMENT '幻灯片',
  `lowestmoney` float(8,2) NOT NULL COMMENT '最低提现金额',
  `frequency` int(11) NOT NULL COMMENT '提现频次',
  `withdrawcharge` int(11) NOT NULL COMMENT '提现手续费',
  `appdis` tinyint(3) NOT NULL COMMENT '分销商条件',
  `applymoney` float(8,2) NOT NULL COMMENT '一级',
  `modeonemoney` int(8) NOT NULL COMMENT '一级分销商获得佣金',
  `modetwomoney` int(8) NOT NULL COMMENT '二级分销商获得佣金',
  `examine` tinyint(2) NOT NULL COMMENT '是否审核(1：需要；0：不需要）',
  `twoappdis` tinyint(3) NOT NULL COMMENT '二级分销商条件',
  `twoapplymoney` float(8,2) NOT NULL COMMENT '二级付费金额',
  `onegetmoney` int(8) NOT NULL COMMENT '一级分销商获得佣金',
  `twoexamine` tinyint(2) NOT NULL COMMENT '二级是否审核(1：需要；0：不需要）',
  `bindvip` tinyint(3) NOT NULL COMMENT '分销商必须开通会员（0：关闭；1：全体分销商；2：仅申请的分销商）',
  `lockstatus` tinyint(2) NOT NULL COMMENT '绑定上下级关系条件(0：扫码立即绑定；1：第一次产生分销订单支付后绑定）',
  `showlock` tinyint(2) NOT NULL COMMENT '是否显示未锁定下级(0：隐藏；1：显示）',
  `distributor_description` varchar(255) NOT NULL COMMENT '分销商说明',
  `content` text NOT NULL COMMENT '推客协议',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='推客设置表';

");

if(!pdo_fieldexists('hyb_yl_tuike_roul','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuike_roul')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_tuike_roul','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuike_roul')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_tuike_roul','switch')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuike_roul')." ADD   `switch` tinyint(2) NOT NULL COMMENT '是否开启（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_tuike_roul','mode')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuike_roul')." ADD   `mode` tinyint(2) NOT NULL COMMENT '分销模式（0：全名分销；1：渠道分销）'");}
if(!pdo_fieldexists('hyb_yl_tuike_roul','ranknum')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuike_roul')." ADD   `ranknum` tinyint(2) NOT NULL COMMENT '分销层级'");}
if(!pdo_fieldexists('hyb_yl_tuike_roul','levelshow')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuike_roul')." ADD   `levelshow` tinyint(2) NOT NULL COMMENT '分销等级设置（0：隐藏；1：展示）'");}
if(!pdo_fieldexists('hyb_yl_tuike_roul','seetstatus')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuike_roul')." ADD   `seetstatus` tinyint(2) NOT NULL COMMENT '付费申请分销商结算方向（0：结算给代理；1：结算给平台）'");}
if(!pdo_fieldexists('hyb_yl_tuike_roul','slide_thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuike_roul')." ADD   `slide_thumb` varchar(255) NOT NULL COMMENT '幻灯片'");}
if(!pdo_fieldexists('hyb_yl_tuike_roul','lowestmoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuike_roul')." ADD   `lowestmoney` float(8,2) NOT NULL COMMENT '最低提现金额'");}
if(!pdo_fieldexists('hyb_yl_tuike_roul','frequency')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuike_roul')." ADD   `frequency` int(11) NOT NULL COMMENT '提现频次'");}
if(!pdo_fieldexists('hyb_yl_tuike_roul','withdrawcharge')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuike_roul')." ADD   `withdrawcharge` int(11) NOT NULL COMMENT '提现手续费'");}
if(!pdo_fieldexists('hyb_yl_tuike_roul','appdis')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuike_roul')." ADD   `appdis` tinyint(3) NOT NULL COMMENT '分销商条件'");}
if(!pdo_fieldexists('hyb_yl_tuike_roul','applymoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuike_roul')." ADD   `applymoney` float(8,2) NOT NULL COMMENT '一级'");}
if(!pdo_fieldexists('hyb_yl_tuike_roul','modeonemoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuike_roul')." ADD   `modeonemoney` int(8) NOT NULL COMMENT '一级分销商获得佣金'");}
if(!pdo_fieldexists('hyb_yl_tuike_roul','modetwomoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuike_roul')." ADD   `modetwomoney` int(8) NOT NULL COMMENT '二级分销商获得佣金'");}
if(!pdo_fieldexists('hyb_yl_tuike_roul','examine')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuike_roul')." ADD   `examine` tinyint(2) NOT NULL COMMENT '是否审核(1：需要；0：不需要）'");}
if(!pdo_fieldexists('hyb_yl_tuike_roul','twoappdis')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuike_roul')." ADD   `twoappdis` tinyint(3) NOT NULL COMMENT '二级分销商条件'");}
if(!pdo_fieldexists('hyb_yl_tuike_roul','twoapplymoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuike_roul')." ADD   `twoapplymoney` float(8,2) NOT NULL COMMENT '二级付费金额'");}
if(!pdo_fieldexists('hyb_yl_tuike_roul','onegetmoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuike_roul')." ADD   `onegetmoney` int(8) NOT NULL COMMENT '一级分销商获得佣金'");}
if(!pdo_fieldexists('hyb_yl_tuike_roul','twoexamine')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuike_roul')." ADD   `twoexamine` tinyint(2) NOT NULL COMMENT '二级是否审核(1：需要；0：不需要）'");}
if(!pdo_fieldexists('hyb_yl_tuike_roul','bindvip')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuike_roul')." ADD   `bindvip` tinyint(3) NOT NULL COMMENT '分销商必须开通会员（0：关闭；1：全体分销商；2：仅申请的分销商）'");}
if(!pdo_fieldexists('hyb_yl_tuike_roul','lockstatus')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuike_roul')." ADD   `lockstatus` tinyint(2) NOT NULL COMMENT '绑定上下级关系条件(0：扫码立即绑定；1：第一次产生分销订单支付后绑定）'");}
if(!pdo_fieldexists('hyb_yl_tuike_roul','showlock')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuike_roul')." ADD   `showlock` tinyint(2) NOT NULL COMMENT '是否显示未锁定下级(0：隐藏；1：显示）'");}
if(!pdo_fieldexists('hyb_yl_tuike_roul','distributor_description')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuike_roul')." ADD   `distributor_description` varchar(255) NOT NULL COMMENT '分销商说明'");}
if(!pdo_fieldexists('hyb_yl_tuike_roul','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuike_roul')." ADD   `content` text NOT NULL COMMENT '推客协议'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_tuike_tixian_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `txprice` float(10,2) NOT NULL COMMENT '提现金额',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0审核中1审核通过2审核拒绝',
  `tkid` int(11) NOT NULL COMMENT '推客id',
  `addtime` datetime NOT NULL COMMENT '添加时间',
  `tgtime` datetime NOT NULL COMMENT '审核时间',
  `leixing` tinyint(3) NOT NULL DEFAULT '0' COMMENT '0微信1支付宝2银行卡',
  `haoma` varchar(255) NOT NULL COMMENT '支付宝账号 银行卡帐号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('hyb_yl_tuike_tixian_log','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuike_tixian_log')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_tuike_tixian_log','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuike_tixian_log')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_tuike_tixian_log','txprice')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuike_tixian_log')." ADD   `txprice` float(10,2) NOT NULL COMMENT '提现金额'");}
if(!pdo_fieldexists('hyb_yl_tuike_tixian_log','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuike_tixian_log')." ADD   `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0审核中1审核通过2审核拒绝'");}
if(!pdo_fieldexists('hyb_yl_tuike_tixian_log','tkid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuike_tixian_log')." ADD   `tkid` int(11) NOT NULL COMMENT '推客id'");}
if(!pdo_fieldexists('hyb_yl_tuike_tixian_log','addtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuike_tixian_log')." ADD   `addtime` datetime NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_tuike_tixian_log','tgtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuike_tixian_log')." ADD   `tgtime` datetime NOT NULL COMMENT '审核时间'");}
if(!pdo_fieldexists('hyb_yl_tuike_tixian_log','leixing')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuike_tixian_log')." ADD   `leixing` tinyint(3) NOT NULL DEFAULT '0' COMMENT '0微信1支付宝2银行卡'");}
if(!pdo_fieldexists('hyb_yl_tuike_tixian_log','haoma')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuike_tixian_log')." ADD   `haoma` varchar(255) NOT NULL COMMENT '支付宝账号 银行卡帐号'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_tuikedoc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `openid` varchar(255) NOT NULL COMMENT '用户openid',
  `zid` int(11) NOT NULL COMMENT 'z专家id',
  `erweima` varchar(255) NOT NULL COMMENT '二维码',
  `addtime` datetime NOT NULL COMMENT '添加时间',
  `haibao` varchar(255) NOT NULL COMMENT '海报',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

");

if(!pdo_fieldexists('hyb_yl_tuikedoc','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuikedoc')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_tuikedoc','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuikedoc')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_tuikedoc','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuikedoc')." ADD   `openid` varchar(255) NOT NULL COMMENT '用户openid'");}
if(!pdo_fieldexists('hyb_yl_tuikedoc','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuikedoc')." ADD   `zid` int(11) NOT NULL COMMENT 'z专家id'");}
if(!pdo_fieldexists('hyb_yl_tuikedoc','erweima')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuikedoc')." ADD   `erweima` varchar(255) NOT NULL COMMENT '二维码'");}
if(!pdo_fieldexists('hyb_yl_tuikedoc','addtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuikedoc')." ADD   `addtime` datetime NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_tuikedoc','haibao')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuikedoc')." ADD   `haibao` varchar(255) NOT NULL COMMENT '海报'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_tuikeshouyi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `tkid` int(11) NOT NULL COMMENT '一级',
  `money` float(11,2) NOT NULL COMMENT '金额',
  `addtime` datetime NOT NULL COMMENT 't添加时间',
  `xjid` int(11) NOT NULL COMMENT '分销id',
  `over` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0申请中1已通过',
  `mytkid` int(11) NOT NULL COMMENT '二级',
  `leixing` varchar(255) NOT NULL COMMENT 'l类型',
  `orders` varchar(255) NOT NULL COMMENT 'd订单号',
  `paymoney` float(8,2) NOT NULL COMMENT 'z支付金额',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COMMENT='推客收益表';

");

if(!pdo_fieldexists('hyb_yl_tuikeshouyi','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuikeshouyi')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_tuikeshouyi','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuikeshouyi')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_tuikeshouyi','tkid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuikeshouyi')." ADD   `tkid` int(11) NOT NULL COMMENT '一级'");}
if(!pdo_fieldexists('hyb_yl_tuikeshouyi','money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuikeshouyi')." ADD   `money` float(11,2) NOT NULL COMMENT '金额'");}
if(!pdo_fieldexists('hyb_yl_tuikeshouyi','addtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuikeshouyi')." ADD   `addtime` datetime NOT NULL COMMENT 't添加时间'");}
if(!pdo_fieldexists('hyb_yl_tuikeshouyi','xjid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuikeshouyi')." ADD   `xjid` int(11) NOT NULL COMMENT '分销id'");}
if(!pdo_fieldexists('hyb_yl_tuikeshouyi','over')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuikeshouyi')." ADD   `over` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0申请中1已通过'");}
if(!pdo_fieldexists('hyb_yl_tuikeshouyi','mytkid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuikeshouyi')." ADD   `mytkid` int(11) NOT NULL COMMENT '二级'");}
if(!pdo_fieldexists('hyb_yl_tuikeshouyi','leixing')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuikeshouyi')." ADD   `leixing` varchar(255) NOT NULL COMMENT 'l类型'");}
if(!pdo_fieldexists('hyb_yl_tuikeshouyi','orders')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuikeshouyi')." ADD   `orders` varchar(255) NOT NULL COMMENT 'd订单号'");}
if(!pdo_fieldexists('hyb_yl_tuikeshouyi','paymoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuikeshouyi')." ADD   `paymoney` float(8,2) NOT NULL COMMENT 'z支付金额'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_tuikesite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL COMMENT '昵称',
  `tel` varchar(50) NOT NULL COMMENT '联系电话',
  `address` text NOT NULL COMMENT 's所在地',
  `state` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0待审核1审核通过2审核失败',
  `openid` varchar(255) NOT NULL COMMENT 'y用户openid',
  `addtime` datetime NOT NULL COMMENT '添加时间',
  `shtime` datetime NOT NULL COMMENT '审核时间',
  `erweima` varchar(255) NOT NULL COMMENT 'e二维码',
  `tkid` int(11) NOT NULL DEFAULT '0' COMMENT '推客id',
  `leve` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0自己1一级2二级',
  `countmoney` float(9,2) NOT NULL COMMENT '总收益',
  `money` float(10,2) NOT NULL COMMENT '入驻金额',
  `source` tinyint(3) NOT NULL DEFAULT '0' COMMENT '0自己申请1扫码2平台',
  `reason` varchar(255) NOT NULL COMMENT '操作原因',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COMMENT='推客表';

");

if(!pdo_fieldexists('hyb_yl_tuikesite','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuikesite')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_tuikesite','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuikesite')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_tuikesite','username')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuikesite')." ADD   `username` varchar(255) NOT NULL COMMENT '昵称'");}
if(!pdo_fieldexists('hyb_yl_tuikesite','tel')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuikesite')." ADD   `tel` varchar(50) NOT NULL COMMENT '联系电话'");}
if(!pdo_fieldexists('hyb_yl_tuikesite','address')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuikesite')." ADD   `address` text NOT NULL COMMENT 's所在地'");}
if(!pdo_fieldexists('hyb_yl_tuikesite','state')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuikesite')." ADD   `state` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0待审核1审核通过2审核失败'");}
if(!pdo_fieldexists('hyb_yl_tuikesite','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuikesite')." ADD   `openid` varchar(255) NOT NULL COMMENT 'y用户openid'");}
if(!pdo_fieldexists('hyb_yl_tuikesite','addtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuikesite')." ADD   `addtime` datetime NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_tuikesite','shtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuikesite')." ADD   `shtime` datetime NOT NULL COMMENT '审核时间'");}
if(!pdo_fieldexists('hyb_yl_tuikesite','erweima')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuikesite')." ADD   `erweima` varchar(255) NOT NULL COMMENT 'e二维码'");}
if(!pdo_fieldexists('hyb_yl_tuikesite','tkid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuikesite')." ADD   `tkid` int(11) NOT NULL DEFAULT '0' COMMENT '推客id'");}
if(!pdo_fieldexists('hyb_yl_tuikesite','leve')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuikesite')." ADD   `leve` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0自己1一级2二级'");}
if(!pdo_fieldexists('hyb_yl_tuikesite','countmoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuikesite')." ADD   `countmoney` float(9,2) NOT NULL COMMENT '总收益'");}
if(!pdo_fieldexists('hyb_yl_tuikesite','money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuikesite')." ADD   `money` float(10,2) NOT NULL COMMENT '入驻金额'");}
if(!pdo_fieldexists('hyb_yl_tuikesite','source')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuikesite')." ADD   `source` tinyint(3) NOT NULL DEFAULT '0' COMMENT '0自己申请1扫码2平台'");}
if(!pdo_fieldexists('hyb_yl_tuikesite','reason')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_tuikesite')." ADD   `reason` varchar(255) NOT NULL COMMENT '操作原因'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_twenorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `zid` int(11) NOT NULL COMMENT '专家id',
  `openid` varchar(255) NOT NULL COMMENT '用户openid',
  `orders` varchar(255) NOT NULL COMMENT '订单号',
  `time` time NOT NULL COMMENT '预约时间',
  `content` text CHARACTER SET utf8mb4 NOT NULL COMMENT '内容',
  `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0不推荐1推荐',
  `cfstate` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0不开处方1开启',
  `j_id` int(11) NOT NULL COMMENT '建档id',
  `money` float(7,2) NOT NULL COMMENT '金额',
  `ifgk` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0不公开1公开',
  `ifpay` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0待支付1已支付待接诊2已接诊3已完成待评价4已评价5申请退款6退款成功7订单关闭8已取消',
  `back_orser` varchar(255) NOT NULL COMMENT '统一订单号',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '上一级订单id',
  `role` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0用户1医生',
  `addnum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '追问次数',
  `paytime` int(11) NOT NULL COMMENT '支付时间',
  `grade` int(11) NOT NULL DEFAULT '1' COMMENT '1一级2二级',
  `coupon_id` int(11) NOT NULL COMMENT '优惠券id',
  `xdtime` int(11) NOT NULL COMMENT '下单时间',
  `overtime` int(11) NOT NULL COMMENT '订单结束时间',
  `dumiao` varchar(50) NOT NULL COMMENT '读秒',
  `biaoqian` varchar(255) NOT NULL COMMENT '标签',
  `old_money` decimal(11,2) NOT NULL COMMENT '订单原价',
  `coupon_dk` decimal(11,2) NOT NULL COMMENT '优惠券抵扣',
  `yid` int(11) NOT NULL COMMENT '年卡id',
  `year_dk` decimal(11,2) NOT NULL COMMENT '年卡抵扣',
  `ifgb` tinyint(2) NOT NULL DEFAULT '0' COMMENT '订单是否关闭0未关闭1关闭',
  `jztime` datetime NOT NULL COMMENT '接诊时间',
  `mp3` varchar(255) NOT NULL,
  `thtime` varchar(255) NOT NULL,
  `action_id` int(255) NOT NULL COMMENT '交易单号',
  `card_dk` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '会员卡抵扣',
  `ptmoney` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '平台抽成',
  `docmoney` decimal(11,2) DEFAULT '0.00' COMMENT '专家抽成',
  `hosmoney` decimal(11,2) DEFAULT '0.00' COMMENT '机构抽成',
  `tk_one` decimal(11,2) DEFAULT '0.00' COMMENT '推客一级抽成',
  `tk_two` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '推客二级抽成',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=299 DEFAULT CHARSET=utf8 COMMENT='问诊订单';

");

if(!pdo_fieldexists('hyb_yl_twenorder','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_twenorder','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_twenorder','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `zid` int(11) NOT NULL COMMENT '专家id'");}
if(!pdo_fieldexists('hyb_yl_twenorder','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `openid` varchar(255) NOT NULL COMMENT '用户openid'");}
if(!pdo_fieldexists('hyb_yl_twenorder','orders')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `orders` varchar(255) NOT NULL COMMENT '订单号'");}
if(!pdo_fieldexists('hyb_yl_twenorder','time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `time` time NOT NULL COMMENT '预约时间'");}
if(!pdo_fieldexists('hyb_yl_twenorder','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `content` text CHARACTER SET utf8mb4 NOT NULL COMMENT '内容'");}
if(!pdo_fieldexists('hyb_yl_twenorder','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0不推荐1推荐'");}
if(!pdo_fieldexists('hyb_yl_twenorder','cfstate')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `cfstate` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0不开处方1开启'");}
if(!pdo_fieldexists('hyb_yl_twenorder','j_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `j_id` int(11) NOT NULL COMMENT '建档id'");}
if(!pdo_fieldexists('hyb_yl_twenorder','money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `money` float(7,2) NOT NULL COMMENT '金额'");}
if(!pdo_fieldexists('hyb_yl_twenorder','ifgk')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `ifgk` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0不公开1公开'");}
if(!pdo_fieldexists('hyb_yl_twenorder','ifpay')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `ifpay` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0待支付1已支付待接诊2已接诊3已完成待评价4已评价5申请退款6退款成功7订单关闭8已取消'");}
if(!pdo_fieldexists('hyb_yl_twenorder','back_orser')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `back_orser` varchar(255) NOT NULL COMMENT '统一订单号'");}
if(!pdo_fieldexists('hyb_yl_twenorder','pid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `pid` int(11) NOT NULL DEFAULT '0' COMMENT '上一级订单id'");}
if(!pdo_fieldexists('hyb_yl_twenorder','role')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `role` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0用户1医生'");}
if(!pdo_fieldexists('hyb_yl_twenorder','addnum')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `addnum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '追问次数'");}
if(!pdo_fieldexists('hyb_yl_twenorder','paytime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `paytime` int(11) NOT NULL COMMENT '支付时间'");}
if(!pdo_fieldexists('hyb_yl_twenorder','grade')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `grade` int(11) NOT NULL DEFAULT '1' COMMENT '1一级2二级'");}
if(!pdo_fieldexists('hyb_yl_twenorder','coupon_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `coupon_id` int(11) NOT NULL COMMENT '优惠券id'");}
if(!pdo_fieldexists('hyb_yl_twenorder','xdtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `xdtime` int(11) NOT NULL COMMENT '下单时间'");}
if(!pdo_fieldexists('hyb_yl_twenorder','overtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `overtime` int(11) NOT NULL COMMENT '订单结束时间'");}
if(!pdo_fieldexists('hyb_yl_twenorder','dumiao')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `dumiao` varchar(50) NOT NULL COMMENT '读秒'");}
if(!pdo_fieldexists('hyb_yl_twenorder','biaoqian')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `biaoqian` varchar(255) NOT NULL COMMENT '标签'");}
if(!pdo_fieldexists('hyb_yl_twenorder','old_money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `old_money` decimal(11,2) NOT NULL COMMENT '订单原价'");}
if(!pdo_fieldexists('hyb_yl_twenorder','coupon_dk')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `coupon_dk` decimal(11,2) NOT NULL COMMENT '优惠券抵扣'");}
if(!pdo_fieldexists('hyb_yl_twenorder','yid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `yid` int(11) NOT NULL COMMENT '年卡id'");}
if(!pdo_fieldexists('hyb_yl_twenorder','year_dk')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `year_dk` decimal(11,2) NOT NULL COMMENT '年卡抵扣'");}
if(!pdo_fieldexists('hyb_yl_twenorder','ifgb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `ifgb` tinyint(2) NOT NULL DEFAULT '0' COMMENT '订单是否关闭0未关闭1关闭'");}
if(!pdo_fieldexists('hyb_yl_twenorder','jztime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `jztime` datetime NOT NULL COMMENT '接诊时间'");}
if(!pdo_fieldexists('hyb_yl_twenorder','mp3')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `mp3` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_twenorder','thtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `thtime` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_twenorder','action_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `action_id` int(255) NOT NULL COMMENT '交易单号'");}
if(!pdo_fieldexists('hyb_yl_twenorder','card_dk')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `card_dk` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '会员卡抵扣'");}
if(!pdo_fieldexists('hyb_yl_twenorder','ptmoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `ptmoney` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '平台抽成'");}
if(!pdo_fieldexists('hyb_yl_twenorder','docmoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `docmoney` decimal(11,2) DEFAULT '0.00' COMMENT '专家抽成'");}
if(!pdo_fieldexists('hyb_yl_twenorder','hosmoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `hosmoney` decimal(11,2) DEFAULT '0.00' COMMENT '机构抽成'");}
if(!pdo_fieldexists('hyb_yl_twenorder','tk_one')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `tk_one` decimal(11,2) DEFAULT '0.00' COMMENT '推客一级抽成'");}
if(!pdo_fieldexists('hyb_yl_twenorder','tk_two')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_twenorder')." ADD   `tk_two` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '推客二级抽成'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_user_address` (
  `addressId` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL COMMENT '收货人名称',
  `userPhone` varchar(20) NOT NULL COMMENT '收货人手机号码',
  `createTime` datetime NOT NULL,
  `openid` varchar(255) NOT NULL COMMENT '用户标识',
  `isDefault` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否默认地址	0：否 1：是',
  `userAddress` varchar(255) NOT NULL COMMENT '用户地址',
  PRIMARY KEY (`addressId`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COMMENT='用户地址表';

");

if(!pdo_fieldexists('hyb_yl_user_address','addressId')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_address')." ADD 
  `addressId` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_user_address','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_address')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_user_address','userName')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_address')." ADD   `userName` varchar(50) NOT NULL COMMENT '收货人名称'");}
if(!pdo_fieldexists('hyb_yl_user_address','userPhone')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_address')." ADD   `userPhone` varchar(20) NOT NULL COMMENT '收货人手机号码'");}
if(!pdo_fieldexists('hyb_yl_user_address','createTime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_address')." ADD   `createTime` datetime NOT NULL");}
if(!pdo_fieldexists('hyb_yl_user_address','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_address')." ADD   `openid` varchar(255) NOT NULL COMMENT '用户标识'");}
if(!pdo_fieldexists('hyb_yl_user_address','isDefault')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_address')." ADD   `isDefault` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否默认地址	0：否 1：是'");}
if(!pdo_fieldexists('hyb_yl_user_address','userAddress')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_address')." ADD   `userAddress` varchar(255) NOT NULL COMMENT '用户地址'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_user_baogao` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `openid` varchar(255) NOT NULL,
  `sharepic` text NOT NULL COMMENT '动态图片',
  `contents` varchar(255) NOT NULL COMMENT '动态内容',
  `times` int(11) NOT NULL COMMENT '发布时间',
  `dianj` int(11) NOT NULL DEFAULT '0' COMMENT '点赞数',
  `type` tinyint(5) NOT NULL DEFAULT '0' COMMENT '1通过审核0不通过',
  `shartitle` varchar(50) NOT NULL,
  `share_tj` tinyint(5) NOT NULL DEFAULT '0' COMMENT '1推荐0不推荐',
  `state` tinyint(5) NOT NULL DEFAULT '0' COMMENT '0用户；1医生；2平台',
  `labelid` int(10) NOT NULL DEFAULT '0' COMMENT '标签id [版块分类二级id]',
  `user_identity` int(10) NOT NULL DEFAULT '0' COMMENT '发布者身份  0普通用户 1专家 2后台',
  `doctor_visible` int(10) NOT NULL DEFAULT '0' COMMENT '是否仅医生可见  1是 0否',
  `virtual_thumb` varchar(255) DEFAULT NULL COMMENT '虚拟动态用户头像',
  `virtual_name` varchar(255) DEFAULT NULL COMMENT '虚拟动态用户名称',
  `virtual_accesses` int(10) NOT NULL DEFAULT '0' COMMENT '虚拟浏览量',
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_user_baogao','a_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_baogao')." ADD 
  `a_id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_user_baogao','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_baogao')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_user_baogao','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_baogao')." ADD   `openid` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_user_baogao','sharepic')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_baogao')." ADD   `sharepic` text NOT NULL COMMENT '动态图片'");}
if(!pdo_fieldexists('hyb_yl_user_baogao','contents')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_baogao')." ADD   `contents` varchar(255) NOT NULL COMMENT '动态内容'");}
if(!pdo_fieldexists('hyb_yl_user_baogao','times')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_baogao')." ADD   `times` int(11) NOT NULL COMMENT '发布时间'");}
if(!pdo_fieldexists('hyb_yl_user_baogao','dianj')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_baogao')." ADD   `dianj` int(11) NOT NULL DEFAULT '0' COMMENT '点赞数'");}
if(!pdo_fieldexists('hyb_yl_user_baogao','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_baogao')." ADD   `type` tinyint(5) NOT NULL DEFAULT '0' COMMENT '1通过审核0不通过'");}
if(!pdo_fieldexists('hyb_yl_user_baogao','shartitle')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_baogao')." ADD   `shartitle` varchar(50) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_user_baogao','share_tj')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_baogao')." ADD   `share_tj` tinyint(5) NOT NULL DEFAULT '0' COMMENT '1推荐0不推荐'");}
if(!pdo_fieldexists('hyb_yl_user_baogao','state')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_baogao')." ADD   `state` tinyint(5) NOT NULL DEFAULT '0' COMMENT '0用户；1医生；2平台'");}
if(!pdo_fieldexists('hyb_yl_user_baogao','labelid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_baogao')." ADD   `labelid` int(10) NOT NULL DEFAULT '0' COMMENT '标签id [版块分类二级id]'");}
if(!pdo_fieldexists('hyb_yl_user_baogao','user_identity')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_baogao')." ADD   `user_identity` int(10) NOT NULL DEFAULT '0' COMMENT '发布者身份  0普通用户 1专家 2后台'");}
if(!pdo_fieldexists('hyb_yl_user_baogao','doctor_visible')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_baogao')." ADD   `doctor_visible` int(10) NOT NULL DEFAULT '0' COMMENT '是否仅医生可见  1是 0否'");}
if(!pdo_fieldexists('hyb_yl_user_baogao','virtual_thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_baogao')." ADD   `virtual_thumb` varchar(255) DEFAULT NULL COMMENT '虚拟动态用户头像'");}
if(!pdo_fieldexists('hyb_yl_user_baogao','virtual_name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_baogao')." ADD   `virtual_name` varchar(255) DEFAULT NULL COMMENT '虚拟动态用户名称'");}
if(!pdo_fieldexists('hyb_yl_user_baogao','virtual_accesses')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_baogao')." ADD   `virtual_accesses` int(10) NOT NULL DEFAULT '0' COMMENT '虚拟浏览量'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_user_blood_pressure` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `openid` varchar(255) NOT NULL COMMENT '用户id',
  `j_id` int(11) NOT NULL COMMENT '家人id',
  `high_pressure` varchar(50) DEFAULT NULL COMMENT '高压值',
  `low_pressure` varchar(50) DEFAULT NULL COMMENT '低压值',
  `score` varchar(100) DEFAULT NULL COMMENT '评分',
  `heart_rate` varchar(50) DEFAULT NULL COMMENT '心率',
  `created` int(11) DEFAULT NULL COMMENT '测量时间',
  `type` tinyint(2) DEFAULT '0' COMMENT '状态（0：正常；1：偏低；2：偏高）',
  `content` text COMMENT '建议',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COMMENT='用户血压记录表';

");

if(!pdo_fieldexists('hyb_yl_user_blood_pressure','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_blood_pressure')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_user_blood_pressure','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_blood_pressure')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_user_blood_pressure','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_blood_pressure')." ADD   `openid` varchar(255) NOT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('hyb_yl_user_blood_pressure','j_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_blood_pressure')." ADD   `j_id` int(11) NOT NULL COMMENT '家人id'");}
if(!pdo_fieldexists('hyb_yl_user_blood_pressure','high_pressure')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_blood_pressure')." ADD   `high_pressure` varchar(50) DEFAULT NULL COMMENT '高压值'");}
if(!pdo_fieldexists('hyb_yl_user_blood_pressure','low_pressure')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_blood_pressure')." ADD   `low_pressure` varchar(50) DEFAULT NULL COMMENT '低压值'");}
if(!pdo_fieldexists('hyb_yl_user_blood_pressure','score')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_blood_pressure')." ADD   `score` varchar(100) DEFAULT NULL COMMENT '评分'");}
if(!pdo_fieldexists('hyb_yl_user_blood_pressure','heart_rate')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_blood_pressure')." ADD   `heart_rate` varchar(50) DEFAULT NULL COMMENT '心率'");}
if(!pdo_fieldexists('hyb_yl_user_blood_pressure','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_blood_pressure')." ADD   `created` int(11) DEFAULT NULL COMMENT '测量时间'");}
if(!pdo_fieldexists('hyb_yl_user_blood_pressure','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_blood_pressure')." ADD   `type` tinyint(2) DEFAULT '0' COMMENT '状态（0：正常；1：偏低；2：偏高）'");}
if(!pdo_fieldexists('hyb_yl_user_blood_pressure','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_blood_pressure')." ADD   `content` text COMMENT '建议'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_user_blood_sugar` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(255) DEFAULT NULL COMMENT '用户标识',
  `j_id` int(11) DEFAULT NULL COMMENT '用户家人id',
  `sugar_value` decimal(11,2) DEFAULT NULL COMMENT '血糖值',
  `type` tinyint(2) DEFAULT '0' COMMENT '血糖状态（0：正常；1：低血糖；2：高血糖）',
  `score` int(11) DEFAULT NULL COMMENT '分值',
  `content` text COMMENT '建议',
  `created` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='个人血糖值记录表';

");

if(!pdo_fieldexists('hyb_yl_user_blood_sugar','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_blood_sugar')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_user_blood_sugar','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_blood_sugar')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_user_blood_sugar','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_blood_sugar')." ADD   `openid` varchar(255) DEFAULT NULL COMMENT '用户标识'");}
if(!pdo_fieldexists('hyb_yl_user_blood_sugar','j_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_blood_sugar')." ADD   `j_id` int(11) DEFAULT NULL COMMENT '用户家人id'");}
if(!pdo_fieldexists('hyb_yl_user_blood_sugar','sugar_value')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_blood_sugar')." ADD   `sugar_value` decimal(11,2) DEFAULT NULL COMMENT '血糖值'");}
if(!pdo_fieldexists('hyb_yl_user_blood_sugar','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_blood_sugar')." ADD   `type` tinyint(2) DEFAULT '0' COMMENT '血糖状态（0：正常；1：低血糖；2：高血糖）'");}
if(!pdo_fieldexists('hyb_yl_user_blood_sugar','score')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_blood_sugar')." ADD   `score` int(11) DEFAULT NULL COMMENT '分值'");}
if(!pdo_fieldexists('hyb_yl_user_blood_sugar','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_blood_sugar')." ADD   `content` text COMMENT '建议'");}
if(!pdo_fieldexists('hyb_yl_user_blood_sugar','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_blood_sugar')." ADD   `created` int(11) DEFAULT NULL COMMENT '添加时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_user_case` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `openid` varchar(100) NOT NULL COMMENT '用户标识',
  `name` varchar(100) NOT NULL COMMENT '姓名',
  `age` int(11) NOT NULL COMMENT '年龄',
  `content` text COMMENT '现服药名称及剂量',
  `created` int(11) DEFAULT NULL COMMENT '创建时间',
  `date` varchar(50) DEFAULT NULL COMMENT '添加年月',
  `day` varchar(20) DEFAULT NULL COMMENT '添加日期',
  `number` int(11) NOT NULL DEFAULT '0' COMMENT '添加次数',
  `j_id` int(11) NOT NULL COMMENT '家人id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COMMENT='用户病例表';

");

if(!pdo_fieldexists('hyb_yl_user_case','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_case')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_user_case','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_case')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_user_case','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_case')." ADD   `openid` varchar(100) NOT NULL COMMENT '用户标识'");}
if(!pdo_fieldexists('hyb_yl_user_case','name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_case')." ADD   `name` varchar(100) NOT NULL COMMENT '姓名'");}
if(!pdo_fieldexists('hyb_yl_user_case','age')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_case')." ADD   `age` int(11) NOT NULL COMMENT '年龄'");}
if(!pdo_fieldexists('hyb_yl_user_case','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_case')." ADD   `content` text COMMENT '现服药名称及剂量'");}
if(!pdo_fieldexists('hyb_yl_user_case','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_case')." ADD   `created` int(11) DEFAULT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('hyb_yl_user_case','date')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_case')." ADD   `date` varchar(50) DEFAULT NULL COMMENT '添加年月'");}
if(!pdo_fieldexists('hyb_yl_user_case','day')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_case')." ADD   `day` varchar(20) DEFAULT NULL COMMENT '添加日期'");}
if(!pdo_fieldexists('hyb_yl_user_case','number')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_case')." ADD   `number` int(11) NOT NULL DEFAULT '0' COMMENT '添加次数'");}
if(!pdo_fieldexists('hyb_yl_user_case','j_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_case')." ADD   `j_id` int(11) NOT NULL COMMENT '家人id'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_user_coupon` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `openid` varchar(255) NOT NULL COMMENT '用户openid',
  `coupon_id` int(11) NOT NULL COMMENT '优惠券id',
  `coupon_name` varchar(255) DEFAULT NULL COMMENT '优惠券名称',
  `createtime` varchar(255) NOT NULL COMMENT '领取时间',
  `type` int(11) NOT NULL COMMENT '优惠券类型',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '优惠券状态（0：待使用；1：已使用；2：已过期）',
  `start_time` varchar(255) DEFAULT NULL COMMENT '使用开始时间',
  `end_time` varchar(255) DEFAULT NULL COMMENT '使用过期时间',
  `use_time` int(11) DEFAULT NULL COMMENT '使用时间',
  `duihuanma` varchar(255) DEFAULT NULL COMMENT '兑换码',
  `deductible_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '抵扣金额',
  `applicableservices` varchar(255) DEFAULT NULL COMMENT '适用服务',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='用户优惠券表';

");

if(!pdo_fieldexists('hyb_yl_user_coupon','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_coupon')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_user_coupon','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_coupon')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_user_coupon','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_coupon')." ADD   `openid` varchar(255) NOT NULL COMMENT '用户openid'");}
if(!pdo_fieldexists('hyb_yl_user_coupon','coupon_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_coupon')." ADD   `coupon_id` int(11) NOT NULL COMMENT '优惠券id'");}
if(!pdo_fieldexists('hyb_yl_user_coupon','coupon_name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_coupon')." ADD   `coupon_name` varchar(255) DEFAULT NULL COMMENT '优惠券名称'");}
if(!pdo_fieldexists('hyb_yl_user_coupon','createtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_coupon')." ADD   `createtime` varchar(255) NOT NULL COMMENT '领取时间'");}
if(!pdo_fieldexists('hyb_yl_user_coupon','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_coupon')." ADD   `type` int(11) NOT NULL COMMENT '优惠券类型'");}
if(!pdo_fieldexists('hyb_yl_user_coupon','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_coupon')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '优惠券状态（0：待使用；1：已使用；2：已过期）'");}
if(!pdo_fieldexists('hyb_yl_user_coupon','start_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_coupon')." ADD   `start_time` varchar(255) DEFAULT NULL COMMENT '使用开始时间'");}
if(!pdo_fieldexists('hyb_yl_user_coupon','end_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_coupon')." ADD   `end_time` varchar(255) DEFAULT NULL COMMENT '使用过期时间'");}
if(!pdo_fieldexists('hyb_yl_user_coupon','use_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_coupon')." ADD   `use_time` int(11) DEFAULT NULL COMMENT '使用时间'");}
if(!pdo_fieldexists('hyb_yl_user_coupon','duihuanma')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_coupon')." ADD   `duihuanma` varchar(255) DEFAULT NULL COMMENT '兑换码'");}
if(!pdo_fieldexists('hyb_yl_user_coupon','deductible_amount')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_coupon')." ADD   `deductible_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '抵扣金额'");}
if(!pdo_fieldexists('hyb_yl_user_coupon','applicableservices')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_coupon')." ADD   `applicableservices` varchar(255) DEFAULT NULL COMMENT '适用服务'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_user_equipment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(100) DEFAULT NULL COMMENT '用户openid',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `sn` varchar(255) DEFAULT NULL COMMENT '设备编号',
  `created` int(11) DEFAULT NULL COMMENT '绑定时间',
  `thumb` varchar(255) DEFAULT NULL COMMENT '图片',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '设备类型（0：血压仪；1：血糖仪；2：腕表）',
  `j_id` int(11) DEFAULT NULL COMMENT '家人id',
  `user` int(11) DEFAULT NULL COMMENT '用户号（仅限血压仪）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='用户绑定设备表';

");

if(!pdo_fieldexists('hyb_yl_user_equipment','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_equipment')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_user_equipment','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_equipment')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_user_equipment','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_equipment')." ADD   `openid` varchar(100) DEFAULT NULL COMMENT '用户openid'");}
if(!pdo_fieldexists('hyb_yl_user_equipment','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_equipment')." ADD   `title` varchar(255) DEFAULT NULL COMMENT '标题'");}
if(!pdo_fieldexists('hyb_yl_user_equipment','sn')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_equipment')." ADD   `sn` varchar(255) DEFAULT NULL COMMENT '设备编号'");}
if(!pdo_fieldexists('hyb_yl_user_equipment','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_equipment')." ADD   `created` int(11) DEFAULT NULL COMMENT '绑定时间'");}
if(!pdo_fieldexists('hyb_yl_user_equipment','thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_equipment')." ADD   `thumb` varchar(255) DEFAULT NULL COMMENT '图片'");}
if(!pdo_fieldexists('hyb_yl_user_equipment','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_equipment')." ADD   `type` int(11) NOT NULL DEFAULT '0' COMMENT '设备类型（0：血压仪；1：血糖仪；2：腕表）'");}
if(!pdo_fieldexists('hyb_yl_user_equipment','j_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_equipment')." ADD   `j_id` int(11) DEFAULT NULL COMMENT '家人id'");}
if(!pdo_fieldexists('hyb_yl_user_equipment','user')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_equipment')." ADD   `user` int(11) DEFAULT NULL COMMENT '用户号（仅限血压仪）'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_user_yearcard` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `zid` int(11) DEFAULT NULL COMMENT '专家id',
  `yid` int(11) DEFAULT NULL COMMENT '年卡id',
  `openid` varchar(255) DEFAULT NULL COMMENT '用户openid',
  `created` int(11) NOT NULL COMMENT '办卡时间',
  `money` decimal(11,2) NOT NULL COMMENT '办卡金额',
  `end_time` int(11) NOT NULL COMMENT '年卡结束时间',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：待支付；1：已支付；）',
  `wz_num` int(11) NOT NULL COMMENT '问诊免费数目',
  `wz_zhekou` int(11) NOT NULL COMMENT '问诊折扣',
  `jd_num` int(11) NOT NULL COMMENT '解读次数',
  `hh_num` int(11) NOT NULL COMMENT '免费会话数量',
  `ordersn` varchar(50) NOT NULL COMMENT '订单号',
  `tk_one` decimal(11,2) NOT NULL COMMENT '推客一级抽成',
  `tk_two` decimal(11,2) NOT NULL COMMENT '推客二级抽成',
  `hosmoney` decimal(11,2) NOT NULL COMMENT '机构抽成',
  `ptmoney` decimal(11,2) NOT NULL COMMENT '平台抽成',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COMMENT='用户办理年卡记录';

");

if(!pdo_fieldexists('hyb_yl_user_yearcard','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_yearcard')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_user_yearcard','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_yearcard')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_user_yearcard','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_yearcard')." ADD   `zid` int(11) DEFAULT NULL COMMENT '专家id'");}
if(!pdo_fieldexists('hyb_yl_user_yearcard','yid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_yearcard')." ADD   `yid` int(11) DEFAULT NULL COMMENT '年卡id'");}
if(!pdo_fieldexists('hyb_yl_user_yearcard','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_yearcard')." ADD   `openid` varchar(255) DEFAULT NULL COMMENT '用户openid'");}
if(!pdo_fieldexists('hyb_yl_user_yearcard','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_yearcard')." ADD   `created` int(11) NOT NULL COMMENT '办卡时间'");}
if(!pdo_fieldexists('hyb_yl_user_yearcard','money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_yearcard')." ADD   `money` decimal(11,2) NOT NULL COMMENT '办卡金额'");}
if(!pdo_fieldexists('hyb_yl_user_yearcard','end_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_yearcard')." ADD   `end_time` int(11) NOT NULL COMMENT '年卡结束时间'");}
if(!pdo_fieldexists('hyb_yl_user_yearcard','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_yearcard')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：待支付；1：已支付；）'");}
if(!pdo_fieldexists('hyb_yl_user_yearcard','wz_num')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_yearcard')." ADD   `wz_num` int(11) NOT NULL COMMENT '问诊免费数目'");}
if(!pdo_fieldexists('hyb_yl_user_yearcard','wz_zhekou')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_yearcard')." ADD   `wz_zhekou` int(11) NOT NULL COMMENT '问诊折扣'");}
if(!pdo_fieldexists('hyb_yl_user_yearcard','jd_num')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_yearcard')." ADD   `jd_num` int(11) NOT NULL COMMENT '解读次数'");}
if(!pdo_fieldexists('hyb_yl_user_yearcard','hh_num')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_yearcard')." ADD   `hh_num` int(11) NOT NULL COMMENT '免费会话数量'");}
if(!pdo_fieldexists('hyb_yl_user_yearcard','ordersn')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_yearcard')." ADD   `ordersn` varchar(50) NOT NULL COMMENT '订单号'");}
if(!pdo_fieldexists('hyb_yl_user_yearcard','tk_one')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_yearcard')." ADD   `tk_one` decimal(11,2) NOT NULL COMMENT '推客一级抽成'");}
if(!pdo_fieldexists('hyb_yl_user_yearcard','tk_two')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_yearcard')." ADD   `tk_two` decimal(11,2) NOT NULL COMMENT '推客二级抽成'");}
if(!pdo_fieldexists('hyb_yl_user_yearcard','hosmoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_yearcard')." ADD   `hosmoney` decimal(11,2) NOT NULL COMMENT '机构抽成'");}
if(!pdo_fieldexists('hyb_yl_user_yearcard','ptmoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_user_yearcard')." ADD   `ptmoney` decimal(11,2) NOT NULL COMMENT '平台抽成'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_userbingli` (
  `bl_id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `openid` varchar(255) NOT NULL COMMENT '用户标识',
  `userid` int(11) NOT NULL COMMENT '患者id',
  `msglist` text NOT NULL COMMENT '问题与答案',
  `sicktel` varchar(255) NOT NULL COMMENT '电话',
  `time` int(11) NOT NULL,
  `keywords` varchar(50) NOT NULL COMMENT '服务关键词',
  PRIMARY KEY (`bl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_userbingli','bl_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userbingli')." ADD 
  `bl_id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_userbingli','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userbingli')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_userbingli','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userbingli')." ADD   `openid` varchar(255) NOT NULL COMMENT '用户标识'");}
if(!pdo_fieldexists('hyb_yl_userbingli','userid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userbingli')." ADD   `userid` int(11) NOT NULL COMMENT '患者id'");}
if(!pdo_fieldexists('hyb_yl_userbingli','msglist')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userbingli')." ADD   `msglist` text NOT NULL COMMENT '问题与答案'");}
if(!pdo_fieldexists('hyb_yl_userbingli','sicktel')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userbingli')." ADD   `sicktel` varchar(255) NOT NULL COMMENT '电话'");}
if(!pdo_fieldexists('hyb_yl_userbingli','time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userbingli')." ADD   `time` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_userbingli','keywords')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userbingli')." ADD   `keywords` varchar(50) NOT NULL COMMENT '服务关键词'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_userchufang` (
  `cf_id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `j_id` int(11) NOT NULL COMMENT '患者id',
  `typeSate` tinyint(11) NOT NULL DEFAULT '1' COMMENT '处方类型0复诊1初诊',
  `content` text NOT NULL COMMENT '内容',
  `timeStar` datetime NOT NULL COMMENT '时间',
  `openid` varchar(255) NOT NULL COMMENT 'y用户标识',
  PRIMARY KEY (`cf_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户处方';

");

if(!pdo_fieldexists('hyb_yl_userchufang','cf_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userchufang')." ADD 
  `cf_id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_userchufang','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userchufang')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_userchufang','j_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userchufang')." ADD   `j_id` int(11) NOT NULL COMMENT '患者id'");}
if(!pdo_fieldexists('hyb_yl_userchufang','typeSate')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userchufang')." ADD   `typeSate` tinyint(11) NOT NULL DEFAULT '1' COMMENT '处方类型0复诊1初诊'");}
if(!pdo_fieldexists('hyb_yl_userchufang','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userchufang')." ADD   `content` text NOT NULL COMMENT '内容'");}
if(!pdo_fieldexists('hyb_yl_userchufang','timeStar')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userchufang')." ADD   `timeStar` datetime NOT NULL COMMENT '时间'");}
if(!pdo_fieldexists('hyb_yl_userchufang','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userchufang')." ADD   `openid` varchar(255) NOT NULL COMMENT 'y用户标识'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_userdianz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(255) NOT NULL COMMENT '用户标识',
  `uniacid` int(11) NOT NULL,
  `p_id` int(11) NOT NULL COMMENT '点赞id',
  `type` int(11) NOT NULL COMMENT '1文章资讯2医生3视频4分享5患教6报告',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_userdianz','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userdianz')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_userdianz','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userdianz')." ADD   `openid` varchar(255) NOT NULL COMMENT '用户标识'");}
if(!pdo_fieldexists('hyb_yl_userdianz','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userdianz')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_userdianz','p_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userdianz')." ADD   `p_id` int(11) NOT NULL COMMENT '点赞id'");}
if(!pdo_fieldexists('hyb_yl_userdianz','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userdianz')." ADD   `type` int(11) NOT NULL COMMENT '1文章资讯2医生3视频4分享5患教6报告'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_userdxin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `key` varchar(50) NOT NULL COMMENT '短信key',
  `scret` varchar(50) NOT NULL COMMENT '短信scret',
  `qianming` varchar(50) NOT NULL COMMENT '签名',
  `moban_id` varchar(50) NOT NULL COMMENT '模板id',
  `templateid` varchar(255) NOT NULL COMMENT '短信通知ID',
  `stadus` int(11) NOT NULL DEFAULT '0' COMMENT '状态',
  `tel` varchar(50) NOT NULL,
  `cfmb` varchar(255) NOT NULL,
  `zztz` varchar(255) NOT NULL COMMENT '转诊通知',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='阿里短信设置';

");

if(!pdo_fieldexists('hyb_yl_userdxin','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userdxin')." ADD 
  `id` int(10) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_userdxin','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userdxin')." ADD   `uniacid` int(10) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_userdxin','key')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userdxin')." ADD   `key` varchar(50) NOT NULL COMMENT '短信key'");}
if(!pdo_fieldexists('hyb_yl_userdxin','scret')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userdxin')." ADD   `scret` varchar(50) NOT NULL COMMENT '短信scret'");}
if(!pdo_fieldexists('hyb_yl_userdxin','qianming')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userdxin')." ADD   `qianming` varchar(50) NOT NULL COMMENT '签名'");}
if(!pdo_fieldexists('hyb_yl_userdxin','moban_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userdxin')." ADD   `moban_id` varchar(50) NOT NULL COMMENT '模板id'");}
if(!pdo_fieldexists('hyb_yl_userdxin','templateid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userdxin')." ADD   `templateid` varchar(255) NOT NULL COMMENT '短信通知ID'");}
if(!pdo_fieldexists('hyb_yl_userdxin','stadus')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userdxin')." ADD   `stadus` int(11) NOT NULL DEFAULT '0' COMMENT '状态'");}
if(!pdo_fieldexists('hyb_yl_userdxin','tel')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userdxin')." ADD   `tel` varchar(50) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_userdxin','cfmb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userdxin')." ADD   `cfmb` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_userdxin','zztz')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userdxin')." ADD   `zztz` varchar(255) NOT NULL COMMENT '转诊通知'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_userinfo` (
  `u_id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `openid` varchar(255) NOT NULL COMMENT '用户openid',
  `u_name` varchar(255) NOT NULL COMMENT '用户昵称',
  `u_thumb` varchar(255) NOT NULL COMMENT 'y用户头像',
  `u_type` varchar(255) NOT NULL DEFAULT '0' COMMENT '核销员设置 1是核销员，0不是核销员',
  `u_phone` varchar(255) NOT NULL COMMENT 'd电话号',
  `form_id` longtext NOT NULL,
  `u_xfmoney` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL DEFAULT '1' COMMENT '1自然进入2推荐进入',
  `adminuserdj` varchar(50) NOT NULL DEFAULT '0' COMMENT '会员等级',
  `adminoptime` varchar(255) NOT NULL COMMENT '会员开通时间',
  `adminguanbi` varchar(255) NOT NULL COMMENT '会员到期时间',
  `admintype` int(10) NOT NULL DEFAULT '0' COMMENT '0未开通过；1已开通',
  `mbnumber` int(11) NOT NULL COMMENT '会员编号',
  `randnum` varchar(255) NOT NULL COMMENT '随机数5位',
  `longtime` datetime NOT NULL COMMENT '最后登录时间',
  `zctime` datetime NOT NULL COMMENT '注册时间',
  `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1账户正常，0不正常',
  `tjuser` int(11) NOT NULL DEFAULT '0' COMMENT '推荐用户id',
  `u_sex` tinyint(2) NOT NULL DEFAULT '0' COMMENT '性别（0：女；1：男；2：不详）',
  `u_age` int(11) NOT NULL COMMENT '年龄',
  `money` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '用户余额',
  `score` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '积分',
  `u_label` text NOT NULL COMMENT '患者标签',
  `tip_num` int(11) NOT NULL COMMENT '活动提醒数量',
  `tkid` int(11) NOT NULL DEFAULT '0' COMMENT '0自然进入否则上级id',
  `is_tips` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否授权后台订阅消息（0：否；1：是）',
  `unionId` varchar(255) NOT NULL COMMENT '用户唯一标识unionId',
  `wxopenid` varchar(255) NOT NULL COMMENT '公众号openid',
  PRIMARY KEY (`u_id`),
  KEY `openid` (`openid`)
) ENGINE=InnoDB AUTO_INCREMENT=2608 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_userinfo','u_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo')." ADD 
  `u_id` int(10) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_userinfo','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo')." ADD   `uniacid` int(10) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_userinfo','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo')." ADD   `openid` varchar(255) NOT NULL COMMENT '用户openid'");}
if(!pdo_fieldexists('hyb_yl_userinfo','u_name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo')." ADD   `u_name` varchar(255) NOT NULL COMMENT '用户昵称'");}
if(!pdo_fieldexists('hyb_yl_userinfo','u_thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo')." ADD   `u_thumb` varchar(255) NOT NULL COMMENT 'y用户头像'");}
if(!pdo_fieldexists('hyb_yl_userinfo','u_type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo')." ADD   `u_type` varchar(255) NOT NULL DEFAULT '0' COMMENT '核销员设置 1是核销员，0不是核销员'");}
if(!pdo_fieldexists('hyb_yl_userinfo','u_phone')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo')." ADD   `u_phone` varchar(255) NOT NULL COMMENT 'd电话号'");}
if(!pdo_fieldexists('hyb_yl_userinfo','form_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo')." ADD   `form_id` longtext NOT NULL");}
if(!pdo_fieldexists('hyb_yl_userinfo','u_xfmoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo')." ADD   `u_xfmoney` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_userinfo','gender')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo')." ADD   `gender` int(11) NOT NULL DEFAULT '1' COMMENT '1自然进入2推荐进入'");}
if(!pdo_fieldexists('hyb_yl_userinfo','adminuserdj')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo')." ADD   `adminuserdj` varchar(50) NOT NULL DEFAULT '0' COMMENT '会员等级'");}
if(!pdo_fieldexists('hyb_yl_userinfo','adminoptime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo')." ADD   `adminoptime` varchar(255) NOT NULL COMMENT '会员开通时间'");}
if(!pdo_fieldexists('hyb_yl_userinfo','adminguanbi')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo')." ADD   `adminguanbi` varchar(255) NOT NULL COMMENT '会员到期时间'");}
if(!pdo_fieldexists('hyb_yl_userinfo','admintype')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo')." ADD   `admintype` int(10) NOT NULL DEFAULT '0' COMMENT '0未开通过；1已开通'");}
if(!pdo_fieldexists('hyb_yl_userinfo','mbnumber')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo')." ADD   `mbnumber` int(11) NOT NULL COMMENT '会员编号'");}
if(!pdo_fieldexists('hyb_yl_userinfo','randnum')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo')." ADD   `randnum` varchar(255) NOT NULL COMMENT '随机数5位'");}
if(!pdo_fieldexists('hyb_yl_userinfo','longtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo')." ADD   `longtime` datetime NOT NULL COMMENT '最后登录时间'");}
if(!pdo_fieldexists('hyb_yl_userinfo','zctime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo')." ADD   `zctime` datetime NOT NULL COMMENT '注册时间'");}
if(!pdo_fieldexists('hyb_yl_userinfo','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo')." ADD   `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1账户正常，0不正常'");}
if(!pdo_fieldexists('hyb_yl_userinfo','tjuser')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo')." ADD   `tjuser` int(11) NOT NULL DEFAULT '0' COMMENT '推荐用户id'");}
if(!pdo_fieldexists('hyb_yl_userinfo','u_sex')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo')." ADD   `u_sex` tinyint(2) NOT NULL DEFAULT '0' COMMENT '性别（0：女；1：男；2：不详）'");}
if(!pdo_fieldexists('hyb_yl_userinfo','u_age')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo')." ADD   `u_age` int(11) NOT NULL COMMENT '年龄'");}
if(!pdo_fieldexists('hyb_yl_userinfo','money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo')." ADD   `money` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '用户余额'");}
if(!pdo_fieldexists('hyb_yl_userinfo','score')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo')." ADD   `score` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '积分'");}
if(!pdo_fieldexists('hyb_yl_userinfo','u_label')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo')." ADD   `u_label` text NOT NULL COMMENT '患者标签'");}
if(!pdo_fieldexists('hyb_yl_userinfo','tip_num')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo')." ADD   `tip_num` int(11) NOT NULL COMMENT '活动提醒数量'");}
if(!pdo_fieldexists('hyb_yl_userinfo','tkid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo')." ADD   `tkid` int(11) NOT NULL DEFAULT '0' COMMENT '0自然进入否则上级id'");}
if(!pdo_fieldexists('hyb_yl_userinfo','is_tips')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo')." ADD   `is_tips` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否授权后台订阅消息（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_userinfo','unionId')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo')." ADD   `unionId` varchar(255) NOT NULL COMMENT '用户唯一标识unionId'");}
if(!pdo_fieldexists('hyb_yl_userinfo','wxopenid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo')." ADD   `wxopenid` varchar(255) NOT NULL COMMENT '公众号openid'");}
if(!pdo_fieldexists('hyb_yl_userinfo','u_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo')." ADD   PRIMARY KEY (`u_id`)");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_userinfo_credit_record` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) DEFAULT NULL,
  `u_id` int(10) NOT NULL DEFAULT '0' COMMENT '用户id',
  `openid` varchar(255) DEFAULT NULL COMMENT '用户openid',
  `credittype` varchar(255) DEFAULT NULL COMMENT '操作充值/减少类型（credit1：积分；credit2：余额）',
  `operator` int(10) NOT NULL DEFAULT '0' COMMENT '0 后台充值 1阅读咨询',
  `num` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '数量',
  `remark` varchar(255) DEFAULT NULL COMMENT '说明',
  `createtime` varchar(255) DEFAULT NULL,
  `presentcredit` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '当前积分/余额',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=649 DEFAULT CHARSET=utf8 COMMENT='用户余额变更表';

");

if(!pdo_fieldexists('hyb_yl_userinfo_credit_record','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo_credit_record')." ADD 
  `id` int(10) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_userinfo_credit_record','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo_credit_record')." ADD   `uniacid` int(10) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_userinfo_credit_record','u_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo_credit_record')." ADD   `u_id` int(10) NOT NULL DEFAULT '0' COMMENT '用户id'");}
if(!pdo_fieldexists('hyb_yl_userinfo_credit_record','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo_credit_record')." ADD   `openid` varchar(255) DEFAULT NULL COMMENT '用户openid'");}
if(!pdo_fieldexists('hyb_yl_userinfo_credit_record','credittype')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo_credit_record')." ADD   `credittype` varchar(255) DEFAULT NULL COMMENT '操作充值/减少类型（credit1：积分；credit2：余额）'");}
if(!pdo_fieldexists('hyb_yl_userinfo_credit_record','operator')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo_credit_record')." ADD   `operator` int(10) NOT NULL DEFAULT '0' COMMENT '0 后台充值 1阅读咨询'");}
if(!pdo_fieldexists('hyb_yl_userinfo_credit_record','num')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo_credit_record')." ADD   `num` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '数量'");}
if(!pdo_fieldexists('hyb_yl_userinfo_credit_record','remark')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo_credit_record')." ADD   `remark` varchar(255) DEFAULT NULL COMMENT '说明'");}
if(!pdo_fieldexists('hyb_yl_userinfo_credit_record','createtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo_credit_record')." ADD   `createtime` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_userinfo_credit_record','presentcredit')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userinfo_credit_record')." ADD   `presentcredit` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '当前积分/余额'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_userjiaren` (
  `j_id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `openid` varchar(255) NOT NULL COMMENT '用户openid',
  `names` varchar(255) NOT NULL COMMENT '姓名',
  `sex` varchar(11) NOT NULL DEFAULT '男' COMMENT 'x性别',
  `datetime` varchar(255) NOT NULL COMMENT '出身日期',
  `age` int(11) NOT NULL DEFAULT '0' COMMENT '年龄',
  `region` varchar(255) NOT NULL DEFAULT '北京市,北京市,东城区' COMMENT '所在地',
  `numcard` varchar(255) NOT NULL COMMENT '证件',
  `tel` varchar(50) NOT NULL COMMENT 'd电话号',
  `pap_index` int(11) NOT NULL COMMENT '证件类型',
  `sick_index` int(11) NOT NULL DEFAULT '0' COMMENT '关系类型 0本人',
  `tizhong` varchar(50) NOT NULL COMMENT '体重',
  `shengao` varchar(50) NOT NULL COMMENT '身高',
  `hunyin` varchar(20) NOT NULL COMMENT '婚姻',
  `zhiye` varchar(50) NOT NULL COMMENT '职业',
  `gan_index` int(11) NOT NULL DEFAULT '0' COMMENT '肝0正常1不',
  `shen_index` int(11) NOT NULL DEFAULT '0' COMMENT '肾功能0正常',
  `be_index` int(11) NOT NULL DEFAULT '0' COMMENT '备孕0正常',
  `xuex` varchar(50) NOT NULL COMMENT '血型',
  `feritin_index` int(11) NOT NULL DEFAULT '0' COMMENT '高血压病史（0：无；有）',
  `diabetes_index` int(11) NOT NULL DEFAULT '0' COMMENT '糖尿病病史（0：无；1：有）',
  `allergy_index` int(11) NOT NULL DEFAULT '0' COMMENT '药物过敏史（0：无；1：有）',
  PRIMARY KEY (`j_id`)
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=utf8 COMMENT='患者信息表';

");

if(!pdo_fieldexists('hyb_yl_userjiaren','j_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userjiaren')." ADD 
  `j_id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_userjiaren','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userjiaren')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_userjiaren','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userjiaren')." ADD   `openid` varchar(255) NOT NULL COMMENT '用户openid'");}
if(!pdo_fieldexists('hyb_yl_userjiaren','names')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userjiaren')." ADD   `names` varchar(255) NOT NULL COMMENT '姓名'");}
if(!pdo_fieldexists('hyb_yl_userjiaren','sex')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userjiaren')." ADD   `sex` varchar(11) NOT NULL DEFAULT '男' COMMENT 'x性别'");}
if(!pdo_fieldexists('hyb_yl_userjiaren','datetime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userjiaren')." ADD   `datetime` varchar(255) NOT NULL COMMENT '出身日期'");}
if(!pdo_fieldexists('hyb_yl_userjiaren','age')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userjiaren')." ADD   `age` int(11) NOT NULL DEFAULT '0' COMMENT '年龄'");}
if(!pdo_fieldexists('hyb_yl_userjiaren','region')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userjiaren')." ADD   `region` varchar(255) NOT NULL DEFAULT '北京市,北京市,东城区' COMMENT '所在地'");}
if(!pdo_fieldexists('hyb_yl_userjiaren','numcard')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userjiaren')." ADD   `numcard` varchar(255) NOT NULL COMMENT '证件'");}
if(!pdo_fieldexists('hyb_yl_userjiaren','tel')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userjiaren')." ADD   `tel` varchar(50) NOT NULL COMMENT 'd电话号'");}
if(!pdo_fieldexists('hyb_yl_userjiaren','pap_index')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userjiaren')." ADD   `pap_index` int(11) NOT NULL COMMENT '证件类型'");}
if(!pdo_fieldexists('hyb_yl_userjiaren','sick_index')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userjiaren')." ADD   `sick_index` int(11) NOT NULL DEFAULT '0' COMMENT '关系类型 0本人'");}
if(!pdo_fieldexists('hyb_yl_userjiaren','tizhong')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userjiaren')." ADD   `tizhong` varchar(50) NOT NULL COMMENT '体重'");}
if(!pdo_fieldexists('hyb_yl_userjiaren','shengao')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userjiaren')." ADD   `shengao` varchar(50) NOT NULL COMMENT '身高'");}
if(!pdo_fieldexists('hyb_yl_userjiaren','hunyin')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userjiaren')." ADD   `hunyin` varchar(20) NOT NULL COMMENT '婚姻'");}
if(!pdo_fieldexists('hyb_yl_userjiaren','zhiye')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userjiaren')." ADD   `zhiye` varchar(50) NOT NULL COMMENT '职业'");}
if(!pdo_fieldexists('hyb_yl_userjiaren','gan_index')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userjiaren')." ADD   `gan_index` int(11) NOT NULL DEFAULT '0' COMMENT '肝0正常1不'");}
if(!pdo_fieldexists('hyb_yl_userjiaren','shen_index')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userjiaren')." ADD   `shen_index` int(11) NOT NULL DEFAULT '0' COMMENT '肾功能0正常'");}
if(!pdo_fieldexists('hyb_yl_userjiaren','be_index')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userjiaren')." ADD   `be_index` int(11) NOT NULL DEFAULT '0' COMMENT '备孕0正常'");}
if(!pdo_fieldexists('hyb_yl_userjiaren','xuex')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userjiaren')." ADD   `xuex` varchar(50) NOT NULL COMMENT '血型'");}
if(!pdo_fieldexists('hyb_yl_userjiaren','feritin_index')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userjiaren')." ADD   `feritin_index` int(11) NOT NULL DEFAULT '0' COMMENT '高血压病史（0：无；有）'");}
if(!pdo_fieldexists('hyb_yl_userjiaren','diabetes_index')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userjiaren')." ADD   `diabetes_index` int(11) NOT NULL DEFAULT '0' COMMENT '糖尿病病史（0：无；1：有）'");}
if(!pdo_fieldexists('hyb_yl_userjiaren','allergy_index')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userjiaren')." ADD   `allergy_index` int(11) NOT NULL DEFAULT '0' COMMENT '药物过敏史（0：无；1：有）'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_userlabelarr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `zid` int(11) NOT NULL COMMENT '专家id',
  `openid` varchar(255) NOT NULL COMMENT '用户标识',
  `label` varchar(255) NOT NULL COMMENT '标签',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COMMENT='用户标签';

");

if(!pdo_fieldexists('hyb_yl_userlabelarr','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userlabelarr')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_userlabelarr','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userlabelarr')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_userlabelarr','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userlabelarr')." ADD   `zid` int(11) NOT NULL COMMENT '专家id'");}
if(!pdo_fieldexists('hyb_yl_userlabelarr','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userlabelarr')." ADD   `openid` varchar(255) NOT NULL COMMENT '用户标识'");}
if(!pdo_fieldexists('hyb_yl_userlabelarr','label')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userlabelarr')." ADD   `label` varchar(255) NOT NULL COMMENT '标签'");}
if(!pdo_fieldexists('hyb_yl_userlabelarr','addtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_userlabelarr')." ADD   `addtime` int(11) NOT NULL COMMENT '添加时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_vip` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL COMMENT '类别名称',
  `content` text NOT NULL COMMENT '详细信息',
  `times` int(11) NOT NULL DEFAULT '0' COMMENT '时长',
  `price` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `oldprice` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '原价格',
  `quanyi` int(11) NOT NULL DEFAULT '0' COMMENT '权益id',
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '可开通次数',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `is_xf` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否可用于续费（0：否；1：是；2：只能用于续费）',
  `is_tuijian` tinyint(2) NOT NULL DEFAULT '1' COMMENT '是否推荐（0：否；1：是）',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（是否启用0：否；1：是）',
  `created` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='用户会员类型管理';

");

if(!pdo_fieldexists('hyb_yl_vip','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_vip','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_vip','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip')." ADD   `title` varchar(255) NOT NULL COMMENT '类别名称'");}
if(!pdo_fieldexists('hyb_yl_vip','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip')." ADD   `content` text NOT NULL COMMENT '详细信息'");}
if(!pdo_fieldexists('hyb_yl_vip','times')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip')." ADD   `times` int(11) NOT NULL DEFAULT '0' COMMENT '时长'");}
if(!pdo_fieldexists('hyb_yl_vip','price')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip')." ADD   `price` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '价格'");}
if(!pdo_fieldexists('hyb_yl_vip','oldprice')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip')." ADD   `oldprice` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '原价格'");}
if(!pdo_fieldexists('hyb_yl_vip','quanyi')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip')." ADD   `quanyi` int(11) NOT NULL DEFAULT '0' COMMENT '权益id'");}
if(!pdo_fieldexists('hyb_yl_vip','num')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip')." ADD   `num` int(11) NOT NULL DEFAULT '0' COMMENT '可开通次数'");}
if(!pdo_fieldexists('hyb_yl_vip','sort')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip')." ADD   `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序'");}
if(!pdo_fieldexists('hyb_yl_vip','is_xf')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip')." ADD   `is_xf` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否可用于续费（0：否；1：是；2：只能用于续费）'");}
if(!pdo_fieldexists('hyb_yl_vip','is_tuijian')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip')." ADD   `is_tuijian` tinyint(2) NOT NULL DEFAULT '1' COMMENT '是否推荐（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_vip','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（是否启用0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_vip','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_vip_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `openid` varchar(255) NOT NULL COMMENT '用户标识',
  `u_name` varchar(255) NOT NULL COMMENT '用户名称',
  `vip` int(11) NOT NULL COMMENT '会员类型',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '支付金额',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：待付款；1：已付款）',
  `created` int(11) NOT NULL COMMENT '添加时间',
  `p_time` int(11) NOT NULL COMMENT '支付时间',
  `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '类型（0：自己购买；1：用户续费；2：用户转增）',
  `shichang` varchar(255) NOT NULL DEFAULT '0' COMMENT '时长',
  `starttime` varchar(255) DEFAULT NULL COMMENT '开始时间',
  `endtime` varchar(255) DEFAULT NULL COMMENT '到期时间',
  `s_openid` varchar(255) NOT NULL COMMENT '领取人标识',
  `s_content` varchar(255) DEFAULT NULL COMMENT '转赠祝福',
  `receive` int(10) NOT NULL DEFAULT '0' COMMENT '是否领取 1是 0 否',
  `receive_time` varchar(255) DEFAULT NULL COMMENT '领取时间',
  `tk_one` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '推客一级抽成',
  `tk_two` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '推客二级抽成',
  `ordersn` varchar(255) NOT NULL COMMENT '订单号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COMMENT='用户会员办理表';

");

if(!pdo_fieldexists('hyb_yl_vip_log','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_log')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_vip_log','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_log')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_vip_log','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_log')." ADD   `openid` varchar(255) NOT NULL COMMENT '用户标识'");}
if(!pdo_fieldexists('hyb_yl_vip_log','u_name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_log')." ADD   `u_name` varchar(255) NOT NULL COMMENT '用户名称'");}
if(!pdo_fieldexists('hyb_yl_vip_log','vip')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_log')." ADD   `vip` int(11) NOT NULL COMMENT '会员类型'");}
if(!pdo_fieldexists('hyb_yl_vip_log','price')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_log')." ADD   `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '支付金额'");}
if(!pdo_fieldexists('hyb_yl_vip_log','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_log')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：待付款；1：已付款）'");}
if(!pdo_fieldexists('hyb_yl_vip_log','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_log')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_vip_log','p_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_log')." ADD   `p_time` int(11) NOT NULL COMMENT '支付时间'");}
if(!pdo_fieldexists('hyb_yl_vip_log','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_log')." ADD   `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '类型（0：自己购买；1：用户续费；2：用户转增）'");}
if(!pdo_fieldexists('hyb_yl_vip_log','shichang')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_log')." ADD   `shichang` varchar(255) NOT NULL DEFAULT '0' COMMENT '时长'");}
if(!pdo_fieldexists('hyb_yl_vip_log','starttime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_log')." ADD   `starttime` varchar(255) DEFAULT NULL COMMENT '开始时间'");}
if(!pdo_fieldexists('hyb_yl_vip_log','endtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_log')." ADD   `endtime` varchar(255) DEFAULT NULL COMMENT '到期时间'");}
if(!pdo_fieldexists('hyb_yl_vip_log','s_openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_log')." ADD   `s_openid` varchar(255) NOT NULL COMMENT '领取人标识'");}
if(!pdo_fieldexists('hyb_yl_vip_log','s_content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_log')." ADD   `s_content` varchar(255) DEFAULT NULL COMMENT '转赠祝福'");}
if(!pdo_fieldexists('hyb_yl_vip_log','receive')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_log')." ADD   `receive` int(10) NOT NULL DEFAULT '0' COMMENT '是否领取 1是 0 否'");}
if(!pdo_fieldexists('hyb_yl_vip_log','receive_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_log')." ADD   `receive_time` varchar(255) DEFAULT NULL COMMENT '领取时间'");}
if(!pdo_fieldexists('hyb_yl_vip_log','tk_one')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_log')." ADD   `tk_one` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '推客一级抽成'");}
if(!pdo_fieldexists('hyb_yl_vip_log','tk_two')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_log')." ADD   `tk_two` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '推客二级抽成'");}
if(!pdo_fieldexists('hyb_yl_vip_log','ordersn')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_log')." ADD   `ordersn` varchar(255) NOT NULL COMMENT '订单号'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_vip_quanyi` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL COMMENT '特权名称',
  `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '特权类型(0：按类型；1：关闭）',
  `quanyi` text NOT NULL COMMENT '权益选择',
  `zhekou` decimal(11,1) NOT NULL COMMENT '特权折扣',
  `is_mianfei` tinyint(2) NOT NULL COMMENT '是否开启免费问诊',
  `mianfei_num` int(11) NOT NULL COMMENT '免费追问次数',
  `xianzhi` varchar(255) NOT NULL COMMENT '使用限制',
  `mfwz_num` int(11) NOT NULL COMMENT '免费问诊次数',
  `content` text NOT NULL COMMENT '使用说明',
  `sort` int(11) NOT NULL COMMENT '排序',
  `status` tinyint(2) NOT NULL COMMENT '状态（0：隐藏；1：显示）',
  `created` int(11) NOT NULL COMMENT '添加时间',
  `thumb` varchar(255) NOT NULL COMMENT '图片',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='用户会员特权表';

");

if(!pdo_fieldexists('hyb_yl_vip_quanyi','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_quanyi')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_vip_quanyi','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_quanyi')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_vip_quanyi','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_quanyi')." ADD   `title` varchar(255) NOT NULL COMMENT '特权名称'");}
if(!pdo_fieldexists('hyb_yl_vip_quanyi','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_quanyi')." ADD   `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '特权类型(0：按类型；1：关闭）'");}
if(!pdo_fieldexists('hyb_yl_vip_quanyi','quanyi')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_quanyi')." ADD   `quanyi` text NOT NULL COMMENT '权益选择'");}
if(!pdo_fieldexists('hyb_yl_vip_quanyi','zhekou')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_quanyi')." ADD   `zhekou` decimal(11,1) NOT NULL COMMENT '特权折扣'");}
if(!pdo_fieldexists('hyb_yl_vip_quanyi','is_mianfei')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_quanyi')." ADD   `is_mianfei` tinyint(2) NOT NULL COMMENT '是否开启免费问诊'");}
if(!pdo_fieldexists('hyb_yl_vip_quanyi','mianfei_num')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_quanyi')." ADD   `mianfei_num` int(11) NOT NULL COMMENT '免费追问次数'");}
if(!pdo_fieldexists('hyb_yl_vip_quanyi','xianzhi')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_quanyi')." ADD   `xianzhi` varchar(255) NOT NULL COMMENT '使用限制'");}
if(!pdo_fieldexists('hyb_yl_vip_quanyi','mfwz_num')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_quanyi')." ADD   `mfwz_num` int(11) NOT NULL COMMENT '免费问诊次数'");}
if(!pdo_fieldexists('hyb_yl_vip_quanyi','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_quanyi')." ADD   `content` text NOT NULL COMMENT '使用说明'");}
if(!pdo_fieldexists('hyb_yl_vip_quanyi','sort')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_quanyi')." ADD   `sort` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('hyb_yl_vip_quanyi','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_quanyi')." ADD   `status` tinyint(2) NOT NULL COMMENT '状态（0：隐藏；1：显示）'");}
if(!pdo_fieldexists('hyb_yl_vip_quanyi','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_quanyi')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_vip_quanyi','thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_quanyi')." ADD   `thumb` varchar(255) NOT NULL COMMENT '图片'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_vip_setting` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) DEFAULT NULL,
  `setting_title` varchar(255) DEFAULT NULL COMMENT '会员卡背景标题',
  `setting_goumai_content` varchar(255) DEFAULT NULL COMMENT '会员购买沟内',
  `setting_zengsong_content` varchar(255) DEFAULT NULL COMMENT '赠送内容设置',
  `setting_goumai_thumb` varchar(255) DEFAULT NULL COMMENT '会员购买界面背景图片',
  `setting_zengsong_thumb` varchar(255) DEFAULT NULL COMMENT '会员赠送界面背景图片',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_vip_setting','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_setting')." ADD 
  `id` int(10) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_vip_setting','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_setting')." ADD   `uniacid` int(10) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_vip_setting','setting_title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_setting')." ADD   `setting_title` varchar(255) DEFAULT NULL COMMENT '会员卡背景标题'");}
if(!pdo_fieldexists('hyb_yl_vip_setting','setting_goumai_content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_setting')." ADD   `setting_goumai_content` varchar(255) DEFAULT NULL COMMENT '会员购买沟内'");}
if(!pdo_fieldexists('hyb_yl_vip_setting','setting_zengsong_content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_setting')." ADD   `setting_zengsong_content` varchar(255) DEFAULT NULL COMMENT '赠送内容设置'");}
if(!pdo_fieldexists('hyb_yl_vip_setting','setting_goumai_thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_setting')." ADD   `setting_goumai_thumb` varchar(255) DEFAULT NULL COMMENT '会员购买界面背景图片'");}
if(!pdo_fieldexists('hyb_yl_vip_setting','setting_zengsong_thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_vip_setting')." ADD   `setting_zengsong_thumb` varchar(255) DEFAULT NULL COMMENT '会员赠送界面背景图片'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_visit` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `openid` varchar(255) NOT NULL COMMENT '用户openid',
  `zid` int(11) DEFAULT NULL COMMENT '专家id',
  `tid` int(11) DEFAULT NULL COMMENT '团队id',
  `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '访问类型（0：小程序；1：专家；2：团队）',
  `created` int(11) NOT NULL COMMENT '添加时间',
  `day` varchar(50) DEFAULT NULL COMMENT '添加日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5861 DEFAULT CHARSET=utf8 COMMENT='访问统计表';

");

if(!pdo_fieldexists('hyb_yl_visit','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_visit')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_visit','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_visit')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_visit','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_visit')." ADD   `openid` varchar(255) NOT NULL COMMENT '用户openid'");}
if(!pdo_fieldexists('hyb_yl_visit','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_visit')." ADD   `zid` int(11) DEFAULT NULL COMMENT '专家id'");}
if(!pdo_fieldexists('hyb_yl_visit','tid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_visit')." ADD   `tid` int(11) DEFAULT NULL COMMENT '团队id'");}
if(!pdo_fieldexists('hyb_yl_visit','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_visit')." ADD   `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '访问类型（0：小程序；1：专家；2：团队）'");}
if(!pdo_fieldexists('hyb_yl_visit','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_visit')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_visit','day')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_visit')." ADD   `day` varchar(50) DEFAULT NULL COMMENT '添加日期'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_wenzhenrule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `chaoshi` int(11) NOT NULL COMMENT '未支付订单超过取消分钟数',
  `over` int(11) NOT NULL COMMENT '问题文追加自动结束分钟数',
  `p_jiezhen` int(11) NOT NULL COMMENT '支付后未接诊分钟数',
  `mianfei_num` int(11) NOT NULL COMMENT '免费追问次数',
  `chao_price` decimal(11,2) NOT NULL COMMENT '超过每次追加价格',
  `default_telnum` int(11) NOT NULL COMMENT '电话问诊默认分钟',
  `default_telprice` decimal(11,2) NOT NULL COMMENT '电话问诊价格（分/元）',
  `default_spnum` int(11) NOT NULL COMMENT '视频问诊默认分钟',
  `default_spprice` decimal(11,2) NOT NULL COMMENT '视频问诊价格（分/元）',
  `created` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='问诊规则设置表';

");

if(!pdo_fieldexists('hyb_yl_wenzhenrule','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzhenrule')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_wenzhenrule','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzhenrule')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_wenzhenrule','chaoshi')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzhenrule')." ADD   `chaoshi` int(11) NOT NULL COMMENT '未支付订单超过取消分钟数'");}
if(!pdo_fieldexists('hyb_yl_wenzhenrule','over')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzhenrule')." ADD   `over` int(11) NOT NULL COMMENT '问题文追加自动结束分钟数'");}
if(!pdo_fieldexists('hyb_yl_wenzhenrule','p_jiezhen')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzhenrule')." ADD   `p_jiezhen` int(11) NOT NULL COMMENT '支付后未接诊分钟数'");}
if(!pdo_fieldexists('hyb_yl_wenzhenrule','mianfei_num')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzhenrule')." ADD   `mianfei_num` int(11) NOT NULL COMMENT '免费追问次数'");}
if(!pdo_fieldexists('hyb_yl_wenzhenrule','chao_price')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzhenrule')." ADD   `chao_price` decimal(11,2) NOT NULL COMMENT '超过每次追加价格'");}
if(!pdo_fieldexists('hyb_yl_wenzhenrule','default_telnum')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzhenrule')." ADD   `default_telnum` int(11) NOT NULL COMMENT '电话问诊默认分钟'");}
if(!pdo_fieldexists('hyb_yl_wenzhenrule','default_telprice')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzhenrule')." ADD   `default_telprice` decimal(11,2) NOT NULL COMMENT '电话问诊价格（分/元）'");}
if(!pdo_fieldexists('hyb_yl_wenzhenrule','default_spnum')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzhenrule')." ADD   `default_spnum` int(11) NOT NULL COMMENT '视频问诊默认分钟'");}
if(!pdo_fieldexists('hyb_yl_wenzhenrule','default_spprice')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzhenrule')." ADD   `default_spprice` decimal(11,2) NOT NULL COMMENT '视频问诊价格（分/元）'");}
if(!pdo_fieldexists('hyb_yl_wenzhenrule','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzhenrule')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_wenzorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `describe` text NOT NULL COMMENT '描述',
  `ifpay` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0待支付1已支付待接诊2接诊中3已完成待评价4已评价5申请退款6退款成功7订单关闭8已取消',
  `keywords` varchar(255) NOT NULL COMMENT '关键词',
  `money` float(7,2) NOT NULL COMMENT '预约金额',
  `month_time` varchar(255) NOT NULL COMMENT '预约时间',
  `openid` varchar(255) NOT NULL COMMENT 'y用户',
  `orders` varchar(255) NOT NULL COMMENT 'd订单号',
  `startime` int(11) NOT NULL COMMENT '预约开始时间',
  `endtime` int(11) NOT NULL COMMENT '结束时间',
  `tell` varchar(12) NOT NULL COMMENT '患者电话',
  `time` int(11) NOT NULL COMMENT '下单时间',
  `week` varchar(255) NOT NULL COMMENT 'x星期',
  `year` varchar(255) NOT NULL COMMENT '预约年',
  `zid` int(11) NOT NULL COMMENT 'z专家id',
  `privateNum` varchar(50) NOT NULL COMMENT '专家隐私电话',
  `back_orser` varchar(255) NOT NULL COMMENT '上级订单号',
  `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1一级订单2二级订单',
  `min` int(11) NOT NULL COMMENT '电话时长',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '0用户提问 医生回答问题带id',
  `j_id` int(11) NOT NULL COMMENT '患者建档ID',
  `addnum` int(11) NOT NULL COMMENT '追问次数',
  `role` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0用户1医生',
  `userId` varchar(255) NOT NULL,
  `userSig` text NOT NULL,
  `roomID` int(11) NOT NULL,
  `sdkAppID` varchar(255) NOT NULL,
  `userId2` varchar(255) NOT NULL,
  `userSig2` text NOT NULL,
  `template` varchar(255) NOT NULL,
  `ifgk` tinyint(2) NOT NULL DEFAULT '0' COMMENT '不公开',
  `pay_type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '支付方式(0：微信支付；1：余额支付）',
  `overtime` int(11) NOT NULL COMMENT '订单过期时间',
  `dumiao` varchar(255) NOT NULL COMMENT '倒计时',
  `paytime` int(11) NOT NULL DEFAULT '0' COMMENT '下单时间',
  `jz_time` int(11) NOT NULL COMMENT '接诊时间',
  `apply_time` int(11) NOT NULL COMMENT '申请退款时间',
  `refund_time` int(11) NOT NULL COMMENT '退款时间',
  `old_money` decimal(11,2) NOT NULL COMMENT '订单原价',
  `coupon_id` int(11) NOT NULL COMMENT '优惠券id',
  `coupon_dk` decimal(11,2) NOT NULL COMMENT '优惠券抵扣',
  `yid` int(11) NOT NULL COMMENT '年卡id',
  `year_dk` decimal(11,2) NOT NULL COMMENT '年卡抵扣金额',
  `ifgb` tinyint(2) NOT NULL,
  `mp3` varchar(255) NOT NULL,
  `thtime` varchar(255) NOT NULL,
  `card_dk` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '会员卡抵扣',
  `ptmoney` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '平台抽成',
  `docmoney` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '专家抽成',
  `hosmoney` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '机构抽成',
  `tk_one` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '推客一级抽成',
  `tk_two` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '推客二级抽成',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_wenzorder','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_wenzorder','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_wenzorder','describe')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `describe` text NOT NULL COMMENT '描述'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','ifpay')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `ifpay` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0待支付1已支付待接诊2接诊中3已完成待评价4已评价5申请退款6退款成功7订单关闭8已取消'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','keywords')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `keywords` varchar(255) NOT NULL COMMENT '关键词'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `money` float(7,2) NOT NULL COMMENT '预约金额'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','month_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `month_time` varchar(255) NOT NULL COMMENT '预约时间'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `openid` varchar(255) NOT NULL COMMENT 'y用户'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','orders')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `orders` varchar(255) NOT NULL COMMENT 'd订单号'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','startime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `startime` int(11) NOT NULL COMMENT '预约开始时间'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','endtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `endtime` int(11) NOT NULL COMMENT '结束时间'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','tell')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `tell` varchar(12) NOT NULL COMMENT '患者电话'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `time` int(11) NOT NULL COMMENT '下单时间'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','week')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `week` varchar(255) NOT NULL COMMENT 'x星期'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','year')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `year` varchar(255) NOT NULL COMMENT '预约年'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `zid` int(11) NOT NULL COMMENT 'z专家id'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','privateNum')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `privateNum` varchar(50) NOT NULL COMMENT '专家隐私电话'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','back_orser')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `back_orser` varchar(255) NOT NULL COMMENT '上级订单号'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1一级订单2二级订单'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','min')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `min` int(11) NOT NULL COMMENT '电话时长'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','pid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `pid` int(11) NOT NULL DEFAULT '0' COMMENT '0用户提问 医生回答问题带id'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','j_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `j_id` int(11) NOT NULL COMMENT '患者建档ID'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','addnum')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `addnum` int(11) NOT NULL COMMENT '追问次数'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','role')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `role` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0用户1医生'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','userId')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `userId` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_wenzorder','userSig')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `userSig` text NOT NULL");}
if(!pdo_fieldexists('hyb_yl_wenzorder','roomID')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `roomID` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_wenzorder','sdkAppID')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `sdkAppID` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_wenzorder','userId2')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `userId2` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_wenzorder','userSig2')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `userSig2` text NOT NULL");}
if(!pdo_fieldexists('hyb_yl_wenzorder','template')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `template` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_wenzorder','ifgk')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `ifgk` tinyint(2) NOT NULL DEFAULT '0' COMMENT '不公开'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','pay_type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `pay_type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '支付方式(0：微信支付；1：余额支付）'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','overtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `overtime` int(11) NOT NULL COMMENT '订单过期时间'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','dumiao')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `dumiao` varchar(255) NOT NULL COMMENT '倒计时'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','paytime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `paytime` int(11) NOT NULL DEFAULT '0' COMMENT '下单时间'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','jz_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `jz_time` int(11) NOT NULL COMMENT '接诊时间'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','apply_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `apply_time` int(11) NOT NULL COMMENT '申请退款时间'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','refund_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `refund_time` int(11) NOT NULL COMMENT '退款时间'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','old_money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `old_money` decimal(11,2) NOT NULL COMMENT '订单原价'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','coupon_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `coupon_id` int(11) NOT NULL COMMENT '优惠券id'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','coupon_dk')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `coupon_dk` decimal(11,2) NOT NULL COMMENT '优惠券抵扣'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','yid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `yid` int(11) NOT NULL COMMENT '年卡id'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','year_dk')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `year_dk` decimal(11,2) NOT NULL COMMENT '年卡抵扣金额'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','ifgb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `ifgb` tinyint(2) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_wenzorder','mp3')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `mp3` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_wenzorder','thtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `thtime` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_wenzorder','card_dk')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `card_dk` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '会员卡抵扣'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','ptmoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `ptmoney` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '平台抽成'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','docmoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `docmoney` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '专家抽成'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','hosmoney')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `hosmoney` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '机构抽成'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','tk_one')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `tk_one` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '推客一级抽成'");}
if(!pdo_fieldexists('hyb_yl_wenzorder','tk_two')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wenzorder')." ADD   `tk_two` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '推客二级抽成'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_wxapptemp` (
  `w_id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `doctemp` varchar(255) NOT NULL COMMENT '患者咨询信息提醒',
  `kaiguan` int(11) NOT NULL DEFAULT '0',
  `txtempt` varchar(255) NOT NULL,
  `weidbb` varchar(255) NOT NULL,
  `cforder` varchar(255) NOT NULL,
  `paymobel` varchar(255) NOT NULL,
  `kzyytongz` varchar(255) NOT NULL,
  `tixuser` varchar(255) NOT NULL COMMENT '提醒用户',
  `yqtemp` varchar(255) NOT NULL,
  `jujyaoqi` varchar(255) NOT NULL,
  `qiany` varchar(255) NOT NULL,
  PRIMARY KEY (`w_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_wxapptemp','w_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wxapptemp')." ADD 
  `w_id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_wxapptemp','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wxapptemp')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_wxapptemp','doctemp')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wxapptemp')." ADD   `doctemp` varchar(255) NOT NULL COMMENT '患者咨询信息提醒'");}
if(!pdo_fieldexists('hyb_yl_wxapptemp','kaiguan')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wxapptemp')." ADD   `kaiguan` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('hyb_yl_wxapptemp','txtempt')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wxapptemp')." ADD   `txtempt` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_wxapptemp','weidbb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wxapptemp')." ADD   `weidbb` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_wxapptemp','cforder')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wxapptemp')." ADD   `cforder` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_wxapptemp','paymobel')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wxapptemp')." ADD   `paymobel` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_wxapptemp','kzyytongz')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wxapptemp')." ADD   `kzyytongz` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_wxapptemp','tixuser')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wxapptemp')." ADD   `tixuser` varchar(255) NOT NULL COMMENT '提醒用户'");}
if(!pdo_fieldexists('hyb_yl_wxapptemp','yqtemp')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wxapptemp')." ADD   `yqtemp` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_wxapptemp','jujyaoqi')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wxapptemp')." ADD   `jujyaoqi` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_wxapptemp','qiany')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_wxapptemp')." ADD   `qiany` varchar(255) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_yaoqingdoc` (
  `yao_id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `zid` int(11) NOT NULL COMMENT '专家id',
  `yao_type` int(11) NOT NULL DEFAULT '0' COMMENT '0邀请中；1已同意；2已拒绝;3申请中',
  `yao_time` int(11) NOT NULL COMMENT '时间',
  `openid` varchar(255) NOT NULL COMMENT '邀请人openID',
  `t_id` int(11) NOT NULL DEFAULT '0' COMMENT '团队ID',
  `state` int(11) NOT NULL DEFAULT '0' COMMENT '0邀请记录1申请记录',
  PRIMARY KEY (`yao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_yaoqingdoc','yao_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoqingdoc')." ADD 
  `yao_id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_yaoqingdoc','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoqingdoc')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_yaoqingdoc','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoqingdoc')." ADD   `zid` int(11) NOT NULL COMMENT '专家id'");}
if(!pdo_fieldexists('hyb_yl_yaoqingdoc','yao_type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoqingdoc')." ADD   `yao_type` int(11) NOT NULL DEFAULT '0' COMMENT '0邀请中；1已同意；2已拒绝;3申请中'");}
if(!pdo_fieldexists('hyb_yl_yaoqingdoc','yao_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoqingdoc')." ADD   `yao_time` int(11) NOT NULL COMMENT '时间'");}
if(!pdo_fieldexists('hyb_yl_yaoqingdoc','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoqingdoc')." ADD   `openid` varchar(255) NOT NULL COMMENT '邀请人openID'");}
if(!pdo_fieldexists('hyb_yl_yaoqingdoc','t_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoqingdoc')." ADD   `t_id` int(11) NOT NULL DEFAULT '0' COMMENT '团队ID'");}
if(!pdo_fieldexists('hyb_yl_yaoqingdoc','state')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoqingdoc')." ADD   `state` int(11) NOT NULL DEFAULT '0' COMMENT '0邀请记录1申请记录'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_yaoshi` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `thumb` varchar(255) NOT NULL COMMENT '缩略图',
  `title` varchar(255) NOT NULL COMMENT '名称',
  `money` decimal(11,2) NOT NULL COMMENT '余额',
  `jigou_one` int(11) NOT NULL COMMENT '一级机构id',
  `jigou_two` int(11) NOT NULL COMMENT '二级机构id',
  `add_time` int(11) NOT NULL COMMENT '加入时间',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：待审核；1：审核通过；2：审核拒绝；3：暂停中）',
  `ruzhu_endtime` int(11) NOT NULL COMMENT '入驻截止时间',
  `ruzhu_time` int(11) NOT NULL COMMENT '入驻开始时间',
  `openid` varchar(255) NOT NULL COMMENT '绑定微信',
  `telphone` varchar(50) NOT NULL COMMENT '联系电话',
  `name` varchar(255) NOT NULL COMMENT '联系人姓名',
  `typs` tinyint(2) NOT NULL DEFAULT '1' COMMENT '工作状态（0：休息中；1：工作中）',
  `jigou_name` varchar(255) NOT NULL COMMENT '机构名称',
  `created` int(11) NOT NULL COMMENT '添加时间',
  `sex` tinyint(2) NOT NULL DEFAULT '0' COMMENT '性别（0：女；1：男）',
  `idcard` varchar(50) NOT NULL COMMENT '身份证号',
  `province` varchar(100) NOT NULL COMMENT '所在省',
  `city` varchar(100) NOT NULL COMMENT '所在市',
  `district` varchar(100) NOT NULL COMMENT '所在区',
  `lon` varchar(50) NOT NULL,
  `lat` varchar(50) NOT NULL,
  `keshi_one` int(11) NOT NULL COMMENT '科室一级',
  `keshi_two` int(11) NOT NULL COMMENT '科室二级',
  `login_name` varchar(100) NOT NULL COMMENT '药师账号',
  `login_pass` varchar(255) NOT NULL COMMENT '药师密码',
  `is_index` tinyint(2) NOT NULL DEFAULT '1' COMMENT '是否在列表显示（0：隐藏；1：显示）',
  `sort` int(11) NOT NULL COMMENT '排序',
  `cut` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '药师订单抽成',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_yaoshi','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoshi')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_yaoshi','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoshi')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_yaoshi','thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoshi')." ADD   `thumb` varchar(255) NOT NULL COMMENT '缩略图'");}
if(!pdo_fieldexists('hyb_yl_yaoshi','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoshi')." ADD   `title` varchar(255) NOT NULL COMMENT '名称'");}
if(!pdo_fieldexists('hyb_yl_yaoshi','money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoshi')." ADD   `money` decimal(11,2) NOT NULL COMMENT '余额'");}
if(!pdo_fieldexists('hyb_yl_yaoshi','jigou_one')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoshi')." ADD   `jigou_one` int(11) NOT NULL COMMENT '一级机构id'");}
if(!pdo_fieldexists('hyb_yl_yaoshi','jigou_two')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoshi')." ADD   `jigou_two` int(11) NOT NULL COMMENT '二级机构id'");}
if(!pdo_fieldexists('hyb_yl_yaoshi','add_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoshi')." ADD   `add_time` int(11) NOT NULL COMMENT '加入时间'");}
if(!pdo_fieldexists('hyb_yl_yaoshi','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoshi')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：待审核；1：审核通过；2：审核拒绝；3：暂停中）'");}
if(!pdo_fieldexists('hyb_yl_yaoshi','ruzhu_endtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoshi')." ADD   `ruzhu_endtime` int(11) NOT NULL COMMENT '入驻截止时间'");}
if(!pdo_fieldexists('hyb_yl_yaoshi','ruzhu_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoshi')." ADD   `ruzhu_time` int(11) NOT NULL COMMENT '入驻开始时间'");}
if(!pdo_fieldexists('hyb_yl_yaoshi','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoshi')." ADD   `openid` varchar(255) NOT NULL COMMENT '绑定微信'");}
if(!pdo_fieldexists('hyb_yl_yaoshi','telphone')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoshi')." ADD   `telphone` varchar(50) NOT NULL COMMENT '联系电话'");}
if(!pdo_fieldexists('hyb_yl_yaoshi','name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoshi')." ADD   `name` varchar(255) NOT NULL COMMENT '联系人姓名'");}
if(!pdo_fieldexists('hyb_yl_yaoshi','typs')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoshi')." ADD   `typs` tinyint(2) NOT NULL DEFAULT '1' COMMENT '工作状态（0：休息中；1：工作中）'");}
if(!pdo_fieldexists('hyb_yl_yaoshi','jigou_name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoshi')." ADD   `jigou_name` varchar(255) NOT NULL COMMENT '机构名称'");}
if(!pdo_fieldexists('hyb_yl_yaoshi','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoshi')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_yaoshi','sex')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoshi')." ADD   `sex` tinyint(2) NOT NULL DEFAULT '0' COMMENT '性别（0：女；1：男）'");}
if(!pdo_fieldexists('hyb_yl_yaoshi','idcard')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoshi')." ADD   `idcard` varchar(50) NOT NULL COMMENT '身份证号'");}
if(!pdo_fieldexists('hyb_yl_yaoshi','province')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoshi')." ADD   `province` varchar(100) NOT NULL COMMENT '所在省'");}
if(!pdo_fieldexists('hyb_yl_yaoshi','city')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoshi')." ADD   `city` varchar(100) NOT NULL COMMENT '所在市'");}
if(!pdo_fieldexists('hyb_yl_yaoshi','district')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoshi')." ADD   `district` varchar(100) NOT NULL COMMENT '所在区'");}
if(!pdo_fieldexists('hyb_yl_yaoshi','lon')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoshi')." ADD   `lon` varchar(50) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_yaoshi','lat')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoshi')." ADD   `lat` varchar(50) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_yaoshi','keshi_one')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoshi')." ADD   `keshi_one` int(11) NOT NULL COMMENT '科室一级'");}
if(!pdo_fieldexists('hyb_yl_yaoshi','keshi_two')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoshi')." ADD   `keshi_two` int(11) NOT NULL COMMENT '科室二级'");}
if(!pdo_fieldexists('hyb_yl_yaoshi','login_name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoshi')." ADD   `login_name` varchar(100) NOT NULL COMMENT '药师账号'");}
if(!pdo_fieldexists('hyb_yl_yaoshi','login_pass')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoshi')." ADD   `login_pass` varchar(255) NOT NULL COMMENT '药师密码'");}
if(!pdo_fieldexists('hyb_yl_yaoshi','is_index')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoshi')." ADD   `is_index` tinyint(2) NOT NULL DEFAULT '1' COMMENT '是否在列表显示（0：隐藏；1：显示）'");}
if(!pdo_fieldexists('hyb_yl_yaoshi','sort')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoshi')." ADD   `sort` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('hyb_yl_yaoshi','cut')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yaoshi')." ADD   `cut` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '药师订单抽成'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_yearcard` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `zid` int(11) NOT NULL COMMENT '专家id',
  `z_name` varchar(255) NOT NULL COMMENT '专家名称',
  `is_mianfei` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否设置免费问诊（0：否；1：是）',
  `is_wzzk` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否设置医生问诊折扣（0：否；1：是）',
  `hh_num` tinyint(4) NOT NULL COMMENT '会话次数',
  `wz_num` int(11) NOT NULL COMMENT '问诊次数',
  `wz_zhekou` int(11) NOT NULL COMMENT '问诊折扣',
  `is_jd` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启医生解读次数（0：否；1：是）',
  `jd_num` int(11) NOT NULL COMMENT '解读次数',
  `num` int(11) NOT NULL COMMENT '库存',
  `old_price` decimal(11,2) NOT NULL COMMENT '原价格',
  `new_price` decimal(11,2) NOT NULL COMMENT '现价格',
  `notes` varchar(255) NOT NULL COMMENT '使用限制',
  `content` text NOT NULL COMMENT '使用说明',
  `sort` int(11) NOT NULL COMMENT '排序',
  `created` int(11) NOT NULL COMMENT '添加时间',
  `s_time` int(11) NOT NULL COMMENT '审核时间',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '审核状态（0：待审核；1：审核通过；2：审核拒绝）',
  `is_hh` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否设置会话次数（0：否；1：是）',
  `times` int(11) NOT NULL COMMENT '时间（/月）',
  `typs` tinyint(2) NOT NULL DEFAULT '1' COMMENT '是否开启（0：否；1：是）',
  `cut` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '年卡抽成',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='年卡列表';

");

if(!pdo_fieldexists('hyb_yl_yearcard','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yearcard')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_yearcard','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yearcard')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_yearcard','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yearcard')." ADD   `zid` int(11) NOT NULL COMMENT '专家id'");}
if(!pdo_fieldexists('hyb_yl_yearcard','z_name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yearcard')." ADD   `z_name` varchar(255) NOT NULL COMMENT '专家名称'");}
if(!pdo_fieldexists('hyb_yl_yearcard','is_mianfei')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yearcard')." ADD   `is_mianfei` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否设置免费问诊（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_yearcard','is_wzzk')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yearcard')." ADD   `is_wzzk` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否设置医生问诊折扣（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_yearcard','hh_num')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yearcard')." ADD   `hh_num` tinyint(4) NOT NULL COMMENT '会话次数'");}
if(!pdo_fieldexists('hyb_yl_yearcard','wz_num')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yearcard')." ADD   `wz_num` int(11) NOT NULL COMMENT '问诊次数'");}
if(!pdo_fieldexists('hyb_yl_yearcard','wz_zhekou')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yearcard')." ADD   `wz_zhekou` int(11) NOT NULL COMMENT '问诊折扣'");}
if(!pdo_fieldexists('hyb_yl_yearcard','is_jd')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yearcard')." ADD   `is_jd` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启医生解读次数（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_yearcard','jd_num')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yearcard')." ADD   `jd_num` int(11) NOT NULL COMMENT '解读次数'");}
if(!pdo_fieldexists('hyb_yl_yearcard','num')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yearcard')." ADD   `num` int(11) NOT NULL COMMENT '库存'");}
if(!pdo_fieldexists('hyb_yl_yearcard','old_price')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yearcard')." ADD   `old_price` decimal(11,2) NOT NULL COMMENT '原价格'");}
if(!pdo_fieldexists('hyb_yl_yearcard','new_price')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yearcard')." ADD   `new_price` decimal(11,2) NOT NULL COMMENT '现价格'");}
if(!pdo_fieldexists('hyb_yl_yearcard','notes')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yearcard')." ADD   `notes` varchar(255) NOT NULL COMMENT '使用限制'");}
if(!pdo_fieldexists('hyb_yl_yearcard','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yearcard')." ADD   `content` text NOT NULL COMMENT '使用说明'");}
if(!pdo_fieldexists('hyb_yl_yearcard','sort')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yearcard')." ADD   `sort` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('hyb_yl_yearcard','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yearcard')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_yearcard','s_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yearcard')." ADD   `s_time` int(11) NOT NULL COMMENT '审核时间'");}
if(!pdo_fieldexists('hyb_yl_yearcard','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yearcard')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '审核状态（0：待审核；1：审核通过；2：审核拒绝）'");}
if(!pdo_fieldexists('hyb_yl_yearcard','is_hh')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yearcard')." ADD   `is_hh` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否设置会话次数（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_yearcard','times')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yearcard')." ADD   `times` int(11) NOT NULL COMMENT '时间（/月）'");}
if(!pdo_fieldexists('hyb_yl_yearcard','typs')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yearcard')." ADD   `typs` tinyint(2) NOT NULL DEFAULT '1' COMMENT '是否开启（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_yearcard','cut')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yearcard')." ADD   `cut` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '年卡抽成'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_ys_rule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `content` text NOT NULL COMMENT '药师协议',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启自动审核（0：否；1：是）',
  `created` int(11) NOT NULL COMMENT '添加时间',
  `is_shenhe` tinyint(2) NOT NULL DEFAULT '1' COMMENT '是否开启处方审核（0：否；1：是）',
  `sh_fee` int(11) NOT NULL COMMENT '药师审核抽成',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='药师规则设置';

");

if(!pdo_fieldexists('hyb_yl_ys_rule','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_ys_rule')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_ys_rule','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_ys_rule')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_ys_rule','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_ys_rule')." ADD   `content` text NOT NULL COMMENT '药师协议'");}
if(!pdo_fieldexists('hyb_yl_ys_rule','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_ys_rule')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启自动审核（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_ys_rule','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_ys_rule')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_ys_rule','is_shenhe')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_ys_rule')." ADD   `is_shenhe` tinyint(2) NOT NULL DEFAULT '1' COMMENT '是否开启处方审核（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_ys_rule','sh_fee')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_ys_rule')." ADD   `sh_fee` int(11) NOT NULL COMMENT '药师审核抽成'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_yunfei` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT '模板名称',
  `uniacid` int(11) NOT NULL,
  `detail` text NOT NULL COMMENT '运费详情',
  `created` int(11) NOT NULL COMMENT '添加时间',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态（0：禁用；1：启用）',
  `update` int(11) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='快递运费表';

");

if(!pdo_fieldexists('hyb_yl_yunfei','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yunfei')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_yunfei','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yunfei')." ADD   `title` varchar(255) NOT NULL COMMENT '模板名称'");}
if(!pdo_fieldexists('hyb_yl_yunfei','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yunfei')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_yunfei','detail')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yunfei')." ADD   `detail` text NOT NULL COMMENT '运费详情'");}
if(!pdo_fieldexists('hyb_yl_yunfei','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yunfei')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_yunfei','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yunfei')." ADD   `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态（0：禁用；1：启用）'");}
if(!pdo_fieldexists('hyb_yl_yunfei','update')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yunfei')." ADD   `update` int(11) NOT NULL COMMENT '修改时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_yuyueorder` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `openid` varchar(255) NOT NULL COMMENT '用户标识',
  `created` int(11) NOT NULL COMMENT '添加时间',
  `zid` int(11) NOT NULL COMMENT '专家id',
  `yy_time` int(11) NOT NULL COMMENT '预约时间',
  `yy_content` text NOT NULL COMMENT '预约内容',
  `notes` text NOT NULL COMMENT '备注',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '预约状态（0：已预约；1：已就诊；2：失约；3：已取消）',
  `yy_type` int(11) NOT NULL COMMENT '预约类型',
  `keshi_one` int(11) NOT NULL COMMENT '一级科室id',
  `keshi_two` int(11) NOT NULL COMMENT '二级科室id',
  `money` decimal(11,2) NOT NULL COMMENT '挂号费',
  `times` tinyint(2) NOT NULL DEFAULT '0' COMMENT '时间段（0：上午；1：下午）',
  `jigou_one` int(11) NOT NULL COMMENT '一级机构id',
  `jigou_two` int(11) NOT NULL COMMENT '二级机构id',
  `ordersn` varchar(255) NOT NULL COMMENT '订单号',
  `jz_times` int(11) NOT NULL COMMENT '就诊时间',
  `qx_time` int(11) NOT NULL COMMENT '取消时间',
  `is_pay` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否支付（0：未付款；1：已付款）',
  `p_time` int(11) NOT NULL COMMENT '支付时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='挂号预约表';

");

if(!pdo_fieldexists('hyb_yl_yuyueorder','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yuyueorder')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_yuyueorder','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yuyueorder')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_yuyueorder','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yuyueorder')." ADD   `openid` varchar(255) NOT NULL COMMENT '用户标识'");}
if(!pdo_fieldexists('hyb_yl_yuyueorder','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yuyueorder')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_yuyueorder','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yuyueorder')." ADD   `zid` int(11) NOT NULL COMMENT '专家id'");}
if(!pdo_fieldexists('hyb_yl_yuyueorder','yy_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yuyueorder')." ADD   `yy_time` int(11) NOT NULL COMMENT '预约时间'");}
if(!pdo_fieldexists('hyb_yl_yuyueorder','yy_content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yuyueorder')." ADD   `yy_content` text NOT NULL COMMENT '预约内容'");}
if(!pdo_fieldexists('hyb_yl_yuyueorder','notes')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yuyueorder')." ADD   `notes` text NOT NULL COMMENT '备注'");}
if(!pdo_fieldexists('hyb_yl_yuyueorder','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yuyueorder')." ADD   `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '预约状态（0：已预约；1：已就诊；2：失约；3：已取消）'");}
if(!pdo_fieldexists('hyb_yl_yuyueorder','yy_type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yuyueorder')." ADD   `yy_type` int(11) NOT NULL COMMENT '预约类型'");}
if(!pdo_fieldexists('hyb_yl_yuyueorder','keshi_one')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yuyueorder')." ADD   `keshi_one` int(11) NOT NULL COMMENT '一级科室id'");}
if(!pdo_fieldexists('hyb_yl_yuyueorder','keshi_two')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yuyueorder')." ADD   `keshi_two` int(11) NOT NULL COMMENT '二级科室id'");}
if(!pdo_fieldexists('hyb_yl_yuyueorder','money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yuyueorder')." ADD   `money` decimal(11,2) NOT NULL COMMENT '挂号费'");}
if(!pdo_fieldexists('hyb_yl_yuyueorder','times')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yuyueorder')." ADD   `times` tinyint(2) NOT NULL DEFAULT '0' COMMENT '时间段（0：上午；1：下午）'");}
if(!pdo_fieldexists('hyb_yl_yuyueorder','jigou_one')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yuyueorder')." ADD   `jigou_one` int(11) NOT NULL COMMENT '一级机构id'");}
if(!pdo_fieldexists('hyb_yl_yuyueorder','jigou_two')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yuyueorder')." ADD   `jigou_two` int(11) NOT NULL COMMENT '二级机构id'");}
if(!pdo_fieldexists('hyb_yl_yuyueorder','ordersn')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yuyueorder')." ADD   `ordersn` varchar(255) NOT NULL COMMENT '订单号'");}
if(!pdo_fieldexists('hyb_yl_yuyueorder','jz_times')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yuyueorder')." ADD   `jz_times` int(11) NOT NULL COMMENT '就诊时间'");}
if(!pdo_fieldexists('hyb_yl_yuyueorder','qx_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yuyueorder')." ADD   `qx_time` int(11) NOT NULL COMMENT '取消时间'");}
if(!pdo_fieldexists('hyb_yl_yuyueorder','is_pay')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yuyueorder')." ADD   `is_pay` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否支付（0：未付款；1：已付款）'");}
if(!pdo_fieldexists('hyb_yl_yuyueorder','p_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_yuyueorder')." ADD   `p_time` int(11) NOT NULL COMMENT '支付时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_zhenzhuang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `name` varchar(30) NOT NULL COMMENT '标题',
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否开启',
  `icon` varchar(255) NOT NULL COMMENT '图标',
  `pid` int(11) NOT NULL DEFAULT '-1' COMMENT '上级id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='症状表';

");

if(!pdo_fieldexists('hyb_yl_zhenzhuang','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhenzhuang')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_zhenzhuang','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhenzhuang')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_zhenzhuang','name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhenzhuang')." ADD   `name` varchar(30) NOT NULL COMMENT '标题'");}
if(!pdo_fieldexists('hyb_yl_zhenzhuang','enabled')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhenzhuang')." ADD   `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否开启'");}
if(!pdo_fieldexists('hyb_yl_zhenzhuang','icon')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhenzhuang')." ADD   `icon` varchar(255) NOT NULL COMMENT '图标'");}
if(!pdo_fieldexists('hyb_yl_zhenzhuang','pid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhenzhuang')." ADD   `pid` int(11) NOT NULL DEFAULT '-1' COMMENT '上级id'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_zhuanjia` (
  `zid` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `openid` varchar(255) NOT NULL COMMENT '用户openid',
  `z_name` varchar(50) NOT NULL COMMENT '专家名字',
  `sord` int(11) NOT NULL COMMENT '排序',
  `score` int(11) NOT NULL DEFAULT '5' COMMENT '评分',
  `lng` varchar(255) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `z_sex` tinyint(2) NOT NULL COMMENT '性别',
  `sfzbianhao` varchar(255) NOT NULL COMMENT 's身份证',
  `advertisement` varchar(255) NOT NULL COMMENT '头像',
  `z_telephone` varchar(255) NOT NULL COMMENT 'd电话',
  `z_zhicheng` int(11) NOT NULL COMMENT '职称ID',
  `address` varchar(255) NOT NULL COMMENT 's所在地',
  `z_room` int(11) NOT NULL COMMENT '一级科室分类',
  `parentid` int(11) NOT NULL COMMENT '二级科室id',
  `authority` varchar(255) NOT NULL COMMENT '擅长',
  `username` varchar(255) NOT NULL COMMENT 'z账号',
  `password` varchar(255) NOT NULL COMMENT '密码',
  `groupid` varchar(50) NOT NULL COMMENT 'f分组id',
  `gzstype` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0休息1工作中',
  `qx_id` int(11) NOT NULL COMMENT '所属机构权限id',
  `hid` int(11) NOT NULL COMMENT '机构id',
  `listshow` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0显示1不显示在列表中',
  `exa` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0代入驻1入驻中2暂停中3：审核拒绝',
  `endtime` varchar(255) NOT NULL COMMENT '入驻结束时间',
  `sfzimgurl1back` varchar(255) NOT NULL COMMENT 's身份证正面照',
  `sfzimgurl2back` varchar(255) NOT NULL COMMENT '身份证反面照',
  `xn_reoly` varchar(50) NOT NULL COMMENT 'x虚拟回答量',
  `xn_cf` varchar(50) NOT NULL COMMENT '虚拟处方数',
  `xytime` varchar(50) NOT NULL DEFAULT '分钟' COMMENT '虚拟响应时间',
  `zgzimgurl1back` varchar(255) NOT NULL COMMENT 'g工作照',
  `z_content` varchar(255) NOT NULL COMMENT '简介',
  `plugin` text NOT NULL,
  `opentime` varchar(50) NOT NULL COMMENT 'z注册时间',
  `privateNum` varchar(50) NOT NULL COMMENT '绑定的手机号',
  `weweima` varchar(255) NOT NULL COMMENT '专家二维码',
  `share_erweima` varchar(255) NOT NULL COMMENT '分享二维码',
  `is_green` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否为绿通人员（0：否；1：是）',
  `is_examine` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否为陪诊人员（0：否；1：是）',
  `is_urgent` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否支持加急（0：否；1：是）',
  `video` varchar(255) NOT NULL COMMENT '专家视频',
  `video_thumb` varchar(255) NOT NULL COMMENT '视频封面',
  `total_money` float(8,2) NOT NULL COMMENT '总金额',
  `jingxuan` varchar(255) NOT NULL,
  `qianynum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '签约提醒次数',
  `tixiannum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '提现提醒次数',
  `qyperson` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '签约最新人数',
  `ptperson` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '问诊最新人数',
  `grperson` int(11) unsigned NOT NULL DEFAULT '0',
  `is_picc` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否接受PICC护理服务（0：否；1：是）',
  `jobtime` int(11) NOT NULL COMMENT '排版设置',
  `cut` decimal(11,2) NOT NULL COMMENT '专家订单抽成',
  `register_jobtime` int(11) NOT NULL COMMENT '挂号排版设置',
  `ky_cut` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '开药抽成',
  `tkid` int(11) NOT NULL COMMENT 't推客id',
  PRIMARY KEY (`zid`)
) ENGINE=MyISAM AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_zhuanjia','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD 
  `zid` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `openid` varchar(255) NOT NULL COMMENT '用户openid'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','z_name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `z_name` varchar(50) NOT NULL COMMENT '专家名字'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','sord')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `sord` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','score')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `score` int(11) NOT NULL DEFAULT '5' COMMENT '评分'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','lng')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `lng` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','lat')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `lat` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','z_sex')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `z_sex` tinyint(2) NOT NULL COMMENT '性别'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','sfzbianhao')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `sfzbianhao` varchar(255) NOT NULL COMMENT 's身份证'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','advertisement')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `advertisement` varchar(255) NOT NULL COMMENT '头像'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','z_telephone')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `z_telephone` varchar(255) NOT NULL COMMENT 'd电话'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','z_zhicheng')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `z_zhicheng` int(11) NOT NULL COMMENT '职称ID'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','address')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `address` varchar(255) NOT NULL COMMENT 's所在地'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','z_room')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `z_room` int(11) NOT NULL COMMENT '一级科室分类'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','parentid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `parentid` int(11) NOT NULL COMMENT '二级科室id'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','authority')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `authority` varchar(255) NOT NULL COMMENT '擅长'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','username')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `username` varchar(255) NOT NULL COMMENT 'z账号'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','password')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `password` varchar(255) NOT NULL COMMENT '密码'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','groupid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `groupid` varchar(50) NOT NULL COMMENT 'f分组id'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','gzstype')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `gzstype` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0休息1工作中'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','qx_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `qx_id` int(11) NOT NULL COMMENT '所属机构权限id'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','hid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `hid` int(11) NOT NULL COMMENT '机构id'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','listshow')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `listshow` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0显示1不显示在列表中'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','exa')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `exa` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0代入驻1入驻中2暂停中3：审核拒绝'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','endtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `endtime` varchar(255) NOT NULL COMMENT '入驻结束时间'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','sfzimgurl1back')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `sfzimgurl1back` varchar(255) NOT NULL COMMENT 's身份证正面照'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','sfzimgurl2back')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `sfzimgurl2back` varchar(255) NOT NULL COMMENT '身份证反面照'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','xn_reoly')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `xn_reoly` varchar(50) NOT NULL COMMENT 'x虚拟回答量'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','xn_cf')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `xn_cf` varchar(50) NOT NULL COMMENT '虚拟处方数'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','xytime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `xytime` varchar(50) NOT NULL DEFAULT '分钟' COMMENT '虚拟响应时间'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','zgzimgurl1back')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `zgzimgurl1back` varchar(255) NOT NULL COMMENT 'g工作照'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','z_content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `z_content` varchar(255) NOT NULL COMMENT '简介'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','plugin')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `plugin` text NOT NULL");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','opentime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `opentime` varchar(50) NOT NULL COMMENT 'z注册时间'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','privateNum')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `privateNum` varchar(50) NOT NULL COMMENT '绑定的手机号'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','weweima')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `weweima` varchar(255) NOT NULL COMMENT '专家二维码'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','share_erweima')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `share_erweima` varchar(255) NOT NULL COMMENT '分享二维码'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','is_green')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `is_green` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否为绿通人员（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','is_examine')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `is_examine` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否为陪诊人员（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','is_urgent')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `is_urgent` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否支持加急（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','video')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `video` varchar(255) NOT NULL COMMENT '专家视频'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','video_thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `video_thumb` varchar(255) NOT NULL COMMENT '视频封面'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','total_money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `total_money` float(8,2) NOT NULL COMMENT '总金额'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','jingxuan')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `jingxuan` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','qianynum')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `qianynum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '签约提醒次数'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','tixiannum')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `tixiannum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '提现提醒次数'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','qyperson')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `qyperson` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '签约最新人数'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','ptperson')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `ptperson` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '问诊最新人数'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','grperson')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `grperson` int(11) unsigned NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','is_picc')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `is_picc` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否接受PICC护理服务（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','jobtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `jobtime` int(11) NOT NULL COMMENT '排版设置'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','cut')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `cut` decimal(11,2) NOT NULL COMMENT '专家订单抽成'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','register_jobtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `register_jobtime` int(11) NOT NULL COMMENT '挂号排版设置'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','ky_cut')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `ky_cut` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '开药抽成'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia','tkid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia')." ADD   `tkid` int(11) NOT NULL COMMENT 't推客id'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_zhuanjia_job` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `job_name` varchar(255) NOT NULL COMMENT '职业名称',
  `job_strot` int(11) NOT NULL COMMENT 'p爱旭',
  `job_state` tinyint(11) NOT NULL DEFAULT '1' COMMENT '1开启0关闭',
  `type` tinyint(2) NOT NULL COMMENT '1职称2头衔',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_zhuanjia_job','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_job')." ADD 
  `id` int(10) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_job','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_job')." ADD   `uniacid` int(10) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_job','job_name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_job')." ADD   `job_name` varchar(255) NOT NULL COMMENT '职业名称'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_job','job_strot')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_job')." ADD   `job_strot` int(11) NOT NULL COMMENT 'p爱旭'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_job','job_state')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_job')." ADD   `job_state` tinyint(11) NOT NULL DEFAULT '1' COMMENT '1开启0关闭'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_job','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_job')." ADD   `type` tinyint(2) NOT NULL COMMENT '1职称2头衔'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_zhuanjia_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `zid` int(11) NOT NULL COMMENT '专家id',
  `openid` varchar(255) NOT NULL COMMENT '专家标识',
  `money` decimal(11,2) NOT NULL COMMENT '入住续费金额',
  `s_id` int(11) NOT NULL COMMENT '入驻类型',
  `status` tinyint(2) NOT NULL COMMENT '状态（0：未支付；1：已支付）',
  `created` int(11) NOT NULL COMMENT '添加时间',
  `p_time` int(11) NOT NULL COMMENT '支付时间',
  `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '付费类型（0：入住；1：续费）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='专家入驻消费表';

");

if(!pdo_fieldexists('hyb_yl_zhuanjia_log','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_log')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_log','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_log')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_log','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_log')." ADD   `zid` int(11) NOT NULL COMMENT '专家id'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_log','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_log')." ADD   `openid` varchar(255) NOT NULL COMMENT '专家标识'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_log','money')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_log')." ADD   `money` decimal(11,2) NOT NULL COMMENT '入住续费金额'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_log','s_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_log')." ADD   `s_id` int(11) NOT NULL COMMENT '入驻类型'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_log','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_log')." ADD   `status` tinyint(2) NOT NULL COMMENT '状态（0：未支付；1：已支付）'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_log','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_log')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_log','p_time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_log')." ADD   `p_time` int(11) NOT NULL COMMENT '支付时间'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_log','type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_log')." ADD   `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '付费类型（0：入住；1：续费）'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_zhuanjia_rule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `is_ff` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启付费入住（0：否；1：是）',
  `is_ruzhu` tinyint(2) NOT NULL DEFAULT '0' COMMENT '入住是否免审核（0：否；1：是）',
  `is_huanjiao` tinyint(2) NOT NULL DEFAULT '0' COMMENT '患教是否免审核（0：否；1：是）',
  `is_dongtai` tinyint(2) NOT NULL DEFAULT '0' COMMENT '动态是否免审核（0：否；1：是）',
  `is_pinglun` tinyint(2) NOT NULL DEFAULT '0' COMMENT '评论是否免审核（0：否；1：是）',
  `score` tinyint(2) NOT NULL COMMENT '默认星级',
  `sort_type` tinyint(2) NOT NULL COMMENT '专家列表默认排序方式',
  `rz_content` text NOT NULL COMMENT '入住条款',
  `pay_content` text NOT NULL COMMENT '付费说明',
  `created` int(11) NOT NULL COMMENT '添加时间',
  `background` varchar(255) NOT NULL COMMENT '专家海报背景图',
  `fee` int(11) DEFAULT NULL COMMENT '抽成比例',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='专家规则设置';

");

if(!pdo_fieldexists('hyb_yl_zhuanjia_rule','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_rule')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_rule','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_rule')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_rule','is_ff')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_rule')." ADD   `is_ff` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启付费入住（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_rule','is_ruzhu')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_rule')." ADD   `is_ruzhu` tinyint(2) NOT NULL DEFAULT '0' COMMENT '入住是否免审核（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_rule','is_huanjiao')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_rule')." ADD   `is_huanjiao` tinyint(2) NOT NULL DEFAULT '0' COMMENT '患教是否免审核（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_rule','is_dongtai')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_rule')." ADD   `is_dongtai` tinyint(2) NOT NULL DEFAULT '0' COMMENT '动态是否免审核（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_rule','is_pinglun')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_rule')." ADD   `is_pinglun` tinyint(2) NOT NULL DEFAULT '0' COMMENT '评论是否免审核（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_rule','score')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_rule')." ADD   `score` tinyint(2) NOT NULL COMMENT '默认星级'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_rule','sort_type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_rule')." ADD   `sort_type` tinyint(2) NOT NULL COMMENT '专家列表默认排序方式'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_rule','rz_content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_rule')." ADD   `rz_content` text NOT NULL COMMENT '入住条款'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_rule','pay_content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_rule')." ADD   `pay_content` text NOT NULL COMMENT '付费说明'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_rule','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_rule')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_rule','background')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_rule')." ADD   `background` varchar(255) NOT NULL COMMENT '专家海报背景图'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_rule','fee')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_rule')." ADD   `fee` int(11) DEFAULT NULL COMMENT '抽成比例'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_zhuanjia_rzset` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL COMMENT '类别名称',
  `content` text NOT NULL COMMENT '详细信息',
  `times` int(11) NOT NULL COMMENT '时长',
  `price` decimal(11,2) NOT NULL COMMENT '价格',
  `sort` int(11) NOT NULL COMMENT '排序',
  `is_xf` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否用户续费（0：否；1：是；2：只能用于续费）',
  `is_tuijian` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否推荐（0：否；1：是）',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：禁用；1：启用）',
  `created` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='入驻类型表';

");

if(!pdo_fieldexists('hyb_yl_zhuanjia_rzset','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_rzset')." ADD 
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_rzset','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_rzset')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_rzset','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_rzset')." ADD   `title` varchar(255) NOT NULL COMMENT '类别名称'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_rzset','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_rzset')." ADD   `content` text NOT NULL COMMENT '详细信息'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_rzset','times')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_rzset')." ADD   `times` int(11) NOT NULL COMMENT '时长'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_rzset','price')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_rzset')." ADD   `price` decimal(11,2) NOT NULL COMMENT '价格'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_rzset','sort')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_rzset')." ADD   `sort` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_rzset','is_xf')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_rzset')." ADD   `is_xf` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否用户续费（0：否；1：是；2：只能用于续费）'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_rzset','is_tuijian')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_rzset')." ADD   `is_tuijian` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否推荐（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_rzset','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_rzset')." ADD   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0：禁用；1：启用）'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_rzset','created')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_rzset')." ADD   `created` int(11) NOT NULL COMMENT '添加时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_zhuanjia_select` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '精选标题',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1启用0不启用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='专家精选表';

");

if(!pdo_fieldexists('hyb_yl_zhuanjia_select','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_select')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_select','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_select')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_select','name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_select')." ADD   `name` varchar(50) NOT NULL COMMENT '精选标题'");}
if(!pdo_fieldexists('hyb_yl_zhuanjia_select','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjia_select')." ADD   `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1启用0不启用'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_zhuanjiafenzu` (
  `fenzuid` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `zid` int(11) NOT NULL COMMENT '专家id',
  `fenzname` char(50) NOT NULL COMMENT '分组id',
  PRIMARY KEY (`fenzuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='专家分组i表';

");

if(!pdo_fieldexists('hyb_yl_zhuanjiafenzu','fenzuid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjiafenzu')." ADD 
  `fenzuid` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_zhuanjiafenzu','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjiafenzu')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_zhuanjiafenzu','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjiafenzu')." ADD   `zid` int(11) NOT NULL COMMENT '专家id'");}
if(!pdo_fieldexists('hyb_yl_zhuanjiafenzu','fenzname')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjiafenzu')." ADD   `fenzname` char(50) NOT NULL COMMENT '分组id'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_zhuanjteam` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `teamname` char(50) NOT NULL COMMENT '团队名称',
  `teamaddress` varchar(255) NOT NULL COMMENT '团队地址',
  `teamtype` tinyint(11) NOT NULL COMMENT '0线上1团体',
  `teamtext` text NOT NULL COMMENT '简介',
  `teampic` varchar(255) NOT NULL COMMENT 'z照片',
  `zid` int(11) NOT NULL COMMENT '专家id',
  `ifchuanj` int(11) NOT NULL DEFAULT '0' COMMENT '0创建1未创建',
  `doctorCount` int(11) NOT NULL DEFAULT '0',
  `patientCount` int(11) NOT NULL,
  `cltime` int(11) NOT NULL,
  `iftj` int(11) NOT NULL DEFAULT '0',
  `tderweima` varchar(255) NOT NULL COMMENT 't团队二维码',
  `ifsh` tinyint(11) NOT NULL DEFAULT '0' COMMENT '0未审核1审核通过',
  PRIMARY KEY (`t_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_yl_zhuanjteam','t_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjteam')." ADD 
  `t_id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_zhuanjteam','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjteam')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_zhuanjteam','teamname')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjteam')." ADD   `teamname` char(50) NOT NULL COMMENT '团队名称'");}
if(!pdo_fieldexists('hyb_yl_zhuanjteam','teamaddress')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjteam')." ADD   `teamaddress` varchar(255) NOT NULL COMMENT '团队地址'");}
if(!pdo_fieldexists('hyb_yl_zhuanjteam','teamtype')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjteam')." ADD   `teamtype` tinyint(11) NOT NULL COMMENT '0线上1团体'");}
if(!pdo_fieldexists('hyb_yl_zhuanjteam','teamtext')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjteam')." ADD   `teamtext` text NOT NULL COMMENT '简介'");}
if(!pdo_fieldexists('hyb_yl_zhuanjteam','teampic')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjteam')." ADD   `teampic` varchar(255) NOT NULL COMMENT 'z照片'");}
if(!pdo_fieldexists('hyb_yl_zhuanjteam','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjteam')." ADD   `zid` int(11) NOT NULL COMMENT '专家id'");}
if(!pdo_fieldexists('hyb_yl_zhuanjteam','ifchuanj')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjteam')." ADD   `ifchuanj` int(11) NOT NULL DEFAULT '0' COMMENT '0创建1未创建'");}
if(!pdo_fieldexists('hyb_yl_zhuanjteam','doctorCount')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjteam')." ADD   `doctorCount` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('hyb_yl_zhuanjteam','patientCount')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjteam')." ADD   `patientCount` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_zhuanjteam','cltime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjteam')." ADD   `cltime` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_zhuanjteam','iftj')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjteam')." ADD   `iftj` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('hyb_yl_zhuanjteam','tderweima')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjteam')." ADD   `tderweima` varchar(255) NOT NULL COMMENT 't团队二维码'");}
if(!pdo_fieldexists('hyb_yl_zhuanjteam','ifsh')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zhuanjteam')." ADD   `ifsh` tinyint(11) NOT NULL DEFAULT '0' COMMENT '0未审核1审核通过'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_zixun` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `title` varchar(255) NOT NULL COMMENT '文章标题',
  `title_fu` varchar(255) NOT NULL COMMENT '文章关键字描述',
  `thumb` varchar(255) NOT NULL COMMENT '所列图',
  `content` longtext NOT NULL COMMENT '简介',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '推荐',
  `time` varchar(255) NOT NULL,
  `sord` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `dianj` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '点赞量',
  `p_id` int(11) NOT NULL COMMENT '分类一级id',
  `er_id` int(11) NOT NULL COMMENT '分类二级ID',
  `dz` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '有帮助',
  `erweima` varchar(255) NOT NULL COMMENT '二维码',
  `haibao` varchar(255) NOT NULL COMMENT '海报',
  `art_type` tinyint(3) NOT NULL COMMENT '0审核中1已通过2未通过',
  `display` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1显示0不显示',
  `zid` int(11) NOT NULL COMMENT '医生ID',
  `userid` int(11) NOT NULL COMMENT '用户ID',
  `scyd` varchar(50) NOT NULL COMMENT '首次阅读奖励积分',
  `rcyd` varchar(50) NOT NULL COMMENT '日常阅读积分',
  `fxcs` int(11) NOT NULL DEFAULT '0' COMMENT '分享次数',
  `ydcs` int(11) NOT NULL DEFAULT '0' COMMENT '阅读次数',
  `zdtype` int(11) NOT NULL DEFAULT '0' COMMENT '1置顶0不置顶',
  `keshi_one` int(10) NOT NULL DEFAULT '0' COMMENT '一级科室id',
  `keshi_two` int(10) NOT NULL DEFAULT '0' COMMENT '二级科室id',
  `color` varchar(50) NOT NULL COMMENT '标题颜色',
  `xncs` int(11) NOT NULL DEFAULT '0' COMMENT '虚拟阅读量',
  PRIMARY KEY (`id`,`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8 COMMENT='咨询表';

");

if(!pdo_fieldexists('hyb_yl_zixun','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun')." ADD 
  `id` int(10) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_zixun','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun')." ADD   `uniacid` int(10) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_zixun','title')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun')." ADD   `title` varchar(255) NOT NULL COMMENT '文章标题'");}
if(!pdo_fieldexists('hyb_yl_zixun','title_fu')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun')." ADD   `title_fu` varchar(255) NOT NULL COMMENT '文章关键字描述'");}
if(!pdo_fieldexists('hyb_yl_zixun','thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun')." ADD   `thumb` varchar(255) NOT NULL COMMENT '所列图'");}
if(!pdo_fieldexists('hyb_yl_zixun','content')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun')." ADD   `content` longtext NOT NULL COMMENT '简介'");}
if(!pdo_fieldexists('hyb_yl_zixun','status')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun')." ADD   `status` int(11) NOT NULL DEFAULT '0' COMMENT '推荐'");}
if(!pdo_fieldexists('hyb_yl_zixun','time')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun')." ADD   `time` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_zixun','sord')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun')." ADD   `sord` int(11) NOT NULL DEFAULT '0' COMMENT '排序'");}
if(!pdo_fieldexists('hyb_yl_zixun','dianj')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun')." ADD   `dianj` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '点赞量'");}
if(!pdo_fieldexists('hyb_yl_zixun','p_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun')." ADD   `p_id` int(11) NOT NULL COMMENT '分类一级id'");}
if(!pdo_fieldexists('hyb_yl_zixun','er_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun')." ADD   `er_id` int(11) NOT NULL COMMENT '分类二级ID'");}
if(!pdo_fieldexists('hyb_yl_zixun','dz')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun')." ADD   `dz` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '有帮助'");}
if(!pdo_fieldexists('hyb_yl_zixun','erweima')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun')." ADD   `erweima` varchar(255) NOT NULL COMMENT '二维码'");}
if(!pdo_fieldexists('hyb_yl_zixun','haibao')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun')." ADD   `haibao` varchar(255) NOT NULL COMMENT '海报'");}
if(!pdo_fieldexists('hyb_yl_zixun','art_type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun')." ADD   `art_type` tinyint(3) NOT NULL COMMENT '0审核中1已通过2未通过'");}
if(!pdo_fieldexists('hyb_yl_zixun','display')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun')." ADD   `display` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1显示0不显示'");}
if(!pdo_fieldexists('hyb_yl_zixun','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun')." ADD   `zid` int(11) NOT NULL COMMENT '医生ID'");}
if(!pdo_fieldexists('hyb_yl_zixun','userid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun')." ADD   `userid` int(11) NOT NULL COMMENT '用户ID'");}
if(!pdo_fieldexists('hyb_yl_zixun','scyd')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun')." ADD   `scyd` varchar(50) NOT NULL COMMENT '首次阅读奖励积分'");}
if(!pdo_fieldexists('hyb_yl_zixun','rcyd')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun')." ADD   `rcyd` varchar(50) NOT NULL COMMENT '日常阅读积分'");}
if(!pdo_fieldexists('hyb_yl_zixun','fxcs')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun')." ADD   `fxcs` int(11) NOT NULL DEFAULT '0' COMMENT '分享次数'");}
if(!pdo_fieldexists('hyb_yl_zixun','ydcs')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun')." ADD   `ydcs` int(11) NOT NULL DEFAULT '0' COMMENT '阅读次数'");}
if(!pdo_fieldexists('hyb_yl_zixun','zdtype')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun')." ADD   `zdtype` int(11) NOT NULL DEFAULT '0' COMMENT '1置顶0不置顶'");}
if(!pdo_fieldexists('hyb_yl_zixun','keshi_one')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun')." ADD   `keshi_one` int(10) NOT NULL DEFAULT '0' COMMENT '一级科室id'");}
if(!pdo_fieldexists('hyb_yl_zixun','keshi_two')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun')." ADD   `keshi_two` int(10) NOT NULL DEFAULT '0' COMMENT '二级科室id'");}
if(!pdo_fieldexists('hyb_yl_zixun','color')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun')." ADD   `color` varchar(50) NOT NULL COMMENT '标题颜色'");}
if(!pdo_fieldexists('hyb_yl_zixun','xncs')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun')." ADD   `xncs` int(11) NOT NULL DEFAULT '0' COMMENT '虚拟阅读量'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_zixun_looklog` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) DEFAULT NULL,
  `openid` varchar(255) DEFAULT NULL COMMENT '用户',
  `zid` int(10) NOT NULL DEFAULT '0' COMMENT '咨询id',
  `jifen` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '赠送积分',
  `createtime` varchar(255) DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=661 DEFAULT CHARSET=utf8 COMMENT='咨询查看记录表';

");

if(!pdo_fieldexists('hyb_yl_zixun_looklog','id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun_looklog')." ADD 
  `id` int(10) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_zixun_looklog','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun_looklog')." ADD   `uniacid` int(10) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_yl_zixun_looklog','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun_looklog')." ADD   `openid` varchar(255) DEFAULT NULL COMMENT '用户'");}
if(!pdo_fieldexists('hyb_yl_zixun_looklog','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun_looklog')." ADD   `zid` int(10) NOT NULL DEFAULT '0' COMMENT '咨询id'");}
if(!pdo_fieldexists('hyb_yl_zixun_looklog','jifen')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun_looklog')." ADD   `jifen` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '赠送积分'");}
if(!pdo_fieldexists('hyb_yl_zixun_looklog','createtime')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun_looklog')." ADD   `createtime` varchar(255) DEFAULT NULL COMMENT '时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_yl_zixun_type` (
  `zx_id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `zx_name` varchar(255) NOT NULL COMMENT '分类名称',
  `zx_thumb` varchar(255) NOT NULL COMMENT '分类缩略图',
  `zx_kew` varchar(255) NOT NULL COMMENT '咨询描述',
  `sort` int(11) NOT NULL COMMENT '分类排序',
  `link_url` varchar(255) NOT NULL COMMENT '外部链接',
  `zx_type` int(10) NOT NULL DEFAULT '0' COMMENT '是否推荐 1：推荐；0不推荐',
  `enabled` tinyint(11) NOT NULL DEFAULT '1' COMMENT '1开启0未开启',
  `pid` int(11) NOT NULL DEFAULT '0',
  `link_type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否外链（0：否；1：是）',
  `recommend` int(10) NOT NULL DEFAULT '0' COMMENT '是否推荐 ',
  `background` varchar(255) NOT NULL COMMENT '背景颜色',
  PRIMARY KEY (`zx_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='咨询分类表';

");

if(!pdo_fieldexists('hyb_yl_zixun_type','zx_id')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun_type')." ADD 
  `zx_id` int(10) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_yl_zixun_type','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun_type')." ADD   `uniacid` int(10) NOT NULL");}
if(!pdo_fieldexists('hyb_yl_zixun_type','zx_name')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun_type')." ADD   `zx_name` varchar(255) NOT NULL COMMENT '分类名称'");}
if(!pdo_fieldexists('hyb_yl_zixun_type','zx_thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun_type')." ADD   `zx_thumb` varchar(255) NOT NULL COMMENT '分类缩略图'");}
if(!pdo_fieldexists('hyb_yl_zixun_type','zx_kew')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun_type')." ADD   `zx_kew` varchar(255) NOT NULL COMMENT '咨询描述'");}
if(!pdo_fieldexists('hyb_yl_zixun_type','sort')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun_type')." ADD   `sort` int(11) NOT NULL COMMENT '分类排序'");}
if(!pdo_fieldexists('hyb_yl_zixun_type','link_url')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun_type')." ADD   `link_url` varchar(255) NOT NULL COMMENT '外部链接'");}
if(!pdo_fieldexists('hyb_yl_zixun_type','zx_type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun_type')." ADD   `zx_type` int(10) NOT NULL DEFAULT '0' COMMENT '是否推荐 1：推荐；0不推荐'");}
if(!pdo_fieldexists('hyb_yl_zixun_type','enabled')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun_type')." ADD   `enabled` tinyint(11) NOT NULL DEFAULT '1' COMMENT '1开启0未开启'");}
if(!pdo_fieldexists('hyb_yl_zixun_type','pid')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun_type')." ADD   `pid` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('hyb_yl_zixun_type','link_type')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun_type')." ADD   `link_type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否外链（0：否；1：是）'");}
if(!pdo_fieldexists('hyb_yl_zixun_type','recommend')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun_type')." ADD   `recommend` int(10) NOT NULL DEFAULT '0' COMMENT '是否推荐 '");}
if(!pdo_fieldexists('hyb_yl_zixun_type','background')) {pdo_query("ALTER TABLE ".tablename('hyb_yl_zixun_type')." ADD   `background` varchar(255) NOT NULL COMMENT '背景颜色'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_ylmz_admin` (
  `userid` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `uniacid` int(11) NOT NULL,
  `doctorid` int(11) NOT NULL COMMENT '医生ID',
  `username` varchar(50) NOT NULL COMMENT '医生账号',
  `pwd` varchar(255) NOT NULL COMMENT '医生密码',
  `remark` varchar(255) NOT NULL,
  `dopenid` varchar(255) NOT NULL COMMENT '医生openid',
  `last_access_time` varchar(50) NOT NULL COMMENT '上次登录时间',
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_ylmz_admin','userid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_admin')." ADD 
  `userid` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户ID'");}
if(!pdo_fieldexists('hyb_ylmz_admin','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_admin')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_admin','doctorid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_admin')." ADD   `doctorid` int(11) NOT NULL COMMENT '医生ID'");}
if(!pdo_fieldexists('hyb_ylmz_admin','username')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_admin')." ADD   `username` varchar(50) NOT NULL COMMENT '医生账号'");}
if(!pdo_fieldexists('hyb_ylmz_admin','pwd')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_admin')." ADD   `pwd` varchar(255) NOT NULL COMMENT '医生密码'");}
if(!pdo_fieldexists('hyb_ylmz_admin','remark')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_admin')." ADD   `remark` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_admin','dopenid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_admin')." ADD   `dopenid` varchar(255) NOT NULL COMMENT '医生openid'");}
if(!pdo_fieldexists('hyb_ylmz_admin','last_access_time')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_admin')." ADD   `last_access_time` varchar(50) NOT NULL COMMENT '上次登录时间'");}
if(!pdo_fieldexists('hyb_ylmz_admin','uid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_admin')." ADD   `uid` int(11) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_ylmz_base` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) DEFAULT NULL,
  `show_title` varchar(255) DEFAULT NULL,
  `show_thumb` varchar(255) DEFAULT NULL COMMENT '首页幻灯片1',
  `yy_thumb` varchar(255) DEFAULT NULL COMMENT '医院简介图片',
  `yy_title` varchar(50) DEFAULT NULL COMMENT '医院简介标题',
  `yy_content` longtext COMMENT '医院简介内容',
  `latitude` varchar(50) DEFAULT NULL COMMENT '纬度',
  `longitude` varchar(50) DEFAULT NULL COMMENT '经度',
  `yy_address` varchar(255) DEFAULT NULL,
  `yy_telphone` varchar(50) DEFAULT NULL COMMENT '医院24小时服务电话',
  `bq_name` varchar(50) DEFAULT NULL COMMENT '版权名称',
  `bq_thumb` varchar(255) DEFAULT NULL COMMENT '版权图标',
  `bq_telphone` varchar(50) DEFAULT NULL COMMENT '版权联系电话',
  `back_thumb` varchar(255) DEFAULT NULL COMMENT '小程序我的背景图',
  `back_zjthumb` varchar(255) NOT NULL,
  `uid` int(11) NOT NULL,
  `biaoqian` varchar(255) NOT NULL,
  `pid` int(11) NOT NULL COMMENT '父类id',
  `parentid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_ylmz_base','id')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_base')." ADD 
  `id` int(10) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_ylmz_base','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_base')." ADD   `uniacid` int(10) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_base','show_title')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_base')." ADD   `show_title` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_base','show_thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_base')." ADD   `show_thumb` varchar(255) DEFAULT NULL COMMENT '首页幻灯片1'");}
if(!pdo_fieldexists('hyb_ylmz_base','yy_thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_base')." ADD   `yy_thumb` varchar(255) DEFAULT NULL COMMENT '医院简介图片'");}
if(!pdo_fieldexists('hyb_ylmz_base','yy_title')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_base')." ADD   `yy_title` varchar(50) DEFAULT NULL COMMENT '医院简介标题'");}
if(!pdo_fieldexists('hyb_ylmz_base','yy_content')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_base')." ADD   `yy_content` longtext COMMENT '医院简介内容'");}
if(!pdo_fieldexists('hyb_ylmz_base','latitude')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_base')." ADD   `latitude` varchar(50) DEFAULT NULL COMMENT '纬度'");}
if(!pdo_fieldexists('hyb_ylmz_base','longitude')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_base')." ADD   `longitude` varchar(50) DEFAULT NULL COMMENT '经度'");}
if(!pdo_fieldexists('hyb_ylmz_base','yy_address')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_base')." ADD   `yy_address` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_base','yy_telphone')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_base')." ADD   `yy_telphone` varchar(50) DEFAULT NULL COMMENT '医院24小时服务电话'");}
if(!pdo_fieldexists('hyb_ylmz_base','bq_name')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_base')." ADD   `bq_name` varchar(50) DEFAULT NULL COMMENT '版权名称'");}
if(!pdo_fieldexists('hyb_ylmz_base','bq_thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_base')." ADD   `bq_thumb` varchar(255) DEFAULT NULL COMMENT '版权图标'");}
if(!pdo_fieldexists('hyb_ylmz_base','bq_telphone')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_base')." ADD   `bq_telphone` varchar(50) DEFAULT NULL COMMENT '版权联系电话'");}
if(!pdo_fieldexists('hyb_ylmz_base','back_thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_base')." ADD   `back_thumb` varchar(255) DEFAULT NULL COMMENT '小程序我的背景图'");}
if(!pdo_fieldexists('hyb_ylmz_base','back_zjthumb')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_base')." ADD   `back_zjthumb` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_base','uid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_base')." ADD   `uid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_base','biaoqian')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_base')." ADD   `biaoqian` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_base','pid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_base')." ADD   `pid` int(11) NOT NULL COMMENT '父类id'");}
if(!pdo_fieldexists('hyb_ylmz_base','parentid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_base')." ADD   `parentid` int(11) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_ylmz_blku` (
  `hid` int(11) NOT NULL AUTO_INCREMENT,
  `hname` varchar(10) NOT NULL COMMENT '患者名字',
  `yhospital` varchar(50) NOT NULL COMMENT '原就诊医院',
  `uniacid` int(11) DEFAULT NULL,
  `times` varchar(50) DEFAULT NULL,
  `xhospital` varchar(50) DEFAULT NULL COMMENT '现就诊医院',
  `jzkeshi` int(10) NOT NULL COMMENT '就诊科室ID',
  `pic` longtext NOT NULL,
  `yibao` varchar(10) DEFAULT NULL,
  `openid` varchar(255) NOT NULL,
  `des` varchar(255) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`hid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_ylmz_blku','hid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_blku')." ADD 
  `hid` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_ylmz_blku','hname')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_blku')." ADD   `hname` varchar(10) NOT NULL COMMENT '患者名字'");}
if(!pdo_fieldexists('hyb_ylmz_blku','yhospital')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_blku')." ADD   `yhospital` varchar(50) NOT NULL COMMENT '原就诊医院'");}
if(!pdo_fieldexists('hyb_ylmz_blku','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_blku')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_blku','times')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_blku')." ADD   `times` varchar(50) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_blku','xhospital')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_blku')." ADD   `xhospital` varchar(50) DEFAULT NULL COMMENT '现就诊医院'");}
if(!pdo_fieldexists('hyb_ylmz_blku','jzkeshi')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_blku')." ADD   `jzkeshi` int(10) NOT NULL COMMENT '就诊科室ID'");}
if(!pdo_fieldexists('hyb_ylmz_blku','pic')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_blku')." ADD   `pic` longtext NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_blku','yibao')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_blku')." ADD   `yibao` varchar(10) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_blku','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_blku')." ADD   `openid` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_blku','des')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_blku')." ADD   `des` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_blku','uid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_blku')." ADD   `uid` int(11) DEFAULT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_ylmz_copyright` (
  `bqid` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` varchar(11) DEFAULT NULL,
  `bqtype` int(11) NOT NULL,
  `bq_thumb` varchar(255) DEFAULT NULL,
  `bq_telphone` varchar(50) DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`bqid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_ylmz_copyright','bqid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_copyright')." ADD 
  `bqid` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_ylmz_copyright','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_copyright')." ADD   `uniacid` varchar(11) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_copyright','bqtype')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_copyright')." ADD   `bqtype` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_copyright','bq_thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_copyright')." ADD   `bq_thumb` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_copyright','bq_telphone')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_copyright')." ADD   `bq_telphone` varchar(50) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_copyright','domain')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_copyright')." ADD   `domain` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_copyright','uid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_copyright')." ADD   `uid` int(11) DEFAULT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_ylmz_doctor` (
  `zid` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `z_name` varchar(50) NOT NULL COMMENT '专家姓名',
  `z_zhicheng` varchar(50) DEFAULT NULL COMMENT '医生职称',
  `z_telephone` varchar(50) DEFAULT NULL COMMENT '医生联系电话',
  `z_zhenzhi` longtext COMMENT '医生擅长',
  `z_content` longtext COMMENT '医生简介',
  `z_sex` varchar(50) NOT NULL DEFAULT '0' COMMENT '1男；0女',
  `z_yy_money` varchar(50) NOT NULL DEFAULT '0' COMMENT '预约挂号金额',
  `z_thumbs` varchar(255) DEFAULT NULL COMMENT '专家头像',
  `z_yy_type` varchar(50) NOT NULL DEFAULT '0' COMMENT '是否推荐 1：推荐 0不推荐',
  `z_yy_fens` varchar(50) NOT NULL DEFAULT '0' COMMENT '服务人数',
  `z_docqm` varchar(255) DEFAULT NULL COMMENT '医生签名',
  `z_pid` int(10) DEFAULT NULL COMMENT '科室ID',
  `z_ghmoney` float(6,2) NOT NULL COMMENT '挂号费用',
  `z_person` int(10) NOT NULL DEFAULT '0' COMMENT '挂号人数设置',
  `z_number` varchar(11) DEFAULT NULL COMMENT '医生编号',
  `z_ygh` int(10) NOT NULL COMMENT '已挂号人数',
  `sord` int(11) NOT NULL DEFAULT '0',
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`zid`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_ylmz_doctor','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_doctor')." ADD 
  `zid` int(10) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_ylmz_doctor','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_doctor')." ADD   `uniacid` int(10) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_doctor','z_name')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_doctor')." ADD   `z_name` varchar(50) NOT NULL COMMENT '专家姓名'");}
if(!pdo_fieldexists('hyb_ylmz_doctor','z_zhicheng')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_doctor')." ADD   `z_zhicheng` varchar(50) DEFAULT NULL COMMENT '医生职称'");}
if(!pdo_fieldexists('hyb_ylmz_doctor','z_telephone')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_doctor')." ADD   `z_telephone` varchar(50) DEFAULT NULL COMMENT '医生联系电话'");}
if(!pdo_fieldexists('hyb_ylmz_doctor','z_zhenzhi')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_doctor')." ADD   `z_zhenzhi` longtext COMMENT '医生擅长'");}
if(!pdo_fieldexists('hyb_ylmz_doctor','z_content')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_doctor')." ADD   `z_content` longtext COMMENT '医生简介'");}
if(!pdo_fieldexists('hyb_ylmz_doctor','z_sex')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_doctor')." ADD   `z_sex` varchar(50) NOT NULL DEFAULT '0' COMMENT '1男；0女'");}
if(!pdo_fieldexists('hyb_ylmz_doctor','z_yy_money')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_doctor')." ADD   `z_yy_money` varchar(50) NOT NULL DEFAULT '0' COMMENT '预约挂号金额'");}
if(!pdo_fieldexists('hyb_ylmz_doctor','z_thumbs')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_doctor')." ADD   `z_thumbs` varchar(255) DEFAULT NULL COMMENT '专家头像'");}
if(!pdo_fieldexists('hyb_ylmz_doctor','z_yy_type')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_doctor')." ADD   `z_yy_type` varchar(50) NOT NULL DEFAULT '0' COMMENT '是否推荐 1：推荐 0不推荐'");}
if(!pdo_fieldexists('hyb_ylmz_doctor','z_yy_fens')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_doctor')." ADD   `z_yy_fens` varchar(50) NOT NULL DEFAULT '0' COMMENT '服务人数'");}
if(!pdo_fieldexists('hyb_ylmz_doctor','z_docqm')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_doctor')." ADD   `z_docqm` varchar(255) DEFAULT NULL COMMENT '医生签名'");}
if(!pdo_fieldexists('hyb_ylmz_doctor','z_pid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_doctor')." ADD   `z_pid` int(10) DEFAULT NULL COMMENT '科室ID'");}
if(!pdo_fieldexists('hyb_ylmz_doctor','z_ghmoney')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_doctor')." ADD   `z_ghmoney` float(6,2) NOT NULL COMMENT '挂号费用'");}
if(!pdo_fieldexists('hyb_ylmz_doctor','z_person')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_doctor')." ADD   `z_person` int(10) NOT NULL DEFAULT '0' COMMENT '挂号人数设置'");}
if(!pdo_fieldexists('hyb_ylmz_doctor','z_number')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_doctor')." ADD   `z_number` varchar(11) DEFAULT NULL COMMENT '医生编号'");}
if(!pdo_fieldexists('hyb_ylmz_doctor','z_ygh')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_doctor')." ADD   `z_ygh` int(10) NOT NULL COMMENT '已挂号人数'");}
if(!pdo_fieldexists('hyb_ylmz_doctor','sord')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_doctor')." ADD   `sord` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('hyb_ylmz_doctor','uid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_doctor')." ADD   `uid` int(11) DEFAULT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_ylmz_dozhuantime` (
  `d_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(50) NOT NULL COMMENT '坐诊年',
  `day` varchar(50) NOT NULL COMMENT '上午；下午',
  `endTime` varchar(30) NOT NULL COMMENT '结束时间',
  `startTime` varchar(30) NOT NULL DEFAULT '0000-00-00' COMMENT '开始时间',
  `tijiatime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '添加时间 根据时间排序',
  `openid` varchar(255) NOT NULL,
  `pp_id` int(11) NOT NULL COMMENT '专家ID',
  `uniacid` int(11) DEFAULT NULL,
  `yyperson` varchar(50) NOT NULL COMMENT '预约名额',
  `sort_id` int(11) NOT NULL COMMENT '排序ID',
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`d_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_ylmz_dozhuantime','d_id')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_dozhuantime')." ADD 
  `d_id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_ylmz_dozhuantime','date')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_dozhuantime')." ADD   `date` varchar(50) NOT NULL COMMENT '坐诊年'");}
if(!pdo_fieldexists('hyb_ylmz_dozhuantime','day')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_dozhuantime')." ADD   `day` varchar(50) NOT NULL COMMENT '上午；下午'");}
if(!pdo_fieldexists('hyb_ylmz_dozhuantime','endTime')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_dozhuantime')." ADD   `endTime` varchar(30) NOT NULL COMMENT '结束时间'");}
if(!pdo_fieldexists('hyb_ylmz_dozhuantime','startTime')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_dozhuantime')." ADD   `startTime` varchar(30) NOT NULL DEFAULT '0000-00-00' COMMENT '开始时间'");}
if(!pdo_fieldexists('hyb_ylmz_dozhuantime','tijiatime')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_dozhuantime')." ADD   `tijiatime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '添加时间 根据时间排序'");}
if(!pdo_fieldexists('hyb_ylmz_dozhuantime','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_dozhuantime')." ADD   `openid` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_dozhuantime','pp_id')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_dozhuantime')." ADD   `pp_id` int(11) NOT NULL COMMENT '专家ID'");}
if(!pdo_fieldexists('hyb_ylmz_dozhuantime','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_dozhuantime')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_dozhuantime','yyperson')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_dozhuantime')." ADD   `yyperson` varchar(50) NOT NULL COMMENT '预约名额'");}
if(!pdo_fieldexists('hyb_ylmz_dozhuantime','sort_id')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_dozhuantime')." ADD   `sort_id` int(11) NOT NULL COMMENT '排序ID'");}
if(!pdo_fieldexists('hyb_ylmz_dozhuantime','uid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_dozhuantime')." ADD   `uid` int(11) DEFAULT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_ylmz_duanxin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) DEFAULT NULL,
  `key` varchar(50) DEFAULT NULL,
  `scret` varchar(50) DEFAULT NULL,
  `qianming` varchar(50) DEFAULT NULL,
  `moban_id` varchar(50) DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT '0' COMMENT '1开启；0关闭',
  `administrator` varchar(50) DEFAULT NULL,
  `templatecode` varchar(255) DEFAULT NULL COMMENT '支付成功后模板ID',
  `wxapptpl` varchar(255) DEFAULT NULL COMMENT '微信小程序模板ID',
  `phtpl` varchar(255) DEFAULT NULL,
  `masstpl` varchar(255) DEFAULT NULL COMMENT '群发消息模板ID',
  `codetpl` varchar(255) DEFAULT NULL COMMENT '订单完成通知',
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_ylmz_duanxin','id')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_duanxin')." ADD 
  `id` int(10) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_ylmz_duanxin','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_duanxin')." ADD   `uniacid` int(10) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_duanxin','key')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_duanxin')." ADD   `key` varchar(50) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_duanxin','scret')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_duanxin')." ADD   `scret` varchar(50) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_duanxin','qianming')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_duanxin')." ADD   `qianming` varchar(50) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_duanxin','moban_id')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_duanxin')." ADD   `moban_id` varchar(50) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_duanxin','state')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_duanxin')." ADD   `state` int(11) NOT NULL DEFAULT '0' COMMENT '1开启；0关闭'");}
if(!pdo_fieldexists('hyb_ylmz_duanxin','administrator')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_duanxin')." ADD   `administrator` varchar(50) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_duanxin','templatecode')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_duanxin')." ADD   `templatecode` varchar(255) DEFAULT NULL COMMENT '支付成功后模板ID'");}
if(!pdo_fieldexists('hyb_ylmz_duanxin','wxapptpl')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_duanxin')." ADD   `wxapptpl` varchar(255) DEFAULT NULL COMMENT '微信小程序模板ID'");}
if(!pdo_fieldexists('hyb_ylmz_duanxin','phtpl')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_duanxin')." ADD   `phtpl` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_duanxin','masstpl')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_duanxin')." ADD   `masstpl` varchar(255) DEFAULT NULL COMMENT '群发消息模板ID'");}
if(!pdo_fieldexists('hyb_ylmz_duanxin','codetpl')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_duanxin')." ADD   `codetpl` varchar(255) DEFAULT NULL COMMENT '订单完成通知'");}
if(!pdo_fieldexists('hyb_ylmz_duanxin','uid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_duanxin')." ADD   `uid` int(11) DEFAULT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_ylmz_dyj` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dyj_title` varchar(50) NOT NULL,
  `dyj_id` varchar(50) NOT NULL,
  `dyj_key` varchar(50) NOT NULL,
  `uniacid` varchar(50) NOT NULL,
  `dyj_title2` varchar(50) NOT NULL,
  `dyj_id2` varchar(50) NOT NULL,
  `dyj_key2` varchar(50) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

");

if(!pdo_fieldexists('hyb_ylmz_dyj','id')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_dyj')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_ylmz_dyj','dyj_title')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_dyj')." ADD   `dyj_title` varchar(50) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_dyj','dyj_id')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_dyj')." ADD   `dyj_id` varchar(50) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_dyj','dyj_key')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_dyj')." ADD   `dyj_key` varchar(50) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_dyj','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_dyj')." ADD   `uniacid` varchar(50) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_dyj','dyj_title2')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_dyj')." ADD   `dyj_title2` varchar(50) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_dyj','dyj_id2')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_dyj')." ADD   `dyj_id2` varchar(50) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_dyj','dyj_key2')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_dyj')." ADD   `dyj_key2` varchar(50) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_dyj','uid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_dyj')." ADD   `uid` int(11) DEFAULT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_ylmz_fwcat` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) NOT NULL COMMENT '服务名称',
  `fmoney` varchar(50) NOT NULL COMMENT '服务金额',
  `uniacid` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '1完成0未完成',
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_ylmz_fwcat','fid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_fwcat')." ADD 
  `fid` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_ylmz_fwcat','fname')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_fwcat')." ADD   `fname` varchar(50) NOT NULL COMMENT '服务名称'");}
if(!pdo_fieldexists('hyb_ylmz_fwcat','fmoney')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_fwcat')." ADD   `fmoney` varchar(50) NOT NULL COMMENT '服务金额'");}
if(!pdo_fieldexists('hyb_ylmz_fwcat','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_fwcat')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_fwcat','status')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_fwcat')." ADD   `status` int(11) NOT NULL DEFAULT '0' COMMENT '1完成0未完成'");}
if(!pdo_fieldexists('hyb_ylmz_fwcat','uid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_fwcat')." ADD   `uid` int(11) DEFAULT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_ylmz_fwlist` (
  `yid` int(10) NOT NULL AUTO_INCREMENT,
  `telphone` varchar(50) NOT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `ytime` varchar(50) NOT NULL COMMENT '约定时间',
  `fwpid` int(11) NOT NULL COMMENT '服务PID',
  `ynames` longtext NOT NULL COMMENT '名字',
  `yfmoney` varchar(50) NOT NULL,
  `openid` varchar(255) NOT NULL,
  `time` varchar(50) NOT NULL COMMENT '预约时间',
  `studys` int(11) NOT NULL DEFAULT '0' COMMENT '1:完成；0未完成',
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`yid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_ylmz_fwlist','yid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_fwlist')." ADD 
  `yid` int(10) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_ylmz_fwlist','telphone')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_fwlist')." ADD   `telphone` varchar(50) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_fwlist','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_fwlist')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_fwlist','ytime')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_fwlist')." ADD   `ytime` varchar(50) NOT NULL COMMENT '约定时间'");}
if(!pdo_fieldexists('hyb_ylmz_fwlist','fwpid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_fwlist')." ADD   `fwpid` int(11) NOT NULL COMMENT '服务PID'");}
if(!pdo_fieldexists('hyb_ylmz_fwlist','ynames')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_fwlist')." ADD   `ynames` longtext NOT NULL COMMENT '名字'");}
if(!pdo_fieldexists('hyb_ylmz_fwlist','yfmoney')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_fwlist')." ADD   `yfmoney` varchar(50) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_fwlist','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_fwlist')." ADD   `openid` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_fwlist','time')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_fwlist')." ADD   `time` varchar(50) NOT NULL COMMENT '预约时间'");}
if(!pdo_fieldexists('hyb_ylmz_fwlist','studys')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_fwlist')." ADD   `studys` int(11) NOT NULL DEFAULT '0' COMMENT '1:完成；0未完成'");}
if(!pdo_fieldexists('hyb_ylmz_fwlist','uid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_fwlist')." ADD   `uid` int(11) DEFAULT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_ylmz_guatime` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `week` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) DEFAULT NULL COMMENT '结束时间',
  `star_time` varchar(255) DEFAULT NULL,
  `z_pid` int(11) DEFAULT NULL COMMENT '科室ID',
  `shengyunus` varchar(255) DEFAULT NULL,
  `m_money` varchar(255) DEFAULT NULL COMMENT '价格',
  `nums` varchar(255) DEFAULT NULL,
  `zid` int(11) DEFAULT NULL COMMENT '医生ID',
  `time` varchar(255) DEFAULT NULL,
  `text` longtext NOT NULL,
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_ylmz_guatime','tid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_guatime')." ADD 
  `tid` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_ylmz_guatime','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_guatime')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_guatime','week')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_guatime')." ADD   `week` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_guatime','end_time')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_guatime')." ADD   `end_time` varchar(255) DEFAULT NULL COMMENT '结束时间'");}
if(!pdo_fieldexists('hyb_ylmz_guatime','star_time')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_guatime')." ADD   `star_time` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_guatime','z_pid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_guatime')." ADD   `z_pid` int(11) DEFAULT NULL COMMENT '科室ID'");}
if(!pdo_fieldexists('hyb_ylmz_guatime','shengyunus')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_guatime')." ADD   `shengyunus` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_guatime','m_money')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_guatime')." ADD   `m_money` varchar(255) DEFAULT NULL COMMENT '价格'");}
if(!pdo_fieldexists('hyb_ylmz_guatime','nums')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_guatime')." ADD   `nums` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_guatime','zid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_guatime')." ADD   `zid` int(11) DEFAULT NULL COMMENT '医生ID'");}
if(!pdo_fieldexists('hyb_ylmz_guatime','time')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_guatime')." ADD   `time` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_guatime','text')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_guatime')." ADD   `text` longtext NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_guatime','uid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_guatime')." ADD   `uid` int(11) DEFAULT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_ylmz_guhaotime` (
  `g_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(50) NOT NULL COMMENT '坐诊年',
  `day` varchar(50) NOT NULL COMMENT '上午；下午',
  `endTime` varchar(30) NOT NULL COMMENT '结束时间',
  `startTime` varchar(30) NOT NULL DEFAULT '0000-00-00' COMMENT '开始时间',
  `tijiatime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '添加时间 根据时间排序',
  `openid` varchar(255) NOT NULL,
  `pp_id` int(11) NOT NULL COMMENT '专家ID',
  `uniacid` int(11) DEFAULT NULL,
  `yyperson` int(11) NOT NULL COMMENT '预约名额',
  `sort_id` int(11) NOT NULL COMMENT '排序ID',
  `syperson` int(10) NOT NULL COMMENT '剩余挂号数',
  `checked` int(10) NOT NULL DEFAULT '0' COMMENT '0 未选中；1选中',
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`g_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_ylmz_guhaotime','g_id')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_guhaotime')." ADD 
  `g_id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_ylmz_guhaotime','date')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_guhaotime')." ADD   `date` varchar(50) NOT NULL COMMENT '坐诊年'");}
if(!pdo_fieldexists('hyb_ylmz_guhaotime','day')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_guhaotime')." ADD   `day` varchar(50) NOT NULL COMMENT '上午；下午'");}
if(!pdo_fieldexists('hyb_ylmz_guhaotime','endTime')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_guhaotime')." ADD   `endTime` varchar(30) NOT NULL COMMENT '结束时间'");}
if(!pdo_fieldexists('hyb_ylmz_guhaotime','startTime')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_guhaotime')." ADD   `startTime` varchar(30) NOT NULL DEFAULT '0000-00-00' COMMENT '开始时间'");}
if(!pdo_fieldexists('hyb_ylmz_guhaotime','tijiatime')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_guhaotime')." ADD   `tijiatime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '添加时间 根据时间排序'");}
if(!pdo_fieldexists('hyb_ylmz_guhaotime','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_guhaotime')." ADD   `openid` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_guhaotime','pp_id')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_guhaotime')." ADD   `pp_id` int(11) NOT NULL COMMENT '专家ID'");}
if(!pdo_fieldexists('hyb_ylmz_guhaotime','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_guhaotime')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_guhaotime','yyperson')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_guhaotime')." ADD   `yyperson` int(11) NOT NULL COMMENT '预约名额'");}
if(!pdo_fieldexists('hyb_ylmz_guhaotime','sort_id')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_guhaotime')." ADD   `sort_id` int(11) NOT NULL COMMENT '排序ID'");}
if(!pdo_fieldexists('hyb_ylmz_guhaotime','syperson')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_guhaotime')." ADD   `syperson` int(10) NOT NULL COMMENT '剩余挂号数'");}
if(!pdo_fieldexists('hyb_ylmz_guhaotime','checked')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_guhaotime')." ADD   `checked` int(10) NOT NULL DEFAULT '0' COMMENT '0 未选中；1选中'");}
if(!pdo_fieldexists('hyb_ylmz_guhaotime','uid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_guhaotime')." ADD   `uid` int(11) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_ylmz_hospitallist` (
  `yy_id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `hospital_name` varchar(255) NOT NULL COMMENT '医院名字',
  `uid` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `strot` int(11) NOT NULL DEFAULT '0',
  `hos_tuijian` tinyint(11) NOT NULL DEFAULT '0',
  `parid` int(11) NOT NULL,
  PRIMARY KEY (`yy_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_ylmz_hospitallist','yy_id')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_hospitallist')." ADD 
  `yy_id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_ylmz_hospitallist','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_hospitallist')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_hospitallist','hospital_name')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_hospitallist')." ADD   `hospital_name` varchar(255) NOT NULL COMMENT '医院名字'");}
if(!pdo_fieldexists('hyb_ylmz_hospitallist','uid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_hospitallist')." ADD   `uid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_hospitallist','password')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_hospitallist')." ADD   `password` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_hospitallist','strot')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_hospitallist')." ADD   `strot` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('hyb_ylmz_hospitallist','hos_tuijian')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_hospitallist')." ADD   `hos_tuijian` tinyint(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('hyb_ylmz_hospitallist','parid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_hospitallist')." ADD   `parid` int(11) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_ylmz_huanzhe` (
  `hz_id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `hz_name` varchar(50) NOT NULL,
  `hz_thumb` varchar(255) NOT NULL,
  `hz_count` text NOT NULL,
  `hz_time` date NOT NULL DEFAULT '0000-00-00',
  `hz_type` varchar(50) NOT NULL DEFAULT '0' COMMENT '患者推荐1推荐；0不推荐',
  `hz_desction` varchar(50) NOT NULL,
  `hz_mp3` varchar(255) NOT NULL,
  `hz_zlks` int(10) DEFAULT NULL COMMENT '方案分类',
  `hz_pic` varchar(255) NOT NULL COMMENT '诊疗后图片',
  `hz_bh` varchar(50) NOT NULL COMMENT '患者编号：随机',
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`hz_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_ylmz_huanzhe','hz_id')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_huanzhe')." ADD 
  `hz_id` int(10) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_ylmz_huanzhe','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_huanzhe')." ADD   `uniacid` int(10) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_huanzhe','hz_name')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_huanzhe')." ADD   `hz_name` varchar(50) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_huanzhe','hz_thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_huanzhe')." ADD   `hz_thumb` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_huanzhe','hz_count')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_huanzhe')." ADD   `hz_count` text NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_huanzhe','hz_time')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_huanzhe')." ADD   `hz_time` date NOT NULL DEFAULT '0000-00-00'");}
if(!pdo_fieldexists('hyb_ylmz_huanzhe','hz_type')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_huanzhe')." ADD   `hz_type` varchar(50) NOT NULL DEFAULT '0' COMMENT '患者推荐1推荐；0不推荐'");}
if(!pdo_fieldexists('hyb_ylmz_huanzhe','hz_desction')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_huanzhe')." ADD   `hz_desction` varchar(50) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_huanzhe','hz_mp3')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_huanzhe')." ADD   `hz_mp3` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_huanzhe','hz_zlks')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_huanzhe')." ADD   `hz_zlks` int(10) DEFAULT NULL COMMENT '方案分类'");}
if(!pdo_fieldexists('hyb_ylmz_huanzhe','hz_pic')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_huanzhe')." ADD   `hz_pic` varchar(255) NOT NULL COMMENT '诊疗后图片'");}
if(!pdo_fieldexists('hyb_ylmz_huanzhe','hz_bh')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_huanzhe')." ADD   `hz_bh` varchar(50) NOT NULL COMMENT '患者编号：随机'");}
if(!pdo_fieldexists('hyb_ylmz_huanzhe','uid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_huanzhe')." ADD   `uid` int(11) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_ylmz_keshi` (
  `k_id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `k_name` varchar(255) DEFAULT NULL COMMENT '科室名称',
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`k_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_ylmz_keshi','k_id')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_keshi')." ADD 
  `k_id` int(10) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_ylmz_keshi','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_keshi')." ADD   `uniacid` int(10) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_keshi','k_name')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_keshi')." ADD   `k_name` varchar(255) DEFAULT NULL COMMENT '科室名称'");}
if(!pdo_fieldexists('hyb_ylmz_keshi','uid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_keshi')." ADD   `uid` int(11) DEFAULT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_ylmz_keshi_yuyue` (
  `ky_id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) DEFAULT NULL,
  `ky_name` varchar(50) DEFAULT NULL COMMENT '患者名称',
  `ky_openid` varchar(255) DEFAULT NULL COMMENT '患者openid',
  `ky_telphone` varchar(50) DEFAULT NULL COMMENT '患者手机',
  `k_name` varchar(50) DEFAULT NULL COMMENT '科室ID',
  `ky_time` varchar(255) DEFAULT NULL COMMENT '预约时间',
  `ky_yibao` varchar(255) DEFAULT NULL COMMENT '订单号',
  `ky_sex` varchar(50) DEFAULT '1' COMMENT '默认是男 1：男； 0 女',
  `ky_zhenzhuang` longtext COMMENT '专家ID',
  `ky_doctor` varchar(50) NOT NULL COMMENT '就诊医生',
  `ky_chufang` varchar(50) DEFAULT NULL COMMENT '订单二维码',
  `ky_docmoney` varchar(50) NOT NULL DEFAULT '0' COMMENT '医生预约价格',
  `ky_hexiao` int(10) DEFAULT '0' COMMENT '0:未完成；1：已完成',
  `doctorack` int(11) NOT NULL DEFAULT '0' COMMENT '1:已确认；0未确认；2拒绝',
  `ky_age` int(11) NOT NULL COMMENT '年龄',
  `formid` varchar(50) NOT NULL,
  `state` int(11) NOT NULL DEFAULT '0',
  `yy_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `yyid` int(11) NOT NULL COMMENT '预约id',
  PRIMARY KEY (`ky_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_ylmz_keshi_yuyue','ky_id')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_keshi_yuyue')." ADD 
  `ky_id` int(10) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_ylmz_keshi_yuyue','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_keshi_yuyue')." ADD   `uniacid` int(10) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_keshi_yuyue','ky_name')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_keshi_yuyue')." ADD   `ky_name` varchar(50) DEFAULT NULL COMMENT '患者名称'");}
if(!pdo_fieldexists('hyb_ylmz_keshi_yuyue','ky_openid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_keshi_yuyue')." ADD   `ky_openid` varchar(255) DEFAULT NULL COMMENT '患者openid'");}
if(!pdo_fieldexists('hyb_ylmz_keshi_yuyue','ky_telphone')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_keshi_yuyue')." ADD   `ky_telphone` varchar(50) DEFAULT NULL COMMENT '患者手机'");}
if(!pdo_fieldexists('hyb_ylmz_keshi_yuyue','k_name')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_keshi_yuyue')." ADD   `k_name` varchar(50) DEFAULT NULL COMMENT '科室ID'");}
if(!pdo_fieldexists('hyb_ylmz_keshi_yuyue','ky_time')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_keshi_yuyue')." ADD   `ky_time` varchar(255) DEFAULT NULL COMMENT '预约时间'");}
if(!pdo_fieldexists('hyb_ylmz_keshi_yuyue','ky_yibao')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_keshi_yuyue')." ADD   `ky_yibao` varchar(255) DEFAULT NULL COMMENT '订单号'");}
if(!pdo_fieldexists('hyb_ylmz_keshi_yuyue','ky_sex')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_keshi_yuyue')." ADD   `ky_sex` varchar(50) DEFAULT '1' COMMENT '默认是男 1：男； 0 女'");}
if(!pdo_fieldexists('hyb_ylmz_keshi_yuyue','ky_zhenzhuang')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_keshi_yuyue')." ADD   `ky_zhenzhuang` longtext COMMENT '专家ID'");}
if(!pdo_fieldexists('hyb_ylmz_keshi_yuyue','ky_doctor')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_keshi_yuyue')." ADD   `ky_doctor` varchar(50) NOT NULL COMMENT '就诊医生'");}
if(!pdo_fieldexists('hyb_ylmz_keshi_yuyue','ky_chufang')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_keshi_yuyue')." ADD   `ky_chufang` varchar(50) DEFAULT NULL COMMENT '订单二维码'");}
if(!pdo_fieldexists('hyb_ylmz_keshi_yuyue','ky_docmoney')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_keshi_yuyue')." ADD   `ky_docmoney` varchar(50) NOT NULL DEFAULT '0' COMMENT '医生预约价格'");}
if(!pdo_fieldexists('hyb_ylmz_keshi_yuyue','ky_hexiao')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_keshi_yuyue')." ADD   `ky_hexiao` int(10) DEFAULT '0' COMMENT '0:未完成；1：已完成'");}
if(!pdo_fieldexists('hyb_ylmz_keshi_yuyue','doctorack')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_keshi_yuyue')." ADD   `doctorack` int(11) NOT NULL DEFAULT '0' COMMENT '1:已确认；0未确认；2拒绝'");}
if(!pdo_fieldexists('hyb_ylmz_keshi_yuyue','ky_age')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_keshi_yuyue')." ADD   `ky_age` int(11) NOT NULL COMMENT '年龄'");}
if(!pdo_fieldexists('hyb_ylmz_keshi_yuyue','formid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_keshi_yuyue')." ADD   `formid` varchar(50) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_keshi_yuyue','state')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_keshi_yuyue')." ADD   `state` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('hyb_ylmz_keshi_yuyue','yy_id')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_keshi_yuyue')." ADD   `yy_id` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_keshi_yuyue','uid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_keshi_yuyue')." ADD   `uid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_keshi_yuyue','yyid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_keshi_yuyue')." ADD   `yyid` int(11) NOT NULL COMMENT '预约id'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_ylmz_kscate` (
  `c_id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `c_name` varchar(255) NOT NULL COMMENT '科室名称',
  `icon` varchar(255) NOT NULL,
  `yy_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_ylmz_kscate','c_id')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_kscate')." ADD 
  `c_id` int(10) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_ylmz_kscate','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_kscate')." ADD   `uniacid` int(10) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_kscate','c_name')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_kscate')." ADD   `c_name` varchar(255) NOT NULL COMMENT '科室名称'");}
if(!pdo_fieldexists('hyb_ylmz_kscate','icon')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_kscate')." ADD   `icon` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_kscate','yy_id')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_kscate')." ADD   `yy_id` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_kscate','uid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_kscate')." ADD   `uid` int(11) NOT NULL DEFAULT '1'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_ylmz_mass` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_ylmz_mass','m_id')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_mass')." ADD 
  `m_id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_ylmz_mass','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_mass')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_mass','title')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_mass')." ADD   `title` varchar(50) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_mass','desc')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_mass')." ADD   `desc` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_mass','time')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_mass')." ADD   `time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP");}
if(!pdo_fieldexists('hyb_ylmz_mass','uid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_mass')." ADD   `uid` int(11) DEFAULT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_ylmz_myser` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `ser_name` varchar(255) DEFAULT NULL COMMENT '服务名称',
  `ser_thumb` varchar(255) DEFAULT NULL COMMENT '服务名称图标',
  `ser_lujing` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_ylmz_myser','id')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_myser')." ADD 
  `id` int(10) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_ylmz_myser','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_myser')." ADD   `uniacid` int(10) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_myser','ser_name')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_myser')." ADD   `ser_name` varchar(255) DEFAULT NULL COMMENT '服务名称'");}
if(!pdo_fieldexists('hyb_ylmz_myser','ser_thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_myser')." ADD   `ser_thumb` varchar(255) DEFAULT NULL COMMENT '服务名称图标'");}
if(!pdo_fieldexists('hyb_ylmz_myser','ser_lujing')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_myser')." ADD   `ser_lujing` varchar(255) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_ylmz_parameter` (
  `p_id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) DEFAULT NULL,
  `appid` varchar(255) DEFAULT NULL,
  `appsecret` varchar(255) DEFAULT NULL,
  `mch_id` varchar(255) DEFAULT NULL,
  `appkey` varchar(255) DEFAULT NULL,
  `keypem` varchar(50) NOT NULL COMMENT 'apiclient_cert.pem',
  `upfile` varchar(50) NOT NULL COMMENT 'apiclient_key.pem',
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_ylmz_parameter','p_id')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_parameter')." ADD 
  `p_id` int(10) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_ylmz_parameter','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_parameter')." ADD   `uniacid` int(10) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_parameter','appid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_parameter')." ADD   `appid` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_parameter','appsecret')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_parameter')." ADD   `appsecret` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_parameter','mch_id')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_parameter')." ADD   `mch_id` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_parameter','appkey')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_parameter')." ADD   `appkey` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_parameter','keypem')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_parameter')." ADD   `keypem` varchar(50) NOT NULL COMMENT 'apiclient_cert.pem'");}
if(!pdo_fieldexists('hyb_ylmz_parameter','upfile')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_parameter')." ADD   `upfile` varchar(50) NOT NULL COMMENT 'apiclient_key.pem'");}
if(!pdo_fieldexists('hyb_ylmz_parameter','uid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_parameter')." ADD   `uid` int(11) DEFAULT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_ylmz_recipe` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `userid` int(11) NOT NULL COMMENT '用户ID',
  `docid` int(11) NOT NULL COMMENT '医生id',
  `content` longtext COMMENT '处方',
  `dmoney` varchar(50) NOT NULL,
  `orderarr` varchar(255) NOT NULL COMMENT '订单号',
  `openid` varchar(255) DEFAULT NULL,
  `time` varchar(50) DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT '0',
  `dxtz` int(11) NOT NULL DEFAULT '0' COMMENT '1已通知，0未通知',
  `types` int(11) NOT NULL COMMENT '1,挂号处方；0预约处方',
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_ylmz_recipe','cid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_recipe')." ADD 
  `cid` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_ylmz_recipe','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_recipe')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_recipe','userid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_recipe')." ADD   `userid` int(11) NOT NULL COMMENT '用户ID'");}
if(!pdo_fieldexists('hyb_ylmz_recipe','docid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_recipe')." ADD   `docid` int(11) NOT NULL COMMENT '医生id'");}
if(!pdo_fieldexists('hyb_ylmz_recipe','content')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_recipe')." ADD   `content` longtext COMMENT '处方'");}
if(!pdo_fieldexists('hyb_ylmz_recipe','dmoney')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_recipe')." ADD   `dmoney` varchar(50) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_recipe','orderarr')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_recipe')." ADD   `orderarr` varchar(255) NOT NULL COMMENT '订单号'");}
if(!pdo_fieldexists('hyb_ylmz_recipe','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_recipe')." ADD   `openid` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_recipe','time')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_recipe')." ADD   `time` varchar(50) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_recipe','state')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_recipe')." ADD   `state` int(11) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('hyb_ylmz_recipe','dxtz')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_recipe')." ADD   `dxtz` int(11) NOT NULL DEFAULT '0' COMMENT '1已通知，0未通知'");}
if(!pdo_fieldexists('hyb_ylmz_recipe','types')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_recipe')." ADD   `types` int(11) NOT NULL COMMENT '1,挂号处方；0预约处方'");}
if(!pdo_fieldexists('hyb_ylmz_recipe','uid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_recipe')." ADD   `uid` int(11) DEFAULT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_ylmz_reg` (
  `gid` int(11) NOT NULL AUTO_INCREMENT,
  `age` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `money` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `push` varchar(50) NOT NULL COMMENT '消息推送',
  `tel` varchar(50) NOT NULL COMMENT '消息推送电话',
  `sfzheng` varchar(50) NOT NULL COMMENT '消息推送电话',
  `homeads` varchar(50) NOT NULL COMMENT '消息推送电话',
  `doc` varchar(50) NOT NULL,
  `openid` varchar(255) NOT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `kid` int(11) DEFAULT NULL COMMENT '科室ID',
  `docid` int(11) DEFAULT NULL COMMENT '专家ID',
  `studys` int(11) NOT NULL DEFAULT '0' COMMENT '挂号状态，是否到诊1到；0未到',
  `gorder` int(11) NOT NULL DEFAULT '0' COMMENT '确认状态1：确认 0未确认',
  `newtime` varchar(50) NOT NULL COMMENT '到诊时间',
  `number` int(11) NOT NULL,
  `time` varchar(255) NOT NULL DEFAULT '',
  `bianhao` varchar(50) NOT NULL COMMENT '随即编号',
  `xingqi` varchar(255) NOT NULL,
  `yue` varchar(20) NOT NULL,
  `startime` varchar(255) NOT NULL,
  `endtime` varchar(255) NOT NULL,
  `yy_id` int(11) NOT NULL COMMENT '医院ID',
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`gid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_ylmz_reg','gid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_reg')." ADD 
  `gid` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_ylmz_reg','age')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_reg')." ADD   `age` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_reg','date')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_reg')." ADD   `date` varchar(50) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_reg','department')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_reg')." ADD   `department` varchar(50) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_reg','gender')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_reg')." ADD   `gender` varchar(50) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_reg','money')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_reg')." ADD   `money` varchar(50) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_reg','name')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_reg')." ADD   `name` varchar(50) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_reg','push')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_reg')." ADD   `push` varchar(50) NOT NULL COMMENT '消息推送'");}
if(!pdo_fieldexists('hyb_ylmz_reg','tel')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_reg')." ADD   `tel` varchar(50) NOT NULL COMMENT '消息推送电话'");}
if(!pdo_fieldexists('hyb_ylmz_reg','sfzheng')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_reg')." ADD   `sfzheng` varchar(50) NOT NULL COMMENT '消息推送电话'");}
if(!pdo_fieldexists('hyb_ylmz_reg','homeads')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_reg')." ADD   `homeads` varchar(50) NOT NULL COMMENT '消息推送电话'");}
if(!pdo_fieldexists('hyb_ylmz_reg','doc')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_reg')." ADD   `doc` varchar(50) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_reg','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_reg')." ADD   `openid` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_reg','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_reg')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_reg','kid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_reg')." ADD   `kid` int(11) DEFAULT NULL COMMENT '科室ID'");}
if(!pdo_fieldexists('hyb_ylmz_reg','docid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_reg')." ADD   `docid` int(11) DEFAULT NULL COMMENT '专家ID'");}
if(!pdo_fieldexists('hyb_ylmz_reg','studys')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_reg')." ADD   `studys` int(11) NOT NULL DEFAULT '0' COMMENT '挂号状态，是否到诊1到；0未到'");}
if(!pdo_fieldexists('hyb_ylmz_reg','gorder')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_reg')." ADD   `gorder` int(11) NOT NULL DEFAULT '0' COMMENT '确认状态1：确认 0未确认'");}
if(!pdo_fieldexists('hyb_ylmz_reg','newtime')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_reg')." ADD   `newtime` varchar(50) NOT NULL COMMENT '到诊时间'");}
if(!pdo_fieldexists('hyb_ylmz_reg','number')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_reg')." ADD   `number` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_reg','time')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_reg')." ADD   `time` varchar(255) NOT NULL DEFAULT ''");}
if(!pdo_fieldexists('hyb_ylmz_reg','bianhao')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_reg')." ADD   `bianhao` varchar(50) NOT NULL COMMENT '随即编号'");}
if(!pdo_fieldexists('hyb_ylmz_reg','xingqi')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_reg')." ADD   `xingqi` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_reg','yue')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_reg')." ADD   `yue` varchar(20) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_reg','startime')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_reg')." ADD   `startime` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_reg','endtime')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_reg')." ADD   `endtime` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_reg','yy_id')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_reg')." ADD   `yy_id` int(11) NOT NULL COMMENT '医院ID'");}
if(!pdo_fieldexists('hyb_ylmz_reg','uid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_reg')." ADD   `uid` int(11) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_ylmz_tijianbaogao` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(255) NOT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `thumbarr` varchar(255) DEFAULT NULL,
  `tiyiyuan` varchar(50) DEFAULT NULL,
  `timearr` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `picfengm` varchar(255) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`t_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_ylmz_tijianbaogao','t_id')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_tijianbaogao')." ADD 
  `t_id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_ylmz_tijianbaogao','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_tijianbaogao')." ADD   `openid` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_tijianbaogao','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_tijianbaogao')." ADD   `uniacid` int(11) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_tijianbaogao','thumbarr')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_tijianbaogao')." ADD   `thumbarr` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_tijianbaogao','tiyiyuan')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_tijianbaogao')." ADD   `tiyiyuan` varchar(50) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_tijianbaogao','timearr')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_tijianbaogao')." ADD   `timearr` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP");}
if(!pdo_fieldexists('hyb_ylmz_tijianbaogao','picfengm')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_tijianbaogao')." ADD   `picfengm` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_tijianbaogao','uid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_tijianbaogao')." ADD   `uid` int(11) DEFAULT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_ylmz_upload_img` (
  `i_id` int(10) NOT NULL AUTO_INCREMENT,
  `i_openid` varchar(255) NOT NULL,
  `uniacid` int(10) NOT NULL,
  `i_type` int(10) NOT NULL COMMENT '0:患者问题；1:图文咨询；2:专家认证',
  `i_time` varchar(255) DEFAULT NULL,
  `i_img` longtext,
  `i_doctor` int(11) DEFAULT NULL COMMENT '我咨询的医生',
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`i_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_ylmz_upload_img','i_id')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_upload_img')." ADD 
  `i_id` int(10) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_ylmz_upload_img','i_openid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_upload_img')." ADD   `i_openid` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_upload_img','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_upload_img')." ADD   `uniacid` int(10) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_upload_img','i_type')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_upload_img')." ADD   `i_type` int(10) NOT NULL COMMENT '0:患者问题；1:图文咨询；2:专家认证'");}
if(!pdo_fieldexists('hyb_ylmz_upload_img','i_time')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_upload_img')." ADD   `i_time` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_upload_img','i_img')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_upload_img')." ADD   `i_img` longtext");}
if(!pdo_fieldexists('hyb_ylmz_upload_img','i_doctor')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_upload_img')." ADD   `i_doctor` int(11) DEFAULT NULL COMMENT '我咨询的医生'");}
if(!pdo_fieldexists('hyb_ylmz_upload_img','uid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_upload_img')." ADD   `uid` int(11) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_ylmz_userinfo` (
  `u_id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) DEFAULT NULL,
  `openid` varchar(255) DEFAULT NULL,
  `u_name` varchar(50) DEFAULT NULL,
  `u_thumb` varchar(255) DEFAULT NULL,
  `u_money` varchar(50) DEFAULT '0',
  `u_number` varchar(50) DEFAULT NULL,
  `formid` varchar(50) NOT NULL COMMENT 'formid',
  `form_id` longtext NOT NULL,
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_ylmz_userinfo','u_id')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_userinfo')." ADD 
  `u_id` int(10) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_ylmz_userinfo','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_userinfo')." ADD   `uniacid` int(10) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_userinfo','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_userinfo')." ADD   `openid` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_userinfo','u_name')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_userinfo')." ADD   `u_name` varchar(50) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_userinfo','u_thumb')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_userinfo')." ADD   `u_thumb` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_userinfo','u_money')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_userinfo')." ADD   `u_money` varchar(50) DEFAULT '0'");}
if(!pdo_fieldexists('hyb_ylmz_userinfo','u_number')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_userinfo')." ADD   `u_number` varchar(50) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_userinfo','formid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_userinfo')." ADD   `formid` varchar(50) NOT NULL COMMENT 'formid'");}
if(!pdo_fieldexists('hyb_ylmz_userinfo','form_id')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_userinfo')." ADD   `form_id` longtext NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_userinfo','uid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_userinfo')." ADD   `uid` int(11) DEFAULT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hyb_ylmz_userjiaren` (
  `j_id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `openid` varchar(255) NOT NULL,
  `names` varchar(255) NOT NULL,
  `sex` varchar(11) NOT NULL DEFAULT '0' COMMENT '0男1女',
  `age` char(50) NOT NULL,
  `region` varchar(255) NOT NULL COMMENT '所在地',
  `numcard` varchar(255) NOT NULL COMMENT '证件',
  `tel` varchar(50) NOT NULL,
  `pap_index` int(11) NOT NULL COMMENT '证件类型',
  `sick_index` int(11) NOT NULL COMMENT '关系类型',
  `datetime` varchar(255) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`j_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('hyb_ylmz_userjiaren','j_id')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_userjiaren')." ADD 
  `j_id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('hyb_ylmz_userjiaren','uniacid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_userjiaren')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_userjiaren','openid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_userjiaren')." ADD   `openid` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_userjiaren','names')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_userjiaren')." ADD   `names` varchar(255) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_userjiaren','sex')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_userjiaren')." ADD   `sex` varchar(11) NOT NULL DEFAULT '0' COMMENT '0男1女'");}
if(!pdo_fieldexists('hyb_ylmz_userjiaren','age')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_userjiaren')." ADD   `age` char(50) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_userjiaren','region')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_userjiaren')." ADD   `region` varchar(255) NOT NULL COMMENT '所在地'");}
if(!pdo_fieldexists('hyb_ylmz_userjiaren','numcard')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_userjiaren')." ADD   `numcard` varchar(255) NOT NULL COMMENT '证件'");}
if(!pdo_fieldexists('hyb_ylmz_userjiaren','tel')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_userjiaren')." ADD   `tel` varchar(50) NOT NULL");}
if(!pdo_fieldexists('hyb_ylmz_userjiaren','pap_index')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_userjiaren')." ADD   `pap_index` int(11) NOT NULL COMMENT '证件类型'");}
if(!pdo_fieldexists('hyb_ylmz_userjiaren','sick_index')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_userjiaren')." ADD   `sick_index` int(11) NOT NULL COMMENT '关系类型'");}
if(!pdo_fieldexists('hyb_ylmz_userjiaren','datetime')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_userjiaren')." ADD   `datetime` varchar(255) DEFAULT NULL");}
if(!pdo_fieldexists('hyb_ylmz_userjiaren','uid')) {pdo_query("ALTER TABLE ".tablename('hyb_ylmz_userjiaren')." ADD   `uid` int(11) DEFAULT NULL");}
