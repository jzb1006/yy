<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('./common/mainHeader', TEMPLATE_INCLUDEPATH)) : (include template('./common/mainHeader', TEMPLATE_INCLUDEPATH));?>
<div class="app-container-right">
			<ul class="nav nav-tabs" id="myTab">
	<li class="active"><a href="#tab_basic">定时任务</a></li>
</ul>
<div class="app-content">
	<div class="app-form">
		<form action="" method="post" id="setting-form" class="form-horizontal form">
			<div class="panel panel-default">
				<div class="panel-heading">定时任务</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-sm-2 control-label">图文问诊退款定时任务</label>
						<div class="col-sm-9">
							<p class="form-control-static js-clip" data-href="<?php  echo $url;?>/app/index.php?i=<?php  echo $uniacid;?>&t=0&v=1.0.0&from=wxapp&c=entry&a=wxapp&do=copysite&m=hyb_yl&act=yuyue.chaoshiwenzhen&m=hyb_yl"><a href="javascript:;" title="点击复制链接"><?php  echo $url;?>/app/index.php?i=<?php  echo $uniacid;?>&t=0&v=1.0.0&from=wxapp&c=entry&a=wxapp&do=copysite&m=hyb_yl&act=yuyue.chaoshiwenzhen&m=hyb_yl</a></p>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">其他问诊退款定时任务</label>
						<div class="col-sm-9">
							<p class="form-control-static js-clip" data-href="<?php  echo $url;?>/app/index.php?i=<?php  echo $uniacid;?>&t=0&v=1.0.0&from=wxapp&c=entry&a=wxapp&do=copysite&m=hyb_yl&act=yuyue.updatecsorder&m=hyb_yl"><a href="javascript:;" title="点击复制链接"><?php  echo $url;?>/app/index.php?i=<?php  echo $uniacid;?>&t=0&v=1.0.0&from=wxapp&c=entry&a=wxapp&do=copysite&m=hyb_yl&act=yuyue.updatecsorder&m=hyb_yl</a></p>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
			</div>
		</div>
	</div>
	<div class="foot" id="footer">
		<ul class="links ft">
            <li class="links_item"><div class="copyright">Powered by <a href="http://www.we7.cc"><b>系统</b></a> v2.0.4 © 2014-2015 <a href="http://www.we7.cc">www.we7.cc</a></div></li>
		</ul>
	</div>
	
	
    
    <script>
		require(['bootstrap'], function ($) {
		    $('[data-toggle="tooltip"]').tooltip({
	            container: $(document.body)
	        });
	        $('[data-toggle="popover"]').popover({
	            container: $(document.body)
	        });
	        $('[data-toggle="dropdown"]').dropdown({
	            container: $(document.body)
	        });
	    });
		myrequire(['js/init']);
				$('.app-login-info-name, .app-login-info-sel').mouseover(function(){
			$('.app-login-info-sel').show();
		});
		$('.app-login-info-name, .app-login-info-sel').mouseout(function(){
			$('.app-login-info-sel').hide();
		});
		$('.app-login-info-sel .login-out').hover(function(){
			$('.app-login-info-sel-arrow').css('border-color', '#1ab394 transparent transparent transparent');
		},function(){
			$('.app-login-info-sel-arrow').css('border-color', '#f2f2f2 transparent transparent transparent');
		});
		
			</script>
	</body>
</html>
