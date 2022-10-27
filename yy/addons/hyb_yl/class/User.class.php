<?php
class User {
    static function webMe() {
        global $_W, $_GPC;
         $neirong = array(
              '用户'=>array(
                  'list'=>array(
                        array(
                            "op" => "userlist",
                            "name" => "用户管理",
                            "url" => Util::webUrl("user", array(
                                "op" => "userlist",
                            ))
                        ) ,
                        array(
                            "op" => "adduser",
                            "name" => "添加新用户",
                            "url" => Util::webUrl("user", array(
                                "op" => "adduser",
                            ))
                        ) ,
                    ),
                  'key'=>0,
                  'curr'=>'curr',
                ),
              '专家'=>array(
                  'list'=>array(
                        array(
                            "op" => "expertsite",
                            "name" => "专家配置",
                            "url" => Util::webUrl("expert", array(
                                "op" => "expertsite",
                            ))
                        ) ,
                        array(
                            "op" => "expertlist",
                            "name" => "专家管理",
                            "url" => Util::webUrl("expert", array(
                                "op" => "expertlist",
                             
                            ))
                        ) ,
                        array(
                            "op" => "expertx",
                            "name" => "专家提现",
                            "url" => Util::webUrl("expert", array(
                                "op" => "expertx",
                             
                            ))
                        ) ,
                    ),
                  'key'=>1,
                  'curr'=>'curr'
                ),
              '医院'=>array(
                  'list'=>array(
                        array(
                            "op" => "channelsite",
                            "name" => "频道设置",
                            "url" => Util::webUrl("hospital", array(
                                "op" => "channelsite",
                            ))
                        ) ,
                        array(
                            "op" => "jgbase",
                            "name" => "机构基本资料",
                            "url" => Util::webUrl("hospital", array(
                                "op" => "jgbase",
                             
                            ))
                        ) ,
                        array(
                            "op" => "doccheck",
                            "name" => "医院实名审核",
                            "url" => Util::webUrl("hospital", array(
                                "op" => "doccheck",
                             
                            ))
                        ) ,
                        array(
                            "op" => "checkjs",
                            "name" => "机构订单结算",
                            "url" => Util::webUrl("hospital", array(
                                "op" => "checkjs",
                             
                            ))
                        ) ,
                        array(
                            "op" => "newslist",
                            "name" => "新闻管理",
                            "url" => Util::webUrl("hospital", array(
                                "op" => "newslist",
                             
                            ))
                        ) ,
                        array(
                            "op" => "environment",
                            "name" => "环境管理",
                            "url" => Util::webUrl("hospital", array(
                                "op" => "environment",
                             
                            ))
                        ) ,
                        array(
                            "op" => "lbthumb",
                            "name" => "轮播图管理",
                            "url" => Util::webUrl("hospital", array(
                                "op" => "lbthumb",
                             
                            ))
                        ) ,
                        array(
                            "op" => "lysite",
                            "name" => "留言管理",
                            "url" => Util::webUrl("hospital", array(
                                "op" => "lysite",
                             
                            ))
                        ) ,
                        array(
                            "op" => "xysite",
                            "name" => "信誉积分管理",
                            "url" => Util::webUrl("hospital", array(
                                "op" => "xysite",
                             
                            ))
                        ) , 
                    ),
                  'key'=>2,
                  'curr'=>'curr'
                ),
              '管理员'=>array(
                  'list'=>array(
                        array(
                            "op" => "adminst",
                            "name" => "管理员管理",
                            "url" => Util::webUrl("adminsite", array(
                                "op" => "adminst",
                            ))
                        ) ,
                    ),
                  'key'=>3,
                  'curr'=>'curr'
                ),
            );
         return $neirong;
    }
}

