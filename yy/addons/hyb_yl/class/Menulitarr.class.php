<?php
//dezend by http://www.sucaihuo.com/
class Menulitarr
{
	static  function menuList()
	{
	    global $_W,$_GPC;
	    $zixun_type = pdo_getall("hyb_yl_zixun_type",array("uniacid"=>$_W['uniacid']));
	    $zixuns = array();
	    foreach($zixun_type as $key => $value)
        {
            $zixuns[$key] = array('name' => $value['zx_name'], 'url' => '/hyb_yl/tabBar/jibingyufang/jibingyufang?zx_id='.$value['zx_id']);
        }
        $zixun_arr = pdo_getall("hyb_yl_zixun",array("uniacid"=>$_W['uniacid']));
        $zixun_list = array();
        foreach($zixun_arr as $kk => $vv)
        {
            $zixun_list[$kk] = array('name' => $vv['title'], 'url' => '/hyb_yl/userLife/pages/zixunanlixq/zixunanlixq?id='.$vv['id'].'&p_id='.$vv['p_id'].'&zid='.$vv['zid']);
        }
		$list = array(
			'dashboard'  => array(
				'title' => '小程序底部菜单管理',
				'list'  => array(
					array('name' => '首页', 'url' => '/hyb_yl/tabBar/index/index'),
					array('name' => '资讯', 'url' => '/hyb_yl/tabBar/jibingyufang/jibingyufang'),
					array('name' => '分享', 'url' => '/hyb_yl/tabBar/community/community'),
					array('name' => '药房', 'url' => '/hyb_yl/tabBar/shop/shop'),
					array('name' => '问诊', 'url' => '/hyb_yl/tabBar/fastnavigate/fastnavigate'),
					array('name' => '服务', 'url' => '/hyb_yl/tabBar/service/service'),
					array('name' => '我的', 'url' => '/hyb_yl/tabBar/my/my'),
				)
			),
			'store'      => array(
				'title' => '服务包链接',
				'list'  => array(
					array('name' => '手术快约', 'url' => '/hyb_yl/userCommunicate/pages/changeDoctor/changeDoctor'),
					array('name' => '报告解读', 'url' => '/hyb_yl/backstageServices/pages/baogaojiedu/baogaojiedu'),
					array('name' => '家庭医生', 'url' => '/hyb_yl/doctor/pages/familydoctor/mydoctor/mydoctor'),
					array('name' => '私人医生', 'url' => '/hyb_yl/czhuanjiasubpages/pages/longsever/index'),
					array('name' => '视频问诊', 'url' => '/hyb_yl/backstageLife/pages/shipinwenzhen/shipinwenzhen'),
					array('name' => '电话急诊', 'url' => '/hyb_yl/backstageLife/pages/shipinwenzhen/shipinwenzhen'),
					array('name' => '图文问诊', 'url' => '/hyb_yl/backstageLife/pages/shipinwenzhen/shipinwenzhen'),
					array('name' => '在线挂号', 'url' => '/hyb_yl/czhuanjiasubpages/pages/longsever/index?key_words=yuanchengguahao'),
					array('name' => '预约就诊', 'url' => '/hyb_yl/czhuanjiasubpages/pages/longsever/index'),
					array('name' => '住院安排', 'url' => '/hyb_yl/czhuanjiasubpages/pages/longsever/index'),
					array('name' => '手术安排', 'url' => '/hyb_yl/czhuanjiasubpages/pages/longsever/index'),
					array('name' => '报告加急', 'url' => '/hyb_yl/czhuanjiasubpages/pages/longsever/index'),
					// array('name' => '绿色通道', 'url' => '/hyb_yl/inputList/pages/yueyuList/yueyuList'),
					// array('name' => '院后服务', 'url' => '/hyb_yl/inputList/pages/fuzhuList/fuzhuList'),

				)
			),
			'zixun' => array(
			    'title' => '咨询分类',
			    'list' => $zixuns
			 ),
			'zixun_list' => array(
			    'title' => '咨询文章',
			    'list' => $zixun_list
			 ),
			'others' => array(
				'title' => '其他链接',
				'list' => array(
					array('name' => '热门问题', 'url' => '/hyb_yl/twosubpages/pages/publicProblems/publicProblems?'),
					array('name' => '家庭医生', 'url' => '/hyb_yl/doctor/pages/familydoctor/mydoctor/mydoctor'),
					array('name' => '查疾病', 'url' => '/hyb_yl/twosubpages/pages/more/more'),
					array('name' => '查症状', 'url' => '/hyb_yl/twosubpages/pages/itemdetail/itemdetail?type=1'),
					array('name' => '查疫苗', 'url' => '/hyb_yl/twosubpages/pages/itemdetail/itemdetail?type=2'),
					array('name' => '体检解读', 'url' => '/hyb_yl/twosubpages/pages/itemdetail/itemdetail?type=3'),
					array('name' => '家庭备用药', 'url' => '/hyb_yl/twosubpages/pages/itemdetail/itemdetail?type=4'),
					array('name' => '法定传染病', 'url' => '/hyb_yl/twosubpages/pages/itemdetail/itemdetail?type=5'),
					array('name' => '搜索', 'url' => '/hyb_yl/mysubpages/pages/search/search'),
					array('name' => '公开问题', 'url' => '/hyb_yl/twosubpages/pages/publicProblems/publicProblems?tabindex=-1'),
					array('name' => '签约医生', 'url' => '/hyb_yl/mycenter/pages/followDoc/followDoc?typs=siren_doc'),
					array('name' => '会员办理', 'url' => '/hyb_yl/backstageServices/pages/vip/vip?tit=好医专享&ser_key=svip&id=24&ifzy=0&key_words=svip'),
					array('name' => '发布动态', 'url' => '/hyb_yl/userLife/pages/addDynamic/addDynamic'),
				)
			),
			'disease' => array(
				'title' => '查疾病',
				'list' => array(
					array('name' => '疾病首页','url' => '/hyb_yl/twosubpages/pages/yuzhen/yuzhen'),
					array('name' => '疾病列表','url' => '/hyb_yl/twosubpages/pages/more/more'),
					array('name' => '症状列表','url' => '/hyb_yl/twosubpages/pages/itemdetail/itemdetail?type=1'),
					array('name' => '疫苗列表','url' => '/hyb_yl/twosubpages/pages/itemdetail/itemdetail?type=2'),
					array('name' => '体检解读','url' => '/hyb_yl/twosubpages/pages/itemdetail/itemdetail?type=3'),
					array('name' => '家庭备用药','url' => '/hyb_yl/twosubpages/pages/itemdetail/itemdetail?type=4'),
					array('name' => '法定传染病','url' => '/hyb_yl/twosubpages/pages/itemdetail/itemdetail?type=5'),
				)
			),
			'wenzhen' => array(
				'title' => '问诊',
				'list' => array(
					array('name' => '去开方','url' => '/hyb_yl/backstageServices/pages/yuanchengkaifang/yuanchengkaifang?tit=去开方&ser_key=yuanchengkaifang&id=21&ifzy=0&key_words=yuanchengkaifang'),
					array('name' => '手术预约','url' => '/hyb_yl/backstageServices/pages/shoushukuaiyue/shoushukuaiyue?pinyin=shoushukuaiyue&typs=query'),
					array('name' => '报告解读','url' => '/hyb_yl/backstageServices/pages/baogaojiedu/baogaojiedu?key_words=tijianjiedu'),
					array('name' => '社区医生','url' => '/hyb_yl/doctor/pages/familydoctor/mydoctor/mydoctor?sid=undefined&key=zhuanjiatuandui&name=社区医生'),
					array('name' => '远程挂号','url' => '/hyb_yl/czhuanjiasubpages/pages/longsever/index?sid=undefined&key=yuanchengguahao&name=远程挂号'),
				)
			),
			'lvtong' => array(
				'title' => '问诊',
				'list' => array(
					array('name' => '预约就诊','url' => '/hyb_yl/czhuanjiasubpages/pages/longsever/index?ser_key=yuyuejiuzhen&name=预约就诊'),
					array('name' => '住院安排','url' => '/hyb_yl/czhuanjiasubpages/pages/longsever/index?ser_key=zhuyuananpai&name=住院安排'),
					array('name' => '手术安排','url' => '/hyb_yl/czhuanjiasubpages/pages/longsever/index'),
					array('name' => '社区医生','url' => '/hyb_yl/doctor/pages/familydoctor/mydoctor/mydoctor?sid=undefined&key=zhuanjiatuandui&name=社区医生'),
					array('name' => '远程挂号','url' => '/hyb_yl/czhuanjiasubpages/pages/longsever/index?sid=undefined&key=yuanchengguahao&name=远程挂号'),
				)
			),
			'dashboards'  => array(
				'title' => '我的问诊',
				'list'  => array(
					array('name' => '电话问诊', 'url' => '/hyb_yl/mysubpages/pages/wodezixun/wodezixun?type=wenzhen&key_words=dianhuajizhen'),
					array('name' => '视频问诊', 'url' => '/hyb_yl/mysubpages/pages/wodezixun/wodezixun?type=wenzhen&key_words=shipinwenzhen'),
					array('name' => '开药问诊', 'url' => '/hyb_yl/mysubpages/pages/wodezixun/wodezixun?type=wenzhen&key_words=yuanchengkaifang'),
					array('name' => '图文问诊', 'url' => '/hyb_yl/mysubpages/pages/wodezixun/wodezixun?type=wenzhen&key_words=tuwenwenzhen'),
					array('name' => '快速问诊', 'url' => '/hyb_yl/mysubpages/pages/wodezixun/wodezixun?type=wenzhen&key_words=kuaisuwenzhen'),
					
				)
			),
			'stores'  => array(
				'title' => '我的订单',
				'list'  => array(
					array('name' => '体检订单', 'url' => '/hyb_yl/mysubpages/pages/physicalOrder/physicalOrder'),
					array('name' => '药品订单', 'url' => '/hyb_yl/userCommunicate/pages/order/order'),
					array('name' => '签约订单', 'url' => '/hyb_yl/userCommunicate/pages/recordSigning/recordSigning'),
					array('name' => '挂号订单', 'url' => '/hyb_yl/mysubpages/pages/my_dingdan1/my_dingdan1'),
					array('name' => '课程订单', 'url' => '/hyb_yl/mycenter/pages/currOrder/currOrder'),

				)
			),
			'lvtongs'   => array(
				'title' => '绿通订单',
				'list'  => array(
					array('name' => '报告加急', 'url' => '/hyb_yl/lvtongserver/pages/orderlist/orderlist?keyword=baogaojiaji'),
					array('name' => '手术安排', 'url' => '/hyb_yl/lvtongserver/pages/orderlist/orderlist?keyword=shoushuanpai'),
					array('name' => '预约就诊', 'url' => '/hyb_yl/lvtongserver/pages/orderlist/orderlist?keyword=yuyuejiuzhen'),
					array('name' => '住院安排', 'url' => '/hyb_yl/lvtongserver/pages/orderlist/orderlist?keyword=zhuyuananpai'),
					array('name' => '导诊入口', 'url' => '/hyb_yl/lvtongserver/pages/index/index'),

				)
			),
			'others' => array(
				'title' => '我的服务',
				'list' => array(
					array('name' => '报告解读', 'url' => '/hyb_yl/mysubpages/pages/unscramble/unscramble'),
					array('name' => '手术安排', 'url' => '/hyb_yl/mysubpages/pages/wodezixun/wodezixun?type=shoushu&key_words=shoushukuaiyue'),
					array('name' => '医生卡', 'url' => '/hyb_yl/backstageServices/pages/yearcardlist/yearcardlist'),
					array('name' => '我的动态', 'url' => '/hyb_yl/twosubpages/pages/more/more'),
					array('name' => '我的患教', 'url' => '/hyb_yl/twosubpages/pages/itemdetail/itemdetail?type=1'),
				)
			),
			'jiangkan' => array(
				'title' => '健康管理',
				'list' => array(
					array('name' => '健康档案', 'url' => '/hyb_yl/zhuanjiasubpages/pages/huanzhexinxi/huanzhexinxi?type=1&gren=1'),
					array('name' => '我的报告', 'url' => '/hyb_yl/mysubpages/pages/report/report'),
					array('name' => '报告对比', 'url' => '/hyb_yl/mysubpages/pages/report/report'),
					array('name' => '健康分析', 'url' => ''),
					array('name' => '我的处方', 'url' => '/hyb_yl/mysubpages/pages/my_hzprescription/my_hzprescription'),
					array('name' => '绑定设备', 'url' => '/hyb_yl/mycenter/pages/set_equipment/set_equipment'),
				)
			),
			'server' => array(
				'title' => '专属服务',
				'list' => array(
					array('name' => '我的优惠券', 'url' => '/hyb_yl/mycenter/pages/myCoupon/myCoupon'),
					array('name' => '我的会员卡', 'url' => '/hyb_yl/backstageServices/pages/vip/vip'),
					array('name' => '私人医生', 'url' => '/hyb_yl/mycenter/pages/followDoc/followDoc?typs=siren_doc'),
					array('name' => '免费兑礼', 'url' => ''),
					array('name' => '专属客服', 'url' => ''),
				)
			),
			'tool' => array(
				'title' => '必备工具',
				'list' => array(
					array('name' => '专家入口', 'url' => '/hyb_yl/mysubpages/pages/backstageIndex/backstageIndex'),
					array('name' => '机构入口', 'url' => '/hyb_yl/jigou/pages/index/index'),
					array('name' => '推客入口', 'url' => '/hyb_yl/mycenter/pages/twitterApply/twitterApply'),
					array('name' => '药师入口', 'url' => '/hyb_yl/yaoshi/pages/index/index'),
					array('name' => '设置', 'url' => ''),
					array('name' => '消息设置', 'url' => '/hyb_yl/mysubpages/pages/set_jurisdiction/set_jurisdiction'),
				)
			),		
		);
		return $list;
	}
	static  function centerMenu()
	{
		$list  = array(
			'my' => array(
				'title' => '个人中心',
				'child' => array(
					'dashboard'  => array(
						'title' => '我的问诊',
						'list'  => array(
							array('name' => '电话问诊', 'url' => '/hyb_yl/mysubpages/pages/wodezixun/wodezixun?type=wenzhen&key_words=dianhuajizhen'),
							array('name' => '视频问诊', 'url' => '/hyb_yl/mysubpages/pages/wodezixun/wodezixun?type=wenzhen&key_words=shipinwenzhen'),
							array('name' => '开药问诊', 'url' => '/hyb_yl/mysubpages/pages/wodezixun/wodezixun?type=wenzhen&key_words=yuanchengkaifang'),
							array('name' => '图文问诊', 'url' => '/hyb_yl/mysubpages/pages/wodezixun/wodezixun?type=wenzhen&key_words=tuwenwenzhen'),
							array('name' => '快速问诊', 'url' => '/hyb_yl/mysubpages/pages/wodezixun/wodezixun?type=wenzhen&key_words=kuaisuwenzhen'),
							
						)
					),
					'store'      => array(
						'title' => '我的订单',
						'list'  => array(
							array('name' => '体检订单', 'url' => '/hyb_yl/mysubpages/pages/physicalOrder/physicalOrder'),
							array('name' => '药品订单', 'url' => '/hyb_yl/userCommunicate/pages/order/order'),
							array('name' => '签约订单', 'url' => '/hyb_yl/userCommunicate/pages/recordSigning/recordSigning'),
							array('name' => '挂号订单', 'url' => '/hyb_yl/mysubpages/pages/my_dingdan1/my_dingdan1'),
							array('name' => '课程订单', 'url' => '/hyb_yl/mycenter/pages/currOrder/currOrder'),

						)
					),
					'lvtong'      => array(
						'title' => '绿通订单',
						'list'  => array(
							array('name' => '报告加急', 'url' => '/hyb_yl/lvtongserver/pages/orderlist/orderlist?keyword=baogaojiaji'),
							array('name' => '手术安排', 'url' => '/hyb_yl/lvtongserver/pages/orderlist/orderlist?keyword=shoushuanpai'),
							array('name' => '预约就诊', 'url' => '/hyb_yl/lvtongserver/pages/orderlist/orderlist?keyword=yuyuejiuzhen'),
							array('name' => '住院安排', 'url' => '/hyb_yl/lvtongserver/pages/orderlist/orderlist?keyword=zhuyuananpai'),
							array('name' => '导诊入口', 'url' => '/hyb_yl/lvtongserver/pages/index/index'),

						)
					),
					'others' => array(
						'title' => '我的服务',
						'list' => array(
							array('name' => '报告解读', 'url' => '/hyb_yl/mysubpages/pages/unscramble/unscramble'),
							array('name' => '手术安排', 'url' => '/hyb_yl/mysubpages/pages/wodezixun/wodezixun?type=shoushu&key_words=shoushukuaiyue'),
							array('name' => '医生卡', 'url' => '/hyb_yl/backstageServices/pages/yearcardlist/yearcardlist'),
							array('name' => '我的动态', 'url' => '/hyb_yl/twosubpages/pages/more/more'),
							array('name' => '我的患教', 'url' => '/hyb_yl/twosubpages/pages/itemdetail/itemdetail?type=1'),
						)
					),
					'jiangkan' => array(
						'title' => '健康管理',
						'list' => array(
							array('name' => '健康档案', 'url' => '/hyb_yl/zhuanjiasubpages/pages/huanzhexinxi/huanzhexinxi?type=1&gren=1'),
							array('name' => '我的报告', 'url' => '/hyb_yl/mysubpages/pages/report/report'),
							array('name' => '报告对比', 'url' => '/hyb_yl/mysubpages/pages/report/report'),
							array('name' => '健康分析', 'url' => ''),
							array('name' => '我的处方', 'url' => '/hyb_yl/mysubpages/pages/my_hzprescription/my_hzprescription'),
							array('name' => '绑定设备', 'url' => '/hyb_yl/mycenter/pages/set_equipment/set_equipment'),
						)
					),
					'server' => array(
						'title' => '专属服务',
						'list' => array(
							array('name' => '我的优惠券', 'url' => '/hyb_yl/mycenter/pages/myCoupon/myCoupon'),
							array('name' => '我的会员卡', 'url' => '/hyb_yl/backstageServices/pages/vip/vip'),
							array('name' => '私人医生', 'url' => '/hyb_yl/mycenter/pages/followDoc/followDoc?typs=siren_doc'),
							array('name' => '免费兑礼', 'url' => ''),
							array('name' => '专属客服', 'url' => ''),
						)
					),
					'tool' => array(
						'title' => '必备工具',
						'list' => array(
							array('name' => '专家入口', 'url' => '/hyb_yl/mysubpages/pages/backstageIndex/backstageIndex'),
							array('name' => '机构入口', 'url' => '/hyb_yl/jigou/pages/index/index'),
							array('name' => '推客入口', 'url' => '/hyb_yl/mycenter/pages/twitterApply/twitterApply'),
							array('name' => '药师入口', 'url' => '/hyb_yl/yaoshi/pages/index/index'),
							array('name' => '设置', 'url' => ''),
							array('name' => '消息设置', 'url' => '/hyb_yl/mysubpages/pages/set_jurisdiction/set_jurisdiction'),
						)
					),
				)
			),
			'zhuanjia' => array(
				'title' => '专家中心',
				'child' => array(
					'dashboard'  => array(
						'title' => '患者管理',
						'list'  => array(
							array('name' => '签约患者', 'url' => '/hyb_yl/mysubpages/pages/patientman/patientman?state=1'),
							array('name' => '普通患者', 'url' => '/hyb_yl/mysubpages/pages/patientman/patientman?state=2'),
							array('name' => '年卡患者', 'url' => '/hyb_yl/mysubpages/pages/patientman/patientman?state=3'),
							
						)
					),
				)
			),
			'hospital' => array(
				'title' => '机构中心',
				'child' => array(
					'dashboard'  => array(
						'title' => '经营功能',
						'list'  => array(
							array('name' => '管理入口', 'url' => '/hyb_yl/mysubpages/pages/capitacenter/capitacenter'),
							array('name' => '专家管理', 'url' => '/hyb_yl/mycenter/pages/expertAdmin/expertAdmin'),
							array('name' => '账户设置', 'url' => ''),
							array('name' => '修改资料', 'url' => '/hyb_yl/mycenter/pages/organApply/organApply'),
						)
					),
				)
			),
			'hospital' => array(
				'title' => '药师中心',
				'child' => array(
					'dashboard'  => array(
						'title' => '操作中心',
						'list'  => array(
							array('name' => '已审订单', 'url' => '/hyb_yl/yaoshi/pages/docorder/docorder?typs=yishen'),
							array('name' => '待审订单', 'url' => '/hyb_yl/yaoshi/pages/docorder/docorder?typs=shenhe'),
							
							array('name' => '修改资料', 'url' => '/hyb_yl/yaoshi/pages/docedit/docedit?typs=edit'),
						)
					),

				)
			),
			
		);
		return $list;
	}
	
}

defined('IN_IA') || exit('Access Denied');

?>
