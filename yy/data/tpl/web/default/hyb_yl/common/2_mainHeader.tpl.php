<?php defined('IN_IA') or exit('Access Denied');?><html lang="zh-cn">
<head><style type="text/css">@charset "UTF-8";[ng\:cloak],[ng-cloak],[data-ng-cloak],[x-ng-cloak],.ng-cloak,.x-ng-cloak,.ng-hide:not(.ng-hide-animate){display:none !important;}ng\:form{display:block;}.ng-animate-shim{visibility:hidden;}.ng-anchor{position:absolute;}</style><style type="text/css">@charset "UTF-8";[ng\:cloak],[ng-cloak],[data-ng-cloak],[x-ng-cloak],.ng-cloak,.x-ng-cloak,.ng-hide:not(.ng-hide-animate){display:none !important;}ng\:form{display:block;}.ng-animate-shim{visibility:hidden;}.ng-anchor{position:absolute;}</style> 
  <meta charset="utf-8"> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <title><?php  echo $_W['uniaccount']['name'];?></title> 
  <link rel="shortcut icon" href="<?php  echo $_W['siteroot'];?>attachment/images/global/wechat.jpg"> 
  <link rel="stylesheet" href="<?php  echo $_W['siteroot'];?>web/resource/css/bootstrap.min.css"> 
  <link rel="stylesheet" href="/addons/hyb_yl/web/resource/components/font-awesome-4.6.3/css/font-awesome.min.css"> 
  <link rel="stylesheet" href="<?php  echo $_W['siteroot'];?>addons/hyb_yl/public/admin/iconfont.css"> 
  <link href="<?php  echo $_W['siteroot'];?>web/resource/css/common.css?v=20170802" rel="stylesheet"> 
  <link rel="stylesheet" href="<?php  echo $_W['siteroot'];?>addons/hyb_yl/web/resource/css/common_v2.css"> 
  <link rel="stylesheet" href="<?php  echo $_W['siteroot'];?>addons/hyb_yl/web/resource/css/style.min.css"> 

	<script type="text/javascript">
	if(navigator.appName == 'Microsoft Internet Explorer'){
		if(navigator.userAgent.indexOf("MSIE 5.0")>0 || navigator.userAgent.indexOf("MSIE 6.0")>0 || navigator.userAgent.indexOf("MSIE 7.0")>0) {
			alert('您使用的 IE 浏览器版本过低, 推荐使用 Chrome 浏览器或 IE8 及以上版本浏览器.');
		}
	}
	window.sysinfo = {
		'uniacid': '5',		'acid': '5',				'uid': '1',				'siteroot': '<?php  echo $_W['siteroot'];?>',
		'siteurl': '<?php  echo $_W['siteroot'];?>web/index.php?c=site&a=entry&do=dashboard&op=gk&m=hyb_yl&ac=dashboard',
		'attachurl': 'https://caiji123258.oss-cn-beijing.aliyuncs.com/',
		'attachurl_local': '<?php  echo $_W['siteroot'];?>attachment/',
		'attachurl_remote': 'https://caiji123258.oss-cn-beijing.aliyuncs.com/',
		'MODULE_URL': '<?php  echo $_W['siteroot'];?>addons/hyb_yl/',		'cookie' : {'pre': 'a8ba_'},
		'account' : {"acid":"5","uniacid":"5","token":"z76rlmnlvYKoHNyyTUzztUz77G0HpkNy","encodingaeskey":"c6ZRrNd0awWan6S181bzs7bf0861D0w888DRRzfI0I7","level":"1","account":"","original":"gh_6005ca48bbf2","key":"wx206380818e1922b5","secret":"9ec4fceeb10df7d6f9d0aebc8c66aee9","name":"\u601d\u521b\u62d3\u5ba2","appdomain":"","auth_refresh_token":"","encrypt_key":"wx206380818e1922b5","hash":"gGGl54u4","type":"4","isconnect":"0","isdeleted":"0","endtime":"0","groupid":"0","description":"","default_acid":"5","rank":null,"title_initial":"S","type_sign":"wxapp","starttime":"0","groups":[],"setting":{"uniacid":"5","passport":"","oauth":"","jsauth_acid":"0","uc":"","notify":"","creditnames":{"credit1":{"title":"\u79ef\u5206","enabled":1},"credit2":{"title":"\u4f59\u989d","enabled":1}},"creditbehaviors":{"activity":"credit1","currency":"credit2"},"welcome":"","default":"","default_message":"","payment":"","stat":"","default_site":null,"sync":"0","recharge":"","tplnotice":"","grouplevel":"0","mcplugin":"","exchange_enable":"0","coupon_type":"0","menuset":"","statistics":"","bind_domain":"","comment_status":"0","reply_setting":"0","default_module":"","attachment_limit":null,"attachment_size":null,"sync_member":"0"},"grouplevel":"0","logo":"https:\/\/caiji123258.oss-cn-beijing.aliyuncs.com\/headimg_5.jpg?time=1583481558","qrcode":"https:\/\/caiji123258.oss-cn-beijing.aliyuncs.com\/qrcode_5.jpg?time=1583481558","type_name":"\u5fae\u4fe1\u5c0f\u7a0b\u5e8f","switchurl":".\/index.php?c=account&a=display&do=switch&uniacid=5","setmeal":{"uid":-1,"username":"\u521b\u59cb\u4eba","timelimit":"\u672a\u8bbe\u7f6e","groupid":"-1","groupname":"\u6240\u6709\u670d\u52a1"},"current_user_role":"founder"}	};
	</script>
 <!--<script>var require = { urlArgs: 'v=2020030409' };</script> -->
  <script type="text/javascript" src="<?php  echo $_W['siteroot'];?>web/resource/js/lib/jquery-1.11.1.min.js"></script> 
  <script type="text/javascript" src="<?php  echo $_W['siteroot'];?>addons/hyb_yl/web/resource/js/vue.js"></script> 
  <script src="https://cdn.bootcss.com/html2canvas/0.5.0-beta4/html2canvas.js"></script> 
  <script type="text/javascript" src="<?php  echo $_W['siteroot'];?>addons/hyb_yl/web/resource/components/layer/layer.js"></script><link rel="stylesheet" href="<?php  echo $_W['siteroot'];?>addons/hyb_yl/web/resource/components/layer/skin/layer.css" id="layui_layer_skinlayercss" style=""><link rel="stylesheet" href="<?php  echo $_W['siteroot'];?>addons/hyb_yl/web/resource/components/layer/skin/layer.css" id="layui_layer_skinlayercss" style=""> 
  <script type="text/javascript" src="<?php  echo $_W['siteroot'];?>web/resource/js/lib/bootstrap.min.js?v=20170208"></script> 
  <script type="text/javascript" src="<?php  echo $_W['siteroot'];?>addons/hyb_yl/web/resource/js/util.js"></script> 
  <script type="text/javascript" src="<?php  echo $_W['siteroot'];?>web/resource/js/app/common.min.js"></script>
  <script type="text/javascript" src="<?php  echo HYB_YL_ADMIN?>/js/tooltipbox.js"></script> 
  <script type="text/javascript" src="<?php  echo $_W['siteroot'];?>web/resource/js/require.js"></script> 
  <script type="text/javascript" src="<?php  echo $_W['siteroot'];?>addons/hyb_yl/web/resource/js/weliam.js"></script> 
  <script src="<?php  echo $_W['siteroot'];?>addons/hyb_yl/web/resource/js/common.js"></script> 

 </head>
<body>
<div class="head">
	<div class="app-sidebar">
		<div class="head-before">
			<div class="head-logo" style="background-image:url(<?php  if($_W['wlsetting']['base']['logo']) { ?><?php  echo tomedia($_W['wlsetting']['base']['logo'])?><?php  } else { ?><?php  echo tomedia('headimg_'.$_W['account']['acid'].'.jpg')?><?php  } ?>);"></div>
		</div>
		<div class="app-sidebar-list">
			<div class="">

			   <?php  $getallmenu = Data::getallmenu();?>
				<ul class="">
					<?php  $top_menus = Data::webMenu(); ?>

					<?php  if(is_array($top_menus)) { foreach($top_menus as $topmenus) { ?>
                           
                         <?php  if(is_agent != '1' || (is_agent == '1' && in_array(htmlspecialchars($topmenus['title']),$role))) { ?>
					        <li <?php  if(is_array($topmenus['active']) && in_array($_W['plugin'], $topmenus['active'])) { ?> class="active" <?php  } else if($_W['plugin'] == $topmenus['active']) { ?> class="active" <?php  } ?> <?php  if(is_array($topmenus['active'])) { ?> style="margin-top: 44px;"<?php  } ?>><a href="<?php  echo $topmenus['url'];?>" ><?php  echo $topmenus['title'];?></a></li>
					     <?php  } ?>
                      
                    <?php  } } ?>
			    </ul>
			</div>
		</div>
	</div>
	<div class="app-login-info">
		<div class="app-login-info-name">
			<div class="app-login-info-name-d">
				<div class="face"><i class="icon iconfont icon-peoplefill"></i></div>
				<div class="name"></div>
			</div>
		</div>
		<div class="app-login-info-sel">
			<div class="app-login-info-sel-arrow"></div>
			<div class="app-login-info-sel-d">
		
                    <a href="index.php?c=miniapp&a=version&do=home&version_id=<?php  echo $_GPC['uniacid']?>">
                        <div class="sel-p">
                            <div class="sel-p-l"><div class="h3">返回系统</div></div>
                            <div class="sel-p-r"></div>
                        </div>
                    </a>
                    <a href="">
                        <div class="sel-p sel-p-no-line">
                            <div class="sel-p-l"><div class="h3"><?php  echo $_W['username']?></div></div>
                            <div class="sel-p-r"><i class="icon iconfont icon-right"></i></div>
                        </div>
                    </a>
                    <a href="./index.php?c=user&amp;a=logout&amp;">
                        <div class="sel-p login-out">
                            <div class="sel-p-l"><div class="h3">退出登录</div></div>
                            <div class="sel-p-r"><i class="icon iconfont icon-exit"></i></div>
                        </div>
                    </a>
			
			</div>
		</div>
	</div>
</div>

<div class="container-fluid main-body">
	<?php  if(defined('IN_MESSAGE')) { ?>
	<div class="jumbotron clearfix alert alert-<?php  echo $label;?>">
		<div class="row">
			<div class="col-xs-12 col-sm-3 col-lg-2">
				<i class="fa fa-5x fa-<?php  if($label=='success') { ?>check-circle<?php  } ?><?php  if($label=='danger') { ?>times-circle<?php  } ?><?php  if($label=='info') { ?>info-circle<?php  } ?><?php  if($label=='warning') { ?>exclamation-triangle<?php  } ?>"></i>
			</div>
			<div class="col-xs-12 col-sm-8 col-md-9 col-lg-10">
				<?php  if(is_array($msg)) { ?>
					<h2>MYSQL 错误：</h2>
					<p><?php  echo cutstr($msg['sql'], 300, 1);?></p>
					<p><b><?php  echo $msg['error']['0'];?> <?php  echo $msg['error']['1'];?>：</b><?php  echo $msg['error']['2'];?></p>
				<?php  } else { ?>
				<h2><?php  echo $caption;?></h2>
				<p><?php  echo $msg;?></p>
				<?php  } ?>
				<?php  if($redirect) { ?>
				<p><a href="<?php  echo $redirect;?>">如果你的浏览器没有自动跳转，请点击此链接</a></p>
				<script type="text/javascript">
					setTimeout(function () {
						location.href = "<?php  echo $redirect;?>";
					}, 3000);
				</script>
				<?php  } else { ?>
					<p>[<a href="javascript:history.go(-1);">点击这里返回上一页</a>] &nbsp; [<a href="./?refresh">首页</a>]</p>
				<?php  } ?>
			</div>
	<?php  } else { ?>
	<?php  $frames_name = get.$_W['plugin'].Frames; $menusclass = Data;$frames = $menusclass::$frames_name(); $menusclass::_calc_current_frames2($frames);?>
	<div class="app-container <?php  if(empty($frames)) { ?>empty-big-menu<?php  } ?>">
		<?php  if(!empty($frames)) { ?>
			<div class="big-menu second-sidebar">
				<div class="second-sidebar-t">
					<?php  if(is_array($top_menus)) { foreach($top_menus as $topmenus) { ?>
						<?php  if(is_agent != '1' || (is_agent == '1' && in_array(htmlspecialchars($topmenus['title']),$role))) { ?>
					<?php  if((is_array($topmenus['active']) && in_array($_W['plugin'], $topmenus['active'])) || ($_W['plugin'] == $topmenus['active'])) { ?><?php  echo mb_substr($topmenus['title'], -2, 2, 'UTF8');?>中心<?php  } ?>
					<?php  } ?>
					<?php  } } ?>
				</div>
				<div class="second-sidebar-c">
					<?php  if(is_array($frames)) { foreach($frames as $k => $frame) { ?>

					
                        <div class="panel panel-default">
                            <div class="panel-heading">
                            <?php  if(is_agent != '1' || (is_agent == '1' && in_array(htmlspecialchars($frame['title']),$role))) { ?>
                                <h4 class="panel-title"><?php  echo $frame['title'];?></h4>
                                <?php  } ?>
                            </div>
                            <ul class="list-group collapse in" id="frame-<?php  echo $k;?>">
                                 <?php  if(is_array($frame['items'])) { foreach($frame['items'] as $link) { ?> 
                                 
                                  <?php  if(is_agent != '1' || (is_agent == '1' && in_array(htmlspecialchars($link['title']),$role))) { ?>
                                    <a class="list-group-item <?php  echo $link['active'];?>" href="<?php  echo $link['url'];?>" kw="<?php  echo $link['title'];?>" style="padding-left: 40px;"><?php  echo $link['title'];?></a>
                                   <?php  } ?>
                                <?php  } } ?>
                            </ul>
                        </div>
					<?php  } } ?>
				</div>
			</div>
			<div class="app-container-right">
		<?php  } else { ?>
			<div class="app-container-right">
		<?php  } ?>
	<?php  } ?>
              